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
		$sql="INSERT INTO `addressbook_table` (`id`, `user_id`, `contact_name`, `first_name`, `last_name`, `company`, `email`, `address`, `city`, `suburb`, `state`, `country`, `zip`, `phone_no`, `fax`) VALUES(1, 1, 'Demouser', 'Demouser', 'Demouser', '', 'demouser@ajsqaure.net', 'kk nagar', 'madurai', '', 'tamilnadu', 'AF', '625108', '', '')";
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
		$sql="INSERT INTO `admin_activity_table` (`isAdmin`, `user_id`, `url`, `visited_on`) VALUES
		(1, '1', '/ajshop/ajshopping_cart/admin/?do=manageproducts', '2013-02-23 16:27:51')";
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
			PRIMARY KEY (`set_id`)
			) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;";
		$result=mysql_query($sql);
		$sql="
		INSERT INTO `admin_settings_table` (`set_id`, `customer_header`, `site_logo`, `google_analytics`, `time_zone`, `site_moto`, `site_skin`, `admin_email`, `meta_kerwords`, `meta_description`) VALUES
		(1, '', 'images/logo.gif', '', '', 'zeuscart', '', 'revathy@ajsquare.net', '', '');
		";
		$result=mysql_query($sql);



		$sql="Drop table if exists admin_table";
		$result=mysql_query($sql);
		$sql="CREATE TABLE admin_table(admin_id  INT(20) NOT NULL PRIMARY KEY AUTO_INCREMENT,admin_name  VARCHAR(200) NOT NULL,admin_password  VARCHAR(200) NOT NULL)";
		$result=mysql_query($sql);
		$sql="INSERT INTO `admin_table` (`admin_id`, `admin_name`, `admin_password`) VALUES
		(1, 'admin', 'YWRtaW4=')";
		$result=mysql_query($sql);


		
		$sql="Drop table if exists attribute_table";
		$result=mysql_query($sql);
		$sql="CREATE TABLE attribute_table(attrib_id  INT(15) NOT NULL PRIMARY KEY AUTO_INCREMENT,attrib_name  VARCHAR(200) NOT NULL)";
		$result=mysql_query($sql);
		$sql="INSERT INTO `attribute_table` (`attrib_id`, `attrib_name`) VALUES
		(1, 'Size')";
		$result=mysql_query($sql);



		$sql="Drop table if exists attribute_value_table";
		$result=mysql_query($sql);
		$sql="CREATE TABLE attribute_value_table(attrib_value_id  INT(20) NOT NULL PRIMARY KEY AUTO_INCREMENT,attrib_id  INT(20) NOT NULL,attrib_value  VARCHAR(100) NOT NULL)";
		$result=mysql_query($sql);
		$sql="INSERT INTO `attribute_value_table` ( `attrib_id`, `attrib_value`) VALUES
		(1, '22')";
		$result=mysql_query($sql);
		
		


		$sql="Drop table if exists category_attrib_table";
		$result=mysql_query($sql);
		$sql="CREATE TABLE category_attrib_table(category_attrib_id  INT(15) NOT NULL PRIMARY KEY AUTO_INCREMENT,subcategory_id  INT(15) NOT NULL,attrib_id  INT(15) NOT NULL)";
		$result=mysql_query($sql);
		$sql="INSERT INTO `category_attrib_table` ( `subcategory_id`, `attrib_id`) VALUES( 44, 0)";	
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
			) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ";
		$result=mysql_query($sql);
		$sql="INSERT INTO `category_table` (`category_id`, `category_name`, `category_parent_id`, `subcat_path`, `category_image`, `category_desc`, `category_status`, `category_content_id`, `count`) VALUES
		(1, 'Women', 0, '1', 'uploadedimages/caticons/2013-09-10-170711laptop-bags05.jpg', 'WomenWomen', 1, 0, 0),
		(2, 'Shoes', 1, '1,2', 'uploadedimages/caticons/2013-09-10-171134formal-shoes03.jpg', 'ShoesShoesShoes', 1, 0, 1),
		(3, 'Clothing', 1, '1,3', 'uploadedimages/caticons/2013-09-10-171416shirt13.jpg', 'ClothingClothingClothing', 1, 0, 1),
		(4, 'Watches', 1, '1,4', 'uploadedimages/caticons/2013-09-10-171824digital-watches03.jpg', 'WatchesWatchesWatches', 1, 0, 1),
		(5, 'Bags', 1, '1,5', 'uploadedimages/caticons/2013-09-10-172159wallets03.jpg', 'BagsBagsBagsBags', 1, 0, 1),
		(6, 'Boots', 2, '1,2,6', 'uploadedimages/caticons/2013-09-10-172243sports-shoes07.jpg', 'BootsBootsBoots', 1, 0, 2),
		(7, 'Formal', 2, '1,2,7', 'uploadedimages/caticons/2013-09-10-172328formals06.jpg', 'FormalFormalFormal', 1, 0, 2),
		(8, 'Sneakers', 2, '1,2,8', 'uploadedimages/caticons/2013-09-10-172414Crafted-Long-Sleeved-Shirt.jpg', 'SneakersSneakersSneakersSneakers', 1, 0, 2),
		(9, 'Sportsshoes', 2, '1,2,9', 'uploadedimages/caticons/2013-09-10-172458formals06.jpg', 'SportsshoesSportsshoesSportsshoes', 1, 0, 2),
		(10, 'T-shirts', 3, '1,3,10', 'uploadedimages/caticons/2013-09-10-172543Crafted-Long-Sleeved-Shirt.jpg', 'T-shirtsT-shirtsT-shirts', 1, 0, 2),
		(11, 'Analog watches', 4, '1,4,11', 'uploadedimages/caticons/2013-09-10-172631digital-watches06.jpg', 'Analog watchesAnalog watchesAnalog watches', 1, 0, 2),
		(12, 'Digital watches', 4, '1,4,12', 'uploadedimages/caticons/2013-09-10-172714digital-watches03.jpg', 'Digital watchesDigital watchesDigital watches', 1, 0, 2),
		(13, 'Chronograhs', 4, '1,4,13', 'uploadedimages/caticons/2013-09-10-172822chronograhs06.jpg', 'ChronograhsChronograhsChronograhs', 1, 0, 2),
		(14, 'Laptop bags', 5, '1,5,14', 'uploadedimages/caticons/2013-09-10-172917laptop-bags06.jpg', 'Laptop bagsLaptop bagsLaptop bags', 1, 0, 2),
		(15, 'Backbags', 14, '1,5,14,15', 'uploadedimages/caticons/2013-09-10-172958backpacks03.jpg', 'BackbagsBackbagsBackbags', 1, 0, 3),
		(16, 'Wallets', 5, '1,5,16', 'uploadedimages/caticons/2013-09-10-173040Avalanche-Handbag.jpg', 'WalletsWalletsWallets', 1, 0, 2),
		(17, 'Men', 0, '17', 'uploadedimages/caticons/2013-09-10-173109shirts07.jpg', 'MenMenMen', 1, 0, 0),
		(18, 'Shoes', 17, '17,18', 'uploadedimages/caticons/2013-09-10-173157sports-shoes07.jpg', 'ShoesShoes', 1, 0, 1),
		(19, 'Bags', 17, '17,19', 'uploadedimages/caticons/2013-09-10-173249backpacks03.jpg', 'BagsBagsBags', 1, 0, 1),
		(20, 'Clothing', 17, '17,20', 'uploadedimages/caticons/2013-09-10-173328Crafted-Long-Sleeved-Shirt.jpg', 'ClothingClothingClothing', 1, 0, 1),
		(21, 'Watches', 17, '17,21', 'uploadedimages/caticons/2013-09-10-173352digital-watches03.jpg', 'WatchesWatchesWatches', 1, 0, 1),
		(22, 'Boots', 18, '17,18,22', 'uploadedimages/caticons/2013-09-10-173432digital-watches03.jpg', 'BootsBootsBoots', 1, 0, 2),
		(23, 'T-shirts', 20, '17,20,23', 'uploadedimages/caticons/2013-09-10-173704Crafted-Long-Sleeved-Shirt.jpg', 'T-shirtsT-shirtsT-shirts', 1, 0, 2),
		(24, 'Digital watches', 21, '17,21,24', 'uploadedimages/caticons/2013-09-10-173738digital-watches03.jpg', 'Digital watchesDigital watchesDigital watches', 1, 0, 2),
		(25, 'Accessories', 0, '25', 'uploadedimages/caticons/2013-09-10-1738292.jpg', 'AccessoriesAccessories', 1, 0, 0),
		(26, 'Mobile', 25, '25,26', 'uploadedimages/caticons/2013-09-10-1739106.jpg', 'MobileMobileMobile', 1, 0, 1),
		(27, 'Slider mobile', 26, '25,26,27', 'uploadedimages/caticons/2013-09-10-1740456.jpg', 'Slider mobileSlider mobileSlider mobile', 1, 0, 2),
		(28, 'Computes', 25, '25,28', 'uploadedimages/caticons/2013-09-10-1741422.jpg', 'ComputesComputesComputes', 1, 0, 1);
		";
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
		$sql="INSERT INTO `coupon_category_table` (`id`, `coupon_code`, `category_id`) VALUES
		(1, '', 58)";
		$result=mysql_query($sql);



		$sql="Drop table if exists coupon_user_relation_table";
		$result=mysql_query($sql);
		$sql="CREATE TABLE coupon_user_relation_table(id  INT(15) NOT NULL PRIMARY KEY AUTO_INCREMENT,coupon_code  VARCHAR(25) NOT NULL,user_id  INT(25) NOT NULL,no_of_uses  INT(11) NOT NULL)";
		$result=mysql_query($sql);


		$sql="Drop table if exists coupons_table";
		$result=mysql_query($sql);
		$sql="CREATE TABLE coupons_table(id  INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,coupon_code  VARCHAR(25) NOT NULL,coupan_name  VARCHAR(200) NOT NULL,created_date  datetime NOT NULL ,discount_amt  real NOT NULL,discount_type  VARCHAR(20) NOT NULL,valid_from  date NOT NULL ,valid_to  date NOT NULL ,min_purchase  real NOT NULL,no_of_uses  INT(11) NOT NULL,applies_to  TEXT(65535) NOT NULL ,status  INT(1) NOT NULL)";
		$result=mysql_query($sql);
		$sql="INSERT INTO `coupons_table` (`id`, `coupon_code`, `coupan_name`, `created_date`, `discount_amt`, `discount_type`, `valid_from`, `valid_to`, `min_purchase`, `no_of_uses`, `applies_to`, `status`) VALUES(1, '', 'general', '2013-03-28 16:00:06', 10, 'percent', '2013-03-28', '2013-03-31', 100, 1, '', 1)";
		$result=mysql_query($sql);




		$sql="Drop table if exists cross_products_table";
		$result=mysql_query($sql);
		$sql="CREATE TABLE cross_products_table(product_id  INT(25) NOT NULL PRIMARY KEY,cross_product_ids  TEXT(65535) NOT NULL )";
		$result=mysql_query($sql);
		$sql="INSERT INTO `cross_products_table` (`product_id`, `cross_product_ids`) VALUES
		(1, '')";
		$result=mysql_query($sql);


		$sql="Drop table if exists currency_codes_table";
		$result=mysql_query($sql);
		$sql="CREATE TABLE `currency_codes_table` (
		`currency_code` varchar(10) collate latin1_general_ci NOT NULL,
		`country_name` varchar(200) collate latin1_general_ci NOT NULL,
		`currency_name` varchar(200) collate latin1_general_ci NOT NULL,
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
		$sql="CREATE TABLE currency_master_table (id int(11) NOT NULL auto_increment,currency_name varchar(200) NOT NULL,currency_code varchar(50) NOT NULL,country_code varchar(25) NOT NULL,conversion_rate float NOT NULL,currency_tocken varchar(25) NOT NULL,status int(11) NOT NULL,
		default_currency int(11) NOT NULL default '0',PRIMARY KEY  (`id`))";
		$result=mysql_query($sql);


		$sql="Drop table if exists custompage_table";
		$result=mysql_query($sql);
		$sql="CREATE TABLE custompage_table(page_id  INT(20) NOT NULL PRIMARY KEY AUTO_INCREMENT,page_name  VARCHAR(100) NOT NULL,page_url  VARCHAR(200) NOT NULL,status  INT(1) NOT NULL)";
		$result=mysql_query($sql);
		$sql="INSERT INTO `custompage_table` (`page_id`, `page_name`, `page_url`, `status`) VALUES
		(1, 'new', 'userpage/new.html', 0)";
		$result=mysql_query($sql);



		$sql="Drop table if exists faq_table";
		$result=mysql_query($sql);
		$sql="CREATE TABLE faq_table(faq_id  INT(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,faq_qn  TEXT(65535) NOT NULL ,faq_ans  TEXT(65535) NOT NULL )";
		$result=mysql_query($sql);

		$sql="INSERT INTO `faq_table` (`faq_qn`, `faq_ans`) VALUES
		( 'What is ZeusCart ?', 'Zeus Cart offers easy-to-use features to open your first online store quickly, advanced features for additional customization, and integration with desktop administrator control panel. Zeus Cart offers easy-to-use features to open your first online store quickly, advanced features for additional customization, and integration with desktop administrator control panel.Zeus Cart offers easy-to-use features to open your first online store quickly, advanced features for store quickly, advanced features for additional customization, store quickly, advanced features for additional customization, and integration with and integration with additional customization, and integration with desktop administrator control panel.'),
		('How it helps?', 'Allows user to purchase any item through online immediately.')"; 
		$result=mysql_query($sql);



		$sql="Drop table if exists footer_settings_table";
		$result=mysql_query($sql);
		$sql="CREATE TABLE footer_settings_table(id  INT(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,callus  INT(50) NOT NULL ,email VARCHAR(255) NOT NULL,fax INT(50) NOT NULL,location VARCHAR(100) NOT NULL,footercontent TEXT(65535) NOT NULL)";
		$result=mysql_query($sql);
		$sql="INSERT INTO `footer_settings_table` (`id`, `callus`, `email`, `fax`, `location`, `footercontent`) VALUES
		(1, 2147483647, 'admin@zeuscart.com', 2147483647, 'Madurai', 'Copyright © 2013. All rights reserved. ')";
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
		$sql="INSERT INTO `gift_voucher_table` (`id`, `cart_id`, `order_id`, `gift_product_id`, `recipient_name`, `recipient_email`, `name`, `email`, `certificate_theme`, `message`, `gift_code`) VALUES(1, 0, 83, 28, 'revathi', 'rekuece@yahoo.com', 'revathi', '', 'brithday', ' ', 'AJGC4133')";
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
		$sql="INSERT INTO `home_page_ads_table` (`home_page_ads_id`, `home_page_ads_title`, `home_page_ads_logo`, `home_page_ads_url`, `status`) VALUES
		(1, 'polo', 'images/homepageads/2013-04-11-1442011.gif', 'http://localhost/ajshop/zeuscart', 1),
		(2, 'polo', 'images/homepageads/2013-04-11-1442252.gif', 'http://localhost/ajshop/zeuscart', 1)";
		$result=mysql_query($sql);	


		$sql="Drop table if exists home_slide_parameter_table";
		$result=mysql_query($sql);
		$sql="CREATE TABLE home_slide_parameter_table(id INT(20) NOT NULL PRIMARY KEY AUTO_INCREMENT,module_name VARCHAR(255) NOT NULL,parameter TEXT(65535) NOT NULL)";
		$result=mysql_query($sql);



	 	$json='{"slide_content_thumb":["images/slidesupload/thumb/b3.jpg","images/slidesupload/thumb/b1.jpg","images/slidesupload/thumb/b2.jpg"],"slide_content_image":["images/slidesupload/b3.jpg","images/slidesupload/b1.jpg","images/slidesupload/b2.jpg"],"slideshowheight":"450","imagealignment":"center","autoAdvance":"true","transactioneffect":"random","slicedcolumns":"12","slicedrows":"8","easingeffect":"easeInOutBounce","slidingtime":"7000","slidingeffecttime":"1500","pagination":"true","navigationbuttons":"true","shownavigation":"true","pausebutton":"true","pauseonclick":"true","pasueonhover":"false","timertype":"pie","timercolor":"#eeeeee","timerbgcolor":"#222222","timerbarposition":"left","timerbardirections":"topToBottom","piediameter":"38","pieposition":"rightTop","thumbnails":"true"}'; 	
		

	
		$sql='INSERT INTO `home_slide_parameter_table` (`id`, `module_name`, `parameter`) VALUES
		(1, "Parameter",\''.$json.'\')';
		$result=mysql_query($sql);


		$sql="Drop table if exists home_slide_show_table";
		$result=mysql_query($sql);
		$sql="CREATE TABLE home_slide_show_table(id INT(20) NOT NULL PRIMARY KEY AUTO_INCREMENT,slide_title VARCHAR(240) NOT NULL,slide_content TEXT(65535) NOT NULL ,slide_content_thumb VARCHAR(240) NOT NULL,slide_caption TEXT(65535) NOT NULL,slide_url VARCHAR(240) NOT NULL	)";
		$result=mysql_query($sql);
		$sql="INSERT INTO `home_slide_show_table` (`id`, `slide_title`, `slide_content`, `slide_content_thumb`, `slide_caption`, `slide_url`) VALUES
		(1, 'slide1', 'images/b3.jpg', 'images/b3_thumb.jpg', 'zeuscart1', 'http://www.google.co.in/'),
		(2, 'slide2', 'images/b1.jpg', 'images/b1_thumb.jpg', 'zeuscart2', 'http://www.google.co.in/'),
		(3, 'slide3', 'images/b2.jpg', 'images/b2_thumb.jpg', 'zeuscart3', 'http://www.google.co.in/')";
		$result=mysql_query($sql);


		$sql="Drop table if exists html_contents_table";
		$result=mysql_query($sql);
		$sql="CREATE TABLE html_contents_table(html_content_id  INT(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,html_content_name  VARCHAR(255) NOT NULL,html_content  TEXT(65535) NOT NULL )";
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
		$sql="INSERT INTO `invoice_table` (`id`, `order_id`, `invoice_name`, `invoice_path`, `invoice_upload_date`) VALUES
		(1, 1, '', 'images/invoice/Brand-New-Debtor.pdf', '2013-04-16 18:09:43')";
		$result=mysql_query($sql);



		$sql="Drop table if exists mail_content_table";
		$result=mysql_query($sql);
		$sql="CREATE TABLE IF NOT EXISTS `mail_content_table` (
		`content_id` int(11) NOT NULL AUTO_INCREMENT,
		`content_title` varchar(255) DEFAULT NULL,
		`content_from` varchar(50) DEFAULT NULL,
		`content_subject` varchar(255) DEFAULT NULL,
		`content_message` text,
		PRIMARY KEY (`content_id`)
		)";
		$result=mysql_query($sql);
		$sql="INSERT INTO `mail_content_table` (`content_id`, `content_title`, `content_from`, `content_subject`, `content_message`) VALUES
			(1, 'Create Account', 'admin@ajshopping.com', 'Your Account has been Created Successfully.', '&lt;table style=&quot;height: 485px;&quot; border=&quot;0&quot; cellspacing=&quot;0&quot; cellpadding=&quot;0&quot; width=&quot;429&quot;&gt;\r\n&lt;tbody&gt;\r\n&lt;tr&gt;\r\n&lt;td&gt;[LOGO]&lt;/td&gt;\r\n&lt;td style=&quot;height: 97px;&quot;&gt;&amp;nbsp;&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;tr&gt;\r\n&lt;td&gt;&amp;nbsp;&lt;/td&gt;\r\n&lt;td&gt;&amp;nbsp;&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;tr&gt;\r\n&lt;td style=&quot;border-bottom: 6px solid #6699cc; padding: 7px 5px; font-weight: bold; font-size: 14px; color: #000000; font-family: Verdana,Arial,Helvetica,sans-serif; background-color: #e8e8e8&quot; colspan=&quot;2&quot;&gt;Your Account has been Created Successfully.&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;tr&gt;\r\n&lt;td&gt;&amp;nbsp;&lt;/td&gt;\r\n&lt;td&gt;&amp;nbsp;&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;tr height=&quot;20&quot;&gt;\r\n&lt;td style=&quot;font-family: Verdana,Arial,Helvetica,sans-serif; font-size: 13px; color: #006400&quot; colspan=&quot;2&quot;&gt;\r\n&lt;p&gt;&lt;strong&gt;User Name :&lt;/strong&gt;&lt;span style=&quot;color: #000000;&quot;&gt; [USERNAME]&lt;/span&gt;&lt;/p&gt;\r\n&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;tr&gt;\r\n&lt;td&gt;&amp;nbsp;&lt;/td&gt;\r\n&lt;td&gt;&amp;nbsp;&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;tr height=&quot;20&quot;&gt;\r\n&lt;td style=&quot;font-family: Verdana,Arial,Helvetica,sans-serif; font-size: 13px; color: #006400&quot; colspan=&quot;2&quot;&gt;\r\n&lt;p&gt;&lt;strong&gt;Password :&lt;/strong&gt;&lt;span style=&quot;color: #000000;&quot;&gt; [PASSWORD]&lt;/span&gt;&lt;/p&gt;\r\n&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;tr&gt;\r\n&lt;td&gt;&amp;nbsp;&lt;/td&gt;\r\n&lt;td&gt;&amp;nbsp;&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;tr height=&quot;20&quot;&gt;\r\n&lt;td style=&quot;font-family: Verdana,Arial,Helvetica,sans-serif; font-size: 13px; color: #000000&quot; colspan=&quot;2&quot;&gt;Thanx For Joining With Us.&lt;br /&gt;&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;tr&gt;\r\n&lt;td&gt;&amp;nbsp;&lt;/td&gt;\r\n&lt;td&gt;&amp;nbsp;&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;tr height=&quot;20&quot;&gt;\r\n&lt;td style=&quot;font-family: Verdana,Arial,Helvetica,sans-serif; font-size: 13px; color: #000000&quot; colspan=&quot;2&quot;&gt;\r\n&lt;p&gt;Regards&lt;/p&gt;\r\n&lt;p&gt;AJ Shopping Cart Team&lt;/p&gt;\r\n&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;tr&gt;\r\n&lt;td&gt;&amp;nbsp;&lt;/td&gt;\r\n&lt;td&gt;&amp;nbsp;&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;tr height=&quot;20&quot;&gt;\r\n&lt;td style=&quot;font-family: Verdana,Arial,Helvetica,sans-serif; font-size: 11px; color: #999999&quot; colspan=&quot;2&quot;&gt;\r\n&lt;p&gt;&iuml;&iquest;&frac12;2006 - 2008 AJSquare Inc.All rights reserved&lt;/p&gt;\r\n&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;/tbody&gt;\r\n&lt;/table&gt;'),
			(2, 'Order Placed Successfully', 'admin@ajshopping.com', 'Your Order was Placed Successfully', '&lt;table style=&quot;height: 476px;&quot; border=&quot;0&quot; cellspacing=&quot;0&quot; cellpadding=&quot;0&quot; width=&quot;450&quot;&gt;\r\n&lt;tbody&gt;\r\n&lt;tr&gt;\r\n&lt;td&gt;[LOGO]&lt;/td&gt;\r\n&lt;td style=&quot;height: 97px;&quot;&gt;&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;tr&gt;\r\n&lt;td&gt;&lt;/td&gt;\r\n&lt;td&gt;&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;tr&gt;\r\n&lt;td style=&quot;border-bottom: 6px solid #6699cc; padding: 7px 5px; font-weight: bold; font-size: 14px; color: #000000; font-family: Verdana,Arial,Helvetica,sans-serif; background-color: #e8e8e8&quot; colspan=&quot;2&quot;&gt;Your Order was Placed Successfully&lt;br /&gt;&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;tr&gt;\r\n&lt;td&gt;&lt;/td&gt;\r\n&lt;td&gt;&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;tr height=&quot;20&quot;&gt;\r\n&lt;td style=&quot;font-family: Verdana,Arial,Helvetica,sans-serif; font-size: 13px; color: #000000&quot; colspan=&quot;2&quot;&gt;*** This is an automatically generated email, please do not reply ***.&amp;nbsp;&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;tr&gt;\r\n&lt;td&gt;&lt;/td&gt;\r\n&lt;td&gt;&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;tr height=&quot;20&quot;&gt;\r\n&lt;td style=&quot;font-family: Verdana,Arial,Helvetica,sans-serif; font-size: 13px; color: #000000&quot; colspan=&quot;2&quot;&gt;You Order for [AMOUNT] was placed successfully. The Site Administrator will contact you shortly through mail or over phone and confirm the order status.&amp;nbsp;&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;tr&gt;\r\n&lt;td&gt;&lt;/td&gt;\r\n&lt;td&gt;&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;tr height=&quot;20&quot;&gt;\r\n&lt;td style=&quot;font-family: Verdana,Arial,Helvetica,sans-serif; font-size: 13px; color: #000000&quot; colspan=&quot;2&quot;&gt;Thanks for Placing this Order with us.&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;tr height=&quot;20&quot;&gt;\r\n&lt;td style=&quot;font-family: Verdana,Arial,Helvetica,sans-serif; font-size: 13px; color: #000000&quot; colspan=&quot;2&quot;&gt;Regards&lt;br /&gt; &lt;br /&gt; AJ Shopping Cart Team&lt;br /&gt;&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;tr&gt;\r\n&lt;td&gt;&lt;/td&gt;\r\n&lt;td&gt;&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;tr height=&quot;20&quot;&gt;\r\n&lt;td style=&quot;font-family: Verdana,Arial,Helvetica,sans-serif; font-size: 11px; color: #999999&quot; colspan=&quot;2&quot;&gt;&amp;copy; 2006 - 2008&amp;nbsp; AJ Square Inc. All rights reserved&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;/tbody&gt;\r\n&lt;/table&gt;'),
			(3, 'New Order Placed', 'admin@ajshopping.com', 'A New Order was Placed', '&lt;table border=&quot;0&quot; cellspacing=&quot;0&quot; cellpadding=&quot;0&quot; width=&quot;70%&quot;&gt;\r\n&lt;tbody&gt;\r\n&lt;tr&gt;\r\n&lt;td&gt;[LOGO]&lt;/td&gt;\r\n&lt;td style=&quot;height: 97px;&quot;&gt;&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;tr&gt;\r\n&lt;td&gt;&lt;/td&gt;\r\n&lt;td&gt;&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;tr&gt;\r\n&lt;td style=&quot;border-bottom: 6px solid #6699cc; padding: 7px 5px; font-weight: bold; font-size: 14px; color: #000000; font-family: Verdana,Arial,Helvetica,sans-serif; background-color: #e8e8e8&quot; colspan=&quot;2&quot;&gt;New Order Placed For [AMOUNT]&lt;br /&gt;&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;tr&gt;\r\n&lt;td&gt;&lt;/td&gt;\r\n&lt;td&gt;&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;tr height=&quot;20&quot;&gt;\r\n&lt;td style=&quot;font-family: Verdana,Arial,Helvetica,sans-serif; font-size: 13px; color: #000000&quot; colspan=&quot;2&quot;&gt;*** This is an automatically generated email, please do not reply ***&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;tr&gt;\r\n&lt;td&gt;&lt;/td&gt;\r\n&lt;td&gt;&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;tr height=&quot;20&quot;&gt;\r\n&lt;td style=&quot;font-family: Verdana,Arial,Helvetica,sans-serif; font-size: 13px; color: #000000&quot; colspan=&quot;2&quot;&gt;\r\n&lt;p&gt;You have received a new order for [AMOUNT]. Follow the link below to view complete details of the order:&lt;/p&gt;\r\n&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;tr&gt;\r\n&lt;td&gt;&lt;/td&gt;\r\n&lt;td&gt;&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;tr height=&quot;20&quot;&gt;\r\n&lt;td style=&quot;font-family: Verdana,Arial,Helvetica,sans-serif; font-size: 13px; color: #000000&quot; colspan=&quot;2&quot;&gt;[URL]&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;tr&gt;\r\n&lt;td&gt;&lt;/td&gt;\r\n&lt;td&gt;&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;tr&gt;\r\n&lt;td&gt;&lt;/td&gt;\r\n&lt;td&gt;&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;tr height=&quot;20&quot;&gt;\r\n&lt;td style=&quot;font-family: Verdana,Arial,Helvetica,sans-serif; font-size: 11px; color: #999999&quot; colspan=&quot;2&quot;&gt;&amp;copy; 2006 - 2008 AJ Square Inc.All rights reserved&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;/tbody&gt;\r\n&lt;/table&gt;'),
			(4, 'Order Status Changed', 'admin@ajshopping.com', 'Order Status Changed.', '&lt;table border=&quot;0&quot; cellspacing=&quot;0&quot; cellpadding=&quot;0&quot; width=&quot;60%&quot;&gt;\r\n&lt;tbody&gt;\r\n&lt;tr&gt;\r\n&lt;td&gt;[LOGO]&lt;/td&gt;\r\n&lt;td style=&quot;height: 97px;&quot;&gt;&amp;nbsp;&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;tr&gt;\r\n&lt;td&gt;&amp;nbsp;&lt;/td&gt;\r\n&lt;td&gt;&amp;nbsp;&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;tr&gt;\r\n&lt;td style=&quot;border-bottom: 6px solid #6699cc; padding: 7px 5px; font-weight: bold; font-size: 14px; color: #000000; font-family: Verdana,Arial,Helvetica,sans-serif; background-color: #e8e8e8&quot; colspan=&quot;2&quot;&gt;Your Order Status was Changed [STATUS]&lt;br /&gt;&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;tr&gt;\r\n&lt;td&gt;&amp;nbsp;&lt;/td&gt;\r\n&lt;td&gt;&amp;nbsp;&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;tr height=&quot;20&quot;&gt;\r\n&lt;td style=&quot;font-family: Verdana,Arial,Helvetica,sans-serif; font-size: 13px; color: #000000&quot; colspan=&quot;2&quot;&gt;The Order Status was changed to [STATUS]. Please Contact the Site Administrator for Further clarifications.&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;tr&gt;\r\n&lt;td&gt;&amp;nbsp;&lt;/td&gt;\r\n&lt;td&gt;&amp;nbsp;&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;tr height=&quot;20&quot;&gt;\r\n&lt;td style=&quot;font-family: Verdana,Arial,Helvetica,sans-serif; font-size: 13px; color: #000000&quot; colspan=&quot;2&quot;&gt;\r\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;\r\n&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;tr&gt;\r\n&lt;td&gt;&amp;nbsp;&lt;/td&gt;\r\n&lt;td&gt;&amp;nbsp;&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;tr height=&quot;20&quot;&gt;\r\n&lt;td style=&quot;font-family: Verdana,Arial,Helvetica,sans-serif; font-size: 13px; color: #000000&quot; colspan=&quot;2&quot;&gt;Regards&lt;br /&gt; &lt;br /&gt; AJ Shopping Cart Team&lt;br /&gt;&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;tr&gt;\r\n&lt;td&gt;&amp;nbsp;&lt;/td&gt;\r\n&lt;td&gt;&amp;nbsp;&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;tr height=&quot;20&quot;&gt;\r\n&lt;td style=&quot;font-family: Verdana,Arial,Helvetica,sans-serif; font-size: 11px; color: #999999&quot; colspan=&quot;2&quot;&gt;&amp;copy; 2006 - 2008 AJ Square Inc.All rights reserved&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;/tbody&gt;\r\n&lt;/table&gt;'),
			(5, 'New Coupon Code', 'admin@ajshopping.com', 'New Coupon Code', '&lt;table style=&quot;height: 396px;&quot; border=&quot;0&quot; cellspacing=&quot;0&quot; cellpadding=&quot;0&quot; width=&quot;483&quot;&gt;\r\n&lt;tbody&gt;\r\n&lt;tr&gt;\r\n&lt;td&gt;[LOGO]&lt;/td&gt;\r\n&lt;td style=&quot;height: 97px;&quot;&gt;&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;tr&gt;\r\n&lt;td&gt;&lt;/td&gt;\r\n&lt;td&gt;&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;tr&gt;\r\n&lt;td style=&quot;border-bottom: 6px solid #6699cc; padding: 7px 5px; font-weight: bold; font-size: 14px; color: #000000; font-family: Verdana,Arial,Helvetica,sans-serif; background-color: #e8e8e8&quot; colspan=&quot;2&quot;&gt;You have been alloted with a new Coupon Code [CODE]&lt;br /&gt;&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;tr&gt;\r\n&lt;td&gt;&lt;/td&gt;\r\n&lt;td&gt;&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;tr height=&quot;20&quot;&gt;\r\n&lt;td style=&quot;font-family: Verdana,Arial,Helvetica,sans-serif; font-size: 13px; color: #000000&quot; colspan=&quot;2&quot;&gt;\r\n&lt;p&gt;You have been alloted with a new Coupon Code - [CODE]. You can use this coupon while checkout and get exciting discounts on the items you purchase. Your coupon is valid [FROMDATE] to [TODATE]. You can avail a discount of [DISCOUNTPERCENT] on the items you purchase.You Will get discount on the following categories.&lt;/p&gt;\r\n&lt;p&gt;[CATEGORIES]&lt;/p&gt;\r\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;\r\n&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;tr&gt;\r\n&lt;td&gt;&lt;/td&gt;\r\n&lt;td&gt;&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;tr height=&quot;20&quot;&gt;\r\n&lt;td style=&quot;font-family: Verdana,Arial,Helvetica,sans-serif; font-size: 13px; color: #000000&quot; colspan=&quot;2&quot;&gt;Regards&lt;br /&gt; &lt;br /&gt; AJ Shopping Cart Team&lt;br /&gt;&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;tr&gt;\r\n&lt;td&gt;&lt;/td&gt;\r\n&lt;td&gt;&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;tr height=&quot;20&quot;&gt;\r\n&lt;td style=&quot;font-family: Verdana,Arial,Helvetica,sans-serif; font-size: 11px; color: #999999&quot; colspan=&quot;2&quot;&gt;&amp;copy; 2006 - 2008 AJ Square Inc.All rights reserved&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;/tbody&gt;\r\n&lt;/table&gt;');
			";
			$result=mysql_query($sql);
	
	
			$sql="Drop table if exists mail_messages_table";
			$result=mysql_query($sql);
			$sql="CREATE TABLE mail_messages_table(mail_msg_id  INT(20) NOT NULL PRIMARY KEY AUTO_INCREMENT,mail_msg_subject  VARCHAR(300) NOT NULL,mail_msg  TEXT(65535) )";
			$result=mysql_query($sql);
	
	
			$sql="INSERT INTO `mail_messages_table` ( `mail_msg_subject`, `mail_msg`) VALUES
			('Registration Info', '<h2>Dear ==username==,<br /></h2>\r\n<p style=\"padding-left: 30px;\">You have successfully registered in to ==sitename==. Your user name is ==username== and password is ==password==.</p>\r\n<p style=\"padding-left: 30px;\">&nbsp;</p>'),
			( 'Failure info', '<p>Dear Customer,</p>\r\n<hr />\r\n<h2>Dear customer,<br /> You have not been fully registered in to ==sitename==. click here==link== to complete the registration.<br /></h2>\r\n<p>&nbsp;</p>'),
			('Request password confirmation', '<p>Dear ==username==,</p>\r\n<p>&nbsp;</p>\r\n<p class=\"MsoPlainText\">You have requested for the new password we send you a new login password for the ==sitename==.</p>\r\n<p class=\"MsoPlainText\">If someone else made this request, or if you have\r\nremembered your password and you no longer wish to change it, you may safely\r\nignore this message. Your old/existing password will continue to work despite\r\nthis new password being created for you.</p>\r\n<p class=\"MsoPlainText\">&nbsp;</p>\r\n<p class=\"MsoPlainText\">&nbsp;</p>\r\n<p class=\"MsoPlainText\">~==sitename==</p>\r\n<p>==siteurl==</p>\r\n<p class=\"MsoPlainText\">&nbsp;</p>'),
			( 'New temporary password', '<p>Dear ==username==,</p>\r\n<p>&nbsp;</p>\r\n<p class=\"MsoPlainText\">You have requested for the new password we send you a new login password for the ==sitename==.</p>\r\n<p class=\"MsoPlainText\">&nbsp;</p>\r\n<p class=\"MsoPlainText\">The new password for the user account ==username== is ==newpassword==. You can now log in to ==sitename== using that password.</p>\r\n<p class=\"MsoPlainText\">&nbsp;</p>\r\n<p class=\"MsoPlainText\">If someone else made this request, or if you have\r\nremembered your password and you no longer wish to change it, you may safely\r\nignore this message. Your old/existing password will continue to work despite\r\nthis new password being created for you.</p>\r\n<p class=\"MsoPlainText\">&nbsp;</p>\r\n<p class=\"MsoPlainText\">&nbsp;</p>\r\n<p class=\"MsoPlainText\">~==sitename==</p>\r\n<p>==siteurl==</p>\r\n<p class=\"MsoPlainText\">&nbsp;</p>'),
			('text_facebookregister', '<p><strong>Hi</strong> <strong>[firstname] [lastname],</strong></p><p><strong>Congratulations!</strong> Your Registration completed Successfully through Facebook Login in [domainname]</p><p>Your registration is activated successfully.</p><p>Thanks,</p><p>Zeuscart V4 Team.</p>')";
			$result=mysql_query($sql);




		$sql="Drop table if exists msrp_by_quantity_table";
		$result=mysql_query($sql);
		$sql="CREATE TABLE msrp_by_quantity_table(id  INT(25) NOT NULL PRIMARY KEY AUTO_INCREMENT,product_id  INT(25) NOT NULL,quantity  INT(10) NOT NULL,msrp  real NOT NULL)";
		$result=mysql_query($sql);


		$sql="Drop table if exists newsletter_subscription_table";
		$result=mysql_query($sql);
		$sql="CREATE TABLE newsletter_subscription_table(subsciption_id  INT(20) NOT NULL PRIMARY KEY AUTO_INCREMENT,email  VARCHAR(300) NOT NULL,status  INT(1) NOT NULL)";
		$result=mysql_query($sql);
		$sql="INSERT INTO newsletter_subscription_table VALUES('1','demouser@ajsquare.net','0')"; 
		$result=mysql_query($sql);

		$sql="Drop table if exists newsletter_table";
		$result=mysql_query($sql);
		$sql="CREATE TABLE newsletter_table(newsletter_id  INT(20) NOT NULL PRIMARY KEY AUTO_INCREMENT,newsletter_title  TEXT(65535) NOT NULL ,newsletter_content  TEXT(65535) NOT NULL ,newsletter_date_added  datetime NOT NULL ,newsletter_date_sent  datetime NOT NULL ,newsletter_status  INT(4) NOT NULL)";
		$result=mysql_query($sql);
// 		$sql="INSERT INTO `newsletter_table` (`newsletter_id`, `newsletter_title`, `newsletter_content`, `newsletter_date_added`, `newsletter_date_sent`, `newsletter_status`) VALUES
// 		(1, 'new', '<p>new</p>\r\n<!--?phpif(get_magic_quotes_gpc()) echo stripslashes($_POST[''newslettercontent'']); else echo $_POST[''newslettercontent''];?-->', '2013-03-20 00:00:00', '0000-00-00 00:00:00', 0)";
// 		$result=mysql_query($sql);

		$sql="Drop table if exists news_table";
		$result=mysql_query($sql);
		$sql="CREATE TABLE `news_table` (`news_id` int(11) NOT NULL auto_increment,`news_title` varchar(100) default NULL,
		`news_desc` text,`news_date` date default NULL,`news_status` tinyint(2) default NULL,PRIMARY KEY  (`news_id`))";
		$result=mysql_query($sql);



		$sql="Drop table if exists order_products_table";
		$result=mysql_query($sql);
		$sql="CREATE TABLE order_products_table(order_id  INT(25) NOT NULL,product_id  INT(25) NOT NULL,product_qty  INT(10) NOT NULL,product_unit_price  real NOT NULL,shipping_cost  real NOT NULL)";
		$result=mysql_query($sql);
// 		$sql="INSERT INTO `order_products_table` (`order_id`, `product_id`, `product_qty`, `product_unit_price`, `shipping_cost`) VALUES
// 		(1, 4, 4, 600, 20),
// 		(1, 14, 4, 300, 20),
// 		(1, 17, 2, 300, 10)";
// 		$result=mysql_query($sql);



		$sql="Drop table if exists orders_status_table";
		$result=mysql_query($sql);
		$sql="CREATE TABLE orders_status_table(orders_status_id  INT(20) NOT NULL PRIMARY KEY AUTO_INCREMENT,orders_status_name  VARCHAR(100) NOT NULL)";
		$result=mysql_query($sql);
		$sql="INSERT INTO `orders_status_table` ( `orders_status_name`) VALUES
		( 'Pending'),
		('Processing'),
		( 'Delivered'),
		('AwaitingPayment')";
		$result=mysql_query($sql);



		$sql="Drop table if exists orders_table";
		$result=mysql_query($sql);
		$sql="CREATE TABLE orders_table(orders_id  INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,customers_id  INT(11) NOT NULL,shipping_name  VARCHAR(64) NOT NULL,shipping_company  VARCHAR(32) ,shipping_street_address  VARCHAR(64) NOT NULL,shipping_suburb  VARCHAR(32) ,shipping_city  VARCHAR(32) NOT NULL,shipping_postcode  VARCHAR(10) NOT NULL,shipping_state  VARCHAR(32) ,shipping_country  VARCHAR(32) NOT NULL,billing_name  VARCHAR(64) NOT NULL,billing_company  VARCHAR(32) ,billing_street_address  VARCHAR(64) NOT NULL,billing_suburb  VARCHAR(32) ,billing_city  VARCHAR(32) NOT NULL,billing_postcode  VARCHAR(10) NOT NULL,billing_state  VARCHAR(32) ,billing_country  VARCHAR(32) NOT NULL,payment_method  VARCHAR(128) NOT NULL,shipping_method  VARCHAR(128) NOT NULL,coupon_code  VARCHAR(32) NOT NULL,date_purchased  datetime  ,orders_date_closed  datetime ,orders_status  INT(5) NOT NULL ,order_total  real ,order_tax  real ,ipn_id  INT(11) NOT NULL DEFAULT '0',ip_address  VARCHAR(96) NOT NULL,shipment_id_selected  INT(11) NOT NULL,shipment_track_id  VARCHAR(200) NOT NULL)";
		$result=mysql_query($sql);
// 		$sql="INSERT INTO `orders_table` (`orders_id`, `customers_id`, `shipping_name`, `shipping_company`, `shipping_street_address`, `shipping_suburb`, `shipping_city`, `shipping_postcode`, `shipping_state`, `shipping_country`, `billing_name`, `billing_company`, `billing_street_address`, `billing_suburb`, `billing_city`, `billing_postcode`, `billing_state`, `billing_country`, `payment_method`, `shipping_method`, `coupon_code`, `date_purchased`, `orders_date_closed`, `orders_status`, `order_total`, `order_tax`, `ipn_id`, `ip_address`, `shipment_id_selected`, `shipment_track_id`) VALUES
// 		(1, 11, 'Primary', '', 'koodal nagar', '', 'madurai', '625018', '', 'IN', 'Primary', '', 'koodal nagar', 'tamilnadu', 'madurai', '625018', 'tamilnadu', 'IN', '9', '', '', '2013-03-21 17:29:29', '0000-00-00 00:00:00', 4, 2150, 0, 0, '127.0.0.1', 7, '')";
// 		$result=mysql_query($sql);




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

		
		$sql="INSERT INTO pages_action_table VALUES('1','adminpayment','','AdminPayment Display')"; 
		$result=mysql_query($sql);
		$sql="INSERT INTO pages_action_table VALUES('6','adminreg','','User Management')"; 
		$result=mysql_query($sql);
		$sql="INSERT INTO pages_action_table VALUES('2','orderstatus','','Order Status Display Option')"; 
		$result=mysql_query($sql);
		$sql="INSERT INTO pages_action_table VALUES('3','disporders','','Order  Display Option')"; 
		$result=mysql_query($sql);
		$sql="INSERT INTO pages_action_table VALUES('4','paymentgateway','','Payment Gateway Display Option')"; 
		$result=mysql_query($sql);
		$sql="INSERT INTO pages_action_table VALUES('5','manageproducts','','Product Display,Entry, MSRP  Option')"; 
		$result=mysql_query($sql);


		$sql="INSERT INTO pages_action_table VALUES (7, 'adword', '', 'Google Adword')"; 
		$result=mysql_query($sql);
		$sql="INSERT INTO pages_action_table VALUES (8, 'adminproductreview', '', 'Product Review Details')"; 
		$result=mysql_query($sql);
		$sql="INSERT INTO pages_action_table VALUES (9, 'adminreg', '', 'Show Customer Details')"; 
		$result=mysql_query($sql);
		$sql="INSERT INTO pages_action_table VALUES (10, 'custreport', '', 'Export Customer')"; 
		$result=mysql_query($sql);
		$sql="INSERT INTO pages_action_table VALUES (11, 'home', '', 'Site Statistics ')"; 
		$result=mysql_query($sql);
		$sql="INSERT INTO pages_action_table VALUES (12, 'site', '', 'To Change Site Moto ')"; 
		$result=mysql_query($sql);
		$sql="INSERT INTO pages_action_table VALUES (13, 'sitemail', '', 'Administrator Email Settings')"; 
		$result=mysql_query($sql);
		$sql="INSERT INTO pages_action_table VALUES (14, 'sitelogo', '', 'To Change Site Logo')"; 
		$result=mysql_query($sql);
		$sql="INSERT INTO pages_action_table VALUES (15, 'banner', '', 'Home Page Banner Settings')"; 
		$result=mysql_query($sql);
		$sql="INSERT INTO pages_action_table VALUES (16, 'timezone', '', 'To Select the Time Zone')"; 
		$result=mysql_query($sql);
		$sql="INSERT INTO pages_action_table VALUES (17, 'ganalytics', '', 'To Change Google Analytics Tracking Script')"; 
		$result=mysql_query($sql);
		$sql="INSERT INTO pages_action_table VALUES (18, 'gadsense', '', 'To Change Google AdSense Tracking Script')"; 
		$result=mysql_query($sql);
		$sql="INSERT INTO pages_action_table VALUES (19, 'createpage', '', 'To Create Custom Pages')"; 
		$result=mysql_query($sql);
		$sql="INSERT INTO pages_action_table VALUES (20, 'terms', '', 'Terms & Conditions Settings')"; 
		$result=mysql_query($sql);
		$sql="INSERT INTO pages_action_table VALUES (21, 'adminprivacypolicy', '', 'Privacy Policy Settings')"; 
		$result=mysql_query($sql);
		$sql="INSERT INTO pages_action_table VALUES (22, 'copyrights', '', 'Copyright Information Settings')"; 
		$result=mysql_query($sql);
		$sql="INSERT INTO pages_action_table VALUES (23, 'addcrossproduct', '', 'Add Cross Products')"; 
		$result=mysql_query($sql);
		$sql="INSERT INTO pages_action_table VALUES (24, 'addattributes', '', 'To Add Attributes')"; 
		$result=mysql_query($sql);
		$sql="INSERT INTO pages_action_table VALUES (25, 'addattributevalues', '', 'To Add Attribute Values')"; 
		$result=mysql_query($sql);
		$sql="INSERT INTO pages_action_table VALUES (26, 'skin', '', 'To Add Skins')"; 
		$result=mysql_query($sql);
		$sql="INSERT INTO pages_action_table VALUES (27, 'footersettings', '', 'Modify Footer Settings')"; 
		$result=mysql_query($sql);
		$sql="INSERT INTO pages_action_table VALUES (28, 'contents', '', 'Content Management')"; 
		$result=mysql_query($sql);
		$sql="INSERT INTO pages_action_table VALUES (29, 'Custom Header', '', 'To create a Custom Header')"; 
		$result=mysql_query($sql);
		$sql="INSERT INTO pages_action_table VALUES (30, 'aboutus', '', 'To change about us content')"; 
		$result=mysql_query($sql);
		$sql="INSERT INTO pages_action_table VALUES (31, 'showcontents', '', 'Show Contents')"; 
		$result=mysql_query($sql);
		$sql="INSERT INTO pages_action_table VALUES (32, 'mailmessages', '', 'To edit mail messages')"; 
		$result=mysql_query($sql);
		$sql="INSERT INTO pages_action_table VALUES (34, 'managecategory', '', 'To add a Category')"; 
		$result=mysql_query($sql);
		$sql="INSERT INTO pages_action_table VALUES (35, 'showmain', '', 'Show Main Category List')"; 
		$result=mysql_query($sql);
		$sql="INSERT INTO pages_action_table VALUES (36, 'showsub', '', 'Show Sub Category List ')"; 
		$result=mysql_query($sql);
		$sql="INSERT INTO pages_action_table VALUES (37, 'manageproducts', '', 'To View Product List')"; 
		$result=mysql_query($sql);
		$sql="INSERT INTO pages_action_table VALUES (38, 'selectfeatured', '', 'To Select Featured Products')"; 
		$result=mysql_query($sql);
		$sql="INSERT INTO pages_action_table VALUES (39, 'aprodetail', '', 'To View Product Detail')"; 
		$result=mysql_query($sql);
		$sql="INSERT INTO pages_action_table VALUES (40, 'googleproduct', '', 'To change the Google Base')"; 
		$result=mysql_query($sql);
		$sql="INSERT INTO pages_action_table VALUES (41, 'cse', '', 'Comparison Shopping Engine')"; 
		$result=mysql_query($sql);
		$sql="INSERT INTO pages_action_table VALUES (42, 'adminpayment', '', 'Payment Gateways Management')"; 
		$result=mysql_query($sql);
		$sql="INSERT INTO pages_action_table VALUES (43, 'subadminmgt', '', 'Sub Admin Management')"; 
		$result=mysql_query($sql);
		$sql="INSERT INTO pages_action_table VALUES (44, 'subadminrole', '', 'To Change Sub Admin Role')"; 
		$result=mysql_query($sql);
		$sql="INSERT INTO pages_action_table VALUES (45, 'orderstatus', '', 'Order Status Management')"; 
		$result=mysql_query($sql);
		$sql="INSERT INTO pages_action_table VALUES (46, 'disporders', '', 'Orders Management')"; 
		$result=mysql_query($sql);
		$sql="INSERT INTO pages_action_table VALUES (47, 'displatestorders', '', 'Display Latest Orders')"; 
		$result=mysql_query($sql);
		$sql="INSERT INTO pages_action_table VALUES (48, 'productentry', '', 'To Add New Products')"; 
		$result=mysql_query($sql);
		$sql="INSERT INTO pages_action_table VALUES (49, 'msrpmgt', '', 'Product Price Management')"; 
		$result=mysql_query($sql);
		$sql="INSERT INTO pages_action_table VALUES (50, 'pagemgt', '', 'Page Management')"; 
		$result=mysql_query($sql);
		$sql="INSERT INTO pages_action_table VALUES (51, 'productinventory', '', 'Product Inventory Management')"; 
		$result=mysql_query($sql);
		$sql="INSERT INTO pages_action_table VALUES (52, 'productfeatures', '', 'Product Features Management')"; 
		$result=mysql_query($sql);
		$sql="INSERT INTO pages_action_table VALUES (53, 'showshipmenttracker', '', 'Shipments Setting')"; 
		$result=mysql_query($sql);
		$sql="INSERT INTO pages_action_table VALUES (54, 'createpromotionalcodes', '', 'Coupon Codes Management')"; 
		$result=mysql_query($sql);
		$sql="INSERT INTO pages_action_table VALUES (55, 'mostsearchedkeywords', '', 'View Most Searched Keywords')"; 
		$result=mysql_query($sql);
		$sql="INSERT INTO pages_action_table VALUES (56, 'bulkupload', '', 'Products Bulk Upload')"; 
		$result=mysql_query($sql);
		$sql="INSERT INTO pages_action_table VALUES (57, 'catbulkupload', '', 'Category Bulk Upload')"; 
		$result=mysql_query($sql);
		$sql="INSERT INTO pages_action_table VALUES (58, 'faq', '', 'To Add FAQs')"; 
		$result=mysql_query($sql);
		$sql="INSERT INTO pages_action_table VALUES (59, 'activity', '', 'Admin Activity Report')"; 
		$result=mysql_query($sql);
		$sql="INSERT INTO pages_action_table VALUES (60, 'addUserAccount', '', 'Create Customer Account')"; 
		$result=mysql_query($sql);
		$sql="INSERT INTO pages_action_table VALUES (61, 'userorder', '', 'Create User Order')"; 
		$result=mysql_query($sql);
		$sql="INSERT INTO pages_action_table VALUES (66, 'taxsettings', '', 'Tax Settings')"; 
		$result=mysql_query($sql);
		$sql="INSERT INTO pages_action_table VALUES (69, 'showcurrencylist', '', 'Currency Settings')"; 
		$result=mysql_query($sql);
		$sql="INSERT INTO pages_action_table VALUES (70, 'sitemap', '', 'Admin Site Map')"; 
		$result=mysql_query($sql);
		$sql="INSERT INTO pages_action_table VALUES(71, 'addcurrency', '', 'To Add a Currency')";
		$result=mysql_query($sql);
		$sql="INSERT INTO pages_action_table VALUES(72, 'editcurrency', '', 'To Modify a Currency Settings')";
		$result=mysql_query($sql);
		$sql="INSERT INTO pages_action_table VALUES(73, 'delcurrency', '', 'To Delete a Currency')";
		$result=mysql_query($sql);
		$sql="INSERT INTO pages_action_table VALUES(74, 'siteinfo', '', 'To View the PHP Information')";
		$result=mysql_query($sql);




		$sql="Drop table if exists payment_transactions_table";
		$result=mysql_query($sql);
		$sql="CREATE TABLE payment_transactions_table(pay_id  INT(12) NOT NULL PRIMARY KEY AUTO_INCREMENT,payment_gateway_id  INT(3) NOT NULL,paid_amount  real NOT NULL,transaction_id  VARCHAR(200) NOT NULL,transaction_date  datetime NOT NULL ,order_id  INT(11) NOT NULL)";
		$result=mysql_query($sql);


		$sql="Drop table if exists paymentgateways_table";
		$result=mysql_query($sql);
		$sql="CREATE TABLE paymentgateways_table(gateway_id  INT(3) NOT NULL PRIMARY KEY AUTO_INCREMENT,gateway_name  VARCHAR(200) NOT NULL,merchant_id  VARCHAR(100) NOT NULL,gateway_status  INT(1) NOT NULL,images  VARCHAR(200) NOT NULL)";
		$result=mysql_query($sql);
		$sql="INSERT INTO `paymentgateways_table` (`gateway_id`, `gateway_name`, `merchant_id`, `gateway_status`, `images`) VALUES
		(4, 'google-checkout', '', 1, 'images/google.jpg'),
		(3, 'e-gold', '', 0, 'images/egold.jpg'),
		(2, 'e-bullion', '', 0, 'images/ebullion.jpg'),
		(1, 'PayPal', '', 1, 'images/paypal.jpg'),
		(5, 'Authorize.net', '', 1, 'images/authorize.gif'),
		(6, '2checkout', '', 1, 'images/2checkout.gif'),
		(7, 'worldpay', '', 1, 'images/worldpay.gif'),
		(8, 'Pay in Store', '', 1, 'images/payinstore.gif'),
		(9, 'Cash on Delivery', '', 1, 'images/cashondelivery.gif'),
		(10, 'Paymate', '', 1, 'images/paymate.gif'),
		(11, 'Moneybookers', '', 1, 'images/moneybookers.jpg'),
		(12, 'PSIGate', '', 1, 'images/psigate.gif'),
		(13, 'Strompay', '', 1, 'images/strompay.jpg'),
		(14, 'Alertpay', '', 1, 'images/alertpay.jpeg'),
		(15, 'Yourpay', '', 1, 'images/yourpay.jpeg'),
		(16, 'iTransact', '', 1, 'images/itransact.gif'),
		(17, 'Bluepay', '', 1, 'images/bluepay.jpeg'),
		(18, 'Safepay', '', 1, 'images/safepay.gif')"; 
		$result=mysql_query($sql);


		


		$sql="Drop table if exists paymentgateways_settings_table";
		$result=mysql_query($sql);
		$sql="CREATE TABLE `paymentgateways_settings_table` (`pg_setting_id` int(9) NOT NULL PRIMARY KEY AUTO_INCREMENT,`gateway_id` int(5) NOT NULL,`setting_name` varchar(300) NOT NULL,`setting_values` varchar(200) NOT NULL,`help_text` text NOT NULL)";
		$result=mysql_query($sql);
		$sql="INSERT INTO `paymentgateways_settings_table` (`pg_setting_id`, `gateway_id`, `setting_name`, `setting_values`, `help_text`) VALUES 
		(1,5,'API Login ID','','The Login Id used for Authorize.Net Payment Gateway'),
		(2,5,'Transaction Key','','The Transaction Key used for Authorize.Net Login'),
		(4,5,'Password','','To be Provided Only when the Password Required Mode is Enabled.'),
		(7,4,'Merchant ID','','The Merchant Id Used for Google Check Out'),
		(10,1,'Merchant ID','','The Merchant Id Used for Paypal'),
		(11,6,'Merchant ID','','The Merchant Id Used for 2Check Out'),
		(12,7,'Merchant ID','','The Merchant Id Used for World Pay'),
		(13,10,'Merchant ID','','The Merchant Id Used for Paymate'),
		(14,11,'Merchant ID','','The Merchant Id Used for Money Bookers'),
		(15,12,'Merchant ID','','The Merchant Id Used for PSI Gate'),
		(16,13,'Merchant ID','','The Merchant Id Used for Strom Pay'),
		(17,14,'Merchant ID','','The Merchant Id Used for Alert Pay'),
		(18,15,'Merchant ID','','The Merchant Id Used for Your Pay'),
		(19,16,'Merchant ID','','The Merchant Id Used for Itransact'),
		(20,17,'Merchant ID','','The Merchant Id Used for Blue Pay'),
		(21,18,'Merchant ID','','The Merchant Id Used for Safe Pay')";
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
		$sql="INSERT INTO privacypolicy_table VALUES (1, '<p><strong>Privacy Policy content comes here<br /></strong></p>')"; 
		$result=mysql_query($sql);

		$sql="Drop table if exists product_attrib_values_table";
		$result=mysql_query($sql);
		$sql="CREATE TABLE product_attrib_values_table(product_attrib_value_id  INT(15) NOT NULL PRIMARY KEY AUTO_INCREMENT,product_id  INT(15) NOT NULL,attrib_value_id  INT(15) NOT NULL)";
		$result=mysql_query($sql);


		$sql="Drop table if exists product_images_table";
		$result=mysql_query($sql);
		$sql="CREATE TABLE product_images_table(product_images_id  INT(20) NOT NULL PRIMARY KEY AUTO_INCREMENT,product_id  INT(20) NOT NULL,image_path  VARCHAR(200) NOT NULL,large_image_path VARCHAR(200) NOT NULL,thumb_image_path  VARCHAR(200) NOT NULL,type  VARCHAR(40) NOT NULL)";
		$result=mysql_query($sql);
		$sql="INSERT INTO `product_images_table` (`product_images_id`, `product_id`, `image_path`, `large_image_path`, `thumb_image_path`, `type`) VALUES
		(1, 1, 'images/products/shoes_is93535.jpg', 'images/products/large_image/shoes_is93535.jpg', 'images/products/thumb/shoes_is93535.jpg', 'main'),
		(2, 2, 'images/products/2013-03-02-122103analog-watches03.jpg', 'images/products/large_image/2013-03-02-122103analog-watches03.jpg', 'images/products/thumb/2013-03-02-122103analog-watches03.jpg', 'main');
		";
		$result=mysql_query($sql);



		$sql="Drop table if exists product_inventory_table";
		$result=mysql_query($sql);
		$sql="CREATE TABLE product_inventory_table(inventory_id  INT(20) NOT NULL PRIMARY KEY AUTO_INCREMENT,product_id  INT(20) NOT NULL,rol  INT(15) NOT NULL,soh  INT(20) NOT NULL)";
		$result=mysql_query($sql);
		$sql="INSERT INTO `product_inventory_table` (`inventory_id`, `product_id`, `rol`, `soh`) VALUES
		(1, 1, 10, 150),
		(2, 2, 10, 20);";
		$result=mysql_query($sql);



		$sql="Drop table if exists product_reviews_table";
		$result=mysql_query($sql);
		$sql="CREATE TABLE product_reviews_table(review_id  INT(20) NOT NULL PRIMARY KEY AUTO_INCREMENT,product_id  INT(20) NOT NULL,user_id  INT(20) NOT NULL,review_caption  VARCHAR(300) NOT NULL,review_txt  TEXT(65535) NOT NULL ,review_date  date NOT NULL ,rating  INT(5) NOT NULL,review_status  INT(1) NOT NULL)";
		$result=mysql_query($sql);
		$sql="INSERT INTO `product_reviews_table` (`review_id`, `product_id`, `user_id`, `review_caption`, `review_txt`, `review_date`, `rating`, `review_status`) VALUES
		(1, 12, 1, 'Fine', 'Fine', '2013-03-05', 3, 0)";
		$result=mysql_query($sql);



		$sql="Drop table if exists products_table";
		$result=mysql_query($sql);
		$sql="CREATE TABLE IF NOT EXISTS `products_table` (
		`product_id` int(25) NOT NULL AUTO_INCREMENT,
		`category_id` varchar(100) NOT NULL,
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
		`product_status` int(1) NOT NULL COMMENT '1=>new products,2=>discount product',
		PRIMARY KEY (`product_id`)
		) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1";
		$result=mysql_query($sql);
		$sql="INSERT INTO `products_table` (`product_id`, `category_id`, `sku`, `title`, `alias`, `description`, `brand`, `model`, `msrp`, `price`, `cse_enabled`, `cse_key`, `weight`, `dimension`, `thumb_image`, `image`, `large_image_path`, `shipping_cost`, `status`, `tag`, `meta_desc`, `meta_keywords`, `intro_date`, `is_featured`, `digital`, `gift`, `digital_product_path`, `product_status`) VALUES
		(1, '18', '10', 'shoes', 'shoes', '', '', '', 150, 100, 0, '', '', '', 'images/products/thumb/shoes_is93535.jpg', 'images/products/shoes_is93535.jpg', 'images/products/large_image/shoes_is93535.jpg', 0, 1, '', '', '', '0000-00-00', 1, 0, 0, '', 0),
		(2, '11', '10', 'watches', 'watches', '', '', '', 800, 500, 0, '', '', '', 'images/products/thumb/2013-03-02-122103analog-watches03.jpg', 'images/products/2013-03-02-122103analog-watches03.jpg', 'images/products/large_image/2013-03-02-122103analog-watches03.jpg', 0, 1, '', '', '', '0000-00-00', 0, 0, 0, '', 0);
		";
		$result=mysql_query($sql);

		$sql="Drop table if exists search_tags_table";
		$result=mysql_query($sql);
		$sql="CREATE TABLE search_tags_table(id  INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,search_tag  VARCHAR(250) NOT NULL,search_count  INT(11) NOT NULL)";
		$result=mysql_query($sql);
		


		$sql="Drop table if exists shipments_master_table";
		$result=mysql_query($sql);
		$sql="CREATE TABLE shipments_master_table(shipment_id  INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,shipment_name  VARCHAR(200) NOT NULL,status  INT(11) NOT NULL)";
		$result=mysql_query($sql);
		$sql="INSERT INTO `shipments_master_table` (`shipment_id`, `shipment_name`, `status`) VALUES
		(1, 'DHL', 1),
		(2, 'Fedex', 1),
		(3, 'United Parcel Service', 1),
		(4, 'US Postal Service', 1),
		(5, 'Canada Post', 1),
		(6, 'Australia Post ', 1),
		(7, 'Intershipper', 1),
		(8, 'City Link', 1)";
		$result=mysql_query($sql);

		$sql="Drop table if exists shopping_cart_products_table";
		$result=mysql_query($sql);
		$sql="CREATE TABLE shopping_cart_products_table(id INT(20) NOT NULL PRIMARY KEY AUTO_INCREMENT ,cart_id  INT(25) NOT NULL,product_id  VARCHAR(100) NOT NULL,product_qty  INT(10) NOT NULL,date_added  date NOT NULL ,product_unit_price  real NOT NULL,shipping_cost  real NOT NULL,original_price  real NOT NULL,gift_product INT(11) NOT NULL)";
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
		$sql="INSERT INTO `skins_table` (`skin_id`, `skin_name`, `skin_status`) VALUES(1, 'default', 1),(2, 'blue', 0),(3, 'black', 0),(4, 'cyan', 0)";
		$result=mysql_query($sql);


		$sql="Drop table if exists social_links_table";
		$result=mysql_query($sql);
		$sql="CREATE TABLE social_links_table(social_link_id  INT(20) NOT NULL PRIMARY KEY AUTO_INCREMENT,social_link_title  VARCHAR(200) NOT NULL,social_link_logo  VARCHAR(200) NOT NULL,social_link_url VARCHAR(200) NOT NULL,status INT(5) NOT NULL)";
		$result=mysql_query($sql);
		$sql="INSERT INTO `social_links_table` (`social_link_id`, `social_link_title`, `social_link_logo`, `social_link_url`, `status`) VALUES
		(1, 'facebook', 'images/sociallink/2013-03-28-125522fb.png', 'http://facebook.com/', 1),
		(2, 'twitter', 'images/sociallink/2013-03-28-125550tw.png', 'http://twitter.com/', 1)";
		$result=mysql_query($sql);	



		$sql="Drop table if exists social_link_content_table";
		$result=mysql_query($sql);
		$sql="CREATE TABLE social_link_content_table(content_id  INT(20) NOT NULL PRIMARY KEY AUTO_INCREMENT,content_title  VARCHAR(240) NOT NULL,content_desc TEXT(65535) NOT NULL)";
		$result=mysql_query($sql);
		$facebook='<ol><li>On Zeuscart V4, you can use click <strong><span style="color: #000000;">Login with Facebook</span></strong>, this will allow us to register your&nbsp;Facebook&nbsp;account on our website.</li><li>The second step, Click the "<span style="color: #000000;"><strong>Allow</strong></span>" Button, which will save your Name and Email on our website. No password is required as long as you are logged in Facebook.</li><li><strong>You will automatically be logged on to our website via Facebook. For security purposes, we recommend you log out your Facebook account once done.</strong></li></ol><p>Thanks &amp; Regards<br />Zeuscart Team.</p>';
		$sql="INSERT INTO `social_link_content_table` (`content_id`, `content_title`, `content_desc`) VALUES
		(1, 'Facebook Alert', '<ol><li>On Zeuscart V4, you can use click <strong><span style=\"color: #000000;\">Login with Facebook</span></strong>, this will allow us to register your&nbsp;Facebook&nbsp;account on our website.</li><li>The second step, Click the \"<span style=\"color: #000000;\"><strong>Allow</strong></span>\" Button, which will save your Name and Email on our website. No password is required as long as you are logged in Facebook.</li><li><strong>You will automatically be logged on to our website via Facebook. For security purposes, we recommend you log out your Facebook account once done.</strong></li></ol><p>Thanks &amp; Regards<br />Zeuscart Team.</p>')"; 
		$result=mysql_query($sql);

		$sql="Drop table if exists subadmin_roles_table";
		$result=mysql_query($sql);
		$sql="CREATE TABLE subadmin_roles_table(subadmin_role_id  INT(20) NOT NULL PRIMARY KEY AUTO_INCREMENT,subadmin_id  INT(20) NOT NULL,subadmin_page_id  INT(20) NOT NULL,subadmin_rights  INT(1) NOT NULL)";
		$result=mysql_query($sql);


		$sql="Drop table if exists subadmin_table";
		$result=mysql_query($sql);
		$sql="CREATE TABLE subadmin_table(subadmin_id  INT(20) NOT NULL PRIMARY KEY AUTO_INCREMENT,subadmin_name  VARCHAR(200) NOT NULL,subadmin_password  VARCHAR(200) NOT NULL,subadmin_email_id  VARCHAR(200) NOT NULL,subadmin_status  INT(1) NOT NULL)";
		$result=mysql_query($sql);
		$sql="INSERT INTO `subadmin_table` (`subadmin_id`, `subadmin_name`, `subadmin_password`, `subadmin_email_id`, `subadmin_status`) VALUES
		(1, 'adminsub', 'MTIzNDU2', 'subadmin@ajsquare.com', 0)";
		$result=mysql_query($sql);


		$sql="Drop table if exists tax_master_table";
		$result=mysql_query($sql);
		$sql="CREATE TABLE tax_master_table (id int(11) NOT NULL,description varchar(200) NOT NULL,status int(11) NOT NULL,based_on_address varchar(200) NOT NULL)";
		$result=mysql_query($sql);
		$sql="INSERT INTO tax_master_table (id, description, status, based_on_address) VALUES(1, 'No Tax For Whole Site', 0, '')"; 
		$result=mysql_query($sql);
		$sql="INSERT INTO tax_master_table (id, description, status, based_on_address) VALUES(2, 'Tax For Specific Countries', 0, '')"; 
		$result=mysql_query($sql);
		$sql="INSERT INTO tax_master_table (id, description, status, based_on_address) VALUES(3, 'Same Tax For Whole Site', 1, '')"; 
		$result=mysql_query($sql);



		$sql="Drop table if exists termsconditions_table";
		$result=mysql_query($sql);
		$sql="CREATE TABLE termsconditions_table(termsid  INT(4) NOT NULL PRIMARY KEY AUTO_INCREMENT,termscontent  TEXT(65535) NOT NULL )";
		$result=mysql_query($sql);
		
		$sql="INSERT INTO `termsconditions_table` VALUES (1, '<p>Terms &amp; Conditions text comes here.....</p>')"; 
		$result=mysql_query($sql);


		$sql="Drop table if exists timezone_table";
		$result=mysql_query($sql);
		$sql="CREATE TABLE timezone_table(tz_id  INT(15) NOT NULL PRIMARY KEY AUTO_INCREMENT,tz_code  VARCHAR(10) NOT NULL,tz_coords  VARCHAR(50) NOT NULL,tz_timezone  VARCHAR(50) NOT NULL,tz_comments  TEXT(65535) NOT NULL )";
		$result=mysql_query($sql);
		$sql="INSERT INTO timezone_table VALUES('1','AD','+4230+00131','Europe/Andorra',''),('2','AE','+2518+05518','Asia/Dubai',''),('3','AF','+3431+06912','Asia/Kabul',''),('4','AG','+1703-06148','America/Antigua',''),('5','AI','+1812-06304','America/Anguilla',''),('6','AL','+4120+01950','Europe/Tirane',''),('7','AM','+4011+04430','Asia/Yerevan',''),('8','AN','+1211-06900','America/Curacao',''),('9','AO','-0848+01314','Africa/Luanda',''),('10','AQ','-7750+16636','Antarctica/McMurdo','McMurdo Station, Ross Island'),('11','AQ','-9000+00000','Antarctica/South_Pole','Amundsen-Scott Station, South Pole'),('12','AQ','-6448-06406','Antarctica/Palmer','Palmer Station, Anvers Island'),('13','AQ','-6736+06253','Antarctica/Mawson','Mawson Station, Holme Bay'),('14','AQ','-6835+07758','Antarctica/Davis','Davis Station, Vestfold Hills'),('15','AQ','-6617+11031','Antarctica/Casey','Casey Station, Bailey Peninsula'),('16','AQ','-6640+14001','Antarctica/DumontDUrville','Dumont-d Urville Base, Terre Adelie'),('17','AR','-3436-05827','America/Buenos_Aires','E Argentina (BA, DF, SC, TF)'),('18','AR','-3257-06040','America/Rosario','NE Argentina (SF, ER, CN, MN, CC, FM, LP, CH)'),('19','AR','-3124-06411','America/Cordoba','W Argentina (CB, SA, TM, LR, SJ, SL, NQ, RN)'),('20','AR','-2411-06518','America/Jujuy','Jujuy (JY)'),('21','AR','-2828-06547','America/Catamarca','Catamarca (CT)'),('22','AR','-3253-06849','America/Mendoza','Mendoza (MZ)'),('23','AS','-1416-17042','Pacific/Pago_Pago',''),('24','AT','+4813+01620','Europe/Vienna',''),('25','AU','-3133+15905','Australia/Lord_Howe','Lord Howe Island'),('26','AU','-4253+14719','Australia/Hobart','Tasmania'),('27','AU','-3749+14458','Australia/Melbourne','Victoria'),('28','AU','-3352+15113','Australia/Sydney','New South Wales - most locations'),('29','AU','-3157+14127','Australia/Broken_Hill','New South Wales - Broken Hill'),('30','AU','-2728+15302','Australia/Brisbane','Queensland - most locations'),('31','AU','-2016+14900','Australia/Lindeman','Queensland - Holiday Islands'),('32','AU','-3455+13835','Australia/Adelaide','South Australia'),('33','AU','-1228+13050','Australia/Darwin','Northern Territory'),('34','AU','-3157+11551','Australia/Perth','Western Australia'),('35','AW','+1230-06858','America/Aruba',''),('36','AZ','+4023+04951','Asia/Baku',''),('37','BA','+4352+01825','Europe/Sarajevo',''),('38','BB','+1306-05937','America/Barbados',''),('39','BD','+2343+09025','Asia/Dacca',''),('40','BE','+5050+00420','Europe/Brussels',''),('41','BF','+1222-00131','Africa/Ouagadougou',''),('42','BG','+4241+02319','Europe/Sofia',''),('43','BH','+2623+05035','Asia/Bahrain',''),('44','BI','-0323+02922','Africa/Bujumbura',''),('45','BJ','+0629+00237','Africa/Porto-Novo',''),('46','BM','+3217-06446','Atlantic/Bermuda',''),('47','BN','+0456+11455','Asia/Brunei',''),('48','BO','-1630-06809','America/La_Paz',''),('49','BR','-0351-03225','America/Noronha','Fernando de Noronha'),('50','BR','-0127-04829','America/Belem','Amapa, E Para'),('51','BR','-0343-03830','America/Fortaleza','NE Brazil (MA, PI, CE, RN, PR, PE)'),('52','BR','-0712-04812','America/Araguaina','Tocantins'),('53','BR','-0940-03543','America/Maceio','Alagoas, Sergipe'),('54','BR','-2332-04637','America/Sao_Paulo','S & SE Brazil (BA, GO, DF, MG, ES, RJ, SP, PR, SC, RS)'),('55','BR','-1535-05605','America/Cuiaba','Mato Grosso, Mato Grosso do Sul'),('56','BR','-0846-06354','America/Porto_Velho','W Para, Rondonia, Roraima'),('57','BR','-0308-06001','America/Manaus','Amazonas'),('58','BR','-0934-06731','America/Porto_Acre','Acre'),('59','BS','+2505-07721','America/Nassau',''),('60','BT','+2728+08939','Asia/Thimbu',''),('61','BW','-2545+02555','Africa/Gaborone',''),('62','BY','+5354+02734','Europe/Minsk',''),('63','BZ','+1730-08812','America/Belize',''),('64','CA','+4734-05243','America/St_Johns','Newfoundland Island'),('65','CA','+4439-06336','America/Halifax','Atlantic Time - Nova Scotia (most places), NB, W Labrador, E Quebec & PEI'),('66','CA','+4612-05957','America/Glace_Bay','Atlantic Time - Nova Scotia - places that did not observe DST 1966-1971'),('67','CA','+5320-06025','America/Goose_Bay','Atlantic Time - E Labrador'),('68','CA','+6608-06544','America/Pangnirtung','Atlantic Time - Northwest Territories'),('69','CA','+4531-07334','America/Montreal','Eastern Time - Ontario & Quebec - most locations'),('70','CA','+4901-08816','America/Nipigon','Eastern Time - Ontario & Quebec - places that did not observe DST 1967-1973'),('71','CA','+4823-08915','America/Thunder_Bay','Eastern Time - Thunder Bay, Ontario'),('72','CA','+6344-06828','America/Iqaluit','Eastern Time - Northwest Territories'),('73','CA','+4953-09709','America/Winnipeg','Central Time - Manitoba & west Ontario'),('74','CA','+4843-09429','America/Rainy_River','Central Time - Rainy River & Fort Frances, Ontario'),('75','CA','+6245-09210','America/Rankin_Inlet','Central Time - Northwest Territories'),('76','CA','+5024-10439','America/Regina','Central Standard Time - Saskatchewan - most locations'),('77','CA','+5017-10750','America/Swift_Current','Central Standard Time - Saskatchewan - midwest'),('78','CA','+5333-11328','America/Edmonton','Mountain Time - Alberta, east British Columbia & west Saskatchewan'),('79','CA','+6227-11421','America/Yellowknife','Mountain Time - central Northwest Territories'),('80','CA','+6825-11330','America/Inuvik','Mountain Time - west Northwest Territories'),('81','CA','+5946-12014','America/Dawson_Creek','Mountain Standard Time - Dawson Creek & Fort Saint John, British Columbia'),('82','CA','+4916-12307','America/Vancouver','Pacific Time - west British Columbia'),('83','CA','+6043-13503','America/Whitehorse','Pacific Time - south Yukon'),('84','CA','+6404-13925','America/Dawson','Pacific Time - north Yukon'),('85','CC','-1210+09655','Indian/Cocos',''),('86','CD','-0418+01518','Africa/Kinshasa','west Dem. Rep. of Congo'),('87','CD','-1140+02728','Africa/Lubumbashi','east Dem. Rep. of Congo'),('88','CF','+0422+01835','Africa/Bangui',''),('89','CG','-0416+01517','Africa/Brazzaville',''),('90','CH','+4723+00832','Europe/Zurich',''),('91','CI','+0519-00402','Africa/Abidjan',''),('92','CK','-2114-15946','Pacific/Rarotonga',''),('93','CL','-3327-07040','America/Santiago','mainland'),('94','CL','-2710-10927','Pacific/Easter','Easter Island'),('95','CM','+0403+00942','Africa/Douala',''),('96','CN','+4545+12641','Asia/Harbin','north Manchuria'),('97','CN','+3114+12128','Asia/Shanghai','China coast'),('98','CN','+2217+11409','Asia/Hong_Kong','Hong Kong'),('99','CN','+2934+10635','Asia/Chungking','China mountains'),('100','CN','+4348+08735','Asia/Urumqi','Tibet & Xinjiang'),('101','CN','+3929+07559','Asia/Kashgar','Eastern Turkestan'),('102','CO','+0436-07405','America/Bogota',''),('103','CR','+0956-08405','America/Costa_Rica',''),('104','CU','+2308-08222','America/Havana',''),('105','CV','+1455-02331','Atlantic/Cape_Verde',''),('106','CX','-1025+10543','Indian/Christmas',''),('107','CY','+3510+03322','Asia/Nicosia',''),('108','CZ','+5005+01426','Europe/Prague',''),('109','DE','+5230+01322','Europe/Berlin',''),('110','DJ','+1136+04309','Africa/Djibouti',''),('111','DK','+5540+01235','Europe/Copenhagen',''),('112','DM','+1518-06124','America/Dominica',''),('113','DO','+1828-06954','America/Santo_Domingo',''),('114','DZ','+3647+00303','Africa/Algiers',''),('115','EC','-0210-07950','America/Guayaquil','mainland'),('116','EC','-0054-08936','Pacific/Galapagos','Galapagos Islands'),('117','EE','+5925+02445','Europe/Tallinn',''),('118','EG','+3003+03115','Africa/Cairo',''),('119','EH','+2709-01312','Africa/El_Aaiun',''),('120','ER','+1520+03853','Africa/Asmera',''),('121','ES','+4024-00341','Europe/Madrid','mainland'),('122','ES','+3553-00519','Africa/Ceuta','Ceuta & Melilla'),('123','ES','+2806-01524','Atlantic/Canary','Canary Islands'),('124','ET','+0902+03842','Africa/Addis_Ababa',''),('125','FI','+6010+02458','Europe/Helsinki',''),('126','FJ','-1808+17825','Pacific/Fiji',''),('127','FK','-5142-05751','Atlantic/Stanley',''),('128','FM','+0931+13808','Pacific/Yap','Yap'),('129','FM','+0725+15147','Pacific/Truk','Truk (Chuuk)'),('130','FM','+0658+15813','Pacific/Ponape','Ponape (Pohnpei)'),('131','FM','+0519+16259','Pacific/Kosrae','Kosrae'),('132','FO','+6201-00646','Atlantic/Faeroe',''),('133','FR','+4852+00220','Europe/Paris',''),('134','GA','+0023+00927','Africa/Libreville',''),('135','GB','+512830-0001845','Europe/London','Great Britain'),('136','GB','+5435-00555','Europe/Belfast','Northern Ireland'),('137','GD','+1203-06145','America/Grenada',''),('138','GE','+4143+04449','Asia/Tbilisi',''),('139','GF','+0456-05220','America/Cayenne',''),('140','GH','+0533-00013','Africa/Accra',''),('141','GI','+3608-00521','Europe/Gibraltar',''),('142','GL','+7030-02215','America/Scoresbysund','east Greenland'),('143','GL','+6411-05144','America/Godthab','southwest Greenland'),('144','GL','+7634-06847','America/Thule','northwest Greenland'),('145','GM','+1328-01639','Africa/Banjul',''),('146','GN','+0931-01343','Africa/Conakry',''),('147','GP','+1614-06132','America/Guadeloupe',''),('148','GQ','+0345+00847','Africa/Malabo',''),('149','GR','+3758+02343','Europe/Athens',''),('150','GS','-5416-03632','Atlantic/South_Georgia',''),('151','GT','+1438-09031','America/Guatemala',''),('152','GU','+1328+14445','Pacific/Guam',''),('153','GW','+1151-01535','Africa/Bissau',''),('154','GY','+0648-05810','America/Guyana',''),('155','HN','+1406-08713','America/Tegucigalpa',''),('156','HR','+4548+01558','Europe/Zagreb',''),('157','HT','+1832-07220','America/Port-au-Prince',''),('158','HU','+4730+01905','Europe/Budapest',''),('159','ID','-0610+10648','Asia/Jakarta','Java & Sumatra'),('160','ID','-0507+11924','Asia/Ujung_Pandang','Borneo & Celebes'),('161','ID','-0232+14042','Asia/Jayapura','Irian Jaya & the Moluccas'),('162','IE','+5320-00615','Europe/Dublin',''),('163','IL','+3146+03514','Asia/Jerusalem',''),('164','IN','+2232+08822','Asia/Calcutta',''),('165','IO','-0720+07225','Indian/Chagos',''),('166','IQ','+3321+04425','Asia/Baghdad',''),('167','IR','+3540+05126','Asia/Tehran',''),('168','IS','+6409-02151','Atlantic/Reykjavik',''),('169','IT','+4154+01229','Europe/Rome',''),('170','JM','+1800-07648','America/Jamaica',''),('171','JO','+3157+03556','Asia/Amman',''),('172','JP','+353916+1394441','Asia/Tokyo',''),('173','KE','-0117+03649','Africa/Nairobi',''),('174','KG','+4254+07436','Asia/Bishkek',''),('175','KH','+1133+10455','Asia/Phnom_Penh',''),('176','KI','+0125+17300','Pacific/Tarawa','Gilbert Islands'),('177','KI','-0308-17105','Pacific/Enderbury','Phoenix Islands'),('178','KI','+0152-15720','Pacific/Kiritimati','Line Islands'),('179','KM','-1141+04316','Indian/Comoro',''),('180','KN','+1718-06243','America/St_Kitts',''),('181','KP','+3901+12545','Asia/Pyongyang',''),('182','KR','+3733+12658','Asia/Seoul',''),('183','KW','+2920+04759','Asia/Kuwait',''),('184','KY','+1918-08123','America/Cayman',''),('185','KZ','+4315+07657','Asia/Almaty','east Kazakhstan'),('186','KZ','+5017+05710','Asia/Aqtobe','central Kazakhstan'),('187','KZ','+4431+05016','Asia/Aqtau','west Kazakhstan'),('188','LA','+1758+10236','Asia/Vientiane',''),('189','LB','+3353+03530','Asia/Beirut',''),('190','LC','+1401-06100','America/St_Lucia',''),('191','LI','+4709+00931','Europe/Vaduz',''),('192','LK','+0656+07951','Asia/Colombo',''),('193','LR','+0618-01047','Africa/Monrovia',''),('194','LS','-2928+02730','Africa/Maseru',''),('195','LT','+5441+02519','Europe/Vilnius',''),('196','LU','+4936+00609','Europe/Luxembourg',''),('197','LV','+5657+02406','Europe/Riga',''),('198','LY','+3254+01311','Africa/Tripoli',''),('199','MA','+3339-00735','Africa/Casablanca',''),('200','MC','+4342+00723','Europe/Monaco',''),('201','MD','+4700+02850','Europe/Chisinau',''),('202','MG','-1855+04731','Indian/Antananarivo',''),('203','MH','+0709+17112','Pacific/Majuro','most locations'),('204','MH','+0905+16720','Pacific/Kwajalein','Kwajalein'),('205','MK','+4159+02126','Europe/Skopje',''),('206','ML','+1239-00800','Africa/Bamako','southwest Mali'),('207','ML','+1446-00301','Africa/Timbuktu','northeast Mali'),('208','MM','+1647+09610','Asia/Rangoon',''),('209','MN','+4755+10653','Asia/Ulan_Bator',''),('210','MO','+2214+11335','Asia/Macao',''),('211','MP','+1512+14545','Pacific/Saipan',''),('212','MQ','+1436-06105','America/Martinique',''),('213','MR','+1806-01557','Africa/Nouakchott',''),('214','MS','+1644-06213','America/Montserrat',''),('215','MT','+3554+01431','Europe/Malta',''),('216','MU','-2010+05730','Indian/Mauritius',''),('217','MV','+0410+07330','Indian/Maldives',''),('218','MW','-1547+03500','Africa/Blantyre',''),('219','MX','+2105-08646','America/Cancun','Eastern Time'),('220','MX','+1924-09909','America/Mexico_City','Central Time'),('221','MX','+2313-10625','America/Mazatlan','Mountain Time - most locations'),('222','MX','+2838-10605','America/Chihuahua','Mountain Time - Chihuahua'),('223','MX','+3152-11637','America/Ensenada','Pacific Time - most locations'),('224','MX','+3232-11701','America/Tijuana','Pacific Time - north Baja California'),('225','MY','+0310+10142','Asia/Kuala_Lumpur','peninsular Malaysia'),('226','MY','+0133+11020','Asia/Kuching','Sabah & Sarawak'),('227','MZ','-2558+03235','Africa/Maputo',''),('228','NA','-2234+01706','Africa/Windhoek',''),('229','NC','-2216+16530','Pacific/Noumea',''),('230','NE','+1331+00207','Africa/Niamey',''),('231','NF','-2903+16758','Pacific/Norfolk',''),('232','NG','+0627+00324','Africa/Lagos',''),('233','NI','+1209-08617','America/Managua',''),('234','NL','+5222+00454','Europe/Amsterdam',''),('235','NO','+5955+01045','Europe/Oslo',''),('236','NP','+2743+08519','Asia/Katmandu',''),('237','NR','-0031+16655','Pacific/Nauru',''),('238','NU','-1901+16955','Pacific/Niue',''),('239','NZ','-3652+17446','Pacific/Auckland','most locations'),('240','NZ','-4355-17630','Pacific/Chatham','Chatham Islands'),('241','OM','+2336+05835','Asia/Muscat',''),('242','PA','+0858-07932','America/Panama',''),('243','PE','-1203-07703','America/Lima',''),('244','PF','-1732-14934','Pacific/Tahiti','Society Islands'),('245','PF','-0900-13930','Pacific/Marquesas','Marquesas Islands'),('246','PF','-2308-13457','Pacific/Gambier','Gambier Islands'),('247','PG','-0930+14710','Pacific/Port_Moresby',''),('248','PH','+1435+12100','Asia/Manila',''),('249','PK','+2452+06703','Asia/Karachi',''),('250','PL','+5215+02100','Europe/Warsaw',''),('251','PM','+4703-05620','America/Miquelon',''),('252','PN','-2504-13005','Pacific/Pitcairn',''),('253','PR','+182806-0660622','America/Puerto_Rico',''),('254','PS','+3130+03428','Asia/Gaza',''),('255','PT','+3843-00908','Europe/Lisbon','mainland'),('256','PT','+3238-01654','Atlantic/Madeira','Madeira Islands'),('257','PT','+3744-02540','Atlantic/Azores','Azores'),('258','PW','+0720+13429','Pacific/Palau',''),('259','PY','-2516-05740','America/Asuncion',''),('260','QA','+2517+05132','Asia/Qatar',''),('261','RE','-2052+05528','Indian/Reunion',''),('262','RO','+4426+02606','Europe/Bucharest',''),('263','RU','+5443+02030','Europe/Kaliningrad','Moscow-01 - Kaliningrad'),('264','RU','+5545+03735','Europe/Moscow','Moscow+00 - west Russia'),('265','RU','+5312+05009','Europe/Samara','Moscow+01 - Caspian Sea'),('266','RU','+5651+06036','Asia/Yekaterinburg','Moscow+02 - Urals'),('267','RU','+5500+07324','Asia/Omsk','Moscow+03 - west Siberia'),('268','RU','+5502+08255','Asia/Novosibirsk','Moscow+03 - Novosibirsk'),('269','RU','+5601+09250','Asia/Krasnoyarsk','Moscow+04 - Yenisei River'),('270','RU','+5216+10420','Asia/Irkutsk','Moscow+05 - Lake Baikal'),('271','RU','+6200+12940','Asia/Yakutsk','Moscow+06 - Lena River'),('272','RU','+4310+13156','Asia/Vladivostok','Moscow+07 - Amur River'),('273','RU','+5934+15048','Asia/Magadan','Moscow+08 - Magadan & Sakhalin'),('274','RU','+5301+15839','Asia/Kamchatka','Moscow+09 - Kamchatka'),('275','RU','+6445+17729','Asia/Anadyr','Moscow+10 - Bering Sea'),('276','RW','-0157+03004','Africa/Kigali',''),('277','SA','+2438+04643','Asia/Riyadh',''),('278','SB','-0932+16012','Pacific/Guadalcanal',''),('279','SC','-0440+05528','Indian/Mahe',''),('280','SD','+1536+03232','Africa/Khartoum',''),('281','SE','+5920+01803','Europe/Stockholm',''),('282','SG','+0117+10351','Asia/Singapore',''),('283','SH','-1555-00542','Atlantic/St_Helena',''),('284','SI','+4603+01431','Europe/Ljubljana',''),('285','SJ','+7800+01600','Arctic/Longyearbyen','Svalbard'),('286','SJ','+7059-00805','Atlantic/Jan_Mayen','Jan Mayen'),('287','SK','+4809+01707','Europe/Bratislava',''),('288','SL','+0830-01315','Africa/Freetown',''),('289','SM','+4355+01228','Europe/San_Marino',''),('290','SN','+1440-01726','Africa/Dakar',''),('291','SO','+0204+04522','Africa/Mogadishu',''),('292','SR','+0550-05510','America/Paramaribo',''),('293','ST','+0020+00644','Africa/Sao_Tome',''),('294','SV','+1342-08912','America/El_Salvador',''),('295','SY','+3330+03618','Asia/Damascus',''),('296','SZ','-2618+03106','Africa/Mbabane',''),('297','TC','+2128-07108','America/Grand_Turk',''),('298','TD','+1207+01503','Africa/Ndjamena',''),('299','TF','-492110+0701303','Indian/Kerguelen',''),('300','TG','+0608+00113','Africa/Lome',''),('301','TH','+1345+10031','Asia/Bangkok',''),('302','TJ','+3835+06848','Asia/Dushanbe',''),('303','TK','-0922-17114','Pacific/Fakaofo',''),('304','TM','+3757+05823','Asia/Ashkhabad',''),('305','TN','+3648+01011','Africa/Tunis',''),('306','TO','-2110+17510','Pacific/Tongatapu',''),('307','TR','+4101+02858','Europe/Istanbul',''),('308','TT','+1039-06131','America/Port_of_Spain',''),('309','TV','-0831+17913','Pacific/Funafuti',''),('310','TW','+2503+12130','Asia/Taipei',''),('311','TZ','-0648+03917','Africa/Dar_es_Salaam',''),('312','UA','+5026+03031','Europe/Kiev','most locations'),('313','UA','+4457+03406','Europe/Simferopol','Crimea'),('314','UG','+0019+03225','Africa/Kampala',''),('315','UM','+1700-16830','Pacific/Johnston','Johnston Atoll'),('316','UM','+2813-17722','Pacific/Midway','Midway Islands'),('317','UM','+1917+16637','Pacific/Wake','Wake Island'),('318','US','+404251-0740023','America/New_York','Eastern Time'),('319','US','+421953-0830245','America/Detroit','Eastern Time - Michigan - most locations'),('320','US','+381515-0854534','America/Louisville','Eastern Time - Louisville, Kentucky'),('321','US','+394606-0860929','America/Indianapolis','Eastern Standard Time - Indiana - most locations'),('322','US','+382232-0862041','America/Indiana/Marengo','Eastern Standard Time - Indiana - Crawford County'),('323','US','+411745-0863730','America/Indiana/Knox','Eastern Standard Time - Indiana - Starke County'),('324','US','+384452-0850402','America/Indiana/Vevay','Eastern Standard Time - Indiana - Switzerland County'),('325','US','+415100-0873900','America/Chicago','Central Time'),('326','US','+450628-0873651','America/Menominee','Central Time - Michigan - Wisconsin border'),('327','US','+394421-1045903','America/Denver','Mountain Time'),('328','US','+433649-1161209','America/Boise','Mountain Time - south Idaho & east Oregon'),('329','US','+364708-1084111','America/Shiprock','Mountain Time - Navajo'),('330','US','+332654-1120424','America/Phoenix','Mountain Standard Time - Arizona'),('331','US','+340308-1181434','America/Los_Angeles','Pacific Time'),('332','US','+611305-1495401','America/Anchorage','Alaska Time'),('333','US','+581807-1342511','America/Juneau','Alaska Time - Alaska panhandle'),('334','US','+593249-1394338','America/Yakutat','Alaska Time - Alaska panhandle neck'),('335','US','+643004-1652423','America/Nome','Alaska Time - west Alaska'),('336','US','+515248-1763929','America/Adak','Aleutian Islands'),('337','US','+211825-1575130','Pacific/Honolulu','Hawaii'),('338','UY','-3453-05611','America/Montevideo',''),('339','UZ','+3940+06648','Asia/Samarkand','west Uzbekistan'),('340','UZ','+4120+06918','Asia/Tashkent','east Uzbekistan'),('341','VA','+4154+01227','Europe/Vatican',''),('342','VC','+1309-06114','America/St_Vincent',''),('343','VE','+1030-06656','America/Caracas',''),('344','VG','+1827-06437','America/Tortola',''),('345','VI','+1821-06456','America/St_Thomas',''),('346','VN','+1045+10640','Asia/Saigon',''),('347','VU','-1740+16825','Pacific/Efate',''),('348','WF','-1318-17610','Pacific/Wallis',''),('349','WS','-1350-17144','Pacific/Apia',''),('350','YE','+1245+04512','Asia/Aden',''),('351','YT','-1247+04514','Indian/Mayotte',''),('352','YU','+4450+02030','Europe/Belgrade',''),('353','ZA','-2615+02800','Africa/Johannesburg',''),('354','ZM','-1525+02817','Africa/Lusaka',''),('355','ZW','-1750+03103','Africa/Harare','')"; 
		$result=mysql_query($sql);


		$sql="Drop table if exists uniquetax_settings_table";
		$result=mysql_query($sql);
		$sql="CREATE TABLE uniquetax_settings_table (tax_name varchar(200) NOT NULL,based_on_amount varchar(200) NOT NULL,tax_rate_percent float NOT NULL)";
		$result=mysql_query($sql);
		$sql="INSERT INTO `uniquetax_settings_table` (`tax_name`, `based_on_amount`, `tax_rate_percent`) VALUES
		('General', 'subtotal_and_shipping', 0)";
		$result=mysql_query($sql);


		$sql="Drop table if exists users_table";
		$result=mysql_query($sql);
		$sql="CREATE TABLE users_table(user_id  INT(25) NOT NULL PRIMARY KEY AUTO_INCREMENT,user_display_name  VARCHAR(50) NOT NULL,user_fname  VARCHAR(50) NOT NULL,user_lname  VARCHAR(50) NOT NULL,user_email  VARCHAR(50) NOT NULL,user_pwd  VARCHAR(150) NOT NULL,user_country varchar(100) NOT NULL,user_status  INT(2) NOT NULL,user_doj  date NOT NULL ,billing_address_id INT(10) NOT NULL,shipping_address_id INT(10) NOT NULL,ipaddress VARCHAR(100) NOT NULL,social_link_id VARCHAR(100) NOT NULL,is_from_social_link INT(20) NOT NULL)";
		$result=mysql_query($sql);
		$sql="INSERT INTO `users_table` (`user_id`, `user_display_name`, `user_fname`, `user_lname`, `user_email`, `user_pwd`, `user_country`, `user_status`, `user_doj`, `billing_address_id`, `shipping_address_id`, `ipaddress`, `social_link_id`, `is_from_social_link`) VALUES
		(1, 'Demouser', 'Demouser', 'Demouser', 'demouser@ajsquare.net', 'MTIzNDU2', 'AF', 1, '2013-02-23', 1, 3, '', '', 0)";
		$result=mysql_query($sql);



		$sql="Drop table if exists wishlist_table";
		$result=mysql_query($sql);
		$sql="CREATE TABLE wishlist_table(wishlist_id  INT(20) NOT NULL PRIMARY KEY AUTO_INCREMENT,user_id  INT(20) NOT NULL,product_id  INT(20) NOT NULL,date_added  date NOT NULL ,comments  TEXT(65535) NOT NULL )";
		$result=mysql_query($sql);
		$sql="INSERT INTO `wishlist_table` (`wishlist_id`, `user_id`, `product_id`, `date_added`, `comments`) VALUES(1, 1, 1, '2013-02-23', '')";
		$result=mysql_query($sql);

	}
		
}
?>