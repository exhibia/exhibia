<?php 
// create session so we can keep track of users
session_start();
// mysql interaction
include "includes/base.php";
// check login
function isLoggedIn() {
        if($_SESSION['valid'])
                return true;
                return false;
        }
        if(!isLoggedIn()) {
                header('Location: login.php');
                die();
}
// update keepalive
db_query("UPDATE users SET keepAlive = '".time()."' WHERE username = '".$_SESSION['username']."' ");
// check for email
if(isset($_POST['email_convo'])) {
	$fetch = db_query("SELECT * FROM users WHERE username = '".$_SESSION['username']."' ");
	$result = db_fetch_array($fetch);
	$query = db_query("SELECT * FROM archive WHERE convoID = '".$_POST['convoID']."' ");
	while ($row = db_fetch_array($query)) {
		if($row['class'] == "user") { $customer = $row['name']; }
		if($row['class'] == "admin") {
			if($row['name'] != "Admin") { $agent = $row['name']; } 
		}
	}
	include "includes/functions.php";
	send_archived($_POST['email'],$_POST['convoID'],$result['name'],$result['email'],$agent,$customer);
	$output = '<div class="success">Email Sent!</div>';
}

// delete entry 
if(!empty($_GET['delete'])) {
	$fetch = db_query("SELECT * FROM leads WHERE id = '".$_GET['delete']."' ");
	$fetch_result = db_fetch_array($fetch);
	db_query("DELETE FROM leads WHERE id = '".$_GET['delete']."' ");
	db_query("DELETE FROM archive WHERE convoID = '".$fetch_result['transcript']."' ");
}
// build array of leads
$leads = array();
$count = 0;
	$query = db_query("SELECT * FROM leads ORDER BY id DESC");
		while ($row= db_fetch_array($query)) {
			$leads[$count]["id"] = $row['id'];
			$leads[$count]["name"] = $row['name'];
			$leads[$count]["email"] = $row['email'];
			$leads[$count]["convo"] = $row['transcript'];
			$leads[$count]["date"] = $row['date'];
			$count = $count +1;
		}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Leads and Contacts</title>
<link rel="stylesheet" type="text/css" media="all" href="css/global.css" />
<link rel="stylesheet" type="text/css" media="all" href="css/colorbox.css" />
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery.colorbox-min.js"></script>
<script type="text/javascript" src="js/subs.js"></script>
<script type="text/javascript" src="js/cufon-yui.js"></script>
<script type="text/javascript" src="js/font_400.font.js"></script>
<script type="text/javascript">
$(document).ready(function(){
                Cufon.replace('h4,h3,h2,h1,label,a,th');
                setTimer('<?=$_SESSION['username'];?>');
                setChecker();
                setInterval("setChecker();",10000);
                setInterval("setTimer('<?=$_SESSION['username'];?>');",120000);
		$(".read_convo").colorbox({opacity:0.9});
});
</script>
</head>
<body>
<div id='popup'><div><h3>You have a new message!</h3><p>Head over to the dashboard to respond.</p></div></div>
<div id="main_container">
<div class="container_12">
 <div class="grid_9">
        <h1 class="ls"><img src="images/chat.png" alt="Live Support" title="Live Support" width="42" />&nbsp;&nbsp;Leads and Contacts</h1>

        </div>
        <div class="grid_3">
                <ul class="navigation">
                        <li><a href="admin.php"><img src="images/navhome.png" alt="Dashboard" title="Dashboard" width="40" style="margin-right:10px;"/></a></li>
                        <li><a href="leads.php"><img src="images/navleads.png" alt="Leads" title="Leads" width="40" style="margin-right:10px;"/></a></li>
                        <li><a href="users.php"><img src="images/navusers.png" alt="User Admin" title="User Admin" width="40" style="margin-right:10px;"/></a></li>
                        <li><a href="maint.php"><img src="images/navmaint.png" alt="Maintenance" title="Maintenance" width="40" style="margin-right:10px;" /></a></li>
                </ul>

        </div>
        <div class="clear">&nbsp;</div>
	<div class="grid_12"><div class="heading_light">&nbsp;</div></div>
        <div class="clear">&nbsp;</div>

	<div class="grid_12"><?=$output;?></div>
	<div class="clear">&nbsp;</div>

	<div class="grid_12">
	<p>This page lists the details of customers who have contacted you via live support, and have consented for their email address to be stored so that they can be contacted later if required.  The conversation record holds a text backup of the conversation that you had with the customer.</p>
	</div>
	<div class="clear">&nbsp;</div>
	<div class="grid_12">
		<table width="100%" id="leads">
		<tr>
		<th class="odd">Customer Name</th>
		<th class="odd">Email Address</th>
		<th class="odd">Archived Converstaion</th>
		<th class="odd">Date</th>
		<th class="blank">&nbsp;</th>
		</tr>
		<?
			$class="even";
			$limit = count($leads);
			for ($i = 0; $i < $limit; $i ++) {
				echo '<tr>';
				echo '<td class="'.$class.'">';
				echo $leads[$i]["name"];
				echo '</td>';
				echo '<td class="'.$class.'">';
				echo $leads[$i]["email"];
				echo '</td>';
				echo '<td class="'.$class.'"><a href="includes/read.php?id=';
				echo $leads[$i]["convo"];
				echo '" class="read_convo">Read archived conversation</a></td>';
				echo '<td class="'.$class.'">';
				echo $leads[$i]["date"];
				echo '</td>';
				echo '<td class="'.$class.'">';
				echo '<a href="leads.php?delete='.$leads[$i]["id"].'"><img src="images/icons/crossb.png" width="17" alt="Delete" title="Delete" /></a>';
				echo '</td>';
				echo '</tr>';
				if($class == "odd") {
					$class = "even";
				} else if($class == "even") {
					$class = "odd";
				}
			}
		?>
		</table>

	</div>

</div>
<div class="clear">&nbsp;</div>
</div>
<div class="clear">&nbsp;</div>
<span id="audio_alert"></span>
</body>
</html>
