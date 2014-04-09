<?php

if (!defined('__ABI')) die('Please include abi.php to use this importer!');

global $_OZ_SERVICES;
$_OZ_SERVICES['yahoo'] = array('type'=>'abi', 'label'=>'Yahoo', 'class'=>'YahooImporter');

class YahooImporter extends WebRequestor {

	var $CRUMB_REGEX = "/<input\\s+type=\"hidden\"\\s+name=\"\\.crumb\"[^>]*?value=\"([^\"]*)\"[^>]*>/ims";

	//@api
	function getInfo () {
		return array('id'=>'yahoo');
	}

	//@api
	function login ($loginemail, $password) {

		//Yahoo may have issues with domain case sensitivity
		$loginemail = strtolower($loginemail);

		//If login email ends with ".yahoo" only, then we remove it
		$loginemail = preg_replace("/^(.*?)(\.yahoo)$/ims", '${1}', $loginemail);

		//Bug with yahoo. If user id part contains ".", we cannot use full email address.
		//We'll have to assume it's for the domain yahoo.com.
		$parts = $this->getEmailParts ($loginemail);
		$login = $parts[0];
		if (strpos($login,'.')>0) {
			$loginemail = $login;
		}
		$this->setOwnerEmail($loginemail);
		oz_set_domain($parts[1]);

		//Yahoo fails at times. Retry few times
		//for ($times=0; $times<2; ++$times) {
			$form = new HttpForm;
			$form->addField('.tries','1');
			$form->addField('.src','ab');
			$form->addField('.md5','');
			$form->addField('.hash','');
			$form->addField('.js','');
			$form->addField('.last','');
			$form->addField('promo','');
			$form->addField('.intl','us');
			$form->addField('.bypass','');
			$form->addField('.partner','');
			$form->addField('.v','0');
			$form->addField('.yplus','');
			$form->addField('.emailCode','');
			$form->addField('pkg','');
			$form->addField('stepid','');
			$form->addField('.ev','');
			$form->addField('hasMsgr','0');
			$form->addField('.chkP','Y');
			$form->addField('.done','http://address.yahoo.com');
			$form->addField('.pd','ab_ver=0');
			$form->addField('submit','Sign In');
			$form->addField('abc','xyz');
			$form->addField('abc','xyz');
			$form->addField("login",$loginemail);
			$form->addField("passwd",$password);
			$form->addField("_authtrkcde", "{#TRKCDE#}");
			$postData = $form->buildPostData();
			$html = $this->httpPost('https://login.yahoo.com/config/login?', $postData);

			if (strpos($html,'name=".secword"')>0) {
				$this->close();
				_inviter_set_captcha(null);
				return _inviter_set_error(_INVITER_CAPTCHA_RAISED,'Captcha challenge was issued. Please login through Yahoo mail manually.');
			}

			//if (strpos($html,'This ID is not yet taken')===false && strpos($html,'Invalid ID or password')===false && strpos($html,'yregertxt')===false)
			//	break;
		//}


		if (strpos($html,'This ID is not yet taken')!==false || strpos($html,'Invalid ID or password')!==false || strpos($html,'yregertxt')!==false) {
			$this->close();
			return _inviter_set_error(_INVITER_AUTHENTICATION_FAILED,'Bad user name or password');
		}

		return _inviter_set_success();
	}

	function fetchCsv ($fmt='yahoo') {

		$form = new HttpForm;

		//Add crumb support
		$html2 = $this->httpGet("http://address.yahoo.com/?1&VPC=import_export");
		if (preg_match($this->CRUMB_REGEX,$html2,$matches)) {
			$crumb = htmlentities2utf8($matches[1]);
			$form->addfield('.crumb',$crumb);
		}

		$form->addField('VPC','import_export');
		$form->addField('A','B');
		//submit[action_export_outlook]
		if ($fmt=='outlook') {
			$form->addField('submit[action_export_outlook]','Export Now');
		}
		else if ($fmt=='ldif') {
			$form->addField('submit[action_export_ldif]','Export Now');
		}
		else {
			$form->addField('submit[action_export_yahoo]','Export Now');
		}

		$postData = $form->buildPostData();
		$html = $this->httpPost('http://address.yahoo.com/index.php', $postData);

		$this->close();
		return $html;
	}

	//@api
	function fetchContacts ($loginemail, $password) {

		$res = $this->login($loginemail, $password);
		if ($res!=_INVITER_SUCCESS) return $res;

		$html = $this->fetchCsv('yahoo');
		if (!is_string($html)) return $html;
		$res = _inviter_extract_yahoo_csv($html);
		return $res;

		/*
		if (defined('_INVITER_IM_AS_EMAIL') && _INVITER_IM_AS_EMAIL==true) {
			$html = $this->fetchCsv('yahoo');
			if (!is_string($html)) return $html;
			$res = _inviter_extract_yahoo_csv($html);
			return $res;
		}
		else {
			$html = $this->fetchCsv('ldif');
			if (!is_string($html)) return $html;
			$res = _inviter_extractContactsFromLdif($html);
			return $res;
		}
		*/
	}
}


// Yahoo
global $_DOMAIN_IMPORTERS;
$_DOMAIN_IMPORTERS["yahoo"]='YahooImporter';
$_DOMAIN_IMPORTERS["ymail.com"]='YahooImporter';
$_DOMAIN_IMPORTERS["y7mail.com"]='YahooImporter';
$_DOMAIN_IMPORTERS["rocketmail.com"]='YahooImporter';
$_DOMAIN_IMPORTERS["yahoo.com"]='YahooImporter';
$_DOMAIN_IMPORTERS["yahoo.com.ar"]='YahooImporter';
$_DOMAIN_IMPORTERS["yahoo.com.au"]='YahooImporter';
$_DOMAIN_IMPORTERS["yahoo.com.br"]='YahooImporter';
$_DOMAIN_IMPORTERS["yahoo.com.cn"]='YahooImporter';
$_DOMAIN_IMPORTERS["yahoo.com.hk"]='YahooImporter';
$_DOMAIN_IMPORTERS["yahoo.com.kr"]='YahooImporter';
$_DOMAIN_IMPORTERS["yahoo.com.my"]='YahooImporter';
$_DOMAIN_IMPORTERS["yahoo.com.au"]='YahooImporter';
$_DOMAIN_IMPORTERS["yahoo.com.no"]='YahooImporter';
$_DOMAIN_IMPORTERS["yahoo.com.ph"]='YahooImporter';
$_DOMAIN_IMPORTERS["yahoo.com.ru"]='YahooImporter';
$_DOMAIN_IMPORTERS["yahoo.com.sg"]='YahooImporter';
$_DOMAIN_IMPORTERS["yahoo.com.es"]='YahooImporter';
$_DOMAIN_IMPORTERS["yahoo.com.se"]='YahooImporter';
$_DOMAIN_IMPORTERS["yahoo.com.tr"]='YahooImporter';
$_DOMAIN_IMPORTERS["yahoo.com.tw"]='YahooImporter';
$_DOMAIN_IMPORTERS["yahoo.com.mx"]='YahooImporter';
$_DOMAIN_IMPORTERS["yahoo.com.vn"]='YahooImporter';
$_DOMAIN_IMPORTERS["yahoo.be"]='YahooImporter';
$_DOMAIN_IMPORTERS["yahoo.at"]='YahooImporter';
$_DOMAIN_IMPORTERS["yahoo.es"]='YahooImporter';
$_DOMAIN_IMPORTERS["yahoo.se"]='YahooImporter';
$_DOMAIN_IMPORTERS["yahoo.ie"]='YahooImporter';
$_DOMAIN_IMPORTERS["yahoo.ca"]='YahooImporter';
$_DOMAIN_IMPORTERS["yahoo.dk"]='YahooImporter';
$_DOMAIN_IMPORTERS["yahoo.fr"]='YahooImporter';
$_DOMAIN_IMPORTERS["yahoo.de"]='YahooImporter';
$_DOMAIN_IMPORTERS["yahoo.gr"]='YahooImporter';
$_DOMAIN_IMPORTERS["yahoo.it"]='YahooImporter';
$_DOMAIN_IMPORTERS["yahoo.in"]='YahooImporter';
$_DOMAIN_IMPORTERS["yahoo.kr"]='YahooImporter';
$_DOMAIN_IMPORTERS["yahoo.ru"]='YahooImporter';
$_DOMAIN_IMPORTERS["yahoo.tw"]='YahooImporter';
$_DOMAIN_IMPORTERS["yahoo.cn"]='YahooImporter';
$_DOMAIN_IMPORTERS["yahoo.co.in"]='YahooImporter';
$_DOMAIN_IMPORTERS["yahoo.co.uk"]='YahooImporter';
#$_DOMAIN_IMPORTERS["yahoo.co.jp"]='YahooJpImporter';
$_DOMAIN_IMPORTERS["yahoo.co.kr"]='YahooImporter';
$_DOMAIN_IMPORTERS["yahoo.co.ru"]='YahooImporter';
$_DOMAIN_IMPORTERS["yahoo.co.tw"]='YahooImporter';
$_DOMAIN_IMPORTERS["yahoo.co.th"]='YahooImporter';
$_DOMAIN_IMPORTERS["yahoo.co.nz"]='YahooImporter';
$_DOMAIN_IMPORTERS["yahoo.co.id"]='YahooImporter';
$_DOMAIN_IMPORTERS["sbcglobal.net"]='YahooImporter';

//Experimental. Support for various Yahoo domains
$_DOMAIN_IMPORTERS["ameritech.net"]='YahooImporter';
$_DOMAIN_IMPORTERS["att.net"]='YahooImporter';
$_DOMAIN_IMPORTERS["bellsouth.net"]='YahooImporter';
$_DOMAIN_IMPORTERS["flash.net"]='YahooImporter';
$_DOMAIN_IMPORTERS["nvbell.net"]='YahooImporter';
$_DOMAIN_IMPORTERS["pacbell.net"]='YahooImporter';
$_DOMAIN_IMPORTERS["portal.att.net"]='YahooImporter';
$_DOMAIN_IMPORTERS["prodigy.net"]='YahooImporter';
$_DOMAIN_IMPORTERS["snet.net"]='YahooImporter';
$_DOMAIN_IMPORTERS["swbell.net"]='YahooImporter';
$_DOMAIN_IMPORTERS["wans.net"]='YahooImporter';
$_DOMAIN_IMPORTERS["worldnet.att.net"]='YahooImporter';
$_DOMAIN_IMPORTERS["southwestbell.net"]='YahooImporter';
$_DOMAIN_IMPORTERS["btinternet.com"]='YahooImporter';
$_DOMAIN_IMPORTERS["btopenworld.com"]='YahooImporter';
