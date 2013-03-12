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
 * This class contains the featured item related process.
 *
 * @package  		Display_DFeaturedItems
 * @category  		Display
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
  * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */
class Display_DFeaturedItems
{
	/**
	 * Function  to  display the  category list
	 * @param array $arr
	 * @return string
	 */	
	function listCategory($arr)
	{
		$output = "";
		for ($i=0;$i<count($arr);$i++)
		{
			$output .= '<option value="'.$arr[$i]['category_id'].'">'.$arr[$i]['category_name'].'</option>';
		}
			
			return $output;
	}
	/**
	 * Function  to  display the  sub category list
	 * @param array $arr
	 * @return string
	 */	
	function listSubCategory($arr)
	{
		if($arr=='')
		{
			$output .= 'Sub Category&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
			$output .= '<select name="cbosubcateg" class="combo_box2" id="cbosubcat" >';
			$output .= '<option value="">Select </option>';
			$output .= '</select>';

		}
		else
		{
			$output = "";
			if(count($arr) > 0)
				$fun = 'onChange="showProducts(this.value);"';
			$output .= '<td class=label_name"" align="left">Sub Category</td>';
			$output .= '<td class="" align="left"><select name="cbosubcateg" class="combo_box2" id="cbosubcat" '.$fun.'>';
			$output .= '<option value="">Select </option>';
			$count=count($arr);
			for ($i=0;$i<$count; $i++)
				$output .= '<option value="'.$arr[$i]['category_id'].'">'.$arr[$i]['category_name'].$hassub.'</option>';
			$output .= '</select></td>';
		}
		return $output;
	}
	/**
	 * Function  to  display the product list
	 * @param array $arr
	 * @return string
	 */	
	function productList($arr)
	{
		$output = "";
		//$output .= '<table border="1">';
		//$output.='<th>S.no.</th><th>Image</th><th>Product Name</th><th>Brand</th><th>Model</th><th>Msrp</th><th>Select Featured</th><th colspan="2">Options</th>';
		$output.='<table class="content_list_bdr" border="0" cellpadding="0" cellspacing="0" width="100%"><tr>
                <td class="content_list_head">S.No</td>
				<td class="content_list_head">Image</td>
				
				<td class="content_list_head">Product Name</td>
				<td class="content_list_head">Brand</td>
				<td class="content_list_head">Model</td>
                <td class="content_list_head"><a onmouseover="ShowHelp(\'dmsrp\', \'MSRP\', \'Manufacturer&acute;s Suggested Retail Price\')" onmouseout="HideHelp(\'dmsrp\');">MSRP </a>
			<div id="dmsrp" style="left: 50px; top: 50px;"></div></td>
                <td colspan="2" align="center" class="content_list_head">Featured</td>
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
				
			$temp=$arr[$i]['image'];
			$img=explode('/',$temp);
			$output.='<input type="hidden" name="mainindex" value="">';
			//$output .='<tr><td align="center" '.$classtd.'">'.($i+1).'</td><td align="center" '.$classtd.'><img src="uploadedimages/thumb/thumb_'.$img[2].'" name="image1"  id="image1"/></td>';
			$output .='<tr><td align="center" '.$classtd.'">'.($i+1).'</td><td align="center" '.$classtd.'><img   src="'.
			((file_exists('../images/products/thumb/'.$img[2])) ? '../images/products/thumb/'.$img[2] : '../images/noimage.jpg').'" name="image1"  id="image1" alt="Product Image"/></td>';
			$output .= '<td '.$classtd.' align="left">'.$arr[$i]['title'].'</td><td '.$classtd.'>'.$arr[$i]['brand'].'</td><td '.$classtd.'>'.$arr[$i]['model'].'</td><td '.$classtd.' align="right">'.$_SESSION['currency']['currency_tocken'].' '.number_format($arr[$i]['msrp'],2).'</td>';

			if($arr[$i]['is_featured']==1)
			{
				$output .= '<td '.$classtd.' align="center"><input name="checkbox[]" type="checkbox" checked="checked" value="'.$arr[$i]['product_id'].'" /></td>';}
			else
			{
				$output .= '<td '.$classtd.' align="center"><input name="checkbox[]" type="checkbox" value="'.$arr[$i]['product_id'].'" /></td>'; 
			}
			
			
			//$output.='<td '.$classtd.' align="center"><a href="?do=aprodetail&action=showprod&prodid='.$arr[$i]['product_id'].'">View</a></td></tr>';
			$output.='<input type="hidden" name="productid[]" value="'.$arr[$i]['product_id'].'" />';
		}
		$output.='<tr><td align="right" colspan="7"><input type="submit" name="btnSubmit" class="all_bttn" value="Update Featured" id="submit" onclick="" / ></td></tr>';
		$output.='</table>';
		

		return $output;
	}
	 
}	
?>