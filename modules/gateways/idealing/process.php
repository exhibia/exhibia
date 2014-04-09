 <?php
 require_once("$BASE_DIR/modules/gateways/idealing/iDEALConnector.php");


$step = isset($_POST['step']) ? $_POST['step'] : 1;
$error = false;
db_query("alter table payment_order add column additional1 varchar(200);");

$iDEALConnector = new iDEALConnector();
if ($step == 1) {
    $issuerList = "";
    $response = $iDEALConnector->GetIssuerList();
    if ($response->IsResponseError()) {
        $errorCode = $response->getErrorCode();
        $errorMsg = $response->getErrorMessage();
        $consumerMessage = $response->getConsumerMessage();
        $error = true;
    } else {
        $newStamp = $response->getDirectoryDateTimeStamp();
        $sql = "select datetimestamp from ideal_issuer limit 0,1";
        $reslut = db_query($sql);
        $reload = false;
        if (db_num_rows($result) > 0) {
            $rowissuer = db_fetch_array($result);
            $lastStamp = $rowissuer['datetimestamp'];
            if ($lastStamp < $newStamp) {
                $reload = true;
            }
        } else {
            $reload = true;
        }
        if ($reload == true) {
            $acquirerID = $response->getAcquirerID();
        //    $IssuerList = &$response->getIssuerFullList();

            $trans = array(" " => "&nbsp");
            foreach ($IssuerList as $issuerName => $entry) {
                

                $sqlins = "insert into ideal_issuer(issuerid,issuername,issuertype,datetimestamp,acquirerid) values('{$entry->getIssuerID()}','{$entry->getIssuerName()}','{$entry->getIssuerListType()}','{$newStamp}','{$acquirerID}')";
                db_query($sqlins);
            }
          }
        //} else {
            $result = db_query("select * from ideal_issuer");
            while ($row = db_fetch_array($result)) {
                $acquirerID = $row['acquirerid'];
                $issuerList = $issuerList . "<option value=\"" . $row['issuerid'] . "\">"
                        . strtr(str_pad($row['issuerid'], 20), $trans) . " "
                        . $row['issuername'] . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
                        . $row['issuertype'];
                $issuerList .= "</option>\n";
            }
        }
    
} else if ($step == 2) {
    $entranceCode = $orderid;
    $purchaseId = time();
    $issuerId = $_POST["IssuerID"];
    $amountf = $amount * 100;
    $description = $itemname;
    $merchantReturnURL = $SITE_URL . "payment_ideal_return.php";
    $expirationPeriod='';

    // Opsturen van de request. De response staat in $response.
    $response = $iDEALConnector->RequestTransaction(
            $issuerId, $purchaseId, $amount, $description, $entranceCode, $expirationPeriod, $merchantReturnURL);

    if ($response->IsResponseError()) {
        // Een fout is opgetreden.
        $errorCode = $response->getErrorCode();
        $errorMsg = $response->getErrorMessage();
        $consumerMessage = $response->getConsumerMessage();
        $error = true;
    } else {
        // De response bevat geen foutmelding.
        $acquirerID = $response->getAcquirerID();
        $issuerAuthenticationURL = $response->getIssuerAuthenticationURL();
        $transactionID = $response->getTransactionID();
        $upsql="update payment_order set additional1=$transactionID where orderid=$orderid";
        db_query($upsql);
        header("location:$issuerAuthenticationURL");
    }
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
       <?php include("page_headers.php"); ?>
    </head>

    <body class="single">
    <?php require("$BASE_DIR/include/$template/product_pages/idealing.php"); ?>

    </body>
</html>