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

			if($_POST["datefrom"]!="")
			{
				$startdate = ChangeDateFormat($_POST["datefrom"]);
				$enddate = ChangeDateFormat($_POST["dateto"]);
				$auctionstatus = $_POST["auctionstatus"];
			}

			else
			{
					$startdate = ChangeDateFormat($_GET["sdate"]);
					$enddate = ChangeDateFormat($_GET["edate"]);
					$auctionstatus = $_GET["stat"];
			}
			$urldata = "sdate=".ChangeDateFormatSlash($startdate)."&edate=".ChangeDateFormatSlash($enddate)."&stat=".$auctionstatus;

			$qrysel = "select * from auction a left join products p on a.productID=p.productID where a.auc_status='$auctionstatus' and  auc_start_date>='$startdate' and auc_end_date<='$enddate'";
		$ressel = db_query($qrysel);
		$total = db_num_rows($ressel);
		$totalpage=ceil($total/$PRODUCTSPERPAGE);

		if($totalpage>=1)
		{
			$startrow=$PRODUCTSPERPAGE*($PageNo-1);
			$qrysel.=" LIMIT $startrow,$PRODUCTSPERPAGE";
			//echo $sql;
			$ressel=db_query($qrysel);
			$total=db_num_rows($ressel);
		}
	}
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
<title><?php echo $ADMIN_MAIN_SITE_NAME." - Live Auction Report"; ?></title>
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

function PauseAuction(aucid)
{
	xmlHttp=GetXmlHttpObject();
	if (xmlHttp==null)
	  {
	  alert ("Your browser does not support AJAX!");
	  return;
	  } 
	var url="pauseauction.php";
	url=url+"?aucid="+aucid
	xmlHttp.onreadystatechange=changeStatus;
	xmlHttp.open("GET",url,true);
	xmlHttp.send(null);
}
function changeStatus()
{
	if (xmlHttp.readyState==4)
	{ 
		var temp=xmlHttp.responseText;
		redata = temp.split('|');
		if(redata[0]=="success")
		{
			document.getElementById('pause_' + redata[1]).style.display = 'none';
			document.getElementById('resume_' + redata[1]).style.display = 'block';
			document.getElementById('auctionstatus_' + redata[1]).style.color = 'green';
			document.getElementById('auctionstatus_' + redata[1]).innerHTML = 'Pause';
		}
	}
}
function StartAuction(aucid1)
{
	xmlHttp=GetXmlHttpObject();
	if (xmlHttp==null)
	  {
	  alert ("Your browser does not support AJAX!");
	  return;
	  } 
	var url="pauseauction.php";
	url=url+"?aucidstart="+aucid1
	xmlHttp.onreadystatechange=changeStatus1;
	xmlHttp.open("GET",url,true);
	xmlHttp.send(null);
}
function changeStatus1()
{
	if (xmlHttp.readyState==4)
	{ 
		var temp=xmlHttp.responseText;
		redata = temp.split('|');
		if(redata[0]=="success")
		{
			document.getElementById('pause_' + redata[1]).style.display = 'block';
			document.getElementById('resume_' + redata[1]).style.display = 'none';
			document.getElementById('auctionstatus_' + redata[1]).style.color = '#FF0000';
			document.getElementById('auctionstatus_' + redata[1]).innerHTML = 'Active';
		}
	}
}
</script>
</head>

<body>
<TABLE width="100%"  border=0 cellPadding=0 cellSpacing=10>
  <!--DWLayoutTable-->
    <TR> 
      <TD width="100%" class="H1">Live Auction Report</TD>
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
	<form action="" method="post" name="f1">	
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
		<td align="center">
			<b>Auction Status :&nbsp;</b>
			<select name="auctionstatus" class="solidinput">
				<option <?=$auctionstatus=="2"?"selected":"";?> value="2">Active</option>
			</select>
		</td>
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
							  <div align="center">No Auctions To Display.</div>
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
				<TD width="6%" align="left" nowrap="nowrap">AuctinoID</TD>
				<TD align="center" nowrap="nowrap">Image</TD>
				<TD width="50%" nowrap="nowrap" align="center">Name</TD>
				<TD nowrap="nowrap" align="left">Start Price</TD>
				<TD align="left" nowrap="nowrap">Current Price</TD>
				<TD nowrap="nowrap" align="left">Auction Status</TD>
				<TD width="4%" align="center" nowrap="nowrap">Option</TD>
			 </TR>
		<?
			while($obj = db_fetch_object($ressel))
			{
				if($obj->auc_status=="2") { $status = "<font color='red'>Active</font>"; }

				if ($colorflg==1){
					$colorflg=0;
					echo "<TR bgcolor=\"#f4f4f4\"> ";
				}else{
					$colorflg=1;
				  	echo "<TR> ";
				}
				
				$qr = "select * from bid_account where auction_id='".$obj->auctionID."'";
				$rs = db_query($qr);
				$ob = db_fetch_object($rs);
		?>
				<TD align="left" nowrap="nowrap"><?=$obj->auctionID;?></TD>
				<TD align="center" nowrap="nowrap"><img src="images/products/thumbs/thumb_<?=$obj->picture1;?>" /></TD>
				<TD nowrap="nowrap" align="center"><?=$obj->name;?></TD>
				<TD nowrap="nowrap" align="left"><?=$obj->auc_start_price;?></TD>
				<TD align="left" nowrap="nowrap"><?=$ob->bidding_price!=""?$ob->bidding_price:$obj->auc_start_price;?></TD>
				<TD nowrap="nowrap" align="left"><span id="auctionstatus_<?=$obj->auctionID;?>"><?=$status;?></span></TD>
				<TD width="21%" align="center" nowrap="nowrap">
				<?php if($obj->pause_status=="0"){ ?>
					<input type="button" id="pause_<?=$obj->auctionID;?>" name="pause" class="bttn" value="Pause" onclick="PauseAuction('<?=$obj->auctionID;?>');" />
					<input type="button" id="resume_<?=$obj->auctionID;?>" name="resume" class="bttn" value="Resume" onclick="StartAuction('<?=$obj->auctionID;?>');" style="display: none;" />
				<?php } else { ?>
					<input type="button" id="pause_<?=$obj->auctionID;?>" name="pause" class="bttn" value="Pause" onclick="PauseAuction('<?=$obj->auctionID;?>');" style="display: none;" />
					<input type="button" id="resume_<?=$obj->auctionID;?>" name="resume" class="bttn" value="Resume" onclick="StartAuction('<?=$obj->auctionID;?>');"/>
				<?php } ?>
				</TD>
			</tr>
		<?
			}
		?>		
		 </TABLE>
		  <?
			if($PageNo>1)
			{
			  $PrevPageNo = $PageNo-1;
		  ?>
		  <A class='paging' href="liveauctionreport.php?pgno=<?=$PrevPageNo;?>&<?=$urldata;?>">&lt; Previous Page</A>
		  <?
		   }
		  ?> &nbsp;&nbsp;&nbsp;
		  <?php
			if($PageNo<$totalpage)
			{
			 $NextPageNo = 	$PageNo + 1;
		  ?>
		  <A class='paging' id='next' href="liveauctionreport.php?pgno=<?=$NextPageNo;?>&<?=$urldata;?>">Next Page &gt;</A>
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
ifFormat:"%d/%m/%Y",
button:"vfrom",
showsTime:false 
});
</script>
<script type="text/javascript">
var cal = new Zapatec.Calendar.setup({ 
inputField:"dateto",
ifFormat:"%d/%m/%Y",
button:"zfrom",
showsTime:false 
});
</script>
</body>
</html>
