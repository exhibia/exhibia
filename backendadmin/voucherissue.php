<?php
session_start();
$active="Auctions";
include("connect.php");
include("admin.config.inc.php");
include("security.php");

function AcceptDateFunctionStatus($date,$validity) {
    $year = substr($date,0,4);
    $month = substr($date,5,2);
    $day = substr($date,8,2) + $validity;
    $newdate = explode(" ",$date);
    $exdate = explode("-",$newdate[0]);
    $newyear = $exdate[0];
    $newmonth = $exdate[1];
    $newday = $exdate[2];
    $newtime = explode(":",$newdate[1]);
    $newhour = $newtime[0];
    $newmin = $newtime[1];
    $newsec = $newtime[2];
    $returndate1 = date("Y-m-d H:i:s",mktime($newhour,$newmin,$newsec,$newmonth,$newday+$validity,$newyear));

    $newdate1 = explode(" ",$returndate1);
    $exdate1 = explode("-",$newdate1[0]);
    $newyear1 = $exdate1[0];
    $newmonth1 = $exdate1[1];
    $newday1 = $exdate1[2];
    $newtime1 = explode(":",$newdate1[1]);
    $newhour1 = $newtime1[0];
    $newmin1 = $newtime1[1];
    $newsec1 = $newtime1[2];

    $returndate = array("Hour"=>$newhour1,"Min"=>$newmin1,"Sec"=>$newsec1,"Month"=>$newmonth1,"Day"=>$newday1,"Year"=>$newyear1);

    return $returndate1;
}	

if($_POST["issuevoucher"]!="") {
    $userinfo = $_POST["userinfo"];
    $voucherid = $_POST["vouchername"];

    $qryvoucher = "select * from vouchers where id='".$voucherid."'";
    $resvoucher = db_query($qryvoucher);
    $objvoucher = db_fetch_object($resvoucher);
    $voucherdesc = $objvoucher->voucher_title;

    if($objvoucher->validity>0) {
        $expirydate = AcceptDateFunctionStatus(date("Y-m-d H:i:s",time()),$objvoucher->validity);
        $voucherdesc .= " (valid for ".$objvoucher->validity." days)";
    }

    if($userinfo=="alluser") {
        $qryreg = "select * from registration where account_status='1' and member_status='0' and user_delete_flag!='d'";
        $resreg = db_query($qryreg);
        $totalreg = db_num_rows($resreg);

        while($objreg = db_fetch_object($resreg)) {
            $userid = $objreg->id;

            $qryins = "insert into user_vouchers (voucherid,user_id,issuedate,expirydate,voucher_status,voucher_desc) values('".$voucherid."','".$userid."',NOW(),'".$expirydate."','0','".$voucherdesc ."')";
            db_query($qryins) or die(db_error());
        }
        header("location: message.php?msg=59");
        exit;
    }

    elseif($userinfo=="alluserexcept") {
        $qryreg = "select *,r.id as userid from registration r left join bid_account ba on ba.user_id=r.id where ba.bid_flag='c' and account_status='1' and member_status='0' and user_delete_flag!='d' group by ba.user_id";
        $resreg = db_query($qryreg);
        $totalreg = db_num_rows($resreg);
        while($objreg = db_fetch_object($resreg)) {
            $userid = $objreg->userid;

            $qryins = "insert into user_vouchers (voucherid,user_id,issuedate,expirydate,voucher_status,voucher_desc) values('".$voucherid."','".$userid."',NOW(),'".$expirydate."','0','".$voucherdesc ."')";
            db_query($qryins) or die(db_error());
        }
        header("location: message.php?msg=59");
        exit;
    }

    elseif($userinfo=="selecteduser") {
        $userlist = explode(",",$_POST["userlist"]);
        $userlistcount = count($userlist);
        for($i=0;$i<$userlistcount;$i++) {
            $qryreg1 = "select * from registration where username='".$userlist[$i]."'";
            $resreg1 = db_query($qryreg1);
            $objreg1 = db_fetch_object($resreg1);

            $userid = $objreg1->id;

            $qryins = "insert into user_vouchers (voucherid,user_id,issuedate,expirydate,voucher_status,voucher_desc) values('".$voucherid."','".$userid."',NOW(),'".$expirydate."','0','".$voucherdesc ."')";
            db_query($qryins) or die(db_error());
        }
        header("location: message.php?msg=59");
        exit;
    }
}

if($_POST["submit"]!="") {
    $voucherid = $_POST["vouchername"];

    $qrysel = "select * from vouchers where newuser_flag='1'";
    $ressel = db_query($qrysel);
    $total = db_num_rows($ressel);
    if($total>0) {
        $objupd = db_fetch_object($ressel);
        $qryupd1 = "update vouchers set newuser_flag='0' where id='".$objupd->id."'";
        db_query($qryupd1) or die(db_error());
    }

    $qryupd = "update vouchers set newuser_flag='1' where id='".$voucherid."'";
    db_query($qryupd) or die(db_error());
    header("location: message.php?msg=60");
    exit;
}

$qrynvou = "select * from vouchers where newuser_flag='1'";
$resnvou = db_query($qrynvou);
$totalnvou = db_num_rows($resnvou);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="imagetoolbar" content="no" />
        <title>Issue Voucher-<?php echo $ADMIN_MAIN_SITE_NAME ?></title>
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
                if(document.f1.vouchername.value=='none')
                {
                    alert("Please select voucher!!!");
                    document.f1.vouchername.focus();
                    return false;
                }
            }

            function Check1(f2)
            {
                if(document.f2.vouchername.value=='none')
                {
                    alert("Please select voucher!!!");
                    document.f2.vouchername.focus();
                    return false;
                }
                if(document.f2.userinfo.value=='none')
                {
                    alert("Please select user information!!!");
                    document.f2.userinfo.focus();
                    return false;
                }
                if(document.f2.userinfo.value=='selecteduser' && document.getElementById('userlist').value=="")
                {
                    alert("Please select users!!!");
                    document.getElementById('username').focus();
                    return false;
                }
            }

            function AddUserList()
            {
                seluser = document.getElementById('username');
                userlist = document.getElementById('userlist');

                if(seluser.value=='none')
                {
                    alert("Please select username!!!");
                    document.getElementById('username').focus();
                    return false
                }
                else
                {
                    temp = seluser.value;
                    userinfo = temp.split("|");
                    if(userlist.value=="")
                    {
                        userlist.value = userinfo[1];
                    }
                    else
                    {
                        oldvalue = userlist.value;
                        userlist.value = oldvalue + "," + userinfo[1];
                        seluser.focus();
                    }
                }
            }

            function ShowUserInfo(id)
            {
                if(id=='selecteduser')
                {
                    if(navigator.appName!="Microsoft Internet Explorer")
                    {
                        document.getElementById('firstrow').style.display='table-row';
                        document.getElementById('firstrow1').style.display='table-row';
                    }
                    else
                    {
                        document.getElementById('firstrow').style.display='block';
                        document.getElementById('firstrow1').style.display='block';
                    }
                }
                else
                {
                    document.getElementById('firstrow').style.display='none';
                    document.getElementById('firstrow1').style.display='none';
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
                                <h2>Issue Voucher</h2>
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
                                                    <h3>New Subscribers</h3>
                                                    <p>
                                                        <!--[if !IE]>start forms<![endif]-->
                                                        <form name="f1" action="voucherissue.php" method="post" onsubmit="return Check(f1)" class="search_form general_form">
                                                            <!--[if !IE]>start fieldset<![endif]-->
                                                            <fieldset>
                                                                <!--[if !IE]>start forms<![endif]-->
                                                                <div class="forms">

                                                                    <!--[if !IE]>start row<![endif]-->
                                                                    <div class="row">
                                                                        <label>Voucher Title:</label>
                                                                        <div class="inputs">
                                                                            <span class="input_wrapper_custom blank">
                                                                                <?
                                                                                $qrysel = "select * from vouchers";
                                                                                $ressel = db_query($qrysel);
                                                                                $total = db_num_rows($ressel);
                                                                                ?>
                                                                                <select name="vouchername" style="width: auto;">
                                                                                    <option value="none">selece one</option>
                                                                                    <option value="selnone" <?=$totalnvou==0 &&$total>0?"selected":"";?>>None</option>
                                                                                    <?
                                                                                    while($obj = db_fetch_object($ressel)) {
                                                                                        ?>
                                                                                    <option <?=$obj->newuser_flag=="1"?"selected":"";?> value="<?=$obj->id;?>"><?=$obj->voucher_title;?></option>
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
                                                                                    <span class="button send_form_btn"><span><span>Set</span></span><input name="submit" type="submit"/></span>
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
                                                    </p>

                                                    <br/>
                                                    <br/>
                                                    <h3>All Users</h3>
                                                    <p>
                                                        <!--[if !IE]>start forms<![endif]-->
                                                        <form name="f2" action="voucherissue.php" method="post" onsubmit="return Check1(f2)" class="search_form general_form">
                                                            <!--[if !IE]>start fieldset<![endif]-->
                                                            <fieldset>
                                                                <!--[if !IE]>start forms<![endif]-->
                                                                <div class="forms">

                                                                    <!--[if !IE]>start row<![endif]-->
                                                                    <div class="row">
                                                                        <label>Voucher Title:</label>
                                                                        <div class="inputs">
                                                                            <span class="input_wrapper_custom blank">
                                                                                <?
                                                                                $qrysel = "select * from vouchers";
                                                                                $ressel = db_query($qrysel);
                                                                                $total = db_num_rows($ressel);
                                                                                ?>
                                                                                <select name="vouchername" style="width:auto;">
                                                                                    <option value="none">selece one</option>
                                                                                    <?
                                                                                    while($obj = db_fetch_object($ressel)) {
                                                                                        ?>
                                                                                    <option value="<?=$obj->id;?>"><?=$obj->voucher_title;?></option>
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
                                                                        <label>Users:</label>
                                                                        <div class="inputs">
                                                                            <span class="input_wrapper blank">
                                                                                <select name="userinfo" onchange="ShowUserInfo(this.value);">
                                                                                    <option value="none">select one</option>
                                                                                    <option value="alluser">Issue to all users</option>
                                                                                    <option value="alluserexcept">Issue to all users (except passive users)</option>
                                                                                    <option value="selecteduser">Issue to selected users</option>
                                                                                </select>
                                                                            </span>
                                                                            <span class="system required">*</span>
                                                                        </div>
                                                                    </div>
                                                                    <!--[if !IE]>end row<![endif]-->

                                                                    <!--[if !IE]>start row<![endif]-->
                                                                    <div class="row" id="firstrow" style="display: none;">
                                                                        <label>Select user:</label>
                                                                        <div class="inputs">
                                                                            <span class="input_wrapper blank">
                                                                                <select name="username" id="username" style="width:auto;display: inline;">
                                                                                    <option value="none">select one</option>
                                                                                    <?
                                                                                    $qry = "select * from registration where account_status='1' and user_delete_flag!='d' and member_status='0'";
                                                                                    $rs = db_query($qry);

                                                                                    while($ob = db_fetch_object($rs)) {
                                                                                        ?>
                                                                                    <option value="<?=$ob->id;?>|<?=$ob->username;?>"><?=$ob->username;?></option>
                                                                                        <?
                                                                                    }
                                                                                    ?>
                                                                                </select>&nbsp;&nbsp;<input type="button" name="adduser" id="adduser" value="Add" class="bttn" onclick="AddUserList();" />
                                                                            </span>
                                                                            <span class="system required">*</span>
                                                                        </div>
                                                                    </div>
                                                                    <!--[if !IE]>end row<![endif]-->

                                                                    <!--[if !IE]>start row<![endif]-->
                                                                    <div class="row" id="firstrow1" style="display: none;">
                                                                        <label>Description:</label>
                                                                        <div class="inputs">
                                                                            <span class="input_wrapper textarea_wrapper">
                                                                                <textarea class="text_no_editor" name="userlist" id="userlist" cols="50" rows="3"></textarea>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                    <!--[if !IE]>end row<![endif]-->

                                                                    <!--[if !IE]>start row<![endif]-->
                                                                    <div class="row">
                                                                        <div class="buttons">
                                                                            <ul>
                                                                                <li>
                                                                                    <span class="button send_form_btn"><span><span>Issue Voucher</span></span><input name="issuevoucher" type="submit"/></span>
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
                                                    </p>

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