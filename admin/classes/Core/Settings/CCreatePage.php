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
 * This class contains functions to get the style details from the database 
 *
 * @package  		Core_Settings_CreatePage
 * @category  		Core
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
   * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */

class Core_Settings_CreatePage 
{
	
	/**
	 * Function uploads a css file into the specified folder
	 * 
	 * 
	 * @return void
	 */	 	
	

	function uploadCssFile()
	{
		if(isset($_FILES['css_file']['tmp_name']))
		{
		
			$spath=$_FILES['css_file']['tmp_name'];
			$dpath=ROOT_FOLDER.'userpage/css/'.$_FILES['css_file']['name'];
			$file= new Lib_FileOperations();
			$file->uploadFile($spath,$dpath);
		}
	}
	
	/**
	 * Function uploads a JS file into the specified folder
	 * 
	 * 
	 * @return void
	 */	 

	function uploadJsFile()
	{
		if(isset($_FILES['js_file']['tmp_name']))
		{
			$spath=$_FILES['js_file']['tmp_name'];
			$dpath=ROOT_FOLDER.'userpage/script/'.$_FILES['js_file']['name'];
			$file= new Lib_FileOperations();
			$file->uploadFile($spath,$dpath);
		}
	}
	
	
	/**
	 * Function creates a dynamic page  
	 * @param string $pagename
	 * @param string $str
	 * @return bool
	 */	 
	
	function createDyanamicPage($pagename,$str)
	{

		$file_types=array('html','htm','php');
		$tmp=explode('.',trim($pagename));
		
		
		if(in_array($tmp[1],$file_types)) // checking whether the file is in one of the formats .htm , .html or .php
		{
					
			 $this->uploadCssFile();
			 $this->uploadJsFile();						
			 
			return $this->CreateFile(ROOT_FOLDER.$pagename,'w',$str);
		}
		else
			return false;
	}
	
	
	/**
	 * Function creates a new file in the specified path 
 	 * 
	 * @param string $filename
	 * @param string $mode
	 * @param string $str2write	 
	 *
	 * @return bool
	 */	 
	
	
	function CreateFile($filename,$mode,$str2write='')
	{
			$fp=fopen($filename,$mode);			
			if($fp)
			{
				fwrite($fp,$str2write);
				fclose($fp);
				return true;
			}
			else
				return false;
	}
	
	/**
	 * Function creates a new HTML page 
 	 * 
	 *
	 * @return string
	 */	 	
	
	function createPage() 
	{
		if(isset ($_POST['button']))
		{
		$title=$_POST['page_title'];
		$body=$_POST['bodycontent'];
		$meta=$_POST['meta_content'];
		$metakey=$_POST['meta_key'];
		$pagename=$_POST['page_name'];

			
		if(!empty($_FILES['js_file']['name']))
		{	
		  $jsfilename= $_FILES['js_file']['name'];
		  $legaljs_extentions = array("js");  
		  $file = explode(".",$_FILES['js_file']['name']);	
		  if(count($file) > 2  || $file[1] != 'js')
		  {			
  			return '<div class="error_msgbox">The file you are attempting to upload is not supported by this server</div>';		
		  }	 	
			
		  $file_ext = strtolower(end(explode(".",$_FILES['js_file']['name'])));	
		  if (!in_array ($file_ext, $legaljs_extentions))
		  {
  		  return '<div class="error_msgbox">The file you are attempting to upload is not supported by this server</div>';		
          	  }
		}
	
		if(!empty($_FILES['css_file']['name']))
		{
		  $cssfilename= $_FILES['css_file']['name'];
		  $legalcss_extentions = array("css");  
		  $cssfile = explode(".",$_FILES['css_file']['name']);	
		
		  if(count($cssfile) > 2  || $cssfile[1] != 'css')
		  {			
  			return '<div class="error_msgbox">The file you are attempting to upload is not supported by this server</div>';		
		  }	 	
			
		  $file_ext = strtolower(end(explode(".",$_FILES['css_file']['name'])));	
		  if (!in_array ($file_ext, $legalcss_extentions))
		  {
  		  return '<div class="error_msgbox">The file you are attempting to upload is not supported by this server</div>';		
          	  }		
		}	
		
		
		
		if(get_magic_quotes_gpc())
		{
			$title = stripslashes($title);
			$body=stripslashes($body);
			$meta=stripslashes($meta);
			$metakey=stripslashes($metakey);
			$pagename=stripslashes($pagename);
		}
		$pagename='userpage/'.$pagename;
		$cssfilepath=$_FILES['css_file']['name'];
		$jsfilepath=$_FILES['js_file']['name'];
		$writeString="<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'><html xmlns='http://www.w3.org/1999/xhtml'>
		<head><title>".$title."</title><meta name='description' content='". $meta . "' /><meta name='keywords' content='".$metakey."' /><link href='css/".$cssfilepath."' rel='stylesheet' type='text/css' />  
		<script type='text/javascript' src='script/".$jsfilepath."'></script></head><body>".$body."</body></html>";		
		
		$default = new Core_Settings_CreatePage();
		if($default->createDyanamicPage($pagename,$writeString))
		if($default->addPageSettings($pagename))
			return $msg= '<div class="success_msgbox">Page '. $pagename  .' Created successfully</div> ';
		else
			return $msg = '<div class="error_msgbox">Error while creating the page "' . $pagename . '"</div>' ;
	}
}	
		
	/**
	 * Function inserts the page name into the custom page table 
 	 * 
	 * @param string $pagename
	 * @return string
	 */	 	

	function addPageSettings($pagename)
	{
		$sql = "INSERT INTO custompage_table (page_name,page_url) VALUES ('".$_POST['page_title']."','".$pagename."')";
		$query = new Bin_Query();
		if($query->updateQuery($sql))
			return $msg= '<div class="success_msgbox">Page '. $pagename  .' Created successfully</div> ';
				
	}
	
	/**
	 * Function gets all the custom pages from the custom page table 
 	 * 
	 * 
	 * @return string
	 */	 	
	
	function showCustomPage()
	{
		$sql = "SELECT * FROM custompage_table order by page_name ";
		$query = new Bin_Query();
		$query->executeQuery($sql);
		return Display_DCreatePage::showCustomPage($query->records);
	}
	
	
	/**
	 * Function deletes the selected custom page from the database
 	 * 
	 * 
	 * @return string
	 */	 	
	
	function deleteCustomPage()
	{
		$sql="DELETE FROM custompage_table WHERE page_id=".mysql_escape_string(intval($_GET['pageid']));
		$query = new Bin_Query();
		if($query->updateQuery($sql))
		{
			return '<div class="success_msgbox">Page Deleted successfully</div> ';
		}
	}
	
	/**
	 * Function updates the changes made in the selected custom page table 
 	 * 
	 * 
	 * @return void
	 */	 	
	
	function updateStatus()
	{
		$query = new Bin_Query();
		$query->updateQuery("update custompage_table set status=0");
		for($i=0;$i<count($_POST['chkStatus']);$i++)
		{
			$sql="update custompage_table set status=1 WHERE page_id=".$_POST['chkStatus'][$i];
			$query->updateQuery($sql);
		}
	}
	
}
?>