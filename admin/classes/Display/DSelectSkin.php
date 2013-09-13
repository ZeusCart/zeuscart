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
 * This class contains the skin related process
 *
 * @package  		Display_DSelectSkin
 * @category  		Display
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
  * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */
class Display_DSelectSkin
{
	/**
	 * Function  to  display the skin
	 * @param array $arr
	 * @return string
	 */	
	function displaySkin($arr)
	{
		$output = "";
		
		for ($i=0;$i<count($arr);$i++)
		{
			if($arr[$i]['skin_name']==$_POST['skingroup'])
				$output .= '<div class="span3"><label>'.$arr[$i]['skin_name'].'</label><input type="radio" name="skingroup" checked="checked" value="'.$arr[$i]['skin_name'].'" /></div>';
			else
				$output .= '<div class="span3"><label>'.$arr[$i]['skin_name'].'</label><input type="radio" name="skingroup" value="'.$arr[$i]['skin_name'].'" /></div>';
		}
			
			return $output;
	}	
	/**
	 * Function  to  display the skin with seleted skin
	 * @param array $arr
	 * @param string $selSkin
	 * @return string
	 */	
	function displaySkinWithSelected($arr,$selSkin)
	{
		$output = "";
		
		for ($i=0;$i<count($arr);$i++)
		{
			//if($arr[$i]['skin_name']==$_POST['skingroup'])
				//$output .= '<input type="radio" name="skingroup" checked="checked" value="'.$arr[$i]['skin_name'].'">'.$arr[$i]['skin_name'].'</input><br/>';
			if($arr[$i]['skin_name']==$selSkin)
				$output .= '<div class="span3"><label>'.$arr[$i]['skin_name'].'</label><input type="radio" name="skingroup" checked="checked" value="'.$arr[$i]['skin_name'].'"></input></div>';
			else
				$output .= '<div class="span3"><label>'.$arr[$i]['skin_name'].'</label><input type="radio" name="skingroup" value="'.$arr[$i]['skin_name'].'"></input></div>';
		}
			
			return $output;
	}	
	
}
