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
 * This class contains functions to add, edit and delete categories from the database
 *
 * @package  		Core_Settings_CAddMainCategory
 * @category  		Core
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
   * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */

class Core_Settings_CAddMainCategory
{
	/**
	 * Function displays all the categories from the table
	 * @param $Err comatcins both error messages and error values
	 * 
	 * @return string
	 */	 	
		
	function showMainCategory($Err)
    	{
        include("classes/Display/DCategorySelection.php");
		$sql = "SELECT * FROM category_table where category_parent_id=0";
		$query = new Bin_Query();
		if($query->executeQuery($sql))
		{		
		$this->data['showcategory'] = Display_DCategorySelection::showCategory($query->records);
		}
		else
		{
		$this->data['showcategory'] = "No Category Found";
		}
		$this->makeconstant($this->data,$prefix='');
		
    }
	
	
	/**
	 * Function adds a new main category into the table 
	 * 
	 * 
	 * @return string
	 */	 	
	
	
	function addMainCategory()
	{
 		$sql = "SELECT * FROM Category_table WHERE category_name ='".$_POST['category']."'";
		$query = new Bin_Query();
		if($query->executeQuery($sql))
			$_SESSION['msg']= "Already this Category is Added";
		else
		{
 
		$sql = "INSERT INTO Category_table (category_name,category_parent_id,category_image,category_desc,category_status) VALUES ('".trim($_POST['category'])."',0,'".$uploadfile."','".trim($_POST['categorydesc'])."','".$_POST['group1']."')";
			
			$query = new Bin_Query();
			if($query->updateQuery($sql))
		}
	}
	
	
	/**
	 * Function displays the selected main category from the table for updation 
	 * 
	 * 
	 * @return string
	 */	 	
	
	
	function displayMainCategory()
    {
        include("classes/Display/DCategorySelection.php");
		
		$sql = "SELECT * FROM category_table where category_parent_id=0 and category_id=".(int)$_GET['id'];
		
		$query = new Bin_Query();
		if($query->executeQuery($sql))
		{		
			$this->data['dispcategory'] = Display_DCategorySelection::displayMainCategory($query->records);
		}
		else
		{
			$this->data['dispcategory'] = "No Category Found";
		}
		$this->makeconstant($this->data,$prefix='');
		
    }
	
	
	/**
	 * Function updates the changes made in the main category into the table
	 * 
	 * 
	 * @return string
	 */	 	
	
	
	function editMainCategory()
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
						
			$query = new Bin_Query();
			if($query->updateQuery($sql))
			//echo "called";
			$_SESSION['msg']= "Edited Successfully";
		}
	}
	
	
	/**
	 * Function deletes the main category from the table 
	 * 
	 * 
	 * @return string
	 */	 	
	
	
	function deleteMainCategory()
	{
			
			$sql = "DELETE FROM category_table WHERE category_id=".(int)$_GET['id'];
			
			$query = new Bin_Query();
			if($query->updateQuery($sql))
			//echo "called";
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