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
 * This class contains functions related url helper related process
 *
 * @package  		Bin_UrlHelper
 * @subpackage      Bin_SetConfiguration
 * @author    		AjSquareInc Dev Team
 * @link   			http://www.zeuscart.com
 * @version  		Version 4.0
 * @created   		January 15 2013
 * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.	
 */
class Bin_UrlHelper extends Bin_Query 
{
	
	function checkurl()
	{	


			if(isset($_SERVER['PATH_INFO']) && $_GET['do']=='' )
			{

				$url=$_SERVER['PATH_INFO'];

				$results = explode('/', trim($url,'/'));	

				$sql_inject= end($results);
				$sql_inject=explode('.',$sql_inject);
				$sql_inject=$sql_inject[1];
				
				if($sql_inject!='html')
				{

					$_GET['do']='index';

				}

			}
			else
			{	


				$url=$_GET['do'];
				$results = explode('/', trim($url,'/'));
				$sql_inject= end($results);
				$sql_inject=explode('.',$sql_inject);
				$sql_inject=$sql_inject[1];
				
				if($sql_inject!='html')
				{

					$_GET['do']='index';

				}
			}

			 $given_main_cat=$results[0];


			if($given_main_cat=='grid')
			{
				$given_main_cat=$results[1];	
				$given_main_cat=explode('.',$given_main_cat);
				$given_main_cat=$given_main_cat[0];	
			}
			else
			{
				$given_main_cat=explode('.',$given_main_cat);
				$given_main_cat=$given_main_cat[0];	
			}
		
			
			if(count($results) > 0){

				//get the last record
				$last = $results[count($results) - 1];
				$last=explode('.',$last);
				$last=$last[0];
			}

			$last=str_replace('-',' ',$last);
			
 		 	$sql="SELECT * from category_table WHERE category_status='1' AND category_alias='".$last."'"; 
 			$cat=new Bin_Query();	
			$cat->executeQuery($sql);
			$records=$cat->records;
			$catid=$cat->records[0]['category_id']; 
			$subcat_path=$cat->records[0]['subcat_path']; 
			$main_category = explode(',', $subcat_path);
			$main_category_id=$main_category[0];

			$sql_main_category="SELECT * from category_table WHERE category_status='1' AND category_id='".$main_category_id."'"; 
 			$cat_main_category=new Bin_Query();	
			$cat_main_category->executeQuery($sql_main_category);
			$records_main_category=$cat_main_category->records;
		 	$main_category_name=$cat_main_category->records[0]['category_alias']; 

			if($catid!='' && $given_main_cat==$main_category_name)
			{

		

			
                    if($results[0]=='grid')
					{
							for($l=1;$l<count($results)-1;$l++)
							{
								$sqlsub=' SELECT * from category_table WHERE category_status="1"  AND  category_alias="'.$results[$l].'"';	
								$objsub=new Bin_Query();
			                    $objsub->executeQuery($sqlsub);
			                    $sub_cat_id.=$objsub->records[0]['category_id'];
								if(count($results)-2!=$l)
								{
									 $sub_cat_id.=',';
								}
							}

					}
					else if(count($results)!='1')
					{
						for($l=0;$l<count($results)-1;$l++)
						{
							$sqlsub=' SELECT * from category_table WHERE category_status="1"  AND  category_alias="'.$results[$l].'"';	
							$objsub=new Bin_Query();
		                    $objsub->executeQuery($sqlsub);
		                    $sub_cat_id.=$objsub->records[0]['category_id'];
							if(count($results)-2!=$l)
							{
								 $sub_cat_id.=',';
							}
						}

					}
					else
					{
						$sub_cat_id=$cat->records[0]['subcat_path']; 
					}

				
			 	$sql_cat_check="SELECT * from category_table WHERE category_status='1' AND  subcat_path='".$sub_cat_id."'"; 
	 			
	 		    $obj_cat_check=new Bin_Query();	
				$obj_cat_check->executeQuery($sql_cat_check);
				if($records_main_category=$obj_cat_check->records)
				{
					if($results[0]=='grid')
					{
						$_GET['do']='girdviewproducts';
						$_GET['cat']=$catid;
					}
					else
					{						
						$_GET['do']='viewproducts';
						$_GET['cat']=$catid;
					}
				}

			}
			elseif($catid =='' || $given_main_cat!=$main_category_name)
			{


				for($l=0;$l<count($results)-1;$l++)
				{
					$sqlsub=' SELECT * from category_table WHERE category_status="1"  AND  category_alias="'.$results[$l].'"';	
					$objsub=new Bin_Query();
                    $objsub->executeQuery($sqlsub);
                    $sub_cat_id.=$objsub->records[0]['category_id'];
					if(count($results)-2!=$l)
					{
						 $sub_cat_id.=',';
					}
					
				}

	 		 	$sql_cat_check="SELECT * from category_table WHERE category_status='1' AND  subcat_path='".$sub_cat_id."'"; 
	 			$obj_cat_check=new Bin_Query();	
				if($obj_cat_check->executeQuery($sql_cat_check))
				{
					 $sql_cat_check="SELECT * from category_table WHERE category_status='1' ".$where.""; 

		 			$obj_cat_check=new Bin_Query();	
					$obj_cat_check->executeQuery($sql_cat_check);
					if($records_main_category=$obj_cat_check->records)
					{

							$last=str_replace(' ','-',$last);

							$sqlpro="SELECT * FROM products_table WHERE alias='".$last."'"; 
							$objpro=new Bin_Query();	
							$objpro->executeQuery($sqlpro);
							$productid=$objpro->records[0]['product_id'];
							if($productid!='')
							{
								$_GET['do']='prodetail';
								$_GET['action']='showprod';
								$_GET['prodid']=$productid; 
							}

					}		
				}							
				else
				{

					if($last=='contact')
					{
						$_GET['do']='contactus';	
					}
					elseif($last=='site')
					{
						$_GET['do']='sitemap';	
					}
					elseif($last=='aboutus')
					{
						$_GET['do']='aboutus';	
					}
					elseif($last=='policy')
					{
						$_GET['do']='privacypolicy';	
					}
					elseif($last=='terms')
					{
						$_GET['do']='termsandcondition';	
					}
					elseif($last=='faq')
					{
						$_GET['do']='faq';	
					}
					elseif($last=='latestnews')
					{
						$_GET['do']='morenews';	
					}
					elseif($last=='login')
					{
						$_GET['do']='login';	
					}
					elseif($last=='logout')
					{
						$_GET['do']='logout';	
					}
					elseif($last=='register')
					{
						$_GET['do']='userregistration';	
					}
					elseif($last=='forgotpassword')
					{
						$_GET['do']='forgetpwd';	
					}
					elseif($last=='register')
					{
						$_GET['do']='userregistration';	
					}	
					elseif($last=='giftproducts')
					{
						$_GET['do']='giftproducts';	
					}
					elseif($last=='girdgiftproducts')
					{
						$_GET['do']='girdgiftproducts';	
					}



				}


			}

	
	}

}


	
Bin_UrlHelper::checkurl();

?>
