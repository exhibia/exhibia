<?php
header("Access-Control-Allow-Origin: *");
	    header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
	    header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
	    header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
	    header("Cache-Control: post-check=0, pre-check=0", false);
	    header("Pragma: no-cache");
	    
ini_set('display_errors', 1);

$_REQUEST['domain'] = str_replace("www.", "", $_REQUEST['domain']);
include("../../../config/config.inc.php");



if(db_num_rows(db_query("select * from in_game where gameID = '$_REQUEST[gameID]' and last_move != 'won'")) >= 1){

//user bowed out do something here
					payout_request($row, $_REQUEST['username'], $_REQUEST['opponent'], $BASE_DIR, $_REQUEST['gameID'], $data);
					
					
					do_game_cost($game, $_REQUEST['gameID'], $BASE_DIR, $_REQUEST['opponent'], $_REQUEST['domain']);
					game_result($row, 'lost', $BASE_DIR);



}else{





}

db_query("delete from `in_game` where `domain` = '$_REQUEST[domain]' and `username` = '$_REQUEST[username]' ");
echo db_error();
//$firephp->log(db_error(), 'Iterators');