<?php
session_start();
$active="Auctions";
include("connect.php");
include_once("admin.config.inc.php");
include("security.php");
include("config_setting.php");


$PRODUCTSPERPAGE = 10; 
if(!$_GET['order'])
    $order = "";
else
    $order = $_GET['order'];
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
if($order!="") {
    $query = "select * from auction_management where auc_title like '$order%' order by id";
}
else {
    $query = "select * from auction_management order by id";
}
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
        <title>Manage Auction Settings-<?php echo $ADMIN_MAIN_SITE_NAME ?></title>
        <link media="screen" rel="stylesheet" type="text/css" href="css/admin.css"  />
        <!--[if lte IE 6]><link media="screen" rel="stylesheet" type="text/css" href="css/admin-ie.css" /><![endif]-->
        <script type="text/javascript" src="js/behaviour.js"></script>
        <script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
        <script type="text/javascript" language="javascript">
            function Submitform()
            {
                document.form1.submit();
            }
	    function add_auction_time(){
	    var id = $("form").length ;

	      $.get(

		'ajaxauction.php?id=' + id,
		function(response){

		  $("#add_more").append(response);

		}




	      );



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
                                <h2>Manage Auction Settings</h2>
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
                                                    <h3>Auction Duration Management</h3>
                                                    <div  id="product_list">
                                                        <!--[if !IE]>start table_wrapper<![endif]-->
                                                        <div class="table_wrapper">
                                                            <div class="table_wrapper_inner">
                                                                <?php if($total<=0) { ?>
                                                                <ul class="system_messages">
                                                                    <li class="blue"><span class="ico"></span><strong class="system_title">No Auctions To Display</strong></li>
                                                                </ul>
                                                                    <?php }else {?>
                                                                <table cellpadding="0" cellspacing="0" width="100%">
                                                                    <tbody>
                                                                        <tr>
                                                                            <th style="width:20px;text-align: center;">No</th>
                                                                            <th>Auction Type</th>
                                                                            <th style="text-align:center;">Plus Price</th>
                                                                            <th style="text-align:center;">Final Timer Duration</th>
                                                                           <th style="text-align:center;">Auto Bidder Kick In</th>
                                                                            <th style="text-align:center;">Picture</th>
                                                                            <th style="text-align:center;">Action</th>
                                                                        </tr>
                                                                            <?
                                                                            for($i=0;$i<$total;$i++) {
                                                                                $row = db_fetch_object($result);
                                                                                $id=$row->id;
                                                                                $aname=$row->auc_title;
                                                                                $price=$row->auc_plus_price;
                                                                                $time=$row->auc_plus_time;
                                                                                $time1=$row->max_plus_time;
                                                                                $picture=$row->picture;
                                                                                ?>
                                                                        <form name="f<?=$i?>" action="changeauctiontime.php" enctype="multipart/form-data" method="post">
                                                                            <tr class="<?php echo ($i % 2!=0)?'first':'second'; ?>">
                                                                                <td style="text-align:center;">
                                                                                            <?php if($i!="") {
                                                                                                echo $i+1;
                                                                                            }else {
                                                                                                echo "1";
                                                                                            } ?>
                                                                                </td>
                                                                                <td>
                                                                                            <?php if($id==1) { ?>
                                                                                                <?=$aname?>
                                                                                                <?
                                                                                            } else {
                                                                                                ?>
                                                                                    <input type="text" value="<?=$aname?>" name="auctitle" />
                                                                                                <?
                                                                                            }
                                                                                            ?>
                                                                                </td>
                                                                                <td style="text-align:center;">
                                                                                            <?=$Currency;?>&nbsp;<input type="text" value="<?=$price?>" name="aucplusprice" size="5" />
                                                                                </td>
                                                                                <td style="text-align:center;"><input type="text" value="<?=$time?>" name="minaucplustime" size="5" /></td>
                                                                               <td style="text-align:center;"><input type="text" value="<?=$time1?>" name="maxaucplustime" size="5" /></td>
                                                                                <td style="text-align:right;vertical-align:middle;">
                                                                                        <?php if($picture!=''){?>
                                                                                        <img src="<?php echo $UploadImagePath . "aucflag/" . $picture; ?>" style="vertical-align:middle;margin-right:10px"/>
                                                                                        <?php }?>
                                                           
                                                                                </td>

                                                                                <td style="text-align:center;">
                                                                                    <input type="hidden" name="editid" value="<?=$id;?>" />
                                                                                    <span class="button send_form_btn"><span><span>Edit</span></span><input name="edit" type="submit"  /></span>
                                                                                </td>

                                                                            </tr>
									   
                                                                        </form>
                                                                                <?php }
                                                                            ?>
<table>
<div id="add_more" style="width:100%;"></div>
</table>
                                                                    </tbody>
                                                                </table>
                                                                    <?php }?>
						
									
                                                            </div>
                                                        </div>
                                                        <!--[if !IE]>end table_wrapper<![endif]-->
                                                    </div>
                                                        <!--[if !IE]>start table_wrapper<![endif]-->
                                                        <div class="table_wrapper">
                                                            <div class="table_wrapper_inner">
					     <a href="javascript:;" onclick="add_auction_time();">Add Auction Time Management</a>
							    </div>
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
                                                            <li><a href="manageauctiontime.php?order=<?php echo $iid ?>&pgno=<?php echo $PrevPageNo; ?>" class="button light_blue_btn"><span><span>PREVIOUS</span></span></a> </li>
                                                                    <?php } ?>

                                                                <?php
                                                                $pageFrom=$PageNo-3<1?1:$PageNo-3;
                                                                $pageTo=$PageNo+3>$totalpages?$totalpages:$PageNo+3;
                                                                for($i=$pageFrom;$i<=$pageTo;$i++) {
                                                                    ?>
                                                                    <?php if($i==$PageNo) { ?>
                                                            <li><a href="manageauctiontime.php?order=<?php echo $iid ?>&pgno=<?php echo $i;?>" class="current_page"><span><span><?php echo $i; ?></span></span></a></li>
                                                                        <?php }else {?>
                                                            <li><a href="manageauctiontime.php?order=<?php echo $iid ?>&pgno=<?php echo $i;?>"><?php echo $i; ?></a></li>
                                                                        <?php }
                                                                }
                                                                ?>
                                                                <?php
                                                                if($PageNo<$totalpages) {
                                                                    $NextPageNo = 	$PageNo + 1;
                                                                    ?>
                                                            <li><a href="manageauctiontime.php?order=<?php echo $iid ?>&pgno=<?php echo $NextPageNo;?>" class="button light_blue_btn"><span><span>NEXT</span></span></a> </li>
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