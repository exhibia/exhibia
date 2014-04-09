<?php
session_start();
$active="Users";
include_once 'security.php';
include_once "admin.config.inc.php";
include_once '../data/coupon.php';
include("functions.php");


$PRODUCTSPERPAGE=20;

if(!$_REQUEST['order'])
    $iid = "";
else
    $iid = $_REQUEST['order'];
if(!$_GET['pgno']) {
    $PageNo = 1;
}
else {
    $PageNo = $_GET['pgno'];
}
//     Get how many products  are to be displayed according to the  Events

$StartRow =   $PRODUCTSPERPAGE * ($PageNo-1);

$status='';
if(isset($_REQUEST['status'])) {
    $status=$_REQUEST['status'];
}

$coupondb=new Coupon(null);
$totalrows=$coupondb->countUniversal($iid,$status);
$totalpages=ceil($totalrows/$PRODUCTSPERPAGE);

$result=$coupondb->selectUniversal($iid, $StartRow, $PRODUCTSPERPAGE,$status);
$total=db_num_rows($result);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="imagetoolbar" content="no" />
        <title>List Universal-<?php echo $ADMIN_MAIN_SITE_NAME ?></title>
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
            function Submitform()
            {
                document.form1.submit();
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
                                <h2>List Universal Coupon</h2>
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
                                                    <form id="form1" name="form1" action="listuniversalcoupon.php" method="post">
                                                        <div class="categoryorder">
                                                            <span style="float:left;margin-right:40px;">
                                                                <span><a href="listuniversalcoupon.php">All</a></span><span class="sp">|</span>
                                                                <span><a href="listuniversalcoupon.php?order=A&status=<?php echo $status;?>">A</a></span><span class="sp">|</span>
                                                                <span><a href="listuniversalcoupon.php?order=B&status=<?php echo $status;?>">B</a></span><span class="sp">|</span>
                                                                <span><a href="listuniversalcoupon.php?order=C&status=<?php echo $status;?>">C</a></span><span class="sp">|</span>
                                                                <span><a href="listuniversalcoupon.php?order=D&status=<?php echo $status;?>">D</a></span><span class="sp">|</span>
                                                                <span><a href="listuniversalcoupon.php?order=E&status=<?php echo $status;?>">E</a></span><span class="sp">|</span>
                                                                <span><a href="listuniversalcoupon.php?order=F&status=<?php echo $status;?>">F</a></span><span class="sp">|</span>
                                                                <span><a href="listuniversalcoupon.php?order=G&status=<?php echo $status;?>">G</a></span><span class="sp">|</span>
                                                                <span><a href="listuniversalcoupon.php?order=H&status=<?php echo $status;?>">H</a></span><span class="sp">|</span>
                                                                <span><a href="listuniversalcoupon.php?order=I&status=<?php echo $status;?>">I</a></span><span class="sp">|</span>
                                                                <span><a href="listuniversalcoupon.php?order=J&status=<?php echo $status;?>">J</a></span><span class="sp">|</span>
                                                                <span><a href="listuniversalcoupon.php?order=K&status=<?php echo $status;?>">K</a></span><span class="sp">|</span>
                                                                <span><a href="listuniversalcoupon.php?order=L&status=<?php echo $status;?>">L</a></span><span class="sp">|</span>
                                                                <span><a href="listuniversalcoupon.php?order=M&status=<?php echo $status;?>">M</a></span><span class="sp">|</span>
                                                                <span><a href="listuniversalcoupon.php?order=N&status=<?php echo $status;?>">N</a></span><span class="sp">|</span>
                                                                <span><a href="listuniversalcoupon.php?order=O&status=<?php echo $status;?>">O</a></span><span class="sp">|</span>
                                                                <span><a href="listuniversalcoupon.php?order=P&status=<?php echo $status;?>">P</a></span><span class="sp">|</span>
                                                                <span><a href="listuniversalcoupon.php?order=Q&status=<?php echo $status;?>">Q</a></span><span class="sp">|</span>
                                                                <span><a href="listuniversalcoupon.php?order=R&status=<?php echo $status;?>">R</a></span><span class="sp">|</span>
                                                                <span><a href="listuniversalcoupon.php?order=S&status=<?php echo $status;?>">S</a></span><span class="sp">|</span>
                                                                <span><a href="listuniversalcoupon.php?order=T&status=<?php echo $status;?>">T</a></span><span class="sp">|</span>
                                                                <span><a href="listuniversalcoupon.php?order=U&status=<?php echo $status;?>">U</a></span><span class="sp">|</span>
                                                                <span><a href="listuniversalcoupon.php?order=V&status=<?php echo $status;?>">V</a></span><span class="sp">|</span>
                                                                <span><a href="listuniversalcoupon.php?order=W&status=<?php echo $status;?>">W</a></span><span class="sp">|</span>
                                                                <span><a href="listuniversalcoupon.php?order=X&status=<?php echo $status;?>">X</a></span><span class="sp">|</span>
                                                                <span><a href="listuniversalcoupon.php?order=Y&status=<?php echo $status;?>">Y</a></span><span class="sp">|</span>
                                                                <span><a href="listuniversalcoupon.php?order=Z&status=<?php echo $status;?>">Z</a></span>
                                                            </span>
                                                            <span>
                                                                <strong>Coupon Status:</strong>
                                                                <select name="status" onchange="Submitform();">
                                                                    <option value="" <?php if($status=="") {?> selected="selected"<?php } ?>>All</option>
                                                                    <option value="1" <?php if($status=="1") {?> selected="selected"<?php } ?>>Usable</option>
                                                                    <option value="2" <?php if($status=="2") {?>selected="selected"<?php } ?>>Overdue</option>
                                                                </select>
                                                            </span>
                                                        </div>
                                                    </form>
                                                    <?php if(!$total) { ?>
                                                    <ul class="system_messages">
                                                        <li class="blue"><span class="ico"></span><strong class="system_title">No Coupon To Display</strong></li>
                                                    </ul>
                                                        <?php }else {?>
                                                    <div  id="product_list">
                                                        <!--[if !IE]>start table_wrapper<![endif]-->
                                                        <div class="table_wrapper">
                                                            <div class="table_wrapper_inner">

                                                                <table cellpadding="0" cellspacing="0" width="100%">
                                                                    <tbody>
                                                                        <tr>
                                                                            <th style="width:300px;">Title</th>
                                                                            <th style="text-align:center;">Discount</th>
                                                                            <th style="text-align:center;">Free bids</th>
                                                                            <th style="text-align:center;">Assigned</th>                                                                            
                                                                            <th style="text-align:center;">Useful life</th>
                                                                            <th style="text-align:center;">Coupon Code</th>
                                                                            <!--
                                                                            <th style="text-align:center;width: 180px;">Action</th>
                                                                            -->
                                                                        </tr>
                                                                            <?php
                                                                            for($i=0;$i<$total;$i++) {
                                                                                $row = db_fetch_object($result);
                                                                                $id=$row->id;
                                                                                $title=$row->title;
                                                                                $discount=$row->discount;
                                                                                $freebids=$row->freebids;
                                                                                $assigned=$row->assigned;
                                                                                $couponcode=$row->couponcode;
                                                                                $startdate=$row->startdate;
                                                                                $enddate=$row->enddate;
                                                                                ?>
                                                                        <tr class="<?php echo ($i % 2!=0)?'first':'second'; ?>">
                                                                            <td class="product_name">
                                                                                        <?php echo $title!=""?stripslashes($title):'&nbsp;'; ?>
                                                                            </td>
                                                                            <td style="text-align:center;">
                                                                                        <?php echo $discount.'%'; ?>
                                                                            </td>
                                                                            <td style="text-align:center;">
                                                                                        <?php echo $freebids; ?>
                                                                            </td>
                                                                            <td style="text-align:center;">
                                                                                        <?php echo $assigned?"<font color='green'>Yes</font>":"<font color='red'>No</font>"; ?>
                                                                            </td>                                                                           
                                                                            <td style="text-align:center;">
                                                                                        <?php if(strtotime($enddate)<=strtotime("-1 day")) { ?>
                                                                                <span style="color:red;"><?php echo arrangedate($startdate).' - '.arrangedate($enddate); ?></span>
                                                                                            <?php }else { ?>
                                                                                <span style="color:green;"><?php echo arrangedate($startdate).' - '.arrangedate($enddate); ?></span>
                                                                                            <?php }?>
                                                                            </td>
                                                                             <td style="text-align:center;">
                                                                                        <?php echo $couponcode; ?>
                                                                            </td>
                                                                            <?php /*?>
                                                                            <td style="text-align:center;">
                                                                                <div class="actions_menu" style="width:180px;">
                                                                                    <ul>
                                                                                                <?php if($assigned==false && strtotime($enddate)>strtotime("-1 day")) { ?>
                                                                                        <li>
                                                                                            <a class="edit" href="addcoupon.php?coupon_edit=<?=$id;?>">Edit</a>
                                                                                        </li>
                                                                                                    <?php } ?>

                                                                                                <?php if($assigned==false || strtotime($enddate)<=strtotime("-1 day")) { ?>
                                                                                        <li>
                                                                                            <a class="delete" href="addcoupon.php?coupon_delete=<?=$id;?>">Delete</a>
                                                                                        </li>
                                                                                                    <?php } ?>

                                                                                                <?php if($assigned==false && strtotime($enddate)>strtotime("-1 day")) { ?>
                                                                                        <li>
                                                                                            <a class="details" href="assigncoupon.php?coupon_assign=<?=$id;?>">Assign</a>
                                                                                        </li>
                                                                                                    <?php } ?>
                                                                                                <?php if($assigned==true && strtotime($enddate)>strtotime("-1 day")) { ?>
                                                                                        <li>
                                                                                            <a class="details" href="assigncoupon.php?coupon_assign=<?=$id;?>&pro=unassign">Unassign</a>
                                                                                        </li>
                                                                                                    <?php } ?>
                                                                                    </ul>
                                                                                </div>
                                                                            </td>
                                                                            <?php */ ?>
                                                                        </tr>
                                                                                <?php }
                                                                            db_free_result($result);
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
                                                            <li><a href="listuniversalcoupon.php?order=<?php echo $iid ?>&pgno=<?php echo $PrevPageNo; ?>&status=<?php echo $status;?>" class="button light_blue_btn"><span><span>PREVIOUS</span></span></a> </li>
                                                                        <?php } ?>

                                                                    <?php
                                                                    $pageFrom=$PageNo-3<1?1:$PageNo-3;
                                                                    $pageTo=$PageNo+3>$totalpages?$totalpages:$PageNo+3;
                                                                    for($i=$pageFrom;$i<=$pageTo;$i++) {
                                                                        ?>
                                                                        <?php if($i==$PageNo) { ?>
                                                            <li><a href="listuniversalcoupon.php?order=<?php echo $iid ?>&pgno=<?php echo $i; ?>&status=<?php echo $status;?>" class="current_page"><span><span><?php echo $i; ?></span></span></a></li>
                                                                            <?php }else {?>
                                                            <li><a href="listuniversalcoupon.php?order=<?php echo $iid ?>&pgno=<?php echo $i; ?>&status=<?php echo $status;?>"><?php echo $i; ?></a></li>
                                                                            <?php }
                                                                    }
                                                                    ?>
                                                                    <?php
                                                                    if($PageNo<$totalpages) {
                                                                        $NextPageNo = 	$PageNo + 1;
                                                                        ?>
                                                            <li><a href="listuniversalcoupon.php?order=<?php echo $iid ?>&pgno=<?php echo $NextPageNo;?>&status=<?php echo $status;?>" class="button light_blue_btn"><span><span>NEXT</span></span></a> </li>
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