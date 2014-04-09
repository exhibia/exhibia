<?php
session_start();
$active="Database";
include_once 'security.php';
include_once "admin.config.inc.php";
include_once '../data/coupon.php';
include_once '../data/registration.php';
include_once '../data/usercoupon.php';
include("functions.php");

if(!isset($_REQUEST['memberid'])) {
    header("location: message.php?msg=106");
    exit;
}

$memberid=$_REQUEST['memberid'];
//logic for add edit and delete
if(isset($_POST['assign'])) {
    $ucdb=new UserCoupon(null);

    $coupondb=new Coupon(null);
    $query=$coupondb->selectAll(0);
    if($query!=false && db_num_rows($query)) {
        while($coupon=db_fetch_object($query)) {
            $couponid=$coupon->id;
            if($_POST['coupon_'.$couponid]) {
                $ucdb->assignSingle($memberid, $coupon->id);
            }
        }
        db_free_result($query);
    }
    header("location: message.php?msg=107");
    exit;

}


$userdb=new Registration(null);
$userResult=$userdb->selectById($memberid);

if($userResult==false || db_num_rows($userResult)<=0) {
    header("location: message.php?msg=106");
    exit;
}
$user=db_fetch_object($userResult);

$coupondb=new Coupon(null);
$couponResult=$coupondb->selectAll(0);

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="imagetoolbar" content="no" />
        <title>Assign coupon to user-<?php echo $ADMIN_MAIN_SITE_NAME ?></title>
        <link media="screen" rel="stylesheet" type="text/css" href="css/admin.css"  />
        <link type="text/css" href="css/cupertino/ui.all.css" rel="stylesheet" />
        <!--[if lte IE 6]><link media="screen" rel="stylesheet" type="text/css" href="css/admin-ie.css" /><![endif]-->
        <script type="text/javascript" src="validation.js"></script>
        <script type="text/javascript" src="js/behaviour.js"></script>
        <script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>     
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
                                <h2>
                                    Assign Coupon To User
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

                                                    <div class="categoryorder">
                                                        Please select the coupon assign to <strong><?php $user->username ?></strong>
                                                    </div>

                                                    <br/>
                                                    <!--[if !IE]>start forms<![endif]-->
                                                    <form id="form1" action="assigncoupontouser.php" method="post" class="search_form general_form">
                                                        <!--[if !IE]>start fieldset<![endif]-->
                                                        <fieldset>
                                                            <!--[if !IE]>start forms<![endif]-->
                                                            <div class="forms">

                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>&nbsp;</label>
                                                                    <div class="inputs">
                                                                        <ul class="inline">
                                                                            <?php while($coupon=db_fetch_object($couponResult)) { ?>
                                                                            <li>
                                                                                <input type="checkbox" id="coupon_<?php echo $coupon->id; ?>" class="checkbox" name="coupon_<?php echo $coupon->id; ?>" />&nbsp;
                                                                                    <?php echo $coupon->title." (Discount: ".$coupon->discount."   Free Points:".$coupon->freebids.")"; ?>
                                                                            </li>
                                                                                <?php }?>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->


                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <div class="buttons">
                                                                        <ul>
                                                                            <li>
                                                                                <span class="button send_form_btn"><span><span>Assign</span></span><input name="assign" type="submit"/></span>
                                                                                <input name="memberid" type="hidden" value="<?php echo $memberid; ?>"/>
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