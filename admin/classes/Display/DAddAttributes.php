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
 * This class contains functions to list out the attributes.
 *
 * @package  		Display_DAttributeSelection
 * @category  		Display
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
  * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */


class Display_DAttributeSelection
{
	
	
	/**
	 * Function display the attributes. 
	 * @param array $arr
	 * @param integer $paging
	 * @param integer $prev	 
	 * @param integer $next	 
	 * @param integer $val	 
	 * @return string
	 */
	
	function listAttribute($arr,$paging,$prev,$next,$val)
	{
		$output = "";
		
		$output .= '

		<table cellspacing="0" cellpadding="0" border="0"  class="table table-striped table-bordered  table-hover">
	
		<thead class="green_bg">
		<tr>
		  <th><input type="checkbox"  onclick="toggleChecked(this.checked)" name="attributecheckall"></th>
	     <th>S.No</th>
         <th>Attribute Name</th>
           

		</tr>
		</thead><tbody>';
		//$output.='<th>S.no.</th><th>Attribute Name</th><th colspan="2">Options</th>';
		for ($i=0;$i<count($arr);$i++)
		{
	
				
			
			$output .= '<tr>
			<td><input type="checkbox" name="attributeCheck[]" class="chkbox" value="'.$arr[$i]['attrib_id'].'"></td>
			<td align="left">'.($val+1).'</td>
			<td align="left"><a href="?do=attributes&action=edit&id='.$arr[$i]['attrib_id'].'">'.$arr[$i]['attrib_name'].'</a></td>';
		
			//$output.='<td align="center" '.$classtd.'><input type="button" class="edit_bttn" name="Edit"  title="Edit" value="" onclick=edit('.$arr[$i]['attrib_id'].') />&nbsp;&nbsp;<input type="button" name="Delete" class="delete_bttn" title="Delete" value="" onclick=callattribs('.$arr[$i]['attrib_id'].') /></td></tr>';
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
		$output .= '</tbody></table>';
		return $output;
			
	}
	
	
	
	/**
	 * Function To Edit an Attributes. 
	 * @param array $arr
	 * @return string
	 */
	function displayAttributes($arr,$Err)
	{	
		$output = "";
		for ($i=0;$i<count($arr);$i++)
		{
			
			$output.='<form name="formsubcatedit" id="updateAttribute" action="?do=attributes&action=update&id='.(int)$_GET['id'].'" method="post" enctype="multipart/form-data">
			<div class="row-fluid">
			 <div class="span6">
			 <label>Attribute Name  <font color="red">*</font>  </label>
			 <input type="text"  name="attributes" id="attrib" value="'.$arr[0]['attrib_name'].'" class="span8"/></div></div>
			</form>';

		}
		return $output;
	}	
 }
?>