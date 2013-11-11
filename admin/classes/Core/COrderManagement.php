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
 * This class contains functions to get the order details from the database.
 *
 * @package  		Core_COrderManagement
 * @category  		Core
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
   * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */

 class Core_COrderManagement
{
   
	 
	 
	 /**
	 * Function gets the order details from the database.
	 * 
	 * 
	 * @return string
	 */	 
	 
 	function dispOrders()
	{
	   	 $pagesize=25;
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
			$condition=array();	
			$name=$_POST['dispname'];		
			$shipname=$_POST['shipname'];
			$orderid=$_POST['orderid'];
			$fromdate=$_POST['txtfromdate'];
			$todate=$_POST['txttodate'];			
			$orderdate=$_POST['orderdate'];
			$billname=$_POST['billname'];			
			$ordertotalto=$_POST['ordertotalto'];
			$ordertotalfrom=$_POST['ordertotalfrom'];						
			$orderstatus=$_POST['selorderstatus'];			
			  $sql='select a.orders_id,a.customers_id,a.order_ship,a.currency_id,q.id,q.currency_tocken,b.user_display_name as Name,a.date_purchased,a.billing_name,a.billing_company,a.billing_street_address,a.billing_suburb,a.billing_city,a.billing_postcode,a.billing_state,d.cou_name as billing_country,a.shipping_name,a.shipping_company,a.shipping_street_address,a.shipping_suburb,a.shipping_city,a.shipping_postcode,a.shipping_state,e.cou_name as shipping_country,c.orders_status_name,c.orders_status_id,a.order_total,f.gateway_name,g.shipment_name from orders_table a inner join users_table b on a.customers_id=b.user_id inner join orders_status_table c on c.orders_status_id=a.orders_status inner join country_table d on d.cou_code=a.billing_country inner join country_table e on e.cou_code=a.shipping_country inner join 	paymentgateways_table f on f.gateway_id=a.payment_method left join shipments_master_table g on g.shipment_id=a.shipment_id_selected left join currency_master_table q on q.id=a.currency_id';
			  
			if($name!='')
			{
				$condition []= "  b.user_display_name like '%".$name."%'";
			}
			if($orderid!='')
			{
				$condition[]= " a.orders_id='".$orderid."'";
			}
			if($billname!='')
			{
				$condition []= "  a.billing_name like  '%".$billname."%'";
			}	
			if($orderstatus!='')
			{
				$condition []= "  a.orders_status='".$orderstatus."'";
			}
			if(($ordertotalfrom!='') &&($ordertotalto!=''))
			{
			   // if((int)$ordertotalfrom>=(int)$ordertotalto)
				$condition []= "  a.order_total between ".$ordertotalfrom." and ".$ordertotalto;
			}
			
			if(($fromdate!='') &&($todate!=''))
			{
			  // if($fromdate>=$todate)
				$condition []= "  a.date_purchased between '".$fromdate."' and '".$todate."' ";
			}			
			if(count($condition)>0)
				 
				$sql.= ' where '. implode(' and ', $condition) .' order by a.date_purchased desc' ;
				 
			elseif(count($condition)>0)
			{
				$sql.= ' where  '. implode('', $condition).' order by a.date_purchased desc' ; 
			}
			else
			{
			   $sql.=' order by a.date_purchased desc';
			}
	
		
		$sqlOrderProduct="select a.order_id,a.product_id,a.currency_id,c.title,c.brand,a.product_qty,a.product_unit_price,f.id=a.currency_id,a.product_qty*a.product_unit_price as amt,a.shipping_cost from order_products_table a,orders_table b,products_table c,currency_master_table f where a.order_id=b.orders_id and f.id=a.currency_id and a.product_id=c.product_id order by a.order_id";
		$objOrderProduct=new Bin_Query();
		$objOrderProduct->executeQuery($sqlOrderProduct); 
		
	   	//$obj1=new Bin_Query();
		$obj=new Bin_Query();
  	    	if($obj->executeQuery($sql))
		{
				$total = ceil($obj->totrows/ $pagesize);
				include('classes/Lib/Paging.php');
				$tmp = new Lib_Paging('classic',array('totalpages'=>$total, 'length'=>10),'pagination');
				$this->data['paging'] = $tmp->output;
				$this->data['prev'] =$tmp->prev;
				$this->data['next'] = $tmp->next;
				if (empty($condition))
					$sql1 =$sql." LIMIT ".$start.",".$end;
				else
					$sql1 =$sql;
			
				$query = new Bin_Query();
				//$sql1="select orders_status_id,orders_status_name from orders_status_table";
				$obj1=new Bin_Query();
				$obj1->executeQuery($sql1);
				
				$sql3="select orders_status_id,orders_status_name from orders_status_table";
				$obj3=new Bin_Query();
				$obj3->executeQuery($sql3);		
				$query->executeQuery($sql);
		}
		
			if (empty($condition))
				return Display_DOrderManagement::displayOrders($obj1->records,$this->data['paging'],$this->data['prev'],$this->data['next'],$obj3->records,$obj3->records,$objOrderProduct->records);
			else
				return Display_DOrderManagement::displayOrders($obj1->records,'','','',$obj3->records,$obj3->records,$objOrderProduct->records);
				
		/*else
		{
			return "No Orders Found";
		}
		return Display_DOrderManagement::dispOrders($obj1->records); */
	}
	
	/**
	 * Function displays the order details for updation. 
	 * 
	 * 
	 * @return string
	 */	
	
	function editOrders()
	{
	   	$sql='select * from orders_table where orders_id='.$id;
		$obj1=new Bin_Query();
		$obj1->executeQuery($sql);
		return Display_DOrderManagement::dispOrders($obj1->records); 
	}
	
	/**
	 * Function updates the order details into the database.
	 * 
	 * 
	 * 
	 */
	
	
	function updateOrders()
	{
	   
	     $arr=$_POST['chkorder'];	  
		
		 $i=0;	 
		 $status=$_POST['selupdatedropdown'];
		 $myobj=new Core_COrderManagement();
		 if(count($arr)>0)
		 {
			for($i=0;$i<count($arr);$i++)
			{
			  	 $order_id=$arr[$i];				
				if($myobj->checkOrder($status,$order_id))
				{
					$sql='update orders_table set orders_status = '.$status.' where  orders_id ='. $order_id;
				}
				$obj1=new Bin_Query();
				$obj1->updateQuery($sql);


				
			 }
  		}
	}
	
	/**
	 * Function updates the order and shipment details into the database
	 * 
	 * 
	 * @return integer
	 */
	
	function updateOrdersAndShipments()
	{


		 if($_POST['processCombo']!='')
		 {	
			$order_id=$_POST['orderId'];	
			$status=$_POST['processCombo'];
		 	$sql="update orders_table set orders_status = '".$status."' where  orders_id =".$order_id; 
			$obj1=new Bin_Query();
			if($obj1->updateQuery($sql))
			{	
				if($_POST['orderhistory']!='')
				{
					$objhis=new Bin_Query();
					$sqlhis="INSERT INTO order_history_table(order_id,order_history, 	order_history_time)VALUES('".$order_id."','".$_POST['orderhistory']."','".date("Y-m-d H:i:s")."')"; $objhis->updateQuery($sqlhis);
		
				}	
		
				$_SESSION['errmsg']='<div class="alert alert-success">
					<button data-dismiss="alert" class="close" type="button">×</button>
					<strong>Well done!</strong> Updated Successfully</div>';
			
			}
				header('Location:index.php?do=disporders');
		 }
		else
		{

			$order_id=$_GET['id'];	
			$shipment_id=$_POST['shipment_id'];
			$shipdurid=$_POST['shipdurid'];			
			$shipment_track_id=$_POST['shipment_track_id'];
			
			if($shipment_id=='1')
			{
				$shipping_cost=$_POST['default_shipping_cost'];
				$shipdurid='';
			}
			else
			{
				$shipping_cost=$_POST['shipping_cost'];
			} 
			$order_total=$_POST['order_total']+$shipping_cost;
			$sql="update orders_table set 
			shipment_id_selected=".$shipment_id.",
			shipment_track_id='".$shipmentTrackId."',
			shipping_method='".$shipdurid."',
			order_ship ='".$shipping_cost."',
			shipment_track_id='".$shipment_track_id."',
			order_total='".$order_total."'
			where  orders_id =".$order_id;
			$obj1=new Bin_Query();
			if($obj1->updateQuery($sql))
			{
				$_SESSION['errmsg']='<div class="alert alert-success">
					<button data-dismiss="alert" class="close" type="button">×</button>
					<strong>Well done!</strong> Updated Successfully</div>';
	
				echo "<script> top.location = top.location;</script>";
				
			}
		}
		
	}
  	
	
	/**
	 * Function checks the status of an selected order
	 *	
	 * @param string $currentorderstatus
	 * @param integer $orderid
	 * 
	 * @return bool
	 */
	
	
	function checkOrder($currentorderstatus,$orderid)
	{
	    $sql="select orders_status from orders_table where orders_id=".$orderid;
		$obj=new Bin_Query();
		if($obj->executeQuery($sql))
		{
		    $res=$obj->records;
			$preorderstatus=$res[0]['orders_status'];
			if((int)$currentorderstatus>=(int)$preorderstatus)
			   return 1;
			else
			   return 0;			
		}
		
	}
	
	
	/**
	 * Function gets the details of an order from database
	 *	
	 * 
	 * 
	 * 
	 * @return string
	 */
	
	function dispDetailOrders()
	{
		$id=$_GET['id'];
		$sql='select a.*,b.user_display_name,d.gateway_name,c.orders_status_name,s.shipment_name,f.id,f.currency_tocken from orders_table a inner join users_table b on a.customers_id=b.user_id inner join orders_status_table c on c.orders_status_id=a.orders_status left join paymentgateways_table d on a.payment_method=d.gateway_id 
		left join shipments_master_table s on s.shipment_id=a.shipment_id_selected 		
		left join currency_master_table f on f.id=a.currency_id where a.orders_id='.$id;
		$obj=new Bin_Query();
		$obj->executeQuery($sql);
		
		$sql1="select * from shipments_master_table where status=1";
		$obj1=new Bin_Query();
		$obj1->executeQuery($sql1);

		$sqlinvoice="SELECT * FROM invoice_table WHERE order_id ='".$id."'";
		$objinvoice=new Bin_Query();
		$objinvoice->executeQuery($sqlinvoice);
		$recordsinv=$objinvoice->records[0];
		
		return Display_DOrderManagement::displayDetailOrders($obj->records,$obj1->records,$recordsinv); 
	}
	
	
	/**
	 * Function gets the transaction details for an order from database
	 *	
	 * 
	 * 
	 * 
	 * @return string
	 */
	
	function dispTransactionDetails()
	{
	   	 $id=$_GET['id'];
		$sql='select a.*,b.user_display_name,c.orders_status_name,d.gateway_name from orders_table a inner join users_table b on a.customers_id=b.user_id inner join orders_status_table c on c.orders_status_id=a.orders_status left join paymentgateways_table d on a.payment_method=d.gateway_id where a.orders_id='.$id;
		$obj=new Bin_Query();
		$obj->executeQuery($sql);
		return Display_DOrderManagement::dispTransactionDetails($obj->records[0]); 
	}
	
	
	/**
	 * Function generates a dropdown list for the order status available in the database
	 *	
	 * 
	 * 
	 * 
	 * @return string
	 */
	
	
	function dropdownOrderStatus()
	{
	    $sql="select orders_status_id,orders_status_name from orders_status_table";
		$obj1=new Bin_Query();
		$obj1->executeQuery($sql);
		return Display_DOrderManagement::dropdownOrderStatus($obj->records); 
	}
	
	/**
	 * Function updates the dropdown status in the database
	 *	
	 * @return string
	 */
	function updateDropDownOrderStatus()
	{
	    	$sql="select orders_status_id,orders_status_name from orders_status_table";
		$obj1=new Bin_Query();
		$obj1->executeQuery($sql);
		return Display_DOrderManagement::dropdownOrderStatus($obj->records); 
	}
	
	 /**
	 * Function selects the data from the table need for generating auto complete popup window. 
	 * 
	 * 
	 * @return xml
	 */	 
	
	
	function autoComplete()
	{
			
		$aUsers = array();

		$sql='select a.orders_id,b.user_display_name as Name,a.billing_name,a.shipping_name from orders_table a inner join users_table b on a.customers_id=b.user_id inner join orders_status_table c on c.orders_status_id=a.orders_status inner join country_table d on d.cou_code=a.billing_country inner join country_table e on e.cou_code=a.shipping_country inner join 	paymentgateways_table f on f.gateway_id=a.payment_method left join shipments_master_table g on g.shipment_id=a.shipment_id_selected';
		$obj =  new Bin_Query();
		$obj->executeQuery($sql);
		
		$count=count($obj->records);
		if($count!=0)
		{
			for($i=0;$i<$count;$i++)
			{
				if($_GET['ids']==1)
					$aUsers[]=$obj->records[$i]['orders_id'];
				elseif($_GET['ids']==2)
					$aUsers[]=$obj->records[$i]['Name'];
				elseif($_GET['ids']==3)
					$aUsers[]=$obj->records[$i]['billing_name'];
				elseif($_GET['ids']==4)
					$aUsers[]=$obj->records[$i]['shipping_name'];
			}
		}
		else
			$aUsers[]='0 Results';		
	
	
		$input = strtolower( $_GET['input'] );
		$len = strlen($input);
		$limit = isset($_GET['limit']) ? (int) $_GET['limit'] : 0;
		
		
		$aResults = array();
		$count = 0;
		
		if ($len)
		{
			for ($i=0;$i<count($aUsers);$i++)
			{
				// had to use utf_decode, here
				// not necessary if the results are coming from mysql
				//
				if (strtolower(substr(utf8_decode($aUsers[$i]),0,$len)) == $input)
				{
					$count++;
					$aResults[] = array( "id"=>($i+1) ,"value"=>htmlspecialchars($aUsers[$i]));
				}
				
				if ($limit && $count==$limit)
					break;
			}
		}
			
		
		
		header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
		header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
		header ("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
		header ("Pragma: no-cache"); // HTTP/1.0
		
		
		
		if (isset($_REQUEST['json']))
		{
			header("Content-Type: application/json");
		
			echo "{\"results\": [";
			$arr = array();
			for ($i=0;$i<count($aResults);$i++)
			{
				$arr[] = "{\"id\": \"".$aResults[$i]['id']."\", \"value\": \"".$aResults[$i]['value']."\"}";
			}
			echo implode(", ", $arr);
			echo "]}";
		}
		else
		{
			header("Content-Type: text/xml");
	
			echo "<?xml version=\"1.0\" encoding=\"utf-8\" ?><results>";
			for ($i=0;$i<count($aResults);$i++)
			{
				echo "<rs id=\"".$aResults[$i]['id']."\" >".$aResults[$i]['value']."</rs>";
			}
			echo "</results>";
		}
					
	}
	
	 /**
	 * Function gets the products for the selected order from the database
	 * 
	 * 
	 * @return string
	 */	 
	
	function displayProductsForOrder()
	{
		$sql="SELECT a.title,c.date_purchased,b.product_unit_price,b.variation_id,c.currency_id,f.id,f.currency_tocken,b.product_qty,a.product_id,b.shipping_cost,((b.product_qty*b.product_unit_price)+b.shipping_cost)as subtotal,c.order_ship,c.order_total  from products_table a inner join order_products_table b on a.product_id=b.product_id inner join orders_table c on b.order_id=c.orders_id inner join currency_master_table f on f.id=c.currency_id and b.order_id=".(int)$_GET['id']." order by c.date_purchased desc ";
		$obj = new Bin_Query();
		if($obj->executeQuery($sql))
		{		
			$sql1="select ((b.product_qty*b.product_unit_price)+b.shipping_cost)as subtotal,c.order_ship,c.order_total from products_table a inner join order_products_table b on a.product_id=b.product_id inner join orders_table c   on b.order_id=c.orders_id and b.order_id=".(int)$_GET['id']." order by c.date_purchased desc";
           		 $obj1=new Bin_Query();
			$obj1->executeQuery($sql1);
			$arr=$obj1->records;
			$arrval= array();

			$sumofval=0;
			foreach($arr as $r)
			{
			   $arrval[]=$r['subtotal'];
			}

			return  Display_DOrderManagement::displayProductsForOrder($obj->records,array_sum($arrval));
		}	
	}
	 /**
	 * Function gets the product   order  history from the database
	 * 
	 * 
	 * @return string
	 */	 
	
	function displayOrderHistory()
	{
	   
		$sql="SELECT * FROM order_history_table WHERE order_id ='".$_GET['id']."'";
		$obj=new Bin_Query();
		$obj->executeQuery($sql);

		return  Display_DOrderManagement::displayOrderHistory($obj->records);
		
	}	
	 /**
	 * Function is used to cancel  the  order in the database
	 * 
	 * 
	 * @return string
	 */	 
	function cancelOrders()
	{	


		$id = mysql_real_escape_string($_GET['id']);		
		if(!intval($id))
		{


			$output = "<div class='error_msgbox'>Please Select a Valid Order for Cancellation</div>";		
		 	$_SESSION['errmsg']=$output;
			header('Location:?do=disporders');
			exit();
		}
			
		$orderstatus = new Bin_Query();
		$sqlorderstatus = "select * from orders_table where orders_id='".$id."'"; 
		$orderstatus->executeQuery($sqlorderstatus);	
		$order= $orderstatus->records[0];
		$customerid = $order['customers_id'];	
		
		if($order['orders_status']=='5')
		{
	
			$err ="<div class='alert alert-error'>
			<button data-dismiss='alert' class='close' type='button'>×</button>
			Please Select a Valid Order ID for Cancellation</div>";			
		 	$_SESSION['errmsg']=$err;
			header('Location:?do=disporders');
			exit();
		}		
		
		$sql1="select * from order_products_table where order_id='".$id."'";
		$obj1=new Bin_Query();
		$obj1->executeQuery($sql1);
		$rec=$obj1->records;	
		
		
		if(count($rec) > 0)
		{
			for($i=0;$i<count($rec);$i++)
			{
				$product_id=$rec[$i]['product_id'];
				$product_qty=$rec[$i]['product_qty'];
				$variationid=$rec[$i]['variation_id'];

				if($variationid==0 || $variationid=='')
				{
					$sql6="select * from product_inventory_table where product_id=".$product_id;
				}					
				else
				{
					$sql6="select * from product_variation_table where product_id=".$product_id. " AND variation_id=".$variationid;
				}
				
				$obj6=new Bin_Query();
				$obj6->executeQuery($sql6);
				$res6=$obj6->records;
				
				
				$soh=$res6[0]['soh'];				
				$mysoh=$soh+$product_qty;
				
				if ($variationid==0 || $variationid=='')
				{
					$sql5="update product_inventory_table set soh = '".$mysoh."' where product_id = ".$product_id;
				}
				else
				{
					$sql5="update product_variation_table set soh = '".$mysoh."' where product_id=".$product_id. " AND variation_id=".$variationid;
				}			
				
				$obj5=new Bin_Query();
				$obj5->updateQuery($sql5);
			}
			
			$sql='update orders_table set orders_status="5" where  orders_id ='.$id;			
			$obj1=new Bin_Query();
			$obj1->updateQuery($sql);
			
			
			//Start Of Send Mail

			/*$cmp_logo_query="select * from  admin_settings_table where set_id='3'";
			$getlogo = new Bin_Query();
			$getlogo->executeQuery($cmp_logo_query);
			$URL = "http://".$_SERVER["SERVER_NAME"].$_SERVER["PHP_SELF"];
								
			$pageURL = str_replace("index.php","",$URL);		
						
			$cmpylogo ='<img src="'.$pageURL.$getlogo->records[0]['set_value'].'" border="0" height="74" width="190" name="img" id="src" />';		
		
			$sq="select * from users_table where user_id='".$customerid."'";
			$qry1=new Bin_Query();
			$qry1->executeQuery($sq);
						
			$to_mail=$qry1->records[0]['user_email'];

			$mail_content_query="select * from mail_content_table where content_id='4'";
			$mailcontent = new Bin_Query();
			$mailcontent->executeQuery($mail_content_query);			
			$title = $mailcontent->records[0]['content_title'];
			$from =	$mailcontent->records[0]['content_from'];
			$subject = $mailcontent->records[0]['content_subject'];
			$mailcontent = $mailcontent->records[0]['content_message'];
		
			$contentlogo .= str_replace("[LOGO]",$cmpylogo,$mailcontent);
			$contentorderstatus .= str_replace("[STATUS]",'Cancelled',$contentlogo);			
			$mail_content.=$contentorderstatus;	
			
			Core_COrderManagement::sendingMail($to_mail,$title,$mail_content);		*/	
			//End of Send Mail 
			
		
			$output = "<div class='alert alert-success'>
			<button data-dismiss='alert' class='close' type='button'>×</button>
			<strong>Well done!</strong> Order Status Updated Successfully</div>";		
			$_SESSION['errmsg']=$output;
			header('Location:?do=disporders');			
			exit();
		}
		else
		{

			$output ="<div class='alert alert-error'>
			<button data-dismiss='alert' class='close' type='button'>×</button>Please Select a Valid Order for Cancellation</div>";		
		 	$_SESSION['errmsg']=$output;
			header('Location:?do=disporders');
			exit();
		}		
			
		
	}
	 /**
	 * Function is used to send  the email for user  order related email
	 * 
	 * 
	 * @return string
	 */
	function sendingMail($to_mail,$title,$mail_content)
	{
		
		$sql = "select set_value from admin_settings_table where set_name='Admin Email'";
		$obj = new Bin_Query();
		if($obj->executeQuery($sql))
		{
			
			$from =$obj->records[0]['set_value']; 
			include('../classes/Lib/Mail.php');
			$mail = new Lib_Mail();
			$mail->From($from); 
			$mail->ReplyTo($from);
			$mail->To($to_mail); 
			$mail->Subject($title);
			$mail->Body(stripslashes(html_entity_decode($mail_content)));
			$mail->Send();
		}
		else
			return 'No Admin mail id provided';
	}
	/**
	 * Function is used to print the order
	 * 
	 * 
	 * @return string
	 */
	function printOrders()
	{
		$id = mysql_real_escape_string($_GET['id']);
		
		if(!intval($id))
		{
			$output = "<div class='error_msgbox'>Please Select a Valid Order for Printing</div>";		
		 	$_SESSION['errmsg']=$output;
			header('Location:?do=disporders');
		}	
			
		$sql='select a.orders_id,b.user_display_name as Name,b.user_email,a.date_purchased,a.order_ship,a.billing_name,a.billing_company,a.billing_street_address,a.billing_suburb,a.billing_city,a.billing_postcode,a.billing_state,d.cou_name as billing_country,a.shipping_name,a.shipping_company,a.shipping_street_address,a.shipping_suburb,a.shipping_city,a.shipping_postcode,a.shipping_state,e.cou_name as shipping_country,c.orders_status_name,c.orders_status_id,a.order_total,f.gateway_name,g.shipment_name,a.coupon_code,h.transaction_id,a.currency_id,q.id,q.currency_tocken from orders_table a inner join users_table b on a.customers_id=b.user_id inner join orders_status_table c on c.orders_status_id=a.orders_status inner join country_table d on d.cou_code=a.billing_country inner join country_table e on e.cou_code=a.shipping_country inner join paymentgateways_table f on f.gateway_id=a.payment_method inner join payment_transactions_table h on h.order_id=a.orders_id left join shipments_master_table g on g.shipment_id=a.shipment_id_selected  left join currency_master_table q on q.id=a.currency_id where  a.orders_id="'.$id.'" group by a.orders_id';
		$orderdetails=new Bin_Query();
		$orderdetails->executeQuery($sql);					
		
		
		
		$sqlOrderProduct="select a.order_id,a.product_id,c.title,c.brand,a.product_qty,a.product_unit_price,a.product_qty*a.product_unit_price as amt,a.shipping_cost from order_products_table a,orders_table b,products_table c where a.order_id=b.orders_id and a.product_id=c.product_id and a.order_id='".$id."'"; 
		$objOrderProduct=new Bin_Query();
		$objOrderProduct->executeQuery($sqlOrderProduct); 

		
		Display_DOrderManagement::printOrders($orderdetails->records,$objOrderProduct->records); 
	}
	/**
	 * Function is used to email the order
	 * 
	 * 
	 * @return string
	 */	
	function emailOrders()
	{
		$id = mysql_real_escape_string($_GET['id']);
		
		if(!intval($id))
		{

			$output = "<div class='error_msgbox'>Please Select a Valid Order for Emailing</div>";		
		 	$_SESSION['errmsg']=$output;
			header('Location:?do=disporders');
		}	
			
			
		$sql='select a.orders_id,b.user_display_name as Name,b.user_email,a.date_purchased,a.order_ship,a.billing_name,a.billing_company,a.billing_street_address,a.billing_suburb,a.billing_city,a.billing_postcode,a.billing_state,d.cou_name as billing_country,a.shipping_name,a.shipping_company,a.shipping_street_address,a.shipping_suburb,a.shipping_city,a.shipping_postcode,a.shipping_state,e.cou_name as shipping_country,c.orders_status_name,c.orders_status_id,a.order_total,f.gateway_name,g.shipment_name,a.coupon_code,h.transaction_id,a.currency_id,q.id,q.currency_tocken from orders_table a inner join users_table b on a.customers_id=b.user_id inner join orders_status_table c on c.orders_status_id=a.orders_status inner join country_table d on d.cou_code=a.billing_country inner join country_table e on e.cou_code=a.shipping_country inner join paymentgateways_table f on f.gateway_id=a.payment_method inner join payment_transactions_table h on h.order_id=a.orders_id left join shipments_master_table g on g.shipment_id=a.shipment_id_selected  left join currency_master_table q on q.id=a.currency_id where  a.orders_id="'.$id.'" group by a.orders_id';
		$orderdetails=new Bin_Query();
		$orderdetails->executeQuery($sql);					
		
		
		
		$sqlOrderProduct="select a.order_id,a.product_id,c.title,c.brand,a.product_qty,a.product_unit_price,a.product_qty*a.product_unit_price as amt,a.shipping_cost from order_products_table a,orders_table b,products_table c where a.order_id=b.orders_id and a.product_id=c.product_id and a.order_id='".$id."'"; 
		$objOrderProduct=new Bin_Query();
		$objOrderProduct->executeQuery($sqlOrderProduct); 
			 
			$mail_id_query="select * from admin_settings_table where  set_id='1'";	
			$getmailid = new Bin_Query();
			$getmailid->executeQuery($mail_id_query);
			$to_mail=$getmailid->records[0]['admin_email'];			
			$from =	$getmailid->records[0]['admin_email'];
			$subject ='Order Details for the Order #'.$orderdetails->records[0]['orders_id'];
			$mailcontent = Display_DOrderManagement::emailOrders($orderdetails->records,$objOrderProduct->records);
			include('../classes/Lib/Mail.php');
			$mail = new Lib_Mail();
			$mail->From($from); 
			$mail->ReplyTo('noreply@ajshopping.com');
			$mail->To($to_mail); 
			$mail->Subject($subject);
			$mail->Body(html_entity_decode(stripslashes($mailcontent)));
			$mail->Send();	
		


			$output = "<div class='alert alert-success'>
			<button data-dismiss='alert' class='close' type='button'>×</button>
			Order Details was mailed to your E-Mail address ('.$to_mail.'). The Mail will reach your inbox in a few minutes</div>";		
		 	$_SESSION['errmsg']=$output;
			header('Location:?do=disporders');
	}		

	/**
	 * Function is used to upload invoice 
	 * 
	 * 
	 * @return string
	 */
	function insertInvoice()
	{


		$file_ext=array();
		$file_ext=explode('.',$_FILES['invoice']['name']);
		if(count($file_ext)==2)
		{
			if(strtolower($file_ext[1])!='jpg'&&strtolower($file_ext[1])!='pdf' && strtolower($file_ext[1])!='png')
			{	
				header("Location:?do=disporders&action=detail&id=".$_GET['id']."&msg=Only .jpg and .pdf file formats are allowed");
				exit;

							
			}
			else
			{
				$uploaddir = 'images/invoice'; // Relative path under webroot
				$uploadfile = $_FILES["invoice"]["name"] ;
				if (move_uploaded_file($_FILES['invoice']['tmp_name'], "../images/invoice/" . $_FILES["invoice"]["name"])) 
				{
					
					$path='images/invoice/'.$uploadfile;	
					$obj=new Bin_Query();
					$sql="INSERT INTO invoice_table (order_id,invoice_name,invoice_path,invoice_upload_date) VALUES('".$_GET['id']."','".$_POST['name']."','".$path."','".date("Y-m-d H:i:s")."')"; 
					if($obj->updateQuery($sql))
					header("Location:?do=disporders&action=detail&id=".$_GET['id']."&msg=Updated%20Sucessfully");
					exit;
				}
			} 
		}
		else 
		{
		header("Location:?do=disporders&action=detail&id=".$_GET['id']."&msg=Uploading%20Failed");
		exit;		
		}
		

	}
	function calculateShipCost()
	{
		include_once('../classes/Lib/UPS/UPSRate.php');


		$sql="SELECT * FROM shipments_master_table WHERE shipment_id=2";
		$obj=new Bin_Query();
		$obj->executeQuery($sql);
		$records=$obj->records[0];

		$shipment_accesskey=$records['shipment_accesskey'];
		$shipment_user_id=$records['shipment_user_id'];
		$shipment_password=$records['shipment_password'];		

		$ship_duration=$_GET['ship_dur_id'];		
	
		$buyer_zipcode=$_GET['zip'];
		$strServiceShortName=$_GET['ship_dur_id'];
		$product_weight=$_GET['weight'];
		$upsship = new UpsShippingQuote();
		$costupsship['ship_cost'] = $upsship->GetShippingRate($strDestinationZip=$buyer_zipcode, $strServiceShortName=$strServiceShortName, $strPackageLength='0', $strPackageWidth='0', $strPackageHeight='0', $strPackageWeight=$product_weight, $boolReturnPriceOnly=true,$shipment_accesskey,$shipment_user_id,$shipment_password);
		
		return $costupsship['ship_cost']; 


	}

	function showChangeShipping()
	{


		$sql="SELECT * FROM shipments_master_table WHERE  status='1'";
		$obj=new Bin_Query();
		$obj->executeQuery($sql);
		$records=$obj->records;

		$sqlOrder="SELECT * FROM orders_table WHERE  orders_id='".$_GET['id']."' ";
		$objOrder=new Bin_Query();
		$objOrder->executeQuery($sqlOrder);
		$shipping_method=$objOrder->records[0]['shipping_method'];
		$shipment_id=$objOrder->records[0]['shipment_id_selected'];
		$buyer_zipcode=$objOrder->records[0]['shipping_postcode'];
		$shipment_track_id=$objOrder->records[0]['shipment_track_id'];
		$order_ship=$objOrder->records[0]['order_ship'];
		$order_total=$objOrder->records[0]['order_total']; 	 	

		$sqlOrderPro="SELECT * FROM order_products_table WHERE order_id='".$_GET['id']."' ";
		$objOrderPro=new Bin_Query();
		$objOrderPro->executeQuery($sqlOrderPro);
		$recordsOrderPro=$objOrderPro->records;
		if(count($recordsOrderPro)>0)
		{
			$totalweight=0;
			$productWeight='';
			$shipping_cost='';
			$totalshipcost=0;
			for($i=0;$i<count($recordsOrderPro);$i++)
			{
			
				
				$sqlProduct="SELECT product_id,weight,shipping_cost FROM products_table WHERE product_id='".$recordsOrderPro[$i]['product_id']."'";
				$objProduct=new Bin_Query();
				$objProduct->executeQuery($sqlProduct);
				$productWeight=$objProduct->records[0]['weight'];
				$shipping_cost=$objProduct->records[0]['shipping_cost'];

				$weight=$productWeight*$recordsOrderPro[$i]['product_qty'];
				$shipcost=$shipping_cost*$recordsOrderPro[$i]['product_qty'];
				$totalweight=$totalweight+$weight;
				$totalshipcost=$totalshipcost+$shipcost;
			}
	
		}


		return Display_DOrderManagement::showChangeShipping($records,$shipment_id,$buyer_zipcode,$totalweight,$totalshipcost,$shipping_method,$shipment_track_id,$order_ship,$order_total);
	}
}
?>