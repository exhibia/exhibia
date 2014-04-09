<?
session_start();
$active="Auctions";
include("connect.php");
include("admin.config.inc.php");
include("security.php");


if($_REQUEST["updatepausetime"]) {
    $pshour = $_REQUEST["pshour"];
    $psmin = $_REQUEST["psmin"];
    $pssec = $_REQUEST["pssec"];
    $pehour = $_REQUEST["pehour"];
    $pemin = $_REQUEST["pemin"];
    $pesec = $_REQUEST["pesec"];

    $pstime = $pshour.":".$psmin.":".$pssec;
    $petime = $pehour.":".$pemin.":".$pesec;

    $sqlchkmanage = "select * from auction_pause_management where id=1";
    $reschkmanage = db_query($sqlchkmanage) or die(db_error());
    if(0<db_num_rows($reschkmanage)) {
        $updatemanage = "update auction_pause_management set pause_start_time='$pstime', pause_end_time='$petime' where id='1'";
        db_query($updatemanage) or die(db_error());
        header("location: message.php?msg=40");
        exit;
    }
    else {
	db_query("LOCK TABLES auction_pause_management write");
        $insertmanage = "insert into auction_pause_management (id, pause_start_time,pause_end_time) values(1, '".$pstime."','".$petime."')";
        db_query($insertmanage) or die(db_error());
        db_query("unlock tables");
        header("location: message.php?msg=40");
        exit;
    }
}
$sqlmanage = "select * from auction_pause_management where id=1";
$resmanage = db_query($sqlmanage) or die(db_error());
if(0<db_num_rows($resmanage)) {
    $rowmanage = db_fetch_array($resmanage);
    $pshour = substr($rowmanage["pause_start_time"],0,2);
    $psmin = substr($rowmanage["pause_start_time"],3,2);
    $pssec = substr($rowmanage["pause_start_time"],6);
    $pehour = substr($rowmanage["pause_end_time"],0,2);
    $pemin = substr($rowmanage["pause_end_time"],3,2);
    $pesec = substr($rowmanage["pause_end_time"],6);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="imagetoolbar" content="no" />
        <title>Manage Auction Pause Time>-<?php echo $ADMIN_MAIN_SITE_NAME ?></title>
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
                if(document.f1.pshour.value=="none")
                {
                    alert("Please select start hour!!!");
                    document.f1.pshour.focus();
                    return false;
                }
                if(document.f1.psmin.value=="none")
                {
                    alert("Please select start minute!!!");
                    document.f1.psmin.focus();
                    return false;
                }
                if(document.f1.pssec.value=="none")
                {
                    alert("Please select start second!!!");
                    document.f1.pssec.focus();
                    return false;
                }
                if(document.f1.pehour.value=="none")
                {
                    alert("Please select end hour!!!");
                    document.f1.pehour.focus();
                    return false;
                }
                if(document.f1.pemin.value=="none")
                {
                    alert("Please select end minute!!!");
                    document.f1.pemin.focus();
                    return false;
                }
                if(document.f1.pesec.value=="none")
                {
                    alert("Please select end second!!!");
                    document.f1.pesec.focus();
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
                                <h2>Manage Auction Pause Time</h2>
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
                                                        <li class="blue"><span class="ico"></span><strong class="system_title"><span class="required">*</span> Required Information<br/><br/>NOTE: Your change in Pause Auction Management reflects after ten minutes.</strong></li>
                                                    </ul>

                                                    <!--[if !IE]>end system messages<![endif]-->

                                                    <!--[if !IE]>start forms<![endif]-->
                                                    <form name="f1" id="f1" action="manageauctionpause.php" method="post" onsubmit="return Check(this)" class="search_form general_form">
                                                        <!--[if !IE]>start fieldset<![endif]-->
                                                        <fieldset>
                                                            <!--[if !IE]>start forms<![endif]-->
                                                            <div class="forms">
                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Pause Start Time:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper_custom blank">
                                                                            <select name="pshour" style="display:inline;width:auto;">
                                                                                <option value="none">hh</option>
                                                                                <?
                                                                                for($i=0;$i<=23;$i++) {
                                                                                    if($i<10) {
                                                                                        $i = "0".$i;
                                                                                    }
                                                                                    ?>
                                                                                <option <?=$pshour==$i?"selected":"";?> value="<?=$i;?>"><?=$i;?></option>
                                                                                    <?
                                                                                }
                                                                                ?>
                                                                            </select>
                                                                            <select name="psmin" style="display:inline;width:auto;">
                                                                                <option value="none">mm</option>
                                                                                <?
                                                                                for($i=0;$i<=59;$i++) {
                                                                                    if($i<10) {
                                                                                        $i = "0".$i;
                                                                                    }
                                                                                    ?>
                                                                                <option <?=$psmin==$i?"selected":"";?> value="<?=$i;?>"><?=$i;?></option>
                                                                                    <?
                                                                                }
                                                                                ?>
                                                                            </select>
                                                                            <select name="pssec" style="display:inline;width:auto;">
                                                                                <option value="none">ss</option>
                                                                                <?
                                                                                for($i=0;$i<=59;$i++) {
                                                                                    if($i<10) {
                                                                                        $i = "0".$i;
                                                                                    }
                                                                                    ?>
                                                                                <option <?=$pssec==$i?"selected":"";?> value="<?=$i;?>"><?=$i;?></option>
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
                                                                    <label>Pause End Time:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper_custom blank">
                                                                            <select name="pehour" style="display:inline;width:auto;">
                                                                                <option value="none">hh</option>
                                                                                <?
                                                                                for($i=0;$i<=23;$i++) {
                                                                                    if($i<10) {
                                                                                        $i = "0".$i;
                                                                                    }
                                                                                    ?>
                                                                                <option <?=$pehour==$i?"selected":"";?> value="<?=$i;?>"><?=$i;?></option>
                                                                                    <?
                                                                                }
                                                                                ?>
                                                                            </select>
                                                                            <select name="pemin" style="display:inline;width:auto;">
                                                                                <option value="none">mm</option>
                                                                                <?
                                                                                for($i=0;$i<=59;$i++) {
                                                                                    if($i<10) {
                                                                                        $i = "0".$i;
                                                                                    }
                                                                                    ?>
                                                                                <option <?=$pemin==$i?"selected":"";?> value="<?=$i;?>"><?=$i;?></option>
                                                                                    <?
                                                                                }
                                                                                ?>
                                                                            </select>
                                                                            <select name="pesec" style="display:inline;width:auto;">
                                                                                <option value="none">ss</option>
                                                                                <?
                                                                                for($i=0;$i<=59;$i++) {
                                                                                    if($i<10) {
                                                                                        $i = "0".$i;
                                                                                    }
                                                                                    ?>
                                                                                <option <?=$pesec==$i?"selected":"";?> value="<?=$i;?>"><?=$i;?></option>
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
                                                                    <div class="buttons">
                                                                        <ul>
                                                                            <li>
                                                                                <span class="button send_form_btn"><span><span>Update</span></span><input name="updatepausetime" type="submit"/></span>
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