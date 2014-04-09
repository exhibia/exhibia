<?php
ini_set("max_execution_time", 0);
  ?>

  Installing Languages to Support Text Editing
  <br /><pre>
<?php
if(!function_exists('directoryToArray')){
function directoryToArray($directory, $extension, $full_path = false) {

if(isset($directory) & @ $directory != ""){
	$array_items = array();
	$handle = @ opendir($directory);
		while (false !== ($file = @ readdir($handle))) {
			if ($file != "." && $file != "..") {
				if (is_dir($directory. "/" . $file)) {
					$array_items = array_merge($array_items, directoryToArray($directory. "/" . $file, $extension, $full_path));
				}
				else {
					if(!$extension || (preg_match("/.$extension/", $file)))
					{

                              {


						if($full_path) {
							$array_items[] = $directory . "/" . $file;

						}
						else {

							$array_items[] = $file;
						}
					}
}
				}
			}
		}
		@ closedir($handle);

	return $array_items;
}
}
}





$languages = db_query("select * from language");

    while($row_lang = db_fetch_array($languages)){

	if(db_num_rows(db_query("select * from languages where language = '$row_lang[language]'")) == 0){


	    $lang_files = directoryToArray("languages", "php", $full_path = true);

	      foreach($lang_files as $index => $file){
		  parseLanguage($file, $row_lang['language']);


	      }


    }

}




  $css_files = directoryToArray("css", "css", $full_path = true);

	foreach($css_files as $index => $file){
		  parseCSS($file);

	    }


	

db_query("CREATE TABLE IF NOT EXISTS `language_choices` (
  `id` int(11) NOT NULL auto_increment,
  `abbrev` text NOT NULL,
  `country` text NOT NULL,
  `lang_text` text NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `index` (`id`)
);");


db_query("INSERT INTO `language_choices` VALUES (1,'AD','Andorra',''),(2,'AE','United Arab Emirates',''),(3,'AF','Afghanistan','afrikaans'),(4,'AG','Antigua and Barbuda',''),(5,'AI','Anguilla',''),(6,'AL','Albania',''),(7,'AM','Armenia','amharic'),(8,'AN','Netherlands Antilles','aragonese'),(9,'AO','Angola',''),(10,'AR','Argentina','arabic'),(11,'AS','American Samoa','assamese'),(12,'AT','Austria',''),(13,'AU','Australia','english'),(14,'AW','Aruba',''),(15,'AX','Ã…land Islands',''),(16,'AZ','Azerbaijan','azerbaijani'),(17,'BA','Bosnia and Herzegovina','bashkir'),(18,'BB','Barbados',''),(19,'BD','Bangladesh',''),(20,'BE','Belgium',''),(21,'BF','Burkina Faso',''),(22,'BG','Bulgaria','bulgarian'),(23,'BH','Bahrain','bihari'),(24,'BI','Burundi','bislama'),(25,'BJ','Benin',''),(26,'BL','Saint BarthÃ©lemy',''),(27,'BM','Bermuda',''),(28,'BN','Brunei',''),(29,'BO','Bolivia','spanish'),(30,'BQ','British Antarctic Territory',''),(31,'BS','Bahamas',''),(32,'BT','Bhutan',''),(33,'BV','Bouvet Island',''),(34,'BW','Botswana',''),(35,'BY','Belarus',''),(36,'BZ','Belize',''),(37,'CA','Canada','english'),(38,'CC','Cocos [Keeling] Islands',''),(39,'CD','Congo - Kinshasa',''),(40,'CF','Central African Republic',''),(41,'CG','Congo - Brazzaville',''),(42,'CH','Switzerland',''),(43,'CI','CÃ´te dâ€™Ivoire',''),(44,'CK','Cook Islands',''),(45,'CL','Chile','spanish'),(46,'CM','Cameroon',''),(47,'CN','China','chinese'),(48,'CO','Colombia','spanish'),(49,'CR','Costa Rica','spanish'),(50,'CS','Serbia and Montenegro','czech'),(51,'CT','Canton and Enderbury Islands',''),(52,'CU','Cuba',''),(53,'CV','Cape Verde',''),(54,'CX','Christmas Island',''),(55,'CY','Cyprus','welsh'),(56,'CZ','Czech Republic',''),(57,'DD','East Germany',''),(58,'DE','Germany','german'),(59,'DJ','Djibouti',''),(60,'DK','Denmark',''),(61,'DM','Dominica',''),(62,'DO','Dominican Republic',''),(63,'DZ','Algeria','bhutani'),(64,'EC','Ecuador','spanish'),(65,'EE','Estonia',''),(66,'EG','Egypt',''),(67,'EH','Western Sahara',''),(68,'ER','Eritrea',''),(69,'ES','Spain','spanish'),(70,'ET','Ethiopia','estonian'),(71,'FI','Finland','finnish'),(72,'FJ','Fiji','fiji'),(73,'FK','Falkland Islands',''),(74,'FM','Micronesia',''),(75,'FO','Faroe Islands','faeroese'),(76,'FQ','French Southern and Antarctic Territories',''),(77,'FR','France','french'),(78,'FX','Metropolitan France',''),(79,'GA','Gabon','irish'),(80,'GB','United Kingdom','english'),(81,'GD','Grenada',''),(82,'GE','Georgia',''),(83,'GF','French Guiana',''),(84,'GG','Guernsey',''),(85,'GH','Ghana',''),(86,'GI','Gibraltar',''),(87,'GL','Greenland','galician'),(88,'GM','Gambia',''),(89,'GN','Guinea','guarani'),(90,'GP','Guadeloupe',''),(91,'GQ','Equatorial Guinea',''),(92,'GR','Greece',''),(93,'GS','South Georgia and the South Sandwich Islands',''),(94,'GT','Guatemala',''),(95,'GU','Guam','gujarati'),(96,'GW','Guinea-Bissau',''),(97,'GY','Guyana',''),(98,'HK','Hong Kong SAR China',''),(99,'HM','Heard Island and McDonald Islands',''),(100,'HN','Honduras',''),(101,'HR','Croatia','croatian'),(102,'HT','Haiti','haitiancreole'),(103,'HU','Hungary','hungarian'),(104,'ID','Indonesia',''),(105,'IE','Ireland','english'),(106,'IL','Israel',''),(107,'IM','Isle of Man','english'),(108,'IN','India',''),(109,'IO','British Indian Ocean Territory','ido'),(110,'IQ','Iraq',''),(111,'IR','Iran',''),(112,'IS','Iceland','icelandic'),(113,'IT','Italy','italian'),(114,'JE','Jersey',''),(115,'JM','Jamaica',''),(116,'JO','Jordan',''),(117,'JP','Japan',''),(118,'JT','Johnston Island',''),(119,'KE','Kenya',''),(120,'KG','Kyrgyzstan',''),(121,'KH','Cambodia',''),(122,'KI','Kiribati',''),(123,'KM','Comoros','cambodian'),(124,'KN','Saint Kitts and Nevis','kannada'),(125,'KP','North Korea',''),(126,'KR','South Korea',''),(127,'KW','Kuwait',''),(128,'KY','Cayman Islands','kirghiz'),(129,'KZ','Kazakhstan',''),(130,'LA','Laos','latin'),(131,'LB','Lebanon',''),(132,'LC','Saint Lucia',''),(133,'LI','Liechtenstein',''),(134,'LK','Sri Lanka',''),(135,'LR','Liberia',''),(136,'LS','Lesotho',''),(137,'LT','Lithuania','lithuanian'),(138,'LU','Luxembourg',''),(139,'LV','Latvia',''),(140,'LY','Libya',''),(141,'MA','Morocco',''),(142,'MC','Monaco',''),(143,'MD','Moldova',''),(144,'ME','Montenegro',''),(145,'MF','Saint Martin',''),(146,'MG','Madagascar','malagasy'),(147,'MH','Marshall Islands',''),(148,'MI','Midway Islands','maori'),(149,'MK','Macedonia','macedonian'),(150,'ML','Mali','malayalam'),(151,'MM','Myanmar [Burma]',''),(152,'MN','Mongolia','mongolian'),(153,'MO','Macau SAR China','moldavian'),(154,'MP','Northern Mariana Islands',''),(155,'MQ','Martinique',''),(156,'MR','Mauritania','marathi'),(157,'MS','Montserrat','malay'),(158,'MT','Malta','maltese'),(159,'MU','Mauritius',''),(160,'MV','Maldives',''),(161,'MW','Malawi',''),(162,'MX','Mexico','spanish'),(163,'MY','Malaysia','burmese'),(164,'MZ','Mozambique',''),(165,'NA','Namibia','nauru'),(166,'NC','New Caledonia',''),(167,'NE','Niger','nepali'),(168,'NF','Norfolk Island',''),(169,'NG','Nigeria',''),(170,'NI','Nicaragua',''),(171,'NL','Netherlands','dutch'),(172,'NO','Norway','norwegian'),(173,'NP','Nepal',''),(174,'NQ','Dronning Maud Land',''),(175,'NR','Nauru',''),(176,'NT','Neutral Zone',''),(177,'NU','Niue',''),(178,'NZ','New Zealand',''),(179,'OM','Oman',''),(180,'PA','Panama','punjabi'),(181,'PC','Pacific Islands Trust Territory',''),(182,'PE','Peru',''),(183,'PF','French Polynesia',''),(184,'PG','Papua New Guinea',''),(185,'PH','Philippines',''),(186,'PK','Pakistan',''),(187,'PL','Poland','polish'),(188,'PM','Saint Pierre and Miquelon',''),(189,'PN','Pitcairn Islands',''),(190,'PR','Puerto Rico',''),(191,'PS','Palestinian Territories',''),(192,'PU','U.S. Miscellaneous Pacific Islands',''),(193,'PW','Palau',''),(194,'PY','Paraguay',''),(195,'PZ','Panama Canal Zone',''),(196,'QA','Qatar',''),(197,'RE','RÃ©union',''),(198,'RO','Romania','romanian'),(199,'RS','Serbia',''),(200,'RU','Russia','russian'),(201,'RW','Rwanda',''),(202,'SA','Saudi Arabia','sanskrit'),(203,'SB','Solomon Islands',''),(204,'SC','Seychelles',''),(205,'SD','Sudan','sindhi'),(206,'SE','Sweden',''),(207,'SG','Singapore','sangro'),(208,'SH','Saint Helena',''),(209,'SI','Slovenia','sinhalese'),(210,'SJ','Svalbard and Jan Mayen',''),(211,'SK','Slovakia','slovak'),(212,'SL','Sierra Leone','slovenian'),(213,'SM','San Marino','samoan'),(214,'SN','Senegal','shona'),(215,'SO','Somalia','somali'),(216,'SR','Suriname','serbian'),(217,'ST','SÃ£o TomÃ© and PrÃ­ncipe','sesotho'),(218,'SU','Union of Soviet Socialist Republics','sundanese'),(219,'SV','El Salvador','swedish'),(220,'SY','Syria',''),(221,'SZ','Swaziland',''),(222,'TC','Turks and Caicos Islands',''),(223,'TD','Chad',''),(224,'TF','French Southern Territories',''),(225,'TG','Togo','tajik'),(226,'TH','Thailand','thai'),(227,'TJ','Tajikistan',''),(228,'TK','Tokelau','turkmen'),(229,'TL','Timor-Leste','tagalog'),(230,'TM','Turkmenistan',''),(231,'TN','Tunisia','setswana'),(232,'TO','Tonga','tonga'),(233,'TR','Turkey','turkish'),(234,'TT','Trinidad and Tobago','tatar'),(235,'TV','Tuvalu',''),(236,'TW','Taiwan','twi'),(237,'TZ','Tanzania',''),(238,'UA','Ukraine',''),(239,'UG','Uganda','uighur'),(240,'UM','U.S. Minor Outlying Islands',''),(241,'US','United States','english'),(242,'UY','Uruguay',''),(243,'UZ','Uzbekistan','uzbek'),(244,'VA','Vatican City',''),(245,'VC','Saint Vincent and the Grenadines',''),(246,'VD','North Vietnam',''),(247,'VE','Venezuela',''),(248,'VG','British Virgin Islands',''),(249,'VI','U.S. Virgin Islands','vietnamese'),(250,'VN','Vietnam',''),(251,'VU','Vanuatu',''),(252,'WF','Wallis and Futuna',''),(253,'WK','Wake Island',''),(254,'WS','Samoa',''),(255,'YD','People\'s Democratic Republic of Yemen',''),(256,'YE','Yemen',''),(257,'YT','Mayotte',''),(258,'ZA','South Africa',''),(259,'ZM','Zambia',''),(260,'ZW','Zimbabwe','');");





db_query("insert into sitesetting values(null, 'addons', 'uploader');");
  ?>
</pre>