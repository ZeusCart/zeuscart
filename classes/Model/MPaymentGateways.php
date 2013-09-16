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
 * Payment gateway related  class
 *
 * @package   		Model_MPaymentGateways
 * @category    	Model
 * @author    		AJ Square Inc Dev Team
 * @link   		http://www.zeuscart.com
  * @copyright 	        Copyright (c) 2008 - 2013, AJ Square, Inc.
 * @version   		Version 4.0
 */

class Model_MPaymentGateways
{
	/**
	 * Stores the output 
	 *
	 * @var array 
	 */	
	var $output = array();	
	/**
	* This function is used to Display the PaymentMode
 	*
 	* @return string
	*/
	function optPaymentMode()
	{
	
		include('classes/Core/CUserRegistration.php');
		include('classes/Core/CAddCart.php');
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
		$output['skinname']=Core_CHome::skinName();
		$output['headermenu'] = Core_CUserRegistration::showHeaderMenu();
		$output['headermenuhidden']= Core_CUserRegistration::showHeaderMenuHidden();
		$output['currencysettings']=Core_CUserRegistration::showCurrencySettings();
		$output['googleanalytics']=Core_CHome::getGoogleAnalyticsCode();	
		$output['footer']=Core_CHome::footer();
		$output['footerconnect']=Core_CHome::getfooterconnect();
		$output['sociallink']=Core_CHome::showSocialLinks();
		$output['cartcount']=Core_CAddCart::countCart();
		
		Bin_Template::createTemplate('PaymentGateways.html',$output);
	
	}
	/**
	* This function is used to Display the success page after orderconfirmation and payment process
 	*
 	* @return string
	*/
	function success()
	{

		include('classes/Core/CUserRegistration.php');
		include('classes/Display/DUserRegistration.php');
		include('classes/Core/CPaymentGateways.php');
		include('classes/Display/DPaymentGateways.php');	
		include('classes/Core/CAddCart.php');
		include_once('classes/Core/CCurrencySettings.php');
		Core_CCurrencySettings::getDefaultCurrency();

		$output['payments']=Core_CPaymentGateways::optPaymentMode();
			
                $output['selectedpayment']=$_POST['paymentBy'];
		include('classes/Core/CHome.php');
		include('classes/Display/DAddCart.php');
		$output['loginStatus']= Core_CUserRegistration::loginStatus();
		$output['cartSnapShot'] = Core_CAddCart::cartSnapShot();
		$output['sitelogo']=Core_CHome::getLogo();
		$output['pagetitle']=Core_CHome::pageTitle();
		$output['timezone']=Core_CHome::setTimeZone();	
		$output['currentDate']=date('D,M d,Y - h:i A');
		$output['skinname']=Core_CHome::skinName();
		$output['headermenu'] = Core_CUserRegistration::showHeaderMenu();
		$output['headermenuhidden']= Core_CUserRegistration::showHeaderMenuHidden();
		$output['currencysettings']=Core_CUserRegistration::showCurrencySettings();
		$output['googleanalytics']=Core_CHome::getGoogleAnalyticsCode();
		
	
		$output['ret'] =   Core_CPaymentGateways::success();				
		$output['success'] =   '<div class="alert alert-success">
		<button data-dismiss="alert" class="close" type="button">×</button>
		Your Order has been Placed Successfully .
		</div>';

	/*
		$output['footer']=Core_CHome::footer();	
		$output['footerconnect']=Core_CHome::getfooterconnect();
		$output['sociallink']=Core_CHome::showSocialLinks();
		$output['cartcount']=Core_CAddCart::countCart();			
		Bin_Template::createTemplate('success.html',$output);*/
		header('Location:?do=myorder');
	
	}
	/**
	* This function is used to Display the failure page after orderconfirmation and payment process
 	*
 	* @return string
	*/
	function failure()
	{

		include('classes/Core/CUserRegistration.php');
		include('classes/Display/DUserRegistration.php');
		include('classes/Core/CPaymentGateways.php');
		include('classes/Display/DPaymentGateways.php');
		include('classes/Core/CAddCart.php');
		include_once('classes/Core/CCurrencySettings.php');
		Core_CCurrencySettings::getDefaultCurrency();	

		$output['payments']=Core_CPaymentGateways::optPaymentMode();
			
       		 $output['selectedpayment']=$_POST['paymentBy'];
		include('classes/Core/CHome.php');
		include('classes/Display/DAddCart.php');
		$output['loginStatus']= Core_CUserRegistration::loginStatus();
		$output['cartSnapShot'] = Core_CAddCart::cartSnapShot();
		$output['sitelogo']=Core_CHome::getLogo();
		$output['pagetitle']=Core_CHome::pageTitle();
		$output['timezone']=Core_CHome::setTimeZone();	
		$output['currentDate']=date('D,M d,Y - h:i A');
		$output['skinname']=Core_CHome::skinName();
		$output['headermenu'] = Core_CUserRegistration::showHeaderMenu();
		$output['headermenuhidden']= Core_CUserRegistration::showHeaderMenuHidden();
		$output['currencysettings']=Core_CUserRegistration::showCurrencySettings();
		$output['googleanalytics']=Core_CHome::getGoogleAnalyticsCode();	
		$output['footerconnect']=Core_CHome::getfooterconnect();
		$output['sociallink']=Core_CHome::showSocialLinks();
		$output['cartcount']=Core_CAddCart::countCart();
	
		$output['failure'] =   '<div class="alert alert-error">
		<button data-dismiss="alert" class="close" type="button">×</button>
		Payment Failure Your Payment has not been made.
		</div>';				

		Bin_Template::createTemplate('failure.html',$output);
		
	    
	}
	
	
}
?>