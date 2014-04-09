<?php
/******************************************************************************
 * History:
 * $Log$
 *
 ******************************************************************************
 * Last CheckIn :   $Author$
 * Date :           $Date$
 * Revision :       $Revision$
 ******************************************************************************
 */

require_once("includes/ConnectorHelper.php");

/**
 *  This class is responsible for handling all iDEAL operations and shields
 *  external developers from the complexities of the platform.
 *
 */
class iDEALConnector {
    private $connectorHelper;


    public function __construct(){
        $this->connectorHelper = new ConnectorHelper();
    }

    /**
     * Public function to get the list of issuers that the consumer can choose from.
     *
     * @return An instance of DirectoryResponse or "FALSE" on failure.
     */
    public function GetIssuerList()
    {
        $xmlMsg = $this->connectorHelper->CreateDirectoryMessage();

        // Post the XML to the server.
        $response = $this->connectorHelper->DirectoryRequest( $xmlMsg );

        // If the response did not work out, return an ErrorResponse object.
        $error = $this->connectorHelper->DirectoryResponseHasErrors($response);
        if ($error != false){
            return $error;
        }
        return new DirectoryResponse($response);
    }

    /**
     * This function submits a transaction request to the server.
     *
     * @param string $issuerId			The issuer Id to send the request to
     * @param string $purchaseId		The purchase Id that the merchant generates
     * @param integer $amount			The amount in cents for the purchase
     * @param string $description		The description of the transaction
     * @param string $entranceCode		The entrance code for the visitor of the merchant site. Determined by merchant
     * @param string $optExpirationPeriod		Expiration period in specific format. See reference guide. Can be configured in config.
     * @param string $optMerchantReturnURL		The return URL (optional) for the visitor. Optional. Can be configured in config.
     * @param string $optLanguage		The language. Optional.
     * @return An instance of AcquirerTransactionResponse or "false" on failure.
     */
    public function RequestTransaction($issuerId, $purchaseId, $amount, $description, $entranceCode, $optExpirationPeriod="", $optMerchantReturnURL="", $optLanguage = "" )
    {
        $xmlMsg = $this->connectorHelper->CreateTransactionMessage($issuerId, $purchaseId, $amount, $description, $entranceCode, $optExpirationPeriod, $optMerchantReturnURL, $optLanguage);

        // Post the request to the server.
        $response = $this->connectorHelper->TransactionRequest( $xmlMsg );

        $error = $this->connectorHelper->TransactionResponseHasErrors($response);
        if ($error != false){
            return $error;
        }

        return new AcquirerTransactionResponse($response);
    }

    /**
     * This public function makes a transaction status request
     *
     * @param string $transactionId	The transaction ID to query. (as returned from the TX request)
     * @return An instance of AcquirerStatusResponse or FALSE on failure.
     */
    public function RequestTransactionStatus( $transactionId )
    {
        $xmlMsg = $this->connectorHelper->CreateStatusMessage($transactionId);

        // Post the request to the server.
        $response = $this->connectorHelper->StatusRequest( $xmlMsg );

        $error = $this->connectorHelper->StatusResponseHasErrors($response);
        if ($error != false){
            return $error;
        }

        // Build the status response object and pass the data into it.
        return new AcquirerStatusResponse($response);
    }

}
?>
