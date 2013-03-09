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
class Model_MUserAccount
{
	var $output = array();
	/**
	* This function is used to Show news letter page
 	*/
	function showNewsLetter($result='')
	{
		$this->checkLogin();
		include('classes/Core/CKeywordSearch.php');
		include('classes/Display/DKeywordSearch.php');
		include('classes/Core/CUserRegistration.php');
		include('classes/Display/DUserRegistration.php');
		include_once('classes/Core/CUserNewsLetter.php');
		include('classes/Core/CHome.php');
		include_once('classes/Core/CLastViewedProducts.php');
		include_once('classes/Display/DLastViewedProducts.php');
		
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

		$output['loginStatus'] = Core_CUserRegistration::loginStatus();
		$output['dropdowncat']=Core_CKeywordSearch::categoryDropDown();
		$output['headermenu'] = Core_CUserRegistration::showHeaderMenu();
		$output['headerMainMenu'] = Core_CUserRegistration::showHeaderMainMenu();		
		$output['headertext'] = Core_CUserRegistration::showHeaderText();
		$output['result'] = $result;
		$output['headerMainMenu'] = Core_CUserRegistration::showHeaderMainMenu();
		$output['userLeftMenu'] = Display_DUserRegistration::showUserLeftMenu();	
		$output['lastviewedproducts']=Core_CLastViewedProducts::lastViewedProducts();					
		$output['userRight'] = "userdashboard.html";					
		$output['rows']=Core_CUserNewsLetter::showNewsLetter();

		Bin_Template::createTemplate('userIndex.html',$output);
	}
	/**
	* This function is used to Show account dashboard after login
 	*/
	function showDashBoard()
	{
		$this->checkLogin();	
		include('classes/Core/CKeywordSearch.php');
		include('classes/Display/DKeywordSearch.php');
		include('classes/Core/CUserRegistration.php');
		include('classes/Display/DUserRegistration.php');
		include('classes/Core/CUserDashboard.php');
		include('classes/Core/CHome.php');
		include_once('classes/Core/CLastViewedProducts.php');
		include_once('classes/Display/DLastViewedProducts.php');
		
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
		
		$output['loginStatus'] = Core_CUserRegistration::loginStatus();
		$output['dropdowncat']=Core_CKeywordSearch::categoryDropDown();
		$output['headermenu'] = Core_CUserRegistration::showHeaderMenu();
		$output['headerMainMenu'] = Core_CUserRegistration::showHeaderMainMenu();
		$output['currencysettings']=Core_CUserRegistration::showCurrencySettings();
		$output['headertext'] = Core_CUserRegistration::showHeaderText();
		$output['userLeftMenu'] = Display_DUserRegistration::showUserLeftMenu();	
		$output['lastviewedproducts']=Core_CLastViewedProducts::lastViewedProducts();					
		$output['userRight'] = "userdashboard.html";					
		$output['rows']=Core_CUserDashboard::showDashboard();
		Bin_Template::createTemplate('userIndex.html',$output);
		
	}
	/**
	* This function is used to Show account information  after login
 	*/
	function showAccountInfo($result='')
	{
		$this->checkLogin();	
		include('classes/Core/CKeywordSearch.php');
		include('classes/Display/DKeywordSearch.php');
		include('classes/Core/CUserRegistration.php');
		include('classes/Display/DUserRegistration.php');
		include_once('classes/Core/CUserAccInfo.php');
		include('classes/Core/CHome.php');
		include_once('classes/Core/CLastViewedProducts.php');
		include_once('classes/Display/DLastViewedProducts.php');
		
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

		$output['loginStatus'] = Core_CUserRegistration::loginStatus();
		$output['dropdowncat']=Core_CKeywordSearch::categoryDropDown();
		$output['headerMainMenu'] = Core_CUserRegistration::showHeaderMainMenu();
		$output['headermenu'] = Core_CUserRegistration::showHeaderMenu();
		$output['headertext'] = Core_CUserRegistration::showHeaderText();
		$output['result'] = $result;					
		$output['userLeftMenu'] = Display_DUserRegistration::showUserLeftMenu();			
		$output['lastviewedproducts']=Core_CLastViewedProducts::lastViewedProducts();	
		$output['userRight'] = "userdashboard.html";					
		$output['rows']=Core_CUserAccInfo::showAccInfo();

		Bin_Template::createTemplate('userIndex.html',$output);
	
	}
	/**
	* This function is used to edit account information  after login
 	*/
	function editAccountInfo()
	{
		include('classes/Lib/CheckInputs.php');
		include('classes/Core/CUserAccInfo.php');
		
		include_once('classes/Core/CCurrencySettings.php');
		Core_CCurrencySettings::getDefaultCurrency();

		$obj = new Lib_CheckInputs('frmAcc');

		$result=Core_CUserAccInfo::updateAcc();	

		$this->showAccountInfo($result);
	}
	/**
	* This function is used to show  product review  after login
 	*/
	function showProductReview()
	{
		$this->checkLogin();	
		include('classes/Core/CKeywordSearch.php');
		include('classes/Display/DKeywordSearch.php');
		include('classes/Core/CUserRegistration.php');
		include('classes/Display/DUserRegistration.php');
		include('classes/Core/CUserProductReview.php');
		include('classes/Core/CHome.php');
		include_once('classes/Core/CLastViewedProducts.php');
		include_once('classes/Display/DLastViewedProducts.php');
		
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
		
		$output['loginStatus'] = Core_CUserRegistration::loginStatus();
		$output['dropdowncat']=Core_CKeywordSearch::categoryDropDown();
		$output['headermenu'] = Core_CUserRegistration::showHeaderMenu();
		$output['headerMainMenu'] = Core_CUserRegistration::showHeaderMainMenu();
		$output['headertext'] = Core_CUserRegistration::showHeaderText();
		$output['userLeftMenu'] = Display_DUserRegistration::showUserLeftMenu();			
		$output['lastviewedproducts']=Core_CLastViewedProducts::lastViewedProducts();	
		$output['userRight'] = "userdashboard.html";					
		$output['rows']=Core_CUserProductReview::showProductReview();

		Bin_Template::createTemplate('userIndex.html',$output);

	}
	/**
	* This function is used to show  product wishlist  after login
 	*/
	function showWishList($result='')
	{
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

		$output['loginStatus'] = Core_CUserRegistration::loginStatus();
		$output['dropdowncat']=Core_CKeywordSearch::categoryDropDown();
		$output['headermenu'] = Core_CUserRegistration::showHeaderMenu();
		$output['headertext'] = Core_CUserRegistration::showHeaderText();
		$output['divStat']=Core_CUserWishList::getStatus();
		$output['headerMainMenu'] = Core_CUserRegistration::showHeaderMainMenu();
		$output['userLeftMenu'] = Display_DUserRegistration::showUserLeftMenu();	
		$output['lastviewedproducts']=Core_CLastViewedProducts::lastViewedProducts();					
		$output['userRight'] = "userWishlist.html";					
		$output['rows']=Core_CUserWishList::showWishList($result);

		
		Bin_Template::createTemplate('userIndex.html',$output);
	}
	/**
	* This function is used to show  send wish list   after login
 	*/
	function sendWishlist()
	{
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
 	*/
	function showMyOrder()
	{
		$this->checkLogin();	
		include('classes/Core/CKeywordSearch.php');
		include('classes/Display/DKeywordSearch.php');
		include('classes/Core/CUserRegistration.php');
		include('classes/Display/DUserRegistration.php');
		include('classes/Core/CUserOrder.php');
		include('classes/Core/CHome.php');
		include_once('classes/Core/CLastViewedProducts.php');
		include_once('classes/Display/DLastViewedProducts.php');
		
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
		
		$output['loginStatus'] = Core_CUserRegistration::loginStatus();
		$output['dropdowncat']=Core_CKeywordSearch::categoryDropDown();
		$output['headermenu'] = Core_CUserRegistration::showHeaderMenu();
		$output['headertext'] = Core_CUserRegistration::showHeaderText();
		$output['userLeftMenu'] = Display_DUserRegistration::showUserLeftMenu();			
		$output['lastviewedproducts']=Core_CLastViewedProducts::lastViewedProducts();		
		$output['userRight'] = "userdashboard.html";					
		$output['rows']=Core_CUserOrder::showOrder();

		Bin_Template::createTemplate('userIndex.html',$output);
	
	}
	/**
	* This function is used to show  my order details page
 	*/
	function showOrderDetails()
	{
		$this->checkLogin();	
		include('classes/Core/CKeywordSearch.php');
		include('classes/Display/DKeywordSearch.php');
		include('classes/Core/CUserRegistration.php');
		include('classes/Display/DUserRegistration.php');
		include('classes/Core/CUserOrder.php');
		include('classes/Core/CHome.php');
		include_once('classes/Core/CLastViewedProducts.php');
		include_once('classes/Display/DLastViewedProducts.php');
		
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
		
		$output['loginStatus'] = Core_CUserRegistration::loginStatus();
		$output['dropdowncat']=Core_CKeywordSearch::categoryDropDown();
		$output['headermenu'] = Core_CUserRegistration::showHeaderMenu();
		$output['headertext'] = Core_CUserRegistration::showHeaderText();
		$output['userLeftMenu'] = Display_DUserRegistration::showUserLeftMenu();			
		$output['userRight'] = "userdashboard.html";					
		$output['rows']=Core_CUserOrder::showOrderDetails();
		$output['lastviewedproducts']=Core_CLastViewedProducts::lastViewedProducts();		

		Bin_Template::createTemplate('userIndex.html',$output);
	}
	/**
	* This function is used to show  all new product
 	*/
	function showAllNew()
	{
		include('classes/Core/CKeywordSearch.php');
		include('classes/Display/DKeywordSearch.php');
		include('classes/Core/CUserRegistration.php');
		include('classes/Display/DUserRegistration.php');
		include('classes/Core/CAllNew.php');
		include('classes/Core/CHome.php');
		include_once('classes/Core/CLastViewedProducts.php');
		include_once('classes/Display/DLastViewedProducts.php');
		
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
		
		$output['loginStatus'] = Core_CUserRegistration::loginStatus();
		$output['dropdowncat']=Core_CKeywordSearch::categoryDropDown();
		$output['headermenu'] = Core_CUserRegistration::showHeaderMenu();
		$output['headertext'] = Core_CUserRegistration::showHeaderText();
		//$output['userLeftMenu'] = Display_DUserRegistration::showUserLeftMenu();			
		$output['lastviewedproducts']=Core_CLastViewedProducts::lastViewedProducts();
		$output['userRight'] = "userdashboard.html";					
		$output['rows']=Core_CAllNew::showAllNew();

		Bin_Template::createTemplate('userIndex.html',$output);
	}
	/**
	* This function is used to show  all featured product
 	*/
	function showAllFeatured()
	{
		include('classes/Core/CKeywordSearch.php');
		include('classes/Display/DKeywordSearch.php');
		include('classes/Core/CUserRegistration.php');
		include('classes/Display/DUserRegistration.php');
		include('classes/Core/CAllFeatured.php');
		include('classes/Core/CHome.php');
		include_once('classes/Core/CLastViewedProducts.php');
		include_once('classes/Display/DLastViewedProducts.php');
		include('classes/Core/CCurrencySettings.php');
		
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
		
		$output['loginStatus'] = Core_CUserRegistration::loginStatus();
		$output['dropdowncat']=Core_CKeywordSearch::categoryDropDown();
		$output['headermenu'] = Core_CUserRegistration::showHeaderMenu();
		$output['headertext'] = Core_CUserRegistration::showHeaderText();
		//$output['userLeftMenu'] = Display_DUserRegistration::showUserLeftMenu();			
		$output['lastviewedproducts']=Core_CLastViewedProducts::lastViewedProducts();
		$output['userRight'] = "userdashboard.html";					
		$output['rows']=Core_CAllFeatured::showAllFeatured();

		Bin_Template::createTemplate('userIndex.html',$output);
	}
	/**
	* This function is used to show  my address book
 	*/
	function showMyAddressBook()
	{
		$this->checkLogin();
		include('classes/Core/CKeywordSearch.php');
		include('classes/Display/DKeywordSearch.php');
		include('classes/Core/CUserRegistration.php');
		include('classes/Display/DUserRegistration.php');
		include_once('classes/Core/CUserAddressBook.php');
		include('classes/Core/CHome.php');
		include_once('classes/Core/CLastViewedProducts.php');
		include_once('classes/Display/DLastViewedProducts.php');
		
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

		$output['loginStatus'] = Core_CUserRegistration::loginStatus();
		$output['dropdowncat']=Core_CKeywordSearch::categoryDropDown();
		$output['headermenu'] = Core_CUserRegistration::showHeaderMenu();
		$output['headerMainMenu'] = Core_CUserRegistration::showHeaderMainMenu();		
		$output['headertext'] = Core_CUserRegistration::showHeaderText();
		$output['result'] = $result;
		$output['headerMainMenu'] = Core_CUserRegistration::showHeaderMainMenu();
		$output['userLeftMenu'] = Display_DUserRegistration::showUserLeftMenu();	
		$output['lastviewedproducts']=Core_CLastViewedProducts::lastViewedProducts();					
		$output['userRight'] = "userdashboard.html";					
		$output['rows']=Core_CUserAddressBook::showAddressBook();

		Bin_Template::createTemplate('userIndex.html',$output);
	}
	/**
	* This function is used to show add  address book
 	*/
	function showAddAddress($result='')
	{
		$this->checkLogin();
		include('classes/Core/CKeywordSearch.php');
		include('classes/Display/DKeywordSearch.php');
		include('classes/Core/CUserRegistration.php');
		include('classes/Display/DUserRegistration.php');
		include_once('classes/Core/CUserAddressBook.php');
		include('classes/Core/CHome.php');
		include_once('classes/Core/CLastViewedProducts.php');
		include_once('classes/Display/DLastViewedProducts.php');
		
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

		$output['loginStatus'] = Core_CUserRegistration::loginStatus();
		$output['dropdowncat']=Core_CKeywordSearch::categoryDropDown();
		$output['headermenu'] = Core_CUserRegistration::showHeaderMenu();
		$output['headerMainMenu'] = Core_CUserRegistration::showHeaderMainMenu();		
		$output['headertext'] = Core_CUserRegistration::showHeaderText();
		$output['result'] = $result;
		$output['headerMainMenu'] = Core_CUserRegistration::showHeaderMainMenu();
		$output['userLeftMenu'] = Display_DUserRegistration::showUserLeftMenu();	
		$output['lastviewedproducts']=Core_CLastViewedProducts::lastViewedProducts();					

		$output['userRight'] = "userdashboard.html";					
		$output['rows']=Core_CUserAddressBook::showAddAddress();

		Bin_Template::createTemplate('userIndex.html',$output);

	}
	/**
	* This function is used to show add  address book
 	*/
	function showAddress()
	{
		$this->checkLogin();
		include('classes/Core/CKeywordSearch.php');
		include('classes/Display/DKeywordSearch.php');
		include('classes/Core/CUserRegistration.php');
		include('classes/Display/DUserRegistration.php');
		include_once('classes/Core/CUserAddressBook.php');
		include('classes/Core/CHome.php');
		include_once('classes/Core/CLastViewedProducts.php');
		include_once('classes/Display/DLastViewedProducts.php');
		
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

		$output['loginStatus'] = Core_CUserRegistration::loginStatus();
		$output['dropdowncat']=Core_CKeywordSearch::categoryDropDown();
		$output['headermenu'] = Core_CUserRegistration::showHeaderMenu();
		$output['headerMainMenu'] = Core_CUserRegistration::showHeaderMainMenu();		
		$output['headertext'] = Core_CUserRegistration::showHeaderText();
		$output['result'] = $result;
		$output['headerMainMenu'] = Core_CUserRegistration::showHeaderMainMenu();
		$output['userLeftMenu'] = Display_DUserRegistration::showUserLeftMenu();	
		$output['lastviewedproducts']=Core_CLastViewedProducts::lastViewedProducts();					
		$output['userRight'] = "userdashboard.html";					
		$output['rows']=Core_CUserAddressBook::showAddress();

		Bin_Template::createTemplate('userIndex.html',$output);

	}
	/**
	* This function is used to insert the  address 
 	*/
	function addAddress()
	{
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
 	*/
	function editAddress()
	{
		include('classes/Lib/CheckInputs.php');
		include('classes/Core/CUserAddressBook.php');
		
		include_once('classes/Core/CCurrencySettings.php');
		Core_CCurrencySettings::getDefaultCurrency();

		$obj = new Lib_CheckInputs('frmAddAddress');

		$result=Core_CUserAddressBook::editAddress();	

		$this->showAddAddress($result);
	}
	/**
	* This function is used to delete  address 
 	*/
	function delAddress()
	{
		include('classes/Core/CUserAddressBook.php');
		
		include_once('classes/Core/CCurrencySettings.php');
		Core_CCurrencySettings::getDefaultCurrency();

		$result=Core_CUserAddressBook::delAddress();	
		$this->showMyAddressBook();
	}
	
	function checkLogin()
	{
		if(!isset($_SESSION['user_id']))
		{
			header("Location:?do=login");
			exit;
		}
	}

}
?>