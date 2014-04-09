<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo $ADMIN_MAIN_SITE_NAME." - Manage Members"; ?></title>
<script language="JavaScript">
function OpenPopup(url)
{
	fromrec = document.getElementById('form2').value;
	torec = document.getElementById('form2').value;
	window.open(url,'popupWindow','toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=no,resizable=no,copyhistory=no,width=100,height=100,screenX=300,screenY=350,top=300,left=350');
	
}
</script>
<link href="main.css" type="text/css" rel="stylesheet">
</head>

<body bgcolor="#ffffff" style="padding-left:10px">
<TABLE cellSpacing=10 cellPadding=0  border=0 width="100%" background="">
		<TR>
			<TD>
				<table border="0" width="770">
				<tr>
					<td class='H1' width="610">Manage Users</td>
				</tr>
				</table>
			</TD>
		</TR>
		<TR>
			<TD background="images/vdots.gif"><IMG height=1 
			  src="images/spacer.gif" width=1 border=0></TD>
		</TR>
<Tr>
<td>

<form id="form2" name="form2" action="" method="post">	  
		<TABLE width="300" border="0" cellSpacing="0" align="left">
			<tr>
				<td>Record From : </td>
				<td align="left"><input type="text" name="fromrec" /></td>
			</tr>
			<tr>
				<td>Record To : </td>
				<td align="left"><input type="text" name="torec" /></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<Td align="center" colspan="2"><input type="button" name="submit" class="bttn" value="Export to CSV" onclick="OpenPopup('download.php?export=musers&mstatus=<?=$memstatus?>&stext=<?=$searchdata?>')" /></Td>
			</tr>
		</TABLE>
</form>
</td>
</Tr>
</TABLE>
</body>
</html>
