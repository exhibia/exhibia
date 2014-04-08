<?
	include("config/connect.php");
        include("sendmail.php");
	include("functions.php");
	include("common/sitesetting.php");
        if($_SERVER['REMOTE_ADDR']!='')
            exit;
        
	function SendCounterMail($butlerstat1, $updatestat1) {	
		$content1 = '';

		$content1 .= "<font style='font-size: 10px;font-family: Arial, Helvetica, sans-serif;color: #333333;'>".
						 "</font><br>"."<br>".
						 "<p align='center' style='font-size: 14px;font-family: Arial, Helvetica, sans-serif;font-weight:bold;'>Counter Information</p>".
						 "<br>"."<table border='0' cellpadding='3' cellspacing='0' width='100%' align='center' class='style13'>";
		
		if ( $butlerstat1 ) $content1 .= "<tr style='font-size: 10px;font-family: Arial, Helvetica, sans-serif;color: #333333;'>".
													"<td>Butler file is not running so it is now running by this process.</td></tr>";

		if ( $updatestat1 ) $content1 .= "<tr style='font-size: 10px;font-family: Arial, Helvetica, sans-serif;color: #333333;'>".
													"<td>Records file is not running so it is now running by this process.</td></tr>";

		$content1 .= "<tr style='font-size: 10px;font-family: Arial, Helvetica, sans-serif;color: #333333;'>".
						 "<td>This mail is testing for check file running in this site.</td></tr></table>";

		$subject = "Counter Information";
		$from=$adminemailadd;//= "newuser@thissite.com";
		$email	= $adminemailadd;
		//SendHTMLMail($email, $subject, $content1, $from);
	}
	
	$butlerstat = FALSE;
	$updatestat = FALSE;
	
	$ressel = db_query("select referral_bids from auction_pause_management where id=3");
	if ( db_num_rows($ressel) == 0 ) {
		db_free_result($ressel);

		db_query("Insert into auction_pause_management (referral_bids) values (1)");
		$ressel = db_query("select referral_bids from auction_pause_management where id=3");
	}

	$oldvalue1 = db_result($ressel, 0);
	db_free_result($ressel);
	
	$ressel = db_query("select referral_bids from auction_pause_management where id=4");
	if ( db_num_rows($ressel) == 0 ) {
		db_free_result($ressel);

		db_query("Insert into auction_pause_management (referral_bids) values (1)");
		$ressel = db_query("select referral_bids from auction_pause_management where id=4");
	}	

	$oldvalue = db_result($ressel, 0);
	db_free_result($ressel);

	usleep(0.5 * 1000000);

	$ressel = db_query("select referral_bids from auction_pause_management where id=3");
	$newvalue1 = db_result($ressel, 0);
	db_free_result($ressel);
	
	$ressel = db_query("select referral_bids from auction_pause_management where id=4");
	$newvalue = db_result($ressel, 0);
	db_free_result($ressel);
	
	//if ( $oldvalue1 == $newvalue1 ) {
		$output1 = exec("php ".getcwd()."/update_butler.php >/dev/null &");
		$butlerstat = TRUE;
	//}

	//if ( $oldvalue == $newvalue ) {
		$output = exec("php ".getcwd()."/update_records.php >/dev/null &");
		$updatestat = TRUE;
	//}
	//SendCounterMail($butlerstat, $updatestat);

	//db_close($db);
	
	
	
 $addons =  loadAddonsAsArray($DBSERVER,$USERNAME,$PASSWORD,$DATABASENAME);

$admin = db_num_rows(db_query("select * from registration where id = '$_SESSION[userid]' and admin_user_flag != '0'"));

    foreach ($addons as $key => $value){


	if(file_exists("include/addons/$value/cron.php")){

	  shell_exec("php include/addons/$value/cron.php >/dev/null &");


	
    }

 }
?>
