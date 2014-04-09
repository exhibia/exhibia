<?php 
// create session so we can keep track of users
session_start();
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
// mysql interaction
include "includes/base.php";
// update keepalive
db_query("UPDATE users SET keepAlive = '".time()."' WHERE username = '".$_SESSION['username']."' ");
// chekc if admin or not
if($_SESSION['admin'] == "No") {$output = '<div class="error">You need administrator rights to view this page. However you can edit your user settings by <a href="includes/alterStandard.php?user='.$_SESSION['username'].'" class="edit_user" >clicking here</a></div>'; }
// check for form input
if(isset($_POST['delete'])) {
	// make sure there is at least 1 admin left
	$check = db_query("SELECT * FROM users WHERE username = '".$_POST['user']."' ");
	$result = db_fetch_array($check);
	if($result['admin'] == "No") {
		db_query("DELETE FROM users WHERE username = '".$_POST['user']."' ");
		$output = '<div class="success">User deleted</div>';
	}
	if($result['admin'] == "Yes") {
	$check = db_query("SELECT * FROM users WHERE admin = 'Yes' ");
	if(db_num_rows($check) > 1) {
		db_query("DELETE FROM users WHERE username = '".$_POST['user']."' ");
		$output = '<div class="success">User deleted</div>';
	} else {
	$output = '<div class="error">There needs to be at least 1 administrator active at all times.</div>';
	}
	}
}
if(isset($_POST['update_user'])) {
	$errors = 0;
        if(empty($_POST['name'])) { $errors = 1; $output = $output . "Please enter a name<br />"; }
        if(empty($_POST['email'])) { $errors = 1; $output = $output . "Please enter an Email Address<br />"; }
        if(empty($_POST['username'])) { $errors = 1; $output = $output . "Please enter a Username<br />"; }
	
	 if($errors == 0) {
		echo $_POST['user'];
           	if($_POST['password'] != "" ) {
		$hash = sha1($_POST['password']);
		$add = db_query("UPDATE users SET name = '".$_POST['name']."', password = '".$hash."', email = '".$_POST['email']."', admin = '".$_POST['admin']."' WHERE username = '".$_POST['username']."' ");
                } else {
		$add = db_query("UPDATE users SET name = '".$_POST['name']."', email = '".$_POST['email']."', admin = '".$_POST['admin']."' WHERE username = '".$_POST['username']."' ");
		}
		if($add) {
                        $output = '<div class="success">User updated with no problems.</div>';
                        } else {
                        $output = '<div class="error">Some errors occured, here is the output :' . db_error() . '</div>';
                }


        } else {
                $output = '<div class="error">' . $output . '</div>';
        }

	
}
if(!empty($_POST['add'])) {
$output = "";

	$errors = 0;
	if(empty($_POST['name'])) { $errors = 1; $output = $output . "Please enter a name<br />"; }
	if($_POST['admin'] == "select") { $errors = 1; $output = $output . "Please select an administrator option<br />"; }	
	if(empty($_POST['password'])) { $errors = 1; $output = $output . "Please enter a Password<br />"; }
	if(empty($_POST['email'])) { $errors = 1; $output = $output . "Please enter an Email Address<br />"; }
	if(empty($_POST['username'])) { $errors = 1; $output = $output . "Please enter a Username<br />"; }

	if($errors == 0) {
		$hash = sha1($_POST['password']);
		$check = db_query("SELECT * FROM users WHERE username = '".$_POST['username']."' ");
		$total = db_num_rows($check);
		if($total != 0) { $errors = 1; $output = $output . "Username is already in use<br />"; }
		$check = db_query("SELECT * FROM users WHERE email = '".$_POST['email']."' ");
                $total = db_num_rows($check);
                if($total != 0) { $errors = 1; $output = $output . "Email Address is already in use<br />"; }

		
		if($errors == 0 ) {
		$add = db_query("INSERT INTO users (name,password,username,email,admin) VALUES ('".$_POST['name']."','".$hash."','".$_POST['username']."','".$_POST['email']."','".$_POST['admin']."') ");
		if($add) {
			$output = '<div class="success">User added with no problems.</div>';
			} else {
			$output = '<div class="error">Some errors occured, here is the output :' . db_error() . '</div>';
		}
		} else {$output = '<div class="error">' . $output . '</div>';}
	} else {
		$output = '<div class="error">' . $output . '</div>';
	}		
}
$current_users = array();
$fetch = db_query("SELECT * FROM users ");
$inc = 0;
while ($row = db_fetch_array($fetch)) {
	$current_users[$inc]["name"] = $row['name'];
	$current_users[$inc]["username"] = $row['username'];
	$current_users[$inc]["admin"] = $row['admin'];
	$inc = $inc + 1;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Manage Users</title>
<link rel="stylesheet" type="text/css" media="all" href="css/global.css" />
<link rel="stylesheet" type="text/css" media="all" href="css/colorbox.css" />
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script type="text/javascript" src="js/subs.js"></script>
<script type="text/javascript" src="js/jquery.colorbox-min.js"></script>
<script type="text/javascript" src="js/cufon-yui.js"></script>
<script type="text/javascript" src="js/font_400.font.js"></script>
<script type="text/javascript">
$(document).ready(function(){
                Cufon.replace('h4,h3,h2,h1,label,a');
		setTimer('<?=$_SESSION['username'];?>');
                setChecker();
                setInterval("setChecker();",10000);
                setInterval("setTimer('<?=$_SESSION['username'];?>');",120000);
		$(".delete_user").colorbox({opacity:0.9});
		$(".edit_user").colorbox({opacity:0.9});
});
</script>
</head>
<body>
<div id='popup'><div><h3>You have a new message!</h3><p>Head over to the dashboard to respond.</p></div></div>
<div id="main_container">
<div class="container_12">
	<div class="grid_9">
	<h1 class="ls"><img src="images/chat.png" alt="Live Support" title="Live Support" />&nbsp;&nbsp;User Managment</h1>
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
	<?php if($_SESSION['UsErOfAdMiN'] == 'admin') { ?>
	<div class="grid_6">
		<div class="heading_solid">
			<h3>Current Users</h3>
		</div>
	<table style="width:100%;">
	<tr><th>Name</th><th>Administrator?</th><th>Edit</th><th>Delete</th></tr>
	<?php
	$limit = count($current_users);
	for($i = 0; $i < $limit; $i ++ ){
		echo '<tr><td>';
		echo '<img src="images/icons/userm.png" width="24" alt="'.$current_users[$i]["name"].'" title="'.$current_users[$i]["name"].'" />&nbsp;&nbsp;';
		echo $current_users[$i]["name"];	
		echo '</td><td>';
		echo $current_users[$i]["admin"];
		echo '</td><td>';
		echo '<a href="includes/alterUser.php?edit='.$current_users[$i]["username"].'" class="edit_user"><img src="images/icons/edit.png" width="20" alt="Edit '.$current_users[$i]["name"].'" title="Edit '.$current_users[$i]["name"].'" /></a>';
		echo '</td><td>';
		echo '<a href="includes/alterUser.php?delete='.$current_users[$i]["username"].'" class="delete_user"><img src="images/icons/crossb.png" width="20" alt="Delete '.$current_users[$i]["name"].'" title="Delete '.$current_users[$i]["name"].'" /></a>';
		echo '</td></tr>';	
	}
	?>
	</table>
	</div>

	<div class="grid_6">
		<div class="heading_solid">
			<h3>Add Users</h3>
		</div>
 	<form method="post" action="users.php">
		<label for="name">Name</label><br />
		<input type="text" name="name" id="name" class="input_field" size="40"><br />
		<label for="admin">Administrator?</label><br />
		<select name="admin" id="admin" class="input_field tall"><option>select</option><option>Yes</option><option>No</option></select><br />
		<label for="password">Password</label><br />
		<input type="password" name="password" id="password" class="input_field" size="40"><br />
		<label for="email">Email Address</label><br />
		<input type="text" name="email" id="email" class="input_field" size="40"><br />
		<label for="username">Username</label><br />
		<input type="text" name="username" id="username" class="input_field" size="40"><br />
		<input type="submit" name="add" id="add" value="Add User" class="input_field submit"/>

	</form>
        </div>
	<?php } ?>



</div>
<div class="clear">&nbsp;</div>
</div>
<div class="clear">&nbsp;</div>
<span id="audio_alert"></span>
</body>
</html>
