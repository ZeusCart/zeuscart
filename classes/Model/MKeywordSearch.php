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
 * Keyword search related  class
 *
 * @package   		Model_MKeywordSearch
 * @category    	Model
 * @author    		AJ Square Inc Dev Team
 * @link   		http://www.zeuscart.com
  * @copyright 	        Copyright (c) 2008 - 2013, AJ Square, Inc.
 * @version   		Version 4.0
 */
class Model_MKeywordSearch
{

	/**
	 * Stores the output 
	 *
	 * @var array 
	 */	
	var $output = array();	
	
 	/**
	* This function is used to Display the Keyword Search Page
 	*
	* @return string
	*/
	function keywordsearch()
	{
		

		//language	
		include_once('classes/Core/CLanguage.php');
		Core_CLanguage::setLanguage('COMMON');

		include('classes/Core/CFeaturedItems.php');
		include('classes/Core/CUserRegistration.php');
		include('classes/Core/CHome.php');
		include('classes/Core/CKeywordSearch.php');
		include('classes/Core/CWishList.php');
		include('classes/Core/CNewProducts.php');
		include('classes/Core/CAddCart.php');
		include('classes/Core/CProductDetail.php');
		include('classes/Display/DProductDetail.php');
		include('classes/Display/DFeaturedItems.php');
		include('classes/Display/DUserRegistration.php');
		include('classes/Display/DKeywordSearch.php');
		include('classes/Display/DWishList.php');
		include('classes/Display/DNewProducts.php');
		include('classes/Display/DAddCart.php');
		
		include_once('classes/Core/CCurrencySettings.php');
		Core_CCurrencySettings::getDefaultCurrency();
		
		if($_POST['catsel']!="")
		{
		   session_unregister('subcategory');		   
		}
		
		
		if($_POST['catsel']!="") // store selected main category for search		
			$_SESSION['category']= $_POST['catsel'];
			
		if($_POST['subcatsel']!="") // store selected sub category for search		
			$_SESSION['subcategory']= $_POST['subcatsel'];
		  
		$default=new Core_CFeaturedItems();
		$output['wishlistsnapshot'] = Core_CWishList::wishlistSnapshot();
	
		if($_SESSION['compareProductId']=='')
		{
			$output['viewProducts']['viewProducts'] = Display_DWishList::viewProductElse();
		}
		else
			$output['viewProducts']=Core_CWishList::addtoCompareProduct();
		
		$default=new Core_CNewProducts();
		$output['newproducts']=$default->newProducts();
		$output['loginStatus']= Core_CUserRegistration::loginStatus();
		$output['headermenu'] = Core_CUserRegistration::showHeaderMenu();
		$output['headermenuhidden']= Core_CUserRegistration::showHeaderMenuHidden();
		$output['headertext'] = Core_CUserRegistration::showHeaderText();
		$output['currencysettings']=Core_CUserRegistration::showCurrencySettings();
		if (isset($_GET['search']))
			$search=$_GET['search'];
		else
    		$search=$_POST['search'];
		
		$sort=$_POST['selsort'];
		$txtsearch=$_POST['searchtxt'];
		if($txtsearch.length>0)
		   $search=$txtsearch;
		$mode=$_POST['selmode'];
		$output['dispsubcat']=Core_CKeywordSearch::dispSubCategory();
		$output['dropdowncat']=Core_CKeywordSearch::categoryDropDown();
		$output['keywordsearch'] =  Core_CKeywordSearch::searchKeyWord($search,$sort,$mode);
		$output['cartSnapShot'] = Core_CAddCart::cartSnapShot();
		$cou=$_SESSION['countsearch'];
		$output['countrecords']=Core_CKeywordSearch::countSearch($cou);
		$output['disppagesize']=Display_DKeywordSearch::displayPageSize();
		$output['searchresultfor']=Display_DKeywordSearch::searchResultFor($search);
		$output['searchsession']=Display_DKeywordSearch::searchSession($search);
	
  	   	 $output['disppricerange']=Core_CKeywordSearch::priceRange();
		$output['categorytree'] = Core_CProductDetail::showCategoryTree();
		if(($_POST['subcatsel']!="")or($_SESSION['subcategory']!="")) // store selected sub category for search		
	  	    $output['features']=Core_CKeywordSearch::featureList();
		
		$output['brandwithcount']=Core_CKeywordSearch::dispBrandWithCount();
		$output['dispselection']=Display_DKeywordSearch::displaySelection();

		
		$output['sitelogo']=Core_CHome::getLogo();
		$output['pagetitle']=Core_CHome::pageTitle();
		$output['timezone']=Core_CHome::setTimeZone();	
		$output['currentDate']=date('D,M d,Y - h:i A');
		$output['skinname']=Core_CHome::skinName();
		$output['banner']=Core_CHome::getBanner();
		
		$output['googlead']=Core_CHome::getGoogleAd();
		$output['footer']=Core_CHome::footer();
		$output['footerconnect']=Core_CHome::getfooterconnect();
		$output['sociallink']=Core_CHome::showSocialLinks();
		$output['mylink']=Core_CKeywordSearch::linkMode();

		$output['sortby']=Display_DKeywordSearch::sortBy();
		$output['cartcount']=Core_CAddCart::countCart();
	   	Bin_Template::createTemplate('searchpage.html',$output);

	}	
	
 	/**
	* This function is used to Display the Header Categories
 	*
	* @return HTML data
	*/
	function headerCategories()
	{
		include('classes/Core/CKeywordSearch.php');
		include('classes/Display/DKeywordSearch.php');
		
		include_once('classes/Core/CCurrencySettings.php');
		Core_CCurrencySettings::getDefaultCurrency();
		
		$output['dropdowncat']=Core_CKeywordSearch::categoryDropDown();
	    	Bin_Template::createTemplate('header.html',$output);
	}
	
 	/**
	* This function is used to Display the Narrow Search Page
 	*
	* @return HTML data
	*/
	function narrowSearch()
	{
		include('classes/Core/CFeaturedItems.php');
		include('classes/Core/CUserRegistration.php');
		include('classes/Core/CHome.php');
		include('classes/Core/CKeywordSearch.php');
		include('classes/Core/CWishList.php');
		include('classes/Core/CNewProducts.php');
		include('classes/Core/CAddCart.php');
		
		include('classes/Display/DFeaturedItems.php');
		include('classes/Display/DUserRegistration.php');
		include('classes/Display/DKeywordSearch.php');
		include('classes/Display/DWishList.php');
		include('classes/Display/DNewProducts.php');
		include('classes/Display/DAddCart.php');
		
		include_once('classes/Core/CCurrencySettings.php');
		Core_CCurrencySettings::getDefaultCurrency();
		
		$output['wishlistsnapshot'] = Core_CWishList::wishlistSnapshot();
		$output['cartSnapShot'] = Core_CAddCart::cartSnapShot();
		
		if($_SESSION['compareProductId']=='')
		{
			$output['viewProducts']['viewProducts'] = Display_DWishList::viewProductElse();
		}
		else
			$output['viewProducts']=Core_CWishList::addtoCompareProduct();
		
		$default=new Core_CNewProducts();
		$output['newproducts']=$default->newProducts();
		$output['loginStatus']= Core_CUserRegistration::loginStatus();
		$output['headermenu'] = Core_CUserRegistration::showHeaderMenu();
		$output['headermenuhidden']= Core_CUserRegistration::showHeaderMenuHidden();
		$output['headertext'] = Core_CUserRegistration::showHeaderText();
		$output['currencysettings']=Core_CUserRegistration::showCurrencySettings();
		$output['sitelogo']=Core_CHome::getLogo();
		$output['pagetitle']=Core_CHome::pageTitle();
		$output['timezone']=Core_CHome::setTimeZone();	
		$output['currentDate']=date('D,M d,Y - h:i A');
		$output['skinname']=Core_CHome::skinName();
		$output['banner']=Core_CHome::getBanner();		
		$output['googlead']=Core_CHome::getGoogleAd();
		$output['footer']=Core_CHome::footer();
		$output['footerconnect']=Core_CHome::getfooterconnect();
		$output['sociallink']=Core_CHome::showSocialLinks();
		$output['timezone']=Core_CHome::setTimeZone();
		
		$sort=$_POST['selsort'];
	
		$mode=$_POST['selmode'];
		$default1=new Core_CKeywordSearch();
		$output['narrowsearch'] =  $default1->narrowSearch($sort,$mode);
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

        	$output['dropdowncat']=Core_CKeywordSearch::categoryDropDown();
		$output['mylink']=Core_CKeywordSearch::linkMode();
		$output['sortby']=Display_DKeywordSearch::sortBy();
		Bin_Template::createTemplate('searchpage.html',$output);

		
	}
	
 	/**
	* This function is used to Display the Price Range Search Page
 	*
	* @return HTML data
	*/
	function priceRangeSearch()
	{
		include('classes/Core/CFeaturedItems.php');
		include('classes/Core/CUserRegistration.php');
		include('classes/Core/CHome.php');
		include('classes/Core/CKeywordSearch.php');
		include('classes/Core/CWishList.php');
		include('classes/Core/CNewProducts.php');
		include('classes/Core/CAddCart.php');
		
		include('classes/Display/DFeaturedItems.php');
		include('classes/Display/DUserRegistration.php');
		include('classes/Display/DKeywordSearch.php');
		include('classes/Display/DWishList.php');
		include('classes/Display/DNewProducts.php');
		include('classes/Display/DAddCart.php');
		
		include_once('classes/Core/CCurrencySettings.php');
		Core_CCurrencySettings::getDefaultCurrency();
		
		$output['wishlistsnapshot'] = Core_CWishList::wishlistSnapshot();
		$output['cartSnapShot'] = Core_CAddCart::cartSnapShot();
		if($_SESSION['compareProductId']=='')
		{
			$output['viewProducts']['viewProducts'] = Display_DWishList::viewProductElse();
		}
		else
			$output['viewProducts']=Core_CWishList::addtoCompareProduct();
		
		$default=new Core_CNewProducts();
		$output['newproducts']=$default->newProducts();
		$output['loginStatus']= Core_CUserRegistration::loginStatus();
		$output['headermenu'] = Core_CUserRegistration::showHeaderMenu();
		$output['headermenuhidden']= Core_CUserRegistration::showHeaderMenuHidden();
		$output['headertext'] = Core_CUserRegistration::showHeaderText();
		$output['currencysettings']=Core_CUserRegistration::showCurrencySettings();
		$output['sitelogo']=Core_CHome::getLogo();
		$output['pagetitle']=Core_CHome::pageTitle();
		$output['timezone']=Core_CHome::setTimeZone();	
		$output['currentDate']=date('D,M d,Y - h:i A');
		$output['skinname']=Core_CHome::skinName();
		$output['banner']=Core_CHome::getBanner();
		
		$output['googlead']=Core_CHome::getGoogleAd();
		$output['footer']=Core_CHome::footer();
		$output['footerconnect']=Core_CHome::getfooterconnect();
		$output['sociallink']=Core_CHome::showSocialLinks();
	    	$sort=$_POST['selsort'];
		
		$output['dispsubcat']=Core_CKeywordSearch::dispSubCategory();
		$mode=$_POST['selmode'];
		$output['pricerangesearch'] =  Core_CKeywordSearch::priceRangeSearch($sort,$mode);
		$cou=$_SESSION['countsearch'];
		$output['countrecords']=Core_CKeywordSearch::countSearch($cou);
		$output['disppagesize']=Display_DKeywordSearch::displayPageSize();
	
		$output['searchsession']=Display_DKeywordSearch::searchSession($search);
		
		$output['disppricerange']=Core_CKeywordSearch::priceRange();
		if(($_POST['subcatsel']!="")or($_SESSION['subcategory']!=""))
  	   		 $output['features']=Core_CKeywordSearch::featureList();
		
		$output['dropdowncat']=Core_CKeywordSearch::categoryDropDown();
		$output['brandwithcount']=Core_CKeywordSearch::dispBrandWithCount();
		$output['mylink']=Core_CKeywordSearch::linkMode();
		
		$output['sortby']=Display_DKeywordSearch::sortBy();
		Bin_Template::createTemplate('searchpage.html',$output);
		
	}
	
 	/**
	* This function is used to Display the Extended Search Page
 	*
	* @return HTML data
	*/
	function extendedSearch()
	{
		include_once('classes/Core/CFeaturedItems.php');
		include('classes/Core/CUserRegistration.php');
		include('classes/Display/DUserRegistration.php');
		include('classes/Core/CWishList.php');
		include('classes/Display/DWishList.php');
		include_once('classes/Display/DFeaturedItems.php');
		include_once('classes/Core/CNewProducts.php');
		include_once('classes/Display/DNewProducts.php');
		include('classes/Core/CAddCart.php');
		include('classes/Display/DAddCart.php');
		 
		include_once('classes/Core/CCurrencySettings.php');
		Core_CCurrencySettings::getDefaultCurrency();
		 
		$output['wishlistsnapshot'] = Core_CWishList::wishlistSnapshot();
		$output['cartSnapShot'] = Core_CAddCart::cartSnapShot();
		if($_SESSION['compareProductId']=='')
		{
			$output['viewProducts']['viewProducts'] = Display_DWishList::viewProductElse();
		}
		else
			$output['viewProducts']=Core_CWishList::addtoCompareProduct();
		
		$default=new Core_CNewProducts();
		$output['newproducts']=$default->newProducts();
		$output['loginStatus']= Core_CUserRegistration::loginStatus();
		$output['headermenu'] = Core_CUserRegistration::showHeaderMenu();
		$output['headermenuhidden']= Core_CUserRegistration::showHeaderMenuHidden();
		$output['headertext'] = Core_CUserRegistration::showHeaderText();
		$output['currencysettings']=Core_CUserRegistration::showCurrencySettings();
		include('classes/Core/CKeywordSearch.php');
		include('classes/Display/DKeywordSearch.php');
		include('classes/Core/CHome.php');
		$output['sitelogo']=Core_CHome::getLogo();
		$output['pagetitle']=Core_CHome::pageTitle();
		$output['timezone']=Core_CHome::setTimeZone();	
		$output['currentDate']=date('D,M d,Y - h:i A');
		$output['skinname']=Core_CHome::skinName();
		$output['banner']=Core_CHome::getBanner();
		$output['footerconnect']=Core_CHome::getfooterconnect();
		$output['sociallink']=Core_CHome::showSocialLinks();
		$output['googlead']=Core_CHome::getGoogleAd();
		
	 	$sort=$_POST['selsort'];
	
		$mode=$_POST['selmode'];
																$output['dispsubcat']=Core_CKeywordSearch::dispSubCategory();
        	$output['extendedsearch'] =  Core_CKeywordSearch::extendedSearch($sort,$mode);
		$cou=$_SESSION['countsearch'];
		$output['countrecords']=Core_CKeywordSearch::countSearch($cou);
		$output['disppagesize']=Display_DKeywordSearch::displayPageSize();

		$output['searchsession']=Display_DKeywordSearch::searchSession($search);
		
  	   	 $output['disppricerange']=Core_CKeywordSearch::priceRange();
		if(($_POST['subcatsel']!="")or($_SESSION['subcategory']!=""))
  	   		 $output['features']=Core_CKeywordSearch::featureList();

		if(((int)$_SESSION['countsearch'])>0)
		$output['dispselection']=Display_DKeywordSearch::displaySelection();
		$output['brandwithcount']=Core_CKeywordSearch::dispBrandWithCount();

                $output['dropdowncat']=Core_CKeywordSearch::categoryDropDown();
		$output['mylink']=Core_CKeywordSearch::linkMode();

		$output['sortby']=Display_DKeywordSearch::sortBy();
	  	Bin_Template::createTemplate('searchpage.html',$output);
		
	}
	
}
?>