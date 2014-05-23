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
 * This class contains functions to set the admin email id.
 *
 * @package  		Display_DDomainName
 * @category  		Display
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
  * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */


class Display_DDomainName 
{
	/**
	 * Function display the domain name id for edit. 
	 * @param array $arr
	 * @return string
	 */
	function domainName($arr)
	{

		$output = '  <form name="site" action="?do=domainname&action=update" method="post" ><table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
		<td align="left">&nbsp;</td>
			</tr>
			<tr><td width="24%" align="left" class="content_form">
		Domain Name:</td>
			<td width="26%" class="content_form" >
		<input type="text" name="name"  value="'.$arr[0]['set_value'].'" class="txt_box250" /> </td>
		
		<td>&nbsp;</td>
		</tr><tr><td colspan="2"  align="center" class="content_form" >
		<input type="submit" name="domainname" class="all_bttn" value="Update Domain Name" /></td>
		<td>&nbsp;</td>
		</tr></table>  ';
			
		return $output;
	}
}
?>