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
	# WOL Recorder                                                       #
	######################################################################
	\*==================================================================*/
   
   ##########################################################################################
   # THIS FILE IS USED FOR THE JAVASCRIPT, and it sure can be used for the PHP Code as well #
   ##########################################################################################
   
   //define the juice
   define("IN_WOL", true);
   
   //include the config
   require_once("assets/config.php");
   
   //add users, and remove inactive ones
   $wol->userRecorder(time(), false, $wol->pageLocator());

   


   
?>