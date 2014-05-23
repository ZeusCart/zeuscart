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
 * Site hit counter related  class
 *
 * @package   		Core_CHitCounter
 * @category    	Core
 * @author    		AJ Square Inc Dev Team
 * @link   		http://www.zeuscart.com
  * @copyright 	        Copyright (c) 2008 - 2013, AJ Square, Inc.
 * @version   		Version 4.0
 */
class Core_CHitCounter
{
	/**
	 * This function is used to get  the site hit count
	 * 
	 * 
	 * @return string
	 */
	function showCount()
	{
	
		$sql="select count(*) as cnt from site_hit_counter_table";
		$query = new Bin_Query();
		$query->executeQuery($sql);
		return str_pad($query->records[0]['cnt'],9,'0',0);
		
	}
	/**
	 * This function is used to insert  the site hit count
	 * 
	 * 
	 * @return string
	 */
	function setCount()
	{
		$ip=Core_CHitCounter::getRealIpAddr();
		$sql="select * from site_hit_counter_table where ip_address='".$ip."' and date(visited_on)='".date("Y-m-d")."'";
		$query = new Bin_Query();
		$query->executeQuery($sql);
		if(empty($query->records))
		{
			$sql="insert into site_hit_counter_table (ip_address,visited_on) values('".$ip."','".date("y.m.d H.i.s")."')";
			$query = new Bin_Query();
			$query->executeQuery($sql);
		}	
	}
	/**
	 * This function is used to get remote ip address
	 * 
	 * 
	 * @return string
	 */
	function getRealIpAddr()
	{
	  if (!empty($_SERVER['HTTP_CLIENT_IP']))
	  //check ip from share internet
	  {
		$ip=$_SERVER['HTTP_CLIENT_IP'];
	  }
	  elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
	  //to check ip is pass from proxy
	  {
		$ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
	  }
	  else
	  {
		$ip=$_SERVER['REMOTE_ADDR'];
	  }
	  return $ip;
	}
}
?>
