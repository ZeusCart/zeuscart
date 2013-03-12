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
 * This class contains functions to gets and update the copyright detials.
 *
 * @package  		Core_CCopyrights
 * @category  		Core
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
   * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */


 class Core_CCopyrights
{
 	/**
	 * Function gets the copyrights details from the table 
	 * 
	 * 
	 * @return string
	 */	
	function displayCopyrights()
	{
		$sql="SELECT set_name,set_value FROM `admin_settings_table` where set_name='Copy Rights'";
		$query = new Bin_Query();
		if($query->executeQuery($sql))
		{
			return $query->records[0]['set_value'];
		}
		
	}
	
	/**
	 * Function updates the copyrights details into the table 
	 * 
	 * 
	 * @return string
	 */	
	
	function updateCopyrights()
	{
		
		$sql = "UPDATE admin_settings_table SET set_value='".$_POST['copyrights']."' Where set_name='Copy Rights'" ;
		$query = new Bin_Query();
		if($query->updateQuery($sql))
		{
			return '<div class="success_msgbox">Copy right Information Updated Successfully</div>';
		}
		else
		{
				return '<div class="error_msgbox">Copyright  Not Updated </div>';
		}
	}
}
?>