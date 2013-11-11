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
 * User account dashboard related  class
 *
 * @package   		Core_CUserDashboard
 * @category    	Core
 * @author    		AJ Square Inc Dev Team
 * @link   		http://www.zeuscart.com
  * @copyright 	        Copyright (c) 2008 - 2013, AJ Square, Inc.
 * @version   		Version 4.0
 */
class Core_CUserDashboard
{

	/**
	 * This function is used to get  the  account dashboard information 
	 *
	 * .
	 * 
	 * @return string
	 */
	function showDashboard()
	{
		include('classes/Display/DUserAccount.php');
		
		
		$pagesize=10;
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
		
		$sqlselect = "SELECT a.customers_id,a.orders_id,date_format(a.date_purchased,'%e/%c/%Y') as pdate,b.orders_status_name,c.user_display_name,a.order_total as total,a.currency_id FROM `orders_table` a,orders_status_table b,users_table c,order_products_table d where a.orders_status=b.orders_status_id and a.customers_id=c.user_id and a.orders_id=d.order_id and a.customers_id=".$_SESSION['user_id']." group by a.orders_id order by a.date_purchased desc";
		
		$query = new Bin_Query();
		if($query->executeQuery($sqlselect))
		{	
			$total = ceil($query->totrows/ $pagesize);
			include('classes/Lib/Paging.php');
			$tmp = new Lib_Paging('classic',array('totalpages'=>$total, 'length'=>10),'pagination');
			$this->data['paging'] = $tmp->output;
			$this->data['prev'] =$tmp->prev;
			$this->data['next'] = $tmp->next;	
		}
		
		$sqlselect = "SELECT a.customers_id,a.orders_id,date_format(a.date_purchased,'%e/%c/%Y') as pdate,b.orders_status_name,c.user_display_name,a.order_total as total,a.currency_id,e.id,e.currency_tocken  FROM `orders_table` a,orders_status_table b,users_table c,order_products_table d,currency_master_table e where a.orders_status=b.orders_status_id and a.customers_id=c.user_id and a.orders_id=d.order_id and a.customers_id=".$_SESSION['user_id']." and e.id=a.currency_id group by a.orders_id order by a.date_purchased desc LIMIT $start,$end";		
		
		$sqlUser='select user_id,concat(user_fname," ",user_lname) as name,user_email from users_table where user_id='.$_SESSION['user_id'];

		$sqlNews="SELECT user_id,b.status FROM `users_table` a,newsletter_subscription_table b where a.user_email=b.email and a.user_status=1 and a.user_id=".$_SESSION['user_id'];

		$obj = new Bin_Query();
		$objuser=new Bin_Query();
		$objNews=new Bin_Query();
		$obj->executeQuery($sqlselect);
 	   	$objuser->executeQuery($sqlUser);
		$objNews->executeQuery($sqlNews);
		return Display_DUserAccount::showDashboard($obj->records,$objuser->records,$objNews->records,$this->data['paging'],$this->data['prev'],$this->data['next'],$start);
			
		
	}


}
?>
