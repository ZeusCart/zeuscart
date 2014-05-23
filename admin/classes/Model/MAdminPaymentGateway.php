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
 * This class contains functions to display the payment gateways available in the site
 * at the admin side.
 *
 * @package  		Model_MAdminPaymentGateway
 * @category  		Model
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
  * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */

class Model_MAdminPaymentGateway
{
	/**
	 * Stores the output
	 *
	 * @var array $output
	 */		 
	 
	var $output = array();	
	
	/**
	 * Function displays the payment gateways available at the admin side 
	 * 
	 * 
	 * @return array
	 */
	
	function paymentSelection()
	{
	    
		include('classes/Core/CAdminpaymentgateway.php');
		include('classes/Display/DAdminpaymentgateway.php');		
		include('classes/Core/CAdminHome.php');
		$output['currentDate']=date('l, M d, Y H:i:s');	
		$output['currency_type']=$_SESSION['currency']['currency_tocken'];			
		$output['monthlyorders']= (int)Core_CAdminHome::monthlyOrders();
		$output['previousmonthorders']=(int)Core_CAdminHome::previousMonthOrders();
		$output['totalorders']=(int)Core_CAdminHome::totalOrders();
		$output['currentmonthuser']=(int)Core_CAdminHome::currentMonthUser();
		$output['previousmonthuser']=(int)Core_CAdminHome::previousMonthUser();
		$output['totalusers']=(int)Core_CAdminHome::totalUsers();
		$output['currentmonthincome']=Core_CAdminHome::currentMonthIncome();
		$output['previousmonthincome']=Core_CAdminHome::previoustMonthIncome();
		$output['totalincome']=Core_CAdminHome::totalIncome();
		$output['currentmonthproudctquantity']=(int)Core_CAdminHome::currentMonthProudctQuantity();
		$output['previousmonthproudctquantity']=(int)Core_CAdminHome::previousMonthProudctQuantity();
		$output['totalproudctquantity']=(int)Core_CAdminHome::totalProudctQuantity();
		$output['lowstock']=Core_CAdminHome::lowStock();
		$output['totalproducts']=Core_CAdminHome::totalProducts();		
		$output['enabledproducts']=Core_CAdminHome::enabledProducts();
		$output['disabledproducts']=Core_CAdminHome::disabledProducts();
		$output['pendingorders']=(int)Core_CAdminHome::pendingOrders();
		$output['processingorders']=(int)Core_CAdminHome::processingOrders();
		$output['deliveredorders']=(int)Core_CAdminHome::deliveredOrders();
		
		include_once('classes/Core/CRoleChecking.php');
		$chkuser=Core_CRoleChecking::checkRoles();
		if($chkuser)
		{
			$output['adminpaymentgateways'] =Core_CAdminpaymentgateway::getPayments();
			Bin_Template::createTemplate('Adminpaymentgateway.html',$output);			
		}
		else
		{
			 $output['usererr'] = 'You are Not having Privilege to view this page contact your Admin for detail';
			Bin_Template::createTemplate('Errors.html',$output);
		}
		 
	}
	
	/**
	 * Function displays an payment gateway for updating changes at the admin side 
	 * 
	 * 
	 * @return array
	 */
	
	
	function editSelection()
	{
	    include('classes/Core/CRoleChecking.php');
		include('classes/Core/CAdminpaymentgateway.php');
		include('classes/Display/DAdminpaymentgateway.php');
		$chkuser=Core_CRoleChecking::checkRoles();
		if($chkuser)
		{		
			$output['editpayment'] =Core_CAdminpaymentgateway::updatePaymentSelection();				
			Bin_Template::createTemplate('editpaymentgateway.html',$output);
		}
		else
		{
			$output['usererr'] = 'You are Not having Privilege to view this page contact your Admin for detail';
			Bin_Template::createTemplate('Errors.html',$output);
		}

	}	
	
	/**
	 * Function updates the changes made in an payment gateway at the admin side 
	 * 
	 * 
	 * @return array
	 */
	 
	function updateSelection()
	{
        include('classes/Core/CRoleChecking.php');
		include('classes/Core/CAdminpaymentgateway.php');
		include('classes/Display/DAdminpaymentgateway.php');		
		include('classes/Core/CAdminHome.php');
		include_once('classes/Core/CRoleChecking.php');
		$output['currentDate']=date('l, M d, Y H:i:s');	
		$output['currency_type']=$_SESSION['currency']['currency_tocken'];			
		$output['monthlyorders']= (int)Core_CAdminHome::monthlyOrders();
		$output['previousmonthorders']=(int)Core_CAdminHome::previousMonthOrders();
		$output['totalorders']=(int)Core_CAdminHome::totalOrders();
		$output['currentmonthuser']=(int)Core_CAdminHome::currentMonthUser();
		$output['previousmonthuser']=(int)Core_CAdminHome::previousMonthUser();
		$output['totalusers']=(int)Core_CAdminHome::totalUsers();
		$output['currentmonthincome']=Core_CAdminHome::currentMonthIncome();
		$output['previousmonthincome']=Core_CAdminHome::previoustMonthIncome();
		$output['totalincome']=Core_CAdminHome::totalIncome();
		$output['currentmonthproudctquantity']=(int)Core_CAdminHome::currentMonthProudctQuantity();
		$output['previousmonthproudctquantity']=(int)Core_CAdminHome::previousMonthProudctQuantity();
		$output['totalproudctquantity']=(int)Core_CAdminHome::totalProudctQuantity();
		$output['lowstock']=Core_CAdminHome::lowStock();
		$output['totalproducts']=Core_CAdminHome::totalProducts();		
		$output['enabledproducts']=Core_CAdminHome::enabledProducts();
		$output['disabledproducts']=Core_CAdminHome::disabledProducts();
		$output['pendingorders']=(int)Core_CAdminHome::pendingOrders();
		$output['processingorders']=(int)Core_CAdminHome::processingOrders();
		$output['deliveredorders']=(int)Core_CAdminHome::deliveredOrders();
		$chkuser=Core_CRoleChecking::checkRoles();
		if($chkuser)
		{	
			$output['updatepaymentmessage'] =Core_CAdminpaymentgateway::updatePayment();				
			//header("Location:?do=adminpayment");
			$output['adminpaymentgateways'] =Core_CAdminpaymentgateway::getPayments();
			Bin_Template::createTemplate('Adminpaymentgateway.html',$output);	
			//exit;
		}
		else
		{
			$output['usererr'] = 'You are Not having Privilege to view this page contact your Admin for detail';
			Bin_Template::createTemplate('Errors.html',$output);
		}		
	}
	
	/*function insertPayment()
	{
	     include('classes/Core/CRoleChecking.php');
		include('classes/Core/CAdminpaymentgateway.php');
		//////include('classes/Display/DAdminpaymentgateway.php');		
		//$output['editpayment'] =Core_CAdminpaymentgateway::updatePaymentSelection();				
		$chkuser=Core_CRoleChecking::checkRoles();
		if($chkuser)
		{	
			Core_CAdminpaymentgateway::insertPayment();				
			header("Location:?do=adminpayment");
			exit;
		}
		else
		{
			$output['usererr'] = 'You are Not having Privilege to view this page contact your Admin for detail';
			Bin_Template::createTemplate('Errors.html',$output);
		}
	}
	
	function deletePayment()
	{
	     include('classes/Core/CRoleChecking.php');
		include('classes/Core/CAdminpaymentgateway.php');
		//////include('classes/Display/DAdminpaymentgateway.php');		
		//$output['editpayment'] =Core_CAdminpaymentgateway::updatePaymentSelection();				
		$chkuser=Core_CRoleChecking::checkRoles();
		if($chkuser)
		{	
			Core_CAdminpaymentgateway::deletePayment();				
			header("Location:?do=adminpayment");
			exit;
		}
		else
		{
			$output['usererr'] = 'You are Not having Privilege to view this page contact your Admin for detail';
			Bin_Template::createTemplate('Errors.html',$output);
		}
	}*/
}
?>