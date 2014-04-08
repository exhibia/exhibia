<?php
include("config/connect.php");
include("functions.php");
include("sendmail.php");
include("email.php");

if($_POST["submit"]!="") {
    $email = $_POST["email"];
    $qrysel = "select * from registration where email='$email' and user_delete_flag!='d'";
    $ressel = db_query($qrysel);
    $total = db_num_rows($ressel);
    $obj = db_fetch_object($ressel);
    $fname = $obj->firstname;
    $username =$obj->username;
    $uid = $obj->id;
    $pass = $obj->password;
    $session_id = session_id();

    if($total>0 && $obj->account_status!='0') {
        $emailcont = getEmailContent(12);
        $subject = getEmailSubject(12);
        $username1 = base64_encode($username);
        $pass1 = base64_encode($pass);

        $emailcont1 = sprintf($emailcont,$fname,$username,$pass1,$session_id,$username1);
        $from=$adminemailadd;
        
        SendHTMLMail($email,$subject,$emailcont1,$from);
    }
    elseif($obj->account_status=='0') {
        $msg = 2;
    }
    else {
        $msg = 1;
    }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <?php include("page_headers.php"); ?>
        <script language="javascript">
            function check()
            {
                if(document.forgot.email.value=="")
                {
                    alert("<?php echo PLEASE_ENTER_EMAIL_ADDRESS; ?>");
                    document.forgot.email.focus();
                    document.forgot.email.select();
                    return false;
                }
                else
                {
                    if(!validate_email(document.forgot.email.value,"<?php echo PLEASE_ENTER_VALID_EMAIL_ADDRESS; ?>"))
                    {
                        document.forgot.email.select();
                        return false;
                    }
                }
            }
            function validate_email(field,alerttxt){
                with (field){
                    var value;
                    value = document.forgot.email.value;
                    apos=value.indexOf("@");
                    dotpos=value.lastIndexOf(".");
                    if (apos<1||dotpos-apos<2){
                        alert(alerttxt);return false;
                    }else{
                        return true;
                    }
                }
            }
        </script>
    </head>

    <body onload="OnloadPage();" class="single">
         <?php
	      foreach($addons as $key => $value){

		if(file_exists("include/addons/$value/$template/top_bar.php")){
		
		    include("include/addons/$value/$template/top_bar.php");
		}else
		if(file_exists("include/addons/$value/top_bar.php")){
		

		    include_once("include/addons/$value/top_bar.php");

		}


	      }
	      if(file_exists($BASE_DIR . "/include/$template/user_pages/" . basename($_SERVER['PHP_SELF'])  )  ) {
	
		include($BASE_DIR . "/include/$template/user_pages/" . basename($_SERVER['PHP_SELF']));
		}else
	      if(file_exists($BASE_DIR . "/include/$template/" . basename($_SERVER['PHP_SELF'])  )  ) {
	
		include($BASE_DIR . "/include/$template/" . basename($_SERVER['PHP_SELF']));
		}else{
		
		include($BASE_DIR . "/include/user_pages/" . basename($_SERVER['PHP_SELF']));
		
		}
	  ?>    
    </body>
</html>