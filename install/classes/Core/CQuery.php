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
(73, 20, 'images/products/laptop-bags06.jpg', 'images/products/large_image/laptop-bags06.jpg', 'images/products/thumb/laptop-bags06.jpg', 'sub'),
(74, 23, 'images/products/2013-10-18-064650hand3.jpg', 'images/products/large_image/2013-10-18-064650hand3.jpg', 'images/products/thumb/2013-10-18-064650hand3.jpg', 'sub'),
(75, 23, 'images/products/2013-10-18-064650hand5.jpg', 'images/products/large_image/2013-10-18-064650hand5.jpg', 'images/products/thumb/2013-10-18-064650hand5.jpg', 'sub'),
(76, 23, 'images/products/2013-10-18-064650hand6.jpg', 'images/products/large_image/2013-10-18-064650hand6.jpg', 'images/products/thumb/2013-10-18-064650hand6.jpg', 'sub'),
(77, 23, 'images/products/2013-10-18-064650hand10.jpg', 'images/products/large_image/2013-10-18-064650hand10.jpg', 'images/products/thumb/2013-10-18-064650hand10.jpg', 'sub'),
(79, 1, 'images/products/boot03.jpg', 'images/products/large_image/boot03.jpg', 'images/products/thumb/boot03.jpg', 'sub'),
(81, 2, 'images/products/formals02.jpg', 'images/products/large_image/formals02.jpg', 'images/products/thumb/formals02.jpg', 'sub'),
(82, 2, 'images/products/formals01.jpg', 'images/products/large_image/formals01.jpg', 'images/products/thumb/formals01.jpg', 'sub'),
(83, 2, 'images/products/formals05.jpg', 'images/products/large_image/formals05.jpg', 'images/products/thumb/formals05.jpg', 'sub'),
(84, 3, 'images/products/sneakers03.jpg', 'images/products/large_image/sneakers03.jpg', 'images/products/thumb/sneakers03.jpg', 'sub'),
(85, 3, 'images/products/sneakers02.jpg', 'images/products/large_image/sneakers02.jpg', 'images/products/thumb/sneakers02.jpg', 'sub'),
(86, 3, 'images/products/sneakers01.jpg', 'images/products/large_image/sneakers01.jpg', 'images/products/thumb/sneakers01.jpg', 'sub'),
(87, 5, 'images/products/laptop-bags03.jpg', 'images/products/large_image/laptop-bags03.jpg', 'images/products/thumb/laptop-bags03.jpg', 'sub'),
(88, 5, 'images/products/laptop-bags01.jpg', 'images/products/large_image/laptop-bags01.jpg', 'images/products/thumb/laptop-bags01.jpg', 'sub'),
(89, 5, 'images/products/laptop-bags02.jpg', 'images/products/large_image/laptop-bags02.jpg', 'images/products/thumb/laptop-bags02.jpg', 'sub'),
(90, 6, 'images/products/backpacks01.jpg', 'images/products/large_image/backpacks01.jpg', 'images/products/thumb/backpacks01.jpg', 'sub'),
(91, 6, 'images/products/backpacks01.jpg', 'images/products/large_image/backpacks01.jpg', 'images/products/thumb/backpacks01.jpg', 'sub'),
(93, 7, 'images/products/wallets02.jpg', 'images/products/large_image/wallets02.jpg', 'images/products/thumb/wallets02.jpg', 'sub'),
(94, 7, 'images/products/wallets01.jpg', 'images/products/large_image/wallets01.jpg', 'images/products/thumb/wallets01.jpg', 'sub'),
(95, 8, 'images/products/t-shirts05.jpg', 'images/products/large_image/t-shirts05.jpg', 'images/products/thumb/t-shirts05.jpg', 'sub'),
(96, 8, 'images/products/t-shirts04.jpg', 'images/products/large_image/t-shirts04.jpg', 'images/products/thumb/t-shirts04.jpg', 'sub'),
(97, 8, 'images/products/t-shirts02.jpg', 'images/products/large_image/t-shirts02.jpg', 'images/products/thumb/t-shirts02.jpg', 'sub'),
(98, 8, 'images/products/t-shirts01.jpg', 'images/products/large_image/t-shirts01.jpg', 'images/products/thumb/t-shirts01.jpg', 'sub'),
(99, 9, 'images/products/shirts06.jpg', 'images/products/large_image/shirts06.jpg', 'images/products/thumb/shirts06.jpg', 'sub'),
(100, 9, 'images/products/shirts05.jpg', 'images/products/large_image/shirts05.jpg', 'images/products/thumb/shirts05.jpg', 'sub'),
(101, 9, 'images/products/shirts03.jpg', 'images/products/large_image/shirts03.jpg', 'images/products/thumb/shirts03.jpg', 'sub'),
(102, 9, 'images/products/shirts01.jpg', 'images/products/large_image/shirts01.jpg', 'images/products/thumb/shirts01.jpg', 'sub'),
(103, 10, 'images/products/digital-watches04.jpg', 'images/products/large_image/digital-watches04.jpg', 'images/products/thumb/digital-watches04.jpg', 'sub'),
(104, 10, 'images/products/digital-watches05.jpg', 'images/products/large_image/digital-watches05.jpg', 'images/products/thumb/digital-watches05.jpg', 'sub'),
(105, 10, 'images/products/digital-watches07.jpg', 'images/products/large_image/digital-watches07.jpg', 'images/products/thumb/digital-watches07.jpg', 'sub'),
(106, 11, 'images/products/analog-watches04.jpg', 'images/products/large_image/analog-watches04.jpg', 'images/products/thumb/analog-watches04.jpg', 'sub'),
(107, 11, 'images/products/analog-watches02.jpg', 'images/products/large_image/analog-watches02.jpg', 'images/products/thumb/analog-watches02.jpg', 'sub'),
(108, 11, 'images/products/analog-watches01.jpg', 'images/products/large_image/analog-watches01.jpg', 'images/products/thumb/analog-watches01.jpg', 'sub'),
(110, 12, 'images/products/boots05.jpg', 'images/products/large_image/boots05.jpg', 'images/products/thumb/boots05.jpg', 'sub'),
(111, 12, 'images/products/boots08.jpg', 'images/products/large_image/boots08.jpg', 'images/products/thumb/boots08.jpg', 'sub'),
(113, 13, 'images/products/formal-shoes02.jpg', 'images/products/large_image/formal-shoes02.jpg', 'images/products/thumb/formal-shoes02.jpg', 'sub'),
(114, 13, 'images/products/formal-shoes01.jpg', 'images/products/large_image/formal-shoes01.jpg', 'images/products/thumb/formal-shoes01.jpg', 'sub'),
(115, 13, 'images/products/formal-shoes05.jpg', 'images/products/large_image/formal-shoes05.jpg', 'images/products/thumb/formal-shoes05.jpg', 'sub'),
(117, 14, 'images/products/sneakers01.jpg', 'images/products/large_image/sneakers01.jpg', 'images/products/thumb/sneakers01.jpg', 'sub'),
(118, 14, 'images/products/sneakers03.jpg', 'images/products/large_image/sneakers03.jpg', 'images/products/thumb/sneakers03.jpg', 'sub'),
(120, 16, 'images/products/t-shirts01.jpg', 'images/products/large_image/t-shirts01.jpg', 'images/products/thumb/t-shirts01.jpg', 'sub'),
(121, 16, 'images/products/t-shirts04.jpg', 'images/products/large_image/t-shirts04.jpg', 'images/products/thumb/t-shirts04.jpg', 'sub'),
(122, 16, 'images/products/t-shirts11.jpg', 'images/products/large_image/t-shirts11.jpg', 'images/products/thumb/t-shirts11.jpg', 'sub'),
(123, 17, 'images/products/analog-watches05.jpg', 'images/products/large_image/analog-watches05.jpg', 'images/products/thumb/analog-watches05.jpg', 'sub'),
(124, 17, 'images/products/analog-watches03.jpg', 'images/products/large_image/analog-watches03.jpg', 'images/products/thumb/analog-watches03.jpg', 'sub'),
(125, 17, 'images/products/analog-watches01.jpg', 'images/products/large_image/analog-watches01.jpg', 'images/products/thumb/analog-watches01.jpg', 'sub'),
(126, 17, 'images/products/analog-watches04.jpg', 'images/products/large_image/analog-watches04.jpg', 'images/products/thumb/analog-watches04.jpg', 'sub'),
(127, 18, 'images/products/digital-watches03.jpg', 'images/products/large_image/digital-watches03.jpg', 'images/products/thumb/digital-watches03.jpg', 'sub'),
(128, 18, 'images/products/digital-watches04.jpg', 'images/products/large_image/digital-watches04.jpg', 'images/products/thumb/digital-watches04.jpg', 'sub'),
(129, 18, 'images/products/digital-watches01.jpg', 'images/products/large_image/digital-watches01.jpg', 'images/products/thumb/digital-watches01.jpg', 'sub'),
(130, 18, 'images/products/digital-watches05.jpg', 'images/products/large_image/digital-watches05.jpg', 'images/products/thumb/digital-watches05.jpg', 'sub'),
(131, 19, 'images/products/chronograhs03.jpg', 'images/products/large_image/chronograhs03.jpg', 'images/products/thumb/chronograhs03.jpg', 'sub'),
(132, 19, 'images/products/chronograhs06.jpg', 'images/products/large_image/chronograhs06.jpg', 'images/products/thumb/chronograhs06.jpg', 'sub'),
(133, 19, 'images/products/chronograhs04.jpg', 'images/products/large_image/chronograhs04.jpg', 'images/products/thumb/chronograhs04.jpg', 'sub'),
(134, 20, 'images/products/laptop-bags02.jpg', 'images/products/large_image/laptop-bags02.jpg', 'images/products/thumb/laptop-bags02.jpg', 'sub'),
(135, 20, 'images/products/laptop-bags03.jpg', 'images/products/large_image/laptop-bags03.jpg', 'images/products/thumb/laptop-bags03.jpg', 'sub'),
(136, 20, 'images/products/laptop-bags05.jpg', 'images/products/large_image/laptop-bags05.jpg', 'images/products/thumb/laptop-bags05.jpg', 'sub'),
(137, 24, 'images/products/chip2.jpg', 'images/products/large_image/chip2.jpg', 'images/products/thumb/chip2.jpg', 'sub'),
(138, 24, 'images/products/chip5.jpg', 'images/products/large_image/chip5.jpg', 'images/products/thumb/chip5.jpg', 'sub'),
(139, 24, 'images/products/chip6.jpg', 'images/products/large_image/chip6.jpg', 'images/products/thumb/chip6.jpg', 'sub'),
(140, 24, 'images/products/chip3.jpg', 'images/products/large_image/chip3.jpg', 'images/products/thumb/chip3.jpg', 'sub'),
(141, 25, 'images/products/599987_10152250766770487_1897850228_n.jpg', 'images/products/large_image/599987_10152250766770487_1897850228_n.jpg', 'images/products/thumb/599987_10152250766770487_1897850228_n.jpg', 'main'),
(142, 26, 'images/products/(JPEG Image, 400Â Ã—Â 200 pixels).jpeg', 'images/products/large_image/(JPEG Image, 400Â Ã—Â 200 pixels).jpeg', 'images/products/thumb/(JPEG Image, 400Â Ã—Â 200 pixels).jpeg', 'main');
;
		";
		$result=mysql_query($sql);



		$sql="Drop table if exists product_inventory_table";
		$result=mysql_query($sql);
		$sql="CREATE TABLE product_inventory_table(inventory_id  INT(20) NOT NULL PRIMARY KEY AUTO_INCREMENT,product_id  INT(20) NOT NULL,rol  INT(15) NOT NULL,soh  INT(20) NOT NULL)";
		$result=mysql_query($sql);
		$sql="INSERT INTO `product_inventory_table` (`inventory_id`, `product_id`, `rol`, `soh`) VALUES
		(1, 1, 10, 6),
		(2, 2, 10, 99),
		(3, 3, 0, 148),
		(4, 4, 10, 98),
		(5, 5, 10, 147),
		(6, 6, 10, 99),
		(7, 7, 0, 96),
		(8, 8, 0, 100),
		(9, 9, 0, 100),
		(10, 10, 0, 100),
		(11, 11, 0, 98),
		(12, 12, 10, 97),
		(13, 13, 10, 96),
		(14, 14, 0, 146),
		(15, 15, 10, 98),
		(16, 16, 0, 96),
		(17, 17, 0, 99),
		(18, 18, 0, 91),
		(19, 19, 0, 99),
		(20, 20, 0, 95),
		(21, 21, 0, 99),
		(22, 22, 0, 99),
		(23, 23, 0, 90),
		(24, 24, 0, 99)";
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
		$sql="INSERT INTO `products_table` (`product_id`, `category_id`, `sku`, `title`, `alias`, `description`, `brand`, `model`, `msrp`, `price`, `cse_enabled`, `cse_key`, `weight`, `dimension`, `thumb_image`, `image`, `large_image_path`, `shipping_cost`, `status`, `tag`, `meta_desc`, `meta_keywords`, `intro_date`, `is_featured`, `digital`, `gift`, `digital_product_path`, `has_variation`, `product_status`, `deleted_reason`) VALUES
		(1, '22', '15asAS', 'Boots', 'boots', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras sit amet nisl nec nunc sollicitudin bibendum. Pellentesque orci Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras sit amet nisl nec nunc sollicitudin bibendum. Pellentesque orci.</p>', '', '', 200, 150, 0, '', '1', '', 'images/products/thumb/boot06.jpg', 'images/products/boot06.jpg', 'images/products/large_image/boot06.jpg', 0, 1, '', '', '', '2013-10-17', 1, 0, 0, '', 1, 1, ''),
		(2, '29', '15kj', 'Formal Shoes ', 'formal-shoes', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras sit amet nisl nec nunc sollicitudin bibendum. Pellentesque orci Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras sit amet nisl nec nunc sollicitudin bibendum. Pellentesque orci.', 'Bata', '', 700, 500, 0, '', '1', '', 'images/products/thumb/formals06.jpg', 'images/products/formals06.jpg', 'images/products/large_image/formals06.jpg', 10, 1, '', '', '', '2013-10-17', 1, 0, 0, '', 1, 1, ''),
		(3, '30', 'as15', 'Sneakers', 'sneakers', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras sit amet nisl nec nunc sollicitudin bibendum. Pellentesque orci Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras sit amet nisl nec nunc sollicitudin bibendum. Pellentesque orci.', '', '', 500, 150, 0, '', '1', '', 'images/products/thumb/sneakers05.jpg', 'images/products/sneakers05.jpg', 'images/products/large_image/sneakers05.jpg', 0, 1, '', '', '', '2013-10-17', 1, 0, 0, '', 1, 1, ''),
		(4, '31', '15', 'Sports shoes', 'sports-shoes', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras sit amet nisl nec nunc sollicitudin bibendum. Pellentesque orci Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras sit amet nisl nec nunc sollicitudin bibendum. Pellentesque orci.', '', '', 100, 50, 0, '', '1', '', 'images/products/thumb/Puma-KURIS-Men-Black.jpg', 'images/products/Puma-KURIS-Men-Black.jpg', 'images/products/large_image/Puma-KURIS-Men-Black.jpg', 0, 1, '', '', '', '2013-10-17', 1, 0, 0, '', 1, 1, ''),
		(5, '32', '15', 'Laptop bags', 'laptop-bags', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras sit amet nisl nec nunc sollicitudin bibendum. Pellentesque orci Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras sit amet nisl nec nunc sollicitudin bibendum. Pellentesque orci.', '', '', 150, 100, 0, '', '1', '', 'images/products/thumb/laptop-bags06.jpg', 'images/products/laptop-bags06.jpg', 'images/products/large_image/laptop-bags06.jpg', 0, 1, '', '', '', '2013-10-17', 1, 0, 0, '', 0, 1, ''),
		(6, '33', '5a', 'Back bags', 'back-bags', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras sit amet nisl nec nunc sollicitudin bibendum. Pellentesque orci Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras sit amet nisl nec nunc sollicitudin bibendum. Pellentesque orci.', '', '', 200, 150, 0, '', '1', '', 'images/products/thumb/backpacks06.jpg', 'images/products/backpacks06.jpg', 'images/products/large_image/backpacks06.jpg', 0, 1, '', '', '', '2013-10-17', 1, 0, 0, '', 0, 1, ''),
		(7, '34', '10a', 'Wallets', 'wallets', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras sit amet nisl nec nunc sollicitudin bibendum. Pellentesque orci Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras sit amet nisl nec nunc sollicitudin bibendum. Pellentesque orci.', '', '', 15, 10, 0, '', '1', '', 'images/products/thumb/wallets06.jpg', 'images/products/wallets06.jpg', 'images/products/large_image/wallets06.jpg', 0, 1, '', '', '', '2013-10-17', 1, 0, 0, '', 0, 1, ''),
		(8, '23', '15', 'T-shirts', 't-shirts', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras sit amet nisl nec nunc sollicitudin bibendum. Pellentesque orci Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras sit amet nisl nec nunc sollicitudin bibendum. Pellentesque orci.', '', '', 15, 10, 0, '', '1', '', 'images/products/thumb/t-shirts06.jpg', 'images/products/t-shirts06.jpg', 'images/products/large_image/t-shirts06.jpg', 0, 1, '', '', '', '2013-10-17', 1, 0, 0, '', 1, 1, ''),
		(9, '35', '152', 'Shirts', 'shirts', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras sit amet nisl nec nunc sollicitudin bibendum. Pellentesque orci Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras sit amet nisl nec nunc sollicitudin bibendum. Pellentesque orci.', '', '', 100, 50, 0, '', '1', '', 'images/products/thumb/shirts07.jpg', 'images/products/shirts07.jpg', 'images/products/large_image/shirts07.jpg', 0, 1, '', '', '', '2013-10-17', 0, 0, 0, '', 1, 1, ''),
		(10, '24', '15a', 'DIgital watch', 'digital-watch', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras sit amet nisl nec nunc sollicitudin bibendum. Pellentesque orci Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras sit amet nisl nec nunc sollicitudin bibendum. Pellentesque orci.', '', '', 15, 10, 0, '', '', '', 'images/products/thumb/digital-watches03.jpg', 'images/products/digital-watches03.jpg', 'images/products/large_image/digital-watches03.jpg', 0, 1, '', '', '', '2013-10-17', 1, 0, 0, '', 0, 2, ''),
		(11, '36', '15s', 'Analog watch', 'analog-watch', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras sit amet nisl nec nunc sollicitudin bibendum. Pellentesque orci Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras sit amet nisl nec nunc sollicitudin bibendum. Pellentesque orci.', 'tata', '', 150, 100, 0, '', '1', '', 'images/products/thumb/analog-watches05.jpg', 'images/products/analog-watches05.jpg', 'images/products/large_image/analog-watches05.jpg', 0, 1, '', '', '', '2013-10-17', 1, 0, 0, '', 0, 1, ''),
		(12, '6', '15', 'Boots', 'boots', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras sit amet nisl nec nunc sollicitudin bibendum. Pellentesque orci Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras sit amet nisl nec nunc sollicitudin bibendum. Pellentesque orci.', 'Bata', '', 200, 150, 0, '', '1', '', 'images/products/thumb/boots02.jpg', 'images/products/boots02.jpg', 'images/products/large_image/boots02.jpg', 0, 1, '', '', '', '2013-10-17', 1, 0, 0, '', 1, 1, ''),
		(13, '7', '65', 'Formal Shoes', 'formal-shoes', '', '', '', 15, 10, 0, '', '', '', 'images/products/thumb/formal-shoes06.jpg', 'images/products/formal-shoes06.jpg', 'images/products/large_image/formal-shoes06.jpg', 0, 1, '', '', '', '2013-10-17', 1, 0, 0, '', 1, 2, ''),
		(14, '8', '15', 'Sneakers', 'sneakers', '', '', '', 20, 15, 0, '', '', '', 'images/products/thumb/sneakers05.jpg', 'images/products/sneakers05.jpg', 'images/products/large_image/sneakers05.jpg', 0, 1, 'sneakers', '', '', '2013-10-17', 1, 0, 0, '', 1, 2, ''),
		(15, '9', '15q', 'Sports shoes', 'sports-shoes', '', '', '', 15, 10, 0, '', '', '', 'images/products/thumb/sports-shoes06.jpg', 'images/products/sports-shoes06.jpg', 'images/products/large_image/sports-shoes06.jpg', 0, 1, '', '', '', '2013-10-17', 1, 0, 0, '', 1, 2, ''),
		(16, '10', '15', 'T-shirts', 't-shirts', '', '', '', 15, 10, 0, '', '1', '', 'images/products/thumb/t-shirts02.jpg', 'images/products/t-shirts02.jpg', 'images/products/large_image/t-shirts02.jpg', 0, 1, '', '', '', '2013-10-17', 1, 0, 0, '', 1, 1, ''),
		(17, '11', '15a', 'Analog watch', 'analog-watch', '', '', '', 15, 10, 0, '', '', '', 'images/products/thumb/analog-watches06.jpg', 'images/products/analog-watches06.jpg', 'images/products/large_image/analog-watches06.jpg', 0, 1, 'watches', '', '', '2013-10-17', 1, 0, 0, '', 0, 2, ''),
		(18, '12', '15', 'DIgital watch', 'digital-watch', '', '', '', 15, 10, 0, '', '1', '', 'images/products/thumb/digital-watches02.jpg', 'images/products/digital-watches02.jpg', 'images/products/large_image/digital-watches02.jpg', 0, 1, '', '', '', '2013-10-17', 1, 0, 0, '', 0, 2, ''),
		(19, '13', '15s', 'Chronograhs', 'chronograhs', '', '', '', 15, 10, 0, '', '', '', 'images/products/thumb/chronograhs05.jpg', 'images/products/chronograhs05.jpg', 'images/products/large_image/chronograhs05.jpg', 0, 1, '', '', '', '2013-10-17', 1, 0, 0, '', 0, 2, ''),
		(20, '14', '15', 'Laptop bags', 'laptop-bags', '<p>Nunc facilisis sagittis ullamcorper. Proin lectus ipsum, gravida et mattis vulputate, tristique ut lectus. Sed et lorem nunc. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Aenean eleifend laoreet congue. Vivamus adipiscing nisl ut dolor dignissim semper. Nulla luctus malesuada tincidunt. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.', '', '', 200, 10, 0, '', '1', '', 'images/products/thumb/laptop-bags04.jpg', 'images/products/laptop-bags04.jpg', 'images/products/large_image/laptop-bags04.jpg', 0, 1, 'bags', '', '', '2013-10-17', 1, 0, 0, '', 0, 1, ''),
		(21, '15', '15', 'Back bags', 'back-bags', '', '', '', 15, 10, 0, '', '1', '', 'images/products/thumb/backpacks03.jpg', 'images/products/backpacks03.jpg', 'images/products/large_image/backpacks03.jpg', 0, 1, '', '', '', '2013-10-17', 1, 0, 0, '', 0, 1, ''),
		(22, '16', '15asd', 'Wallets', 'wallets', '', '', '', 15, 10, 0, '', '1', '', 'images/products/thumb/wallets01.jpg', 'images/products/wallets01.jpg', 'images/products/large_image/wallets01.jpg', 0, 1, '', '', '', '2013-10-17', 1, 0, 0, '', 0, 1, ''),
		(23, '27', '15', 'Hand bag', 'mobile', '<p>Nunc facilisis sagittis ullamcorper. Proin lectus ipsum, gravida et mattis vulputate, tristique ut lectus. Sed et lorem nunc. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Aenean eleifend laoreet congue. Vivamus adipiscing nisl ut dolor dignissim semper. Nulla luctus malesuada tincidunt. Class aptent taciti sociosqu ad litora torquent per conubia nostra</p>', '', '', 600, 500, 0, '', '1', '', 'images/products/thumb/2013-10-18-064649hand2.jpg', 'images/products/2013-10-18-064649hand2.jpg', 'images/products/large_image/2013-10-18-064649hand2.jpg', 0, 1, '', '', '', '2013-10-17', 1, 0, 0, '', 1, 1, ''),
		(24, '37', '15a', 'Chip', 'chip', '', '', '', 1500, 1000, 0, '', '1', '', 'images/products/thumb/chip.jpg', 'images/products/chip.jpg', 'images/products/large_image/chip.jpg', 0, 1, '', '', '', '2013-10-17', 1, 0, 0, '', 0, 1, '');";
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
		
		$sql="INSERT INTO `product_variation_table` (`variation_id`, `product_id`, `sku`, `variation_name`, `description`, `msrp`, `price`, `weight`, `dimension`, `thumb_image`, `image`, `large_image`, `shipping_cost`, `soh`, `rol`, `status`) VALUES
		(1, 33, '15asd', 'nokia', '', 160, 150, '15', '15 x 15 x 17', 'images/products/thumb/2013-10-16-0407491.jpg', 'images/products/2013-10-16-0407491.jpg', 'images/products/large_image/2013-10-16-0407491.jpg', 100, 15, 15, 1),
		(2, 1, '15asd', '6', '', 200, 150, '15', '15 x 15 x 15', 'images/products/thumb/2013-10-18-035309boot06.jpg', 'images/products/2013-10-18-035309boot06.jpg', 'images/products/large_image/2013-10-18-035309boot06.jpg', 2, 15, 15, 1),
		(3, 33, '152as', 'nokia2', '', 160, 152, '15', '15 x 16 x 17', 'images/products/thumb/2013-10-16-0407493.jpg', 'images/products/2013-10-16-0407493.jpg', 'images/products/large_image/2013-10-16-0407493.jpg', 100, 15, 15, 1),
		(4, 1, '15', '7', '', 200, 150, '15', '15 x 15 x 15', 'images/products/thumb/2013-10-18-035309boot06.jpg', 'images/products/2013-10-18-035309boot06.jpg', 'images/products/large_image/2013-10-18-035309boot06.jpg', 2, 15, 15, 1),
		(5, 1, '15', '8', '', 200, 150, '15', '15 x 15 x 15', 'images/products/thumb/2013-10-18-054703boot06.jpg', 'images/products/2013-10-18-054703boot06.jpg', 'images/products/large_image/2013-10-18-054703boot06.jpg', 2, 15, 15, 1),
		(6, 1, '15', '8.8', '', 200, 150, '15', '15 x 15 x 15', 'images/products/thumb/2013-10-18-054703boot06.jpg', 'images/products/2013-10-18-054703boot06.jpg', 'images/products/large_image/2013-10-18-054703boot06.jpg', 2, 15, 15, 1),
		(7, 1, '15', '9', '', 200, 150, '15', '15 x 15 x 15', 'images/products/thumb/2013-10-18-054704boot06.jpg', 'images/products/2013-10-18-054704boot06.jpg', 'images/products/large_image/2013-10-18-054704boot06.jpg', 2, 15, 15, 1),
		(8, 2, '15asd', '6', '', 700, 500, '15', '15 x 15 x 15', 'images/products/thumb/2013-10-18-054923formals06.jpg', 'images/products/2013-10-18-054923formals06.jpg', 'images/products/large_image/2013-10-18-054923formals06.jpg', 2, 15, 15, 1),
		(9, 2, '15asd', '7', '', 700, 500, '15', '15 x 15 x 15', 'images/products/thumb/2013-10-18-054923formals06.jpg', 'images/products/2013-10-18-054923formals06.jpg', 'images/products/large_image/2013-10-18-054923formals06.jpg', 2, 15, 15, 1),
		(10, 2, '15asd', '8', '', 700, 500, '15', '15 x 15 x 15', 'images/products/thumb/2013-10-18-054923formals06.jpg', 'images/products/2013-10-18-054923formals06.jpg', 'images/products/large_image/2013-10-18-054923formals06.jpg', 2, 15, 15, 1),
		(11, 2, '15asd', '9', '', 700, 500, '15', '15 x 15 x 15', 'images/products/thumb/2013-10-18-054923formals06.jpg', 'images/products/2013-10-18-054923formals06.jpg', 'images/products/large_image/2013-10-18-054923formals06.jpg', 2, 15, 15, 1),
		(12, 2, '15asd', '10', '', 700, 500, '15', '15 x 15 x 15', 'images/products/thumb/2013-10-18-054924formals06.jpg', 'images/products/2013-10-18-054924formals06.jpg', 'images/products/large_image/2013-10-18-054924formals06.jpg', 2, 15, 15, 1),
		(13, 3, '15asd', '5', '', 500, 150, '15', '15 x 15 x 15', 'images/products/thumb/2013-10-18-055313sneakers05.jpg', 'images/products/2013-10-18-055313sneakers05.jpg', 'images/products/large_image/2013-10-18-055313sneakers05.jpg', 2, 15, 15, 1),
		(14, 3, '15asd', '6', '', 500, 150, '15', '15 x 15 x 15', 'images/products/thumb/2013-10-18-055314sneakers05.jpg', 'images/products/2013-10-18-055314sneakers05.jpg', 'images/products/large_image/2013-10-18-055314sneakers05.jpg', 2, 15, 15, 1),
		(15, 3, '15asd', '7', '', 500, 150, '15', '15 x 15 x 15', 'images/products/thumb/2013-10-18-055314sneakers05.jpg', 'images/products/2013-10-18-055314sneakers05.jpg', 'images/products/large_image/2013-10-18-055314sneakers05.jpg', 2, 15, 15, 1),
		(16, 3, '15asd', '8', '', 500, 150, '15', '15 x 15 x 15', 'images/products/thumb/2013-10-18-055314sneakers05.jpg', 'images/products/2013-10-18-055314sneakers05.jpg', 'images/products/large_image/2013-10-18-055314sneakers05.jpg', 2, 15, 15, 1),
		(17, 3, '15asd', '9', '', 500, 150, '15', '15 x 15 x 15', 'images/products/thumb/2013-10-18-055314sneakers05.jpg', 'images/products/2013-10-18-055314sneakers05.jpg', 'images/products/large_image/2013-10-18-055314sneakers05.jpg', 2, 15, 15, 1),
		(18, 4, '15asd', '5', '', 100, 50, '15', '15 x 15 x 15', 'images/products/thumb/2013-10-18-055601Puma-KURIS-Men-Black.jpg', 'images/products/2013-10-18-055601Puma-KURIS-Men-Black.jpg', 'images/products/large_image/2013-10-18-055601Puma-KURIS-Men-Black.jpg', 2, 15, 15, 1),
		(19, 4, '15asd', '6', '', 100, 50, '15', '15 x 15 x 15', 'images/products/thumb/2013-10-18-055601Puma-KURIS-Men-Black.jpg', 'images/products/2013-10-18-055601Puma-KURIS-Men-Black.jpg', 'images/products/large_image/2013-10-18-055601Puma-KURIS-Men-Black.jpg', 2, 15, 15, 1),
		(20, 4, '15asd', '7', '', 100, 50, '15', '15 x 15 x 15', 'images/products/thumb/2013-10-18-055602Puma-KURIS-Men-Black.jpg', 'images/products/2013-10-18-055602Puma-KURIS-Men-Black.jpg', 'images/products/large_image/2013-10-18-055602Puma-KURIS-Men-Black.jpg', 2, 15, 15, 1),
		(21, 4, '15asd', '8', '', 100, 50, '15', '15 x 15 x 15', 'images/products/thumb/2013-10-18-055602Puma-KURIS-Men-Black.jpg', 'images/products/2013-10-18-055602Puma-KURIS-Men-Black.jpg', 'images/products/large_image/2013-10-18-055602Puma-KURIS-Men-Black.jpg', 2, 15, 15, 1),
		(22, 4, '15asd', '9', '', 100, 50, '15', '15 x 15 x 15', 'images/products/thumb/2013-10-18-055602Puma-KURIS-Men-Black.jpg', 'images/products/2013-10-18-055602Puma-KURIS-Men-Black.jpg', 'images/products/large_image/2013-10-18-055602Puma-KURIS-Men-Black.jpg', 2, 15, 15, 1),
		(23, 23, '15', '80', '', 600, 500, '15', '15 x 16 x 15', 'images/products/thumb/2013-10-18-064905hand2.jpg', 'images/products/2013-10-18-064905hand2.jpg', 'images/products/large_image/2013-10-18-064905hand2.jpg', 0, 16, 19, 1),
		(24, 23, '15', '85', '', 600, 500, '15', '15 x 16 x 15', 'images/products/thumb/2013-10-18-064905hand2.jpg', 'images/products/2013-10-18-064905hand2.jpg', 'images/products/large_image/2013-10-18-064905hand2.jpg', 0, 16, 19, 1),
		(25, 23, '15', '90', '', 600, 500, '15', '15 x 16 x 0', 'images/products/thumb/2013-10-18-064906hand2.jpg', 'images/products/2013-10-18-064906hand2.jpg', 'images/products/large_image/2013-10-18-064906hand2.jpg', 10, 16, 19, 1),
		(26, 8, '15', 'Small', '', 15, 10, '', '', 'images/products/thumb/2013-10-18-065557t-shirts06.jpg', 'images/products/2013-10-18-065557t-shirts06.jpg', 'images/products/large_image/2013-10-18-065557t-shirts06.jpg', 2, 15, 15, 1),
		(27, 8, '15asd', 'Medium', '', 15, 10, '', '', 'images/products/thumb/2013-10-18-065558t-shirts06.jpg', 'images/products/2013-10-18-065558t-shirts06.jpg', 'images/products/large_image/2013-10-18-065558t-shirts06.jpg', 2, 15, 15, 1),
		(28, 8, '15asd', 'Large', '', 15, 10, '', '', 'images/products/thumb/2013-10-18-065558t-shirts06.jpg', 'images/products/2013-10-18-065558t-shirts06.jpg', 'images/products/large_image/2013-10-18-065558t-shirts06.jpg', 2, 15, 15, 1),
		(29, 8, '15', 'XL', '', 15, 10, '', '', 'images/products/thumb/2013-10-18-065558t-shirts06.jpg', 'images/products/2013-10-18-065558t-shirts06.jpg', 'images/products/large_image/2013-10-18-065558t-shirts06.jpg', 2, 15, 15, 1),
		(30, 9, '15', 'Small', '', 100, 50, '15', '', 'images/products/thumb/2013-10-18-065834shirts07.jpg', 'images/products/2013-10-18-065834shirts07.jpg', 'images/products/large_image/2013-10-18-065834shirts07.jpg', 0, 15, 15, 1),
		(31, 9, '15', 'Medium', '', 100, 50, '', '', 'images/products/thumb/2013-10-18-065834shirts07.jpg', 'images/products/2013-10-18-065834shirts07.jpg', 'images/products/large_image/2013-10-18-065834shirts07.jpg', 0, 15, 15, 1),
		(32, 9, '15', 'Large', '', 100, 50, '15', '', 'images/products/thumb/2013-10-18-065835shirts07.jpg', 'images/products/2013-10-18-065835shirts07.jpg', 'images/products/large_image/2013-10-18-065835shirts07.jpg', 0, 15, 15, 1),
		(33, 9, '15', 'XL', '', 100, 50, '15', '', 'images/products/thumb/2013-10-18-065835shirts07.jpg', 'images/products/2013-10-18-065835shirts07.jpg', 'images/products/large_image/2013-10-18-065835shirts07.jpg', 0, 15, 15, 1),
		(34, 12, '15asd', '6', '', 200, 150, '', '', 'images/products/thumb/2013-10-18-070323boots02.jpg', 'images/products/2013-10-18-070323boots02.jpg', 'images/products/large_image/2013-10-18-070323boots02.jpg', 0, 15, 15, 1),
		(35, 12, '1545asd', '7', '', 200, 150, '', '', 'images/products/thumb/2013-10-18-070324boots02.jpg', 'images/products/2013-10-18-070324boots02.jpg', 'images/products/large_image/2013-10-18-070324boots02.jpg', 0, 15, 15, 1),
		(36, 12, '1545', '8', '', 200, 150, '', '', 'images/products/thumb/2013-10-18-070324boots02.jpg', 'images/products/2013-10-18-070324boots02.jpg', 'images/products/large_image/2013-10-18-070324boots02.jpg', 0, 15, 15, 1),
		(37, 12, '2564', '9', '', 200, 150, '', '', 'images/products/thumb/2013-10-18-070324boots02.jpg', 'images/products/2013-10-18-070324boots02.jpg', 'images/products/large_image/2013-10-18-070324boots02.jpg', 0, 15, 15, 1),
		(38, 13, 'sd54', '5', '', 15, 10, '15', '15 x 15 x 15', 'images/products/thumb/2013-10-18-070828formal-shoes06.jpg', 'images/products/2013-10-18-070828formal-shoes06.jpg', 'images/products/large_image/2013-10-18-070828formal-shoes06.jpg', 0, 15, 16, 1),
		(39, 13, 'asd', '6', '', 15, 10, '', '15 x 15 x 15', 'images/products/thumb/2013-10-18-070828formal-shoes06.jpg', 'images/products/2013-10-18-070828formal-shoes06.jpg', 'images/products/large_image/2013-10-18-070828formal-shoes06.jpg', 0, 15, 15, 1),
		(40, 13, 'qwe', '7', '', 15, 10, '', '15 x 15 x 15', 'images/products/thumb/2013-10-18-070828formal-shoes06.jpg', 'images/products/2013-10-18-070828formal-shoes06.jpg', 'images/products/large_image/2013-10-18-070828formal-shoes06.jpg', 0, 16, 15, 1),
		(41, 13, 'qwe', '8', '', 15, 10, '', '', 'images/products/thumb/2013-10-18-070829formal-shoes06.jpg', 'images/products/2013-10-18-070829formal-shoes06.jpg', 'images/products/large_image/2013-10-18-070829formal-shoes06.jpg', 0, 15, 15, 1),
		(42, 13, 'qw15', '9', '', 15, 10, '', '', 'images/products/thumb/2013-10-18-070829formal-shoes06.jpg', 'images/products/2013-10-18-070829formal-shoes06.jpg', 'images/products/large_image/2013-10-18-070829formal-shoes06.jpg', 0, 15, 15, 1),
		(43, 14, 'as', '4', '', 20, 15, '', '', 'images/products/thumb/2013-10-18-071028sneakers05.jpg', 'images/products/2013-10-18-071028sneakers05.jpg', 'images/products/large_image/2013-10-18-071028sneakers05.jpg', 0, 15, 16, 1),
		(44, 14, 'aw', '5', '', 20, 15, '', '', 'images/products/thumb/2013-10-18-071029sneakers05.jpg', 'images/products/2013-10-18-071029sneakers05.jpg', 'images/products/large_image/2013-10-18-071029sneakers05.jpg', 0, 15, 16, 1),
		(45, 14, 'wer', '6', '', 20, 15, '', '', 'images/products/thumb/2013-10-18-071029sneakers05.jpg', 'images/products/2013-10-18-071029sneakers05.jpg', 'images/products/large_image/2013-10-18-071029sneakers05.jpg', 0, 15, 16, 1),
		(46, 14, ' wer', '7', '', 20, 15, '', '', 'images/products/thumb/2013-10-18-071030sneakers05.jpg', 'images/products/2013-10-18-071030sneakers05.jpg', 'images/products/large_image/2013-10-18-071030sneakers05.jpg', 0, 15, 16, 1),
		(47, 14, 'we', '8', '', 20, 15, '', '', 'images/products/thumb/2013-10-18-071030sneakers05.jpg', 'images/products/2013-10-18-071030sneakers05.jpg', 'images/products/large_image/2013-10-18-071030sneakers05.jpg', 0, 15, 16, 1),
		(48, 15, '15asdsd', '6', '', 15, 10, '15', '2 x 2 x 1', 'images/products/thumb/2013-10-18-074409sports-shoes07.jpg', 'images/products/2013-10-18-074409sports-shoes07.jpg', 'images/products/large_image/2013-10-18-074409sports-shoes07.jpg', 2, 15, 15, 1),
		(49, 15, '15f', '7', '', 15, 10, '15', '2 x 2 x 1', 'images/products/thumb/2013-10-18-074409sports-shoes07.jpg', 'images/products/2013-10-18-074409sports-shoes07.jpg', 'images/products/large_image/2013-10-18-074409sports-shoes07.jpg', 2, 15, 15, 1),
		(50, 15, '15s', '8', '', 15, 10, '15', '2 x 2 x 1', 'images/products/thumb/2013-10-18-074409sports-shoes07.jpg', 'images/products/2013-10-18-074409sports-shoes07.jpg', 'images/products/large_image/2013-10-18-074409sports-shoes07.jpg', 2, 15, 15, 1),
		(51, 15, '15df', '9', '', 15, 10, '15', '2 x 2 x 1', 'images/products/thumb/2013-10-18-074410sports-shoes07.jpg', 'images/products/2013-10-18-074410sports-shoes07.jpg', 'images/products/large_image/2013-10-18-074410sports-shoes07.jpg', 2, 15, 15, 1),
		(52, 16, '15asd', 'Small', '', 15, 10, '', '', 'images/products/thumb/2013-10-18-074629t-shirts02.jpg', 'images/products/2013-10-18-074629t-shirts02.jpg', 'images/products/large_image/2013-10-18-074629t-shirts02.jpg', 0, 15, 15, 1),
		(53, 16, '15as', 'Medium', '', 15, 10, '', '', 'images/products/thumb/2013-10-18-074630t-shirts02.jpg', 'images/products/2013-10-18-074630t-shirts02.jpg', 'images/products/large_image/2013-10-18-074630t-shirts02.jpg', 0, 15, 16, 1),
		(54, 16, '15w', 'Large', '', 15, 10, '', '', 'images/products/thumb/2013-10-18-074630t-shirts02.jpg', 'images/products/2013-10-18-074630t-shirts02.jpg', 'images/products/large_image/2013-10-18-074630t-shirts02.jpg', 0, 15, 16, 1),
		(55, 16, '15gdf', 'XL', '', 15, 10, '', '', 'images/products/thumb/2013-10-18-074631t-shirts02.jpg', 'images/products/2013-10-18-074631t-shirts02.jpg', 'images/products/large_image/2013-10-18-074631t-shirts02.jpg', 0, 15, 16, 1);";
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
		) ";
		$result=mysql_query($sql);
		$sql="INSERT INTO `shipments_master_table` (`shipment_id`, `shipment_name`, `shipment_user_id`, `shipment_password`, `shipment_accesskey`, `status`) VALUES
		(1, 'Arrange shipping by our company', '', '', '', 1),
		(2, 'United Parcel Service', '', '', '', 1);";
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
		$sql="INSERT INTO `skins_table` (`skin_id`, `skin_name`, `skin_status`) VALUES
		(1, 'default', 0),
		(2, 'black', 0),
		(3, 'blue', 0),
		(4, 'brown', 0),
		(5, 'green', 0),
		(6, 'orange', 0),
		(7, 'pink', 0)";
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



		
		$sql="Drop table if exists users_group_table";
		$result=mysql_query($sql);
		$sql="CREATE TABLE IF NOT EXISTS `users_group_table` (
		`group_id` int(11) NOT NULL AUTO_INCREMENT,
		`group_name` varchar(60) DEFAULT NULL,
		`group_discount` varchar(50) DEFAULT NULL,
		PRIMARY KEY (`group_id`)
		) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1";
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
		$sql="INSERT INTO `users_table` (`user_id`, `user_display_name`, `user_fname`, `user_lname`, `user_email`, `user_pwd`, `user_group`, `user_country`, `user_status`, `user_doj`, `billing_address_id`, `shipping_address_id`, `ipaddress`, `social_link_id`, `is_from_social_link`) VALUES(1, 'demouser', 'demouser', 'demouser', 'demouser@ajsquare.net', 'e10adc3949ba59abbe56e057f20f883e', 1, 'IN', 1, '2013-09-12', 1, 1, '192.168.1.69', '', 0)";
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
