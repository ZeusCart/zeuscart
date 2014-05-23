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
 * This class contains functions related customer group management.
 *
 * @package  		Display_DCustomerGroup
 * @category  		Display
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
 * @copyright 	        Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */

class Display_DCustomerGroup
{

	/**
	 * Function to show customer group list. 
	 * @param array $arr
	 * @param integer $flag	 
	 * @param integer $paging
	 * @param integer $prev	 
	 * @param integer $next	 
	 * @return string
	 */
	function displayCustomerGroup($arr,$paging,$prev,$next,$Err)
	{
	
		$output = '<form name="search" method="post" action="?do=custgroup&action=search" >';
		$output .= '';	
		
		$output.='<script language="JavaScript">
				function condelete()
				{
					var confrm;
					confrm=window.confirm("Are You sure to delete this record");
					return confrm;
				}</script>  <div class="blocks" style="opacity: 1;">
		<div class="clsListing clearfix"><table cellspacing="0" cellpadding="0" border="0"  class="table table-striped table-bordered  table-hover">

		<thead class="green_bg">
		<tr>
		
		<th align="left">S.No</th>
		<th align="left">Group Name</th>
		<th align="left">Discount (in %)</th>
		
		<th align="left">Options</th>

		</tr>
		</thead>
		<tbody>';
		$cnt = count($arr);
		$output .= '<tr class="list_search_bg" >
		<td class="content_list_txt1"></td>
		<td class="content_list_txt1"><input type="text"  name="grpname" id="grpname" size="30"  style="width:75px;"  value="'.$_POST['grpname'].'"/></td>
		<td class="content_list_txt1"><input type="text" size="30"  style="width:75px;" name="discount" id="discount" value="'.$_POST['discount'].'"/></td>
		';
		$output.='<td class="content_list_txt1"><input class="clsBtn" type="submit" name="search" value="Search"/></td></tr></form>';
		
		if($cnt=='0')
			$output .= '<tr><td align="center" colspan="7"><font color="orange"><b>No Record Found</b></font></td></tr>';
		else
		{
			for ($i=0;$i<count($arr);$i++)
			{
				
				$output.='';
				$output .= '<tr>
					    <td  >'.($i+1).'</td>
					    <td ><a href="?do=customerdetail&action=detail&userid='.$arr[$i]['group_id'].'">'.$arr[$i]['group_name'].'</a></td>
					    <td >'.$arr[$i]['group_discount'].'</td>';
				$output .='				';
								
				$output .='<td  align="center"><a title="Edit"  href="?do=custgroup&amp;action=edit&amp;id='.$arr[$i]['group_id'].'"><i class="icon icon-edit"></i></a>
				
					<a onclick="return confirm(\'Are you sure want to delete?\')" id="delete_admin_user" title="Delete"  href="?do=custgroup&action=delete&id='.$arr[$i]['group_id'].'"><i class="icon-trash"></i></a></td></tr>';

 
			}


		}
		$output .='<tr>
		<td colspan="7" class="clsAlignRight">
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
		

		$output .= '</tbody></table></div></div>';
		return $output;

	}

	function displaySelectedGroup($row,$Err,$values)
	{
		
	           $id=$row[0]['group_id'];

		   if($values['group_name'] != '' && $values['group_discount'] !='')
		   {
			$groupname= $values['group_name'];
     		        $discount= $values['group_discount'];

		   }		
		   else
		   {
                  	$groupname= $row[0]['group_name'];
     		        $discount= $row[0]['group_discount'];
                   }		
 
		
		$output = '<div class="row-fluid">
			<div class="span6">
			<label>Group Name :</label>
			<input type="text" name="txtgrpname" id="txtgrpname" value="'.$groupname.'"  class="span8" /> <font color="#FF0000" size="-2" >'.$Err['txtgrpname'].'
			</font>
			</div></div><div class="row-fluid">
			<div class="span6">
			<label>Discount (in %) :</label>
			<input type="text" name="txtdiscount" id="txtdiscount" value="'.$discount.'" class="span8" /> <font color="#FF0000" size="-2" >'.$Err['txtdiscount'].'
			</font>
			</div>	
			</div> <input type="hidden" name="groupid" id="groupid" value="'.$id.'" />       ';
	

	  	 return $output;
	}
}
?>