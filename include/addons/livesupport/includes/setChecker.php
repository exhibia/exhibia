<?php
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
// mysql
include "base.php";
include 'setTimer.php';
$result = db_query("SELECT * FROM sessions ");
$newConvo = 0;
while ($row = db_fetch_array($result)) {
	if($row['status'] != "closed") {
		//look for new convos
		if($row['answered'] == 0) {
			$newConvo = 1;
		}
		if($row['updated'] > $row['answered']) {
			$newConvo = 1;
		}
	}
}





echo $newConvo;
?>
