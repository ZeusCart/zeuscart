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
class Core_CUserOrder
{
	/**
	 * This function is used to get  the  user order listpage
	 *
	 * .
	 * 
	 * @return HTML data
	 */
	function showOrder()
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
		$id=$_SESSION['user_id'];
				
		$sqlselect = "SELECT a.customers_id,a.orders_id,date_format(a.date_purchased,'%e/%c/%Y') as pdate,b.orders_status_name,c.user_display_name,a.order_total as total,a.shipment_track_id,e.shipment_name FROM `orders_table` a inner join orders_status_table b on a.orders_status=b.orders_status_id inner join users_table c on a.customers_id=c.user_id inner join order_products_table d on a.orders_id=d.order_id left join shipments_master_table e on a.shipment_id_selected=e.shipment_id where a.customers_id=".$id." group by a.orders_id order by a.date_purchased desc";
		
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
		
		$sqlselect = "SELECT a.customers_id,a.orders_id,date_format(a.date_purchased,'%e/%c/%Y') as pdate,b.orders_status_name,c.user_display_name,a.order_total as total,a.shipment_track_id,e.shipment_id,e.shipment_name FROM `orders_table` a inner join orders_status_table b on a.orders_status=b.orders_status_id inner join users_table c on a.customers_id=c.user_id inner join order_products_table d on a.orders_id=d.order_id left join shipments_master_table e on a.shipment_id_selected=e.shipment_id where a.customers_id=".$id." group by a.orders_id order by a.date_purchased desc LIMIT $start,$end";		
		$obj = new Bin_Query();

		$obj->executeQuery($sqlselect);
    	return Display_DUserAccount::showMyOrder($obj->records,$this->data['paging'],$this->data['prev'],$this->data['next'],$start);
		
	}

	/**
	 * This function is used to get  the  user order details
	 *
	 * .
	 * 
	 * @return HTML data
	 */
	function showOrderDetails()
	{
		include('classes/Display/DUserAccount.php');
		$id=(int)$_GET['id'];
		$sqlselect = "SELECT a.*,date_format(a.date_purchased,'%e/%c/%Y') as purDate,date_format(a.orders_date_closed,'%e/%c/%Y') as closeDate,b.orders_status_name,c.*,d.title,e.gateway_name,e.merchant_id,f.cou_name as shipcountry,g.cou_name as billcountry FROM `orders_table` a,orders_status_table b,order_products_table c,products_table d,paymentgateways_table e,country_table f,country_table g WHERE a.shipping_country=f.cou_code and a.billing_country=g.cou_code and a.payment_method=e.gateway_id and a.orders_status=b.orders_status_id and a.orders_id=c.order_id and c.product_id=d.product_id and a.orders_id=".$id;		
		$obj = new Bin_Query();

		$obj->executeQuery($sqlselect);
    	return Display_DUserAccount::showOrderDetails($obj->records);

	}
}
?>
