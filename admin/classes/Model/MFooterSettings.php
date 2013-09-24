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
 * This class contains functions to add, edit and delete a new footer link
 *
 * @package  		Model_MFooterSettings
 * @category  		Model
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
  * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */


class Model_MFooterSettings
{
	
	/**
	 * Stores the output
	 *
	 * @var array $output
	 */	
	 
	var $output = array();	
	
	/**
	 * Function displays the list of footer connect with us available
	 * 
	 * 
	 * @return array
	 */
	

	function viewConnectWithUs()
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
			include("classes/Lib/HandleErrors.php");			
		
			$output['msg']=$Err->messages;
			$output['val']=$Err->values;

			include('classes/Core/Settings/CFooterSettings.php');
			include('classes/Display/DFooterSettings.php');	

			if(count($output['msg'])>0)
			{
				$output['footerconnect'] = $output['val'];
			}
			else
			{	
				$output['footerconnect'] = Core_Settings_CFooterSettings::getFooterConnect();
			}	
				

			Bin_Template::createTemplate('footer_settings_connect.html',$output);
			UNSET($_SESSION['successmsg']);
		}
		else
		{
			$output['usererr'] = 'You are Not having Privilege to view this page contact your Admin for detail';
			Bin_Template::createTemplate('Errors.html',$output);
		}

	}
	/**
	 * Function is used to update the list of footer connect with us
	 * 
	 * 
	 * @return array
	 */
	
	function updateConnectWithUs()
	{

	
		include('classes/Core/CRoleChecking.php');
		$chkuser=Core_CRoleChecking::checkRoles();
		if($chkuser)
		{

			include('classes/Core/Settings/CFooterSettings.php');
			include('classes/Display/DFooterSettings.php');	
			
			include("classes/Lib/CheckInputs.php");
			$obj = new Lib_CheckInputs('footercontent');
			$_SESSION['successmsg'] = Core_Settings_CFooterSettings::updateConnectWithUs();
		
			
			header('Location:?do=footersettings&action=connect');
		}
		else
		{
			$output['usererr'] = 'You are Not having Privilege to view this page contact your Admin for detail';
			Bin_Template::createTemplate('Errors.html',$output);
		}

	}
	/**
	 * Function displays the list of footer links available
	 * 
	 * 
	 * @return array
	 */
	
	function showTemplate()
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
			include('classes/Core/Settings/CFooterSettings.php');
			include('classes/Display/DFooterSettings.php');		
			$output['showfooter'] = Core_Settings_CFooterSettings::showFooterLink();	
			$output['showpage'] = Core_Settings_CFooterSettings::showCustomPage();	
			Bin_Template::createTemplate('footersettings.html',$output);
		}
		else
		{
			$output['usererr'] = 'You are Not having Privilege to view this page contact your Admin for detail';
			Bin_Template::createTemplate('Errors.html',$output);
		}
	}
	
	/**
	 * Function displays a template for adding a new footer link
	 *   
	 * 
	 * @return array
	 */
	
	function addLinkSettings()
	{
		include('classes/Core/CRoleChecking.php');
		$chkuser=Core_CRoleChecking::checkRoles();
		if($chkuser)
		{
			include('classes/Core/Settings/CFooterSettings.php');
			include('classes/Display/DFooterSettings.php');		
			
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
				
			$output['createfooter'] = Core_Settings_CFooterSettings::addLinkSettings();	
			$output['viewfooter'] = Core_Settings_CFooterSettings::viewFooterLink();
			Bin_Template::createTemplate('viewfooterlink.html',$output);
		}
		else
		{
			$output['usererr'] = 'You are Not having Privilege to view this page contact your Admin for detail';
			Bin_Template::createTemplate('Errors.html',$output);
		}
	}	
	
	/**
	 * Function displays a list of footer links available
	 *   
	 * 
	 * @return array
	 */
	
	
	function viewFooterLinks()
	{
		include('classes/Core/CRoleChecking.php');
		$chkuser=Core_CRoleChecking::checkRoles();
		if($chkuser)
		{
			include('classes/Core/Settings/CFooterSettings.php');
			include('classes/Display/DFooterSettings.php');		
			
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
			
			$output['viewfooter'] = Core_Settings_CFooterSettings::viewFooterLink();	
			//$output['showpage'] = Core_Settings_CFooterSettings::showCustomPage();			
			Bin_Template::createTemplate('viewfooterlink.html',$output);
		}
		else
		{
			$output['usererr'] = 'You are Not having Privilege to view this page contact your Admin for detail';
			Bin_Template::createTemplate('Errors.html',$output);
		}
	}
	
	
	/**
	 * Function displays a tempaltes for updating the existing footer links
	 *   
	 * 
	 * @return array
	 */
	
	function EditFooterLinks()
	{
		include('classes/Core/CRoleChecking.php');
		$chkuser=Core_CRoleChecking::checkRoles();
		if($chkuser)
		{
			include('classes/Core/Settings/CFooterSettings.php');
			include('classes/Display/DFooterSettings.php');		
			$output['showfooter'] = Core_Settings_CFooterSettings::showFooterLink();	
			$output['showpage'] = Core_Settings_CFooterSettings::showCustomPage();	
			$output['editfooter'] = Core_Settings_CFooterSettings::EditFooterLinks();	
			//$output['showpage'] = Core_Settings_CFooterSettings::showCustomPage();			
			Bin_Template::createTemplate('editfooterlink.html',$output);
		}
		else
		{
			$output['usererr'] = 'You are Not having Privilege to view this page contact your Admin for detail';
			Bin_Template::createTemplate('Errors.html',$output);
		}
	}
	
	/**
	 * Function updates the changes made in the existing footer links
	 *   
	 * 
	 * @return array
	 */
	
	function updateFooterLinks()
	{
		include('classes/Core/CRoleChecking.php');
		$chkuser=Core_CRoleChecking::checkRoles();
		if($chkuser)
		{
			include('classes/Core/Settings/CFooterSettings.php');
			include('classes/Display/DFooterSettings.php');		
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
			$output['showfooter'] = Core_Settings_CFooterSettings::showFooterLink();	
			$output['showpage'] = Core_Settings_CFooterSettings::showCustomPage();	
			$output['editfooter'] = Core_Settings_CFooterSettings::EditFooterLinks();	
			$output['updatefooter'] = Core_Settings_CFooterSettings::updateFooterLinks();	
			$output['viewfooter'] = Core_Settings_CFooterSettings::viewFooterLink();
			$output['pendingorders']=(int)Core_CAdminHome::pendingOrders();
		$output['processingorders']=(int)Core_CAdminHome::processingOrders();
		$output['deliveredorders']=(int)Core_CAdminHome::deliveredOrders();	
						
			Bin_Template::createTemplate('viewfooterlink.html',$output);
		}
		else
		{
			$output['usererr'] = 'You are Not having Privilege to view this page contact your Admin for detail';
			Bin_Template::createTemplate('Errors.html',$output);
		}
	}
	
	/**
	 * Function deletes the existing footer links
	 *   
	 * 
	 * @return array
	 */
	
	function deleteFooterLinks()
	{
		include('classes/Core/CRoleChecking.php');
		$chkuser=Core_CRoleChecking::checkRoles();
		if($chkuser)
		{
			include('classes/Core/Settings/CFooterSettings.php');
			include('classes/Display/DFooterSettings.php');		
			//$output['showfooter'] = Core_Settings_CFooterSettings::showFooterLink();	
			//$output['showpage'] = Core_Settings_CFooterSettings::showCustomPage();	
			//$output['editfooter'] = Core_Settings_CFooterSettings::EditFooterLinks();	
			//$output['updatefooter'] = Core_Settings_CFooterSettings::updateFooterLinks();	
			$output['deletefooter'] = Core_Settings_CFooterSettings::deleteFooterLinks();
			$output['viewfooter'] = Core_Settings_CFooterSettings::viewFooterLink();				
			Bin_Template::createTemplate('viewfooterlink.html',$output);
		}
		else
		{
			$output['usererr'] = 'You are Not having Privilege to view this page contact your Admin for detail';
			Bin_Template::createTemplate('Errors.html',$output);
		}
	}
}
?>