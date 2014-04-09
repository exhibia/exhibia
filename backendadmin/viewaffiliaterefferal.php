<?
include("connect.php");
$PRODUCTSPERPAGE=10;
include("security.php");
include('../functions.php');
include('../sendmail.php');

$uid = $_REQUEST['uid'];

if(!$_GET['pgno'])
{
	$PageNo = 1;
}
else
{
	$PageNo = $_GET['pgno'];
}

$qryname = "select username from registration where id='".$uid."'";
$resname = db_query($qryname);
$objname = db_fetch_object($resname);

$qrysel = "select * from registration where sponser=$uid order by id desc";
$result = db_query($qrysel);
$total = db_num_rows($result);
$totalpage=ceil($total/$PRODUCTSPERPAGE);
if($totalpage>=1)
{
$startrow=$PRODUCTSPERPAGE*($PageNo-1);
$qrysel.=" LIMIT $startrow,$PRODUCTSPERPAGE";
//echo $sql;
$result=db_query($qrysel);
$total=db_num_rows($result);
}

if(!$_GET['pgNo'])
{
	$PageNo1 = 1;
}
else
{
	$PageNo1 = $_GET['pgNo'];
}
$qrysel1 = "select * from affiliate_transaction where user_id=$uid order by buy_date desc";
$result1 = db_query($qrysel1);
$total1 = db_num_rows($result1);
$totalpage1=ceil($total1/$PRODUCTSPERPAGE);
if($totalpage>=1)
{
$startrow1=$PRODUCTSPERPAGE*($PageNo1-1);
$qrysel1.=" LIMIT $startrow1,$PRODUCTSPERPAGE";
//echo $sql;
$result1=db_query($qrysel1);
$total1=db_num_rows($result1);
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo $ADMIN_MAIN_SITE_NAME." - Manage Members"; ?></title>
<script language="JavaScript">
	
	function delconfirm(loc)
	{
		if(confirm("Are you sure to delete this member?"))
		{
			window.location.href=loc;
		}
		return false;
	}
function Submitform()
{
	document.form3.submit();
}	
</script>
<link href="main.css" type="text/css" rel="stylesheet">
</head>

<body bgcolor="#ffffff" style="padding-left:10px">
<TABLE cellSpacing=10 cellPadding=0  border=0 width="100%">
		<TR>
			<TD class=H1>Affiliate List - <?=$objname->username;?></TD>
		</TR>
		<TR>
			<TD background="images/vdots.gif"><IMG height=1 
			  src="images/spacer.gif" width=1 border=0></TD>
		</TR>
<Tr>
<td>

<!--<FORM id="form1" name="form1" action="viewaffiliaterefferal.php" method="post">
      <TABLE cellSpacing=0 cellPadding=1 border=0 >
        <TBODY>
        <TR>
          <TD><a class=la href="viewaffiliaterefferal.php">All</a></TD>
          <TD class=lg>|</TD>
                
          <TD><a class=la href="viewaffiliaterefferal.php?order=A">A</a></TD>
          <TD class=lg>|</TD>
          <TD><a class=la href="viewaffiliaterefferal.php?order=B">B</a></TD>
          <TD class=lg>|</TD>
          <TD><a class=la href="viewaffiliaterefferal.php?order=C">C</a></TD>
          <TD class=lg>|</TD>
          <TD><a class=la href="viewaffiliaterefferal.php?order=D">D</a></TD>
          <TD class=lg>|</TD>
          <TD><a class=la href="viewaffiliaterefferal.php?order=E">E</a></TD>
          <TD class=lg>|</TD>
          <TD><A class=la href="viewaffiliaterefferal.php?order=F">F</A></TD>
          <TD class=lg>|</TD>
          <TD><A class=la href="viewaffiliaterefferal.php?order=G">G</A></TD>
          <TD class=lg>|</TD>
          <TD><A class=la href="viewaffiliaterefferal.php?order=H">H</A></TD>
          <TD class=lg>|</TD>
          <TD><A class=la href="viewaffiliaterefferal.php?order=I">I</A></TD>
          <TD class=lg>|</TD>
          <TD><A class=la href="viewaffiliaterefferal.php?order=J">J</A></TD>
          <TD class=lg>|</TD>
          <TD><A class=la href="viewaffiliaterefferal.php?order=K">K</A></TD>
          <TD class=lg>|</TD>
          <TD><A class=la href="viewaffiliaterefferal.php?order=L">L</A></TD>
          <TD class=lg>|</TD>
          <TD><A class=la href="viewaffiliaterefferal.php?order=M">M</A></TD>
          <TD class=lg>|</TD>
          <TD><A class=la href="viewaffiliaterefferal.php?order=N">N</A></TD>
          <TD class=lg>|</TD>
          <TD><A class=la href="viewaffiliaterefferal.php?order=O">O</A></TD>
          <TD class=lg>|</TD>
          <TD><A class=la href="viewaffiliaterefferal.php?order=P">P</A></TD>
          <TD class=lg>|</TD>
          <TD><A class=la href="viewaffiliaterefferal.php?order=Q">Q</A></TD>
          <TD class=lg>|</TD>
          <TD><A class=la href="viewaffiliaterefferal.php?order=R">R</A></TD>
          <TD class=lg>|</TD>
          <TD><A class=la href="viewaffiliaterefferal.php?order=S\">S</A></TD>
          <TD class=lg>|</TD>
          <TD><A class=la href="viewaffiliaterefferal.php?order=T">T</A></TD>
          <TD class=lg>|</TD>
          <TD><A class=la href="viewaffiliaterefferal.php?order=U">U</A></TD>
          <TD class=lg>|</TD>
          <TD><A class=la href="viewaffiliaterefferal.php?order=V">V</A></TD>
          <TD class=lg>|</TD>
          <TD><A class=la href="viewaffiliaterefferal.php?order=W">W</A></TD>
          <TD class=lg>|</TD>
          <TD><A class=la href="viewaffiliaterefferal.php?order=X">X</A></TD>
          <TD class=lg>|</TD>
          <TD><A class=la href="viewaffiliaterefferal.php?order=Y">Y</A></TD>
          <TD class=lg>|</TD>
          <TD><A class=la href="viewaffiliaterefferal.php?order=Z">Z</A></TD></TR></TBODY></TABLE>
			</form>-->
<!--<table cellpadding="0" cellspacing="0" width="100%" border="0">
	  <tr>
	  	<td>
			<form name="form3" id="form3" action="" method="post">
			<table border="0" cellpadding="0"  cellspacing="0" width="100%">
				<tr>
					<td><b>Member Status :</b>
					<select name="memstatus" onchange="Submitform();">
					<option value="" <?php //if($memstatus==""){?> selected="selected"<?php //} ?>>All</option>
					<option value="2" <?php //if($memstatus=="2"){?> selected="selected"<?// } ?>>Unsubscribed</option>
					<option value="0" <?php //if($memstatus=="0"){?>selected="selected"<?php //}// ?>>Unverified</option>
					<option value="1" <?php // if($memstatus=="1"){?>selected="selected"<?php //} ?>>Active</option>
					<option value="d" <?php // if($memstatus=="d"){?>selected="selected"<?php //} ?>>Suspended</option>
					</select>
					</td>
				</tr>
			</table>
			</form>
		</td>
	  </tr>	
</table>	-->	

<table border="0" cellspacing="0" cellpadding="0">
<tr>
	<td>&nbsp;</td>
</tr>
<tr>
	<td><b><u>My Refferals:</u></b></td>
</tr>
</table>
			 <?php if(!$total){?>
		<table width="95%" border="0" cellspacing="1" cellpadding="1" align="center" bgcolor="#000000">
        <tr> 
          <td > 
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td class=th-a > 
                  <div align="center">No Refferal To Display</div>
                </td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
      <?php }else{?>
<form id="form2" name="form2" action="" method="post">	  
<TABLE width="95%" border="1" cellSpacing="0" class="t-a" align="center">
              <TR class="th-a"> 
			  	<TD width="20%" nowrap="nowrap">User Name</TD>
				<TD width="30%" nowrap="nowrap">Name</TD>
				<td width="25%" nowrap="nowrap">Email</td>
				<TD width="10%" nowrap="nowrap">Joining Date</TD>
				<TD width="10%" nowrap="nowrap">Status</TD>
              </TR>
              <?php
			  $colorflg=0;
			  for($i=0;$i<$total;$i++)
			  {
				$row = db_fetch_object($result);
				$id=$row->id;
				$fname = stripslashes($row->firstname);
				$lname = stripslashes($row->lastname);
				$city=$row->city;
				$member_status = $row->member_status;
				$account_status = $row->account_status;
				$country=$row->country;
					$qrycou = "select * from countries";
					$rescou = db_query($qrycou);
					while($cou=db_fetch_array($rescou))
					{
						if($country==$cou["countryId"])
						{
							$country = $cou["printable_name"];
						}					
					}
				$date = substr($row->registration_date,0,10);
				if($date!="0000-00-00")
				{
					$dateval = arrangedate($date);
				}
				else
				{
					$dateval = "----------";
				}
				$email=stripslashes($row->email);
				$username=stripslashes($row->username);
				
				if ($colorflg==1){
					$colorflg=0;
					$colorid = "#F2F6FD";
					echo "<TR bgcolor=\"#F2F6FD\"> ";
				}else{
					$colorflg=1;
					$colorid = "#FFFFFF";
				  	echo "<TR> ";
				}?>
                <TD align="left" valign="middle"><?=$username."&nbsp;"; ?></TD>
				<TD align="left" valign="middle"><?=$fname."&nbsp;".$lname; ?></TD>
				<TD align="left" valign="middle"><?=$email."&nbsp;"; ?></TD>
				<TD align="left" valign="middle"><?=$dateval;?></TD>
				<TD align="center" valign="middle"><?php if($member_status==0 && $account_status==1){ echo "<font color='green'>Enable</font>";} elseif($member_status==0 && $account_status==2){ echo "<font color='red'>Closed</font>"; }elseif($member_status==1){ echo "<font color='red'>Disable</font>";} elseif($member_status==0 && $account_status==0){ echo "<font color='green'>Enable</font>"; } ?></TD>
              </TR>
              <?
			  	$sponsername = '';
			  }
			  ?>
              
          </TABLE>
		  </form>
		  <?php } ?>
		  <!-- paging starts -->
		   <?php
		if($PageNo>1)
		{
                  $PrevPageNo = $PageNo-1;

	    ?>
	  <A class=paging href="viewaffiliaterefferal.php?pgno=<?=$PrevPageNo; ?>&order=<?=$order?>&uid=<?=$uid?>">&lt; Previous Page</A>
	  <?
	   }
	  ?> &nbsp;&nbsp;&nbsp;
	  <?php
        if($PageNo<$totalpage)
        {
         $NextPageNo = 	$PageNo + 1;
      ?>
	  <A class=paging id=next href="viewaffiliaterefferal.php?pgno=<?=$NextPageNo;?>&order=<?=$order?>&uid=<?=$uid?>">Next Page &gt;</A>
	  <?
       }
      ?>
		  <!-- paging ends -->
<table border="0" cellspacing="0" cellpadding="0">
<tr>
	<td>&nbsp;</td>
</tr>
<tr>
	<td><b><u>Affiliate Transactions:</u></b></td>
</tr>
</table>		  
	   <?php if(!$total1){?>
		<table width="95%" border="0" cellspacing="1" cellpadding="1" align="center" bgcolor="#000000">
        <tr> 
          <td > 
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td class=th-a > 
                  <div align="center">No affiliate transaction to display</div>
                </td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
      <?php }else{?>
<form id="form2" name="form2" action="" method="post">	  
<TABLE width="95%" border="1" cellSpacing="0" class="t-a" align="center">
              <TR class="th-a"> 
			  	<TD width="20%" nowrap="nowrap">Date</TD>
				<TD width="30%" nowrap="nowrap">Title</TD>
				<td width="25%" nowrap="nowrap">User</td>
				<TD width="10%" align="right" nowrap="nowrap">Price</TD>
				<TD width="10%" align="right" nowrap="nowrap">Commission</TD>
              </TR>
              <?php
			  $colorflg=0;
			  for($i=0;$i<$total1;$i++)
			  {
				$row1 = db_fetch_object($result1);
				$id=$row1->id;
				$date1 = substr($row1->buy_date,0,10);
				if($date1!="0000-00-00")
				{
					$dateval1 = arrangedate($date1);
				}
				else
				{
					$dateval1 = "----------";
				}
				
				$regref = "select username from registration where id='".$row1->referer_id."'";
				$regres = db_query($regref);
				$regtotal = db_num_rows($regres);
				if($regtotal>0)
				{
					$regrow = db_fetch_array($regres);
					$username = $regrow['username'];
				}	
				else
				{
					$username = "";
				}
				
				if ($colorflg==1){
					$colorflg=0;
					$colorid = "#F2F6FD";
					echo "<TR bgcolor=\"#F2F6FD\"> ";
				}else{
					$colorflg=1;
					$colorid = "#FFFFFF";
				  	echo "<TR> ";
				}?>
                <TD align="left" valign="middle"><?=$dateval1;?></TD>
				<TD align="left" valign="middle"><?=$row1->bid_pack_title;?></TD>
				<TD align="left" valign="middle"><?=$username; ?></TD>
				<TD align="right" valign="middle"><?=$Currency;?><?=$row1->amount==0.00?"0.00":$row1->amount;?></TD>
				<TD align="right" valign="middle"><b><?php if($row1->trans_status=="D"){ echo "<font style='color:Red'>-"; }else{ echo "<font style='color:Green'>+"; }?><?=$Currency;?><?=$row1->commission==0.00?"0.00":$row1->commission;?></b></TD>
              </TR>
              <?
			  	$sponsername = '';
			  }
			  ?>
              
          </TABLE>
		  <?
		  $grandtotalvar = explode("|",GetGrandTotal($uid)); 
	      $grandtotalamt = $grandtotalvar[0];
	      $grandtotalcommission = $grandtotalvar[1];
		  ?>
		  <table border="0" width="100%" cellpadding="0" cellspacing="0">
		  <tr>
		  	<td width="90%" align="right"><b>Available Balance:</b></td>
			<td width="9%" align="right"><font style='color:Green'><b>+<?=$Currency.number_format($grandtotalcommission,2);?></b></font></td>
			<td width="1%" align="right">&nbsp;</td>
		  </tr>
		  </table>
		  </form>
		  <?php } ?>
		  <!-- paging starts -->
		   <?php
		if($PageNo1>1)
		{
                  $PrevPageNo1 = $PageNo1-1;

	    ?>
	  <A class=paging href="viewaffiliaterefferal.php?pgNo=<?=$PrevPageNo1; ?>&order=<?=$order?>&uid=<?=$uid?>">&lt; Previous Page</A>
	  <?
	   }
	  ?> &nbsp;&nbsp;&nbsp;
	  <?php
        if($PageNo1<$totalpage1)
        {
         $NextPageNo1 = 	$PageNo1 + 1;
      ?>
	  <A class=paging id=next href="viewaffiliaterefferal.php?pgNo=<?=$NextPageNo1;?>&order=<?=$order?>&uid=<?=$uid?>">Next Page &gt;</A>
	  <?
       }
      ?> 	  
</TD></TR></TBODY></TABLE></body>
</html>
