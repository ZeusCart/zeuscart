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
 * This class contains functions to display the product registration
 *
 * @package  		Model_MProductRegistration
 * @category  		Model
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
  * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */

class Model_MProductRegistration
{
	/**
	 * Stores the output
	 *
	 * @var array $output
	 */	
	 
	var $output = array();
	/*
	function showRegPage()
	{
		include('classes/Lib/CheckInputs.php');
		$obj = new Lib_CheckInputs('register');
		include('classes/Core/CProductRegistration.php');
		$output['account'] = Core_CRegsitration::addAccount();
		Bin_Template::createTemplate('UserRegistration.html',$output);
	}
	
	function showLoginPage()
	{
		include('classes/Core/CLogin.php');
		$output['login'] = Core_CLogin::userLogin();
		Bin_Template::createTemplate('ProductRegistration.html',$output);
	}*/
	
	/**
	 * Function displays the product registration page
	 * 
	 * 
	 * @return array
	 */
	
	function showProductRegPage()
	{
		include('classes/Core/CProductRegistration.php');
 	    include('classes/Core/Category/CCategory.php');
		$output['category'] = Core_Category_CCategory::showCat();				
		
		Bin_Template::createTemplate('ProductRegistration.html',$output);
	}
	/**
	 * Function displays the load sub categoried
	 * 
	 * 
	 * @return array
	 */
	function loadSubCategories()
	{
 	   
		include('classes/Core/Category/CCategory.php');
		include('classes/Display/DCategory.php');
		$subcats = Core_Category_CCategory::getSubCategory();	
		echo $output['subcategories']= Display_DCategory::loadSubCategories($subcats);
	
	}
	/**
	 * Function is used to insert product
	 * 
	 * 
	 * @return array
	 */
	function insertProducts()
	{
	 include('classes/Core/Category/CCategory.php');
	 include('classes/Display/DCategory.php');
	 $output['product']=Core_CProductRegistration::insertRegistration();
	  header("Location:?do=productreg");
	  exit;
	}
	
	
}
?>