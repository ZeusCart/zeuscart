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
 *  This class contains functions to  menu management
 *
 * @package  		Model_MMenuManagement
 * @category  		Model
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
  * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */


class Core_CMenuManagement
{
	
	/**
	 * Function is used  the add  menu 
	 *   
	 * 
	 * @return array
	 */	
	function insertMenus()
	{
		if($_GET['id']=='0')
		{
			$sql="INSERT INTO menu_management_table(menu_title) VALUES('".$_POST['menu_title']."')";
			$obj=new Bin_Query();
			if($obj->updateQuery($sql))
			{
	
				$id=mysql_insert_id();

				$message='<div class="success_msgbox">Menu  <strong>'. $_POST['menu_title']  .'</strong> Created Successfully</div>';
			}
		}
		else
		{
			$sql="UPDATE menu_management_table SET menu_title='".$_POST['menu_title']."' WHERE menu_id ='".$_GET['id']."'";
			$obj=new Bin_Query();
			if($obj->updateQuery($sql))
			{
				$id=$_GET['id'];	
				$message='<div class="success_msgbox">Menu  <strong>'. $_POST['menu_title']  .'</strong> Updated Successfully</div>';
			}
		
			

		}
		$output=array(0=>$id,1=>$message);
		return $output;
		
	}
	/**
	 * Function is used  the get  menu  name from db
	 *   
	 * 
	 * @return array
	 */
	function getMenuName()
	{
		$sql="SELECT * FROM  menu_management_table  WHERE menu_id='".$_GET['id']."'";
		$obj=new Bin_Query();
		$obj->executeQuery($sql);
		$record=$obj->records[0]['menu_title'];
		
		return $record;
	}
	/**
	 * Function is used  the get  menu title from db
	 *   
	 * 
	 * @return array
	 */
	function showMenutitleList()
	{
		$sql="SELECT * FROM  menu_management_table ";
		$obj=new Bin_Query();
		if($obj->executeQuery($sql))
		{

			return Display_DMenuManagement::showMenutitleList($obj->records);
		}
			
	}
	
	/**
	 * Function is used  the get  menu type from db
	 *   
	 * 
	 * @return array
	 */
	function showMenuTypeList()
	{
		$sql="SELECT * FROM  menu_type_table ";
		$obj=new Bin_Query();
		if($obj->executeQuery($sql))
		{

			return Display_DMenuManagement::showMenuTypeList($obj->records);
		}
			
	}
	/**
	 * Function is used  the get  menu type from db
	 *   
	 * 
	 * @return array
	 */
	function selectedMenuTypeList()
	{
		
			$sql="SELECT * FROM  category_table WHERE category_parent_id =0";
			$obj=new Bin_Query();
			if($obj->executeQuery($sql))
			{
	
				return Display_DMenuManagement::showCategoryList($obj->records);
			}

		

	}

	function insertNavigation()
	{


		$sqlselect="SELECT * FROM  menu_management_table WHERE menu_id='".$_GET['id']."' ";	
		$objselect=new Bin_Query();
		$objselect->executeQuery($sqlselect);
		echo $navigation=$objselect->records[0]['menu_navigation'];	
		if($navigation!='')
		{
			$array1=json_decode($navigation,true);
print_r($array1);exit;

			$array2=$_SESSION['navigation'][$_GET['id']];
			$array3=array_merge($array1,$array2);	
			$menunavigation=json_encode($array3);
		}	
		else
		{		
			$menunavigation=json_encode($_SESSION['navigation']);
		}



		echo $sql="UPDATE menu_management_table SET menu_navigation='".$menunavigation."' WHERE  menu_id='".$_GET['id']."'"; exit;
		$obj=new Bin_Query();
		if($obj->updateQuery($sql))
		{
			UNSET($_SESSION['navigation']);
			$output='<div class="success_msgbox">Menu  <strong>'. $_POST['menu_title']  .'</strong> Updated Successfully</div>';
		}

		return $output;

	}

	function selectedMenuNavigation()
	{	

		$mid=$_GET['mid'];
		$_SESSION['navigation'][$mid][]=$_GET['id'];

		return Display_DMenuManagement::selectedMenuNavigation();
	}
	/**
	 * Function is used  the delete  menu in  db
	 *   
	 * 
	 * @return array
	 */	
	function deleteMenus()
	{
		$sql="DELETE  FROM  menu_management_table  WHERE menu_id ='".$_GET['id']."'";
		$obj=new Bin_Query();
		if($obj->updateQuery($sql))
		{
			$id=$_GET['id'];	
			$message='<div class="success_msgbox">Menu  <strong>'. $_POST['menu_title']  .'</strong> Deleted Successfully</div>';
		}	
	
		return $message;
	}
}

?>