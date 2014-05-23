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
 * This class contains functions to generate a category list available in the database.
 *
 * @package  		Core_CCategoryList
 * @category  		Core
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
   * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */



class Core_CCategoryList
{
	/**
	 * Function get the list of categories available in the database 
	 * 
	 * 
	 * @return string
	 */
 	 function showCategory()
	{
	        $sql="select b.category_parent_id as parent ,b.category_id as child,a.category_name as parent_name,b.category_name from category_table a right outer join category_table b on a.category_id = b.category_parent_id ";
	    	$obj = new Bin_Query();
			$obj->executeQuery($sql);				
      		return	Display_DCategoryList::displayCategory($obj->records);
	}
}
?>