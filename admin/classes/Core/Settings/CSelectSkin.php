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
 * This class contains functions to get the details of the skins from the table  
 *
 * @package  		Core_Settings_CSelectSkin
 * @category  		Core
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
   * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */


class Core_Settings_CSelectSkin 
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
	 * Function gets the style details from the database 
	 * 
	 * 
	 * @return string
	 */	 		  
	function currentSkin()
	{
		
		
			$sql = "SELECT set_id,site_skin FROM `admin_settings_table` where set_id ='1'";
			$query = new Bin_Query();
			if($query->executeQuery($sql))
			{		
				
				return $query->records[0]['site_skin'];
			}
			else
			{
				//$output['showskin'] = "No skin Found";
			}
	}
	
	/**
	 * Function gets the skin details from the database 
	 * 
	 * 
	 * @return string
	 */	 		
	
	 
	function displaySkin()
	{
			include("classes/Display/DSelectSkin.php");
		
			$sql = "SELECT * FROM `skins_table`";
			$query = new Bin_Query();		

			if($query->executeQuery($sql))
			{		
				$selSkin=Core_Settings_CSelectSkin::currentSkin();
				return Display_DSelectSkin::displaySkinWithSelected($query->records,$selSkin);
			}
			else
			{
				//$output['showskin'] = "No skin Found";
			}
				
	}
	
	/**
	 * Function updates the skin details into the database 
	 * 
	 * 
	 * @return string
	 */	 		
	
	 function updateSkin()
	 {
		$query = new Bin_Query();
		if($_POST['skingroup'] != '')
		{
			$sql = "UPDATE admin_settings_table SET site_skin='".$_POST['skingroup']."' WHERE  set_id='1'";  
			if($query->updateQuery($sql))
			{
				return '<div class="alert alert-success">
			<button data-dismiss="alert" class="close" type="button">×</button> Site skin is updated to <b>'.$_POST['skingroup'].'</b> Successfully</div>';
			}
			else
			{
				return '<div class="alert alert-error">
			<button data-dismiss="alert" class="close" type="button">×</button>  Not Updated</div>';
			}
		}
	 }
	
		
}


?>