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
 * This class contains functions to show the HTML Content Preview
 *
 * @package  		Core_Settings_CCategoryManagement
 * @category  		Core
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
   * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */

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
	function showCategoryParent()
	{
	

		$output='<select name="category" class="span4" id="Attributecat"><option value="0">No parent</option>';
// 
// 		$sql = "SELECT * FROM category_table WHERE category_parent_id='0'" ;
// 		$cquery = new Bin_Query();
// 		if($cquery->executeQuery($sql))
// 		for($k=0;$k<count($cquery->records);$k++)
// 		{
// 			$maincategory = $cquery->records[$k]['category_id'];
// 			echo $sql1 = "SELECT * FROM category_table WHERE  FIND_IN_SET('".$maincategory."',subcat_path) OR category_id='".$maincategory."' " ; exit;
// 			$cquery1 = new Bin_Query();
// 			if($cquery1->executeQuery($sql1))
// 			$records = $cquery1->records;
// 			for ($i=0;$i<count($records);$i++)
// 			{	
// 				$countpath=explode(',',$records[$i]['subcat_path']);
// 				$output.='<option value="'.$records[$i]['category_id'].'">';
// 
// 				for($a=1;$a<count($countpath);$a++)
// 				{
// 				$output.='-&nbsp;';
// 					
// 				}
// 
// 			$output.= $records[$i]['category_name'].'</option>';
// 		
// 			}
// 
// 		}
// 
	
				
		$sql = "SELECT * FROM category_table WHERE category_parent_id='0'" ;
		$cquery = new Bin_Query();
		if($cquery->executeQuery($sql))
		for($k=0;$k<count($cquery->records);$k++)
		{
			$output.='<option value='.$cquery->records[$k]['category_id'].'>'.$cquery->records[$k]['category_name'].'</option>';
                	$output.=self:: getSubFamilies(0,$cquery->records[$k]['category_id']);

		
            	}

		$output.='</select>';
 		 return $output;
	}

	/**
	 * Function generates an drop down list with the category details.in sub child
	 * 
	 * 
	 * @return array
	 */		
	function getSubFamilies($level, $id) {
		$level++;
		$sqlSubFamilies = "SELECT * from category_table WHERE  category_parent_id = ".$id."";
		$resultSubFamilies = mysql_query($sqlSubFamilies);
		if (mysql_num_rows($resultSubFamilies) > 0) {
		
			while($rowSubFamilies = mysql_fetch_assoc($resultSubFamilies)) {

				$countpath=explode(',',$rowSubFamilies['subcat_path']);
				$output.= "<option value=".$rowSubFamilies['category_id'].">";

				for($a=1;$a<count($countpath);$a++)
				{
				$output.='- &nbsp;';
					
				}
				$output.=$rowSubFamilies['category_name']."</option>";
				$output.=self:: getSubFamilies($level, $rowSubFamilies['category_id']);
				
			}
		
		}
		
		return $output;
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
			$output='<select id="subcategory" class="txt_box200" name="subcategory" style="width:260px;" ><option>select Sub Child</option>';
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
	 * @param string $name
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
			 $sql = "SELECT * FROM category_table WHERE category_parent_id='0'" ;
			$cquery = new Bin_Query();
			if($cquery->executeQuery($sql))
			for($k=0;$k<count($cquery->records);$k++)
			{
				$maincategory = $cquery->records[$k]['category_id'];
				$sql1 = "SELECT * FROM category_table WHERE  FIND_IN_SET('".$maincategory."',subcat_path) OR category_id='".$maincategory."' " ;
				$cquery1 = new Bin_Query();
				if($cquery1->executeQuery($sql1))
					$records = $cquery1->records;
	
	
				$category = array("category"=>"All Categories");
				for ($i=0;$i<count($records);$i++)
				{	
					
					$output.='<option value="'.$records[$i]['category_id'].'">'. $records[$i]['category_name'].'</option>';
			
				}
	
			}

		return $output;
			
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
			
		/*  if(count($file) > 2  || !in_array($_FILES['caticon']['type'],$imagetypes))
		  {		
  			return '<div class="alert alert-error">
             			 <button type="button" class="close" data-dismiss="alert">×</button> Invalid image file format</div>	';	
		  }*/	 	
		
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
							return '<div class="alert alert-error">
             					 <button type="button" class="close" data-dismiss="alert">×</button> Sorry Image Not Uploaded</div>';	
					}
					else
						return '<div class="alert alert-error">
              					<button type="button" class="close" data-dismiss="alert">×</button> Invalid image file format</div>';
				}
				else
					$caticonpath='';	
					
					if($_POST['category']=='0')
					{
						$categoryparent=0;	
							
						$count=0;
					}
					else
					{
						$sqlsel="SELECT * FROM category_table WHERE category_id='".$_POST['category']."' ";
						$objsel=new Bin_Query();
						$objsel->executeQuery($sqlsel);
						$path=$objsel->records[0]['subcat_path'];
						$categoryparent=$_POST['category'];
						$path=$path;
						$pathcount=explode(',',$path);
						$count=count($pathcount);	

					}	

					//convert all special charactor into hyphens and lower case
					if($_POST['category_alias']!='')
					{
						
						$sluggable=$_POST['category_alias'];			
						
					}
				
					//convert all special charactor into hyphens and lower case
					$sluggable = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $sluggable);
					$sluggable = trim($sluggable, '-');
					if( function_exists('mb_strtolower') ) { 
						$sluggable = mb_strtolower( $sluggable );
					} else { 
						$sluggable = strtolower( $sluggable );
					}
					$category_alias = preg_replace("/[\/_|+ -]+/", '-', $sluggable);	


						 $sql = "INSERT INTO category_table (category_name,category_alias,category_parent_id,category_image,category_desc,category_status,category_content_id,count) VALUES ('".trim($_POST['categoryname'])."','".$category_alias."','".$categoryparent."','".$caticonpath."','".trim($_POST['categorydesc'])."','".$_POST['status']."','".$_POST['contentid']."','".$count."')";  
						$query->updateQuery($sql);
						
						$catinsertid=mysql_insert_id();


						if($_POST['category']=='0')
						{
							$subcategorypath=$catinsertid;
						}
						else
						{
							$subcategorypath=$path.','.$catinsertid;	
	
						}
								
						$sqlSub="UPDATE category_table SET subcat_path='".$subcategorypath."'
						WHERE category_id='".$catinsertid."'"; 
						$objSub=new Bin_Query(); 
						if($objSub->updateQuery($sqlSub))
						{
							
							$temparray = array();
							$temparray = $_POST['attributes'];
							$cnt=count($temparray);
							if($cnt > 0)								
							for($i=0;$i<$cnt;$i++)
							{
								$sql = "INSERT INTO category_attrib_table (subcategory_id,attrib_id) values('".$catinsertid."','".$temparray[$i]."') ";
								$query->updateQuery($sql);
							}	
							return '<div class="alert alert-success">
							<button type="button" class="close" data-dismiss="alert">×</button> Category Added Successfully</div>' ;

						}
						else
						{
							return '<div class="alert alert-error">
							<button type="button" class="close" data-dismiss="alert">×</button> Error while adding the category </div>';
						}
					
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
			return '<div class="alert alert-error">
              <button type="button" class="close" data-dismiss="alert">×</button> Select Content</div>';
	}
	
}
?>