<?php
include_once("config/connect.php");
if(empty($_REQUEST['social_verify'])){ header("location: index.php"); }

if($_REQUEST['social_verify'] == 'facebook'){
include_once 'functions.php';
include_once 'include/advertisefunction.php';
include_once($BASE_DIR . "/include/addons/facebook/data/facebook.php");
define('YOUR_APP_ID', '129299757101755');
define('APP_SECRET', '6b2f92a905b24bbc762c20c37c7cd7df');
//uses the PHP SDK.  Download from https://github.com/facebook/php-sdk
$facebook = new Facebook(array(
  'appId'  => YOUR_APP_ID,
  'secret' => APP_SECRET,
));
$userId = $facebook->getUser();
if ($userId) {
  try {
   $userInfo = $facebook->api('/' . $userId);
   if(db_num_rows(db_query("select email from registration where email = '$userInfo[email]' or facebook = '$userInfo[email]'"))>=1){
	  $ress = db_fetch_object(db_query("select * from registration where email = '$userInfo[email]' or facebook = '$userInfo[email]' limit 1"));
	  $username = $ress->username;
	  $pass = $ress->password;
          @session_start();
	  $_SESSION["username"]=$ress->username;
	  $_SESSION["userid"]=$ress->id;
	  $_SESSION["sessionid"] = session_id();
	  $_SESSION['url'] = $SITE_URL;
	  $userInfo = $facebook->api('/' . $userId);
	  $birthday = explode("/", $userInfo['birthday']);
	  $location = explode(", ", $userInfo['location']['name']);
	  $firstname= $userInfo['first_name'];
	  $lastname = $userInfo['last_name']; 
	  $email = $userInfo['email'];
	  $user_image = "//graph.facebook.com/" . $userInfo['id'] . "/picture";
	  $picture = "//graph.facebook.com/" . $userInfo['id'] . "/picture";	  
	  $qryipupd = "update login_logout set user_id='".$_SESSION["userid"]."',login_time=NOW(),logout_time='".date("Y-m-d H:i:s",(time() + 20))."'";
	  db_query($qryipupd) or die(db_error());
	  header("location: myaccount.php");
     }else{
    $fb_error = 'true';
    $picture = "//graph.facebook.com/" . $userInfo['id'] . "/picture";
   }
  }catch (FacebookApiException $e) {   $user = null; }
}
}else if($_REQUEST['social_verify'] == 'google'){
// Include google API settings
require "include/addons/google/google_verification.php";
// Now include the Google API client library for PHP(https://code.google.com/p/google-api-php-client/downloads/list)
require_once 'include/addons/google/src/Google_Client.php';
require_once 'include/addons/google/src/contrib/Google_Oauth2Service.php';
      $googleClient = new Google_Client();
      $googleClient->setApplicationName('Exhibia');
      $googleClient->setClientId($clientID);
      $googleClient->setClientSecret($clientSecret);
      $googleClient->setRedirectUri($redirectURL);
      $googleClient->setDeveloperKey($apiKey);
      $google_oauthV2 = new Google_Oauth2Service($googleClient);
      // Action if code is sent
      if (isset($_GET['code'])) 
      { 
	  try{
		$googleClient->authenticate($_GET['code']);
		$_SESSION['token'] = $googleClient->getAccessToken();
	      
	  }catch(Google_AuthException $e){ }
      }
      // Action if token is sent
      if (isset($_SESSION['token'])) 
      { 
		      $googleClient->setAccessToken($_SESSION['token']);
      }
      if ($googleClient->getAccessToken()) 
      {
	  // Extract the user details and store them in an array
	  $data 				= $google_oauthV2->userinfo->get();
	  $user_id 				= $data['id'];
	  $user_name 			= $data['name'];
	  $email 				= $data['email'];
	  $profile_url 			= $data['link'];
	  $profile_image_url 	= $data['picture'];
	  $_SESSION['token'] 	= $googleClient->getAccessToken();
	  $picture = $data['picture'];
	  
	      if(db_num_rows(db_query("select * from registration where email = '$email' or google = '$email'"))>=1){
	   
		  $ress = db_fetch_object(db_query("select * from registration where email = '$email' or google = '$email' limit 1"));
		  $username = $ress->username;

		  $pass = $ress->password;
		
	
		  $_SESSION["username"]=$ress->username;
		  $_SESSION["userid"]=$ress->id;
		  $_SESSION["sessionid"] = session_id();
		  $_SESSION['url'] = $SITE_URL;
		 
		  $qryipupd = "update login_logout set user_id='".$_SESSION["userid"]."',login_time=NOW(),logout_time='".date("Y-m-d H:i:s",(time() + 20))."'";
		  db_query($qryipupd) or die(db_error());
		  header("location: myaccount.php");
	      }else{
	  $g_error = 'true';
	}
	 
   }
}
//end for first nine products
if (isset($_POST["username"])) {
include("sendmail.php");
include("functions.php");
include("email.php");
include_once 'data/usercoupon.php';
include_once 'data/coupon.php';
include_once 'common/dbmysql.php';
include_once 'common/sitesetting.php';
include_once 'data/bidaccount.php';

    $username = chkInput($_POST["username"], 's', 100);
    if (strlen($username) < 6) {
        $errorMsg .='<li>' . PLEASE_ENTER_USERNAME . '</li>';
    }

    $gender = chkInput($_POST["gender"], 's', 10);
    $fname = chkInput($_POST["firstname"], 's', 100);
    if (strlen($fname) < 1) {
        $errorMsg.='<li>' . PLEASE_ENTER_FIRST_NAME . '</li>';
    }

    $lname = chkInput($_POST["lastname"], 's', 100);
    if (strlen($lname) < 1) {
        $errorMsg.='<li>' . PLEASE_ENTER_LAST_NAME . '</li>';
    }
    if(isset($_POST["month"]) & isset($_POST['date']) & isset($_POST['year'])){
	$bdate = chkInput($_POST["month"] . "-" . $_POST["date"] . "-" . $_POST["year"], 's', 50);
	if (strlen($bdate) < 6) {
	    $errorMsg.='<li>' . PLEASE_SELECT_BIRTH_DATE . '</li>';
	}
    }
    $pass = chkInput($_POST["password"], 's', 50);
    $cnfpass = chkInput($_POST["cnfpassword"], 's', 50);
    if (strlen($pass) < 6) {
        $errorMsg.='<li>' . PLEASE_ENTER_PASSWORD . '</li>';
    } else if ($pass != $cnfpass) {
        $errorMsg.='<li>' . PASSWORD_MISMATCH . '</li>';
    }
    $email = chkInput($_POST["email"], 's', 50);
    $cnfemail = chkInput($_POST["cnfemail"], 's', 50);
    $regMail = "/^[\w-]+(?:\.[\w-]+)*@(?:[\w-]+\.)+[a-zA-Z]{2,7}$/";
    if (strlen($email) == 0 || preg_match($regMail, $email) == 0) {
        $errorMsg.='<li>' . PLEASE_VALID_EMAIL_ADDRESS . '</li>';
    } else if ($email != $email) {
        $errorMsg.='<li>' . EMAIL_ADDRESS_MISMATCH . '</li>';
    }
    $referrerid = isset($_GET["ref"]) ? chkInput($_GET["ref"], 'i') : '';
    $referrerid = isset($_POST["referid"]) ? chkInput($_POST["referid"], 'i') : $referrerid;
    $terms = chkInput($_POST["terms"], 'i');
    $privacy = 1;
    $news = chkInput($_POST["Newsletter"], 'i');
    if (!$terms) {
        $errorMsg.='<li>' . PLEASE_ACCEPT_OUT_TERMS_CONDITIONS . '</li>';
    }
    $rndcode = chkInput(strtolower($_POST["rndcode"]), 's', 30);
    $resdupcheck = db_query("select email from registration where username='$username'");
    if (db_num_rows($resdupcheck) > 0) {
        $errorMsg.='<li>' . THIS_USERNAME_ALREADY_EXISTS . '</li>';
    }
    db_free_result($resdupcheck);
    $resdupcheck1 = db_query("select email from registration where email='$email'");
    if (db_num_rows($resdupcheck1) > 0) {
        $errorMsg.='<li>' . THE_EMAIL_ADDRESS_ALREADY_EXISTS . '</li>';
    }
    db_free_result($resdupcheck1);
    if (strlen($referrerid > 0)) {
        $resreferrer = db_query("select * from registration, afilliate_links where registration.id=$referrerid or afilliate_links.referal_code = '$referrerid'");
        $totalreferrer = db_num_rows($resreferrer);
        db_free_result($resreferrer);
        if ($totalreferrer == 0) {
            $errorMsg.='<li>' . PLEASE_ENTER_VALID_REFERRER_CODE_OR_SKIP_IT . '</li>';
        }
    }
    if (db_num_rows(db_query("select * from captcha_codes where captcha_code = '$rndcode'")) == 0) {
        $errorMsg.='<li>' . PLEASE_ENTER_CORRECT_SECURITY_CODE . '</li>';
    }
    if ($errorMsg == '') {
	if(!empty($referrerid)){
		  $bid_info = db_fetch_object(db_query("SELECT * from refer_points_admin where retrieve_condition = 'For refering a friend'"));
		  if(empty($bid_info->num_times_to_dispense)){
		  $bid_info->num_times_to_dispense = 0;
		  }
		  if(empty($bid_info->bid_points)){
		  $bid_info->bid_points = 0;
		  }
		    $points = db_fetch_array(db_query("select * from refer_points where userid = '$referrerid' AND dsipensed > '0' AND dsipensed <= '" . $bid_info->num_times_to_dispense . "' "));
			  if(db_num_rows(db_query("select * from refer_points where userid = '$referrerid' AND dsipensed > '0' AND dsipensed <= '" . $bid_info->num_times_to_dispense . "' ")) >= 1){
				$bidcount = $points[0];
				db_query("insert into bid_account values(null, '$referrerid', '0', '" . time("Y-m-d H:i:s") . "', '" . $bid_info->bid_points . "', '0', '0', 'c', '0.00', '', 'ad', '$referrerid' , '0', '" . $bid_info->retrieve_condition . "');");
				echo db_error();
				db_query("update refer_points set dsipensed = '" . $point['dsipensed'] + 1 . "' where userid = '$referrerid' AND id = $points[id]");
				echo db_error();
			  }else{
				db_query("insert into bid_account values(null, '$referrerid', '0', '" . time("Y-m-d H:i:s") . "', '" . $bid_info->bid_points . "', '0', '0', 'c', '0.00', '', 'ad', '$referrerid' , '0', '" . $bid_info->retrieve_condition . "');");
				echo db_error();
				db_query("insert into refer_points (id, dsipensed, bid_points, userid, reason) values(null, '1', '" . $bid_info->bid_points ."', '$referrerid', '" . $bid_info->retrieve_condition . "');");
				echo db_error();
			  }
			  if(db_num_rows(db_query("select * from sitesetting where name = 'afilliate_progr' and value!= 'PAS' limit 1")) >0){
				      $program = db_fetch_array(db_query("select * from sitesetting where name = 'afilliate_progr' and value!= 'PAS' limit 1"));
				      include("include/addons/$program[2]/affilliate_lead.php");
				      $showanstitle = 4;
					  $shoansanswer = 7;   
			  }
      }

	payout_splash($_REQUEST['email']);
        $verifycode = md5($username);
        $qryins = "Insert into registration (username, firstname, lastname, sex, birth_date, email, password, terms_condition, privacy, newsletter, " .
                "sponser, addressline1, addressline2, city, state, postcode, country, phone, registration_date, account_status, registration_ip, verifycode) " .
                "values ('$username', '$fname', '$lname', '$gender', '$bdate', '$email', '$pass', $terms, 1, $news, " .
                "'$referrerid', '$addressline1', '$addressline2', '$city', '$state', '$postcode', '$countrycode', '$phoneno', NOW(), 0, '" . $_SERVER["REMOTE_ADDR"] . "', '$verifycode')";
        db_query($qryins);
        echo db_error();
        $_SESSION["uid"] = db_insert_id();
        if(!empty($_REQUEST['social_verify'])){
	   db_query("insert into social_avatar(id, user_id, $_REQUEST[social_verify], pointer, time) values(null, '$_SESSION[uid]', '" . mysql_real_escape_string($picture) . "', '$_REQUEST[social_verify]', NOW());");
	    echo db_error();
        }
        if(!empty($user_image)){
	    @db_query("alter table registration modify column avatar varchar(500) null default ''");
	    db_query("update registration set avatar = '$user_image' where id = '$_SESSION[uid]'");
	}
	
	db_query("update registration set facebook = '$email', google='$email', twitter = '$email' where id='$_SESSION[userid]'");
        //fedora add at 2001.1.11
        $db = new DBMysql();
        $coupondb = new Coupon($db);
        $result = $coupondb->selectAssignedUniversal();
        if ($result != false && db_num_rows($result) > 0) {
            $userCoupondb = new UserCoupon($db);
            while ($coupon = db_fetch_object($result)) {
                $userCoupondb->insert($_SESSION["uid"], $coupon->id, $coupon->couponcode);
            }
        }
        //end fedora add
        $emailcont = getEmailContent(6);
        $subject = getEmailSubject(6);
        $username1 = base64_encode($username);
        $uid1 = base64_encode($uid);
        $pass1 = base64_encode($pass);
        $emailcont1 = sprintf($emailcont, $fname, $lname, $email, $username, $_SESSION["uid"], $verifycode);
        $from = $adminemailadd;
        SendHTMLMail($email, $subject, $emailcont1, $from);
	if(db_num_rows(db_query("select * from sitesetting where name = 'affilliate_prog'")) >= 1){
	      $aff= db_query("select * from sitesetting where name = 'affilliate_prog'");
	      while($aff_row =db_fetch_array($aff)){
		  include_once("include/addons/$aff_row[value]/registration.php");
	      }
	}
	header("location: password.php?auc_key=$verifycode");
	exit;   
    }
}
if(!empty($_SESSION['userid'])){
      $uid = $_SESSION['userid'];
}else{
      $uid = 0;
}
$changeimage = "home";
$pagename = "index";
if (!isset($_SESSION["ipid"]) && !isset($_SESSION["login_logout"])) {
    $_SESSION["ipid"] = date("Y-m-d G:i:s");
    $_SESSION["ipaddress"] = $_SERVER['REMOTE_ADDR'];
    $qryipins = "Insert into login_logout (ipaddress,load_time) values('" . $_SESSION["ipaddress"] . "', '" . $_SESSION["ipid"] . "')";
    db_query($qryipins);
}
$featuredcount = Sitesetting::getFeaturedAuctionCount();
if(empty($_REQUEST['pgno'])){
		    $PageNo = 0;
		    }else{
		    $PageNo = $_REQUEST['pgno'];
		    }

if(!empty($co)){
$exclude = "and a.auctionID not in ( $co )";
}else{
$exclude = '';
}
$qryauc = "select adt.auc_due_price,adt.auc_due_time,a.auctionID,a.productID as productID,a.categoryID as categoryID,auc_start_price,auc_final_price,auc_start_date,auc_end_date,auc_start_time,auc_end_time,auc_status,auc_type,auc_recurr,buy_user,
        auc_fixed_price,fixedpriceauction,pennyauction,nailbiterauction,offauction,nightauction,openauction,lockauction,time_duration,auc_final_end_date,total_time,pause_status,shipping_id,future_tstamp,recurr_count,auction_min_price,min_win_price,
        use_free,allowbuynow,buynowprice,reverseauction,uniqueauction,halfbackauction,seatauction,cashauction,reserve,minseats,maxseats,seatbids,bidpack,a.tax1,a.tax2,bidpack_name,bidpack_banner,bidpack_price,price,p.name,p.picture1,(select count(id) from unique_bid u where u.auctionid=a.auctionID) as ubidcount,
        (select count(id) from auction_seat st where st.auction_id=a.auctionID) as seatcount " . "from auction a " .
        "left join products p on a.productID=p.productID and a.bidpack=0 left join bidpack b on b.id=a.productID and a.bidpack=1 left join auc_due_table adt on a.auctionID=adt.auction_id " .
        "where adt.auc_due_time>0 and a.auc_status='2' $exclude order by adt.auc_due_time limit $PageNo, $featuredcount";

$resauc = db_query($qryauc);

$totalauc = db_num_rows($resauc);
include("functions.php");
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
    <?php  include($BASE_DIR . "/page_headers.php"); ?>
    
    <script>
     $("#registration").submit(function(){                    
                    var valid=true;
                    valid = checkRequired($('#firstname')) && valid;

                    valid = checkRequired($('#lastname')) && valid;
		    if($('#date').length > 0 & $('#month').length > 0 & $('#year').length > 0){
			valid=checkRequiredValue($('#date'),'dd','<?php echo SELECT_BIRTHDAY_DATE; ?>') && valid;
			valid=checkRequiredValue($('#month'),'mm','<?php echo SELECT_BIRTHDAY_DATE; ?>') && valid;
			valid=checkRequiredValue($('#year'),'yyyy','<?php echo SELECT_BIRTHDAY_DATE; ?>') && valid;
		    }
                   
                    valid=checkRequiredLength($('#rusername'),6,'<?php echo BE_AT_LEAST_6_CHARACTERS_LONG; ?>') && valid;
                    valid=checkRequiredLength($('#rpassword'),6,'<?php echo BE_AT_LEAST_6_CHARACTERS_LONG; ?>') && valid;

                    valid=checkRequired($('#rndcode')) && valid;

                    if($('#rpassword').val().length>0){
                        valid=checkMatched($('#cnfpassword'),$('#rpassword'),'<?php echo PASSWORD_MISMATCH; ?>') && valid;
                    }

                    valid=validateEmail($('#email')) && valid;

                    if($('#email').val().length>0){
                        valid=checkMatched($('#cnfemail'),$('#email'),'<?php echo EMAIL_ADDRESS_MISMATCH; ?>') && valid;
                    }

                    if(valid==false){
                        showAlertBox('<?php echo PLESE_CHECK_YOUR_INPUT; ?>');
                        return false;
                    }

                    if($('#terms').attr('checked')==false){
                        showAlertBox("<?php echo PLEASE_ACCEPT_OUT_TERMS_CONDITIONS; ?>");
                        return false;
                    }

                   /* if($('#privacy').attr('checked')==false){
                        showAlertBox("<?php echo PLEASE_ACCEPT_OUT_PRIVACY_POLICY; ?>");
                        return false;
                    }    */               
                    return true;
                });
               function checkMatched(obj,obj2,msg){
                if($(obj).val()!=$(obj2).val()){
                    $(obj).next('span').removeClass('PASS');
                    if($(obj).next('span').hasClass('FAIL')){
                        return false;
                    }else{
                        $(obj).next('span').hide().addClass("FAIL").text(msg).fadeIn(200);
                    }
                    return false;
                }else{
                    $(obj).next('span').removeClass('FAIL');
                    if($(obj).next('span').hasClass('PASS')){
                        return true;
                    }else{
                        $(obj).next('span').hide().addClass("PASS").text('').fadeIn(200);
                    }
                    return true;
                }
            }
            function validateEmail(obj){
                reg=/^[\w-]+(?:\.[\w-]+)*@(?:[\w-]+\.)+[a-zA-Z]{2,7}$/;
                if(!reg.test($(obj).val())){
                    $(obj).next('span').removeClass('PASS');
                    if($(obj).next('span').hasClass('FAIL')){
                        return false;
                    }else{
                        $(obj).next('span').hide().addClass("FAIL").text('<?php echo PLEASE_VALID_EMAIL_ADDRESS; ?>').fadeIn(200);
                    }
                    return false;
                }else{
                    $(obj).next('span').removeClass('FAIL');
                    if($(obj).next('span').hasClass('PASS')){
                        return true;
                    }else{
                        $(obj).next('span').hide().addClass("PASS").text('').fadeIn(200);
                    }
                    return true;
                }
            }
            function checkRequiredLength(obj,length,msg){
                if($(obj).val().length<length){
                    $(obj).next('span').removeClass('PASS');
                    if($(obj).next('span').hasClass('FAIL')){
                        return false;
                    }else{
                        $(obj).next('span').hide().addClass("FAIL").text(msg).fadeIn(200);
                    }
                    return false;
                }else{
                    $(obj).next('span').removeClass('FAIL');
                    if($(obj).next('span').hasClass('PASS')){
                        return true;
                    }else{
                        $(obj).next('span').hide().addClass("PASS").text('').fadeIn(200);
                    }
                    return true;
                }
            }
            function checkRequiredValue(obj,val,msg){
                if($(obj).val()==val){
                    $(obj).next('span').removeClass('PASS');
                    if($(obj).next('span').hasClass('FAIL')){
                        return false;
                    }else{
                        $(obj).next('span').hide().addClass("FAIL").text(msg).fadeIn(200);
                    }
                    return false;
                }else{
                    $(obj).next('span').removeClass('FAIL');
                    if($(obj).next('span').hasClass('PASS')){
                        return true;
                    }else{
                        $(obj).next('span').hide().addClass("PASS").text('').fadeIn(200);
                    }
                    return true;
                }
            }


            function checkRequired(obj){
                if($(obj).val().length==0){                    
                    $(obj).next('span').removeClass('PASS');
                    if($(obj).next('span').hasClass('FAIL')){
                        return false;
                    }else{
                        $(obj).next('span').hide().addClass("FAIL").text('<?php echo REQUIRED_FILED; ?>').fadeIn(200);
                    }
                    return false;
                }else{
                    $(obj).next('span').removeClass('FAIL');
                    if($(obj).next('span').hasClass('PASS')){
                        return true;
                    }else{
                        $(obj).next('span').hide().addClass("PASS").text('').fadeIn(200);
                    }
                    return true;
                }
            }
function pwd_test_password(passwd) {	
  var intScore   = 0
  var strVerdict = "unsicher"
  var strLog     = ""
		
  // PASSWORD LENGTH
  if (passwd.length<5) {
    intScore = (intScore+3)
  } else if (passwd.length>4 && passwd.length<8) {
    intScore = (intScore+6)
  } else if (passwd.length>7 && passwd.length<16) {
    intScore = (intScore+12)
  } else if (passwd.length>15) {
    intScore = (intScore+18)
  }

  if (passwd.match(/[a-z]/)) {
    intScore = (intScore+1)
  }
		
  if (passwd.match(/[A-Z]/)) {
    intScore = (intScore+5)
  }
		
  if (passwd.match(/\d+/)) {
    intScore = (intScore+5)
  }
		
  if (passwd.match(/(.*[0-9].*[0-9].*[0-9])/)) {
    intScore = (intScore+5)
  }

  if (passwd.match(/.[!,@,#,$,%,^,&,*,?,_,~]/)) {
    intScore = (intScore+5)
  }
		
  if (passwd.match(/(.*[!,@,#,$,%,^,&,*,?,_,~].*[!,@,#,$,%,^,&,*,?,_,~])/)) {
    intScore = (intScore+5)
  }

  if (passwd.match(/([a-z].*[A-Z])|([A-Z].*[a-z])/)) {
    intScore = (intScore+2)
  }

  if (passwd.match(/([a-zA-Z])/) && passwd.match(/([0-9])/)) {
    intScore = (intScore+2)
  }
 
  if (passwd.match(/([a-zA-Z0-9].*[!,@,#,$,%,^,&,*,?,_,~])|([!,@,#,$,%,^,&,*,?,_,~].*[a-zA-Z0-9])/)) {
    intScore = (intScore+2)
  }

  if(intScore < 16) {
    strVerdict = "Weak";
    strColor = "red";
  } else if (intScore > 10 && intScore < 15) {
    strVerdict = "Weak";
    strColor = "red";
  } else if (intScore > 14 && intScore < 25) {
    strVerdict = "Medium";
    strColor = "#ffd801";
  } else if (intScore > 24 && intScore < 35) {
    strVerdict = "Strong";
    strColor = "orange";
  } else {
    strVerdict = "Very strong";
    strColor = "#3bce08";
  }
	
  ctlBar = document.getElementById("pwd_bar");
  ctlText = document.getElementById("pwd_text");

  nRound = (intScore*2);
  if (nRound > 100) {
    nRound = 100;
  }

  ctlBar.style.width = nRound + "%";
  ctlBar.style.backgroundColor = strColor;
  ctlText.innerHTML = "<span style='color: " + strColor + ";'>" + strVerdict + "</span>";
}

	</script>
	<style>
	#content_modal ul {
	    background-color: #CACACA;
	    border-radius: 10px;
	    color: #FF0000 !important;
	    font-size: 12px !important;
	    list-style: none outside none;
	    margin: 0;
	    padding: 2px 20px 0;
	    position: absolute;
	    text-align: left;
	    width: 530px;
	  }
	#content_modal ul li {
	    color:red;
	 }
	</style>
    </head>
    <body class="homepage" onload="OnloadPage();">
    <?php

     foreach($addons as $key => $value){
		if(file_exists($BASE_DIR . "/include/addons/$value/$template/top_bar.php")){
		   include_once($BASE_DIR . "/include/addons/$value/$template/top_bar.php");
		}else	if(file_exists($BASE_DIR . "/include/addons/$value/top_bar.php")){
		    include_once($BASE_DIR . "/include/addons/$value/top_bar.php");
		}
	      }

$featuredcount = Sitesetting::getFeaturedAuctionCount();
if(empty($_REQUEST['pgno'])){
		    $PageNo = 0;
		    }else{
		    $PageNo = $_REQUEST['pgno'];
		    }
//if ( $_GET["ref"] != "" ) $_SESSION["refid"] = $_GET["ref"];
//first six products get by this query
if(!empty($co)){
$exclude = "and a.auctionID not in ( $co )";
}else{
$exclude = '';
}
$qryauc = "select adt.auc_due_price,adt.auc_due_time,a.auctionID,a.productID as productID,a.categoryID as categoryID,auc_start_price,auc_final_price,auc_start_date,auc_end_date,auc_start_time,auc_end_time,auc_status,auc_type,auc_recurr,buy_user,
        auc_fixed_price,fixedpriceauction,pennyauction,nailbiterauction,offauction,nightauction,openauction,lockauction,time_duration,auc_final_end_date,total_time,pause_status,shipping_id,future_tstamp,recurr_count,auction_min_price,min_win_price,
        use_free,allowbuynow,buynowprice,reverseauction,uniqueauction,halfbackauction,seatauction,cashauction,reserve,minseats,maxseats,seatbids,bidpack,a.tax1,a.tax2,bidpack_name,bidpack_banner,bidpack_price,price,p.name,p.picture1,(select count(id) from unique_bid u where u.auctionid=a.auctionID) as ubidcount,
        (select count(id) from auction_seat st where st.auction_id=a.auctionID) as seatcount " . "from auction a " .
        "left join products p on a.productID=p.productID and a.bidpack=0 left join bidpack b on b.id=a.productID and a.bidpack=1 left join auc_due_table adt on a.auctionID=adt.auction_id " .
        "where adt.auc_due_time>0 and a.auc_status='2' $exclude order by adt.auc_due_time limit $PageNo, $featuredcount";

$resauc = db_query($qryauc);

$totalauc = db_num_rows($resauc);
echo db_error();
	   ?>
	<div id="main">
	   <?php include("header.php"); ?>
	
            <div id="container">
            <div id="column-left">
                <?php include($BASE_DIR . "/include/topmenu.php"); ?>
                 
                <?php include($BASE_DIR . "/include/addons/auction_boxes/exhibia/index.php");  ?>
		<script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
		<!-- the jScrollPane script -->
		<script type="text/javascript" src="js/jquery.mousewheel.js"></script>
		<script type="text/javascript" src="js/jquery.contentcarousel.js"></script>
		<script type="text/javascript">
			$('#escroe_results').contentcarousel();
			
		</script>
	    </div>
	    <div id="column-right">
	      <?php include("$BASE_DIR/include/exhibia/column-right.php"); ?>
	    </div>
	 </div>
	 <?php include("$BASE_DIR/include/exhibia/footer.php"); ?>
      </div>
    </body>
    <?php
    	      
    if(!empty($errorMsg)){
    ?>
      <script>
	  if($('#content_modal').length== 0){
	        if($('#content_modal').length== 0){
		  $('body').append('<div id="content_modal"></div>');
		  $('#content_modal').dialog({
		      autoOpen: false,
		      width:600,
		      height:550,
		      title: 'sign up',
		      modal: true
		  });
		}
	    $('#content_modal').prepend('<ul><img src="img/close.gif" onclick="$(this).parent().remove();" style="float:right;" /><?php echo $errorMsg; ?></ul>');
	    $('#content_modal').dialog('open');
	  }      
      </script>
     <?php
    }
    ?>
    <?php
     switch($_REQUEST['social_verify']){
	case('facebook'):
	    if ($fb_error == 'true') {
	    ?>
	      <script>
	      $(document).ready(function(){
	     
		  modal('include/social_register.php?social_verify=<?php echo $_REQUEST['social_verify']; ?>');
			$('#firstname').blur(function(){checkRequired($(this));});
			$('#lastname').blur(function(){checkRequired($(this));});
			$('#date').blur(function(){checkRequiredValue($(this),'dd','<?php echo SELECT_BIRTHDAY_DATE; ?>');});
			$('#month').blur(function(){checkRequiredValue($(this),'mm','<?php echo SELECT_BIRTHDAY_DATE; ?>');});
			$('#year').blur(function(){checkRequiredValue($(this),'yyyy','<?php echo SELECT_BIRTHDAY_DATE; ?>');});

		      
			$('#rusername').blur(function(){checkRequiredLength($(this),6,'<?php echo BE_AT_LEAST_6_CHARACTERS_LONG; ?>');});
			$('#rpassword').blur(function(){checkRequiredLength($(this),6,'<?php echo BE_AT_LEAST_6_CHARACTERS_LONG; ?>');});

			$('#cnfpassword').blur(function(){checkMatched($(this),$('#rpassword'),'<?php echo PASSWORD_MISMATCH; ?>');});
			$('#email').blur(function(){validateEmail($(this));});

			$('#cnfemail').blur(function(){checkMatched($(this),$('#email'),'<?php echo EMAIL_ADDRESS_MISMATCH; ?>');});

			$('#rndcode').blur(function(){checkRequired($(this));});
	      });
	      </script>
	    <?php  
	    }else{
	      mysql_query("update registration set facebook = '$userInfo[email]' where id='$_SESSION[userid]'");
	    }
	break;
	case('google'):
	    if ($g_error == true) {
	    ?>
	      <script>
	      $(document).ready(function(){
	    
		  modal('include/social_register.php?social_verify=<?php echo $_REQUEST['social_verify']; ?>&code=<?php echo $_GET['code'];?>');
			$('#firstname').blur(function(){checkRequired($(this));});
			$('#lastname').blur(function(){checkRequired($(this));});
			$('#date').blur(function(){checkRequiredValue($(this),'dd','<?php echo SELECT_BIRTHDAY_DATE; ?>');});
			$('#month').blur(function(){checkRequiredValue($(this),'mm','<?php echo SELECT_BIRTHDAY_DATE; ?>');});
			$('#year').blur(function(){checkRequiredValue($(this),'yyyy','<?php echo SELECT_BIRTHDAY_DATE; ?>');});

		      
			$('#rusername').blur(function(){checkRequiredLength($(this),6,'<?php echo BE_AT_LEAST_6_CHARACTERS_LONG; ?>');});
			$('#rpassword').blur(function(){checkRequiredLength($(this),6,'<?php echo BE_AT_LEAST_6_CHARACTERS_LONG; ?>');});

			$('#cnfpassword').blur(function(){checkMatched($(this),$('#rpassword'),'<?php echo PASSWORD_MISMATCH; ?>');});
			$('#email').blur(function(){validateEmail($(this));});

			$('#cnfemail').blur(function(){checkMatched($(this),$('#email'),'<?php echo EMAIL_ADDRESS_MISMATCH; ?>');});

			$('#rndcode').blur(function(){checkRequired($(this));});		  
	      });
	      </script>
	    <?php  
	    }else{
	      mysql_query("update registration set google = '$userInfo[email]' where id='$_SESSION[userid]'");
	    }
	break;
	case('twitter'):
	    if ($fb_error == true) {
	    ?>
	      <script>
	      //$(document).ready(function(){
		  modal('include/addons/twitter/register.php?social_verify=<?php echo $_REQUEST['social_verify']; ?>');
			$('#firstname').blur(function(){checkRequired($(this));});
			$('#lastname').blur(function(){checkRequired($(this));});
			$('#date').blur(function(){checkRequiredValue($(this),'dd','<?php echo SELECT_BIRTHDAY_DATE; ?>');});
			$('#month').blur(function(){checkRequiredValue($(this),'mm','<?php echo SELECT_BIRTHDAY_DATE; ?>');});
			$('#year').blur(function(){checkRequiredValue($(this),'yyyy','<?php echo SELECT_BIRTHDAY_DATE; ?>');});

		      
			$('#rusername').blur(function(){checkRequiredLength($(this),6,'<?php echo BE_AT_LEAST_6_CHARACTERS_LONG; ?>');});
			$('#rpassword').blur(function(){checkRequiredLength($(this),6,'<?php echo BE_AT_LEAST_6_CHARACTERS_LONG; ?>');});

			$('#cnfpassword').blur(function(){checkMatched($(this),$('#rpassword'),'<?php echo PASSWORD_MISMATCH; ?>');});
			$('#email').blur(function(){validateEmail($(this));});

			$('#cnfemail').blur(function(){checkMatched($(this),$('#email'),'<?php echo EMAIL_ADDRESS_MISMATCH; ?>');});

			$('#rndcode').blur(function(){checkRequired($(this));});		  
	      //});
	      </script>
	    <?php  
	    }else{
	      mysql_query("update registration set twitter = '$userInfo[email]' where id='$_SESSION[userid]'");
	    }
	break;
    }
    ?>
</html>
