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
		include_once("classes/Display/DShippingTracker.php");
		
		$ship_idarr=$_POST['shippingid'];
		$ship_valarr=$_POST['shippingstatus'];
		
			
		$arrdiff=array_diff($ship_idarr,$ship_valarr);
				
		if($_POST['button']=='Update')
	 	{
			for($i=0;$i<count($ship_valarr);$i++)
			{
				$sql = "UPDATE shipments_master_table SET status=1 where shipment_id=".$ship_valarr[$i]."";		
				
				$obj1=new Bin_Query();
				$obj1->updateQuery($sql);		
			}
			foreach($arrdiff as $arrdf)
			{
				$sql = "UPDATE shipments_master_table SET status=0 where shipment_id=".$arrdf."";		
				
				$obj1=new Bin_Query();
				$obj1->updateQuery($sql);	
			} 
		}
	}
 	

}
?>