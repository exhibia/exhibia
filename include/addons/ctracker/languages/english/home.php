<?php
########################################
#									   #
#   (C) 2007 by CTXtra				   #
#	http://www.ctxtra.de			   #
#									   #
#	Version: V1.5					   #
#									   #
########################################

$txt_home[1]	 = 'Welcome to CTXtra ACP';
$txt_home[2]	= 'today';
$txt_home[3]	= 'yesterday';
$txt_home[4]	= 'Your last login was on';
$txt_home[5]	= 'at';
$txt_home[6]	= 'o´clock';
$txt_home[7]	= 'Hello';
$txt_home[8]	= 'That´s your ACP (Admin-Control-Panel). Feel free to evaluate all Attacks and logged Spam-Entries. Simulate an attack to check your system, if CTXtra works fine. You be able to ban IP\'s in this system.
		  	       Any problems, wishes or suggestions, please post it into our <a href="http://www.ctxtra.de/smf/" target="_blank">
				   Support Forum</a>.';
$txt_home[9]	= 'News from';
$txt_home[10]	= 'Since Installation on '.date("d.m.Y", $ct_install_time).', '.$ct_install_all_attacks.' attack/s are repelled.';
$txt_home[11]	= 'Worm-attack/s blocked. [ <a href="?hack=true">more</a> ]';
$txt_home[12]	= 'Sideaccess blocked by IP-Filter. [ <a href="?ipfilter=true">more</a> ]';
$txt_home[13]	= 'Entry/ies blocked by SPAM-Filter. [ <a href="?spamfilter=true">more</a> ]';
$txt_home[14]	= 'Alltogether '.count_all_logs().' attack/s logged.';
$txt_home[15]	= 'IP\'s shown in your <a href="index.php?ipfilter=true">IP-Filter</a>.';
$txt_home[16]	= 'Online <b>'.$_SESSION['online_ips'].'</b> IP\'s available.';
$txt_home[17]	= 'Last update IP-List on '.date("d.m.y",$updatetime_iplist).' at '.date("H:m",$updatetime_iplist).'.';
$txt_home[18]	= 'Spamwords are in your <a href="index.php?spamfilter=true">SPAM-Filter</a>.';
$txt_home[19]	= 'Online <b>'.$_SESSION['online_spamwords'].'</b> Spamwords available.';
$txt_home[20]	= 'Last update SPAM-List on '.date("d.m.y",$updatetime_spamlist).' at '.date("H:m",$updatetime_spamlist).'.';
$txt_home[21]	= 'Statistic';
?>