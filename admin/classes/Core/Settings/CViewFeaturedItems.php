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
 * This class contains functions to get the list of featured products from the database 
 *
 * @package  		Core_Settings_CViewFeaturedItems
 * @category  		Core
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
   * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */



class Core_Settings_CViewFeaturedItems
{
	/**
	 * Stores the output
	 *
	 * @var array $output
	 */	
	var $output = array();	
	
	/**
	 * Function gets the list of products that are featured from the database 
	 * 
	 * 
	 * @return string
	 */	 	
	
	
	function viewProducts()
	{
		$sql = "SELECT 	* FROM products_table where is_featured=1 ORDER BY  title ASC " ;
		$query = new Bin_Query();
			if($query->executeQuery($sql))
			{
				$totrows = $query->totrows;
			}
			if($totrows > 0)
				 return  Display_DViewFeaturedItems::productList($query->records);
			else
				return  '<div class="exc_msgbox">No Featured Products Found </div>';
	}
	
	/**
	 * Function updates the changes made in the featured products 
	 * 
	 * 
	 * @return string
	 */	 	
	
	
	
	function updateProducts()
	{
		for($i=0;$i<count($_POST['productid']);$i++)
		{
			if(!in_array($_POST['productid'][$i],$_POST['checkbox']))
				$arr[]=$_POST['productid'][$i];
		}
			
		if(isset($_POST['checkbox']))
		{
			foreach($arr as $val)
			{
				$sql = "UPDATE products_table SET is_featured='0' WHERE product_id='".$val."'";
				$query = new Bin_Query();
				$query->updateQuery($sql);
				
			}
				return '<div class="success_msgbox">Featured Products Updated Successfully</div>';	
		}
	}
	
}	

?>