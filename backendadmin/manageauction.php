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
if(!$_REQUEST['pgno']) {
    $PageNo = 1;
}
else {
    $PageNo = $_REQUEST['pgno'];
}
/********************************************************************
     Get how many products  are to be displayed according to the  Events
********************************************************************/
$StartRow =   $PRODUCTSPERPAGE * ($PageNo-1);
/***********************************************/
if($order!="") {
    $query = "select auctionID,a.productID as productID,a.categoryID as categoryID,auc_start_price,auc_final_price,auc_start_date,auc_end_date,auc_start_time,auc_end_time,auc_status,auc_type,auc_recurr,buy_user,
        auc_fixed_price,fixedpriceauction,pennyauction,nailbiterauction,offauction,nightauction,openauction,time_duration,auc_final_end_date,total_time,pause_status,shipping_id,future_tstamp,recurr_count,auction_min_price,min_win_price,
        use_free,allowbuynow,buynowprice,reverseauction,uniqueauction,halfbackauction,seatauction,bidpack,tax1,tax2,bidpack_name,bidpack_price,p.name,price,username
    from auction a left join products p on a.productID=p.productID and a.bidpack=0 left join registration r on r.id=a.buy_user left join bidpack b on b.id=a.productID and a.bidpack=1 where p.name like '$order%'";
}
else {
    $query = "select auctionID,a.productID as productID,a.categoryID as categoryID,auc_start_price,auc_final_price,auc_start_date,auc_end_date,auc_start_time,auc_end_time,auc_status,auc_type,auc_recurr,buy_user,
        auc_fixed_price,fixedpriceauction,pennyauction,nailbiterauction,offauction,nightauction,openauction,time_duration,auc_final_end_date,total_time,pause_status,shipping_id,future_tstamp,recurr_count,auction_min_price,min_win_price,
        use_free,allowbuynow,buynowprice,reverseauction,uniqueauction,halfbackauction,seatauction,bidpack,tax1,tax2,bidpack_name,bidpack_price,p.name,price,username
        from auction a left join products p on a.productID=p.productID and a.bidpack=0 left join registration r on r.id=a.buy_user left join bidpack b on b.id=a.productID and a.bidpack=1 ";
}


if($_REQUEST["aucstatus"]!="") {
    $ast = $_REQUEST["aucstatus"];
    if($order!="") {
        $query .= " and auc_status='".$_REQUEST["aucstatus"]."'";
    }
    else {
        $query .= " where auc_status='".$_REQUEST["aucstatus"]."'";
    }
}

$query .= " order by a.auc_status";

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
        <title>Manage Auctions-<?php echo $ADMIN_MAIN_SITE_NAME ?></title>
        <link media="screen" rel="stylesheet" type="text/css" href="css/admin.css"  />
        <!--[if lte IE 6]><link media="screen" rel="stylesheet" type="text/css" href="css/admin-ie.css" /><![endif]-->
        <link type="text/css" href="css/cupertino/ui.all.css" rel="stylesheet" />
        <link type="text/css" href="css/cupertino/jquery-ui-1.7.3.custom.css" rel="stylesheet" />

        <!--[if lte IE 6]><link media="screen" rel="stylesheet" type="text/css" href="css/admin-ie.css" /><![endif]-->
        <script type="text/javascript" src="js/behaviour.js"></script>
        <script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
        <script type="text/javascript" src="js/ui/jquery-ui-1.7.2.custom.min.js"></script>
        <script type="text/javascript">
	  
	    function delconfirm(loc)
            {
                if(confirm("Are you sure do you want to delete this?"))
                {
                    window.location.href=loc;
                }
                return false;
            }
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
                                <h2>Manage Auctions</h2>
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
                                                            <form id="form1" name="form1" action="manageauction.php" method="post">
                                                                <span><a href="manageauction.php?aucstatus=<?=$ast;?>">All</a></span><span class="sp">|</span>
                                                                <span><a href="manageauction.php?order=A&aucstatus=<?=$ast;?>">A</a></span><span class="sp">|</span>
                                                                <span><a href="manageauction.php?order=B&aucstatus=<?=$ast;?>">B</a></span><span class="sp">|</span>
                                                                <span><a href="manageauction.php?order=C&aucstatus=<?=$ast;?>">C</a></span><span class="sp">|</span>
                                                                <span><a href="manageauction.php?order=D&aucstatus=<?=$ast;?>">D</a></span><span class="sp">|</span>
                                                                <span><a href="manageauction.php?order=E&aucstatus=<?=$ast;?>">E</a></span><span class="sp">|</span>
                                                                <span><a href="manageauction.php?order=F&aucstatus=<?=$ast;?>">F</a></span><span class="sp">|</span>
                                                                <span><a href="manageauction.php?order=G&aucstatus=<?=$ast;?>">G</a></span><span class="sp">|</span>
                                                                <span><a href="manageauction.php?order=H&aucstatus=<?=$ast;?>">H</a></span><span class="sp">|</span>
                                                                <span><a href="manageauction.php?order=I&aucstatus=<?=$ast;?>">I</a></span><span class="sp">|</span>
                                                                <span><a href="manageauction.php?order=J&aucstatus=<?=$ast;?>">J</a></span><span class="sp">|</span>
                                                                <span><a href="manageauction.php?order=K&aucstatus=<?=$ast;?>">K</a></span><span class="sp">|</span>
                                                                <span><a href="manageauction.php?order=L&aucstatus=<?=$ast;?>">L</a></span><span class="sp">|</span>
                                                                <span><a href="manageauction.php?order=M&aucstatus=<?=$ast;?>">M</a></span><span class="sp">|</span>
                                                                <span><a href="manageauction.php?order=N&aucstatus=<?=$ast;?>">N</a></span><span class="sp">|</span>
                                                                <span><a href="manageauction.php?order=O&aucstatus=<?=$ast;?>">O</a></span><span class="sp">|</span>
                                                                <span><a href="manageauction.php?order=P&aucstatus=<?=$ast;?>">P</a></span><span class="sp">|</span>
                                                                <span><a href="manageauction.php?order=Q&aucstatus=<?=$ast;?>">Q</a></span><span class="sp">|</span>
                                                                <span><a href="manageauction.php?order=R&aucstatus=<?=$ast;?>">R</a></span><span class="sp">|</span>
                                                                <span><a href="manageauction.php?order=S&aucstatus=<?=$ast;?>">S</a></span><span class="sp">|</span>
                                                                <span><a href="manageauction.php?order=T&aucstatus=<?=$ast;?>">T</a></span><span class="sp">|</span>
                                                                <span><a href="manageauction.php?order=U&aucstatus=<?=$ast;?>">U</a></span><span class="sp">|</span>
                                                                <span><a href="manageauction.php?order=V&aucstatus=<?=$ast;?>">V</a></span><span class="sp">|</span>
                                                                <span><a href="manageauction.php?order=W&aucstatus=<?=$ast;?>">W</a></span><span class="sp">|</span>
                                                                <span><a href="manageauction.php?order=X&aucstatus=<?=$ast;?>">X</a></span><span class="sp">|</span>
                                                                <span><a href="manageauction.php?order=Y&aucstatus=<?=$ast;?>">Y</a></span><span class="sp">|</span>
                                                                <span><a href="manageauction.php?order=Z&aucstatus=<?=$ast;?>">Z</a></span>
                                                            </form>
                                                        </span>
                                                        <span>
                                                            <form name="f3" action="manageauction.php" method="post">
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
                                                                    <tbody>
                                                                        <tr>
                                                                            <th style="width:20px;text-align: center;">No</th>
                                                                            <th  style="text-align:center;">AuctionID</th>
                                                                            <th>Product Name</th>
                                                                            <th>Auction Final Price</th>
                                                                            <th style="text-align:center;">Status</th>
                                                                            <th>Auction Type</th>
                                                                            <th style="text-align:center;">Auction Category</th>
                                                                            <th style="text-align:center;">Allow Buy Now</th>                                                                            
                                                                            <!--<TD  width="10%">InStock</TD>-->
                                                                            <th style="text-align:center;">Winner</th>
                                                                            <th style="text-align:center;">Action</th>
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
                                                                            <td style="text-align:center;"><?=$srno;?></td>
                                                                            <td style="text-align:center;"><?=$id?></td>
                                                                            <td><?=$pname?></td>
                                                                            <td style="text-align:right;"><?=$fprice==""?"&nbsp":$Currency.$fprice;?></td>
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
                                                                            <td><?=$auctype==""?"&nbsp":$auctype;?></td>
                                                                            <td style="text-align:center;">
                                                                                <?php if($row->uniqueauction==true){ ?>
                                                                                <span style="color:green">Lowest Unique</span>
                                                                                <?php }else{ ?>
                                                                                        <?php if($row->reverseauction) { ?>
                                                                                <div style="color:red">Reverse Auction</div>
                                                                                            <?php }else { ?>
                                                                                <div style="color:green">Normal Auction</div>
                                                                                            <?php }?>
                                                                                <div style="">(Start Price:<?php echo $row->auc_start_price; ?>)</div>
                                                                                <?php }?>
                                                                            </td>
                                                                            <td style="text-align:center;">
                                                                                <?php if($row->allowbuynow) { ?>
                                                                                <div style="color:red">Yes</div>
                                                                                <div>(Price:<?php echo $row->allowbuynow?$Currency.$row->buynowprice:""; ?>)</div>
                                                                                            <?php }else { ?>
                                                                                <span style="color:green">No</span>

                                                                                            <?php }?>
                                                                                
                                                                            </td>
                                                                            <td  style="text-align:center;"><?=$winner==""?"&nbsp":$winner;?></td>
                                                                            <td  style="text-align:center;">
                                                                                <div class="actions_menu" style="width:180px;">
                                                                                    <ul>
                                                                                        <li>
                                                                                            <a class="edit" href="addauction.php?auction_edit=<?=$id;?>">Edit</a>
                                                                                        </li>

                                                                                        <?php if($status=='1' || $status=='4'){ ?>
                                                                                        <li>
											
                                                                                            <a class="delete" name="button" href="javascript:;" onclick="delconfirm('addauction.php?delete_auction=<?=$id;?>');">Delete</a>
                                                                                        </li>
                                                                                        <?php }?>
                                                                                        
                                                                                        <li>
                                                                                                    <?php if($status==3) { ?>
                                                                                            <a name="button" class="edit" href="addauction.php?auction_clone=<?=$id;?>">Clone</a>
                                                                                                        <?php } ?>
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
                                                            <li><a href="manageauction.php?order=<?php echo $order ?>&pgno=<?php echo $PrevPageNo; ?>&aucstatus=<?=$ast;?>" class="button light_blue_btn"><span><span>PREVIOUS</span></span></a> </li>
                                                                    <?php } ?>

                                                                <?php
                                                                $pageFrom=$PageNo-3<1?1:$PageNo-3;
                                                                $pageTo=$PageNo+3>$totalpages?$totalpages:$PageNo+3;
                                                                for($i=$pageFrom;$i<=$pageTo;$i++) {
                                                                    ?>
                                                                    <?php if($i==$PageNo) { ?>
                                                            <li><a href="manageauction.php?order=<?php echo $order ?>&pgno=<?php echo $i;?>&aucstatus=<?=$ast;?>" class="current_page"><span><span><?php echo $i; ?></span></span></a></li>
                                                                        <?php }else {?>
                                                            <li><a href="manageauction.php?order=<?php echo $order ?>&pgno=<?php echo $i;?>&aucstatus=<?=$ast;?>"><?php echo $i; ?></a></li>
                                                                        <?php }
                                                                }
                                                                ?>
                                                                <?php
                                                                if($PageNo<$totalpages) {
                                                                    $NextPageNo = 	$PageNo + 1;
                                                                    ?>
                                                            <li><a href="manageauction.php?order=<?php echo $order ?>&pgno=<?php echo $NextPageNo;?>&aucstatus=<?=$ast;?>" class="button light_blue_btn"><span><span>NEXT</span></span></a> </li>
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