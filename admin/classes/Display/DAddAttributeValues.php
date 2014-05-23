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
 * This class contains functions to list out the attributes values.
 *
 * @package  		Display_DAttributeValueSelection
 * @category  		Display
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
 * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */

class Display_DAttributeValueSelection
{

	/**
	 * Function to get curresponding attribute values. 
	 * @param array $arr
	 * @param string $attname
	 * @return string
	 */
	function getAttribListValues($arr,$attname,$Err)
	{ 
	

		if($Err->messages!='')
		{
			$attname=$Err->values['id'];
		}

		$output.='<select name="id" class="attrib_box"><option value="all">All attributes</option>';
		for($i=0;$i<count($arr);$i++)
		{
			
			if($attname == $arr[$i]['attrib_id'])
			{
				$output.='<option value="'.$arr[$i]['attrib_id'].'" selected>'.$arr[$i]['attrib_name'].'</option>';
			}
			else 
				$output.='<option value="'.$arr[$i]['attrib_id'].'" >'.$arr[$i]['attrib_name'].'</option>';
		}	
		$output.='</select >';
		return $output;	
	}
	/**
	 * Function display the attributes values. 
	 * @param array $arr
	 * @param integer $paging
	 * @param integer $prev	 
	 * @param integer $next	 
	 * @param integer $val	 
	 * @return string
	 */
	function listAttributeValue($arr,$paging,$prev,$next,$val)
	{
		$output = "";
		
		$output .= '<table cellspacing="0" cellpadding="0" border="0"  class="table table-striped table-bordered  table-hover">

		<thead class="green_bg">
		<tr>

		<th align="left"><input type="checkbox"  onclick="toggleChecked(this.checked)" name="attributevaluecheckall"></th>
		<th align="left">S.No</th>
		<th align="left">Attribute Name</th>
		<th align="left">Attribute Value</th>
		</tr>
		</thea>
		<tbody>';
		
		for ($i=0;$i<count($arr);$i++)
		{
			
			
			$output .= '<tr >
			<td><input type="checkbox" name="attributevalueCheck[]" class="chkbox" value="'.$arr[$i]['attrib_value_id'].'"></td>
			<td align="left" >'.($val+1).'</td><td align="left" >'.$arr[$i]['attrib_name'].'</td><td align="left" ><a href="?do=attributevalues&action=edit&id='.$arr[$i]['attrib_value_id'].'">'.$arr[$i]['attrib_value'].'</a></td>';
			
			
			$output.='</tr>';


			$val++;
		}
		

		$output.='<tr>
		<td colspan="4" class="clsAlignRight">
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
		</tr>

		</tbody></table>';
		return $output;

	}
	/**
	 * Function To Edit an Attributes values. 
	 * @param array $arr
	 * @return string
	 */
	function displayAttributeValues($arr,$Err)
	{
		if(!empty($Err->messages))
		{
			$attrib_value=$Err->values['attrib_value'];
		}
		else
		{

			$attrib_value=$arr[0]['attrib_value'];
		}

		$output='<form name="formsubcatedit" id="updateAttributevalue" action="?do=attributevalues&action=update&id='.(int)$_GET['id'].'" method="post" enctype="multipart/form-data">
		<div class="row-fluid">
		<div class="span12">
		<label>Attribute Values <font color="red">*</font> </label>
		<input type="text" name="attributevalues" class="span3" id="attrib" value="'.$attrib_value.'" /></div></div>
		</form>';
		
		return $output;
	}	
}
?>