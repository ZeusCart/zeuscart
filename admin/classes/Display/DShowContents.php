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
class Display_DShowContents
{
	function showContents($arr,$paging,$prev,$next)
	{
	
		$output = "";
		//echo "<pre>";
		//print_r($arr);
		$output .= '<table width="99%" border="0" cellpadding="0" cellspacing="0" align="center" class="content_list_bdr">';
		$output .= '<tr><td class="content_list_head" >S.No</td><td class="content_list_head" >Content</td><td class="content_list_head" align="center" >Edit</td><td align="center" class="content_list_head">Delete</td></tr>';
		//$output.='<th>S.no.</th><th>Html Content Name</th><th>Html Content</th><th colspan="2">Options</th>';
		for ($i=0;$i<count($arr);$i++)
		{
		//print_r($arr[$i]['attrib_name']);
			$output.='<tr  onmouseover="listbg(this, 1);" onmouseout="listbg(this, 0);" style="background-color: rgb(255, 255, 255);"><td align="center" style="padding:5px;width:20px" class=content_list_txt1>'.($i+1).'</td><td class=content_list_txt1><a href="?do=showcontents&action=show&id='.$arr[$i]['html_content_id'].'">'.$arr[$i]['html_content_name'].'</a></td>';
			//$output.='<tr><td align="left" style="padding:5px">Preview:</span></td><td align="right"  style="padding-left:10px;" ><input type="button" name="Edit" class="edit_bttn" title="Edit" value="Edit" onclick=edit('.$arr[$i]['html_content_id'].') /><input type="button" name="Delete" class="delete_bttn" title="Delete" value="Delete" onclick=callcontent('.$arr[$i]['html_content_id'].') /></td></tr><tr><td style="height:5px;"></td></tr>';			
 
		 $output.='<td align="center"  style="padding-left:10px;" class=content_list_txt1 ><input type="button" name="Edit" class="edit_bttn" title="Edit" value="" onclick=edit('.$arr[$i]['html_content_id'].') /></td><td align="center"  style="padding-left:10px;" class=content_list_txt1><input type="button" name="Delete" class="delete_bttn" title="Delete" value="" onclick=callcontent('.$arr[$i]['html_content_id'].') /></td></tr>';			
			//$output.='<tr><td align="left" style="padding-left:10px;">'.$arr[$i]['html_content'].'</td></tr>';			
			//$output.='<tr><td colspan=3> <hr></td></tr>';
		}
		$output .='<tr align="center"><td colspan="8"  class="content_list_footer" >'.' '.$prev.' ';
		
		    for($i=1;$i<=count($paging);$i++)
				 $pagingvalues .= $paging[$i]."  ";
		
		$output .= $pagingvalues.' '.$next.'</td></tr>';
						
		$output .= '</table>';
		return $output;
			
	}
	function showContentsDetail($arr)
	{
	
		$output = "";
		//echo "<pre>";
		//print_r($arr);
		$output .= '<form name="frmcontent" method="post" action="" enctype="multipart/form-data"><table width="99%" border="0" cellpadding="0" cellspacing="0" align="center" class="">
              <tr><td>';
		//$output.='<th>S.no.</th><th>Html Content Name</th><th>Html Content</th><th colspan="2">Options</th>';
		for ($i=0;$i<count($arr);$i++)
		{
		//print_r($arr[$i]['attrib_name']);
			$output.='<tr ><td colspan="2" class="content_list_head">Content</td></tr>';
			$output.='<tr><td align="right"  style="padding-left:10px;" ><input type="button" name="Edit" class="edit_bttn" title="Edit" value="Edit" onclick=edit('.$arr[$i]['html_content_id'].') /><input type="button" name="Delete" class="delete_bttn" title="Delete" value="Delete" onclick=callcontent('.$arr[$i]['html_content_id'].') /></td></tr><tr><td style="height:5px;"></td></tr>';
			
			$output.='<tr><td align="left" style="padding:5px">Name&nbsp;&nbsp;&nbsp;&nbsp;: '.$arr[$i]['html_content_name'].'</td></tr>';
			$output.='<tr><td colspan=3> <hr></td></tr>';
			$output.='<tr><td align="left" style="padding:5px">Preview	:</td></tr>';			
 
			$output.='<tr><td align="left" style="padding-left:10px;">'.$arr[$i]['html_content'].'</td></tr>';			
			
		}
		$output .= '</td></tr></table></form>';
		return $output;
			
	}
	
	function displayContents($arr)
	{
	
		$output = "";
		//echo "<pre>";
		//print_r($arr);
		$output.='<form name="formeditcontents" action="?do=showcontents&action=edit&id='.(int)$_GET['id'].'" method="post" ><table width="99%" border="0" cellpadding="0" cellspacing="0" align="center" class="">';
		//$output .= '<table border="1"><tr><td>';
		//$output.='<th>S.no.</th><th>Html Content Name</th><th>Html Content</th><th colspan="2">Options</th>';
		$output.='<tr>
            <td width="" align="left" class="content_form"> HTML Content Name:
  <input type="text" class="txt_box200" name="contentname" id="cat" value='.$arr[0]['html_content_name'].'  />
</td></tr>
<tr>
            <td colspan="3" align="left">&nbsp;</td>
          </tr>
          <tr class="">
            <td colspan="3" align="left"  class="content_form">HTML Content: 
  <textarea name="htmlcontent" id="htmlcontent" cols="80" rows="20" >'.$arr[0]['html_content'].'</textarea>
</td></tr>
<tr>
                
                <td  colspan="2" align="center" class="">
 <input type="submit" name="submit1" id="sub1" class="all_bttn" value="Update Content" /></td>
 </tr>
 </table>';
		
		$output .= '</form>';
		return $output;
	}	
}
?>
