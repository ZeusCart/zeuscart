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
 * This class contains functions to add,edit and delete subcategories from the database
 *
 * @package  		Core_Settings_CAddSubCategory
 * @subpackage 		Lib_DbConnect
 * @category  		Core
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
   * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */

class Core_Settings_CAddSubCategory extends Lib_DbConnect
{
	
	
	/**
	 * Function displays all the categories from the table
	 * @param $Err comatcins both error messages and error values
	 * 
	 * @return string
	 */	 	
	
	function showSubCategory($Err)
    {
        include("classes/Display/DCategorySelection.php");
		$sql = "select a.category_name as Category,b.category_name as SubCategory,b.category_id,b.category_image as image from category_table a inner join category_table b on a.category_id=b.category_parent_id";
		$query = new Lib_Query();
		if($query->executeQuery($sql))
		{		
		$this->data['showsubcategory'] = Display_DCategorySelection::showSubCategory($query->records);
		}
		else
		{
		$this->data['showsubcategory'] = "No Category Found";
		}
		$this->makeconstant($this->data);
		
    }
	
	
	/**
	 * Function adds a new sub category into the table
	 * 
	 * 
	 * @return string
	 */	 	
	
	function addSubCategory()
	{

	if($_FILES['caticon']['type'] == 'image/jpeg' || $_FILES['caticon']['type'] == 'image/bmp' || $_FILES['caticon']['type'] == 'image/gif' || $_FILES['caticon']['type'] == 'image/png')	
		{
		$uploadfile = "images/caticons/".date("His").$_FILES['caticon']['name'];
		move_uploaded_file($_FILES['caticon']['tmp_name'],$uploadfile);
		$sql = "SELECT * FROM Category_table WHERE category_name ='".$_POST['subcategory']."'";
		$query = new Lib_Query();
		if($query->executeQuery($sql))
		{
			$_SESSION['msg']= "Already this Category is Added";
		}
		else
		{
	
		 $sql = "INSERT INTO Category_table (category_name,category_parent_id,category_image,category_desc,category_status) VALUES ('".trim($_POST['subcategory'])."','".$_POST['id']."','".$uploadfile."','".trim($_POST['subcategorydesc'])."','".$_POST['group1']."')";
			
			$query = new Lib_Query();
			if($query->updateQuery($sql))
	
			$_SESSION['msg']= "Added Successfully";
	
		}
		}
		else
			$_SESSION['msg']= "Only Images can be Uploaded";
	}
	
	/**
	 * Function displays all the subcategories for the selected category id 
	 * 
	 * 
	 * @return string
	 */	 	
	
	
	function displaySubCategory()
    {
        include("classes/Display/DCategorySelection.php");
		
		$sql = "SELECT * FROM category_table where category_id=".(int)$_GET['id'];
		
		$query = new Lib_Query();
		if($query->executeQuery($sql))
		{		
			$this->data['dispcategory'] = Display_DCategorySelection::displaySubCategory($query->records);
		}
		else
		{
			$this->data['dispcategory'] = "No Category Found";
		}
		$this->makeconstant($this->data);
		
    }
	
	/**
	 * Function updates the changes made in the subcategories into the database
	 * 
	 * 
	 * @return string
	 */	 	
	
	
	function editSubCategory()
	{
	
	include("classes/Display/DCategorySelection.php");
	if($_FILES['caticon']['type'] == 'image/jpeg' || $_FILES['caticon']['type'] == 'image/bmp' || $_FILES['caticon']['type'] == 'image/gif' || $_FILES['caticon']['type'] == 'image/png')	
		{
		$uploadfile = "images/caticons/".date("His").$_FILES['caticon']['name'];
		move_uploaded_file($_FILES['caticon']['tmp_name'],$uploadfile);
			 $sql = "UPDATE category_table SET category_name = '".$_POST['category']."',
category_image = '".$uploadfile."',
category_desc = '".$_POST['categorydesc']."',
category_status = '".$_POST['group1']."' WHERE category_id =".(int)$_GET['id'];
			
			$query = new Lib_Query();
			if($query->updateQuery($sql))
			//echo "called";
			$_SESSION['msg']= "Edited Successfully";
		}
	}
	
	
	/**
	 * Function deletes a subcategory from the database
	 * 
	 * 
	 * @return string
	 */	 	
	
	
	function deleteSubCategory()
	{

	$sql = "DELETE FROM category_table WHERE category_id=".(int)$_GET['id'];
			
			$query = new Lib_Query();
			if($query->updateQuery($sql))
		
			//$_SESSION['msg']= "deleted Successfully";
	}
	
	
	/**
	 * Function generates the constants for the supplied array
	 * 
	 * 
	 * @param array $fields
	 * @param string $prefix
	 * 
	 * @return string
	 */	
	
	function makeConstant($fields,$prefix='')
	{
		foreach ($fields as $key=>$item)
			define($prefix.strtoupper($key),$item);
		
	} 
	
	/**
	 * Function gets the field values for the supplied string
	 * 
	 * 
	 * @param string $field
	 * 
	 * 
	 * @return string
	 */ 
	 
	function getFieldValues($field)
	{		
		echo $this->data[$field];					
	}
	
	/**
	 * Function gets the error messages for the supplied string
	 * 
	 * 
	 * @param string $field
	 * 
	 * 
	 * @return string
	 */ 
	
	function getErrorValues($field)
	{
		echo $this->errormessages[$field];	
	}    

}
?>