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
 * This class contains functions to display the list of shipment trackers available 
 *
 * @package  		Model_MShippingTracker
 * @category  		Model
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
  * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */
class Model_MShippingTracker
{
	/**
	 * Stores the output
	 *
	 * @var array $output
	 */	
	var $output = array();	
	
	/**
	 * Function displays the status for the list of shipment trackers available 
	 * 
	 * 
	 * @return array
	 */
	function displayShippingTrackerSetting()
	{
		include('classes/Core/CShippingTracker.php');
		include('classes/Display/DShippingTracker.php');		
		include('classes/Core/CAdminHome.php');
		$output['username']=Core_CAdminHome::userName();
		$output['currentDate']=date('l, M d, Y H:i:s');	
		$output['currency_type']=$_SESSION['currency']['currency_tocken'];
		$output['shippingtrackersetting'] =   Core_CShippingTracker::displayShippingTrackerSetting();				

		Bin_Template::createTemplate('shipmentstatus.html',$output);
		UNSET($_SESSION['shipmentMsg']);
	}	
	
	/**
	 * Function updates the status for the list of shipment trackers available 
	 * 
	 * 
	 * @return array
	 */
	
	function updateShippingTrackerSetting()
	{
		include('classes/Core/CShippingTracker.php');
		include('classes/Display/DShippingTracker.php');		
		include('classes/Core/CAdminHome.php');
		$output['username']=Core_CAdminHome::userName();
		$output['currentDate']=date('l, M d, Y H:i:s');	
		$output['currency_type']=$_SESSION['currency']['currency_tocken'];
		$output['updatedshippingtrackersetting'] =   Core_CShippingTracker::updateShippingTrackerSetting();				

	}	
}
?>