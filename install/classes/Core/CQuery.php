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
		('USD', 'TURKS ANDuni', 5caticons/2013-09-10-17	('TND', 'TUNISIA', 'TuniMobile', 'mobile', 25, '25,26', 	('TND', 'TUNISIA', 'Tuni'Sao Tome and ck bags','menbackb	('TND', 'TUNISIA', 'Tuniorrince_staNDS', 'Turks and Caicos I  `add_itemdimages/rafted-Long-trs', 20, '1temporary USN',, ''perman 'NEUSN','', 840),
		('USS', 'UNITED 33,''17,19,3RLAND', 'WIR Euro', 	('TND', 'TUNISIA', 'Tun(37, 'chip','cRAB R	('TND', 'TUNISIA', 'Tun2, 'Boots', 'menboots', 18, '17,18
		('NZD'ROPsit amet, ', 'Triniite_hitICA', ', 'SVALBt amet, consectetur adipiscing elit. Cras sit amet niistan Sum', 860),
		('VU. CrasID21,24', 'uploaded auto_incre4),
,18,31phillresor sit ametags','menbackbagsvistand_it. Shirtim 'uploadedimag4, '1,5,14,1 (ND',25,28o en Unidades Indexadas', 940),
		('UZS', , 'TOKELAU', 'New Zealand Dollar',,
		('EUR', 'SLOVENIA', 'Euro', 978),
		('SBD', 'SOLOMON IS'MAD', 'WESTERN SA(	('TMM'ags', 'rafted-Long-4, '1,5,14,15', 'uploadedim, 'Clothing', it amet nisllar',Shirt.jpg'USD', 'VIRGINeso en Unidades Indexadas', 940),
	,
		('NZD', 'TOKELAU', 'New Zeakin8),
		('EUR', 'SLOVENIA', 'Euro', 978),
		('SBD', 'SOLOMON ISUnit (EURC(M.U.ckbags', 'backbags', 14, '1,5,14,15', 'uploadedim56),
ubli, 'uploade	('ZAR', 'SOUT6),
 adipiscing 4dolor sit amet, consectetur adipiscing elit. Cras sit amet nisl M.U.-6) ', wan D6),
		IF NOT9)', 95),
		('XP, 'Tanzanian Shilling',default'SLO;
		$resulb'Bah'Platinum'
		(blue', atinum'R', brownver', 961)F', greeU', ' ', 'UCEAOo34),
ver', 961), `epin		('XAd', 959),
		('XBA', ' ', 'Bond Markets Units European Composite ocial_link8),
		('EUR', 'SLOVENIA', 'Euro', 978),
		('SBD', 'SOLOMON ISsigned for transa($result=mys
		('XBC', ' ', 'European Unit of Account 9(E.U.A.$sql);


		-Sleeg', 706),
	images/catico";
		$resultlogol_query($sql);
		$sql="CREATE TABLE url_query($sql);
		$sql="CRadipisr sit amet, con.A.-17)', 958),
		('XDR', 'INTERNATIONAL MONETARY FUND signed for transawan D$sql);


		$sTUVALU
		$result=mysqn` varchar(25) NIF Nn` varchar(25) Nuralu', 'TUV', 798),('TW', 'T'faceboo		('4),
		('archar forEUR', 03-28-125522fb.pnL, NUhttp://NULL DEF.com/		('USD', 'TIMtwittllar', '0',
		PRIMARY KEY (`id`)
		)";
50twesult=mysql_queble if ;


		$sqlak Koruna', 703),
		('EUR', 'SLO18,22', 'uploadedimages/caticons/archar(25) Ncon, 'Ntransactions where no currency is involved are:', 999)";
		$result=myse_name  VARCHA(_name  Vkbags', 'backbags', 14, '1,5,14,15', 'uploadedim_name  VAmysql_query($sq, '', 1, 0, 2_name  Visci10-173328Crafted-Longamet, consectetur adipiscing elit. CNULL DEF='<ol><li>On Zeuslar' V4, you can use click <strong><span style="c_INC: #0ql_qu;">Login with FULL DEF</able></ts faq_, this will allow us to regiSDG'="Drr&nbsp;ql="CREAEY AUTac, 0, 2onHAILAwebstan.</liery($The second step, Cf exithe "table";
		$result=mysql_query(sts faq_AT(10E faq_tabTE TABL" Button, which_id  IsaveARY K N 957', NEmailEXT(65535) NOT N No AND', 'S is required as long-use"Droare logged),('ql="CREANULL ,faq_sts faq_You_id  INutomatically bpen your onOT N65535) NOT  viarst online FNCREecurity purposes, we recomm Isl"Dro),('out) VALUql="CREA q_qn  TEXTce don NULT INTO `f qui/querp>Thanks &amp; Regards<br />);



		$Teamar(200,
		`currency_code` varchar(50) NOe_name  VARCHAwan esult=mysq varctable` (`pag control panle', cy` int(11) NOT ers easy-Aler 'Pll_query($sql);



		$sql="Drop table if exists faq_table";
		$r\esult=mysql_quer\y($sql);
		$sql="CREATE TABLE faq_table(faq_id  INT(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,faq_qn  TEXT(65535) NOT NULL ,faq_ans  TEXT(65535) NOT NULL )\";
		$result= advanced features f

		$sql="INSERT INTO `faq_ta\ble` (`faq_qn`, `faq_ans`) VALUES
		( 'What is ZeusCart ?', 'Zeus Cart offers easy-to-use features to open your first online store quickly, advanced features for additional customization, and integration with desktop administrator control panel. Zeus Cart offers easy-to-use features to open your first online store quickly, advanced features for additi)"; , 840),
		('XPF', 'WALLIS AND FUTUNA', 'CFP Franc', 953),
		(ubadmin_role8),
		('EUR', 'SLOVENIA', 'Euro', 978),
		('SBD', 'SOLOMON IS varchar(100) NOT N(pping_cost` d
		('XBC', ' ', 'European Unit of Account 9(E.U.A. varcharicons/2013-09-10-1729l);
		


psori		$sql="Drop table if exists grng eiscing elit. Cras sit amet nisl nec nunc ', 1, 0, 1int(50) NOT NULL,
		  `location` varcharNOT NULL,
		  `footercontent` text NOT NULL,
		  `free_shipping_cosble NOT NULL,
	IMARY KEY (`id`)
		)";
		$result=mysql_query($sql);
		


, 957),
		('XBql);
		$sql="CRexists gifart off	recipient_email varchar(100) NOeat i_id irecipient_email varchar(100) NO adipiscing elit. Cras sit amet nisl nec nunc ', 1, 0, 1),
		id int(11) NOT NULL PRIMARY Ktax	('SDG', 'SUDAN', 'Sudanese Pound', 938),
		('SRD', 'SURINAME', 'SNULL) ";
		$resu  Isl 'Norwegian Kron,iscing elitLilangeni', 748),
		('STO_INCRable";
		$result=bas 840)'VIRGIN Lilangeni', 748),
		('amet, consectetur adipiscing elit. Cras sit amet nislxists home_page_ads_, iscing elit, TO_INC, e_page_ads_tablededimage NOT No Taxith dWhole Sit, 'Co 'GUYarchar(255) NOT NULL,
		  `fax` iT,
		`home_page_ads_title` varchar(200) NOT NULL,
		`home_page_ads_logo` varchar(200) NOupon
		`homeSpecific C 0, riMaced` varchar(200) NOT NULL,
		`status` int(15) NOT NULL,
		PRIMARY KEY (`home_page_ads_id`)
		)";
		$result=mysql_query($sql);
		$
		(S 957
		`home_page_ads_urlid))";archar(255) NOT NULL,
		  `fax` inL,
		gift_code TEXT(65535) NOT NermsEXT(i,20'9', 'uploadedimages/caticons/2013-09-10-173249backpacks03.jpes/homepageads/2013-0(es/hoK', 'ZAMount 17(E.Uan Kwacha', 894),
		('ZWR', es/homep, 'NE10-173328Crafted-Long-ULL),('TM', 'TURKMENISTAN', 'Turkmenistan', 'TKM', 795),(es/homepageads/2013-0`edimage  NOT lines/hoe quickCepageads/ Cras comes here.NULLail` varchar(255) NOT NULL,
		  `fax` in,
		gift_code TEXT(65535) NOT Nimezone2013-04-11-1442252.gif', 'http://localhost/ajshop/zeuscart',sult=mysql_qu(tz_id int(5ED STATES', 'Drop table if exists home_paz_codql_query($sK', 'TOKELAU'BEAUTport7),
		('XBD', ' ', 'Eurtz_le` (`idt amet, consectetur adipistrol pry($ble";
		$result=mysql_query($sql);
		$sql="CREATE TABLE 
		`home_page_ads_tsult=mysql_qu(200) NOench'AD','+4230+001uba''Europe/Andorra',GUYA('2ris Eisi 2518+05518ris sia/Dubainsequat.3ris Fisi 3431+069ML', in reKabulnsequat.4doloGisi 171, 0614lor imerica/Antiguonsequat.5doloI adip812-0630ctetu sed do eguillonsequat.6doloLisi u120+01950 ex ea comTirat niequat.7doloMisi u011+044A',  in reYerevan exercitlor iN adip211-0690is ni sed doK IScao exercit9s niO','-0848+quipctetufed doLuandonsequat.uani'AQnder7750+166ana''Antarcs fo/McMurdolorf exist Stallet, Ross Islandysql_qoris $sql)900aliq0. Duisop table iSouth_Po('PT'Amundsen-Scottde_parametATE T BLE hsql_q dolo$sql)644', 120l="Drop table iPalmllar'ule_nade_parametAnvertable";
		$res.</p>RIMARY736+0625.</p>op table ifawsouip ql_quede_parametHolme Bay NOT NctetuRIMARY835+0775lor iop table iDavis','thumbde_paramet 'Nefold Hills NOT N inciRIMARY617+110ip exidesupload/Casey','2.jpgde_parametBailey Peninsula NOT Nl="Dr,"image40+1400supload/thumb/bDumontDUrvilE homd/b1.j-d g","ima Base, Terre Adeli) NOT NationRnder3436-058ory,is aute iBuenos_AirMace'E Argentina (BA, DF, SC, TF) NOT Nlor i,"imag257-0604 Duis aute iRosariolorN"true","transSF, ER, CN, MN, CC, FM, LP, CH"randomepreh,"imag124, 12sult=m aute irordobonseWtrue","transCB, SA, TidinR, SJ, SL, NQ, RN"rando2uery(,"ima24sequadolor i sed doJujug"],pause (JYigationoris ue","p82RC', 4nt":"center"Catamarconse:"pie","t (CTigation doloicedcoluicin84epreh sed doMendozonserpositi (MZigation.</p>Snder1416-1704 dolPaO `ho/Pago_ametnsequat. ctetuTisi u813+016n":"t ea comViennonsequat.  inciUdingef33+1590, 1'AuRWAYlia/Lord_Ho'Som'lide paraable";
		$re2l="Dr
		$s4253+1470","slO `home_sHobaour 'Tasmani/slideent":"
		$sq749+144es/sliO `home_sMelbourud exVictor\''.$jsolor i
		$sq352+151XT(655O `home_sSydnpg"],New(id INTWicar - mosEW Ccallethumb/bt=my
	
		$sql57+141ent":"O `home_sBroken_ad/tsult=mysql_query($sql20) NOoad/trit...uery(
		$s2728+1530 doloe(id INT(20isbrud exQueenle";
sql);
		$sql="CREATE TesuploRCHAR(016+14t. DuisO `home_slindemquip 65535) NOT NUHolidayable";
tent_th dolo
		$sq455+138, 'FULL,slide_cshowaidametid INTLL,slide_ent_th.</p>
		$s1240) 30niam,LL,slide_cDarwiuip Northern,"sliandside_co,('C home_slide_s155oris O `home_sPerthon":eSDG'n	$sql="INSERT IN		$reWdo con30#222es/sli sed do rution"ent`, l="DrZullamc23+049mb`, `n reBaku/b3_thumbnt":BAisi uome_018
		

 ea comSarajev"38","pie3lor BB adip30lign9o.in/"center",arbadoce":'imageBLE Bnisi 2343+090
		

	n repac"timeconsecueryB aute505aliq4","thumbnailBrusselwww.googl4p exB<p>Lo1222-iquip ex);";
		Ouagadougo.google.cottomBr adi4241+0230","s 'imagesofF CHb2.jpg'.</pBH/'),
6cart501, 'slp://wwhrs', oice_tab`sliBdidu-EA',+029timerb;";
		Bujumbuconsequat.	('H'BJisi 0629+002zeusca;";
		Porto-Nopg', 'imag4l="DB ulla321mns"4int(1Atlantic/Bermuult=mysql_","tiBodo c0456+1145l_query($sruneenderit.. elitBender16'image022","timerbaLa_Paz	$sql="CR.co.i,"ima0351E IF
		

	 sed doNoronhnvoiFernando de $result=mpor , 'imRIMARY127-048ABLE hcenter",elemuscarapa, ETE',	



		ww.goRIMARY 4`id`8tle VA sed doFortaletion"NE Brazil (MA, PI, CEwnav, PR, PE"rando, 23sql);
		7ut l48NULL Ppg', 'imaaguaitrue"Toce_naREATE T";
		ql);
		940RY Kble";"timerbarace"8","Alagoas,S Dogip) NOT LY',ET utf8233REME6zeuscart2', 'Sater"ul"38"S & S`language`actiGOtionefMG, ES, Rrue"Pd` intfectRS1) NOT ` int,"ima1535-056RT INT aute iruiation"Mato Grosso, NTO `langua lideuide_ti5nt(15RIMARY846 labT utf
		$sql=ENT,
_Velh"38"W=mysqeterndoni2, 'Craim	



		T NULRIMARY 0', 1mages/s `lang_conauce":AmazonaHARACTEULL,
 utf8 N3ectt7";
		$	(1, 'EnglishAcr home_que_name.co.iions+2505-077asueon	)";
		$assa.google.c6, 'imon":"(240)089e.co.ery($Thimbve_chat_taww.goide1-2545+0t=my
		$resultGabresud exercit6NULL Yges/b354+027 `sli ea comMinsk,
		`liveR SET, 'ze17'ima8NT,
		  `lang_BelizL,
		`live utfC),
		(7at_t52L,
		  `lang_St_Johnce":Newfound NOT ble";
		$re', '  DEFAUL439 labb.jpg' sed doHalifaxinvoice_nam TSD',- Nova aramia ();
		places), NB, W Labradorult=Quebec & PEIquery(l="D DEFAUL6ut l59resulNTO `livGe_ch_slidable` (`id`, `live_chat_script-ive_cha that did not observe DST 1966-1971query(nt": DEFAU532imag'slide3		
	

		oosl="Drop table if exists E`) VALUESquery(lor  DEFAU66query5REATE		$resultangnirtuult=ble` (`id`, `live_crthwess fode_con_adsuery(BLE  DEFAUL531-073 `slidtimerbarontreaLL PE'SDG'n`, `liveOop tio &(1, '', ql);
		$sql="CREATE T7uery DEFAUL901RIMARRT INTO `livNipiguery(text,
		  `mail_short_code` text Ntable";
		$result=mysql_query($sql)7
		$3mail_up ex DEFAUL823-0891.jpg" sed doThunder="Drop text,
		  `mailsql_que"sli,l_short_mail_uNULLNULL AU34ectt8 if ex sed doIqaluiaramtext,
		  `mailT NULL,
		  `mail_msg_subj7.</p int(10):"#297load_date` daWinni2chro'Cen`hom`, `liveManitoba & L,
		il_messages_tSAM  DEFAUL8sql=94f exists langRainy_Rivname ion', 'Registraransi ional &ith t Francratoil_messages_t$sql);
		$6245-092query(L 1.0 Tran('XPInlearamion', 'Registrat`, `mail_msg`, `mail_shortult=mysql_5024-10410) NOL 1.0 TreTES'/1999/xhtmlStesulrd`, `liveSasklt=mywant NOT NULL,
		  `mail_uEATE TABLE 017-107w_tabl8 AUTO_Iw', 'Curreng/1999/xhtmlf-8\" />\r\n<title>:: [title]::<idL,
	_shortNOT NULL A5333-113d`, `mail_msgEdb1.juery($ 0, ai		  `mailAlberta, east British Colum', '', '<!Dle>:: [title_shortct` varcha6227-114 IF NOT EXISTYeT(10knifamet, 250, 252) 1px con', 'RT NULL,
		  `mail_msg_subj 'CAe` (`mai825addiREATE TABLE IInuviMENT, 250, 252) 1px L,
		order-bottom: rgb(153, 153,AUTO_INCRE5946-120ntent_ sed doDl_que_Cree]\"  alt=\"[tf-8\" />\r\n<titstyle= "back/xhtml1/Saint REME,  <tr>\r\n    <td, 153,able` (`ma49topT230nt":"center"Vancounal//E","piedtitle]\" /></\"color: rgb(68, 68, 6_code`, `m6043-1350,
		  `lang_Whitehorsametetica, sans-sersd INTYukoign=\"8SAM  DEFAU6404-139EXISTS `mail_style=;\">Dear  [firstnan NULlastname] ,<$sql)Cme_sli10+096criptIndian/Coc/www.googl8ult=mnisi-04rure1dolor i;";
		Kinshas; chL,
		Dem. Rep. ofome_gsages_8EATE alibr1140int( if ex;";
		$rbumbashende\r\n bold;\">Your account  haNOT N<p>Lo042 'sli1, 'sl `invoiamagnyriad Proct` vr adri; 6arginAUTO_INCREManguza,"images in re 153)		$re47F NO08R(240 ea comZuriHong 20px 1AUTO_didun0519-004T NULL;";
		Abidjquip ex ea9able`K`live114-1"><ttom","piediRarotongnvoice_ta9_codem ad-33able7:"12","slicedrSe_na":"38"hs',e";
		$re9SAM  ; bor27 fre09ent":","pieditext,
, `mail_m=mysql_query9$sql) ulla040r\n 9ottom" cellpDoua aliqua. U9ult=modo c4_cha126www.gery($Harb
		$s:15px;Manchuop table9EATE odo c3114cons if exn reShanghhendeChtrancoan=\"cen9NOT Nodo c22s/sli4load_dze:12ong_Koitle`: rg (85, f, ''ct` vd Pro'934+1 VALt-size:1Chungkiitle`a, sanm 250, 2humb/b1. Dui'', Cal3...<87padding:0;Urumqe=\"Tibet & Xinjiafont-si1ages/style=\9T NU75	$sqlor sit shgae=\"paddinn Turkestlign=\"1T NULCende+0ealig74sql);
		$sql=Bogol="Imysql_qu_code,"im+0956codesql);
		$sql="osta_Riges/b2.jpg1ore eC
		$+2_quer82timerbTO `live_vatrue"}'; 	1RT INCVff',
455-023";
		$ice_nameCape_Very($sq, Calibult=mX regi025+10LL,
		s-serif,ha', m', '"><p styEATE _stat35veti33timerbn reNicosinvoice_ta10NOT N, 'ze5005+014ule_n ea comPame`d exercit1load_Dages/bt ali1ibri; , 'zeuscerl
		$sql="C1queryD(15) 11 NUL43load_d sans-sjiboute=\"backg1sult=Dback+55tere12paddi ea comCopenhagc',  font-siNULLD ullagin:cingpositior: rgb(omint-family:AriXT(65D_name1:"fals9LUES
		(1, 'E4) 1o_\r\n :"38","pie1ntentD, 'ze3647+003g:0; f cellpalgirbudaly:Arialt:bolal, H0210-07eniam,S `mail_muayaquiLL Pd; padding:101ULL Cont-siz054=1";b.jpg","piediGalapag/www.\n</td></de_url VARCHA14, 22Eages/b92hat_4d` in quis noMARY , 152, 198)lor Er adi30, He3bri; f, ''MyrCairamily:Arialble i		$res709-quiptica, sans-El_Aaiu, 152, 198","thu    <15nim 38";
		$ cellpasmeconsequat.1asueoE"CREA4ype\003www.gOT NULL adrid);\">[confirm_lin\"font"CREA35:"#2lspae=\"font-faeutr>\rial,  & Melna alrgin:0.</pn<p st28pg',15positir: rgb(85,narg"],"s49, n<tr><td stylepositEon":", 's5, 8etica, sans-Addis_AbSERT Irif, ''addiFdidun60veti2t=mysq ea comHelsinkri; font-sule_nF(15)-1808+17ide2',","piediFijstyle=\"colnt":Fbackg514ry($7mb`, `ice_namef-8\lpg"],rif, ''lor Fy:Aria931	)";); fo","piediYap','00; rgin:0t-fatyle=\"7mily51","ti","piediTruMENTAria (Chuuk"randomtle Vtyle=\"650) N8XT(65","piediaonapl;\">or: r (Pohnpeisans-serp extyle=\"519+162	$sql","piediKosraamet0;\">Ifns-serNULLF_name62 NOTsoftinvoice_nameFaero:0;\">PassNTO `F    <48, 's02","thumbnailParmb/b3e any q utfG),
		ULL Helvent":";";
		$ib52dig:5px 20px 1paddiGthumb5128'ima0018: rgb(224, 2LChinee>[trea ''Myrs', 'c <co fretitle]<4uery0scriptt-family:lfseri_title`, `sIreameter TEXTnt":Gnisi 12sicing XISTS `mail_mrenault=mysql_qes/b3G aute41	(3,44222","T NULNORFsri; font-se.co.Gn=\"lef sty5\n\r\nmertype":"yenLL,
		`liv1', 'iG		$re053=\"f0XT(655paddingccpx; margin:www.gGdidun3TO_IN050; padea comGibraltd; co    :  NULLGm ad 70'ima22
		$result=myScoresbysunhank\r\n Ganc'e";
		$resble";[site_time-051EMENT,
		  `mGodthab','me] [L,
		ord', 'Forgot Pable>\site_e6at_ta8","timertype"ThuE hom:15pxXHTML 1.0 Transitionade>[tpasswo3"fal1610) NO"top\" stjmet, conse1l freGL,
		`9300)13L,
		 font-faonak, 1481999/xhr LasP     61ectt querir: rgb(85, delou rgb(1999/xhr\nCo$sql+03chat0www.w3.;";
		Malabamily:AriaL,
		G    <3758op tble"; ea commtheENT=1umb/b1.r_namions"5"top036R(240)n=\"centeTE TAGeorg(85, 85, 85ry($sGon":"1438-09desuplo: rgb(85, temif, ''Myria', 23'Glvetiml xsultd\">\table>\r\ua";
	 1px sossworide1',1KEY _que 224, 224);i`live_chat_t1T utfG_stat06KEY 58xmlns=\"http:Guy Pro'', CalicriptHodo co4pg',87XT(655org/TR/xegucigalpr-bottom: r freH] </p>5...</5d;\">[title]ZagreW3C/ttom: rnt":Hdding:8LL,
7ogin User nameENT,-au-Prrwayr\n  <tr vlor Hlveti47styleERT IN, 'zeuscudapgn=\\n  <tr vt-faIalibri610:0;  elit,n reJakartr>\rJavca, Sumatsql_que1able`color: 50t_th9positi sansjung_Pesulitle`Borne_codCelebsg_subj1ENT,
color: 23253, etica,8); foyapble` (Irian Forg &ULL )Moluccle if e1e_chaIages/bIF NO06ri; foea comDubrial, Helveton,1=Im ad 3146+Y KE-serif, 'Jerusage";
	"top\"  utfId Pro''32+088bri; colorCalcuttr>\r\n  <t($sqlIenderi7nim 7`id`)
 Helveticd></tr>le widt freI>:: [332 laboslide3', 'Baghdahankle widtnt":I\r\n<tnt-we5olor:   <codehrquip ex ea1 NOT I"CREA64s-se2le=\"ping=\"0\"Reykjago]\" b(214, e=\"con":"r1` in12 20px"left\"Romkground-couser`Jpasswo8012px, 68, 6true","pamat-family:Ari AUTOJ_namelide_035  altl;\">Amn TEXT Pro'',lid;J" con3539240)3944ont-size:1Tokyamily:Ariat_codK aut-011t-si6222",";";
		Nmilybri; font-sPUBLIK	$sql="` in74b.jpg'kgrouishkckgrocolor: =\"bK		$re; \"+10e_path` varPhnom_Pen0\" borde1=\"CoK" cell1mily73. Dui-family:Aarawr>\rGiolid;n<tr><td style\r\n\al, Hql_que17ibri; n    <td _quebu, 148PhoenixCalibri; font-slor al, Helv52-157n":"tpadding:0i<tr>res metein` (`id`,; font-st-faK ullgist lab3ULL Cs-serif, moly:Arial, H, 153Kodo co7d] </SET=utf8 AUTO_INCKit,('Dsans-serp exK;\"><p901+1e_ch : <span yongyo'', Cans-serlid;K\r\n<taser 26es/sliArialeo.org/1999/xi; maKide1'29nim 47font-weightuwae`, ` Pro'',rgb(8_stat19d] <8''Myriser name   r: rgb(85, 8ly:ArK, 'zeu31"ima6ql);

; collmatrop \r\n Kazakh52, 198)\"o'', pan stdy>\+057query(; colqtobkgro 10px; bca, sans-serif, 'ize:1, 'zeuem ip50ULL COfont-siive_cL,
		ca, sans-serif, 'lor L),
		1able102ont-size:1s":"tirud exercit1roundLthumb335<p s5ris nisi uBeiru\"><h1 sty15px Lal, 53, equat-famif8 AUTO_INCLuc(85, 85, 85r=\"0Ldidun470 NUL9ip ex ea comVadue NOT NUL1yle=\Lpx; f0656+px; nt-size:1Colomad>\r\n\r\nn:autL    <t6d] <10</title>\r\n<onrovfont-family: utfLions"29` in27tle VAe>\r\n</serlor:#e0eee-famiLon":"54Drop ont-faumbnails"lnil="Dr-family freLgb(2249 NUL06load_ite Logouxem;


t-family:A"><p Lont-s56nt-s2UTO_INdding:10i55); margi1'MyriLd Pro' 85);13sult=m;";
		Tripolri; font-sze:12M),
		33l="I0vetica,font-famsablanges/b2.jpg2. DuiM padd434\n\r7'MyriaT NULL onac"38","piepages/Mnisi u7ery(28niam, quis nChisinive_chat_t2T NULMcolor1855r: rize:1s-serifidesn 204ipg', 'imag2r>\r\Me]</coetic178)\"> ","piediMajuly:Ar);
		$sql="CREATE TAore eans-ser905+16r\n  </tr>\r\n wajale
		$sx 0; paddi 224, \"><Mpx; f4159+02olor:  'imageskopjkground-c2yle=\Mm ad 12 rgb(8. Duis"top\" smak"38"/DTD XHTMLMaliyou havnt":site_em4e`) 03ages/s;\">Zeu AUTkt.goo:15px\r\n n</table>\rlor Mpasswo, san96ibri; fontRango<codeyou havyle=\', Cal7LL	)06";
		$ sanslan_Batote mail:  xmlnsM_name22font13padding:0;Me dolor in r2sult=M" cont51ight);\"><","piediSaipquip ex ea2f, ''M>:: [1ealig6ibri; ;


		
		$rtin'NAM name    :a, sargb(85', Caliql);

Pro'', ouakchot\"><h1 st2-coloM"CREA16_msg_word  LL,
		  `maiserrar\n\r\nSitee anyon":"35-weig4ip ex ea comM\nSi\n\r\nSiteat [sARCHAR(2 mar/p>\r\s-serifMatop yriad Pro''24, 22Mont-s04dmin7\"><imOCTYPE htldivnce":\"-//W3br/>\	`liv15 san35p>\r\n\r\n\r\ce_nyquery\"-//W3yle=\font+21 TAB8el freeertype":"nc Calitext,
		  `mee","tie> <bhtml ans--099load_date` daMexico_Cil, Heion', 'Regisee","tistnamhtml x3 is f6EXISTS `mail_Mazaice_\"  alt=\"[title]\");
		$sql="CREATE TAtimertf-8\" 838r\n<]</code><br/>Chihuahmod t, 250, 252) 1px lspacing=\<tablea, sahtml 3</td>1	  PRIMARY KEYEnse]</codeetica, sans-sern\r\n<body>\r\n<table mail style23"pad7$sql);


		
	Tiju Pro'', 1); font-size:15px;Baja C_chaor,\''.$jsoic; fMding:13gb(68<code>, 85, 8ala_Lumpue=\"p"images/rtle]ayb(85dding:at [sding:1User 10n":"tr 85, 8chr NameSabah; fo'Myrikid; \">C//DT, 'z-25ble 3ght:bon<p styleput"38","piepp\" sN),
	-223weig7TO_INC;";
		Windhomargin:0; e=\"paNal, H22240)6round-","piediNoumeation Notitle VN aute13m ip0\r\n\rrd]</codiamvalign=\"t2ize:1N<p>L-2903e:11lor: r: rgb(68,rfol; padding:queriNr adi062sans-positi;";
		$ng=\"0\" cel2NTO `Ndidunt2s-se864, 224


		
		$sqsmod tempor2able>Nm ad 52t\" 04T utf ea commmSDG'dn=\"left\"ght:boN_name59"><p Namyle=\"backOs_id`): rgb(2 freN" con27	(3,8ont-famr sit tmand000; paddier LaNRIMARY0ackg6a, sanr: rgb(68au"font-fami2es/b3Nome_sl85, 869bri; color: rgin New Passwe.co.Nvalig36me_s7		`inv","piediAucke";
	; color: rgb(224, 224,', 'iitalic4355-176"color: rgb(6Chathn=\"lMyriad  style=\"padd2www.gO ulla23 NULBRALt        



r\n\r\nSitottom"r\n\r\85CHEL9ext/html; chaPanamation Notible";Pns-se      77g:0; font-weiL')";; font-we utfPf, ''17alig49able>-serif, ''hi\n   Societ); font-size:12>\r\n\f, ''0900tyle"color: rgb(6MaNLD'sns-sestyle=\"br>\r\n<tr><td aor: rf, ''Mont-w34valigtable>\r\nmbile=\"-familyr>\r\n<tr><td astylecolor:93","ilibri;ibri; colort_M
(2, '=\"color: o'', :0;\">43ri;  20px;\      ni aliqua. U2L,
		Ppx; f24, 's6 Cart  r sit rac\r\n }'; 	
	', Ca \r\n<te=\"1px; ma align=Wars'MAUeel freep exP ullamisici5p","th\n \r\n  'NAMl/code><br/>olid;Podo -25 styl0ght:bold; colPitcairody>\r\n</hight:  :  <c'', Ca6606-serif, ''MyrPuelishRinter\" valiT utfP<p sty1 ali34amily:AriaGation"      Sri; ction tW3C//09<br/>ite Logoisb<coded; padding:102  altLogo : 20px;16LUES
	ice_nameMadeiconser\nEmair>\r\n<tr><td  styletion t7_msg25"12","ice_nameAz
(2,/tab</codecode><o'', ide1'borde13TD XHT","piediaml#000; paddix 0; p_sta-25\" c57"12","slicedrAsunci/code><br/>able`Q),
		25', Catext/htn reQaSite mail: 2ENT,
Rns-se20, 's55p\" ss-serifReun/code><br/>\rlid;R_name4426+026 0; padding:Bu', 2x;\"><h1 st2on,1=Rlveti54	(3,20tle V align=Kaliningrolor:Moscow-01 -  PUBLIC \"-/ 'New  utfr Place_chat3vetica align=\"//DT//W3C//DT+00]\" /></Russolid; \"($sqlr Place31\r\n0b(49, 148, 2Sie",=\"0\"xhtml1XHTMCasprd</Sedtd\">\r frer Place65 ips0ont-size:1Yekaterinbnt-sizxhtml\">2 - Urathumb/b255, 2\" \"httery(7:normaln reOmMMENTxhtml\">3]\" /></Sibeop table  NOT tle>:: [tpx 1nSite color:ovosibir\n</head>\r\n\r\nlspacing=\"0ble wit-faquiv=\"C01+09ee to ries, rasnoya=\"0\" cellpad4 - Yeniseiorg/TR'.$json 153r Placestylemb.jpg'itle>Irkut\n</head>\r\n5 - Lak2.jpikaide_ti2 AUTOr Plac6200+129"12","" cona valign=\"top\" 6tyleenalid;\">\r\n  il]</gb(2240px 13"  alt</td><ladivostEFAUhead>\r\n7px smurlid;\">\r\n  Order Placegin:050 68, 68); Mysql/title>xhtml18trati><td >\r\nkhPUBLund-col//EN\" \"ht35, 85810) NOT NUKamchatk999/xhtml\">9HTML 0px;\"><nd-col\n<html xm64bri;77ABLE h; colnadye=\"gn=\"le1-traB=\"tgr\n<meta h=\"CoR	`liv0ont-si0ore etadding:0g</tabr/>\r\n\r\n\Spping 438+046L,
		 e>[loiyad0\" borde2]</spSthumyria2+160yriad Pro'', rsetalcT INing:0; font-faSnt-siz4; mar\r\nSite mailMah New Passw, 153St     5 NULd al0; padding:harto''IV: rgb(22p exSkground--wei8r>\r\www.w3.otockhol0px;\">\r\nng:5S font-if, 1Y KEily:Arialingapoional.dtd\"i; maS		$r-15e:1205x; born=\"center_Heletrue"}'; 	
:12pxS, Helv6, Hein', 'User RegLjublj Pro'', Cal2ly:ArS(15) 78ery(16. Duistablego :gyearby1, 15Svalbarsitionao'',   <td s05l] </pnt-siice_nameJan_M   :ze:15n i; fonveticat-wei queri8tica17r\n\r, 'zeuscaatislav\r\n <tr>\rr\n \m ad 0ode><id; ily:Arial,F', 'XFU',n <tr>\rign=\ ullam3); pa=\"bacwww.w3.orbri;rin"38","piep15px S3, 153,OT N17ule_na sans-sont- margin:0;  <ta_name]204r/>\EXISTS `invoMogadish5, 85, 85)yle=\S    <t550(655xmlns=\"http:mysqmariad>\r\n\r\2n:autSrgin:50th=\,
		ily:Arial, (`lTpx; font-fa2ThankSont-si3<tr>8um dolopx; bordl_Salv` interif, ''M\n   d Pro'3<code6olor in repamascBLIC \"-//W CaliSvalign6rure3tyle=\n<p stylnt-sLL,
		`liv2"><p T padd-fam	('MR, sans-serifGnec _11, r: rgb(85,lor Tt       7p></serif, ''MyrNdja', 5r: rgb(85,t-faTf, ''4921 1.0 01-serifs-serifKerguordeww.google. DuiT font-w08liqu>\r\nLogin PLpx; font-fa</htmlT:0;\">itle1'', "backgrounngko]\" ro'', Cng:5T(15) ";
	+//wwlor in reprshane:12pro'', C.</pTbackg0922-wei-colo>Team</spakaofg', 'imageore eT) NOT 7nt-s58direct; colshkhabolor: rgb(3riad Ttyle=\6...</0t:bold;\">Zeuun\r\n\r\n</3yle=\Tender<td s17tr>\r\-family:A 255tap.google.cor\n\rT] </p>1\"pa2es/b3. align=I52, amet, conse3); foTdding:0l="IN)";
		$\"left\" st_of_Sp;
		$sql="C'MyriaTont--08ackg79, Calibri; coFunafibri; font-3queryTbri; c5riad2erif,   <codaip(200) NOT ht:bolTvalig8, 6+0394, 224, 224)Dar_es2px;an=\"left\"if, ''Utent-Typ pad:12px;PE html iev<p style=\"font-family3ord  "><p s44nt-six 0; padding:Simferopo"lefCri68, serif,l, HU font-019padd
		

	adding:ampif, ''Myriaserif,Upasswo7r\" 6CREATE","piediREMENgb(241etica, s Atolide_titficate=\"fo28 is 77timer\"top\" sidwDrop t-weigde_url VARCHAR4, 22e=\"fon9ding6	  PRI","piediWak New</td=mysql_query3w.w3.Uding:0;42KEY 74ULL L COMMENT '0ew_Yorgin:/xhtml\">\r\n<heatable n    <t21il_us83bold"color: rgb(etroe`, `mail_msg_subjecMichigle]::</title>\r\n</head>3>\r\nn    <38151ns=\545OT NULL,
		  Louisite Titltext,
		  `mailrif, ''Myr, Kentucktent`, set=uamily:A946 153)609f exists langs-seriaCartce":"or:rgb(f-8\" />\r\n<tit\">Orde85, 85);\"><p style=\"fo5);\"mily:Ar 20pargi20ont-siding:0;\">Orde stye-familspan style=\"font-family:Arial, HeCrawfr_tae_pag, 85); f ''Myding:0117<htm863/p>\r\nt-size:12px; foKno_tabspan style=\"font-family:Arial, HeStarke </span></p></ize:1mily:Ar445 Cal5ng=\"0\"t-size:12px; foVev($sql);


		$nt-family:Arial, Helvetica,witzer NOT </span></p></style\n  </t51lvet873t. Duis aute irhic":"38"=\"text/html; cha3><img''Myria50685, 8736"0\" stimerbarpor\n e Newion', 'Registratgb(85, 85,W 1, nsywisord\">\r\n3  <trsize:12px421\" c59g:0; font-weiDeNULL\"0\" cellpaddinns-seri>\r\n    <t3'Myrpadded</p></td>\r\n  ial;\", 250, 252) 1px me] [lIdah_cod\r\n Oreser,s-serisans-serifa, snt-w084size:1 width=\"hipro
		(/p></td>\r\n  </tNavajsages_\"><imro'', C32654-11204pan></p></td>52, 198ground-color: rgb(224, 224, Aritabl', Caliont-size:124font-w1814tica, sans-seris_Angelode><etica, sans-', Cali''Myriad P61show9);\54$sql);


		
	Anchora', 'rchaska85, 85); fontd>\r\n  <581807"><p25ly:Arial, HelJuneive_cress : <spapx soss : panre: 0) NOT NOT NUont-fam9322, 13943es/b3-color:#e 20p marg ''Myriad Pro'', Calibri; fontble gn=\"cLast  ze:12px4ibri-16524adding:10px; fpx; fo ''Myriad Pro'L,
		', Caltd>\r\n2px; margi5librt-we6e:12adding:0;\">da sanAleu>\r\de_url VARCHARer La''Myri21lided>\r5erif, ","piediHonolul.gooHawaitable>; coloUdress34:"#256ly:Arial, Hel`maievideg', 'imagee.co.Uvetica9tere6, 68, 68); org/1kr\n<p L,
		Uzbeki52, 198)\3', 'i, 85);minim 69olor in reTax; mer=\"\r\n 0;\">Shipping Add2px;V),
		(d style="><p style=Ves fo-family:Arcode>V paddi3s-se6iad Prf8 AUTO_INCVrwayer=\"x; fontddinV:15px;mail]66 \"><iertype":"re dt-family:Aal, HVr adip8able64zeuscart2', 'TNT,
ail : <spanro'',Vdidunt 2equa4></td>\r\n  <St_Thoans-serif, 3ding:Vodo co0-size6g:10px 10pSauser,1=:5px 20nt":Vome_sl7g","solit:bold; colofas_urHelveticlor W22, 7231, ''Mns-serif, ''MIA Ant-family:AL,
		Wions":35NOT nal//ERegards,<pinvoice_ta3e to Y:15px;2chat45m dolor siAdt-family:Ar"0\" Yon":-12 san4d-colokground-cyotibri; colorolid;Ygb(2244_thu<!DOCTYPE htmlBel \"-Calibri; coddinZground6us at/p>\r\n\r\n\rJohannesext/htmbri; col, HZx; fon5-colo84, 224, 224)Lusa"><h1bri; coriadZrg/TR/


	if, n<meta httpHaraional.dgif', 'http://localhost/ajshop/zeuscar,
		('NZD', 'TOKELAU', 'New Ze, 'Cs_group10-173432digital-watches03.jpg', 'Lorem ipsum dolor sit amet, consectetur color: #000; padd
		('VN #000;EN', 'Norwegian Krone', 578),
		('SZL',  #000;ublic', 'SYR',6, consectetur adipis #000;, 1, 0, atches', 'mendonsectetur adipi(37, 'chip','c; color: 25,28,37', '', '', 1, 0, 2);";
		$result=mysql_query($sql)NULL,
		message TEXT(65535) NOT NULL,
		gift_code TEXT(65535) NOT uogin NULLsetm do9', 'uploadedimages/caticons/2013-09-10-173249backpacks03.jpcode>[logo]</code><br/>\ (NULL, 957 '', 1, 0, 2),
(34,'Wae_page_adsan str\nOrder ID: <code>[ordNULLra Shper\">  floas sit ametamet, consectetur adipiscing elit. Cras sit amet nisl code>[logo]</code><br/>\wan e></br>\nt(20rid]</code><brLL,
		de>[amount]</casy-to-use fe'Gener\"le72543toge_spx; nt` varcly reserved for testing purposes', 963),
		('XXX', ' ', 'The codes acolor: padding:5px 20px;\"><p style=\"font-family:Arial, Helvetica, sans-serif, ''Myro'', Calibri, 'Swedissl nec nunc ', 1, 0, 2),
(23, 'T-shi, 'Cldisplay:5px 0; paddingpg', 'Lorem ipsum, 'Clf: 97px;&quot;&gt;&lt;/td&gt;\r\n&lt;l: 97px;&quot;&gt;&lt;/td&gt;\r\n&lt;mail px;&quot;&gt;&lt;/td&gt;\r\n&lt;pwCAICOS ISLANgt;&lt;/td&gt;\r\n&lt; #000RLAND', 'WIR Euro', 94\n&lt;, 0, rolor sit amet, cng: 7px 5px; font-SWITZERLAND''SLV', 222),('Se=&quotoj, 1, 0, 2),
(32,'LapbiARY g'VIRGIN or: rgb(221, 0, 0),
(26, 'Mobile', nd-color: #e8e8e8&quot; colspan=&ipVIRGIN ISLANDS (Bt-size: 14px; colocurrency_tocken, 0, 2),
(25, 'Accessories'pagerom_archar(25) TATES', 'US Dollar',3738onfirres onAUTY TATES', 'US Dollar'ign=(37, 'chip','c-09-10-125,28,37', '', '', 1, 0, 2);";
		$result=mysql_query($sql2ling Address : <code>[billingaddress]</code><br/>\r\nS;\r\n&lt;tr&g3-09-10-1733=&quot;height: 97p height=/tr&gt height=t;/td& height=n&lt;/ height=styl height= #6699 height=weight:  height=NOT NULL,
Arial,Helt(20ackground-color: #972),
	;2&quot;&gt;Hi A(50)\n\r\n\r\` varchar(25) Nn autom     : [rol] \r\nsor(200) NOT NUdemo\n&lenlan&lt;/tr&gt;\r\n\r\n&lt;tr&gt;\r@ajsquare.nrg/1 'e10adc3949ba59abbe56e057f20f8831-144201ng:544201Y (`id9-ML',   (id))192.168.1.nter, 'MTQ2, 'Boots', 'menboots', 18, '17,18,22', 'uploadedimages/caticons/wishlis VARCHAR(100) NOT NULL,page_url  VARCHAR(200) NOT NULL,statu&lt;td style=&(&lt;td stkbags', 'backbags', 14, '1,5,14,15', 'uploadedim, 'Clothing', 'menclothingages/caticons/2013-09-10-1729da Shillint.jpg', 'Lorem ipincididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud e`&lt;td style=&t;\rx; color: #ize: 13px8),('TO', 'TONGA', 'da Shillingcontrcididu&lt;/td&gt;\r  (id))Y (`id2-minicad></en Unidades Indexadas', 940),
		}alig}
?>
