<?php
/*
 * install.php
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

require_once ("../config.php");
if (isset($_POST["db_driver"]))
    include ("../drivers/".$_POST["db_driver"].".php");

function echo_info ($message) {
    echo "<div style='width: 100%; display: block; color: red; margin: 5px;'>$message</div>";
}

?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html><head>
<link rel="stylesheet" type="text/css" href="../styles/main.css"><title></title></head>
<body class="login">
<table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0">
<tr align="center" valign="middle"><td>

<table class="window" width="400" border="0" cellspacing="0" cellpadding="16">
<tr><th align="center" valign="middle"><h2><?php echo $TITLE_SystemName; ?> INSTALL</h2></th></tr>
<tr align="center"><td>

<?php

function create_db ($db_driver, $db_host, $db_admin, $db_admin_pass, $db_name, $db_user, $db_pass)
{
    switch ($db_driver) {
	case 'mysql': $name = 'mysql'; break;
	case 'postgresql': $name = 'template0'; break;
	default: echo_info("Unknow driver."); return false;
    }

    if ($f = fopen ("sql/".$db_driver."_db.sql", "r")) {
	if ($db = db_connect ($db_host, $name, $db_admin, $db_admin_pass)) {

	    while (!feof($f)) {
		$line = fgets($f);
		$line = chop($line);
		$line = trim($line);

		if ($line == "" || substr($line, 0, 1) == '#')
		    continue;

		$line = str_replace ('{DBNAME}', $db_name, $line);
		$line = str_replace ('{DBUSER}', $db_user, $line);
		$line = str_replace ('{DBPASS}', $db_pass, $line);
		
		if(!db_query ($db, $line)) {
		    echo_info("Database query failed: ".$line.".");
		    return false;
		}
	    }
	    db_close ($db);
	    return true;
	} else {
	    echo_info("Can't connect to database ".$db_name.".");
	}
	fclose ($f);
    } else {
	echo_info("Can't find SQL scheme for ".$db_driver." driver.");
    }
}
function import_db ($db_driver, $db_host, $db_name, $db_user, $db_pass) 
{
    if ($f = fopen ("sql/".$db_driver.".sql", "r")) {
	if ($db = db_connect ($db_host, $db_name, $db_user, $db_pass)) {

	    while (!feof($f)) {
		$line = fgets($f);
		$line = chop($line);
		$line = trim($line);

		if ($line == '' || substr($line, 0, 1) == '#')
		    continue;
		
		$line = str_replace ('{DBNAME}', $db_name, $line);

		if(!db_query ($db, $line)) {
		    echo_info("Database query failed.");
		    return false;
		}
	    }
	    db_close ($db);
	    return true;
	} else {
	    echo_info("Can't connect to database ".$db_name.".");
	}
	fclose ($f);
    } else {
	echo_info("Can't find SQL scheme for ".$db_driver." driver.");
    }

    return false;
}
function step0()
{
    if (!is_writable('../config.php')) {
	echo_info("File config.php must be writable (mode 666 is a good idea).<br>".
	    "<a href='install'> Check again </a>");
    } else {
	step1();
    }
}
function step1()
{
    $db_host = isset($_POST["db_host"])?$_POST["db_host"]:"localhost";
    $db_admin = isset($_POST["db_admin"])?$_POST["db_admin"]:"root";
    $db_admin_pass = $_POST["db_admin_pass"];
    $db_name = isset($_POST["db_name"])?$_POST["db_name"]:"6xmailer";
    $db_user = isset($_POST["db_user"])?$_POST["db_user"]:"6xmailer";
    $db_pass = $_POST["db_pass"];

?><br><form action="/install/?step=2" method="post">
<table cellpadding="0" cellspacing="2" border="0">
<tr>
<td nowrap="nowrap">Domain part of e-mail addresses:&nbsp;&nbsp;</td>
<td class="value"><input type="text" class="text" name="smtp_domain" value="<?php echo $db_host; ?>"></td>
</tr>
<tr><td nowrap="nowrap">Database Type:&nbsp;&nbsp;</td>
<td><select size="1" name="db_driver" style="width: 150px;"><?php
    if ($d = opendir("../drivers")) {
	while (($entry = readdir($d)) != false) {
	    if (strstr($entry, '.php')) {
		echo "<option>".str_replace (".php", "", $entry)."</option>\n";
	    }
	}
	closedir($d);
    }
?></select></td></tr>
<tr>
<td nowrap="nowrap">Database Server Hostname / DSN:&nbsp;&nbsp;</td>
<td class="value"><input type="text" class="text" name="db_host" value="<?php echo $db_host; ?>"></td>
</tr>
<tr>
<td>Database Admin name:&nbsp;&nbsp;</td>
<td class="value"><input type="text" class="text" name="db_admin" value="<?php echo $db_admin; ?>"></td>
</tr>
<tr>
<td>Database Admin password:&nbsp;&nbsp;</td>
<td class="value"><input type="text" class="text" name="db_admin_pass" value=""></td>
</tr>
<tr>
<td>Database name:&nbsp;&nbsp;</td>
<td class="value"><input type="text" class="text" name="db_name" value="<?php echo $db_name; ?>"></td>
</tr>
<tr>
<td>Database Username:&nbsp;&nbsp;</td>
<td class="value"><input type="text" class="text" name="db_user" value="<?php echo $db_user; ?>"></td>
</tr>
<tr>
<td>Database Password:&nbsp;&nbsp;</td>
<td class="value"><input type="text" class="text" name="db_pass" value=""></td>
</tr>
<tr><td colspan="2">&nbsp;</td></tr>
<tr><td colspan="2" align="center"><input type="submit" class="submit" value=" Next Step "></td></tr>
</table>
</form><?php }

function step2()
{
    $db_driver = $_POST["db_driver"];
    $db_host = $_POST["db_host"];
    $db_admin = $_POST["db_admin"];
    $db_admin_pass = $_POST["db_admin_pass"];
    $db_name = $_POST["db_name"];
    $db_user = $_POST["db_user"];
    $db_pass = $_POST["db_pass"];
    $smtp_domain = $_POST["smtp_domain"];

    if ($smtp_domain == "") {
	echo_info("Domain part must be filled.");
	step1();
	return;
    }
    if ($db_name == "") {
	echo_info("Database name must be filled.");
	step1();
	return;
    }
    if ($db_host == "") {
	echo_info("Database hostname must be filled.");
	step1();
	return;
    }
    if ($db_user == "") {
	echo_info("Database user must be filled.");
	step1();
	return;
    }

    if ($db_admin != "")
    	if (!create_db ($db_driver, $db_host, $db_admin, $db_admin_pass, $db_name, $db_user, $db_pass)) {
	   echo_info("Database creation failed, please correct information or create it manually.");
	   step1();
	   return;
	}

    if ($f = fopen("../config.php", "r")) {
	$content = "";

	while (!feof($f)) {
	    $line = fgets($f);

	    if (strpos($line, '$SQLHostname') !== false) {
		    $content .= "\$SQLHostname = '".$db_host."';\n";
	    } 
	    else if (strpos($line, '$SQLUsername') !== false) {
		$content .= "\$SQLUsername = '".$db_user."';\n";
	    } 
	    else if (strpos($line, '$SQLPassword') !== false) {
		$content .= "\$SQLPassword = '".$db_pass."';\n";
	    } 
	    else if (strpos($line, '$SQLDatabase') !== false) {
		$content .= "\$SQLDatabase = '".$db_name."';\n";
	    } 
	    else if (strpos($line, '$SQLDriver') !== false) {
		$content .= "\$SQLDriver = '".$db_driver."';\n";
	    } 
	    else if (strpos($line, '$SMTPDomain') !== false) {
		$content .= "\$SMTPDomain = '".$smtp_domain."';\n";
	    } 
	    else $content .= $line;
	}
	fclose ($f);
	if ($f = fopen("../config1.php", "w")) {
	    fwrite ($f, $content);
	    fclose ($f);
	    echo "<pre>".$content."</pre>";

	    if (import_db ($db_driver, $db_host, $db_name, $db_user, $db_pass)) {
		step3();
		return;
	    } else {
		echo_info("Database import failed, please correct information or contact with administrator.");
		step1();
		return;
	    }
	}
	echo_info("Can't modify config file.");
    }
    step1();
    return;
}

function step3()
{
    echo_info("Installation complete. Don't reload this page!<br>".
	"Please change config.php permitions to read only (644 is a good idea) and delete /install directory before login.<br>".
	"<a href='/'>Go to login page</a>");
}

switch ($_GET['step']) {
    case 1: step1(); break;
    case 2: step2();  break;
    default: step0();
}

?></td></tr>
</table>
</td></tr>
</table>
</body>
</html>
