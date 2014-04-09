<?php

require(dirname(__FILE__) . '/config.inc.php');




    include_once $BASE_DIR . '/common/sitesetting.php';

if($_REQUEST['from'] != $license_server){

    include_once $BASE_DIR . '/common/securityfilter.php';

}

if($_REQUEST['from'] != $license_server){
$PHP_SELF=$_SERVER['PHP_SELF'];

}
//varFilter();
$adminemailadd = Sitesetting::getEmailNoDb();

//$lastaucseconds=Sitesetting::getLastaucseconds();
$enableAdminBidder=  Sitesetting::isAllowAdminBidder();

$globalDateformat=  Sitesetting::getDateFormat();
//echo $adminemailadd;
//Custommetatags like google tracking etc
$defaultlanguage=Sitesetting::getLanguage();
Sitesetting::setLanguage();
 if(Sitesetting::isEnableAvatar()){ $avatar_enabled = 'yes'; } 
$ds_enabled = '';

$globalDateformat = Sitesetting::getDateFormat();



