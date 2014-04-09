 <?php
 require_once("$BASE_DIR/modules/gateways/idealingpro/iDEALConnector.php");

$orderid = $_REQUEST['orderid'];
$itemname = $_REQUEST['itemname'];
$amount = $_REQUEST['amount'];
$itemdescription = $_REQUEST['itemdescription'];

$step = isset($_POST['step']) ? $_POST['step'] : 1;
$error = false;

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
            $IssuerList = &$response->getIssuerFullList();

            $trans = array(" " => "&nbsp");
            foreach ($IssuerList as $issuerName => $entry) {
                $issuerList = $issuerList . "<option value=\"" . $entry->getIssuerID() . "\">"
                        . strtr(str_pad($entry->getIssuerID(), 20), $trans) . " "
                        . $entry->getIssuerName() . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
                        . $entry->getIssuerListType();
                $issuerList .= "</option>\n";

                $sqlins = "insert into ideal_issuer(issuerid,issuername,issuertype,datetimestamp,acquirerid) values('{$entry->getIssuerID()}','{$entry->getIssuerName()}','{$entry->getIssuerListType()}','{$newStamp}','{$acquirerID}')";
                db_query($sqlins);
            }
        } else {
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
<?php if ($error == true) { ?>
                                <div>
                                    <div>
    <?php echo ERROR_CODE; ?>:<?php echo $errorCode; ?>
                                    </div>
                                    <div>
    <?php echo ERROR_MESSAGE; ?>:<?php echo $errorMsg; ?>
                                    </div>
                                    <div>
    <?php echo CONSUMER_MESSAGE; ?>:<?php echo $consumerMessage; ?>
                                    </div>
                                </div>
<?php } else { ?>
                                        <?php //if ($type == 1) { ?>
                                    <form action="" method="POST" class="idealform">
                                        <table width="100%" cellpading="1" cellspacing="1">
                                            <tr>
                                                <td width="100"><?php echo ITEM_NAME; ?></td>
                                                <td>
                                                    <input type="text" value="<?php echo $itemname; ?>" name="itemname" readonly="true"/>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>
        <?php echo SELECT_BANK; ?>
                                                </td>
                                                <td>
                                                    <select name="IssuerID">
        <?php echo $issuerList; ?>
                                                    </select>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td><?php echo AMOUNT; ?></td>
                                                <td>
                                                    <input type="text" value="<?php echo $amount; ?>" name="amount" readonly="true"/>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td colspan="2">
                                                    <input type="hidden" value="<?php echo $orderid; ?>" name="orderid"/>
                                                    <input type="hidden" value="<?php echo $itemdescription; ?>" name="itemdescription"/>
                                                    <input type="hidden" value="2" name="step"/>
                                                    <input name ="submit" type='Submit' value="<?php echo PAYMENT; ?>"></input>
                                                </td>
                                            </tr>

                                        </table>

                                    </form>
    <?php //} ?>
<?php } ?>