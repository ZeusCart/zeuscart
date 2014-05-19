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
 * This class contains functions related db connnections process
 *
 * @package  		Bin_DbConnect
 * @subpackage          Bin_SetConfiguration
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
 * @version  		Version 4.0
 * @created   		January 15 2013
 * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.	
 */
class Bin_DbConnect extends Bin_SetConfiguration
{
	
	var $connstatus;
	/**
	 * It is Used for connection
     *
     * @return void
     */
	function Bin_DbConnect($dbhost=HOST, $dbuser=USER, $dbpass=PASSWORD, $dbname=DB)
	{
		if(!$this->connstatus)
		{
			$conn = mysql_connect($dbhost,$dbuser,$dbpass) ;
			mysql_set_charset('utf8',$conn);
			mysql_select_db($dbname,$conn);
			$this->connstatus=1;
		}
	}


	/**
	 * This will close an active database connection.
	 * 
	 * @return void
	 */
	
	function closeDbConnect()
	{
		if(mysql_close())
			$this->connstatus=0;
		else 
			$this->connstatus=1;
	}


}
new Bin_DbConnect();
?>