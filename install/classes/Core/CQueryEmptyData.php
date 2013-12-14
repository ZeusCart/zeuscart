<?PHP
/**
* GNU General Public License.

* This file is part of ZeusCart V4.

* ZeusCart V4 is free software: you can redistribute it and/or modify
* it under the terms of the GNU General Public License as published by
* the Free Software Foundation, either version 4 of the License, or
* (at your option) any later version.
* 
* ZeusCart V4 is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
* GNU General Public License for more details.
* 
* You should have received a copy of the GNU General Public License
* along with Foobar. If not, see <http://www.gnu.org/licenses/>.
*
*/

/**
 * installation process the  related  class
 *
 * @package   		Core_CQuery
 * @category    	Core
 * @author    		AJ Square Inc Dev Team
 * @link   		http://www.zeuscart.com
 * @copyright 	        Copyright (c) 2008 - 2013, AJ Square, Inc.
 * @version   		Version 4.0	
 */
class Core_CQuery
{

	/**
	 * This function is used to delete and create the sql tables
	 *
	 * 
	 * 
	 * @return HTML data
	 */	
	function Core_CQuery()
	{

		$sql="DROP TABLE IF EXISTS `aboutus_table`";
		$result=mysql_query($sql);
		$sql="CREATE TABLE IF NOT EXISTS `aboutus_table` (
		`id` int(15) NOT NULL AUTO_INCREMENT,
		`content` text NOT NULL,
		PRIMARY KEY (`id`)
		) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1";
		$result=mysql_query($sql);
		$sql="INSERT INTO `aboutus_table` (`id`, `content`) VALUES
		(1, '<p>aboutus content comes here</p>\r\n');";
		$result=mysql_query($sql);

		$sql="DROP TABLE IF EXISTS `addressbook_table`";
		$result=mysql_query($sql);

		$sql="CREATE TABLE `addressbook_table` (
			`id`  INT(20) NOT NULL PRIMARY KEY AUTO_INCREMENT,
			`user_id` int(11) NOT NULL,
			`contact_name` varchar(100) NOT NULL,
			`first_name` varchar(100) NOT NULL,
			`last_name` varchar(100) NOT NULL,
			`company` varchar(500) NOT NULL,
			`email` varchar(200) NOT NULL,
			`address` varchar(500) NOT NULL,
			`city` varchar(100) NOT NULL,
			`suburb` varchar(100) NOT NULL,
			`state` varchar(100) NOT NULL,
			`country` varchar(100) NOT NULL,
			`zip` varchar(10) NOT NULL,
			`phone_no` varchar(20) NOT NULL,
			`fax` varchar(200) NOT NULL
			)";
		$result=mysql_query($sql);
		
	

		$sql="DROP TABLE IF EXISTS `admin_activity_table`";
		$result=mysql_query($sql);
		$sql="CREATE TABLE `admin_activity_table` (
		`isAdmin` int(11) NOT NULL,
		`user_id` varchar(10) NOT NULL,
		`url` varchar(400) NOT NULL,
		`visited_on` datetime NOT NULL
		)";
		$result=mysql_query($sql);
		
	
		$sql="Drop table if exists admin_settings_table";
		$result=mysql_query($sql);
		$sql="CREATE TABLE IF NOT EXISTS `admin_settings_table` (
		`set_id` int(15) NOT NULL AUTO_INCREMENT,
		`customer_header` varchar(240) NOT NULL,
		`site_logo` varchar(240) NOT NULL,
		`google_analytics` text NOT NULL,
		`time_zone` varchar(100) NOT NULL,
		`site_moto` varchar(50) NOT NULL,
		`site_skin` varchar(50) NOT NULL,
		`admin_email` varchar(200) NOT NULL,
		`meta_kerwords` text NOT NULL,
		`meta_description` text NOT NULL,
		`site_language` varchar(10) NOT NULL,	
		PRIMARY KEY (`set_id`)
		) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2";
		$result=mysql_query($sql);
		



		$sql="Drop table if exists admin_table";
		$result=mysql_query($sql);
		$sql="CREATE TABLE admin_table(admin_id  INT(20) NOT NULL PRIMARY KEY AUTO_INCREMENT,admin_name  VARCHAR(200) NOT NULL,admin_password  VARCHAR(200) NOT NULL)";
		$result=mysql_query($sql);
		


		
		$sql="Drop table if exists attribute_table";
		$result=mysql_query($sql);
		$sql="CREATE TABLE attribute_table(attrib_id  INT(15) NOT NULL PRIMARY KEY AUTO_INCREMENT,attrib_name  VARCHAR(200) NOT NULL)";
		$result=mysql_query($sql);
		



		$sql="Drop table if exists attribute_value_table";
		$result=mysql_query($sql);
		$sql="CREATE TABLE attribute_value_table(attrib_value_id  INT(20) NOT NULL PRIMARY KEY AUTO_INCREMENT,attrib_id  INT(20) NOT NULL,attrib_value  VARCHAR(100) NOT NULL)";
		$result=mysql_query($sql);
		
		


		$sql="Drop table if exists category_attrib_table";
		$result=mysql_query($sql);
		$sql="CREATE TABLE category_attrib_table(category_attrib_id  INT(15) NOT NULL PRIMARY KEY AUTO_INCREMENT,subcategory_id  INT(15) NOT NULL,attrib_id  INT(15) NOT NULL)";
		$result=mysql_query($sql);
		



		$sql="Drop table if exists category_table";
		$result=mysql_query($sql);
		$sql="CREATE TABLE IF NOT EXISTS `category_table` (
			`category_id` int(15) NOT NULL AUTO_INCREMENT,
			`category_name` varchar(200) NOT NULL,
			`category_parent_id` int(15) NOT NULL,
			`subcat_path` varchar(50) NOT NULL,
			`category_image` varchar(255) NOT NULL,
			`category_desc` varchar(500) NOT NULL,
			`category_status` int(1) NOT NULL,
			`category_content_id` int(15) NOT NULL,
			`count` int(11) NOT NULL,
			PRIMARY KEY (`category_id`)
			) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=29";
		$result=mysql_query($sql);
		
		$sql="Drop table if exists cms_table";
		$result=mysql_query($sql);
		$sql="CREATE TABLE IF NOT EXISTS `cms_table` (
		`cms_id` int(20) NOT NULL AUTO_INCREMENT,
		`cms_page_title` varchar(200) NOT NULL,
		`cms_page_alias` varchar(50) NOT NULL,
		`cms_meta_content` varchar(240) NOT NULL,
		`cms_meta_keyword` varchar(240) NOT NULL,
		`cms_page_content` text NOT NULL,
		`cms_page_status` int(20) NOT NULL,
		`cms_create_date` datetime NOT NULL,
		PRIMARY KEY (`cms_id`)
		) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ";
		$result=mysql_query($sql);
		
		$sql="Drop table if exists countrywisetax_settings_table";
		$result=mysql_query($sql);
		$sql="CREATE TABLE countrywisetax_settings_table (id int(11) NOT NULL auto_increment,tax_name varchar(200) NOT NULL,based_on_amount varchar(200) NOT NULL,country_code varchar(25) NOT NULL,based_on_address varchar(200) NOT NULL,tax_rate_percent float NOT NULL,status int(11) NOT NULL,PRIMARY KEY  (id))";
		$result=mysql_query($sql);


		$sql="Drop table if exists country_table";
		$result=mysql_query($sql);
		$sql="CREATE TABLE country_table(cou_code  VARCHAR(2) NOT NULL PRIMARY KEY,name  VARCHAR(80) NOT NULL,cou_name  VARCHAR(80) NOT NULL,iso3  VARCHAR(3) ,numcode  INT(6) )";
		$result=mysql_query($sql);
		$sql="INSERT INTO country_table VALUES ('AD', 'ANDORRA', 'Andorra', 'AND', 20),('AE', 'UNITED ARAB EMIRATES', 'United Arab Emirates', 'ARE', 784),('AF', 'AFGHANISTAN', 'Afghanistan', 'AFG', 4),('AG', 'ANTIGUA AND BARBUDA', 'Antigua and Barbuda', 'ATG', 28),('AI', 'ANGUILLA', 'Anguilla', 'AIA', 660),('AL', 'ALBANIA', 'Albania', 'ALB', 8),('AM', 'ARMENIA', 'Armenia', 'ARM', 51),('AN', 'NETHERLANDS ANTILLES', 'Netherlands Antilles', 'ANT', 530),('AO', 'ANGOLA', 'Angola', 'AGO', 24),('AQ', 'ANTARCTICA', 'Antarctica', NULL, NULL),('AR', 'ARGENTINA', 'Argentina', 'ARG', 32),('AS', 'AMERICAN SAMOA', 'American Samoa', 'ASM', 16),('AT', 'AUSTRIA', 'Austria', 'AUT', 40),('AU', 'AUSTRALIA', 'Australia', 'AUS', 36),('AW', 'ARUBA', 'Aruba', 'ABW', 533),('AZ', 'AZERBAIJAN', 'Azerbaijan', 'AZE', 31),('BA', 'BOSNIA AND HERZEGOVINA', 'Bosnia and Herzegovina', 'BIH', 70),('BB', 'BARBADOS', 'Barbados', 'BRB', 52),('BD', 'BANGLADESH', 'Bangladesh', 'BGD', 50),('BE', 'BELGIUM', 'Belgium', 'BEL', 56),('BF', 'BURKINA FASO', 'Burkina Faso', 'BFA', 854),('BG', 'BULGARIA', 'Bulgaria', 'BGR', 100),('BH', 'BAHRAIN', 'Bahrain', 'BHR', 48),('BI', 'BURUNDI', 'Burundi', 'BDI', 108),('BJ', 'BENIN', 'Benin', 'BEN', 204),('BM', 'BERMUDA', 'Bermuda', 'BMU', 60),('BN', 'BRUNEI DARUSSALAM', 'Brunei Darussalam', 'BRN', 96),('BO', 'BOLIVIA', 'Bolivia', 'BOL', 68),('BR', 'BRAZIL', 'Brazil', 'BRA', 76),('BS', 'BAHAMAS', 'Bahamas', 'BHS', 44),('BT', 'BHUTAN', 'Bhutan', 'BTN', 64),('BV', 'BOUVET ISLAND', 'Bouvet Island', NULL, NULL),('BW', 'BOTSWANA', 'Botswana', 'BWA', 72),('BY', 'BELARUS', 'Belarus', 'BLR', 112),('BZ', 'BELIZE', 'Belize', 'BLZ', 84),('CA', 'CANADA', 'Canada', 'CAN', 124),('CC', 'COCOS (KEELING) ISLANDS', 'Cocos (Keeling) Islands', NULL, NULL),('CD', 'CONGO, THE DEMOCRATIC REPUBLIC OF THE', 'Congo, the Democratic Republic of the', 'COD', 180),('CF', 'CENTRAL AFRICAN REPUBLIC', 'Central African Republic', 'CAF', 140),('CG', 'CONGO', 'Congo', 'COG', 178),('CH', 'SWITZERLAND', 'Switzerland', 'CHE', 756),('CI', 'COTE D''IVOIRE', 'Cote D''Ivoire', 'CIV', 384),('CK', 'COOK ISLANDS', 'Cook Islands', 'COK', 184),('CL', 'CHILE', 'Chile', 'CHL', 152),('CM', 'CAMEROON', 'Cameroon', 'CMR', 120),('CN', 'CHINA', 'China', 'CHN', 156),('CO', 'COLOMBIA', 'Colombia', 'COL', 170),('CR', 'COSTA RICA', 'Costa Rica', 'CRI', 188),('CS', 'SERBIA AND MONTENEGRO', 'Serbia and Montenegro', NULL, NULL),('CU', 'CUBA', 'Cuba', 'CUB', 192),('CV', 'CAPE VERDE', 'Cape Verde', 'CPV', 132),('CX', 'CHRISTMAS ISLAND', 'Christmas Island', NULL, NULL),('CY', 'CYPRUS', 'Cyprus', 'CYP', 196),('CZ', 'CZECH REPUBLIC', 'Czech Republic', 'CZE', 203),('DE', 'GERMANY', 'Germany', 'DEU', 276),('DJ', 'DJIBOUTI', 'Djibouti', 'DJI', 262),('DK', 'DENMARK', 'Denmark', 'DNK', 208),('DM', 'DOMINICA', 'Dominica', 'DMA', 212),('DO', 'DOMINICAN REPUBLIC', 'Dominican Republic', 'DOM', 214),('DZ', 'ALGERIA', 'Algeria', 'DZA', 12),('EC', 'ECUADOR', 'Ecuador', 'ECU', 218),('EE', 'ESTONIA', 'Estonia', 'EST', 233),('EG', 'EGYPT', 'Egypt', 'EGY', 818),('EH', 'WESTERN SAHARA', 'Western Sahara', 'ESH', 732),('ER', 'ERITREA', 'Eritrea', 'ERI', 232),('ES', 'SPAIN', 'Spain', 'ESP', 724),('ET', 'ETHIOPIA', 'Ethiopia', 'ETH', 231),('FI', 'FINLAND', 'Finland', 'FIN', 246),('FJ', 'FIJI', 'Fiji', 'FJI', 242),('FK', 'FALKLAND ISLANDS (MALVINAS)', 'Falkland Islands (Malvinas)', 'FLK', 238),('FM', 'MICRONESIA, FEDERATED STATES OF', 'Micronesia, Federated States of', 'FSM', 583),('FO', 'FAROE ISLANDS', 'Faroe Islands', 'FRO', 234),('FR', 'FRANCE', 'France', 'FRA', 250),('GA', 'GABON', 'Gabon', 'GAB', 266),('GB', 'UNITED KINGDOM', 'United Kingdom', 'GBR', 826),('GD', 'GRENADA', 'Grenada', 'GRD', 308),('GE', 'GEORGIA', 'Georgia', 'GEO', 268),('GF', 'FRENCH GUIANA', 'French Guiana', 'GUF', 254),('GH', 'GHANA', 'Ghana', 'GHA', 288),('GI', 'GIBRALTAR', 'Gibraltar', 'GIB', 292),('GL', 'GREENLAND', 'Greenland', 'GRL', 304),('GM', 'GAMBIA', 'Gambia', 'GMB', 270),('GN', 'GUINEA', 'Guinea', 'GIN', 324),('GP', 'GUADELOUPE', 'Guadeloupe', 'GLP', 312),('GQ', 'EQUATORIAL GUINEA', 'Equatorial Guinea', 'GNQ', 226),('GR', 'GREECE', 'Greece', 'GRC', 300),('GS', 'SOUTH GEORGIA AND THE SOUTH SANDWICH ISLANDS', 'South Georgia and the South Sandwich Islands', NULL, NULL),('GT', 'GUATEMALA', 'Guatemala', 'GTM', 320),('GU', 'GUAM', 'Guam', 'GUM', 316),('GW', 'GUINEA-BISSAU', 'Guinea-Bissau', 'GNB', 624),('GY', 'GUYANA', 'Guyana', 'GUY', 328),('HK', 'HONG KONG', 'Hong Kong', 'HKG', 344),('HM', 'HEARD ISLAND AND MCDONALD ISLANDS', 'Heard Island and Mcdonald Islands', NULL, NULL),('HN', 'HONDURAS', 'Honduras', 'HND', 340),('HR', 'CROATIA', 'Croatia', 'HRV', 191),('HT', 'HAITI', 'Haiti', 'HTI', 332),('HU', 'HUNGARY', 'Hungary', 'HUN', 348),('ID', 'INDONESIA', 'Indonesia', 'IDN', 360),('IE', 'IRELAND', 'Ireland', 'IRL', 372),('IL', 'ISRAEL', 'Israel', 'ISR', 376),('IN', 'INDIA', 'India', 'IND', 356),('IO', 'BRITISH INDIAN OCEAN TERRITORY', 'British Indian Ocean Territory', NULL, NULL),('IQ', 'IRAQ', 'Iraq', 'IRQ', 368),('IR', 'IRAN, ISLAMIC REPUBLIC OF', 'Iran, Islamic Republic of', 'IRN', 364),('IS', 'ICELAND', 'Iceland', 'ISL', 352),('IT', 'ITALY', 'Italy', 'ITA', 380),('JM', 'JAMAICA', 'Jamaica', 'JAM', 388),('JO', 'JORDAN', 'Jordan', 'JOR', 400),('JP', 'JAPAN', 'Japan', 'JPN', 392),('KE', 'KENYA', 'Kenya', 'KEN', 404),('KG', 'KYRGYZSTAN', 'Kyrgyzstan', 'KGZ', 417),('KH', 'CAMBODIA', 'Cambodia', 'KHM', 116),('KI', 'KIRIBATI', 'Kiribati', 'KIR', 296),('KM', 'COMOROS', 'Comoros', 'COM', 174),('KN', 'SAINT KITTS AND NEVIS', 'Saint Kitts and Nevis', 'KNA', 659),('KP', 'KOREA, DEMOCRATIC PEOPLE''S REPUBLIC OF', 'Korea, Democratic People''s Republic of', 'PRK', 408),('KR', 'KOREA, REPUBLIC OF', 'Korea, Republic of', 'KOR', 410),('KW', 'KUWAIT', 'Kuwait', 'KWT', 414),('KY', 'CAYMAN ISLANDS', 'Cayman Islands', 'CYM', 136),('KZ', 'KAZAKHSTAN', 'Kazakhstan', 'KAZ', 398),('LA', 'LAO PEOPLE''S DEMOCRATIC REPUBLIC', 'Lao People''s Democratic Republic', 'LAO', 418),('LB', 'LEBANON', 'Lebanon', 'LBN', 422),('LC', 'SAINT LUCIA', 'Saint Lucia', 'LCA', 662),('LI', 'LIECHTENSTEIN', 'Liechtenstein', 'LIE', 438),('LK', 'SRI LANKA', 'Sri Lanka', 'LKA', 144),('LR', 'LIBERIA', 'Liberia', 'LBR', 430),('LS', 'LESOTHO', 'Lesotho', 'LSO', 426),('LT', 'LITHUANIA', 'Lithuania', 'LTU', 440),('LU', 'LUXEMBOURG', 'Luxembourg', 'LUX', 442),('LV', 'LATVIA', 'Latvia', 'LVA', 428),('LY', 'LIBYAN ARAB JAMAHIRIYA', 'Libyan Arab Jamahiriya', 'LBY', 434),('MA', 'MOROCCO', 'Morocco', 'MAR', 504),('MC', 'MONACO', 'Monaco', 'MCO', 492),('MD', 'MOLDOVA, REPUBLIC OF', 'Moldova, Republic of', 'MDA', 498),('MG', 'MADAGASCAR', 'Madagascar', 'MDG', 450),('MH', 'MARSHALL ISLANDS', 'Marshall Islands', 'MHL', 584),('MK', 'MACEDONIA, THE FORMER YUGOSLAV REPUBLIC OF', 'Macedonia, the Former Yugoslav Republic of', 'MKD', 807),('ML', 'MALI', 'Mali', 'MLI', 466),('MM', 'MYANMAR', 'Myanmar', 'MMR', 104),('MN', 'MONGOLIA', 'Mongolia', 'MNG', 496),('MO', 'MACAO', 'Macao', 'MAC', 446),('MP', 'NORTHERN MARIANA ISLANDS', 'Northern Mariana Islands', 'MNP', 580),('MQ', 'MARTINIQUE', 'Martinique', 'MTQ', 474),('MR', 'MAURITANIA', 'Mauritania', 'MRT', 478),('MS', 'MONTSERRAT', 'Montserrat', 'MSR', 500),('MT', 'MALTA', 'Malta', 'MLT', 470),('MU', 'MAURITIUS', 'Mauritius', 'MUS', 480),('MV', 'MALDIVES', 'Maldives', 'MDV', 462),('MW', 'MALAWI', 'Malawi', 'MWI', 454),('MX', 'MEXICO', 'Mexico', 'MEX', 484),('MY', 'MALAYSIA', 'Malaysia', 'MYS', 458),('MZ', 'MOZAMBIQUE', 'Mozambique', 'MOZ', 508),('NA', 'NAMIBIA', 'Namibia', 'NAM', 516),('NC', 'NEW CALEDONIA', 'New Caledonia', 'NCL', 540),('NE', 'NIGER', 'Niger', 'NER', 562),('NF', 'NORFOLK ISLAND', 'Norfolk Island', 'NFK', 574),('NG', 'NIGERIA', 'Nigeria', 'NGA', 566),('NI', 'NICARAGUA', 'Nicaragua', 'NIC', 558),('NL', 'NETHERLANDS', 'Netherlands', 'NLD', 528),('NO', 'NORWAY', 'Norway', 'NOR', 578),('NP', 'NEPAL', 'Nepal', 'NPL', 524),('NR', 'NAURU', 'Nauru', 'NRU', 520),('NU', 'NIUE', 'Niue', 'NIU', 570),('NZ', 'NEW ZEALAND', 'New Zealand', 'NZL', 554),('OM', 'OMAN', 'Oman', 'OMN', 512),('PA', 'PANAMA', 'Panama', 'PAN', 591),('PE', 'PERU', 'Peru', 'PER', 604),('PF', 'FRENCH POLYNESIA', 'French Polynesia', 'PYF', 258),('PG', 'PAPUA NEW GUINEA', 'Papua New Guinea', 'PNG', 598),('PH', 'PHILIPPINES', 'Philippines', 'PHL', 608),('PK', 'PAKISTAN', 'Pakistan', 'PAK', 586),('PL', 'POLAND', 'Poland', 'POL', 616),('PM', 'SAINT PIERRE AND MIQUELON', 'Saint Pierre and Miquelon', 'SPM', 666),('PN', 'PITCAIRN', 'Pitcairn', 'PCN', 612),('PR', 'PUERTO RICO', 'Puerto Rico', 'PRI', 630),('PS', 'PALESTINIAN TERRITORY, OCCUPIED', 'Palestinian Territory, Occupied', NULL, NULL),('PT', 'PORTUGAL', 'Portugal', 'PRT', 620),('PW', 'PALAU', 'Palau', 'PLW', 585),('PY', 'PARAGUAY', 'Paraguay', 'PRY', 600),('QA', 'QATAR', 'Qatar', 'QAT', 634),('RE', 'REUNION', 'Reunion', 'REU', 638),('RO', 'ROMANIA', 'Romania', 'ROM', 642),('RU', 'RUSSIAN FEDERATION', 'Russian Federation', 'RUS', 643),('RW', 'RWANDA', 'Rwanda', 'RWA', 646),('SA', 'SAUDI ARABIA', 'Saudi Arabia', 'SAU', 682),('SB', 'SOLOMON ISLANDS', 'Solomon Islands', 'SLB', 90),('SC', 'SEYCHELLES', 'Seychelles', 'SYC', 690),('SD', 'SUDAN', 'Sudan', 'SDN', 736),('SE', 'SWEDEN', 'Sweden', 'SWE', 752),('SG', 'SINGAPORE', 'Singapore', 'SGP', 702),('SH', 'SAINT HELENA', 'Saint Helena', 'SHN', 654),('SI', 'SLOVENIA', 'Slovenia', 'SVN', 705),('SJ', 'SVALBARD AND JAN MAYEN', 'Svalbard and Jan Mayen', 'SJM', 744),('SK', 'SLOVAKIA', 'Slovakia', 'SVK', 703),('SL', 'SIERRA LEONE', 'Sierra Leone', 'SLE', 694),('SM', 'SAN MARINO', 'San Marino', 'SMR', 674),('SN', 'SENEGAL', 'Senegal', 'SEN', 686),('SO', 'SOMALIA', 'Somalia', 'SOM', 706),('SR', 'SURINAME', 'Suriname', 'SUR', 740),('ST', 'SAO TOME AND PRINCIPE', 'Sao Tome and Principe', 'STP', 678),('SV', 'EL SALVADOR', 'El Salvador', 'SLV', 222),('SY', 'SYRIAN ARAB REPUBLIC', 'Syrian Arab Republic', 'SYR', 760),('SZ', 'SWAZILAND', 'Swaziland', 'SWZ', 748),('TC', 'TURKS AND CAICOS ISLANDS', 'Turks and Caicos Islands', 'TCA', 796),('TD', 'CHAD', 'Chad', 'TCD', 148),('TF', 'FRENCH SOUTHERN TERRITORIES', 'French Southern Territories', NULL, NULL),('TG', 'TOGO', 'Togo', 'TGO', 768),('TH', 'THAILAND', 'Thailand', 'THA', 764),('TJ', 'TAJIKISTAN', 'Tajikistan', 'TJK', 762),('TK', 'TOKELAU', 'Tokelau', 'TKL', 772),('TL', 'TIMOR-LESTE', 'Timor-Leste', NULL, NULL),('TM', 'TURKMENISTAN', 'Turkmenistan', 'TKM', 795),('TN', 'TUNISIA', 'Tunisia', 'TUN', 788),('TO', 'TONGA', 'Tonga', 'TON', 776),('TR', 'TURKEY', 'Turkey', 'TUR', 792),('TT', 'TRINIDAD AND TOBAGO', 'Trinidad and Tobago', 'TTO', 780),('TV', 'TUVALU', 'Tuvalu', 'TUV', 798),('TW', 'TAIWAN, PROVINCE OF CHINA', 'Taiwan, Province of China', 'TWN', 158),('TZ', 'TANZANIA, UNITED REPUBLIC OF', 'Tanzania, United Republic of', 'TZA', 834),('UA', 'UKRAINE', 'Ukraine', 'UKR', 804),('UG', 'UGANDA', 'Uganda', 'UGA', 800),('UM', 'UNITED STATES MINOR OUTLYING ISLANDS', 'United States Minor Outlying Islands', NULL, NULL),('US', 'UNITED STATES', 'United States', 'USA', 840),('UY', 'URUGUAY', 'Uruguay', 'URY', 858),('UZ', 'UZBEKISTAN', 'Uzbekistan', 'UZB', 860),('VA', 'HOLY SEE (VATICAN CITY STATE)', 'Holy See (Vatican City State)', 'VAT', 336),('VC', 'SAINT VINCENT AND THE GRENADINES', 'Saint Vincent and the Grenadines', 'VCT', 670),('VE', 'VENEZUELA', 'Venezuela', 'VEN', 862),('VG', 'VIRGIN ISLANDS, BRITISH', 'Virgin Islands, British', 'VGB', 92),('VI', 'VIRGIN ISLANDS, U.S.', 'Virgin Islands, U.s.', 'VIR', 850),('VN', 'VIET NAM', 'Viet Nam', 'VNM', 704),('VU', 'VANUATU', 'Vanuatu', 'VUT', 548),('WF', 'WALLIS AND FUTUNA', 'Wallis and Futuna', 'WLF', 876),('WS', 'SAMOA', 'Samoa', 'WSM', 882),('YE', 'YEMEN', 'Yemen', 'YEM', 887),('YT', 'MAYOTTE', 'Mayotte', NULL, NULL),('ZA', 'SOUTH AFRICA', 'South Africa', 'ZAF', 710),('ZM', 'ZAMBIA', 'Zambia', 'ZMB', 894),('ZW', 'ZIMBABWE', 'Zimbabwe', 'ZWE', 716)"; 
		$result=mysql_query($sql);
		


		$sql="Drop table if exists coupon_category_table";
		$result=mysql_query($sql);
		$sql="CREATE TABLE coupon_category_table(id  INT(15) NOT NULL PRIMARY KEY AUTO_INCREMENT,coupon_code  VARCHAR(25) NOT NULL,category_id  INT(15) NOT NULL)";
		$result=mysql_query($sql);
		



		$sql="Drop table if exists coupon_user_relation_table";
		$result=mysql_query($sql);
		$sql="CREATE TABLE coupon_user_relation_table(id  INT(15) NOT NULL PRIMARY KEY AUTO_INCREMENT,coupon_code  VARCHAR(25) NOT NULL,user_id  INT(25) NOT NULL,no_of_uses  INT(11) NOT NULL)";
		$result=mysql_query($sql);


		$sql="Drop table if exists coupons_table";
		$result=mysql_query($sql);
		$sql="CREATE TABLE coupons_table(id  INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,coupon_code  VARCHAR(25) NOT NULL,coupan_name  VARCHAR(200) NOT NULL,created_date  datetime NOT NULL ,discount_amt  real NOT NULL,discount_type  VARCHAR(20) NOT NULL,valid_from  date NOT NULL ,valid_to  date NOT NULL ,min_purchase  real NOT NULL,no_of_uses  INT(11) NOT NULL,applies_to  TEXT(65535) NOT NULL ,status  INT(1) NOT NULL)";
		$result=mysql_query($sql);
		



		$sql="Drop table if exists cross_products_table";
		$result=mysql_query($sql);
		$sql="CREATE TABLE cross_products_table(product_id  INT(25) NOT NULL PRIMARY KEY,cross_product_ids  TEXT(65535) NOT NULL )";
		$result=mysql_query($sql);
		

		$sql="Drop table if exists currency_codes_table";
		$result=mysql_query($sql);
		$sql="CREATE TABLE `currency_codes_table` (
		`currency_code` varchar(10) collate utf8_general_ci NOT NULL,
		`country_name` varchar(200) collate utf8_general_ci NOT NULL,
		`currency_name` varchar(200) collate utf8_general_ci NOT NULL,
		`numeric_code` int(11) NOT NULL
		)";
		$result=mysql_query($sql);
		$sql="INSERT INTO currency_codes_table (currency_code, country_name, currency_name, numeric_code) VALUES
		('AFN', 'AFGHANISTAN', 'Afghani', 971),
		('EUR', 'ÅLAND ISLANDS', 'Euro', 978),
		('ALL', 'ALBANIA', 'Lek', 8),
		('DZD', 'ALGERIA ', 'Algerian Dinar', 12),
		('USD', 'AMERICAN SAMOA', 'US Dollar', 840),
		('EUR', 'ANDORRA', 'Euro', 978),
		('AOA', 'ANGOLA', 'Kwanza', 973),
		('XCD', 'ANGUILLA', 'East Caribbean Dollar', 951),
		('XCD', 'ANTIGUA AND BARBUDA', 'East Caribbean Dollar', 951),
		('ARS', 'ARGENTINA', 'Argentine Peso', 32),
		('AMD', 'ARMENIA', 'Armenian Dram', 51),
		('AWG', 'ARUBA', 'Aruban Guilder', 533),
		('AUD', 'AUSTRALIA', 'Australian Dollar', 36),
		('EUR', 'AUSTRIA', 'Euro', 978),
		('AZN', 'AZERBAIJAN', 'Azerbaijanian Manat', 944),
		('BSD', 'BAHAMAS', 'Bahamian Dollar', 44),
		('BHD', 'BAHRAIN', 'Bahraini Dinar', 48),
		('BDT', 'BANGLADESH', 'Taka', 50),
		('BBD', 'BARBADOS', 'Barbados Dollar', 52),
		('BYR', 'BELARUS', 'Belarussian Ruble', 974),
		('EUR', 'BELGIUM', 'Euro', 978),
		('BZD', 'BELIZE', 'Belize Dollar', 84),
		('XOF', 'BENIN', 'CFA Franc BCEAO ', 952),
		('BMD', 'BERMUDA', 'Bermudian Dollar (customarily known as Bermuda Dollar)', 60),
		('INR', 'BHUTAN', 'Indian Rupee', 356),
		('BTN', 'BHUTAN', 'Ngultrum', 64),
		('BOB', 'BOLIVIA', 'Boliviano', 68),
		('BOV', 'BOLIVIA', 'Mvdol', 984),
		('BAM', ' BOSNIA AND HERZEGOVINA', 'Convertible Marks', 977),
		('BWP', 'BOTSWANA', 'Pula', 72),
		('NOK', 'BOUVET ISLAND', 'Norwegian Krone', 578),
		('BRL', 'BRAZIL', 'Brazilian Real', 986),
		('USD', 'BRITISH INDIAN OCEAN TERRITORY', 'US Dollar', 840),
		('BND', 'BRUNEI DARUSSALAM', 'Brunei Dollar', 96),
		('BGN', 'BULGARIA', 'Bulgarian Lev', 975),
		('XOF', 'BURKINA FASO', 'CFA Franc BCEAO', 952),
		('BIF', 'BURUNDI', 'Burundi Franc', 108),
		('KHR', 'CAMBODIA', 'Riel', 116),
		('XAF', 'CAMEROON', 'CFA Franc BEAC', 950),
		('CAD', 'CANADA', 'Canadian Dollar', 124),
		('CVE', 'CAPE VERDE', 'Cape Verde Escudo', 132),
		('KYD', 'CAYMAN ISLANDS', 'Cayman Islands Dollar', 136),
		('XAF', 'CENTRAL AFRICAN REPUBLIC', 'CFA Franc BEAC', 950),
		('XAF', 'CHAD', 'CFA Franc BEAC', 950),
		('CLP', 'CHILE', 'Chilean Peso', 152),
		('CLF', 'CHILE', 'Unidades de fomento ', 990),
		('CNY', 'CHINA', 'Yuan Renminbi', 156),
		('AUD', 'CHRISTMAS ISLAND', 'Australian Dollar', 36),
		('AUD', 'COCOS (KEELING) ISLANDS', 'Australian Dollar', 36),
		('COP', 'COLOMBIA', 'Colombian Peso', 170),
		('COU', 'COLOMBIA', 'Unidad de Valor Real', 970),
		('KMF', 'COMOROS', 'Comoro Franc', 174),
		('XAF', 'CONGO', 'CFA Franc BEAC', 950),
		('CDF', 'CONGO, THE DEMOCRATIC REPUBLIC OF', 'Congolese Franc ', 976),
		('NZD', 'COOK ISLANDS', 'New Zealand Dollar', 554),
		('CRC', 'COSTA RICA', 'Costa Rican Colon', 188),
		('XOF', 'CÔTE D''IVOIRE', 'CFA Franc BCEAO', 952),
		('HRK', 'CROATIA', 'Croatian Kuna', 191),
		('CUP', 'CUBA', 'Cuban Peso', 192),
		('EUR', 'CYPRUS', 'Euro', 978),
		('CZK', 'CZECH REPUBLIC', 'Czech Koruna', 203),
		('DKK', 'DENMARK', 'Danish Krone', 208),
		('DJF', 'DJIBOUTI', 'Djibouti Franc', 262),
		('XCD', 'DOMINICA', 'East Caribbean Dollar', 951),
		('DOP', 'DOMINICAN REPUBLIC', 'Dominican Peso', 214),
		('USD', 'ECUADOR', 'US Dollar', 840),
		('EGP', 'EGYPT', 'Egyptian Pound', 818),
		('SVC', 'EL SALVADOR', 'El Salvador Colon', 222),
		('USD', 'EL SALVADOR', 'US Dollar', 840),
		('XAF', 'EQUATORIAL GUINEA', 'CFA Franc BEAC', 950),
		('ERN', 'ERITREA', 'Nakfa', 232),
		('EEK', 'ESTONIA', 'Kroon', 233),
		('ETB', 'ETHIOPIA', 'Ethiopian Birr', 230),
		('FKP', 'FALKLAND ISLANDS (MALVINAS)', 'Falkland Islands Pound', 238),
		('DKK', 'FAROE ISLANDS', 'Danish Krone', 208),
		('FJD', 'FIJI', 'Fiji Dollar', 242),
		('EUR', 'FINLAND', 'Euro', 978),
		('EUR', 'FRANCE', 'Euro', 978),
		('EUR', 'FRENCH GUIANA', 'Euro', 978),
		('XPF', 'FRENCH POLYNESIA', 'CFP Franc', 953),
		('EUR', 'FRENCH SOUTHERN TERRITORIES', 'Euro', 978),
		('XAF', 'GABON', 'CFA Franc BEAC', 950),
		('GMD', 'GAMBIA', 'Dalasi', 270),
		('GEL', 'GEORGIA', 'Lari', 981),
		('EUR', 'GERMANY', 'Euro', 978),
		('GHS', 'GHANA', 'Cedi', 936),
		('GIP', 'GIBRALTAR', 'Gibraltar Pound', 292),
		('EUR', 'GREECE', 'Euro', 978),
		('DKK', 'GREENLAND', 'Danish Krone', 208),
		('XCD', 'GRENADA', 'East Caribbean Dollar', 951),
		('EUR', 'GUADELOUPE', 'Euro', 978),
		('USD', 'GUAM', 'US Dollar', 840),
		('GTQ', 'GUATEMALA', 'Quetzal', 320),
		('GBP', 'GUERNSEY', 'Pound Sterling', 826),
		('GNF', 'GUINEA', 'Guinea Franc', 324),
		('GWP', 'GUINEA-BISSAU', 'Guinea-Bissau Peso', 624),
		('XOF', 'GUINEA-BISSAU', 'CFA Franc BCEAO', 952),
		('GYD', 'GUYANA', 'Guyana Dollar', 328),
		('HTG', 'HAITI', 'Gourde', 332),
		('USD', 'HAITI', 'US Dollar', 840),
		('AUD', 'HEARD ISLAND AND MCDONALD ISLANDS', 'Australian Dollar', 36),
		('EUR', 'HOLY SEE (VATICAN CITY STATE)', 'Euro', 978),
		('HNL', 'HONDURAS', 'Lempira ', 340),
		('HKD', 'HONG KONG', 'Hong Kong Dollar', 344),
		('HUF', 'HUNGARY', 'Forint', 348),
		('ISK', 'ICELAND', 'Iceland Krona', 352),
		('INR', 'INDIA', 'Indian Rupee', 356),
		('IDR', 'INDONESIA', 'Rupiah', 360),
		('IRR', 'IRAN, ISLAMIC REPUBLIC OF', 'Iranian Rial', 364),
		('IQD', 'IRAQ', 'Iraqi Dinar', 368),
		('EUR', 'IRELAND', 'Euro', 978),
		('ILS', 'ISRAEL', 'New Israeli Sheqel', 376),
		('EUR', 'ITALY', 'Euro', 978),
		('JMD', 'JAMAICA', 'Jamaican Dollar', 388),
		('JPY', 'JAPAN', 'Yen', 392),
		('GBP', 'JERSEY', 'Pound Sterling', 826),
		('JOD', 'JORDAN', 'Jordanian Dinar', 400),
		('KZT', 'KAZAKHSTAN', 'Tenge', 398),
		('KES', 'KENYA', 'Kenyan Shilling', 404),
		('AUD', 'KIRIBATI', 'Australian Dollar', 36),
		('KPW', 'KOREA, DEMOCRATIC PEOPLE''S REPUBLIC OF', 'North Korean Won', 408),
		('KRW', 'KOREA, REPUBLIC OF', 'Won', 410),
		('KWD', 'KUWAIT', 'Kuwaiti Dinar', 414),
		('KGS', 'KYRGYZSTAN', 'Som', 417),
		('LAK', 'LAO PEOPLE''S DEMOCRATIC REPUBLIC', 'Kip', 418),
		('LVL', 'LATVIA', 'Latvian Lats', 428),
		('LBP', 'LEBANON', 'Lebanese Pound', 422),
		('ZAR', 'LESOTHO', 'Rand', 710),
		('LSL', 'LESOTHO', 'Loti', 426),
		('LRD', 'LIBERIA', 'Liberian Dollar', 430),
		('LYD', 'LIBYAN ARAB JAMAHIRIYA', 'Libyan Dinar', 434),
		('CHF', 'LIECHTENSTEIN', 'Swiss Franc', 756),
		('LTL', 'LITHUANIA', 'Lithuanian Litas', 440),
		('EUR', 'LUXEMBOURG', 'Euro', 978),
		('MOP', 'MACAO', 'Pataca', 446),
		('MKD', 'MACEDONIA, THE FORMER YUGOSLAV REPUBLIC OF', 'Denar', 807),
		('MGA', 'MADAGASCAR', 'Malagasy Ariary', 969),
		('MWK', 'MALAWI', 'Kwacha', 454),
		('MYR', 'MALAYSIA', 'Malaysian Ringgit', 458),
		('MVR', 'MALDIVES', 'Rufiyaa', 462),
		('XOF', 'MALI', 'CFA Franc BCEAO', 952),
		('EUR', 'MALTA', 'Euro', 978),
		('USD', 'MARSHALL ISLANDS', 'US Dollar', 840),
		('EUR', 'MARTINIQUE', 'Euro', 978),
		('MRO', 'MAURITAN IA', 'Ouguiya', 478),
		('MUR', 'MAURITIUS', 'Mauritius Rupee', 480),
		('EUR', 'MAYOTTE', 'Euro', 978),
		('MXN', 'MEXICO', 'Mexican Peso', 484),
		('MXV', 'MEXICO', 'Mexican Unidad de Inversion (UDI)', 979),
		('USD', 'MICRONESIA, FEDERATED STATES OF', 'US Dollar', 840),
		('MDL', 'MOLDOVA, REPUBLIC OF', 'Moldovan Leu', 498),
		('EUR', 'MONACO', 'Euro', 978),
		('MNT', 'MONGOLIA', 'Tugrik', 496),
		('EUR', 'MONTENEGRO', 'Euro', 978),
		('XCD', 'MONTSERRAT', 'East Caribbean Dollar', 951),
		('MAD', 'MOROCCO', 'Moroccan Dirham', 504),
		('MZN', 'MOZAMBIQUE', 'Metical ', 943),
		('MMK', 'MYANMAR', 'Kyat', 104),
		('ZAR', 'NAMIBIA', 'Rand', 710),
		('NAD', 'NAMIBIA', 'Namibia Dollar', 516),
		('AUD', 'NAURU', 'Australian Dollar', 36),
		('NPR', 'NEPAL', 'Nepalese Rupee', 524),
		('EUR', 'NETHERLANDS', 'Euro', 978),
		('ANG', 'NETHERLANDS ANTILLES', 'Netherlands Antillian Guilder', 532),
		('XPF', 'NEW CALEDONIA', 'CFP Franc', 953),
		('NZD', 'NEW ZEALAND', 'New Zealand Dollar', 554),
		('NIO', 'NICARAGUA', 'Cordoba Oro', 558),
		('XOF', 'NIGER', 'CFA Franc BCEAO', 952),
		('NGN', 'NIGERIA', 'Naira', 566),
		('NZD', 'NIUE', 'New Zealand Dollar', 554),
		('AUD', 'NORFOLK ISLAND', 'Australian Dollar', 36),
		('USD', 'NORTHERN MARIANA ISLANDS', 'US Dollar', 840),
		('NOK', 'NORWAY', 'Norwegian Krone', 578),
		('OMR', 'OMAN', 'Rial Omani', 512),
		('PKR', 'PAKISTAN', 'Pakistan Rupee', 586),
		('USD', 'PALAU', 'US Dollar', 840),
		('PAB', 'PANAMA', 'Balboa', 590),
		('USD', 'PANAMA', 'US Dollar', 840),
		('PGK', 'PAPUA NEW GUINEA', 'Kina', 598),
		('PYG', 'PARAGUAY', 'Guarani', 600),
		('PEN', 'PERU', 'Nuevo Sol', 604),
		('PHP', 'PHILIPPINES', 'Philippine Peso', 608),
		('NZD', 'PITCAIRN', 'New Zealand Dollar', 554),
		('PLN', 'POLAND', 'Zloty', 985),
		('EUR', 'PORTUGAL', 'Euro', 978),
		('USD', 'PUERTO RICO', 'US Dollar', 840),
		('QAR', 'QATAR', 'Qatari Rial', 634),
		('EUR', 'RÉUNION', 'Euro', 978),
		('RON', 'ROMANIA', 'New Leu', 946),
		('RUB', 'RUSSIAN FEDERATION', 'Russian Ruble', 643),
		('RWF', 'RWANDA', 'Rwanda Franc', 646),
		('EUR', 'SAINT-BARTHÉLEMY', 'Euro', 978),
		('SHP', 'SAINT HELENA', 'Saint Helena Pound', 654),
		('XCD', 'SAINT KITTS AND NEVIS', 'East Caribbean Dollar', 951),
		('XCD', 'SAINT LUCIA', 'East Caribbean Dollar', 951),
		('EUR', 'SAINT MARTIN', 'Euro', 978),
		('EUR', 'SAINT PIERRE AND MIQUELON', 'Euro', 978),
		('XCD', 'SAINT VINCENT AND THE GRENADINES', 'East Caribbean Dollar', 951),
		('WST', 'SAMOA', 'Tala', 882),
		('EUR', 'SAN MARINO', 'Euro', 978),
		('STD', 'SÃO TOME AND PRINCIPE', 'Dobra', 678),
		('SAR', 'SAUDI ARABIA', 'Saudi Riyal', 682),
		('XOF', 'SENEGAL', 'CFA Franc BCEAO', 952),
		('RSD', 'SERBIA', 'Serbian Dinar', 941),
		('SCR', 'SEYCHELLES', 'Seychelles Rupee', 690),
		('SLL', 'SIERRA LEONE', 'Leone', 694),
		('SGD', 'SINGAPORE', 'Singapore Dollar', 702),
		('SKK', 'SLOVAKIA', 'Slovak Koruna', 703),
		('EUR', 'SLOVAKIA', 'Euro (effective 1 January 2009)', 978),
		('EUR', 'SLOVENIA', 'Euro', 978),
		('SBD', 'SOLOMON ISLANDS', 'Solomon Islands Dollar', 90),
		('SOS', 'SOMALIA', 'Somali Shilling', 706),
		('ZAR', 'SOUTH AFRICA', 'Rand', 710),
		('EUR', 'SPAIN', 'Euro', 978),
		('LKR', 'SRI LANKA', 'Sri Lanka Rupee', 144),
		('SDG', 'SUDAN', 'Sudanese Pound', 938),
		('SRD', 'SURINAME', 'Surinam Dollar', 968),
		('NOK', 'SVALBARD AND JAN MAYEN', 'Norwegian Krone', 578),
		('SZL', 'SWAZILAND', 'Lilangeni', 748),
		('SEK', 'SWEDEN', 'Swedish Krona', 752),
		('CHF', 'SWITZERLAND', 'Swiss Franc', 756),
		('CHW', 'SWITZERLAND', 'WIR Franc', 948),
		('CHE', 'SWITZERLAND', 'WIR Euro', 947),
		('SYP', 'SYRIAN ARAB REPUBLIC', 'Syrian Pound', 760),
		('TWD', 'TAIWAN, PROVINCE OF CHINA', 'New Taiwan Dollar', 901),
		('TJS', 'TAJIKISTAN', 'Somoni', 972),
		('TZS', 'TANZANIA, UNITED REPUBLIC OF', 'Tanzanian Shilling', 834),
		('THB', 'THAILAND', 'Baht', 764),
		('USD', 'TIMOR-LESTE', 'US Dollar', 840),
		('XOF', 'TOGO', 'CFA Franc BCEAO', 952),
		('NZD', 'TOKELAU', 'New Zealand Dollar', 554),
		('TOP', 'TONGA', 'Pa''anga', 776),
		('TTD', 'TRINIDAD AND TOBAGO', 'Trinidad and Tobago Dollar', 780),
		('TND', 'TUNISIA', 'Tunisian Dinar', 788),
		('TRY', 'TURKEY', 'Turkish Lira', 949),
		('TMM', 'TURKMENISTAN', 'Manat', 795),
		('USD', 'TURKS AND CAICOS ISLANDS', 'US Dollar', 840),
		('AUD', 'TUVALU', 'Australian Dollar', 36),
		('UGX', 'UGANDA', 'Uganda Shilling', 800),
		('UAH', 'UKRAINE', 'Hryvnia', 980),
		('AED', 'UNITED ARAB EMIRATES', 'UAE Dirham', 784),
		('GBP', 'UNITED KINGDOM', 'Pound Sterling', 826),
		('USD', 'UNITED STATES', 'US Dollar', 840),
		('USS', 'UNITED STATES', 'US Dollar (Same day)', 998),
		('USN', 'UNITED STATES', 'S Dollar (Next day)', 997),
		('USD', 'UNITED STATES MINOR OUTLYING ISLANDS', 'US Dollar', 840),
		('UYU', 'URUGUAY', 'Peso Uruguayo', 858),
		('UYI', 'URUGUAY', 'Uruguay Peso en Unidades Indexadas', 940),
		('UZS', 'UZBEKISTAN', 'Uzbekistan Sum', 860),
		('VUV', 'VANUATU', 'Vatu', 548),
		('VEF', 'VENEZUELA', 'Bolivar Fuerte ', 937),
		('VND', 'VIET NAM', 'Dong', 704),
		('USD ', 'VIRGIN ISLANDS (BRITISH)', 'US Dollar', 840),
		('USD', 'VIRGIN ISLANDS (U.S.)', 'US Dollar', 840),
		('XPF', 'WALLIS AND FUTUNA', 'CFP Franc', 953),
		('MAD', 'WESTERN SAHARA', 'Moroccan Dirham', 504),
		('YER', 'YEMEN', 'Yemeni Rial', 886),
		('ZMK', 'ZAMBIA', 'Zambian Kwacha', 894),
		('ZWR', 'ZIMBABWE', 'Zimbabwe Dollar', 935),
		('XAU', ' ', 'Gold', 959),
		('XBA', ' ', 'Bond Markets Units European Composite Unit (EURCO)', 955),
		('XBB', ' ', 'European Monetary Unit (E.M.U.-6) ', 956),
		('XBC', ' ', 'European Unit of Account 9(E.U.A.-9)', 957),
		('XBD', ' ', 'European Unit of Account 17(E.U.A.-17)', 958),
		('XDR', 'INTERNATIONAL MONETARY FUND (I.M.F) ', 'SDR', 960),
		('XPD', ' ', 'Palladium', 964),
		('XPT', ' ', 'Platinum', 962),
		('XAG', ' ', 'Silver', 961),
		('XFU', ' ', 'UIC-Franc', 0),
		('XTS', ' ', 'Codes specifically reserved for testing purposes', 963),
		('XXX', ' ', 'The codes assigned for transactions where no currency is involved are:', 999)";
		$result=mysql_query($sql);


		$sql="Drop table if exists currency_master_table";
		$result=mysql_query($sql);
		$sql="CREATE TABLE IF NOT EXISTS `currency_master_table` (
		`id` int(11) NOT NULL AUTO_INCREMENT,
		`currency_name` varchar(200) NOT NULL,
		`currency_code` varchar(50) NOT NULL,
		`currency_tocken` varchar(25) NOT NULL,
		`status` int(11) NOT NULL,
		`default_currency` int(11) NOT NULL DEFAULT '0',
		PRIMARY KEY (`id`)
		)";
		$result=mysql_query($sql);

		$sql="Drop table if exists custompage_table";
		$result=mysql_query($sql);
		$sql="CREATE TABLE custompage_table(page_id  INT(20) NOT NULL PRIMARY KEY AUTO_INCREMENT,page_name  VARCHAR(100) NOT NULL,page_url  VARCHAR(200) NOT NULL,status  INT(1) NOT NULL)";
		$result=mysql_query($sql);
		



		$sql="Drop table if exists faq_table";
		$result=mysql_query($sql);
		$sql="CREATE TABLE faq_table(faq_id  INT(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,faq_qn  TEXT(65535) NOT NULL ,faq_ans  TEXT(65535) NOT NULL )";
		$result=mysql_query($sql);

		



		$sql="Drop table if exists footer_settings_table";
		$result=mysql_query($sql);
		$sql="CREATE TABLE IF NOT EXISTS `footer_settings_table` (
		  `id` int(10) NOT NULL AUTO_INCREMENT,
		  `callus` int(50) NOT NULL,
		  `email` varchar(255) NOT NULL,
		  `fax` int(50) NOT NULL,
		  `location` varchar(100) NOT NULL,
		  `footercontent` text NOT NULL,
		  `free_shipping_cost` double NOT NULL,
		  PRIMARY KEY (`id`)
		)";	
		$result=mysql_query($sql);
		


		$sql="Drop table if exists gift_voucher_table";
		$result=mysql_query($sql);
		$sql="CREATE TABLE gift_voucher_table (
		id int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
		cart_id int(20) NOT NULL,
		order_id int(11) NOT NULL,
		gift_product_id int(50) NOT NULL,
		recipient_name varchar(100) NOT NULL,
		recipient_email varchar(100) NOT NULL,
		name varchar(100) NOT NULL,
		email varchar(100) NOT NULL,
		certificate_theme varchar(100) NOT NULL,
		message TEXT(65535) NOT NULL,
		gift_code TEXT(65535) NOT NULL) ";
		$result=mysql_query($sql);


		$sql="Drop table if exists home_page_ads_table";
		$result=mysql_query($sql);
		$sql="CREATE TABLE IF NOT EXISTS `home_page_ads_table` (
		`home_page_ads_id` int(15) NOT NULL AUTO_INCREMENT,
		`home_page_ads_title` varchar(200) NOT NULL,
		`home_page_ads_logo` varchar(200) NOT NULL,
		`home_page_ads_url` varchar(200) NOT NULL,
		`status` int(15) NOT NULL,
		PRIMARY KEY (`home_page_ads_id`)
		)";
		$result=mysql_query($sql);
		
	
		$sql="Drop table if exists home_page_content_table";
		$result=mysql_query($sql);
		$sql="CREATE TABLE IF NOT EXISTS `home_page_content_table` (
		`id` int(11) NOT NULL,
		`home_page_content` text NOT NULL,
		`status` int(10) NOT NULL COMMENT '0=>active,1=>suspend'
		)";
		$result=mysql_query($sql);
		$sql="INSERT INTO `home_page_content_table` (`id`, `home_page_content`, `status`) VALUES
		(1, '<h2>About BEAUTY Shop</h2><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit...</p><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit...</p>', 1);";
		$result=mysql_query($sql);



		$sql="Drop table if exists home_slide_parameter_table";
		$result=mysql_query($sql);
		$sql="CREATE TABLE home_slide_parameter_table(id INT(20) NOT NULL PRIMARY KEY AUTO_INCREMENT,module_name VARCHAR(255) NOT NULL,parameter TEXT(65535) NOT NULL)";
		$result=mysql_query($sql);



		$sql="Drop table if exists home_slide_show_table";
		$result=mysql_query($sql);
		$sql="CREATE TABLE home_slide_show_table(id INT(20) NOT NULL PRIMARY KEY AUTO_INCREMENT,slide_title VARCHAR(240) NOT NULL,slide_content TEXT(65535) NOT NULL ,slide_content_thumb VARCHAR(240) NOT NULL,slide_caption TEXT(65535) NOT NULL,slide_url VARCHAR(240) NOT NULL	)";
		$result=mysql_query($sql);
		$sql="INSERT INTO `home_slide_show_table` (`id`, `slide_title`, `slide_content`, `slide_content_thumb`, `slide_caption`, `slide_url`) VALUES
		(1, 'slide1', 'images/b3.jpg', 'images/b3_thumb.jpg', 'zeuscart1', 'http://www.google.co.in/'),
		(2, 'slide2', 'images/b1.jpg', 'images/b3_thumb.jpg', 'zeuscart2', 'http://www.google.co.in/'),
		(3, 'slide3', 'images/b2.jpg', 'images/b2_thumb.jpg', 'zeuscart3', 'http://www.google.co.in/')";
		$result=mysql_query($sql);




		$sql="Drop table if exists invoice_table";
		$result=mysql_query($sql);
		$sql="CREATE TABLE IF NOT EXISTS `invoice_table` (
		`id` int(15) NOT NULL AUTO_INCREMENT,
		`order_id` int(15) NOT NULL,
		`invoice_name` varchar(50) NOT NULL,
		`invoice_path` varchar(200) NOT NULL,
		`invoice_upload_date` datetime NOT NULL,
		PRIMARY KEY (`id`)
		)";
		$result=mysql_query($sql);

		$sql="Drop table if exists language";
		$result=mysql_query($sql);
		$sql="CREATE TABLE IF NOT EXISTS `language` (
		  `lang_id` int(11) NOT NULL AUTO_INCREMENT,
		  `lang_name` varchar(255) CHARACTER SET utf8 NOT NULL,
		  `lang_code` varchar(10) CHARACTER SET utf8 NOT NULL,
		  PRIMARY KEY (`lang_id`),
		  KEY `lang_name` (`lang_name`,`lang_code`)
		) ";
		$result=mysql_query($sql);
		$sql="INSERT INTO `language` (`lang_id`, `lang_name`, `lang_code`) VALUES
		(1, 'English', 'en'),
		(2, 'Chinese', 'cn')";
		$result=mysql_query($sql);

			
		$sql="Drop table if exists live_chat_table";
		$result=mysql_query($sql);
		$sql="CREATE TABLE IF NOT EXISTS `live_chat_table` (
		`id` int(10) NOT NULL AUTO_INCREMENT,
		`live_chat_script` text NOT NULL,
		`live_chat_status` int(10) NOT NULL COMMENT '0=>on,1=>off',
		PRIMARY KEY (`id`)
		) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1";
		$result=mysql_query($sql);
		$sql="INSERT INTO `live_chat_table` (`id`, `live_chat_script`, `live_chat_status`) VALUES
		(1, '', 1)";
		$result=mysql_query($sql);
		
		
		$sql="Drop table if exists mail_messages_table";
		$result=mysql_query($sql);
		$sql="CREATE TABLE mail_messages_table(mail_msg_id  INT(20) NOT NULL PRIMARY KEY AUTO_INCREMENT,mail_msg_subject  VARCHAR(300) NOT NULL,mail_msg  TEXT(65535) )";
		$result=mysql_query($sql);


		$sql="Drop table if exists msrp_by_quantity_table";
		$result=mysql_query($sql);
		$sql="CREATE TABLE msrp_by_quantity_table(id  INT(25) NOT NULL PRIMARY KEY AUTO_INCREMENT,product_id  INT(25) NOT NULL,quantity  INT(10) NOT NULL,msrp  real NOT NULL)";
		$result=mysql_query($sql);


		$sql="Drop table if exists newsletter_subscription_table";
		$result=mysql_query($sql);
		$sql="CREATE TABLE newsletter_subscription_table(subsciption_id  INT(20) NOT NULL PRIMARY KEY AUTO_INCREMENT,email  VARCHAR(300) NOT NULL,status  INT(1) NOT NULL)";
		$result=mysql_query($sql);
		

		$sql="Drop table if exists newsletter_table";
		$result=mysql_query($sql);
		$sql="CREATE TABLE newsletter_table(newsletter_id  INT(20) NOT NULL PRIMARY KEY AUTO_INCREMENT,newsletter_title  TEXT(65535) NOT NULL ,newsletter_content  TEXT(65535) NOT NULL ,newsletter_date_added  datetime NOT NULL ,newsletter_date_sent  datetime NOT NULL ,newsletter_status  INT(4) NOT NULL)";
		$result=mysql_query($sql);


		$sql="Drop table if exists news_table";
		$result=mysql_query($sql);
		$sql="CREATE TABLE `news_table` (`news_id` int(11) NOT NULL auto_increment,`news_title` varchar(100) default NULL,
		`news_desc` text,`news_date` date default NULL,`news_status` tinyint(2) default NULL,PRIMARY KEY  (`news_id`))";
		$result=mysql_query($sql);


		$sql="Drop table if exists order_products_table";
		$result=mysql_query($sql);
		$sql="CREATE TABLE order_products_table(order_id  INT(25) NOT NULL,product_id  INT(25) NOT NULL,variation_id INT(25) NOT NULL,product_qty  INT(10) NOT NULL,product_unit_price  real NOT NULL,shipping_cost  real NOT NULL)";
		$result=mysql_query($sql);
		



		$sql="Drop table if exists orders_status_table";
		$result=mysql_query($sql);
		$sql="CREATE TABLE orders_status_table(orders_status_id  INT(20) NOT NULL PRIMARY KEY AUTO_INCREMENT,orders_status_name  VARCHAR(100) NOT NULL)";
		$result=mysql_query($sql);
		


		$sql="Drop table if exists orders_table";
		$result=mysql_query($sql);
		$sql="CREATE TABLE orders_table(orders_id  INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,customers_id  INT(11) NOT NULL,shipping_name  VARCHAR(64) NOT NULL,shipping_company  VARCHAR(32) ,shipping_street_address  VARCHAR(64) NOT NULL,shipping_suburb  VARCHAR(32) ,shipping_city  VARCHAR(32) NOT NULL,shipping_postcode  VARCHAR(10) NOT NULL,shipping_state  VARCHAR(32) ,shipping_country  VARCHAR(32) NOT NULL,billing_name  VARCHAR(64) NOT NULL,billing_company  VARCHAR(32) ,billing_street_address  VARCHAR(64) NOT NULL,billing_suburb  VARCHAR(32) ,billing_city  VARCHAR(32) NOT NULL,billing_postcode  VARCHAR(10) NOT NULL,billing_state  VARCHAR(32) ,billing_country  VARCHAR(32) NOT NULL,payment_method  VARCHAR(128) NOT NULL,shipping_method  VARCHAR(128) NOT NULL,coupon_code  VARCHAR(32) NOT NULL,date_purchased  datetime  ,orders_date_closed  datetime ,orders_status  INT(5) NOT NULL ,order_total  real ,order_tax  real ,order_ship real,`currency_id` int(20) NOT NULL default '1',ipn_id  INT(11) NOT NULL DEFAULT '0',ip_address  VARCHAR(96) NOT NULL,shipment_id_selected  INT(11) NOT NULL,shipment_track_id  VARCHAR(200) NOT NULL)";
		$result=mysql_query($sql);
		


		$sql="Drop table if exists order_history_table";
		$result=mysql_query($sql);
		$sql="CREATE TABLE IF NOT EXISTS `order_history_table` (
		`id` int(15) NOT NULL AUTO_INCREMENT,
		`order_id` int(15) NOT NULL,
		`order_history` text NOT NULL,
		`order_history_time` datetime NOT NULL,
		PRIMARY KEY (`id`)
		)";
		$result=mysql_query($sql);



		$sql="Drop table if exists pages_action_table";
		$result=mysql_query($sql);
		$sql="CREATE TABLE pages_action_table(page_id  INT(20) NOT NULL PRIMARY KEY AUTO_INCREMENT,page_name  VARCHAR(200) NOT NULL,page_action  VARCHAR(200) NOT NULL,page_description  VARCHAR(200) NOT NULL)";
		$result=mysql_query($sql);

	




		$sql="Drop table if exists payment_transactions_table";
		$result=mysql_query($sql);
		$sql="CREATE TABLE payment_transactions_table(pay_id  INT(12) NOT NULL PRIMARY KEY AUTO_INCREMENT,payment_gateway_id  INT(3) NOT NULL,paid_amount  real NOT NULL,transaction_id  VARCHAR(200) NOT NULL,transaction_date  datetime NOT NULL ,order_id  INT(11) NOT NULL)";
		$result=mysql_query($sql);


		$sql="Drop table if exists paymentgateways_table";
		$result=mysql_query($sql);
		$sql="CREATE TABLE paymentgateways_table(gateway_id  INT(3) NOT NULL PRIMARY KEY AUTO_INCREMENT,gateway_name  VARCHAR(200) NOT NULL,merchant_id  VARCHAR(100) NOT NULL,gateway_status  INT(1) NOT NULL,images  VARCHAR(200) NOT NULL)";
		$result=mysql_query($sql);
		


		


		$sql="Drop table if exists paymentgateways_settings_table";
		$result=mysql_query($sql);
		$sql="CREATE TABLE `paymentgateways_settings_table` (`pg_setting_id` int(9) NOT NULL PRIMARY KEY AUTO_INCREMENT,`gateway_id` int(5) NOT NULL,`setting_name` varchar(300) NOT NULL,`setting_values` varchar(200) NOT NULL,`help_text` text NOT NULL)";
		$result=mysql_query($sql);
		


		$sql="Drop table if exists paypal_payment_status_table";
		$result=mysql_query($sql);
		$sql="CREATE TABLE paypal_payment_status_table(payment_status_id  INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,payment_status_name  VARCHAR(64) NOT NULL)";
		$result=mysql_query($sql);

		$sql="Drop table if exists polling_process_table";
		$result=mysql_query($sql);
		$sql="CREATE TABLE polling_process_table (
		id int(11) NOT NULL,
		poll_question_id int(11) NOT NULL,
		user_id int(11) NOT NULL,
		polling_date datetime NOT NULL,
		ip_address varchar(50) NOT NULL
		)";
		$result=mysql_query($sql);

		$sql="Drop table if exists poll_options_table";
		$result=mysql_query($sql);
		$sql="CREATE TABLE poll_options_table (
		option_id int(11) NOT NULL auto_increment,
		ques_id int(11) NOT NULL,
		options varchar(100) NOT NULL,
		option_votes int(11) NOT NULL,
		PRIMARY KEY  (option_id)
		)";
		$result=mysql_query($sql);

		$sql="Drop table if exists poll_questions_table";
		$result=mysql_query($sql);
		$sql="CREATE TABLE poll_questions_table (
		ques_id int(11) NOT NULL auto_increment,
		question varchar(200) NULL,
		ques_status tinyint(2) default NULL,
		PRIMARY KEY  (ques_id)
		)";
		$result=mysql_query($sql);

		$sql="Drop table if exists privacypolicy_table";
		$result=mysql_query($sql);
		$sql="CREATE TABLE privacypolicy_table(id  INT(4) NOT NULL PRIMARY KEY AUTO_INCREMENT,privacypolicy  TEXT(65535) NOT NULL )";
		$result=mysql_query($sql);
		

		$sql="Drop table if exists product_attrib_values_table";
		$result=mysql_query($sql);
		$sql="CREATE TABLE product_attrib_values_table(product_attrib_value_id  INT(15) NOT NULL PRIMARY KEY AUTO_INCREMENT,product_id  INT(15) NOT NULL,attrib_value_id  INT(15) NOT NULL)";
		$result=mysql_query($sql);


		$sql="Drop table if exists product_images_table";
		$result=mysql_query($sql);
		$sql="CREATE TABLE product_images_table(product_images_id  INT(20) NOT NULL PRIMARY KEY AUTO_INCREMENT,product_id  INT(20) NOT NULL,image_path  VARCHAR(200) NOT NULL,large_image_path VARCHAR(200) NOT NULL,thumb_image_path  VARCHAR(200) NOT NULL,type  VARCHAR(40) NOT NULL)";
		$result=mysql_query($sql);
		


		$sql="Drop table if exists product_inventory_table";
		$result=mysql_query($sql);
		$sql="CREATE TABLE product_inventory_table(inventory_id  INT(20) NOT NULL PRIMARY KEY AUTO_INCREMENT,product_id  INT(20) NOT NULL,rol  INT(15) NOT NULL,soh  INT(20) NOT NULL)";
		$result=mysql_query($sql);
		


		$sql="Drop table if exists product_reviews_table";
		$result=mysql_query($sql);
		$sql="CREATE TABLE product_reviews_table(review_id  INT(20) NOT NULL PRIMARY KEY AUTO_INCREMENT,product_id  INT(20) NOT NULL,user_id  INT(20) NOT NULL,review_caption  VARCHAR(300) NOT NULL,review_txt  TEXT(65535) NOT NULL ,review_date  date NOT NULL ,rating  INT(5) NOT NULL,review_status  INT(1) NOT NULL)";
		$result=mysql_query($sql);
		



		$sql="Drop table if exists products_table";
		$result=mysql_query($sql);
		$sql="CREATE TABLE IF NOT EXISTS `products_table` (
		`product_id` int(25) NOT NULL AUTO_INCREMENT,
		`category_id` varchar(100) CHARACTER SET utf8 NOT NULL,
		`sku` varchar(100) NOT NULL,
		`title` varchar(250) NOT NULL,
		`alias` varchar(100) NOT NULL,
		`description` text NOT NULL,
		`brand` varchar(100) NOT NULL,
		`model` varchar(50) NOT NULL,
		`msrp` double NOT NULL,
		`price` double NOT NULL,
		`cse_enabled` int(1) NOT NULL,
		`cse_key` varchar(100) DEFAULT NULL,
		`weight` varchar(25) NOT NULL,
		`dimension` varchar(100) NOT NULL,
		`thumb_image` varchar(150) NOT NULL,
		`image` varchar(150) NOT NULL,
		`large_image_path` varchar(150) NOT NULL,
		`shipping_cost` double NOT NULL,
		`status` int(1) NOT NULL,
		`tag` varchar(200) NOT NULL,
		`meta_desc` varchar(255) NOT NULL,
		`meta_keywords` text NOT NULL,
		`intro_date` date NOT NULL,
		`is_featured` int(1) NOT NULL,
		`digital` int(10) NOT NULL,
		`gift` int(20) NOT NULL,
		`digital_product_path` varchar(200) NOT NULL,
		`has_variation` tinyint(11) NOT NULL,
		`product_status` int(1) NOT NULL COMMENT '1=>new products,2=>discount product,3=>deleted products',
		`deleted_reason` varchar(240) NOT NULL,
		PRIMARY KEY (`product_id`)
		) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";
		$result=mysql_query($sql);
	

		
		$sql="Drop table if exists product_variation_table";
		$result=mysql_query($sql);
		$sql="CREATE TABLE IF NOT EXISTS `product_variation_table` (
			`variation_id` bigint(12) NOT NULL AUTO_INCREMENT,
			`product_id` bigint(12) NOT NULL,
			`sku` varchar(100) NOT NULL,
			`variation_name` varchar(250) NOT NULL,
			`description` text NOT NULL,
			`msrp` double NOT NULL,
			`price` double NOT NULL,
			`weight` varchar(25) NOT NULL,
			`dimension` varchar(100) NOT NULL,
			`thumb_image` varchar(150) NOT NULL,
			`image` varchar(150) NOT NULL,
			`large_image` varchar(240) NOT NULL,
			`shipping_cost` double NOT NULL,
			`soh` bigint(12) NOT NULL,
			`rol` bigint(10) NOT NULL,
			`status` tinyint(1) NOT NULL,
			PRIMARY KEY (`variation_id`)
			)";
		$result=mysql_query($sql);

		$sql="Drop table if exists search_tags_table";
		$result=mysql_query($sql);
		$sql="CREATE TABLE search_tags_table(id  INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,search_tag  VARCHAR(250) NOT NULL,search_count  INT(11) NOT NULL)";
		$result=mysql_query($sql);
		


		$sql="Drop table if exists shipments_master_table";
		$result=mysql_query($sql);
		$sql="CREATE TABLE IF NOT EXISTS `shipments_master_table` (
			`shipment_id` int(11) NOT NULL AUTO_INCREMENT,
			`shipment_name` varchar(200) NOT NULL,
			`shipment_user_id` varchar(240) NOT NULL,
			`shipment_password` varchar(240) NOT NULL,
			`shipment_accesskey` varchar(240) NOT NULL,
			`status` int(11) NOT NULL,
			PRIMARY KEY (`shipment_id`)
			)";
		$result=mysql_query($sql);
		

		$sql="Drop table if exists shopping_cart_products_table";
		$result=mysql_query($sql);
		$sql="CREATE TABLE IF NOT EXISTS `shopping_cart_products_table` (
                        `id` int(20) NOT NULL AUTO_INCREMENT,
                        `cart_id` int(25) NOT NULL,
                        `product_id` varchar(100) NOT NULL,
                        `product_qty` int(10) NOT NULL,
                        `date_added` date NOT NULL,
                        `product_unit_price` double NOT NULL,
                        `shipping_cost` double NOT NULL,
                        `variation_id` int(20) NOT NULL,
                        `original_price` double NOT NULL,
                        `gift_product` int(11) NOT NULL,
                        PRIMARY KEY (`id`)
                        )";
		$result=mysql_query($sql);

		$sql="DROP TABLE IF EXISTS `site_hit_counter_table`";
		$result=mysql_query($sql);
		$sql="CREATE TABLE `site_hit_counter_table` (
		`ID` double NOT NULL auto_increment,
		`ip_address` varchar(20) NOT NULL,
		`visited_on` datetime NOT NULL,
		PRIMARY KEY  (`ID`)
		)";
		$result=mysql_query($sql);

		$sql="Drop table if exists shopping_cart_table";
		$result=mysql_query($sql);
		$sql="CREATE TABLE shopping_cart_table(cart_id  INT(25) NOT NULL PRIMARY KEY AUTO_INCREMENT,user_id  INT(25) NOT NULL,cart_date  datetime NOT NULL )";
		$result=mysql_query($sql);


		$sql="Drop table if exists skins_table";
		$result=mysql_query($sql);
		$sql="CREATE TABLE skins_table(skin_id  INT(20) NOT NULL PRIMARY KEY AUTO_INCREMENT,skin_name  VARCHAR(50) NOT NULL,skin_status  INT(4) NOT NULL)";
		$result=mysql_query($sql);
		

		$sql="Drop table if exists social_links_table";
		$result=mysql_query($sql);
		$sql="CREATE TABLE social_links_table(social_link_id  INT(20) NOT NULL PRIMARY KEY AUTO_INCREMENT,social_link_title  VARCHAR(200) NOT NULL,social_link_logo  VARCHAR(200) NOT NULL,social_link_url VARCHAR(200) NOT NULL,status INT(5) NOT NULL)";
		$result=mysql_query($sql);
			



		$sql="Drop table if exists social_link_content_table";
		$result=mysql_query($sql);
		$sql="CREATE TABLE social_link_content_table(content_id  INT(20) NOT NULL PRIMARY KEY AUTO_INCREMENT,content_title  VARCHAR(240) NOT NULL,content_desc TEXT(65535) NOT NULL)";
		$result=mysql_query($sql);

		


		$sql="Drop table if exists subadmin_roles_table";
		$result=mysql_query($sql);
		$sql="CREATE TABLE subadmin_roles_table(subadmin_role_id  INT(20) NOT NULL PRIMARY KEY AUTO_INCREMENT,subadmin_id  INT(20) NOT NULL,subadmin_page_id  INT(20) NOT NULL,subadmin_rights  INT(1) NOT NULL)";
		$result=mysql_query($sql);


		$sql="Drop table if exists subadmin_table";
		$result=mysql_query($sql);
		$sql="CREATE TABLE subadmin_table(subadmin_id  INT(20) NOT NULL PRIMARY KEY AUTO_INCREMENT,subadmin_name  VARCHAR(200) NOT NULL,subadmin_password  VARCHAR(200) NOT NULL,subadmin_email_id  VARCHAR(200) NOT NULL,subadmin_status  INT(1) NOT NULL)";
		$result=mysql_query($sql);
		


		$sql="Drop table if exists tax_master_table";
		$result=mysql_query($sql);
		$sql="CREATE TABLE tax_master_table (id int(11) NOT NULL,description varchar(200) NOT NULL,status int(11) NOT NULL,based_on_address varchar(200) NOT NULL)";
		$result=mysql_query($sql);
		



		$sql="Drop table if exists termsconditions_table";
		$result=mysql_query($sql);
		$sql="CREATE TABLE termsconditions_table(termsid  INT(4) NOT NULL PRIMARY KEY AUTO_INCREMENT,termscontent  TEXT(65535) NOT NULL )";
		$result=mysql_query($sql);
		


		$sql="Drop table if exists timezone_table";
		$result=mysql_query($sql);
		$sql="CREATE TABLE timezone_table(tz_id  INT(15) NOT NULL PRIMARY KEY AUTO_INCREMENT,tz_code  VARCHAR(10) NOT NULL,tz_coords  VARCHAR(50) NOT NULL,tz_timezone  VARCHAR(50) NOT NULL,tz_comments  TEXT(65535) NOT NULL )";
		$result=mysql_query($sql);
		


		$sql="Drop table if exists uniquetax_settings_table";
		$result=mysql_query($sql);
		$sql="CREATE TABLE uniquetax_settings_table (tax_name varchar(200) NOT NULL,based_on_amount varchar(200) NOT NULL,tax_rate_percent float NOT NULL)";
		$result=mysql_query($sql);
		

			
		$sql="Drop table if exists users_group_table";
		$result=mysql_query($sql);
		$sql="CREATE TABLE IF NOT EXISTS `users_group_table` (
		`group_id` int(11) NOT NULL AUTO_INCREMENT,
		`group_name` varchar(60) DEFAULT NULL,
		`group_discount` varchar(50) DEFAULT NULL,
		PRIMARY KEY (`group_id`)
		) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1";
		$result=mysql_query($sql);

		$sql="Drop table if exists users_table";
		$result=mysql_query($sql);
		$sql="CREATE TABLE IF NOT EXISTS `users_table` (
		`user_id` int(25) NOT NULL AUTO_INCREMENT,
		`user_display_name` varchar(50) NOT NULL,
		`user_fname` varchar(50) NOT NULL,
		`user_lname` varchar(50) NOT NULL,
		`user_email` varchar(50) NOT NULL,
		`user_pwd` varchar(150) NOT NULL,
		`user_group` int(11) NOT NULL,
		`user_country` varchar(100) NOT NULL,
		`user_status` int(2) NOT NULL,
		`user_doj` date NOT NULL,
		`billing_address_id` int(10) NOT NULL,
		`shipping_address_id` int(10) NOT NULL,
		`ipaddress` varchar(100) NOT NULL,
		`social_link_id` varchar(100) NOT NULL,
		`is_from_social_link` int(20) NOT NULL,
			`confirmation_code` int(20) NOT NULL,	
		PRIMARY KEY (`user_id`)
		) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2";
		$result=mysql_query($sql);
		
		
		$sql="Drop table if exists wishlist_table";
		$result=mysql_query($sql);
		$sql="CREATE TABLE wishlist_table(wishlist_id  INT(20) NOT NULL PRIMARY KEY AUTO_INCREMENT,user_id  INT(20) NOT NULL,product_id  INT(20) NOT NULL,date_added  date NOT NULL ,comments  TEXT(65535) NOT NULL )";
		$result=mysql_query($sql);
		

	}
		
}
?>
