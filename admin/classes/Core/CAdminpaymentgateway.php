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
 * This class contains functions to update the changes made in the payment gateways
 *
 * @package  		Core_CAdminpaymentgateway
 * @category  		Core
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
   * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */


class Core_CAdminpaymentgateway
{

	
	/**
	 * Function gets the list of payment gateways available 
	 * 
	 * 
	 * @return string
	 */
	 
 	 function getPayments()
	{
	     $sql='select * from paymentgateways_table';
		 $obj = new Bin_Query();
  		 $obj->executeQuery($sql);	
		 return	Display_DAdminpaymentgateway::displayPayements($obj->records);
	}
	
	
	/**
	 * Function displays the selected payment gateway for updating.
	 * 
	 * 
	 * @return string
	 */	
	function updatePaymentSelection()
	{

		 $id=$_GET['id'];
		 $sql='select * from paymentgateways_table where gateway_id='.$id;
         $obj1=new Bin_Query();
		 $obj1->executeQuery($sql);
		 return Display_DAdminpaymentgateway::displayEditPayments($obj1->records); 
	}
	
	/**
	 * Function updates the changes made in the selected payment gateway.
	 * 
	 * 
	 * @return string
	 */	
	 
	function updatePayment()
	{
		/*$id=$_POST['paymentid'];
		$name=$_POST['paymentname'];
	    $status=$_POST['paymentstatus'];
		$merchantid=$_POST['merchantid'];
		if($status)
		{
		    $status=1;
		}
		else
		{
		    $status=0;
		}
		
        $sql="update paymentgateways_table set merchant_id='".$merchantid."', gateway_status='".$status."' where gateway_id=".$id;
	  	$obj=new Bin_Query();
		$obj->updateQuery($sql); 
		return '<div class="success_msgbox">PaymentGateWay Updated Successfully</div>';*/
		
		$status=$_POST['paymentstatus'];		
		$sql="select * from paymentgateways_table";
	  	$obj=new Bin_Query();
		$obj->executeQuery($sql);
		$statusrecords = $obj->records;
		
		for($i=0;$i<count($statusrecords);$i++)
		{	
			if(in_array($statusrecords[$i]['gateway_id'],$status))
			{
			$sql = 'update paymentgateways_table set gateway_status=1 where gateway_id='.$statusrecords[$i]['gateway_id'];
			}
			else
			{
			$sql = 'update paymentgateways_table set gateway_status=0 where gateway_id='.$statusrecords[$i]['gateway_id'];
			}			
		$obj=new Bin_Query();
		$obj->updateQuery($sql);		
		}		
		
		$sql="select * from paymentgateways_settings_table";
	  	$obj=new Bin_Query();
		$obj->executeQuery($sql);
		$paymentsettingrecords = $obj->records;
		
		for($i=0;$i<count($paymentsettingrecords);$i++)
		{		
			/*if($_POST[$paymentsettingrecords[$i]['pg_setting_id']]!='')
			{*/
			$sql = 'update paymentgateways_settings_table set setting_values="'.base64_encode($_POST[$paymentsettingrecords[$i]['pg_setting_id']]).'" where pg_setting_id='.$paymentsettingrecords[$i]['pg_setting_id'];
			/*}	
			else
			{
			$sql = 'update paymentgateways_settings_table set setting_values="'.$_POST[$paymentsettingrecords[$i]['pg_setting_id']].'" where pg_setting_id='.$paymentsettingrecords[$i]['pg_setting_id'];
			}*/
		$obj=new Bin_Query();
		$obj->updateQuery($sql);	
		}	
		return '<div class="alert alert-success">
    <button type="button" class="close" data-dismiss="alert">×</button> <strong> well done !</strong> PaymentGateWay Updated Successfully</div>';
		
		
	}
	
	/**
	 * Function gets the payment settings details from the payment_settings table. 
	 * @param integer $id
	 * 
	 * @return array
	 */	
	
	function getPaymentGatewaySettings($id)
	{
			 $sql = 'select * from paymentgateways_settings_table where gateway_id='.$id;
		 	 $obj = new Bin_Query();
			 if($obj->executeQuery($sql))
			 {
			 	return $obj->records; 				
				}	
		}
	
	
}
?>