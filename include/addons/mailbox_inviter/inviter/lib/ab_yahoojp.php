<?php
if (!defined('__ABI')) die('Please include abi.php to use this importer!');

global $_OZ_SERVICES;
$_OZ_SERVICES['yahoojp'] = array('type'=>'abi', 'label'=>'Yahoo Japan', 'class'=>'YahooJpImporter');


class YahooJpImporter extends WebRequestor {

	var $CRUMB_REGEX = "/<input\\s+type=\"hidden\"\\s+name=\"\\.crumb\"[^>]*?value=\"([^\"]*)\"[^>]*>/ims";

	//@api
	function getInfo () {
		return array('id'=>'yahoo.co.jp');
	}

	//@api
	function fetchContacts ($loginemail, $password) {

		//Login
		$parts = $this->getEmailParts ($loginemail);
		$login = $parts[0];
		$this->setOwnerEmail($loginemail);
		oz_set_domain($parts[1]);

		//$html = $this->httpGet("http://mail.yahoo.co.jp");
		$html = $this->httpGet("http://address.yahoo.co.jp");
		$form = oz_extract_form_by_name($html, 'login_form');
		if ($form==null) {
			$this->close();
			return _inviter_set_error(_INVITER_FAILED,'Cannot find login form');
		}
		$form->setField('login',$login);
		$form->setField('passwd',$password);
		$form->addField("_authtrkcde", "{#TRKCDE#}");
		$postData = $form->buildPostData();
		$html = $this->httpPost($form->action, $postData);
		if (strpos($html,"class=\"yregertxt\"")!==false) {
			$this->close();
			return _inviter_set_error(_INVITER_AUTHENTICATION_FAILED,'Bad user name or password');
		}

		//Fetch address book
		//$html = $this->httpGet("http://address.yahoo.co.jp/yab/jp/Yahoo.csv?loc=jp&.rand=599806486&A=Y&Yahoo.csv",'SHIFT_JIS');
		//$res = _inviter_extract_yahoo_csv($html);
		//$this->close();
		//return $res;

		$form = new HttpForm;
		$html2 = $this->httpGet("http://address.yahoo.co.jp/?1&VPC=import_export");
		if (preg_match($this->CRUMB_REGEX,$html2,$matches)) {
			$crumb = htmlentities2utf8($matches[1]);
			$form->addfield('.crumb',$crumb);
		}
		$form->addField('VPC','import_export');
		$form->addField('A','B');
		//submit[action_export_outlook]
		$form->addField('submit[action_export_ldif]','Export Now');
		$postData = $form->buildPostData();
		$html = $this->httpPost('http://address.yahoo.co.jp/index.php', $postData);
		$res = _inviter_extractContactsFromLdif($html);
		return $res;
	}
}

global $_DOMAIN_IMPORTERS;
$_DOMAIN_IMPORTERS["yahoo.co.jp"]='YahooJpImporter';
