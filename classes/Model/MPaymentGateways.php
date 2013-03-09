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
class Model_MPaymentGateways
{
	var $output = array();	
	/**
	* This function is used to Display the PaymentMode
 	*/
	function optPaymentMode()
	{
	
		include('classes/Core/CUserRegistration.php');
		
		include('classes/Core/CPaymentGateways.php');
		include('classes/Display/DPaymentGateways.php');
		
		include_once('classes/Core/CCurrencySettings.php');
		Core_CCurrencySettings::getDefaultCurrency();	
			
		$output['payments']=Core_CPaymentGateways::optPaymentMode();
			Core_CPaymentGateways::insertShipping();	
                $output['selectedpayment']=$_POST['paymentBy'];
		include('classes/Core/CHome.php');
		include('classes/Core/CAddCart.php');
		include('classes/Display/DAddCart.php');
		$output['loginStatus']= Core_CUserRegistration::loginStatus();
		$output['cartSnapShot'] = Core_CAddCart::cartSnapShot();
		$output['sitelogo']=Core_CHome::getLogo();
		$output['pagetitle']=Core_CHome::pageTitle();
		$output['timezone']=Core_CHome::setTimeZone();	
		$output['currentDate']=date('D,M d,Y - h:i A');
		//$output['signup']=Display_DUserRegistration::signUp();
		$output['skinname']=Core_CHome::skinName();
		$output['googleanalytics']=Core_CHome::getGoogleAnalyticsCode();	
		$output['footer']=Core_CHome::footer();
		Bin_Template::createTemplate('PaymentGateways.html',$output);
	
	}
	/**
	* This function is used to Display the success page after orderconfirmation and payment process
 	*/
	function success()
	{
		
		include('classes/Core/CUserRegistration.php');
		include('classes/Display/DUserRegistration.php');
		include('classes/Core/CPaymentGateways.php');
		include('classes/Display/DPaymentGateways.php');	
		
		include_once('classes/Core/CCurrencySettings.php');
		Core_CCurrencySettings::getDefaultCurrency();

		$output['payments']=Core_CPaymentGateways::optPaymentMode();
			
                 $output['selectedpayment']=$_POST['paymentBy'];
		include('classes/Core/CHome.php');
		include('classes/Core/CAddCart.php');
		include('classes/Display/DAddCart.php');
		$output['loginStatus']= Core_CUserRegistration::loginStatus();
		$output['cartSnapShot'] = Core_CAddCart::cartSnapShot();
		$output['sitelogo']=Core_CHome::getLogo();
		$output['pagetitle']=Core_CHome::pageTitle();
		$output['timezone']=Core_CHome::setTimeZone();	
		$output['currentDate']=date('D,M d,Y - h:i A');
		$output['skinname']=Core_CHome::skinName();
		$output['googleanalytics']=Core_CHome::getGoogleAnalyticsCode();	
		$output['ret'] =   Core_CPaymentGateways::success();				
		$output['success'] =   '<div class="success_msgbox">Your Order has been Placed Successfully </div>';		
		$output['footer']=Core_CHome::footer();				
		Bin_Template::createTemplate('success.html',$output);
	
	}
	/**
	* This function is used to Display the failure page after orderconfirmation and payment process
 	*/
	function failure()
	{
		include('classes/Core/CUserRegistration.php');
		include('classes/Display/DUserRegistration.php');
		include('classes/Core/CPaymentGateways.php');
		include('classes/Display/DPaymentGateways.php');
		
		include_once('classes/Core/CCurrencySettings.php');
		Core_CCurrencySettings::getDefaultCurrency();	

		$output['payments']=Core_CPaymentGateways::optPaymentMode();
			
       		 $output['selectedpayment']=$_POST['paymentBy'];
		include('classes/Core/CHome.php');
		include('classes/Core/CAddCart.php');
		include('classes/Display/DAddCart.php');
		$output['loginStatus']= Core_CUserRegistration::loginStatus();
		$output['cartSnapShot'] = Core_CAddCart::cartSnapShot();
		$output['sitelogo']=Core_CHome::getLogo();
		$output['pagetitle']=Core_CHome::pageTitle();
		$output['timezone']=Core_CHome::setTimeZone();	
		$output['currentDate']=date('D,M d,Y - h:i A');
		$output['skinname']=Core_CHome::skinName();
		$output['googleanalytics']=Core_CHome::getGoogleAnalyticsCode();	
			
		$output['failure'] =   'Payment Failure Your Payment has not been made';				
		Bin_Template::createTemplate('failure.html',$output);
		
	    
	}
	
	
}
?>