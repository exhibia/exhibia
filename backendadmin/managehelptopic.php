<?
session_start();
$active="CMS";
include("connect.php");
include_once("admin.config.inc.php");
include("security.php");
include("config_setting.php");

$PRODUCTSPERPAGE = 10; 
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
/***********************************************/
if($order!="") {
    $query = "select * from helptopic where topic_title like '$order%' order by topic_title";
}
else {
    $query = "select * from helptopic order by topic_title";
}
$result=db_query($query) or die (db_error());
$totalrows=db_num_rows($result);
$totalpages=ceil($totalrows/$PRODUCTSPERPAGE);
$query .= " LIMIT $StartRow,$PRODUCTSPERPAGE";
$result =db_query($query);
$total = db_num_rows($result);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="imagetoolbar" content="no" />
        <title>Manage Help Topics-<?php echo $ADMIN_MAIN_SITE_NAME ?></title>
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
                                <h2>Manage Help Topics</h2>
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
                                                        <form id="form1" name="form1" action="managehelptopic.php" method="post">
                                                            <span><a href="managehelptopic.php">All</a></span><span class="sp">|</span>
                                                            <span><a href="managehelptopic.php?order=A">A</a></span><span class="sp">|</span>
                                                            <span><a href="managehelptopic.php?order=B">B</a></span><span class="sp">|</span>
                                                            <span><a href="managehelptopic.php?order=C">C</a></span><span class="sp">|</span>
                                                            <span><a href="managehelptopic.php?order=D">D</a></span><span class="sp">|</span>
                                                            <span><a href="managehelptopic.php?order=E">E</a></span><span class="sp">|</span>
                                                            <span><a href="managehelptopic.php?order=F">F</a></span><span class="sp">|</span>
                                                            <span><a href="managehelptopic.php?order=G">G</a></span><span class="sp">|</span>
                                                            <span><a href="managehelptopic.php?order=H">H</a></span><span class="sp">|</span>
                                                            <span><a href="managehelptopic.php?order=I">I</a></span><span class="sp">|</span>
                                                            <span><a href="managehelptopic.php?order=J">J</a></span><span class="sp">|</span>
                                                            <span><a href="managehelptopic.php?order=K">K</a></span><span class="sp">|</span>
                                                            <span><a href="managehelptopic.php?order=L">L</a></span><span class="sp">|</span>
                                                            <span><a href="managehelptopic.php?order=M">M</a></span><span class="sp">|</span>
                                                            <span><a href="managehelptopic.php?order=N">N</a></span><span class="sp">|</span>
                                                            <span><a href="managehelptopic.php?order=O">O</a></span><span class="sp">|</span>
                                                            <span><a href="managehelptopic.php?order=P">P</a></span><span class="sp">|</span>
                                                            <span><a href="managehelptopic.php?order=Q">Q</a></span><span class="sp">|</span>
                                                            <span><a href="managehelptopic.php?order=R">R</a></span><span class="sp">|</span>
                                                            <span><a href="managehelptopic.php?order=S">S</a></span><span class="sp">|</span>
                                                            <span><a href="managehelptopic.php?order=T">T</a></span><span class="sp">|</span>
                                                            <span><a href="managehelptopic.php?order=U">U</a></span><span class="sp">|</span>
                                                            <span><a href="managehelptopic.php?order=V">V</a></span><span class="sp">|</span>
                                                            <span><a href="managehelptopic.php?order=W">W</a></span><span class="sp">|</span>
                                                            <span><a href="managehelptopic.php?order=X">X</a></span><span class="sp">|</span>
                                                            <span><a href="managehelptopic.php?order=Y">Y</a></span><span class="sp">|</span>
                                                            <span><a href="managehelptopic.php?order=Z">Z</a></span>
                                                        </form>
                                                    </div>
                                                    <div  id="product_list">
                                                        <!--[if !IE]>start table_wrapper<![endif]-->
                                                        <div class="table_wrapper">
                                                            <div class="table_wrapper_inner">
                                                                <?php if($total<=0) { ?>
                                                                <ul class="system_messages">
                                                                    <li class="blue"><span class="ico"></span><strong class="system_title">No help topics To Display</strong></li>
                                                                </ul>
                                                                    <?php }else {?>
                                                                <table cellpadding="0" cellspacing="0" width="100%">
                                                                    <tbody>
                                                                        <tr>
                                                                            <th style="text-align: center;width:20px;">No</th>
                                                                            <th>Title</th>
                                                                            <th style="text-align: center;width: 120px;">Action</th>
                                                                        </tr>
                                                                            <?
                                                                            for($i=0;$i<$total;$i++) {
                                                                                if($PageNo>1) {
                                                                                    $srno = ($PageNo-1)*$PRODUCTSPERPAGE+$i+1;
                                                                                }
                                                                                else {
                                                                                    $srno = $i+1;
                                                                                }

                                                                                $row = db_fetch_object($result);
                                                                                $id=$row->topic_id;
                                                                                $title=$row->topic_title;

                                                                                ?>
                                                                        <tr class="<?php echo ($i % 2!=0)?'first':'second'; ?>">
                                                                            <td style="text-align: center;"><?=$srno;?></td>
                                                                            <td class="product_name"><?=$title?></td>
                                                                            <td style="text-align: center;">
                                                                                <div class="actions_menu">
                                                                                    <ul>
                                                                                        <li>
                                                                                            <a class="edit" href="addhelptopic.php?help_edit=<?=$id;?>">Edit</a>
                                                                                        </li>
                                                                                        <li>
                                                                                            <a name="button" class="delete" href="addhelptopic.php?help_delete=<?=$id;?>">Delete</a>
                                                                                        </li>
                                                                                    </ul>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                                <?php }
                                                                            ?>
                                                                    </tbody>
                                                                </table>
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
                                                            <li><a href="managehelptopic.php?order=<?php echo $iid ?>&pgno=<?php echo $PrevPageNo; ?>" class="button light_blue_btn"><span><span>PREVIOUS</span></span></a> </li>
                                                                    <?php } ?>

                                                                <?php
                                                                $pageFrom=$PageNo-3<1?1:$PageNo-3;
                                                                $pageTo=$PageNo+3>$totalpages?$totalpages:$PageNo+3;
                                                                for($i=$pageFrom;$i<=$pageTo;$i++) {
                                                                    ?>
                                                                    <?php if($i==$PageNo) { ?>
                                                            <li><a href="managehelptopic.php?order=<?php echo $iid ?>&pgno=<?php echo $i;?>" class="current_page"><span><span><?php echo $i; ?></span></span></a></li>
                                                                        <?php }else {?>
                                                            <li><a href="managehelptopic.php?order=<?php echo $iid ?>&pgno=<?php echo $i;?>"><?php echo $i; ?></a></li>
                                                                        <?php }
                                                                }
                                                                ?>
                                                                <?php
                                                                if($PageNo<$totalpages) {
                                                                    $NextPageNo = 	$PageNo + 1;
                                                                    ?>
                                                            <li><a href="managehelptopic.php?order=<?php echo $iid ?>&pgno=<?php echo $NextPageNo;?>" class="button light_blue_btn"><span><span>NEXT</span></span></a> </li>
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