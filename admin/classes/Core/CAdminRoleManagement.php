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
 * This class contains functions to display and update the selected sub admin roles.
 *
 * @package  		Core_CAdminRoleManagement
 * @category  		Core
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
   * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */


 class Core_CAdminRoleManagement
{
	
	/**
	 * Function displays the list of sub admin roles available in the database
	 * 
	 * 
	 * @return string
	 */
	
 	 function dispSubAdminRole()
	{
	    $id=(int)$_GET['id'];
	    $sql='SELECT * FROM `pages_action_table` order by page_id';
		
		$obj=new Bin_Query();
  	    $obj->executeQuery($sql);
		$pages=$obj->records;
		
	    $sql="select * from subadmin_table a inner join subadmin_roles_table b on a.subadmin_id=b.subadmin_id where b.subadmin_id=".$id;
 		$obj=new Bin_Query();
  	    $obj->executeQuery($sql);
		$rights=$obj->records;
		
		$sql="select subadmin_name from subadmin_table where subadmin_id=".$id;
		$obj=new Bin_Query();
  	    $obj->executeQuery($sql);
		$subadmin=$obj->records[0]['subadmin_name'];
		
		return Display_DAdminRoleManagement::displaySubAdminRole($pages,$rights,$subadmin,$id); 	 

	}
	
	/**
	 * Function displays the list of sub admin roles available in the database
	 * 
	 * 
	 * @return string
	 */
	
	 function dispSubAdminRoleOld()
	{
	    $id=$_GET['id'];
	    $sql='select b.subadmin_role_id,a.subadmin_name,c.page_description,c.page_name,c.page_action,b.subadmin_rights from subadmin_table a inner join subadmin_roles_table b on a.subadmin_id = b.subadmin_id inner join pages_action_table c on c.page_id=b.subadmin_page_id where a.subadmin_id='.$id ;
		
		$obj=new Bin_Query();
  	    $obj->executeQuery($sql);
		$val1=$obj->records;
		
	    $sql="select * from pages_action_table where page_id Not in (select a.page_id from pages_action_table a inner join subadmin_roles_table b on a.page_id =b.subadmin_page_id where b.subadmin_id=".$id.")";
 		$obj=new Bin_Query();
  	    $obj->executeQuery($sql);
		$val2=$obj->records;
		 $sql="select count(*) as count from pages_action_table where page_id Not in (select a.page_id from pages_action_table a inner join subadmin_roles_table b on a.page_id =b.subadmin_page_id where b.subadmin_id=".$id.")";
		$obj=new Bin_Query();
  	    $obj->executeQuery($sql);
		$val3=$obj->records;
		
		$sql="select subadmin_name from subadmin_table where subadmin_id=".$id;
		$obj=new Bin_Query();
  	    $obj->executeQuery($sql);
		$val4=$obj->records[0]['subadmin_name'];
		//$obj1=new Core_CAdminRoleManagement();
		//Core_CAdminRoleManagement::dropDownPageName();
		return Display_DAdminRoleManagement::displaySubAdminRole($val1,$val2,$val3,$id,$val4); 	 

	}	
	
	
	/**
	 * Function displays the sub admin role for the selected sub admin 
	 * 
	 * 
	 * @return string
	 */
	
	function dispSelectedSubAdminRole()
	{

		 $id=$_GET['id'];
		 $sql='select b.subadmin_role_id,a.subadmin_name,c.page_description,c.page_name,c.page_action,b.subadmin_rights from subadmin_table a inner join subadmin_roles_table b on a.subadmin_id = b.subadmin_id inner join pages_action_table c on c.page_id=b.subadmin_page_id where b.subadmin_role_id='.$id;
         $obj1=new Bin_Query();
		 $obj1->executeQuery($sql);
		 return Display_DAdminRoleManagement::displaySelectedSubAdminRole($obj1->records,$id); 
	}
			
	/**
	 * Function updates the sub admin role in the database
	 * 
	 * 
	 * @return string
	 */
	
	function updateSubAdminRole()
	{
	
		$id= $_POST['subroleid'];
		$status=$_POST['subadminstatus'];    
		if($status)
		{
		    $status=1;
		}
		else
		{
		    $status=0;
		}
	    $sql="update subadmin_roles_table set subadmin_rights=".$status." where subadmin_role_id=".$id;
   	    $obj=new Bin_Query();
		$obj->updateQuery($sql); 
		$fin='<div class="alert alert-success">
    <button type="button" class="close" data-dismiss="alert">×</button> <strong> well done !</strong> Updated Successfully.</div>';
		return $fin;
	}
	
	/**
	 * Function deletes a sub admin role in the specified table
	 * 
	 * 
	 * @return string
	 */	
	
	function deleteSubAdminRole()
	{
	    
	     $id=$_GET['id'];
		  $sql='delete from subadmin_roles_table where subadmin_role_id='.$id;
		
         $obj1=new Bin_Query();
		 $obj1->updateQuery($sql);
		 $fin='One Record Deleted Successfully';
	     return $fin;
	}
	
	/**
	 * Function inserts a new sub admin role into the table 
	 * 
	 * 
	 * @return string
	 */	


	function insertSubAdminRoleOld()
	{
	   $name=  $_POST['adminname'];
  	   $subadminid=$_POST['subadminid'];
	   $id=$_POST['selectpagename'];
	   $status=$_POST['status'];
	   if($status)
	   {
	      $status=1;
	   }
	   else
	   {
	      $status=0;
	   }
	   $sql="insert into subadmin_roles_table (subadmin_id,subadmin_page_id,subadmin_rights)values(".$subadminid.",".$id.",".$status.")";
	   $obj5=new Bin_Query();
  	   $obj5->updateQuery($sql);
	   $fin='One Record Inserted Successfully';
	   return $fin;
	}
	
	/**
	 * Function inserts a new sub admin role into the table 
	 * 
	 * 
	 * @return string
	 */	
	
	function insertSubAdminRole()
	{
		$subadminid=$_POST['subadminid'];
	  	$query = new Bin_Query();
		$sql="delete from subadmin_roles_table where subadmin_id=".$subadminid;
		$query->executeQuery($sql);
		for($i=0;$i<count($_POST['chkStatus']);$i++)
		{
			$pageid=$_POST['chkStatus'][$i];
			$sql="insert into subadmin_roles_table (subadmin_id,subadmin_page_id,subadmin_rights)values(".$subadminid.",".$pageid.",1)";
			$query->updateQuery($sql);
		}
		$fin='<div class="alert alert-success">
    <button type="button" class="close" data-dismiss="alert">×</button> <strong> well done !</strong> Updated Successfully.</div>';
	   return $fin;
	}
	
}
?>