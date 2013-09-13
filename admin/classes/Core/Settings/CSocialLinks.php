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
 * This class contains functions to get social link and update ,delete social link related process
 *
 * @package  		Core_Settings_SocialLinks
 * @category  		Core
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
   * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */

class Core_Settings_SocialLinks
{
	
	
	

	/**
	 * Function inserts the page name into the social link table 
 	 * 
	 * @param string $pagename
	 * @return string
	 */	 	

	function insertSocialLink($pagename)
	{

		$title = trim($_POST['social_link_title']);
		$url = trim($_POST['social_link_url']);
		$status=$_POST['status'];
		if($_FILES['social_link_logo']['name']!='')
		{
			$varimgfilename= $_FILES['social_link_logo']['name'];		
			$varimage="images/sociallink/". date("Y-m-d-His").$varimgfilename; //inserted into db
			$varimageDir=ROOT_FOLDER."images/sociallink"; // to upload the file
			$varstpath=ROOT_FOLDER.$varimage;
			move_uploaded_file($_FILES["social_link_logo"]["tmp_name"],$varstpath);
			
		}
		if($status=='')
		{
			$status=0;	
		}
		$image=explode('/',$varstpath, 2);
		$sql="INSERT INTO social_links_table(social_link_title,social_link_logo,social_link_url,status) VALUES('$title','$image[1]','$url','$status')";
		$qry=new Bin_Query();
		if($qry->updateQuery($sql))
		{
			$result = '<div class="alert alert-success">
			<button data-dismiss="alert" class="close" type="button">×</button> Social Link Inserted Iuccessfully</div>';
			
		}
		else
		{
			$result = '<div class="alert alert-error">
			<button data-dismiss="alert" class="close" type="button">×</button> Social Link Not Inserted </div>';		
			
		}
		
		return $result;	
	}
	
	/**
	 * Function gets all the social links from the custom page table 
 	 * 
	 * 
	 * @return string
	 */	 	
	
	function showSocialLinks()
	{
		$sql = "SELECT * FROM social_links_table "; 
		$query = new Bin_Query();
		$query->executeQuery($sql);
		return Display_DSocialLinks::showSocialLinks($query->records);
	}
	
	
	/**
	 * Function deletes the selected social link from the database
 	 * 
	 * 
	 * @return string
	 */	 	
	
	function deleteSocialLink()
	{
		$id=$_POST['socialLinkcheck'];
		foreach ($id as $key => $value) {

			$sql="DELETE FROM social_links_table WHERE social_link_id 	='$value'";
			$query = new Bin_Query();
			if($query->updateQuery($sql))
			{
				$result='<div class="alert alert-success">
			<button data-dismiss="alert" class="close" type="button">×</button> Social Link Deleted successfully</div>';
			}
			
		}

		return $result;
		
	}
	/**
	 * Function is used to get the social link for display the edit page
 	 * 
	 * 
	 * @return void
	 */	
	function getSocialLink()
	{
		
		$sql="SELECT * FROM social_links_table WHERE social_link_id 	=".mysql_escape_string(intval($_GET['id']))."";
		$obj=new Bin_Query();
		$obj->executeQuery($sql);
		$records=$obj->records[0];

		return $records;
	}
	
	
	/**
	 * Function updates the changes made in the selected social link
 	 * 
	 * 
	 * @return void
	 */	 	
	
	function updateSocialLink()
	{
		$title=trim($_POST['social_link_title']);
		$logo = trim($_POST['social_link_logo']);
		$url = trim($_POST['social_link_url']);
		$status=$_POST['status'];
		$sociallinkid=$_POST['sociallinkid'];		 
		if($_FILES['social_link_logo']['name']!='')
		{
			$varimgfilename= $_FILES['social_link_logo']['name'];		
			$varimage="images/sociallink/". date("Y-m-d-His").$varimgfilename; //inserted into db
			$varimageDir=ROOT_FOLDER."images/sociallink"; // to upload the file
			$varstpath=ROOT_FOLDER.$varimage;
			move_uploaded_file($_FILES["social_link_logo"]["tmp_name"],$varstpath);
			$image=explode('/',$varstpath, 2);
		}
		else
		{
			$varstpath=$_POST['social_link_logo1'];
			$image[1]=$varstpath;
			
		}
		if($status=='')
		{
			$status=0;	
		}

		$sql="update  social_links_table set social_link_title='$title',social_link_logo='$image[1]',social_link_url='$url',status=$status where social_link_id='".$_POST['social_link_id']."'"; 
		$qry=new Bin_Query();
		if($qry->updateQuery($sql))
		{
			$result = '<div class="alert alert-success">
			<button data-dismiss="alert" class="close" type="button">×</button> Social Link Updated successfully.</div>';
			
		}
		else
		{
			$result = '<div class="alert alert-error">
			<button data-dismiss="alert" class="close" type="button">×</button> Social Link Not Updated successfully.</div>';		
						 
		}	

		return $result;

	}
}
?>