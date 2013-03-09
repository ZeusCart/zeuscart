<?php
/**
* GNU General Public License.

* This file is part of ZeusCart V2.3.

* ZeusCart V2.3 is free software: you can redistribute it and/or modify
* it under the terms of the GNU General Public License as published by
* the Free Software Foundation, either version 3 of the License, or
* (at your option) any later version.
* 
* ZeusCart V2.3 is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
* GNU General Public License for more details.
* 
* You should have received a copy of the GNU General Public License
* along with Foobar. If not, see <http://www.gnu.org/licenses/>.
*
*/
class Display_DSelectSkin
{
	function displaySkin($arr)
	{
		$output = "";
		
		for ($i=0;$i<count($arr);$i++)
		{
			if($arr[$i]['skin_name']==$_POST['skingroup'])
				$output .= '<input type="radio" name="skingroup" checked="checked" value="'.$arr[$i]['skin_name'].'">'.$arr[$i]['skin_name'].'</input><br/>';
			else
				$output .= '<input type="radio" name="skingroup" value="'.$arr[$i]['skin_name'].'">'.$arr[$i]['skin_name'].'</input><br/>';
		}
			
			return $output;
	}	
	function displaySkinWithSelected($arr,$selSkin)
	{
		$output = "";
		
		for ($i=0;$i<count($arr);$i++)
		{
			//if($arr[$i]['skin_name']==$_POST['skingroup'])
				//$output .= '<input type="radio" name="skingroup" checked="checked" value="'.$arr[$i]['skin_name'].'">'.$arr[$i]['skin_name'].'</input><br/>';
			if($arr[$i]['skin_name']==$selSkin)
				$output .= '<input type="radio" name="skingroup" checked="checked" value="'.$arr[$i]['skin_name'].'">'.$arr[$i]['skin_name'].'</input><br/>';
			else
				$output .= '<input type="radio" name="skingroup" value="'.$arr[$i]['skin_name'].'">'.$arr[$i]['skin_name'].'</input><br/>';
		}
			
			return $output;
	}	
	
}
