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
 * Site map  related  class
 *
 * @package   		Core_CSiteMap
 * @category    	Core
 * @author    		AJ Square Inc Dev Team
 * @link   		http://www.zeuscart.com
  * @copyright 	        Copyright (c) 2008 - 2013, AJ Square, Inc.
 * @version   		Version 4.0
 */
class Core_CSiteMap
{

	/**
	* This function is used to get the  map for category
	*
	* @return HTML data
 	*/
	function showMap()
	{
		include('classes/Display/DSiteMap.php');
		$sql="select category_id,category_name from category_table where category_parent_id=0 and category_status=1";
		$query = new Bin_Query();
		$query->executeQuery($sql);
		return  Display_DSiteMap::showMap($query->records);
	}
}
?>
