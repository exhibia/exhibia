<?
	include("connect.php");
	include("admin.config.inc.php");
	include("security.php");
	include("functions.php");

	$categoryID = $_REQUEST["category"];
	$productID = $_REQUEST["product"];
	$auc_start_price = $_REQUEST["aucstartprice"];
	$auc_fixed_price = $_REQUEST["aucfixedprice"];
	
	if($auc_fixed_price=="")
	{
		$auc_fixed_price = 0;
	}
	if($_POST["startimmidiate"]!="")
	{
		$auc_start_date_ex = explode("/",date("m/d/Y"));
	}
	else
	{
		$auc_start_date_ex = explode("/",$_REQUEST["aucstartdate"]);
	}
	$auc_start_date = $auc_start_date_ex[2]."-".$auc_start_date_ex[0]."-".$auc_start_date_ex[1];
	$auc_end_date_ex = explode("/",$_REQUEST["aucenddate"]);
	$auc_end_date =  $auc_end_date_ex[2]."-".$auc_end_date_ex[0]."-".$auc_end_date_ex[1];

	$aucstartdate = $_REQUEST["aucstartdate"];
	$aucenddate = $_REQUEST["aucenddate"];
	$aucstarthour = $_REQUEST["aucstarthours"];
	$aucendhour = $_REQUEST["aucendhours"];
	$aucstartmin = $_REQUEST["aucstartminutes"];
	$aucendmin = $_REQUEST["aucendminutes"];
	$aucstartsec = $_REQUEST["aucstartseconds"];
	$aucendsec = $_REQUEST["aucendseconds"]; 
	
	if($_POST["startimmidiate"]!="")
	{
		$auc_start_time = date("H:i:s");
		$auctionsplittime = explode(":",$auc_start_time);
		$aucstarthour = $auctionsplittime[0];
		$aucstartmin = $auctionsplittime[1];
		$aucstartsec = $auctionsplittime[2];	
	}
	else
	{
	$auc_start_time=$_REQUEST["aucstarthours"].":".$_REQUEST["aucstartminutes"].":".$_REQUEST["aucstartseconds"];
	}
	$auc_end_time=$_REQUEST["aucendhours"].":".$_REQUEST["aucendminutes"].":".$_REQUEST["aucendseconds"];
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
	
	$changesval = $_REQUEST['changestatusval'];
	$shippingmethod = $_REQUEST["shippingmethod"];
	
	$auc_due_time = getHours($aucstartdate,$aucenddate,$aucstarthour,$aucendhour,$aucstartmin,$aucendmin,$aucstartsec,$aucendsec);
			
	if($_REQUEST["addauction"]!="")
	{
		$Query = "select * from products where productID = '".$_POST['product']."'";
		$result = db_query($Query);
//		echo $Query;
		$total = db_affected_rows();
		$rows = db_fetch_object($result);
		if($rows->qty_flag==1)
		{
			$id = $rows->productID;
			$qty = $rows->product_qty;
			if($qty==0)
			{
				header("location: message.php?msg=63");
				exit;
			}
			
			$productQty = $_POST["product_qty"];
			
			$qty1 = $qty-$productQty;
//			echo $qty1;
			
			$updateQuery = "update products set product_qty='$qty1' where productID='".$id."'";
			db_query($updateQuery) or die(db_error());		
//			echo $updateQuery;
		}
		
		
		$futuretstamp = mktime($aucstarthour,$aucstartmin,$aucstartsec,$auc_start_date_ex[0],$auc_start_date_ex[1],$auc_start_date_ex[2]);
		
		if($changesval=="1" && $auc_status=="2")
		{
			$auc_status = 1;
		}

		$qryins = "Insert into auction (categoryID,productID,auc_start_price,auc_fixed_price,auc_final_price,auc_start_date,auc_end_date,auc_start_time,auc_end_time,auc_status,auc_type,fixedpriceauction,pennyauction,nailbiterauction,offauction,nightauction,openauction,time_duration,auc_recurr,total_time,shipping_id,future_tstamp,recurr_count) values('$categoryID','$productID',$auc_start_price,$auc_fixed_price,'','$auc_start_date','$auc_end_date','$auc_start_time','$auc_end_time','$auc_status','$auc_type','$fpa','$pa','$nba','$off','$na','$oa','$duration','$auc_recu','$auc_due_time','$shippingmethod','$futuretstamp','$productQty')";
		
		db_query($qryins) or die(db_error());
		$auctionID = db_insert_id();
		if($auc_status==2)
		{
		
			$qry = "Insert into auc_due_table (auction_id,auc_due_time,auc_due_price) values($auctionID,'$auc_due_time','$auc_start_price')";
			db_query($qry) or die(db_error());
		}

		header("location: message.php?msg=14");
		exit;
	}
	
	if($_REQUEST["editauction"] && $_REQUEST["edit_auction"])
	{
		$editid = $_REQUEST["edit_auction"];
		
		$qrypro = "select * from auction a left join products p on a.productID=p.productID where auctionID='".$editid."'";		
		$respro = db_query($qrypro);
		$objpro = db_fetch_object($respro);

		$productQty = $_REQUEST["product_qty"];
		
		if($objpro->productID==$productID)
		{
			if($objpro->qty_flag==1)
			{
				$oldcount = $objpro->recurr_count;
				$totalqty = $objpro->product_qty;
	
				$qty2 = $oldcount + $totalqty - $productQty;
	
				if($qty2 < 0)
				{
					echo "<script>alert ('Remaining Quantity is Less then Entered Quantity');
					window.location='addauction.php?auction_edit=".$editid."';
					</script>";
					exit;
				}
				else
				{
					$updateQuery = "update products set product_qty='$qty2' where productID='".$objpro->productID."'";
					db_query($updateQuery) or die(db_error());		
				}
			}
		}

		if($objpro->productID!=$productID)
		{
			$qry1 = "select * from products where productID='".$objpro->productID."'";
			$rs1 = db_query($qry1);
			$ob1 = db_fetch_object($rs1);
			
			$qry2 = "select * from products where productID='".$productID."'";
			$rs2 = db_query($qry2);
			$ob2 = db_fetch_object($rs2);
			
			if($ob2->qty_flag==1)
			{
				$qty2 = $ob2->product_qty - $_REQUEST["product_qty"];
				
				if($qty2 < 0)
				{
					echo "<script>alert ('Remaining Quantity is Less then Entered Quantity');
					window.location='addauction.php?auction_edit=".$editid."';
					</script>";
					exit;
				}
				else
				{
					$qryupd = "update products set product_qty='".$qty2."' where productID='".$productID."'";
					db_query($qryupd) or die(db_error());
				}
			}	

			  if($objpro->qty_flag==1)
			  {
				$oldproductqty = $ob1->product_qty + $objpro->recurr_count;
				$qryupd = "update products set product_qty='".$oldproductqty."' where productID='".$objpro->productID."'";
				db_query($qryupd) or die(db_error());
			  }
		}
		
		$futuretstamp = mktime($aucstarthour,$aucstartmin,$aucstartsec,$auc_start_date_ex[0],$auc_start_date_ex[1],$auc_start_date_ex[2]);

		if($changesval=="1")
		{
			$auc_status = 1;
		}	
		$editid = $_REQUEST["edit_auction"];
		$userid = $_REQUEST["userid"];
		if($_REQUEST["auc_back_status"]=="3" and $userid=='0')
		{
			//delete record from won_auctions and bid_account and 
			$delwonentry = "delete from won_auctions where userid='0' and auction_id='".$editid."'";
			db_query($delwonentry) or die(db_error());
			
			if($_REQUEST["unsoldauction"]!="")
			{
			$deldueentry = "delete from auc_due_table where auction_id='".$editid."'";
			db_query($deldueentry) or die(db_error());
			}

			$delbidaccentry = "delete from bid_account where user_id='0' and auction_id='".$editid."'";
			db_query($delbidaccentry) or die(db_error());
			
			//end 
			$auc_due_time = getHours($aucstartdate,$aucenddate,$aucstarthour,$aucendhour,$aucstartmin,$aucendmin,$aucstartsec,$aucendsec);
		if($auc_status==2)
		{	
			$q = "select * from auc_due_table where auction_id=$editid";
			$r = db_query($q);
			$to = db_num_rows($r);
			
			if($to>0)
			{
				$qry = "update auc_due_table set auc_due_time=$auc_due_time, auc_due_price=$auc_start_price where auction_id=$editid";
			}
			else
			{	
				$qry = "Insert into auc_due_table(auction_id,auc_due_time,auc_due_price) values($editid,'$auc_due_time',$auc_start_price)";
			}
			db_query($qry) or die(db_error());
		}
		if($_REQUEST["aucstatus"]==4)
		{
			$auc_status = $_REQUEST["aucstatus"];
		}

			$qryupd = "update auction set categoryID='$categoryID', productID='$productID',auc_start_price='$auc_start_price',auc_start_date='$auc_start_date',auc_end_date='$auc_end_date', auc_start_time='$auc_start_time', auc_end_time='$auc_end_time', auc_status='$auc_status', fixedpriceauction='$fpa',pennyauction='$pa',nailbiterauction='$nba',offauction='$off',nightauction='$na',openauction='$oa',time_duration='$duration', auc_recurr='$auc_recu',auc_fixed_price=$auc_fixed_price,total_time='$auc_due_time',buy_user='',auc_final_end_date='0000-00-00 00:00:00',auc_final_price='0',shipping_id='$shippingmethod',future_tstamp='$futuretstamp',recurr_count='$productQty' where auctionID='$editid'";
			db_query($qryupd) or die(db_error());
			
			header("location: message.php?msg=15");
			exit;
		}
		else
		{
			if($_REQUEST["auc_back_status"]!=2)
			{
				$q = "select * from auc_due_table where auction_id=$editid";
				$r = db_query($q);
				$to = db_num_rows($r);
		
				if($auc_status==2)
				{
					$auc_due_time = getHours($aucstartdate,$aucenddate,$aucstarthour,$aucendhour,$aucstartmin,$aucendmin,$aucstartsec,$aucendsec);
		
					if($to>0)
					{
						$qry = "update auc_due_table set auc_due_time=$auc_due_time, auc_due_price=$auc_start_price where auction_id=$editid";
					}
					else
					{	
						$qry = "Insert into auc_due_table (auction_id,auc_due_time,auc_due_price) values($editid,'$auc_due_time',$auc_start_price)";
					}
				db_query($qry) or die(db_error());
				}
			}
			if($_REQUEST["aucstatus"]==4)
			{
				$auc_status = $_REQUEST["aucstatus"];
			}
			$qryupd = "update auction set categoryID='$categoryID', productID='$productID', auc_start_price='$auc_start_price',auc_start_date='$auc_start_date',auc_end_date='$auc_end_date', auc_start_time='$auc_start_time', auc_end_time='$auc_end_time', auc_status='$auc_status', fixedpriceauction='$fpa',pennyauction='$pa',nailbiterauction='$nba',offauction='$off',nightauction='$na',openauction='$oa',time_duration='$duration', auc_recurr='$auc_recu',auc_fixed_price=$auc_fixed_price,total_time='$auc_due_time', shipping_id='$shippingmethod',future_tstamp='$futuretstamp',recurr_count='$productQty' where auctionID='$editid'";
			db_query($qryupd) or die(db_error());
			
			header("location: message.php?msg=15");
			exit;
		}	
	}
/*	if($_REQUEST["restartauction"]!="" & $_REQUEST["restart_auction"]!="")
	{
		$futuretstamp = mktime($_REQUEST["aucstarthours"],$_REQUEST["aucstartminutes"],$_REQUEST["aucstartseconds"],$auc_start_date_ex[1],$auc_start_date_ex[0],$auc_start_date_ex[2]);

		if($changesval=="1" && $auc_status=="2")
		{
			$auc_status = 1;
		}
		
		$qryupd = "update auction set auc_start_date='$auc_start_date',auc_end_date='$auc_end_date',auc_start_time='$auc_start_time',auc_end_time='$auc_end_time',auc_status='$auc_status',fixedpriceauction='$fpa',pennyauction='$pa',nailbiterauction='$nba',offauction='$off',nightauction='$na',openauction='$oa',time_duration='$duration',auc_recurr='$auc_recu',auc_fixed_price='$auc_fixed_price',total_time='$auc_due_time',shipping_id='$shippingmethod',future_tstamp='$futuretstamp' where auctionID='".$_REQUEST["restart_auction"]."'";
		db_query($qryupd) or die(db_error());
		
		$qryd = "delete from auc_due_table where auction_id='".$_REQUEST["restart_auction"]."'";
		db_query($qryd) or die(db_error());

		$delwonentry = "delete from won_auctions where userid='0' and auction_id='".$_REQUEST["restart_auction"]."'";
		db_query($delwonentry) or die(db_error());
		
	}*/
	if($_REQUEST["delete_auction"])
	{
		$delid = $_REQUEST["delete_auction"];

		$qryseld = "select * from auction a left join products p on a.productID=p.productID where auctionID=".$delid;
		$resseld = db_query($qryseld);
		$totalrow = db_affected_rows();
		$del = db_fetch_object($resseld);
		if($del->auc_status==2)
		{
			header("location: message.php?msg=16");
			exit;
		}

		if($del->recurr_count>0 && $del->qty_flag==1)
		{
			$updpro = "update products set product_qty=product_qty + ".$del->recurr_count." where productID='".$del->productID."'";
			db_query($updpro) or die(db_error());
		}
		$qrydel = "delete from auction where auctionID='$delid'";
		db_query($qrydel) or dir(db_error());
		header("location: message.php?msg=13");
	}
	
	if($_REQUEST["auction_edit"]!="" or $_REQUEST["auction_delete"]!="" or $_REQUEST["auction_clone"] || $_REQUEST["auction_restart"])
	{
		if($_REQUEST["auction_edit"]!=""){$aid=$_REQUEST["auction_edit"];}
		if($_REQUEST["auction_delete"]!=""){$aid=$_REQUEST["auction_delete"];}
		if($_REQUEST["auction_clone"]!=""){$aid=$_REQUEST["auction_clone"];}
		if($_REQUEST["auction_restart"]!="") { $aid=$_REQUEST["auction_restart"]; }
		$qrys = "select * from auction a left join products p on a.productID=p.productID where auctionID=".$aid;
		$ress = db_query($qrys);
		$total = db_affected_rows();
		$rows = db_fetch_object($ress);
		if($total>0)
		{
			$category = $rows->categoryID;		
 			$product = $rows->productID;
			$pprice = $rows->price;
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
				$aucsthours = substr($aucstarttime,0,2);
				$aucstmin =  substr($aucstarttime,3,2);
				$aucstsec =  substr($aucstarttime,6,2);
 			$aucendtime = $rows->auc_end_time;
				$aucendhours = substr($aucendtime,0,2);
				$aucendmin =  substr($aucendtime,3,2);
				$aucendsec =  substr($aucendtime,6,2);
 			$aucstatus = $rows->auc_status;
 			$auctype = $rows->auc_type;
 			$aucrecu = $rows->auc_recurr;
			$aucfixedprice = $rows->auc_fixed_price;
			$userid = $rows->buy_user;
			$shippingchargeid = $rows->shipping_id;
			$recuur_count = $rows->recurr_count;
			
		}
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>
<LINK href="main.css" type=text/css rel=stylesheet>
<link href="zpcal/themes/aqua.css" rel="stylesheet" type="text/css" media="all" title="Calendar Theme - aqua.css" />
<script type="text/javascript" src="zpcal/src/utils.js"></script>
<script type="text/javascript" src="zpcal/src/calendar.js"></script>
<script type="text/javascript" src="zpcal/lang/calendar-en.js"></script>
<script type="text/javascript" src="zpcal/src/calendar-setup.js"></script>
<script language="javascript">
function delconfirm(loc)
{
	if(confirm("Are you sure do you want to delete this?"))
	{
		window.location.href=loc;
	}
	return false;
}

function Check(f1)
{
	if(document.f1.category.value=="none")
	{
		alert("Please Select Category!!!");
		document.f1.category.focus();
		return false;
	}

	if(document.f1.product.value=="none")
	{
		alert("Please Select Product!!!");
		document.f1.product.focus();
		return false;
	}
	
	if(document.f1.aucstartprice.value=="")
	{
		alert("Please Enter Auction Start Price!!!");
		document.f1.aucstartprice.focus();
		return false;
	}

	/*if(document.f1.aucstartmonth.value=="none")
	{
		alert("Please Select Auction Start Month!!!");
		document.f1.aucstartmonth.focus();
		return false;
	}*/

	/*if(document.f1.aucstartyear.value=="none")
	{
		alert("Please Select Auction Start Year!!!");
		document.f1.aucstartyear.focus();
		return false;
	}*/

	/*if(document.f1.aucendmonth.value=="none")
	{
		alert("Please Select Auction End Month!!!");
		document.f1.aucendmonth.focus();
		return false;
	}*/

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
	var aucsdate = condate(document.f1.aucstartdate.value);
	var curdate = condate(document.f1.curdate.value); 
	var aucedate = condate(document.f1.aucenddate.value);

	var newaucsdate = new Date(aucsdate);
	var newcurdate = new Date(curdate);
	var newaucedate = new Date(aucedate);
	
	var newtime = document.f1.curtime.value;
	var temptime = newtime.split(":");

	var newtimehour = temptime[0];
	var newtimeminute = temptime[1];
	var newtimeseconds = temptime[2];


<?php if($aucstatus==2 || $aucstatus==1 || $aucstatus=="" || $_REQUEST["auction_clone"]!="" || $_REQUEST["auction_edit"]){	?>
	if(newcurdate>newaucsdate)
	{
		alert("Auction Start Date should not be past date.")
		document.f1.aucstartdate.focus();
		return false;
	}
	if(newcurdate>newaucedate)
	{
		alert("Auction End Date should not be past date.")
		document.f1.aucenddate.focus();
		return false;
	}
	if(newaucsdate>newaucedate)
	{
		alert("Auction End date should be greater than Auction Start date");
		document.f1.aucenddate.focus();
		return false;
	}
	if(newaucsdate>newcurdate)
	{
		document.f1.changestatusval.value = "1";
	}
	if(document.f1.startimmidiate.checked==false)
	{
		if(document.f1.changestatusval.value != "1")
		{
			if(Number(newtimehour)<Number(document.f1.aucstarthours.value))	
			{
				document.f1.changestatusval.value = "1";
			}
			else
			{
				if(Number(newtimeminute)<Number(document.f1.aucstartminutes.value))
				{
					document.f1.changestatusval.value = "1";
				}
			}
		}
	if(document.f1.changestatusval.value != "1")
	{
		if(document.f1.aucstarthours.value<newtimehour)
		{
			alert("Auction start time should not be past time");
			document.f1.aucstarthours.focus();
			return false;
		}
		else
		{
			if(document.f1.aucstarthours.value==newtimehour)
			{
				if(document.f1.aucstartminutes.value<newtimeminute)
				{
					alert("Auction start time should not be past time");
					document.f1.aucstartminutes.focus();
					return false;
				}
			}
		}
	
		if(document.f1.aucendhours.value<newtimehour)
		{
			alert("Auction end time should not be past time");
			document.f1.aucendhours.focus();
			return false;
		}
		else
		{
			if(document.f1.aucendminutes.value<newtimeminute)
			{
				if(document.f1.aucendhours.value==newtimehour)
				{
					alert("Auction end time should not be past time");
					document.f1.aucendminutes.focus();
					return false;
				}
			}
			else
			{
				if(document.f1.aucendminutes.value==newtimeminute)
				{
					if(document.f1.aucendseconds.value<newtimeseconds)
					{
						alert("Auction end time should not be past time");
						document.f1.aucendseconds.focus();
						return false;
					}
				}
			}
		}
	}
  }
  else
  {
  	 if(aucsdate==aucedate)
	 {
		if(document.f1.aucendhours.value<newtimehour)
		{
			alert("Auction end time should not be past time");
			document.f1.aucendhours.focus();
			return false;
		}
		else
		{
			if(document.f1.aucendminutes.value<newtimeminute)
			{
				if(document.f1.aucendhours.value==newtimehour)
				{
					alert("Auction end time should not be past time");
					document.f1.aucendminutes.focus();
					return false;
				}
			}
			else
			{
				if(document.f1.aucendminutes.value==newtimeminute)
				{
					if(document.f1.aucendseconds.value<newtimeseconds)
					{
						alert("Auction end time should not be past time");
						document.f1.aucendseconds.focus();
						return false;
					}
				}
			}
		}
	 }
	 if(document.f1.startimmidiate.checked)
	 {
	 	document.f1.changestatusval.value = "0";
	 }
  }
<?php } ?>	
	/*if(document.f1.aucendyear.value=="none")
	{
		alert("Please Select Auction End Year!!!");
		document.f1.aucendyear.focus();
		return false;
	}*/

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

	if(document.f1.fpa.checked==true && document.f1.off.checked==true)
	{
		alert("You can't select Set Price Auction type with Totally Free Auction type!!!");
		return false;
	}
	if(document.f1.fpa.checked==false && document.f1.pa.checked==false && document.f1.nba.checked==false && document.f1.off.checked==false && document.f1.na.checked==false && document.f1.oa.checked==false)
	{
		alert("Please select auction type");
		return false;
	}
	if(document.f1.shippingmethod.value=="none")
	{
		alert("Please select shipping charge method");
		document.f1.shippingmethod.focus();
		return false;
	}
	if(document.f1.editauctionid.value=="")
	{
		if(Number(document.f1.product_qty.value)>Number(document.getElementById('remainingquantity').innerHTML))
		{
			alert("Quantity must be less than remaining quantity");
			document.f1.product_qty.focus();
			return false;
		}
	}
}
function condate(dt)
{
	var ndate= new String(dt);
	//alert(dt);
	var fdt=ndate.split("/");
	var nday=fdt[1];
	var nmon=fdt[0];
	var nyear=fdt[2];
	
	var finaldate=nmon+"/"+nday+"/"+nyear;
	//alert(finaldate);
	
	return finaldate;
}
function DisabledAuctionTime()
{
	if(document.f1.startimmidiate.checked == true)
	{
		document.f1.aucstarthours.disabled = true;
		document.f1.aucstartminutes.disabled = true;
		document.f1.aucstartseconds.disabled = true;
	}
	if(document.f1.startimmidiate.checked == false)
	{
		document.f1.aucstarthours.disabled = false;
		document.f1.aucstartminutes.disabled = false;
		document.f1.aucstartseconds.disabled = false;
	}
}
function EnableDisableFixAuc(f1)
{
	if(document.f1.fpa.checked==true)
	{
		document.f1.aucfixedprice.disabled = false;
	}
	else
	{
		document.f1.aucfixedprice.disabled = true;
		document.f1.aucfixedprice.value = "0.00";
	}
}
</script>
<script language="javascript">
// USE FOR AJAX //
function GetXmlHttpObject()
{
var xmlHttp=null;
try
  {
  // Firefox, Opera 8.0+, Safari
  xmlHttp=new XMLHttpRequest();
  }
catch (e)
  {
  // Internet Explorer
  try
    {
    xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
    }
  catch (e)
    {
    xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
  }
return xmlHttp;

}

function setprice(prid)
{
	xmlHttp=GetXmlHttpObject();
	if (xmlHttp==null)
	  {
	  alert ("Your browser does not support AJAX!");
	  return;
	  } 
	var url="getprice.php";
	url=url+"?prid="+prid
	xmlHttp.onreadystatechange=changedprice;
	xmlHttp.open("GET",url,true);
	xmlHttp.send(null);
	
}

function changedprice()
{	
	if (xmlHttp.readyState==4)
	{ 
		var temp=xmlHttp.responseText
		
		var temp2 = temp
		temp2 = temp.split("|");
				
		if(temp2[2] == "1")
		{
			document.getElementById("getproductQty").style.display="block";
			document.getElementById("masgDisplay").style.display="block";
			document.getElementById("getqty").style.display="block";
			
			document.getElementById("getprice").innerHTML = temp2[0];
			document.getElementById("getproductQty").innerHTML = temp2[1] + ")";
			document.getElementById('remainingquantity').innerHTML = temp2[1];
			document.f1.recurr_count_edit.value = temp2[1];
		}
		else
		{
			document.getElementById("getprice").style.display="none";
			document.getElementById("getproductQty").style.display="none";
			document.getElementById("masgDisplay").style.display="none";
			document.getElementById("getqty").style.display="none";
			document.f1.product_qty.value="0";
			
			document.getElementById("getprice").style.display="block";
			document.getElementById("getprice").innerHTML = temp2[0];
			document.getElementById('remainingquantity').innerHTML = "0";
			document.f1.recurr_count_edit.value = "0";
		}
	}
	
	
}

function ChangeProduct(crid)
{
	xmlHttp=GetXmlHttpObject();
	if (xmlHttp==null)
	  {
	  alert ("Your browser does not support AJAX!");
	  return;
	  } 
	var url="getproductlist.php";
	url=url+"?crid="+crid
	xmlHttp.onreadystatechange=ChangedProduct;
	xmlHttp.open("GET",url,true);
	xmlHttp.send(null);
	
}
function ChangedProduct()
{
	if (xmlHttp.readyState==4)
	{ 
		var tempproduct=xmlHttp.responseText
		document.getElementById("Productlist").innerHTML = tempproduct;
	}
}

</script>
</head>

<BODY bgColor=#ffffff onload="EnableDisableFixAuc(f1); setprice('<?=$product?>');">   
<form name="f1" action='addauction.php' method='POST' enctype="multipart/form-data" onsubmit="return Check(this)">
<table width="100%" cellpadding="0" cellSpacing="10">
  <tr>
	<td class="H1"><?php if($_GET['auction_edit']!="") { ?> Edit Auction<?php } else { if($_GET['auction_delete']!=""){ ?> Confirm Delete Auction <?php }else { ?> Add Auction <?php } } ?></td>
  </tr>
  <tr>
	<td background="<?=DIR_WS_ICONS?>vdots.gif"><IMG height=1 src="<?=DIR_WS_ICONS?>spacer.gif" width=1 border=0></td>
  </tr>
  <tr>
	<td class="a" align="right" colspan=2 >* Required Information</td>
  </tr>
  <tr>
 	<td>
 	  <table cellpadding="1" cellspacing="2" border="0">
	  <?
	  if($aucstatus=="2")
	  {	
	  ?>
	  	<tr>
			<td colspan="2"><font class="a">(Note: This Auction is currently running, So you cannot modify it at the moment.)</font></td>
		</tr>
		<tr>
			<td colspan="2" height="5"></td>
		</tr>
	<?
	  }
	?>	
	    <tr valign="middle">
          <td class=f-c align=right valign="middle" width="191"><font class=a>*</font> Category :</td>
		  <td id="category">
		  	<select name="category" style="100pt;" onchange="ChangeProduct(this.value);">
			<option value="none">select one</option>
			<?
			$qryc = "select * from categories";
			$resc = db_query($qryc);
			$totalc = db_affected_rows();
			while($namec = db_fetch_array($resc))
			{
			?>
			<option <?=$category==$namec["categoryID"]?"selected":"";?> value="<?=$namec["categoryID"];?>"><?=$namec["name"];?></option>
			<?
			}
			?>
			</select></td>
		</tr>
	    <tr valign="middle">
          <td class=f-c align=right valign="middle" width="191"><font class=a>*</font> Product :</td>
	  	  <td  nowrap="nowrap">
		   <table cellpadding="1" cellspacing="2" border="0">
			   <tr>
				<td id="Productlist">
				  <select name="product" style="width: 260px;" onchange="setprice(this.value);">
				  <option value="none">select one</option>
				  <?
				  	if($category!="")
					{
						$qryp = "select * from products where categoryID='".$category."'";
					}
					else
					{
						$qryp = "select * from products";
					}	
					$resp = db_query($qryp);
					$totalp = db_affected_rows();
					while($objp = db_fetch_array($resp))
					{
				  ?>
					<option <?=$product==$objp["productID"]?"selected":"";?> value="<?=$objp["productID"];?>"><?=$objp["name"];?></option>
				  <?
						}
				  ?>
				  </select></td>
				  <td id="masgDisplay" class="a" style="display:none">Maintain Quantity(Remaining Quantity:</td>
				  <td id="getProductQty" class="a" style="display:none"></td>
				  <span id="remainingquantity" style="display: none;"></span>
			  </tr>
			  <input type="hidden" value="<?=$recuur_count?>" name="recurr_count_edit" />
		  </table>
		  
 	    </tr>
		<tr id="getqty" valign="middle" <?php if($pproductQty){?> <?php } else {?>style="display:none" <?php }?> >
          <td class=f-c align=right valign="middle" width="191"><font class=a>*</font> Quantity :</td>
	  	  <td><input type="text" name="product_qty" value="<?=$recuur_count?>" /></td>
	    </tr>
		
	    <tr valign="middle">
          <td class=f-c align=right valign="middle" width="191"><font class=a>*</font> Product Market Price :</td>
	  	  <td id="getprice"><?=$pprice!=""?$pprice:"";?></td>
	    </tr>
		<tr>
			<td class="f-c"  align="right">Auction Type :</td>
			<td>
				<table border="0">
				<tr>
					<td>
						<input <?=$rows->fixedpriceauction=="1"?"checked":""?> type="checkbox" name="fpa" value="1" onclick="EnableDisableFixAuc(this);"> Set Price Auction </td>
					<td>
						<input <?=$rows->pennyauction=="1"?"checked":""?> type="checkbox" name="pa" value="1"> 1 Cent Auction 
					</td>
					<td>
						<input <?=$rows->nailbiterauction=="1"?"checked":""?> type="checkbox" name="nba" value="1"> NailBiter Auction 
					</td>
				</tr>
				<tr>
					<td><input <?=$rows->offauction=="1"?"checked":""?> type="checkbox" name="off" value="1"> Totally Free</td>
					<td><input <?=$rows->nightauction=="1"?"checked":""?> type="checkbox" name="na" value="1"> Night Auction</td>
					<td><input <?=$rows->openauction=="1"?"checked":""?> type="checkbox" name="oa" value="1"> Open Auction</td>
				</tr>
				</table>
			</td>
			</tr>
	    <tr valign="middle">
          <td class=f-c align=right valign="middle" width="191"><font class=a>*</font> Auction Start Price :</td>
          <td><input name="aucstartprice" type="text" class="solidinput" id="member_name" value="<?=$aucstartprice?>" size="12" maxlength="20">&nbsp;<font color="#FF0000"><?=$Currency;?></font></td>
        </tr>
	    <tr valign="middle">
          <td class=f-c align=right valign="middle" width="191"><font class=a>*</font> Auction Fixed Price :</td>
          <td><input name="aucfixedprice" type="text" class="solidinput" value="<?=$aucfixedprice?>" size="12" disabled="disabled" id="aucfixedprice" maxlength="20">&nbsp;<font color="#FF0000"><?=$Currency;?> (Compulsory: If Auction Type is selected to Fixed price)</font></td>
        </tr>
		<tr valign="middle">
          <td class="f-c" align="right" valign="middle" width="191">Auction Date :</td>
          <td>
			<?php /*?><select name="aucstartdate">
			<option value="none">--</option>
			<?
				for($i=1;$i<=31;$i++)
				{
					if($i<10)
					{
						$i="0".$i;
					}
					if($aucstatus=="3" and $userid==1)
					{	
					?>
					<option <?=date("d")==$i?"selected":""?> value="<?=$i?>"><?=$i;?></option>
					<?
					}
					else
					{
			?>
			<option <?=$aucstartdate==$i?"selected":""?> value="<?=$i?>"><?=$i;?></option>
			<?		
					}
				}
			?>
			</select>
			<select name="aucstartmonth">
			<option value="none">--</option>
			<?
				for($i=1;$i<=12;$i++)
				{
					if($i<10)
					{
						$i="0".$i;
					}
					if($aucstatus=="3" and $userid==1)
					{
			?>
			<option <?=date("m")==$i?"selected":"";?> value="<?=$i?>"><?=$i;?></option>
			<?
					}
					else
					{
			?>
			<option <?=$aucstartmonth==$i?"selected":"";?> value="<?=$i?>"><?=$i;?></option>
			<?		
					}
				}
			?>
		 	</select>
	
			<select name="aucstartyear">
				<option value="none">----</option>
				<?
					for($i=2008;$i<=2050;$i++)
					{
						if($aucstatus=="3" and $userid==1)
						{
				?>
					<option <?=date("Y")==$i?"selected":""?> value="<?=$i;?>"><?=$i;?></option>
				<?
						}
						else
						{
				?>
					<option <?=$aucstartyear==$i?"selected":""?> value="<?=$i;?>"><?=$i;?></option>
				<?
						}
					}
				?>
			</select><?php */?>
			<input type="text" size="12" name="aucstartdate" id="aucstartdate" value="<?=$aucstartdate!=""?date("m/d/Y",strtotime($aucstartdate)):"";?>" />
			<img src="images/pmscalendar.gif" align="absmiddle" width="20" height="20" id="vfrom">
			 	<B>&nbsp;To&nbsp;</B>
				<input type="text" size="12" name="aucenddate" id="aucenddate" value="<?=$aucenddate!=""?date("m/d/Y",strtotime($aucenddate)):"";?>" />
			<img src="images/pmscalendar.gif" align="absmiddle" width="20" height="20" id="zfrom">
			<?php /*?><select name="aucenddate">
			<option value="none">--</option>
			<?
				for($i=1;$i<=31;$i++)
				{
					if($i<10)
					{
						$i="0".$i;
					}
					if($aucstatus=="3" and $userid==1)
					{
			?>
			<option <?=(date("d")+1)==$i?"selected":""?> value="<?=$i?>"><?=$i;?></option>
			<?
					}
					else
					{
			?>
			<option <?=$aucenddate==$i?"selected":""?> value="<?=$i?>"><?=$i;?></option>
			<?		
					}
				}
			?>
			</select>
			<select name="aucendmonth">
			<option value="none">--</option>
			<?
				for($i=1;$i<=12;$i++)
				{
					if($i<10)
					{
						$i="0".$i;
					}
					if($aucstatus=="3" and $userid==1)
					{
			?>
			<option <?=date("m")==$i?"selected":"";?> value="<?=$i?>"><?=$i;?></option>
			<?
					}
					else
					{
			?>
			<option <?=$aucendmonth==$i?"selected":"";?> value="<?=$i?>"><?=$i;?></option>
			<?		
					}
				}
			?>
		 	</select>
	
			<select name="aucendyear">
				<option value="none">----</option>
				<?
					for($i=2008;$i<=2050;$i++)
					{
						if($aucstatus=="3" and $userid==1)
						{
				?>
					<option <?=date("Y")==$i?"selected":""?> value="<?=$i;?>"><?=$i;?></option>
				<?
						}
						else
						{
				?>
					<option <?=$aucendyear==$i?"selected":""?> value="<?=$i;?>"><?=$i;?></option>
				<?			
						}
					}
				?>
			</select><?php */?>
		</td>
		</tr>
		<tr>
			<td class="f-c"  align="right"><font class=a>*</font>Auction Time :</td>
			<td>
			<?php if($aucstatus=="3" and $userid==1) 
			{
			?>
			<select name="aucstarthours">
			<option value="">hh</option>
			<?php for ($h=0;$h<=23;$h++){ ?>
				<option <?=date("H")==$h?"selected":"";?> value="<?=str_pad($h,2,"0",STR_PAD_LEFT);?>">
			<?php } ?>
			</select> :
			<!--<input maxlength="2" type="text" name="aucstarthours" size="2" value="<?//date("H")!=""?date("H"):"";?>">-->
			<?php }else{ ?>
			<select name="aucstarthours">
			<option value="">hh</option>
			<?php for ($h=0;$h<=23;$h++){ ?>
				<option <?=$aucsthours==$h?"selected":"";?> value="<?=str_pad($h,2,"0",STR_PAD_LEFT);?>"><?=str_pad($h,2,"0",STR_PAD_LEFT);?></option>
			<?php } ?>
			</select> :
			<?php /*?><input maxlength="2" type="text" name="aucstarthours" size="2" value="<?=$aucsthours!=""?$aucsthours:"";?>"> :<?php */?>
			<?php } ?>
			<?php if($aucstatus=="3" and $userid==1) 
			{
			?>
			<select name="aucstartminutes">
			<option value="">mm</option>
			<?php for ($m=0;$m<=59;$m++){ ?>
				<option <?=date("i")==$m?"selected":"";?> value="<?=str_pad($m,2,"0",STR_PAD_LEFT);?>"><?=str_pad($m,2,"0",STR_PAD_LEFT);?></option>
			<?php } ?>
			</select> :
			<?php /*?><input maxlength="2" type="text" name="aucstartminutes" size="2" value="<?=date("i")!=""?date("i"):"";?>"> :<?php */?>
			<?php }else{ ?>
			<select name="aucstartminutes">
			<option value="">mm</option>
			<?php for ($m=0;$m<=59;$m++){ ?>
				<option <?=$aucstmin==$m?"selected":"";?> value="<?=str_pad($m,2,"0",STR_PAD_LEFT);?>"><?=str_pad($m,2,"0",STR_PAD_LEFT);?></option>
			<?php } ?>
			</select> :
			<?php /*?><input maxlength="2" type="text" name="aucstartminutes" size="2" value="<?=$aucstmin!=""?$aucstmin:"";?>"> :<?php */?>
			<?php } ?>
			<?php if($aucstatus=="3" and $userid==1) 
			{
			?>
			<select name="aucstartseconds">
			<option value="">ss</option>
			<?php for ($s=0;$s<=59;$s++){ ?>
				<option <?=date("s")==$s?"selected":"";?> value="<?=str_pad($s,2,"0",STR_PAD_LEFT);?>"><?=str_pad($s,2,"0",STR_PAD_LEFT);?></option>
			<?php } ?>
			</select>
			<?php /*?><input maxlength="2" type="text" name="aucstartseconds" size="2" value="<?=date("s")!=""?date("s"):"";?>"><?php */?>
			<?php }else{ ?>
			<select name="aucstartseconds">
			<option value="">ss</option>
			<?php for ($s=0;$s<=59;$s++){ ?>
				<option <?=$aucstsec==$s?"selected":"";?> value="<?=str_pad($s,2,"0",STR_PAD_LEFT);?>"><?=str_pad($s,2,"0",STR_PAD_LEFT);?></option>
			<?php } ?>
			</select>
			<?php /*?><input maxlength="2" type="text" name="aucstartseconds" size="2" value="<?=$aucstsec!=""?$aucstsec:"";?>"><?php */?>
			<?php } ?>
			 <b>&nbsp;To&nbsp;</b>
			 <?php if($aucstatus=="3" and $userid==1) 
			{
			?>
			<select name="aucendhours">
			<option value="">hh</option>
			<?php for ($h=0;$h<=23;$h++){ ?>
				<option <?=date("H")==$h?"selected":"";?> value="<?=str_pad($h,2,"0",STR_PAD_LEFT);?>"><?=str_pad($h,2,"0",STR_PAD_LEFT);?></option>
			<?php } ?>
			</select> :
		    <?php /*?><input maxlength="2" type="text" name="aucendhours" size="2" value="<?=date("H")!=""?date("H"):"";?>"> :<?php */?>
			<?php }else{ ?>
			<select name="aucendhours">
			<option value="">hh</option>
			<?php for ($h=0;$h<=23;$h++){ ?>
				<option <?=$aucendhours==$h?"selected":"";?> value="<?=str_pad($h,2,"0",STR_PAD_LEFT);?>"><?=str_pad($h,2,"0",STR_PAD_LEFT);?></option>
			<?php } ?>
			</select> :
			<?php /*?><input maxlength="2" type="text" name="aucendhours" size="2" value="<?=$aucendhours!=""?$aucendhours:"";?>"> :<?php */?>
			<?php } ?>
			 <?php if($aucstatus=="3" and $userid==1) 
			{
			?>
			<select name="aucendminutes">
			<option value="">mm</option>
			<?php for ($m=0;$m<=59;$m++){ ?>
				<option <?=date("i")==$m?"selected":"";?> value="<?=str_pad($m,2,"0",STR_PAD_LEFT);?>"><?=str_pad($m,2,"0",STR_PAD_LEFT);?></option>
			<?php } ?>
			</select> :
			<?php /*?><input maxlength="2" type="text" name="aucendminutes" size="2" value="<?=date("i")!=""?date("i"):"";?>"> :<?php */?>
			<?php }else{ ?>
			<select name="aucendminutes">
			<option value="">mm</option>
			<?php for ($m=0;$m<=59;$m++){ ?>
				<option <?=$aucendmin==$m?"selected":"";?> value="<?=str_pad($m,2,"0",STR_PAD_LEFT);?>"><?=str_pad($m,2,"0",STR_PAD_LEFT);?></option>
			<?php } ?>
			</select> :
			<?php /*?><input maxlength="2" type="text" name="aucendminutes" size="2" value="<?=$aucendmin!=""?$aucendmin:"";?>"> :<?php */?>
			<?php } ?>
			 <?php if($aucstatus=="3" and $userid==1) 
			{
			?>
			<select name="aucendseconds">
			<option value="">ss</option>
			<?php for ($s=0;$s<=59;$s++){ ?>
				<option <?=date("s")==$s?"selected":"";?> value="<?=str_pad($s,2,"0",STR_PAD_LEFT);?>"><?=str_pad($s,2,"0",STR_PAD_LEFT);?></option>
			<?php } ?>
			</select>
			<?php /*?><input maxlength="2" type="text" name="aucendseconds" size="2" value="<?=date("s")!=""?date("s"):"";?>"><?php */?>
			<?php }else{ ?>
			<select name="aucendseconds">
			<option value="">ss</option>
			<?php for ($s=0;$s<=59;$s++){ ?>
				<option <?=$aucendsec==$s?"selected":"";?> value="<?=str_pad($s,2,"0",STR_PAD_LEFT);?>"><?=str_pad($s,2,"0",STR_PAD_LEFT);?></option>
			<?php } ?>
			</select>
			<?php /*?><input maxlength="2" type="text" name="aucendseconds" size="2" value="<?=$aucendsec!=""?$aucendsec:"";?>"><?php */?>
			<?php } ?>	<font class="a">(24 hours)</font>
			</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td><input type="checkbox" name="startimmidiate" value="start" onclick="DisabledAuctionTime();" />&nbsp;Start Immidiately
		<tr>
		<tr>
			<td class="f-c"  align="right">Auction Status :</td>
			<td>
			<select name="aucstatus">
				<option <?=$aucstatus=="2"?"selected":"";?> value="2">Active</option>
				<option <?=($aucstatus=="4")?"selected":"";?> value="4">Pending</option>
			<?	if($_REQUEST["auction_edit"]!="")
				{
			?>	
				<option <?=$aucstatus=="3"?"selected":"";?> value="3">Sold</option>
			<?
				}
			?>	
			</select><br /><font class="a">(Note: If status is Active and start date is Future date then Auction will be considered as Future Auction.<br />If status is pending then auction is saved in system not for a sale, change status to Active for put them for sale.)</font>
			</td>
		</tr>
		<tr>
					<td class="f-c"  align="right">Auction Duration  :</td>
					<td>
						<select name="auctionduration">
							<option value="none">Default</option>
							<option value="10sa" <?=$rows->time_duration=="10sa"?"selected":"";?>>10-Second Auction</option>
							<option value="15sa" <?=$rows->time_duration=="15sa"?"selected":"";?>>15-Second Auction</option>
							<option value="20sa" <?=$rows->time_duration=="20sa"?"selected":"";?>>20-Second Auction</option>
						</select>
					</td>
		</tr>
		<tr>
					<td class="f-c"  align="right"><font class=a>*</font>Shipping Method  :</td>
					<td>
					<select name="shippingmethod" style="width: 180px;">
					<option value="none">select one</option>
					<?
						$qryshipping = "select * from shipping";
						$resshipping = db_query($qryshipping);
						while($objshipping = db_fetch_object($resshipping))
						{
					?>
					<option <?=$objshipping->id==$shippingchargeid?"selected":"";?> value="<?=$objshipping->id;?>"><?=$objshipping->shipping_title;?></option>
					<?
						}
					?>
						</select>
					</td>
		</tr>
<!--		<tr>
			<td class="f-c"  align="right">Recurring :</td>
			<td>
				<select name="aucrec" style="width:50pt;">
				<option <?$aucrecu=="yes"?"selected":"";?> value="yes">Yes</option>
				<option <?$aucrecu=="no"?"selected":"";?> value="no">No</option>
				</select>
			</td>
		</tr>-->
		<tr>
			<td>&nbsp;</td>
		</tr>
		<tr>
		<input type="hidden" name="editauctionid" value="<?=$_REQUEST["auction_edit"];?>" />
		<td align="center" colspan="2">
			<?
			if($_REQUEST["auction_edit"]!="")
			{
				if($aucstatus=="3" and $userid!=0)
				{
			?>
			<input type="submit" name="editauction" value="Edit Auction" disabled="disabled" class="bttn" />
			<?
				}
				else
				{
					if($aucstatus=="2")
					{
			?>
			<input type="submit" name="editauction" disabled="disabled" value="Edit Auction" class="bttn" />
			<?
					}
					else
					{
			?>
			<input type="submit" name="editauction" value="Edit Auction" class="bttn" />
			<?			
					}
				}
			?>
			<input type="hidden" name="edit_auction" value="<?=$_REQUEST["auction_edit"];?>" />
			<input type="hidden" name="auc_back_status" value="<?=$aucstatus;?>" />
			<input type="hidden" name="userid" value="<?=$userid;?>" />
			<input type="hidden" name="unsoldauction" value="<?=$_REQUEST["und"];?>" />
			<?
			}
			elseif($_REQUEST["auction_delete"]!="")
			{
				$delid = $_REQUEST["auction_delete"];
			?>
			<input type="button" name="deleteauction" value="Delete Auction" class="bttn" onclick="delconfirm('addauction.php?delete_auction=<?=$delid?>');"/>
			<?
			}
			else
			{
			?>
			<input type="submit" name="addauction" value="Add Auction" class="bttn" />
			<?
			}
			?>
		</td>
		</tr>
		</table>
	</td>
	</tr>
</table>
<input type="text" name="text" value="<?=$rows->total_time;?>" />
<input type="hidden" name="curdate" value="<?=date("m/d/Y");?>" />
<input type="hidden" name="changestatusval" value="" />
<input type="hidden" name="curtime" value="<?=date("H:i:s");?>" />
</form>
<script type="text/javascript">
var cal = new Zapatec.Calendar.setup({ 
inputField:"aucstartdate",
ifFormat:"%m/%d/%Y",
button:"vfrom",
showsTime:false 
});
</script>
<script type="text/javascript">
var cal = new Zapatec.Calendar.setup({ 
inputField:"aucenddate",
ifFormat:"%m/%d/%Y",
button:"zfrom",
showsTime:false 
});
</script>
</body>
</html>