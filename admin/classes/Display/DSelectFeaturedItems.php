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
	function listCategory($result)
	{
		if((count($result))>0)
		{
		   	 $output='<select name="selcatgory[]" id="selcatgory"   onchange="showProducts(this.value);" ><option value="Choose Category">Choose Category</option>';	
		
			for($k=0;$k<count($result);$k++)
			{
				if($catid==$result[$k]['category_id'])
				{
					$selected="selected";
				}
				else
				{
					$selected='';
				}
				
				$output.='<option value='.$result[$k]['category_id'].' '.$selected.'>'.$result[$k]['category_name'].'</option>';
				$output.=self:: getSubFamilies(0,$result[$k]['category_id'] );
	
			
			}

		$output.='</select>';
		}

		return $output;
	}
	/**
	 * Function generates an drop down list with the category details.in sub child
	 * 
	 * 
	 * @return array
	 */		
	function getSubFamilies($level, $id) {

		$level++;
		$sqlSubFamilies = "SELECT * from category_table WHERE  category_parent_id = ".$id."";
		$resultSubFamilies = mysql_query($sqlSubFamilies);
		if (mysql_num_rows($resultSubFamilies) > 0) {
		
			while($rowSubFamilies = mysql_fetch_assoc($resultSubFamilies)) {

				
				if($catid==$rowSubFamilies['category_id'])
				{
					$selected="selected";
				}
				else
				{
					$selected='';
				}
				
				$output.= "<option value=".$rowSubFamilies['category_id']."  ".$selected.">";

				for($a=1;$a<$level+1;$a++)
				{
				$output.='- &nbsp;';
					
				}
				$output.=$rowSubFamilies['category_name']."</option>";
				$output.=self:: getSubFamilies($level, $rowSubFamilies['category_id']);
				
			}
		
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
	function productList($arr,$paging,$prev,$next)
	{
		$output = "";
		//$output .= '<table border="1">';
		//$output.='<th>S.no.</th><th>Image</th><th>Product Name</th><th>Brand</th><th>Model</th><th>Msrp</th><th>Select Featured</th><th colspan="2">Options</th>';
		$output.='<div class="blocks" style="opacity: 1;">
		<div class="clsListing clearfix"><table cellspacing="0" cellpadding="0" border="0"  class="table table-striped table-bordered  table-hover">

		<thead class="green_bg">
		<tr>
		<th>ID</th>
		<th>Image</th>

		<th>Product Name</th>
		<th>Brand</th>
		<th>Model</th>
		<th>MSRP</th>
		<th colspan="2">Featured</th>
		</tr>
		</thead>
		<tbody>';
		if(count($arr) > 0)
		{
			$count=count($arr);
		for($i=0;$i<$count; $i++)
		{
			

			$temp=$arr[$i]['image'];
			$img=explode('/',$temp);
			$output.='<input type="hidden" name="mainindex" value="">';
			//$output .='<tr><td align="center" '.$classtd.'">'.($i+1).'</td><td align="center" '.$classtd.'><img src="uploadedimages/thumb/thumb_'.$img[2].'" name="image1"  id="image1"/></td>';
			$output .='<tr><td align="center" '.$classtd.'">'.$arr[$i]['product_id'].'</td><td align="center" '.$classtd.'><img   src="'.
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
				$output.='<input type="hidden" name="productid[]" value="'.$arr[$i]['product_id'].'" /></tr>';
			}
		}
		else
		{
				$output .='<tr><td colspan="8">No Products Found in this Category</td></tr>';
		}
		$output .='<tr>
		<td colspan="8" class="clsAlignRight">
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
			$output.='</tbody></table></div></div>';


			return $output;
		}

	}	
	?>