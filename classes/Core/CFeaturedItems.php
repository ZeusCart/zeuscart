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
 * Featured items  related  class
 *
 * @package   		Core_CFeaturedItems
 * @category    	Core
 * @author    		AJ Square Inc Dev Team
 * @link   		http://www.zeuscart.com
  * @copyright 	        Copyright (c) 2008 - 2013, AJ Square, Inc.
 * @version   		Version 4.0
 */
class Core_CFeaturedItems
{

	/**
	 * Stores the output
	 *
	 * @var array 
	 */

	var $output = array();	

	/**
	 * This function is used to show the main category landing page
	 * 
	 * 
	 * @return string
	 */
	function showMainCatLanding()
	{		
		$maincatid = $_GET['maincatid'];
		$query = new Bin_Query();
		
		// DONT DELETE below hidden query
		
		//$sql = "SELECT DISTINCT a.category_name AS Category,a.category_id AS maincatid, b.category_name AS SubCategory, b.category_id as subcatid, b.category_image AS image FROM category_table a INNER JOIN category_table b ON a.category_id = b.category_parent_id INNER JOIN products_table AS pt ON b.category_id = pt.category_id 	WHERE b.category_parent_id=".$maincatid." ";
		$sql = "SELECT DISTINCT a.category_name AS Category,a.category_id AS maincatid, b.category_name AS SubCategory, b.category_id as subcatid, b.category_image AS image FROM category_table a INNER JOIN category_table b ON a.category_id = b.category_parent_id WHERE b.category_parent_id=".$maincatid." AND b.category_status=1 ";		
		
		//$sql = "SELECT category_name, category_id,category_image FROM `category_table` WHERE category_parent_id =".$maincatid." AND category_status =1";
		
		
		if($query->executeQuery($sql))
			$output = Display_DFeaturedItems::showMainCatLanding($query->records);
		
		else
			//$output='No Main Category Listed';
			$output = Display_DFeaturedItems::showFeaturedItemsElse();
		return $output;
	}
	/**
	 * This function is used to get the main category 
	 * 
	 * 
	 * @return string
	 */
	
	function getMaincatlandContent()
   	{
		$maincatid = $_GET['maincatid'];
		$sql = "SELECT b.html_content FROM category_table a INNER JOIN html_contents_table b ON a.category_content_id = b.html_content_id WHERE a.category_id =".$maincatid;
		$obj = new Bin_Query();
		if($obj->executeQuery($sql))
			$output = Display_DFeaturedItems::landContent($obj->records);
		else 
			$output='';
		return $output;
		
   	}
	/**
	 * This function is used to get the sub  category 
	 * 
	 * 
	 * @return string
	 */
	function getSubcatlandContent()
   	{
		$subcatid = $_GET['subcatid'];
		$sql = "SELECT b.html_content FROM category_table a INNER JOIN html_contents_table b ON a.category_content_id = b.html_content_id WHERE a.category_id =".$subcatid;
		$obj = new Bin_Query();
		if($obj->executeQuery($sql))
			$output = Display_DFeaturedItems::landContent($obj->records);
		else
			$output=Display_DFeaturedItems::landContent($obj->records);
		
		return $output;
   	}
	/**
	 * This function is used to show the main category 
	 * 
	 * 
	 * @return string
	 */
	function showMainCategory()
	{
		$query = new Bin_Query();
		$sql = "SELECT category_name, category_id,category_image FROM `category_table` WHERE category_parent_id =0 AND category_status =1 ORDER BY category_name ASC";
		
		if($query->executeQuery($sql))
		{
			$output = Display_DFeaturedItems::showMainCategory($query->records);
		}
		else
			$output='No Main Category Listed';
		return $output;
	}
	
	/**
	 * This function is used to show the main category  featured product
	 * 
	 * 
	 * @return string
	 */
	function showMaincatFeaturedProduct()
	{	
		
		$query = new Bin_Query();
		
		$sql ="SELECT pt.*,sum(c.rating)/count(c.user_id) as rating FROM `products_table` as pt Inner join product_inventory_table as pinv on pt.product_id=pinv.product_id left join product_reviews_table c on pt.product_id=c.product_id WHERE category_id IN (SELECT b.category_id AS id FROM category_table a INNER JOIN category_table b ON a.category_id = b.category_parent_id WHERE a.category_id =".(int)$_GET['maincatid']." ) and is_featured=1 and status=1 and pt.intro_date <= '".date('Y-m-d')."' group by pt.product_id ORDER BY rand() LIMIT 0,4";

		if($query->executeQuery($sql))
		{
			$flag =0;
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
						$minval=Core_CWishList::disRates($prid);
						if($minval > 0  or $minval!='')
							$r[$j]['msrp']= '$'.number_format($row['msrp'],2).' - $'.number_format($minval,2);
						else
							$r[$j]['msrp']= '$'.number_format($row['msrp'],2);
						$j++;
					}
				}
				
				$output= Display_DFeaturedItems::showFeaturedItems($query->records,$flag,$r);
			}
			
		}
		else
		{

			//$sql='SELECT * FROM `products_table` WHERE category_id='.(int)$_GET['maincatid'].' and status=1 ORDER BY rand( ) LIMIT 0,4';
			$sql="SELECT * FROM `products_table` WHERE category_id=".(int)$_GET['maincatid']." and status=1 and intro_date <= '".date('Y-m-d')."' and status=1  ORDER BY rand( ) LIMIT 0,4";
			if($query->executeQuery($sql))
			{
				$flag =1;
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
							$minval=Core_CWishList::disRates($prid);
							if($minval > 0  or $minval!='')
								$r[$j]['msrp']= '$'.number_format($row['msrp'],2).' - $'.number_format($minval,2);
							else
								$r[$j]['msrp']= '$'.number_format($row['msrp'],2);
							$j++;
						}
					}
					$output= Display_DFeaturedItems::showFeaturedItems($query->records,$flag,$r);
				}
			}
		}
	
		return $output;
	}
	/**
	 * This function is used to show the  featured product
	 * @param string $skin
	 * 
	 * @return string
	 */
	function showFeaturedProduct($skin)
	{
		$query = new Bin_Query();
		
		$sql ="SELECT * FROM `products_table` where category_id in(SELECT category_id FROM category_table WHERE category_id=".(int)$_GET['subcatid']." and category_status=1 and  category_name!='Gift Voucher' ) and is_featured=1 and status=1 and intro_date <= '".date('Y-m-d')."'  and a.product_status!='3'";
		if($query->executeQuery($sql))
		{
			$flag =0;
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
						$minval=Core_CWishList::disRates($prid);
						if($minval > 0  or $minval!='')
							$r[$j]['msrp']= '$'.number_format($row['msrp'],2).' - $'.number_format($minval,2);
						else
							$r[$j]['msrp']= '$'.number_format($row['msrp'],2);
						$j++;
					}
				}
				$output = Display_DFeaturedItems::showSubCatFeaturedItems($query->records,$skin,$flag,$r);
			}
			
		}
		
		
		return $output;
	}
	/**
	 * This function is used to show the  featured product in iphone and so on
	 * 
	 * @return string
	 */
	function featuredProductsHidden()
	{
		$sql = "SELECT a.*,sum(c.rating)/count(c.user_id) as rating FROM `products_table` a left join product_reviews_table c on a.product_id=c.product_id WHERE  is_featured=1 and a.status=1 and a.intro_date <= '".date('Y-m-d')."' and a.gift!='1' and a.product_status!='3' group by a.product_id  ORDER BY rand( ) ";	
		$query = new Bin_Query();
		if($query->executeQuery($sql))
		{
			$flag='0';
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
						$minval=Core_CWishList::disRates($prid);
						if($minval > 0  or $minval!='')
							$r[$j]['msrp']= '$'.number_format($row['msrp'],2).' - $'.number_format($minval,2);
						else
							$r[$j]['msrp']= '$'.number_format($row['msrp'],2);
						$j++;
					}
				}
				$output= Display_DFeaturedItems::featuredProductsHidden($query->records,$flag,$r);
			}
		}

		return $output;
	}
	/**
	 * This function is used to show the  new product 
	 * 
	 * @return string
	 */
	function newArrivalProducts()
	{
		 $sql = "SELECT a.*,sum(c.rating)/count(c.user_id) as rating FROM `products_table` a left join product_reviews_table c on a.product_id=c.product_id WHERE  a.product_status=1 and a.status=1 and a.intro_date <= '".date('Y-m-d')."' and a.gift!='1'  and a.product_status!='3' group by a.product_id  ORDER BY rand( ) "; 	
		$query = new Bin_Query();
		if($query->executeQuery($sql))
		{
			$flag='0';
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
						$minval=Core_CWishList::disRates($prid);
						if($minval > 0  or $minval!='')
							$r[$j]['msrp']= '$'.number_format($row['msrp'],2).' - $'.number_format($minval,2);
						else
							$r[$j]['msrp']= '$'.number_format($row['msrp'],2);
						$j++;
					}
				}
				$output= Display_DFeaturedItems::newArrivalProducts($query->records,$flag,$r);
			}
		}

		return $output;
	}
	/**
	 * This function is used to show the  show products of sub category
	 * @param string $skin
	 * 
	 * @return string
	 */
	
	function showProducts($skin)
	{
		$query = new Bin_Query();
		
		$sql="SELECT * FROM `products_table` WHERE category_id=".(int)$_GET['subcatid']." and status=1 and intro_date <= '".date('Y-m-d')."' and status=1 and product_status!='3' ORDER BY rand( )";
		if($query->executeQuery($sql))
		{
			$flag =1;
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
						$minval=Core_CWishList::disRates($prid);
						if($minval > 0  or $minval!='')
							$r[$j]['msrp']= '$'.$row['msrp'].' - $'.$minval;
						else
							$r[$j]['msrp']= '$'.$row['msrp'];
						$j++;
					}
				}
				$output = Display_DFeaturedItems::showSubCatFeaturedItems($query->records,$skin,$flag,$r);
			}
		}
		else
			$output = Display_DFeaturedItems::showFeaturedItemsElse();
		return $output;
	}
	/**
	 * This function is used to show select all featured product from all main category & show it in index page
	 * 
	 * 
	 * @return string
	 */
	function featuredProducts()
	{	
	
	 $sql = "SELECT a.*,sum(c.rating)/count(c.user_id) as rating FROM `products_table` a left join product_reviews_table c on a.product_id=c.product_id WHERE  is_featured=1 and a.status=1 and a.intro_date <= '".date('Y-m-d')."' and a.product_status!='3' and a.gift!='1' group by a.product_id  ORDER BY rand( ) "; 
	
	$query = new Bin_Query();
		if($query->executeQuery($sql))
		{
			$flag='0';
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
						$minval=Core_CWishList::disRates($prid);
						if($minval > 0  or $minval!='')
							$r[$j]['msrp']= '$'.number_format($row['msrp'],2).' - $'.number_format($minval,2);
						else
							$r[$j]['msrp']= '$'.number_format($row['msrp'],2);
						$j++;
					}
				}
				$output= Display_DFeaturedItems::showFeaturedItems($query->records,$flag,$r);
			}
		}
		else
		{
			$flag='1';
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
						$minval=Core_CWishList::disRates($prid);
						if($minval > 0  or $minval!='')
							$r[$j]['msrp']= '$'.number_format($row['msrp'],2).' - $'.number_format($minval,2);
						else
							$r[$j]['msrp']= '$'.number_format($row['msrp'],2);
						$j++;
					}
				}

				
				$output= Display_DFeaturedItems::showFeaturedItems($query->records,$flag,$r);
			}
		}
		return $output;
	}
	/**
	 * This function is used to show rating
	 * @param integer $productid
	 * 
	 * @return string
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
	 * This function is used to select the sub category
	 * 
	 * 
	 * @return string
	 */
	
	function selectFeaturedSubCategory()
	{
		//$sql= 'SELECT * FROM `products_table` where category_id in(SELECT category_id FROM category_table WHERE category_id='.(int)$_GET['subcatid'].' and is_featured=1 and category_status=1)';
		$sql= "SELECT * FROM `products_table` where category_id in(SELECT category_id FROM category_table WHERE category_id=".(int)$_GET['subcatid']." and is_featured=1 and intro_date <= '".date('Y-m-d')."' and category_status=1)";
		$query = new Bin_Query();
		if($query->executeQuery($sql))
		{
			return  Display_DFeaturedItems::showFeaturedItems($query->records);
		}
		else
		{
			return "No Products Found";
		}
		
	}
	/**
	 * This function is used to get main category bread crumb
	 * 
	 * 
	 * @return string
	 */
	
	function maincatBreadCrumb()
	{
		$sql='SELECT a.category_name AS Category, a.category_id AS maincatid FROM category_table a WHERE a.category_id ='.(int)$_GET['maincatid'];
		$query = new Bin_Query();
		if($query->executeQuery($sql))
			return  Display_DFeaturedItems::maincatBreadCrumb($query->records);
	}
	/**
	 * This function is used to get sub category bread crumb
	 * 
	 * 
	 * @return string
	 */
	function subcatBreadCrumb()
	{
		$sql='SELECT a.category_name AS Category, a.category_id AS maincatid,b.category_name as SubCategory,b.category_id as subcatid FROM category_table a INNER JOIN category_table b ON a.category_id = b.category_parent_id WHERE b.category_id ='.(int)$_GET['subcatid'];
		$query = new Bin_Query();
		if($query->executeQuery($sql))
			return  Display_DFeaturedItems::subcatBreadCrumb($query->records);
	}
	/**
	 * This function is used to show the best selling product
	 * 
	 * 
	 * @return string
	 */
	function showBestSellingProducts()
	{
		
				$sql = "SELECT orders.product_id, sum( orders.product_qty ) AS cnt , prod.title , prod.category_id , prod.thumb_image, cat.category_name, prod.msrp
				FROM order_products_table orders , products_table prod , category_table cat 
				WHERE orders.product_id=prod.product_id and prod.category_id=cat.category_id and prod.intro_date <= '".date('Y-m-d')."' AND status=1 
				GROUP BY orders.product_id
				ORDER BY cnt DESC
				LIMIT 4 ";
		$query = new Bin_Query();
		if($query->executeQuery($sql))
		{		
				$output= Display_DFeaturedItems::showBestSellingProducts($query->records);
		}
		
		return $output;
	}
	/**
	 * This function is used to show search page
	 * 
	 * 
	 * @return string
	 */
	function dispSearch()
	{
		$search=$_SESSION['search_option'];
		
		foreach(array_values($search) as $val)
		{
			$arr[]=$val;
		}
		$cnt=count($arr);
		for($i=0;$i<$cnt;$i++)
		{
			
			$sql="select t1.attrib_name,t2.attrib_value from attribute_table t1, attribute_value_table t2 where t2.attrib_value_id=".$arr[$i]." and t1.attrib_id=t2.attrib_id";
			$query = new Bin_Query();
			if($query->executeQuery($sql))
			{
				$tmp[]=$query->records;
			}
			
		}
		if(array_key_exists("Brand",$search))
			$brand=$search['Brand'];
		else
			$brand="";
		
		if(array_key_exists("Price",$search))
			$price=$search['Price'];
		else
			$price="";
		
		return  Display_DFeaturedItems::dispSearch($tmp,$brand,$price);	
	}
	/**
	 * This function is used to show the narrow search
	 * 
	 * 
	 * @return string
	 */
	function dispNarrow()
	{
		
		$id=(int)$_GET['subcatid'];
		if(is_int($id))
		{

			$searchoption=$_SESSION['search_option'];
		
			
			$arr="";
			for ($i = 0; $i <  count($searchoption); $i++) 
			{
				$key=key($searchoption);
				$val=$searchoption[$key];
				if ($key<> ''&& $key<> 'Brand'&& $key<> 'Price') 
				{
					if($i!=0)
					$arr.=" AND pavt.attrib_value_id=".$val;
				}
				next($searchoption);
			}
			
			$att=strlen($arr)-2;
			$attr=substr($arr,0,$att);
			$sql='SELECT attrib_id FROM category_attrib_table WHERE subcategory_id='.$id;
			$query = new Bin_Query();
			$query->executeQuery($sql);
			$cnt=count($query->records);
		
			for($i=0;$i<$cnt;$i++)
			{
				$sq='SELECT a.attrib_name,b.* 
				     FROM attribute_table a,attribute_value_table b 
				     WHERE a.attrib_id=b.attrib_id AND a.attrib_id='.$query->records[$i]['attrib_id'];
				     
		          	 $que = new Bin_Query();
			  	 if($que->executeQuery($sq))
				 {
					$narrowdata[]=$que->records;
					
					for($j=0;$j<count($narrowdata[$i]) ; $j++)			
					{						
						 $sql =' SELECT count(distinct(product_id))  as cnt
						FROM  `product_attrib_values_table` 
						WHERE attrib_value_id ='.$narrowdata[$i][$j]['attrib_value_id'].' AND ';
						
												
						$sql.=' product_id
						IN (';
						$sql.=Core_CFeaturedItems::evaluate($id);
						$sql.='	)';
						
						
									
						 $que = new Bin_Query();
						 $que->executeQuery($sql);	
						 $narrowdata[$i][$j]['products_count']=$que->records[0]['cnt'];
						
					}
					
				}
			}
		
			return Display_DFeaturedItems::displayNarrow($narrowdata);
		}
			
	}
	/**
	 * This function is used to show the price narrow search
	 * 
	 * 
	 * @return string
	 */
	function dispPriceNarrow()
	{
		$searchoption=$_SESSION['search_option'];

		$id=(int)$_GET['subcatid'];
		
		if(is_int($id) && $id > 0)
		{
			$sql='SELECT max(msrp) as maximum FROM products_table WHERE category_id='.$id;
			$query = new Bin_Query();
			$query->executeQuery($sql);
			if(count($query->records) > 0 )
				$maximum=$query->records[0];
			$maxi=$maximum['maximum'];
			$interval=ceil($maxi/5);
			
			$i=0;
			while($i<$maxi)
			{
				$j=$i+$interval;
				$sql='SELECT count(msrp) as count,msrp FROM products_table WHERE msrp >'.$i.' and msrp <= '.$j.' and ';
				$sql.=' product_id
						IN (';
						$sql.=Core_CFeaturedItems::evaluate($id);
						$sql.='	)';
				if($searchoption['Brand'])
				$sql.=" and brand='".$searchoption['Brand']."'";
				
				$sql.=' group by msrp';
				$query = new Bin_Query();
				$query->executeQuery($sql);
				$tmp[]=$query->records;
				$range[]=$_SESSION['currencysetting']['selected_currency_settings']['currency_tocken']." ".($i+1)*$_SESSION['currencysetting']['selected_currency_settings']['conversion_rate']."- ".$_SESSION['currencysetting']['selected_currency_settings']['currency_tocken']." ".$j*$_SESSION['currencysetting']['selected_currency_settings']['conversion_rate'];
				$i=$j;
				
			}
		
			return Display_DFeaturedItems::displayPriceNarrow($tmp,$range);
		}
			
	}
	/**
	 * This function is used to show the brand narrow search
	 * 
	 * 
	 * @return string
	 */
	function dispBrandNarrow()
	{
		$searchoption=$_SESSION['search_option'];
		$id=(int)$_GET['subcatid'];
		if(is_int($id) && $id > 0)
		{
			$sql='SELECT count(brand) as count,brand FROM products_table WHERE ';
			$sql.=' product_id
						IN (';
						$sql.=Core_CFeaturedItems::evaluate($id);
						$sql.=')';
			if($searchoption['Price'])
			$sql.=" and msrp=".$searchoption['Price']."";
			$sql.=' group by brand';
			$query = new Bin_Query();
			$query->executeQuery($sql);
			if(count($query->records) > 0 )
				return Display_DFeaturedItems::displayBrandNarrow($query->records);
		}
			
	}
	
	/**
	 * This function is used to show the view product
	 * 
	 * 
	 * @return string
	 */
	
	function viewProducts()
	{
		$id=(int)$_GET['subcatid'];
		
		if(isset($_GET['rtype']))
		{
			$get=$_GET['rtype'];
			if(array_key_exists($get,$_SESSION['search_option']))
			{	
				$search=$_SESSION['search_option'];
				unset($search[$get]);
				$_SESSION['search_option']=$search;
				if($_GET['rtype']=="Price")
				{
					$_SESSION['range']="";
				}
			}
		}
		if(!isset($_SESSION['search_option']))
		{
			$_SESSION['search_option']=array();
		}
		if(array_key_exists($_GET['type'],$_SESSION['search_option']))
		{
			$div='';			
		}
		else
		{
			$arr=$_SESSION['search_option'];
			$arr[$_GET['type']]=$_GET['val'];
			$_SESSION['search_option']=$arr;
			if($_GET['type']=='Price')
			$_SESSION['range']=$_GET['range'];
		}
		
		$searchoption=$_SESSION['search_option'];
	
		$arr="";
		for ($i = 0; $i <  count($searchoption); $i++) 
		{
			$key=key($searchoption);
			$val=$searchoption[$key];
			if ($key<> ''&& $key<> 'Brand'&& $key<> 'Price') 
			{
				if($i!=0)
		       		$arr.=" attrib_value_id=".$val." AND";
			}
		     	next($searchoption);
		}
		
		if(is_int($id) && $id > 0)
		{
			
			$sql= 'SELECT * from products_table where';
			$sql.=' product_id IN (';
			$sql.=Core_CFeaturedItems::evaluate($id);
	    	$sql.='	)';
			
			$query = new Bin_Query();
			
			if($query->executeQuery($sql))
			{
				return  Display_DFeaturedItems::viewProducts($query->records);
			}
			else
			{
				return '<div align="center"><font color="orange" size=2><b>No Records Found</b></div>';
			}
		}
		
	}
	
	/**
	 * This function is used to evaluate the product with search  option
	 * @param integer $id
	 * 
	 * @return string
	 */
	function evaluate($id)
	{
		$searchoption=$_SESSION['search_option'];
		$arr="";
		for ($i = 0; $i <  count($searchoption); $i++) 
		{
			$key=key($searchoption);
			$val=$searchoption[$key];
			if ($key<> ''&& $key<> 'Brand'&& $key<> 'Price') 
			{
				$attr[].=$val;
					       		
			}
		     	next($searchoption);
		}
		//$len_attr=strlen($attr);
		//$attr=substr($attr,0,($len_attr-1));
		
		$sql="SELECT product_id FROM products_table WHERE category_id=".$id." ";
		if($searchoption['Brand'])
		$sql.=" and brand='".$searchoption['Brand']."'";
		if($searchoption['Price'])
		$sql.=" and msrp='".$searchoption['Price']."'";

		$query = new Bin_Query();
		if($query->executeQuery($sql))
		{
			$arr_val=$query->records;
		}
		if(count($attr) > 0)
		{
			for($i=0;$i<count($arr_val);$i++)
			{
				$sql_query="SELECT attrib_value_id FROM product_attrib_values_table WHERE product_id=".$arr_val[$i]['product_id'];
				$query = new Bin_Query();
				if($query->executeQuery($sql_query))
				{
					$tmp=$query->records;
				}
				$val="";
				for($j=0;$j<count($tmp);$j++)
				{
					$val[].=$tmp[$j][attrib_value_id];
				}
				
				if(Core_CFeaturedItems::inArray($val,$attr))
				{
					$product_id.=$arr_val[$i]['product_id'].",";
				}
				
			}
			$len_product_id=strlen($product_id);
			$product_id=substr($product_id,0,($len_product_id-1));
			
			return $product_id;
		}
		else
		{
			for($i=0;$i<count($arr_val);$i++)
			{
				$product_id.=$arr_val[$i]['product_id'];
				if($i!=(count($arr_val)-1))
				$product_id.=",";
			}
			return $product_id;
		}
		
		
		
	}
	/**
	 * This function is used to find the array
	 * @param array $array
	 * @param array $key 	
	 * 
	 * @return string
	 */	
	
	function inArray($array, $key)
	{
	  if(func_num_args() == 2 && is_string($key))
	    return in_array($key, $array);
	  else if(func_num_args() == 2 && is_array($key))
	  {
	    $r = true;
	    for($i=0; $i < count($key); $i++)
	      $r = (!in_array($key[$i], $array)) ? false : $r;
	   
	    return $r;
	  }
	  else if(func_num_args > 2)
	  {
	    $args = func_get_args();
	    $r = true;
	    for($i=1; $i < count($args); $i++)
	      $r = (!in_array($args[$i], $array)) ? false : $r;
	   
	    return $r;
	  }
	}
	/**
	 * This function is used to get the tag clouds
	 * 
	 * @return string
	 */	
	function displayTagClouds()
	{
		$sql='select search_tag as keyword,search_count as cnt from search_tags_table order by search_count desc' ;
		$obj=new Bin_Query();
		$obj->executeQuery($sql);
		$val=$obj->records;
				
		$arr=array();
		foreach($obj->records as $row)
			$arr[$row['keyword']]=$row['cnt'];
		
		$onClick='?do=search&search=';
					
		$odjCloud=new Lib_TagClouds();
		$res=$odjCloud->displayTagClouds($arr,$onClick);
		
		return $res;
	}
	
	
	
		
}	
?>