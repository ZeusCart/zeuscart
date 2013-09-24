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
 * This class contains functions to add, edit and delete a tax rate for the list of currencies available 
 *
 * @package  		Model_MCurrencySettings
 * @category  		Model
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
  * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */


class Model_MCurrencySettings
{
	
	/**
	 * Function displays the list of currencies available  
	 * 
	 * 
	 * @return array
	 */	
		
	function showCurrencyList()
	{	
		//$output = array();
		
		include('classes/Core/CRoleChecking.php');
		include('classes/Core/Settings/CCurrencySettings.php');
		include('classes/Display/DCurrencySettings.php');
		include('classes/Core/CAdminHome.php');
		include('classes/Display/DAdminHome.php');
		$output['username']=Core_CAdminHome::userName();
		$output['currentDate']=date('Y-m-d , H:m:s');		
		
		$chkuser=Core_CRoleChecking::checkRoles();
		
		if($chkuser)
		{
			$output['insmsg'] =$_SESSION['rtsinsmsg'];
			unset($_SESSION['rtsinsmsg']);
			$output['taxsettings'] = Core_Settings_CCurrencySettings::showCurrencyList();
			Bin_Template::createTemplate('currencysettings.html',$output);
		}
		else
		{
		 	$output['usererr'] = 'You are Not having Privilege to view this page contact your Admin for detail';
			Bin_Template::createTemplate('Errors.html',$output);
		}
	}
	

	
	
	/**
	 * Function displays a template for adding a new currency  
	 * 
	 * 
	 * @return array
	 */	
	
	

	function showAddCurrency()
	{	
		$output = array();
		include("classes/Lib/HandleErrors.php");
		include('classes/Core/CRoleChecking.php');
		include('classes/Core/Settings/CCurrencySettings.php');
		include('classes/Display/DCurrencySettings.php');
		include('classes/Core/CAdminHome.php');
		include('classes/Display/DAdminHome.php');
		$output['username']=Core_CAdminHome::userName();
		$output['currentDate']=date('Y-m-d , H:m:s');		
		$chkuser=Core_CRoleChecking::checkRoles();
		
		if($chkuser)
		{
			
			$output['msg']=$Err->messages;
			$output['values']=$Err->values;
			$output['currencysettings'] = Core_Settings_CCurrencySettings::showAddCurrency($Err);
			Bin_Template::createTemplate('addcurrencysetting.html',$output);
		}
		else
		{
		 	$output['usererr'] = 'You are Not having Privilege to view this page contact your Admin for detail';
			Bin_Template::createTemplate('Errors.html',$output);
		}
	}

	/**
	 * Function displays a template for adding  currency  
	 * 
	 * 
	 * @return array
	 */	
	
	
	function addCurrency()
	{	
		include('classes/Lib/CheckInputs.php');
		include('classes/Core/Settings/CCurrencySettings.php');
		$obj = new Lib_CheckInputs('addnewcurrency');
		$default = new Core_Settings_CCurrencySettings();
		$_SESSION['rtsinsmsg'] = $default->addNewCurrency();
		header("Location:?do=showcurrencylist");
	}
	/**
	 * Function displays a template for edit  currency  
	 * 
	 * 
	 * @return array
	 */	
	
	function showEditCurrency()
	{
		$output = array();
		include("classes/Lib/HandleErrors.php");
		include('classes/Core/CRoleChecking.php');
		include('classes/Core/Settings/CCurrencySettings.php');
		include('classes/Display/DCurrencySettings.php');
		include('classes/Core/CAdminHome.php');
		include('classes/Display/DAdminHome.php');
		$output['username']=Core_CAdminHome::userName();
		$output['currentDate']=date('Y-m-d , H:m:s');		
		$chkuser=Core_CRoleChecking::checkRoles();
		
		if($chkuser)
		{
			$output['msg']=$Err->messages;
			$output['values']=$Err->values;
			$output['currencysettings'] = Core_Settings_CCurrencySettings::showEditCurrency($Err);
			Bin_Template::createTemplate('addcurrencysetting.html',$output);
		}
		else
		{
		 	$output['usererr'] = 'You are Not having Privilege to view this page contact your Admin for detail';
			Bin_Template::createTemplate('Errors.html',$output);
		}
	}
	/**
	 * Function is used to update currency  
	 * 
	 * 
	 * @return array
	 */	
	
	function updateCurrency()
	{	
		include('classes/Lib/CheckInputs.php');
		include('classes/Core/Settings/CCurrencySettings.php');
		$obj = new Lib_CheckInputs('updatecurrency');
		$default = new Core_Settings_CCurrencySettings();
		$_SESSION['rtsinsmsg'] = $default->updateCurrency();
		header("Location:?do=showcurrencylist");
	}
	/**
	 * Function is used to delete currency  
	 * 
	 * 
	 * @return array
	 */	
	function deleteCurrency()
	{
		
		include('classes/Core/Settings/CCurrencySettings.php');
		$default = new Core_Settings_CCurrencySettings();
		$_SESSION['rtsinsmsg'] = $default->removeCurrency();
		header("Location:?do=showcurrencylist");
		exit;
	}
	
}
?>