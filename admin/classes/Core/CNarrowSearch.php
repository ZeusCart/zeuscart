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
 * This class contains functions to gets search content from the database.
 *
 * @package  		Core_CNarrowSearch
 * @category  		Core
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
   * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */



 class Core_CNarrowSearch
{
	
	/**
	 * Function gets the narrow search content from the database. 
	 * 
	 * 
	 * @return string
	 */	
	
 	 function narrowSearchContent()
	{
	   $sql="select a.title,a.description,a.brand,a.price,d.attrib_name,c.attrib_value from products_table a inner join product_attrib_values_table b on a.product_id=b.product_id inner join attribute_value_table c on b.attrib_value_id=c.attrib_value_id inner join attribute_table d on c.attrib_id=d.attrib_id  where a.category_id=1 and brand like 'sony'";
	    $obj=new Bin_Query();
		$obj->executeQuery($sql);
		return Display_DNarrowSearch::displayNarrowSearch($obj->records); 
	}
	
	/**
	 * Function gets the count of products from the database with their brand details. 
	 * 
	 * 
	 * @return string
	 */	
	
	function dispBrandWithCount()
	{
	  // $catid=$_POST['id'];
//	   $catid=$_GET['id'];
		$catid=2;
	   $sql='Select brand, count(*)as cnt from    products_table where category_id='.$catid.' group by brand having count(*) > 0 ';
	   	
	   $obj=new Bin_Query();
	   $obj->executeQuery($sql);
	   return Display_DNarrowSearch::dispBrandWithCount($obj->records); 
	   
	}
}
?>