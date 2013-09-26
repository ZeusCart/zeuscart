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
 * This class contains functions to show and update the attribute values
 *
 * @package  		Core_Settings_CAddAttributeValues
 * @category  		Core
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
   * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */

class Core_Settings_CAddAttributeValues 
{
	
	/**
	 * Function gets all the attribute values from the table
	 * 
	 * 
	 * @return string
	 */
	
	function getAttribListValues($Err) //$name
	{
		include("classes/Display/DAddAttributeValues.php");
		
		$attribname=$_POST['id'];
		$sql = "SELECT * FROM `attribute_table` order by attrib_name asc ";
		$cquery = new Bin_Query();
		if($cquery->executeQuery($sql))
		{
			$records = $cquery->records;
		}	
		return 	Display_DAttributeValueSelection::getAttribListValues($records,$attribname,$Err);
		
	}
	
	/**
	 * Function gets all the attribute values with paging 
	 * 
	 * 
	 * @return string
	 */
	
	
       function showAttributeValues()
       {
       	
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
		
		$sql = "SELECT a.attrib_name, b.attrib_value, b.attrib_value_id 
		FROM `attribute_value_table` b
		INNER JOIN attribute_table a ON a.attrib_id = b.attrib_id order by attrib_name";
		$query = new Bin_Query();
		if($query->executeQuery($sql))
		{		
			$total = ceil($query->totrows/ $pagesize);
			include('classes/Lib/Paging.php');
			$tmp = new Lib_Paging('classic',array('totalpages'=>$total, 'length'=>10),'pagination');
			$this->data['paging'] = $tmp->output;
			$this->data['prev'] =$tmp->prev;
			$this->data['next'] = $tmp->next;	
			$sql = "SELECT a.attrib_name, b.attrib_value, b.attrib_value_id 
				FROM `attribute_value_table` b
				INNER JOIN attribute_table a ON a.attrib_id = b.attrib_id order by attrib_name  LIMIT $start,$end";
			$query = new Bin_Query();
			if($query->executeQuery($sql))
			{
				return Display_DAttributeValueSelection::listAttributeValue($query->records,$this->data['paging'],$this->data['prev'],$this->data['next'],$start);
			}
			else
			{
			return '<div class="alert alert-error">
             			 <button type="button" class="close" data-dismiss="alert">×</button> Attribute values Not Found</div>';
			}
		}
		else
		{
			return '<div class="alert alert-error">
				<button type="button" class="close" data-dismiss="alert">×</button> Attribute values Not Found</div>';
		}
		
    }
	
	/**
	 * Function adds a new attribute value into the database
	 * 
	 * 
	 * @return string
	 */
	
	
	function addAttributeValues()
	{
		
		if($_POST['attributevalues']!=='' )
		{
			$sql = "INSERT INTO attribute_value_table (attrib_id,attrib_value) VALUES ('".$_POST['id']."','".$_POST['attributevalues']."')";
				
			$query = new Bin_Query();
			if($query->updateQuery($sql))
				$_SESSION['successmsg']='Attribute Values <b>'.$_POST['attributevalues'].'</b> Added Successfully';
				header('Location:?do=attributevalues');
				exit;
		}			
				
	
	}
	
	/**
	 * Function shows the an attribute value from the table for updation
	 * 
	 * 
	 * @return string
	 */
	
	
	function displayAttributeValues($Err)
    	{
		include("classes/Display/DAddAttributeValues.php");
		
	 	$sql = "SELECT * FROM attribute_value_table where attrib_value_id=".(int)$_GET['id']; 
		
		$query = new Bin_Query();
		if($query->executeQuery($sql))
		{		
			return  Display_DAttributeValueSelection::displayAttributeValues($query->records,$Err);
		}
		else
		{
			return '<div class="alert alert-error">
             		 <button type="button" class="close" data-dismiss="alert">×</button> No Attribute Values Found</div>';
		}
			
   	}
	
	/**
	 * Function updates the attribute value into the table 
	 * 
	 * 
	 * @return string
	 */
	
	function editAttributeValues()
	{
	
		$sql = "UPDATE attribute_value_table SET attrib_value = '".$_POST['attributevalues']."' WHERE attrib_value_id =".(int)$_GET['id'];
			
		$query = new Bin_Query();
		if($query->updateQuery($sql))
		$_SESSION['successmsg']=' Attribute Value <b> '.$_POST['attributevalues'].'</b> Updated Successfully';
		header('Location:?do=attributevalues');
		exit;
	}
	
	/**
	 * Function deletes the attribute value from the table 
	 * 
	 * 
	 * @return string
	 */
	
	
	function deleteAttributeValues()
	{
		foreach ($_POST['attributevalueCheck'] as $key => $value) {

			$sql = "DELETE FROM attribute_value_table WHERE attrib_value_id='$value'";
			$query = new Bin_Query();
			$query->updateQuery($sql);

			
		}
		return '<div class="alert alert-success">
              <button type="button" class="close" data-dismiss="alert">×</button> Deleted Successfully</div>';
	}	
	

}
?>