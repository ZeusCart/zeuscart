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
var $output = array();	
	
	/**
	 * This function is used to view the add to cart  page.
	 *
	 * 
	 * 
	 * @return string
	 */
	function addCart()
	{
		include("classes/Lib/HandleErrors.php");
		$output['val']=$Err->values;
		$output['msg']=$Err->messages;
	
		if(!isset($_SESSION['user_id']))
		{
			$prodid = $_GET['prodid'];
			
			include_once('classes/Core/CAddCart.php');
			include('classes/Core/CUserRegistration.php');
			include('classes/Display/DUserRegistration.php');
			include('classes/Core/CKeywordSearch.php');
  			include('classes/Display/DKeywordSearch.php');
			include('classes/Core/CHome.php');
			include_once('classes/Core/CLastViewedProducts.php');
			include_once('classes/Display/DLastViewedProducts.php');
			include('classes/Lib/TagClouds.php');
			include('classes/Core/CTagClouds.php');
			
			include_once('classes/Core/CCurrencySettings.php');
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
			$output['dropdowncat']=Core_CKeywordSearch::categoryDropDown();
			
			$lastobj=new Core_CLastViewedProducts();
			$output['lastviewedproducts']=$lastobj->lastViewedProducts();
			
			$default=new Core_CAddCart();
			$output['addtocart']=$default->addCart();
			$output['showcart']=$default->showcart();
			
			$output['tagClouds']=Core_CTagClouds::displayTagClouds();
			
			$output['loginStatus'] = Core_CUserRegistration::loginStatus();
			$output['headermenu'] = Core_CUserRegistration::showHeaderMenu();
			$output['headertext'] = Core_CUserRegistration::showHeaderText();
			Bin_Template::createTemplate('addtocart.html',$output);
			
		}
		else
		{
			include_once('classes/Core/CAddCart.php');
			include('classes/Core/CUserRegistration.php');
			include('classes/Display/DUserRegistration.php');
			include('classes/Core/CKeywordSearch.php');
  			include('classes/Display/DKeywordSearch.php');
			include('classes/Core/CHome.php');
			include_once('classes/Core/CLastViewedProducts.php');
			include_once('classes/Display/DLastViewedProducts.php');
			include('classes/Lib/TagClouds.php');
			include('classes/Core/CTagClouds.php');
			
			include_once('classes/Core/CCurrencySettings.php');
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
			$output['dropdowncat']=Core_CKeywordSearch::categoryDropDown();
			
			$lastobj=new Core_CLastViewedProducts();
			$output['lastviewedproducts']=$lastobj->lastViewedProducts();
			
			$default=new Core_CAddCart();
			$output['addtocart']=$default->addCart();
			$output['showcart']=$default->showcart();
			
			$output['tagClouds']=Core_CTagClouds::displayTagClouds();
			
			$output['loginStatus'] = Core_CUserRegistration::loginStatus();
			$output['headermenu'] = Core_CUserRegistration::showHeaderMenu();
			$output['headertext'] = Core_CUserRegistration::showHeaderText();
			Bin_Template::createTemplate('addtocart.html',$output);
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
		include("classes/Lib/HandleErrors.php");
		$output['val']=$Err->values;
		$output['msg']=$Err->messages;
	
		if(!isset($_SESSION['user_id']))
		{
			$prodid = $_GET['prodid'];
			
			
			include_once('classes/Core/CAddCart.php');
			include('classes/Core/CUserRegistration.php');
			include('classes/Display/DUserRegistration.php');
			include('classes/Core/CKeywordSearch.php');
  			include('classes/Display/DKeywordSearch.php');
			include('classes/Core/CHome.php');
			include_once('classes/Core/CLastViewedProducts.php');
			include_once('classes/Display/DLastViewedProducts.php');
			include('classes/Lib/TagClouds.php');
			include('classes/Core/CTagClouds.php');
			
			include_once('classes/Core/CCurrencySettings.php');
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
			$output['dropdowncat']=Core_CKeywordSearch::categoryDropDown();
			
			$lastobj=new Core_CLastViewedProducts();
			$output['lastviewedproducts']=$lastobj->lastViewedProducts();
			
			$default=new Core_CAddCart();
			$output['addtocart']=$default->addCartFromProductDetail();
			$output['showcart']=$default->showcart();
			
			$output['tagClouds']=Core_CTagClouds::displayTagClouds();
			
			$output['loginStatus'] = Core_CUserRegistration::loginStatus();
			$output['headermenu'] = Core_CUserRegistration::showHeaderMenu();
			$output['headertext'] = Core_CUserRegistration::showHeaderText();
			Bin_Template::createTemplate('addtocart.html',$output);
			
		}
		else
		{
			include_once('classes/Core/CAddCart.php');
			include('classes/Core/CUserRegistration.php');
			include('classes/Display/DUserRegistration.php');
			include('classes/Core/CKeywordSearch.php');
  			include('classes/Display/DKeywordSearch.php');
			include('classes/Core/CHome.php');
			include_once('classes/Core/CLastViewedProducts.php');
			include_once('classes/Display/DLastViewedProducts.php');
			include('classes/Lib/TagClouds.php');
			include('classes/Core/CTagClouds.php');
			
			include_once('classes/Core/CCurrencySettings.php');
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
			$output['dropdowncat']=Core_CKeywordSearch::categoryDropDown();
			
			$lastobj=new Core_CLastViewedProducts();
			$output['lastviewedproducts']=$lastobj->lastViewedProducts();
			
			$default=new Core_CAddCart();
			$output['addtocart']=$default->addCartFromProductDetail();
			$output['showcart']=$default->showcart();
			
			$output['tagClouds']=Core_CTagClouds::displayTagClouds();
			
			$output['loginStatus'] = Core_CUserRegistration::loginStatus();
			$output['headermenu'] = Core_CUserRegistration::showHeaderMenu();
			$output['headertext'] = Core_CUserRegistration::showHeaderText();
			Bin_Template::createTemplate('addtocart.html',$output);
		}
		
	}
	/**
	 * This function is used to view the add to cart from product detalis page.
	 *
	 * 
	 * 
	 * @return string
	 */
	function showCart() 
	{
	
		include("classes/Lib/HandleErrors.php");
		$output['val']=$Err->values;
		$output['msg']=$Err->messages;
		if(!isset($_SESSION['user_id']))
		{
			$prodid = $_GET['prodid'];
			$_SESSION['RequestUrl'] = '?do=showcart';
		
			
			include_once('classes/Core/CAddCart.php');
			include('classes/Core/CUserRegistration.php');
			include('classes/Display/DUserRegistration.php');
			include('classes/Core/CKeywordSearch.php');
	  		include('classes/Display/DKeywordSearch.php');
			include('classes/Core/CHome.php');
			include_once('classes/Core/CLastViewedProducts.php');
			include_once('classes/Display/DLastViewedProducts.php');
			include('classes/Lib/TagClouds.php');
			include('classes/Core/CTagClouds.php');
			
			include_once('classes/Core/CCurrencySettings.php');
			Core_CCurrencySettings::getDefaultCurrency();
			
			$output['sitelogo']=Core_CHome::getLogo();
			$output['pagetitle']=Core_CHome::pageTitle();
			$output['timezone']=Core_CHome::setTimeZone();	
			$output['currentDate']=date('D,M d,Y - h:i A');
			$output['skinname']=Core_CHome::skinName();
			$output['googleanalytics']=Core_CHome::getGoogleAnalyticsCode();
			$output['dropdowncat']=Core_CKeywordSearch::categoryDropDown();
			$output['signup']=Display_DUserRegistration::signUp();
			
			$lastobj=new Core_CLastViewedProducts();
			$output['lastviewedproducts']=$lastobj->lastViewedProducts();
			
			$default=new Core_CAddCart();
			$output['showcart']=$default->showcart();
			
			$output['tagClouds']=Core_CTagClouds::displayTagClouds();
			
			$output['loginStatus'] = Core_CUserRegistration::loginStatus();
			$output['headermenu'] = Core_CUserRegistration::showHeaderMenu();
			$output['headertext'] = Core_CUserRegistration::showHeaderText();
	
			Bin_Template::createTemplate('addtocart.html',$output);
		}
		else
		{
		
			include_once('classes/Core/CAddCart.php');
			include('classes/Core/CUserRegistration.php');
			include('classes/Display/DUserRegistration.php');
			include('classes/Core/CKeywordSearch.php');
	  		include('classes/Display/DKeywordSearch.php');
			include('classes/Core/CHome.php');
			include_once('classes/Core/CLastViewedProducts.php');
			include_once('classes/Display/DLastViewedProducts.php');
			include('classes/Lib/TagClouds.php');
			include('classes/Core/CTagClouds.php');
			
			include_once('classes/Core/CCurrencySettings.php');
			Core_CCurrencySettings::getDefaultCurrency();
			
			$output['sitelogo']=Core_CHome::getLogo();
			$output['pagetitle']=Core_CHome::pageTitle();
			$output['timezone']=Core_CHome::setTimeZone();	
			$output['currentDate']=date('D,M d,Y - h:i A');
			$output['skinname']=Core_CHome::skinName();
			$output['googleanalytics']=Core_CHome::getGoogleAnalyticsCode();
			$output['dropdowncat']=Core_CKeywordSearch::categoryDropDown();
			$output['signup']=Display_DUserRegistration::signUp();
			
			$lastobj=new Core_CLastViewedProducts();
			$output['lastviewedproducts']=$lastobj->lastViewedProducts();
			
			$default=new Core_CAddCart();
			$output['showcart']=$default->showcart();
			
			$output['tagClouds']=Core_CTagClouds::displayTagClouds();
			
			$output['loginStatus'] = Core_CUserRegistration::loginStatus();
			$output['headermenu'] = Core_CUserRegistration::showHeaderMenu();
			$output['headertext'] = Core_CUserRegistration::showHeaderText();
		
			Bin_Template::createTemplate('addtocart.html',$output);
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
		include_once('classes/Core/CAddCart.php');
		include('classes/Core/CUserRegistration.php');
		include('classes/Display/DUserRegistration.php');
		include('classes/Core/CKeywordSearch.php');
  		include('classes/Display/DKeywordSearch.php');
		include('classes/Core/CHome.php');
		include_once('classes/Core/CLastViewedProducts.php');
		include_once('classes/Display/DLastViewedProducts.php');
		include('classes/Lib/TagClouds.php');
		include('classes/Core/CTagClouds.php');
		
		include_once('classes/Core/CCurrencySettings.php');
		Core_CCurrencySettings::getDefaultCurrency();
		
		$output['sitelogo']=Core_CHome::getLogo();
		$output['pagetitle']=Core_CHome::pageTitle();
		$output['timezone']=Core_CHome::setTimeZone();	
		$output['currentDate']=date('D,M d,Y - h:i A');
		$output['skinname']=Core_CHome::skinName();
		$output['googleanalytics']=Core_CHome::getGoogleAnalyticsCode();
		$output['dropdowncat']=Core_CKeywordSearch::categoryDropDown();
		$default=new Core_CAddCart();
		$output['deletecart']=$default->deleteCart();
		$output['loginStatus'] = Core_CUserRegistration::loginStatus();
		$output['headermenu'] = Core_CUserRegistration::showHeaderMenu();
   		$output['headertext'] = Core_CUserRegistration::showHeaderText();
		$output['signup']=Display_DUserRegistration::signUp();
		
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
		include_once('classes/Core/CAddCart.php');
		$default=new Core_CAddCart();
		include_once('classes/Core/CAddCart.php');
		include('classes/Core/CUserRegistration.php');
		include('classes/Display/DUserRegistration.php');
		include('classes/Core/CKeywordSearch.php');
		include('classes/Display/DKeywordSearch.php');
		include('classes/Core/CHome.php');
		include_once('classes/Core/CLastViewedProducts.php');
		include_once('classes/Display/DLastViewedProducts.php');
		include('classes/Lib/TagClouds.php');
		include('classes/Core/CTagClouds.php');
		
		include_once('classes/Core/CCurrencySettings.php');
		Core_CCurrencySettings::getDefaultCurrency();
		
		$output['sitelogo']=Core_CHome::getLogo();
		$output['pagetitle']=Core_CHome::pageTitle();
		$output['timezone']=Core_CHome::setTimeZone();	
		$output['currentDate']=date('D,M d,Y - h:i A');
		$output['skinname']=Core_CHome::skinName();
		$output['googleanalytics']=Core_CHome::getGoogleAnalyticsCode();
		$output['dropdowncat']=Core_CKeywordSearch::categoryDropDown();
		$output['signup']=Display_DUserRegistration::signUp();
		$default=new Core_CAddCart();
		
		$output['loginStatus'] = Core_CUserRegistration::loginStatus();
		$output['headermenu'] = Core_CUserRegistration::showHeaderMenu();
		$output['headertext'] = Core_CUserRegistration::showHeaderText();
			
		$output['updatecart']=$default->updateCart();
		$output['showcart']=$default->showcart();
		
		$lastobj=new Core_CLastViewedProducts();
		$output['lastviewedproducts']=$lastobj->lastViewedProducts();
		
		$output['tagClouds']=Core_CTagClouds::displayTagClouds();
		
		Bin_Template::createTemplate('addtocart.html',$output);
	
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

		include_once('classes/Core/CCurrencySettings.php');
		Core_CCurrencySettings::getDefaultCurrency();
		
		if($_POST['addwish']=='on')
				$chk=1;
		else
				$chk=0;
		include("classes/Lib/HandleErrors.php");	
		$output['val']=$Err->values;
		$output['msg']=$Err->messages;
		if(!isset($_SESSION['user_id']))
		{

			$prodid = $_GET['prodid'];
			$_SESSION['RequestUrl'] = '?do=showcart';
			
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
			
			$output['sitelogo']=Core_CHome::getLogo();
			$output['pagetitle']=Core_CHome::pageTitle();
			$output['timezone']=Core_CHome::setTimeZone();	
			$output['currentDate']=date('D,M d,Y - h:i A');
			$output['skinname']=Core_CHome::skinName();
			$output['googleanalytics']=Core_CHome::getGoogleAnalyticsCode();
			$output['dropdowncat']=Core_CKeywordSearch::categoryDropDown();
			$output['signup']=Display_DUserRegistration::signUp();
			
			$lastobj=new Core_CLastViewedProducts();
			$output['lastviewedproducts']=$lastobj->lastViewedProducts();
			
			$default=new Core_CAddCart();
			$output['showcart']=$default->showQuickRegistration($Err);
			
			$output['tagClouds']=Core_CTagClouds::displayTagClouds();
			
			$output['loginStatus'] = Core_CUserRegistration::loginStatus();
			$output['headermenu'] = Core_CUserRegistration::showHeaderMenu();
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
		
		
		include_once('classes/Core/CCurrencySettings.php');
		Core_CCurrencySettings::getDefaultCurrency();
			
		if($_POST['addwish']=='on')
				$chk=1;
		else
				$chk=0;				
				
		
		
		include('classes/Lib/CheckInputs.php');
		$obj = new Lib_CheckInputs('quickregister');	
		if(!isset($_SESSION['user_id']))
		{
			$prodid = $_GET['prodid'];
			$_SESSION['RequestUrl'] = '?do=showcart';
			
			
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
			
			$output['sitelogo']=Core_CHome::getLogo();
			$output['pagetitle']=Core_CHome::pageTitle();
			$output['timezone']=Core_CHome::setTimeZone();	
			$output['currentDate']=date('D,M d,Y - h:i A');
			$output['skinname']=Core_CHome::skinName();
			$output['googleanalytics']=Core_CHome::getGoogleAnalyticsCode();
			$output['dropdowncat']=Core_CKeywordSearch::categoryDropDown();
			$output['signup']=Display_DUserRegistration::signUp();
			
			$lastobj=new Core_CLastViewedProducts();
			$output['lastviewedproducts']=$lastobj->lastViewedProducts();
			
			$default=new Core_CAddCart();
			$output['showcart']=$default->doQuickRegistration();
			
			$output['tagClouds']=Core_CTagClouds::displayTagClouds();
			
			
			$output['loginStatus'] = Core_CUserRegistration::loginStatus();
			$output['headermenu'] = Core_CUserRegistration::showHeaderMenu();
			$output['headertext'] = Core_CUserRegistration::showHeaderText();
			Bin_Template::createTemplate('addtocart.html',$output);
		
		}
		else
		header("Location:?do=showcart&action=getaddressdetails&chk=$chk");	
		
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
		include("classes/Lib/HandleErrors.php");
		$output['val']=$Err->values;
		$output['msg']=$Err->messages;
	
		include_once('classes/Core/CCurrencySettings.php');
		Core_CCurrencySettings::getDefaultCurrency();
			
		if($_SESSION['user_id']!='')
		{
			
			$_SESSION['RequestUrl'] = '?do=showcart';
			
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
			
			$output['sitelogo']=Core_CHome::getLogo();
			$output['pagetitle']=Core_CHome::pageTitle();
			$output['timezone']=Core_CHome::setTimeZone();	
			$output['currentDate']=date('D,M d,Y - h:i A');
			$output['skinname']=Core_CHome::skinName();
			$output['googleanalytics']=Core_CHome::getGoogleAnalyticsCode();
			$output['dropdowncat']=Core_CKeywordSearch::categoryDropDown();
			$output['signup']=Display_DUserRegistration::signUp();
			
			$lastobj=new Core_CLastViewedProducts();
			$output['lastviewedproducts']=$lastobj->lastViewedProducts();
			
			$default=new Core_CAddCart();
			$output['showcart']=$default->showBillingDetails($Err);
			
			$output['tagClouds']=Core_CTagClouds::displayTagClouds();
			
			$output['loginStatus'] = Core_CUserRegistration::loginStatus();
			$output['headermenu'] = Core_CUserRegistration::showHeaderMenu();
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
		include("classes/Lib/HandleErrors.php");
		$output['val']=$Err->values;
		$output['msg']=$Err->messages;
	
		include_once('classes/Core/CCurrencySettings.php');
		Core_CCurrencySettings::getDefaultCurrency();
			
		if($_SESSION['user_id']!='')
		{
			
			$_SESSION['RequestUrl'] = '?do=showcart';
	
			
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
			
			$output['sitelogo']=Core_CHome::getLogo();
			$output['pagetitle']=Core_CHome::pageTitle();
			$output['timezone']=Core_CHome::setTimeZone();	
			$output['currentDate']=date('D,M d,Y - h:i A');
			$output['skinname']=Core_CHome::skinName();
			$output['googleanalytics']=Core_CHome::getGoogleAnalyticsCode();
			$output['dropdowncat']=Core_CKeywordSearch::categoryDropDown();
			$output['signup']=Display_DUserRegistration::signUp();
			
			$lastobj=new Core_CLastViewedProducts();
			$output['lastviewedproducts']=$lastobj->lastViewedProducts();
			
			$default=new Core_CAddCart();
			$output['showcart']=$default->showShippingDetails($Err);
			
			$output['tagClouds']=Core_CTagClouds::displayTagClouds();
			
			$output['loginStatus'] = Core_CUserRegistration::loginStatus();
			$output['headermenu'] = Core_CUserRegistration::showHeaderMenu();
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
		include("classes/Lib/HandleErrors.php");
		$output['val']=$Err->values;
		$output['msg']=$Err->messages;
	
		include_once('classes/Core/CCurrencySettings.php');
		Core_CCurrencySettings::getDefaultCurrency();
			
		if($_SESSION['user_id']!='')
		{
			
			$_SESSION['RequestUrl'] = '?do=showcart';
			
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
			
			$output['sitelogo']=Core_CHome::getLogo();
			$output['pagetitle']=Core_CHome::pageTitle();
			$output['timezone']=Core_CHome::setTimeZone();	
			$output['currentDate']=date('D,M d,Y - h:i A');
			$output['skinname']=Core_CHome::skinName();
			$output['googleanalytics']=Core_CHome::getGoogleAnalyticsCode();
			$output['dropdowncat']=Core_CKeywordSearch::categoryDropDown();
			$output['signup']=Display_DUserRegistration::signUp();
			
			$lastobj=new Core_CLastViewedProducts();
			$output['lastviewedproducts']=$lastobj->lastViewedProducts();
			
			$default=new Core_CAddCart();
			$output['showcart']=$default->showShippingMethod($output);
			
			$output['tagClouds']=Core_CTagClouds::displayTagClouds();
			
			$output['loginStatus'] = Core_CUserRegistration::loginStatus();
			$output['headermenu'] = Core_CUserRegistration::showHeaderMenu();
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
		
		include_once('classes/Core/CCurrencySettings.php');
		Core_CCurrencySettings::getDefaultCurrency();

		
		if(!isset($_SESSION['user_id']))
		{	
			header('Location:?do=showcart');
		}
		else
		{
		
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
			include('classes/Core/CUserAddressBook.php');
			
			$output['sitelogo']=Core_CHome::getLogo();
			$output['pagetitle']=Core_CHome::pageTitle();
			$output['timezone']=Core_CHome::setTimeZone();	
			$output['currentDate']=date('D,M d,Y - h:i A');
			$output['skinname']=Core_CHome::skinName();
			$output['googleanalytics']=Core_CHome::getGoogleAnalyticsCode();
			$output['dropdowncat']=Core_CKeywordSearch::categoryDropDown();
			$output['signup']=Display_DUserRegistration::signUp();
			
			$lastobj=new Core_CLastViewedProducts();
			$output['lastviewedproducts']=$lastobj->lastViewedProducts();
			
			$default=new Core_CAddCart();
			$output['showcart']=$default->showOrderConfirmation();
			
			$output['tagClouds']=Core_CTagClouds::displayTagClouds();
			
			$output['loginStatus'] = Core_CUserRegistration::loginStatus();
			$output['headermenu'] = Core_CUserRegistration::showHeaderMenu();
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
	
		include("classes/Lib/HandleErrors.php");
		$output['val']=$Err->values;
		$output['msg']=$Err->messages;
		
		include_once('classes/Core/CCurrencySettings.php');
		Core_CCurrencySettings::getDefaultCurrency();
		
		if($_SESSION['user_id']=='')
		{	
			header('Location:?do=showcart');
		}
		else
		{
		
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
			
			$output['sitelogo']=Core_CHome::getLogo();
			$output['pagetitle']=Core_CHome::pageTitle();
			$output['timezone']=Core_CHome::setTimeZone();	
			$output['currentDate']=date('D,M d,Y - h:i A');
			$output['skinname']=Core_CHome::skinName();
			$output['googleanalytics']=Core_CHome::getGoogleAnalyticsCode();
			$output['dropdowncat']=Core_CKeywordSearch::categoryDropDown();
			$output['signup']=Display_DUserRegistration::signUp();
			
			$lastobj=new Core_CLastViewedProducts();
			$output['lastviewedproducts']=$lastobj->lastViewedProducts();
			
			$default=new Core_CAddCart();
			$output['showcart']=$default->displayPaymentGateways();
			
			$output['tagClouds']=Core_CTagClouds::displayTagClouds();
			
			$output['loginStatus'] = Core_CUserRegistration::loginStatus();
			$output['headermenu'] = Core_CUserRegistration::showHeaderMenu();
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
		include_once('classes/Core/CCurrencySettings.php');
		Core_CCurrencySettings::getDefaultCurrency();
		
		if(!isset($_SESSION['user_id']))
		{	
			header('Location:?do=showcart');
		}
		else
		{
		
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
			include('classes/Core/CUserAddressBook.php');

			
			$output['sitelogo']=Core_CHome::getLogo();
			$output['pagetitle']=Core_CHome::pageTitle();
			$output['timezone']=Core_CHome::setTimeZone();	
			$output['currentDate']=date('D,M d,Y - h:i A');
			$output['skinname']=Core_CHome::skinName();
			$output['googleanalytics']=Core_CHome::getGoogleAnalyticsCode();
			$output['dropdowncat']=Core_CKeywordSearch::categoryDropDown();
			$output['signup']=Display_DUserRegistration::signUp();
			
			$lastobj=new Core_CLastViewedProducts();
			$output['lastviewedproducts']=$lastobj->lastViewedProducts();
			
			$default=new Core_CAddCart();

			$output['showcart']=$default->showOrderConfirmation($default->validateCoupon());
			
			$output['tagClouds']=Core_CTagClouds::displayTagClouds();
			
			$output['loginStatus'] = Core_CUserRegistration::loginStatus();
			$output['headermenu'] = Core_CUserRegistration::showHeaderMenu();
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
	
		include("classes/Lib/HandleErrors.php");
		$output['val']=$Err->values;
		$output['msg']=$Err->messages;
		
		include_once('classes/Core/CCurrencySettings.php');
		Core_CCurrencySettings::getDefaultCurrency();
		
		if(isset($_SESSION['user_id']))
		{
			$prodid = $_GET['prodid'];
			$_SESSION['RequestUrl'] = '?do=showcart';
		
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
			
			$output['sitelogo']=Core_CHome::getLogo();
			$output['pagetitle']=Core_CHome::pageTitle();
			$output['timezone']=Core_CHome::setTimeZone();	
			$output['currentDate']=date('D,M d,Y - h:i A');
			$output['skinname']=Core_CHome::skinName();
			$output['googleanalytics']=Core_CHome::getGoogleAnalyticsCode();
			$output['dropdowncat']=Core_CKeywordSearch::categoryDropDown();
			$output['signup']=Display_DUserRegistration::signUp();
			
			$lastobj=new Core_CLastViewedProducts();
			$output['lastviewedproducts']=$lastobj->lastViewedProducts();
			
			$default=new Core_CAddCart();
			$output['showcart']=$default->showPaymentPageForAuthorizenet();
			
			$output['tagClouds']=Core_CTagClouds::displayTagClouds();
			
			$output['loginStatus'] = Core_CUserRegistration::loginStatus();
			$output['headermenu'] = Core_CUserRegistration::showHeaderMenu();
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
	
		include("classes/Lib/HandleErrors.php");
		$output['val']=$Err->values;
		$output['msg']=$Err->messages;
		
		include_once('classes/Core/CCurrencySettings.php');
		Core_CCurrencySettings::getDefaultCurrency();
		
		if(isset($_SESSION['user_id']))
		{
			$prodid = $_GET['prodid'];
			$_SESSION['RequestUrl'] = '?do=showcart';
			
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
			$output['dropdowncat']=Core_CKeywordSearch::categoryDropDown();
			$output['signup']=Display_DUserRegistration::signUp();
			
			$lastobj=new Core_CLastViewedProducts();
			$output['lastviewedproducts']=$lastobj->lastViewedProducts();
			
			$default=new Core_CAddCart();
			$output['showcart']=$default->showPaymentPageForWorldPay();
			
			$output['tagClouds']=Core_CTagClouds::displayTagClouds();
			
			$output['loginStatus'] = Core_CUserRegistration::loginStatus();
			$output['headermenu'] = Core_CUserRegistration::showHeaderMenu();
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
	
		include("classes/Lib/HandleErrors.php");
		$output['val']=$Err->values;
		$output['msg']=$Err->messages;
		
		include_once('classes/Core/CCurrencySettings.php');
		Core_CCurrencySettings::getDefaultCurrency();
		
		if(isset($_SESSION['user_id']))
		{
			$prodid = $_GET['prodid'];
			$_SESSION['RequestUrl'] = '?do=showcart';
		
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
			$output['dropdowncat']=Core_CKeywordSearch::categoryDropDown();
			$output['signup']=Display_DUserRegistration::signUp();
			
			$lastobj=new Core_CLastViewedProducts();
			$output['lastviewedproducts']=$lastobj->lastViewedProducts();
			
			$default=new Core_CAddCart();
			$output['showcart']=$default->showPaymentPageFor2Checkout();
			
			$output['tagClouds']=Core_CTagClouds::displayTagClouds();
			
			$output['loginStatus'] = Core_CUserRegistration::loginStatus();
			$output['headermenu'] = Core_CUserRegistration::showHeaderMenu();
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
	
		include("classes/Lib/HandleErrors.php");
		$output['val']=$Err->values;
		$output['msg']=$Err->messages;
		
		include_once('classes/Core/CCurrencySettings.php');
		Core_CCurrencySettings::getDefaultCurrency();
		
		if(isset($_SESSION['user_id']))
		{
			$prodid = $_GET['prodid'];
			$_SESSION['RequestUrl'] = '?do=showcart';
					
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
			$output['dropdowncat']=Core_CKeywordSearch::categoryDropDown();
			$output['signup']=Display_DUserRegistration::signUp();
			
			$lastobj=new Core_CLastViewedProducts();
			$output['lastviewedproducts']=$lastobj->lastViewedProducts();
			
			$default=new Core_CAddCart();
			$output['showcart']=$default->showPaymentPageForBluepay();
			
			$output['tagClouds']=Core_CTagClouds::displayTagClouds();
			
			$output['loginStatus'] = Core_CUserRegistration::loginStatus();
			$output['headermenu'] = Core_CUserRegistration::showHeaderMenu();
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
	
		include("classes/Lib/HandleErrors.php");
		$output['val']=$Err->values;
		$output['msg']=$Err->messages;
		
		include_once('classes/Core/CCurrencySettings.php');
		Core_CCurrencySettings::getDefaultCurrency();
		
		if(isset($_SESSION['user_id']))
		{
			$prodid = $_GET['prodid'];
			$_SESSION['RequestUrl'] = '?do=showcart';
			
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
			
			$output['sitelogo']=Core_CHome::getLogo();
			$output['pagetitle']=Core_CHome::pageTitle();
			$output['timezone']=Core_CHome::setTimeZone();	
			$output['currentDate']=date('D,M d,Y - h:i A');
			$output['skinname']=Core_CHome::skinName();
			$output['googleanalytics']=Core_CHome::getGoogleAnalyticsCode();
			$output['dropdowncat']=Core_CKeywordSearch::categoryDropDown();
			$output['signup']=Display_DUserRegistration::signUp();
			
			$lastobj=new Core_CLastViewedProducts();
			$output['lastviewedproducts']=$lastobj->lastViewedProducts();
			
			$default=new Core_CAddCart();
			$output['showcart']=$default->doPaymentForAuthorizenet();
			
			$output['tagClouds']=Core_CTagClouds::displayTagClouds();
			
			$output['loginStatus'] = Core_CUserRegistration::loginStatus();
			$output['headermenu'] = Core_CUserRegistration::showHeaderMenu();
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

		include_once('classes/Core/CCurrencySettings.php');
		Core_CCurrencySettings::getDefaultCurrency();
		
		include("classes/Lib/CheckInputs.php");
		$obj = new Lib_CheckInputs('billingaddress');
		
		if(!isset($_SESSION['user_id']))
		{	
			header('Location:?do=index');
		}
		else
		{
		
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
			include('classes/Core/CUserAddressBook.php');
			
			$output['sitelogo']=Core_CHome::getLogo();
			$output['pagetitle']=Core_CHome::pageTitle();
			$output['timezone']=Core_CHome::setTimeZone();	
			$output['currentDate']=date('D,M d,Y - h:i A');
			$output['skinname']=Core_CHome::skinName();
			$output['googleanalytics']=Core_CHome::getGoogleAnalyticsCode();
			$output['dropdowncat']=Core_CKeywordSearch::categoryDropDown();
			$output['signup']=Display_DUserRegistration::signUp();
			
			$lastobj=new Core_CLastViewedProducts();
			$output['lastviewedproducts']=$lastobj->lastViewedProducts();
			
			$default=new Core_CAddCart();
			$output['showcart']=$default->insertBillingAddress();
			
			$output['tagClouds']=Core_CTagClouds::displayTagClouds();
			
			$output['loginStatus'] = Core_CUserRegistration::loginStatus();
			$output['headermenu'] = Core_CUserRegistration::showHeaderMenu();
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

		include_once('classes/Core/CCurrencySettings.php');
		Core_CCurrencySettings::getDefaultCurrency();
		
		include("classes/Lib/CheckInputs.php");
		$obj = new Lib_CheckInputs('shippingaddress');
		
		if(!isset($_SESSION['user_id']))
		{	
			header('Location:?do=index');
		}
		else
		{
		
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
			include('classes/Core/CUserAddressBook.php');
			
			$output['sitelogo']=Core_CHome::getLogo();
			$output['pagetitle']=Core_CHome::pageTitle();
			$output['timezone']=Core_CHome::setTimeZone();	
			$output['currentDate']=date('D,M d,Y - h:i A');
			$output['skinname']=Core_CHome::skinName();
			$output['googleanalytics']=Core_CHome::getGoogleAnalyticsCode();
			$output['dropdowncat']=Core_CKeywordSearch::categoryDropDown();
			$output['signup']=Display_DUserRegistration::signUp();
			
			$lastobj=new Core_CLastViewedProducts();
			$output['lastviewedproducts']=$lastobj->lastViewedProducts();
			
			$default=new Core_CAddCart();
			$output['showcart']=$default->insertShippingAddress();
			
			$output['tagClouds']=Core_CTagClouds::displayTagClouds();
			
			$output['loginStatus'] = Core_CUserRegistration::loginStatus();
			$output['headermenu'] = Core_CUserRegistration::showHeaderMenu();
			$output['headertext'] = Core_CUserRegistration::showHeaderText();
	
			Bin_Template::createTemplate('addtocart.html',$output);
		}

	}
}
?>