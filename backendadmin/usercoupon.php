<?php
session_start();
$active="Database";
include_once 'security.php';
include_once "admin.config.inc.php";

include_once '../data/usercoupon.php';
include_once '../data/registration.php';
include("functions.php");


$PRODUCTSPERPAGE=20;

if(!isset($_GET['memberid'])){
    header("location:manage_members.php");
    exit;
}

$memberid=$_GET['memberid'];

$ucdb=new UserCoupon(null);

if(isset($_GET['coupon_delete'])){
    $upid=$_GET['coupon_delete'];
    $ucdb->delete($upid);
}

$regdb=new Registration(null);
$regresult=$regdb->selectById($memberid);
$reg=db_fetch_object($regresult);
$username=$reg->username;

if(!$_GET['pgno']) {
    $PageNo = 1;
}
else {
    $PageNo = $_GET['pgno'];
}
//     Get how many products  are to be displayed according to the  Events

$StartRow =   $PRODUCTSPERPAGE * ($PageNo-1);


$totalrows=$ucdb->count($memberid);

$totalpages=ceil($totalrows/$PRODUCTSPERPAGE);

$result=$ucdb->selectByUser($memberid, $StartRow, $PRODUCTSPERPAGE);
$total=db_num_rows($result);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="imagetoolbar" content="no" />
        <title><?php echo $username;?>s Coupon-<?php echo $ADMIN_MAIN_SITE_NAME ?></title>
        <link media="screen" rel="stylesheet" type="text/css" href="css/admin.css"  />
        <!--[if lte IE 6]><link media="screen" rel="stylesheet" type="text/css" href="css/admin-ie.css" /><![endif]-->
        <script type="text/javascript" src="js/behaviour.js"></script>
        <script type="text/javascript">
           
            function delconfirm(loc)
            {
                if(confirm("Are you Sure Do You Want To Delete"))
                {
                    window.location.href=loc;
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
                                <h2><?php echo $username;?>'s Coupon</h2>
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
                                                        <span class="button send_form_btn"><span><span>Assign New Coupon To <?php echo $username;?></span></span><input name="submit" type="button" onclick="window.location.href='assigncoupontouser.php?memberid=<?php echo $memberid ?>'" /></span>
                                                        <div class="clear"></div>
                                                    </div>
                                                   
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
                                                                            <th style="text-align:center;">Is Universal</th>
                                                                            <th style="text-align:center;">Useful life</th>
                                                                            <th style="text-align:center;width: 180px;">Action</th>
                                                                        </tr>
                                                                            <?php
                                                                            for($i=0;$i<$total;$i++) {
                                                                                $row = db_fetch_object($result);
                                                                                $id=$row->id;
                                                                                $title=$row->title;
                                                                                $discount=$row->discount;
                                                                                $freebids=$row->freebids;
                                                                                $isuniversal=$row->isuniversal;
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
                                                                                        <?php echo $isuniversal?"<font color='green'>Yes</font>":"<font color='red'>No</font>"; ?>
                                                                            </td>
                                                                            <td style="text-align:center;">
                                                                                        <?php if(strtotime($enddate)<=strtotime("-1 day")) { ?>
                                                                                <span style="color:red;"><?php echo arrangedate($startdate).' - '.arrangedate($enddate); ?></span>
                                                                                            <?php }else { ?>
                                                                                <span style="color:green;"><?php echo arrangedate($startdate).' - '.arrangedate($enddate); ?></span>
                                                                                            <?php }?>
                                                                            </td>
                                                                            <td style="text-align:center;">
                                                                                <div class="actions_menu">
                                                                                    <ul>                                                                                               
                                                                                        <li>
                                                                                            <a class="delete" onclick="delconfirm('usercoupon.php?coupon_delete=<?=$id;?>&memberid=<?php echo $memberid ?>');" href="">Delete</a>
                                                                                        </li>                                                                                               
                                                                                    </ul>
                                                                                </div>
                                                                            </td>
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
                                                            <li><a href="usercoupon.php?pgno=<?php echo $PrevPageNo; ?>&memberid=<?php echo $memberid;?>" class="button light_blue_btn"><span><span>PREVIOUS</span></span></a> </li>
                                                                        <?php } ?>

                                                                    <?php
                                                                    $pageFrom=$PageNo-3<1?1:$PageNo-3;
                                                                    $pageTo=$PageNo+3>$totalpages?$totalpages:$PageNo+3;
                                                                    for($i=$pageFrom;$i<=$pageTo;$i++) {
                                                                        ?>
                                                                        <?php if($i==$PageNo) { ?>
                                                            <li><a href="usercoupon.php?pgno=<?php echo $i; ?>&memberid=<?php echo $memberid;?>" class="current_page"><span><span><?php echo $i; ?></span></span></a></li>
                                                                            <?php }else {?>
                                                            <li><a href="usercoupon.php?pgno=<?php echo $i; ?>&memberid=<?php echo $memberid;?>"><?php echo $i; ?></a></li>
                                                                            <?php }
                                                                    }
                                                                    ?>
                                                                    <?php
                                                                    if($PageNo<$totalpages) {
                                                                        $NextPageNo = 	$PageNo + 1;
                                                                        ?>
                                                            <li><a href="usercoupon.php?pgno=<?php echo $NextPageNo;?>&memberid=<?php echo $memberid;?>" class="button light_blue_btn"><span><span>NEXT</span></span></a> </li>
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