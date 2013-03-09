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
 * DNewsSettings
 *
 * This class contains functions to list out the available news.
 *
 * @package		Display_DNewsSettings
 * @category	Display
 * @author		ZeusCart Team
 * @link		http://www.zeuscart.com
 * @version 	2.3
 */

// ------------------------------------------------------------------------

class Display_DNewsSettings
{
	/**
	 * Function creates a template to display the news available. 
	 * @param array $arr
	 * @param integer $flag
     * @param integer $paging
	 * @param integer $prev	 
	 * @param integer $next	 	  
	 * @return string
	 */
	
	
	function showNews($arr,$flag,$paging,$prev,$next)
	{    
	
		$output = "";
		//echo "<pre>";
		//print_r($arr);
		$output .= '<table width="100%" border="0" cellpadding="0" cellspacing="0" class="content_list_bdr">
              <tr>
                <td class="content_list_head">S.No</td>
                <td class="content_list_head">News Title</td>
				<td align="center" class="content_list_head">Created Date</td>
				<td align="center" class="content_list_head">Status</td>
			
                <td colspan="2" align="center" class="content_list_head">Delete</td>
                </tr>
              <tr>
                <td colspan="6" class="cnt_list_bot_bdr"><img src="images/list_bdr.gif" alt="" width="1" height="2" /></td>
              </tr>
			  ';
		//$output.='<th>S.no.</th><th>Newsletter title</th><th>Created Date</th><th>Status</th><th colspan="2">Options</th>';
		for ($i=0;$i<count($arr);$i++)
		{
			//$msg=substr($msg,0,30).'..';
			if($i % 2 == 0)
				$classtd='class="content_list_txt1"';
			else
				$classtd='class="content_list_txt2"';
			$status=$arr[$i]['news_status'];
			if($status==1)
			{
			$status='active_link'; //sent
			$title='Active';
			}
			else
			{
			$status='inactive_link'; //Not Sent
			$title='InActive';
			}
			$output .= '<tr style="background-color: rgb(255, 255, 255);" onmouseout="listbg(this, 0);" onmouseover="listbg(this, 1);"><td align="center" '.$classtd.'">'.($i+1).'</td><td align="" '.$classtd.'"><a href="?do=news&action=disp&id='.$arr[$i]['news_id'].'" >'.$arr[$i]['news_title'].' </a></td>';
			$output .= '<td align="center" '.$classtd.'">'.$arr[$i]['news_date'].'</td>';
			$output .= '<td align="center" '.$classtd.'" title='.$title.'><a href="?do=news&action=status&id='.$arr[$i]['news_id'].'&status='.$arr[$i]['news_status'].'"><span class='.$status.'></span></a><input type="hidden" value="'.$arr[$i]['news_status'].'" name="newsStatus" /></td> ';
			$output.='<td align="center" '.$classtd.'"><input type="checkbox" name="deletenews[]" id="deletenews" value='.$arr[$i]['news_id'].' /></td>';
		}
		$output .='<tr><td colspan="5" align="center" class="content_list_txt1">'.$prev.' ';
		
		    for($i=1;$i<=count($paging);$i++)
				 $pagingvalues .= $paging[$i]."  ";
		
			$output .= $pagingvalues.' '.$next.'</td></tr>';	
		$output.='</td></tr></table>';
		return $output;
			
	}
	
	/**
	 * Function creates a template to update the available news. 
	 * @param array $arr
	 * 
	 * @return string
	 */
	
	function viewNews($arr)
	{
	
		
		
		$output = "";
		//echo "<pre>";
		//print_r($arr); // ?do=newsletter&action=edit&id='.(int)$_GET['id'].'
		$output.='<form name="viewnews" action="" method="post" >';
		//$output .= '<table border="1"><tr><td>';
		
		$output.='<table width="97%" border="0" cellspacing="0" cellpadding="0" class="content_list_bdr" align="center">
			
				<tr >
            <td width="" align="left" class="label_name">News Title:  <input type="text" name="newstitle" id="newstitle" class="txt_box200" value="'.$arr[0]['news_title'].'" />&nbsp;<a href="?do=news" class="add_link" >Add News</a></td></tr>
<tr>
            <td colspan="3" align="left">&nbsp;</td>
          </tr>
          <tr >';
		$output.='<tr class="">
            <td width="" align="left" class="label_name">News Content: 
<div><textarea name="newsletter" id="newsletter" cols="85" rows="20" >'.$arr[0]['news_desc'].'</textarea>
</td></tr>
<tr><td>&nbsp;</td></tr>
<tr >
<td class="content_list_txt1" align="center"><input type="submit" name="update" id="update" class="all_bttn" value="Update News" onclick="edit('.$arr[0]['news_id'].')" />
</td></tr>
';
		$output.='
                
               
              </tr>';		
		$output .= '</td></tr></table></form>';

		return $output;
	}	
	
	
}
?>