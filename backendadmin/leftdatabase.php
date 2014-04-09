<?php
include_once("admin.config.inc.php");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
	<HEAD>
		<META http-equiv="Content-Type" content="text/html; charset=utf-8">
		<LINK href="main.css" type="text/css" rel="stylesheet">
		<LINK href="menu.css" type="text/css" rel="stylesheet">
		<SCRIPT language="javascript" src="main.js" type="text/javascript"></SCRIPT>
		<SCRIPT language="javascript" src="menu.js" type="text/javascript"></SCRIPT>
	</HEAD>
	<BODY bgColor="#eeeeee" leftmargin="5">
		<TABLE cellSpacing="0" cellPadding="0" width="100%" border="0">
		  <TBODY>
				<tr><td height="5"></td></tr>
				<TR>
			   	<TD vAlign="top">
			      	<DIV id="mnpMenuTop">
				      	<DIV class="mnpInherit">
<?php
///////////////////////
//incldue here links.txt.php
////////////////
include("database.txt.php");

$MainLinksSize = sizeof($MainLinksArray);
for ( $i=0; $i<$MainLinksSize; $i++ )
	if ( $MainLinksArray[$i][2] == 1 ) { 
?>      
								<DIV class="MenuHead" nowrap><font class="MenuHead"><strong><?= $MainLinksArray[$i][0]; ?></strong></font></DIV>
<?php
		$ChildLinksSize = sizeof($ChildLinksArray);
		for ( $j=0; $j<$ChildLinksSize; $j++ )
			if ( $ChildLinksArray[$j][2] == $i ) {
?>
								<DIV class="mnpMenuRow" style="width: 188" align="left">&nbsp;<A class="menu_item" href="<?= $ChildLinksArray[$j][1]; ?>" target="body"><?= $ChildLinksArray[$j][0]; ?></A></DIV>
<?php
			}
	} else {
?>
								<DIV><a HREF="<?= $MainLinksArray[$i][1]; ?>" target="body" class="menuhead"><?= $MainLinksArray[$i][0]; ?></a></DIV>
<?php
	}
?>
							</DIV>
						</DIV>
					</TD>
				</TR>
			</TBODY>
		</TABLE>
	</BODY>
</HTML>