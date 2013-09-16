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
					<li class="inactive"><b>1</b> Installation</li>
					<li class="inactive"><b>2</b> Terms & Conditions</li>
					<li class="inactive"><b>3</b> Check for Prerequisite</li>
					<li class="inactive"><b>4</b> Database Configuration</li>
					<li class="inactive"><b>5</b> Admin Configuration</li>
					<li class="inactive"><b>6</b> Store Setting</li>	
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
				<li class="inactive"><b>3</b> Check for Prerequisite</li>
				<li class="inactive"><b>4</b> Database Configuration</li>
				<li class="inactive"><b>5</b> Admin Configuration</li>
				<li class="inactive"><b>6</b> Store Setting</li>
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
				<li class="inactive"><b>4</b> Database Configuration</li>
				<li class="inactive"><b>5</b> Admin Configuration</li>
				<li class="inactive"><b>6</b> Store Setting</li>
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
					<li class="inactive"><b>5</b> Admin Configuration</li>
					<li class="inactive"><b>6</b> Store Setting</li>
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
			<li class="inactive"><b>6</b> Store Setting</li>
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
			$selcurrencycode='<select name="currcode" id="currcode" style="width:80px;" >';
			while($arry=mysql_fetch_array($result))
			{
				$selcurrencycode.='<option value="'.$arry['currency_code'].'"  '.(($arry['currency_code']=='USD') ? ' selected ="selected" ' : '' ).'>'.$arry['currency_code'].'</option>';
			}
			$selcurrencycode.='</select>';
			
			$sql="SELECT cou_code,name FROM country_table ORDER BY name";
			$result2=mysql_query($sql);
			$selcountrycode='<select name="taxratecountry" id="taxratecountry" style="width:210px;" >';
			while($arry=mysql_fetch_array($result2))
			{
				$selcountrycode.='<option value="'.$arry['cou_code'].'" '.(($arry['cou_code']=='US') ? ' selected ="selected" ' : '' ).' >'.$arry['name'].'</option>';
			}
			$selcountrycode.='</select>';
			$template = 'storeset.php';
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
		(1, 'Exciting offers for this month !!!!&nbsp;', 'images/logo.gif', '', '', 'zeuscart', '', 'revathy@ajsquare.net', '', '')"; 
		$result=mysql_query($sql);
		
		header("Location:?do=store");
	}
	
	public function currencySet()
	{

			if(!isset($_POST['currname'])|| !isset($_POST['currtoken'])|| !isset($_POST['currcode']))
				header('Location:?do=store');
			$val = new Lib_Validation_Handler();
			$val->Assign('currname',trim($_POST['currname']),'noempty','Required Field Cannot be left blank');
			$val->Assign('currtoken',trim($_POST['currtoken']),'noempty','Required Field Cannot be left blank');
			$val->Assign('currcode',trim($_POST['currcode']),'noempty','Required Field Cannot be left blank');
			$val->Assign('currval',trim($_POST['currval']),'noempty','Required Field Cannot be left blank');
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
			$countrycode=$_POST['taxratecountry'];
			
			$sql="DELETE FROM currency_master_table";
			$result=mysql_query($sql);
			
			$sql="INSERT INTO currency_master_table VALUES('1','$currname','$currcode','$countrycode',$currencyrate,'$currtoken',1,1)"; 
			$result=mysql_query($sql);
			
			
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
			'../timthumb'); 
			foreach($folders777 as $folder)
		chmod($folder,0777);
		$this->complete();
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

		if(!@is_writable('../images/invoice')) 
		  {
			$val->Assign('image/invoice','','noempty','Path : root\images\invoice must be writable');	
		  }
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
// 		 if(!@is_writable('../userpage')) 
// 		  {
// 			$val->Assign('userpage','','noempty','Path : root\userpage  must be installed');	
// 		  }

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
			'../timthumb'); 	
		
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

}

?>