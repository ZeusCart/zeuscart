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
 * This class contains functions to gets and update msrp by quantity prices.
 *
 * @package  		Core_CProductMsrpManagement
 * @category  		Core
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
 * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */



 class Core_CProductMsrpManagement
{

	/**
	 * Function displays product details with msrp by quantity  
	 * 
	 * 
	 * @return string
	 */
		

	function displayMsrpByQuantity()
	{
		$id=$_GET['id'];
		
		if(((int)$id)==0)
		{
			$sql='select max(product_id) as maxid from products_table';
		   	$obj=new Bin_Query();
			$obj->executeQuery($sql);
			$maxid=$obj->records;
			$id=$maxid[0]['maxid'];		   
		}		
	  
		if (((int)$id)>0)
		{
			$sql='select a.id,b.title,a.quantity,a.msrp from msrp_by_quantity_table a inner join products_table b on a.product_id=b.product_id where a.product_id='.$id;
			
			$obj=new Bin_Query();
			
			$obj->executeQuery($sql);	
			
			$sql1='select title from products_table where product_id='.$id.' limit 0,1';
			
			$obj1=new Bin_Query();
			
			$obj1->executeQuery($sql1);
			
			$prname=$obj1->records[0]['title'];
			
			return Display_DProductMsrpManagement::displayMsrpByQuantity($obj->records,$prname);
		}
		else
		{
		       // return 'The id Should not be Empty! Enter Correct Product Id';
		}
	}

	/**
	 * Function inserts a product with msrp by quantity 
	 * 
	 * 
	 * @return string
	 */
		

 	function insertMsrpByQuantity()
	{
		$id=$_POST['id'];
		$msrpid=$_POST['msrpid'];
		$quantity=$_POST['quantity'];
		$msrp=$_POST['msrp'];
		
		$obj=new Bin_Query();
		
		if((($quantity!='') or ($msrp!='')) and (((int)$quantity!=0) or ((int)$msrp!=0)))
		{
			$sql='insert into msrp_by_quantity_table (product_id,quantity,msrp)values('.$id.','.$quantity.','.$msrp.')';
	 		if($obj->updateQuery($sql))
			{
				return '<div class="success_msgbox">MSRP Added Successfully</div>';
			}
		}
		else
		{
			return '<div class="error_msgbox">The Quantity/Msrp should not be empty</div>';
		}
	}
	
	/**
	 * Function displays product details with msrp by quantity for updation   
	 * 
	 * 
	 * @return string
	 */
	   
	function editMsrpByQuantity()
	{
		$prid =$_GET['id'];
		$msrpid =$_GET['msrpid'];
		$sql='select a.id,b.title,a.quantity,a.msrp from msrp_by_quantity_table a inner join products_table b on a.product_id=b.product_id where a.product_id='.$prid.' and a.id='.$msrpid;
		
		$obj=new Bin_Query();
		
		$obj->executeQuery($sql);	
		
		return Display_DProductMsrpManagement::editMsrpByQuantity($obj->records);
	}
	
	
	/**
	 * Function updates the product details with msrp by quantity 
	 * 
	 * 
	 * @return string
	 */
	
	function updateMsrpByQuantity()
	{
	 	$prid=$_POST['id'];
		$msrpid=$_POST['msrpid'];
		$msrp=$_POST['msrp'];
		$quantity=$_POST['quantity'];
	
		$sql='update msrp_by_quantity_table set msrp='.$msrp.',quantity='.$quantity.' where product_id='.$prid.' and id='.$msrpid;
		$obj=new Bin_Query();
	
		if($obj->updateQuery($sql))
		{
			return '<div class="success_msgbox">MSRP Updated Successfully</div>';
		}
	}
	
	/**
	 * Function deletes the selected  product details 
	 * 
	 * 
	 * @return string
	 */
	
	function deleteMsrpByQuantity()
	{
		$msrpid=$_GET['msrpid'];
	   
		$sql='delete from msrp_by_quantity_table where id='.$msrpid;
	  
		$obj=new Bin_Query();
	  
		if($obj->updateQuery($sql))
		{
			return '<div class="success_msgbox">MSRP Deleted Successfully</div>';
		}
	}
	
}
?>