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
 * This class contains functions related to installation  process
 *
 * @package  		Bin
 * @author    		AjSquareInc Dev Team
 * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @link    		http://www.zeuscart.com
 * @version  		Version 4.0
 * @created   		January 15 2013
 */

/**
* Checking whether the installation completed or not
*/

// include_once('Bin/Security.php');
// $obj=new Bin_Configuration();
// 
// if($obj->config['HOST']=='') 
// {
// 	header('Location: install');
// 	exit();
// }

/**
* Checking whether the installation folder removed or not
*/
 
if(file_exists('install'))
{
	global $install_error;
	$install_error ='<div align=center style="background-color:#ff0000; border:1px solid #00ff00; color:#ffffff"><img src="assets/img/warning.gif">Warning: Installation directory exists ZEUSCART ROOT DIRECTORY/install. Please remove/rename this directory for security reasons.</div>';	
}
?>