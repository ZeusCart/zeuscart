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
 * This class contains functions to get the category list values and attributes 
 * @package  		Core_Category_CShowMainCategory
 * @category  		Core
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
   * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */



class Core_Category_CShowMainCategory
{
	
	/**
	 * Function gets the list of categories from the table
	 * 
	 *
	 *@return string 
	 */	
	function showMainCategory()
	{

		$pagesize=5;
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
        	include_once("classes/Display/DShowMainCategory.php");
		
	  	$sql = "SELECT * FROM category_table WHERE category_parent_id ='0' AND category_status!='2'" ;		
		$query = new Bin_Query();		
		if($query->executeQuery($sql))
		{	
			$total = ceil($query->totrows/ $pagesize);
			include_once('classes/Lib/Paging.php');
			$tmp = new Lib_Paging('classic',array('totalpages'=>$total, 'length'=>10),'pagination');
			$this->data['paging'] = $tmp->output;
			$this->data['prev'] =$tmp->prev;
			$this->data['next'] = $tmp->next;
			$sql1 = "SELECT * FROM category_table WHERE category_parent_id ='0' AND category_status!='2'  LIMIT $start,$end"; 
			$query1 = new Bin_Query();
			if($query1->executeQuery($sql1))
			{
				return Display_DShowMainCategory::showCategory($query1->records,1,$this->data['paging'],$this->data['prev'],$this->data['next']);
			}
			else
			{
				return Display_DShowMainCategory::showCategory($obj->records,0,'','','');
				
			}

			
			 
		}
		else
		{
			return '<div class="alert alert-error">
             		<button type="button" class="close" data-dismiss="alert">×</button> Category Not Found  <a href="?do=managecategory"> To Create Category Click Here..</a></div>';
		}
			
	}
	
	/**
	 * Function gets the specific category from the table
	 * 
	 *
	 *@return string 
	 */	
	
	function displayMainCategory($Err)
	{
        	include_once("classes/Display/DShowMainCategory.php");
		
	 	$sql = "SELECT category_content_id FROM category_table where  category_id=".(int)$_GET['id']." AND AND category_status!='2'";	
		$query = new Bin_Query();
		$query->executeQuery($sql);
		
		$flag=$query->records[0]['category_content_id'];
		//$flag=$query->totrows;
	
		if($flag==0)
		{
			$sql = "SELECT * FROM category_table where category_id=".(int)$_GET['id'];		
			$query = new Bin_Query();
			if($query->executeQuery($sql))
			{	
				$sqlAttr = "SELECT *  FROM  `category_attrib_table` WHERE  `subcategory_id` =".mysql_escape_string(intval($_GET['id']));
				$objAttr = new Bin_Query();
				
				if($objAttr->executeQuery($sqlAttr))
					$array=$objAttr->records;
				if(!empty($array))
				{
					for($i=0;$i<count($array);$i++)
						$selectedarr[]= $array[$i]['attrib_id'];
				}
				else
				{
					$selectedarr[]="0";
				}
				
				
				$sql = "SELECT * FROM `attribute_table` order by attrib_name asc ";
				$cquery = new Bin_Query();
				if($cquery->executeQuery($sql))	
				$recordsAtt=$cquery->records;
				
				return Display_DShowMainCategory::displayMainCategory($query->records,$Err,$recordsAtt,$selectedarr);
			}
			else
			{
				return '<div class="alert alert-error">
             			 <button type="button" class="close" data-dismiss="alert">×</button> No Category Found</div>';
			}
		}	
		else
		{
			 $sql = "SELECT * FROM category_table cat 
			INNER JOIN html_contents_table ht ON cat.category_content_id = ht.html_content_id
			WHERE cat.category_parent_id =0 AND cat.category_id =".(int)$_GET['id'];
		
			$query = new Bin_Query();
		
			if($query->executeQuery($sql))
			{	
					
				return Display_DShowMainCategory::displayMainCategory($query->records,$Err);
			}
			else
			{
				return '<div class="alert alert-error">
            			 <button type="button" class="close" data-dismiss="alert">×</button> No Category Found</div>';
			}
		}
			
    	}
	
	/**
	 * Function updates the changes made in the main category
	 * 
	 *
	 *@return string 
	 */	
	
	function editMainCategory()
	{


		include("classes/Lib/ThumbImage.php");		

		if($_POST['categoryname']!='')
		{
			if($_POST['category']=='0')
			{
				$categoryparent=0;	
				$subcategorypath=$_GET['id'];
				$count=0;
			}
			else
			{
				$sqlsel="SELECT * FROM category_table WHERE category_id='".$_POST['category']."'  ";
				$objsel=new Bin_Query();
				$objsel->executeQuery($sqlsel);
				$path=$objsel->records[0]['subcat_path'];
				$categoryparent=$_POST['category'];
				
				$subcategorypath=$path.','.$_GET['id'];
				$pathcount=explode(',',$path);
				$count=count($pathcount);
				
			}
			if($_POST['status']=='')
			{
	
				$status='0';
			}
			else
			{
				$status=$_POST['status'];
	
			}
			$imagetypes=array ('image/jpeg' ,'image/pjpeg' , 'image/bmp' , 'image/gif' , 'image/png','image/x-png');

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
					}
			}
			else
			{

				$caticonpath=$_POST['caticon'];
			}		
					
			//convert all special charactor into hyphens and lower case

			$sluggable=$_POST['category_alias'];	
			$sluggable = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $sluggable);
			$sluggable = trim($sluggable, '-');
			if( function_exists('mb_strtolower') ) { 
				$sluggable = mb_strtolower( $sluggable );
			} else { 
				$sluggable = strtolower( $sluggable );
			}
			$category_alias = preg_replace("/[\/_|+ -]+/", '-', $sluggable);

			$sql= "UPDATE category_table SET category_name = '".$_POST['categoryname']."',category_alias='".$category_alias."', category_desc ='".$_POST['categorydesc']. "', category_status='".$_POST['status']."',category_parent_id='".$categoryparent."',subcat_path='".$subcategorypath."',count='".$count."',category_image='".$caticonpath."' WHERE category_id =".(int)$_GET['id'];  
			
			$query = new Bin_Query();
			if($query->updateQuery($sql))
			{
	
				$sqlDelete="DELETE FROM category_attrib_table WHERE subcategory_id=".(int)$_GET['id'];
				$objDelete=new Bin_Query();
				$objDelete->updateQuery($sqlDelete);
	
				$temparray = array();
				$temparray = $_POST['attributes'];
	
					$cnt=count($temparray); 
					if($cnt > 0)								
					for($i=0;$i<$cnt;$i++)
					{
						if($temparray[$i]!='')
						{
							$queryInsert=new Bin_Query();
							$sqlInsert = "INSERT INTO category_attrib_table (subcategory_id,attrib_id) values('".$_GET['id']."','".$temparray[$i]."') ";
							$queryInsert->updateQuery($sqlInsert);
						}
					}
	
	
	
				return '<div class="alert alert-success">
				<button type="button" class="close" data-dismiss="alert">×</button> Category <b> '.$_POST['categoryname'].'</b> Updated Successfully</div>';
			}
			else
			{
				return '<div class="alert alert-error">
				<button type="button" class="close" data-dismiss="alert">×</button>  Category Updated Failed(Category can not empty)</div>';
			}
		}
	}
	
	/**
	 * Function deletes a category from the table  
	 * 
	 *
	 *@return string 
	 */	
	
	function deleteMainCategory()
	{


		if($_GET['id']!='')
		{
			//$sql = "DELETE FROM category_table WHERE  category_id=".(int)$_GET['id'];
			

			$sql = "UPDATE category_table SET category_status='2' WHERE  category_id=".(int)$_GET['id'];

			$query = new Bin_Query();
			
			if($query->updateQuery($sql))
					return '<div class="alert alert-success">
			<button type="button" class="close" data-dismiss="alert">×</button>  Category Deleted Successfully</div>';
		}
		else
		{


			if(count($_POST['categoryid'])>0)
			{
				for($i=0;$i<count($_POST['categoryid']);$i++)
				{
					$sql = "UPDATE category_table SET category_status='2'  WHERE  category_id=".(int)$_POST['categoryid'][$i];
					$obj=new Bin_Query();
					$obj->updateQuery($sql);
				}

				

			}
			if($obj->updateQuery($sql))
					return '<div class="alert alert-success">
			<button type="button" class="close" data-dismiss="alert">×</button>  Category Deleted Successfully</div>';
		}
	}
	
	/**
	 * Function returns the search results from multiple tables
	 * 
	 *
	 *return string 
	 */	
	
	function searchMainCategory()
	{
		

		include_once("classes/Display/DShowMainCategory.php");
		
		$catname = $_POST['catname'];
		$catdesc = $_POST['catdesc'];
		$status =  $_POST['status'];
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
		$sql='SELECT category_id,category_name,category_desc,category_status,category_image FROM category_table  AND category_status!="2"';
		$condition=array();
			
		if($catname!='')
		{
			$condition []= "  category_name like '%".$catname."%'";
		}
		if($catdesc!='')
		{
			$condition[]= " category_desc like  '%".$catdesc."%'";
		}
		
		if($status!='')
		{
			$condition []= " category_status = '".$status."'";
		}
		
			
		if(count($condition)>1)
			 $sql.= ' where '. implode(' and ', $condition) .'';
		elseif(count($condition)>0)
			 $sql.= ' where '. implode('', $condition) .'';
		elseif(count($condition)==0)
		{
			$sql.= " ";
		}

		$obj=new Bin_Query();
  	    	if($obj->executeQuery($sql))
		{
				$total = ceil($obj->totrows/ $pagesize);
				include('classes/Lib/Paging.php');
				$tmp = new Lib_Paging('classic',array('totalpages'=>$total, 'length'=>5),'pagination');
				$this->data['paging'] = $tmp->output;
				$this->data['prev'] =$tmp->prev;
				$this->data['next'] = $tmp->next;
				if (empty($condition))
					 $sql1 =$sql." LIMIT ".$start.",".$end;
				else
					 $sql1 =$sql;	
				$obj1=new Bin_Query();
				$obj1->executeQuery($sql1);
			return Display_DShowMainCategory::showCategory($obj->records,1,$this->data['paging'],$this->data['prev'],$this->data['next']);
			
		
			
		}
		else
		{
			$output =  Display_DShowMainCategory::showCategory($obj->records,0,'','','');
		}

			return $output;
  	}

 	/**
	 * Function selects the data from the table need for generating auto complete popup window. 
	 * 
	 * 
	 * @return xml
	 */
   
   	function autoComplete()
	{
			
		$aUsers = array();

		$sql="SELECT category_name FROM category_table where category_parent_id=0";
		$obj =  new Bin_Query();
		$obj->executeQuery($sql);
		
		$count=count($obj->records);
		if($count!=0)
		{
			for($i=0;$i<$count;$i++)
				$aUsers[]=$obj->records[$i]['category_name'];
		}
		else
			$aUsers[]='0 Results';		
	
	
		$input = strtolower( $_GET['input'] );
		$len = strlen($input);
		$limit = isset($_GET['limit']) ? (int) $_GET['limit'] : 0;
		
		
		$aResults = array();
		$count = 0;
		
		if ($len)
		{
			for ($i=0;$i<count($aUsers);$i++)
			{
				// had to use utf_decode, here
				// not necessary if the results are coming from mysql
				//
				if (strtolower(substr(utf8_decode($aUsers[$i]),0,$len)) == $input)
				{
					$count++;
					$aResults[] = array( "id"=>($i+1) ,"value"=>htmlspecialchars($aUsers[$i]));
				}
				
				if ($limit && $count==$limit)
					break;
			}
		}
		
		
		
		
		
		header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
		header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
		header ("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
		header ("Pragma: no-cache"); // HTTP/1.0
		
		
		
		if (isset($_REQUEST['json']))
		{
			header("Content-Type: application/json");
		
			echo "{\"results\": [";
			$arr = array();
			for ($i=0;$i<count($aResults);$i++)
			{
				$arr[] = "{\"id\": \"".$aResults[$i]['id']."\", \"value\": \"".$aResults[$i]['value']."\"}";
			}
			echo implode(", ", $arr);
			echo "]}";
		}
		else
		{
			header("Content-Type: text/xml");
	
			echo "<?xml version=\"1.0\" encoding=\"utf-8\" ?><results>";
			for ($i=0;$i<count($aResults);$i++)
			{
				echo "<rs id=\"".$aResults[$i]['id']."\" >".$aResults[$i]['value']."</rs>";
			}
			echo "</results>";
		}
					
	}
}
?>
