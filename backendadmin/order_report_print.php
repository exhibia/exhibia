<?
session_start();
$active = "Report";
include("connect.php");
include("security.php");
include_once("admin.config.inc.php");
include("functions.php");
include_once('../common/sitesetting.php');
include_once('class/OrderReport.php');
include_once('include/function_new.php');

$startdate = ChangeDateFormat($_REQUEST['sdate']);
$enddate = ChangeDateFormat($_REQUEST['edate']);
$paymentstatus = $_REQUEST['paymentstatus'];
$for = $_REQUEST['for'];

if ($startdate == $enddate) {
    $enddate.=' 23:59:59';
}
$order = new OrderReport(null, Sitesetting::isEnableTax());
if ($for == 'wonauction') {
    $result = $order->getWonAuctionReport($startdate, $enddate, $paymentstatus);
    $filename = "WonAuction_Order_Report_$startdate" . '_' . "$enddate)";
    $title = "Won Auction Order Report (from $startdate to $enddate)";
} else if ($for == 'buyitnow') {
    $result = $order->getBuyItNowReport($startdate, $enddate);
    $filename = "BuyitNow_Order_Report_$startdate" . '_' . "$enddate)";
    $title = "Buy It Now Order Report (from $startdate to $enddate)";
} else {
    exit;
}

$total = count($result->datas);


if ($_REQUEST['action'] == 'export') {
    $sheetTitle = "$startdate to ".date('Y-m-d',$enddate);
    exportExcel($filename, $sheetTitle, $result);
    exit;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="imagetoolbar" content="no" />
        <title><?php echo $title ?>-<?php echo $ADMIN_MAIN_SITE_NAME ?></title>
        <script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
        <link media="screen" rel="stylesheet" type="text/css" href="css/printtable.css"  />
        <script type="text/javascript">
            $(function() {
                window.print();
            });
        </script>
    </head>

    <body>

        <table cellpadding="0" cellspacing="0" width="100%" class="printtable">
            <caption style="padding:20px 0px;font-weight:bold;">
                <?php echo $title ?>
            </caption>
            <thead>
                <tr>
                    <?php foreach ($result->keys as $key => $keyname) {
                    ?>

                        <th><?php echo $keyname; ?></th>
                    <?php } ?>
                </tr>
            </thead>
            <tbody>

                <?php
                    $i = 1;
                    $keys = array_keys($result->keys);
                    foreach ($result->datas as $data) {
                ?>
                        <tr class="<?php echo ($i % 2 != 0) ? 'first' : 'second'; ?>">
                    <?php foreach ($keys as $key) {
                    ?>
                            <td><?php echo $data[$key]; ?></td>
                    <?php } ?>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

    </body>
</html>