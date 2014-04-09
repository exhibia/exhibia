<?php
session_start();
$active="Users";
include("connect.php");
include("security.php");

if($_REQUEST['order']) {
    $order=$_REQUEST['order'];
}

if(!$_GET['pgno']) {
    $PageNo = 1;
}
else {
    $PageNo = $_GET['pgno'];
}

$sql = "select bb.id as id,bb.auc_id as aucid,p.name as pname,bidpack_name,bidpack,bb.butler_start_price as startprice,bb.butler_end_price as endprice,bb.butler_bid as placebids,reg.username as username from bidbutler bb left join auction a on bb.auc_id=a.auctionID left join products p on a.productID=p.productID and a.bidpack=0 left join bidpack b on b.id=a.productID and a.bidpack=1 left join registration as reg on reg.id=bb.user_id where a.auc_status='2' and butler_status='0' and reg.admin_user_flag>=1";

if($order) {
    $sql.=" and (p.name like '$order%' or b.bidpack_name like '$order%' ) ";
}

$biduser='';
if($_REQUEST['biduser']!='') {
    $biduser=$_REQUEST['biduser'];
    $sql.=" and bb.user_id=$biduser";
}

$auction='';
if($_REQUEST['auction']!='') {
    $auction=$_REQUEST['auction'];
    $sql.=" and bb.auc_id=$auction";
}

$PRODUCTSPERPAGE=20;
$result=db_query($sql);
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
        <title>Manage Autobidder-<?php echo $ADMIN_MAIN_SITE_NAME ?></title>
        <link media="screen" rel="stylesheet" type="text/css" href="css/admin.css"  />
        <!--[if lte IE 6]><link media="screen" rel="stylesheet" type="text/css" href="css/admin-ie.css" /><![endif]-->
        <link type="text/css" href="css/cupertino/ui.all.css" rel="stylesheet" />
        <link type="text/css" href="css/cupertino/jquery-ui-1.7.3.custom.css" rel="stylesheet" />

        <!--[if lte IE 6]><link media="screen" rel="stylesheet" type="text/css" href="css/admin-ie.css" /><![endif]-->
        <script type="text/javascript" src="js/behaviour.js"></script>
        <script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
        <script type="text/javascript" src="js/ui/jquery-ui-1.7.2.custom.min.js"></script>
        <script type="text/javascript">
            function SubmitForm()
            {
                document.f3.submit();
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
                                <h2>Manage Admin AutoBidder</h2>
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
                                                        <span style="float:left;margin-right:40px;">
                                                            <form id="form1" name="form1" action="" method="post">
                                                                <span><a href="manageautobidder.php">All</a></span><span class="sp">|</span>
                                                                <span><a href="manageautobidder.php?order=A&biduser=<?php echo $biduser; ?>&auction=<?php echo $auction; ?>">A</a></span><span class="sp">|</span>
                                                                <span><a href="manageautobidder.php?order=B&biduser=<?php echo $biduser; ?>&auction=<?php echo $auction; ?>">B</a></span><span class="sp">|</span>
                                                                <span><a href="manageautobidder.php?order=C&biduser=<?php echo $biduser; ?>&auction=<?php echo $auction; ?>">C</a></span><span class="sp">|</span>
                                                                <span><a href="manageautobidder.php?order=D&biduser=<?php echo $biduser; ?>&auction=<?php echo $auction; ?>">D</a></span><span class="sp">|</span>
                                                                <span><a href="manageautobidder.php?order=E&biduser=<?php echo $biduser; ?>&auction=<?php echo $auction; ?>">E</a></span><span class="sp">|</span>
                                                                <span><a href="manageautobidder.php?order=F&biduser=<?php echo $biduser; ?>&auction=<?php echo $auction; ?>">F</a></span><span class="sp">|</span>
                                                                <span><a href="manageautobidder.php?order=G&biduser=<?php echo $biduser; ?>&auction=<?php echo $auction; ?>">G</a></span><span class="sp">|</span>
                                                                <span><a href="manageautobidder.php?order=H&biduser=<?php echo $biduser; ?>&auction=<?php echo $auction; ?>">H</a></span><span class="sp">|</span>
                                                                <span><a href="manageautobidder.php?order=I&biduser=<?php echo $biduser; ?>&auction=<?php echo $auction; ?>">I</a></span><span class="sp">|</span>
                                                                <span><a href="manageautobidder.php?order=J&biduser=<?php echo $biduser; ?>&auction=<?php echo $auction; ?>">J</a></span><span class="sp">|</span>
                                                                <span><a href="manageautobidder.php?order=K&biduser=<?php echo $biduser; ?>&auction=<?php echo $auction; ?>">K</a></span><span class="sp">|</span>
                                                                <span><a href="manageautobidder.php?order=L&biduser=<?php echo $biduser; ?>&auction=<?php echo $auction; ?>">L</a></span><span class="sp">|</span>
                                                                <span><a href="manageautobidder.php?order=M&biduser=<?php echo $biduser; ?>&auction=<?php echo $auction; ?>">M</a></span><span class="sp">|</span>
                                                                <span><a href="manageautobidder.php?order=N&biduser=<?php echo $biduser; ?>&auction=<?php echo $auction; ?>">N</a></span><span class="sp">|</span>
                                                                <span><a href="manageautobidder.php?order=O&biduser=<?php echo $biduser; ?>&auction=<?php echo $auction; ?>">O</a></span><span class="sp">|</span>
                                                                <span><a href="manageautobidder.php?order=P&biduser=<?php echo $biduser; ?>&auction=<?php echo $auction; ?>">P</a></span><span class="sp">|</span>
                                                                <span><a href="manageautobidder.php?order=Q&biduser=<?php echo $biduser; ?>&auction=<?php echo $auction; ?>">Q</a></span><span class="sp">|</span>
                                                                <span><a href="manageautobidder.php?order=R&biduser=<?php echo $biduser; ?>&auction=<?php echo $auction; ?>">R</a></span><span class="sp">|</span>
                                                                <span><a href="manageautobidder.php?order=S&biduser=<?php echo $biduser; ?>&auction=<?php echo $auction; ?>">S</a></span><span class="sp">|</span>
                                                                <span><a href="manageautobidder.php?order=T&biduser=<?php echo $biduser; ?>&auction=<?php echo $auction; ?>">T</a></span><span class="sp">|</span>
                                                                <span><a href="manageautobidder.php?order=I&biduser=<?php echo $biduser; ?>&auction=<?php echo $auction; ?>">U</a></span><span class="sp">|</span>
                                                                <span><a href="manageautobidder.php?order=V&biduser=<?php echo $biduser; ?>&auction=<?php echo $auction; ?>">V</a></span><span class="sp">|</span>
                                                                <span><a href="manageautobidder.php?order=W&biduser=<?php echo $biduser; ?>&auction=<?php echo $auction; ?>">W</a></span><span class="sp">|</span>
                                                                <span><a href="manageautobidder.php?order=X&biduser=<?php echo $biduser; ?>&auction=<?php echo $auction; ?>">X</a></span><span class="sp">|</span>
                                                                <span><a href="manageautobidder.php?order=Y&biduser=<?php echo $biduser; ?>&auction=<?php echo $auction; ?>">Y</a></span><span class="sp">|</span>
                                                                <span><a href="manageautobidder.php?order=Z&biduser=<?php echo $biduser; ?>&auction=<?php echo $auction; ?>">Z</a></span>
                                                            </form>
                                                        </span>
                                                        <span>
                                                            <form name="f3" action="manageautobidder.php" method="post">
                                                                <strong>Bidder User:</strong>
                                                                <select name="biduser" onchange="SubmitForm();">
                                                                    <option value="">All</option>
                                                                    <?php
                                                                    $sqlreg="select * from registration where admin_user_flag='1' and user_delete_Flag!='d' order by id";
                                                                    $resultReg=db_query($sqlreg);
                                                                    while($regobj=db_fetch_object($resultReg)) {
                                                                        ?>
                                                                    <option value="<?php echo $regobj->id; ?>" <?php echo $biduser==$regobj->id?"selected":"";?>><?php echo $regobj->username; ?></option>
                                                                        <?php }
                                                                    db_free_result($resultReg);
                                                                    ?>
                                                                </select>
                                                                &nbsp;&nbsp;&nbsp;&nbsp;
                                                                <strong>Auction:</strong>
                                                                <select name="auction" onchange="SubmitForm();">
                                                                    <option value="">All</option>
                                                                    <?php
                                                                    $sqlauc="select a.auctionID as aucid,p.name as pname from auction a left join products p on a.productID=p.productID where auc_status=2";
                                                                    $resultAuc=db_query($sqlauc);
                                                                    while($aucObj=db_fetch_object($resultAuc)) {
                                                                        ?>
                                                                    <option value="<?php echo $aucObj->aucid;?>" <?php echo $aucObj->aucid==$auction?"selected":"";?>><?php echo $aucObj->pname; ?></option>
                                                                        <?php
                                                                    }
                                                                    db_free_result($resultAuc);
                                                                    ?>
                                                                </select>
                                                                <input type="hidden" name="pgno" value="1" />
                                                            </form>
                                                        </span>

                                                    </div>
                                                    <?php if($total==0) { ?>
                                                    <ul class="system_messages">
                                                        <li class="blue"><span class="ico"></span><strong class="system_title">No Auto bidder To Display</strong></li>
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
                                                                            <th>Auction ID</th>
                                                                            <th>Product Name</th>
                                                                            <th>Start Price</th>
                                                                            <th>End Price</th>
                                                                            <th>Place Bids</th>
                                                                            <th style="text-align:center;width:120px;">Options</th>
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
                                                                                ?>
                                                                        <tr class="<?php echo ($colorflg==1)?'first':'second'; ?>">
                                                                            <td><?php echo $row->username; ?></td>
                                                                            <td><?php echo $row->aucid;?></td>
                                                                            <td><?php echo $row->bidpack?$row->bidpack_name:$row->pname;?></td>
                                                                            <td><?php echo $row->startprice;?></td>
                                                                            <td><?php echo $row->endprice;?></td>
                                                                            <td><?php echo $row->placebids?></td>
                                                                            <td style="text-align:center;">
                                                                                <div class="actions_menu">
                                                                                    <ul>
                                                                                        <!--
                                                                                        <li>
                                                                                            <a class="edit" href="addautobidder.php?editid=<?=$row->id;?>">Edit</a>
                                                                                        </li>
                                                                                        -->
                                                                                                <?php
                                                                                                //if($row->id!="1") {
                                                                                                ?>
                                                                                        <li>
                                                                                            <a class="delete" name="button" href="#"onClick="window.location.href='addautobidder.php?delid=<?=$row->id;?>'">Delete</a>
                                                                                        </li>
                                                                                                <?php// } ?>

                                                                                        
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
                                                            <li><a href="manageautobidder.php?pgno=<?=$PrevPageNo; ?>&order=<?=$order?>&biduser=<?php echo $biduser; ?>&auction=<?php echo $auction; ?>" class="button light_blue_btn"><span><span>PREVIOUS</span></span></a> </li>
                                                                        <?php } ?>

                                                                    <?php
                                                                    $pageFrom=$PageNo-3<1?1:$PageNo-3;
                                                                    $pageTo=$PageNo+3>$totalpage?$totalpage:$PageNo+3;
                                                                    for($i=$pageFrom;$i<=$pageTo;$i++) {
                                                                        ?>
                                                                        <?php if($i==$PageNo) { ?>
                                                            <li><a href="manageautobidder.php?pgno=<?=$i;?>&order=<?=$order?>&biduser=<?php echo $biduser; ?>&auction=<?php echo $auction; ?>" class="current_page"><span><span><?php echo $i; ?></span></span></a></li>
                                                                            <?php }else {?>
                                                            <li><a href="manageautobidder.php?pgno=<?=$i;?>&order=<?=$order?>&biduser=<?php echo $biduser; ?>&auction=<?php echo $auction; ?>"><?php echo $i; ?></a></li>
                                                                            <?php }
                                                                    }
                                                                    ?>
                                                                    <?php
                                                                    if($PageNo<$totalpage) {
                                                                        $NextPageNo = 	$PageNo + 1;
                                                                        ?>
                                                            <li><a href="manageautobidder.php?pgno=<?=$NextPageNo;?>&order=<?=$order?>&biduser=<?php echo $biduser; ?>&auction=<?php echo $auction; ?>" class="button light_blue_btn"><span><span>NEXT</span></span></a> </li>
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