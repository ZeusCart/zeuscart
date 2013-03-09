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
 * CCse
 *
 * This class contains functions to  update the cse details.
 *
 * @package		Core_CCse
 * @category	Core
 * @author		ZeusCart Team
 * @link		http://www.zeuscart.com
 * @version 	2.3
 */

// ------------------------------------------------------------------------


class Core_CCse
{
	
	/**
	 * Function updates the cse id into the table
	 * 
	 * 
	 * @return string
	 */
	
	
	function saveCse()
   {
		$registerid = $_POST['regid'];		
		
		if(count($Err->messages) > 0)
		{
			 $output['val'] = $Err->values;
			 $output['msg'] = $Err->messages;
		}
		else
		{
			if( $registerid!= '')
			{
				
				$sql = "update admin_settings_table set set_value='".$registerid."' where set_name='www.pricerunner.com Affiliate ID'";
			$obj = new Bin_Query();
			
			if($obj->updateQuery($sql))
			{
				$result = '<div class="success_msgbox">Added Successfully</div>';
				return $result;
			}
			else
			{
				$result = '<div class="error_msgbox">Not Inserted</div>';
				return $result;
			}
			}
		}
   }
}
?>