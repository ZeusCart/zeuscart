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
 * CNewsSettings
 *
 * This class contains functions to add, edit and delete the existing news details from the database 
 *
 * @package		Core_Settings_CNewsSettings
 * @category	Core
 * @author		ZeusCart Team
 * @link		http://www.zeuscart.com
 * @version 	2.3
 */

// ------------------------------------------------------------------------

class Core_Settings_CNewsSettings
{

	/**
	 * Function adds a news into the table 
	 * 
	 * 
	 * @return string
	 */	 	

	function addNews()
	{
		
		if(trim($_POST['newstitle'])!='')		
		{
		  if($_POST['statusVal']!='')
			 $status=$_POST['statusVal'];
		  else
		     $status=0; 	
			
			 $sql = "INSERT INTO news_table (news_title,news_desc,news_date,news_status) VALUES ('".$_POST['newstitle']."','".$_POST['newscontent']."','".date("Y.m.d")."',".$status.")"; 
			
			$query = new Bin_Query();
		
			if($query->updateQuery($sql))
		return '<div class="success_msgbox">News <b>'.$_POST['newstitle'].'</b> Created successfully</div> ';
			else
				return '<div class="error_msgbox">Error while creating News.</div> ';
		}
		else
			return '<div class="error_msgbox">Error while creating News.</div> ';

	}
	
	
	/**
	 * Function gets all the news details from the database 
	 * 
	 * 
	 * @return string
	 */	 	

	
	function showNews()
	{
		include("classes/Display/DNewsSettings.php");
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
		
		$sqlselect = "SELECT * FROM news_table order by news_date desc";
		$query = new Bin_Query();
		if($query->executeQuery($sqlselect))
		{	
			$total = ceil($query->totrows/ $pagesize);
			include_once('classes/Lib/Paging.php');
			$tmp = new Lib_Paging('classic',array('totalpages'=>$total, 'length'=>10),'pagination');
			$this->data['paging'] = $tmp->output;
			$this->data['prev'] =$tmp->prev;
			$this->data['next'] = $tmp->next;
			
		$sql = "SELECT * FROM news_table order by news_date desc LIMIT $start,$end ";
			$query1 = new Bin_Query();
			
			if($query1->executeQuery($sql))
			{
				return Display_DNewsSettings::showNews($query1->records,1,$this->data['paging'],$this->data['prev'],$this->data['next']);
			}
		}
		else
		{
			return "No News Found";
		}
	
	}
	
	
	/**
	 * Function gets the news details from the news table for the selected news id 
	 * 
	 * 
	 * @return string
	 */	 	

	
	function viewNews()
    {
        include("classes/Display/DNewsSettings.php");
		
		 $sql = "SELECT * FROM news_table where news_id=".(int)$_GET['id'];
		
		
		$query = new Bin_Query();
		if($query->executeQuery($sql))
		{		
			return Display_DNewsSettings::viewNews($query->records);
		}
		else
		{
			return '<div class="success_msgbox">No News Found</div>';
		}
		
		
    }
	
	/**
	 * Function updates the changes in the news details into the table 
	 * 
	 * 
	 * @return string
	 */	 	
	
	function editNews()
	{
		//print_r($_GET);
		$sql = "UPDATE news_table SET news_desc='".$_POST['newsletter']."',news_title='".$_POST['newstitle']."' WHERE news_id=".(int)$_GET['id']; 

		$query = new Bin_Query();
		
		if($query->updateQuery($sql))
		$_SESSION['msg'] = '<div class="success_msgbox">News Updated successfully</div> ';
			
			//$_SESSION['msg']= "Updated Successfully";
			
	}
	
	/**
	 * Function deletes the selected news from the table 
	 * 
	 * 
	 * @return string
	 */	 	
	
	function deleteNews()
	{
		
	
		if(isset($_POST['deletenews']) &&  $_POST['deletenews']!='' )
        {
		   $value=$_POST['deletenews'];
		   $id='';
	
		   for ($i=0;$i<count($value);$i++)
			   $id.= "'".$value[$i]."',"; 
	
		   $newsid=substr($id,0,-1);
		   $sql = "DELETE FROM news_table WHERE news_id in(".$newsid.")";
		   $query = new Bin_Query();
			
		   if($query->updateQuery($sql))
		   $_SESSION['msg'] = '<div class="success_msgbox">News  Deleted Successfully</div>';
		  //return '<div class="success_msgbox">News  Deleted Successfully</div>';
		}
		else
		 $_SESSION['msg'] = '<div class="error_msgbox">Please Select Atleast One News for Delete </div>';
		 //return '<div class="error_msgbox">Please Select Atleast One News for Delete </div>';	
			
	}
	
	/**
	 * Function updates the news status for the selected news id
	 * 
	 * 
	 * @return string
	 */	 	
	
	function statusNews()
	{
		
		if($_GET['status']==1)
		$status=0;
		else
		$status=1;
		
	
	    $sql = "UPDATE  news_table set news_status=".$status." WHERE news_id=".(int)$_GET['id']; 

		$query = new Bin_Query();
		
		if($query->updateQuery($sql))
			return '<div class="success_msgbox">News  Status Modified</div>';
			
	}
	
	
}
?>