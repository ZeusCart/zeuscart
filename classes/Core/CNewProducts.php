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
 * New products related  class
 *
 * @package   		Core_CNewProducts
 * @category    	Core
 * @author    		AJ Square Inc Dev Team
 * @link   		http://www.zeuscart.com
  * @copyright 	        Copyright (c) 2008 - 2013, AJ Square, Inc.
 * @version   		Version 4.0
 */
class Core_CNewProducts
{

	/**
	 * Stores the output
	 *
	 * @var array 
	 */	
	var $output = array();	
	/**
	 * Stores the output
	 *
	 * @var array 
	 */	
	var $arr = array();
	/**
	 * This function is used to show  the  product in home page
	 * 
	 * 
	 * @return HTML data
	 */	
	function newProducts()
	{
		
		$sql= " SELECT a.product_id, a.title, a.thumb_image,a.image,a.product_status,a.category_id,a.gift ,a.msrp,a.intro_date,b.soh,sum(c.rating)/count(c.user_id) as rating	FROM products_table a INNER JOIN	product_inventory_table b ON a.product_id=b.product_id  left join product_reviews_table c on a.product_id=c.product_id WHERE a.intro_date <= '".date('Y-m-d')."' and a.status=1 and a.product_status!='1'and a.gift='0' and product_status!='3' group by a.product_id ORDER BY rand( ) LIMIT 0,12 "; 
			
		$query = new Bin_Query();
		if($query->executeQuery($sql))
		{
			$j=0;
			$cnt=count($query->records);
			if($cnt>0)
			{
			
				for ($i=0;$i<$cnt;$i++)
				{		
					foreach($query->records as $row)
					{
						$r[$j]=$row;
						$prid=$row['product_id'];
						$minval=Core_CNewProducts::disRates($prid);
						if($minval > 0  or $minval!='')
						{
							
							$r[$j]['msrp']= $_SESSION['currencysetting']['selected_currency_settings']['currency_tocken'].number_format($row['msrp']*$_SESSION['currencysetting']['selected_currency_settings']['conversion_rate'],2).' - '.$_SESSION['currencysetting']['selected_currency_settings']['currency_tocken'].number_format($minval*$_SESSION['currencysetting']['selected_currency_settings']['conversion_rate'],2);
						}
						else
							$r[$j]['msrp']= $_SESSION['currencysetting']['selected_currency_settings']['currency_tocken'].number_format($row['msrp']*$_SESSION['currencysetting']['selected_currency_settings']['conversion_rate'],2);
							
						$j++;
					}
					return  Display_DNewProducts::newProducts($query->records,$r);
				}
			}
		}
		else
		{
			return Display_DNewProducts::newProductsElse();
		}
		
	}
	/**
	 * This function is used to show to get all new products from db
	 *
	 * 
	 * @return HTML data
	 */
	function showAllNewProducts()
	{
		$sql="SELECT * FROM products_table WHERE  status='1' and product_status!='3' ";
		$obj=new Bin_Query();
		$obj->executeQuery($sql);
		$records=$obj->records;
		
		return Display_DNewProducts::showAllNewProducts($records);
	}
	/**
	 * This function is used to show  the rating 
	 * @param integer $productid
	 * 
	 * @return HTML data
	 */	
	function disRates($productid)
	{
		$sql='select min(msrp) as msrp from msrp_by_quantity_table where product_id ='.$productid;
		$obj=new Bin_Query();
		$obj->executeQuery($sql);
		$val=$obj->records;
		return $val[0]['msrp'];
	}
	/**
	 * This function is used to show  the produtcs
	 * 
	 * 
	 * @return HTML data
	 */	
	function viewProducts()
	{


		$pagesize=9;
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


// 		if(trim($_GET['do'])!='giftviewproducts')
// 		{
			$url=$_GET['cat'];
			$results = explode('/', $url);
// 			if(count($results) > 0){
// 			//get the last record
// 			$last = $results[count($results) - 1];
// 			$last=explode('.',$last);
// 			$last=$last[0];
// 			}

			$results=str_replace('-',' ',$results);
		
				
			 if(count($results) > 1){
				
				$sqlBase='SELECT * from category_table WHERE  category_alias="'.trim($results[0]).'"';
				$objBase=new Bin_Query();
				$objBase->executeQuery($sqlBase);
				$basecatid=$objBase->records[0]['category_id'];	
				
				$sql='AND FIND_IN_SET("'.$basecatid.'",subcat_path)';	
			  }

	  		$last=end($results);
			$sql="SELECT * from category_table WHERE category_alias='".trim($last)."' ".$sql.""; 
			$obj=new Bin_Query();
			$obj->executeQuery($sql);
			$catid=$obj->records[0]['category_id'];
			
		
			$sql1="SELECT category_id,subcat_path from category_table WHERE FIND_IN_SET(".$catid.",subcat_path) ";  
			$res1=mysql_query($sql1);
			while($row1=mysql_fetch_array($res1)){ 
				$fromdate=$row1['category_id'];
					$result[] =  $fromdate ;
			}
		 	$categoryid=implode( ',', $result );

	
			//product selection
			$sqlpro="SELECT a.product_id, a.title, a.thumb_image,a.image,a.large_image_path,a.product_status,a.category_id,a.gift,a.description ,a.msrp,a.intro_date,b.soh FROM products_table a INNER JOIN	product_inventory_table b ON a.product_id=b.product_id   and a.status=1 and a.gift!='1' and product_status!='3' and a.category_id   IN ($categoryid) ";  


		$objpro=new Bin_Query();
		if($objpro->executeQuery($sqlpro))
		{	

			$sql1=$sqlpro.' LIMIT '.$start.','.$end;
			$total = ceil($objpro->totrows/ $pagesize);
			$recordSet=$objpro->records;
			include('classes/Lib/Paging.php');
			$tmp = new Lib_Paging('classic',array('totalpages'=>$total, 'length'=>5),'pagination');
			$this->data['paging'] = $tmp->output;
			$this->data['prev'] =$tmp->prev;
			$this->data['next'] = $tmp->next;
			$query1 = new Bin_Query();
			$query1->executeQuery($sql1);	
		}
		
		
		return Display_DNewProducts::viewProducts($query1->records,$this->data['paging'],$this->data['prev'],$this->data['next'],$start);
		

	}

	/**
	 * This function is used to show  the produtcs
	 * 
	 * 
	 * @return HTML data
	 */	
	function viewGiftProducts()
	{


		$pagesize=9;
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

		
		 $sqlpro="SELECT a.product_id, a.title,a.large_image_path,a.thumb_image,a.image,a.product_status,a.category_id,a.gift,a.description,a.msrp,a.intro_date,b.soh  as rating	FROM products_table a INNER JOIN	product_inventory_table b ON a.product_id=b.product_id  WHERE a.intro_date <= '".date('Y-m-d')."' and a.status=1 and a.gift='1' and product_status!='3'";
		
		$objpro=new Bin_Query();
		if($objpro->executeQuery($sqlpro))
		{	

			$sql1=$sqlpro.' LIMIT '.$start.','.$end;
			$total = ceil($objpro->totrows/ $pagesize);
			$recordSet=$objpro->records;
			include('classes/Lib/Paging.php');
			$tmp = new Lib_Paging('classic',array('totalpages'=>$total, 'length'=>5),'pagination');
			$this->data['paging'] = $tmp->output;
			$this->data['prev'] =$tmp->prev;
			$this->data['next'] = $tmp->next;
			$query1 = new Bin_Query();
			$query1->executeQuery($sql1);	
		}
		
		
		return Display_DNewProducts::viewProducts($query1->records,$this->data['paging'],$this->data['prev'],$this->data['next'],$start);
		

	}
	/**
	 * This function is used to show  the category bread crumb
	 * 
	 * 
	 * @return HTML data
	 */
	function categoryBreadCrumb()
	{
		return Display_DNewProducts::categoryBreadCrumb();

	}

	/**
	 * This function is used to get the title 
	 * 
	 * @return HTML data
	 */
	function getTitle()
	{

		$output['totcategory']=explode('/',$_GET['cat']);

		$parentcat=$output['totcategory'][0];
		$parentcat=str_replace('-',' ',$parentcat);
		$sqlParent="SELECT * FROM category_table WHERE category_alias='".$parentcat."'";	
		$objParent=new Bin_Query();
		$objParent->executeQuery($sqlParent);	
		$parent_id=$objParent->records[0]['category_id']; 


		$category=end($output['totcategory']);
		$category=str_replace('-',' ',$category);
	 	$sql="SELECT * FROM  category_table  WHERE category_alias='".$category."' AND FIND_IN_SET($parent_id,subcat_path)";
		$obj=new Bin_Query();
		$obj->executeQuery($sql);	
		$category_id=$obj->records[0]['category_id'];

		$output=$obj->records[0]['category_name'];

		return $output;
	}
		

}
?>