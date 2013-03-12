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
			  $sql='select a.orders_id,b.user_display_name as Name,a.date_purchased,a.billing_name,a.billing_company,a.billing_street_address,a.billing_suburb,a.billing_city,a.billing_postcode,a.billing_state,d.cou_name as billing_country,a.shipping_name,a.shipping_company,a.shipping_street_address,a.shipping_suburb,a.shipping_city,a.shipping_postcode,a.shipping_state,e.cou_name as shipping_country,c.orders_status_name,c.orders_status_id,a.order_total,f.gateway_name,g.shipment_name from orders_table a inner join users_table b on a.customers_id=b.user_id inner join orders_status_table c on c.orders_status_id=a.orders_status inner join country_table d on d.cou_code=a.billing_country inner join country_table e on e.cou_code=a.shipping_country inner join 	paymentgateways_table f on f.gateway_id=a.payment_method left join shipments_master_table g on g.shipment_id=a.shipment_id_selected';
			  
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
	
		
		$sqlOrderProduct="select a.order_id,a.product_id,c.title,c.brand,a.product_qty,a.product_unit_price,
a.product_qty*a.product_unit_price as amt,a.shipping_cost from order_products_table a,orders_table b,products_table c where a.order_id=b.orders_id and a.product_id=c.product_id order by a.order_id";
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
	    
		 $status=$_POST['processCombo'];
		 $shipmentSelected=$_POST['shipmentsCombo'];
		 $shipmentTrackId=$_POST['shippmentId'];
		 $shipmentTrackid=$_POST['shippmentId'];
		 $order_id=$_POST['orderId'];
		 
		 $myobj=new Core_COrderManagement();
		 	
			
				
		 if ($_POST['processCombo']!='2' && $_POST['processCombo']!='')
		 	$sql='update orders_table set orders_status = '.$status.' where  orders_id ='. $order_id;
		 elseif ($_POST['processCombo']=='2' && $_POST['processCombo']!='')
		 	$sql="update orders_table set orders_status = '".$status."',shipment_id_selected=".$shipmentSelected.",shipment_track_id='".$shipmentTrackId."' where  orders_id =". $order_id;
			
		 $obj1=new Bin_Query();
		 $obj1->updateQuery($sql);
		 
		 return $order_id;
		 
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
	    $sql='select a.*,b.user_display_name,c.orders_status_name from orders_table a inner join users_table b on a.customers_id=b.user_id inner join orders_status_table c on c.orders_status_id=a.orders_status where a.orders_id='.$id;
		$obj=new Bin_Query();
		$obj->executeQuery($sql);
		
		$sql1="select * from shipments_master_table where status=1";
		$obj1=new Bin_Query();
		$obj1->executeQuery($sql1);
		
		return Display_DOrderManagement::displayDetailOrders($obj->records,$obj1->records); 
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
	 * 
	 * 
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
	    $sql="SELECT a.title,c.date_purchased,b.product_unit_price,b.product_qty,b.shipping_cost,((b.product_qty*b.product_unit_price)+b.shipping_cost)as subtotal  from products_table a inner join order_products_table b on a.product_id=b.product_id inner join orders_table c on b.order_id=c.orders_id and b.order_id=".(int)$_GET['id']." order by c.date_purchased desc ";
		$obj = new Bin_Query();
		if($obj->executeQuery($sql))
		{		
		   $sql1="select ((b.product_qty*b.product_unit_price)+b.shipping_cost)as subtotal,b.shipping_cost  from products_table a inner join order_products_table b on a.product_id=b.product_id inner join orders_table c   on b.order_id=c.orders_id and b.order_id=".(int)$_GET['id']." order by c.date_purchased desc";
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

}
?>