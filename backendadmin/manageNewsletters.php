<?php
session_start();
$active="CMS";
include("connect.php");
include_once("admin.config.inc.php");
include("security.php");
include("config_setting.php");
include("functions.php");

$PRODUCTSPERPAGE = 10;
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
$query = "select * from newsletter_email order by id";
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
        <title>Manage newsletter-<?php echo $ADMIN_MAIN_SITE_NAME ?></title>
        <link media="screen" rel="stylesheet" type="text/css" href="css/admin.css"  />
        <!--[if lte IE 6]><link media="screen" rel="stylesheet" type="text/css" href="css/admin-ie.css" /><![endif]-->
        <script type="text/javascript" src="js/behaviour.js"></script>
        <script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
        <script type="text/javascript" src="js/ui/jquery-ui-1.7.2.custom.min.js"></script>
	<script type="text/javascript" src="js/ui/ui.accordion.min.js"></script>

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
                                <h2>Manage newsletter</h2>
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
                                                                <?php if(!$total) { ?>
                                                                <ul class="system_messages">
                                                                    <li class="blue"><span class="ico"></span><strong class="system_title">No newsletters To Display</strong></li>
                                                                </ul>
                                                                    <?php }else {?>
                                                                <table cellpadding="0" cellspacing="0" width="100%">
                                                                    <tbody>
                                                                        <tr>
                                                                            <th style="width:20px" class="alignCenter">No</th>
                                                                            <th>Date</th>
                                                                            <th>Subject</th>
                                                                            <th>Content</th>
                                                                            <th style="width:140px;text-align: center;">Action</th>
                                                                        </tr>
                                                                            <?php
                                                                            for($i=0;$i<$total;$i++) {
                                                                                if($PageNo>1) {
                                                                                    $srno = ($PageNo-1)*$PRODUCTSPERPAGE+$i+1;
                                                                                }
                                                                                else {
                                                                                    $srno = $i+1;
                                                                                }

                                                                                $row = db_fetch_object($result);
                                                                                $id=$row->id;
                                                                                $subject=$row->subject;
                                                                                $newsdate=$row->date;
                                                                                $newscontent=$row->content;
                                                                                ?>
                                                                        <tr class="<?php echo ($i % 2!=0)?'first':'second'; ?>">
                                                                            <td class="alignCenter"><?=$srno;?></td>
                                                                            <td><?=arrangedate($newsdate);?></td>
                                                                            <td><?=stripslashes($subject)?></td>
                                                                            <td><?=$newscontent!=""?stripslashes(substr($newscontent,0,150)):"&nbsp;";?></td>
                                                                            <td align="center">
                                                                                <div class="actions_menu">
                                                                                    <ul>
                                                                                        <li>
                                                                                            <a name="button" class="edit" href="newsletter.php?newsletter_resend=<?=$id;?>">Resend</a>                                                                                            
                                                                                        </li>
                                                                                        <li>
                                                                                            <a name="button" class="delete" href="newsletter.php?newsletter_delete=<?=$id;?>">Delete</a>
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
                                                            <li><a href="manageNewsletters.php?pgno=<?php echo $PrevPageNo; ?>" class="button light_blue_btn"><span><span>PREVIOUS</span></span></a> </li>
                                                                    <?php } ?>

                                                                <?php
                                                                $pageFrom=$PageNo-3<1?1:$PageNo-3;
                                                                $pageTo=$PageNo+3>$totalpages?$totalpages:$PageNo+3;
                                                                for($i=$pageFrom;$i<=$pageTo;$i++) {
                                                                    ?>
                                                                    <?php if($i==$PageNo) { ?>
                                                            <li><a href="manageNewsletters.php?pgno=<?php echo $i;?>" class="current_page"><span><span><?php echo $i; ?></span></span></a></li>
                                                                        <?php }else {?>
                                                            <li><a href="manageNewsletters.php?pgno=<?php echo $i;?>"><?php echo $i; ?></a></li>
                                                                        <?php }
                                                                }
                                                                ?>
                                                                <?php
                                                                if($PageNo<$totalpages) {
                                                                    $NextPageNo = 	$PageNo + 1;
                                                                    ?>
                                                            <li><a href="manageNewsletters.php?pgno=<?php echo $NextPageNo;?>" class="button light_blue_btn"><span><span>NEXT</span></span></a> </li>
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