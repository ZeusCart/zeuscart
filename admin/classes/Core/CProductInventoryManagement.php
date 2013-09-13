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
 * This class contains functions to get and update the inventory details 
 *
 * @package  		Core_CProductInventoryManagement
 * @category  		Core
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
   * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */


class Core_CProductInventoryManagement
{
	
	 /**
	 * Function gets the inventory details from the database
	 * 
	 * 
	 * @return string
	 */
	 
	 
	 function dispInventory()
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
	 	
	 	
	 	$sql='select a.*,b.title from product_inventory_table a inner join products_table b on a.product_id=b.product_id';
	 	
	 	$query = new Bin_Query();
	 	if($query->executeQuery($sql))
	 	{	
	 		$total = ceil($query->totrows/ $pagesize);
	 		include_once('classes/Lib/Paging.php');
	 		$tmp = new Lib_Paging('classic',array('totalpages'=>$total, 'length'=>10),'pagination');
	 		$this->data['paging'] = $tmp->output;
	 		$this->data['prev'] =$tmp->prev;
	 		$this->data['next'] = $tmp->next;
	 		
	 		$sql1 = "select a.*,b.title from product_inventory_table a inner join products_table b on a.product_id=b.product_id  LIMIT $start,$end";
	 		$query1 = new Bin_Query();
	 		
	 		$query1->executeQuery($sql1);
	 	}
	 	return Display_DProductInventoryManagement::dispInventory($query1->records,$this->data['paging'],$this->data['prev'],$this->data['next']);
	 	
	 	
	  // $obj=new Bin_Query();
	   //$obj->executeQuery($sql);
	  // return Display_DProductInventoryManagement::dispInventory($obj->records);
	 }
	 
	/**
	 * Function gets the inventory details from the database
	 * 
	 * 
	 * @return string
	 */
	
	function editInventory()
	{
		$id=$_GET['id']; 
		$sql='select a.*,b.title from product_inventory_table a inner join products_table b on a.product_id=b.product_id where a.inventory_id='.$id;
		$obj=new Bin_Query();
		$obj->executeQuery($sql);
		return Display_DProductInventoryManagement::editInventory($obj->records);
	}
	
	/**
	 * Function deletes the selected inventory from the database
	 * 
	 * 
	 * @return string
	 */
	function deleteInventory()
	{
		$id=$_GET['id'];
		$sql='delete from product_inventory_table where inventory_id='.$id;
		$obj=new Bin_Query();
		$obj->updateQuery($sql);
	}
	
	/**
	 * Function updates the inventory details to the database
	 * 
	 * 
	 * @return string
	 */
	
	function updateInventory()
	{
		$id=(int)$_POST['invid'];
		$rol=(int)$_POST['rol'];
		$soh=(int)$_POST['soh'];
		$sql="update product_inventory_table set rol=".$rol.", soh=".$soh." where inventory_id=".$id;
		$obj=new Bin_Query();
		$obj->updateQuery($sql);
		
	}
}
?>