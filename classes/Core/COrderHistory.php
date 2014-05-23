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
 * Order history related  class
 *
 * @package   		Core_COrderHistory
 * @category    	Core
 * @author    		AJ Square Inc Dev Team
 * @link   		http://www.zeuscart.com
  * @copyright 	        Copyright (c) 2008 - 2013, AJ Square, Inc.
 * @version   		Version 4.0
 */
class Core_COrderHistory
{

	
	/**
	 * This function is used to show  the order history
	 *
	 * .
	 * 
	 * @return string
	 */
 	function dispOrderHistory()
	{
	    $userid=$_SESSION['user_id'];
	    $sql="select * from orders_table a inner join users_table b on a.customers_id=b.user_id where b.user_id=".$userid;
		$obj=new Bin_Query();
		$obj=executeQuery($sql);
		return Display_DOrderHistory::dispOrderHistory($obj->records);		
	}
}
?>