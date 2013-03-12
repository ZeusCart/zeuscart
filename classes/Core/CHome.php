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
 * Home page related  class
 *
 * @package   		Core_CHome
 * @category    	Core
 * @author    		AJ Square Inc Dev Team
 * @link   		http://www.zeuscart.com
  * @copyright 	        Copyright (c) 2008 - 2013, AJ Square, Inc.
 * @version   		Version 4.0
 */
class Core_CHome
{

	/**
	 * This function is used to get  the site logo from  db
	 * 
	 * 
	 * @return string
	 */
	function getLogo()
   	{
		$sqlselect = "SELECT set_value FROM admin_settings_table WHERE set_name='Site Logo'";
		$obj = new Bin_Query();
		if($obj->executeQuery($sqlselect))
		{
			if(!file_exists($obj->records[0]['set_value']))
			{
			$output =  "images/logo/logo.gif";	
			}
			else
			{
			$output =  $obj->records[0]['set_value'];	
			}			
		}
		else
		{
			$output = "images/logo/logo.gif";
		}
		return $output;
   	}
	/**
	 * This function is used to get  the site banner from  db
	 * 
	 * 
	 * @return string
	 */
	function getBanner()
   	{
		include_once('classes/Display/DHome.php');   		
		$sql= "SELECT set_value FROM admin_settings_table WHERE set_name='Homepage Banner Image'";
		$obj = new Bin_Query();
		$obj->executeQuery($sql);
		if(file_exists($obj->records[0]['set_value']))
		{
			$output['bannerImage'] =  $obj->records[0]['set_value'];
			$sql= "SELECT set_value FROM admin_settings_table WHERE set_name='Homepage Banner URL'";
			if($obj->executeQuery($sql))		
				$output['bannerUrl'] =  $obj->records[0]['set_value'];	
		}
		else
			$output['bannerImage'] = "images/banner/banner.jpg";
		
		return  Display_DHome::getBanner($output);
   	}
	
	/**
	 * This function is used to get  the site title from  db
	 * 
	 * 
	 * @return string
	 */
	function pageTitle()
	{
			
			$sqlselect = "SELECT set_value FROM admin_settings_table WHERE set_name='Site Moto'";
			$obj = new Bin_Query();
			if($obj->executeQuery($sqlselect))
			{
				$output =  $obj->records[0]['set_value'];
			}
			else
			{
				$output = "Smart Shopping !";
			}
			return $output;
	}
	/**
	 * This function is used to get  the skin name from  db
	 * 
	 * 
	 * @return string
	 */
	function skinName()
	{
			
			$sqlselect = "SELECT set_value FROM admin_settings_table WHERE set_name='Site Skin'";
			$obj = new Bin_Query();
			if($obj->executeQuery($sqlselect))
			{
				$output =  $obj->records[0]['set_value'];
			}
			else
			{
				$output = "default";
			}
			return $output;
	}
   /**
	 * This function is used to Set the time zone assigned in the admin settings 
	 * 
	 * 
	 * @return string
	 */
	function  setTimeZone()
	{
			$sql = "SELECT set_value FROM admin_settings_table WHERE set_name='Time Zone'";
			$obj = new Bin_Query();
			if($obj->executeQuery($sql))
				date_default_timezone_set($obj->records[0]['set_value']); 		
	}
	/**
	 * This function is used to get  the google analytic code from  db
	 * 
	 * 
	 * @return string
	 */
	function getGoogleAnalyticsCode()
	{
			
			$sqlselect = "SELECT set_value FROM admin_settings_table WHERE set_name='Google Analytics Code'";
			$obj = new Bin_Query();
			if($obj->executeQuery($sqlselect))
			{
				$output =  $obj->records[0]['set_value'];
			}
			else
			{
				$output = "";
			}
			return $output;
	}
	/**
	 * This function is used to get  the google ad  from  db
	 * 
	 * 
	 * @return string
	 */
	function getGoogleAd()
	{
			
			$sqlselect = "SELECT set_value FROM admin_settings_table WHERE set_name='Google AdSense code'";
			$obj = new Bin_Query();
			if($obj->executeQuery($sqlselect))
			{
				$output =  $obj->records[0]['set_value'];
			}
			else
			{
				$output = "";
			}
			return $output;
	}
	/**
	 * This function is used to get  the footer content from  db
	 * 
	 * 
	 * @return string
	 */
	function footer()
	{
			include_once('classes/Display/DHome.php');
			$sql = "SELECT link_name,link_url FROM footer_link_table ";
			$query = new Bin_Query();
			if($query->executeQuery($sql))
			{
				return Display_DHome::footer($query->records);
			}	
	}
   
   
}
?>	