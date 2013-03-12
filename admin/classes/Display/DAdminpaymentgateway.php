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
 * This class contains functions to display and edit payment gateway details.
 * @package  		Display_DAdminpaymentgateway
 * @category  		Display
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
   * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */

 class Display_DAdminpaymentgateway
{
 	/**
	 * List out the payment gateways. 
	 * @param array $result
	 * @return string
	 */
	function displayPayements($result)
	{
	      
		      $output.="<form name='edit' action='?do=adminpayment&action=update' method='post'><table cellpadding='3' cellspacing='0' border='0'  class='content_list_bdr' width='100%'> <tr><td colspan='3'>&nbsp;</td></tr>";
		  $i=1;
		  $j=1;
		  if((count($result)>0))
		  {
		  foreach($result as $row)
		  {
		     $id=$row['gateway_id'];
		     $name=$row['gateway_name'];
			 $status=$row['gateway_status'];
			 $merchant_id=base64_decode($row['merchant_id']);	
			 $image = $row['images'];		
			 $image="<img src='../".$image."' alt='".$name."'>";

			 if($status)
			   {
				  $status="Checked='checked'";
			   }
			   else
			   {
				  $status='';
			   }
			
		 			
			 $getDetails = new Core_CAdminpaymentgateway();
			 $gatewaySettings = $getDetails->getPaymentGatewaySettings($id);			 
			 
			 $paymentgatewaysettings='';
				
				
			 $paymentgatewaysettings='<table width="600" border="0" cellspacing="0" cellpadding="0" >';
  				
			  if($id=='2' || $id=='3')
			  {		
			  $paymentgatewaysettings.='';
			  }
			  else
			  {
			  $paymentgatewaysettings.='<tr> <td class="content_form" width="200" >Status</td> <td width="200" class="content_form" > <input type="checkbox" '.$status.' name="paymentstatus[]" id="paymentstatus[]" value="'.$id.'" /></td></tr>';
			  }
				
			 if(count($gatewaySettings)>0)
			 {
			 	 $arr = $gatewaySettings;							 
				 for($k=0;$k<count($arr);$k++)
			 	{			 				 	
				$paymentgatewaysettings .= '<tr> <td class="content_form" width="200" >'.$arr[$k]['setting_name'].'</td> <td class="content_form" width="200" >';
				$paymentgatewaysettings .= '<input type="text" name="'.$arr[$k]['pg_setting_id'].'" value="'.base64_decode($arr[$k]['setting_values']).'" /> <img onmouseout="HideHelp(\''.$arr[$k]['pg_setting_id'].'\');" onmouseover="ShowHelp(\''.$arr[$k]['pg_setting_id'].'\', \''.$arr[$k]['setting_name'].'\', \''.$arr[$k]['help_text'].'\')" src="images/help.gif"/><div style="left: 50px; top: 50px;" id="'.$arr[$k]['pg_setting_id'].'"/><div style="color: rgb(255, 0, 0);"></div>';	$paymentgatewaysettings .= '</tr> </td>';		 
			 	}
			 			
			 }				  		
			$paymentgatewaysettings.='</table>';			
			
			 
			   if($id=='2' || $id=='3')
			   {			   
			   $output.='';
			   }
			   else
			   {
			   if($j%2==0)
			    $output.="<tr style='background-color:#FFFFFF;'>				
				<td  colspan='3' ><fieldset class='content_list_bdr'> 
					<legend > &nbsp;".$image."&nbsp;				
			</legend>".$paymentgatewaysettings."</fieldset></td></tr><tr><td colspan='3'>&nbsp;</td></tr>";		
				
					 	 
			 else
 					  $output.="<tr style='background-color:#FFFFFF;' >				
				<td  colspan='3' ><fieldset class='content_list_bdr'> 
					<legend > &nbsp;".$image."&nbsp;				
				</legend>".$paymentgatewaysettings."</fieldset></td></tr><tr><td colspan='3'>&nbsp;</td></tr>";		
						 
			 $i+=1;
			 $j++;
			 }
		  }		 
		  $output.="
		  <tr style='background-color:#FFFFFF;'><td colspan='3' align='center' > <input value='Update' class='all_bttn' type='submit'></td></tr>		 
		  </table>		  
		  </form>";
		  }
		  else
		  {
		     $output='No Payments Gateways have been inserted';
		  }
		  return $output;		  
		 
	}
	
	/**
	 * Display payment gateway detail for edit. 
	 * @param array $result
	 * @return string
	 */
	function displayEditPayments($result)
	{
       $id=$result[0]['gateway_id'];
	   $name=$result[0]['gateway_name'];
	   $status=$result[0]['gateway_status'];
	   $merchant_id=$result[0]['merchant_id'];
	   if($status)
			   {
				  $status="Checked='checked'";
			   }
			   else
			   {
				  $status='';
			   }
	   $output="<table cellpadding='10' cellspacing='0' border='0' width='100%'><tr class='content_list_head'><td colspan='2'> <input type='hidden' name='paymentid' value='".$id."' />Edit Payment Gateway</td></tr><tr class='content_list_txt1'><td>Payment Name</td><td>".$name."</td></tr><tr class='content_list_txt1'><td>Merchant ID</td><td><input type='text' name='merchantid' value='".$merchant_id."' /></td></tr><tr class='content_list_txt1'><td> Status </td><td><input type='checkbox' ".$status." name='paymentstatus'/></td></tr><tr><td colspan='2' align='center'><input type='submit' value='Update Payment Gateway' class='all_bttn'></a></td><tr></table>";
        return $output;    
  
	}
	
}
?>