<?php

	/*==================================================================*\
	######################################################################
	#                                                                    #
	# Copyright 2010 Dynno.net . All Rights Reserved.                    #
	#                                                                    #
	# This file may not be redistributed in whole or part.               #
	#                                                                    #
	# Developed by: $ID: 1 $UNI: Imad Jomaa                              #
	# ----------------------- THIS FILE PREFORMS ----------------------- #
	#                                                                    #
	# Configuration                                                      #
	######################################################################
	\*==================================================================*/

if(file_exists('config/config.inc.php')){
    include_once 'config/config.inc.php';
}else if(file_exists('../config/config.inc.php')){
    include_once '../config/config.inc.php';
}else{
    include_once '../../config/config.inc.php';
}

//Disallow direct file access for security reasons
if (!defined("IN_WOL")) { die(header("Location: ../index.php")); }

//error_reporting(E_ALL);
include_once($onlinepath.'assets/functions.php');
//lets include necessary files
include_once('classes/class_mysql.php');
include_once('classes/online_class.php');


//let's initaite the database information to be used for db connection
$db_host = $DBSERVER;
$db_user = $USERNAME;
$db_pass = $PASSWORD;
$db_name = $DATABASENAME;

//SETTINGS
$time   = "15"; // this is the time until the user is considered offline - in minutes only please =)
$domain = $_SERVER['SERVER_NAME']; // the domain of your website - NO TRAILING SLASH

//connect to the MySQL database & instantiate all necessary classes
$db = db_connect($db_host, $db_user, $db_pass, $db_name);

//instantiate the online class
$wol = new Online_list($time, $domain);

?>
