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
		
		$output .= '<table width="99%" border="0" cellpadding="0" cellspacing="0" align="center" class="content_list_bdr">';
		$output .= '<tr><td class="content_list_head" >S.No</td><td class="content_list_head" >Product Name</td><td class="content_list_head" >Category Name</td><td class="content_list_head" >Price Per Item</td><td class="content_list_head" >Items Sold</td></tr>';
		
		for ($i=0;$i<count($arr);$i++)
		{
		
		$output.='<tr  onmouseover="listbg(this, 1);" onmouseout="listbg(this, 0);" style="background-color: rgb(255, 255, 255);">
			<td align="center" style="padding:5px;width:20px" class=content_list_txt1>'.($i+1).'</td>
			<td class=content_list_txt1>'.ucwords($arr[$i]['title']).'</td>';
				
 
		$output.='<td align="left"  style="padding-left:10px;" class=content_list_txt1 >'.ucwords($arr[$i]['category_name']).'</td>
			<td align="right"  style="padding-left:10px;" class=content_list_txt1 >'.$_SESSION['currency']['currency_tocken'].number_format($arr[$i]['msrp'],2).'</td>
			<td align="right"  style="padding-left:10px;" class=content_list_txt1 >'.$arr[$i]['cnt'].'</td>
			</tr>';					
		}
		$output .='<tr align="center"><td colspan="8"  class="content_list_footer" >'.' '.$prev.' ';
		
		    for($i=1;$i<=count($paging);$i++)
				 $pagingvalues .= $paging[$i]."  ";
		
		$output .= $pagingvalues.' '.$next.'</td></tr>';
						
		$output .= '</table>';
		return $output;
			
	}
}
?>
