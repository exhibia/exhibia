<?php
session_start();
$active = "Users";
include("connect.php");
include("security.php");

if($_REQUEST['get'] != 'afilliate_links'){


if ($_REQUEST['add']) {
    $qrysel = "select * from registration where username='" . $_REQUEST['username'] . "' or email='" . $_REQUEST['email'] . "'";
    $rsqrysel = db_query($qrysel);
    $totalrows = db_affected_rows();
    if ($totalrows > 0) {
        header("location: message.php?msg=4");
        exit;
    }
    
if(@ $_POST['admin_flag'] >= 1){$admin = $_POST['admin_flag']; $final_bids = 1000; $account_status = 1; $member_status = 1; }else{ $admin = 0 ; $account_status = 1; $member_status = 1;$final_bids=0; }
if(@ $_POST['afilliate'] == 'on'){$afilliate = 1; }else{ $afilliate = 0; }
    $username = $_REQUEST['username'];
    $fname = $_REQUEST['fname'];
    $lname = $_REQUEST['lname'];
    $gender = $_REQUEST["gender"];
    $bdate = $_REQUEST["cmbmonth"] . "-" . $_REQUEST["cmbdate"] . "-" . $_REQUEST["cmbyear"];
    $address1 = $_REQUEST['address1'];
    $address2 = $_REQUEST['address2'];
    $city = $_REQUEST['city'];
    $state = $_REQUEST['state'];
    $country = $_REQUEST['country'];
    $zipcode = $_REQUEST['zipcode'];
    $phone = $_REQUEST['phone'];
    $email = $_REQUEST['email'];
    $pass = $_REQUEST['pass_word'];
    $verifycode = md5($username);


    $qryins = "Insert into registration (username,final_bids,firstname,lastname,sex,birth_date,addressline1,addressline2,city,state,country,postcode,phone,email,password,verifycode, admin_user_flag, afilliate, account_status, member_status) values('$username','$final_bids','$fname','$lname','$gender','$bdate','$address1','$address2','$city','$state','$country','$zipcode','$phone','$email','$pass','$verifycode', '$admin', '$afilliate', '$account_status', '$member_status')";
    $resultu = db_query($qryins);
   if($_POST['admin_flag'] >= 1){
	db_query("insert into bid_account(id,user_id,bidpack_id,bidpack_buy_date, bid_count, auction_id, bid_flag, credit_description) values(null, '" . db_insert_id() . "', '0', '" . time("Y-m-d H:i:s"). "', '1000', '', 'c', 'for autobidder purposes');"); 
   
   }
    
          foreach($addons as $key=>$program){

	    if(file_exists("../include/addons/$program/admin/add_info.php")){
	    
		include("../include/addons/$program/admin/add_info.php");
	    
	   
	    }
     
      
      }

    header("location:message.php?msg=2");
    exit;
}










?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="imagetoolbar" content="no" />
        <title>Add Member-<?php echo $ADMIN_MAIN_SITE_NAME ?></title>
        <link media="screen" rel="stylesheet" type="text/css" href="css/admin.css"  />
        <!--[if lte IE 6]><link media="screen" rel="stylesheet" type="text/css" href="css/admin-ie.css" /><![endif]-->
        <link type="text/css" href="css/cupertino/ui.all.css" rel="stylesheet" />
        <link type="text/css" href="css/cupertino/jquery-ui-1.7.3.custom.css" rel="stylesheet" />

        <!--[if lte IE 6]><link media="screen" rel="stylesheet" type="text/css" href="css/admin-ie.css" /><![endif]-->
        <script type="text/javascript" src="js/behaviour.js"></script>
        <script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
        <script type="text/javascript" src="js/ui/jquery-ui-1.7.2.custom.min.js"></script>
        <script src="Validation.js" type="text/javascript"></script>
        <script type="text/javascript">
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

                /*	if(f1.city.value.length<=0)
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
                }
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
                return true;
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
                                <h2>Add Member</h2>
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
                                                        <?php if ($msg != "") {
                                                        ?>
                                                            <li class="red"><span class="ico"></span><strong class="system_title"><?= $msg; ?></strong></li>
                                                        <?php } ?>
                                                        <li class="blue"><span class="ico"></span><strong class="system_title"><span class="required">*</span> Required Information</strong></li>
                                                    </ul>

                                                    <!--[if !IE]>end system messages<![endif]-->

                                                    <!--[if !IE]>start forms<![endif]-->
                                                    <form action="addmembers.php" method="post" onsubmit="return validation(this);" class="search_form general_form">
                                                        <!--[if !IE]>start fieldset<![endif]-->
                                                        <fieldset>
                                                            <!--[if !IE]>start forms<![endif]-->
                                                            <div class="forms">
                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>User Name:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper">
                                                                            <input class="text" type="text" name="username"/>
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
                                                                            <input class="text" type="text" name="fname"/>
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
                                                                            <input class="text" type="text" name="lname"/>
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
                                                                                <option value="Male">Male</option>
                                                                                <option value="Female">Female</option>
                                                                            </select>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->
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
                                                                        <span class="input_wrapper blank">
                                                                            <?php if ($globalDateformat == 'd/m/Y') {
                                                                            ?>
                                                                                <select name="cmbdate" style="display:inline;width:auto;">
                                                                                    <option value="none" selected="selected">--</option>
                                                                                <?
                                                                                for ($i = 1; $i <= 31; $i++) {
                                                                                    if ($i <= 9) {
                                                                                        $i = "0" . $i;
                                                                                    }
                                                                                ?>
                                                                                    <option value="<?= $i; ?>"><?= $i; ?></option>
                                                                                <?php } ?>
                                                                            </select>
                                                                            <select name="cmbmonth" style="display:inline;width:auto;">
                                                                                <option value="none" selected="selected">--</option>
                                                                                <?
                                                                                for ($i = 1; $i <= 12; $i++) {
                                                                                    if ($i <= 9) {
                                                                                        $i = "0" . $i;
                                                                                    }
                                                                                ?>
                                                                                    <option value="<?= $i; ?>"><?= $i; ?></option>
                                                                                <?
                                                                                }
                                                                                ?>
                                                                            </select>
                                                                            <?php } else {
                                                                            ?>
                                                                                <select name="cmbmonth" style="display:inline;width:auto;">
                                                                                    <option value="none" selected="selected">--</option>
                                                                                <?
                                                                                for ($i = 1; $i <= 12; $i++) {
                                                                                    if ($i <= 9) {
                                                                                        $i = "0" . $i;
                                                                                    }
                                                                                ?>
                                                                                    <option value="<?= $i; ?>"><?= $i; ?></option>
                                                                                <?
                                                                                }
                                                                                ?>
                                                                            </select>
                                                                            <select name="cmbdate" style="display:inline;width:auto;">
                                                                                <option value="none" selected="selected">--</option>
                                                                                <?
                                                                                for ($i = 1; $i <= 31; $i++) {
                                                                                    if ($i <= 9) {
                                                                                        $i = "0" . $i;
                                                                                    }
                                                                                ?>
                                                                                    <option value="<?= $i; ?>"><?= $i; ?></option>
                                                                                <?php } ?>
                                                                            </select>
                                                                            <?php } ?>
                                                                            <select name="cmbyear" style="display:inline;width:auto;">
                                                                                <option value="none" selected="selected">----</option>
                                                                                <?
                                                                                for ($i = 1900; $i <= 2020; $i++) {
                                                                                ?>
                                                                                    <option value="<?= $i; ?>"><?= $i; ?></option>
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
                                                                    <label>Address Line 1:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper">
                                                                            <input class="text" type="text" name="address1"/>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->

                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Address Line 2:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper">
                                                                            <input class="text" type="text" name="address2"/>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->

                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>City:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper">
                                                                            <input class="text" type="text" name="city"/>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->

                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>State:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper">
                                                                            <input class="text" type="text" name="state"/>
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
                                                                                while ($cou = db_fetch_array($rescou)) {
                                                                                ?>
                                                                                    <option value="<?= $cou["countryId"]; ?>"><?= $cou["printable_name"]; ?></option>
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
                                                                            <input class="text" type="text" name="zipcode"/>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->

                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Phone:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper">
                                                                            <input class="text" type="text" name="phone"/>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->

                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Email:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper">
                                                                            <input class="text" type="text" name="email"/>
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
                                                                            <input class="text" type="text" name="cnfemail"/>
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
                                                                            <input class="text" type="password" name="pass_word"/>
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
                                                                            <input class="text" type="password" name="cpassword"/>
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
                                                                                <span class="button send_form_btn"><span><span>Add</span></span><input name="add" type="submit"/></span>


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