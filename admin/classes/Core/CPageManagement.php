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
 * This class contains functions to get the role details for the subadmin.
 *
 * @package  		Core_CPageManagement
 * @category  		Core
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
   * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */


 class Core_CPageManagement
{
 	
	/**
	 * Function get the role details from the database
	 * 
	 * 
	 * @return string
	 */
	
	function dispPages()
	{
	   $sql="select * from pages_action_table";
	   $obj=new Bin_Query();
	   $obj->executeQuery($sql);
	   return  Display_DPageManagement::dispPages($obj->records);
	}
	
	/**
	 * Function adds a new role into the database 
	 * 
	 * 
	 * @return string
	 */
	
	function insertPages()
	{
		$page_name=$_POST['pagename'];
		$page_action=$_POST['pageaction'];
		$page_description=$_POST['pagedesc'];
	//	$page_id=$_POST['page_id'];
	    $sql="insert into pages_action_table( page_name, page_action, page_description)values('".$page_name."','".$page_action."','".$page_description."')";
	  
	  $obj=new Bin_Query();
	  $obj->updateQuery($sql);	  
	}
	
	/**
	 * Function updates the change in the role details into the database 
	 * 
	 * 
	 * @return string
	 */
	function updatePages()
	{
	    $page_name=$_POST['pagename'];
		$page_action=$_POST['pageaction'];
		$page_description=$_POST['pagedesc'];
		$page_id=$_POST['page_id'];
		$sql="update pages_action_table set page_name ='".$page_name."', page_action ='".$page_action."', page_description ='".$page_description."' where page_id =".$page_id ;
		$obj=new Bin_Query();
	    $obj->updateQuery($sql);	  
	}
	
	/**
	 * Function deletes a role from the database
	 * 
	 * 
	 * @return string
	 */
	
	function deletePages()
	{
	    $page_id=$_GET['id'];
	    $sql="delete from pages_action_table where page_id =".$page_id ;
		$obj=new Bin_Query();
	    $obj->updateQuery($sql);	  
	}
	
	
	/**
	 * Function updates the changes in the roles into the database 
	 * 
	 * 
	 * @return string
	 */
	
	function editPages()
	{
	    $id=$_GET['id'];
	    $sql='select * from pages_action_table where page_id='.$id;
	    $obj=new Bin_Query();
	    $obj->executeQuery($sql);	  
	   return  Display_DPageManagement::editPages($obj->records);
	}
}
?>