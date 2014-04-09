<?php

if (!defined('CCADMIN')) { echo "NO DICE"; exit; }
global $getstylesheet;
global $theme;
$options = array(
    "barPadding"                    => array('textbox','Padding of bar from the end of the window'),
    "iPhoneView"                    => array('choice','iPhone style messages in chatboxes?'),
    "showSettingsTab"               => array('choice','Show Settings tab'),
    "showOnlineTab"                 =>array('choice','Show Who`s Online tab'),    
    "showModules"                   =>array('choice','Show Modules in Who\'s Online tab'),
    );

if (empty($_GET['process'])) {
    include_once(dirname(__FILE__).DIRECTORY_SEPARATOR.'config.php');
    
    $form = '';
    
    foreach ($options as $option => $result) {
        $form .= '<div id="'.$option.'"><div class="titlelong" >'.$result[1].'</div><div class="element">'; 
        if ($result[0] == 'textbox') {
            $form .= '<input type="text" class="inputbox" name="'.$option.'" value="'.${$option}.'">';
        }
        if ($result[0] == 'choice') {
            if (${$option} == 1) {
                $form .= '<input type="radio" name="'.$option.'" value="1" checked>Yes <input type="radio" name="'.$option.'" value="0" >No';
            } else {
                $form .= '<input type="radio" name="'.$option.'" value="1" >Yes <input type="radio" name="'.$option.'" value="0" checked>No';
            }
        }
        if ($result[0] == 'dropdown') {
            $form .= '<select  id="'.$option.'Opt" name="'.$option.'">';
            foreach ($result[2] as $opt) {
                if ($opt == ${$option}) {
                    $form .= '<option value="'.$opt.'" selected>'.ucwords($opt);
                } else {
                    $form .= '<option value="'.$opt.'">'.ucwords($opt);
                }
            }
            $form .= '</select>';
        }
        $form .= '</div><div style="clear:both;padding:7px;"></div></div>';
    }
    
    echo <<<EOD
                <!DOCTYPE html>
                <html>
                    <head>
                        <script type="text/javascript" src="../js.php?admin=1"></script>
                        <script type="text/javascript" language="javascript">
                            $(document).ready(function() {
                                resizeWindow();                                
                            });
                            
                            function resizeWindow() {
                                window.resizeTo(($("form").width()+30), ($("form").height()+85));
                            }
                        </script>
                        $getstylesheet
                    </head>
                <body>             
                    <form action="?module=dashboard&action=loadthemetype&type=theme&name=lite&process=true" method="post">
                    <div id="content">
                            <h2>Settings</h2>
                            <h3>If you are unsure about any value, please skip them</h3>
                            <div>
                                <div id="centernav" style="width:700px">
                                    $form
                                </div>
                            </div>
                            <div style="clear:both;padding:7.5px;"></div>
                            <input type="submit" value="Update Settings" class="button">&nbsp;&nbsp;or <a href="javascript:window.close();">cancel or close</a>
                         <div style="clear:both"></div>
                           </div>    
                        </form>                         
                </body>
                </html>
EOD;
        } else {
            $data = '';
            foreach ($_POST as $option => $value) {
                $data .= '$'.$option.' = \''.$value.'\';'."\t\t\t// ".$options[$option][1]."\r\n";
            }
            if (!empty($data)) {
                configeditor('SETTINGS',$data,0,dirname(__FILE__).DIRECTORY_SEPARATOR.'config.php');
            }
            header("Location:?module=dashboard&action=loadthemetype&type=theme&name=lite");
       }
?>
