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
 * CAddAttributeValues
 *
 * This class contains functions to show and update the attribute values 
 *
 * @package		Core_Settings_CAddAttributeValues
 * @category	Core
 * @author		ZeusCart Team
 * @link		http://www.zeuscart.com
 * @version 	2.3
 */

// ------------------------------------------------------------------------



class Core_Settings_CAddAttributeValues 
{
	
	/**
	 * Function gets all the attribute values from the table
	 * 
	 * 
	 * @return string
	 */
	
	function getAttribListValues() //$name
	{
		include("classes/Display/DAddAttributeValues.php");
		
		$attribname=$_POST['id'];
		$sql = "SELECT * FROM `attribute_table` order by attrib_name asc ";
		$cquery = new Bin_Query();
		if($cquery->executeQuery($sql))
		{
			$records = $cquery->records;
		}	
		return 	Display_DAttributeValueSelection::getAttribListValues($records,$attribname);
		
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
			return '<div class="exc_msgbox">Attribute values Not Found</div>';
			}
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
		if($_POST['id']!=='all')
		{
			if($_POST['attributevalues']!=='' )
			{
				$sql = "INSERT INTO attribute_value_table (attrib_id,attrib_value) VALUES ('".$_POST['id']."','".$_POST['attributevalues']."')";
					
				$query = new Bin_Query();
				if($query->updateQuery($sql))
					return '<div class="success_msgbox">Attribute Values <b>'.$_POST['attributevalues'].'</b> Added Successfully</div?';
			}			
			else
			{
				return '<div class="exc_msgbox">Please Enter the Attribute Values</div>';
			}		
		}
		else
			return '<div class="exc_msgbox">Please Select Attribute </div>';
		
	}
	
	/**
	 * Function shows the an attribute value from the table for updation
	 * 
	 * 
	 * @return string
	 */
	
	
	function displayAttributeValues()
    {
        include("classes/Display/DAddAttributeValues.php");
		
		$sql = "SELECT * FROM attribute_value_table where attrib_value_id=".(int)$_GET['id'];
		
		$query = new Bin_Query();
		if($query->executeQuery($sql))
		{		
			return  Display_DAttributeValueSelection::displayAttributeValues($query->records);
		}
		else
		{
			return '<div class="success_msgbox">No Attribute Values Found</div>';
		}
		//$this->makeconstant($this->data);
		
    }
	
	/**
	 * Function updates the attribute value into the table 
	 * 
	 * 
	 * @return string
	 */
	
	function editAttributeValues()
	{
	//print_r($_GET);
	//print_r($_POST);
	//echo 's';
		$sql = "UPDATE attribute_value_table SET attrib_value = '".$_POST['attributevalues']."' WHERE attrib_value_id =".(int)$_GET['id'];
			
		$query = new Bin_Query();
		if($query->updateQuery($sql))
			//echo "called";
		return '<div class="success_msgbox">Attribute Value <b> '.$_POST['attributevalues'].'</b> Updated Successfully</div>';
		
	}
	
	/**
	 * Function deletes the attribute value from the table 
	 * 
	 * 
	 * @return string
	 */
	
	
	function deleteAttributeValues()
	{
			//print_r($_GET);
			$sql = "DELETE FROM attribute_value_table WHERE attrib_value_id=".(int)$_GET['id'];
			$query = new Bin_Query();
			if($query->updateQuery($sql))
			//echo "called";
			return '<div class="success_msgbox">Deleted Successfully</div>';
	}	
	

}
?>