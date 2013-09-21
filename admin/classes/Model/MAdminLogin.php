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
 * This class contains functions to display the login page at the admin side.
 *
 * @package  		Model_MAdminLogin
 * @category  		Model
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
  * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */



class Model_MAdminLogin
{
	/**
	 * Stores the output
	 *
	 * @var array $output
	 */		 
	var $output = array();
	
	/**
	 * Function  displays the Login Status of an admin at the index page 
	 * 
	 * 
	 * @return array
	 */
	
	function logoutStatus()
	{
		include('classes/Core/CAdminLogin.php');
		$output['logoutmsg']=Core_CAdminLogin::logoutStatus();
		Bin_Template::createTemplate('login.html',$output);		
	}
	
	/**
	 * Function  displays the Index Page at the admin side 
	 * 
	 * 
	 * @return array
	 */
	
	
	function showIndexPage()
	{
		include("classes/Lib/HandleErrors.php");
		
		if(!isset($has_javascript)) 
		{
		 // here goes non-javascript page
			//window.location+"?has_javascript=1";
			//echo ' hi';
		}
		 else 
		 {
		// header('Location:?do="dfdf');
			echo 'hello';
		 // here goes page with javascript
		 }


		//include('classes/Core/CAdminHome.php');
		if(count($Err->messages) > 0)
		{
			$output['val'] = $Err->values;
			$output['msg'] = $Err->messages;
		}
		
		//$output['username']=Core_CAdminLogin::loginStatus();
		
		Bin_Template::createTemplate('login.html',$output);
	}
	
	
	/**
	 * Function  displays the Forgot password page at the admin side 
	 * 
	 * 
	 * @return array
	 */
	
	
	function forgetPasswordPage()
	{
		include('classes/Core/CAdminLogin.php');
		include("classes/Lib/HandleErrors.php");
		$output['val']=$Err->values;
		$output['msg']= $Err->messages;
		Bin_Template::createTemplate('forgetpassword.html',$output);
	}
	
	/**
	 * Function  updates the password and sends a mail to the admin  
	 * 
	 * 
	 * @return array
	 */
	
	
	function forgetPassword()
	{
		include('classes/Core/CAdminLogin.php');
		include('classes/Lib/CheckInputs.php');
		$obj = new Lib_CheckInputs('adminemail');
		$output['forgetpass']=Core_CAdminLogin::forgetPassword();
		Bin_Template::createTemplate('forgetpassword.html',$output);
	}
	
	/*function left_menu()
	{
		$output['deliveredorders']=(int)Core_CAdminHome::deliveredOrders();
		$output['currentDate']=date('l, M d, Y H:i:s');		
		$output['username'] = Core_CAdminLogin::loginStatus();
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
		return $output;
	}*/
	
	/**
	 * Function is used to validate the username and password supplied by the admin while login. 
	 * 
	 * 
	 * @return array
	 */
	
	
	function showValidateLoginPage()
	{

		include('classes/Lib/CheckInputs.php');
		
		include('classes/Core/CRoleChecking.php');
		
		include('classes/Model/MSiteStatistics.php');
		
		include('classes/Display/DAdminHome.php');
		new Lib_CheckInputs('validatelogin');
		$output=Model_MSiteStatistics::siteStatistics();
		$chkuser=Core_CRoleChecking::checkRoles();
		
		if($chkuser)
		{
			$output['users_chart']=Core_CAdminHome::getUserschart();
			$output['sales_chart']=Core_CAdminHome::getSaleschart();
			$output['latestcustomers']=Core_CAdminHome::getLatestCustomers();
			$output['latestorders']=Core_CAdminHome::latestOrders();

			// echo "<pre>";
			// print_r($output['users_chart']);exit;
		
			Bin_Template::createTemplate('index.html',$output);
		}
		else
		{
			$output['usererr'] = 'You are Not having Privilege to view this page contact your Admin for detail';
			Bin_Template::createTemplate('Errors.html',$output);
			
		}	
	}
}
?>