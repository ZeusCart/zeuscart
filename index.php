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
error_reporting(1);
ob_start();
session_start();

define("ROOT_FOLDER",'./');
define("CURRENT_FOLDER",'main');
if($_GET['do']=='')
	{

		$hostname = 'localhost';
		$username = 'root';
		$password = '';
		$dbname='zeuscartv4';
		$sql=mysql_connect($hostname,$username,$password);
						
		$db_sel=mysql_select_db($dbname,$sql);
		if($db_sel) 
		{
 			
			$url=$_SERVER['REQUEST_URI'];
			$results = explode('/', trim($url,'/'));
			if(count($results) > 0){
			//get the last record
			$last = $results[count($results) - 1];
			$last=explode('.',$last);
			$last=$last[0];
			}

			$last=str_replace('-',' ',$last);
			
 			$sql="SELECT * from category_table WHERE category_name='".$last."'"; 
			$res=mysql_query($sql);
			$row=mysql_fetch_array($res);
			$catid=$row['category_id'];
			if($catid!='')
			{
			$_GET['do']='category';
			$_GET['id']=$catid;
			}

			elseif($catid =='')
			{
				$last=str_replace(' ','-',$last);

				 $sqlpro="SELECT * FROM products_table WHERE alias='".$last."'";
				$profet=mysql_query($sqlpro);
				$productrow=mysql_fetch_array($profet);	
				$productid=$productrow['product_id'];
				if($productid!='')
				{
					$_GET['do']='prodetail';
					$_GET['action']='showprod';
					$_GET['prodid']=$productid; 
				}
				else
				{
					$last=str_replace('-',' ',$last);
					$sqlnews="SELECT * FROM news_table WHERE news_title='".$last."'"; 
					$newsfet=mysql_query($sqlnews);
					$newsrow=mysql_fetch_array($newsfet);	
					$newsid=$newsrow['news_id'];
					if($newsid!='')
					{
						$_GET['do']='newsdetails';
						$_GET['action']='details';
						$_GET['newsid']=$newsid;
					}
					else
					{
						
					}
				}
					
			}
			
 				
		}


	}

//include_once(ROOT_FOLDER.'Bin/Build/Save.php'); 
//new Bin_Build_Save();

include 'Bin/CheckInstallation.php';
			
include(ROOT_FOLDER."Bin/Core/Assembler.php");
new Bin_Core_Assembler();



include_once(ROOT_FOLDER.'Bin/Security.php');
$obj=new Bin_Configuration();

if($obj->config['HOST']=='') 
{
	header('Location: install/index.php');
	exit();
}

?>