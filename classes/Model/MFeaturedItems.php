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
 * Featured items  related  class
 *
 * @package   		Model_MFeaturedItems
 * @category    	Model
 * @author    		AJ Square Inc Dev Team
 * @link   		http://www.zeuscart.com
  * @copyright 	        Copyright (c) 2008 - 2013, AJ Square, Inc.
 * @version   		Version 4.0
 */
class Model_MFeaturedItems
{

	/**
	 * Stores the output 
	 *
	 * @var array 
	 */	
	var $output = array();	
	
 	/**
	* This function is used to Display the Main Category Landing Content Page
 	*
	* @return string
	*/
	function showMainCatLanding()
	{
		include_once('classes/Core/CFeaturedItems.php');
		include('classes/Core/CUserRegistration.php');
		include('classes/Display/DUserRegistration.php');
		include('classes/Core/CWishList.php');
		include('classes/Display/DWishList.php');
		include_once('classes/Display/DFeaturedItems.php');
		include_once('classes/Core/CNewProducts.php');
		include_once('classes/Display/DNewProducts.php');
		include('classes/Core/CKeywordSearch.php');
  		include('classes/Display/DKeywordSearch.php');
		include('classes/Core/CAddCart.php');
		include('classes/Display/DAddCart.php');
		include('classes/Core/CHome.php');
		include_once('classes/Core/CLastViewedProducts.php');
		include_once('classes/Display/DLastViewedProducts.php');
		include('classes/Lib/TagClouds.php');
		include('classes/Core/CTagClouds.php');
		
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
		$output['footerconnect']=Core_CHome::getfooterconnect();
		$output['sociallink']=Core_CHome::showSocialLinks();
		$output['categories'] = Display_DUserRegistration::showMainCat();		
		$output['googlead']=Core_CHome::getGoogleAd();
		$output['dropdowncat']=Core_CKeywordSearch::categoryDropDown();
		$default=new Core_CFeaturedItems();
		$output['maincatlandcontent']=$default->getMaincatlandContent();
		$output['maincatlanding']=$default->showMainCatLanding();
		$output['maincatfeaturedproduct']=$default->showMaincatFeaturedProduct();
		$output['tagClouds']=Core_CTagClouds::displayTagClouds();
		
		$output['allfeaturedproducts']=Core_CFeaturedItems::showMaincatFeaturedProduct();

		$output['maincatbreadcrumb']=$default->maincatBreadCrumb();
		if($_SESSION['user_id']!='')
			$output['wishlistsnapshot'] = Core_CWishList::snapshotForHome();
		
		if($_SESSION['compareProductId']=='')
		{
			$output['viewProducts']['viewProducts'] = Display_DWishList::viewProductElse();
		}
		else
			$output['viewProducts']=Core_CWishList::addtoCompareProduct();
		$default=new Core_CNewProducts();
		$output['newproducts']=$default->newProducts();
		$output['loginStatus']= Core_CUserRegistration::loginStatus();
		$output['headermenu'] = Core_CUserRegistration::showSubHeaderMenu();
		$output['headermenuhidden']= Core_CUserRegistration::showHeaderMenuHidden();
		$output['currencysettings']=Core_CUserRegistration::showCurrencySettings();
		$output['headertext'] = Core_CUserRegistration::showHeaderText();
		$output['categories'] = Display_DUserRegistration::showSubCat();
		Bin_Template::createTemplate('index.html',$output);
	}
	
 	/**
	* This function is used to Display the Featured Product of Main category
 	*
	* @return string
	*/
	function showMaincatFeaturedProduct()
	{
		include_once('classes/Core/CFeaturedItems.php');
		include('classes/Core/CUserRegistration.php');
		include('classes/Display/DUserRegistration.php');
		include('classes/Core/CWishList.php');
		include('classes/Display/DWishList.php');
		include_once('classes/Display/DFeaturedItems.php');
		include_once('classes/Core/CNewProducts.php');
		include_once('classes/Display/DNewProducts.php');
		include('classes/Core/CKeywordSearch.php');
  		include('classes/Display/DKeywordSearch.php');
		include('classes/Core/CAddCart.php');
		include('classes/Display/DAddCart.php');
		include('classes/Core/CHome.php');
		include_once('classes/Core/CLastViewedProducts.php');
		include_once('classes/Display/DLastViewedProducts.php');
		include('classes/Lib/TagClouds.php');
		include('classes/Core/CTagClouds.php');
		
		include_once('classes/Core/CCurrencySettings.php');
		Core_CCurrencySettings::getDefaultCurrency();
		
		$output['signup']=Display_DUserRegistration::signUp();
		$default=new Core_CLastViewedProducts();
		$output['lastviewedproducts']=$default->lastViewedProducts();
		$output['categories'] = Display_DUserRegistration::showMainCat();			
		$output['cartSnapShot'] = Core_CAddCart::cartSnapShot();
		$output['sitelogo']=Core_CHome::getLogo();
		$output['pagetitle']=Core_CHome::pageTitle();
		$output['timezone']=Core_CHome::setTimeZone();	
		$output['currentDate']=date('D,M d,Y - h:i A');
		$output['skinname']=Core_CHome::skinName();
		$output['banner']= Core_CHome::getBanner();
		$output['googlead']=Core_CHome::getGoogleAd();
		$output['footerconnect']=Core_CHome::getfooterconnect();
		$output['sociallink']=Core_CHome::showSocialLinks();
		$output['dropdowncat']=Core_CKeywordSearch::categoryDropDown();
		$default=new Core_CFeaturedItems();
		if($_SESSION['user_id']!='')
			$output['wishlistsnapshot'] = Core_CWishList::wishlistSnapshot();
		$output['maincatproduct']=$default->showMaincatFeaturedProduct();
		if($_SESSION['compareProductId']=='')
		{
			$output['viewProducts']['viewProducts'] = Display_DWishList::viewProductElse();
		}
		else
			$output['viewProducts']=Core_CWishList::addtoCompareProduct();
		$output['tagClouds']=Core_CTagClouds::displayTagClouds();
		$output['showBestSellingProducts']=Core_CFeaturedItems::showBestSellingProducts();
	
		$default=new Core_CNewProducts();
		$output['newproducts']=$default->newProducts();
		$output['loginStatus']= Core_CUserRegistration::loginStatus();
		$output['headermenu'] = Core_CUserRegistration::showHeaderMenu();
		$output['headermenuhidden']= Core_CUserRegistration::showHeaderMenuHidden();
		$output['currencysettings']=Core_CUserRegistration::showCurrencySettings();
		$output['headertext'] = Core_CUserRegistration::showHeaderText();
		Bin_Template::createTemplate('index.html',$output);
	}
	
	
	
 	/**
	* This function is used to Display the Featured Product Page
 	*
	* @return string
	*/
	function showFeaturedProduct()
	{
		include_once('classes/Core/CFeaturedItems.php');
		include('classes/Core/CUserRegistration.php');
		include('classes/Display/DUserRegistration.php');
		include('classes/Core/CWishList.php');
		include('classes/Display/DWishList.php');
		include_once('classes/Display/DFeaturedItems.php');
		include_once('classes/Core/CNewProducts.php');
		include_once('classes/Display/DNewProducts.php');
		include('classes/Core/CKeywordSearch.php');
  		include('classes/Display/DKeywordSearch.php');
		include('classes/Core/CHome.php');
		include('classes/Core/CAddCart.php');
		include('classes/Display/DAddCart.php');
		include_once('classes/Core/CLastViewedProducts.php');
		include_once('classes/Display/DLastViewedProducts.php');
		include('classes/Lib/TagClouds.php');
		include('classes/Core/CTagClouds.php');

		include_once('classes/Core/CCurrencySettings.php');
		Core_CCurrencySettings::getDefaultCurrency();
		
		$output['categories'] = Display_DUserRegistration::showMainCat();	
		$output['signup']=Display_DUserRegistration::signUp();
		
		$output['cartSnapShot'] = Core_CAddCart::cartSnapShot();
		if($_SESSION['user_id']!='')
			$output['wishlistsnapshot'] = Core_CWishList::snapshotForHome();
		
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
		$default=new Core_CFeaturedItems();
		
		$output['subcatbreadcrumb']=$default->subcatBreadCrumb();
		$output['dropdowncat']=Core_CKeywordSearch::categoryDropDown();
		$output['subcatlandcontent']=$default->getSubcatlandContent();	
		
		if($_SESSION['compareProductId']=='')
		
			$output['viewProducts']['viewProducts'] = Display_DWishList::viewProductElse();
		else
		
			$output['viewProducts']=Core_CWishList::addtoCompareProduct();
			
		$default=new Core_CNewProducts();
		
		$output['newproducts']=$default->newProducts();
		$output['loginStatus']= Core_CUserRegistration::loginStatus();
		$output['tagClouds']=Core_CTagClouds::displayTagClouds();
		$output['showBestSellingProducts']=Core_CFeaturedItems::showBestSellingProducts();
		$output['headermenu'] = Core_CUserRegistration::showHeaderMenu();
		$output['headermenuhidden']= Core_CUserRegistration::showHeaderMenuHidden();
		$output['currencysettings']=Core_CUserRegistration::showCurrencySettings();
		$output['headertext'] = Core_CUserRegistration::showHeaderText();
		
		$output['cartSnapShot'] = Core_CAddCart::cartSnapShot();
		if($_SESSION['compareProductId']=='')
		{
			$output['viewProducts']['viewProducts'] = Display_DWishList::viewProductElse();
		}
		else
			$output['viewProducts']=Core_CWishList::addtoCompareProduct();
		
		$sort=$_POST['selsort'];
		

		$output['sitelogo']=Core_CHome::getLogo();
		$output['pagetitle']=Core_CHome::pageTitle();
		$output['timezone']=Core_CHome::setTimeZone();	
		$output['currentDate']=date('D,M d,Y - h:i A');
		$output['skinname']=Core_CHome::skinName();
		$output['banner']=Core_CHome::getBanner();		
		$output['googlead']=Core_CHome::getGoogleAd();
		$output['footer']=Core_CHome::footer();
		$output['timezone']=Core_CHome::setTimeZone();
		
	   	 $sort=$_POST['selsort'];
		$mode=$_POST['selmode'];
		
		$output['narrowsearch'] =  Core_CKeywordSearch::narrowSearch($sort,$mode);
		
		$cou=$_SESSION['countsearch'];
		
		$output['countrecords']=Core_CKeywordSearch::countSearch($cou);
		$output['disppagesize']=Display_DKeywordSearch::displayPageSize();
		
		if(((int)$_SESSION['countsearch'])>0)
			$output['dispselection']=Display_DKeywordSearch::displaySelection();
		 $output['disppricerange']=Core_CKeywordSearch::priceRange();
		
		if(($_POST['subcatsel']!="")or($_SESSION['subcategory']!=""))
  	    	
		$output['features']=Core_CKeywordSearch::featureList();
		
		$output['brandwithcount']=Core_CKeywordSearch::dispBrandWithCount();	
		$output['dispsubcat']=Core_CKeywordSearch::dispSubCategory();
		$output['mylink']=Core_CKeywordSearch::linkMode();
		$output['sortby']=Display_DKeywordSearch::sortBy();
		
		
		$output['viewproducts']=Core_CFeaturedItems::viewProducts();
		$output['searchoptions']=Core_CFeaturedItems::dispSearch();
		$output['narrow']=Core_CFeaturedItems::dispNarrow();
		$output['pricenarrow']=Core_CFeaturedItems::dispPriceNarrow();
		$output['brandnarrow']=Core_CFeaturedItems::dispBrandNarrow();
		
		
		
		
		Bin_Template::createTemplate('subcategory.html',$output);
	}
	
 	/**
	* This function is used to Display the Featured Items
 	*
	* @return string
	*/
	function showFeaturedItems()
	{
		
		include_once('classes/Core/CFeaturedItems.php');
		include_once('classes/Display/DFeaturedItems.php');
		include_once('classes/Core/CLastViewedProducts.php');
		include_once('classes/Display/DLastViewedProducts.php');
		include_once('classes/Core/CKeywordSearch.php');
  		include_once('classes/Display/DKeywordSearch.php');
		include_once('classes/Core/CHome.php');
		include('classes/Lib/TagClouds.php');
		include('classes/Core/CTagClouds.php');
		include('classes/Core/CUserRegistration.php');
		include('classes/Display/DUserRegistration.php');
		include_once('classes/Core/CCurrencySettings.php');
		Core_CCurrencySettings::getDefaultCurrency();
		
		$output['sitelogo']=Core_CHome::getLogo();
		$output['pagetitle']=Core_CHome::pageTitle();
		$output['timezone']=Core_CHome::setTimeZone();	
		$output['currentDate']=date('D,M d,Y - h:i A');
		$output['skinname']=Core_CHome::skinName();
		$output['banner']=Core_CHome::getBanner();
		$output['signup']=Display_DUserRegistration::signUp();
		$output['googleanalytics']=Core_CHome::getGoogleAnalyticsCode();
		$output['googlead']=Core_CHome::getGoogleAd();
		$output['footer']=Core_CHome::footer();
		$output['footerconnect']=Core_CHome::getfooterconnect();
		$output['sociallink']=Core_CHome::showSocialLinks();
		$output['categories'] = Display_DUserRegistration::showMainCat();		
		$output['tagClouds']=Core_CTagClouds::displayTagClouds();
		$output['showBestSellingProducts']=Core_CFeaturedItems::showBestSellingProducts();
		$output['headermenu'] = Core_CUserRegistration::showHeaderMenu();
		$output['headermenuhidden']= Core_CUserRegistration::showHeaderMenuHidden();
		$output['currencysettings']=Core_CUserRegistration::showCurrencySettings();
		$output['headertext'] = Core_CUserRegistration::showHeaderText();
		

		$default=new Core_CLastViewedProducts();
		$output['lastviewedproducts']=$default->lastViewedProducts();
		$default=new Core_CFeaturedItems();
		$output['featured']=$default->featuredProducts();
		Bin_Template::createTemplate('featureditems.html',$output);
	}
	
}	
?>