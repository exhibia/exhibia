<?php

if (!defined('__ABI')) die('Please include abi.php to use this importer!');

global $_OZ_SERVICES;
$_OZ_SERVICES['wa_hotmail'] = array('type'=>'abi', 'label'=>'Hotmail Live', 'class'=>'HotmailWLLImporter');

define('HotmailWLLImporter_LC_SECURITY_TOKEN_REGEX',"/<wsse:BinarySecurityToken[^>]*>(.*)<\/wsse:BinarySecurityToken>/ims");
define('HotmailWLLImporter_OWNER_REGEX',"/<Owner[^>]*>(.*?)<\/Owner>/ims");
define('HotmailWLLImporter_CONTACT_REGEX',"/<Contact[^>]*>(.*?)<\/Contact>/ims");
define('HotmailWLLImporter_FIRSTNAME_REGEX',"/<FirstName[^>]*>([^<]*)<\/FirstName>/ims");
define('HotmailWLLImporter_MIDDLENAME_REGEX',"/<MiddleName[^>]*>([^<]*)<\/MiddleName>/ims");
define('HotmailWLLImporter_LASTNAME_REGEX',"/<LastName[^>]*>([^<]*)<\/LastName>/ims");
define('HotmailWLLImporter_EMAIL_REGEX',"/<Email[^>]*>(.*?)<\/Email>/ims");
define('HotmailWLLImporter_EMAILADDRESS_REGEX',"/<Address[^>]*>(.*?)<\/Address>/ims");
define('HotmailWLLImporter_CONTENT_TYPE',"application/xml; charset=utf-8");

/////////////////////////////////////////////////////////////////////////////////////////
//HotmailWLLImporter
/////////////////////////////////////////////////////////////////////////////////////////
//@api
class HotmailWLLImporter extends WebRequestor {

	var $delt;
	var $lid;

//	var $passportName;
	var $authHeader;

//    var $cumulusHost = "https://cumulus.services.live.com";

	//@api
	function getInfo () {
		return array('id'=>'hotmail');
	}

	function getString ($xml, $regex, $xmldecode) {
		if (preg_match($regex,$xml,$matches)>0) {
			$s = $matches[1];
			return $xmldecode ? htmlentities2utf8($s) : $s;
		}
		else {
			return '';
		}
	}


	//@api
	function auth ($auth) {
		//$auth is a querystring format of parameters unique to this webmail authentication.
		//For Hotmail Live Delegated Authentication, the following is important:
		//delt - Delegation token
		//lid - Location ID

		oz_set_domain('hotmail.com');

		//The ConsentToken itself after urldecode can be used directly as the authentication string.
		$this->authHeader = array();
		$this->authHeader[] = 'Content-Type: application/xml; charset=utf-8';

		$parts = explode('&',trim($auth));
		foreach ($parts as $part) {
			$va = explode('=',$part,2);
			if (count($va)==2) {
				$key = $va[0];
				$value = urldecode($va[1]);
				if ($key=='delt') {
					$this->delt = $value;
					$this->authHeader[] = 'Authorization: DelegatedToken dt="'.$value.'"';
				}
				else if ($key=='lid') {
					$this->lid = $value;
				}
				else if ($key=='eact') {
					//It's an encrypted delegation token. We do not yet support this.
					return _inviter_set_error(_INVITER_FAILED,'Encrypted delegation token not supported in this version. Please remove your domain from the Windows Azure service');
				}

			}
		}
		return _inviter_set_success();
	}

	//@api
	function getConsentUrl($returnUrl,$privacyPolicyUrl)
	{
		$url = 'https://consent.live.com/Delegation.aspx?RU='.$returnUrl.'&ps=Contacts.View&pl='.$privacyPolicyUrl;
		return $url;
	}

	function _extractContacts ($contactXml, &$al) {
		$fname = $this->getString($contactXml,HotmailWLLImporter_FIRSTNAME_REGEX, true);
		$mname = $this->getString($contactXml,HotmailWLLImporter_MIDDLENAME_REGEX, true);
		$lname = $this->getString($contactXml,HotmailWLLImporter_LASTNAME_REGEX, true);
		$name =  oz_reduce_whitespace($fname.' '.$mname.' '.$lname);
		preg_match_all(HotmailWLLImporter_EMAIL_REGEX, $contactXml, $matches2, PREG_SET_ORDER);
		foreach ($matches2 as $val2) {
			$emailXml = $val2[1];
			$email = $this->getString($emailXml, HotmailWLLImporter_EMAILADDRESS_REGEX, true);
			if (_inviter_valid_email($email)) {
				$contact = new Contact($name, $email);
				$al[] = $contact;
			}
		}
	}

	//@api
	function retrieveContacts () {

		//$intlid = $this->_baseConvert($this->lid);
		//$url = 'https://livecontacts.services.live.com/users/@L@'.$this->lid.'/rest/LiveContacts/Contacts';
		$url = 'https://livecontacts.services.live.com/users/@L@'.$this->lid.'/rest/LiveContacts';
		$xml = $this->httpRequest($url, false, NULL, 'utf-8', $this->authHeader);

		//A 404 means no contacts as well
		if ($this->lastStatusCode == 404) {
			$this->close();
			return array();
		}
		if ($this->lastStatusCode != 200) {
			return _inviter_set_error(_INVITER_AUTHENTICATION_FAILED,'Unauthorized : '.$this->lastStatusCode);
		}

		//Try to get owner email address
		$al = array();
		preg_match_all(HotmailWLLImporter_OWNER_REGEX, $xml, $matches, PREG_SET_ORDER);
		foreach ($matches as $val) {
			$contactXml = $val[1];
			$this->_extractContacts($contactXml, $al);
			break;
		}
		if (count($al)>0) {
			//Get first email as contact owner
			$this->setOwnerEmail($al[0]->email);
		}

		$al = array();
		preg_match_all(HotmailWLLImporter_CONTACT_REGEX, $xml, $matches, PREG_SET_ORDER);
		foreach ($matches as $val) {
			$contactXml = $val[1];
			$this->_extractContacts($contactXml, $al);
		}
		return $al;
	}

	//@api
	function fetchContacts ($loginemail, $password) {
		return _inviter_set_error(_INVITER_FAILED,'Please call authenticate() with the ConsentToken from Windows Live Delegated Authentication to login');
	}
}

//Hotmail
/*
global $_DOMAIN_IMPORTERS;
$_DOMAIN_IMPORTERS["hotmail.com"]='HotmailImporter2';
$_DOMAIN_IMPORTERS["msn.com"]='HotmailImporter2';
$_DOMAIN_IMPORTERS["hotmail.fr"]='HotmailImporter2';
$_DOMAIN_IMPORTERS["hotmail.it"]='HotmailImporter2';
$_DOMAIN_IMPORTERS["hotmail.de"]='HotmailImporter2';
$_DOMAIN_IMPORTERS["hotmail.co.jp"]='HotmailImporter2';
$_DOMAIN_IMPORTERS["hotmail.co.uk"]='HotmailImporter2';
$_DOMAIN_IMPORTERS["hotmail.com.ar"]='HotmailImporter2';
$_DOMAIN_IMPORTERS["hotmail.co.th"]='HotmailImporter2';
$_DOMAIN_IMPORTERS["hotmail.com.tr"]='HotmailImporter2';
$_DOMAIN_IMPORTERS["hotmail.es"]='HotmailImporter2';
$_DOMAIN_IMPORTERS["msnhotmail.com"]='HotmailImporter2';
$_DOMAIN_IMPORTERS["hotmail.jp"]='HotmailImporter2';
$_DOMAIN_IMPORTERS["hotmail.se"]='HotmailImporter2';
$_DOMAIN_IMPORTERS["hotmail.com.br"]='HotmailImporter2';
$_DOMAIN_IMPORTERS["live.com.ar"]='HotmailImporter2';
$_DOMAIN_IMPORTERS["live.com.au"]='HotmailImporter2';
$_DOMAIN_IMPORTERS["live.at"]='HotmailImporter2';
$_DOMAIN_IMPORTERS["live.be"]='HotmailImporter2';
$_DOMAIN_IMPORTERS["live.ca"]='HotmailImporter2';
$_DOMAIN_IMPORTERS["live.cl"]='HotmailImporter2';
$_DOMAIN_IMPORTERS["live.cn"]='HotmailImporter2';
$_DOMAIN_IMPORTERS["live.dk"]='HotmailImporter2';
$_DOMAIN_IMPORTERS["live.fr"]='HotmailImporter2';
$_DOMAIN_IMPORTERS["live.de"]='HotmailImporter2';
$_DOMAIN_IMPORTERS["live.hk"]='HotmailImporter2';
$_DOMAIN_IMPORTERS["live.ie"]='HotmailImporter2';
$_DOMAIN_IMPORTERS["live.it"]='HotmailImporter2';
$_DOMAIN_IMPORTERS["live.jp"]='HotmailImporter2';
$_DOMAIN_IMPORTERS["live.co.kr"]='HotmailImporter2';
$_DOMAIN_IMPORTERS["live.com.my"]='HotmailImporter2';
$_DOMAIN_IMPORTERS["live.com.mx"]='HotmailImporter2';
$_DOMAIN_IMPORTERS["live.nl"]='HotmailImporter2';
$_DOMAIN_IMPORTERS["live.no"]='HotmailImporter2';
$_DOMAIN_IMPORTERS["live.ru"]='HotmailImporter2';
$_DOMAIN_IMPORTERS["live.com.sg"]='HotmailImporter2';
$_DOMAIN_IMPORTERS["live.co.za"]='HotmailImporter2';
$_DOMAIN_IMPORTERS["live.se"]='HotmailImporter2';
$_DOMAIN_IMPORTERS["live.co.uk"]='HotmailImporter2';
$_DOMAIN_IMPORTERS["live.com"]='HotmailImporter2';
$_DOMAIN_IMPORTERS["windowslive.com"]='HotmailImporter2';
*/
