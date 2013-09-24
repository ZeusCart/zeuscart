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
 * This class contains functions to list out the FAQs.
 *
 * @package  		Display_DFaq
 * @category  		Display
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
   * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */


class Display_DFaq
{

	/**
	 * Function returns a template that list out the FAQs available. 
	 * @param array $arr
	 * @param integer $paging
	 * @param integer $prev	 
	 * @param integer $next	 
	 * @param integer $val	 
	 * @return string
	 */
	
	function listFaq($arr,$paging,$prev,$next,$val)
	{
		$output = '<form name="faqDelete"  action="?do=faq&action=delete" method="post">
		<table cellspacing="0" cellpadding="0" border="0"  class="table table-striped table-bordered  table-hover">
	
		<thead class="green_bg">
		<tr>
		<th width="5%" align="left"><input type="checkbox"  onclick="toggleChecked(this.checked)" name="faqcheckall"></th>
		<th width="5%" align="left">S.No</th>
		<th align="left" width="90%">Question</th>
		</tr>
		</thead>
		<tbody>
		';
		if(count($arr)>0)
		{
			for ($i=0;$i<count($arr);$i++)
			{

				// echo $arr[$i]['faq_id'];
				$output .= '<tr>
				<td><input type="checkbox" name="faqcheck[]" class="chkbox" value="'.$arr[$i]['faq_id'].'"></td>
				<td>'.($val+1).'</td>
				<td><b><a href="?do=faq&action=add&id='.$arr[$i]['faq_id'].'&flag=1">'.$arr[$i]['faq_qn'].'</a></b>
				</td>';


				// $output.='<td>
				// <a href="?do=faq&action=add&id='.$arr[$i]['faq_id'].'" style="cursor:pointer;text-decoration:none;">
				// <form method="post" action="?do=faq&action=add&id='.$arr[$i]['faq_id'].'">
				// <input type="submit" class="edit_bttn" name="Edit"  title="Edit" value=""/>&nbsp;</form></a></td>';
				// $output.='<td>
				// <a href="?do=faq&action=delete&id='.$arr[$i]['faq_id'].'" style="cursor:pointer;text-decoration:none;"><form method="post" action="?do=faq&action=delete&id='.$arr[$i]['faq_id'].'">
				// <input type="submit" name="Delete" class="delete_bttn" onclick="return confirm(\'Are you sure to delete?\')" title="Delete" value=""/>&nbsp;</form></a></td></tr>';
				$val++;
			}
			$output.='<tr>
			<td colspan="3" class="clsAlignRight">
			<div class="dt-row dt-bottom-row">
			<div class="row-fluid">
			<div class="dataTables_paginate paging_bootstrap pagination">
			<ul>'.' '.$prev.' ';
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
			$output.='<tr><td colspan=4 valign="bottom" align="center">No Faqs Found!<br/>&nbsp;</td></tr>';
		}				
		$output .= '</tbody></table></form>';
		return $output;
		
	}
	
	/**
	 * Function display the list of FAQs. 
	 * @param string $result
	 * @param array $arr
	 *
	 *	 
	 * @return string
	 */
	
	function show($result='',$arr=array())
	{
		$qn='';
		$ans='';
		$btnCaption='Add FAQ';
		$action='insert';
		$icon="save_icon";
		if($_GET['flag']=='1')
		{
			$qn=$arr['faq_qn'];
			$ans=$arr['faq_ans'];
			$btnCaption='Update FAQ';
			$action='edit';
			$icon="update_icon";

		}	
		$output='<div class="menu_new clsBtm_20">
		<div class="row-fluid">
		<div class="span9"><h2>FAQ</h2>
		</div>
		<div class="span3" >
		<ul class="bttn_right">
		<li>
		<a href="javascript:void(0);" class="'.$icon.'" id="addfaqbutton" ></a>
		</li>
		</ul>
		</div>
		</div>
		</div>
		<div class="row-fluid">
		<div class="span12"><h2 class="box_head green_bg">'.$btnCaption.'</h2>
		<div class="toggle_container">
		<div class="clsblock">
		<div class="clearfix">
		<form action="?do=faq&action='.$action.'" method="post" id="addfaqaction">
		<div class="row-fluid">
		<div class="span6">
		<label>Question</label>
		<input type=hidden name=hidid value="'.(int)$_GET['id'].'">
		<input type="text" name="qn" value="'.$qn.'" class="span8" placeholder="Type Question..."></div></div>
		<div class="row-fluid">
		<div class="span12">
		<label>Answer</label>
		<textarea class="ckeditor"  rows="3" name="ans" >'.$ans.'</textarea></div></div>

		</form>

		</div></div></div></div></div>

		';
		return $output;
	}
	
}
?>
