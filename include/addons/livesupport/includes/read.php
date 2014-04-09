<?php
if(!empty($_GET['id'])) {
	include "base.php";
	$fetch = db_query("SELECT * FROM archive WHERE convoID = '".$_GET['id']."' ORDER BY id ASC");
	while ($row = db_fetch_array($fetch)) {
		if($row['class'] == "user") { $user = $row['name']; $user = $row['name'];}
		if($row['class'] == "admin") {
                        if($row['name'] != "Admin") { $agent = $row['name']; }
                }
	}
	$fetch = db_query("SELECT * FROM archive WHERE convoID = '".$_GET['id']."' ORDER BY id ASC");
	echo '<div id="padded_box">';
	echo '<p>Archived Conversation between <strong>'.$agent.'</strong> and <strong>'.$user.'</strong></p>';
	echo '<div id="archive"><ul class="chat_display">';
	while ($row = db_fetch_array($fetch)) {
                if($row['class'] == "notice") {
                echo '<li class="'. $row['class'] .'"><span class="user_said">' . $row['name'] . " said :</span><br> " . $row['message'] . '</li>';
                } else {
                echo '<li class="'. $row['class'] .'"><span class="user_said">' . $row['time'] . " - " . $row['name'] . "
                said :</span><br> " . $row['message'] . '</li>';
                }
        }
        echo "</ul></div>";
	?>
	<p>Email a copy of this conversation to:</p>
	<form method="post" action="leads.php">
	<input type="hidden" name="convoID" id="convoID" value="<?=$_GET['id'];?>">
	<input size="50" type="text" name="email" id="email" class="input_field">
	<input type="submit" name="email_convo" id="email_convo" value="Send Message" class="input_field submit">
	</form>
	</div>
	<?
}



?>
