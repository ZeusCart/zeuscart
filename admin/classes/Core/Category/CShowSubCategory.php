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
 * This class contains functions to gets and update the admin activity report.
 *
 * @package  		Core_Category_CShowSubCategory
 * @category  		Core
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
   * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */


class Core_Category_CShowSubCategory
{
	
	/**
	 * Function gets the categories from the database 
	 * 
	 * 
	 * @return string
	 */
	function showSubCategory()
	{
     	
		$sql= "SELECT a.category_name AS Category, b.category_name AS SubCategory, b.category_id,b.sub_category_parent_id ,b.category_parent_id, b.category_image AS image,b.category_desc,b.category_status FROM category_table a
		INNER JOIN category_table b ON a.category_id = b.category_parent_id AND b.sub_category_parent_id=0
		WHERE a.category_id =".(int)$_GET['id']; 
		//$sql.="ORDER BY a.category_name ASC";
		
		$query = new Bin_Query();
		
		if($query->executeQuery($sql))
		{		
			return  Display_DShowSubCategory::showCategory($query->records,1);
		}
		else
		{
			return '<div class="exc_msgbox">Sub Categories Not Found</div>';
		}
		
	}

	/**
	 * Function gets the  categories from the database for sub under sub category
	 * 
	 * 
	 * @return string
	 */
	function showSubUnderSubCategory()
	{
		 $sql= "SELECT a.category_name AS Category, b.category_name AS SubCategory, b.category_id,b.sub_category_parent_id , b.category_image,b.category_parent_id AS image,b.category_desc,b.category_status FROM category_table a
		INNER JOIN category_table b ON a.category_id = b.category_parent_id 
		WHERE b.sub_category_parent_id =".(int)$_GET['id'];
		//$sql.="ORDER BY a.category_name ASC";
		
		$query = new Bin_Query();
		
		if($query->executeQuery($sql))
		{		
			return  Display_DShowSubCategory::showCategory($query->records,3);
		}
		else
		{
			return '<div class="exc_msgbox">Sub Under Sub Categories Not Found</div>';
		}
	}
	/**
	 * Function returns an err message 
	 * 
	 * 
	 * @return string
	 */
	
	function msg()
	{
		return '<div class="exc_msgbox">Please Select an Category </div>';
	}
	
	
	/**
	 * Function gets the categories from the database
	 * 
	 * 
	 * @return string
	 */
	
	
	function showMainCategory()
	{
       		$sql = "SELECT * FROM category_table where category_parent_id=0 order by category_name asc";
	
		$query = new Bin_Query();
	
		if($query->executeQuery($sql))
		{		
			return  Display_DShowSubCategory::showMainCategory($query->records);
		}
		else
		{
			return '<div class="error_msgbox">No Category Found</div>';
		}
		
	}
	
	/**
	 * Function shows the subcategories available for the selected category.
	 * 
	 * 
	 * @return string
	 */
	
	function displaySubCategory()
	{
        
		$sql = "SELECT category_content_id FROM category_table where category_id=".(int)$_GET['id'];
	
		$query = new Bin_Query();
		$query->executeQuery($sql);
	
		$flag=$query->records[0]['category_content_id'];
	
		if($flag==0)
		{
			$sql = "SELECT * FROM category_table where category_id=".(int)$_GET['id'];
			
			$query = new Bin_Query();
	
			if($query->executeQuery($sql))
			{		
				return Display_DShowSubCategory::displaySubCategory($query->records);
			}
			else
			{
				return "No Sub Category Found";
			}
		
		}
		else
		{
			$sql = "SELECT * FROM category_table cat 
			INNER JOIN html_contents_table ht ON cat.category_content_id = ht.html_content_id
			WHERE cat.category_id =".(int)$_GET['id'];
		
			$query = new Bin_Query();
	
			if($query->executeQuery($sql))
			{	
				return Display_DShowSubCategory::displaySubCategory($query->records);
			}
			else
			{
				return "No Sub Category Found";
			}
		}
	}

	/**
	 * Function shows the sub undercategories available for the selected sub category.
	 * 
	 * 
	 * @return string
	 */
	function displaySubUnderSubCategory()
	{
		
		$sql = "SELECT category_content_id FROM category_table where category_id=".(int)$_GET['id'];
	
		$query = new Bin_Query();
		$query->executeQuery($sql);
	
		$flag=$query->records[0]['category_content_id'];
	
		if($flag==0)
		{
			$sql = "SELECT * FROM category_table where category_id=".(int)$_GET['id'];
			
			$query = new Bin_Query();
	
			if($query->executeQuery($sql))
			{		
				return Display_DShowSubCategory::displaySubUnderSubCategory($query->records);
			}
			else
			{
				return "No Sub Category Found";
			}
		
		}
		else
		{
			$sql = "SELECT * FROM category_table cat 
			INNER JOIN html_contents_table ht ON cat.category_content_id = ht.html_content_id
			WHERE cat.category_id =".(int)$_GET['id'];
		
			$query = new Bin_Query();
	
			if($query->executeQuery($sql))
			{	
				return Display_DShowSubCategory::displaySubUnderSubCategory($query->records);
			}
			else
			{
				return "No Sub Category Found";
			}
		}
	}	
	
	/**
	 * Function updates the sub category details into the database
	 * 
	 * 
	 * @return string
	 */
	function editSubCategory()
	{
		include("classes/Lib/ThumbImage.php");
				
		$imagetypes=array ('image/jpeg' ,'image/pjpeg' , 'image/bmp' , 'image/gif' , 'image/png', 'image/x-png');

		$sql = "UPDATE category_table SET ";

		if($_FILES['caticon']['name'] != "")
		{
			if(in_array($_FILES['caticon']['type'],$imagetypes)) // check for image file types for the uploaded file
			{
				$fname=date("Y-m-d-His").$_FILES['caticon']['name']; // generate new file name
				$caticonpath="uploadedimages/caticons/".$fname; // concat the new file with image folder and thumb image folder for database 
				$uploadfile = ROOT_FOLDER . $caticonpath; // actual image upload path
				$imageDir=ROOT_FOLDER."uploadedimages/caticons"; // to upload the file
								
				if(move_uploaded_file($_FILES['caticon']['tmp_name'],$uploadfile))
				{	
					new Lib_ThumbImage('thumb',$uploadfile,$imageDir,THUMB_WIDTH);
					$sql .= " category_image = '".$caticonpath."', ";					
				}
				else
					return '<div class="error_msgbox">Sorry Image Not Uploaded</div>';	
			}
			else
				return '<div class="error_msgbox">Invalid image file format</div>';
		}
		
		if($_POST['contentid']!=0)
		{
			$sql.="category_content_id='".$_POST['contentid']."',";
		}
		$sql.= "category_name = '".$_POST['category']."',
		category_desc = '".$_POST['categorydesc']."',
		category_status = '".$_POST['status']."' WHERE category_id =".(int)$_GET['subid'];
			
			$query = new Bin_Query();
			if($query->updateQuery($sql))
			
			$sql = "DELETE FROM category_attrib_table WHERE subcategory_id=".(int)$_GET['subid'];
			$query = new Bin_Query();
			$query->updateQuery($sql);
			
			$temparray = array();
			$temparray = $_POST['attributes'];
			for($i=0;$i<count($temparray);$i++)
			{
				$sql = "INSERT INTO category_attrib_table (subcategory_id,attrib_id)
				values('".(int)$_GET['subid']."','".$temparray[$i]."') ";
				$query->updateQuery($sql);
			}
			
			return '<div class="success_msgbox">Category <b> '.$_POST['category'].'</b> Updated Successfully</div>';
		
	}
	/**
	 * Function updates the sub under category details into the database
	 * 
	 * 
	 * @return string
	 */
	function editSubUnderSubCategory()
	{

		include("classes/Lib/ThumbImage.php");
				
		$imagetypes=array ('image/jpeg' ,'image/pjpeg' , 'image/bmp' , 'image/gif' , 'image/png', 'image/x-png');

		$sql = "UPDATE category_table SET ";

		if($_FILES['caticon']['name'] != "")
		{
			if(in_array($_FILES['caticon']['type'],$imagetypes)) // check for image file types for the uploaded file
			{
				$fname=date("Y-m-d-His").$_FILES['caticon']['name']; // generate new file name
				$caticonpath="uploadedimages/caticons/".$fname; // concat the new file with image folder and thumb image folder for database 
				$uploadfile = ROOT_FOLDER . $caticonpath; // actual image upload path
				$imageDir=ROOT_FOLDER."uploadedimages/caticons"; // to upload the file
								
				if(move_uploaded_file($_FILES['caticon']['tmp_name'],$uploadfile))
				{	
					new Lib_ThumbImage('thumb',$uploadfile,$imageDir,THUMB_WIDTH);
					$sql .= " category_image = '".$caticonpath."', ";					
				}
				else
					return '<div class="error_msgbox">Sorry Image Not Uploaded</div>';	
			}
			else
				return '<div class="error_msgbox">Invalid image file format</div>';
		}
		
		if($_POST['contentid']!=0)
		{
			$sql.="category_content_id='".$_POST['contentid']."',";
		}
		$sql.= "category_name = '".$_POST['category']."',
		category_desc = '".$_POST['categorydesc']."',
		category_status = '".$_POST['status']."' WHERE category_id =".(int)$_GET['subid']; 
			
			$query = new Bin_Query();
			if($query->updateQuery($sql))
			
			$sql = "DELETE FROM category_attrib_table WHERE subcategory_id=".(int)$_GET['subid'];
			$query = new Bin_Query();
			$query->updateQuery($sql);
			
			$temparray = array();
			$temparray = $_POST['attributes'];
			for($i=0;$i<count($temparray);$i++)
			{
				$sql = "INSERT INTO category_attrib_table (subcategory_id,attrib_id)
				values('".(int)$_GET['subid']."','".$temparray[$i]."') ";
				$query->updateQuery($sql);
			}
			
			return '<div class="success_msgbox">Category <b> '.$_POST['category'].'</b> Updated Successfully</div>';


	}
	
	/**
	 * Function deletes an sub category from the database
	 * 
	 * 
	 * @return string
	 */
	
	function deleteSubCategory()
	{
		$sql = "DELETE FROM category_table WHERE category_id=".(int)$_GET['id'];
		$query = new Bin_Query();
		if($query->updateQuery($sql))
			return '<div class="success_msgbox">Sub Category Deleted Successfully<div>';
	}
	
	/**
	 * Function display the search subcategory
	 *	
	 * @return string
	 */
	function searchSubCategory()
	{
		include_once("classes/Display/DShowMainCategory.php");
		
		$catname = $_POST['catname'];
		$catdesc = $_POST['catdesc'];
		$status =  $_POST['status'];
		$id	=  $_POST['main_cat'];
		
		$sql='SELECT a.category_name AS Category, b.category_name AS SubCategory, b.category_id, b.category_image AS image,b.category_desc,b.category_status FROM category_table a
INNER JOIN category_table b ON a.category_id = b.category_parent_id ';
		
		$condition=array();
			
			if($catname!='')
			{
				$condition []= "  b.category_name like '%".$catname."%'";
			}
			if($catdesc!='')
			{
				$condition[]= " b.category_desc like  '%".$catdesc."%'";
			}
			
			if($status!='')
			{
				$condition []= " b.category_status = '".$status."'";
			}
			if($id)
			{
				$condition []= " b.category_parent_id = '".$id."'";
			}
			
			
			if(count($condition)>1)
				$sql.= ' where '. implode(' and ', $condition) ;
			elseif(count($condition)>0)
				 $sql.= ' where '. implode('', $condition) ;
		
			if($_POST['search']=='Search')
			{
				$obj = new Bin_Query();
				if($obj->executeQuery($sql))
					$output =  Display_DShowSubCategory::showCategory($obj->records,'1');
				else
				{ 
					$output =  Display_DShowSubCategory::showCategory($obj->records,'0');
				}
				return $output;
			}
			else
			{
					
				$this->showSubCategory();
				//Core_CShowMainCategory::showMainCategory($sql);
			}
		
   }
	

}
?>
