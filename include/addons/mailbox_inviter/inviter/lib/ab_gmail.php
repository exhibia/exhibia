<?php
if (!defined('__ABI')) die('Please include abi.php to use this importer!');

global $_OZ_SERVICES;
$_OZ_SERVICES['gmail'] = array('type'=>'abi', 'label'=>'GMail', 'class'=>'GMailImporter');
$_OZ_SERVICES['databg'] = array('type'=>'abi', 'label'=>'Data.bg', 'class'=>'GMailImporter');
$_OZ_SERVICES['igcombr'] = array('type'=>'abi', 'label'=>'Ig.com.br', 'class'=>'GMailImporter');

define('GMailImporter_AT_REGEX',"/<input\\s+type=\"hidden\"\\s+name=\"at\"\\s+value=\"([^\"]+)\"/ims");
define('GMailImporter_JSON_REGEX',"/var\\s+initContactData\\s*=\\s*({.*?);\\s*handleInitialContactData/ims");

/////////////////////////////////////////////////////////////////////////////////////////
//GMailImporter
/////////////////////////////////////////////////////////////////////////////////////////
//@api
class GMailImporter extends WebRequestor {

	var $appDomain;
	var $path;

	//@api
	function getInfo () {
		return array('id'=>'gmail');
	}

	//@api
	function login ($loginemail, $password) {

		//If login email ends with ".yahoo" only, then we remove it
		$loginemail = preg_replace("/^(.*?)(\.gmail)$/ims", '${1}', $loginemail);

		$parts = $this->getEmailParts($loginemail);
		$login = $parts[0];
		$domain = strtolower($parts[1]);

		$this->setOwnerEmail($loginemail);
		oz_set_domain($domain);

		// ####
		if ("gmail.com"==$domain || "googlemail.com"==$domain) {
			$this->appDomain=null;
			$this->path='mail';
		} else {
			// It's a google apps domain.
			$this->appDomain = $domain;
			$this->path = 'a/'.$domain;
		}
		
		
		//Get login form
		$form = new HttpForm;
		if ($this->appDomain !==NULL) {
			// Google apps
			$html = $this->httpGet("http://mail.google.com/a/".$this->appDomain.'/');
		} else {
			// Is null. Is google itself
			$html = $this->httpGet("http://mail.google.com/mail/");
		}
		$form = oz_extract_form_by_id($html,"gaia_loginform");
		if ($form === NULL) {
			$this->close();
			return _inviter_set_error(_INVITER_FAILED,'Cannot find login form');
		}

		$location='';
		//$form = new HttpForm;
		//$form->addField("ltmpl", "default");
		//$form->addField("ltmplcache", "2");
		$form->setField("hl", "en");
		//$form->addField("service", "mail");
        //$form->addField("rm", "false");
        //$form->addField("scc", "1");
		$form->addField("Passwd", $password);
		//$form->addField("rmShown", "1");
		//$form->addField("_authtrkcde", "{#TRKCDE#}");

		if ($this->appDomain==null)
		{
			$form->addField("Email", $loginemail);
			//$form->addField("continue", "http://mail.google.com/mail?");
			//$postData = $form->buildPostData();
			//$html = $this->httpPost("https://www.google.com/accounts/ServiceLoginAuth", $postData);
		}
		else
		{
			$form->addField("Email", $login);
			//$form->addField("continue", 'https://mail.google.com/a/'.$this->appDomain.'/');
			//$form->addField("rm", "false");
			//$form->addField("asts", "");
			//$postData = $form->buildPostData();
			//$html = $this->httpPost("https://www.google.com/a/".$this->appDomain."/LoginAction2?service=mail", $postData);
		}
		$html = $this->postForm($form);


		if (strpos($html, 'Username and password do not match')!==false ||
			strpos($html, 'class="errormsg"')!==false) {
			// || strpos($this->lastUrl,'mail.google.com/a/')===FALSE
			$this->close();
			return _inviter_set_error(_INVITER_AUTHENTICATION_FAILED,'Bad user name or password');
		}
		if (strpos($html, 'Server error')!==false) {
			$this->close();
			return _inviter_set_error(_INVITER_UNSUPPORTED,'No Google Apps found for '.$domain);
		}


		if (defined('_INVITER_ABCAPTCHA') && _INVITER_CAPTCHA==1) {
			if (strpos($html, 'https://www.google.com/accounts/Captcha')!=false) {
				$this->close();
				return _inviter_set_error(_INVITER_CAPTCHA_RAISED,'Captcha challenge was raised');
			}
		}

		$location = oz_get_refresh_url($html);
		if ($location!==NULL) $html = $this->httpGet($location);

		/*
		if (preg_match($this->REDIRECT_REGEX,$html,$matches)==0) {

			$this->close();
			return _inviter_set_error(_INVITER_FAILED,'Cannot find redirection page');
		}
		$location = htmlentities2utf8($matches[1]);
		*/


		//Gzip seems to be causing some problems with this section when used with GoDaddy proxy.
		//We temporarily disable gzip in this case.
		$supportGzip = $this->supportGzip;
		//Only if proxy is used
		if (oz_defined_config('curl_proxy')) $this->supportGzip = false;

		$location = oz_get_refresh_url($html);
		if ($location!=null) {
			$html = $this->httpGet($location);
		}

		//Reenable gzip if any
		$this->supportGzip = $supportGzip;

		//$url2 = $this->makeAbsolute($this->lastUrl, '/mail');
		$url2 = $this->makeAbsolute($this->lastUrl, '/'.$this->path);
		$at = null;
		$ats = $this->cookiejar->getCookieValues ($url2, "GMAIL_AT");
		if (!empty($ats) && count($ats)>0) {
			$at = $ats[0];
		}
		if (empty($at)) {
			//$html = $this->httpGet("http://mail.google.com/mail/?view=sec");
			$html = $this->httpGet("http://mail.google.com/$this->path/?view=sec");
			if (preg_match(GMailImporter_AT_REGEX,$html,$matches)) {
				$at = htmlentities2utf8($matches[1]);
			}
		}

		if (empty($at)) {
			$this->close();
			return _inviter_set_error(_INVITER_FAILED,'Failed to login. Unable to obtain GMAIL_AT.');
		}

		return _inviter_set_success()	 ;
	}

	function fetchCsv ($fmt='csv') {

//http://www.gmail.com/
//https://www.google.com/accounts/ServiceLogin?service=mail&passive=true&rm=false&continue=https%3A%2F%2Fmail.google.com%2Fmail%2F%3Fnsr%3D1%26ui%3Dhtml%26zy%3Dl&ltmpl=default&ltmplcache=2

/*
		$html = $this->httpGet('https://www.google.com/accounts/ServiceLogin?service=mail&passive=true&rm=false&continue=http%3A%2F%2Fmail.google.com%2Fmail%2F&ltmpl=default&ltmplcache=2');
		$form = oz_extract_form_by_id($html, 'gaia_loginform');
		if (is_null($form)) {
			$this->close();
			return _inviter_set_error(_INVITER_FAILED,'Cannot find login form');
		}
		$form->setField("Email", $loginemail);
		$form->setField("Passwd", $password);
		$postData = $form->buildPostData();
		$html = $this->httpPost($form->action, $postData);
*/

		$limitToMyContacts = oz_get_config('gmail.limit_mycontacts',NULL);
		if ($limitToMyContacts===NULL) {
			$filter = oz_get_config('gmail.filter','all');
			if ($filter=='mycontacts') $limitToMyContacts=true;
		}
		//$limitToMyContacts = oz_get_config('gmail.limit_mycontacts',false);
		if ($fmt=='outlook') {
			//$html = $this->httpGet("http://mail.google.com/mail/contacts/data/export?exportType=ALL&groupToExport=&out=OUTLOOK_CSV");
			if ($limitToMyContacts) {
				$html = $this->httpGet("http://mail.google.com/$this->path/contacts/data/export?exportType=GROUP&groupToExport=%5EMine&out=OUTLOOK_CSV&lang=en&hl=en&l=en");
			}
			else {
				$html = $this->httpGet("http://mail.google.com/$this->path/contacts/data/export?exportType=ALL&groupToExport=%5EMine&out=OUTLOOK_CSV&lang=en&hl=en&l=en");
			}
		}
		else {
			//$html = $this->httpGet("http://mail.google.com/mail/contacts/data/export?exportType=ALL&groupToExport=&out=GMAIL_CSV");
			//$html = $this->httpGet("http://mail.google.com/$this->path/contacts/data/export?exportType=ALL&groupToExport=&out=GMAIL_CSV");

			if ($limitToMyContacts) {
				$html = $this->httpGet("http://mail.google.com/$this->path/contacts/data/export?exportType=GROUP&groupToExport=%5EMine&out=GMAIL_CSV&lang=en&hl=en&l=en");
			}
			else {
				$html = $this->httpGet("http://mail.google.com/$this->path/contacts/data/export?exportType=ALL&groupToExport=%5EMine&out=GMAIL_CSV&lang=en&hl=en&l=en");
			}


		}
		//$res = _inviter_extract_gmail_csv($html);
		return $html;

/*
		$res = _inviter_extract_outlook_csv($html);
		if (!is_array($res)) {
			//Try the older CSV
			$form = new HttpForm;
			$form->addField("at", $at);
			$form->addField("ecf", "g");	//o for outlook
			$form->addField("ac", 'Export Contacts');
			$postData = $form->buildPostArray();
			$html = $this->httpPost("http://mail.google.com/mail/?ui=1&view=fec", $postData);
			$res = _inviter_extract_gmail_csv($html);
		}

		$this->close();
		return $res;
*/
	}

	//@api
	function fetchContacts ($loginemail, $password) {

		$res = $this->login($loginemail,$password);
		if ($res!=_INVITER_SUCCESS) return $res;

		//If login email ends with ".yahoo" only, then we remove it
		$loginemail = preg_replace("/^(.*?)(\.gmail)$/ims", '${1}', $loginemail);

		//$html = $this->fetchCsv($loginemail,$password,'outlook');
		$html = $this->fetchCsv('gmail');
		if ($this->lastStatusCode==200 && is_string($html)) {
			$res = _inviter_extract_gmail_csv($html);
			return $res;
		}

		//Else, problem. Try outlook version.
		$html = $this->fetchCsv('outlook');
		if (!is_string($html)) {
			return $html;
		}
		$res = _inviter_extract_outlook_csv($html);
		return $res;
	}
}

// Gmail
global $_DOMAIN_IMPORTERS;
$_DOMAIN_IMPORTERS["gmail"]='GMailImporter';
$_DOMAIN_IMPORTERS["gmail.com"]='GMailImporter';
$_DOMAIN_IMPORTERS["googlemail.com"]='GMailImporter';
$_DOMAIN_IMPORTERS["data.bg"]='GMailImporter';
//$_DOMAIN_IMPORTERS["mailbox.hu"]='GMailImporter';
$_DOMAIN_IMPORTERS["ig.com.br"]='GMailImporter';
$_DOMAIN_IMPORTERS["g.co.il"]='GMailImporter';

