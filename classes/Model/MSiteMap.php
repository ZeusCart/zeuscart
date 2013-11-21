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
 * Site map  related  class
 *
 * @package   		Model_MSiteMap
 * @category    	Model
 * @author    		AJ Square Inc Dev Team
 * @link   		http://www.zeuscart.com
  * @copyright 	        Copyright (c) 2008 - 2013, AJ Square, Inc.
 * @version   		Version 4.0
 */
class Model_MSiteMap
{
	/**
	 * Stores the output 
	 *
	 * @var array 
	 */	
	var $output = array();
	/**
	* This function is used to Show map
 	*
 	* @return HTML data
	*/
	function showMap()
	{

		//language	
		include_once('classes/Core/CLanguage.php');
		Core_CLanguage::setLanguage('SITE_MAP');

		include('classes/Core/CKeywordSearch.php');
		include('classes/Display/DKeywordSearch.php');
		include('classes/Core/CUserRegistration.php');
		include('classes/Display/DUserRegistration.php');
		include('classes/Core/CHome.php');
		include_once('classes/Core/CAddCart.php');
		include('classes/Core/CSiteMap.php');		
		
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
		$output['headermenuhidden']= Core_CUserRegistration::showHeaderMenuHidden();
		$output['sitemap']=Core_CSiteMap::showMap();
		$output['cartcount']=Core_CAddCart::countCart();
		Bin_Template::createTemplate('sitemap.html',$output);
	}
}
?>