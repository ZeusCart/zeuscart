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
class Display_DShowSubCategory
{
	function showCategory($arr,$flag)
	{

		
		$output.='<form name="search" method="post" action="?do=showsub&action=search&id='.(int)$_GET['id'].'" > <table width="100%" border="0" cellpadding="0" cellspacing="0" class="content_list_bdr">
              <tr>
                <!--<td width="2%" class="content_list_head" align="center">S.no.</td>-->
				<td width="25%" class="content_list_head" nowrap>Category Icon</td>
                <td width="40%" class="content_list_head">Category Name</td>
                <td width="40%" class="content_list_head">Category Description</td>
                
				<td width="5%" class="content_list_head">Status</td>
                <td width="5%" class="content_list_head" colspan=2 align="center">Actions</td>
             	</tr>
            	<tr>
                <td colspan="7" class="cnt_list_bot_bdr"><img src="images/list_bdr.gif" alt="" width="1" height="2" /></td>
                </tr>';  
				
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
			</select></td><td class="content_list_txt2" colspan="2" align="center"><input type="submit" name="search" class="all_bttn" value="Search"/></td></tr></form>';
				if($flag=='0')
			return $output .= '<tr><td align="center" colspan="5"><font color="orange"><b>No Category Matched</b></font></td></tr>';
			else
			{
				for ($i=0;$i<count($arr);$i++)
				{
		
					if($i % 2 == 0)
						$classtd='class="content_list_txt1"';
					else
					{
						$classtd='class="content_list_txt2"';
					}	
					
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
					$output .= '<tr style="background-color:#FFFFFF;" onmouseout="listbg(this, 0);" onmouseover="listbg(this, 1);">
					<!--<td align="center" '.$classtd.'>'.($i+1).'</td>-->';
					$output .='<td '.$classtd.' align="center" >';
					if(file_exists('../'.$arr[$i]['image']))
			$output.='<img src="../'.$arr[$i]['image'].'" name="image1"  width="30" height="30" id="image2" border="0"/></td>';
			else
			$output.='<img src="../images/noimage.jpg" border="0" width="30" height="30"/></td>';
					
		
			if($flag==3)
			{
			$output.='<td '.$classtd.'>'.$arr[$i]['SubCategory'].'</td>';
			}		
			elseif($flag!=3)
			{
			$output.='<td '.$classtd.'><a href="?do=showsubundercat&action=show&id='.$arr[$i]['category_id'].'">'.$arr[$i]['SubCategory'].'</a></td>';
			}	
		

			
				$output.='<td '.$classtd.'>'.$category_desc.'</td>
					<td '.$classtd.' align="center"><span class="'.$catstatus.'">&nbsp;</span></td>';
					
					$output.='<td '.$classtd.'><input type="button" name="Edit" class="edit_bttn"   title="Edit" value="" onclick=edit('.$arr[$i]['category_id'].','.(int)$_GET['id'].') /></td>';
					$output.='<td '.$classtd.'><input type="button" name="Delete" class="delete_bttn"  title="Delete" value="" onclick=callid('.$arr[$i]['category_id'].','.$arr[$i]['category_parent_id'].','.$arr[$i]['sub_category_parent_id'].') /></td></tr>';	
					
					
				/*if(file_exists('../uploadedimages/caticons/thumb/thumb_'.$img[2]))
					$output.='<img src="../uploadedimages/caticons/thumb/thumb_'.$img[2].'" name="image1"  width="30" height="30" id="image2" border="0"/></td>';
				else
					$output.='<img src="../images/noimage.jpg" border="0" width="30" height="30"/></td>';
							$output.='<td '.$classtd.'>'.$arr[$i]['SubCategory'].'</td><td '.$classtd.'>'.$category_desc.'</td>';
							*/
				
				}
		
		}		
			$output .= '</table>';
			return $output;
	}
	
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
	
	function getCategoryname($id)
	{
		$sql = "SELECT category_name FROM category_table where category_id=".$id;
		$query = new Bin_Query();
		$query->executeQuery($sql);
		return $query->records[0]['category_name'];
	}	
	
	function displaySubCategory($arr)
	{
		$output ="";
		$temp=$arr[0]['category_image'];
		//$img=explode('/',$temp);
		//print_r( $img[2]);
		$output.='<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr><td class="content_list_head" colspan="2">Edit Sub Category</td></tr><tr><td>';
		$output.='<form name="formsubcatedit" action="?do=showsub&action=edit&id='.(int)$_GET['mid'].'&subid='.(int)$_GET['id'].'" method="post" enctype="multipart/form-data">';
		$output.='<table width="100%" border="0" cellspacing="0" cellpadding="0">';
		
		$output.='<input type="hidden" name="index" value="">';
		$output .= '
		
		<tr><td  align="left" class="content_form" width="25%">Category Name :</td>
            <td colspan="3" class="content_form"><input type="text" name="category" class="txt_box250" id="cat" value="'.$arr[0]['category_name'].'" />
            </p>
            </td>
              </tr>
			
		<tr><td align="left" class="content_form">Category Description:</td>
                <td colspan="3" class="content_form"><input type="text" name="categorydesc" class="txt_box250" id="catdesc" value="'.$arr[0]['category_desc'].'" /></td>
              </tr>
              <tr><td align="left" class="content_form">Category Image:</td>
		<td colspan="3" ><input type="file" name="caticon" id="caticon" /></td>
		<td ></td><td colspan="3" align="center" ><img src="../'.$temp.'" name="image1"  id="image2" /></td>
              </tr>
		 <tr>
            <td align="left" class="content_form">Status :</td>
            <td colspan="3" class=""><span>';
			if($arr[0]['category_status']=='1')
			{
			$output.='  <input type="radio" name="status" value="1" checked="checked">
              On &nbsp;&nbsp;
              <input type="radio" name="status" value="0"  >
              Off</span></td>';
			}
			else
			{
				$output.='  <input type="radio" name="status" value="1" >
              On &nbsp;&nbsp;
              <input type="radio" name="status" value="0" checked="checked" >
              Off</span></td>';
			 } 
          	$output.='</tr>';
		  if($arr[0]['html_content']!='')
		  {
		  $output.='<tr><td align="left" class="content_form">Landing Content:</td>
		  <td align="" class="">'.$arr[0]['html_content'].'</td></tr>';
		  }
		$output.='</tr>';
		return $output;
	}

	function displaySubUnderSubCategory($arr)
	{
		$output ="";
		$temp=$arr[0]['category_image'];
		
		$output.='<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr><td class="content_list_head" colspan="2">Edit Sub Category</td></tr><tr><td>';
		$output.='<form name="formsubcatedit" action="?do=showsubundercat&action=edit&id='.(int)$_GET['mid'].'&subid='.(int)$_GET['id'].'" method="post" enctype="multipart/form-data">';
		$output.='<table width="100%" border="0" cellspacing="0" cellpadding="0">';
		
		$output.='<input type="hidden" name="index" value="">';
		$output .= '
		
		<tr><td  align="left" class="content_form" width="25%">Category Name :</td>
                <td colspan="3" class="content_form"><input type="text" name="category" class="txt_box250" id="cat" value="'.$arr[0]['category_name'].'" />
               </p>
              </td>
              </tr>
			
		<tr><td align="left" class="content_form">Category Description:</td>
                <td colspan="3" class="content_form"><input type="text" name="categorydesc" class="txt_box250" id="catdesc" value="'.$arr[0]['category_desc'].'" /></td>
                </tr>
                <tr><td align="left" class="content_form">Category Image:</td>
		<td colspan="3" ><input type="file" name="caticon" id="caticon" /></td>
		<td ></td><td colspan="3" align="center" ><img src="../'.$temp.'" name="image1"  id="image2" /></td>
                </tr>
		 <tr>
		<td align="left" class="content_form">Status :</td>
		<td colspan="3" class=""><span>';
			if($arr[0]['category_status']=='1')
			{
				$output.='  <input type="radio" name="status" value="1" checked="checked">
				On &nbsp;&nbsp;
				<input type="radio" name="status" value="0"  >
				Off</span></td>';
			}
			else
			{
				$output.='  <input type="radio" name="status" value="1" >
				On &nbsp;&nbsp;
				<input type="radio" name="status" value="0" checked="checked" >
				Off</span></td>';
			 } 
         		 $output.='</tr>';
		  if($arr[0]['html_content']!='')
		  {
		  $output.='<tr><td align="left" class="content_form">Landing Content:</td>
		  <td align="" class="">'.$arr[0]['html_content'].'</td></tr>';
		  }
		$output.='</tr>';
		return $output;
	}
}
?>