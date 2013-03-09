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
class Model_MQuickInfo
{
	var $output = array();
	/**
	* This function is used to Display the quick information of product  page
 	*/
	function showQuickInfo()
	{
		
		include('classes/Core/CQuickInfo.php');
		include('classes/Display/DUserRegistration.php');
		include('classes/Core/CKeywordSearch.php');
  		include('classes/Display/DKeywordSearch.php');
		include('classes/Core/CWishList.php');		
		include('classes/Core/CHome.php');
		include_once('classes/Core/CLastViewedProducts.php');
		include_once('classes/Display/DLastViewedProducts.php');
		include('classes/Core/CUserRegistration.php');
		
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
		$output['dropdowncat']=Core_CKeywordSearch::categoryDropDown();
		$output['loginStatus'] = Core_CUserRegistration::loginStatus();

		$output['result']=Core_CQuickInfo::showInfo();
		Bin_Template::createTemplate('quickinfo.html',$output);
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