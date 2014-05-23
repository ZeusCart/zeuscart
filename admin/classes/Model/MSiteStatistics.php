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
 * This class contains functions to display the site statistics 
 * at the admin side.
 *
 * @package  		Model_MSiteStatistics
 * @category  		Model
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
 * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */


class Model_MSiteStatistics
{
	/**
	 * Stores the output
	 *
	 * @var array $output
	 */	
	var $output=array();
	
	/**
	 * Function displays a detailed site statistics report 
	 * at the admin side   
	 * 
	 * @return array
	 */
	
	
	function siteStatistics()
	{
		include('classes/Core/CAdminLogin.php');
		include('classes/Core/CAdminHome.php');
		
		$output['currentDate']=date('l, M d, Y H:i:s');	
		$output['currency_type']=$_SESSION['currency']['currency_tocken'];			
		$output['username'] = Core_CAdminLogin::loginStatus();
		
		
		// Orders Statistics
		$output['monthlyorders']= (int)Core_CAdminHome::monthlyOrders();
		$output['previousmonthorders']=(int)Core_CAdminHome::previousMonthOrders();
		$output['pendingorders']=(int)Core_CAdminHome::pendingOrders();
		$output['processingorders']=(int)Core_CAdminHome::processingOrders();
		$output['deliveredorders']=(int)Core_CAdminHome::deliveredOrders();
		$output['totalorders']=(int)Core_CAdminHome::totalOrders();
		$output['currency_type']=$_SESSION['currency']['currency_tocken'];
		// Sales Statistics
		$output['currentmonthincome']=Core_CAdminHome::currentMonthIncome();
		$output['previousmonthincome']=Core_CAdminHome::previoustMonthIncome();
		$output['totalincome']=Core_CAdminHome::totalIncome();
		
		// Products Statistics
		$output['enabledproducts']=(int)Core_CAdminHome::enabledProducts();
		$output['disabledproducts']=(int)Core_CAdminHome::disabledProducts();
		$output['totalproducts']=(int)Core_CAdminHome::totalProducts();		
		
		// Products Inventory Statistics
		$output['lowstock']=(int)Core_CAdminHome::lowStock();
		
		// Customers Statistics
		$output['currentmonthuser']=(int)Core_CAdminHome::currentMonthUser();
		$output['previousmonthuser']=(int)Core_CAdminHome::previousMonthUser();
		$output['totalusers']=(int)Core_CAdminHome::totalUsers();
		
		
		/*$output['currentmonthproudctquantity']=(int)Core_CAdminHome::currentMonthProudctQuantity();
		$output['previousmonthproudctquantity']=(int)Core_CAdminHome::previousMonthProudctQuantity();
		$output['totalproudctquantity']=(int)Core_CAdminHome::totalProudctQuantity();*/
		
		return $output;
	}
	
}


?>