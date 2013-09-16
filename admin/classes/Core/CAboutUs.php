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
 * This class contains functions to get and update the about us value from the database.
 *
 * @package  		Core_CAboutUs
 * @category  		Core
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
   * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */



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
		$sql = "SELECT *  FROM aboutus_table ";
		$query = new Bin_Query();
		if($query->executeQuery($sql))
		{		
			return $query->records[0];
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
		
		$sql="update aboutus_table set content='". trim($_POST['aboutus']) . "' where id=1";
		$obj=new Bin_Query();
		if($obj->updateQuery($sql))
			return '<div class="alert alert-success">
		<button type="button" class="close" data-dismiss="alert">×</button>
		<strong>Well done!</strong> AboutUs Content changed Successfully</div>';
		else
			return '<div class="alert alert-error">
		<button type="button" class="close" data-dismiss="alert">×</button> Unable to change AboutUs Content</div>';			

	}
}
?>