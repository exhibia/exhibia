<?php
include("config/connect.php");

include_once 'functions.php';

include_once 'include/advertisefunction.php';


$uid = isset($_SESSION["userid"]) ? $_SESSION["userid"] : 0;
$changeimage = "home";
$pagename = "index";
if (!isset($_SESSION["ipid"]) && !isset($_SESSION["login_logout"])) {

    $_SESSION["ipid"] = date("Y-m-d G:i:s");

    $_SESSION["ipaddress"] = $_SERVER['REMOTE_ADDR'];



    $qryipins = "Insert into login_logout (ipaddress,load_time) values('" . $_SESSION["ipaddress"] . "', '" . $_SESSION["ipid"] . "')";

    db_query($qryipins) or die(db_error());
}



//end for first nine products
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

    <head>

 <?php include("page_headers.php"); ?>

    </head>

    <body class="single">
    
    <?php include_once('include/' . $template . '/header.php'); ?>
			  <?php include_once("include/topmenu.php"); ?>
		  <div class="clear"></div>
               
        <div id="main">

           
		<div id="container">
         
                
                   
<!--custom_page--><h1 style="text-align:left"><img alt="" style="width: 276px; height: 100px; float: right; margin: 10px;" data-cke-saved-src="images/gunsbidlogo.png" src="images/gunsbidlogo.png">​FFL Fax Coversheet</h1><p style="text-align:left"><br></p><p style="text-align:left"><br><br></p><p style="text-align:left"><strong>Gunsbid.com Customer:</strong><br>Take this coversheet to your local dealer so that he can fax his FFL to us, this will speed up the transfer process.</p><p style="text-align:left">To: Gunsbid.com Customer Service</p><p style="text-align:left">Fax: 888.958.2112</p><p style="text-align:left">Dealer Company Name:</p><p style="text-align:left">Customer Order Number:</p><p style="text-align:left">Customer e-mail (used on customer’s order):</p><p style="text-align:left"><br><br></p><p style="text-align:left"><strong>Dealer:</strong><br>​Thank you for ending us your FFL. The ATF now allows you to fax or scan a signed copy of your FFL to us to accept a transfer of a firearm. You may also mail a copy, if you prefer, to</p><p style="margin-left:0.49in; text-align:left">Gunsbid.com</p><p style="margin-left:0.49in; text-align:left">7257 NW 4<sup>th</sup> Blvd. Suite 209</p><p style="margin-left:0.49in; text-align:left">Gainesville, Florida 32607</p><p style="margin-left:0.49in; text-align:left"><br></p><p style="text-align:left">Please make sure that the customer’s name is on your FFL that you send us so that we know for which order the transfer is for.</p><p style="text-align:left"><br></p><p style="text-align:left">We really do appreciate your assistance in this transaction. If you have any questions, or need help in any way, please contact us at <a data-cke-saved-href="mailto:support@gunsbid.com" href="mailto:support@gunsbid.com">support@gunsbid.com</a></p><p style="text-align:left"><br></p><p style="text-align:left">Sincerely,</p><p style="text-align:left"><br></p><p style="text-align:left"><strong>Gunsbid.com Customer Service</strong></p><!--custom_page-->

                <?php
              if(db_num_rows(db_query("select * from registration where id = '$_SESSION[userid]' and admin_user_flag >= 1")) >= 1){
              
              ?>
              <h2 onclick="javascript: add_blank_page('<?php echo basename($_SERVER['PHP_SELF']);?>');">Edit Page</h2>
              
              
              <?php
              }
              ?>
                </div>
              

              
            </div>
    
  

<?
include("include/footer.php");
?>
</body>
</html>