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
 * This class contains functions to add a HTML Content into the database
 *
 * @package  		Core_Settings_CContentManagement
 * @category  		Core
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
   * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */

class Core_Settings_CContentManagement
{

	
	/**
	 * Function adds an HTML Content value into the database
	 * 
	 * 
	 * @return string
	 */	 
	 
	function addContent()
	{
		if(trim($_POST['contentname'])!='' && trim($_POST['htmlcontent'])!='')		
		{
			$content=$_POST['contentname'];		
			$sql = "INSERT INTO html_contents_table (html_content_name,html_content) VALUES ('".$content."','".$_POST['htmlcontent']."')";
			$query = new Bin_Query();
			if($query->updateQuery($sql))
				return '<div class="success_msgbox">Content Added Successfully</div>';
		}
		else
		{
			return '<div class="error_msgbox">Field Can not be Blank</div>';
		}			

	}
	
}
?>