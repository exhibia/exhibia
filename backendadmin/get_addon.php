<?php
session_start();
$active=$_REQUEST['selected'];
include_once("admin.config.inc.php");
include("connect.php");
include("functions.php");
include("../Functions/session_unregister.php");
include("security.php");
$PRODUCTSPERPAGE = 10;

 if(file_exists("../include/addons/" . $_REQUEST['addon'] . "/admin/add_"  . $_REQUEST['addon'] . "_headers.php")){
                         ob_start();
                       include("../include/addons/" . $_REQUEST['addon'] . "/admin/add_"  . $_REQUEST['addon'] . "_headers.php");
                       
                       }


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="imagetoolbar" content="no" />
        <title><?php echo $_REQUEST['addon'];?>-<?php echo $ADMIN_MAIN_SITE_NAME ?></title>
        <link media="screen" rel="stylesheet" type="text/css" href="css/admin.css"  />
        <link type="text/css" href="css/cupertino/ui.all.css" rel="stylesheet" />
        <!--[if lte IE 6]><link media="screen" rel="stylesheet" type="text/css" href="css/admin-ie.css" /><![endif]-->
        <script type="text/javascript" src="js/behaviour.js"></script>
        <script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
        <script type="text/javascript" src="js/ui/ui.core.min.js"></script>
        <script type="text/javascript" src="js/ui/ui.datepicker.min.js"></script>
        
    </head>

    <body>
        <!--[if !IE]>start wrapper<![endif]-->
        <div id="wrapper">
            <!--[if !IE]>start head<![endif]-->
            <div id="head">
                <?php include('include/header.php'); ?>
            </div>
            <!--[if !IE]>end head<![endif]-->
	<?php
	if($_REQUEST['addon'] != 'games'){
	?>
            <!--[if !IE]>start content<![endif]-->
            <div id="content" style="min-height:750px;padding:20px;">
                <!--[if !IE]>start page<![endif]-->
                <div id="page" style="min-height:600px;padding:20px;">
                    <div class="inner" style="min-height:550px;padding:20px;">
                        <!--[if !IE]>start section<![endif]-->
                       <?php
                  }
                       if(file_exists("../include/addons/" . $_REQUEST['addon'] . "/admin/add_"  . $_REQUEST['addon'] . ".php")){
                         ob_start();
                       include("../include/addons/" . $_REQUEST['addon'] . "/admin/add_"  . $_REQUEST['addon'] . ".php");
                       
                    
                       
			  $html = ob_get_contents();
			  
			  $html = str_replace("add$_REQUEST[addon].php", "get_addon.php?addon=$_REQUEST[addon]", $html);
			  $html = preg_replace("/<\/form>/i", "<input type=\"hidden\" name=\"addon\" value=\"$_REQUEST[addon]\" /></form>", $html);
			  
			  
			  ob_end_clean();
			  echo $html;
                       
                       }else{
                    
                       if(file_exists("../include/addons/" . $_REQUEST['addon'] . ".php")){
                         ob_start();
                       include("../include/addons/" . $_REQUEST['addon'] . ".php");
                       
                    
                       
			  $html = ob_get_contents();
			  
			  $html = str_replace("add$_REQUEST[addon].php", "get_addon.php?addon=$_REQUEST[addon]", $html);
			  $html = preg_replace("/<\/form>/i", "<input type=\"hidden\" name=\"addon\" value=\"$_REQUEST[addon]\" /></form>", $html);
			  
			  
			  ob_end_clean();
			  echo $html;
			  
			  }
                             
                             
                      }
                      if($_REQUEST['addon'] != 'games'){
                      ?>
                          
                             

                        <?php if(isset($total)) {
                            ?>
                        <!--[if !IE]>start section<![endif]-->
                        <div class="section table_section">
                            <!--[if !IE]>start title wrapper<![endif]-->

                            <div class="title_wrapper">
                                <h2>Product List</h2>
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
                                                                            <th>Auction Type</th>
                                                                            <th style="text-align:center;">Start Price</th>
                                                                            <th style="text-align:center;">Fixed Price</th>
                                                                            <th style="text-align:center;">End Date</th>
                                                                            <th style="text-align:center;width:100px;">Auction Status</th>
                                                                            <th style="text-align:center;width:60px;">Option</th>
                                                                        </tr>
                                                                                <?
                                                                                $i=1;
                                                                                while($obj = db_fetch_object($ressel)) {
                                                                                    if($obj->fixedpriceauction=="1") {
                                                                                        $type = "Set Price Auction";
                                                                                    }
                                                                                    if($obj->pennyauction=="1") {
                                                                                        $type = "1 Cent Auction";
                                                                                    }
                                                                                    if($obj->nailbiterauction=="1") {
                                                                                        $type = "NailBiter Auction";
                                                                                    }
                                                                                    if($obj->offauction=="1") {
                                                                                        $type = "Totally Free";
                                                                                    }
                                                                                    if($obj->nightauction=="1") {
                                                                                        $type = "Night Auction";
                                                                                    }
                                                                                    if($obj->openauction=="1") {
                                                                                        $type = "Open Auction";
                                                                                    }

                                                                                    if($obj->auc_status=="2" || $obj->auc_status=="1") {
                                                                                        $status = "<font color='red'>Active</font>";
                                                                                    }
                                                                                    elseif($obj->auc_status=="4") {
                                                                                        $status = "<font color='green'>Pending</font>";
                                                                                    }
                                                                                    elseif($obj->auc_status=="3") {
                                                                                        $status = "<font color='blue'>Sold</font>";
                                                                                    }
                                                                                    ?>
                                                                        <tr class="<?php echo ($i==1)?'first':'second'; ?>">
                                                                            <td style="text-align:center;">
                                                                                            <?php if($obj->auctionID) {
                                                                                                echo $obj->auctionID;
                                                                                            }else {
                                                                                                echo "&nbsp;";
                                                                                            }?></td>
                                                                            <td><?=$type!=""?$type:"&nbsp;";?></td>
                                                                            <td style="text-align:right;">
                                                                                            <?=$Currency;?><?php if($obj->auc_start_price) {
                                                                                                echo $obj->auc_start_price;
                                                                                            }else {
                                                                                                echo "&nbsp;";
                                                                                            }?></td>
                                                                            <td style="text-align:right;">
                                                                                            <?=$Currency;?><?php if($obj->auc_fixed_price) {
                                                                                                echo $obj->auc_fixed_price;
                                                                                            }else {
                                                                                                echo "&nbsp;";
                                                                                            }?></td>
                                                                            <td style="text-align:center;">
                                                                                            <?php if($obj->auc_final_end_date) {
                                                                                                echo substr(ChangeDateFormatSlash($obj->auc_final_end_date),0,10);
                                                                                            }else {
                                                                                                echo "&nbsp;";
                                                                                            }?></td>
                                                                            <td style="text-align:center;">
                                                                                            <?php if($status) {
                                                                                                echo $status;
                                                                                            }else {
                                                                                                echo "&nbsp;";
                                                                                            }?></td>

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
                                                            <li><a href="productwisereport.php?pgno=<?=$PrevPageNo;?>&<?=$urldata;?>" class="button light_blue_btn"><span><span>PREVIOUS</span></span></a> </li>
                                                                        <?php } ?>

                                                                    <?php
                                                                    $pageFrom=$PageNo-3<1?1:$PageNo-3;
                                                                    $pageTo=$PageNo+3>$totalpage?$totalpage:$PageNo+3;
                                                                    for($i=$pageFrom;$i<=$pageTo;$i++) {
                                                                        ?>
                                                                        <?php if($i==$PageNo) { ?>
                                                            <li><a href="productwisereport.php?pgno=<?=$i;?>&<?=$urldata;?>" class="current_page"><span><span><?php echo $i; ?></span></span></a></li>
                                                                            <?php }else {?>
                                                            <li><a href="productwisereport.php?pgno=<?=$i;?>&<?=$urldata;?>"><?php echo $i; ?></a></li>
                                                                            <?php }
                                                                    }
                                                                    ?>
                                                                    <?php
                                                                    if($PageNo<$totalpage) {
                                                                        $NextPageNo = 	$PageNo + 1;
                                                                        ?>
                                                            <li><a href="productwisereport.php?pgno=<?=$NextPageNo;?>&<?=$urldata;?>" class="button light_blue_btn"><span><span>NEXT</span></span></a> </li>
                                                                        <?php } ?>
                                                        </ul>

                                                    </div>
                                                    <!--[if !IE]>end pagination<![endif]-->
                                                            <?php }?>

                                                    <div class="categoryorder" style="text-align: center;">
                                                            <?
                                                            if($total>0) {
                                                                ?>
                                                        <span class="button send_form_btn"><span><span>Export to CSV</span></span><input type="button" name="submit" onclick="OpenPopup('download.php?export=product&datefrom=<?=$_POST["datefrom"]?>&dateto=<?=$_POST["dateto"]?>&products=<?=$_POST["products"]?>&auctionstatus=<?=$_POST["auctionstatus"]?>')"/></span>
                                                        <br/><br/>
                                                                <?
                                                            }
                                                            ?>
                                                    </div>

                                                </div>
                                       
                                    
                                
                             
                                
                            <?php
                              } 
                              ?>
                                            <!--[if !IE]>end table_wrapper<![endif]-->
                                                
                                <!--[if !IE]>end section content bottom<![endif]-->

                            </div>
                            <!--[if !IE]>end section content<![endif]-->
                       
                               </div>
                        <!--[if !IE]>end section<![endif]-->
                        <?php
                          }
	if($_REQUEST['addon'] != 'games'){
	?>
                                <!--[if !IE]>end section content top<![endif]-->
                                <!--[if !IE]>start section content bottom<![endif]-->
                                <span class="scb"><span class="scb_left"></span><span class="scb_right"></span></span>
                                <!--[if !IE]>end section content bottom<![endif]-->

                      
                <!--[if !IE]>end page<![endif]-->
                <!--[if !IE]>start sidebar<![endif]-->
                <div id="sidebar" style="float:left;">
                    <div class="inner">
                   
                        <?php include 'include/leftside.php' ?>
                    </div>
                </div>
                <!--[if !IE]>end sidebar<![endif]-->

            </div>
            <!--[if !IE]>end content<![endif]-->

        <!--[if !IE]>end wrapper<![endif]-->

        <!--[if !IE]>start footer<![endif]-->
        <div id="footer">
            <div id="footer_inner">
                <?php include 'include/footer.php'; ?>
            </div>
        </div>
        <!--[if !IE]>end footer<![endif]-->
<?php } ?>
    </body>
</html> 




