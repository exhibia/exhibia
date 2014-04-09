<?php



	db_query("update style_sheets set value = 'transparent' where property = 'background-color' and selector = 'p.jshowoff-slidelinks a' and template = '$template'");
	
	db_query("update style_sheets set value = '0' where property = 'outline' and selector = 'p.jshowoff-slidelinks a' and template = '$template");
	

	db_query("update style_sheets set value = 'q0px' where property = 'font-size' and selector like 'p.jshowoff-slidelinks a%' and template = '$template");
	
	db_query("update style_sheets set value = '10px' where property = 'font-size' and selector like 'p.jshowoff-slidelinks a%' and template = '$template");
	
	db_query("update style_sheets set value = 'url(\'$SITE_URL/include/slider_images/$_GET[color]/button_off.png\')' where property = 'background-image' and selector = 'p.jshowoff-slidelinks a' and template = '$template");
	
	
	
	db_query("update style_sheets set value = '0px' where property = 'font-size' and selector = 'p.jshowoff-slidelinks a:hover' and template = '$template");
	db_query("update style_sheets set value = 'url(\'$SITE_URL/include/slider_images/$_GET[color]/button_on.png\')' where property = 'background-image' and selector = 'p.jshowoff-slidelinks a:hover' and template = '$template");
	
	db_query("update style_sheets set value = 'url(\'$SITE_URL/include/slider_images/$_GET[color]/button_on.png\')' where property = 'background-image' and selector = 'p.jshowoff-slidelinks a:active' and template = '$template");
	
