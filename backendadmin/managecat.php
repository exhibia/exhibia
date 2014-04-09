<?php
session_start();
$active="Database";
include_once("admin.config.inc.php");
include("connect.php");
include("security.php");
include("config_setting.php");

$PRODUCTSPERPAGE=10;

if(!$_GET['order'])
    $iid = "";
else
    $iid = $_GET['order'];
if(!$_GET['pgno']) {
    $PageNo = 1;
}
else {
    $PageNo = $_GET['pgno'];
}
//     Get how many products  are to be displayed according to the  Events

$StartRow =   $PRODUCTSPERPAGE * ($PageNo-1);
//display search results
//  Display all Categories
$catid=$_GET['catID'];
//echo $catid;
//exit;
if(!isset($catid)) {
    $catid=0;
}

if($catid<>0) {
    $query="select * from categories where name like '$iid%' order by categoryID";

}
else {
    $query="select * from categories where name like '$iid%' order by categoryID";

}

$result=db_query($query) or die (db_error());
$totalrows=db_num_rows($result);
$totalpages=ceil($totalrows/$PRODUCTSPERPAGE);

$query .= " LIMIT $StartRow,$PRODUCTSPERPAGE";
$result =db_query($query) or die(db_error());
$total = db_num_rows($result);


//End Pageing Inforamtion

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="imagetoolbar" content="no" />
        <title>Manage Links Category-<?php echo $ADMIN_MAIN_SITE_NAME ?></title>
        <link media="screen" rel="stylesheet" type="text/css" href="css/admin.css"  />
        <!--[if lte IE 6]><link media="screen" rel="stylesheet" type="text/css" href="css/admin-ie.css" /><![endif]-->
        <link type="text/css" href="css/cupertino/ui.all.css" rel="stylesheet" />
        <link type="text/css" href="css/cupertino/jquery-ui-1.7.3.custom.css" rel="stylesheet" />

        <!--[if lte IE 6]><link media="screen" rel="stylesheet" type="text/css" href="css/admin-ie.css" /><![endif]-->
        <script type="text/javascript" src="js/behaviour.js"></script>
        <script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
        <script type="text/javascript" src="js/ui/jquery-ui-1.7.2.custom.min.js"></script>
        <script type="text/javascript">
            function conf()
            {
                if(confirm("Are You Sure"))
                {
                    return true;
                }
                return false;
            }
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
                    window.location.href="managecat.php?catID="+cat;
                }
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
                                <h2>Manage Products Category</h2>
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
                                                        <form id="form1" name="form1" action="managecat.php" method="post">
                                                            <span><a href="managecat.php">All</a></span><span class="sp">|</span>
                                                            <span><a href="managecat.php?order=A&catID=<?=$catid?>">A</a></span><span class="sp">|</span>
                                                            <span><a href="managecat.php?order=B&catID=<?=$catid?>">B</a></span><span class="sp">|</span>
                                                            <span><a href="managecat.php?order=C&catID=<?=$catid?>">C</a></span><span class="sp">|</span>
                                                            <span><a href="managecat.php?order=D&catID=<?=$catid?>">D</a></span><span class="sp">|</span>
                                                            <span><a href="managecat.php?order=E&catID=<?=$catid?>">E</a></span><span class="sp">|</span>
                                                            <span><a href="managecat.php?order=F&catID=<?=$catid?>">F</a></span><span class="sp">|</span>
                                                            <span><a href="managecat.php?order=G&catID=<?=$catid?>">G</a></span><span class="sp">|</span>
                                                            <span><a href="managecat.php?order=H&catID=<?=$catid?>">H</a></span><span class="sp">|</span>
                                                            <span><a href="managecat.php?order=I&catID=<?=$catid?>">I</a></span><span class="sp">|</span>
                                                            <span><a href="managecat.php?order=J&catID=<?=$catid?>">J</a></span><span class="sp">|</span>
                                                            <span><a href="managecat.php?order=K&catID=<?=$catid?>">K</a></span><span class="sp">|</span>
                                                            <span><a href="managecat.php?order=L&catID=<?=$catid?>">L</a></span><span class="sp">|</span>
                                                            <span><a href="managecat.php?order=M&catID=<?=$catid?>">M</a></span><span class="sp">|</span>
                                                            <span><a href="managecat.php?order=N&catID=<?=$catid?>">N</a></span><span class="sp">|</span>
                                                            <span><a href="managecat.php?order=O&catID=<?=$catid?>">O</a></span><span class="sp">|</span>
                                                            <span><a href="managecat.php?order=P&catID=<?=$catid?>">P</a></span><span class="sp">|</span>
                                                            <span><a href="managecat.php?order=Q&catID=<?=$catid?>">Q</a></span><span class="sp">|</span>
                                                            <span><a href="managecat.php?order=R&catID=<?=$catid?>">R</a></span><span class="sp">|</span>
                                                            <span><a href="managecat.php?order=S&catID=<?=$catid?>">S</a></span><span class="sp">|</span>
                                                            <span><a href="managecat.php?order=T&catID=<?=$catid?>">T</a></span><span class="sp">|</span>
                                                            <span><a href="managecat.php?order=U&catID=<?=$catid?>">U</a></span><span class="sp">|</span>
                                                            <span><a href="managecat.php?order=V&catID=<?=$catid?>">V</a></span><span class="sp">|</span>
                                                            <span><a href="managecat.php?order=W&catID=<?=$catid?>">W</a></span><span class="sp">|</span>
                                                            <span><a href="managecat.php?order=X&catID=<?=$catid?>">X</a></span><span class="sp">|</span>
                                                            <span><a href="managecat.php?order=Y&catID=<?=$catid?>">Y</a></span><span class="sp">|</span>
                                                            <span><a href="managecat.php?order=Z&catID=<?=$catid?>">Z</a></span>
                                                        </form>
                                                    </div>
                                                    <?php if(!$total) { ?>
                                                    <ul class="system_messages">
                                                        <li class="blue"><span class="ico"></span><strong class="system_title">No Category To Display</strong></li>
                                                    </ul>
                                                        <?php }else {?>
                                                    <div  id="product_list">
                                                        <!--[if !IE]>start table_wrapper<![endif]-->
                                                        <div class="table_wrapper">
                                                            <div class="table_wrapper_inner">

                                                                <table cellpadding="0" cellspacing="0" width="100%">
                                                                    <tbody>
                                                                        <tr>
                                                                            <th>Category Title</th>
                                                                            <th style="width: 65px;">Products</th>
                                                                            <th style="width: 64px;">Status</th>
                                                                                <?php if($SubCat!="Home") {?>
                                                                            <th style="width: 120px;">Action</th>
                                                                                    <?php } ?>
                                                                        </tr>
                                                                            <?php
                                                                            for($i=0;$i<$total;$i++) {
                                                                                $row = db_fetch_object($result);
                                                                                $id=$row->categoryID;
                                                                                $name = $row->name;
                                                                                $products = $row->products_count;
                                                                                $logo = $row->picture;
                                                                                $status = $row->status;
                                                                                $parentsyes[]=$id;
                                                                                if(!in_array($ParentID,$parentsyes)) {
                                                                                    ?>
                                                                        <tr class="<?php echo ($i % 2!=0)?'first':'second'; ?>">
                                                                            <td class="product_name">
                                                                                            <?php echo $name!=""?$name:'&nbsp;'; ?>
                                                                            </td>
                                                                            <td style="width: 65px;">
                                                                                            <?php echo $products!=''?$products:'&nbsp;'; ?>
                                                                            </td>
                                                                            <td style="width: 64px;">
                                                                                            <?php if($status==1) {
                                                                                                echo "<font color='green'>Enable</font>";
                                                                                            }else {
                                                                                                echo "<font color='red'>Disable</font>";
                                                                                            } ?>
                                                                            </td>
                                                                            <td style="width: 120px;">
                                                                                <div class="actions_menu">
                                                                                    <ul>
                                                                                        <li>
                                                                                                        <?php if($count=="-2") { ?>
                                                                                            <a class="edit" href="addcategory.php?category_edit=<?=$id;?>">Edit</a>
                                                                                                            <?php }else {?>
                                                                                            <a class="edit" href="addcategory.php?category_edit=<?=$id;?>&tempnew=1">Edit</a>
                                                                                                            <?php }?>
                                                                                        </li>
                                                                                        <?php if($id!=1){?>
                                                                                        <li><a class="delete" href="addcategory.php?category_delete=<?=$id;?>">Delete</a></li>
                                                                                        <?php }?>
                                                                                    </ul>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                                    <?php }
                                                                            }
                                                                            ?>
                                                                    </tbody>
                                                                </table>

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
                                                            <li><a href="managecat.php?order=<?php echo $iid ?>&pgno=<?php echo $PrevPageNo; ?>&catID=<?=$catid?>" class="button light_blue_btn"><span><span>PREVIOUS</span></span></a> </li>
                                                                        <?php } ?>

                                                                    <?php
                                                                    $pageFrom=$PageNo-3<1?1:$PageNo-3;
                                                                    $pageTo=$PageNo+3>$totalpages?$totalpages:$PageNo+3;
                                                                    for($i=$pageFrom;$i<=$pageTo;$i++) {
                                                                        ?>
                                                                        <?php if($i==$PageNo) { ?>
                                                            <li><a href="managecat.php?order=<?php echo $iid ?>&pgno=<?php echo $i; ?>&catID=<?php echo $catid;?>" class="current_page"><span><span><?php echo $i; ?></span></span></a></li>
                                                                            <?php }else {?>
                                                            <li><a href="managecat.php?order=<?php echo $iid ?>&pgno=<?php echo $i; ?>&catID=<?php echo $catid;?>"><?php echo $i; ?></a></li>
                                                                            <?php }
                                                                    }
                                                                    ?>
                                                                    <?php
                                                                    if($PageNo<$totalpages) {
                                                                        $NextPageNo = 	$PageNo + 1;
                                                                        ?>
                                                            <li><a href="managecat.php?order=<?php echo $iid ?>&pgno=<?php echo $NextPageNo;?>&catID=<?=$catid?>" class="button light_blue_btn"><span><span>NEXT</span></span></a> </li>
                                                                        <?php } ?>
                                                        </ul>

                                                    </div>
                                                    <!--[if !IE]>end pagination<![endif]-->
                                                            <?php }?>
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