<?php




	db_query("update style_sheets set value = '#1c97e1' where property = 'background-color' and selector = 'p.jshowoff-slidelinks a' and template = '$template'");
	
	db_query("update style_sheets set value = '2px solid #1c97e1' where property = 'outline' and selector = 'p.jshowoff-slidelinks a' and template = '$template");
	
	
	db_query("update style_sheets set value = '10px' where property = 'font-size' and selector like 'p.jshowoff-slidelinks a%' and template = '$template'");
	
	
	db_query("update style_sheets set value = 'url('')' where property = 'background-image' and selector like 'p.jshowoff-slidelinks a%' and template = '$template'");
	
	
	
	
	
	
