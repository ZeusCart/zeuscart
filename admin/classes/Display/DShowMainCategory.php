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
 * This class contains functions to display the main category related process.
 *
 * @package  		Display_DShowMainCategory
 * @category  		Display
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
  * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */
class Display_DShowMainCategory
{

	/**
	 * Function  to  display the category
	 * @param array $arr
	 * @param   integer $flag
	 * @return string
	 */	
	function showCategory($arr,$flag,$paging,$prev,$next)
	{
		

		$output = '';

		$output.='<table cellspacing="0" cellpadding="0" border="0"  class="table table-striped table-bordered  table-hover">
		<thead class="green_bg">
		<tr>		
		<th align="left"><input type="checkbox" class="select_rows" onclick="checkall();"></th>		
		<th align="left">Category Name</th>
		<th align="left">Status</th>
		<th align="left" style="width:10px">Actions</th>
		</tr>
		</thead>
		<tbody>';	
		$output .= '<form name="search1" method="post" action="?do=showmain&action=search" > <tr class="list_search_bg"><td class="content_list_txt2"></td><td class="content_list_txt2"><input type="text"  name="catname" value="'.$_POST['catname'].'" id="catname"/></td><td class="content_list_txt2">
		<select id="visibility" name="status"  style="width: 60px;" type="select" >';
		if($_POST['status']=="")
		{
			$output.='<option value="" selected="selected" >All</option>
			<option value="1" >Enabled</option>
			<option value="0" >Disabled</option>';

		}
		elseif($_POST['status']==1)
		{
			$output.='<option value="" >All</option>
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
		</select></td><td class="content_list_txt2" colspan=2><input type="submit" class="clsBigBtn" name="search" value="Search"/></td></tr></form>';
		if($flag=='0')
			$output .= '<tr><td align="center" colspan="7"><font color="orange"><b>No Category Matched</b></font></td></tr>';
		else
		{
			$cnt = count($arr);

			for ($i=0;$i<count($arr);$i++)
			{
				if($i % 2 == 0)
					$classtd='class="content_list_txt1"';
				else
					$classtd='class="content_list_txt2"';
				if($arr[$i]['category_status']==0)
				{
					$catstatus='Disable';
				}
				else
				{
					$catstatus='Enable';
				}

				$temp=$arr[$i]['category_image'];
				$img=explode('/',$temp);
				$output.='<input type="hidden" name="mainindex" value="">';
				$output .= '<tr><td><input type="checkbox" class="catagorydel" name="categoryid[]" value='.$arr[$i]['category_id'].'></td>';
				/*$output .='<td '.$classtd.' align="center">';
				if(file_exists('../uploadedimages/caticons/thumb/thumb_'.$img[2]))
					$output.='<img src="../uploadedimages/caticons/thumb/thumb_'.$img[2].'" name="image1"  id="image2" border="0"/></td>';
				else
				$output.='<img src="../images/noimage.jpg" border="0"/></td>';*/
				
				
				$output .='<td '.$classtd.'><a href="?do=showmain&action=disp&id='.$arr[$i]['category_id'].'" >'.$arr[$i]['category_name'].'</a></td>';
				
				$output.='
				<td '.$classtd.' align="center">'.$catstatus.'</td>';
				// $output.='<td '.$classtd.'></td>';
				$output.='<td '.$classtd.'><a href="?do=showmain&action=disp&id='.$arr[$i]['category_id'].'"  ><i class="icon icon-edit"></i></a> &nbsp;<a href="?do=showmain&action=delete&id='.$arr[$i]['category_id'].'" onclick="return confirm(\'Are you sure want to Delete this Category?\')" ><i class="icon-trash"></i></a></td></tr>';
				$output.=self:: getSubFamiliesList(0,$arr[$i]['category_id']);
			}
		}	
		$output .='<tr>
			<td colspan="7" class="clsAlignRight">
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

		$output.= '</tbody></table>';
		return $output;
	}
		/**
	 * Function generates an drop down list with the category details.in sub child
	 * 
	 * 
	 * @return array
	 */		
	function getSubFamiliesList($level,$id) 
	{
		
		$level++;
		$sqlSubFamilies = "SELECT * from category_table WHERE  category_parent_id = ".$id."";
		$resultSubFamilies = mysql_query($sqlSubFamilies);
		if (mysql_num_rows($resultSubFamilies) > 0) {
		
			while($recordsSubFamiles = mysql_fetch_assoc($resultSubFamilies)) {

				if($level % 2 == 0)
					$classtd='class="content_list_txt1"';
				else
					$classtd='class="content_list_txt2"';
				if($recordsSubFamiles['category_status']==0)
				{
					$catstatus='Disable';
				}
				else
				{
					$catstatus='Enable';
				}

				$temp=$recordsSubFamiles['category_image'];
				$img=explode('/',$temp);
				$output.='<input type="hidden" name="mainindex" value="">';
				$output .= '<tr><td><input type="checkbox" class="catagorydel" name="categoryid[]" value='.$recordsSubFamiles['category_id'].'></td>';
				/*$output .='<td '.$classtd.' align="center">';
				if(file_exists('../uploadedimages/caticons/thumb/thumb_'.$img[2]))
					$output.='<img src="../uploadedimages/caticons/thumb/thumb_'.$img[2].'" name="image1"  id="image2" border="0"/></td>';
				else
				$output.='<img src="../images/noimage.jpg" border="0"/></td>';*/
				
				
				$output .='<td '.$classtd.'>';
					for($a=1;$a<$level+1;$a++)
					{
					$output.='- &nbsp;';
						
					}	
				$output.='<a href="?do=showmain&action=disp&id='.$recordsSubFamiles['category_id'].'" >'.$recordsSubFamiles['category_name'].'</a>';
				
				$output.='</td>
				<td '.$classtd.' align="center">'.$catstatus.'</td>';
				// $output.='<td '.$classtd.'><a href="?do=showmain&action=disp&id='.$arr[$i]['category_id'].'" class="edit_bttn" >&nbsp;</a></td>';
				$output.='<td '.$classtd.'><a href="?do=showmain&action=disp&id='.$recordsSubFamiles['category_id'].'"  ><i class="icon icon-edit"></i></a> &nbsp; <a href="?do=showmain&action=delete&id='.$recordsSubFamiles['category_id'].'" onclick="return confirm(\'Are you sure want to Delete this Category?\')"   ><i class="icon-trash"></i></a></td></tr>';
				$output.=self:: getSubFamiliesList($level,$recordsSubFamiles['category_id']);
				
				
			}
		
		}
		
		return $output;
	}
	/**
	 * Function  to  display the main category
	 * @param array $arr
	 * @return string
	 */	
	function displayMainCategory($arr,$Err,$recordsAtt,$selectedarr)
	{

		if(!empty($Err->messages))
		{
			$catid=$Err->values['catid'];
			$categoryname=$Err->values['category'];
			$category_alias=$Err->values['category_alias'];

			$visibilitystattus=$Err->values['category_status'];
			$catdesc=$Err->values['categorydesc'];


		}
		else
		{
			$catid=$arr[0]['category_parent_id'];
			$categoryname=$arr[0]['category_name'];
			$category_alias=$arr[0]['category_alias'];
			$visibilitystattus=$arr[0]['category_status'];
			$catdesc=$arr[0]['category_desc'];
		}

	

		$output ="";
		$maincat='<select name="category" class="span4"><option value="0">No parent</option>';
	
		$sql = "SELECT * FROM category_table WHERE category_parent_id='0' AND category_id!='".$_GET['id']."'" ;
		$cquery = new Bin_Query();
		if($cquery->executeQuery($sql))
		{
			for($k=0;$k<count($cquery->records);$k++)
			{
				if($arr[0]['category_parent_id']==$cquery->records[$k]['category_id'])
				{
					$selected="selected";
				}
				else
				{
					$selected="";
				}
				
				$maincat.='<option value='.$cquery->records[$k]['category_id'].' '.$selected.'>'.$cquery->records[$k]['category_name'].'</option>';
				$maincat.=self:: getEditSubFamilies(0,$cquery->records[$k]['category_id'] ,$arr[0]['category_parent_id']);
				
			}
		}
		$maincat.='</select>';


				if($selectedarr[0]==0)
			$alert="selected='selected'";
		else
			$alert="";
		$attribute = "<select name='attributes[]' multiple='multiple' size='15' style='width:199px'><option value=''".$alert.">No Attribute(s)</option>";
		for ($k=0;$k<count($recordsAtt);$k++)
		{
			if(in_array($recordsAtt[$k]['attrib_id'],$selectedarr))
			{
				
				$attribute.='<option value="'.$recordsAtt[$k]['attrib_id'].'" selected="selected">'.$recordsAtt[$k]['attrib_name'].'</option>';
			}
			else
			{
				$attribute.='<option value="'.$recordsAtt[$k]['attrib_id'].'">'.$recordsAtt[$k]['attrib_name'].'</option>';
			}
			
		}
			$attribute.='</select>';

		$temp=$arr[0]['category_image'];
		$img=explode('/',$temp);
		$output.='<form name="formmaincatedit" action="?do=showmain&action=edit&id='.(int)$_GET['id'].'" method="post" enctype="multipart/form-data" id="updateCategoryform">';
		
		$output .= '<div class="row-fluid">
		<div class="span12"><label>Category Name <font color="#FF0000">*</font></label>
		<input type="text" name="categoryname" class="span4" id="cat" value="'.$arr[0]['category_name'].'" />
		</div></div>


			<div class="row-fluid">
			<div class="span4"><label>Category Alias <font color="#FF0000">
					*
				</font></label>
				<input type="text" name="category_alias" id="category_alias" value="'.$category_alias.'" class="span12" /></div><div class="span4"><font color="#FF0000"> (The category alias wil be used in SEF url. Use lower case letter and hyphens .No spaces and underscore are not allowed)</font>
				
				</div>
			</div>';


		
		$output .= '<div class="row-fluid">
		<div class="span12"><label>Select Parent Category  </label>
		'.$maincat.'</div></div>';
		
		
		$output .= '<div class="row-fluid">
		<div class="span12"><label>Category Description</label><textarea id="catdesc" class="span4" rows="4" cols="30" name="categorydesc">'.$arr[0]['category_desc'].'</textarea>
		</div></div><div class="row-fluid">
		<div class="span12"><label>Category Image</label>

		<div class="fileupload fileupload-new" data-provides="fileupload">
		<div class="fileupload-new thumbnail" style="width: 200px; height: 100px;"><img src="../uploadedimages/caticons/'.$img[2].'" /></div>
		<div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
		<div>
		<span class="btn btn-file"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span><input type="file" name="caticon" id="caticon" /></span>
		<a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
		</div>
		</div>
		
		</div></div>

		<div class="row-fluid" style="display:block" id="attribContainer">
		<div class="span12"><label>Category Special Attributes </label>	
		'.$attribute.'
		</div>
		</div>
		<div class="row-fluid">
		<div class="span12"><label>Status :</label><div class="ibutton-group">
		';
		if($arr[0]['category_status']=='1')
		{
			$checked="checked";
		}
		else
		{
			$checked="";
		} 

		$output.='<input type="checkbox" name="status" value="1" '.$checked.'>';

		$output.='</div></div></div><div class="row-fluid">
		<div class="span12">';
		if($arr[0]['html_content']!='')
		{
			$output.='<label>Landing Content</label>
			'.$arr[0]['html_content'].'</div></div>';
		}
		
		
		return $output;
	}

	/**
	 * Function generates an drop down list with the category details.in sub child
	 * 
	 * 
	 * @return array
	 */		
	function getEditSubFamilies($level,$id,$catid) {
	
		
			$level++;

			if($catid!=0)
			{
			$sqlSubFamilies = "SELECT * from category_table WHERE  category_parent_id = ".$id."";
			$resultSubFamilies = mysql_query($sqlSubFamilies);
			if (mysql_num_rows($resultSubFamilies) > 0) {
			
				while($rowSubFamilies = mysql_fetch_assoc($resultSubFamilies)) {
	
					$countpath=explode(',',$rowSubFamilies['subcat_path']);
					if($catid==$rowSubFamilies['category_id'])
					{
						$selected="selected";
					}
					else
					{
						$selected='';
					}	
		
					$output.= "<option value=".$rowSubFamilies['category_id']."  ".$selected.">";
	
					for($a=0;$a<$level;$a++)
					{
					$output.='- &nbsp;';
						
					}
					$output.=$rowSubFamilies['category_name']."</option>";
					$output.=self:: getEditSubFamilies($level, $rowSubFamilies['category_id'],$catid);
					
				}
		
			}
		}

		return $output;
	}
}
?>