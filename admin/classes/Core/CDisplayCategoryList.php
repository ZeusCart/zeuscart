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
 * CDisplayCategoryList
 *
 * This class contains functions to get adn display the categories available.
 *
 * @package		Core_CDisplayCategoryList
 * @category	Core
 * @author		ZeusCart Team
 * @link		http://www.zeuscart.com
 * @version 	2.3
 */

// ------------------------------------------------------------------------



 class Core_CDisplayCategoryList
{
	 
	 /**
	 * Function gets the contents from the html contents table.
	 * 
	 * 
	 * @return string
	 */	
	
 	 function dispCategory()
	{
	    $id=4;
		$sql="select * from html_contents_table where html_content_name='Category Content'";
		$obj=new Bin_Query();
		$obj->executeQuery($sql);
		return Display_DDisplayCategoryList::dispCategory($obj->records);	
	    
	}
}
?>