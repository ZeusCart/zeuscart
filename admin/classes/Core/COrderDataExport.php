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
 * This class contains functions to export the order details to a file format.
 *
 * @package  		Core_COrderDataExport
 * @category  		Core
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
   * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */


class Core_COrderDataExport
{
 	
	/**
	 * Function converts the order details from the database into an Excel/CSV/TSV/XML format.
	 * 
	 * 
	 * @return file
	 */
	
	function OrderDataExport()
	{
		   		
		if($_POST['export'] =='excel')
		{			
			include("classes/Lib/excelwriter.inc.php");   
			$excel=new ExcelWriter("order_Detail.xls");
			
			if($excel==false)	
				echo $excel->error;
			$myArr=array("SlNo","Orders Id","Shipping Name","Street Address","Suburb","City","State","Billing Company");
			$excel->writeLine($myArr);
			 $j=1;
			$sql ='select orders_id,shipping_name,shipping_street_address,shipping_suburb,shipping_city,shipping_state,billing_company from orders_table';
			$obj = new Bin_Query();
			if($obj->executeQuery($sql))
			{
				$cnt=count($obj->records);
				for($i=0;$i<$cnt;$i++)
				{
					$orders_id = $obj->records[$i]['orders_id'];
					$shipping_name = $obj->records[$i]['shipping_name'];
					$shipping_street_address = $obj->records[$i]['shipping_street_address'];
					$shipping_suburb = $obj->records[$i]['shipping_suburb'];
					$shipping_city = $obj->records[$i]['shipping_city'];
					$shipping_state = $obj->records[$i]['shipping_state'];
					$billing_company = $obj->records[$i]['billing_company'];
					
					//$doj =  $obj->records[$i]['user_doj'];
					
					$excel->writeRow();
					$excel->writeCol($j);
					$excel->writeCol($orders_id);
					$excel->writeCol($shipping_name);
					$excel->writeCol($shipping_street_address);
					$excel->writeCol($shipping_suburb);
					$excel->writeCol($shipping_city);
					$excel->writeCol($shipping_state);
					$excel->writeCol($billing_company);
					//$excel->writeCol($doj);
					$j++;
				}
				$excel->close();
			}
			if(strpos($_SERVER['USER'],'MSIE'))
			{
				// IE cannot download from sessions without a cache
				header('Cache-Control: public');
			}
			else
			{
				//header("Cache-Control: no-cache, must-revalidate");
				header("Cache-Control: no-cache");
			}
			$file="order_Detail.xls";
			//chmod ($file, 0755);
			header("Pragma: no-cache");
			header("Content-Type: php/doc/xml/html/htm/asp/jpg/JPG/sql/txt/jpeg/gif/bmp/png/xls/csv/x-ms-asf\n");
			header("Connection: close");
			header("Content-Disposition: attachment; filename=".$file."\n");
			header("Content-Transfer-Encoding: binary\n");
			header("Content-length: ".(string)(filesize("$file")));
			$fd=fopen($file,"rb");
			fpassthru($fd);			
			}
			
			/*else if($_POST['export'] =='xml')
			{
			
				
					$sqlselect = "select orders_id,shipping_name,shipping_street_address,shipping_suburb,shipping_city,shipping_state,billing_company from orders_table";
					
					$obj = new Bin_Query();
					if($obj->executeQuery($sqlselect))
					{
						header("Content-Type: text/xml");
						header("Pragma: public");
						header("Expires: 0");
						header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
						header("Content-Type: xml/force-download");
						header("Content-Type: xml/octet-stream");
						header("Content-Type: xml/download");
						header("Content-Disposition: attachment;filename=order_details.xml"); 
						header("Content-Transfer-Encoding: binary ");
						echo("<?xml version=\"1.0\" encoding=\"UTF-8\" ?>\n");
						echo("<orderdetails>\n");
						$count=count($obj->records);
						for($i=0;$i<$count;$i++)
						{							
							echo ("<orderid>".$obj->records[$i]['orders_id']."</orderid>\n");
							echo ("<shippingname>". $obj->records[$i]['shipping_name'] ."</shippingname>\n");
							echo ("<shippingstreetaddress>". $obj->records[$i]['shipping_street_address'] ."</shippingstreetaddress>\n");
							echo ("<shippingsuburb>". $obj->records[$i]['shipping_suburb'] ."</shippingsuburb>\n");
							echo ("<shippingcity>". $obj->records[$i]['shipping_city'] ."</shippingcity>\n");
							echo ("<shippingstate>". $obj->records[$i]['shipping_state'] ."</shippingstate>\n");
						}
						echo("</orderdetails>\n");
						exit();
				   }
			  }*/
			
			
			else if($_POST['export'] =='xml')
			{
			
				
					$sqlselect = "select orders_id,shipping_name,shipping_street_address,shipping_suburb,shipping_city,shipping_state,billing_company from orders_table";
					
					$obj = new Bin_Query();
					if($obj->executeQuery($sqlselect))
					{
						header("Content-Type: text/xml");
						header("Pragma: public");
						header("Expires: 0");
						header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
						header("Content-Type: xml/force-download");
						header("Content-Type: xml/octet-stream");
						header("Content-Type: xml/download");
						header("Content-Disposition: attachment;filename=order_details.xml"); 
						header("Content-Transfer-Encoding: binary ");
						echo("<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n");
						echo("<orderdetails>\n");
						$count=count($obj->records);
						for($i=0;$i<$count;$i++)
						{							
							
							echo ("<orderid>".$obj->records[$i]['orders_id']."</orderid>\n");
							echo ("<shipping_name>".$obj->records[$i]['shipping_name']."</shipping_name>\n");
							echo ("<shipping_street_address>".$obj->records[$i]['shipping_street_address']."</shipping_street_address>\n");
						echo ("<shipping_suburb>".$obj->records[$i]['shipping_suburb']."</shipping_suburb>\n");
							echo ("<shipping_city>". $obj->records[$i]['shipping_city'] ."</shipping_city>\n");
							echo ("<shipping_state>". $obj->records[$i]['shipping_state'] ."</shipping_state>\n");
						}
						echo("</orderdetails>\n");
						exit();
				   }
			  }
			  
			  else if($_POST['export'] =='csv')
			  {
					$csv_terminated = "\n";
					$csv_separator = ",";
					$csv_enclosed = '"';
					$csv_escaped = "\\";
				   $sqlselect = "select orders_id,shipping_name,shipping_street_address,shipping_suburb,shipping_city,shipping_state,billing_company from orders_table";
				   $obj = new Bin_Query();
				   if($obj->executeQuery($sqlselect))
				   {
						$schema_insert = '';
						$schema_insert  .= $csv_enclosed.Orderid.$csv_enclosed.$csv_separator;
						$schema_insert  .= $csv_enclosed.ShippingName.$csv_enclosed.$csv_separator;
						$schema_insert  .= $csv_enclosed.ShippingStreetAddress.$csv_enclosed.$csv_separator;
						$schema_insert  .= $csv_enclosed.ShippingSuburb.$csv_enclosed.$csv_separator;
						$schema_insert  .= $csv_enclosed.ShippingCity.$csv_enclosed.$csv_separator;
						$schema_insert  .= $csv_enclosed.ShippingState.$csv_enclosed.$csv_separator;
						$schema_insert  .= $csv_enclosed.BillingCompany.$csv_enclosed;
						
					   $count=count($obj->records);
						for ($i = 0; $i < $count; $i++)
						{
							$schema_insert .= $csv_enclosed .$obj->records[$i]['orders_id']. $csv_enclosed.$csv_separator;
							$schema_insert .= $csv_enclosed.$obj->records[$i]['shipping_name'].$csv_enclosed.$csv_separator;
						$schema_insert .= $csv_enclosed .$obj->records[$i]['shipping_street_address'].$csv_enclosed.$csv_separator;
							$schema_insert .= $csv_enclosed .$obj->records[$i]['shipping_suburb'].$csv_enclosed.$csv_separator;
							$schema_insert .= $csv_enclosed .$obj->records[$i]['shipping_city'].$csv_enclosed.$csv_separator;
							$schema_insert .= $csv_enclosed .$obj->records[$i]['shipping_state'].$csv_enclosed.$csv_separator;
							$schema_insert .= $csv_enclosed .$obj->records[$i]['billing_company'].$csv_enclosed;
						}
						$out .= $schema_insert;
						$out .= $csv_terminated;
				 }
					header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
					header("Content-Length: " . strlen($out));
					// Output to browser with appropriate mime type, you choose ;)
					header("Content-type: text/x-csv");
					//header("Content-type: text/csv");
					//header("Content-type: application/csv");
					header("Content-Disposition: attachment; filename=order_report.csv");
					echo $out;
					exit;
					 
			  }
			  
			  else if($_POST['export'] =='tab')
			  {
					$tab_terminated = "\n";
					$tab_separator = "->";
					$tab_enclosed = '"';
					$tab_escaped = "\\";
				   $sqlselect = "select orders_id,shipping_name,shipping_street_address,shipping_suburb,shipping_city,shipping_state,billing_company from orders_table";
				   $obj = new Bin_Query();
				   if($obj->executeQuery($sqlselect))
				   {
						$schema_insert = '';
						$schema_insert  .= $tab_enclosed.Orderid.$tab_enclosed.$tab_separator;
						$schema_insert  .= $tab_enclosed.ShippingName.$tab_enclosed.$tab_separator;
						$schema_insert  .= $tab_enclosed.ShippingStreetAddress.$tab_enclosed.$tab_separator;
						$schema_insert  .= $tab_enclosed.ShippingSuburb.$tab_enclosed.$tab_separator;
						$schema_insert  .= $tab_enclosed.ShippingCity.$tab_enclosed.$tab_separator;
						$schema_insert  .= $tab_enclosed.ShippingState.$tab_enclosed.$tab_separator;
						$schema_insert  .= $tab_enclosed.BillingCompany.$tab_enclosed;
						
					   $count=count($obj->records);
						for ($i = 0; $i < $count; $i++)
						{
							$schema_insert .= $tab_enclosed .$obj->records[$i]['orders_id']. $tab_enclosed.$tab_separator;
							$schema_insert .= $tab_enclosed.$obj->records[$i]['shipping_name'].$tab_enclosed.$tab_separator;
						$schema_insert .= $tab_enclosed .$obj->records[$i]['shipping_street_address'].$tab_enclosed.$tab_separator;
							$schema_insert .= $tab_enclosed .$obj->records[$i]['shipping_suburb'].$tab_enclosed.$tab_separator;
							$schema_insert .= $tab_enclosed .$obj->records[$i]['shipping_city'].$tab_enclosed.$tab_separator;
							$schema_insert .= $tab_enclosed .$obj->records[$i]['shipping_state'].$tab_enclosed.$tab_separator;
							$schema_insert .= $tab_enclosed .$obj->records[$i]['billing_company'].$tab_enclosed;
						}
						$out .= $schema_insert;
						$out .= $tab_terminated;
				 }
					/*header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
					header("Content-Length: " . strlen($out));
					// Output to browser with appropriate mime type, you choose ;)
					header("Content-type: application/tab");
					//header("Content-type: text/csv");
					//header("Content-type: application/csv");
					header("Content-Disposition: attachment; filename=user_report.tab");*/
					
					header("Pragma: public");
						header("Expires: 0");
						header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
						header("Content-Length: " . strlen($out));
						header("Content-Type: tab/force-download");
						header("Content-Type: tab/octet-stream");
						header("Content-Type: tab/download");
						header("Content-Disposition: attachment;filename=order_report.tsv"); 
						header("Content-Transfer-Encoding: binary ");
					
					echo $out;
					exit;
					 
			  }				
   
	}
}
?>