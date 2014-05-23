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
 * Add feartured products related  class
 *
 * @package   		Core_CAllFeatured
 * @category    	Core
 * @author    		AJ Square Inc Dev Team
 * @link   		http://www.zeuscart.com
 * @copyright 	        Copyright (c) 2008 - 2013, AJ Square, Inc.
 * @version   		Version 4.0
 */
class Core_CAllFeatured
{

	/**
	 * This function is used to show the all feartured product page.
	 *
	 * 
	 * 
	 * @return string
	 */	
	function showAllFeatured()
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
		
	
		$sql = "SELECT a.*,sum(c.rating)/count(c.user_id) as rating FROM `products_table` a left join product_reviews_table c on a.product_id=c.product_id WHERE category_id IN (SELECT b.category_id AS id FROM category_table a INNER JOIN category_table b ON a.category_id = b.category_parent_id ORDER BY rand()) and is_featured=1 and a.status=1 and a.intro_date <= '".date('Y-m-d')."' group by a.product_id";
		$query = new Bin_Query();
		
		if($query->executeQuery($sql))
		{	
			$total = ceil($query->totrows/ $pagesize);
			include('classes/Lib/Paging.php');
			$tmp = new Lib_Paging('classic',array('totalpages'=>$total, 'length'=>10),'pagination');
			$this->data['paging'] = $tmp->output;
			$this->data['prev'] =$tmp->prev;
			$this->data['next'] = $tmp->next;	
		
			$sql = "SELECT a.*,sum(c.rating)/count(c.user_id) as rating FROM `products_table` a left join product_reviews_table c on a.product_id=c.product_id WHERE category_id IN (SELECT b.category_id AS id FROM category_table a INNER JOIN category_table b ON a.category_id = b.category_parent_id ORDER BY rand()) and is_featured=1 and a.status=1 and a.intro_date <= '".date('Y-m-d')."' group by a.product_id limit $start,$end";
			$obj = new Bin_Query();
	
			if($obj->executeQuery($sql))
			{
				 return Display_DUserAccount::showAllFeatured($obj->records,$this->data['paging'],$this->data['prev'],$this->data['next'],$start);
			}	
			else
				return 'No Products Found!';
		}
		else
			return 'No Products Found!';
		
	}
	/**
	 * This function is used to get the all feartured product page from db.
	 *
	 * 
	 * 
	 * @return string
	 */
	function getAllFeatured()
	{
	
	$sql = "SELECT a.*,sum(c.rating)/count(c.user_id) as rating FROM `products_table` a left join product_reviews_table c on a.product_id=c.product_id WHERE category_id IN (SELECT b.category_id AS id FROM category_table a INNER JOIN category_table b ON a.category_id = b.category_parent_id ORDER BY rand()) and is_featured=1 and a.status=1 and a.intro_date <= '".date('Y-m-d')."' group by a.product_id limit 0,3";
	
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
	
}
?>
