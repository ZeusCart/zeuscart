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
class Model_MFooterLinks
{
	var $output=array();
 	/**
	* This function is used to Display the Terms & Condition Page
 	*/
	function termsCondition()
	{
		include('classes/Core/CFooterLinks.php');
		include('classes/Display/DFooterLinks.php');
		include('classes/Core/CHome.php');
		include('classes/Core/CUserRegistration.php');
		include('classes/Display/DUserRegistration.php');
		include_once('classes/Core/CLastViewedProducts.php');
		include_once('classes/Display/DLastViewedProducts.php');
		include('classes/Core/CNews.php');
		include('classes/Display/DNews.php');
		
		include_once('classes/Core/CCurrencySettings.php');
		Core_CCurrencySettings::getDefaultCurrency();
		
		$output['timezone']=Core_CHome::setTimeZone();	
		$output['currentDate']=date('D,M d,Y - h:i A');

		$output['categories'] = Display_DUserRegistration::showMainCat();
		$default=new Core_CLastViewedProducts();
		$output['lastviewedproducts']=$default->lastViewedProducts();
		$output['sitelogo']=Core_CHome::getLogo();
		$output['pagetitle']=Core_CHome::pageTitle();
		$output['skinname']=Core_CHome::skinName();
		$output['googleanalytics']=Core_CHome::getGoogleAnalyticsCode();
		$output['googlead']=Core_CHome::getGoogleAd();
		$output['terms']=Core_CFooterLinks::termsCondition();
		$output['headermenu'] = Core_CUserRegistration::showHeaderMenu();
		$output['headertext'] = Core_CUserRegistration::showHeaderText();
		$output['loginStatus'] = Core_CUserRegistration::loginStatus();
		$output['terms'] = Core_CFooterLinks::termsCondition();
		$output['newstitle'] = Core_CNews::showNewsMenu();
		Bin_Template::createTemplate('termsandconditions.html',$output);
	}
	
 	/**
	* This function is used to Display the Privacy Ploicy Page
 	*/
	function privacyPolicy()
	{
		include('classes/Core/CFooterLinks.php');
		include('classes/Display/DFooterLinks.php');
		include('classes/Core/CHome.php');
		include('classes/Core/CUserRegistration.php');
		include('classes/Display/DUserRegistration.php');
		include_once('classes/Core/CLastViewedProducts.php');
		include_once('classes/Display/DLastViewedProducts.php');
		include('classes/Core/CNews.php');
		include('classes/Display/DNews.php');
		
		include_once('classes/Core/CCurrencySettings.php');
		Core_CCurrencySettings::getDefaultCurrency();
		
		$output['timezone']=Core_CHome::setTimeZone();	
		$output['currentDate']=date('D,M d,Y - h:i A');
		$output['categories'] = Display_DUserRegistration::showMainCat();
		$default=new Core_CLastViewedProducts();
		$output['lastviewedproducts']=$default->lastViewedProducts();
		$output['sitelogo']=Core_CHome::getLogo();
		$output['pagetitle']=Core_CHome::pageTitle();
		$output['skinname']=Core_CHome::skinName();
		$output['googleanalytics']=Core_CHome::getGoogleAnalyticsCode();
		$output['googlead']=Core_CHome::getGoogleAd();
		$output['terms']=Core_CFooterLinks::termsCondition();
		$output['headermenu'] = Core_CUserRegistration::showHeaderMenu();
		$output['headertext'] = Core_CUserRegistration::showHeaderText();
		$output['loginStatus'] = Core_CUserRegistration::loginStatus();
		$output['privacypolicy'] = Core_CFooterLinks::privacyPolicy();
		$output['newstitle'] = Core_CNews::showNewsMenu();
		Bin_Template::createTemplate('privacypolicy.html',$output);
	}
	
	
 	/**
	* This function is used to Display the Contact Us Page
 	*/
	function showContactUs()
	{
		include("classes/Lib/HandleErrors.php");
		
		$output['val']=$Err->values;
		$output['msg']=$Err->messages;
		
		
		include('classes/Core/CFooterLinks.php');
		include('classes/Display/DFooterLinks.php');
		include('classes/Core/CHome.php');
		include('classes/Core/CUserRegistration.php');
		include('classes/Display/DUserRegistration.php');
		include_once('classes/Core/CLastViewedProducts.php');
		include_once('classes/Display/DLastViewedProducts.php');
		include('classes/Core/CNews.php');
		include('classes/Display/DNews.php');
		
		include_once('classes/Core/CCurrencySettings.php');
		Core_CCurrencySettings::getDefaultCurrency();
		
		$output['timezone']=Core_CHome::setTimeZone();	
		$output['currentDate']=date('D,M d,Y - h:i A');
		$output['categories'] = Display_DUserRegistration::showMainCat();
		$default=new Core_CLastViewedProducts();
		$output['lastviewedproducts']=$default->lastViewedProducts();
		$output['sitelogo']=Core_CHome::getLogo();
		$output['pagetitle']=Core_CHome::pageTitle();
		$output['skinname']=Core_CHome::skinName();
		$output['googleanalytics']=Core_CHome::getGoogleAnalyticsCode();
		$output['googlead']=Core_CHome::getGoogleAd();
		$output['terms']=Core_CFooterLinks::termsCondition();
		$output['headermenu'] = Core_CUserRegistration::showHeaderMenu();
		$output['headertext'] = Core_CUserRegistration::showHeaderText();
		$output['loginStatus'] = Core_CUserRegistration::loginStatus();
		$output['contactus'] = Display_DFooterLinks::showContactUs($Err);
		$output['newstitle'] = Core_CNews::showNewsMenu();
		Bin_Template::createTemplate('contactus.html',$output);
	}
	
 	/**
	* This function is used to Display the Validation Result of Cotact Us Page
 	*/
	function showValidateContactUs()
	{
		include('classes/Lib/CheckInputs.php');
		$obj = new Lib_CheckInputs('contactus');
		
		
		include('classes/Core/CFooterLinks.php');
		include('classes/Display/DFooterLinks.php');
		include('classes/Core/CHome.php');
		include('classes/Core/CUserRegistration.php');
		include('classes/Display/DUserRegistration.php');
		include_once('classes/Core/CLastViewedProducts.php');
		include_once('classes/Display/DLastViewedProducts.php');
		include('classes/Core/CNews.php');
		include('classes/Display/DNews.php');
		
		include_once('classes/Core/CCurrencySettings.php');
		Core_CCurrencySettings::getDefaultCurrency();
		
		$default=new Core_CLastViewedProducts();
		$output['lastviewedproducts']=$default->lastViewedProducts();
		$output['categories'] = Display_DUserRegistration::showMainCat();
		$output['sitelogo']=Core_CHome::getLogo();
		$output['pagetitle']=Core_CHome::pageTitle();
		$output['skinname']=Core_CHome::skinName();
		$output['googleanalytics']=Core_CHome::getGoogleAnalyticsCode();
		$output['googlead']=Core_CHome::getGoogleAd();
		$output['terms']=Core_CFooterLinks::termsCondition();
		$output['headermenu'] = Core_CUserRegistration::showHeaderMenu();
		$output['headertext'] = Core_CUserRegistration::showHeaderText();
		$output['loginStatus'] = Core_CUserRegistration::loginStatus();
		$output['message'] = Core_CFooterLinks::validateContactUs();
		$output['contactus'] = Display_DFooterLinks::showContactUs('');
		$output['newstitle'] = Core_CNews::showNewsMenu();
		Bin_Template::createTemplate('contactus.html',$output);
	}
	
 	/**
	* This function is used to Display the about us Page
 	*/
	function aboutUs()
	{
		include('classes/Core/CFooterLinks.php');
		include('classes/Display/DFooterLinks.php');
		include('classes/Core/CHome.php');
		include('classes/Core/CUserRegistration.php');
		include('classes/Display/DUserRegistration.php');
		include_once('classes/Core/CLastViewedProducts.php');
		include_once('classes/Display/DLastViewedProducts.php');
		include('classes/Core/CNews.php');
		include('classes/Display/DNews.php');
		
		
		include_once('classes/Core/CCurrencySettings.php');
		Core_CCurrencySettings::getDefaultCurrency();

		$output['timezone']=Core_CHome::setTimeZone();	
		$output['currentDate']=date('D,M d,Y - h:i A');

		$output['categories'] = Display_DUserRegistration::showMainCat();
		$default=new Core_CLastViewedProducts();
		$output['lastviewedproducts']=$default->lastViewedProducts();
		$output['sitelogo']=Core_CHome::getLogo();
		$output['pagetitle']=Core_CHome::pageTitle();
		$output['skinname']=Core_CHome::skinName();
		$output['googleanalytics']=Core_CHome::getGoogleAnalyticsCode();
		$output['googlead']=Core_CHome::getGoogleAd();
		$output['terms']=Core_CFooterLinks::termsCondition();
		$output['headermenu'] = Core_CUserRegistration::showHeaderMenu();
		$output['headertext'] = Core_CUserRegistration::showHeaderText();
		$output['loginStatus'] = Core_CUserRegistration::loginStatus();
		$output['aboutus'] = Core_CFooterLinks::aboutUs();
		$output['newstitle'] = Core_CNews::showNewsMenu();
		
		Bin_Template::createTemplate('aboutus.html',$output);
	}
}
?>