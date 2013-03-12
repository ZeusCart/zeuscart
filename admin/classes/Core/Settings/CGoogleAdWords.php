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
 * This class contains functions to edit and update the Google Adwords script
 *
 * @package  		Core_Settings_CGoogleAdWords
 * @category  		Core
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
   * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */

class Core_Settings_CGoogleAdWords
{
	
	/**
	 * Function gets the available Google Adword script from the database
	 * 
	 * 
	 * @return string
	 */	 	
	
 	function googleAddWordsCode()
	{
		$sql = "SELECT set_name,set_value FROM `admin_settings_table` where set_name='Google AdWords code'";
		$query = new Bin_Query();
		if($query->executeQuery($sql))
		{		
			return Display_DGoogleAdWords::googleAddWordsCode($query->records);
		}
		else
		{
			return '<div class="success_msgbox">No Settings Added</div>';
		}
	}
	
	/**
	 * Function updates the changes in the Google Adword code into the database
	 * 
	 * 
	 * @return string
	 */	 	
	
	function updateGoogleAddWordsCode()
	{
		if($_POST['gaddwords']!='')
		{
			$gad="<div id=\"ad\">".$_POST['gaddwords']."</div>";
			$sql = "UPDATE admin_settings_table SET set_value='".stripslashes(mysql_real_escape_string($gad))."' 
			where set_name='Google AdWords code'";
			$query = new Bin_Query();
			if($query->updateQuery($sql))
			{
				return '<div class="success_msgbox">Updated Successfully</div>';
			}
			else
			{
				return '<div class="error_msgbox">Sorry Not Updated </div>';
			}
		}
		else
		{
			return '<div class="error_msgbox">Please Insert a Google adword Script Code</div>';
		}
			
	}
}
?>