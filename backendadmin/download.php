<?php
// We'll be outputting
include("connect.php");
include("functions.php");

/* Developed By Pramod Ranpariya Date:28-Aug-2008 */	
/* Reports:1) Productwise,2) AuctionWise,3) Financial,4) Affiliate */
if($_GET['export']=='product')
{
	// Must be a writeable location for file
	//$output_file="export.csv";	 
	// The query to output to CSV
	
	$startdate = ChangeDateFormat($_GET["datefrom"]);
	$enddate = ChangeDateFormat($_GET["dateto"]);
	$product = $_GET["products"];
	$auctionstatus = $_GET["auctionstatus"];
	
	
	if($auctionstatus!="")
	{
		if($auctionstatus=="1")
		{
			$qrysel = "select * from auction a left join products p on a.productID=p.productID where a.auc_start_date>='$startdate' and auc_end_date<='$enddate' and a.productID='$product' and (a.auc_status='1' or a.auc_status='2')";
		}
		else
		{
			$qrysel = "select * from auction a left join products p on a.productID=p.productID where a.auc_start_date>='$startdate' and auc_end_date<='$enddate' and a.productID='$product' and a.auc_status='$auctionstatus'";
		}
	}
	else
	{
		$qrysel = "select * from auction a left join products p on a.productID=p.productID where a.auc_start_date>='$startdate' and auc_end_date<='$enddate' and a.productID='$product'";
	}
	
	$sql = $qrysel;
	// Support for multi-table select
	// $sql = "SELECT * FROM tbl2, tbl1 WHERE tbl1.col1 = tbl2.col2";
	 
	//---------------------------------------------------
	// Connect database
	//db_connect($host,$username,$password,$DATABASENAME);
	//db_select_db($database);
	 
	$result=db_query($sql);
	 
	$output = '';
	 
	// Get a list of all the fields in the table
	// $fields = db_list_fields($database,$table);
	// Count the number of fields
	$count_fields = 6; //db_num_fields($result);
	 
	// Put the name of all fields to $out.
	for ($i = 0; $i < $count_fields; $i++) 
	{
		if($i==0)
		{
			$output.= '"Auction ID",';
		}
		elseif($i==1)
		{
			$output.= '"Auction Type",';
		}
		elseif($i==2)
		{
			$output.= '"Start Price",';
		}
		elseif($i==3)
		{
			$output.= '"Fixed Price",';
		}
		elseif($i==4)
		{
			$output.= '"End Date",';
		}
		elseif($i==5)
		{
			$output.= '"Auction Status",';
		}
	}
	$output .="\n";
	 
	// Add all values in the table to $out.
	while ($row = db_fetch_array($result)) 
	{
		for ($i = 0; $i < $count_fields; $i++) 
		{
			
			if($i==0)
			{
				$val=$row["auctionID"];
			}
			elseif($i==1)
			{
				if($row['fixedpriceauction']=="1") { $val = "Fixed Price Auction"; }
				if($row['pennuauction']=="1") { $val = "Penny Auction"; }
				if($row['nailbiterauction']=="1") { $val = "NailBiter Auction"; }
				if($row['offauction']=="1") { $val = "100% Off Auction"; }
				if($row['nightauction']=="1") { $val = "Night Auction"; }
				if($row['openauction']=="1") { $val = "Open Auction"; }
			}
			elseif($i==2)
			{
				$val=$row['auc_start_price'];
			}
			elseif($i==3)
			{
				$val=$row['auc_fixed_price'];	
			}
			elseif($i==4)
			{
				$val=substr(ChangeDateFormatSlash($row['auc_final_end_date']),0,10);
			}
			elseif($i==5)
			{
				if($row['auc_status']=="2" || $row['auc_status']=="1") { $val = "Active"; }
				elseif($row['auc_status']=="4") { $val = "Pending"; }
				elseif($row['auc_status']=="3") { $val = "Sold"; }
			}
				
			$output .='"'.$val.'",';
			$val="";
		}
	
		$output .="\n";
	}
	 
	
	// Output the file to the local filesystem.  You could append a 
	// date to the filename to keep a record of the exports.
	 
	// Open a new output file
	$filenm='productwisereport.csv';
	$output_file='reports/productwisereport.csv';
	if(file_exists($output_file))
	{
		@unlink($output_file);
	}
	
	$file = fopen ($output_file,'w');
	// Put contents of $output into the $file
	fputs($file, $output);
	fclose($file);
				
}
elseif($_GET['export']=='auction')
{
	$startdate = ChangeDateFormat($_GET["datefrom"]);
	$enddate = ChangeDateFormat($_GET["dateto"]);
	$auctionstatus = $_GET["auctionstatus"];
	$auctiontype = $_GET["auctiontype"];
	
	if($auctiontype!="none")
	{
		if($auctiontype=="fpa") { $auctype = "and fixedpriceauction='1'"; }							
		if($auctiontype=="pa") { $auctype = "and pennyauction='1'"; }							
		if($auctiontype=="nba") { $auctype = "and nailbiterauction='1'"; }							
		if($auctiontype=="off") { $auctype = "and offauction='1'"; }							
		if($auctiontype=="na") { $auctype = "and nightauction='1'"; }							
		if($auctiontype=="oa") { $auctype = "and openauction='1'"; }							
	}

	if($auctionstatus!="")
	{
		if($auctionstatus==2)
		{	
			$qrysel = "select * from auction a left join products p on a.productID=p.productID where (a.auc_status='$auctionstatus' or a.auc_status='1') and  auc_start_date>='$startdate' and auc_end_date<='$enddate' ".$auctype;
		}
		else
		{
			$qrysel = "select * from auction a left join products p on p.productID=a.productID where a.auc_status='$auctionstatus' and auc_start_date>='$startdate' and auc_end_date<='$enddate' ".$auctype;
		}
	}
	else
	{
			$qrysel = "select * from auction a left join products p on p.productID=a.productID where auc_start_date>='$startdate' and auc_end_date<='$enddate' ".$auctype;
	}
	
	
	// Must be a writeable location for file
	//$output_file="export.csv";
	 
	// The query to output to CSV
	$sql = $qrysel;
	// Support for multi-table select
	// $sql = "SELECT * FROM tbl2, tbl1 WHERE tbl1.col1 = tbl2.col2";
	 
	//---------------------------------------------------
	// Connect database
	//db_connect($host,$username,$password,$DATABASENAME);
	//db_select_db($database);
	 
	$result=db_query($sql);
	 
	$output = '';
	 
	// Get a list of all the fields in the table
	// $fields = db_list_fields($database,$table);
	// Count the number of fields
	$count_fields = 6; //db_num_fields($result);
	 
	// Put the name of all fields to $out.
	for ($i = 0; $i < $count_fields; $i++) 
	{
		if($i==0)
		{
			$output.= '"Auction ID",';
		}
		elseif($i==1)
		{
			$output.= '"Name",';
		}
		elseif($i==2)
		{
			$output.= '"Start Price",';
		}
		elseif($i==3)
		{
			$output.= '"Fixed Price",';
		}
		elseif($i==4)
		{
			$output.= '"Auction Status",';
		}
		elseif($i==5)
		{
			$output.= '"Duration",';
		}
	}
	$output .="\n";
	 
	// Add all values in the table to $out.
	while ($row = db_fetch_array($result)) 
	{
		for ($i = 0; $i < $count_fields; $i++) 
		{
			
			if($i==0)
			{
				$val=$row["auctionID"];
			}
			elseif($i==1)
			{
				$val=$row["name"];
			}
			elseif($i==2)
			{
				$val=$row['auc_start_price'];
			}
			elseif($i==3)
			{
				$val=$row['auc_fixed_price'];	
			}
			elseif($i==4)
			{					
				if($row['auc_status']=="2" || $row['auc_status']=="1") 
				{
					if($row['pause_status']=="1")
					{
						$val = "Paused";	
					}
					else
					{
						$val = "Active";
					}
				}
				if($row['auc_status']=="3") { $val = "Sold"; }
				if($row['auc_status']=="4") { $val = "Pending"; }
				
			}
			elseif($i==5)
			{
				if($row['time_duration']=="none"){ $val = "Default"; }
				elseif($row['time_duration']=="10sa"){ $val = "10 Second"; }
				elseif($row['time_duration']=="15sa"){ $val = "15 Second"; }
				elseif($row['time_duration']=="20sa"){ $val = "20 Second"; }
			}
				
			$output .='"'.$val.'",';
			$val="";
		}
	
		$output .="\n";
	}
	 
	
	// Output the file to the local filesystem.  You could append a 
	// date to the filename to keep a record of the exports.
	 
	// Open a new output file
	$filenm='auctionwisereport.csv';
	$output_file='reports/auctionwisereport.csv';
	if(file_exists($output_file))
	{
		@unlink($output_file);
	}
	
	$file = fopen ($output_file,'w');
	// Put contents of $output into the $file
	fputs($file, $output);
	fclose($file);
			
}
elseif($_GET['export']=='financial')
{
	$startdate = ChangeDateFormat($_GET["sdate"]);
	$enddate = ChangeDateFormat($_GET["edate"]);
	$product = $_GET["prod"];
	
	$qrysel = "select * from auction a left join products p on a.productID=p.productID where a.auc_start_date>='$startdate' and a.auc_end_date<='$enddate' ";
	if($product!="")
	{
		$qrysel .= "and a.productID='$product' ";
	}
	// Must be a writeable location for file
	//$output_file="export.csv";
	 
	// The query to output to CSV
	$sql = $qrysel;
	// Support for multi-table select
	// $sql = "SELECT * FROM tbl2, tbl1 WHERE tbl1.col1 = tbl2.col2";
	 
	//---------------------------------------------------
	// Connect database
	//db_connect($host,$username,$password,$DATABASENAME);
	//db_select_db($database);
	 
	$result=db_query($sql);
	 
	$output = '';
	 
	// Get a list of all the fields in the table
	// $fields = db_list_fields($database,$table);
	// Count the number of fields
	$count_fields = 8; //db_num_fields($result);
	 
	// Put the name of all fields to $out.
	for ($i = 0; $i < $count_fields; $i++) 
	{
		if($i==0)
		{
			$output.= '"Auction ID",';
		}
		elseif($i==1)
		{
			$output.= '"Product Price",';
		}
		elseif($i==2)
		{
			$output.= '"Start Price",';
		}
		elseif($i==3)
		{
			$output.= '"Fixed Price",';
		}
		elseif($i==4)
		{
			$output.= '"End Price",';
		}
		elseif($i==5)
		{
			$output.= '"Total Bids",';
		}
		elseif($i==6)
		{
			$output.= '"Auction Status",';
		}
		elseif($i==7)
		{
			$output.= '"Profit/Loss",';
		}
		
	}
	$output .="\n";
	 
	// Add all values in the table to $out.
	while ($row = db_fetch_array($result)) 
	{
		for ($i = 0; $i < $count_fields; $i++) 
		{
			if($i==0)
			{
				$val=$row["auctionID"];
			}
			elseif($i==1)
			{
				$val=$Currency.$row['price'];
			}
			elseif($i==2)
			{
				$val=$row['auc_start_price']!=""?$Currency.$row['auc_start_price']:$Currency."0.00";
			}
			elseif($i==3)
			{
				$val=$row['auc_fixed_price']!=""?$Currency.$row['auc_fixed_price']:$Currency."0.00";
			}
			elseif($i==4)
			{
				$val=$row['auc_final_price']!=""?$Currency.$row['auc_final_price']:$Currency."0.00";
			}
			elseif($i==5)
			{
				$bidamount = number_format($row['totalbids'] * 0.50,2);
				$val=$bidamount!=""?$Currency.$bidamount:$Currency."0.00";
			}
			elseif($i==6)
			{
				if($row['auc_status']=="2" || $row['auc_status']=="1") { $val = "Active"; }
				elseif($row['auc_status']=="4") { $val = "Pending"; }
				elseif($row['auc_status']=="3") { $val = "Sold"; }
			}
			elseif($i==7)
			{
				$price = $row['price'];
				$bidamount = number_format($row['totalbids'] * 0.50,2);
				if($row['fixedpriceauction']=="1") { $fprice = $row['auc_fixed_price']; }
				else { $fprice = $row['auc_final_price']; }
				
				$prloss = $fprice + $bidamount - $price;
				if($prloss<0)
				{
					$val = "-".$Currency.number_format(substr($prloss,1),2);
				}
				else
				{
					$val = $Currency.$prloss;
				}
			}
				
			$output .='"'.$val.'",';
			$val="";
		}
	
		$output .="\n";
	}
	 
	
	// Output the file to the local filesystem.  You could append a 
	// date to the filename to keep a record of the exports.
	 
	// Open a new output file
	$filenm='financialreport.csv';
	$output_file='reports/financialreport.csv';
	if(file_exists($output_file))
	{
		@unlink($output_file);
	}
	
	$file = fopen ($output_file,'w');
	// Put contents of $output into the $file
	fputs($file, $output);
	fclose($file);
			
}
elseif($_GET['export']=='affiliate')
{

	$startdate = ChangeDateFormat($_GET["datefrom"]);
	$enddate = ChangeDateFormat($_GET["dateto"]);
	
	$qrysel = "select  *, DATE_FORMAT(buy_date,  '%Y-%m-%d') as newdate
from affiliate_transaction at left join registration r on at.user_id=r.id where at.buy_date>='$startdate' and at.buy_date<='$enddate' and at.trans_status='c'";
	
	// Must be a writeable location for file
	//$output_file="export.csv";
	 
	// The query to output to CSV
	$sql = $qrysel;
	// Support for multi-table select
	// $sql = "SELECT * FROM tbl2, tbl1 WHERE tbl1.col1 = tbl2.col2";
	 
	//---------------------------------------------------
	// Connect database
	//db_connect($host,$username,$password,$DATABASENAME);
	//db_select_db($database);
	 
	$result=db_query($sql);
	 
	$output = '';
	 
	// Get a list of all the fields in the table
	// $fields = db_list_fields($database,$table);
	// Count the number of fields
	$count_fields = 5; //db_num_fields($result);
	 
	// Put the name of all fields to $out.
	for ($i = 0; $i < $count_fields; $i++) 
	{
		if($i==0)
		{
			$output.= '"No.",';
		}
		elseif($i==1)
		{
			$output.= '"Date",';
		}
		elseif($i==2)
		{
			$output.= '"User Name",';
		}
		elseif($i==3)
		{
			$output.= '"Referer Name",';
		}
		elseif($i==4)
		{
			$output.= '"Bonus Commission",';
		}
		
	}
	$output .="\n";
	 
	// Add all values in the table to $out.
	$rowno=1;
	while ($row = db_fetch_array($result)) 
	{
		for ($i = 0; $i < $count_fields; $i++) 
		{
			if($i==0)
			{
				$val=$rowno;
			}
			elseif($i==1)
			{
				$val=arrangedate($row['newdate'],8,2);
			}
			elseif($i==2)
			{
				$qr = "select * from registration where id='".$row['referer_id']."'";
				$rs = db_query($qr);
				$ob = db_fetch_array($rs);
				$val=$ob['username'];
			}
			elseif($i==3)
			{
				$val=$row['username'];
			}
			elseif($i==4)
			{
				$val=$row['commission'];
			}
				
			$output .='"'.$val.'",';
			$val="";
		}
		$rowno++;
		
		$output .="\n";
	}
	 
	
	// Output the file to the local filesystem.  You could append a 
	// date to the filename to keep a record of the exports.
	 
	// Open a new output file
	$filenm='affiliatereport.csv';
	$output_file='reports/affiliatereport.csv';
	if(file_exists($output_file))
	{
		@unlink($output_file);
	}
	
	$file = fopen ($output_file,'w');
	// Put contents of $output into the $file
	fputs($file, $output);
	fclose($file);
}

elseif($_GET['export']=='perhour')
{
	$startdate = ChangeDateFormat($_GET["sdate"]);
	$enddate = ChangeDateFormat($_GET["edate"]);
	$starttime = $_GET["stime"];
	$endtime = $_GET["etime"];
	
	
	$qrysel = "SELECT *,DATE_FORMAT(login_time, '%Y-%m-%d')  AS logindate,DATE_FORMAT(logout_time, '%Y-%m-%d') as logoutdate 
FROM login_logout la left join registration r on la.user_id=r.id where login_time>='$startdate $starttime' and logout_time<='$enddate $endtime' and user_id!='0' group by user_id";

	if($_REQUEST["recfrom"]>=0 && $_REQUEST["recto"]>0)
	{
		$qrysel .= " limit ".$_REQUEST["recfrom"].",".($_REQUEST["recto"] - $_REQUEST["recfrom"]);
	}
	elseif($_REQUEST["recfrom"]>0 && $_REQUEST["recto"]==0)
	{
		$qrysel .= " limit ".$_REQUEST["recfrom"];
	}
	
	$sql = $qrysel;
	$result=db_query($sql);
	$totalrows = db_num_rows($result);
	 
	$output = '';
	 
	$count_fields = 4; //db_num_fields($result);
	 
	for ($i = 0; $i < $count_fields; $i++) 
	{
		if($i==0)
		{
			$output.= '"UserID",';
		}
		elseif($i==1)
		{
			$output.= '"User Name",';
		}
		elseif($i==2)
		{
			$output.= '"Total Login/Logout",';
		}
		elseif($i==3)
		{
			$output.= '"Average Duration",';
		}
	}
	$output .="\n";
	 
	$rowno=1;
	while ($row = db_fetch_object($result)) 
	{
		for ($i = 0; $i < $count_fields; $i++) 
		{
			if($i==0)
			{
				$val=$row->user_id;
			}
			elseif($i==1)
			{
				$val=$row->username;
			}
			elseif($i==2)
			{
				$time = explode("|",getTotalTimeLogin1($row->user_id,$startdate." ".$starttime,$enddate." ".$endtime));
				$finalusertime = $time[1]/$time[0];
				$allusertime = $finalusertime + $finalusertimeplus;
				$finalusertimeplus = $allusertime;
				$val = $time[0];
			}
			elseif($i==3)
			{
				$val=calc_counter_from_time_php($finalusertime);
			}
				
			$output .='"'.$val.'",';
			$val="";
		}
		$output .="\n";
		if($rowno==$totalrows)
		{
			$val="";
			$output .='"'.$val.'",';
			$val="";
			$output .='"'.$val.'",';
			$val="All users average login/logout";
			$output .='"'.$val.'",';
			$val=calc_counter_from_time_php($allusertime/$totalrows);
			$output .='"'.$val.'",';
		}
		$rowno++;
	}
	$filenm='perhourreport.csv';
	$output_file='reports/perhourreport.csv';
	if(file_exists($output_file))
	{
		@unlink($output_file);
	}
	
	$file = fopen ($output_file,'w');
	fputs($file, $output);
	fclose($file);
}

elseif($_GET['export']=='order')
{
	$startdate = ChangeDateFormat($_GET["sdate"]);
	$enddate = ChangeDateFormat($_GET["edate"]);
	$status = $_GET["st"];
	
	
		$qrysel = "select *,r.id as regiid from won_auctions wa left join auction a on wa.auction_id=a.auctionID left join products p on a.productID=p.productID left join registration r on r.id=a.buy_user where auc_final_end_date>='$startdate 00:00:01' and auc_final_end_date<='$enddate 23:59:59' and wa.payment_date!='0000-00-00 00:00:00' ";
		if($status!="")
		{
			$qrysel .= " and order_status='".$status."' ";
		}

	if($_REQUEST["recfrom"]>=0 && $_REQUEST["recto"]>0)
	{
		$qrysel .= " limit ".$_REQUEST["recfrom"].",".($_REQUEST["recto"] - $_REQUEST["recfrom"]);
	}
	elseif($_REQUEST["recfrom"]>0 && $_REQUEST["recto"]==0)
	{
		$qrysel .= " limit ".$_REQUEST["recfrom"];
	}
	
	$sql = $qrysel;
	$result=db_query($sql);
	 
	$output = '';
	 
	$count_fields = 7; //db_num_fields($result);
	 
	for ($i = 0; $i < $count_fields; $i++) 
	{
		if($i==0)
		{
			$output.= '"AuctionID",';
		}
		elseif($i==1)
		{
			$output.= '"Name",';
		}
		elseif($i==2)
		{
			$output.= '"Username",';
		}
		elseif($i==3)
		{
			$output.= '"Product Name",';
		}
		elseif($i==4)
		{
			$output.= '"Win Price",';
		}
		elseif($i==5)
		{
			$output.= '"Payment Date",';
		}
		elseif($i==6)
		{
			$output.= '"Order Status",';
		}
	}
	$output .="\n";
	 
	$rowno=1;
	while ($row = db_fetch_object($result)) 
	{
		for ($i = 0; $i < $count_fields; $i++) 
		{
			if($i==0)
			{
				$val=$row->auctionID;
			}
			elseif($i==1)
			{
				$val=$row->firstname." ".$row->lastname;
			}
			elseif($i==2)
			{
				$val = $row->username;
			}
			elseif($i==3)
			{
				$val=$row->name;
			}
			elseif($i==4)
			{
				$val=$Currency.$row->auc_final_price;
			}
			elseif($i==5)
			{
				$paydate = explode(" ",$row->payment_date);
				$val=arrangedate($paydate[0])." ".$paydate[1];
			}
			elseif($i==6)
			{
				if($row->order_status=="0"){ $orderstatus = "Undelivered"; }
				else { $orderstatus = "Delivered"; }
			
				$val=$orderstatus;
			}
			$output .='"'.$val.'",';
			$val="";
		}
		$rowno++;
		
		$output .="\n";
	}
	 
	$filenm='orderreport.csv';
	$output_file='reports/orderreport.csv';
	if(file_exists($output_file))
	{
		@unlink($output_file);
	}
	
	$file = fopen ($output_file,'w');
	fputs($file, $output);
	fclose($file);
}

elseif($_GET['export']=='regreport')
{
	$startdate = ChangeDateFormat($_GET["sdate"]);
	$enddate = ChangeDateFormat($_GET["edate"]);
	
		$qrysel = "select *,id as rid from registration where registration_date>='".$startdate."' and registration_date<='".$enddate."' order by id";	

	if($_REQUEST["recfrom"]>=0 && $_REQUEST["recto"]>0)
	{
		$qrysel .= " limit ".$_REQUEST["recfrom"].",".($_REQUEST["recto"] - $_REQUEST["recfrom"]);
	}
	elseif($_REQUEST["recfrom"]>0 && $_REQUEST["recto"]==0)
	{
		$qrysel .= " limit ".$_REQUEST["recfrom"];
	}
	
	$sql = $qrysel;
	$result=db_query($sql);
	 
	$output = '';
	 
	$count_fields = 7; //db_num_fields($result);
	 
	for ($i = 0; $i < $count_fields; $i++) 
	{
		if($i==0)
		{
			$output.= '"UserID",';
		}
		elseif($i==1)
		{
			$output.= '"Username",';
		}
		elseif($i==2)
		{
			$output.= '"Name",';
		}
		elseif($i==3)
		{
			$output.= '"Email",';
		}
		elseif($i==4)
		{
			$output.= '"Referred By",';
		}
		elseif($i==5)
		{
			$output.= '"Registration Date",';
		}
		elseif($i==6)
		{
			$output.= '"Status",';
		}
	}
	$output .="\n";
	 
	$rowno=1;
	while ($row = db_fetch_object($result)) 
	{
			if($row->sponser>"0")
			{
				$qreg = "select * from registration where id='".$row->sponser."'";
				$rseg = db_query($qreg);
				$objreg=db_fetch_object($rseg);
				$refuname = $objreg->username;
			}

			$qr = "select * from bid_account where user_id='".$row->rid."' and bid_flag='c'";
			$rs = db_query($qr);
			$totalbid = db_num_rows($rs);

			if($totalbid>0){ $status1 = "Active"; }
			else{ $status1 = "Not Active";	}

		for ($i = 0; $i < $count_fields; $i++) 
		{
			if($i==0)
			{
				$val=$row->rid;
			}
			elseif($i==1)
			{
				$val = $row->username;
			}
			elseif($i==2)
			{
				$val=$row->firstname." ".$row->lastname;
			}
			elseif($i==3)
			{
				$val=$row->email;
			}
			elseif($i==4)
			{
				if($refuname!="") { $val = $refuname; }
				else { $val = "-"; }
			}
			elseif($i==5)
			{
				$val=arrangedate($row->registration_date);
			}
			elseif($i==6)
			{
				$val=$status1;
			}
			$output .='"'.$val.'",';
			$val="";
		}
		$rowno++;
		
		$output .="\n";
		$totalbid = "";
		$refuname = "";
	}
	 
	$filenm='registrationreport.csv';
	$output_file='reports/registrationreport.csv';
	if(file_exists($output_file))
	{
		@unlink($output_file);
	}
	
	$file = fopen ($output_file,'w');
	fputs($file, $output);
	fclose($file);
}
elseif($_GET['export']=='musers')
{
		if($_POST['memstatus']!="")
		{
			if($_POST['memstatus']=="0" || $_POST['memstatus']=="1" || $_POST['memstatus']=="2")
			{
				$addquery = " and account_status='".$_POST['memstatus']."' ";
			}
			elseif($_POST['memstatus']=="d")
			{
				$addquery = " and member_status='1' ";
			}
		$memstatus = $_POST['memstatus'];	
		}
		if($_REQUEST["stext"]!="")
		{
			$searchdata = $_REQUEST["stext"];
			$addquery2 = "and (username like '%".$searchdata."%' or firstname like '%".$searchdata."%' or lastname like '%".$searchdata."%')";
		}

		$qrysel="select * from registration where user_delete_flag!='d' ".$addquery.$addquery2." order by id";
	
	if($_REQUEST["recfrom"]>0 && $_REQUEST["recto"]>0)
	{
		$qrysel .= " limit ".$_REQUEST["recfrom"].",".($_REQUEST["recto"] - $_REQUEST["recfrom"]);
	}
	elseif($_REQUEST["recfrom"]>0 && $_REQUEST["recto"]==0)
	{
		$qrysel .= " limit ".$_REQUEST["recfrom"];
	}
	// Must be a writeable location for file
	//$output_file="export.csv";
	 
	// The query to output to CSV
	$sql = $qrysel;
	// Support for multi-table select
	// $sql = "SELECT * FROM tbl2, tbl1 WHERE tbl1.col1 = tbl2.col2";
	 
	//---------------------------------------------------
	// Connect database
	//db_connect($host,$username,$password,$DATABASENAME);
	//db_select_db($database);
	 
	$result=db_query($sql);
	 
	$output = '';
	 
	// Get a list of all the fields in the table
	// $fields = db_list_fields($database,$table);
	// Count the number of fields
	$count_fields = 5; //db_num_fields($result);
	 
	// Put the name of all fields to $out.
	for ($i = 0; $i < $count_fields; $i++) 
	{
		if($i==0)
		{
			$output.= '"No.",';
		}
		elseif($i==1)
		{
			$output.= '"First Name",';
		}
		elseif($i==2)
		{
			$output.= '"Last Name",';
		}
		elseif($i==3)
		{
			$output.= '"Email Address",';
		}
		elseif($i==4)
		{
			$output.= '"IP Address",';
		}
		
	}
	$output .="\n";
	 
	// Add all values in the table to $out.
	$rowno=1;
	while ($row = db_fetch_array($result)) 
	{
		for ($i = 0; $i < $count_fields; $i++) 
		{
			if($i==0)
			{
				$val=$rowno;
			}
			elseif($i==1)
			{
				$val=$row["firstname"];
			}
			elseif($i==2)
			{
				$val=$row['lastname'];
			}
			elseif($i==3)
			{
				$val=$row['email'];
			}
			elseif($i==4)
			{
				$val=$row['registration_ip'];
			}
				
			$output .='"'.$val.'",';
			$val="";
		}
		$rowno++;
		
		$output .="\n";
	}
	// Output the file to the local filesystem.  You could append a 
	// date to the filename to keep a record of the exports.
	 
	// Open a new output file
	$filenm='memberdetails.csv';
	$output_file='reports/memberdetails.csv';
	if(file_exists($output_file))
	{
		@unlink($output_file);
	}
	
	$file = fopen ($output_file,'w');
	// Put contents of $output into the $file
	fputs($file, $output);
	fclose($file);
}

$file= $filenm;
$mime = 'application/octet-stream';
$folder='reports';

header('Content-type: $mime');
// Internet Explorer support 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
// It will be called downloaded
header("Content-Disposition: attachment; filename=$file");
header('Content-Length: '.filesize($folder.'/'.$file));
header("Pragma: no-cache");
header("Expires: 0");
// The source is in original
readfile($folder.'/'.$file);
?>