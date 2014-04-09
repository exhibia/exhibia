<?php

/* * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include("connect.php");
include("security.php");
include_once('functions.php');
include_once('../data/registration.php');
include_once('../data/avatar.php');
$active="Users";
if (isset($_GET['userid'])) {
    $userid = chkInput($_GET['userid'], 'i');

    if (isset($_GET['avatarid'])) {
        $avatartid = chkInput($_GET['avatarid'], 'i');
        $regdb = new Registration(null);
        $regdb->setUserAvatar($userid, $avatartid);
    }

    $regdb = new Registration(null);
    $regresult = $regdb->selectById($userid);
    $regobj = db_fetch_object($regresult);

    $userAvatarid = $regobj->avatarid;
    //$regdb->setUserAvatar($uid, $avatarid);
    $avatardb = new Avatar(null);
    $avatarresult = $avatardb->selectAll();
} else {
    header('location: managebiddinguser.php');
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="imagetoolbar" content="no" />
        <title>Manage Bidding Users-<?php echo $ADMIN_MAIN_SITE_NAME ?></title>
        <link media="screen" rel="stylesheet" type="text/css" href="css/admin.css"  />
        <!--[if lte IE 6]><link media="screen" rel="stylesheet" type="text/css" href="css/admin-ie.css" /><![endif]-->
        <script type="text/javascript" src="js/behaviour.js"></script>

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
                                <h2>Bidding User Avatar</h2>
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
                                                     <div class="avatarlist">
                                <?php while ($avatar = db_fetch_object($avatarresult)) { ?>
                                                                <div class="avatar_outter <?php echo $userAvatarid==$avatar->id?'selected':''; ?>">
                                                                    <a href="bidderuseravatar.php?avatarid=<?php echo $avatar->id;?>&userid=<?php echo $userid; ?>"><img alt="" src="../uploads/avatars/<?php echo $avatar->avatar; ?>"/></a>
                                                                </div>
                                <?php } ?>
                                                            </div>
                                                            <div class="clear"></div>
                                                  
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