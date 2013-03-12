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
 * This class contains functions to get the details of the best selling products.
 *
 * @package  		Core_CBestSellingProducts
 * @category  		Core
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
   * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */


class Core_CBestSellingProducts
{
	
	/**
	 * Function generates the data need for showing the best selling products
	 * 
	 * 
	 * @return string
	 */

	function showBestSellingProducts()
	{
		
	   $pagesize=25;
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
		
		
		$sql = "SELECT orders.product_id, sum( orders.product_qty ) AS cnt , prod.title , prod.category_id , prod.thumb_image, cat.category_name, prod.msrp FROM order_products_table orders , products_table prod , category_table cat WHERE orders.product_id=prod.product_id and prod.category_id=cat.category_id and prod.intro_date <= now() AND status=1 GROUP BY orders.product_id ORDER BY cnt DESC";
		$query = new Bin_Query();
		if($query->executeQuery($sql))
		{	
			$total = ceil($query->totrows/ $pagesize);
			include_once('classes/Lib/Paging.php');
			$tmp = new Lib_Paging('classic',array('totalpages'=>$total, 'length'=>10),'pagination');			
			$this->data['paging'] = $tmp->output;
			$this->data['prev'] =$tmp->prev;
			$this->data['next'] = $tmp->next;
			
			$sql1 = "SELECT orders.product_id, sum( orders.product_qty ) AS cnt , prod.title , prod.category_id , prod.thumb_image, cat.category_name, prod.msrp FROM order_products_table orders , products_table prod , category_table cat WHERE orders.product_id=prod.product_id and prod.category_id=cat.category_id and prod.intro_date <= now() AND status=1 GROUP BY orders.product_id ORDER BY cnt DESC LIMIT $start,$end";
			$query1 = new Bin_Query();
			
			if($query1->executeQuery($sql1))
			{
				return Display_DBestSellingProducts::showBestSellingProducts($query1->records,$this->data['paging'],$this->data['prev'],$this->data['next']);
			}
		}
		else
		{
			return "No Best Selling Products Found";
		}
	}
	
}
?>