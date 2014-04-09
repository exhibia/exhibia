<?
session_start();
$active="Users";
include("connect.php");
include("security.php");

include_once('../common/sitesetting.php');

if($_REQUEST['order']) {
    $order=$_REQUEST['order'];
}

if(!$_GET['pgno']) {
    $PageNo = 1;
}
else {
    $PageNo = $_GET['pgno'];
}

if($order) {
    $sql="select username,firstname,lastname,email,final_bids,free_bids,registration.id as id,avatar.id as aid,avatar from registration join avatar on avatar.id = registration.avatarid where admin_user_flag='1' and user_delete_flag!='d' and username like '$order%' order by id";
}
else {
    $sql="select username,firstname,lastname,email,final_bids,free_bids,registration.id as id,avatar.id as aid,avatar from registration join avatar on avatar.id = registration.avatarid where admin_user_flag='1' and user_delete_Flag!='d' order by id";
}
$PRODUCTSPERPAGE=20;
$result=db_query($sql) or die(db_error());
$total=db_num_rows($result);
$totalpage=ceil($total/$PRODUCTSPERPAGE);
if($totalpage>=1) {
    $startrow=$PRODUCTSPERPAGE*($PageNo-1);
    $sql.=" LIMIT $startrow,$PRODUCTSPERPAGE";
    $result=db_query($sql);
    $total=db_num_rows($result);
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
                                <h2>Manage Bidding Users</h2>
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
                                                        <form id="form1" name="form1" action="" method="post">
                                                            <span><a href="managebiddinguser.php">All</a></span><span class="sp">|</span>
                                                            <span><a href="managebiddinguser.php?order=A">A</a></span><span class="sp">|</span>
                                                            <span><a href="managebiddinguser.php?order=B">B</a></span><span class="sp">|</span>
                                                            <span><a href="managebiddinguser.php?order=C">C</a></span><span class="sp">|</span>
                                                            <span><a href="managebiddinguser.php?order=D">D</a></span><span class="sp">|</span>
                                                            <span><a href="managebiddinguser.php?order=E">E</a></span><span class="sp">|</span>
                                                            <span><a href="managebiddinguser.php?order=F">F</a></span><span class="sp">|</span>
                                                            <span><a href="managebiddinguser.php?order=G">G</a></span><span class="sp">|</span>
                                                            <span><a href="managebiddinguser.php?order=H">H</a></span><span class="sp">|</span>
                                                            <span><a href="managebiddinguser.php?order=I">I</a></span><span class="sp">|</span>
                                                            <span><a href="managebiddinguser.php?order=J">J</a></span><span class="sp">|</span>
                                                            <span><a href="managebiddinguser.php?order=K">K</a></span><span class="sp">|</span>
                                                            <span><a href="managebiddinguser.php?order=L">L</a></span><span class="sp">|</span>
                                                            <span><a href="managebiddinguser.php?order=M">M</a></span><span class="sp">|</span>
                                                            <span><a href="managebiddinguser.php?order=N">N</a></span><span class="sp">|</span>
                                                            <span><a href="managebiddinguser.php?order=O">O</a></span><span class="sp">|</span>
                                                            <span><a href="managebiddinguser.php?order=P">P</a></span><span class="sp">|</span>
                                                            <span><a href="managebiddinguser.php?order=Q">Q</a></span><span class="sp">|</span>
                                                            <span><a href="managebiddinguser.php?order=R">R</a></span><span class="sp">|</span>
                                                            <span><a href="managebiddinguser.php?order=S">S</a></span><span class="sp">|</span>
                                                            <span><a href="managebiddinguser.php?order=T">T</a></span><span class="sp">|</span>
                                                            <span><a href="managebiddinguser.php?order=I">U</a></span><span class="sp">|</span>
                                                            <span><a href="managebiddinguser.php?order=V">V</a></span><span class="sp">|</span>
                                                            <span><a href="managebiddinguser.php?order=W">W</a></span><span class="sp">|</span>
                                                            <span><a href="managebiddinguser.php?order=X">X</a></span><span class="sp">|</span>
                                                            <span><a href="managebiddinguser.php?order=Y">Y</a></span><span class="sp">|</span>
                                                            <span><a href="managebiddinguser.php?order=Z">Z</a></span>
                                                        </form>
                                                    </div>
                                                    <?php if($total==0) { ?>
                                                    <ul class="system_messages">
                                                        <li class="blue"><span class="ico"></span><strong class="system_title">No Bidding Users  To Display</strong></li>
                                                    </ul>
                                                        <?php }else {?>
                                                    <div  id="product_list">
                                                        <!--[if !IE]>start table_wrapper<![endif]-->
                                                        <div class="table_wrapper">
                                                            <div class="table_wrapper_inner">

                                                                <table cellpadding="0" cellspacing="0" width="100%">
                                                                    <tbody>
                                                                        <tr>
                                                                            <th>User Name</th>
                                                                            <?php if(Sitesetting::isEnableAvatar()){ ?>
                                                                            <th>Avatar</th>
                                                                            <?php } ?>
                                                                            <th>First Name</th>
                                                                            <th>Last Name</th>
                                                                            <th>Email</th>
                                                                            <th>Country</th>
                                                                            <th>Final Bids</th>
                                                                            <th>Free Bids</th>
                                                                            <th style="text-align:center;width:150px;">Options</th>
                                                                        </tr>
                                                                            <?php
                                                                            $colorflg=0;
                                                                            for($i=1;$i<=$total;$i++) {
                                                                                $row = db_fetch_object($result);
                                                                                if ($colorflg==1) {
                                                                                    $colorflg=0;
                                                                                }else {
                                                                                    $colorflg=1;
                                                                                }

                                                                                $qrycou1 = "select * from countries where countryID='".$row->country."'";
                                                                                $rescou1 = db_query($qrycou1);
                                                                                $objcou1 = db_fetch_object($rescou1);
                                                                                ?>
                                                                        <tr class="<?php echo ($colorflg==1)?'first':'second'; ?>">
                                                                            <td><?=$row->username!=""?$row->username:"&nbsp;";?></td>

                                                                            <?php if(Sitesetting::isEnableAvatar()){ ?>
                                                                            <td><a title="click to change avatar" href="bidderuseravatar.php?userid=<?=$row->id;?>"><img alt="" border="0" src="../uploads/avatars/<?php echo $row->avatar; ?>"/></a></td>
                                                                            <?php } ?>

                                                                            <td><?=$row->firstname!=""?$row->firstname:"&nbsp;";?></td>
                                                                            <td><?=$row->lastname!=""?$row->lastname:"&nbsp;";?></td>
                                                                            <td><?=$row->email!=""?$row->email:"&nbsp;";?></td>
                                                                            <td><?=$objcou1->printable_name!=""?$objcou1->printable_name:"&nbsp;";?></td>
                                                                            <td><?php echo $row->final_bids; ?></td>
                                                                            <td><?php echo $row->free_bids; ?></td>
                                                                            <td style="text-align:center;">
                                                                                <div class="actions_menu">
                                                                                    <ul>
                                                                                        <li>
                                                                                            <a class="edit" href="addbiddinguser.php?editid=<?=$row->id;?>">Edit</a>
                                                                                        </li>
                                                                                                <?php
                                                                                                if($row->id!="1") {
                                                                                                    ?>
                                                                                        <li>
                                                                                            <a class="delete" name="button" href="#"onClick="window.location.href='addbiddinguser.php?delid=<?=$row->id;?>'">Delete</a>
                                                                                        </li>
                                                                                                    <?php } ?>
                                                                                        
                                                                                    </ul>
                                                                                   
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                                <?php }
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
                                                        <span class="page_no">Page <?php echo $PageNo; ?> of <?php echo $totalpage; ?></span>
                                                        <ul class="pag_list">
                                                                    <?php
                                                                    if($PageNo>1) {
                                                                        $PrevPageNo = $PageNo-1;
                                                                        ?>
                                                            <li><a href="managebiddinguser.php?pgno=<?=$PrevPageNo; ?>&order=<?=$order?>" class="button light_blue_btn"><span><span>PREVIOUS</span></span></a> </li>
                                                                        <?php } ?>

                                                                    <?php
                                                                    $pageFrom=$PageNo-3<1?1:$PageNo-3;
                                                                    $pageTo=$PageNo+3>$totalpage?$totalpage:$PageNo+3;
                                                                    for($i=$pageFrom;$i<=$pageTo;$i++) {
                                                                        ?>
                                                                        <?php if($i==$PageNo) { ?>
                                                            <li><a href="managebiddinguser.php?pgno=<?=$i;?>&order=<?=$order?>" class="current_page"><span><span><?php echo $i; ?></span></span></a></li>
                                                                            <?php }else {?>
                                                            <li><a href="managebiddinguser.php?pgno=<?=$i;?>&order=<?=$order?>"><?php echo $i; ?></a></li>
                                                                            <?php }
                                                                    }
                                                                    ?>
                                                                    <?php
                                                                    if($PageNo<$totalpage) {
                                                                        $NextPageNo = 	$PageNo + 1;
                                                                        ?>
                                                            <li><a href="managebiddinguser.php?pgno=<?=$NextPageNo;?>&order=<?=$order?>" class="button light_blue_btn"><span><span>NEXT</span></span></a> </li>
                                                                        <?php } ?>
                                                        </ul>

                                                    </div>
                                                    <!--[if !IE]>end pagination<![endif]-->
                                                            <?php }?>
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