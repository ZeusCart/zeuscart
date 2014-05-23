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
 * This class contains functions related to dynamic cms
 *
 * @package  		Display_DDynamicCms
 * @category  		Display
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
   * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */

class Display_DDynamicCms
{
	/**
	 * Stores the value
	 *
	 * @var array 
	 */	
	//$val = array();
	/**
	 * Stores the output
	 *
	 * @var array 
	 */	
	//$output = array();

	/**
	 * Function to show Dynamic CMS detail. 
	 * @param array $arr
	 * @param integer $flag	 
	 * @param integer $paging
	 * @param integer $prev	 
	 * @param integer $next	 
	 * @return string
	 */
	function showDynamicCmsList($arr,$flag,$paging,$prev,$next)
	{
		$output = '';
		$output.='<form action="?do=dynamiccms&action=delete" method="post"  id="dynamicPagedeleteForm">
		<table cellspacing="0" cellpadding="0" border="0"  class="table table-striped table-bordered  table-hover">

		<thead class="green_bg">
		<tr>
		<th align="left"><input type="checkbox"  onclick="toggleChecked(this.checked)" name="dynamiccheckall"></th>
		<th align="left">S.No</th>
		<th align="left">Title</th>
		<th align="left">Alias</th>
	
		<th align="left">Status</th>
		</tr>
		</thead>
		<tbody>';

		$cnt = count($arr);

		if($flag=='0')
			$output .= '<tr><td align="center" colspan="6"><font color="orange"><b>No Record Found</b></font></td></tr>';
		else
		{
			for ($i=0;$i<count($arr);$i++)
			{
			
				$output.='';
				$output .= '<tr ><td><input type="checkbox" name="dynaminPagecheck[]" class="chkbox" value="'.$arr[$i]['cms_id'].'"></td><td >'.($i+1).'</td><td><a href="?do=dynamiccms&action=edit&id='.$arr[$i]['cms_id'].'">'.$arr[$i]['cms_page_title'].'</a></td><td>'.$arr[$i]['cms_page_alias'].'</td>';				
				if($arr[$i]['cms_page_status']==0)
				{
					$output .='<td align="center"><span class="badge badge-info">Inactive</span></td>';
				}
				else
				{
					$output .='<td align="center"><span class="badge badge-important">Active</span></td>';
				}
				
				// $output .='<td align="center"><a class="edit_bttn" href="?do=dynamiccms&amp;action=edit&amp;id='.
				// $arr[$i]['cms_id'].'">&nbsp;</a>&nbsp;<a href="?do=dynamiccms&action=delete&id='.$arr[$i]['cms_id'].'" onclick="javascript:return condelete()" class="delete_bttn"> &nbsp;<!--Delete--> </a></td></tr>';
				$output .='</tr>';
			}
		
		$output .='<tr>
			<td colspan="6" class="clsAlignRight">
			<div class="dt-row dt-bottom-row">
			<div class="row-fluid">
			<div class="dataTables_paginate paging_bootstrap pagination">
			<ul>'.$prev.' ';
		
		for($i=1;$i<=count($paging);$i++)
			$pagingvalues .= $paging[$i]."  ";
		
		$output .= $pagingvalues.' '.$next.'</ul></div>
			</div>
			</div>
			</td>
			</tr>';

		}
		$output .= '</tbody></table>';
		return $output;

	}
	
	

}

?>