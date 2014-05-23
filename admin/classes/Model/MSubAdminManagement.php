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
 * This class contains functions to  edit and delete the subadmin 
 * at the admin side.
 *
 * @package  		Model_MSubAdminManagement
 * @category  		Model
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
  * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */



class Model_MSubAdminManagement
{
	/**
	 * Stores the output
	 *
	 * @var array $output
	 */	
	var $output = array();	
	
	/**
	 * Function displays the list of sub admin available 
	 * at the admin side   
	 * 
	 * @return array
	 */
	function dispSubAdmin()
	{
		include("classes/Lib/HandleErrors.php");
		//$output['val']=$Err->values;
		//$output['msg']=$Err->messages;
		include('classes/Core/CSubAdminManagement.php');
		include('classes/Display/DSubadminmanagement.php');		
		include('classes/Core/CAdminHome.php');
		$output['username']=Core_CAdminHome::userName();
		$output['currentDate']=date('l, M d, Y H:i:s');
		$output['currency_type']=$_SESSION['currency']['currency_tocken'];				
	//	$output['category']=Core_CAdminHome::getCategory();
	//	$output['products']=Core_CAdminHome::getProducts();
	//	$output['ordercount']= Core_CAdminHome::getOrderCount();
	//	$output['customers']=Core_CAdminHome::getCustomers();
		
		//include('classes/Core/CAdminHome.php');
		$output['username']=Core_CAdminHome::userName();
		//$output['currentDate']=date('Y-m-d , H:m:s');		
/*<!--		$output['category']= (int) Core_CAdminHome::getCategory();
		$output['products']= (int) Core_CAdminHome::getProducts();
		$output['ordercount']= (int) Core_CAdminHome::getOrderCount();
		$output['customers']= (int) Core_CAdminHome::getCustomers();-->*/
		
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
			$output['subadmin'] =   Core_CSubadminmanagement::displaySubAdmin($Err);
			$output['updateMsg']=$_SESSION['msgSubadminupdate'];
			$output['deleteMsg']=$_SESSION['msgSubadmindelete'];
			$output['insertMsg']=$_SESSION['msgSubadmininsert'];
			Bin_Template::createTemplate('Subadminmanagement.html',$output);		
			unset($_SESSION['msgSubadminupdate']);		
			unset($_SESSION['msgSubadmindelete']);
			unset($_SESSION['msgSubadmininsert']);
		}
		else
		{
			$output['usererr'] = 'You are Not having Privilege to view this page contact your Admin for detail';
			Bin_Template::createTemplate('Errors.html',$output);
		}
		
	}	
	
	/**
	 * Function displays the list of roles available for sub admin for updation 
	 * 
	 * 
	 * @return array
	 */
	
	function editSubAdmin()
	{
		include('classes/Core/CRoleChecking.php');
		include('classes/Core/CAdminHome.php');
		$output['username']=Core_CAdminHome::userName();
		$output['currentDate']=date('l, M d, Y H:i:s');	
		$output['currency_type']=$_SESSION['currency']['currency_tocken'];			
		$output['category']=Core_CAdminHome::getCategory();
		$output['products']=Core_CAdminHome::getProducts();
		$output['ordercount']= Core_CAdminHome::getOrderCount();		
		$output['customers']=Core_CAdminHome::getCustomers();
		$chkuser=Core_CRoleChecking::checkRoles();
		include('classes/Core/CSubAdminManagement.php');
		include('classes/Display/DSubadminmanagement.php');
		if($chkuser)
		{
			$output['editsubadmin'] =   Core_CSubadminmanagement::displaySelectedSubAdmin();
			Bin_Template::createTemplate('editsubadminmanagement.html',$output);				
		}
		else
		{
			$output['usererr'] = 'You are Not having Privilege to view this page contact your Admin for detail';
			Bin_Template::createTemplate('Errors.html',$output);
		}
		
	}	
	
	/**
	 * Function updates the changes made in the sub admin roles
	 * 
	 * 
	 * @return array
	 */
	
	function updateSubAdmin()
	{
		include('classes/Core/CRoleChecking.php');
		include('classes/Core/CAdminHome.php');
		$output['username']=Core_CAdminHome::userName();
		$output['currentDate']=date('l, M d, Y H:i:s');	
		$output['currency_type']=$_SESSION['currency']['currency_tocken'];			
		$output['category']=Core_CAdminHome::getCategory();
		$output['products']=Core_CAdminHome::getProducts();
		$output['ordercount']= Core_CAdminHome::getOrderCount();		
		$output['customers']=Core_CAdminHome::getCustomers();
		include('classes/Core/CSubAdminManagement.php');
		$chkuser=Core_CRoleChecking::checkRoles();

		$_SESSION['msgSubadminupdate']=Core_CSubadminmanagement::updateSubAdmin();	
		header("Location:?do=subadminmgt");		
		exit;	

	}
	
	/**
	 * Function deletes the roles available for the selected subadmin 
	 * at the admin side   
	 * 
	 * @return array
	 */
	
	function deleteSubAdmin()
	{

		include('classes/Core/CRoleChecking.php');
		include('classes/Core/CAdminHome.php');
		$output['username']=Core_CAdminHome::userName();
		$output['currentDate']=date('l, M d, Y H:i:s');	
		$output['currency_type']=$_SESSION['currency']['currency_tocken'];			
		$output['category']=Core_CAdminHome::getCategory();
		$output['products']=Core_CAdminHome::getProducts();
		$output['ordercount']= Core_CAdminHome::getOrderCount();		
		$output['customers']=Core_CAdminHome::getCustomers();
		$chkuser=Core_CRoleChecking::checkRoles();
		include('classes/Core/CSubAdminManagement.php');
		

		
		$_SESSION['msgSubadmindelete']=Core_CSubadminmanagement::deleteSubAdmin();	
		header("Location:?do=subadminmgt");
		exit;
		
	}
	
	/**
	 * Function adds a new sub admin role 
	 * 
	 * 
	 * @return array
	 */
	
	function insertSubAdmin()
	{

		// echo "<pre>";
		// print_r($_POST);

		// echo "adf";exit;
		include('classes/Lib/CheckInputs.php');
		include('classes/Core/CAdminHome.php');
		$output['username']=Core_CAdminHome::userName();
		$output['currentDate']=date('l, M d, Y H:i:s');	
		$output['currency_type']=$_SESSION['currency']['currency_tocken'];			
		$output['category']=Core_CAdminHome::getCategory();
		$output['products']=Core_CAdminHome::getProducts();
		$output['ordercount']= Core_CAdminHome::getOrderCount();		
		$output['customers']=Core_CAdminHome::getCustomers();
		$obj = new Lib_CheckInputs('subadminmail');
		include('classes/Core/CRoleChecking.php');
		include('classes/Core/CSubAdminManagement.php');
		$chkuser=Core_CRoleChecking::checkRoles();
		
		$checkUserExists=Core_CSubadminmanagement::checkSubadminExists();
		
		
		if($chkuser)
		{
			if ($checkUserExists)
				header("Location:?do=subadminmgt&errmsg=User%20Already%20Exists");
			else
			{
				$_SESSION['msgSubadmininsert']=Core_CSubadminmanagement::insertSubAdmin();	
				header("Location:?do=subadminmgt");
			}
			exit;
		}
		else
		{
			$output['usererr'] = 'You are Not having Privilege to view this page contact your Admin for detail';
			Bin_Template::createTemplate('Errors.html',$output);
		}

	}


	function subadminNamealreadyExist()
	{
		
		include('classes/Core/CSubAdminManagement.php');
				
		$checkUserExists=Core_CSubadminmanagement::subadminUsernamecheck();


	}
	

}
?>