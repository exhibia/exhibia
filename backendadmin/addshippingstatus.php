<?
session_start();
$active = "Auctions";
include("connect.php");
include("admin.config.inc.php");
include("security.php");
include("functions.php");
include("include/function_new.php");

include_once ('../data/shippingtype.php');
include_once ('../data/shippingstatus.php');

$ordertype = chkInput($_REQUEST['ordertype'], 's');

if (isset($_POST["submit"])) {
    $valid = true;

    $tracknumber = chkInput($_POST["tracknumber"], 's');
    $shippingtypeid = chkInput($_POST['shippingtypeid'], 's');



    if ($shippingtypeid == 'none') {
        $msg = "select a shipping company please<br/>";
        $valid = false;
    }

    if ($valid) {

        $ssdb = new ShippingStatus(null);
        if (isset($_POST['id'])) {
            $id = chkInput($_REQUEST["id"], 'i');
            $ssdb->update($id, $shippingtypeid, $tracknumber);
        } else {
            $orderid = chkInput($_REQUEST['orderid'], 'i');
            $ssdb->insert($shippingtypeid, $orderid, $ordertype, $tracknumber);
        }
        if ($ordertype == 1) {
            header("location: soldauction.php");
        } else {
            header("location: managebuynow.php");
        }
        exit;
    }
}

if ($_REQUEST["edit_ssid"]) {
    $id = chkInput($_REQUEST["edit_ssid"], 'i');    
    $ssdb = new ShippingStatus(null);
    $ssresult = $ssdb->selectById($id);
    if (db_num_rows($ssresult)<=0) {
        if ($ordertype == 1) {
            header("location: soldauction.php");
        } else {
            header("location: managebuynow.php");
        }
        exit;
    }

    $ssobj = db_fetch_array($ssresult);

    $orderid = $ssobj['orderid'];
    $tracknumber = $ssobj['tracknumber'];
    $shippingtypeid = $ssobj['shippingtypeid'];
}else{
    $orderid=chkInput($_REQUEST['orderid'], 'i');
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="imagetoolbar" content="no" />
        <title><?php if ($_GET['slide_edit'] != "") { ?> Edit Shipping Status<?
} else {
    if ($_GET['slide_delete'] != "") {
?> Confirm Delete Shipping Status <?php } else {
?> Add Shipping Status<?php
        }
    }
?>-<?php echo $ADMIN_MAIN_SITE_NAME ?></title>
        <link media="screen" rel="stylesheet" type="text/css" href="css/admin.css"  />
        <!--[if lte IE 6]><link media="screen" rel="stylesheet" type="text/css" href="css/admin-ie.css" /><![endif]-->
        <script type="text/javascript" src="js/behaviour.js"></script>
        <script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
        <script type="text/javascript" src="js/function.js"></script>

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
 ?> Edit Shipping Status<?
                                    } else {
                                        if ($_GET['bidpack_delete'] != "") {
                                    ?> Confirm Delete Shipping Status <?php } else {
                                    ?> Add Shipping Status <?
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
<?php if ($msg != "") { ?>
                                                        <li class="red"><span class="ico"></span><strong class="system_title"><?=$msg; ?></strong></li>
<?php } ?>

                                                    </ul>

                                                    <!--[if !IE]>end system messages<![endif]-->

                                                    <!--[if !IE]>start forms<![endif]-->
                                                    <form action="" method="post" class="search_form general_form">
                                                        <!--[if !IE]>start fieldset<![endif]-->
                                                        <fieldset>
                                                            <!--[if !IE]>start forms<![endif]-->
                                                            <div class="forms">                                                               

                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Shipping Company:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper blank">
                                                                            <select name="shippingtypeid">
                                                                                <option value="none">select one</option>
                                                                                <?
                                                                                $shiptypedb = new ShippingType(null);
                                                                                $resc = $shiptypedb->selectAll();
                                                                                if (db_num_rows($resc) > 0) {
                                                                                    while ($obj = db_fetch_array($resc)) {
                                                                                ?>
                                                                                        <option <?php echo isset($shippingtypeid) && $shippingtypeid == $obj['id'] ? "selected" : ""; ?> value="<?php echo $obj["id"]; ?>"><?php echo $obj["name"]; ?></option>
                                                                                <?
                                                                                    }
                                                                                }
                                                                                db_free_result($resc);
                                                                                ?>
                                                                            </select>
                                                                        </span>
                                                                        <span class="system required">*</span>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->

                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Track Number:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper">

                                                                            <input class="text" id="tracknumber" type="text" name="tracknumber" size="255" value="<?php echo isset($tracknumber) ? $tracknumber : ''; ?>" />
                                                                        </span>
                                                                        <span class="system required">*</span>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->


                                                                <!--[if !IE]>end row<![endif]-->

                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <div class="buttons">
                                                                        <ul>
                                                                            <li>
<?php if (isset($_GET["edit_ssid"])) { ?>
                                                                                    <input type="hidden" name="id" value="<?php echo $id; ?>" />
<?php } ?>

                                                                                <input type="hidden" name="orderid" value="<?php echo $orderid; ?>" />
                                                                                <input type="hidden" name="ordertype" value="<?php echo $ordertype; ?>" />
                                                                                <span class="button send_form_btn"><span><span>Submit</span></span><input name="submit" type="submit" /></span>

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