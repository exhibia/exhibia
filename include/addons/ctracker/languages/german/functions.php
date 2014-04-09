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

$txt_functions[2] = 'allow_url_fopen() ist: <b>off</b>! &Ouml;ffne die php.ini und stelle allow_url_fopen von "off" auf "on".';

$txt_functions[3] = 'Es ist ein Fehler aufgetreten. Bitte korrigiere die roten Felder.';

// Spam meldung
$txt_functions[4] = 'SPAM erkannt!';
$txt_functions[5] = 'Sie haben versucht bei uns zu spammen. Ihre Daten wurden geloggt und gemeldet!';
$txt_functions[6] = 'Sollte dies ein Versehen sein, setzen Sie sich bitte mit dem Administrator per Email unter'; // ... your_email auto add
$txt_functions[7] = 'in Verbindung!';

// Bad-IP meldung
$txt_functions[8] = 'Unsere Seite ist f&uuml;r Sie gesperrt!';
$txt_functions[9] = '<u><b>Grund:</b></u><br />Ihre IP ('.$_SERVER['REMOTE_ADDR'].') wurde vom System ausgesperrt!';

// Email at Admin
$txt_functions[10] = 'Hallo '.$ct_db_user.',';
$txt_functions[11] = "der CTXtra hat am ".date("d.m.Y")." um ".date("H:i")." Uhr auf ".$_SERVER['HTTP_HOST']." einen Angriff geblockt.";
$txt_functions[12] = 'Angriff geblockt!';

// Wurm meldung
$txt_functions[13] = 'Sie haben versucht unsere Seite zu cracken!';
$txt_functions[14] = 'Ihre Daten wurden geloggt und gemeldet!';

// Bot meldung
$txt_functions[15] = 'BOT erkannt!';
$txt_functions[16] = 'Sie wurden als BOT idetifiziert!';

?>