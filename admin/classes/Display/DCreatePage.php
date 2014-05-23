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
 * This class contains functions to list out the custom pages available.
 *
 * @package  		Display_DCreatePage
 * @category  		Display
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
   * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */




class Display_DCreatePage
{
	/**
	 * Function returns all the custom pages available. 
	 * @param array $arr
	 *
	 * @return string
	 */
	function showCustomPage($arr)
	{
		if(count($arr) < 1)

			$output .='<div width="100%" class="exc_msgbox">No custom page is created still now.</div>';
				
		else 
		{
			$output = '<table width="100%" border="0" cellpadding="0" cellspacing="0" class="content_list_bdr">
			<tr>
			<td align="center" class="content_list_head">S.No</td>
			<td class="content_list_head" align="left">Page Name</td>				
			<td class="content_list_head" align="left">Page Url</td>
					<td class="content_list_head" align="center">Delete</td>
					<td class="content_list_head" align="center">Visibility</td>				
			</tr>
			<tr>
			<td colspan="5" class="cnt_list_bot_bdr"><img src="images/list_bdr.gif" alt="" width="1" height="2" /></td>
			</tr>';
			//$output.='<th>S.no.</th><th>Page Url</th>';
			for ($i=0;$i<count($arr);$i++)
			{
				$status='';
				if($arr[$i]['status']==1)
					$status='checked';
			
				if($i % 2 == 0)
					$classtd='class="content_list_txt1"';
				else
					$classtd='class="content_list_txt2"';
				$output.='<input type="hidden" name="mainindex" value="">';
				$output .= '<tr style="background-color:#FFFFFF;" onmouseout="listbg(this, 0);" onmouseover="listbg(this, 1);">
				<td '.$classtd.' align="center">'.($i+1).'</td>
				<td '.$classtd.' align="left">'.$arr[$i]['page_name'].'</td>
				<td '.$classtd.' align="left">'.$arr[$i]['page_url'].'</td>
				<td '.$classtd.' align="center"><a href="?do=createpage&action=deletepage&pageid='.$arr[$i]['page_id'].'" 
				onclick="return confirm(\'Are you sure want to Delete this Page?\')" class="delete_bttn">&nbsp;</a> 
				</td>
				<td '.$classtd.' align="center"><input type="checkbox" name="chkStatus[]" '.$status.' value="'.$arr[$i]['page_id'].'" /></td>
				</tr>';
			}
						$output .= '
						<tr><td colspan="5" align="center" class="content_list_txt1"><input type=submit value="Update Page Settings" class="all_bttn"></td></tr>
						</table>';
	
		}
		return $output;
	}
}
?>