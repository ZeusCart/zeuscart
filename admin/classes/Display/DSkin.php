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
 * This class contains functions to display the skin process
 *
 * @package  		Display_DSkin
 * @category  		Display
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
  * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */
class Display_DSkin
{
	/**
	 * Function  to  display the site skin
	 * @param array $arr
	 * 
	 * @return string
	 */	
	function displaySkin($arr)
	{
		$output = '<ul>';
		
		for ($i=0;$i<count($arr);$i++)
		{
			
				$output .= '<li class="list">'.$arr[$i]['skin_name'].'</li>';
			
					
		}
			
			return $output.'</ul>';
	}
}
