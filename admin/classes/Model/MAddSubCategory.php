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
 *  This class contains functions to view, add, edit and delete sub categories at the admin side.
 *
 * @package  		Model_MAddSubCategory
 * @category  		Model
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
  * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */

class Model_MAddSubCategory
{

	/**
	 * Function displays the Sub Categories avaliable in the site     
	 * 
	 * 
	 * @return array
	 */


	function showCat()
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
			include('classes/Core/Category/CCategory.php');
			$default=new Core_Category_CCategory();
			$default->showCat();
			include("classes/Core/Settings/CAddSubCategory.php");
			$default = new Core_Settings_CAddSubCategory();
			$default->showSubCategory($Err);
			include("templates/addsubcategory.php");
		}
		else
		{
		 	$output['usererr'] = 'You are Not having Privilege to view this page contact your Admin for detail';
			Bin_Template::createTemplate('Errors.html',$output);
		}

	}
	/**
	 * Function displays the Sub Categories      
	 * 
	 * 
	 * @return void
	 */
	function showSubCategory()
	{
		/*include("classes/Core/Settings/CAddSubCategory.php");
		$default = new Core_Settings_CAddSubCategory();
		$default->showSubCategory($Err);*/
		//$template = "createcategory.php";
		//include("templates/addsubcategory.php");
		
	}
	
	/**
	 * Function is used to add a new Sub Category From the admin side     
	 * 
	 * 
	 * @return array
	 */
	
	
	function addSubCategory()
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
			include("classes/Core/Settings/CAddSubCategory.php");
			//new Lib_CheckInputs('createcategory');
			$default = new Core_Settings_CAddSubCategory();
			$default->addSubCategory();
			header("Location:?do=addsubcategory");
			exit;
		}
		else
		{
		 	$output['usererr'] = 'You are Not having Privilege to view this page contact your Admin for detail';
			Bin_Template::createTemplate('Errors.html',$output);
		}
					
	}	
	
	
	/**
	 * Function displays the Sub Categories avaliable in the site     
	 * 
	 * 
	 * @return array
	 */
	
	function displaySubCategory()
	{
		include('classes/Core/CRoleChecking.php');
		$chkuser=Core_CRoleChecking::checkRoles();
		if($chkuser)
		{
			include("classes/Core/Settings/CAddSubCategory.php");
			//new Lib_CheckInputs('createcategory');
			$default = new Core_Settings_CAddSubCategory();
			$default->displaySubCategory();
			include("templates/editsubcategory.php");
			//header("Location:?do=addmaincategory");
		}
		else
		{
		 	$output['usererr'] = 'You are Not having Privilege to view this page contact your Admin for detail';
			Bin_Template::createTemplate('Errors.html',$output);
		}			
	}	
	
	
	/**
	 * Function is used to update the changes made in a Sub Category     
	 * from admin side
	 * 
	 * @return array
	 */
	
	function editSubCategory()
	{
		include('classes/Core/CRoleChecking.php');
		$chkuser=Core_CRoleChecking::checkRoles();
		if($chkuser)
		{
			include("classes/Core/Settings/CAddSubCategory.php");
			//new Lib_CheckInputs('createcategory');
			$default = new Core_Settings_CAddSubCategory();			
			$default->editSubCategory();			
			//include("templates/editmaincategory.php");
			//header("Location:?do=addsubcategory");
			//exit;
		}
		else
		{
		 	$output['usererr'] = 'You are Not having Privilege to view this page contact your Admin for detail';
			Bin_Template::createTemplate('Errors.html',$output);
		}			
	}	 
	
	/**
	 * Function is used to delete a Sub Category     
	 * from admin side
	 * 
	 * @return array
	 */
	
	
	function deleteSubCategory()
	{
		include('classes/Core/CRoleChecking.php');
		$chkuser=Core_CRoleChecking::checkRoles();
		if($chkuser)
		{
			include("classes/Core/Settings/CAddSubCategory.php");
			//new Lib_CheckInputs('createcategory');
			$default = new Core_Settings_CAddSubCategory();
			$default->deleteSubCategory();
			header("Location:?do=addsubcategory");
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