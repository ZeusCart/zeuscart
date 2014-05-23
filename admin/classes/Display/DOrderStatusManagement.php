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
 * This class contains functions to list and edit order status 
 *
 * @package  		Display_DOrderStatusManagement
 * @category  		Display
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
  * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */
 class Display_DOrderStatusManagement
{
	/**
	 * Function  to display   the  order status  
	 * @param array $result
	 * @return string
	 */

 	function displayOrderStatus($result)
	{ 
	     $output='<table cellpadding="4" cellspacing="0" border="0" class="content_list_bdr" width="100%">
		 <tr><td class="content_list_head" width="25%">StatusID</td>
		 <td   class="content_list_head" width="50%">Status Name</td>
		 <td  class="content_list_head">Options</td></tr>
		 <tr ><td colspan="3" class="cnt_list_bot_bdr" valign="top"><img src="images/list_bdr.gif" alt="" width="1" height="2" /></td></tr>';
	     if((count($result))>0)
		 {
		    
			 $i=1;
		     foreach($result as $row)
			 {
			 
			    $id= $row['orders_status_id'];
				$name=$row['orders_status_name'];
				if($i%2==0)
				{
					$output.='<tr style="background-color:#FFFFFF;" onmouseout="listbg(this, 0);" onmouseover="listbg(this, 1);" class="content_list_txt1"><td  class="content_list_txt1">'.$id.'</td><td  class="content_list_txt1">'.$name.'</td><td class="content_list_txt1" style="padding-left:40px;"><a href="?do=orderstatus&action=edit&id='.$id.'&name='.$name.'" class="edit_bttn">&nbsp;<!--Edit--></a></td></tr>';				
				}
				else
					$output.='<tr style="background-color:#FFFFFF;" onmouseout="listbg(this, 0);" onmouseover="listbg(this, 1);" class="content_list_txt2"><td  class="content_list_txt2">'.$id.'</td><td  class="content_list_txt2">'.$name.'</td><td class="content_list_txt2" style="padding-left:40px;"><a href="?do=orderstatus&action=edit&id='.$id.'&name='.$name.'" class="edit_bttn">&nbsp;<!--Edit--></a></td></tr>';	$i++;			
			 }
			// $output.='<tr><td></td><td><input type="text" name="statusname"/><input type="button" name="insert" value="insert" /></td></tr>';
			 $output.='</table>';
			 
		 }
		 return $output;
	}
	/**
	 * Function  to display   the  edit order status  
	 * @param array $result
	 * @return string
	 */	
	function editOrderStatus($result)
	{

	     if((count($result))>0)
		 {
			     $id= $result[0]['orders_status_id'];
				 $name= $result[0]['orders_status_name'];
				  $output='<table cellpadding="4" cellspacing="0" border="0"  class="content_list_bdr" width="100%">';
				  $output.='<tr><td align="right" class="label_name"><input type="hidden" value='.$id.' name="id"/>Order Status Name</td><td><input type="text" value="'.$name.'" name="orderstatus" /></td></tr><tr><td></td><td><input type="submit" name="update" class="all_bttn" value="Update Status" /></td></tr></table>';
				  return $output;
		 }
		 
	}
	
}
?>