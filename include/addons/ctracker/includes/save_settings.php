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

// Einstellungen ändern
if ((isset($_POST['submit_config']) OR isset($_POST['submit_install'])) AND $_GET['settings'] == "true") {
	config_anlegen();
	include("includes/config.inc.php");
	include('languages/'.$ct_lang.'/save_settings.php');
	
	if (empty($_POST['db_pass']) OR $_POST['db_pass'] == 'smfctracker_dummy') {
		$info_einstellungen = '
		<table style="width:800px; background-color:#ff0000; border-left:1px solid #999999; border:right:1px solid #999999">
			<tr>
				<td width="8px">&nbsp;</td>
				<td style="text-align:left">
					<span style="font-size:12px; font-weight:bold; color:#ffffff">'.$txt_save_settings[1].'</span>
				</td>
			</tr>
		</table>';
		$input_pssword = '<input style="color:#ff0000" type="password" name="db_pass" value="smfctracker_dummy" size="70" />';
	} else {
		config_anlegen();
		include("includes/config.inc.php");
		
		// .htaccess - Schutz anlegen
		if ($ct_htaccess == "yes") {
			$fp_htaccess_log = @fopen($htaccess_log, "w+");
				@flock  ( $fp_htaccess_log , 2 ); 
					@fwrite($fp_htaccess_log, "AuthUserFile ".$_SERVER['DOCUMENT_ROOT'].'/'.$_POST['filedir']."/log/.htpasswd\n");
					@fwrite($fp_htaccess_log, "AuthName \"CTXtra - Logs\"\n");
					@fwrite($fp_htaccess_log, "AuthType Basic\n");
					@fwrite($fp_htaccess_log, "require user ".$_POST['db_user']."\n");
				@flock  ( $fp_htaccess_log , 3 ); 
			@fclose($fp_htaccess_log);
		
			$fp_htaccess_admin = @fopen($htaccess_admin, "w+");
				@flock  ( $fp_htaccess_admin , 2 ); 
					@fwrite($fp_htaccess_admin, "AuthUserFile ".$_SERVER['DOCUMENT_ROOT'].'/'.$_POST['filedir']."/log/.htpasswd\n");
					@fwrite($fp_htaccess_admin, "AuthName \"CTXtra - Admin\"\n");
					@fwrite($fp_htaccess_admin, "AuthType Basic\n");
					@fwrite($fp_htaccess_admin, "require user ".$_POST['db_user']."\n");
				@flock  ( $fp_htaccess_admin , 3 ); 
			@fclose($fp_htaccess_admin);
		
			$fp_htaccess_includes = @fopen($htaccess_includes, "w+");
				@flock  ( $fp_htaccess_includes , 2 ); 
					@fwrite($fp_htaccess_includes, "AuthUserFile ".$_SERVER['DOCUMENT_ROOT'].'/'.$_POST['filedir']."/log/.htpasswd\n");
					@fwrite($fp_htaccess_includes, "AuthName \"CTXtra $version_number.$revision_number - Login\"\n");
					@fwrite($fp_htaccess_includes, "AuthType Basic\n");
					@fwrite($fp_htaccess_includes, "require user ".$_POST['db_user']."\n");
				@flock  ( $fp_htaccess_includes , 3 ); 
			@fclose($fp_htaccess_includes);
		
			// .htpasswd - Datei erzeugen
			$fp_htpasswd_log = @fopen($htpasswd_log, "w+");
				@flock  ( $fp_htpasswd_log , 2 ); 
					// Betriebssystem prüfen
					if(isset($_ENV['OS']) AND $_ENV['OS'] == "Windows_NT") {
						@fwrite($fp_htpasswd_log, $_POST['db_user'].":".$_POST['db_pass']);
					} else {
						@fwrite($fp_htpasswd_log, $_POST['db_user'].":".crypt($_POST['db_pass'],CRYPT_STD_DES));					
					}
				@flock  ( $fp_htpasswd_log , 3 ); 
			@fclose($fp_htpasswd_log);
		} else {
			$ary_htaccess_admin 	= array('.htaccess');
			$ary_htaccess_includes	= array('.htaccess');
			$ary_htaccess_log		= array('.htaccess', '.htpasswd');
			
			$a=0;
			while($a<count($ary_htaccess_admin)) {
				@unlink($ct_sourcedir."/admin/".$ary_htaccess_admin[$a]);
				$a++;
			}
			
			$b=0;
			while($b<count($ary_htaccess_includes)) {
				@unlink($ct_sourcedir."/includes/".$ary_htaccess_includes[$b]);
				$b++;
			}
			
			$c=0;
			while($c<count($ary_htaccess_log)) {
				@unlink($ct_sourcedir."/log/".$ary_htaccess_log[$c]);
				$c++;
			}
		}
	
		// log/ct_countip.txt anlegen - wenn nicht erfolgreich Fehlermeldung ausgeben
		if (!file_exists($ct_log_countips)) {
			$no_ct_log_countips = '
			<table width="800px" cellpadding="3" cellspacing="1" style="border:2px solid #bb0000; background-color:#E7E7E7">
				<tr>
					<td class="windowbg" valign="top" style="padding: 7px; text-align:center">
						<span style="font-size:12px; color:#cc0000">'.$txt_save_settings[2].'</span>
					</td>
				</tr>
			</table>
			<table style="width:800px; border:0px" cellspacing="0" cellpadding="0">
				<tr>
			    	<td style="line-height:'.$ct_block_space.'px">&nbsp;</td>
				</tr>
			</table>';
		}
	
		if (!file_exists($ct_log_file)) {
			$no_ct_log_file = '
			<table width="800px" cellpadding="3" cellspacing="1" style="border:2px solid #bb0000; background-color:#E7E7E7">
				<tr>
					<td class="windowbg" valign="top" style="padding: 7px; text-align:center">
						<span style="font-size:12px; color:#cc0000">'.$txt_save_settings[3].'</span>
					</td>
				</tr>
			</table>
			<table style="width:800px; border:0px" cellspacing="0" cellpadding="0">
				<tr>
			    	<td style="line-height:'.$ct_block_space.'px">&nbsp;</td>
				</tr>
			</table>';
		}
	
		if (!file_exists($ct_log_countips)) {
			$no_ct_log_countips = '
			<table width="800px" cellpadding="3" cellspacing="1" style="border:2px solid #bb0000; background-color:#E7E7E7">
				<tr>
					<td class="windowbg" valign="top" style="padding: 7px; text-align:center">
						<span style="font-size:12px; color:#cc0000">'.$txt_save_settings[4].'</span>
					</td>
				</tr>
			</table>
			<table style="width:800px; border:0px" cellspacing="0" cellpadding="0">
				<tr>
			    	<td style="line-height:'.$ct_block_space.'px">&nbsp;</td>
				</tr>
			</table>';
		}
		$input_pssword = '<input type="password" name="db_pass" value="'.$ct_db_pass.'" size="55" />';
	}
	include('includes/config.inc.php');
	
	if(isset($_POST['submit_install'])) { 
		if ($ct_auto_iplist == "yes") {auto_ip_list();}
	}
}
?>