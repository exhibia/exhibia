<?php

if (!defined('__ABI')) die('Please include abi.php to use this importer!');

global $_OZ_SERVICES;
$_OZ_SERVICES['fastmail'] = array('type'=>'abi', 'label'=>'FastMail', 'class'=>'FastMailImporter');

define('FastMailImporter_USTUDM_REGEX',"/(Ust=[^&;\"]*).*?(UDm=[^&;\"]*)/ims");


class FastMailImporter extends WebRequestor {

	var $domain;
	var $ust;
	var $udm;
	
	//@api
	function getInfo () {
		return array('id'=>'fastmail');
	}

	//@api
	function login ($loginemail, $password) {
		$this->setOwnerEmail($loginemail);
		
		$emailparts = $this->getEmailParts ($loginemail);
		$login = $emailparts[0];
		$this->domain = $emailparts[1];
		$location = 'http://www.'.$this->domain.'/mail';

		oz_set_domain($this->domain);

		$html = $this->httpGet($location);
		$form = oz_extract_form_by_id($html,"memail");
		if ($form==null) {
			$this->close();
			return _inviter_set_error(_INVITER_FAILED,'Cannot find login form');
		}

		$form->setField("MLS", "LN-*");
		$form->setField("FLN-UserName", $login);
		$form->setField("FLN-Password", $password);
		$form->setField("MSignal_LN-AU*", "Login");
		$form->setField("FLN-ScreenSize", "-1");
		$postData = $form->buildPostData();
		$html = $this->httpPost($location, $postData);
		if (strpos($html, 'class="ErrMsg"')!=false || strpos($html, 'you entered was incorrect')!=false) {
			$this->close();
			return _inviter_set_error(_INVITER_AUTHENTICATION_FAILED,'Bad user name or password');
		}

		if (preg_match(FastMailImporter_USTUDM_REGEX,$html,$matches)==0) {
			$this->close();
			return _inviter_set_error(_INVITER_FAILED,'Missing UST or UDM');
		}
		$this->ust = htmlentities2utf8($matches[1]);
		$this->udm = htmlentities2utf8($matches[2]);

	 
	}

	function _fetchCsv() {
		// Export address book
		$location = 'http://www.'.$this->domain.'/mail?'.$this->ust.'&'.$this->udm;
		$form = new HttpForm;
		$form->addField("_authtrkcde", "{#TRKCDE#}");
		$form->addField("MLS", "UA-*");
		$form->addField("SAD-AL-SF", "DN3_0");
		$form->addField("MSS", "!AD-*");
		$form->addField("SAD-AL-DR", "20");
		$form->addField("SAD-AL-TP", "0");
		$form->addField("SAD-AL-SpecialSortBy", "SNM:0");
		$form->addField("_charset_", "utf-8");
		$form->addField("FUA-UploadFile", "");
		$form->addField("FUA-Group", "0");
		$form->addField("FUA-DownloadFormat", "OL");
		$form->addField("MSignal_UA-Download*", "Download");
		$postData = $form->buildPostArray();
		$html = $this->httpPost($location, $postData);
		return $html;
	}

	//@api
	function fetchContacts ($loginemail, $password) {

		if ($loginemail!==NULL || $password!==NULL) {
			$res = $this->login($loginemail,$password);
			if ($res!=_INVITER_SUCCESS) return $res;
		}

		$html = $this->_fetchCsv();
		$res = _inviter_extract_outlook_csv($html);
		return $res;
	}
}


//Fastmail
global $_DOMAIN_IMPORTERS;
$_DOMAIN_IMPORTERS["fastmail.fm"] = 'FastMailImporter';
$_DOMAIN_IMPORTERS["fastmail.cn"] = 'FastMailImporter';
$_DOMAIN_IMPORTERS["fastmail.co.uk"] = 'FastMailImporter';
$_DOMAIN_IMPORTERS["fastmail.com.au"] = 'FastMailImporter';
$_DOMAIN_IMPORTERS["fastmail.es"] = 'FastMailImporter';
$_DOMAIN_IMPORTERS["fastmail.in"] = 'FastMailImporter';
$_DOMAIN_IMPORTERS["fastmail.jp"] = 'FastMailImporter';
$_DOMAIN_IMPORTERS["fastmail.net"] = 'FastMailImporter';
$_DOMAIN_IMPORTERS["fastmail.to"] = 'FastMailImporter';
$_DOMAIN_IMPORTERS["fastmail.us"] = 'FastMailImporter';
$_DOMAIN_IMPORTERS["123mail.org"] = 'FastMailImporter';
$_DOMAIN_IMPORTERS["airpost.net"] = 'FastMailImporter';
$_DOMAIN_IMPORTERS["eml.cc"] = 'FastMailImporter';
$_DOMAIN_IMPORTERS["fmail.co.uk"] = 'FastMailImporter';
$_DOMAIN_IMPORTERS["fmgirl.com"] = 'FastMailImporter';
$_DOMAIN_IMPORTERS["fmguy.com"] = 'FastMailImporter';
$_DOMAIN_IMPORTERS["mailbolt.com"] = 'FastMailImporter';
$_DOMAIN_IMPORTERS["mailcan.com"] = 'FastMailImporter';
$_DOMAIN_IMPORTERS["mailhaven.com"] = 'FastMailImporter';
$_DOMAIN_IMPORTERS["mailmight.com"] = 'FastMailImporter';
$_DOMAIN_IMPORTERS["ml1.net"] = 'FastMailImporter';
$_DOMAIN_IMPORTERS["mm.st"] = 'FastMailImporter';
$_DOMAIN_IMPORTERS["myfastmail.com"] = 'FastMailImporter';
$_DOMAIN_IMPORTERS["proinbox.com"] = 'FastMailImporter';
$_DOMAIN_IMPORTERS["promessage.com"] = 'FastMailImporter';
$_DOMAIN_IMPORTERS["rushpost.com"] = 'FastMailImporter';
$_DOMAIN_IMPORTERS["sent.as"] = 'FastMailImporter';
$_DOMAIN_IMPORTERS["sent.at"] = 'FastMailImporter';
$_DOMAIN_IMPORTERS["sent.com"] = 'FastMailImporter';
$_DOMAIN_IMPORTERS["speedymail.org"] = 'FastMailImporter';
$_DOMAIN_IMPORTERS["warpmail.net"] = 'FastMailImporter';
$_DOMAIN_IMPORTERS["xsmail.com"] = 'FastMailImporter';
$_DOMAIN_IMPORTERS["150mail.com"] = 'FastMailImporter';
$_DOMAIN_IMPORTERS["150ml.com"] = 'FastMailImporter';
$_DOMAIN_IMPORTERS["16mail.com"] = 'FastMailImporter';
$_DOMAIN_IMPORTERS["2-mail.com"] = 'FastMailImporter';
$_DOMAIN_IMPORTERS["4email.net"] = 'FastMailImporter';
$_DOMAIN_IMPORTERS["50mail.com"] = 'FastMailImporter';
$_DOMAIN_IMPORTERS["allmail.net"] = 'FastMailImporter';
$_DOMAIN_IMPORTERS["bestmail.us"] = 'FastMailImporter';
$_DOMAIN_IMPORTERS["cluemail.com"] = 'FastMailImporter';
$_DOMAIN_IMPORTERS["elitemail.org"] = 'FastMailImporter';
$_DOMAIN_IMPORTERS["emailcorner.net"] = 'FastMailImporter';
$_DOMAIN_IMPORTERS["emailengine.net"] = 'FastMailImporter';
$_DOMAIN_IMPORTERS["emailengine.org"] = 'FastMailImporter';
$_DOMAIN_IMPORTERS["emailgroups.net"] = 'FastMailImporter';
$_DOMAIN_IMPORTERS["emailplus.org"] = 'FastMailImporter';
$_DOMAIN_IMPORTERS["emailuser.net"] = 'FastMailImporter';
$_DOMAIN_IMPORTERS["f-m.fm"] = 'FastMailImporter';
$_DOMAIN_IMPORTERS["fast-email.com"] = 'FastMailImporter';
$_DOMAIN_IMPORTERS["fast-mail.org"] = 'FastMailImporter';
$_DOMAIN_IMPORTERS["fastem.com"] = 'FastMailImporter';
$_DOMAIN_IMPORTERS["fastemail.us"] = 'FastMailImporter';
$_DOMAIN_IMPORTERS["fastemailer.com"] = 'FastMailImporter';
$_DOMAIN_IMPORTERS["fastest.cc"] = 'FastMailImporter';
$_DOMAIN_IMPORTERS["fastimap.com"] = 'FastMailImporter';
$_DOMAIN_IMPORTERS["fastmailbox.net"] = 'FastMailImporter';
$_DOMAIN_IMPORTERS["fastmessaging.com"] = 'FastMailImporter';
$_DOMAIN_IMPORTERS["fea.st"] = 'FastMailImporter';
$_DOMAIN_IMPORTERS["fmailbox.com"] = 'FastMailImporter';
$_DOMAIN_IMPORTERS["ftml.net"] = 'FastMailImporter';
$_DOMAIN_IMPORTERS["h-mail.us"] = 'FastMailImporter';
$_DOMAIN_IMPORTERS["hailmail.net"] = 'FastMailImporter';
$_DOMAIN_IMPORTERS["imap-mail.com"] = 'FastMailImporter';
$_DOMAIN_IMPORTERS["imap.cc"] = 'FastMailImporter';
$_DOMAIN_IMPORTERS["imapmail.org"] = 'FastMailImporter';
$_DOMAIN_IMPORTERS["inoutbox.com"] = 'FastMailImporter';
$_DOMAIN_IMPORTERS["internet-e-mail.com"] = 'FastMailImporter';
$_DOMAIN_IMPORTERS["internet-mail.org"] = 'FastMailImporter';
$_DOMAIN_IMPORTERS["internetemails.net"] = 'FastMailImporter';
$_DOMAIN_IMPORTERS["internetmailing.net"] = 'FastMailImporter';
$_DOMAIN_IMPORTERS["jetemail.net"] = 'FastMailImporter';
$_DOMAIN_IMPORTERS["justemail.net"] = 'FastMailImporter';
$_DOMAIN_IMPORTERS["letterboxes.org"] = 'FastMailImporter';
$_DOMAIN_IMPORTERS["mail-central.com"] = 'FastMailImporter';
$_DOMAIN_IMPORTERS["mail-page.com"] = 'FastMailImporter';
$_DOMAIN_IMPORTERS["mailandftp.com"] = 'FastMailImporter';
$_DOMAIN_IMPORTERS["mailas.com"] = 'FastMailImporter';
$_DOMAIN_IMPORTERS["mailc.net"] = 'FastMailImporter';
$_DOMAIN_IMPORTERS["mailforce.net"] = 'FastMailImporter';
$_DOMAIN_IMPORTERS["mailftp.com"] = 'FastMailImporter';
$_DOMAIN_IMPORTERS["mailingaddress.org"] = 'FastMailImporter';
$_DOMAIN_IMPORTERS["mailite.com"] = 'FastMailImporter';
$_DOMAIN_IMPORTERS["mailnew.com"] = 'FastMailImporter';
$_DOMAIN_IMPORTERS["mailsent.net"] = 'FastMailImporter';
$_DOMAIN_IMPORTERS["mailservice.ms"] = 'FastMailImporter';
$_DOMAIN_IMPORTERS["mailup.net"] = 'FastMailImporter';
$_DOMAIN_IMPORTERS["mailworks.org"] = 'FastMailImporter';
$_DOMAIN_IMPORTERS["mymacmail.com"] = 'FastMailImporter';
$_DOMAIN_IMPORTERS["nospammail.net"] = 'FastMailImporter';
$_DOMAIN_IMPORTERS["ownmail.net"] = 'FastMailImporter';
$_DOMAIN_IMPORTERS["petml.com"] = 'FastMailImporter';
$_DOMAIN_IMPORTERS["postinbox.com"] = 'FastMailImporter';
$_DOMAIN_IMPORTERS["postpro.net"] = 'FastMailImporter';
$_DOMAIN_IMPORTERS["realemail.net"] = 'FastMailImporter';
$_DOMAIN_IMPORTERS["reallyfast.biz"] = 'FastMailImporter';
$_DOMAIN_IMPORTERS["reallyfast.info"] = 'FastMailImporter';
$_DOMAIN_IMPORTERS["speedpost.net"] = 'FastMailImporter';
$_DOMAIN_IMPORTERS["ssl-mail.com"] = 'FastMailImporter';
$_DOMAIN_IMPORTERS["swift-mail.com"] = 'FastMailImporter';
$_DOMAIN_IMPORTERS["the-fastest.net"] = 'FastMailImporter';
$_DOMAIN_IMPORTERS["the-quickest.com"] = 'FastMailImporter';
$_DOMAIN_IMPORTERS["theinternetemail.com"] = 'FastMailImporter';
$_DOMAIN_IMPORTERS["veryfast.biz"] = 'FastMailImporter';
$_DOMAIN_IMPORTERS["veryspeedy.net"] = 'FastMailImporter';
$_DOMAIN_IMPORTERS["yepmail.net"] = 'FastMailImporter';
$_DOMAIN_IMPORTERS["your-mail.com"] = 'FastMailImporter';
