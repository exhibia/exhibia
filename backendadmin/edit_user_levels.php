<?php
if(!preg_match('/pennyauctionsoft/', $_SERVER['SERVER_NAME'])){
ini_set('display_errors', 1);
ob_start();
session_start();
$active="Users";
include("../config/config.inc.php");
include("security.php");

db_query("CREATE TABLE IF NOT EXISTS `user_levels` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_level` varchar(50) NOT NULL DEFAULT '0',
  `allowed_pages` longblob,
  
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;");
@db_query("alter table user_levels add column addons longblob");
if(db_num_rows(db_query("select * from user_levels")) == 0){

$this_dir = getcwd();
$master_directory = str_replace("/backendadmin", "", $this_dir);

    db_query("insert into user_levels values(null, 'admin', 'insert into user_levels (id, admin_level, pages) values(null, 'admin', '$this_dir/manageauctiontime.php,$this_dir/manageNewsletters.php,$this_dir/set_and_forget.php,$this_dir/assigncoupontouser.php,$this_dir/managereferralbid.php,$this_dir/templates.sql.php,$this_dir/managecommunity.php,$this_dir/config_setting.php,$this_dir/innerstore.php,$this_dir/edit_member.php,$this_dir/main.css,$this_dir/defaultdatabase.php,$this_dir/designsuite.php,$this_dir/headlinks.txt.php,$this_dir/managenews.php,$this_dir/order_report_print.php,$this_dir/managetax.php,$this_dir/manage_members.php,$this_dir/specialauction.php,$this_dir/sendmail.php,$this_dir/inneraccount.php,$this_dir/perhourreport.php,$this_dir/addauction.php,$this_dir/view_member_status.php,$this_dir/admincreditreport.php,$this_dir/addshippingcharge.php,$this_dir/addlanguage.php,$this_dir/endauction.php,$this_dir/forum.txt.php,$this_dir/productdetail.php,$this_dir/unsoldauction.php,$this_dir/
paypalsetting.php,$this_dir/managebuynow.php,$this_dir/confirmpayment.php,$this_dir/soldauction.php,$this_dir/registrationreport.php,$this_dir/banipaddress.php,$this_dir/config.inc.php,$this_dir/sitesetting.php,$this_dir/addhelptopic.php,$this_dir/view_member_statistics.php,$this_dir/redemptiondetails.php,$this_dir/editaccount.php,$this_dir/addadvertslide.php,$this_dir/changeauctiontime.php,$this_dir/session.php,$this_dir/addFAQ.php,$this_dir/manageredemption.php,$this_dir/order_buyitnow.php,$this_dir/finincialreport.php,$this_dir/example2csv.php,$this_dir/system.php,$this_dir/addcommunity.php,$this_dir/ioncube_encoder5,$this_dir/managehelptopic.php,$this_dir/useraddress.php,$this_dir/forumtopicedit.php,$this_dir/addbidpack.php,$this_dir/addauctiontime.php,$this_dir/addbiddinguser.php,$this_dir/regfreepoints.php,$this_dir/innerpayment.php,$this_dir/forumreplyedit.php,$this_dir/example_advanced.css,$this_dir/managevoucher.php,$this_dir/addcoupon_excel.php,$this_dir/logo.php,$this_dir/addforumcat.php,$this_dir/
rte.css,$this_dir/store.txt.php,$this_dir/addmembers.php,$this_dir/addvoucher.php,$this_dir/static.txt.php,$this_dir/style.css,$this_dir/menu.css,$this_dir/report.txt.php,$this_dir/ioncube_encoder53,$this_dir/voucherissue.php,$this_dir/bidderuseravatar.php,$this_dir/managebiddinguser.php,$this_dir/leftstore.php,$this_dir/autolister.enc.php,$this_dir/leftreport.php,$this_dir/manageautobidder.php,$this_dir/background.php,$this_dir/exportcsvcount.php,$this_dir/ajaxauction.php,$this_dir/process_background.php,$this_dir/leftstatic.php,$this_dir/manageadvertposition.php,$this_dir/pauseauction.php,$this_dir/addshippingstatus.php,$this_dir/leftside.php,$this_dir/users.txt.php,$this_dir/message.php,$this_dir/addcoupon.php,$this_dir/editor.js,$this_dir/defaultreport.php,$this_dir/manageFAQ.php,$this_dir/loginfreepoints.php,$this_dir/get_help.php,$this_dir/plugingeneral.php,$this_dir/design.txt.php,$this_dir/liveauctionreport.php,$this_dir/addforum.php,$this_dir/buynowsetting.php,$this_dir/page_headers.php,$this_dir/
defaultstatic.php,$this_dir/defaultforum.php,$this_dir/managereply.php,$this_dir/add_product.php,$this_dir/listuniversalcoupon.php,$this_dir/addredemption.php,$this_dir/examplecsv.php,$this_dir/process_logo.php,$this_dir/innerhome.php,$this_dir/download.php,$this_dir/defaultaccount.php,$this_dir/emailtemplateeditor.php,$this_dir/manageshippingtype.php,$this_dir/ipaddresshistory.php,$this_dir/member_stats.php,$this_dir/manageauctionpause.php,$this_dir/admin.config.inc.php,$this_dir/plugin.txt.php,$this_dir/innerdatabase.php,$this_dir/innerusers.php,$this_dir/addcategory.php,$this_dir/menu.js,$this_dir/pandl.php,$this_dir/pages.php,$this_dir/viewaffiliaterefferal.php,$this_dir/peddingorder.php,$this_dir/addavatar.php,$this_dir/defaultstore.php,$this_dir/managecoupon.php,$this_dir/function.js,$this_dir/autolister.php,$this_dir/framehead.php,$this_dir/addbonusbid.php,$this_dir/logout.php,$this_dir/managesocial.php,$this_dir/functions_s.php,$this_dir/addnews.php,$this_dir/html2xhtml.js,$this_dir/payment.txt.php,
$this_dir/main1.css,$this_dir/ratingfreepoints.php,$this_dir/innerforum.php,$this_dir/manageaffiliatepayment.php,$this_dir/account.txt.php,$this_dir/richtext.js,$this_dir/auctiondetails.php,$this_dir/reverse_registrationreport.php,$this_dir/addmembersnews.php,$this_dir/customizelanguage.php,$this_dir/manageadvertslide.php,$this_dir/languagesetting.php,$this_dir/error_log,$this_dir/validation.js,$this_dir/managespecial.php,$this_dir/getproductlist.php,$this_dir/gd.inc.php,$this_dir/getprice.php,$this_dir/curl.php,$this_dir/referralwonauctionreport.php,$this_dir/imgsize.php,$this_dir/video-help.png,$this_dir/defaulthome.php,$this_dir/export.csv,$this_dir/assigncoupon.php,$this_dir/makepayment.php,$this_dir/getcategorylist.php,$this_dir/addautobidder.php,$this_dir/inneremail.php,$this_dir/addshippingtype.php,$this_dir/affiliatereport.php,$this_dir/staticpages.php,$this_dir/auctionwisereport.php,$this_dir/innerplugin.php,$this_dir/manageforumcategory.php,$this_dir/password.php,$this_dir/generalsetting.php,$this_
dir/uploader.php,$this_dir/main.js,$this_dir/addspecial.php,$this_dir/autocredits.php,$this_dir/header.php,$this_dir/database_commands.sql,$this_dir/addsocial.php,$this_dir/edit_product.php,$this_dir/newsletter.php,$this_dir/order_wonauction.php,$this_dir/managebidpack.php,$this_dir/database.txt.php,$this_dir/edit_user_levels.php,$this_dir/invitersetting.php,$this_dir/getUserList.php,$this_dir/leftforum.php,$this_dir/manageforum.php,$this_dir/usercoupon.php,$this_dir/addproducts.php,$this_dir/leftaccount.php,$this_dir/manageproducts.php,$this_dir/innerreport.php,$this_dir/managescharge.php,$this_dir/leftdatabase.php,$this_dir/onlineuser.php,$this_dir/userdetail.php,$this_dir/addadvertgroup.php,$this_dir/manageavatar.php,$this_dir/delproducts.php,$this_dir/functions.php,$this_dir/security.php,$this_dir/managetopics.php,$this_dir/innerstatic.php,$this_dir/manageadvertgroup.php,$this_dir/process_addlanguage.php,$this_dir/email.txt.php,$this_dir/addauction2.php,$this_dir/body.js,$this_dir/managecat.php,$this_dir/
productwisereport.php,$this_dir/managemembersnews.php,$this_dir/connect.php,$this_dir/admin.cookie.php,$this_dir/manageauction.php,$this_dir/index.php,$this_dir/manageshippingcharge.php,$this_dir/popupimage.js,$this_dir/printingoutput.php,$this_dir/message.php,$this_dir/index.php,$this_dir/innerhome.php');");
    db_query("insert into user_levels values(null, 'designer', '');");
    db_query("insert into user_levels values(null, 'auctioneer', '$this_dir/innerstore.php,$this_dir/addauction.php,$this_dir/manageauction.php,$this_dir/soldauction.php,$this_dir/unsoldauction.php,$this_dir/managebuynow.php,,$this_dir/message.php,$this_dir/index.php,$this_dir/innerhome.php');");



}
if(!empty($_REQUEST['delete_level'])){

db_query("delete from user_levels where id = '$_REQUEST[delete_level]'");

}
if(!empty($_POST['admin_level'])){
$pages = '';

foreach($_POST['pages'] as $page){

$pages .= $page . ",";




}

$addons_in = '';
  
  foreach($_POST['addons'] as $addon){

$addons_in .= $addon . ",";




}
  
  
  
  
$pages .= getcwd() . "/index.php," . getcwd() . "/innerhome.php," . getcwd() . "/message.php";

  if(!empty($_POST['user_level']) | !empty($_POST['admin_level'])){
    if(db_num_rows(db_query("select * from user_levels where id = '$_POST[user_level]' or admin_level = '$_POST[admin_level]'")) >= 1){
    
	  if(!empty($_POST['user_level'])){
	 // echo "update user_levels set allowed_pages = '$pages', admin_level = '$_POST[admin_level]' where id = '$_POST[user_level]'";
	    db_query("update user_levels set allowed_pages = '$pages', addons = '$addons_in', admin_level = '$_POST[admin_level]' where id = '$_POST[user_level]'");
	    }else{
	    db_query("update user_levels set allowed_pages = '$pages', addons = '$addons_in, admin_level = '$_POST[admin_level]' where admin_level = '$_POST[admin_level]'");
	    
	    
	    }
  
      }else{
   
  
	db_query("insert into user_levels (id, admin_level, allowed_pages, addons) values(null, '$_POST[admin_level]', '$pages', '$addons_in')");
   
   
   
   }
   header("location: message.php?msg=added_level");
   exit;
}
}

if(!empty($_REQUEST['level']) && $_REQUEST['level'] != 'add' && db_num_rows(db_query("select * from user_levels where id = '" . $_REQUEST['level'] . "'")) == 0){

header("location: edit_user_levels.php");


exit;
}
 function getDirectoryList ($directory) 
  {
$not_needed = array('curl.php', 'functions.php', 'functions_s.php', 'config.inc.php', 'system.php', 'curl.php', 'download.php', 'admin.config.inc.php ', 'admin.cookie.php', 'connect.php', 'header.php', 'example2csv.php', 'examplecsv.php', 'logout.php', 'imgsize.php ', 'add_product.php', 'edit_product.php', 'imgsize.php', 'templates.sql.php', 'index.php', 'innerhome.php' );
    // create an array to hold directory list
    $results = array();

    // create a handler for the directory
    $handler = opendir($directory);

    // open directory and walk through the filenames
    while ($file = readdir($handler)) {

      // if file isn't this directory or its parent, add it to the results
      if ($file != "." && $file != ".." && ! is_dir($file) && preg_match('/\.php/', $file) && !preg_match('/\.txt\.php/', $file) && !in_array($file, $not_needed) && !preg_match('/left(.*?)\.php/', $file)) {
        $results[] = $file;
      }

    }
$results[] = 'message.php';
    // tidy up: close the handler
    closedir($handler);

    // done!
    return $results;

  }
@db_query("alter table registration add column afilliate tinyint(1)");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="imagetoolbar" content="no" />
        <title>Manage User Levels-<?php echo $ADMIN_MAIN_SITE_NAME ?></title>
        <link media="screen" rel="stylesheet" type="text/css" href="css/admin.css"  />
        
        <!--[if lte IE 6]><link media="screen" rel="stylesheet" type="text/css" href="css/admin-ie.css" /><![endif]-->
        <link type="text/css" href="css/cupertino/ui.all.css" rel="stylesheet" />
        <link type="text/css" href="css/cupertino/jquery-ui-1.7.3.custom.css" rel="stylesheet" />

        <!--[if lte IE 6]><link media="screen" rel="stylesheet" type="text/css" href="css/admin-ie.css" /><![endif]-->
        <script type="text/javascript" src="js/behaviour.js"></script>
        <script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
        <script type="text/javascript" src="js/ui/jquery-ui-1.7.2.custom.min.js"></script>
 
	
	<script type="text/javascript" src="js/ui/ui.dialog.min.js"></script>
        <!--[if lte IE 6]>
        <link href="css/menu_ie.css" rel="stylesheet" type="text/css" />
        <![endif]-->
      
        <style>
        #user_info {
        display:none;
        }
        </style>
        <script type="text/javascript">
        
        $(function () {
        $('#check_all').toggle(
        
	   function(){
	    
	      $('.pages').prop('checked', true);
	    
	    },
	    function(){
	    $('.pages').prop('checked', false);
	    
	    }
	    
	    );
        
        });
        </script>
    </head>

    <body>
    <div id="user_info"></div>
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
                        <div class="section table_section">
                            <!--[if !IE]>start title wrapper<![endif]-->
                            <div class="title_wrapper">
                                <h2>Manage User Levels</h2>
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
                                                  
                                                  
                                                              
                                                              
                                                                    
                                                                           <?php
                                                                           if(!empty($_REQUEST['level'])){
                                                                           ?>
                                                                        
                                 
                                                                          <form id="form2" name="form2" action="edit_user_levels.php" method="post">
                                                                           <fieldset style="margin-right:20px;">
                                                                           
                                                                           <?php
									      if($_REQUEST['edit_level'] != 'add'){
										  
										  $qry = db_fetch_array(db_query("select * from user_levels where id = '$_REQUEST[level]'"));
										  echo db_error();
										  $pages= explode(",", $qry['allowed_pages']);
										  $addons_set = explode(",", $qry['addons']);
									  
									      ?>
										      
									      <input type="hidden" name="user_level" value="<?php echo $qry['id']; ?>" />
									      <?php 
									      }else{
									      $pages = array();
									      
									      }
									  
									      ?>
									      
									   <br />
									   <br />
									   <!--[if !IE]>start forms<![endif]-->
									    <div class="forms">
										<!--[if !IE]>start row<![endif]-->
										<div class="row">
										    <h2>Level Name:</h2>
										    <div class="inputs">
											<span class="input_wrapper">
											
											      <input class="text" type="text" name="admin_level" value="<?php echo $qry['admin_level']; ?>"/>
											</span>
										    </div>
										  </div>
									      </div>
                                                                          <div class="forms">
                                                                          <div class="row" style="font-weight:bold;">
										    <h2>Allowed Addons:</h2>
										    <span style="font-weight:bold;min-width:900px;">Currently This is only working for Design Suite. And Many Addons have no benefit from this at all Any Ways</span>
										 
										  </div>
									      
                                                                           <table width="1100px">
									     
										  <?php
										  $i = 1;
										
										  
										  
										  foreach($addons as $addon){
										  if(!in_array($addon, $shown)){
										  if($i % 5 == 0){
										  ?>
										   <tr>
										   <?php } ?>
										      <td>
										      
										  
										
										 
										  
										  <input type="checkbox" name="addons[]" id="addons[]" value="<?php echo $addon; ?>" <?php
										  if(in_array($addon, $addons_set)){ echo 'checked'; } ?> class="pages" /><?php echo $addon; ?>
										  
										
										      </td>
										  <?php
										  
										      $i++;
										    if($i % 5 == 0){
										  ?>
										   <tr>
										   <?php } 
										   
										   $shown[] = $addon;
										   }
										   
										   ?>
										  <?php
										  
										  }
										  
										  
										  
										  ?>
										  
										  
									    </table>
										<!--[if !IE]>start row<![endif]-->
										<div class="row" style="font-weight:bold;">
										    <h2>Allowed Pages:</h2>
										    <span style="font-weight:bold;min-width:900px;">Selections Pre-Chosen Below Reflect Either Defaults Or Pages Containing Links To Admin Pages. <br />At the very least you should enable innerhome.php or this user level will not be able to follow any links.</span>
										    <br />
										    <input type="checkbox" id="check_all" />Select / Unselect All
										  </div>
									      </div>
                                                                           <table width="1100px">
									     
										  <?php
										  $i = 1;
										  
										  $files = getDirectoryList(getcwd());
										  sort($files);
										  
										  foreach($files as $file){
										  if($i % 5 == 0){
										  ?>
										   <tr>
										   <?php } ?>
										      <td>
										      
										      <?php
										
										  if(!preg_match('/\.txt\.php/', $file)){?>
										  
										  <input type="checkbox" name="pages[]" id="pages[]" value="<?php echo getcwd() . "/" . ltrim($file); ?>" <?php
										  if(in_array(getcwd() . "/" . ltrim($file), $pages)){ echo 'checked'; } ?> class="pages" /><?php echo $file; ?>
										  
										  <?php } ?>
										      </td>
										  <?php
										  
										      $i++;
										    if($i % 5 == 0){
										  ?>
										   <tr>
										   <?php } ?>
										  <?php
										  
										  }
										  
										  
										  
										  ?>
										  
										  
									    </table>
									          <div class="row">
                                                                    <div class="buttons">
                                                                        <ul>
                                                                            <li>
                                                                                <input type="hidden" name="editid" value="<?=$id?>"/>

                                                                                <span class="button send_form_btn"><span><span>Edit</span></span><input name="edit" type="submit"/></span>

                                                                            </li>

                                                                        </ul>

                                                                    </div>
                                                                </div>
									    </fieldset>
									 </form>
								
									      <?php
                                                                           }else{
                                                                           ?>
                                                                           <table width="600px">
                                                                           <?php
                                                                           $qry = db_query("select * from user_levels");
                                                                           
                                                                           while($row = db_fetch_array($qry)){
                                                                           ?>
                                                                           
                                                                           <tr>
                                                                           <td>
                                                                           <a href="edit_user_levels.php?level=<?php echo $row['id']; ?>" style="font-size:18px;"><?php echo $row['admin_level']; ?></a>
                                                                           
                                                                           </td>
                                                                           <td>
                                                                           
                                                                           <a href="edit_user_levels.php?delete_level=<?php echo $row['id']; ?>" style="font-size:13px;">Delete</a>
                                                                           
                                                                           
                                                                           </td>
                                                                           </tr>
                                                                           <?php
                                                                           }
                                                                           ?>
                                                                               <tr>
                                                                           <td>
                                                                           <a href="edit_user_levels.php?level=add" style="font-size:18px;">Add A User Level</a>
                                                                           
                                                                           </td>
                                                                           
                                                                           </tr>
                                                                        </tbody>
                                                                    </table>
                                                                    <?php
                                                                           }
                                                                           ?>
                                                                           
                                                                         
                                                                
                                                            
                                                 

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
									  <script>
                                                                            $('a[title]').qtip();
                                                                               </script>
    </body>
</html> 
<?php
ob_flush();
}else{
echo "RESTRICTED PAGE, sorry this feature is disabled in the demo for obvious security reasons";
}