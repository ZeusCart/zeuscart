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

	function showCustomer($Err)
	{
		$sqlUser="select * from users_table where user_status=1 order by user_display_name";
		$queryUser = new Bin_Query();
		$queryUser->executeQuery($sqlUser);

		return  Display_DUserOrder::showCustomer($queryUser->records,$Err);
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
		$sqlCat="SELECT * FROM category_table where category_status=1 AND category_parent_id=0 AND  category_id  NOT IN (select category_id from category_table where category_name='Gift Voucher') "; 
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
		
		 $sqlCat="select * from category_table where category_status=1 and category_parent_id='".$catId."' and sub_category_parent_id='0' 	order by category_name";
		$queryCat = new Bin_Query();
		$queryCat->executeQuery($sqlCat);

		return  Display_DUserOrder::showSubCategory($queryCat->records);
	}
	/**
	 * Function gets the sub categories from the database 
	 * 
	 * 
	 * @return string
	 */
	
	function showSubUnderCat($id='-1')
	{

		$catId=($id!='-1')?$id:-1;
			
		
		if(isset($_POST['selSubUnderCategory']) && $_POST['selSubUnderCategory']!='')
		{	

			$catId=$_POST['selSubUnderCategory'];
			$sqlCat="select * from category_table where category_status=1 and category_id='".$catId."' order by category_name";

		}
		else
		{		
			 $sqlCat="select * from category_table where category_status=1 and sub_category_parent_id='".$catId."' and category_parent_id='".$_GET['catid']."' order by category_name";

		}
	
		$queryCat = new Bin_Query();
		$queryCat->executeQuery($sqlCat);

		return  Display_DUserOrder::showSubUnderCat($queryCat->records);
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
			
			if(isset($_POST['selProduct']) && $_POST['selProduct']!='')
			{
			$sqlCat="select * from products_table where status=1 and product_id='".$_POST['selProduct']."' ";
			}
			else
			{
				

				$category.=self:: getSubFamilies(0,$catId);
					 
				$category_id=$category."FIND_IN_SET ('".$catId."',category_id)";

				
				$sqlCat="select * from products_table where ".$category_id."  AND status=1  order by title"; 
			}
		$queryCat = new Bin_Query();
		$queryCat->executeQuery($sqlCat);

		return  Display_DUserOrder::showProducts($queryCat->records);
	}
	
	function getSubFamilies($level,$id) {

		$level++;
		$sqlSubFamilies = "SELECT * from category_table WHERE  category_parent_id = ".$id."";
		$resultSubFamilies = mysql_query($sqlSubFamilies);
		if (mysql_num_rows($resultSubFamilies) > 0) {
		
			while($rowSubFamilies = mysql_fetch_assoc($resultSubFamilies)) {

				
				$output.="FIND_IN_SET ('".$rowSubFamilies['category_id']."',category_id) OR ";
				$output.=self:: getSubFamilies($level, $rowSubFamilies['category_id']);
				
			}
		
		}
		
		return $output;
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

		if(isset($_POST['add']) && $_POST['add']=='ADD')
		{

			if($_POST['selCategory'] == '' || empty($_POST['selCategory']) || !is_int((int)$_POST['selCategory']) && $_POST['selProduct'] =='' && $_POST['selCategory'] == '')
			{

				$output = "<div class='alert alert-error'>
				<button data-dismiss='alert' class='close' type='button'>×</button>
				Please Select An Valid  Category
				</div>";
	
				return $output;	
			}		
// 			elseif($_POST['selSubCategory'] == '' || empty($_POST['selSubCategory']) || !is_int((int)$_POST['selSubCategory']))
// 			{
// 				$output = "<div class='error_msgbox'>Please Select An Valid Sub Category</div>";
// 		
// 				return $output;								
// 			}
// 			elseif($_POST['selSubUnderCategory'] == '' || empty($_POST['selSubUnderCategory']) || !is_int((int)$_POST['selSubUnderCategory']))
// 			{
// 				$output ="<div class='error_msgbox'>Please Select An Valid Sub Under Sub Category</div>";
// 
//  	
// 				return $output;				
// 			}
			elseif(trim($_POST['selProduct'])== '' || empty($_POST['selProduct']) || !is_int((int)$_POST['selProduct']) && $_POST['selQty']== '' && $_POST['selCategory']!= '' )
			{
				$output ="<div class='alert alert-error'>
				<button data-dismiss='alert' class='close' type='button'>×</button>
				Please Select An Valid Product
				</div>";

					
 	
				return $output;				
			}
			elseif($_POST['selQty'] == '' || empty($_POST['selQty']) || !is_int((int)$_POST['selQty']) || $_POST['selQty']==0 && $_POST['selProduct'] !='' && $_POST['selCategory'] != '')
			{
				$output ="<div class='alert alert-error'>
				<button data-dismiss='alert' class='close' type='button'>×</button>
				Please Select An Valid Quantity
				</div>";

				return $output;
			}

		}



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
					$_SESSION['ProductDetails'][$i]['qty']=$_POST['selQty']+$_SESSION['ProductDetails'][$i]['qty'];
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
	
	
	function listOrder($Err)
	{
		/*$sql="select * from admin_user_order where user_id='".$id."'";
		$query = new Bin_Query();
		$query->executeQuery($sql);*/
		return Display_DUserOrder::listOrder($_SESSION['ProductDetails'],$Err);
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
	
	
	function showShippingDetails($Err)
	{

		$sqlCat="select * from country_table order by cou_name";
		$queryCat = new Bin_Query();
		$queryCat->executeQuery($sqlCat);

		return  Display_DUserOrder::showShippingDetails($queryCat->records,$Err);
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
				order_tax, ipn_id, ip_address,shipment_id_selected)
				values
				('".$customers_id."','".$shipping_name."','".$shipping_company."','".$shipping_street_address."','".$shipping_suburb."','".$shipping_city."','".$shipping_postcode."','".$shipping_state."','".$shipping_country."','".$billing_name."','".$billing_company."','".$billing_street_address."','".$billing_suburb."','".$billing_city."','".$billing_postcode."','".$billing_state."','".$billing_country."','".$payment_method."','".$shipping_method."','".$coupon_code."','".$date_purchased."','".$orders_date_closed."','".$orders_status."','".$order_total."','".$order_tax."','".$paypal_ipn_id."','".$ip_address."','1')";
				$obj=new Bin_Query();
				if($obj->updateQuery($sql))
				{

						if($billing_name!='' && $billing_street_address && $billing_city && $billing_state && $billing_postcode)
						{

							if($_POST['muladdbill']!='0')
							{
								$sql="UPDATE  addressbook_table SET  contact_name='".$billing_name."' ,company='".$billing_company."',address='".$billing_street_address."',city='".$billing_city."',suburb='".$billing_suburb."',state='".$billing_state."',country='".$billing_country."',zip='".$billing_postcode."' WHERE id='".$_POST['muladdbill']."' AND user_id='".$customers_id."' ";
								$obj=new Bin_Query();
								$obj->updateQuery($sql);


								$sqlbill="UPDATE users_table SET billing_address_id='".$_POST['muladdbill']."' WHERE  user_id='".$customers_id."'";
								$objbill=new Bin_Query();
								$objbill->updateQuery($sqlbill);
					
							}
							else
							{
								 $sql="INSERT INTO addressbook_table(user_id,contact_name,company,address,city,suburb,state,country,zip)VALUES('".$customers_id."','".$billing_name."','".$billing_company."','".$billing_street_address."','".$billing_city."','".$billing_suburb."','".$billing_state."','".$billing_country."','".$billing_postcode."')";
								$obj=new Bin_Query();
								$obj->updateQuery($sql);
								$bill_address_id=mysql_insert_id();

								$sqlbill="UPDATE users_table SET billing_address_id='".$bill_address_id."' WHERE  user_id='".$customers_id."'";
								$objbill=new Bin_Query();
								$objbill->updateQuery($sqlbill);
							}
				
						}
						if($shipping_name!='' && $shipping_street_address && $shipping_city && $shipping_state && $shipping_postcode)
						{

							if($_POST['muladdship']!='0')
							{
								$sql="UPDATE  addressbook_table SET  contact_name='".$shipping_name."' ,company='".$shipping_company."',address='".$shipping_street_address."',city='".$shipping_city."',suburb='".$shipping_suburb."',state='".$shipping_state."',country='".$shipping_country."',zip='".$shipping_postcode."' WHERE id='".$_POST['muladdship']."' AND user_id='".$customers_id."' ";
								$obj=new Bin_Query();
								$obj->updateQuery($sql);

								$sqlship="UPDATE users_table SET shipping_address_id='".$_POST['muladdship']."' WHERE  user_id='".$customers_id."'";
								$objship=new Bin_Query();
								$objship->updateQuery($sqlship);
					
							}
							else
							{
								 $sql="INSERT INTO addressbook_table(user_id ,contact_name,company,address,city,suburb,state,country,zip)VALUES('".$customers_id."','".$shipping_name."','".$shipping_company."','".$shipping_street_address."','".$shipping_city."','".$shipping_suburb."','".$shipping_state."','".$shipping_country."','".$shipping_postcode."')";
								$obj=new Bin_Query();
								$obj->updateQuery($sql);

								$ship_address_id=mysql_insert_id();

								$sqlship="UPDATE users_table SET shipping_address_id ='".$ship_address_id."' WHERE  user_id='".$customers_id."'";
								$objship=new Bin_Query();
								$objship->updateQuery($sqlship);
							}
				
						}

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
			UNSET($_SESSION['errorvalues']);		
			return '<div class="alert alert-success">
			<button data-dismiss="alert" class="close" type="button">×</button> Order Created Successfully!</div>';			
		}
		else
		{
			
			return '<div class="alert alert-error">
			<button data-dismiss="alert" class="close" type="button">×</button> No Products available in the  cart. Order was not placed successfully.!</div>';	

		}			
	}

	
	/**
	 * Function gets the user multi  address for billing  from the database 
	 * 
	 * 
	 * @return string
	 */
	function showUserMultiBillAddress()
	{
		
	
		$userid=$_GET['id'];
		if($userid!='')
		{
			$sqlUserDetails="select * FROM addressbook_table where user_id='".$userid."'"; 
			$queryUserDetails = new Bin_Query();
			$queryUserDetails->executeQuery($sqlUserDetails);
			$records=$queryUserDetails->records;	
			
	
			$output.='<select class="span6" name="muladdbill" id="muladdbill" onchange="getuseraddressdetails(0);">
			<option value="0">Select Street, City</option>';
			for($i=0;$i<count($records);$i++)
			{
				if($records[$i]['id']==$_POST['muladd'] || $_SESSION['errorvalues']['muladd']==$records[$i]['id'])
				{
					$selected='selected';
				}
				$output.='<option value="'.intval($records[$i]['id']).'" '.$selected.'>'.ucfirst(stripslashes($records[$i]['address'])).','.ucfirst(stripslashes($records[$i]['city'])).'</option>';
			}
			$output.='</select>';	

		}
		else
		{

			$output.='<select class="sbox1" name="muladdbill" id="muladdbill" onchange="getuseraddressdetails(0);">
			<option value="0">Select Street, City</option>';
			$output.='</select>';	
		}	

			
			return  $output;

	}	
	
	/**
	 * Function gets the user multi  address  for shipping from the database 
	 * 
	 * 
	 * @return string
	 */
	function showUserMultiShipAddress()
	{
		
		$userid=$_GET['id'];
		if($userid!='')
		{
		
			$sqlUserDetails="select * FROM addressbook_table where user_id='".$userid."'"; 
			$queryUserDetails = new Bin_Query();
			$queryUserDetails->executeQuery($sqlUserDetails);
			$records=$queryUserDetails->records;	
			
	
			$output.='<select class="span6" name="muladdship" id="muladdship" onchange="getuseraddressdetails(1);">
				<option value="0">Select Street, City</option>';
			for($i=0;$i<count($records);$i++)
			{
				if($records[$i]['id']==$_POST['muladd'] || $_SESSION['errorvalues']['muladd']==$records[$i]['id'])
				{
					$selected='selected';
				}
				$output.='<option value="'.intval($records[$i]['id']).'" '.$selected.'>'.ucfirst(stripslashes($records[$i]['address'])).','.ucfirst(stripslashes($records[$i]['city'])).'</option>';
			}
			$output.='</select>';
		}
		else
		{
			echo $output.='<select class="sbox1" name="muladdship" id="muladdship" onchange="getuseraddressdetails(1);">
			<option value="0">Select Street, City</option>';
			echo $output.='</select>';
		}		
		
			
			return  $output;

	}	
	/**
	 * Function gets the user billing address and shipping address from the database 
	 * 
	 * 
	 * @return string
	 */
	function showUserAddressDetails()
	{
		
		$userid=mysql_escape_string($_GET['userid']);
		$addressid=mysql_escape_string($_GET['addressid']);		
		$sqlUserDetails="select contact_name,company,address,city,suburb,state,country,zip FROM addressbook_table where user_id='".$userid."' and id='".$addressid."'";
		$queryUserDetails = new Bin_Query();
		$queryUserDetails->executeQuery($sqlUserDetails);


		$userdetails='';
		foreach($queryUserDetails->records[0] as $key=>$item)
		{
			$userdetails.=$item.'|';
		}

		return  $userdetails;
	}
}
?>