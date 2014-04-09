<?php 
ini_set('display_errors', 1);
include("../../../../../config/config.inc.php");

/*
 * help.php
 *
 * Description:	 W3MAIL - A PHP IMAP mail reader.
 * Developed by: Alexander Djourik <sasha@iszf.irk.ru>
 *		 Anton Gorbunov <anton@iszf.irk.ru>
 *		 Pavel Zhilin <pzh@iszf.irk.ru>
 *
 * Copyright (c) 2002,2003,2004,2005 Alexander Djourik. All rights reserved.
 *
 * Initially based on code from 6XMailer - A PHP POP3 mail reader,
 * Copyright 2001 6XGate Systems, Inc. All rights reserved.
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License.
 *
 * Please see the file LICENSE in this directory for full copyright
 * information.
 *
 */

require_once (realpath(dirname(__FILE__))  . "/config.php");

// Start the session
session_start();

// Determine the language strings to use
if (!isset($_SESSION['Language'])) $_SESSION['Language'] = $Language;
require_once (realpath(dirname(__FILE__))  . "/lang/" . $_SESSION['Language'] . ".php");

?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html><head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $DEFCharset; ?>">
<link rel="stylesheet" type="text/css" href="<?php echo $SITE_URL;?>include/addons/emailer/admin/styles/main.css">
<title><?php echo $TITLE_System . " : " . $TITLE_Help;?></title>

<script language="JavaScript" type="text/javascript">
<!--//

window.top.document.title="<?php echo $TITLE_System . " : " . $TITLE_Help;?>";

//-->
</script>
</head>

<body class="help">

    <table width="600" border="0" cellspacing="0" cellpadding="10" class="window">
    
    <tr><td align="left" valign="top" height="100%">
    <?php if (isset($HELP_Item) and isset($HELP_Text)) {
    ?>
    <ul style="list-style-type:none;border:1px solid blue;border-radius:8px;width:150px;box-shadow:6px 6px 6px #666;">
    <?php
    for ($i=1; $i<count($HELP_Item) - 2; $i++) {
		echo "<li style=\"font-size:12px;padding: 5px 0 5px 10px;position:relative;left:-40px;\"><a href=\"help.php?item=".$i."\" target=\"Message\">".$HELP_Item[$i]."</a>\n";
	    }
    ?>
    </ul>
    </td>
    <td>
    <?php
	if (isset($_GET['item'])) {
	
	?>
	 <div style="position:absolute;top:20px;width:350px;left:220px;list-style-type:none;border:1px solid blue;border-radius:8px;box-shadow:6px 6px 6px #666;">
   
	<?php
	    $item = $_GET['item'];
	    echo "<span style=\"\"><b>".$HELP_Item[$item]."</b><p>".$HELP_Text[$item]."</span>\n";
	 
	 ?>
      </div>
      
      <?php } ?>
    <?php
	
    }
    ?>
    </ul></td></tr>
    </table>


</body></html>
