<?php


	db_query("update style_sheets set value = '#fff' where property = 'background-color' and selector = 'p.jshowoff-slidelinks a' and template = '$template'");
	db_query("update style_sheets set value = '$_GET[color]' where property = 'background-color' and selector = 'p.jshowoff-slidelinks a:active' and template = '$template'");
	db_query("update style_sheets set value = '$_GET[color]' where property = 'background-color' and selector = 'p.jshowoff-slidelinks a:hover' and template = '$template'");
	
	
	
	db_query("update style_sheets set value = '1px solid $_GET[color]' where property = 'border' and selector = 'p.jshowoff-slidelinks a' and template = '$template'");
	
	
	
	
	
	db_query("update style_sheets set value = '6px' where property = 'padding' and selector = 'p.jshowoff-slidelinks a' and template = '$template");
	db_query("update style_sheets set value = '2px' where property = 'margin' and selector = 'p.jshowoff-slidelinks a' and template = '$template");
	
	db_query("update style_sheets set value = '1px solid $_GET[color]' where property = 'outline' and selector = 'p.jshowoff-slidelinks a' and template = '$template");
	db_query("update style_sheets set value = '24px' where property = 'border-radius' and selector = 'p.jshowoff-slidelinks a' and template = '$template");
	
	db_query("update style_sheets set value = '0px' where property = 'font-size' and selector like 'p.jshowoff-slidelinks a%' and template = '$template'");
	
	db_query("update style_sheets set value = '0' where property = 'outline' and selector like 'p.jshowoff-slidelinks a%' and template = '$template'");
	
	db_query("update style_sheets set value = 'url('')' where property = 'background-image' and selector like 'p.jshowoff-slidelinks a%' and template = '$template'");
	
	

	
	
	