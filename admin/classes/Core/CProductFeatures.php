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
 * This class contains functions to gets the product features
 *
 * @package  		Core_CProductFeatures
 * @category  		Core
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
   * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */


class Core_CProductFeatures
{
	
	/**
	 * Function returns the category id from the database
	 * 
	 * @param integer $productid
	 *
	 * @return string
	 */
	

function findCategoryid($productid)
{
	$sql='select category_id from products_table where product_id='.$productid;
	$obj=new Bin_Query();
	$obj->executeQuery($sql);
	$val=$obj->records[0]['category_id'];
	return $val;
}

/**
	 * Function gets the product features from the database 
	 * 
	 * 
	 *
	 * @return string
	 */


function dispProductFeatures()
{
    $objcat=new Display_DProductFeatures();	
	
	//Checking from Product Insert or from Existing Product
	$id=$_GET['id'];
		if(((int)$id)==0)
		{
		 	$sql1='select max(product_id) as prdid from products_table';
		    $obj1=new Bin_Query();
		    $obj1->executeQuery($sql1);
		    $v=$obj1->records;
		    $productid=$v[0]['prdid'];
		 }
		else
		{
		    $productid=$id;
		}		
		
		//Finding the Category id by Products
		$catgoryid=$objcat->findCategoryid($productid);
	
		//Selecting the Attribute Name by using the CategoryId
	$sql_attribname='select * from attribute_table a inner join category_attrib_table b on a.attrib_id=b.attrib_id where b.subcategory_id='.$catgoryid;
	$obj_attribname=new Bin_Query();
	if($obj_attribname->executeQuery($sql_attribname))
	{
	    //Getting value from the post back of drop down attrib name by id
	    $attribid=$_POST['selattribname'];


		//Query to Display the Attrib name and Attribid
		$sql2="select distinct a.attrib_value,a.attrib_value_id from attribute_value_table a inner join attribute_table b on a.attrib_id=b.attrib_id inner join category_attrib_table c on c.attrib_id=b.attrib_id where a.attrib_id=".$attribid." and a.attrib_value_id not in(select attrib_value_id from product_attrib_values_table d where d.product_id=".$productid.")";
		$obj1attribvalues=new Bin_Query();
		$obj1attribvalues->executeQuery($sql2);		
		
		//Query to Display the Result which has an attribute  already Inserted for an product
		$sql_result="select c.attrib_name,b.attrib_value,a.product_id,a.product_attrib_value_id from product_attrib_values_table a inner join attribute_value_table b on b.attrib_value_id=a.attrib_value_id inner join attribute_table c on c.attrib_id=b.attrib_id where a.product_id=".$productid;		
		$obj_result=new Bin_Query();
		$obj_result->executeQuery($sql_result);
		
		//Query to Send the Productid and the Title Name for a particular product				
		$sql_title_id='select product_id,title from products_table where product_id='.$productid;
		$obj_title_id=new Bin_Query();
		$obj_title_id->executeQuery($sql_title_id);
		$v1=$obj_title_id->records;
		$title=$v1[0]['title'];
		$arr_title_id[]=$productid;
		$arr_title_id[]=$title;	
		return Display_DProductFeatures::dispProductFeatures($obj_attribname->records,$obj1attribvalues->records,$arr_title_id,$obj_result->records);	
		
	}
}

	/**
	 * Function adds the product features into database 
	 * 
	 * 
	 *
	 * @return string
	 */


	function insertProductFeatures()
	{
	 //   $product_id=$_POST['productid'];
	 $product_id=$_POST['productid'];
	 
		$attrib_value_id=$_POST['selattrib_value_id'];
		if($attrib_value_id!='')
		{
			$sql="insert into product_attrib_values_table ( product_id, attrib_value_id) values (".$product_id.",". $attrib_value_id.")";
			$obj=new Bin_Query();
			$obj->updateQuery($sql);	
		}
		header('location:?do=productfeatures&id='.$product_id);	
		exit;
	}
	
	/**
	 * Function deletes a product features from the database
	 * 
	 * 
	 *
	 * @return string
	 */
	
	
	function deleteProductFeatures()
	{
	    $id=$_GET['id'];
		if(((int)$id)!=0)
		{
			$sql="delete from product_attrib_values_table where product_attrib_value_id =".$id;
			$obj=new Bin_Query();
			$obj->updateQuery($sql);
			$product_id=$_GET['productid'];
			
			header('location:?do=productfeatures&id='.$product_id);	
			exit;
		}		
	}
	
	/**
	 * Function selects a product attribute value from the database
	 * 
	 * 
	 *
	 * @return string
	 */
	
	function editProductFeatures()
	{
		$id=$_GET['selattrib_value_id'];
		$sql="select * from product_attrib_values_table where product_attrib_value_id =".$id;
		$obj=new Bin_Query();
		$obj->executeQuery($sql);
		return Display_DProductFeatures::editProductFeatures($obj->records); 
	}
}
?>