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
 * CCategoryManagement
 *
 * This class contains functions to show the HTML Content Preview 
 *
 * @package		Core_Settings_CCategoryManagement
 * @category	Core
 * @author		ZeusCart Team
 * @link		http://www.zeuscart.com
 * @version 	2.3
 */

// ------------------------------------------------------------------------

class Core_Settings_CCategoryManagement
{
	
	/**
	 * Function generates a combo box using the lib components for the html content
	 * 
	 * 
	 * @return array
	 */	 		
	function showContent()
	{
		
		$components = new Lib_Components();
		
		return $this->data['allattrib'] = $components->createComponent('combobox',$this->getListValues('htmlcontent'),'name="contentid" class="txt_box200" id="allcont" onchange="callContent(this.value);"');
	}
	/**
	 * Function generates an drop down list with the category details.in sub child
	 * 
	 * 
	 * @return array
	 */
	function showSubChildParent()
	{
	

		$components = new Lib_Components();
		
		return $this->data['subcatparent'] = $components->createComponent('combobox',$this->getListValues('category'),'name="category" class="txt_box200" id="category" onchange="callsubChild(this.value);"');
		$this->makeConstants($this->data);

	}


	/**
	 * Function get sub category  from db.
	 * 
	 * 
	 * @return array
	 */
	function selectSubChild()
	{

		$sql = "SELECT * FROM category_table where category_parent_id='".$_GET['parentid']."' AND  sub_category_parent_id='0'order by category_name"; 
		$cquery = new Bin_Query();
		$cquery->executeQuery($sql);
		$records=$cquery->records;
		
		if(count($records)>0)
		{
			$output='<select id="subcategory" class="txt_box200" name="subcategory" ><option>select Sub Child</option>';
			for($i=0;$i<count($records);$i++)
			{
	
				$output.='<option value="'.$records[$i]['category_id'].'"> '.$records[$i]['category_name'].'</option>';
			}
			$output.='</select>';
		}
		
	
		return $output;
		
	}
	/**
	 * Function gets the values from the HTML Contents table  
	 * 
	 * 
	 * @return array
	 */	 	
	
	function getListValues($name)
	{
		if($name == 'htmlcontent')
		{
			$sql = "SELECT * FROM  html_contents_table ";
			$query = new Bin_Query();
			if($query->executeQuery($sql))
				$records = $query->records;
			$content= array("0"=>"Select Contents");
			for ($i=0;$i<count($records);$i++)
				$content[$records[$i]['html_content_id']] = $records[$i]['html_content_name'];
			
			return $content;
			
		}

		if($name == 'category')
		{
			 $sql = "SELECT * FROM category_table where category_parent_id=0 order by category_name";
			$cquery = new Bin_Query();
			if($cquery->executeQuery($sql))
				$records = $cquery->records;
			$category = array("category"=>"All Categories");
			for ($i=0;$i<count($records);$i++)
				$category[$records[$i]['category_id']] = $records[$i]['category_name'];
			return $category;
			
		}
		
		
	}
	
	
	/**
	 * Function gets the attributes from the attribute table for the selected sub category id 
	 * 
	 * 
	 * @return array
	 */	 	
	
	function getAttributes()
	{

		$sql = "SELECT attrib_id FROM  `category_attrib_table` WHERE  `subcategory_id` =".mysql_escape_string(intval($_GET['id']));
		$obj = new Bin_Query();
		
		if($obj->executeQuery($sql))
			$array=$obj->records;
		if(!empty($array))
		{
			for($i=0;$i<count($array);$i++)
				$arr[]= $array[$i]['attrib_id'];
		}
		else
		{
			$arr[]="0";
		}
		
		
		$sql = "SELECT * FROM `attribute_table` order by attrib_name asc ";
		$cquery = new Bin_Query();
		if($cquery->executeQuery($sql))
		return Display_DCategoryManagement::showAttributes($cquery->records,$arr);
		
	}
	
	/**
	 * Function adds a category and sub category into the database 
	 * 
	 * 
	 * @return string
	 */	 	
	
	
	
	function addCategory()
	{



		$imagetypes=array ('image/jpeg' ,'image/pjpeg' , 'image/bmp' , 'image/gif' , 'image/png','image/x-png');
		$query = new Bin_Query();
		
		include("classes/Lib/ThumbImage.php");		
		
		 $filetypename= $_FILES['caticon']['type'];
		 $file = explode("/",$_FILES['caticon']['type']);		
			
		  if(count($file) > 2  || !in_array($_FILES['caticon']['type'],$imagetypes))
		  {			
  			return '<div class="error_msgbox">Invalid image file format</div>';	
		  }	 	
		if($_POST['category']=='' || !isset($_POST['group1']))
		{
			
			 return '<div class="error_msgbox">Select Category Level</div>' ;
			 
		}
		else
		{
			$sql = "SELECT count(*) as cnt FROM category_table WHERE category_name ='".$_POST['category']."' AND category_parent_id=='0'"; 
			$query->executeQuery($sql);

			if( $query->records[0]['cnt'] == 0)
			{
				if ($_FILES['caticon']['size']>0)
				{
					if(in_array($_FILES['caticon']['type'],$imagetypes)) // check for image file types for the uploaded file
					{
						$fname=date("Y-m-d-His").$_FILES['caticon']['name']; // generate new file name
						$caticonpath="uploadedimages/caticons/".$fname; // concat the new file with image folder and thumb image folder for database 
						$imageDir=ROOT_FOLDER."uploadedimages/caticons"; // to upload the file
						$uploadfile = ROOT_FOLDER . $caticonpath; // actual image upload path
						if(move_uploaded_file($_FILES['caticon']['tmp_name'],$uploadfile))
							new Lib_ThumbImage('thumb',$uploadfile,$imageDir,THUMB_WIDTH);
						else
							return '<div class="error_msgbox">Sorry Image Not Uploaded</div>';	
					}
					else
						return '<div class="error_msgbox">Invalid image file format</div>';
				}
				else
					$caticonpath='';	
						
				if($_POST['group1']==1) // if creating parent category
				{
					$sql = "INSERT INTO category_table (category_name,category_parent_id,category_image, category_desc, category_status, category_content_id) VALUES ('".trim($_POST['categoryname'])."','0','". $caticonpath."','".trim($_POST['categorydesc'])."','".$_POST['status']."','".$_POST['contentid']."')";
					if($query->updateQuery($sql))
						return '<div class="success_msgbox">Category Added Successfully</div>' ;
					else
						return '<div class="error_msgbox">Error while adding the category </div>';
				}
				elseif($_POST['group1']==2) //create sub category
				{
					$sql = "INSERT INTO category_table (category_name,category_parent_id,	sub_category_parent_id,category_image,category_desc,category_status,category_content_id) VALUES ('".trim($_POST['categoryname'])."','".$_POST['category']."','".$_POST['subcategory']."','".$caticonpath."','".trim($_POST['categorydesc'])."','".$_POST['status']."','".$_POST['contentid']."')";
					
					if($query->updateQuery($sql))
					{
						return '<div class="success_msgbox">Category Added Successfully</div>' ;
					}
				}
				else // if creating sub category 
				{
					$sql = "INSERT INTO category_table (category_name,category_parent_id,category_image,category_desc,category_status,category_content_id) VALUES ('".trim($_POST['categoryname'])."','".$_POST['catid']."','".$caticonpath."','".trim($_POST['categorydesc'])."','".$_POST['status']."','".$_POST['contentid']."')";
					
					if($query->updateQuery($sql))
					{
						
						$catinsertid=$query->insertid;
						$temparray = array();
						$temparray = $_POST['attributes'];
						$cnt=count($temparray);
						if($cnt > 0)								
						for($i=0;$i<$cnt;$i++)
						{
							$sql = "INSERT INTO category_attrib_table (subcategory_id,attrib_id) values('".$catinsertid."','".$temparray[$i]."') ";
							$query->updateQuery($sql);
						}								
						return '<div class="success_msgbox">Category Added Successfully</div>' ;
					}
				}
					
				
			 }
			else
				return '<div class="error_msgbox">Category already exists</div>';
		}
		
	}
	/**
	 * Function returns a HTML Content preview 
	 * 
	 * 
	 * @return string
	 */	 		
	
	function showPreview()
	{
		$contentid=mysql_escape_string(intval($_GET['id']));
		$sql = "SELECT * FROM html_contents_table where html_content_id=".$contentid;
		$query = new Bin_Query();
		if($query->executeQuery($sql))
			return $query->records[0]['html_content'];
		else
			return "Select Content";
	}
	
}
?>