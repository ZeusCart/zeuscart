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

/**
 * DCategoryManagement
 *
 * This class contains functions to list out the attributes.
 *
 * @package		Display_DCategoryManagement
 * @category	Display
 * @author		ZeusCart Team
 * @link		http://www.zeuscart.com
 * @version 	2.3
 */

// ------------------------------------------------------------------------


class Display_DCategoryManagement
{
	
	/**
	 * Function display the attributes. 
	 * @param array $arr	 
	 * @param integer $val	 
	 * @return string
	 */
	
	function showAttributes($arr,$val)
	{
		if($val[0]==0)
			$alert="selected='selected'";
		else
			$alert="";
		$output = "<select name='attributes[]' multiple='multiple' size='15' style='width:199px'><option value=''".$alert.">No Attribute(s)</option>";
		for ($i=0;$i<count($arr);$i++)
		{
			if(in_array($arr[$i]['attrib_id'],$val))
			{
				
				$output.='<option value="'.$arr[$i]['attrib_id'].'" selected="selected">'.$arr[$i]['attrib_name'].'</option>';
			}
			else
			{
				$output.='<option value="'.$arr[$i]['attrib_id'].'">'.$arr[$i]['attrib_name'].'</option>';
			}
			
		}
			$output.='</select>';
			return $output;
	}
}
?>