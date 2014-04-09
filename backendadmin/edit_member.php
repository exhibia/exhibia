<?php
session_start();
$active="Users";
include("connect.php");
include("security.php");
db_query("alter table registration modify column admin_user_flag int(11)");
db_query("CREATE TABLE IF NOT EXISTS `user_levels` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_level` varchar(50) NOT NULL DEFAULT '0',
  `allowed_pages` longblob,
  
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;");

if(db_num_rows(db_query("select * from user_levels")) == 0){

$this_dir = getcwd();
$master_directory = str_replace("/backendadmin", "", $this_dir);

    db_query("insert into user_levels values(null, 'admin', 'insert into user_levels (id, admin_level, pages) values(null, 'admin', '$this_dir/manageauctiontime.php,$this_dir/manageNewsletters.php,$this_dir/set_and_forget.php,$this_dir/assigncoupontouser.php,$this_dir/managereferralbid.php,$this_dir/templates.sql.php,$this_dir/managecommunity.php,$this_dir/config_setting.php,$this_dir/innerstore.php,$this_dir/edit_member.php,$this_dir/main.css,$this_dir/defaultdatabase.php,$this_dir/designsuite.php,$this_dir/headlinks.txt.php,$this_dir/managenews.php,$this_dir/order_report_print.php,$this_dir/managetax.php,$this_dir/manage_members.php,$this_dir/specialauction.php,$this_dir/sendmail.php,$this_dir/inneraccount.php,$this_dir/perhourreport.php,$this_dir/addauction.php,$this_dir/view_member_status.php,$this_dir/admincreditreport.php,$this_dir/addshippingcharge.php,$this_dir/addlanguage.php,$this_dir/endauction.php,$this_dir/forum.txt.php,$this_dir/productdetail.php,$this_dir/unsoldauction.php,$this_dir/paypalsetting.php,$this_dir/managebuynow.php,$this_dir/confirmpayment.php,$this_dir/soldauction.php,$this_dir/registrationreport.php,$this_dir/banipaddress.php,$this_dir/config.inc.php,$this_dir/sitesetting.php,$this_dir/addhelptopic.php,$this_dir/view_member_statistics.php,$this_dir/redemptiondetails.php,$this_dir/editaccount.php,$this_dir/addadvertslide.php,$this_dir/changeauctiontime.php,$this_dir/session.php,$this_dir/addFAQ.php,$this_dir/manageredemption.php,$this_dir/order_buyitnow.php,$this_dir/finincialreport.php,$this_dir/example2csv.php,$this_dir/system.php,$this_dir/addcommunity.php,$this_dir/ioncube_encoder5,$this_dir/managehelptopic.php,$this_dir/useraddress.php,$this_dir/forumtopicedit.php,$this_dir/addbidpack.php,$this_dir/addauctiontime.php,$this_dir/addbiddinguser.php,$this_dir/regfreepoints.php,$this_dir/innerpayment.php,$this_dir/forumreplyedit.php,$this_dir/example_advanced.css,$this_dir/managevoucher.php,$this_dir/addcoupon_excel.php,$this_dir/logo.php,$this_dir/addforumcat.php,$this_dir/rte.css,$this_dir/store.txt.php,$this_dir/addmembers.php,$this_dir/addvoucher.php,$this_dir/static.txt.php,$this_dir/style.css,$this_dir/menu.css,$this_dir/report.txt.php,$this_dir/ioncube_encoder53,$this_dir/voucherissue.php,$this_dir/bidderuseravatar.php,$this_dir/managebiddinguser.php,$this_dir/leftstore.php,$this_dir/autolister.enc.php,$this_dir/leftreport.php,$this_dir/manageautobidder.php,$this_dir/background.php,$this_dir/exportcsvcount.php,$this_dir/ajaxauction.php,$this_dir/process_background.php,$this_dir/leftstatic.php,$this_dir/manageadvertposition.php,$this_dir/pauseauction.php,$this_dir/addshippingstatus.php,$this_dir/leftside.php,$this_dir/users.txt.php,$this_dir/message.php,$this_dir/addcoupon.php,$this_dir/editor.js,$this_dir/defaultreport.php,$this_dir/manageFAQ.php,$this_dir/loginfreepoints.php,$this_dir/get_help.php,$this_dir/plugingeneral.php,$this_dir/design.txt.php,$this_dir/liveauctionreport.php,$this_dir/addforum.php,$this_dir/buynowsetting.php,$this_dir/page_headers.php,$this_dir/defaultstatic.php,$this_dir/defaultforum.php,$this_dir/managereply.php,$this_dir/add_product.php,$this_dir/listuniversalcoupon.php,$this_dir/addredemption.php,$this_dir/examplecsv.php,$this_dir/process_logo.php,$this_dir/innerhome.php,$this_dir/download.php,$this_dir/defaultaccount.php,$this_dir/emailtemplateeditor.php,$this_dir/manageshippingtype.php,$this_dir/ipaddresshistory.php,$this_dir/member_stats.php,$this_dir/manageauctionpause.php,$this_dir/admin.config.inc.php,$this_dir/plugin.txt.php,$this_dir/innerdatabase.php,$this_dir/innerusers.php,$this_dir/addcategory.php,$this_dir/menu.js,$this_dir/pandl.php,$this_dir/pages.php,$this_dir/viewaffiliaterefferal.php,$this_dir/peddingorder.php,$this_dir/addavatar.php,$this_dir/defaultstore.php,$this_dir/managecoupon.php,$this_dir/function.js,$this_dir/autolister.php,$this_dir/framehead.php,$this_dir/addbonusbid.php,$this_dir/logout.php,$this_dir/managesocial.php,$this_dir/functions_s.php,$this_dir/addnews.php,$this_dir/html2xhtml.js,$this_dir/payment.txt.php,$this_dir/
main1.css,$this_dir/ratingfreepoints.php,$this_dir/innerforum.php,$this_dir/manageaffiliatepayment.php,$this_dir/account.txt.php,$this_dir/richtext.js,$this_dir/auctiondetails.php,$this_dir/reverse_registrationreport.php,$this_dir/addmembersnews.php,$this_dir/customizelanguage.php,$this_dir/manageadvertslide.php,$this_dir/languagesetting.php,$this_dir/error_log,$this_dir/validation.js,$this_dir/managespecial.php,$this_dir/getproductlist.php,$this_dir/gd.inc.php,$this_dir/getprice.php,$this_dir/curl.php,$this_dir/referralwonauctionreport.php,$this_dir/imgsize.php,$this_dir/video-help.png,$this_dir/defaulthome.php,$this_dir/export.csv,$this_dir/assigncoupon.php,$this_dir/makepayment.php,$this_dir/getcategorylist.php,$this_dir/addautobidder.php,$this_dir/inneremail.php,$this_dir/addshippingtype.php,$this_dir/affiliatereport.php,$this_dir/staticpages.php,$this_dir/auctionwisereport.php,$this_dir/innerplugin.php,$this_dir/manageforumcategory.php,$this_dir/password.php,$this_dir/generalsetting.php,$this_dir/uploader.php,$this_dir/main.js,$this_dir/addspecial.php,$this_dir/autocredits.php,$this_dir/header.php,$this_dir/database_commands.sql,$this_dir/addsocial.php,$this_dir/edit_product.php,$this_dir/newsletter.php,$this_dir/order_wonauction.php,$this_dir/managebidpack.php,$this_dir/database.txt.php,$this_dir/edit_user_levels.php,$this_dir/invitersetting.php,$this_dir/getUserList.php,$this_dir/leftforum.php,$this_dir/manageforum.php,$this_dir/usercoupon.php,$this_dir/addproducts.php,$this_dir/leftaccount.php,$this_dir/manageproducts.php,$this_dir/innerreport.php,$this_dir/managescharge.php,$this_dir/leftdatabase.php,$this_dir/onlineuser.php,$this_dir/userdetail.php,$this_dir/addadvertgroup.php,$this_dir/manageavatar.php,$this_dir/delproducts.php,$this_dir/functions.php,$this_dir/security.php,$this_dir/managetopics.php,$this_dir/innerstatic.php,$this_dir/manageadvertgroup.php,$this_dir/process_addlanguage.php,$this_dir/email.txt.php,$this_dir/addauction2.php,$this_dir/body.js,$this_dir/managecat.php,$this_dir/productwisereport.php,$this_dir/managemembersnews.php,$this_dir/connect.php,$this_dir/admin.cookie.php,$this_dir/manageauction.php,$this_dir/index.php,$this_dir/manageshippingcharge.php,$this_dir/popupimage.js,$this_dir/printingoutput.php,$this_dir/message.php,$this_dir/index.php,$this_dir/innerhome.php');");
    db_query("insert into user_levels values(null, 'designer', '');");
    db_query("insert into user_levels values(null, 'auctioneer', '$this_dir/innerstore.php,$this_dir/addauction.php,$this_dir/manageauction.php,$this_dir/soldauction.php,$this_dir/unsoldauction.php,$this_dir/managebuynow.php,,$this_dir/message.php,$this_dir/index.php,$this_dir/innerhome.php');");




}
@db_query("alter table registration add column afilliate tinyint(1)");

if($_REQUEST['get'] != 'afilliate_links'){






if($_REQUEST['edit']) {

if(@ $_REQUEST['admin'] == 'on'){$admin = 1; }else{ $admin = 0 ; }
if(@ $_REQUEST['afilliate'] == 'on'){$afilliate = 1; }else{ $afilliate = 0; }
    $id=$_REQUEST['id'];
    $username=$_REQUEST['username'];
    $fname=$_REQUEST['fname'];
    $lname=$_REQUEST['lname'];
    $gender=$_REQUEST["gender"];
    $bdate=$_REQUEST["cmbmonth"]."-".$_REQUEST["cmbdate"]."-".$_REQUEST["cmbyear"];
    $address1=$_REQUEST['address1'];
    $address2=$_REQUEST['address2'];
    $city=$_REQUEST['city'];
    $state=$_REQUEST['state'];
    $country=$_REQUEST['country'];
    $zipcode=$_REQUEST['zipcode'];
    $phone=$_REQUEST['phone'];
    $email=$_REQUEST['email'];
    $pass=$_REQUEST['pass_word'];
  

    
      foreach($_REQUEST['afilliate_program'] as $key=>$program){

	    if(file_exists("../include/addons/$program/push.php")){
	    
		include("../include/addons/$program/push.php");
	    
	   
	    }
     
      
      }
          
 
    $qrysel = "select * from registration where username='".$_REQUEST['username']."' or email='".$_REQUEST['email']."'";
    $rsqrysel = db_query($qrysel);
    $totalrows = db_affected_rows();
    $row = db_fetch_array($rsqrysel);

    if($_REQUEST['username']!=$row["username"]) {
        if($totalrows>0) {
            header("location: message.php?msg=4");
            exit;
        }
    }

    $sqlu="update registration set username='$username', firstname='$fname',  lastname='$lname', sex='$gender', birth_date='$bdate', addressline1='$address1',addressline2='$address2', city='$city',
state='$state', country='$country', postcode='$zipcode', phone='$phone', password='$pass', email='$email', admin_user_flag = '$_POST[admin_flag]', afilliate = '$afilliate'  where id='$id'";
    $resultu=db_query($sqlu);
      foreach($addons as $key=>$program){

	    if(file_exists("../include/addons/$program/admin/add_info.php")){
	    
		include("../include/addons/$program/admin/add_info.php");
	    
	   
	    }
     
      
      }

         


    header("location:message.php?msg=3");
    exit;

}
if($_REQUEST['editid']) {
    $id=$_REQUEST['editid'];
    $sql="select * from registration where id='$id'";
    $result=db_query($sql) or die(db_error);
    $row=db_fetch_object($result) or die(db_error());
    $fname=$row->firstname;
    $lname=$row->lastname;
    $gender=$row->sex;
    $bdate=$row->birth_date;
    $date = substr($bdate,3,2);
    $month = substr($bdate,0,2);
    $year = substr($bdate,6);
    $address1=$row->addressline1;
    $address2=$row->addressline2;
    $city=$row->city;
    $country=$row->country;
    $state=$row->state;
    $zipcode=$row->postcode;
    $phone=$row->phone;
    $email=$row->email;
    $username=$row->username;
    $pass=$row->password;
    $admin=$row->admin_user_flag;
    $afilliate=$row->afilliate;
    
}
if($_REQUEST['delid']) {
    $id=$_REQUEST['delid'];
    $id=$_REQUEST['delid'];
    $sqldel="update registration set user_delete_flag='1' where id='$id'";
    $resultdel=db_query($sqldel) or die(db_error());

    header("location:message.php?msg=1");
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="imagetoolbar" content="no" />
        <title>Edit Member-<?php echo $ADMIN_MAIN_SITE_NAME ?></title>
        <link media="screen" rel="stylesheet" type="text/css" href="css/admin.css"  />
	<link rel="stylesheet" href="http://code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css">
	<script src="http://code.jquery.com/jquery-1.8.3.js"></script>
	<script src="http://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>
        <!--[if lte IE 6]><link media="screen" rel="stylesheet" type="text/css" href="css/admin-ie.css" /><![endif]-->
        <script type="text/javascript" src="js/behaviour.js"></script>
        <script type="text/javascript" src="Validation.js" type="text/javascript"></script>
        <script type="text/javascript" type="text/javascript">
	  
	  function create_affilliate_id(){
	  
	      if( $('#afilliate').is(':checked') ){
	      
		$.get('edit_member.php?get=afilliate_links&editid=<?php echo $_REQUEST['editid'];?>', function(response){
		    
		    $('#afilliate_links').html(response);
		    
		    }
		    );
	      
	      }else{
	      
		  $('#afilliate_links').html();
	      
	      }
	  
	  
	  
	  }
	  $(document).ready(function(){
	  create_affilliate_id();
	  });
	  
            function validation(f1){

                if(f1.username.value.length<=0)
                {
                    alert("Please Enter Your User Name!");
                    f1.username.focus();
                    return false;
                }

                if(f1.username.value.length<6)
                {
                    alert("User Name Is Too Short!");
                    f1.username.focus();
                    return false;
                }

                if(f1.fname.value.length<=0)
                {
                    alert("Please Enter Your First Name!");
                    f1.fname.focus();
                    return false;
                }

                if(f1.lname.value.length<=0)
                {
                    alert("Please Enter Your Last Name!");
                    f1.lname.focus();
                    return false;
                }

                if(f1.cmbmonth.value=="none")
                {
                    alert("Please Select Your Birth Date!");
                    f1.cmbmonth.focus();
                    return false;
                }

                if(f1.cmbdate.value=="none")
                {
                    alert("Please Select Your Birth Date!");
                    f1.cmbdate.focus();
                    return false;
                }
                if(f1.cmbyear.value=="none")
                {
                    alert("Please Select Your Birth Date!");
                    f1.cmbyear.focus();
                    return false;
                }

                /*if(f1.address1.value.length<=0)
                {
                        alert("Please Enter Your Address!");
                        f1.address1.focus();
                        return false;
                }*/

                /*if(f1.city.value.length<=0)
                {
                        alert("Please Enter Your City!");
                        f1.city.focus();
                        return false;
                }

                if(f1.state.value.length<=0)
                {
                        alert("Please Enter Your State!");
                        f1.state.focus();
                        return false;
                }

                if(f1.country.value.length<=0)
                {
                        alert("Please Enter Your Country!");
                        f1.country.focus();
                        return false;
                }

                if(f1.zipcode.value.length<=0)
                {
                        alert("Please Enter Your Zipcode!");
                        f1.zipcode.focus();
                        return false;
                }*/
                /*if(f1.phone.value.length<=0)
                {
                        alert("Please Enter Your Phone Number!");
                        f1.phone.focus();
                        return false;
                }*/

                if(f1.country.value=="none")
                {
                    alert("Please Select Your Country!");
                    f1.country.focus();
                    return false;
                }
                if(f1.email.value.length<=0)
                {
                    alert("Please Enter Your Email!");
                    f1.email.focus();
                    return false;
                }

                if(f1.cnfemail.value.length<=0)
                {
                    alert("Please Enter Your Confirm Email!");
                    f1.cnfemail.focus();
                    return false;
                }

                if(f1.email.value!=f1.cnfemail.value)
                {
                    alert("Email Mismatch!");
                    f1.cnfemail.focus();
                    f1.cnfemail.select();
                    return false;
                }
                else
                {
                    if(!validate_email(f1.email.value,"Please enter valid email address!"))
                    {
                        f1.email.select();
                        return false;
                    }
                }

                if(f1.pass_word.value=="")
                {
                    alert("Please Enter Password!");
                    f1.pass_word.focus();
                    return false;
                }

                if(f1.pass_word.value.length<6)
                {
                    alert("Password is too short!");
                    f1.pass_word.focus();
                    f1.pass_word.select();
                    return false;
                }

                if(f1.cpassword.value=="")
                {
                    alert("Please Confirm Password!");
                    f1.cpassword.focus();
                    return false;
                }

                if(f1.cpassword.value!=f1.pass_word.value)
                {
                    alert("Passwrod Mismatch!");
                    f1.pass_word.focus();
                    f1.cpassword.select();
                    return false;
                }
            }
            function validate_email(field,alerttxt){
                with (field){
                    var value;
                    value = document.newmember.email.value;
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
                                <h2>Edit Member</h2>
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
                                                        <?php if ( $msg != "" ) {
                                                            ?>
                                                        <li class="red"><span class="ico"></span><strong class="system_title"><?=$msg;?></strong></li>
                                                            <?php }?>
                                                        <li class="blue"><span class="ico"></span><strong class="system_title"><span class="required">*</span> Required Information</strong></li>
                                                    </ul>

                                                    <!--[if !IE]>end system messages<![endif]-->

                                                    <br/>

                                                    <!--[if !IE]>start forms<![endif]-->
                                                    <form action="edit_member.php" method="post" name="newmember" onsubmit="return validation(this);" class="search_form general_form">
                                                        <input type="hidden" name="id" value="<?=$id?>"/>
                                                        <!--[if !IE]>start fieldset<![endif]-->
                                                        <fieldset>
                                                            <!--[if !IE]>start forms<![endif]-->
                                                            <div class="forms">
                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>User Name:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper">
                                                                            <input class="text" type="text" name="username" value="<?=$username?>"/>
                                                                        </span>
                                                                        <span class="system required">*</span>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->

                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>First Name:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper">
                                                                            <input class="text" type="text" name="fname" value="<?=$fname?>"/>
                                                                        </span>
                                                                        <span class="system required">*</span>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->

                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Last Name:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper">
                                                                            <input class="text" type="text" name="lname" value="<?=$lname?>"/>
                                                                        </span>
                                                                        <span class="system required">*</span>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->
<?php
      foreach($addons as $key=>$program){

	    if(file_exists("../include/addons/$program/admin/edit_member.php")){
	    
		include("../include/addons/$program/admin/edit_member.php");
	    
	   
	    }
     
      
      }
?>
                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Gender:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper blank">
                                                                            <select name="gender">
                                                                                <option value="Male" <?=$gender=="Male"?selected:"";?>>Male</option>
                                                                                <option value="Female" <?=$gender=="Female"?selected:"";?>>Female</option>
                                                                            </select>
                                                                        </span>
                                                                    </div>
                                                                </div>
								<!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
								    <label>Affiliate / Partner:</label>
                                                                    <div class="inputs">
                                                                        
									  
									    
                                                                            <input class="radio" type="checkbox" id="afilliate" name="afilliate" <?php if(!empty($afilliate)){ echo "checked"; } ?> />
                                                                       Requires third additional add ons or custom afilliate add ons
                                                                    </div>
								    <br />
								    <div id="afilliate_links"></div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->
                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Admin User?:</label>
                                                                    <div class="inputs">
                                                                        
									  
									    
                                                                            <select id="admin_flag" name="admin_flag">
										<option value="0">No</option>
										<?php
										$qrya = db_query("select * from user_levels");
										  while($rowa = db_fetch_array($qrya)){
										  
										  ?>
										  <option value="<?php echo $rowa['id'];?>" <?php if($admin == $rowa['id']){ echo 'selected'; } ?>><?php echo $rowa['admin_level'];?></option>
										  
										  <?php
										  }
										  ?>
									      </select>
                                                                       
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->
                                                              

                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Birth Date:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper_custom blank">
                                                                            <select name="cmbdate" style="display:inline;width:auto;">
                                                                                <option value="none" selected="selected">--</option>
                                                                                <?
                                                                                for($i=1;$i<=31;$i++) {
                                                                                    if($i<=9) {
                                                                                        $i="0".$i;
                                                                                    }
                                                                                    ?>
                                                                                <option value="<?=$i;?>" <?=$date==$i?"selected":"";?>><?=$i;?></option>
                                                                                    <?
                                                                                }
                                                                                ?>
                                                                            </select>
                                                                            <select name="cmbmonth" style="display:inline;width:auto;">
                                                                                <option value="none" selected="selected">--</option>
                                                                                <?
                                                                                for($i=1;$i<=12;$i++) {
                                                                                    if($i<=9) {
                                                                                        $i="0".$i;
                                                                                    }
                                                                                    ?>
                                                                                <option value="<?=$i;?>" <?=$month==$i?"selected":"";?>><?=$i;?></option>
                                                                                    <?
                                                                                }
                                                                                ?>
                                                                            </select>
                                                                            <select name="cmbyear" style="display:inline;width:auto;">
                                                                                <option value="none" selected="selected">----</option>
                                                                                <?
                                                                                for($i=1950;$i<=2020;$i++) {
                                                                                    ?>
                                                                                <option value="<?=$i;?>" <?=$year==$i?"selected":"";?>><?=$i;?></option>
                                                                                    <?
                                                                                }
                                                                                ?>
                                                                            </select>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->

                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Address Line 1:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper">
                                                                            <input class="text" type="text" name="address1" value="<?=$address1;?>" />
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->

                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Address Line 2:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper">
                                                                            <input class="text" type="text" name="address2" value="<?=$address2;?>" />
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->

                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>City:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper">
                                                                            <input class="text" type="text" name="city" value="<?=$city?>"/>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->

                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>State:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper">
                                                                            <input class="text" type="text" name="state" value="<?=$state?>"/>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->

                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Country:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper blank">
                                                                            <select name="country">
                                                                                <option value="none">please select one</option>
                                                                                <?
                                                                                $qrycou = "select * from countries";
                                                                                $rescou = db_query($qrycou);
                                                                                while($cou=db_fetch_array($rescou)) {
                                                                                    ?>
                                                                                <option <?=$country==$cou["countryId"]?"selected":"";?> value="<?=$cou["countryId"];?>"><?=$cou["printable_name"];?></option>
                                                                                    <?
                                                                                }
                                                                                ?>
                                                                            </select>
                                                                        </span>
                                                                        <span class="system required">*</span>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->

                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Zipcode:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper">
                                                                            <input class="text" type="text" name="zipcode" value="<?=$zipcode?>"/>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->

                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Phone:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper">
                                                                            <input class="text" type="text" name="phone" value="<?=$phone;?>"/>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->                                                          

                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Email:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper">
                                                                            <input type="text" name="email"  class="text" value="<?=$email?>"/>
                                                                        </span>
                                                                        <span class="system required">*</span>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->

                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Confirm Email:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper">
                                                                            <input type="text" class="text" name="cnfemail" value="<?=$email?>"/>
                                                                        </span>
                                                                        <span class="system required">*</span>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->

                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Password:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper">
                                                                            <input type="password" class="text" name="pass_word" value="<?=$pass?>"/>
                                                                        </span>
                                                                        <span class="system required">*</span>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->

                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Confirm Password:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper">
                                                                            <input type="password" class="text" name="cpassword" value="<?=$pass?>"/>
                                                                        </span>
                                                                        <span class="system required">*</span>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->

                                                                <!--[if !IE]>start row<![endif]-->
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


 <?php
 }else{
   ?>
     <ul style="list-style-type:none;display:inline;font-size:12px;font-weight:bold;" class="inline">
 <?php
    $sql = db_query("select distinct value from sitesetting where name = 'afilliate_progr'");
    
	while($row = db_fetch_array($sql)){
	
	  ?>
	    <li style="display:inline;">
		<ol style="margin-right:5px;list-style-type:none;display:inline;font-size:12px;font-weight:bold; border: 1px solid blue;padding:5px;" class="inline">
		  <li style="display:inline;padding-right:10px;"><?php echo $row['value']; ?> =>
		     <input type="hidden" name="afilliate_program[]" value="<?php echo $row['value']; ?>" />
		  </li>
		  <li style="display:inline;">
		    Aff. Id => 
		    
		      <?php $aff_info = db_fetch_array(db_query("select * from afilliate_links, registration where afilliate_links.userid = '$_REQUEST[editid]' and registration.id = '$_REQUEST[editid]' and registration.id = afilliate_links.userid and addon_value = '$row[value]' limit 1"));
		      
		      echo db_error();
		      
		      ?>
			<?php echo $aff_info['aff_id']; ?>
		    <input type="hidden" name="afilliate_id[]" value="<?php echo $aff_info['aff_id']; ?>" size="5"/>
		  </li>
		  <li style="display:inline;">Refer Code:
		    <input type="text" name="referal_code[]" value="<?php echo $aff_info['referal_code']; ?>" size="5"/>
		  </li>
		</ol>
	    </li>
	
	
	
	
	</ul>
<?php
 
 }
 }