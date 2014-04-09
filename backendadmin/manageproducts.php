<?php
session_start();
$active="Database";
include_once("../config/config.inc.php");
include("connect.php");

include("functions.php");
include("security.php");
include("config_setting.php");




include("gd.inc.php");
include("imgsize.php");


        
        
        
function update_products_Count_Value_For_Categories_Delete($catid) {
    $qrysel = "select products_count from categories where categoryID='$catid'";
    $ressel = db_query($qrysel);
    $totalsel = db_affected_rows();
    if ($totalsel > 0) {
        $rowsel = db_fetch_object($ressel);
        $totproduct = $rowsel->products_count;
        $totproducts = $totproducts = $totproduct - 1;
        $qryupd = "update categories set products_count=" . $totproducts . " where categoryID='$catid'";
        db_query($qryupd) or die(db_error());
    }
}

function update_products_Count_Value_For_Categories($catid) {
    $qrysel = "select products_count from categories where categoryID='$catid'";
    $ressel = db_query($qrysel);
    $totalsel = db_affected_rows();
    if ($totalsel > 0) {
        $rowsel = db_fetch_object($ressel);
        $totproduct = $rowsel->products_count;
        $totproducts = $totproduct + 1;
        $qryupd = "update categories set products_count=" . $totproducts . " where categoryID='$catid'";
        db_query($qryupd) or die(db_error());
    }
}


if(!empty($_REQUEST['product_delete'])){

    if(db_num_rows(db_query("select * from auction where auc_status = '2' and productID = '$_REQUEST[product_delete]'")) == 0){
  
    
    $objcat = db_fetch_object(db_query("select categoryID from products where productID = '$_REQUEST[product_delete]'"));;
    
    db_query("delete from products where productID = '$_REQUEST[product_delete]'");
    
        //update_products_Count_Value_For_Categories($objcat->categoryID);
        update_products_Count_Value_For_Categories_Delete($objcat->categoryID);
    
    
    
    if (isset($_GET['imageid'])) {
        $imageid = $_GET['imageid'];
        if ($imageid >= 1 && $imageid <= 4) {
            $imagefiled='picture'.$imageid;
            $imagename='';
            $upimagesql="update products set $imagefiled='' where productID=$pid";
            db_query($upimagesql);
            if($imageid==1){
                deleteImage($picture1);
                $picture1='';
            }
            else if($imageid==2){
                deleteImage($picture2);
                $picture2='';
            }
            else if($imageid==3){
                deleteImage($picture3);
                $picture3='';
            }
            else if($imageid==4){
                deleteImage($picture4);
                $picture4='';
            }
        }
    }
    }else{
    
    
	   ?>
        <script type="text/javascript">
            window.location.href="message.php?msg=121";
        </script>
<?php
//				header("location: message.php?msg=41");
        exit;
    
    
    }
    
 }
if($perpage['manageProductPage']) {
    $PRODUCTSPERPAGE = 10;
}
else {
    if(trim($PRODUCTSPERPAGE)=="") {
        $PRODUCTSPERPAGE=10;
    }
}
//$prodID=$_GET['prodID'];
$catID=$_REQUEST['catID'];
$cID = $catID;
//echo $prodID;
//exit;

if(empty($catID)) {
    $catID=0;
}


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
/***********************************************
display search results
***********************************************/
/*********************************************

  Display all Products

  *********************************************/


if($catID>0) {
    $query="select * from products where categoryID='$catID'";



	if(!empty($name)){

		$query .= " and name like '$order%' ";

	}
	
    $totproducts = db_fetch_array(db_query("select count(productID) from products where categoryID = '$catID'"));
    
    
        $qryupd = "update categories set products_count=" . $totproducts[0] . " where categoryID='$catID'";
        db_query($qryupd) or die(db_error());

    

$result=db_query($query) or die (db_error());
    $totalrows=db_num_rows($result);
    $totalpages=ceil($totalrows/$PRODUCTSPERPAGE);

    $total = db_num_rows($result);

    $query .= " order by productID";
    $query .= " LIMIT $StartRow,$PRODUCTSPERPAGE";
 
    $result =db_query($query);

    $getcat = "select name from categories where categoryID='$catID'";
    $resnew = db_query($getcat);
    $catrow = db_fetch_object($resnew);
    $SubCat="<a class='header-cattb-link' href='manageproducts.php'>"."Home"." >> "."</a><span class=header-cattb-link>".$catrow->name."</span>";
}
else {
    $query="select * from categories where ";

if(!empty($name)){

	$query .= "name like '$order%' and ";

}
	$query .= "categoryID!=1 order by categoryID";

    $result=db_query($query) or die (db_error());
    $totalcat = db_num_rows($result);

    $totalrows=db_num_rows($result);
    $totalpages=ceil($totalrows/$PRODUCTSPERPAGE);
    //$query .= " LIMIT $StartRow,$PRODUCTSPERPAGE";
    $result =db_query($query);

    $SubCat="<a class='header-cattb-link' href='manageproducts.php'>"."Home"." >> "."</a>";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="imagetoolbar" content="no" />
        <title>Manage Products-<?php echo $ADMIN_MAIN_SITE_NAME ?></title>
        <link media="screen" rel="stylesheet" type="text/css" href="css/admin.css"  />
        <!--[if lte IE 6]><link media="screen" rel="stylesheet" type="text/css" href="css/admin-ie.css" /><![endif]-->
	<link type="text/css" href="css/cupertino/ui.all.css" rel="stylesheet" />
        <link type="text/css" href="css/cupertino/jquery-ui-1.7.3.custom.css" rel="stylesheet" />

        <!--[if lte IE 6]><link media="screen" rel="stylesheet" type="text/css" href="css/admin-ie.css" /><![endif]-->
        <script type="text/javascript" src="js/behaviour.js"></script>
        <script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
        <script type="text/javascript" src="js/ui/jquery-ui-1.7.2.custom.min.js"></script>
        <script type="text/javascript" src="js/behaviour.js"></script>
        <script type="text/javascript" src="popupimage.js"></script>
        <script type="text/javascript">
            //function gotocategory(cat)
            //	{
            //		if(trim(cat)!="")
            //		{
            //			window.location.href="manageproducts.php?catID="+cat;
            //		}
            //	}
            function delconfirm(loc)
            {
                if(confirm("Are you Sure Do You Want To Delete"))
                {
                    window.location.href=loc;
                }
                return false;
            }
        </script>
        <script type="text/javascript">
            function gotocategory(cat)
            {
                if(cat!="")
                {
                    window.location.href="manageproducts.php?catID="+cat;
                }
            }
        </script>
        <script type="text/javascript">
            function OnDeleteAction(id)
            {
                 if(confirm("Are you sure do you want to delete this?"))
                {
                    var prid = document.getElementById('product_delete_id_' + id).value;
                    var crid = document.getElementById('product_delete_cid_' + id).value;

                    //                    $('#hidden_product_delete').val(prid);
                    //                    $('#hidden_product_cid').val(crid);
                    //                    $('#deleteform').submit();

                    var locat = 'manageproducts.php?product_delete=' + prid +'&product_cid=' + crid;
                    console.log(locat);
                    window.location.href=locat;

                }

                return false;
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
                                <h2>Manage Products</h2>
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
                                                        <form id="form1" name="form1" action="manageproducts.php" method="post">
                                                            <span><a href="manageproducts.php">All</a></span><span class="sp">|</span>
                                                            <span><a href="manageproducts.php?order=A&catID=<?=$catID?>">A</a></span><span class="sp">|</span>
                                                            <span><a href="manageproducts.php?order=B&catID=<?=$catID?>">B</a></span><span class="sp">|</span>
                                                            <span><a href="manageproducts.php?order=C&catID=<?=$catID?>">C</a></span><span class="sp">|</span>
                                                            <span><a href="manageproducts.php?order=D&catID=<?=$catID?>">D</a></span><span class="sp">|</span>
                                                            <span><a href="manageproducts.php?order=E&catID=<?=$catID?>">E</a></span><span class="sp">|</span>
                                                            <span><a href="manageproducts.php?order=F&catID=<?=$catID?>">F</a></span><span class="sp">|</span>
                                                            <span><a href="manageproducts.php?order=G&catID=<?=$catID?>">G</a></span><span class="sp">|</span>
                                                            <span><a href="manageproducts.php?order=H&catID=<?=$catID?>">H</a></span><span class="sp">|</span>
                                                            <span><a href="manageproducts.php?order=I&catID=<?=$catID?>">I</a></span><span class="sp">|</span>
                                                            <span><a href="manageproducts.php?order=J&catID=<?=$catID?>">J</a></span><span class="sp">|</span>
                                                            <span><a href="manageproducts.php?order=K&catID=<?=$catID?>">K</a></span><span class="sp">|</span>
                                                            <span><a href="manageproducts.php?order=L&catID=<?=$catID?>">L</a></span><span class="sp">|</span>
                                                            <span><a href="manageproducts.php?order=M&catID=<?=$catID?>">M</a></span><span class="sp">|</span>
                                                            <span><a href="manageproducts.php?order=N&catID=<?=$catID?>">N</a></span><span class="sp">|</span>
                                                            <span><a href="manageproducts.php?order=O&catID=<?=$catID?>">O</a></span><span class="sp">|</span>
                                                            <span><a href="manageproducts.php?order=P&catID=<?=$catID?>">P</a></span><span class="sp">|</span>
                                                            <span><a href="manageproducts.php?order=Q&catID=<?=$catID?>">Q</a></span><span class="sp">|</span>
                                                            <span><a href="manageproducts.php?order=R&catID=<?=$catID?>">R</a></span><span class="sp">|</span>
                                                            <span><a href="manageproducts.php?order=S&catID=<?=$catID?>">S</a></span><span class="sp">|</span>
                                                            <span><a href="manageproducts.php?order=T&catID=<?=$catID?>">T</a></span><span class="sp">|</span>
                                                            <span><a href="manageproducts.php?order=U&catID=<?=$catID?>">U</a></span><span class="sp">|</span>
                                                            <span><a href="manageproducts.php?order=V&catID=<?=$catID?>">V</a></span><span class="sp">|</span>
                                                            <span><a href="manageproducts.php?order=W&catID=<?=$catID?>">W</a></span><span class="sp">|</span>
                                                            <span><a href="manageproducts.php?order=X&catID=<?=$catID?>">X</a></span><span class="sp">|</span>
                                                            <span><a href="manageproducts.php?order=Y&catID=<?=$catID?>">Y</a></span><span class="sp">|</span>
                                                            <span><a href="manageproducts.php?order=Z&catID=<?=$catID?>">Z</a></span>
                                                        </form>
                                                    </div>
                                                    <div  id="product_list">
                                                        <!--[if !IE]>start table_wrapper<![endif]-->
                                                        <div class="table_wrapper">
                                                            <div class="table_wrapper_inner">
                                                                <?php //if(($totalcat<=0 && !$total) or ($total<=0 && !totalcat)) { ?>
                                                                <!--<ul class="system_messages">
                                                                    <li class="blue"><span class="ico"></span><strong class="system_title">No product To Display</strong></li>
                                                                </ul>-->
                                                                    <?php //}else {?>
                                                                <table cellpadding="0" cellspacing="0" width="100%">
                                                                    <tbody>
                                                                        <tr style="background-color:#484848">
                                                                            <td colspan="8">&nbsp;<?=$SubCat?></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <!-- DISPLAY THE SUBCATEGORIES AND ON CLICK GO TO SUB CATEGORIES -->
                                                                                <?
                                                                                if($totalcat!="") {
                                                                                    while($catdisp = db_fetch_array($result)) {

                                                                                    $pr_count = db_num_rows(db_query("select * from products where categoryID = $catdisp[categoryID]"));
                                                                                        ?>
                                                                            <td><?php if($pr_count > 0) {?><a class="folder" href="manageproducts.php?catID=<?=$catdisp["categoryID"];?>"><img alt="" class="folder" src="<?='images/icons/folder.gif'?>"/>&nbsp;&nbsp;<?=$catdisp["name"];?></a><?php } else {?> <img alt="" class="folder" src="<?='images/icons/folder.gif'?>"/>&nbsp;&nbsp;<?=$catdisp["name"];?><?php }?>&nbsp;&nbsp;Products : <?echo $pr_count;?></td>
                                                                        </tr>
                                                                                    <?
                                                                                }
                                                                            }
                                                                            ?>
                                                                        <tr>
                                                                            <td colspan="8">
                                                                                <!--END DISPLAY CATEGORIES-->
                                                                            </td>
                                                                        </tr>

                                                                            <?php
                                                                            if($total>0) {
                                                                                ?>
                                                                        <tr class="th-a">
                                                                            <th style="width:6%;text-align:center;">No</th>
                                                                            <th style="width:19%;text-align:center;" class="photo">Image</th>
                                                                            <th style="width:11%;">Code</th>
                                                                            <th style="width:22%">Product</th>
                                                                            <th style="width:15%">Price</th>
                                                                            <!--<TD  width="10%">InStock</TD>-->
                                                                            <th style="width:11%">Status</th>
                                                                            <th style="width:120px;text-align:center">Action</th>
                                                                        </tr>
                                                                                <?php
                                                                            }
                                                                            ?>

                                                                            <?php
                                                                            for($i=0;$i<10;$i++) {
                                                                                $row = db_fetch_object($result);
										
										if(!empty($row->productID)){
                                                                                $id=$row->productID;
                                                                                $catID=$row->categoryID;
                                                                                $image = $row->picture1;
                                                                                $code=$row->product_code;

                                                                                $name = $row->name;
                                                                                $price= $Currency.$row->price;
                                                                                $status = $row->enabled;

                                                                                $cellColor = "";
                                                                                $cellColor = ConfigcellColor($i);

                                                                                if($PageNo>1) {
                                                                                    $srno = ($PageNo-1)*10+$i+1;
                                                                                }
                                                                                else {
                                                                                    $srno = $i+1;
                                                                                }

                                                                                ?>
                                                                        <tr class="<?php echo ($i % 2!=0)?'first':'second'; ?>" valign="center" style="">
                                                                            <td style="width:6%;text-align:center;height:70px;">
                                                                                        <?php echo $srno;?>
                                                                            </td>
                                                                            <td style="width:19%;text-align:center;">
                                                                                <a href="manageproducts.php?prodID=<?=$id?>&catID=<?=$catID?>" class="product_thumb">
                                                                                            <?php if($image!="") {
                                                                                                echo "<img src='../uploads/products/thumbs/thumb_".$image."'>";
                                                                                            }else {
                                                                                                echo "&nbsp;";
                                                                                            } ?>
                                                                                </a>
                                                                            </td>
                                                                            <td style="width:11%;">
                                                                                        <?php if($code!="") {
                                                                                            echo $code;
                                                                                        }else {
                                                                                            echo "&nbsp;";
                                                                                        }?>
                                                                            </td>
                                                                            <td style="width:22%;">
                                                                                <a href="manageproducts.php?prodID=<?=$id?>&catID=<?=$catID?>" class="product_name">
                                                                                            <?php if($name!="") {
                                                                                                echo stripslashes($name);
                                                                                            }else {
                                                                                                echo "&nbsp;";
                                                                                            } ?>
                                                                                </a>
                                                                            </td>
                                                                            <td style="width:15%">
                                                                                        <?php if($price!="") {
                                                                                            echo $price;
                                                                                        }else {
                                                                                            echo "0.00";
                                                                                        } ?>
                                                                            </td>
                                                                            <td style="width:11%;">
                                                                                        <?php if($status!="") {
                                                                                            if($status==1) {
                                                                                                echo "<font color='green'>Enable</font>";
                                                                                            }else {
                                                                                                echo "<font color='red'>Disable</font>";
                                                                                            }
                                                                                        }
                                                                                        else {
                                                                                            echo "<font color='red'>Not Defined</font>";
                                                                                        } ?>
                                                                            </td>
                                                                            <td style="width:120px;" align="center">
                                                                                <div class="actions_menu">
                                                                                    <ul>
                                                                                        <li>
                                                                                            <a class="edit" href="addproducts.php?product_edit=<?=$id;?>">Edit</a>
                                                                                        </li>
                                                                                        <li><a class="delete" href="" onClick="return OnDeleteAction(<?=$id;?>);">Delete</a></li>
                                                                                        <li>
                                                                                            <input type="hidden" id="product_delete_id_<?=$id;?>" name="product_delete_id" value="<?=$id;?>"/>
                                                                                            <input type="hidden" id="product_delete_cid_<?=$id;?>" name="product_delete_cid" value="<?=$catID;?>"/>
                                                                                        </li>
                                                                                    </ul>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                                <?php }
										
										}
                                                                            ?>
                                                                    </tbody>
                                                                </table>
                                                                    <?php // }?>
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
                                                            <li><a href="manageproducts.php?order=<?php echo $iid ?>&pgno=<?php echo $PrevPageNo; ?>&catID=<?echo $cID; ?>" class="button light_blue_btn"><span><span>PREVIOUS</span></span></a> </li>
                                                                    <?php } ?>

                                                                <?php
                                                                $pageFrom=$PageNo-3<1?1:$PageNo-3;
                                                                $pageTo=$PageNo+3>$totalpages?$totalpages:$PageNo+3;
                                                                for($i=$pageFrom;$i<=$pageTo;$i++) {
                                                                    ?>
                                                                    <?php if($i==$PageNo) { ?>
                                                            <li><a href="manageproducts.php?order=<?php echo $iid ?>&pgno=<?php echo $i;?>&catID=<?php echo $cID; ?>" class="current_page"><span><span><?php echo $i; ?></span></span></a></li>
                                                                        <?php }else {?>
                                                            <li><a href="manageproducts.php?order=<?php echo $iid ?>&pgno=<?php echo $i;?>&catID=<?php echo $cID; ?>"><?php echo $i; ?></a></li>
                                                                        <?php }
                                                                }
                                                                ?>
                                                                <?php
                                                                if($PageNo<$totalpages) {
                                                                    $NextPageNo = 	$PageNo + 1;
                                                                    ?>
                                                            <li><a href="manageproducts.php?order=<?php echo $iid ?>&pgno=<?php echo $NextPageNo;?>&catID=<?php echo $cID; ?>" class="button light_blue_btn"><span><span>NEXT</span></span></a> </li>
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