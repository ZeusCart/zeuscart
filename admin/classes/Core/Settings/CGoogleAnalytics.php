<?php 
/**
* GNU General Public License.

* This file is part of ZeusCart V2.3.

* ZeusCart V2.3 is free software: you can redistribute it and/or modify
* it under the terms of the GNU General Public License as published by
* the Free Software Foundation, either version 3 of the License, or
* (at your option) any later version.
* 
* ZeusCart V2.3 is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
* GNU General Public License for more details.
* 
* You should have received a copy of the GNU General Public License
* along with Foobar. If not, see <http://www.gnu.org/licenses/>.
*
*/

/**
 * CGoogleAnalytics
 *
 * This class contains functions to gets and updates the Google Analytics code from the database
 *
 * @package		Core_Settings_CGoogleAnalytics
 * @category	Core
 * @author		ZeusCart Team
 * @link		http://www.zeuscart.com
 * @version 	2.3
 */

// ------------------------------------------------------------------------



class Core_Settings_CGoogleAnalytics
{
 	
	/**
	 * Function selects the Google Analytics code from the database
	 * 
	 * 
	 * @return string
	 */	 		
 
 	function googleAnalyticsCode()
	{
		$sql = "SELECT set_name,set_value FROM `admin_settings_table` where set_name='Google Analytics Code'";
		$query = new Bin_Query();
		
		if($query->executeQuery($sql))
		{		
			return Display_DGoogleAnalytics::googleAnalyticsCode($query->records);
		}
		else
		{
			return '<div class="success_msgbox" style="width:644px;">Site</div>';
		}
	}
	
	
	
	/**
	 * Function updates the selected Google Analytics code into the table 
	 * 
	 * 
	 * @return string
	 */	 	
	
	
	
	function updateGoogleAnalytics()
	{
		if($_POST['gcode']!='')
		{
		$sql = "UPDATE admin_settings_table SET set_value='".$_POST['gcode']."' where set_name='Google Analytics Code'";
			$query = new Bin_Query();
			if($query->updateQuery($sql))
			{		
				return '<div class="success_msgbox" style="width:644px;">Updated Successfully</div>';
			}
			else
			{
				return '<div class="error_msgbox" style="width:644px;">Not Updated !!! Try Again </div>';
			}
		}
		else
		{
			return '<div class="error_msgbox" style="width:644px;">Please Insert a Google Analytics Script Code</div>';
		}	
	}
}
?>