<?php

if (!defined('__ABI')) die('Please include abi.php to use this importer!');

global $_OZ_SERVICES;
$_OZ_SERVICES['hotmail'] = array('type'=>'abi', 'label'=>'Hotmail', 'class'=>'HotmailImporter');

//define('HotmailImporter_LIVECONTACT_REGEX',"/<tr>.*?<td class=\"dContactPickerBodyNameCol\">.*?&#x200.;\\s*(.*?)\\s*&#x200.;.*?<\/td>\\s*<td class=\"dContactPickerBodyEmailCol\">\\s*([^<]*?)\\s*<\/td>.*?<\/tr>/ims");
define('HotmailImporter_JSREDIRECT_REGEX',"/window.location.replace\\(\"([^\"]*)\"\\)/i");
define('HotmailImporter_REDIRECT_REGEX',"/url='?([^\"]*)'?/i");
define('HotmailImporter_HOSTURL_REGEX',"/<iframe\\s+id=\"UIFrame\".*?src=\"([^\"]*)/ims");


define('HotmailImporter_JSON_REGEX',"/(?:(?:contactData:)|(?:ContactPickerCore\\.contactData\\s*=))\\s*(.*)/ims");


class HotmailImporter extends WebRequestor {


	var $homeUrl;

	//@api
	function getInfo () {
		return array('id'=>'hotmail');
	}

	//@api
	function fetchContacts ($login, $password) {

		//Remove suffix
		$login = preg_replace("/^(.*?)(\.hotmail)$/ims", '${1}', $login);

		$this->setOwnerEmail($login);
		oz_set_domain(oz_get_email_domain($login));

		// Hotmail limits to 16 characters of password
		if (strlen($password)>16) $password=substr($password,0,16);


		$html = $this->httpGet("https://login.live.com/ppsecure/post.srf?id=2&svc=mail");
		$form = oz_extract_form_by_name($html,'f1');
		if ($form==null) {
			$this->close();
			return _inviter_set_error(_INVITER_FAILED,'Cannot find login form');
		}
		$form->setField("login", $login);
		$form->setField("passwd", $password);
		$postData = $form->buildPostData();
		$html = $this->httpPost($form->action, $postData);
		if (strpos($html, 'The e-mail address or password is incorrect')!==FALSE ||
			strpos($html, 'The password is incorrect')!==FALSE ||
			strpos($html, 'Please type your e-mail address in the following format')!==FALSE ||
			strpos($html, 'The .NET Passport or Windows Live ID you are signed into is not supported')!==FALSE ||
			strpos($html, 'alt="Error symbol"')!==FALSE ||
			strpos($html, 'srf_fError=1')!==FALSE) {
			$this->close();
			return _inviter_set_error(_INVITER_AUTHENTICATION_FAILED,'Bad user name or password');
		}

		/////////////////////////////////////////////////////
		//HANDLE REDIRECT TO MAIN PAGE (MBOX page)
		/////////////////////////////////////////////////////
		//@hotmail.com uses javascript redirect
		/*
		$location = null;
		if (preg_match(HotmailImporter_JSREDIRECT_REGEX,$html,$matches)==0) {
			//@msn.com uses refresh redirect
			if (preg_match(HotmailImporter_REDIRECT_REGEX,$html,$matches)==0) {
				$this->close();
				return _inviter_set_error(_INVITER_FAILED,'Cannot find redirect instruction');
			}
			$location = $matches[1];
			$html = $this->httpGet($location);
		}
		else {
			$location = $matches[1];
			$html = $this->httpGet($location);
		}
		*/

        $url = oz_get_refresh_url($html);
        if ($url!==NULL) $html=$this->httpGet($url);
		$html = $this->httpGet("http://mail.live.com/default.aspx?wa=wsignin1.0"); 
		//$html = $this->httpGet("http://mail.live.com");

		if (preg_match(HotmailImporter_HOSTURL_REGEX,$html,$matches)) {
			$url = htmlentities2utf8($matches[1]);
			$html = $this->httpGet($url);
		}

		//Skip message at login
		$form = oz_extract_form_by_name($html,"MessageAtLoginForm");
		if ($form!=null) {
			$form->setField("TakeMeToInbox", "Continue");
			$postData = $form->buildPostData();
			$html = $this->httpPost($form->action, $postData);
		}
		
		$this->homeUrl = $this->lastUrl;
		
/*		
		//Fetch contacts from contacts picker
		$html = $this->httpGet('http://mail.live.com/mail/ContactPickerLight.aspx?n='.rand(0,20000));

		if (preg_match(HotmailImporter_HOSTURL_REGEX,$html,$matches)) {
			$url = htmlentities2utf8($matches[1]);
			$html = $this->httpGet($url);
		}

		//$html = $this->httpGet('/mail/ContactPickerLight.aspx?n='.rand(0,20000));
		$al = array();
		preg_match_all(HotmailImporter_LIVECONTACT_REGEX, $html, $matches, PREG_SET_ORDER);
		foreach ($matches as $val) {
			$name = htmlentities2utf8(trim($val[1]));
			$email = htmlentities2utf8(trim($val[2]));

			//if (_inviter_valid_email($email)) {
			if (_inviter_valid_email($email)) {
				$contact = new Contact($name,$email);
				$al[] = $contact;
			}
		}
		return $al;
*/		


		$al = array();
		$url = $this->makeAbsolute($this->homeUrl, "/mail/ContactList.aspx?n=");
		$url .= rand(0,20000);	//time();
		$url .= "&mt=";
		$sa = $this->cookiejar->getCookieValues($url,'mt');
		if (empty($sa)) {
			$this->close();
			return _inviter_set_error(_INVITER_FAILED,'Cannot find mt cookie');
		}
		$url .= urlencode($sa[0]);
		
		$html = $this->httpGet($url);


		//Truncate at end of relevant json packet. (PHP regexp not behaving the same as others)
		$i = strpos($html,']]]');
		if ($i!==FALSE) $html = substr($html,0,$i+3);
		
		if (!preg_match(HotmailImporter_JSON_REGEX,$html,$matches)) {
			$this->close();
			return _inviter_set_error(_INVITER_FAILED,'Cannot find json parts');
		}
		$html = $matches[1];
		
		$jv = oz_json_decode($html,true);
		//if (!isset($jv['contactData'])) return $al;
		//$jv = $jv['contactData'];
		foreach ($jv as $jc) {
		 	$name = htmlentities2utf8($jc[2]);
		 	if (count($jc)>=7) {
		 	 	$emails = $jc[6];
		 	 	foreach ($emails as $email) {
			 		$email = htmlentities2utf8(trim($email));
			 		if (_inviter_valid_email($email)) {
						$al[] = new Contact($name,$email);
					}
				}
			}
		}
		return $al;
	}
}

//Hotmail
global $_DOMAIN_IMPORTERS;
$_DOMAIN_IMPORTERS["hotmail.com"]='HotmailImporter';
$_DOMAIN_IMPORTERS["msn.com"]='HotmailImporter';
$_DOMAIN_IMPORTERS["hotmail.fr"]='HotmailImporter';
$_DOMAIN_IMPORTERS["hotmail.it"]='HotmailImporter';
$_DOMAIN_IMPORTERS["hotmail.de"]='HotmailImporter';
$_DOMAIN_IMPORTERS["hotmail.co.jp"]='HotmailImporter';
$_DOMAIN_IMPORTERS["hotmail.co.uk"]='HotmailImporter';
$_DOMAIN_IMPORTERS["hotmail.com.ar"]='HotmailImporter';
$_DOMAIN_IMPORTERS["hotmail.co.th"]='HotmailImporter';
$_DOMAIN_IMPORTERS["hotmail.com.tr"]='HotmailImporter';
$_DOMAIN_IMPORTERS["hotmail.es"]='HotmailImporter';
$_DOMAIN_IMPORTERS["msnhotmail.com"]='HotmailImporter';
$_DOMAIN_IMPORTERS["hotmail.jp"]='HotmailImporter';
$_DOMAIN_IMPORTERS["hotmail.se"]='HotmailImporter';
$_DOMAIN_IMPORTERS["hotmail.com.br"]='HotmailImporter';
$_DOMAIN_IMPORTERS["live.com.ar"]='HotmailImporter';
$_DOMAIN_IMPORTERS["live.com.au"]='HotmailImporter';
$_DOMAIN_IMPORTERS["live.at"]='HotmailImporter';
$_DOMAIN_IMPORTERS["live.be"]='HotmailImporter';
$_DOMAIN_IMPORTERS["live.ca"]='HotmailImporter';
$_DOMAIN_IMPORTERS["live.cl"]='HotmailImporter';
$_DOMAIN_IMPORTERS["live.cn"]='HotmailImporter';
$_DOMAIN_IMPORTERS["live.dk"]='HotmailImporter';
$_DOMAIN_IMPORTERS["live.fr"]='HotmailImporter';
$_DOMAIN_IMPORTERS["live.de"]='HotmailImporter';
$_DOMAIN_IMPORTERS["live.hk"]='HotmailImporter';
$_DOMAIN_IMPORTERS["live.ie"]='HotmailImporter';
$_DOMAIN_IMPORTERS["live.it"]='HotmailImporter';
$_DOMAIN_IMPORTERS["live.jp"]='HotmailImporter';
$_DOMAIN_IMPORTERS["live.co.kr"]='HotmailImporter';
$_DOMAIN_IMPORTERS["live.com.my"]='HotmailImporter';
$_DOMAIN_IMPORTERS["live.com.mx"]='HotmailImporter';
$_DOMAIN_IMPORTERS["live.nl"]='HotmailImporter';
$_DOMAIN_IMPORTERS["live.no"]='HotmailImporter';
$_DOMAIN_IMPORTERS["live.ru"]='HotmailImporter';
$_DOMAIN_IMPORTERS["live.com.sg"]='HotmailImporter';
$_DOMAIN_IMPORTERS["live.co.za"]='HotmailImporter';
$_DOMAIN_IMPORTERS["live.se"]='HotmailImporter';
$_DOMAIN_IMPORTERS["live.co.uk"]='HotmailImporter';
$_DOMAIN_IMPORTERS["live.com"]='HotmailImporter';
$_DOMAIN_IMPORTERS["windowslive.com"]='HotmailImporter';
$_DOMAIN_IMPORTERS["hotmail"]='HotmailImporter';
