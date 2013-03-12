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
	function showCategory($arr,$flag)
	{
		$output = "";
		
		$output .= '';

		$output.='<tr>
            <td align="left"><table width="100%" border="0" cellpadding="0" cellspacing="0" class="content_list_bdr">
              <tr>
                <td class="content_list_head" align="center" width="5%">S.no.</td>
                <!--<td class="content_list_head" width="20%">Category Icon</td>-->
                <td class="content_list_head" width="30%">Category Name</td>
                <td class="content_list_head" width="40%">Category Description</td>
				<td class="content_list_head">Status</td>
                <td class="content_list_head" colspan=2>Actions</td>
              </tr>
              <tr>
                <td colspan="7" class="cnt_list_bot_bdr"><img src="images/list_bdr.gif" alt="" width="1" height="2" /></td>
                </tr>';  
				
		
			  $output .= '<form name="search1" method="post" action="?do=showmain&action=search" > <tr class="list_search_bg"><td class="content_list_txt2"></td><!--<td class="content_list_txt2"></td>--><td class="content_list_txt2"><input type="text"  name="catname" size="19" value="'.$_POST['catname'].'" id="catname"/></td><td class="content_list_txt2"><input type="text" size="27" name="catdesc" value="'.$_POST['catdesc'].'"/></td><td class="content_list_txt2">
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
</select></td><td class="content_list_txt2" colspan=2><input type="submit" class="all_bttn" name="search" value="Search"/></td></tr></form>';
	if($flag=='0')
			return $output .= '<tr><td align="center" colspan="7"><font color="orange"><b>No Category Matched</b></font></td></tr>';
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
				$catstatus='inactive_link';
			}
			else
			{
				$catstatus='active_link';
			}
							
			$temp=$arr[$i]['category_image'];
			$img=explode('/',$temp);
			$output.='<input type="hidden" name="mainindex" value="">';
			$output .= '<tr style="background-color:#FFFFFF;" onmouseout="listbg(this, 0);" onmouseover="listbg(this, 1);"><td align="center" '.$classtd.' >'.($i+1).'</td>';
			/*$output .='<td '.$classtd.' align="center">';
if(file_exists('../uploadedimages/caticons/thumb/thumb_'.$img[2]))
	$output.='<img src="../uploadedimages/caticons/thumb/thumb_'.$img[2].'" name="image1"  id="image2" border="0"/></td>';
else
	$output.='<img src="../images/noimage.jpg" border="0"/></td>';*/
			
			
			$output .='<td '.$classtd.'><a href="?do=showsub&action=show&id='.$arr[$i]['category_id'].'" >'.$arr[$i]['category_name'].'</a></td><td '.$classtd.'>'.$arr[$i]['category_desc'].'</td>';
			
$output.='</td>
			<td '.$classtd.' align="center"><span class="'.$catstatus.'"></span></td>';
			$output.='<td '.$classtd.'><a href="?do=showmain&action=disp&id='.$arr[$i]['category_id'].'" class="edit_bttn" >&nbsp;</a></td>';
			$output.='<td '.$classtd.'> <a href="?do=showmain&action=delete&id='.$arr[$i]['category_id'].'" onclick="return confirm(\'Are you sure want to Delete this Category?\')"  class="delete_bttn" >&nbsp;</a></td></tr>';
			
		}
	}		//$output .= '</table>';
			return $output;
	}
	/**
	 * Function  to  display the main category
	 * @param array $arr
	 * @return string
	 */	
	function displayMainCategory($arr)
	{
		$output ="";
	
		$temp=$arr[0]['category_image'];
		$img=explode('/',$temp);
		$output.='<form name="formmaincatedit" action="?do=showmain&action=edit&id='.(int)$_GET['id'].'" method="post" enctype="multipart/form-data">';
		$output.='<table width="100%" border="0" cellspacing="0" cellpadding="0">';
		
		$output.='<input type="hidden" name="index" value="">';
		$output .= '<tr><td  align="left" class="content_form">Category Name :</td>
            <td colspan="3" class=""><p><input type="text" name="category" class="txt_box250" id="cat" value="'.$arr[0]['category_name'].'" />
            </p>
            </td>
              </tr>
			
<tr><td align="left" class="content_form">Category Description:</td>
                <td colspan="3" class=""><input type="text" name="categorydesc" class="txt_box250" id="catdesc" value="'.$arr[0]['category_desc'].'" /></td>
              </tr>
              <tr><td width="25%" align="left" class="content_form">Category Image:</td>
<td colspan="3" ><input type="file" name="caticon" id="caticon" /></td>
<td ></td>

<td colspan="3" ><img src="../uploadedimages/caticons/thumb/thumb_'.$img[2].'" name="image1"  id="image2" border="0"/></td></tr>
			  
			  
		 <tr>
            <td align="left" class="content_form">Status :</td>
            <td colspan="3" class=""><span>';
			if($arr[0]['category_status']=='1')
			{
			$output.='  <input type="radio" name="status" value="1" checked="checked">
              ON &nbsp;&nbsp;
              <input type="radio" name="status" value="0"  >
              Off</span></td>';
			}
			else
			{
				$output.='  <input type="radio" name="status" value="1" >
              ON &nbsp;&nbsp;
              <input type="radio" name="status" value="0" checked="checked" >
              Off</span></td>';
			 } 
          $output.='</tr>';
		  if($arr[0]['html_content']!='')
		  {
		  $output.='<tr><td align="right" class="content_form">Landing Content:</td>
		  <td align="" class="">'.$arr[0]['html_content'].'</td></tr>';
		  }
$output.='</tr>';
		
	return $output;
	}
}
?>