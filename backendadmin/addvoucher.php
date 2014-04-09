<?
session_start();
$active="Auctions";
include("connect.php");
include("admin.config.inc.php");
include("security.php");


$title = $_POST["title"];
$amount = $_POST["amount"];
$combinable = $_POST["combinable"];
$vouchertype = $_POST["vouchertype"];
$validity = $_POST["validity"];
// value 1 for free bids voucher
//value 2 for money voucher

if($_POST["addvoucher"]!="") {
    $qrysel = "select * from vouchers where voucher_title='$title'";
    $ressel = db_query($qrysel);
    $totalrow = db_affected_rows();
    if($totalrow>0) {
        header("location: message.php?msg=55");
        exit;
    }
    else {
        $qryins = "Insert into vouchers (voucher_title,combinable,bids_amount,voucher_type,validity)  values('".$title."','".$combinable."','".$amount."','".$vouchertype."','".$validity."')";
        db_query($qryins) or die(db_error());
        header("location: message.php?msg=56");
        exit;
    }
}

if($_POST["editvoucher"]!="") {
    $id = $_POST["editid"];
    $qrysel = "select * from vouchers where voucher_title='$title' and id<>$id";
    $ressel = db_query($qrysel);
    $totalrow = db_affected_rows();
    if($totalrow>0) {
        header("location: message.php?msg=55");
        exit;
    }
    else {
        $qryupd = "update vouchers set voucher_title='$title',combinable='$combinable',bids_amount='$amount',voucher_type='$vouchertype',validity='$validity' where id='$id'";
        db_query($qryupd) or die(db_error());
        header("location: message.php?msg=57");
        exit;
    }
}

if($_GET["delid"]!="") {
    $qryd = "delete from vouchers where id='".$_GET["delid"]."'";
    db_query($qryd) or die(db_error());
    header("location: message.php?msg=58");
    exit;
}

if($_REQUEST["voucher_edit"]!="" || $_REQUEST["voucher_delete"]!="") {
    if($_REQUEST["voucher_edit"]!="") {
        $id = $_REQUEST["voucher_edit"];
    }
    else {
        $id = $_REQUEST["voucher_delete"];
    }
    $qrysel = "select * from vouchers where id='$id'";
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
        <title><?php if($_GET['voucher_edit']!="") { ?> Edit Voucher<?php } else {
                if($_GET['voucher_delete']!="") { ?> Confirm Delete Voucher<?php }else { ?> Add Voucher <?php }
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
                    alert("Please Enter Voucher Title!!!");
                    document.f1.title.focus();
                    return false;
                }
                if(document.f1.vouchertype.value=='none')
                {
                    alert("Please select voucher type");
                    document.f1.vouchertype.focus();
                    return false;
                }
                if(document.f1.amount.value=="")
                {
                    alert("Please enter voucher amount/bids!!!")
                    document.f1.amount.focus()
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
                                    <?php if($_GET['voucher_edit']!="") { ?> Edit Voucher<?php } else {
                                        if($_GET['voucher_delete']!="") { ?> Confirm Delete Voucher<?php }else { ?> Add Voucher <?php }
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
                                                    <form name="f1" action="addvoucher.php" method="post" onsubmit="return Check(f1)" class="search_form general_form">
                                                        <!--[if !IE]>start fieldset<![endif]-->
                                                        <fieldset>
                                                            <!--[if !IE]>start forms<![endif]-->
                                                            <div class="forms">
                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Voucher Title:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper">
                                                                            <input class="text" type="text" size="50" name="title" value="<?=$row->voucher_title;?>" maxlength="255" />
                                                                        </span>
                                                                        <span class="system required">*</span>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->

                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Voucher Type:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper blank">
                                                                            <select name="vouchertype">
                                                                                <!--				<option value="none">select one</option>-->
                                                                                <!--				<option value="1">Free Bids Voucher</option> -->
                                                                                <option <?=$row->voucher_type==2?"selected":"";?> value="2">Money Voucher</option>
                                                                            </select>
                                                                        </span>
                                                                        <span class="system required">*</span>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->

                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Voucher Amount:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper">
                                                                            <input class="text" type="text" size="10" name="amount" value="<?=$row->bids_amount;?>" />
                                                                        </span>
                                                                        <span class="currency"><?=$Currency;?></span>
                                                                        <span class="system required">*</span>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->

                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Voucher validity:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper">
                                                                            <input class="text" type="text" size="10" name="validity" value="<?=$row->validity;?>" />
                                                                        </span>
                                                                        <span class="system required">days</span>
                                                                        <span class="system required">Note: If voucher validity field is left blank then voucher is expired when user used it.</span>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->

                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Combinable:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper blank">
                                                                            <select name="combinable">
                                                                                <option value="1">Yes</option>
                                                                                <option <?=$row->combinable=="0"?"selected":"";?> value="0">No</option>
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
                                                                                <?
                                                                                if($_REQUEST["voucher_edit"]) {
                                                                                    ?>
                                                                                <span class="button send_form_btn"><span><span>Edit Voucher</span></span><input name="editvoucher" type="submit"/></span>
                                                                                <input type="hidden" name="editid" value="<?=$id?>" />
                                                                                    <?
                                                                                }
                                                                                elseif($_REQUEST["voucher_delete"]) {
                                                                                    ?>
                                                                                <span class="button send_form_btn"><span><span>Delete Voucher</span></span><input name="deletevoucher" type="button" onclick="javascript: window.location.href='addvoucher.php?delid=<?=$id?>';"/></span>
                                                                                    <?
                                                                                }
                                                                                else {
                                                                                    ?>
                                                                                <span class="button send_form_btn"><span><span>Add Voucher</span></span><input name="addvoucher" type="submit"/></span>
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