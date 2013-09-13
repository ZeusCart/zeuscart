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
 * This class contains functions to display the sub category related process.
 *
 * @package  		Display_DShowSubCategory
 * @category  		Display
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
  * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */
class Display_DShowSubCategory
{
	/**
	 * Function  to  display the category
	 * @param array $arr
	 * @param   integer $flag
	 * @return string
	 */	
	function showCategory($arr,$flag)
	{

		$output.='<form name="search" method="post" action="?do=showsub&action=search&id='.(int)$_GET['id'].'" > <table cellspacing="0" cellpadding="0" border="0"  class="table table-striped table-bordered  table-hover">

		<thead class="green_bg">
		<tr>
		<th>Category Icon</th>
		<th>Category Name</th>
		<th>Category Description</th>

		<th>Status</th>
		<th colspan="2">Actions</th>
		</tr>
		</thead><tbody>
		';  

		$output .= '<tr class="list_search_bg"><td class="content_list_txt2"></td><td class="content_list_txt2"><input type="text"  name="catname" size="20" value="'.$_POST['catname'].'"/></td><td class="content_list_txt2"><input type="text" size="24" name="catdesc" value="'.$_POST['catdesc'].'"/></td> <td class="content_list_txt2"><input type="hidden" name="main_cat" value="'.(int)$_GET['id'].'">
		<select id="visibility" name="status" style="width: 60px;" type="select" >';
		if($_POST['status']=="")
		{
			$output.='<option value="" selected="selected" >All</option>
			<option value="1" >Enabled</option>
			<option value="0" >Disabled</option>';

		}
		elseif($_POST['status']==1)
		{
			$output.='<option value="" >ALl</option>
			<option value="1" selected="selected" >Enabled</option>
			<option value="0" >Disabled</option>';
		}	
		else
		{
			$output.='
			<option value="" >All</option>
			<option value="1" >Enabled</option>
			<option value="0" selected="selected" >Disabled</option>';
		}
		$output.='
		</select></td><td class="content_list_txt2" colspan="2" align="center"><input type="submit" name="search" class="clsBigBtn" value="Search"/></td></tr></form>';
		if($flag=='0')
			$output .= '<tr><td align="center" colspan="5"><font color="orange"><b>No Category Matched</b></font></td></tr>';
		else
		{
			for ($i=0;$i<count($arr);$i++)
			{



					//print_r($arr);
				if($arr[$i]['category_status']=='0')
				{
						$catstatus='inactive_link';//'Disabled';
					}
					else
					{
						$catstatus='active_link';//'Enabled';
					}
					//print_r($arr[$i]['category_status']);
					//	echo $catstatus;
					//$temp=$arr[$i]['image'];
					//echo $temp;
					//$img=explode('/',$temp);
					$category_desc=(strlen($arr[$i]['category_desc'])>25) ? substr($arr[$i]['category_desc'],0,25).'...' : $arr[$i]['category_desc'] ;
					$output.='<input type="hidden" name="index" value="">';
					$output .= '<tr>
					<!--<td align="center" >'.($i+1).'</td>-->';
					$output .='<td  align="center" >';
					if(file_exists('../'.$arr[$i]['image']))
						$output.='<img src="../'.$arr[$i]['image'].'" name="image1"  width="30" height="30" id="image2" border="0"/></td>';
					else
						$output.='<img src="../images/noimage.jpg" border="0" width="30" height="30"/></td>';
					

					if($flag==3)
					{
						$output.='<td >'.$arr[$i]['SubCategory'].'</td>';
					}		
					elseif($flag!=3)
					{
						$output.='<td ><a href="?do=showsubundercat&action=show&id='.$arr[$i]['category_id'].'">'.$arr[$i]['SubCategory'].'</a></td>';
					}	



					$output.='<td >'.$category_desc.'</td>
					<td  align="center"><span class="'.$catstatus.'">&nbsp;</span></td>';
					
					$output.='<td ><input type="button" name="Edit" class="edit_bttn"   title="Edit" value="" onclick=edit('.$arr[$i]['category_id'].','.(int)$_GET['id'].') /></td>';
					$output.='<td ><input type="button" name="Delete" class="delete_bttn"  title="Delete" value="" onclick=callid('.$arr[$i]['category_id'].','.$arr[$i]['category_parent_id'].','.$arr[$i]['sub_category_parent_id'].') /></td></tr>';	
					
					
				/*if(file_exists('../uploadedimages/caticons/thumb/thumb_'.$img[2]))
					$output.='<img src="../uploadedimages/caticons/thumb/thumb_'.$img[2].'" name="image1"  width="30" height="30" id="image2" border="0"/></td>';
				else
					$output.='<img src="../images/noimage.jpg" border="0" width="30" height="30"/></td>';
							$output.='<td >'.$arr[$i]['SubCategory'].'</td><td >'.$category_desc.'</td>';
							*/

						}

					}		
					$output .= '</tbody></table>';
					return $output;
				}
	/**
	 * Function  to  display the main category
	 * @param array $arr
	 * @return string
	 */	
	function showMainCategory($arr)
	{
		
		for ($i=0;$i<count($arr);$i++)
		{

			$output = "";
			if(count($arr) > 0)
				$fun = 'onChange="showSub(this.value);"';
			//$output .= 'Category';
			$output='<tr>
			<td align="left" class="content_form">Category name:  ';
			$output .= '&nbsp;<select name="cbosubcateg" class="combo_box2" id="cbosubcat" '.$fun.'>';
			if($_GET['id']!="")
			{
				$category_name=Display_DShowSubCategory::getCategoryname($_GET['id']);
				$output .= '<option value="" selected="selected">'.$category_name.'</option>';
			}	
			$count=count($arr);
			for ($i=0;$i<$count; $i++)
				$output .= '<option value="'.$arr[$i]['category_id'].'">'.$arr[$i]['category_name'].$hassub.'</option>';
			$output .= '</select></td> ';

			return $output;
			
		}
		$output .= '</tr>';
		return $output;
	}
	/**
	 * Function  to  get the category name
	 * @param integer $id
	 * 
	 * @return array
	 */	
	function getCategoryname($id)
	{
		$sql = "SELECT category_name FROM category_table where category_id=".$id;
		$query = new Bin_Query();
		$query->executeQuery($sql);
		return $query->records[0]['category_name'];
	}	
	/**
	 * Function  to  display the sub category 
	 * @param array $arr
	 * 
	 * @return string
	 */	
	function displaySubCategory($arr)
	{
		$output ="";
		$temp=$arr[0]['category_image'];
		//$img=explode('/',$temp);
		
		$output.='';
		$output.='<form name="formsubcatedit" id="saveSubcategory" action="?do=showsub&action=edit&id='.(int)$_GET['mid'].'&subid='.(int)$_GET['id'].'" method="post" enctype="multipart/form-data">';
		
		$output .= '
		
		<div class="row-fluid">
		<div class="span12"><label>Category Name </label>
		<input type="text" name="category" class="txt_box250" id="cat" value="'.$arr[0]['category_name'].'" />
		</div></div><div class="row-fluid">
		<div class="span12"><label>Category Description</label>
		<input type="text" name="categorydesc" class="txt_box250" id="catdesc" value="'.$arr[0]['category_desc'].'" /></div></div><div class="row-fluid">
		<div class="span6"><label>Category Image</label>


		<div class="fileupload fileupload-new" data-provides="fileupload" style="width:350px;"><div style="float:right;" class="thumbnail"><img src="../'.$temp.'" name="image1"  id="image2" /></div>
		<div class="fileupload-new thumbnail" style="width: 200px; height: 150px;"><img src="assets/img/noimage.gif" /></div>
		<div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
		<div>
		<span class="btn btn-file"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span><input type="file" name="caticon" id="caticon" /></span>
		<a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
		</div>
		</div></div></div><div class="row-fluid">
		<div class="span12"><label>Status </label>
		<td colspan="3" class=""><span>';
		if($arr[0]['category_status']=='1')
		{
			$checked.='checked';
		}
		else
		{
			$checked.=' ';
		} 
		$output.='<input type="checkbox" name="status" value="1" '.$checked.' ></div></div>';
		if($arr[0]['html_content']!='')
		{
			$output.='<div class="row-fluid">
			<div class="span12"><label>Landing Content</label>
			'.$arr[0]['html_content'].'</div></div>';
		}

		return $output;
	}
	/**
	 * Function  to  display the sub under subcategory 
	 * @param array $arr
	 * 
	 * @return string
	 */	
	function displaySubUnderSubCategory($arr)
	{

		$output ="";
		$temp=$arr[0]['category_image'];

		$output.='<form name="formsubcatedit" id="updateUndersubcat" action="?do=showsubundercat&action=edit&id='.(int)$_GET['mid'].'&subid='.(int)$_GET['id'].'" method="post" enctype="multipart/form-data">';
		
		$output .= '<div class="row-fluid">
		<div class="span12"><label>Category Name</label> <input type="text" name="category" class="txt_box250" id="cat" value="'.$arr[0]['category_name'].'" /></div></div><div class="row-fluid">
		<div class="span12"><label>
		Category Description</label>
		<input type="text" name="categorydesc" class="txt_box250" id="catdesc" value="'.$arr[0]['category_desc'].'" /></div></div><div class="row-fluid">
		<div class="span12"><label>
		Category Image</label>
		<div class="fileupload fileupload-new" data-provides="fileupload" style="width:350px;"><div style="float:right;" class="thumbnail"><img src="../'.$temp.'" name="image1"  id="image2" /></div>
		<div class="fileupload-new thumbnail" style="width: 200px; height: 150px;"><img src="assets/img/noimage.gif" /></div>
		<div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
		<div>
		<span class="btn btn-file"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span><input type="file" name="caticon" id="caticon" /></span>
		<a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
		</div></div></div><div class="row-fluid">
		<div class="span12"><label>
		Status</label> ';
		if($arr[0]['category_status']=='1')
		{
			$checked.='checked';
		}
		else
		{
			$checked.=' ';
		} 
		$output.='<input type="checkbox" name="status" value="1" '.$checked.' ></div></div>';
		if($arr[0]['html_content']!='')
		{
			$output.='<div class="row-fluid">
			<div class="span12"><label>Landing Content></label>'.$arr[0]['html_content'].'</div></div>';
		}

		return $output;
	}
}
?>