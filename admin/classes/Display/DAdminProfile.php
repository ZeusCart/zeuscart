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
 * This class contains functions to display the admin profile process
 *
 * @package  		Display_DAdminProfile
 * @category  		Display
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
  * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */
class Display_DAdminProfile
{
	/**
	 * Function  to  display the admin profile
	 * @param array $arr
	 * 
	 * @return string
	 */	
	function showAdminProfile($arr,$arr1,$Err)
	{
// print_r($arr);exit;
		if(!empty($Err->messages))
		{
			$arr=$Err->values;
			$arr1=$Err->values;
		}
		else
		{
			$arr=$arr;
			$arr1=$arr1;
		}

		$output.='<div class="row-fluid">
   		 <div class="span6">
	        <label>Admin Name <font color="red">*</font>  </label>
		<input type="text" name="admin_name"  value="'.$arr['admin_name'].'" class="span8" />
		</div></div>

		<div class="row-fluid">
   		 <div class="span6">
	        <label>Admin Email <font color="red">*</font>  </label>
		<input type="text" name="admin_email"  value="'.$arr1['admin_email'].'" class="span8" />
		</div></div>
		
		<div class="row-fluid">
   		 <div class="span6">
	        <label>Admin Password </label>
		<input type="text" name="admin_password"  class="span8" />
		</div></div>	';

		return $output;
	}
}
?>