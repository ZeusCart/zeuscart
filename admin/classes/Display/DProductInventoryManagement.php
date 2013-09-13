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
 * This class contains functions to list out the product inventory.
 *
 * @package  		Display_DProductInventoryManagement
 * @category  		Display
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
  * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */
class Display_DProductInventoryManagement
{

	/**
	 * Function  to display   the    inventory
	 * @param array $result
	 * @param integer $paging
	 * @param integerinteger $prev	 
	 * @param integer $next
	 * @return string
	 */	
	function dispInventory($result,$paging,$prev,$next)
	{
		$output='<form method="post" action="?do=productinventory&action=insert">

		<table cellspacing="0" cellpadding="0" border="0"  class="table table-striped table-bordered  table-hover">

		<thead class="green_bg">
		<tr><th>ID</th>
		<th>Product Name</th>
		<th>Re-Order Level</th>
		<th>Stock on Hand</th>
		<th>Status</th>
		<th>Edit</th></tr></thead><tbody>
		';
		$i=1;

		if((count($result))>0)
		{

			foreach($result as $row)
			{
				$invid=$row['inventory_id'];			
				$productid=$row['product_id'];
				$rol=$row['rol'];
				$soh=$row['soh'];
				if ($soh<$rol && $soh>0)
					$clrstr='<div class="orange"><b>Stock Low</b></div>';
				else if($soh<=0)
					$clrstr='<div class="red"><b>No Stock</b></div>';
				else if ($soh==$rol)
					$clrstr='<div class="yellow"><b>Stock Low</b></div>';
				else
					$clrstr='<div class="green"><b>In Stock</b></div>';

				$title=(strlen($row['title'])< 25 ? $row['title'] : substr($row['title'],0,25)."....") ;

				$output.='<tr><td>'.$invid.'</td><td>
				<a href="?do=aprodetail&action=showprod&prodid='.$productid.'">'.$title.'</a></td><td>'.$rol.'</td><td>'.$soh.'</td><td align="center">'.$clrstr.'</td><td><a href="?do=productinventory&action=edit&id='.$invid.'" >&nbsp;<i class="icon icon-edit"></i></a></td></tr>';

				$i++;
			}
			$output.='<tr>
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
		else
		{
			$output .= '<tr><td colspan="6">No records found !</td></tr>';
		}
		$output .= '</tbody></table>';
		
		return $output;
	}
	/**
	 * Function  to display   the   edit inventory
	 * @param array $result
	 * @return string
	 */	
	function editInventory($result)
	{


		$invid=$result[0]['inventory_id'];
		$prdid=$result[0]['product_id'];
		$soh=$result[0]['soh'];
		$rol=$result[0]['rol'];
		$title=$result[0]['title'];	   
		$output="";
		$output.=' <div class="row-fluid">
		<div class="span12">
		<h2 class="box_head green_bg">Product Name : '.$title.'</h2>
		<div class="toggle_container">
		<div class="clsblock">
		<div class="clearfix">
		<input type="hidden" value="'.$invid.'" name="invid" />
		<div class="row-fluid">
		<div class="span6"><label>Re-Order List</label><input type="text" name="rol" value="'.$rol.'"  />
		</div></div> <div class="row-fluid">
		<div class="span6"><label>Stock on Hand</label><input type="text" name="soh" value="'.$soh.'"   /></div></div></div>
		</div>
		</div>
		</div></div>';
		return $output;
	}
}
?>