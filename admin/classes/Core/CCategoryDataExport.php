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
 * This class contains functions to convert the available categories into a file format
 *
 * @package  		Core_CCategoryDataExport
 * @category  		Core
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
   * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */

class Core_CCategoryDataExport
{
	
	
	/**
	 * Function generates an file in Excel/XML/CSV/TSV format. 
	 * 
	 * 
	 * @return file
	 */
	
 	function categoryDataExport()
	{
		   		
		if($_POST['export'] =='excel')
		{			
			include("classes/Lib/excelwriter.inc.php");   
			$excel=new ExcelWriter("category_Detail.xls");
			
			if($excel==false)	
				echo $excel->error;
			$myArr=array("SlNo","Category Id","Category Name","Category Desc");
			$excel->writeLine($myArr);
			 $j=1;
			$sql ='select category_id,category_name,category_desc from category_table';
			$obj = new Bin_Query();
			if($obj->executeQuery($sql))
			{
				$cnt=count($obj->records);
				for($i=0;$i<$cnt;$i++)
				{
					$category_id = $obj->records[$i]['category_id'];
					$category_name = $obj->records[$i]['category_name'];
					$category_desc = $obj->records[$i]['category_desc'];
					
					//$doj =  $obj->records[$i]['user_doj'];
					
					$excel->writeRow();
					$excel->writeCol($j);
					$excel->writeCol($category_id);
					$excel->writeCol($category_name);
					$excel->writeCol($category_desc);
					
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
			$file="category_Detail.xls";
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
			
				
					$sqlselect = "select category_id,category_name,category_desc from category_table";
					
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
						header("Content-Disposition: attachment;filename=category_report.xml"); 
						header("Content-Transfer-Encoding:binary");
						echo("<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n");
						echo("<categorydetails>\n");
						$count=count($obj->records);
						for($i=0;$i<$count;$i++)
						{		
						echo ("<CategoryId>".$obj->records[$i]['category_id']."</CategoryId>\n");
						echo ("<CategoryName>".$obj->records[$i]['category_name']."</CategoryName>\n");
						echo ("<CategoryDesc>".$obj->records[$i]['category_desc']."</CategoryDesc>\n");							
						}
						echo("</categorydetails>\n");
						exit();
				   }
			  }
			  
			  else if($_POST['export'] =='csv')
			  {
					$csv_terminated = "\n";
					$csv_separator = ",";
					$csv_enclosed = '"';
					$csv_escaped = "\\";
				   $sqlselect = "select category_id,category_name,category_desc from category_table";
				   $obj = new Bin_Query();
				   if($obj->executeQuery($sqlselect))
				   {
						$schema_insert = '';
						$schema_insert  .= $csv_enclosed.CategoryId.$csv_enclosed.$csv_separator;
						$schema_insert  .= $csv_enclosed.CategoryName.$csv_enclosed.$csv_separator;
						$schema_insert  .= $csv_enclosed.CategoryDescription.$csv_enclosed;
						
					   $count=count($obj->records);
						for ($i = 0; $i < $count; $i++)
						{
							$schema_insert .= $csv_enclosed.$obj->records[$i]['category_id'].$csv_enclosed.$csv_separator;
							$schema_insert .= $csv_enclosed.$obj->records[$i]['category_name'].$csv_enclosed.$csv_separator;
							$schema_insert .= $csv_enclosed.$obj->records[$i]['category_desc'].$csv_enclosed;
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
					header("Content-Disposition: attachment; filename=category_report.csv");
					echo $out;
					exit;
					 
			  }
			  
			  else if($_POST['export'] =='tab')
			  {
					$tab_terminated = "\n";
					$tab_separator = "->";
					$tab_enclosed = '"';
					$tab_escaped = "\\";
				   $sqlselect = "select category_id,category_name,category_desc from category_table";
				   $obj = new Bin_Query();
				   if($obj->executeQuery($sqlselect))
				   {
						$schema_insert = '';
						$schema_insert  .= $tab_enclosed.CAtegoryId.$tab_enclosed.$tab_separator;
						$schema_insert  .= $tab_enclosed.CategoryName.$tab_enclosed.$tab_separator;
						$schema_insert  .= $tab_enclosed.category_desc.$tab_enclosed;
						
					   $count=count($obj->records);
						for ($i = 0; $i < $count; $i++)
						{
							$schema_insert .= $tab_enclosed .$obj->records[$i]['category_id']. $tab_enclosed.$tab_separator;
							$schema_insert .= $tab_enclosed.$obj->records[$i]['category_name'].$tab_enclosed.$tab_separator;
							$schema_insert .= $tab_enclosed .$obj->records[$i]['category_desc'].$tab_enclosed;
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
						header("Content-Disposition: attachment;filename=category_report.tsv"); 
						header("Content-Transfer-Encoding: binary ");
					
					echo $out;
					exit;
					 
			  }				
   
	}
}
?>