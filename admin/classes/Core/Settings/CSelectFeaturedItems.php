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
 * This class contains functions to get the featured items from the database
 *
 * @package  		Core_Settings_CSelectFeaturedItems
 * @category  		Core
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
   * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */

class Core_Settings_CSelectFeaturedItems
{
	
	/**
	 * Stores the output
	 *
	 * @var array $output
	 */	
	var $output = array();	
	
	/**
	 * Function gets the all the categories details from the table 
	 * 
	 * 
	 * @return array
	 */	 	

	function displayCategory()
	{
		//include("classes/Display/DCategorySelection.php");
		$sql = "SELECT * FROM category_table where category_parent_id=0";
		$query = new Bin_Query();
		if($query->executeQuery($sql))
			return $this->data['showcategory'] = Display_DFeaturedItems::listCategory($query->records);
	}
		
	/**
	 * Function is show all featured prdocts from db
	 * 
	 * 
	 * @return array
	 */
	function displayAllFeatured()
	{
		$pagesize=10;
		if(isset($_GET['page']))
		{
		    
			$start = trim($_GET['page']-1) *  $pagesize;
			$end =  $pagesize;
		}
		else 
		{
			$start = 0;
			$end =  $pagesize;
		}
		$total = 0;
			
		$sqlselect = "select * from products_table ";
			
		$query = new Bin_Query();
		if($query->executeQuery($sqlselect))
		{		
			$total = ceil($query->totrows/ $pagesize);
			include_once('classes/Lib/Paging.php');
			$tmp = new Lib_Paging('classic',array('totalpages'=>$total, 'length'=>10),'pagination');
			$this->data['paging'] = $tmp->output;
			$this->data['prev'] =$tmp->prev;
			$this->data['next'] = $tmp->next;
			
			$sql1 = "select * from products_table  ORDER BY product_id ASC LIMIT $start,$end"; 
			$query1 = new Bin_Query();
			if($query1->executeQuery($sql1))
			{
		
				return  Display_DFeaturedItems::productList($query1->records,$this->data['paging'],$this->data['prev'],$this->data['next']);
			}
		}
		else
		{
			return "No records found";
		}

	}
	/**
	 * Function gets the all the sub categorie details from the table for the selected category 
	 * 
	 * 
	 * @return array
	 */	
	
	function displaySubCategory()
	{
		
		
		if($_GET['id']!='')
		{		
			$sql = "SELECT category_id,category_name FROM category_table where category_parent_id=". $_GET['id'] ;
			$query = new Bin_Query();
			if($query->executeQuery($sql))
				return $this->data['showsubcat'] = Display_DFeaturedItems::listSubCategory($query->records);
			else
			{
			return "No Subcategories Found";
			}
		}
		else
		{
			return  Display_DFeaturedItems::listSubCategory('');
		}
		
	}
	
	/**
	 * Function gets all the product details for the selected category id 
	 * 
	 * 
	 * @return string
	 */	
	
	function showProducts()
	{

		if($_GET['id']!='')
		{
			$_SESSION['catid']=$_GET['id'];
			$sql = "SELECT 	* FROM products_table where category_id=".(int)$_GET['id'] ; 
			$query = new Bin_Query();
			if($query->executeQuery($sql))
			{
				$totrows = $query->totrows;
			}
			if($totrows > 0)
				 return  Display_DFeaturedItems::productList($query->records);
			else
				return  Display_DFeaturedItems::productList($query->records);
			// 	return  '<div class="alert alert-error">
			// <button data-dismiss="alert" class="close" type="button">×</button>No Products Found in this Subcategory </div>';
			}	
		else
		{
			return 'Select SubCategory';
		}	

	}
	
	
	/**
	 * Function updates the changes made in the product details into the database
	 * 
	 * 
	 * @return string
	 */	
	
	function updateProducts()
	{
		$subcatid=$_POST['cbosubcateg'];
		$sql = "UPDATE products_table SET is_featured='0' WHERE category_id='".$subcatid."'";
		$query = new Bin_Query();
		$query->updateQuery($sql);
				
		if(isset($_POST['checkbox']))
		
			foreach($_POST['checkbox'] as $val)
			{
				$sql = "UPDATE products_table SET is_featured='1' WHERE product_id='".$val."'";
				$query = new Bin_Query();
				if($query->updateQuery($sql))
				{
					return '<div class="alert alert-success">
					<button data-dismiss="alert" class="close" type="button">×</button> Featured Products Added Successfully</div>';


				}	
				
			}
					
		}
	
}	
?>