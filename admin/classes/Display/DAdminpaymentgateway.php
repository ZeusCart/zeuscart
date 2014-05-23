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
	      
		      $output.='<form id="paymentId" name="edit" action="?do=adminpayment&action=update" method="post"> <div class="row-fluid">
                                    <div class="span12">
                                        <div class="accordion" id="accordion1">';
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
			 // $image="<img src='../".$image."' alt='".ucfirst($name)."'>";

			 $paymentName=ucfirst($name);

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
				
				
			 $paymentgatewaysettings='';
  				
			  if($id=='2' || $id=='3')
			  {		
			  $paymentgatewaysettings.='';
			  }
			  else
			  {
			 $paymentgatewaysettings.='<div class="row-fluid">
                                    <div class="span4"> Status </div> <div class="span8"><input type="checkbox" '.$status.' name="paymentstatus[]" id="paymentstatus[]" value="'.$id.'" /></div></div>';
			  }
				
			 if(count($gatewaySettings)>0)
			 {
			 	 $arr = $gatewaySettings;							 
				 for($k=0;$k<count($arr);$k++)
			 	{			 				 	
				$paymentgatewaysettings .= '<div class="row-fluid">
                                    <div class="span4">'.$arr[$k]['setting_name'].'</div>';
				$paymentgatewaysettings .= '<div class="span8"><input type="text" name="'.$arr[$k]['pg_setting_id'].'" value="'.base64_decode($arr[$k]['setting_values']).'" /></div></div>';		 
			 	}
			 			
			 }				  		
			
			
			 
			   if($id=='2' || $id=='3')
			   {			   
			   $output.='';
			   }
			   else
			   {
			   if($j%2==0)
			    $output.='<div class="accordion-group">
                                                <div class="accordion-heading">
                                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapseOne'.$j.'">'.$paymentName.'</a></div> <div id="collapseOne'.$j.'" class="accordion-body collapse">
                                                    <div class="accordion-inner">'.$paymentgatewaysettings.'</div></div></div>';		
				
					 	 
			 else
 					   $output.='<div class="accordion-group">
                                                <div class="accordion-heading">
                                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapseOne'.$j.'">'.$paymentName.'</a></div> <div id="collapseOne'.$j.'" class="accordion-body collapse">
                                                    <div class="accordion-inner">'.$paymentgatewaysettings.'</div></div></div>';
						 
			 $i+=1;
			 $j++;
			 }
		  }		 
		  $output.="
		    </div>
                                        </div>
                                    </div>	  
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