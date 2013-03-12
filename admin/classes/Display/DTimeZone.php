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
 * This class contains functions to display the time zone
 *
 * @package  		Display_DTimeZone
 * @category  		Display
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
  * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */
class Display_DTimeZone
{
	/**
	 * Function  to display   the  time zone
	 * @param array $arr
	 * @param integer $selTime
	 * @return string
	 */	
 	function timeZone($arr,$selTime)
	{
		$count=count($arr);
		$output = '<select name="timezone" class="combo_box2" id="cbosubcat" '.$fun.'>';
		$output .= '<option value="">Select</option>';	
		for ($i=0;$i<$count; $i++)
		{
			//if($_POST['timezone']!=	$arr[$i]['tz_timezone'])
			if($selTime !=$arr[$i]['tz_timezone'])
				$output .= '<option value="'.$arr[$i]['tz_timezone'].'">'.$arr[$i]['tz_timezone'].$hassub.'</option>';
			else
				$output .= '<option value="'.$arr[$i]['tz_timezone'].'" selected>'.$arr[$i]['tz_timezone'].$hassub.'</option>';
		}
		$output .= '</select>';	
		return $output;
	}	
}
?>