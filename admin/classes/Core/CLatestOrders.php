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
 * This class contains functions to get the latest orders and latest customers from the database.
 *
 * @package  		Core_CLatestOrders
 * @category  		Core
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
   * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */

class Core_CLatestOrders
{
 	 /**
	 * Function gets the latest order details from the database 
	 * 
	 * 
	 * @return string
	 */
	 
	 function dispLatestOrders()
	{
	    $sql='select a.orders_id,b.user_display_name,a.date_purchased,c.orders_status_name,a.order_total from orders_table a inner join users_table b on a.customers_id=b.user_id inner join orders_status_table c on c.orders_status_id=a.orders_status order by date_purchased  limit 0,10';
		$obj=new Bin_Query();
		$obj->executeQuery($sql);
		return Display_DLatestOrders::dispLatestOrders($obj->records);
	}
	
	 /**
	 * Function gets the latest customer details from the database 
	 * 
	 * 
	 * @return string
	 */
	
	function dispLatestCustomer()
	{
	 	$sql='select a.user_display_name,a.user_email,a.user_doj,c.orders_status_name,b.order_total from users_table a left outer join orders_table b on b.customers_id=a.user_id left outer join orders_status_table c on b.orders_status=c.orders_status_id  order by a.user_id desc limit 0,10';

	    $obj=new Bin_Query();
		$obj->executeQuery($sql);
		return Display_DLatestOrders::dispLatestCustomer($obj->records);
	}
	
}
?>