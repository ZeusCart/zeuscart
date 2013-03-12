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
 * @package  		Core_Settings_CAddCrossProducts
 * @category  		Core
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
   * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */

class Core_Settings_CAddCrossProducts
{
	
	
	/**
	 * Stores the output
	 *
	 * @var array $output
	 */		
    var $output = array();	
	
	
	/**
	 * Function displays all the categories from the table
	 * 
	 * 
	 * @return string
	 */	 	
	function displayCategory()
	{
		
		$sql = "SELECT * FROM category_table where category_parent_id=0";
		$query = new Bin_Query();
		if($query->executeQuery($sql))
		$this->displaySubCategory();
			return  Display_DAddCrossProducts::listCategory($query->records);
	}
	
	/**
	 * Function displays all the sub categories from the table
	 * 
	 * 
	 * @return string
	 */	 	
	
	function displaySubCategory()
	{
		
		if($_GET['id']!='')
		{		
			$sql = "SELECT category_id,category_name FROM category_table where category_parent_id=". $_GET['id'] ;
			$query = new Bin_Query();
			if($query->executeQuery($sql))
				return  Display_DAddCrossProducts::listSubCategory($query->records);
			else
			{
			return "No Subcategories Found";
			}
		}
		else
		{
			return  Display_DAddCrossProducts::listSubCategory('');
		}
	}
	
	/**
	 * Function displays all the product title for the selected product id
	 * 
	 * 
	 * @return string
	 */	 
	
	function dispProductTitle()
	{
		$prodid=$_SESSION['prodid']; 
		$sqltitle = "SELECT title FROM products_table WHERE product_id ='".$prodid."'";
		$query = new Bin_Query();
		if($query->executeQuery($sqltitle))
		{
			return Display_DAddCrossProducts::dispProductTitle($query->records);
		}
		
	}
	
	/**
	 * Function displays all the products from the product table
	 * 
	 * 
	 * @return string
	 */	 
	
	function showProducts()
	{
		if($_GET['id']!='')
		{
		$sql = "SELECT 	* FROM products_table where category_id=".(int)$_GET['id'] ;
		$query = new Bin_Query();
			if($query->executeQuery($sql))
			{
				$totrows = $query->totrows;
			}
			if($totrows > 0)
				 return  Display_DAddCrossProducts::productList($query->records);
			else
				//return  Display_DAddCrossProducts::displayNoProductFound();
				return  '<div class="exc_msgbox">No Products Found</div>';
			}	
		else
		{
			echo 'Select SubCategory';
		}	
	}
	
	
	/**
	 * Function adds a new cross product into the table
	 * 
	 * 
	 * @return string
	 */	 
	
	function updateProducts()
	{
		$temparray = array();
		$prodid=$_SESSION['prodid']; 
		$temparray = $_POST['checkbox'];
		$checkboxvalue = implode(",",$temparray);
	
		$sql= "SELECT * FROM cross_products_table WHERE product_id ='".$prodid."'";
		$query = new Bin_Query();
		$query->executeQuery($sql);
		$flag=$query->totrows;
				
		if($flag=='')
		{	
			$sql = "insert into cross_products_table (product_id,cross_product_ids) values('".$prodid."','".$checkboxvalue."')";
			$query = new Bin_Query();
			if($query->updateQuery($sql))
			{
				
				return '<b>Cross Products added Successfully</b>';
			}
			else
			{
				return "<b>Make Sure of products</b>";
			}
		}
		else
		{
			$sql= "SELECT cross_product_ids FROM cross_products_table WHERE product_id ='".$prodid."'";
			$query = new Bin_Query();
			$query->executeQuery($sql);
			$prevprod=$query->records;
			
			
			$temparray = $_POST['checkbox'];
			//$checkboxvalue =array();
			$checkboxvalue = implode(",",$temparray);
		
			$newprodid['newprodid']=$checkboxvalue;
			
			$sample1 = array_values($prevprod[0]);
			$sample2 = $newprodid['newprodid'];	
		
			$sample1 = explode(",",$sample1[0]);
			$sample2 = explode(",",$sample2);
			
			if(count($sample1)>0 && count($sample2)>0)
				$sample3 = array_merge($sample2,$sample1);
				$sample3 = array_unique($sample3);
	
			$mergeprod=implode(",",$sample3);
		
							
			$sql = "UPDATE cross_products_table SET cross_product_ids='".$mergeprod."' WHERE product_id='".$prodid."'";
			$query = new Bin_Query();
			if($query->updateQuery($sql))
			{
				
				return '<div class="success_msgbox">Cross Products added Successfully</div> ';
			}
			else
			{
				return "<b>Make Sure u r of products</b>";
			}
		}		
	}
	
}	
?>