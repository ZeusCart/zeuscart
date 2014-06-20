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
 * Product details related  class
 *
 * @package   		Model_MProductDetail
 * @category    	Model
 * @author    		AJ Square Inc Dev Team
 * @link   		http://www.zeuscart.com
  * @copyright 	        Copyright (c) 2008 - 2013, AJ Square, Inc.
 * @version   		Version 4.0
 */
class Model_MProductDetail
{
	/**
	 * Stores the output 
	 *
	 * @var array 
	 */	
	var $output = array();

	/**
	* This function is constructor of this class
 	*
 	* @return string
	*/
	function Model_MProductDetail()
	{
	        include_once('classes/Core/CLanguage.php');
		include_once('classes/Core/CAddCart.php');	
		include('classes/Core/CHome.php');	
		include_once('classes/Core/CLastViewedProducts.php');
		include('classes/Core/CKeywordSearch.php');	
		include('classes/Core/CUserRegistration.php');	
		include_once('classes/Core/CCurrencySettings.php');
		include_once('classes/Core/CFeaturedItems.php');
		include('classes/Core/CWishList.php');	
		include('classes/Core/CNewProducts.php');
		include('classes/Core/CTagClouds.php');
		include('classes/Core/CNews.php');
		include('classes/Core/CProductDetail.php');
		include('classes/Core/CUserDashboard.php');

		//Display files
		Core_CLanguage::setDisplay('DAddCart.php');		
		Core_CLanguage::setDisplay('DHome.php');
		Core_CLanguage::setDisplay('DLastViewedProducts.php');
		Core_CLanguage::setDisplay('DKeywordSearch.php');
		Core_CLanguage::setDisplay('DUserRegistration.php');
		Core_CLanguage::setDisplay('DUserAccount.php');
		Core_CLanguage::setDisplay('DFeaturedItems.php');
		Core_CLanguage::setDisplay('DWishList.php');
		Core_CLanguage::setDisplay('DNewProducts.php');
		Core_CLanguage::setDisplay('DNews.php');
		Core_CLanguage::setDisplay('DProductDetail.php');

	}

	/**
	* This function is used to Display the product page
 	*
 	* @return string
	*/
	function showProducts()
	{

		//language	
		Core_CLanguage::setLanguage('PRODUCT_DETAILS');
		
		$_SESSION['url']=$_GET['do'];

		Core_CCurrencySettings::getDefaultCurrency();
		
		$output['tagClouds']=Core_CTagClouds::displayTagClouds();		
		$default=new Core_CProductDetail();
		$output['products']=$default->showProducts();
		Bin_Template::createTemplate('products.html',$output);
	}
	
	/**
	* This function is used to Display the last view viewed product page
 	*
 	* @return string
	*/
	function lastViewedProducts()
	{
		//language	
		Core_CLanguage::setLanguage('PRODUCT_DETAILS');


		Core_CCurrencySettings::getDefaultCurrency();
		
		$output['tagClouds']=Core_CTagClouds::displayTagClouds();		
		$output['dropdowncat']=Core_CKeywordSearch::categoryDropDown();
		$default=new Core_CProductDetail();
		$output['product']=$default->productDetail();
		$output['attributes']=$default->attributeList();
		$output['relprod']=$default->relatedProducts();
		$output['lastviewprod']=$default->lastViewedProducts();
		Bin_Template::createTemplate('productdetail.html',$output);
	}
	
	/**
	* This function is used to Display the product detail page
 	*
 	* @return string
	*/	
	function productDetail()
	{

		//language	
		Core_CLanguage::setLanguage('PRODUCT_DETAILS');

		$_SESSION['url']=$_GET['do'];
		
		
		Core_CCurrencySettings::getDefaultCurrency();
		
		//--------- Details for Header---------------//
		
		$output['skinname']=Core_CHome::skinName();
		$output['currentDate']=date('D,M d,Y - h:i A');
		$output['loginStatus'] = Core_CUserRegistration::loginStatus();
		$output['sitelogo']=Core_CHome::getLogo();
		$output['dropdowncat']=Core_CKeywordSearch::categoryDropDown();
		$output['pagetitle']=Core_CHome::pageTitle();
		$output['footerconnect']=Core_CHome::getfooterconnect();
		$output['sociallink']=Core_CHome::showSocialLinks();
		//--------- Details for Left Part-----------//

		$output['relatedproduct']=Core_CProductDetail::disprelatedProduct();
		$output['currencylist'] = Core_CCurrencySettings::displayEnabledCurrencies();				
		$output['categorytree'] = Core_CProductDetail::showCategoryTree();
		if($_SESSION['compareProductId']=='')
		{			
		$output['viewProducts']['viewProducts'] = Display_DWishList::viewProductElse();
		}
		else
			$output['viewProducts']=Core_CWishList::addtoCompareProduct();
		
		$default=new Core_CLastViewedProducts();
		$output['lastviewedproducts']=$default->lastViewedProducts();
		$output['tagClouds']=Core_CTagClouds::displayTagClouds();
		
		//--------- Details for Product Part-----------//
		
		$default=new Core_CProductDetail();
		$output['product']=$default->productDetail();
		// 		$output['pageinfo']=$default->pageInfo();
		$output['attributes']=$default->attributeList();

		$output['pagetitle']=Core_CHome::pageTitle();
		$output['cartcount']=Core_CAddCart::countCart();
		
		$output['headermenu'] = Core_CUserRegistration::showHeaderMenu();
		$output['headermenuhidden']= Core_CUserRegistration::showHeaderMenuHidden();
		$output['currencysettings']=Core_CUserRegistration::showCurrencySettings();
		Bin_Template::createTemplate('productdetail.html',$output);

		UNSET($_SESSION['reviewResult']);
		UNSET($_SESSION['reviewResultSuccess']);
		UNSET($_SESSION['quantitymsg']);
		UNSET($_SESSION['error_quantity']);
		
	}
	/**
	* This function is used to Display the large view of image of product
 	*
 	* @return string
	*/
	function showLargeview()
	{
		//language	
		Core_CLanguage::setLanguage('PRODUCT_DETAILS');

		Core_CCurrencySettings::getDefaultCurrency();
		
		$output['skinname']=Core_CHome::skinName();
		$default=new Core_CProductDetail();
		$output['result']=$default->showLargeview();
		Bin_Template::createTemplate('largeview.html',$output);
	}
	/**
	* This function is used to Display the pop up  of image of product 
 	*
 	* @return string
	*/		
	function showPopupProducts()
	{
			//language	
		Core_CLanguage::setLanguage('PRODUCT_DETAILS');
		

		echo  $output['popproduct']= Core_CProductDetail::showPopupProducts();
	}
	
}	
