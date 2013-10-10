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
 * This class contains functions to display the user details from the users_table. 
 *
 * @package  		Core_CAdminUserRegistration
 * @category  		Core
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
   * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */


class Core_CAdminUserRegistration
{
	
	/**
	 * Stores the output 
	 *
	 * @var array $output
	 */
	
	var $output = array();
	
	/**
	 * Function gets the users details from the users_table. 
	 * 
	 * 
	 * @return string
	 */	
	
	function showAccount()
	{

		$pagesize=10;
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
			
		$sqlselect = "select user_id,user_display_name,user_fname,user_lname,user_email,user_status from users_table order by user_id desc";
			
		$query = new Bin_Query();
		if($query->executeQuery($sqlselect))
		{	
			$total = ceil($query->totrows/ $pagesize);
			include_once('classes/Lib/Paging.php');
			$tmp = new Lib_Paging('classic',array('totalpages'=>$total, 'length'=>10),'pagination');
			$this->data['paging'] = $tmp->output;
			$this->data['prev'] =$tmp->prev;
			$this->data['next'] = $tmp->next;
			
			$sql1 = "select user_id,user_display_name,user_fname,user_lname,user_email,user_status from users_table order by user_id desc LIMIT $start,$end";
			$query1 = new Bin_Query();
			if($query1->executeQuery($sql1))
			{
				return Display_DAdminUserRegistration::showUserDetail($query1->records,1,$this->data['paging'],$this->data['prev'],$this->data['next']);
			}
		}
		else
		{
			return "No Users Found";
		}		
   	}
   
	/**
	 * Function gets the search details from the users_table. 
	 * 
	 * 
	 * @return string
	 */		
	
	function searchUserDetails()
	{
		 $dispname = $_POST['displayname'];
		 $firstname = $_POST['firstname'];
		 $lastname =  $_POST['lastnname'];
		 $email =  $_POST['email'];
		 $status =  $_POST['status']; 
		 
		  $pagesize=10;
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
		 
		$sql = "select user_id,user_display_name,user_fname,user_lname,user_email,user_status from users_table";
		$condition=array();
		if($dispname!='')
		{
			$condition []= "  user_display_name like '%".$dispname."%'";
		}
		if($firstname!='')
		{
			$condition[]= " user_fname like  '%".$firstname."%'";
		}
		if($lastname!='')
		{
			$condition []= "  user_lname like  '%".$lastname."%'";
		}
		if($email!='')
		{
			$condition []= "  user_email like  '%".$email."%'";
		}
		if($status!='')
		{
			$condition []= "  user_status =  '".$status."'";
		}
		if(count($condition)>1)
			$sql.= ' where '. implode(' and ', $condition);
		elseif(count($condition)>0)
			$sql.= ' where  '. implode('', $condition);
		$sql.=' order by user_display_name asc';
				
		if($_POST['search']=='Search')
		{
			
			$obj = new Bin_Query();
			if($obj->executeQuery($sql))
			{
				$_SESSION['sql'] = $sql;
				$output =  Display_DAdminUserRegistration::showUserDetail($obj->records,1,'','','');
			}
			else
			{
				$output =  Display_DAdminUserRegistration::showUserDetail($obj->records,0,'','','');
			}
		}
		else
			Core_CAdminUserRegistration::createReport($_SESSION['sql']);
		return $output;
	}
	
	/**
	 * Function gets the search details from the users_table with paging enabled. 
	 * 
	 * 
	 * @return string
	 */	
   	function searchUserDetails_withpaging()
	{
		 $dispname = $_POST['displayname'];
		 $firstname = $_POST['firstname'];
		 $lastname =  $_POST['lastnname'];
		 $email =  $_POST['email'];
		 $status =  $_POST['status']; 
		 
		$pagesize=10;
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
		 
		$sql = "select user_id,user_display_name,user_fname,user_lname,user_email,user_status from users_table";
		 $condition=array();
		if($dispname!='')
		{
			$condition []= "  user_display_name like '%".$dispname."%'";
		}
		if($firstname!='')
		{
			$condition[]= " user_fname like  '%".$firstname."%'";
		}
		if($lastname!='')
		{
			$condition []= "  user_lname like  '%".$lastname."%'";
		}
		if($email!='')
		{
			$condition []= "  user_email like  '%".$email."%'";
		}
		if($status!='')
		{
			$condition []= "  user_status =  '".$status."'";
		}
		if(count($condition)>1)
			$sql.= ' where '. implode(' and ', $condition);
		elseif(count($condition)>0)
			$sql.= ' where  '. implode('', $condition);
			$sql.=' order by user_display_name asc';
		
		
		if($_POST['search']!='btnreport')
		{
			
			$query = new Bin_Query();
			if($query->executeQuery($sql))
			{	
				$total = ceil($query->totrows/ $pagesize);
				include_once('classes/Lib/Paging.php');
				$tmp = new Lib_Paging('classic',array('totalpages'=>$total, 'length'=>10),'pagination');
				$this->data['paging'] = $tmp->output;
				$this->data['prev'] =$tmp->prev;
				$this->data['next'] = $tmp->next;
			
				$sql1 = $sql." LIMIT $start,$end";
				$query1 = new Bin_Query();
			
				if($query1->executeQuery($sql1))
				{
					$_SESSION['sql'] = $sql1;
					$output =  Display_DAdminUserRegistration::showUserDetail($query1->records,1,$this->data['paging'],$this->data['prev'],$this->data['next']);
				}
				else
				{
					$output =  Display_DAdminUserRegistration::showUserDetail($query1->records,0,$this->data['paging'],$this->data['prev'],$this->data['next']);
				}
			}
			else
			{
				return "No Users Found";
			}
		}
		else
			Core_CAdminUserRegistration::createReport($_SESSION['sql']);
		
		return $output;	
	}
	
	/**
	 * Function deletes an user account from the users_table. 
	 * 
	 * 
	 * @return string
	 */		
	   
	function deleteAccount()
	{
			$userid = $_GET['id'];
			$sqldelete = "delete from users_table where user_id=".$userid;
			$obj = new Bin_Query();
			if($obj->updateQuery($sqldelete))
				$output = '<div class="alert alert-success">
			<button data-dismiss="alert" class="close" type="button">×</button> Successfully Deleted.</div>';
			else
				$output = '<div class="alert alert-error">
			<button data-dismiss="alert" class="close" type="button">×</button> Not Deleted.</div>';
				
			//$output .= $this->showAccount();
			
			return $output;
			
	}
   
   	/**
	 * Function updates (active) the user status in the users_table. 
	 * 
	 * 
	 * @return string
	 */		
	function acceptAccount()
	{
			$userid = $_GET['id'];
			$sqlaccept = "update users_table set user_status=1 where user_id=".$userid;
			$obj = new Bin_Query();
			if($obj->updateQuery($sqlaccept))
				$output = '<div class="alert alert-success">
			<button data-dismiss="alert" class="close" type="button">×</button> Successfully Activated.</div>';
			else
				$output = '<div class="alert alert-error">
			<button data-dismiss="alert" class="close" type="button">×</button> Not Accepted.</div>';
				
			//$output .= $this->showAccount();
			
			return $output;
			
	}
   	
  	 /**
	 * Function updates (inactive) the user status in the users_table. 
	 * 
	 * 
	 * @return string
	 */		
   
	function denyAccount()
	{
			$userid = $_GET['id'];
			$sqldeny = "update users_table set user_status=0 where user_id=".$userid;
			$obj = new Bin_Query();
			if($obj->updateQuery($sqldeny))
				$output = '<div class="alert alert-success">
			<button data-dismiss="alert" class="close" type="button">×</button> Successfully Inactivated .</div>';
			else
				$output = '<div class="alert alert-error">
			<button data-dismiss="alert" class="close" type="button">×</button> Not Denied.</div>';
				
			//$output .= $this->showAccount();
			
			return $output;
			
	}
   	
	 /**
	 * Function gets the details of the user account from the users_table. 
	 * @param array $Err contains both error messages and error values
	 * 
	 * @return string
	 */		
   
	function editAccount($Err)
	{
		$userid = mysql_escape_string(intval($_GET['userid']));
	
		$sqlselect = "select a.user_display_name as dispname,a.user_fname as fname,a.user_lname as lname,a.user_email as email,a.user_status,a.user_group as usergroup,b.address,b.city,b.state,b.country,b.zip from users_table a, addressbook_table b where a.user_id=".$userid." and b.user_id=".$userid;
		
		$obj = new Bin_Query();
		if($obj->executeQuery($sqlselect))
		{
			$output['userid'] = $userid;
			$output['txtdisname'] = $obj->records[0]['dispname'];
			$output['txtfname'] = $obj->records[0]['fname'];
			$output['txtlname'] = $obj->records[0]['lname'];
			$output['txtemail'] = $obj->records[0]['email'];
			$output['editGroup'] = $obj->records[0]['usergroup'];
			$output['txtaddr'] = $obj->records[0]['address'];
			$output['txtcity'] = $obj->records[0]['city'];
			$output['txtState'] = $obj->records[0]['state'];
			$output['editCountry'] = $obj->records[0]['country'];
			$output['txtzipcode'] = $obj->records[0]['zip'];

			//$output['val']['msg'] = '<div class="success_msgbox">Updated Successfully</div>';
		}
		else
			$output = "No Record Found";
		
		return $output;
			
	}
   
  	 /**
	 * Function updates the changes made in the user account into the users_table. 
	 * 
	 * 
	 * @return string
	 */		
   
	function updateAccount()
	{
			if($_GET['id'] != '')
				$userid = $_GET['id'];
			else if($_POST['id'] != '')
				$userid = $_POST['id'];
		
// 			$sqlupdate ="update users_table set user_display_name ='".$_POST['disname']."',user_fname='".$_POST['fname'].             			"',user_lname='" .$_POST['lname']."',user_email='".$_POST['txtemail']."' where user_id=".$userid;

			$sqlupdate ="update users_table a, addressbook_table b set a.user_display_name ='".$_POST['txtdisname']."',a.user_fname='".$_POST['txtfname']."',a.user_lname='" .$_POST['txtlname']."',a.user_email='".$_POST['txtemail']."',a.user_group='".$_POST['editGroup']."', a.user_country='".$_POST['editCountry']."',b.country='".$_POST['editCountry']."', b.address='".$_POST['txtaddr']."',    	b.city='".$_POST['txtcity']."', b.state='".$_POST['txtState']."', b.zip='".$_POST['txtzipcode']."' where a.user_id=".$_POST['userid']." and b.user_id=".$_POST['userid'];
			$obj = new Bin_Query();
			
			if($obj->updateQuery($sqlupdate))
				$output = '<div class="alert alert-success">
			<button data-dismiss="alert" class="close" type="button">×</button>Customer Profile Successfully Updated.</div>';
			else
				$output = '<div class="alert alert-success">
			<button data-dismiss="alert" class="close" type="button">×</button> Not Updated</div>';
			
			
			return $output;
			
	}
   	
	/**
	 * Function gets the edit content group 
	 * 
	 * @param   string  $groupid  $groupid
	 * @return array
	 */
	function getEditGroup($groupid)
	{
		$query = new Bin_Query(); 
		$sql = "SELECT group_id, group_name from users_group_table ";
		$query->executeQuery($sql);
		include_once('classes/Display/DAdminUserRegistration.php');
		
		
		
		 $arrGroup['selGroup']=Display_DAdminUserRegistration::editGroup($query->records,$groupid);
		 return $arrGroup;
	}
	/**
	 * Function gets the  content group 
	 * 
	 * @param   string  $groupid  $groupid
	 * @return array
	 */
	function getGroup($Err)
	{
		$query = new Bin_Query(); 
		$sql = "SELECT group_id, group_name from users_group_table ";
		$query->executeQuery($sql);
		include_once('classes/Display/DAdminUserRegistration.php');
		
		
		
		 $arrGroup['selGroup']=Display_DAdminUserRegistration::getGroup($query->records,$Err);
		 return $arrGroup;
	}	
	 /**
	 * Function gets the edit country  
	 * 
	 * @param   string  $cntcode   $cntcode
	 * @return array
	 */
	function getEditCountry($cntcode)
	{
		$query = new Bin_Query(); 
		$sql = "SELECT * from country_table order by cou_name";
		$query->executeQuery($sql);
		include_once('classes/Display/DAdminUserRegistration.php');
		$arr1['selCountry']=Display_DAdminUserRegistration::editCountry($query->records,$cntcode);
		return $arr1;
	}
	 /**
	 * Function generates a report in the file format. 
	 * @param array  $sql
	 * 
	 * @return file
	 */		
	
	function createReport($sql)
	{
			
			if($_POST['export'] =='excel')
			{			
				include("classes/Lib/excelwriter.inc.php");   
				$excel=new ExcelWriter("User_Detail.xls");
				
				if($excel==false)	
					$excel->error;
				$myArr=array("No","Display Name","First Name","Last Name","Email","Address","City","State","Zip Code","Country");
				$excel->writeLine($myArr);
				$j=1;
				$sql ='select * from users_table';
				$obj = new Bin_Query();
				if($obj->executeQuery($sql))
				{
					$cnt=count($obj->records);
					for($i=0;$i<$cnt;$i++)
					{

						$sqlAdd="SELECT a.*,b.cou_code,b.cou_name FROM addressbook_table AS a LEFT JOIN country_table AS b ON b.cou_code=a.country   WHERE a.user_id='".$obj->records[$i]['user_id']."'"; 
						$objAdd=new Bin_Query();
						$objAdd->executeQuery($sqlAdd);
						
						$display_name = $obj->records[$i]['user_display_name'];
						$first_name = $obj->records[$i]['user_fname'];
						$last_name = $obj->records[$i]['user_lname'];
						
						$email = $obj->records[$i]['user_email'];
						$address= $objAdd->records[0]['address'];
						$city= $objAdd->records[0]['city'];
						$state= $objAdd->records[0]['state'];
						$zip= $objAdd->records[0]['zip'];
						$country= $objAdd->records[0]['cou_name'];
						$doj =  $obj->records[$i]['user_doj'];

						$excel->writeRow();
						$excel->writeCol($j);
						$excel->writeCol($display_name);
						$excel->writeCol($first_name );
						$excel->writeCol($last_name);						
						$excel->writeCol($email);
						$excel->writeCol($address);
						$excel->writeCol($city);
						$excel->writeCol($state);
						$excel->writeCol($zip);
						$excel->writeCol($country);
						$excel->writeCol($doj);
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
				$file="User_Detail.xls";
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
				else if($_POST['export'] =='xml')
				{
					$sqlselect = "select user_id,user_fname,user_lname,user_display_name,user_email,user_doj from users_table";
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
							header("Content-Disposition: attachment;filename=user_report.xml"); 
							header("Content-Transfer-Encoding: binary ");
							echo("<?xml version=\"1.0\" encoding=\"UTF-8\" ?>\n");
							echo("<userdetails>\n");
							$count=count($obj->records);
							for($i=0;$i<$count;$i++)
							{	

								$sqlAdd="SELECT a.*,b.cou_code,b.cou_name FROM addressbook_table AS a LEFT JOIN country_table AS b ON b.cou_code=a.country   WHERE a.user_id='".$obj->records[$i]['user_id']."'"; 
								$objAdd=new Bin_Query();
								$objAdd->executeQuery($sqlAdd);
						
								echo ("<userid>".$obj->records[$i]['user_id']."</userid>\n");
								echo ("<displayname>". $obj->records[$i]['user_display_name'] ."</displayname>\n");
	
								echo ("<firstname>". $obj->records[$i]['user_fname'] ."</firstname>\n");
								echo ("<lastname>". $obj->records[$i]['user_lname'] ."</lastname>\n");
								echo ("<email>". $obj->records[$i]['user_email'] ."</email>\n");
								echo ("<address>". $objAdd->records[0]['address'] ."</address>\n");
								echo ("<city>". $objAdd->records[0]['city'] ."</city>\n");	
								echo ("<state>". $objAdd->records[0]['state'] ."</state>\n");	
								echo ("<zipcode>". $objAdd->records[0]['zip'] ."</zipcode>\n");
								echo ("<country>". $objAdd->records[0]['cou_name'] ."</country>\n");	
								echo ("<userdoj>". $obj->records[$i]['user_doj'] ."</userdoj>\n");
							}
							echo("</userdetails>\n");
							exit();
					}
				}
				
				else if($_POST['export'] =='csv')
				{
						$csv_terminated = "\n";
						$csv_separator = ",";
						$csv_enclosed = '"';
						$csv_escaped = "\\";
					$sqlselect = "select user_id,user_fname,user_lname,user_display_name,user_email,user_doj from users_table";
					$obj = new Bin_Query();
					if($obj->executeQuery($sqlselect))
					{
							$schema_insert = '';
							$schema_insert  .= $csv_enclosed.No.$csv_enclosed.$csv_separator;
							$schema_insert  .= $csv_enclosed.FirstName.$csv_enclosed.$csv_separator;
							$schema_insert  .= $csv_enclosed.LastName.$csv_enclosed.$csv_separator;
							$schema_insert  .= $csv_enclosed.DisplayName.$csv_enclosed.$csv_separator;
							$schema_insert  .= $csv_enclosed.Email.$csv_enclosed.$csv_separator;
							$schema_insert  .= $csv_enclosed.DateofJoin.$csv_enclosed;
							
							$count=count($obj->records);
							for ($i = 0; $i < $count; $i++)
							{

								$sqlAdd="SELECT a.*,b.cou_code,b.cou_name FROM addressbook_table AS a LEFT JOIN country_table AS b ON b.cou_code=a.country   WHERE a.user_id='".$obj->records[$i]['user_id']."'"; 
								$objAdd=new Bin_Query();
								$objAdd->executeQuery($sqlAdd);

								$schema_insert .= $csv_enclosed .$obj->records[$i]['user_id']. $csv_enclosed.$csv_separator;
								$schema_insert .= $csv_enclosed .$obj->records[$i]['user_display_name'].$csv_enclosed.$csv_separator;
								$schema_insert .= $csv_enclosed.$obj->records[$i]['user_fname'].$csv_enclosed.$csv_separator;
								$schema_insert .= $csv_enclosed .$obj->records[$i]['user_lname'].$csv_enclosed.$csv_separator;
								
								$schema_insert .= $csv_enclosed .$obj->records[$i]['user_email'].$csv_enclosed.$csv_separator;
								$schema_insert .= $csv_enclosed .$objAdd->records[0]['address'].$csv_enclosed.$csv_separator;
								$schema_insert .= $csv_enclosed .$objAdd->records[0]['city'].$csv_enclosed.$csv_separator;
								$schema_insert .= $csv_enclosed .$objAdd->records[0]['state'].$csv_enclosed.$csv_separator;
								$schema_insert .= $csv_enclosed .$objAdd->records[0]['zip'].$csv_enclosed.$csv_separator;	
								$schema_insert .= $csv_enclosed .$objAdd->records[0]['cou_name'].$csv_enclosed.$csv_separator;	


								$schema_insert .= $csv_enclosed .$obj->records[$i]['user_doj'].$csv_enclosed;
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
						header("Content-Disposition: attachment; filename=user_report.csv");
						echo $out;
						exit;
						
				}
				
				else if($_POST['export'] =='tab')
				{
						$tab_terminated = "\n";
						$tab_separator = "->";
						$tab_enclosed = '"';
						$tab_escaped = "\\";
					$sqlselect = "select user_id,user_fname,user_lname,user_display_name,user_email,user_doj from users_table";
					$obj = new Bin_Query();
					if($obj->executeQuery($sqlselect))
					{
						

							$schema_insert = '';
							$schema_insert  .= $tab_enclosed.No.$tab_enclosed.$tab_separator;
							$schema_insert  .= $tab_enclosed.DisplayName.$tab_enclosed.$tab_separator;
							$schema_insert  .= $tab_enclosed.FirstName.$tab_enclosed.$tab_separator;
							$schema_insert  .= $tab_enclosed.LastName.$tab_enclosed.$tab_separator;			
							$schema_insert  .= $tab_enclosed.Email.$tab_enclosed.$tab_separator;
							$schema_insert  .= $tab_enclosed.Address.$tab_enclosed.$tab_separator;
							$schema_insert  .= $tab_enclosed.City.$tab_enclosed.$tab_separator;
							$schema_insert  .= $tab_enclosed.State.$tab_enclosed.$tab_separator;	
							$schema_insert  .= $tab_enclosed.Zipcode.$tab_enclosed.$tab_separator;
							$schema_insert  .= $tab_enclosed.Country.$tab_enclosed.$tab_separator;
					
							$schema_insert  .= $tab_enclosed.DateofJoin.$tab_enclosed;
							
						$count=count($obj->records);
							for ($i = 0; $i < $count; $i++)
							{

								$sqlAdd="SELECT a.*,b.cou_code,b.cou_name FROM addressbook_table AS a LEFT JOIN country_table AS b ON b.cou_code=a.country   WHERE 	a.user_id='".$obj->records[$i]['user_id']."'"; 
								$objAdd=new Bin_Query();
								$objAdd->executeQuery($sqlAdd);	

								$schema_insert .= $tab_enclosed .$obj->records[$i]['user_id']. $tab_enclosed.$tab_separator;
								$schema_insert .= $tab_enclosed.$obj->records[$i]['user_fname'].$tab_enclosed.$tab_separator;
								$schema_insert .= $tab_enclosed .$obj->records[$i]['user_lname'].$tab_enclosed.$tab_separator;
								$schema_insert .= $tab_enclosed .$obj->records[$i]['user_display_name'].$tab_enclosed.$tab_separator;
								$schema_insert .= $tab_enclosed .$obj->records[$i]['user_email'].$tab_enclosed.$tab_separator;
								$schema_insert .= $tab_enclosed .$objAdd->records[0]['address'].$tab_enclosed.$tab_separator;
								$schema_insert .= $tab_enclosed .$objAdd->records[0]['city'].$tab_enclosed.$tab_separator;
								$schema_insert .= $tab_enclosed .$objAdd->records[0]['state'].$tab_enclosed.$tab_separator;
								$schema_insert .= $tab_enclosed .$objAdd->records[0]['zip'].$tab_enclosed.$tab_separator;
								$schema_insert .= $tab_enclosed .$objAdd->records[0]['cou_name'].$tab_enclosed.$tab_separator;	

								$schema_insert .= $tab_enclosed .$obj->records[$i]['user_doj'].$tab_enclosed;
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
							header("Content-Disposition: attachment;filename=user_report.tab"); 
							header("Content-Transfer-Encoding: binary ");
						
						echo $out;
						exit;
						
				}				
	}
	
	 /**
	 * Function create a new user account in the users_table. 
	 * 
	 * 
	 * @return file
	 */		
	
	function addAccount()
	{

	
		$displayname = $_POST['txtdisname'];
		$firstname = $_POST['txtfname'];
		$lastname = $_POST['txtlname'];
		$email = $_POST['txtemail'];
		$pswd = $_POST['txtpwd'];
		$newsletter = $_POST['chknewsletter'];
		$date = date('Y-m-d');
		//address details
		$address= $_POST['txtaddr'];
		$city= $_POST['txtcity'];
		$state= $_POST['txtState'];
		$zipcode= $_POST['txtzipcode'];
		$country= $_POST['selCountry'];
		
		$group=$_POST['getGroup'];
		if($newsletter == '')
			$newsletter = 0;
			
		if(count($Err->messages) > 0)
		{
			 $output['val'] = $Err->values;
			 $output['msg'] = $Err->messages;
		}
		
		else
		{
			if( $displayname!= '' and $firstname  != '' and $lastname != '' and $email != '' and $pswd != '')
			{
				
				$pswd=md5($pswd);
				$sql = "insert into users_table (user_display_name,user_fname,user_lname,user_email,user_pwd,user_status,user_doj,user_country,user_group) values('".$displayname."','".$firstname."','".$lastname."','".$email."','".$pswd."',1,'".$date."','".$country."','".$group."')"; 
				$obj = new Bin_Query();
			
			
			if($obj->updateQuery($sql))
			{
				
				//add address detail in address book
				$sq="select user_id from users_table where user_email='$email' and user_pwd='$pswd'";
				$qry1=new Bin_Query();
				$qry1->executeQuery($sq);
				if(count($qry1->records)>0)
				{
					$newuserid=$qry1->records[0]['user_id'];
					$adrsql="insert into addressbook_table(user_id,contact_name,first_name,last_name,company,email,address,city,suburb,state,country,zip,phone_no,fax) values($newuserid,'$displayname','$firstname','$lastname','','$email','$address','$city','','$state','$country','$zipcode','','')"; 
					$qry1->updateQuery($adrsql);
				
				$sql = "insert into newsletter_subscription_table(email,status)values('".$email."',".$newsletter.")";
				if($obj->updateQuery($sql))
				{
					$result = '<div class="alert alert-success">
   					<button type="button" class="close" data-dismiss="alert">×</button> <strong> well done !</strong> Account has been Created Successfully</div>';
					
						$sqllogo="select set_id,site_logo,site_moto,admin_email from admin_settings_table where set_id='1'";
						$objlogo=new Bin_Query();
						$objlogo->executeQuery($sqllogo);
						$site_logo=$objlogo->records[0]['site_logo'];				
						$site_title=$objlogo->records[0]['site_moto'];				
						$admin_email=$objlogo->records[0]['admin_email'];


						//select mail setting
						$sqlMail="SELECT * FROM mail_messages_table WHERE mail_msg_id=1 AND mail_user='0'";
						$objMail=new Bin_Query();
						$objMail->executeQuery($sqlMail);
						$message=$objMail->records[0]['mail_msg'];
						$title=$objMail->records[0]['mail_msg_title'];
						$subject=$objMail->records[0]['mail_msg_subject'];

						$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on'? 'https://': 'http://';
						$dir = (dirname($_SERVER['PHP_SELF']) == "\\")?'':dirname($_SERVER['PHP_SELF']);
						$site = $protocol.$_SERVER['HTTP_HOST'].$dir;
						
						$site_logo=$site.'/'.$site_logo;
						
						$site_logo	=$site_logo;

						$message = str_replace("[title]",$site_title,$message);
						$message = str_replace("[logo]",$site_logo,$message);
						$message = str_replace("[firstname]",$firstname,$message);
						$message = str_replace("[lastname]",$lastname,$message);
											
						$message = str_replace("[user_name]",$email,$message);		$message = str_replace("[password]",$_POST['txtpwd'],$message);	$message = str_replace("[site_email]",$admin_email,$message);	

					Core_CAdminUserRegistration::sendingMail($email,$title,$message);
					echo "<script> top.location = top.location; </script>";
           				
				}
				else
					$result = '<div class="alert alert-error">
    					<button type="button" class="close" data-dismiss="alert">×</button> Account Not Created</div>';
				}
				else
					$result = '<div class="alert alert-error">
   					 <button type="button" class="close" data-dismiss="alert">×</button> Account Not Created</div>';
			}
			else
				$result = '<div class="alert alert-error">
   				 <button type="button" class="close" data-dismiss="alert">×</button> Account Not Created</div>';
			}
		}
		return $result;
	}
  
  	/**
	 * Function sends a mail to the mail id supplied using the Lib_Mail()
	 * 
	 * 
	 * @param array $to_mail
	 * @param string $title
	 * @param string $mail_content	 
	 * @return string
	 */
	function sendingMail($to_mail,$title,$mail_content)
	{
		
		$sql = "select set_id,admin_email from admin_settings_table where set_id='1'";
		$obj = new Bin_Query();
		if($obj->executeQuery($sql))
		{
			
			$from =$obj->records[0]['admin_email']; 
			include('classes/Lib/Mail.php');
			$mail = new Lib_Mail();
			$mail->From($from); 
			$mail->ReplyTo($from);
			$mail->To($to_mail); 
			$mail->Subject($title);
			$mail->Body($mail_content);
			$mail->Send();
		}
		else
			return 'No mail id provided';
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

		$sql="SELECT user_display_name,user_fname,user_lname,user_email FROM users_table";
		$obj =  new Bin_Query();
		$obj->executeQuery($sql);
		
		
		$count=count($obj->records);
		if($count!=0)
		{
			for($i=0;$i<$count;$i++)
			{
				if($_GET['ids']==1)
					$aUsers[]=$obj->records[$i]['user_display_name'];
				elseif($_GET['ids']==2)
					$aUsers[]=$obj->records[$i]['user_fname'];
				elseif($_GET['ids']==3)
					$aUsers[]=$obj->records[$i]['user_lname'];
				elseif($_GET['ids']==4)
					$aUsers[]=$obj->records[$i]['user_email'];
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
	 * Function is user to get the  country list from db
	 * @param array $arr1
	 * @return xml
	 */
	function getCountry($arr1)
	{
		$query = new Bin_Query(); 
		$sql = "SELECT * from country_table order by cou_name";
		$query->executeQuery($sql);
		include_once('classes/Display/DAdminUserRegistration.php');
		$arr1['selCountry']=Display_DAdminUserRegistration::dispCountry($query->records);
		return $arr1;
	}

	/**
	 * Function is user to get the customer detail from db
	 * 
	 * @return string
	 */
	function customerDetail()
	{
		
		$objuser=new Bin_Query();
		$sqluser="SELECT * FROM users_table WHERE user_id='".$_GET['userid']."'";	
		$objuser->executeQuery($sqluser);
		$recordsuser=$objuser->records[0];

		$obj=new Bin_Query();
		$sql="SELECT * FROM addressbook_table WHERE user_id='".$_GET['userid']."'";	
		$obj->executeQuery($sql);
		$records=$obj->records;

		return Display_DAdminUserRegistration::customerDetail($recordsuser,$records);

	}

}
?>