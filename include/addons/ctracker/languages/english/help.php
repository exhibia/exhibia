<?php
########################################
#									   #
#   (C) 2007 by CTXtra				   #
#	http://www.ctxtra.de			   #
#									   #
#	Version: V1.5					   #
#									   #
########################################

$txt_help[1] = 'Help and explanations';

$txt_help[2] = 'General references:';
$txt_help[3] = '<li>Attacks will be logged one times since v1.3. After each attack, IPs will be insert immediately into the IP-Filter. If this IP tries to reload your page, it will be blocked by CTXtra.<br /><br /></li>
				 <li>After clicking on "[ more ]" many details will be shown about this attack. A new printer friendly side is open in a new window, so you can print this details and log it into your archiv.<br /><br /></li>
	 			 <li>Your Email-address will be shown and protected in ASCII-Code. This protection is the best way to fight against Spam. (PHP-Function: <a href="http://de.php.net/manual/de/function.ord.php" target="_blank">ord()</a> ).</li>';

$txt_help[4] = 'How to protect the logfiles?';
$txt_help[5] = '<li>During and after installation, logfiles will be saved in <b>'.$ct_filedir .'/log/</b> and protected by the htaccess-function. Username and Password are the same you use to login into the Admin-Control-Panel (ACP).</li>';

$txt_help[6] = 'IP-Filter:';
$txt_help[7] = '<li>The IP-Filter protects your site of this ips, which has been tried to hack your site before. If an attack will be detect, the IP is automatically written in the list and the attacker will be blocked.<br /><br /></li>
				 <li><u>The left list:</u><br />
					 Here you can insert your own IP´s. <b>Each IP has to be insert in an extra line.</b><br /><br /></li>
				 <li><u>The right list:</u><br />
					 Here you can see the IP-list, which is available directly from <a href="'.$ctxtra_url.'" target="_blank">'.$ctxtra_url.'</a>. This list includes many IP´s, which has to spam or attack some other domains in the past.</li>';

$txt_help[8] = 'Include Spam-Filter:';
$txt_help[9] = '<li>How to insert the Spam-Filter correctly into your site? Please check out our [ <a href="http://www.wupmedia.de/smf/index.php/topic,44" target="_blank">guids</a> ].</li>';

$txt_help[10] = 'Logfiles can`t write:';
$txt_help[11] = '<li>If the logfiles can´t write, please check and change the permissions of the path <b>'.$ct_filedir.'/log/</b> to chmod 0777 <br /><br /></li>
				 <li>If the path exists and the chmod is correct, the logfile can´t write again, so write an empty text-file. move it into this path and change the chmod of the file to 0777.';

$txt_help[12] = 'Path /log/ will not be protected';
$txt_help[13] = '<li>Write two empty textfiles with the name <b>.htaccess</b> and <b>.htpasswd</b> and move them into the path <b>'.$ct_filedir.'/log/</b>.<br /><br /></li>
				 <li>Insert the following lines into the file <b>.htaccess</b>:';

$txt_help[14] = 'Insert the following lines into the file <b>.htpasswd</b>:';
$txt_help[15] = '<li>Username and Password are the same you select by the installation or inside the settings.<br /><br />
				 <span style="color:#ff0000"><u><b>ATTENTION:</b></u><br>If you protect the htaccess-function by hand, Username and Password are NOT be changed if you changed any settings in the ACP.</span></li>';

$txt_help[16] = 'How to insert the copyright?';
$txt_help[17] = 'The copyright will be insert by the variable <b>$ctxtra_footer</b> at each place in your site.';

$txt_help[18] = 'or';

$txt_help[19] = 'Some more guids to include CTXtra in SMF, WBB, phpBB, phpKit... check out our <a href="http://www.wupmedia.de/smf" target="_blank">Forum</a> under "Short Guide" !';

$txt_help[20] = 'If your Operating-System is Microsoft Windows, please insert into <b>.htpasswd</b>:'

?>