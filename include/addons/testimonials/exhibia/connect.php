<?php

    ini_set('includes_path', '../../../');
    include 'config/config.inc.php';


$db = db_connect($DBSERVER, $USERNAME, $PASSWORD);
if (!$db) {
    die('Could not connect: ' . db_error());
}

db_select_db($DATABASENAME, $db);


db_select_db($DATABASENAME, $db);
@db_query("ALTER table auction add column reserve varchar(20) null");

@db_query("ALTER table auction_running add column reserve varchar(20) null");

@db_query("ALTER table auction_running add  column cashauction varchar(20) null");
@db_query("ALTER table auction add column cashauction varchar(20) null");

$PHP_SELF=$_SERVER['PHP_SELF'];

//varFilter();
$adminemailadd = Sitesetting::getEmailNoDb();

//$lastaucseconds=Sitesetting::getLastaucseconds();
$enableAdminBidder=  Sitesetting::isAllowAdminBidder();

$globalDateformat=  Sitesetting::getDateFormat();
//echo $adminemailadd;
//Custommetatags like google tracking etc
$defaultlanguage=Sitesetting::getLanguage();
Sitesetting::setLanguage();

?>