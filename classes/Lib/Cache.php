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
 * This class contains functions related cache
 *
 * @package  		Classes
 * @subpackage 		Library
 * @category  		Library
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
 */
class Lib_Cache
{
	var $vars = array();
	var $var_expires = array();
	var $is_modified = false;

	var $sql_rowset = array();
	var $sql_row_pointer = array();
	var $cache_dir = '';
	
	function Lib_Cache($cdir)
	{
		$this->cache_dir = $cdir;	
	}
	
	function get($var_name)
	{	

		if (file_exists($var_name))
		{
			return false;
		}		
		@include($this->cache_dir . "{$var_name}.php");
		return (isset($data)) ? $data : false;		
	}

	/**
	* Put data into cache
	*/
	function put($var_name, $data, $var, $ttl = 31536000)
	{	
		
		if ($fp = @fopen($this->cache_dir . "{$var_name}.php", 'wb'))
		{
			@flock($fp, LOCK_EX);
			//"\n\$expired = (time() > " . (time() + $ttl) . ") ? true : false;\nif (\$expired) { return; }\n\n\$data = " .
			fwrite($fp,  "<?php \n\n $data = ".var_export($var, true) . ";\n?>");
			@flock($fp, LOCK_UN);
			fclose($fp);

			@chmod($this->cache_dir . "{$var_name}.php", 0666);
		}		
	}
}



?>