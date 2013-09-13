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
 *  This class contains functions to  menu management
 *
 * @package  		Model_MMenuManagement
 * @category  		Model
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
  * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */


class Model_MMenuManagement
{
	
	
	/**
	 * Function displays the add  menu  page
	 *   
	 * 
	 * @return array
	 */
		
	function showMenuManagament()
	{
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
		include_once('classes/Core/Settings/CCreatePage.php');			
		//include('classes/Display/DMenuManagement.php');		
		include('classes/Core/CRoleChecking.php');
		$chkuser=Core_CRoleChecking::checkRoles();
		if($chkuser)
		{
			$output['insmsg'] =$_SESSION['rtsinsmsg'];
			unset($_SESSION['rtsinsmsg']);
			include('classes/Core/CMenuManagement.php');
			include('classes/Display/DMenuManagement.php');

			$output['menutitlelist']=Core_CMenuManagement::showMenutitleList();
			$output['menutype']=Core_CMenuManagement::showMenuTypeList();
			$output['menuname']=Core_CMenuManagement::getMenuName();	
			$output['category']=Core_CMenuManagement::selectedMenuTypeList();
			Bin_Template::createTemplate('menus.html',$output);
		}
		else
		{
			$output['usererr'] = 'You are Not having Privilege to view this page contact your Admin for detail';
			Bin_Template::createTemplate('Errors.html',$output);
		}
	}
	/**
	 * Function is used  the add  menu 
	 *   
	 * 
	 * @return array
	 */	
	function insertMenus()
	{
		include('classes/Lib/CheckInputs.php');					
		//$obj = new Lib_CheckInputs('dynamiccms');
		include('classes/Core/CMenuManagement.php');	
		$output['rtsinsmsg'] =  Core_CMenuManagement::insertMenus();
		$_SESSION['rtsinsmsg']	=$output['rtsinsmsg'][1];

		header('Location:?do=menus&id='.$output['rtsinsmsg'][0]);
	}
	/**
	 * Function is used  the list the  menu  list for selected menu type 
	 *   
	 * 
	 * @return array
	 */	
	function selectedMenuTypeList()
	{

		include('classes/Core/CMenuManagement.php');
		include('classes/Display/DMenuManagement.php');	
		echo  Core_CMenuManagement::selectedMenuNavigation();
	}
	/**
	 * Function is used  to insert the navigation
	 *   
	 * 
	 * @return array
	 */
	function insertNavigation()
	{
		
		include('classes/Lib/CheckInputs.php');					
		//$obj = new Lib_CheckInputs('dynamiccms');
		include('classes/Core/CMenuManagement.php');	
		$_SESSION['rtsinsmsg'] =  Core_CMenuManagement::insertNavigation();
		header('Location:?do=menus');

	}
	/**
	 * Function is used  to delete the menu
	 *   
	 * 
	 * @return array
	 */
	function deleteMenus()
	{
		include('classes/Lib/CheckInputs.php');					
		//$obj = new Lib_CheckInputs('dynamiccms');
		include('classes/Core/CMenuManagement.php');	
		$_SESSION['rtsinsmsg'] =  Core_CMenuManagement::deleteMenus();
		header('Location:?do=menus');

	}

	
}

?>