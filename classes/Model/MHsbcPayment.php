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
class Model_MHsbcPayment
{
	var $output = array();	
 	/**
	* This function is used to Display the Payment Method Page
 	*/
	function dispGetDetails()
	{
		include('classes/Core/CHome.php');
		$output['sitelogo']=Core_CHome::getLogo();
		$output['pagetitle']=Core_CHome::pageTitle();
		$output['timezone']=Core_CHome::setTimeZone();	
		$output['currentDate']=date('Y-m-d , H:M:s');
		$output['skinname']=Core_CHome::skinName();
		$output['bannerimage']=Core_CHome::getBanner();
		$output['bannerurl']=Core_CHome::getBannerUrl();
		$output['googlead']=Core_CHome::getGoogleAd();
		$output['footer']=Core_CHome::footer();
		include('classes/Core/CHsbcPayment.php');
		include('classes/Display/DHsbcPayment.php');				
		$output['hsbcpayment'] =  Display_DHsbcPayment::dispGetDetails();				
		Bin_Template::createTemplate('HsbcPayment.html',$output);
	}	
}
?>