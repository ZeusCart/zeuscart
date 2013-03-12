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
 * This class contains functions to display the featured items list 
 *
 * @package  		Display_DViewFeaturedItems
 * @category  		Display
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
  * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */
class Display_DViewFeaturedItems
{

	/**
	 * Function  to display   the list of products
	 * @param array $arr
     * @return string
	 */	
	function productList($arr)
	{
		
		
		$output = "";
		//$output .= '<table border="1">';
		//$output.='<th>S.no.</th><th>Image</th><th>Product Name</th><th>Brand</th><th>Model</th><th>Msrp</th><th>Select Featured</th><th colspan="2">Options</th>';
		$output.='<table class="content_list_bdr" border="0" cellpadding="0" cellspacing="0" width="100%">
			<tr>
		                <td class="content_list_head" align="center">Select</td>
				<td class="content_list_head" align="center">Product Name</td>
				<td class="content_list_head" align="center">Product Image</td>
				<td class="content_list_head" align="center">Brand</td>
				<td class="content_list_head" align="center">Model</td>
		                <td class="content_list_head" align="center">MSRP [USD]</td>
                
                	</tr>
			<tr>
		                <td colspan="8" class="cnt_list_bot_bdr"><img src="images/list_bdr.gif" alt="" width="1" height="2" /></td>
              		</tr>';
		if(count($arr) > 0)
			$count=count($arr);
		for($i=0;$i<$count; $i++)
		{
			if($i % 2 == 0)
				$classtd='class="content_list_txt1"';
			else
				$classtd='class="content_list_txt2"';
				
			
			$output .='
			<tr>
				<td '.$classtd.' align="center"><input name="checkbox[]" type="checkbox" checked="checked" value="'.$arr[$i]['product_id'].'" /></td>
				<td '.$classtd.' align="center"><a href="?do=aprodetail&action=showprod&prodid='.$arr[$i]['product_id'].'">'.$arr[$i]['title'].'</a></td>
				<td align="center" '.$classtd.'>';
			
				$filename="../".$arr[$i]['thumb_image'];
				if(file_exists($filename))
					$output.=' <img src="../'.$arr[$i]['thumb_image'].'" border="0"/>';
				else
					$output.=' <IMG BORDER="0"  src="../images/noimage.jpg" />';
			$output.='</td>';
			$output .= '<td '.$classtd.'>'.$arr[$i]['brand'].'</td><td '.$classtd.'>'.$arr[$i]['model'].'</td>
				    <td '.$classtd.' align="right">'.number_format($arr[$i]['msrp'],2).'</td>';
			
			$output.='<input type="hidden" name="productid[]" value="'.$arr[$i]['product_id'].'" />';
		}
		$output.='<tr><td align="right" colspan="7" style="padding-bottom:10px; padding-top:10px; padding-right:10px"><input type="submit" name="btnSubmit" class="all_bttn" value="Update Featured" id="submit" onclick="" / ></td></tr>';
		$output.='</table>';
		

		return $output;
	}
	 
}	
?>