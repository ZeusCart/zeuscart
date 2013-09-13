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
 * This class contains functions to get and update the site logo into the database 
 *
 * @package  		Core_Settings_CSiteLogo
 * @category  		Core
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
   * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */

class Core_Settings_CSiteLogo
{
 	/**
	 * Function gets the site logo details from the database 
	 * 
	 * 
	 * @return string
	 */	 	
	 
	function siteLogo()
	{
		$sql = "SELECT set_name,set_value FROM `admin_settings_table` where set_name='Site Logo'";
		$query = new Bin_Query();
		if($query->executeQuery($sql))
		{		
			return Display_DSiteLogo::siteLogo($query->records);
		}
	}
	
	
	/**
	 * Function updates the changes in the site logo into the database 
	 * 
	 * 
	 * @return string
	 */	 	
	
	function updateSiteLogo()
	{

		$imagetypes=array ('image/jpeg' ,'image/pjpeg' , 'image/bmp' , 'image/gif' , 'image/png','image/x-png');	
		 $filetypename= $_FILES['logo']['type'];
		 $file = explode("/",$_FILES['logo']['type']);		
			
		  if(count($file) > 2  || !in_array($_FILES['logo']['type'],$imagetypes))
		  {			
  			return '<div class="alert alert-error">
    <button type="button" class="close" data-dismiss="alert">×</button> Invalid image file format</div>';	
		  }	 

		include('classes/Lib/FileOperations.php');
		include("classes/Lib/ThumbImage.php");
		if($_FILES['logo']['name']!='')
		{
			$sfile=$_FILES['logo']['tmp_name'];
			$dbpath="images/logo/".date("Y-m-d-His").$_FILES['logo']['name'];		
			
			$file= new Lib_FileOperations();
			$file->uploadFile($sfile,ROOT_FOLDER.$dbpath);
			
			list($img_w,$img_h, $type, $attr) = getimagesize($sfile);			

			if($img_h > 70)
				return '<div class="alert alert-error">
    <button type="button" class="close" data-dismiss="alert">×</button>The Height of the logo should be lessthan or equal to 70px to suit properly.</div>';				
			
			if($img_w > 253)
				new Lib_ThumbImage('thumb',ROOT_FOLDER.$dbpath,ROOT_FOLDER."images/logo",253);
			
			$sql = "UPDATE admin_settings_table SET set_value='".$dbpath."' where set_name='Site Logo'";
			$query = new Bin_Query();
			if($query->updateQuery($sql))
				return '<div class="alert alert-success">
    <button type="button" class="close" data-dismiss="alert">×</button> Logo updated Successfully</div>';
			else
				return '<div class="alert alert-error">
    <button type="button" class="close" data-dismiss="alert">×</button> Error while updating logo!</div>';
		}	
		else
		 	return '<div class="alert alert-error">
    <button type="button" class="close" data-dismiss="alert">×</button> Invalid image file.Please try again !</div>';
	}
	
}
?>