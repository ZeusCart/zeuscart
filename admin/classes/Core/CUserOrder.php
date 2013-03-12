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
 * CUserOrder
 *
 * This class contains functions to gets and update the admin activity report.
 *
 * @package		Core_CUserOrder
 * @category	Core
 * @author		ZeusCart Team
 * @link		http://www.zeuscart.com
  * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */




class Core_CUserOrder 
{
	/**
	 * Stores the output
	 *
	 * @var array $output
	 */		
	var $output = array();	
	
	/**
	 * Stores the resultset
	 *
	 * @var array $arr
	 */	
	
	var $arr = array();	
	
	/**
	 * Function checks whether an error exists 
	 * @param array $Err
	 * 
	 * @return array
	 */
	
	function Ulogin($Err)
	{
		if(count($Err->values)==0)
		{
			$this->data = $Err->values;
			$this->data = $Err->messages;
		}
		else 
		{	
			$this->data = $Err->values;
			$this->errormessages = $Err->messages;
		}
	}
	
	/**
	 * Function gets the customer database from the database
	 * 
	 * 
	 * @return string
	 */

	function showCustomer()
	{
		$sqlUser="select * from users_table where user_status=1 order by user_display_name";
		$queryUser = new Bin_Query();
		$queryUser->executeQuery($sqlUser);

		return  Display_DUserOrder::showCustomer($queryUser->records);
	}
	
	/**
	 * Function gets the payment gateway details from the database
	 * 
	 * 
	 * @return string
	 */
	
	function showPayment()
	{
		$sqlUser="select * from paymentgateways_table where gateway_status=1 and (gateway_name='Pay in Store' or gateway_name='Cash on Delivery')";
		$queryUser = new Bin_Query();
		$queryUser->executeQuery($sqlUser);

		return  Display_DUserOrder::showPayment($queryUser->records);
	}
	
	/**
	 * Function gets the category details from the database
	 * 
	 * 
	 * @return string
	 */
	
	function showCategory()
	{
		$sqlCat="select * from category_table where category_status=1 and category_parent_id=0 order by category_name";
		$queryCat = new Bin_Query();
		$queryCat->executeQuery($sqlCat);

		return  Display_DUserOrder::showCategory($queryCat->records);
	}
	
	/**
	 * Function gets the sub categories from the database 
	 * @param mixed $id
	 * 
	 * @return string
	 */
	
	function showSubCategory($id='-1')
	{
		$catId=($id!='')?$id:-1;
		if($id==-1)	
			if(isset($_POST['selCategory']) && $_POST['selCategory']!='')
				$catId=$_POST['selCategory'];
		
		$sqlCat="select * from category_table where category_status=1 and category_parent_id='".$catId."' order by category_name";
		$queryCat = new Bin_Query();
		$queryCat->executeQuery($sqlCat);

		return  Display_DUserOrder::showSubCategory($queryCat->records);
	}
	
	/**
	 * Function gets the product details for the selected sub category 
	 * @param mixed $id
	 * 
	 * @return string
	 */
	
	function showProducts($id='-1')
	{
		$catId=($id!='')?$id:-1;
		if($id==-1)	
			if(isset($_POST['selSubCategory']) && $_POST['selSubCategory']!='')
				$catId=$_POST['selSubCategory'];

		$sqlCat="select * from products_table where status=1 and category_id='".$catId."' order by title";
		$queryCat = new Bin_Query();
		$queryCat->executeQuery($sqlCat);

		return  Display_DUserOrder::showProducts($queryCat->records);
	}
	
	
	/**
	 * Function gets the quantity details for the selected product  
	 * @param mixed $id
	 * 
	 * @return string
	 */
	
	function showQty($id='-1')
	{
		$catId=($id!='')?$id:-1;
		if($id==-1)	
			if(isset($_POST['selProduct']) && $_POST['selProduct']!='')
				$catId=$_POST['selProduct'];

		$sqlCat="select a.*,b.soh from products_table a,product_inventory_table b where a.status=1 and a.product_id=b.product_id and a.product_id='".$catId."'";
		$queryCat = new Bin_Query();
		$queryCat->executeQuery($sqlCat);

		return  Display_DUserOrder::showQty($queryCat->records);
	}
	
	/**
	 * Function sets the product details in the session variable 
	 * 
	 * 
	 * @return array
	 */

	function addProduct()
	{
		if(!isset($_SESSION['ProductDetails']))
			$_SESSION['ProductDetails'] = array();
	
		$cnt=count($_SESSION['ProductDetails']);
		
		if(isset($_POST) && $_POST['selProduct']!='' && $_POST['hidProduct']!='' && $_POST['selQty']!='' && $_POST['hidPrice']!='' && $_POST['selQty']>0)
		{
			$flag=1;
			for($i=0;$i<$cnt;$i++)
			{
				if($_SESSION['ProductDetails'][$i]['product_id']==$_POST['selProduct'])
				{
					$flag=0;
				}	
			}	
			if($flag==1)
			{
				$_SESSION['ProductDetails'][$cnt]['product_id'] =$_POST['selProduct'];
				$_SESSION['ProductDetails'][$cnt]['product'] =$_POST['hidProduct'];					
				$_SESSION['ProductDetails'][$cnt]['qty'] =$_POST['selQty'];
				$_SESSION['ProductDetails'][$cnt]['price'] =$_POST['hidPrice'];		
				$_SESSION['ProductDetails'][$cnt]['shipCost'] =$_POST['hidShipCost'];		
			}	
		}	
		//unset($_SESSION['ProductDetails']);

	}
	
	/**
	 * Function gets the orders list from the database
	 * 
	 * 
	 * @return string
	 */
	
	
	function listOrder()
	{
		/*$sql="select * from admin_user_order where user_id='".$id."'";
		$query = new Bin_Query();
		$query->executeQuery($sql);*/
		return Display_DUserOrder::listOrder($_SESSION['ProductDetails']);
	}
	
	
	
	/**
	 * Function deletes a product from the array 
	 * 
	 * 
	 * @return array
	 */
	
	
	function delProduct()
	{
		$id=(int)$_GET['id'];
		$arr=$_SESSION['ProductDetails'];

		for($i=0,$k=0;$i<count($arr);$i++)
		{
			if($arr[$i]['product_id']!=$id)
			{
				$arr1[$k]=$arr[$i];
				$k++;
			}
		}
		$_SESSION['ProductDetails']=$arr1;		
	}
	
	
	/**
	 * Function gets the country list from the database
	 * 
	 * 
	 * @return string
	 */
	
	
	function showShippingDetails()
	{
		$sqlCat="select * from country_table order by cou_name";
		$queryCat = new Bin_Query();
		$queryCat->executeQuery($sqlCat);

		return  Display_DUserOrder::showShippingDetails($queryCat->records);
	}
	
	
	/**
	 * Function adds a order into the database
	 * 
	 * 
	 * @return string
	 */
	
	
	function createOrder()
	{
			$order_total=$_POST['hidOrderTotal'];
			$paypal_ipn_id=$_POST['PAYMENT_BATCH_NUM'];	
			$trans_date=date('Y-m-d H:i:s');	
			$date_purchased=$trans_date;
			
			$payment_method=$_POST['payOption'];
			$customers_id=$_POST['selCustomer'];

			$billing_name  =$_POST['txtname'];
			$billing_company  =$_POST['txtcompany'];
			$billing_street_address  =$_POST['txtstreet'];
			$billing_city  =$_POST['txtcity'];
			$billing_suburb  =$_POST['txtsuburb'];
			$billing_postcode  =$_POST['txtzipcode'];
			$billing_country  =$_POST['selbillcountry'];
			$billing_state  =$_POST['txtstate'];
			
			$shipping_name  =$_POST['txtsname'];
			$shipping_company =$_POST['txtscompany']; 
			$shipping_street_address =$_POST['txtsstreet'];
			$shipping_city  =$_POST['txtscity'];
			$shipping_suburb  =$_POST['txtssuburb'];
			$shipping_postcode  =$_POST['txtszipcode'];
			$shipping_country  =$_POST['selshipcountry'];
			$shipping_state =$_POST['txtsstate'];
			
			if((int)$customers_id!=0 && $customers_id!='' && count($_SESSION['ProductDetails'])>0)
			{
					$orders_status=1;
					$sql="insert into orders_table
					( customers_id, shipping_name, shipping_company, shipping_street_address, 
					shipping_suburb, shipping_city, shipping_postcode, shipping_state, shipping_country, 
					billing_name, billing_company, billing_street_address, billing_suburb, 
					billing_city, billing_postcode, billing_state, billing_country, payment_method, 
					shipping_method, coupon_code,  date_purchased, orders_date_closed, orders_status, order_total, 
					order_tax, ipn_id, ip_address)
					values
					('".$customers_id."','".$shipping_name."','".$shipping_company."','".$shipping_street_address."','".$shipping_suburb."','".$shipping_city."','".$shipping_postcode."','".$shipping_state."','".$shipping_country."','".$billing_name."','".$billing_company."','".$billing_street_address."','".$billing_suburb."','".$billing_city."','".$billing_postcode."','".$billing_state."','".$billing_country."','".$payment_method."','".$shipping_method."','".$coupon_code."','".$date_purchased."','".$orders_date_closed."','".$orders_status."','".$order_total."','".$order_tax."','".$paypal_ipn_id."','".$ip_address."')";
					$obj=new Bin_Query();
					if($obj->updateQuery($sql))
					{
							$orderid=$obj->insertid;
							
							$sql_insert_payment="INSERT INTO payment_transactions_table (payment_gateway_id ,paid_amount ,transaction_id ,transaction_date,order_id) VALUES ('".$payment_method."',".$order_total.",'".$paypal_ipn_id."','".$trans_date."',".$orderid.")";
							$obj_insert_payment=new Bin_Query();
							$obj_insert_payment->updateQuery($sql_insert_payment);
							
							$sql1="select max(orders_id) as maxid from orders_table";
							$obj1=new Bin_Query();
							$obj1->executeQuery($sql1);
							$rec=$obj1->records;
							$maxid=$rec[0]['maxid'];
							
						
							$res=$_SESSION['ProductDetails'];
							if(count($res)>0)
							{
								for($i=0;$i<count($res);$i++)
								{
									$row=$res[$i];
									$product_id=$row['product_id'];
									$product_qty=$row['qty'];
									$sql6="select * from product_inventory_table where product_id=".$product_id;
									$obj6=new Bin_Query();
									$obj6->executeQuery($sql6);
									$res6=$obj6->records;
									$soh=$res6[0]['soh'];
									if($soh>$product_qty)
									{
									   $mysoh=$soh-$product_qty;
									}
									else
									{
									  $product_qty=$soh;
									  $mysoh=$product_qty-$soh;									  
									}
									$sql5="update product_inventory_table set soh = '".$mysoh."' where product_id = ".$product_id;
									$obj5=new Bin_Query();
									$obj5->updateQuery($sql5);
  
									$product_unit_price=$row['price'];
									$shipping_cost=$row['shipCost'];
							 		$sql="insert into order_products_table (order_id, product_id, product_qty, product_unit_price,shipping_cost) values  ('".$maxid."','".$product_id."','".$product_qty."','".$product_unit_price."','".$shipping_cost."')"."\n";
									$obj=new Bin_Query();
									$obj->updateQuery($sql);
								}
							}				
					}	
					
				unset($_SESSION['ProductDetails']);		
				return "<div class='success_msgbox'>Order Created Successfully!</div>";			
			}			
	}
}
?>