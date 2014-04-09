<?php
session_start();
$active="CMS";
include("connect.php");
include("config.inc.php");
include("security.php");
include("sendmail.php");

if($_POST["deletenewsletter"]!="") {
    $qrydelete = "delete from newsletter_email where id='".$_POST["delete_id"]."'";
    db_query($qrydelete) or die(db_error());
    header("location: message.php?msg=42");
    exit;
}

if($_POST["sendandsave"]!="") {
    $subject = $_POST["subject"];
    $content1 = $_POST["description"];
    $from = $adminemailadd;

    $qryins = "insert into newsletter_email (date,subject,content) values('".date("Y-m-d",time())."','".addslashes($subject)."','".addslashes($content1)."')";
    db_query($qryins) or die(db_error());

    $content='';
    $content.= "<font style='font-size: 10px;font-family: Arial, Helvetica, sans-serif;color: #333333;'>Dear Members,"."</font><br>"."<br>"."<p align='center' style='font-size: 14px;font-family: Arial, Helvetica, sans-serif;font-weight:bold;'></p>"."<br>".

            "<table border='0' cellpadding='3' cellspacing='0' width='100%' align='center' class='style13'>";

    $content.="<tr style='font-size: 10px;font-family: Arial, Helvetica, sans-serif;color: #333333;'>".$content1."</tr>
		</table>";

    $qrysel = "select * from registration where newsletter='1' and account_status='1' and member_status='0' and user_delete_flag!='d'";
    $ressel = db_query($qrysel);
    $total = db_num_rows($ressel);

    while($obj = db_fetch_object($ressel)) {
        if($obj->newsletter_email!="") {
            $to = $obj->newsletter_email;
        }
        else {
            $to = $obj->email;
        }

//			echo $subject."<br>";
//			echo $to."<br>";
//			echo $from."<br>";
//			echo $content."<br>";
        SendHTMLMail($to,$subject,$content,$from);
    }
    header("location: message.php?msg=61");
    exit;
}

if($_POST["send"]!="") {
    $subject = $_POST["subject"];
    $content1 = $_POST["description"];
    $from = $adminemailadd;

    $content='';
    $content.= "<font style='font-size: 10px;font-family: Arial, Helvetica, sans-serif;color: #333333;'>Dear Members,"."</font><br>"."<br>"."<p align='center' style='font-size: 14px;font-family: Arial, Helvetica, sans-serif;font-weight:bold;'></p>"."<br>".

            "<table border='0' cellpadding='3' cellspacing='0' width='100%' align='center' class='style13'>";

    $content.="<tr style='font-size: 10px;font-family: Arial, Helvetica, sans-serif;color: #333333;'>".$content1."</tr>
		</table>";

    $qrysel = "select * from registration where newsletter='1' and account_status='1' and member_status='0' and user_delete_flag!='d'";
    $ressel = db_query($qrysel);
    $total = db_num_rows($ressel);

    while($obj = db_fetch_object($ressel)) {
        if($obj->newsletter_email!="") {
            $to = $obj->newsletter_email;
        }
        else {
            $to = $obj->email;
        }

//			echo $subject."<br>";
//			echo $to."<br>";
//			echo $from."<br>";
//			echo $content."<br>";
        SendHTMLMail($to,$subject,$content,$from);
    }
    header("location: message.php?msg=43");
    exit;
}

if($_POST["save"]!="") {
    $subject = $_POST["subject"];
    $content1 = $_POST["description"];
    $from = $adminemailadd;

    $qryins = "insert into newsletter_email (date,subject,content) values('".date("Y-m-d",time())."','".addslashes($subject)."','".addslashes($content1)."')";
    db_query($qryins) or die(db_error());

    $content='';
    $content.= "<font style='font-size: 10px;font-family: Arial, Helvetica, sans-serif;color: #333333;'>Dear Members,"."</font><br>"."<br>"."<p align='center' style='font-size: 14px;font-family: Arial, Helvetica, sans-serif;font-weight:bold;'></p>"."<br>".

            "<table border='0' cellpadding='3' cellspacing='0' width='100%' align='center' class='style13'>";

    $content.="<tr style='font-size: 10px;font-family: Arial, Helvetica, sans-serif;color: #333333;'>".$content1."</tr>
		</table>";

    $qrysel = "select * from registration where newsletter='1' and account_status='1' and member_status='0' and user_delete_flag!='d'";
    $ressel = db_query($qrysel);
    $total = db_num_rows($ressel);

    header("location: message.php?msg=62");
    exit;
}

if($_GET["newsletter_delete"]!="" || $_GET["newsletter_resend"]) {
    if($_GET["newsletter_delete"]!="") {
        $id = $_GET["newsletter_delete"];
    }
    else {
        $id = $_GET["newsletter_resend"];
    }
    $qrysel1 = "select * from newsletter_email where id='".$id."'";
    $ressel1 = db_query($qrysel1);
    $obj1 = db_fetch_object($ressel1);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="imagetoolbar" content="no" />
        <title><?php if($_GET["newsletter_delete"]!="") {?>Delete newsletter <?php } else { ?>Send newsletter<?php } ?>-<?php echo $ADMIN_MAIN_SITE_NAME ?></title>
        <link media="screen" rel="stylesheet" type="text/css" href="css/admin.css"  />
        <!--[if lte IE 6]><link media="screen" rel="stylesheet" type="text/css" href="css/admin-ie.css" /><![endif]-->
        <link type="text/css" href="css/cupertino/ui.all.css" rel="stylesheet" />
        <link type="text/css" href="css/cupertino/jquery-ui-1.7.3.custom.css" rel="stylesheet" />

        <!--[if lte IE 6]><link media="screen" rel="stylesheet" type="text/css" href="css/admin-ie.css" /><![endif]-->
        <script type="text/javascript" src="js/behaviour.js"></script>
        <script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
        <script type="text/javascript" src="js/ui/jquery-ui-1.7.2.custom.min.js"></script>
        <script type="text/javascript" src="editor/tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
        <script type="text/javascript" src="editor.js"></script>
        <script type="text/javascript">
            function Check()
            {
                if(document.newsletter.subject.value=="")
                {
                    alert("Please Enter Email Subject");
                    document.newsletter.subject.focus();
                    return false;
                }
                /*		if(document.newsletter.description.value=="")
                        {
                                alert("Please Enter Email Content");
                                return false;
                        }
                 */	}
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
                                <h2>
                                    <?php if($_GET["newsletter_delete"]!="") {?>Delete newsletter <?php } else { ?>Send newsletter<?php } ?>
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
                                                        <?php if ( $msg != "" ) {
                                                            ?>
                                                        <li class="red"><span class="ico"></span><strong class="system_title"><?=$msg;?></strong></li>
                                                            <?php }?>
                                                        <li class="blue"><span class="ico"></span><strong class="system_title"><span class="required">*</span> Required Information</strong></li>
                                                    </ul>

                                                    <!--[if !IE]>end system messages<![endif]-->

                                                    <!--[if !IE]>start forms<![endif]-->
                                                    <form name="newsletter" action="" method="post" onsubmit="return Check();" class="search_form general_form">
                                                        <!--[if !IE]>start fieldset<![endif]-->
                                                        <fieldset>
                                                            <!--[if !IE]>start forms<![endif]-->
                                                            <div class="forms">
                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Subject:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper">
                                                                            <input class="text" type="text" name="subject" size="50" value="<?=$obj1->subject!=""?stripslashes($obj1->subject):"";?>" />
                                                                        </span>
                                                                        <span class="system required">*</span>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->

                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Content:</label>
                                                                    <div class="inputs">
                                                                        <span class="">
                                                                            <textarea name="description" rows="25" cols="80"><?=$obj1->content!=""?stripslashes($obj1->content):"";?></textarea>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->

                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <div class="buttons">
                                                                        <ul>
                                                                            <li>
                                                                                <?
                                                                                if($_GET["newsletter_delete"]!="") {
                                                                                    ?>
                                                                                <span class="button send_form_btn"><span><span>Delete</span></span><input name="deletenewsletter" type="submit" onclick="return confirm('Are you sure to delete this newsletter')" /></span>                                                                                
                                                                                <input type="hidden" name="delete_id" value="<?=$_GET["newsletter_delete"];?>" />
                                                                                    <?
                                                                                }else {
                                                                                    ?>
                                                                                <span class="button send_form_btn"><span><span>Send</span></span><input name="send" type="submit"/></span>
                                                                                    <?
                                                                                }
                                                                                ?>
                                                                            </li>

                                                                            <?
                                                                            if($_GET["newsletter_delete"]=="" && $_GET["newsletter_resend"]=="") {
                                                                                ?>
                                                                            <li>
                                                                                <span class="button send_form_btn"><span><span>Send & Save</span></span><input name="sendandsave" type="submit"/></span>
                                                                            </li>
                                                                            <li>
                                                                                <span class="button send_form_btn"><span><span>Save</span></span><input name="save" type="submit"/></span>
                                                                            </li>
                                                                                                                                                                                                                                                                                                                                                                                                <?
                                                                            }
                                                                            ?>
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