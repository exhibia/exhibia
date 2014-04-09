<?
	include("connect.php");
	include("admin.config.inc.php");
	include("security.php");
	include("../paypalpro/CallerService.php");	
	$uid = $_REQUEST['uid'];
	
	$payUser = $_REQUEST['payuser_id'];

	$checkedUser = count($payUser);
	
	function CheckStatus($userid)
	{
		$chekId = $userid;					
		
		$qrysel = "select * from registration where account_status='1' and member_status='0' and user_delete_flag!='d' and id='".$chekId."'";
		  $ressel = db_query($qrysel);
		 
		  $total = db_num_rows($ressel);
		  if($total>0)
		  {
		  	$obj = db_fetch_object($ressel);
		  }
			
		return $obj;
	}
	

	
	if($_POST["paymentmk"]!="")
	{
		$emailSub = "Your Transaction is Success";
		$recieveEmail = "admin_api1.silvertag.com";
		
		$paymentType = urlencode("MassPay");
		$emailsubject = urlencode($emailSub);
		//$recievetype = urlencode($recieveEmail);
		$currencyCode = urlencode($CurrencyName);
		
		$count = $_POST['count'];

		for($n=0;$n<$count;$n++)
		{
			$l_email = urlencode($_POST['recieveremail'][$n]);
			
			$amount = urlencode($_POST['payment'][$n]);

			if($amount>0)
			{
				$mixedValue .= "&L_EMAIL".$n."=".$l_email."&L_AMT".$n."=".$amount;
			}
		}

		
		$nvpstr="&EMAILSUBJECT=$emailsubject&CURRENCYCODE=$currencyCode".$mixedValue;
			//print_r($nvpstr);
			//exit;
	
		$resArray=hash_call("MassPay",$nvpstr);
		$ack = strtoupper($resArray["ACK"]);
		//$ack="SUCCESS";
		if($ack!="SUCCESS")
		{
			$count1 = 0;
			$contentmsg = "";
			while (isset($resArray["L_SHORTMESSAGE".$count1])) 
			{		
				$errorCode    = $resArray["L_ERRORCODE".$count1];
				$shortMessage = $resArray["L_SHORTMESSAGE".$count1];
				$longMessage  = $resArray["L_LONGMESSAGE".$count1];
				$contentmsg .= 'ErrorCode: '.$errorCode.'<br>Short Message:'.$shortMessage.'<br>Description:'.$longMessage.'<br>';
				$count1++;
			}
			//echo "<br>".$contentmsg."<br>";
		}
		else
		{
			$count = $_POST['count'];
			for($i=0;$i<$count;$i++)
			{
				$reason = "Commission Withdrawal";
				
				$qryins = "Insert into affiliate_transaction(user_id,buy_date,referer_id,bid_pack_title,amount,commission,trans_status) values('".$_POST["userid"][$i]."',NOW(),'".$_POST["userid"][$i]."','".$reason."','0.00','".$_POST["payment"][$i]."','D')";
			
				db_query($qryins) or die(db_error());
			}
			header("location: message.php?msg=64");
			
			
			
		}
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>
<LINK href="main.css" type=text/css rel=stylesheet>
<script language="javascript">
function Check(f1)
{
	var TotalChk = f1.elements.length;
	
	var TotalColCount = f1.colorcounter.value;
	var TotalSizeCount = f1.sizecounter.value;
	var paymentcount = 0;
	var amountcount = 0;
	for(i=0;i<TotalChk;i++)
	{
		if (f1.elements[i].type == 'text')
		{
			
			if(f1.elements[i].name=="payment["+paymentcount+"]")
			{
				for(j=0;j<TotalColCount;j++)
				{
					//alert(f1.elements[i].name);
					if(f1.elements[i].value=="")
					{
						alert("Please enter pay amount!!!");
						f1.elements[i].focus();
						return false;
					}
				}
				
				paymentcount++;
				i=i+j;
				
			}
		}
		if (f1.elements[i].type == 'hidden')
		{
			if(f1.elements[i].name=="availableamt["+amountcount+"]")
			{
				alert(f1.elements[i].name);
				for(j=0;j<TotalColCount;j++)
				{
					
					if(f1.elements[i].value=="")
					{
						alert("Please enter pay amount!!!");
						f1.elements[i].focus();
						return false;
					}
				}
				
				amountcount++;
				i=i+j;
			}
		}
	}
	
	return false;
}
function Changeuseravailableamt(usr_id)
{
	ChangeUserAvailableAmt(usr_id);
}	
</script>
</head>

<BODY bgColor=#ffffff>   
<form name="f1" action="" method="post">
<table width="100%" cellpadding="0" cellSpacing="10">
  <tr>
	<td class="H1">Make Affiliate Bonus Payment</td>
  </tr>
  <tr>
	<td background="<?=DIR_WS_ICONS?>vdots.gif"><IMG height=1 src="<?=DIR_WS_ICONS?>spacer.gif" width=1 border=0></td>
  </tr>
  <tr>
	<td class="a" align="right" colspan=2>* Required Information</td>
  </tr>
  <tr>
 	<td>
 	  <table cellpadding="1" cellspacing="2">
	  	<?php if($contentmsg!=""){ ?>
		<tr>
			<td class="a" colspan="3"><?=$contentmsg?></td>
		</tr>
		<tr>
			<td colspan="3">&nbsp;</td>
		</tr>
		<?php } ?>
	    <tr valign="middle">
			<td class=f-c align="left" valign="middle" width="120"><font class=a>*</font> UserName:</td>
          <td class=f-c align="left" valign="middle" width="120"><font class=a>*</font> Reciever Email :</td>
		  
          <td class=f-c align=right valign="middle" width="120"><font class=a>*</font> Amount :</td>
		  
		  
		  
        </tr>
		<?php 
				for($i=0;$i<$checkedUser;$i++)
				{
					$regRow = CheckStatus($payUser[$i]);
					
					$uid = $regRow->id;
					$username = $regRow->username;
					$avlailabeAmount = $regRow->username;
					$email = $regRow->email;
					
					
					$qryp = "select SUM(commission) as totalcommission,trans_status from affiliate_transaction where user_id='".$uid."' group by user_id,trans_status";
					$resp = db_query($qryp);
					
					$totalp = db_num_rows($resp);
					if($totalp>0)
					{
						while($rowp = db_fetch_array($resp))
						{
							if($rowp['trans_status']=="C")
							{
								$availableamt = $rowp['totalcommission'];
							}
							elseif($rowp['trans_status']=="D")
							{
								$availableamt = $availableamt - $rowp['totalcommission'];
							}	
						}	
						$availamt = $availableamt;
					}
					else
					{
						$availamt = "0.00";
					}
		?>
		<tr>
			<td align="left" width="120"><span id="user"><?=$username;?></span></td>
		
			<td align="left" width="120"><input type="text" disabled="disabled" name="email1[]" value="<?=$email;?>" size="40" /></td>
          
		  <td align="right" width="120">
		  	<input type="text" name="availableamt[<?=$i;?>]" disabled="disabled" size="10" maxlength="10" value="<?=$availamt;?>" /><br /><!--<font class="a">Note: If Bid value is negative then bids deducted from user account otherwise bids added in user account.</font>-->
		  </td>
		 
		  
		  
		
		</tr>
		<input type="hidden" name="recieveremail[]" value="<?=$email;?>" />
		<input type="hidden" name="payment[<?=$i;?>]" value="<?=$availamt;?>" />
		<input type="hidden" name="userid[]" value="<?=$uid;?>" />
		<?php } ?>
		<input type="hidden" name="count" value="<?=$i;?>" />
		<input type="hidden" name="colorcounter" value="<?=$i;?>">
		<input type="hidden" name="sizecounter" value="<?=$i;?>">
	    <!--<tr valign="middle">
          <td class=f-c align=right valign="middle" width="191"><font class=a>*</font> Reason :</td>
		  <td>
		  	<textarea name="reason" cols="50" rows="3"></textarea>
		  </td>
		</tr>-->
		<tr valign="middle">
			<td>&nbsp;</td>
		</tr>
		<tr valign="middle">
			<td>&nbsp;</td>
		</tr>
		<tr valign="middle">
			<td colspan="2" align="center">
				
				<input type="submit" name="paymentmk" value="Submit" class="bttn" />
			</td>
		</tr>
	 </table>
	</td>
  </tr>
</table>
</form>
</BODY>
</html>
