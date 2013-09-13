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
 * This class contains functions to get and update the custom header details in the table.
 *
 * @package  		Core_CCustomHeader
 * @category  		Core
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
   * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */


 class Core_CCustomHeader
 {
 	/**
	 * Function gets the custom header details from the table
	 * 
	 * 
	 * @return string
	 */	
	function showCustomHeader()
	{
	   $sql = "SELECT set_name,set_value FROM `admin_settings_table` where set_name='Custom Header'";
		$query = new Bin_Query();
		if($query->executeQuery($sql))
		{		
			return $query->records[0]['set_value'];
		}
				
	}
 	
	
	/**
	 * Function updates the custom header details into the table
	 * 
	 * 
	 * @return string
	 */	
	
	function updateCustomHeader()
	{


		$sql="update admin_settings_table set set_value='". trim($_POST['headerContent']) . "' where set_name='Custom Header'";
		$obj=new Bin_Query();
		if($obj->updateQuery($sql))
			return '<div class="alert alert-success">
    <button type="button" class="close" data-dismiss="alert">×</button> <strong> well done !</strong> Custom Header changed Successfully</div>';
		else
			return '<div class="alert alert-error">
    <button type="button" class="close" data-dismiss="alert">×</button> Unable to change Custom Header</div>';			

	}
}
?>