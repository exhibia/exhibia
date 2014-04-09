<?php
session_start();
$active="Users";
include("connect.php");
include("security.php");

$auctionid= $_POST['auction'];
$userid=$_POST['user'];
$bidfrom=$_POST['bidfrom'];
$bidto=$_POST['bidto'];
$bids=$_POST['bids'];

$msg='';

if($_POST["add"]!="") {
    $qryselauc = "select use_free from auction where auctionID='".$auctionid."'";
    $resselauc = db_query($qryselauc);
    $objselauc = db_fetch_array($resselauc);

    if($objselauc["use_free"]==1) {
        $qrybid = "select * from free_account where auction_id='$auctionid' and bid_flag='d' order by id desc limit 0,1";
    }
    else {
        $qrybid = "select * from bid_account where auction_id='$auctionid' and bid_flag='d' order by id desc limit 0,1";
    }

    $resbid = db_query($qrybid);
    $objbid = db_fetch_object($resbid);
    $runprice = $objbid->bidding_price;

    if($runprice=="") {
        $qryprc = "select * from auc_due_table where auction_id='$auctionid'";
        $resprc = db_query($qryprc);
        $objprc = db_fetch_object($resprc);
        $runprice = $objprc->auc_due_price;
    }

    $q = "select * from auc_due_table adt left join auction a on adt.auction_id=a.auctionID left join auction_management am on a.time_duration=am.auc_manage where auction_id=$auctionid";
    $r = db_query($q);
    $ob = db_fetch_object($r);

    if ($ob->lockauction == true) {
        if (($ob->locktype == 1 && $ob->locktime >= $ob->auc_due_time) || ($ob->locktype == 2 && (($ob->reverseauction == false && $ob->lockprice <= $ob->auc_due_price) || ($ob->reverseauction == true && $ob->lockprice >= $ob->auc_due_price)))) {
            if ($ob->use_free == 1) {
                $qrybids = "select count(*) from free_account where auction_id='" . $auctionid . "' and user_id='$userid' and bid_flag='d' order by id desc limit 0,1";
            } else {
                $qrybids = "select count(*) from bid_account where auction_id='" . $auctionid . "' and user_id='$userid' and bid_flag='d' order by id desc limit 0,1";
            }

            $bidsresult = db_query($qrybids);
            if (db_result($bidsresult, 0) < 1) {
                $msg="this is a lock auction and it is reached to the condition of lock";
            }
        }
    }

    $qrys = "select * from registration where id='$userid'";
    $res = db_query($qrys);
    $ob = db_fetch_object($res);
    if($objselauc["use_free"]==1) {
        $fb = $ob->free_bids;
    }else {
        $fb = $ob->final_bids;
    }

		//////////////////////////////////////////////////////////////////////////////////
		/// Begin Bugfix
		/// Clear Idea Technology
		/// Trent Raber
		/// 2012-05-02
		///
		/// Correcting any areas where the final bids are compared to 0 ( == ).  Replacing them
		/// with <= 0
		//////////////////////////////////////////////////////////////////////////////////

     if($fb<=0 || $fb<$bids) {
        $msg="not enough freebis or final bids";
     }

		//////////////////////////////////////////////////////////////////////////////////
		/// End Bugfix
		//////////////////////////////////////////////////////////////////////////////////

    if($msg=='') {
        $qryins = "insert into bidbutler (auc_id,user_id,butler_start_price,butler_end_price,butler_bid,butler_status,place_date) values('$auctionid','$userid','$bidfrom','$bidto','$bids','0',NOW())";
        db_query($qryins) or die(db_error());
        $id = db_insert_id();

        $qryselreg = "select * from registration where id='$userid'";
        $resselreg = db_query($qryselreg);
        $objreg = db_fetch_object($resselreg);

        if($objselauc["use_free"]==1) {
            $fbids = $objreg->free_bids;
            $finalbids = $fbids-$bids;
            $qryupd = "update registration set free_bids='$finalbids' where id='$userid'";
        }
        else {
            $fbids = $objreg->final_bids;
            $finalbids = $fbids-$bids;
            $qryupd = "update registration set final_bids='$finalbids' where id='$userid'";
        }
        db_query($qryupd) or die(db_error());
        header("location: message.php?msg=109");
        exit;
    }
}

//if($_POST["edit"]!="") {
//    $id = $_POST["editrecord"];
//    $qrysel1 = "select * from registration where (username='".$_REQUEST['username']."') and id!='".$id."'";
//    $rsqrysel1 = db_query($qrysel1);
//    $totalavailable = db_num_rows($rsqrysel1);
//    if($totalavailable>0) {
//        header("location: message.php?msg=70");
//        exit;
//    }
//    else {
//        $qryupd = "update registration set username='".$username."',firstname='".$firstname."',lastname='".$lastname."',sex='".$gender."',birth_date='".$birthdate."',city='".$city."',country='".$country."',phone='".$phone."',password='".$password."',email='".$email."', final_bids=$finalbids,free_bids=$freebids"." where id='".$id."'";
//        db_query($qryupd) or die(db_error());
//        header("location: message.php?msg=71");
//    }
//}

if($_GET["deleterecord"]!="") {
    $delid = $_GET["deleterecord"];
    $qrysel="select * from bidbutler where id='$delid' and butler_status='0'";
    $ressel = db_query($qrysel);
    $totalf = db_num_rows($ressel);
    $obj = db_fetch_object($ressel);

    if(/*$obj->used_bids==0 && */$obj->butler_status==0 && $totalf>0) {
        $aucid = $obj->auc_id;
        $qryd = "update bidbutler set butler_status='1' where id='$delid'"; //and used_bids=0
        db_query($qryd) or die(db_error());

        $uid=$obj->user_id;

        $qryreg = "select * from registration where id='$uid'";
        $resreg = db_query($qryreg);
        $objreg = db_fetch_object($resreg);
        if($obj->use_free=="1") {
            $fbids = $objreg->free_bids;
            $pbids = $obj->butler_bid-$obj->used_bids;
            $finalbids = $fbids + $pbids;

            $qryins = "Insert into free_account (user_id,bidpack_buy_date,bid_count,auction_id,product_id,bid_flag) values('$uid',NOW(),'$pbids','".$aucid."','".$obj->productID."','b')";
            db_query($qryins) or die(db_error());

            $qryupd = "update registration set free_bids='$finalbids' where id='$uid'";
            db_query($qryupd) or die(db_error());
        }
        else {
            $fbids = $objreg->final_bids;
            $pbids = $obj->butler_bid;
            $finalbids = $fbids + $pbids;

            $qryins = "Insert into bid_account (user_id,bidpack_buy_date,bid_count,auction_id,product_id,bid_flag) values('$uid',NOW(),'$pbids','".$aucid."','".$obj->productID."','b')";
            db_query($qryins) or die(db_error());

            $qryupd = "update registration set final_bids='$finalbids' where id='$uid'";
            db_query($qryupd) or die(db_error());
        }

        header("location: manageautobidder.php");
    }
    else {
        header("location: manageautobidder.php");
    }
}

if($_GET["editid"]!="" || $_GET["delid"]!="") {
    if($_GET["editid"]!="") {
        $id=$_GET["editid"];
    }
    else {
        $id = $_GET["delid"];
    }

    $qryreg = "select * from bidbutler where id='".$id."'";
    $resreg = db_query($qryreg);
    $obj = db_fetch_object($resreg);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="imagetoolbar" content="no" />
        <title><?php if($_GET["editid"]!="") { ?>Edit AutoBidder<?php }elseif($_GET["delid"]!="") { ?>Delete AutoBidder <?php }else { ?>Add AutoBidder<?php } ?>-<?php echo $ADMIN_MAIN_SITE_NAME ?></title>
        <link media="screen" rel="stylesheet" type="text/css" href="css/admin.css"  />
        <!--[if lte IE 6]><link media="screen" rel="stylesheet" type="text/css" href="css/admin-ie.css" /><![endif]-->
        <link type="text/css" href="css/cupertino/ui.all.css" rel="stylesheet" />
        <link type="text/css" href="css/cupertino/jquery-ui-1.7.3.custom.css" rel="stylesheet" />

        <!--[if lte IE 6]><link media="screen" rel="stylesheet" type="text/css" href="css/admin-ie.css" /><![endif]-->
        <script type="text/javascript" src="js/behaviour.js"></script>
        <script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
        <script type="text/javascript" src="js/ui/jquery-ui-1.7.2.custom.min.js"></script>
        <script type="text/javascript" src="body.js"></script>
        <script type="text/javascript">
            function Check(f1)
            {
                if(isNaN(document.f1.bidfrom.value)){
                    alert('Bid From Must be a number');
                    return false;
                }

                if(isNaN(document.f1.bidto.value)){
                    alert('Bid To Must be a number');
                    return false;
                }

                if(isNaN(document.f1.bids.value)){
                    alert('Place Bids Must be a number');
                    return false;
                }
                return true;

                /*		if(document.f1.phoneno.value=="")
                {
                        alert("Please enter phone number!!!");
                        document.f1.phoneno.focus();
                        return false;
                }
                 */
            }


            function ConfirmDelete(id)
            {
                if(confirm("Are you sure to delete this autobidder!!!"))
                {
                    window.location.href='addautobidder.php?deleterecord=' + id;
                }
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
                        <div class="section">
                            <!--[if !IE]>start title wrapper<![endif]-->
                            <div class="title_wrapper">
                                <h2><?php if($_GET["editid"]!="") { ?>Edit Bidding User <?php }elseif($_GET["delid"]!="") { ?>Delete Bidding User <?php }else { ?>Add Bidding User<?php } ?></h2>
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
                                                    <!--[if !IE]>start system messages<![endif]-->

                                                    <ul class="system_messages">
                                                        <?php if($msg!=''){ ?>
                                                        <li class="red"><span class="ico"></span><strong class="system_title"><span class="required">*</span> <?php echo $msg; ?></strong></li>
                                                        <?php }?>
                                                        <li class="blue"><span class="ico"></span><strong class="system_title"><span class="required">*</span> Required Information</strong></li>
                                                    </ul>
                                                    <!--[if !IE]>end system messages<![endif]-->

                                                    <br/>

                                                    <!--[if !IE]>start forms<![endif]-->
                                                    <form action="" method="post" name="f1" onsubmit="return Check(this);" class="search_form general_form">
                                                        <!--[if !IE]>start fieldset<![endif]-->
                                                        <fieldset>
                                                            <!--[if !IE]>start forms<![endif]-->
                                                            <div class="forms">

                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Auction:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper blank">
                                                                            <select name="auction">
<?php
$sqlauc="select a.auctionID as aucid,p.name as pname,bidpack,bidpack_name from auction a left join products p on a.productID=p.productID and a.bidpack=0 left join bidpack b on b.id=a.productID and a.bidpack=1 left join auc_due_table adt on a.auctionID=adt.auction_id where a.auc_status=2 and adt.auc_due_time!=0 and a.uniqueauction!=1;";
$resultAuc=db_query($sqlauc);
while($aucObj=db_fetch_object($resultAuc)) {
    ?>
                                                                                <option value="<?php echo $aucObj->aucid;?>" <?php echo $aucObj->aucid==$obj->auc_id?"selected":"";?>><?php echo ($aucObj->bidpack==1?$aucObj->bidpack_name :$aucObj->pname).' ('.$aucObj->aucid.')'; ?></option>
    <?php
                                                                                }
                                                                                db_free_result($resultAuc);
                                                                                ?>
                                                                            </select>
                                                                        </span>
                                                                        <span class="system required">*</span>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->

                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Bidding User:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper blank">
                                                                           <select name="user">
<?php
$sqlreg="select * from registration where admin_user_flag>=1 order by id";
$resultReg=db_query($sqlreg);
while($regobj=db_fetch_object($resultReg)) {

    ?>
                                                                              <option value="<?php echo $regobj->id; ?>" <?php echo $obj->user_id==$regobj->id?"selected":"";?>><?php echo $regobj->username; ?></option>
    <?php }
                                                                                db_free_result($resultReg);
                                                                                ?>
                                                                          </select>
                                                                        </span>
                                                                        <span class="system required">*</span>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->

                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Bid From:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper">
                                                                            <input class="text" type="text" name="bidfrom" size="10" value="<?php echo $obj->butler_start_price!=""?$obj->butler_start_price:"";?>"/>
                                                                        </span>
                                                                        <span class="system required">*</span>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->

                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Bid To:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper">
                                                                            <input class="text" type="text" name="bidto" size="10" value="<?php echo $obj->butler_end_price!=""?$obj->butler_end_price:"";?>"/>
                                                                        </span>
                                                                        <span class="system required">*</span>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->

                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Place Bids:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper">
                                                                            <input type="text" class="text" name="bids" size="10" maxlength="16" value="<?php echo $obj->butler_bid!=""?$obj->butler_bid:"";?>"/>
                                                                        </span>
                                                                        <span class="system required">*</span>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->

                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <div class="buttons">
                                                                        <ul>
                                                                            <li>
<?php if($_GET["editid"]!="") { ?>
                                                                                <span class="button send_form_btn"><span><span>Edit</span></span><input name="edit" type="submit"/></span>
                                                                                <input type="hidden" value="<?=$_GET["editid"];?>" name="editrecord" />
    <?php } elseif($_GET["delid"]!="") { ?>
                                                                                <span class="button send_form_btn"><span><span>Delete</span></span><input name="delete" type="button" onclick="ConfirmDelete('<?=$_GET["delid"];?>')"/></span>
    <?php }else { ?>
                                                                                <span class="button send_form_btn"><span><span>Add</span></span><input name="add" type="submit"/></span>
                                                                                    <?php } ?>
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