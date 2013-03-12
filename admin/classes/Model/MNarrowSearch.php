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
 * This class contains functions to display the search results
 *
 * @package  		Model_MNarrowSearch
 * @category  		Model
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
  * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */
class Model_MNarrowSearch
{
	
	/**
	 * Stores the output
	 *
	 * @var array $output
	 */	
	var $output = array();	
	
	
	/**
	 * Function displays the search results 
	 * 
	 * 
	 * @return array
	 */
	
	
	function narrowSearch()
	{
		include('classes/Core/CNarrowSearch.php');
		include('classes/Display/DNarrowSearch.php');		
		
		$output['narrowsearch'] = Core_CNarrowSearch::narrowSearchContent();				

		Bin_Template::createTemplate('NarrowSearch.html',$output);
	}	
}
?>