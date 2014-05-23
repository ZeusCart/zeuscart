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
 * This class contains functions related to home page ads
 * 
 * @package  		Model_MHomePageAds
 * @category  		Model
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
  * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */

class Model_MHomePageAds
{
	
	/**
	 * Function displays a home page ads list
	 * 
	 * 
	 * @return array
	 */
	function showHomePageAdsList()
	{	
		$output = array();
		
		include('classes/Core/CHomePageAds.php');
		include('classes/Core/CRoleChecking.php');
		include('classes/Display/DHomePageAds.php');
		include('classes/Model/MSiteStatistics.php');
		
		$output=Model_MSiteStatistics::siteStatistics();
		
		$chkuser=Core_CRoleChecking::checkRoles();
		
		if($chkuser)
		{	
			$output['insmsg'] =$_SESSION['rtsinsmsg'];
			unset($_SESSION['rtsinsmsg']);
			$output['homepageads'] = Core_CHomePageAds::showHomePageAdsList();
			$output['deleteMsg']=$_SESSION['msgHomepageaddelete'];
			$output['updateMsg']=$_SESSION['msgHomepageadupdate'];
			$output['saveMsg']=$_SESSION['msgHomepageadsave'];
			Bin_Template::createTemplate('homepageads.html',$output);
			unset($_SESSION['msgHomepageadupdate']);
			unset($_SESSION['msgHomepageaddelete']);
			unset($_SESSION['msgHomepageadsave']);
		}
		else
		{
			$output['usererr'] = 'You are Not having Privilege to view this page contact your Admin for detail';
			Bin_Template::createTemplate('Errors.html',$output);
		}
	}

	/**
	 * Function is used to show the template for add home page ads
	 * 
	 * 
	 * @return array
	 */
	function showAddHomePageAds()
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
			
			$output['msg']=$Err->messages;
			$output['val']=$Err->values;
			
			Bin_Template::createTemplate('addhomepageads.html',$output);
			
		}
		else
		{
			$output['usererr'] = 'You are Not having Privilege to view this page contact your Admin for detail';
			Bin_Template::createTemplate('Errors.html',$output);
		}	
		
	}	
	/**
	 * Function is used to insert add home page ads
	 * 
	 * 
	 * @return array
	 */

	function insertHomePageAds()
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
		include('classes/Core/CHomePageAds.php');		
		$obj = new Lib_CheckInputs('addhomepageads');


		$_SESSION['msgHomepageadsave'] = Core_CHomePageAds::insertHomePageAds();
		 
		header('Location:?do=homepageads');
		exit;

	}
	/**
	 * Function is used to delete add home page ads
	 * 
	 * 
	 * @return array
	 */	
	function deleteHomePageAds()
	{
		
		include('classes/Core/CHomePageAds.php');
		$default = new Core_CHomePageAds();
		$_SESSION['msgHomepageaddelete'] =  $default->deleteHomePageAds();
		header('Location:?do=homepageads');
		exit;

	}
	/**
	 * Function is used to show the edit home page ads template
	 * 
	 * 
	 * @return array
	 */	
	function showEditHomePageAds()
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
			include('classes/Core/CHomePageAds.php');
			include("classes/Lib/HandleErrors.php");			

			$output['msg']=$Err->messages;
			if(!empty($output['msg']))
			{
				$output['val']=$Err->values;
			}	
			else
			{			
				$output['val']=Core_CHomePageAds::gethomepaggads();
			}	
			Bin_Template::createTemplate('edithomepageads.html',$output);
		}
		else
		{
			$output['usererr'] = 'You are Not having Privilege to view this page contact your Admin for detail';
			Bin_Template::createTemplate('Errors.html',$output);
		}		
	}
	/**
	 * Function is used to update  the edit home page ads 
	 * 
	 * 
	 * @return array
	 */
	function updateEditHomePageAds()
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
		include('classes/Core/CHomePageAds.php');		
		$obj = new Lib_CheckInputs('edithomepageads');


		$_SESSION['msgHomepageadupdate'] = Core_CHomePageAds::updateEditHomePageAds();
		header('Location:?do=homepageads');
		exit;
		
	}
	/**
	 * Function is used to activate  the  home page ads 
	 * 
	 * 
	 * @return array
	 */
	function acceptHomePageAds()
	{
		$output = array();
		include('classes/Core/CHomePageAds.php');
		$default = new Core_CHomePageAds();
		$_SESSION['rtsinsmsg'] =  $default->acceptHomePageAds();
		header('Location:?do=homepageads');

	}
	/**
	 * Function is used to  inactivate  the  home page ads 
	 * 
	 * 
	 * @return array
	 */
	function denyEditHomePageAds()
	{
		$output = array();
		include('classes/Core/CHomePageAds.php');
		$default = new Core_CHomePageAds();
		$_SESSION['rtsinsmsg'] =  $default->denyEditHomePageAds();
		header('Location:?do=homepageads');

	}

	/**
	 * Function is used to show home page about content 
	 * 
	 * 
	 * @return array
	 */
	function showHomePageContent()
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
		$chkuser=Core_CRoleChecking::checkRoles();
		if($chkuser)
		{
			include("classes/Lib/HandleErrors.php");			
		
			$output['msg']=$Err->messages;
			$output['val']=$Err->values;

			include("classes/Core/CHomePageAds.php");
			include("classes/Display/DHomePageAds.php");
			$output['homepagecontent'] = Core_CHomePageAds::showHomePageContent($Err);
			$output['sitemotomsg'] =$_SESSION['msgSitemoto'];
			Bin_Template::createTemplate('home_page_content.html',$output);	
			unset($_SESSION['msgSitemoto']);
		}
		else
		{
			$output['usererr'] = 'You are Not having Privilege to view this page contact your Admin for detail';
			Bin_Template::createTemplate('Errors.html',$output);
		}

	}
	/**
	 * Function is used to update home page about content and shipping 
	 * 
	 * 
	 * @return array
	 */
	function updateHomePageContent()
	{

			
		include('classes/Core/CRoleChecking.php');
		$chkuser=Core_CRoleChecking::checkRoles();
		if($chkuser)
		{
			include('classes/Lib/CheckInputs.php');	
			$obj = new Lib_CheckInputs('homepagecontent');
			include("classes/Core/CHomePageAds.php");
			include("classes/Display/DHomePageAds.php");
			Core_CHomePageAds::updateHomePageContent();
			header('Location:?do=homepage&action=content');
		}
		else
		{
			$output['usererr'] = 'You are Not having Privilege to view this page contact your Admin for detail';
			Bin_Template::createTemplate('Errors.html',$output);
		}
	}	
	
}
?>