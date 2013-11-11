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
 * Wish list  related  class
 *
 * @package   		Model_MWishList
 * @category    	Model
 * @author    		AJ Square Inc Dev Team
 * @link   		http://www.zeuscart.com
 * @copyright 	        Copyright (c) 2008 - 2013, AJ Square, Inc.
 * @version   		Version 4.0
 */

class Model_MWishList
{
	/**
	 * Stores the output 
	 *
	 * @var array 
	 */	
	var $output = array();
	/**
	* This function is used to display  add wishlist  page
 	*
 	* @return string
	*/	
	function addtoWishList()
	{
		
		if(!isset($_SESSION['user_id']))
		{
			$prodid = $_GET['prodid'];
			$_SESSION['RequestUrl'] = '?do=wishlist&action=viewwishlist&prodid='.$prodid;
			header("Location:?do=login");
		}
		else
		{
		include('classes/Display/DWishList.php');
		include('classes/Core/CWishList.php');	
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
		$output['result']=$result;
		$output['loginStatus'] = Core_CUserRegistration::loginStatus();
		$output['dropdowncat']=Core_CKeywordSearch::categoryDropDown();
		$output['headermenu'] = Core_CUserRegistration::showHeaderMenu();
		$output['headertext'] = Core_CUserRegistration::showHeaderText();
		$output['divStat']=Core_CUserWishList::getStatus();
		$output['headerMainMenu'] = Core_CUserRegistration::showHeaderMainMenu();
		$output['headermenuhidden']= Core_CUserRegistration::showHeaderMenuHidden();
		$output['userLeftMenu'] = Display_DUserRegistration::showUserLeftMenu();	
		$output['lastviewedproducts']=Core_CLastViewedProducts::lastViewedProducts();					
		$output['userRight'] = "userWishlist.html";		
		$default = new Core_CWishList();
		$output['message'] = $default->addtoWishList();			
		$output['rows']=Core_CUserWishList::showWishList();
		$output['cartcount']=Core_CAddCart::countCart();
		
		Bin_Template::createTemplate('userIndex.html',$output);
	
				
		}
	}
	
	/**
	* This function is used to display  delete wishlist  page
 	*
 	* @return string
	*/
	function deletefromWishList()
	{
				
		if(!isset($_SESSION['user_id']))
		{
			$prodid = $_GET['prodid'];
			$_SESSION['RequestUrl'] = '?do=wishlist&action=viewwishlist&prodid='.$prodid;
			header("Location:?do=login");
		}
		else
		{
		include('classes/Display/DWishList.php');
		include('classes/Core/CWishList.php');	
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
		$output['result']=$result;
		$output['loginStatus'] = Core_CUserRegistration::loginStatus();
		$output['dropdowncat']=Core_CKeywordSearch::categoryDropDown();
		$output['headermenu'] = Core_CUserRegistration::showHeaderMenu();
		$output['headertext'] = Core_CUserRegistration::showHeaderText();
		$output['divStat']=Core_CUserWishList::getStatus();
		$output['headerMainMenu'] = Core_CUserRegistration::showHeaderMainMenu();
		$output['headermenuhidden']= Core_CUserRegistration::showHeaderMenuHidden();
		$output['userLeftMenu'] = Display_DUserRegistration::showUserLeftMenu();	
		$output['lastviewedproducts']=Core_CLastViewedProducts::lastViewedProducts();					
		$output['userRight'] = "userWishlist.html";		
		$default = new Core_CWishList();
		$output['message'] = $default->deletefromWishList();			
		$output['rows']=Core_CUserWishList::showWishList();
		$output['cartcount']=Core_CAddCart::countCart();
		
		Bin_Template::createTemplate('userIndex.html',$output);
	
				
		}
	}
	/**
	* This function is used to display  view wishlist  page
 	*
 	* @return string
	*/
	function viewWishList()
	{	
		
		if(!isset($_SESSION['user_id']))
		{
			$_SESSION['RequestUrl'] = '?do=wishlist&action=showwishlist';
			header("Location:?do=login");
		}
		else
		{
			include_once('classes/Core/CWishList.php');
			include_once('classes/Display/DWishList.php');
			include_once('classes/Core/CUserRegistration.php');
			include_once('classes/Display/DUserRegistration.php');
			include_once('classes/Core/CNewProducts.php');
			include_once('classes/Display/DNewProducts.php');
			include_once('classes/Core/CAddCart.php');	
			include_once('classes/Core/CKeywordSearch.php');
  			include_once('classes/Display/DKeywordSearch.php');
			include_once('classes/Core/CLastViewedProducts.php');
			include_once('classes/Display/DLastViewedProducts.php');
					
			include_once('classes/Core/CCurrencySettings.php');
			Core_CCurrencySettings::getDefaultCurrency();
			
			$output['signup']=Display_DUserRegistration::signUp();
			$default=new Core_CLastViewedProducts();
			$output['lastviewedproducts']=$default->lastViewedProducts();
			include_once('classes/Core/CHome.php');
			include_once('classes/Core/CAddCart.php');
			include_once('classes/Display/DAddCart.php');
			$output['cartSnapShot'] = Core_CAddCart::cartSnapShot();
			$output['sitelogo']=Core_CHome::getLogo();
			$output['pagetitle']=Core_CHome::pageTitle();
			$output['timezone']=Core_CHome::setTimeZone();	
			$output['currentDate']=date('D,M d,Y - h:i A');
			$output['skinname']=Core_CHome::skinName();
			$output['googleanalytics']=Core_CHome::getGoogleAnalyticsCode();
			$output['googlead']=Core_CHome::getGoogleAd();
			$output['dropdowncat']=Core_CKeywordSearch::categoryDropDown();
			$output['footer']=Core_CHome::footer();
			$output['footerconnect']=Core_CHome::getfooterconnect();
			$output['sociallink']=Core_CHome::showSocialLinks();
			if($_SESSION['compareProductId']=='')
				$output['viewProducts']['viewProducts'] = Display_DWishList::viewProductElse();
			else
				$output['viewProducts']=Core_CWishList::addtoCompareProduct();
			$output['wishlist']['wishlist'] = Core_CWishList::viewWishList();
			$output['loginStatus'] = Core_CUserRegistration::loginStatus();
			$output['headermenu'] = Core_CUserRegistration::showHeaderMenu();
			$output['headertext'] = Core_CUserRegistration::showHeaderText();
			$output['headermenuhidden']= Core_CUserRegistration::showHeaderMenuHidden();
			$output['headerMainMenu'] = Core_CUserRegistration::showHeaderMainMenu();
			$default=new Core_CNewProducts();
			$output['newproducts']=$default->newProducts();
			if($_SESSION['user_id']!='')
				$output['wishlistsnapshot'] = Core_CWishList::wishlistSnapshot();
		
			$output['userLeftMenu'] = Display_DUserRegistration::showUserLeftMenu();			
			$output['userRight'] = "userdashboard.html";					
			$output['rows']=Core_CWishList::viewWishList();
			$output['cartcount']=Core_CAddCart::countCart();
// 
			Bin_Template::createTemplate('userIndex.html',$output);

			
		}
	}
	/**
	* This function is used to display  clear wishlist  page
 	*
 	* @return string
	*/
	function clearWishlist()
	{
		
		include('classes/Core/CWishList.php');
		include('classes/Display/DWishList.php');
		include('classes/Core/CUserRegistration.php');
		include('classes/Display/DUserRegistration.php');
		include_once('classes/Core/CNewProducts.php');
		include_once('classes/Display/DNewProducts.php');
	
		include('classes/Core/CKeywordSearch.php');
  		include('classes/Display/DKeywordSearch.php');
		include('classes/Core/CHome.php');
		
		include_once('classes/Core/CCurrencySettings.php');
		Core_CCurrencySettings::getDefaultCurrency();
		
		include('classes/Core/CAddCart.php');
		include('classes/Display/DAddCart.php');
		$output['cartSnapShot'] = Core_CAddCart::cartSnapShot();
		include_once('classes/Core/CLastViewedProducts.php');
		include_once('classes/Display/DLastViewedProducts.php');
		
		$output['signup']=Display_DUserRegistration::signUp();
		$default=new Core_CLastViewedProducts();
		$output['lastviewedproducts']=$default->lastViewedProducts();
		$output['sitelogo']=Core_CHome::getLogo();
		$output['pagetitle']=Core_CHome::pageTitle();
		$output['timezone']=Core_CHome::setTimeZone();	
		$output['footer']=Core_CHome::footer();
		$output['footerconnect']=Core_CHome::getfooterconnect();
		$output['sociallink']=Core_CHome::showSocialLinks();
		$output['currentDate']=date('D,M d,Y - h:i A');
		$output['skinname']=Core_CHome::skinName();
		$output['googleanalytics']=Core_CHome::getGoogleAnalyticsCode();
		$output['googlead']=Core_CHome::getGoogleAd();
		$output['dropdowncat']=Core_CKeywordSearch::categoryDropDown();
		
			if($_SESSION['compareProductId']=='')
			{
			
				$output['viewProducts']['viewProducts'] = Display_DWishList::viewProductElse();
			}
			else
				$output['viewProducts']=Core_CWishList::addtoCompareProduct();

			$output['wishlist']=Core_CWishList::clearWishlist();

			$output['loginStatus'] = Core_CUserRegistration::loginStatus();
			$output['headermenu'] = Core_CUserRegistration::showHeaderMenu();
			$output['headertext'] = Core_CUserRegistration::showHeaderText();
			$output['headermenuhidden']= Core_CUserRegistration::showHeaderMenuHidden();
			$output['headerMainMenu'] = Core_CUserRegistration::showHeaderMainMenu();
			$default=new Core_CNewProducts();
			$output['newproducts']=$default->newProducts();
			if($_SESSION['user_id']!='')
				$output['wishlistsnapshot'] = Core_CWishList::wishlistSnapshot();
			
		Bin_Template::createTemplate('wishlist.html',$output);
	}
	/**
	* This function is used to display  View snapshot for wishlist
 	*
 	* @return string
	*/
	function wishlistSnapshot()
	{	
		$_SESSION['url']=$_GET['do'];
		$output = array();
		include('classes/Core/CWishList.php');
		include_once('classes/Core/CCurrencySettings.php');
		Core_CCurrencySettings::getDefaultCurrency();
		
		$output['wishlistsnapshot'] = Core_CWishList::wishlistSnapshot();
		$output['signup']=Display_DUserRegistration::signUp();
		Bin_Template::createTemplate('index.html',$output);
	}
	/**
	* This function is used to display  addtoCompareProduct
 	*
 	* @return string
	*/
	function addtoCompareProduct()
	{	
		include('classes/Core/CUserRegistration.php');
		include('classes/Display/DUserRegistration.php');
		include('classes/Core/CWishList.php');
		include('classes/Display/DWishList.php');
		include_once('classes/Core/CCurrencySettings.php');
		Core_CCurrencySettings::getDefaultCurrency();
		 
		$default = new Core_CWishList();
		$output['viewProducts']= $default->addtoCompareProduct();
		header('Location:'.$_SERVER['HTTP_REFERER']);
		exit;
		 
	}
	/**
	* This function is used to display  CompareProduct
 	*
 	* @return string
	*/
	function viewCompareProduct()
	{	
		include_once('classes/Core/CWishList.php');
		include_once('classes/Display/DWishList.php');
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
		$output['footerconnect']=Core_CHome::getfooterconnect();
		$output['sociallink']=Core_CHome::showSocialLinks();
		$output['loginStatus'] = Core_CUserRegistration::loginStatus();
		$output['dropdowncat']=Core_CKeywordSearch::categoryDropDown();
		$output['headermenu'] = Core_CUserRegistration::showHeaderMenu();
		$output['headerMainMenu'] = Core_CUserRegistration::showHeaderMainMenu();		
		$output['headertext'] = Core_CUserRegistration::showHeaderText();
		$output['result'] = $result;
			$output['headermenuhidden']= Core_CUserRegistration::showHeaderMenuHidden();
		$output['lastviewedproducts']=Core_CLastViewedProducts::lastViewedProducts();
		$output['userRight'] = "userdashboard.html";					
		$output['rows']=Core_CWishList::viewCompareProduct();

		Bin_Template::createTemplate('userIndex.html',$output);
		
	}
	/**
	* This function is used to delete  CompareProduct
 	*
 	* @return string
	*/
	function deleteCompareProduct()
	{	
		$output = array();
		include('classes/Core/CWishList.php');
		include('classes/Display/DWishList.php');
		include('classes/Display/DUserRegistration.php');
		include_once('classes/Core/CLastViewedProducts.php');
		include_once('classes/Display/DLastViewedProducts.php');
		include('classes/Core/CUserRegistration.php');
		include_once('classes/Display/DUserRegistration.php');
		include('classes/Core/CKeywordSearch.php');
		include('classes/Display/DKeywordSearch.php');
		include('classes/Core/CHome.php');

		
		
		include_once('classes/Core/CCurrencySettings.php');
		Core_CCurrencySettings::getDefaultCurrency();
		
		$output['signup']=Display_DUserRegistration::signUp();
		$default = new Core_CWishList();
		$output['compareProducts'] = $default->deleteCompareProduct();
	
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
			$output['headermenuhidden']= Core_CUserRegistration::showHeaderMenuHidden();
		$output['lastviewedproducts']=Core_CLastViewedProducts::lastViewedProducts();
		$output['userRight'] = "userdashboard.html";					
		$output['rows']=Core_CWishList::viewCompareProduct();

		Bin_Template::createTemplate('userIndex.html',$output);

	}
	/**
	* This function is used to delete  Product
 	*
 	* @return string
	*/
	function deleteProduct()
	{	
		include('classes/Core/CWishList.php');
		include('classes/Display/DWishList.php');
		include('classes/Core/CUserRegistration.php');
		include('classes/Display/DUserRegistration.php');
		include_once('classes/Core/CNewProducts.php');
		include_once('classes/Display/DNewProducts.php');
		include_once('classes/Core/CFeaturedItems.php');
		include_once('classes/Display/DFeaturedItems.php');
		include('classes/Core/CHome.php');
		include('classes/Core/CAddCart.php');
		include('classes/Display/DAddCart.php');
		include_once('classes/Core/CLastViewedProducts.php');
		include_once('classes/Display/DLastViewedProducts.php');
		
		
		include_once('classes/Core/CCurrencySettings.php');
		Core_CCurrencySettings::getDefaultCurrency();
		
		$output['signup']=Display_DUserRegistration::signUp();
		$default=new Core_CLastViewedProducts();
		$output['lastviewedproducts']=$default->lastViewedProducts();
		$output['cartSnapShot'] = Core_CAddCart::cartSnapShot();
		$output['sitelogo']=Core_CHome::getLogo();
		$output['pagetitle']=Core_CHome::pageTitle();
		$output['timezone']=Core_CHome::setTimeZone();	
		$output['currentDate']=date('D,M d,Y - h:i A');
		$output['skinname']=Core_CHome::skinName();
		$output['googleanalytics']=Core_CHome::getGoogleAnalyticsCode();
		$output['googlead']=Core_CHome::getGoogleAd();
		$output['banner']=Core_CHome::getBanner();
		$output['footerconnect']=Core_CHome::getfooterconnect();
		$output['sociallink']=Core_CHome::showSocialLinks();
		include('classes/Core/CKeywordSearch.php');
  		include('classes/Display/DKeywordSearch.php');
		$output['dropdowncat']=Core_CKeywordSearch::categoryDropDown();
		$default = new Core_CWishList();
		$output['viewCompareProducts']= $default->deleteProduct();
		$default=new Core_CFeaturedItems();
		$output['maincatimage']=$default->showMainCategory();
		$output['allfeaturedproducts']=$default->featuredProducts();
		if($_SESSION['compareProductId']=='')
		{
			$output['viewProducts']['viewProducts'] = Display_DWishList::viewProductElse();
		}
		else
			$output['viewProducts']=Core_CWishList::addtoCompareProduct();
		
		$output['loginStatus'] = Core_CUserRegistration::loginStatus();
		$output['headermenu'] = Core_CUserRegistration::showHeaderMenu();
		$output['headertext'] = Core_CUserRegistration::showHeaderText();
			$output['headermenuhidden']= Core_CUserRegistration::showHeaderMenuHidden();
		$default=new Core_CNewProducts();
		$output['newproducts']=$default->newProducts();
		if($_SESSION['user_id']!='')
				$output['wishlistsnapshot'] = Core_CWishList::wishlistSnapshot();
		Bin_Template::createTemplate('index.html',$output);
	}
	/**
	* This function is used to clear all in compare product snapshot
 	*
 	* @return string
	*/
	function deleteAllItem()
	{	
		include('classes/Core/CUserRegistration.php');
		include('classes/Display/DUserRegistration.php');
		include('classes/Core/CWishList.php');
		include('classes/Display/DWishList.php');
		
		include_once('classes/Core/CCurrencySettings.php');
		Core_CCurrencySettings::getDefaultCurrency();
		
		$default = new Core_CWishList();
		$output['viewProducts']['viewProducts']= $default->deleteAllItem();
		header('Location:'.$_SERVER['HTTP_REFERER']);
		exit;	 
	}
	/**
	* This function is used to delete  compare product from home page
 	*
 	* @return string
	*/
	function deleteCompareProductFromHome()
	{
		include('classes/Core/CUserRegistration.php');
		include('classes/Display/DUserRegistration.php');
		include('classes/Core/CWishList.php');
		include('classes/Display/DWishList.php');
		
		include_once('classes/Core/CCurrencySettings.php');
		Core_CCurrencySettings::getDefaultCurrency();
		 
		$default = new Core_CWishList();
		$output['viewProducts']= $default->deleteCompareProductFromHome();
		header('Location:'.$_SERVER['HTTP_REFERER']);
		exit;
	}
}
?>
