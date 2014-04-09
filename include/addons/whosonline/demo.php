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
	# WOL DEMO                                                           #
	######################################################################
	\*==================================================================*/
   //define the juice
   define("IN_WOL", true);
   
   //include the config
   require_once("assets/config.php");
   
   //add users and remove inactive ones
   $wol->userRecorder(time(), false, $wol->pageLocator());
   
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>WOL Demo Script</title>
    
    <link href="style.css" rel="stylesheet" type="text/css" media="screen" />
</head>
<body>
    <h4>Who's Online List Demo Using PHP</h4>
<?php 
   //now display the users
   $wol->displayWOL();
?>

</body>
</html>