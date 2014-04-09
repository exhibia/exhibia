<?php
########################################
#									   #
#   (C) 2007 by CTXtra				   #
#	http://www.ctxtra.de			   #
#									   #
#	Version: V1.5					   #
#									   #
########################################

$txt_wormprotector[1] = 'Sql-injections and Wormattacks';
$txt_wormprotector[2] = 'You can see all sql-injections and wormattacks, which are blocked by CTXtra. Attacks will be loged, the attackers-ip will be written into the ip-filter and is blocked from the system.';
$txt_wormprotector[3] = 'Simulate attacks';
$txt_wormprotector[4] = 'You can simulate attacks on your site to test the CTXtra.';
$txt_wormprotector[5] = 'The correct string to start the attack is <b>index.php?chr(</b>.';
$txt_wormprotector[6] = 'After the simulation, you will be blocked by the system!';
$txt_wormprotector[7] = 'After open the link <b><a href="'.$ct_borddir.'/admin/reset.php">'.$ct_borddir.'/admin/reset.php</a></b> in your browser, in order to remove your IP from list.<br />
						 Or open manually the file <b>'.$ct_borddir.'/log/ct_ips.txt</b> to remove IP';
$txt_wormprotector[8] = 'Start simulation';
$txt_wormprotector[9] = 'attacks blocked!';
$txt_wormprotector[10] = 'possible a simulation - please check';
$txt_wormprotector[11] = 'attack';
$txt_wormprotector[12] = 'attacks';
$txt_wormprotector[13] = 'from';
$txt_wormprotector[14] = 'at';
$txt_wormprotector[15] = 'in hour';
$txt_wormprotector[16] = 'first attack at';
$txt_wormprotector[17] = 'more';
$txt_wormprotector[18] = 'Currently no attacks logged!<br />
						  It is recommended to simulate an attack which shows that CTXtra is working correctly.';
$txt_wormprotector[19] = 'Delete';
$txt_wormprotector[20] = 'Currently your IP.';
$txt_wormprotector[21] = 'entries in the whitelist.';
$txt_wormprotector[22] = 'Insert some signatures, which will not be blocked by CTXtra.
						  Some scripts use query_strings, which will blocked by CTXtra.
						  You can insert these signatures in the whitelist.<br /><br /><b>Signatures will be separated by an comma (,). Blanks in the query_strings will be taken over!!!</b><br /><br />
						  <u>F.e.</u>:<br />word1,&nbsp;&nbsp;&nbsp;word2&nbsp;,word3,word4,&nbsp;word5&nbsp;';
$txt_wormprotector[23] = 'Save';
$txt_wormprotector[24] = 'Saved !';
$txt_wormprotector[25] = 'Each entry is an safety risk! So be carefull to insert the commands!';
$txt_wormprotector[26] = 'Download logfile';

$txt_wormprotector[27] = 'IP filtered';
$txt_wormprotector[28] = 'IP not filtered';
$txt_wormprotector[29] = 'IP filtered';
$txt_wormprotector[30] = 'IP not filtered';

$txt_wormprotector[31] = 'Delete marked - leave ips in ip-filter.';
$txt_wormprotector[32] = 'Delete marked - remove ips from IP-Filter.';
$txt_wormprotector[33] = 'Delete all - leave ips in ip-filter.';
$txt_wormprotector[34] = 'Delete all - remove ips from ip-filter.';
$txt_wormprotector[35] = 'unselect all marked options';

$txt_wormprotector[36] = 'Before v1.5.01 not yet made available.';
$txt_wormprotector[37] = 'add to whitelist.';

?>