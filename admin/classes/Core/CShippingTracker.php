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
 *  This class contains functions to gets and update the shipping tracker information.
 *
 * @package  		Core_CShippingTracker
 * @category  		Core
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
   * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */



class Core_CShippingTracker
{
	
	/**
	 * Function displays the shipping tracker information from the database. 
	 * 
	 * 
	 * @return string
	 */
	
    function displayShippingTrackerSetting()
	{


	include_once("classes/Display/DShippingTracker.php");
		
		if(count($Err->values)==0)
		{	
			$sql = "SELECT * FROM shipments_master_table";
			$obj = new Bin_Query();
			if($obj->executeQuery($sql))
				$output = Display_ShippingTracker::displayShippingTrackerSetting($obj->records);
			else
				$output = "<tr><td colspan=4 align=center>No records Found</td></tr>";			
		}
		else 
		{	
			$output = Display_ShippingTracker::displayShippingTrackerSetting($Err);
		}
		
		return $output;
	}
	
	/**
	 * Function updates the shipping tracker information into the database. 
	 * 
	 * 
	 * @return string
	 */
	 
   	function updateShippingTrackerSetting()
	{
	
		$cnt=count($_POST['ship_id']);
		for($i=0;$i<$cnt;$i++)
		{
	
			$shippingid=$_POST['ship_id'][$i];			
			$shipment_user_id =$_POST['shipment_user_id'][$i];
			$shipment_password =$_POST['shipment_password'][$i];
			$shipment_accesskey=$_POST['shipment_accesskey'][$i];
			$sql = "UPDATE shipments_master_table SET status=0 where shipment_id=".$shippingid."";	
			$obj1=new Bin_Query();
			$obj1->updateQuery($sql);	
			if($shippingid!='')
			{
		
				$sql = "UPDATE shipments_master_table  SET
				shipment_user_id='".$shipment_user_id."',
				shipment_password='".$shipment_password."',
				shipment_accesskey ='".$shipment_accesskey."'
				where shipment_id=".$shippingid."";
				$obj1=new Bin_Query();
				if($obj1->updateQuery($sql))
				{
			
					$_SESSION['shipmentMsg'] = '<div class="alert alert-success">
					<button type="button" class="close" data-dismiss="alert">×</button> Shipment Settings settings has been updated successfully </div>';
					
					
				}	
			}
			

		}
	
		$shpistat_cnt=count($_POST['shippingstatus']);
		for($j=0;$j<$shpistat_cnt;$j++)
		{
			$shippingstatus=$_POST['shippingstatus'][$j];			
			$sql = "UPDATE shipments_master_table SET status=1 where shipment_id=".$shippingstatus."";				
			$obj1=new Bin_Query();
			$obj1->updateQuery($sql);
		}
	
	
		header("Location:?do=showshipmenttracker");
	}
 	

}
?>