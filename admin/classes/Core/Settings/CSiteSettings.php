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
 * This class contains functions to get and update the site moto details from the database
 *
 * @package  		Core_Settings_CSiteSettings
 * @category  		Core
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
   * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */


class Core_Settings_CSiteSettings 
{
	
	
	/**
	 * Stores the output
	 *
	 * @var array $output
	 */	
	 
	var $output = array();
	
	/**
	 * Stores the error messages
	 *
	 * @var array $errormessages
	 */	
	
	var $errormessages = array();
	
	/**
	 * Function gets the site settings details from the database 
	 * 
	 * 
	 * @return string
	 */	 	
		
	function siteSittings($Err)
	{
	
		$sql = "SELECT * FROM admin_settings_table "; 
		$query = new Bin_Query();
		$query->executeQuery($sql);
		
		$sqlTime = "SELECT tz_timezone FROM `timezone_table` order by tz_timezone";
		$queryTime = new Bin_Query();
		if($queryTime->executeQuery($sqlTime))		
		
		return Display_DSiteSettings::siteSittings($query->records[0],$queryTime->records,$Err);
		
	}
	
	/**
	 * Function updates the changes made in the site moto details into the table 
	 * 
	 * 
	 * @return string
	 */	 	
	
	function updatesiteSettings()
	{

		$remove =  array("\\n","\\r");
		$_POST['google_analytics'] = str_replace($remove,"",$_POST['google_analytics']);
		$_POST['customer_header'] = str_replace($remove,"",$_POST['customer_header']);

		if($_FILES['site_logo']['name'] != '')
		{
			$site_logo_path = 'images/logo/'.date("YmdHis").'_'.$_FILES['site_logo']['name'];
			if(move_uploaded_file($_FILES['site_logo']['tmp_name'],'../'.$site_logo_path))
				$site_logo = $site_logo_path;
		}
		else
		{
			$site_logo=$_POST['site_logo'];
		}

		 $sql = "UPDATE admin_settings_table SET 
			customer_header ='".trim($_POST['customer_header'])."' ,
			site_logo='".$site_logo."',
			google_analytics='".trim($_POST['google_analytics'])."',
			time_zone='".trim($_POST['time_zone'])."',
			site_moto='".trim($_POST['site_moto'])."',			
			meta_kerwords='".stripslashes(trim($_POST['meta_kerwords']))."',
			meta_description='".stripslashes(trim($_POST['meta_description']))."'
			where set_id='1'";  
			$query = new Bin_Query();
			if($query->updateQuery($sql))
			{		

				$_SESSION['msgSitemoto'] = '<div class="alert alert-success">
   				 <button type="button" class="close" data-dismiss="alert">×</button> Site settings has been updated successfully </div>';
		
			}
			else
			{
				$_SESSION['msgSitemoto'] = '<div class="alert alert-error">
    				<button type="button" class="close" data-dismiss="alert">×</button>Site settings has not been updated successfully</div>';

			}

			header('Location:?do=site');
			exit;
	}
}	
 ?>