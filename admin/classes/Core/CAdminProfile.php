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
 * This class contains functions to get and update the admin profile details from the database
 *
 * @package  		Core_CAdminProfile
 * @category  		Core
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
   * @copyright 	Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */


class Core_CAdminProfile
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
		
	function showAdminProfile($Err)
	{
		$sql = "SELECT * FROM admin_table ";  
		$query = new Bin_Query();
		$query->executeQuery($sql);
	
		$sql1 = "SELECT * FROM admin_settings_table WHERE set_id='1'";  
		$query1 = new Bin_Query();
		$query1->executeQuery($sql1);
	
		return Display_DAdminProfile::showAdminProfile($query->records[0],$query1->records[0],$Err);
	}
	
	/**
	 * Function updates the changes made in the site moto details into the table 
	 * 
	 * 
	 * @return string
	 */	 	
	
	function updateAdminProfile()
	{
	
		if($_POST['admin_password']!='' && $_SERVER['HTTP_HOST']!='demo.zeuscart.com')
		{
			$admin_password=md5(trim($_POST['admin_password']));	
			$sql = "UPDATE admin_table SET 
			admin_name  ='".trim($_POST['admin_name'])."' ,
			admin_password ='".$admin_password."'			
			where admin_id='1'";  
		}
		elseif($_SERVER['HTTP_HOST']!='demo.zeuscart.com')
		{
			$sql = "UPDATE admin_table SET 
			admin_name  ='".trim($_POST['admin_name'])."' 					
			where admin_id='1'";  

		}
			$query = new Bin_Query();
			if($query->updateQuery($sql))
			{	
				$sql1="UPDATE admin_settings_table SET admin_email='".$_POST['admin_email']."' 
				       WHERE set_id=1";
				$query1=new Bin_Query();
				$query1->updateQuery($sql1);
	

				$_SESSION['msgadminproflie'] = '<div class="alert alert-success">
   				 <button type="button" class="close" data-dismiss="alert">×</button>Admin profile has been updated successfully </div>';
		
			}
			else
			{
				$_SESSION['msgadminproflie'] = '<div class="alert alert-error">
    				<button type="button" class="close" data-dismiss="alert">×</button>Admin profile has not been updated successfully</div>';

			}

			header('Location:?do=adminprofile');
			exit;
	}
}	
 ?>