<?php

if (!defined('__ABI')) die('Please include abi.php to use this importer!');

global $_OZ_SERVICES;
$_OZ_SERVICES['aol'] = array('type'=>'abi', 'label'=>'AOL', 'class'=>'AolImporter');
$_OZ_SERVICES['icq'] = array('type'=>'abi', 'label'=>'IcqMail', 'class'=>'AolImporter');

define('AolImporter_LOGINFORM_REGEX',"/<form\s+name=\"[^\"]*oginForm\"[^>]*?action=\"([^\"]*?)\"[^>]*>(.*?)<\/form/ims");
define('AolImporter_CONTACT_REGEX',"/<span class=\"fullName\">(.*?)<\/span>(.*?)<hr class=\"contactSeparator\">/ims");
define('AolImporter_EMAILS_REGEX',"/<span>[\\d\\w ]*Email[\\d\\w ]*:<\/span>\\s*<span>(.*?)<\/span>/ims");
define('AolImporter_SCREENNAME_REGEX',"/<span>Screen Name:<\/span>\\s*<span>(.*?)<\/span>/ims");
define('AolImporter_patternAOLSitedomain',"/sitedomain.*?\"(.*?)\";/ims");
define('AolImporter_patternAOLSiteState',"/siteState.*?\"(.*?)\";/ims");
define('AolImporter_patternAOLSeamless',"/seamless.*?\"(.*?)\";/ims");
define('AolImporter_patternAOLInput',"/<input.*?>/ims");
define('AolImporter_patternHidden',"/type=\"hidden\"/ims");
define('AolImporter_patternAOLName',"/name=\"(.*?)\"/ims");
define('AolImporter_patternAOLValue',"/value=\"(.*?)\"/ims");
define('AolImporter_patternAOLLoginForm',"/<form.*?name=\"loginForm\".*?>[\\s\\S]*<\\/form>/ims");
define('AolImporter_patternAOLAction',"/<form.*?action=\"(.*?)\".*?>/ims");
define('AolImporter_patternAOLVerify',"/<body onLoad=\"checkErrorAndSubmitForm.*?'(http.*?)'.*>/ims");
define('AolImporter_patternAOLHost',"/Host.*?\"(.*?)\";/ims");
define('AolImporter_patternAOLUserID',"/&uid:(.*?)&/ims");
define('AolImporter_patternAOLPath',"/gSuccessPath.*?\"(.*?)\";/ims");
define('AolImporter_INVALIDLOGIN_REGEX',"/invalid screen name or password/ims");
define('AolImporter_HOST_REGEX',"/var gPreferredHost = \"?([^\";]*).*?var gTargetHost = \"?([^\";]*).*?var gSuccessPath = \"?([^\";]*)/ims");
define('AolImporter_CONTACTTO_REGEX',"/(?:<span class=\"contactSelectName\">([^<]*)<\/span>\\s*)?<span class=\"contactSelectEmail\">([^<]*)<\/span>/ims");


class AolImporter extends WebRequestor {

	var $domain;
	var $homeuri;


	//@api
	function getInfo () {
		return array('id'=>'aol');
	}

	//@api
	function login ($loginemail, $password) {
	 
		//Remove ".aol" suffix
		$loginemail = preg_replace("/^(.*?)(\.aol)$/ims", '${1}', $loginemail);
		$this->setOwnerEmail($loginemail);

		$parts = $this->getEmailParts($loginemail);
		$login = $loginemail;
		$dom = strtolower($parts[1]);
		$this->domain = $dom;
		
		oz_set_domain($dom);
		
		$loginurl = 'http://webmail.aol.com';
		if ($dom=="aol.in") {
			$loginurl = 'http://webmail.aol.in';
		}
		if ($dom=="aol.de") {
			$loginurl = 'http://webmail.aol.de';
			$login = $parts[0];
		}
//	 	else if ($dom=="icqmail.com") {
//			$loginurl = 'http://webmail.aol.com';
//		}
		else if ($dom=="aim.com" || $dom=="aol.com" || $dom=="aol.co.uk") {
			//Login using ID onli
			$login = $parts[0];
		}
		//else if ($dom=="aol.it" || $dom=="aol.es") {
		//}
		else {
			//Login is using email address
		}
		$html = $this->httpGet($loginurl);

		$form = oz_extract_form_by_name($html, 'AOLLoginForm');
		if ($form==null) {
			$this->close();
			return _inviter_set_error(_INVITER_FAILED,'Missing login form');
		}
		$form->setField('loginId',$login);
		$form->setField('password',$password);
		$form->addField("_authtrkcde", "{#TRKCDE#}");
		$postData = $form->buildPostData();
		$html = $this->httpPost($form->action, $postData);


		if (strpos($html,"Account Security Question")!==FALSE) {
			$this->close();
			return _inviter_set_error(_INVITER_USER_INPUT_REQUIRED,'AOL requires you to answer some security questions');
		}

		if (strpos($html,"regImgWord")!==FALSE) {
			$this->close();
			_inviter_set_captcha(NULL);
			return _inviter_set_error(_INVITER_CAPTCHA_RAISED,'Captcha challenge raised');
		}

		if (strpos($html,"class=\"errortext\"")!==FALSE) {
			$this->close();
			return _inviter_set_error(_INVITER_AUTHENTICATION_FAILED,'Bad user name or password');
		}

//		if (preg_match(AolImporter_INVALIDLOGIN_REGEX,$html) || strpos($html,'snsmPRDetailErr')!==FALSE) {
//		 	$this->close();
//			return _inviter_set_error(_INVITER_AUTHENTICATION_FAILED,'Bad user name or password');
//		}


		if (preg_match(AolImporter_patternAOLVerify,$html,$matches)!=0) {
			$location = $matches[1];
			$html = $this->httpGet($location);

			//Not sure if security question is asked here, but just in case...
			if (strpos($html,"Account Security Question")>0) {
				$this->close();
				return _inviter_set_error(_INVITER_USER_INPUT_REQUIRED,'AOL requires you to answer some security questions');
			}
		}

		//New AOL adds 2nd level redirection
		if (preg_match(AolImporter_patternAOLVerify,$html,$matches)!=0) {
			$location = $matches[1];
			$html = $this->httpGet($location);

			//Not sure if security question is asked here, but just in case...
			if (strpos($html,"Account Security Question")>0) {
				$this->close();
				return _inviter_set_error(_INVITER_USER_INPUT_REQUIRED,'AOL requires you to answer some security questions');
			}
		}

		/////////////////////////////////////////////////////
		//GET HOST FOR THE WEBMAIL
		/////////////////////////////////////////////////////
		if (preg_match(AolImporter_HOST_REGEX,$html,$matches)!=0) {
			$preferredhost = $matches[1];
			$targethost = $matches[2];
			$successpath = $matches[3];
			if ($targethost!="null") {
				$preferredhost = $targethost;
			}
			$this->homeuri = "http://".$preferredhost.$successpath;
		}
		else
		{
			//aim.com accounts seems to go through double redirection!
			$this->homeuri = $this->lastUrl;
		}

	

		return _inviter_set_success();
	}

	//@api
	function fetchContacts ($loginemail, $password) {

/*
		if (class_exists('AolImporterX')) {
			$imp = new AolImporterX;
			$res = $imp->fetchContacts($loginemail, $password);
			if (is_array($res)) return $res;
			//Fallthrough
		}
*/

		if ($loginemail!==NULL || $password!==NULL) {
			$res = $this->login($loginemail,$password);
			if ($res!=_INVITER_SUCCESS) return $res;
		}

		$location = $this->makeAbsolute($this->homeuri, "Lite/PeoplePicker.aspx?type=compose");
		$html = $this->httpGet($location);

//$html .= '';
//echo $html;

		$al = array();
		preg_match_all(AolImporter_CONTACTTO_REGEX, $html, $matches, PREG_SET_ORDER);
		foreach ($matches as $val) {
			$email = htmlentities2utf8($val[2]);
			$name = htmlentities2utf8($val[1]);
			if (!empty($email)) {
				if (strpos($email,'@')===false) $email.='@'.$this->domain;
				if (_inviter_valid_email($email)) $al[] = new Contact($name,$email);
			}
		}


		$this->close();
		return $al;
	}


}


// AOL
global $_DOMAIN_IMPORTERS;

$_DOMAIN_IMPORTERS['aol']='AolImporter';
$_DOMAIN_IMPORTERS['aol.com']='AolImporter';
$_DOMAIN_IMPORTERS['aim.com']='AolImporter';
$_DOMAIN_IMPORTERS['netscape.net']='AolImporter';
$_DOMAIN_IMPORTERS['aol.in']='AolImporter';
$_DOMAIN_IMPORTERS['aol.co.uk']='AolImporter';
$_DOMAIN_IMPORTERS['aol.com.br']='AolImporter';
$_DOMAIN_IMPORTERS['aol.de']='AolImporter';
$_DOMAIN_IMPORTERS['aol.fr']='AolImporter';
$_DOMAIN_IMPORTERS['aol.nl']='AolImporter';
$_DOMAIN_IMPORTERS['aol.se']='AolImporter';
$_DOMAIN_IMPORTERS['aol.es']='AolImporter';
$_DOMAIN_IMPORTERS['aol.it']='AolImporter';

$_DOMAIN_IMPORTERS['bestcoolcars.com']='AolImporter';
$_DOMAIN_IMPORTERS['car-nut.net']='AolImporter';
$_DOMAIN_IMPORTERS['crazycarfan.com']='AolImporter';
$_DOMAIN_IMPORTERS['in2autos.net']='AolImporter';
$_DOMAIN_IMPORTERS['intomotors.com']='AolImporter';
$_DOMAIN_IMPORTERS['motor-nut.com']='AolImporter';
$_DOMAIN_IMPORTERS['asylum.com']='AolImporter';
$_DOMAIN_IMPORTERS['blackvoices.com']='AolImporter';
$_DOMAIN_IMPORTERS['focusedonprofits.com']='AolImporter';
$_DOMAIN_IMPORTERS['focusedonreturns.com']='AolImporter';
$_DOMAIN_IMPORTERS['ilike2invest.com']='AolImporter';
$_DOMAIN_IMPORTERS['interestedinthejob.com']='AolImporter';
$_DOMAIN_IMPORTERS['netbusiness.com']='AolImporter';
$_DOMAIN_IMPORTERS['right4thejob.com']='AolImporter';
$_DOMAIN_IMPORTERS['alwayswatchingmovies.com']='AolImporter';
$_DOMAIN_IMPORTERS['alwayswatchingtv.com']='AolImporter';
$_DOMAIN_IMPORTERS['beabookworm.com']='AolImporter';
$_DOMAIN_IMPORTERS['bigtimereader.com']='AolImporter';
$_DOMAIN_IMPORTERS['chat-with-me.com']='AolImporter';
$_DOMAIN_IMPORTERS['crazyaboutfilms.net']='AolImporter';
$_DOMAIN_IMPORTERS['crazymoviefan.com']='AolImporter';
$_DOMAIN_IMPORTERS['fanofbooks.com']='AolImporter';
$_DOMAIN_IMPORTERS['games.com']='AolImporter';
$_DOMAIN_IMPORTERS['getintobooks.com']='AolImporter';
$_DOMAIN_IMPORTERS['i-dig-movies.com']='AolImporter';
$_DOMAIN_IMPORTERS['idigvideos.com']='AolImporter';
$_DOMAIN_IMPORTERS['iwatchrealitytv.com']='AolImporter';
$_DOMAIN_IMPORTERS['moviefan.com']='AolImporter';
$_DOMAIN_IMPORTERS['news-fanatic.com']='AolImporter';
$_DOMAIN_IMPORTERS['newspaperfan.com']='AolImporter';
$_DOMAIN_IMPORTERS['onlinevideosrock.com']='AolImporter';
$_DOMAIN_IMPORTERS['realitytvaddict.net']='AolImporter';
$_DOMAIN_IMPORTERS['realitytvnut.com']='AolImporter';
$_DOMAIN_IMPORTERS['reallyintomusic.com']='AolImporter';
$_DOMAIN_IMPORTERS['thegamefanatic.com']='AolImporter';
$_DOMAIN_IMPORTERS['totallyintomusic.com']='AolImporter';
$_DOMAIN_IMPORTERS['totallyintoreading.com']='AolImporter';
$_DOMAIN_IMPORTERS['totalmoviefan.com']='AolImporter';
$_DOMAIN_IMPORTERS['tvchannelsurfer.com']='AolImporter';
$_DOMAIN_IMPORTERS['videogamesrock.com']='AolImporter';
$_DOMAIN_IMPORTERS['wild4music.com']='AolImporter';
$_DOMAIN_IMPORTERS['alwaysgrilling.com']='AolImporter';
$_DOMAIN_IMPORTERS['alwaysinthekitchen.com']='AolImporter';
$_DOMAIN_IMPORTERS['besure2vote.com']='AolImporter';
$_DOMAIN_IMPORTERS['cheatasrule.com']='AolImporter';
$_DOMAIN_IMPORTERS['crazy4homeimprovement.com']='AolImporter';
$_DOMAIN_IMPORTERS['descriptivemail.com']='AolImporter';
$_DOMAIN_IMPORTERS['differentmail.com']='AolImporter';
$_DOMAIN_IMPORTERS['easydoesit.com']='AolImporter';
$_DOMAIN_IMPORTERS['expertrenovator.com']='AolImporter';
$_DOMAIN_IMPORTERS['expressivemail.com']='AolImporter';
$_DOMAIN_IMPORTERS['fanofcooking.com']='AolImporter';
$_DOMAIN_IMPORTERS['fieldmail.com']='AolImporter';
$_DOMAIN_IMPORTERS['fleetmail.com']='AolImporter';
$_DOMAIN_IMPORTERS['funkidsemail.com']='AolImporter';
$_DOMAIN_IMPORTERS['getfanbrand.com']='AolImporter';
$_DOMAIN_IMPORTERS['i-love-restaurants.com']='AolImporter';
$_DOMAIN_IMPORTERS['ilike2helpothers.com']='AolImporter';
$_DOMAIN_IMPORTERS['ilovehomeprojects.com']='AolImporter';
$_DOMAIN_IMPORTERS['lovefantasysports.com']='AolImporter';
$_DOMAIN_IMPORTERS['luckymail.com']='AolImporter';
$_DOMAIN_IMPORTERS['mail2me.com']='AolImporter';
$_DOMAIN_IMPORTERS['mail4me.com']='AolImporter';
$_DOMAIN_IMPORTERS['majorshopaholic.com']='AolImporter';
$_DOMAIN_IMPORTERS['realbookfan.com']='AolImporter';
$_DOMAIN_IMPORTERS['scoutmail.com']='AolImporter';
$_DOMAIN_IMPORTERS['thefanbrand.com']='AolImporter';
$_DOMAIN_IMPORTERS['totally-into-cooking.com']='AolImporter';
$_DOMAIN_IMPORTERS['totallyintocooking.com']='AolImporter';
$_DOMAIN_IMPORTERS['volunteeringisawesome.com']='AolImporter';
$_DOMAIN_IMPORTERS['voluteer4fun.com']='AolImporter';
$_DOMAIN_IMPORTERS['wayintocomputers.com']='AolImporter';
$_DOMAIN_IMPORTERS['whatmail.com']='AolImporter';
$_DOMAIN_IMPORTERS['when.com']='AolImporter';
$_DOMAIN_IMPORTERS['wildaboutelectronics.com']='AolImporter';
$_DOMAIN_IMPORTERS['workingaroundthehouse.com']='AolImporter';
$_DOMAIN_IMPORTERS['workingonthehouse.com']='AolImporter';
$_DOMAIN_IMPORTERS['writesoon.com']='AolImporter';
$_DOMAIN_IMPORTERS['xmasmail.com']='AolImporter';
$_DOMAIN_IMPORTERS['beahealthnut.com']='AolImporter';
$_DOMAIN_IMPORTERS['ilike2workout.com']='AolImporter';
$_DOMAIN_IMPORTERS['ilikeworkingout.com']='AolImporter';
$_DOMAIN_IMPORTERS['iloveworkingout.com']='AolImporter';
$_DOMAIN_IMPORTERS['love2exercise.com']='AolImporter';
$_DOMAIN_IMPORTERS['love2workout.com']='AolImporter';
$_DOMAIN_IMPORTERS['lovetoexercise.com']='AolImporter';
$_DOMAIN_IMPORTERS['realhealthnut.com']='AolImporter';
$_DOMAIN_IMPORTERS['totalfoodnut.com']='AolImporter';
$_DOMAIN_IMPORTERS['acatperson.com']='AolImporter';
$_DOMAIN_IMPORTERS['adogperson.com']='AolImporter';
$_DOMAIN_IMPORTERS['bigtimecatperson.com']='AolImporter';
$_DOMAIN_IMPORTERS['bigtimedogperson.com']='AolImporter';
$_DOMAIN_IMPORTERS['cat-person.com']='AolImporter';
$_DOMAIN_IMPORTERS['catpeoplerule.com']='AolImporter';
$_DOMAIN_IMPORTERS['dog-person.com']='AolImporter';
$_DOMAIN_IMPORTERS['dogpeoplerule.com']='AolImporter';
$_DOMAIN_IMPORTERS['mycatiscool.com']='AolImporter';
$_DOMAIN_IMPORTERS['fanofcomputers.com']='AolImporter';
$_DOMAIN_IMPORTERS['fanoftheweb.com']='AolImporter';
$_DOMAIN_IMPORTERS['idigcomputers.com']='AolImporter';
$_DOMAIN_IMPORTERS['idigelectronics.com']='AolImporter';
$_DOMAIN_IMPORTERS['ilikeelectronics.com']='AolImporter';
$_DOMAIN_IMPORTERS['majortechie.com']='AolImporter';
$_DOMAIN_IMPORTERS['switched.com']='AolImporter';
$_DOMAIN_IMPORTERS['total-techie.com']='AolImporter';
$_DOMAIN_IMPORTERS['allsportsrock.com']='AolImporter';
$_DOMAIN_IMPORTERS['basketball-email.com']='AolImporter';
$_DOMAIN_IMPORTERS['beagolfer.com']='AolImporter';
$_DOMAIN_IMPORTERS['bigtimesportsfan.com']='AolImporter';
$_DOMAIN_IMPORTERS['crazy4baseball.com']='AolImporter';
$_DOMAIN_IMPORTERS['futboladdict.com']='AolImporter';
$_DOMAIN_IMPORTERS['hail2theskins.com']='AolImporter';
$_DOMAIN_IMPORTERS['hitthepuck.com']='AolImporter';
$_DOMAIN_IMPORTERS['iloveourteam.com']='AolImporter';
$_DOMAIN_IMPORTERS['luvfishing.com']='AolImporter';
$_DOMAIN_IMPORTERS['luvgolfing.com']='AolImporter';
$_DOMAIN_IMPORTERS['luvsoccer.com']='AolImporter';
$_DOMAIN_IMPORTERS['majorgolfer.com']='AolImporter';
$_DOMAIN_IMPORTERS['myfantasyteamrocks.com']='AolImporter';
$_DOMAIN_IMPORTERS['myfantasyteamrules.com']='AolImporter';
$_DOMAIN_IMPORTERS['myteamisbest.com']='AolImporter';
$_DOMAIN_IMPORTERS['redskinsfancentral.com']='AolImporter';
$_DOMAIN_IMPORTERS['redskinsultimatefan.com']='AolImporter';
$_DOMAIN_IMPORTERS['skins4life.com']='AolImporter';
$_DOMAIN_IMPORTERS['totallyintobaseball.com']='AolImporter';
$_DOMAIN_IMPORTERS['totallyintobasketball.com']='AolImporter';
$_DOMAIN_IMPORTERS['totallyintofootball.com']='AolImporter';
$_DOMAIN_IMPORTERS['totallyintogolf.com']='AolImporter';
$_DOMAIN_IMPORTERS['totallyintohockey.com']='AolImporter';
$_DOMAIN_IMPORTERS['totallyintosports.com']='AolImporter';
$_DOMAIN_IMPORTERS['ultimateredskinsfan.com']='AolImporter';
$_DOMAIN_IMPORTERS['realtravelfan.com']='AolImporter';
$_DOMAIN_IMPORTERS['totallyintotravel.com']='AolImporter';
$_DOMAIN_IMPORTERS['travel2newplaces.com']='AolImporter';
$_DOMAIN_IMPORTERS['1ramsfan.com']='AolImporter';
$_DOMAIN_IMPORTERS['all4rams.com']='AolImporter';
$_DOMAIN_IMPORTERS['all4theskins.com']='AolImporter';
$_DOMAIN_IMPORTERS['angeliamail.com']='AolImporter';
$_DOMAIN_IMPORTERS['backheel.net']='AolImporter';
$_DOMAIN_IMPORTERS['believeinliberty.com']='AolImporter';
$_DOMAIN_IMPORTERS['bestjobcandidate.com']='AolImporter';
$_DOMAIN_IMPORTERS['capsfanatic.com']='AolImporter';
$_DOMAIN_IMPORTERS['capshockeyfan.com']='AolImporter';
$_DOMAIN_IMPORTERS['capsred.com']='AolImporter';
$_DOMAIN_IMPORTERS['compuserve.com']='AolImporter';
$_DOMAIN_IMPORTERS['crazy4mail.com']='AolImporter';
$_DOMAIN_IMPORTERS['crazyforemail.com']='AolImporter';
$_DOMAIN_IMPORTERS['fanaticos.com']='AolImporter';
$_DOMAIN_IMPORTERS['glad2bglbt.com']='AolImporter';
$_DOMAIN_IMPORTERS['halocovenants.net']='AolImporter';
$_DOMAIN_IMPORTERS['lemondrop.com']='AolImporter';
$_DOMAIN_IMPORTERS['makemailperfect.com']='AolImporter';
$_DOMAIN_IMPORTERS['mcom.com']='AolImporter';
$_DOMAIN_IMPORTERS['mycapitalsmail.com']='AolImporter';
$_DOMAIN_IMPORTERS['noisecreep.com']='AolImporter';
$_DOMAIN_IMPORTERS['politicsdaily.com']='AolImporter';
$_DOMAIN_IMPORTERS['ramsbringit.com']='AolImporter';
$_DOMAIN_IMPORTERS['ramsforlife.com']='AolImporter';
$_DOMAIN_IMPORTERS['ramsmail.com']='AolImporter';
$_DOMAIN_IMPORTERS['redskinscheer.com']='AolImporter';
$_DOMAIN_IMPORTERS['redskinsfamily.com']='AolImporter';
$_DOMAIN_IMPORTERS['redskinshog.com']='AolImporter';
$_DOMAIN_IMPORTERS['redskinsrule.com']='AolImporter';
$_DOMAIN_IMPORTERS['redskinsspecialteams.com']='AolImporter';
$_DOMAIN_IMPORTERS['stargate2.com']='AolImporter';
$_DOMAIN_IMPORTERS['stargateatlantis.com']='AolImporter';
$_DOMAIN_IMPORTERS['stargatefanclub.com']='AolImporter';
$_DOMAIN_IMPORTERS['stargatesg1.com']='AolImporter';
$_DOMAIN_IMPORTERS['stargateu.com']='AolImporter';
$_DOMAIN_IMPORTERS['urlesque.com']='AolImporter';

$_DOMAIN_IMPORTERS['icqmail.com']='AolImporter';
$_DOMAIN_IMPORTERS["icqmail.de"]='AolImporter';
