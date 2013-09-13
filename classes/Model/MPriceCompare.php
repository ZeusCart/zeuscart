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
 * Price comparison related  class
 *
 * @package   		Model_MPriceCompare
 * @category    	Model
 * @author    		AJ Square Inc Dev Team
 * @link   		http://www.zeuscart.com
  * @copyright 	        Copyright (c) 2008 - 2013, AJ Square, Inc.
 * @version   		Version 4.0
 */
class Model_MPriceCompare
{

	/**
	 * Stores the output 
	 *
	 * @var array 
	 */	
	var $output = array();
	/**
	* This function is used to Display the price compare page
 	*
 	* @return string
	*/
	function showPriceComparePage()
	{
			include_once('classes/Core/CPriceCompare.php');
			include_once('classes/Display/DPriceCompare.php');
			include_once('classes/Core/CUserRegistration.php');
			include_once('classes/Display/DUserRegistration.php');
			include_once('classes/Core/CWishList.php');
			include_once('classes/Display/DWishList.php');
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
			
			$default=new Core_CLastViewedProducts();
			$output['lastviewedproducts']=$default->lastViewedProducts();
			$output['loginStatus']= Core_CUserRegistration::loginStatus();
			$output['cartSnapShot'] = Core_CAddCart::cartSnapShot();
			$output['sitelogo']=Core_CHome::getLogo();
			$output['pagetitle']=Core_CHome::pageTitle();
			$output['timezone']=Core_CHome::setTimeZone();	
			$output['currentDate']=date('D,M d,Y - h:i A');
			$output['signup']=Display_DUserRegistration::signUp();
			$output['skinname']=Core_CHome::skinName();
			$output['googlead']=Core_CHome::getGoogleAd();
			$output['googleanalytics']=Core_CHome::getGoogleAnalyticsCode();
			$output['footer']=Core_CHome::footer();
			$output['footerconnect']=Core_CHome::getfooterconnect();
			$output['sociallink']=Core_CHome::showSocialLinks();
			$output['dropdowncat']=Core_CKeywordSearch::categoryDropDown();
			$default = new Core_CPriceCompare();	
			$output['pricecompare'] = $default->showPriceComparePage();
			if($_SESSION['compareProductId']=='')
				$output['viewProducts']['viewProducts'] = Display_DWishList::viewProductElse();
			else
				$output['viewProducts']=Core_CWishList::addtoCompareProduct();
			
			if($_SESSION['user_id']!='')
				$output['wishlistsnapshot'] = Core_CWishList::wishlistSnapshot();
		
			$output['headermenu'] = Core_CUserRegistration::showHeaderMenu();
			$output['headertext'] = Core_CUserRegistration::showHeaderText();
			$output['headermenuhidden']= Core_CUserRegistration::showHeaderMenuHidden();
			$default=new Core_CNewProducts();
			$output['newproducts']=$default->newProducts();
			
			$output['userRight'] = "userdashboard.html";					
			$output['rows']=Core_CPriceCompare::showPriceComparePage();
		
			Bin_Template::createTemplate('userIndex.html',$output);
		
	}
}
?>
