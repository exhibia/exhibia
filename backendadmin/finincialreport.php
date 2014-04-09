<?php
session_start();
$active="Report";
include_once("admin.config.inc.php");
include("connect.php");
include("functions.php");
include("security.php");
$PRODUCTSPERPAGE = 10;
if($_POST["submit"]!="" || $_GET["sdate"]!="") {
    if(!$_GET['pgno']) {
        $PageNo = 1;
    }
    else {
        if($_POST["submit"]!="") {
            $PageNo = 1;
        }
        else {
            $PageNo = $_GET['pgno'];
        }
    }

    if($_POST["datefrom"]!="") {
        $startdate = ChangeDateFormat($_POST["datefrom"]);
        $enddate = ChangeDateFormat($_POST["dateto"]);
        $product = $_POST["products"];
    }
    else {
        $startdate = ChangeDateFormat($_GET["sdate"]);
        $enddate = ChangeDateFormat($_GET["edate"]);
        $product = $_GET["prod"];
    }

    $urldata = "sdate=".ChangeDateFormatSlash($startdate)."&edate=".ChangeDateFormatSlash($enddate)."&prod=".$product;

    $qrysel = "select * from auction a left join products p on a.productID=p.productID  where a.auc_start_date>='$startdate' and a.auc_end_date<='$enddate' ";

    if($product!="") {
        $qrysel .= " and a.productID='$product' ";
    }
//		$qrysel .= "  group by ba.auction_id ";
    $qrysel2=$qrysel;
    $ressel = db_query($qrysel);
    $total = db_num_rows($ressel);
    $totalpage=ceil($total/$PRODUCTSPERPAGE);
    if($totalpage>=1) {
        $startrow=$PRODUCTSPERPAGE*($PageNo-1);
        $qrysel.=" LIMIT $startrow,$PRODUCTSPERPAGE";
        //echo $sql;
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
        <title>Finincial Report-<?php echo $ADMIN_MAIN_SITE_NAME ?></title>
        <link media="screen" rel="stylesheet" type="text/css" href="css/admin.css"  />
        <link type="text/css" href="css/cupertino/ui.all.css" rel="stylesheet" />
        <!--[if lte IE 6]><link media="screen" rel="stylesheet" type="text/css" href="css/admin-ie.css" /><![endif]-->
        <script type="text/javascript" src="js/behaviour.js"></script>
        <script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
        <script type="text/javascript" src="js/ui/jquery-ui-1.7.2.custom.min.js"></script>
	<script type="text/javascript" src="js/ui/ui.accordion.min.js"></script>
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
            }
            function OpenPopup(url)
            {
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
                                <h2>Finincial Report</h2>
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
                                                    <form name="f1" action="" method="post" onSubmit="return Check(this)" class="search_form general_form">
                                                        <!--[if !IE]>start fieldset<![endif]-->
                                                        <fieldset>
                                                            <!--[if !IE]>start forms<![endif]-->
                                                            <div class="forms">
 
							      <?php include("datepickers.php"); ?>

                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Products:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper blank">
                                                                            <?php
                                                                            $qrr="select * from products order by name";
                                                                            $resp = db_query($qrr) or die(db_error());
                                                                            $totalp = db_num_rows($resp);
                                                                            ?>
                                                                            <select name="products" class="solidinput" style="width: 250px;">
                                                                                <option value="">All Products</option>
                                                                                <?php if($totalp>0) {
                                                                                    while($roww=db_fetch_array($resp)) {
                                                                                        ?>
                                                                                <option <?=$product==$roww["productID"]?"selected":"";?> value="<?=$roww["productID"];?>"><?=$roww["name"];?></option>
                                                                                        <?php
                                                                                    }
                                                                                }
                                                                                ?>
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

                        <?php if(isset($total)) {
                            ?>
                        <!--[if !IE]>start section<![endif]-->
                        <div class="section table_section">
                            <!--[if !IE]>start title wrapper<![endif]-->

                            <div class="title_wrapper">
                                <h2>
                                        <?php
                                        $productname=GetProductName($product);
                                        if($productname!='') {
                                            echo '['.$productname.'] ';
                                        }else {
                                            echo "[Products] ";
                                        }
                                        ?> Auction List

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
                                                                    <?php if($total==0) { ?>
                                                                <ul class="system_messages">
                                                                    <li class="blue"><span class="ico"></span><strong class="system_title">No Auctions To Display.</strong></li>
                                                                </ul>
                                                                        <?php }else {?>
                                                                <table cellpadding="0" cellspacing="0" width="100%">
                                                                    <tbody>
                                                                        <tr>
                                                                            <th style="width:80px;text-align: center;">Auctino ID</th>
                                                                            <th style="text-align:center;">Product Price</th>
                                                                            <th style="text-align:center;">Start Price</th>
                                                                            <th style="text-align:center;">Fixed Price</th>
                                                                            <th style="text-align:center;">End Price</th>
                                                                            <th style="text-align:center;">Total Bids</th>
                                                                            <th style="text-align:center;">Total Bid Value</th>
                                                                            <th style="text-align:center;width:80px;">Status</th>
                                                                            <th style="text-align:center;">Profit/Loss</th>
                                                                            <th style="text-align:center;width:60px;">Option</th>
                                                                        </tr>
                                                                                <?
                                                                                $i=1;
                                                                                while($obj = db_fetch_object($ressel)) {
                                                                                    if($obj->auc_status=="2" || $obj->auc_status=="1") {
                                                                                        $status = "<font color='red'>Active</font>";
                                                                                    }
                                                                                    elseif($obj->auc_status=="4") {
                                                                                        $status = "<font color='green'>Pending</font>";
                                                                                    }
                                                                                    elseif($obj->auc_status=="3") {
                                                                                        $status = "<font color='blue'>Sold</font>";
                                                                                    }

                                                                                    if ($colorflg==1) {
                                                                                        $colorflg=0;
                                                                                        echo "<TR bgcolor=\"#f4f4f4\"> ";
                                                                                    }else {
                                                                                        $colorflg=1;
                                                                                        echo "<TR> ";
                                                                                    }

                                                                                    $numberbids = explode("|",GetBidsDetails($obj->auctionID));

                                                                                    $bidamount = number_format($numberbids[0] * 0.50,2);

                                                                                    $price = $obj->price;
                                                                                    if($obj->fixedpriceauction=="1") {
                                                                                        $fprice = $obj->auc_fixed_price;
                                                                                    }
                                                                                    elseif($obj->offauction=="1") {
                                                                                        $fprice = "0.00";
                                                                                    }
                                                                                    else {
                                                                                        $fprice = $obj->auc_final_price;
                                                                                    }

                                                                                    $prloss = $fprice + $bidamount - $price;
                                                                                    if($prloss<0) {
                                                                                        $prloss1 = "<font color='red'>-".$Currency.number_format(substr($prloss,1),2)."</font>";
                                                                                    }
                                                                                    else {
                                                                                        $prloss1 = "<font color='green'>".$Currency.number_format($prloss,2)."</font>";
                                                                                    }
                                                                                    ?>
                                                                        <tr class="<?php echo ($i==1)?'first':'second'; ?>">
                                                                            <td style="text-align:center;">
                                                                                            <?=$obj->auctionID;?>
                                                                            </td>
                                                                            <td style="text-align:right;"><?=$Currency.$obj->price;?></td>
                                                                            <td style="text-align:right;">
                                                                                            <?=$obj->auc_start_price!=""?$Currency.$obj->auc_start_price:$Currency."0.00";?>
                                                                            </td>
                                                                            <td style="text-align:right;">
                                                                                            <?=$obj->auc_fixed_price!=""?$Currency.$obj->auc_fixed_price:$Currency."0.00";?>
                                                                            </td>
                                                                            <td style="text-align:right;">
                                                                            <?=$obj->auc_final_price!=""?$Currency.$obj->auc_final_price:$Currency."0.00";?>
                                                                            </td>
                                                                            <td style="text-align:center;">
                                                                                           <?=$numberbids[0]!=""?$numberbids[0]:"0"?><?php /*?> + <?=$numberbids[1]!=""?$numberbids[1]:"0";?><?php */?></
                                                                            </td>

                                                                            <td style="text-align:right;"><?=$bidamount!=""?$Currency.$bidamount:$Currency."0.00"?></td>
                                                                            <td style="text-align:center;"><?=$status;?></td>                                                                            
                                                                            <td style="text-align:right;"><?=$prloss1;?></td>

                                                                            <td style="text-align:center;">
                                                                                <div class="actions_menu">
                                                                                    <ul>
                                                                                        <li>
                                                                                            <a class="details" name="details" href="auctiondetails.php?aid=<?=$obj->auctionID;?>">Details</a>
                                                                                        </li>
                                                                                    </ul>
                                                                                </div>
                                                                            </td>

                                                                        </tr>
                                                                                    <?php
                                                                                    $i=$i*-1;
                                                                                }
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
                                                        <span class="page_no">Page <?php echo $PageNo; ?> of <?php echo $totalpage; ?></span>
                                                        <ul class="pag_list">
                                                                    <?php
                                                                    if($PageNo>1) {
                                                                        $PrevPageNo = $PageNo-1;
                                                                        ?>
                                                            <li><a href="finincialreport.php?pgno=<?=$PrevPageNo;?>&<?=$urldata;?>" class="button light_blue_btn"><span><span>PREVIOUS</span></span></a> </li>
                                                                        <?php } ?>

                                                                    <?php
                                                                    $pageFrom=$PageNo-3<1?1:$PageNo-3;
                                                                    $pageTo=$PageNo+3>$totalpage?$totalpage:$PageNo+3;
                                                                    for($i=$pageFrom;$i<=$pageTo;$i++) {
                                                                        ?>
                                                                        <?php if($i==$PageNo) { ?>
                                                            <li><a href="finincialreport.php?pgno=<?=$i;?>&<?=$urldata;?>" class="current_page"><span><span><?php echo $i; ?></span></span></a></li>
                                                                            <?php }else {?>
                                                            <li><a href="finincialreport.php?pgno=<?=$i;?>&<?=$urldata;?>"><?php echo $i; ?></a></li>
                                                                            <?php }
                                                                    }
                                                                    ?>
                                                                    <?php
                                                                    if($PageNo<$totalpage) {
                                                                        $NextPageNo = 	$PageNo + 1;
                                                                        ?>
                                                            <li><a href="finincialreport.php?pgno=<?=$NextPageNo;?>&<?=$urldata;?>" class="button light_blue_btn"><span><span>NEXT</span></span></a> </li>
                                                                        <?php } ?>
                                                        </ul>

                                                    </div>
                                                    <!--[if !IE]>end pagination<![endif]-->
                                                            <?php }?>

                                                    <div class="pagination" style="margin-left:10px; text-align: center;">
                                                            <?
                                                            if($total>0) {
                                                                ?>
                                                        <span class="button send_form_btn"><span><span>Export to CSV</span></span><input type="button" name="submit" onclick="OpenPopup('download.php?export=financial&<?=$urldata;?>')"/></span>
                                                        <br/><br/>
                                                                <?
                                                            }
                                                            ?>
                                                    </div>

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