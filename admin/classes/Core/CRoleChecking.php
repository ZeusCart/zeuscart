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
 * This class contains functions to check the user roles
 *
 * @package  		Core_CRoleChecking
 * @category  		Core
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
   * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */

 class Core_CRoleChecking
{
	 /**
	 * Function checks the user roles in the database
	 * 
	 * 
	 * @return bool
	 */
		 
	 function checkRoles()
	 {
	      $do=$_GET['do'];
		  $action=$_GET['action'];

		  $subadminid=$_SESSION['subadminId'];
		  $adminid=$_SESSION['adminId'];

		 if($subadminid!='' or $adminid!='' or !empty($adminid) or !empty($subadminid))
		{
			 if(((int)$adminid)>0)
			 {
				  $sql1="select * from admin_table where admin_id=".$adminid;
				  $obj1=new Bin_Query();
				  $obj1->executeQuery($sql1);
				  $cou1=$obj1->records;
				  $val1=$cou1[0]['admin_id'];
				  if($val1==$adminid)
				  {
						 return 1 ;
				  }
				  else
				  {
						 return 0;				
				  }
			 }
			 else if(((int)$subadminid)>0)
			 {
				 $sql="select a.subadmin_id,a.subadmin_name,b.subadmin_page_id,c.page_name,c.page_action,b.subadmin_rights from subadmin_table a inner join subadmin_roles_table b on a.subadmin_id=b.subadmin_id inner join pages_action_table c on b.subadmin_page_id=c.page_id where a.subadmin_id='".$subadminid."' and a.subadmin_status=1 and c.page_name='".$do."' and b.subadmin_rights=1";
				  $obj=new Bin_Query();
				  $obj->executeQuery($sql);
				  $cou=$obj->records;
				  $val=$obj->totrows;
				  if(((int)$val)>=1)
					  return 1;
				  else
					return 0;
			 }
			 else
			 {
				return 0;
			 }
		}
		 else
		 {
		 	header("Location:?do=adminlogin");
			exit;
		 }
	 }	
}
?>
