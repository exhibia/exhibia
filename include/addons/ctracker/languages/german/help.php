<?php
########################################
#									   #
#   (C) 2007 by CTXtra				   #
#	http://www.ctxtra.de			   #
#									   #
#	Version: V1.5					   #
#									   #
########################################

$txt_help[1] = 'Hilfe und Erkl&auml;rungen';

$txt_help[2] = 'allgemeine Hinweise:';
$txt_help[3] = '<li>Angriffe werden seit der v1.3 nur einmal geloggt. Nach jedem Angriff wird die IP sofort in den IP-Filter eingetragen. Versucht diese IP dann erneut auf Deine Seite zuzugreifen, wird sie vom CTXtra "ausgesperrt".<br /><br /></li>
				 <li>Klicke auf "[ mehr ]" um Details &uuml;ber diesen Angriff zu bekommen. Es &ouml;ffnet sich eine neue Seite, diese ist Drucker optimiert. Somit kannst Du geziehlte Angriffe auch Drucken und Archivieren.<br /><br /></li>
	 			 <li>Deine Email-Adresse wird im ASCII-Code ausgegeben. Das sch&uuml;tzt Deine Email vor Spam (PHP-Funktion: <a href="http://de.php.net/manual/de/function.ord.php" target="_blank">ord()</a> ).</li>';

$txt_help[4] = 'Wie werden die Logfiles gesch&uuml;tzt?';
$txt_help[5] = '<li>Die Logfiles werden während der Installation im Ordner <b>'.$ct_filedir .'/log/</b> angelegt. Dieser Ordner wird automatisch mit einem htaccess-Schutz gesch&uuml;tzt. Die Zugangsdaten sind die selben wie f&uuml;r den Adminbereich.</li>';

$txt_help[6] = 'IP Filter:';
$txt_help[7] = '<li>Der IP-Filter sch&uuml;tzt Deine Seite vor erneuten Zugriffen von IP´s, die versucht haben, Deine Seite anzugreifen. Sobald ein Angriff auf Deine Seite erkannt wurde, wird die IP automatisch in den Filter eingetragen.<br /><br /></li>
				 <li><u>Die linke Liste:</u><br />
					 In der linken Liste kannst Du IP`s eintragen. <b>Jede IP muss in einer extra Zeile stehen.</b><br /><br /></li>
				 <li><u>Die rechte Liste:</u><br />
					 In der rechten Liste hast Du IP´s, die Live von <a href="'.$ctxtra_url.'" target="_blank">'.$ctxtra_url.'</a>  verf&uuml;gbar sind. Diese IP`s haben versucht, verschiedene Domains anzugreifen, oder dort zu spamen.</li>';

$txt_help[8] = 'SPAM Filter richtig einbauen:';
$txt_help[9] = '<li>Wie Du den SPAM-Filter richtig einbaust, kannst Du in unserem Forum nachlesen. [ <a href="http://www.wupmedia.de/smf/index.php/topic,44" target="_blank">zu den Anleitungen</a> ]</li>';

$txt_help[10] = 'Logfiles k&ouml;nnen nicht angelegt werden:';
$txt_help[11] = '<li>Wenn die Logfiles nicht angelegt werden k&ouml;nnen, &uuml;berpr&uuml;fe bitte zuerst, ob der Ordner <b>'.$ct_filedir.'/log/</b> existiert und die chmod-Rechte 0777 zugewiesen sind.<br /><br /></li>
				 <li>Wenn der Ordner existiert, die Schreibrechte stimmen und die Dateien aber trotzdem nicht angelegt werden k&ouml;nnen, dann erstelle folgende leere Textdateien und kopiere sie in das Verzeichnis';

$txt_help[12] = 'Ordner /log/ wird nicht gesch&uuml;zt:';
$txt_help[13] = '<li>Erstelle zwei leere Dateien mit den Namen <b>.htaccess</b> und <b>.htpasswd</b> und lege sie in das Verzeichniss <b>'.$ct_filedir.'/log/</b>.<br /><br /></li>
				 <li>F&uuml;ge folgendes in die <b>.htaccess</b> Datei ein:';

$txt_help[14] = 'F&uuml;ge folgendes in die <b>.htpasswd</b> Datei ein:';
$txt_help[15] = '<li>Der Benutzername und das Passwort sind die selben, die Du unter Einstellungen eingegeben hast.<br /><br />
				 <span style="color:#ff0000"><b>ACHTUNG:</b> Wenn Du den htaccess-Schutz per Hand erstellst und unter "Einstellungen" etwas &auml;nderst, &auml;ndert sich weder das Passwort noch der Benutzername.</span></li>';

$txt_help[16] = 'Wie und wo binde binde ich das Copyright vom CTXtra ein?';
$txt_help[17] = 'Das Copyright l&auml;sst sich mit der Variable <b>$ctxtra_footer</b> an beliebiger Stelle in deinem Code einf&uuml;gen.';

$txt_help[18] = 'oder';

$txt_help[19] = 'Einzelne Anleitungen f&uuml;r den Einbau des CTXtra in das SMF, WBB, phpBB, phpKit... findest Du auf unserer Startseite vom <a href="http://www.wupmedia.de/smf" target="_blank">Forum</a> unter "Short Guide" !';

$txt_help[20] = 'wenn Du Windows nutzt dann f&uuml;ge folgendes in die <b>.htpasswd</b> Datei ein:'

?>