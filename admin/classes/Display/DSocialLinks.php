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
 * This class contains functions to list out the social links available.
 *
 * @package  		Display_DSocialLinks
 * @category  		Display
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
   * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */




class Display_DSocialLinks
{
	/**
	 * Function returns all the custom pages available. 
	 * @param array $arr
	 *
	 * @return string
	 */
	function showSocialLinks($arr)
	{
		if(count($arr) < 1)
			$output .='<div width="100%" class="exc_msgbox">No social link  is created still now.</div>';

		else 
		{
			$output = '<table cellspacing="0" cellpadding="0" border="0"  class="table table-striped table-bordered  table-hover">

			<thead class="green_bg">
			<tr>
			<th><input type="checkbox"  onclick="toggleChecked(this.checked)" name="socialcheckall"></th>
			<th>S.No</th>
			<th>Title</th>				
			<th>Logo</th>
			<th>Url</th>
			<th>Status</th>				
			</tr>

			</thead>
			<tbody>';
			for ($i=0;$i<count($arr);$i++)
			{

				if($arr[$i]['status']==1)
				{
					$status='<span title="Active" class="active_link" title="Active">Active</span>';
				}
				else
				{
					$status='<span title="Inactive" class="inactive_link" title="Suspend">Inactive</span>';
				}


				$output.='<input type="hidden" name="mainindex" value="">';
				$output .= '<tr >
				<td><input type="checkbox" name="socialLinkcheck[]" class="chkbox" value="'.$arr[$i]['social_link_id'].'"></td>
				<td >'.($i+1).'</td>
				<td><a href="?do=sociallink&action=edit&id='.$arr[$i]['social_link_id'].'">'.$arr[$i]['social_link_title'].'</a></td>
				<td><img src="../'.$arr[$i]['social_link_logo'].'"  ></td>
				<td>'.$arr[$i]['social_link_url'].'</td>
				
				<td '.$classtd.' align="center">'.$status.'</td>
				</tr>';
			}
			$output .= '
			</tbody>
			</table>';

		}
		return $output;
	}
}
?>