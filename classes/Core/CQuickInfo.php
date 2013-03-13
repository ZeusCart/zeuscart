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
 * Quick information related  class
 *
 * @package   		Core_CQuickInfo
 * @category    	Core
 * @author    		AJ Square Inc Dev Team
 * @link   		http://www.zeuscart.com
  * @copyright 	        Copyright (c) 2008 - 2013, AJ Square, Inc.
 * @version   		Version 4.0
 */
class Core_CQuickInfo
{
/**
 * This function is used to get  the   quick information 
 *
 * .
 * 
 * @return array 
 */
function showInfo()
{
	include('classes/Display/DQuickInfo.php');
	
	 $sqlselect="SELECT a.product_id,a.title,a.price,case when a.status=1 then 'Yes' else 'No' end as status,a.shipping_cost,a.description,a.cse_enabled,a.sku,b.rating,a.image,a.msrp from products_table a left join product_reviews_table b on a.product_id=b.product_id where a.status=1 AND  a.product_id=".(int)$_GET['prodid']." LIMIT 0,1";
	
	$obj = new Bin_Query();

	if($obj->executeQuery($sqlselect))
	{
				$j=0;			
				foreach($obj->records as $row)
				{
					$r[$j]=$row;
					$prid=$row['product_id'];
					$minval=Core_CQuickInfo::disRates($prid);
					if($minval > 0  or $minval!='')
					{
						
						$r[$j]['msrp']= $_SESSION['currencysetting']['selected_currency_settings']['currency_tocken'].number_format($row['msrp']*$_SESSION['currencysetting']['selected_currency_settings']['conversion_rate'],2).' - '.$_SESSION['currencysetting']['selected_currency_settings']['currency_tocken'].number_format($minval*$_SESSION['currencysetting']['selected_currency_settings']['conversion_rate'],2);
					}
					else
						$r[$j]['msrp']= $_SESSION['currencysetting']['selected_currency_settings']['currency_tocken'].number_format($row['msrp']*$_SESSION['currencysetting']['selected_currency_settings']['conversion_rate'],2);							
					$j++;
				}
				return  Display_DQuickInfo::showInfo($obj->records[0],$r);
			}			 
		 
		
	}	
	/**
	 * This function is used to get the rating from db
	 * @param integer $productid
	 * .
	 * 
	 * @return array 
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
