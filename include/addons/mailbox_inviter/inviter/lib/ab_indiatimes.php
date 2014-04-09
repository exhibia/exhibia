<?php

if (!defined('__ABI')) die('Please include abi.php to use this importer!');

global $_OZ_SERVICES;
$_OZ_SERVICES['indiatimes'] = array('type'=>'abi', 'label'=>'Indiatimes', 'class'=>'IndiatimesImporter');

define('IndiatimesImporter_ACTION_REGEX',"/action=\"(http:\/\/integra.indiatimes.com\/Times\/Logon.aspx[^\"]*)\"/ims");
define('IndiatimesImporter_LOGINID_REGEX',"/<input[^>]*?name=\"?login\"?\\s+value=\"([^\"]*)\"/ims");
define('IndiatimesImporter_HOMEURL_REGEX',"/ru=(http:\/\/[^&]*)/ims");

class IndiatimesImporter extends WebRequestor {

	//@api
	function getInfo () {
		return array('id'=>'indiatimes');
	}

	//@api
	function fetchContacts ($loginemail, $password) {

		$this->setOwnerEmail($loginemail);
		oz_set_domain(oz_get_email_domain($loginemail));

		////Required. Some bug with indiatimes handling http 1.0 requests
		//$this->useHttp1_1 = true;

		$html = $this->httpGet('http://www.indiatimes.com/');
		$form = oz_extract_form_by_name($html,'loginfrm');
		if ($form==null) {
			// Indiatimes now seems to come out with interstitials
			$html = $this->httpGet("/default1.cms");
			$form = oz_extract_form_by_name($html,'loginfrm');
			if ($form==null) {
				$this->close();
				return _inviter_set_error(_INVITER_FAILED,'Cannot find login form');
			}
		}
		$parts = $this->getEmailParts($loginemail);
		$form->addField("login", $parts[0]);
		$form->addField("passwd", $password);
		$form->addField("_authtrkcde", "{#TRKCDE#}");
		$html = $this->postForm($form);
		if (strpos($html, 'Invalid User Name or Password')!=false || strpos($html, 'class="err"')!=false) {
			$this->close();
			return _inviter_set_error(_INVITER_AUTHENTICATION_FAILED,'Bad user name or password');
		}

		// If we're in an interstitial page, then try to get the url of the inbox
		if (preg_match(IndiatimesImporter_HOMEURL_REGEX,$this->lastUrl,$matches)!=0) {
			$url = urldecode($matches[1]);
			$html = $this->httpGet($url);
		}

		if (strpos($this->lastUrl, 'indiatimes.com/cgi-bin/gateway')!=false) {
			//Indiatimes classic
			// Next, export address book
			if (preg_match(IndiatimesImporter_LOGINID_REGEX,$html,$matches)==0) {
				$this->close();
				return _inviter_set_error(_INVITER_FAILED,'Cannot find logon id');
			}
			$logonId = $matches[1];

			$location = $this->makeAbsolute($this->lastUrl,"/cgi-bin/infinitemail.cgi/addressbook.csv");
			$location .= "?login=".urlencode($logonId);
			$location .= "&command=addimpexp";
			$location .= "&button=Export+to+CSV+Format";
			$html = $this->httpGet($location);
			$res = _inviter_extract_outlook_csv($html);
			$this->close();
			return $res;

		}
		else {
			//Indiatimes beta
			$html = $this->httpGet("/service/home/~/Contacts?auth=co&fmt=csv");
			$al = array();

			$reader = new OzCsvReader($html,',');
			//Read header
			$cells = $reader->nextRow();
			while (true) {
				$cells = $reader->nextRow();
				if ($cells==false) break;
				$email = '';
				$fname = '';
				$mname = '';
				$lname = '';
				$n = count($cells);
				if ($n>=1) $email=trim($cells[0]);
				if ($n>=3) $fname=$cells[2];
				if ($n>=4) $lname=$cells[3];
				if ($n>=5) $mname=$cells[4];

				if (_inviter_valid_email($email)) {
					$name = $fname.' '.$mname.' '.$lname;
					$name = oz_reduce_whitespace($name);
					$name = trim($name);
					$contact = new Contact($name,$email);
					$al[] = $contact;
				}
			}
			return $al;

		}
	}
}

// Indiatimes
global $_DOMAIN_IMPORTERS;
$_DOMAIN_IMPORTERS["indiatimes.com"]='IndiatimesImporter';
