<?php

if (!defined('__ABI')) die('Please include abi.php to use this importer!');

global $_OZ_SERVICES;
$_OZ_SERVICES['hotmail'] = array('type'=>'abi', 'label'=>'Hotmail', 'class'=>'HotmailImporter2');

define('HotmailImporter2_LC_SECURITY_TOKEN_REGEX',"/<wsse:BinarySecurityToken[^>]*>(.*)<\/wsse:BinarySecurityToken>/ims");
define('HotmailImporter2_CONTACT_REGEX',"/<Contact[^>]*>(.*?)<\/Contact>/ims");
define('HotmailImporter2_FIRSTNAME_REGEX',"/<FirstName[^>]*>([^<]*)<\/FirstName>/ims");
define('HotmailImporter2_MIDDLENAME_REGEX',"/<MiddleName[^>]*>([^<]*)<\/MiddleName>/ims");
define('HotmailImporter2_LASTNAME_REGEX',"/<LastName[^>]*>([^<]*)<\/LastName>/ims");
define('HotmailImporter2_EMAIL_REGEX',"/<Email[^>]*>(.*?)<\/Email>/ims");
define('HotmailImporter2_EMAILADDRESS_REGEX',"/<Address[^>]*>(.*?)<\/Address>/ims");
define('HotmailImporter2_CONTENT_TYPE',"application/xml; charset=utf-8");


class HotmailImporter2 extends WebRequestor {

	var $passportName;
	var $authHeader;
	var $cumulusHost = "https://cumulus.services.live.com";

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
	function fetchContacts ($loginemail, $password) {

		//Remove suffix
		$loginemail = preg_replace("/^(.*?)(\.hotmail)$/ims", '${1}', $loginemail);

		$this->setOwnerEmail($loginemail);
		oz_set_domain(oz_get_email_domain($loginemail));

		// Hotmail limits to 16 characters of password
		if (strlen($password)>16) $password=substr($password,0,16);

		$this->passportName = strtolower($loginemail);
		$apiKey = "OZABI";
		$loginXml = "<s:Envelope xmlns:s=\"http://www.w3.org/2003/05/soap-envelope\" xmlns:wsse=\"http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd\" xmlns:saml=\"urn:oasis:names:tc:SAML:1.0:assertion\" xmlns:wsp=\"http://schemas.xmlsoap.org/ws/2004/09/policy\" xmlns:wsu=\"http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-utility-1.0.xsd\" xmlns:wsa=\"http://www.w3.org/2005/08/addressing\" xmlns:wssc=\"http://schemas.xmlsoap.org/ws/2005/02/sc\" xmlns:wst=\"http://schemas.xmlsoap.org/ws/2005/02/trust\">"
					."<s:Header>"
					."<wlid:ClientInfo xmlns:wlid=\"http://schemas.microsoft.com/wlid\"><wlid:ApplicationID>"
					.$apiKey
					."</wlid:ApplicationID></wlid:ClientInfo>"
					."<wsa:Action s:mustUnderstand=\"1\">http://schemas.xmlsoap.org/ws/2005/02/trust/RST/Issue</wsa:Action>"
					."<wsa:To s:mustUnderstand=\"1\">https://dev.login.live.com/wstlogin.srf</wsa:To>"
					."<wsse:Security><wsse:UsernameToken wsu:Id=\"user\"><wsse:Username>"
					.htmlentities($this->passportName,ENT_NOQUOTES,'UTF-8')
					."</wsse:Username><wsse:Password>"
					.htmlentities($password,ENT_NOQUOTES,'UTF-8')
					."</wsse:Password></wsse:UsernameToken></wsse:Security>"
					."</s:Header>"
					."<s:Body>"
					."<wst:RequestSecurityToken Id=\"RST0\"><wst:RequestType>http://schemas.xmlsoap.org/ws/2005/02/trust/Issue</wst:RequestType><wsp:AppliesTo><wsa:EndpointReference><wsa:Address>http://live.com</wsa:Address></wsa:EndpointReference></wsp:AppliesTo><wsp:PolicyReference URI=\"MBI\"></wsp:PolicyReference></wst:RequestSecurityToken></s:Body></s:Envelope>";

		$extraHeaders = array();
		$extraHeaders[] = 'Content-Type: '.HotmailImporter2_CONTENT_TYPE;
		$extraHeaders[] = '_authtrkcde: {#TRKCDE#}';
		$html = $this->httpPost("https://dev.login.live.com/wstlogin.srf", $loginXml,'utf-8', $extraHeaders);
		if (strpos($html,'psf:error')>0) {
			$this->close();
			return _inviter_set_error(_INVITER_AUTHENTICATION_FAILED,'Bad user name or password');
		}

		// Get authorization header
		if (preg_match(HotmailImporter2_LC_SECURITY_TOKEN_REGEX,$html,$matches)>0) {
			$binaryToken = $matches[1];
			$binaryToken = htmlentities($binaryToken);
			$this->authHeader = 'Authorization: WLID1.0 t="'.$binaryToken.'"';
		}

		// Fetch contacts!
		$al = array();
		$extraHeaders = array();
		$extraHeaders[] = 'Content-Type: '.HotmailImporter2_CONTENT_TYPE;
		$extraHeaders[] = $this->authHeader;
		$url = $this->cumulusHost.'/'.urlencode($this->passportName).'/LiveContacts/Contacts';
		$xml = $this->httpRequest($url, false, null, 'utf-8', $extraHeaders);

		//A 404 means no contacts as well
		if ($this->lastStatusCode == 404) {
			$this->close();
			return $al;
		}

		//Sometimes xml is empty when Cumulus is having problems
		if ($this->lastStatusCode >= 400 || empty($xml)) {
			//Try classic importer instead
			$obj = new HotmailImporter;
			return $obj->fetchContacts($loginemail,$password);
		}

		preg_match_all(HotmailImporter2_CONTACT_REGEX, $xml, $matches, PREG_SET_ORDER);
		foreach ($matches as $val) {
			$contactXml = $val[1];
			$fname = $this->getString($contactXml,HotmailImporter2_FIRSTNAME_REGEX, true);
			$mname = $this->getString($contactXml,HotmailImporter2_MIDDLENAME_REGEX, true);
			$lname = $this->getString($contactXml,HotmailImporter2_LASTNAME_REGEX, true);
			$name =  oz_reduce_whitespace($fname.' '.$mname.' '.$lname);

			preg_match_all(HotmailImporter2_EMAIL_REGEX, $contactXml, $matches2, PREG_SET_ORDER);
			foreach ($matches2 as $val2) {
				$emailXml = $val2[1];
				$email = $this->getString($emailXml, HotmailImporter2_EMAILADDRESS_REGEX, true);
				if (_inviter_valid_email($email)) {
					$contact = new Contact($name, $email);
					$al[] = $contact;
				}
			}
		}
		return $al;
	}
}

//Hotmail
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
$_DOMAIN_IMPORTERS["hotmail"]='HotmailImporter2';
