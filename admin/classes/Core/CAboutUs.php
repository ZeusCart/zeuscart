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
 * CAboutUs
 *
 * This class contains functions to get and update the about us value from the database.
 *
 * @package		Core_CAboutUs
 * @category	Core
 * @author		ZeusCart Team
 * @link		http://www.zeuscart.com
 * @version 	2.3
 */

// ------------------------------------------------------------------------


 class Core_CAboutUs
 {
 	
	/**
	 * Function gets the about us value from the table 
	 * 
	 * 
	 * @return string
	 */
	
	
	function showAboutUs()
	{
	   $sql = "SELECT set_name,set_value FROM `admin_settings_table` where set_id=15";
		$query = new Bin_Query();
		if($query->executeQuery($sql))
		{		
			return $query->records[0]['set_value'];
		}
				
	}
 	
	/**
	 * Function updates the about us value into the database
	 * 
	 * 
	 * @return string 
	 */
	
	
	function updateAboutUs()
	{
		$sql="update admin_settings_table set set_value='". trim($_POST['aboutus']) . "' where set_id=15";
		$obj=new Bin_Query();
		if($obj->updateQuery($sql))
			return '<div class="success_msgbox" style="width:652px;">AboutUs Content changed Successfully</div>';
		else
			return '<div class="error_msgbox" style="width:652px;">Unable to change AboutUs Content</div>';			

	}
}
?>