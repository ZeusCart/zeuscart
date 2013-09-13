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
 * This class contains functions to view, add, edit and delete main categories at the admin side.
 *
 * @package  		Model_MAddMainCategory
 * @category  		Model
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
  * @copyright 		Copyright (c) 2008 - 2013, AjSquare,Inc.
 * @version  		Version 4.0
 */
class Model_MAddMainCategory
{

	/**
	 * Function displays the Categories avaliable in the site     
	 * 
	 * 
	 * @return array
	 */


	function showMainCategory()
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
		if($chkuser)
		{
				include("classes/Core/Settings/CAddMainCategory.php");
				$default = new Core_Settings_CAddMainCategory();
				$default->showMainCategory($Err);
				//$template = "createcategory.php";
				include("templates/addmaincategory.php");
		}
		else
		{
		 	$output['usererr'] = 'You are Not having Privilege to view this page contact your Admin for detail';
			Bin_Template::createTemplate('Errors.html',$output);
		}
		
	}
	
	/**
	 * Function used to add a New Category Value from  admin side  
	 * 
	 * 
	 * @return array
	 */
	
	
	function addMainCategory()
	{
		include('classes/Core/CRoleChecking.php');
		$chkuser=Core_CRoleChecking::checkRoles();
		if($chkuser)
		{
			include("classes/Core/Settings/CAddMainCategory.php");
					
			$default = new Core_Settings_CAddMainCategory();
			$default->addMainCategory();
			header("Location:?do=addmaincategory");
			exit;	
		}
		else
		{
		 	$output['usererr'] = 'You are Not having Privilege to view this page contact your Admin for detail';
			Bin_Template::createTemplate('Errors.html',$output);
		}		
	}	
	
	/**
	 * Function displays a existing Category for updating the changes 
	 * 
	 * 
	 * @return array
	 */
	
	
	function displayMainCategory()
	{
		include('classes/Core/CRoleChecking.php');
		$chkuser=Core_CRoleChecking::checkRoles();
		if($chkuser)
		{
			include("classes/Core/Settings/CAddMainCategory.php");
			//new Lib_CheckInputs('createcategory');
			$default = new Core_Settings_CAddMainCategory();
			$default->displayMainCategory();
			include("templates/editmaincategory.php");
			//header("Location:?do=addmaincategory");
		}
		else
		{
		 	$output['usererr'] = 'You are Not having Privilege to view this page contact your Admin for detail';
			Bin_Template::createTemplate('Errors.html',$output);
		}	
					
	}	
	
	/**
	 * Function updates the data in the database for an existing Category 
	 * 
	 * 
	 * @return array
	 */

	function editMainCategory()
	{
		include('classes/Core/CRoleChecking.php');
		$chkuser=Core_CRoleChecking::checkRoles();
		if($chkuser)
		{
			include("classes/Core/Settings/CAddMainCategory.php");
			//new Lib_CheckInputs('createcategory');
			$default = new Core_Settings_CAddMainCategory();			
			$default->editMainCategory();			
			//include("templates/editmaincategory.php");
			header("Location:?do=addmaincategory");
			exit;				
		}
		else
		{
		 	$output['usererr'] = 'You are Not having Privilege to view this page contact your Admin for detail';
			Bin_Template::createTemplate('Errors.html',$output);
		}	
					
	}	 
	
	/**
	 * Function deletes an existing Category from the database  
	 * 
	 * 
	 * @return array
	 */
	function deleteMainCategory()
	{
		include('classes/Core/CRoleChecking.php');
		$chkuser=Core_CRoleChecking::checkRoles();
		if($chkuser)
		{
			include("classes/Core/Settings/CAddMainCategory.php");
			//new Lib_CheckInputs('createcategory');
			$default = new Core_Settings_CAddMainCategory();
			$default->deleteMainCategory();
			header("Location:?do=addmaincategory");
			exit;	
		}
		else
		{
		 	$output['usererr'] = 'You are Not having Privilege to view this page contact your Admin for detail';
			Bin_Template::createTemplate('Errors.html',$output);
		}			
	}	
	
}
?>