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
 * This class contains functions related to  set configuration 
 *
 * @package  		Bin_SetConfiguration
 * @subpackage          Bin_Configuration
 * @author    		AjSquareInc Dev Team
 * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @link   		http://www.zeuscart.com
 * @version  		Version 4.0
 * @created   		January 15 2013
 */
class Bin_SetConfiguration extends Bin_Configuration  
{
	/**
	 * This will set configuration settings global
	 *
	 * @return void
	 */
	function setConfig()
	{
		$this->Bin_Configuration();
		foreach($this->config as $key=>$value)
			define($key,$value);
	}
}
$genconfig = new Bin_SetConfiguration();
$genconfig->setConfig();
?>