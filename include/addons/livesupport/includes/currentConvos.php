<?php
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
// mysql
include "base.php";
// grab config data
$fetch_config = db_query("SELECT * FROM config ORDER BY id ASC LIMIT 1 ");
$config = db_fetch_array($fetch_config);
// convo timeout
$timeout = $config['inactive'];
// hide timeout
$timeout_hide = $config['end'];
// remove timeout- prevents session  duplication
$timeout_remove = 172800;
if(!empty($_GET)) {

$new = array();
$updated = array();
$current = array();
$closed = array();
$count = 0;
$result = db_query("SELECT * FROM sessions ");
echo '<ul id="chat-list">';
while($row = db_fetch_array($result)) {
	if($row['status'] == "open") {
		if($row['answered'] > $row['updated']) {
			if((time() - $row['answered']) > $timeout) {
				db_query("UPDATE sessions SET status = 'closed', ended = '".time()."' WHERE id = '".$row['id']."' ");
				db_query("INSERT INTO transcript (name,message,convoID,class) VALUES ('System','Session has timed out, type a message to resume','".$row['id']."','notice') ");
			}
		}
		if($row['updated'] > $row['answered']) {
			if(($row['updated'] == 0) && ($row['answered'] == 0)) {
				$new[$count]["name"] = $row['name'];		
				$new[$count]["convoID"] = $row['convoID'];		
			} else {
			$updated[$count]["name"] = $row['name'];
                        $updated[$count]["convoID"] = $row['convoID'];
			}
		} elseif(($row['updated'] == 0) && ($row['answered'] == 0)) {
		$new[$count]["name"] = $row['name'];
                $new[$count]["convoID"] = $row['convoID'];
		} else {
		$current[$count]["name"] = $row['name'];
                $current[$count]["convoID"] = $row['convoID'];
	}
	}
	if($row['status'] == "closed") {
		if( ((time() - $row['ended']) > $timeout_hide) && $row['hide'] != "yes") {
			db_query("UPDATE sessions SET hide = 'yes' WHERE id = '".$row['id']."' ");
			db_query("INSERT INTO transcript (name,message,convoID,class) VALUES ('System','Session has been ended due to inactivity.','".$row['id']."','notice') ");
		} else if($row['hide'] == "no") {
			$closed[$count]["name"] = $row['name'];
		        $closed[$count]["convoID"] = $row['convoID'];
		}
	}
	if($row['hide'] == "yes") {
		if((time() - $row['ended']) > $timeout_remove) {
			db_query("DELETE FROM transcript WHERE convoID = '".$row['convoID']."' ");
			db_query("DELETE FROM sessions WHERE id = '".$row['id']."' ");
		}
	}
$count = $count + 1;
}
	shuffle($new);
	shuffle($updated);
	shuffle($current);
	shuffle($closed);
	sort($new);
	sort($updated);
	sort($current);
	sort($closed);
	$newTotal = count($new);
	$updatedTotal = count($updated);
	$currentTotal = count($current);
	$closedTotal = count($closed);
	if(($newTotal + $updatedTotal + $currentTotal + $closedTotal ) == 0 ) { 
	?>
	<script type="text/javascript">
	activeConvo = "open";
	getInfo('open');
	</script>
	<?
	}
	for($i = 0; $i < $newTotal; $i ++ ) {
		echo '<li class="new" onClick="activeConvo = ' . $new[$i]["convoID"] . ';getInfo(activeConvo); getInput(activeConvo);">';
		echo '<a href="#" onClick="activeConvo = ' . $new[$i]["convoID"] . ';getInfo(activeConvo); getInput(activeConvo);">' . $new[$i]["name"] . '</a>';
	        echo '</li>';
	}
	for($i = 0; $i < $updatedTotal; $i ++ ) {
		echo '<li class="updated">';
		echo '<a href="#" onClick="activeConvo = ' . $updated[$i]["convoID"] . ';getInfo(activeConvo);getInput(activeConvo);">' . $updated[$i]["name"] . '</a>';
	        echo '</li>';
	}
	for($i = 0; $i < $currentTotal; $i ++ ) {
		echo '<li class="current">';
		echo '<a href="#" onClick="activeConvo = ' . $current[$i]["convoID"] . ';getInfo(activeConvo); getInput(activeConvo);">' . $current[$i]["name"] . '</a>';
	        echo '</li>';
	}
	for($i = 0; $i < $closedTotal; $i ++ ) {
		echo '<li class="ended">';
		echo '<a href="#" onClick="activeConvo = ' . $closed[$i]["convoID"] . ';getInfo(activeConvo);getInput(activeConvo);">' . $closed[$i]["name"] . '</a>';
	        echo '</li>';
	}



echo '</ul>';
}
?>
</body>
</html>
