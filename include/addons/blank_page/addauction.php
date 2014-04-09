<?php
ini_set('display_errors', 1);

$active = "Database";
include("../../../config/config.inc.php");
$db = db_connect($DBSERVER, $USERNAME, $PASSWORD);

db_select_db($DATABASENAME, $db);
include("$BASE_DIR/common/sitesetting.php");

include("$BASE_DIR/backendadmin/functions.php");
include("$BASE_DIR/backendadmin/admin.config.inc.php");



if (isset($_REQUEST["category"])) {

    $categoryID = $_REQUEST["category"];
    $productID = $_REQUEST["product"];
    $auc_start_price = $_REQUEST["aucstartprice"];
    $auc_fixed_price = $_REQUEST["aucfixedprice"];

    if ($auc_fixed_price == "") {
        $auc_fixed_price = 0;
    }

    if ($auc_start_price == '') {
        $auc_start_price = 0;
    }

    if ($_REQUEST["startimmidiate"] != "") {
        $auc_start_date_ex = explode("/", date($globalDateformat));
	
    } else {
        $auc_start_date_ex = explode("/", $_REQUEST["aucstartdate"]);
    }
    $auc_end_date_ex = explode("/", $_REQUEST["aucenddate"]);
    
    
    switch($globalDateformat){
    
	case 'd/m/Y':

	    $auc_start_date = $auc_start_date_ex[2] . "-" . $auc_start_date_ex[1] . "-" . $auc_start_date_ex[0];

    $auc_end_date = $auc_end_date_ex[2] . "-" . $auc_end_date_ex[1] . "-" . $auc_end_date_ex[0];
	
	break;
    
	case 'm/d/Y':
    $auc_start_date = $auc_start_date_ex[2] . "-" . $auc_start_date_ex[0] . "-" . $auc_start_date_ex[1];

    $auc_end_date = $auc_end_date_ex[2] . "-" . $auc_end_date_ex[0] . "-" . $auc_end_date_ex[1];
	
	break;
    
    }


    $aucstartdate = $_REQUEST["aucstartdate"];
    $aucenddate = $_REQUEST["aucenddate"];
    $aucstarthour = $_REQUEST["aucstarthours"];
    $aucendhour = $_REQUEST["aucendhours"];
    $aucstartmin = $_REQUEST["aucstartminutes"];
    $aucendmin = $_REQUEST["aucendminutes"];
    $aucstartsec = $_REQUEST["aucstartseconds"];
    $aucendsec = $_REQUEST["aucendseconds"];

    if ($_REQUEST["startimmidiate"] != "") {
        $auc_start_time = $_REQUEST["curtime"];
        $auctionsplittime = explode(":", $auc_start_time);
        $aucstarthour = $auctionsplittime[0];
        $aucstartmin = $auctionsplittime[1];
        $aucstartsec = $auctionsplittime[2];
    } else {
        $auc_start_time = $_REQUEST["aucstarthours"] . ":" . $_REQUEST["aucstartminutes"] . ":" . $_REQUEST["aucstartseconds"];
    }
    $auc_end_time = $_REQUEST["aucendhours"] . ":" . $_REQUEST["aucendminutes"] . ":" . $_REQUEST["aucendseconds"];
    $auc_status = $_REQUEST["aucstatus"];
    $auc_type = $_REQUEST["auctype"];
    $auc_recu = $_REQUEST["aucrec"];
    $fpa = $_REQUEST["fpa"];
    $pa = $_REQUEST["pa"];
    $nba = $_REQUEST["nba"];
    $off = $_REQUEST["off"];
    $na = $_REQUEST["na"];
    $oa = $_REQUEST["oa"];
    $duration = $_REQUEST["auctionduration"];
    $useonlyfree = $_REQUEST["useronlyfree"];

    $changesval = $_REQUEST['changestatusval'];
    $shippingmethod = $_REQUEST["shippingmethod"];

    $allowbuynow = $_REQUEST["allowbuynow"];
    $buynowprice = $_REQUEST["buynowprice"];
    



$cashauction = $_REQUEST['cashauction'];
$reserve = $_REQUEST['reserve'];
    $uniqueauction = $_REQUEST['uniqueauction'];
    $reverseauction = $_REQUEST['reverseauction'];
    $halfback = $_REQUEST['halfback'];
    $seatauction = isset($_REQUEST['seatauction']) ? $_REQUEST['seatauction'] : 0;
    $lockauction = isset($_REQUEST['lockauction']) ? $_REQUEST['lockauction'] : 0;
    $locktype = isset($_REQUEST['locktype']) ? $_REQUEST['locktype'] : 1;
    $locktime = ($_REQUEST['lockhour'] * 60 + $_REQUEST['lockminute']) * 60 + $_REQUEST['locksecond'];
    $lockprice = isset($_REQUEST['lockprice']) ? $_REQUEST['lockprice'] : '0.00';
    $minseats = $_REQUEST['minseats'];
    $maxseats = $_REQUEST['maxseats'];
    $seatbids = $_REQUEST['seatbids'];
    $relist = $_REQUEST['relist'];

    $tax1 = $_REQUEST['tax1'];
    $tax2 = $_REQUEST['tax2'];

    if ($tax1 == '')
        $tax1 = 0;

    if ($tax2 == '')
        $tax2 = 0;

//echo $reverseamount;

    if ($_REQUEST["minimum_auction"] != "") {
        $minimumaucprice = $_REQUEST["auctionminimumprice"];
        $minwinprice = $_REQUEST["minwinprice"];
    } else {
        $minimumaucprice = "0.00";
        $minwinprice = "0.00";
    }

    $auc_due_time = getHours($aucstartdate, $aucenddate, $aucstarthour, $aucendhour, $aucstartmin, $aucendmin, $aucstartsec, $aucendsec);

} else {
    $minimumaucprice = "0.00";
    $minwinprice = "0.00";
    $auc_fixed_price = '0.00';
    $locktype = 1;
    $locktime = 0;
    $lockprice = '0.00';
    $minseats = 0;
    $maxseats = 0;
    $seatbids = 0;
    $tax1 = 0;
    $tax2 = 0;
}
if ($_REQUEST["addauction"] != "") {
    $bidpack = $categoryID == 1 ? 1 : 0;

    if (!$bidpack) {
        $Query = "select * from products where productID = '" . $_REQUEST['product'] . "'";
        $result = db_query($Query);
//		echo $Query;
        $total = db_affected_rows();
        $rows = db_fetch_object($result);
        if ($rows->qty_flag == 1) {
            $id = $rows->productID;
            $qty = $rows->product_qty;
            if ($qty == 0) {
                header("location: message.php?msg=63");
                exit;
            }

            $productQty = $_REQUEST["product_qty"];

            $qty1 = $qty - $productQty;
//			echo $qty1;

            $updateQuery = "update products set product_qty='$qty1' where productID='" . $id . "'";
            db_query($updateQuery) or die(db_error());
//			echo $updateQuery;
        }
    }


       switch($globalDateformat){
    
	case 'd/m/Y':
 $futuretstamp = mktime($aucstarthour, $aucstartmin, $aucstartsec, $auc_start_date_ex[1], $auc_start_date_ex[0], $auc_start_date_ex[2]);

	
	
	break;
    
	case 'm/d/Y':
 $futuretstamp = mktime($aucstarthour, $aucstartmin, $aucstartsec, $auc_start_date_ex[0], $auc_start_date_ex[1], $auc_start_date_ex[2]);

	
	break;
    
    }
 

    
    

    if ($changesval == "1" && $auc_status == "2") {
        $auc_status = 1;
    }


    $qryins = "Insert into auction
(categoryID,productID,auc_start_price,auc_fixed_price,auc_final_price,auc_start_date,auc_end_date,auc_start_time,auc_end_time,auc_status,auc_type,fixedpriceauction,pennyauction,nailbiterauction,
offauction,nightauction,openauction,time_duration,auc_recurr,total_time,shipping_id,future_tstamp,recurr_count,auction_min_price,min_win_price,use_free,allowbuynow,buynowprice,uniqueauction,
reverseauction,halfbackauction,tax1,tax2,relist,seatauction,minseats,maxseats,seatbids,lockauction,locktype,locktime,lockprice,bidpack, cashauction, reserve)";


$qryins
.= "values('$categoryID','$productID',$auc_start_price,$auc_fixed_price,'','$auc_start_date','$auc_end_date','$auc_start_time','$auc_end_time','$auc_status',";
$qryins .= "'$auc_type','$fpa','$pa','$nba','$off','$na' , '$oa','$duration','$auc_recu','$auc_due_time','$shippingmethod','$futuretstamp',";
$qryins .= "'$productQty','$minimumaucprice','$minwinprice','$useonlyfree','$allowbuynow','$buynowprice','$uniqueauction','$reverseauction','$halfback',";
$qryins .= "'$tax1','$tax2','$relist','$seatauction','$minseats','$maxseats','$seatbids','$lockauction', '$locktype', '$locktime','$lockprice','$bidpack',";
$qryins .= "'$cashauction', '$reserve')";

    db_query($qryins) or die(db_error());
    $auctionID = db_insert_id();
    if ($auc_status == 2) {
        //add extra 2 second when use timer dealy
        if (Sitesetting::isEnableTimerDelay() == true) {
            $auc_due_time+=2;
        }
        $qry = "Insert into auc_due_table (auction_id,auc_due_time,auc_due_price) values($auctionID,'$auc_due_time','$auc_start_price')";
	

        db_query($qry) or die(db_error());
        initRunningTable($auctionID);
    }



    header("location: message.php?msg=14");
    exit;
}

if ($_REQUEST["editauction"] && $_REQUEST["edit_auction"]) {
    $editid = $_REQUEST["edit_auction"];

    $bidpack = $categoryID == 1 ? 1 : 0;

    $qrypro = "select auctionID,a.productID as productID,a.categoryID as
categoryID,auc_start_price,auc_final_price,auc_start_date,auc_end_date,auc_start_time,auc_end_time,auc_status,auc_type,auc_recurr,buy_user,

auc_fixed_price,fixedpriceauction,pennyauction,nailbiterauction,offauction,nightauction,openauction,time_duration,auc_final_end_date,total_time,pause_status,shipping_id,future_tstamp,recurr_count,
auction_min_price,min_win_price,relist,

use_free,allowbuynow,buynowprice,reverseauction,uniqueauction,lockauction,locktype,locktime,lockprice,halfbackauction,seatauction,bidpack,minseats,maxseats,seatbids,tax1,tax2,bidpack_name,
bidpack_price,price, cashauction from auction a left join products p on a.productID=p.productID left join bidpack b on b.id=a.productID where auctionID='" . $editid . "'";
    $respro = db_query($qrypro);
    $objpro = db_fetch_object($respro);

    $productQty = $_REQUEST["product_qty"];

    if (!$bidpack) {
        if ($objpro->productID == $productID) {
            if ($objpro->qty_flag == 1) {
                $oldcount = $objpro->recurr_count;
                $totalqty = $objpro->product_qty;

                $qty2 = $oldcount + $totalqty - $productQty;

                if ($qty2 < 0) {
                    echo "<script>alert ('Remaining Quantity is Less then Entered Quantity');
					window.location='addauction.php?auction_edit=" . $editid . "';
					</script>";
                    exit;
                } else {
                    $updateQuery = "update products set product_qty='$qty2' where productID='" . $objpro->productID . "'";
                    db_query($updateQuery) or die(db_error());
                }
            }
        }

        if ($objpro->productID != $productID) {
            $qry1 = "select * from products where productID='" . $objpro->productID . "'";
            $rs1 = db_query($qry1);
            $ob1 = db_fetch_object($rs1);

            $qry2 = "select * from products where productID='" . $productID . "'";
            $rs2 = db_query($qry2);
            $ob2 = db_fetch_object($rs2);

            if ($ob2->qty_flag == 1) {
                $qty2 = $ob2->product_qty - $_REQUEST["product_qty"];

                if ($qty2 < 0) {
                    echo "<script>alert ('Remaining Quantity is Less then Entered Quantity');
					window.location='addauction.php?auction_edit=" . $editid . "';
					</script>";
                    exit;
                } else {
                    $qryupd = "update products set product_qty='" . $qty2 . "' where productID='" . $productID . "'";
                    db_query($qryupd) or die(db_error());
                }
            }

            if ($objpro->qty_flag == 1) {
                $oldproductqty = $ob1->product_qty + $objpro->recurr_count;
                $qryupd = "update products set product_qty='" . $oldproductqty . "' where productID='" . $objpro->productID . "'";
                db_query($qryupd) or die(db_error());
            }
        }
    }

    $futuretstamp = mktime($aucstarthour, $aucstartmin, $aucstartsec, $auc_start_date_ex[1], $auc_start_date_ex[0], $auc_start_date_ex[2]);

    if ($changesval == "1") {
        $auc_status = 1;
    }
    $editid = $_REQUEST["edit_auction"];
    $userid = $_REQUEST["userid"];
    if ($_REQUEST["auc_back_status"] == "3" and $userid == '0') {
        //delete record from won_auctions and bid_account and
        $delwonentry = "delete from won_auctions where userid='0' and auction_id='" . $editid . "'";
        db_query($delwonentry) or die(db_error());

        if ($_REQUEST["unsoldauction"] != "") {
            $deldueentry = "delete from auc_due_table where auction_id='" . $editid . "'";
            db_query($deldueentry) or die(db_error());
            clearRunningTable($editid);
        }

        $delbidaccentry = "delete from bid_account where user_id='0' and auction_id='" . $editid . "'";
        db_query($delbidaccentry) or die(db_error());

        //end
        $auc_due_time = getHours($aucstartdate, $aucenddate, $aucstarthour, $aucendhour, $aucstartmin, $aucendmin, $aucstartsec, $aucendsec);
       // if ($auc_status == 2) {
            $q = "select * from auc_due_table where auction_id=$editid";
            $r = db_query($q);
            $to = db_num_rows($r);

            //add extra 2 second when use timer dealy
            if (Sitesetting::isEnableTimerDelay() == true) {
                $auc_due_time+=2;
            }

            if ($to > 0) {
                $qry = "update auc_due_table set auc_due_time=$auc_due_time, auc_due_price=$auc_start_price where auction_id=$editid";
                updateRunTable( $editid,$auc_due_time, $auc_start_price);
            } else {
                $qry = "Insert into auc_due_table(auction_id,auc_due_time,auc_due_price) values($editid,'$auc_due_time',$auc_start_price)";
                initRunningTable($editid);
            }
	   
            db_query($qry) or die(db_error());
	//}
        if ($_REQUEST["aucstatus"] == 4) {
            $auc_status = $_REQUEST["aucstatus"];
        }

        $qryupd = "update auction set categoryID='$categoryID', productID='$productID',auc_start_price='$auc_start_price',auc_start_date='$auc_start_date',auc_end_date='$auc_end_date',
auc_start_time='$auc_start_time', auc_end_time='$auc_end_time', auc_status='$auc_status',
fixedpriceauction='$fpa',pennyauction='$pa',nailbiterauction='$nba',offauction='$off',nightauction='$na',openauction='$oa',time_duration='$duration',
auc_recurr='$auc_recu',auc_fixed_price=$auc_fixed_price,total_time='$auc_due_time',buy_user='',auc_final_end_date='0000-00-00
00:00:00',auc_final_price='0',shipping_id='$shippingmethod',future_tstamp='$futuretstamp',recurr_count='$productQty',auction_min_price='$minimumaucprice',min_win_price='$minwinprice',use_free=
'$useonlyfree',uniqueauction='$uniqueauction',reverseauction='$reverseauction',tax1='$tax1',tax2='$tax2',seatauction='$seatauction',minseats='$minseats',maxseats='$maxseats',seatbids='$seatbids',
locktype='$locktype',locktime='$locktime',lockprice='$lockprice',bidpack='$bidpack', 
cashauction='$cashauction', reserve='$reserve' 
where auctionID='$editid'";
        db_query($qryupd) or die(db_error());

        $qryupd1 = "update auction_running set
productID='$productID',auc_status='$auc_status',auc_start_price='$auc_start_price',fixedpriceauction='$fpa',pennyauction='$pa',nailbiterauction='$nba',offauction='$off',nightauction='$na',openauction=
'$oa',time_duration='$duration',use_free='$useonlyfree',uniqueauction='$uniqueauction',reverseauction='$reverseauction',seatauction='$seatauction',minseats='$minseats',maxseats='$maxseats',seatbids=
'$seatbids',locktype='$locktype',locktime='$locktime',lockprice='$lockprice',relist='$relist', cashauction='$cashauction', reserve='$reserve' where auctionID='$editid'";
        db_query($qryupd1) or die(db_error());
        header("location: message.php?msg=15");
        exit;
    } else {
        if ($_REQUEST["auc_back_status"] != 2) {
            $q = "select * from auc_due_table where auction_id=$editid";
            $r = db_query($q);
            $to = db_num_rows($r);

            if ($auc_status == 2) {
                $auc_due_time = getHours($aucstartdate, $aucenddate, $aucstarthour, $aucendhour, $aucstartmin, $aucendmin, $aucstartsec, $aucendsec);

                if ($to > 0) {
                    $qry = "update auc_due_table set auc_due_time=$auc_due_time, auc_due_price=$auc_start_price where auction_id=$editid";
                    updateRunTable($editid,$auc_due_time, $auc_start_price);
                } else {
                    $qry = "Insert into auc_due_table (auction_id,auc_due_time,auc_due_price) values($editid,'$auc_due_time',$auc_start_price)";
                    initRunningTable($editid);
                }
                db_query($qry) or die(db_error());
            }
        }
        if ($_REQUEST["aucstatus"] == 4) {
            $auc_status = $_REQUEST["aucstatus"];
        }
        $qryupd = "update auction set categoryID='$categoryID', productID='$productID', auc_start_price='$auc_start_price',auc_start_date='$auc_start_date',auc_end_date='$auc_end_date',
auc_start_time='$auc_start_time', auc_end_time='$auc_end_time', auc_status='$auc_status',
fixedpriceauction='$fpa',pennyauction='$pa',nailbiterauction='$nba',offauction='$off',nightauction='$na',openauction='$oa',time_duration='$duration',
auc_recurr='$auc_recu',auc_fixed_price=$auc_fixed_price,total_time='$auc_due_time',
shipping_id='$shippingmethod',future_tstamp='$futuretstamp',recurr_count='$productQty',auction_min_price='$minimumaucprice',min_win_price='$minwinprice',use_free='$useonlyfree',allowbuynow=
'$allowbuynow',buynowprice='$buynowprice',uniqueauction='$uniqueauction',reverseauction='$reverseauction',tax1='$tax1',tax2='$tax2',relist='$relist',seatauction='$seatauction',minseats='$minseats',
maxseats='$maxseats',seatbids='$seatbids',bidpack='$bidpack', cashauction='$cashauction', reserve = '$reserve'  where auctionID='$editid'";
        db_query($qryupd) or die(db_error());

        $qryupd1 = "update auction_running set
productID='$productID',auc_status='$auc_status',auc_start_price='$auc_start_price',fixedpriceauction='$fpa',pennyauction='$pa',nailbiterauction='$nba',offauction='$off',nightauction='$na',openauction=
'$oa',time_duration='$duration',use_free='$useonlyfree',uniqueauction='$uniqueauction',reverseauction='$reverseauction',seatauction='$seatauction',minseats='$minseats',maxseats='$maxseats',seatbids=
'$seatbids',locktype='$locktype',locktime='$locktime',lockprice='$lockprice',relist='$relist', cashauction='$cashauction', reserve='$reserve' where auctionID='$editid'";
        db_query($qryupd1) or die(db_error());


    }

            header("location: message.php?msg=15");
        exit;
}
/* 	if($_REQUEST["restartauction"]!="" & $_REQUEST["restart_auction"]!="")
  {
  $futuretstamp = mktime($_REQUEST["aucstarthours"],$_REQUEST["aucstartminutes"],$_REQUEST["aucstartseconds"],$auc_start_date_ex[1],$auc_start_date_ex[0],$auc_start_date_ex[2]);

  if($changesval=="1" && $auc_status=="2")
  {
  $auc_status = 1;
  }

  $qryupd = "update auction set
auc_start_date='$auc_start_date',auc_end_date='$auc_end_date',auc_start_time='$auc_start_time',auc_end_time='$auc_end_time',auc_status='$auc_status',fixedpriceauction='$fpa',pennyauction='$pa',
nailbiterauction='$nba',offauction='$off',nightauction='$na',openauction='$oa',time_duration='$duration',auc_recurr='$auc_recu',auc_fixed_price='$auc_fixed_price',total_time='$auc_due_time',
shipping_id='$shippingmethod',future_tstamp='$futuretstamp' where auctionID='".$_REQUEST["restart_auction"]."'";
  db_query($qryupd) or die(db_error());

  $qryd = "delete from auc_due_table where auction_id='".$_REQUEST["restart_auction"]."'";
  db_query($qryd) or die(db_error());

  $delwonentry = "delete from won_auctions where userid='0' and auction_id='".$_REQUEST["restart_auction"]."'";
  db_query($delwonentry) or die(db_error());

  } */
if ($_REQUEST["delete_auction"]) {
    $delid = $_REQUEST["delete_auction"];

    $qryseld = "select a.auc_status, a.recurr_count, p.qty_flag, a.productID from auction a left join products p on a.productID=p.productID where auctionID=" . $delid;
    $resseld = db_query($qryseld);
    $del = db_fetch_object($resseld);
    db_free_result($resseld);
    /*
      if($del->auc_status==2)
      {
      header("location: message.php?msg=16");
      exit;
      }
     */
    if ($del->recurr_count > 0 && $del->qty_flag == 1) {
        $updpro = "update products set product_qty=product_qty + " . $del->recurr_count . " where productID=" . $del->productID;
        db_query($updpro) or die(db_error());
    }
    $qrydel = "delete from auction where auctionID=" . $delid;
    db_query($qrydel) or dir(db_error());
    clearRunningTable($delid);
    header("location: message.php?msg=13");
}else

if ($_REQUEST["auction_edit"] != "" or $_REQUEST["auction_delete"] != "" or $_REQUEST["auction_clone"] || $_REQUEST["auction_restart"]) {
    if ($_REQUEST["auction_edit"] != "") {
        $aid = $_REQUEST["auction_edit"];
    }
    if ($_REQUEST["auction_delete"] != "") {
        $aid = $_REQUEST["auction_delete"];
    }
    if ($_REQUEST["auction_clone"] != "") {
        $aid = $_REQUEST["auction_clone"];
    }
    if ($_REQUEST["auction_restart"] != "") {
        $aid = $_REQUEST["auction_restart"];
    }
    $qrys = "select auctionID,a.productID as productID,a.categoryID as categoryID,auc_start_price,auc_final_price,auc_start_date,auc_end_date,auc_start_time,auc_end_time,auc_status,auc_type,auc_recurr,buy_user,
        auc_fixed_price,fixedpriceauction,pennyauction,nailbiterauction,offauction,nightauction,openauction,time_duration,auc_final_end_date,total_time,pause_status,shipping_id,future_tstamp,recurr_count,auction_min_price,min_win_price,relist,
        use_free,allowbuynow,buynowprice,reverseauction,uniqueauction,lockauction,locktype,locktime,lockprice,halfbackauction,seatauction,bidpack,minseats,maxseats,seatbids,tax1,tax2,bidpack_name,bidpack_price,bidpack_banner,bidpack_banner2,bidpack_banner3,bidpack_banner4,picture1,picture2,picture3,picture4,price, reserve, cashauction from auction a left join products p on a.productID=p.productID left join bidpack b on b.id=a.productID where a.auctionID =" . $aid;
    $ress = db_query($qrys);
    $total = db_affected_rows();
    $rows = db_fetch_object($ress);
    if ($total > 0) {
        $category = $rows->categoryID;
        $product = $rows->productID;
        $isbidpack = $rows->bidpack;
        $pprice = $isbidpack ? $rows->bidpack_price : $rows->price;

        $pproductQty = $rows->product_qty;
        $aucstartprice = $rows->auc_start_price;
        $aucstartdate = $rows->auc_start_date;
        //$aucstartyear =  substr($aucstartdate,0,4);
        //$aucstartmonth = substr($aucstartdate,5,2);
        //$aucstartdate =  substr($aucstartdate,8,2);
        $aucenddate = $rows->auc_end_date;
        //$aucendyear =  substr($aucenddate,0,4);
        //$aucendmonth = substr($aucenddate,5,2);
        //$aucenddate =  substr($aucenddate,8,2);
        $aucstarttime = $rows->auc_start_time;
        $aucsthours = substr($aucstarttime, 0, 2);
        $aucstmin = substr($aucstarttime, 3, 2);
        $aucstsec = substr($aucstarttime, 6, 2);
        $aucendtime = $rows->auc_end_time;
        $aucendhours = substr($aucendtime, 0, 2);
        $aucendmin = substr($aucendtime, 3, 2);
        $aucendsec = substr($aucendtime, 6, 2);
        $aucstatus = $rows->auc_status;
        $auctype = $rows->auc_type;
        $aucrecu = $rows->auc_recurr;
        $auc_fixed_price = $rows->auc_fixed_price;
        $userid = $rows->buy_user;
        $shippingchargeid = $rows->shipping_id;
        $recuur_count = $rows->recurr_count;
        $allowbuynow = $rows->allowbuynow;
        $buynowprice = $rows->buynowprice;
if(db_num_rows(db_query("SHOW COLUMNS FROM auction WHERE Field = 'reserve'")) >=1 ){
$reserve = $rows->reserve;
}else{
$reserve = '';
}
if(db_num_rows(db_query("SHOW COLUMNS FROM auction WHERE Field = 'cashauction'")) >=1 ){
$cashauction = $rows->cashauction;
}else{
$cashauction = '';
}
        $uniqueauction = $rows->uniqueauction;
        $reverseauction = $rows->reverseauction;
        $halfback = $rows->halfbackauction;
        $lockauction = $rows->lockauction;
        $locktype = $rows->locktype;
        $locktime = $rows->locktime;
        $lockprice = $rows->lockprice;
        $seatauction = $rows->seatauction;
        $minseats = $rows->minseats;
        $maxseats = $rows->maxseats;
        $seatbids = $rows->seatbids;
        $relist = $rows->relist;
        $tax1 = $rows->tax1;
        $tax2 = $rows->tax2;

        $picture1 = $isbidpack ? $rows->bidpack_banner : $rows->picture1;
        $picture2 = $isbidpack ? $rows->bidpack_banner2 : $rows->picture2;
        $picture3 = $isbidpack ? $rows->bidpack_banner3 : $rows->picture3;
        $picture4 = $isbidpack ? $rows->bidpack_banner4 : $rows->picture4;
    }
}

function updateRunTable($aid, $newtime, $newprice) {
    $retsel = db_query("select count(*) from auction_running where auctionid='$aid'");
    if (db_result($retsel, 0) > 0) {
        $sql = "update auction_run_status set lefttime='$newtime',newprice='$newprice',heighuser=[], heighuseravatar='' where auctionid='$aid'";
        db_query($sql);
    } else {
        initRunningTable($aid);
    }
}

function initRunningTable($aid) {
    $sqlsel = "select * from auction where auctionID='$aid'";
    $result = db_query($sqlsel);
    if (db_num_rows($result) > 0) {
        $auction = db_fetch_array($result);
        $sqlins = "insert into auction_running(auctionID,productID,auc_start_price,auc_status,pause_status,time_duration,use_free,fixedpriceauction,
            pennyauction,nailbiterauction,offauction,nightauction,openauction,reverseauction,uniqueauction,halfbackauction,seatauction,minseats,maxseats,
            seatbids,lockauction,locktype,locktime,lockprice,relist) values('{$auction['auctionID']}','{$auction['productID']}','{$auction['auc_start_price']}','{$auction['auc_status']}','{$auction['pause_status']}','{$auction['time_duration']}','{$auction['use_free']}','{$auction['fixedpriceauction']}',
            '{$auction['pennyauction']}','{$auction['nailbiterauction']}','{$auction['offauction']}','{$auction['nightauction']}','{$auction['openauction']}','{$auction['reverseauction']}','{$auction['uniqueauction']}','{$auction['halfbackauction']}','{$auction['seatauction']}','{$auction['minseats']}','{$auction['maxseats']}',
            '{$auction['seatbids']}','{$auction['lockauction']}','{$auction['locktype']}','{$auction['locktime']}','{$auction['lockprice']}','{$auction['relist']}')";
        if (!db_query($sqlins)) {
            return false;
        }

        $sqlins2 = "insert into auction_run_status(auctionid,lefttime,newprice,heighuseravatar,heighuser,uniqueauction,lowbidcount,seatauction,seatauctionnow,seatcount,minseats)
            values('{$auction['auctionID']}','{$auction['total_time']}','{$auction['auc_start_price']}','','[]','{$auction['uniqueauction']}','0','{$auction['seatauction']}','{$auction['seatauction']}','0','{$auction['minseats']}')";
        if (!db_query($sqlins2)) {
            return false;
        }
    }
    return true;
}

function clearRunningTable($aid) {
    $delsql = "delete from auction_running where auctionID='$aid'";
    if (!db_query($delsql)) {
        return false;
    }

    $delsql = "delete from auction_run_status where auctionid='$aid'";
    if (!db_query($delsql)) {
        return false;
    }

    $delsql = "delete from bid_account_bidding where auction_id='$aid'";
    if (!db_query($delsql)) {
        return false;
    }

    $delsql = "delete from free_account_bidding where auction_id='$aid'";
    if (!db_query($delsql)) {
        return false;
    }
    return true;
}
?>
  <?php include("$BASE_DIR/include/addons/blank_page/page_headers.php"); ?>
        

        <script type="text/javascript">

	     function delconfirm(loc)
            {
                if(confirm("Are you sure do you want to delete this?"))
                {
                    window.location.href=loc;
                }
                return false;
            }
            
        
    function condate(dt)
    {
        var ndate= new String(dt);
        //alert(dt);
        var fdt=ndate.split("/");
        var nday=fdt[0];
        var nmon=fdt[1];
        var nyear=fdt[2];

        var finaldate=nmon+"/"+nday+"/"+nyear;
        //alert(finaldate);

        return finaldate;
    }
            function Check(f1)
            {


                var aucsdate = condate($('#aucstartdate').val());
                var curdate = condate($('#curdate').val());
                var aucedate = condate($('#aucenddate').val());
                var newaucsdate = new Date(aucsdate);
                var newcurdate = new Date(curdate);
                var newaucedate = new Date(aucedate);

                var newtime = $('#curtime').val();
                var temptime = newtime.split(":");

                var newtimehour = temptime[0];
                var newtimeminute = temptime[1];
                var newtimeseconds = temptime[2];
                if($('#category').val()=="none")
                {
                    alert("Please Select Category!!!");
                    $('#category').focus();
                    return false;
                }else 

                if($('#product').val()=="none")
                {
                    alert("Please Select Product!!!");
                    $('#product').focus();
                    return false;
                }else 


                if($("#uniqueauction").attr('checked')==false){
                    if($('#aucstartprice').val() == '')
                    {
                        alert("Please Enter Auction Start Price!!!");
                        $('#uniqueauction').focus();
                        return false;
                    }
                }else 


		  if($("#aucstartprice").val()< parseFloat(0.00, 2) )
                    {

                      alert("Auction Start Price Should Be At Least 0.00!!!");
                        $('#uniqueauction').focus();
                        return false;


		    }else 

		
                if($('#uniqueauction').attr('checked') & $('#reverseauction').attr('checked')){
                    alert("Can't check uniqueauctions and reverseauction at the same time!!!");
                    return false;
                }else 


                if($('#uniqueauction').attr('checked') & $('#seatauction').attr('checked')){
                    alert("Can't check uniqueauctions and seatauction at the same time!!!");
                    return false;
                }else 



                if($('#aucstartdate').val()=="")
                {
                    alert("Please Select Auction Start Date!!!");
                    $('#aucstartdate').focus();
                    return false;
                }else 


                if($('#aucenddate').val()=="")
                {
                    alert("Please Select Auction End Date!!!");
                    $('#aucenddate').focus();
                    return false;
                }else


       
        if($('#aucstarthours').val() == '')
        {
            alert("Please Select Auction Start Time!!!");
            $('#aucstarthours').focus();
            return false;
        }else 


        if($('#aucstartminutes').val() == '')
        {
            alert("Please Select Auction Start Time!!!");
            $('#aucstartminutes').focus();
            return false;
        }else 


        if($('#aucstartseconds').val() == '')
        {
            alert("Please Select Auction Start Time!!!");
            $('#aucstartseconds').focus();
            return false;
        }else 


        if($('#aucendhours').val() == '')
        {
            alert("Please Select Auction End Time!!!");
            $('#aucendhours').focus();
            return false;
        }else 


        if($('#aucendminutes').val() == '')
        {
            alert("Please Select Auction End Time!!!");
            $('#aucendminutes').focus();
            return false;
        }else 


        if($('#aucendseconds').val() == '')
        {
            alert("Please Select Auction End Time!!!");
            $('#aucendseconds').focus();
            return false;
        }else 


        if($('#fpa').attr('checked')==true && $('#off').attr('checked')==true)
        {
            alert("You can't select fixed price auction type with 100% off auction type!!!");
            return false;
        }else 


        if($('#allowbuynow').attr('checked')==true && $('#buynowprice').val() == ''){
            alert("You should enter a buy now price");
            return false;
        }else 


        if(aucsdate==aucedate)
        {
            if(Number($('#aucendhours').val())<Number($('#aucstarthours').val()))
            {
                alert("Auction end time should be greater than auctin start time!!!");
                $('#aucendhours').focus();
                return false;
            }
            else
            {
                if(Number($('#aucendhours').val())==Number($('#aucstarthours').val()))
                {
                    if(Number($('#aucendminutes').val())<Number($('#aucstartminutes').val()))
                    {
                        alert("Auction end time should be greater than auctin start time!!!");
                        $('#aucendminutes').focus();
                        return false;
                    }
                    else
                    {
                        if(Number($('#aucendminutes').val())==Number($('#aucstartminutes').val()))
                        {
                            if(Number($('#aucendseconds').val())==Number($('#aucstartseconds').val()))
                            {
                                alert("Auction end time should be greater than auctin start time!!!");
                                $('#aucendseconds').focus();
                                return false;
                            }

                        }
                    }
                }
            }
        }else 


        if($('#fpa').attr('checked')==false && $('#pa').attr('checked')==false && $('#nba').attr('checked')==false && $('#off').attr('checked')==false && $('#na').attr('checked')==false && $('#oa').attr('checked')==false && $('#uniqueauction').attr('checked')==false && $('#reverseauction').attr('checked')==false && $('#halfback').attr('checked')==false && $('#seatauction').attr('checked')==false && $('#lockauction').attr('checked')==false  && $('#cashauction').attr('checked')==false)
        {
            alert("Please select auction type");
            return false;
        }else 

        if($('#shippingmethod').val()=="none")
        {
            alert("Please select shipping charge method");
            $('#shippingmethod').focus();
            return false;
        }else 


        if($('#seatauction').attr('checked')){
            if(Number($('#minseats').val())<=0){
                alert('Min Seats Must be greater  then 0');
                return false;
            }

            if(Number($('#maxseats').val())!=0 && Number($('#minseats').val())>Number($('#maxseats').val())){
                alert('Max Seats Must greater or equal min seats');
                return false;
            }

            if(Number($('#seatbids').val())<=0){
                alert('SeatBids must greater then 0');
                return false;
            }
        }else 


        if($('#lockauction').attr('checked')){
            if($('#locktype').val()==1){
                var locktime=(Number($('#lockhour').val())*60+Number($('#lockminute').val()))*60+Number($('#locksecond').val());
                if(locktime<=0){
                    alert('Please enter when to lock the auction');
                    return false;
                }
            }else if($('#locktype').val()==2){
                if(Number($('#lockprice').val())<=0){
                    alert('Please enter lock price');
                    return false;
                }
            }
        }else{
        
         submit_test_ajax_form('backend_form', '<?php echo $SITE_URL;?>include/addons/blank_page/index.php?edit_page=true&add_new_page=addauction', 'container');
             
        }

    }
    
    
	    
        </script>

                        <div class="section">
                            <!--[if !IE]>start title wrapper<![endif]-->
                            <div class="title_wrapper">
                                <h2>
                                    <?php if ($_GET['auction_edit'] != "") {
                                    ?> Edit Auction<?
                                    } else {
                                        if ($_GET['auction_delete'] != "") {
                                    ?> Confirm Delete Auction <?php } else {
                                    ?> Add Auction <?
                                        }
                                    }
                                    ?>
                                </h2>
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
                                                        <?php if ($aucstatus == "2") {
                                                        ?>
                                                            <li class="red"><span class="ico"></span><strong class="system_title">(Note: This Auction is currently running, So you cannot modify it at the moment.)</strong></li>
                                                        <?php
                                                        }
                                                        if ($aid != "" && $_REQUEST["auction_clone"] == "") {
                                                        ?>
                                                        <?
                                                        }
                                                        ?>
                                                        <li class="blue"><span class="ico"></span><strong class="system_title"><span class="required">*</span> Required Information</strong></li>
                                                    </ul>

                                                    <!--[if !IE]>end system messages<![endif]-->

                                                    <!--[if !IE]>start forms<![endif]-->
                                                    <form name="f1" id="backend_form" action='javascript: Check(this);' method='POST' enctype="multipart/form-data" class="search_form general_form">
                                                        <!--[if !IE]>start fieldset<![endif]-->
                                                        <fieldset>
                                                            <!--[if !IE]>start forms<![endif]-->
                                                            <div class="forms">
                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Category:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper blank">
                                                                            <select name="category" id="category">
                                                                                <option value="none">select one</option>
                                                                                <?
                                                                                $qryc = "select * from categories where status='1'";
                                                                                $resc = db_query($qryc);
                                                                                $totalc = db_affected_rows();
                                                                                while ($namec = db_fetch_array($resc)) {
                                                                                ?>
                                                                                    <option <?= $category == $namec["categoryID"] ? "selected" : ""; ?> value="<?= $namec["categoryID"]; ?>"><?= $namec["name"]; ?></option>
                                                                                <?
                                                                                }
                                                                                ?>
<!--                                                                                <option value="bidpack" <?php echo $isbidpack ? 'selected' : '' ?>>Bid Pack Auction</option>-->
                                                                            </select>
                                                                        </span>
                                                                        <span class="system required">*</span>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->

                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Product:</label>
                                                                    <span class="input_wrapper blank">
                                                                        <select name="product" id="product">
                                                                            <option value="none">select one</option>
                                                                            <?php if ($isbidpack == 0) {
                                                                            ?>

                                                                            <?php
                                                                                    $qryp = "select * from products where categoryID=$category";
                                                                                    $resp = db_query($qryp);
                                                                                    $totalp = db_affected_rows();
                                                                                    while ($objp = db_fetch_array($resp)) {
                                                                            ?>
                                                                                        <option <?= $product == $objp["productID"] ? "selected" : "";
                                                                            ?> value="<?= $objp["productID"];
                                                                            ?>"><?= stripslashes($objp["name"]);
                                                                            ?></option>
                                                                            <?
                                                                                    }
                                                                            ?>


                                                                            <?php } else {
 ?>

                                                                            <?php
                                                                                    $qrybid = "select bidpack_name,id from bidpack";
                                                                                    $bidresult = db_query($qrybid);
                                                                                    while ($bidobj = db_fetch_array($bidresult)) {
                                                                            ?>
                                                                                        <option <?php echo $product == $bidobj["id"] ? "selected" : ""; ?> value="<?php echo $bidobj["id"]; ?>"><?php echo stripslashes($bidobj["bidpack_name"]); ?></option>
                                                                            <?php } ?>
<?php } ?>
                                                                            </select>
                                                                        </span>
                                                                        <span class="system required">*</span>
                                                                    </div>
                                                                    <!--[if !IE]>end row<![endif]-->

                                                                    <!--[if !IE]>start row<![endif]-->
                                                                    <div class="row">
                                                                        <label>Product Market Price:</label>
                                                                        <div class="inputs">
                                                                            <span  id="getprice" class=""><?= $pprice != "" ? $pprice : ""; ?></span>
                                                                        </div>
                                                                        <span class="system required">*</span>
                                                                    </div>
                                                                    <!--[if !IE]>end row<![endif]-->

                                                                    <!--[if !IE]>start row<![endif]-->
                                                                    <div class="row">
                                                                        <label>Product Picture:</label>
                                                                        <div class="inputs">
                                                                            <div class="buttons" style="padding:0px 0px 20px 0px;width:600px;" id="product_picture">
                                                                            <?php if ($picture1 != '') { ?>
                                                                                    <img src="<?php echo $SITE_URL;?>/uploads/products/thumbs_big/thumbbig_<?php echo $picture1; ?>"/>
                                                                            <?php } ?>

                                                                            <?php if ($picture2 != '') {
 ?>
                                                                                    <img src="<?php echo $SITE_URL;?>/uploads/products/thumbs_big/thumbbig_<?php echo $picture2; ?>"/>
<?php } ?>

<?php if ($picture3 != '') { ?>
                                                                                    <img src="<?php echo $SITE_URL;?>/uploads/products/thumbs_big/thumbbig_<?php echo $picture3; ?>"/>
<?php } ?>

<?php if ($picture4 != '') { ?>
                                                                                    <img src="<?php echo $SITE_URL;?>/uploads/products/thumbs_big/thumbbig_<?php echo $picture4; ?>"/>
<?php } ?>


                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                    <!--[if !IE]>end row<![endif]-->

                                                                    <!--[if !IE]>start row<![endif]-->
                                                                    <div class="row">
                                                                        <label>Auction Type:</label>
                                                                        <div class="inputs" style="width:750px;">
                                                                            <ul class="inline">
                                                                                <li><input class="checkbox" <?= $rows->fixedpriceauction == "1" ? "checked" : "" ?> type="checkbox" id="fpa" name="fpa" value="1"/> Fixed Price Auction</li>
                                                                                <li><input class="checkbox" <?= $rows->offauction == "1" ? "checked" : "" ?> type="checkbox" name="off" value="1"/> 100% off</li>
                                                                            </ul>
                                                                            <ul class="inline">
                                                                                <li><input class="checkbox" <?= $rows->pennyauction == "1" ? "checked" : "" ?> type="checkbox" name="pa" value="1"/> Cent Auction</li>
                                                                                <li><input class="checkbox" <?= $rows->nightauction == "1" ? "checked" : "" ?> type="checkbox" name="na" value="1"/> Night Auction</li>
                                                                            </ul>
                                                                            <ul class="inline">
                                                                                <li><input class="checkbox" <?= $rows->nailbiterauction == "1" ? "checked" : "" ?> type="checkbox" name="nba" value="1"/> NailBiter Auction</li>
                                                                                <li><input class="checkbox" <?= $rows->openauction == "1" ? "checked" : "" ?> type="checkbox" name="oa" value="1"/> Open Auction</li>
                                                                            </ul>
                                                                            <ul class="inline">
                                                                                <li><input class="checkbox" <?php echo $uniqueauction == 1 ? "checked" : "" ?> type="checkbox" id="uniqueauction" name="uniqueauction" value="1"/> Lowest Unique Auction</li>
                                                                                <li><input class="checkbox" <?= $reverseauction == "1" ? "checked" : "" ?> type="checkbox" id="reverseauction" name="reverseauction" value="1"/> Reverse Auction</li>
                                                                            </ul>
                                                                            <ul class="inline">
                                                                                <li><input class="checkbox" <?php echo $halfback == 1 ? "checked" : "" ?> type="checkbox" id="halfback" name="halfback" value="1"/> Half Back Bid Auction</li>
                                                                                <li><input class="checkbox" <?php echo $seatauction == 1 ? "checked" : "" ?> type="checkbox" id="seatauction" name="seatauction" value="1"/> Seat Auction</li>
                                                                            </ul>
                                                                            <ul class="inline">
                                                                                <li><input class="checkbox" <?php echo $lockauction == 1 ? "checked" : "" ?> type="checkbox" id="lockauction" name="lockauction" value="1"/> Lock Auction</li>
                                                                            </ul>
<?php
if(file_exists("newauctions/index.php")){

include("newauctions/index.php");



}
?>
                                                                        </div>
                                                                    </div>
                                                                    <!--[if !IE]>end row<![endif]-->


                                                                    <div id="lockauction_panel" style="display:<?php echo $lockauction == 0 ? "none" : "block"; ?>">
                                                                        <!--[if !IE]>start row<![endif]-->
                                                                        <div class="row">
                                                                            <label>Lock Type:</label>
                                                                            <div class="inputs">
                                                                                <span class="input_wrapper blank">
                                                                                    <select name="locktype" id="locktype">
                                                                                        <option value="1" <?php echo $locktype == 1 ? 'selected' : ''; ?>>Time Locker</option>
                                                                                        <option value="2" <?php echo $locktype == 2 ? 'selected' : ''; ?>>Price Locker</option>
                                                                                    </select>
                                                                                </span>
                                                                            </div>
                                                                        </div>
                                                                        <!--[if !IE]>end row<![endif]-->

                                                                    <?php
                                                                                $locksecond = $locktime % 60;
                                                                                $lockminutes = floor($locktime / 60) % 60;
                                                                                $lockhours = floor(floor($locktime / 60) / 60);
                                                                    ?>

                                                                                <!--[if !IE]>start row<![endif]-->
                                                                                <div class="row" id="locktime_row" style="display:<?php echo $locktype == 1 ? 'block' : 'none'; ?>">
                                                                                    <label>Lock Time:</label>
                                                                                    <div class="inputs">
                                                                                        <span class="input_wrapper_custom blank">
                                                                                            <select name="lockhour" id="lockhour" style="display:inline;width:auto;">
<?php for ($hour = 0; $hour <= 24; $hour++) { ?>
                                                                                    <option <?php echo $hour == $lockhours ? 'selected' : ''; ?>><?php echo $hour; ?></option>
<?php } ?>
                                                                                </select>
                                                                                <select name="lockminute" id="lockminute" style="display:inline;width:auto;">
<?php for ($minute = 0; $minute <= 59; $minute++) { ?>
                                                                                    <option <?php echo $minute == $lockminutes ? 'selected' : ''; ?>><?php echo $minute; ?></option>
<?php } ?>
                                                                                </select>
                                                                                <select name="locksecond" id="locksecond" style="display:inline;width:auto;">
<?php for ($second = 0; $second <= 59; $second++) { ?>
                                                                                    <option <?php echo $second == $locksecond ? 'selected' : ''; ?>><?php echo $second; ?></option>
<?php } ?>
                                                                                </select>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                    <!--[if !IE]>end row<![endif]-->

                                                                    <!--[if !IE]>start row<![endif]-->
                                                                    <div class="row" id="lockprice_row" style="display:<?php echo $locktype == 2 ? 'block' : 'none'; ?>">
                                                                        <label>Lock Price:</label>
                                                                        <div class="inputs">
                                                                            <span class="input_wrapper">
                                                                                <input name="lockprice" type="text" class="text" id="lockprice" value="<?php echo number_format($lockprice, 2); ?>" size="12" maxlength="20"/>
                                                                            </span>
                                                                            <span class="system required">$</span>
                                                                        </div>
                                                                    </div>
                                                                    <!--[if !IE]>end row<![endif]-->

                                                                </div>

                                                                <div id="seatauction_panel" style="display:<?php echo $seatauction == 0 ? "none" : "block"; ?>">
                                                                    <!--[if !IE]>start row<![endif]-->
                                                                    <div class="row">
                                                                        <label>Min Seats:</label>
                                                                        <div class="inputs">
                                                                            <span class="input_wrapper">
                                                                                <input name="minseats" type="text" class="text" id="minseats" value="<?php echo $minseats; ?>" size="12" maxlength="20"/>
                                                                            </span>
                                                                            <span class="system required">*</span>

                                                                        </div>
                                                                    </div>
                                                                    <!--[if !IE]>end row<![endif]-->
                                                                    <!--[if !IE]>start row<![endif]-->
                                                                    <div class="row">
                                                                        <label>Max Seats:</label>
                                                                        <div class="inputs">
                                                                            <span class="input_wrapper">
                                                                                <input name="maxseats" type="text" class="text" id="maxseats" value="<?php echo $maxseats; ?>" size="12" maxlength="20"/>
                                                                            </span>
                                                                            <span class="system required">*</span>
                                                                            <span class="system message">Set it to 0 when no limit for max seats</span>
                                                                        </div>
                                                                    </div>
                                                                    <!--[if !IE]>end row<![endif]-->

                                                                    <!--[if !IE]>start row<![endif]-->
                                                                    <div class="row">
                                                                        <label>Seat Bids:</label>
                                                                        <div class="inputs">
                                                                            <span class="input_wrapper">
                                                                                <input name="seatbids" type="text" class="text" id="seatbids" value="<?php echo $seatbids; ?>" size="12" maxlength="20"/>
                                                                            </span>
                                                                            <span class="system required">*</span>
                                                                        </div>
                                                                    </div>
                                                                    <!--[if !IE]>end row<![endif]-->
                                                                </div>



                                                                <div id="normalauction" style="display:<?php echo $uniqueauction == 1 ? "none" : "block"; ?>">
                                                                    <!--[if !IE]>start row<![endif]-->
                                                                    <div class="row">
                                                                        <label>Auction Start Price:</label>
                                                                        <div class="inputs">
                                                                            <span class="input_wrapper">
                                                                                <input name="aucstartprice" type="text" class="text" id="aucstartprice" value="<?php if(!empty($aucstartprice)){ echo $aucstartprice; }else{ echo '0.00'; } ?>" size="12"
maxlength="20"/>
                                                                            </span>
                                                                            <span class="currency"><?= $Currency; ?></span>
                                                                            <span class="system required">*</span>
                                                                        </div>
                                                                    </div>
                                                                    <!--[if !IE]>end row<![endif]-->
<?php
if(file_exists("newauctions/reserve.php")){


include("newauctions/reserve.php");
}
?>

                                                                    <!--[if !IE]>start row<![endif]-->
                                                                    <div class="row">
                                                                        <label>Auction Fixed Price:</label>
                                                                        <div class="inputs">
                                                                            <span class="input_wrapper">
                                                                                <input name="aucfixedprice" type="text" class="text" value="<?php echo $auc_fixed_price; ?>" size="12" disabled="disabled" id="aucfixedprice" maxlength="20"/>
                                                                            </span>
                                                                            <span class="currency"><?= $Currency; ?></span>
                                                                            <span class="system required">*</span>
                                                                            <span class="system message">(Compulsory: If Auction Type is selected to Fixed price)</span>
                                                                        </div>
                                                                    </div>
                                                                    <!--[if !IE]>end row<![endif]-->
                                                                </div>



                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>&nbsp;</label>
                                                                    <div class="inputs">
                                                                        <ul class="inline">
                                                                            <li><input class="checkbox" <?= $allowbuynow == "1" ? "checked" : "" ?> type="checkbox" id="allowbuynow" name="allowbuynow" value="1"/> Allow Buy Now</li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->

                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Buy Now Price:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper">
                                                                            <input name="buynowprice" type="text" class="text" value="<?= $buynowprice ?>" size="12" id="buynowprice" <?php echo $allowbuynow == 1 ? '' : 'disabled="true"' ?> maxlength="20"/>
                                                                        </span>
                                                                        <span class="currency"><?= $Currency; ?></span>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->

                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Auction Date:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper_custom">
                                                                            <input type="text" name="aucstartdate" id="aucstartdate" value="<?php if($aucstartdate != ""){ echo date($globalDateformat,
strtotime($aucstartdate)); }else{ echo date($globalDateformat); } ""; ?>"  />
                                                                            <strong>&nbsp;To&nbsp;</strong>
                                                                            <input type="text" size="12" name="aucenddate" id="aucenddate" value="<?php if($aucenddate != ""){ echo
date($globalDateformat, strtotime($aucenddate)); }else{ echo date($globalDateformat); } ""; ?>" />
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->

                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Auction Time:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper_custom blank">

									  <!--
									      $aucsthours = substr($aucstarttime, 0, 2);
									      $aucstmin = substr($aucstarttime, 3, 2);
									      $aucstsec = substr($aucstarttime, 6, 2);
									      $aucendtime = $rows->auc_end_time;
									      $aucendhours = substr($aucendtime, 0, 2);
									      $aucendmin = substr($aucendtime, 3, 2);
									      $aucendsec = substr($aucendtime, 6, 2);
										-->
                                                                            <?php if ($aucstatus == "3" and $userid == 3) { ?>
                                                                                    <select name="aucstarthours" id="aucstarthours" style="display:inline;width:auto;">
										      
										      <option value="<?php if(!empty($aucsthours)){ echo $aucsthours; }else{ echo date("H"); } ?>"><?php
if(!empty($aucsthours)){ echo $aucsthours; }else{ echo date("H"); } ?></option>
                                                                                <?php for ($h = 0; $h <= 23; $h++) {
 ?>
                                                                                        <option value="<?php echo str_pad($h, 2, "0",STR_PAD_LEFT); ?>"><?php echo $h; ?></option>
										    <?php } ?>
                                                                                </select> :


										
                                                                                <!--<input maxlength="2" type="text" name="aucstarthours" size="2" value="<?php //date("H")!=""?date("H"):"";                        ?>">-->
<?php } else { ?>
                                                                                    <select name="aucstarthours" id="aucstarthours" style="display:inline;width:auto;">
                                                                                       <option value="<?php if(!empty($aucsthours)){ echo $aucsthours; }else{ echo date("H"); } ?>"><?php
if(!empty($aucsthours)){ echo $aucsthours; }else{ echo date("H"); } ?></option>
                                                                                <?php for ($h = 0; $h <= 23; $h++) { ?>
                                                                                        <option <?= $aucsthours == $h ? "selected" : ""; ?> value="<?= str_pad($h, 2, "0", STR_PAD_LEFT); ?>"><?= str_pad($h, 2, "0", STR_PAD_LEFT); ?></option>
                                                                                <?php } ?>
                                                                                </select> :
                                                                            <?php /* ?><input maxlength="2" type="text" name="aucstarthours" size="2" value="<?=$aucsthours!=""?$aucsthours:"";?>"> :<?php */ ?>
                                                                            <?php } ?>
                                                                            <?php if ($aucstatus == "3" and $userid == 3) {
 ?>
                                                                                    <select name="aucstartminutes" id="aucstartminutes" style="display:inline;width:auto;">
                                                                                        <option value="">mm</option>
<?php for ($m = 0; $m <= 59; $m++) { ?>
                                                                                        <option <?= date("i") == $m ? "selected" : ""; ?> value="<?= str_pad($m, 2, "0", STR_PAD_LEFT); ?>"><?= str_pad($m, 2, "0", STR_PAD_LEFT); ?></option>
<?php } ?>
                                                                                </select> :
                                                                            <?php /* ?><input maxlength="2" type="text" name="aucstartminutes" size="2" value="<?=date("i")!=""?date("i"):"";?>"> :<?php */ ?>
<?php } else { ?>
                                                                                    <select name="aucstartminutes" id="aucstartminutes" style="display:inline;width:auto;">
                                                                                        <option value="">mm</option>
<?php for ($m = 0; $m <= 59; $m++) { ?>
                                                                                        <option <?= $aucstmin == $m ? "selected" : ""; ?> value="<?= str_pad($m, 2, "0", STR_PAD_LEFT); ?>"><?= str_pad($m, 2, "0", STR_PAD_LEFT); ?></option>
<?php } ?>
                                                                                </select> :
                                                                            <?php /* ?><input maxlength="2" type="text" name="aucstartminutes" size="2" value="<?=$aucstmin!=""?$aucstmin:"";?>"> :<?php */ ?>
                                                                            <?php } ?>
<?php if ($aucstatus == "3" and $userid == 3) { ?>
                                                                                    <select name="aucstartseconds" id="aucstartseconds" style="display:inline;width:auto;">
                                                                                        <option value="">ss</option>
<?php for ($s = 0; $s <= 59; $s++) { ?>
                                                                                        <option <?= date("s") == $s ? "selected" : ""; ?> value="<?= str_pad($s, 2, "0", STR_PAD_LEFT); ?>"><?= str_pad($s, 2, "0", STR_PAD_LEFT); ?></option>
<?php } ?>
                                                                                </select>
                                                                            <?php /* ?><input maxlength="2" type="text" name="aucstartseconds" size="2" value="<?=date("s")!=""?date("s"):"";?>"><?php */ ?>
                                                                            <?php } else { ?>
                                                                                    <select name="aucstartseconds" id="aucstartseconds" style="display:inline;width:auto;">
                                                                                        <option value="">ss</option>
                                                                                <?php for ($s = 0; $s <= 59; $s++) {
                                                                                ?>
                                                                                        <option <?= $aucstsec == $s ? "selected" : ""; ?> value="<?= str_pad($s, 2, "0", STR_PAD_LEFT); ?>"><?= str_pad($s, 2, "0", STR_PAD_LEFT); ?></option>
                                                                                <?php } ?>
                                                                                </select>
                                                                            <?php /* ?><input maxlength="2" type="text" name="aucstartseconds" size="2" value="<?=$aucstsec!=""?$aucstsec:"";?>"><?php */ ?>
                                                                            <?php } ?>
                                                                                <b>&nbsp;To&nbsp;</b>
                                                                            <?php if ($aucstatus == "3" and $userid == 3) {
                                                                            ?>
                                                                                    <select name="aucendhours" style="display:inline;width:auto;">
                                                                                        <option value="">hh</option>
                                                                                <?php for ($h = 0; $h <= 23; $h++) {
 ?>
                                                                                        <option <?= date("H") == $h ? "selected" : ""; ?> value="<?= str_pad($h, 2, "0", STR_PAD_LEFT); ?>"><?= str_pad($h, 2, "0", STR_PAD_LEFT); ?></option>
<?php } ?>
                                                                                </select> :
                                                                            <?php /* ?><input maxlength="2" type="text" name="aucendhours" size="2" value="<?=date("H")!=""?date("H"):"";?>"> :<?php */ ?>
                                                                            <?php } else { ?>
                                                                                    <select name="aucendhours" style="display:inline;width:auto;">
                                                                                        <option value="">hh</option>
                                                                                <?php for ($h = 0; $h <= 23; $h++) {
                                                                                ?>
                                                                                        <option <?= $aucendhours == $h ? "selected" : ""; ?> value="<?= str_pad($h, 2, "0", STR_PAD_LEFT); ?>"><?= str_pad($h, 2, "0", STR_PAD_LEFT); ?></option>
                                                                                <?php } ?>
                                                                                </select> :
                                                                            <?php /* ?><input maxlength="2" type="text" name="aucendhours" size="2" value="<?=$aucendhours!=""?$aucendhours:"";?>"> :<?php */ ?>
                                                                            <?php } ?>
                                                                            <?php if ($aucstatus == "3" and $userid == 3) {
 ?>
                                                                                    <select name="aucendminutes" style="display:inline;width:auto;">
                                                                                        <option value="">mm</option>
                                                                                <?php for ($m = 0; $m <= 59; $m++) { ?>
                                                                                        <option <?= date("i") == $m ? "selected" : ""; ?> value="<?= str_pad($m, 2, "0", STR_PAD_LEFT); ?>"><?= str_pad($m, 2, "0", STR_PAD_LEFT); ?></option>
                                                                                <?php } ?>
                                                                                </select> :
                                                                            <?php /* ?><input maxlength="2" type="text" name="aucendminutes" size="2" value="<?=date("i")!=""?date("i"):"";?>"> :<?php */ ?>
                                                                            <?php } else {
 ?>
                                                                                    <select name="aucendminutes" style="display:inline;width:auto;">
                                                                                        <option value="">mm</option>
                                                                                <?php for ($m = 0; $m <= 59; $m++) { ?>
                                                                                        <option <?= $aucendmin == $m ? "selected" : ""; ?> value="<?= str_pad($m, 2, "0", STR_PAD_LEFT); ?>"><?= str_pad($m, 2, "0", STR_PAD_LEFT); ?></option>
                                                                                <?php } ?>
                                                                                </select> :
                                                                            <?php /* ?><input maxlength="2" type="text" name="aucendminutes" size="2" value="<?=$aucendmin!=""?$aucendmin:"";?>"> :<?php */ ?>
                                                                            <?php } ?>
                                                                            <?php if ($aucstatus == "3" and $userid == 3) {
 ?>
                                                                                    <select name="aucendseconds" style="display:inline;width:auto;">
                                                                                        <option value="">ss</option>
                                                                                <?php for ($s = 0; $s <= 59; $s++) { ?>
                                                                                        <option <?= date("s") == $s ? "selected" : ""; ?> value="<?= str_pad($s, 2, "0", STR_PAD_LEFT); ?>"><?= str_pad($s, 2, "0", STR_PAD_LEFT); ?></option>
                                                                                <?php } ?>
                                                                                </select>
                                                                            <?php /* ?><input maxlength="2" type="text" name="aucendseconds" size="2" value="<?=date("s")!=""?date("s"):"";?>"><?php */ ?>
                                                                            <?php } else {
 ?>
                                                                                    <select name="aucendseconds" style="display:inline;width:auto;">
                                                                                        <option value="">ss</option>
<?php for ($s = 0; $s <= 59; $s++) { ?>
                                                                                        <option <?= $aucendsec == $s ? "selected" : ""; ?> value="<?= str_pad($s, 2, "0", STR_PAD_LEFT); ?>"><?= str_pad($s, 2, "0", STR_PAD_LEFT); ?></option>
<?php } ?>
                                                                                </select>
<?php } ?>
                                                                            </span>
									    <span class="sytem required">(24 hours) The current server time is <span id="clock2"><?= date("H:i:s"); ?></span></span>
                                                                        </div>
                                                                    </div>
                                                                    <!--[if !IE]>end row<![endif]-->

                                                                    <!--[if !IE]>start row<![endif]-->
                                                                    <div class="row">
                                                                        <label>&nbsp;</label>
                                                                        <div class="inputs">
                                                                            <ul class="inline">
                                                                                <li>
                                                                                    <input type="checkbox" class="checkbox" name="startimmidiate" id="startimmidiate" value="start" />&nbsp;Start Immidiately
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                    <!--[if !IE]>end row<![endif]-->

                                                                    <!--[if !IE]>start row<![endif]-->
                                                                    <div class="row">
                                                                        <label>Auction Status:</label>
                                                                        <div class="inputs">
                                                                            <span class="input_wrapper blank">
                                                                                <select name="aucstatus">
                                                                                    <option <?= $aucstatus == "2" ? "selected" : ""; ?> value="2">Active</option>
                                                                                    <option <?= ($aucstatus == "4") ? "selected" : ""; ?> value="4">Pending</option>
                                                                                <?php if ($_REQUEST["auction_edit"] != "" && $userid != 0) { ?>
                                                                                    <option <?= $aucstatus == "3" ? "selected" : ""; ?> value="3">Sold</option>
                                                                                <?
                                                                                }
                                                                                ?>
                                                                            </select>
                                                                        </span>
                                                                        <span class="system message">
                                                                            (Note: If status is Active and start date is Future date then Auction will be considered as Future Auction.<br />If status is pending then auction is saved in system not for a sale, change status to Active for put them for sale.)
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->

                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Auction Duration:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper blank">
                                                                            <select name="auctionduration">
                                                                                <?php
                                                                                $dursql = "select * from auction_management order by auc_plus_time";
                                                                                $durres = db_query($dursql);
                                                                                while ($dur = db_fetch_array($durres)) {
                                                                                    $auc_manage = $dur['auc_manage'];
                                                                                ?>
                                                                                    <option value="<?php echo $auc_manage; ?>" <?= $rows->time_duration == $auc_manage ? "selected" : ""; ?>><?php echo $dur['auc_title']; ?></option>
                                                                                <?php } ?>
                                                                            </select>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->

                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Shipping Method:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper blank">
                                                                            <select name="shippingmethod" id="shippingmethod">
                                                                                <option value="none">select one</option>
                                                                                <?
                                                                                $qryshipping = "select * from shipping";
                                                                                $resshipping = db_query($qryshipping);
                                                                                while ($objshipping = db_fetch_object($resshipping)) {
                                                                                ?>
                                                                                    <option <?= $objshipping->id == $shippingchargeid ? "selected" : ""; ?> value="<?= $objshipping->id; ?>"><?= $objshipping->shipping_title; ?></option>
                                                                                <?
                                                                                }
                                                                                ?>
                                                                            </select>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->

                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>&nbsp;</label>
                                                                    <div class="inputs">
                                                                        <ul class="inline">
                                                                            <li>
                                                                                <input class="checkbox" type="checkbox" name="useronlyfree" value="1" <?= $rows->use_free == "1" ? "checked" : ""; ?>
/>&nbsp;Please tick the checkbox for use only Free Points on this auction.
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->

                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>&nbsp;</label>
                                                                    <div class="inputs">
                                                                        <ul class="inline">
                                                                            <li>
                                                                                <input class="checkbox" type="checkbox" name="relist" value="1" <?= $rows->relist == "1" ? "checked" : ""; ?> />&nbsp;Please tick the checkbox to relist this auction automatically
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->

                                                                <!--[if !IE]>start row<![endif]-->
                                                               <div class="row">
                                                                    <label>Enable Federal Taxes:</label>
                                                                    <div class="inputs">
                                                                      
                                                                           <select name="tax1" id="tax1">
									      <option value="0" <?php if($tax1 != '1'){ echo "selected"; } ?>>No</option>
									      <option value="1" <?php if($tax1 == '1'){ echo "selected"; } ?>>Yes</option>
									   </select>
                                                                      
                                                                        
                                                                     
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <label>Enable State / Provincial Taxes:</label>
                                                                    <div class="inputs">
                                                                       
                                                                           <select name="tax2" id="tax2">
									      <option value="0" <?php if($tax2 != '1'){ echo "selected"; } ?>>No</option>
									      <option value="1" <?php if($tax2 == '1'){ echo "selected"; } ?>>Yes</option>
									   </select>
                                                                       
                                                                        
                                                                        
									
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->

                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <div class="buttons">
                                                                        <ul>
                                                                            <li>
                                                                                <?php
                                                                                if ($_REQUEST["auction_edit"] != "") {
                                                                                ?>
                                                                                    <span class="button send_form_btn"><span><span>Edit Auction</span></span><input name="editauction" type="submit"/></span>
                                                                                    <input type="hidden" name="edit_auction" value="<?php echo $_REQUEST["auction_edit"]; ?>" />
                                                                                    <input type="hidden" name="auc_back_status" value="<?php echo $aucstatus; ?>" />
                                                                                    <input type="hidden" name="userid" value="<?php echo $userid; ?>" />
                                                                                <?php
                                                                                } elseif ($_REQUEST["auction_delete"] != "") {
                                                                                    $delid = $_REQUEST["auction_delete"];
                                                                                ?>
                                                                                    <span class="button send_form_btn"><span><span>Delete Auction</span></span><input name="deleteauction" type="button" <?php echo ($aucstatus == "1" || $aucstatus == "4") ? '' : 'disabled'; ?> onclick="javascript:delconfirm('addauction.php?delete_auction=<?= $delid ?>');"/></span>

                                                                                <?php } else {
                                                                                
 ?>
									      <input type="hidden" name="addauction" value="true" id="addauction" />
                                                                                    <span class="button send_form_btn"><span><span>Add Auction</span></span><input name="submit" type="submit"/></span>
                                                                                <?php
                                                                                }
                                                                                ?>


                                                                                <input type="hidden" name="curdate" id="curdate" value="<?php echo date($globalDateformat); ?>" />
                                                                                <input type="hidden" name="changestatusval" id="changestatusval" value="" />
                                                                                <input type="hidden" name="curtime" id="curtime" value="<?= date("H:i:s"); ?>" />
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
                  <script>
                  
$("#aucstartdate").datepicker({showOn: 'button', buttonImage: 'images/pmscalendar.gif', buttonImageOnly: true});
                $("#aucenddate").datepicker({showOn: 'button', buttonImage: 'images/pmscalendar.gif', buttonImageOnly: true});
                
		
    

                   $("#allowbuynow").click(function(){
                    if($('#allowbuynow').attr('checked')){
                        $("#buynowprice").attr('disabled', false);
                    }else{
                        $("#buynowprice").attr('disabled', true);
                    }
                    
                });

                $('#uniqueauction').click(function(){
                 if(document.getElementById('uniqueauction').attr('checked') == true && document.getElementById('seatauction').attr('checked') == true){
                    alert("Can't check uniqueauctions and seatauction at the same time!!!");
		    document.getElementById('uniqueauction').attr('checked') = false; document.getElementById('seatauction').attr('checked') = false;
		    
		     $('#seatauction_panel').hide();
		     
		     
                }
                    if($(document.getElementById('uniqueauction')).attr('checked')){
                        $('#normalauction').hide();
                    }else{
                        $('#normalauction').show();
                    }
                    
                    
                });

                $('#fpa').click(function(){
                    if($(this).attr('checked')){
                        $('#aucfixedprice').attr('disabled', false);
                    }else{
                        $('#aucfixedprice').attr('disabled', true);
                        $('#aucfixedprice').val('0.00');
                    }
                });

                $('#reverseauction').click(function(){
                    if($(this).attr('checked')){
                        $('#reserverInput').show();
                    }else{
                        $('#reserverInput').hide();
                    }
                });



                
                
                $('#seatauction').click(function(){
                
                if(document.getElementById('uniqueauction').attr('checked') == true && document.getElementById('seatauction').attr('checked') == true){
                    alert("Can't check uniqueauctions and seatauction at the same time!!!");
		    document.getElementById('uniqueauction').attr('checked') = false; document.getElementById('seatauction').attr('checked') = false;
                $('#normalauction').show();
               
               }
                    if($(document.getElementById('seatauction')).attr('checked')){
                        $('#seatauction_panel').show();
                    }else{
                        $('#seatauction_panel').hide();
                    }
                    
                });

                $('#lockauction').change(function(){
                    if($(this).attr('checked')){
                        $('#lockauction_panel').show();
                    }else{
                        $('#lockauction_panel').hide();
                    }
                });

                $('#locktype').change(function(){
                    if($(this).val()==1){
                        $('#locktime_row').show();
                        $('#lockprice_row').hide();
                    }else if($(this).val()==2){
                        $('#locktime_row').hide();
                        $('#lockprice_row').show();
                    }
                });

                $('#category').change(function(){
                    $.get('<?php echo $SITE_URL;?>/backendadmin/getproductlist.php?&crid=' + $('#category').val(),
                        function(data){
			
                            $('#product').html(data);
                        }
                        
                    );
                });

                $('#product').change(function(){
                    var isbidpack=$('#category').val()=='1';
                    $.ajax({
                        url:'<?php echo $SITE_URL;?>/backendadmin/getprice.php',
                        data:{prid:$(this).val(),isbidpack:isbidpack},
                        type:'POST',
                        dataType:"json",
                        success:function(data){
                            var temp=data.price.split("|");
                            $("#getprice").html(temp[0]);
                            $("#buynowprice").val(temp[0]);
			      <?php if(empty($ob2->productID)){ ?>
			    $('#tax1').val(data.tax1);
			    $('#tax2').val(data.tax2);
			    $('#reserve').val(data.reserve);
			    
			    if(data.shippingmethod != 'undefined' & data.shippingvalue != 'undefined' & data.shippingmethod != 'null' & data.shippingvalue != 'null'){
			    $('#shippingmethod').attr('selected', data.shippingmethod);
			    }
			    
			    <?php } ?>
                            var imghtml="";
                            if(data.picture1!=''){
                                imghtml+="<img src=\"uploads/products/thumbs_big/thumbbig_"+data.picture1+"\">";
                            }

                            if(data.picture2!=''){
                                imghtml+="<img src=\"uploads/products/thumbs_big/thumbbig_"+data.picture2+"\">";
                            }

                            if(data.picture3!=''){
                                imghtml+="<img src=\"uploads/products/thumbs_big/thumbbig_"+data.picture3+"\">";
                            }

                            if(data.picture4!=''){
                                imghtml+="<img src=\"uploads/products/thumbs_big/thumbbig_"+data.picture4+"\">";
                            }

                            $("#product_picture").html(imghtml);
                        }
                    });
                });

                $('#startimmidiate').change(function(){
                    $('#aucstarthours').attr('disabled',$(this).attr('checked'));
                    $('#aucstartminutes').attr('disabled',$(this).attr('checked'));
                    $('#aucstartseconds').attr('disabled',$(this).attr('checked'));
                });
          
		  </script>