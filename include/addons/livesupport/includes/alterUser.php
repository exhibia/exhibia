<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Manage Users</title>
<link rel="stylesheet" type="text/css" media="all" href="../css/global.css" />
</head>
<body>
<div id="padded_box">
<?php
if(!empty($_GET)) {
	if(isset($_GET['delete'])) {
	echo '<form method="post" action="users.php">';
	echo '<p>Are you sure you want to delete ' . $_GET['delete'] . ' ?</p>';
	echo ' 
	<input type="hidden" name="user" id="user" value="'.$_GET['delete'].'" />
	<button type="submit" name="cancel" value="cancel">Cancel</button>
	<button class="del" type="submit" name="delete" value="delete">Delete</button>
	</form>
	';
	}
	if(isset($_GET['edit'])) {	
	include "base.php";
	$get_info = db_query("SELECT * FROM users WHERE username = '".$_GET['edit']."' ");
	$info = db_fetch_array($get_info);
	?>
	<form method="post" action="users.php">
                <label for="name">Name</label><br />
                <input type="text" name="name" id="name" class="input_field" size="40" value="<?=$info['name'];?>"><br />
                <label for="admin">Administrator?</label><br />
                <select name="admin" id="admin" class="input_field tall">
		<?
		if($info['admin'] == "Yes") {
		echo '<option>Yes</option><option>No</option>';
		} else {
		echo '<option>No</option><option>Yes</option>';
		}
		?>
		</select><br />
                <label for="password">Password ( leave blank if you wish to keep current password )</label><br />
                <input type="password" name="password" id="password" class="input_field" size="40"><br />
                <label for="email">Email Address</label><br />
                <input type="text" name="email" id="email" class="input_field" size="40" value="<?=$info['email'];?>"><br />
		<label for="username">Username ( non editable )</label><br />
                <input type="text" name="username" id="username" class="input_field" size="40" value="<?=$info['username'];?>" READONLY><br />
                <input type="submit" name="update_user" id="update_user" value="Update User" class="input_field submit"/>

        </form>
	<?
	}
}
?>
</div>
</body>
</html>
