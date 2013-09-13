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
 * This class contains functions related customer group management.
 *
 * @package  		Model_MCustomerGroup
 * @category  		Model
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
 * @copyright 	        Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */

class Model_MCustomerGroup
{
	/**
	 * Stores the output
	 *
	 * @var array $output
	 */	
	var $output = array();	
	
	/**
	 * Function displays the list of Customer available 
	 * at the admin side   
	 * 
	 * @return array
	 */
	function showCustomerGroup()
	{
		$output = array();
		

		include('classes/Core/CRoleChecking.php');
		include('classes/Core/CCustomerGroup.php');
		include('classes/Display/DCustomerGroup.php');	
		include('classes/Model/MSiteStatistics.php');
		
		$output=Model_MSiteStatistics::siteStatistics();
		
		$chkuser=Core_CRoleChecking::checkRoles();
		
		if($chkuser)
		{	
			
			$output['adminregmsg'] =$_SESSION['addmsg'];
			
			$output['cutomergroup'] = Core_CCustomerGroup::displayAjaxCustGroup();
			Bin_Template::createTemplate('customergroup.html',$output);
			unset($_SESSION['addmsg']);
			
		}
		else
		{
		 	$output['usererr'] = 'You are Not having Privilege to view this page contact your Admin for detail';
			Bin_Template::createTemplate('Errors.html',$output);
		}
		
	}	
	/**
	 * Function gets the list of customer group  
	 * 
	 * 
	 * @return array
	 */
	function ajaxCustomerGroup()
	{
		include('classes/Core/CCustomerGroup.php');
		include('classes/Display/DCustomerGroup.php');		
		$output['cutomergroup'] = Core_CCustomerGroup::displayAjaxCustGroup();	
		Bin_Template::createTemplate('customergroup.html',$output);

	}
	/**
	 * Function show the list of customer group  registration
	 * 
	 * 
	 * @return array
	 */
	function displayCustGrpRegPage()
	{
		$output = array();
		include('classes/Core/CRoleChecking.php');
		include('classes/Core/CAdminHome.php');
		include('classes/Display/DAdminHome.php');
		include('classes/Display/DCustomerGroup.php');		
		$output['username']=Core_CAdminHome::userName();
		$output['currentDate']=date('l, M d, Y H:i:s');	
		$output['currency_type']=$_SESSION['currency']['currency_tocken'];			
		/*$arr=Core_CAdminHome::dashSettings();*/		
		/*$output['controlpanel']=Core_CAdminHome::getControlPanel($arr);	
		$output['zeusnews']=Core_CAdminHome::showHomeZeuscartNews();*/			

		
		$chkuser=Core_CRoleChecking::checkRoles();
		if($chkuser)
		{
			include('classes/Core/CCustomerGroup.php');
			include("classes/Lib/HandleErrors.php");			
			
			$output['msg']=$Err->messages;
			$output['val']=$Err->values;
			
			Bin_Template::createTemplate('customergroupreg.html',$output);
		}
		else
		{
			$output['usererr'] = 'You are Not having Privilege to view this page contact your Admin for detail';
			Bin_Template::createTemplate('Errors.html',$output);
		}	

	}	
	/**
	 * Function displays the  details  of  customer for updation 
	 * 
	 * 
	 * @return array
	 */
	
	function editCustomerGroup()
	{


		include('classes/Core/CRoleChecking.php');
		include('classes/Core/CAdminHome.php');
		include('classes/Display/DAdminHome.php');
		$output['username']=Core_CAdminHome::userName();
		$output['currentDate']=date('l, M d, Y H:i:s');	
		$output['currency_type']=$_SESSION['currency']['currency_tocken'];			
		$output['category']=Core_CAdminHome::getCategory();
		$output['products']=Core_CAdminHome::getProducts();
		$output['ordercount']= Core_CAdminHome::getOrderCount();		
		$output['customers']=Core_CAdminHome::getCustomers();
		/*$default = new Core_CAdminHome();
		$arr=$default->dashSettings();	*/	
		/*$output['controlpanel']=$default->getControlPanel($arr);*/	
// 		$output['zeusnews']=$default->showHomeZeuscartNews();
		$chkuser=Core_CRoleChecking::checkRoles();
		include('classes/Core/CCustomerGroup.php');
		include('classes/Display/DCustomerGroup.php');
		if($chkuser)
		{

			include("classes/Lib/HandleErrors.php");			
			
			$output['msg']=$Err->messages;
			$output['val']=$Err->values;

			$output['editcustgroup'] =   Core_CCustomerGroup::displaySelectedGroup($Err->messages,$Err->values);
			Bin_Template::createTemplate('editcustomergroup.html',$output);				
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
	
	function updateCustomerGroup()
	{
		include('classes/Core/CRoleChecking.php');
		include('classes/Core/CCustomerGroup.php');
		$chkuser=Core_CRoleChecking::checkRoles();		
		include('classes/Lib/CheckInputs.php');
		if($chkuser)
		{
			$obj = new Lib_CheckInputs('editcustomergroup');
			Core_CCustomerGroup::updateCustomerGroup();
	 
	    	}
		else
		{
			$output['usererr'] = 'You are Not having Privilege to view this page contact your Admin for detail';
			Bin_Template::createTemplate('Errors.html',$output);
		}
			
	}
	
	/**
	 * Function deletes the selected customer group
	 * at the admin side   
	 * 
	 * @return array
	 */
	
	function deleteCustomerGroup()
	{
		include('classes/Core/CRoleChecking.php');

		$chkuser=Core_CRoleChecking::checkRoles();
		
 	    	include('classes/Core/CCustomerGroup.php');
		if($chkuser)
		{
			Core_CCustomerGroup::deleteCustomerGroup();	
		
		}
		else
		{
			 $output['usererr'] = 'You are Not having Privilege to view this page contact your Admin for detail';
			Bin_Template::createTemplate('Errors.html',$output);
		}
		 
	}
	
	/**
	 * Function adds a new customer group
	 * 
	 * 
	 * @return array
	 */
	
	function insertCustomerGroup()
	{

		include('classes/Lib/CheckInputs.php');

		$obj = new Lib_CheckInputs('customergroup');

		include('classes/Core/CRoleChecking.php');

	   	include('classes/Core/CCustomerGroup.php');

		$chkuser=Core_CRoleChecking::checkRoles();

						

		if($chkuser)

		{		

			Core_CCustomerGroup::insertCustomerGroup();

		

	  	}

		else

		{

			$output['usererr'] = 'You are Not having Privilege to view this page contact your Admin for detail';

			Bin_Template::createTemplate('Errors.html',$output);

		}
		  
	}
	

}
?>