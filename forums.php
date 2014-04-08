<?php
	include("config/connect.php");
	include("functions.php");
	$changeimage = "forum";	

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <?php include("$BASE_DIR/page_headers.php"); ?>
</head>
<body class="single">
<?php
      if(file_exists("$BASE_DIR/include/$template/forums/index.php")){
	  include("$BASE_DIR/include/$template/forums/index.php");
      }else{
       	  include("$BASE_DIR/include/forums/index.php");
		
      }
?>
</body>
</html>
