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
 * This class contains functions to display the auto complete popup window
 * at the admin side.
 *
 * @package  		Model_MAutoComplete
 * @category  		Model
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
  * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */

class Model_MAutoComplete
{
	/**
	 * Stores the output
	 *
	 * @var array $output
	 */	
	 
	var $output = array();	
	
	/**
	 * Function displays the auto complete window at the admin side
	 *    
	 * 
	 * @return array
	 */
	function showComplete()
	{
		//include('classes/Core/CAutoComplete.php');
		//echo 'hi';
		//$default = new Core_CCAutoComplete();
		//$output['auto']=$default->autoComplete();
		Bin_Template::createTemplate('autocomplete.html',$output);
	}
	
	
	/**
	 * Function displays the auto complete window at the admin side
	 *    
	 * 
	 * @return array
	 */
	
	function autoComplete()
	{
		include('classes/Core/CAutoComplete.php');
		//$default = new Core_CAutoComplete();
		Core_CAutoComplete::autoComplete();
		//Bin_Template::createTemplate('autocomplete.html',$output);
	}
}	
?>