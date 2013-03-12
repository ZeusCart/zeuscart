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
 * Last view products related  class
 *
 * @package   		Core_CLastViewedProducts
 * @category    	Core
 * @author    		AJ Square Inc Dev Team
 * @link   		http://www.zeuscart.com
  * @copyright 	        Copyright (c) 2008 - 2013, AJ Square, Inc.
 * @version   		Version 4.0
 */
class Core_CLastViewedProducts
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
	 * This function is used to show the last viewed products
 	 * 
	 * @return string
	 */
	function lastViewedProducts()
	{
 		 $cnt=count($_SESSION['LastViewed']);
		  if($cnt>4)
		 {
		 	$j = $cnt-1;
		 	while($k<4)
			{
				$arr[$j]=$_SESSION['LastViewed'][$j];
				$j--;
				$k++;
			}
		  }
		  else
		  {
		  	for($i=0;$i<$cnt;$i++)
				$arr[$i] = $_SESSION['LastViewed'][$i];
		  }
		
		if($arr!='')
		{
				$product_ids='"'.implode('","',$arr).'"';
				$sql= "SELECT a.product_id,a.title,a.thumb_image,a.msrp,b.soh,sum(c.rating)/count(c.user_id) as
			rating FROM products_table as a INNER JOIN product_inventory_table as b ON a.product_id=b.product_id left join product_reviews_table c on a.product_id=c.product_id WHERE a.product_id in(".$product_ids.") and a.intro_date <= '".date('Y-m-d')."' AND a.status=1 group by a.product_id ORDER BY title ASC";
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
								$minval=Core_CLastViewedProducts::disRates($prid);
								if($minval > 0  or $minval!='')
								{
									//$r[$j]['msrp']= '$'.number_format($row['msrp'],2).' - $'.number_format($minval,2);
									$r[$j]['msrp']= $_SESSION['currencysetting']['selected_currency_settings']['currency_tocken'].number_format($row['msrp']*$_SESSION['currencysetting']['selected_currency_settings']['conversion_rate'],2).' - '.$_SESSION['currencysetting']['selected_currency_settings']['currency_tocken'].number_format($minval*$_SESSION['currencysetting']['selected_currency_settings']['conversion_rate'],2);
								}
								else
									$r[$j]['msrp']= $_SESSION['currencysetting']['selected_currency_settings']['currency_tocken'].number_format($row['msrp']*$_SESSION['currencysetting']['selected_currency_settings']['conversion_rate'],2);
								$j++;
							}
							
							$output = Display_DLastViewedProducts::lastViewedProducts($query->records,$r);
						}
					}
					
				}
			
		}
		else
			$output = Display_DLastViewedProducts::lastViewedProductsElse();
		return $output;	
	}
	/**
	 * This function is used to show the rating
 	 * @param integer  $productid
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
}
?>