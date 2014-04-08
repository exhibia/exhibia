<?php
@session_start();
//ini_set('display_errors', 1);
include("config/connect.php");
include("functions.php");

//include("lib/geoip/geoipcity.inc");
//include("lib/geoip/geoipregionvars.php");

// uncomment for Shared Memory support
// geoip_load_shared_mem("/usr/local/share/GeoIP/GeoIPCity.dat");
// $gi = geoip_open("/usr/local/share/GeoIP/GeoIPCity.dat",GEOIP_SHARED_MEMORY);
if ($_GET["auc_key"] != "") {
    $verifycode = $_GET["auc_key"];
    $confirmemail = 1;
    $uid_s = db_fetch_object(db_query("select * from registration where verifycode = '$_GET[auc_key]' limit 1"));
    $uid = $uid_s->id;
   
    $qryupd = "update registration set account_status='1', member_status = '1' where id = " . $uid;
    db_query($qryupd);

    $qryregmsg = "select * from general_setting where id='4'";
    $resregmsg = db_query($qryregmsg);
    $objregmsg = db_fetch_array($resregmsg);
    if ($objregmsg["reg_bidpoint"] > 0 && $uid != "") {
        $qryupdreg = "update registration set final_bids='" . $objregmsg["reg_bidpoint"] . "' where id='" . $uid . "'";
        db_query($qryupdreg);
        $qryupdbid = "Insert into bid_account (user_id,bidpack_buy_date,bid_count,bid_flag,recharge_type,credit_description) values('" . $uid . "',NOW(),'" . $objregmsg["reg_bidpoint"] . "','c','fr','Welcome Bonus')";
        db_query($qryupdbid);
    }

    $qryvoucher = "select * from vouchers where newuser_flag='1'";
    $resvoucher = db_query($qryvoucher);
    $totalvoucher = db_num_rows($resvoucher);
    if ($totalvoucher > 0 && $uid != "") {
        $objvoucher = db_fetch_object($resvoucher);
        $voucherdesc = $objvoucher->voucher_title;
        if ($objvoucher->validity > 0) {
            $voucherdesc .= " (valid for " . $objvoucher->validity . " days)";
            $expirydate = AcceptDateFunctionStatus_Voucher(date("Y-m-d H:i:s", time()), $objvoucher->validity);
            $qryinsv = "Insert into user_vouchers  (user_id,voucherid,issuedate,expirydate,voucher_status,voucher_desc) values('" . $uid . "','" . $objvoucher->id . "',NOW(),'" . $expirydate . "','0','" . $voucherdesc . "');";
            db_query($qryinsv);
        }
    }
    $query = "select * from registration where registration.id = $uid";
} elseif ($_GET["ud"] != "" && $_GET["pd"] != "") {
    $username = base64_decode(chkInput($_GET["ud"], 's'));
    $pass = base64_decode(chkInput($_GET["pd"], 's'));
    $query = "select * from registration where username='$username' and password='$pass' and account_status='1'";
} else {
    $username = chkInput($_POST["username"], 's');
    $pass = chkInput($_POST["password"], 's');
    $query = "select * from registration where username='$username' and password='$pass' and account_status='1'";
}
$result = db_query($query);
$total = db_num_rows($result);
$ress = db_fetch_object($result);
if ($total > 0) {
    if ($ress->user_delete_flag != 1) {
        $_SESSION["username"] = $ress->username;
        $_SESSION["userid"] = $ress->id;
        $_SESSION["sessionid"] = session_id();
        $_SESSION['url'] = $SITE_URL;
	$_SESSION['useravatar'] = $ress2->avatar;
	
        $qrygen = "select * from general_setting where id='2'";
        $resgen = db_query($qrygen);
        $objgen = db_fetch_array($resgen);
        if ($objgen["login_flag"] == 1) {
            $qryfra = "select * from free_account where user_id='" . $_SESSION["userid"] . "' and bid_flag='c' and recharge_type='fr' and bidpack_buy_date>='" . date("Y-m-d 00:00:01") . "' and bidpack_buy_date<='" . date("Y-m-d 23:59:59") . "'";
            $resfra = db_query($qryfra);
            $totalfra = db_num_rows($resfra);
            if ($totalfra <= 0) {
                if ($objgen["login_points"] > 0) {
                    $qryinsf = "Insert into free_account (user_id,bidpack_buy_date,bid_count,bid_flag,recharge_type,credit_description) values('" . $_SESSION["userid"] . "',NOW(),'" . $objgen["login_points"] . "','c','fr','Login Free Points')";
                    db_query($qryinsf);
                    $qryupdreg = "update registration set free_bids=free_bids + " . $objgen["login_points"] . " where id='" . $_SESSION["userid"] . "'";
                    db_query($qryupdreg);
                }
            }
        }
        if ($_SESSION["ipid"] != "") {
            $qryipupd = "update login_logout set user_id='" . $_SESSION["userid"] . "',login_time=NOW(),logout_time='" . date("Y-m-d H:i:s", (time() + 20)) . "' where load_time='" . $_SESSION["ipid"] . "'";
            db_query($qryipupd);
        } else {
            $_SESSION["ipaddress"] = $_SERVER['REMOTE_ADDR'];
            $qryinsip = "insert into login_logout (user_id,ipaddress,login_time,load_time,logout_time) values('" . $_SESSION["userid"] . "','" . $_SESSION["ipaddress"] . "',NOW(),NOW(),'" . (time() + 20) . "')";
            db_query($qryinsip);
            $_SESSION["ipid"] = date("Y-m-d H:i:s", time());
            session_unregister("login_logout");
        }
        //update user's postion
       /* $gi = geoip_open("lib/geoip/data/GeoLiteCity.dat", GEOIP_STANDARD);
        $record = geoip_record_by_addr($gi, $_SERVER['REMOTE_ADDR']);
        $position = '';
        if ($record->latitude == '' || $record->longitude == '') {
            $regip = $ress->registration_ip;
            if ($regip != '') {
                $record = geoip_record_by_addr($gi, $regip);
                $position = $record->latitude . ',' . $record->longitude;
            }
        } else {
            $position = $record->latitude . ',' . $record->longitude;
        }*/
        if ($position != '') {
            $upsql = "update registration set position='$position' where id='{$_SESSION["userid"]}'";
            db_query($upsql);
        }

        if ($_GET["key"] != "") {
            header("location: editpassword.php");
        } elseif ($_POST["feedback_hidden"] != "") {
            header("location: feedback.php");
        } elseif ($_POST['fid']) {
            header("location: forum/posttopic.php?fid=" . $_POST['fid']);
        } elseif ($_POST['tid']) {
            header("location: forum/postreply.php?tid=" . $_POST['tid']);
        } else {
            if ($confirmemail == 1) {
                header("location:emailconfirmsuccess.php");
                exit;
            } else {
                if ($_POST["username"] != "") {
                    header("location: index.php");
                    exit;
                } else {
		      if(preg_match("/registration/", $_SERVER['REQUEST_URI'])){
			  header("location: index.php");
			  exit;
		      }else{
			  header("location: index.php");
			  exit;
		      }
                }
            }
        }
    } else {
        if ($ress->member_status == "1") {
            header("location:login.php?err=2");
            exit;
        } elseif ($ress->user_delete_flag >= 1) {
            header("location:login.php?err=3");
            exit;
        }
    }
} else {
    if ($username == "" && $pass == "") {
        header("location:login.php?err=4");
    } elseif ($username != "" && $pass == "") {
        header("location:login.php?err=5");
    } else {
        header("location:login.php?err=1");
    }
}
?>