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
				 <b>'.count_all_logs().'</b> Angriffe abgewehrt!';

$ct_footer[2] = '<a href="'.$ctxtra_url.'" target="_blank"><img src="'.$ct_imagedir.'ctrackerxtra.gif" border="0" alt="CTXtra"></a>';

$ct_footer[3] = '<a href="'.$ctxtra_url.'" target="_blank">CTXtra</a>';

$ct_footer[4] = '<a href="'.$ctxtra_url.'" target="_blank">CTXtra</a><br />
				 <b>'.count_all_logs().'</b> Angriffe abgewehrt!';

$ct_footer[5] = '<a href="'.$ctxtra_url.'" target="_blank">Sicherheitssoftware: <b>CTXtra</b></a><br />
				 <b>'.count_all_logs().'</b> Angriffe abgewehrt!';

$ct_footer[6] = '<a href="'.$ctxtra_url.'" target="_blank">Sicherheitssoftware: <b>CTXtra</b></a>';

$ct_footer[7] = 'Der <a href="'.$ctxtra_url.'" target="_blank"><b>CTXtra</b></a> hat <b>'.count_all_logs().'</b> Angriffe abgewehrt!';

$ct_footer[8] = '<a href="'.$ctxtra_url.'" target="_blank">Sicherheitssoftware: <b>CTXtra</b></a><br />
				 <b>'.count_attacks().'</b> Angriffe geblockt | <b>'.count_blocked_ips().'</b> Seitenzugriffe geblockt | <b>'.count_blocked_bots().'</b> BOT\'s geblockt | <b>'.count_ips().'</b> Bad-IP\'s und <b>'.count_bots().'</b> BOT\'s gelistet';

$ct_footer[9] = '<a href="'.$ctxtra_url.'" target="_blank"><img src="'.$ct_imagedir.'ctrackerxtra.gif" border="0" alt="CTXtra"></a><br />
				 <b>'.count_attacks().'</b> Angriffe geblockt | <b>'.count_blocked_ips().'</b> Seitenzugriffe geblockt | <b>'.count_blocked_bots().'</b> BOT\'s geblockt | <b>'.count_ips().'</b> Bad-IP\'s und <b>'.count_bots().'</b> BOT\'s gelistet';

// ACP Footer
$txt_footer[1] = '<span style="color: #696969; font-weight: bold;">CT</span><span style="color: #BB0000; font-weight: bold;">Xtra</span>&nbsp;<a style="color: #999999;" href="'.$ctxtra_url.'" target="_blank">v'.$version_number.'.'.$revision_number.' © 2007 - '.date("Y").'</a></span>'


?>