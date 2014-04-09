<?php
include_once(dirname(dirname(dirname(__FILE__))).DIRECTORY_SEPARATOR."modules.php");

$response = array();

$sql = ("select recentlist, highscorelist from cometchat_games where userid = '".mysqli_real_escape_string($GLOBALS['dbh'],$_REQUEST['uid'])."'");
$res = mysqli_query($GLOBALS['dbh'],$sql);

if($row = mysqli_fetch_array($res)){
	$recentlist = $row['recentlist'];
	$highscorelist = $row['highscorelist'];
}

if($highscorelist){
	$explodedHighscorelist = explode(';',$highscorelist);
	foreach($explodedHighscorelist as $key => $val){
		$highscorelistElements=explode(',',$val);
		$highest[] = array('gn'=>$highscorelistElements[1],'sc'=>$highscorelistElements[2]);
	}
}

if($recentlist){
	$explodedRecentlist = explode(';',$recentlist);
	foreach($explodedRecentlist as $key => $val){
		$recentlistElements = explode(',',$val);
		$latest[] = array('gn'=>$recentlistElements[1],'sc'=>$recentlistElements[2]);
	}
}

$response['latest'] = $latest;
$response['highest'] = $highest;
echo json_encode($response);

?>