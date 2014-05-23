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
 * This class contains functions to generate a xml file for the selected chart type
 *
 * @package  		Core_CChart
 * @category  		Core
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
   * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */


class Core_CChart
{
	
	
	/**
	 * Function generates an array with details for generating the chart 
	 * 
	 * 
	 * @return xml
	 */
	
	
	function generateChart()
	{					
	$output ['type'] = Display_DChart::getType();		
	$output['frommnth']=Display_DChart::getDay(0);		
	$output['tomnth']=Display_DChart::getDay(1);
	$output['fromyr'] = Display_DChart::getYear(0);
	$output['toyr'] = Display_DChart::getYear(1);	
		
	
	$id = ctype_digit($_GET['id']) ? $_GET['id'] : '';		
	
	$ChartDetails = new Core_CChart();
	$chartdet = $ChartDetails->getChartDetails($id);	
	
	$output['id'] = $id;
	$output['header'] = $chartdet['header'];
	$sql = $chartdet['sql'];	
	$strParam=$chartdet['strParam'];
	
	$genXML = new Core_CChart();	
	$output['xml'] = $genXML->generateXML($sql,$strParam); 	
 	
	return $output;		
	}
	/**
	 * Function to get chart details
	 * @param integer $id
	 * 
	 * @return string
	 */
	function getChartDetails($id)
	{		

		if(isset($_POST['Calendar']) && $_POST['Calendar']['DateType']=='1')
		{			
		$enddate = date('Y-m-d');	
		$startdate = date('Y-m-d', strtotime("-30 days"));		
			if($id==1)
			{		  			
		$chartdet['sql'] = "select count(date_purchased)as total , date_format(date_purchased,'%b') as date from orders_table where date_purchased <='".$enddate."' and date_purchased >='".$startdate."' and orders_status='3' group by month(date_purchased)";				
	$chartdet['strParam']="caption=Completed Orders;subcaption=From ".date('jS M Y',strtotime($startdate))." to ".date('jS M Y',strtotime($enddate)).";xAxisName=Month;yAxisName=Count;decimalPrecision=0; formatNumberScale=1;showBorder=1;pieSliceDepth=30;";  
	 $chartdet['header'] = "Completed Orders";	 
	 		}
			else if ($id==2)
			{			
		    $chartdet['sql']= "select count(user_id)as total , date_format(user_doj,'%b') as date from users_table where user_doj <='".$enddate."' and user_doj >='".$startdate."' group by month(user_doj)";			  
	$chartdet['strParam']="caption=New Customers;subcaption=From ".date('jS M Y',strtotime($startdate))." to ".date('jS M Y',strtotime($enddate)).";xAxisName=Month;yAxisName=Total;decimalPrecision=0;formatNumberScale=1;showBorder=1;pieSliceDepth=30;"; 
	$chartdet['header'] = "New Customers";				
			}	
			else if ($id==3)	
			{
			$chartdet['sql']= "select count(date_purchased)as total , concat(ucase(date_format(a.date_purchased,'%b')),'-',b.name) as date from orders_table a , country_table b where a.date_purchased<='".$enddate."' and a.date_purchased >= '".$startdate."' and a.orders_status='3' and a.shipping_country=b.cou_code group by month(date_purchased),b.name";			  
			$chartdet['strParam']="caption=Location Wise Completed Order Details;subcaption=From ".date('jS M Y',strtotime($startdate))." to ".date('jS M Y',strtotime($enddate)).";xAxisName=Locations;yAxisName=Count;decimalPrecision=0; formatNumberScale=1;showBorder=1;pieSliceDepth=30;rotatenames=1";  	
			$chartdet['header'] = "Location Wise Completed Order Details";					
			}
			else if($id==4)
			{		  			
		$chartdet['sql'] = "select count(date_purchased)as total , date_format(date_purchased,'%b') as date from orders_table where date_purchased <='".$enddate."' and date_purchased >='".$startdate."' and orders_status='1' group by month(date_purchased)";				
	$chartdet['strParam']="caption=Pending Orders;subcaption=From ".date('jS M Y',strtotime($startdate))." to ".date('jS M Y',strtotime($enddate)).";xAxisName=Month;yAxisName=Count;decimalPrecision=0; formatNumberScale=1;showBorder=1;pieSliceDepth=30;";  
	 $chartdet['header'] = "Pending Orders";	 
	 		}	
			else if($id==5)
			{		  			
		$chartdet['sql'] = "select count(date_purchased)as total , date_format(date_purchased,'%b') as date from orders_table where date_purchased <='".$enddate."' and date_purchased >='".$startdate."' and orders_status='2' group by month(date_purchased)";				
	$chartdet['strParam']="caption=Orders Under Processing;subcaption=From ".date('jS M Y',strtotime($startdate))." to ".date('jS M Y',strtotime($enddate)).";xAxisName=Month;yAxisName=Count;decimalPrecision=0; formatNumberScale=1;showBorder=1;pieSliceDepth=30;";  	 $chartdet['header'] = "Orders Under Processing";	 
	 		}	
			else if($id==6)
			{		  			
		$chartdet['sql'] = "select count(date_purchased)as total , date_format(date_purchased,'%b') as date from orders_table where date_purchased <='".$enddate."' and date_purchased >='".$startdate."' and orders_status='4' group by month(date_purchased)";				
	$chartdet['strParam']="caption=Orders Awaiting Payment;subcaption=From ".date('jS M Y',strtotime($startdate))." to ".date('jS M Y',strtotime($enddate)).";xAxisName=Month;yAxisName=Count;decimalPrecision=0; formatNumberScale=1;showBorder=1;pieSliceDepth=30;";  	 $chartdet['header'] = "Orders Awaiting Payment";	 
	 		}	
			else if($id==7)
			{						
		$chartdet['sql']= "select concat(a.product_qty,'-','Product') as date,round((count(a.product_qty)/(select sum(cnt) from (select count(product_qty) as cnt from order_products_table group by product_qty) as t))*100) as total from order_products_table a, orders_table b where a.order_id = b.orders_id and date_purchased <='".$enddate."' and date_purchased >='".$startdate."' group by product_qty";			  	
		$chartdet['strParam']="caption=Quantity Break Down;subcaption=From ".date('jS M Y',strtotime($startdate))." to ".date('jS M Y',strtotime($enddate)).";xAxisName=No of Products Per Order;yAxisName=Percentage;decimalPrecision=0; formatNumberScale=1;showBorder=1;pieSliceDepth=30;numberSuffix=%25";  	
		$chartdet['header'] ="Quantity Break Down";	
	 		}	
			else if($id==9)
			{
			$chartdet['sql']= "select sum(prd.product_qty)as total,prod.title as date from orders_table ord,order_products_table prd,products_table prod where ord.orders_id = prd.order_id and prd.product_id=prod.product_id and orders_status='3' and date_purchased <='".$enddate."' and date_purchased >='".$startdate."' group by prd.product_id";			  
	$chartdet['strParam']="caption=Products Sold(By Units - In Completed Orders);subcaption=From ".date('jS M Y',strtotime($startdate))." to ".date('jS M Y',strtotime($enddate)).";xAxisName=Name of the Product;yAxisName=Sold Items in Units;decimalPrecision=0;formatNumberScale=1;showBorder=1;pieSliceDepth=30;rotatenames=1";  
	$chartdet['header'] ="Products Sold (By Units)";	
			}	
			else if($id==10)
			{
			$chartdet['sql']= "select sum(ord.order_total) as total,prod.title as date from orders_table ord,order_products_table prd,products_table prod where ord.orders_id = prd.order_id and prd.product_id=prod.product_id and prd.product_qty<>'0' and orders_status='3' and date_purchased <='".$enddate."' and date_purchased >='".$startdate."' group by prd.product_id";			  
	$chartdet['strParam']="caption=Products Sold (By Revenue - In Completed Orders);subcaption=From ".date('jS M Y',strtotime($startdate))." to ".date('jS M Y',strtotime($enddate)).";xAxisName=Product;yAxisName=Revenue;decimalPrecision=2; formatNumberScale=1;showBorder=1;pieSliceDepth=30;rotatenames=1;numberPrefix=$;";  
	$chartdet['header'] ="Products Sold (By Revenue)";	
			}				
			else if($id==11)
			{
			$chartdet['sql']= "select count(b.cou_code) as total ,b.cou_name as date from users_table a, country_table  b where a.user_country = b.cou_code and user_status='1' and user_doj <='".$enddate."' and user_doj >='".$startdate."' group by(a.user_country) order by cou_name";
			$chartdet['strParam']="caption=Customers(By Location);subcaption=From ".date('jS M Y',strtotime($startdate))." to ".date('jS M Y',strtotime($enddate)).";xAxisName=Country; yAxisName=Count; decimalPrecision=0; formatNumberScale=1; showBorder=1;pieSliceDepth=30;rotatenames=1;";  
	$chartdet['header'] ="Customers(By Location)";	
			}							
						
		}
		else if(isset($_POST['Calendar']) && $_POST['Calendar']['DateType']=='2')
		{	
		$month = date('m');
			if($id==1)
			{				
		$chartdet['sql']="select count(date_purchased) as total , date_format(date_purchased,'%d-%b-%Y') as date from orders_table where month(date_purchased)='".$month."' and orders_status='3' group by day(date_purchased)";
	$chartdet['strParam']="caption=Completed Orders;subcaption= ".date('F Y')." ;xAxisName=Month;yAxisName=Count;decimalPrecision=0; formatNumberScale=1;showBorder=1;pieSliceDepth=30;";  
	 $chartdet['header'] = "Completed Orders";	 
	 		}
			else if ($id==2)
			{			
		    $chartdet['sql']= "select count(user_id)as total , date_format(user_doj,'%d-%b-%Y') as date from users_table where month(user_doj)='".$month."' group by day(user_doj)";			  
	$chartdet['strParam']="caption=New Customers;subcaption= ".date('F Y')." ;xAxisName=Month;yAxisName=Total;decimalPrecision=0; formatNumberScale=1;showBorder=1;pieSliceDepth=30;";  
	$chartdet['header'] = "New Customers";				
			}	
			else if ($id==3)	
			{
			$chartdet['sql']= "select count(date_purchased)as total , b.name as date from orders_table a , country_table b where month(date_purchased)='".$month."' and a.orders_status='3' and a.shipping_country=b.cou_code group by day(date_purchased),b.name";			  	$chartdet['strParam']="caption=Location Wise Completed Order Details;subcaption=".date('F Y')." ;xAxisName=Locations;yAxisName=Count;decimalPrecision=0; formatNumberScale=1;showBorder=1;pieSliceDepth=30;rotatenames=1";  	$chartdet['header'] = "Location Wise Completed Order Details";			
			}	
			else if($id==4)
			{				
		$chartdet['sql']="select count(date_purchased) as total , date_format(date_purchased,'%d-%b-%Y') as date from orders_table where month(date_purchased)='".$month."' and orders_status='1' group by day(date_purchased)";
	$chartdet['strParam']="caption=Pending Orders;subcaption= ".date('F Y')." ;xAxisName=Month;yAxisName=Count;decimalPrecision=0; formatNumberScale=1;showBorder=1;pieSliceDepth=30;";  
	 $chartdet['header'] = "Pending Orders";	 
	 		}
			else if($id==5)
			{				
		$chartdet['sql']="select count(date_purchased) as total , date_format(date_purchased,'%d-%b-%Y') as date from orders_table where month(date_purchased)='".$month."' and orders_status='2' group by day(date_purchased)";
	$chartdet['strParam']="caption=Orders Under Processing;subcaption= ".date('F Y')." ;xAxisName=Month;yAxisName=Count;decimalPrecision=0; formatNumberScale=1;showBorder=1;pieSliceDepth=30;";  
	 $chartdet['header'] = "Orders Under Processing";	 
	 		}
			else if($id==6)
			{				
		$chartdet['sql']="select count(date_purchased) as total , date_format(date_purchased,'%d-%b-%Y') as date from orders_table where month(date_purchased)='".$month."' and orders_status='4' group by day(date_purchased)";
	$chartdet['strParam']="caption=Orders Awaiting Payment;subcaption= ".date('F Y')." ;xAxisName=Month;yAxisName=Count;decimalPrecision=0; formatNumberScale=1;showBorder=1;pieSliceDepth=30;";  
	 $chartdet['header'] = "Orders Awaiting Payment";	 
	 		}
			else if($id==7)
			{						
		$chartdet['sql']= "select concat(a.product_qty,'-','Product') as date,round((count(a.product_qty)/(select sum(cnt) from (select count(product_qty) as cnt from order_products_table group by product_qty) as t))*100) as total from order_products_table a, orders_table b where a.order_id = b.orders_id and month(date_purchased)='".$month."' group by product_qty";			  	$chartdet['strParam']="caption=Quantity Break Down;subcaption= ".date('F Y').";xAxisName=No of Products Per Order ;yAxisName=Percentage;decimalPrecision=0; formatNumberScale=1;showBorder=1;pieSliceDepth=30;numberSuffix=%25";  	
		$chartdet['header'] ="Quantity Break Down";	
	 		}		
			else if($id==9)
			{
			$chartdet['sql']= "select sum(prd.product_qty)as total,prod.title as date from orders_table ord,order_products_table prd,products_table prod where ord.orders_id = prd.order_id and prd.product_id=prod.product_id and orders_status='3' and month(date_purchased)='".$month."' group by prd.product_id";			  
	$chartdet['strParam']="caption=Products Sold(By Units - In Completed Orders);subcaption=".date('F Y').";xAxisName=Name of the Product;yAxisName=Sold Items in Units;decimalPrecision=0;formatNumberScale=1;showBorder=1;pieSliceDepth=30;rotatenames=1";  
	$chartdet['header'] ="Products Sold (By Units)";	
			}				
			else if($id==10)
			{
			$chartdet['sql']= "select sum(ord.order_total) as total,prod.title as date from orders_table ord,order_products_table prd,products_table prod where ord.orders_id = prd.order_id and prd.product_id=prod.product_id and prd.product_qty<>'0' and orders_status='3' and month(date_purchased)='".$month."' group by prd.product_id";			  
	$chartdet['strParam']="caption=Products Sold (By Revenue - In Completed Orders);subcaption=".date('F Y').";xAxisName=Product;yAxisName=Revenue;decimalPrecision=2; formatNumberScale=1;showBorder=1;pieSliceDepth=30;rotatenames=1;numberPrefix=$;";  
	$chartdet['header'] ="Products Sold (By Revenue)";	
			}		
			else if($id==11)
			{
			$chartdet['sql']= "select count(b.cou_code) as total ,b.cou_name as date from users_table a, country_table  b where a.user_country = b.cou_code and user_status='1' and month(user_doj)='".$month."' group by(a.user_country) order by cou_name";
			$chartdet['strParam']="caption=Customers(By Location);subcaption=".date('F Y').";xAxisName=Country; yAxisName=Count; decimalPrecision=0; formatNumberScale=1; showBorder=1;pieSliceDepth=30;rotatenames=1;";  
	$chartdet['header'] ="Customers(By Location)";	
			}					
				
		}	
		else if(isset($_POST['Calendar']) && $_POST['Calendar']['DateType']=='3')
		{	
			
			$month = date('m', strtotime("-30 days"));		
			
			if($id==1)
			{						
		$chartdet['sql']="select count(date_purchased) as total , date_format(date_purchased,'%d-%b-%Y') as date from orders_table where month(date_purchased)='".$month."' and orders_status='3' group by day(date_purchased)";
	$chartdet['strParam']="caption=Completed Orders;subcaption= ".date('F Y', strtotime("-30 days"))." ;xAxisName=Month;yAxisName=Count;decimalPrecision=0; formatNumberScale=1;showBorder=1;pieSliceDepth=30;";  
	 $chartdet['header'] = "Completed Orders";	 
	 		}
			else if ($id==2)
			{			
		    $chartdet['sql']= "select count(user_id)as total , date_format(user_doj,'%d-%b-%Y') as date from users_table where month(user_doj) ='".$month."' group by day(user_doj)";			  
	$chartdet['strParam']="caption=New Customers;subcaption= ".date('F Y', strtotime("-30 days"))." ;xAxisName=Month;yAxisName=Total;decimalPrecision=0; formatNumberScale=1;showBorder=1;pieSliceDepth=30;";  
	$chartdet['header'] = "New Customers";				
			}	
			else if ($id==3)	
			{
			$chartdet['sql']= "select count(date_purchased)as total , b.name as date from orders_table a , country_table b where month(date_purchased)='".$month."' and a.orders_status='3' and a.shipping_country=b.cou_code group by day(date_purchased),b.name";			  	$chartdet['strParam']="caption=Location Wise Completed Order Details;subcaption=".date('F Y', strtotime("-30 days"))." ;xAxisName=Locations;yAxisName=Count;decimalPrecision=0; formatNumberScale=1;showBorder=1;pieSliceDepth=30;rotatenames=1";  	$chartdet['header'] = "Location Wise Completed Order Details";				
			}
			else if($id==4)
			{						
		$chartdet['sql']="select count(date_purchased) as total , date_format(date_purchased,'%d-%b-%Y') as date from orders_table where month(date_purchased)='".$month."' and orders_status='1' group by day(date_purchased)";
	$chartdet['strParam']="caption=Pending Orders;subcaption= ".date('F Y', strtotime("-30 days"))." ;xAxisName=Month;yAxisName=Count;decimalPrecision=0; formatNumberScale=1;showBorder=1;pieSliceDepth=30;";  
	 $chartdet['header'] = "Pending Orders";	 
	 		}
			else if($id==5)
			{						
		$chartdet['sql']="select count(date_purchased) as total , date_format(date_purchased,'%d-%b-%Y') as date from orders_table where month(date_purchased)='".$month."' and orders_status='2' group by day(date_purchased)";
	$chartdet['strParam']="caption=Orders Under Processing;subcaption= ".date('F Y', strtotime("-30 days"))." ;xAxisName=Month;yAxisName=Count;decimalPrecision=0; formatNumberScale=1;showBorder=1;pieSliceDepth=30;";  
	 $chartdet['header'] = "Orders Under Processing";	 
	 		}			
			else if($id==6)
			{						
		$chartdet['sql']="select count(date_purchased) as total , date_format(date_purchased,'%d-%b-%Y') as date from orders_table where month(date_purchased)='".$month."' and orders_status='4' group by day(date_purchased)";
	$chartdet['strParam']="caption=Orders Awaiting Payment;subcaption= ".date('F Y', strtotime("-30 days"))." ;xAxisName=Month;yAxisName=Count;decimalPrecision=0; formatNumberScale=1;showBorder=1;pieSliceDepth=30;";  
	 $chartdet['header'] = "Orders Awaiting Payment";	 
	 		}
			else if($id==7)
			{						
		$chartdet['sql']= "select concat(a.product_qty,'-','Product') as date,round((count(a.product_qty)/(select sum(cnt) from (select count(product_qty) as cnt from order_products_table group by product_qty) as t))*100) as total from order_products_table a, orders_table b where a.order_id = b.orders_id and month(date_purchased)='".$month."' group by product_qty";			  	$chartdet['strParam']="caption=Quantity Break Down;subcaption= ".date('F Y', strtotime("-30 days")).";xAxisName=No of Products Per Order;yAxisName=Percentage;decimalPrecision=0; formatNumberScale=1;showBorder=1;pieSliceDepth=30;numberSuffix=%25";  	
		$chartdet['header'] ="Quantity Break Down";	
	 		}
			else if($id==9)
			{
			$chartdet['sql']= "select sum(prd.product_qty)as total,prod.title as date from orders_table ord,order_products_table prd,products_table prod where ord.orders_id = prd.order_id and prd.product_id=prod.product_id and orders_status='3' and month(date_purchased)='".$month."' group by prd.product_id";			  
	$chartdet['strParam']="caption=Products Sold (By Units - In Completed Orders);subcaption= ".date('F Y', strtotime("-30 days")).";xAxisName=Name of the Product;yAxisName=Sold Items in Units;decimalPrecision=0;formatNumberScale=1;showBorder=1;pieSliceDepth=30;rotatenames=1";  
	$chartdet['header'] ="Products Sold (By Units)";	
			}
			else if($id==10)
			{
			$chartdet['sql']= "select sum(ord.order_total) as total,prod.title as date from orders_table ord,order_products_table prd,products_table prod where ord.orders_id = prd.order_id and prd.product_id=prod.product_id and prd.product_qty<>'0' and orders_status='3' and month(date_purchased)='".$month."' group by prd.product_id";			  
	$chartdet['strParam']="caption=Products Sold (By Revenue - In Completed Orders);subcaption= ".date('F Y', strtotime("-30 days")).";xAxisName=Product;yAxisName=Revenue;decimalPrecision=2; formatNumberScale=1;showBorder=1;pieSliceDepth=30;rotatenames=1;numberPrefix=$;";  
	$chartdet['header'] ="Products Sold (By Revenue)";	
			}
			else if($id==11)
			{
			$chartdet['sql']= "select count(b.cou_code) as total ,b.cou_name as date from users_table a, country_table  b where a.user_country = b.cou_code and user_status='1' and month(user_doj)='".$month."' group by(a.user_country) order by cou_name";
			$chartdet['strParam']="caption=Customers(By Location);subcaption= ".date('F Y', strtotime("-30 days")).";xAxisName=Country; yAxisName=Count; decimalPrecision=0; formatNumberScale=1; showBorder=1;pieSliceDepth=30;rotatenames=1;";  
	$chartdet['header'] ="Customers(By Location)";	
			}								
			
		}			
		else if(isset($_POST['Calendar']) && $_POST['Calendar']['DateType']=='4')
		{		
			if($id==1)
			{	
		$chartdet['sql']= "select count(date_purchased) as total, date_format(date_purchased,'%Y') as date from orders_table where orders_status='3' group by year(date_purchased)";			  
	$chartdet['strParam']="caption=Completed Orders;subcaption=From January to December;xAxisName=Month;yAxisName=Count;decimalPrecision=0; formatNumberScale=1;showBorder=1;pieSliceDepth=30;";  
	$chartdet['header'] = "Completed Orders";	
	 		}
			else if ($id==2)
			{			
		    $chartdet['sql']= "select count(user_id)as total , date_format(user_doj,'%Y') as date from users_table group by year(user_doj)";			  
	$chartdet['strParam']="caption=New Customers;subcaption= From January to December; xAxisName=Month;yAxisName=Total;decimalPrecision=0; formatNumberScale=1;showBorder=1;pieSliceDepth=30;";  
	$chartdet['header'] = "New Customers";				
			}
			else if ($id==3)	
			{
			$chartdet['sql']= "select count(date_purchased)as total , concat(ucase(date_format(a.date_purchased,'%Y')),'-',b.name) as date from orders_table a ,country_table b where a.orders_status='3' and a.shipping_country=b.cou_code group by year(date_purchased),b.name";			  
	$chartdet['strParam']="caption=Location Wise Completed Order Details;subcaption=From January to December; xAxisName=Locations;yAxisName=Count;decimalPrecision=0; formatNumberScale=1;showBorder=1;pieSliceDepth=30;rotatenames=1";
	  	$chartdet['header'] = "Location Wise Completed Order Details";				
			}
			else if($id==4)
			{	
		$chartdet['sql']= "select count(date_purchased) as total, date_format(date_purchased,'%Y') as date from orders_table where orders_status='1' group by year(date_purchased)";			  
	$chartdet['strParam']="caption=Pending Orders;subcaption=From January to December;xAxisName=Month;yAxisName=Count;decimalPrecision=0; formatNumberScale=1;showBorder=1;pieSliceDepth=30;";  
	$chartdet['header'] = "Pending Orders";	
	 		}
			else if($id==5)
			{	
		$chartdet['sql']= "select count(date_purchased) as total, date_format(date_purchased,'%Y') as date from orders_table where orders_status='2' group by year(date_purchased)";			  
	$chartdet['strParam']="caption=Orders Under Processing;subcaption=From January to December;xAxisName=Month;yAxisName=Count;decimalPrecision=0; formatNumberScale=1;showBorder=1;pieSliceDepth=30;";  
	$chartdet['header'] = "Orders Under Processing";	
	 		}
			else if($id==6)
			{	
		$chartdet['sql']= "select count(date_purchased) as total, date_format(date_purchased,'%Y') as date from orders_table where orders_status='4' group by year(date_purchased)";			  
	$chartdet['strParam']="caption=Orders Awaiting Payment;subcaption=From January to December;xAxisName=Month;yAxisName=Count;decimalPrecision=0; formatNumberScale=1;showBorder=1;pieSliceDepth=30;";  
	$chartdet['header'] = "Orders Awaiting Payment";	
	 		}
			else if($id==7)
			{						
		  $chartdet['sql']= "select concat(a.product_qty,'-','Product') as date,round((count(a.product_qty)/(select sum(cnt) from (select count(product_qty) as cnt from order_products_table group by product_qty) as t))*100) as total from order_products_table a, orders_table b where a.order_id = b.orders_id group by product_qty,year(b.date_purchased)";			  
	$chartdet['strParam']="caption=Quantity Break Down;subcaption= From January to December;xAxisName=No of Products Per Order;yAxisName=Percentage;decimalPrecision=0; formatNumberScale=1;showBorder=1;pieSliceDepth=30;numberSuffix=%25";  	
	$chartdet['header'] ="Quantity Break Down";	
			}	
			else if($id==9)
			{
			$chartdet['sql']= "select sum(prd.product_qty)as total,concat(year(date_purchased),'-',prod.title) as date from orders_table ord,order_products_table prd,products_table prod where ord.orders_id = prd.order_id and prd.product_id=prod.product_id and orders_status='3' group by prd.product_id,year(date_purchased)";			  
	$chartdet['strParam']="caption=Products Sold (By Units - In Completed Orders);subcaption=From January to December;xAxisName=Name of the Product;yAxisName=Sold Items in Units;decimalPrecision=0;formatNumberScale=1;showBorder=1;pieSliceDepth=30;rotatenames=1";  
	$chartdet['header'] ="Products Sold (By Units)";	
			}
			else if($id==10)
			{
			$chartdet['sql']= "select sum(ord.order_total) as total,prod.title as date from orders_table ord,order_products_table prd,products_table prod where ord.orders_id = prd.order_id and prd.product_id=prod.product_id and prd.product_qty<>'0' and orders_status='3' group by prd.product_id,year(date_purchased)";			  
	$chartdet['strParam']="caption=Products Sold (By Revenue - In Completed Orders);subcaption=From January to December;xAxisName=Product;yAxisName=Revenue;decimalPrecision=2; formatNumberScale=1;showBorder=1;pieSliceDepth=30;rotatenames=1;numberPrefix=$;";  
	$chartdet['header'] ="Products Sold (By Revenue)";	
			}	
			else if($id==11)
			{
			$chartdet['sql']= "select count(b.cou_code) as total ,b.cou_name as date from users_table a, country_table  b where a.user_country = b.cou_code and user_status='1' group by(a.user_country),year(user_doj) order by cou_name";
			$chartdet['strParam']="caption=Customers(By Location);subcaption=From January to December;xAxisName=Country; yAxisName=Count; decimalPrecision=0; formatNumberScale=1; showBorder=1;pieSliceDepth=30;rotatenames=1;";  
	$chartdet['header'] ="Customers(By Location)";	
			}				
		
		}
		else if(isset($_POST['Calendar']) && $_POST['Calendar']['DateType']=='5')
		{		
		
		$frmmnth = $_POST['Calendar']['From']['Mth'];
		$frmyr = $_POST['Calendar']['From']['Yr'];
		$tomnth = $_POST['Calendar']['To']['Mth'];
		$toyr = $_POST['Calendar']['To']['Yr'];	
		$makefrmmnth=getdate(mktime(0,0,0,$frmmnth,1,$frmyr)); 
		$maketomnth=getdate(mktime(0,0,0,$tomnth,1,$toyr)); 		
				
			if($id==1)
			{
			$chartdet['sql']="select count(date_purchased) as total , date_format(date_purchased,'%b') as date from orders_table where month(date_purchased) between '".$frmmnth."' and '".$tomnth."' and year(date_purchased) between '".$frmyr."' and '".$toyr."' and orders_status='3' group by month(date_purchased)";
		
	$chartdet['strParam']="caption=Completed Orders;subcaption= From ".$makefrmmnth['month']." ".$makefrmmnth['year']." To ".$maketomnth['month']." ".$maketomnth['year'].";xAxisName=Month;yAxisName=Count;decimalPrecision=0; formatNumberScale=1;showBorder=1;pieSliceDepth=30;";  
	 $chartdet['header'] = "Completed Orders";	 
	 		}
			else if ($id==2)
			{			
		    $chartdet['sql']= "select count(user_id)as total , date_format(user_doj,'%b') as date from users_table where month(user_doj) between '".$frmmnth."' and '".$tomnth."' and year(user_doj) between '".$frmyr."' and '".$toyr."' group by month(user_doj) ";			  
	$chartdet['strParam']="caption=New Customers;subcaption= From ".$makefrmmnth['month']." ".$makefrmmnth['year']." To ".$maketomnth['month']." ".$maketomnth['year']."; xAxisName=Month;yAxisName=Total;decimalPrecision=0; formatNumberScale=1;showBorder=1;pieSliceDepth=30;";  
	$chartdet['header'] = "New Customers";				
			}
			else if ($id==3)	
			{
			$chartdet['sql']= "select count(date_purchased)as total , concat(ucase(date_format(a.date_purchased,'%b')),'-',b.name) as date from orders_table a , country_table b where month(date_purchased) between '".$frmmnth."' and '".$tomnth."' and year(date_purchased) between '".$frmyr."' and '".$toyr."' and a.orders_status='3' and a.shipping_country=b.cou_code group by month(date_purchased),b.name";			  
	$chartdet['strParam']="caption=Location Wise Completed Order Details;subcaption=From ".$makefrmmnth['month']." ".$makefrmmnth['year']." To ".$maketomnth['month']." ".$maketomnth['year']."; xAxisName=Locations;yAxisName=Count;decimalPrecision=0; formatNumberScale=1;showBorder=1;pieSliceDepth=30;rotatenames=1";  	
	$chartdet['header'] = "Location Wise Completed Order Details";			
			}				
			else if($id==4)
			{						
		 $chartdet['sql']="select count(date_purchased) as total , date_format(date_purchased,'%b') as date from orders_table where month(date_purchased) between '".$frmmnth."' and '".$tomnth."' and year(date_purchased) between '".$frmyr."' and '".$toyr."' and orders_status='1' group by month(date_purchased)";	  
	$chartdet['strParam']="caption=Pending Orders;subcaption=From ".$makefrmmnth['month']." ".$makefrmmnth['year']." To ".$maketomnth['month']." ".$maketomnth['year'].";xAxisName=Month;yAxisName=Count;decimalPrecision=0; formatNumberScale=1;showBorder=1;pieSliceDepth=30;";  
	$chartdet['header'] = "Pending Orders";	
			}			
			else if($id==5)
			{
			$chartdet['sql']="select count(date_purchased) as total , date_format(date_purchased,'%b') as date from orders_table where month(date_purchased) between '".$frmmnth."' and '".$tomnth."' and year(date_purchased) between '".$frmyr."' and '".$toyr."' and orders_status='2' group by month(date_purchased)";
		
	$chartdet['strParam']="caption=Orders Under Processing;subcaption= From ".$makefrmmnth['month']." ".$makefrmmnth['year']." To ".$maketomnth['month']." ".$maketomnth['year'].";xAxisName=Month;yAxisName=Count;decimalPrecision=0; formatNumberScale=1;showBorder=1;pieSliceDepth=30;";  
	 $chartdet['header'] = "Orders Under Processing";	 
	 		}
			else if($id==6)
			{
			$chartdet['sql']="select count(date_purchased) as total , date_format(date_purchased,'%b') as date from orders_table where month(date_purchased) between '".$frmmnth."' and '".$tomnth."' and year(date_purchased) between '".$frmyr."' and '".$toyr."' and orders_status='4' group by month(date_purchased)";
		
	$chartdet['strParam']="caption=Orders Awaiting Payment;subcaption= From ".$makefrmmnth['month']." ".$makefrmmnth['year']." To ".$maketomnth['month']." ".$maketomnth['year'].";xAxisName=Month;yAxisName=Count;decimalPrecision=0; formatNumberScale=1;showBorder=1;pieSliceDepth=30;";  
	 $chartdet['header'] = "Orders Awaiting Payment";	 
	 		}
			else if($id==7)
			{						
		 $chartdet['sql']= "select concat(a.product_qty,'-','Product') as date,round((count(a.product_qty)/(select sum(cnt) from (select count(product_qty) as cnt from order_products_table group by product_qty) as t))*100) as total from order_products_table a, orders_table b where a.order_id = b.orders_id and month(b.date_purchased) between '".$frmmnth."' and '".$tomnth."' and year(b.date_purchased) between '".$frmyr."' and '".$toyr."' group by product_qty";			  
	$chartdet['strParam']="caption=Quantity Break Down;subcaption= From ".$makefrmmnth['month']." ".$makefrmmnth['year']." To ".$maketomnth['month']." ".$maketomnth['year'].";xAxisName=No of Products Per Order;yAxisName=Percentage;decimalPrecision=0; formatNumberScale=1;showBorder=1;pieSliceDepth=30;numberSuffix=%25";  
	$chartdet['header'] ="Quantity Break Down";	
			}	
			else if($id==9)
			{
			$chartdet['sql']= "select sum(prd.product_qty)as total,concat(prod.title) as date from orders_table ord,order_products_table prd,products_table prod where ord.orders_id = prd.order_id and prd.product_id=prod.product_id and month(date_purchased) between '".$frmmnth."' and '".$tomnth."' and year(date_purchased) between '".$frmyr."' and '".$toyr."' and orders_status='3' group by prd.product_id";			  
	$chartdet['strParam']="caption=Products Sold (By Units - In Completed Orders);subcaption=From ".$makefrmmnth['month']." ".$makefrmmnth['year']." To ".$maketomnth['month']." ".$maketomnth['year'].";xAxisName=Name of the Product;yAxisName=Sold Items in Units;decimalPrecision=0;formatNumberScale=1;showBorder=1;pieSliceDepth=30;rotatenames=1";  
	$chartdet['header'] ="Products Sold (By Units)";	
			}	
			else if($id==10)
			{
			$chartdet['sql']= "select sum(ord.order_total) as total,prod.title as date from orders_table ord,order_products_table prd,products_table prod where ord.orders_id = prd.order_id and prd.product_id=prod.product_id and prd.product_qty<>'0' and orders_status='3' and month(date_purchased) between '".$frmmnth."' and '".$tomnth."' and year(date_purchased) between '".$frmyr."' and '".$toyr."' group by prd.product_id";			  
	$chartdet['strParam']="caption=Products Sold (By Revenue - In Completed Orders);subcaption=From ".$makefrmmnth['month']." ".$makefrmmnth['year']." To ".$maketomnth['month']." ".$maketomnth['year'].";xAxisName=Product;yAxisName=Revenue;decimalPrecision=2; formatNumberScale=1;showBorder=1;pieSliceDepth=30;rotatenames=1;numberPrefix=$;";  
	$chartdet['header'] ="Products Sold (By Revenue)";	
			}	
			else if($id==11)
			{
			$chartdet['sql']= "select count(b.cou_code) as total ,b.cou_name as date from users_table a, country_table  b where a.user_country = b.cou_code and user_status='1' and month(user_doj) between '".$frmmnth."' and '".$tomnth."' and year(user_doj) between '".$frmyr."' and '".$toyr."' group by(a.user_country) order by cou_name";
			$chartdet['strParam']="caption=Customers(By Location);subcaption=From ".$makefrmmnth['month']." ".$makefrmmnth['year']." To ".$maketomnth['month']." ".$maketomnth['year']."; xAxisName=Country; yAxisName=Count; decimalPrecision=0; formatNumberScale=1; showBorder=1;pieSliceDepth=30;rotatenames=1;";  
	$chartdet['header'] ="Customers(By Location)";	
			}				
					
		
		}										
		else
		{
			$curyear = date('Y');		
			if($id==1)
			{						
		 $chartdet['sql']= "select count(date_purchased)as total , date_format(date_purchased,'%b') as date from orders_table where orders_status='3' and year(date_purchased)='".$curyear."' group by month(date_purchased)";			  
	$chartdet['strParam']="caption=Completed Orders;subcaption=From January ".$curyear." to December ".$curyear." ;xAxisName=Month;yAxisName=Count;decimalPrecision=0; formatNumberScale=1;showBorder=1;pieSliceDepth=30;";  
	$chartdet['header'] = "Completed Orders";	
			}	
			else if ($id==2)
			{			
		    $chartdet['sql']= "select count(user_id)as total , date_format(user_doj,'%b') as date from users_table where year(user_doj)='".$curyear."' group by month(user_doj)";			  
	$chartdet['strParam']="caption=New Customers;subcaption=From January ".$curyear." to December ".$curyear.";xAxisName=Month;yAxisName=Total;decimalPrecision=0; formatNumberScale=1;showBorder=1;pieSliceDepth=30;";  
	$chartdet['header'] = "New Customers";				
			}				
			else if ($id==3)	
			{
			$chartdet['sql']= "select count(date_purchased)as total , concat(ucase(date_format(a.date_purchased,'%b')),'-',b.name) as date from orders_table a , country_table b where a.orders_status='3' and a.shipping_country=b.cou_code group by month(date_purchased),b.name";			  
	$chartdet['strParam']="caption=Location Wise Completed Order Details;subcaption=From January ".$curyear." to December ".$curyear.";xAxisName=Locations;yAxisName=Count;decimalPrecision=0; formatNumberScale=1;showBorder=1;pieSliceDepth=30;rotatenames=1";  	$chartdet['header'] = "Location Wise Completed Order Details";				
			}		
			else if($id==4)
			{						
		 $chartdet['sql']= "select count(date_purchased)as total , date_format(date_purchased,'%b') as date from orders_table where orders_status='1' and year(date_purchased)='".$curyear."' group by month(date_purchased)";			  
	$chartdet['strParam']="caption=Pending Orders;subcaption=From January ".$curyear." to December ".$curyear." ;xAxisName=Month;yAxisName=Count;decimalPrecision=0; formatNumberScale=1;showBorder=1;pieSliceDepth=30;";  
	$chartdet['header'] = "Pending Orders";	
			}				
			else if($id==5)
			{						
		 $chartdet['sql']= "select count(date_purchased)as total , date_format(date_purchased,'%b') as date from orders_table where orders_status='2' and year(date_purchased)='".$curyear."' group by month(date_purchased)";			  
	$chartdet['strParam']="caption=Orders Under Processing;subcaption=From January ".$curyear." to December ".$curyear." ;xAxisName=Month;yAxisName=Count;decimalPrecision=0; formatNumberScale=1;showBorder=1;pieSliceDepth=30;";  
	$chartdet['header'] = "Orders Under Processing";	
			}	
			else if($id==6)
			{						
		 $chartdet['sql']= "select count(date_purchased)as total , date_format(date_purchased,'%b') as date from orders_table where orders_status='4' and year(date_purchased)='".$curyear."' group by month(date_purchased)";			  
	$chartdet['strParam']="caption=Orders Awaiting Payment;subcaption=From January ".$curyear." to December ".$curyear." ;xAxisName=Month;yAxisName=Count;decimalPrecision=0; formatNumberScale=1;showBorder=1;pieSliceDepth=30;";  
	$chartdet['header'] = "Orders Awaiting Payment";	
			}				
			else if($id==7)
			{						
		  $chartdet['sql']= "select concat(a.product_qty,'-','Product') as date,round((count(a.product_qty)/(select sum(cnt) from (select count(product_qty) as cnt from order_products_table group by product_qty) as t))*100) as total from order_products_table a, orders_table b where a.order_id = b.orders_id and year(b.date_purchased)='".$curyear."' group by product_qty";			  
	$chartdet['strParam']="caption=Quantity Break Down;subcaption=From January ".$curyear." to December ".$curyear." ;xAxisName=No of Products Per Order;yAxisName=Percentage;decimalPrecision=0; formatNumberScale=1;showBorder=1;pieSliceDepth=30;numberSuffix=%25";  
	$chartdet['header'] ="Quantity Break Down";	
			}		
			else if($id==8)
			{
			$chartdet['sql']= "SELECT sum(orders.product_qty) AS total , concat(substring(prod.title,1,10),'...')  as date FROM order_products_table orders , products_table prod WHERE orders.product_id=prod.product_id and prod.intro_date <= now() AND status=1 GROUP BY orders.product_id ORDER BY total DESC LIMIT 0,10";			  
	$chartdet['strParam']="caption=Best Selling Products (Top-10);xAxisName=Name Of the Product;yAxisName=Sold Items in Nos;decimalPrecision=0; formatNumberScale=1;showBorder=1;pieSliceDepth=30;rotatenames=1";  
	$chartdet['header'] ="Best Selling Products";	
			}		
			else if($id==9)
			{
			$chartdet['sql']= "select sum(prd.product_qty)as total,prod.title as date from orders_table ord,order_products_table prd,products_table prod where ord.orders_id = prd.order_id and prd.product_id=prod.product_id and year(date_purchased)='".$curyear."' and orders_status='3' group by prd.product_id";			  
	$chartdet['strParam']="caption=Products Sold (By Units - In Completed Orders);subcaption=From January ".$curyear." to December ".$curyear." ;xAxisName=Name of the Product;yAxisName=Sold Items in Units;decimalPrecision=0; formatNumberScale=1;showBorder=1;pieSliceDepth=30;rotatenames=1";  
	$chartdet['header'] ="Products Sold (By Units)";	
			}
			else if($id==10)
			{
			$chartdet['sql']= "select sum(ord.order_total) as total,prod.title as date from orders_table ord,order_products_table prd,products_table prod where ord.orders_id = prd.order_id and prd.product_id=prod.product_id and prd.product_qty<>'0' and orders_status='3' and year(date_purchased)='".$curyear."' group by prd.product_id";			  
	$chartdet['strParam']="caption=Products Sold (By Revenue - In Completed Orders);subcaption=From January ".$curyear." to December ".$curyear." ;xAxisName=Product;yAxisName=Revenue;decimalPrecision=2; formatNumberScale=1;showBorder=1;pieSliceDepth=30;rotatenames=1;numberPrefix=$;";  
	$chartdet['header'] ="Products Sold (By Revenue)";	
			}	
			else if($id==11)
			{
			$chartdet['sql']= "select count(b.cou_code) as total ,b.cou_name as date from users_table a, country_table  b where a.user_country = b.cou_code and user_status='1' and year(user_doj)='".$curyear."' group by(a.user_country) order by cou_name";			  	$chartdet['strParam']="caption=Customers(By Location);subcaption=From January ".$curyear." to December ".$curyear." ;xAxisName=Country;yAxisName=Count;decimalPrecision=0;formatNumberScale=1;showBorder=1;pieSliceDepth=30;rotatenames=1;";  
	$chartdet['header'] ="Customers(By Location)";	
			}		
			else if($id==12)
			{
			$chartdet['sql']= "select round((count(*)/(select count(*) from users_table))*100) as total,'Joined Today' as date from users_table where user_doj >= DATE_SUB(CURDATE(), INTERVAL 1 DAY) union 
select round((count(*)/(select count(*) from users_table))*100) as total,'1 Week Old' as date from users_table where user_doj <= DATE_SUB(CURDATE(), INTERVAL 1 DAY ) AND user_doj >= DATE_SUB(CURDATE(), INTERVAL 7 DAY) union
select round((count(*)/(select count(*) from users_table))*100) as total,'One Month Old' as date from users_table where user_doj <= DATE_SUB(CURDATE(), INTERVAL 7 DAY ) AND user_doj >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH)  union select round((count(*)/(select count(*) from users_table))*100) as total,'Three Month Old' as date from users_table where user_doj <= DATE_SUB(CURDATE(), INTERVAL 1 MONTH) AND user_doj >= DATE_SUB(CURDATE(), INTERVAL 3 MONTH) union select round((count(*)/(select count(*) from users_table))*100) as total,'Less than 1 Year' as date from users_table where user_doj <= DATE_SUB(CURDATE(), INTERVAL 3 MONTH) AND user_doj >= DATE_SUB(CURDATE(), INTERVAL 1 YEAR) union select round((count(*)/(select count(*) from users_table))*100) as total,'Greater than 1 Year' as date from users_table where user_doj <= DATE_SUB(CURDATE(), INTERVAL 1 YEAR)";
			$chartdet['strParam']="caption=Customers Seniority;subcaption=From January to December; xAxisName=Seniority;yAxisName=Percentage;decimalPrecision=0;formatNumberScale=1;showBorder=1;pieSliceDepth=30;rotatenames=1;numberSuffix=%25";  
	$chartdet['header'] ="Customers Seniority";	
			}		
		}		
			
	return $chartdet;
	}
	
	
	/**
	 * Function generates an xml file for generating the chart
	 * 
	 * @param string $sql
	 * @param array $strParam
	 * 
	 * @return xml
	 */
	function generateXML($sql,$strParam)
	{	

		include("../includes/FusionCharts_Gen.php");    
		$FC = new FusionCharts("Column3D","900","500");  
		$FC->setChartParams($strParam);  		
		//$FC->AddColors("FF0000;00FF00;0000FF;FFFF00;FF00FF;FCAAAA");	  
			$obj=new Bin_Query();			
			$arrdata = array();
				if($obj->executeQuery($sql))
				{				
					$arr = $obj->records;	
					for($i=0;$i<count($arr);$i++)
					{						
					$arrdata[$i][0] = $arr[$i]['date'];
					$arrdata[$i][1] = $arr[$i]['total'];			
					}		
				$FC->addChartDataFromArray($arrdata);		
				} 
			header('Content-type: text/xml');
			$xml = $FC->getXML();	
			header('Content-type: text/html');
			return $xml;	
	}
	
	
	
}
?>