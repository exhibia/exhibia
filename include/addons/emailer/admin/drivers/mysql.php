<?php
/*
 * mysql.php
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
if(!function_exists('db_connect')){
function db_connect($host, $database, $user, $password) {

    $handle = db_connect($host, $user, $password);
    db_select_db($database, $handle);
    return $handle;
}

function db_close($handle) { return db_close($handle); }
function db_query($handle, $sql) { return db_query($sql, $handle); }
function db_num_rows($handle) { return db_num_rows($handle); }
}
function db_get_data_by_name($handle, $row, $name) { return db_result($handle, $row, $name); }
function db_get_data_by_index($handle, $row, $index) { return db_result($handle, $row, $index); }
function db_result_status($handle, $result) { return db_errno($handle)? false : true; }

?>
