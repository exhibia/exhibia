<?php
header("Access-Control-Allow-Origin: *");
	    header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
	    header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
	    header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
	    header("Cache-Control: post-check=0, pre-check=0", false);
	    header("Pragma: no-cache");
	    
include("../../../config/config.inc.php");
$_REQUEST['domain'] = str_replace("www.", "", $_REQUEST['domain']);


$game = db_fetch_object(db_query("select * from in_game where gameID = '$_REQUEST[gameID]' order by id desc limit 1"));

db_query("insert into in_game values(null, '" . addslashes($_REQUEST['domain']) . "', '" . addslashes($_REQUEST['winner']) . "', '" . $game->room . "', NOW(), 'won'");



