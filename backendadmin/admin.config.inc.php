<?php
$ADMIN_PANEL_VERSION = "1.4";
//*********************************************************************/
$ADMIN_MAIN_SITE_NAME="Pennyauctionsoft";
//*********************************************************************/
//*********************************************************************/
$ADMIN_MAIN_PAGES_TEXT_COLOR="#000000";
$ADMIN_MAIN_PAGES_BG_COLOR="#FFFFFF";
$ADMIN_MAIN_PAGES_LINKS_COLOR="#0000";
//*********************************************************************/
//*********************************************************************/
 $ADMIN_INNER_HEADER_BG_COLOR = "#E0DBD2";	
 $ADMIN_INNER_LEFT_BG_COLOR = "#cccccc";
 $ADMIN_HEADER_BG_COLOR1 = "#263452";//"#2E73AC";
 $ADMIN_HEADER_BG_COLOR2 = "#ffffff";
 $ADMIN_HEADER_BG_COLOR3 = "#DDDBDB";//"#dddddd";
 $ADMIN_HEADER_FONT_COLOR = "#ffffff";
//*********************************************************************/
//*********************************************************************/
$ADMIN_FOOTER_BG_COLOR = "#C6A477";
$ADMIN_FOOTER_FONT_COLOR = "#ffffff";
//*********************************************************************/
//*********************************************************************/
$ADMIN_SIDEBAR_BG_COLOR = "#8C97A5";//"#E0DBD2";
$ADMIN_SIDEBAR_FONT_SIZE = 1;
$ADMIN_SIDEBAR_LINK_COLOR="#8C97A5";//"#000000";

//*********************************************************************/
//*********************************************************************/

$ADMIN_TABLE_BG_COLOR = "#263452";//"#2E73AC";//"#8C97A5";
$ADMIN_TABLE_FONT_COLOR = "#ffffff";
  
//*********************************************************************/
//*********************************************************************/  
    
$ADMIN_USERNAME = "admin";
$ADMIN_PASSWORD = "admin";

//****************************************************************\\
	$ADMIN_EMAIL = "monitor@Pennyauctionsoft.com";
	$ADMIN_CONTACT_EMAIL = "monitor@Pennyauctionsoft.com";
//****************************************************************\\
$SubMembers = 18;
$PRODUCTS_IMAGE_WIDTH = 180;
$PRODUCTS_IMAGE_HEIGHT = 162;
$PRODUCTS_THUMB_IMAGE_WIDTH = 105;
$PRODUCTS_THUMB_IMAGE_HEIGHT = 99;
$Shipping_Charge = 5; //In $

$perpage['manageAttributePage'] = '10';
$perpage['manageCategoryPage'] = '10';
$perpage['manageCountryPage'] = '10';
$perpage['manageCurrencyPage'] = '10';
$perpage['manageCustomerPage'] = '2';
$perpage['manageExtraFieldPage'] = '10';
$perpage['manageManufacturerPage'] = '5';
$perpage['manageOptionValuePage'] = '10';
$perpage['manageOrderPage'] = '5';
$perpage['manageProductPage'] = '4';
$perpage['manageStatePage'] = '10';
$perpage['manageTaxClassPage'] = '5';
$perpage['manageTaxRatePage'] = '10';

$TAX1NAME='PST';
$TAX2NAME='GST';
if(!isset($DATABASENAME)){
include_once '../config/config.inc.php';
}
/*
	$status == 1 ---> "Pending"
	$status == 2 ----> "Delivered"
	$status ==  3 ---> "Cancel"
*/
?>