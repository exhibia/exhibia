<?php

header("Access-Control-Allow-Origin: *");
	    header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
	    header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
	    header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
	    header("Cache-Control: post-check=0, pre-check=0", false);
	    header("Pragma: no-cache");
	    
	    
include("../../../config/config.inc.php");


function get_users_bids($uid){
include("../../../config/config.inc.php");
    $bids = db_fetch_array(db_query("select free_bids, final_bids from registration where id = $uid"));
    
    return array('final_bids' => $bids['final_bids'], 'free_bids' => $bids['free_bids']);

}
$user = db_fetch_array(db_query("select id from registration where username = '$_REQUEST[username]' order by id desc limit 1"));

echo db_error();
echo json_encode(get_users_bids($user['id']));

