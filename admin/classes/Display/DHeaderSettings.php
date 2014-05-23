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
 * This class contains functions to get the list of Footer Settings available.
 *
 * @package     Display_DFooterSettings
 * @category      Display
 * @author        AjSquareInc Dev Team
 * @link      http://www.zeuscart.com
   * @copyright     Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version     Version 4.0
 */


class Display_DFooterSettings
{
 	
	/**
	 * Function generates a template for the footer settings available. 
	 * @param array $arr
	 * @return string
	 */
	
	
	function showFooterLink($arr)
	{
		$output = "";		
		$output .= '<table border="1"><tr>';
		for ($i=0;$i<count($arr);$i++)
		{
		 $output .='<td><a href=userpage/'.$arr[$i]['link_url'].' name="link" >'.$arr[$i]['link_name'].'</a> | </td>';
		}
		
		return $output;
	}
}
?>
           <!-- <table border="0" cellpadding="0" cellspacing="0" width="100%">
      <tbody><tr>
        <td><img src="images/spacer_18.gif" alt="" height="18" width="4"></td>
      </tr>
      <tr>
        <td class="footer_tbdr"><table align="center" border="0" cellpadding="0" cellspacing="0" width="96%">
          <tbody><tr>
            <td colspan="2"><img src="images/spacer_16.gif" alt="" height="16" width="4"></td>
          </tr>

          <tr>
            <td align="left" width="58%"><a href="?do=aboutus" class="home_link">About Us</a> | <a href="?do=announcements" class="home_link">Announcements</a>  <a href="?do=security" class="home_link">Security Center</a> | <a href="?do=policies" class="home_link">Policies</a> | <a href="?do=index" class="home_link">Government Relations</a> | <a href="?do=index" class="home_link">Site Map</a> | <a href="?do=index" class="home_link">Help</a></td>

            <td rowspan="2" align="right" width="42%"><img src="images/paypal.gif" alt="" height="25" width="239"></td>
          </tr>
          <tr>
            <td class="footer" align="left">Copyright ? 2008-2010 Trade-mall.com. All Rights Reserved.</td>
            </tr>
          <tr>
            <td colspan="2"><img src="images/spacer_16.gif" alt="" height="16" width="4"></td>
          </tr>

        </tbody></table></td>
      </tr>
    </tbody></table>            -->