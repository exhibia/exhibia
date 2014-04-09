<?php
session_start();
$active="Report";
include_once("admin.config.inc.php");
include("connect.php");
include("functions.php");
include("security.php");

if($_POST["submit"]!="" || $_GET["sdate"]!="") {
    if(!$_GET['pgno']) {
        $PageNo = 1;
    }
    else {
        $PageNo = $_GET['pgno'];
    }

    if($_POST["submit"]!="") {
        $startdate = ChangeDateFormat($_POST["datefrom"]);
        $enddate = ChangeDateFormat($_POST["dateto"]);
        $uid = $_POST["userid"];
        $starttime = $_POST["starthour"].":".$_POST["startmin"].":".$_POST["startsec"];
        $endtime = $_POST["endhour"].":".$_POST["endmin"].":".$_POST["endsec"];
        if($endtime=="00:00:00") {
            $endtime = "23:59:59";
        }
    }
    else {
        $startdate = ChangeDateFormat($_GET["sdate"]);
        $enddate = ChangeDateFormat($_GET["edate"]);
        $uid = $_GET["uid"];
        $starttime = $_GET["stime"];
        $endtime = $_GET["etime"];
        if($endtime=="00:00:00") {
            $endtime = "23:59:59";
        }
    }

    $urldata = "sdate=".ChangeDateFormatSlash($startdate)."&edate=".ChangeDateFormatSlash($enddate)."&uid=".$uid."&stime=".$starttime."&etime=".$endtime;

    $qrysel = "SELECT *,DATE_FORMAT(login_time, '%Y-%m-%d')  AS logindate,DATE_FORMAT(logout_time, '%Y-%m-%d') as logoutdate
FROM login_logout la left join registration r on la.user_id=r.id where login_time>='$startdate $starttime' and logout_time<='$enddate $endtime' and user_id!='0' group by user_id";
    if($uid!="") {
        $qrysel = "SELECT *,DATE_FORMAT(login_time, '%Y-%m-%d')  AS logindate,DATE_FORMAT(logout_time, '%Y-%m-%d') as logoutdate
FROM login_logout la left join registration r on la.user_id=r.id where login_time>='$startdate $starttime' and logout_time<='$enddate $endtime' and user_id='$uid' group by user_id";
    }
    $ressel = db_query($qrysel);
    $total = db_num_rows($ressel);
    $totalnumrows = $total;
    $totalpage=ceil($total/$PRODUCTSPERPAGE);

    if($totalpage>=1) {
        $startrow=$PRODUCTSPERPAGE*($PageNo-1);
        $qrysel.=" LIMIT $startrow,$PRODUCTSPERPAGE";
        $ressel=db_query($qrysel);
        $total=db_num_rows($ressel);
    }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="imagetoolbar" content="no" />
        <title>Per hour Average Login/Logout Time Report-<?php echo $ADMIN_MAIN_SITE_NAME ?></title>
        <link media="screen" rel="stylesheet" type="text/css" href="css/admin.css"  />
        <link type="text/css" href="css/cupertino/ui.all.css" rel="stylesheet" />
        <!--[if lte IE 6]><link media="screen" rel="stylesheet" type="text/css" href="css/admin-ie.css" /><![endif]-->
        <script type="text/javascript" src="js/behaviour.js"></script>
        <script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
        <script type="text/javascript" src="js/ui/ui.core.min.js"></script>
        <script type="text/javascript" src="js/ui/ui.datepicker.min.js"></script>
        <script type="text/javascript">
            function Check(f1)
            {
                if(document.f1.datefrom.value=="")
                {
                    alert("Please select start date!!!");
                    return false;
                    document.f1.datefrom.focus();
                }
                if(document.f1.dateto.value=="")
                {
                    alert("Please select end date!!!");
                    return false;
                    document.f1.dateto.focus();
                }
                if(document.f1.starthour.value=="")
                {
                    alert("Please select start hour!!!");
                    document.f1.starthour.focus();
                    return false;
                }
                if(document.f1.startmin.value=="")
                {
                    alert("Please select start minute!!!");
                    document.f1.startmin.focus();
                    return false;
                }
                if(document.f1.startsec.value=="")
                {
                    alert("Please select start second!!!");
                    document.f1.startsec.focus();
                    return false;
                }
                if(document.f1.endhour.value=="")
                {
                    alert("Please select end hour!!!");
                    document.f1.endhour.focus();
                    return false;
                }
                if(document.f1.endmin.value=="")
                {
                    alert("Please select end minute!!!");
                    document.f1.endmin.focus();
                    return false;
                }
                if(document.f1.endsec.value=="")
                {
                    alert("Please select end second!!!");
                    document.f1.endsec.focus();
                    return false;
                }
            }
            function calc_counter_from_time(diff) {
                if (diff > 0) {
                    hours=Math.floor(diff / 3600)

                    minutes=Math.floor((diff / 3600 - hours) * 60)

                    seconds=Math.round((((diff / 3600 - hours) * 60) - minutes) * 60)
                } else {
                    hours = 0;
                    minutes = 0;
                    seconds = 0;
                }

                if (seconds == 60) {
                    seconds = 0;
                }

                if (minutes < 10) {
                    if (minutes < 0) {
                        minutes = 0;
                    }
                    minutes = '0' + minutes;
                }
                if (seconds < 10) {
                    if (seconds < 0) {
                        seconds = 0;
                    }
                    seconds = '0' + seconds;
                }
                if (hours < 10) {
                    if (hours < 0) {
                        hours = 0;
                    }
                    hours = '0' + hours;
                }
                return hours + ":" + minutes + ":" + seconds;
            }

            function OpenPopup(url)
            {
                var recto = Number(document.getElementById('recto').value);
                var recfrom = Number(document.getElementById('recfrom').value);

                if(recfrom!="")
                {
                    if(recfrom>=recto)
                    {
                        alert("Record To value must be greater than Record From value!");
                        return false;
                    }
                }
                url = url + "&recfrom=" + recfrom + "&recto=" + recto;
                window.open(url,'popupWindow','toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=no,resizable=no,copyhistory=no,width=100,height=100,screenX=300,screenY=350,top=300,left=350');
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
                                <h2>Per hour Average Login/Logout Time Report</h2>
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

                                                    <!--[if !IE]>start forms<![endif]-->
                                                    <form action="" method="post" name="f1" onsubmit="return Check(this)" class="search_form general_form">
                                                        <!--[if !IE]>start fieldset<![endif]-->
                                                        <fieldset>
                                                            <!--[if !IE]>start forms<![endif]-->
                                                            <div class="forms">
                                                                <?php include("datepickers.php"); ?>
                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Select Time:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper_custom blank">
                                                                            <select name="starthour" style="text-align:center;width:auto;">
                                                                                <option value="">hh</option>
                                                                                <?
                                                                                $timeset = explode(":",$starttime);
                                                                                $timesetend = explode(":",$endtime);
                                                                                for($h=0;$h<=23;$h++) {
                                                                                    ?>
                                                                                <option <?=$h==$timeset[0]?"selected":"";?> value="<?=str_pad($h,2,'0',STR_PAD_LEFT);?>"><?=str_pad($h,2,'0',STR_PAD_LEFT);?></option>
                                                                                    <?
                                                                                }
                                                                                ?>
                                                                            </select>
                                                                            <select name="startmin" style="text-align:center;width:auto;">
                                                                                <option value="">mm</option>
                                                                                <?
                                                                                for($m=0;$m<=59;$m++) {
                                                                                    ?>
                                                                                <option <?=$m==$timeset[1]?"selected":"";?> value="<?=str_pad($m,2,'0',STR_PAD_LEFT);?>"><?=str_pad($m,2,'0',STR_PAD_LEFT);?></option>
                                                                                    <?
                                                                                }
                                                                                ?>
                                                                            </select>
                                                                            <select name="startsec" style="text-align:center;width:auto;">
                                                                                <option value="">ss</option>
                                                                                <?
                                                                                for($s=0;$s<=59;$s++) {
                                                                                    ?>
                                                                                <option <?=$s==$timeset[2]?"selected":"";?> value="<?=str_pad($s,2,'0',STR_PAD_LEFT);?>"><?=str_pad($s,2,'0',STR_PAD_LEFT);?></option>
                                                                                    <?
                                                                                }
                                                                                ?>
                                                                            </select>&nbsp;&nbsp; <strong>To</strong> &nbsp;&nbsp;
                                                                            <select name="endhour" style="text-align:center;width:auto;">
                                                                                <option value="">hh</option>
                                                                                <?
                                                                                for($h=0;$h<=23;$h++) {
                                                                                    ?>
                                                                                <option <?=$h==$timesetend[0]?"selected":"";?> value="<?=str_pad($h,2,'0',STR_PAD_LEFT);?>"><?=str_pad($h,2,'0',STR_PAD_LEFT);?></option>
                                                                                    <?
                                                                                }
                                                                                ?>
                                                                            </select>
                                                                            <select name="endmin" style="text-align:center;width:auto;">
                                                                                <option value="">mm</option>
                                                                                <?
                                                                                for($m=0;$m<=59;$m++) {
                                                                                    ?>
                                                                                <option <?=$m==$timesetend[1]?"selected":"";?> value="<?=str_pad($m,2,'0',STR_PAD_LEFT);?>"><?=str_pad($m,2,'0',STR_PAD_LEFT);?></option>
                                                                                    <?
                                                                                }
                                                                                ?>
                                                                            </select>
                                                                            <select name="endsec" style="text-align:center;width:auto;">
                                                                                <option value="">ss</option>
                                                                                <?
                                                                                for($s=0;$s<=59;$s++) {
                                                                                    ?>
                                                                                <option <?=$s==$timesetend[2]?"selected":"";?> value="<?=str_pad($s,2,'0',STR_PAD_LEFT);?>"><?=str_pad($s,2,'0',STR_PAD_LEFT);?></option>
                                                                                    <?
                                                                                }
                                                                                ?>
                                                                            </select>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->

                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>User ID:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper">
                                                                            <input class="text" type="text" name="userid" value="<?=$uid;?>" size="8" />
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->

                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <div class="buttons">
                                                                        <ul>
                                                                            <li>
                                                                                <span class="button send_form_btn"><span><span>Search</span></span><input name="submit" type="submit"/></span>
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

                        <?php if(isset($total)) {
                            if($total<=0) { ?>
                        <ul class="system_messages">
                            <li class="blue"><span class="ico"></span><strong class="system_title">No Users To Display</strong></li>
                        </ul>
                                <?php }else {?>
                        <!--[if !IE]>start section<![endif]-->
                        <div class="section table_section">
                            <!--[if !IE]>start title wrapper<![endif]-->
                            <div class="title_wrapper">
                                <h2>Time Report</h2>
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
                                                    <div class="categoryorder">
                                                        <div>
                                                            <span><strong>Active Users:</strong><?=$totalcount2;?>&nbsp;&nbsp;</span>
                                                            <span><strong>Unsubscribed Users:</strong><?=$totalcount3;?>&nbsp;&nbsp;</span>
                                                            <span><strong>Unverified Users:</strong><?=$totalcount1;?>&nbsp;&nbsp;</span>
                                                            <span><strong>Suspended Users:</strong><?=$totalcount4;?>&nbsp;&nbsp;</span>
                                                            <span><strong>Total Users:</strong><?=$totalcount;?>&nbsp;&nbsp;</span>
                                                        </div>
                                                        <br/>
                                                        <div>
                                                            <div style="float:left;">
                                                                <strong>Export details details to CSV :&nbsp;From</strong>:<input id="recfrom" type="text" name="recfrom" value="0" />&nbsp;-&nbsp;
                                                                <strong>To</strong>:<input id="recto" type="text" name="recto" value="<?=$totalnumrows?>" />&nbsp;&nbsp;&nbsp;
                                                            </div>
                                                            <span class="button send_form_btn"><span><span>Export to CSV</span></span><input name="submit" type="button" onclick="OpenPopup('download.php?export=perhour&<?=$urldata;?>')" /></span>

                                                        </div>
                                                        <div class="clear"></div>

                                                    </div>
                                                    <div  id="product_list">
                                                        <!--[if !IE]>start table_wrapper<![endif]-->
                                                        <div class="table_wrapper">
                                                            <div class="table_wrapper_inner">

                                                                <form id="form2" name="form2" action="" method="post">
                                                                    <table cellpadding="0" cellspacing="0" width="100%">
                                                                        <tbody>
                                                                            <tr>
                                                                                <th style="text-align:center;width:60px;">User ID</th>
                                                                                <th>User Name</th>
                                                                                <th style="text-align:center;">Total Login/Logout</th>
                                                                                <th style="text-align:center;">Average Duration</th>
                                                                                <th style="text-align:center;width:80px;">Option</th>
                                                                            </tr>
                                                                                    <?php
                                                                                    $colorflg=0;
                                                                                    while($obj = db_fetch_object($ressel)) {
                                                                                        if ($colorflg==1) {
                                                                                            $colorflg=0;
                                                                                            echo "<TR bgcolor=\"#f4f4f4\"> ";
                                                                                        }else {
                                                                                            $colorflg=1;
                                                                                            echo "<TR> ";
                                                                                        }
                                                                                        $time = explode("|",getTotalTimeLogin1($obj->user_id,$startdate." ".$starttime,$enddate." ".$endtime));
                                                                                        $finalusertime = $time[1]/$time[0];
                                                                                        $allusertime = $finalusertime + $finalusertimeplus;
                                                                                        $finalusertimeplus = $allusertime;
                                                                                        ?>
                                                                            <tr class="<?php echo ($colorflg==0)?'first':'second'; ?>">
                                                                                <td style="text-align:center;"><?=$obj->user_id;?></td>
                                                                                <td><?=$obj->username;?></td>
                                                                                <td style="text-align:center;"><?=$time[0];?></td>
                                                                                <td style="text-align:center;">
                                                                                    <span id="duration_<?=$obj->user_id;?>">
                                                                                                    <?
                                                                                                    echo "<script language=javascript>
						document.getElementById('duration_".$obj->user_id."').innerHTML = calc_counter_from_time('".$finalusertime."');
						</script>
						";
                                                                                                    ?>
                                                                                    </span>
                                                                                </td>
                                                                                <td style="text-align:center;">
                                                                                    <div class="actions_menu">
                                                                                        <ul>
                                                                                            <li>
                                                                                                <a name="details" class="details" href="view_member_statistics.php?uid=<?=$obj->user_id;?>">Statistics</a>
                                                                                            </li>
                                                                                        </ul>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                                        <?php

                                                                                    }
                                                                                    ?>
                                                                            <tr>
                                                                                <th colspan="4" style="text-align:right;">
                                                                                    All users average login/logout:
                                                                                </th>
                                                                                <td>
                                                                                    <span id="allusertime">
                                                                                                <?
                                                                                                echo "<script language=javascript>
					document.getElementById('allusertime').innerHTML = calc_counter_from_time('".$allusertime/$total."');
					</script>
					";
                                                                                                ?>
                                                                                    </span>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </form>

                                                            </div>
                                                        </div>
                                                        <!--[if !IE]>end table_wrapper<![endif]-->
                                                    </div>

                                                            <?php if($total) { ?>
                                                    <!--[if !IE]>start pagination<![endif]-->
                                                    <div class="pagination">
                                                        <span class="page_no">Page <?php echo $PageNo; ?> of <?php echo $totalpage; ?></span>
                                                        <ul class="pag_list">
                                                                        <?php
                                                                        if($PageNo>1) {
                                                                            $PrevPageNo = $PageNo-1;
                                                                            ?>
                                                            <li><a href="perhourreport.php?pgno=<?=$PrevPageNo;?>&<?=$urldata;?>" class="button light_blue_btn"><span><span>PREVIOUS</span></span></a> </li>
                                                                            <?php } ?>

                                                                        <?php
                                                                        $pageFrom=$PageNo-3<1?1:$PageNo-3;
                                                                        $pageTo=$PageNo+3>$totalpage?$totalpage:$PageNo+3;
                                                                        for($i=$pageFrom;$i<=$pageTo;$i++) {
                                                                            ?>
                                                                            <?php if($i==$PageNo) { ?>
                                                            <li><a href="perhourreport.php?pgno=<?=$i;?>&<?=$urldata;?>" class="current_page"><span><span><?php echo $i; ?></span></span></a></li>
                                                                                <?php }else {?>
                                                            <li><a href="perhourreport.php?pgno=<?=$i;?>&<?=$urldata;?>"><?php echo $i; ?></a></li>
                                                                                <?php }
                                                                        }
                                                                        ?>
                                                                        <?php
                                                                        if($PageNo<$totalpage) {
                                                                            $NextPageNo = 	$PageNo + 1;
                                                                            ?>
                                                            <li><a href="perhourreport.php?pgno=<?=$NextPageNo;?>&<?=$urldata;?>" class="button light_blue_btn"><span><span>NEXT</span></span></a> </li>
                                                                            <?php } ?>
                                                        </ul>

                                                    </div>
                                                    <!--[if !IE]>end pagination<![endif]-->
                                                                <?php }?>

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

                                <?php }
                        }
                        ?>

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