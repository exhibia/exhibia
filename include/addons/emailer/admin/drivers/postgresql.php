<?php
/*
 * postgresql.php
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

function db_connect($host, $database, $user, $password) {
    $sql = "";
    if ($host != "") {
	list($hostname,$port) = split (":", $host);
	$sql .= "host=$hostname ";
	$sql .= "port=$port ";
    }
    if ($database != "") $sql .= "dbname=$database ";
    if ($user != "") $sql .= "user=$user ";
    if ($password != "") $sql .= "password=$password";
    return pg_connect(trim($sql));
}

function db_close($handle) { return pg_close($handle); }
function db_query($handle, $sql) { return pg_query($handle, $sql); }
function db_num_rows($handle) { return pg_num_rows($handle); }
function db_get_data_by_name($handle, $row, $name) { return pg_fetch_result($handle, $row, $name); }
function db_get_data_by_index($handle, $row, $index) { return pg_fetch_result($handle, $row, $index); }
function db_result_status($handle, $result) { return (pg_result_status($result) == PGSQL_COMMAND_OK)? true : false; }
?>
