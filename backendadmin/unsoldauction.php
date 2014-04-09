<?php
session_start();
$active="Auctions";
include("connect.php");
include_once("admin.config.inc.php");
include("security.php");
include("config_setting.php");

$PRODUCTSPERPAGE = 15; 
if(!$_GET['order'])
    $order = "";
else
    $order = $_GET['order'];
if($_REQUEST['aucstatus']) {
    $aucstatus = $_REQUEST['aucstatus'];
}
if(!$_GET['pgno']) {
    $PageNo = 1;
}
else {
    $PageNo = $_GET['pgno'];
}
/********************************************************************
     Get how many products  are to be displayed according to the  Events
********************************************************************/
$StartRow =   $PRODUCTSPERPAGE * ($PageNo-1);
/***********************************************/
$query = "select a.auctionID,a.productID as productID,a.categoryID as categoryID,auc_start_price,auc_final_price,auc_start_date,auc_end_date,auc_start_time,auc_end_time,auc_status,auc_type,auc_recurr,buy_user,username,
        auc_fixed_price,fixedpriceauction,pennyauction,nailbiterauction,offauction,nightauction,openauction,time_duration,auc_final_end_date,total_time,pause_status,shipping_id,future_tstamp,recurr_count,auction_min_price,min_win_price,
        use_free,allowbuynow,buynowprice,reverseauction,uniqueauction,halfbackauction,bidpack,tax1,tax2,bidpack_name,bidpack_banner,bidpack_price,price,bid_size,freebids ,p.name,p.picture1,short_desc,w.id as wid,accept_denied,accept_date,payment_date,order_status,date_format(w.won_date,'%m/%d/%Y') as wondate
from won_auctions w left join auction a on w.auction_id=a.auctionID left join products p on a.productID=p.productID and a.bidpack=0 left join bidpack b on b.id=a.productID and a.bidpack=1 left join registration r on r.id=w.userid where a.auc_status='3' and a.buy_user='0' and (p.name like '$order%' or b.bidpack_name like '$order%')";

if(!empty($_REQUEST['datefrom'])){
$query .= " and a.auc_start_date >= '". $_REQUEST['datefrom'] . "' ";

}
if(!empty($_REQUEST['dateto'])){
$query .= " and a.auc_end_date <= '". $_REQUEST['dateto'] . "' ";
}

$query .= " order by w.won_date desc";
$result=db_query($query) or die (db_error());
$totalrows=db_num_rows($result);
$totalpages=ceil($totalrows/$PRODUCTSPERPAGE);
$query .= " LIMIT $StartRow,$PRODUCTSPERPAGE";
$result =db_query($query);
$total = db_num_rows($result);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="imagetoolbar" content="no" />
        <title>Manage Unsold Auction-<?php echo $ADMIN_MAIN_SITE_NAME ?></title>
        <link media="screen" rel="stylesheet" type="text/css" href="css/admin.css"  />
        <!--[if lte IE 6]><link media="screen" rel="stylesheet" type="text/css" href="css/admin-ie.css" /><![endif]-->
        <link type="text/css" href="css/cupertino/ui.all.css" rel="stylesheet" />
        <link type="text/css" href="css/cupertino/jquery-ui-1.7.3.custom.css" rel="stylesheet" />

        <!--[if lte IE 6]><link media="screen" rel="stylesheet" type="text/css" href="css/admin-ie.css" /><![endif]-->
        <script type="text/javascript" src="js/behaviour.js"></script>
        <script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
        <script type="text/javascript" src="js/ui/jquery-ui-1.7.2.custom.min.js"></script>
        <script type="text/javascript">
            function Submitform()
            {
                document.form3.submit();
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
                        <div class="section table_section">
                            <!--[if !IE]>start title wrapper<![endif]-->
                            <div class="title_wrapper">
                                <h2>Manage Unsold Auction</h2>
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
                                                    <h2>This page shows auctions that had no winner, no bidders and no ending result other than it finished some time in the past</h2>
                                                        <form id="form1" name="form1" action="unsoldauction.php" method="post">
                                                        <div class="forms">
                                                                <div class="row">
                                                                    <span style="float:left;margin-right:40px;">

                                                                        <span><a href="soldauction.php?<?php echo $orderurldata; ?>">All</a></span><span class="sp">|</span>
                                                                        <span><a href="soldauction.php?order=A&<?php echo $orderurldata; ?>">A</a></span><span class="sp">|</span>
                                                                        <span><a href="soldauction.php?order=B&<?php echo $orderurldata; ?>">B</a></span><span class="sp">|</span>
                                                                        <span><a href="soldauction.php?order=C&<?php echo $orderurldata; ?>">C</a></span><span class="sp">|</span>
                                                                        <span><a href="soldauction.php?order=D&<?php echo $orderurldata; ?>">D</a></span><span class="sp">|</span>
                                                                        <span><a href="soldauction.php?order=E&<?php echo $orderurldata; ?>">E</a></span><span class="sp">|</span>
                                                                        <span><a href="soldauction.php?order=F&<?php echo $orderurldata; ?>">F</a></span><span class="sp">|</span>
                                                                        <span><a href="soldauction.php?order=G&<?php echo $orderurldata; ?>">G</a></span><span class="sp">|</span>
                                                                        <span><a href="soldauction.php?order=H&<?php echo $orderurldata; ?>">H</a></span><span class="sp">|</span>
                                                                        <span><a href="soldauction.php?order=I&<?php echo $orderurldata; ?>">I</a></span><span class="sp">|</span>
                                                                        <span><a href="soldauction.php?order=J&<?php echo $orderurldata; ?>">J</a></span><span class="sp">|</span>
                                                                        <span><a href="soldauction.php?order=K&<?php echo $orderurldata; ?>">K</a></span><span class="sp">|</span>
                                                                        <span><a href="soldauction.php?order=L&<?php echo $orderurldata; ?>">L</a></span><span class="sp">|</span>
                                                                        <span><a href="soldauction.php?order=M&<?php echo $orderurldata; ?>">M</a></span><span class="sp">|</span>
                                                                        <span><a href="soldauction.php?order=N&<?php echo $orderurldata; ?>">N</a></span><span class="sp">|</span>
                                                                        <span><a href="soldauction.php?order=O&<?php echo $orderurldata; ?>">O</a></span><span class="sp">|</span>
                                                                        <span><a href="soldauction.php?order=P&<?php echo $orderurldata; ?>">P</a></span><span class="sp">|</span>
                                                                        <span><a href="soldauction.php?order=Q&<?php echo $orderurldata; ?>">Q</a></span><span class="sp">|</span>
                                                                        <span><a href="soldauction.php?order=R&<?php echo $orderurldata; ?>">R</a></span><span class="sp">|</span>
                                                                        <span><a href="soldauction.php?order=S&<?php echo $orderurldata; ?>">S</a></span><span class="sp">|</span>
                                                                        <span><a href="soldauction.php?order=T&<?php echo $orderurldata; ?>">T</a></span><span class="sp">|</span>
                                                                        <span><a href="soldauction.php?order=U&<?php echo $orderurldata; ?>">U</a></span><span class="sp">|</span>
                                                                        <span><a href="soldauction.php?order=V&<?php echo $orderurldata; ?>">V</a></span><span class="sp">|</span>
                                                                        <span><a href="soldauction.php?order=W&<?php echo $orderurldata; ?>">W</a></span><span class="sp">|</span>
                                                                        <span><a href="soldauction.php?order=X&<?php echo $orderurldata; ?>">X</a></span><span class="sp">|</span>
                                                                        <span><a href="soldauction.php?order=Y&<?php echo $orderurldata; ?>">Y</a></span><span class="sp">|</span>
                                                                        <span><a href="soldauction.php?order=Z&<?php echo $orderurldata; ?>">Z</a></span>

                                                                    </span>
                                                               </div>
                                                                <div class="clear"></div>
                                                               <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                   
                                                                       <?php include("datepickers.php"); ?>
                                                                       
                                                                   
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->
 <div class="clear"></div>
            
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
                                                            <div class="clear"></div>


                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div class="clear"></div>
                                                    <div  id="product_list">
                                                        <!--[if !IE]>start table_wrapper<![endif]-->
                                                        <div class="table_wrapper">
                                                            <div class="table_wrapper_inner">
                                                                <?php if($total<=0) { ?>
                                                                <ul class="system_messages">
                                                                    <li class="blue"><span class="ico"></span><strong class="system_title">No unsold Auction To Display</strong></li>
                                                                </ul>
                                                                    <?php }else {?>
                                                                <table cellpadding="0" cellspacing="0" width="100%">
                                                                    <tbody>
                                                                        <tr>
                                                                            <th style="width:20px;text-align: center;">No</th>
                                                                            <th style="text-align:center;">AuctionID</th>
                                                                            <th>Auction Name</th>
                                                                            <th style="text-align:center;">Price</th>
                                                                            <th style="text-align:center;">Status</th>
                                                                            <th style="text-align:center;">Due</th>
                                                                            <th style="text-align:center;width:80px;">Option</th>
                                                                        </tr>
                                                                            <?
                                                                            for($i=0;$i<$total;$i++) {
                                                                                if($PageNo>1) {
                                                                                    $srno = ($PageNo-1)*$PRODUCTSPERPAGE+$i+1;
                                                                                }
                                                                                else {
                                                                                    $srno = $i+1;
                                                                                }

                                                                                $row = db_fetch_object($result);
                                                                                $id=$row->auctionID;
                                                                                $pname=$row->bidpack?$row->bidpack_name: stripslashes($row->name);
                                                                                $fprice=$row->auc_final_price;
                                                                                $status=$row->accept_denied;
                                                                                $paymentdate = $row->payment_date;
                                                                                $won_date = $row->wondate;
                                                                                $accept_date = $row->accept_date;
                                                                                $winner = $row->username;
                                                                                $userid = $row->userid;
                                                                                ?>
                                                                        <tr class="<?php echo ($i % 2!=0)?'first':'second'; ?>">
                                                                            <td style="text-align:center;"><?=$srno?></td>
                                                                            <td style="text-align:center;"><?=$id?></td>
                                                                            <td><?=$pname?></td>
                                                                            <td style="text-align:right;"><?=$fprice==""?"&nbsp":$Currency.$fprice;?></td>
                                                                            <td style="text-align:center;">
                                                                                <?php echo "<font color=blue>Unsold</font>"; ?>
                                                                            </td>

                                                                            <td style="text-align:center;">
                                                                                        <?php echo $won_date=="0000-00-00 00:00:00"?"&nbsp;":$won_date;?>
                                                                            </td>
                                                                            <td style="text-align:center;">
                                                                                <div class="actions_menu">
                                                                                    <ul>
                                                                                        <li>                                                                                           
                                                                                            <a name="resetauction" class="edit" href="addauction.php?auction_edit=<?=$id?>&und=<?=$id?>">Restart</a>
                                                                                        </li>
                                                                                    </ul>
                                                                                </div>
                                                                            </td>

                                                                        </tr>
                                                                                <?php }
                                                                            ?>
                                                                    </tbody>
                                                                </table>
                                                                    <?php }?>
                                                            </div>
                                                        </div>
                                                        <!--[if !IE]>end table_wrapper<![endif]-->
                                                    </div>

                                                    <?php if($total) { ?>
                                                    <!--[if !IE]>start pagination<![endif]-->
                                                    <div class="pagination">
                                                        <span class="page_no">Page <?php echo $PageNo; ?> of <?php echo $totalpages; ?></span>
                                                        <ul class="pag_list">
                                                                <?php
                                                                if($PageNo>1) {
                                                                    $PrevPageNo = $PageNo-1;
                                                                    ?>
                                                            <li><a href="unsoldauction.php?order=<?php echo $iid ?>&pgno=<?php echo $PrevPageNo; ?>" class="button light_blue_btn"><span><span>PREVIOUS</span></span></a> </li>
                                                                    <?php } ?>

                                                                <?php
                                                                $pageFrom=$PageNo-3<1?1:$PageNo-3;
                                                                $pageTo=$PageNo+3>$totalpages?$totalpages:$PageNo+3;
                                                                for($i=$pageFrom;$i<=$pageTo;$i++) {
                                                                    ?>
                                                                    <?php if($i==$PageNo) { ?>
                                                            <li><a href="unsoldauction.php?order=<?php echo $iid ?>&pgno=<?php echo $i;?>" class="current_page"><span><span><?php echo $i; ?></span></span></a></li>
                                                                        <?php }else {?>
                                                            <li><a href="unsoldauction.php?order=<?php echo $iid ?>&pgno=<?php echo $i;?>"><?php echo $i; ?></a></li>
                                                                        <?php }
                                                                }
                                                                ?>
                                                                <?php
                                                                if($PageNo<$totalpages) {
                                                                    $NextPageNo = 	$PageNo + 1;
                                                                    ?>
                                                            <li><a href="unsoldauction.php?order=<?php echo $iid ?>&pgno=<?php echo $NextPageNo;?>" class="button light_blue_btn"><span><span>NEXT</span></span></a> </li>
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