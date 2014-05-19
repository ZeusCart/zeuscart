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
		$sql="INSERT INTO `addressbook_table` (`id`, `user_id`, `contact_name`, `first_name`, `last_name`, `company`, `email`, `address`, `city`, `suburb`, `state`, `country`, `zip`, `phone_no`, `fax`) VALUES(1, 1, 'Demouser', 'Demouser', 'Demouser', '', 'demouser@ajsqaure.net', 'Lorem ipsum dolor', 'Lorem ipsum dolor', '', 'tamilnadu', 'AF', '625108', '', '')";
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
			`site_favicon` varchar(200) NOT NULL,		
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
			) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;";
		$result=mysql_query($sql);
		



		$sql="Drop table if exists admin_table";
		$result=mysql_query($sql);
		$sql="CREATE TABLE admin_table(admin_id  INT(20) NOT NULL PRIMARY KEY AUTO_INCREMENT,admin_name  VARCHAR(200) NOT NULL,admin_password  VARCHAR(200) NOT NULL)";
		$result=mysql_query($sql);
		

		
		$sql="Drop table if exists attribute_table";
		$result=mysql_query($sql);
		$sql="CREATE TABLE attribute_table(attrib_id  INT(15) NOT NULL PRIMARY KEY AUTO_INCREMENT,attrib_name  VARCHAR(200) NOT NULL)";
		$result=mysql_query($sql);
		$sql="INSERT INTO `attribute_table` (`attrib_id`, `attrib_name`) VALUES
		(1, 'Design'),
		(2, 'Stitching'),
		(3, 'Dress Code'),
		(4, 'Stamping'),
		(5, 'Clockspeed '),
		(6, 'Size');";
		$result=mysql_query($sql);



		$sql="Drop table if exists attribute_value_table";
		$result=mysql_query($sql);
		$sql="CREATE TABLE attribute_value_table(attrib_value_id  INT(20) NOT NULL PRIMARY KEY AUTO_INCREMENT,attrib_id  INT(20) NOT NULL,attrib_value  VARCHAR(100) NOT NULL)";
		$result=mysql_query($sql);
		$sql="INSERT INTO `attribute_value_table` (`attrib_value_id`, `attrib_id`, `attrib_value`) VALUES
		(1, 1, 'Excellent designing'),
		(2, 2, 'Fine stitching'),
		(3, 3, 'Smart'),
		(4, 4, 'Metal'),
		(5, 5, '5.5 GHz'),
		(6, 6, '10cm')";
		$result=mysql_query($sql);
		
		


		$sql="Drop table if exists category_attrib_table";
		$result=mysql_query($sql);
		$sql="CREATE TABLE category_attrib_table(category_attrib_id  INT(15) NOT NULL PRIMARY KEY AUTO_INCREMENT,subcategory_id  INT(15) NOT NULL,attrib_id  INT(15) NOT NULL)";
		$result=mysql_query($sql);
		$sql="INSERT INTO `category_attrib_table` (`category_attrib_id`, `subcategory_id`, `attrib_id`) VALUES(1, 29, 1),
		(2, 29, 2),
		(3, 30, 1),
		(4, 31, 2),
		(5, 32, 0),
		(6, 33, 2),
		(7, 34, 1),
		(8, 35, 3),
		(9, 36, 4),
		(10, 37, 5),
		(12, 39, 6),
		(13, 6, 6),
		(14, 40, 0),
		(15, 41, 0),
		(16, 42, 0),
		(18, 44, 0);";	
		$result=mysql_query($sql);



		$sql="Drop table if exists category_table";
		$result=mysql_query($sql);
		$sql="CREATE TABLE IF NOT EXISTS `category_table` (
			`category_id` int(15) NOT NULL AUTO_INCREMENT,
			`category_name` varchar(200) NOT NULL,
			 `category_alias` varchar(20) NOT NULL,	
			`category_parent_id` int(15) NOT NULL,
			`subcat_path` varchar(50) NOT NULL,
			`category_image` varchar(255) NOT NULL,
			`category_desc` varchar(500) NOT NULL,
			`category_status` int(1) NOT NULL,
			`category_content_id` int(15) NOT NULL,
			`count` int(11) NOT NULL,
			PRIMARY KEY (`category_id`)
			) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=29 ";
		$result=mysql_query($sql);
		$sql="INSERT INTO `category_table` (`category_id`, `category_name`, `category_alias`, `category_parent_id`, `subcat_path`, `category_image`, `category_desc`, `category_status`, `category_content_id`, `count`) VALUES
(1, 'Women', 'women', 0, '1', 'uploadedimages/caticons/2013-09-10-170711laptop-bags05.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras sit amet nisl nec nunc ', 1, 0, 0),
(2, 'Shoes', 'shoes', 1, '1,2', 'uploadedimages/caticons/2013-09-10-171134formal-shoes03.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras sit amet nisl nec nunc ', 1, 0, 1),
(3, 'Clothing', 'clothing', 1, '1,3', 'uploadedimages/caticons/2013-09-10-171416shirt13.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras sit amet nisl nec nunc ', 1, 0, 1),
(4, 'Watches', 'watches', 1, '1,4', 'uploadedimages/caticons/2013-09-10-171824digital-watches03.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras sit amet nisl nec nunc ', 1, 0, 1),
(5, 'Bags', 'bags', 1, '1,5', 'uploadedimages/caticons/2013-09-10-172159wallets03.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras sit amet nisl nec nunc ', 1, 0, 1),
(6, 'Boots', 'boots', 2, '1,2,6', 'uploadedimages/caticons/2013-09-10-172243sports-shoes07.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras sit amet nisl nec nunc ', 1, 0, 2),
(7, 'Formal', 'foormal', 2, '1,2,7', 'uploadedimages/caticons/2013-09-10-172328formals06.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras sit amet nisl nec nunc ', 1, 0, 2),
(8, 'Sneakers', 'sneakers', 2, '1,2,8', 'uploadedimages/caticons/2013-09-10-172414Crafted-Long-Sleeved-Shirt.jpg', 'SneakersSneakersSneakersSneakers', 1, 0, 2),
(9, 'Sportsshoes', 'sportsshoes', 2, '1,2,9', 'uploadedimages/caticons/2013-09-10-172458formals06.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras sit amet nisl nec nunc ', 1, 0, 2),
(10, 'T-shirts', 'tshirts', 3, '1,3,10', 'uploadedimages/caticons/2013-09-10-172543Crafted-Long-Sleeved-Shirt.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras sit amet nisl nec nunc ', 1, 0, 2),
(11, 'Analog watches', 'analogwatches', 4, '1,4,11', 'uploadedimages/caticons/2013-09-10-172631digital-watches06.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras sit amet nisl nec nunc ', 1, 0, 2),
(12, 'Digital watches', 'digitalwatches', 4, '1,4,12', 'uploadedimages/caticons/2013-09-10-172714digital-watches03.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras sit amet nisl nec nunc ', 1, 0, 2),
(13, 'Chronograhs', 'chronographs', 4, '1,4,13', 'uploadedimages/caticons/2013-09-10-172822chronograhs06.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras sit amet nisl nec nunc ', 1, 0, 2),
(14, 'Laptop bags', 'laptopbags', 5, '1,5,14', 'uploadedimages/caticons/2013-09-10-172917laptop-bags06.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras sit amet nisl nec nunc ', 1, 0, 2),
(15, 'Backbags', 'backbags', 14, '1,5,14,15', 'uploadedimages/caticons/2013-09-10-172958backpacks03.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras sit amet nisl nec nunc ', 1, 0, 3),
(16, 'Wallets', 'wallets', 5, '1,5,16', 'uploadedimages/caticons/2013-09-10-173040Avalanche-Handbag.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras sit amet nisl nec nunc ', 1, 0, 2),
(17, 'Men', 'men', 0, '17', 'uploadedimages/caticons/2013-09-10-173109shirts07.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras sit amet nisl nec nunc ', 1, 0, 0),
(18, 'Shoes', 'menshoes', 17, '17,18', 'uploadedimages/caticons/2013-09-10-173157sports-shoes07.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras sit amet nisl nec nunc ', 1, 0, 1),
(19, 'Bags', 'menbags', 17, '17,19', 'uploadedimages/caticons/2013-09-10-173249backpacks03.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras sit amet nisl nec nunc ', 1, 0, 1),
(20, 'Clothing', 'menclothing', 17, '17,20', 'uploadedimages/caticons/2013-09-10-173328Crafted-Long-Sleeved-Shirt.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras sit amet nisl nec nunc ', 1, 0, 1),
(21, 'Watches', 'menwatch', 17, '17,21', 'uploadedimages/caticons/2013-09-10-173352digital-watches03.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras sit amet nisl nec nunc ', 1, 0, 1),
(22, 'Boots', 'menboots', 18, '17,18,22', 'uploadedimages/caticons/2013-09-10-173432digital-watches03.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras sit amet nisl nec nunc ', 1, 0, 2),
(23, 'T-shirts', 'mentshirs', 20, '17,20,23', 'uploadedimages/caticons/2013-09-10-173704Crafted-Long-Sleeved-Shirt.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras sit amet nisl nec nunc ', 1, 0, 2),
(24, 'Digital watches', 'mendigital', 21, '17,21,24', 'uploadedimages/caticons/2013-09-10-173738digital-watches03.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras sit amet nisl nec nunc ', 1, 0, 2),
(25, 'Accessories', 'menaccess', 0, '25', 'uploadedimages/caticons/2013-09-10-1738292.jpg', 'AccessoriesAccessories', 1, 0, 0),
(26, 'Mobile', 'mobile', 25, '25,26', 'uploadedimages/caticons/2013-09-10-1739106.jpg', 'MobileMobileMobile', 1, 0, 1),
(31, 'Sports shoes', 'mensportsshoes',18, '17,18,31', '', '', 1, 0, 2),
(32,'Laptop bags', 'menlaptopbags', 19, '17,19,32', '', '', 1, 0, 2),
(33,'Back bags','menbackbags', 19, '17,19,33', '', '', 1, 0, 2),
(34,'Wallets','menwallets', 19, '17,19,34', '', '', 1, 0, 2),
(35,'Shirts', 'menshitrs', 20, '17,20,35', '', '', 1, 0, 2),
(36,'Analog watch','menanalogwatch', 21, '17,21,36', '', '', 1, 0, 2),
(37, 'chip','chip', 28, '25,28,37', '', '', 1, 0, 2);";
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
		$sql="INSERT INTO `home_page_ads_table` (`home_page_ads_id`, `home_page_ads_title`, `home_page_ads_logo`, `home_page_ads_url`, `status`) VALUES
		(1, 'polo', 'images/homepageads/2013-04-11-1442011.gif', 'http://localhost/ajshop/zeuscart', 1),
		(2, 'polo', 'images/homepageads/2013-04-11-1442252.gif', 'http://localhost/ajshop/zeuscart', 1)";
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
		(2, 'slide2', 'images/b3.jpg', 'images/b3_thumb.jpg', 'zeuscart2', 'http://www.google.co.in/'),
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
		$sql="CREATE TABLE IF NOT EXISTS `mail_messages_table` (
		  `mail_msg_id` int(20) NOT NULL AUTO_INCREMENT,
		  `mail_msg_title` varchar(240) NOT NULL,
		  `mail_msg_subject` varchar(300) NOT NULL,
		  `mail_msg` text,
		  `mail_short_code` text NOT NULL,
		  `mail_user` int(10) NOT NULL COMMENT '0=>user,1=>admin',
		  PRIMARY KEY (`mail_msg_id`)
		) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1";
		$result=mysql_query($sql);


		$sql="INSERT INTO `mail_messages_table` (`mail_msg_id`, `mail_msg_title`, `mail_msg_subject`, `mail_msg`, `mail_short_code`, `mail_user`) VALUES
(1, 'Registration', 'Registration Info', '<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">\r\n<html xmlns=\"http://www.w3.org/1999/xhtml\">\r\n<head>\r\n<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />\r\n<title>:: [title]::</title>\r\n</head>\r\n\r\n<body>\r\n<table width=\"650\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" style=\"padding:10px; border: rgb(241, 250, 252) 1px solid;\">\r\n  <tr>\r\n    <td align=\"left\" valign=\"top\" style=\"background-color:#e0eee0; padding:10px 10px 20px 10px; border-bottom: rgb(153, 153, 153) 5px solid; \"><img src=\"[logo]\"  alt=\"[title]\" /></td>\r\n  </tr>\r\n  <tr valign=\"top\"><td align=\"left\" style=\"background-color: rgb(224, 224, 224); padding:20px;\"><h1 style=\"color: rgb(68, 68, 68); font-size:15px; font-family:Arial, Helvetica, sans-serif, ''Myriad Pro'', Calibri; margin:0; padding:0; font-weight:normal;\">Dear  [firstname] [lastname] ,</h1>\r\n  <p style=\"color: rgb(126, 149, 1); font-size:15px; font-family:Arial, Helvetica, sans-serif, ''Myriad Pro'', Calibri; margin:0; padding:0; font-weight:bold;\">Your account  has been registered successfully ...</p>\r\n \r\n  </td></tr>\r\n  <tr><td align=\"left\" valign=\"top\" style=\"background-color: rgb(224, 224, 224); padding:5px 20px 15px 20px;\">\r\n  <table width=\"500\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" style=\"background-color: rgb(255, 255, 255); margin:auto; border: rgb(214, 230, 234) 1px solid; padding:10px;\">\r\n \r\n  <tr>\r\n    <td style=\"padding:10px; font-family:Arial, Helvetica, sans-serif, ''Myriad Pro'', Calibri; font-size:12px; color: rgb(85, 85, 85);\"><p style=\"font-family:Arial, Helvetica, sans-serif, ''Myriad Pro'', Calibri; color: rgb(85, 85, 85); font-size:12px; margin:0; padding:0;\">User Name : <span style=\"font-family:Arial, Helvetica, sans-serif, ''Myriad Pro'', Calibri; font-size:12px; font-weight:bold; color:rgb(11, 152, 198)\">[user_name]</span></p></td>\r\n  </tr>\r\n  <tr>\r\n    <td style=\"padding:10px; font-family:Arial, Helvetica, sans-serif, ''Myriad Pro'', Calibri; font-size:12px; color: rgb(85, 85, 85);\"><p style=\"font-family:Arial, Helvetica, sans-serif, ''Myriad Pro'', Calibri; color: rgb(85, 85, 85); font-size:12px; margin:0; padding:0;\">Password : <span style=\"font-family:Arial, Helvetica, sans-serif, ''Myriad Pro'', Calibri; font-size:12px; font-weight:bold; color:rgb(11, 152, 198)\"> [password] </span></p></td>\r\n  </tr>\r\n  <tr>\r\n    <td style=\"padding:10px; font-family:Arial, Helvetica, sans-serif, ''Myriad Pro'', Calibri; font-size:12px; color: rgb(85, 85, 85);\">[confirm_link]</td>\r\n  </tr>\r\n</table>\r\n</td></tr>\r\n  \r\n<tr><td style=\"background-color: rgb(224, 224, 224); padding:5px 20px;\"><p style=\"font-family:Arial, Helvetica, sans-serif, ''Myriad Pro'', Calibri; color: rgb(85, 85, 85); font-size:12px; margin:0; padding:0; font-style:italic;\">Thanks & Regards,</p>\r\n<p style=\"font-family:Arial, Helvetica, sans-serif, ''Myriad Pro'', Calibri; color: rgb(49, 148, 204); font-size:12px; margin:5px 0 10px 0; padding:0; font-style:italic; font-weight:bold;\">[title] <span style=\"color: rgb(222, 72, 69);\">Team</span></p>\r\n</td></tr>\r\n<tr><td align=\"center\" valign=\"top\" style=\"background-color: #000; padding:5px 20px;\"><p style=\"font-family:Arial, Helvetica, sans-serif, ''Myriad Pro'', Calibri; color: rgb(224, 224, 224); font-size:11px; margin:5px 0; padding:0;\">If you have any queries, please feel free to contact us at [site_email] </p>\r\n\r\n\r\n</td></tr>\r\n\r\n</table>\r\n\r\n</body>\r\n</html>', 'Site Title : <code>[title]</code><br/>\r\nSite Logo : <code>[logo]</code><br/>\r\nUser Firstname     :  <code>[firstname] </code> <br/>\r\nUser Last          :  <code>[lastname]</code><br/>\r\nConfirmation Link  :  <code>[confirm_link]</code><br/>\r\nLogin User name    :  <code>[user_name]</code><br/>\r\nLogin Password     :  <code>[password]</code><br/>\r\n\r\nSite mail: <code>[site_email]</code><br>', 0),
(2, 'Forgot Password', 'Forgot Password', '<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">\r\n<html xmlns=\"http://www.w3.org/1999/xhtml\">\r\n<head>\r\n<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />\r\n<title>:: [title]::</title>\r\n</head>\r\n\r\n<body>\r\n<table width=\"650\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" style=\"padding:10px; border: rgb(241, 250, 252) 1px solid;\">\r\n  <tr>\r\n    <td align=\"left\" valign=\"top\" style=\"background-color:#e0eee0; padding:10px 10px 20px 10px; border-bottom: rgb(153, 153, 153) 5px solid; \"><img src=\"[logo]\"  alt=\"[title]\" /></td>\r\n  </tr>\r\n  <tr valign=\"top\"><td align=\"left\" style=\"background-color: rgb(224, 224, 224); padding:20px;\"><h1 style=\"color: rgb(68, 68, 68); font-size:15px; font-family:Arial, Helvetica, sans-serif, ''Myriad Pro'', Calibri; margin:0; padding:0; font-weight:normal;\">Forgot password</h1>\r\n\r\n \r\n  </td></tr>\r\n  <tr><td align=\"left\" valign=\"top\" style=\"background-color: rgb(224, 224, 224); padding:5px 20px 15px 20px;\">\r\n  <table width=\"500\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" style=\"background-color: rgb(255, 255, 255); margin:auto; border: rgb(214, 230, 234) 1px solid; padding:10px;\">\r\n \r\n  <tr>\r\n    <td style=\"padding:10px; font-family:Arial, Helvetica, sans-serif, ''Myriad Pro'', Calibri; font-size:12px; color: rgb(85, 85, 85);\"><p style=\"font-family:Arial, Helvetica, sans-serif, ''Myriad Pro'', Calibri; color: rgb(85, 85, 85); font-size:12px; margin:0; padding:0;\">User Name : <span style=\"font-family:Arial, Helvetica, sans-serif, ''Myriad Pro'', Calibri; font-size:12px; font-weight:bold; color:rgb(11, 152, 198)\">[user_name]</span></p></td>\r\n  </tr>\r\n  <tr>\r\n    <td style=\"padding:10px; font-family:Arial, Helvetica, sans-serif, ''Myriad Pro'', Calibri; font-size:12px; color: rgb(85, 85, 85);\"><p style=\"font-family:Arial, Helvetica, sans-serif, ''Myriad Pro'', Calibri; color: rgb(85, 85, 85); font-size:12px; margin:0; padding:0;\">Your new password : <span style=\"font-family:Arial, Helvetica, sans-serif, ''Myriad Pro'', Calibri; font-size:12px; font-weight:bold; color:rgb(11, 152, 198)\"> [password] </span></p></td>\r\n  </tr>\r\n\r\n</table>\r\n</td></tr>\r\n  \r\n<tr><td style=\"background-color: rgb(224, 224, 224); padding:5px 20px;\"><p style=\"font-family:Arial, Helvetica, sans-serif, ''Myriad Pro'', Calibri; color: rgb(85, 85, 85); font-size:12px; margin:0; padding:0; font-style:italic;\">Thanks & Regards,</p>\r\n<p style=\"font-family:Arial, Helvetica, sans-serif, ''Myriad Pro'', Calibri; color: rgb(49, 148, 204); font-size:12px; margin:5px 0 10px 0; padding:0; font-style:italic; font-weight:bold;\">Zeus Cart  <span style=\"color: rgb(222, 72, 69);\">Team</span></p>\r\n</td></tr>\r\n<tr><td align=\"center\" valign=\"top\" style=\"background-color: #000; padding:5px 20px;\"><p style=\"font-family:Arial, Helvetica, sans-serif, ''Myriad Pro'', Calibri; color: rgb(224, 224, 224); font-size:11px; margin:5px 0; padding:0;\">If you have any queries, please feel free to contact us at [site_email] </p>\r\n\r\n\r\n</td></tr>\r\n\r\n</table>\r\n\r\n</body>\r\n</html>', 'Site Title : <code>[title]</code><br/>\r\nSite Logo : <code>[logo]</code><br/>\r\nUser Firstname     :  <code>[firstname] </code> <br/>\r\nUser Last          :  <code>[lastname]</code><br/>\r\n\r\nLogin User name    :  <code>[user_name]</code><br/>\r\nLogin New Password     :  <code>[password]</code><br/>\r\n\r\nSite mail: <code>[site_email]</code><br>', 0),
(3, 'Notification to Admin', 'User Registration Notification to Admin', '<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">\r\n<html xmlns=\"http://www.w3.org/1999/xhtml\">\r\n<head>\r\n<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />\r\n<title>:: [title]::</title>\r\n</head>\r\n\r\n<body>\r\n<table width=\"650\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" style=\"padding:10px; border: rgb(241, 250, 252) 1px solid;\">\r\n  <tr>\r\n    <td align=\"left\" valign=\"top\" style=\"background-color:#e0eee0; padding:10px 10px 20px 10px; border-bottom: rgb(153, 153, 153) 5px solid; \"><img src=\"[logo]\"  alt=\"[title]\" /></td>\r\n  </tr>\r\n  <tr valign=\"top\"><td align=\"left\" style=\"background-color: rgb(224, 224, 224); padding:20px;\"><h1 style=\"color: rgb(68, 68, 68); font-size:15px; font-family:Arial, Helvetica, sans-serif, ''Myriad Pro'', Calibri; margin:0; padding:0; font-weight:normal;\">New  User has been registered</h1>\r\n\r\n \r\n  </td></tr>\r\n  \r\n  \r\n<tr><td style=\"background-color: rgb(224, 224, 224); padding:5px 20px;\"><p style=\"font-family:Arial, Helvetica, sans-serif, ''Myriad Pro'', Calibri; color: rgb(85, 85, 85); font-size:12px; margin:0; padding:0; font-style:italic;\">Thanks & Regards,</p>\r\n<p style=\"font-family:Arial, Helvetica, sans-serif, ''Myriad Pro'', Calibri; color: rgb(49, 148, 204); font-size:12px; margin:5px 0 10px 0; padding:0; font-style:italic; font-weight:bold;\">Zeus Cart  <span style=\"color: rgb(222, 72, 69);\">Team</span></p>\r\n</td></tr>\r\n<tr><td align=\"center\" valign=\"top\" style=\"background-color: #000; padding:5px 20px;\"><p style=\"font-family:Arial, Helvetica, sans-serif, ''Myriad Pro'', Calibri; color: rgb(224, 224, 224); font-size:11px; margin:5px 0; padding:0;\">If you have any queries, please feel free to contact us at [site_email] </p>\r\n\r\n\r\n</td></tr>\r\n\r\n</table>\r\n\r\n</body>\r\n</html>', '', 1),
(4, 'Order Placement', 'Your order has has been placed successfully', '', '              Site Title : <code>[title]</code><br/>\r\nSite Logo : <code>[logo]</code><br/>\r\nUser name   :  <code>[user_name] </code> <br/>\r\nEmail : <code>[email]</code></br>\r\nOrder ID: <code>[orderid]</code><br/> \r\nOrder Amount : <code>[amount]</code><br/>\r\nBilling Address : <code>[billingaddress]</code><br/>\r\nShipping Address : <code>[shippingaddress]</code><br/>\r\n\r\nSite mail: <code>[site_email]</code><br>', 0),
(5, 'Order Placement', 'New Order Placed', '<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">\r\n<html xmlns=\"http://www.w3.org/1999/xhtml\">\r\n<head>\r\n<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />\r\n<title>:: [title]::</title>\r\n</head>\r\n\r\n<body>\r\n<table width=\"650\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" style=\"padding:10px; border: rgb(241, 250, 252) 1px solid;\">\r\n  <tr>\r\n    <td align=\"left\" valign=\"top\" style=\"background-color:#e0eee0; padding:10px 10px 20px 10px; border-bottom: rgb(153, 153, 153) 5px solid; \"><img src=\"[logo]\"  alt=\"[title]\" /></td>\r\n  </tr>\r\n  <tr valign=\"top\"><td align=\"left\" style=\"background-color: rgb(224, 224, 224); padding:20px;\"><h1 style=\"color: rgb(68, 68, 68); font-size:15px; font-family:Arial, Helvetica, sans-serif, ''Myriad Pro'', Calibri; margin:0; padding:0; font-weight:normal;\">Order Placement</h1>\r\n\r\n \r\n  </td></tr>\r\n  <tr><td align=\"left\" valign=\"top\" style=\"background-color: rgb(224, 224, 224); padding:5px 20px 15px 20px;\">\r\n  <table width=\"500\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" style=\"background-color: rgb(255, 255, 255); margin:auto; border: rgb(214, 230, 234) 1px solid; padding:10px;\">\r\n <tr>\r\n    <td style=\"padding:10px; font-family:Arial, Helvetica, sans-serif, ''Myriad Pro'', Calibri; font-size:12px; color: rgb(85, 85, 85);\"><p style=\"font-family:Arial, Helvetica, sans-serif, ''Myriad Pro'', Calibri; color: rgb(85, 85, 85); font-size:12px; margin:0; padding:0;\">Admin can receive the new order,the order detail is given below </p></td>\r\n  </tr>\r\n	\r\n   <tr>\r\n    <td style=\"padding:10px; font-family:Arial, Helvetica, sans-serif, ''Myriad Pro'', Calibri; font-size:12px; color: rgb(85, 85, 85);\"><p style=\"font-family:Arial, Helvetica, sans-serif, ''Myriad Pro'', Calibri; color: rgb(85, 85, 85); font-size:12px; margin:0; padding:0;\">Order Details</p></td>\r\n  </tr>\r\n  <tr>\r\n    <td style=\"padding:10px; font-family:Arial, Helvetica, sans-serif, ''Myriad Pro'', Calibri; font-size:12px; color: rgb(85, 85, 85);\"><p style=\"font-family:Arial, Helvetica, sans-serif, ''Myriad Pro'', Calibri; color: rgb(85, 85, 85); font-size:12px; margin:0; padding:0;\">User Name : <span style=\"font-family:Arial, Helvetica, sans-serif, ''Myriad Pro'', Calibri; font-size:12px; font-weight:bold; color:rgb(11, 152, 198)\">[user_name]</span></p></td>\r\n  </tr>\r\n  <tr>\r\n    <td style=\"padding:10px; font-family:Arial, Helvetica, sans-serif, ''Myriad Pro'', Calibri; font-size:12px; color: rgb(85, 85, 85);\"><p style=\"font-family:Arial, Helvetica, sans-serif, ''Myriad Pro'', Calibri; color: rgb(85, 85, 85); font-size:12px; margin:0; padding:0;\">Email : <span style=\"font-family:Arial, Helvetica, sans-serif, ''Myriad Pro'', Calibri; font-size:12px; font-weight:bold; color:rgb(11, 152, 198)\"> [email] </span></p></td>\r\n  </tr>\r\n  <tr>\r\n    <td style=\"padding:10px; font-family:Arial, Helvetica, sans-serif, ''Myriad Pro'', Calibri; font-size:12px; color: rgb(85, 85, 85);\"><p style=\"font-family:Arial, Helvetica, sans-serif, ''Myriad Pro'', Calibri; color: rgb(85, 85, 85); font-size:12px; margin:0; padding:0;\">Order ID : <span style=\"font-family:Arial, Helvetica, sans-serif, ''Myriad Pro'', Calibri; font-size:12px; font-weight:bold; color:rgb(11, 152, 198)\"> [orderid] </span></p></td>\r\n  </tr>\r\n<tr>\r\n    <td style=\"padding:10px; font-family:Arial, Helvetica, sans-serif, ''Myriad Pro'', Calibri; font-size:12px; color: rgb(85, 85, 85);\"><p style=\"font-family:Arial, Helvetica, sans-serif, ''Myriad Pro'', Calibri; color: rgb(85, 85, 85); font-size:12px; margin:0; padding:0;\">Order Amount : <span style=\"font-family:Arial, Helvetica, sans-serif, ''Myriad Pro'', Calibri; font-size:12px; font-weight:bold; color:rgb(11, 152, 198)\"> [amount] </span></p></td>\r\n  </tr>	\r\n<tr>\r\n    <td style=\"padding:10px; font-family:Arial, Helvetica, sans-serif, ''Myriad Pro'', Calibri; font-size:12px; color: rgb(85, 85, 85);\"><p style=\"font-family:Arial, Helvetica, sans-serif, ''Myriad Pro'', Calibri; color: rgb(85, 85, 85); font-size:12px; margin:0; padding:0;\">Billing Address : <span style=\"font-family:Arial, Helvetica, sans-serif, ''Myriad Pro'', Calibri; font-size:12px; font-weight:bold; color:rgb(11, 152, 198)\"> [billingaddress] </span></p></td>\r\n  </tr>\r\n<tr>\r\n    <td style=\"padding:10px; font-family:Arial, Helvetica, sans-serif, ''Myriad Pro'', Calibri; font-size:12px; color: rgb(85, 85, 85);\"><p style=\"font-family:Arial, Helvetica, sans-serif, ''Myriad Pro'', Calibri; color: rgb(85, 85, 85); font-size:12px; margin:0; padding:0;\">Shipping Address : <span style=\"font-family:Arial, Helvetica, sans-serif, ''Myriad Pro'', Calibri; font-size:12px; font-weight:bold; color:rgb(11, 152, 198)\"> [shippingaddress] </span></p></td>\r\n  </tr>	\r\n  \r\n</table>\r\n</td></tr>\r\n  \r\n<tr><td style=\"background-color: rgb(224, 224, 224); padding:5px 20px;\"><p style=\"font-family:Arial, Helvetica, sans-serif, ''Myriad Pro'', Calibri; color: rgb(85, 85, 85); font-size:12px; margin:0; padding:0; font-style:italic;\">Thanks & Regards,</p>\r\n<p style=\"font-family:Arial, Helvetica, sans-serif, ''Myriad Pro'', Calibri; color: rgb(49, 148, 204); font-size:12px; margin:5px 0 10px 0; padding:0; font-style:italic; font-weight:bold;\">Zeus Cart  <span style=\"color: rgb(222, 72, 69);\">Team</span></p>\r\n</td></tr>\r\n<tr><td align=\"center\" valign=\"top\" style=\"background-color: #000; padding:5px 20px;\"><p style=\"font-family:Arial, Helvetica, sans-serif, ''Myriad Pro'', Calibri; color: rgb(224, 224, 224); font-size:11px; margin:5px 0; padding:0;\">If you have any queries, please feel free to contact us at [site_email] </p>\r\n\r\n\r\n</td></tr>\r\n\r\n</table>\r\n\r\n</body>\r\n</html>', '       Site Title : <code>[title]</code><br/>\r\nSite Logo : <code>[logo]</code><br/>\r\nUser name   :  <code>[user_name] </code> <br/>\r\nEmail : <code>[email]</code></br>\r\nOrder ID: <code>[orderid]</code><br/> \r\nOrder Amount : <code>[amount]</code><br/>\r\nBilling Address : <code>[billingaddress]</code><br/>\r\nShipping Address : <code>[shippingaddress]</code><br/>\r\n\r\nSite mail: <code>[site_email]</code><br>', 1),
(8, 'Inventory', 'Re-order Level', '&lt;table border=&quot;0&quot; cellspacing=&quot;0&quot; cellpadding=&quot;0&quot; width=&quot;70%&quot;&gt;\r\n&lt;tbody&gt;\r\n&lt;tr&gt;\r\n&lt;td&gt;[LOGO]&lt;/td&gt;\r\n&lt;td style=&quot;height: 97px;&quot;&gt;&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;tr&gt;\r\n&lt;td&gt;&lt;/td&gt;\r\n&lt;td&gt;&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;tr&gt;\r\n&lt;td style=&quot;border-bottom: 6px solid #6699cc; padding: 7px 5px; font-weight: bold; font-size: 14px; color: #000000; font-family: Verdana,Arial,Helvetica,sans-serif; background-color: #e8e8e8&quot; colspan=&quot;2&quot;&gt;Hi Admin &lt;br /&gt;&lt;\r\n\r\n\r\n/td&gt;\r\n&lt;/tr&gt;\r\n\r\n Product Id  : [product_id]\r\n rol         : [rol] \r\nsoh         : [soh]\r\n\r\n\r\nThe stock of hands of this product id reached the reorder level.so admin can reorder the product\r\n\r\n&lt;tr&gt;\r\n&lt;td&gt;&lt;/td&gt;\r\n&lt;td&gt;&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;tr height=&quot;20&quot;&gt;\r\n&lt;td style=&quot;font-family: Verdana,Arial,Helvetica,sans-serif; font-size: 13px; color: #000000&quot; colspan=&quot;2&quot;&gt;*** This is an automatically generated email, please do not reply ***&lt;/td&gt;\r\n&lt;/tr&gt;\r\n\r\n&lt;tr&gt;\r\n&lt;td&gt;&lt;/td&gt;\r\n&lt;td&gt;&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;tr&gt;\r\n&lt;td&gt;&lt;/td&gt;\r\n&lt;td&gt;&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;tr height=&quot;20&quot;&gt;\r\n&lt;td style=&quot;font-family: Verdana,Arial,Helvetica,sans-serif; font-size: 11px; color: #999999&quot; colspan=&quot;2&quot;&gt;&amp;copy; 2006 - 2013 AJ Square Inc.All rights reserved&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;/tbody&gt;\r\n&lt;/table&gt;', '', 0),
(6, 'Gift voucher', 'GIft voucher ', '<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">\r\n<html xmlns=\"http://www.w3.org/1999/xhtml\">\r\n<head>\r\n<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />\r\n<title>:: [title]::</title>\r\n</head>\r\n\r\n<body>\r\n<table width=\"650\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" style=\"padding:10px; border: rgb(241, 250, 252) 1px solid;\">\r\n  <tr>\r\n    <td align=\"left\" valign=\"top\" style=\"background-color:#e0eee0; padding:10px 10px 20px 10px; border-bottom: rgb(153, 153, 153) 5px solid; \"><img src=\"[logo]\"  alt=\"[title]\" /></td>\r\n  </tr>\r\n  <tr valign=\"top\"><td align=\"left\" style=\"background-color: rgb(224, 224, 224); padding:20px;\"><h1 style=\"color: rgb(68, 68, 68); font-size:15px; font-family:Arial, Helvetica, sans-serif, ''Myriad Pro'', Calibri; margin:0; padding:0; font-weight:normal;\">Hi [reciuser] </h1>\r\n\r\n \r\n  </td></tr>\r\n  <tr><td align=\"left\" valign=\"top\" style=\"background-color: rgb(224, 224, 224); padding:5px 20px 15px 20px;\">\r\n  <table width=\"500\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" style=\"background-color: rgb(255, 255, 255); margin:auto; border: rgb(214, 230, 234) 1px solid; padding:10px;\">\r\n <tr>\r\n    <td style=\"padding:10px; font-family:Arial, Helvetica, sans-serif, ''Myriad Pro'', Calibri; font-size:12px; color: rgb(85, 85, 85);\"><p style=\"font-family:Arial, Helvetica, sans-serif, ''Myriad Pro'', Calibri; color: rgb(85, 85, 85); font-size:12px; margin:0; padding:0;\">\r\nYou have been received the gift voucher from [senduser]  </p></td>\r\n  </tr>\r\n	\r\n   <tr>\r\n    <td style=\"padding:10px; font-family:Arial, Helvetica, sans-serif, ''Myriad Pro'', Calibri; font-size:12px; color: rgb(85, 85, 85);\"><p style=\"font-family:Arial, Helvetica, sans-serif, ''Myriad Pro'', Calibri; color: rgb(85, 85, 85); font-size:12px; margin:0; padding:0;\">[giftimage] </p></td>\r\n  </tr>\r\n  <tr>\r\n    <td style=\"padding:10px; font-family:Arial, Helvetica, sans-serif, ''Myriad Pro'', Calibri; font-size:12px; color: rgb(85, 85, 85);\"><p style=\"font-family:Arial, Helvetica, sans-serif, ''Myriad Pro'', Calibri; color: rgb(85, 85, 85); font-size:12px; margin:0; padding:0;\">Your Gift Voucher Code <span style=\"font-family:Arial, Helvetica, sans-serif, ''Myriad Pro'', Calibri; font-size:12px; font-weight:bold; color:rgb(11, 152, 198)\">[giftcode]</span></p></td>\r\n  </tr>\r\n  <tr>\r\n    <td style=\"padding:10px; font-family:Arial, Helvetica, sans-serif, ''Myriad Pro'', Calibri; font-size:12px; color: rgb(85, 85, 85);\"><p style=\"font-family:Arial, Helvetica, sans-serif, ''Myriad Pro'', Calibri; color: rgb(85, 85, 85); font-size:12px; margin:0; padding:0;\">\r\nUsing this gift voucher  you can purchase the product worth of <span style=\"font-family:Arial, Helvetica, sans-serif, ''Myriad Pro'', Calibri; font-size:12px; font-weight:bold; color:rgb(11, 152, 198)\">[amount]   </span>from our online store</p></td>\r\n  </tr>\r\n\r\n  \r\n</table>\r\n</td></tr>\r\n  \r\n<tr><td style=\"background-color: rgb(224, 224, 224); padding:5px 20px;\"><p style=\"font-family:Arial, Helvetica, sans-serif, ''Myriad Pro'', Calibri; color: rgb(85, 85, 85); font-size:12px; margin:0; padding:0; font-style:italic;\">Thanks & Regards,</p>\r\n<p style=\"font-family:Arial, Helvetica, sans-serif, ''Myriad Pro'', Calibri; color: rgb(49, 148, 204); font-size:12px; margin:5px 0 10px 0; padding:0; font-style:italic; font-weight:bold;\">[title]  <span style=\"color: rgb(222, 72, 69);\">Team</span></p>\r\n</td></tr>\r\n<tr><td align=\"center\" valign=\"top\" style=\"background-color: #000; padding:5px 20px;\"><p style=\"font-family:Arial, Helvetica, sans-serif, ''Myriad Pro'', Calibri; color: rgb(224, 224, 224); font-size:11px; margin:5px 0; padding:0;\">If you have any queries, please feel free to contact us at [site_email] </p>\r\n\r\n\r\n</td></tr>\r\n\r\n</table>\r\n\r\n</body>\r\n</html>', '[title] : <code>Site Title</code><br/>\r\n\r\n[logo] : <code>Site Logo</code><br/>\r\n[reciuser]  : <code>Recipient''s Name</code><br/>\r\n[senduser] : <code>Sender Name</code><br/>\r\n[giftimage]  : <code>Gift Image</code></br>\r\n[giftcode]  : <code>Gift Coupon Code</code><br/>\r\n[amount]  : <code>Amount</code><br/>\r\n [site_email]  : <code>Admin Email</code>', 0);
";
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
		$sql="INSERT INTO `orders_status_table` ( `orders_status_name`) VALUES
		( 'Pending'),
		('Processing'),
		( 'Delivered'),
		('AwaitingPayment'),
		('Cancel')	";
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
		$sql="INSERT INTO `category_attrib_table` (`category_attrib_id`, `subcategory_id`, `attrib_id`) VALUES(1, 29, 1),
		(2, 29, 2),
		(3, 30, 1),
		(4, 31, 2),
		(5, 32, 0),
		(6, 33, 2),
		(7, 34, 1),
		(8, 35, 3),
		(9, 36, 4),
		(10, 37, 5),
		(12, 39, 6),
		(13, 6, 6),
		(14, 40, 0),
		(15, 41, 0),
		(16, 42, 0),
		(18, 44, 0);";
		$result=mysql_query($sql);

		$sql="Drop table if exists product_images_table";
		$result=mysql_query($sql);
		$sql="CREATE TABLE product_images_table(product_images_id  INT(20) NOT NULL PRIMARY KEY AUTO_INCREMENT,product_id  INT(20) NOT NULL,image_path  VARCHAR(200) NOT NULL,large_image_path VARCHAR(200) NOT NULL,thumb_image_path  VARCHAR(200) NOT NULL,type  VARCHAR(40) NOT NULL)";
		$result=mysql_query($sql);
		$sql="INSERT INTO `product_images_table` (`product_images_id`, `product_id`, `image_path`, `large_image_path`, `thumb_image_path`, `type`) VALUES
(1, 1, 'images/products/boot06.jpg', 'images/products/large_image/boot06.jpg', 'images/products/thumb/boot06.jpg', 'main'),
(2, 2, 'images/products/formals06.jpg', 'images/products/large_image/formals06.jpg', 'images/products/thumb/formals06.jpg', 'main'),
(80, 2, 'images/products/formals04.jpg', 'images/products/large_image/formals04.jpg', 'images/products/thumb/formals04.jpg', 'sub'),
(3, 3, 'images/products/sneakers05.jpg', 'images/products/large_image/sneakers05.jpg', 'images/products/thumb/sneakers05.jpg', 'main'),
(4, 3, 'images/products/sneakers04.jpg', 'images/products/large_image/sneakers04.jpg', 'images/products/thumb/sneakers04.jpg', 'sub'),
(5, 4, 'images/products/Puma-KURIS-Men-Black.jpg', 'images/products/large_image/Puma-KURIS-Men-Black.jpg', 'images/products/thumb/Puma-KURIS-Men-Black.jpg', 'main'),
(6, 4, 'images/products/puma.jpg', 'images/products/large_image/puma.jpg', 'images/products/thumb/puma.jpg', 'sub'),
(7, 5, 'images/products/laptop-bags06.jpg', 'images/products/large_image/laptop-bags06.jpg', 'images/products/thumb/laptop-bags06.jpg', 'main'),
(8, 5, 'images/products/laptop-bags05.jpg', 'images/products/large_image/laptop-bags05.jpg', 'images/products/thumb/laptop-bags05.jpg', 'sub'),
(9, 6, 'images/products/backpacks06.jpg', 'images/products/large_image/backpacks06.jpg', 'images/products/thumb/backpacks06.jpg', 'main'),
(10, 6, 'images/products/backpacks03.jpg', 'images/products/large_image/backpacks03.jpg', 'images/products/thumb/backpacks03.jpg', 'sub'),
(11, 6, 'images/products/backpacks02.jpg', 'images/products/large_image/backpacks02.jpg', 'images/products/thumb/backpacks02.jpg', 'sub'),
(12, 7, 'images/products/wallets06.jpg', 'images/products/large_image/wallets06.jpg', 'images/products/thumb/wallets06.jpg', 'main'),
(13, 8, 'images/products/t-shirts06.jpg', 'images/products/large_image/t-shirts06.jpg', 'images/products/thumb/t-shirts06.jpg', 'main'),
(14, 9, 'images/products/shirts07.jpg', 'images/products/large_image/shirts07.jpg', 'images/products/thumb/shirts07.jpg', 'main'),
(15, 10, 'images/products/digital-watches03.jpg', 'images/products/large_image/digital-watches03.jpg', 'images/products/thumb/digital-watches03.jpg', 'main'),
(16, 10, 'images/products/digital-watches02.jpg', 'images/products/large_image/digital-watches02.jpg', 'images/products/thumb/digital-watches02.jpg', 'sub'),
(17, 11, 'images/products/analog-watches05.jpg', 'images/products/large_image/analog-watches05.jpg', 'images/products/thumb/analog-watches05.jpg', 'main'),
(18, 11, 'images/products/analog-watches07.jpg', 'images/products/large_image/analog-watches07.jpg', 'images/products/thumb/analog-watches07.jpg', 'sub'),
(19, 12, 'images/products/boots02.jpg', 'images/products/large_image/boots02.jpg', 'images/products/thumb/boots02.jpg', 'main'),
(109, 12, 'images/products/boots01.jpg', 'images/products/large_image/boots01.jpg', 'images/products/thumb/boots01.jpg', 'sub'),
(20, 12, 'images/products/boots08.jpg', 'images/products/large_image/boots08.jpg', 'images/products/thumb/boots08.jpg', 'sub'),
(21, 13, 'images/products/formal-shoes06.jpg', 'images/products/large_image/formal-shoes06.jpg', 'images/products/thumb/formal-shoes06.jpg', 'main'),
(112, 13, 'images/products/formal-shoes04.jpg', 'images/products/large_image/formal-shoes04.jpg', 'images/products/thumb/formal-shoes04.jpg', 'sub'),
(22, 14, 'images/products/sneakers05.jpg', 'images/products/large_image/sneakers05.jpg', 'images/products/thumb/sneakers05.jpg', 'main'),
(116, 14, 'images/products/sneakers04.jpg', 'images/products/large_image/sneakers04.jpg', 'images/products/thumb/sneakers04.jpg', 'sub'),
(23, 14, 'images/products/sneakers02.jpg', 'images/products/large_image/sneakers02.jpg', 'images/products/thumb/sneakers02.jpg', 'sub'),
(24, 15, 'images/products/sports-shoes06.jpg', 'images/products/large_image/sports-shoes06.jpg', 'images/products/thumb/sports-shoes06.jpg', 'main'),
(69, 15, 'images/products/sports-shoes04.jpg', 'images/products/large_image/sports-shoes04.jpg', 'images/products/thumb/sports-shoes04.jpg', 'sub'),
(25, 16, 'images/products/t-shirts02.jpg', 'images/products/large_image/t-shirts02.jpg', 'images/products/thumb/t-shirts02.jpg', 'main'),
(119, 16, 'images/products/t-shirts07.jpg', 'images/products/large_image/t-shirts07.jpg', 'images/products/thumb/t-shirts07.jpg', 'sub'),
(26, 17, 'images/products/analog-watches06.jpg', 'images/products/large_image/analog-watches06.jpg', 'images/products/thumb/analog-watches06.jpg', 'main'),
(27, 18, 'images/products/digital-watches02.jpg', 'images/products/large_image/digital-watches02.jpg', 'images/products/thumb/digital-watches02.jpg', 'main'),
(28, 19, 'images/products/chronograhs05.jpg', 'images/products/large_image/chronograhs05.jpg', 'images/products/thumb/chronograhs05.jpg', 'main'),
(29, 20, 'images/products/laptop-bags04.jpg', 'images/products/large_image/laptop-bags04.jpg', 'images/products/thumb/laptop-bags04.jpg', 'main'),
(30, 19, 'images/products/chronograhs01.jpg', 'images/products/large_image/chronograhs01.jpg', 'images/products/thumb/chronograhs01.jpg', 'sub'),
(31, 1, 'images/products/boot02.jpg', 'images/products/large_image/boot02.jpg', 'images/products/thumb/boot02.jpg', 'sub'),
(32, 1, 'images/products/boot01.jpg', 'images/products/large_image/boot01.jpg', 'images/products/thumb/boot01.jpg', 'sub'),
(33, 21, 'images/products/backpacks03.jpg', 'images/products/large_image/backpacks03.jpg', 'images/products/thumb/backpacks03.jpg', 'main'),
(34, 21, 'images/products/backpacks01.jpg', 'images/products/large_image/backpacks01.jpg', 'images/products/thumb/backpacks01.jpg', 'sub'),
(35, 21, 'images/products/backpacks02.jpg', 'images/products/large_image/backpacks02.jpg', 'images/products/thumb/backpacks02.jpg', 'sub'),
(36, 21, 'images/products/backpacks05.jpg', 'images/products/large_image/backpacks05.jpg', 'images/products/thumb/backpacks05.jpg', 'sub'),
(37, 21, 'images/products/backpacks06.jpg', 'images/products/large_image/backpacks06.jpg', 'images/products/thumb/backpacks06.jpg', 'sub'),
(38, 22, 'images/products/wallets01.jpg', 'images/products/large_image/wallets01.jpg', 'images/products/thumb/wallets01.jpg', 'main'),
(39, 22, 'images/products/wallets02.jpg', 'images/products/large_image/wallets02.jpg', 'images/products/thumb/wallets02.jpg', 'sub'),
(40, 22, 'images/products/wallets03.jpg', 'images/products/large_image/wallets03.jpg', 'images/products/thumb/wallets03.jpg', 'sub'),
(41, 22, 'images/products/wallets04.jpg', 'images/products/large_image/wallets04.jpg', 'images/products/thumb/wallets04.jpg', 'sub'),
(42, 22, 'images/products/wallets05.jpg', 'images/products/large_image/wallets05.jpg', 'images/products/thumb/wallets05.jpg', 'sub'),
(43, 4, 'images/products/fila-sports-shoes.jpg', 'images/products/large_image/fila-sports-shoes.jpg', 'images/products/thumb/fila-sports-shoes.jpg', 'sub'),
(44, 4, 'images/products/adidas.jpg', 'images/products/large_image/adidas.jpg', 'images/products/thumb/adidas.jpg', 'sub'),
(45, 4, 'images/products/Adidas-AGORA-LEA-Men-Black.jpg', 'images/products/large_image/Adidas-AGORA-LEA-Men-Black.jpg', 'images/products/thumb/Adidas-AGORA-LEA-Men-Black.jpg', 'sub'),
(78, 1, 'images/products/boot05.jpg', 'images/products/large_image/boot05.jpg', 'images/products/thumb/boot05.jpg', 'sub'),
(46, 23, 'images/products/2013-10-18-064649hand2.jpg', 'images/products/large_image/2013-10-18-064649hand2.jpg', 'images/products/thumb/2013-10-18-064649hand2.jpg', 'main'),
(47, 24, 'images/products/chip.jpg', 'images/products/large_image/chip.jpg', 'images/products/thumb/chip.jpg', 'main'),
(48, 7, 'images/products/wallets05.jpg', 'images/products/large_image/wallets05.jpg', 'images/products/thumb/wallets05.jpg', 'sub'),
(92, 7, 'images/products/wallets04.jpg', 'images/products/large_image/wallets04.jpg', 'images/products/thumb/wallets04.jpg', 'sub'),
(49, 25, 'images/products/gift.jpg', 'images/products/large_image/gift.jpg', 'images/products/thumb/gift.jpg', 'main'),
(50, 25, 'images/products/gift2.jpg', 'images/products/large_image/gift2.jpg', 'images/products/thumb/gift2.jpg', 'sub'),
(51, 25, 'images/products/gift3.jpg', 'images/products/large_image/gift3.jpg', 'images/products/thumb/gift3.jpg', 'sub'),
(52, 25, 'images/products/gift5.jpg', 'images/products/large_image/gift5.jpg', 'images/products/thumb/gift5.jpg', 'sub'),
(53, 26, 'images/products/2013-10-18-072603(JPEG Image, 400Â Ã—Â 200 pixels).jpeg', 'images/products/large_image/2013-10-18-072603(JPEG Image, 400Â Ã—Â 200 pixels).jpeg', 'images/products/thumb/2013-10-18-072603(JPEG Image, 400Â Ã—Â 200 pixels).jpeg', 'main'),
(54, 26, 'images/products/5.jpg', 'images/products/large_image/5.jpg', 'images/products/thumb/5.jpg', 'sub'),
(55, 26, 'images/products/3.jpg', 'images/products/large_image/3.jpg', 'images/products/thumb/3.jpg', 'sub'),
(56, 26, 'images/products/2.jpg', 'images/products/large_image/2.jpg', 'images/products/thumb/2.jpg', 'sub'),
(57, 26, 'images/products/4.jpg', 'images/products/large_image/4.jpg', 'images/products/thumb/4.jpg', 'sub'),
(58, 27, 'images/products/Dave Scarf.jpg', 'images/products/large_image/Dave Scarf.jpg', 'images/products/thumb/Dave Scarf.jpg', 'main'),
(59, 28, 'images/products/BMW Motorsport Webbing Belt.jpg', 'images/products/large_image/BMW Motorsport Webbing Belt.jpg', 'images/products/thumb/BMW Motorsport Webbing Belt.jpg', 'main'),
(60, 28, 'images/products/', 'images/products/large_image/', 'images/products/thumb/', 'sub'),
(61, 29, 'images/products/2.jpg', 'images/products/large_image/2.jpg', 'images/products/thumb/2.jpg', 'main'),
(62, 30, 'images/products/2012-11-23 11.41.50.jpg', 'images/products/large_image/2012-11-23 11.41.50.jpg', 'images/products/thumb/2012-11-23 11.41.50.jpg', 'main'),
(63, 30, 'images/products/2012-11-23 11.41.53.jpg', 'images/products/large_image/2012-11-23 11.41.53.jpg', 'images/products/thumb/2012-11-23 11.41.53.jpg', 'sub'),
(64, 31, 'images/products/2012-11-23 11.41.50.jpg', 'images/products/large_image/2012-11-23 11.41.50.jpg', 'images/products/thumb/2012-11-23 11.41.50.jpg', 'main'),
(65, 32, 'images/products/2012-11-23 11.41.50.jpg', 'images/products/large_image/2012-11-23 11.41.50.jpg', 'images/products/thumb/2012-11-23 11.41.50.jpg', 'main'),
(66, 32, 'images/products/2012-11-23 11.41.53.jpg', 'images/products/large_image/2012-11-23 11.41.53.jpg', 'images/products/thumb/2012-11-23 11.41.53.jpg', 'sub'),
(67, 33, 'images/products/gift.jpg', 'images/products/large_image/gift.jpg', 'images/products/thumb/gift.jpg', 'main'),
(68, 34, 'images/products/brownies.gif', 'images/products/large_image/brownies.gif', 'images/products/thumb/brownies.gif', 'main'),
(70, 15, 'images/products/sports-shoes01.jpg', 'images/products/large_image/sports-shoes01.jpg', 'images/products/thumb/sports-shoes01.jpg', 'sub'),
(71, 15, 'images/products/sports-shoes03.jpg', 'images/products/large_image/sports-shoes03.jpg', 'images/products/thumb/sports-shoes03.jpg', 'sub'),
(72, 15, 'images/products/sports-shoes02.jpg', 'images/products/large_image/sports-shoes02.jpg', 'images/products/thumb/sports-shoes02.jpg', 'sub'),
(73, 20, 'images/products/laptop-bags06.jpg', 'images/products/large_image/laptop-bags06.jpg', 'images/products/thumb/laptop-b<?PHP
/**
* Gsub'),
(74, 23* GNU General Publi2013-10-18-064650hand3
/**
* GNU General Publilarge_NU Ge V4 is free software: you can redistribute it ac LiceV4 is free software: you can rpart of Z5usCart V4.

* ZeusCart V4 is free software: 5ou can redistribute it and/or modify
* it under the terms or
* (at your option) anc License as published by
* or
* (atpart of Z6usCart V4.

* ZeusCart V4 is free software: P
/**
* GNU General Publind/or modify
* it under the termsP
/**
* GNU General Public LicePARTICULAR PURPOSE. See the
* part of Z7usCart V4.

* ZeusCart V4 is free software: 10
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. Sc License
* along with Fooic License for more detailsc License
part of Z9, 1* GNU General Publiboot0you can redistribute it and/or modifyCQuery
 * @category    	Core
 c LiceCQuery
 * @catpart of 81, 2* GNU General Publiformals02
* MERCHANTABILITY or FITNESS FOR A     Copyright (c) 2008 - 2013, AJc Lice    Copyright (c)zeuscart.2om
 * @copyright 	        Copy1ight (c) 2008 - 2013, AJ Square, Inc.
 * @ve and create the sql table/
class Core_C and creazeuscart.3om
 * @copyright 	        Copy or
* (at your option) any later vers `aboutus_table`";
		$result=mysq/
class Core_C* but WITHOUT ANY84, art V4.

* ZeusCart sneakersry
 * @category    	Core
 * @author   REMENT,
		`content` text NOT NULL,c LiceREMENT,
		`content		`id` in5(15) NOT NULL AUTO_INCREMENT,
	right (c) 2008 - 2013, AJ Square, Inc($sql);
		$sql="INSERT INTO `aboutLT CHARSET=utf8Query
{

	/**
	 * 6(15) NOT NULL AUTO_INCREMENT,
	 and create the sql tables
	 *
	 * 
	uery($sql);


		$sql="DROP TABLE ILT CHARSET=utf8CQuery()
	{

		$sq7, 5RCHANTABILITY or FITNe.

* Thisyou can redistribute it and/or modify(
			`id`  INT(20) NOT NULL PRIMARY Kc License.

* This AUTO_INCREMENT=1"8E `addressbook_table` (
			`id`  I and create the sql tables
	 *
	 * 
	archar(100) NOT NULL,
			`last_name` c License.

* ThisCQuery()
	{

		$sq9E `addressbook_table` (
			`id`  Iright (c) 2008 - 2013, AJ Square, Incrchar(500) NOT NULL,
			`city` varchac License.

* ThisQuery
{

	/**
	 *90, 6 @package   		Core_Cackpack) NOT NULL,
			`last_name` varchar(100)00) NOT NULL,
			`zip` varchar(10) link   0) NOT NULL,
			`zNOT NULL,1			`country` varchar(100) NOT NULL,
			`zip` varchar(10) NOT NULL,
			`phone_no` varchar(20) NOT NULL,
			`fax` varchar(200) NOT NULL
			)3, 7* GNU General Publiwallet NOT NULL,
			`city` varchar(100) NOT N, `city`, `suburb`, `state`, `couc Lice, `city`, `suburbNOT NULL,4y`, `email`, `address`, `city` and create the sql tables
	 *
	 * 
	aure.net', 'Lorem ipsum dolor', ' 'Demouser', '200) NOT NULL
			)5, 8* GNU General Public-shirttus_table`";
		$result=mysql_query($sqll="DROP TABLE IF EXISTS `admin_actc Licel="DROP TABLE IF ENOT NULL,6_query($sql);
	

		$sql="DROP T4BLE IF EXISTS `admin_activity_table`";
		$resOT NULL,
		`user_id` varc$sql="CREATE TAOT NULL,
NOT NULL,7_query($sql);
	

		$sql="DROP Tright (c) 2008 - 2013, AJ Square, Incl_query($sql);
		

	
		$sql="Drop $sql="CREATE TADemouser', 'Demous8_query($sql);
	

		$sql="DROP T and create the sql tables
	 *
	 * 
	 `admin_settings_table` (
			`set_$sql="CREATE TA200) NOT NULL
			)9, 9) NOT NULL AUTO_INCRDROP Tf
* MERCHANTABILITY or FITNESS FOR A char(200) NOT NULL,		
			`site_lLT CHARhar(200) NOT NUpart of 100
			`site_favicon` varchar(20 or
* (at your option) any later vers
		$result=mysql_query($sql);
		$sql="EATE TABLE `admin_activi101
			`site_favicon` varchar(20	`content` text NOT NULL,
		PRIMARY KErds` text NOT NULL,
			`meta_de,
			`admin_e AUTO_INCREMENT=1102
			`site_favicon` varchar(20);


		$sql="DROP TABLE IF EXISTS `add NULL AUTO_INCREMENT,
			`customer_heEMENT=2 ;";
		$r
			PRIMAR3, 10* GNU General Publidigital-watche NOT NULL,
		`user_id` varchar(10) NOT ;
		$result=mysql_query($sql);
		$sql="CRc Lice;
		$result=mysql_query($
			PRIMAR4 if exists admin_table";
		$result=mysq or
* (at your option) any later versassword  VARCHAR(200) NOT NULL)";
		$resuMARY KEY AUTO_INCREMENmail` varchar(200) 5 if exists admin_table";
		$result=mysq7200) NOT NULL)";
		$result=mysql_query($sql);
		

		e_table(attrib_id  INT(15MARY KEY AUTO_INCREMENe_table(a
			PRIMAR6, 1* @package   		Core_analogsult=mysql_query($sql);
		$sql="CREATE TABLE aT INTO `attribute_table` (`attrib_id`, `c LiceT INTO `attribute_table`
			PRIMAR7ry($sql);
		$sql="INSERT INTO `attriburight (c) 2008 - 2013, AJ Square, Inc'),
		(6, 'Size');";
		$result=mysql_queng'),
		(3, 'Dress CoDemouser', 'Demou108ry($sql);
		$sql="INSERT INTO `attribu and create the sql tables
	 *
	 * 
	attribute_value_table(attrib_value_id  Ing'),
		(3, 'Dress Co

		$sql="Drop tabf ex1
 * @copyright 	    CQueAR(200) NOT NULL)";
		$result=mysql_queult=mysql_query($sql);
		$sql="link   		h";
		$result=mysql_q($sq0) NOT NULL)";
		$result=my8ql_query($sql);
		$sql="INSERT INTO `attricellent designing'),
		(2b_value_id`,cellent did`, `attre ifart V4.

* ZeusCart     Co-shoize');";
		$result=mysql_query($sql);


)";
		$result=mysql_query($sql);
		
		/
class Core$result=mysql_quid`, `attrAR(2z'),
		(6, 6, '10cm')";
		$result and create the sql tables
	 *
	 * 
	 * 
	 rib_table(category_attrib_id  INble";
		$result=mystrib_value  VARCHARery(z'),
		(6, 6, '10cm')";
		$results_table`";
		$result=mysql_query($sql);
		$sql_query($sql);
		$sql="INSERT ble";
		$result=mys `attrib_id`, `attrng')4;
		$result=mysql_query($sql);


		$sql="DROP TABLE IF EXISTS `addressbook_table`";
		$result=mysql_query($sql);

		$sql="CREATE TA11);
	 29, 1),
		(2, 29, 2),
		(3, 	`content` text NOT NULL,
		PRIMARY KEY (`id`)
		) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=112(100	`country` varchar(1 `admin_settings_table` (
			`set_id` int(15) NOT NULL AUTO_INCREMENT,
			`customer_header` varchar(240) NOT NUL12ib_vle if exists category_table";OT NULL,
		`user_id` varchar(10) NOT NULL,
		`url` varchar(400) NOT NULL,
		`visited_on` datetime NOT N1225) NOT NULL AUTO_INCREMENT,
			1ettings_table` (
			`set_id` int(15) NOT NULLth` varchar(50) NOT NULL,
$sql="CREATE Tth` varchaparent_id`e if, `email`, `address`T INTO `attribu or
* (at your option) any later vers` int(1) NOT NULL,
			`category_content_ng'),
		(3, 'Dress Comail` varchar(200)2AR(2
			`category_status` int(1) NOT NUyou can redistribute it and/or modifyT=utf8 AUTO_INCREMENT=29 ";
		$result=myng'),
		(3, 'Dress Col);



		$sql="Dropery(
			`category_status` int(1) NOT NU_table(attrib_value_id  INT(20) NOT NULL PRIMARY KEY AUTO_INCREMENT,attrib_id  INT(20) NOT NULL,attrib_value  VARCHA2ery(
			`category_status` int(1) NOT NUte_table` (`attrib_id`, `attrib_name`) VALUES
		(1, 'Design'),
		(2, 'Stitching'),
		(3, 'Dress Code'),
		(4, 'Stamp2ng')uery($sql);
	

		$sq;
		$result=mysqyou can redistribute it and/or modify, 'Shoes', 'shoes', 1, '1,2', 'uploadedimMARY KEY AUTO_INCREMENl);



		$sql="Drop);
	nunc ', 1, 0, 0),
(2, 'Shoes', 'shoel_query($sql);
		$sql="CREATE TABLE admin_table(admin_id  INT(20) NOT NULL PRIMARY KEY AUTO_INCREMENT,admin_name  VARC2*
 *nunc ', 1, 0, 0),
(2, 'Shoes', 'shoe and create the sql tables
	 *
	 * 
	sectetur adipiscing elit. Cras sit amet nMARY KEY AUTO_INCREMEN varchar(500) NOT 3(100nunc ', 1, 0, 0),
(2, 'Shoes', 'shoe(200) NOT NULL)";
		$result=mysql_query($sql);
		

		
		$sql="Drop table if exists attribute_table";
		$result=mysql_q3ib_v		`site_favicon` varchronograhoes', 1, '1,2', 'uploadedimages/caticoncons/2013-09-10-172159wallets03.jpg',c Licecons/2013-09-10-17215s', 1, '1, int'uploadedimages/caticons/2013-09f
* MERCHANTABILITY or FITNESS FOR A ', 'boots', 2, '1,2,6', 'uploadedimaging elit. Cras sitT NULL,
			`time_z3e if'uploadedimages/caticons/2013-09OT NULL,
		`user_id` varchar(10) NOT as sit amet nisl nec nunc ', 1, 0, 2)ing elit. Cras sitde'),
		(4, 'Stamp3eusC exists admin_table"rchar(500) NOT NULL,
			`city` varchar(100) NOT NULL,
			`suburb` varchar(100) NOT NULL,
			`state` varchar(100) NOT NULL13 Fou.jpg', 'Lorem ipsum dolor sit amNT(20) NOT NULL PRIMARY KEY AUTO_INCREMENT,
			`user_id` int(11) NOT NULL,
			`contact_name` varchar(100) NOT13WARR.jpg', 'Lorem ipsum dolor sit am or
* (at your option) any later versuploadedimages/caticons/2013-09-10-17c License.

* Thisgs', 'bags', 1, '1,have 29, 1),
		(2, 29, 2chipright (c) 2008 - 2013, AJ Square, Inc, 0, 2),
(10, 'T-shirts', 'tsing elit0, 2),
(10,oes', 'spo8amet nisl nec nunc ', 1, 0, or
* (at your option) any later vers, 'Lorem ipsum dolor sit ametcons/2013-gs', 'bags', 1, '1,9amet nisl nec nunc ', 1, 0,2, '1,2,6', 'uploadedimages/caticons/20analogwatches', 4, '1,4,11'cons/2013-T NULL,
			`time_z40amet nisl nec nunc ', 1, 0,-10-172159wallets03.jpg', 'Lorem ipsum  consectetur adipiscing elicons/2013- amet nisl nec nun4com
`addressbook_table` 599987_101522507667704 'up897850228_n
* MERCHANTABILITY or FITNESS FOR A 12', 'uploadedimages/caticons/2013-09-10-172714digital-watchec Lice12', 'uploadedimages/caticons/2013-09-10-1727maines', 'dThis	`country` varchar(1(JPEG IU Ge, 400Â Ã—Â 200 pixels).jpeMERCHANTABILITY or FITNESS FOR A uploadedimages/caticons/2013-09-10-172822chronograhs06.jpg', 'Lc Liceuploadedimages/caticons/2013-09-10-172822chronohs', ';
;
		",5,1$result=mysql_query($sql);


, 'usql="Drop table if exists ral Pub_inventory_ptop-4', 'uploadedimages/caticons/2019-10-172CREATE TABLE', 'Lorem ipsum dolor si( ipsum dolid  INT(20) NOT NULL PRIMARY KEY AUTO_INCREMENT,, 'Lorem bags', 'backbags', ,rolags', 15-09-10-1729sohags', 'backbags', )t amet, consectetur adipiscing elit. CraINSERTgs',O `, 'Lorem ipsum dolor si` (`
(15, 'Backb`,l nec nunc 'wallrolwallsoh`) VALUES
		(ib_v if ex6),s/caThis ff ex99-09-103(15) (10048-09-104, AR(200)9, 'Lore5E `adR(10047-09-106			`c0Avalanche-H7y`, ` dol3-09-10ATE TA(10000-09-10,
			`nc ', 1, 0, R(1000(17, 'Men', 'meons/1it ame, 'Lore0) N2013- doltetur a.5 GHz')10-173-09-10$sql=4ag.jpg'Lorem ipt, ct, consaticons/2isci6it amet nisl ES(1,sit ameanche-H),
		 nunc 91 nunc '*
 *
(17, ec nunc shoeshoe'men5-09-10-com
ages/cashoes', This2ages/caticons/l="Dbag.jp9 1, 0, et net n'menshoes',  Fou Fou/2013--09-10-WARRlit. C10);4', 'uploadedimages/caticons/2013-09-10-172917laptop-bags06.jpg', 'Loremreviewslor sit amet, consectetur adipiscing elit. Cras sit amet nisl nec n '17,19', 'up( '17,1ckbags', 'backbags', 14, '1,5,14,15', 'uploadedimages/caticons/2013-09-10-1729userticons/2013-09-10-17295sit amcaption  VARCHAR(30'menclothing', 17, txt  TEXT(6553s03.jpg', ' g', 17, date  Shirtted-Long-Slatingags', s03.jpg', 'L', 17, statusackpackdolor sit amet, consectetur adipiscing elit. Cras sit amet nisl nec nunc '17,19', 'up16,  sit ametwallets', 5, '1,5,, 'Clot1,5,1, 17, '17,20'173352digittxt173352digitShir1,5,1um do173352digit adipiadedimages/catico013-, 'Fine
* Gmet nislV4 is03-05'ndbag.amet, consectetur adipiscing elit3-09-10-172917laptop-bags06.jpg', 'Lore9', 'uploadedimages/caticons/2013-09-10-173249backpacks03.jpIF, 'LoEXISTSl nec nun'17,21', '
		lets', 5, '1 int(2rafted-Long-5', 'uploadedimCrascategts', 'w varchar_zon) loadACTER SET utf809-10-1729Crasskushirs', 20, '17mages/caticontit1', irs', 20253704Crafted-Longalias013-09-10-173704Crafted-Longdescri-watch text04Crafted-Longbrantshirs', 20, '17mages/caticonmodelved-Shirt.pg', 'Lorem ipsummsrp` douop-bmages/caticonprice21,24', 'uploadedimagecse_entop- nisl nelit. Cras 173738digkeyshirs', 20, '17DEFAUL', 'Lorem iweightved-Shirt.jponsectetur adipiimenslit. 3-09-10-173704Crafted-Long- Lic modif1, 0, 2),
(pg', 'Lorem ipsumaccess', 0, '25', 'uploadedimagesnd/or modif_paths', 0, '25', 'uploadedimagesshipping_cost21,24', 'uploadedimageur adipches03.jpg', 'Lorem itagved-Shirt.jimages/catico21, 'eta_iscived-Shirt.jpit amet nisl neceMobikeywords. Cras sit amet nislintro dolor.jpg', 'Lorem ,18,31s_featurwatches03.jpg', 'Lorem i;
		$reimages/, 2),
(24, 'Digigiftnisl neconsectetur adipi
		$re_, 'LoremesAccessories'jpg', 'MobileMobilhas_variaelit. Cinyhes033.jpg', 'Lorem i, 'Loremloadedimages/caticons/2 COMdedi '1=>new/2013-09-,2=>discount', 'Lore,3=>deleted/2013-09-' adipisg wat_reas, 1, 0, 2),
24, 2),
(24, 'Dig4, '1,5,14,1(lets', 5, '1)
		) ENGINE=MyISAM consectetloadSET=adedi5', 'uploadedi=1 lit. Cras sit amet nisl nec nunc . Cras sit amet nisl nec nun'17,21', 'uets', 5, '1,5,rts', 'ments 'upkuIF N-Sleev, m dolor, piscing elit., l nec n, ital wa NUL17,2alletcati"CREdigital-watms_page dol, scing el(
		nunc ', 1XIST 'menaccess, s/catic, ', 'AccessoriesAcc 'upobile', 'mobi 'upr adipXISTat, coeMobile', ms_meta_mensports(50)', '', '',(50)op bags', ',
		`,19,32, (33,'B` text NOT'17,19,33', '', ts','menwalletsallets', 5,NOT NULL,
atch', 21, '17,dedimages/catic'22
* G15asAS
* GB_id`
* Ge_id`
* G<p>Lorem ipsum dolor sit amet, consectetur adipisc dolelit. CrasREMENT=1  nisl nec nunc sollicitudin bibendum. Pellentesque orci SET=utf8 AUTO_INCREMENT=1 ";
		$result=mysql_query($sql);


		$sql="Drop table if exists countrywisetax_settings_table";
		$r.</p>
* G0) NOT 2one`15'17,18NOT N10) NOT Nnc Dev Team
 * @link   		htP
/**
* GNU General Publide varchar(25) NOT NULL,based_* @author    		AJP
/**
* ased) NOT NULLNOT NV4 is fre7'NOT Non_amount ticons't of-10-17'29id`)
	kjnisl    Co Sesul tatury_attrib_taLT CHARSET=utf8 AUTO_INCREMENT=1 ";
		$result=mysql_query($sql);


		$sql="Drop table if exists countrywisetax_settings_table";
		$result=mysql_query($sql);
		$sql="CREATE TABLE countrywisetax_settings_table (id int(11) NOT NULL auto_increment,tax_name varchaNGINEatatatus i7one`5one`amount varchar(200) NOT NULL,country_co    CopyP
/**
* GNU General Publiorra', 'AND', 20),('AE', 'UNITED l_query($sql);
		$sqP
/**
* R(100 NULL,status int(11) NOT NULL,PRIMARY KEY  (id))";
		$rart 30tatuas1, 1)'SEMENT,
-1725d Barbuda',f exists country_table";
		$result=mysql_query($sql);
		$sql="CREATE TABLE country_table(cou_code  VARCHAR(2) NOT NULL PRIMARY KEY,name  VARCHAR(80) NOT NULL,cou_name  VARCHAR(80) NOT NULL,iso3  VARCHAR(3) ,numcode  INT(6) )";
		$result=mysql_query($sql);
		$tatus i cound_on_amount varchar(200) NOT NULL,country_coREMENT,
	 or
* (at your option) an2),('AS', 'AMERICAN SAMOA', 'AmeriF EXISTS `addressbook or
* (aGHANISTAN', 'Afghanistan', 'AFG', 4),('AG', 'ANTIGUA AND BA 29,3archaigua anports p table is533),op table if exists country_table";
		$result=mysql_query($sql);
		$sql="CREATE TABLE country_table(cou_code  VARCHAR(2) NOT NULL PRIMARY KEY,name  VARCHAR(80) NOT NULL,cou_name  VARCHAR(80) NOT NULL,iso3  VARCHAR(3) ,numcode  INT(6) )";
		$result=mysql_query($sql);
		$tatus izone`_on_amount varchar(200) NOT NULL,country_coPuma-KURIS-Men-Black
/**
* GNU General PubliBH', 'BAHRAIN', 'Bahrain', 'BHR', 48),('BI',nd/or modifyBH', 'BAHRAIN', 'Bahrain', GHANISTAN', 'Afghanistan', 'AFG', 4),('AG', 'ANTIGUA AND BA`add3_id`)
	ua aL
			`  Thiua a(
			`id`  Azerbaijan', 'AZE', 31),('BA', 'BOSNIA AND HERZEGOVINA', 'Bosnia and Herzegovina', 'BIH', 70),('BB', 'BARBADOS', 'Barbados', 'BRB', 52),('BD', 'BANGLADESH', 'Bangladesh', 'BGD', 50),('BE', 'BELGIUM', 'Belgium', 'BEL', 56),('BF', 'BURKINA FASO', 'Burkina Faso', 'BFA', 854_on_zone`amount varchar(200) NOT NULL,country_conse.

* This file is ', 'Lorem ipsum dolor sit amRATES', 'United Arab Emirates', 'ARE'nse.

* This file isGHANISTAN', 'Afghanistan', 'AFG', 4),('AG', 'GHANISTAetur adip'33ua a5="INSBackN', 96),(` va'BOLIVIA', 'Bolivia', 'BOL', 68),('BR', 'BRAZIL', 'Brazil', 'BRA', 76),('BS', 'BAHAMAS', 'Bahamas', 'BHS', 44),('BT', 'BHUTAN', 'Bhutan', 'BTN', 64),('BV', 'BOUVET ISLAND', 'Bouvet Island', NULL, NULL),('BW', 'BOTSWANA', 'Botswana', 'BWA', 72),('BY', 'BELARUS', 'Belarus', 'B,based_on_amount varchar(200) NOT NULL,country_cod0) NOT NUrchar(25) NOT NULL,based_o'CAMEROON', 'Cameroon', 'CMR', 120NOT NULL,
			`phone_no NULL, NULL),('CD', 'CONGO, THE DEMOCRATIC REPUBLIC OF THE', 'Congo, `e34a', '0="INSW `cityua a, `cityVIA', 'Bolivia', 'BOL', 68),('BR', 'BRAZIL', 'Brazil', 'BRA', 76),('BS', 'BAHAMAS', 'Bahamas', 'BHS', 44),('BT', 'BHUTAN', 'Bhutan', 'BTN', 64),('BV', 'BOUVET ISLAND', 'Bouvet Island', NULL, NULL),('BW', 'BOTSWANA', 'Botswana', 'BWA', 72),('BY', 'BELARUS', 'Belarus', 'BLR', 0, '17unt varchar(200) NOT NULL,country_co, `city`P
/**
* GNU General PubliDJ', 'DJIBOUTI', 'Djibouti', 'DJILorem ipsum dolor',  NULL, NULL),('CD', 'CONGO, THE DEMOCRATIC REPUBLIC OF THE', 'Congouery2 DemossalamT="DROP ua al="DROP , 'Serbia and Montenegro', NULL, NULL),('CU', 'CUBA', 'Cuba', 'CUB', 192),('CV', 'CAPE VERDE', 'Cape Verde', 'CPV', 132),('CX', 'CHRISTMAS ISLAND', 'Christmas Island', NULL, NULL),('CY', 'CYPRUS', 'Cyprus', 'CYP', 196),('CZ', 'CZECH REPUBLIC', 'Czech Republic', 'CZE', 203),('DE', 'GERMANY', 'Germany', 'DEU', 276),('l="DROP TP
/**
* GNU General Publica', 'ETH', 231),('FI', 'FINLAND',id` int(15) NOT NULL nt float NOT NULL,status int(11) NOT NULL,PRIMARY KEY  (id))";
		$r		`s3salam15_id`)S14),('DZ'214),('DZ', 'ALGERIA', 'Algeria', 'DZA', 12),('EC', 'ECUADOR', 'Ecuador', 'ECU', 218),('EE', 'ESTONIA', 'Estonia', 'EST', 233),('EG', 'EGYPT', 'Egypt', 'EGY', 818),('EH', 'WESTERN SAHARA', 'Western Sahara', 'ESH', 732),('ER', 'ERITREA', 'Eritrea', 'ERI', 232),('ES', 'SPAIN', '),('BG', 'BULGARIA', 'Bulgaria', 'BGR', 100),('EMENT=2e_table(attrib_id  INT(15Georgia', 'GEO', 268),('GF', 'FROT NULL,
			`site_se_table(GHANISTAN', 'Afghanistan', 'AFG'2),('BARY KEY  (id))";
		$rf exi2('CS',craticDI		$re ult=mua a;
		$result=m, 'Serbia and Montenegro', NULL, NULL),('CU', 'CUBA', 'Cuba', 'CUB', 192),('CV', 'CAPE VERDE', 'Cape Verde', 'CPV', 132),('CX', 'CHRISTMAS ISLAND', 'Christmas Island', NULL, NULL),('CY', 'CYPRUS', 'Cyprus', 'CYP', 196),('CZ', 'CZECH REPUBLIC', 'Czech Republic', 'CZE', 203),('DE', 'GERMrchar(200) NOT NULL,country_co, 'Shoes', 'shoes', 1, '1,2', 'uploadedim, 'Shoes', 'shoes', 1, '1,2', 'uploadedimages/caticons/2013-09-10-171134formaULL),('CD', 'CONGO, THE DEMOCRATIC REPUBLIC OF Tesul, 'GIB',NIST36'FLK',('DZ'A INTO, 'GreenlaT INTO `attr28),('AI', 'ANGUILLA', 'Anguilla', 'AIA', 660),('AL', 'ALBANIA', 'Albania', 'ALB', 8),('AM', 'ARMENIA', 'Armenia', 'ARM', 51),('AN', 'NETHERLANDS ANTILLES', 'Netherlands Antilles', 'ANT', 530),('AO', 'ANGOLA', 'Angola', 'AGO', 24),('AQ', 'ANTARCTICA', 'Antarcticatql="INSERTLR', 112),('BZ', 'BELIZE', 'Belize', 'BLZ', 84),(` int(1) NOT NULL,
			`category_content_` int(1) NOT NULL,
			`category_content_id` int(15) NOT NULL,
			`count` inULL),('CD', 'CONGO, THE DEMOCRATIC REPUBLIC OF THE', 'Congo0) NOna', 'GNGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ";
		$result=mysql_query($sql);


		$sql="Drop table if exists countrywisetax_settings_table";
		$result=mysql_query($sql);
		$sql="CREATE TABLE countrywisetax_settings_table (id int(11) NOT NULL auto_increment,tax_name varcha
		$sql="INSERT,based_on_amount varchar(200) NOT NULL,country_code vze');";
		$result=mysql_queKenya', 'KEN', 404),('KG', 'KYRINSERT INTO `attriright (cGHANISTAN', 'Afghanistan', 'AFG', 4),('AG', 'ANTIGUA AND BA5) NO NUL'6ory',$sql);

		

		$sql="Drop table iSOUTH SANDWICH ISLANDS', 'South Georgia and the South Sanry_attrib_tabAND', 20),('AE', 'UNITED ARAB E659),('KP', 'KOREA, DEMOCRATIC P


		$sql="Drop table if nt float NOT NULL,status int(11) NOT NULL,PRIMARY KEY  (, 'GUYANA',  29,8a', 'ABW', d Barbuda', 'ATG', 28),ds', 'COK', 1onsectNDS', 'South Georgia and the South San2),('AS', 'AMERICAN SAMOA', 'American Samoa', 'ASM', 16),('AT', 'AUSTRIA', 'Austria', 'AUT', 40),('AU', 'Kuwait', 'KWT', 414A, REPUBLIC OF', 'Korea, Republic of', 'K`add=mysql_qBW', 533),('AZ', 'AZERBAIJAN', 'AzerSOUTH SANDWICH ISLANDS', 'South Georgia and the South SanERBAIJAN', ''KP', 'KOREA, DEMOCRATIC Pnstein', 'LIE', 438),('LK', 'SRI LANKAOT NULL,
			`stein', 'LIE', 438),, 408),('KR', 'KOREA, REPUBLIC OF', 'Korea, Republic of', 'K, th1', 'An Republic', 'DOM', 214),('DZ', 'SPAIN', 'Spain', 'ESP', 724),('ET', 'ETHIOPIA', 'Ethiopia', 'ETH10', 'uploadedimages/catic_query($sql);
		

	
		$sql="Drop table if exists admin_settingambodia', 'KHM', 116),('KI', 'KIRIBATI', 'Kiribati', 'KIR', , `e1ba', 'A="INS328),('HK', 'HONG KONG', 'Hong KSOUTH SANDWICH ISLANDS', 'South Georgia and the South SanT INTO `attribuP
/**
* GNU General Publi, 'MDG', 450),('MH', 'MARSHALL ISLANDS',sql_query($sql);
		$sql="IN 430),('LS', 'Lult=mysSSAU', 'Guinea-Bissau', 'GNB', 624),('GY', 'GUYANA', uery1 DarussalamENLAND', 'Greenland', 'GRL', 304),', 'CZE', 203),('DE', 'GERMANY', 'Germany', 'DEU', 276),(';
		$result=mysqright (c) 2008 - 2013, AJ 'MNG', 496),('MO', 'MACAO', 'Macao', 'MAisl nec nunc ', 1, 0, 1),
(4 'MOROCCO', 'Morocco', 'MAR', 504),('MC', 'MONACO', 'GY', 'GUYANA', 		`s1inican acedoCons/2013-0('KMcons/2013-0LL,status inNDWICH ISLANDS', 'South Georgia and the South Sancons/2013-09 or
* (at your option) an'Malta', 'MLT', 470),('MU', 'MAURITIU,
(7, 'Formal', 'foormalD', 356),('IO', 'BRITISH INDIAN OCEAN TERRITORY', 'Briti, 'GUYANA',shoes1,('GL',alam', 'BRN', 96),('BO', 'BOLIVIA', 'N exifacilisis sagittis ullamcorper. Proin lecipisf8 AU, gravida et ma', 'Mvulputate, tristie";
utbique',. SedNA',lET=utf ex. Vestibulum antetf8 AUTprimis in faucibus
		$reluue', et ult
		`s posuere cubilia Curae; Aenean eleifend laoreet;
		gue. Vivamusmysql_query(p tabutTO_INCRdignissim semE', 'NOZAM 'Niger'malesuada', 1cidunl);
lass aptent taciti sociosqu ad litora torqu 'NEper;
		ubia nostra,528),inceptos hnuncaeosnds', 'COK', 184),2),('BZ', 'BELIZE', 'Belize', 'BLZ', 84),('CA', 'CANADOT NULL,
		`user_id` varcha 'NRU', 520),('NU', 'NIUE', 'Niue', 'os (Keeling) Islands',OT NULL,GHANISTBOLIVIA' 'CONGO, THE DEMOCRATIC REPUBLIC OF THE', 'Congoimag'MEX', tory', Republic of the', 'COD',  'MONTSERRAT', 'Montserrat'E', 'Chile', 'CHL', 152),('CM', 'CAMEROONyou can redistribute it aG', 'PAPUA NEW GUINEA', 'Papua New NOT NULL,
			`phone_noGW', 'GUINEA-BISSAU', 'Guinea-Bissau', 'GNB', 624),('GY'id))";
		$reesul1na', 'GasdSERBIA AND MONTENEGRO', 'S', 'CZE', 203),('DE', 'GERMANY', 'Germany', 'DEU', 276),('DJ', 'DJ and create the sql tableaure.net', 'Lorem ipsum dolor', 'Lorem ipsum dolor', '', 'tam6),('PL'n', 'OMN', 512),('PA', 'PANAMA', 'Panama', 'PAN', 59art 2,('KMMEX', HandN', bags'obil nislsia', 'MYS', 458),('MZ', 'MOZAMBIQUE', 'Mozambique', 'MOZ', 508),('NA', 'NAMIBIA', 'Namibia', 'NAM', 516),('NC', 'NEW CALEDONIA', 'New Caledonia', 'NCL', 540),('NE', 'NIGER', 'Niger', 'NER', 562),('NF', 'NORFOLK ISLAND', 'Norfolk Island', 'NFK', 574),('NG', 'NIGERIA', 'Nigeria', 'NGA', 566),('NI', 'NICARAGUA', 'Nicaragua', 'NIC', 558),('NL', 'NETHERLANDS', 'Netherlands', 'NLD', 528),('NO', 'NORWAYr(200) NOT NULL6INTO country_table VALUES ('AD', 'ANDORRA', 'AndV4 is free soft49re: right (c) 2008 - 2013, AJ, 'Seychelles', 'SYC', 690),('SD', 'SUDAN', 'Snd/or modify
* it under the 'SYC', 690),( NOT NULL,status int(11) NOT NULL,PRIMARY KEY  (id))";
		$re 'Arury, Occ="INSChip 'MRT'ENIA',elarus', 'BLR'', 1122),('BZ', 'BELIZE', 'Belize', 'BLZ', 84),( 'Sl', 470),('MU', 'MAURITIUS'Jan Mayen', 'SJM', 744),(', consectetur adRI', 630),('PS', 'PALESTINIAN TERRITORY, OCCUPIED', 'Palestinlit. Cras sit amet nisl nec nunc '		,('SN'10-172917laptop-bags06.jpg', 'Loremmenwallet10-173432digital-watches03.jpg', 'Lorem ipsum dolor sit amet, consectetur adipisc'SO', 'SOMALIA',t. Cra	`SO', 'SOMAntshbighes032 nunc ', 1, 0, 2),
(23, 'T-shas sit amet niPrincipe', 'STP', 6SALVADs/2013-09-10-173704Crafted-Lon, 'Sao Tome nameved-Shirt.jpg', 'Lorem ipsuipiscing elit. Cras sit amet nis, '17,21,24', 'uploadedimagges/caticons/2013-09-10-1737iscing elit. Cras sit amet nisl neec nunc ', 1, 0, 2),
(25, 'Accessoriess', 'menaccess', 0, '25', 'uploadedimagees/caticons/2013-09-10-1738292.jpgg', 'Accessor,21,36', '', '', 1, 0, 2),
 'Mobile', 'mobile', 25, '25,26', 'u	uploalvador', 'SLV', 222),('SY'16',lvador', ),('TH', 'THAILANDoadedim, 19, '17,('TH', 'THAILA(37, 'chip','c'Sao Tome and25,2	amet, consectetur adipiscing elit. ts cms_table";
		$result=mysqSAO TOME AND PRINCImor-Leste', NUallets', 5, '1,5,OT EXISn Arab Republic(
		`cms_id` int(2NCREMENT,
		`cms_OT NULL,
		`cms_page_alias` varchar(50) NOT NULL,
		`cms_montent` varchar(240) No20) N16', 'upr adipiscing elit. Crtetuand', 'POLnokiHUN', 3486NULL),('('PE', 'P x e of C,('KM0),('SC', 'SEYCHELLES', 'Seyche6-040749 and create the sql tableNIA, UNITED REPUBLIC OF', 'Tanzania, Unitend/or modify
* it undED REPUBLIC OF',ADA', consecte;
		$resu1),('P', 'POLna', JP', 'JAPAN',Province of China'EX', 0),('SC', 'SEYCHELLES', 'Seychelle35309de varchar(25) NOT NULL,based_tlying Islands', NULL, NULL),('US', 'UNITED STAnd/or modify
* it under ds', NULL, NULL),(A',  'Uganda', 'UGandbIWAN, 2a'MS',E OF _id`)A', 'TaiwaND', ovince of C6ina', 'TWN', 158),('TZ', 'TANZANIA, UNITED REPUByou can redistribute it a)', 'VAT', 336),('VC', 'SAINT VINCENT AND E', 'Ukraine', 'UKR', 804),('you can ANDA', 'Uganda', 'UGAR(2INOR OUTL,('KMED STATES MINOR OUTLYING ISLANDS', 'United States Minor Outlying Islands', NULL, NULL),('US', 'UNITED STATES', 'United States', 'USA', 840),('UY', 'URUGUAY', 'Uruguay', 'URY', 858),('UZ', 'UZBEKISTAN', 'Uzbekista3),(INOR OUTL 410)ED STATES MINOR OUTLYING ISLANDS', 'United States Minor Outlying Islan54703NULL, NULL),('US', 'UNITED STATES', 'Unite, 'WSM', 882),('YE', 'YEMEN', 'Yemend/or modify
* it under , 'WSM', 882),('YEISTAN', 'Uzbekistaisci('WF', 'WA.ALLIS AND FUTUNA', 'Wallis and Futuna', 'WLF', 876),('WS', 'SAMOA', 'Samoa', 'WSM', 882),('YE', 'YEMEN', 'Yemen', 'YEM', 887),('YT', 'MAYOTTE', 'Mayotte', NULL, NULL),('ZA', 'SOUTH AFRICA', 'South Africa', 'ZAF', 710)ng')INOR OUTL=mysq AND FUTUNA', 'Wallis and Futuna', 'WLF', 876),('WS', 'SAMOA', 'Samoa', 'W4M', 882),('YE', 'YEMEN', 'Yemen', 'YEM', 887),category_id  INT(15) NOT NULL)"LL, NULL),('ZA', 'SOUTH AFRIcategory_id  IISTAN', 'Uzbekista-Lon800),('UM', 'UNITED  INTO coun 'Wallis and Futuna', 'WLF', 876),('WS', 'SAMOA', 'Samoa', 923orra', 'AND', 20),('AE', 'UNITED if exists coupon_user_relation_table";
		$result=mLL, NULL),('ZA', 'SOUTH AFon_user_relation_taISTAN', 'Uzbekista,
(1WAN, PROVINCVG', 'VI)";
		$result=mysql_query($sql);



		$sql="Drop table if exists coupon_user_relation_table";
		$result=mysql_query($sql);
		$sql="CREATE TABLE coupon_user_relation_table(id  INT(15) NOT NULL PRIMARY KEY AUTO_INCREMENT'Nepupon_code  VAALLIS AN) NOT NULL,user_id  INT(25) NOT NULL,no_of_uses  INT(11) NOT NULL)";
		$result=mysql_query($sql);


		$sql="Drop table if exists coupons_table";
		$result=mysql_query($sql);
		$sql="CREATE TABLE coupons_table(id  INT(11epublic),('UM',  INT(15)) NOT NULL,user_id  INT(25) NOT NULL,no_of_uses  INT(11) NOT NULL)";
		$result=mysql_query($sql);


		$sql="Drop table if exists coupons_table";
		$result=mysql_query($sql);
		$sql="CREATE TABLE coupons_table(id  INT(11This fu),('UM', uania'hase  real NOT NULL,no_of_uses  INT(11) NOT NULL,applies_to  TEXT(65535) N4user_relation_table";
		$result=mysql_query($sql)applies_to`, `status`) VALUES(1, '_relation_table(id  INT(15) applies_to`, `stans_table(id  INT(11andbag`discount_EX', ULL, NULL),(' 'Wallis and Futuna', 'WLF', 876),('WS', 'SAMOA', 'Samoa',53132),('AS', 'AMERICAN SAMOA', 'Ameriysql_query($sql);
		$sql="CREATE TABLE cross_producLL, NULL),('ZA', 'SOUTH Aql);
		$sql="CREATE Tns_table(id  INT(11t(15) N),('UM', 'UNITED Drop table if exists cross_products_table";
		$result=mysql_query($sql)4
		$sql="CREATE TABLE cross_products_table(product(1, '')";
		$result=mysql_query($sqross_product_ids  TEXT(65535(1, '')";
		$resulns_table(id  INT(11;
		$re_code  VARCHAR(25TO `cross_products_table` (`product_id`, `cross_product_ids`) VALUES
		(1, '')";
		$result=mysql_query($sql);


		$sql="Drop table if exists currency_codes_table";
		$result=mysql_query($sql);
		$sql="CREATE TABLE `currenc');";
	ULL PRIMARY KEY ATO `cross_products_table` (`product_id`, `cross_product_ids`) VALUES
		(1, '')";
		$result=mysql_query($sql);


		$sql="Drop table if exists currency_codes_table";
		$result=mysql_query($sql);
		$sql="CREATE TABLE `currenc7";
		$result=my INT(15)TO `cross_products_table` (`product_id`, `cross_product_ids`) VALUES
		(1, '')";
		$result=mysql_query($sql);


		$sql="Drop table if exists currency_codes_table";
		$result=mysql_query($sql);
		$sql="CREATE TABLE `currenc8 ipsusql);




		$sql="ADA', 'Gr if exists cross_products_table";
		$result=mysql_query($sq601BH', 'BAHRAIN', 'Bahrain', 'BHR', 48),('BI',Peso', 32),
		('AMD', 'ARMENIA', 'Armenian Dram', 51),
		('AWross_product_ids  TEXT(655('AMD', 'ARMENIA', 'Armenian Dns_table(id  INT(119D BARBUDA', 'Ea'UNITED bean Dollar', 951),
		('ARS', 'ARGENTINA', 'Argentine Peso', 32),
		('AMD', 'ARMENIA', 'Armenian Dram', 51),
		('AWG', 'ARUBA', 'Aruban Guilder', 533),
		('AUD', 'AUSTRALIA', 'Australian Dollar', 36),
		('EUR', 'AUSTRIA', 'Euro', 978),
		('AZN', 'AZE'KY'BARBUDA', 'EaVG', 'VIbean Dollar', 951),
		('ARS', 'ARGENTINA', 'Argentine Peso', 32),
		('2MD', 'ARMENIA', 'Armenian Dram', 51),
		('AWG', 'ARUBA', 'ArO ', 952),
		('BMD', 'BERMUDA', 'Bermudian DoAustralian Dollar', 36),
		(O ', 952),
		('BMD', 'BERMUD,
		('EUR', 'BELGIU1', 'Euro', 978)ALLIS AND', 'BELIZE', 'Belize Dollar', 84),
		('XOF', 'BENIN', 'CFA Franc BCEAO ', 952),
		('BMD', 'BERMUDA', 'Bermudian Dollar (customarily known as Bermuda Dollar)', 60),
		('INR', 'BHUTAN', 'Indian Rupee', 356),
		('BTN', 'BHUTAN', 'Ngultrum', 64),
		('BOB2', 'Euro', 978) INT(15)D', 'BELIZE', 'Belize Dollar', 84),
		('XOF', 'BENIN', 'CFA Franc BCEAO ', 952),
		('BMD', 'BERMUDA', 'Bermudian Dollar (customarily known as Bermuda Dollar)', 60),
		('INR', 'BHUTAN', 'Indian Rupee', 356),
		('BTN', 'BHUTAN', 'Ngultrum', 64),
		('BOBorts-shWF', 'WAmt`, `di'Solomon IN CITY STATE)', 'HS', 'United States Minor Outlying Islan64905SYC', 690),('SD', 'SUDAN', 'Sudan', 'SDN', 4),
		('CVE', 'CAPE VERDE', 'Capnd/or modify
* it under th4),
		('CVE', ' table Shoes.jpg', 'Lor
		('XAF', 		$sql="N', 'CFA Franc BEAC', 950),
		('CAD', 'CANADA', 'Canadian Dollar', 124),
		('CVE', 'CAPE VERDE', 'Cape Verde Escudo', 132),
		('KYD', 'CAYMAN ISLANDS', 'Cayman Islands Dollar', 136),
		('XAF', 'CENTRAL AFRIC Foundatle(id  'CAMEROON', 'CFA Franc BEAC', 950),', 'AAD', 'CANADA', 'Canadian Dollar', 124)6
		('CVE', 'CAPE VERDE', 'Cape Verde Escudo',', 36),
		('COP', 'COLOMBIA', DS', 'Cayman Islands Dollar'', 36),
		('CR(100 'CENTRAL AFRICy_tableigua anmallCZE', 203),('DESouth Georgia and the South SanV4 is free so5557 'Finland', 'FIN', 246),('FJ', 'FI 'CONGO, THE DEMOCRATIC REPUBLIC OF', 'Congolese Frnd/or modify
* it under tDEMOCRATIC REPUBLIC O,
		('EUR', 'BELGIULL
		)"),('UM', MediumF', 'CONGO', 'CFA Franc BEAC', 950),
		('CDF', 'CONGO, THE DEM8CRATIC REPUBLIC OF', 'Congolese Franc ', 976),
		(an Kuna', 191),
		('CUP', 'CUBA', ' Dollar', 554),
		('CRC', 'Can Kuna', 191),
		,
		('EUR', 'BELGIUATE TAB),('UM', Lw ZeIVOIRE', 'CFA Franc BCEAO', 952),
		('HRK', 'CROATIA', 'Croatian Kuna', 191),
		('CUP', 'CUBA', 'Cuban Peso', 192),
		('EUR', 'CYPRUS', 'Euro', 978),
		('CZK', 'CZECH REPUBLIC', 'Czech Koruna', 203),
		('DKK', 'DE9nc', 174),
	XLIVOIRE', 'CFA Franc BCEAO', 952),
		('HRK', 'CROATIA', 'Croatian Kuna', 191),
		('CUP', 'CUBA', 'Cuban Peso', 192),
		('EUR', 'CYPRUS', 'Euro', 978),
		('CZK', 'CZECH REPUBLIC', 'Czech Koruna', 203),
		('DKK', 'D9-10 'MAU4),
		('XAF', 'CONean Dollar', 95anc BEAC', 950),
		('CDF', 'CONGO, THE D834Georgia', 'GEO', 268),('GF', 'FR, 230),
		('FKP', 'FALKLAND ISLANDS (MALVINAS)',  Dollar', 554),
		('CRC', P', 'FALKLAND ISLADA', 'Uganda', 'UG,5','ESTONIA',TE D''IVOIRE',ean Dolla, 'ETHIOPIA', 'Ethiopian Birr', 230),
		('FKP', 'FALKLAND ISLANDS (MALVINAS)', 'Falkland Islands Pound', 238),
		('DKK', 'FAROE ISLANDS', 'Danish Krone', 208),
		('FJD', 'FIJI', 'Fiji Dollar'Y KEY (MEX', 48one', 208),),
		('ETB', 'ETHIOPIA', 'Ethiopian Birr', 230),
		('FKP'5 'FALKLAND ISLANDS (MALVINAS)', 'Falkland Island 'GEORGIA', 'Lari', 981),
		('EURISLANDS', 'Danish Krone', 20 'GEORGIA', 'LarIJI', 'Fiji Dollar'3 242),
		('Eyptian PouEAC', 950),
		('GMD', 'GAMBIA', 'Dalasi', 270),
		('GEL', 'GEORGIA', 'Lari', 981),
		('EUR', 'GERMANY', 'Euro', 978),
		('GHS', 'GHANA', 'Cedi', 936),
		('GIP', 'GIBRALTAR', 'Gibraltar Pound', 292),
		(AR(2) VALUES
		(1, '', 58STATES MINOA Franc BEAC', 950),
		('CDF', 'CONGO, THE7032SM', 'MO', 'MACAO', 'Macao', 'MA('GNF', 'GUINEA', 'Guinea Franc', 324),
		('GWP'nd/or modify
* it under NEA', 'Guinea FrancIJI', 'Fiji Dollar'3),(upon_c4o', 978),
		('BZ', 'GUERNSEY', 'Pound Sterling', 826),
		('GNF', 'GUINEA'categinea Franc', 324),
		('GWP', 'GUINEA-BISSAU, 'US Dollar', 840),
		('AUD', '	('XOF', 'GUINEA-BISSAU', 'C, 'US Dollar', IJI', 'Fiji Dollar' 'CENA', 'Gu, 'WALLIS AND FUTUNA', G', 'HAITI', 'Gourde', 332),
		('USD', 'HAITI', 'US Dollar', 840),
		('AUD', 'HEARD ISLAND AND MCDONALD ISLANDS', 'Australian Dollar', 36),
		('EUR', 'HOLY SEE (VATICAN CITY STATE)', 'Eurong')esult56('CS' INT(15) NOT NULL PG', 'HAITI', 'Gourde', 332),
		('USD', 'HAITI', 'US Dollar', 840),
		('AUD', 'HEARD ISLAND AND MCDONALD ISLANDS', 'Australian Dollar', 36),
		('EUR', 'HOLY SEE (VATICAN CITY STATE)', 'Euro);
	
		(sd5('CS'st Caribbery($sqlR OUTLYING ISLANDS', 'United States Minor Outlying Islan70828EOPLE''S REPUBLIC OF', 'Korea, Democra('JPY', 'JAPAN', 'Yen', 392),
		('GBP', 'JERSEY', 'Poun	('XOF', 'GUINEA-BISSAU', ', 'Yen', 392),
		('GBP'DA', 'Ug 'CEDollar'*
 *
		('Azerbaijanian MGO', 'CFA Fr'JAMAICA', 'Jamaican Dollar', 388),
		('JPY', 'JAPAN', 'Yen', 392),
		('GBP', 'JERSEY', 'Pound Sterling', 826),
		('JOD', 'JORDAN', 'Jordanian Dinar', 400),
		('KZT', 'KAZAKHSTAN', 'Tenge', 398),
		('KES', ezuela', 'VDA',
		(qwe', 2,
		('BZD	('AUD', 'KIRIBATI', 'Australian Dollar', 36),
		('KPW', 'KOREA, DEMOCRATIC PEOPLE''S REPUBLIC OF', 'North Korean Won', 408),
		('KRW', 'KOREA, REPUBLIC OF', 'Won', 410),
		('KWD', 'KUWAIT', 'Kuwaiti Dinar', 414),
 'CEezuela', 'Vons/AN', 'Som',oliviano'GO', 'CFA Franc BEAC', 950),
		('CDF', 'CONGO, THEKHST9'Yen', 392),
		('GBP', 'JERSEY', 'Pound Sterling', 826nar', 434),
		('CHF', 'LIECHTENSTEIN', ', 400),
		('KZT', 'KAZAKHSTnar', 434),
		('CHF', A', 'Venezuela', 'VA', AN', 'le(id  INT(15)', 430),
		('LYD', 'LIBYAN ARAB JAMAHIRIYA', 'Libyan Dinar', 434),
		('CHF', 'LIECHTENSTEIN', 'Swiss Franc', 756),
		('LTL', 'LITHUANIA', 'Lithuanian Litas', 440),
		('EUR', 'LUXEMBOURG', 'Euro', 978),
		('MOP', 'MACAO.jpgBARB860),(('CS'),('KY', 'C,
		('IRR', 'IRAN, ISLAMIC REPUBLIC OF', 'Ir1028
		$sql="CREATE TABLE cross_products_table(pro 'MALTA', 'Euro', 978),
		('USD', 'MARS	('XOF', 'GUINEA-BISSAU','MALTA', 'Euro', 978)('KES', 'KENYA', '4sum dol'aw', 'Euro', 9	('XOF', 'MALI', 'CFA Franc BCEAO', 952),
		('EUR', 'MA9TA', 'Euro', 978),
		('USD', 'MARSHALL ISLANDS', '8),
		('MXN', 'MEXICO', 'Mexican PeIQUE', 'Euro', 978),
		('MRO8),
		('MXN', 'MEX'Ouguiya', 478),
		3),(R', werM', 'UNITED STuritius Rupee', 480),
		('EUR', 'MAYOTTE', 'Euro', 978),
		('MXN', 'MEXICO', 'Mexican Peso', 484),
		('MXV', 'MEXICO', 'Mexican Unidad de Inversion (UDI)', 979),
		('USD', 'MICRONESIA, FEDERATED STATES OF 'CER',  ollar',VG', 'VIRG'XOF', 'MALI', 'CFA Franc BCEAO', 952),
		('EUR', 'M30TA', 'Euro', 978),
		('USD', 'MARSHALL ISLANDS', QUE', 'Metical ', 943),
		('MMK', 'MIQUE', 'Euro', 978),
		('MRQUE', 'Metical ', 9'Ouguiya', 478),
		S(1, 29,iberian Dollar'MOROCCO', 'Moroccan Dirham', 504),
		('MZN', 'MOZAMBIQUE', 'Metical ', 943),
		('MMK', 'MYANMAR', 'Kyat', 104),
		('ZAR', 'NAMIBIA', 'Rand', 710),
		('NAD', 'NAMIBIA', 'Namibia Dollar', 516),
		('AUD', 'NA);
	F', ),('Ulling', 404),
		('AUD',ONIA',2 x  Dolarcha, 'LIBYAN ARAB JAMAHIRIYA', 'Libyan4409eria', 'LBR',AND ISLANDS (MALVINAS)', 'Falkland Is Oro', 558),
		('XOF', 'NIGER', 'CFA Franc 	('XOF', 'GUINEA-BISSAU',Oro', 558),
		('XOF', 'NIISTAN', 'Uzbekista4*
 *
		('Nfom', 417),
		('LAK', ealand Dollar', 554),
		('NIO', 'NICARAGUA', 'Cordoba Oro', 558),
		('XOF', 'NIGER', 'CFA Franc BCEAO', 952),
		('NGN', 'NIGERIA', 'Naira', 566),
		('NZD', 'NIUE', 'New Zealand Dollar', 554),
		('AUD', 'NORFOLK ISLAND',R', 1
		('N'MS',n Dollar', 430),
D', 'NORTHERN MARIANA ISLANDS', 'US Dollar', 840),
		('NOK', 'NORWAY', 'Norwegian Krone', 578),
		('OMR', 'OMAN', 'Rial Omani', 512),
		('PKR', 'PAKISTAN', 'Pakistan Rupee', 586),
		('USD', 'PALAU', 'US Dollar', 840),
		ons/
		('Ndn Dol),
		('MKD', 'MACealand Dollar', 554),
		('NIO', 'NICARAGUA', 'Cordoba Or10, 558),
		('XOF', 'NIGER', 'CFA Franc BCEAO', 952),
	RTUGAL', 'Euro', 978),
		('USD', 'PUERTOZD', 'NIUE', 'New Zealand DRTUGAL', 'Euro', 978),
S Dollar', 840),
		 int(15)),('UM', 	('XAF', 'CONGO', 'CFA Franc BEAC', 950),
		('CDF', 'CONGO, THE74629MAHIRIYA', 'Libyan Arab Jamahiriya3),
		('RWF', 'RWANDA', 'Rwanda Franc', 646),
		('EZD', 'NIUE', 'New Zealand 'RWANDA', 'Rwanda FrDA', 'Uganda', 'UG5.jpg Leu', 9'CÔTE D''IVOIRE', 'CFA Franc BCEAO', 952),
		('HRK', 'CROATIA', 'Cr74630ANDA', 'Rwanda Franc', 646),
		('EUR', 'SAINT-BARn Dollar', 951),
		('EUR', 'SAINT MASAINT HELENA', 'Saint Helenn Dollar', 951),
		('KES', 'KENYA', '5AR(2 Leu',MAURIKrone', 208),
		('DJF', 'DJIBOUTI', 'Djibouti Franc', 262),
		(bean Dollar', 951),
		('EUR', 'SAINT MARTIN', 'Euro', 978),
		('EUR', 'SAINT PIERRE AND MIQUELON', 'Euro', 978),
		('XCD', 'SAINT VINCENT AND THE GRENADINES', 'KE'15g', 'Neyptian Pound', 818),
		('SVC', 'EL SALVADOR', 'El Salvador C	('X1Dollar', 951),
		('EUR', 'SAINT MARTIN', 'Euro', 9', 'Seychelles Rupee', 690),
		('SLQUELON', 'Euro', 978),
		('X', 'Seychelles Rup('KES', 'KENYlit. Cras sit amet nisl nec nunc		

VAKI'SENEGAL', 'Senegal', 'SEN',sers',_tag9', 'uploadedimages/caticons/2013-09-10-173249backpacks03.jp2009)', 978),
		((icons/207,19,34', ''14, '1,5,14,15', 'uploadedim2009)', 97, 'uploadejpg', 'Lorem i2009)',, 0, 2ands Dollar', 90)2, 'Boots', 'menboots', 18, '17,18,OVAK', 'Euro (effective 1 January 2hipments_master10-173432digital-watches03.jpg', 'Lorem ipsum dolor sit amet, consectetur , 144),
		('SDG', 'SUDt. Cras, 144),
et nisl nDollar', 90), 0, 2),
(23, 'T-shiD JAN MAYublic', 'SYR', pg', 'MobileMobilD JAN MAY-09-10-121,36', '', '', 1, 0, 2),
, 'SWEDEN'passsporish Krona', 752),
		('CHF', 'SWITZERLaccess dolor sit am, 752),
		('CHF', 'oadedimages/72),('TL', 'TIM(37, 'chip','cD JAN MAYEN'25,28,

		
		$sql="Drop table if exists cms_table";
		$resu 968),
		('NOK', 'SVALBAR 'SYRIAN ARABntent` ZILAND', '),
		('TJS',-09-10-1733'SWITZERLAND', 'Sw972),
		('TZLAND', 'WIu', 'TUV', 798),('TW', 'T'Arrange', 14le', by ou),('mpanyMS', 'MONTSERRAT;
		$resulUniwatcParcel Service', 208)64),
		('UARINO', 'San Marino', 'SMR', 674),('I LANKA', 'Sri Lanka Rupee', oile', 'art'17,19,3-10-173432digital-watches03.jpg', 'Lorem ipsum dolor sit amet, consectetur aland Dollar', 554),
		('TOPt. C 	('TND', 'TUNISIA', 'Tu`t nisl nebackbags', 1 0, 2),
(23, 'T-	('TND', 'TUNISIA', 'Tunilar',t nisl nec nunc ', 1Y', 'Turkish Lira', 949),
	 sit amet ninc ', 1, 0, 2),
(24, 'Danat', 795),
		('USD', 'TURKS ANDqty2', '', '', 1, 0, 2)	('TND', 'TUNISIA', 'TuniShir_addwatc1, 0, 2),
(32,'anat', 795),
		('USD', 'TURKS ANDuni', 5caticons/2013-09-10-17	('TND', 'TUNISIA', 'TuniMobile', 'mobile', 25, '25,26', 	('TND', 'TUNISIA', 'Tuni'Sao Tome and ck bags','menbackb	('TND', 'TUNISIA', 'Tuniorrince_sta 'UNITED ARAB EMIRATES', 'UAE Dirham', 784),
		33,''17,19,3RLAND', 'WIR Euro', 	('TND', 'TUNISIA', 'Tun(37, 'chip','cRAB R	('TND', 'TUNISIA', 'Tun2, 'Boots', 'menboots', 18, '17,18
		('NZD'ROPsit amet, ', 'Triniite_hitICA', ', 'SVALBt amet, consectetur adipiscing elit. Cras sit amet niRUGUAY', 'Uruguay Peso e. CrasID21,24', 'uploaded auto_incre4),
,18,31phillresor sit ametags','menbackbagsviUGUAd_it. Shirtim 'uploadedimag4, '1,5,14,1 (UV',25,28840),
		('UYU', 'URUGUAY', 'Peso Uruguayo', 'TOKELAU', 'New Zealand Dollar',,
		('EUR', 'SLOVENIA', 'Euro', 978),
		('SBD', 'SOLOMON ISS (U.S.)', 'US Dol(	('TMM'ags', 'rafted-Long-4, '1,5,14,15', 'uploadedim, 'Clothing', it amet nisllar',Shirt.jpg' NAM', 'Dong', 840),
		('UYU', 'URUGUAY', 'Peso ,
		('NZD', 'TOKELAU', 'New Zeakin8),
		('EUR', 'SLOVENIA', 'Euro', 978),
		('SBD', 'SOLOMON IS		('XAU', ( Eurckbags', 'backbags', 14, '1,5,14,15', 'uploadedimmposiubli, 'uploade	('ZAR', 'SOUTposi adipiscing 4dolor sit amet, consectetur adipiscing elit. Cras sit amet nisl  European Cwan DpositeIF NOTonetary 17(E.U.A, 'Tanzanian Shilling',default'SLO;
		$resulb'BahTARY FUND 
		(blue', Y FUND R', brown'XPD', ' 'F', greedium', 964)CEAOo34),
'XPD', ' ', `epin', 'SDn Kwacha', 894),
		('ZWR', 'ZIMBABWE', 'Zimbabwe Dollar', 935),
ocial_link8),
		('EUR', 'SLOVENIA', 'Euro', 978),
		('SBD', 'SOLOMON ISdes specifically ('The codes ite Unit (EURCO)', 955),
		('XBB', ' ', 'European for transac-Sleeg', 706),
	images/catico;
		$result=logo_query($sql);


		$sql="Drop table iurlquery($sql);


		$sql="Dadipisr sit amet, conUnit of Account 9(E.U.A.-9)', 957),
		('XBD', ' ', 'Eurdes specifically wan Dfor transactiTUVALU		$result=mysqle` varchar(200) f exe` varchar(200) uralu', 'TUV', 798),('TW', 'T'faceboo', '4),
		('archarecifEUR', 03-28-125522fb.pnL, NUhttp://archar(2.com/		('USD', 'TIMtwittllar',OT NULL,
		`status` int(11) NOT N50tw
		`default_curAULT '0nt(11) NOTak Koruna', 703),
		('EUR', 'SLO18,22', 'uploadedimages/caticons/archar(200) con, 'Ncally reserved for testing purposes', 963),
		('XXX', ' ', 'The codes ATE TABLE cust(TE TABLEkbags', 'backbags', 14, '1,5,14,15', 'uploadedimTE TABLE ysql_query($sql, '', 1, 0, 2TE TABLEisci10-173328Crafted-Longamet, consectetur adipiscing elit. Carchar(2='<ol><li>On Zeuslar' V4, you can use click <strong><span style="c_INC: #0resul;">Login with Frchar(2<//new></userpag, this will allow us to regiSDG'ALUEr&nbsp;sql);


ysql_qac, 0, 2onHAILAwebUGUA.</lige_urThe second step, Cew', the "e/new.html', 0)";
		$result=my'userpagA faq="Drop ta
		$sql" Button, which existsaveult=m Nary ', NEmailREATE TABLE faq_ No AND', 'S is required as longe` (LUESare logged),('sql);


_table(faq'userpagYou existsutomatically b_ans`) VAonble"E TABLE faq viaES
		( 'Wh FNCREecurity purposes, we recomm IslLUES),('out
		$resql);


 $sql="CREAce donq_taNULL ,faqZeus/pagep>Thanks &amp; Regards<br /> `status`Teamar(200` (
		`id` int(11) NOT NULL AUTO_IATE TABLE custwan RCHAR(100) varcs  INT(1) NOd features fle', rrency_tocken` vtomizatioAlerETAR `page_url`, `status`) VALUES
		(1, 'new', 'userpage/new.html',\ 0)";
		$result=\mysql_query($sql);



		$sql="Drop table if exists faq_table";
		$result=mysql_query($sql);
		$sql="CREATE TABLE faq_table(faq_id  INT(10) NOT NULL PRIMA\RY KEY AUTO_Itures to open your fEXT(65535) NOT NULL ,faq_ans \ TEXT(65535) NOT NULL )";
		$result=mysql_query($sql);

		$sql="INSERT INTO `faq_table` (`faq_qn`, `faq_ans`) VALUES
		( 'What is ZeusCart ?', 'Zeus Cart offers easy-to-use features to open your first online store quickly, advanced features for additional customization, and integration with desktop administrator control panel. Zeus Cart offers easy-to)"; LANDS (BRITISH)', 'US Dollar', 840),
		('USD', 'VIRGIN ISLANDubadmin_role8),
		('EUR', 'SLOVENIA', 'Euro', 978),
		('SBD', 'SOLOMON ISNULL,
		  `email` v( `location` vite Unit (EURCO)', 955),
		('XBB', ' ', 'European NULL,
		icons/2013-09-10-1729pping_cospsorit` double NOT NULL,
		  PRIMARrng eiscing elit. Cras sit amet nisl nec nunc ', 1, 0, 1EMENT,
		  `callus` int(50) NOT NULL,
		il` varchar(255) NOT NULL,
		  `fax` int(50) NOT NULL,
		  `locatiochar(100) NOT N		  `footercontent` text NOT NULL,
		  `free_shipping_costary Unit (E.Ml);


		$sql="D  PRIMARY ERT INTNULL,
		gift_product_id int(50) e_que_INCRULL,
		gift_product_id int(50)  adipiscing elit. Cras sit amet nisl nec nunc ', 1, 0, 1),cher_table";
		$result=mysql_quetax	('SDG', 'SUDAN', 'Sudanese Pound', 938),
		('SRD', 'SURINAME', 'Svarchar(100) NOT  Isl 'Norwegian Kron,iscing elitLilangeni', 748),
		('Sql="CRE;
		$result=mysqlbasVND',ENEZUELALilangeni', 748),
		('amet, consectetur adipiscing elit. Cras sit amet nislXT(65535) NOT NULL) , iscing elit, ql="CR, ge_ads_table";
	dedimageen` vNo Taxne stWhole Sit 962) 'GUY `id` int(10) NOT NULL AUTO_INCRE EXISTS `home_page_ads_table` (
		`home_page_ads_id` int(15) NOT NULL AUTO_INCREMENT,
		uponage_ads_Specific C 0, riMacedr(200) NOT NULL,
		`home_page_ads_logo` varchar(200) NOT NULL,
		`home_page_ads_url` varchar(200) NOT NULL,
		`status` int(15) 
		(Sary age_ads_title` varchaid))"; `id` int(10) NOT NULL AUTO_INCREM NOT NULL,
		certificate_theme vermsNT(1i,20'9', 'uploadedimages/caticons/2013-09-10-173249backpacks03.jp013-04-11-1442011.gif(013-0RN SAHAR 'European n Dirham', 504),
		('YER', '013-04-1, 'NE10-173328Crafted-Long-ULL),('TM', 'TURKMENISTAN', 'Turkmenistan', 'TKM', 795),(013-04-11-1442011.gif`edimage en` vistr13-0controlC-11-14420 Cras comes here.home (
		  `id` int(10) NOT NULL AUTO_INCREMNOT NULL,
		certificate_theme vimezone11.gif', 'http://localhost/ajshop/zeuscart', 1),
		(2, 'poloxt NOT NULL,
(tz_INCREMENks03.jpg', '', 'http://localhost/ajshop/zz_codl_query($sqK', 'TOKELAU'_pageport Unit (E.M.U.-6) ', 956tz_pend'
		content`, `status`) VALUESaturesy($s;
		$result=mysql_query($sql);	


		$sql="Drop table if XISTS `home_page_adxt NOT NULL,
MENT,
		ench'AD','+4230+001uba''Europe/Andorra',GUYA('2olorE mag2518+05518olorsia/Dubai veniam,3olorF mag3431+069ML',tion uKabul veniam,4 ea G mag171, 0614itatimerica/Antigum veniam,5 ea I aute812-0630. Duiin reprehguillm veniam,6 ea L magn120+01950 Ut enim aTirat nieniam,7 ea M magn011+044A', tion uYerevan incididitatiN aute211-0690lore in reprK IScao incidid9ore O','-0848+qua.. Duif reprLuandm veniam,uani'AQo la7750+166ana''Antarcfers/McMurdcitain repr Stallet, Ross Islandommododolorequat900aliq0, quisure dolor South_Po('PT'Amundsen-Scott..</p>', 1ble i  exismmodox ea equat644', 120te irure dolor Palmllar'TABLE ..</p>', 1Anver;
		$result=mys nis_query736+0625s nisure dolor iawsoua. T,modu..</p>', 1Holme Bayesult=. Dui_query835+0775itatiure dolor Davis','esult..</p>', 1 'Nefold Hillsesult=><p>L_query617+110a. UtULL)";
		$rCasey','pload..</p>', 1Bailey Peninsulaesult=te irntent_t40+1400"images/slidesuDumontDUrvilxistsmb/b2.-d pg"],"s Base, Terre Adeliresult=unt uRo la3436-058ory,is nostruBuenos_AirMace'E Argentina (BA, DF, SC, TF)esult=itati,"imag257-0604 quis nostruRosaricitaNdesupload/b2.SF, ER, CN, MN, CC, FM, LP, CHowheighullam,"imag124, 12ysql_q nostrudordobm veWesupload/b2.CB, SA, T"ranR, SJ, SL, NQ, RNowheig2 cons,"ima24veniarcitatiin reprJujud/thn":"t (JY,"slididolorecttim82RC', 4supload/b1.jCatamarcm vetrue","pa (CT,"slidix ea 50","imarure84ullamin reprMendozm ve:"false (MZ,"slidis nisSo la1416-1704x eaPaMARY /Pago_olor veniam, . DuiT magn813+016ingef enim aViennm veniam, ><p>LUs":"1233+1590, 1'AuRWAYlia/Lord_Ho'Som'"pie osit
		$result=m2te iroBott4253+147dcolumer":"38",Hobadesk'Tasmaniad/thuesuplooBotto749+144NOT NUer":"38",Melbouror inVictorslide_paitatioBotto352+151 NOT Ner":"38",Sydnad/thNewable";
Wicar - mosEW Ccallet='{"slt=mypToBottom57+141esuploer":"38",Broken_jsonult=mysql_query($sql)e";
		$jsonaboris consoBott2728+1530x ea show_table"isbpor inQueen	$resql);


		$sql="Drop ta["imaghome_s016+14m, quiser":"38","indemqua. LL PRIMARY KEHoliday
		$resENT,slix ea oBotto455+138, 'FNOT NULL,sldesuaidtionble";
OT NULL,sNT,slis nisoBott12ide_30 do eOT NULL,slDarwiua. Northernges/sandsLL,par,('Cif exists hom155dolorer":"38",PertheffeeSDG'n(65535) NOT NULL0) NOWminim 30e","NOT NUin reprerungeffsql);
te irZ labor23+049O `homon uBakuumb`, `slsuplBA magnter"018:"top enim aSarajev222222","3itatBB aute30/sli9'slidoad/b1.jparbado/slib.jpg'le iBe mag2343+090:"topTon ulacpauseequat. conB nost505aliq4left","timerBrusseln/'),
		(4. UtBi ut 1222-iqua. Ut aliquiOuagadougoES
		(1, ee","Bs aut4241+023dcolu', 'imagofF CHs/b3_ths niBHde2',6, `s50`, `sl`) VALhrs', google.c		$sBorem-EA',+029seonclaliquiBujumbuim veniam,	('H'BJ mag0629+002tp://waliquiPorto-No_thumb.jpg4te iBt lab321geal4 NOT Atlantic/Bermu ea commodnavigB mini0456+1145=mysql_queruneco laboridolorBco la16tent`,0asueonhover"La_Pazl);




	, 'sl,"ima0351op t:"topTin reprNoronhw.goFernando de  NOT NUL.</p>umb.jinvoic127-048ble ifad/b1.jpelem://wwapa, ETE',_date` /'),
invoice4nt(18TABLE in reprFortalese","NE Brazil (MA, PI, CE000", PR, PEowheig, 23_query($7sum 48=mysqle_contentaguaiirectToc (
	Drop taEY AUquery($940ice_co.inonhover":aceautoAAlagoas,S DogipresultLY',`lang_i233ql="6tp://www.googSar":"ul2222S & S exists lajpg"GOg"],"sMG, ES, RgtimPsult=mlideRSql_queresult,"ima1535-056diamet nostrud iangeffMato Grosso, ame` (`lang t...uREATE 5NOT Einvoic846m do varc,
		  KEl="CR_Velh2222W	$res 1);ndoni`langraim_date` NULL invoice0', 1/slides NULL AUTnau/sliAmazonage` (
	OT NUang_id`3,"sl7', 'imsql);
		$sql=Acrists ql_q	) ";, 'slcolo+2505-077ttons"ar(200) assaES
		(1, 6umb.jarposslide0892, 'sql_quThimbve_chat_ta/'),
ide_-2545+0esul 'images/bGabNOT r incidid6y($sqYg', '354+027
		$s enim aMinsktable` (
	  `laptio17tent8CREATE TABLE IBeliz_table` (
varcC1', 'i7se',521) NOT NULL ASt_John/sliNewfoundMARY 		$result=m', 'us` int(439m dolide_cin reprHalifaxtable` (
		 TNAM'- Nova de_pia (;


	places), NB, W Labrador;
		Quebec & PEI (`id`te is` int(6sum 59ang_nFAULT CHG_que_NULLf8 AUTO_INCREMENT=1";
		$resul-ql_quer that did not observe DST 1966-1971 (`id`supls` int532ent`es/b3.jt_scriptoos`live_chat_status`) VALUE
		$sql=" (`id`itats` int66ang_c5		$sq;
		$resuangnirtu	`de8 AUTO_INCREMENT=1"rthwesfersquery(ome_(`id`le is` int(531-073
		$sqnhover":ontreault=E'SDG'nCREMENT=Oure io &ERT INTOl);


		$sql="Drop ta7 cons` int(901t` te  DEFAULT CHNipigdule_archar(240) NOT NULL,
		  `mail_ms)";
		$result=mysql_query($sql);

	7
	

3char(3. Uts` int(823-089ide_coin reprThunderlive_charchar(240) NOTil_msg_ NUL,T NULL,
char(3y($s="CREAT34,"sl8	(1, "in reprIqaluiNTO archar(240) NOT`mail_msg_id` int(20) NOT 7s niNOT NULLrue"97e_name` varchWinni2chro'Cen":"3CREMENT=Manitoba & _msg_RSET=utf8 AUTtatus` int(8ql);94
		PRIMARY KERainy_RivE homail_msg_subjectegist ation &ne st FrancvancRSET=utf8 AUT)
		) ENGI6245-092o cons
(1, 'Regn.U.AInleNTO ail_msg_subjectNSERT INTO `mail_messages_t_table` (`5024-104sql_qu
(1, 'ReeTES'.w3.org/TR/Stex erdCREMENT=Sasklt=mywan_msg_subject` varchar(3"Drop table017-107(240) COMMENT wATESCurrenw.w3.org/TR/l\">\r\n<head>\r\n<meta http-equid_msgages_t$sql="CREA5333-113$result=mysqlEd/b2.dule_n 0, ai(240) NOTAlberta, east British Colum', 'msg`, `\n<meta httpages_tULL AUTO_I6227-114table if exisYe faqkniftioncing=\"0\" cellpcil_msg_`mail_msg_id` int(20) NOT  'CANCREMENT825\"65	



		$sql="InuviMENTcing=\"0\" cellp_msg_t\" valign=\"top\" style=\"1=>admin',5946-120ameterin reprD,modu_Creepx 10px 20px l\">\r\n<head>\r]\"  a t=\"[CTYPE htSaint =>on,align=\"center\" yle=\"O_INCREMEN49"#ee230supload/b1.jVancouion', timerbg 10px; bordern=\"left\" style=\"bacable` (`ma6043-1350) NOT NULL AWhitehorstion20px;\"><h1 stysle";
Yukox; bor8tatus` int6404-139sts mail_mess]\"  aetica, sans-serif,nmailriad Pro'', )
		)C_url V10+096T EXIIndian/Cocin/'),
		(8_table ma-04d ex1rcitatialiquiKinshasrg/1_msg_Dem. Rep. ofREATgtf8 AU8"Drop49, 11140 NOT	(1, "aliquip bumbashco l0\" a, Helvetica, sans-serif,$sql=i ut 042ges/b`, `slsts invaconsor: rgb(1ULL As au1); 6ont-ssql);
		$sqxistza"],"slidtion ubackg')";
47tabl08ent_t enim aZuriHongn=\"lef1=>adorem 0519-004ow_tabaliquiAbidjqua. Ut en9O_INCK TABL114-1; \"","timerbgcRarotongw.google.9able`ing -33 NUL7ignment":"centS (
	"#2222hs',$result=m9tatusg=\"027 fre09esupltimerbgcarchar$sql);


ARY KEY (`id9)
		)t lab040top\9ee","ding:5pDouactetur adi9_tabl mini4E IF126n/'),ql_quHarbsql);r  [fiManchuVALUES
	9"Drop mini3114im v	(1, "on uShanghmco lChd/b2coabody>\r9$sql= mini22humb"4e_nameng:10ong_Koessag<p s yle=\:12pxULL Aor: rg934+1l_quadding:1Chungkiessagi; fonming=\"0='{"sli, qui   <td 3ris 87-serif, ''UrumqsfulTibet & Xinjiaily:Ari1slide sans-s9quer75


		 commodshgarder: rgb(n Turkestpx; bor1ow_taCco l+0es/sl74_id`),
		  KEBogol="Icommodo able`,"im+0956t=my_id`),
		  KEYosta_Rimages/b3_t1lor sCoBot+2lang_82seonclAULT CHARvairections"1diameCVat_sc455-023', 'ime` (
		`Cape_Verption <td st_tablXiad P025+1011) NO style=\ha', m', 'tica, sa"Drop` int35h1>\33seonclon uNicosww.google.10$sql=aptio5005+014ils": enim aP NOTr incidid1e_namDpg', 'a ali185, 85'http://erlsql);




1o conD=mysq11MARY43e_namex;\">\rjiboutsfully ..1ysql_Dr\n +55o'',12-seri enim aCopenhagPT', : <spany($sDt labt-siure timerbng:0; foominser_name]</s NOT Dd Pro1","sho9uery($sql);
	stylo_size:#222222","1ameteDaptio3647+003font-fing:5pxlgirbudad] </spay:Arime] ,0210-07d do eail_messauayaquiult=kground-color1`mail"paddin054 PRIlide_timerbgcGalapagin/')t-size:12L ,slide_cont1d></tEpg', '92IF N4resuliusmod t`statsans-serif,itatEs aut30 pad3tyle=\r\n  <tCairword] </spat3', ')";
	709-qua.g:10px;\">\El_Aaiusans-serifleft",old; 15t, s38EY AUTing:5pxsmeim veniam,1ttonsE		$sq4l xm003n/'), AUTO_INadridlvetica, sans-seror: rg		$sq35rue"24, \n<tr><td seupx; f padd & Melsecteca, sas ni font-28', '15timerb-family:Arnard/thumle=\gb(85, 85, 85)timerEarposagesfontng:10px;\">\Addis_Ablang_nitalic;seriForem 60h1>\2id`, ` enim aHelsinkord : <spails":F=mys-1808+17b3.jpgtimerbgcFijrgin:5px 0 suplFr\n  514, `l7O `home` (
		`l\">lad/thitalic;itatF solid931AR(2familtimerbgcYap','n</tca, sa; ma, 69);\7Myri51navigtimerbgcTruMENT\"to (ChuukowheighTABLE, 69);\65de_s8 NOT timerbgcoonapvetic"><p  (Pohnpeickground. Ut, 69);\519+162


		timerbgcKosrationd Pro''groundy($sFd Pro62,
		softtable` (
		`Faero ''Myriad L,sliFold; 48ages02left","timerParlt=myi; colovarcG1', 'ry($addiesuploaliquipib52di align=\"le1-seriGuscar5128tent0018/td>\r\n  </Lguage\n\rrea\"colos', 'c/p>\4); r\n\r\n4(`la0OT EXIgb(85, 85lfsizeresult=mysqIred INT(20) NsuplGe mag12irure dts mail_messarena ea commodo', 'zG nost41'ima44pasueoery($NORFsord : <spa2, 'sGnt  haslor:5>If yoation":"tryent_table` (1humb.G')";
053e:120 NOT Niad Proccelvetica, sn/'),Gorem 3E TAB05ans-seenim aGibraltal, Hode><bry($sGing e70tent22MARY KEY (`maScoresbysuncolo0\" aG'XPT$result=myco.inbr/>\rlice-051 IF NOT EXISTGodthab',' ''My_msg_/code><br/>\r\n\ease r/>\r\6se', 8navigation":"Thuxistsr  [f0),
(2, 'Forgot Passwr\n\rriad P3,"sh16sql_quered succj consequat124); GAUTO_I9REME131) NOTr><td sonak=\"fow3.org/>[logP]</co61,"sllor: r-family:Arideloup styw3.org/de>[fequa+03 IF 0sword',aliquiMalabword] </spL,
		Gold; 3758uscaco.in enim adthen,1=>'{"slidationcolor5:"#e036ent_than style=le ifGeorgyle=\"font-ysql_Garpos1438-09:["imagfamily:Aritem \r\n  <tr>', 23'Gp></tnsit (`iTML 1bri; fontuaid`)cellpadr\nSiide_co1_patY (`</tr>\r\n  i live_chat_t1 varcG` int06$sql58tional//EN\" Guyr\n    <td sT EXIH minim4', '87 NOT N '<!DOCTegucigalpvalign=\"to4); Hpaddin5ris n5 font-size:1Zagree><bgn=\"tosuplH"650\"8 CHA7astname]</codel="C-au-Prrway3, 153, 15itatHp></t47i; coediame'http://udap<bod, 153, 15; maI49, 1)610sansdolor on uJakarpx; fJavfontSumatesult=m1able"\"left\50T IN9timerb2px; jung_Pex eessagBorne
		 Celeb0) NOT 1"CREA\"left\232=\"bng:10pkgrounyaptable"Irian a, s &PRIMAMolucc 'en'),1
		`iIpg', ' if e06yle=\"enim aDub 85); font-slive_Iing e3146+ce_p style=\"Jerusa(`id`)>ForgotvarcIor: rgb32+0885, 85);\">Calcutpx; font-we`)
		Ico lab7t, s7` varc', Calibre:12px;le=\"ba4); I<meta332 et ds/b3.jpg',Baghdacolole=\"basuplIxt/htmnt-fa50 10px<br/>\ehrqua. Ut en1	$sqlI		$sq64gb(22width=head>\r\nReykja10px 1paddingign=\arposi10) N12<tr><weight:Rom[title]\" 300) Jriad P8010pxe=\"bacginationamaser_name]</s,1=>aJd Prots ho03510px veticAmontentr\n    dingJlns=\3539CHAR3944"padding:1Tokyword] </sptableK nos-011addi6pasueoaliquiNtylebord : <spaode`,Kjpg', '0) N74lide_c  <taishk"[tit);\"><p1, 2K')";
r:#e+10NT,
		`ordePhnom_Pennd-color:1d\">\K24, 221Myri73, qui valign=\arawx; fGiddinggb(85, 85, 85)" con); fo `lang17style=rgin:automsg_bu=\"foPhoenixser Name : <spaitat); font-52-157ingef ''Myriadiign=offeion"inTop","the : <spa; maKt la Pro et 3`mail style=\"mole=\"backgr"backK minim7o'', T NULL COMMENT '0Kit,('D\n  </tr. UtKvetica901+1LE I, Calibriyongy(68, 6n  </trdingKxt/htmlad P26NOT NUd Proeo/www.w3.org); foKide_c29t, s47font-familyuway($sqr: rgb( styl` int19o'',8c;\">Te]</code><b-family:ArialastnKaption31535)6ve_cha; fonlmate_ch0\" aKazakhs-serif, '126, lor: r"tex+057o cons; fonqtob[titgn=\"lefmargin:0; paddingn styaptionliqui50`mail_: <spanive_c_msg_margin:0; paddingitatL1', '1l; c102ly:Arial, bardtipor incidid1.</p>Luscar335r\n 5olore magnBeiruop\"><td aft\" Lme] =\"beniab(85,  COMMENT '0Lucyle=\"font- rgb(Lorem 470uery9a. Ut enim aVadu) NOT NUL1x;\">Le=\"f0656+px; padding:1Colompe\" contenspaciLold; c6o'',10uiv=\"Contentonrovr><td style=varcLcolor29ult=27TABLE Content-ser solid;\">4) 1pLarpos54zeuscpx; ma,"timerbalni 'Eng margin4); L>\r\n 9MARY06e_nam\n</tabluxem `pa, ''Myriadtica,L"padd56padd2;
		$srgb(214,i\"0\" cell1x; coLor: rgnt-fa13ysql_qaliquiTripolord : <spaal, HM1', '33=MyI0-size:1r><td stsablanmages/b3_t2, quiMtable4340;\"7;\">ThAUTO_INonac222222","tslideMe magn7ql);28 do eiusmod Chisinive_chat_t2ow_taMr\n \1855><p , Hel style=ULL)nt-fai_thumb.jpg2ight:M Link d-co17f, ''MtimerbgcMajule=\";


		$sql="Drop tablor skground905+16size:12px; fontwajalesql);erif, ''My"font-eticMe=\"f4159+020 10px', 'imagkopj[title]\"2ans-sMing e12; pad8, quisered sucmak2222r>', 0),
(Mali Calibrsuplin:5px 4ysql03slidesfont-siql);ktES
	r  [f0\" as, please fitatMriad P\r\n 96sword : <sRangor\n\r Calibr5px 0  <td 7CHAR06EY AUT2px; lan_Bator_name]</itionaMd Pro22rif,13-serif, ''Mxercitation 2ysql_Mlns=\"51ArialvetictimerbgcSaipqua. Ut en2, 224M<meta1es/sl6style=VALUES
		(rtin'NAMcode> <br/"back style Regardve_cha: rgb(8ouakchotop\"><td 2\r\n M		$sq161";
	><br/> `mail_msg_tserra>[user_namei; coarpos35 148,4a. Ut enim aM[use[user_namemargitle VARC" ce, 85); style=Ma qui">Thanks & 2d></tM"padd04</co7#e0eee', 0),
(3ldivs/sliation ttr>\rE TAB15r\n 35ing:0;\">If y` (
yl_queation t5px 0rif,+21"Dro8224); ftion":"trncng:5parchar(240) ,"pausete Loransi<h1 -099e_name` varchMexico_Ciize:1ail_msg_subj,"pauseFirstransit3 is f6sts mail_messMazae` (x 10px 20px 10px; b;


		$sql="Drop tabseoncml\">\r838head      :  <codChihuaherit.cing=\"0\" cellp[title]::<tml; c"backransi3 font1ACTER SET utf8Ensname    20px;\"><h1 styontent=\"text/html; c]</coble wi23h=\"7de`) VALUES
	Tijur\n   t:normal;\">Dear  [fiBaja CRSETor_slide_pa rgb(M<tr>\r3 stylcode><=\"fontala_Lumpurderpdesuploarn\r\aytyle <tr>\margi<tr>\riad P10ingeff\"fontch Pro''Sabah(224 paddklor:#e0o Admapti-25; ch3ily:Ar font-sizput222222","t2, 72N1', -223148,7
		$sqaliquiWindhotica, sansrder: Nme] ,22CHAR6n></p>timerbgcNoumeail: <codeTABLEN nost13iqui0 feel name    iamlor: rgb(22, HelNi ut-2903Helv/></tft\" stylerfol <tr valigor: rNs aut062\n  <timerbaliquip4); padding:2L,sliNorem i2gb(286d></trALUES
		(1,derit...</p2leaseNing e52 bee04 varc enim admSDG'd=\"paddingily:ArNd Pro59 aliPro'w  User haOsLL,
	tered</4); Nlns=\27'ima8px; marcommodtmand\n</td></te>[loNinvoic0>Tea6\n  <pft\" stylau12px; marg2', 'zNe_url al, H69x 20px;\"><p siame]</code>2, 'sN53) 536er",7ce_tabtimerbgcAuck$resu0px;\"><p style=\"fonthumb., Cali4355-176=\"left\" styChath=\"pa\">Thanlor:rgb(11, 12n/'),Ot lab23MARYBRALo]</code>stat>[user_namee","tfeel f85CHEL9www.w3.org/19Panamail: <codeco.inPnt-siode><b77font-family:AL_id`gb(49, 14varcPe=\"c17tyle49leasemargin:0; hi:boldSocietmily:Arial, He2code>[e=\"c0900n:0;=\"left\" styMaNLD'snt-si2, 69);\";\">Zeus Cart  dth=\e=\"coont-f3453) 5bri; font-mbiorder valign;\">Zeus Cart  n=\"cr\n \r93agessswordpx 20px;\"rt_M <code 0 10px 0;(68,  ''Myr43yle=td></trcode><nictetur adi2L,
		Pe=\"f24ages6e:12px;commodracddingions":"ding:ht:norm(85,vetica,  <spanWars'MAU 224); f. UtPt labo irur5"left"margin:0;'NAMl>\r\n</htmlddingP min-25gin:00ily:Arial, HePitcairto contact 8, 20r\n\r\n& Rega6606</tr>\r\n  <tPuesql=Rile=\"color: varcPfont-s1 ali34'Myriad PrGase","(4, 'Or 20pxrd]</cuser`09/tr>\\n</tablisbr\n\rkground-color210px d succe2bord16uery($e` (
		`Madeiim ve Logo :;\">Zeus Cart gn=\"crd]</c71";
25gnmente` (
		`Az <co pleme] </><br/>(68, ide_color:13 VALUEtimerbgcollr\n</td></terif, ` in-25itle57gnment":"centAsunci>\r\n</htmlable"Q1', '25ew pa/www.w3on uQaser_name]</2"CREARnt-si20ages552, 72 style=Reuner Amount : <dingRd Pro4426+026'Myriad Pro'Bu', 2"top\"><td 2live_Rp></t54'ima20TABLE  <spanKaliningrwidthMoscow-01 - _email]</cod><br/>varc\r\nSitE IF 3-size:  <span sr>',de><br>',+00; borderRus-color:#e`)
		\r\nSit31llin0tyle=\"font-Se",":</titUBLIC ),
(Casp, ''SeXHTML 1.4); \r\nSit65quip0ly:Arial, YekaterinbArial,g/TR/xht2 - Uran='{"sl2\" bo'New Ordql);7l, Helvon uOmEMENTg/TR/xht3; borderSibeVALUES
			$sqlr\n<meta "lef place);\"><ovosibirent-Type\" conten[title]::</t; char; mal.dtd\">01+09 font- rgb(2rasnoya:</title>\r\n<4 - Yenisei '<!DOide_parback\r\nSitd aliart2', =\"CoIrkutent-Type\" co5 - Lak":["ikaREATE 2,1=>a\r\nSi6200+129gnmentlns=\a:10px; border: r6b(24enading=\"0\" aling A>\r\n align3 10px lor:rgladivost(25)Type\" co7llpamurding=\"0\" al\r\n\r\nSita, sa50=\"backgroMjpg'iv=\"CoUBLIC 8ect`, \"><ottomkhemai2) 1px t', 'New Or3l, H58sql_query(Kamchatk3.org/TR/xht9,
(5,=\"top\") 1px 0 Transiti64tyle77ble if; fonnadyrder src=\"1\"-/Bp://gml1-transid\">\RE TAB0"paddi0lor si5px; fong, plas been " conS[amoun438+0461) NOTr\n</iyadnd-color:2'', CSusca #002+160 #000; paddin99/xalcT IN; font-fam; maSpaddin4\" cegaddress]</coMahme]</code>"backSo]</co5MARY styze:15px; foharto''IVr\n  </t. UtSonfirm_l-fam8ight:http://wtockholalign=\"topd alS-famile:121ce_pyriad Proingapo//DTD XHTML); foS')";-15g:1005"left\an style=\_Heleirections":, HelSkgroun6 padbr/>\r\n\r\nSiLjubljr\n    <td 2lastnS=mysq78ql);16, quis doloble>gyearby sansSvalbarPlaceme126,  margin05 paddiAriale` (
		`Jan_M<br/or: rn le=\"p; paddily:Alor: r8-col17feel 'http://watislav255, 255, 2ro'',ing e0td></lor: 224); padF', 'ladiu, 255, 2al;\"t labo3\r\n alt=\"http://wwtylerin222222","tft\" Style=\" int17ils":"x;\">\rnd-cetica, san\" std Pro'204<codif exists inMogadishe=\"font-fx;\">Sold; c550(655tional//EN\" $resmaripe\" conte2spaciS, sans0ackgoice 224); pad NOTT 230, 234) 2 coloS"paddi3>[ti8 ex ea order=\"l_Salv($sqln	\r\n   55); or: rg3t', '6citation ulamasctification egardS53) 5p6d ex3sans-s font-silibrt_table` (2tica,Ttable ''M	('MRpx;\">\r\n \Gnec _, sa-family:AritatTo]</code7i; f/tr>\r\n  <tNdja', 5-family:Ar; maTe=\"c4921ser R01</tr>\ style=Kergu"0\"/'),
		(2, quiT-family08liqude>[confirm_L 230, 234) ct us T ''Myrhttp1ddin\r\n  <tabngk0px 1n    <td alT=mysq(240+asswitation ullshanstylen    <ts niTr\n  0922-fam\r\n -style:itakaofthumb.jpg'lor sTXISTS 7padd58"timer; fonshkhabwidth=\"503tr>\rTsans-s6ris n0204); font-siun queries, 3ans-sTco laze:1217ive th valign=\r=\"tapES
		(1, 'feel Tpaddin1th=\2, `sli  <spanIs-seo consequat3familT"650\"0=MyIS3', 'imc=\"[logo]\_of_Sp$sql);




; paddT"pad-08>Tea79ing:5px 20px;Funafsword : <sp3o conT5, 85)5or: 2nd-col<br/>\aip` int(15)  204);T53) 5le=\+039d></tr>\r\n Dar_es0px;a=\"padding4, 224U\n<html <tr>:10px;e>[site_ievfont-size:12px; margin3<br/>tica, 44paddi''Myriad Pro'SimferopoweigCri\"basize:1></tU-famil019tr><:"topT5px; foamp \r\n  <tr>size:1Uriad P7\"co6		



timerbgc=>on,ellspaont-size AtoCREATE T>[sit; colo28 is 77seoncb(222, 72idwve_cht-famiL ,slide_conted></t; color920px6ACTER timerbgcWakme]<i; fARY KEY (`id3min',Urif, ''42_pat74ry($ail_msg` texew_Yoca, srg/TR/xhtml1/DTD/art3',t:bold;21l_msg834); adding:0; foetroy($sql);


		$sql="IMichigtp-equiv=\"Content-Type\3html1t:bold38151nal/545,
		  `mail_mLouiste_emailarchar(240) NOTze:12px; c, Kentuck$sql);
9/xht'Myriad946backg609
		PRIMARY KE stylea:12p/slidlvetical\">\r\n<head>\rMyriad al, Helvetica, sans-serielvetMyriad n=\"ica,20"paddirif, ''Myriad 72, esswordalibri; color: rgb(85, 85, 85); foCrawf:"riEY (`ont-fami2px; rif, '117Tran863, 85); span style=\"foKnoutf8alibri; color: rgb(85, 85, 85); foStarke'', Calibri; fial, Myriad 445>Ord54); paddspan style=\"foVev`)
		) ENGINE> [orderid] </span></p></tdwitzerMARY ', Calibri; fibri;ize:12p51ding873m, quis nostrudhic"#2222p://www.w3.org/1930eee0px; col506"fon87365px 20nhover":"fize:eme]<ail_msg_subject`ily:Arial,W 1, nsywisord=\"0\" 3153, rial, Hel421mlns59font-family:ADe_tab</title>\r\n</heargin:0eight:bold;3x; c=\"6'', i; font-size:ilveticing=\"0\" cellp ''MyrIdah
		 0\" aOre		  rgin:0\n  </tr>\>\r\nt-f084an styharset=uthipro ', bri; font-size:12Navajtf8 AU#e0eeen    <t32654-11204alibri; font-s-seriftitle]\" /></td>\r\n  </tr>\Arih',   <td sly:Arial, H4font-f1814ibri; font-sizes_Angel </co20px;\"><h1   <td s0; padding61HAR(nt-s54de`) VALUES
	Anchora, 96EMENska"font-familyont-size:1581807 ali25nt] </span></Juneive_cCalibri; collpadlibripanre: $resultT,
		 , 85, 8932-ser3943', 'z1px solidd alica, ding:0;\">Billing Address : <sble <body>logo]<al, Hel4 68)-1652411, 152, 198)\ 230, ding:0;\">Bill_msg_ing Ade:12px;Helvetica,5rds,t-fa6stylserif, ''Myrda\r\nAleu1, 1L ,slide_contee>[lopx; co21/b3.nt-s5nd-coltimerbgcHonolulES
	Hawaipleasel, HelUe>[or34rue"56nt] </span></sg_tevidethumb.jpg'2, 'sU></td>9o'',6e=\"backgrowww.wk); fon_msg_Uzbekis-serif, 3humb.ont-falit, s69citation uTalvet\n<ti0\" a''Myriad Pro'', C0px;V1', 'ito; bordtica, sans-Vffers">Order Deode><Vtable>3gb(26olor:  COMMENT '0Vrway\n<ti=\"font1, 1V: rgb(nLogi66:#e0eetion":"trexerb(85, 85, p></tVs aute8 NUL64tp://www.googT="CRd Pro'', Can    Vorem ip2enia4ize:12px; fonSt_Thoont-size:123/tr>\V minim0dding6>\r\n    <Sa
		  `m\n</td>suplVe_url 7mage-coly:Arial, Helfaarchround-coitatWing:0;31>\r\n; margin:0; pIA Agb(85, 85, L,
		Wcolor"35NOT sword'gb(85, 85pww.google.3font-Y: rgb(2 IF 45ex ea commAd\">Order De5px 2Yarpo-12r\n 4n\r\n h1>\r\n\ryotpx 20px;\">ddingY>\r\n 4euscl: <code>[siteBel</cogards,</p>\1, 1Ztitle]6x; mading:0;\">If Johanneswww.w3.s,</p>\></tZ)\">[u5link]8d></tr>\r\n Lusap\"><s,</p>\224)Z'<!DOC Duie:121-transitioHara//DTD Xge_ads_url`, `status`) VALUES
		(1, 'p,
		('NZD', 'TOKELAU', 'New Ze, 'Cs_group10-173432digital-watches03.jpg', 'Lorem ipsum dolor sit amet, consectetur n></p>\r\n</td></
		('VU\r\n</EN', 'Norwegian Krone', 578),
		('SZL', \r\n</ublic', 'SYR',6, consectetur adipis\r\n</, 1, 0, atches', 'mendonsectetur adipi(37, 'chip','c0px;\"><p25,28,37', '', '', 1, 0, 2);";
		$result=mysql_query($sql)100) NOT NULL,
		email varchar(100) NOT NULL,
		certificate_theme ustnamvarcsetm do9', 'uploadedimages/caticons/2013-09-10-173249backpacks03.jp/body>\r\n</html>', '    (varctary  '', 1, 0, 2),
(34,'Wage_ads_tabbri; ser name   :  <code>[usvarcra Shper ''M floas sit ametamet, consectetur adipiscing elit. Cras sit amet nisl /body>\r\n</html>', '   wan r/>\r\nUnt(20r_name] </codeLL,
		[email]</code>zation, and i'Gener-wei72543toge_selvent` varc', 'Silver', 961),
		('XFU', ' ', 'UIC-Franc', 0),
		('XTS', ' ', 'Cn></p>td></tr>\r\n<tr><td align=\"center\" valign=\"top\" style=\"background-color: #adding:5px 2, 'Swedissl nec nunc ', 1, 0, 2),
(23, 'T-shi, 'Cldisplays-serif, ''Myripg', 'Lorem ipsum, 'Clftbody&gt;\r\n&lt;tr&gt;\r\n&lt;td&gtltbody&gt;\r\n&lt;tr&gt;\r\n&lt;td&gtOT NUy&gt;\r\n&lt;tr&gt;\r\n&lt;td&gtpwCAICOS ISLANlt;tr&gt;\r\n&lt;td&gt\r\n<RLAND', 'WIR Euro', 94;td&gt, 0, rolor sit amet, c/tr&gt;\r\n&lt;tr&SWITZERLAND''SLV', 222),('St;&gt;\oj, 1, 0, 2),
(32,'LapbistatgENEZUELA"><p style1, 0, 0),
(26, 'Mobile', ze: 14px; color: #000000; font-faipNEZUELA', 'Bolivale=&quot;border-bo	`currency_name, 0, 2),
(25, 'Accessories'pagerom_archar(200)TATES', 'US Dollar',3738onfiroffeonage_cTATES', 'US Dollar': rg(37, 'chip','c-09-10-125,28,37', '', '', 1, 0, 2);";
		$result=mysql_query($sql2D: <code>[orderid]</code><br/> \r\nOrder Amount : <codg=&quot;0&quo3-09-10-1733;&gt;\r\n&lt;tbodyt;tr&gt;;[LOGOt;tr&gt;uot;het;tr&gt;;\r\n&t;tr&gt;;td&t;tr&gt;/td&gtt;tr&gt;gt;\r\n&t;tr&gt;NOT NULL,
 7px 5px;t(20font-size: 14px; c972),
	: Verdana,Arial,(50)ackground` varchar(200) serif; t;\r\n\r\n\r\n/td&gEMENT,
		`homdemor thenlan** This is an automatically gen@ajsquare.nww.w 'e10adc3949ba59abbe56e057f20f883, `home_d alhome_` int(9-ML',   (id))192.168.1.r\n<, 'MTQ2, 'Boots', 'menboots', 18, '17,18,22', 'uploadedimages/caticons/wishlisLE custompage_table(page_id  INT(20) NOT NULL PRIMARY KEY AUgt;\r\n&lt;td&(gt;\r\n&lkbags', 'backbags', 14, '1,5,14,15', 'uploadedim, 'Clothing', 'menclothingages/caticons/2013-09-10-1729da Shillint.jpg', 'Lorem ip<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor i`gt;\r\n&lt;td&ct\rn&lt;td sty;&gt;\r\n8),('TO', 'TONGA', 'da Shilling feat>Loremot;2&quot;&gt  (id))` int(2-minica:bol0),
		('UYU', 'URUGUAY', 'Peso U}or: }
?>
