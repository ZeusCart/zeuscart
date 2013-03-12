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
 * This class contains functions to get the content details from the database 
 *
 * @package  		Core_Settings_CShowContents
 * @category  		Core
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
   * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */



class Core_Settings_CShowContents
{

	/**
	 * Function gets the content details from the database 
	 * 
	 * 
	 * @return string
	 */	 	
	function showContents()
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
		
		
		$sql = "SELECT * FROM html_contents_table ";
		$query = new Bin_Query();
		if($query->executeQuery($sql))
		{	
			$total = ceil($query->totrows/ $pagesize);
			include_once('classes/Lib/Paging.php');
			$tmp = new Lib_Paging('classic',array('totalpages'=>$total, 'length'=>10),'pagination');
			$this->data['paging'] = $tmp->output;
			$this->data['prev'] =$tmp->prev;
			$this->data['next'] = $tmp->next;
			
			$sql1 = "select * from html_contents_table LIMIT $start,$end";
			$query1 = new Bin_Query();
			
			if($query1->executeQuery($sql1))
			{
				return Display_DShowContents::showContents($query1->records,$this->data['paging'],$this->data['prev'],$this->data['next']);
			}
		}
		else
		{
			return "No Contents Found";
		}
	}
	
	/**
	 * Function gets the content details for the selected content id
	 * 
	 * 
	 * @return string
	 */	 	
	
	function displayContents()
    {
        
		
		$sql = "SELECT * FROM html_contents_table where html_content_id=".(int)$_GET['id'];
		
		$query = new Bin_Query();
		if($query->executeQuery($sql))
		{		
			return Display_DShowContents::displayContents($query->records);
		}
		else
		{
			return "No Contents Found";
		}
		
		
    }
	
	/**
	 * Function gets the content details for the selected content id
	 * 
	 * 
	 * @return string
	 */	 
	
	function showContentsDetail()
    {
        
		
		$sql = "SELECT * FROM html_contents_table where html_content_id=".(int)$_GET['id'];
		
		$query = new Bin_Query();
		if($query->executeQuery($sql))
		{		
			return Display_DShowContents::showContentsDetail($query->records);
		}
		else
		{
			return "No Contents Found";
		}
		
		
    }
	
	/**
	 * Function updates the changes made in the contents into the database 
	 * 
	 * 
	 * @return string
	 */	 
	
	function editContents()
	{
		//print_r($_GET);
		$sql = "UPDATE html_contents_table SET html_content_name = '".$_POST['contentname']."',  
html_content = '".$_POST['htmlcontent']."' WHERE html_content_id =".(int)$_GET['id']; 
//		echo 's';	
		$query = new Bin_Query();
		
		if($query->updateQuery($sql))
			return '<div class="success_msgbox">Contents Updated Successfully</div>';
		
			//$_SESSION['msg']= "Edited Successfully";
		
		
	}
	
	/**
	 * Function deletes the selected content id from the database 
	 * 
	 * 
	 * @return string
	 */	 
	
	
	function deleteContents()
	{
		$sql = "DELETE FROM html_contents_table WHERE html_content_id=".(int)$_GET['id'];
		$query = new Bin_Query();
		if($query->updateQuery($sql))
		{
			return '<div class="success_msgbox">Content Deleted Successfully</div>';
			//$_SESSION['msg']="Deleted Successfully";
		}	
	}
	
}
?>