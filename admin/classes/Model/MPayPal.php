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
 * This class contains functions to display the paypal payment gateway
 *
 * @package  		Model_MPayPal
 * @category  		Model
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
  * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */


class Model_MPayPal
{
	/**
	 * Stores the output
	 *
	 * @var array 
	 */	
	var $output = array();	
	/**
	 * Function to show the paypal 
	 *
	 * @return array
	 */	
	function func()
	{
		include('classes/Core/CPayPal.php');
		include('classes/Display/DPayPal.php');		
		
		$output['area1'] =   Core_CPayPal::func1();				

		Bin_Template::createTemplate(CURRENT_TEMPLATE_DIR.'/PayPal.html',$output);
	}	
}
?>