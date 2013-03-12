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
 * This class contains functions to gets and update the admin activity report.
 *
 * @package  		Core_CProductRegistration
 * @category  		Core
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
   * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */



class Core_CProductRegistration
{
	
	/**
	 * Function adds the thumbnail images into products table
	 * 
	 * 
	 * @return string
	 */
	
		
	function uploadThumbImage()
	{
	
		$catid=$_POST['txtcatid'] ;
		$sku=$_POST['txtsku'];
		$prodtitle=$_POST['txtprodtitle'];
		$proddesc= $_POST['txtprodesc'];
		$prodbrand= $_POST['txtprodbrand'];
		$prodmodel= $_POST['txtprodmodel'];
		$prodprice= $_POST['txtprodprice'];
		$prodmsrp= $_POST['txtprodmsrp'];
		$prodweight= $_POST['txtprodweight'];
		$proddim= $_POST['txtproddimen'];
		$prodshipcost= $_POST['txtshipcost'];
		$tag= $_POST['txttag'];
		if($catid!= '' and $sku != '' and $prodtitle != '' and $proddesc != '' and $prodbrand!= '' and $prodmodel != '' and $prodprice != '' and $prodmsrp != '' and $prodweight  != '' and $proddim  != '' and $prodshipcost != '' and $tag!= '')
		{
				$sql = "insert into products_table (category_id,sku,title,description,brand,model,price,msrp,weight,
				dimension,thumb_image,image,shipping_cost,status,tag) values('".$catid."','".$sku."','"
				.$prodtitle."','".$proddesc."','".$prodbrand."','".$prodmodel."','".$prodprice."','".$prodmsrp."','".$prodweight
				."','".$proddim."','".$prodshipcost."',0,'".$tag;
				
			$obj = new Bin_Query();
			
			if($obj->updateQuery($sql))
			{
				$result = "Added Successfully";
				return $result;
			}
			else
			{
				$result = "Not Inserted";
				return $result;
			}
		}
		if(!empty($_FILES['img']['name']))
		{
		
			$type1=$_FILES['filethumb']['type'];
			if(!($type1=="image/pjpeg" || $type1=="image/gif" || $type1=="image/jpeg" || $type1=="image/bmp"))
			{
				$img_flag=1;
				$message="Please Enter Valid Image";
			}	
		   list($width, $height, $type, $attr) = getimagesize($_FILES['filethumb']['tmp_name']);
		   $h=$height;
		   $w=$width;
		   if($h > 80 or $h < 70)
		   		$img_h_flag = 1;			
		   if($w > 100 or $w < 90)
		   		$img_w_flag = 1;
		}
	}//end of function uploadThumbImage

	
	/**
	 * Function gets the all the categories from the database 
	 * @param  array $Err contain both error messages and error values
	 * 
	 * @return array
	 */
	

	function displayCategory($Err)
	{
		include("classes/Display/DCategorySelection.php");
		$sql = "SELECT * FROM category_table where category_parent_id=0  order by category_name";
		$query = new Bin_Query();
		if($query->executeQuery($sql))
			$this->data['showcategory'] = Display_DCategorySelection::listCategory($query->records);
		
		if(count($Err->values) >0)
			$this->errormessages = $Err->messages;
		$this->makeConstant($this->data);
	}
	
	/**
	 * Function gets the all the sub categories from the database 
	 * 
	 * 
	 * @return array
	 */
	
	
	function displaySubCategory()
	{
		include("classes/Display/DCategorySelection.php");
		$sql = "SELECT category_id,category_name FROM category_table where category_parent_id=". $_GET['id'] ;
		$query = new Bin_Query();
		if($query->executeQuery($sql))
			echo $this->data['showsubcat'] = Display_DCategorySelection::listSubCategory($query->records);
		else
		{
			echo $this->data['showsubcat'] = "No Subcategories Found";
			
		}
		$this->makeConstant($this->data);
	}	
	
	/**
	 * Function insert a prodcut into the database 
	 * 
	 * @param string $result
	 * 
	 */
	
	function insertRegistration($result)
	{
		$category_id=$_POST['catid'];
		$sku=$_POST['sku'];
		$title=$_POST['title '];
		$description=$_POST['desc'];
		$brand=$_POST['brand'];
		$price=$_POST['price'];
		$msrp=$_POST['msrp'];
		$weight=$_POST['weight'];
		$dimension=$_POST['dimension'];
		$thumb_image=$_POST['thumb_image'];
		$image=$_POST['image'];
		$shipping_cost=$_POST['shippingcost'];
		$status=$_POST['status'];
		$tag=$_POST['tag'];
		$sql='insert into products_table(category_id, sku, title, description, brand, model, msrp,price,cse_enabled, weight, dimension, thumb_image, image, shipping_cost, status, tag, meta_desc, meta_keywords, intro_date, is_featured)values('.$category_id.','.$sku.','.$title.','.$description.','.$brand.','.$model.','.$msrp.','.$price.','.$cse_enabled.','.$weight.','.$dimension.','.$thumb_image.','.$image.','.$shipping_cost.','.$status.','.$tag.','.$meta_desc.','.$meta_keywords.','.$intro_date.','.$is_featured.')';
	   $obj=new Bin_Query();
  	   $obj->updateQuery($sql);
	}
	
	/*function insertMsrpByQuantity()
	{
	   $ma='select max(category_id) from products_table';
	   $obj=new Bin_Query();
	   $obj->executeQuery($ma);
	   $re=obj->records;
	   for(i=0;i<=length;i++)
	   {
	   		$quantity=
	 	    $msrp=
	 	    $sql='insert into msrp_by_quantity_table (product_id,quantity,msrp)values('.$re.','.$quantity.','.$msrp.')';
	 	    $obj->updateQuery($sql);
	   }
	   
	}*/	
	
	
}//end of class Core_CProductRegistration


?>
