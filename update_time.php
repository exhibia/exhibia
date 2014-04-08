<?php
include("config/connect.php");
include("functions_s.php");

$aucidsnew = '';
foreach ($_POST as $name => $value) {
	$value = chkInput($value, 'i');
	if ( $value == 0 ) continue;

	$aucidsnew .= ($aucidsnew == '' ? $value : ",".$value);
}

if ( $aucidsnew == '' ) {
	echo "[]";
	return;
}

$qrysel = "select auction_id, auc_due_time, pause_status from auc_due_table adt ".
			 "left join auction a on a.auctionID=adt.auction_id where a.auctionID in ($aucidsnew)";
$ressel = db_query($qrysel);

$is_first = TRUE;
$temp = "";

while ( ( $obj = db_fetch_object($ressel) ) ) {
	if ( $is_first ) {
		$is_first = FALSE;
	} else {
		$temp .= ",";
	}
	$temp .= '{"auction":{"id":"'.$obj->auction_id.'","time":"'.auc_due_time.'","pause":"'.$obj->pause_status.'"}}';
}
db_free_result($ressel);

echo "[".$temp."]";
?>