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
class Model_MHome
{
 	/**
	* This function is used to Display the Home Page
 	*/
	function homePage()
	{
		$output=array();
		include('classes/Core/CHome.php');
		
		include_once('classes/Core/CCurrencySettings.php');
		Core_CCurrencySettings::getDefaultCurrency();

		$output['sitelogo']=Core_CHome::getLogo();
		$output['pagetitle']=Core_CHome::pageTitle();
		$output['skinname']=Core_CHome::skinName();
		
		$output['timezone']=Core_CHome::setTimeZone();		
		$output['currentDate']=date('D,M d,Y - h:i A');		
		$output['banner']=Core_CHome::getBanner();
		
		$output['googleanalytics']=Core_CHome::getGoogleAnalyticsCode();
		$output['googlead']=Core_CHome::getGoogleAd();
		$output['footer']=Core_CHome::footer();
		Bin_Template::createTemplate('header.html',$output);
	}	
	
}
?>