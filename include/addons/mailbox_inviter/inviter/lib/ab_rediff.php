<?php

if (!defined('__ABI')) die('Please include abi.php to use this importer!');

global $_OZ_SERVICES;
$_OZ_SERVICES['rediff'] = array('type'=>'abi', 'label'=>'Rediffmail', 'class'=>'RediffImporter');


class RediffImporter extends WebRequestor {


	function getInfo () {
		return array('id'=>'rediff');
	}

	//@api
	function fetchContacts ($loginemail, $password) {

		$login = $this->getEmailParts($loginemail);
		$login = $login[0];
		$this->setOwnerEmail($loginemail);
		oz_set_domain($login[1]);

		//rediffmail sometimes fail couple of times
		$form = new HttpForm;
		$form->action = "http://mail.rediff.com/cgi-bin/login.cgi";
		$form->addField("FormName", "existing");
		$form->addField("login", $login);
		$form->addField("passwd", $password);
		$form->addField("proceed", "Sign in");
		$form->addField("_authtrkcde", "{#TRKCDE#}");
		$html = $this->postForm($form);
		if (strpos($html, 'Your login failed')!==false) {
			$this->close();
			return _inviter_set_error(_INVITER_AUTHENTICATION_FAILED,'Bad user name or password');
		}
		
		$url = oz_get_refresh_url($html);
		if ($url===NULL) {
			$this->close();
			return _inviter_set_error(_INVITER_FAILED,'Cannot find redirection url');
		}
		$html = $this->httpGet($url);

		$html = $this->httpGet("/prism/exportaddrbook?service=moutlook");
		return _inviter_extract_outlook_csv($html);


	}
}

// Rediff
global $_DOMAIN_IMPORTERS;
$_DOMAIN_IMPORTERS["rediffmail.com"]='RediffImporter';
$_DOMAIN_IMPORTERS["rediff.com"]='RediffImporter';
