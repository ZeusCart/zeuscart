<?php
/**
* GNU General Public License.

* This file is part of ZeusCart V2.3.

* ZeusCart V2.3 is free software: you can redistribute it and/or modify
* it under the terms of the GNU General Public License as published by
* the Free Software Foundation, either version 3 of the License, or
* (at your option) any later version.
* 
* ZeusCart V2.3 is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
* GNU General Public License for more details.
* 
* You should have received a copy of the GNU General Public License
* along with Foobar. If not, see <http://www.gnu.org/licenses/>.
*
*/

/**
 * MProductRegistration
 *
 * 
 * @package		Model_MProductRegistration
 * @category	Model
 * @author		ZeusCart Team
 * @link		http://www.zeuscart.com
 * @version 	2.3
 */

// ------------------------------------------------------------------------


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
	
	function showProductRegPage()
	{
		include('classes/Core/CProductRegistration.php');
 	    include('classes/Core/Category/CCategory.php');
		$output['category'] = Core_Category_CCategory::showCat();				
//		$output['subcategory'] = Core_Category_CCategory::showSubCat();				
		Bin_Template::createTemplate('ProductRegistration.html',$output);
	}
	
	function loadSubCategories()
	{
 	   
		include('classes/Core/Category/CCategory.php');
		include('classes/Display/DCategory.php');
		$subcats = Core_Category_CCategory::getSubCategory();	
		echo $output['subcategories']= Display_DCategory::loadSubCategories($subcats);
	
	}
	
	function insertProducts()
	{
	 include('classes/Core/Category/CCategory.php');
	 include('classes/Display/DCategory.php');
	 $output['product']=Core_CProductRegistration::insertRegistration();
	  header("Location:?do=productreg");
	  exit;
	}
	


	/*function showCategory()
	{
	   include('classes/Core/CCategory.php');
   	   $output['category'] =   Core_Category_CCategory::getListValues();				
	}*/
	
}
?>