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
 * Product review related  class
 *
 * @package   		Core_CProductReview
 * @category    	Core
 * @author    		AJ Square Inc Dev Team
 * @link   		http://www.zeuscart.com
  * @copyright 	        Copyright (c) 2008 - 2013, AJ Square, Inc.
 * @version   		Version 4.0
 */
class Core_CProductReview
{
	/**
	 * This function is used to get the product review .
	 *
	 * @param array $Err
	 * 
	 * @return array 
	 */

	function showProductReview($Err)
	{
		if($_GET['prodid']!='')
			$productid= $_GET['prodid'];
		else if($_POST['prodid']!='')
			 $productid= $_POST['prodid'];
			 
		$obj = new Bin_Query();
		$sql2 = "select count(*) as temp from product_reviews_table where product_id=".$productid." and review_status=1";
		$obj->executeQuery($sql2);
		$totreview = $obj->records[0]['temp']; 
		if($totreview==0)
		{
			$sql = "select product_id,title,thumb_image from products_table where product_id=".$productid;
		}
		else
		{
			$sql="SELECT a.review_caption, a.review_txt, a.review_date,a.rating,b.user_display_name, c.product_id, c.title, c.thumb_image FROM product_reviews_table a INNER JOIN products_table c ON a.product_id = c.product_id inner join users_table b on a.user_id = b.user_id WHERE a.product_id =".$productid." and a.review_status=1"; 
		}
		$breadcrumb=Core_CProductReview::breadCrumb();
		if($obj->executeQuery($sql))
		{
			$output =   Display_DProductReview::showProductReview($obj->records,$Err,$totreview,$breadcrumb);
		}
		else
		{
			$output = "<div class='exc_msgbox'>No Record Found</div>";
		}
		return $output;
	}
	/**
	 * This function is used to insert the product review .
	 *
	 * .
	 * 
	 * @return array 
	 */
	function addProductReview()
	{
		$productid= $_GET['prodid'];
		$userid= $_SESSION['user_id'];
		$reviewcaption = htmlentities($_POST['detail']);
		$reviewtext = $_POST['reviewtxt'];
		$rating = $_POST['ratings'];
		$dte = date('Y-m-d');
		$status = '0';
		$obj = new Bin_Query();
		$sql="select count(*) as temp from product_reviews_table where product_id=".$productid." and user_id=".$userid; 
		$obj->executeQuery($sql);
		$review = $obj->records[0]['temp'];
		if($review == 0)
		{
			
			$sqlinsert = "insert into  product_reviews_table(product_id,user_id,review_caption,review_txt,review_date,rating,review_status)
			 values(".$productid.",".$userid.",'".$reviewcaption."','".$reviewtext."','".$dte."',".$rating.",".$status.")";
			
			if($obj->updateQuery($sqlinsert))
			{
				
				$output = "<div class='success_msgbox'>Your review has been accepted for moderation</div>";
			}
			else
			{
				$output = "<div class='exc_msgbox'>No Record Found</div>";
			}
			return $output;
		}
		else
		{
			$output = "<div class='success_msgbox'>You already gave the review for this product</div>";
			return $output;
		}
	}
	
	
	/**
	 * This function is used to select  the breadCrumb.
	 *
	 * .
	 * 
	 * @return array 
	 */
	function breadCrumb()
	{
		$sql='SELECT a.category_name AS Category,a.category_id as maincatid, b.category_name AS SubCategory, b.category_id,pt.title
		FROM category_table a INNER JOIN category_table b ON a.category_id = b.category_parent_id 
		inner join products_table pt on b.category_id=pt.category_id WHERE pt.product_id ='.(int)$_GET['prodid'];
		$query = new Bin_Query();
		if($query->executeQuery($sql))
			return  Display_DProductReview::breadCrumb($query->records);
	}
	

}
?>
