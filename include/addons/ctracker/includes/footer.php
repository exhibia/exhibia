<?php
########################################
#									   #
#   (C) 2007 by CTXtra				   #
#	http://www.ctxtra.de			   #
#									   #
#	Version: V1.5					   #
#									   #
########################################

if (!defined('CTXTRA'))
	die ("Hacking attempt...");

$temp = file($ct_sourcedir."/templates/footer.html");
for($i=0;$i<count($temp);$i++){
	$site .= $temp[$i];
}

?>