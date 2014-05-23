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
 * This class contains functions related to home page ads
 *
 * @package  		Core_CHomePageAds
 * @category  		Core
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
 * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */


class Core_CHomePageAds
{
	
	/**
	 * Stores the output 
	 *
	 * @var array $output
	 */
	
	var $output = array();
	
	/**
	 * Function gets the home page ads from the db. 
	 * 
	 * 
	 * @return string
	 */	
	
	function showHomePageAdsList()
	{

		$pagesize=20;
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

		$sqlselect = "select * from home_page_ads_table ";

		$query = new Bin_Query();
		if($query->executeQuery($sqlselect))
		{	
			$total = ceil($query->totrows/ $pagesize);
			include_once('classes/Lib/Paging.php');
			$tmp = new Lib_Paging('classic',array('totalpages'=>$total, 'length'=>10),'pagination');
			$this->data['paging'] = $tmp->output;
			$this->data['prev'] =$tmp->prev;
			$this->data['next'] = $tmp->next;
			
			$sql1 = "select * from home_page_ads_table  LIMIT $start,$end";
			$query1 = new Bin_Query();
			$query1->executeQuery($sql1);
			
			
			
		}
		return Display_DHomePageAds::showHomePageAdsList($query1->records,1,$this->data['paging'],$this->data['prev'],$this->data['next']);
	}

	/**
	 * Function is used to insert the home page ads into db 
	 * 
	 * 
	 * @return string
	 */		
	function insertHomePageAds()
	{
		$title = trim($_POST['title']);
		$url = trim($_POST['url']);
		$status=$_POST['status'];
		if($_FILES['logo']['name']!='')
		{
			$imgfilename= $_FILES['logo']['name'];		
			$image="images/homepageads/". date("Y-m-d-His").$imgfilename; //inserted into db
			$imageDir=ROOT_FOLDER."images/homepageads"; // to upload the file
			$path=ROOT_FOLDER.$image;
			move_uploaded_file($_FILES["logo"]["tmp_name"],$path);
			
		}
		if($status=='')
		{
			$status=0;	
		}
		
		$sql="INSERT INTO home_page_ads_table(home_page_ads_title 	,home_page_ads_logo,home_page_ads_url,status) VALUES('$title','$image','$url','$status')";
		$qry=new Bin_Query();
		if($qry->updateQuery($sql))
		{

			$result = '<div class="alert alert-success">
			<button data-dismiss="alert" class="close" type="button">×</button> Added Successfully</div>';
			
		}
		else
		{

			$result = '<div class="alert alert-error">
			<button data-dismiss="alert" class="close" type="button">×</button> Not Inserted</div>';		
			
		}
		return $result;	

	}
	/**
	 * Function is used to delete the home page ads in db 
	 * 
	 * 
	 * @return string
	 */	
	function deleteHomePageAds()
	{
		$id=$_POST['homePageadcheck'];

		foreach ($id as $key => $value) {

			$sql="delete from  home_page_ads_table where home_page_ads_id='$value' "; 
			$qry=new Bin_Query();
			if($qry->updateQuery($sql))
			{
				$result = '<div class="alert alert-success">
				<button data-dismiss="alert" class="close" type="button">×</button>
				Deleted Successfully</div>';
				
			}
			else
			{

				$result ='<div class="alert alert-error">
				<button data-dismiss="alert" class="close" type="button">×</button> Deletion Failed. Try Again Later</div>';	
				
			}	
			
		}



		return $result;  


	}
	/**
	 * Function is used to get the home page ads from db 
	 * 
	 * 
	 * @return string
	 */
	function gethomepaggads()
	{
		
		$sql="select * from  home_page_ads_table where home_page_ads_id='".$_GET['id']."'"; 
		$qry = new Bin_Query();
		$qry->executeQuery($sql);
		$output=$qry->records[0];

		return $output;

	}
	/**
	 * Function is used to update the home page ads in db 
	 * 
	 * 
	 * @return string
	 */
	function updateEditHomePageAds()
	{

		$title=trim($_POST['home_page_ads_title']);
		$logo = trim($_POST['home_page_ads_logo']);
		$url = trim($_POST['home_page_ads_url']);
		$status=$_POST['status'];

		if($_FILES['home_page_ads_logo']['name']!='')
		{
			$imgfilename= $_FILES['home_page_ads_logo']['name'];		
			$image="images/homepageads/". date("Y-m-d-His").$imgfilename; //inserted into db
			$imageDir=ROOT_FOLDER."images/homepageads"; // to upload the file
			$path=ROOT_FOLDER.$image;
			move_uploaded_file($_FILES["home_page_ads_logo"]["tmp_name"],$path);
			
		}
		else
		{
			$image=$_POST['home_page_ads_logo'];
			
			
		}
		if($status=='')
		{
			$status=0;	
		}



		$sql="update home_page_ads_table home_page_ads set home_page_ads_title 	='$title',home_page_ads_logo='$image',home_page_ads_url='$url',status=$status where home_page_ads_id='".$_GET['id']."'"; 
		$qry=new Bin_Query();
		if($qry->updateQuery($sql))
		{

			$result = '<div class="alert alert-success">
			<button data-dismiss="alert" class="close" type="button">×</button> Updated Successfully</div>';
			
		}
		else
		{

			$result = '<div class="alert alert-error">
			<button data-dismiss="alert" class="close" type="button">×</button> Not Updated</div>';		
			
		}	

		return $result;

	}

	/**
	 * Function is used to active the home page ads in db 
	 * 
	 * 
	 * @return string
	 */	
	function acceptHomePageAds()
	{
		if(isset($_GET['id'])&&is_numeric($_GET['id']))
		{
			
			$sql="update   home_page_ads_table set status ='1'  where home_page_ads_id='".$_GET['id']."' "; 
			$qry=new Bin_Query();
			if($qry->updateQuery($sql))
			{
				$result = "<div class='success_msgbox'>Successfully Activated </div>";
				return $result;					
			}
			else
			{

				$result ="<div class='error_msgbox'>Activation Failed. Try Again Later</div>";	
				return $result;			  
			}	
			
		}
		else
		{	
			
			$result ="<div class='error_msgbox'>Activation Failed. Try Again Later</div>";	
			return $result;  
		}

	}
	/**
	 * Function is used to inactive the home page ads in db 
	 * 
	 * 
	 * @return string
	 */	
	function denyEditHomePageAds()
	{
		if(isset($_GET['id'])&&is_numeric($_GET['id']))
		{
			
			$sql="update   home_page_ads_table set status ='0'  where home_page_ads_id='".$_GET['id']."' "; 
			$qry=new Bin_Query();
			if($qry->updateQuery($sql))
			{
				$result = "<div class='success_msgbox'>Successfully InActivated </div>";
				return $result;					
			}
			else
			{

				$result ="<div class='error_msgbox'>Inactivation Failed. Try Again Later</div>";	
				return $result;			  
			}	
			
		}
		else
		{	
			
			$result ="<div class='error_msgbox'>Inactivation Failed. Try Again Later</div>";	
			return $result;  
		}

	}
	/**
	 * Function is used to show home page about content 
	 * @param array $Err
	 * @return array
	 */
	function showHomePageContent($Err)
	{

		$sql="SELECT * FROM home_page_content_table";
		$obj=new Bin_Query();
		$obj->executeQuery($sql);
		$records=$obj->records[0];	

		return Display_DHomePageAds::showHomePageContent($records,$Err);

	}
	/**
	 * Function is used to update home page about content 
	 * 
	 * 
	 * @return array
	 */
	function updateHomePageContent()
	{


		if(isset($_POST['status']))
		{
			$status=$_POST['status'];

		}
		else
		{
			$status=1;
	
		}
		$remove =  array("\\n","\\r");
		$home_page_content= str_replace($remove,"",$_POST['home_page_content']);
	
		
		 $sql = "UPDATE home_page_content_table SET 
			home_page_content ='".trim($home_page_content)."',
			status='".$status."'
			where id='1'";  
			$query = new Bin_Query();
			if($query->updateQuery($sql))
			{		

				$_SESSION['msgSitemoto'] = '<div class="alert alert-success">
   				 <button type="button" class="close" data-dismiss="alert">×</button>Content  has been updated successfully </div>';
		
			}
			else
			{
				$_SESSION['msgSitemoto'] = '<div class="alert alert-error">
    				<button type="button" class="close" data-dismiss="alert">×</button>Content has not been updated successfully</div>';

			}

			header('Location:?do=homepage&action=content');
			exit;

	}
}
?>