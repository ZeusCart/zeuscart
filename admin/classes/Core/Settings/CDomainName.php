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
 * This class contains functions to show and update the domain name into the database
 *
 * @package  		Core_Settings_CDomainName
 * @category  		Core
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
   * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */

class Core_Settings_CDomainName 
{
	
	/**
	 * Stores the output
	 *
	 * @var array $output
	 */		
	var $output = array();
	
	/**
	 * Stores the error messages
	 *
	 * @var array $errormessages
	 */	

	var $errormessages = array();
	
	
	/**
	 * Function displays the domain name from the database
	 * 
	 * 
	 * @return string
	 */	 		
	function domainName()
	{
		
		
			$sql = "SELECT set_name,set_value FROM `admin_settings_table` where set_name='Domain Name'";
			$query = new Bin_Query();
			if($query->executeQuery($sql))
			{		
				
				return Display_DDomainName::domainName($query->records);
			}
			else
			{
				return '<div class="error_msgbox" style="width:646px;">Admin Email Site Settings Not Found</div>';
			}
	}
	
	/**
	 * Function updates the changes made in the domain name
	 * 
	 * 
	 * @return string
	 */	 	
	
	function updateDomainName()
	{

		if ($_POST['name']!='')
		{
			$sql = "UPDATE admin_settings_table SET set_value='".$_POST['name']."' where set_name='Domain Name'";
			$query = new Bin_Query();
			if($query->updateQuery($sql))
			{		
				
				return '<div class="success_msgbox" style="width:646px;">Domain Name <b>'.$_POST['name'].'</b> Saved Successfully</div>';
			}
			else
			{
				return '<div class="error_msgbox" style="width:646px;">Domain Name Not Found</div>';
			}
		}
		else
			return '<div class="error_msgbox" style="width:646px;">Domain Name Should Not Be Empty</div>';
	}
}	
 ?>