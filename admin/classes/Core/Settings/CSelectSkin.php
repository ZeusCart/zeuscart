<?php
/**
* GNU General Public License.

* This file is part of ZeusCart V2.3.

* ZeusCart V2.3 is free software: you can redistribute it and/or modify
* it under the terms of the GNU General Public License as published by
* the Free Software Foundation, either version 3 of the License, or
* (at your option) any later version.
* 
* ZeusCart V2.3 is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
* GNU General Public License for more details.
* 
* You should have received a copy of the GNU General Public License
* along with Foobar. If not, see <http://www.gnu.org/licenses/>.
*
*/

/**
 * CSelectSkin
 *
 * This class contains functions to get the details of the skins from the table  
 *
 * @package		Core_Settings_CSelectSkin
 * @category	Core
 * @author		ZeusCart Team
 * @link		http://www.zeuscart.com
 * @version 	2.3
 */

// ------------------------------------------------------------------------

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
		
		
			$sql = "SELECT set_name,set_value FROM `admin_settings_table` where set_name='Site Skin'";
			$query = new Bin_Query();
			if($query->executeQuery($sql))
			{		
				
				return $query->records[0]['set_value'];
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
			$sql = "UPDATE admin_settings_table SET set_value='".$_POST['skingroup']."' WHERE  set_name='Site Skin'";  
			if($query->updateQuery($sql))
			{
				return '<div class="success_msgbox" style="width:648px;">Site skin is updated to <b>'.$_POST['skingroup'].'</b> Successfully</div>';
			}
			else
			{
				return '<div class="error_msgbox" style="width:648px;">Not Updated</div>';
			}
		}
	 }
	
		
}


?>