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
 * User account  related  class
 *
 * @package   		Model_MUserAccount
 * @category    	Model
 * @author    		AJ Square Inc Dev Team
 * @link   		http://www.zeuscart.com
  * @copyright 	        Copyright (c) 2008 - 2013, AJ Square, Inc.
 * @version   		Version 4.0
 */

class Model_MUserAccount
{
	/**
	 * Stores the output 
	 *
	 * @var array 
	 */	
	var $output = array();
	/**
	* This function is used to Show news letter page
 	* @param string $result
 	* @return string 
	*/
	function showNewsLetter($result='')
	{

		//language	
		include_once('classes/Core/CLanguage.php');
		Core_CLanguage::setLanguage('NEWS_LETTER');

		$this->checkLogin();
		include('classes/Core/CKeywordSearch.php');
		include('classes/Display/DKeywordSearch.php');
		include('classes/Core/CUserRegistration.php');
		include('classes/Display/DUserRegistration.php');
		include_once('classes/Core/CUserNewsLetter.php');
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
		$output['headermenuhidden']= Core_CUserRegistration::showHeaderMenuHidden();		
		$output['headertext'] = Core_CUserRegistration::showHeaderText();
		$output['currencysettings']=Core_CUserRegistration::showCurrencySettings();
		$output['result'] = $result;
		$output['headerMainMenu'] = Core_CUserRegistration::showHeaderMainMenu();
		$output['userLeftMenu'] = Display_DUserRegistration::showUserLeftMenu();	
		$output['lastviewedproducts']=Core_CLastViewedProducts::lastViewedProducts();			$output['cartcount']=Core_CAddCart::countCart();		
		$output['userRight'] = "userdashboard.html";					
		$output['rows']=Core_CUserNewsLetter::showNewsLetter();

		Bin_Template::createTemplate('userIndex.html',$output);
	}
	/**
	* This function is used to Show account dashboard after login
 	*
 	* @return string
	*/
	function showDashBoard()
	{

		//language	
		include_once('classes/Core/CLanguage.php');
		Core_CLanguage::setLanguage('DASHBOARD');

		$this->checkLogin();	
		include('classes/Core/CKeywordSearch.php');
		include('classes/Display/DKeywordSearch.php');
		include('classes/Core/CUserRegistration.php');
		include('classes/Display/DUserRegistration.php');
		include('classes/Core/CUserDashboard.php');
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
		$output['headermenuhidden']= Core_CUserRegistration::showHeaderMenuHidden();
		$output['currencysettings']=Core_CUserRegistration::showCurrencySettings();
		$output['headertext'] = Core_CUserRegistration::showHeaderText();
		$output['userLeftMenu'] = Display_DUserRegistration::showUserLeftMenu();	
		$output['lastviewedproducts']=Core_CLastViewedProducts::lastViewedProducts();			$output['cartcount']=Core_CAddCart::countCart();		
		$output['userRight'] = "userdashboard.html";					
		$output['rows']=Core_CUserDashboard::showDashboard();
		Bin_Template::createTemplate('userIndex.html',$output);
		
	}
	/**
	* This function is used to Show account information  after login
 	* @param array  $result
 	* @return string
	*/
	function showAccountInfo($result='')
	{

		//language	
		include_once('classes/Core/CLanguage.php');
		Core_CLanguage::setLanguage('ACCOUNT_INFO');

		$this->checkLogin();	
		include('classes/Core/CKeywordSearch.php');
		include('classes/Display/DKeywordSearch.php');
		include('classes/Core/CUserRegistration.php');
		include('classes/Display/DUserRegistration.php');
		include_once('classes/Core/CUserAccInfo.php');
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
		$output['headerMainMenu'] = Core_CUserRegistration::showHeaderMainMenu();
		$output['headermenu'] = Core_CUserRegistration::showHeaderMenu();
		$output['headermenuhidden']= Core_CUserRegistration::showHeaderMenuHidden();
		$output['currencysettings']=Core_CUserRegistration::showCurrencySettings();
		$output['headertext'] = Core_CUserRegistration::showHeaderText();
		$output['result'] = $result;					
		$output['userLeftMenu'] = Display_DUserRegistration::showUserLeftMenu();			
		$output['lastviewedproducts']=Core_CLastViewedProducts::lastViewedProducts();
		$output['cartcount']=Core_CAddCart::countCart();	
		$output['userRight'] = "userdashboard.html";					
		$output['rows']=Core_CUserAccInfo::showAccInfo();

		Bin_Template::createTemplate('userIndex.html',$output);
	
	}

	/**
	* This function is used to show the chage password  after login
 	* @param array  $result
 	* @return string
	*/
	function showChangePassword($result='')
	{
		//language	
		include_once('classes/Core/CLanguage.php');
		Core_CLanguage::setLanguage('CHANGE_PASSWORD');

		$this->checkLogin();	
		include('classes/Core/CKeywordSearch.php');
		include('classes/Display/DKeywordSearch.php');
		include('classes/Core/CUserRegistration.php');
		include('classes/Display/DUserRegistration.php');
		include_once('classes/Core/CUserAccInfo.php');
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
		$output['headerMainMenu'] = Core_CUserRegistration::showHeaderMainMenu();
		$output['headermenu'] = Core_CUserRegistration::showHeaderMenu();
		$output['headermenuhidden']= Core_CUserRegistration::showHeaderMenuHidden();
		$output['currencysettings']=Core_CUserRegistration::showCurrencySettings();
		$output['headertext'] = Core_CUserRegistration::showHeaderText();
		$output['result'] = $result;					
		$output['userLeftMenu'] = Display_DUserRegistration::showUserLeftMenu();			
		$output['lastviewedproducts']=Core_CLastViewedProducts::lastViewedProducts();
		$output['cartcount']=Core_CAddCart::countCart();
	
		$output['userRight'] = "userdashboard.html";					
		$output['rows']=Core_CUserAccInfo::showChangePassword();

		Bin_Template::createTemplate('userIndex.html',$output);
	
	}
	/**
	* This function is used to edit account information  after login
 	*
 	* @return string
	*/
	function editAccountInfo()
	{
		//language	
		include_once('classes/Core/CLanguage.php');
		Core_CLanguage::setLanguage('ACCOUNT_INFO');

		include('classes/Lib/CheckInputs.php');
		include('classes/Core/CUserAccInfo.php');
		
		include_once('classes/Core/CCurrencySettings.php');
		Core_CCurrencySettings::getDefaultCurrency();

		$obj = new Lib_CheckInputs('frmAcc');

		$result=Core_CUserAccInfo::updateAcc();	

		$this->showAccountInfo($result);
	}

	/**
	* This function is used to edit change password  after login
 	*
 	* @return string
	*/
	function editChangePassword()
	{

		//language	
		include_once('classes/Core/CLanguage.php');
		Core_CLanguage::setLanguage('CHANGE_PASSWORD');

		include('classes/Lib/CheckInputs.php');
		include('classes/Core/CUserAccInfo.php');
		
		include_once('classes/Core/CCurrencySettings.php');
		Core_CCurrencySettings::getDefaultCurrency();

		$obj = new Lib_CheckInputs('changepassword');

		$result=Core_CUserAccInfo::updateChangePassword();	

		$this->showChangePassword($result);
	}

	/**
	* This function is used to show  product review  after login
 	*
 	* @return string
	*/
	function showProductReview()
	{
		
		//language	
		include_once('classes/Core/CLanguage.php');
		Core_CLanguage::setLanguage('MY_PRODUCT_REVIEWS');

		$this->checkLogin();	
		include('classes/Core/CKeywordSearch.php');
		include('classes/Display/DKeywordSearch.php');
		include('classes/Core/CUserRegistration.php');
		include('classes/Display/DUserRegistration.php');
		include('classes/Core/CUserProductReview.php');
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
		$output['headermenuhidden']= Core_CUserRegistration::showHeaderMenuHidden();
		$output['currencysettings']=Core_CUserRegistration::showCurrencySettings();
		$output['headertext'] = Core_CUserRegistration::showHeaderText();
		$output['userLeftMenu'] = Display_DUserRegistration::showUserLeftMenu();			
		$output['lastviewedproducts']=Core_CLastViewedProducts::lastViewedProducts();
		$output['cartcount']=Core_CAddCart::countCart();	
		$output['userRight'] = "userdashboard.html";					
		$output['rows']=Core_CUserProductReview::showProductReview();

		Bin_Template::createTemplate('userIndex.html',$output);

	}
	/**
	* This function is used to show  product wishlist  after login
 	* @param  string $result
 	* @return string
	*/
	function showWishList($result='')
	{
		//language	
		include_once('classes/Core/CLanguage.php');
		Core_CLanguage::setLanguage('MY_WISHLIST');

		$this->checkLogin();	
		include('classes/Core/CKeywordSearch.php');
		include('classes/Display/DKeywordSearch.php');
		include('classes/Core/CUserRegistration.php');
		include('classes/Display/DUserRegistration.php');
		include_once('classes/Core/CUserWishList.php');
		include_once('classes/Core/CHome.php');
		include("classes/Lib/HandleErrors.php");
		include_once('classes/Core/CLastViewedProducts.php');
		include_once('classes/Display/DLastViewedProducts.php');
		include_once('classes/Core/CAddCart.php');
		include_once('classes/Core/CUserWishList.php');
		include_once('classes/Core/CCurrencySettings.php');
		Core_CCurrencySettings::getDefaultCurrency();
		
		Core_CUserWishList::Ulogin($Err);
		$output['val']=$Err->values;
		$output['msg']=$Err->messages;

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
		$output['headertext'] = Core_CUserRegistration::showHeaderText();
		$output['divStat']=Core_CUserWishList::getStatus();
		$output['headerMainMenu'] = Core_CUserRegistration::showHeaderMainMenu();
		$output['headermenuhidden']= Core_CUserRegistration::showHeaderMenuHidden();
		$output['userLeftMenu'] = Display_DUserRegistration::showUserLeftMenu();
		$output['currencysettings']=Core_CUserRegistration::showCurrencySettings();	
		$output['lastviewedproducts']=Core_CLastViewedProducts::lastViewedProducts();			$output['cartcount']=Core_CAddCart::countCart();	
		$output['userRight'] = "userWishlist.html";					
		$output['rows']=Core_CUserWishList::showWishList($result);

		
		Bin_Template::createTemplate('userIndex.html',$output);
	}
	/**
	* This function is used to show  send wish list   after login
 	*
 	* @return string
	*/
	function sendWishlist()
	{

		//language	
		include_once('classes/Core/CLanguage.php');
		Core_CLanguage::setLanguage('MY_WISHLIST');

		include('classes/Lib/CheckInputs.php');
		include('classes/Core/CUserWishList.php');
		
		include_once('classes/Core/CCurrencySettings.php');
		Core_CCurrencySettings::getDefaultCurrency();
		
		$obj = new Lib_CheckInputs('frmWishSend');
		$result=Core_CUserWishList::sendWishlist();	

		$this->showWishList($result);
	}
	/**
	* This function is used to show  add new letter 
 	*
 	* @return string
	*/
	function addNewsLetter()
	{
		include_once('classes/Core/CUserNewsLetter.php');
		
		include_once('classes/Core/CCurrencySettings.php');
		Core_CCurrencySettings::getDefaultCurrency();
		
		$result=Core_CUserNewsLetter::addNewsLetter();		
		$this->showNewsLetter($result);
	}
	/**
	* This function is used to show  my order list page 
 	*
 	* @return string
	*/
	function showMyOrder()
	{

		//language	
		include_once('classes/Core/CLanguage.php');
		Core_CLanguage::setLanguage('MY_ORDER');


		$this->checkLogin();	
		include('classes/Core/CKeywordSearch.php');
		include('classes/Display/DKeywordSearch.php');
		include('classes/Core/CUserRegistration.php');
		include('classes/Display/DUserRegistration.php');
		include('classes/Core/CUserOrder.php');
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
		$output['currencysettings']=Core_CUserRegistration::showCurrencySettings();
		$output['headerMainMenu'] = Core_CUserRegistration::showHeaderMainMenu();
		$output['headermenuhidden']= Core_CUserRegistration::showHeaderMenuHidden();
		$output['headertext'] = Core_CUserRegistration::showHeaderText();
		$output['userLeftMenu'] = Display_DUserRegistration::showUserLeftMenu();			
		$output['lastviewedproducts']=Core_CLastViewedProducts::lastViewedProducts();	
		$output['cartcount']=Core_CAddCart::countCart();	
		$output['userRight'] = "userdashboard.html";					
		$output['rows']=Core_CUserOrder::showOrder();

		Bin_Template::createTemplate('userIndex.html',$output);
	
	}
	/**
	* This function is used to show  my order details page
 	*
 	* @return string
	*/
	function showOrderDetails()
	{
		//language	
		include_once('classes/Core/CLanguage.php');
		Core_CLanguage::setLanguage('ORDER_DETAILS');

		$this->checkLogin();	
		include('classes/Core/CKeywordSearch.php');
		include('classes/Display/DKeywordSearch.php');
		include('classes/Core/CUserRegistration.php');
		include('classes/Display/DUserRegistration.php');
		include('classes/Core/CUserOrder.php');
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
		$output['headermenuhidden']= Core_CUserRegistration::showHeaderMenuHidden();
		$output['currencysettings']=Core_CUserRegistration::showCurrencySettings();
		$output['headertext'] = Core_CUserRegistration::showHeaderText();
		$output['userLeftMenu'] = Display_DUserRegistration::showUserLeftMenu();
		$output['cartcount']=Core_CAddCart::countCart();			
		$output['userRight'] = "userdashboard.html";					
		$output['rows']=Core_CUserOrder::showOrderDetails();
		$output['lastviewedproducts']=Core_CLastViewedProducts::lastViewedProducts();		

		Bin_Template::createTemplate('userIndex.html',$output);
	}
	/**
	* This function is used to show  all new product
 	*
 	* @return string
	*/
	function showAllNew()
	{
		//language	
		include_once('classes/Core/CLanguage.php');
		Core_CLanguage::setLanguage('COMMON');

		include('classes/Core/CKeywordSearch.php');
		include('classes/Display/DKeywordSearch.php');
		include('classes/Core/CUserRegistration.php');
		include('classes/Display/DUserRegistration.php');
		include('classes/Core/CAllNew.php');
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
		$output['headermenuhidden']= Core_CUserRegistration::showHeaderMenuHidden();
		$output['currencysettings']=Core_CUserRegistration::showCurrencySettings();
		$output['headertext'] = Core_CUserRegistration::showHeaderText();
		//$output['userLeftMenu'] = Display_DUserRegistration::showUserLeftMenu();			
		$output['lastviewedproducts']=Core_CLastViewedProducts::lastViewedProducts();
		$output['cartcount']=Core_CAddCart::countCart();
		$output['userRight'] = "userdashboard.html";					
		$output['rows']=Core_CAllNew::showAllNew();

		Bin_Template::createTemplate('userIndex.html',$output);
	}
	/**
	* This function is used to show  all featured product
 	*
 	* @return string
	*/
	function showAllFeatured()
	{
		//language	
		include_once('classes/Core/CLanguage.php');
		Core_CLanguage::setLanguage('COMMON');

		include('classes/Core/CKeywordSearch.php');
		include('classes/Display/DKeywordSearch.php');
		include('classes/Core/CUserRegistration.php');
		include('classes/Display/DUserRegistration.php');
		include('classes/Core/CAllFeatured.php');
		include('classes/Core/CHome.php');
		include_once('classes/Core/CLastViewedProducts.php');
		include_once('classes/Display/DLastViewedProducts.php');
		include('classes/Core/CCurrencySettings.php');
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
		$output['headermenuhidden']= Core_CUserRegistration::showHeaderMenuHidden();
		$output['headertext'] = Core_CUserRegistration::showHeaderText();
		$output['currencysettings']=Core_CUserRegistration::showCurrencySettings();		
		$output['lastviewedproducts']=Core_CLastViewedProducts::lastViewedProducts();
		$output['cartcount']=Core_CAddCart::countCart();
		$output['userRight'] = "userdashboard.html";					
		$output['rows']=Core_CAllFeatured::showAllFeatured();

		Bin_Template::createTemplate('userIndex.html',$output);
	}
	/**
	* This function is used to show  my address book
 	* @param string $result
 	* @return string
	*/
	function showMyAddressBook($result='')
	{
		//language	
		include_once('classes/Core/CLanguage.php');
		Core_CLanguage::setLanguage('ADDRESS_BOOK');

		$this->checkLogin();
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
		$output['userRight'] = "userdashboard.html";					
		$output['rows']=Core_CUserAddressBook::showAddressBook();

		Bin_Template::createTemplate('userIndex.html',$output);
	}
	/**
	* This function is used to show add  address book
 	* @param string $result
 	* @return string
	*/
	function showAddAddress($result='')
	{
		//language	
		include_once('classes/Core/CLanguage.php');
		Core_CLanguage::setLanguage('ADDRESS_BOOK');

		$this->checkLogin();
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
		$output['headertext'] = Core_CUserRegistration::showHeaderText();
		$output['result'] = $result;
		$output['headermenuhidden']= Core_CUserRegistration::showHeaderMenuHidden();
		$output['currencysettings']=Core_CUserRegistration::showCurrencySettings();
		$output['userLeftMenu'] = Display_DUserRegistration::showUserLeftMenu();	
		$output['lastviewedproducts']=Core_CLastViewedProducts::lastViewedProducts();	
		$output['cartcount']=Core_CAddCart::countCart();		

		$output['userRight'] = "userdashboard.html";					
		$output['rows']=Core_CUserAddressBook::showAddAddress();

		Bin_Template::createTemplate('userIndex.html',$output);

	}
	/**
	* This function is used to show add  address book
 	*
 	* @return string
	*/
	function showAddress()
	{

		//language	
		include_once('classes/Core/CLanguage.php');
		Core_CLanguage::setLanguage('ADDRESS_BOOK');

		$this->checkLogin();
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
		$output['currencysettings']=Core_CUserRegistration::showCurrencySettings();
		$output['headerMainMenu'] = Core_CUserRegistration::showHeaderMainMenu();		
		$output['headertext'] = Core_CUserRegistration::showHeaderText();
		$output['result'] = $result;
		$output['headermenuhidden']= Core_CUserRegistration::showHeaderMenuHidden();
		$output['userLeftMenu'] = Display_DUserRegistration::showUserLeftMenu();	
		$output['lastviewedproducts']=Core_CLastViewedProducts::lastViewedProducts();			$output['cartcount']=Core_CAddCart::countCart();		
		$output['userRight'] = "userdashboard.html";					
		$output['rows']=Core_CUserAddressBook::showAddress();

		Bin_Template::createTemplate('userIndex.html',$output);

	}
	/**
	* This function is used to insert the  address 
 	*
 	* @return string
	*/
	function addAddress()
	{
		//language	
		include_once('classes/Core/CLanguage.php');
		Core_CLanguage::setLanguage('ADDRESS_BOOK');

		include('classes/Lib/CheckInputs.php');
		include('classes/Core/CUserAddressBook.php');
		
		include_once('classes/Core/CCurrencySettings.php');
		Core_CCurrencySettings::getDefaultCurrency();

		$obj = new Lib_CheckInputs('frmAddAddress');

		$result=Core_CUserAddressBook::addAddress();	

		$this->showAddAddress($result);

	}
	/**
	* This function is used to edit  address 
 	*
 	* @return string
	*/
	function editAddress()
	{
		//language	
		include_once('classes/Core/CLanguage.php');
		Core_CLanguage::setLanguage('ADDRESS_BOOK');
		
		include('classes/Lib/CheckInputs.php');
		include('classes/Core/CUserAddressBook.php');
		
		include_once('classes/Core/CCurrencySettings.php');
		Core_CCurrencySettings::getDefaultCurrency();

		$obj = new Lib_CheckInputs('frmAddAddress');

		$result=Core_CUserAddressBook::editAddress();	

		$this->showMyAddressBook($result);
	}
	/**
	* This function is used to delete  address 
 	*
 	* @return string
	*/
	function delAddress()
	{
		//language	
		include_once('classes/Core/CLanguage.php');
		Core_CLanguage::setLanguage('ADDRESS_BOOK');
		
		include('classes/Core/CUserAddressBook.php');
		
		include_once('classes/Core/CCurrencySettings.php');
		Core_CCurrencySettings::getDefaultCurrency();

		$result=Core_CUserAddressBook::delAddress();	
		$this->showMyAddressBook($result);
	}
	/**
	* This function is used to check  user login session  id
 	*
 	*
	*/
	function checkLogin()
	{
		if(!isset($_SESSION['user_id']))
		{
			header("Location:?do=login");
			exit;
		}
	}

	/**
	* This function is used to print the order details 
 	*
 	* @return string
	*/
	function printOrderDetails()
	{

		//language	
		include_once('classes/Core/CLanguage.php');
		Core_CLanguage::setLanguage('ORDER_DETAILS');

		include('classes/Core/CUserOrder.php');
		
		include_once('classes/Core/CCurrencySettings.php');
		Core_CCurrencySettings::getDefaultCurrency();

		Core_CUserOrder::printOrderDetail();	

	}
	/**
	* This function is used to show  the digital product for my downloads
 	*
 	* @return string
	*/
	function showDigitalProduct()
	{
		//language	
		include_once('classes/Core/CLanguage.php');
		Core_CLanguage::setLanguage('MY_DOWNLOADS');

		$this->checkLogin();	
		include('classes/Core/CKeywordSearch.php');
		include('classes/Display/DKeywordSearch.php');
		include('classes/Core/CUserRegistration.php');
		include('classes/Display/DUserRegistration.php');
		include_once('classes/Core/CUserWishList.php');
		include_once('classes/Core/CHome.php');
		include("classes/Lib/HandleErrors.php");
		include_once('classes/Core/CLastViewedProducts.php');
		include_once('classes/Display/DLastViewedProducts.php');
		include_once('classes/Core/CAddCart.php');
		include_once('classes/Core/CUserOrder.php');
		include_once('classes/Core/CCurrencySettings.php');
		Core_CCurrencySettings::getDefaultCurrency();
		
		Core_CUserWishList::Ulogin($Err);
		$output['val']=$Err->values;
		$output['msg']=$Err->messages;

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
		$output['headertext'] = Core_CUserRegistration::showHeaderText();
		$output['divStat']=Core_CUserWishList::getStatus();
		$output['headerMainMenu'] = Core_CUserRegistration::showHeaderMainMenu();
		$output['headermenuhidden']= Core_CUserRegistration::showHeaderMenuHidden();
		$output['userLeftMenu'] = Display_DUserRegistration::showUserLeftMenu();
		$output['currencysettings']=Core_CUserRegistration::showCurrencySettings();	
		$output['lastviewedproducts']=Core_CLastViewedProducts::lastViewedProducts();			$output['cartcount']=Core_CAddCart::countCart();	
		$output['userRight'] = "userdashboard.html";					
		$output['rows']=Core_CUserOrder::showDigitalProduct($result);

		
		Bin_Template::createTemplate('userIndex.html',$output);
	}
	/**
	* This function is used to  check and download digital product for my downloads
 	*
 	* @return string
	*/
	function CheckDigitalProduct()
	{
		//language	
		include_once('classes/Core/CLanguage.php');
		Core_CLanguage::setLanguage('MY_DOWNLOADS');

		$this->checkLogin();	
		include('classes/Core/CKeywordSearch.php');
		include('classes/Display/DKeywordSearch.php');
		include('classes/Core/CUserRegistration.php');
		include('classes/Display/DUserRegistration.php');
		include_once('classes/Core/CUserWishList.php');
		include_once('classes/Core/CHome.php');
		include("classes/Lib/HandleErrors.php");
		include_once('classes/Core/CLastViewedProducts.php');
		include_once('classes/Display/DLastViewedProducts.php');
		include_once('classes/Core/CAddCart.php');
		include_once('classes/Core/CUserOrder.php');
		include_once('classes/Core/CCurrencySettings.php');
		Core_CCurrencySettings::getDefaultCurrency();
		
		Core_CUserWishList::Ulogin($Err);
		$output['val']=$Err->values;
		$output['msg']=$Err->messages;

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
		$output['headertext'] = Core_CUserRegistration::showHeaderText();
		$output['divStat']=Core_CUserWishList::getStatus();
		$output['headerMainMenu'] = Core_CUserRegistration::showHeaderMainMenu();
		$output['headermenuhidden']= Core_CUserRegistration::showHeaderMenuHidden();
		$output['userLeftMenu'] = Display_DUserRegistration::showUserLeftMenu();
		$output['currencysettings']=Core_CUserRegistration::showCurrencySettings();	
		$output['lastviewedproducts']=Core_CLastViewedProducts::lastViewedProducts();			$output['cartcount']=Core_CAddCart::countCart();	
		$output['userRight'] = "userdashboard.html";					
		$output['rows']=Core_CUserOrder::CheckDigitalProduct($result);

		
		Bin_Template::createTemplate('userIndex.html',$output);
	}
}
?>