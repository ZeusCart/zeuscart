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
 * User order  related  class
 *
 * @package   		Core_CUserOrder
 * @category    	Core
 * @author    		AJ Square Inc Dev Team
 * @link   		http://www.zeuscart.com
  * @copyright 	        Copyright (c) 2008 - 2013, AJ Square, Inc.
 * @version   		Version 4.0
 */
class Core_CUserOrder
{
	/**
	 * This function is used to get  the  user order listpage
	 *
	 * .
	 * 
	 * @return string
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
				
		$sqlselect = "SELECT a.customers_id,a.orders_id,date_format(a.date_purchased,'%e/%c/%Y') as pdate,b.orders_status_name,c.user_display_name,a.order_total as total,a.shipment_track_id,e.shipment_name,a.currency_id,f.id,f.currency_tocken FROM `orders_table` a inner join orders_status_table b on a.orders_status=b.orders_status_id inner join users_table c on a.customers_id=c.user_id inner join order_products_table d on a.orders_id=d.order_id left join shipments_master_table e on a.shipment_id_selected=e.shipment_id left join currency_master_table f on f.id=a.currency_id where a.customers_id=".$id." group by a.orders_id order by a.date_purchased desc";
		
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
		
		$sqlselect = "SELECT a.customers_id,a.orders_status,a.orders_id,date_format(a.date_purchased,'%e/%c/%Y') as pdate,b.orders_status_name,c.user_display_name,a.order_total as total,a.currency_id,f.id,f.currency_tocken,a.shipment_track_id,e.shipment_id,e.shipment_name FROM `orders_table` a inner join orders_status_table b on a.orders_status=b.orders_status_id inner join users_table c on a.customers_id=c.user_id inner join order_products_table d on a.orders_id=d.order_id left join shipments_master_table e on a.shipment_id_selected=e.shipment_id left join currency_master_table f on f.id=a.currency_id where a.customers_id=".$id." group by a.orders_id order by a.date_purchased desc LIMIT $start,$end";		
		$obj = new Bin_Query();

		$obj->executeQuery($sqlselect);
    	return Display_DUserAccount::showMyOrder($obj->records,$this->data['paging'],$this->data['prev'],$this->data['next'],$start);
		
	}

	/**
	 * This function is used to get  the  user order details
	 *
	 * .
	 * 
	 * @return string
	 */
	function showOrderDetails()
	{
		include('classes/Display/DUserAccount.php');
		$id=(int)$_GET['id'];
		$sqlselect = "SELECT a.*,date_format(a.date_purchased,'%e/%c/%Y') as purDate,date_format(a.orders_date_closed,'%e/%c/%Y') as closeDate,b.orders_status_name,c.*,d.title,e.gateway_name,e.merchant_id, q.id,q.currency_tocken,f.cou_name as shipcountry,g.cou_name as billcountry ,s.shipment_name,s.shipment_id FROM `orders_table` a,orders_status_table b,order_products_table c,products_table d,paymentgateways_table e,country_table f,country_table g,shipments_master_table s,currency_master_table q  WHERE a.shipping_country=f.cou_code and a.billing_country=g.cou_code and a.payment_method=e.gateway_id and a.orders_status=b.orders_status_id and a.orders_id=c.order_id and c.product_id=d.product_id and s.shipment_id =a.shipment_id_selected and  q.id=a.currency_id and   a.orders_id=".$id; 	
		$obj = new Bin_Query();

		$obj->executeQuery($sqlselect);
    		return Display_DUserAccount::showOrderDetails($obj->records);

	}
	/**
	 * This function is used to get  the   order details for print
	 *
	 * .
	 * 
	 * @return string
	 */
	function printOrderDetail()
	{
		include('classes/Display/DUserAccount.php');
		$id=(int)$_GET['id'];
		$sqlselect = "SELECT a.*,date_format(a.date_purchased,'%e/%c/%Y') as purDate,date_format(a.orders_date_closed,'%e/%c/%Y') as closeDate,b.orders_status_name,c.*,d.title,e.gateway_name,e.merchant_id, q.id,q.currency_tocken,f.cou_name as shipcountry,g.cou_name as billcountry ,s.shipment_name,s.shipment_id FROM `orders_table` a,orders_status_table b,order_products_table c,products_table d,paymentgateways_table e,country_table f,country_table g,shipments_master_table s,currency_master_table q  WHERE a.shipping_country=f.cou_code and a.billing_country=g.cou_code and a.payment_method=e.gateway_id and a.orders_status=b.orders_status_id and a.orders_id=c.order_id and c.product_id=d.product_id and s.shipment_id =a.shipment_id_selected and  q.id=a.currency_id and   a.orders_id=".$id;
		$obj = new Bin_Query();

		$obj->executeQuery($sqlselect);
    		return Display_DUserAccount::printOrderDetail($obj->records);
	}
	/**
	 * This function is used to get  the  digital product list for my downloads
	 *
	 * .
	 * 
	 * @return string
	 */
	function showDigitalProduct()
	{
		include('classes/Display/DUserAccount.php');
		if(isset($_GET['totrec'])&&$_GET['totrec']>0)
			$pagesize=$_GET['totrec'];
		else
			$pagesize=10;
		//$pagesize=10;
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
		//$id=51;
		$sqlselect="SELECT a.orders_id, b.product_id, c.title,date_format(a.date_purchased,'%e/%c/%Y') as pdate,date_format(date_add(a.date_purchased,INTERVAL 7 DAY),'%e/%c/%Y') as expdate
		FROM orders_table a
		INNER JOIN order_products_table b ON a.orders_id = b.order_id
		INNER JOIN products_table c ON c.product_id = b.product_id
		AND c.digital =1
		WHERE a.customers_id =".$id;
		
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
			
		$sqlselect="SELECT a.orders_id, b.product_id, c.title,date_format(a.date_purchased,'%e/%c/%Y') as pdate,date_format(date_add(a.date_purchased,INTERVAL 7 DAY),'%e/%c/%Y') as expdate
		FROM orders_table a
		INNER JOIN order_products_table b ON a.orders_id = b.order_id
		INNER JOIN products_table c ON c.product_id = b.product_id
		AND c.digital =1
		WHERE a.customers_id =".$id." LIMIT $start,$end";		
		$obj = new Bin_Query();

		$obj->executeQuery($sqlselect);
		return Display_DUserAccount::showDigitalProduct($obj->records,$this->data['paging'],$this->data['prev'],$this->data['next'],$start);
		
	}
	/**
	 * This function is used to download  the  digital product  
	 *
	 * .
	 * 
	 * @return string
	 */
	function CheckDigitalProduct()
	{
		$orderid=(int)$_GET['rid'];
		$productid=(int)$_GET['pid'];
		$userid=$_SESSION['user_id'];
		$sql="select * from orders_table where orders_id=".$orderid." and date_add(date_purchased,INTERVAL 7 DAY)>=curdate() and customers_id=".$userid;
		$obj=new Bin_Query();
		if($obj->executeQuery($sql))
		{
			$sql1="select * from order_products_table where order_id=".$orderid." and product_id=".$productid;
			if($obj->executeQuery($sql1))
			{
				$sql2="select digital_product_path from products_table where digital=1 and product_id=".$productid;
				$obj->executeQuery($sql2);
				$downurl="Location:admin/".$obj->records[0]['digital_product_path'];
				header($downurl);
				exit();
			}
			else
			{

				$_SESSION['errmsg']='<div class="alert alert-info">
				<button data-dismiss="alert" class="close" type="button">×</button>
				<strong>'.Core_CLanguage::_(YOU_CANNOT_DOWNLOAD_THIS_PRODUCT).'</strong> 
				</div>';
				header('Location:?do=digitdown');
				exit();
			}
		}
		else
		{
			$_SESSION['errmsg']='<div class="alert alert-info">
				<button data-dismiss="alert" class="close" type="button">×</button>
				<strong>'.Core_CLanguage::_(YOU_CANNOT_DOWNLOAD_THIS_PRODUCT).'</strong> 
				</div>';
			header('Location:?do=digitdown');
			exit();
		}
	
	}
}
?>
