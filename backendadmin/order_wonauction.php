<?php
session_start();
$active = "Report";
include("connect.php");
include("security.php");
include_once("admin.config.inc.php");
include("functions.php");
include_once('../common/sitesetting.php');
include_once('class/OrderReport.php');

if ($_POST["submit"] != "" || $_GET["sdate"] != "") {
    if (!$_GET['pgno']) {
        $PageNo = 1;
    } else {
        $PageNo = $_GET['pgno'];
    }

    if ($_POST["submit"] != "") {
        $startdate = ChangeDateFormat($_POST["datefrom"]);
        $enddate = ChangeDateFormat($_POST["dateto"]);
    } else {
        $startdate = ChangeDateFormat($_GET["sdate"]);
        $enddate = ChangeDateFormat($_GET["edate"]);
    }

    $paymentstatus = $_POST['paymentstatus'];

    $urldata = "sdate=" . ChangeDateFormatSlash($startdate) . "&edate=" . ChangeDateFormatSlash($enddate) . "&paymentstatus=$paymentstatus";


    if ($startdate == $enddate) {
        $enddate.=' 23:59:59';
    }
    $order = new OrderReport(null, Sitesetting::isEnableTax());
    $result = $order->getWonAuctionReport($startdate, $enddate, $paymentstatus);
   
    $total = count($result->datas);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="imagetoolbar" content="no" />
        <title>Won Auction Order Report-<?php echo $ADMIN_MAIN_SITE_NAME ?></title>
        <link media="screen" rel="stylesheet" type="text/css" href="css/admin.css"  />
        <link type="text/css" href="css/cupertino/ui.all.css" rel="stylesheet" />
        <!--[if lte IE 6]><link media="screen" rel="stylesheet" type="text/css" href="css/admin-ie.css" /><![endif]-->
        <script type="text/javascript" src="js/behaviour.js"></script>
        <script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
        <script type="text/javascript" src="js/ui/ui.core.min.js"></script>
        <script type="text/javascript" src="js/ui/ui.datepicker.min.js"></script>
        <script type="text/javascript">
            function Check()
            {
                if($('#datefrom').val()=='')
                {
                    alert("Please select start date!!!");
                    $('#datefrom').focus();
                    return false;
                }
                if($('#dateto').val()=='')
                {
                    alert("Please select end date!!!");
                    $('#dateto').focus();
                    return false;
                }
            }
        </script>
        <script type="text/javascript">
            $(function() {
                $('#reportform').submit(function(){
                    return Check();
                });

                $('#print-button').click(function(){
                    window.open("order_report_print.php?<?php echo $urldata ?>&for=wonauction", "print_windows", "location=no,status=yes");

                });

                $('#export-button').click(function(){
                    window.open("order_report_print.php?<?php echo $urldata ?>&for=wonauction&action=export", "export_to_excel", "width=400,height=300,location=no,status=yes");
                });

	  
                $('#btn_viewtodayorder').click(function(){
                    var today=new Date(<?php echo date("Y") ?>,<?php echo date('m')-1 ?>,<?php echo date('d') ?>);
                    var month=today.getMonth()+1;
                    var year=today.getYear()+1900;
                    var day=today.getDate();
                    var strmonth=month>9?month:'0'+month;
                    var strtoday=(day>9?day:('0'+day))+"/"+strmonth+"/"+year;
                    $('#datefrom').val(strtoday);
                    $("#dateto").val(strtoday);
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
                                <h2>Won Auction Order Report</h2>
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
                                                    <form name="f1" id="reportform" action="" method="post" class="search_form general_form">
                                                        <!--[if !IE]>start fieldset<![endif]-->
                                                        <fieldset>
                                                            <!--[if !IE]>start forms<![endif]-->
                                                            <div class="forms">
                                                              <?php include("datepickers.php"); ?>

                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Payment Status:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper blank">
                                                                            <select name="paymentstatus" class="solidinput" style="width: auto;">
                                                                                <option value="0" <?php echo $paymentstatus == 0 ? 'selected' : '' ?>>ALL</option>
                                                                                <option value="1" <?php echo $paymentstatus == 1 ? 'selected' : '' ?>>PAID</option>
                                                                                <option value="2" <?php echo $paymentstatus == 2 ? 'selected' : '' ?> >UNPAID</option>
                                                                            </select>
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

                        <?php if (isset($total)) {
                        ?>
                            <!--[if !IE]>start section<![endif]-->
                            <div class="section table_section">
                                <!--[if !IE]>start title wrapper<![endif]-->

                                <div class="title_wrapper">
                                    <h2>
                                        Won Auction Report
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
                                                        <div  id="product_list">
                                                            <!--[if !IE]>start table_wrapper<![endif]-->
                                                            <div class="table_wrapper">
                                                                <div class="table_wrapper_inner">
                                                                <?php if ($total == 0) {
                                                                ?>
                                                                    <ul class="system_messages">
                                                                        <li class="blue"><span class="ico"></span><strong class="system_title">No Report To Display..</strong></li>
                                                                    </ul>
                                                                <?php } else {
                                                                ?>
                                                                    <table cellpadding="0" cellspacing="0" width="100%" style="line-height:13px;">
                                                                        <tbody>
                                                                            <tr>
                                                                            <?php foreach ($result->keys as $key => $keyname) {
									    ?>

                                                                                <th><?php echo $keyname; ?></th>
									      <?php } ?>
                                                                        </tr>
                                                                        <?php
                                                                            $i = 1;
                                                                            $keys = array_keys($result->keys);
                                                                            foreach ($result->datas as $data) {
                                                                        ?>
                                                                                <tr class="<?php echo ($i % 2 != 0) ? 'first' : 'second'; ?>">
									    <?php foreach ($keys as $key) { ?>
                                                                                    <td><?php echo $data[$key]; ?></td>
									    <?php } ?>
                                                                            </tr>
									    <?php } ?>
                                                                        </tbody>
                                                                    </table>
								    <?php } ?>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end table_wrapper<![endif]-->
                                                            </div>

							    <?php if ($total) { ?>
                                                                            <!--[if !IE]>start pagination<![endif]-->
                                                                            <div class="pagination">
                        <!--                                                        <span class="page_no">Page <?php echo $PageNo; ?> of <?php echo $totalpage; ?></span>
                                                                                            <ul class="pag_list">
                                                        <?php
                                                                            if ($PageNo > 1) {
                                                                                $PrevPageNo = $PageNo - 1;
                                                        ?>
                                                                                                <li><a href="affiliatereport.php?pgno=<?= $PrevPageNo; ?>&<?= $urldata; ?>" class="button light_blue_btn"><span><span>PREVIOUS</span></span></a> </li>
							<?php } ?>

                                                        <?php
                                                                            $pageFrom = $PageNo - 3 < 1 ? 1 : $PageNo - 3;
                                                                            $pageTo = $PageNo + 3 > $totalpage ? $totalpage : $PageNo + 3;
                                                                            for ($i = $pageFrom; $i <= $pageTo; $i++) {
                                                        ?>
							<?php if ($i == $PageNo) { ?>
                                                                                                                    <li><a href="affiliatereport.php?pgno=<?= $i; ?>&<?= $urldata; ?>" class="current_page"><span><span><?php echo $i; ?></span></span></a></li>
                                                        <?php } else { ?>
                                                                                                                    <li><a href="affiliatereport.php?pgno=<?= $i; ?>&<?= $urldata; ?>"><?php echo $i; ?></a></li>
                                                        <?php
                                                                                }
                                                                            }
                                                        ?>
                                                        <?php
                                                                            if ($PageNo < $totalpage) {
                                                                                $NextPageNo = $PageNo + 1;
                                                        ?>
                                                                                                <li><a href="affiliatereport.php?pgno=<?= $NextPageNo; ?>&<?= $urldata; ?>" class="button light_blue_btn"><span><span>NEXT</span></span></a> </li>
                                                        <?php } ?>
                                                                        </ul>-->
                                                                            <ul class="pag_list">
                                                                                <li>
                                                                                    <span class="button send_form_btn"><span><span>Print Result</span></span><input name="submit" id="print-button" type="button"/></span>
                                                                                </li>
                                                                                <li>
                                                                                    <span class="button send_form_btn"><span><span>Export To Excel</span></span><input name="submit" id="export-button" type="button"/></span>
                                                                                </li>
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

                        <?php } ?>

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