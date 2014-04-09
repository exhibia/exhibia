<?
session_start();
$active = "Users";
include("connect.php");
include("admin.config.inc.php");
include("security.php");

if ($_POST["addbonusbid"] != "") {
    $user_id = $_POST["username"];
    $bonusbid = $_POST["bonusbids"];
    $reason = "For refering a friend (" . $_POST["reason"] . ")";

    if ($bonusbid > 0) {
        $reason = "For refering a friend (" . $_POST["reason"] . ")";
    }


    header("location: message.php?msg=44");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="imagetoolbar" content="no" />
        <title>Credit/Debit Bids-<?php echo $ADMIN_MAIN_SITE_NAME ?></title>
        <link media="screen" rel="stylesheet" type="text/css" href="css/admin.css"  />
        <link media="screen" rel="stylesheet" type="text/css" href="css/jquery.autocomplete.css"  />
        <link rel="stylesheet" type="text/css" href="js/lib/thickbox.css" />
        <!--[if lte IE 6]><link media="screen" rel="stylesheet" type="text/css" href="css/admin-ie.css" /><![endif]-->
        <script type="text/javascript" src="js/behaviour.js"></script>
        <script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
        <script type="text/javascript" src="js/lib/jquery.bgiframe.min.js"></script>
        <script type="text/javascript" src="js/lib/jquery.ajaxQueue.js"></script>
        <script type='text/javascript' src='js/lib/thickbox-compressed.js'></script>
        <script type="text/javascript" src="js/jquery.autocomplete.pack.js"></script>
        <script type="text/javascript">
            function Check(f1)
            {
                if(document.f1.username.value=="none")
                {
                    alert("Please select username!!!")
                    document.f1.username.focus();
                    return false;
                }
                if(document.f1.bonusbids.value=="")
                {
                    alert("Please enter bonusbids!!!")
                    document.f1.bonusbids.focus();
                    return false;
                }
                if(document.f1.reason.value=="")
                {
                    alert("Please enter reason!!!");
                    document.f1.reason.focus();
                    return false;
                }
            }
            $(document).ready(function(){
                $("#username").autocomplete('getUserList.php', {
                    multiple: false,
                    dataType: "json",
                    parse: function(data) {
                        return $.map(data, function(row) {
                            return {
                                data: row,
                                value: row.id,
                                result: row.username
                            }
                        });
                    },
                    formatItem: function(item){
                        return item.username;
                    },
                    formatResult: function(item){
                        return item.id;
                    }
                }).result(function(e, item) {
                    $('#username-hidden').val(item.id);
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
                                <h2>Credit/Debit Bids
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

                                                    <!--[if !IE]>start forms<![endif]-->
                                                    <form autocomplete="off" action="" method="POST" enctype="multipart/form-data" onSubmit="return checkform(this);" class="search_form general_form">
                                                        <!--[if !IE]>start fieldset<![endif]-->
                                                        <fieldset>
                                                            <!--[if !IE]>start forms<![endif]-->
                                                            <div class="forms">

                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>User Name:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper">
                                                                            <input class="text" id="username" type="text" value="" size="10"/>
                                                                            <input type="hidden" id="username-hidden" name="username"/>

                                                                        </span>
                                                                        <span class="system required">*</span>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->

                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Cr/Dr Bids:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper">
                                                                            <input class="text" type="text" name="bonusbids" size="10" maxlength="10" />
                                                                        </span>
                                                                        <span class="system required">*</span>
                                                                        <span class="system message">Note: If Bid value is negative then bids deducted from user account otherwise bids added in user account.</span>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->

                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Bids Type:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper blank">
                                                                            <select name="bidstype">
                                                                                <option value="0">Free Points</option>
                                                                                <option value="1">Bidding Points</option>
                                                                            </select>
                                                                        </span>
                                                                        <span class="system required">*</span>
                                                                        <span class="system message">(Note: If bid type is add in free points then points credited to users freepoints otherwise bids credited in user bidding points)</span>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->

                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Reason:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper textarea_wrapper">
                                                                            <textarea name="reason" rows="" cols="" class="text"></textarea>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->

                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <div class="buttons">
                                                                        <ul>
                                                                            <li>
                                                                                <span class="button send_form_btn"><span><span>Submit</span></span><input name="addbonusbid" type="submit"/></span>

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