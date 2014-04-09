<?php
	include_once("admin.config.inc.php");
	include("connect.php");
?>
<html>
<head>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<link href="main.css" type="text/css" rel="stylesheet">
<script language="JavaScript">
	function conf()
	{
		if(confirm("Are You Sure"))
		{
			return true;
		}
		return false;
	}
	function delconfirm(loc)
	{
		if(confirm("Are you Sure Do You Want To Delete"))
		{
			window.location.href=loc;
		}
		return false;
	}
</script>
<script language="javascript">
	function OpenPopup(url){
		window.open(url,'popupWindow','toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=no,resizable=yes,copyhistory=no,width=700,height=475,screenX=150,screenY=200,top=200,left=200')
}
</script>
<body bgcolor="#ffffff">
	
	<TABLE cellSpacing=5 cellPadding=0  border=0 width="99%">
		<TR>
			<TD class=H1>View user Statestics</TD>
		</TR>
		<TR>
			<TD background="images/vdots.gif"><IMG height=1 
			  src="images/spacer.gif" width=1 border=0></TD>
		</TR>
		<!--Display Addresses-->
		<tr>
			<td align="right" width="100%">
			
			</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
		</tr>
		
		<!--end to display addresses-->
		
	</tbody>
	</table>
	<br><br>
</body>
</html>
