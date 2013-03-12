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
 * This class contains functions to export the admin activity into various file formats. 
 *
 * @package  		Core_CAdminActivityDataExport
 * @category  		Core
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
   * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */


class Core_CAdminActivityDataExport
{
	
	/**
	 * Function exports the admin activity report from the database into various file format
	 * Excel/CSV/TSV/XML Formats
	 * 
	 * @return file
	 */
	
	
 	function adminActivityDataExport()
	{		
		if($_POST['export'] =='excel')
		{			
			include("classes/Lib/excelwriter.inc.php");   
			$excel=new ExcelWriter("adminactivity_Detail.xls");
			
			if($excel==false)	
				echo $excel->error;
				
			$myArr=array("SlNo","UserId","Url","VisitedOn");
			$excel->writeLine($myArr);
			 $j=1;
			$sql ='select user_id,url,visited_on from admin_activity_table';
			
			$obj = new Bin_Query();
			$obj->executeQuery($sql);			
			if($obj->executeQuery($sql))
			{
				$cnt=count($obj->records);
				for($i=0;$i<$cnt;$i++)
				{
					$user_id = $obj->records[$i]['user_id'];
					$url = $obj->records[$i]['url'];
					$visited_on = $obj->records[$i]['visited_on'];
										
					$excel->writeRow();
					$excel->writeCol($j);
					$excel->writeCol($user_id);
					$excel->writeCol($url);
					$excel->writeCol($visited_on);
					
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
			$file="adminactivity_Detail.xls";
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
							$url = $obj->records[$i]['user_fname'];
							$last_name = $obj->records[$i]['user_lname'];
							$display_name = $obj->records[$i]['user_display_name'];
							$email = $obj->records[$i]['user_email'];
							$doj =  $obj->records[$i]['user_doj'];
							
							xlsWriteLabel($xlsRow,0,"$j");
							xlsWriteLabel($xlsRow,1,$url);
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
			$sqlselect = "select user_id,url,visited_on from admin_activity_table";				
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
						header("Content-Disposition: attachment;filename=adminactivity_report.xml"); 
						header("Content-Transfer-Encoding: binary ");
						echo("<?xml version=\"1.0\" encoding=\"UTF-8\" ?>\n");
						echo("<activitydetails>\n");
						$count=count($obj->records);
						for($i=0;$i<$count;$i++)
						{
							echo ("<user_id>".$obj->records[$i]['user_id']."</user_id>\n");
							$url = str_replace("&","&amp;",$obj->records[$i]['url']);
							echo ("<url>".$url."</url>\n");							
							echo ("<visitedon>". $obj->records[$i]['visited_on'] ."</visitedon>\n");
						}
						echo("</activitydetails>\n");
						exit();
				   }
			  }
			  
			  else if($_POST['export'] =='csv')
			  {
					$csv_terminated = "\n";
					$csv_separator = ",";
					$csv_enclosed = '"';
					$csv_escaped = "\\";
				   $sqlselect = "select user_id,url,visited_on from admin_activity_table";
				   $obj = new Bin_Query();
				   if($obj->executeQuery($sqlselect))
				   {
						$schema_insert = '';
						$schema_insert  .= $csv_enclosed.user_id.$csv_enclosed.$csv_separator;
						$schema_insert  .= $csv_enclosed.url.$csv_enclosed.$csv_separator;
						$schema_insert  .= $csv_enclosed.VistedOn.$csv_enclosed;
						
					   $count=count($obj->records);
						for ($i = 0; $i < $count; $i++)
						{
						$schema_insert .= $csv_enclosed.$obj->records[$i]['user_id'].$csv_enclosed.$csv_separator;
						$schema_insert .= $csv_enclosed.$obj->records[$i]['url'].$csv_enclosed.$csv_separator;
						$schema_insert .= $csv_enclosed.$obj->records[$i]['visited_on'].$csv_enclosed;
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
					header("Content-Disposition: attachment; filename=adminactivity_report.csv");
					echo $out;
					exit;
					 
			  }
			  
			  else if($_POST['export'] =='tab')
			  {
				   $tab_terminated = "\n";
				   $tab_separator = "->";
				   $tab_enclosed = '"';
				   $tab_escaped = "\\";
				   $sqlselect = "select user_id,url,visited_on from admin_activity_table";
				   $obj = new Bin_Query();
				   if($obj->executeQuery($sqlselect))
				   {
						$schema_insert = '';
						$schema_insert  .= $tab_enclosed.UserId.$tab_enclosed.$tab_separator;
						$schema_insert  .= $tab_enclosed.Url.$tab_enclosed.$tab_separator;
						$schema_insert  .= $tab_enclosed.VisitedOn.$tab_enclosed;
						
					   $count=count($obj->records);
						for ($i = 0; $i < $count; $i++)
						{
					$schema_insert .= $tab_enclosed .$obj->records[$i]['user_id']. $tab_enclosed.$tab_separator;
					$schema_insert .= $tab_enclosed.$obj->records[$i]['url'].$tab_enclosed.$tab_separator;
					$schema_insert .= $tab_enclosed .$obj->records[$i]['visited_on'].$tab_enclosed;
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
					header("Content-Length: ".strlen($out));
					header("Content-Type: tab/force-download");
					header("Content-Type: tab/octet-stream");
					header("Content-Type: tab/download");
					header("Content-Disposition: attachment;filename=adminactivity_report.tsv"); 
					header("Content-Transfer-Encoding: binary ");
					
					echo $out;
					exit;
					 
			  }				
   
	}
}
?>