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
 * This class contains functions to show and update products in a particular category
 *
 * @package  		Core_Category_CCategorySelection
 * @category  		Core
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
  * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */

class Core_Category_CCategorySelection 
{
	
	/**
	 * Stores the output
	 *
	 * @var array 
	 */		
	var $data = array();
	/**
	 * Stores the error messages
	 *
	 * @var array 
	 */		
	var $errormessages = array();
		
	/**
	 * Function displays all the categories from the table
	 * @param array $Err
	 * 
	 * @return array
	 */
	function displayCategory($Err)
	{
		include("classes/Display/DCategorySelection.php");
		$sql = "SELECT * FROM category_table where category_parent_id=0  order by category_name";
		$query = new Bin_Query();
		if($query->executeQuery($sql))
			$this->data['showcategory'] = Display_DCategorySelection::listCategory($query->records);
		
		if(count($Err->values) >0)
			$this->errormessages = $Err->messages;
		$this->makeConstant($this->data,$prefix='');
	}
	
	/**
	 * Function gets all the sub categories for the selected category
	 * 
	 * 
	 * @return array
	 */
	
	
	function displaySubCategory()
	{
		include("classes/Display/DCategorySelection.php");
		$sql = "SELECT category_id,category_name FROM category_table where category_parent_id=". $_GET['id'] ;
		$query = new Bin_Query();
		if($query->executeQuery($sql))
			echo $this->data['showsubcat'] = Display_DCategorySelection::listSubCategory($query->records);
		else
		{
			echo $this->data['showsubcat'] = "No Subcategories Found";
			
		}
		$this->makeConstant($this->data,$prefix='');
	}
	
	/**
	 * Function gets all the products from the table for the selected category id
	 * 
	 * 
	 * @return array
	 */
	
	
	function showProducts()
	{
		include("classes/Display/DCategorySelection.php");
		
		$sql = "SELECT 	product_id,category_id,title FROM products_table where category_id=" .  $_GET['id'] ;
		$query = new Bin_Query();
		if($query->executeQuery($sql))
			 $this->data['showproduct'] = Display_DCategorySelection::productList($query->records);
		else
		{
			echo $this->data['showproduct'] = "No products Found";
			
		}
		
		$this->makeConstant($this->data,$prefix='');
	}
	
	
	/**
	 * Function updates the cross product table for the newly added cross products
	 * 
	 * 
	 * @return string
	 */
	
	function updateProducts()
	{
		//include("classes/Display/DCategorySelection.php");
				 
		$temparray = array();
		$temparray = $_POST['checkbox'];
		$checkboxvalue = implode(",",$temparray);
		$sql = "insert into cross_products_table (cross_product_idss) values('".$checkboxvalue."')";
		$query = new Bin_Query();
		$query->updateQuery($sql);
		echo "<b>The Follwing Products have been added to cross prouducts:</b><br/>";
		foreach($_POST['checkbox'] as $val)
		{
			$sqltitle = "SELECT * FROM products_table WHERE product_id ='".$val."'";
			$query->executeQuery($sqltitle);
			
			echo "<li>" . $query->records[0]['title']."</li><br />";
		}
	}
	
	/**
	 * Function displays the field values in the array
	 * 
	 * @param string $field
	 * 
	 */
	
	function getFieldValues($field)
	{
		echo $this->data[$field];
	}
	
	/**
	 * Function displays the error messages in the array
	 * 
	 * @param string $field
	 * 
	 */
	
	function getErrorMsg($field)
	{
		echo $this->errormessages[$field];
	}
	
	
	/**
	 * Function generates constants for the fields supplied
	 * @param array $fields
	 * @param string $prefix
	 * @return string
	 */
	
	function makeConstant($fields,$prefix='')
	{
		foreach ($fields as $key=>$item)
			define($prefix.strtoupper($key),$item);
		
	}
}
?>