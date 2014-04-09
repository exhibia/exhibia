<?php

require_once("iDEALConnector_config.inc.php");

/**
 * Gets current date and time.
 *
 * @return string    Current date and time.
 */
function getCurrentDateTime()
{
    return utf8_encode(gmdate('Y-m-d\TH:i:s.000\Z'));
}

/**
 * Logs a message to the file.
 *
 * @param string $desiredVerbosity    The desired verbosity of the message
 * @param string $message        The message to log
 */
function logMessage($desiredVerbosity, $message)
{
    $config = ConfigurationManager::getInstance();
    $result = "";
    // Check if the log file is set. If not set, don't log.
    $logFile = $config->GetConfiguration("LOGFILE", true, $result);
    if (!isset($logFile) || $logFile == "") {
        return;
    }

    $verbosity = $config->GetConfiguration("TRACELEVEL", true, $result);
    if (strpos($verbosity, $desiredVerbosity) === false) {
        // The desired verbosity is not listed in the configuration
        return;
    }

    // Open the log file in 'append' mode.
    $file = fopen($logFile, 'a');
    fputs($file, getCurrentDateTime() . ": ");
    fputs($file, strtoupper($desiredVerbosity) . ": ");
    fputs($file, $message, strlen($message));
    fputs($file, "\r\n");
    fclose($file);
}

class ConfigurationManager
{
    private $config;
    private static $configManagerInstance;

    public static function getInstance()
    {
        if (!self::$configManagerInstance)
        {
            self::$configManagerInstance = new ConfigurationManager();
        }

        return self::$configManagerInstance;
    }

    /**
     * Loads the configuration for the MPI interface
     *
     */
    private function __construct()
    {
        $config_data = array();
        $file = fopen(SECURE_PATH . "/config.conf", 'r');

        // Check if the file exists and read until the end.
        if ($file) {
            while (!feof($file)) {
                $buffer = fgets($file);
                $buffer = trim($buffer);

                if (!empty($buffer)) {
                    // Separate at the equals-sign.
                    $pos = strpos($buffer, '=');
                    if ($pos > 0) {
                        $dumb = trim(substr($buffer, 0, $pos));
                        if (!empty($dumb)) {
                            // Populate the configuration array
                            $config_data[strtoupper(substr($buffer, 0, $pos))] = substr($buffer, $pos + 1);
                        }
                    }
                }
            }
        }
        fclose($file);

        $this->config = $config_data;
    }

    /**
     * Checks if the Configuration is set correctly. If an option is not set correctly, it will return an error. This has
     * to be checked in the begin of every function that needs these settings and if an error occurs, it must rethrown
     * to show it to the user.
     *
     * @return string    Error message when configsetting is missing, if no errors occur, ok is thrown back
     */
    public function CheckConfig()
    {
        if ($this->config['MERCHANTID'] == "") {
            return "MERCHANTID ontbreekt!";
        } elseif (strlen($this->config['MERCHANTID']) > 9) {
            return "MERCHANTID too long!";
        }
        elseif ($this->config['SUBID'] == "") {
            return "SUBID ontbreekt!";
        }
        elseif (strlen($this->config['SUBID']) > 6) {
            return "SUBID too long!";
        }
        elseif ($this->config['ACQUIRERURL'] == "") {
            return "ACQUIRERURL ontbreekt!";
        }
        elseif ($this->config['SUBID'] == "") {
            return "SUBID ontbreekt!";
        }
        elseif ($this->config['MERCHANTRETURNURL'] == "") {
            return "MERCHANTRETURNURL ontbreekt!";
        }
        elseif (strlen($this->config['MERCHANTRETURNURL']) > 512) {
            return "MERCHANTRETURNURL too long!";
        }
        elseif ($this->config['EXPIRATIONPERIOD'] == "") {
            return "EXPIRATIONPERIOD ontbreekt!";
        }
        else {
            return "OK";
        }
    }
    /**
     * Safely get a configuration item.
     * Returns the value when $name was found, otherwise an emptry string ("").
     * If "allowMissing" is set to true, it does not generate an error.
     *
     * @param string    $name        The name of the configuration item.
     * @param bool $allowMissing
     * @param $result
     * @return string    The value as specified in the configuration file.
     */
    public function GetConfiguration($name, $allowMissing, &$result)
    {
        if (isset($this->config[$name]) && ($this->config[$name] != "")) {
            return $this->config[$name];
        }
        if ($allowMissing) {
            return "";
        }

        logMessage(TRACE_ERROR, "The configuration item [" . $name . "] is not configured in the configuration file.");        
        $result = false;
        return false;
    }
}
