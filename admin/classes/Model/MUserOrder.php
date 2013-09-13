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
 * This class contains functions to create a new user order 
 *
 * @package  		Model_MUserOrder
 * @subpackage 		Model
 * @category  		Model
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
 * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */


class Model_MUserOrder
{
	/**
	 * Stores the output
	 *
	 * @var array 
	 */	
	var $output = array();	
	
	/**
	 * Function displays a the list of orders available 
	 * @param  string $msg
	 * @return array
	 */
	function showOrder($msg='') 
	{


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
			include("classes/Lib/HandleErrors.php");		
		
			if(count($Err->messages) > 0)
			{
				$output['val'] = $Err->values;
				$output['msg'] = $Err->messages;
			}

			include_once('classes/Core/CUserOrder.php');
			include_once('classes/Display/DUserOrder.php');			
			$default=new Core_CUserOrder();
			$output['message'] =$msg;
			$output['customer'] = $default->showCustomer($Err);
			$output['payment'] = $default->showPayment();			
			
			$output['category1'] = $default->showCategory();		
			//$output['subcategory'] = $default->showSubCategory();
			//$output['subundercategory'] = $default->showSubUnderCat();			
			$output['products'] = $default->showProducts();									
			$output['qty'] = $default->showQty();												
			$output['orderlist'] = $default->listOrder();	

								
			$output['showShippingDetails'] = $default->showShippingDetails($Err,$output['multibilladdress'],$output['multishipaddress']);			
			
			Bin_Template::createTemplate('userorder.html',$output);
		
		}
		else
		{
			$output['usererr'] = 'You are Not having Privilege to view this page contact your Admin for detail';
			Bin_Template::createTemplate('Errors.html',$output);
		}	
	}
	
	/**
	 * Function displays the sub categories available 
	 * 
	 * @return array
	 */
	
	function showSubcat()
	{
		include_once('classes/Core/CUserOrder.php');
		include_once('classes/Display/DUserOrder.php');			
		$default=new Core_CUserOrder();
		echo $default->showSubCategory($_GET['id']);		
	}
	/**
	 * Function show  the sub under sub category
	 * 
	 * @return array
	 */
	function showSubUnderCat()
	{
		include_once('classes/Core/CUserOrder.php');
		include_once('classes/Display/DUserOrder.php');			
		$default=new Core_CUserOrder();
		echo $default->showSubUnderCat($_GET['id']);
	}
	/**
	 * Function displays the list of products available  
	 * 
	 * @return array
	 */
	
	
	function showProduct()
	{

		include_once('classes/Core/CUserOrder.php');
		include_once('classes/Display/DUserOrder.php');			
		$default=new Core_CUserOrder();
		echo $default->showProducts($_GET['id']);		
	}
	/**
	 * Function displays the Quantity 
	 * 
	 * @return array
	 */
	
	function showQty()
	{
		include_once('classes/Core/CUserOrder.php');
		include_once('classes/Display/DUserOrder.php');			
		$default=new Core_CUserOrder();
		echo $default->showQty($_GET['id']);		
	}
	/**
	 * Function displays a templates for adding a product 
	 * 
	 * @return array
	 */
	function addProduct()
	{

		include_once('classes/Core/CUserOrder.php');
		include_once('classes/Display/DUserOrder.php');			
		$default=new Core_CUserOrder();
		$msg = $default->addProduct();	
		Model_MUserOrder::showOrder($msg);
	}
	/**
	 * Function deletes the existing product 
	 * 
	 * @return array
	 */
	function delProduct()
	{
		include_once('classes/Core/CUserOrder.php');
		include_once('classes/Display/DUserOrder.php');			
		$default=new Core_CUserOrder();
		$default->delProduct();		
		Model_MUserOrder::showOrder();
	}
	
	/**
	 * Function creates an new order 
	 * 
	 * @return array
	 */
	
	function createOrder()
	{


		include_once('classes/Core/CUserOrder.php');
		include_once('classes/Display/DUserOrder.php');		
		include('classes/Lib/CheckInputs.php');

		$obj = new Lib_CheckInputs('frmship');

		$default=new Core_CUserOrder();
		$result=$default->createOrder();		
		Model_MUserOrder::showOrder($result);
	}
	
	/**
	 * Function show  the user multi address for billing
	 * 
	 * @return array
	 */
	function showUserMultiBillAddress()
	{

		include_once('classes/Core/CUserOrder.php');
		include_once('classes/Display/DUserOrder.php');			
		$default=new Core_CUserOrder();
		echo $default->showUserMultiBillAddress();

	}
	/**
	 * Function show  the user multi address for shipping
	 * 
	 * @return array
	 */
	function showUserMultiShipAddress()
	{

		include_once('classes/Core/CUserOrder.php');
		include_once('classes/Display/DUserOrder.php');			
		$default=new Core_CUserOrder();
		echo $default->showUserMultiShipAddress();

	}
	/**
	 * Function show  the user billing address and shipping address
	 * 
	 * @return array
	 */
	function showUserAddressDetails()
	{	

		include_once('classes/Core/CUserOrder.php');
		include_once('classes/Display/DUserOrder.php');			
		$default=new Core_CUserOrder();
		echo $default->showUserAddressDetails();
	
	}
}
?>