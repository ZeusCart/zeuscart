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
class Display_DTimeZone
{
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