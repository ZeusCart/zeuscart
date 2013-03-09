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
 * DAdminEmailSettings
 *
 * This class contains functions to set the admin email id.
 *
 * @package		Display_DAdminEmailSettings
 * @category	Display
 * @author		ZeusCart Team
 * @link		http://www.zeuscart.com
 * @version 	2.3
 */

// ------------------------------------------------------------------------

class Display_DAdminEmailSettings
{
	/**
	 * Function display the admin email id for edit. 
	 * @param array $arr
	 * @return string
	 */
	function siteEmail($arr)
	{
		//print_r($arr);
		$output = '<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
    <td align="left">&nbsp;</td>
  </tr>
		<tr><td width="24%" align="left" class="content_form">
	       Administrator Email:</td>
		<td width="26%" class="content_form" >
        <input type="text" name="email"  value="'.$arr[0]['set_value'].'" class="txt_box250" /> </td>
        
         <td>&nbsp;</td>
        </tr><tr><td colspan="2"  align="center" class="content_form" >
        <input type="submit" name="emailid" class="all_bttn" value="Update email" /></td>
         <td>&nbsp;</td>
        </tr></table>  ';
			
		return $output;
	}
}
?>