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
 * CFooterSettings
 *
 * This class contains functions to add, edit and delete the footer contents into the database
 *
 * @package		Core_Settings_CFooterSettings
 * @category	Core
 * @author		ZeusCart Team
 * @link		http://www.zeuscart.com
 * @version 	2.3
 */

// ------------------------------------------------------------------------

class Core_Settings_CFooterSettings
{
 	
	/**
	 * Function adds a new footer link into the database
	 * 
	 * 
	 * @return string
	 */	 	
	function addLinkSettings()
	{
	$sql = "SELECT * FROM footer_link_table WHERE link_name ='".$_POST['linkname']."'";
		$query = new Bin_Query();
		if($query->executeQuery($sql))
		{
			return '<div class="error_msgbox" style="width:650px;">Already this link is Added</div>';
		}
		else
		{
		$sql = "INSERT INTO footer_link_table (link_name,link_url) VALUES ('".$_POST['linkname']."','".$_POST['linkurl']."')";
			
			$query = new Bin_Query();
			if($query->updateQuery($sql))
			return  '<div class="success_msgbox" style="width:650px;">Link Added Successfully</div>';
		}
	
	}
	
	/**
	 * Function displays all the footer link available in the table
	 * 
	 * 
	 * @return string
	 */	 	
	
	function showFooterLink()
	{
		
		$sql = "SELECT * FROM footer_link_table ";
		$query = new Bin_Query();
		$query->executeQuery($sql);
		//print_r($query);
		//print_r($query->records);
		return Display_DFooterSettings::showFooterLink($query->records);
	}
	
	/**
	 * Function displays all the footer link available in the table
	 * 
	 * 
	 * @return string
	 */	 	
	
	function viewFooterLink()
	{
		$sql = "SELECT * FROM footer_link_table ";
		$query = new Bin_Query();
		$query->executeQuery($sql);
		//print_r($query);
		//print_r($query->records);
		return Display_DFooterSettings::viewFooterLinkByRows($query->records);
	}
	
	/**
	 * Function displays all the custom pages available in the table
	 * 
	 * 
	 * @return string
	 */	 	
	
	function showCustomPage()
	{
		$sql = "SELECT * FROM custompage_table order by page_name ";
		$query = new Bin_Query();
		$query->executeQuery($sql);
		return Display_DFooterSettings::showCustomPage($query->records);
	}
	
	
	/**
	 * Function gets a selected footer link for updation from the database
	 * 
	 * 
	 * @return string
	 */	 	
	
	function editFooterLinks()
    {
        	
		$sql = "SELECT * FROM footer_link_table where link_id=".(int)$_GET['id'];
		
		$query = new Bin_Query();
		if($query->executeQuery($sql))
		{		
			return Display_DFooterSettings::editFooterLinks($query->records);
		}
		else
		{
			return "No Footer Found";
		}
			
    }
	
	
	/**
	 * Function updates the changes for the selected footer link into the database
	 * 
	 * 
	 * @return string
	 */	 	
	
	function updateFooterLinks()
	{
	//print_r($_GET);
	//print_r($_POST);
	//echo 's';
		$sql = "UPDATE footer_link_table SET link_name = '".$_POST['linkname']."', link_url='".$_POST['linkurl']."' WHERE link_id =".(int)$_GET['id'];
			
		$query = new Bin_Query();
		if($query->updateQuery($sql))
			//echo "called";
		return '<div class="success_msgbox" style="width:650px;">Updated Successfully</div>';
		
	}
	
	/**
	 * Function deletes the selected footer link from the database
	 * 
	 * 
	 * @return string
	 */	 	
	
	function deleteFooterLinks()
	{
			//print_r($_GET);
			$sql = "DELETE FROM footer_link_table WHERE link_id=".(int)$_GET['id'];
			$query = new Bin_Query();
			$query->updateQuery($sql);
			return '<div class="success_msgbox" style="width:650px;">Deleted Successfully</div>';
			
	}
	
}
?>