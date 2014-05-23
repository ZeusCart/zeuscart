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
 * This class contains functions to dispay the site logo related process.
 *
 * @package  		Display_DSiteLogo
 * @category  		Display
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
  * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */
 class Display_DSiteLogo
{

	/**
	 * Function  to  display the site logo
	 * @param array $arr
	 * 
	 * @return string
	 */	
 	function siteLogo($arr)
	{
		$output='';
		if(file_exists(ROOT_FOLDER . $arr[0]['set_value']))
		{
			$output = '
			<div class="row-fluid">
   			 <div class="span2" style="margin-top:30px;">
	      		 <label>Site Logo</label></div> <div class="span10" style="float:left;">
		  
		   	<img src="'.ROOT_FOLDER.$arr[0]['set_value'].'" name="logo" /></div></div>';	
		}			
		return $output;
	}
}
?>