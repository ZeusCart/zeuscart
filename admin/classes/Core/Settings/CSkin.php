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
 * This class contains functions to get the skin details from the table  
 *
 * @package  		Core_Settings_CSkin
 * @category  		Core
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
   * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */



class Core_Settings_CSkin 
{
	
	/**
	 * Stores the output
	 *
	 * @var array $output
	 */		
	var $output = array();
	
	/**
	 * Function gets the skin details from the table 
	 * 
	 * 
	 * @return string
	 */	 		
	function displaySkin()
	{
		include("classes/Display/DSkin.php");
		
			$sql = "SELECT * FROM `skins_table`";
			$query = new Bin_Query();
			
			if($query->executeQuery($sql))
			{		
				
				return Display_DSkin::displaySkin($query->records);
			}
			else
			{
				//$output['showskin'] = "No skin Found";
			}
			
	}
	
	/**
	 * Function updates the style settings into the database 
	 * 
	 * 
	 * @return bool
	 */	 			
	
	function addSkin()
	{
			

		return $this->uploadZipFile();
		/*$skinname=$_POST['skinname'];
		$mypath=$skinname;
   		mkdir( "themes/".$mypath);*/
	}
	
	/**
	 * Function adds a new skin into the database 
	 * 
	 * 
	 * @return string
	 */	 		
	
	function insertSkin()
	{
		
			$sql = "INSERT INTO skins_table (skin_name,skin_status) VALUES ('".$_POST['skinname']."',0)";
			$query = new Bin_Query();
			if($query->updateQuery($sql))
			{
				UNSET($_SESSION['skinname']);
				return '<div class="alert alert-success">
			<button data-dismiss="alert" class="close" type="button">×</button> Updated Successfully</div>';
				//$_SESSION['msg']= "Added Successfully";
			}
			else
			{
				UNSET($_SESSION['skinname']);
				return '<div class="alert alert-error">
			<button data-dismiss="alert" class="close" type="button">×</button>  Problem while insert</div>';
				//$_SESSION['msg']= "Problem while insert";
			}
	
	}
	
	/**
	 * Function gets a zip file and checks whether it is a zip compression archive or not 
	 * 
	 * 
	 * @return string
	 */	 			
	private function uploadZipFile()
	{

		if( $_POST['skinname']=='')
		{
			return '<div class="alert alert-error">
			<button data-dismiss="alert" class="close" type="button">×</button> Please Enter The Skin Name</div>';	

		}
		else
		{
		
			$tsvfilename= $_FILES['zip_file']['name'];
			$legal_extentions = array("zip");  
			$file = explode(".",$_FILES['zip_file']['name']);	
			if(count($file) > 2  || $file[1] != 'zip')
			{			
				return '<div class="alert alert-error">
				<button data-dismiss="alert" class="close" type="button">×</button> The file you are attempting to upload is not supported by this server</div>';		
			}	 	
				
			$file_ext = strtolower(end(explode(".",$_FILES['zip_file']['name'])));	
			if (!in_array ($file_ext, $legal_extentions))
			{
			return '<div class="alert alert-error">
				<button data-dismiss="alert" class="close" type="button">×</button> The file you are attempting to upload is not supported by this server</div>';		
			}		
	
			if(isset($_FILES['zip_file']['tmp_name']))
			{
				$spath=$_FILES['zip_file']['tmp_name'];			
				if ( $_POST['skinname']!='')
				{
	
					if($_FILES['zip_file']['type']=='application/zip'|| $_FILES['zip_file']['type']=='application/x-zip-compressed' )
					{
	
						$dpath=ROOT_FOLDER."assets/css/".$_POST['skinname'].".zip"; 
						$file= new Lib_FileOperations();
						$file->uploadFile($spath,$dpath);			
						return $this->extractZip($dpath);
					}
					else 
						return '<div class="alert alert-error">
				<button data-dismiss="alert" class="close" type="button">×</button> Please Upload Zip File</div>';			
				}
				
			}

		}
	}
	
	
	/**
	 * Function extracts the contents of the zip archive into a the specified path 
	 * 
	 * @param string $zipfilename
	 * @return string
	 */	 		
	
	private function extractZip($zipfilename)
   	{

		$zip = new ZipArchive;
		$zipfilename;
		if ($zip->open($zipfilename) === TRUE)
			 {
			 	
					$unzippath=ROOT_FOLDER.'assets/css/'.$_POST['skinname'].'/';
    				$zip->extractTo($unzippath);
   				 	$zip->close();
					unlink($zipfilename);
   				 	return $this->insertSkin();					
			 }
		else 
			{

   				 echo 'Failed to Extract ';
			}
	}				
	
}

?>