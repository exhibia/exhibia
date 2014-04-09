<?php
require(dirname(__FILE__) . '/xss_rules.php');

ini_set('date.timezone','America/New_York');
if(empty($installer) & empty($json_script) & empty($position)){

@session_start();

}
// Example of connection settings
//$myConfig = array();
$DBSERVER  = '{hostname}';
$DATABASENAME  = '{database}';
$USERNAME  = '{username}';
$PASSWORD  = '{password}';

$ADMIN_MAIN_SITE_NAME='{sitename}';

$SITE_NM='{sitenm}';

$AllPageTitle = '{pagetitle}';

$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";


if(empty($_SERVER['SERVER_NAME'])){
  $_SERVER['SERVER_NAME'] = '{SERVER_NAME}';

}

$SITE_URL=$protocol . $_SERVER['SERVER_NAME'] . '/';
$BASE_FOLDER='{base_folder}';
$subfolder='';

$MetaTagskeywords = '{metatagskeywords}';
//MetaTag keywords for SEO

$MetaTagsdescripton = '{metatagsdescription}';
//MetaTag Description

// Other information from the installer
//$defaultlanguage = '{language}';

$UploadImagePath = $SITE_URL . "uploads/";
$openinviter_cookiepath="/tmp";

//How may items to show in a user account
$Currency = "$";
$CurrencyName="USD";

$PlusPointValue = 1;
//Bonus Points Value

//$lastaucseconds = 60;
//Auction ending seconds

$googleverification = "ZX14317801374018374";
//Google verification code

$customtags = "";


$PRODUCTSPERPAGE = 10;
//How many items on the main page
$PRODUCTSPERPAGE_MYACCOUNT = 5;

//Currency symbol
$SMSrate = 1.50;
//SMS Rate, you must have the SMS plugin for this
$SMSsendnumber = "1065";
//SMS Clicktell account number
$paymentFolder='payment';
$topbidercount=4;

$Username = 'support';
$Password = '{password}';
$mailOptions = '143/imap';

$page_areas = array('container' => array('column-left', 'column-right'));

$BASE_DIR = '{basedir}';


$license_server = '{license_server}';
$download_server = '{download_server}';



$db = db_connect($DBSERVER, $USERNAME, $PASSWORD);


db_select_db($DATABASENAME, $db);
if(!empty($_COOKIE['template']) & empty($json_script)){
    //setcookie('template', $_COOKIE['template'], time()-34567900, '/');
}
if(!empty($_COOKIE['lang']) & !empty($_COOKIE['lang']) & empty($json_script)){
   // setcookie("lang", $_COOKIE['lang'], time()-(3600*24), '/');
}

if(empty($_GET['template']) & empty($json_script)){
 $settings_sql = db_query("select distinct value from sitesetting where name = 'master_settings'");
 
    while($row_s = db_fetch_array($settings_sql)){
	$setting = explode(":", $row_s[0]);
	
	$$setting[0] = $setting[1];
    }
    
    $template = db_fetch_object(db_query("select value from sitesetting where name  = 'template' order by id desc limit 1"));
    $template = $template->value;
  
    

}else{
   

} 
if(empty($json_script)){
      
      if(empty($_COOKIE['template'])){
	//  setcookie('template', $template, time()+34567890, '/');
	 //$template = $_GET['template'];
	 // $_SESSION['template'] = $template;
      }
}

$page_areas = array('container' => array('column-left', 'column-right'));


if(!empty($_GET['lang']) & empty($json_script)){
      $_SESSION['lang'] = $_GET['lang'];

     // setcookie("lang", $_GET['lang'], time()+(3600*24), '/');
}
$page_areas = array("container" => array("column-left", "column-right"));
$template = '{template}';



$country_extra_sql = " order by default_pos, printable_name desc";

$points_to_give = 30;
$from_where = 'bid_account';
//$splash = 'enabled';
?>