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
 * This class contains functions to add a new coupon code 
 * at the admin side.
 *
 * @package  		Model_MPromotionalCodes
 * @category  		Model
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
  * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */

class Model_MPromotionalCodes
{
	
	/**
	 * Function displays template for selecting a method to send the coupon codes to the user
	 * 
	 * 
	 * @return array
	 */
	function selectMethodToSendPromotionalCode()
	{
		

		include('classes/Core/CRoleChecking.php');
		include('classes/Core/CPromotionalCodes.php');
		include('classes/Display/DPromotionalCodes.php');
		
		$chkuser=Core_CRoleChecking::checkRoles();
		if($chkuser)
		{
			include('classes/Lib/FileOperations.php');			
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
			
			$output['display']=Core_CPromotionalCodes::selectMethodToSendPromotionalCode();
			$output['displaysearch']=Core_CPromotionalCodes::selectMethodToSendPromotionalCode();
			$output['displayusers']=Core_CPromotionalCodes::displayUsersForPromotionalCode();
			
			Bin_Template::createTemplate('createpromocodes.html',$output);
			//include_once('templates/createpage.php');
		}
		else
		{
			$output['usererr'] = 'You are Not having Privilege to view this page contact your Admin for detail';
			Bin_Template::createTemplate('Errors.html',$output);
		}
	
	}
	
	
	/**
	 * Function displays the list of users for promotional code 
	 * 
	 * 
	 * @return array
	 */
	
	function displayUsersForPromotionalCode()
	{
		
		include('classes/Core/CRoleChecking.php');
		include('classes/Core/CPromotionalCodes.php');
		include('classes/Display/DPromotionalCodes.php');
		
		$chkuser=Core_CRoleChecking::checkRoles();
		if($chkuser)
		{
			include('classes/Lib/FileOperations.php');			
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
			
			$output['displaysearch']=Core_CPromotionalCodes::selectMethodToSendPromotionalCode();
			$output['displayusers']=Core_CPromotionalCodes::displayUsersForPromotionalCode();
			
			Bin_Template::createTemplate('usercoupon.html',$output);
			//include_once('templates/createpage.php');
		}
		else
		{
			$output['usererr'] = 'You are Not having Privilege to view this page contact your Admin for detail';
			Bin_Template::createTemplate('Errors.html',$output);
		}
	
	}
	
	/**
	 * Function sends the coupon code for the selected users 
	 * 
	 * 
	 * @return array
	 */
	
	function sendCouponToSelectedUsers()
	{
		include('classes/Core/CRoleChecking.php');
		include('classes/Core/CPromotionalCodes.php');
		include('classes/Display/DPromotionalCodes.php');
		include('classes/Lib/Mail.php');
		
		$chkuser=Core_CRoleChecking::checkRoles();
		if($chkuser)
		{
			include('classes/Lib/FileOperations.php');			
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
			
			$output['insertmsg']=Core_CPromotionalCodes::sendCouponToSelectedUsers();
			$output['display']=Core_CPromotionalCodes::displayPromotionalCodes();
					
			Bin_Template::createTemplate('createpromocodes.html',$output);
			//include_once('templates/createpage.php');
		}
		else
		{
			$output['usererr'] = 'You are Not having Privilege to view this page contact your Admin for detail';
			Bin_Template::createTemplate('Errors.html',$output);
		}
		
	}
	
	/**
	 * Function changes the status for promotional codes 
	 * 
	 * 
	 * @return array
	 */
	
	function changeStatusForPromotionalCodes()
	{
		include('classes/Core/CRoleChecking.php');
		include('classes/Core/CPromotionalCodes.php');
		include('classes/Display/DPromotionalCodes.php');
		
		$chkuser=Core_CRoleChecking::checkRoles();
		if($chkuser)
		{
			include('classes/Lib/FileOperations.php');			
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
			
			$output['insertmsg']=Core_CPromotionalCodes::changeStatusForPromotionalCodes();
			$output['display']=Core_CPromotionalCodes::displayPromotionalCodes();
			
			Bin_Template::createTemplate('createpromocodes.html',$output);
			//include_once('templates/createpage.php');
		}
		else
		{
			$output['usererr'] = 'You are Not having Privilege to view this page contact your Admin for detail';
			Bin_Template::createTemplate('Errors.html',$output);
		}
	}
	
	/**
	 * Function adds a new promotional code 
	 * 
	 * 
	 * @return array
	 */
	
	function createPromotionalCodes()
	{
		include('classes/Core/CRoleChecking.php');
		include('classes/Core/CPromotionalCodes.php');
		include('classes/Display/DPromotionalCodes.php');
		
		$chkuser=Core_CRoleChecking::checkRoles();
		if($chkuser)
		{
			include('classes/Lib/FileOperations.php');			
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
			
			$output['display']=Core_CPromotionalCodes::createPromotionalCodes();
			
			Bin_Template::createTemplate('addpromocodes.html',$output);
			//include_once('templates/createpage.php');
		}
		else
		{
			$output['usererr'] = 'You are Not having Privilege to view this page contact your Admin for detail';
			Bin_Template::createTemplate('Errors.html',$output);
		}
	}
	
	/**
	 * Function displays the list of promotional codes available 
	 * 
	 * 
	 * @return array
	 */
	
	function displayPromotionalCodes()
	{
		include('classes/Core/CRoleChecking.php');
		include('classes/Core/CPromotionalCodes.php');
		include('classes/Display/DPromotionalCodes.php');
		
		$chkuser=Core_CRoleChecking::checkRoles();
		if($chkuser)
		{
			include('classes/Lib/FileOperations.php');			
			include('classes/Core/CAdminHome.php');
			$output['username']=Core_CAdminHome::userName();
			$output['currentDate']=date('l, M d, Y H:i:s');		
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
			
			$output['display']=Core_CPromotionalCodes::displayPromotionalCodes();
			
			Bin_Template::createTemplate('createpromocodes.html',$output);
			//include_once('templates/createpage.php');
		}
		else
		{
			$output['usererr'] = 'You are Not having Privilege to view this page contact your Admin for detail';
			Bin_Template::createTemplate('Errors.html',$output);
		}
	}
	
	/**
	 * Function adds a new promotional code from the admin side 
	 * 
	 * 
	 * @return array
	 */
	
	function insertPromotionalCodes()
	{
		include("classes/Lib/CheckInputs.php");
		include('classes/Core/CRoleChecking.php');
	    include('classes/Core/CPromotionalCodes.php');
		include('classes/Display/DPromotionalCodes.php');
		
		//$obj = new Lib_CheckInputs('productreg');
		$output['val']=$Err->values;
		$output['msg']=$Err->messages;
		
		$chkuser=Core_CRoleChecking::checkRoles();
		if($chkuser)
		{	
			include('classes/Lib/FileOperations.php');			
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
			
			
			$output['insertmsg']=Core_CPromotionalCodes::insertPromotionalCode();
			$output['display']=Core_CPromotionalCodes::displayPromotionalCodes();
			
			Bin_Template::createTemplate('createpromocodes.html',$output);
			
			
		}
		else
		{
		    $output['usererr'] = 'You are Not having Privilege to view this page contact your Admin for detail';
			Bin_Template::createTemplate('Errors.html',$output);
		}
		
	}
	
}

?>