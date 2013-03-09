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
class Display_DShowCategory
{
function showCategory($arr)
	{
		$output = "";
		//echo "<pre>";
		//print_r($arr);
		$output .='<img src="'.$arr[0]['category_image'].'" name="image1"  id="image1"/>';
		$output .= '<table border="1">';
		$output.='<th>S.no.</th><th>Category Name</th><th>Category Description</th><th>Category Icon</th><th colspan="2">Options</th>';
		for ($i=0;$i<count($arr);$i++)
		{
		//print_r($arr[$i]['attrib_name']);
		//echo "s",$arr[$i]['category_id'];
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