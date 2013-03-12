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
	     $output='<form method="post" action="?do=productinventory&action=insert"><table cellpadding="4" cellspacing="0" border="0" width="100%"  class="content_list_bdr"><tr><td  class="content_list_head">S.No</td><td  class="content_list_head">Product Name</td><td class="content_list_head">Re-Order Level</td><td  class="content_list_head">Stock on Hand</td><td class="content_list_head">Status</td><td  class="content_list_head">Edit</td><tr><td colspan="8" class="cnt_list_bot_bdr" valign="top"><img src="images/list_bdr.gif" alt="" width="1" height="2" /></td></tr>';
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
			 	if($i%2!=0)
				{
					$output.='<tr style="background-color:#FFFFFF;" onmouseout="listbg(this, 0);" onmouseover="listbg(this, 1);"><td class="content_list_txt2">'.$i.'</td><td class="content_list_txt2">
					<a href="?do=aprodetail&action=showprod&prodid='.$productid.'">'.$title.'</a></td><td class="content_list_txt2">'.$rol.'</td><td class="content_list_txt2">'.$soh.'</td><td class="content_list_txt2" align="center">'.$clrstr.'</td><td class="content_list_txt2"><a href="?do=productinventory&action=edit&id='.$invid.'" class="edit_bttn">&nbsp;<!--Edit--></a></td></tr>';
				}
				 else
				 {
					 $output.='<tr style="background-color:#FFFFFF;" onmouseout="listbg(this, 0);" onmouseover="listbg(this, 1);"><td class="content_list_txt1">'.$i.'</td><td class="content_list_txt1">
					 <a href="?do=aprodetail&action=showprod&prodid='.$productid.'">'.$title.'</a></td><td class="content_list_txt1">'.$rol.'</td><td class="content_list_txt1">'.$soh.'</td><td class="content_list_txt1" align="center">'.$clrstr.'</td><td class="content_list_txt1"><a href="?do=productinventory&action=edit&id='.$invid.'" class="edit_bttn">&nbsp;<!--Edit--></a></td></tr>';
				 }				 
				 $i++;
			}
			$output.='<tr style="background-color:#FFFFFF;" onmouseout="listbg(this, 0);" onmouseover="listbg(this, 1);"><td class="content_list_txt1" colspan="6" align="center">'.$prev.' ';
		
		    for($i=1;$i<=count($paging);$i++)
				 $pagingvalues .= $paging[$i]."  ";
		
		$output .= $pagingvalues.' '.$next.'</td></tr>';
		}
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
	 $output="<table cellpadding='8' cellspacing='0' border='0' width='100%'  class='' style='padding-left:10px'>";
	   $output.="<tr style='background-color:#FFFFFF;' onmouseout='listbg(this, 0);' onmouseover='listbg(this, 1);' ><td width='20%' class='content_form'>Product Name</td><td class='content_form'><input type='hidden' value=".$invid." name='invid' />".$title."</td></tr><tr><td td class='content_form'>Re-Order List</td><td class='content_form'><input type='text' name='rol' value='".$rol."' size=5 style='text-align:right' /></td></tr><tr><td td class='content_form'>Stock on Hand</td><td class='content_form'><input type='text' name='soh' value='".$soh."' size=5 style='text-align:right' /></td></tr><tr ><td class='content_form' colspan='2' align='center'><input type='submit' name='update' value='Update Inventory' class='all_bttn'/></td></tr></table>";
	   return $output;
	}
}
?>