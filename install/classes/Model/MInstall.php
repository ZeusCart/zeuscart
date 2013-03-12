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
 * AJDF
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * @package 		AJDF
 * @author   	 	AJ Square Inc Dev Team
 * @copyright 	    Copyright (c) 2008 - 2013, AJ Square, Inc.
 * @link    		http://www.ajsquare.com/ajhome.php
 * @version   		Version 4.0
 * @created   		January 15 2013
 */

/**
 * installation process the  related  class
 *
 * @package   		install
 * @subpackage  	Model
 * @category    	Model
 * @author    		AJ Square Inc Dev Team
 * @link   		  http://www.zeuscart.com
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
			$menus='<ul>
					<li><h1>Introduction</h1></li>
					<li><h1>Terms & Conditions</h1></li>
					<li><h1>Check for Prerequisite</h1></li>
					<li><h1>Datebase Configuration</h1></li>
					<li><h1>Admin Configuartion</h1></li>
					<li><h1>Store Setting</h1></li>
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
		$menus='<ul>
					<li><h2>Introduction</h2></li>
					<li><h1>Terms & Conditions</h1></li>
					<li><h1>Check for Prerequisite</h1></li>
					<li><h1>Datebase Configuration</h1></li>
					<li><h1>Admin Configuartion</h1></li>
					<li><h1>Store Setting</h1></li>
					</ul>';
			$shownavigation = 1;
			$next = '?do=chkconfig';
			$prv = 'index.php';
			$template = 'terms.html';
		include('templates/home.php');	
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
		$menus='<ul>
					<li><h2>Introduction</h2></li>
					<li><h2>Terms & Conditions</h2></li>
					<li><h1>Check for Prerequisite</h1></li>
					<li><h1>Datebase Configuration</h1></li>
					<li><h1>Admin Configuartion</h1></li>
					<li><h1>Store Setting</h1></li>
					</ul>';
			if(!isset($_POST['accterms']))	
				header('Location:?do=installterms');		
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
		$menus='<ul>
					<li><h2>Introduction</h2></li>
					<li><h2>Terms & Conditions</h2></li>
					<li><h2>Check for Prerequisite</h2></li>
					<li><h1>Datebase Configuration</h1></li>
					<li><h1>Admin Configuartion</h1></li>
					<li><h1>Store Setting</h1></li>
					</ul>';
			include('classes/Lib/HandleErrors.php');
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
			if($this->chkDbConnection())
			{	
				include('classes/Core/CQuery.php');
				new Core_CQuery();
				$this->writeDbDetails();
				header('Location:?do=admdts');
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
		$menus='<ul>
					<li><h2>Introduction</h2></li>
					<li><h2>Terms & Conditions</h2></li>
					<li><h2>Check for Prerequisite</h2></li>
					<li><h2>Datebase Configuration</h2></li>
					<li><h1>Admin Configuartion</h1></li>
					<li><h1>Store Setting</h1></li>
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
		$menus='<ul>
					<li><h2>Introduction</h2></li>
					<li><h2>Terms & Conditions</h2></li>
					<li><h2>Check for Prerequisite</h2></li>
					<li><h2>Datebase Configuration</h2></li>
					<li><h2>Admin Configuartion</h2></li>
					<li><h1>Store Setting</h1></li>
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
			$selcurrencycode='<select name="currcode" id="currcode" style="width:153px;" class="textarea">';
			while($arry=mysql_fetch_array($result))
			{
				$selcurrencycode.='<option value="'.$arry['currency_code'].'"  '.(($arry['currency_code']=='USD') ? ' selected ="selected" ' : '' ).'>'.$arry['currency_code'].'</option>';
			}
			$selcurrencycode.='</select>';
			
			$sql="SELECT cou_code,name FROM country_table ORDER BY name";
			$result2=mysql_query($sql);
			$selcountrycode='<select name="taxratecountry" id="taxratecountry" style="width:153px;" class="textarea">';
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
			$password = base64_encode($_POST['pass']);
			
			$sql="DELETE FROM admin_table";
			$result=mysql_query($sql);
			$sql="INSERT INTO admin_table VALUES('1','$adminname','$password')"; 
			$result=mysql_query($sql);
			
$sql="DELETE FROM admin_settings_table";
$result=mysql_query($sql);			
$sql="INSERT INTO admin_settings_table VALUES('1','Footer Content','')"; 
$result=mysql_query($sql);
$sql="INSERT INTO admin_settings_table VALUES('2','Custom Header','<font color=blue><p>Exciting offers for this month !!!!&nbsp;</p></font>')"; 
$result=mysql_query($sql);
$sql="INSERT INTO admin_settings_table VALUES('3','Site Logo','images/logo/logo.gif')"; 
$result=mysql_query($sql);
$sql="INSERT INTO admin_settings_table VALUES('4','Google Analytics Code','')"; 
$result=mysql_query($sql);
$sql="INSERT INTO admin_settings_table VALUES('5','Google AdSense code','')"; 
$result=mysql_query($sql);
$sql="INSERT INTO admin_settings_table VALUES('6','Time Zone','')"; 
$result=mysql_query($sql);
$sql="INSERT INTO admin_settings_table VALUES('7','www.pricerunner.com Affiliate ID','')"; 
$result=mysql_query($sql);
$sql="INSERT INTO admin_settings_table VALUES('8','Homepage Banner Image','images/banner/banner.jpg')"; 
$result=mysql_query($sql);
$sql="INSERT INTO admin_settings_table VALUES('9','Site Moto','ZeusCart V 2.3')"; 
$result=mysql_query($sql);
$sql="INSERT INTO admin_settings_table VALUES('11','Homepage Banner URL','http://www.zeuscart.com/')"; 
$result=mysql_query($sql);
$sql="INSERT INTO admin_settings_table VALUES('12','Site Skin','default')"; 
$result=mysql_query($sql);
$sql="INSERT INTO admin_settings_table VALUES('13','Copy Rights','Copy Rights info')"; 
$result=mysql_query($sql);
$sql="INSERT INTO admin_settings_table VALUES('14','Admin Email','$adminemail')"; 
$result=mysql_query($sql);
$sql="INSERT INTO admin_settings_table VALUES('15','About Us','')"; 
$result=mysql_query($sql);
$sql="INSERT INTO admin_settings_table VALUES('16','Domain Name','$domainname')";  
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
// 			$val->Assign('currval',trim($_POST['currval']),'noempty/nostring','Required Field Cannot be left blank/Invalsid data');
// 			$currencyrate=trim($_POST['currval']);
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
		'../images/banner',
		'../images/logo',
		'../images/products',
		'../images/products/thumb',		
		'../Bin', 
		'../Built', 
		'../cache', 
		'../uploadedimages',
		'../userpage',  
		'../upload_bulk_products', 
		'../admin/cache', 
		'../admin/uploadedtsvfile',
		'../admin/uploadedbulkimages',
		'../includes',
		'../includes/Charts'); 
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
		$menus='<ul>
					<li><h2>Introduction</h2></li>
					<li><h2>Terms & Conditions</h2></li>
					<li><h2>Check for Prerequisite</h2></li>
					<li><h2>Datebase Configuration</h2></li>
					<li><h2>Admin Configuartion</h2></li>
					<li><h2>Store Setting</h2></li>
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
			fwrite($f,"define(\"IMAGE1_WIDTH\",225);  \n");
			fwrite($f,"define(\"IMAGE1_HEIGHT\",180);  \n");
			fwrite($f,"define(\"THUMB_WIDTH\", 90);  \n");
			fwrite($f,"define(\"THUMB_HEIGHT\",80);  \n");
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
		'../images/banner',
		'../images/logo',
		'../images/products',
		'../images/products/thumb',		
		'../Bin', 
		'../Bin/Configuration.php', 
		'../Built', 
		'../cache', 
		'../uploadedimages',
		'../userpage',  
		'../upload_bulk_products', 
		'../admin/cache', 
		'../admin/uploadedtsvfile',
		'../admin/uploadedbulkimages',
		'../includes',
		'../includes/Charts'); 
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