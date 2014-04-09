<?php
session_start();
$active="Database";
include_once 'security.php';
include_once "admin.config.inc.php";
include_once '../data/coupon.php';
include_once '../data/usercoupon.php';
include_once '../data/registration.php';
include("functions.php");

if($_GET['coupon_assign']!='') {
    if($_GET['pro']=='') {
        $id=$_GET['coupon_assign'];
        $coupondb=new Coupon(null);
        $result=$coupondb->selectById($id);
        if($result!=FALSE && db_num_rows($result)>0) {
            $coupon=db_fetch_object($result);
            db_free_result($result);
            if($coupon->assigned==false && strtotime($coupon->enddate) > strtotime("-1 day")) {
                $reg=new Registration(null);
                $users=$reg->getAllUser();
                $userCoupondb=new UserCoupon(null);
                if($userCoupondb->assign($users, $coupon->id, $coupon->isuniversal,$coupon->couponcode)) {
                    header("location: message.php?msg=103");
                    exit;
                }else {
                    header("location: message.php?msg=102");
                    exit;
                }
            }else {
                header("location: message.php?msg=102");
                exit;
            }
        }else {
            header("location: message.php?msg=102");
            exit;
        }
    }else if($_GET['pro']=='unassign') {
        $id=$_GET['coupon_assign'];
        $coupondb=new Coupon(null);
        $result=$coupondb->selectById($id);
        if($result!=FALSE && db_num_rows($result)>0) {
            $coupon=db_fetch_object($result);
            db_free_result($result);
            if($coupon->assigned==true) {
                $userCoupondb=new UserCoupon(null);
                $userCoupondb->unAssign($coupon->id);
                header("location: message.php?msg=104");
                exit;
            }else {
                header("location: message.php?msg=105");
                exit;
            }
        }else {
            header("location: message.php?msg=105");
            exit;
        }
    }else {
        header("location: message.php?msg=102");
        exit;
    }
}else {
    header("location: message.php?msg=102");
    exit;
}
?>
