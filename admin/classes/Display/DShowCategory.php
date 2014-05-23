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
 * This class contains the category related process
 *
 * @package  		Display_DShowCategory
 * @category  		Display
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
 * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */
class Display_DShowCategory
{

	/**
	 * Function  to  display the category
	 * @param array $arr
	 * @return string
	 */	
	function showCategory($arr)
	{
		$output = "";
		
		$output .='<img src="'.$arr[0]['category_image'].'" name="image1"  id="image1"/>';
		$output .= '<table border="1">';
		$output.='<th>S.no.</th><th>Category Name</th><th>Category Description</th><th>Category Icon</th><th colspan="2">Options</th>';
		for ($i=0;$i<count($arr);$i++)
		{

			$output.='<input type="hidden" name="mainindex" value="">';
			$output .= '<tr><td>'.($i+1).'</td><td>'.$arr[$i]['category_name'].'</td><td>'.$arr[$i]['category_desc'].'</td>';
			$output .='<td width=""><img src="'.$arr[$i]['category_image'].'" name="image1"  id="image1"/></td>';
			$output.='<td><input type="button" name="Edit"  title="Edit" value="Edit" onclick=edit('.$arr[$i]['category_id'].') /></td>';
			$output.='<td><input type="button" name="Delete"  title="Delete" value="Delete" onclick=callcatids('.$arr[$i]['category_id'].') /></td></tr>';
			
		}
			$output .= '</table>';
			return $output;
	}
}