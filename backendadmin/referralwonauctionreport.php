<?
	include_once("admin.config.inc.php");
	include("connect.php");
	include("functions.php");
	include("security.php");
	$PRODUCTSPERPAGE = 10;
	
	if($_POST["submit"]!="" || $_GET["sdate"]!="")
	{
		if(!$_GET['pgno'])
		{
			$PageNo = 1;
		}
		else
		{
			$PageNo = $_GET['pgno'];
		}
		
		  if($_POST["submit"]!="")
		  {
			$startdate = ChangeDateFormat($_POST["datefrom"]);
			$enddate = ChangeDateFormat($_POST["dateto"]);
		  }
		  else
		  {
			$startdate = ChangeDateFormat($_GET["sdate"]);
			$enddate = ChangeDateFormat($_GET["edate"]);
		  }

		$urldata = "sdate=".ChangeDateFormatSlash($startdate)."&edate=".ChangeDateFormatSlash($enddate);

		$qrysel = "SELECT  * , DATE_FORMAT( wa.won_date,  '%Y-%m-%d'  )  AS newdate
FROM won_auctions wa left join auction a on wa.auction_id=a.auctionID left join products p on a.productID=p.productID where wa.won_date>='$startdate' and wa.won_date<='$enddate' and wa.referral_userid!=''";
		
		$qrysel2=$qrysel;
		$ressel = db_query($qrysel);
		$total = db_num_rows($ressel);
		$totalpage=ceil($total/$PRODUCTSPERPAGE);

		if($totalpage>=1)
		{
			$startrow=$PRODUCTSPERPAGE*($PageNo-1);
			$qrysel.=" LIMIT $startrow,$PRODUCTSPERPAGE";
			$ressel=db_query($qrysel);
			$total=db_num_rows($ressel);
		}
	}
	
	
	/*if($_POST['export'])
	{
		
		// Must be a writeable location for file
		//$output_file="export.csv";
		 
		// The query to output to CSV
		$sql = $qrysel2;
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
				$output.= '"Bonus Bid",';
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
					$val=$row['bid_count'];
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
		
		?>
		<script language="javascript">
			window.location.href="download.php?filenm=<?=base64_encode($filenm)?>&mime=<?=base64_encode('application/octet-stream')?>&foldername=<?=base64_encode('reports')?>";
		</script>
		<?				
	}*/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<META content="MSHTML 6.00.2600.0" name=GENERATOR>
<link rel="stylesheet" href="main.css" type="text/css">
<link href="zpcal/themes/aqua.css" rel="stylesheet" type="text/css" media="all" title="Calendar Theme - aqua.css" />
<script type="text/javascript" src="zpcal/src/utils.js"></script>
<script type="text/javascript" src="zpcal/src/calendar.js"></script>
<script type="text/javascript" src="zpcal/lang/calendar-en.js"></script>
<script type="text/javascript" src="zpcal/src/calendar-setup.js"></script>
<script language="javascript">
	function Check(f1)
	{	
		if(document.f1.datefrom.value=="")
		{
			alert("Please select start date!!!");
			return false;
			document.f1.datefrom.focus();
		}
		if(document.f1.dateto.value=="")
		{
			alert("Please select end date!!!");
			return false;
			document.f1.dateto.focus();
		}
	}
	function OpenPopup(url)
	{
		window.open(url,'popupWindow','toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=no,resizable=no,copyhistory=no,width=100,height=100,screenX=300,screenY=350,top=300,left=350');
		
	}
</script>
<title><?php echo $ADMIN_MAIN_SITE_NAME." - Referral Won Auction Report"; ?></title>
</head>
<body>
<TABLE width="100%"  border=0 cellPadding=0 cellSpacing=10>
  <!--DWLayoutTable-->
    <TR> 
      <TD width="100%" class="H1">Referral Won Auction Report</TD>
    </TR>
  	<TR>
    <TD background="images/vdots.gif"><IMG height=1 
      src="images/spacer.gif" width=1 border=0></TD>
	</TR>
	<tr>
		<td height="10"></td>
	</tr>
	<tr>
		<td height="5"></td>
	</tr>
	<tr>
		<td align="center" class="h2"><b>Please Select Date</b></td>
	</tr>
	<tr>
		<td height="5"></td>
	</tr>
	<form name="f1" action="" method="post" onSubmit="return Check(this)">	
	<tr>
		<td align="center"><b>From</b> : <input class="textbox" type="text" name="datefrom" id="datefrom" size="12" value="<?=$startdate!=""?ChangeDateFormatSlash($startdate):"";?>">&nbsp;&nbsp;<img src="images/pmscalendar.gif" align="absmiddle" width="20" height="20" id="vfrom">&nbsp;&nbsp;-&nbsp;&nbsp; <b>To</b> : <input class="textbox" type="text" name="dateto" size="12" id="dateto" value="<?=$enddate!=""?ChangeDateFormatSlash($enddate):"";?>">&nbsp;&nbsp;<img src="images/pmscalendar.gif" align="absmiddle" width="20" height="20" id="zfrom">&nbsp;&nbsp;</font></td>
	</tr>
	<tr>
		<td height="5"></td>
	</tr>
	<tr>
		<td height="5"></td>
	</tr>
	<tr>
		<td align="center"><input type="submit" name="submit" value="Search" class="bttn-s"></td>
	</tr>
	</form>
	<TR>
    	<TD><!--content-->
		<?php if(isset($total))
		{
			if($total==0)
			{
		?>
		<table width="70%" border="0" cellspacing="1" cellpadding="1" align="center"> 
		<tr>
			<td height="8"></td>
		</tr>
		<tr>
			<td>
				<table width="100%" border="0" cellspacing="1" cellpadding="1" align="center" bgcolor="#000000">
					<tr> 
					  <td> 
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
						  <tr> 
							<td class=th-a > 
							  <div align="center">No Referral Won Auctions To Display.</div>
							</td>
						  </tr>
						</table>
					  </td>
					</tr>
				</table>
			</td>
		</tr>			
      </table>
	 <?
	 	}
		else
		{
	?>
          <TABLE width="100%" border=1 cellSpacing=0 class=t-a>
            <!--DWLayoutTable-->
              <TR class=th-a> 
				<!--<TD nowrap width="5%">User Id</TD>-->
				<TD width="7%" align="left" nowrap="nowrap">No.</TD>
				<TD width="20%" nowrap="nowrap" align="center">Won Date</TD>
				<TD align="left" nowrap="nowrap">Auction Name</TD>
				<TD align="left" nowrap="nowrap">Winner Name</TD>
				<TD align="left" nowrap="nowrap">Referer Name</TD>
				<TD nowrap="nowrap" align="left">Amount</TD>
				<TD width="4%" align="center" nowrap="nowrap">Option</TD>
			 </TR>
		<?
			$i = 0;
			while($obj = db_fetch_object($ressel))
			{
				 if($PageNo>1)
				 {
					$srno = ($PageNo-1)*$PRODUCTSPERPAGE+$i+1;
				 }
				 else
				 {
					$srno = $i+1;
				 }
			
			
				if ($colorflg==1){
					$colorflg=0;
					echo "<TR bgcolor=\"#f4f4f4\"> ";
				}else{
					$colorflg=1;
				  	echo "<TR> ";
				}
				if($obj->fixedpriceauction=="1")
				{
					$amount = $obj->auc_fixed_price;
				}
				elseif($obj->offauction=="1")
				{
					$amount = "0.00";
				}
				else
				{
					$amount = $obj->auc_final_price;
				}
				$qr = "select * from registration where id='".$obj->referral_userid."'";
				$rs = db_query($qr);
				$ob = db_fetch_object($rs);
				
				$qr1 = "select * from registration where id='".$obj->userid."'";
				$rs1 = db_query($qr1);
				$ob1 = db_fetch_object($rs1);
		?>
				<TD align="left" nowrap="nowrap"><?=$srno;?></TD>
				<TD nowrap="nowrap" align="center"><?=arrangedate($obj->newdate,8,2);?></TD>
				<TD nowrap="nowrap" align="left"><?=$obj->name;?></TD>
				<TD nowrap="nowrap" align="left"><?=$ob->username;?></TD>
				<TD nowrap="nowrap" align="left"><?=$ob1->username;?></TD>
				<TD nowrap="nowrap" align="left"><?=$amount;?></TD>
				<TD width="21%" align="center" nowrap="nowrap">
					<input type="button" name="viewdetails" class="bttn" value="View Details" onClick="window.location.href='auctiondetails.php?aid=<?=$obj->auction_id;?>'" />
				</TD>
			</tr>
		<?
				$i++;
			}
		?>		
		 </TABLE>
		  <?
			if($PageNo>1)
			{
			  $PrevPageNo = $PageNo-1;
		  ?>
		  <A class='paging' href="referralwonauctionreport.php?pgno=<?=$PrevPageNo;?>&<?=$urldata;?>">&lt; Previous Page</A>
		  <?
		   }
		  ?> &nbsp;&nbsp;&nbsp;
		  <?php
			if($PageNo<$totalpage)
			{
			 $NextPageNo = 	$PageNo + 1;
		  ?>
		  <A class='paging' id='next' href="referralwonauctionreport.php?pgno=<?=$NextPageNo;?>&<?=$urldata;?>">Next Page &gt;</A>
		  <?
		   }
		  ?>
	<?
		
		}
	}
	 ?>
	 </TD>
	 </TR>	
	</TABLE>	 
<script type="text/javascript">
var cal = new Zapatec.Calendar.setup({ 
inputField:"datefrom",
ifFormat:"%m/%d/%Y",
button:"vfrom",
showsTime:false 
});
</script>
<script type="text/javascript">
var cal = new Zapatec.Calendar.setup({ 
inputField:"dateto",
ifFormat:"%m/%d/%Y",
button:"zfrom",
showsTime:false 
});
</script>
</body>
</html>
