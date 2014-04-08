<?php

include("config/connect.php");

include("functions.php");




$uid = $_SESSION["userid"];	

$staticvar = "contact";

include("email.php");

if($_POST["send"]!="") {

    $to = $adminemailadd;

    if($uid!="") {

        $from = $_POST["emailaddress"];

        $name = $_POST["name"];

    }

    else {

        $from = $_POST["emailaddress"];

        $name = $_POST["name"];

    }



    $subject = "Question about ".$_POST["subject"];

    $auctionid = $_POST["auctionid"];

    $messagecontent = $_POST["messagecontent"];



    $content = sprintf(getEmailContent(2),$name,$from,$auctionid,$messagecontent);



    $email=$adminemailadd;



    SendHTMLMail($email,$subject,$content,$from);

    echo "<script language=javascript>

		window.location.href='feedback.php?suc=1';

		</script>";

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
        <script language="javascript">

            function Check()

            {

                if(document.feedback_email.emailaddress.value=="")

                {

                    alert("<?php echo PLEASE_ENTER_EMAIL_ADDRESS; ?>");

                    document.feedback_email.emailaddress.focus();

                    return false;

                }

                else

                {

                    if(!validate_email(document.feedback_email.emailaddress.value,"<?php echo PLEASE_ENTER_VALID_EMAIL_ADDRESS; ?>"))

                    {

                        document.feedback_email.emailaddress.select();

                        return false;

                    }

                }

                if(document.feedback_email.name.value=="")

                {

                    alert("<?php echo PLEASE_ENTER_NAME; ?>");

                    document.feedback_email.name.focus();

                    return false;

                }

                if(document.feedback_email.subject.value=="none")

                {

                    alert("<?php echo PLEASE_SELECT_YOUR_SUBJECT; ?>");

                    document.feedback_email.subject.focus();

                    return false;

                }

                if(document.feedback_email.messagecontent.value=="")

                {

                    alert("<?php echo PLEASE_ENTER_MESSAGECONTENT; ?>");

                    document.feedback_email.messagecontent.focus();

                    return false;

                }

            }



            function validate_email(field,alerttxt){

                with (field){

                    var value;

                    value = document.feedback_email.emailaddress.value;

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



    <body class="single">
  <?php
         
         
	      foreach($addons as $key => $value){

		if(file_exists("include/addons/$value/$template/top_bar.php")){
		
		    include("include/addons/$value/$template/top_bar.php");
		}else
		if(file_exists("include/addons/$value/top_bar.php")){
		

		    include_once("include/addons/$value/top_bar.php");

		}


	      }
	      if(file_exists($BASE_DIR . "/include/$template/cms_pages/" . basename($_SERVER['PHP_SELF'])  )  ) {
		include($BASE_DIR . "/include/$template/cms_pages/" . basename($_SERVER['PHP_SELF']));
		}else{
		
		include($BASE_DIR . "/include/cms_pages/" . basename($_SERVER['PHP_SELF']));
		
		}
		


	  ?>
    </body>
</html>