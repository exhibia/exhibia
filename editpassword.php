<?php
	include("config/connect.php");
	include("session.php");
	include("functions.php");
        
	$changeimage = "myaccount";
	$uid = $_SESSION["userid"];
	if($_POST["submit"]!="")
	{
		$pass = $_POST["newpass"];
		$qryupd = "update registration set password='$pass' where id='$uid'";
		db_query($qryupd) or die(db_error());
		$msg=1;
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <?php include("page_headers.php"); ?>

<!--[if lte IE 6]>
<link href="css/menu_ie.css" rel="stylesheet" type="text/css" />
<![endif]-->
<script language="javascript">
	function check()
	{
		if(document.newpassword.newpass.value=="")
		{
			alert("<?php echo PLEASE_ENTER_NEW_PASSWORD; ?>");
			document.newpassword.newpass.focus();
			return false;
		}	
		
		if(document.newpassword.newpass.value.length<6)
		{
			alert("<?php echo PASSWORD_IS_TOO_SHORT; ?>");
			document.newpassword.newpass.focus();
			document.newpassword.newpass.select();
			return false;
		}	

		if(document.newpassword.cnfnewpass.value=="")
		{
			alert("<?php echo PLEASE_ENTER_CONFIRM_NEW_PASSWORD; ?>");
			document.newpassword.cnfnewpass.focus();
			return false;
		}	
		
		if(document.newpassword.newpass.value!=document.newpassword.cnfnewpass.value)
		{
			alert("<?php echo PASSWORD_MISMATCH; ?>");
			document.newpassword.cnfnewpass.focus();
			document.newpassword.cnfnewpass.select();
			return false;
		}
	}
</script>
</head>

<body class="single">
     <?php
         
         
	      foreach($addons as $key => $value){

		if(file_exists("include/addons/$value/$template/top_bar.php")){
		
		    include("include/addons/$value/$template/top_bar.php");
		}else
		if(file_exists("include/addons/$value/top_bar.php")){
		

		    include_once("include/addons/$value/top_bar.php");

		}


	      }
	      if(file_exists($BASE_DIR . "/include/$template/user_pages/" . basename($_SERVER['PHP_SELF'])  )  ) {
		include($BASE_DIR . "/include/$template/user_pages/" . basename($_SERVER['PHP_SELF']));
		}else{
		
		include($BASE_DIR . "/include/user_pages/" . basename($_SERVER['PHP_SELF']));
		
		}
		


	  ?>
</body>
</html>
