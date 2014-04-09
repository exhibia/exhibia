<?php

db_query("CREATE TABLE IF NOT EXISTS php`language_choices` php(
 php `id` int(11) NOT NULL AUTO_INCREMENT,
 php `abbrev` text not null,
 php `country` text NOT NULL,

 php PRIMARY KEY php(`id`),
 php KEY php`index` php(`id`)
) ENGINE=MyISAM php DEFAULT CHARSET=latin1 AUTO_INCREMENT=55 php;");




if(db_num_rows(db_query("SELECT php* FROM language_choices")) php== php0){
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'AD', php'Andorra');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'AE', php'United Arab Emirates');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'AF', php'Afghanistan');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'AG', php'Antigua and Barbuda');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'AI', php'Anguilla');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'AL', php'Albania');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'AM', php'Armenia');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'AN', php'Netherlands Antilles');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'AO', php'Angola');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'AQ', php'Antarctica');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'AR', php'Argentina');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'AS', php'American Samoa');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'AT', php'Austria');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'AU', php'Australia');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'AW', php'Aruba');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'AX', php'Åland Islands');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'AZ', php'Azerbaijan');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'BA', php'Bosnia and Herzegovina');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'BB', php'Barbados');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'BD', php'Bangladesh');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'BE', php'Belgium');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'BF', php'Burkina Faso');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'BG', php'Bulgaria');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'BH', php'Bahrain');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'BI', php'Burundi');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'BJ', php'Benin');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'BL', php'Saint Barthélemy');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'BM', php'Bermuda');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'BN', php'Brunei');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'BO', php'Bolivia');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'BQ', php'British Antarctic Territory');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'BR', php'Brazil');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'BS', php'Bahamas');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'BT', php'Bhutan');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'BV', php'Bouvet Island');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'BW', php'Botswana');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'BY', php'Belarus');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'BZ', php'Belize');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'CA', php'Canada');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'CC', php'Cocos php[Keeling] Islands');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'CD', php'Congo php- Kinshasa');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'CF', php'Central African Republic');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'CG', php'Congo php- Brazzaville');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'CH', php'Switzerland');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'CI', php'Côte d’Ivoire');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'CK', php'Cook Islands');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'CL', php'Chile');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'CM', php'Cameroon');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'CN', php'China');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'CO', php'Colombia');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'CR', php'Costa Rica');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'CS', php'Serbia and Montenegro');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'CT', php'Canton and Enderbury Islands');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'CU', php'Cuba');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'CV', php'Cape Verde');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'CX', php'Christmas Island');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'CY', php'Cyprus');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'CZ', php'Czech Republic');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'DD', php'East Germany');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'DE', php'Germany');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'DJ', php'Djibouti');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'DK', php'Denmark');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'DM', php'Dominica');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'DO', php'Dominican Republic');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'DZ', php'Algeria');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'EC', php'Ecuador');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'EE', php'Estonia');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'EG', php'Egypt');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'EH', php'Western Sahara');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'ER', php'Eritrea');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'ES', php'Spain');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'ET', php'Ethiopia');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'FI', php'Finland');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'FJ', php'Fiji');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'FK', php'Falkland Islands');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'FM', php'Micronesia');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'FO', php'Faroe Islands');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'FQ', php'French Southern and Antarctic Territories');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'FR', php'France');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'FX', php'Metropolitan France');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'GA', php'Gabon');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'GB', php'United Kingdom');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'GD', php'Grenada');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'GE', php'Georgia');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'GF', php'French Guiana');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'GG', php'Guernsey');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'GH', php'Ghana');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'GI', php'Gibraltar');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'GL', php'Greenland');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'GM', php'Gambia');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'GN', php'Guinea');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'GP', php'Guadeloupe');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'GQ', php'Equatorial Guinea');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'GR', php'Greece');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'GS', php'South Georgia and the South Sandwich Islands');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'GT', php'Guatemala');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'GU', php'Guam');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'GW', php'Guinea-Bissau');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'GY', php'Guyana');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'HK', php'Hong Kong SAR China');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'HM', php'Heard Island and McDonald Islands');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'HN', php'Honduras');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'HR', php'Croatia');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'HT', php'Haiti');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'HU', php'Hungary');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'ID', php'Indonesia');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'IE', php'Ireland');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'IL', php'Israel');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'IM', php'Isle of Man');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'IN', php'India');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'IO', php'British Indian Ocean Territory');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'IQ', php'Iraq');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'IR', php'Iran');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'IS', php'Iceland');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'IT', php'Italy');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'JE', php'Jersey');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'JM', php'Jamaica');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'JO', php'Jordan');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'JP', php'Japan');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'JT', php'Johnston Island');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'KE', php'Kenya');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'KG', php'Kyrgyzstan');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'KH', php'Cambodia');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'KI', php'Kiribati');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'KM', php'Comoros');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'KN', php'Saint Kitts and Nevis');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'KP', php'North Korea');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'KR', php'South Korea');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'KW', php'Kuwait');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'KY', php'Cayman Islands');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'KZ', php'Kazakhstan');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'LA', php'Laos');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'LB', php'Lebanon');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'LC', php'Saint Lucia');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'LI', php'Liechtenstein');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'LK', php'Sri Lanka');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'LR', php'Liberia');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'LS', php'Lesotho');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'LT', php'Lithuania');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'LU', php'Luxembourg');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'LV', php'Latvia');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'LY', php'Libya');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'MA', php'Morocco');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'MC', php'Monaco');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'MD', php'Moldova');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'ME', php'Montenegro');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'MF', php'Saint Martin');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'MG', php'Madagascar');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'MH', php'Marshall Islands');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'MI', php'Midway Islands');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'MK', php'Macedonia');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'ML', php'Mali');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'MM', php'Myanmar php[Burma]');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'MN', php'Mongolia');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'MO', php'Macau SAR China');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'MP', php'Northern Mariana Islands');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'MQ', php'Martinique');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'MR', php'Mauritania');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'MS', php'Montserrat');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'MT', php'Malta');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'MU', php'Mauritius');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'MV', php'Maldives');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'MW', php'Malawi');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'MX', php'Mexico');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'MY', php'Malaysia');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'MZ', php'Mozambique');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'NA', php'Namibia');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'NC', php'New Caledonia');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'NE', php'Niger');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'NF', php'Norfolk Island');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'NG', php'Nigeria');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'NI', php'Nicaragua');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'NL', php'Netherlands');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'NO', php'Norway');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'NP', php'Nepal');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'NQ', php'Dronning Maud Land');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'NR', php'Nauru');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'NT', php'Neutral Zone');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'NU', php'Niue');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'NZ', php'New Zealand');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'OM', php'Oman');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'PA', php'Panama');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'PC', php'Pacific Islands Trust Territory');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'PE', php'Peru');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'PF', php'French Polynesia');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'PG', php'Papua New Guinea');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'PH', php'Philippines');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'PK', php'Pakistan');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'PL', php'Poland');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'PM', php'Saint Pierre and Miquelon');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'PN', php'Pitcairn Islands');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'PR', php'Puerto Rico');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'PS', php'Palestinian Territories');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'PT', php'Portugal');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'PU', php'U.S. Miscellaneous Pacific Islands');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'PW', php'Palau');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'PY', php'Paraguay');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'PZ', php'Panama Canal Zone');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'QA', php'Qatar');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'RE', php'Réunion');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'RO', php'Romania');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'RS', php'Serbia');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'RU', php'Russia');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'RW', php'Rwanda');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'SA', php'Saudi Arabia');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'SB', php'Solomon Islands');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'SC', php'Seychelles');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'SD', php'Sudan');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'SE', php'Sweden');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'SG', php'Singapore');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'SH', php'Saint Helena');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'SI', php'Slovenia');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'SJ', php'Svalbard and Jan Mayen');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'SK', php'Slovakia');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'SL', php'Sierra Leone');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'SM', php'San Marino');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'SN', php'Senegal');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'SO', php'Somalia');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'SR', php'Suriname');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'ST', php'São Tomé and Príncipe');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'SU', php'Union of Soviet Socialist Republics');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'SV', php'El Salvador');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'SY', php'Syria');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'SZ', php'Swaziland');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'TC', php'Turks and Caicos Islands');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'TD', php'Chad');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'TF', php'French Southern Territories');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'TG', php'Togo');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'TH', php'Thailand');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'TJ', php'Tajikistan');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'TK', php'Tokelau');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'TL', php'Timor-Leste');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'TM', php'Turkmenistan');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'TN', php'Tunisia');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'TO', php'Tonga');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'TR', php'Turkey');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'TT', php'Trinidad and Tobago');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'TV', php'Tuvalu');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'TW', php'Taiwan');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'TZ', php'Tanzania');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'UA', php'Ukraine');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'UG', php'Uganda');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'UM', php'U.S. Minor Outlying Islands');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'US', php'United States');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'UY', php'Uruguay');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'UZ', php'Uzbekistan');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'VA', php'Vatican City');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'VC', php'Saint Vincent and the Grenadines');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'VD', php'North Vietnam');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'VE', php'Venezuela');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'VG', php'British Virgin Islands');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'VI', php'U.S. Virgin Islands');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'VN', php'Vietnam');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'VU', php'Vanuatu');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'WF', php'Wallis and Futuna');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'WK', php'Wake Island');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'WS', php'Samoa');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'YD', php'People\'s Democratic Republic of Yemen');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'YE', php'Yemen');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'YT', php'Mayotte');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'ZA', php'South Africa');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'ZM', php'Zambia');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'ZW', php'Zimbabwe');");
db_query("INSERT INTO php`language_choices` php( php`id`, php`abbrev`, php `country`) VALUES php(null, php'ZZ', php'Unknown or Invalid Region');");

}
echo db_error();

?>
	php		php		php		php<!--[if php!IE]>start row<![endif]-->
 php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php <div class="row"> php  php  
 php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php <div class="forms">
 php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php <!--[if php!IE]>start row<![endif]-->
 php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php <div class="row">
 php  php  php<script>

function show(divId){
document.getElementById(divId).style.display='block';

if(divId php== php"chooseform"){

document.getElementById('createform').style.display='none';


}else{
document.getElementById('chooseform').style.display='none';

}
}
</script>

 php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  
 php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php <div class="inputs" style="width:400px;">
 php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php <input type="radio" value="choose" onclick="show('chooseform');"> php<label id="pdcode-label">Choose a Language To Create</label><br php/>
	php		php		php		php		php  php 
	php		php		php		php		php<input type="radio" value="yes" name="lang_pack"> php<label id="lang_pack">Download as language pack</label><br php/>
 php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php 
 php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php </div>
 php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php </div>
	php		php		php		php  php  php</div>
	php	 php 
	php		php		php		php </div>


	php		php		php		php<!--[if php!IE]>start row<![endif]-->
 php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php <div class="row" id="chooseform" style="display:none;"> php  php  
 php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php <div class="forms">
 php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php <!--[if php!IE]>start row<![endif]-->
 php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php <div class="row">
 php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php 
 php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php <div class="inputs">
 php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php <select name="country" id="country">
<?php
$sql php= db_query("SELECT php* FROM language_choices");

while($row php= db_fetch_array($sql)){

?>
<option value="<?php echo php$row['abbrev'];?>"><?php echo php$row['country'];?></option>
<?php
}
?>
	php		php		php		php		php</select>
 php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php 
 php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php </div>
 php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php </div>
	php		php		php		php  php  php</div>
	php	 php 
	php		php		php		php </div>


	php		php		php		php<!--[if php!IE]>start row<![endif]-->
 php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php <div class="row"> php  php  
 php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php <div class="forms">
 php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php <!--[if php!IE]>start row<![endif]-->
 php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php <div class="row">

 php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php<div class="inputs" style="width:400px;">
	php		php		php		php  php<label id="pdcode-label">Or</label><br php/>


 php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php 
 php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php </div>
 php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php </div>
	php		php		php		php  php  php</div>
	php	 php 
	php		php		php		php </div>


	php		php		php		php<!--[if php!IE]>start row<![endif]-->
 php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php <div class="row"> php  php  
 php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php <div class="forms">
 php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php <!--[if php!IE]>start row<![endif]-->
 php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php <div class="row">

 php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php <div class="inputs" style="width:400px;">

	php		php		php		php	 php  php  php <input type="radio" value="create" onclick="show('createform');"> php<label id="pdcode-label">Install Language File From PAS</label>
 php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php 
 php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php </div>
 php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php </div>
	php		php		php		php  php  php</div>
	php	 php 
	php		php		php		php </div>






	php		php		php		php<!--[if php!IE]>start row<![endif]-->
 php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php <div class="row" id="createform" style="display:none;"> php  php  
 php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php <div class="forms">
 php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php <!--[if php!IE]>start row<![endif]-->
 php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php <div class="row">
 php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php 
 php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php <div class="inputs">
 php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php <select name="newlanguage" id="newlanguage">

	php		php		php		php		php</select>
 php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php <script>
	php		php		php		php		php  php  php$.get({<?php echo php$SITE_URL;?>/backendadmin/updatescript.php?q=languages',

	php		php		php		php		php	 php function(data) php{
	php		php		php		php		php	 php  php $('#newlanguage').html(data);
	php		php		php	
	php		php		php		php		php	 php  php }
	php		php		php		php		php	});
	php		php		php		php		php</script>
 php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php </div>
 php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php  php </div>
	php		php		php		php  php  php</div>
	php	 php 
	php		php		php		php </div>

	php		php		