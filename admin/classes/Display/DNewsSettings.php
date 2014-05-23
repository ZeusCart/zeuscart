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
 * This class contains functions to list out the available news.
 *
 * @package  		Display_DNewsSettings
 * @category  		Display
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
  * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */

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
		
		$output .= '

		<table cellspacing="0" cellpadding="0" border="0"  class="table table-striped table-bordered  table-hover">

		<thead class="green_bg">
		<tr>
		<th  align="left"><input type="checkbox"  onclick="togglenewsChecked(this.checked)" name="newscheckall"></th>
		<th  align="left">S.No</th>
		<th align="left">News Title</th>
		<th align="left" style="width:15%" >Created Date</th>
		<th align="left" style="width:15%">Status</th>
		</tr>
		</thead>
		<tbody>
		';

		if(count($arr) > 0)
		{
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
					$title='<span class="badge badge-info">Active</span>';
				}
				else
				{
					$status='inactive_link'; //Not Sent
					$title='<span class="badge badge-important">InActive</span>';
				}
		$output .= '<tr ><td><input type="checkbox" name="newscheck[]" class="chknewsbox" value="'.$arr[$i]['news_id'].'"></td><td >'.($i+1).'</td><td><a href="?do=news&action=disp&id='.$arr[$i]['news_id'].'" >'.$arr[$i]['news_title'].' </a></td>';
		$output .= '<td>'.$arr[$i]['news_date'].'</td>';
		$output .= '<td><a href="?do=news&action=status&id='.$arr[$i]['news_id'].'&status='.$arr[$i]['news_status'].'">'.$title.'</a><input type="hidden" value="'.$arr[$i]['news_status'].'" name="newsStatus" /></td> ';
		$output.='</tr>';
	}
	$output .='<tr>
	<td colspan="5" class="clsAlignRight">
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
}
else
{
	$output.='<tr><td colspan="5">No News Found!</td></tr>';

}
$output.='</tbody></table>';
return $output;

}

	/**
	 * Function creates a template to update the available news. 
	 * @param array $arr
	 * 
	 * @return string
	 */
	
	function viewNews($arr,$Err)
	{

		if(!empty($Err->messages))
		{
			$arr=$Err->values;

			$title=$Err->values['newstitle'];

			$removal= array("rn");
			$desc= str_replace($removal, "", trim($arr[0]['description']));
			$desc=$Err->values['newsletter'];
		}
		else
		{
			$title=$arr[0]['news_title'];
			$desc=$arr[0]['news_desc'];
		}
		$output = "";
		$output.='<form name="viewnews" id="newsUpdateform" action="?do=news&action=edit&id='.$_GET['id'].'" method="post" >';
		$output.='<div class="row-fluid">
		<div class="span12">
		<label>News Title <font color="red">*</font> </label>  <input type="text" name="newstitle" id="newstitle" class="span8" value="'.$title.'" /></div></div>';
		$output.='<div class="row-fluid">
		<div class="span12">
		<label>News Content <font color="red">*</font> </label>
		<textarea name="newsletter" id="newsletter" class="ckeditor" cols="85" rows="20" >'.$desc.'</textarea></div></div>';
		$output .= '</form>';

		return $output;
	}	
	
	
}
?>