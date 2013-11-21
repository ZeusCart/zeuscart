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
 * Footer links  related  class
 *
 * @package   		Model_MHome
 * @category    	Model
 * @author    		AJ Square Inc Dev Team
 * @link   		http://www.zeuscart.com
  * @copyright 	        Copyright (c) 2008 - 2013, AJ Square, Inc.
 * @version   		Version 4.0
 */
class Model_MHome
{
 	/**
	* This function is used to display the Home Page
 	*
	* @return string
	*/
	function homePage()
	{
		$output=array();
		include('classes/Core/CHome.php');
		
		include_once('classes/Core/CCurrencySettings.php');
		Core_CCurrencySettings::getDefaultCurrency();

		$output['sitelogo']=Core_CHome::getLogo();
		$output['pagetitle']=Core_CHome::pageTitle();
		$output['skinname']=Core_CHome::skinName();
		
		$output['timezone']=Core_CHome::setTimeZone();		
		$output['currentDate']=date('D,M d,Y - h:i A');		
		$output['banner']=Core_CHome::getBanner();
		
		$output['googleanalytics']=Core_CHome::getGoogleAnalyticsCode();
		$output['googlead']=Core_CHome::getGoogleAd();
		$output['footer']=Core_CHome::footer();
		$output['footerconnect']=Core_CHome::getfooterconnect();
		$output['sociallink']=Core_CHome::showSocialLinks();
		Bin_Template::createTemplate('header.html',$output);
	}	
	/**
	* This function is used to display the brands page  
 	*
	* @return string
	*/
	function showBrands()
	{
		
		//language	
		include_once('classes/Core/CLanguage.php');
		Core_CLanguage::setLanguage('CMS');
		
		include('classes/Core/CKeywordSearch.php');
		include('classes/Display/DKeywordSearch.php');
		include('classes/Core/CUserRegistration.php');
		include('classes/Display/DUserRegistration.php');
		include_once('classes/Core/CUserAddressBook.php');
		include('classes/Core/CHome.php');
		include_once('classes/Core/CLastViewedProducts.php');
		include_once('classes/Display/DLastViewedProducts.php');
		include_once('classes/Core/CAddCart.php');
		include_once('classes/Core/CCurrencySettings.php');
		Core_CCurrencySettings::getDefaultCurrency();

		$output['sitelogo']=Core_CHome::getLogo();
		$output['pagetitle']=Core_CHome::pageTitle();
		$output['timezone']=Core_CHome::setTimeZone();	
		$output['currentDate']=date('D,M d,Y - h:i A');
		$output['skinname']=Core_CHome::skinName();
		$output['googleanalytics']=Core_CHome::getGoogleAnalyticsCode();
		$output['googlead']=Core_CHome::getGoogleAd();
		$output['footer']=Core_CHome::footer();
		$output['footerconnect']=Core_CHome::getfooterconnect();
		$output['sociallink']=Core_CHome::showSocialLinks();
		$output['loginStatus'] = Core_CUserRegistration::loginStatus();
		$output['dropdowncat']=Core_CKeywordSearch::categoryDropDown();
		$output['headermenu'] = Core_CUserRegistration::showHeaderMenu();
		$output['headerMainMenu'] = Core_CUserRegistration::showHeaderMainMenu();
		$output['currencysettings']=Core_CUserRegistration::showCurrencySettings();		
		$output['headertext'] = Core_CUserRegistration::showHeaderText();
		$output['result'] = $result;
		$output['headermenuhidden']= Core_CUserRegistration::showHeaderMenuHidden();
		$output['userLeftMenu'] = Display_DUserRegistration::showUserLeftMenu();	
		$output['lastviewedproducts']=Core_CLastViewedProducts::lastViewedProducts();	
		$output['cartcount']=Core_CAddCart::countCart();				
	
		$output['brands']=Core_CHome::showBrands();
		Bin_Template::createTemplate('brands.html',$output);
	}

	/**
	* This function is used to display the brand list
 	*
	* @return string
	*/
	function viewBrandsList()
	{
		
		//language	
		include_once('classes/Core/CLanguage.php');
		Core_CLanguage::setLanguage('CMS');

		if($_GET['action']=='')
		{
			include('classes/Core/CKeywordSearch.php');
			include('classes/Display/DKeywordSearch.php');
			include('classes/Core/CUserRegistration.php');
			include('classes/Display/DUserRegistration.php');
			include_once('classes/Core/CUserAddressBook.php');
			include('classes/Core/CHome.php');
			include_once('classes/Core/CLastViewedProducts.php');
			include_once('classes/Display/DLastViewedProducts.php');
			include('classes/Core/CProductDetail.php');
			include('classes/Display/DProductDetail.php');
			include_once('classes/Core/CAddCart.php');
			include_once('classes/Core/CCurrencySettings.php');
			Core_CCurrencySettings::getDefaultCurrency();
	
			$output['sitelogo']=Core_CHome::getLogo();
			$output['pagetitle']=Core_CHome::pageTitle();
			$output['timezone']=Core_CHome::setTimeZone();	
			$output['currentDate']=date('D,M d,Y - h:i A');
			$output['skinname']=Core_CHome::skinName();
			$output['googleanalytics']=Core_CHome::getGoogleAnalyticsCode();
			$output['googlead']=Core_CHome::getGoogleAd();
			$output['footer']=Core_CHome::footer();
			$output['footerconnect']=Core_CHome::getfooterconnect();
			$output['sociallink']=Core_CHome::showSocialLinks();
			$output['loginStatus'] = Core_CUserRegistration::loginStatus();
			$output['dropdowncat']=Core_CKeywordSearch::categoryDropDown();
			$output['headermenu'] = Core_CUserRegistration::showHeaderMenu();
			$output['headerMainMenu'] = Core_CUserRegistration::showHeaderMainMenu();		
			$output['headertext'] = Core_CUserRegistration::showHeaderText();
			$output['result'] = $result;
			$output['headermenuhidden']= Core_CUserRegistration::showHeaderMenuHidden();
			$output['currencysettings']=Core_CUserRegistration::showCurrencySettings();
			$output['userLeftMenu'] = Display_DUserRegistration::showUserLeftMenu();	
			$output['lastviewedproducts']=Core_CLastViewedProducts::lastViewedProducts();	
			$output['cartcount']=Core_CAddCart::countCart();				
			$output['categorytree'] = Core_CProductDetail::showCategoryTree();
			$output['listviewbrands']=Core_CHome::viewBrandsList();
			Bin_Template::createTemplate('listviewbrand.html',$output);
		}
		else
		{
			include('classes/Core/CKeywordSearch.php');
			include('classes/Display/DKeywordSearch.php');
			include('classes/Core/CUserRegistration.php');
			include('classes/Display/DUserRegistration.php');
			include_once('classes/Core/CUserAddressBook.php');
			include('classes/Core/CHome.php');
			include_once('classes/Core/CLastViewedProducts.php');
			include_once('classes/Display/DLastViewedProducts.php');
			include_once('classes/Core/CAddCart.php');
			include_once('classes/Core/CCurrencySettings.php');
			include('classes/Core/CProductDetail.php');
			include('classes/Display/DProductDetail.php');
			Core_CCurrencySettings::getDefaultCurrency();
	
			$output['sitelogo']=Core_CHome::getLogo();
			$output['pagetitle']=Core_CHome::pageTitle();
			$output['timezone']=Core_CHome::setTimeZone();	
			$output['currentDate']=date('D,M d,Y - h:i A');
			$output['skinname']=Core_CHome::skinName();
			$output['googleanalytics']=Core_CHome::getGoogleAnalyticsCode();
			$output['googlead']=Core_CHome::getGoogleAd();
			$output['footer']=Core_CHome::footer();
			$output['footerconnect']=Core_CHome::getfooterconnect();
			$output['sociallink']=Core_CHome::showSocialLinks();
			$output['loginStatus'] = Core_CUserRegistration::loginStatus();
			$output['dropdowncat']=Core_CKeywordSearch::categoryDropDown();
			$output['headermenu'] = Core_CUserRegistration::showHeaderMenu();
			$output['headerMainMenu'] = Core_CUserRegistration::showHeaderMainMenu();		
			$output['headertext'] = Core_CUserRegistration::showHeaderText();
			$output['result'] = $result;
			$output['headermenuhidden']= Core_CUserRegistration::showHeaderMenuHidden();
			$output['currencysettings']=Core_CUserRegistration::showCurrencySettings();
			$output['userLeftMenu'] = Display_DUserRegistration::showUserLeftMenu();	
			$output['lastviewedproducts']=Core_CLastViewedProducts::lastViewedProducts();	
			$output['categorytree'] = Core_CProductDetail::showCategoryTree();
			$output['cartcount']=Core_CAddCart::countCart();				
		
			$output['gridviewbrands']=Core_CHome::viewBrandsList();
			Bin_Template::createTemplate('gridviewbrand.html',$output);
		}


	}
	/**
	* This function is used to display the gift vouchers
 	*
	* @return string
	*/
	function showVoucher()
	{

		include("classes/Lib/HandleErrors.php");	

		$output['val']=$Err->values;
		$output['msg']=$Err->messages;
	
		Bin_Template::createTemplate('giftvouchers.html',$output);

	}
	/**
	* This function is used to validate the gift vouchers
 	*
	* @return string
	*/
// 	function showAddVoucher()	
// 	{
// 
// 		include('classes/Lib/CheckInputs.php');
// 		$obj = new Lib_CheckInputs('giftvoucher');
// 
// 		$_SESSION['gift'][]=$_POST;
// 
// 		header('Location:?do=addtocartfromproductdetail&prodid='.$_GET['prodid'].'&vid=1');
// 	}

	/**
	* This function is used to show the dynamic cms
 	*
	* @return string
	*/
	function showDynamicContent()
	{	
		include('classes/Core/CKeywordSearch.php');
		include('classes/Display/DKeywordSearch.php');
		include('classes/Core/CUserRegistration.php');
		include('classes/Display/DUserRegistration.php');
		include_once('classes/Core/CUserAddressBook.php');
		include('classes/Core/CHome.php');
		include('classes/Core/CProductDetail.php');
		include('classes/Display/DProductDetail.php');
		include_once('classes/Core/CLastViewedProducts.php');
		include_once('classes/Display/DLastViewedProducts.php');
		include_once('classes/Core/CAddCart.php');
		include_once('classes/Core/CCurrencySettings.php');
		Core_CCurrencySettings::getDefaultCurrency();

		$output['sitelogo']=Core_CHome::getLogo();
		$output['pagetitle']=Core_CHome::pageTitle();
		$output['timezone']=Core_CHome::setTimeZone();	
		$output['currentDate']=date('D,M d,Y - h:i A');
		$output['skinname']=Core_CHome::skinName();
		$output['googleanalytics']=Core_CHome::getGoogleAnalyticsCode();
		$output['googlead']=Core_CHome::getGoogleAd();
		$output['footer']=Core_CHome::footer();
		$output['footerconnect']=Core_CHome::getfooterconnect();
		$output['sociallink']=Core_CHome::showSocialLinks();
		$output['loginStatus'] = Core_CUserRegistration::loginStatus();
		$output['dropdowncat']=Core_CKeywordSearch::categoryDropDown();
		$output['headermenu'] = Core_CUserRegistration::showHeaderMenu();
		$output['headerMainMenu'] = Core_CUserRegistration::showHeaderMainMenu();
		$output['currencysettings']=Core_CUserRegistration::showCurrencySettings();		
		$output['headertext'] = Core_CUserRegistration::showHeaderText();
		$output['result'] = $result;
		$output['headermenuhidden']= Core_CUserRegistration::showHeaderMenuHidden();
		$output['userLeftMenu'] = Display_DUserRegistration::showUserLeftMenu();	
		$output['lastviewedproducts']=Core_CLastViewedProducts::lastViewedProducts();	
		$output['cartcount']=Core_CAddCart::countCart();				
		$output['categorytree'] = Core_CProductDetail::showCategoryTree();	
		$output['showpages']=Core_CHome::showDynamicContent();
		
		Bin_Template::createTemplate('cms.html',$output);
	}
	
	
}
?>