<?
session_start();
$active="CMS";
include("connect.php");
include("admin.config.inc.php");
include("security.php");

$title = $_POST["title"];

if($_POST["addhelptopic"]!="") {
    $qrysel = "select * from topic_title where title='$title'";
    $ressel = db_query($qrysel);
    $totalrow = db_affected_rows();
    if($totalrow>0) {
        header("location: message.php?msg=21");
        exit;
    }
    else {
        $qryins = "insert into helptopic (topic_title) values ('$title')";
        db_query($qryins) or die(db_error());
        header("location: message.php?msg=22");
        exit;
    }

}

if($_POST["edithelptopic"]!="") {
    $id = $_POST["editid"];
    $qrysel = "select * from helptopic where topic_title='$title' and topic_id<>$id";
    $ressel = db_query($qrysel);
    $totalrow = db_affected_rows();
    if($totalrow>0) {
        header("location: message.php?msg=21");
        exit;
    }
    else {
        $qryupd = "update helptopic set topic_title='$title' where topic_id='$id'";
        db_query($qryupd) or die(db_error());
        header("location: message.php?msg=23");
        exit;
    }
}

if($_GET["delid"]!="") {
    $qryd = "delete from helptopic where topic_id='".$_GET["delid"]."'";
    db_query($qryd) or die(db_error());
    header("location: message.php?msg=24");
    exit;
}

if($_REQUEST["help_edit"]!="" || $_REQUEST["help_delete"]!="") {
    if($_REQUEST["help_edit"]!="") {
        $id = $_REQUEST["help_edit"];
    }
    else {
        $id = $_REQUEST["help_delete"];
    }
    $qrysel = "select * from helptopic where topic_id=$id";
    $res = db_query($qrysel);
    $totalrow = db_affected_rows();
    $row = db_fetch_object($res);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="imagetoolbar" content="no" />
        <title><?php if($_GET['help_edit']!="") { ?> Edit Help Topic<?php } else {
                if($_GET['help_delete']!="") { ?> Confirm Delete Help Topic <?php }else { ?> Add Help Topic <?php }
            }
            ?>-<?php echo $ADMIN_MAIN_SITE_NAME ?></title>
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
                if(document.f1.title.value=="")
                {
                    alert("Please Enter Help Topic Title");
                    document.f1.title.focus();
                    return false;
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
                                <h2>
                                    <?php if($_GET['help_edit']!="") { ?> Edit Help Topic<?php } else {
                                        if($_GET['help_delete']!="") { ?> Confirm Delete Help Topic <?php }else { ?> Add Help Topic <?php }
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
                                                        <li class="blue"><span class="ico"></span><strong class="system_title"><span class="required">*</span> Required Information</strong></li>
                                                    </ul>

                                                    <br/>
                                                    <!--[if !IE]>end system messages<![endif]-->

                                                    <!--[if !IE]>start forms<![endif]-->
                                                    <form name="f1" action="addhelptopic.php" method="post" onsubmit="return Check(f1)" class="search_form general_form">
                                                        <!--[if !IE]>start fieldset<![endif]-->
                                                        <fieldset>
                                                            <!--[if !IE]>start forms<![endif]-->
                                                            <div class="forms">
                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Topic Title:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper">
                                                                            <input class="text" type="text" size="50" name="title" value="<?=$row->topic_title;?>" />
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
                                                                                <?
                                                                                if($_REQUEST["help_edit"]) {
                                                                                    ?>
                                                                                <span class="button send_form_btn"><span><span>Edit Help Topic</span></span><input name="edithelptopic" type="submit" /></span>
                                                                                <input type="hidden" name="editid" value="<?=$id?>" />
                                                                                    <?
                                                                                }
                                                                                elseif($_REQUEST["help_delete"]) {
                                                                                    ?>
                                                                                <span class="button send_form_btn"><span><span>Delete Help Topic</span></span><input name="deletehelptopic" type="button" onclick="javascript: window.location.href='addhelptopic.php?delid=<?=$id?>';"/></span>
                                                                                    <?
                                                                                }
                                                                                else {
                                                                                    ?>
                                                                                <span class="button send_form_btn"><span><span>Add Help Topic</span></span><input name="addhelptopic" type="submit" /></span>
                                                                                    <?
                                                                                }
                                                                                ?>
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