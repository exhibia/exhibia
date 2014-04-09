<?php
	//session_start();
	include("config.inc.php");
	include_once("admin.config.inc.php");
	
	if(isset($_SESSION['UsErOfAdMiN']))
	$UsErOfAdMiN=$_SESSION['UsErOfAdMiN'];
?>
<html>
<head>
	
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	<link href="main.css" type="text/css" rel="stylesheet"/>
	<link href="demo.css" type="text/css" rel="stylesheet"/>
	<script language="javascript" src="body.js"></script>
</head>
<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<script language="JavaScript" src="body.js" type="text/javascript">
framecheck('home')

function SearchContacts()
{
	contacts = sc.search_type[0].checked;
	notes = sc.search_type[1].checked;
	
	if(notes)
	{
		parent.top.location='/webadmin/contacts.aspx?redirect_url=/webadmin/contacts/search_notes.aspx?keyword=' + sc.keyword.value ;
}
	if(contacts)
	{
		parent.top.location='/webadmin/contacts.aspx?redirect_url=/webadmin/contacts/search_contacts.aspx?keyword=' + sc.keyword.value ;
}
	return false;
}
function SearchAccounts()
{
	accounts = sa.search_type[0].checked;
	users = sa.search_type[1].checked;
	invoices = sa.search_type[2].checked;
	notes = sa.search_type[3].checked;

	if(accounts)
	{
		parent.top.location='accounts.aspx?redirect_url=/webadmin/accounts/search_accounts.aspx?keyword=' + sa.keyword.value ;
	}
	if(users)
	{
		parent.top.location='accounts.aspx?redirect_url=/webadmin/accounts/search_account_users.aspx?keyword=' + sa.keyword.value ;
	}
	if(invoices)
	{
		parent.top.location='accounts.aspx?redirect_url=/webadmin/accounts/search_invoices.aspx?keyword=' + sa.keyword.value ;
	}
	if(notes)
	{
		parent.top.location='accounts.aspx?redirect_url=/webadmin/accounts/search_notes.aspx?keyword=' + sa.keyword.value ;
	}
	return false;
}
</script>
<table width="100%" border="0" cellspacing="10" cellpadding="0">
<tr><td class="H1">Welcome <?php echo $UsErOfAdMiN;?></td></tr>
<tr><td background="images/vdots.gif"><img src="images/spacer.gif" width="1" height="1" border="0"></td></tr>
<tr>
<td>
<!--content-->


		<table width="100%" border="0" cellspacing="10" cellpadding="0">
  <tr>
   <?php
	  include("headlinks.txt.php");
  		$MainLinksSize = sizeof($HeadLinksArray);
		
		  for($k=1;$k<$MainLinksSize;$k++)
		  {
			$LinkTitle = $HeadLinksArray[$k][0];
			$headHREF = $HeadLinksArray[$k][1];
   		 ?>
          <td valign="top" nowrap width="155"> 
            <!--c 001-->
            <table width="100%" border="0" cellspacing="5" cellpadding="0">
  			<tr>
    			<td width="12">
					<img src="images/basics.gif" width="11" height="22">
				</td>
     			<td class="H2">
					<?php echo $LinkTitle; ?>
				</td>
  			</tr>
  			<tr> 
    			<td width="1">&nbsp;
				
				</td>
    			<td> 
              <?php ///if include then  ?>
			  <?
			  	if($HeadLinksArray[$k][2]==1)
				{
					////a variable that decide that having order summery or not
					$havingorder=0;
					/////
					include($HeadLinksArray[$k][3]);
					$MainLinksSize1 = sizeof($MainLinksArray);
					?>
						
                  <table width="100%" border="0" cellspacing="0" cellpadding="3">
                    <?
 					 for($i=0;$i<$MainLinksSize1;$i++)
  						{
						    //$LayerId= $i+2;
						    $LinkTitle = $MainLinksArray[$i][0];
						    $HREF = $MainLinksArray[$i][1];
							$HasChild = $MainLinksArray[$i][2];
						    if($HasChild==1)
						    { 
					  		?>
							<tr> 
							  <td colspan="2" class="g" nowrap><b><?php echo $LinkTitle; ?></b></td>
							</tr>
							<?
							$ChildLinksSize = sizeof($ChildLinksArray);
      
						      for($j=0;$j<$ChildLinksSize;$j++)
						      {
						        $MainLinkID= $ChildLinksArray[$j][2];
						        if($MainLinkID == $i)
							    {
						        	$ChildLinkTitle = $ChildLinksArray[$j][0];
						        	$ChildHREF = $ChildLinksArray[$j][1];
								?>
								<tr> 
								  <td width="1%"><img src="images/arrow_grey.gif" width="7" height="7" border="0"></td>
								  <td nowrap="nowrap">
								  <?php 	if($LinkTitle=="Static Page Management")
								  		{
									?>
								    <a target="_top" style="text-decoration:none;" href="<?php echo $headHREF; ?>"><?php echo $ChildLinkTitle; ?></a>
								    <?
										}
										else
										{
								   ?>
								 <?php if($ChildHREF!='#'){?>
									  <a target="_top" href="<?php echo $headHREF; ?>?default=<?php echo $ChildHREF; ?>"><?php echo $ChildLinkTitle; ?></a>
								  <?php }else{ 
								  	$usrpwd = base64_encode($UsErOfAdMiN)
								  ?>
									  <a target="_parent" href="innerhome.php" onClick="window.open('../helpdesk/admin.php?usrpwd=<?=$usrpwd;?>');"><?php echo $ChildLinkTitle; ?></a>
									  <?php } ?>
								  <?php } ?>
								  </td>
								</tr>
								<?
								}//end of if 
							  }//end of for j
								?>
							<tr> 
							  <td height="10"> </td>
							</tr>
							<?
							}//end of if
						  }//end of for i
						  ?>
                    </table>
				
			   <?php 
			   	if ($havingorder==1)
				{ // when in order list then it is include a file 
					//include("ordersummary.php");
				}
			   }// end of include ?>
			   </td>
			</tr>
			</table>
    
    <?php //////td for vertical dots..   ?>
    </td>
    <td  width="1" rowspan="2" background="images/dots.gif">
		<img src="images/spacer.gif" width="1" height="1" border="0">
	</td>
	<?
	}
 	?>	
	<td>&nbsp;</td>
<!--///////  -->	
  </tr>
</table>

<!--//content-->
</td>
</tr>
</table>
</body>
</html>