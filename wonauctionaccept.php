<?php
include("config/connect.php");
include("sendmail.php");
include("functions.php");
$aucid = $_GET["winid"];
include("email.php");
if(empty($_SESSION['userid'])){
header("location: index.php");
}
//	$err = 1;
if($aucid!="") {
    $auctionID = base64_decode($aucid);
//		$auctionID = $aucid;
    $qrysel = "select * from auction a left join products p on a.productID=p.productID  left join won_auctions w on a.auctionID=w.auction_id where a.auctionID='".$auctionID."'";
    $ressel = db_query($qrysel);
    $objsel = db_fetch_object($ressel);
}

if($_POST["submit"]!="") {
    $username = $_POST["username"];
    $pass = $_POST["password"];

    $query="select * from registration where username='$username' and password='$pass' and account_status='1' and member_status='0' and user_delete_flag!='d'";
    $rs = db_query($query);
    $total = db_num_rows($rs);
    $objquery = db_fetch_object($rs);

    $auctionID = $_REQUEST["auctionid"];
    $qrysel = "select * from auction a left join products p on a.productID=p.productID  left join won_auctions w on a.auctionID=w.auction_id where a.auctionID='".$auctionID."'";
    $ressel = db_query($qrysel);
    $objsel = db_fetch_object($ressel);
    if($objsel->fixedpriceauction==1) {
        $winprice = $objsel->auc_fixed_price;
    }
    elseif($objsel->offauction==1) {
        $winprice = "0.00";
    }
    else {
        $winprice = $objsel->auc_final_price;
    }

    if($objsel->accept_denied=="") {
        if($total>0 && $objquery->id==$objsel->userid) {
            $expiry = AcceptDateFunctionStatus($objsel->won_date);

            $todaytime = time();
            $expirytime = mktime($expiry["Hour"],$expiry["Min"],$expiry["Sec"],$expiry["Month"],$expiry["Day"],$expiry["Year"]);
            $dateDiff = $todaytime - $expirytime;

            if($todaytime>$expirytime) {
                $new_status = "Expire";
            }
            else {
                $new_status = "Running";
            }
            /*			$fullDays = floor($dateDiff/(60*60*24));
			if ($fullDays>0) { 
			$new_status = "Expire"; 
			} else { 
			$new_status = "Running"; 
			} */

            if($new_status=="Expire") {
                $err = 1;
            }

            else {
                $accden = $_POST['Accden'];
                $mailpayflag = 0;
                if($accden=='Accepted') {
                    $Updateqry = "update won_auctions set accept_denied='".$accden."',accept_date=NOW() where userid='".$objsel->userid."' and auction_id='".$_REQUEST["auctionid"]."'";
                }
                else {
                    $Updateqry = "update won_auctions set accept_denied='".$accden."' where userid='".$objsel->userid."' and auction_id='".$_REQUEST["auctionid"]."'";
                }
                db_query($Updateqry) or die(db_error());

                $_SESSION["username"]=$username;
                $_SESSION["userid"]=$objquery->id;
                $_SESSION["sessionid"] = session_id();

                $username = getUserName($_SESSION["userid"]);
                $accden=="Accepted";
                $auction_id = $_REQUEST["auctionid"];
                $auction_name = $objsel->name;
                $price = $Currency.number_format($winprice,2);
                $auction_date = date("d/m/Y",time());
                $win_aucId = base64_encode($_REQUEST["auctionid"]);

                if($accden=='Accepted') {
                    if($objsel->offauction==1 || $objsel->fixedpriceauction==1) {
                        $qryshipping = "select * from shipping where id='".$objsel->shipping_id."'";
                        $resshipping = db_query($qryshipping);
                        $objshipping = db_fetch_object($resshipping);

                        if($objsel->offauction==1) {
                            $totalamount = $objshipping->shippingcharge;
                            if($totalamount<=0) {
                                $paymentdate = date("Y-m-d H:i:s");
                                $qryupd = "update won_auctions set payment_date='".$paymentdate."' where auction_id='".$_REQUEST["auctionid"]."' and userid='".$objsel->userid."'";
                                db_query($qryupd) or die(db_error());
                                $paymentdate2 = arrangedate(substr($paymentdate,0,10))."<br>".substr($paymentdate,11);
                                $mailpayflag = 1;
                            }
                        }
                        if($objsel->fixedpriceauction==1) {
                            $totalamount = $objsel->auc_fixed_price + $objshipping->shippingcharge;
                            if($totalamount<=0) {
                                $paymentdate = date("Y-m-d H:i:s");
                                $qryupd = "update won_auctions set payment_date='".$paymentdate."' where auction_id='".$_REQUEST["auctionid"]."' and userid='".$objsel->userid."'";
                                db_query($qryupd) or die(db_error());
                                $paymentdate2 = arrangedate(substr($paymentdate,0,10))."<br>".substr($paymentdate,11);
                                $mailpayflag = 1;
                            }
                        }
                    }
                }

                if($accden=="Accepted" && $mailpayflag==1) {
                    $emailcont = getEmailContent(9);
                    $subject = getEmailSubject(9);
                    $emailcont1 = sprintf($emailcont,$username,$auction_id,$auction_name,$price,$auction_date,$win_aucId,$objquery->firstname);
                }

                elseif($accden=='Accepted') {
                    $emailcont = getEmailContent(11);
                    $subject = getEmailSubject(11);
                    $emailcont1 = sprintf($emailcont,$objquery->firstname,$auction_id,$auction_name,$price,$win_aucId);
                }

                else {
                    $emailcont = getEmailContent(10);
                    $subject = getEmailSubject(10);
                    $emailcont1 = sprintf($emailcont,$username,$auction_id,$auction_name,$price,$auction_date,$win_aucId,$objquery->firstname);
                }

                $from=$adminemailadd;
                $email = $objquery->email;

                SendHTMLMail($email,$subject,$emailcont1,$from);
                ?>
<script language="javascript" type="text/javascript">
    window.location.href='wonauctions.php';
</script>
                <?php
				header("location: wonauctions.php");
            }
        }
        else {
            header("location: login.php?err=1");
        }
    }
    else {
        if($_POST["username"]=="" || $_POST["password"]=="") {
            header("location: login.php?err=1");
        }
        else {
            $err = 2;
        }
    }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php include('page_headers.php'); ?>
        <script language="javascript" type="text/javascript">
            function CheckValue(f1)
            {
                var wonstatus = f1.Accden.value;
                if(wonstatus=="")
                {
                    alert("<?php echo PLEASE_SELECT_ACCEPT_OR_DENIED; ?>");
                    f1.Accden.focus();
                    return false
                }
            }
        </script>
    </head>

    <body class="single">
                <?php
         
         
	    
	      if(file_exists("include/$template/user_pages/wonauctions.php")){
		include("include/$template/user_pages/wonauctions.php");
		}else{
		
		include("include/wonauctions.php");
		
		}
		


	  ?>
    </body>
</html>