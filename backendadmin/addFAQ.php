<?
session_start();
$active="CMS";
include("connect.php");
include("admin.config.inc.php");
include("security.php");

$topic = $_POST["topic"];
$quetitle = addslashes($_POST["quetitle"]);
$content = addslashes($_POST["description"]);

if($_POST["addfaq"]!="") {
    $qrys = "select * from faq where que_title='$quetitle'";
    $ress = db_query($qrys);
    $totals = db_affected_rows();
    if($totals>0) {
        header("location: message.php?msg=27");
        exit;
    }
    else {
        $qryins = "insert into faq (parent_topic, que_title, que_content) values('$topic','$quetitle','$content')";
        db_query($qryins) or die(db_error());

        header("location: message.php?msg=25");
        exit;
    }
}

if($_POST["editfaq"]!="") {
    $id = $_POST["editid"];
    $qrys = "select * from faq where que_title='$quetitle' and id<>'$id'";
    $ress = db_query($qrys);
    $totals = db_affected_rows();
    if($totals>0) {
        header("location: message.php?msg=27");
        exit;
    }
    else {
        $qryupd = "Update faq set parent_topic='$topic', que_title='$quetitle', que_content='$content' where id='$id'";
        db_query($qryupd) or die(db_error());
        header("location: message.php?msg=26");
        exit;
    }
}

if($_GET["delid"]!="") {
    $id = $_GET["delid"];
    $qryd = "delete from faq where id='$id'";
    db_query($qryd) or die(db_error());
    header("location: message.php?msg=28");
}

if($_GET["faq_edit"]!="" || $_GET["faq_delete"]!="") {
    if($_GET["faq_edit"]!="") {
        $id = $_GET["faq_edit"];
    }
    else {
        $id = $_GET["faq_delete"];
    }

    $qrysel = "select * from faq where id='$id'";
    $ressel = db_query($qrysel);
    $totalrow = db_affected_rows();
    $rows = db_fetch_object($ressel);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="imagetoolbar" content="no" />
        <title><?php if($_GET['faq_edit']!="") { ?> Edit FAQ<?php } else {
                if($_GET['faq_delete']!="") { ?> Confirm Delete FAQ <?php }else { ?> Add FAQ <?php }
            }
            ?>-<?php echo $ADMIN_MAIN_SITE_NAME ?></title>
        <link media="screen" rel="stylesheet" type="text/css" href="css/admin.css"  />
        <!--[if lte IE 6]><link media="screen" rel="stylesheet" type="text/css" href="css/admin-ie.css" /><![endif]-->
        <link type="text/css" href="css/cupertino/ui.all.css" rel="stylesheet" />
        <link type="text/css" href="css/cupertino/jquery-ui-1.7.3.custom.css" rel="stylesheet" />

        <!--[if lte IE 6]><link media="screen" rel="stylesheet" type="text/css" href="css/admin-ie.css" /><![endif]-->
        <script type="text/javascript" src="js/behaviour.js"></script>
      <?php include("page_headers.php"); ?>
        <script type="text/javascript" src="editor/tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
        <script type="text/javascript" src="editor.js"></script>
        
        <script type="text/javascript" class="g-s">
        </script>
        <script type="text/javascript">
            function Check(f1)
            {
                if(document.f1.topic.value=="none")
                {
                    alert("Please select help topic");
                    document.f1.topic.focus();
                    return false;
                }

                if(document.f1.quetitle.value=="")
                {
                    alert("Please Enter Question Title");
                    document.f1.quetitle.focus();
                    return false;
                }

                /*	if(document.f1.description.value=="")
                {
                        alert("Please Enter Question Content");
                        //document.f1.description.focus();
                        return false;
                }
                 */}
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
                                    <?php if($_GET['faq_edit']!="") { ?> Edit FAQ<?php } else {
                                        if($_GET['faq_delete']!="") { ?> Confirm Delete FAQ <?php }else { ?> Add FAQ <?php }
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
                                                    <form name="f1" action="addFAQ.php" method="post" onsubmit="return Check(f1)" class="search_form general_form">
                                                        <!--[if !IE]>start fieldset<![endif]-->
                                                        <fieldset>
                                                            <!--[if !IE]>start forms<![endif]-->
                                                            <div class="forms">

                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Help Topic:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper blank">
                                                                            <select name="topic">
                                                                                <option value="none">select one</option>
                                                                                <?
                                                                                $qry = "select * from helptopic";
                                                                                $res = db_query($qry);
                                                                                $totalrow = db_affected_rows();
                                                                                while($tp = db_fetch_array($res)) {
                                                                                    ?>
                                                                                <option <?=$rows->parent_topic==$tp["topic_id"]?"selected":"";?> value="<?=$tp["topic_id"];?>"><?=$tp["topic_title"];?></option>
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
                                                                    <label>Question Content:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper">
                                                                            <input class="text" type="text" size="50" name="quetitle" value="<?=$rows->que_title!=""?stripslashes($rows->que_title):""; ?>" />
                                                                        </span>
                                                                        <span class="system required">*</span>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->

                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Answer:</label>
                                                                    <div class="inputs">
                                                                        <span class="">
                                                                            <textarea class="text" name="description" cols="80" rows="25" class="ckeditor"><?=$rows->que_content!=""?stripslashes($rows->que_content):"";?></textarea>
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
                                                                                if($_REQUEST["faq_edit"]) {
                                                                                    ?>
                                                                                <span class="button send_form_btn"><span><span>Edit FAQ</span></span><input name="editfaq" type="submit"/></span>
                                                                                <input type="hidden" name="editid" value="<?=$id?>" />
                                                                                    <?
                                                                                }
                                                                                elseif($_REQUEST["faq_delete"]) {
                                                                                    ?>
                                                                                <span class="button send_form_btn"><span><span>Delete FAQ</span></span><input name="deletefaq" type="button" onclick="javascript: window.location.href='addFAQ.php?delid=<?=$id?>';"/></span>
                                                                                    <?
                                                                                }
                                                                                else {
                                                                                    ?>
                                                                                <span class="button send_form_btn"><span><span>Add FAQ</span></span><input name="addfaq" type="submit"/></span>
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