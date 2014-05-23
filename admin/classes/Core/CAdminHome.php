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
 * This class contains functions to get the data needed for the site statistics from various tables
 *
 * @package  		Core_CAdminHome
 * @category  		Core
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
   * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */



class Core_CAdminHome
{	
	/**
	 * Function gets the categories available from the categroy_table. 
	 * 
	 * 
	 * @return string
	 */
	function getCategory()
    {
		$sql = "SELECT count(category_name) as totalCat FROM category_table where category_parent_id=0";
		$obj = new Bin_Query();
		if($obj->executeQuery($sql))
		{		
		       $output=$obj->records[0]['totalCat'];
  			   return  $output;
		}
	 
    }
	
	/**
	 * Function gets the current month orders from orders_table.
	 * 
	 * 
	 * @return string
	 */
	
	function monthlyOrders()
	{
	    $sql="select count(*)as cnt from orders_table a where month(a.date_purchased)=MONTH(CURRENT_DATE)";
		$obj = new Bin_Query();
		if($obj->executeQuery($sql))
		{		
				$output=$obj->records[0]['cnt'];
				return  $output;
		}
	}
	
	/**
	 * Function gets the previous month orders from orders_table.
	 * 
	 * 
	 * @return string
	 */	
	
	
	function previousMonthOrders()
	{
	    $sql="select count(*)as cnt from orders_table a where month(a.date_purchased)=MONTH(CURRENT_DATE)-1";
		$obj = new Bin_Query();
		if($obj->executeQuery($sql))
		{		
		       $output=$obj->records[0]['cnt'];
				return  $output;
		}
	
	}
	
	/**
	 * Function gets the count of pending orders from orders_table.
	 * 
	 * 
	 * @return string
	 */		
	
	function pendingOrders()
	{
	    $sql="select count(*)as cnt from orders_table where orders_status=1";
		$obj = new Bin_Query();
		if($obj->executeQuery($sql))
		{		
		       $output=$obj->records[0]['cnt'];
				return  $output;
		}
	}
	
	/**
	 * Function gets the count of orders under processing from orders_table.
	 * 
	 * 
	 * @return string
	 */		
	
	function processingOrders()
	{
	   $sql="select count(*)as cnt from orders_table where orders_status=2";
		$obj = new Bin_Query();
		if($obj->executeQuery($sql))
		{		
		       $output=$obj->records[0]['cnt'];
				return  $output;
		}
	}
	
	/**
	 * Function gets the count of orders that are delivered  from orders_table.
	 * 
	 * 
	 * @return string
	 */		
	
	function deliveredOrders()
	{
	   $sql="select count(*)as cnt from orders_table where orders_status=3";
		$obj = new Bin_Query();
		if($obj->executeQuery($sql))
		{		
		       $output=$obj->records[0]['cnt'];
				return  $output;
		}
	}
	
	/**
	 * Function gets the count of total orders from orders_table.
	 * 
	 * 
	 * @return string
	 */			
	
	function totalOrders()
	{
	     $sql="select count(*) as cnt from orders_table";
		 $obj = new Bin_Query();
		if($obj->executeQuery($sql))
		{		
				$output=$obj->records[0]['cnt'];
				return  $output;
		}
	}
	
	/**
	 * Function gets the count of current month user strength from users_table.
	 * 
	 * 
	 * @return string
	 */		
	
	function currentMonthUser()
	{
	     $sql="select count(*)as cnt from users_table a where month(a.user_doj)=MONTH(a.user_doj)";
		 $obj = new Bin_Query();
		if($obj->executeQuery($sql))
		{		
			    $output=$obj->records[0]['cnt'];
				return  $output;
		}
	}
	
	/**
	 * Function gets the products under low stock from the product_invetory_table.
	 * 
	 * 
	 * @return string
	 */	
	 
	function lowStock()
	{
	   $sql="select count(*) as cnt from product_inventory_table where rol>=soh";
		 $obj = new Bin_Query();
		if($obj->executeQuery($sql))
		{		
			    $output=$obj->records[0]['cnt'];
				return  $output;
		} 
	}
	
	/**
	 * Function gets the previous month user strength from the users_table.
	 * 
	 * 
	 * @return string
	 */	
	
	
	function previousMonthUser()
	{
	     $sql="select count(*)as cnt from users_table a where month(a.user_doj)=MONTH(a.user_doj)-1";
		 $obj = new Bin_Query();
		if($obj->executeQuery($sql))
		{		
				$output=$obj->records[0]['cnt'];
				return  $output;
		}
	}
	
	/**
	 * Function gets the total users count from the users_table.
	 * 
	 * 
	 * @return string
	 */	
		
	function totalUsers()
	{
	   $sql="select count(*)as cnt from users_table ";
	   $obj = new Bin_Query();
		if($obj->executeQuery($sql))
		{		
				$output=$obj->records[0]['cnt'];
				return  $output;
		}
	}
	
	
	/**
	 * Function gets the current month income from multiple tables.
	 * 
	 * 
	 * @return string
	 */	
	
	
	function currentMonthIncome()
	{
//		$sql = "select sum(a.msrp-a.price) as monthlyincome from products_table a inner join order_products_table b on a.product_id=b.product_id inner join orders_table c on c.orders_id=b.order_id where month(c.date_purchased)=MONTH(CURRENT_DATE) ";
	/*	$sql="select sum(b.product_qty*b.product_unit_price) as monthlyincome from products_table a inner join order_products_table b on a.product_id=b.product_id inner join orders_table c on c.orders_id=b.order_id where month(c.date_purchased)=MONTH(CURRENT_DATE)";
			 $obj = new Bin_Query();			 
		if($obj->executeQuery($sql))
		{		
		       // echo'welcome';exit;
				$output=$obj->records[0]['monthlyincome'];
				return  $output;
		}*/
		$sql1="select a.order_total from orders_table a inner join users_table b on a.customers_id=b.user_id inner join orders_status_table c on a.orders_status=c.orders_status_id where month(a.date_purchased)=MONTH(CURRENT_DATE) order by a.date_purchased desc";
		//$sql1="select a.order_total from orders_table a inner join users_table b on a.customers_id=b.user_id inner join orders_status_table c on c.orders_status_id=a.orders_status inner join country_table d on d.cou_code=a.billing_country inner join country_table e on e.cou_code=a.shipping_country inner join paymentgateways_table f on f.gateway_id=a.payment_method left join shipments_master_table g on g.shipment_id=a.shipment_id_selected where month(a.date_purchased)=MONTH(CURRENT_DATE)";
		   $obj1=new Bin_Query();
		   $obj1->executeQuery($sql1);
		   $res1=$obj1->records;
		   $subtotal=array();
		   foreach($res1 as $row)
		   {
		      $subtotal[]=$row['order_total'];
		   }
			return number_format(array_sum($subtotal),2);
	}
	
	
	/**
	 * Function gets the previous month income from multiple tables.
	 * 
	 * 
	 * @return string
	 */	
	
	
	function previoustMonthIncome()
	{
		/*//$sql = "select sum(a.msrp-a.price) as monthlyincome from products_table a inner join order_products_table b on a.product_id=b.product_id inner join orders_table c on c.orders_id=b.order_id where month(c.date_purchased)=MONTH(CURRENT_DATE)-1 ";
		$sql="select sum(b.product_qty*b.product_unit_price) as monthlyincome from products_table a inner join order_products_table b on a.product_id=b.product_id inner join orders_table c on c.orders_id=b.order_id where month(c.date_purchased)=MONTH(CURRENT_DATE)-1";
			 $obj = new Bin_Query();
		if($obj->executeQuery($sql))
		{		
					$output=$obj->records[0]['monthlyincome'];
				return  $output;
		}*/
		$sql1="select a.order_total from orders_table a inner join users_table b on a.customers_id=b.user_id inner join orders_status_table c on a.orders_status=c.orders_status_id where month(a.date_purchased)=MONTH(CURRENT_DATE)-1 order by a.date_purchased desc";
		//$sql1="select a.order_total from orders_table a inner join users_table b on a.customers_id=b.user_id inner join orders_status_table c on c.orders_status_id=a.orders_status inner join country_table d on d.cou_code=a.billing_country inner join country_table e on e.cou_code=a.shipping_country inner join paymentgateways_table f on f.gateway_id=a.payment_method left join shipments_master_table g on g.shipment_id=a.shipment_id_selected where month(a.date_purchased)=MONTH(CURRENT_DATE)-1";
		   $obj1=new Bin_Query();
		   $obj1->executeQuery($sql1);
		   $res1=$obj1->records;
		   $subtotal=array();
		   foreach($res1 as $row)
		   {
		      $subtotal[]=$row['order_total'];
		   }
			return   number_format(array_sum($subtotal),2);
	}

	/**
	 * Function gets the total income from multiple tables.
	 * 
	 * 
	 * @return string
	 */		
	
	function totalIncome()
	{
		/*$sql = "select sum(b.product_qty*b.product_unit_price) as totalincome from products_table a inner join order_products_table b on a.product_id=b.product_id inner join orders_table c on c.orders_id=b.order_id ";
			 $obj = new Bin_Query();
		if($obj->executeQuery($sql))
		{		
				$output=$obj->records[0]['totalincome'];
				return  $output;
		}*/
		// $sql1="select a.order_total from orders_table a inner join users_table b on a.customers_id=b.user_id inner join orders_status_table c on a.orders_status=c.orders_status_id  order by a.date_purchased desc";
		$sql1="select a.order_total from orders_table a inner join users_table b on a.customers_id=b.user_id inner join orders_status_table c on c.orders_status_id=a.orders_status inner join country_table d on d.cou_code=a.billing_country inner join country_table e on e.cou_code=a.shipping_country inner join paymentgateways_table f on f.gateway_id=a.payment_method left join shipments_master_table g on g.shipment_id=a.shipment_id_selected";
		   $obj1=new Bin_Query();
		   $obj1->executeQuery($sql1);
		   $res1=$obj1->records;
		   $subtotal=array();
		   foreach($res1 as $row)
		   {
		      $subtotal[]=$row['order_total'];		   }
			return  number_format(array_sum($subtotal),2);
	}
	
	
	/**
	 * Function gets count of products enabled from the products_table.
	 * 
	 * 
	 * @return string
	 */		
	
	function enabledProducts()
	{
	   $sql="select count(*) as cnt from products_table where status=1";
	   			 $obj = new Bin_Query();
		if($obj->executeQuery($sql))
		{		
				$output=$obj->records[0]['cnt'];
				return  $output;
		}
	}
	
	/**
	 * Function gets count of products that are disabled from the products_table.
	 * 
	 * 
	 * @return string
	 */		
	
	function disabledProducts()
	{
	   $sql="select count(*) as cnt from products_table where status=0";
	   			 $obj = new Bin_Query();
		if($obj->executeQuery($sql))
		{		
				$output= $obj->records[0]['cnt'];
				return  $output;
		}
	}
	
	
	/**
	 * Function gets total products count from the products_table.
	 * 
	 * 
	 * @return string
	 */		
	
	function totalProducts()
	{
	   $sql="select count(*) as cnt from products_table ";
	   			 $obj = new Bin_Query();
		if($obj->executeQuery($sql))
		{		
				$output=$obj->records[0]['cnt'];
				return  $output;
		}
	}
	
	/**
	 * Function gets current month product quantity from multiple tables.
	 * 
	 * 
	 * @return string
	 */		
	
	function currentMonthProudctQuantity()
	{
	   $sql = "select sum(b.product_qty) as productquantity from products_table a inner join order_products_table b on a.product_id=b.product_id inner join orders_table c on c.orders_id=b.order_id where month(c.date_purchased)=MONTH(CURRENT_DATE) ";
			 $obj = new Bin_Query();
		if($obj->executeQuery($sql))
		{		
				$output=$obj->records[0]['productquantity'];
				return  $output;
		}
	}
	
	/**
	 * Function gets previous month product quantity from multiple tables.
	 * 
	 * 
	 * @return string
	 */		
	
	function previousMonthProudctQuantity()
	{
	   $sql = "select sum(b.product_qty) as productquantity from products_table a inner join order_products_table b on a.product_id=b.product_id inner join orders_table c on c.orders_id=b.order_id where month(c.date_purchased)=MONTH(CURRENT_DATE)-1 ";
			 $obj = new Bin_Query();
		if($obj->executeQuery($sql))
		{		
			$output=$obj->records[0]['productquantity'];
			return  $output;
		}
	}
	
	/**
	 * Function gets the total product quantity from multiple tables.
	 * 
	 * 
	 * @return string
	 */		
	
	function totalProudctQuantity()
	{
	   $sql = "select sum(b.product_qty) as productquantity from products_table a inner join order_products_table b on a.product_id=b.product_id inner join orders_table c on c.orders_id=b.order_id ";
			 $obj = new Bin_Query();
		if($obj->executeQuery($sql))
		{		
			$output=$obj->records[0]['productquantity'];
			return  $output;
		}
	}
	
	
	/**
	 * Function gets count of products available from products_table.
	 * 
	 * 
	 * @return string
	 */		
	
	function getProducts()
    {
        
		$sql = "SELECT count(product_id) as totalproducts FROM products_table ";
		$obj = new Bin_Query();
		if($obj->executeQuery($sql))
		{	
			//echo $obj->records[0]['totalproducts'];	
			if($obj->records[0]['totalproducts']==0)
			{
				return 0;
			}
			else
			{
				return $obj->records[0]['totalproducts'];
			}
		}
	 
    }
		
	/**
	 * Function gets count of customer details from the users_table.
	 * 
	 * 
	 * @return string
	 */		
	
	function getCustomers()
	{
		
		$sql = "SELECT count(user_id) as totalcustomers FROM users_table";
		$obj = new Bin_Query();
		if($obj->executeQuery($sql))
		{		
			return  $obj->records[0]['totalcustomers'];
		}	
	}
	
	/**
	 * Function gets order count from the orders_table.
	 * 
	 * 
	 * @return string
	 */		
	
	function getOrderCount()
	{
		$sql = "SELECT count(orders_id) as totalorders FROM orders_table where orders_status=1";
		$obj = new Bin_Query();

		if($obj->executeQuery($sql))
		{		
				//print_r($obj->totrows);
				if(((int)$obj->totrows)>0)
				{
					return $obj->records[0]['totalorders'];

				}
				else
				{
					return 0;
				}	
		}
		 
	}
	
	/**
	 * Function sets the admin and subadmin name in the session for displaying.
	 * 
	 * 
	 * @return string
	 */		
	
	function userName()
	{
		include_once('classes/Core/CAdminActivity.php');
		$user='';
		$id=0;
		$flag=1;
		if($_SESSION['adminId']!='')
		{
			 $user=$_SESSION['adminName'];
			 $id=$_SESSION['adminId'];
		}	 
		else if($_SESSION['subadminId']!='')
		{
 			 $user=$_SESSION['subadminName'];
			 $id=$_SESSION['subadminId'];
			 $flag=0;
		}	 
		
		Core_CAdminActivity::setReport($user,$id,$flag);

		return $user;
	}
	
	
	/**
	 * Function gets the latest customer details from users_table.
	 * 
	 * 
	 * @return string
	 */		
	
	function getLatestCustomers()
	{
		//include('classes/Display/DAdminHome.php');
		$sql = "SELECT * FROM users_table order by user_id desc limit 0,7";
		$obj = new Bin_Query();
		if($obj->executeQuery($sql))
		{		
			return  Display_DAdminHome::getLatestCustomers($obj->records);
		}	
	}
	
	/**
	 * Function gets the products in order table.
	 * 
	 * 
	 * @return string
	 */	
	
	function productsInOrderTable()
	{
	    $sql="select a.title,c.date_purchased,b.product_unit_price,b.product_qty,b.shipping_cost,((b.product_qty*b.product_unit_price)+b.shipping_cost)as subtotal  from products_table a inner join order_products_table b on a.product_id=b.product_id inner join orders_table c  order by c.date_purchased desc limit 0,10 ";
		$obj = new Bin_Query();
		if($obj->executeQuery($sql))
		{		
		   $sql1="select ((b.product_qty*b.product_unit_price)+b.shipping_cost)as subtotal  from products_table a inner join order_products_table b on a.product_id=b.product_id inner join orders_table c  order by c.date_purchased desc limit 0,10 ";
            $obj1=new Bin_Query();
			$obj1->executeQuery($sql1);
			$arr=$obj1->records;
			$arrval= array();

			$sumofval=0;
			foreach($arr as $r)
			{
			   $arrval[]=$r['subtotal'];
			}
		
			return  Display_DAdminHome::productsInOrderTable($obj->records,array_sum($arrval));
		}	
	}
	
	/**
	 * Function gets the latest orders from the orders table.
	 * 
	 * 
	 * @return string
	 */	
	
	
	function latestOrders()
	{
	    $sql="select a.orders_id,a.orders_status,b.user_display_name,c.orders_status_name,a.date_purchased,a.order_total from orders_table a inner join users_table b on a.customers_id=b.user_id inner join orders_status_table c on a.orders_status=c.orders_status_id order by a.date_purchased desc limit 0,6";
		$obj = new Bin_Query();
		if($obj->executeQuery($sql))
		{
		   $sql1="select a.order_total,a.orders_status from orders_table a inner join users_table b on a.customers_id=b.user_id inner join orders_status_table c on a.orders_status=c.orders_status_id order by a.date_purchased desc limit 0,6";
		   $obj1=new Bin_Query();
		   $obj1->executeQuery($sql1);
		   $res1=$obj1->records;
		   $subtotal=array();
		   foreach($res1 as $row)
		   {
		      $subtotal[]=$row['order_total'];
		   }
			return  Display_DAdminHome::latestOrders($obj->records,array_sum($subtotal));
		}
	}
	
	/**
	 * Function gets the new customer details from the orders_table.
	 * 
	 * 
	 * @return string
	 */			
	function newCustomers()
	{
	   $sql="select b.user_display_name,b.user_email,b.user_doj from orders_table a inner join users_table b on a.customers_id=b.user_id  order by b.user_doj desc limit 0,10";
	   $obj=new Bin_Query();
	   $obj->executeQuery($sql);
	   return  Display_DAdminHome::newCustomers($obj->records);
	}


	function getUserschart()
	{
		$sql = "SELECT day(last_day(NOW())) AS day_count";
		$obj = new Bin_Query();
		$obj->executeQuery($sql);
		$records=$obj->records;
		$daycount=$records[0]['day_count'];
		$regcount=0;
		

		$output='';

		for($i=1;$i<=$daycount;$i++){

			$date=date('Y-m-'.$i.'');
			
			$sql_query="SELECT COUNT(*) as reg FROM users_table WHERE  user_doj='".$date."'";
			$obj_query = new Bin_Query();
			$obj_query->executeQuery($sql_query);
			$records_query=$obj_query->records[0]['reg'];

			$output.='['.$i.','.$records_query.']';

			

			if($i!=$daycount){

				$output.=',';
			}


		}

		return $output;
		
	}

	function getSaleschart()
	{
		$sql = "SELECT count(*) AS sales_count,day(last_day(NOW())) AS day_count FROM orders_table  WHERE MONTH(`date_purchased`)=MONTH(NOW())";
		$obj = new Bin_Query();
		$obj->executeQuery($sql);
		$records=$obj->records;
		$daycount=$records[0]['day_count'];
		$salescount=$records[0]['sales_count'];

		$output='';

		for($i=1;$i<=$daycount;$i++){


			$output.='['.$i.','.$salescount.']';

			if($i!=$daycount){

				$output.=',';
			}


		}

		return $output;

		
	}


	function orderstatus($value)
	{
		$sql="SELECT * FROM `orders_status_table` WHERE `orders_status_id`='".$value."'";
		$query=new Bin_Query();
		$query->executeQuery($sql);
		$records=$query->records[0]['orders_status_name'];

		return $records;

	}


}
?>	