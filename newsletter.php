<?php

include("config/connect.php");


include("functions.php");


include("email.php");



$changeimage = "myaccount";



$uid = $_SESSION["userid"];



if($_POST["subscribesubmit"]!="") {

    if($_POST["subemail"]=="") {

        $msg=3;

    }

    else {

        $qryupd = "update registration set newsletter_email='".$_POST["subemail"]."', newsletter='1' where id='$uid'";

        db_query($qryupd) or die(db_error());



        $emailcont = getEmailContent(8);

        $subject = getEmailSubject(8);



        $firstname = getUserFirstName($uid);



        $emailcont1 = sprintf($emailcont,$firstname);



        $email = $_POST["subemail"];

//		$subject=$lng_mailnewslettersubject;

        $from=$adminemailadd;



        SendHTMLMail($email,$subject,$emailcont1,$from);

        header("location: newsletter.php?msg=1");

    }

}



if($_POST["unsubscribesubmit"]!="") {

    if($_POST["unsubemail"]=="") {

        $msg=4;

    }

    else {



        $qrysel = "select * from registration where newsletter_email='".$_POST["unsubemail"]."' and id='".$uid."'";

        $ressel = db_query($qrysel);

        $total = db_num_rows($ressel);



        if($total==0) {

            $msg = 5;

        }

        else {

            $qryupd = "update registration set newsletter_email='', newsletter='0' where id='$uid'";

            db_query($qryupd) or die(db_error());

            header("location: newsletter.php?msg=2");

        }

    }

}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

    <head>

 <?php include("page_headers.php"); ?>
       

        <script language="javascript">

            function Check()

            {

                if(document.newsletter.subemail.value!="")

                {

                    if(!validate_email(document.newsletter.subemail.value,"<?php echo PLEASE_ENTER_VALID_EMAIL_ADDRESS; ?>"))                    
                    {

                        document.newsletter.subemail.focus();

                        return false;

                    }

                }

            }



            function Check1()

            {

                if(document.newsletter1.unsubemail.value!="")

                {

                    if(!validate_email(document.newsletter1.unsubemail.value,"<?php echo PLEASE_ENTER_VALID_EMAIL_ADDRESS; ?>"))

                    {

                        document.newsletter1.unsubemail.focus();

                        return false;

                    }

                }

            }



            function validate_email(field,alerttxt){

                with (field){

                    var value;

                    value = field;

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
	      if(file_exists($BASE_DIR . "/include/$template/user_pages/" . basename($_SERVER['PHP_SELF'])  )  ) {
		include($BASE_DIR . "/include/$template/user_pages/" . basename($_SERVER['PHP_SELF']));
		}else{
		
		include($BASE_DIR . "/include/user_pages/" . basename($_SERVER['PHP_SELF']));
		
		}
		


	  ?>
    </body>
</html>
