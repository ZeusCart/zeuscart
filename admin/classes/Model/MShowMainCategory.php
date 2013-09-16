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
 * This class contains functions to edit and delete the available categories  
 * at the admin side.
 *
 * @package  		Model_MShowMainCategory
 * @category  		Model
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
  * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */


class Model_MShowMainCategory
{

	/**
	 * Function displays the list of categories available at the admin side  
	 * 
	 * 
	 * @return array
	 */
	

	function showMainCategory()
	{
		include('classes/Core/CRoleChecking.php');
		include('classes/Model/MSiteStatistics.php');
		
		$output=Model_MSiteStatistics::siteStatistics();
		
		$chkuser=Core_CRoleChecking::checkRoles();
		
		if($chkuser)
		{
			include("classes/Core/Category/CShowMainCategory.php");
			
			$maincat= new Core_Category_CShowMainCategory();
		
			$output['showmaincat']=$maincat->showMainCategory();
			
			Bin_Template::createTemplate('showmaincategory.html',$output);
			UNSET($_SESSION['updatemiancatmsg']);
		}
		else
		{
		 	$output['usererr'] = 'You are Not having Privilege to view this page contact your Admin for detail';
			
			Bin_Template::createTemplate('Errors.html',$output);
		}
	}
	
	/**
	 * Function displays a template for updating the main category 
	 * at the admin side   
	 * 
	 * @return array
	 */
	
	
	function displayMainCategory()
	{
		include('classes/Core/CRoleChecking.php');
		include("classes/Model/MSiteStatistics.php");
		
		$output=Model_MSiteStatistics::siteStatistics();
		$chkuser=Core_CRoleChecking::checkRoles();
		if($chkuser)
		{
			include("classes/Core/Settings/CCategoryManagement.php");
			include("classes/Core/Category/CShowMainCategory.php");
			include_once('classes/Display/DCategoryManagement.php');
			include("classes/Lib/HandleErrors.php");
			$output['val']=$Err->values;
			$output['msg']=$Err->messages;

			$default = new Core_Category_CShowMainCategory();
			$content= new Core_Settings_CCategoryManagement();
			
			$output['editmaincat']=$default->displayMainCategory($Err);
			$output['content']=$content->showContent();
			
			Bin_Template::createTemplate('editmaincategory.html',$output);
		}
		else
		{
		 	$output['usererr'] = 'You are Not having Privilege to view this page contact your Admin for detail';
			
			Bin_Template::createTemplate('Errors.html',$output);
		}
					
	}	
	
	/**
	 * Function updates the changes made in the main category 
	 * 
	 * 
	 * @return array
	 */
	
	
	
	function editMainCategory()
	{

		include('classes/Lib/CheckInputs.php');
		$obj = new Lib_CheckInputs('editcategory');
		include('classes/Core/CRoleChecking.php');
		include("classes/Model/MSiteStatistics.php");
		
		$output=Model_MSiteStatistics::siteStatistics();
		
		$chkuser=Core_CRoleChecking::checkRoles();
		
		if($chkuser)
		{
			include("classes/Core/Category/CShowMainCategory.php");
			
			$default = new Core_Category_CShowMainCategory();
			
			$output['updatemiancatmsg']=$default->editMainCategory();
			$output['showmaincat']=$default->showMainCategory();
			
			Bin_Template::createTemplate('showmaincategory.html',$output);
			
		}
		else
		{
		 	$output['usererr'] = 'You are Not having Privilege to view this page contact your Admin for detail';
			Bin_Template::createTemplate('Errors.html',$output);
		}
					
	}	 
	
	/**
	 * Function deletes the main category 
	 * 
	 * 
	 * @return array
	 */
	
	
	function deleteMainCategory()
	{
		include('classes/Core/CRoleChecking.php');
		include("classes/Model/MSiteStatistics.php");

		$output=Model_MSiteStatistics::siteStatistics();
		
		$chkuser=Core_CRoleChecking::checkRoles();
		
		if($chkuser)
		{
			include("classes/Core/Category/CShowMainCategory.php");
			
			$default = new Core_Category_CShowMainCategory();
		
			$output['deletemsg']=$default->deleteMainCategory();
			$output['showmaincat']=$default->showMainCategory();
		
			Bin_Template::createTemplate('showmaincategory.html',$output);
		}
		else
		{
		 	$output['usererr'] = 'You are Not having Privilege to view this page contact your Admin for detail';
			
			Bin_Template::createTemplate('Errors.html',$output);
		}
	}	
	
	/**
	 * Function displays the search results for the entered keywords 
	 * 
	 * 
	 * @return array
	 */
	
	
	function searchMainCategory()
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
			include("classes/Core/Category/CShowMainCategory.php");
			$default = new Core_Category_CShowMainCategory();
			//$output['showmaincat']=$default->showMainCategory();
			$output['search']=$default->searchMainCategory();
			
			Bin_Template::createTemplate('showmaincategory.html',$output);
			//header("location:?do=showmain");
			//exit;			
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
		include('classes/Core/Category/CShowMainCategory.php');
		$default = new Core_Category_CShowMainCategory();
		$output['catname']=$default->autoComplete();
		//Bin_Template::createTemplate('autocomplete.html',$output);
	}
}
?>