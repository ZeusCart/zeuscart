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
 * Add to cart  related  class
 *
 * @package   		Model_MAddCart
 * @category    	Model
 * @author    		AJ Square Inc Dev Team
 * @link   		http://www.zeuscart.com
  * @copyright 	        Copyright (c) 2008 - 2013, AJ Square, Inc.
 * @version   		Version 4.0
 */

class Model_MAddCart
{
	/**
	 * Stores the output
	 *
	 * @var array 
	 */
	var $output = array();	

	/**
	* This function is constructor of this class
 	*
 	* @return string
	*/
	function Model_MAddCart()
	{
		include_once('classes/Core/CLanguage.php');
		include_once('classes/Core/CAddCart.php');	
		include('classes/Core/CHome.php');	
		include_once('classes/Core/CLastViewedProducts.php');
		include('classes/Core/CKeywordSearch.php');	
		include('classes/Core/CNews.php');
		include('classes/Core/CUserRegistration.php');	
		include_once('classes/Core/CCurrencySettings.php');
		include('classes/Lib/TagClouds.php');
		include('classes/Core/CTagClouds.php');

		//Display files
		Core_CLanguage::setDisplay('DAddCart.php');		
		Core_CLanguage::setDisplay('DHome.php');
		Core_CLanguage::setDisplay('DLastViewedProducts.php');
		Core_CLanguage::setDisplay('DKeywordSearch.php');
		Core_CLanguage::setDisplay('DNews.php');	
		Core_CLanguage::setDisplay('DUserRegistration.php');

	}

	
	/**
	 * This function is used to view the add to cart  page.
	 *
	 * 
	 * 
	 * @return string
	 */
	function addCart()
	{

		//language	
		Core_CLanguage::setLanguage('CHECK_OUT');



	
		if(!isset($_SESSION['user_id']))
		{

			include("classes/Lib/HandleErrors.php");

			$prodid = $_GET['prodid'];			
			
			Core_CCurrencySettings::getDefaultCurrency();
			
			$output['val']=$Err->values;
			$output['msg']=$Err->messages;

			$output['sitelogo']=Core_CHome::getLogo();
			$output['pagetitle']=Core_CHome::pageTitle();
			$output['timezone']=Core_CHome::setTimeZone();	
			$output['currentDate']=date('D,M d,Y - h:i A');
			$output['signup']=Display_DUserRegistration::signUp();
			$output['skinname']=Core_CHome::skinName();
			$output['googleanalytics']=Core_CHome::getGoogleAnalyticsCode();
			$output['googlead']=Core_CHome::getGoogleAd();
			$output['footer']=Core_CHome::footer();
			$output['footerconnect']=Core_CHome::getfooterconnect();
			$output['sociallink']=Core_CHome::showSocialLinks();
			$output['dropdowncat']=Core_CKeywordSearch::categoryDropDown();
			
			$lastobj=new Core_CLastViewedProducts();
			$output['lastviewedproducts']=$lastobj->lastViewedProducts();
			
			$default=new Core_CAddCart();
			$output['addtocart']=$default->addCart();
			$output['showcart']=$default->showcart();
			$output['cartcount']=Core_CAddCart::countCart();
			$output['tagClouds']=Core_CTagClouds::displayTagClouds();
			
			$output['loginStatus'] = Core_CUserRegistration::loginStatus();
			$output['headermenu'] = Core_CUserRegistration::showHeaderMenu();
			$output['headermenuhidden']= Core_CUserRegistration::showHeaderMenuHidden();
			$output['currencysettings']=Core_CUserRegistration::showCurrencySettings();
			$output['headertext'] = Core_CUserRegistration::showHeaderText();

			Bin_Template::createTemplate('addtocart.html',$output);
			UNSET($_SESSION['cartmsg']);
		}
		else
		{
			

			Core_CCurrencySettings::getDefaultCurrency();
			
			$output['sitelogo']=Core_CHome::getLogo();
			$output['pagetitle']=Core_CHome::pageTitle();
			$output['timezone']=Core_CHome::setTimeZone();	
			$output['currentDate']=date('D,M d,Y - h:i A');
			$output['signup']=Display_DUserRegistration::signUp();
			$output['skinname']=Core_CHome::skinName();
			$output['googleanalytics']=Core_CHome::getGoogleAnalyticsCode();
			$output['googlead']=Core_CHome::getGoogleAd();
			$output['footer']=Core_CHome::footer();
			$output['footerconnect']=Core_CHome::getfooterconnect();
			$output['dropdowncat']=Core_CKeywordSearch::categoryDropDown();
			
			$lastobj=new Core_CLastViewedProducts();
			$output['lastviewedproducts']=$lastobj->lastViewedProducts();
			
			$default=new Core_CAddCart();
			$output['addtocart']=$default->addCart();
			$output['showcart']=$default->showcart();
			$output['cartcount']=Core_CAddCart::countCart();
			$output['tagClouds']=Core_CTagClouds::displayTagClouds();
			
			$output['loginStatus'] = Core_CUserRegistration::loginStatus();
			$output['headermenu'] = Core_CUserRegistration::showHeaderMenu();
			$output['headermenuhidden']= Core_CUserRegistration::showHeaderMenuHidden();
			$output['currencysettings']=Core_CUserRegistration::showCurrencySettings();
			$output['headertext'] = Core_CUserRegistration::showHeaderText();

			Bin_Template::createTemplate('addtocart.html',$output);
			UNSET($_SESSION['cartmsg']);
		}
		
	}
	/**
	 * This function is used to view the add to cart from product detalis page.
	 *
	 * 
	 * 
	 * @return string
	 */
	function addCartFromProductDetail()
	{

		//language	

		Core_CLanguage::setLanguage('CHECK_OUT');



		if($_GET['vid']=='1')
		{
			include('classes/Lib/CheckInputs.php');
			$obj = new Lib_CheckInputs('giftvoucher');
			$_SESSION['gift'][]=$_POST;
			$_SESSION['cartmsg'] = '<div class="alert alert-success">
			<button data-dismiss="alert" class="close" type="button">×</button>
			Thank you for purchasing a gift certificate! Once you have completed your order your gift voucher recipient will be sent an email with details how to redeem their gift voucher.
			</div>';
		}
		if(!isset($_SESSION['user_id']) && isset($_POST['addtocart']))
		{

			include("classes/Lib/HandleErrors.php");

			$prodid = $_GET['prodid'];
			
			$output['val']=$Err->values;
			$output['msg']=$Err->messages;
		
			Core_CCurrencySettings::getDefaultCurrency();
			
			$output['sitelogo']=Core_CHome::getLogo();
			$output['pagetitle']=Core_CHome::pageTitle();
			$output['timezone']=Core_CHome::setTimeZone();	
			$output['currentDate']=date('D,M d,Y - h:i A');
			$output['signup']=Display_DUserRegistration::signUp();
			$output['skinname']=Core_CHome::skinName();
			$output['googleanalytics']=Core_CHome::getGoogleAnalyticsCode();
			$output['googlead']=Core_CHome::getGoogleAd();
			$output['footer']=Core_CHome::footer();
			$output['footerconnect']=Core_CHome::getfooterconnect();
			$output['sociallink']=Core_CHome::showSocialLinks();
			$output['dropdowncat']=Core_CKeywordSearch::categoryDropDown();
			
			$lastobj=new Core_CLastViewedProducts();
			$output['lastviewedproducts']=$lastobj->lastViewedProducts();
			
			$default=new Core_CAddCart();
			$output['addtocart']=$default->addCartFromProductDetail();
			$output['showcart']=$default->showcart();

			$output['cartcount']=Core_CAddCart::countCart();
			$output['tagClouds']=Core_CTagClouds::displayTagClouds();
			
			$output['loginStatus'] = Core_CUserRegistration::loginStatus();
			$output['headermenu'] = Core_CUserRegistration::showHeaderMenu();
			$output['headermenuhidden']= Core_CUserRegistration::showHeaderMenuHidden();
			$output['currencysettings']=Core_CUserRegistration::showCurrencySettings();
			$output['headertext'] = Core_CUserRegistration::showHeaderText();
			Bin_Template::createTemplate('addtocart.html',$output);
			UNSET($_SESSION['cartmsg']);
			
		}
		else
		{
			
			Core_CCurrencySettings::getDefaultCurrency();
			
			$output['sitelogo']=Core_CHome::getLogo();
			$output['pagetitle']=Core_CHome::pageTitle();
			$output['timezone']=Core_CHome::setTimeZone();	
			$output['currentDate']=date('D,M d,Y - h:i A');
			$output['signup']=Display_DUserRegistration::signUp();
			$output['skinname']=Core_CHome::skinName();
			$output['googleanalytics']=Core_CHome::getGoogleAnalyticsCode();
			$output['googlead']=Core_CHome::getGoogleAd();
			$output['footer']=Core_CHome::footer();
			$output['footerconnect']=Core_CHome::getfooterconnect();
			$output['sociallink']=Core_CHome::showSocialLinks();
			$output['dropdowncat']=Core_CKeywordSearch::categoryDropDown();
			$lastobj=new Core_CLastViewedProducts();
			$output['lastviewedproducts']=$lastobj->lastViewedProducts();
			
			$default=new Core_CAddCart();
			$output['addtocart']=$default->addCartFromProductDetail();
			$output['showcart']=$default->showcart();
			$output['cartcount']=Core_CAddCart::countCart();
			$output['tagClouds']=Core_CTagClouds::displayTagClouds();
			
			$output['loginStatus'] = Core_CUserRegistration::loginStatus();
			$output['headermenu'] = Core_CUserRegistration::showHeaderMenu();
			$output['headermenuhidden']= Core_CUserRegistration::showHeaderMenuHidden();
			$output['currencysettings']=Core_CUserRegistration::showCurrencySettings();
			$output['headertext'] = Core_CUserRegistration::showHeaderText();
			Bin_Template::createTemplate('addtocart.html',$output);
			UNSET($_SESSION['cartmsg']);
		}
		
	}
	/**
	 * This function is used to view the cart items.
	 *
	 * 
	 * 
	 * @return string
	 */
	function showCart() 
	{
	
		//language	

		Core_CLanguage::setLanguage('CHECK_OUT');

		
		if(!isset($_SESSION['user_id']))
		{
			include("classes/Lib/HandleErrors.php");

			$prodid = $_GET['prodid'];
			$_SESSION['RequestUrl'] = '?do=showcart';
		
			
			$output['val']=$Err->values;
			$output['msg']=$Err->messages;
			
			Core_CCurrencySettings::getDefaultCurrency();
			
			$output['sitelogo']=Core_CHome::getLogo();
			$output['pagetitle']=Core_CHome::pageTitle();
			$output['timezone']=Core_CHome::setTimeZone();	
			$output['currentDate']=date('D,M d,Y - h:i A');
			$output['skinname']=Core_CHome::skinName();
			$output['googleanalytics']=Core_CHome::getGoogleAnalyticsCode();
			$output['footerconnect']=Core_CHome::getfooterconnect();
			$output['sociallink']=Core_CHome::showSocialLinks();
			$output['dropdowncat']=Core_CKeywordSearch::categoryDropDown();
			$output['signup']=Display_DUserRegistration::signUp();
			
			$lastobj=new Core_CLastViewedProducts();
			$output['lastviewedproducts']=$lastobj->lastViewedProducts();
			
			$default=new Core_CAddCart();
			$output['showcart']=$default->showcart();
			$output['cartcount']=Core_CAddCart::countCart();
			$output['tagClouds']=Core_CTagClouds::displayTagClouds();
			
			$output['loginStatus'] = Core_CUserRegistration::loginStatus();
			$output['headermenu'] = Core_CUserRegistration::showHeaderMenu();
			$output['headermenuhidden']= Core_CUserRegistration::showHeaderMenuHidden();
			$output['currencysettings']=Core_CUserRegistration::showCurrencySettings();
			$output['headertext'] = Core_CUserRegistration::showHeaderText();
	
			Bin_Template::createTemplate('addtocart.html',$output);
			UNSET($_SESSION['cartmsg']);
		}
		else
		{
		
			
			Core_CCurrencySettings::getDefaultCurrency();
			
			$output['sitelogo']=Core_CHome::getLogo();
			$output['pagetitle']=Core_CHome::pageTitle();
			$output['timezone']=Core_CHome::setTimeZone();	
			$output['currentDate']=date('D,M d,Y - h:i A');
			$output['skinname']=Core_CHome::skinName();
			$output['googleanalytics']=Core_CHome::getGoogleAnalyticsCode();
			$output['footerconnect']=Core_CHome::getfooterconnect();
			$output['sociallink']=Core_CHome::showSocialLinks();
			$output['dropdowncat']=Core_CKeywordSearch::categoryDropDown();
			$output['signup']=Display_DUserRegistration::signUp();
			
			$lastobj=new Core_CLastViewedProducts();
			$output['lastviewedproducts']=$lastobj->lastViewedProducts();
			
			$default=new Core_CAddCart();
			$output['showcart']=$default->showcart();
			$output['cartcount']=Core_CAddCart::countCart();
			$output['tagClouds']=Core_CTagClouds::displayTagClouds();
			
			$output['loginStatus'] = Core_CUserRegistration::loginStatus();
			$output['headermenu'] = Core_CUserRegistration::showHeaderMenu();
			$output['headermenuhidden']= Core_CUserRegistration::showHeaderMenuHidden();
			$output['currencysettings']=Core_CUserRegistration::showCurrencySettings();
			$output['headertext'] = Core_CUserRegistration::showHeaderText();
		
			Bin_Template::createTemplate('addtocart.html',$output);
			UNSET($_SESSION['cartmsg']);
		}
		
	}
			
	/**
	 * This function is used to delete the cart item.
	 *
	 * 
	 * 
	 * @return string
	 */		
	
	function deleteCart()
	{
		
		
		//language	

		Core_CLanguage::setLanguage('CHECK_OUT');
		
	
		Core_CCurrencySettings::getDefaultCurrency();
		
		$output['sitelogo']=Core_CHome::getLogo();
		$output['pagetitle']=Core_CHome::pageTitle();
		$output['timezone']=Core_CHome::setTimeZone();	
		$output['currentDate']=date('D,M d,Y - h:i A');
		$output['skinname']=Core_CHome::skinName();
		$output['googleanalytics']=Core_CHome::getGoogleAnalyticsCode();
		$output['footerconnect']=Core_CHome::getfooterconnect();
		$output['sociallink']=Core_CHome::showSocialLinks();
		$output['dropdowncat']=Core_CKeywordSearch::categoryDropDown();
		$default=new Core_CAddCart();
		$_SESSION['cartmsg']=$default->deleteCart();

		$output['loginStatus'] = Core_CUserRegistration::loginStatus();
		$output['headermenu'] = Core_CUserRegistration::showHeaderMenu();
		$output['headermenuhidden']= Core_CUserRegistration::showHeaderMenuHidden();
		$output['currencysettings']=Core_CUserRegistration::showCurrencySettings();
   		$output['headertext'] = Core_CUserRegistration::showHeaderText();
		$output['signup']=Display_DUserRegistration::signUp();
		$output['cartcount']=Core_CAddCart::countCart();
		$lastobj=new Core_CLastViewedProducts();
		$output['lastviewedproducts']=$lastobj->lastViewedProducts();
		
		$output['tagClouds']=Core_CTagClouds::displayTagClouds();
		
		header('Location:?do=addtocart');
		
		
	}
	/**
	 * This function is used to update the cart item.
	 *
	 * 
	 * 
	 * @return string
	 */
	function updateCart()
	{
		

		//language	
		Core_CLanguage::setLanguage('CHECK_OUT');


		$default=new Core_CAddCart();
	
		Core_CCurrencySettings::getDefaultCurrency();
		
		$output['sitelogo']=Core_CHome::getLogo();
		$output['pagetitle']=Core_CHome::pageTitle();
		$output['timezone']=Core_CHome::setTimeZone();	
		$output['currentDate']=date('D,M d,Y - h:i A');
		$output['skinname']=Core_CHome::skinName();
		$output['googleanalytics']=Core_CHome::getGoogleAnalyticsCode();
		$output['footerconnect']=Core_CHome::getfooterconnect();
		$output['sociallink']=Core_CHome::showSocialLinks();	
		$output['dropdowncat']=Core_CKeywordSearch::categoryDropDown();
		$output['signup']=Display_DUserRegistration::signUp();
		$default=new Core_CAddCart();
		
		$output['loginStatus'] = Core_CUserRegistration::loginStatus();
		$output['headermenu'] = Core_CUserRegistration::showHeaderMenu();
		$output['headermenuhidden']= Core_CUserRegistration::showHeaderMenuHidden();
		$output['currencysettings']=Core_CUserRegistration::showCurrencySettings();
		$output['headertext'] = Core_CUserRegistration::showHeaderText();
		
		$output['updatecart']=$default->updateCart();
		$output['showcart']=$default->showcart();
		$output['cartcount']=Core_CAddCart::countCart();
		$lastobj=new Core_CLastViewedProducts();
		$output['lastviewedproducts']=$lastobj->lastViewedProducts();
		
		$output['tagClouds']=Core_CTagClouds::displayTagClouds();
		
		Bin_Template::createTemplate('addtocart.html',$output);
		UNSET($_SESSION['cartmsg']);
	
	}
	/**
	 * This function is used to login  in check out page
	 *
	 * 
	 * 
	 * @return string
	 */
	function showQuickRegistration() 
	{
		

		//language	
		Core_CLanguage::setLanguage('CHECK_OUT');	
		

		if(!isset($_SESSION['user_id']))
		{

			include("classes/Lib/HandleErrors.php");	
			$output['val']=$Err->values;
			$output['msg']=$Err->messages;

			$prodid = $_GET['prodid'];
			$_SESSION['RequestUrl'] = '?do=showcart';
			
		
			Core_CCurrencySettings::getDefaultCurrency();
		
			if($_POST['addwish']=='on')
					$chk=1;
			else
					$chk=0;

			$output['sitelogo']=Core_CHome::getLogo();
			$output['pagetitle']=Core_CHome::pageTitle();
			$output['timezone']=Core_CHome::setTimeZone();	
			$output['currentDate']=date('D,M d,Y - h:i A');
			$output['skinname']=Core_CHome::skinName();
			$output['googleanalytics']=Core_CHome::getGoogleAnalyticsCode();
			$output['footerconnect']=Core_CHome::getfooterconnect();
			$output['sociallink']=Core_CHome::showSocialLinks();
			$output['dropdowncat']=Core_CKeywordSearch::categoryDropDown();
			$output['signup']=Display_DUserRegistration::signUp();
		
			$lastobj=new Core_CLastViewedProducts();
			$output['lastviewedproducts']=$lastobj->lastViewedProducts();
			
			$default=new Core_CAddCart();
			$output['showcart']=$default->showQuickRegistration($Err);
			$output['cartcount']=Core_CAddCart::countCart();
			$output['tagClouds']=Core_CTagClouds::displayTagClouds();
			
			$output['loginStatus'] = Core_CUserRegistration::loginStatus();
			$output['headermenu'] = Core_CUserRegistration::showHeaderMenu();
			$output['headermenuhidden']= Core_CUserRegistration::showHeaderMenuHidden();
			$output['currencysettings']=Core_CUserRegistration::showCurrencySettings();
			$output['headertext'] = Core_CUserRegistration::showHeaderText();
		
			Bin_Template::createTemplate('addtocart.html',$output);
		}
		else
		{
			header("Location:?do=showcart&action=getaddressdetails&chk=$chk");
		}


		
		
	}
	/**
	 * This function is used to validate login  in check out page
	 *
	 * 
	 * 
	 * @return string
	 */
	function doQuickRegistration() 
	{
		

		//language	

		Core_CLanguage::setLanguage('CHECK_OUT');
		
	
		if(!isset($_SESSION['user_id']))
		{

			include('classes/Lib/CheckInputs.php');
			$prodid = $_GET['prodid'];

			$_SESSION['RequestUrl'] = '?do=showcart';		
			
			
				Core_CCurrencySettings::getDefaultCurrency();
					
				if($_POST['addwish']=='on')
						$chk=1;
				else
						$chk=0;				
					
		
		
			$obj = new Lib_CheckInputs('quickregister');
			
			$output['sitelogo']=Core_CHome::getLogo();
			$output['pagetitle']=Core_CHome::pageTitle();
			$output['timezone']=Core_CHome::setTimeZone();	
			$output['currentDate']=date('D,M d,Y - h:i A');
			$output['skinname']=Core_CHome::skinName();
			$output['googleanalytics']=Core_CHome::getGoogleAnalyticsCode();
			$output['footerconnect']=Core_CHome::getfooterconnect();
			$output['sociallink']=Core_CHome::showSocialLinks();
			$output['dropdowncat']=Core_CKeywordSearch::categoryDropDown();
			$output['signup']=Display_DUserRegistration::signUp();
			
			$lastobj=new Core_CLastViewedProducts();
			$output['lastviewedproducts']=$lastobj->lastViewedProducts();
			
			$default=new Core_CAddCart();
			$output['showcart']=$default->doQuickRegistration();
			
			$output['tagClouds']=Core_CTagClouds::displayTagClouds();
			$output['cartcount']=Core_CAddCart::countCart();			
			$output['loginStatus'] = Core_CUserRegistration::loginStatus();
			$output['headermenu'] = Core_CUserRegistration::showHeaderMenu();
			$output['headermenuhidden']= Core_CUserRegistration::showHeaderMenuHidden();
			$output['currencysettings']=Core_CUserRegistration::showCurrencySettings();
			$output['headertext'] = Core_CUserRegistration::showHeaderText();
			Bin_Template::createTemplate('addtocart.html',$output);
		
		}
		if(count($_SESSION['mycart'])<count($_SESSION['gift']) && isset($_SESSION['mycart']))
		{	
			header("Location:?do=showcart&action=showorderconfirmation&vid=1");		
		}
		else
		{
			header("Location:?do=showcart&action=getaddressdetails&chk=$chk");

		}
		
	}
	
	/**
	 * This function is used to show the billing address.
	 *
	 * 
	 * 
	 * @return string
	 */
	function showBillingDetails()
	{
		
		//language	
		Core_CLanguage::setLanguage('CHECK_OUT');

	
			
			if($_SESSION['user_id']!='')
			{
				
				$_SESSION['RequestUrl'] = '?do=showcart';
				
				include("classes/Lib/HandleErrors.php");
				$output['val']=$Err->values;
				$output['msg']=$Err->messages;

				Core_CCurrencySettings::getDefaultCurrency();
				
			
				$output['sitelogo']=Core_CHome::getLogo();
				$output['pagetitle']=Core_CHome::pageTitle();
				$output['timezone']=Core_CHome::setTimeZone();	
				$output['currentDate']=date('D,M d,Y - h:i A');
				$output['skinname']=Core_CHome::skinName();
				$output['googleanalytics']=Core_CHome::getGoogleAnalyticsCode();
				$output['footerconnect']=Core_CHome::getfooterconnect();
				$output['sociallink']=Core_CHome::showSocialLinks();
				$output['dropdowncat']=Core_CKeywordSearch::categoryDropDown();
				$output['signup']=Display_DUserRegistration::signUp();
				
				$lastobj=new Core_CLastViewedProducts();
				$output['lastviewedproducts']=$lastobj->lastViewedProducts();
				
				$default=new Core_CAddCart();
				$output['showcart']=$default->showBillingDetails($Err);
				$output['cartcount']=Core_CAddCart::countCart();
				$output['tagClouds']=Core_CTagClouds::displayTagClouds();
				
				$output['loginStatus'] = Core_CUserRegistration::loginStatus();
				$output['headermenu'] = Core_CUserRegistration::showHeaderMenu();
				$output['headermenuhidden']= Core_CUserRegistration::showHeaderMenuHidden();
				$output['currencysettings']=Core_CUserRegistration::showCurrencySettings();
				$output['headertext'] = Core_CUserRegistration::showHeaderText();
		
				Bin_Template::createTemplate('addtocart.html',$output);
			}
			else
			{
				header('Location:?do=showcart');
			}

		
	
	}
	/**
	 * This function is used to show the shipping address.
	 *
	 * 
	 * 
	 * @return string
	 */
	function showShippingDetails()
	{
		

		//language	
		Core_CLanguage::setLanguage('CHECK_OUT');

	
			
		if($_SESSION['user_id']!='')
		{
			
			$_SESSION['RequestUrl'] = '?do=showcart';
			include("classes/Lib/HandleErrors.php");
			
			$output['val']=$Err->values;
			$output['msg']=$Err->messages;
		
			Core_CCurrencySettings::getDefaultCurrency();
			
			$output['sitelogo']=Core_CHome::getLogo();
			$output['pagetitle']=Core_CHome::pageTitle();
			$output['timezone']=Core_CHome::setTimeZone();	
			$output['currentDate']=date('D,M d,Y - h:i A');
			$output['skinname']=Core_CHome::skinName();
			$output['googleanalytics']=Core_CHome::getGoogleAnalyticsCode();
			$output['footerconnect']=Core_CHome::getfooterconnect();
			$output['sociallink']=Core_CHome::showSocialLinks();
			$output['dropdowncat']=Core_CKeywordSearch::categoryDropDown();
			$output['signup']=Display_DUserRegistration::signUp();
			
			$lastobj=new Core_CLastViewedProducts();
			$output['lastviewedproducts']=$lastobj->lastViewedProducts();
			
			$default=new Core_CAddCart();
			$output['showcart']=$default->showShippingDetails($Err);
			$output['cartcount']=Core_CAddCart::countCart();
			$output['tagClouds']=Core_CTagClouds::displayTagClouds();
			
			$output['loginStatus'] = Core_CUserRegistration::loginStatus();
			$output['headermenu'] = Core_CUserRegistration::showHeaderMenu();
			$output['headermenuhidden']= Core_CUserRegistration::showHeaderMenuHidden();
			$output['currencysettings']=Core_CUserRegistration::showCurrencySettings();
			$output['headertext'] = Core_CUserRegistration::showHeaderText();

			Bin_Template::createTemplate('addtocart.html',$output);
		}
		else
		{
			header('Location:?do=showcart');
		}
		
	
	}
	/**
	 * This function is used to show the shipping method.
	 *
	 * 
	 * 
	 * @return string
	 */
	function showShippingMethod()
	{

		//language	
		Core_CLanguage::setLanguage('CHECK_OUT');

	
			
		if($_SESSION['user_id']!='')
		{
			
			$_SESSION['RequestUrl'] = '?do=showcart';
			
			include("classes/Lib/HandleErrors.php");
			$output['val']=$Err->values;
			$output['msg']=$Err->messages;

			Core_CCurrencySettings::getDefaultCurrency();
			$output['sitelogo']=Core_CHome::getLogo();
			$output['pagetitle']=Core_CHome::pageTitle();
			$output['timezone']=Core_CHome::setTimeZone();	
			$output['currentDate']=date('D,M d,Y - h:i A');
			$output['skinname']=Core_CHome::skinName();
			$output['googleanalytics']=Core_CHome::getGoogleAnalyticsCode();
			$output['footerconnect']=Core_CHome::getfooterconnect();
			$output['sociallink']=Core_CHome::showSocialLinks();
			$output['dropdowncat']=Core_CKeywordSearch::categoryDropDown();
			$output['signup']=Display_DUserRegistration::signUp();
			
			$lastobj=new Core_CLastViewedProducts();
			$output['lastviewedproducts']=$lastobj->lastViewedProducts();
			
			$default=new Core_CAddCart();
			$output['showcart']=$default->showShippingMethod($Err);
			$output['cartcount']=Core_CAddCart::countCart();
			$output['tagClouds']=Core_CTagClouds::displayTagClouds();
			
			$output['loginStatus'] = Core_CUserRegistration::loginStatus();
			$output['headermenu'] = Core_CUserRegistration::showHeaderMenu();
			$output['headermenuhidden']= Core_CUserRegistration::showHeaderMenuHidden();
			$output['currencysettings']=Core_CUserRegistration::showCurrencySettings();
			$output['headertext'] = Core_CUserRegistration::showHeaderText();

			Bin_Template::createTemplate('addtocart.html',$output);
		}
		else
		{
			header('Location:?do=showcart');
		}



	}
	/**
	 * This function is used to show the order confirmation.
	 *
	 * 
	 * 
	 * @return string
	 */	
	function showOrderConfirmation() 
	{
		

		//language	
		Core_CLanguage::setLanguage('CHECK_OUT');
			

		Core_CCurrencySettings::getDefaultCurrency();

		
		if(!isset($_SESSION['user_id']))
		{	
			header('Location:?do=showcart');
		}
		else
		{

			$output['sitelogo']=Core_CHome::getLogo();
			$output['pagetitle']=Core_CHome::pageTitle();
			$output['timezone']=Core_CHome::setTimeZone();	
			$output['currentDate']=date('D,M d,Y - h:i A');
			$output['skinname']=Core_CHome::skinName();
			$output['googleanalytics']=Core_CHome::getGoogleAnalyticsCode();
			$output['footerconnect']=Core_CHome::getfooterconnect();
			$output['sociallink']=Core_CHome::showSocialLinks();
			$output['dropdowncat']=Core_CKeywordSearch::categoryDropDown();
			$output['signup']=Display_DUserRegistration::signUp();
			
			$lastobj=new Core_CLastViewedProducts();
			$output['lastviewedproducts']=$lastobj->lastViewedProducts();
			
			$default=new Core_CAddCart();
			$output['showcart']=$default->showOrderConfirmation();


			$output['cartcount']=Core_CAddCart::countCart();
			$output['tagClouds']=Core_CTagClouds::displayTagClouds();
			
			$output['loginStatus'] = Core_CUserRegistration::loginStatus();
			$output['headermenu'] = Core_CUserRegistration::showHeaderMenu();
			$output['headermenuhidden']= Core_CUserRegistration::showHeaderMenuHidden();
			$output['currencysettings']=Core_CUserRegistration::showCurrencySettings();
			$output['headertext'] = Core_CUserRegistration::showHeaderText();
	


			Bin_Template::createTemplate('addtocart.html',$output);
		}
		
	}
	/**
	 * This function is used to show the payment gate way.
	 *
	 * 
	 * 
	 * @return string
	 */	
	
	function displayPaymentGateways()
	{

		//language	
		Core_CLanguage::setLanguage('CHECK_OUT');

	
		
		if($_SESSION['user_id']=='')
		{	
			header('Location:?do=showcart');
		}
		else
		{
		
			include("classes/Lib/HandleErrors.php");
			$output['val']=$Err->values;
			$output['msg']=$Err->messages;
			
			Core_CCurrencySettings::getDefaultCurrency();	

			$output['sitelogo']=Core_CHome::getLogo();
			$output['pagetitle']=Core_CHome::pageTitle();
			$output['timezone']=Core_CHome::setTimeZone();	
			$output['currentDate']=date('D,M d,Y - h:i A');
			$output['skinname']=Core_CHome::skinName();
			$output['googleanalytics']=Core_CHome::getGoogleAnalyticsCode();
			$output['footerconnect']=Core_CHome::getfooterconnect();
			$output['sociallink']=Core_CHome::showSocialLinks();
			$output['dropdowncat']=Core_CKeywordSearch::categoryDropDown();
			$output['signup']=Display_DUserRegistration::signUp();
			$output['cartcount']=Core_CAddCart::countCart();
			$lastobj=new Core_CLastViewedProducts();
			$output['lastviewedproducts']=$lastobj->lastViewedProducts();
			
			$default=new Core_CAddCart();
			$output['showcart']=$default->displayPaymentGateways();
			
			$output['tagClouds']=Core_CTagClouds::displayTagClouds();
			
			$output['loginStatus'] = Core_CUserRegistration::loginStatus();
			$output['headermenu'] = Core_CUserRegistration::showHeaderMenu();
			$output['headermenuhidden']= Core_CUserRegistration::showHeaderMenuHidden();
			$output['currencysettings']=Core_CUserRegistration::showCurrencySettings();
			$output['headertext'] = Core_CUserRegistration::showHeaderText();
	
			Bin_Template::createTemplate('addtocart.html',$output);
		}
		
	}
	/**
	 * This function is used to validate coupon.
	 *
	 * 
	 * 
	 * @return string
	 */
	function validateCoupon()
	{
		

		//language	
		Core_CLanguage::setLanguage('CHECK_OUT');


		if(!isset($_SESSION['user_id']))
		{	
			header('Location:?do=showcart');
		}
		else
		{
		
			include_once('classes/Core/CCurrencySettings.php');
			Core_CCurrencySettings::getDefaultCurrency();
		
			$output['sitelogo']=Core_CHome::getLogo();
			$output['pagetitle']=Core_CHome::pageTitle();
			$output['timezone']=Core_CHome::setTimeZone();	
			$output['currentDate']=date('D,M d,Y - h:i A');
			$output['skinname']=Core_CHome::skinName();
			$output['googleanalytics']=Core_CHome::getGoogleAnalyticsCode();
			$output['footerconnect']=Core_CHome::getfooterconnect();
			$output['sociallink']=Core_CHome::showSocialLinks();
			$output['dropdowncat']=Core_CKeywordSearch::categoryDropDown();
			$output['signup']=Display_DUserRegistration::signUp();
			$output['cartcount']=Core_CAddCart::countCart();
			$lastobj=new Core_CLastViewedProducts();
			$output['lastviewedproducts']=$lastobj->lastViewedProducts();
			
			$default=new Core_CAddCart();

			$output['couponmessage']=Core_CAddCart::validateCoupon();

			$output['showcart']=$default->showOrderConfirmation($output['couponmessage']);
			
			$output['tagClouds']=Core_CTagClouds::displayTagClouds();
			
			$output['loginStatus'] = Core_CUserRegistration::loginStatus();
			$output['headermenu'] = Core_CUserRegistration::showHeaderMenu();
			$output['headermenuhidden']= Core_CUserRegistration::showHeaderMenuHidden();
			$output['currencysettings']=Core_CUserRegistration::showCurrencySettings();
			$output['headertext'] = Core_CUserRegistration::showHeaderText();
		
			Bin_Template::createTemplate('addtocart.html',$output);
		}
	}
	/**
	 * This function is used to show the payment gate way Authorizenet.
	 *
	 * 
	 * 
	 * @return string
	 */
	function showPaymentPageForAuthorizenet() 
	{
		

		//language	
		Core_CLanguage::setLanguage('CHECK_OUT');
	

		
		if(isset($_SESSION['user_id']))
		{
			$prodid = $_GET['prodid'];
			$_SESSION['RequestUrl'] = '?do=showcart';
		
			include("classes/Lib/HandleErrors.php");
			$output['val']=$Err->values;
			$output['msg']=$Err->messages;
			

			Core_CCurrencySettings::getDefaultCurrency();
			$output['sitelogo']=Core_CHome::getLogo();
			$output['pagetitle']=Core_CHome::pageTitle();
			$output['timezone']=Core_CHome::setTimeZone();	
			$output['currentDate']=date('D,M d,Y - h:i A');
			$output['skinname']=Core_CHome::skinName();
			$output['googleanalytics']=Core_CHome::getGoogleAnalyticsCode();
			$output['footerconnect']=Core_CHome::getfooterconnect();
			$output['sociallink']=Core_CHome::showSocialLinks();
			$output['dropdowncat']=Core_CKeywordSearch::categoryDropDown();
			$output['signup']=Display_DUserRegistration::signUp();
			
			$lastobj=new Core_CLastViewedProducts();
			$output['lastviewedproducts']=$lastobj->lastViewedProducts();
			$output['cartcount']=Core_CAddCart::countCart();
			$default=new Core_CAddCart();
			$output['showcart']=$default->showPaymentPageForAuthorizenet();
			
			$output['tagClouds']=Core_CTagClouds::displayTagClouds();
			
			$output['loginStatus'] = Core_CUserRegistration::loginStatus();
			$output['headermenu'] = Core_CUserRegistration::showHeaderMenu();
			$output['headermenuhidden']= Core_CUserRegistration::showHeaderMenuHidden();
			$output['currencysettings']=Core_CUserRegistration::showCurrencySettings();
			$output['headertext'] = Core_CUserRegistration::showHeaderText();
			
			Bin_Template::createTemplate('addtocart.html',$output);
		}
		
		
		
	}
	/**
	 * This function is used to show the payment gate way WorldPay.
	 *
	 * 
	 * 
	 * @return string
	 */
	function showPaymentPageForWorldPay() 
	{
	

		
		//language	
		Core_CLanguage::setLanguage('CHECK_OUT');
	
		
		if(isset($_SESSION['user_id']))
		{
			$prodid = $_GET['prodid'];
			$_SESSION['RequestUrl'] = '?do=showcart';
			
			include("classes/Lib/HandleErrors.php");
			$output['val']=$Err->values;
			$output['msg']=$Err->messages;

			Core_CCurrencySettings::getDefaultCurrency();

			$output['sitelogo']=Core_CHome::getLogo();
			$output['pagetitle']=Core_CHome::pageTitle();
			$output['timezone']=Core_CHome::setTimeZone();	
			$output['currentDate']=date('D,M d,Y - h:i A');
			$output['skinname']=Core_CHome::skinName();
			$output['googleanalytics']=Core_CHome::getGoogleAnalyticsCode();
			$output['footerconnect']=Core_CHome::getfooterconnect();
			$output['sociallink']=Core_CHome::showSocialLinks();
			$output['dropdowncat']=Core_CKeywordSearch::categoryDropDown();
			$output['signup']=Display_DUserRegistration::signUp();
			
			$lastobj=new Core_CLastViewedProducts();
			$output['lastviewedproducts']=$lastobj->lastViewedProducts();
			$output['cartcount']=Core_CAddCart::countCart();
			$default=new Core_CAddCart();
			$output['showcart']=$default->showPaymentPageForWorldPay();
			
			$output['tagClouds']=Core_CTagClouds::displayTagClouds();
			
			$output['loginStatus'] = Core_CUserRegistration::loginStatus();
			$output['headermenu'] = Core_CUserRegistration::showHeaderMenu();
			$output['headermenuhidden']= Core_CUserRegistration::showHeaderMenuHidden();
			$output['currencysettings']=Core_CUserRegistration::showCurrencySettings();
			$output['headertext'] = Core_CUserRegistration::showHeaderText();
		
			Bin_Template::createTemplate('addtocart.html',$output);
		}
		
		
		
	}
	/**
	 * This function is used to show the payment gate way google Checkout.
	 *
	 * 
	 * 
	 * @return string
	 */
	function showPaymentPageFor2Checkout() 
	{
	
			//language	
		Core_CLanguage::setLanguage('CHECK_OUT');

		
		if(isset($_SESSION['user_id']))
		{
			$prodid = $_GET['prodid'];
			$_SESSION['RequestUrl'] = '?do=showcart';
			

			include("classes/Lib/HandleErrors.php");
			$output['val']=$Err->values;
			$output['msg']=$Err->messages;
			

			Core_CCurrencySettings::getDefaultCurrency();	
			
			$output['sitelogo']=Core_CHome::getLogo();
			$output['pagetitle']=Core_CHome::pageTitle();
			$output['timezone']=Core_CHome::setTimeZone();	
			$output['currentDate']=date('D,M d,Y - h:i A');
			$output['skinname']=Core_CHome::skinName();
			$output['googleanalytics']=Core_CHome::getGoogleAnalyticsCode();
			$output['footerconnect']=Core_CHome::getfooterconnect();
			$output['dropdowncat']=Core_CKeywordSearch::categoryDropDown();
			$output['signup']=Display_DUserRegistration::signUp();
			$output['sociallink']=Core_CHome::showSocialLinks();
			$output['cartcount']=Core_CAddCart::countCart();
			$lastobj=new Core_CLastViewedProducts();
			$output['lastviewedproducts']=$lastobj->lastViewedProducts();
			
			$default=new Core_CAddCart();
			$output['showcart']=$default->showPaymentPageFor2Checkout();
			
			$output['tagClouds']=Core_CTagClouds::displayTagClouds();
			
			$output['loginStatus'] = Core_CUserRegistration::loginStatus();
			$output['headermenu'] = Core_CUserRegistration::showHeaderMenu();
			$output['headermenuhidden']= Core_CUserRegistration::showHeaderMenuHidden();
			$output['currencysettings']=Core_CUserRegistration::showCurrencySettings();
			$output['headertext'] = Core_CUserRegistration::showHeaderText();
		
			Bin_Template::createTemplate('addtocart.html',$output);
		}
		
		
		
	}
	/**
	 * This function is used to show the payment gate way Bluepay.
	 *
	 * 
	 * 
	 * @return string
	 */
	function showPaymentPageForBluepay() 
	{
	
		
		
			//language	
		Core_CLanguage::setLanguage('CHECK_OUT');

		if(isset($_SESSION['user_id']))
		{
			$prodid = $_GET['prodid'];
			$_SESSION['RequestUrl'] = '?do=showcart';
			
			include("classes/Lib/HandleErrors.php");
			$output['val']=$Err->values;
			$output['msg']=$Err->messages;
			
			Core_CCurrencySettings::getDefaultCurrency();

			include_once('classes/Core/CAddCart.php');
			include_once('classes/Display/DAddCart.php');
			include('classes/Core/CUserRegistration.php');
			include('classes/Display/DUserRegistration.php');
			include('classes/Core/CKeywordSearch.php');
	  		include('classes/Display/DKeywordSearch.php');
			include('classes/Core/CHome.php');
			include_once('classes/Core/CLastViewedProducts.php');
			include_once('classes/Display/DLastViewedProducts.php');
			include('classes/Lib/TagClouds.php');
			include('classes/Core/CTagClouds.php');
			include_once('classes/Core/CPaymentGateways.php');
			
			$output['sitelogo']=Core_CHome::getLogo();
			$output['pagetitle']=Core_CHome::pageTitle();
			$output['timezone']=Core_CHome::setTimeZone();	
			$output['currentDate']=date('D,M d,Y - h:i A');
			$output['skinname']=Core_CHome::skinName();
			$output['googleanalytics']=Core_CHome::getGoogleAnalyticsCode();
			$output['footerconnect']=Core_CHome::getfooterconnect();
			$output['sociallink']=Core_CHome::showSocialLinks();
			$output['dropdowncat']=Core_CKeywordSearch::categoryDropDown();
			$output['signup']=Display_DUserRegistration::signUp();
			
			$lastobj=new Core_CLastViewedProducts();
			$output['lastviewedproducts']=$lastobj->lastViewedProducts();
			
			$default=new Core_CAddCart();
			$output['showcart']=$default->showPaymentPageForBluepay();
			$output['cartcount']=Core_CAddCart::countCart();
			$output['tagClouds']=Core_CTagClouds::displayTagClouds();
			
			$output['loginStatus'] = Core_CUserRegistration::loginStatus();
			$output['headermenu'] = Core_CUserRegistration::showHeaderMenu();
			$output['headermenuhidden']= Core_CUserRegistration::showHeaderMenuHidden();
			$output['currencysettings']=Core_CUserRegistration::showCurrencySettings();
			$output['headertext'] = Core_CUserRegistration::showHeaderText();
			
			Bin_Template::createTemplate('addtocart.html',$output);
		}
		
		
		
	}
	/**
	 * This function is used to show the payment gate way Authorizenet.
	 *
	 * 
	 * 
	 * @return string
	 */
	
	function doPaymentForAuthorizenet() 
	{
	
				//language	
		Core_CLanguage::setLanguage('CHECK_OUT');
		
		if(isset($_SESSION['user_id']))
		{
			$prodid = $_GET['prodid'];
			$_SESSION['RequestUrl'] = '?do=showcart';

			include("classes/Lib/HandleErrors.php");
			$output['val']=$Err->values;
			$output['msg']=$Err->messages;
			

			Core_CCurrencySettings::getDefaultCurrency();
			
			$output['sitelogo']=Core_CHome::getLogo();
			$output['pagetitle']=Core_CHome::pageTitle();
			$output['timezone']=Core_CHome::setTimeZone();	
			$output['currentDate']=date('D,M d,Y - h:i A');
			$output['skinname']=Core_CHome::skinName();
			$output['googleanalytics']=Core_CHome::getGoogleAnalyticsCode();
			$output['footerconnect']=Core_CHome::getfooterconnect();
			$output['sociallink']=Core_CHome::showSocialLinks();
			$output['dropdowncat']=Core_CKeywordSearch::categoryDropDown();
			$output['signup']=Display_DUserRegistration::signUp();
			
			$lastobj=new Core_CLastViewedProducts();
			$output['lastviewedproducts']=$lastobj->lastViewedProducts();
			
			$default=new Core_CAddCart();
			$output['showcart']=$default->doPaymentForAuthorizenet();
			$output['cartcount']=Core_CAddCart::countCart();
			$output['tagClouds']=Core_CTagClouds::displayTagClouds();
			
			$output['loginStatus'] = Core_CUserRegistration::loginStatus();
			$output['headermenu'] = Core_CUserRegistration::showHeaderMenu();
			$output['headermenuhidden']= Core_CUserRegistration::showHeaderMenuHidden();
			$output['currencysettings']=Core_CUserRegistration::showCurrencySettings();
			$output['headertext'] = Core_CUserRegistration::showHeaderText();
		
			Bin_Template::createTemplate('addtocart.html',$output);
		}	
	}
	

	/**
	 * This function is used to validate the billing address.
	 *
	 * 
	 * 
	 * @return string
	 */
	function validateBillingAddress()
	{

			//language	
		Core_CLanguage::setLanguage('CHECK_OUT');	
		
		if(!isset($_SESSION['user_id']))
		{	
			header('Location:?do=index');
		}
		else
		{
			include("classes/Lib/CheckInputs.php");
			
			Core_CCurrencySettings::getDefaultCurrency();

		
			$obj = new Lib_CheckInputs('billingaddress');

			$output['sitelogo']=Core_CHome::getLogo();
			$output['pagetitle']=Core_CHome::pageTitle();
			$output['timezone']=Core_CHome::setTimeZone();	
			$output['currentDate']=date('D,M d,Y - h:i A');
			$output['skinname']=Core_CHome::skinName();
			$output['googleanalytics']=Core_CHome::getGoogleAnalyticsCode();
			$output['footerconnect']=Core_CHome::getfooterconnect();
			$output['sociallink']=Core_CHome::showSocialLinks();
			$output['dropdowncat']=Core_CKeywordSearch::categoryDropDown();
			$output['signup']=Display_DUserRegistration::signUp();
			
			$lastobj=new Core_CLastViewedProducts();
			$output['lastviewedproducts']=$lastobj->lastViewedProducts();
			
			$default=new Core_CAddCart();
			$output['showcart']=$default->insertBillingAddress();
			$output['cartcount']=Core_CAddCart::countCart();
			$output['tagClouds']=Core_CTagClouds::displayTagClouds();
			
			$output['loginStatus'] = Core_CUserRegistration::loginStatus();
			$output['headermenu'] = Core_CUserRegistration::showHeaderMenu();
			$output['headermenuhidden']= Core_CUserRegistration::showHeaderMenuHidden();
			$output['currencysettings']=Core_CUserRegistration::showCurrencySettings();
			$output['headertext'] = Core_CUserRegistration::showHeaderText();
		
			Bin_Template::createTemplate('addtocart.html',$output);
		}

	}
	/**
	 * This function is used to validate the shipping address.
	 *
	 * 
	 * 
	 * @return string
	 */
	function validateShippingAddress()
	{

	
			//language	
		Core_CLanguage::setLanguage('CHECK_OUT');
		
		if(!isset($_SESSION['user_id']))
		{	
			header('Location:?do=index');
		}
		else
		{
		
			include("classes/Lib/CheckInputs.php");
			$obj = new Lib_CheckInputs('shippingaddress');
			Core_CCurrencySettings::getDefaultCurrency();
			$output['sitelogo']=Core_CHome::getLogo();
			$output['pagetitle']=Core_CHome::pageTitle();
			$output['timezone']=Core_CHome::setTimeZone();	
			$output['currentDate']=date('D,M d,Y - h:i A');
			$output['skinname']=Core_CHome::skinName();
			$output['googleanalytics']=Core_CHome::getGoogleAnalyticsCode();
			$output['footerconnect']=Core_CHome::getfooterconnect();	
			$output['sociallink']=Core_CHome::showSocialLinks();
			$output['dropdowncat']=Core_CKeywordSearch::categoryDropDown();
			$output['signup']=Display_DUserRegistration::signUp();
			
			$lastobj=new Core_CLastViewedProducts();
			$output['lastviewedproducts']=$lastobj->lastViewedProducts();
			
			$default=new Core_CAddCart();
			$output['showcart']=$default->insertShippingAddress();
			$output['cartcount']=Core_CAddCart::countCart();
			$output['tagClouds']=Core_CTagClouds::displayTagClouds();
			
			$output['loginStatus'] = Core_CUserRegistration::loginStatus();
			$output['headermenu'] = Core_CUserRegistration::showHeaderMenu();
			$output['headermenuhidden']= Core_CUserRegistration::showHeaderMenuHidden();
			$output['currencysettings']=Core_CUserRegistration::showCurrencySettings();
			$output['headertext'] = Core_CUserRegistration::showHeaderText();
	
			Bin_Template::createTemplate('addtocart.html',$output);
		}

	}
	/**
	 * This function is used to validate the shipping method.
	 *
	 * 
	 * 
	 * @return string
	 */
	function validateShippingMethod()
	{	

	
			//language	
		include_once('classes/Core/CLanguage.php');
		Core_CLanguage::setLanguage('CHECK_OUT');
		
		include_once('classes/Core/CCurrencySettings.php');
		Core_CCurrencySettings::getDefaultCurrency();
		
		include("classes/Lib/CheckInputs.php");
		$obj = new Lib_CheckInputs('shippingmethod');		
	
		if(!isset($_SESSION['user_id']))
		{	
			header('Location:?do=index');
		}		
		else
		{
			$_SESSION['orderdetails']['shipment_id']=$_POST['shipment_id'];
			$_SESSION['orderdetails']['shipdurid']=$_POST['shipdurid'];
			$_SESSION['orderdetails']['weight']=$_POST['weight'];
			if($_POST['shipment_id']=='1')
			{
				$_SESSION['orderdetails']['shipping_cost']=$_POST['default_shipping_cost'];
			}
			else
			{
				$_SESSION['orderdetails']['shipping_cost']=$_POST['shipping_cost'];
			}

			header('Location:?do=showcart&action=showorderconfirmation');
		}
	

	}

	function calculateShipCost()
	{
		Core_CAddCart::calculateShipCost();	
	}	
}
?>
