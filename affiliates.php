<?php
include("config/connect.php");
include("session.php");
include("functions.php");

include("email.php");

$changeimage = "myaccount";
$uid = $_SESSION["userid"];

$changeimage = "myaccount";
$uid = $_SESSION["userid"];
db_query("CREATE TABLE IF NOT EXISTS refer_points (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dsipensed` int(11) NOT NULL,
   `bid_points` text not null,
  `userid` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `index` (`id`)
);");
@db_query("alter table refer_points add column reason text not null");


$bid_info = db_fetch_object(db_query("SELECT * from refer_points_admin where retrieve_condition = 'For refering a friend'"));

if(empty($bid_info->num_times_to_dispense)){
$bid_info->num_times_to_dispense = 0;
}
if(empty($bid_info->bid_points)){
$bid_info->bid_points = 0;
}


if(db_num_rows(db_query("SELECT * FROM refer_points where userid = '$uid' and reason = 'For refering a friend'")) <= $bid_info->num_times_to_dispense){



db_query("INSERT INTO refer_points values(null, '" . $bid_info->num_times_to_dispense . "', '" . $bid_info->bid_points . "', '$uid', 'For refering a friend');");
echo db_error();
      
$qrysel1 = "select * from registration where id='" . $_SESSION['userid'] . "'";
        $ressel1 = db_query($qrysel1);

        $objreg = db_fetch_array($ressel1);

                $final_bids = $objreg["free_bids"];
                $totalbids = $final_bids + $bonusbid;

                $qryupd = "update registration set free_bids='" . $totalbids . "' where id='" . $_SESSION['userid'] . "'";
                db_query($qryupd);


	       $qryins = "Insert into free_account (user_id,bidpack_buy_date,bid_count,bid_flag,recharge_type,credit_description) values('" . $_SESSION['userid'] . "',NOW(),'" . $bid_info->bid_points . "','c','ad','For refering a friend')";
	      
		db_query($qryins);

} 
if ($_POST["send"] != "") {
    $qrysel = "select * from registration where id='" . $uid . "'";
    $ressel = db_query($qrysel);
    $obj = db_fetch_object($ressel);

    $emailaddresses = $_POST["emailaddresses"];
    $email = split(',', $emailaddresses);
    $totalemail = count($email);

    for ($i = 0; $i < $totalemail; $i++) {
        $mailrecieved = $obj->firstname;

        $emailcont = getEmailContent(1);
        $subject = getEmailSubject(1);

        $emailcont1 = sprintf($emailcont, $uid, $uid, $obj->firstname);

        $to = $email[$i];
        $from = $adminemailadd;

        SendHTMLMail($to, $subject, $emailcont1, $from);
    }
?>
    <script language="javascript" type="text/javascript">
        window.location.href='affiliate.php?sc=1';
    </script>
<?php
    exit;
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
