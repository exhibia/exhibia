<?php
########################################
#									   #
#   (C) 2007 by CTXtra				   #
#	http://www.ctxtra.org			   #
#									   #
#	Version: V1.5					   #
#									   #
########################################

if (!defined('CTXTRA'))
	die ("Hacking attempt...");
	
#############################################################
### !!! N E V E R   C H A N G E   T H I S   V A L U E !!! ###
#############################################################

##########################################
$update_version_number	= "1.5";
$update_revision		= "07";
##########################################

$ct_log_file		= $ct_sourcedir."/log/ct_log.txt";
$ct_log_ips			= $ct_sourcedir."/log/ct_ips.txt";
$ct_log_countips	= $ct_sourcedir."/log/ct_countip.txt";
$ct_log_bots		= $ct_sourcedir."/log/ct_log_bots.txt";
$ct_bots			= $ct_sourcedir."/log/ct_bots.txt";
$ct_log_spam		= $ct_sourcedir."/log/ct_log_spam.txt";
$ct_spamlist		= $ct_sourcedir."/log/ct_spamlist.txt";
$ct_log_ctxtras		= $ct_sourcedir."/log/ct_log_ctxtras.txt";
$ct_whitelistes		= $ct_sourcedir."/log/ct_whitelists.txt";

$footer_list		= $ct_sourcedir."/languages/".$ct_lang."/footer.php";
$ct_config			= $ct_sourcedir."/includes/config.inc.php";

$htaccess_log		= "log/.htaccess"; 
$htaccess_admin		= "admin/.htaccess";
$htaccess_includes	= "includes/.htaccess";
$htpasswd_log		= "log/.htpasswd";

$online_iplist		= "http://www.ctxtra.org/remote/iplist.xml";
$online_spamlist	= "http://www.ctxtra.org/remote/spamlist.xml";
$ct_remote_news 	= "http://www.ctxtra.org/remote/news.php?lang=".$ct_lang;
$ct_remote_partner	= "http://www.ctxtra.org/partner/partner.php";
$ct_partner_werden	= "http://www.ctxtra.org/index.php?partnerwerden=true";
$ct_paypal			= "http://www.ctxtra.org/smf/index.php?page=7";
$ctxtra_url			= "http://www.ctxtra.org/";
$update_file		= "http://www.ctxtra.org/remote/version.txt";
$update_info		= "http://www.ctxtra.org/remote/versionsinfo.php?lang=".$ct_lang;

?>
