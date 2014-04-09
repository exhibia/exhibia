<?php
include "includes/base.php";
// fetch config
$fetch = db_query("SELECT * FROM config ");
$config = db_fetch_array($fetch);
if(isset($_POST['send_email'])) {
	$output = "";
	$errors = 0;
	if($_POST['email'] == "") { $errors = 1; $output = $output . "Please enter an email address<br />"; }
	if($_POST['name'] == "" ) { $errors = 1; $output = $output . "Please enter your name<br />"; }
	if($_POST['message'] == "" ) { $errors = 1; $output = $output . "Please enter your message<br />"; }
	if($errors == 0) {
	// send email
	$to = $config['email'];
        $subject = "Message From ".$_POST['name']." via live support";
        $sender = $_POST['name'];
        $headers = 'From: ' . $sender . "\r\n" .
        'Reply-To: ' . $_POST['email'] . "\r\n" .
        'X-Mailer: PHP/' . phpversion();
	$sendMail = @mail($to, $subject, $_POST['message'], $headers);	

	
	$output = '<div class="success"><p>Email Sent</p></div>';
	$email_sent = "true";
	} else {
	$output = '<div class="error"><p>' . $output . '</p></div>';
	}

}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Leave us a message</title>
<base href="<?php echo $SITE_URL;?>" />
<link rel="stylesheet" type="text/css" media="all" href="css/client.css" />

<script type="text/javascript" src="js/cufon-yui.js"></script>
<script type="text/javascript" src="js/font_400.font.js"></script>
<script type="text/javascript">
$(document).ready(function(){
                Cufon.replace('#live_support h4, #live_support h3, #live_support h2, #live_support h1,#live_support label, #live_support a');
});	
</script>
</head>
<body>
<div class="container" id="live_support">
	
				<p><?=$output;?></p>
				<?php if(isset($email_sent)) { ?>
					<p><?=$config['thankYouMessage'];?></p>
					<p><a href="#" onClick="window.close()"><span class="red">Close Window</span></a></p>
				<?php } else { ?>
				<p><?=$config['leaveAMessage'];?></p>

	<div class="centered_container pale_blue" style="width:300px; margin-top:20px;">
	<form method="post" action="<?=$_SERVER['PHP_SELF'];?>" >
		<label for="name">Your Name <span class="red">*</span></label><br>
			<input type="text" name="name" id="name" class="input_field thin" /><br>
		<label for="email">Your Email Address <span class="red">*</span></label><br>
			<input type="text" name="email" id="email" class="input_field thin"><br>
		<label for="message">Your Message<span class="red">*</span></label><br>
			<textarea name="message" id="message" class="input_field" rows="4" cols="35"></textarea><br>
				<input type="submit" name="send_email" id="send_email" class="input_field submit" value="Send Email" />
	</form>
	</div>
	<?php } ?>
</div><!--- END CONTAINER -->
</body>
</html>
<?php ob_flush(); ?>

