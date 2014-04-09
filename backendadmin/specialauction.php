<?php 
session_start();
$active="Auctions";
require_once("connect.php");
require_once("admin.config.inc.php");
include_once("security.php");
include_once("config_setting.php");

$PRODUCTSPERPAGE = 15;
if(!$_GET['order']){
    $order = "";
}else{
    $order = $_GET['order'];
}
if(!$_REQUEST['pgno']) {
    $PageNo = 1;
} else {
    $PageNo = $_REQUEST['pgno'];
}
/********************************************************************
     Get how many products  are to be displayed according to the  Events
********************************************************************/
$StartRow = $PRODUCTSPERPAGE * ($PageNo-1);

$query = "SELECT a.*,b.bidpack_name,b.bidpack_price,p.name,p.price,r.username
          FROM auction a
          LEFT JOIN products p ON a.productID = p.productID AND a.bidpack = 0
          LEFT JOIN registration r ON r.id = a.buy_user
          LEFT JOIN bidpack b ON b.id = a.productID AND a.bidpack = 1 
          WHERE a.specialauction ='1' ";


if(!empty($order))
{
    $query .= " AND p.name RLIKE '^$order' ";
}

$ast = $_REQUEST["aucstatus"];

if(!empty($ast))
{
    $query .= " AND a.auc_status='".$ast."'";
  
}

$query .= " ORDER BY a.auc_status";

//var_dump($order,$_REQUEST["aucstatus"],$query);

$result = db_query($query) or die (db_error());
$totalrows = db_num_rows($result);
$totalpages = ceil($totalrows/$PRODUCTSPERPAGE);
$query .= " LIMIT $StartRow,$PRODUCTSPERPAGE";
$result = db_query($query);
$total = db_num_rows($result);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="imagetoolbar" content="no" />
        <title>Special Auctions-<?php echo $ADMIN_MAIN_SITE_NAME ?></title>
        <link media="screen" rel="stylesheet" type="text/css" href="css/admin.css"  />
        <!--[if lte IE 6]><link media="screen" rel="stylesheet" type="text/css" href="css/admin-ie.css" /><![endif]-->
        <script type="text/javascript" src="js/behaviour.js"></script>
         <script type="text/javascript">
        function GetXmlHttpObject()
            {
                var xmlHttp=null;
                try
                {
                    // Firefox, Opera 8.0+, Safari
                    xmlHttp=new XMLHttpRequest();
                }
                catch (e)
                {
                    // Internet Explorer
                    try
                    {
                        xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
                    }
                    catch (e)
                    {
                        xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
                    }
                }
                return xmlHttp;

            }
            function QuicklyEndAuction(aid)
            {
                xmlHttp=GetXmlHttpObject();
                if (xmlHttp==null)
                {
                    alert ("Your browser does not support AJAX!");
                    return;
                }
                var url="endauction.php";
                url=url+"?aid="+aid
                xmlHttp.onreadystatechange=changestatus;
                xmlHttp.open("GET",url,true);
                xmlHttp.send(null);
            }
            function changestatus()
            {
                if (xmlHttp.readyState==4)
                {
                    var temp=xmlHttp.responseText
                    data = temp.split("|");
                    if(data[0]=="Success")
                    {
                        document.getElementById('auction_status_' + data[1]).style.color = "blue";
                        document.getElementById('auction_status_' + data[1]).innerHTML = "Sold";
                        document.getElementById('endearly_' + data[1]).disabled = true;
                    }
                }
            }
        </script>
        <script type="text/javascript">
            function SubmitForm()
            {
                document.f3.submit();
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
                                <h2>Special Auctions</h2>
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
                                                        <span style="float:left;margin-right:40px;">
                                                            <form name="form1" id="form1" action="s" method="post">
                                                                <span><a href="specialauction.php?aucstatus=<?=$ast;?>">All</a></span>
                                                        <?php  foreach (range('A','Z',1) as $alpha) {
                                                          echo "<span class='sp'>|</span>
                                                                <span><a href='specialauction.php?order=$alpha&aucstatus=$ast'>$alpha</a></span>";
                                                        }//end of foreach ?>
                                                            </form>
                                                        </span>
                                                        <span>
                                                            <form name="f3" id="f3" action="" method="post">
                                                                <strong>Auction Status:</strong>
                                                                <select name="aucstatus" onchange="SubmitForm();">
                                                                    <option value="">All</option>
                                                                    <option value="1" <?=$ast=="1"?"selected":"";?>>Future</option>
                                                                    <option value="2" <?=$ast=="2"?"selected":"";?>>Active</option>
                                                                    <option value="3" <?=$ast=="3"?"selected":"";?>>Sold</option>
                                                                    <option value="4" <?=$ast=="4"?"selected":"";?>>Pending</option>
                                                                </select>
                                                                <input type="hidden" name="pgno" value="1" />
                                                            </form>
                                                        </span>
                                                    </div>
                                                    <div  id="product_list">
                                                        <!--[if !IE]>start table_wrapper<![endif]-->
                                                        <div class="table_wrapper">
                                                            <div class="table_wrapper_inner">
                                                                <?php if($total<=0) { ?>
                                                                <ul class="system_messages">
                                                                    <li class="blue"><span class="ico"></span><strong class="system_title">No product To Display</strong></li>
                                                                </ul>
                                                                    <?php }else {?>
                                                                <table cellpadding="0" cellspacing="0" width="100%">
                                                                    <thead>
                                                                        <tr>
                                                                            <th style="width:4%;text-align:center">#</th>
                                                                            <th style="width:4%;text-align:center">ID</th>
                                                                            <th style="width:30%;text-align:center">Product Name</th>
                                                                            <th style="width:8%;text-align:center">Status</th>
                                                                            <th style="width:20%;text-align:center">Auction Type</th>
                                                                            <th style="width:20%;text-align:center">Auction Category</th>
                                                                            <th style="width:15%;text-align:center">Actions</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                <?php
                                                                    for($i=0;$i<$total;$i++) {
                                                                        if($PageNo>1) {
                                                                            $srno = ($PageNo-1)*$PRODUCTSPERPAGE+$i+1;
                                                                        }
                                                                        else {
                                                                            $srno = $i+1;
                                                                        }
                                                                        $row = db_fetch_object($result);
                                                                        $id=$row->auctionID;
                                                                        $pname=$row->bidpack?stripslashes($row->bidpack_name): stripslashes($row->name);
                                                                        $fprice=$row->auc_final_price;
                                                                        $status=$row->auc_status;
                                                                        $auctype = $row->auc_type;
                                                                        if($row->fixedpriceauction=="1") {
                                                                            $auctype="Set Price Auction";
                                                                        }
                                                                        if($row->pennyauction=="1") {
                                                                            $auctype="1 Cent Auction";
                                                                        }
                                                                        if($row->nailbiterauction=="1") {
                                                                            $auctype="NailBiter Auction ";
                                                                        }
                                                                        if($row->offauction=="1") {
                                                                            $auctype="Totally Free";
                                                                        }
                                                                        if($row->nightauction=="1") {
                                                                            $auctype="Night Auction";
                                                                        }
                                                                        if($row->openauction=="1") {
                                                                            $auctype="Open Auction";
                                                                        }
                                                                        if($row->reverseauction=='1'){
                                                                            $auctype="Reverse Auction";
                                                                        }
                                                                        if($row->uniqueauction=='1'){
                                                                            $auctype="Unique lowest auction";
                                                                        }
                                                                        if($row->halfbackauction=='1'){
                                                                            $auctype="Half Back Bid Auction";
                                                                        }
                                                                        if($row->seatauction=='1'){
                                                                            $auctype="Seat Auction";
                                                                        }                                                                                
                                                                        if($row->time_duration=="20sa") {
                                                                            $auctype="20-Second Auction";
                                                                        }
                                                                        if($row->time_duration=="15sa") {
                                                                            $auctype="15-Second Auction";
                                                                        }
                                                                        if($row->time_duration=="10sa") {
                                                                            $auctype="10-Second Auction";
                                                                        }
                                                                        $winner = $row->username;

                                                                        ?>
                                                                        <tr class="<?php echo ($i % 2!=0)?'first':'second'; ?>">
                                                                            <td style="text-align:center;"><?=$srno?></td>
                                                                            <td style="text-align:center;"><?=$id?></td>
                                                                            <td style="text-align:left;"><?=$pname?></td>
                                                                            <!-- <td style="text-align:left;"><?php echo ($fprice == "")? "&nbsp" : $Currency.$fprice;?></td> -->
                                                                            <td style="text-align:center;">
                                                                            <?
                                                                            if($status==1) {
                                                                                echo "<span style='color: green' id='auction_status_".$id."'>Future</span>";
                                                                            }
                                                                            if($status==2) {
                                                                                echo "<span style='color: red' id='auction_status_".$id."'>Active</span>";
                                                                            }
                                                                            if($status==3) {
                                                                                echo "<span style='color: blue' id='auction_status_".$id."'>Sold</span>";
                                                                            }
                                                                            if($status==4) {
                                                                                echo "<span style='color: green' id='auction_status_".$id."'>Pending</span>";
                                                                            }
                                                                            ?>
                                                                            </td>
                                                                            <td style="text-align:center;"><?=$auctype;?></td>
                                                                            <td style="text-align:center;">
                                                                                <?php if($row->uniqueauction==true){ ?>
                                                                                <span style="color:green">Lowest Unique</span>
                                                                                <?php } elseif($row->reverseauction) { ?>
                                                                                <div style="color:red">Reverse Auction</div>
                                                                                <?php } elseif($row->specialauction) { ?>
                                                                                <div style="color:#651BDE">Special Auction</div>
                                                                                <div> (Special Price:<?php echo $Currency.$row->special_price;?>)</div>                                                                             
                                                                                <?php } else { ?>
                                                                                <div style="color:green">Normal Auction</div>                                                                             
                                                                                <div style="">(Start Price:<?php echo $row->auc_start_price; ?>)</div>
                                                                                <?php } ?>
                                                                            </td>
                                                                          <!--   <td style="text-align:center;">
                                                                                <?php if($row->allowbuynow) { ?>
                                                                                <div style="color:red">Yes</div>
                                                                                <div>(Price:<?php echo (!empty($row->allowbuynow))? $Currency.$row->buynowprice :""; ?>)</div>
                                                                                <?php }else { ?>
                                                                                <span style="color:green">No</span>
                                                                                <?php }?>                                                                                
                                                                            </td> -->
                                                                            <!-- <td  style="text-align:center;"><?=$winner==""?"&nbsp":$winner;?></td> -->
                                                                            <td  style="text-align:center;">                                                                          
                                                                                    <ul style="list-style-type: none;display: inline;margin:3px" >
                                                                                        <li>
                                                                                            <a class="edit" href="addauction.php?auction_edit=<?=$id;?>" style="padding-left:16px">Edit</a>
                                                                                        </li>
                                                                                        <?php if($status=='1' || $status=='4'){ ?>
                                                                                        <li>
                                                                                            <a class="delete" name="button" href="addauction.php?auction_delete=<?=$id;?>" style="padding-left:16px">Delete</a>
                                                                                        </li>
                                                                                        <?php }?>                                                                                        
                                                                                        <li>
                                                                                        <?php if($status==3) { ?>
                                                                                            <a name="button" class="edit" href="addauction.php?auction_clone=<?=$id;?>" style="padding-left:16px">Clone</a>
                                                                                        <?php } ?>
                                                                                        </li>
                                                                                    </ul>
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
                                                    <?php if($PageNo>1) {
                                                           $PrevPageNo = $PageNo-1;
                                                    ?>
                                                            <li><a href="manageauction.php?order=<?php echo $order ?>&pgno=<?php echo $PrevPageNo; ?>&aucstatus=<?=$ast;?>" class="button light_blue_btn"><span><span>PREVIOUS</span></span></a> </li>
                                                    <?php } 
                                                            $pageFrom=$PageNo-3<1?1:$PageNo-3;
                                                            $pageTo=$PageNo+3>$totalpages?$totalpages:$PageNo+3;
                                                            for($i=$pageFrom;$i<=$pageTo;$i++) { 
                                                            if($i==$PageNo) { ?>
                                                            <li><a href="specialauction.php?order=<?php echo $order ?>&pgno=<?php echo $i;?>&aucstatus=<?=$ast;?>" class="current_page"><span><span><?php echo $i; ?></span></span></a></li>
                                                    <?php }else {?>
                                                            <li><a href="specialauction.php?order=<?php echo $order ?>&pgno=<?php echo $i;?>&aucstatus=<?=$ast;?>"><?php echo $i; ?></a></li>
                                                    <?php }
                                                            }// end of for 
                                                    if($PageNo<$totalpages) {
                                                            $NextPageNo =   $PageNo + 1;
                                                    ?>
                                                            <li><a href="specialauction.php?order=<?php echo $order ?>&pgno=<?php echo $NextPageNo;?>&aucstatus=<?=$ast;?>" class="button light_blue_btn"><span><span>NEXT</span></span></a> </li>
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
                <?php include_once 'include/footer.php'; ?>
            </div>
        </div>
        <!--[if !IE]>end footer<![endif]-->

    </body>
</html>