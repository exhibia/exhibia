<?php
########################################
#									   #
#   (C) 2007 by CTXtra				   #
#	http://www.ctxtra.de			   #
#									   #
#	Version: V1.5					   #
#									   #
########################################


// Footer Templates
$ct_footer[1] = '<a href="'.$ctxtra_url.'" target="_blank"><img src="'.$ct_imagedir.'ctrackerxtra.gif" border="0" alt="CTXtra"></a><br />
				 <b>'.count_all_logs().'</b> Attacks blocked!';

$ct_footer[2] = '<a href="'.$ctxtra_url.'" target="_blank"><img src="'.$ct_imagedir.'ctrackerxtra.gif" border="0" alt="CTXtra"></a>';

$ct_footer[3] = '<a href="'.$ctxtra_url.'" target="_blank">CTXtra</a>';

$ct_footer[4] = '<a href="'.$ctxtra_url.'" target="_blank">CTXtra</a><br />
				 <b>'.count_all_logs().'</b> Attacks blocked!';

$ct_footer[5] = '<a href="'.$ctxtra_url.'" target="_blank">Securitysoftware: <b>CTXtra</b></a><br />
				 <b>'.count_all_logs().'</b> Attacks blocked!';

$ct_footer[6] = '<a href="'.$ctxtra_url.'" target="_blank">Securitysoftware: <b>CTXtra</b></a>';

$ct_footer[7] = '<a href="'.$ctxtra_url.'" target="_blank"><b>CTXtra</b></a> has blocked <b>'.count_all_logs().'</b>!';

$ct_footer[8] = '<a href="'.$ctxtra_url.'" target="_blank">Securitysoftware: <b>CTXtra</b></a><br />
				 <b>'.count_attacks().'</b> Attacks blocked | <b>'.count_blocked_ips().'</b> Sideaccess blocked | <b>'.count_blocked_bots().'</b> BOT\'s blocked | <b>'.count_ips().'</b> Bad-IP\'s and <b>'.count_bots().'</b> BOT\'s logged';

$ct_footer[9] = '<a href="'.$ctxtra_url.'" target="_blank"><img src="'.$ct_imagedir.'ctrackerxtra.gif" border="0" alt="CTXtra"></a><br />
				 <b>'.count_attacks().'</b> Attacks blocked | <b>'.count_blocked_ips().'</b> Sideaccess blocked | <b>'.count_blocked_bots().'</b> BOT\'s blocked | <b>'.count_ips().'</b> Bad-IP\'s and <b>'.count_bots().'</b> BOT\'s logged';



?>