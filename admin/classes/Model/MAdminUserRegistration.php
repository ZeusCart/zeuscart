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
 * This class contains functions to add, edit and delete a new customer account 
 * at the admin side.
 *
 * @package  		Model_MAdminUserRegistration
 * @category  		Model
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
  * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */

class Model_MAdminUserRegistration
{
	
	/**
	 * Function displays a new registration page for adding an customer account 
	 * at the admin side   
	 * 
	 * @return array
	 */
	function showRegistrationPage()
	{	
		$output = array();
		
		include('classes/Core/CAdminUserRegistration.php');
		include('classes/Core/CRoleChecking.php');
		include('classes/Display/DAdminUserRegistration.php');
		include('classes/Model/MSiteStatistics.php');
		
		$output=Model_MSiteStatistics::siteStatistics();
		
		$chkuser=Core_CRoleChecking::checkRoles();
		
		if($chkuser)
		{	
			$output['adminregmsg'] =$_SESSION['rtsinsmsg'];
			unset($_SESSION['rtsinsmsg']);
			$output['adminreg'] = Core_CAdminUserRegistration::showAccount();
			Bin_Template::createTemplate('ShowUser.html',$output);
		}
		else
		{
		 	$output['usererr'] = 'You are Not having Privilege to view this page contact your Admin for detail';
			Bin_Template::createTemplate('Errors.html',$output);
		}
	}
	
	/**
	 * Function displays the search results at the admin side
	 *    
	 * 
	 * @return array
	 */
	
	
	function searchUserDetails()
	{
		include_once('classes/Core/CAdminUserRegistration.php');
		include_once('classes/Display/DAdminUserRegistration.php');
			
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
		$default = new Core_CAdminUserRegistration();
		$output['searchuser']=$default->searchUserDetails();
		
		Bin_Template::createTemplate('ShowUser.html',$output);
		unset($_SESSION['rtsinsmsg']);
	}
	
	/**
	 * Function displays a edit page for a selected user
	 *    
	 * 
	 * @return array
	 */
	 
	function editRegistration()
	{
		$output = array();
		include("classes/Lib/HandleErrors.php");
		include('classes/Core/CAdminUserRegistration.php');
		include('classes/Display/DAdminUserRegistration.php');
		include('classes/Core/CAdminHome.php');
		$output['username']=Core_CAdminHome::userName();
		$output['currentDate']=date('l, M d, Y H:i:s');	
		$output['currency_type']=$_SESSION['currency']['currency_tocken'];			
		$output['category']=Core_CAdminHome::getCategory();
		$output['products']=Core_CAdminHome::getProducts();
		$output['ordercount']= Core_CAdminHome::getOrderCount();		
		$output['customers']=Core_CAdminHome::getCustomers();
		
		$default = new Core_CAdminUserRegistration();

		$default = new Core_CAdminUserRegistration();

	   	if(isset($_GET['action']) && $_GET['action']=='edit') 
	   	{

			$output['value'] = $default->editAccount();		
		}

		
		if(count($Err->messages)>=1)
		{

			$output['msg']=$Err->messages;
			$output['value'] = $Err->values;	
		}


		$output['val']=$default->getEditCountry($output['value']['editCountry']);

	    	$output['group']=$default->getEditGroup($output['value']['editGroup']);
		Bin_Template::createTemplate('EditUser.html',$output);
		
	}
	
	/**
	 * Function updates the changes made for a selected user
	 *    
	 * 
	 * @return array
	 */
	
	function updateRegistration()
	{
	

		include('classes/Lib/CheckInputs.php');

		include("classes/Lib/HandleErrors.php");

		

		$output = array();

		include('classes/Core/CAdminUserRegistration.php');

		include('classes/Display/DAdminUserRegistration.php');

		include('classes/Core/CAdminHome.php');

		$output['username']=Core_CAdminHome::userName();

		$output['currentDate']=date('l, M d, Y H:i:s');	

		$output['currency_type']=$_SESSION['currency']['currency_tocken'];				


		$obj = new Lib_CheckInputs('useraccupdate');

	
		$default = new Core_CAdminUserRegistration();

		$output['editmsg'] = $default->updateAccount();

		$_SESSION['rtsinsmsg']=$output['editmsg'];

		
		header('Location:?do=adminreg');

		

	}
	
	/**
	 * Function deletes an selected user from the admin side
	 *    
	 * 
	 * @return array
	 */
	function deleteRegistration()
	{
		$output = array();
		include('classes/Core/CAdminUserRegistration.php');
		include('classes/Display/DAdminUserRegistration.php');
		$default = new Core_CAdminUserRegistration();
		$_SESSION['rtsinsmsg'] =  $default->deleteAccount();
		header('Location:?do=adminreg');
	}
	
	/**
	 * Function updates the status (Active Status) for an selected user at the admin side 
	 * 
	 * 
	 * @return array
	 */	
	function registrationAcceptStatus()
	{
		$output = array();
		include('classes/Core/CAdminUserRegistration.php');
		include('classes/Display/DAdminUserRegistration.php');
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
		
		$default = new Core_CAdminUserRegistration();
		$output['adminregmsg'] = $default->acceptAccount();
		$output['adminreg'] = $default->showAccount();
		Bin_Template::createTemplate('ShowUser.html',$output);
		unset($_SESSION['rtsinsmsg']);
		
	}
	
	/**
	 * Function updates the status (Inactive Status) for an selected user at the admin side 
	 * 
	 * 
	 * @return array
	 */	
	function registrationDenyStatus()
	{
		$output = array();
		include('classes/Core/CAdminUserRegistration.php');
		include('classes/Display/DAdminUserRegistration.php');
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
		
		$default = new Core_CAdminUserRegistration();
		$output['adminregmsg'] =  $default->denyAccount();
		$output['adminreg'] = $default->showAccount();
		Bin_Template::createTemplate('ShowUser.html',$output);
		unset($_SESSION['rtsinsmsg']);
		
	}
	
	/**
	 * Function generates a user report in  excel/csv/tab/XML format at the admin side 
	 * 
	 * 
	 * @return array
	 */	
	
	function userReport()
	{
		$output = array();
		include('classes/Core/CAdminUserRegistration.php');
		/*include('classes/Core/CAdminHome.php');
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
		$output['disabledproducts']=Core_CAdminHome::disabledProducts();*/
		Core_CAdminUserRegistration::searchUserDetails();
		
	}
	
	/**
	 * Function updates the CSE affilliate ID in the database from the admin side 
	 * 
	 * 
	 * @return array
	 */	
	function saveCse()
	{	
		$output = array();
		include('classes/Core/CAdminUserRegistration.php');
		$output['adminreg'] = Core_CAdminAddUsrRegsitration::saveCse();
		Bin_Template::createTemplate('ComparisonEngine.html',$output);
	}
	
	
	/**
	 * Function displays a new registration page for adding an customer account 
	 * at the admin side   
	 * 
	 * @return array
	 */
	
	function displayRegPage()
	{
		$output = array();
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
			include('classes/Core/CAdminUserRegistration.php');
			include("classes/Lib/HandleErrors.php");
			
			//$output['val']=$Err->values;
			
			$output['val']=Core_CAdminUserRegistration::getCountry($Err->values);
			$output['msg']=$Err->messages;
			$output['group']=Core_CAdminUserRegistration::getGroup($Err->values);

			$output['account'] = $_SESSION['msgCustomersuccess'];
			Bin_Template::createTemplate('signup.html',$output);
			unset($_SESSION['msgCustomersuccess']);
		}
		else
		{
			$output['usererr'] = 'You are Not having Privilege to view this page contact your Admin for detail';
			Bin_Template::createTemplate('Errors.html',$output);
		}	

	}
	
	/**
	 * Function validates and updates a new account from the admin side   
	 * 
	 * 
	 * @return array
	 */
	
	function showValidateRegPage()
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
		include('classes/Lib/CheckInputs.php');
		include('classes/Core/CAdminUserRegistration.php');		
		$obj = new Lib_CheckInputs('useraccregister');
			
			//include_once('classes/Core/CAdminUserRegistration.php');
		$_SESSION['rtsinsmsg']= Core_CAdminUserRegistration::addAccount();

		header('Location:?do=adminreg');
		exit;
			
	}
	
	/**
	 * Function generates a user report in  excel/csv/tab/XML format at the admin side 
	 * 
	 * 
	 * @return array
	 */	
	
	
	
	function customerExportReport()
	{
		include('classes/Core/CRoleChecking.php');
		
		$chkuser=Core_CRoleChecking::checkRoles();
		if($chkuser)
		{
		$output = array();
		include('classes/Core/CAdminUserRegistration.php');
		include('classes/Display/DAdminUserRegistration.php');
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
		
		$default = new Core_CAdminUserRegistration();
		$output['adminregmsg'] =  $default->denyAccount();
		$output['adminreg'] = $default->showAccount();
		$output['exportreport'] =  $default->denyAccount();
		Bin_Template::createTemplate('customerreport.html',$output);
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
		include('classes/Core/CAdminUserRegistration.php');
		$default = new Core_CAdminUserRegistration();
		if($_GET['ids']==1)
			$output['displayname']=$default->autoComplete();
		elseif($_GET['ids']==2)
			$output['firstname']=$default->autoComplete();
		elseif($_GET['ids']==3)
			$output['lastnname']=$default->autoComplete();
		elseif($_GET['ids']==4)
			$output['email']=$default->autoComplete();
		//Bin_Template::createTemplate('autocomplete.html',$output);
	}
	/**
	 * Function displays a light box registration page for adding an customer account 
	 * at the admin side   
	 * 
	 * @return array
	 */	
	function displayRegPageLight()
	{
		$output = array();
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
			include('classes/Core/CAdminUserRegistration.php');
			include("classes/Lib/HandleErrors.php");
			
			//$output['val']=$Err->values;
			
			$output['val']=Core_CAdminUserRegistration::getCountry($Err->values);
			$output['msg']=$Err->messages;
			Bin_Template::createTemplate('signup_light.html',$output);
		}
		else
		{
			$output['usererr'] = 'You are Not having Privilege to view this page contact your Admin for detail';
			Bin_Template::createTemplate('Errors.html',$output);
		}	

	}

	/**
	 * Function validates and updates a new account from the admin side for light box register page  
	 * 
	 * 
	 * @return array
	 */	
	function showValidateRegPageLight()
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
			include('classes/Lib/CheckInputs.php');
			include('classes/Core/CAdminUserRegistration.php');		
			$obj = new Lib_CheckInputs('useraccregisterlight');
			
			//include_once('classes/Core/CAdminUserRegistration.php');
			$output['account'] = Core_CAdminUserRegistration::addAccount();
			Bin_Template::createTemplate('signup_light.html',$output);
		}
		else
		{
			$output['usererr'] = 'You are Not having Privilege to view this page contact your Admin for detail';
			Bin_Template::createTemplate('Errors.html',$output);
		}	

	}
	/**
	 * Function is used to view the customer details page
	 * 
	 * 
	 * @return array
	 */
	function customerDetail()	
	{
		include('classes/Core/CAdminHome.php');
		include('classes/Display/DAdminHome.php');
		include('classes/Core/CAdminUserRegistration.php');
		include('classes/Core/CRoleChecking.php');
		include('classes/Display/DAdminUserRegistration.php');
		
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
			$output['cusotmerdetail'] = Core_CAdminUserRegistration::customerDetail();	

					
			Bin_Template::createTemplate('customerdetail.html',$output);
		}
		else
		{
			$output['usererr'] = 'You are Not having Privilege to view this page contact your Admin for detail';
			Bin_Template::createTemplate('Errors.html',$output);
		}	

	}
	
}
?>