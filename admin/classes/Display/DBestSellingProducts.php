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
 * This class contains functions to list out the best selling products.
 *
 * @package  		Display_DBestSellingProducts
 * @category  		Display
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
   * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */

class Display_DBestSellingProducts
{
	
	/**
	 * Function returns the best selling products details. 
	 * @param array $arr
	 * @param integer $paging
	 * @param integer $prev	 
	 * @param integer $next	 
	 * 
	 * @return string
	 */
	
	function showBestSellingProducts($arr,$paging,$prev,$next)
	{
		
		$output = "";
		
		$output .= '<table cellspacing="0" cellpadding="0" border="0"  class="table table-striped table-bordered  table-hover">
		<thead class="green_bg">
		<tr>
		<th align="left">S.No</th>
		<th align="left">Product Name</th>
		<th align="left">Category Name</th>
		<th align="left">Price Per Item</th>
		<th align="left">Items Sold</th>
		
		</tr>
		</thead>
		<tbody>';
		
		for ($i=0;$i<count($arr);$i++)
		{
			
			$output.='<tr>
			<td>'.($i+1).'</td>
			<td>'.ucwords($arr[$i]['title']).'</td>';
			
			
			$output.='<td>'.ucwords($arr[$i]['category_name']).'</td>
			<td>'.$_SESSION['currency']['currency_tocken'].number_format($arr[$i]['msrp'],2).'</td>
			<td>'.$arr[$i]['cnt'].'</td>
			</tr>';					
		}
		$output .='<tr>
		<td colspan="5" class="clsAlignRight">
		<div class="dt-row dt-bottom-row">
		<div class="row-fluid">
		<div class="dataTables_paginate paging_bootstrap pagination">
		<ul>'.' '.$prev.' ';
		
		for($i=1;$i<=count($paging);$i++)
			$pagingvalues .= $paging[$i]."  ";
		
		$output .= $pagingvalues.' '.$next.' </div>
		</div>
		</td>
		</tr>';
		
		$output .= '</tbody></table>';
		return $output;
		
	}
}
?>
