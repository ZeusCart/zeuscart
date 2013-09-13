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
 * This class contains functions to display the roles for the subadmin 
 * at the admin side.
 *
 * @package  		Model_MAdminRoleManagement

 * @category  		Model
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
  * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */

class Model_MAdminRoleManagement
{
	/**
	 * Stores the output
	 *
	 * @var array $output
	 */		

	var $output = array();	
	
	/**
	 * Function displays the roles for the subadmin at the admin side  
	 * 
	 * 
	 * @return array
	 */
	
	function displayAdminRole()
	{
		
		include('classes/Core/CAdminRoleManagement.php');
		include('classes/Display/DAdminRoleManagement.php');
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
		include('classes/Core/CRoleChecking.php');
		$chkuser=Core_CRoleChecking::checkRoles();
		if($chkuser)
		{
			$output['subadminroles'] =  Core_CAdminRoleManagement::dispSubAdminRole();	
			$output['updatemsg'] =$_SESSION['msgSubadminrole'];		
			Bin_Template::createTemplate('AdminRoleManagement.html',$output);	
			unset($_SESSION['msgSubadminrole']);		
		}
		else
		{
			$output['usererr'] = 'You are Not having Privilege to view this page contact your Admin for detail';
			Bin_Template::createTemplate('Errors.html',$output);
		}
		
	}	
	
	/**
	 * Function displays a template for updating the subadmin role at the admin side  
	 * 
	 * 
	 * @return array
	 */
	
	
	function editSubAdminRole()
	{
		include('classes/Core/CRoleChecking.php');
		include('classes/Core/CAdminRoleManagement.php');
		include('classes/Display/DAdminRoleManagement.php');
		$chkuser=Core_CRoleChecking::checkRoles();
		if($chkuser)
		{		
			$output['editSubAdminRoles'] =   Core_CAdminRoleManagement::dispSelectedSubAdminRole();	
						
			Bin_Template::createTemplate('editsubadminrolemanagement.html',$output);
			unset($_SESSION['msgSubadminrole']);
		}
		else
		{
			$output['usererr'] = 'You are Not having Privilege to view this page contact your Admin for detail';
			Bin_Template::createTemplate('Errors.html',$output);
		}

	}	
	
	/**
	 * Function updates the subadmin role at the admin side  
	 * 
	 * 
	 * @return array
	 */

	function updateSubAdminRole()
	{
		include('classes/Core/CRoleChecking.php');
		include('classes/Core/CAdminRoleManagement.php');
		$chkuser=Core_CRoleChecking::checkRoles();
		
		$_SESSION['msgSubadminrole']= Core_CAdminRoleManagement::updateSubAdminRole();				
		$id=$_POST['subid'];
		header("Location:?do=subadminrole&id=$id");
		exit;
		
		
	}
	
	/**
	 * Function deletes the subadmin role at the admin side  
	 * 
	 * 
	 * @return array
	 */

	function deleteSubAdminRole()
	{
		include('classes/Core/CRoleChecking.php');
		include('classes/Core/CAdminRoleManagement.php');
		$chkuser=Core_CRoleChecking::checkRoles();
		if($chkuser)
		{
			$output['deletemsg'] =   Core_CAdminRoleManagement::deleteSubAdminRole();	
			$id=$_GET['subid'];
			header("Location:?do=subadminrole&id=$id&msg=Successfully%20Removed");
			exit;
		}
		else
		{
			$output['usererr'] = 'You are Not having Privilege to view this page contact your Admin for detail';
			Bin_Template::createTemplate('Errors.html',$output);
		}
		Model_MAdminRoleManagement::displayAdminRole();
	}
	
	
	/**
	 * Function inserts a new subadmin role at the admin side  
	 * 
	 * 
	 * @return array
	 */
	
	function insertSubAdminRole()
	{
		include('classes/Core/CRoleChecking.php');
		include('classes/Core/CAdminRoleManagement.php');
		$chkuser=Core_CRoleChecking::checkRoles();

		$_SESSION['msgSubadminrole']= Core_CAdminRoleManagement::insertSubAdminRole();				
		$id=$_POST['subadminid'];
		header("Location:?do=subadminrole&id=$id");
		exit;

	}
}
?>