<?php
header("Access-Control-Allow-Origin: *");
	    header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
	    header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
	    header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
	    header("Cache-Control: post-check=0, pre-check=0", false);
	    header("Pragma: no-cache");
	    

$_REQUEST['domain'] = str_replace("www.", "", $_REQUEST['domain']);
require("../../../config/config.inc.php");

$db = db_connect($DBSERVER,$USERNAME, $PASSWORD, $DATABASENAME);
db_select_db($DATABASENAME, $db);

include("$BASE_DIR/include/addons/games-server/functions.php");

if(db_num_rows(db_query("select * from in_game where `domain` = '$_REQUEST[domain]' and `username` = '$_REQUEST[username]' and room = '$_REQUEST[room]'")) >= 1){
    $row = db_fetch_array(db_query("select * from in_game where `domain` = '$_REQUEST[domain]' and `username` = '$_REQUEST[username]' and room = '$_REQUEST[room]'"));
	payout_request($row, $_REQUEST['username'], $_REQUEST['opponent'], $BASE_DIR, $_REQUEST['gameID'], $data);
	do_game_cost($game, $_REQUEST['gameID'], $BASE_DIR, $_REQUEST['opponent'], $_REQUEST['domain']);
	echo db_error();
	game_result($row, 'lost', $BASE_DIR);

$last_id = db_fetch_array(db_query("select id from lobby_messages order by id desc limit 1"));
      $last = number_format($last_id[0]) + 1;
      
      db_query("insert into lobby_messages(id, domain, recipient, sender, message, time, alert_type) values(null, '$_REQUEST[domain]', '$_REQUEST[opponent]', '$_REQUEST[domain]', '<span style=\"color:red;\">$_REQUEST[username] has left: $_REQUEST[room]. Click <a href=\"javascript:;\" onclick=\"delete_message(\'" . $last . "\');\">Here</a> to leave now.</span>', NOW(), 'alert');");
}else{



}
     

      
db_query("delete from in_game where `domain` = '$_REQUEST[domain]' and room = '$_REQUEST[room]' and (`username` = '$_REQUEST[username]'  or username ='$_REQUEST[opponent]') ");
echo db_error();
echo "Game Ended";
exit;
//$firephp->log(db_error(), 'Iterators');