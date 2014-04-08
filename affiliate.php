<?php
include("config/connect.php");
include("session.php");
include("functions.php");

include("email.php");

$changeimage = "myaccount";
$uid = $_SESSION["userid"];

$changeimage = "myaccount";
$uid = $_SESSION["userid"];


if ($_POST["send"] != "") {
    $qrysel = "select * from registration where id='" . $uid . "'";
    $ressel = mysql_query($qrysel);
    $obj = mysql_fetch_object($ressel);

    $emailaddresses = $_POST["emailaddresses"];
    $email = explode(',', $emailaddresses);
    $totalemail = count($email);

    for ($i = 0; $i < $totalemail; $i++) {
    
    if (!filter_var($email[$i], FILTER_VALIDATE_EMAIL)) {
    
    
    }else{
        $mailrecieved = $obj->firstname;

        $emailcont = getEmailContent(1);
        $subject = getEmailSubject(1, $_SESSION['userid']);

     

        $to = $email[$i];
        $from = $adminemailadd;

        SendHTMLMail($to, $subject, $emailcont1, $from);
        
        }
    }
?>
    <script language="javascript" type="text/javascript">
        window.location.href='affiliate.php?sc=1';
    </script>
<?php
    exit;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
   <?php include("page_headers.php"); ?>
        <script language="javascript">
            function Check()
            {
                if(document.affiliate.emailaddresses.value=="")
                {
                    alert("<?php echo PLEASE_ENTER_EMAIL; ?>");
                    document.affiliate.emailaddresses.focus();
                    return false;
                }
                else
                {
                    values = document.affiliate.emailaddresses.value;
                    values2 = values.split(",");
                    for(i=0;i<values2.length;i++)
                    {
                        if(!validate_email(values2[i],"<?php echo PLEASE_ENTER_VALID_EMAIL; ?>"))
                        {
                            document.affiliate.emailaddresses.focus();
                            return false;
                        }
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
	      
	      if(file_exists($BASE_DIR . "/include/$template/" . basename($_SERVER['PHP_SELF'])  )  ) {
	
		include($BASE_DIR . "/include/$template/" . basename($_SERVER['PHP_SELF']));
		}else{
		
		include($BASE_DIR . "/include/" . basename($_SERVER['PHP_SELF']));
		
		}
	  ?>    
     
    </body>
</html>
