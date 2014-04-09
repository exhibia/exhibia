<?php
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
// include database connection info
include "base.php";
//include date file
include "date.php";

//echo time();


if(!empty($_GET)) {
	echo "<ul>";
	$query = db_query("SELECT * FROM transcript WHERE convoID = '".$_GET['convo']."' ORDER BY id ASC");
	while($row = db_fetch_array($query)) {
		
		echo '<li class="'.$row['class'].'"><span class="response_sum">' . $row['time'] . " " . $row['name'] . " said :</span><br /> " . $row['message'] . '</li>';  	
	}
	echo "</ul>";
}



?>
