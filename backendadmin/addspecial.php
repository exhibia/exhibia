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

$embedcode = chkInput($_REQUEST["embedcode"], 's');
$specialname = chkInput($_REQUEST['specialname'], 's');
$actived = chkInput($_REQUEST['actived'], 'i');


if ($_POST["addspecial"] != "") {
    $qryins = "Insert into special_announcement(announcement_name,embed_code,actived) values('$specialname','$embedcode','$actived')";
	
    db_query($qryins) or die(db_error());

    header("location: message.php?msg=120");
    exit;
} elseif ($_REQUEST["editspecial"]) {
    $id = $_REQUEST["editid"];

    $qryupd = "update special_announcement set announcement_name='$specialname', embed_code='$embedcode',actived='$actived' where id=$id";    

    db_query($qryupd) or die(db_error());
    header("location: message.php?msg=120");
    exit;
}

if ($_GET["delid"] != "") {
    $id = chkInput($_GET['delid'], 'i');    

    $qryd = "delete from special_announcement where id='" . $id . "'";
    db_query($qryd) or die(db_error());
    header("location: message.php?msg=121");
    exit;
}


// Delete and Edit
if ($_REQUEST["special_edit"] != "" || $_REQUEST["special_delete"] != "") {
    if($_REQUEST['special_edit']!=''){
        $id = chkInput($_GET['special_edit'], 'i');
    }else{
        $id = chkInput($_GET['special_delete'], 'i');
    }
    $qry = "select * from special_announcement where id='$id'";
    $res = db_query($qry);
    $rowqry = db_fetch_array($res);
    $specialname=$rowqry['announcement_name'];    
    $embedcode=$rowqry['embed_code'];
    $actived=$rowqry['actived'];
    echo $specialname;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="imagetoolbar" content="no" />
        <title><?php if ($_GET['special_edit'] != "") { ?> Edit Special Announcement<?
} else {
    if ($_GET['special_delete'] != "") {
?> Confirm Delete Special Announcement <?php } else {
?> Add Special Announcement <?
        }
    }
?>-<?php echo $ADMIN_MAIN_SITE_NAME ?></title>
        <link media="screen" rel="stylesheet" type="text/css" href="css/admin.css"  />
        <!--[if lte IE 6]><link media="screen" rel="stylesheet" type="text/css" href="css/admin-ie.css" /><![endif]-->
        <script type="text/javascript" src="js/behaviour.js"></script>
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
                                    ?> Edit Special Announcement
                                    <?php
                                    } else {
                                        if ($_GET['bidpack_delete'] != "") {
                                    ?>
                                            Confirm Delete Special Announcement
                                    <?php } else {
                                    ?>
                                            Add Special Announcement
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
                                                                    <label>Name:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper">
                                                                            <input class="text" type="text" name="specialname" size="25" value="<?= $specialname != "" ? stripslashes($specialname) : ''; ?>" />
                                                                        </span>
                                                                        <span class="system required">*</span>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->

                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Embed Code:</label>
                                                                    <div class="inputs">
                                                                        <span>
																		
                                                                           <?php /*?> <input class="text" type="text" name="embedcode" size="25" value="<?= $embedcode != "" ? stripslashes($embedcode) :''; ?>" /><?php */?>
																			<textarea class="text" name="embedcode" cols="36" rows="8"><?= $embedcode != "" ? stripslashes($embedcode) :''; ?></textarea>
                                                                        </span>
                                                                        <span class="system required" style="float:right;">*</span>
                                                                        
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
                                                                                <?php if ($_REQUEST["special_edit"]) { ?>
                                                                                    <span class="button send_form_btn"><span><span>Edit Announcement
</span></span><input name="editspecial" type="submit" /></span>
                                                                                    <input type="hidden" name="editid" value="<?= $id ?>" />
                                                                                <?php } elseif ($_REQUEST["special_delete"]) {
                                                                                ?>
                                                                                    <span class="button send_form_btn"><span><span>Delete Announcement
</span></span><input name="deletespecial" type="button" onclick="javascript: window.location.href='addspecial.php?delid=<?= $id ?>';" /></span>
                                                                                <?php } else {
 ?>
                                                                                    <span class="button send_form_btn"><span><span>Add Announcement
</span></span><input name="addspecial" type="submit"/></span>
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