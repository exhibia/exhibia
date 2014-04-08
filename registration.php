<?php
include("config/connect.php");
include("sendmail.php");
include("functions.php");
include("email.php");
include_once 'data/usercoupon.php';
include_once 'data/coupon.php';
include_once 'common/dbmysql.php';
include_once 'common/sitesetting.php';
include_once 'data/bidaccount.php';
$changeimage = "register";

$errorMsg = '';

$referrerid = isset($_GET["ref"]) ? chkInput($_GET["ref"], 'i') : '';

if (isset($_POST["username"])) {
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

    $bdate = chkInput($_POST["month"] . "-" . $_POST["date"] . "-" . $_POST["year"], 's', 50);
    if (strlen($bdate) < 6) {
        $errorMsg.='<li>' . PLEASE_SELECT_BIRTH_DATE . '</li>';
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
// user duplication check
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
                "$referrerid, '$addressline1', '$addressline2', '$city', '$state', '$postcode', '$countrycode', '$phoneno', NOW(), 0, '" . $_SERVER["REMOTE_ADDR"] . "', '$verifycode')";
        db_query($qryins) or die(db_error());
        $_SESSION["uid"] = db_insert_id();
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
//		header("location: registration.php");

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
$resregmsg = db_query("select reg_message from general_setting where id=4");
$objregmsg = db_fetch_array($resregmsg);
db_free_result($resregmsg);
if(!empty($_REQUEST['affilliate_id'])){

$referrerid = $_REQUEST['affilliate_id'];


}
?>
<?php
if(empty($dont_show_left)){
$dont_show_left = array();
}
//Uncomment items below to remove them from ALL PAGES for ALL TEMPLATES SO LONG AS THEY ARE 100% USING THE NORMAL FRAMEWORK...IF NOT THEN LETS FIX THAT FIRST
//Skinny column
//$dont_show_left[] = 'testimonials';
//$dont_show_left[] = 'last_winner';
//$dont_show_left[] = 'right_social';
//$dont_show_left[] = 'coupon_menu';
//$dont_show_left[] = 'bidpack_menu';
//$dont_show_left[] = 'user_menu';
//$dont_show_left[] = 'help_menu';
//$dont_show_left[] = 'faq_menu';
//$dont_show_left[] = 'top_menu';
//$dont_show_left[] = 'search_box';
//$dont_show_left[] = 'category_menu';

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php include("page_headers.php"); ?>
        <link rel="stylesheet" href="css/EA_Form.css" media="screen,projection" type="text/css" />
	<script language="javascript" src="js/pwd_strength.js" type="text/javascript"></script>
        <script type="text/javascript" language="javascript">

            $(document).ready(function(){
                $("#registration").submit(function(){                    
                    var valid=true;
                    valid = checkRequired($('#firstname')) && valid;

                    valid = checkRequired($('#lastname')) && valid;

                    valid=checkRequiredValue($('#date'),'dd','<?php echo SELECT_BIRTHDAY_DATE; ?>') && valid;
                    valid=checkRequiredValue($('#month'),'mm','<?php echo SELECT_BIRTHDAY_DATE; ?>') && valid;
                    valid=checkRequiredValue($('#year'),'yyyy','<?php echo SELECT_BIRTHDAY_DATE; ?>') && valid;

                   
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

            function OpenPopUp(url) {
                window.open(url,'popupWindow','scrollbars=yes,resizable=yes,width=600,height=500,screenX=50,screenY=50,top=50,left=50')
            }
        </script>
          <?php
	  if(!empty($_COOKIE['affiliate_id'])){
	  $referrerid = $_COOKIE['affiliate_id'];
	  ?>
	  <script>
	   
	  $(document).ready(function(){
	    $('#referid').prop('disabled', 'true');
	  });

	  </script>
	  <?php
	  }else
	  if(!empty($_REQUEST['affiliate_id'])){
	  $referrerid = $_REQUEST['affiliate_id'];
	  ?>
	  <script>
	  $(document).ready(function(){
	    $('#referid').prop('disabled', 'true');
	  });
	  </script>
	  <?php
	  }else if(!empty($_POST['referid'])){
	  ?>
	  <script>
	  $(document).ready(function(){
	    $('#referid').val('<?php echo $_POST['referid']; ?>');
	  });	  
	  </script>
	  <?php
	  }else if(!empty($_REQUEST['ref'])){
	   ?>
	  <script>
	  $(document).ready(function(){
	    $('#referid').val('<?php echo $_REQUEST['ref']; ?>');
	  });	  
	  </script>
	  <?php
	  
	  
	  }
	  ?>
    </head>
    <body class="single">
    <?php
         foreach($addons as $key => $value){
		if(file_exists($BASE_DIR . "/include/addons/$value/$template/top_bar.php")){
		   include_once($BASE_DIR . "/include/addons/$value/$template/top_bar.php");
		}else	if(file_exists($BASE_DIR . "/include/addons/$value/top_bar.php")){
		    include_once($BASE_DIR . "/include/addons/$value/top_bar.php");
		}
	      }
      if(file_exists($BASE_DIR . "/include/$template/" . basename($_SERVER['PHP_SELF'])  )  ) {
		include($BASE_DIR . "/include/$template/" . basename($_SERVER['PHP_SELF']));
		}else{
		
		include($BASE_DIR . "/include/" . basename($_SERVER['PHP_SELF']));
		
		}
		


	  ?>
        
    </body>
</html>