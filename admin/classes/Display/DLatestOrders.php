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
 * This class contains functions to list out the latest order details.
 *
 * @package  		Display_DLatestOrders
 * @category  		Display
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
   * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */


class Display_DLatestOrders
{
	/**
	 * Function returns a template to display the latest orders available. 
	 * @param array $result
	 * @return string
	 */

	function dispLatestOrders($result)
	{
	    if((count($result)>0))
		{
		     $output='<table cellpadding="4" cellspacing="0" border="0" width="100%"><th align="left">Order Id</th><th align="left">Customer</th><th align="left">Status</th><th align="left">Date Added</th><th align="left">Total</th>';
		    foreach($result as $row)
			{
				$id    =$row['orders_id'];
				$name  =$row['user_display_name'];
				$date  =$row['date_purchased'];
				$status=$row['orders_status_name'];
				$total =$row['order_total'];
				$output.='<tr><td>'.$id.'</td><td>'.$name.'</td><td>'.$date.'</td><td>'.$status.'</td><td>'.$total.'</td></tr>';
			}  
			$output.='<tr align="right"><td colspan="4"><a href="#">More>></a></td></tr>';
			$output.='<table>';
		}
		return $output;
	}

	/**
	 * Function returns a template to display the latest customer details available. 
	 * @param array $result
	 * @return string
	 */

	function dispLatestCustomer($result)
	{
	    if((count($result)>0))
		{
			 $output='<table cellpadding="4" cellspacing="0" border="0" width="100%"><th align="left">Customer Name</th><th align="left">E-Mail</th><th align="left">Join Date</th><th align="left">Order Amount</th>';
			foreach($result as $row)
			{
				$name  =$row['user_display_name'];
				$email =$row['user_email'];
				$doj   =$row['user_doj'];
				$total =$row['order_total'];
				$output.='<tr><td>'.$name.'</td><td>'.$email.'</td><td>'.$doj.'</td><td>'.$total.'</td></tr>';
			}
			$output.='<tr align="right"><td colspan="3"><a href="#">More>></a></td></tr>';
			$output.='<table>';
			echo $output;
			exit;
		}
		return $output;
	}
}
?>