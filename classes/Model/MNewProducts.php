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
 * New products related  class
 *
 * @package   		Model_MNewProducts
 * @category    	Model
 * @author    		AJ Square Inc Dev Team
 * @link   		http://www.zeuscart.com
  * @copyright 	        Copyright (c) 2008 - 2013, AJ Square, Inc.
 * @version   		Version 4.0
 */
class Model_MNewProducts
{

	/**
	 * Stores the output 
	 *
	 * @var array 
	 */	
	var $output = array();	
 	/**
	* This function is used to Display the New Product Page
 	*
 	* @return string
	*/
	function newProducts()
	{
		//language	
		include_once('classes/Core/CLanguage.php');
		Core_CLanguage::setLanguage('COMMON');

		include_once('classes/Core/CNewProducts.php');
		include_once('classes/Display/DNewProducts.php');
		include('classes/Core/CKeywordSearch.php');
  		include('classes/Display/DKeywordSearch.php');
		include('classes/Core/CProductDetail.php');
		include('classes/Display/DProductDetail.php');
		include('classes/Core/CHome.php');
		include('classes/Core/CAddCart.php');
		include('classes/Display/DAddCart.php');
		
		include_once('classes/Core/CCurrencySettings.php');
		Core_CCurrencySettings::getDefaultCurrency();
		
		$output['cartSnapShot'] = Core_CAddCart::cartSnapShot();
		$output['sitelogo']=Core_CHome::getLogo();
		$output['pagetitle']=Core_CHome::pageTitle();
		$output['timezone']=Core_CHome::setTimeZone();	
		$output['currentDate']=date('D,M d,Y - h:i A');
		$output['signup']=Display_DUserRegistration::signUp();
		$output['skinname']=Core_CHome::skinName();
		$output['googleanalytics']=Core_CHome::getGoogleAnalyticsCode();
		$output['footerconnect']=Core_CHome::getfooterconnect();
		$output['sociallink']=Core_CHome::showSocialLinks();
		$output['dropdowncat']=Core_CKeywordSearch::categoryDropDown();
		$default=new Core_CNewProducts();
		$output['newproducts']=$default->newProducts();
		$output['currencysettings']=Core_CUserRegistration::showCurrencySettings();
		$output['loginStatus'] = Core_CUserRegistration::loginStatus();
		$output['cartcount']=Core_CAddCart::countCart();
		$output['categorytree'] = Core_CProductDetail::showCategoryTree();

		Bin_Template::createTemplate('products.html',$output);
	}
	/**
	* This function is used to Display the  Product list  Page
 	*
 	* @return string
	*/
	function viewProducts()
	{
		
		//language	
		include_once('classes/Core/CLanguage.php');
		Core_CLanguage::setLanguage('COMMON');

		include_once('classes/Core/CNewProducts.php');
		include_once('classes/Display/DNewProducts.php');
		include('classes/Core/CKeywordSearch.php');
		include('classes/Display/DKeywordSearch.php');
		include('classes/Core/CProductDetail.php');
		include('classes/Core/CUserRegistration.php');
		include('classes/Display/DUserRegistration.php');
		include('classes/Display/DProductDetail.php');
		include('classes/Core/CHome.php');
		include('classes/Core/CAddCart.php');
		include('classes/Display/DAddCart.php');
		
		include_once('classes/Core/CCurrencySettings.php');
		Core_CCurrencySettings::getDefaultCurrency();
		
		$output['cartSnapShot'] = Core_CAddCart::cartSnapShot();
		$output['sitelogo']=Core_CHome::getLogo();
		$output['pagetitle']=Core_CHome::pageTitle();
		$output['timezone']=Core_CHome::setTimeZone();	
		$output['currentDate']=date('D,M d,Y - h:i A');
		$output['headermenu'] = Core_CUserRegistration::showHeaderMenu();
		$output['headermenuhidden']= Core_CUserRegistration::showHeaderMenuHidden();
		$output['loginStatus'] = Core_CUserRegistration::loginStatus();
		$output['currencysettings']=Core_CUserRegistration::showCurrencySettings();
		$output['skinname']=Core_CHome::skinName();
		$output['googleanalytics']=Core_CHome::getGoogleAnalyticsCode();
		$output['footerconnect']=Core_CHome::getfooterconnect();
		$output['sociallink']=Core_CHome::showSocialLinks();
		$output['dropdowncat']=Core_CKeywordSearch::categoryDropDown();
		$output['categorytree'] = Core_CProductDetail::showCategoryTree();
		$default=new Core_CNewProducts();
		$output['viewproducts']=$default->viewProducts();
		$output['cartcount']=Core_CAddCart::countCart();
		$output['categorybreadcrumb']=$default->categoryBreadCrumb();
		$output['title']=$default->getTitle();


		Bin_Template::createTemplate('listtheproduct.html',$output);
	}
	/**
	* This function is used to Display the  grid product list  Page
 	*
 	* @return string
	*/
	function girdViewProducts()
	{
		
		//language	
		include_once('classes/Core/CLanguage.php');
		Core_CLanguage::setLanguage('COMMON');

		include_once('classes/Core/CNewProducts.php');
		include_once('classes/Display/DNewProducts.php');
		include('classes/Core/CKeywordSearch.php');
		include('classes/Display/DKeywordSearch.php');
		include('classes/Core/CProductDetail.php');
		include('classes/Display/DProductDetail.php');
		include('classes/Core/CUserRegistration.php');
		include('classes/Display/DUserRegistration.php');
		include('classes/Core/CHome.php');
		include('classes/Core/CAddCart.php');
		include('classes/Display/DAddCart.php');
		
		include_once('classes/Core/CCurrencySettings.php');
		Core_CCurrencySettings::getDefaultCurrency();
		
	
		$output['cartSnapShot'] = Core_CAddCart::cartSnapShot();
		$output['sitelogo']=Core_CHome::getLogo();
		$output['pagetitle']=Core_CHome::pageTitle();
		$output['timezone']=Core_CHome::setTimeZone();	
		$output['currentDate']=date('D,M d,Y - h:i A');
		$output['headermenu'] = Core_CUserRegistration::showHeaderMenu();
		$output['headermenuhidden']= Core_CUserRegistration::showHeaderMenuHidden();
		$output['loginStatus'] = Core_CUserRegistration::loginStatus();
		$output['currencysettings']=Core_CUserRegistration::showCurrencySettings();
		$output['skinname']=Core_CHome::skinName();
		$output['googleanalytics']=Core_CHome::getGoogleAnalyticsCode();
		$output['footerconnect']=Core_CHome::getfooterconnect();
		$output['sociallink']=Core_CHome::showSocialLinks();
		$output['dropdowncat']=Core_CKeywordSearch::categoryDropDown();
		$output['categorytree'] = Core_CProductDetail::showCategoryTree();
		$default=new Core_CNewProducts();
		$output['gridviewproducts']=$default->viewProducts();
		$output['categorybreadcrumb']=$default->categoryBreadCrumb();
		$output['title']=$default->getTitle();
		$output['cartcount']=Core_CAddCart::countCart();
		Bin_Template::createTemplate('grid_list_product.html',$output);
	

	}

	function giftProducts()
	{

		
		//language	
		include_once('classes/Core/CLanguage.php');
		Core_CLanguage::setLanguage('COMMON');

		include_once('classes/Core/CNewProducts.php');
		include_once('classes/Display/DNewProducts.php');
		include('classes/Core/CKeywordSearch.php');
		include('classes/Display/DKeywordSearch.php');
		include('classes/Core/CProductDetail.php');
		include('classes/Core/CUserRegistration.php');
		include('classes/Display/DUserRegistration.php');
		include('classes/Display/DProductDetail.php');
		include('classes/Core/CHome.php');
		include('classes/Core/CAddCart.php');
		include('classes/Display/DAddCart.php');
		
		include_once('classes/Core/CCurrencySettings.php');
		Core_CCurrencySettings::getDefaultCurrency();
		
		
		$output['cartSnapShot'] = Core_CAddCart::cartSnapShot();
		$output['sitelogo']=Core_CHome::getLogo();
		$output['pagetitle']=Core_CHome::pageTitle();
		$output['timezone']=Core_CHome::setTimeZone();	
		$output['currentDate']=date('D,M d,Y - h:i A');
		$output['headermenu'] = Core_CUserRegistration::showHeaderMenu();
		$output['headermenuhidden']= Core_CUserRegistration::showHeaderMenuHidden();
		$output['loginStatus'] = Core_CUserRegistration::loginStatus();
		$output['currencysettings']=Core_CUserRegistration::showCurrencySettings();
		$output['skinname']=Core_CHome::skinName();
		$output['googleanalytics']=Core_CHome::getGoogleAnalyticsCode();
		$output['footerconnect']=Core_CHome::getfooterconnect();
		$output['sociallink']=Core_CHome::showSocialLinks();
		$output['dropdowncat']=Core_CKeywordSearch::categoryDropDown();
		$output['categorytree'] = Core_CProductDetail::showCategoryTree();
		$default=new Core_CNewProducts();
		$output['viewproducts']=$default->viewGiftProducts();

		$output['cartcount']=Core_CAddCart::countCart();
		$output['categorybreadcrumb']=$default->categoryBreadCrumb();
		$output['title']=$default->getTitle();
		Bin_Template::createTemplate('gift_list_products.html',$output);
	
	}


	function gridGiftProducts()
	{

			
		//language	
		include_once('classes/Core/CLanguage.php');
		Core_CLanguage::setLanguage('COMMON');

		include_once('classes/Core/CNewProducts.php');
		include_once('classes/Display/DNewProducts.php');
		include('classes/Core/CKeywordSearch.php');
		include('classes/Display/DKeywordSearch.php');
		include('classes/Core/CProductDetail.php');
		include('classes/Display/DProductDetail.php');
		include('classes/Core/CUserRegistration.php');
		include('classes/Display/DUserRegistration.php');
		include('classes/Core/CHome.php');
		include('classes/Core/CAddCart.php');
		include('classes/Display/DAddCart.php');
		
		include_once('classes/Core/CCurrencySettings.php');
		Core_CCurrencySettings::getDefaultCurrency();
		
	
		$output['cartSnapShot'] = Core_CAddCart::cartSnapShot();
		$output['sitelogo']=Core_CHome::getLogo();
		$output['pagetitle']=Core_CHome::pageTitle();
		$output['timezone']=Core_CHome::setTimeZone();	
		$output['currentDate']=date('D,M d,Y - h:i A');
		$output['headermenu'] = Core_CUserRegistration::showHeaderMenu();
		$output['headermenuhidden']= Core_CUserRegistration::showHeaderMenuHidden();
		$output['loginStatus'] = Core_CUserRegistration::loginStatus();
		$output['currencysettings']=Core_CUserRegistration::showCurrencySettings();
		$output['skinname']=Core_CHome::skinName();
		$output['googleanalytics']=Core_CHome::getGoogleAnalyticsCode();
		$output['footerconnect']=Core_CHome::getfooterconnect();
		$output['sociallink']=Core_CHome::showSocialLinks();
		$output['dropdowncat']=Core_CKeywordSearch::categoryDropDown();
		$output['categorytree'] = Core_CProductDetail::showCategoryTree();
		$default=new Core_CNewProducts();
		$output['gridviewproducts']=$default->viewGiftProducts();

		$output['categorybreadcrumb']=$default->categoryBreadCrumb();
		$output['title']=$default->getTitle();
		$output['cartcount']=Core_CAddCart::countCart();
		Bin_Template::createTemplate('gift_grid_products.html',$output);

	}

}
?>