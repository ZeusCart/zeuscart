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
 * This class contains the shipping tracker related process
 *
 * @package  		Display_ShippingTracker
  * @category  		Display
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
  * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */
 class Display_ShippingTracker
{

	/**
	 * Function  to  display the skin with seleted skin
	 * @param array $arr
	 * @return string
	 */	
 	  function displayShippingTrackerSetting($arr)
	  {

/*
			$output = '<form method="post" action="?do=showshipmenttracker&action=update">'.(isset($_GET['msg'])? '<table border="0" width="75%" align="center" ><tr><td colspan="2"><div class="success_msgbox"  width="100%" style="width:475px;" >'.$_GET['msg'].'</div>' : "" ).'</td></tr></table><br><table border="0" width="75%" align="center" class="content_list_bdr"><tr><td colspan="2"></td></tr><tr><td  class="content_list_head" width="60%">Shipment Name</td><td  class="content_list_head">Status</td></tr>';
			
			for($i=0;$i<count($arr);$i++)
			{
				$tmpStr=($arr[$i]['status']==1 ? ' checked=checked ' : '' );
				$output .= '<tr class="content_list_txt2">
								<td style="padding-left:70px;">
									<input type="hidden" name="shippingid[]" value="'.$arr[$i]['shipment_id'].'"/>'.$arr[$i]['shipment_name'].'</td><td style="padding-left:30px;"><input type="checkbox" name="shippingstatus[]" '.$tmpStr.' value="'.$arr[$i]['shipment_id'].'"/>	                                </td>
            				</tr>';		
			}
			$output .='<tr><td colspan="2" align="center" style="padding:9px;"><input name="button" type="submit" value="Update"  class="all_bttn"/></td></tr></table></form>';*/


			for($i=0;$i<count($arr);$i++)
			{

				$tmpStr=($arr[$i]['status']==1 ? ' checked=checked ' : '' );

				$output.='<div class="accordion-group">
                                                <div class="accordion-heading">
                                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion'.$i.'" href="#collapseTwo'.$i.'">
                                                       '.$arr[$i]['shipment_name'].'
                                                      </a>
                                                </div>
                                                <div id="collapseTwo'.$i.'" class="accordion-body collapse">
                                                    <div class="accordion-inner"><div class="row-fluid">
							<div class="span4"> Status </div> <div class="span8"><input type="checkbox" value='.$arr[$i]['ship_id'].'  name="shippingstatus[]" '.$tmpStr.'></div></div>
							<div class="row-fluid">
							<div class="span4">User ID</div><div class="span8"><input type="text" value="'.$arr[$i]['shipment_user_id'].'" name="shipment_user_id[]"  id='.$arr[$i]['shipment_user_id'].' /></div></div>
							<div class="row-fluid">
							<div class="span4"> Password</div><div class="span8"><input type="text" value="'.$arr[$i]['shipment_password'].'" name="shipment_password[]" /></div></div><div class="row-fluid">
							<div class="span4">Access Key</div><div class="span8"><input type="text" value="'.$arr[$i]['shipment_accesskey'].'" name="shipment_accesskey[]" /><input type="hidden" name="ship_id[]" value="'.$arr[$i]['ship_id'].'"/></div></div></div>
                                                </div>
                                            </div>';
			}
			return $output;	
		  }
}
?>


