<?
session_start();
$active="Users";
include("connect.php");
include('functions.php');
$PRODUCTSPERPAGE=20;
include("security.php");

//calculation for page no
if(!$_GET['pgno']) {
    $PageNo = 1;
}
else {
    $PageNo = $_GET['pgno'];
}
$ipaddress='';

$sql="select username,r.id,ipaddress,registration_date from login_logout l join registration r on l.user_id=r.id ";
if(isset($_POST['ipaddress'])){
    $ipaddress=trim(chkInput($_POST['ipaddress'], 's'));
    $sql.= " where l.ipaddress like '%$ipaddress%' ";
}
$sql.="group by l.user_id order by ipaddress,username";
$result=  db_query($sql);

$total=  db_num_rows($result);
$totalpage=ceil($total/$PRODUCTSPERPAGE);
//echo $totalpage;
if($totalpage>=1) {
    $startrow=$PRODUCTSPERPAGE*($PageNo-1);
    $sql.=" LIMIT $startrow,$PRODUCTSPERPAGE";
//echo $sql;
    $result=db_query($sql);
    $total=db_num_rows($result);
}



?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="imagetoolbar" content="no" />
        <title>Ip Address lookup-<?php echo $ADMIN_MAIN_SITE_NAME ?></title>
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
                                <h2>IP address lookup</h2>
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
                                                        <div>
                                                            <div style="margin-left:30px;">
                                                                <form action="" method="post">
                                                                    <span style="float:left;">
                                                                        <strong>Search:</strong> <input type="text" name="ipaddress" value="<?=$ipaddress;?>" />&nbsp;&nbsp;
                                                                    </span>
                                                                    <span class="button send_form_btn"><span><span>Search</span></span><input name="searchsubmit" type="submit" /></span>
                                                                    
                                                                </form>
                                                            </div>
                                                        </div>
                                                        <div class="clear"></div>
                                                    </div>
                                                    <div  id="product_list">
                                                        <!--[if !IE]>start table_wrapper<![endif]-->
                                                        <div class="table_wrapper">
                                                            <div class="table_wrapper_inner">
                                                                <?php if(!$total) { ?>
                                                                <ul class="system_messages">
                                                                    <li class="blue"><span class="ico"></span><strong class="system_title">No User To Display</strong></li>
                                                                </ul>
                                                                    <?php }else {?>
                                                                <form id="form2" name="form2" action="ipaddresshistory.php" method="post">
                                                                    <table cellpadding="0" cellspacing="0" width="100%">
                                                                        <tbody>
                                                                            <tr>
                                                                                <th style="text-align:center;width:20px">ID</th>
                                                                                <th>User Name</th>
                                                                                <th>IP Address</th>
                                                                                <th>Register Date</th>
                                                                            </tr>
                                                                                <?php
                                                                                for($i=0;$i<$total;$i++) {
                                                                                    $row = db_fetch_array($result);
                                                                                   
                                                                                    ?>
                                                                            <tr class="<?php echo ($i % 2!=0)?'first':'second'; ?>">
                                                                                <td style="width:5%" class="alignCenter">
                                                                                    <?php echo $row['id'];?>
                                                                                </td>
                                                                                <td><?php echo $row['username']; ?></td>
                                                                                <td><?php echo $row['ipaddress']; ?></td>
                                                                                <td><?php echo arrangedate($row['registration_date']); ?></td>
                                                                            </tr>
                                                                                    <?php
                                                                                }
                                                                                ?>
                                                                        </tbody>
                                                                    </table>
                                                                </form>
                                                                    <?php }?>
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
                                                            <li><a href="ipaddresshistory.php?pgno=<?=$PrevPageNo; ?>&ipaddress=<?=$ipaddress;?>" class="button light_blue_btn"><span><span>PREVIOUS</span></span></a> </li>
                                                                    <?php } ?>

                                                                <?php
                                                                $pageFrom=$PageNo-3<1?1:$PageNo-3;
                                                                $pageTo=$PageNo+3>$totalpage?$totalpage:$PageNo+3;
                                                                for($i=$pageFrom;$i<=$pageTo;$i++) {
                                                                    ?>
                                                                    <?php if($i==$PageNo) { ?>
                                                            <li><a href="ipaddresshistory.php?pgno=<?=$i;?>&ipaddress=<?=$ipaddress;?>" class="current_page"><span><span><?php echo $i; ?></span></span></a></li>
                                                                        <?php }else {?>
                                                            <li><a href="ipaddresshistory.php?pgno=<?=$i;?>&ipaddress=<?=$ipaddress;?>"><?php echo $i; ?></a></li>
                                                                        <?php }
                                                                }
                                                                ?>
                                                                <?php
                                                                if($PageNo<$totalpage) {
                                                                    $NextPageNo = 	$PageNo + 1;
                                                                    ?>
                                                            <li><a href="ipaddresshistory.php?pgno=<?=$NextPageNo;?>&ipaddress=<?=$ipaddress;?>" class="button light_blue_btn"><span><span>NEXT</span></span></a> </li>
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