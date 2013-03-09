<?php
/**
* GNU General Public License.

* This file is part of ZeusCart V2.3.

* ZeusCart V2.3 is free software: you can redistribute it and/or modify
* it under the terms of the GNU General Public License as published by
* the Free Software Foundation, either version 3 of the License, or
* (at your option) any later version.
* 
* ZeusCart V2.3 is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
* GNU General Public License for more details.
* 
* You should have received a copy of the GNU General Public License
* along with Foobar. If not, see <http://www.gnu.org/licenses/>.
*
*/ 
 class Display_ShippingTracker
{
 	function displayShippingTrackerSetting($arr)
	  {
			//print_r($arr);  
			
			$output = '<form method="post" action="?do=showshipmenttracker&action=update">'.(isset($_GET['msg'])? '<table border="0" width="75%" align="center" ><tr><td colspan="2"><div class="success_msgbox"  width="100%" style="width:475px;" >'.$_GET['msg'].'</div>' : "" ).'</td></tr></table><br><table border="0" width="75%" align="center" class="content_list_bdr"><tr><td colspan="2"></td></tr><tr><td  class="content_list_head" width="60%">Shipment Name</td><td  class="content_list_head">Status</td></tr>';
			
			for($i=0;$i<count($arr);$i++)
			{
				$tmpStr=($arr[$i]['status']==1 ? ' checked=checked ' : '' );
				$output .= '<tr class="content_list_txt2">
								<td style="padding-left:70px;">
									<input type="hidden" name="shippingid[]" value="'.$arr[$i]['shipment_id'].'"/>'.$arr[$i]['shipment_name'].'</td><td style="padding-left:30px;"><input type="checkbox" name="shippingstatus[]" '.$tmpStr.' value="'.$arr[$i]['shipment_id'].'"/>	                                </td>
            				</tr>';		
			}
			$output .='<tr><td colspan="2" align="center" style="padding:9px;"><input name="button" type="submit" value="Update"  class="all_bttn"/></td></tr></table></form>';
			return $output;	
		  }
}
?>


