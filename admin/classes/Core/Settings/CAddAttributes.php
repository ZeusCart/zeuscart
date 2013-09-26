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
 * This class contains functions to edit and delete attributes from the database.
 *
 * @package  		Core_Settings_CAddAttributes
 * @category  		Core
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
   * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */
class Core_Settings_CAddAttributes 
{
	
	
	/**
	 * Function displays all the attributes from the table
	 * @param $Err contain both error message and error values
	 * 
	 * @return string
	 */	 	
	
	function showAttributes($Err)
        {
            include("classes/Display/DAddAttributes.php");
				
		$pagesize=25;
	   if(isset($_GET['page']))
		{
		    
			$start = trim($_GET['page']-1) *  $pagesize;
			$end =  $pagesize;
		}
		else 
		{
			$start = 0;
			$end =  $pagesize;
		}
		$total = 0;
		
		$sql = "SELECT * FROM attribute_table order by attrib_name asc ";
		$query = new Bin_Query();
		if($query->executeQuery($sql))
		{	
			$total = ceil($query->totrows/ $pagesize);
			include('classes/Lib/Paging.php');
			$tmp = new Lib_Paging('classic',array('totalpages'=>$total, 'length'=>10),'pagination');
			$this->data['paging'] = $tmp->output;
			$this->data['prev'] =$tmp->prev;
			$this->data['next'] = $tmp->next;	
		$sql = "select * from attribute_table LIMIT $start,$end";
		$query = new Bin_Query();
		if($query->executeQuery($sql))
			return Display_DAttributeSelection::listAttribute($query->records,$this->data['paging'],$this->data['prev'],$this->data['next'],$start);
		}
		else
		{
		return '<div class="alert alert-error">
              <button type="button" class="close" data-dismiss="alert">×</button> Attributes Not Found</div>';
		}
	}
	
	/**
	 * Function inserts an new attribute into the table 
	 * 
	 * 
	 * @return string
	 */	 	
	 
	function addAttributes()
	{ 
		
		if($_POST['attributes']!=='')
		{
			
				$sql = "INSERT INTO attribute_table (attrib_name) VALUES ('".$_POST['attributes']."')";
				
				$query = new Bin_Query();
				if($query->updateQuery($sql))
				{
					$_SESSION['attribmsg']='<div class="alert alert-success">
              				<button type="button" class="close" data-dismiss="alert">×</button> Attribute <b>'.$_POST['attributes'].'</b> Added Successfully</div>';
	
					header('Location:?do=attributes');
				}
		
		}
		else
		{

			$_SESSION['attribmsg']='<div class="alert alert-error">
			<button type="button" class="close" data-dismiss="alert">×</button> Please Enter Attribute Name</div>';
			header('Location:?do=attributes&action=add');
			
		}
	}
	/**
	 * Function displays the attributes for updation from the table 
	 * 
	 * 
	 * @return string
	 */	 	
	function displayAttributes($Err)
        {
		include("classes/Display/DAddAttributes.php");
       
		$sql = "SELECT * FROM attribute_table where attrib_id=".(int)$_GET['id'];
		$query = new Bin_Query();
		if($query->executeQuery($sql))
		{		
			
			return  Display_DAttributeSelection::displayAttributes($query->records,$Err);
		}
		else
		{
			return '<div class="alert alert-error">
             		 <button type="button" class="close" data-dismiss="alert">×</button> Attributes Not Found</div>';
		}
	}
	/**
	 * Function updates the changes made in the attribute table
	 * 
	 * 
	 * @return string
	 */	 	
	function updateAttributes()
	{

			
		if($_POST['attributes']!=='')
		{
			
	
			$sql = "UPDATE attribute_table SET attrib_name = '".$_POST['attributes']."' WHERE attrib_id =".(int)$_GET['id'];
				
			$query = new Bin_Query();
			if($query->updateQuery($sql))
			{
				$_SESSION['attribmsg']='<div class="alert alert-success">
				<button type="button" class="close" data-dismiss="alert">×</button> Updated <b>'.$_POST['attributes'].'</b> Successfully</div>';
	
				header('Location:?do=attributes');
				
			}
			else
			{
				$_SESSION['attribmsg']='<div class="alert alert-error">
				<button type="button" class="close" data-dismiss="alert">×</button> Not Edited</div>';
	
				header('Location:?do=attributes');
				
			}
			
		}	
		else
		{

			$_SESSION['attribmsg']='<div class="alert alert-error">
			<button type="button" class="close" data-dismiss="alert">×</button> Please Enter Attribute Name</div>';
			header('Location:?do=attributes&action=edit&id='.$_GET['id']);
			
		}
	}
	
	/**
	 * Function deletes the attribute from the table 
	 * 
	 * 
	 * @return string
	 */	 	
	
	function deleteAttributes()
	{
			
			foreach ($_POST['attributeCheck'] as $key => $value) {
				
			
			$sql = "DELETE FROM attribute_table WHERE attrib_id='$value'";
			$query = new Bin_Query();
			$query->updateQuery($sql);
			
			
			$sql = "DELETE FROM attribute_value_table WHERE attrib_id='$value'";
			$query = new Bin_Query();
			if($query->updateQuery($sql))
			{
				$result='<div class="alert alert-success">
            		  <button type="button" class="close" data-dismiss="alert">×</button> Deleted Successfully</div>';
			}
			else
			{
				$result='<div class="alert alert-error">
              		<button type="button" class="close" data-dismiss="alert">×</button> Not Deleted</div>';
			}
		}

		return $result;
			
	}

}
?>