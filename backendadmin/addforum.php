<?php
session_start();
$active="Forum";
include("connect.php");
include("admin.config.inc.php");
include("security.php");
include("functions.php");

$forumstitle = $_POST["forumtitle"];
$forumscategory = $_POST["forumcategory"];
$forumdescription = $_POST["forumdescription"];
$forumstatus = $_POST["forumstatus"];

if($_POST["addforum"]!="") {
    $qrysel = "select * from forums where forums_name='$forumstitle'";
    $ressel = db_query($qrysel);
    $totalrow = db_affected_rows();
    if($totalrow>0) {
        header("location: message.php?msg=82");
        exit;
    }
    else {
        $qryins = "Insert into forums (forums_category,forums_name,forums_description,forum_status) values('".$forumscategory."','".$forumstitle."','".$forumdescription."','".$forumstatus."')";
        db_query($qryins) or die(db_error());
        header("location: message.php?msg=83");
        exit;
    }

}

if($_POST["editforum"]!="") {
    $id = $_POST["editid"];

    $qrysel = "select * from forums where forums_name='$forumstitle' and forum_id<>$id";
    $ressel = db_query($qrysel);
    $totalrow = db_affected_rows();
    if($totalrow>0) {
        header("location: message.php?msg=82");
        exit;
    }
    else {
        $qryupd = "update forums set forums_name='$forumstitle',forums_category='$forumscategory',forums_description='$forumdescription',forum_status='".$forumstatus."' where forums_id='$id'";
        db_query($qryupd) or die(db_error());
        header("location: message.php?msg=87");
        exit;
    }
}

if($_GET["delid"]!="") {
    $qryd = "delete from forums where forums_id='".$_GET["delid"]."'";
    db_query($qryd) or die(db_error());
    header("location: message.php?msg=88");
    exit;
}

if($_REQUEST["forum_edit"]!="" || $_REQUEST["forum_delete"]!="") {
    if($_REQUEST["forum_edit"]!="") {
        $id = $_REQUEST["forum_edit"];
    }
    else {
        $id = $_REQUEST["forum_delete"];
    }
    $qrysel = "select * from forums f left join forum_categories fc on f.forums_category=fc.category_id where forums_id='$id'";
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
        <title><?php if($_GET['forum_edit']!="") { ?> Edit Forums<?php } else {
                if($_GET['forum_delete']!="") { ?> Confirm Delete Forums <?php }else { ?> Add Forums <?php }
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
                if(document.f1.forumtitle.value=="")
                {
                    alert("Please enter forums name!");
                    document.f1.forumtitle.focus();
                    return false;
                }
                if(document.f1.forumcategory.value=="none")
                {
                    alert("Please select forums category!");
                    document.f1.forumcategory.focus();
                    return false;
                }
                if($('#forumdescription').ckeditorGet()=="")
                {
                    alert("Please enter forums description!");
                  
                    return false;
                }
            }

            function PutSmileys(value)
            {
                document.f1.forumdescription.value += value;
                document.f1.forumdescription.focus();
            }
            function delconfirm(loc)
            {
                if(confirm("Are you sure do you want to delete this?"))
                {
                    window.location.href=loc;
                }
                return false;
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
                                    <?php if($_GET['forum_edit']!="") { ?> Edit Forums<?php } else {
                                        if($_GET['forum_delete']!="") { ?> Confirm Delete Forums <?php }else { ?> Add Forums <?php }
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
                                                    <form name="f1" action="addforum.php" method="post" onsubmit="return Check(f1)" class="search_form general_form">
                                                        <!--[if !IE]>start fieldset<![endif]-->
                                                        <fieldset>
                                                            <!--[if !IE]>start forms<![endif]-->
                                                            <div class="forms">
                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Forum Name:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper">
                                                                            <input class="text" type="text" maxlength="120" size="50" name="forumtitle" value="<?=stripslashes($row->forums_name);?>" />
                                                                        </span>
                                                                        <span class="system required">*</span>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->

                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Forum Category:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper blank">
                                                                            <select name="forumcategory">
                                                                                <option value="none">select one</option>
                                                                                <?
                                                                                $qrycat = "select * from forum_categories where status='0'";
                                                                                $rescat = db_query($qrycat);
                                                                                while($objcat = db_fetch_array($rescat)) {
                                                                                    ?>
                                                                                <option <?=$row->forums_category==$objcat["category_id"]?"selected":"";?> value="<?=$objcat["category_id"];?>"><?=$objcat["category_name"];?></option>
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
                                                                    <label>Enabled/Disabled:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper blank">
                                                                            <select name="forumstatus">
                                                                                <option value="0">Enabled</option>
                                                                                <option <?=$row->forum_status=="1"?"selected":"";?> value="1">Disabled</option>
                                                                            </select>
                                                                        </span>
                                                                        <span class="system required">*</span>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->

                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Forum Description:</label>
                                                                    <div class="inputs">
                                                                      
                                                                            <textarea class="text" id="forumdescription" name="forumdescription" cols="70" rows="10"><?=stripslashes($row->forums_description);?></textarea>
                                                                        
                                                                        <span class="system required">*</span>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->

                                                                <!--[if !IE]>start row<![endif]
                                                                <div class="row">
                                                                    <label>&nbsp;</label>
                                                                    <div class="inputs">
                                                                        <span class="textarea_wrapper">
                                                                            <div style="width:410px;">
                                                                                <?
                                                                                foreach ($smileysname as $key => $value) {
                                                                                    ?>
                                                                                <a href='javascript:PutSmileys(" <?=$value;?> ")'><img src="../images/smileys/<?=$key;?>" style="border:none;" alt=""/></a>
                                                                                    <?
                                                                                }
                                                                                ?>
                                                                            </div>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                               [if !IE]>end row<![endif]-->

                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <div class="buttons">
                                                                        <ul>
                                                                            <li>
                                                                                <?
                                                                                if($_REQUEST["forum_edit"]) {
                                                                                    ?>
                                                                                <span class="button send_form_btn"><span><span>Edit Forum</span></span><input name="editforum" type="submit"/></span>
                                                                                <input type="hidden" name="editid" value="<?=$id?>" />
                                                                                    <?
                                                                                }
                                                                                elseif($_REQUEST["forum_delete"]) {
                                                                                    ?>
                                                                                <span class="button send_form_btn"><span><span>Delete Forum</span></span><input name="deleteforum" type="button" onclick="delconfirm('addforum.php?delid=<?=$id?>');"/></span>
                                                                                    <?
                                                                                }
                                                                                else {
                                                                                    ?>
                                                                                <span class="button send_form_btn"><span><span>Add Forum</span></span><input name="addforum" type="submit"/></span>
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