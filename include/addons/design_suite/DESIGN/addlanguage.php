<?php
if(!function_exists('directoryToArray')){
function directoryToArray($directory, $extension, $full_path, $sub_folder = '' ) {

if(isset($directory) & @ $directory != ""){
	$array_items = array();
	$handle = @ opendir($directory);
		while (false !== ($file = @ readdir($handle))) {
			if ($file != "." && $file != "..") {
				if (is_dir($directory. "/" . $file)) {
if(!empty($sub_folder)){
@mkdir($sub_folder . "/" . $file);
}
					$array_items = array_merge($array_items, directoryToArray($directory. "/" . $file, $extension, $full_path, $sub_folder)); 

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
db_query("CREATE TABLE IF NOT EXISTS `language_choices` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `abbrev` text not null,
  `country` text NOT NULL,

  PRIMARY KEY (`id`),
  KEY `index` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=55 ;");

db_query("truncate table language_choices");


if(db_num_rows(db_query("SELECT * FROM language_choices")) == 0){
db_query("INSERT INTO `language_choices`  VALUES (null, 'AD', 'Andorra', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'AE', 'United Arab Emirates', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'AF', 'Afghanistan', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'AG', 'Antigua and Barbuda', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'AI', 'Anguilla', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'AL', 'Albania', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'AM', 'Armenia', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'AN', 'Netherlands Antilles', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'AO', 'Angola', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'AR', 'Argentina', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'AS', 'American Samoa', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'AT', 'Austria', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'AU', 'Australia', 'english');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'AW', 'Aruba', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'AX', 'Åland Islands', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'AZ', 'Azerbaijan', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'BA', 'Bosnia and Herzegovina', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'BB', 'Barbados', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'BD', 'Bangladesh', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'BE', 'Belgium', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'BF', 'Burkina Faso', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'BG', 'Bulgaria', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'BH', 'Bahrain', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'BI', 'Burundi', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'BJ', 'Benin', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'BL', 'Saint Barthélemy', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'BM', 'Bermuda', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'BN', 'Brunei', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'BO', 'Bolivia', 'spanish');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'BQ', 'British Antarctic Territory', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'BR', 'Brazil', 'portugese', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'BS', 'Bahamas', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'BT', 'Bhutan', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'BV', 'Bouvet Island', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'BW', 'Botswana', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'BY', 'Belarus', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'BZ', 'Belize', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'CA', 'Canada', 'english');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'CC', 'Cocos [Keeling] Islands', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'CD', 'Congo - Kinshasa', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'CF', 'Central African Republic', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'CG', 'Congo - Brazzaville', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'CH', 'Switzerland', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'CI', 'Côte d’Ivoire', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'CK', 'Cook Islands', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'CL', 'Chile', 'spanish');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'CM', 'Cameroon', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'CN', 'China', 'chinese');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'CO', 'Colombia', 'spanish');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'CR', 'Costa Rica', 'spanish');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'CS', 'Serbia and Montenegro', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'CT', 'Canton and Enderbury Islands', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'CU', 'Cuba', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'CV', 'Cape Verde', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'CX', 'Christmas Island', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'CY', 'Cyprus', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'CZ', 'Czech Republic', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'DD', 'East Germany', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'DE', 'Germany', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'DJ', 'Djibouti', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'DK', 'Denmark', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'DM', 'Dominica', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'DO', 'Dominican Republic', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'DZ', 'Algeria', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'EC', 'Ecuador', 'spanish');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'EE', 'Estonia', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'EG', 'Egypt', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'EH', 'Western Sahara', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'ER', 'Eritrea', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'ES', 'Spain', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'ET', 'Ethiopia', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'FI', 'Finland', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'FJ', 'Fiji', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'FK', 'Falkland Islands', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'FM', 'Micronesia', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'FO', 'Faroe Islands', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'FQ', 'French Southern and Antarctic Territories', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'FR', 'France', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'FX', 'Metropolitan France', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'GA', 'Gabon', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'GB', 'United Kingdom', 'english');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'GD', 'Grenada', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'GE', 'Georgia', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'GF', 'French Guiana', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'GG', 'Guernsey', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'GH', 'Ghana', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'GI', 'Gibraltar', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'GL', 'Greenland', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'GM', 'Gambia', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'GN', 'Guinea', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'GP', 'Guadeloupe', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'GQ', 'Equatorial Guinea', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'GR', 'Greece', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'GS', 'South Georgia and the South Sandwich Islands', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'GT', 'Guatemala', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'GU', 'Guam', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'GW', 'Guinea-Bissau', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'GY', 'Guyana', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'HK', 'Hong Kong SAR China', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'HM', 'Heard Island and McDonald Islands', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'HN', 'Honduras', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'HR', 'Croatia', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'HT', 'Haiti', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'HU', 'Hungary', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'ID', 'Indonesia', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'IE', 'Ireland', 'english');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'IL', 'Israel', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'IM', 'Isle of Man', 'english');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'IN', 'India', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'IO', 'British Indian Ocean Territory', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'IQ', 'Iraq', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'IR', 'Iran', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'IS', 'Iceland', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'IT', 'Italy', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'JE', 'Jersey', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'JM', 'Jamaica', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'JO', 'Jordan', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'JP', 'Japan', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'JT', 'Johnston Island', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'KE', 'Kenya', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'KG', 'Kyrgyzstan', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'KH', 'Cambodia', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'KI', 'Kiribati', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'KM', 'Comoros', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'KN', 'Saint Kitts and Nevis', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'KP', 'North Korea', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'KR', 'South Korea', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'KW', 'Kuwait', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'KY', 'Cayman Islands', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'KZ', 'Kazakhstan', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'LA', 'Laos', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'LB', 'Lebanon', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'LC', 'Saint Lucia', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'LI', 'Liechtenstein', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'LK', 'Sri Lanka', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'LR', 'Liberia', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'LS', 'Lesotho', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'LT', 'Lithuania', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'LU', 'Luxembourg', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'LV', 'Latvia', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'LY', 'Libya', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'MA', 'Morocco', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'MC', 'Monaco', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'MD', 'Moldova', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'ME', 'Montenegro', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'MF', 'Saint Martin', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'MG', 'Madagascar', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'MH', 'Marshall Islands', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'MI', 'Midway Islands', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'MK', 'Macedonia', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'ML', 'Mali', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'MM', 'Myanmar [Burma]', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'MN', 'Mongolia', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'MO', 'Macau SAR China', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'MP', 'Northern Mariana Islands', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'MQ', 'Martinique', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'MR', 'Mauritania', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'MS', 'Montserrat', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'MT', 'Malta', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'MU', 'Mauritius', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'MV', 'Maldives', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'MW', 'Malawi', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'MX', 'Mexico', 'spanish');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'MY', 'Malaysia', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'MZ', 'Mozambique', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'NA', 'Namibia', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'NC', 'New Caledonia', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'NE', 'Niger', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'NF', 'Norfolk Island', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'NG', 'Nigeria', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'NI', 'Nicaragua', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'NL', 'Netherlands', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'NO', 'Norway', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'NP', 'Nepal', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'NQ', 'Dronning Maud Land', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'NR', 'Nauru', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'NT', 'Neutral Zone', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'NU', 'Niue', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'NZ', 'New Zealand', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'OM', 'Oman', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'PA', 'Panama', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'PC', 'Pacific Islands Trust Territory', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'PE', 'Peru', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'PF', 'French Polynesia', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'PG', 'Papua New Guinea', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'PH', 'Philippines', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'PK', 'Pakistan', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'PL', 'Poland', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'PM', 'Saint Pierre and Miquelon', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'PN', 'Pitcairn Islands', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'PR', 'Puerto Rico', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'PS', 'Palestinian Territories', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'PT', 'Portugal', 'portugese', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'PU', 'U.S. Miscellaneous Pacific Islands', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'PW', 'Palau', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'PY', 'Paraguay', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'PZ', 'Panama Canal Zone', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'QA', 'Qatar', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'RE', 'Réunion', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'RO', 'Romania', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'RS', 'Serbia', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'RU', 'Russia', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'RW', 'Rwanda', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'SA', 'Saudi Arabia', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'SB', 'Solomon Islands', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'SC', 'Seychelles', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'SD', 'Sudan', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'SE', 'Sweden', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'SG', 'Singapore', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'SH', 'Saint Helena', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'SI', 'Slovenia', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'SJ', 'Svalbard and Jan Mayen', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'SK', 'Slovakia', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'SL', 'Sierra Leone', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'SM', 'San Marino', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'SN', 'Senegal', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'SO', 'Somalia', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'SR', 'Suriname', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'ST', 'São Tomé and Príncipe', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'SU', 'Union of Soviet Socialist Republics', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'SV', 'El Salvador', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'SY', 'Syria', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'SZ', 'Swaziland', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'TC', 'Turks and Caicos Islands', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'TD', 'Chad', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'TF', 'French Southern Territories', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'TG', 'Togo', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'TH', 'Thailand', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'TJ', 'Tajikistan', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'TK', 'Tokelau', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'TL', 'Timor-Leste', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'TM', 'Turkmenistan', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'TN', 'Tunisia', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'TO', 'Tonga', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'TR', 'Turkey', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'TT', 'Trinidad and Tobago', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'TV', 'Tuvalu', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'TW', 'Taiwan', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'TZ', 'Tanzania', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'UA', 'Ukraine', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'UG', 'Uganda', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'UM', 'U.S. Minor Outlying Islands', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'US', 'United States', 'english');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'UY', 'Uruguay', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'UZ', 'Uzbekistan', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'VA', 'Vatican City', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'VC', 'Saint Vincent and the Grenadines', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'VD', 'North Vietnam', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'VE', 'Venezuela', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'VG', 'British Virgin Islands', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'VI', 'U.S. Virgin Islands', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'VN', 'Vietnam', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'VU', 'Vanuatu', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'WF', 'Wallis and Futuna', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'WK', 'Wake Island', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'WS', 'Samoa', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'YD', 'People\'s Democratic Republic of Yemen', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'YE', 'Yemen', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'YT', 'Mayotte', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'ZA', 'South Africa', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'ZM', 'Zambia', '');");
db_query("INSERT INTO `language_choices`  VALUES (null, 'ZW', 'Zimbabwe', '');");

}

@db_query("alter table language_choices add column lang_text text not null");


$query = db_query("select * from language_choices where lang_text = ''");
if(db_num_rows($query) >= 1){
	$langs = file_get_contents("http://www.w3schools.com/tags/ref_language_codes.asp");
//echo $langs;
	$langs = explode("<h2>ISO 639-1 Language Codes</h2>", $langs);
	
	$langs = explode("</table>", $langs[1]);
	$langs = preg_replace('/(\t|\r|\n|\s)+/', '', $langs[0]);



}


while($row = db_fetch_array($query)){

//$regex = "/<td>" . strtolower($row['abbrev']) . "<\/td>(.*)<td>(.*)<\/td><td>/i";
//echo $regex;
//(.*)<td>(.*)</td>

    preg_match_all("@<tr><td>([a-zA-z0-9]+)</td><td>" . strtolower($row['abbrev']) . "</td></tr>@i", $langs, $matches); 

if(!empty($matches[1][0]) & db_num_rows(db_query("select * from language_choices where lang_text = '' and id = '$row[id]'")) >= 1 ){

$lang_text2 = str_replace(" ", "_", $matches[1][0]);

db_query("update language_choices set lang_text = '" . str_replace(" ", "_", strtolower($lang_text2)) . "' where abbrev = '$row[abbrev]' and id = '$row[id]'"); 

}else{

db_query("update language_choices set lang_text = '' where abbrev = '$row[abbrev]' and id = '$row[id]'"); 
}
unset($row['abbrev']);
unset($matches);
unset($lang_text2);

}
echo db_error();

?>
	<?php
if(!empty($_REQUEST['lang_pack'])){
?>
<a href="<?php echo $SITE_URL . "/backendadmin/my-archive.zip"; ?>">Download This Language Pack</a>

<?php
}
?>
<style>
.inputs{
width:500px;

}
label{
width:500px;
}
</style>	

     <script>

function show(divId){
document.getElementById(divId).style.display='block';

if(divId == "chooseform"){

document.getElementById('createform').style.display='none';
document.getElementById('customform').style.display='none';

}else if(divId == 'customform'){
document.getElementById('chooseform').style.display='none';
document.getElementById('createform').style.display='none';

}else{
document.getElementById('chooseform').style.display='none';
document.getElementById('customform').style.display='none';

}
}
</script>					<!--[if !IE]>start row<![endif]-->
                                                         
                                                            <div class="forms">
                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">


                                                             
                                                                    <div class="inputs" style="width:400px;">
                                                                        <input type="radio" value="choose" onclick="show('chooseform');"> <label id="pdcode-label">Choose a Language To Create</label><br />
									   
									
                                                                        
                                                                    </div>
                                                                </div>
							    </div>
		  
						


							<!--[if !IE]>start row<![endif]-->
                                                        <div class="forms" id="chooseform" style="display:none;">     
                                                            
                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    
                                                                    <div class="inputs">
                                                                        <select name="country" id="country">
<?php
$sql = db_query("SELECT * FROM language_choices order by country asc");

while($row = db_fetch_array($sql)){

?>
<option value="<?php echo $row['abbrev'];?>"><?php echo $row['country'];?></option>
<?php
}
?>
									</select>
<br>

<input type="radio" value="yes" name="lang_pack"> <label id="lang_pack">Download as language pack</label><br />
                                                                        
                                                                    </div>
                                                                </div>
							    </div>
		  
							

							<!--[if !IE]>start row<![endif]-->
                                                         
                                                            <div class="forms">
                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">

                                                                 <div class="inputs" style="width:400px;">
							  <label id="pdcode-label">Or</label><br />


                                                                        
                                                                    </div>
                                                                </div>
							    </div>
		  
							




					<!--[if !IE]>start row<![endif]-->
                                                         
                                                            <div class="forms">
                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">


                                                             
                                                                    <div class="inputs" style="width:400px;">
                                                                        <input type="radio" value="choose" onclick="show('customform');"> <label id="pdcode-label">Choose a Language To Customise</label><br />
									   
									
                                                                        
                                                                    </div>
                                                                </div>
							    </div>
		  
							 
<script>
function ajaxpages() { jQuery.get("DESIGN/pages.php?lang=" + encodeURIComponent($("#countrycustom").val()), function(data){ $("#pages").html(data);} ); }
</script>



                                                        <div class="forms" id="customform" style="display:none;">     
                                                
                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    
                                                                    <div class="inputs">
                                                                        <select name="countrycustom" id="countrycustom"  onchange="ajaxpages();">
<?php
$sql = db_query("SELECT * FROM language");

while($row = db_fetch_array($sql)){
//if(file_exists("../../languages/" . str_replace(" ", "_", strtolower($row['country'])) ) | file_exists("../../languages/" . strtolower($row['lang_text']) )  ){
?>
<option value="<?php echo $row['language'];?>"><?php echo $row['languagename'];?></option>
<?php
//}
}
?>
									</select>
<br>


<div id="pages"></div>
<input type="hidden" name="page" value="customizelanguage.php" />

<input type="radio" value="yes" name="lang_pack"> <label id="lang_pack">Download as language pack</label><br />
                                                                        
                                                                    </div>
                                                                </div>
							    </div>
		  
							

							<!--[if !IE]>start row<![endif]-->
                                                         
                                                            <div class="forms">
                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">

                                                                 <div class="inputs" style="width:400px;">
							  <label id="pdcode-label">Or</label><br />


                                                                        
                                                                    </div>
                                                                </div>
							    </div>
		  
							


							<!--[if !IE]>start row<![endif]-->
                                                    
                                                            <div class="forms">
                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">

                                                                    <div class="inputs" style="width:400px;">

								      <input type="radio" value="create" onclick="show('createform');"> <label id="pdcode-label">Install Language File From PAS</label>
                                                                        
                                                                    </div>
                                                                </div>
							    </div>
		  
					






							<!--[if !IE]>start row<![endif]-->
                                                        <div class="forms" id="createform" style="display:none;">     
                                                           
                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    
                                                                    <div class="inputs">
                                                                        <select name="newlanguage" id="newlanguage">

									</select>
                                                                        <script>
									    $.get({<?php echo $SITE_URL;?>/backendadmin/updatescript.php?q=languages',

										  function(data) {
										    $('#newlanguage').html(data);
						
										    }
										});
									</script>
                                                                    </div>
                                                                </div>
							   
		  
							 </div>

					