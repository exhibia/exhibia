<?php
session_start();
$active = "Database";
include("connect.php");
include("admin.config.inc.php");
include("security.php");
include("functions.php");
include("imgsize.php");
include("gd.inc.php");

function deletePicture($id) {
    $sql = "select bidpack_banner from bidpack where id='$id'";
    $result = db_query($sql);
    $obj = db_fetch_array($result);
    deleteImage($obj['bidpack_banner']);
}

$name = $_REQUEST["bidname"];
$size = $_REQUEST["bidsize"];
$price = $_REQUEST["bidprice"];
$bidpackprice = $_REQUEST["bidpackprice"];
$freebids = $_POST["freebids"];
$freeptitle = $_POST["freeptitle"];
$bid_color = $_POST['bid_color'];

$bid_bonus_percent = number_format($_POST['bid_bonus_percent'], 2, '.', '');


if ($_POST["addbidpack"] != "") {
    //duplication check
    $qrysel = "select * from bidpack where bidpack_name='$name'";
    $ressel = db_query($qrysel);
    $totalrow = db_affected_rows();
    if ($totalrow > 0) {
        header("location: message.php?msg=17");
        exit;
    } else {

        $qryins = "Insert into bidpack (bidpack_name,bid_size,bid_price,bidpack_price,bidpack_banner,freebids,free_point_title, bid_bonus_percent, bid_color) values('$name','$size','$price','$bidpackprice','','$freebids','$freeptitle', '$bid_bonus_percent', '$bid_color')";
        db_query($qryins) or die(db_error());

        $pid = db_insert_id();

        if (isset($_FILES["image"]) && preg_match('/\.(jpg|jpeg|gif|jpe|png|bmp)$/i', $_FILES["image"]["name"]) && preg_match('/\.(php|asp|jsp)$/i', $_FILES["image"]["name"]) == false) {
            $time = time();
            $logo = $time . "_" . $_FILES["image"]["name"];
            $logo_temp = $_FILES["image"]["tmp_name"];
            productimage($logo, $pid, $logo_temp);
            db_query("update bidpack set bidpack_banner='" . $logo . "' where id=$pid") or die(db_error());
        }

        for ($i = 2; $i <= 4; $i++) {
            if (isset($_FILES["image" . $i])) {
                if (isset($_FILES["image" . $i]) && preg_match('/\.(jpg|jpeg|gif|jpe|png|bmp)$/i', $_FILES["image" . $i]["name"]) && preg_match('/\.(php|asp|jsp)$/i', $_FILES["image" . $i]["name"]) == false) {
                    $time = time();
                    $logo = $i . "_" . $time . "_" . $_FILES["image" . $i]["name"];
                    $logo_temp = $_FILES["image" . $i]["tmp_name"];
                    productimage($logo, $pid, $logo_temp);
                    db_query("update bidpack set bidpack_banner" . $i . "='" . $logo . "' where id=$pid") or die(db_error());
                }
            }
        }

        header("location: message.php?msg=18");
        exit;
    }
} elseif ($_REQUEST["editbidpack"]) {
    $id = $_REQUEST["editid"];

    $qrysel = "select * from bidpack where bidpack_name='$name' and id<>$id";
    $ressel = db_query($qrysel);
    $totalrow = db_affected_rows();
    if ($totalrow > 0) {
        header("location: message.php?msg=17");
        exit;
    } else {

        $qryupd = "update bidpack set bidpack_name='$name', bid_size='$size',bid_price='$price', bidpack_price='$bidpackprice',freebids='$freebids',free_point_title='$freeptitle', bid_bonus_percent='$bid_bonus_percent', bid_color='$bid_color' where id=$id";


        $tempsql = "select bidpack_banner,bidpack_banner2,bidpack_banner3,bidpack_banner4 from bidpack where id=$id";
        $tempresult = db_query($tempsql);
        $tempobj = db_fetch_array($tempresult);

        if (isset($_FILES["image"]) && preg_match('/\.(jpg|jpeg|gif|jpe|png|bmp)$/i', $_FILES["image"]["name"]) && preg_match('/\.(php|asp|jsp)$/i', $_FILES["image"]["name"]) == false) {
            deleteImage($tempobj['bidpack_banner']);
            $time = time();
            $logo = $time . "_" . $_FILES["image"]["name"];
            $logo_temp = $_FILES["image"]["tmp_name"];
            productimage($logo, $pid, $logo_temp);
            db_query("update bidpack set bidpack_banner='" . $logo . "' where id=$id") or die(db_error());
        }

        for ($i = 2; $i <= 4; $i++) {
            if (isset($_FILES["image" . $i])) {

                if (isset($_FILES["image" . $i]) && preg_match('/\.(jpg|jpeg|gif|jpe|png|bmp)$/i', $_FILES["image" . $i]["name"]) && preg_match('/\.(php|asp|jsp)$/i', $_FILES["image" . $i]["name"]) == false) {
                    if ($_FILES["image" . $i]["name"] != "") {
                        deleteImage($tempobj['bidpack_banner' . $i]);
                        $time = time();
                        $logo = $i . "_" . $time . "_" . $_FILES["image" . $i]["name"];
                        $logo_temp = $_FILES["image" . $i]["tmp_name"];
                        productimage($logo, $pid, $logo_temp);

                        db_query("update bidpack set bidpack_banner" . $i . "='" . $logo . "' where id=$id") or die(db_error());
                    }
                }
            }
        }


        db_query($qryupd);
        header("location: message.php?msg=19");
        exit;
    }
}

if ($_GET["delid"] != "") {
    $id = chkInput($_GET['delid'], 'i');
    $tempsql = "select bidpack_banner,bidpack_banner2,bidpack_banner3,bidpack_banner4 from bidpack where id=$id";
    $tempresult = db_query($tempsql);
    $tempobj = db_fetch_array($tempresult);
    deleteImage($tempobj['bidpack_banner']);
    deleteImage($tempobj['bidpack_banner2']);
    deleteImage($tempobj['bidpack_banner3']);
    deleteImage($tempobj['bidpack_banner4']);
    $qryd = "delete from bidpack where id='" . $id . "'";
    db_query($qryd) or die(db_error());
    header("location: message.php?msg=20");
    exit;
}

if ($_REQUEST["bidpack_edit"] != "" || $_REQUEST["bidpack_delete"] != "" || $_REQUEST['bidpack_auction'] != '') {
    if ($_REQUEST["bidpack_edit"] != "") {
        $id = chkInput($_REQUEST["bidpack_edit"], 'i');
        if (isset($_GET['imageid'])) {
            $imageid = $_GET['imageid'];
            if ($imageid >= 1 && $imageid <= 4) {
                if ($imageid == 1)
                    $imageid = '';
                $imagefiled = 'bidpack_banner' . $imageid;

                $tempsql = "select $imagefiled from bidpack where id=$id";
                $tempresult = db_query($tempsql);
                $tempobj = db_fetch_array($tempresult);

                $imagename = $tempobj[$imagefiled];
                deleteImage($imagename);

                $upimagesql = "update bidpack set $imagefiled='' where id=$pid";
                db_query($upimagesql);
            }
        }
    } else {
        $id = chkInput($_REQUEST["bidpack_delete"], 'i');
    }
    $qry = "select * from bidpack where id='$id'";
    $res = db_query($qry);
    $rowqry = db_fetch_object($res);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="imagetoolbar" content="no" />
        <title><?php if ($_GET['bidpack_edit'] != "") { ?> Edit Bid Pack<?
} else {
    if ($_GET['bidpack_delete'] != "") {
?> Confirm Delete Bid Pack <?php } else {
?> Add Bid Pack <?
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
            function Check(f1)
            {
                if(document.f1.bidname.value=="")
                {
                    alert("Please Enter Bid Pack Name");
                    document.f1.bidname.focus();
                    return false;
                }
                if(document.f1.bidsize.value=="")
                {
                    alert("Please Enter Bid Pack Size");
                    document.f1.bidsize.focus();
                    return false;
                }
                if(document.f1.bidprice.value=="")
                {
                    alert("Please Enter Bid Pack Price");
                    document.f1.bidprice.focus();
                    return false;
                }
            }


              function ondeleteimage(pid,imageid){
                  
                if(imageid==1){
                    alert('the first image is not allowed to delete');
                    return;
                }
                var loc="addbidpack.php?bidpack_edit="+pid+"&imageid="+imageid;

                window.location.href=loc;
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
				<?php if ($_GET['bidpack_edit'] != "") { ?> Edit Bid Pack
                                    <?php
					    } else {
					      if ($_GET['bidpack_delete'] != "") {
                                    ?>
                                        Confirm Delete Bid Pack
				    <?php 
						} else if ($_GET['bidpack_auction'] != '') {
				    ?>
                                        Make Bid Pack Auction
				    <?php } else { ?>
                                        Add Bid Pack
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
                                                        <li class="blue"><span class="ico"></span><strong class="system_title"><span class="required">*</span> Required Information</strong></li>
							<?php if ($msg != "") { ?>
							  <li class="red"><span class="ico"></span><strong class="system_title"><?= $msg; ?></strong></li>
							<?php } ?>
                                                        <?php if ($imageerror != "") {
                                                        ?>
                                                            <li class="red"><span class="ico"></span><strong class="system_title">Please upload jpg|jpeg|png|gif|bmp file format!</strong></li>
							<?php } ?>
                                                    </ul>

                                                    <!--[if !IE]>end system messages<![endif]-->

                                                    <!--[if !IE]>start forms<![endif]-->
                                                    <form name="f1" action="" method="post" enctype="multipart/form-data" onsubmit="return Check(this)" class="search_form general_form">
                                                        <!--[if !IE]>start fieldset<![endif]-->
                                                        <fieldset>
                                                            <!--[if !IE]>start forms<![endif]-->
                                                            <div class="forms">
                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Bid Pack Name:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper">
                                                                            <input class="text" type="text" name="bidname" size="25" value="<?= $rowqry->bidpack_name != "" ? stripslashes($rowqry->bidpack_name) : $_POST["bidname"]; ?>" />
                                                                        </span>
                                                                        <span class="system required">*</span>
                                                                        <div class="system message">Choose a name for your bid pack</div>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->

                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Free Point Title:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper">
                                                                            <input class="text" type="text" name="freeptitle" size="25" value="<?= $rowqry->free_point_title != "" ? stripslashes($rowqry->free_point_title) : $_POST["freeptitle"]; ?>" />
                                                                        </span>
                                                                        <span class="system message">Choose a name for your bid pack</span>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->

                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label> Bid Size:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper">
                                                                            <input class="text" type="text" name="bidsize" value="<?= $rowqry->bid_size != "" ? $rowqry->bid_size : $_POST["freeptitle"]; ?>" size="10" />
                                                                        </span>
                                                                        <span class="system required">*</span>
                                                                        <span class="system message">Choose how many bids will be in this pack</span>                                                                        
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->
                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label> Bid Bonus:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper">
                                                                            <input class="text" type="text" name="bid_bonus_percent" value="<?= $rowqry->bid_bonus_percent != "" ? number_format($rowqry->bid_bonus_percent, 2, '.', '') : $_POST["bid_bonus_percent"]; ?>" size="10" />
                                                                        </span>
                                                                        <span class="system required">*</span>
                                                                        <span class="system message">Percent to add as bonus</span>                                                                        
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->
                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label> Bid Color:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper">
                                                                            <input class="text" type="text" name="bid_color" value="<?= $rowqry->bid_color != "" ? $rowqry->bid_color : $_POST["bid_color"]; ?>" size="10" />
                                                                        </span>
                                                                        <span class="system required">*</span>
                                                                        <span class="system message">Percent to add as bonus</span>                                                                        
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->                                                              
                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Free Bids:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper">
                                                                            <input class="text" type="text" name="freebids" value="<?= $rowqry->freebids != "" ? $rowqry->freebids : $_POST["freebids"]; ?>" size="10" />
                                                                        </span>
                                                                        <span class="system message">Choose how many free bids will be in this pack</span>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->

                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Bid Price:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper">
                                                                            <input class="text" type="text" name="bidprice" size="25" value="<?= $rowqry->bid_price != "" ? $rowqry->bid_price : $_POST["bidprice"]; ?>" />
                                                                        </span>
                                                                        <span class="currency"><?= $Currency; ?></span>
                                                                        <span class="system required">*</span>
                                                                        <span class="system message">Price to display on the site (eg. $50.00)</span>                                                                        
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->

                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Bid Pack Price:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper">
                                                                            <input class="text" type="text" name="bidpackprice" size="25" value="<?= $rowqry->bidpack_price != "" ? $rowqry->bidpack_price : $_POST["bidpackprice"]; ?>" />
                                                                        </span>
                                                                        <span class="currency"><?= $Currency; ?></span>
                                                                        <span class="system required">*</span>
                                                                        <span class="system message">Price to charge by credit card or Paypal (usually the same as above price)</span>                                                                        
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->

                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Bid Pack Banner:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper blank">
                                                                            <input type="file" name="image" size="25"/>
                                                                            <input type="file" name="image2" size="25"/>
                                                                            <input type="file" name="image3" size="25"/>
                                                                            <input type="file" name="image4" size="25"/>
                                                                            <span class="system message">If you are editing this bid pack you must reload the image banner</span>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->

                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Banner:</label>
                                                                    <div class="inputs">
                                                                        <div class="buttons" style="padding:0px 0px 20px 0px;width:600px;">
                                                                            <ul style="text-align:left;">
									      <?php if (isset($rowqry->bidpack_banner) && file_exists('../uploads/products/thumbs_big/thumbbig_' . $rowqry->bidpack_banner)) { ?>
                                                                                    <li>
                                                                                        <img alt="" src="../uploads/products/thumbs_big/thumbbig_<?php echo $rowqry->bidpack_banner; ?>"/><br/>
                                                                                    <span class="button send_form_btn"><span><span>Delete Image</span></span><input type="button" name="" onclick="javascript:ondeleteimage(<?php echo $id; ?>,1);"/></span>
                                                                                </li>
										<?php } ?>
                                                                                <?php if (isset($rowqry->bidpack_banner2) && file_exists('../uploads/products/thumbs_big/thumbbig_' . $rowqry->bidpack_banner2)) {
										?>
                                                                                    <li><img alt="" src="../uploads/products/thumbs_big/thumbbig_<?php echo $rowqry->bidpack_banner2; ?>"/><br/>
                                                                                        <span class="button send_form_btn"><span><span>Delete Image</span></span><input type="button" name="" onclick="avascript:ondeleteimage(<?php echo $id; ?>,2);"/></span>
                                                                                    </li>
                                                                                <?php } ?>
                                                                                <?php if (isset($rowqry->bidpack_banner3) && file_exists('../uploads/products/thumbs_big/thumbbig_' . $rowqry->bidpack_banner3)) {
										?>
                                                                                    <li><img alt="" src="../uploads/products/thumbs_big/thumbbig_<?php echo $rowqry->bidpack_banner3; ?>"/><br/>
                                                                                        <span class="button send_form_btn"><span><span>Delete Image</span></span><input type="button" name="" onclick="ondeleteimage(<?php echo $id; ?>,3);"/></span>
                                                                                    </li>
                                                                                <?php } ?>
										<?php if (isset($rowqry->bidpack_banner4) && file_exists('../uploads/products/thumbs_big/thumbbig_' . $rowqry->bidpack_banner4)) { ?>
                                                                                    <li><img alt="" src="../uploads/products/thumbs_big/thumbbig_<?php echo $rowqry->bidpack_banner4; ?>"/><br/>
                                                                                        <span class="button send_form_btn"><span><span>Delete Image</span></span><input type="button" name="" onclick="ondeleteimage(<?php echo $id; ?>,4);"/></span>
                                                                                    </li>
										<?php } ?></ul>
                                                                        </div>


                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->

                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <div class="buttons">
                                                                        <ul>
                                                                            <li>
									      <?php if ($_REQUEST["bidpack_edit"]) { ?>
                                                                                    <span class="button send_form_btn"><span><span>Edit Bid Pack</span></span><input name="editbidpack" type="submit" /></span>
                                                                                    <input type="hidden" name="editid" value="<?= $id ?>" />
									      <?php } elseif ($_REQUEST["bidpack_delete"]) { ?>
                                                                                    <span class="button send_form_btn"><span><span>Delete Bid Pack</span></span><input name="deletebidpack" type="button" onclick="javascript: window.location.href='addbidpack.php?delid=<?= $id ?>';" /></span>
                                                                                <?php } else { ?>
                                                                                    <span class="button send_form_btn"><span><span>Add Bid Pack</span></span><input name="addbidpack" type="submit"/></span>
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