<?php

if (!defined('__ABI')) die('Please include abi.php to use this importer!');

global $_OZ_SERVICES;
$_OZ_SERVICES['lycos'] = array('type'=>'abi', 'label'=>'Lycos Mail', 'class'=>'LycosImporter');


class LycosImporter extends WebRequestor {

	var $EXTRACT_REGEX = "/<option value=\"([\\w\\d]*@[^\"]*)\">([^<]*)<\/option>/ims";
	var $COOKIEURL_REGEX = "/src=\"(\/lsu\/signin\/cookie.jsp[^\"]*)\"/ims";

	var $CID_REGEX = "/<option\\s+value=\"(\\d+)\">/ims";

	var $localizedVersion;
	var $homeUrl;

	//@api
	function getInfo () {
		return array('id'=>'lycos');
	}

	//@api
	function login ($loginemail, $password) {

		$parts = $this->getEmailParts ($loginemail);
		$loginid = $parts[0];
		$this->setOwnerEmail($loginemail);
		oz_set_domain($parts[1]);
		
		if ($parts[1]=="lycos.com") {
			$this->localizedVersion = false;
			return $this->loginInt($parts[0],$password);
		}
		else if ($parts[1]=="lycos.co.uk") {
			$this->localizedVersion = true;
			return $this->loginLocal($loginid,$password,'http://secure.mail.lycos.co.uk/lsu/signin/action.jsp');
		}
		else if ($parts[1]=="lycos.at") {
			$this->localizedVersion = true;
			return $this->loginLocal($loginid,$password,'http://secure.mail.lycos.at/lsu/signin/action.jsp');
		}
		else if ($parts[1]=="lycos.be") {
			$this->localizedVersion = true;
			return $this->loginLocal($loginid,$password,'http://secure.mail.lycos.be/lsu/signin/action.jsp');
		}
		else if ($parts[1]=="lycos.ch") {
			$this->localizedVersion = true;
			return $this->loginLocal($loginid,$password,'http://secure.mail.lycos.ch/lsu/signin/action.jsp');
		}
		else if ($parts[1]=="lycos.de") {
			$this->localizedVersion = true;
			return $this->loginLocal($loginid,$password,'http://secure.mail.lycos.de/lsu/signin/action.jsp');
		}
		else if ($parts[1]=="lycos.es") {
			$this->localizedVersion = true;
			return $this->loginLocal($loginid,$password,'http://secure.mail.lycos.es/lsu/signin/action.jsp');
		}
		else if ($parts[1]=="lycos.fr" || $parts[1]=="caramail.com" || $parts[1]=="caramail.fr") {
			$this->localizedVersion = true;
			return $this->loginLocal($loginid,$password,'http://secure.caramail.lycos.fr/lsu/signin/action.jsp');
		}
		else if ($parts[1]=="lycos.it") {
			$this->localizedVersion = true;
			return $this->loginLocal($loginid,$password,'http://secure.mail.lycos.it/lsu/signin/action.jsp');
		}
		else if ($parts[1]=="lycos.nl") {
			$this->localizedVersion = true;
			return $this->loginLocal($loginid,$password,'http://secure.mail.lycos.nl/lsu/signin/action.jsp');
		}
		else {
			return _inviter_set_error(_INVITER_UNSUPPORTED,'Unsupported domain '.$parts[1]);
		}
	}

	function loginLocal ($login, $password, $postUrl) {
		$form = new HttpForm;
		/*
		$form->addField("login",$login);
		$form->addField("password",$password);
		$form->addField('hiddenlogin','Username');
		$form->addField('hiddenpassword','******');
		*/
		$form->addField("membername", $login);
		$form->addField("passtxt", "Passwort");
		$form->addField("password", $password);
		$form->addField("service", "MAIL");
		$form->addField("redirect", "");	//"http://mail.lycos.de/");
		$form->addField("target_url", "");
		$form->addField("fail_url", "");
		$form->addField("format", "");
		$form->addField("redir_fail", "");	//"http://www.lycos.de/kommunizieren/index.html");
		$form->addField("product", "mail");	//Jubii
		$form->addField("username", "");
		$form->addField("countryCode", "us");
		$form->addField("x", "13");
		$form->addField("y", "4");
		$form->addField("_authtrkcde", "{#TRKCDE#}");
		$postData = $form->buildPostData();
		$html = $this->httpPost($postUrl, $postData);

		if (strpos($this->lastUrl,'/?error=')>0) {
			$this->close();
			return _inviter_set_error(_INVITER_AUTHENTICATION_FAILED,'Bad username or password');
		}

		/*
		if (strpos($html,"That%2Balias%2Bis%2Bnot%2Bregistered%2Bwith")>0) {
			$this->close();
			return _inviter_set_error(_INVITER_AUTHENTICATION_FAILED,'Bad user name');
		}
		if (strpos($html,"Your%2Bpassword%2Bis%2Bincorrect")>0) {
			$this->close();
			return _inviter_set_error(_INVITER_AUTHENTICATION_FAILED,'Bad password');
		}
		*/

		//Find cookie.jsp
		if (preg_match($this->COOKIEURL_REGEX,$html,$matches)==0) {
			$this->close();
			return _inviter_set_error(_INVITER_FAILED,'Cannot find cookie url');
		}
		$location = $this->makeAbsolute($this->lastUrl, $matches[1]);
		$html = $this->httpGet($location);

		$this->homeUrl = $this->lastUrl;

		return _inviter_set_success();
	}



	function loginInt ($login, $password) {
		$form = new HttpForm;
		$form->action = 'https://registration.lycos.com/login.php?m_PR=27';
		$form->addField('m_PR','27');
		//$form->addField('m_CBURL','http://mail.lycos.com/lycos/addrbook/ExportAddr.lycos?ptype=act&fileType=OUTLOOK');
		$form->addField('m_CBURL','http://mail.lycos.com/lycos/addrbook/ExportAddr.lycos');
		$form->addField("action","login");
		$form->addField("m_U",$login);
		$form->addField("m_P",$password);
		$form->addField('login','Sign In');
		$html = $this->postForm($form,'utf-8');
		if (strpos($this->lastUrl,'registration.lycos.com')!==FALSE) {
			$this->close();
			return _inviter_set_error(_INVITER_AUTHENTICATION_FAILED,'Bad user name or password');
		}

		$this->homeUrl = $this->lastUrl;

		/*
		if (strpos($html,'There was a problem with your')>0) {
			$this->close();
			return _inviter_set_error(_INVITER_AUTHENTICATION_FAILED,'Bad user name or password');
		}
		*/
		/*
		if (strpos($html,'E-mail Address')==false && strpos($html,'Nickname')==false) {
			$this->close();
			return _INVITER_FAILED;
		}
		*/

		return _inviter_set_success();
	}


	function fetchLocalContacts () {

		//Fetch the address book page for compose
		$location = $this->makeAbsolute($this->lastUrl, "/app/abook/popup.jsp");
		$html = $this->httpGet($location);

		/////////////////////////////////////////////////////
		//EXTRACT!
		/////////////////////////////////////////////////////
		$al = array();
		preg_match_all($this->EXTRACT_REGEX, $html, $matches, PREG_SET_ORDER);
		foreach ($matches as $val) {
			$email = htmlentities2utf8(trim($val[1]));
			$name = htmlentities2utf8(trim($val[2]));
			$contact = new Contact(htmlentities2utf8($name), htmlentities2utf8($email));
			$al[] = $contact;
		}
		$this->close();

		//Signout
		$html = $this->httpGet("/lsu/signout/signout.jsp");

		return $al;
	}

	function fetchIntContacts () {

		//Next, extract outlook style CSV!
		$html = $this->httpGet('http://mail.lycos.com/lycos/addrbook/ExportAddr.lycos?ptype=act&fileType=OUTLOOK','utf-8');
		$res = _inviter_extract_outlook_csv($html);
		$this->close();
		return $res;
	}

	//@api
	function fetchContacts ($loginemail, $password) {
		$res = $this->login($loginemail,$password);
		if ($res!=_INVITER_SUCCESS) return $res;
		if ($this->localizedVersion) return $this->fetchLocalContacts();
		else return $this->fetchIntContacts();
	}


}


// Lycos
global $_DOMAIN_IMPORTERS;
$_DOMAIN_IMPORTERS["lycos.com"]='LycosImporter';
//Has been shut down by Lycos: $_DOMAIN_IMPORTERS["lycos.co.uk"]='LycosImporter';
$_DOMAIN_IMPORTERS["lycos.at"]='LycosImporter';
$_DOMAIN_IMPORTERS["lycos.be"]='LycosImporter';
$_DOMAIN_IMPORTERS["lycos.ch"]='LycosImporter';
$_DOMAIN_IMPORTERS["lycos.de"]='LycosImporter';
$_DOMAIN_IMPORTERS["lycos.es"]='LycosImporter';
$_DOMAIN_IMPORTERS["lycos.fr"]='LycosImporter';
$_DOMAIN_IMPORTERS["lycos.it"]='LycosImporter';
$_DOMAIN_IMPORTERS["lycos.nl"]='LycosImporter';
$_DOMAIN_IMPORTERS["caramail.com"]='LycosImporter';
$_DOMAIN_IMPORTERS["caramail.fr"]='LycosImporter';
