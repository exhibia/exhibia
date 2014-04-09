<?php
if(!empty($_GET['user'])) {
include "base.php";
$current = db_query("SELECT available FROM users WHERE username = '".$_GET['user']."' ");
$result = db_fetch_array($current);
if($result['available'] == "no") {
$updated = "yes";
$string = '<h4><a href="#" onClick="available(false);"><img src="images/icons/available.png" title="Click to change availability" height="30" style="vertical-align:middle;"/>&nbsp;&nbsp;Available</a></h4>';
}
else {
$updated = "no";
$string = '<h4><a href="#" onClick="available(false);"><img src="images/icons/unavailable.png" title="Click to change availability" height="30" style="vertical-align:middle;"/>&nbsp;&nbsp;Not Available</a></h4>';
}
$query = db_query("UPDATE users SET available = '".$updated."' WHERE username = '".$_GET['user']."' ");
if($query) {
echo $string;
}
}
?>
