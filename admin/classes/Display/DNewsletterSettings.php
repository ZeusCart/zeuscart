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
		
		$output .= '<div class="clsListing clearfix">

		<table cellspacing="0" cellpadding="0" border="0"  class="table table-striped table-bordered  table-hover">

		<thead class="green_bg">
		<tr>
		<th  align="left"><input type="checkbox"  onclick="toggleChecked(this.checked)" name="newslettercheckall"></th>
		<th  align="left">S.No</th>
		<th align="left"  width="50%">NewsLetter Title</th>
		<th align="left" >Created Date</th>
		<th align="left"  width="10%">Options</th>
		</tr>
		</thead>
		<tbody>';
		//$output.='<th>S.no.</th><th>Newsletter title</th><th>Created Date</th><th>Status</th><th colspan="2">Options</th>';
		for ($i=0;$i<count($arr);$i++)
		{
			$ndate_time=$arr[$i]['newsletter_date_added'];
			$n_date_time = explode(" ",$ndate_time);
			$n_date = explode("-",$n_date_time[0]);
			$n_time = explode(":",$n_date_time[1]);
			$ndate=date("l, M d, Y ",mktime($n_time[0],$n_time[1],$n_time[2],$n_date[1],$n_date[2],$n_date[0]));
			
		
			$status=$arr[$i]['newsletter_status'];
			if($status==1)
			{

			$status='<span title="Enabled" class="badge badge-info">Active</span>'; //sent
			}
			else
			{
			$status='<span title="Enabled" class="badge badge-important">In Active</span>'; //Not Sent
			}
			$output .= '<tr>
			<td><input type="checkbox" name="newslettercheck[]" class="chkbox" value="'.$arr[$i]['newsletter_id'].'"></td><td align="center" >'.($i+1).'</td><td align="" ><a href="?do=newsletter&action=disp&id='.$arr[$i]['newsletter_id'].'" >'.$arr[$i]['newsletter_title'].' </a></td>';
			$output .= '<td align="center" >'.$ndate.'</td>';
			$output .= '<td align="center" ><a href="?do=newsletter&action=disp&id='.$arr[$i]['newsletter_id'].'"><i class="icon icon-edit"></i></a>
			<a href="javascript:void(0);" onclick="deletenews('.$arr[$i]['newsletter_id'].')";><i class="icon icon-trash"></i></a>
			<a href="?do=newsletter&action=send&newsid=1"><i class="icon icon-inbox"></i></a></td></tr>';
			
		}
			
		$output.='</tbody></table></div>';
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
		$output.='<form name="viewnewsletter" id="editNewsletterId" action="?do=newsletter&action=edit&id='.$arr[0]['newsletter_id'].'" method="post" id="">
		<div class="row-fluid">
  <div class="span12">

    <h2 class="box_head green_bg">Mangage:'.$arr[0]['newsletter_title'].'</h2>
    <div class="toggle_container">
      <div class="clsblock">
        <div class="clearfix">


		';
		
		$output.='	<div class="row-fluid">
  <div class="span6"><label>Newsletter Title</label> <input type="text" name="newslettertitle" id="newslettertitle" class="span8" value="'.$arr[0]['newsletter_title'].'" /></div></div>
';
		$output.='	<div class="row-fluid">
  <div class="span12"><label>NewsLetter Content</label>
		<textarea name="newsletter" class="ckeditor" id="newsletter" cols="85" rows="20" >'.$arr[0]['newsletter_content'].'</textarea></div></div>

';
			
		$output .= '</div>
</div>
</div>
</div></div></form>';

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
		$output .= '

		<table cellspacing="0" cellpadding="0" border="0"  class="table table-striped table-bordered  table-hover">

		<thead class="green_bg">
		<tr>
		<th  align="left">S.No</th>
		<th  align="left">Email</th>
		<th  align="left">Status</th>
		</tr>
		<tbody>
			  ';
		
		for ($i=0;$i<count($arr);$i++)
		{
		
			$status=$arr[$i]['newsletter_status'];
			if($arr[$i]['status']==1)
			{
			$status='<span title="Enabled" class="badge badge-info">Active</span>';
			}
			else
			{
			$status='<span title="Enabled" class="badge badge-important">Suspend</span>';
			}
			$output .= '<tr><td align="center" >'.($i+1).'</td><td align="" >'.$arr[$i]['email'].' <br />
			</td>';			
			$output .= '<td align="center" >'.$status.'</td>';
			}
			
		$output.='</tr>';
		$output.='<tr>
			<td colspan="3" class="clsAlignRight">
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
		$output.='</tbody></table>';
		return $output;
	}	
}
?>