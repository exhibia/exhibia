<?php
include("config/connect.php");
;
include("session.php");
include("functions.php");
include("email.php");
if(empty($_REQUEST['ajax'])){
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php include('page_headers.php'); ?>
        <script language="javascript" type="text/javascript">
            function CheckValue(f1)
            {
                var wonstatus = f1.Accden.value;
                var acceptordenied = '<?php echo SELECT_ACCEPT_OR_DENIED; ?>';
                if(wonstatus=="")
                {
                    alert(acceptordenied);
                    f1.Accden.focus();
                    return false
                }
            }
        </script>
        <?php
        
        }
            if ($_POST['Submit'] != "") {
                $accden = $_POST['Accden'];
                $mailpayflag = 0;

                $qrysel = "select * from auction a left join products p on a.productID=p.productID  left join registration r on a.buy_user=r.id where a.auctionID='" . $_REQUEST["auctionid"] . "'";
                $ressel = db_query($qrysel);
                $objsel = db_fetch_object($ressel);

                if ($accden == 'Accepted') {
                    $Updateqry = "update won_auctions set accept_denied='" . $accden . "',accept_date=NOW() where userid='" . $_SESSION["userid"] . "' and auction_id='" . $_REQUEST["auctionid"] . "'";
                } else {
                    $Updateqry = "update won_auctions set accept_denied='" . $accden . "' where userid='" . $_SESSION["userid"] . "' and auction_id='" . $_REQUEST["auctionid"] . "'";
                }
                db_query($Updateqry) or die(db_error());

                if ($accden == 'Accepted') {
                    if ($objsel->offauction == 1 || $objsel->fixedpriceauction == 1) {
                        $qryshipping = "select * from shipping where id='" . $objsel->shipping_id . "'";
                        $resshipping = db_query($qryshipping);
                        $objshipping = db_fetch_object($resshipping);

                        if ($objsel->offauction == 1) {
                            $totalamount = $objshipping->shippingcharge;
                            if ($totalamount <= 0) {
                                $paymentdate = date("Y-m-d H:i:s");
                                $qryupd = "update won_auctions set payment_date='" . $paymentdate . "' where auction_id='" . $_REQUEST["auctionid"] . "' and userid='" . $_SESSION["userid"] . "'";
                                db_query($qryupd) or die(db_error());
                                $paymentdate2 = arrangedate(substr($paymentdate, 0, 10)) . "<br>" . substr($paymentdate, 11);
                                $mailpayflag = 1;
                            }
                        }
                        if ($objsel->fixedpriceauction == 1) {
                            $totalamount = $objsel->auc_fixed_price + $objshipping->shippingcharge;
                            if ($totalamount <= 0) {
                                $paymentdate = date("Y-m-d H:i:s");
                                $qryupd = "update won_auctions set payment_date='" . $paymentdate . "' where auction_id='" . $_REQUEST["auctionid"] . "' and userid='" . $_SESSION["userid"] . "'";
                                db_query($qryupd) or die(db_error());
                                $paymentdate2 = arrangedate(substr($paymentdate, 0, 10)) . "<br>" . substr($paymentdate, 11);
                                $mailpayflag = 1;
                            }
                        }
                    }
                }
                if ($objsel->fixedpriceauction == 1) {
                    $winprice = $objsel->auc_fixed_price;
                } elseif ($objsel->offauction == 1) {
                    $winprice = "0.00";
                } else {
                    $winprice = $objsel->auc_final_price;
                }

                $username = getUserName($_SESSION["userid"]);
                $firstname = getUserFirstName($_SESSION["userid"]);
                $auction_id = $_REQUEST["auctionid"];
                $auction_name = $objsel->name;
                $price = $Currency . number_format($winprice, 2);
                $auction_date = date("m/d/Y", time());
                $win_aucId = base64_encode($auction_id);

                $from = $adminemailadd;
                $email = $objsel->email;

                if ($accden == "Accepted" && $mailpayflag == 1) {
//			echo "Condition1";
                    $emailcont = getEmailContent(9);
                    $subject = getEmailSubject(9);
                    $emailcont1 = sprintf($emailcont, $username, $auction_id, $auction_name, $price, $auction_date, $win_aucId, $firstname);
                    SendHTMLMail($email, $subject, $emailcont1, $from);
                    //exit;
//			echo $emailcont1;
//			exit;
                } elseif ($accden == 'Accepted') {
//			echo "Condition2";
                    $emailcont = getEmailContent(11);
                    $subject = getEmailSubject(11);
                    $emailcont1 = sprintf($emailcont, $firstname, $auction_id, $auction_name, $price, $win_aucId);
                    SendHTMLMail($email, $subject, $emailcont1, $from);
//			echo $emailcont1;
//			exit;
                } else {
//			echo "Condition3";
                    $emailcont = getEmailContent(10);
                    $subject = getEmailSubject(10);
                    $emailcont1 = sprintf($emailcont, $username, $auction_id, $auction_name, $price, $auction_date, $win_aucId, $firstname);
                    SendHTMLMail($email, $subject, $emailcont1, $from);
//			echo $emailcont1;
                }

                //$subject="Auction Accept/Denied - Item Won!";
	      if(empty($_REQUEST['ajax'])){
                echo '<script language="javascript"> window.opener.ShowMakepaymentbutton("' . $_REQUEST["auctionid"] . '","' . $accden . '","' . $paymentdate2 . '"); function win_close(){ window.opener = self; window.close();} win_close();</script>';
                exit;
                }else{
		     exit;
                
                }
            }
            if(empty($_REQUEST['ajax'])){
        ?>
        </head>
        <body>
        <?php } ?>
            <form name="AcceptWon" action="<?php if(!empty($_REQUEST['ajax'])){ ?> javascript: accept_in_modal(); <?php } ?>" id="AcceptWon" method="post" onsubmit="return CheckValue(this);">
                <table border="0" cellspacing="0" cellpadding="0" width="100%">
                    <tr>
                        <td>
                            <table align="center" border="0" cellspacing="0" cellpadding="0" width="100%">
                                <tr>
                                    <td colspan="2"><b><?php echo ACCEPT_WON_AUCTION; ?></b></td>
                                </tr>
                                <tr>
                                    <td height="5"></td>
                                </tr>
                                <tr>
                                    <td><?php echo ACCEPT_DENIED; ?>: </td>
                                    <td>
                                        <select name="Accden">
                                            <option value=""><?php echo PLEASE_SELECT; ?></option>
                                            <option value="Accepted"><?php echo ACCEPT; ?></option>
                                            <option value="Denied"><?php echo DENIED; ?></option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td height="10"></td>
                                </tr>
                                <tr>
                                    <td align="center" colspan="2"><input type="image" src="images/submit.png" onmouseover="this.src='images/submit_hover.png'" onmouseout="this.src='images/submit.png'" /><input type="hidden" name="Submit" value="Submit" /></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
                <input type="hidden" name="auctionid" value="<?php echo $_REQUEST['auctionid']; ?>" />
        </form>
        
        <?php if(empty($_REQUEST['ajax'])){ ?>
    </body>
</html>
<?php } ?>