<?php
class Model_MNews
{
	var $output = array();
	
 	/**
	* This function is used to Display the News Page
 	*/
	function showNewsPage()
	{

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
		
		$output['sitelogo']=Core_CHome::getLogo();
		$output['pagetitle']=Core_CHome::pageTitle();
		$output['timezone']=Core_CHome::setTimeZone();	
		$output['currentDate']=date('D,M d,Y - h:i A');
		$output['skinname']=Core_CHome::skinName();

	

		$output['googleanalytics']=Core_CHome::getGoogleAnalyticsCode();
		$output['googlead']=Core_CHome::getGoogleAd();
		$output['footer']=Core_CHome::footer();

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
		$output['headertext'] = Core_CUserRegistration::showHeaderText();
		$output['headerMainMenu'] = Core_CUserRegistration::showHeaderMainMenu();
		$output['categories'] = Display_DUserRegistration::showMainCat();
	    $output['newscontent']=Core_CNews::showNewsPage();
		
        if($_SESSION['compareProductId']=='')
			$output['viewProducts']['viewProducts'] = Display_DWishList::viewProductElse();
		else
			$output['viewProducts']=Core_CWishList::addtoCompareProduct();
		Bin_Template::createTemplate('news.html',$output);
	}
}
?>