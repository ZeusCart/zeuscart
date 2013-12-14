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
 * This class contains functions to display the existing orders and to update the status
 *
 * @package  		Model_MOrderManagement
 * @category  		Model
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
  * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */


class Model_MOrderManagement
{
	
	/**
	 * Stores the output
	 *
	 * @var array $output
	 */	
	var $output = array();	
	
	/**
	 * Function displays the list of orders and there current status  
	 * 
	 * 
	 * @return array
	 */
	
	function dispOrders()
	{
		include('classes/Core/COrderManagement.php');
		include('classes/Display/DOrderManagement.php');	
		include('classes/Core/CAdminHome.php');
		include('classes/Core/CRoleChecking.php');
		$chkuser=Core_CRoleChecking::checkRoles();
		if($chkuser)
		{		
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
			$output['lowstock']=(int)Core_CAdminHome::lowStock();
			$output['totalproducts']=(int)Core_CAdminHome::totalProducts();		
			$output['enabledproducts']=(int)Core_CAdminHome::enabledProducts();
			$output['disabledproducts']=(int)Core_CAdminHome::disabledProducts();
			$output['pendingorders']=(int)Core_CAdminHome::pendingOrders();
			$output['processingorders']=(int)Core_CAdminHome::processingOrders();
			$output['deliveredorders']=(int)Core_CAdminHome::deliveredOrders();
			$output['orderlist'] =   Core_COrderManagement::dispOrders();	
                        //			$output['updatedroporderstatus'] =   Core_COrderManagement::updateDropDownOrderStatus();
			$output['errmsg'] = $_SESSION['errmsg'];	
			
		}
		else
		{
		 	$output['usererr'] = 'You are Not having Privilege to view this page contact your Admin for detail';
			Bin_Template::createTemplate('Errors.html',$output);
		}
		//include('classes/Core/CAdminHome.php');
		$output['username']=Core_CAdminHome::userName();
		$output['currentDate']=date('l, M d, Y H:i:s');	
		$output['currency_type']=$_SESSION['currency']['currency_tocken'];					
		Bin_Template::createTemplate('OrderManagement.html',$output);
		UNSET($_SESSION['errmsg']);	
	}	
	
	/**
	 * Function display an order for updation   
	 * 
	 * 
	 * @return array
	 */
	
	function editOrders()
	{
	
		include('classes/Core/COrderManagement.php');
		include('classes/Display/DOrderManagement.php');		
		include('classes/Core/CRoleChecking.php');
		include('classes/Core/CAdminHome.php');
		$output['username']=Core_CAdminHome::userName();
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
		$output['lowstock']=(int)Core_CAdminHome::lowStock();
		$output['totalproducts']=(int)Core_CAdminHome::totalProducts();		
		$output['enabledproducts']=(int)Core_CAdminHome::enabledProducts();
		$output['disabledproducts']=(int)Core_CAdminHome::disabledProducts();
		$output['pendingorders']=(int)Core_CAdminHome::pendingOrders();
		$output['processingorders']=(int)Core_CAdminHome::processingOrders();
		$output['deliveredorders']=(int)Core_CAdminHome::deliveredOrders();

		$chkuser=Core_CRoleChecking::checkRoles();
		if($chkuser)
		{	
			$output['editorderlist'] =   Core_COrderManagement::dispOrders();				
			//Bin_Template::createTemplate('EditOrderManagement.html',$output);
		}
		else
		{
			$output['usererr'] = 'You are Not having Privilege to view this page contact your Admin for detail';
			Bin_Template::createTemplate('Errors.html',$output);
		}
		
	}
	
	/**
	 * Function updates the changes made in an order
	 * 
	 * 
	 * @return array
	 */
	
	function updateOrders()
	{
		include('classes/Core/COrderManagement.php');
		include('classes/Display/DOrderManagement.php');		
		include('classes/Core/CRoleChecking.php');
		$chkuser=Core_CRoleChecking::checkRoles();
		if($chkuser)
		{	
			$output['editorderlist'] =Core_COrderManagement::updateOrdersAndShipments();

		}
		else
		{
			$output['usererr'] = 'You are Not having Privilege to view this page contact your Admin for detail';
			Bin_Template::createTemplate('Errors.html',$output);
		}
	}
	
	/**
	 * Function displays the details of orders for updation  
	 * 
	 * 
	 * @return array
	 */
	
	function dispDetailOrders()
	{
		include('classes/Core/CAdminHome.php');
		include('classes/Display/DAdminHome.php');
	   	 include('classes/Core/COrderManagement.php');
		include('classes/Display/DOrderManagement.php');		
		include('classes/Core/CRoleChecking.php');
		
		$output['username']=Core_CAdminHome::userName();
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
		$output['lowstock']=(int)Core_CAdminHome::lowStock();
		$output['totalproducts']=(int)Core_CAdminHome::totalProducts();		
		$output['enabledproducts']=(int)Core_CAdminHome::enabledProducts();
		$output['disabledproducts']=(int)Core_CAdminHome::disabledProducts();
		$output['pendingorders']=(int)Core_CAdminHome::pendingOrders();
		$output['processingorders']=(int)Core_CAdminHome::processingOrders();
		$output['deliveredorders']=(int)Core_CAdminHome::deliveredOrders();

		$chkuser=Core_CRoleChecking::checkRoles();
		if($chkuser)
		{	
			$output['detailorder'] = Core_COrderManagement::dispDetailOrders();	
			$output['transdetails'] = Core_COrderManagement::dispTransactionDetails();	
			$output['productorders'] = Core_COrderManagement::displayProductsForOrder();
			//$output['invoice'] = Core_COrderManagement::showInvoice();
		
			Bin_Template::createTemplate('DisplayOrderManagement.html',$output);
			UNSET($_SESSION['errmsg']);
		}
		else
		{
			$output['usererr'] = 'You are Not having Privilege to view this page contact your Admin for detail';
			Bin_Template::createTemplate('Errors.html',$output);
		}

	}
	
	/**
	 * Function displays an popup window at the admin side for selecting the search keywords.  
	 * 
	 * 
	 * @return array
	 */		
	function autoComplete()
	{
		include('classes/Core/COrderManagement.php');
		$default = new Core_COrderManagement();
		if($_GET['ids']==1)
			$output['orderid']=$default->autoComplete();
		elseif($_GET['ids']==2)
			$output['dispname']=$default->autoComplete();
		elseif($_GET['ids']==3)
			$output['billname']=$default->autoComplete();
		elseif($_GET['ids']==4)
			$output['shipname']=$default->autoComplete();
		//Bin_Template::createTemplate('autocomplete.html',$output);
	}
	/**
	 * Function displays an  order details 
	 * 
	 * 
	 * @return array
	 */
	function viewOrderDetail()
	{

		include('classes/Core/CAdminHome.php');
		include('classes/Display/DAdminHome.php');
	   	 include('classes/Core/COrderManagement.php');
		include('classes/Display/DOrderManagement.php');		
		include('classes/Core/CRoleChecking.php');
		
		$output['username']=Core_CAdminHome::userName();
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
		$output['lowstock']=(int)Core_CAdminHome::lowStock();
		$output['totalproducts']=(int)Core_CAdminHome::totalProducts();		
		$output['enabledproducts']=(int)Core_CAdminHome::enabledProducts();
		$output['disabledproducts']=(int)Core_CAdminHome::disabledProducts();
		$output['pendingorders']=(int)Core_CAdminHome::pendingOrders();
		$output['processingorders']=(int)Core_CAdminHome::processingOrders();
		$output['deliveredorders']=(int)Core_CAdminHome::deliveredOrders();

		$chkuser=Core_CRoleChecking::checkRoles();
		if($chkuser)
		{	
			$output['detailorder'] = Core_COrderManagement::dispDetailOrders();	
			$output['transdetails'] = Core_COrderManagement::dispTransactionDetails();	
			$output['productorders'] = Core_COrderManagement::displayProductsForOrder();
			$output['orderhistory'] = Core_COrderManagement::displayOrderHistory();		
			Bin_Template::createTemplate('vieworderdetail.html',$output);
		}
		else
		{
			$output['usererr'] = 'You are Not having Privilege to view this page contact your Admin for detail';
			Bin_Template::createTemplate('Errors.html',$output);
		}
			

	}
	/**
	 * Function is used to cancel the order 
	 * 
	 * 
	 * @return array
	 */
	function cancelOrders()
	{
		include('classes/Core/COrderManagement.php');
		include('classes/Display/DOrderManagement.php');		
		include('classes/Core/CRoleChecking.php');
		$chkuser=Core_CRoleChecking::checkRoles();
		if($chkuser)
		{	
			Core_COrderManagement::cancelOrders();				
		}
		else
		{
			$output['usererr'] = 'You are Not having Privilege to view this page contact your Admin for detail';
			Bin_Template::createTemplate('Errors.html',$output);
		}

	}	
	/**
	 * Function is used to print the order 
	 * 
	 * 
	 * @return array
	 */		
	function printOrders()
	{
		include('classes/Core/COrderManagement.php');
		include('classes/Display/DOrderManagement.php');		
		include('classes/Core/CRoleChecking.php');
		$chkuser=Core_CRoleChecking::checkRoles();
		if($chkuser)
		{	
			Core_COrderManagement::printOrders();				
		}
		else
		{
			$output['usererr'] = 'You are Not having Privilege to view this page contact your Admin for detail';
			Bin_Template::createTemplate('Errors.html',$output);
		}
	}
	/**
	 * Function is used to email the order 
	 * 
	 * 
	 * @return array
	 */
	function emailOrders()
	{
		include('classes/Core/COrderManagement.php');
		include('classes/Display/DOrderManagement.php');		
		include('classes/Core/CRoleChecking.php');
		$chkuser=Core_CRoleChecking::checkRoles();
		if($chkuser)
		{	
			Core_COrderManagement::emailOrders();				
		}
		else
		{
			$output['usererr'] = 'You are Not having Privilege to view this page contact your Admin for detail';
			Bin_Template::createTemplate('Errors.html',$output);
		}

	}	
	/**
	 * Function is used to show  invoice for order 
	 * 
	 * 
	 * @return array
	 */
	function showAddnvoice()
	{
		include('classes/Core/COrderManagement.php');
		//$output['editinvoice']=Core_COrderManagement::getUserInvoice();

		Bin_Template::createTemplate('invoice.html',$output);	
	}
	/**
	 * Function is used to insert invoice for order 
	 * 
	 * 
	 * @return array
	 */
	function insertInvoice()
	{


		include('classes/Core/COrderManagement.php');
		$output['invoice']=Core_COrderManagement::insertInvoice();	

	}
	/**
	 * Function is used to show the ship[ cost
	 * 
	 * 
	 * @return array
	 */
	function calculateShipCost()
	{
		include('classes/Core/COrderManagement.php');	
		Core_COrderManagement::calculateShipCost();

	}

	function showChangeShipping()
	{
		$output = array();
		include('classes/Core/CRoleChecking.php');
		$chkuser=Core_CRoleChecking::checkRoles();
		if($chkuser)
		{
			include('classes/Core/COrderManagement.php');
			include('classes/Display/DOrderManagement.php');

			$output['changeship']=Core_COrderManagement::showChangeShipping();	

			Bin_Template::createTemplate('light_change_shipping.html',$output);
		}
		else
		{
			$output['usererr'] = 'You are Not having Privilege to view this page contact your Admin for detail';
			Bin_Template::createTemplate('Errors.html',$output);
		}	

	}

}
?>