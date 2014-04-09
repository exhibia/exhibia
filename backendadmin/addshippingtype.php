<?php
session_start();
$active = "Database";
include("connect.php");
include("admin.config.inc.php");
include("security.php");
include("functions.php");
include("include/function_new.php");

include_once ('../data/shippingtype.php');

function uploadImage() {
    if (isset($_FILES["image"]) && $_FILES["image"]["name"] && preg_match('/\.(jpg|jpeg|gif|jpe|png|bmp)$/i', $_FILES["image"]["name"]) && preg_match('/\.(php|asp|jsp)$/i', $_FILES["image"]["name"]) == false) {
        $time = time();
        $imagename = $time . "_" . $_FILES["image"]["name"];
        $dest = "../uploads/other/";

        if (file_exists($dest) == false) {
            mkdir($dest);
        }

        copy($_FILES['image']['tmp_name'], $dest . $imagename);
        return $imagename;
    } else {
        return '';
    }
}

if ($_POST["addship"] != "") {
    $valid = true;
    $url = chkInput($_REQUEST["url"], 's');
    $name = chkInput($_REQUEST['name'], 's');

    if (validUrl($url) == false) {
        $msg .= "invalid url<br/>";
        $valid = false;
    }

    if (strlen($name) <= 0) {
        $msg .= "invalid shipping company name<br/>";
        $valid = false;
    }


    $logoimage = uploadImage();
    if ($logoimage == '') {
        $msg .= "upload image failed<br/>";
        $valid = false;
    }

    if (valid) {
        $stdb = new ShippingType(null);
        $stdb->insert($name, $logoimage, $url);
        header("location: manageshippingtype.php");
        exit;
    }
} elseif ($_REQUEST["editship"]) {
    $id = chkInput($_REQUEST["editid"], 'i');
    $url = chkInput($_REQUEST["url"], 's');
    $name = chkInput($_REQUEST['name'], 's');

    $stdb = new ShippingType(null);
    $stresult = $stdb->selectById($id);
    $shipping = db_fetch_object($stresult);
    $logoimage = $shipping->logoimage;

    if ($_FILES["image"]["name"] != '') {
        unlink('../uploads/other/' . $logoimage);
        $logoimage = uploadImage();
    }

    $valid = true;

    if (strlen($name) <= 0) {
        $msg .= "invalid shipping company name<br/>";
        $valid = false;
    }

    if (validUrl($url) == false) {
        $msg .= "invalid url<br/>";
        $valid = false;
    }

    if ($logoimage == '') {
        $msg .= "upload image failed<br/>";
        $valid = false;
    }

    if ($valid) {
        $stdb->update($id, $name, $logoimage, $url);
        header("location: manageshippingtype.php");
        exit;
    }
}

if ($_GET["delid"] != "") {
    $id = chkInput($_REQUEST["delid"], 'i');
    $stdb = new ShippingType(null);
    $stresult = $stdb->selectById($id);

    if (db_num_rows($stresult) > 0) {
        $shipping = db_fetch_object($stresult);
        $logoimage = $shipping->logoimage;

        $stdb->delete($id);

        unlink('../uploads/other/' . $logoimage);

        header("location: manageshippingtype.php");
        exit;
    }
}

if ($_REQUEST["ship_edit"] != "" || $_REQUEST["ship_delete"] != "") {
    if ($_REQUEST["ship_edit"] != "") {
        $id = chkInput($_REQUEST["ship_edit"], 'i');
    } else {
        $id = chkInput($_REQUEST["ship_delete"], 'i');
    }

    $stdb = new ShippingType(null);
    $stresult = $stdb->selectById($id);
    

    if (db_num_rows($stresult)>0) {
        $shipping = db_fetch_object($stresult);

        $name = $shipping->name;
        $logoimage = $shipping->logoimage;
        $url = $shipping->url;
    }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="imagetoolbar" content="no" />
        <title><?php if ($_GET['slide_edit'] != "") { ?> Edit Shipping Type<?
} else {
    if ($_GET['slide_delete'] != "") {
?> Confirm Delete Shipping Type <?php } else {
?> Add Shipping Type<?php
        }
    }
?>-<?php echo $ADMIN_MAIN_SITE_NAME ?></title>
        <link media="screen" rel="stylesheet" type="text/css" href="css/admin.css"  />
        <!--[if lte IE 6]><link media="screen" rel="stylesheet" type="text/css" href="css/admin-ie.css" /><![endif]-->
        <script type="text/javascript" src="js/behaviour.js"></script>
        <script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
        <script type="text/javascript" src="js/function.js"></script>
        <script type="text/javascript">
            $(document).ready(function(){
                $('#shipform').submit(function(){
                    if($('#url').val().length>0){
                        if(!validUrl($('#url').val())){
                            alert('Invalid url');
                            return false;
                        }
                    }

                    if($('#name').val().length<=0){
                        alert("Shipping company name can't be empty");
                        return false;
                    }
                    return true;
                });
            });

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
                                    ?> Edit Shipping Type<?
                                    } else {
                                        if ($_GET['bidpack_delete'] != "") {
                                    ?> Confirm Delete Shipping Type <?php } else {
                                    ?> Add Shipping Type <?
                                        }
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
                                                        <?php if ($msg != "") {
                                                        ?>
                                                            <li class="red"><span class="ico"></span><strong class="system_title"><?=$msg; ?></strong></li>
                                                        <?php } ?>
                                                        <?php if ($imageerror != "") {
                                                        ?>
                                                            <li class="red"><span class="ico"></span><strong class="system_title">Please upload jpg|jpeg|png|gif|bmp file format!</strong></li>
                                                        <?php } ?>
                                                    </ul>

                                                    <!--[if !IE]>end system messages<![endif]-->

                                                    <!--[if !IE]>start forms<![endif]-->
                                                    <form id="shipform" action="" method="post" enctype="multipart/form-data" class="search_form general_form">
                                                        <!--[if !IE]>start fieldset<![endif]-->
                                                        <fieldset>
                                                            <!--[if !IE]>start forms<![endif]-->
                                                            <div class="forms">
                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Shipping Company Name:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper">
                                                                            <input class="text" id="name" type="text" name="name" size="255" value="<?php echo isset($name) ? $name : ''; ?>" />
                                                                        </span>
                                                                        <span class="system required">*</span>                                                                        
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->

                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Url:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper">
                                                                            <input class="text" id="url" type="text" name="url" size="255" value="<?php echo isset($url) ? $url : ''; ?>" />
                                                                        </span>
                                                                        <span class="system required">*</span>
                                                                        <div class="system message">Keep it emtpy when you don't want any url, url example: http://www.google.com</div>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->

                                                                <!--[if !IE]>start row<![endif]-->

                                                                <div class="row">
                                                                    <label>Logo Image:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper blank">
                                                                            <input type="file" name="image" size="25"/>
                                                                        </span>
                                                                        <div class="clear">
                                                                            <?php if (isset($logoimage)) {
                                                                            ?>
                                                                                <img alt="" src="../uploads/other/<?php echo $logoimage; ?>"/>
                                                                            <?php } ?>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <!--[if !IE]>end row<![endif]-->

                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <div class="buttons">
                                                                        <ul>
                                                                            <li>
                                                                                <?
                                                                                if ($_REQUEST["ship_edit"]) {
                                                                                ?>
                                                                                    <span class="button send_form_btn"><span><span>Edit Shipping Type</span></span><input name="editship" type="submit" /></span>
                                                                                    <input type="hidden" name="editid" value="<?php echo $id; ?>" />
                                                                                <?
                                                                                } elseif ($_REQUEST["ship_delete"]) {
                                                                                ?>
                                                                                    <span class="button send_form_btn"><span><span>Delete Shipping Type</span></span><input name="deleteship" type="button" onclick="javascript: window.location.href='addshippingtype.php?delid=<?php echo $id ?>';" /></span>
                                                                                <?
                                                                                } else {
                                                                                ?>
                                                                                    <span class="button send_form_btn"><span><span>Add Shipping Type</span></span><input name="addship" type="submit"/></span>
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