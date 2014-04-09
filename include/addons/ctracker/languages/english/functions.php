<?php
########################################
#									   #
#   (C) 2007 by CTXtra				   #
#	http://www.ctxtra.de			   #
#									   #
#	Version: V1.5					   #
#									   #
########################################

$txt_functions[1] = ''; // nicht vergeben

$txt_functions[2] = 'allow_url_fopen() is: <b>off</b>! Open php.ini and change allow_url_fopen from "off" to "on".';

$txt_functions[3] = 'Error! Please correct the red marked fields.';

// Spam meldung
$txt_functions[4] = 'SPAM detected!';
$txt_functions[5] = 'You tried to spam! Your data has been logged and saved!';
$txt_functions[6] = 'If this is an misstake, please contact the Admin by E-Mail'; // ... your_email auto add
$txt_functions[7] = '!';

// Bad-IP meldung
$txt_functions[8] = 'Sorry, our site is blocked for you!';
$txt_functions[9] = '<u><b>Reason:</b></u><br />Your IP ('.$_SERVER['REMOTE_ADDR'].') is blocked by the system!';

// Email at Admin
$txt_functions[10] = 'Hello '.$ct_db_user.',';
$txt_functions[11] = "CTXtra has blocked on ".date("d.m.Y")." at ".date("H:i")." o´clock on ".$_SERVER['HTTP_HOST']." one or more attacks.";
$txt_functions[12] = 'Attack blocked!';

// Wurm meldung
$txt_functions[13] = 'You tried to crack our site!';
$txt_functions[14] = 'Your data has been logged and saved!';

// Bot meldung
$txt_functions[15] = 'BOT recognized!';
$txt_functions[16] = 'Your data has been identified as an BOT!';

?>