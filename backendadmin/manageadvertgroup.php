<?
session_start();
$active = "Admin User";
include("connect.php");
include_once("admin.config.inc.php");
include("security.php");
include("config_setting.php");
include("functions.php");
include '../data/advertgroup.php';

if (!$_GET['pgno']) {
    $PageNo = 1;
} else {
    $PageNo = $_GET['pgno'];
}
/********************************************************************
 Get how many products  are to be displayed according to the  Events
******************************************************************* */
$StartRow = $PRODUCTSPERPAGE * ($PageNo - 1);
/********************************************** */

$adgroupdb = new AdvertGroup(null);

$totalrows = $adgroupdb->count();
$totalpages = ceil($totalrows / $PRODUCTSPERPAGE);

$result = $adgroupdb->selectLimit($StartRow, $PRODUCTSPERPAGE);
$total = db_num_rows($result);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="imagetoolbar" content="no" />
        <title>Manage Advertise Group-<?php echo $ADMIN_MAIN_SITE_NAME ?></title>
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
                                                <h2>Manage Advertise Group</h2>
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
                                                                <?php if ($total<=0) { ?>
                                                                                                                                <ul class="system_messages">
                                                                                                                                    <li class="blue"><span class="ico"></span><strong class="system_title">No News To Display</strong></li>
                                                                                                                                </ul>
                                                                <?php } else { ?>
                                                                                                                                <table cellpadding="0" cellspacing="0" width="100%">
                                                                                                                                    <tbody>
                                                                                                                                        <tr>
                                                                                                                                            <th style="text-align:center;width:20px;">No</th>
                                                                                                                                            <th>Name</th>
                                                                                                                                            <th  style="text-align:center;">Width</th>
                                                                                                                                            <th  style="text-align:center;">Height</th>
                                                                                                                                            <th style="text-align:center;">Delay</th>
                                                                                                                                            <th style="text-align:center;">Effect</th>
                                                                                                                                            <th style="text-align:center;">Status</th>
                                                                                                                                            <th>Position</th>

                                                                                                                                            <th style="text-align:center;width:130px;">Action</th>
                                                                                                                                        </tr>
                                                                        <?php
                                                                        for ($i = 0; $i < $total; $i++) {
                                                                            if ($PageNo > 1) {
                                                                                $srno = ($PageNo - 1) * $PRODUCTSPERPAGE + $i + 1;
                                                                            } else {
                                                                                $srno = $i + 1;
                                                                            }

                                                                            $row = db_fetch_object($result);
                                                                        ?>
                                                                                                                                                <tr class="<?php echo ($i % 2!=0) ? 'first' : 'second'; ?>">
                                                                                                                                                    <td style="text-align:center;"><?php echo $srno; ?></td>
                                                                                                                                                    <td class="product_name"><?php echo stripslashes($row->name); ?></td>
                                                                                                                                                    <td style="text-align:center;"><?php echo $row->width; ?></td>
                                                                                                                                                    <td style="text-align:center;"><?php echo $row->height ?></td>
                                                                                                                                                    

                                                                                                                                                            <td style="text-align:center;"><?php echo $row->delay ?></td>
                                                                                                                                                            <td style="text-align:center;"><?php echo $row->effect ?></td>
                                                                                                                                                            <td style="text-align:center;">
                                                                                                                                                                <?php if($row->actived==1){ ?>
                                                                                                                                                                <span class="greenfont">Enable</span>
                                                                                                                                                                <?php }else{?>
                                                                                                                                                                <span class="redfont">Disable</span>
                                                                                                                                                                <?php }?>
                                                                                                                                                            </td>
                                                                                                                                                            <td><?php echo $row->position ?></td>

                                                                                                                                                            <td style="text-align: center;">
                                                                                                                                                                <div class="actions_menu">
                                                                                                                                                                    <ul>
                                                                                                                                                                        <li>
                                                                                                                                                                            <a class="edit" href="addadvertgroup.php?group_edit=<?php echo $row->id; ?>">Edit</a>
                                                                                                                                                                        </li>
                                                                                        <?php if ($id!=1) { ?>
                                                                                                                                                                                <li>
                                                                                                                                                                                    <a class="delete" href="addadvertgroup.php?group_delete=<?php echo $row->id; ?>">Delete</a>
                                                                                                                                                                                </li>

                                                                                                                                                                        
                                                                                        <?php } ?>
                                                                                                                                                                            </ul>
                                                                                                                                                                    <ul>
                                                                                                                                                                         <li>
                                                                                                                                                                                    <a class="edit" href="manageadvertslide.php?gid=<?php echo $row->id; ?>">Slide(<?php echo $row->slidecount; ?>)</a>
                                                                                                                                                                                </li>
                                                                                                                                                                    </ul>
                                                                                                                                                                        </div>
                                                                                                                                                                    </td>
                                                                                                                                                                </tr>
                                                                        <?php } ?>
                                                                                                                                            </tbody>
                                                                                                                                        </table>
                                                                <?php } ?>
                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                        <!--[if !IE]>end table_wrapper<![endif]-->
                                                                                                                    </div>

                                                    <?php if ($total) { ?>
                                                                                                        <!--[if !IE]>start pagination<![endif]-->
                                                                                                        <div class="pagination">
                                                                                                            <span class="page_no">Page <?php echo $PageNo; ?> of <?php echo $totalpages; ?></span>
                                                                                                            <ul class="pag_list">
                                                            <?php
                                                            if ($PageNo > 1) {
                                                                $PrevPageNo = $PageNo - 1;
                                                            ?>
                                                                                                                        <li><a href="manageadvertgroup.php?pgno=<?php echo $PrevPageNo; ?>" class="button light_blue_btn"><span><span>PREVIOUS</span></span></a> </li>
                                                            <?php } ?>

                                                            <?php
                                                            $pageFrom = $PageNo - 3 < 1 ? 1 : $PageNo - 3;
                                                            $pageTo = $PageNo + 3 > $totalpages ? $totalpages : $PageNo + 3;
                                                            for ($i = $pageFrom; $i<=$pageTo; $i++) {
                                                            ?>
                                                            <?php if ($i==$PageNo) { ?>
                                                                                                                        <li><a href="manageadvertgroup.php?pgno=<?php echo $i; ?>" class="current_page"><span><span><?php echo $i; ?></span></span></a></li>
                                                            <?php } else { ?>
                                                                                                                        <li><a href="manageadvertgroup.php?pgno=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                                                            <?php
                                                        }
                                                    }
                                                            ?>
                                                            <?php
                                                            if ($PageNo < $totalpages) {
                                                                $NextPageNo = $PageNo + 1;
                                                            ?>
                                                                                                                        <li><a href="manageadvertgroup.php?pgno=<?php echo $NextPageNo; ?>" class="button light_blue_btn"><span><span>NEXT</span></span></a> </li>
                                                            <?php } ?>
                                                                                                                    </ul>

                                                                                                                </div>
                                                                                                                <!--[if !IE]>end pagination<![endif]-->
                                                    <?php } ?>

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