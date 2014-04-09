<?php
define ('OZE_SUCCESS',200);
define ('OZE_FAILED',400);
define ('OZE_NO_SESSION',601);
define ('OZE_FORMAT_ERROR',602);
define ('OZE_AUTHENTICATION_FAILED',603);
define ('OZE_CAPTCHA',604);
define ('OZE_INPUT_REQUIRED',605);
define ('OZE_BLOCKED',606);
define ('OZE_UNSUPPORTED',607);
define ('OZE_UNSUPPORTED_OPERATION',608);
define ('OZE_INVALID_FILE_FORMAT',609);

//@api
function oz_get_error_message($err)
{
	switch ($err) {
		case OZE_SUCCESS: return 'Success';
		case OZE_FAILED: return 'Operation Failed';
		case OZE_NO_SESSION: return 'You must login first';
		case OZE_FORMAT_ERROR: return 'Received bad data from server';
		case OZE_AUTHENTICATION_FAILED: return 'Authentication failed. Bad user name or password.';
		case OZE_CAPTCHA: return 'Captcha challenge raised';
		case OZE_INPUT_REQUIRED: 'Manual user input required';
		case OZE_BLOCKED: 'Blocked';
		case OZE_UNSUPPORTED: return 'Unsupported service';
		case OZE_UNSUPPORTED_OPERATION: return 'Unsupported operation';
		case OZE_INVALID_FILE_FORMAT: return 'Invalid file format';
		default:
			return 'Unknown error';
	}
}


//@api
function oz_translate_error($errcode)
{
	switch ($errcode) {
		case _INVITER_SUCCESS: return OZE_SUCCESS;
		case _INVITER_AUTHENTICATION_FAILED:	return OZE_AUTHENTICATION_FAILED;
		case _INVITER_UNSUPPORTED: return OZE_UNSUPPORTED;
		case _INVITER_CAPTCHA_RAISED: return OZE_CAPTCHA;
		case _INVITER_USER_INPUT_REQUIRED: return OZE_INPUT_REQUIRED;
		case _INVITER_BLOCKED: return OZE_BLOCKED;
		case _INVITER_FAILED:
		default:
			return OZE_FORMAT_ERROR;
	}
}

//@api
function oz_sort_compare_contacts(&$c1,&$c2)
{
	return strcasecmp($c1['name'],$c2['name']);
}

//@api
function oz_translate_contacts($contacts)
{
	$cl = array();
	foreach ($contacts as $c)
	{
		if (oz_instanceof($c,'Contact'))
		{
			$c2 = array();
			$c2['type'] = 'email';
			$c2['id'] = $c->email;
			$c2['name'] = $c->name;
			$c2['email'] = $c->email;
			$cl[] = $c2;
		}
		else if (oz_instanceof($c,'SocialContact'))
		{
			$c2 = array();
			$c2['type'] = 'social';
			$c2['id'] = $c->uid;
			$c2['name'] = $c->name;
			$c2['uid'] = $c->uid;
			$c2['image'] = $c->imgurl;
			$cl[] = $c2;
		}
		//Support others in future
	}

	usort($cl, "oz_sort_compare_contacts");
	return $cl;
}






//@api
class OzInviter
{
	var $obj;
	var $contacts;
	var $captcha;	//The last captcha object
	var $config;
	var $service_id;
	var $owner_email;

	//@api
	function OzInviter() {
	}
	
	//@api
	function setConfig($config) {
		$this->config = $config;
	}
	
	function _updateConfig() {
		if ($this->config) foreach ($this->config as $k=>$v) oz_set_config($k,$v);
	}

	//---------------------------------------------------------------------------
	//login
	//
	//listtype is null for now.
	//We will support "expanded" (1 contact = 1 name+1email, abcontact, etc)
	//---------------------------------------------------------------------------
	//@api
	function login ($loginemail, $password, $service='', $listtype=NULL)
	{
		if ($this->obj!==NULL) $this->logout();
		$this->contacts = NULL;
		$this->captcha = NULL;
		$this->owner_email = NULL;

		$this->_updateConfig();

		//Create service object instance
		if (!empty($service))
		{
			if ($service[0]!=='.') $fullemail = $loginemail.'.'.$service;
			else $fullemail = $loginemail.$service;
		}
		else
		{
			$fullemail = $loginemail;
		}
		$this->obj = _inviter_new_importer($fullemail);
		if ($this->obj===NULL)
		{
			global $_OZ_SERVICES;
			//It's not a webmail service. It may be a social network service instead.
			if (!isset($_OZ_SERVICES[$service])) return OZE_UNSUPPORTED;
			$svcinfo = $_OZ_SERVICES[$service];
			$classname = $svcinfo['class'];
			if (!class_exists($classname)) return OZE_UNSUPPORTED;
			$this->obj = new $classname;	//eval('return new '.$classname.';');
		}

			
		if (method_exists($this->obj,'getInfo')) {
			$info = $this->obj->getInfo();
			$this->service_id = $info['id'];
		}
		else {
			//If getInfo() not implemented, derive name from class name
			$classname = get_class($this->obj);
			$classname = preg_replace("/^(.*?)(\Importer)$/ims", '${1}', $classname);
			$this->service_id = strtolower(preg_replace("/^(.*?)(\Inviter)$/ims", '${1}', $classname));
		}


		//If this is a social network, then just do login first
		if (method_exists($this->obj,'sendMessages'))
		{
			$res = $this->obj->login($loginemail,$password);
			$this->owner_email = $this->obj->getOwnerEmail();
			if (oz_instanceof($res,'CaptchaChallenge'))
			{
				$this->captcha = $res;
				return OZE_CAPTCHA;
			}
			if ($res==_INVITER_SUCCESS)
			{
				$this->owner_email = $this->obj->getOwnerEmail();
				return OZE_SUCCESS;
			}
			else {
				//Free the object
				$this->obj = NULL;
				return oz_translate_error($res);
			}
		}
		//Else this is a webmail importer. Fetch contacts anyway
		else
		{
			$res = $this->obj->fetchContacts($loginemail,$password);
			$this->owner_email = $this->obj->getOwnerEmail();
			if ($res==_INVITER_CAPTCHA_RAISED)
			{
				$this->captcha = _inviter_get_captcha();
				return OZE_CAPTCHA;
			}
			else if (is_array($res))
			{
				$res = _inviter_dedupe_contacts_by_email($res);
				$this->contacts = $res;

				//We actually no longer need to hold the instance
				$this->obj = NULL;

				return OZE_SUCCESS;
			}
			else {
				//Free the object
				$this->obj = NULL;
				return oz_translate_error($res);
			}
		}
	}

	//---------------------------------------------------------------------------
	//logout
	//---------------------------------------------------------------------------
	//@api
	function logout ()
	{
		if ($this->obj!==NULL)
		{
			//Only for social networks, yeah.
			if (method_exists($this->obj,'sendMessages') && method_exists($this->obj,'logout'))
				$this->obj->logout();
		}
		$this->obj = NULL;
		$this->captcha = NULL;
		return OZE_SUCCESS;
	}


	//---------------------------------------------------------------------------
	//auth
	//
	//For services supporting browser based authentication instead of id+password,
	//we store the consent/authorization token here. ($authstr). Examples include
	//Google AuthSub, Windows Live [Delegated] Login, Yahoo bbauth, Facebook auth,etc.
	//
	//$authstr
	//	The authorization token, in the form of querystring. The exact parameters
	//	depends on the service being authenticated against.
	//
	//$service
	//	The service supporting the authentication mechanism. Names are generally prefixed
	//	with "wa_" (for web authentication)
	//---------------------------------------------------------------------------
	//@api
	function auth($authstr, $service)
	{
		$this->_updateConfig();
	
		if ($this->obj!==NULL) $this->logout();

		global $_OZ_SERVICES;
		if (!isset($_OZ_SERVICES[$service])) return OZE_UNSUPPORTED;
		$svcinfo = $_OZ_SERVICES[$service];
		$classname = $svcinfo['class'];
		if (!class_exists($classname)) return OZE_UNSUPPORTED;
		$this->obj = new $classname;// eval('return new '.$classname.';');
		if (!method_exists($this->obj,'auth')) 
		{
			$this->obj = NULL;
			return OZE_UNSUPPORTED_OPERATION;
		}

		$this->contacts = NULL;
		$this->captcha = NULL;

		//Authenticate/Save token
		$res = $this->obj->auth($authstr);
		if ($res!==_INVITER_SUCCESS) 
		{
			$this->obj = NULL;
			return oz_translate_error($res);
		}
		return OZE_SUCCESS;
	}

	//---------------------------------------------------------------------------
	//fetch_contacts
	//---------------------------------------------------------------------------
	//@api
	function fetch_contacts()
	{
		$this->_updateConfig();
	
		$this->captcha = NULL;
		if ($this->contacts===NULL)
		{
			if ($this->obj===NULL) return OZE_NO_SESSION;

			if (method_exists($this->obj,'retrieveContacts')) $res = $this->obj->retrieveContacts();
			else $res = $this->obj->fetchContacts();
			if (empty($this->owner_email)) $this->owner_email = $this->obj->getOwnerEmail();
			if (!is_array($res))
			{
				if (oz_instanceof($res,'CaptchaChallenge'))
				{
					$this->captcha = $res;
					return OZE_CAPTCHA;
				}
				return oz_translate_error($res);
			}
			$this->contacts = $res;
		}
		return oz_translate_contacts($this->contacts);
	}

	//---------------------------------------------------------------------------
	//get_supported_services
	//---------------------------------------------------------------------------
	//@api
	function get_supported_services()
	{
		global $_OZ_SERVICES;
		return $_OZ_SERVICES;
	}

	//---------------------------------------------------------------------------
	//is_service_supported
	//---------------------------------------------------------------------------
	//@api
	function is_service_supported($svcid)
	{
		return oz_is_service_supported($svcid);
	}

	//---------------------------------------------------------------------------
	//get_supported_domains
	//---------------------------------------------------------------------------
	//@api
	function get_supported_domains()
	{
		global $_DOMAIN_IMPORTERS;
		//Ignore domains without "." inside it( eg. gmail is ignored. gmail.com is taken)
		$al = array();
		foreach ($_DOMAIN_IMPORTERS as $domain=>$classname)
			if (strpos($domain,'.')!==FALSE) $al[]=$domain;
		sort($al);
		return $al;
	}

	//---------------------------------------------------------------------------
	//send_messages
	//
	//$recipients is an array of contact['id'] field. This may be email or uid.
	//---------------------------------------------------------------------------
	//@api
	function send_messages ($recipients, $subject, $message, $format='text')
	{
		$this->_updateConfig();
	
		if (method_exists($this->obj,'sendMessages'))
		{
			if ($this->obj===NULL) return OZE_NO_SESSION;

			//Social network
			$uids = array();
			foreach ($recipients as $r) $uids[] = is_array($r) ? $r['uid'] : $r;
			$res = $this->obj->sendMessages($uids,$subject,$message);
			if (oz_instanceof($res,'CaptchaChallenge'))
			{
				$this->captcha = $res;
				return OZE_CAPTCHA;
			}
			//$res can be true/false or CaptchaChallenge.
			if (is_int($res)) return oz_translate_error($res);
			else return $res==true ? OZE_SUCCESS : OZE_FAILED;
		}
		else
		{
			return OZE_UNSUPPORTED_OPERATION;
			/*
			//It's email based
			if (function_exists('oz_send_messages'))
			{
				return oz_send_messages($recipients,$subject,$message,$format);
			}
			else
			{
				return OZE_UNSUPPORTED_OPERATION;
			}
			*/
		}


	}

	//---------------------------------------------------------------------------
	//answer_captcha (and resume previous task)
	//---------------------------------------------------------------------------
	//@api
	function answer_captcha ($answer)
	{
		$this->_updateConfig();
	
		if ($this->obj===NULL) return OZE_NO_SESSION;
		if ($this->captcha===NULL) return OZE_UNSUPPORTED_OPERATION;
		$this->captcha->answer = $answer;
		if (method_exists($this->obj,'verifyCaptcha'))
		{
			//Verify the captcha
			$res = $this->obj->verifyCaptcha($this->captcha);
			if (oz_instanceof($res,'CaptchaChallenge'))
			{
				$this->captcha = $res;
				return OZE_CAPTCHA;
			}
			//Note that $res is either boolean or a CaptchaChallenge
			//if ($res===FALSE) return OZE_FAILED;

			//Resume the operation
			$res = $this->obj->resumeFromCaptcha($this->captcha);
			if (oz_instanceof($res,'CaptchaChallenge'))
			{
				$this->captcha = $res;
				return OZE_CAPTCHA;
			}
			//FIXME: WHAT IF THE RETURNED ITEM IS THE CONTACTS LIST???
			$this->captcha = NULL;
			if (is_int($res)) return oz_translate_error($res);
			else return $res==true ? OZE_SUCCESS : OZE_FAILED;
		}
		return OZE_UNSUPPORTED_OPERATION;
	}

	//---------------------------------------------------------------------------
	//parse_contacts_file
	//
	//Format takes in olcsv, tbldif, tbcsv,vcf. Blank for auto?
	//---------------------------------------------------------------------------
	//@api
	function parse_contacts_file ($file, $format='olcsv', $charset='UTF-8')
	{
		$this->_updateConfig();
		$file = oz_convert_charset($file, $charset, 'UTF-8');
	
		$res = _INVITER_FAILED;
		switch ($format) {
		case 'olcsv':
		case 'oecsv':
		case 'wmcsv':	//windows mail
			$res = _inviter_extractContactsFromCsv ($file);
			break;
		case 'tbcsv':
			$res = _inviter_extractContactsFromThunderbirdCsv($file);
			break;
		case 'tbldif':
			$res = _inviter_extractContactsFromLdif($file);
			break;
		case 'gmailcsv':
			$res = _inviter_extractContactsFromGmailCsv($file);
			break;
		case 'yahoocsv':
			$res = _inviter_extractContactsFromYahooCsv($file);
			break;
		case 'vcf':
			$res = _inviter_extractContactsFromVcard($file);
			break;
		}
		if (is_array($res)) return oz_translate_contacts($res);
		else return OZE_INVALID_FILE_FORMAT;
		//return oz_translate_error($res);
	}

	//---------------------------------------------------------------------------
	//get_captcha_image_url
	//---------------------------------------------------------------------------
	//@api
	function get_captcha_image_url ()
	{
		//Get the last captcha object raised (only if returned error is OZE_CAPTCHA)
		if ($this->captcha===NULL) return NULL;
		else return $this->captcha->url;
	}

	//---------------------------------------------------------------------------
	//get_remaining_count
	//---------------------------------------------------------------------------
	//@api
	function get_remaining_count()
	{
		//Get the last captcha object raised (only if returned error is OZE_CAPTCHA)
		if ($this->captcha===NULL) return 0;
		else return $this->captcha->remainingCount;
	}
	
	//@api
	function get_service_id () {
		return $this->service_id;
	}
	
	//@api
	function get_owner_email() {
		//Returns owner email address, null if cannot be determined.
		//This is available only after logging in and fetching contacts.
		return $this->owner_email;
	}
	
}
