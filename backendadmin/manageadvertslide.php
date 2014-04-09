<?
session_start();
$active="Admin User";
include("connect.php");
include_once("admin.config.inc.php");
include("security.php");
include("config_setting.php");
include("functions.php");
include_once('../data/advertslide.php');

if(isset($_REQUEST['gid'])){
    $gid=chkInput($_REQUEST['gid'],'i');

    $adsdb=new AdvertSlide(null);
    $result =$adsdb->selectByGroup($gid);
    $total = db_num_rows($result);

}else{
    header("location: manageadvertgroup.php");
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="imagetoolbar" content="no" />
        <title>Manage Advertise Slide-<?php echo $ADMIN_MAIN_SITE_NAME ?></title>
        <link media="screen" rel="stylesheet" type="text/css" href="css/admin.css"  />
        <!--[if lte IE 6]><link media="screen" rel="stylesheet" type="text/css" href="css/admin-ie.css" /><![endif]-->
        <link type="text/css" href="css/cupertino/ui.all.css" rel="stylesheet" />
        <link type="text/css" href="css/cupertino/jquery-ui-1.7.3.custom.css" rel="stylesheet" />

        <!--[if lte IE 6]><link media="screen" rel="stylesheet" type="text/css" href="css/admin-ie.css" /><![endif]-->
        <script type="text/javascript" src="js/behaviour.js"></script>
        <script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
        <script type="text/javascript" src="js/ui/jquery-ui-1.7.2.custom.min.js"></script>
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
                                <h2>Manage Advertise Slide</h2>
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
                                                                
                                                                <?php if($total<=0) { ?>
                                                                <ul class="system_messages">
                                                                    <li class="blue"><span class="ico"></span><strong class="system_title">No Advertise Slide To Display</strong></li>
                                                                </ul>
                                                                <div style="margin-left:20px;">
                                                                    <span class="button send_form_btn"><span><span>Add Advertise Slide</span></span><input name="addadvertslide" type="button" onclick="javascript: window.location.href='addadvertslide.php?gid=<?=$gid?>';" /></span>
                                                                    <div class="clear"></div>
                                                                </div>
                                                                    <?php }else {?>
                                                                <table cellpadding="0" cellspacing="0" width="100%">
                                                                    <tbody>
                                                                        <tr>
                                                                            <th style="width:20px;text-align:center;">No</th>
                                                                            <th style="text-align:center;">Image</th>
                                                                            <th style="text-align:center;">Url</th>                                                                            
                                                                            <th style="width:120px;text-align:center;">Action</th>
                                                                        </tr>
                                                                            <?php
                                                                            for($i=0;$i<$total;$i++) {
                                                                                $row = db_fetch_object($result);
                                                                                $id=$row->id;
                                                                                $image=$row->image;
                                                                                $url=$row->url;
                                                                                ?>
                                                                        <tr class="<?php echo ($i % 2!=0)?'first':'second'; ?>">
                                                                            <td class="alignCenter">
                                                                                        <?php if($i!="") {
                                                                                            echo $i+1;
                                                                                        }else {
                                                                                            echo "1";
                                                                                        } ?>
                                                                            </td>                                                                         
                                                                            <td style="text-align:center;">
                                                                                <img alt="" src="../uploads/advertise/<?php echo $image; ?>"/>
                                                                            </td>                                                                           
                                                                            <td style="text-align:center;"><?php echo $url;?></td>
                                                                            <td style="width: 120px;text-align:center;">
                                                                                <div class="actions_menu">
                                                                                    <ul>
                                                                                        <li>
                                                                                            <a class="edit" href="addadvertslide.php?slide_edit=<?php echo $id;?>&gid=<?php echo $gid; ?>">Edit</a>
                                                                                        </li>
                                                                                        <li>
                                                                                            <a class="delete" name="button" href="addadvertslide.php?slide_delete=<?php echo $id;?>&gid=<?php echo $gid; ?>">Delete</a>
                                                                                        </li>
                                                                                    </ul>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                                <?php }
                                                                            ?>
                                                                        <tr>
                                                                            <td>
                                                                                
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                                <div style="margin-left:20px;margin-top:20px;">
                                                                                    <span class="button send_form_btn"><span><span>Add Advertise Slide</span></span><input name="addadvertslide" type="button" onclick="javascript: window.location.href='addadvertslide.php?gid=<?=$gid?>';" /></span>
                                                                                    <div class="clear"></div>
                                                                                </div>
                                                                    <?php }?>
                                                                
                                                            </div>
                                                        </div>
                                                        <!--[if !IE]>end table_wrapper<![endif]-->
                                                    </div>

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