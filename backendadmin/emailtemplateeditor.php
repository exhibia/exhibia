<?php
@session_start();
$active = "Email";
include("admin.config.inc.php");
include("connect.php");
include("security.php");
include("functions.php");
include_once '../data/emailtemplate.php';
ini_set('display_errors', 1);
$Error = FALSE;

if (isset($_POST['submit'])) {
    $name = isset($_POST["name"]) ? chkInput($_POST["name"], 's') : '';
    $content = addslashes($_POST["description"]);
    $subject = chkInput($_POST['subject'], 's');

    if ($subject != "") {
    
    if(db_num_rows(db_query("select * from emailtemplate where name = '$name'")) >= 1){
        EmailTemplate::updateEmailTemplate($name, $subject, $content);
       }else{
       
       EmailTemplate::addEmailTemplate($name, $subject, $content);
       
       
       }
        header("Location: message.php?msg=114&name=$name");
        exit;
    } else {
        $Error = true;
    }
} else {

    $name = isset($_GET["name"]) ? chkInput($_GET["name"], 's') : '';
    if ($name == '') {
        header("location:inneremail.php");
        exit;
    }
    $emailtemplate = EmailTemplate::getEmailTemplate($name);
  
    $subject = $emailtemplate->subject;
    $content = $emailtemplate->content;
    $name = $emailtemplate->name == '' ? $name : $emailtemplate->name;
}
echo db_error();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="imagetoolbar" content="no" />
        <title><?php
switch ($name) {
    case 'acceptauction_notpay':
        echo "Accept Auction Notify Email For Need Not Pay";
        break;
    case 'acceptauction_pay':
        echo "Accept Auction Notify Email";
        break;
    case 'denyauction':
        echo "Deny Auction";
        break;
    case 'registration':
        echo "Registration Email";
        break;
    case 'affiliate':
        echo "Affiliate Email";
        break;
    case 'wonauction':
        echo "Won Auction Email Template";
        break;
    case 'feedback':
        echo "Feedback Email";
        break;
    case 'forgetpassword':
        echo "Forget Password Email";
        break;
    case 'newsletter':
        echo "News Letter Email";
        break;
    case 'inviter':
        echo "Inviter Email";
        break;
    case 'wonauction':
        echo "Won Auction";
        break;
    default:
    echo $name;
    break;
    
}
?>-<?php echo $ADMIN_MAIN_SITE_NAME ?></title>
        <link media="screen" rel="stylesheet" type="text/css" href="css/admin.css"  />
        <!--[if lte IE 6]><link media="screen" rel="stylesheet" type="text/css" href="css/admin-ie.css" /><![endif]-->
        <script type="text/javascript" src="js/behaviour.js"></script>
        <script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
     
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
                                <h2>
                                    <?php
                                    switch ($name) {
                                        case 'acceptauction_notpay':
                                            echo "Accept Auction Notify Email Template For Need Not Pay";
                                            break;
                                        case 'acceptauction_pay':
                                            echo "Accept Auction Notify Email";
                                            break;
                                        case 'denyauction':
                                            echo "Deny Auction";
                                            break;
                                        case 'registration':
                                            echo "Registration Email";
                                            break;
                                        case 'affiliate':
                                            echo "Affiliate Email";
                                            break;
                                        case 'wonauction':
                                            echo "Won Auction Email Template";
                                            break;
                                        case 'feedback':
                                            echo "Feedback Email";
                                            break;
                                        case 'forgetpassword':
                                            echo "Forget Password Email";
                                            break;
                                        case 'newsletter':
                                            echo "News Letter Email";
                                            break;
                                        case 'inviter':
                                            echo 'Inviter Email';
                                            break;
                                        case 'wonauction':
                                            echo 'Won Auction';
                                            break;
                                        default:
                                            echo "$name";
                                    }
                                    ?>
                                </h2>
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
                                                        <?php
                                                        if ($Error == true) {
                                                        ?>
                                                            <li class="red"><span class="ico"></span><strong class="system_title">Form Not Completely Filled!!!</strong></li>
                                                        <?php } ?>
                                                    </ul>

                                                    <!--[if !IE]>end system messages<![endif]-->

                                                    <!--[if !IE]>start forms<![endif]-->
                                                    <form name="addprod" action="#" method="post" enctype="multipart/form-data" class="search_form general_form">
                                                        <!--[if !IE]>start fieldset<![endif]-->
                                                        <fieldset>
                                                            <!--[if !IE]>start forms<![endif]-->
                                                            <div class="forms">
                                                             <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                
                                                                    <label>Template Name:</label>
                                                                    <div class="inputs">
                                                                        <span class="">
                                                                        <?php 
                                                                        if($_GET['name'] != 'addemail'){
                                                                        ?>
									<input name="name" type="hidden" value="<?php echo $name; ?>"/>
									<?php }else{ ?>
									
									<input name="name" type="text" value=""/>
									
									
									<?php } ?>
								    </span>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->
                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                
                                                                    <label>Subject:</label>
                                                                    <div class="inputs">
                                                                        <span class="">
                                                                            <textarea name="subject" rows="5" cols="50" maxlength="200"><?php echo $subject; ?></textarea>
<!--                                                                            <input name="subject" type="text" class="text" value="<?php echo $subject; ?>" maxlength="50"/>-->
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->

                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Content:</label>
                                                                    <div class="inputs">
                                                                        <span class="">
                                                                            <textarea name="description" rows="20" cols="110"><?php echo $content; ?></textarea>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->

                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <div class="buttons">
                                                                        <ul>
                                                                            <li>
                                                                                <span class="button send_form_btn"><span><span>Edit</span></span><input name="submit" type="submit"/></span>
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