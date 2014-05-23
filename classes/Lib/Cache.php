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
 * This class contains functions related cache
 *
 * @package  		Lib_Cache
 * @category  		Library
 * @author    		AjSquareInc Dev Team
 * @link   		    http://www.zeuscart.com
 * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */
class Lib_Cache
{
	/**
	 * Stores the output 
	 *
	 * @var array 
	 */	
	var $vars = array();
	/**
	 * Stores the output variable expiry data in array
	 *
	 * @var array 
	 */	
	var $var_expires = array();

	/**
	 * Stores the output variable is modified or not 
	 *
	 * @var bool 
	 */	
	var $is_modified = false;
	/**
	 * Stores the output sql table rowset
	 *
	 * @var array 
	 */	
	var $sql_rowset = array();
	/**
	 * Stores the output  sql row pointer
	 *
	 * @var array 
	 */	
	var $sql_row_pointer = array();
	/**
	 * Declare the  varible  
	 *
	 * @var string 
	 */	
	var $cache_dir = '';
	/** 
	* Function is user to cache related process
	* @param string $cdir
	* 
	*/
	function Lib_Cache($cdir)
	{
		$this->cache_dir = $cdir;	
	}
	/** 
	* Function is used to check the  file name
	* @param string $var_name
	* @return bool
	*/
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
	* @param  string $var_name
	* @param  string $data
	* @param  string $var
	* @param  integer $ttl
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