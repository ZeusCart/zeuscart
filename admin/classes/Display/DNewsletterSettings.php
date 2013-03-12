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
 * This class contains functions to list out the news letter settings available.
 *
 * @package  		Display_DNewsletterSettings
 * @category  		Display
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
  * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */

class Display_DNewsletterSettings
{
	
	/**
	 * Function creates a template to display the available news letters. 
	 * @param array $arr
	 * 
	 * @return string
	 */
	
	
	function showNewsletter($arr)
	{
	
		$output = "";
		
		$output .= '<table width="100%" border="0" cellpadding="0" cellspacing="0" class="content_list_bdr">
              <tr>
                <td class="content_list_head">S.No</td>
                <td class="content_list_head">NewsLetter Title</td>
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
			$ndate_time=$arr[$i]['newsletter_date_added'];
			$n_date_time = explode(" ",$ndate_time);
			$n_date = explode("-",$n_date_time[0]);
			$n_time = explode(":",$n_date_time[1]);
			$ndate=date("l, M d, Y ",mktime($n_time[0],$n_time[1],$n_time[2],$n_date[1],$n_date[2],$n_date[0]));
			
			if($i % 2 == 0)
				$classtd='class="content_list_txt1"';
			else
				$classtd='class="content_list_txt2"';
			$status=$arr[$i]['newsletter_status'];
			if($status==1)
			{
			$status='active_link'; //sent
			}
			else
			{
			$status='inactive_link'; //Not Sent
			}
			$output .= '<tr style="background-color: rgb(255, 255, 255);" onmouseout="listbg(this, 0);" onmouseover="listbg(this, 1);"><td align="center" '.$classtd.'">'.($i+1).'</td><td align="" '.$classtd.'"><a href="?do=newsletter&action=disp&id='.$arr[$i]['newsletter_id'].'" >'.$arr[$i]['newsletter_title'].' </a></td>';
			$output .= '<td align="center" '.$classtd.'">'.$ndate.'</td>';
			$output .= '<td align="center" '.$classtd.'"><span class='.$status.'>&nbsp;</span></td>';
			//$output .= '<td>'.$msg.'</td>';	
			//$output.='<td align="center" '.$classtd.'"><input type="button" name="View"  title="View" value="View" onclick=view('.$arr[$i]['newsletter_id'].') /></td>';		
			$output.='<td align="center" '.$classtd.'"><input type="button" name="delete" class="delete_bttn"  title="delete" value="" onclick=deletenews('.$arr[$i]['newsletter_id'].') /></td>';
		}
			
		$output.='</td></tr></table>';
		return $output;
			
	}
	
	/**
	 * Function creates a template to display the selected news letter. 
	 * @param array $arr
	 * 
	 * @return string
	 */
	
	function viewNewsletter($arr)
	{
	
		$output = "";
		// ?do=newsletter&action=edit&id='.(int)$_GET['id'].'
		$output.='<form name="viewnewsletter" action="" method="post" >';
		//$output .= '<table border="1"><tr><td>';
		
		$output.='<table width="97%" border="0" cellspacing="0" cellpadding="0" class="content_list_bdr" align="center">
			
				<tr class="content_list_txt1">
            <td width="" align="left" class="label_name">Newsletter Title:  <input type="text" name="newslettertitle" id="newslettertitle" class="txt_box200" value="'.$arr[0]['newsletter_title'].'" />&nbsp;<a href="?do=newsletter" class="add_link" >Add Newsletter</a></td></tr>
<tr>
            <td colspan="3" align="left">&nbsp;</td>
          </tr>
          <tr class="content_list_txt1">';
		$output.='<tr class="content_list_txt1">
            <td width="" align="left" class="label_name">NewsLetter Content: 
<div><textarea name="newsletter" id="newsletter" cols="85" rows="20" >'.$arr[0]['newsletter_content'].'</textarea>
</td></tr>
<tr><td>&nbsp;</td></tr>
<tr class="content_list_txt1">
<td class="content_list_txt1" align="center"><input type="submit" name="update" id="update" class="all_bttn" value="Update Newletter" onclick="edit('.$arr[0]['newsletter_id'].')" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="submit" name="send" id="send" value="Send Newsletter" class="all_bttn" onclick="sendmail('.$arr[0]['newsletter_id'].')" /></td></tr>
';
		$output.='
                
               
              </tr>';		
		$output .= '</td></tr></table></form>';

		return $output;
	}	
	
	/**
	 * Function creates a template to display the list of subscribed users for the news letter. 
	 * @param array $arr
     * @param integer $paging
	 * @param integer $prev	 
	 * @param integer $next	 	  
	 * @return string
	 */
	
	
	function subscribedUsers($arr,$paging,$prev,$next)
	{
	
		$output = "";
		 // ?do=newsletter&action=edit&id='.(int)$_GET['id'].'
		$output .= '<table width="100%" border="0" cellpadding="0" cellspacing="0" class="content_list_bdr">
              <tr>
                <td class="content_list_head" align="center">S.No</td>
                <td class="content_list_head">Email</td>

				<td align="left" class="content_list_head">Status</td>
			
                
                </tr>
              <tr>
                <td colspan="3" class="cnt_list_bot_bdr"><img src="images/list_bdr.gif" alt="" width="1" height="2" /></td>
              </tr>
			  ';
		
		for ($i=0;$i<count($arr);$i++)
		{
		
			if($i % 2 == 0)
				$classtd='class="content_list_txt1"';
			else
				$classtd='class="content_list_txt2"';
			$status=$arr[$i]['newsletter_status'];
			if($arr[$i]['status']==1)
			{
			$status='active_link';
			}
			else
			{
			$status='inactive_link';
			}
			$output .= '<tr style="background-color: rgb(255, 255, 255);" onmouseout="listbg(this, 0);" onmouseover="listbg(this, 1);"><td align="center" '.$classtd.'">'.($i+1).'</td><td align="" '.$classtd.'">'.$arr[$i]['email'].' <br />
			</td>';			
			$output .= '<td align="center" '.$classtd.'"><span class="'.$status.'">&nbsp;</span></td>';
			}
			
		$output.='</tr>';
		$output.='<tr>
                <td colspan="3" class="content_list_txt1" align="center">'.$prev.' ';
		
		    for($i=1;$i<=count($paging);$i++)
				 $pagingvalues .= $paging[$i]."  ";
		
			$output .= $pagingvalues.' '.$next.'</td>
              </tr>';
		$output.='</table>';
		return $output;
	}	
}
?>