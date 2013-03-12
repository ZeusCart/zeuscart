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
 * Add new products related  class
 *
 * @package   		Core_CAllNew
 * @category    	Core
 * @author    		AJ Square Inc Dev Team
 * @link   		http://www.zeuscart.com
  * @copyright 	        Copyright (c) 2008 - 2013, AJ Square, Inc.
 * @version   		Version 4.0
 */
class Core_CAllNew
{

	/**
	 * This function is used to show the all new product page.
	 *
	 * 
	 * 
	 * @return string
	 */
	function showAllNew()
	{
		include('classes/Display/DUserAccount.php');
		$pagesize=8;
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
		
		$sql= " SELECT a.product_id, a.title, a.thumb_image, a.msrp, a.intro_date,b.soh,sum(c.rating)/count(c.user_id) as
			rating FROM products_table a INNER JOIN	product_inventory_table b ON a.product_id=b.product_id left join product_reviews_table c on a.product_id=c.product_id WHERE a.intro_date <= '".date('Y-m-d')."' and a.status=1 group by a.product_id";
		$query = new Bin_Query();
		if($query->executeQuery($sql))
		{	
			$total = ceil($query->totrows/ $pagesize);
			include('classes/Lib/Paging.php');
			$tmp = new Lib_Paging('classic',array('totalpages'=>$total, 'length'=>10),'pagination');
			$this->data['paging'] = $tmp->output;
			$this->data['prev'] =$tmp->prev;
			$this->data['next'] = $tmp->next;	
	
			
			$sql= " SELECT a.product_id, a.title, a.thumb_image, a.msrp, a.intro_date,b.soh,sum(c.rating)/count(c.user_id) as
			rating 	FROM products_table a INNER JOIN product_inventory_table b ON a.product_id=b.product_id left join product_reviews_table c on a.product_id=c.product_id WHERE a.intro_date <= '".date('Y-m-d')."' and a.status=1 group by a.product_id order by a.intro_date desc limit $start,$end";
			$obj = new Bin_Query();
	
			if($obj->executeQuery($sql))
			{
				 return Display_DUserAccount::showAllNew($obj->records,$this->data['paging'],$this->data['prev'],$this->data['next'],$start);
			}	
			else
				return 'No Products Found!';
		}
		else
			return 'No Products Found!';
		
	}
}
?>
