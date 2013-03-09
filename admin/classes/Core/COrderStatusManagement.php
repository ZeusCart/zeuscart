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
 * COrderStatusManagement
 *
 * This class contains functions to gets the order status from the database.
 *
 * @package		Core_COrderStatusManagement
 * @category	Core
 * @author		ZeusCart Team
 * @link		http://www.zeuscart.com
 * @version 	2.3
 */

// ------------------------------------------------------------------------


 class Core_COrderStatusManagement
{
	
	/**
	 * Function gets the orders status from the database 
	 * 
	 * 
	 * @return string
	 */
	
 	 function displayOrderStatus()
	{
	    $sql='select * from orders_status_table';
		$obj=new Bin_Query();
		$obj->executeQuery($sql);
		return Display_DOrderStatusManagement::	displayOrderStatus($obj->records);	
	}
	
	/**
	 * Function updates the order status into the database
	 * 
	 * 
	 * @return string
	 */
	
	function updateOrderStatus()
	{
	    $name=  $_POST['orderstatus'];
	    $id=$_POST['id'];
		$sql="update orders_status_table set orders_status_name='".$name."' where orders_status_id=".$id;
	    $obj=new Bin_Query();
		$obj->updateQuery($sql); 
		$fin='One Record is Updated Successfully';
		return $fin;
	}
	
	/**
	 * Function gets the order status details from the database 
	 * 
	 * 
	 * @return string
	 */
	
	function editOrderStatus()
	{
	     $id=$_GET['id'];
	     $sql='select * from orders_status_table where orders_status_id='.$id;
	     $obj1=new Bin_Query();
		 $obj1->executeQuery($sql);
	     return Display_DOrderStatusManagement::editOrderStatus($obj1->records);
	}
	
	
}
?>