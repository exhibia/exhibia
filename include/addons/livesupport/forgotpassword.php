<?php 
// mysql interaction
include "includes/base.php";
// check for form input
if(!empty($_POST['submit'])) {
$username = $_POST['username'];
$username = db_real_escape_string($username);
$query = "SELECT *
                FROM users
                WHERE username = '$username';";
$result = db_query($query);
if(db_num_rows($result) < 1) //no such user exists
{
        global $output;
        $output = '<div class="error"><p>Unable to find that username</p></div>';
} else {
$userData = db_fetch_array($result);
$password = "";

function rand_str($length = 10, $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890') {
    global $password;
    $chars_length = (strlen($chars) - 1);
    $string = $chars{rand(0, $chars_length)};
    for ($i = 1; $i < $length; $i = strlen($string))
    {
        $r = $chars{rand(0, $chars_length)};
        if ($r != $string{$i - 1}) $string .=  $r;
    }
    $password = $string;
}
rand_str($length = 10, $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890');

$message = "Your new password is : \n";
$message = $message . $password . "\n" . "Please login, then change your password via the users screen";
$hash = sha1($password);

	$to = $userData['email'];
        $subject = "Live Support Password Reset";
        $sender = "Webmaster";
        $headers = 'From: ' . $sender . "\r\n" . 'Reply-To: ' . $userData['email'] . "\r\n" . 'X-Mailer: PHP/' . phpversion();
        $sendMail = @mail($to, $subject, $message, $headers);
	if($sendMail) {
	db_query("UPDATE users SET password = '".$hash."' WHERE username ='".$_POST['username']."' ");
	$output = '<div class="success"><p>New Password sent!</p></div>';
	}
}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Password Reset</title>
<link rel="stylesheet" type="text/css" media="all" href="css/global.css" />
<link href="css/colorbox.css" rel="stylesheet" type="text/css" />
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery.colorbox.js"></script>
<script type="text/javascript" src="js/cufon-yui.js"></script>
<script type="text/javascript" src="js/font_400.font.js"></script>
<script type="text/javascript">
$(document).ready(function(){
                Cufon.replace('h4,h3,h2,h1,label,a');
});
</script>
</head>
<body>
	<div id="login_box">
	<h3><img src="images/icons/ls.png" alt="login" title="login" width="52" style="vertical-align:middle;"> - Reset Password</h3>
	<?=$output;?>
	<p>Please enter your username, an email will be sent to the email address associated with your username with a new password.</p>
	<form method="post" action="forgotpassword.php">
                <label for="username">Username</label><br />
                <input type="text" name="username" id="username" class="input_field" size="40"><br />
                <input type="submit" name="submit" value="Reset Password" class="input_field submit"/>
	
	</form>
	</div>	

</body>
</html>
