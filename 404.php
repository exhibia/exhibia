<?php include("config/connect.php"); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<title>404</title>
<meta http-equiv="REFRESH" content="0;url=<?php echo ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/'.($subfolder!=''?$subfolder.'/':''); ?>"></HEAD>
<BODY>
</BODY>
</HTML>
