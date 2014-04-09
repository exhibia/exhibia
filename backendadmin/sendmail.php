<?php
  function SendMail($to,$subject,$mailcontent,$from)
  {
    $array = split("@",$from,2);
    $SERVER_NAME = $array[1];
    $username =$array[0];
    $fromnew = "From: $username@$SERVER_NAME\nReply-To:$username@$SERVER_NAME\nX-Mailer: PHP";
     mail($to,$subject,$mailcontent,$fromnew);
  }
  function SendHTMLMail($to,$subject,$mailcontent,$from)
  {
    $array = split("@",$from,2);
    $SERVER_NAME = $array[1];
    $username =$array[0];
    $headers = "From: $username@$SERVER_NAME\nReply-To:$username@$SERVER_NAME\nX-Mailer: PHP\n";

    $limite = "_parties_".md5 (uniqid (rand()));

    $headers .= "Date: ".date("l j F Y, G:i")."\n";
    $headers .= "MIME-Version: 1.0\n";
    $headers .= "Content-Type: text/html;\n";
    $headers .= " boundary=\"----=$limite\"\n\n";

	/*$eol = "\n";
	$headers .= 'From: Jonny <monitor@Pennyauctionsoft.com>'.$eol; 
	$headers .= 'Reply-To: Jonny <monitor@Pennyauctionsoft.com>'.$eol; 
	$headers .= 'Return-Path: Jonny <monitor@Pennyauctionsoft.com>'.$eol;    /* 
	
	/*$mime_boundary=md5(time()); 
	
	# HTML Version 
	$msg .= "--".$mime_boundary.$eol; 
	$msg .= "Content-Type: text/html; charset=iso-8859-1".$eol; 
	$msg .= "Content-Transfer-Encoding: 8bit".$eol; 
	$msg .= $mailcontent.$eol.$eol; 
	*/
    mail($to,$subject,$mailcontent,$headers);
  }

?>