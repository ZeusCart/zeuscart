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
 * This class contains functions to edit and update the google ad sense code from the database
 *
 * @package  		Core_Settings_CGoogleAdSense
 * @category  		Core
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
   * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */

class Core_Settings_CGoogleAdSense
{
 	
	/**
	 * Function gets the Google Ad Sense code from the database 
	 * 
	 * 
	 * @return string
	 */	 	
		
	function googleAdSenseCode()
	{
		$sql = "SELECT set_name,set_value FROM `admin_settings_table` where set_name='Google AdSense code'";
		$query = new Bin_Query();
		if($query->executeQuery($sql))
		{		
			return Display_DGoogleAdSense::googleAdSenseCode($query->records);
		}
		else
		{
			return '<div class="success_msgbox">No Settings Added</div>';
		}
	}
	
	
	/**
	 * Function updates the changes made in the Google Ad Sense code into the database 
	 * 
	 * 
	 * @return string
	 */	 	
	
	
	function updateGoogleAdSenseCode()
	{
		if($_POST['gadsense']!='')
		{
			$gad="<div id=\"ad\">".$_POST['gadsense']."</div>";
//			$sql = "UPDATE admin_settings_table SET set_value='".stripslashes(mysql_real_escape_string($gad))."' where set_name='Google AdSense code'";
			$sql = "UPDATE admin_settings_table SET set_value='".stripslashes($gad)."' where set_name='Google AdSense code'";

			$query = new Bin_Query();
			if($query->updateQuery($sql))
			{
				return '<div class="alert alert-success">
			<button type="button" class="close" data-dismiss="alert">×</button>
			<strong>Well done!</strong> Updated Successfully</div>';
			}
			else
			{
				return '<div class="alert alert-error">
			<button type="button" class="close" data-dismiss="alert">×</button> Not Updated!!! Try Again </div>';
			}
		}
		else
		{
			return '<div class="alert alert-error">
			<button type="button" class="close" data-dismiss="alert">×</button> Please Insert a Google adsense Script Code</div>';
		}
			
	}
}
?>