<?php

if (!defined('__ABI')) die('Please include abi.php to use this importer!');

global $_OZ_SERVICES;
$_OZ_SERVICES['gmail'] = array('type'=>'abi', 'label'=>'GMail', 'class'=>'GMailImporter2');
$_OZ_SERVICES['wa_gmail'] = array('type'=>'abi', 'label'=>'GMail (Google Login)', 'class'=>'GMailImporter2');
$_OZ_SERVICES['wa_googleapps'] = array('type'=>'abi', 'label'=>'Google Apps', 'class'=>'GMailImporter2');
$_OZ_SERVICES['wa_databg'] = array('type'=>'abi', 'label'=>'Data.bg', 'class'=>'GMailImporter2');
$_OZ_SERVICES['wa_igcombr'] = array('type'=>'abi', 'label'=>'Data.bg', 'class'=>'GMailImporter2');
$_OZ_SERVICES['wa_globomail'] = array('type'=>'abi', 'label'=>'Globomail.com', 'class'=>'GMailImporter2');
$_OZ_SERVICES['wa_globo'] = array('type'=>'abi', 'label'=>'Globo.com', 'class'=>'GMailImporter2');

//@api
class GoogleCaptcha extends CaptchaChallenge {
	var $loginEmail;
	var $password;
	var $token;
}

define('GMailImporter2_AUTH_REGEX',"/^Auth=(.*?)\$/ims");
define('GMailImporter2_ERROR_REGEX',"/^Error=(.*?)\$/ims");
define('GMailImporter2_CAPTCHATOKEN_REGEX',"/^CaptchaToken=(.*?)\$/ims");
define('GMailImporter2_CAPTCHAURL_REGEX',"/^CaptchaUrl=(.*?)\$/ims");
define('GMailImporter2_ENTRY_REGEX',"/<entry[^>]*>(.*?)<\/entry>/ims");
define('GMailImporter2_TITLE_REGEX',"/<title[^>]*>(.*?)<\/title>/ims");
define('GMailImporter2_EMAIL_REGEX',"/<gd:email[^>]*?.*?address='([^']*)'/ims");

define('GMailImporter2_GROUP_REGEX',"/<entry.*?<id>([^<]*)<\/id>(.*?)<\/entry>/ims");
define('GMailImporter2_MYCONTACT_REGEX',"/<gContact:systemGroup\\s+id='Contacts'/ims");

//define('GMailImporter2_ID_REGEX',"/<id[^>]*>(.*?)<\/id>/ims");
define('GMailImporter2_AUTHOR_REGEX',"/<author[^>]*>\\s*<name>([^<]*)<\/name>\\s*<email>([^<]*)<\/email>/ims");


/////////////////////////////////////////////////////////////////////////////////////////
//GMailImporter2 (using Google Contacts API)
/////////////////////////////////////////////////////////////////////////////////////////
//@api
class GMailImporter2 extends WebRequestor {

	var $loginEmail;
	var $extraHeaders;
	var $authSubToken;

	//private List<HttpHeader> additionalHeaders;
	//private String loginEmail;

	//@api
	function getInfo () {
		return array('id'=>'gmail');
	}

	//@api
	function authSub($loginEmail, $authSubToken) {
		//Remove ".gmail" suffix
		$loginEmail = preg_replace("/^(.*?)(\.gmail)$/ims", '${1}', $loginEmail);
		
		$this->setOwnerEmail($loginEmail);
		oz_set_domain(oz_get_email_domain($loginEmail));
		
		$this->loginEmail = $loginEmail;
		$this->extraHeaders = array();
		//$this->extraHeaders[] = "Authorization: AuthSub token=\"$authSubToken\"";
		$this->authSubToken = $authSubToken;
		$this->extraHeaders[] = "GData-Version: 2";
	}

	//More formal implementation
	//@api
	function auth ($auth) {
		//$auth is a querystring format of parameters unique to this webmail authentication.
		//For Google AuthSub, the following is required:
		//token - The authsub token
		$authSubToken = NULL;
		$parts = explode('&',trim($auth));
		foreach ($parts as $part) {
			$va = explode('=',$part,2);
			if (count($va)==2) {
				$key = $va[0];
				$value = urldecode($va[1]);
				if ($key=='token') {
					$authSubToken = $value;
				}
			}
		}
		$this->extraHeaders = array();
		//Set AuthSub token later
		//$this->extraHeaders[] = "Authorization: AuthSub token=\"$authSubToken\"";
		$this->authSubToken = $authSubToken;
		$this->extraHeaders[] = "GData-Version: 2";
		oz_set_domain('gmail.com');
		
		return _inviter_set_success();
	}

	//@api
	function login ($loginEmail, $password, $captchaToken=null, $captchaAnswer=null) {

		$this->authSubToken = NULL;	//Do not use authsub for clientlogin
		$this->setOwnerEmail($loginEmail);
		oz_set_domain(oz_get_email_domain($loginEmail));

		$form = new HttpForm;
		$form->addField("accountType", "HOSTED_OR_GOOGLE");
		$form->addField("Email", $loginEmail);
		$form->addField("Passwd", $password);
		$form->addField("service", "cp"); // Contacts
		$form->addField("source", "Octazen-ABI-1");
		//$form->addField("_authtrkcde", "{#TRKCDE#}");
		if ($captchaToken!=null && $captchaAnswer!=null) {
			$form->addField("logintoken", $captchaToken);
			$form->addField("logincaptcha", $captchaAnswer);
		}
		$postData = $form->buildPostData();
		$html = $this->httpPost("https://www.google.com/accounts/ClientLogin", $postData);
		//$extraHeaders = array('Content-Type: text/plain');

		$this->extraHeaders = array();
		$this->extraHeaders[] = 'Content-Type: application/atom+xml';
		$this->extraHeaders[] = "GData-Version: 2";

		$sc = $this->lastStatusCode;
		if ($sc==200) {
			if (preg_match(GMailImporter2_AUTH_REGEX,$html,$matches)==0)
				return _inviter_set_error(_INVITER_FAILED,'Cannot find auth token');
			$auth = $matches[1];
			$this->extraHeaders[] = "Authorization: GoogleLogin auth=$auth";
			return _inviter_set_success();
		}
		else if ($sc==403) {
			if (preg_match(GMailImporter2_ERROR_REGEX,$html,$matches)>0)
				$error = trim($matches[1]);
			if ('BadAuthentication'==$error)
				return _inviter_set_error(_INVITER_AUTHENTICATION_FAILED,'Bad user name or password');
			else if ('NotVerified'==$error)
				return _inviter_set_error(_INVITER_AUTHENTICATION_FAILED,'Email address has not been verified');
			else if ('TermsNotAgreed'==$error)
				return _inviter_set_error(_INVITER_AUTHENTICATION_FAILED,'Gmail terms not agreed');
			else if ('CaptchaRequired'==$error) {
				$c = new GoogleCaptcha;
				if (preg_match(GMailImporter2_CAPTCHATOKEN_REGEX,$html,$matches2)!=0)
					$c->token = $matches2[1];
				if (preg_match(GMailImporter2_CAPTCHAURL_REGEX,$html,$matches2)!=0)
					$c->url = 'http://www.google.com/accounts/'.$matches2[1];
				$c->loginEmail = $loginEmail;
				$c->password = $password;
				_inviter_set_captcha($c);
				return _inviter_set_error(_INVITER_CAPTCHA_RAISED,'Captcha challenge raised');
			}
			// TODO: HANDLE CAPTCHA TOKENS,ETC
			else if ('AccountDeleted'==$error)
				return _inviter_set_error(_INVITER_AUTHENTICATION_FAILED,'Account deleted');
			else if ('AccountDisabled'==$error)
				return _inviter_set_error(_INVITER_AUTHENTICATION_FAILED,'Account disabled');
			else if ('ServiceDisabled'==$error)
				return _inviter_set_error(_INVITER_FAILED,'Service disabled');
			else if ('ServiceUnavailable'==$error)
				return _inviter_set_error(_INVITER_FAILED,'Google contacts service unavailable. Try again later.');
			else // if ('Unknown'==$error)
				return _inviter_set_error(_INVITER_FAILED,'Unknown gmail error');
		}
		else {
			return _inviter_set_error(_INVITER_FAILED,'Unexpected error code '.$sc);
		}
	}

	//@api
	function retrieveContacts() {
		return $this->fetchContacts();
	}

	function makeGmailAuthHeaders ($url) {
	 	if ($this->authSubToken===NULl) return array();
		if (oz_get_config('gmail.secure',FALSE)) {
			$privKeyFilePath = oz_get_config('gmail.ssl_private_key',NULL);
			if ($privKeyFilePath===NULL) $privKeyFilePath = oz_get_config('ssl.private_key');	//Backward compatibility
			$timestamp = time();  
			$nonce = md5(microtime() . mt_rand());   
			$sigalg = 'rsa-sha1';  
			
			// construct the data string  
			$data = "GET $url $timestamp $nonce";  
			// get rsa private key  
			$fp = fopen($privKeyFilePath, "r");    
			$priv_key = fread($fp, 8192);
			fclose($fp);          
			// compute signature  
			$privatekeyid = openssl_get_privatekey($priv_key);  
			openssl_sign($data, $signature, $privatekeyid, OPENSSL_ALGO_SHA1);  
			openssl_free_key($privatekeyid); 

			$sig = base64_encode($signature);

			//$this->extraHeaders[] = "Authorization: AuthSub token=\"" . $this->authSubToken . "\"";
			return array("Authorization: AuthSub token=\"".$this->authSubToken."\" data=\"$data\" sig=\"$sig\" sigalg=\"$sigalg\"");
		} else {
			return array("Authorization: AuthSub token=\"".$this->authSubToken."\"");
		}
	}


	//@api
	function fetchContacts ($loginEmail=null, $password=null) {

		if ($loginEmail!=null) {
			//Remove ".gmail" suffix
			$loginEmail = preg_replace("/^(.*?)(\.gmail)$/ims", '${1}', $loginEmail);
			$this->loginEmail = $loginEmail;
			$res = $this->login($loginEmail,$password);
			if ($res!=_INVITER_SUCCESS) {
				$err=  _inviter_get_error();
				$errcode = _inviter_get_errorcode();
				$captcha = _inviter_get_captcha();

				//Google sometimes raises a captcha exception, which doesn't happen with normal screen scraping
				if ($res==_INVITER_CAPTCHA_RAISED && class_exists('GMailImporter')) {
					$imp = new GMailImporter;
					$res2 = $imp->fetchContacts($loginEmail,$password);
					if (is_array($res2)) return $res2;
				}

				_inviter_set_captcha($captcha);
				return _inviter_set_error($errcode,$err);
			}
		}

//		$html = $this->httpRequest('http://www.google.com/m8/feeds/groups/default/full',false,null,'UTF-8',$this->extraHeaders);

//		$url = "http://www.google.com/m8/feeds/contacts/$this->loginEmail/base?max-results=10000";
//		$url = "http://www.google.com/m8/feeds/contacts/$this->loginEmail/full?max-results=10000";

		$url = "http://www.google.com/m8/feeds/contacts/default/full?max-results=10000";

		$limitToMyContacts = oz_get_config('gmail.limit_mycontacts',NULL);
		if ($limitToMyContacts===NULL) {
			$filter = oz_get_config('gmail.filter','all');
			if ($filter=='mycontacts') $limitToMyContacts=true;
		}
		//$limitToMyContacts = oz_get_config('gmail.limit_mycontacts',false);
		if ($limitToMyContacts) {
			//Get list of groups
			$mUrl = 'http://www.google.com/m8/feeds/groups/default/full';
			$html = $this->httpRequest($mUrl,false,null,'UTF-8',array_merge($this->extraHeaders, $this->makeGmailAuthHeaders($mUrl)) );
			//$html = $this->httpRequest('http://www.google.com/m8/feeds/groups/default/full',false,null,'UTF-8',$this->extraHeaders);
			preg_match_all(GMailImporter2_GROUP_REGEX, $html, $matches, PREG_SET_ORDER);
			foreach ($matches as $val) {
				$gurl = $val[1];
				$gxml = $val[2];
				if (preg_match(GMailImporter2_MYCONTACT_REGEX,$gxml,$matches2)!=0) {
					$url.="&group=".urlencode($gurl);
					break;
				}
			}
		}


		//$extraHeaders = array('Content-Type: text/plain');
		
		//$html = $this->httpRequest($url,false,null,'UTF-8',$this->extraHeaders);
		$html = $this->httpRequest($url,false,null,'UTF-8',array_merge($this->extraHeaders, $this->makeGmailAuthHeaders($url)) );
		$code = $this->lastStatusCode;
		if ($code==401) {
			return _inviter_set_error(_INVITER_AUTHENTICATION_FAILED,'Authorization required');
		}
		else if ($code/100==4 || $code/100==5) {
			return _inviter_set_error(_INVITER_FAILED,'Error fetching contacts : Error code '.$code);
		}

		//Get ID of current gmail user
		/*
		if (preg_match(GMailImporter2_ID_REGEX,$entryHtml,$matches)) {
			$user_id = htmlentities2utf8($matches[1]);
			$this->setOwnerEmail($user_id);
			//oz_set_domain(oz_get_email_domain($user_id));
		}
		*/
		if (preg_match(GMailImporter2_AUTHOR_REGEX,$html,$matches)) {
			//$author_name = htmlentities2utf8($matches[1]);	//lose the name?
			$author_email = htmlentities2utf8($matches[2]);
			$this->setOwnerEmail($author_email);
			//oz_set_domain(oz_get_email_domain($user_id));
		}

		$cl = array();

		preg_match_all(GMailImporter2_ENTRY_REGEX, $html, $matches, PREG_SET_ORDER);
		foreach ($matches as $val) {
			$entryHtml = $val[1];
			$name = null;
			if (preg_match(GMailImporter2_TITLE_REGEX,$entryHtml,$matches2)!=0)
				$name = htmlentities2utf8($matches2[1]);

			preg_match_all(GMailImporter2_EMAIL_REGEX, $entryHtml, $matches2, PREG_SET_ORDER);
			foreach ($matches2 as $val2) {
				$email = trim(htmlentities2utf8($val2[1]));
				if (_inviter_valid_email($email)) {
					$cl[] = new Contact($name,$email);
				}
			}
		}

		return _inviter_sort_contacts_by_name ($cl);
	}

/*
	//@api
	function fetchContacts2 ($loginemail, $password) {
		//We do not support fetchContacts2 in the new Gmail scraper. Revert to older version
		$imp = new GMailImporter;
		return $imp->fetchContacts2($loginemail,$password);
	}
*/

	//Returns true if captcha verification succeeded, false otherwise
	//Returns new captcha object if code was incorrect
	//@api
	function verifyCaptcha ($captcha) {
		return $this->login($captcha->loginEmail,$captcha->password,$captcha->token,$captcha->answer);
	}

	//@api
	function resumeFromCaptcha($captcha) {
		return true;
	}

}


// Gmail
global $_DOMAIN_IMPORTERS;
$_DOMAIN_IMPORTERS["gmail"]='GMailImporter2';
$_DOMAIN_IMPORTERS["gmail.com"]='GMailImporter2';
$_DOMAIN_IMPORTERS["googlemail.com"]='GMailImporter2';
$_DOMAIN_IMPORTERS["data.bg"]='GMailImporter2';
//$_DOMAIN_IMPORTERS["mailbox.hu"]='GMailImporter2';
$_DOMAIN_IMPORTERS["ig.com.br"]='GMailImporter2';
$_DOMAIN_IMPORTERS["globomail.com"]='GMailImporter2';
$_DOMAIN_IMPORTERS["globo.com"]='GMailImporter2';
$_DOMAIN_IMPORTERS["g.co.il"]='GMailImporter2';
