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
			$shipment_id_selected=$orderdetails['shipment_id'];
			$shipping_method=$orderdetails['shipdurid'];	
			$shipping_cost=$orderdetails['shipping_cost'];
			$currecncy_id=$_SESSION['currencysetting']['selected_currency_id'];

			$billingaddress = $billing_name.', <br>'.$billing_street_address.', <br>'.$billing_city.', <br>'.$billing_suburb.', <br>'.$billing_country;
			
			$shippingaddress = $shipping_name.', <br>'.$shipping_street_address.', <br>'.$shipping_city.', <br>'.$shipping_suburb.', <br>'.$shipping_country;

			if((((int)$customers_id!=0) || ($customers_id!='')) && ($_SESSION['checkout_amount']!=''))
			{
					$sql="insert into orders_table
					( customers_id, shipping_name, shipping_company, shipping_street_address, 
					shipping_suburb, shipping_city, shipping_postcode, shipping_state, shipping_country, 
					billing_name, billing_company, billing_street_address, billing_suburb, 
					billing_city, billing_postcode, billing_state, billing_country, payment_method, 
					shipping_method, coupon_code,  date_purchased, orders_date_closed, orders_status, order_total, 
					order_tax, ipn_id, ip_address,shipment_id_selected,order_ship,currency_id)
					values
					('".$customers_id."','".$shipping_name."','".$shipping_company."','".$shipping_street_address."','".$shipping_suburb."','".$shipping_city."','".$shipping_postcode."','".$shipping_state."','".$shipping_country."','".$billing_name."','".$billing_company."','".$billing_street_address."','".$billing_suburb."','".$billing_city."','".$billing_postcode."','".$billing_state."','".$billing_country."','".$payment_method."','".$shipping_method."','".$coupon_code."','".$date_purchased."','".$orders_date_closed."','".$orders_status."','".$order_total."','".$order_tax."','".$ipn_id."','".$ip_address."','".$shipment_id_selected."','".$shipping_cost."','".$currecncy_id."')";
									
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

							if(isset($_SESSION['mycart']))
							{

								$cartid=$_SESSION['mycart'][0]['cartid'];
// 								
							}
							else
							{
								$sql4="select distinct a.cart_id from shopping_cart_products_table a inner join shopping_cart_table b on a.cart_id=b.cart_id where b.user_id=".$_SESSION['user_id']; 
								$obj4=new Bin_Query();
								$obj4->executeQuery($sql4);
								$res4=$obj4->records;
								
								$val=$res4[0]['cart_id']; 
								$cartid=$val;
							}
							
							
							
					/*	if(count($res4)>0)
						{
								
								
							for($c=0;$c<count($res4);$c++)
							{*/	
								
								$sql2="select * from shopping_cart_products_table a inner join shopping_cart_table b on a.cart_id=b.cart_id where b.user_id=".$_SESSION['user_id']." and a.cart_id='".$cartid."'" ;  
								$obj2=new Bin_Query();
								$obj2->executeQuery($sql2);
								$res=$obj2->records;
								if(count($res)>0)
								{
									foreach($res as $row)
									{
										$product_id=$row['product_id'];
										$product_qty=$row['product_qty'];

										if (self::isDigitalProduct($product_id))
										$mysoh=$product_qty;
										else
										{
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
										}
										$sql5="update product_inventory_table set soh = '".$mysoh."' where product_id = ".$product_id;
										$obj5=new Bin_Query();
										$obj5->updateQuery($sql5);
	
										$product_unit_price=$row['product_unit_price'];
										$shipping_cost=$row['shipping_cost'];
										
										if($row['variation_id']==0 || $row['variation_id']=='')
										{
											$sql="insert into order_products_table (order_id, product_id,product_qty, product_unit_price,shipping_cost) values  ('".$maxid."','".$product_id."','".$product_qty."','".$product_unit_price."','".$shipping_cost."')"."\n";
											$obj=new Bin_Query();
											$obj->updateQuery($sql);
										}
										else
										{
											$sql="insert into order_products_table (order_id, product_id,product_qty, product_unit_price,shipping_cost,variation_id) values  ('".$maxid."','".$product_id."','".$product_qty."','".$product_unit_price."','".$shipping_cost."','".$row['variation_id']."')"."\n";
											$obj=new Bin_Query();
											$obj->updateQuery($sql);
										}
																								// update gift voucher 
										if($row['gift_product']==1)
										{
											$sql_gift="UPDATE gift_voucher_table SET  order_id='".$maxid."' WHERE  cart_id='".$row['cart_id']."'";
											$obj_gift=new Bin_Query();
											$obj_gift->updateQuery($sql_gift);
											
								
											Core_CPaymentGateways::sendingMail($maxid);
	

										}
										
										
									}
	// 								
									$sql2="delete from shopping_cart_products_table where cart_id = ".$cartid;
									$objdel=new Bin_Query();		
									$objdel->updateQuery($sql2);
	
									$sql3="delete from shopping_cart_table where cart_id = ".$cartid; 
									$objselshop=new Bin_Query();
									$objselshop->updateQuery($sql3);	
									
	
								}
// 							}				
// 						}
				
				
					// Send Mail to the User about the Order Placement

					$sqlmail="select orders_id,user_display_name,user_email from orders_table a inner join users_table b on a.customers_id=b.user_id where a.customers_id='".$_SESSION['user_id']."' order by orders_id desc limit 1";
					$objmail=new Bin_Query();
					$objmail->executeQuery($sqlmail);
					$resmail_id=$objmail->records[0]['orders_id'];
					$resmail_username=$objmail->records[0]['user_display_name'];
					$resmail_usermail=$objmail->records[0]['user_email'];
					
					$sqllogo="select set_id,site_logo,site_moto,admin_email from admin_settings_table where set_id='1'";
					$objlogo=new Bin_Query();
					$objlogo->executeQuery($sqllogo);
					$logo=$objlogo->records[0]['site_logo'];				
					$title=$objlogo->records[0]['site_moto'];				
					$admin_email=$objlogo->records[0]['admin_email'];
			
				
					//Get logo
					$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on'? 'https://': 'http://';
					$dir = (dirname($_SERVER['PHP_SELF']) == "\\")?'':dirname($_SERVER['PHP_SELF']);
					$site = $protocol.$_SERVER['HTTP_HOST'].$dir;
					
							
					 $logo_path = $site.'/'.$logo;					
					
					$outputbody =   Display_DPaymentGateways::successmail($title,$logo_path,$resmail_username,$resmail_usermail,$admin_email,$orderid,$shipping_cost,$billingaddress,$shippingaddress);
					$mailsubject=$outputbody[1];
					$outputbody=$outputbody[0];
									
	
					$mailto=$resmail_usermail;
					$fromid=$admin_email;
					$mailsubject=$mailsubject;
					$mailbody=$outputbody;					


					$headers = "MIME-Version: 1.0\n";
					$headers.= "Content-type: text/html; charset=iso-8859-1\n";
					$headers.= "From: ". $fromid."\n";
					$mail = mail($mailto,$mailsubject,stripslashes(html_entity_decode($mailbody)),$headers);
				
					
					//Send Mail to the admin about the Order Placed.	
					$adminmailcontent=Display_DPaymentGateways::adminsuccessmail($title,$logo_path,$resmail_username,$resmail_usermail,$admin_email,$orderid,$shipping_cost,$billingaddress,$shippingaddress);	

					$adminmailsubject=$adminmailcontent[1];
					$adminmailcontent=$adminmailcontent[0];
				
					$mailto=$admin_email;
					$fromid=$admin_email;
					$mailsubject=$adminmailsubject;
					$mailbody=$adminmailcontent;
	
					
					$headers  = "MIME-Version: 1.0\n";
					$headers .= "Content-type: text/html; charset=iso-8859-1\n";
					$headers .= "From: ". $fromid."\n";
					$mail = mail($mailto,$mailsubject,stripslashes(html_entity_decode($mailbody)),$headers);	

					$_SESSION['checkout_amount']='';
					$_SESSION['order_tax']='';
					$_SESSION['orderdetails']='';
					UNSET($_SESSION['mycart']);
					$_SESSION['shipment_id_selected']='';
					$_SESSION['gift']='';	
					
				}
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
			
			 $sql="SELECT a.*,b.* FROM  gift_voucher_table AS a
			      LEFT JOIN products_table  AS b ON a.gift_product_id=b.product_id
			      WHERE a.order_id='".$orderid."'"; 
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
					$reciuser=$records[$i]['recipient_name'];
					$senduser=$records[$i]['name'];
					$giftimage=$records[$i]['image'];
					$giftcode=$records[$i]['gift_code'];
					$amount=$records[$i]['msrp'];

					$getmailcontent=new Bin_Query();
					$getmailquery="select * from mail_messages_table where mail_msg_id='6'";
					$getmailcontent->executeQuery($getmailquery);

					$sqllogo="select set_id,site_logo,site_moto,admin_email from admin_settings_table where set_id='1'";
					$objlogo=new Bin_Query();
					$objlogo->executeQuery($sqllogo);
					$site_logo=$objlogo->records[0]['site_logo'];				
					$admin_email=$objlogo->records[0]['admin_email'];
					$site_title=$objlogo->records[0]['site_moto'];					

					$orderamount = $_SESSION['currencysetting']['selected_currency_settings']['currency_tocken'].number_format($amount,2);	
			
					$mailcontent = $getmailcontent->records[0]['mail_msg'];
					$mailsubject= $getmailcontent->records[0]['mail_msg_subject'];
					$message= $getmailcontent->records[0]['mail_msg'];


					$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on'? 'https://': 'http://';
					$dir = (dirname($_SERVER['PHP_SELF']) == "\\")?'':dirname($_SERVER['PHP_SELF']);
					$site = $protocol.$_SERVER['HTTP_HOST'].$dir;
					$logo=$site.'/'.$giftimage;
					$link = $site.'/?do=index.php';

				 	$sito_image=''.$site.'/'.$site_logo.'';		
					$giftimage = '<a href="'.$link.'"><img src="'.$logo.'" alt="Gift Voucher"></a>';


					$URL = "http://".$_SERVER["SERVER_NAME"].$_SERVER["PHP_SELF"];	
					$pageURL = str_replace("/index.php","/index.php",$URL);		
					$contenturl.=str_replace("[URL]",'<a href="'.$pageURL.'">'.$pageURL.'</a>',$contentamount);	
		
					$message = str_replace("[title]",$site_title,$message);	
					$message = str_replace("[logo]",$sito_image,$message);
					$message = str_replace("[reciuser]",$reciuser,$message);
					$message = str_replace("[senduser]",$senduser,$message);
					$message = str_replace("[giftimage]",$giftimage,$message);
					$message = str_replace("[giftcode]",$giftcode,$message);
					$message = str_replace("[amount]",$orderamount,$message);	
					$message = str_replace("[site_email]",$admin_email,$message);

					$subject = 'Gift Voucher From '.$from_email;
					$headers  = "MIME-Version: 1.0\n";
					$headers .= "Content-type: text/html; charset=UTF-8\n";
					$headers .= "From: ".$from_email."\n";
		
					mail($to_mail,$mailsubject,$message,$headers);
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
		/**
		* This function is used check the product whether digital or not
		* @param int $product_id
		* @return int
		*/
		function isDigitalProduct($product_id)
		{
			$sql="SELECT digital FROM products_table WHERE product_id=".(int)$product_id;
			$query=new Bin_Query();
		
			if ($query->executeQuery($sql))
				return (int)$query->records[0]['digital'];
			else
				return 0;
		}
}
?>