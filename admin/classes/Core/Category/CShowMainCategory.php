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
 * CShowMainCategory
 *
 * This class contains functions to get the category list values and attributes 
 *
 * @package		Core_Category_CShowMainCategory
 * @category	Core
 * @author		ZeusCart Team
 * @link		http://www.zeuscart.com
 * @version 	2.3
 */

// ------------------------------------------------------------------------

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
        	include_once("classes/Display/DShowMainCategory.php");
		
		$sql = "SELECT * FROM category_table where category_parent_id=0  order by category_name";
		
		$query = new Bin_Query();
		
		if($query->executeQuery($sql))
		{		
			return  Display_DShowMainCategory::showCategory($query->records,1);
		}
		else
		{
			return '<div class="exc_msgbox">Category Not Found  <a href="?do=managecategory"> To Create Category Click Here..</a></div>';
		}
			
	}
	
	/**
	 * Function gets the specific category from the table
	 * 
	 *
	 *@return string 
	 */	
	
	function displayMainCategory()
	{
        	include_once("classes/Display/DShowMainCategory.php");
		
		$sql = "SELECT category_content_id FROM category_table where category_parent_id=0 and category_id=".(int)$_GET['id'];
		
		$query = new Bin_Query();
		$query->executeQuery($sql);
		
		$flag=$query->records[0]['category_content_id'];
		//$flag=$query->totrows;
		//print_r($flag);
		if($flag==0)
		{
			$sql = "SELECT * FROM category_table where category_parent_id=0 and category_id=".(int)$_GET['id'];
		
			$query = new Bin_Query();
			if($query->executeQuery($sql))
			{	
					
				return Display_DShowMainCategory::displayMainCategory($query->records);
			}
			else
			{
				return "No Category Found";
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
					
				return Display_DShowMainCategory::displayMainCategory($query->records);
			}
			else
			{
				return "No Category Found";
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
		$catname=trim($_POST['category']);
		//if(preg_match('#[^a-zA-Z0-9]#', $_string)&&preg_match('*',$catname)
		if(!empty($catname))
		{
		$sql = "UPDATE category_table SET ";
	
		if($_POST['contentid']!=0)
		{
			$sql.="category_content_id='".$_POST['contentid']."',";
		}
		
		$sql.= "category_name = '".$_POST['category']."', category_desc = '".$_POST['categorydesc']. "', category_status = '".$_POST['status']."' WHERE category_id =".(int)$_GET['id'];
		
		$query = new Bin_Query();
		if($query->updateQuery($sql))
		
		return '<div class="success_msgbox">Category <b> '.$_POST['category'].'</b> Updated Successfully</div>';
		}
		else
		{
			return '<div class="error_msgbox">Category Updated Failed(Category can not empty)</div>';
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
		$sql = "DELETE FROM category_table WHERE category_parent_id='".(int)$_GET['id']."' or  category_id=".(int)$_GET['id'];
		
		$query = new Bin_Query();
		
		if($query->updateQuery($sql))
				return '<div class="success_msgbox">Category Deleted Successfully</div>';
	}
	
	/**
	 * Function returns the search results from multiple tables
	 * 
	 *
	 *@return string 
	 */	
	
	function searchMainCategory()
	{
		include_once("classes/Display/DShowMainCategory.php");
		
		$catname = $_POST['catname'];
		$catdesc = $_POST['catdesc'];
		$status =  $_POST['status'];
		
		$sql='SELECT category_id,category_name,category_desc,category_status,category_image FROM category_table ';
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
			$sql.= ' where '. implode(' and ', $condition) .' and category_parent_id="0"';
		elseif(count($condition)>0)
			$sql.= ' where '. implode('', $condition) .' and category_parent_id="0"';
		elseif(count($condition)==0)
		{
			$sql.= " where  category_parent_id='0'";
		}
				
			if($_POST['search']=='Search')
			{
				$obj = new Bin_Query();
				if($obj->executeQuery($sql))
					$output =  Display_DShowMainCategory::showCategory($obj->records,'1');
				else
				{ 
					$output =  Display_DShowMainCategory::showCategory($obj->records,'0');
				}
				return $output;
			}
			else
			{
					
					$this->showMainCategory();
				//Core_CShowMainCategory::showMainCategory($sql);
			}
		
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
		//echo "<pre>";
		//print_r($obj->records);
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