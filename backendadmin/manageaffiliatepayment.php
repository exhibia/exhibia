<?
include("connect.php");
$PRODUCTSPERPAGE=20;
include("security.php");
include('../sendmail.php');

// calculation for order
		if($_REQUEST['order'])
		{
		$order=$_REQUEST['order'];
		}
//calculation for page no
		if(!$_GET['pgno'])
		{
			$PageNo = 1;
		}
		else
		{
			$PageNo = $_GET['pgno'];
		}

$userid =$_GET['payuser_id'];
$sql = "select * from affiliate_transaction aff left join registration r on aff.user_id=r.id group by user_id";
//$PRODUCTSPERPAGE=20;
$result=db_query($sql);
$total=db_num_rows($result);
$totalpage=ceil($total/$PRODUCTSPERPAGE);
//echo $totalpage;
if($totalpage>=1)
{
$startrow=$PRODUCTSPERPAGE*($PageNo-1);
$sql.=" LIMIT $startrow,$PRODUCTSPERPAGE";
//echo $sql;
$result=db_query($sql);
$total=db_num_rows($result);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo $ADMIN_MAIN_SITE_NAME." - Manage Members"; ?></title>

        <link type="text/css" href="css/cupertino/ui.all.css" rel="stylesheet" />
        <link type="text/css" href="css/cupertino/jquery-ui-1.7.3.custom.css" rel="stylesheet" />

        <!--[if lte IE 6]><link media="screen" rel="stylesheet" type="text/css" href="css/admin-ie.css" /><![endif]-->
        <script type="text/javascript" src="js/behaviour.js"></script>
        <script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
        <script type="text/javascript" src="js/ui/jquery-ui-1.7.2.custom.min.js"></script>
	
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
<script language="javascript">
function CheckForUser(f1)
{
	var TotalChk = f1.elements.length;
	var TotalColCount = f1.colorcounter.value;
	var TotalSizeCount = f1.sizecounter.value;
	var payment = 0;
	
	for(i=0;i<TotalChk;i++)
	{
	 	if (f1.elements[i].type == 'checkbox')
	 	{
			if(f1.elements[i].name=="payuser_id["+payment+"]")
			{
				ColChkCount = 0;
				for(j=0;j<TotalColCount;j++)
				{
					if(f1.elements[i+j].checked!=false)
					{
						//alert(f1.elements[i+j].checked);
						ColChkCount++;
					}
				}
				payment++;
				i=i+j;
			}
		}
		if(ColChkCount==0)
		{
			alert("Please Select atleast One User");
			return false;
		}
	}
	

}
</script>
<link href="main.css" type="text/css" rel="stylesheet">
</head>

<body bgcolor="#ffffff" style="padding-left:10px">
<TABLE cellSpacing=10 cellPadding=0  border=0 width="100%">
		<TR>
			<TD class=H1>Manage Affiliate User</TD>
		</TR>
		<TR>
			<TD background="images/vdots.gif"><IMG height=1 
			  src="images/spacer.gif" width=1 border=0></TD>
		</TR>
<Tr>
<td>

<FORM id="form1" name="form1" action="manageaffiliatepayment.php" method="post">
      <TABLE cellSpacing=0 cellPadding=1 border=0 >
        <TBODY>
        <TR>
          <TD><a class=la href="manageaffiliatepayment.php?">All</a></TD>
          <TD class=lg>|</TD>
                
          <TD><a class=la href="manageaffiliatepayment.php?order=A">A</a></TD>
          <TD class=lg>|</TD>
          <TD><a class=la href="manageaffiliatepayment.php?order=B">B</a></TD>
          <TD class=lg>|</TD>
          <TD><a class=la href="manageaffiliatepayment.php?order=C">C</a></TD>
          <TD class=lg>|</TD>
          <TD><a class=la href="manageaffiliatepayment.php?order=D">D</a></TD>
          <TD class=lg>|</TD>
          <TD><a class=la href="manageaffiliatepayment.php?order=E">E</a></TD>
          <TD class=lg>|</TD>
          <TD><A class=la href="manageaffiliatepayment.php?order=F">F</A></TD>
          <TD class=lg>|</TD>
          <TD><A class=la href="manageaffiliatepayment.php?order=G">G</A></TD>
          <TD class=lg>|</TD>
          <TD><A class=la href="manageaffiliatepayment.php?order=H">H</A></TD>
          <TD class=lg>|</TD>
          <TD><A class=la href="manageaffiliatepayment.php?order=I">I</A></TD>
          <TD class=lg>|</TD>
          <TD><A class=la href="manageaffiliatepayment.php?order=J">J</A></TD>
          <TD class=lg>|</TD>
          <TD><A class=la href="manageaffiliatepayment.php?order=K">K</A></TD>
          <TD class=lg>|</TD>
          <TD><A class=la href="manageaffiliatepayment.php?order=L">L</A></TD>
          <TD class=lg>|</TD>
          <TD><A class=la href="manageaffiliatepayment.php?order=M">M</A></TD>
          <TD class=lg>|</TD>
          <TD><A class=la href="manageaffiliatepayment.php?order=N">N</A></TD>
          <TD class=lg>|</TD>
          <TD><A class=la href="manageaffiliatepayment.php?order=O">O</A></TD>
          <TD class=lg>|</TD>
          <TD><A class=la href="manageaffiliatepayment.php?order=P">P</A></TD>
          <TD class=lg>|</TD>
          <TD><A class=la href="manageaffiliatepayment.php?order=Q">Q</A></TD>
          <TD class=lg>|</TD>
          <TD><A class=la href="manageaffiliatepayment.php?order=R">R</A></TD>
          <TD class=lg>|</TD>
          <TD><A class=la href="manageaffiliatepayment.php?order=S\">S</A></TD>
          <TD class=lg>|</TD>
          <TD><A class=la href="manageaffiliatepayment.php?order=T">T</A></TD>
          <TD class=lg>|</TD>
          <TD><A class=la href="manageaffiliatepayment.php?order=U">U</A></TD>
          <TD class=lg>|</TD>
          <TD><A class=la href="manageaffiliatepayment.php?order=V">V</A></TD>
          <TD class=lg>|</TD>
          <TD><A class=la href="manageaffiliatepayment.php?order=W">W</A></TD>
          <TD class=lg>|</TD>
          <TD><A class=la href="manageaffiliatepayment.php?order=X">X</A></TD>
          <TD class=lg>|</TD>
          <TD><A class=la href="manageaffiliatepayment.php?order=Y">Y</A></TD>
          <TD class=lg>|</TD>
          <TD><A class=la href="manageaffiliatepayment.php?order=Z">Z</A></TD></TR></TBODY></TABLE>
			</form>
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
			 <?php if(!$total){?>
		<table width="95%" border="0" cellspacing="1" cellpadding="1" align="center" bgcolor="#000000">
        <tr> 
          <td > 
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td class=th-a > 
                  <div align="center">No Members To Display</div>
                </td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
      <?php }else{?>
<form id="form2" name="form2" action="makepayment.php" method="post" onsubmit="return CheckForUser(this)">	  
<TABLE width="95%" border="1" cellSpacing="0" class="t-a" align="center">
              <TR class="th-a"> 
				 <TD width="5%" nowrap="nowrap">Payment</TD>
			  	<TD width="20%" nowrap="nowrap">User Name</TD>
				<TD width="30%" nowrap="nowrap">Name</TD>
				<td width="25%" nowrap="nowrap">Email</td>
				<TD width="10%" nowrap="nowrap">Status</TD>
				<TD width="10%" nowrap="nowrap">Refferals</TD>
				<TD width="15%" nowrap="nowrap">Options</TD>
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
				$qryreg = "select count(*) as total from registration where sponser='".$id."'";
				$resreg = db_query($qryreg);
				$objreg = db_fetch_object($resreg);
				$referralcount = $objreg->total;


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
				<TD align="left" valign="middle"><input type="checkbox" name="payuser_id[<?=$i;?>]" value="<?=$id;?>" style="border:none;" /></TD>
                <TD align="left" valign="middle"><?=$username."&nbsp;"; ?></TD>
				<TD align="left" valign="middle"><?=$fname."&nbsp;".$lname; ?></TD>
				<TD align="left" valign="middle"><?=$email."&nbsp;"; ?></TD>
				<TD align="left" valign="middle"><?php if($member_status==0 && $account_status==1){ echo "<font color='green'>Enable</font>";} elseif($member_status==0 && $account_status==2){ echo "<font color='red'>Closed</font>"; }elseif($member_status==1){ echo "<font color='red'>Disable</font>";} elseif($member_status==0 && $account_status==0){ echo "<font color='green'>Enable</font>"; } ?></TD>
				<TD align="center" valign="middle"><?=$referralcount>0?$referralcount:"--"; ?></TD>
                <TD noWrap width="32%" align="center" >
            <input name="afflist" type="button" class="bttn" value="View Affiliate List" onClick="window.location.href='viewaffiliaterefferal.php?uid=<?=$id;?>'">
                </TD>
              </TR>
              <?
			  	$sponsername = '';
				
			  }
			  ?>
              
          </TABLE>
		  <input name="Makepayemnt" type="submit" class="bttn" value="Make Payment">
		  <input type="hidden" name="colorcounter" value="<?=$i;?>">
		<input type="hidden" name="sizecounter" value="<?=$i;?>">
		  </form>
		  
		  <br />
		  <?php } ?>
		  <!-- paging starts -->
		   <?php
		if($PageNo>1)
		{
                  $PrevPageNo = $PageNo-1;

	    ?>
	  <A class=paging href="manageaffiliatepayment.php?pgno=<?=$PrevPageNo; ?>&order=<?=$order?>">&lt; Previous Page</A>
	  <?
	   }
	  ?> &nbsp;&nbsp;&nbsp;
	  <?php
        if($PageNo<$totalpage)
        {
         $NextPageNo = 	$PageNo + 1;
      ?>
	  <A class=paging 
      id=next href="manageaffiliatepayment.php?pgno=<?=$NextPageNo;?>&order=<?=$order?>">Next Page &gt;</A>
	  <?
       }
      ?>
		  <!-- paging ends -->
</TD></TR></TBODY></TABLE></body>
</html>
