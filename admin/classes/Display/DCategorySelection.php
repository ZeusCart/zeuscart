<?php
/**
* GNU General Public License.

* This file is part of ZeusCart V2.3.

* ZeusCart V2.3 is free software: you can redistribute it and/or modify
* it under the terms of the GNU General Public License as published by
* the Free Software Foundation, either version 3 of the License, or
* (at your option) any later version.
* 
* ZeusCart V2.3 is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
* GNU General Public License for more details.
* 
* You should have received a copy of the GNU General Public License
* along with Foobar. If not, see <http://www.gnu.org/licenses/>.
*
*/

/**
 * DCategorySelection
 *
 * This class contains functions to list out the categories,subcategories and products.
 *
 * @package		Display_DCategorySelection
 * @category	Display
 * @author		ZeusCart Team
 * @link		http://www.zeuscart.com
 * @version 	2.3
 */

// ------------------------------------------------------------------------

class Display_DCategorySelection
{
	
	/**
	 * Function returns the category details. 
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
	 * Function returns the sub category details. 
	 * @param array $arr	 
	 * @return string
	 */
	
	
	function listSubCategory($arr)
	{
		$output = "";
		if(count($arr) > 0)
			$fun = 'onChange="showProducts(this.value);"';

		$output .= '<select name="cbosubcateg" class="combo_box2" id="cbosubcat" '.$fun.'>';
		$count=count($arr);
		for ($i=0;$i<$count; $i++)
		$output .= '<option value="'.$arr[$i]['category_id'].'">'.$arr[$i]['category_name'].$hassub.'</option>';
		$output .= '</select>';
		
		return $output;
	}
	
	
	/**
	 * Function returns the product list details. 
	 * @param array $arr	
	 * @return string
	 */
	
	function productList($arr)
	{
		//echo 'called';
		$output = "";
			if(count($arr) > 0)
		
		 //print_r($arr);
		 $count=count($arr);
		
		for($i=0;$i<$count; $i++)
		
		$output .= '<ul><input name="checkbox[]" type="checkbox" value="'.$arr[$i]['product_id'].'" />'.$arr[$i]['title'].'</ul></br>';
		$output.='<input type="hidden" name="productid[]" value="'.$arr[$i]['product_id'].'" />';
		echo $output;

		return $output;
	}
	
	/**
	 * Function returns the list of categories available. 
	 * @param array $arr	 
	 * @return string
	 */	
	 
	 function showCategory($arr)
	{
		$output = "";
		//echo "<pre>";
		//print_r($arr);
		$output .='<img src="'.$arr[0]['category_image'].'" name="image1"  id="image1"/>';
		$output .= '<table border="1">';
		$output.='<th>S.no.</th><th>Category Name</th><th>Category Description</th><th>Category Icon</th><th colspan="2">Options</th>';
		for ($i=0;$i<count($arr);$i++)
		{
		//print_r($arr[$i]['attrib_name']);
		//echo "s",$arr[$i]['category_id'];
			$output.='<input type="hidden" name="mainindex" value="">';
			$output .= '<tr style="background-color:#FFFFFF;" onmouseout="listbg(this, 0);" onmouseover="listbg(this, 1);"><td>'.($i+1).'</td><td>'.$arr[$i]['category_name'].'</td><td>'.$arr[$i]['category_desc'].'</td>';
			$output .='<td width=""><img src="'.$arr[$i]['category_image'].'" name="image1"  id="image1"/></td>';
			$output.='<td><input type="button" name="Edit"  title="Edit" value="Edit" onclick=edit('.$arr[$i]['category_id'].') /></td>';
			$output.='<td><input type="button" name="Delete"  title="Delete" value="Delete" onclick=callcatids('.$arr[$i]['category_id'].') /></td></tr>';
			
		}
			$output .= '</table>';
			return $output;
	}
	
	/**
	 * Function returns the list of sub categories available. 
	 * @param array $arr	 
	 * @return string
	 */	
	
	function showSubCategory($arr)
	{
		$output = "";
		//echo "<pre>";
		
		$output .= '<table border="1" width="100%">';
		$output.='<th>S.no.</th><th>Category Name</th><th>Category Description</th><th>Category Icon</th><th colspan="2">Options</th>';
		for ($i=0;$i<count($arr);$i++)
		{
			//echo "s",$arr[$i]['category_id'];
			//print_r($arr[$i]['category']);
			//print_r($arr[$i]['image']);
			$output.='<input type="hidden" name="index" value="">';
			$output .= '<tr><td>'.($i+1).'</td><td>'.$arr[$i]['Category'].'</td><td>'.$arr[$i]['SubCategory'].'</td>';
			$output .='<td width="1"><img src="'.$arr[$i]['image'].'" name="image1"  id="image1" width="100px" height="75px" /></td>';
			$output.='<td><input type="button" name="Edit"  title="Edit" value="Edit" onclick=edit('.$arr[$i]['category_id'].') /></td>';
			$output.='<td><input type="button" name="Delete"  title="Delete" value="Delete" onclick=callid('.$arr[$i]['category_id'].') /></td></tr>';
		}
		
			
			$output .= '</table>';
			return $output;
			
	}
	
	/**
	 * Function returns a template for updating the main category. 
	 * @param array $arr	 
	 * @return string
	 */	
	
	function displayMainCategory($arr)
	{
	$output ="";
		//echo "<pre>";
		//echo "s",$arr[$i]['category_desc'];
		//print_r($arr['category_desc']);
		//print_r($arr);
		
		$output.='<input type="hidden" name="index" value="">';
		$output .= '
		
<tr>
<td>
Category Name:
</td>
<td>
<input type="text" name="category" id="cat" value="'.$arr[0]['category_name'].'" />
</td>
</tr>
<tr>
<td>
Category Description:
</td>
<td>
<input type="text" name="categorydesc" id="catdesc" value="'.$arr[0]['category_desc'].'" />
</td>
</tr>
<tr>
<td>
Category Image:
</td>
<td>

<input type="file" name="caticon" id="caticon" /> 
</td>
<td>
<img src="'.$arr[0]['category_image'].'" name="image1"  id="image1" width="150px" height="150px" />
</td>
</tr>
<tr>
<td>
Status:
</td>
<td>

<input type="radio" name="group1" value="1" checked="'.$arr[0]['category_status'].'">
ON
<input type="radio" name="group1" value="0" checked="'.$arr[0]['category_status'].'" >
Off<br />

</td>
</tr>
<tr>
<td></td>
<td colspan="2">
<input type="submit" name="btnsubmit"  value="Update Main Category" id="submit"  />
</td>
</tr>

</table>
</form>';
		
	return $output;
}


	/**
	 * Function returns a template for updating the subcategory. 
	 * @param array $arr	 
	 * @return string
	 */	

	function displaySubCategory($arr)
	{
	$output ="";
		//echo "<pre>";
		//echo "s",$arr[$i]['category_desc'];
		//print_r($arr['category_desc']);
		//print_r($arr);
		if($arr[0]['category_status']=1)
		{
		$status="checked";
		}
		else
		{
		$status=" ";
		}
		$output.='<input type="hidden" name="index" value="">';
		$output .= '
		
<tr>
<td>
Category Name:
</td>
<td>
<input type="text" name="category" id="cat" value="'.$arr[0]['category_name'].'" />
</td>
</tr>
<tr>
<td>
Category Description:
</td>
<td>
<input type="text" name="categorydesc" id="catdesc" value="'.$arr[0]['category_desc'].'" />
</td>
</tr>
<tr>
<td>
Category Image:
</td>
<td>

<input type="file" name="caticon" id="caticon" /> 
</td>
<td>
<img src="'.$arr[0]['category_image'].'" name="image1"  id="image1" width="150px" height="150px" />
</td>
</tr>
<tr>
<td>
Status:
</td>
<td>

<input type="radio" name="group1" value="1" checked="'.$arr[0]['category_status'].'">
ON
<input type="radio" name="group1" value="0" checked="'.$arr[0]['category_status'].'" >
Off<br />

</td>
</tr>
<tr>
<td></td>
<td colspan="2">
<input type="submit" name="btnsubmit"  value="Update Main Category" id="submit"  />
</td>
</tr>

</table>
</form>';
		
	return $output;
}
	
}
?>