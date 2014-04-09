<?
session_start();
$active = "Users";
include_once("admin.config.inc.php");
include("connect.php");
include("functions.php");
include("security.php");

$startdate = '';
$enddate = '';

if (!$_GET['pgno']) {
    $PageNo = 1;
} else {
    $PageNo = $_GET['pgno'];
}

if ($_POST["submit"] != "" || $_GET["sdate"] != "") {
    if ($_POST["submit"] != "") {
        $startdate = ChangeDateFormat($_POST["datefrom"]);
        $enddate = ChangeDateFormat($_POST["dateto"]);
        $username = $_POST["username"];
        $quyenddate = $enddate . ' 23:59:59';
    } else {
        $startdate = ChangeDateFormat($_GET["sdate"]);
        $enddate = ChangeDateFormat($_GET["edate"]);
        $username = $_GET["username"];
        $quyenddate = $enddate . ' 23:59:59';
    }

    $urldata = "sdate=" . ChangeDateFormatSlash($startdate) . "&edate=" . ChangeDateFormatSlash($enddate) . "&username=" . $username;

    $wherecase = '';
    if ($startdate != '') {
        $wherecase.="and bidpack_buy_date>'$startdate' ";
    }
    if ($quyenddate != '') {
        $wherecase.="and bidpack_buy_date<'$quyenddate' ";
    }
    if ($username != '' && $username != 'allusers' && $username != 'All Users') {
        $wherecase.="and username like '$username%'";
    }

    $qrysel = "select user_id,bid_count,bidpack_buy_date,credit_description,username from bid_account b inner join registration r on r.id=b.user_id where bid_flag='c' and recharge_type='ad'
$wherecase";


    $ressel = db_query($qrysel);
    $total = db_num_rows($ressel);
    $totalnumrows = $total;
    $totalpage = ceil($total / $PRODUCTSPERPAGE);

    if ($totalpage >= 1) {
        $startrow = $PRODUCTSPERPAGE * ($PageNo - 1);
        $qrysel.=" LIMIT $startrow,$PRODUCTSPERPAGE";
        $ressel = db_query($qrysel);
        $total = db_num_rows($ressel);
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
        <link media="screen" rel="stylesheet" type="text/css" href="css/jquery.autocomplete.css"  />
        <link rel="stylesheet" type="text/css" href="js/lib/thickbox.css" />
        <!--[if lte IE 6]><link media="screen" rel="stylesheet" type="text/css" href="css/admin-ie.css" /><![endif]-->
        <script type="text/javascript" src="js/behaviour.js"></script>
        <script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
        <script type="text/javascript" src="js/ui/ui.core.min.js"></script>
        <script type="text/javascript" src="js/ui/ui.datepicker.min.js"></script>
        <script type="text/javascript" src="js/lib/jquery.bgiframe.min.js"></script>
        <script type="text/javascript" src="js/lib/jquery.ajaxQueue.js"></script>
        <script type='text/javascript' src='js/lib/thickbox-compressed.js'></script>
        <script type="text/javascript" src="js/jquery.autocomplete.pack.js"></script>
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
        </script>
        <script type="text/javascript">
            $(function() {
                $.datepicker.setDefaults({dateFormat:'<?php echo $globalDateformat=='d/m/Y'?'dd/mm/yy':'mm/dd/yy'; ?>'});
                $("#datefrom").datepicker({showOn: 'button', buttonImage: 'images/pmscalendar.gif', buttonImageOnly: true});
                $("#dateto").datepicker({showOn: 'button', buttonImage: 'images/pmscalendar.gif', buttonImageOnly: true});

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
                    $('#username').val(item.username);
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
                                <h2>Credit/Debit Bids Report</h2>
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
                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Please Select Date:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper_custom">
                                                                            <input type="text" name="datefrom" id="datefrom" size="12" value="<?= $startdate != "" ? ChangeDateFormatSlash($startdate) :
""; ?>"/>
                                                                            <strong>&nbsp;To&nbsp;</strong>
                                                                            <input type="text" name="dateto" size="12" id="dateto" value="<?= $enddate != "" ? ChangeDateFormatSlash($enddate) : "";
?>"/>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->
                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Username:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper">
                                                                            <input class="text" type="text" name="username" id="username" value="<?= $username; ?>" size="8" />
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

                        <?php
                        if (isset($total)) {
                            if ($total <= 0) {
                        ?>
                                <div class="section table_section">
                                    <!--[if !IE]>start title wrapper<![endif]-->
                                    <div class="title_wrapper">
					<h2>Credit/Debit Bids Report</h2>
                                        <span class="title_wrapper_left"></span>
                                        <span class="title_wrapper_right"></span>
                                    </div>
                                <ul class="system_messages">
                                    <li class="blue"><span class="ico"></span><strong class="system_title">No Report To Display</strong></li>
				  
                                </ul>
			      </div>
                                </ul>
                        <?php } else {
                        ?>
                                <!--[if !IE]>start section<![endif]-->
                                <div class="section table_section">
                                    <!--[if !IE]>start title wrapper<![endif]-->
                                    <div class="title_wrapper">
                                        <h2>Credit/Debit Bids Report</h2>
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
                                                                                        <th style="text-align:center;">Bid Count</th>
                                                                                        <th style="text-align:center;">Date</th>
                                                                                        <th style="text-align:center;">Description</th>
                                                                                    </tr>
                                                                            <?php
                                                                            $colorflg = 0;
                                                                            while ($obj = db_fetch_object($ressel)) {
                                                                                if ($colorflg == 1) {
                                                                                    $colorflg = 0;
                                                                                } else {
                                                                                    $colorflg = 1;
                                                                                }
                                                                            ?>
                                                                                <tr class="<?php echo ($colorflg == 0) ? 'first' : 'second'; ?>">
                                                                                    <td style="text-align:center;"><?= $obj->user_id; ?></td>
                                                                                    <td><?= $obj->username; ?></td>
                                                                                    <td style="text-align:center;"><?= $obj->bid_count; ?></td>
                                                                                    <td style="text-align:center;">
                                                                                    <?php echo arrangedate(substr($obj->bidpack_buy_date, 0, 10)) . " " . substr($obj->bidpack_buy_date, 11); ?>
                                                                                </td>
                                                                                <td style="text-align:center;">
                                                                                    <?php echo $obj->credit_description; ?>
                                                                                </td>
                                                                            </tr>
                                                                            <?php
                                                                                }
                                                                            ?>

                                                                            </tbody>
                                                                        </table>
                                                                    </form>

                                                                </div>
                                                            </div>
                                                            <!--[if !IE]>end table_wrapper<![endif]-->
                                                        </div>

                                                    <?php if ($total) {
 ?>
                                                                                    <!--[if !IE]>start pagination<![endif]-->
                                                                                    <div class="pagination">
                                                                                        <span class="page_no">Page <?php echo $PageNo; ?> of <?php echo $totalpage; ?></span>
                                                                                        <ul class="pag_list">
                                                            <?php
                                                                                    if ($PageNo > 1) {
                                                                                        $PrevPageNo = $PageNo - 1;
                                                            ?>
                                                                                        <li><a href="admincreditreport.php?pgno=<?= $PrevPageNo; ?>&<?= $urldata; ?>" class="button
light_blue_btn"><span><span>PREVIOUS</span></span></a> </li>
<?php } ?>

                                                            <?php
                                                                                    $pageFrom = $PageNo - 3 < 1 ? 1 : $PageNo - 3;
                                                                                    $pageTo = $PageNo + 3 > $totalpage ? $totalpage : $PageNo + 3;
                                                                                    for ($i = $pageFrom; $i <= $pageTo; $i++) {
                                                            ?>
                                                            <?php if ($i == $PageNo) { ?>
                                                                                            <li><a href="admincreditreport.php?pgno=<?= $i; ?>&<?= $urldata; ?>" class="current_page"><span><span><?php
echo $i; ?></span></span></a></li>
                                                            <?php } else {
 ?>
                                                                                            <li><a href="admincreditreport.php?pgno=<?= $i; ?>&<?= $urldata; ?>"><?php echo $i; ?></a></li>
                                                            <?php
                                                                                        }
                                                                                    }
                                                            ?>
                                                            <?php
                                                                                    if ($PageNo < $totalpage) {
                                                                                        $NextPageNo = $PageNo + 1;
                                                            ?>
                                                                                        <li><a href="admincreditreport.php?pgno=<?= $NextPageNo; ?>&<?= $urldata; ?>" class="button
light_blue_btn"><span><span>NEXT</span></span></a> </li>
<?php } ?>
                                                                                </ul>

                                                                            </div>
                                                                            <!--[if !IE]>end pagination<![endif]-->
<?php } ?>

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

                        <?php
                                                                            }
                                                                        }
                        ?>












 <?php







$qrysel = "select user_id,bid_count,bidpack_buy_date,credit_description,username from free_account b inner join registration r on r.id=b.user_id where bid_flag='c' and
recharge_type='ad' $wherecase";


    $ressel = db_query($qrysel);
    $total2 = db_num_rows($ressel);
    $totalnumrows = $total2;
    $totalpage = ceil($total / $PRODUCTSPERPAGE);

    if ($totalpage >= 1) {
        $startrow = $PRODUCTSPERPAGE * ($PageNo - 1);
        $qrysel.=" LIMIT $startrow,$PRODUCTSPERPAGE";
        $ressel = db_query($qrysel);
        $total2 = db_num_rows($ressel);
    }


                        if (isset($total2)) {
                            if ($total2 <= 0) {
                        ?>
                                <div class="section table_section">
                                    <!--[if !IE]>start title wrapper<![endif]-->
                                    <div class="title_wrapper">
                                        <h2>Free Bids Report</h2>
                                        <span class="title_wrapper_left"></span>
                                        <span class="title_wrapper_right"></span>
                                    </div>
                                <ul class="system_messages">
                                    <li class="blue"><span class="ico"></span><strong class="system_title">No Report To Display</strong></li>
				  
                                </ul>
			      </div>
                        <?php } else {
                        ?>
                                <!--[if !IE]>start section<![endif]-->
                                <div class="section table_section">
                                    <!--[if !IE]>start title wrapper<![endif]-->
                                    <div class="title_wrapper">
                                        <h2>Free Bids Report</h2>
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
                                                                                        <th style="text-align:center;">Bid Count</th>
                                                                                        <th style="text-align:center;">Date</th>
                                                                                        <th style="text-align:center;">Description</th>
                                                                                    </tr>
                                                                            <?php
                                                                            $colorflg = 0;
                                                                            while ($obj = db_fetch_object($ressel)) {
                                                                                if ($colorflg == 1) {
                                                                                    $colorflg = 0;
                                                                                } else {
                                                                                    $colorflg = 1;
                                                                                }
										
                                                                            ?>
                                                                                <tr class="<?php echo ($colorflg == 0) ? 'first' : 'second'; ?>">
                                                                                    <td style="text-align:center;"><?= $obj->user_id; ?></td>
                                                                                    <td><?= $obj->username; ?></td>
                                                                                    <td style="text-align:center;"><?= $obj->bid_count; ?></td>
                                                                                    <td style="text-align:center;">
                                                                                    <?php echo arrangedate(substr($obj->bidpack_buy_date, 0, 10)) . " " . substr($obj->bidpack_buy_date, 11); ?>
                                                                                </td>
                                                                                <td style="text-align:center;">
                                                                                    <?php echo $obj->credit_description; ?>
                                                                                </td>
                                                                            </tr>
                                                                            <?php
                                                                                }
                                                                            ?>

                                                                            </tbody>
                                                                        </table>
                                                                    </form>

                                                                </div>
                                                            </div>
                                                            <!--[if !IE]>end table_wrapper<![endif]-->
                                                        </div>

                                                    <?php if ($total) {
 ?>
                                                                                    <!--[if !IE]>start pagination<![endif]-->
                                                                                    <div class="pagination">
                                                                                        <span class="page_no">Page <?php echo $PageNo; ?> of <?php echo $totalpage; ?></span>
                                                                                        <ul class="pag_list">
                                                            <?php
                                                                                    if ($PageNo > 1) {
                                                                                        $PrevPageNo = $PageNo - 1;
                                                            ?>
                                                                                        <li><a href="admincreditreport.php?pgno=<?= $PrevPageNo; ?>&<?= $urldata; ?>" class="button
light_blue_btn"><span><span>PREVIOUS</span></span></a> </li>
<?php } ?>

                                                            <?php
                                                                                    $pageFrom = $PageNo - 3 < 1 ? 1 : $PageNo - 3;
                                                                                    $pageTo = $PageNo + 3 > $totalpage ? $totalpage : $PageNo + 3;
                                                                                    for ($i = $pageFrom; $i <= $pageTo; $i++) {
                                                            ?>
                                                            <?php if ($i == $PageNo) { ?>
                                                                                            <li><a href="admincreditreport.php?pgno=<?= $i; ?>&<?= $urldata; ?>" class="current_page"><span><span><?php
echo $i; ?></span></span></a></li>
                                                            <?php } else {
 ?>
                                                                                            <li><a href="admincreditreport.php?pgno=<?= $i; ?>&<?= $urldata; ?>"><?php echo $i; ?></a></li>
                                                            <?php
                                                                                        }
                                                                                    }
                                                            ?>
                                                            <?php
                                                                                    if ($PageNo < $totalpage) {
                                                                                        $NextPageNo = $PageNo + 1;
                                                            ?>
                                                                                        <li><a href="admincreditreport.php?pgno=<?= $NextPageNo; ?>&<?= $urldata; ?>" class="button
light_blue_btn"><span><span>NEXT</span></span></a> </li>
<?php } ?>
                                                                                </ul>

                                                                            </div>
                                                                            <!--[if !IE]>end pagination<![endif]-->
<?php } ?>

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

                        <?php


								}
							}
				
					

    $qrysel = "select user_id,bid_count,bidpack_buy_date,credit_description,username from bid_account b inner join registration r on r.id=b.user_id where bid_flag!='c' and recharge_type!='ad' and credit_description like '%Bid Pack%'
$wherecase";

    $ressel = db_query($qrysel);
    $total3 = db_num_rows($ressel);
    $totalnumrows = $total3;
    $totalpage = ceil($total / $PRODUCTSPERPAGE);
    echo db_error();

    if ($totalpage >= 1) {
        $startrow = $PRODUCTSPERPAGE * ($PageNo - 1);
        $qrysel.=" LIMIT $startrow,$PRODUCTSPERPAGE";
        $ressel = db_query($qrysel);
       // $total3 = db_num_rows($ressel);
    }


                        if (isset($total3)) {
                            if ($total3 <= 0) {
			      ?>
                                <div class="section table_section">
                                    <!--[if !IE]>start title wrapper<![endif]-->
                                    <div class="title_wrapper">
                                        <h2>Purchased Bids Report</h2>
                                        <span class="title_wrapper_left"></span>
                                        <span class="title_wrapper_right"></span>
                                    </div>
                                <ul class="system_messages">
                                    <li class="blue"><span class="ico"></span><strong class="system_title">No Report To Display</strong></li>
				  
                                </ul>
			      </div>
                        <?php } else {
                        ?>
                                <!--[if !IE]>start section<![endif]-->
                                <div class="section table_section">
                                    <!--[if !IE]>start title wrapper<![endif]-->
                                    <div class="title_wrapper">
                                        <h2>Purchased Bids Report</h2>
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
                                                                                        <th style="text-align:center;">Bid Count</th>
                                                                                        <th style="text-align:center;">Date</th>
                                                                                        <th style="text-align:center;">Description</th>
                                                                                    </tr>
                                                                            <?php
                                                                            $colorflg = 0;
                                                                            while ($obj = db_fetch_object($ressel)) {
                                                                                if ($colorflg == 1) {
                                                                                    $colorflg = 0;
                                                                                } else {
                                                                                    $colorflg = 1;
                                                                                }
										
                                                                            ?>
                                                                                <tr class="<?php echo ($colorflg == 0) ? 'first' : 'second'; ?>">
                                                                                    <td style="text-align:center;"><?= $obj->user_id; ?></td>
                                                                                    <td><?= $obj->username; ?></td>
                                                                                    <td style="text-align:center;"><?= $obj->bid_count; ?></td>
                                                                                    <td style="text-align:center;">
                                                                                    <?php echo arrangedate(substr($obj->bidpack_buy_date, 0, 10)) . " " . substr($obj->bidpack_buy_date, 11); ?>
                                                                                </td>
                                                                                <td style="text-align:center;">
                                                                                    <?php echo $obj->credit_description; ?>
                                                                                </td>
                                                                            </tr>
                                                                            <?php
                                                                                }
                                                                            ?>

                                                                            </tbody>
                                                                        </table>
                                                                    </form>

                                                                </div>
                                                            </div>
                                                            <!--[if !IE]>end table_wrapper<![endif]-->
                                                        </div>

                                                    <?php if ($total) {
 ?>
                                                                                    <!--[if !IE]>start pagination<![endif]-->
                                                                                    <div class="pagination">
                                                                                        <span class="page_no">Page <?php echo $PageNo; ?> of <?php echo $totalpage; ?></span>
                                                                                        <ul class="pag_list">
                                                            <?php
                                                                                    if ($PageNo > 1) {
                                                                                        $PrevPageNo = $PageNo - 1;
                                                            ?>
                                                                                        <li><a href="admincreditreport.php?pgno=<?= $PrevPageNo; ?>&<?= $urldata; ?>" class="button
light_blue_btn"><span><span>PREVIOUS</span></span></a> </li>
<?php } ?>

                                                            <?php
                                                                                    $pageFrom = $PageNo - 3 < 1 ? 1 : $PageNo - 3;
                                                                                    $pageTo = $PageNo + 3 > $totalpage ? $totalpage : $PageNo + 3;
                                                                                    for ($i = $pageFrom; $i <= $pageTo; $i++) {
                                                            ?>
                                                            <?php if ($i == $PageNo) { ?>
                                                                                            <li><a href="admincreditreport.php?pgno=<?= $i; ?>&<?= $urldata; ?>" class="current_page"><span><span><?php
echo $i; ?></span></span></a></li>
                                                            <?php } else {
 ?>
                                                                                            <li><a href="admincreditreport.php?pgno=<?= $i; ?>&<?= $urldata; ?>"><?php echo $i; ?></a></li>
                                                            <?php
                                                                                        }
                                                                                    }
                                                            ?>
                                                            <?php
                                                                                    if ($PageNo < $totalpage) {
                                                                                        $NextPageNo = $PageNo + 1;
                                                            ?>
                                                                                        <li><a href="admincreditreport.php?pgno=<?= $NextPageNo; ?>&<?= $urldata; ?>" class="button
light_blue_btn"><span><span>NEXT</span></span></a> </li>
<?php } ?>
                                                                                </ul>

                                                                            </div>
                                                                            <!--[if !IE]>end pagination<![endif]-->
<?php } ?>

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

                        <?php


								}
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