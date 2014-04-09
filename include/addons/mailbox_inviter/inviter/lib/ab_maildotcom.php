<?php

if (!defined('__ABI')) die('Please include abi.php to use this importer!');

global $_OZ_SERVICES;
$_OZ_SERVICES['maildotcom'] = array('type'=>'abi', 'label'=>'Mail.com', 'class'=>'MailDotComImporter');


class MailDotComImporter extends WebRequestor {

	var $aol;

	//@api
	function getInfo () {
		return array('id'=>'mail.com');
	}
	
	//@api
	function login ($loginemail, $password) {

		$this->setOwnerEmail($loginemail);
		oz_set_domain(oz_get_email_domain($loginemail));

		$this->aol = NULL;
		
		//New mail.com account (migrated) now uses AOL interface.
		$form = new HttpForm;
		$form->action = "http://www.mail.com/auth/query/MigrationStatusInterface.aspx";
		$form->addField("email", $loginemail);
		$form->addField("password", $password);	//not needed
		$html = $this->postForm($form);
		//New: <result>0</result>
		//Old: <result>2</result>
		if (strpos($html,'<result>0</result>')!==FALSE) {
			$this->aol = new AolImporter;
			return $this->aol->login($loginemail,$password);
		}
				

		$form = new HttpForm;
		$form->addField("login", $loginemail);
		$form->addField("password", $password);
		$form->addField("redirlogin", "1");
		$form->addField("siteselected", "normal");
//		$form->addField("siteselected", "betaus");
		$form->addField("_authtrkcde", "{#TRKCDE#}");
		$postData = $form->buildPostData();
		$html = $this->httpPost("http://www2.mail.com/scripts/common/proxy.main?signin=1&lang=us", $postData);
		if (strpos($html, 'err=err_invalid_login')!==false ||
			strpos($this->lastUrl, 'err_invalid_login')!==false) {
			$this->close();
			return _inviter_set_error(_INVITER_AUTHENTICATION_FAILED,'Bad user name or password');
		}

		// If user is a premium ads-free member, then it may get an additional
		// notice
		if (strpos($html,"<!-- beta_advreminder.htm -->")!==FALSE) {
			$url = oz_get_refresh_url($html);
			if ($url!=null) $html=$this->httpGet($url);
		}
		
		return _inviter_set_success();
	}
	
	function _fetchCsv() {

		$form = new HttpForm;
		$form->addField("showexport", "showexport");
		$form->addField("action", "export");
		$form->addField("format", "csv");
		$form->addField("submit", "Export");
		$postData = $form->buildPostData();
		$html = $this->httpPost("/scripts/addr/external.cgi?gab=1", $postData);
		
		//No contacts
		if (strpos($html,"export failed because there is no records in database")!==FALSE)
			return array();

		return $html;
	}


	//@api
	function fetchContacts ($loginemail, $password) {
		if ($loginemail!==NULL || $password!==NULL) {
			$res = $this->login($loginemail,$password);
			if ($res!=_INVITER_SUCCESS) return $res;
		}

		if ($this->aol!==NULL) {
			return $this->aol->fetchContacts(NULL,NULL);
		}
		
		$html = $this->_fetchCsv();
		$res = _inviter_extract_outlook_csv($html);
		return $res;
	}

}


// Mail.com
global $_DOMAIN_IMPORTERS;
$_DOMAIN_IMPORTERS["mail.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["email.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["iname.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["cheerful.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["consultant.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["europe.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["mindless.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["earthling.net"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["myself.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["post.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["techie.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["usa.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["writeme.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["alumni.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["alumnidirector.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["graduate.org"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["berlin.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["dallasmail.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["delhimail.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["dublin.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["london.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["madrid.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["moscowmail.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["munich.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["nycmail.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["paris.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["rome.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["sanfranmail.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["singapore.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["tokyo.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["torontomail.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["australiamail.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["brazilmail.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["chinamail.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["germanymail.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["indiamail.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["irelandmail.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["israelmail.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["italymail.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["japan.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["koreamail.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["mexicomail.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["polandmail.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["russiamail.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["scotlandmail.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["spainmail.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["swedenmail.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["angelic.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["atheist.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["minister.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["muslim.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["oath.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["orthodox.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["priest.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["protestant.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["reborn.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["religious.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["saintly.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["artlover.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["bikerider.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["birdlover.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["catlover.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["collector.org"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["comic.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["cutey.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["disciples.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["doglover.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["elvisfan.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["fan.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["fan.net"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["gardener.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["hockeymail.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["madonnafan.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["musician.org"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["petlover.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["reggaefan.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["rocketship.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["rockfan.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["thegame.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["cyberdude.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["cybergal.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["cyber-wizard.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["webname.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["who.net"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["accountant.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["adexec.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["allergist.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["archaeologist.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["bartender.net"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["brew-master.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["chef.net"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["chemist.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["clerk.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["columnist.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["contractor.net"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["counsellor.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["count.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["deliveryman.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["diplomats.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["doctor.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["dr.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["engineer.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["execs.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["financier.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["fireman.net"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["footballer.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["geologist.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["graphic-designer.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["hairdresser.net"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["instructor.net"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["insurer.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["journalist.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["lawyer.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["legislator.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["lobbyist.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["mad.scientist.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["monarchy.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["optician.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["orthodontist.net"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["pediatrician.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["photographer.net"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["physicist.net"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["politician.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["popstar.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["presidency.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["programmer.net"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["publicist.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["radiologist.net"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["realtyagent.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["registerednurses.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["repairman.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["representative.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["rescueteam.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["salesperson.net"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["scientist.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["secretary.net"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["socialworker.net"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["sociologist.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["songwriter.net"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["teachers.org"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["technologist.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["therapist.net"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["tvstar.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["umpire.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["worker.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["africamail.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["americamail.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["arcticmail.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["asia.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["asia-mail.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["californiamail.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["dutchmail.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["englandmail.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["europemail.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["pacific-ocean.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["pacificwest.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["safrica.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["samerica.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["swissmail.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["amorous.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["caress.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["couple.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["feelings.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["yours.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["mail.org"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["cliffhanger.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["disposable.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["doubt.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["homosexual.net"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["hour.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["instruction.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["mobsters.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["nastything.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["nightly.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["nonpartisan.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["null.net"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["revenue.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["royal.net"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["sister.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["snakebite.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["soon.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["surgical.net"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["theplate.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["toke.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["toothfairy.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["wallet.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["winning.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["inorbit.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["humanoid.net"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["weirdness.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["2die4.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["activist.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["aroma.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["been-there.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["bigger.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["comfortable.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["hilarious.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["hot-shot.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["howling.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["innocent.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["loveable.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["playful.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["poetic.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["seductive.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["sizzling.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["tempting.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["tough.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["whoever.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["witty.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["alabama.usa.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["alaska.usa.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["arizona.usa.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["arkansas.usa.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["california.usa.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["colorado.usa.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["connecticut.usa.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["delaware.usa.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["florida.usa.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["georgia.usa.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["hawaii.usa.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["idaho.usa.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["illinois.usa.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["indiana.usa.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["iowa.usa.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["kansas.usa.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["kentucky.usa.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["louisiana.usa.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["maine.usa.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["maryland.usa.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["massachusetts.usa.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["michigan.usa.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["minnesota.usa.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["mississippi.usa.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["missouri.usa.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["montana.usa.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["nebraska.usa.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["nevada.usa.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["newhampshire.usa.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["newjersey.usa.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["newmexico.usa.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["newyork.usa.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["northcarolina.usa.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["northdakota.usa.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["ohio.usa.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["oklahoma.usa.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["oregon.usa.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["pennsylvania.usa.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["rhodeisland.usa.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["southcarolina.usa.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["southdakota.usa.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["tennessee.usa.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["texas.usa.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["utah.usa.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["vermont.usa.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["virginia.usa.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["washington.usa.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["westvirginia.usa.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["wisconsin.usa.com"] = 'MailDotComImporter';
$_DOMAIN_IMPORTERS["wyoming.usa.com"] = 'MailDotComImporter';
