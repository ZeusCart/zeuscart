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
 * This class contains functions to display the list of roles available for the subadmin 
 *
 * @package  		Model_MPageManagement
 * @category  		Model
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
  * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */

class Model_MPageManagement
{
	/**
	 * Stores the output
	 *
	 * @var array $output
	 */	
	var $output = array();	
	
	/**
	 * Function displays a the list of roles available for the sub admin users
	 * 
	 * 
	 * @return array
	 */
	
	function dispPages()
	{
		include('classes/Core/CPageManagement.php');
		include('classes/Display/DPageManagement.php');	
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
		
		$output['disppages'] =   Core_CPageManagement::dispPages();				

		Bin_Template::createTemplate('PageManagement.html',$output);
	}	
	
	/**
	 * Function deletes a sub admin role
	 * 
	 * 
	 * @return array
	 */
	
	function deletePages()
	{
	  include('classes/Core/CPageManagement.php');
	  $output['subadmin'] =  Core_CPageManagement::deletePages();	
	  header("Location:?do=pagemgt");
	  exit;
	}
	
	/**
	 * Function displays a template for updating a sub admin role
	 * 
	 * 
	 * @return array
	 */
	
	function editPages()
	{
		include('classes/Core/CPageManagement.php');
		include('classes/Display/DPageManagement.php');	
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
		$output['editpages'] =   Core_CPageManagement::editPages();				
		Bin_Template::createTemplate('EditPageManagement.html',$output);
	}

	/**
	 * Function updates the changes made in an sub admin role
	 * 
	 * 
	 * @return array
	 */
	
	function updatePages()
	{
	    include('classes/Core/CPageManagement.php');
	    $output['subadmin'] =  Core_CPageManagement::updatePages();	
	    header("Location:?do=pagemgt");
		exit;
	}
	
	/**
	 * Function inserts a new sub admin role
	 * 
	 * 
	 * @return array
	 */
	
	function insertPages()
	{
	   include('classes/Core/CPageManagement.php');
	    $output['subadmin'] =  Core_CPageManagement::insertPages();	
	    header("Location:?do=pagemgt");
		exit;
	}
}
?>