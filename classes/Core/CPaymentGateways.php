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
 * Payment gateway related  class
 *
 * @package   		Core_CPaymentGateways
 * @category    	Core
 * @author    		AJ Square Inc Dev Team
 * @link   		http://www.zeuscart.com
  * @copyright 	        Copyright (c) 2008 - 2013, AJ Square, Inc.
 * @version   		Version 4.0
 */

class Core_CPaymentGateways 
{

		/**
		* This function is used to get  the  user insert the shipping address in session
		*
		* .
		* 
		* @return string
		*/
    		function insertShipping()
		{
		    	$orderdetails=array();		

			$orderdetails['txtname']=$_POST['txtname'];
			$orderdetails['txtcompany']=$_POST['txtcompany'];
			$orderdetails['txtstreet']=$_POST['txtstreet'];
			$orderdetails['txtcity']=$_POST['txtcity'];
			$orderdetails['txtsuburb']=$_POST['txtsuburb'];
			$orderdetails['txtzipcode']=$_POST['txtzipcode'];
			$orderdetails['txtcountry']=$_POST['selbillcountry'];
			$orderdetails['txtstate']=$_POST['txtstate'];
			$orderdetails['txtsname']=$_POST['txtsname'];
			$orderdetails['txtscompany']=$_POST['txtscompany'];
			$orderdetails['txtsstreet'] =$_POST['txtsstreet'];
			$orderdetails['txtscity']=$_POST['txtscity'];
			$orderdetails['txtssuburb']=$_POST['txtssuburb'];
			$orderdetails['txtszipcode']=$_POST['txtszipcode'];
			$orderdetails['txtscountry']=$_POST['selshipcountry'];
			$orderdetails['txtsstate'] =$_POST['txtsstate'];
			$_SESSION['orderdetails']=$orderdetails;		
		}
		/**
		* This function is used to get  the option payment mode
		*
		* .
		* 
		* @return string
		*/
		function optPaymentMode()
		{
		   $paymentgateway=$_POST['paymentBy'];
		  
		   if($paymentgateway=='paypal')
		   {
		       $obj=new Core_CPaymentGateways();
		       $res=$obj->getMerchantId($paymentgateway);
			   return Display_DPaymentGateways::paypal($res);	
		   }
		   elseif($paymentgateway=='strompay')
		   {
			    return Display_DPaymentGateways::stromPay();
		   }
		   elseif($paymentgateway=='egold')
		   {
			    return Display_DPaymentGateways::eGold();
		   }
		   elseif($paymentgateway=='intgold')
		   {
			     return Display_DPaymentGateways::intGold();
		   }
		    elseif($paymentgateway=='twocheckout')
		   {
			     return  Display_DPaymentGateways::twoCheckOut();
		   }
		    elseif($paymentgateway=='ebullion')
		   {
			    return Display_DPaymentGateways::eBullion();
		   }
		    elseif($paymentgateway=='securepay')
		   {
			    return Display_DPaymentGateways::securePay();		
		   }
		    elseif($paymentgateway=='bluepay')
		   {
			      return Display_DPaymentGateways::secureBluePay();		
		   }
		    elseif($paymentgateway=='google')
		   {
			    return Display_DPaymentGateways::googlePay();
		   }
		    elseif($paymentgateway=='moneybookers')
		   {
			   return Display_DPaymentGateways::moneyBookers();
		   }
		    elseif($paymentgateway=='epath')
		   {
			    return Display_DPaymentGateways::stromPay();
		   }
		   
		}
		/**
		* This function is used to view the success page after payment finished
		*
		* .
		* 
		* @return string
		*/
		function success()
		{
			if($_GET['pay_type']=='1')
				{
					$order_total=$_POST['mc_gross'];
					$ipn_id=$_POST['txn_id'];
					$orders_status=1;	
				}
				elseif($_GET['pay_type']=='2')
				{
					$order_total=number_format($_POST['ATIP_PAYMENT_AMOUNT'],2);
					$ipn_id=$_POST['ATIP_TRANSACTION_ID'];	
					$buyer_accountid=$_POST['ATIP_ACCOUNT'];
					$orders_status=1;
				}
				elseif($_GET['pay_type']=='3')
				{
					$order_total=number_format($_POST['PAYMENT_AMOUNT'],2);
					$ipn_id=$_POST['PAYMENT_BATCH_NUM'];	
					$orders_status=1;
				}
				elseif($_GET['pay_type']=='4')
				{
					$order_total=$_SESSION['checkout_amount'];
					$ipn_id=$_POST['PAYMENT_BATCH_NUM'];	
					$orders_status=1;
				}
				
				elseif($_GET['pay_type']=='5')
				{
					$order_total=$_SESSION['checkout_amount'];
					$ipn_id=$_POST['PAYMENT_BATCH_NUM'];	
					$orders_status=1;
				}
				elseif($_GET['pay_type']=='6')//2checkout
				{
					$order_total=$_SESSION['checkout_amount'];
					$ipn_id=$_POST['PAYMENT_BATCH_NUM'];	
					$orders_status=1;
				}
				elseif($_GET['pay_type']=='7')//worldpay
				{
					$order_total=$_SESSION['checkout_amount'];
					$ipn_id=$_POST['PAYMENT_BATCH_NUM'];	
					$orders_status=1;
				}
				
				elseif($_GET['pay_type']=='8')//Pay In Store
				{
					$order_total=$_SESSION['checkout_amount'];
					$ipn_id="Pay In Store";	
					$orders_status=4;
				}
				elseif($_GET['pay_type']=='9')//Cash On Delivery
				{
					$order_total=$_SESSION['checkout_amount'];
					$ipn_id="Cash On Delivery";	
					$orders_status=4;
				}
				elseif($_GET['pay_type']=='10')
				{
					$order_total=$_POST['paymentAmount'];					
					$ipn_id=$_POST['transactionID'];
					$orders_status=1;	
				}
				elseif($_GET['pay_type']=='11')
				{
					$order_total=number_format($_POST['AMOUNT'],2);					
					$ipn_id=$_POST['TRANSACTION_ID'];
					$orders_status=1;	
				}
				elseif($_GET['pay_type']=='12')
				{
					$total = ctype_digit($_GET['SubTotal'])?$_GET['SubTotal']:$_SESSION['checkout_amount'];			
					$order_total=$total;
					$ipn_id=$_GET['TransRefNumber'];
					$orders_status=1;	
				}
				elseif($_GET['pay_type']=='13')
				{
					$order_total=number_format($_POST['amount'],2);
					$ipn_id==$_POST['transaction_id'];
					$orders_status=1;		
					//$buyer_accountid=$_POST['payer_name'];
				}
				elseif($_GET['pay_type']=='14')
				{
					$order_total=$_SESSION['checkout_amount'];
					//$order_total=number_format($_POST['AMOUNT'],2);
  	    				$ipn_id=$_POST['TRANSACTION_ID'];
					$orders_status=1;		
				}
				elseif($_GET['pay_type']=='15')
				{
					if($_POST['status']=='APPROVED')
					{
					$order_total=number_format($_POST['chargetotal'],2);
  	    			$ipn_id=$_POST['OID'];
					$orders_status=1;	
					}
				}
				elseif($_GET['pay_type']=='16')
				{
					if($_POST['status']=='OK')
					{
					$order_total=number_format($_POST['recur_total'],2);
  	    				$ipn_id=$_POST['xid'];
					$orders_status=1;	
					}
				}
				elseif($_GET['pay_type']=='17')
				{
					if($_GET['result']=='APPROVED')
					{
					$total = ctype_digit($_GET['AMOUNT'])?$_GET['AMOUNT']:$_SESSION['checkout_amount'];	
					$order_total=number_format($total,2);
  	    				$ipn_id=$_GET['RRNO'];
					$orders_status=1;	
					}
				}
				elseif($_GET['pay_type']=='18')
				{
					if($_POST['result']=='1')
					{
					$total = ctype_digit($_GET['iamount'])?$_GET['iamount']:$_SESSION['checkout_amount'];	
					$order_total=number_format($total,2);
  	    				$ipn_id=$_GET['tid'];
					$orders_status=1;	
					}
				}
				
				$trans_date=date('Y-m-d H:i:s');	
				$date_purchased=$trans_date;
				$payment_method=$_GET['pay_type'];
		     
				
			$customers_id=$_SESSION['user_id'];
			$orderdetails=$_SESSION['orderdetails'];
			
			$billing_name  =$orderdetails['txtname'];
			$billing_company  =$orderdetails['txtcompany'];
			$billing_street_address  =$orderdetails['txtstreet'];
			$billing_city  =$orderdetails['txtcity'];
			$billing_suburb  =$orderdetails['txtsuburb'];
			$billing_postcode  =$orderdetails['txtzipcode'];
			$billing_country  =$orderdetails['txtcountry'];
			$billing_state  =$orderdetails['txtstate'];
			$shipping_name  =$orderdetails['txtsname'];
			$shipping_company =$orderdetails['txtscompany']; 
			$shipping_street_address =$orderdetails['txtsstreet'];
			$shipping_city  =$orderdetails['txtscity'];
			$billing_suburb  =$orderdetails['txtssuburb'];
			$shipping_postcode  =$orderdetails['txtszipcode'];
			$shipping_country  =$orderdetails['txtscountry'];
			$billing_state =$orderdetails['txtsstate'];
			$ip_address=$_SERVER['REMOTE_ADDR'];		
			$shipment_id_selected=$_SESSION['shipment_id_selected'];
			
			if((((int)$customers_id!=0) || ($customers_id!='')) && ($_SESSION['checkout_amount']!=''))
			{
					 $sql="insert into orders_table
					( customers_id, shipping_name, shipping_company, shipping_street_address, 
					shipping_suburb, shipping_city, shipping_postcode, shipping_state, shipping_country, 
					billing_name, billing_company, billing_street_address, billing_suburb, 
					billing_city, billing_postcode, billing_state, billing_country, payment_method, 
					shipping_method, coupon_code,  date_purchased, orders_date_closed, orders_status, order_total, 
					order_tax, ipn_id, ip_address,shipment_id_selected)
					values
					('".$customers_id."','".$shipping_name."','".$shipping_company."','".$shipping_street_address."','".$shipping_suburb."','".$shipping_city."','".$shipping_postcode."','".$shipping_state."','".$shipping_country."','".$billing_name."','".$billing_company."','".$billing_street_address."','".$billing_suburb."','".$billing_city."','".$billing_postcode."','".$billing_state."','".$billing_country."','".$payment_method."','".$shipping_method."','".$coupon_code."','".$date_purchased."','".$orders_date_closed."','".$orders_status."','".$order_total."','".$order_tax."','".$ipn_id."','".$ip_address."','".$shipment_id_selected."')";
									
					$obj=new Bin_Query();
					if($obj->updateQuery($sql))
					{
						
							$orderid=$obj->insertid;
							
	

							$sql_insert_payment="INSERT INTO payment_transactions_table (payment_gateway_id ,paid_amount ,transaction_id ,transaction_date,order_id) VALUES (".$payment_method.",".$order_total.",'".$ipn_id."','".$trans_date."',".$orderid.")"; 
							$obj_insert_payment=new Bin_Query();
							$obj_insert_payment->updateQuery($sql_insert_payment);
							
							$sql1="select max(orders_id) as maxid from orders_table";
							$obj1=new Bin_Query();
							$obj1->executeQuery($sql1);
							$rec=$obj1->records;
							$maxid=$rec[0]['maxid'];
							
							$sql4="select distinct a.cart_id from shopping_cart_products_table a inner join shopping_cart_table b on a.cart_id=b.cart_id where b.user_id=".$_SESSION['user_id'];
							$obj4=new Bin_Query();
							$obj4->executeQuery($sql4);
							$res4=$obj4->records;
							
							 $val=$res4[0]['cart_id']; 
								$cartid=$val;
							
							
						    $sql2="select * from shopping_cart_products_table a inner join shopping_cart_table b on a.cart_id=b.cart_id where b.user_id=".$_SESSION['user_id']." and a.cart_id='".$val."'" ;  
							$obj2=new Bin_Query();
							$obj2->executeQuery($sql2);
							$res=$obj2->records;
							if(count($res)>0)
							{
								foreach($res as $row)
								{
									$product_id=$row['product_id'];
									$product_qty=$row['product_qty'];
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
  
									$product_unit_price=$row['product_unit_price'];
									$shipping_cost=$row['shipping_cost'];
									
									 $sql="insert into order_products_table (order_id, product_id, product_qty, product_unit_price,shipping_cost) values  ('".$maxid."','".$product_id."','".$product_qty."','".$product_unit_price."','".$shipping_cost."')"."\n";
									$obj=new Bin_Query();
									$obj->updateQuery($sql);
									
									// update gift voucher 
									if($row['gift_product']==1)
									{
										$sql_gift="UPDATE gift_voucher_table SET  order_id='".$maxid."' WHERE  cart_id='".$row['cart_id']."'";
										$obj_gift=new Bin_Query();
										$obj_gift->updateQuery($sql_gift);
										
							
										Core_CPaymentGateways::sendingMail($maxid);

									}
									
									
								}
// 								$res1=$obj2->records;
								if(count($res)>0)
								{
									 $sql2="delete from shopping_cart_products_table where cart_id = ".$cartid;
									 $objdel=new Bin_Query();		
									 $objdel->updateQuery($sql2);
	
									 $sql3="delete from shopping_cart_table where cart_id = ".$cartid; 
									 $objselshop=new Bin_Query();
									 $objselshop->updateQuery($sql3);	
								}

							}				
					}

					// insert gift voucher 

					/*if($_SESSION['gift']!='')
					{
						for($g=0;$g<count($_SESSION['gift']);$g++)
						{

							
							$characters='4';	
							$possible = '1234567890';
								$code = '';
								$i = 0;
								while ($i < $characters) { 
									$code .= substr($possible, mt_rand(0, strlen($possible)-1), 1);
									$i++;
						
								}
							
							$code="AJGC".$code;
			
							 $sqlgift="INSERT INTO  gift_voucher_table(order_id, 	gift_product_id,recipient_name,recipient_email,name,email, 	certificate_theme,message,gift_code)VALUES('".$orderid."','".$_SESSION['gift'][$g]['proid']."','".$_SESSION['gift'][$g]['rname']."','".$_SESSION['gift'][$g]['remail']."','".$_SESSION['gift'][$g]['name']."','".$_SESSION['gift'][$g]['email']."','".$_SESSION['gift'][$g]['gctheme']."','".$_SESSION['gift'][$g]['message']."','".$code."')";
							$objgift=new Bin_Query();
							$objgift->updateQuery($sqlgift);
	
							$title='Gift Voucher';
							
							Core_CPaymentGateways::sendingMail($_SESSION['gift'][$g]['email'],$_SESSION['gift'][$g]['remail'],$code);

						}
					}	*/				
					/*$mail_sql="select a.user_email from users_table a where a.user_id=".customers_id;
					$obj_mail=new Bin_Query();
					$obj_mail=executeQuery($mail_sql);
					$user_email=$obj_mail->records[0]['user_email'];					
					$admin_sql="select set_value from admin_settings_table where set_name='Admin Email'";
					$obj_admin=new Bin_Query();
					$obj_admin=executeQuery($admin_sql);
					$admin_email=$obj_admin->records[0]['set_value'];
					$mail_name = "Zeus Cart"; //senders name
					$mail_email = $admin_email; //senders e-mail adress
					$mail_recipient = $user_email; //recipient
					$mail_body = "Thank you for using ZeusCart Your Order Has been Successfully Added. The Process will be Shortly Done."; //mail body
					$mail_subject = "Successfull Order From ZeusCart"; //subject
					$mail_header = "From: ". $mail_name . " <" . $mail_email . ">\r\n"; //optional headerfields
					mail($mail_recipient, $mail_subject, $mail_body, $mail_header);*/
					$_SESSION['checkout_amount']='';
					$_SESSION['order_tax']='';
					$_SESSION['orderdetails']='';
					UNSET($_SESSION['mycart']);
					$_SESSION['shipment_id_selected']='';
					$_SESSION['gift']='';	
					
			}	
					
		}
		/**
		* This function is used to send  the  email for gift voucher
		* @param int  $orderid
		* 
		* 
		* 
		* @return string
		*/		
		function sendingMail($orderid)
		{
			
			$sql="SELECT * FROM  gift_voucher_table WHERE order_id='".$orderid."'";
			$obj=new Bin_Query();
			$obj->executeQuery($sql);
			$records=$obj->records;
			if(count($records)>0)
			{
				for($i=0;$i<count($records);$i++)
				{
					$from_email=$records[$i]['email'];
					$code=$records[$i]['gift_code'];
					$to_mail=$records[$i]['recipient_email'];
			
					$subject = 'Gift Voucher From '.$from_email;
					$headers  = "MIME-Version: 1.0\n";
					$headers .= "Content-type: text/html; charset=UTF-8\n";
					$headers .= "From: ".$from."\n";
					
					$mailContent.='<table width="100%" cellpadding="0" cellspacing="0" border="0">
					<tr>
					<td valign="top" align="left" style="margin:0; padding:0 0 10px 0; line-height:20px; font-size:12px; color:rgb(51,51,51);"><b>Gift Voucher</b></td>
					</tr>
					<tr>
					<td valign="top" align="left" style="margin:0; padding:0 0 10px 0; line-height:20px; font-size:12px; color:rgb(51,51,51);">Your Gift Voucher Code '.$code.'</td>
					</tr>			
					</table>';
					
		
					$mailContent = stripslashes($mailContent);
					mail($to_mail,$subject,$mailContent,$headers);
				}

			}
			
			
		}
		/**
		* This function is used to view the manual success page after payment finished
		* @param string $paytype
		* .
		* 
		* @return string
		*/
		function manualSuccess($paytype)
		{
				
				if($paytype=='6')
				{
					$order_total=$_SESSION['checkout_amount'];
					$ipn_id="2Checkout Payment";	
					$orders_status=4;
				}
				elseif($paytype=='7')
				{
					$order_total=$_SESSION['checkout_amount'];
					$ipn_id="Worldpay";	
					$orders_status=4;
				}
				
				
				$trans_date=date('Y-m-d H:i:s');	
				$date_purchased=$trans_date;
				$payment_method=$paytype;
		      
				
			$customers_id=$_SESSION['user_id'];
			$orderdetails=$_SESSION['orderdetails'];
			
			$billing_name  =$orderdetails['txtname'];
			$billing_company  =$orderdetails['txtcompany'];
			$billing_street_address  =$orderdetails['txtstreet'];
			$billing_city  =$orderdetails['txtcity'];
			$billing_suburb  =$orderdetails['txtsuburb'];
			$billing_postcode  =$orderdetails['txtzipcode'];
			$billing_country  =$orderdetails['txtcountry'];
			$billing_state  =$orderdetails['txtstate'];
			$shipping_name  =$orderdetails['txtsname'];
			$shipping_company =$orderdetails['txtscompany']; 
			$shipping_street_address =$orderdetails['txtsstreet'];
			$shipping_city  =$orderdetails['txtscity'];
			$billing_suburb  =$orderdetails['txtssuburb'];
			$shipping_postcode  =$orderdetails['txtszipcode'];
			$shipping_country  =$orderdetails['txtscountry'];
			$billing_state =$orderdetails['txtsstate'];
			
			
			
			if((((int)$customers_id!=0) || ($customers_id!='')) && ($_SESSION['checkout_amount']!=''))
			{
					
					$sql="insert into orders_table
					( customers_id, shipping_name, shipping_company, shipping_street_address, 
					shipping_suburb, shipping_city, shipping_postcode, shipping_state, shipping_country, 
					billing_name, billing_company, billing_street_address, billing_suburb, 
					billing_city, billing_postcode, billing_state, billing_country, payment_method, 
					shipping_method, coupon_code, date_purchased, orders_date_closed, orders_status, order_total, 
					order_tax, ipn_id, ip_address)
					values
					('".$customers_id."','".$shipping_name."','".$shipping_company."','".$shipping_street_address."','".$shipping_suburb."','".$shipping_city."','".$shipping_postcode."','".$shipping_state."','".$shipping_country."','".$billing_name."','".$billing_company."','".$billing_street_address."','".$billing_suburb."','".$billing_city."','".$billing_postcode."','".$billing_state."','".$billing_country."','".$payment_method."','".$shipping_method."','".$coupon_code."','".$date_purchased."','".$orders_date_closed."','".$orders_status."','".$order_total."','".$order_tax."','".$ipn_id."','".$ip_address."')";
					
					$obj=new Bin_Query();
					if($obj->updateQuery($sql))
					{
							
							$orderid=$obj->insertid;
							
							
							$sql_insert_payment="INSERT INTO payment_transactions_table (payment_gateway_id ,paid_amount ,transaction_id ,transaction_date,order_id) VALUES (".$payment_method.",".$order_total.",'".$ipn_id."','".$trans_date."',".$orderid.")";
							$obj_insert_payment=new Bin_Query();
							$obj_insert_payment->updateQuery($sql_insert_payment);
							
							$sql1="select max(orders_id) as maxid from orders_table";
							$obj1=new Bin_Query();
							$obj1->executeQuery($sql1);
							$rec=$obj1->records;
							$maxid=$rec[0]['maxid'];
							
						$sql4="select distinct a.cart_id from shopping_cart_products_table a inner join shopping_cart_table b on a.cart_id=b.cart_id where b.user_id=".$_SESSION['user_id'];
							$obj4=new Bin_Query();
							$obj4->executeQuery($sql4);
							$res4=$obj4->records;
							
							$val=$res4[0]['cart_id'];
								$cartid=$val;
							
							
						$sql2="select * from shopping_cart_products_table a inner join shopping_cart_table b on a.cart_id=b.cart_id where b.user_id=".$_SESSION['user_id']."\n";
							$obj2=new Bin_Query();
							$obj2->executeQuery($sql2);
							$res=$obj2->records;
							if(count($res)>0)
							{
								foreach($res as $row)
								{
									$product_id=$row['product_id'];
									$product_qty=$row['product_qty'];
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
  
									$product_unit_price=$row['product_unit_price'];
									$shipping_cost=$row['shipping_cost'];
							 $sql="insert into order_products_table (order_id, product_id, product_qty, product_unit_price,shipping_cost) values  ('".$maxid."','".$product_id."','".$product_qty."','".$product_unit_price."','".$shipping_cost."')"."\n";
									$obj=new Bin_Query();
									$obj->updateQuery($sql);
									
									
									
									
								}
								$res1=$obj2->records;
							
								if(count($res)>0)
								{
							$sql2="delete from shopping_cart_products_table where cart_id = ".$cartid;				
									$obj->updateQuery($sql2);	
							$sql3="delete from shopping_cart_table where cart_id = ".$cartid; 
									$obj->updateQuery($sql3);	
								}
							}				
					}					
					/*$mail_sql="select a.user_email from users_table a where a.user_id=".customers_id;
					$obj_mail=new Bin_Query();
					$obj_mail=executeQuery($mail_sql);
					$user_email=$obj_mail->records[0]['user_email'];					
					$admin_sql="select set_value from admin_settings_table where set_name='Admin Email'";
					$obj_admin=new Bin_Query();
					$obj_admin=executeQuery($admin_sql);
					$admin_email=$obj_admin->records[0]['set_value'];
					$mail_name = "Zeus Cart"; //senders name
					$mail_email = $admin_email; //senders e-mail adress
					$mail_recipient = $user_email; //recipient
					$mail_body = "Thank you for using ZeusCart Your Order Has been Successfully Added. The Process will be Shortly Done."; //mail body
					$mail_subject = "Successfull Order From ZeusCart"; //subject
					$mail_header = "From: ". $mail_name . " <" . $mail_email . ">\r\n"; //optional headerfields
					mail($mail_recipient, $mail_subject, $mail_body, $mail_header);*/
					$_SESSION['checkout_amount']='';
			}	
					
		}
		
		/**
		* This function is used toget merchant id
		* @param string $gateway
		* @return string
		*/
		function getMerchantId($gateway)
		{
			$sql="select merchant_id from paymentgateways_table where gateway_name='".$gateway."'";
			$obj=new Bin_Query();
			$obj->executeQuery($sql);
			
			
			if(((int)$obj->totrows)>0)
			{
			$rec=$obj->records[0]['merchant_id'];
			return $rec;
			}
			else
			{
			return 'No Merchant id was found on this '.$gateway.' Payment Gateway ';
			}
		}
		
}
?>