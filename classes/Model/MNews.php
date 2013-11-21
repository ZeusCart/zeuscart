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
 * News related  class
 *
 * @package   		Model_MNews
 * @category    	Model
 * @author    		AJ Square Inc Dev Team
 * @link   		http://www.zeuscart.com
  * @copyright 	        Copyright (c) 2008 - 2013, AJ Square, Inc.
 * @version   		Version 4.0
 */

class Model_MNews
{
	/**
	 * Stores the output 
	 *
	 * @var array 
	 */	
	var $output = array();
	
 	/**
	* This function is used to Display the News Page
 	*
 	* @return string
	*/
	function showNewsPage()
	{
		//language	
		include_once('classes/Core/CLanguage.php');
		Core_CLanguage::setLanguage('CMS');

		include_once('classes/Core/CFeaturedItems.php');
		include_once('classes/Display/DFeaturedItems.php');
		include('classes/Core/CNews.php');
		include('classes/Display/DNews.php');
		include_once('classes/Core/CNewProducts.php');
		include_once('classes/Display/DNewProducts.php');
		include('classes/Core/CWishList.php');
		include('classes/Display/DWishList.php');
		include('classes/Core/CKeywordSearch.php');
  		include('classes/Display/DKeywordSearch.php');
		include('classes/Core/CHome.php');
		include('classes/Core/CAddCart.php');
		include('classes/Display/DAddCart.php');
		include('classes/Core/CUserRegistration.php');
		include('classes/Display/DUserRegistration.php'); 
		include('classes/Core/CProductDetail.php');
		include('classes/Display/DProductDetail.php');
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
		$output['cartSnapShot'] = Core_CAddCart::cartSnapShot();

		include_once('classes/Core/CLastViewedProducts.php');
		include_once('classes/Display/DLastViewedProducts.php');
		
		
		$output['signup']=Display_DUserRegistration::signUp();
		$default=new Core_CLastViewedProducts();
		$output['lastviewedproducts']=$default->lastViewedProducts();
		if($_SESSION['user_id']!='')
		$output['wishlistsnapshot'] = Core_CWishList::wishlistSnapshot();
		
		$output['loginStatus']= Core_CUserRegistration::loginStatus();
		$output['headermenu'] = Core_CUserRegistration::showHeaderMenu();
		$output['headermenuhidden']= Core_CUserRegistration::showHeaderMenuHidden();
		$output['currencysettings']=Core_CUserRegistration::showCurrencySettings();
		$output['headertext'] = Core_CUserRegistration::showHeaderText();
		$output['headerMainMenu'] = Core_CUserRegistration::showHeaderMainMenu();
		$output['categories'] = Display_DUserRegistration::showMainCat();
		$output['categorytree'] = Core_CProductDetail::showCategoryTree();
	    	$output['newscontent']=Core_CNews::showNewsPage();
		
       		 if($_SESSION['compareProductId']=='')
			$output['viewProducts']['viewProducts'] = Display_DWishList::viewProductElse();
		else
			$output['viewProducts']=Core_CWishList::addtoCompareProduct();
		Bin_Template::createTemplate('news.html',$output);
	}
}
?>