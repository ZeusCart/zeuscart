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
 * This class contains functions to display the polls.
 *
 * @package  		Model_MPolls
 * @category  		Model
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
  * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */

class Model_MPolls
{

	/**
	 * Stores the output
	 *
	 * @var array 
	 */	
	var $output = array();
	/**
	 * Function to display the polls page
	 * 
	 * 
	 * @return array
	 */	
	function showPollsPage()
	{
		include('classes/Core/CPolls.php');
		include('classes/Display/DPolls.php');
		
		$output['pollList'] =   Core_CPolls::showPolls();
		$output['popularTopics'] = Core_CPolls::showTopics();
		$output['catList'] = Core_CPolls::showCategories();
		
		Bin_Template::createTemplate('polls.html',$output);
	}
}



?>