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
 * This class contains functions to generate a excel/xml/csv/tsv format file
 *
 * @package  		Core_CProductDataExport
 * @category  		Core
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
   * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */

class Core_CProductDataExport
{
	
	/**
	 * Function generates a product details in an excel/xml/csv/tsv format file
	 * 
	 * 
	 * @return file
	 */
	
 	function productDataExport()
	{
		   		
		if($_POST['export'] =='excel')
		{			
			include("classes/Lib/excelwriter.inc.php");   
			$excel=new ExcelWriter("Product_Detail.xls");
			
			if($excel==false)	
				echo $excel->error;
			$myArr=array("SlNo","Title","Description","Brand","Model","Msrp","Price","Shipping Cost","Intro Date");
			$excel->writeLine($myArr);
			 $j=1;
			$sql ='select sku,title,description,brand,model,msrp,price,shipping_cost,intro_date from products_table';
			$obj = new Bin_Query();
			if($obj->executeQuery($sql))
			{
				$cnt=count($obj->records);
				for($i=0;$i<$cnt;$i++)
				{
					$title = $obj->records[$i]['title'];
					$description = $obj->records[$i]['description'];
					$brand = $obj->records[$i]['brand'];
					$model = $obj->records[$i]['model'];
					$msrp = $obj->records[$i]['msrp'];
					$price = $obj->records[$i]['price'];
					$shipping_cost = $obj->records[$i]['shipping_cost'];
					$intro_date = $obj->records[$i]['intro_date'];
					//$doj =  $obj->records[$i]['user_doj'];
					
					$excel->writeRow();
					$excel->writeCol($j);
					$excel->writeCol($title);
					$excel->writeCol($description);
					$excel->writeCol($brand);
					$excel->writeCol($model);
					$excel->writeCol($msrp);
					$excel->writeCol($price);
					$excel->writeCol($shipping_cost);
					$excel->writeCol($intro_date);
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
			$file="Product_Detail.xls";
			//chmod ($file, 0755);
			header("Pragma: no-cache");
			header("Content-Type: php/doc/xml/html/htm/asp/jpg/JPG/sql/txt/jpeg/gif/bmp/png/xls/csv/x-ms-asf\n");
			header("Connection: close");
			header("Content-Disposition: attachment; filename=".$file."\n");
			header("Content-Transfer-Encoding: binary\n");
			header("Content-length: ".(string)(filesize("$file")));
			$fd=fopen($file,"rb");
			fpassthru($fd);
				
			
			/*function xlsBOF() 
			{
				echo pack("ssssss", 0x809, 0x8, 0x0, 0x10, 0x0, 0x0);  
				return;
			}
	
			function xlsEOF() 
			{
				echo pack("ss", 0x0A, 0x00);
				return;
			}
	
			function xlsWriteNumber($Row, $Col, $Value) 
			{
				echo pack("sssss", 0x203, 14, $Row, $Col, 0x0);
				echo pack("d", $Value);
				return;
			}
	
			function xlsWriteLabel($Row, $Col, $Value ) 
			{
				$L = strlen($Value);
				echo pack("ssssss", 0x204, 8 + $L, $Row, $Col, 0x0, $L);
				echo $Value;
				return;
			}
			//Send header
			header("Pragma: public");
			header("Expires: 0");
			header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
			header("Content-Type: application/force-download");
			header("Content-Type: application/octet-stream");
			header("Content-Type: application/download");
			header("Content-Disposition: attachment;filename=user_report.xls"); 
			header("Content-Transfer-Encoding: binary ");
			xlsBOF();
					xlsWriteLabel(1,0,"No");
					xlsWriteLabel(1,1,"First Name");
					xlsWriteLabel(1,2,"Last Name");
					xlsWriteLabel(1,3,"Display Name");
					xlsWriteLabel(1,4,"Email");
					xlsWriteLabel(1,5,"Date of Joining");
								
				   $xlsRow = 2;
				   $j=1;
					
					//Query
					
					$sqlselect = "select user_fname,user_lname,user_display_name,user_email,user_doj from users_table";
					
					$obj = new Bin_Query();
					if($obj->executeQuery($sqlselect))
					{
						$count=count($obj->records);
						for($i=0;$i<$count;$i++)
						{
							$description = $obj->records[$i]['user_fname'];
							$last_name = $obj->records[$i]['user_lname'];
							$display_name = $obj->records[$i]['user_display_name'];
							$email = $obj->records[$i]['user_email'];
							$doj =  $obj->records[$i]['user_doj'];
							
							xlsWriteLabel($xlsRow,0,"$j");
							xlsWriteLabel($xlsRow,1,$description);
							xlsWriteLabel($xlsRow,2,$last_name);
							xlsWriteLabel($xlsRow,3,$display_name);
							xlsWriteLabel($xlsRow,4,$email);
							xlsWriteLabel($xlsRow,5,$doj);
							$xlsRow++;
							$j++;
						}
					}
					xlsEOF();
					exit();	*/
			}
			else if($_POST['export'] =='xml')
			{
			
				
				$sqlselect = "select sku,title,description,brand,model,msrp,price,shipping_cost,intro_date from products_table";
					
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
						header("Content-Disposition: attachment;filename=product_report.xml"); 
						header("Content-Transfer-Encoding:binary");
						echo("<?xml version=\"1.0\" encoding=\"UTF-8\" ?>\n");
						echo("<productdetails>\n");
						$count=count($obj->records);
						for($i=0;$i<$count;$i++)
						{
							/*echo ("<user id=\"". $obj->records[$i]['user_id'] ."\">\n");
							echo ("<firstname=\"". $obj->records[$i]['user_fname'] ."\">\n");
							echo ("<lastname=\"". $obj->records[$i]['user_lname'] ."\">\n");
							echo ("<displayname=\"". $obj->records[$i]['user_display_name'] ."\">\n");
							echo ("<email=\"". $obj->records[$i]['user_email'] ."\">\n");
							echo ("<userdoj=\"". $obj->records[$i]['user_doj'] ."\">\n");*/
							
							echo ("<title>".$obj->records[$i]['title']."</title>\n");
			echo ("<description>".str_replace("&",'&amp;',$obj->records[$i]['description'])."</description>\n");
							echo ("<brand>".$obj->records[$i]['brand']."</brand>\n");
							echo ("<model>".$obj->records[$i]['model']."</model>\n");
							echo ("<msrp>".$obj->records[$i]['msrp'] ."</msrp>\n");
							echo ("<price>".$obj->records[$i]['price'] ."</price>\n");
							echo ("<shipping_cost>".$obj->records[$i]['shipping_cost'] ."</shipping_cost>\n");
							echo ("<intro_date>". $obj->records[$i]['intro_date'] ."</intro_date>\n");
						}
						echo("</productdetails>\n");
						exit();
				   }
			  }
			  
			  else if($_POST['export'] =='csv')
			  {
					$csv_terminated = "\n";
					$csv_separator = ",";
					$csv_enclosed = '"';
					$csv_escaped = "\\";
				   $sqlselect = "select sku,title,description,brand,model,msrp,price,shipping_cost,intro_date from products_table";
				   $obj = new Bin_Query();
				   if($obj->executeQuery($sqlselect))
				   {
						$schema_insert = '';
						$schema_insert  .= $csv_enclosed.Title.$csv_enclosed.$csv_separator;
						$schema_insert  .= $csv_enclosed.Description.$csv_enclosed.$csv_separator;
						$schema_insert  .= $csv_enclosed.Brand.$csv_enclosed.$csv_separator;
						$schema_insert  .= $csv_enclosed.Model.$csv_enclosed.$csv_separator;
						$schema_insert  .= $csv_enclosed.Msrp.$csv_enclosed.$csv_separator;
						$schema_insert  .= $csv_enclosed.Price.$csv_enclosed.$csv_separator;
						$schema_insert  .= $csv_enclosed.ShippingCost.$csv_enclosed.$csv_separator;
						$schema_insert  .= $csv_enclosed.IntroDate.$csv_enclosed;
						
					   $count=count($obj->records);
						for ($i = 0; $i < $count; $i++)
						{
							$schema_insert .= $csv_enclosed.$obj->records[$i]['title'].$csv_enclosed.$csv_separator;
							$schema_insert .= $csv_enclosed.$obj->records[$i]['description'].$csv_enclosed.$csv_separator;
							$schema_insert .= $csv_enclosed.$obj->records[$i]['brand'].$csv_enclosed.$csv_separator;
							$schema_insert .= $csv_enclosed.$obj->records[$i]['model'].$csv_enclosed.$csv_separator;
							$schema_insert .= $csv_enclosed.$obj->records[$i]['msrp'].$csv_enclosed.$csv_separator;
							$schema_insert .= $csv_enclosed.$obj->records[$i]['price'].$csv_enclosed.$csv_separator;
							$schema_insert .= $csv_enclosed.$obj->records[$i]['ShippingCost'].$csv_enclosed.$csv_separator;
							$schema_insert .= $csv_enclosed.$obj->records[$i]['intro_date'].$csv_enclosed;
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
					header("Content-Disposition: attachment; filename=product_report.csv");
					echo $out;
					exit;
					 
			  }
			  
			  else if($_POST['export'] =='tab')
			  {
					$tab_terminated = "\n";
					$tab_separator = "->";
					$tab_enclosed = '"';
					$tab_escaped = "\\";
				   $sqlselect = "select sku,title,description,brand,model,msrp,price,shipping_cost,intro_date from products_table";
				   $obj = new Bin_Query();
				   if($obj->executeQuery($sqlselect))
				   {
						$schema_insert = '';
						$schema_insert  .= $tab_enclosed.Title.$tab_enclosed.$tab_separator;
						$schema_insert  .= $tab_enclosed.Description.$tab_enclosed.$tab_separator;
						$schema_insert  .= $tab_enclosed.Brand.$tab_enclosed.$tab_separator;
						$schema_insert  .= $tab_enclosed.Model.$tab_enclosed.$tab_separator;
						$schema_insert  .= $tab_enclosed.Msrp.$tab_enclosed.$tab_separator;
						$schema_insert  .= $tab_enclosed.Price.$tab_enclosed.$tab_separator;
						$schema_insert  .= $tab_enclosed.ShippingCost.$tab_enclosed.$tab_separator;
						$schema_insert  .= $tab_enclosed.IntroDate.$tab_enclosed;
						
					   $count=count($obj->records);
						for ($i = 0; $i < $count; $i++)
						{
							$schema_insert .= $tab_enclosed .$obj->records[$i]['title']. $tab_enclosed.$tab_separator;
							$schema_insert .= $tab_enclosed.$obj->records[$i]['description'].$tab_enclosed.$tab_separator;
							$schema_insert .= $tab_enclosed .$obj->records[$i]['brand'].$tab_enclosed.$tab_separator;
							$schema_insert .= $tab_enclosed .$obj->records[$i]['model'].$tab_enclosed.$tab_separator;
							$schema_insert .= $tab_enclosed .$obj->records[$i]['msrp'].$tab_enclosed.$tab_separator;
							$schema_insert .= $tab_enclosed .$obj->records[$i]['price'].$tab_enclosed.$tab_separator;
							$schema_insert .= $tab_enclosed .$obj->records[$i]['shipping_cost'].$tab_enclosed.$tab_separator;
							$schema_insert .= $tab_enclosed .$obj->records[$i]['intro_date'].$tab_enclosed;
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
						header("Content-Disposition: attachment;filename=product_report.tsv"); 
						header("Content-Transfer-Encoding: binary ");
					
					echo $out;
					exit;
					 
			  }				
   
	}
}
?>