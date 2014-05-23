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
 * This class contains functions to get the timezone details and to update the time zone details 
 *
 * @package  		Core_Settings_CTimeZone
 * @category  		Core
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
   * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */

class Core_Settings_CTimeZone
{
 	
	/**
	 * Function gets the time zone details from the database 
	 * 
	 * 
	 * @return string
	 */	 		
	function currentZone()
	{
		$sql = "SELECT set_name,set_value FROM `admin_settings_table` where set_name='Time Zone'";
		$query = new Bin_Query();
		$query->executeQuery($sql);
		if(count($query-records)>0)
		{		
			return $query->records[0]['set_value'];
		}
		else
		{
			return '<div class="alert alert-error">
    <button type="button" class="close" data-dismiss="alert">×</button> Time Zone is Not Selected in the Site</div>';
		}		
	}
	
	/**
	 * Function gets the time zone details from the database 
	 * 
	 * 
	 * @return string
	 */	 	
	
	function timeZone()
	{
		
		
		$sql = "SELECT tz_timezone FROM `timezone_table` order by tz_timezone";
		$query = new Bin_Query();
		if($query->executeQuery($sql))
		{		
			$sql1 = "SELECT set_name,set_value FROM `admin_settings_table` where set_name='Time Zone'";
			$query1 = new Bin_Query();
			$query1->executeQuery($sql1);
			if(count($query1-records)>0)
			{		
				$selTime= $query1->records[0]['set_value'];
			}
			return Display_DTimeZone::timeZone($query->records,$selTime);
		}
	}	
	
	/**
	 * Function updates the changes made in the time zone details into the database 
	 * 
	 * 
	 * @return string
	 */	 	
	
	function updateTimeZone()
	{
		if($_POST['timezone']!='')
		{
		$sql = "UPDATE admin_settings_table SET set_value='".$_POST['timezone']."' where set_name='Time Zone'";
			$query = new Bin_Query();
			if($query->updateQuery($sql))
				return '<div class="alert alert-success">
    <button type="button" class="close" data-dismiss="alert">×</button> <strong> well done !</strong> Timezone Updated to <b>'.$_POST['timezone'].'</b> Successfully</div>';
		}	
	}
}
 
?>