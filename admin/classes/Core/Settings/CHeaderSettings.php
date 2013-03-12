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
 * This class contains functions to get and add a new header link into the database
 *
 * @package  		Core_Settings_CFooterSettings
 * @category  		Core
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
   * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */

class Core_Settings_CFooterSettings
{
	
	/**
	 * Function adds a new header link into the database
	 * 
	 * 
	 * @return string
	 */	 	
	
 	function addLink()
	{
	$sql = "SELECT * FROM header_link_table WHERE link_name ='".$_POST['linkname']."'";
		$query = new Bin_Query();
		if($query->executeQuery($sql))
		{
			echo "Already this link is Added";
		}
		else
		{	
		$sql = "INSERT INTO header_link_table (link_name,link_url) VALUES ('".$_POST['linkname']."','".$_POST['linkurl']."')";
			
			$query = new Bin_Query();
			if($query->updateQuery($sql))
			echo  "Added Successfully";
		}
	
	}
	
	/**
	 * Function gets all the header link from the table 
	 * 
	 * 
	 * @return string
	 */	 
	
	function showHeaderLink()
	{		
		$sql = "SELECT * FROM header_link_table ";
		$query = new Bin_Query();
		$query->executeQuery($sql);
		return Display_DHeaderSettings::showHeaderLink($query->records);	
	}
	
}
?>