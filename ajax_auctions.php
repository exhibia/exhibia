<?php
header("Access-Control-Allow-Origin: *");
ini_set('display_errors', 1);

require("config/connect.php");
require("functions.php");
if(!empty($_REQUEST['userid'])){
$_SESSION['userid'] = $_REQUEST['userid'];

}
include("$BASE_DIR/include/$template/ajax_auctions.php");
exit;
