<?php
include "includes/base.php";
// start session
session_start();
// buffer flush
ob_start();
include "includes/date.php";
// divert to chat window if session is active
if(isset($_SESSION['userID'])) {
	header('location:chat.php');
}
// check to make sure someone is actually available
$check = db_query("SELECT available FROM users ");
$available = "no";
while ($row = db_fetch_array($check)) {
	if($row['available'] == "yes") { $available = "yes"; }
}
if($available == "no" ) {
	header('Location: leavemessage.php');
	die();
}
// start chat sessions
if(isset($_POST['start'])) {
if(!empty($_POST['name'])) {
// grab config
$fetch = db_query("SELECT * FROM config ");
$config = db_fetch_array($fetch);
// assign variables
// generate unique user id
$ip = $_SERVER['REMOTE_ADDR'];
$salt = rand(100,999);
$userID = $_POST['name'] . $ip . $salt;
$_SESSION['name'] = $_POST['name'];
$_SESSION['userID'] = $userID;
if(!empty($_POST['email'])) {
	$_SESSION['email'] = $_POST['email'];
} else {
	$_SESSION['email'] = "Not Set";
}
	if(isset($_POST['contactme'])) {
		$contactme = "yes";
	} else {
		$contactme = "no";
	}
// sessions started on ...
$start = time();
// add entry to sql
$query = db_query("INSERT INTO sessions (userID,name,email,initiated,status,contact) 
			VALUES 
			('".$_SESSION['userID']."','".$_SESSION['name']."','".$_SESSION['email']."','".$start."','open','".$contactme."') 
			");
if($query) {
	$timeStamp = date('g:i a');
	$update = db_query("SELECT id FROM sessions WHERE userID = '".$_SESSION['userID']."' ");
	$result = db_fetch_array($update);
	$_SESSION['convoID'] = $result['id'];
	db_query("UPDATE sessions SET convoID = '".$_SESSION['convoID']."' WHERE userID = '".$_SESSION['userID']."' ");
	db_query("INSERT INTO transcript
        (name,message,convoID,time,class)
        VALUES
        ('Admin','".$config['welcome']."','".$_SESSION['convoID']."','".$timeStamp."','admin')
        ");

	header('location:chat.php');
}
} else {
$output = '<div class="error"><p>Please enter your name</p></div>';
}
}
include "includes/base.php";
// fetch config
$fetch = db_query("SELECT * FROM config ");
$config = db_fetch_array($fetch);
?>
<link rel="stylesheet" type="text/css" media="all" href="<?php echo $SITE_URL;?>css/client.css" />
<script type="text/javascript" src="<?php echo $SITE_URL;?>js/cufon-yui.js"></script>
<script type="text/javascript" src="<?php echo $SITE_URL;?>js/font_400.font.js"></script>
<script type="text/javascript">

         function support_login(){
                
                $.ajax({
		    url:"<?php echo $SITE_URL;?>include/addons/livesupport/start.php?",
		    dataType: 'html',
		    type: 'POST',
		    data: $('#support_login').serialize(),
		    success:function(response){
                
		    $('#support_box').html(response);
                }
                
                });
              }
</script>

<div class="container" style="position:relative;top:-40px;">
	<h3 style="position:relative;left:-50px;"><img src="images/icons/ls.png" alt="<?=$config['title'];?>" title="<?=$config['title'];?>" width="54" style="vertical-align:middle;"/>&nbsp;<?=$config['title'];?></h3>
				<p><?=$output;?></p>
				<p><?=$config['loginMessage'];?></p>

	<div class="centered_container pale_blue" style="width:300px; margin-top:20px;">
	<form method="post" action="javascript: support_login();" id="support_login" name="support_login" >
	
		<label for="name">Your Name <span class="red">*</span></label><br>
			<input type="text" name="name" id="name" class="input_field thin" /><br>
		<label for="email">Your Email Address</label><br>
			<input type="text" name="email" id="email" class="input_field thin"/><br>
		<label for="contactme">I would like to be contacted in the future</label>
			<input type="checkbox" name="contactme" id="contactme"/><br>
			<input type="hidden" name="start" id="start" />
			<input type="submit" name="start2" id="start2" class="input_field submit" value="Start Support Session!" />
	</form>
	<p><i><span class="red">*</span> = required field</i></p>
	</div>
</div><!--- END CONTAINER -->

<?php ob_flush(); ?>

