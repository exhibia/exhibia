<?php
$_CONFIG=true;
if(empty($BASE_DIR)){
include("../../../config/config.inc.php");
}
/* database settings */
$CFG_SERVER = $DBSERVER;
$CFG_USER = $USERNAME;
$CFG_PASSWORD = $PASSWORD;
$CFG_DATABASE = $DATABASENAME;

/* server settings */
$CFG_SESSIONTIMEOUT = 900;
$CFG_EXPIREGAME = 14;
$CFG_MINAUTORELOAD = 5;
$CFG_USEEMAILNOTIFICATION = FALSE;
$CFG_MAILADRESS = 'games@pennyauctionsoft.com';
$CFG_MAINPAGE = 'http://pennyauctionsoft.com/games.php?game=chess';
$CFG_MAXUSERS = 100;
$CFG_MAXACTIVEGAMES = 100;
$CFG_NICKCHANGEALLOWED = FALSE;
$CFG_NEW_USERS_ALLOWED = TRUE;
$CFG_BOARDSQUARESIZE = 500;
/* mysql table names */
$CFG_TABLE['communication'] = "communication";
$CFG_TABLE['games'] = "games";
$CFG_TABLE['history'] = "history";
$CFG_TABLE['messages'] = "messages";
$CFG_TABLE['pieces'] = "pieces";
$CFG_TABLE['players'] = "players";
$CFG_TABLE['preferences'] = "preferences";

$CFG_IMAGE_EXT = 'gif';
?>