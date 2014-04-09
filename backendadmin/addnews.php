<?
session_start();
$active="CMS";
include("connect.php");
include("config.inc.php");
include("security.php");

$newstitle = addslashes($_POST["newstitle"]);
$newscontent = addslashes($_POST["newscontent"]);
$longcontent = addslashes($_POST["description"]);
$newsdate = $_POST["nyear"]."-".$_POST["nmonth"]."-".$_POST["ndate"];

if($_POST["addnews"]!="") {
    $qrysel = "select * from news where news_date='$newsdate'";
    $ressel = db_query($qrysel);
    $totalrow = db_affected_rows();
    if($totalrow>0) {
        header("location: message.php?msg=31");
        exit;
    }
    else {
        $qryins = "insert into news (news_title,news_short_content,news_long_content,news_date) values('$newstitle','$newscontent','$longcontent','$newsdate')";
        db_query($qryins) or die(db_error());
        header("location: message.php?msg=30");
        exit;
    }

}

if($_POST["editnews"]!="") {
    $id = $_POST["editid"];
    $qrysel = "select * from news where news_date='$newsdate' and id<>$id";
    $ressel = db_query($qrysel);
    $totalrow = db_affected_rows();
    if($totalrow>0) {
        header("location: message.php?msg=31");
        exit;
    }
    else {
        $qryupd = "update news set news_title='$newstitle', news_date='$newsdate', news_short_content='$newscontent', news_long_content='$longcontent' where id='$id'";
        db_query($qryupd) or die(db_error());
        header("location: message.php?msg=32");
        exit;
    }
}

if($_GET["delid"]!="") {
    $qryd = "delete from news where id='".$_GET["delid"]."'";
    db_query($qryd) or die(db_error());
    header("location: message.php?msg=33");
    exit;
}

if($_REQUEST["news_edit"]!="" || $_REQUEST["news_delete"]!="") {
    if($_REQUEST["news_edit"]!="") {
        $id = $_REQUEST["news_edit"];
    }
    else {
        $id = $_REQUEST["news_delete"];
    }
    $qrysel = "select * from news where id=$id";
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
        <title><?php if($_GET['news_edit']!="") { ?> Edit News Topic<?php } else {
                if($_GET['news_delete']!="") { ?> Confirm Delete News Topic <?php }else { ?> Add News Topic <?php }
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
                if(document.f1.newstitle.value=="")
                {
                    alert("Please Enter Help Topic Title!!!");
                    document.f1.newstitle.focus();
                    return false;
                }
                if(document.f1.ndate.value=='none')
                {
                    alert("Please Select Date!!!");
                    document.f1.ndate.focus();
                    return false;
                }
                if(document.f1.nmonth.value=='none')
                {
                    alert("Please Select Date!!!");
                    document.f1.nmonth.focus();
                    return false;
                }
                if(document.f1.nyear.value=='none')
                {
                    alert("Please Select Date!!!");
                    document.f1.nyear.focus();
                    return false;
                }
                if(document.f1.newscontent.value=="")
                {
                    alert("Please Enter News Content!!!");
                    document.f1.newscontent.focus();
                    return false;
                }
            }
        </script>
        <script type="text/javascript" src="validation.js"></script>
        <script type="text/javascript" src="popupimage.js"></script>
        <script type="text/javascript" type="text/javascript" src="editor/tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
        <script type="text/javascript" type="text/javascript" src="editor.js"></script>
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
                                    <?php if($_GET['news_edit']!="") { ?> Edit News Topic<?php } else {
                                        if($_GET['news_delete']!="") { ?> Confirm Delete News Topic <?php }else { ?> Add News Topic <?php }
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

                                                    <!--[if !IE]>end system messages<![endif]-->

                                                    <br/>
                                                    <!--[if !IE]>start forms<![endif]-->
                                                    <form name="f1" action="addnews.php" method="post" onsubmit="return Check(f1)" class="search_form general_form">
                                                        <!--[if !IE]>start fieldset<![endif]-->
                                                        <fieldset>
                                                            <!--[if !IE]>start forms<![endif]-->
                                                            <div class="forms">
                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>News Title:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper">
                                                                            <input class="text" type="text" size="50" name="newstitle" value="<?=$row->news_title;?>" maxlength="100" />
                                                                        </span>
                                                                        <span class="system required">*</span>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->

                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>News Date:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper blank">
                                                                            <select name="ndate" style="display:inline;width: auto;">
                                                                                <option value="none">--</option>
                                                                                <?
                                                                                for($i=1;$i<=31;$i++) {
                                                                                    if($i<10) {
                                                                                        $i = "0".$i;
                                                                                    }
                                                                                    ?>
                                                                                <option <?=substr($row->news_date,8,2)==$i?"selected":"";?> value="<?=$i;?>"><?=$i;?></option>
                                                                                    <?
                                                                                }
                                                                                ?>
                                                                            </select>
                                                                            <select name="nmonth" style="display:inline;width: auto;">
                                                                                <option value="none">--</option>
                                                                                <?
                                                                                for($i=1;$i<=12;$i++) {
                                                                                    if($i<10) {
                                                                                        $i = "0".$i;
                                                                                    }
                                                                                    ?>
                                                                                <option <?=substr($row->news_date,5,2)==$i?"selected":"";?> value="<?=$i;?>"><?=$i;?></option>
                                                                                    <?
                                                                                }
                                                                                ?>
                                                                            </select>
                                                                            <select name="nyear" style="display:inline;width: auto;">
                                                                                <option value="none">----</option>
                                                                                <?
                                                                                for($i=2000;$i<=2050;$i++) {
                                                                                    ?>
                                                                                <option <?=substr($row->news_date,0,4)==$i?"selected":"";?> value="<?=$i;?>"><?=$i;?></option>
                                                                                    <?
                                                                                }
                                                                                ?>
                                                                            </select>
                                                                        </span>
                                                                        <span class="system required">*</span>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]--

                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Short Description:</label><span class="system required">*</span>
                                                                   <br /> <div class="inputs">
                                                                        <span class="">
                                                                            <textarea class="text" rows="5" cols="50" name="newscontent"><?=stripslashes($row->news_short_content);?></textarea>
                                                                        </span>
                                                                        
                                                                    </div>
                                                                </div>
                                                                
                                                                <!--[if !IE]>end row<![endif]-->

                                                                   <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <div class="inputs">
                                                                     
                                                                        
                                                                    </div>
                                                                </div>
                                                                
                                                                <!--[if !IE]>end row<![endif]-->
                                                                
                                                                
                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Long Description:</label>
                                                               <br />     <div class="inputs">
                                                                        <span class="">
                                                                            <textarea class="text" rows="20" cols="90" name="description"><?=stripslashes($row->news_long_content);?></textarea>
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
                                                                                if($_REQUEST["news_edit"]) {
                                                                                    ?>
                                                                                <span class="button send_form_btn"><span><span>Edit News</span></span><input name="editnews" type="submit"/></span>
                                                                                <input type="hidden" name="editid" value="<?=$id?>" />
                                                                                    <?
                                                                                }
                                                                                elseif($_REQUEST["news_delete"]) {
                                                                                    ?>
                                                                                <span class="button send_form_btn"><span><span>Delete News</span></span><input name="deletenews" type="button" onclick="javascript: window.location.href='addnews.php?delid=<?=$id?>';"/></span>
                                                                                    <?
                                                                                }
                                                                                else {
                                                                                    ?>
                                                                                <span class="button send_form_btn"><span><span>Add News</span></span><input name="addnews" type="submit"/></span>
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