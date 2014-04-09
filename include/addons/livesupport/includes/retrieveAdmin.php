<?php
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
include "base.php";
if(!empty($_GET)) {
	if($_GET['id'] != "open") {
	echo '<ul class="chat_display">';
	$query = db_query("SELECT * FROM transcript WHERE convoID = '".$_GET['id']."' ORDER BY id ASC");
	while($row = db_fetch_array($query)) {
		if($row['class'] == "notice") {
		echo '<li class="'. $row['class'] .'"><span class="user_said">' . $row['name'] . " said :</span><br> " . $row['message'] . '</li>';  	
		} else {
		echo '<li class="'. $row['class'] .'"><span class="user_said">' . $row['time'] . " - " . $row['name'] . " said :</span><br> " . $row['message'] . '</li>';  	
		}		
	}
	echo "</ul>";
	} 
}

?>