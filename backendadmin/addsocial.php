<?
session_start();
$active = "CMS";
include("connect.php");
include("admin.config.inc.php");
include("security.php");
include("functions.php");
include("imgsize.php");
include("gd.inc.php");

//function deletePicture($id) {
//    $sql = "select bidpack_banner from bidpack where id='$id'";
//    $result = db_query($sql);
//    $obj = db_fetch_array($result);
//    deleteImage($obj['bidpack_banner']);
//}

$socialurl = chkInput($_REQUEST["socialurl"], 's');
$socialname = chkInput($_REQUEST['socialname'], 's');
$actived = chkInput($_REQUEST['actived'], 'i');
if ($_POST["addsocial"] != "") {
    $qryins = "Insert into social_support(socialname,socialpath,socialurl,actived) values('$socialname','','$socialurl','$actived')";
    db_query($qryins) or die(db_error());

    $pid = db_insert_id();

    if (isset($_FILES["image"]) && $_FILES["image"]["name"] && preg_match('/\.(jpg|jpeg|gif|jpe|png|bmp)$/i', $_FILES["image"]["name"]) && preg_match('/\.(php|asp|jsp)$/i', $_FILES["image"]["name"]) == false) {
        $time = time();
        $imagename = $time . "_" . $_FILES["image"]["name"];
        $dest = "../uploads/social/";

        if (file_exists($dest) == false) {
            mkdir($dest);
        }

        //echo $imagename;
        copy($_FILES['image']['tmp_name'], $dest . $imagename);
        db_query("update social_support set socialpath='" . $imagename . "' where id=$pid") or die(db_error());
    }else{
        $imageerror="Invalid image file";
    }

    header("location: message.php?msg=117");
    exit;
} elseif ($_REQUEST["editsocial"]) {
    $id = $_REQUEST["editid"];

    $qryupd = "update social_support set socialname='$socialname', socialurl='$socialurl',actived='$actived' where id=$id";

    if (isset($_FILES["image"]) && $_FILES["image"]["name"] && preg_match('/\.(jpg|jpeg|gif|jpe|png|bmp)$/i', $_FILES["image"]["name"]) && preg_match('/\.(php|asp|jsp)$/i', $_FILES["image"]["name"]) == false) {
        $time = time();
        $imagename = $time . "_" . $_FILES["image"]["name"];
        $dest = "../uploads/social/";

        if (file_exists($dest) == false) {
            mkdir($dest);
        }

        //echo $imagename;
        copy($_FILES['image']['tmp_name'], $dest . $imagename);
        db_query("update social_support set socialpath='" . $imagename . "' where id=$id") or die(db_error());
    }else{
        $imageerror="Invalid image file";
    }

    db_query($qryupd) or die(db_error());
    header("location: message.php?msg=117");
    exit;
}

if ($_GET["delid"] != "") {
    $id = chkInput($_GET['delid'], 'i');
    $tempsql = "select * from social_support where id=$id";
    $tempresult = db_query($tempsql);
    $tempobj = db_fetch_array($tempresult);
    $socialpath = $tempobj['socialpath'];

    if (file_exists("../$UploadImagePath/social/" . $socialpath)) {
        unlink("../$UploadImagePath/social/" . $socialpath);
    }

    $qryd = "delete from social_support where id='" . $id . "'";
    db_query($qryd) or die(db_error());
    header("location: message.php?msg=118");
    exit;
}

if ($_REQUEST["social_edit"] != "" || $_REQUEST["social_delete"] != "") {
    if($_REQUEST['social_edit']!=''){
        $id = chkInput($_GET['social_edit'], 'i');
    }else{
        $id = chkInput($_GET['social_delete'], 'i');
    }
    $qry = "select * from social_support where id='$id'";
    $res = db_query($qry);
    $rowqry = db_fetch_array($res);
    $socialname=$rowqry['socialname'];
    $socialpath=$rowqry['socialpath'];
    $socialurl=$rowqry['socialurl'];
    $actived=$rowqry['actived'];
    echo $socialname;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="imagetoolbar" content="no" />
        <title><?php if ($_GET['social_edit'] != "") { ?> Edit Social<?
} else {
    if ($_GET['social_delete'] != "") {
?> Confirm Delete Social <?php } else {
?> Add Social <?
        }
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
                                    <?php if ($_GET['bidpack_edit'] != "") {
                                    ?> Edit Social
                                    <?php
                                    } else {
                                        if ($_GET['bidpack_delete'] != "") {
                                    ?>
                                            Confirm Delete Social
                                    <?php } else {
                                    ?>
                                            Add Social
                                    <?php } ?>
                                    <?php } ?>
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
                                                        <?php if ($msg != "") {
 ?>
                                                            <li class="red"><span class="ico"></span><strong class="system_title"><?= $msg; ?></strong></li>
                                                        <?php } ?>
                                                        <?php if ($imageerror != "") { ?>
                                                            <li class="red"><span class="ico"></span><strong class="system_title"><?php echo $imageerror; ?></strong></li>
                                                        <?php } ?>
                                                    </ul>

                                                    <!--[if !IE]>end system messages<![endif]-->

                                                    <!--[if !IE]>start forms<![endif]-->
                                                    <form name="f1" action="" method="post" enctype="multipart/form-data" class="search_form general_form">
                                                        <!--[if !IE]>start fieldset<![endif]-->
                                                        <fieldset>
                                                            <!--[if !IE]>start forms<![endif]-->
                                                            <div class="forms">
                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Social Name:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper">
                                                                            <input class="text" type="text" name="socialname" size="25" value="<?= $socialname != "" ? stripslashes($socialname) : ''; ?>" />
                                                                        </span>
                                                                        <span class="system required">*</span>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->

                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Social Url:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper">
                                                                            <input class="text" type="text" name="socialurl" size="25" value="<?= $socialurl != "" ? stripslashes($socialurl) :''; ?>" />
                                                                        </span>
                                                                        <span class="system required">*</span>
                                                                        <span class="system message">example: http://www.xxx.com</span>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->
                                                                
                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Social Icon:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper blank">
                                                                            <input type="file" name="image" size="25"/>
                                                                            <span class="system message">If you are editing this social you must reload the image banner</span>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->


                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Social Icon:</label>
                                                                    <div class="inputs">
                                                                        <div class="buttons" style="padding:0px 0px 20px 0px;width:600px;">
                                                                            <ul style="text-align:left;">

                                                                                <?php if (isset($socialpath) && file_exists('../uploads/social/' . $socialpath)) {
 ?>
                                                                                    <li>
                                                                                        <img alt="" src="../uploads/social/<?php echo $socialpath; ?>"/>
                                                                                    </li>
                                                                                <?php } ?>

</ul>
                                                                        </div>


                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->

                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Enable/Disable:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper blank">
                                                                            <select name="actived">
                                                                                <option value="1" <?php echo $actived==1?'selected':''; ?>>Enable</option>
                                                                                <option value="0" <?php echo $actived==0?'selected':''; ?>>Disable</option>
                                                                            </select>
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
                                                                                <?php if ($_REQUEST["social_edit"]) { ?>
                                                                                    <span class="button send_form_btn"><span><span>Edit Social</span></span><input name="editsocial" type="submit" /></span>
                                                                                    <input type="hidden" name="editid" value="<?= $id ?>" />
                                                                                <?php } elseif ($_REQUEST["social_delete"]) {
                                                                                ?>
                                                                                    <span class="button send_form_btn"><span><span>Delete Social</span></span><input name="deletesocial" type="button" onclick="javascript: window.location.href='addsocial.php?delid=<?= $id ?>';" /></span>
                                                                                <?php } else {
 ?>
                                                                                    <span class="button send_form_btn"><span><span>Add Social</span></span><input name="addsocial" type="submit"/></span>
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