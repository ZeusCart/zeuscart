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
 * Product review related  class
 *
 * @package   		Model_MProductReview
 * @category    	Model
 * @author    		AJ Square Inc Dev Team
 * @link   		http://www.zeuscart.com
  * @copyright 	        Copyright (c) 2008 - 2013, AJ Square, Inc.
 * @version   		Version 4.0
 */
class Model_MProductReview
{
	/**
	 * Stores the output 
	 *
	 * @var array 
	 */	
	var $output = array();
	/**
	* This function is used to Display the product review page
 	*
 	* @return string
	*/
	function showProductReview()
	{	
		
		if(!isset($_SESSION['user_id']))
		{
			$prodid = $_GET['prodid'];
			$_SESSION['RequestUrl'] = '?do=productreview&action=showproductreview&prodid='.$prodid;
			header("Location:?do=login");
		}
		else
		{
			include("classes/Lib/HandleErrors.php");
			$output['val']=$Err->values;
			$output['msg']=$Err->messages;
	
			include('classes/Core/CProductReview.php');
			include('classes/Display/DProductReview.php');
			include('classes/Display/DWishList.php');
			include('classes/Core/CUserRegistration.php');
			include('classes/Display/DUserRegistration.php');
			include('classes/Core/CWishList.php');	
			include_once('classes/Core/CNewProducts.php');
			include_once('classes/Display/DNewProducts.php');
			include('classes/Core/CKeywordSearch.php');
			include('classes/Display/DKeywordSearch.php');
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
			$output['sitelogo']=Core_CHome::getLogo();
			$output['pagetitle']=Core_CHome::pageTitle();
			$output['timezone']=Core_CHome::setTimeZone();	
			$output['currentDate']=date('D,M d,Y - h:i A');
			$output['skinname']=Core_CHome::skinName();
			$output['googleanalytics']=Core_CHome::getGoogleAnalyticsCode();
			$output['footer']=Core_CHome::footer();
			$output['footerconnect']=Core_CHome::getfooterconnect();
			$output['sociallink']=Core_CHome::showSocialLinks();
			$output['dropdowncat']=Core_CKeywordSearch::categoryDropDown();
			$output['reviewproduct'] = Core_CProductReview::showProductReview($Err);
			$output['cartSnapShot'] = Core_CAddCart::cartSnapShot();
			if($_SESSION['compareProductId']=='')
			{
				$output['viewProducts']['viewProducts'] = Display_DWishList::viewProductElse();
			}
			else
				$output['viewProducts']=Core_CWishList::addtoCompareProduct();
			$default = new Core_CWishList();
			$output['wishlist'] = $default->addtoWishList();
			$output['loginStatus'] = Core_CUserRegistration::loginStatus();
			$output['headermenu'] = Core_CUserRegistration::showHeaderMenu();
			$output['headermenuhidden']= Core_CUserRegistration::showHeaderMenuHidden();
			$output['headertext'] = Core_CUserRegistration::showHeaderText();
			$default=new Core_CNewProducts();
			$output['newproducts']=$default->newProducts();
			$output['wishlistsnapshot'] = Core_CWishList::wishlistSnapshot();
			Bin_Template::createTemplate('reviews.html',$output);
		}
	}
	/**
	* This function is used to Display the add review to the selected product
 	*
 	* @return string
	*/

	function addProductReview()
	{
		
		include('classes/Lib/CheckInputs.php');
		$obj = new Lib_CheckInputs('productReview');
		
		include('classes/Core/CProductReview.php');
		include('classes/Display/DProductReview.php');
		include('classes/Display/DWishList.php');
		include('classes/Core/CUserRegistration.php');
		include('classes/Display/DUserRegistration.php');
		include('classes/Core/CWishList.php');	
		include_once('classes/Core/CNewProducts.php');
		include_once('classes/Display/DNewProducts.php');
		
		include('classes/Core/CKeywordSearch.php');
		include('classes/Display/DKeywordSearch.php');
		include('classes/Core/CHome.php');
		include_once('classes/Core/CLastViewedProducts.php');
		include_once('classes/Display/DLastViewedProducts.php');
		
		include_once('classes/Core/CCurrencySettings.php');
		Core_CCurrencySettings::getDefaultCurrency();
		
		$output['signup']=Display_DUserRegistration::signUp();
		$default=new Core_CLastViewedProducts();
		$output['lastviewedproducts']=$default->lastViewedProducts();
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
		$output['dropdowncat']=Core_CKeywordSearch::categoryDropDown();
		include('classes/Core/CAddCart.php');
		include('classes/Display/DAddCart.php');
		$output['cartSnapShot'] = Core_CAddCart::cartSnapShot();
		$default = new Core_CProductReview();
		$output['addreviewproduct'] = $default->addProductReview();
		$output['reviewproduct'] = $default->showProductReview('');
		if($_SESSION['compareProductId']=='')
		{
			$output['viewProducts']['viewProducts'] = Display_DWishList::viewProductElse();
		}
		else
			$output['viewProducts']=Core_CWishList::addtoCompareProduct();
		$default = new Core_CWishList();
		$output['wishlist'] = $default->addtoWishList();
		$output['loginStatus'] = Core_CUserRegistration::loginStatus();
		$output['headermenu'] = Core_CUserRegistration::showHeaderMenu();
		$output['headermenuhidden']= Core_CUserRegistration::showHeaderMenuHidden();
		$output['headertext'] = Core_CUserRegistration::showHeaderText();
		
		$default=new Core_CNewProducts();
		$output['newproducts']=$default->newProducts();
		$output['wishlistsnapshot'] = Core_CWishList::wishlistSnapshot();
		Bin_Template::createTemplate('reviews.html',$output);
	}
	/**
	* This function is used to Display the compare product  page
 	*
 	* @return string
	*/
	function compareProduct()
	{	
		
			include("classes/Lib/HandleErrors.php");
			$output['val']=$Err->values;
			$output['msg']=$Err->messages;
	
			include('classes/Core/CProductReview.php');
			include('classes/Display/DProductReview.php');
			include('classes/Display/DWishList.php');
			include('classes/Core/CUserRegistration.php');
			include('classes/Display/DUserRegistration.php');
			include('classes/Core/CWishList.php');	
			include_once('classes/Core/CNewProducts.php');
			include_once('classes/Display/DNewProducts.php');
			include('classes/Core/CKeywordSearch.php');
			include('classes/Display/DKeywordSearch.php');
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
			$output['sitelogo']=Core_CHome::getLogo();
			$output['pagetitle']=Core_CHome::pageTitle();
			$output['timezone']=Core_CHome::setTimeZone();	
			$output['currentDate']=date('D,M d,Y - h:i A');
			$output['skinname']=Core_CHome::skinName();
			$output['googleanalytics']=Core_CHome::getGoogleAnalyticsCode();
			$output['footer']=Core_CHome::footer();
			$output['footerconnect']=Core_CHome::getfooterconnect();
			$output['sociallink']=Core_CHome::showSocialLinks();
			$output['dropdowncat']=Core_CKeywordSearch::categoryDropDown();
			$output['reviewproduct'] = Core_CProductReview::showProductReview($Err);
			$output['cartSnapShot'] = Core_CAddCart::cartSnapShot();
			
			
			$output['viewProducts']=Core_CWishList::addtoCompareProduct();	
			$default = new Core_CWishList();
			$output['wishlist'] = $default->addtoWishList();
			$output['loginStatus'] = Core_CUserRegistration::loginStatus();
			$output['headermenu'] = Core_CUserRegistration::showHeaderMenu();
			$output['headermenuhidden']= Core_CUserRegistration::showHeaderMenuHidden();
			$output['headertext'] = Core_CUserRegistration::showHeaderText();
			$default=new Core_CNewProducts();
			$output['newproducts']=$default->newProducts();
			$output['wishlistsnapshot'] = Core_CWishList::wishlistSnapshot();
			Bin_Template::createTemplate('reviews.html',$output);
	}
	
}
?>