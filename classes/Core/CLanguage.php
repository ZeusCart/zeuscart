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
 * This class contains the function related to the language translation 
 *
 * @package   		Core_CLanguage
 * @category    	Core
 * @author    		AJ Square Inc Dev Team
 * @link   		http://www.zeuscart.com
 * @copyright 	        Copyright (c) 2008 - 2013, AJ Square, Inc.
 * @version   		Version 4.0
 */

class Core_CLanguage
{

	
	/**
	 * This function is used to set the language.
	 * @param  char $filename
	 * 
	 */
	public function setLanguage($filename='')
	{	

		$sql="SELECT * FROM admin_settings_table WHERE set_id='1'";
		$obj=new Bin_Query();
		$obj->executeQuery($sql);
		$language=$obj->records[0]['site_language'];
		
		$_SESSION['site_language']=$language;

		include_once('Language/'.$language.'/COMMON.php');

		if($filename!='')
		{
			$languageFile='Language/'.$language."/".$filename.'.php';

			include_once($languageFile);
		}
	}

	/**
	 * This function is used to set the language.
	 * @param  char $value
	 * 
	 */
	public function _($value)
	{
		if (defined($value)) {
			return constant($value);
		}
		else
		{
			return $value;
		}

	}

	/**
	 * This function is used to set the stylesheet
	 * @param  char $value
	 * 
	 * 
	 */
	function setStyleSheets($value)
	{
			$template=$_SESSION['template'];
				
			if(file_exists('assets/'.$template.'/css/'.$value))
			{

				$result='<link href="'.$_SESSION['base_url'].'/assets/'.$template.'/css/'.$value.'" rel="stylesheet">';	

			}
			else
			{
				
				$result='<link href="'.$_SESSION['base_url'].'/assets/default/css/'.$value.'" rel="stylesheet">';	
			}

			return $result;
		
	}

	/**
	 * This function is used to set the javascript files
	 * @param  char $value
	 * 
	 * 
	 */
	function setScript($value)
	{
			$template=$_SESSION['template'];
		
			if(file_exists('assets/'.$template.'/js/'.$value))
			{


				$result='<script src="'.$_SESSION['base_url'].'/assets/'.$template.'/js/'.$value.'"></script>';
			}
			else
			{
				
				$result='<script src="'.$_SESSION['base_url'].'/assets/default/js/'.$value.'"></script>';
			}

			return $result;
		
	}
	/**
	 * This function is used to set the display files
	 * @param  char $value
	 * 
	 * 
	 */
	function setDisplay($value)
	{
			$template=$_SESSION['template'];


			if(file_exists('classes/Display/'.$template.'/'.$value))
			{


				$result=include_once('classes/Display/'.$template.'/'.$value);
			}
			else
			{
				
				$result=include_once('classes/Display/default/'.$value);			
			}		
			return $result;

	}

	
}


?>