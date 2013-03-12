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
 * This class contains  product msrp management related process.
 *
 * @package  		Display_DProductMsrpManagement
 * @category  		Display
 * @author    		AjSquareInc Dev Team
 * @link   		  http://www.zeuscart.com
  * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */
 class Display_DProductMsrpManagement
{

	/**
	 * Function  to display   the   manufacturer's suggested retail price  by quantity
	 * @param array $result
	 * @param string $prname
	 * @return string
	 */	
 	function displayMsrpByQuantity($result,$prname)
	{
		$id=$_GET['id'];
	  
		$output='<form method="post" action="?do=msrpmgt&action=insert&id='.$id.'">
		<table><tr><td><a href="?do=aprodetail&action=showprod&prodid='.$id.'">'.$prname.'</a></td></tr></table>
		<table cellpadding="4" cellspacing="0" border="0" width="100%"  class="content_list_bdr">
	   	<tr>
	   		<td  class="content_list_head">SNo</td>
			<!--<td  class="content_list_head">Product Name</td>-->
			<td class="content_list_head">Quantity</td>
			<td  class="content_list_head">Msrp Per Unit</td>
			<td  class="content_list_head">Actions</td>
		</tr>
		<tr>
			<td colspan="7" class="cnt_list_bot_bdr" valign="top"><img src="images/list_bdr.gif" alt="" width="1" height="2" /></td>
		</tr>';
		
		$i=1;
	    	
		if((count($result))>0)
		{
		    
			foreach($result as $row)
			{
				$msrpid=$row['id'];
				$prname=$row['title'];
				$quantity=$row['quantity'];
				$msrp=number_format($row['msrp'],2);
				 
				if($i%2!=0)
				{
					$output.='<tr style="background-color:#FFFFFF;" onmouseout="listbg(this, 0);" onmouseover="listbg(this, 1);">
						<td class="content_list_txt2">'.$i.'</td><!--<td class="content_list_txt2"><a href="?do=aprodetail&action=showprod&prodid=$id">$prname</a></td>-->
						<td class="content_list_txt2">'.$quantity.' and above</td>
						<td class="content_list_txt2">$ '.$msrp.'</td>
						<td class="content_list_txt2"><a href="?do=msrpmgt&action=edit&id='.$id.'&msrpid='.$msrpid.'" class="edit_bttn" title="Edit">&nbsp;</a>&nbsp;&nbsp;<a href="?do=msrpmgt&action=delete&msrpid='.$msrpid.'&id='.$id.'" class="delete_bttn" onclick="return confirm(\'Do you want to delete\');">&nbsp;</a></td>
						</tr>';
				 }
				 else
				 {
				 $output.='<tr style="background-color:#FFFFFF;" onmouseout="listbg(this, 0);" onmouseover="listbg(this, 1);">
				 	<td class="content_list_txt1">'.$i.'</td>
					<!--<td class="content_list_txt1"> <a href="?do=aprodetail&action=showprod&prodid=$id">$prname</a></td>--><td class="content_list_txt1">'.$quantity.' and above</td>
					<td class="content_list_txt1">$ '.$msrp.'</td>
					<td class="content_list_txt1"><a href="?do=msrpmgt&action=edit&id='.$id.'&msrpid='.$msrpid.'" class="edit_bttn">&nbsp;</a>&nbsp;&nbsp;<a href="?do=msrpmgt&action=delete&msrpid='.$msrpid.'&id='.$id.'" class="delete_bttn" onclick="return confirm(\'Do you want to delete\');">&nbsp;</a>
					</td></tr>';
				 }				 
				 $i++;
			}
			
		}
		$output.='<tr>
				<td class="content_list_txt1"><input type="hidden" name="id" value="'.$id.'" /><input type="hidden" name="msrpid" value="'.$msrpid.'" /></td>
				<!--<td class="content_list_txt1">'.$prname.'</td>--><td class="content_list_txt1"><input type="text" size="3" name="quantity" /> and above</td>
				<td class="content_list_txt1"><input size="5" type="text" name="msrp" /> </td>
				<td class="content_list_txt1"><input type="submit" name="insert" class="all_bttn"  value="Insert" /></td>
			</tr>
			</table>
			</form>';
	    return $output;
	}
	/**
	 * Function  to display   the  edit  manufacturer's suggested retail price  by quantity
	 * @param array $result
	 * @return string
	 */	
	function editMsrpByQuantity($result)
	{
       		$id=$_GET['id'];
		$msrpid=$_GET['msrpid'];
		if((count($result))>0)
		{
			$output='
			<form method="post" action="?do=msrpmgt&action=update&id='.$id.'" >
			<table cellpadding="4" cellspacing="2" border="0" width="100%">';		  
		    
		    	foreach($result as $row)
			{
				$msrpid		=$row['id'];
				$title		=$row['title'];
				$quantity	=$row['quantity'];
				$msrp		=number_format($row['msrp'],2);
				
				$output.='<tr>
						<td class="content_list_txt1" align="right"><input type="hidden" name="id" value="'.$id.'"/><input type="hidden" name="msrpid" value='.$msrpid.' >Product Name</td>
						<td class="content_list_txt1" >'.$title.'</td>
					</tr>
					<tr>
						<td class="content_list_txt1" align="right">Quantity</td>
						<td class="content_list_txt1"><input type="text" size="3" name="quantity" value='.$quantity.'></td></tr><tr><td class="content_list_txt1" align="right">Msrp $</td>
						<td class="content_list_txt1"><input type="text" size="5" name="msrp" value='.$msrp.'></td>
					</tr>';
			}
			$output.='<tr>
					<td></td>
					<td align="left"><input type="submit" value="Update MSRP" name="update" class="all_bttn" /></td>
					
				</tr>
			</table>
			<form>
			';
		}
		return $output;

	}
	
}
?>