<?php
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
 * @package   		Model_MInstall
 * @category    	Model
 * @author    		AJ Square Inc Dev Team
 * @link   		http://www.zeuscart.com
 * @version   		Version 4.0	
 * @copyright 	        Copyright (c) 2008 - 2013, AJ Square, Inc.	
 */
class Model_MInstall
{
	
	public $config = array();
	/**
	 * This function is used to show the index  in installation process
	 *
	 * 
	 * 
	 * @return void
	 */
	public function indexPage()
	{
			$shownavigation =3;
			$next = '?do=installterms';
			$prv = 'index.php';
			$menus='<ul class="install">
					<li class="active"><b>1</b> Installation</li>
					<li class="inactive"><b>2</b> Terms & Conditions</li>
					<li class="inactive"><b>3</b> Check for Prerequisite</li>
					<li class="inactive"><b>4</b> Database Configuration</li>
					<li class="inactive"><b>5</b> Admin Configuration</li>
					<li class="inactive"><b>6</b> Store Setting</li>
					<li class="inactive"><b>7</b> Live Chat</li>	
				</ul>';
		$template = 'homepage.php';
		include('templates/home.php');
	}
	/**
	 * This function is used to show the terms page  in installation process
	 *
	 * 
	 * 
	 * @return void
	 */
	public function termsPage()
	{	
		include('classes/Lib/HandleErrors.php');
	
		$menus='<ul class="install">
					<li class="active"><b>1</b> Installation</li>
					<li class="active"><b>2</b> Terms & Conditions</li>
					<li class="inactive"><b>3</b> Check for Prerequisite</li>
					<li class="inactive"><b>4</b> Database Configuration</li>
					<li class="inactive"><b>5</b> Admin Configuration</li>	
					<li class="inactive"><b>6</b> Store Setting</li>
					<li class="inactive"><b>7</b> Live Chat</li>
				</ul>';
			$shownavigation = 1;
			$next = '?do=chkconfig';
			$prv = 'index.php';
			$template = 'terms.html';
		include('templates/home.php');	
		UNSET($_SESSION['error']);
	}
	/**
	 * This function is used to show the configuration page  in installation process
	 *
	 * 
	 * 
	 * @return void
	 */
	public function showConfig()
	{

		if(!isset($_POST['accterms']) && isset($_POST['check']))
		{	
			$_SESSION['error']='Accept The Terms of Use Agreement';
			header('Location:?do=installterms');
		}
		include('classes/Lib/HandleErrors.php');
		$menus='<ul class="install">
				<li class="active"><b>1</b> Installation</li>
				<li class="active"><b>2</b> Terms & Conditions</li>
				<li class="active"><b>3</b> Check for Prerequisite</li>
				<li class="inactive"><b>4</b> Database Configuration</li>
				<li class="inactive"><b>5</b> Admin Configuration</li>
				<li class="inactive"><b>6</b> Store Setting</li>
				<li class="inactive"><b>7</b> Live Chat</li>
			</ul>';
				
		$shownavigation = 1;
		$this->chkConfig();

		
		$next = '?do=db';
		$prv = '?do=installterms';	
	
		$template = 'chkconfig.php';			
		include('templates/home.php');	
		
			
	}
	/**
	 * This function is used to show the db configuration  in installation process
	 *
	 * 
	 * 
	 * @return void
	 */
	public function showDbConfig()
	{

		$this->chkrequiredfields();	

		
			$menus='<ul class="install">
				<li class="active"><b>1</b> Installation</li>
				<li class="active"><b>2</b> Terms & Conditions</li>
				<li class="active"><b>3</b> Check for Prerequisite</li>
				<li class="active"><b>4</b> Database Configuration</li>
				<li class="inactive"><b>5</b> Admin Configuration</li>
				<li class="inactive"><b>6</b> Store Setting</li>
				<li class="inactive"><b>7</b> Live Chat</li>
			</ul>';
			include('classes/Lib/HandleErrors.php');
			if($Err->values['sampledata']==1)
			{ 
				$checked='checked';
			}
			$shownavigation = 1;
			$next = '?do=dbadd';
			$prv = '?do=chkconfig';
			$template = 'dbconfig.php';
			include('templates/home.php');
			
		
	}
	/**
	 * This function is used to insert the db   in installation process
	 *
	 * 
	 * 
	 * @return void
	 */
	public function insertDatabase()
	{

		if($_POST['sampledata']==1)
		{	
			if($this->chkDbConnection())
			{	
				include('classes/Core/CQuery.php');
				new Core_CQuery();
				$this->writeDbDetails();
				header('Location:?do=admdts');
			}
		}
		else
		{
			
			if($this->chkDbConnection())
			{	
				include('classes/Core/CQueryEmptyData.php');
				new Core_CQuery();
				$this->writeDbDetails();
				header('Location:?do=admdts');
			}


		}
	}
	/**
	 * This function is used to write in cahce  in installation process
	 *
	 * 
	 * 
	 * @return void
	 */
	public function writeCache()
	{
		 include("../admin/classes/Lib/Configuration.php");
		 include("../admin/classes/Lib/SetConfiguration.php"); 
		 include("../admin/classes/Lib/Cache.php");
		 include("../admin/classes/Lib/CacheSettings.php");
		 $obj=new Lib_CacheSettings('all');
	}
	/**
	 * This function is used to check the directory in installation process
	 *
	 * 
	 * 
	 * @return void
	 */
	public function checkDir()
	{
		$path='../uploadedimages/test/best_sell2.jpg';
		$test='../images/best_sell2.jpg';
		@mkdir('../uploadedimages/test',0777);
		@copy($test,$path);
		if(file_exists($path))
		{
			$sql="UPDATE `site_setting` SET `folder_creation`=1 WHERE `site_set_id`=1";
			$obj=new Lib_Query();
			$obj->updateQuery($sql);
			unlink($path);
			unlink('../uploadedimages/test');

		}
		else
		{
			unlink('../uploadedimages/test');

		}
 
	}
	/**
	 * This function is used to insert the db   in installation process
	 *
	 * 
	 * 
	 * @return void
	 */
	public function showAdmin()
	{
		$menus='<ul class="install">
				<li class="active"><b>1</b> Installation</li>
				<li class="active"><b>2</b> Terms & Conditions</li>
				<li class="active"><b>3</b> Check for Prerequisite</li>
				<li class="active"><b>4</b> Database Configuration</li>
				<li class="active"><b>5</b> Admin Configuration</li>
				<li class="inactive"><b>6</b> Store Setting</li>
				<li class="inactive"><b>7</b> Live Chat</li>
				</ul>';
			include('classes/Lib/HandleErrors.php');
			$shownavigation = 1;
			$next = '?do=finish';
			$prv = '?do=db';
			$template = 'admconfig.php';
		include('templates/home.php');		
	}
	/**
	 * This function is used to show the store in installation process
	 *
	 * 
	 * 
	 * @return void
	 */
	public function showStore()
	{

		$menus='<ul class="install">
			<li class="active"><b>1</b> Installation</li>
			<li class="active"><b>2</b> Terms & Conditions</li>
			<li class="active"><b>3</b> Check for Prerequisite</li>
			<li class="active"><b>4</b> Database Configuration</li>
			<li class="active"><b>5</b> Admin Configuration</li>
			<li class="active"><b>6</b> Store Setting</li>
			<li class="inactive"><b>7</b> Live Chat</li>
			</ul>';
			include('classes/Lib/HandleErrors.php');
			$shownavigation = 1;
			$next = '?do=curset';
			$prv = '?do=db';
			//define(ROOT_FOLDER,'../');
			include('Bin/Configuration.php');	  
			$db = new Bin_Configuration();
			$conn = mysql_connect($db->config["HOST"],$db->config["USER"],$db->config["PASSWORD"]);
			mysql_select_db($db->config["DB"],$conn);
			$sql="SELECT distinct currency_code FROM currency_codes_table ORDER BY currency_code";
			$result=mysql_query($sql);
			$selcurrencycode='<select name="currcode" id="currcode" style="width:80px;" class="installtext">';
			while($arry=mysql_fetch_array($result))
			{
				$selcurrencycode.='<option value="'.$arry['currency_code'].'"  '.(($arry['currency_code']=='USD') ? ' selected ="selected" ' : '' ).'>'.$arry['currency_code'].'</option>';
			}
			$selcurrencycode.='</select>';
			
			$sql="SELECT cou_code,name FROM country_table ORDER BY name";
			$result2=mysql_query($sql);
			$selcountrycode='<select name="taxratecountry" id="taxratecountry" style="width:210px;" class="installtext">';
			while($arry=mysql_fetch_array($result2))
			{
				$selcountrycode.='<option value="'.$arry['cou_code'].'" '.(($arry['cou_code']=='US') ? ' selected ="selected" ' : '' ).' >'.$arry['name'].'</option>';
			}
			$selcountrycode.='</select>';

			$sqlLang="SELECT * FROM language";
			$result3=mysql_query($sqlLang);
			$selectlanguage='<select name="site_language" id="site_language" style="width:210px;" class="installtext">';
			while($arry=mysql_fetch_array($result3))
			{
				$selectlanguage.='<option value="'.$arry['lang_code'].'" '.(($arry['lang_code']=='en') ? ' selected ="selected" ' : '' ).' >'.$arry['lang_name'].'</option>';
			}
			$selectlanguage.='</select>';
			$template = 'storeset.php';
		include('templates/home.php');		
	}

	/**
	 * This function is used to show the onetoone live chat in installation process
	 *
	 * 
	 * 
	 * @return void
	 */
	function showLiveChat()
	{
	
		$menus='<ul class="install">
				<li class="active"><b>1</b> Installation</li>
				<li class="active"><b>2</b> Terms & Conditions</li>
				<li class="active"><b>3</b> Check for Prerequisite</li>
				<li class="active"><b>4</b> Database Configuration</li>
				<li class="active"><b>5</b> Admin Configuration</li>
				<li class="active"><b>6</b> Store Setting</li>
				<li class="active"><b>7</b> Live Chat</li>
				</ul>';
			include('classes/Lib/HandleErrors.php');
			$shownavigation = 4;
			$next = '?do=validatelivechat';
			$prv = '?do=store';
			$template = 'livechat.php';
		include('templates/home.php');	
	}
	/**
	 * This function is used to show validate the live chat page in installation process
	 *
	 * 
	 * 
	 * @return void
	 */
	function validateLiveChat()
	{
		
	
		if(!isset($_POST['account_name']) || !isset($_POST['password']) || !isset($_POST['con_password']) || !isset($_POST['email_id'])|| !isset($_POST['txtcaptcha']))
			header('Location:?do=livechat');
		$val = new Lib_Validation_Handler();
		$val->Assign('email_id',trim($_POST['email_id']),'noempty/emailcheck','Required Field Cannot be left blank/Invalid Email');
		$val->Assign('account_name',trim($_POST['account_name']),'noempty','Required Field Cannot be left blank');
		$val->Assign('password',trim($_POST['password']),'noempty','Required Field Cannot be left blank');
		$val->Assign('con_password',trim($_POST['con_password']),'noempty','Required Field Cannot be left blank');
		$val->Assign('txtcaptcha',trim($_POST['txtcaptcha']),'noempty','Required Field Cannot be left blank');
		if(trim($_POST['password']) != trim($_POST['con_password']))
			$val->Assign('cpass','','noempty',"Confirm password doesn't match with password");
		if(strlen(trim($_POST['password']))>32)
			$val->Assign('pass','','noempty',"Password should below 32 characters");	


		$message = "Characters should match the above image";
		$code = $_SESSION['security_code'];					
		
		if(!empty($_POST['txtcaptcha']) && !(strtolower(trim($_POST['txtcaptcha']))==strtolower($code)))
		{
			$val->Assign("txtcaptcha","","noempty",$message);	
			
		}	
			
		

		$val->PerformValidation('?do=livechat');

		include('Bin/Configuration.php');	  
		$db = new Bin_Configuration();
		$conn = mysql_connect($db->config["HOST"],$db->config["USER"],$db->config["PASSWORD"]);
		mysql_select_db($db->config["DB"],$conn);
	

		 $domin_name='http://'.$_SERVER['HTTP_HOST']; 	 

		$post1='accountname='.$_POST['account_name'].'&accountemail='.$_POST['email_id'].'&password='.$_POST['password'].'&product_name=zeuscart&product_version=v4&product_domain='.$domin_name.'';
		$url="http://services.onetoonetext.com/flexutil/php_services/product/product.php";
						
		$json_array=array();
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,false);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post1);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$ips_response = curl_exec($ch);
		curl_close($ch);
		$json_array=json_decode($ips_response,true);
			

		 $script_code='<script  type="text/javascript" src="http://code.jquery.com/jquery-1.8.2.min.js"></script><script type="text/javascript" src="http://services.onetoonetext.com/chat/onetoonetext.js"></script>
		  <span style="left: 0px; top: 30%; position: fixed; z-index: 999;"  id="output" ></span><div id="ajid" style="display:none">'.$json_array['result']['code'].'</div>';

		
		if( ($json_array['result']['status'] == '1') && ($json_array['result']['message'] == 'Success') )
		{

		       $sql = "UPDATE live_chat_table SET live_chat_script='".$script_code."' WHERE id='1'"; 
		       mysql_query($sql); 
		
			header('Location:?do=finishlivechat');
		}
		else
		{

			if($json_array['result']['message'] == 'Account name already exists.')
			{

				$val->Assign('account_name','','noempty',"Account name already exists.");
			}

			elseif($json_array['result']['message'] == 'Account email id already exists.')
			{

				$val->Assign('email_id','','noempty',"Email- id already exists.");
			}
			else
			{
				$val->Assign('account_name','','noempty',"Wrong Account Detail,Please Provide the valid Details .");

			}				

			$val->PerformValidation('?do=livechat');
		}	



	}
	/**
	 * This function is used to show finish page in for live chat installation process
	 *
	 * 
	 * 
	 * @return void
	 */
	function finishLiveChat()
	{
		

		$menus='<ul class="install">
				<li class="active"><b>1</b> Installation</li>
				<li class="active"><b>2</b> Terms & Conditions</li>
				<li class="active"><b>3</b> Check for Prerequisite</li>
				<li class="active"><b>4</b> Database Configuration</li>
				<li class="active"><b>5</b> Admin Configuration</li>
				<li class="active"><b>6</b> Store Setting</li>
				<li class="active"><b>7</b> Live Chat</li>
				</ul>';
			include('classes/Lib/HandleErrors.php');
			$shownavigation = 3;
			$next = '?do=complete';
		
			$template = 'finish_live_chat.php';
		include('templates/home.php');


	}
	/**
	 * This function is used to show finish page in installation process
	 *
	 * 
	 * 
	 * @return void
	 */
	public function finish()
	{

		if(!isset($_POST['email']) || !isset($_POST['uname']) || !isset($_POST['pass']) || !isset($_POST['cpass'])|| !isset($_POST['domain']))
			header('Location:?do=admdts');
		$val = new Lib_Validation_Handler();
		$val->Assign('email',trim($_POST['email']),'noempty/emailcheck','Required Field Cannot be left blank/Invalid Email');
		$val->Assign('uname',trim($_POST['uname']),'noempty','Required Field Cannot be left blank');
		$val->Assign('pass',trim($_POST['pass']),'noempty','Required Field Cannot be left blank');
		$val->Assign('cpass',trim($_POST['cpass']),'noempty','Required Field Cannot be left blank');
		$val->Assign('domain',trim($_POST['domain']),'noempty','Required Field Cannot be left blank');
		if(trim($_POST['pass']) != trim($_POST['cpass']))
			$val->Assign('cpass','','noempty',"Confirm password doesn't match with password");
		if(strlen(trim($_POST['pass']))>32)
			$val->Assign('pass','','noempty',"Password should below 32 characters");				
		$val->PerformValidation('?do=admdts');
		//define(ROOT_FOLDER,'../');
		include('Bin/Configuration.php');	  
		$db = new Bin_Configuration();
		$conn = mysql_connect($db->config["HOST"],$db->config["USER"],$db->config["PASSWORD"]);
		mysql_select_db($db->config["DB"],$conn);
		$domainname =trim($_POST['domain']);
		$adminemail = trim($_POST['email']);
		$adminname = trim($_POST['uname']);
		$password = md5($_POST['pass']);
		
		$sql="DELETE FROM admin_table";
		$result=mysql_query($sql);
		$sql="INSERT INTO admin_table VALUES('1','$adminname','$password')"; 
		$result=mysql_query($sql);
			
		$sql="DELETE FROM admin_settings_table";
		$result=mysql_query($sql);			
		$sql="INSERT INTO `admin_settings_table` (`set_id`, `customer_header`, `site_logo`, `google_analytics`, `time_zone`, `site_moto`, `site_skin`, `admin_email`, `meta_kerwords`, `meta_description`) VALUES
		(1, 'Exciting offers for this month !!!&nbsp;', 'images/logo.gif', '', '', '".$domainname."', 'default', '".$adminemail."', '', '')"; 
		$result=mysql_query($sql);

		$sql="DELETE FROM footer_settings_table";
		$result=mysql_query($sql);			
		$sql="INSERT INTO `footer_settings_table` (`email`,footercontent,free_shipping_cost) VALUES
		('".$adminemail."','Copyright© 2013. All rights reserved.','500' )"; 
		$result=mysql_query($sql);
		
		header("Location:?do=store");
	}
	
	public function currencySet()
	{


		$menus='<ul class="install">
					<li class="active"><b>1</b> Installation</li>
					<li class="active"><b>2</b> Terms & Conditions</li>
					<li class="active"><b>3</b> Check for Prerequisite</li>
					<li class="active"><b>4</b> Database Configuration</li>
					<li class="active"><b>5</b> Admin Configuration</li>
					<li class="active"><b>6</b> Store Setting</li>
					<li class="active"><b>7</b>Live Chat</li>
				</ul>';	

			if(!isset($_POST['currname'])|| !isset($_POST['currtoken'])|| !isset($_POST['currcode']))
				header('Location:?do=store');
			$val = new Lib_Validation_Handler();
			$val->Assign('currname',trim($_POST['currname']),'noempty','Required Field Cannot be left blank');
			$val->Assign('currtoken',trim($_POST['currtoken']),'noempty','Required Field Cannot be left blank');
			$val->Assign('currcode',trim($_POST['currcode']),'noempty','Required Field Cannot be left blank');
// 			$val->Assign('currval',trim($_POST['currval']),'noempty','Required Field Cannot be left blank');
			$currencyrate=trim($_POST['currval']);
			/*if($currencyrate<=0)
				$val->Assign('currval','','noempty',"Currency rate should be greater than 0.");		
			if(!is_numeric($currencyrate)&&!empty($currencyrate))
				$val->Assign('currval','','noempty',"Invalid type");	*/	
			$val->PerformValidation('?do=store');
			//define(ROOT_FOLDER,'../');
			include('Bin/Configuration.php');	  
			$db = new Bin_Configuration();
			$conn = mysql_connect($db->config["HOST"],$db->config["USER"],$db->config["PASSWORD"]);
			mysql_select_db($db->config["DB"],$conn);
			
			$currname = trim($_POST['currname']);
			$currtoken = trim($_POST['currtoken']);
			$currcode = trim($_POST['currcode']);
			
			$sql="DELETE FROM currency_master_table";
			$result=mysql_query($sql);
			
			$sql="INSERT INTO currency_master_table VALUES('1','$currname','$currcode','$currtoken',1,1)"; 
			$result=mysql_query($sql);
			
			$sql="UPDATE admin_settings_table SET site_language='".trim($_POST['site_language'])."'";
			$result=mysql_query($sql);

			if(trim($_POST['site_language'])=='cn')
			{

				//category
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
(1, '女性', 'women', 0, '1', 'uploadedimages/caticons/2013-09-10-170711laptop-bags05.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras sit amet nisl nec nunc ', 1, 0, 0),
(2, '鞋', 'shoes', 1, '1,2', 'uploadedimages/caticons/2013-09-10-171134formal-shoes03.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras sit amet nisl nec nunc ', 1, 0, 1),
(3, '服裝', 'clothing', 1, '1,3', 'uploadedimages/caticons/2013-09-10-171416shirt13.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras sit amet nisl nec nunc ', 1, 0, 1),
(4, '服裝', 'watches', 1, '1,4', 'uploadedimages/caticons/2013-09-10-171824digital-watches03.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras sit amet nisl nec nunc ', 1, 0, 1),
(5, '袋', 'bags', 1, '1,5', 'uploadedimages/caticons/2013-09-10-172159wallets03.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras sit amet nisl nec nunc ', 1, 0, 1),
(6, '靴子', 'boots', 2, '1,2,6', 'uploadedimages/caticons/2013-09-10-172243sports-shoes07.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras sit amet nisl nec nunc ', 1, 0, 2),
(7, '正式', 'foormal', 2, '1,2,7', 'uploadedimages/caticons/2013-09-10-172328formals06.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras sit amet nisl nec nunc ', 1, 0, 2),
(8, '運動鞋', 'sneakers', 2, '1,2,8', 'uploadedimages/caticons/2013-09-10-172414Crafted-Long-Sleeved-Shirt.jpg', 'SneakersSneakersSneakersSneakers', 1, 0, 2),
(9, '運動鞋', 'sportsshoes', 2, '1,2,9', 'uploadedimages/caticons/2013-09-10-172458formals06.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras sit amet nisl nec nunc ', 1, 0, 2),
(10, 'T卹', 'tshirts', 3, '1,3,10', 'uploadedimages/caticons/2013-09-10-172543Crafted-Long-Sleeved-Shirt.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras sit amet nisl nec nunc ', 1, 0, 2),
(11, '模擬手錶', 'analogwatches', 4, '1,4,11', 'uploadedimages/caticons/2013-09-10-172631digital-watches06.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras sit amet nisl nec nunc ', 1, 0, 2),
(12, '數字手錶', 'digitalwatches', 4, '1,4,12', 'uploadedimages/caticons/2013-09-10-172714digital-watches03.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras sit amet nisl nec nunc ', 1, 0, 2),
(13, '計時grahs的', 'chronographs', 4, '1,4,13', 'uploadedimages/caticons/2013-09-10-172822chronograhs06.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras sit amet nisl nec nunc ', 1, 0, 2),
(14, '筆記本電腦包', 'laptopbags', 5, '1,5,14', 'uploadedimages/caticons/2013-09-10-172917laptop-bags06.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras sit amet nisl nec nunc ', 1, 0, 2),
(15, '背上書包', 'backbags', 14, '1,5,14,15', 'uploadedimages/caticons/2013-09-10-172958backpacks03.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras sit amet nisl nec nunc ', 1, 0, 3),
(16, '錢包', 'wallets', 5, '1,5,16', 'uploadedimages/caticons/2013-09-10-173040Avalanche-Handbag.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras sit amet nisl nec nunc ', 1, 0, 2),
(17, '男性', 'men', 0, '17', 'uploadedimages/caticons/2013-09-10-173109shirts07.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras sit amet nisl nec nunc ', 1, 0, 0),
(18, '鞋', 'menshoes', 17, '17,18', 'uploadedimages/caticons/2013-09-10-173157sports-shoes07.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras sit amet nisl nec nunc ', 1, 0, 1),
(19, '袋', 'menbags', 17, '17,19', 'uploadedimages/caticons/2013-09-10-173249backpacks03.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras sit amet nisl nec nunc ', 1, 0, 1),
(20, '服裝', 'menclothing', 17, '17,20', 'uploadedimages/caticons/2013-09-10-173328Crafted-Long-Sleeved-Shirt.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras sit amet nisl nec nunc ', 1, 0, 1),
(21, '手錶', 'menwatch', 17, '17,21', 'uploadedimages/caticons/2013-09-10-173352digital-watches03.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras sit amet nisl nec nunc ', 1, 0, 1),
(22, '靴子', 'menboots', 18, '17,18,22', 'uploadedimages/caticons/2013-09-10-173432digital-watches03.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras sit amet nisl nec nunc ', 1, 0, 2),
(23, 'T卹', 'mentshirs', 20, '17,20,23', 'uploadedimages/caticons/2013-09-10-173704Crafted-Long-Sleeved-Shirt.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras sit amet nisl nec nunc ', 1, 0, 2),
(24, '數字手錶', 'mendigital', 21, '17,21,24', 'uploadedimages/caticons/2013-09-10-173738digital-watches03.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras sit amet nisl nec nunc ', 1, 0, 2),
(25, '飾品', 'menaccess', 0, '25', 'uploadedimages/caticons/2013-09-10-1738292.jpg', 'AccessoriesAccessories', 1, 0, 0),
(26, '手袋', 'mobile', 25, '25,26', 'uploadedimages/caticons/2013-09-10-1739106.jpg', 'MobileMobileMobile', 1, 0, 1),
(31, '運動鞋', 'mensportsshoes',18, '17,18,31', '', '', 1, 0, 2),
(32,'筆記本電腦包', 'menlaptopbags', 19, '17,19,32', '', '', 1, 0, 2),
(33,'背上書包','menbackbags', 19, '17,19,33', '', '', 1, 0, 2),
(34,'錢包','menwallets', 19, '17,19,34', '', '', 1, 0, 2),
(35,'襯衫', 'menshitrs', 20, '17,20,35', '', '', 1, 0, 2),
(36,'模擬手錶','menanalogwatch', 21, '17,21,36', '', '', 1, 0, 2),
(37, '芯片','chip', 28, '25,28,37', '', '', 1, 0, 2);";
				$result=mysql_query($sql);

				//products
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
			`has_variation` tinyint(11) NOT NULL,
			`product_status` int(1) NOT NULL COMMENT '1=>new products,2=>discount product,3=>deleted products',
			`deleted_reason` varchar(240) NOT NULL,
			PRIMARY KEY (`product_id`)) ";

				$result=mysql_query($sql);
				$sql="INSERT INTO `products_table` (`product_id`, `category_id`, `sku`, `title`, `alias`, `description`, `brand`, `model`, `msrp`, `price`, `cse_enabled`, `cse_key`, `weight`, `dimension`, `thumb_image`, `image`, `large_image_path`, `shipping_cost`, `status`, `tag`, `meta_desc`, `meta_keywords`, `intro_date`, `is_featured`, `digital`, `gift`, `digital_product_path`, `has_variation`, `product_status`, `deleted_reason`) VALUES
			(1, '22', '15asAS', '靴子', '靴子', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras sit amet nisl nec nunc sollicitudin bibendum. Pellentesque orci Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras sit amet nisl nec nunc sollicitudin bibendum. Pellentesque orci.</p>', '', '', 200, 150, 0, '', '1', '', 'images/products/thumb/boot06.jpg', 'images/products/boot06.jpg', 'images/products/large_image/boot06.jpg', 0, 1, '', '', '', '2013-10-17', 1, 0, 0, '', 1, 1, ''),
			(2, '29', '15kj', '正式的皮鞋', '正式的皮鞋', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras sit amet nisl nec nunc sollicitudin bibendum. Pellentesque orci Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras sit amet nisl nec nunc sollicitudin bibendum. Pellentesque orci.', '外套', '', 700, 500, 0, '', '1', '', 'images/products/thumb/formals06.jpg', 'images/products/formals06.jpg', 'images/products/large_image/formals06.jpg', 10, 1, '', '', '', '2013-10-17', 1, 0, 0, '', 1, 1, ''),
			(3, '30', 'as15', '運動鞋', '運動鞋', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras sit amet nisl nec nunc sollicitudin bibendum. Pellentesque orci Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras sit amet nisl nec nunc sollicitudin bibendum. Pellentesque orci.', '', '', 500, 150, 0, '', '1', '', 'images/products/thumb/sneakers05.jpg', 'images/products/sneakers05.jpg', 'images/products/large_image/sneakers05.jpg', 0, 1, '', '', '', '2013-10-17', 1, 0, 0, '', 1, 1, ''),
			(4, '31', '15', '運動鞋', '運動鞋', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras sit amet nisl nec nunc sollicitudin bibendum. Pellentesque orci Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras sit amet nisl nec nunc sollicitudin bibendum. Pellentesque orci.', '', '', 100, 50, 0, '', '1', '', 'images/products/thumb/Puma-KURIS-Men-Black.jpg', 'images/products/Puma-KURIS-Men-Black.jpg', 'images/products/large_image/Puma-KURIS-Men-Black.jpg', 0, 1, '', '', '', '2013-10-17', 1, 0, 0, '', 1, 1, ''),
			(5, '32', '15', '筆記本電腦包', '筆記本電腦包', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras sit amet nisl nec nunc sollicitudin bibendum. Pellentesque orci Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras sit amet nisl nec nunc sollicitudin bibendum. Pellentesque orci.', '', '', 150, 100, 0, '', '1', '', 'images/products/thumb/laptop-bags06.jpg', 'images/products/laptop-bags06.jpg', 'images/products/large_image/laptop-bags06.jpg', 0, 1, '', '', '', '2013-10-17', 1, 0, 0, '', 0, 1, ''),
			(6, '33', '5a', '背上書包', '背上書包', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras sit amet nisl nec nunc sollicitudin bibendum. Pellentesque orci Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras sit amet nisl nec nunc sollicitudin bibendum. Pellentesque orci.', '', '', 200, 150, 0, '', '1', '', 'images/products/thumb/backpacks06.jpg', 'images/products/backpacks06.jpg', 'images/products/large_image/backpacks06.jpg', 0, 1, '', '', '', '2013-10-17', 1, 0, 0, '', 0, 1, ''),
			(7, '34', '10a', '錢包', '錢包', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras sit amet nisl nec nunc sollicitudin bibendum. Pellentesque orci Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras sit amet nisl nec nunc sollicitudin bibendum. Pellentesque orci.', '', '', 15, 10, 0, '', '1', '', 'images/products/thumb/wallets06.jpg', 'images/products/wallets06.jpg', 'images/products/large_image/wallets06.jpg', 0, 1, '', '', '', '2013-10-17', 1, 0, 0, '', 0, 1, ''),
			(8, '23', '15', 'T卹', 'T卹', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras sit amet nisl nec nunc sollicitudin bibendum. Pellentesque orci Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras sit amet nisl nec nunc sollicitudin bibendum. Pellentesque orci.', '', '', 15, 10, 0, '', '1', '', 'images/products/thumb/t-shirts06.jpg', 'images/products/t-shirts06.jpg', 'images/products/large_image/t-shirts06.jpg', 0, 1, '', '', '', '2013-10-17', 1, 0, 0, '', 1, 1, ''),
			(9, '35', '152', '襯衫', '襯衫', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras sit amet nisl nec nunc sollicitudin bibendum. Pellentesque orci Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras sit amet nisl nec nunc sollicitudin bibendum. Pellentesque orci.', '', '', 100, 50, 0, '', '1', '', 'images/products/thumb/shirts07.jpg', 'images/products/shirts07.jpg', 'images/products/large_image/shirts07.jpg', 0, 1, '', '', '', '2013-10-17', 0, 0, 0, '', 1, 1, ''),
			(10, '24', '15a', '數字手錶', '數字手錶', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras sit amet nisl nec nunc sollicitudin bibendum. Pellentesque orci Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras sit amet nisl nec nunc sollicitudin bibendum. Pellentesque orci.', '', '', 15, 10, 0, '', '', '', 'images/products/thumb/digital-watches03.jpg', 'images/products/digital-watches03.jpg', 'images/products/large_image/digital-watches03.jpg', 0, 1, '', '', '', '2013-10-17', 1, 0, 0, '', 0, 2, ''),
			(11, '36', '15s', '模擬手錶', '模擬手錶', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras sit amet nisl nec nunc sollicitudin bibendum. Pellentesque orci Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras sit amet nisl nec nunc sollicitudin bibendum. Pellentesque orci.', '塔塔', '', 150, 100, 0, '', '1', '', 'images/products/thumb/analog-watches05.jpg', 'images/products/analog-watches05.jpg', 'images/products/large_image/analog-watches05.jpg', 0, 1, '', '', '', '2013-10-17', 1, 0, 0, '', 0, 1, ''),
			(12, '6', '15', '靴子', '靴子', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras sit amet nisl nec nunc sollicitudin bibendum. Pellentesque orci Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras sit amet nisl nec nunc sollicitudin bibendum. Pellentesque orci.', '外套', '', 200, 150, 0, '', '1', '', 'images/products/thumb/boots02.jpg', 'images/products/boots02.jpg', 'images/products/large_image/boots02.jpg', 0, 1, '', '', '', '2013-10-17', 1, 0, 0, '', 1, 1, ''),
			(13, '7', '65', '正式的皮鞋', '正式的皮鞋', '', '', '', 15, 10, 0, '', '', '', 'images/products/thumb/formal-shoes06.jpg', 'images/products/formal-shoes06.jpg', 'images/products/large_image/formal-shoes06.jpg', 0, 1, '', '', '', '2013-10-17', 1, 0, 0, '', 1, 2, ''),
			(14, '8', '15', '運動鞋', '運動鞋', '', '', '', 20, 15, 0, '', '', '', 'images/products/thumb/sneakers05.jpg', 'images/products/sneakers05.jpg', 'images/products/large_image/sneakers05.jpg', 0, 1, '運動鞋', '', '', '2013-10-17', 1, 0, 0, '', 1, 2, ''),
			(15, '9', '15q', '運動鞋', '運動鞋', '', '', '', 15, 10, 0, '', '', '', 'images/products/thumb/sports-shoes06.jpg', 'images/products/sports-shoes06.jpg', 'images/products/large_image/sports-shoes06.jpg', 0, 1, '', '', '', '2013-10-17', 1, 0, 0, '', 1, 2, ''),
			(16, '10', '15', 'T卹', 'T卹', '', '', '', 15, 10, 0, '', '1', '', 'images/products/thumb/t-shirts02.jpg', 'images/products/t-shirts02.jpg', 'images/products/large_image/t-shirts02.jpg', 0, 1, '', '', '', '2013-10-17', 1, 0, 0, '', 1, 1, ''),
			(17, '11', '15a', ' 模擬手錶', ' 模擬手錶', '', '', '', 15, 10, 0, '', '', '', 'images/products/thumb/analog-watches06.jpg', 'images/products/analog-watches06.jpg', 'images/products/large_image/analog-watches06.jpg', 0, 1, '手錶', '', '', '2013-10-17', 1, 0, 0, '', 0, 2, ''),
			(18, '12', '15', '數字手錶', '數字手錶', '', '', '', 15, 10, 0, '', '1', '', 'images/products/thumb/digital-watches02.jpg', 'images/products/digital-watches02.jpg', 'images/products/large_image/digital-watches02.jpg', 0, 1, '', '', '', '2013-10-17', 1, 0, 0, '', 0, 2, ''),
			(19, '13', '15s', '計時grahs的', '計時grahs的', '', '', '', 15, 10, 0, '', '', '', 'images/products/thumb/chronograhs05.jpg', 'images/products/chronograhs05.jpg', 'images/products/large_image/chronograhs05.jpg', 0, 1, '', '', '', '2013-10-17', 1, 0, 0, '', 0, 2, ''),
			(20, '14', '15', '筆記本電腦包', '筆記本電腦包', '<p>Nunc facilisis sagittis ullamcorper. Proin lectus ipsum, gravida et mattis vulputate, tristique ut lectus. Sed et lorem nunc. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Aenean eleifend laoreet congue. Vivamus adipiscing nisl ut dolor dignissim semper. Nulla luctus malesuada tincidunt. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.', '', '', 200, 10, 0, '', '1', '', 'images/products/thumb/laptop-bags04.jpg', 'images/products/laptop-bags04.jpg', 'images/products/large_image/laptop-bags04.jpg', 0, 1, 'bags', '', '', '2013-10-17', 1, 0, 0, '', 0, 1, ''),
			(21, '15', '15', '背上書包', '背袋', '', '', '', 15, 10, 0, '', '1', '', 'images/products/thumb/backpacks03.jpg', 'images/products/backpacks03.jpg', 'images/products/large_image/backpacks03.jpg', 0, 1, '', '', '', '2013-10-17', 1, 0, 0, '', 0, 1, ''),
			(22, '16', '15asd', '錢包', '錢包', '', '', '', 15, 10, 0, '', '1', '', 'images/products/thumb/wallets01.jpg', 'images/products/wallets01.jpg', 'images/products/large_image/wallets01.jpg', 0, 1, '', '', '', '2013-10-17', 1, 0, 0, '', 0, 1, ''),
			(23, '27', '15', '手包', '手包', '<p>Nunc facilisis sagittis ullamcorper. Proin lectus ipsum, gravida et mattis vulputate, tristique ut lectus. Sed et lorem nunc. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Aenean eleifend laoreet congue. Vivamus adipiscing nisl ut dolor dignissim semper. Nulla luctus malesuada tincidunt. Class aptent taciti sociosqu ad litora torquent per conubia nostra</p>', '', '', 600, 500, 0, '', '1', '', 'images/products/thumb/2013-10-18-064649hand2.jpg', 'images/products/2013-10-18-064649hand2.jpg', 'images/products/large_image/2013-10-18-064649hand2.jpg', 0, 1, '', '', '', '2013-10-17', 1, 0, 0, '', 1, 1, ''),
			(24, '37', '15a', '芯片', '芯片', '', '', '', 1500, 1000, 0, '', '1', '', 'images/products/thumb/chip.jpg', 'images/products/chip.jpg', 'images/products/large_image/chip.jpg', 0, 1, '', '', '', '2013-10-17', 1, 0, 0, '', 0, 1, '')";
			$result=mysql_query($sql); 


				$sql="UPDATE admin_settings_table SET customer_header='這一個月的令人興奮的優惠！ ！ ！' WHERE set_id	='1'";	
				$result=mysql_query($sql); 



				$sql="UPDATE footer_settings_table SET footercontent='版權所有©2013。保留所有權利' WHERE id	='1'";	
				$result=mysql_query($sql); 	

			}	

			$folders777=array(
			'../images',
			'../images/homepageads',
			'../images/invoice',
			'../images/slidesupload',
			'../images/slidesupload/thumb',
			'../images/logo',
			'../images/products',
			'../images/products/thumb',
			'../images/products/large_image',
			'../images/products/sociallink',		
			'../Bin', 
			'../Built', 
			'../cache', 
			'../uploadedimages',
			'../uploadedimages/caticons',			 
			'../upload_bulk_products', 
			'../admin/cache', 
			'../admin/uploadedtsvfile',
			'../admin/download',
			'../admin/uploadedbulkimages',
			'../includes',
			'../includes/Charts',
			'../timthumb',
			'../timthumb/cache'); 
			foreach($folders777 as $folder)
		chmod($folder,0777);

		header('Location:?do=livechat');
	}
	
	/**
	 * This function is used to show the complete page in installation process
	 *
	 * 
	 * 
	 * @return void
	 */
	public function complete()
	{
		$menus='<ul class="install">
					<li class="active"><b>1</b> Installation</li>
					<li class="active"><b>2</b> Terms & Conditions</li>
					<li class="active"><b>3</b> Check for Prerequisite</li>
					<li class="active"><b>4</b> Database Configuration</li>
					<li class="active"><b>5</b> Admin Configuration</li>
					<li class="active"><b>6</b> Store Setting</li>
					<li class="active"><b>7</b> Live Chat</li>
				</ul>';
		$shownavigation = 2;
			$template = "templates/finish.php";		
			include('templates/home.php');	
	}
	/**
	 * This function is used to write db details in congiguration in installation process
	 *
	 * 
	 * 
	 * @return void
	 */
	private function writeDbDetails()
	{

		$url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		$url=explode('install',$url);
		$url=$url[0];
		$url = rtrim($url,"/");

		$dbfile="../Bin/Configuration.php";
		@chmod($dbfile,0777);
		if(is_writable($dbfile))
		{
			$f=fopen($dbfile,"w");
			fwrite($f,"<?php \n");
			fwrite($f,"//***************** Do not Edit / Change anything in this file ********************// \n");
			fwrite($f,"class Bin_Configuration extends Bin_Security {  \n");
			fwrite($f,"var ".'$config'. " = array();  \n");
			fwrite($f,"function Bin_Configuration() {  \n");
			fwrite($f,'$this->config["HOST"] = \''.trim($_POST['host']). "';  \n");
			fwrite($f,'$this->config["USER"] = \''.trim($_POST['uname']). "';  \n");
			fwrite($f,'$this->config["PASSWORD"] = \''.trim($_POST['pass']). "';  \n");
			fwrite($f,'$this->config["DB"] = \''.trim($_POST['dbname']). "';  \n");			
			
			
			fwrite($f,"} }  \n");
			fwrite($f,"define(\"IMAGE2_WIDTH\",800);  \n");
			fwrite($f,"define(\"IMAGE2_HEIGHT\",868);  \n");
			fwrite($f,"define(\"IMAGE1_WIDTH\",350);  \n");
			fwrite($f,"define(\"IMAGE1_HEIGHT\",358);  \n");
			fwrite($f,"define(\"THUMB_WIDTH\", 68);  \n");
			fwrite($f,"define(\"THUMB_HEIGHT\",68);  \n");
			
			fwrite($f,'$_SESSION["base_url"]= \''.trim($url). "'; \n");

			fwrite($f,"?>");			
			fclose($f);
			@chmod($dbfile,0644);			
		}	
	}
	
	/**
	 * This function is used to check db details in installation process
	 *
	 * 
	 * 
	 * @return void
	 */
	private function chkDbConnection()
	{
		if(!isset($_POST['host']) || !isset($_POST['uname']) || !isset($_POST['pass']) || !isset($_POST['dbname']))
		header('Location:?do=db');
		$val = new Lib_Validation_Handler();
		$val->Assign('host',trim($_POST['host']),'noempty','Required Field Cannot be left blank');
		$val->Assign('uname',trim($_POST['uname']),'noempty','Required Field Cannot be left blank');
		$val->Assign('dbname',trim($_POST['dbname']),'noempty','Required Field Cannot be left blank');
		$val->PerformValidation('?do=db');
		
		error_reporting(0);		
		$conn = mysql_connect(trim($_POST['host']),trim($_POST['uname']),trim($_POST['pass'])) or $conn = false;
		if($conn)
		{
			if(mysql_select_db($_POST['dbname'],$conn))
				return true;
			else
			{
				$val->Assign('host',trim($_POST['host']),'noempty','Required Field Cannot be left blank');
				$val->Assign('uname',trim($_POST['uname']),'noempty','Required Field Cannot be left blank');
				$val->Assign('dbname','','noempty','Please Check the Database name');
				$val->Assign('err','','noempty','Error occured connecting the Database');
				$val->PerformValidation('?do=db');			
			}	
		}	
		else
		{
			$val->Assign('host','','noempty','Please check Server name');
			$val->Assign('uname','','noempty','Please check User name');
			$val->Assign('pass','','noempty','Please check Password');
			$val->Assign('err','','noempty','Error occured connecting the Server');
			$val->Assign('dbname',trim($_POST['dbname']),'noempty','Required Field Cannot be left blank');
			$val->PerformValidation('?do=db');
		}
		
	}
	/**
	 * This function is used to check reuired fields in installation process
	 *
	 * 
	 * 
	 * @return void
	 */
	function chkrequiredfields()
	{
		
		$val = new Lib_Validation_Handler();
		if(version_compare(PHP_VERSION,"5.2.0")<=0)
		$val->Assign('phperr','','noempty','PHP Version 5.2.0  must be installed');

		if(!extension_loaded('gd') && !function_exists('gd_info'))
		$val->Assign('gdlib','','noempty','GD Library must be installed');
		
		if(!extension_loaded('CURL'))
		$val->Assign('curl','','noempty','CURL must be installed');

		if(!extension_loaded('SimpleXML'))
		$val->Assign('sxml','','noempty','Simple XML must be installed');

		if(!extension_loaded('MySQL'))
		$val->Assign('mysql','','noempty','MySQL must be installed');


		
		if(!@is_writable('../images')) 
		  {
			$val->Assign('image','','noempty','Path : root\images must be writable');	
		  }
		if(!@is_writable('../images/homepageads')) 
		  {
			$val->Assign('image/homepageads','','noempty','Path : root\images\homepageads must be writable');	
		  }
/*
		if(!@is_writable('../images/invoice')) 
		  {
			$val->Assign('image/invoice','','noempty','Path : root\images\invoice must be writable');	
		  }*/
		 if(!@is_writable('../images/slidesupload')) 
		  {
			$val->Assign('slide','','noempty','Path : root\images\slidesupload must be writable');	
		  }
		 if(!@is_writable('../images/slidesupload/thumb')) 
		  {
			$val->Assign('slidethumb','','noempty','Path : root\images\slidesupload\thumb must be writable');	
		  }
		 if(!@is_writable('../images/logo')) 
		  {
			$val->Assign('logo','','noempty','Path : root\images\logo must be writable');	
		  }
		 if(!@is_writable('../images/products')) 
		  {
			$val->Assign('products','','noempty','Path : root\images\products must be writable');	
		  }
		 if(!@is_writable('../images/products/large_image')) 
		  {
			$val->Assign('prolarge_image','','noempty','Path : root\images\products\large_image must be installed');	
		  }
		 if(!@is_writable('../images/products/thumb')) 
		  {
			$val->Assign('prothumb','','noempty','Path : root\images\products\thumb must be installed');	
		  }
		 if(!@is_writable('../images/sociallink')) 
		  {
			$val->Assign('sociallink','','noempty','Path : root\images\sociallink must be installed');	
		  }
		 if(!@is_writable('../Bin')) 
		  {
			$val->Assign('bin','','noempty','Path : root\Bin  must be installed');	
		  }
			
	
	
		 if(!@is_writable('../Bin/Configuration.php')) 
		  {
			$val->Assign('bincon','','noempty','Path : root\Bin\Configuration.php must be installed');	
		  }
		 if(!@is_writable('../Built')) 
		  {
			$val->Assign('bulid','','noempty','Path : root\Built   must be installed');	
		  }


		 if(!@is_writable('../cache')) 
		  {
			$val->Assign('cache','','noempty','Path : root\cache   must be installed');	
		  }
		 if(!@is_writable('../uploadedimages')) 
		  {
			$val->Assign('uploadedimages','','noempty','Path : root\uploadedimages must be installed');	
		  }
		 if(!@is_writable('../uploadedimages/caticons')) 
		  {
			$val->Assign('caticons','','noempty','Path : root\uploadedimages\caticons  must be installed');	
		  }
 		 if(!@is_writable('../upload_bulk_products')) 
		  {
			$val->Assign('uploadprobulk','','noempty','Path : root\upload_bulk_products  must be installed');	
		  }
			 if(!@is_writable('../admin/cache')) 
		  {
			$val->Assign('admincache','','noempty','Path : root\admin\cache   must be installed');	
		  }
		 if(!@is_writable('../admin/uploadedtsvfile')) 
		  {
			$val->Assign('uploadtsv','','noempty','Path : root\admin\uploadedtsvfile must be installed');	
		  }
		 if(!@is_writable('../admin/uploadedbulkimages')) 
		  {
			$val->Assign('uploadbulkimage','','noempty','Path : root\admin\uploadedbulkimages  must be installed');	
		  }
		if(!@is_writable('../admin/download')) 
		  {
			$val->Assign('download','','noempty','Path : root\admin\download  must be installed');	
		  }


		 if(!@is_writable('../includes')) 
		  {
			$val->Assign('include','','noempty','Path : root\includes    must be installed');	
		  }
		 
		 if(!@is_writable('../includes/Charts')) 
		  {
			$val->Assign('includecharts','','noempty','Path : root\includes\Charts must be installed');	
		  }	
	 
		 if(!@is_writable('../timthumb')) 
		  {
			$val->Assign('timthumb','','noempty','Path : root\timthumb must be installed');	
		  }
		 if(!@is_writable('../timthumb/cache')) 
		  {
			$val->Assign('timthumbcache','','noempty','Path : root\timthumb must be installed');	
		  }	
		$val->PerformValidation('?do=chkconfig');

	}
	/**
	 * This function is used to check configuration in installation process
	 *
	 * 
	 * 
	 * @return void
	 */
	private function chkConfig()
	{
		$this->config['configok'] = 1;
		$php_version = PHP_VERSION;
		if(version_compare($php_version,"5.2.0")>0)
			$this->config['php'] = '<span class="installed">Installed</span>'; 
		else
		{
			$this->config['php'] = '<span class="off_txt">Not Installed</span>';
			$this->config['configok'] = 0;
		}
			
		if(@ini_get('register_globals') == '1' || strtolower(@ini_get('register_globals')) == 'on')
			$this->config['regglobals'] = '<span class="off_txt">ON</span>';
		else
			$this->config['regglobals'] = '<span class="installed">OFF</span>';
		
		if(extension_loaded('GD'))
			$this->config['gd'] = '<span class="installed">Installed</span>';
		else
		{
			$this->config['gd'] = '<span class="off_txt">Not Installed</span>';	
			$this->config['configok'] = 0;
		}
				
		if(extension_loaded('CURL'))
			$this->config['curl'] = '<span class="installed">Installed</span>';
		else
		{
			$this->config['curl'] = '<span class="off_txt">Not Installed</span>';	
			$this->config['configok'] = 0;
		}

		if(extension_loaded('SimpleXML'))
			$this->config['sxml'] = '<span class="installed">Installed</span>';
		else
		{
			$this->config['sxml'] = '<span class="off_txt">Not Installed</span>';	
			$this->config['configok'] = 0;
		}

		if(extension_loaded('MySQL'))
			$this->config['mysql'] = '<span class="installed">Installed</span>';
		else
		{
			$this->config['mysql'] = '<span class="off_txt">Not Installed</span>';	
			$this->config['configok'] = 0;
		}
		
		$folders777=array(
			'../images',
			'../images/homepageads',
			'../images/slidesupload',
			'../images/slidesupload/thumb',
			'../images/logo',
			'../images/products',
			'../images/products/thumb',
			'../images/products/large_image',
			'../images/sociallink',		
			'../Bin', 
			'../Bin/Configuration',
			'../Built', 
			'../cache', 
			'../uploadedimages',
			'../uploadedimages/caticons',			 
			'../upload_bulk_products', 
			'../admin/cache', 
			'../admin/uploadedtsvfile',
			'../admin/download',
			'../admin/uploadedbulkimages',
			'../includes',
			'../includes/Charts',
			'../timthumb',
			'../timthumb/cache');
		
		$i=1;
		foreach($folders777 as $folder)
		{
		  if(@is_writable($folder)) 
		  {
			  $this->config['filepermit'.$i] = '<span class="installed">Writable</span>';
		  }
		  else
		  {
			  $this->config['filepermit'.$i] = '<span class="off_txt">Not Writable</span>';		
			  $this->config['configok'] = 0;
		  }	
		  $i++;
		}
		
	}
	/**
	 * This function is used to show the capcha in installation process
	 *
	 * 
	 * 
	 * @return void
	 */
	function showCaptcha()
	{		
		include('classes/Lib/Captcha.php');	
	}

}

?>