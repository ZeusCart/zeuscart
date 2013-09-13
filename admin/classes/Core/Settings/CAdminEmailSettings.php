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
 * This class contains functions to show and update the site email settings into the database
 *
 * @package  		Core_Settings_CAdminEmailSettings
 * @category  		Core
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
   * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */

class Core_Settings_CAdminEmailSettings 
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
	 * Function displays the site email from the database
	 * 
	 * 
	 * @return string
	 */	 		
	function siteEmail()
	{
		
		
			$sql = "SELECT set_name,set_value FROM `admin_settings_table` where set_name='Admin Email'";
			$query = new Bin_Query();
			if($query->executeQuery($sql))
			{		
				
				return Display_DAdminEmailSettings::siteEmail($query->records);
			}
			else
			{
				return '<div class="alert alert-error">
    <button type="button" class="close" data-dismiss="alert">×</button> Admin Email Site Settings Not Found</div>';
			}
	}
	
	/**
	 * Function updates the changes made in the site email
	 * 
	 * 
	 * @return string
	 */	 	
	
	function updateSiteEmail()
	{
		if ($_POST['email']!='')
		{
			$sql = "UPDATE admin_settings_table SET set_value='".$_POST['email']."' where set_name='Admin Email'";
			$query = new Bin_Query();
			if($query->updateQuery($sql))
			{		
				
				return '<div class="alert alert-success">
    <button type="button" class="close" data-dismiss="alert">×</button> Site Email Settings <b>'.$_POST['email'].'</b> Saved Successfully</div>';
			}
			else
			{
				return '<div class="alert alert-error">
    <button type="button" class="close" data-dismiss="alert">×</button> Admin Email Site Settings Not Found</div>';
			}
		}
		else
			return '<div class="alert alert-error">
    <button type="button" class="close" data-dismiss="alert">×</button> Admin Email Id Should Not Be Empty</div>';
	}
}	
 ?>