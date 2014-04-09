<?
session_start();
$active = "Users";
include("connect.php");
include("security.php");
include_once('../data/avatar.php');

$firstname = $_POST["firstname"];
$lastname = $_POST["lastname"];
$gender = "Male";
$birthdate = rand(1, 29) . "-" . rand(1, 12) . "-" . rand(1980, 2000);
$city = $_POST["city"];
$country = $_POST["country"];
$username = $_POST["username"];
$password = $_POST["password"];
$email = $_POST["email"];
$phone = $_POST["phoneno"];
$finalbids = $_POST['finalbids'];
$freebids = $_POST['freebids'];
$avatar = $_POST['avatar'];
$latlng = isset($_POST['latlng']) ? $_POST['latlng'] : '-34.397, 150.644';

$avatarid = '';

if ($_POST["add"] != "") {
    $qrysel = "select * from registration where username='" . $_REQUEST['username'] . "'";
    $rsqrysel = db_query($qrysel);
    $totalrows = db_affected_rows();
    if ($totalrows > 0) {
        header("location: message.php?msg=70");
        exit;
    } else {
        $qryins = "Insert into registration (username,firstname,lastname,sex,birth_date,city,country,phone,password,terms_condition,privacy,account_status,registration_date,admin_user_flag,email,final_bids,free_bids,position,avatarid) values('" . $username . "','" . $firstname . "','" . $lastname . "','" . $gender . "','" . $birthdate . "','" . $city . "','" . $country . "','" . $phone . "','" . $password . "','1','1','1',NOW(),'1','" . $email . "',$finalbids,$freebids,'$latlng','$avatar')";
        db_query($qryins) or die(db_error());
        header("location: message.php?msg=69");
    }
}
if ($_POST["edit"] != "") {
    $id = $_POST["editrecord"];
    $qrysel1 = "select * from registration where (username='" . $_REQUEST['username'] . "') and id!='" . $id . "'";
    $rsqrysel1 = db_query($qrysel1);
    $totalavailable = db_num_rows($rsqrysel1);
    if ($totalavailable > 0) {
        header("location: message.php?msg=70");
        exit;
    } else {
        $qryupd = "update registration set username='" . $username . "',firstname='" . $firstname . "',lastname='" . $lastname . "',sex='" . $gender . "',birth_date='" . $birthdate . "',city='" . $city . "',country='" . $country . "',phone='" . $phone . "',password='" . $password . "',email='" . $email . "', final_bids=$finalbids,free_bids=$freebids,position='$latlng',avatarid='$avatar' " . " where id='" . $id . "'";
        db_query($qryupd) or die(db_error());
        header("location: message.php?msg=71");
    }
}

if ($_GET["deleterecord"] != "") {
    $delid = $_GET["deleterecord"];
    $qrydel = "update registration set user_delete_flag='d' where id='" . $delid . "'";
    db_query($qrydel) or die(db_error());
    header("location: message.php?msg=72");
}

if ($_GET["editid"] != "" || $_GET["delid"] != "") {
    if ($_GET["editid"] != "") {
        $id = $_GET["editid"];
    } else {
        $id = $_GET["delid"];
    }

    $qryreg = "select * from registration where id='" . $id . "'";
    $resreg = db_query($qryreg);
    $obj = db_fetch_object($resreg);

    $avatarid = $obj->avatarid;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="imagetoolbar" content="no" />
        <title><?php if ($_GET["editid"] != "") { ?>Edit Bidding User <?php } elseif ($_GET["delid"] != "") { ?>Delete Bidding User <?php } else { ?>Add Bidding User<?php } ?>-<?php echo $ADMIN_MAIN_SITE_NAME ?></title>
        <link media="screen" rel="stylesheet" type="text/css" href="css/admin.css"  />
        <!--[if lte IE 6]><link media="screen" rel="stylesheet" type="text/css" href="css/admin-ie.css" /><![endif]-->
        <script type="text/javascript" src="js/behaviour.js"></script>
        <script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
        <script type="text/javascript" src="body.js"></script>
        <script type="text/javascript">
            function Check(f1)
            {
                if(document.f1.firstname.value=="")
                {
                    alert("Please enter firstname!!!");
                    document.f1.firstname.focus();
                    return false;
                }

                if(document.f1.lastname.value=="")
                {
                    alert("Please enter lastname!!!");
                    document.f1.lastname.focus();
                    return false;
                }

                /*		if(document.f1.bdate.value=="none")
                {
                        alert("Please select birth date!!!");
                        document.f1.bdate.focus();
                        return false;
                }

                if(document.f1.bmonth.value=="none")
                {
                        alert("Please select birth date!!!");
                        document.f1.bmonth.focus();
                        return false;
                }

                if(document.f1.byear.value=="none")
                {
                        alert("Please select birth date!!!");
                        document.f1.byear.focus();
                        return false;
                }

                if(document.f1.city.value=="")
                {
                        alert("Please enter city!!!");
                        document.f1.city.focus();
                        return false;
                }
                 */
                if(document.f1.country.value=="none")
                {
                    alert("Please select coutnry!!!");
                    document.f1.country.focus();
                    return false;
                }

                if(document.f1.username.value=="")
                {
                    alert("Please enter username!!!");
                    document.f1.username.focus();
                    return false;
                }
                if(f1.username.value.length<6)
                {
                    alert("Username is too short!");
                    f1.username.focus();
                    f1.username.select();
                    return false;
                }
                if(document.f1.password.value=="")
                {
                    alert("Please enter password!!!");
                    document.f1.password.focus();
                    return false;
                }
                if(f1.password.value.length<6)
                {
                    alert("Password is too short!");
                    f1.password.focus();
                    f1.password.select();
                    return false;
                }
                if(document.f1.cnfpassword.value=="")
                {
                    alert("Please enter confirm password!!!");
                    document.f1.cnfpassword.focus();
                    return false;
                }
                if(document.f1.password.value!=document.f1.cnfpassword.value)
                {
                    alert("Password Mismatch!!!");
                    document.f1.password.focus();
                    return false;
                }
                if(document.f1.email.value=="")
                {
                    alert("Please enter email!!!");
                    document.f1.email.focus();
                    return false;
                }
                if(document.f1.cnfemail.value=="")
                {
                    alert("Please enter confirm email!!!");
                    document.f1.cnfemail.focus();
                    return false;
                }
                if(document.f1.email.value!=document.f1.cnfemail.value)
                {
                    alert("Email Mismatch!");
                    f1.cnfemail.focus();
                    f1.cnfemail.select();
                    return false;
                }
                else
                {
                    if(!validate_email(document.f1.email.value,"Please enter valid email address"))
                    {
                        document.f1.email.select();
                        return false;
                    }
                }

                if(isNaN(document.f1.finalbids.value)){
                    alert('Final Bids Must be a number');
                    return ;
                }

                if(isNaN(document.f1.freebids.value)){
                    alert('Free Bids Must be a number');
                    return ;
                }

                /*		if(document.f1.phoneno.value=="")
                {
                        alert("Please enter phone number!!!");
                        document.f1.phoneno.focus();
                        return false;
                }
                 */	}
            function validate_email(field,alerttxt){
                with (field){
                    var value;
                    value = document.f1.email.value;
                    apos=value.indexOf("@");
                    dotpos=value.lastIndexOf(".");
                    if (apos<1||dotpos-apos<2){
                        alert(alerttxt);return false;
                    }else{
                        return true;
                    }
                }
            }

            function ConfirmDelete(id)
            {
                if(confirm("Are you sure to delete this member!!!"))
                {
                    window.location.href='addbiddinguser.php?deleterecord=' + id;
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
                                <h2><?php if ($_GET["editid"] != "") { ?>Edit Bidding User <?php } elseif ($_GET["delid"] != "") { ?>Delete Bidding User <?php } else { ?>Add Bidding User<?php } ?></h2>
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
                                                    <!--[if !IE]>end system messages<![endif]-->

                                                    <br/>

                                                    <!--[if !IE]>start forms<![endif]-->
                                                    <form action="" method="post" name="f1" onsubmit="return Check(this);" class="search_form general_form">
                                                        <!--[if !IE]>start fieldset<![endif]-->
                                                        <fieldset>
                                                            <!--[if !IE]>start forms<![endif]-->
                                                            <div class="forms">
                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>First Name:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper">
                                                                            <input class="text" type="text" name="firstname" size="20" value="<?= $obj->firstname != "" ? $obj->firstname : ""; ?>"/>
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
                                                                            <input class="text" type="text" name="lastname" size="20" value="<?= $obj->lastname != "" ? $obj->lastname : ""; ?>"/>
                                                                        </span>
                                                                        <span class="system required">*</span>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->

                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Country:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper blank">
                                                                            <select name="country">
                                                                                <option value="none">--</option>
                                                                                <?
                                                                                $qrycou = "select * from countries order by printable_name";
                                                                                $rescou = db_query($qrycou);
                                                                                while ($objcou = db_fetch_object($rescou)) {
                                                                                ?>
                                                                                    <option <?= $objcou->countryId == $obj->country ? "selected" : ""; ?> value="<?= $objcou->countryId; ?>"><?= $objcou->printable_name; ?></option>
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
                                                                    <label>User Name:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper">
                                                                            <input type="text" class="text" name="username" size="20" maxlength="16" value="<?= $obj->username != "" ? $obj->username : ""; ?>"/>
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
                                                                            <input type="password" class="text" name="password" size="20" value="<?= $obj->password != "" ? $obj->password : ""; ?>"/>
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
                                                                            <input type="password" class="text" name="cnfpassword" size="20" value="<?= $obj->password != "" ? $obj->password : ""; ?>"/>
                                                                        </span>
                                                                        <span class="system required">*</span>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->

                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Email:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper">
                                                                            <input type="text" name="email" class="text" size="20" value="<?= $obj->email != "" ? $obj->email : ""; ?>"/>
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
                                                                            <input type="text" name="cnfemail" class="text" size="20" value="<?= $obj->email != "" ? $obj->email : ""; ?>"/>
                                                                        </span>
                                                                        <span class="system required">*</span>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->

                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Final Bids:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper">
                                                                            <input type="text" name="finalbids" class="text" size="10" value="<?= $obj->final_bids != "" ? $obj->final_bids : "0"; ?>"/>
                                                                        </span>
                                                                        <span class="system required">*</span>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->

                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Free Bids:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper">
                                                                            <input type="text" name="freebids" class="text" size="10" value="<?= $obj->free_bids != "" ? $obj->free_bids : "0"; ?>"/>
                                                                        </span>
                                                                        <span class="system required">*</span>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->

                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Latitude,Longitude:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper">
                                                                            <input type="text" name="latlng" class="text" size="10" value="<?= $obj->position != "" ? $obj->position : "0"; ?>"/>
                                                                        </span>
                                                                        <span class="system required">*</span>
                                                                        <span class="system message">format is -34.397, 150.644</span>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->

                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Avatar:</label>
                                                                    <div class="inputs" style="width:760px;height: 400px;overflow:scroll;border:2px solid #08386D;">

                                                                        <input type="hidden" id="avatar" name="avatar" value="<?php echo $avatarid; ?>"/>
                                                                        <div class="avatarlist">
                                                                            <script type="text/javascript">
                                                                                $(document).ready(function(){
                                                                                    $(".avataritem").click(function(){
                                                                                        $(".avatar_outter").removeClass('selected');
                                                                                        $(this).parent().addClass('selected');
                                                                                        $('#avatar').val($(this).attr('rel'));
                                                                                        return false;
                                                                                    });

                                                                                    if($('#avatar').val()==''){
                                                                                        $(".avataritem:first").parent().addClass('selected');
                                                                                        //alert($(".avataritem:first").attr('rel'));
                                                                                        $('#avatar').val($(".avataritem:first").attr('rel'));
                                                                                    }
                                                                                    
                                                                                    
                                                                                });
                                                                            </script>
                                                                            <?php
                                                                                $avatardb = new Avatar(null);
                                                                                $avatarresult = $avatardb->selectAll();
                                                                                while ($avatar = db_fetch_object($avatarresult)) {
                                                                            ?>
                                                                                    <div class="avatar_outter <?php echo $avatarid == $avatar->id ? 'selected' : ''; ?>">
                                                                                        <a href="#" class="avataritem" rel="<?php echo $avatar->id; ?>"><img alt="" src="../uploads/avatars/<?php echo $avatar->avatar; ?>"/></a>
                                                                                    </div>
                                                                            <?php } ?>
                                                                            </div>
                                                                            <div class="clear"></div>

                                                                            <span class="system required">*</span>
                                                                        </div>
                                                                    </div>
                                                                    <!--[if !IE]>end row<![endif]-->

                                                                    <!--[if !IE]>start row<![endif]-->
                                                                    <div class="row">
                                                                        <div class="buttons">
                                                                            <ul>
                                                                                <li>
                                                                                <?php if ($_GET["editid"] != "") {
 ?>
                                                                                    <span class="button send_form_btn"><span><span>Edit</span></span><input name="edit" type="submit"/></span>
                                                                                    <input type="hidden" value="<?= $_GET["editid"]; ?>" name="editrecord" />
<?php } elseif ($_GET["delid"] != "") { ?>
                                                                                    <span class="button send_form_btn"><span><span>Delete</span></span><input name="delete" type="button" onclick="ConfirmDelete('<?= $_GET["delid"]; ?>')"/></span>
                                                                                <?php } else { ?>
                                                                                    <span class="button send_form_btn"><span><span>Add</span></span><input name="add" type="submit"/></span>
                                                                                <?php } ?>
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