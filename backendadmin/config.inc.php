<?php
@session_start();
if(!isset($DATABASENAME)){
require '../config/config.inc.php';
}
require '../config/connect.php';
require_once '../common/sitesetting.php';

define("DIR_WS_IMAGES", 'images/');
define("DIR_WS_ICONS", DIR_WS_IMAGES.'icons/');
define("DIR_WS_BANNERS", DIR_WS_IMAGES.'banners/');
define("DIR_WS_CATEGORIES", DIR_WS_IMAGES.'categories/');
define("DIR_WS_PRODUCTS", DIR_WS_IMAGES.'products/');
define("DIR_WS_MANUFACTURERS", DIR_WS_IMAGES.'manufacturers/');

$DIR_WS_IMAGES = "images/";
$DIR_WS_ICONS  = "images/icons/";

//$adminemailadd = Sitesetting::getEmail($DBSERVER, $DATABASENAME, $USERNAME, $PASSWORD);

?>