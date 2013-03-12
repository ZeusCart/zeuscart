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
	function getAttribListValues($arr,$attname)
	{ 	
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
		
		$output .= '<table width="100%" border="0" cellpadding="0" cellspacing="0" class="content_list_bdr">
          <td colspan="2"><tr>
                <td width="5%" class="content_list_head" align="center">S.No</td>
                <td width="41%" class="content_list_head">Attribute Name</td>
				<td width="90%" class="content_list_head">Attribute Value</td>
                <td colspan="2" align="center" class="content_list_head">Actions</td>
                </tr>
              <tr>
                <td colspan="5" class="cnt_list_bot_bdr"><img src="images/list_bdr.gif" alt="" width="1" height="2" /></td>
              </tr>';		//$output.='<th>S.no.</th><th>Attribute Name</th><th>Attribute Value</th><th colspan="2">Options</th>';
		for ($i=0;$i<count($arr);$i++)
		{
			if($i % 2 == 0)
				$classtd='class="content_list_txt1"';
			else
				$classtd='class="content_list_txt2"';
			$output.='<input type=hidden name=index value="">';
			
			$output .= '<tr style="background-color:#FFFFFF;" onmouseout="listbg(this, 0);" onmouseover="listbg(this, 1);"><td align="center" '.$classtd.'">'.($val+1).'</td><td align="left" '.$classtd.'">'.$arr[$i]['attrib_name'].'</td><td align="left" '.$classtd.'">'.$arr[$i]['attrib_value'].'</td>';
			
			$output.='<td align="center" '.$classtd.'"><input type="button" class="edit_bttn" name="Edit"  title="Edit" value="" onclick=edit('.$arr[$i]['attrib_value_id'].') /></td>';
			$output.='<td align="center" '.$classtd.'"><input type="button" class="delete_bttn" name="Delete"  title="Delete" value="" onclick=callattribvalues('.$arr[$i]['attrib_value_id'].') /></td></tr>';
			$val++;
		}
		
			
			$output.='<tr align="center"><td colspan="8"  class="content_list_footer" >'.' '.$prev.' ';
		    for($i=1;$i<=count($paging);$i++)
				 $pagingvalues .= $paging[$i]."  ";
				 	 	$output .= $pagingvalues.' '.$next.'</td></tr></table>';
			return $output;
			
	}
	/**
	 * Function To Edit an Attributes values. 
	 * @param array $arr
	 * @return string
	 */
	function displayAttributeValues($arr)
	{
		$output = "";
		for ($i=0;$i<count($arr);$i++)
		{
			$output.='<form name="formsubcatedit" action="?do=addattributevalues&action=edit&id='.(int)$_GET['id'].'" method="post" enctype="multipart/form-data">
			<tr>
            <td colspan="3" align="left">&nbsp;</td>
          </tr>
			<tr>
			<td width="20%" align="left" class="content_form"> Attribute Values:</td>

			<td width="31%" align="center" class="content_form"><input type="text" name="attributevalues" class="txt_box200" id="attrib" value="'.$arr[0]['attrib_value'].'" /></td>
			<td width="50%" align="left"><input type="submit" class="all_bttn" name="btnsubmit" value="Update" id="submit"  /></td>
			</tr>
			</form>';
		}
		return $output;
	}	
}
?>