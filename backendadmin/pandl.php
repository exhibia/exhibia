<?php
session_start();
$active="Database";
include("connect.php");
include_once("admin.config.inc.php");
include("security.php");
include("config_setting.php");

if($perpage['manageProductPage']) {
    $PRODUCTSPERPAGE = 10;
}
else {
    if(trim($PRODUCTSPERPAGE)=="") {
        $PRODUCTSPERPAGE=10;
    }
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
//$prodID=$_GET['prodID'];
$catID=$_GET['catID'];
//echo $prodID;
//exit;

if(!isset($catID)) {
    $catID=0;
}

function percent($num, $total, $prec)
{
    return number_format((100.0*$num)/$total, $prec);
}

  	function reformat_date($date, $format){
// Function written by Marcus L. Griswold (vujsa)
// Can be found at http://www.handyphp.com
// Do not remove this header!

    $output = date($format, strtotime($date));
    return $output;
}




    $query="select DISTINCT auction.productID, products.productID, products.name, products.categoryID, products.actual_cost, products.picture1, products.product_code, auc_final_end_date from auction, products WHERE products.productID = auction.productID AND  auction.productID != '' AND auc_end_date != '0000-00-00'";


if(!empty($_REQUEST['catID'])){

$query .= " AND products.categoryID = '$_GET[catID]'";


}

if(!empty($_REQUEST['date_from']) & !empty($_REQUEST['date_to'])){


if(!empty($_REQUEST['date_from'])){
$query .= " AND auc_start_date >= '" . reformat_date($_GET[date_from], "Y-m-d") . "'";

}

if(!empty($_REQUEST['date_to'])){


$query .= " AND auc_final_end_date <= '" . reformat_date($_GET[date_to], "Y-m-d") . "'";


}
echo $query;

}

if(!empty($_GET['order'])){

$query .= " AND products.name LIKE '$_GET[order]%'";
}
//add date sorting here
    $result=db_query($query) or die (db_error());
    $totalrows=db_num_rows($result);
    $totalpages=ceil($totalrows/$PRODUCTSPERPAGE);
    $query .= " LIMIT $StartRow,$PRODUCTSPERPAGE";
    $result =db_query($query);
    $total = db_num_rows($result);






    $SubCat="<a class='header-cattb-link' href='pandl.php'>"."Home"." >> "."</a><span class=header-cattb-link>".$catrow->name."</span>";

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>


<?php
if(empty($_GET['container'])){
?>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="imagetoolbar" content="no" />
        <title>Profit and Loss Reports-<?php echo $ADMIN_MAIN_SITE_NAME ?></title>
        <link media="screen" rel="stylesheet" type="text/css" href="css/admin.css"  />
        <!--[if lte IE 6]><link media="screen" rel="stylesheet" type="text/css" href="css/admin-ie.css" /><![endif]-->
        <script type="text/javascript" src="js/behaviour.js"></script>
        <script type="text/javascript" src="popupimage.js"></script>
        <script type="text/javascript">
            //function gotocategory(cat)
            //	{
            //		if(trim(cat)!="")
            //		{
            //			window.location.href="pandl.php?catID="+cat;
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
                    window.location.href="pandl.php?catID="+cat;
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

                    var locat = 'addproducts.php?product_delete=' + prid +'&product_cid=' + crid;
                    
                    window.location.href=locat;

                }

                return false;
            }

        </script>
<?php
}
?>


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
<?php
if(empty($_GET['container'])){
?>
                <?php include('include/header.php'); ?>
<?php
}
?>
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
                                <h2>Profit and Loss Reports for <?php echo $ADMIN_MAIN_SITE_NAME;?></h2>
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
                                                        <form id="form1" name="form1" action="pandl.php" method="get">
<?php
foreach($_GET as $key => $value){

    if(!empty($value)){

	?>
	<input type="hidden" value="<?php echo $value;?>" name="<?php echo $key; ?>">

	<?php
	}

}
?>


<table width="100%">
<tr>
<td width="50%">
                                                            <span><a href="pandl.php">All</a></span><span class="sp">|</span>
                                                            <span><a href="pandl.php?order=A&catID=<?=$catID?>">A</a></span><span class="sp">|</span>
                                                            <span><a href="pandl.php?order=B&catID=<?=$catID?>">B</a></span><span class="sp">|</span>
                                                            <span><a href="pandl.php?order=C&catID=<?=$catID?>">C</a></span><span class="sp">|</span>
                                                            <span><a href="pandl.php?order=D&catID=<?=$catID?>">D</a></span><span class="sp">|</span>
                                                            <span><a href="pandl.php?order=E&catID=<?=$catID?>">E</a></span><span class="sp">|</span>
                                                            <span><a href="pandl.php?order=F&catID=<?=$catID?>">F</a></span><span class="sp">|</span>
                                                            <span><a href="pandl.php?order=G&catID=<?=$catID?>">G</a></span><span class="sp">|</span>
                                                            <span><a href="pandl.php?order=H&catID=<?=$catID?>">H</a></span><span class="sp">|</span>
                                                            <span><a href="pandl.php?order=I&catID=<?=$catID?>">I</a></span><span class="sp">|</span>
                                                            <span><a href="pandl.php?order=J&catID=<?=$catID?>">J</a></span><span class="sp">|</span>
                                                            <span><a href="pandl.php?order=K&catID=<?=$catID?>">K</a></span><span class="sp">|</span>
                                                            <span><a href="pandl.php?order=L&catID=<?=$catID?>">L</a></span><span class="sp">|</span>
                                                            <span><a href="pandl.php?order=M&catID=<?=$catID?>">M</a></span><span class="sp">|</span>
                                                            <span><a href="pandl.php?order=N&catID=<?=$catID?>">N</a></span><span class="sp">|</span>
                                                            <span><a href="pandl.php?order=O&catID=<?=$catID?>">O</a></span><span class="sp">|</span>
                                                            <span><a href="pandl.php?order=P&catID=<?=$catID?>">P</a></span><span class="sp">|</span>
                                                            <span><a href="pandl.php?order=Q&catID=<?=$catID?>">Q</a></span><span class="sp">|</span>
                                                            <span><a href="pandl.php?order=R&catID=<?=$catID?>">R</a></span><span class="sp">|</span>
                                                            <span><a href="pandl.php?order=S&catID=<?=$catID?>">S</a></span><span class="sp">|</span>
                                                            <span><a href="pandl.php?order=T&catID=<?=$catID?>">T</a></span><span class="sp">|</span>
                                                            <span><a href="pandl.php?order=U&catID=<?=$catID?>">U</a></span><span class="sp">|</span>
                                                            <span><a href="pandl.php?order=V&catID=<?=$catID?>">V</a></span><span class="sp">|</span>
                                                            <span><a href="pandl.php?order=W&catID=<?=$catID?>">W</a></span><span class="sp">|</span>
                                                            <span><a href="pandl.php?order=X&catID=<?=$catID?>">X</a></span><span class="sp">|</span>
                                                            <span><a href="pandl.php?order=Y&catID=<?=$catID?>">Y</a></span><span class="sp">|</span>
                                                            <span><a href="pandl.php?order=Z&catID=<?=$catID?>">Z</a></span>
</td></tr>
<tr>
<td >


<span>
Sort By Category:
<select name="catID" id="catID" onchange="select_cat()">
<?php
$sql = "SELECT * from categories WHERE categoryID = $_GET[catID]";
$query = db_query($sql);
$rowCat = db_fetch_array($query);

if(!empty($_GET['catID'])){
?>
<option value="<?php echo $_GET['catID'];?>"><?php echo $rowCat['name'];?></option>


<?php
}

$sql = "SELECT * from categories";
$query = db_query($sql);

while($rowCat = db_fetch_array($query)){

?>

<option value="<?php echo $rowCat['categoryID'];?>"><?php echo $rowCat['name'];?></option>



<?php
}
?>
</select>
</span>
</td><td >
 

 <?php include("datepickers.php"); ?>



</div>


</td>
<td> 


<input type="submit" name="submit" value="Sort">


</td>


</tr>

<tr><td height="30px" width="100%" colspan="5"></td></tr>


</table>
                                                        </form>

 






                                                    </div>
                                                    <div  id="product_list">
                                                        <!--[if !IE]>start table_wrapper<![endif]-->
                                                        <div class="table_wrapper">
                                                            <div class="table_wrapper_inner">
                                                                <?php if(($totalcat<=0 && !$total) or ($total<=0 && !totalcat)) { ?>
                                                                <ul class="system_messages">
                                                                    <li class="blue"><span class="ico"></span><strong class="system_title">No product To Display</strong></li>
                                                                </ul>
                                                                    <?php }else {?>
                                                                <?php if(file_exists('PANDL/pandlresults.php')){


									      include('PANDL/pandlresults.php');

									}else{


								    echo "Pease contact Penny Auction Software for this feature";



								    }



							      ?>
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
                                                            <li><a href="pandl.php?order=<?php echo $iid ?>&pgno=<?php echo $PrevPageNo; ?>&catID=<?=$catID?>" class="button light_blue_btn"><span><span>PREVIOUS</span></span></a> </li>
                                                                    <?php } ?>

                                                                <?php
                                                                $pageFrom=$PageNo-3<1?1:$PageNo-3;
                                                                $pageTo=$PageNo+3>$totalpages?$totalpages:$PageNo+3;
                                                                for($i=$pageFrom;$i<=$pageTo;$i++) {
                                                                    ?>
                                                                    <?php if($i==$PageNo) { ?>
                                                            <li><a href="pandl.php?order=<?php echo $iid ?>&pgno=<?php echo $i;?>&catID=<?=$catID?>" class="current_page"><span><span><?php echo $i; ?></span></span></a></li>
                                                                        <?php }else {?>
                                                            <li><a href="pandl.php?order=<?php echo $iid ?>&pgno=<?php echo $i;?>&catID=<?=$catID?>"><?php echo $i; ?></a></li>
                                                                        <?php }
                                                                }
                                                                ?>
                                                                <?php
                                                                if($PageNo<$totalpages) {
                                                                    $NextPageNo = 	$PageNo + 1;
                                                                    ?>
                                                            <li><a href="pandl.php?order=<?php echo $iid ?>&pgno=<?php echo $NextPageNo;?>&catID=<?=$catID?>" class="button light_blue_btn"><span><span>NEXT</span></span></a> </li>
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
<?php
if(empty($_GET['container'])){
?>
                        <?php include 'include/leftside.php' ?>
<?php } ?>
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
<?php
if(empty($_GET['container'])){
?>
                <?php include 'include/footer.php'; ?>
<?php } ?>
            </div>
        </div>
        <!--[if !IE]>end footer<![endif]-->

    </body>
</html>