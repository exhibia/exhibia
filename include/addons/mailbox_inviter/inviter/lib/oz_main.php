<?php

define('__ABI',1);

define('_INVITER_SUCCESS',0);				
define('_INVITER_AUTHENTICATION_FAILED',1);	
define('_INVITER_FAILED',2);				
define('_INVITER_UNSUPPORTED',3);			
define('_INVITER_CAPTCHA_RAISED',4);		
define('_INVITER_USER_INPUT_REQUIRED',5);	
define('_INVITER_BLOCKED',6);				


function _inviter_include ($file) {$path = dirname(__FILE__).'/'.$file;if (file_exists($path)) include_once($path);}
function _inviter_include_either ($file1,$file2) {$path1 = dirname(__FILE__).'/'.$file1;$path2 = dirname(__FILE__).'/'.$file2;if (file_exists($path1)) include_once($path1);else if (file_exists($path2)) include_once($path2);}



global $_DOMAIN_IMPORTERS;
$_DOMAIN_IMPORTERS = array();
global $_DOMAIN_IMPORTERSX;
$_DOMAIN_IMPORTERSX = array();

$_OZ_SERVICES = array();

if (FALSE/*OBFUSCATED*/) {
	require('lib_base.php');
	_inviter_include('lib_abige.php');
	_inviter_include('lib_abi1.php');
	_inviter_include('lib_abi2.php');
	_inviter_include('lib_abi3.php');
	_inviter_include('lib_abi4.php');
	_inviter_include('lib_is1.php');
	_inviter_include('lib_is2.php');
}
else {

	_inviter_include("oz_ldif.php");
	_inviter_include("oz_vcard.php");
	_inviter_include("oz_csv.php");
	_inviter_include("oz_json.php");
	include(dirname(__FILE__)."/oz_base.php");


	_inviter_include("oz_abcontact.php");
	_inviter_include("ab_portablecontacts.php");


	_inviter_include("ab_hotmail.php");

	_inviter_include("ab_hotmail3.php");
	_inviter_include("ab_gmail.php");
	_inviter_include("ab_gmail2.php");

	_inviter_include_either("ab_yahoo2.php","ab_yahoo.php");
	//_inviter_include("ab_yahoo.php");
	_inviter_include("ab_yahoojp.php");
	//_inviter_include_either("ab_aol2.php","ab_aol.php");
	_inviter_include("ab_aol.php");
	//_inviter_include_either("ab_lycos2.php","ab_lycos.php");
	_inviter_include("ab_lycos.php");
	_inviter_include("ab_maildotcom.php");
	_inviter_include("ab_rediff.php");
	_inviter_include("ab_indiatimes.php");
	//_inviter_include("icq.php");

	//Contacts Importer Bundle 1
	_inviter_include("ab_fastmail.php");
	_inviter_include("ab_gmx.php");
	_inviter_include("ab_webde.php");
	_inviter_include("ab_linkedin.php");
	_inviter_include("ab_mynet.php");
	//_inviter_include_either("ab_macmail2.php","ab_macmail.php");
	_inviter_include("ab_macmail.php");

	//Contacts Importer Bundle 2
	_inviter_include("ab_mailru.php");
	//_inviter_include_either("ab_freenetde2.php","ab_freenetde.php");
	_inviter_include('ab_freenetde.php');
	_inviter_include("ab_libero.php");
	_inviter_include("ab_interia.php");
	_inviter_include("ab_rambler.php");
	_inviter_include("ab_yandex.php");
	_inviter_include("ab_onet.php");
	_inviter_include("ab_wppl.php");
	_inviter_include("ab_sapo.php");
	_inviter_include("ab_o2.php");
	_inviter_include("ab_tonline.php");


	_inviter_include("ab_terra.php");
	_inviter_include("ab_emailit.php");
	_inviter_include("ab_orangees.php");
	_inviter_include("ab_aliceit.php");
	_inviter_include("ab_plaxo.php");
	_inviter_include("ab_daumnet.php");
	_inviter_include("ab_naver.php");
	_inviter_include("ab_orkut.php");
	_inviter_include("ab_myspace.php");
	_inviter_include("ab_virgilioit.php");



	_inviter_include("sn_friendster.php");

	_inviter_include("sn_facebook.php");
	_inviter_include("sn_orkut.php");
	//_inviter_include_either("sn_myspace2.php", "sn_myspace.php");
	_inviter_include("sn_myspace.php");
	_inviter_include("sn_myspace2.php");	//experimental
	_inviter_include("sn_hi5.php");

	//Invite Sender Bundle 2
	_inviter_include("sn_bebo.php");
	_inviter_include("sn_blackplanet.php");
	_inviter_include("sn_xing.php");
	_inviter_include("sn_meinvz.php");
	_inviter_include("sn_hyves.php");
	_inviter_include("sn_twitter.php");
	_inviter_include("sn_studivz.php");

	//Misc	
	_inviter_include("ab_arcorde.php");
}



_inviter_include("oz_main2.php");
_inviter_include("oz_main3.php");
_inviter_include("oz_mainx.php");
_inviter_include("oz_main_int.php");

//_inviter_include("oz_http.php");

include(dirname(__FILE__)."/oz_inviter.php");


