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
 * This class contains functions to add new product 
 *
 * @package  		Model_MProductEntry
 * @category  		Model
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
  * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */

class Model_MProductEntry
{
	/**
	 * Stores the output
	 *
	 * @var array $output
	 */	
	var $output = array();	
	
	/**
	 * Function displays a template for adding new product 
	 * 
	 * 
	 * @return array
	 */
	
	
	function displayEntry()
	{
		include("classes/Lib/HandleErrors.php");
		include('classes/Core/CRoleChecking.php');
		include('classes/Core/CProductEntry.php');
		include('classes/Core/CAdminHome.php');
		include('classes/Display/DProductEntry.php');	
		
		$output['val']=$Err->values;
		$output['msg']=$Err->messages;
		
		$output['val']=Core_CProductEntry::stripSlashesForOut($output['val']);
		$output['val']=Core_CProductEntry::getChecked($output['val']);
	
		$output['username']=Core_CAdminHome::userName();
		
		$output['currentDate']=date('l, M d, Y H:i:s');		
		$output['currency_type']=$_SESSION['currency']['currency_tocken'];		
		$output['currencycode']=$_SESSION['currency']['currency_code'];	
		$output['dispbrand']=Core_CProductEntry::dispBrand($output['val']['selbrand']);
		$output['dropcategory'] =Core_CProductEntry::displayCategory($output['val']['selcatgory']);	
		$output['addmoremsrp'] =Core_CProductEntry::addMoreMsrpLink();  
		$output['allproducts']=Core_CProductEntry::showProducts();
		
		$chkuser=Core_CRoleChecking::checkRoles();
		
		if($chkuser)
		{				
			Bin_Template::createTemplate('ProductEntry.html',$output);
		}
		else
		{
		   	$output['usererr'] = 'You are Not having Privilege to view this page contact your Admin for detail';
		
			Bin_Template::createTemplate('Errors.html',$output);
		}	

	}	
	
	/**
	 * Function adds or inserts a new product  
	 * 
	 * 
	 * @return array
	 */
	
	

	function insertProduct()
	{

		include("classes/Lib/CheckInputs.php");
		include('classes/Core/CRoleChecking.php');
		include('classes/Core/CProductEntry.php');
		include('classes/Core/CAdminHome.php');
		include('classes/Display/DProductEntry.php');		
		
		//$obj = new Lib_CheckInputs('productreg');
		
		$output['val']=$Err->values;
		$output['msg']=$Err->messages;
		$output['username']=Core_CAdminHome::userName();
		$output['currentDate']=date('l, M d, Y H:i:s');	
		$output['currency_type']=$_SESSION['currency']['currency_tocken'];		
		$chkuser=Core_CRoleChecking::checkRoles();
		
		if($chkuser)
		{	
			$output['message']=Core_CProductEntry::insertProduct();
			$output['dispbrand']=Core_CProductEntry::dispBrand();
			$output['dropcategory'] =Core_CProductEntry::displayCategory();	
			$output['addmoremsrp'] =Core_CProductEntry::addMoreMsrpLink();  
			$output['allproducts']=Core_CProductEntry::showProducts();
			
			Bin_Template::createTemplate('ProductEntry.html',$output);
			
		}
		else
		{
			$output['usererr'] = 'You are Not having Privilege to view this page contact your Admin for detail';
			
			Bin_Template::createTemplate('Errors.html',$output);
		}

	}	
	
	/**
	 * Function  updates the new product with there msrp and quantity
	 * 
	 * 
	 * @return array
	 */
	
	
	function insertMsrpByQuantity()
	{
		include('classes/Core/CRoleChecking.php');
		include('classes/Core/CProductEntry.php');
		include('classes/Display/DProductEntry.php');	
		
		$chkuser=Core_CRoleChecking::checkRoles();
		
		if($chkuser)
		{	
			Bin_Template::createTemplate('ProductEntry.html',$output);		
		}
		else
		{
			$output['usererr'] = 'You are Not having Privilege to view this page contact your Admin for detail';
			
			Bin_Template::createTemplate('Errors.html',$output);
		}
	}
	
	
	/**
	 * Function displays the new product with there msrp and quantity
	 * 
	 * 
	 * @return array
	 */
	
	function displayMsrpByQuantity()
	{
		include('classes/Core/CRoleChecking.php');
		include('classes/Core/CProductEntry.php');
		include('classes/Display/DProductEntry.php');
		
		$chkuser=Core_CRoleChecking::checkRoles();
		
		if($chkuser)
		{		
			$output['area1'] =   Core_CProductEntry::insertProduct();	
		
			Bin_Template::createTemplate('ProductEntry.html',$output);
		}
		else
		{
			$output['usererr'] = 'You are Not having Privilege to view this page contact your Admin for detail';
			
			Bin_Template::createTemplate('Errors.html',$output);
		}
	}
	
	
	/**
	 * Function  displays the sub categories for the selected category
	 * 
	 * 
	 * @return array
	 */
	
	function displaySubCategory()
	{
	
		include('classes/Core/CProductEntry.php');
		include('classes/Display/DProductEntry.php');		
		
		$id=$_GET['id'];
		echo Core_CProductEntry::displaySubCategory($id);	
		
	}
	/**
	 * Function  displays the sub categories for the selected category
	 * 
	 * 
	 * @return array
	 */
	
	function displaySubUnderCategory()
	{
		

		include('classes/Core/CProductEntry.php');
		include('classes/Display/DProductEntry.php');		
		
		$id=$_GET['id'];
		echo Core_CProductEntry::displaySubUnderCategory($id);	
		
	}

	/**
	 * Function  displays the product attributes if any
	 * 
	 * 
	 * @return array
	 */
	
	function displayAttributes()
	{
		include('classes/Core/CProductEntry.php');
		include('classes/Display/DProductEntry.php');		
	
		echo Core_CProductEntry::displayAttributes();	
		
	}
	
	
	/**
	 * Function  displays the releated products 
	 * 
	 * 
	 * @return array
	 */
	
	function searchProducts()
	{
		include('classes/Core/CProductEntry.php');
		include('classes/Display/DProductEntry.php');		

		echo Core_CProductEntry::searchProducts();	
	}
		
	/**
	 * Function displays a template for adding new digital product 
	 * 
	 * 
	 * @return array
	 */
	function displayForDigitalEntry()
	{

		include("classes/Lib/HandleErrors.php");
		include('classes/Core/CRoleChecking.php');
		include('classes/Core/CProductEntry.php');
		include('classes/Core/CAdminHome.php');
		include('classes/Display/DProductEntry.php');	
		
		$output['val']=$Err->values;
		$output['msg']=$Err->messages;

		$output['val']=Core_CProductEntry::stripSlashesForOut($output['val']);
		$output['val']=Core_CProductEntry::getChecked($output['val']);
	
		$output['username']=Core_CAdminHome::userName();
		
		$output['currentDate']=date('l, M d, Y H:i:s');		
		$output['currency_type']=$_SESSION['currency']['currency_tocken'];		
		$output['currencycode']=$_SESSION['currency']['currency_code'];	
		$output['dispbrand']=Core_CProductEntry::dispBrand($output['val']['selbrand']);
		$output['dropcategory'] =Core_CProductEntry::displayCategory($output['val']['selcatgory']);	
		$output['addmoremsrp'] =Core_CProductEntry::addMoreMsrpLink();  
		$output['allproducts']=Core_CProductEntry::showProducts();
		
		$chkuser=Core_CRoleChecking::checkRoles();
		
		if($chkuser)
		{				
			Bin_Template::createTemplate('digitproductentry.html',$output);
		}
		else
		{
		   	$output['usererr'] = 'You are Not having Privilege to view this page contact your Admin for detail';
		
			Bin_Template::createTemplate('Errors.html',$output);
		}	

	}	
	/**
	 * Function adds or inserts a new digitalproduct  
	 * 
	 * 
	 * @return array
	 */
	function insertDigitalProduct()
	{ 
		
		include("classes/Lib/CheckInputs.php");
		include('classes/Core/CRoleChecking.php');
		include('classes/Core/CProductEntry.php');
		include('classes/Core/CAdminHome.php');
		include('classes/Display/DProductEntry.php');		
		
		//$obj = new Lib_CheckInputs('digitalproductreg');
		
		$output['val']=$Err->values;
		$output['msg']=$Err->messages;
		$output['username']=Core_CAdminHome::userName();
		$output['currentDate']=date('l, M d, Y H:i:s');	
		$output['currency_type']=$_SESSION['currency']['currency_tocken'];		
		$chkuser=Core_CRoleChecking::checkRoles();
		
		if($chkuser)
		{	
			$output['message']=Core_CProductEntry::insertDigitalProduct();
			$output['dispbrand']=Core_CProductEntry::dispBrand();
			$output['dropcategory'] =Core_CProductEntry::displayCategory();	
			$output['addmoremsrp'] =Core_CProductEntry::addMoreMsrpLink();  
			$output['allproducts']=Core_CProductEntry::showProducts();
			
			Bin_Template::createTemplate('digitproductentry.html',$output);
			
		}
		else
		{
			$output['usererr'] = 'You are Not having Privilege to view this page contact your Admin for detail';
			
			Bin_Template::createTemplate('Errors.html',$output);
		}


	}

	/**
	 * Function displays a template for adding new gift product 
	 * 
	 * 
	 * @return array
	 */
	function displayForGiftEntry()
	{

		include("classes/Lib/HandleErrors.php");
		include('classes/Core/CRoleChecking.php');
		include('classes/Core/CProductEntry.php');
		include('classes/Core/CAdminHome.php');
		include('classes/Display/DProductEntry.php');	
		
		$output['val']=$Err->values;
		$output['msg']=$Err->messages;

		$output['val']=Core_CProductEntry::stripSlashesForOut($output['val']);
		$output['val']=Core_CProductEntry::getChecked($output['val']);
	
		$output['username']=Core_CAdminHome::userName();
		
		$output['currentDate']=date('l, M d, Y H:i:s');		
		$output['currency_type']=$_SESSION['currency']['currency_tocken'];		
		$output['currencycode']=$_SESSION['currency']['currency_code'];	
		$output['dispbrand']=Core_CProductEntry::dispBrand($output['val']['selbrand']);
		$output['dropcategory'] =Core_CProductEntry::displayCategory($output['val']['selcatgory']);	
		$output['addmoremsrp'] =Core_CProductEntry::addMoreMsrpLink();  
		$output['allproducts']=Core_CProductEntry::showProducts();
		
		$chkuser=Core_CRoleChecking::checkRoles();
		
		if($chkuser)
		{				
			Bin_Template::createTemplate('giftproductentry.html',$output);
		}
		else
		{
		   	$output['usererr'] = 'You are Not having Privilege to view this page contact your Admin for detail';
		
			Bin_Template::createTemplate('Errors.html',$output);
		}	

	}
	/**
	 * Function adds or inserts a new giftproduct  
	 * 
	 * 
	 * @return array
	 */
	function insertGiftProduct()
	{ 
		
		include("classes/Lib/CheckInputs.php");
		include('classes/Core/CRoleChecking.php');
		include('classes/Core/CProductEntry.php');
		include('classes/Core/CAdminHome.php');
		include('classes/Display/DProductEntry.php');		
		
		//$obj = new Lib_CheckInputs('giftproductreg');
		
		$output['val']=$Err->values;
		$output['msg']=$Err->messages;
		$output['username']=Core_CAdminHome::userName();
		$output['currentDate']=date('l, M d, Y H:i:s');	
		$output['currency_type']=$_SESSION['currency']['currency_tocken'];		
		$chkuser=Core_CRoleChecking::checkRoles();
		
		if($chkuser)
		{	
			$output['message']=Core_CProductEntry::insertGiftProduct();
			$output['dispbrand']=Core_CProductEntry::dispBrand();
			$output['dropcategory'] =Core_CProductEntry::displayCategory();	
			$output['addmoremsrp'] =Core_CProductEntry::addMoreMsrpLink();  
			$output['allproducts']=Core_CProductEntry::showProducts();
			
			Bin_Template::createTemplate('giftproductentry.html',$output);
			
		}
		else
		{
			$output['usererr'] = 'You are Not having Privilege to view this page contact your Admin for detail';
			
			Bin_Template::createTemplate('Errors.html',$output);
		}


	}
		
	/**
	 * Function is used to check the product alias  
	 * 
	 * 
	 * @return array
	 */	
	 
	function checkProductAlias()
	{

		include('classes/Core/CProductEntry.php');
		echo Core_CProductEntry::checkProductAlias();
	}
	/**
	 * Function is used to check the product sku  
	 * 
	 * 
	 * @return array
	 */	
	function checkProductSku()
	{
		include('classes/Core/CProductEntry.php');
		echo Core_CProductEntry::checkProductSku();
	}
}
?>