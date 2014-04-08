<?

	include("config/connect.php");

	include("session.php");

	include("functions.php");

        

	$changeimage = "myaccount";



	$uid = $_SESSION["userid"];

	

	if($_POST["submit"]!="" && $_POST["unsubscribecheck"]!="")

	{

		$qryupd = "update registration set account_status='2' where id='$uid'";

		db_query($qryupd) or die(db_error());

		header("location: logout.php");

		exit;

	}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

 <?php include("page_headers.php"); ?>


<script language="javascript">

	function check()

	{

		if(document.unsubscribe.unsubscribecheck.checked==false)

		{

			alert("Please Tick the check box to confirm closure of your account!");

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
