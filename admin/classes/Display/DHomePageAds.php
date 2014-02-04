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
 * This class contains functions related to home page ads
 *
 * @package  		Display_DHomePageAds
 * @category  		Display
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
   * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */

class Display_DHomePageAds
{
	/**
	 * Stores the value
	 *
	 * @var array 
	 */	
	//$val = array();
	/**
	 * Stores the output
	 *
	 * @var array 
	 */	
	//$output = array();

	/**
	 * Function to show admin detail. 
	 * @param array $arr
	 * @param integer $flag	 
	 * @param integer $paging
	 * @param integer $prev	 
	 * @param integer $next	 
	 * @return string
	 */
	function showHomePageAdsList($arr,$flag,$paging,$prev,$next)
	{
		$output = '';
		
		$output.='
		<table cellspacing="0" cellpadding="0" border="0"  class="table table-striped table-bordered  table-hover">

		<thead class="green_bg">
		<tr>
		<th width="5%" align="left"><input type="checkbox"  onclick="toggleChecked(this.checked)" name="homePageadscheckall"></th>
		<th align="left">S.No</th>
		<th align="left">Title</th>
		<th class="content_list_head">Logo</th>
		<th class="content_list_head" style="width:40%">Url</th>
		<th class="content_list_head">Status</th>
		</tr>
		</thead>
		<tbody>

		
		';

		$cnt = count($arr);

		if($cnt=='0')
			$output .= '<tr><td align="center" colspan="6">No Record Found</td></tr>';
		else
		{
			for ($i=0;$i<count($arr);$i++)
			{
				if($i % 2 == 0)
					$classtd='class="content_list_txt1"';
				else
					$classtd='class="content_list_txt2"';
				$output.='';
				$output .= '<tr><td><input type="checkbox" name="homePageadcheck[]" class="chkbox" value="'.$arr[$i]['home_page_ads_id'].'"></td><td '.$classtd.' >'.($i+1).'</td><td '.$classtd.'><a href="?do=homepageads&action=edit&id='.$arr[$i]['home_page_ads_id'].'">'.$arr[$i]['home_page_ads_title'].'</a></td><td '.$classtd.'><img src=../'.stripslashes($arr[$i]['home_page_ads_logo']).'  style="width:50%" alt='.$arr[$i]['home_page_ads_title'].'></td>
				<td '.$classtd.'>'.$arr[$i]['home_page_ads_url'].'</td>';				
				
				if($arr[$i]['status']==0)
				{
					$output .='<td ><a href="?do=homepageads&action=accept&id='.$arr[$i]['home_page_ads_id'].'" class="inactive_link" title="Click to active">&nbsp;Inactive</a></td>';
				}
				else
				{
					$output .='<td ><a href="?do=homepageads&action=deny&id='.$arr[$i]['home_page_ads_id'].'" class="active_link" title="Click to In Active">&nbsp;Active</a></td>';
				}
				// $output .='<td><a class="edit_bttn" href="?do=homepageads&amp;action=edit&amp;id='.$arr[$i]['home_page_ads_id'].'">&nbsp;</a>&nbsp;<a href="?do=homepageads&action=delete&id='.$arr[$i]['home_page_ads_id'].'" onclick="javascript:return condelete()" class="delete_bttn"> &nbsp;<!--Delete--> </a></td>';
				$output.='</tr>';
			}
		
		$output .='<tr>
			<td colspan="6" class="clsAlignRight">
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

		$output .= '</tbody></table>';
		return $output;

	}
	
	/**
	 * Function to show home page content. 
	 * @param array $records
	 * @param array $Err
	 * @return string
	 */
	function showHomePageContent($records,$Err)
	{

		if(!empty($Err->messages))
		{
			$home_page_content=$Err->values['home_page_content'];

		}
		else
		{
			$home_page_content=$records['home_page_content'];
		}

		if($records['status']=='0')
		{
			$checked="checked=checked";
		}
		else
		{
			$checked='';
		}
		$output='<div class="row-fluid">
   		 <div class="span6">
	        <label>Home Page  Content <font color="red">*</font>  </label>
		<textarea name="home_page_content" id="home_page_content" class="ckeditor"  style="width: 279px; height: 159px;">'.$home_page_content.'</textarea>
		</div></div>
		
		<div class="row-fluid">
 		<div class="span12"><label>Status</label>
          	 <input name="status" type="checkbox" id="status"  value="0" '.$checked.'/> 
                <p style="margin-top:-20px;margin-left:90px;"> <code> (Enable if the content is displayed  in home page)</code></p></div></div>';
		return $output;
	}
	

}

?>