<?php
ini_set('display_errors', 1);
$debug = false;
session_start();
$active = "Auctions";
require '../config/xss_rules.php';
include("connect.php");

include("admin.config.inc.php");
include("security.php");
include("functions.php");
@db_query("alter table auction add column silentauction int(1) null default '0';");
$globalDateformat = Sitesetting::getDateFormat();

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

    if ($_POST["startimmidiate"] != "") {
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
    $beginner_auction = $_REQUEST['beginner_auction'];
    $silentauction = $_REQUEST['silentauction']; 
  
    if ($_POST["startimmidiate"] != "") {
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
    $escroe = $_REQUEST['escroe'];
    $escroe_bids = $_REQUEST['escroe_bids'];
    $escroe_bids_min = $_REQUEST['escroe_bids_min'];
    $tax1 = $_REQUEST['tax1'];
    $tax2 = $_REQUEST['tax2'];

    if ($tax1 == '')
        $tax1 = 0;

    if ($tax2 == '')
        $tax2 = 0;

//echo $reverseamount;

    if ($_POST["minimum_auction"] != "") {
        $minimumaucprice = $_POST["auctionminimumprice"];
        $minwinprice = $_POST["minwinprice"];
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
    if($_REQUEST['reserve'] > 0 & $_REQUEST['use_reserve'] != '1'){
    $relist = '';
    
    }else{
    
    $relist = $_REQUEST['relist'];

    }
    
    if($_REQUEST['use_reserve'] == '1'){
    $_REQUEST['use_reserve'] = $reserve;
    }
    
    
    
if ($_REQUEST["addauction"] != "") {
	$bidpack = $categoryID == 1 ? 1 : 0;

	if (!$bidpack) {
	    $Query = "select * from products where productID = '" . $_POST['product'] . "'";
	    $result = db_query($Query);

	    $total = db_affected_rows();
	    $rows = db_fetch_object($result);
	    if ($rows->qty_flag == 1) {
		$id = $rows->productID;
		$qty = $rows->product_qty;
		if ($qty == 0) {
		    header("location: message.php?msg=63");
		    exit;
		}

		$productQty = $_POST["product_qty"];

		$qty1 = $qty - $productQty;
		$updateQuery = "update products set product_qty='$qty1' where productID='" . $id . "'";
		db_query($updateQuery);
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
    
      $replicate = $_REQUEST['replicate'];
      if($_REQUEST['alternate'] == 1 & $_REQUEST['use_category'] == 1){
	  
	      include("addauctions_alternate.php");
      
      }else
      if($_REQUEST['use_category'] == 1){
	  $prqry = db_query("select * from products where categoryID = $categoryID");
	  while($pr_row = db_fetch_array($prqry)){
	      if($debug == true){
	      ?><pre><?php
		  print_r($pr_row);
	      ?></pre><?php
	      }
	      
		  $productID = $pr_row['productID'];
		  include("addauctions.php");
	   
	  }

      }else{
	    include("addauctions.php");
      }
      if($debug == true){
      die();
      }
    header("location: message.php?msg=14");
    exit;
}

if ($_REQUEST["editauction"] && $_REQUEST["edit_auction"]) {
    $editid = $_REQUEST["edit_auction"];

    $bidpack = $categoryID == 1 ? 1 : 0;

    $qrypro = "select auctionID,a.productID as productID,a.categoryID as categoryID,auc_start_price,auc_final_price,auc_start_date,auc_end_date,auc_start_time,auc_end_time,auc_status,auc_type,auc_recurr,buy_user,escroe, escroe_bids,auc_fixed_price,fixedpriceauction,pennyauction,nailbiterauction,offauction,nightauction,openauction,time_duration,auc_final_end_date,total_time,pause_status,shipping_id,future_tstamp,recurr_count,auction_min_price,min_win_price,relist,beginner_auction,use_free,allowbuynow,buynowprice,reverseauction,uniqueauction,lockauction,locktype,locktime,lockprice,halfbackauction,seatauction,bidpack,minseats,maxseats,seatbids,tax1,tax2,bidpack_name,bidpack_price,price, cashauction from auction a left join products p on a.productID=p.productID left join bidpack b on b.id=a.productID where auctionID='" . $editid . "'";
    $respro = db_query($qrypro);
    $auctionID = $editid;
    
    
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
                    db_query($updateQuery);
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
                    db_query($qryupd);
                }
            }

            if ($objpro->qty_flag == 1) {
                $oldproductqty = $ob1->product_qty + $objpro->recurr_count;
                $qryupd = "update products set product_qty='" . $oldproductqty . "' where productID='" . $objpro->productID . "'";
                db_query($qryupd) ;
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
        db_query($delwonentry);

        if ($_REQUEST["unsoldauction"] != "") {
            $deldueentry = "delete from auc_due_table where auction_id='" . $editid . "'";
            db_query($deldueentry);
            clearRunningTable($editid);
        }

        $delbidaccentry = "delete from bid_account where user_id='0' and auction_id='" . $editid . "'";
        db_query($delbidaccentry);

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
	   
            db_query($qry);
	//}
        if ($_REQUEST["aucstatus"] == 4) {
            $auc_status = $_REQUEST["aucstatus"];
        }

       
        $qryupd = "update auction set categoryID='$categoryID', productID='$productID',auc_start_price='$auc_start_price',auc_start_date='$auc_start_date',auc_end_date='$auc_end_date',auc_start_time='$auc_start_time', auc_end_time='$auc_end_time', auc_status='$auc_status',fixedpriceauction='$fpa',pennyauction='$pa',nailbiterauction='$nba',offauction='$off',nightauction='$na',openauction='$oa',time_duration='$duration',auc_recurr='$auc_recu',auc_fixed_price=$auc_fixed_price,total_time='$auc_due_time',buy_user='',auc_final_end_date='0000-00-00 00:00:00',auc_final_price='0',shipping_id='$shippingmethod',future_tstamp='$futuretstamp',recurr_count='$productQty',auction_min_price='$minimumaucprice',min_win_price='$minwinprice',use_free='$useonlyfree',uniqueauction='$uniqueauction',reverseauction='$reverseauction',tax1='$tax1',tax2='$tax2',seatauction='$seatauction',minseats='$minseats',maxseats='$maxseats',seatbids='$seatbids',locktype='$locktype',locktime='$locktime',lockprice='$lockprice',bidpack='$bidpack',escroe ='$escroe',escroe_bids='$escroe_bids',escroe_bids_min='$escroe_bids_min',cashauction='$cashauction',reserve='$reserve',beginner_auction='$beginner_auction', bids_to_take='$_POST[bids_to_take]'  where auctionID='$editid'";
        db_query($qryupd);

        $qryupd1 = "update auction_running set productID='$productID',auc_status='$auc_status',auc_start_price='$auc_start_price',fixedpriceauction='$fpa',pennyauction='$pa',nailbiterauction='$nba',offauction='$off',nightauction='$na',openauction='$oa',time_duration='$duration',use_free='$useonlyfree',uniqueauction='$uniqueauction',reverseauction='$reverseauction',seatauction='$seatauction',minseats='$minseats',maxseats='$maxseats',seatbids='$seatbids',locktype='$locktype',locktime='$locktime',lockprice='$lockprice',relist='$relist', cashauction='$cashauction', reserve='$reserve'.beginner_auction='$beginner_auction', bids_to_take='$_POST[bids_to_take]', silentauction='$silentauction' where auctionID='$editid'";
        db_query($qryupd1);
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
                db_query($qry);
            }
        }
        if ($_REQUEST["aucstatus"] == 4) {
            $auc_status = $_REQUEST["aucstatus"];
        }
        $qryupd = "update auction set categoryID='$categoryID', productID='$productID', auc_start_price='$auc_start_price',auc_start_date='$auc_start_date',auc_end_date='$auc_end_date',auc_start_time='$auc_start_time', auc_end_time='$auc_end_time', auc_status='$auc_status',fixedpriceauction='$fpa',pennyauction='$pa',nailbiterauction='$nba',offauction='$off',nightauction='$na',openauction='$oa',time_duration='$duration',auc_recurr='$auc_recu',auc_fixed_price=$auc_fixed_price,total_time='$auc_due_time',shipping_id='$shippingmethod',future_tstamp='$futuretstamp',recurr_count='$productQty',auction_min_price='$minimumaucprice',min_win_price='$minwinprice',use_free='$useonlyfree',allowbuynow='$allowbuynow',buynowprice='$buynowprice',uniqueauction='$uniqueauction',reverseauction='$reverseauction',tax1='$tax1',tax2='$tax2',relist='$relist',seatauction='$seatauction',minseats='$minseats',escroe='$escroe', escroe_bids='$escroe_bids', maxseats='$maxseats',seatbids='$seatbids',bidpack='$bidpack', cashauction='$cashauction', reserve = '$reserve'  where auctionID='$editid'";
        db_query($qryupd);

        $qryupd1 = "update auction_running set productID='$productID',auc_status='$auc_status',auc_start_price='$auc_start_price',fixedpriceauction='$fpa',pennyauction='$pa',nailbiterauction='$nba',offauction='$off',nightauction='$na',openauction='$oa',time_duration='$duration',use_free='$useonlyfree',uniqueauction='$uniqueauction',reverseauction='$reverseauction',seatauction='$seatauction',minseats='$minseats',maxseats='$maxseats',seatbids='$seatbids',locktype='$locktype',locktime='$locktime',lockprice='$lockprice',relist='$relist', cashauction='$cashauction', reserve='$reserve', silentauction='$silentauction' where auctionID='$editid'";
        db_query($qryupd1);


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
  db_query($qryupd);

  $qryd = "delete from auc_due_table where auction_id='".$_REQUEST["restart_auction"]."'";
  db_query($qryd);

  $delwonentry = "delete from won_auctions where userid='0' and auction_id='".$_REQUEST["restart_auction"]."'";
  db_query($delwonentry);

  } */
if (!empty($_REQUEST["delete_auction"])) {
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
        db_query($updpro);
    }
    $qrydel = "delete from auction where auctionID=" . $delid;
    db_query($qrydel) or dir(db_error());
    clearRunningTable($delid);
    header("location: message.php?msg=13");
}else

if ($_REQUEST["auction_edit"] != "" | $_REQUEST["auction_delete"] != "" | $_REQUEST["auction_clone"] | $_REQUEST["auction_restart"]) {

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
    $qrys = "select auctionID,a.productID as productID,a.categoryID as categoryID,auc_start_price,auc_final_price,auc_start_date,auc_end_date,auc_start_time,auc_end_time,auc_status,auc_type,auc_recurr,buy_user,auc_fixed_price,fixedpriceauction,pennyauction,nailbiterauction,offauction,nightauction,openauction,time_duration,auc_final_end_date,total_time,pause_status,shipping_id,future_tstamp,recurr_count,auction_min_price,min_win_price,relist,use_free,allowbuynow,buynowprice,reverseauction,uniqueauction,lockauction,locktype,locktime,lockprice,halfbackauction,seatauction,bidpack,minseats,maxseats,seatbids,tax1,tax2,bidpack_name,bidpack_price,bidpack_banner,bidpack_banner2,bidpack_banner3,bidpack_banner4,picture1,picture2,picture3,picture4,price, reserve, cashauction, silentauction from auction a left join products p on a.productID=p.productID left join bidpack b on b.id=a.productID where a.auctionID =" . $aid;
    
    $ress = db_query($qrys);
    $total = db_num_rows($ress);

    $rows = db_fetch_object($ress);

    
   // if ($total > 0) {
   
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
        $silentauction = $rows->silentauction;
        $escroe=$rows->escroe;
        $escroe_bids=$rows->escroe_bids;
        $escroe_bids_min=$rows->escroe_bids_min;
        
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
        
   // }
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
            seatbids,lockauction,locktype,locktime,lockprice,relist,beginner_auction, bids_to_take) values('{$auction['auctionID']}','{$auction['productID']}','{$auction['auc_start_price']}','{$auction['auc_status']}','{$auction['pause_status']}','{$auction['time_duration']}','{$auction['use_free']}','{$auction['fixedpriceauction']}',
            '{$auction['pennyauction']}','{$auction['nailbiterauction']}','{$auction['offauction']}','{$auction['nightauction']}','{$auction['openauction']}','{$auction['reverseauction']}','{$auction['uniqueauction']}','{$auction['halfbackauction']}','{$auction['seatauction']}','{$auction['minseats']}','{$auction['maxseats']}',
            '{$auction['seatbids']}','{$auction['lockauction']}','{$auction['locktype']}','{$auction['locktime']}','{$auction['lockprice']}','{$auction['relist']}', '{$auction['beginner_auction']}', '$_POST[bids_to_take]')";
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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="imagetoolbar" content="no" />
        <title>
	    <?php 
		if ($_GET['auction_edit'] != "") {
		  ?> Edit Auction<?
		} else {
		  if ($_GET['auction_delete'] != "") {
			?> Confirm Delete Auction <?php 
		      } else {
			?> Add Auction <?
		   }
		}
	      ?>-<?php echo $ADMIN_MAIN_SITE_NAME ?>
	</title>
        <link media="screen" rel="stylesheet" type="text/css" href="css/admin.css"  />
        <link type="text/css" href="css/cupertino/ui.all.css" rel="stylesheet" />
        
        <!--[if lte IE 6]><link media="screen" rel="stylesheet" type="text/css" href="css/admin-ie.css" /><![endif]-->
        <script type="text/javascript" src="js/behaviour.js"></script>
        <link href="zpcal/themes/aqua.css" rel="stylesheet" type="text/css" media="all" title="Calendar Theme - aqua.css" />
        <script type="text/javascript" src="zpcal/src/utils.js"></script>
        <script src="js/jquery-1.3.2.min.js"></script>
	<script src="js/ui/jquery-ui-1.7.2.custom.min.js"></script>
        <script type="text/javascript" src="js/ui/ui.datepicker.js"></script>

        <script type="text/javascript">

            function delconfirm(loc)
            {
                if(confirm("Are you sure do you want to delete this?"))
                {
                    window.location.href=loc;
                }
                return false;
            }

	
	    var now = new Date();

	    var curdate = new Date(<?php echo date("Y"); ?> + ', ' + <?php echo date("m"); ?> + ', ' + <?php echo date("d"); ?> + ' ' + now.getHours() + ':' + now.getMinutes() + ':' + now.getSeconds() ).getTime() / 1000;
           	


            function Check(f1)
            {
                if($('#category').val()=="none")
                {
                    alert("Please Select Category!!!");
                    $('#category').focus();
                    return false;
                }

                if($('#product').val()=="none" & $('#use_category').prop('checked') == false){
                {
                    alert("Please Select Product!!!");
                    document.f1.product.focus();
                    return false;
                }

                if($("#uniqueauction").prop('checked')==false){
                    if(document.f1.aucstartprice.value=="")
                    {
                        alert("Please Enter Auction Start Price!!!");
                        $('#uniqueauction').focus();
                        return false;
                    }
                }

		  if(document.f1.aucstartprice.value< parseFloat(0.00, 2) )
                    {

                      alert("Auction Start Price Should Be At Least 0.00!!!");
                        $('#uniqueauction').focus();
                        return false;


		    }
		
                if($('#uniqueauction').prop('checked') & $('#reverseauction').prop('checked')){
                    alert("Can't check uniqueauctions and reverseauction at the same time!!!");
                    return false;
                }

                if($('#uniqueauction').prop('checked') & $('#seatauction').prop('checked')){
                    alert("Can't check uniqueauctions and seatauction at the same time!!!");
                    return false;
                }


               

                if(document.f1.aucstartdate.value=="")
                {
                    alert("Please Select Auction Start Date!!!");
                    document.f1.aucstartdate.focus();
                    return false;
                }

                if(document.f1.aucenddate.value=="")
                {
                    alert("Please Select Auction End Date!!!");
                    document.f1.aucenddate.focus();
                    return false;
                }
                 if(document.f1.escroe_bids.value=="" & $('#escroe').prop('checked') == true)
                {
                    alert("Please Supply the bid amount to remove from escroe");
                    document.f1.escroe_bids.focus();
                    return false;
                }
                
                
               var now = new Date();
	     
	        var curdate = new Date(<?php echo date("Y"); ?> + ', ' + <?php echo date("m"); ?> + ', ' + <?php echo date("d"); ?> + ' ' + now.getHours() + ':' + now.getMinutes() + ':' + now.getSeconds() ).getTime() / 1000;
		
                
                var startdate = document.f1.aucstartdate.value.split('/');//INTERMEDIATE METHOD TO CONVERT TO TIME STRING FOR JS ...NEEDS A VARIABLE TO CHECK     
		if($('#startimmidiate').prop('checked') == true){
		    force_seconds_backwards = parseInt(now.getSeconds()) + 5;
		    var starttime = now.getHours() + ':' + now.getMinutes() + ':' + force_seconds_backwards;
		}else{
		    var starttime = $('#aucstarthours option:selected').val() + ':' + $('#aucstartminutes option:selected').val() + ':' + $('#aucstartseconds').val();   
		}
		
		<?php if($globalDateformat == 'm/d/Y' | $globalDateformat == 'm/d/y'){ ?>
	
		    var aucsdate = new Date(startdate[2] + ', ' + startdate[0] + ', ' + startdate[1] + ' ' + starttime).getTime() / 1000;
		    	
                <?php }else{ ?>
		    var aucsdate = new Date(startdate[2] + ', ' + startdate[1] + ', ' + startdate[0] + ' ' + starttime).getTime() / 1000;
		    
                <?php } ?>
		  

		      
		var enddate = document.f1.aucenddate.value.split('/');
		var endtime = $('#aucendhours option:selected').val() + ':' + $('#aucendminutes option:selected').val() + ':' + $('#aucendseconds').val();   
		    	  
		<?php if($globalDateformat == 'm/d/Y' | $globalDateformat == 'm/d/y'){ ?>
		    var aucedate = new Date(enddate[2] + ', ' + enddate[0] + ', ' + enddate[1] + ' ' + endtime).getTime() / 1000;
		<?php }else{ ?>
		     var aucedate = new Date(enddate[2] + ', ' + enddate[1] + ', ' + enddate[0] + ' ' + endtime).getTime() / 1000;
		<?php } ?>
		   
                
               
                var newaucsdate = new Date(aucsdate);
                var newcurdate = '<?php echo time(); ?>';
                var newaucedate = new Date(aucedate);

                var newtime = document.f1.curtime.value;


	    <?php if (($aucstatus == 2 && $_REQUEST["auction_edit"] == "") || $aucstatus == 1 || $aucstatus == "" || $_REQUEST["auction_clone"] != "") { ?>
		if(curdate>aucsdate)
		{
		    alert("Auction Start Date and time should not be past date.")
		    document.f1.aucstartdate.focus();
		    return false;
		}
		if(curdate>aucedate)
		{	
		
		    alert("Auction End Date and time should not be past date.")
		    document.f1.aucenddate.focus();
		    return false;
		}
		if(aucsdate>aucedate)
		{
		    alert("Auction End date and time should be greater than Auction Start date and time ");
		    document.f1.aucenddate.focus();
		    return false;
		}
           
           <?php } ?>

		if(document.f1.aucstarthours.value=="")
		{
		    alert("Please Select Auction Start Time!!!");
		    document.f1.aucstarthours.focus();
		    return false;
		}

		if(document.f1.aucstartminutes.value=="")
		{
		    alert("Please Select Auction Start Time!!!");
		    document.f1.aucstartminutes.focus();
		    return false;
		}

		if(document.f1.aucstartseconds.value=="")
		{
		    alert("Please Select Auction Start Time!!!");
		    document.f1.aucstartseconds.focus();
		    return false;
		}

		if(document.f1.aucendhours.value=="")
		{
		    alert("Please Select Auction End Time!!!");
		    document.f1.aucendhours.focus();
		    return false;
		}

		if(document.f1.aucendminutes.value=="")
		{
		    alert("Please Select Auction End Time!!!");
		    document.f1.aucendminutes.focus();
		    return false;
		}

		if(document.f1.aucendseconds.value=="")
		{
		    alert("Please Select Auction End Time!!!");
		    document.f1.aucendseconds.focus();
		    return false;
		}

		if(document.f1.fpa.checked==true && document.f1.off.checked==true)
		{
		    alert("You can't select fixed price auction type with 100% off auction type!!!");
		    return false;
		}

		if(document.f1.allowbuynow.checked==true && document.f1.buynowprice.value==""){
		    alert("You should enter a buy now price");
		    return false;
		}

		if(aucsdate==aucedate)
		{
		    if(Number(document.f1.aucendhours.value)<Number(document.f1.aucstarthours.value))
		    {
			alert("Auction end time should be greater than auctin start time!!!");
			document.f1.aucendhours.focus();
			return false;
		    }
		    else
		    {
			if(Number(document.f1.aucendhours.value)==Number(document.f1.aucstarthours.value))
			{
			    if(Number(document.f1.aucendminutes.value)<Number(document.f1.aucstartminutes.value))
			    {
				alert("Auction end time should be greater than auctin start time!!!");
				document.f1.aucendminutes.focus();
				return false;
			    }
			    else
			    {
				if(Number(document.f1.aucendminutes.value)==Number(document.f1.aucstartminutes.value))
				{
				    if(Number(document.f1.aucendseconds.value)==Number(document.f1.	aucstartseconds.value))
				    {
					alert("Auction end time should be greater than auctin start time!!!");
					document.f1.aucendseconds.focus();
					return false;
				    }

				}
			    }
			}
		    }
		}


		if(document.f1.shippingmethod.value=="none")
		{
		    alert("Please select shipping charge method");
		    document.f1.shippingmethod.focus();
		    return false;
		}

		if($('#seatauction').prop('checked')){
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
		}

		if($('#lockauction').prop('checked')){
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
		}

	    }
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
	
									
       
	
            $(function() {
	    <?php 

		switch($globalDateformat){

		      case 'm/d/Y':
		   
		      $jsdateFormat = 'mm/dd/yy';
		      break;
		      case 'd/m/Y':
		
		      $jsdateFormat = 'dd/mm/yy';
		      break;
		      
		}

	    ?>
	      $.datepicker.setDefaults("option", "dateFormat", '<?php echo $jsdateFormat;?>');
                $("#aucstartdate-new").datepicker({showOn: 'button', buttonImage: 'images/pmscalendar.gif', buttonImageOnly: true});
                $("#aucenddate-new").datepicker({showOn: 'button', buttonImage: 'images/pmscalendar.gif', buttonImageOnly: true});
                $("#allowbuynow").click(function(){
                    if($('#allowbuynow').prop('checked')){
                        $("#buynowprice").attr('disabled', false);
                    }else{
                        $("#buynowprice").attr('disabled', true);
                    }
                    
                });

                $('#uniqueauction').click(function(){
                 if(document.getElementById('uniqueauction').checked == true && document.getElementById('seatauction').checked == true){
                    alert("Can't check uniqueauctions and seatauction at the same time!!!");
		    document.getElementById('uniqueauction').checked = false; document.getElementById('seatauction').checked = false;
		    
		     $('#seatauction_panel').hide();
		     
		     
                }
                    if($(document.getElementById('uniqueauction')).prop('checked')){
                        $('#normalauction').hide();
                    }else{
                        $('#normalauction').show();
                    }
                    
                    
                });

                $('#fpa').click(function(){
                    if($(this).prop('checked')){
                        $('#aucfixedprice').attr('disabled', false);
                    }else{
                        $('#aucfixedprice').attr('disabled', true);
                        $('#aucfixedprice').val('0.00');
                    }
                });

                $('#reverseauction').click(function(){
                    if($(this).prop('checked')){
                        $('#reserverInput').show();
                    }else{
                        $('#reserverInput').hide();
                    }
                });



                
                
                $('#seatauction').click(function(){
                
                if(document.getElementById('uniqueauction').checked == true && document.getElementById('seatauction').checked == true){
                    alert("Can't check uniqueauctions and seatauction at the same time!!!");
		    document.getElementById('uniqueauction').checked = false; document.getElementById('seatauction').checked = false;
                $('#normalauction').show();
               
               }
                    if($(document.getElementById('seatauction')).prop('checked')){
                        $('#seatauction_panel').show();
                    }else{
                        $('#seatauction_panel').hide();
                    }
                    
                });

                $('#lockauction').change(function(){
                    if($(this).prop('checked')){
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
                    $.get('getproductlist.php?&crid=' + $('#category').val(),
                        function(data){
			
                            $('#product').html(data);
                        }
                        
                    );
                });
	      function initialize_remove(){
	      $('#similar_final_list li').bind('click', function(){
			
			      var id = $(this).attr('id');
			      
			      
				  $('#similar_product_list').append( $('#' + id).clone() );
				  $('#similar_final_list #' + id).remove();
				  $('#' + id).addClass('waitting');
				  $('#' + id + ' input[type="checkbox"]').prop('checked', false);
			      
			});
	      }
	      function initiate_similar(){
	      $('#similar_product_list li').bind('click', function(){
			
			      var id = $(this).attr('id');
			      
				  $('#similar_final_list').append( $('#' + id).clone() );
				  $('#similar_product_list #' + id).remove();
				  $('#' + id).removeClass('waitting');
				  $('#' + id + ' input[type="checkbox"]').prop('checked', true);
			      initialize_remove();
			  });
	      
	      }
                $('#product').change(function(){
                    var isbidpack=$('#category').val()=='1';
                    $.ajax({
                        url:'getprice.php',
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
			    if($('#use_reserve').prop('checked') == false){
				$('#use_reserve').prop('disabled') == false;
			    
			    }else{
			    
				$('#use_reserve').prop('disabled') == true;
			    
			    }
			    
			    if(data.shippingmethod != 'undefined' & data.shippingvalue != 'undefined' & data.shippingmethod != 'null' & data.shippingvalue != 'null'){
			    $('#shippingmethod').val(data.shippingmethod);
			    }
			    
			    <?php } ?>
                            var imghtml="";
                            if(data.picture1!=''){
                                imghtml+="<img src=\"../uploads/products/thumbs_big/thumbbig_"+data.picture1+"\">";
                            }

                            if(data.picture2!=''){
                                imghtml+="<img src=\"../uploads/products/thumbs_big/thumbbig_"+data.picture2+"\">";
                            }

                            if(data.picture3!=''){
                                imghtml+="<img src=\"../uploads/products/thumbs_big/thumbbig_"+data.picture3+"\">";
                            }

                            if(data.picture4!=''){
                                imghtml+="<img src=\"../uploads/products/thumbs_big/thumbbig_"+data.picture4+"\">";
                            }
			    $('#similar_final_list').html('');
			    $('#similar_product_list').html('');
			    
                            $("#product_picture").html(imghtml);
                            $.each(data.product_list, function(i, item){
                            
				  txt = '<li class="similar_product waitting" style="font-size:10px;border:1px dashed blue;margin:1px 1px 1px 2px;width:190px;" id="similar_product_' + i + '">';
				      txt += '<img src="../uploads/products/thumbs_small/thumbsmall_' + item.picture + '" style="float:left;margin-right:5px;width:35px;height:auto;"/>';
				      txt += item.name;
				      txt += '<span style="float:right;margin-right:2px;">' + item.price + '</span>';
				      txt += '<input type="checkbox" style="display:none;" value="' + item.productID + '" id="similar_product_input[]" name="similar_product_input[]" />';
				  
				  
				  
				  txt += '</li>';
				 $('#similar_product_list').append(txt);
                            });
                            initiate_similar();
                        }
                    });
                });

                $('#startimmidiate').change(function(){
                
		    if($(this).prop('checked') == true){
			$('input[name="aucstartdate"]').val('<?php echo date($globalDateformat); ?>');
		    }
			$('#aucstarthours').attr('disabled',$(this).prop('checked'));
			$('#aucstartminutes').attr('disabled',$(this).prop('checked'));
			$('#aucstartseconds').attr('disabled',$(this).prop('checked'));
		   
                });

            });
	   
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
                                                        <?php
                                                        }
                                                        ?>
                                                        <li class="blue"><span class="ico"></span><strong class="system_title"><span class="required">*</span> Required Information</strong></li>
                                                    </ul>

                                                    <!--[if !IE]>end system messages<![endif]-->

                                                    <!--[if !IE]>start forms<![endif]-->
                                                    <form name="f1" method='POST' enctype="multipart/form-data" action="addauction.php" onsubmit="return Check(this)" class="search_form general_form">
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
                                                                            <?php
                                                                                    }
                                                                            
									     } else {
									     
                                                                                    $qrybid = "select bidpack_name,id from bidpack";
                                                                                    $bidresult = db_query($qrybid);
                                                                                    while ($bidobj = db_fetch_array($bidresult)) {
                                                                            ?>
                                                                                        <option <?php echo $product == $bidobj["id"] ? "selected" : ""; ?> value="<?php echo $bidobj["id"]; ?>"><?php echo stripslashes($bidobj["bidpack_name"]); ?></option>
                                                                            <?php } ?>
									<?php } ?>
                                                                            </select>
                                                                            <span class="system required">*</span>
                                                                      </div>
                                                                     <!--[if !IE]>end row<![endif]-->
                                                                      <div class="row" style="">
                                                                        <?php if(empty($_REQUEST['edit_auction']) & empty($_REQUEST['delete_auction'])){ ?>
                                                                        </span>
                                                                        
                                                                         <label>Use Whole Category:</label>
                                                                        
									      <input type="checkbox" name="use_category" id="use_category" value="1" />
									</div>
                                                                     <!--[if !IE]>end row<![endif]-->
                                                                      <div class="row"  style="display:none;">
									 <label>Alternate Products:</label>
                                                                        
									      <input type="checkbox" name="alternate" id="alternate" value="1" />
									 <?php } ?>
                                                                    </div>
                                                                    <!--[if !IE]>end row<![endif]-->
                                                                  <?php if(empty($_REQUEST['edit_auction']) & empty($_REQUEST['delete_auction'])){ ?>
                                                                    <!--[if !IE]>start row<![endif]-->
                                                                    <div class="row" style="">
                                                                        <label>Replicate This Auction:</label>
                                                                        <div class="inputs">
                                                                            <select name="replicate" id="replicate">
									      <?php
									      $i = 1;
									      while($i <= 10){
									      ?>
									      <option value="<?php echo $i; ?>" <?php if($i == 1){ echo 'selected="true"'; } ?>><?php echo $i; ?></option>
									      <?php
									      $i++;
									      }
									      ?>
									    </select>
                                                                        </div>
                                                                        <span class="system required">*</span>
                                                                    </div>
                                                                    
                                                                    <!--[if !IE]>end row<![endif]-->
                                                                    <!--[if !IE]>start row<![endif]-->
                                                                    <div class="row" style="">
                                                                        <label>Minutes Between Auction End Time For Replication:</label>
                                                                        <div class="inputs">
                                                                            <select name="replicate_delay" id="replicate_delay">
									      <?php
									      $i = 0;
									      while($i <= 60){
									      ?>
									      <option value="<?php echo $i; ?>" <?php if($i == 0){ echo 'selected="true"'; } ?>><?php echo $i; ?></option>
									      <?php
									      $i++;
									      }
									      ?>
									    </select>
                                                                        </div>
                                                                        <span class="system required">*</span>
                                                                    </div>
                                                                    
                                                                    <!--[if !IE]>end row<![endif]-->
                                                                    <?php } ?>
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
                                                                                    <img src="../uploads/products/thumbs_big/thumbbig_<?php echo $picture1; ?>"/>
                                                                            <?php } ?>

                                                                            <?php if ($picture2 != '') {
 ?>
                                                                                    <img src="../uploads/products/thumbs_big/thumbbig_<?php echo $picture2; ?>"/>
<?php } ?>

<?php if ($picture3 != '') { ?>
                                                                                    <img src="../uploads/products/thumbs_big/thumbbig_<?php echo $picture3; ?>"/>
<?php } ?>

<?php if ($picture4 != '') { ?>
                                                                                    <img src="../uploads/products/thumbs_big/thumbbig_<?php echo $picture4; ?>"/>
<?php } ?>


                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                    <!--[if !IE]>end row<![endif]-->

                                                                    <!--[if !IE]>start row<![endif]-->
                                                                    <div class="row">
                                                                        <label>Auction Filters:</label>
                                                                        <div class="inputs" style="width:750px;">
                                                                  <table>
								    <tr>
								      <td colspan="1" width="400px">
                                                                        <table>
									  <tr>
									    <td valign="top" height="100%">
                                                                            <ul class="inline">
										<li><input class="checkbox auction_no_filter" type="checkbox" checked/><b>No Filters</b></li>
										
										<script>
										  $('.auction_no_filter').click(function(){
										  
										      if($(this).prop('checked') == true){
										     
											  $('.auction_filter').each(function(){
											  
											       $('.auction_filter').prop('checked', false);
											       $('#lockauction_panel').css('display', 'none');
											       $('#seatauction_panel').css('display', 'none');
											  });
										      }
										  
										  });
										  function escroe_box(){
										   $('#escroe').bind('click',function(event){
										
										      if($('#escroe').prop('checked') == true){
											$('#escroe_row').css('display', 'block');
										      }else{
											$('#escroe_row').css('display', 'none');
										      }
										    });
										  }
										</script>
										<li><input onclick="escroe_box();" class="checkbox auction_filter" <?= $rows->escroe == "1" ? "checked" : "" ?> type="checkbox" id="escroe" name="escroe" value="1"/> Escrow</li>
                                                                                <li><input class="checkbox auction_filter" <?= $rows->fixedpriceauction == "1" ? "checked" : "" ?> type="checkbox" id="fpa" name="fpa" value="1"/> Fixed Price Auction</li>
                                                                                
                                                                                <li><input class="checkbox auction_filter" <?= $rows->offauction == "1" ? "checked" : "" ?> type="checkbox" name="off" value="1"/> 100% off</li>
                                                                                 <li><input class="checkbox auction_filter" <?php echo $uniqueauction == 1 ? "checked" : "" ?> type="checkbox" id="uniqueauction" name="uniqueauction" value="1"/> Lowest Unique Auction</li>
										 <li><input class="checkbox auction_filter" <?= $reverseauction == "1" ? "checked" : "" ?> type="checkbox" id="reverseauction" name="reverseauction" value="1"/> Reverse Auction</li>
										  <li><input class="checkbox auction_filter" <?php echo $seatauction == 1 ? "checked" : "" ?> type="checkbox" id="seatauction" name="seatauction" value="1"/> Seat Auction</li>
										  <li><input class="checkbox auction_filter" <?php echo $beginner_auction == 1 ? "checked" : "" ?> type="checkbox" id="beginner_auction" name="beginner_auction" value="1"/> Beginner Only Auction</li>
                                                                            </ul>
                                                                            <ul class="inline">
                                                                                <li><input class="checkbox auction_filter" <?= $rows->pennyauction == "1" ? "checked" : "" ?> type="checkbox" name="pa" value="1"/> Cent Auction</li>
                                                                               <!-- <li><input class="checkbox auction_filter" <?= $rows->nightauction == "1" ? "checked" : "" ?> type="checkbox" name="na" value="1"/> Night Auction</li>-->
                                                                                <li><input class="checkbox auction_filter" <?= $rows->nailbiterauction == "1" ? "checked" : "" ?> type="checkbox" name="nba" value="1"/> NailBiter Auction</li>
                                                                                <li><input class="checkbox auction_filter" <?= $rows->openauction == "1" ? "checked" : "" ?> type="checkbox" name="oa" value="1"/> Open Auction</li>
                                                                                <li><input class="checkbox auction_filter" <?php echo $lockauction == 1 ? "checked" : "" ?> type="checkbox" id="lockauction" name="lockauction" value="1"/> Lock Auction</li>
                                                                                <li><input class="checkbox auction_filter" <?php echo $halfback == 1 ? "checked" : "" ?> type="checkbox" id="halfback" name="halfback" value="1"/> Half Back Bid Auction</li>
                                                                                <li><input class="checkbox auction_filter" <?php echo $silentauction == 1 ? "checked" : "" ?> type="checkbox" id="silentauction" name="silentauction" value="1"/>Silent Auction</li>
                                                                            </ul>
                                                                            
                                                                           </td>
                                                                         </tr>
                                                                         <tr>
									    <td>
                                                                            <ul class="inline">
                                                                                 
                                                                            
<?php
if(file_exists("newauctions/index.php")){

include("newauctions/index.php");



}
?>                                                                              
                                                                               
                                                                            
                                                                                
                                                                            </ul>
									  </td>
									  
									</tr>
								      </table>
								  </td>
								
								     
									 <?php
									 if(file_exists("$BASE_DIR/include/addons/user_levels/addauction.php")){
									
									 //   include($BASE_DIR . "/include/addons/user_levels/addauction.php");
									 
									 }
									 ?>
								   
								
								  <td colspan="1" width="400px" valign="top" height="100%">
									 <?php
									 if(file_exists("../include/addons/similar/addauction.php") & in_array('similar', $addons)){
									 
									   // include("../include/addons/similar/addauction.php");
									 
									 }
									 ?>
								  </td>
								  
								</tr>
							      </table>
                                                                            <script>
                                                                              $('.auction_filter').click(function(){
										  
										      if($(this).prop('checked') == true){
										     
											  $('.auction_filter').each(function(){
											  
											       $('.auction_no_filter').prop('checked', false);
											  });
										      }
										  
										  });
                                                                            
                                                                            
                                                                            </script>

                                                                        </div>
                                                                    </div>
                                                                    <div id="escroe_row"  style="display:<?php echo $escroe == 0 ? "none" : "block"; ?>">
                                                                    <!--[if !IE]>start row<![endif]-->
                                                                        <div class="row">
                                                                                    <label>Escrow Bids To Fund Item:</label>
                                                                                    <div class="inputs">
                                                                                        <span class="input_wrapper_custom blank">
                                                                                           <input type="text" name="escroe_bids" id="escroe_bids" value="<?php echo $escroe_bids; ?>" /> 
                                                                                        </span>
                                                                                    </div>
                                                                        </div>
                                                                        <!--[if !IE]>start row<![endif]-->
                                                                   <!--     <div class="row">
                                                                                    <label>Minimum Bids From User:</label>
                                                                                    <div class="inputs">
                                                                                        <span class="input_wrapper_custom blank">
                                                                                           <input type="text" name="escroe_bids_min" id="escroe_bids_min" value="<?php echo $escroe_bids_min; ?>" /> 
                                                                                        </span>
                                                                                    </div>                                                                        
                                                                        
                                                                        </div>-->
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

                                                              
                                                                    <!--[if !IE]>start row<![endif]-->
                                                                    <div class="row" style="">
                                                                    If display is set to block then the site owner can charge multiple bids each time place bid is pressed
                                                                        <label>Bid Value Multiplier(if empty then each bid will cost 1 actual bid):</label>
                                                                        <div class="inputs">
                                                                            <span class="input_wrapper">
                                                                                <input name="bids_to_take" type="text" class="text" id="bids_to_take" value="<?php if(!empty($rows->bids_to_take)){ echo $rows->bids_to_take; }else{echo 1; } ?>" size="12" maxlength="20"/>
                                                                            </span>
                                                                            
                                                                        </div>
                                                                    </div>
                                                                    <!--[if !IE]>end row<![endif]-->
                                                                    


                                                                <div id="normalauction" style="display:<?php echo $uniqueauction == 1 ? "none" : "block"; ?>">
                                                                    <!--[if !IE]>start row<![endif]-->
                                                                    <div class="row">
                                                                        <label>Auction Start Price:</label>
                                                                        <div class="inputs">
                                                                            <span class="input_wrapper">
                                                                                <input name="aucstartprice" type="text" class="text" id="aucstartprice" value="<?php if(!empty($aucstartprice)){ echo $aucstartprice; }else{ echo '0.00'; } ?>" size="12" maxlength="20"/>
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
                                                                            <input type="text" name="aucstartdate" id="aucstartdate-new" value="<?php if($aucstartdate != ""){ echo date($globalDateformat,
strtotime($aucstartdate)); }else{ echo date($globalDateformat); } ""; ?>"  />
                                                                            <strong>&nbsp;To&nbsp;</strong>
                                                                            <input type="text" size="12" name="aucenddate" id="aucenddate-new" value="<?php if($aucenddate != ""){ echo
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
                                                                                       <option value="<?php if(!empty($aucsthours)){ echo $aucsthours; }else{ echo date("H"); } ?>"><?php if(!empty($aucsthours)){ echo $aucsthours; }else{ echo date("H"); } ?></option>
											<?php  for ($h = 0; $h <= 23; $h++) { ?>
                                                                                        <option <?= $aucsthours == $h ? "selected" : ""; ?> value="<?= str_pad($h, 2, "0", STR_PAD_LEFT); ?>"><?= str_pad($h, 2, "0", STR_PAD_LEFT); ?></option>
                                                                                <?php } ?>
                                                                                </select> :
                                                                            <?php /* ?><input maxlength="2" type="text" name="aucstarthours" size="2" value="<?=$aucsthours!=""?$aucsthours:"";?>"> :<?php */ ?>
                                                                            <?php } ?>
                                                                            <?php if ($aucstatus == "3") {
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
                                                                            <?php if ($aucstatus == "3") {
                                                                            ?>
                                                                                    <select name="aucendhours" id="aucendhours" style="display:inline;width:auto;">
                                                                                        <option value="">hh</option>
                                                                                <?php for ($h = 0; $h <= 23; $h++) {
 ?>
                                                                                        <option <?= date("H") == $h ? "selected" : ""; ?> value="<?= str_pad($h, 2, "0", STR_PAD_LEFT); ?>"><?= str_pad($h, 2, "0", STR_PAD_LEFT); ?></option>
<?php } ?>
                                                                                </select> :
                                                                            <?php /* ?><input maxlength="2" type="text" name="aucendhours" size="2" value="<?=date("H")!=""?date("H"):"";?>"> :<?php */ ?>
                                                                            <?php } else { ?>
                                                                                    <select name="aucendhours" id="aucendhours" style="display:inline;width:auto;">
                                                                                        <option value="">hh</option>
                                                                                <?php for ($h = 0; $h <= 23; $h++) {
                                                                                ?>
                                                                                        <option <?= $aucendhours == $h ? "selected" : ""; ?> value="<?= str_pad($h, 2, "0", STR_PAD_LEFT); ?>"><?= str_pad($h, 2, "0", STR_PAD_LEFT); ?></option>
                                                                                <?php } ?>
                                                                                </select> :
                                                                            <?php /* ?><input maxlength="2" type="text" name="aucendhours" size="2" value="<?=$aucendhours!=""?$aucendhours:"";?>"> :<?php */ ?>
                                                                            <?php } ?>
                                                                            <?php if ($aucstatus == "3") {
 ?>
                                                                                    <select name="aucendminutes" id="aucendminutes" style="display:inline;width:auto;">
                                                                                        <option value="">mm</option>
                                                                                <?php for ($m = 0; $m <= 59; $m++) { ?>
                                                                                        <option <?= date("i") == $m ? "selected" : ""; ?> value="<?= str_pad($m, 2, "0", STR_PAD_LEFT); ?>"><?= str_pad($m, 2, "0", STR_PAD_LEFT); ?></option>
                                                                                <?php } ?>
                                                                                </select> :
                                                                            <?php /* ?><input maxlength="2" type="text" name="aucendminutes" size="2" value="<?=date("i")!=""?date("i"):"";?>"> :<?php */ ?>
                                                                            <?php } else {
 ?>
                                                                                    <select name="aucendminutes" id="aucendminutes" style="display:inline;width:auto;">
                                                                                        <option value="">mm</option>
                                                                                <?php for ($m = 0; $m <= 59; $m++) { ?>
                                                                                        <option <?= $aucendmin == $m ? "selected" : ""; ?> value="<?= str_pad($m, 2, "0", STR_PAD_LEFT); ?>"><?= str_pad($m, 2, "0", STR_PAD_LEFT); ?></option>
                                                                                <?php } ?>
                                                                                </select> :
                                                                            <?php /* ?><input maxlength="2" type="text" name="aucendminutes" size="2" value="<?=$aucendmin!=""?$aucendmin:"";?>"> :<?php */ ?>
                                                                            <?php } ?>
                                                                            <?php if ($aucstatus == "3") {
 ?>
                                                                                    <select name="aucendseconds" id="aucendseconds" style="display:inline;width:auto;">
                                                                                        <option value="">ss</option>
                                                                                <?php for ($s = 0; $s <= 59; $s++) { ?>
                                                                                        <option <?= date("s") == $s ? "selected" : ""; ?> value="<?= str_pad($s, 2, "0", STR_PAD_LEFT); ?>"><?= str_pad($s, 2, "0", STR_PAD_LEFT); ?></option>
                                                                                <?php } ?>
                                                                                </select>
                                                                            <?php /* ?><input maxlength="2" type="text" name="aucendseconds" size="2" value="<?=date("s")!=""?date("s"):"";?>"><?php */ ?>
                                                                            <?php } else {
 ?>
                                                                                    <select name="aucendseconds" id="aucendseconds" style="display:inline;width:auto;">
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
                                                                            <select name="auctionduration" id="auctionduration">
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
                                                                        <?php
                                                                        if(!empty($_REQUEST['auction_edit'])){
                                                                        ?>
                                                                        <script type="text/javascript">
									  function change_duration(aid){
									  time = $('#auctionduration option:selected').val();
									  $.ajax({
										  url: 'change_duration.php',
										  data: { aid : aid, time: time },
										  method: 'post',
										  success:function(response){
										    $('#duration_message').html(response);
										  }
										});
									  }
									</script>
										  
									<span id="duration_message"></span>	
                                                                        <p style="cursor:pointer;border-radius:6px; background-color:#cacaca; color:#000;padding:5px;width:100px; float:right;" onclick="change_duration( <?php echo $_REQUEST['auction_edit']; ?>);" type="button" name="change_duration" id="change_duration">Change Duration</p>
                                                                        <?php } ?>
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
                                                                                    <span class="button send_form_btn"><span><span>Add Auction</span></span><input name="addauction" type="submit"/></span>
                                                                                <?php
                                                                                }
                                                                                ?>


                                                                                <input type="hidden" name="curdate" value="<?php echo date($globalDateformat); ?>" />
                                                                                <input type="hidden" name="changestatusval" value="" />
                                                                                <input type="hidden" name="curtime" value="<?= date("H:i:s"); ?>" />
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

    </body>
</html>