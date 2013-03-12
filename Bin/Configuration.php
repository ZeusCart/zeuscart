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
 * AJDF
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * @package   		AJDF
 * @author    		AjSquareInc Dev Team
 * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @link    		http://www.ajsquare.com/ajhome.php
 * @version  		Version 4.0
 * @created   		January 15 2013
 */

/**
 * This class contains functions related to configuration  process
 *
 * @package  		Bin
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
 */


//***************** Do not Edit / Change anything in this file ********************// 
class Bin_Configuration extends Bin_Security {  
var $config = array();  
function Bin_Configuration() {  
$this->config["HOST"] = 'localhost';  
$this->config["USER"] = 'root';  
$this->config["PASSWORD"] = '';  
$this->config["DB"] = 'zeuscart';  
} }  
define("IMAGE1_WIDTH",350);  
define("IMAGE1_HEIGHT",500);  
define("IMAGE2_WIDTH",800);  
define("THUMB_WIDTH", 90);  
define("THUMB_HEIGHT",80);  
?>