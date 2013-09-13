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
 * This class contains functions to add, edit and delete tax settings country wise
 * at the admin side.
 *
 * @package  		Model_MTaxSettings
 * @category  		Model
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
  * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */


class Model_MTaxSettings
{
	/**
	 * Function displays a templates for modifiying the tax settings 
	 * 
	 * 
	 * @return array
	 */
	function showTaxSettings()
	{	
		$output = array();
		
		include('classes/Core/CRoleChecking.php');
		include('classes/Core/Settings/CTaxSettings.php');
		include('classes/Display/DTaxSettings.php');
		include('classes/Core/CAdminHome.php');
		
		$chkuser=Core_CRoleChecking::checkRoles();
		
		if($chkuser)
		{
			$output['username']=Core_CAdminHome::userName();
			$output['currentDate']=date('l, M d, Y H:i:s');
			$output['currency_type']=$_SESSION['currency']['currency_tocken'];	
			$output['taxsettings'] = Core_Settings_CTaxSettings::showTaxSettings();
			Bin_Template::createTemplate('taxsettings.html',$output);
		}
		else
		{
		 	$output['usererr'] = 'You are Not having Privilege to view this page contact your Admin for detail';
			Bin_Template::createTemplate('Errors.html',$output);
		}
	}
	
	/**
	 * Function updates the changes made to the tax settings 
	 * 
	 * 
	 * @return array
	 */
	
	function updateTaxSettings()
	{	
		$output = array();
		
		include('classes/Core/CRoleChecking.php');
		include('classes/Core/Settings/CTaxSettings.php');
		include('classes/Display/DTaxSettings.php');
		include('classes/Core/CAdminHome.php');
		
		$chkuser=Core_CRoleChecking::checkRoles();
		
		if($chkuser)
		{
			$output['username']=Core_CAdminHome::userName();
			$output['currentDate']=date('l, M d, Y H:i:s');
			$output['currency_type']=$_SESSION['currency']['currency_tocken'];	
			$output['insmsg'] = Core_Settings_CTaxSettings::updateTaxSettings();
			$output['taxsettings'] = Core_Settings_CTaxSettings::showTaxSettings();
			Bin_Template::createTemplate('taxsettings.html',$output);
		}
		else
		{
		 	$output['usererr'] = 'You are Not having Privilege to view this page contact your Admin for detail';
			Bin_Template::createTemplate('Errors.html',$output);
		}
	}
	
	/**
	 * Function displays the country wise tax list 
	 * 
	 * 
	 * @return array
	 */
	
	function showCountrywiseTaxList()
	{	
		$output = array();
		
		include('classes/Core/CRoleChecking.php');
		include('classes/Core/Settings/CTaxSettings.php');
		include('classes/Display/DTaxSettings.php');
		include('classes/Core/CAdminHome.php');
		
		$chkuser=Core_CRoleChecking::checkRoles();
		
		if($chkuser)
		{
			$output['username']=Core_CAdminHome::userName();
			$output['currentDate']=date('l, M d, Y H:i:s');
			$output['currency_type']=$_SESSION['currency']['currency_tocken'];
			$output['insmsg'] =$_SESSION['rtsinsmsg'];
			unset($_SESSION['rtsinsmsg']);
			$output['taxsettings'] = Core_Settings_CTaxSettings::showCountrywiseTaxList();
			Bin_Template::createTemplate('countrywisetaxsettingsajax.html',$output);
		}
		else
		{
		 	$output['usererr'] = 'You are Not having Privilege to view this page contact your Admin for detail';
			Bin_Template::createTemplate('Errors.html',$output);
		}
	
	}
	
	/**
	 * Function displays a templates for a adding a new country wise tax list 
	 * 
	 * 
	 * @return array
	 */
	
	function addCountrywiseTax()
	{	
		$output = array();
		
		include('classes/Core/CRoleChecking.php');
		include('classes/Core/Settings/CTaxSettings.php');
		include('classes/Display/DTaxSettings.php');
		include("classes/Lib/HandleErrors.php");
		include('classes/Core/CAdminHome.php');	
		//print_r($Err->messages);
		//$output['val']=$Err->values;
		//$output['msg']=$Err->messages;
		
		$chkuser=Core_CRoleChecking::checkRoles();
		
		if($chkuser)
		{
			$output['username']=Core_CAdminHome::userName();
			$output['currentDate']=date('l, M d, Y H:i:s');
			$output['currency_type']=$_SESSION['currency']['currency_tocken'];
			$output['taxsettings'] = Core_Settings_CTaxSettings::addCountrywiseTax($Err);
			Bin_Template::createTemplate('countrywisetaxentryajax.html',$output);
		}
		else
		{
		 	$output['usererr'] = 'You are Not having Privilege to view this page contact your Admin for detail';
			Bin_Template::createTemplate('Errors.html',$output);
		}
	}
	
	/**
	 * Function adds a new country wise tax list 
	 * 
	 * 
	 * @return array
	 */
	
	function insertCountrywiseTax()
	{	
		$output = array();

		include('classes/Lib/CheckInputs.php');
		include('classes/Core/CRoleChecking.php');
		include('classes/Core/Settings/CTaxSettings.php');
		include('classes/Display/DTaxSettings.php');

		$obj = new Lib_CheckInputs('regionwisetax');		
		
		$chkuser=Core_CRoleChecking::checkRoles();
		
		if($chkuser)
		{
			
			$_SESSION['rtsinsmsg'] = Core_Settings_CTaxSettings::insertCountrywiseTax();
			header("Location:?do=taxsettings&action=showregionwisetaxlist");
		}
		else
		{
		 	$output['usererr'] = 'You are Not having Privilege to view this page contact your Admin for detail';
			Bin_Template::createTemplate('Errors.html',$output);
		}
	
	}
	
	/**
	 * Function displays a template for the country wise tax list updation   
	 * 
	 * 
	 * @return array
	 */
	
	
	function editCountrywiseTax()
	{	
		$output = array();
		
		include('classes/Core/CRoleChecking.php');
		include('classes/Core/Settings/CTaxSettings.php');
		include('classes/Display/DTaxSettings.php');
		include("classes/Lib/HandleErrors.php");
		include('classes/Core/CAdminHome.php');	
		//print_r($Err->messages);
		//$output['val']=$Err->values;
		//$output['msg']=$Err->messages;
		
		$chkuser=Core_CRoleChecking::checkRoles();
		
		if($chkuser)
		{
			$output['username']=Core_CAdminHome::userName();
			$output['currentDate']=date('l, M d, Y H:i:s');
			$output['currency_type']=$_SESSION['currency']['currency_tocken'];
			$output['taxsettings'] = Core_Settings_CTaxSettings::editCountrywiseTax($Err);
			Bin_Template::createTemplate('countrywisetaxentryajax.html',$output);
		}
		else
		{
		 	$output['usererr'] = 'You are Not having Privilege to view this page contact your Admin for detail';
			Bin_Template::createTemplate('Errors.html',$output);
		}
	
	}
	
	/**
	 * Function updates the changes made in the country wise tax list 
	 * 
	 * 
	 * @return array
	 */
	
	function updateCountrywiseTax()
	{	
		$output = array();

		include('classes/Lib/CheckInputs.php');
		include('classes/Core/CRoleChecking.php');
		include('classes/Core/Settings/CTaxSettings.php');
		include('classes/Display/DTaxSettings.php');

		$obj = new Lib_CheckInputs('regionwisetaxedit');		
		
		$chkuser=Core_CRoleChecking::checkRoles();
		
		if($chkuser)
		{
			$_SESSION['rtsinsmsg'] = Core_Settings_CTaxSettings::updateCountrywiseTax();
			header("Location:?do=taxsettings&action=showregionwisetaxlist");
		}
		else
		{
		 	$output['usererr'] = 'You are Not having Privilege to view this page contact your Admin for detail';
			Bin_Template::createTemplate('Errors.html',$output);
		}
	}
	
	/**
	 * Function deletes the country wise tax list 
	 * 
	 * 
	 * @return array
	 */
	function deleteCountrywiseTax()
	{	
		$output = array();
		
		include('classes/Core/CRoleChecking.php');
		include('classes/Core/Settings/CTaxSettings.php');
		include('classes/Display/DTaxSettings.php');

		$chkuser=Core_CRoleChecking::checkRoles();
		
		if($chkuser)
		{
			$_SESSION['rtsinsmsg'] = Core_Settings_CTaxSettings::deleteCountrywiseTax();
			header("Location:?do=taxsettings&action=showregionwisetaxlist");
		}
		else
		{
		 	$output['usererr'] = 'You are Not having Privilege to view this page contact your Admin for detail';
			Bin_Template::createTemplate('Errors.html',$output);
		}
	}
}
?>