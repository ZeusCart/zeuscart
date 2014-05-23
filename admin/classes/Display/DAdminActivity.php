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
 * This class contains functions to list the admin visited pages.
 *
 * @package  		Display_DAdminActivity
 * @category  		Display
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
   * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */


class Display_DAdminActivity
{
	
	/**
	 * Function display the admin visited pages. 
	 * @param array $arr
	 * @param integer $paging
	 * @param integer $prev	 
	 * @param integer $next	 
	 * @param integer $val	 
	 * @return string
	 */
	function listActivity($arr,$paging,$prev,$next,$val)
	{
		
		$output = '
		<table cellspacing="0" cellpadding="0" border="0"  class="table table-striped table-bordered  table-hover">
		<thead class="green_bg">
		<tr>
		<th align="left">S.No</th>
		<th align="left">User</th>
		<th align="left">URL</th>
		<th align="left">Visited on</th>

		</tr>
		</thead>
		<tbody>

		';
		
		$URL = "http://".$_SERVER["SERVER_NAME"];		
		if(count($arr)>0)
		{
			for ($i=0;$i<count($arr);$i++)
			{
			/*$visiteddatetime=$arr[$i]['visited_on'];
			$visited_date_time = explode(" ",$visiteddatetime);
			$visited_date = explode("-",$visited_date_time[0]);
			$visited_time = explode(":",$visited_date_time[1]);

			$visiteddate=date("M d, Y H:i:s",mktime($visited_time[0],$visited_time[1],$visited_time[2],$visited_date[1],$visited_date[2],$visited_date[0]));*/
			$visiteddatetime=$arr[$i]['visited_on'];
			$visited_date_time = explode(" ",$visiteddatetime);
			$visited_date = explode("-",$visited_date_time[0]);
			$visited_time = explode(":",$visited_date_time[1]);
			$visiteddate=date("l, M d, Y H:i:s",mktime($visited_time[0],$visited_time[1],$visited_time[2],$visited_date[1],$visited_date[2],$visited_date[0]));
			
			
			
			$output .= '<tr>
			<td>'.($val+1).'</td>
			<td>'.$arr[$i]['user'].'</td>
			<td>'.$URL.$arr[$i]['url'].'</td>
			<td>'.$visiteddate.'</td>
			</tr>';
			$val++;
		}
		$output.='<tr>
		<td colspan="4" class="clsAlignRight">
		<div class="dt-row dt-bottom-row">
		<div class="row-fluid">
		<div class="dataTables_paginate paging_bootstrap pagination">
		<ul>
		
		'.' '.$prev.' ';
		for($i=1;$i<=count($paging);$i++)
			$pagingvalues .= $paging[$i]."  ";
		$output .= $pagingvalues.' '.$next.'</ul></div>
		</div>
		</div>
		</td>
		</tr>';
	}
	else
		$output.='<tr><td colspan=2 valign="bottom" align="center">No Activity Found!<br/>&nbsp;</td></tr>';
	
	$output .= '</tbody></table>';
	return $output;
	
}
}
?>
