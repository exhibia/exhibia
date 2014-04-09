<?
session_start();
$active="Auctions";
include("connect.php");
include("admin.config.inc.php");
include("security.php");

if($_POST["submit"]!="") {
   /* $bonusbid = $_REQUEST["bonusbids"];
    $sql = "select * from auction_pause_management where id='2'";
    $res = db_query($sql) or die(db_error());
    if(0<db_num_rows($res)) {
        $qryupd = "update auction_pause_management set referral_bids='".$bonusbid."' where id='2'";
        db_query($qryupd) or die(db_error());

        header("location: message.php?msg=52");
        exit;
    }
    else {
        $qryins = "insert into auction_pause_management (referral_bids) values('".$bonusbid."')";
        db_query($qryins) or die(db_error());
        header("location: message.php?msg=53");
        exit;
    }*/
if(db_num_rows(db_query("SELECT id from refer_points_admin where retrieve_condition = 'Birthday'"))>=1){

db_query("delete from refer_points_admin where retrieve_condition = 'Birthday'");


}
db_query("insert into refer_points_admin values(null, '$_POST[birthday_bids_quantity]', '$_POST[birthday_bids]', 'Birthday');");



if(db_num_rows(db_query("SELECT id from refer_points_admin where retrieve_condition = 'For refering a friend'"))>=1){

db_query("delete from refer_points_admin where retrieve_condition = 'For refering a friend'");


}
db_query("insert into refer_points_admin values(null, '$_POST[refer_friend_bids_quantity]', '$_POST[refer_friend_bids]', 'For refering a friend');");
header("location: message.php?msg=refer");
exit;
}
		
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="imagetoolbar" content="no" />
        <title>Manage Referral Bonus Commission-<?php echo $ADMIN_MAIN_SITE_NAME ?></title>
        <link media="screen" rel="stylesheet" type="text/css" href="css/admin.css"  />
        <!--[if lte IE 6]><link media="screen" rel="stylesheet" type="text/css" href="css/admin-ie.css" /><![endif]-->
        <link type="text/css" href="css/cupertino/ui.all.css" rel="stylesheet" />
        <link type="text/css" href="css/cupertino/jquery-ui-1.7.3.custom.css" rel="stylesheet" />

        <!--[if lte IE 6]><link media="screen" rel="stylesheet" type="text/css" href="css/admin-ie.css" /><![endif]-->
        <script type="text/javascript" src="js/behaviour.js"></script>
        <script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
        <script type="text/javascript" src="js/ui/jquery-ui-1.7.2.custom.min.js"></script>
        <script type="text/javascript">
            function Check(f1)
            {
                /*if(document.f1.bonusbids.value=="")
                {
                    alert("Please Enter Bonus Bids");
                    document.f1.bonusbids.focus();
                    return false;
                }*/
            }
        </script>
    </head>

    <body>
        <!--[if !IE]>start wrapper<![endif]-->
        <div id="wrapper">
            <!--[if !IE]>start head<![endif]-->
            <div id="head">
                <?php include('include/header.php'); ?>
            </div>
            <!--[if !IE]>end head<![endif]-->

            <!--[if !IE]>start content<![endif]-->
            <div id="content">
                <!--[if !IE]>start page<![endif]-->
                <div id="page">
                    <div class="inner">
                        <!--[if !IE]>start section<![endif]-->
                        <div class="section">
                            <!--[if !IE]>start title wrapper<![endif]-->
                            <div class="title_wrapper">
                                <h2>Manage Referral Bonus Commission</h2>
                                <span class="title_wrapper_left"></span>
                                <span class="title_wrapper_right"></span>
                            </div>
                            <!--[if !IE]>end title wrapper<![endif]-->
                            <!--[if !IE]>start section content<![endif]-->
                            <div class="section_content">
                                <!--[if !IE]>start section content top<![endif]-->
                                <div class="sct">
                                    <div class="sct_left">
                                        <div class="sct_right">
                                            <div class="sct_left">
                                                <div class="sct_right">
                                                    <!--[if !IE]>start system messages<![endif]-->

                                                    <ul class="system_messages">
                                                        <li class="blue"><span class="ico"></span><strong class="system_title"><span class="required">*</span> Required Information</strong></li>
                                                    </ul>
<?php
    $sql = "SELECT * from refer_points_admin where retrieve_condition = 'For refering a friend'";
$res = db_query($sql) or die(db_error());
if(0<db_num_rows($res)) {
    $row = db_fetch_array($res);
   // $bonusbid = $row["referral_bids"];
$refer_friend_bids = $row['bid_points'];
$refer_friend_bids_quantity = $row['num_times_to_dispense'];

}
else {

    //$bonusbid = 0;

$refer_friend_bids = 0;
$refer_friend_bids_quantity = 0;
} 
  ?>
						<!--[if !IE]>end system messages<![endif]-->

                                                    <!--[if !IE]>start forms<![endif]-->
                                                    <form  name="f1" action="" method="post" onsubmit="return Check(f1)" class="search_form general_form">
                                                        <!--[if !IE]>start fieldset<![endif]-->
                                                        <fieldset>
                                                            <!--[if !IE]>start forms<![endif]-->
                                                            <div class="forms">                                                           

                                                                <!--[if !IE]>start row<![endif]-->
                                                             <!--   <div class="row">
                                                                    <label>Auction Specific Bonus Commission:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper">
                                                                            <input class="text" type="text" size="10" name="bonusbids" value="<?=$bonusbid;?>" />
                                                                        </span>
                                                                        <span class="currency">%</span>
                                                                        <span class="system required">*</span><br />For inviting a friend to a specific auction
                                                                    </div>
                                                                </div>-->
                                                                <!--[if !IE]>end row<![endif]-->                                                            
                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Points For Refering a Friend to <?php echo $ADMIN_MAIN_SITE_NAME; ?>:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper">
                                                                            <input class="text" type="text" size="10" name="refer_friend_bids" value="<?=$refer_friend_bids?>" />
                                                                        </span>
                                                                   <span class="currency">points</span>


                                                                        <span class="system required">*</span><br />
For inviting a friend to join the fun at <?php echo $ADMIN_MAIN_SITE_NAME; ?>     
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]--> 
                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Number of Times to Award User:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper">
                                                                            <input class="text" type="text" size="10" name="refer_friend_bids_quantity" value="<?=$refer_friend_bids_quantity?>" />
                                                                        </span>
                                                                   <span class="currency">numerical</span>


                                                                        <span class="system required">*</span>  
                                                                    </div>
                                                                </div>

                                                                <!--[if !IE]>end row<![endif]--> 
                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row" style="height:100px;">
                                                                    <div class="buttons">
                                                                        <ul>
                                                                            <li>
                                                                             
                                                                            </li>

                                                                        </ul>

                                                                    </div>
                                                                </div>
								
								
								
								
								
								
								
								
<?php
    $sql = "SELECT * from refer_points_admin where retrieve_condition = 'Birthday'";
$res = db_query($sql) or die(db_error());
if(0<db_num_rows($res)) {
    $row = db_fetch_array($res);
   // $bonusbid = $row["referral_bids"];
$birthday_bids = $row['bid_points'];
$birthday_bids_quantity = $row['num_times_to_dispense'];

}
else {

    //$bonusbid = 0;

$birthday_friend_bids = 0;
$birthday_bids_quantity = 0;
} 
  ?>								
								
								
								
								
								
								
								                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Birthday Points:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper">
                                                                            <input class="text" type="text" size="10" name="birthday_bids" value="<?=$birthday_bids?>" />
                                                                        </span>
                                                                   <span class="currency">points</span>


                                                                        <span class="system required">*</span><br />
For it being the user's birthday     
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]--> 
                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Number of Times to Award User:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper">
                                                                            <input class="text" type="text" size="10" name="birthday_bids_quantity" value="<?=$birthday_bids_quantity?>" />
                                                                        </span>
                                                                   <span class="currency">numerical</span>


                                                                        <span class="system required">*</span>  
                                                                    </div>
								  
                                                                </div>
							
                                                                <!--[if !IE]>end row<![endif]--> 
                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <div class="buttons">
                                                                        <ul>
                                                                            <li>
                                                                                <span class="button send_form_btn"><span><span>Submit</span></span><input name="submit" type="submit"/></span>

                                                                            </li>

                                                                        </ul>

                                                                    </div>
                                                                </div>
								<font color="red">This page may require additional files from Penny Auction Soft</font>
								<br /> Please contact Penny Auction Software for advanced conditions for rewarding points<br/>
								Points can be auto-rewarded for winning an auction, buying a a bid-pack or even more specific conditions <br />
								Like winning a specific auction
                                                                <!--[if !IE]>end row<![endif]-->
                                                            </div>
                                                            <!--[if !IE]>end forms<![endif]-->

                                                        </fieldset>
                                                        <!--[if !IE]>end fieldset<![endif]-->
                                                    </form>
                                                    <!--[if !IE]>end forms<![endif]-->

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
								
                                <!--[if !IE]>end section content top<![endif]-->
                                <!--[if !IE]>start section content bottom<![endif]-->
                                <span class="scb"><span class="scb_left"></span><span class="scb_right"></span></span>
                                <!--[if !IE]>end section content bottom<![endif]-->

                            </div>
                            <!--[if !IE]>end section content<![endif]-->
                        </div>
                        <!--[if !IE]>end section<![endif]-->

                    </div>
                </div>
                <!--[if !IE]>end page<![endif]-->
                <!--[if !IE]>start sidebar<![endif]-->
                <div id="sidebar">
                    <div class="inner">
                        <?php include 'include/leftside.php' ?>
                    </div>
                </div>
                <!--[if !IE]>end sidebar<![endif]-->

            </div>
            <!--[if !IE]>end content<![endif]-->

        </div>
        <!--[if !IE]>end wrapper<![endif]-->

        <!--[if !IE]>start footer<![endif]-->
        <div id="footer">
            <div id="footer_inner">
                <?php include 'include/footer.php'; ?>
            </div>
        </div>
        <!--[if !IE]>end footer<![endif]-->

    </body>
</html>