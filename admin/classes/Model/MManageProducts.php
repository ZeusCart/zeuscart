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
 * This class contains functions to add, edit and delete a new products
 *
 * @package  		Model_MManageProducts
 * @category  		Model
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
  * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */

class Model_MManageProducts
{
	/**
	 * Stores the output
	 *
	 * @var array $output
	 */	
	var $output = array();	
	
	/**
	 * Function displays the list of categories available 
	 * 
	 * 
	 * @return array
	 */
	
	function showCategory()
	{
		include('classes/Core/CRoleChecking.php');
		include_once('classes/Core/Settings/CManageProducts.php');
		include_once('classes/Display/DManageProducts.php');
		include('classes/Core/CAdminHome.php');
		
		$chkuser=Core_CRoleChecking::checkRoles();
		
		if($chkuser)
		{
		
			$default = new Core_Settings_CManageProducts();
			$output['updateproduct']=$_SESSION['update_msg'];
			$_SESSION['update_msg']='';

			$output['currentDate']=date('l, M d, Y H:i:s');
			$output['username']=Core_CAdminHome::userName();
			$output['allproducts']=$default->showAllProducts();
			Bin_Template::createTemplate('manageproducts.html',$output);	
		}
		else
		{
		 	$output['usererr'] = 'You are Not having Privilege to view this page contact your Admin for detail';
	
			Bin_Template::createTemplate('Errors.html',$output);
		}
	}
	
	/**
	 * Function displays the list of sub categories available 
	 * 
	 * 
	 * @return array
	 */
	
	function showSubCategory()
	{
        	include_once('classes/Core/Settings/CManageProducts.php');
		include_once('classes/Display/DManageProducts.php');	
		include('classes/Core/CAdminHome.php');
		$output['username']=Core_CAdminHome::userName();
		echo Core_Settings_CManageProducts::displaySubCategory($subcatid);	
		
	}
	
	/**
	 * Function displays the product 
	 * 
	 * 
	 * @return array
	 */
	function showProducts()
	{
	 	include('classes/Core/CRoleChecking.php');
		include_once('classes/Core/Settings/CAddCrossProducts.php');
		include_once('classes/Display/DAddCrossProducts.php');
		include('classes/Core/CAdminHome.php');
		$chkuser=Core_CRoleChecking::checkRoles();
		
		if($chkuser)
		{
			$default = new Core_Settings_CManageProducts();			
			$output['username']=Core_CAdminHome::userName();
			$output['currentDate']=date('l, M d, Y H:i:s');
			$output['products']=$default->showProducts();
		}
		else
		{
		 	$output['usererr'] = 'You are Not having Privilege to view this page contact your Admin for detail';
		
			Bin_Template::createTemplate('Errors.html',$output);
		}
				
	}
	
	
	/**
	 * Function displays the list of products available 
	 * 
	 * 
	 * @return array
	 */
	
	function showAllProducts()
	{
	 	include('classes/Core/CRoleChecking.php');
		include_once('classes/Core/Settings/CManageProducts.php');
		include_once('classes/Display/DManageProducts.php');
		include('classes/Core/CAdminHome.php');
		$chkuser=Core_CRoleChecking::checkRoles();
		
		if($chkuser)
		{
			$default = new Core_Settings_CManageProducts();
			$output['username']=Core_CAdminHome::userName();
			$output['currentDate']=date('l, M d, Y H:i:s');
			$output['allproducts']=$default->showAllProducts();
		
			Bin_Template::createTemplate('manageproducts.html',$output);	
		}
		else
		{
		 	$output['usererr'] = 'You are Not having Privilege to view this page contact your Admin for detail';
		
			Bin_Template::createTemplate('Errors.html',$output);
		}
	}
	
	/**
	 * Function updates a new product
	 * 
	 * 
	 * @return array
	 */
	function updateProducts()
	{
	  	include('classes/Core/CRoleChecking.php');
		include_once('classes/Core/Settings/CAddCrossProducts.php');
		include_once('classes/Display/DAddCrossProducts.php');		
		
		$chkuser=Core_CRoleChecking::checkRoles();
		
		if($chkuser)
		{
			$default = new Core_Settings_CManageProducts();
		
			$output['maincategory']=$default->displayCategory($id);
			$output['subcat']=$default->displaySubCategory($subcatid);
			$output['disptitle']=$default->dispProductTitle();
			$output['updatemsg']=$default->updateProducts();
		
			Bin_Template::createTemplate('editeproduct.html',$output);
		
		}
		else
		{
		 	$output['usererr'] = 'You are Not having Privilege to view this page contact your Admin for detail';
		
			Bin_Template::createTemplate('Errors.html',$output);
		}
	}
	
	
	/**
	 * Function deletes an existing product
	 * 
	 * 
	 * @return array
	 */
	
	
	function deleteProduct()
	{
		include('classes/Core/CRoleChecking.php');
		include_once('classes/Core/Settings/CManageProducts.php');
		include_once('classes/Display/DManageProducts.php');
		
		$chkuser=Core_CRoleChecking::checkRoles();
		if($chkuser)
		{
			$default = new Core_Settings_CManageProducts();		
			$default->deleteProduct();
		}
		else
		{
		 	$output['usererr'] = 'You are Not having Privilege to view this page contact your Admin for detail';
		
			Bin_Template::createTemplate('Errors.html',$output);
		}
	
	
	}
	/**
	 * Function displays a edit template for updating a product
	 * 
	 * 
	 * @return array
	 */

	function editProduct()
	{
		include('classes/Core/CRoleChecking.php');
		include_once('classes/Core/Settings/CManageProducts.php');
		include('classes/Core/CAdminHome.php');
		include('classes/Core/CProductEntry.php');
		include('classes/Display/DManageProducts.php');
		include('classes/Display/DProductEntry.php');	
		
		$chkuser=Core_CRoleChecking::checkRoles();
		
		if($chkuser)
		{
			$default = new Core_Settings_CManageProducts();
			
			$output['username']=Core_CAdminHome::userName();
			$output['currentDate']=date('l, M d, Y H:i:s');
			$output['dropcategory'] =$default->displayCategory($id);	
			$output['dispproduct']=$default->editProduct();
			
			
			$output['id']=$default->getId();
// 			$output['editMainCategory']=$default->editMainCategory();
// 			$output['editSubCategory']=$default->editSubCategory();
// 			$output['editSubUnderCategory']=$default->editSubUnderCategory();
			$output['editMainImage']=$default->editMainImage();
			/*$output['thumb_image_path']=$output['editMainImage']['thumb_image_path'];
			$output['product_images_id']=$output['editMainImage']['product_images_id'];*/
			$output['editImage']=$default->editImage();
			$output['editRelated']=$default->editRelated();
			$output['editAttributes']=$default->editAttributes();
			$output['editTierPrice']=$default->editTierPrice();
			$output['editVarition']=$default->editVariation();
			
			$output['editGeneral']=$default->editGeneral();
			$output['product_id']=$output['editGeneral']['product_id'];
			$output['category_id']=$output['editGeneral']['category_id'];
			$output['sku']=$output['editGeneral']['sku'];
			$output['product_title']=$output['editGeneral']['title'];
			$output['product_alias']=$output['editGeneral']['alias'];
			$output['description']=$output['editGeneral']['description'];			
			$output['brand']=$output['editGeneral']['brand'];
			$output['dispbrand']=Core_CProductEntry::dispBrand($output['brand']);

			$output['corbrand']=$default->corBrand($output['brand']);
			$output['model']=$output['editGeneral']['model'];
			
			$output['txtweight']=$output['editGeneral']['weight'];
			if(!empty($output['editGeneral']['dimension']))
				{
					$strdim=array();
					$strdim=explode('x',$output['editGeneral']['dimension']);
					$output['txtwidth']=trim($strdim[0]);
					$output['txtheight']=trim($strdim[1]);
					$output['txtdepth']=trim($strdim[2]);
				}
			
			$output['currencycode']=$_SESSION['currency']['currency_code'];	
			$output['msrp_org']=$output['editGeneral']['msrp'];
			$output['price']=$output['editGeneral']['price'];
			$output['thumb_image']=$output['editGeneral']['thumb_image'];
			$output['image']=$output['editGeneral']['image'];
			$output['shipcost']=$output['editGeneral']['shipping_cost'];
			$output['tag']=$output['editGeneral']['tag'];
			$output['intro_date']=$output['editGeneral']['intro_date'];
			$output['meta_desc']=$output['editGeneral']['meta_desc'];
			$output['meta_keywords']=$output['editGeneral']['meta_keywords'];
			$output['csekeyid']=$output['editGeneral']['cse_key'];
			if($output['editGeneral']['is_featured']==1)
				$output['is_featured']='checked="checked"';
			else
				$output['is_featured']='';

				
			if($output['editGeneral']['product_status']==1)
				$output['is_new_product']='checked="checked"';
			else
				$output['is_new_product']='';
			

			if($output['editGeneral']['product_status']==2)
				$output['is_discount_product']='checked="checked"';
			else
				$output['is_discount_product']='';
			
			if($output['editGeneral']['cse_enabled']==1)
			{
				$output['cse_enabled']='checked="checked"';
				
			}
			else
				$output['cse_enabled']='';
			
			if($output['editGeneral']['status']==1)
				$output['status']='checked="checked"';
			else
				$output['status']='';
			
			$output['editInventory']=$default->editInventory();
			$output['rol']=$output['editInventory']['rol'];
			$output['soh']=$output['editInventory']['soh'];
			
		//********************END**************************************************//
		
			
			Bin_Template::createTemplate('editproduct.html',$output);
		}
		else
		{
		 	$output['usererr'] = 'You are Not having Privilege to view this page contact your Admin for detail';
			
			Bin_Template::createTemplate('Errors.html',$output);
		}
	
	
	}
	
	/**
	 * Function displays a edit template for updating a digital product
	 * 
	 * 
	 * @return array
	 */
	function editDigitalProduct()
	{
		include('classes/Core/CRoleChecking.php');
		include_once('classes/Core/Settings/CManageProducts.php');
		include('classes/Core/CAdminHome.php');
		include('classes/Core/CProductEntry.php');
		include('classes/Display/DManageProducts.php');
		include('classes/Display/DProductEntry.php');	
		
		$chkuser=Core_CRoleChecking::checkRoles();
		
		if($chkuser)
		{
			$default = new Core_Settings_CManageProducts();
			
			$output['username']=Core_CAdminHome::userName();
			$output['currentDate']=date('l, M d, Y H:i:s');
			$output['dropcategory'] =$default->displayCategory($id);	
			$output['dispproduct']=$default->editProduct();
			
			
			$output['id']=$default->getId();
			$output['editMainCategory']=$default->editMainCategory();
			$output['editSubCategory']=$default->editSubCategory();
			$output['editSubUnderCategory']=$default->editSubUnderCategory();
			$output['editMainImage']=$default->editMainImage();
			/*$output['thumb_image_path']=$output['editMainImage']['thumb_image_path'];
			$output['product_images_id']=$output['editMainImage']['product_images_id'];*/
			$output['editImage']=$default->editImage();
			$output['editRelated']=$default->editRelated();
			$output['editAttributes']=$default->editAttributes();
			$output['editTierPrice']=$default->editTierPrice();
			
			
			$output['editGeneral']=$default->editGeneral();
			$output['product_id']=$output['editGeneral']['product_id'];
			$output['category_id']=$output['editGeneral']['category_id'];
			$output['sku']=$output['editGeneral']['sku'];
			$output['product_title']=$output['editGeneral']['title'];
			$output['description']=$output['editGeneral']['description'];
			$output['digitalfilepath']=$output['editGeneral']['digital_product_path'];
			
			$output['currencycode']=$_SESSION['currency']['currency_code'];	
			$output['msrp_org']=$output['editGeneral']['msrp'];
			$output['price']=$output['editGeneral']['price'];
			$output['thumb_image']=$output['editGeneral']['thumb_image'];
			$output['image']=$output['editGeneral']['image'];
			$output['shipcost']=$output['editGeneral']['shipping_cost'];
			$output['tag']=$output['editGeneral']['tag'];
			$output['intro_date']=$output['editGeneral']['intro_date'];
			$output['meta_desc']=$output['editGeneral']['meta_desc'];
			$output['meta_keywords']=$output['editGeneral']['meta_keywords'];
			$output['csekeyid']=$output['editGeneral']['cse_key'];
			if($output['editGeneral']['is_featured']==1)
				$output['is_featured']='checked="checked"';
			else
				$output['is_featured']='';

				
			if($output['editGeneral']['product_status']==1)
				$output['is_new_product']='checked="checked"';
			else
				$output['is_new_product']='';
			

			if($output['editGeneral']['product_status']==2)
				$output['is_discount_product']='checked="checked"';
			else
				$output['is_discount_product']='';
			
			
			
			if($output['editGeneral']['status']==1)
				$output['status']='checked="checked"';
			else
				$output['status']='';
			

			
			Bin_Template::createTemplate('digitaleditproduct.html',$output);
		}
		else
		{
		 	$output['usererr'] = 'You are Not having Privilege to view this page contact your Admin for detail';
			
			Bin_Template::createTemplate('Errors.html',$output);
		}
	
	
	}

	/**
	 * Function displays a edit template for updating a gift product
	 * 
	 * 
	 * @return array
	 */
	function editGiftProduct()
	{
		include('classes/Core/CRoleChecking.php');
		include_once('classes/Core/Settings/CManageProducts.php');
		include('classes/Core/CAdminHome.php');
		include('classes/Core/CProductEntry.php');
		include('classes/Display/DManageProducts.php');
		include('classes/Display/DProductEntry.php');	
		
		$chkuser=Core_CRoleChecking::checkRoles();
		
		if($chkuser)
		{
			$default = new Core_Settings_CManageProducts();
			
			$output['username']=Core_CAdminHome::userName();
			$output['currentDate']=date('l, M d, Y H:i:s');
			$output['dropcategory'] =$default->displayCategory($id);	
			$output['dispproduct']=$default->editProduct();
			
			
			$output['id']=$default->getId();
			$output['editMainCategory']=$default->editMainCategory();
			$output['editSubCategory']=$default->editSubCategory();
			$output['editSubUnderCategory']=$default->editSubUnderCategory();
			$output['editMainImage']=$default->editMainImage();
			/*$output['thumb_image_path']=$output['editMainImage']['thumb_image_path'];
			$output['product_images_id']=$output['editMainImage']['product_images_id'];*/
			$output['editImage']=$default->editImage();
			$output['editRelated']=$default->editRelated();
			$output['editAttributes']=$default->editAttributes();
			$output['editTierPrice']=$default->editTierPrice();
			
			
			$output['editGeneral']=$default->editGeneral();
			$output['product_id']=$output['editGeneral']['product_id'];
			$output['category_id']=$output['editGeneral']['category_id'];
			$output['sku']=$output['editGeneral']['sku'];
			$output['product_title']=$output['editGeneral']['title'];
			$output['description']=$output['editGeneral']['description'];
			
			
			$output['currencycode']=$_SESSION['currency']['currency_code'];	
			$output['msrp_org']=$output['editGeneral']['msrp'];
			$output['price']=$output['editGeneral']['price'];
			$output['thumb_image']=$output['editGeneral']['thumb_image'];
			$output['image']=$output['editGeneral']['image'];
			$output['shipcost']=$output['editGeneral']['shipping_cost'];
			$output['tag']=$output['editGeneral']['tag'];
			$output['intro_date']=$output['editGeneral']['intro_date'];
			$output['meta_desc']=$output['editGeneral']['meta_desc'];
			$output['meta_keywords']=$output['editGeneral']['meta_keywords'];
			
			if($output['editGeneral']['is_featured']==1)
				$output['is_featured']='checked="checked"';
			else
				$output['is_featured']='';

				
			if($output['editGeneral']['product_status']==1)
				$output['is_new_product']='checked="checked"';
			else
				$output['is_new_product']='';
			

			if($output['editGeneral']['product_status']==2)
				$output['is_discount_product']='checked="checked"';
			else
				$output['is_discount_product']='';
			
			
			
			if($output['editGeneral']['status']==1)
				$output['status']='checked="checked"';
			else
				$output['status']='';
			

			
			Bin_Template::createTemplate('gifteditproduct.html',$output);
		}
		else
		{
		 	$output['usererr'] = 'You are Not having Privilege to view this page contact your Admin for detail';
			
			Bin_Template::createTemplate('Errors.html',$output);
		}
	
	
	}
	/**
	 * Function displays a search list for the existing products 
	 * 
	 * 
	 * @return array
	 */
	
	
	
	function searchProductDetails()
	{

		include_once('classes/Core/Settings/CManageProducts.php');
		include_once('classes/Display/DManageProducts.php');
		include('classes/Core/CAdminHome.php');
		$default = new Core_Settings_CManageProducts();
		
		$output['searchproduct']=$default->searchProductDetails();
		$output['username']=Core_CAdminHome::userName();
		$output['currentDate']=date('l, M d, Y H:i:s');
		Bin_Template::createTemplate('manageproducts.html',$output);
	}
	
	/**
	 * Function updates a product
	 * 
	 * 
	 * @return array
	 */

	function updateProduct()
	{
		include("classes/Lib/CheckInputs.php");
		include('classes/Core/CRoleChecking.php');
		include('classes/Core/Settings/CManageProducts.php');
		include('classes/Core/CAdminHome.php');
		include('classes/Display/DManageProducts.php');
		
		//$obj = new Lib_CheckInputs('productupdate');
		
		$chkuser=Core_CRoleChecking::checkRoles();
		
		if($chkuser)
		{
			$default = new Core_Settings_CManageProducts();
			$_SESSION['update_msg']=$default->updateProduct();

			header('Location:?do=manageproducts');
		}
		else
		{
		 	$output['usererr'] = 'You are Not having Privilege to view this page contact your Admin for detail';
		
			Bin_Template::createTemplate('Errors.html',$output);
		}
	
	
	}
	/**
	 * Function updates a digital product
	 * 
	 * 
	 * @return array
	 */

	function updateDigitalProduct()
	{
		include("classes/Lib/CheckInputs.php");
		include('classes/Core/CRoleChecking.php');
		include('classes/Core/Settings/CManageProducts.php');
		include('classes/Core/CAdminHome.php');
		include('classes/Display/DManageProducts.php');
		
		//$obj = new Lib_CheckInputs('productupdate');
		
		$chkuser=Core_CRoleChecking::checkRoles();
		
		if($chkuser)
		{

			$default = new Core_Settings_CManageProducts();
		
			$_SESSION['update_msg']=$default->updateDigitalProduct();	
			header('Location:?do=manageproducts');
		}
		else
		{
		 	$output['usererr'] = 'You are Not having Privilege to view this page contact your Admin for detail';
		
			Bin_Template::createTemplate('Errors.html',$output);
		}
	
	
	}

	/**
	 * Function updates a gift product
	 * 
	 * 
	 * @return array
	 */

	function updateGiftProduct()
	{
		include("classes/Lib/CheckInputs.php");
		include('classes/Core/CRoleChecking.php');
		include('classes/Core/Settings/CManageProducts.php');
		include('classes/Core/CAdminHome.php');
		include('classes/Display/DManageProducts.php');
		
		//$obj = new Lib_CheckInputs('productupdate');
		
		$chkuser=Core_CRoleChecking::checkRoles();
		
		if($chkuser)
		{
			$default = new Core_Settings_CManageProducts();
		
			$_SESSION['update_msg']=$default->updateGiftProduct();	
			header('Location:?do=manageproducts');
		}
		else
		{
		 	$output['usererr'] = 'You are Not having Privilege to view this page contact your Admin for detail';
		
			Bin_Template::createTemplate('Errors.html',$output);
		}
	
	
	}
	/**
	 * Function gets the title for the selected product
	 * 
	 * 
	 * @return array
	 */
	
	
	
	function getTitle()
	{	
		include('classes/Core/Settings/CManageProducts.php');
		include('classes/Display/DManageProducts.php');
		$default = new Core_Settings_CManageProducts();
		$output['title']=$default->getTitle();
		
	}
	
	
	/**
	 * Function displays an popup window at the admin side for selecting the search keywords.  
	 * 
	 * 
	 * @return array
	 */	
	 	 
	function autoComplete()
	{
		include('classes/Core/Settings/CManageProducts.php');
		$default = new Core_Settings_CManageProducts();
		$output['title']=$default->autoComplete();
		//Bin_Template::createTemplate('autocomplete.html',$output);
	}
	/**
	 * Function is used to check the product alias  
	 * 
	 * 
	 * @return array
	 */	
	 
	function checkProductAlias()
	{

		include('classes/Core/Settings/CManageProducts.php');
		echo Core_Settings_CManageProducts::checkProductAlias();
	}
	/**
	 * Function is used to check the product sku  
	 * 
	 * 
	 * @return array
	 */	
	function checkProductSku()
	{

		include('classes/Core/Settings/CManageProducts.php');
		echo Core_Settings_CManageProducts::checkProductSku();
	}
}	
?>