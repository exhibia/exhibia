<?php 
// create session so we can keep track of users
session_start();
// define path to support directory
$path = "./";
// include php
include $path . "includes/client.php";
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Live Assist!</title>

<!--- YOU NEED TO INCLUDE THE FOLLOWING LINES IN YOUR HEAD SECTION -->
<!--- If you are already including a jquery library, you can omit that line as long as the one you are using is the same release or greater -->

<link rel="stylesheet" type="text/css" media="all" href="<?=$path;?>css/client.css" />
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script type="text/javascript" src="<?=$path;?>js/support.js"></script>
<script type="text/javascript" src="<?=$path;?>js/cufon-yui.js"></script>
<script type="text/javascript" src="<?=$path;?>js/font_400.font.js"></script>

<!-- END OF REQUIRED HEAD ELEMENTS -->

</head>
<body>


<!--- CALL THIS FUNCTION TO OUTPUT STATUS BOX -->
<?php
online();
?>
</body>
</html>

