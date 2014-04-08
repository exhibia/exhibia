<?php
require("config/config.inc.php");


$remote = true;
$remote_server = $_REQUEST['domain'];
$api_key = $_REQUEST['key'];

require($BASE_DIR . "/include/addons/games-server/config.inc.php");



require($BASE_DIR . "/include/addons/games-server/$_REQUEST[game]/config.inc.php");

require($BASE_DIR . "/include/addons/games-server/$_REQUEST[game]/index.php");

