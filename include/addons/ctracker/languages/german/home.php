<?php
########################################
#									   #
#   (C) 2007 by CTXtra				   #
#	http://www.ctxtra.de			   #
#									   #
#	Version: V1.5					   #
#									   #
########################################

$txt_home[1]	= 'Willkommen im CTXtra ACP';
$txt_home[2]	= 'heute';
$txt_home[3]	= 'gestern';
$txt_home[4]	= 'Deine letzte Anmeldung war am';
$txt_home[5]	= 'um';
$txt_home[6]	= 'Uhr';
$txt_home[7]	= 'Hallo';
$txt_home[8]	= 'das ist Dein ACP vom CTXtra (Admin-Control-Panel). Hier kannst Du dir alle geloggten Angriffe und SPAM-Eintr&auml;ge 
				   anschauen und auswerten. Du kannst einen Angriff auf Dein System simulieren, um zu testen, ob es durch den
				   CTXtra gesch&uuml;tzt wird. Du kannst auch IP\'s, die dich &auml;rgern, vom System aussperren.
		  	       Hast Du Probleme, W&uuml;nsche oder Anregungen kannst Du im <a href="http://www.wupmedia.de/smf/" target="_blank">
				   Support Forum</a> gerne mit uns Kontakt aufnehmen.';
$txt_home[9]	= 'Aktuelles von';
$txt_home[10]	= 'Seit der Installation am '.date("d.m.Y", $ct_install_time).' wurden insgesamt '.$ct_install_all_attacks.' Angriffe abgewehrt.';
$txt_home[11]	= 'Wurm-Angriff/e abgewehrt. [ <a href="?hack=true">mehr</a> ]';
$txt_home[12]	= 'Seitenzugriff/e durch IP-Filter geblockt. [ <a href="?ipfilter=true">mehr</a> ]';
$txt_home[13]	= 'Eintr&auml;ge durch SPAM-Filter geblockt. [ <a href="?spamfilter=true">mehr</a> ]';
$txt_home[14]	= 'Insgesamt sind '.count_all_logs().' Angriffe geloggt.';
$txt_home[15]	= 'IP\'s befinden sich in Deinem <a href="index.php?ipfilter=true">IP-Filter</a>.';
$txt_home[16]	= 'Online stehen Dir <b>'.$_SESSION['online_ips'].'</b> IP\'s zur Verf&uuml;gung.';
$txt_home[17]	= 'Letztes Update Deiner IP-Liste war am '.date("d.m.y",$updatetime_iplist).' um '.date("H:m",$updatetime_iplist).'.';
$txt_home[18]	= 'Spamwords befinden sich in Deinem <a href="index.php?spamfilter=true">SPAM-Filter</a>.';
$txt_home[19]	= 'Online stehen Dir <b>'.$_SESSION['online_spamwords'].'</b> Spamwords zur Verf&uuml;gung.';
$txt_home[20]	= 'Letztes Update Deiner SPAM-Liste war am '.date("d.m.y",$updatetime_spamlist).' um '.date("H:m",$updatetime_spamlist).'.';
$txt_home[21]	= 'Statistik';
?>