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
 * User registration  related  class
 *
 * @package   		Model_MUserRegistration
 * @category    	Model
 * @author    		AJ Square Inc Dev Team
 * @link   		http://www.zeuscart.com
  * @copyright 	        Copyright (c) 2008 - 2013, AJ Square, Inc.
 * @version   		Version 4.0
 */

class Model_MUserRegistration
{
	/**
	 * Stores the output 
	 *
	 * @var array 
	 */	
	var $output = array();



	

	/**
	* This function is used to registeration  page
 	*
 	* @return string
	*/
	function displayRegPage()
	{

		//language	
		include_once('classes/Core/CLanguage.php');
		Core_CLanguage::setLanguage('REGISTER');

		include('classes/Core/CUserRegistration.php');
		include("classes/Lib/HandleErrors.php");	

		$output['val']=Core_CUserRegistration::getCountry($Err->values);
		$output['msg']=$Err->messages;
		include_once('classes/Display/DUserRegistration.php');
		include('classes/Core/CKeywordSearch.php');
  		include('classes/Display/DKeywordSearch.php');
		include('classes/Core/CWishList.php');		
		include('classes/Core/CHome.php');
		include_once('classes/Core/CLastViewedProducts.php');
		include_once('classes/Display/DLastViewedProducts.php');
		include('classes/Core/CNews.php');
		include('classes/Display/DNews.php');
		include_once('classes/Core/CAddCart.php');		
		include_once('classes/Core/CCurrencySettings.php');
		Core_CCurrencySettings::getDefaultCurrency();
		
		$output['categories'] = Display_DUserRegistration::showMainCat();
		$output['signup']=Display_DUserRegistration::signUp();
		$default=new Core_CLastViewedProducts();
		$output['lastviewedproducts']=$default->lastViewedProducts();
		$output['headermenu'] = Core_CUserRegistration::showHeaderMenu();
		$output['headerMainMenu'] = Core_CUserRegistration::showHeaderMainMenu();
		$output['headermenuhidden']= Core_CUserRegistration::showHeaderMenuHidden();
		$output['headertext'] = Core_CUserRegistration::showHeaderText();
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
		$output['cartcount']=Core_CAddCart::countCart();
		$output['dropdowncat']=Core_CKeywordSearch::categoryDropDown();
		$output['loginStatus'] = Core_CUserRegistration::loginStatus();
		$output['newstitle'] = Core_CNews::showNewsMenu();
		$output['cartcount']=Core_CAddCart::countCart();
		
		Bin_Template::createTemplate('signup.html',$output);
	}
	/**
	* This function is used to validate registeration  page
 	*
 	* @return string
	*/
	function showValidateRegPage()
	{

		//language	
		include_once('classes/Core/CLanguage.php');
		Core_CLanguage::setLanguage('REGISTER');
		
		include('classes/Lib/CheckInputs.php');
		$obj = new Lib_CheckInputs('register');
		
		include('classes/Core/CUserRegistration.php');
		include_once('classes/Display/DUserRegistration.php');
		include('classes/Core/CKeywordSearch.php');
  		include('classes/Display/DKeywordSearch.php');
		include('classes/Core/CHome.php');
		include_once('classes/Core/CLastViewedProducts.php');
		include_once('classes/Display/DLastViewedProducts.php');
		include_once('classes/Core/CAddCart.php');		
		include_once('classes/Core/CCurrencySettings.php');
		Core_CCurrencySettings::getDefaultCurrency();
		
		$output['categories'] = Display_DUserRegistration::showMainCat();
		$output['signup']=Display_DUserRegistration::signUp();
		$default=new Core_CLastViewedProducts();
		$output['lastviewedproducts']=$default->lastViewedProducts();
		$output['headermenu'] = Core_CUserRegistration::showHeaderMenu();
		$output['headerMainMenu'] = Core_CUserRegistration::showHeaderMainMenu();
		$output['headermenuhidden']= Core_CUserRegistration::showHeaderMenuHidden();
		$output['headertext'] = Core_CUserRegistration::showHeaderText();
		$output['timezone']=Core_CHome::setTimeZone();
		$output['googleanalytics']=Core_CHome::getGoogleAnalyticsCode();
		$output['googlead']=Core_CHome::getGoogleAd();
		$output['footer']=Core_CHome::footer();
		$output['footerconnect']=Core_CHome::getfooterconnect();
		$output['sociallink']=Core_CHome::showSocialLinks();
		$output['sitelogo']=Core_CHome::getLogo();
		$output['pagetitle']=Core_CHome::pageTitle();
		$output['skinname']=Core_CHome::skinName();
		$output['dropdowncat']=Core_CKeywordSearch::categoryDropDown();
		$output['account'] = Core_CUserRegistration::addAccount();
		$output['val']=Core_CUserRegistration::getCountry($Err->values);
		$output['loginStatus']= Core_CUserRegistration::loginStatus();
		$output['cartcount']=Core_CAddCart::countCart();

		Bin_Template::createTemplate('signup.html',$output);
	}


	/**
	* This function is used to confirm the register
 	*
 	* @return string
	*/
	function registerConfirm()
	{
		include('classes/Core/CUserRegistration.php');
		Core_CUserRegistration::registerConfirm();	

	}
	
	/**
	* This function is used to show index  page
 	*
 	* @return string
	*/
	function showIndexPage()
	{

		//language	
		include_once('classes/Core/CLanguage.php');
		Core_CLanguage::setLanguage('HOME');


		include_once('classes/Core/CFeaturedItems.php');
		include_once('classes/Display/DFeaturedItems.php');
		include('classes/Core/CUserRegistration.php');
		include('classes/Display/DUserRegistration.php');
		include_once('classes/Core/CNewProducts.php');
		include_once('classes/Display/DNewProducts.php');
		include('classes/Core/CWishList.php');
		include('classes/Display/DWishList.php');
		include('classes/Core/CKeywordSearch.php');
  		include('classes/Display/DKeywordSearch.php');
		include('classes/Core/CHome.php');
		include('classes/Core/CAddCart.php');
		include('classes/Display/DAddCart.php');
		include('classes/Lib/TagClouds.php');
		include('classes/Core/CTagClouds.php');
		include('classes/Core/CCurrencySettings.php');
		include('classes/Core/CNews.php');
		include('classes/Display/DNews.php');
		include('classes/Core/CProductDetail.php');
		include('classes/Display/DProductDetail.php');
		include_once('classes/Core/CCurrencySettings.php');

		Core_CCurrencySettings::getDefaultCurrency();

		global $install_error;
		$output['install_error']=$install_error ;
		

		$output['sitelogo']=Core_CHome::getLogo();
		$output['pagetitle']=Core_CHome::pageTitle();
		$output['timezone']=Core_CHome::setTimeZone();	
		$output['currentDate']=date('D,M d,Y - h:i A');
		$output['skinname']=Core_CHome::skinName();

		$output['banner']=Core_CHome::getBanner();

		$output['googleanalytics']=Core_CHome::getGoogleAnalyticsCode();
		$output['googlead']=Core_CHome::getGoogleAd();
		$output['homepageads']= Core_CHome::showHomePageAds();
		$output['homepagecontent']= Core_CHome::showHomePageContent();
		$output['footer']=Core_CHome::footer();
		$output['footerconnect']=Core_CHome::getfooterconnect();
		$output['sociallink']=Core_CHome::showSocialLinks();
		$output['dropdowncat']=Core_CKeywordSearch::categoryDropDown();
		$output['cartSnapShot'] = Core_CAddCart::cartSnapShot();

		include_once('classes/Core/CLastViewedProducts.php');
		include_once('classes/Display/DLastViewedProducts.php');
	
		
		$output['signup']=Display_DUserRegistration::signUp();
		$default=new Core_CLastViewedProducts();
		$output['lastviewedproducts']=$default->lastViewedProducts();
		$default=new Core_CFeaturedItems();
		$output['maincatimage']=$default->showMainCategory();
		$output['allfeaturedproducts']=$default->featuredProducts();
		$output['allfeaturedproductshidden']=$default->featuredProductsHidden();
		$output['newarrivalproducts']=$default->newArrivalProducts();
		$output['showBestSellingProducts']=$default->showBestSellingProducts();
		
		$default=new Core_CNewProducts();
		$output['newproducts']=$default->newProducts();
		$output['allnewproduct']=$default->showAllNewProducts();
		if($_SESSION['user_id']!='')
			$output['wishlistsnapshot'] = Core_CWishList::snapshotForHome();
			
		$output['tagClouds']=Core_CTagClouds::displayTagClouds();
		$output['loginStatus']= Core_CUserRegistration::loginStatus();

		$output['headermenu'] = Core_CUserRegistration::showHeaderMenu();
		$output['headertext'] = Core_CUserRegistration::showHeaderText();
		$output['headerMainMenu'] = Core_CUserRegistration::showHeaderMainMenu();

		$output['categories'] = Display_DUserRegistration::showMainCat();
		$output['newstitle'] = Core_CNews::showNewsMenu();

		if($_SESSION['compareProductId']=='')
			$output['viewProducts']['viewProducts'] = Display_DWishList::viewProductElse();
		else
			$output['viewProducts']=Core_CWishList::addtoCompareProduct();

		$output['slideshow']=Core_CUserRegistration::viewSlideShow();
		$output['slideshowparameter']=Core_CUserRegistration::getSlideShowParameter();
		$output['currencysettings']=Core_CUserRegistration::showCurrencySettings();
		$output['cartcount']=Core_CAddCart::countCart();
		$output['productdetails']=Core_CProductDetail::showPopupProducts();
		$output['headermenuhidden']= Core_CUserRegistration::showHeaderMenuHidden();
		

		Bin_Template::createTemplate('index.html',$output);
	}
	/**
	* This function is used to logout process
 	*
 	* @return string
	*/
	function logoutStatus()
	{


		//language	
		include_once('classes/Core/CLanguage.php');
		Core_CLanguage::setLanguage('HOME');
		unset($_SESSION['user_id']);
		unset($_SESSION['user_name']);	
		unset($_SESSION['user_email']);	
		unset($_SESSION['compareProductId']);
		unset($_SESSION['LastViewed']);
		unset($_SESSION['url']);
		unset($_SESSION['RequestUrl']);
		include_once('classes/Core/CFeaturedItems.php');
		include_once('classes/Display/DFeaturedItems.php');
		include('classes/Core/CUserRegistration.php');
		include('classes/Display/DUserRegistration.php');
		include_once('classes/Core/CNewProducts.php');
		include_once('classes/Display/DNewProducts.php');
		include('classes/Core/CWishList.php');
		include('classes/Display/DWishList.php');
		include('classes/Core/CKeywordSearch.php');
  		include('classes/Display/DKeywordSearch.php');
		include_once('classes/Core/CCurrencySettings.php');
		$output['dropdowncat']=Core_CKeywordSearch::categoryDropDown();
		include('classes/Core/CHome.php');
		include('classes/Core/CAddCart.php');
		include('classes/Display/DAddCart.php');
		
		include_once('classes/Core/CCurrencySettings.php');
		Core_CCurrencySettings::getDefaultCurrency();
		
		$output['signup']=Display_DUserRegistration::signUp();
		$output['cartSnapShot'] = Core_CAddCart::cartSnapShot();
		$output['sitelogo']=Core_CHome::getLogo();
		$output['pagetitle']=Core_CHome::pageTitle();
		$output['skinname']=Core_CHome::skinName();
		$output['googlead']=Core_CHome::getGoogleAd();
		$output['footerconnect']=Core_CHome::getfooterconnect();
		$output['sociallink']=Core_CHome::showSocialLinks();
		$output['timezone']=Core_CHome::setTimeZone();	
		$output['currentDate']=date('D,M d,Y - h:i A');
		$output['banner']=Core_CHome::getBanner();
		include('classes/Lib/TagClouds.php');
		include('classes/Core/CTagClouds.php');
		$output['tagClouds']=Core_CTagClouds::displayTagClouds();
		$output['footer']=Core_CHome::footer();	
		$output['footerconnect']=Core_CHome::getfooterconnect();
		$output['googleanalytics']=Core_CHome::getGoogleAnalyticsCode();
		include_once('classes/Core/CLastViewedProducts.php');
		include_once('classes/Display/DLastViewedProducts.php');
		
		
		$default=new Core_CLastViewedProducts();
		$output['lastviewedproducts']=$default->lastViewedProducts();
		$default=new Core_CFeaturedItems();
		$output['maincat']=$default->showMainCategory();
		$output['maincatimage']=$default->showMainCategory();
		$output['categories'] = Display_DUserRegistration::showMainCat();
		$output['allfeaturedproducts']=$default->featuredProducts();
		$output['newarrivalproducts']=$default->newArrivalProducts();
		$default=new Core_CNewProducts();
		$output['newproducts']=$default->newProducts();
		if($_SESSION['user_id']!='')
			$output['wishlistsnapshot'] = Core_CWishList::wishlistSnapshot();
		$output['loginStatus']= Core_CUserRegistration::logoutStatus();
		$output['slideshow']=Core_CUserRegistration::viewSlideShow();
		$output['slideshowparameter']=Core_CUserRegistration::getSlideShowParameter();
		$output['headermenu'] = Core_CUserRegistration::showHeaderMenu();
		$output['headerMainMenu'] = Core_CUserRegistration::showHeaderMainMenu();
		$output['headertext'] = Core_CUserRegistration::showHeaderText();
		$output['cartcount']=Core_CAddCart::countCart();
		$output['viewProducts']['viewProducts'] = Display_DWishList::viewProductElse();
		$output['headermenuhidden']= Core_CUserRegistration::showHeaderMenuHidden();
		Bin_Template::createTemplate('index.html',$output);
	}
	/**
	* This function is used to show login  page
 	*
 	* @return string
	*/
	function showLoginPage()
	{

		//language	
		include_once('classes/Core/CLanguage.php');
		Core_CLanguage::setLanguage('LOGIN');


		include("classes/Lib/HandleErrors.php");
		$output['val']=$Err->values;
		$output['msg']=$Err->messages;
		
		include('classes/Core/CUserRegistration.php');
		include('classes/Display/DUserRegistration.php');
		include('classes/Core/CKeywordSearch.php');
  		include('classes/Display/DKeywordSearch.php');
		include_once('classes/Core/CCurrencySettings.php');
		include_once('classes/Core/CAddCart.php');
		include_once('classes/Core/CCurrencySettings.php');
		Core_CCurrencySettings::getDefaultCurrency();
		
		$output['signup']=Display_DUserRegistration::signUp();
		$output['loginStatus']= Core_CUserRegistration::loginStatus();
		$output['headermenu'] = Core_CUserRegistration::showHeaderMenu();
		$output['headerMainMenu'] = Core_CUserRegistration::showHeaderMainMenu();
		$output['headertext'] = Core_CUserRegistration::showHeaderText();
		$output['dropdowncat']=Core_CKeywordSearch::categoryDropDown();
		include('classes/Core/CHome.php');
		$output['sitelogo']=Core_CHome::getLogo();
		$output['pagetitle']=Core_CHome::pageTitle();
		$output['skinname']=Core_CHome::skinName();
		$output['sociallink']=Core_CHome::showSocialLinks();
		$output['cartcount']=Core_CAddCart::countCart();	
		$output['timezone']=Core_CHome::setTimeZone();	
		$output['footerconnect']=Core_CHome::getfooterconnect();
		$output['currentDate']=date('D,M d,Y - h:i A');
		$output['googlead']=Core_CHome::getGoogleAd();
		$output['headermenuhidden']= Core_CUserRegistration::showHeaderMenuHidden();
		if($_COOKIE['usremail']!='')
		{
			$output['val']['txtemail'] = $_COOKIE['usremail'];
			
		}
               
		Bin_Template::createTemplate('login.html',$output);
	}
	/**
	* This function is used to validate the  login  page
 	*
 	* @return string
	*/
	function showValidateLoginPage()
	{

		//language	
		include_once('classes/Core/CLanguage.php');
		Core_CLanguage::setLanguage('DASHBOARD');

		include('classes/Lib/CheckInputs.php');
		$obj = new Lib_CheckInputs('validatelogin');

		if(isset($_SESSION['RequestUrl']))
		{
			$url = $_SESSION['RequestUrl'];
			header("Location:".$url);
		}
			include('classes/Core/CKeywordSearch.php');
  			include('classes/Display/DKeywordSearch.php');
			include('classes/Core/CUserRegistration.php');
			include('classes/Display/DUserRegistration.php');
			include('classes/Core/CWishList.php');
			include('classes/Display/DWishList.php');
			include_once('classes/Core/CFeaturedItems.php');
			include_once('classes/Display/DFeaturedItems.php');
			include_once('classes/Core/CNewProducts.php');
			include_once('classes/Display/DNewProducts.php');
			include('classes/Core/CHome.php');
			include('classes/Core/CAddCart.php');
			include('classes/Display/DAddCart.php');
			include('classes/Core/CUserDashboard.php');	
			include_once('classes/Core/CCurrencySettings.php');	
			
			include_once('classes/Core/CCurrencySettings.php');
			Core_CCurrencySettings::getDefaultCurrency();
		
			$output['signup']=Display_DUserRegistration::signUp();
			$output['cartSnapShot'] = Core_CAddCart::cartSnapShot();
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
			include_once('classes/Core/CLastViewedProducts.php');
			include_once('classes/Display/DLastViewedProducts.php');
			
			$default=new Core_CLastViewedProducts();
			$output['lastviewedproducts']=$default->lastViewedProducts();
			$default=new Core_CFeaturedItems();
		
			$output['maincatimage']=$default->showMainCategory();
			$output['allfeaturedproducts']=$default->featuredProducts();
			if($_SESSION['compareProductId']=='')
			{
				
				$output['viewProducts']['viewProducts'] = Display_DWishList::viewProductElse();
			}
			else
				$output['viewProducts']=Core_CWishList::addtoCompareProduct();
			$default=new Core_CNewProducts();
			$output['newproducts']=$default->newProducts();
			$output['wishlistsnapshot'] = Core_CWishList::wishlistSnapshot();
			$output['loginStatus'] = Core_CUserRegistration::loginStatus();
			$output['dropdowncat']=Core_CKeywordSearch::categoryDropDown();
			$output['cartcount']=Core_CAddCart::countCart();
			$output['headermenu'] = Core_CUserRegistration::showHeaderMenu();
			$output['headermenuhidden']= Core_CUserRegistration::showHeaderMenuHidden();
			$output['headertext'] = Core_CUserRegistration::showHeaderText();
			$output['headerMainMenu'] = Core_CUserRegistration::showHeaderMainMenu();
			$output['userLeftMenu'] = Display_DUserRegistration::showUserLeftMenu();			
			$output['userRight'] = "userdashboard.html";					
			$output['rows']=Core_CUserDashboard::showDashboard();
		
			Bin_Template::createTemplate('userIndex.html',$output);
	}
	/**
	* This function is used to display the forgot password  page
 	*
 	* @return string
	*/
	function displayForgetpwdPage()
	{

		
		//language	
		include_once('classes/Core/CLanguage.php');
		Core_CLanguage::setLanguage('FORGOT_PASSWORD');

		include("classes/Lib/HandleErrors.php");
		
		$output['val']=$Err->values;
		$output['msg']=$Err->messages;
		include('classes/Core/CUserRegistration.php');
		include('classes/Display/DUserRegistration.php');
		include('classes/Core/CKeywordSearch.php');
  		include('classes/Display/DKeywordSearch.php');
		include('classes/Core/CWishList.php');
		include('classes/Core/CHome.php');
		include_once('classes/Core/CLastViewedProducts.php');
		include_once('classes/Display/DLastViewedProducts.php');
		include('classes/Core/CNews.php');
		include('classes/Display/DNews.php');
		include('classes/Core/CProductDetail.php');
		include('classes/Display/DProductDetail.php');
		include_once('classes/Core/CCurrencySettings.php');
		include_once('classes/Core/CAddCart.php');
		Core_CCurrencySettings::getDefaultCurrency();
		
		$output['signup']=Display_DUserRegistration::signUp();
		$default=new Core_CLastViewedProducts();
		$output['lastviewedproducts']=$default->lastViewedProducts();
		$output['headermenu'] = Core_CUserRegistration::showHeaderMenu();
		$output['headermenuhidden']= Core_CUserRegistration::showHeaderMenuHidden();
		$output['headerMainMenu'] = Core_CUserRegistration::showHeaderMainMenu();
		$output['headertext'] = Core_CUserRegistration::showHeaderText();
		$output['sitelogo']=Core_CHome::getLogo();
		$output['pagetitle']=Core_CHome::pageTitle();
		$output['skinname']=Core_CHome::skinName();
		$output['cartcount']=Core_CAddCart::countCart();
		$output['footerconnect']=Core_CHome::getfooterconnect();
		$output['sociallink']=Core_CHome::showSocialLinks();
		$output['timezone']=Core_CHome::setTimeZone();	
		$output['currentDate']=date('D,M d,Y - h:i A');
		$output['googlead']=Core_CHome::getGoogleAd();
		$output['dropdowncat']=Core_CKeywordSearch::categoryDropDown();
		$output['loginStatus'] = Core_CUserRegistration::loginStatus();
		$output['categories'] = Display_DUserRegistration::showMainCat();
		$output['newstitle'] = Core_CNews::showNewsMenu();
		$output['categorytree'] = Core_CProductDetail::showCategoryTree();
		Bin_Template::createTemplate('forgotpassword.html',$output);
	}
	/**
	* This function is used to display  the retrieveforget password  page
 	*
 	* @return string
	*/
	function retrivePwdPage()
	{

		//language	
		include_once('classes/Core/CLanguage.php');
		Core_CLanguage::setLanguage('FORGOT_PASSWORD');

		include('classes/Lib/CheckInputs.php');
		$obj = new Lib_CheckInputs('validatemail');
		
		include('classes/Core/CUserRegistration.php');
		include('classes/Display/DUserRegistration.php');
		include('classes/Core/CKeywordSearch.php');
  		include('classes/Display/DKeywordSearch.php');
		include('classes/Core/CHome.php');
		include('classes/Core/CWishList.php');		
		include_once('classes/Core/CLastViewedProducts.php');
		include_once('classes/Display/DLastViewedProducts.php');
		include('classes/Core/CNews.php');
		include('classes/Display/DNews.php');		
		include('classes/Core/CProductDetail.php');
		include('classes/Display/DProductDetail.php');
		include_once('classes/Core/CAddCart.php');
		include_once('classes/Core/CCurrencySettings.php');
		Core_CCurrencySettings::getDefaultCurrency();
		
		$output['signup']=Display_DUserRegistration::signUp();
		$default=new Core_CLastViewedProducts();
		$output['lastviewedproducts']=$default->lastViewedProducts();
		$output['headermenu'] = Core_CUserRegistration::showHeaderMenu();
		$output['headermenuhidden']= Core_CUserRegistration::showHeaderMenuHidden();
		$output['headerMainMenu'] = Core_CUserRegistration::showHeaderMainMenu();
		$output['headertext'] = Core_CUserRegistration::showHeaderText();
		$output['sitelogo']=Core_CHome::getLogo();
		$output['pagetitle']=Core_CHome::pageTitle();
		$output['skinname']=Core_CHome::skinName();
		$output['googlead']=Core_CHome::getGoogleAd();
		$output['footerconnect']=Core_CHome::getfooterconnect();
		$output['sociallink']=Core_CHome::showSocialLinks();
		$output['cartcount']=Core_CAddCart::countCart();
		$output['timezone']=Core_CHome::setTimeZone();	
		$output['currentDate']=date('D,M d,Y - h:i A');
		$output['dropdowncat']=Core_CKeywordSearch::categoryDropDown();
		$output['result'] = Core_CUserRegistration::getPassword();
		$output['categories'] = Display_DUserRegistration::showMainCat();
		$output['loginStatus'] = Core_CUserRegistration::loginStatus();
		$output['newstitle'] = Core_CNews::showNewsMenu();	
		$output['categorytree'] = Core_CProductDetail::showCategoryTree();
		Bin_Template::createTemplate('forgotpassword.html',$output);
	}
	/**
	* This function is used to display  new letter subscription  page
 	*
 	* @return string
	*/
	function addNewsletterSubscription()
	{

		//language	
		include_once('classes/Core/CLanguage.php');
		Core_CLanguage::setLanguage('HOME');

		include_once('classes/Core/CFeaturedItems.php');
		include_once('classes/Display/DFeaturedItems.php');
		include('classes/Core/CUserRegistration.php');
		include('classes/Display/DUserRegistration.php');
		include_once('classes/Core/CNewProducts.php');
		include_once('classes/Display/DNewProducts.php');
		include('classes/Core/CWishList.php');
		include('classes/Display/DWishList.php');
		include('classes/Core/CKeywordSearch.php');
  		include('classes/Display/DKeywordSearch.php');
		include('classes/Core/CAddCart.php');
		include('classes/Display/DAddCart.php');
		include_once('classes/Core/CLastViewedProducts.php');
		include_once('classes/Display/DLastViewedProducts.php');
		include_once('classes/Core/CLastViewedProducts.php');
		include_once('classes/Display/DLastViewedProducts.php');
		
		
		include_once('classes/Core/CCurrencySettings.php');
		Core_CCurrencySettings::getDefaultCurrency();
		
		$default=new Core_CFeaturedItems();
		$output['maincatimage']=$default->showMainCategory();
		$output['allfeaturedproducts']=$default->featuredProducts();
		$output['showBestSellingProducts']=$default->showBestSellingProducts();

		$output['signup']=Display_DUserRegistration::signUp();
		$default=new Core_CLastViewedProducts();
		$output['lastviewedproducts']=$default->lastViewedProducts();
		$default=new Core_CLastViewedProducts();
		$output['lastviewedproducts']=$default->lastViewedProducts();
		$output['cartSnapShot'] = Core_CAddCart::cartSnapShot();
		include('classes/Core/CHome.php');
		$output['sitelogo']=Core_CHome::getLogo();
		$output['pagetitle']=Core_CHome::pageTitle();
		$output['skinname']=Core_CHome::skinName();
		$output['timezone']=Core_CHome::setTimeZone();	
		$output['homepageads']= Core_CHome::showHomePageAds();
		$output['homepagecontent']= Core_CHome::showHomePageContent();
		
		$output['currentDate']=date('D,M d,Y - h:i A');
		$output['banner']=Core_CHome::getBanner();
		$output['categories'] = Display_DUserRegistration::showMainCat();		
		$output['googleanalytics']=Core_CHome::getGoogleAnalyticsCode();
		$output['googlead']=Core_CHome::getGoogleAd();
		$output['footer']=Core_CHome::footer();
		$output['footerconnect']=Core_CHome::getfooterconnect();
		$output['sociallink']=Core_CHome::showSocialLinks();
		$output['dropdowncat']=Core_CKeywordSearch::categoryDropDown();
		$output['cartcount']=Core_CAddCart::countCart();
		$default=new Core_CFeaturedItems();
		$output['maincatimage']=$default->showMainCategory();
		$output['newarrivalproducts']=$default->newArrivalProducts();
		if($_SESSION['compareProductId']=='')
		{
			
			$output['viewProducts']['viewProducts'] = Display_DWishList::viewProductElse();
		}
		else
			$output['viewProducts']=Core_CWishList::addtoCompareProduct();
		
		$default=new Core_CNewProducts();
		$output['newproducts']=$default->newProducts();
		if($_SESSION['user_id']!='')
		$output['wishlistsnapshot'] = Core_CWishList::snapshotForHome();
		$output['loginStatus'] = Core_CUserRegistration::loginStatus();
		$output['headermenu'] = Core_CUserRegistration::showHeaderMenu();
		$output['headermenuhidden']= Core_CUserRegistration::showHeaderMenuHidden();
		$output['headerMainMenu'] = Core_CUserRegistration::showHeaderMainMenu();
		$output['headertext'] = Core_CUserRegistration::showHeaderText();
		$output['slideshow']=Core_CUserRegistration::viewSlideShow();
		$output['slideshowparameter']=Core_CUserRegistration::getSlideShowParameter();
		$output['newsletter'] = Core_CUserRegistration::addNewsletterSubscription();
		Bin_Template::createTemplate('index.html',$output);
	}
	/**
	* This function is used to register the user from facebook
 	* @param array $me
 	* @return bool
	*/
	function autoRegister($me)
    	{

		include('../../../classes/Core/CUserRegistration.php');
		$objUser = new Core_CUserRegistration();
		$objUser->autoRegister($me);
   	}
	/**
	* This function is used to register the user from twitter
 	* 
 	* @return bool
	*/
	function twitterRegister()
    	{

		$sess = $_SESSION['twitter_user_info']->name;
		$me = $_POST['email'];
		include('classes/Core/CUserRegistration.php');
		$objUser = new Core_CUserRegistration();
		$objUser->twitterRegister($me,$sess);
		
    	}
	/**
	* This function is used to register the user from google
 	* 
 	* @return bool
	*/
	function googleautoRegister($me)
	{

		include('../../../../classes/Core/CUserRegistration.php');
		$objUser = new Core_CUserRegistration();
		$objUser->googleautoRegister($me);
	}

	
}
?>