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
 * This class contains functions to get and update the home page banners from the database
 *
 * @package  		Core_Settings_CHomePageBanner
 * @category  		Core
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
   * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */



class Core_Settings_CHomePageBanner
{
	
	/**
	 * Function gets the home page banner details from the database
	 * @param $Err $Err
	 * 
	 * @return string
	 */	 	
	
 	function homePageBanner($Err)
	{
		$sql = "SELECT * FROM `home_slide_show_table` ";
		$query = new Bin_Query();
		$query->executeQuery($sql);
			
			return Display_DHomePageBanner::homePageBanner($query->records,$Err);
		
	}
	
	/**
	 * Function gets the home page banner url from the database
	 * 
	 * 
	 * @return string
	 */	 	
	
	function homePageBannerUrl()
	{
		$sql = "SELECT set_name,set_value FROM `admin_settings_table` where set_name='Homepage Banner URL'";
		$query = new Bin_Query();
		if($query->executeQuery($sql))
		{		
			return Display_DHomePageBanner::homePageBannerUrl($query->records);
		}
		else
		{
			return '<div class="alert alert-success">
    <button type="button" class="close" data-dismiss="alert">×</button> Not Found</div>';
		}
	}
	
	/**
	 * Function updates the changes made in the Home Page slider into the database
	 * 
	 * 
	 * @return string
	 */	 	
	function updateHomePageBanner()
	{


		include('classes/Lib/ThumbImage.php');
		// slide show parameter updation

		$notallowed=array('slide_title','slide_content','slide_caption','theValue','totalcountinner','totalcount','button','slide_url');
		$description=array_diff_key($_POST, array_flip($notallowed));
		if(!empty($description))
		{	
			$sql_para="UPDATE home_slide_parameter_table SET module_name='Parameter',parameter='".json_encode($description)."' WHERE id='1'"; 
			$obj_para=new Bin_Query();
			$obj_para->updateQuery($sql_para);
		}	
	 	$totalcount=count($_POST['theValue']);
		if($totalcount>0)
		{

			for($i=0;$i<$totalcount;$i++)
			{
				$image='';	
				$thumb_image='';	
				if($_POST['slide_content_image'][$i]!='' && $_FILES['slide_content']['name'][$i]=='')
				{
					$image=$_POST['slide_content_image'][$i];
		
					$thumb_image=$_POST['slide_content_thumb'][$i];

					$sqlcheck="SELECT * FROM  home_slide_show_table WHERE id='".$_POST['theValue'][$i]."'"; 
					$objcheck=new Bin_Query();
					if($objcheck->executeQuery($sqlcheck))
					{
						$sqlupdate="UPDATE  home_slide_show_table SET slide_title='".$_POST['slide_title'][$i]."' ,slide_content='".$image."',slide_content_thumb='".$thumb_image."',slide_caption='".trim($_POST['slide_caption'][$i])."',slide_url='".$_POST['slide_url'][$i]."' WHERE id='".$_POST['theValue'][$i]."'";  
						$objupdate=new Bin_Query();
						$objupdate->updateQuery($sqlupdate);
						
						
					}
				}
				elseif($_FILES['slide_content']['name'][$i]!='' )
				{

					$imgfilename= $_FILES['slide_content']['name'][$i];
					$imagefilename = date("Y-m-d-His").$imgfilename ; // generate a new name
							
					$image="images/slidesupload/". $imgfilename; // updated into DB
					$thumb_image="images/slidesupload/thumb/".$imgfilename; // updated into DB
					
					$stpath=ROOT_FOLDER.$image;
					$imageDir=ROOT_FOLDER."images/slidesupload";
					$thumbDir=ROOT_FOLDER."images/slidesupload/thumb";
					
					if(move_uploaded_file($_FILES["slide_content"]["tmp_name"][$i],$stpath))
					{			
						new Lib_ThumbImage('thumb',$stpath,$thumbDir,THUMB_WIDTH);
						
					}
					$sqlcheck="SELECT * FROM  home_slide_show_table WHERE id='".$_POST['theValue'][$i]."'"; 
					$objcheck=new Bin_Query();
					if($objcheck->executeQuery($sqlcheck))
					{
						$sqlupdate="UPDATE  home_slide_show_table SET slide_title='".$_POST['slide_title'][$i]."' ,slide_content='".$image."',slide_content_thumb='".$thumb_image."',slide_caption='".trim($_POST['slide_caption'][$i])."',slide_url='".$_POST['slide_url'][$i]."' WHERE id='".$_POST['theValue'][$i]."'";  
						$objupdate=new Bin_Query();
						$objupdate->updateQuery($sqlupdate);
						
						
					}
					else
					{
						$sql="INSERT INTO home_slide_show_table(slide_title,slide_content,slide_caption,slide_content_thumb,slide_url)VALUES('".$_POST['slide_title'][$i]."','".$image."','".trim($_POST['slide_caption'][$i])."','".$thumb_image."','".$_POST['slide_url'][$i]."')"; 
						$query = new Bin_Query();
						$query->updateQuery($sql);


					}

				
							
				
				}

				
					
			}


			return '<div class="alert alert-success">
    <button type="button" class="close" data-dismiss="alert">×</button> <strong> well done !</strong> Home Page Slider Inserted Successfully</div>';
				

		}	
	}
	
	/**
	 * Function updates the changes made in the Home Page slider into the database
	 * 
	 * 
	 * @return string
	 */

	function deleteHomePageBanner()
	{
		$sqldelete="DELETE FROM home_slide_show_table WHERE id='".$_GET['id']."'";
		$objdelete=new Bin_Query();
		if($objdelete->updateQuery($sqldelete))
		{
			header('Location:?do=banner&action=update');
			exit;
		}


	}
	/**
	 * Function get in the Home Page slider show parameter from the database
	 * @param $Err array
	 * 
	 * @return string
	 */

	function getSlideParameter()
	{
		$sql="SELECT * FROM home_slide_parameter_table WHERE id='1' ";
		$obj=new Bin_Query();
		$obj->executeQuery($sql);
		$records=$obj->records;

		return Display_DHomePageBanner::showSlideParameter($records);
	}
}
?>