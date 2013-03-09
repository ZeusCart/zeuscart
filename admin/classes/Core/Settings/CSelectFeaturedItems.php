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
 * CSelectFeaturedItems
 *
 * This class contains functions to get the featured items from the database
 *
 * @package		Core_Settings_CSelectFeaturedItems
 * @category	Core
 * @author		ZeusCart Team
 * @link		http://www.zeuscart.com
 * @version 	2.3
 */

// ------------------------------------------------------------------------

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
				return  '<div class="exc_msgbox">No Products Found in this Subcategory </div>';
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
				$query->updateQuery($sql);
				
			}
				return '<div class="success_msgbox">Featured Products Added Successfully</div>';	
		}
	
}	
?>