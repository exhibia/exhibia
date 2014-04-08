<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include("config/connect.php");
include("$BASE_DIR/data/userproduct.php");
include("$BASE_DIR/Functions_s/AllowWinInMonth.php");
include("$BASE_DIR/Functions_s/allowWinInWeek.php");
if ($_SERVER["HTTP_X_REQUESTED_WITH"] != "XMLHttpRequest") {
   // exit;
}

if (isset($_SESSION["userid"])) {
    $uid = $_SESSION["userid"];

    include("Functions/update_users_bids.php");
    update_users_bids($uid);
    $bids = get_users_bids($uid);
    
    
    $ids=$_REQUEST['ids'];
    $sql="select * from watchlist left join auction_running a on a.auctionid = auc_id where user_id='$uid' and a.auc_status=2;";
   
    $total = db_num_rows(db_query($sql));
    $sql="select * from won_auctions where userid='$uid'";
    $total_auc = db_num_rows(db_query($sql));
    $sql="select * from watchlist where auc_id in ($ids) and user_id='$uid'";
    $result=db_query($sql);
    $array=array();
    while($obj=  db_fetch_array($result)){
        array_push($array, $obj['auc_id']);
    }
    db_free_result($result);
    $announcements = db_num_rows(db_query("select * from `cometchat_announcements` where `to` = '$uid'"));
    $updb = new UserProduct(null);

    $total_bn = $updb->countByUser($uid, -1);
    if(allowWinInMonth($uid) == false){
	$msg = MESSAGE_REACHED_TO_MONTH_LIMIT;
	$limit_reached = true;
    }else{
	if(allowWinInWeek($uid) == false){
	    $msg = MESSAGE_REACHED_TO_WEEK_LIMIT;
	    $limit_reached = true;
	}else{
	    $msg = "keep bidding";
	}
    }
    
    
    echo json_encode(array('message'=>'ok', 'announcements' => "$announcements", 'total_wins' => "$total_auc", 'total' => "$total", 'bids' => $bids['final_bids'], 'free_bids' => $bids['free_bids'], 'data'=>$array, 'total_buynow' => "$total_bn", 'bid_msg' => "$msg"));
} else {
    echo json_encode(array('message'=>'error'));
}
?>
