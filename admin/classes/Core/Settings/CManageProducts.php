<?php
// error_reporting(E_ALL);
/**
* GNU General Public License.

* This file is part of ZeusCart V2.3.

* ZeusCart V2.3 is free software: you can redistribute it and/or modify
* it under the terms of the GNU General Public License as published by
* the Free Software Foundation, either version 3 of the License, or
* (at your option) any later version.
* 
* ZeusCart V2.3 is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
* GNU General Public License for more details.
* 
* You should have received a copy of the GNU General Public License
* along with Foobar. If not, see <http://www.gnu.org/licenses/>.
*
*/
/**
 * CManageProducts
 *
 * This class contains functions to show all product details and to display the search results. 
 *
 * @package		Core_Settings_CManageProducts
 * @category	Core
 * @author		ZeusCart Team
 * @link		http://www.zeuscart.com
 * @version 	2.3
 */

// ------------------------------------------------------------------------

class Core_Settings_CManageProducts
{
	/**
	 * Stores the output
	 *
	 * @var array $output
	 */
	var $output = array();	
	
	/**
	 * Function gets the list of product titles available in the database. 
	 * 
	 * 
	 * @return string
	 */	 	
	
	function dispProductTitle()
	{
		$prodid=$_SESSION['prodid']; 
		
		$sqltitle = "SELECT title FROM products_table WHERE product_id ='".$prodid."'";
		
		$query = new Bin_Query();
		
		if($query->executeQuery($sqltitle))
		{
			return Display_DManageProducts::dispProductTitle($query->records);
		}
		
	}
	
	/**
	 * Function gets the list of products available in the database for the selected category id 
	 * 
	 * 
	 * @return string
	 */	 	
	
	function showProducts()
	{
		if($_GET['id']!='')
		{
			$sql = "SELECT 	* FROM products_table where category_id=".(int)$_GET['id'] ;
	
			$query = new Bin_Query();
	
			if($query->executeQuery($sql))
			{
				$totrows = $query->totrows;
			}
			if($totrows > 0)
				return  Display_DManageProducts::productList($query->records);
			else
				return  Display_DManageProducts::displayNoProductFound();
		}	
		else
		{
			echo 'Select SubCategory';
		}	
	}
	
	/**
	 * Function gets all the products in the database with the pagination enabled 
	 * 
	 * 
	 * @return string
	 */	 	
	
	function showAllProducts()
	{
		include('classes/Lib/Paging.php');
		
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
		$sql = "SELECT 	* FROM products_table ";
		
		$query = new Bin_Query();
		
		if($query->executeQuery($sql))
		{
			$total = ceil($query->totrows/ $pagesize);
				
			$tmp = new Lib_Paging('classic',array('totalpages'=>$total, 'length'=>10),'pagination');
			
			$this->data['paging'] = $tmp->output;
			$this->data['prev'] =$tmp->prev;
			$this->data['next'] = $tmp->next;	
			
			$sql = "SELECT 	* FROM products_table LIMIT $start,$end ";
			
			$query = new Bin_Query();
			
			if($query->executeQuery($sql))
				
				return  Display_DManageProducts::showAllProducts($query->records,1,$this->data['paging'],$this->data['prev'],$this->data['next'],$start);
				
		}	
		else
		{
			return '<div class="exc_msgbox">No Products Found! Please Click Product Entry Link to Add Products!</div>';
		}	
	}
	
	
	/**
	 * Function gets the search results from the database 
	 * 
	 * 
	 * @return string
	 */	 	
	
	function searchProductDetails()
	{
		$producttitle = $_POST['title'];
		$brand = $_POST['brand'];
		$sku =  $_POST['sku'];
		$qty =  $_POST['qty'];
		$frommsrp =  $_POST['frommsrp'];
		$tomsrp =  $_POST['tomsrp'];
		$fromprice =  $_POST['fromprice'];
		$toprice =  $_POST['toprice'];
		$scost=$_POST['shippingcost'];
		$status =  $_POST['status'];
		$cse =  $_POST['cse'];
		$tag =  $_POST['tag'];
		$fdte =  $_POST['fromdate']; 
		$tdte =  $_POST['todate']; 
		
		//This Code is For Paging 
		
		$sql='SELECT distinct pt.title,pt.sku,pt.cse_enabled,pt.status,pt.shipping_cost,pt.tag,pt.intro_date,pt.product_id,pt.brand, pt.price,pt.msrp, pt.status , invt.soh FROM products_table as pt , product_inventory_table as invt  ';
		$condition=array();
		
		if($producttitle!='')
		{
			$condition []= "  pt.title like '%".$producttitle."%'";
		}
		if($brand!='')
		{
			$condition[]= " pt.brand like  '%".$brand."%'";
		}
		if($sku!='')
		{
			$condition []= "  pt.sku like  '%".$brand."%'";
		}
		if($qty!='')
		{
			$condition []= "  invt.soh like  '%".$qty."%'";
		}
		if($frommsrp!='' && $tomsrp!='')
		{
			$condition []= "  pt.msrp between '".$frommsrp."' and  '".$tomsrp."'";
		}
		if($frommsrp!='' && $tomsrp=='')
		{
			$condition []= "  pt.msrp > '".$frommsrp."'";
		}if($frommsrp=='' && $tomsrp!='')
		{
			$condition []= "  pt.msrp < '".$tomsrp."'";
		}
		if($fromprice!='' && $toprice!='')
		{
			$condition []= "  pt.price between   '".$fromprice."' and  '".$toprice."'";
		}
		if($fromprice!='' && $toprice=='')
		{
			$condition []= "  pt.price >   '".$fromprice."'";
		}
		if($fromprice=='' && $toprice!='')
		{
			$condition []= "  pt.price <   '".$fromprice."'";
		}
		if($scost!='')
		{
			$condition []= "  pt.shipping_cost like  '%".$scost."%'";
		}
		if($status!='' && $status>-1)
		{
			$condition []= "  pt.status = '".$status."'";
		}
		
		if($cse!='' && $cse>-1)
		{
			$condition []= "  pt.cse_enabled like  '%".$cse."%'";
		}
		if($tag!='')
		{
			$condition []= "  pt.tag like  '%".$tag."%'";
		}
		
		if($fdte!='' && $tdte!='')
		{
			$condition []= "  pt.intro_date between '".$fdte."' and '".$tdte."'";
		}
			
		if(count($condition)>1)
			 
			$sql.= ' where '. implode(' and ', $condition) .'and pt.product_id=invt.product_id';
			 
		elseif(count($condition)>0)
		{
			$sql.= ' where  '. implode('', $condition) .' and pt.product_id=invt.product_id';
		}
		elseif(count($condition)==0)
		{
			$sql.= ' where pt.product_id=invt.product_id';
		}
		
		if($_POST['search']=='Search')
		{
			$obj = new Bin_Query();
			if($obj->executeQuery($sql))
			{
				$output =  Display_DManageProducts::showAllProducts($obj->records,'1',$this->data['paging'],$this->data['prev'],$this->data['next'],0);
			
			}
			else
			{	
				$output =  Display_DManageProducts::showAllProducts($obj->records,'0',$this->data['paging'],$this->data['prev'],$this->data['next'],0);
			
			}
			
			return $output;
		}
		else
		{
			return Core_Settings_CManageProducts::showAllProducts($sql,$this->data['paging'],$this->data['prev'],$this->data['next'],0);
		}
		
	}
	
	
	/**
	 * Function updates the changes in the products 
	 * 
	 * 
	 * @return string
	 */	 	
	
	
	function updateProducts()
	{
		$temparray = array();
		
		$prodid=$_SESSION['prodid']; 
		
		$temparray = $_POST['checkbox'];
		
		$checkboxvalue = implode(",",$temparray);
	
		$sql= "SELECT * FROM cross_products_table WHERE product_id ='".$prodid."'";
		
		$query = new Bin_Query();
		
		$query->executeQuery($sql);
		
		$flag=$query->totrows;
		 
		if(flag>0)
		{	
			$sql = "insert into cross_products_table (product_id,cross_product_ids) values('".$prodid."','".$checkboxvalue."')";
			$query = new Bin_Query();
			
			if($query->updateQuery($sql))
			{
				return '<b>Cross Products added Successfully</b>';
			}
			else
			{
				return "<b>Cross Products Not Added</b>";
			}
		}
		else
		{
			$sql = "UPDATE cross_products_table SET cross_product_ids='".$checkboxvalue."' WHERE product_id='".$prodid."'";
			$query = new Bin_Query();
			
			if($query->updateQuery($sql))
			{
				return '<b>Cross Products added Successfully</b> ';
			}
			else
			{
				return "<b>Cross Products Not Added</b>";
			}
		}
		
	}
	
	
	/**
	 * Function deletes a selected product from the database 
	 * 
	 * 
	 * @return string
	 */	 	
	
	
	function deleteProduct()
	{
		$id=(int)$_GET['prodid'];
		
		$sql='delete from products_table where product_id ='.$id;
		
		$obj=new Bin_Query();
		
		if($obj->updateQuery($sql))
		{	
			return '<div class="success_msgbox">Product Deleted Successfully</div>';	
		}	
	}
	
	/**
	 * Function gets the title details from the database
	 * 
	 * 
	 * @return string
	 */	 	
	
	function getTitle()
	{
		
		$query = new Bin_Query();	
		$title=$_GET['word'];
		if($title!='')
		{
			$sql= "SELECT title FROM products_table WHERE title like '".$title."%'"; 
			$query->executeQuery($sql);
			$arr=$query->records;
			return Display_DManageProducts::getTitle($query->records);					
		}	

	}
	
	/**
	 * Function gets the category details from the table 
	 * 
	 * @param integer $catid
	 * @return string
	 */	 	
	
	function displayCategory($catid)
	{
/*
		$sql = "SELECT category_id,category_name FROM category_table where category_parent_id=0";
		
		$query = new Bin_Query();
		
		$query->executeQuery($sql);
		
		return Display_DManageProducts::displayCategory($query->records,$catid);	*/	
	}
	
	/**
	 * Function gets the sub category details from the table for the selected category id 
	 * 
	 * @param integer $subcatid
	 * @return string
	 */	 		
	
	function displaySubCategory($subcatid)
	{


		$id=(int)$_GET['id'];
		
		if($_GET['id']!='')
		{
	    		if(is_int($id))
		    	{
				$sql = "SELECT * FROM category_table where category_parent_id=".$subcatid." AND sub_category_parent_id=0 " ;
				
				$query = new Bin_Query();
				
				$query->executeQuery($sql);
				
				return Display_DManageProducts::displaySubCategory($query->records,$subcatid);
			}
		}
		else
		{
				 $sql = "SELECT * FROM category_table where category_parent_id=".$subcatid." AND sub_category_parent_id=0" ;
				
				$query = new Bin_Query();
				
				$query->executeQuery($sql);
				
				return Display_DManageProducts::displaySubCategory($query->records,$subcatid);
		}
			
	}
	
	/**
	 * Function gets the product details from the table for the selected product id 
	 * 
	 * 
	 * @return string
	 */	 
	
	function  editProduct()
	{   
		$id=$_GET['prodid'];

		if(((int)$id)>0)
		{
			$sql='select * from products_table where product_id='.$id;
			
			$obj=new Bin_Query();
			
			$obj->executeQuery($sql);
			
			$sqlid="SELECT category_id,category_parent_id FROM category_table where category_id in(select category_id from products_table where category_id='".$obj->records[0]['category_id']."')";
			
			$query=new Bin_Query();
			
			$query->executeQuery($sqlid);
			
			$category=Core_Settings_CManageProducts::displayCategory($query->records[0]['category_parent_id']);
			
			$sqlid='select category_id from category_table where category_id in(select category_id 
			from products_table where product_id='.$id.')';
			
			$query=new Bin_Query();
			
			$query->executeQuery($sqlid);
			
			$subcat=Core_Settings_CManageProducts::displaySubCategory($query->records[0]['category_id']);
			
			return Display_DManageProducts::editProduct($obj->records,$category,$subcat);
	    }
	}
	
	/**
	 * Function gets the product details and category details for the selected product id. 
	 * 
	 * 
	 * @return string
	 */	 	
	
	function  editMainCategory()
	{   
		$id=$_GET['prodid'];

		if(((int)$id)>0)
		{
			$sql='select * from products_table where product_id='.$id;
			
			$obj=new Bin_Query();
			
			$obj->executeQuery($sql);
			
			$sqlid="SELECT category_id,category_parent_id FROM category_table where category_id in(select category_id from products_table where category_id='".$obj->records[0]['category_id']."')";
			
			$query=new Bin_Query();
			
			$query->executeQuery($sqlid);
			
			$sql1 = "SELECT category_id,category_name FROM category_table where category_parent_id=0";
		
		$query1 = new Bin_Query();
		
		$query1->executeQuery($sql1);
		

		return Display_DManageProducts::displayCategory($query1->records,$query->records[0]['category_id']);
			
// 			return $category;
	    }
	}
	
	/**
	 * Function gets the product details and sub category details for the selected product id. 
	 * 
	 * 
	 * @return string
	 */	 	
	
	function  editSubCategory()
	{   
		$id=$_GET['prodid'];

		if(((int)$id)>0)
		{
			$sql='select * from products_table where product_id='.$id;
			
			$obj=new Bin_Query();
			
			$obj->executeQuery($sql);
			
			$sqlid="SELECT category_id,category_parent_id FROM category_table where category_id in(select category_id from products_table where category_id='".$obj->records[0]['category_id']."')";
			
			$query=new Bin_Query();
			
			$query->executeQuery($sqlid);
			
			$category=Core_Settings_CManageProducts::displayCategory($query->records[0]['category_parent_id']);
			
			$sqlid='select category_id from category_table where category_id in(select category_id 
			from products_table where product_id='.$id.')';
			
			$query=new Bin_Query();
			
			$query->executeQuery($sqlid);
			
			$subcat=Core_Settings_CManageProducts::displaySubCategory($query->records[0]['category_id']);
			
			return $subcat;
	    }
	}
	/**
	 * Function gets the sub under category details from the table for the selected category id 
	 * 
	 * @param integer $subcatid
	 * @return string
	 */	
	function editSubUnderCategory()
	{

		$id=$_GET['prodid'];

		if(((int)$id)>0)
		{
			 $sql='select * from products_table where product_id='.$id;
			
			$obj=new Bin_Query();
			
			$obj->executeQuery($sql);
			
			$sqlid="SELECT * FROM category_table where sub_category_parent_id='".$obj->records[0]['sub_category_id']."' AND category_parent_id ='".$obj->records[0]['category_id']."'"; 
			
			$query=new Bin_Query();
			
			$query->executeQuery($sqlid);
			
			return Display_DManageProducts::displaySubUnderCategory($query->records,$obj->records[0]['sub_under_category_id']);
			
	    }


	}
	
	/**
	 * Function gets the product details from the table for the selected product id. 
	 * 
	 * 
	 * @return string
	 */	 		
	
	function  editGeneral()
	{   
		$id=$_GET['prodid'];

		if(((int)$id)>0)
		{
			$sql='select * from products_table where product_id='.$id;
			
			$obj=new Bin_Query();
			
			$obj->executeQuery($sql);
			
			$output=$obj->records[0];
			
			return $output;
		}
	}
	
	/**
	 * Function gets the cross product brand details from the table 
	 * 
	 * 
	 * @return string
	 */	 	
	
	function corBrand($arr)
	{
		   $sql='select distinct brand,product_id from products_table group by brand asc';
		   $obj=new Bin_Query();
		   $obj->executeQuery($sql);
		   return Display_DProductEntry::corBrand($obj->records,$arr);
	}
	
	/**
	 * Function gets the inventory details from the table for the selected product id  
	 * 
	 * 
	 * @return string
	 */	 	
	function editInventory()
	{
		$id=$_GET['prodid'];

		if(((int)$id)>0)
		{
			$sql='select * from product_inventory_table where product_id='.$id;
			
			$obj=new Bin_Query();
			
			$obj->executeQuery($sql);
			
			$output=$obj->records[0];
			
			return $output;
		}
	}
	
	/**
	 * Function gets the cross product details from the table 
	 * 
	 * 
	 * @return string
	 */	 	
	
	
	function editRelated()
	{
		$id=$_GET['prodid'];

		if(((int)$id)>0)
		{
			$sql = "SELECT 	* FROM products_table ";
			$query = new Bin_Query();
			$query->executeQuery($sql);
			
			$sql='select cross_product_ids from cross_products_table where product_id='.$id;
			$obj=new Bin_Query();
			$obj->executeQuery($sql);
			$p_id=$obj->records[0];
			$value=explode(",",$p_id['cross_product_ids']);
			return  Display_DManageProducts::editRelated($query->records,$value);
		}	
			//return '<div class="exc_msgbox">No Products Found! Please Click Product Entry Link to Add Products!</div>';


	
	}	
	
	/**
	 * Function gets the main image details from the database
	 * 
	 * 
	 * @return string
	 */	 	
	
	function editMainImage()
	{
		$id=$_GET['prodid'];

		if(((int)$id)>0)
		{
			$sql='select * from product_images_table where type="main" and product_id='.$id;
			
			$obj=new Bin_Query();
			
			if($obj->executeQuery($sql))
			{			
				$output=$obj->records[0];
			}
			else
			{
				$output=0;
			}
			
			return Display_DManageProducts::editMainImage($output);
		}
	}
	
	/**
	 * Function gets the sub image details from the table 
	 * 
	 * 
	 * @return string
	 */	 	
	
	function editImage()
	{
		$id=$_GET['prodid'];

		if(((int)$id)>0)
		{
			$sql='select * from product_images_table where type="sub" and product_id='.$id;
			$query=new Bin_Query();
			if($query->executeQuery($sql))
			{
				return Display_DManageProducts::editImage($query->records);
			}
			else
			{
				return Display_DManageProducts::editImage(0);
			}
			
		}
	}
	
	/**
	 * Function gets the attribute values for the selected product id from the database 
	 * 
	 * 
	 * @return string
	 */	 	
	
	
	function editAttributes()
	{
		$id=(int)$_GET['prodid'];
		if(is_int($id))
		{
			$select='SELECT attrib_value_id FROM product_attrib_values_table where product_id='.$id;
			$jbo=new Bin_Query();
			$jbo->executeQuery($select);
			$arr=$jbo->records;
			for($i=0;$i<count($arr);$i++)
			{
				$value[]=$arr[$i]['attrib_value_id'];
			}
			$sql='select category_id from products_table where product_id='.$id;
			$obj=new Bin_Query();
			$obj->executeQuery($sql);
			$sql='SELECT attrib_id FROM category_attrib_table WHERE subcategory_id='.$obj->records[0]['category_id'];
			$query = new Bin_Query();
			$query->executeQuery($sql);
			$cnt=count($query->records);

			for($i=0;$i<$cnt;$i++)
			{
			  	$sq='SELECT a.attrib_name,b.* FROM attribute_table a,attribute_value_table b WHERE a.attrib_id=b.attrib_id AND a.attrib_id='.$query->records[$i]['attrib_id'];
		          	 $que = new Bin_Query();
			  	 if($que->executeQuery($sq))
					$tmp[]=$que->records;
			}
			
					
			return Display_DManageProducts::editAttributes($tmp,$value);
		}
	}
	
	
	/**
	 * Function gets the tier price details from the database 
	 * 
	 * 
	 * @return string
	 */	 
	
	function editTierPrice()
	{
		$id=(int)$_GET['prodid'];
		if(is_int($id))
		{
			$sql='SELECT * FROM msrp_by_quantity_table WHERE product_id ='.$id;
			$obj= new Bin_Query();
			$obj->executeQuery($sql);
			return Display_DManageProducts::editTierPrice($obj->records);
		}
	}
	
	
	/**
	 * Function checks whether the posted id is of integer data type 
	 * 
	 * 
	 * @return integer
	 */	 
	
	function getId()
	{
		$id=(int)$_GET['prodid'];
		if(is_int($id))
		{
			return $id;
		}
	}
	
	
	/**
	 * Function updates the changes made in the product details
	 * 
	 * 
	 * @return array
	 */	 
	 
	function updateProduct()
	{
		include('classes/Lib/ThumbImage.php');
		
		$category_id=(int)$_POST['selcatgory'];
		$category_parent_id=(int)$_POST['selsubcatgory'];
		$sub_category_parent_id =(int)$_POST['selsubundersubcatgory'];
		$title=$_POST['product_title'];
		$description=$_POST['desc'];
		$sku=$_POST['sku'];
		$brand=$_POST['new_brand'];
		$model=$_POST['model'];
		$tag=$_POST['tag'];
		$intro_date= $_POST['intro_date'];
		if($_POST['cse_enabled']=='on')
		{
			$cse_enabled=1;
			$csekeyid=trim($_POST['csekeyid']);
		}
		else
		{
			$cse_enabled=0;
			$csekeyid='';
		}
			
		if($_POST['is_feautured']=='on')
			$is_feautured=1;
		else
			$is_feautured=0;
			
		if($_POST['status']=='on')
		
			$status=1;
		else
			$status=0;	
		
		if($_POST['is__product_status']=='')
		{
			$product_status=0;
		}		
		elseif($_POST['is__product_status']!='')
		{
			$product_status=$_POST['is__product_status'];
		}
		
		$attribute=$_POST['attribute'];
		
		$price=(float)$_POST['price'];
		$msrp_org=(float)$_POST['msrp_org'];
		$msrp=$_POST['msrp'];
		$quantity=$_POST['quantity'];
		$shipping_cost=$_POST['shipcost'];
		
		$soh=(int)$_POST['soh'];
		$rol=(int)$_POST['rol'];
		
		$meta_keywords=$_POST['meta_keywords'];
		$meta_desc=$_POST['meta_desc'];
		
		$related=$_POST['chkSub'];
		
		
		if(count($related)> 0 )
		{
			for($i=0;$i<count($related);$i++)
			{
				$related_val.=$related[$i].",";
			}
			$len=strlen($related_val)-1;
			$related_val=substr($related_val,0,$len);
		}
		
		if(trim($brand)=='')
		   $brand=$_POST['selbrand'];
	/*	if(((int)$weight)>0)
		   $weight.=' '.$units;
		else
		   $weight='';
		$dimension=$_POST['dimension'];
*/		
		$pweight=trim($_POST['txtweight']);
		$pwidth=trim($_POST['txtwidth']);
		$pheight=trim($_POST['txtheight']);
		$pdepth=trim($_POST['txtdepth']);
		if($pweight>0)
			$weight=$pweight;
		else
			$weight='';
		$dimension='';
		if($pwidth<=0&&$pheight<=0&&$pdepth<=0)
			{
				$dimension='';
				
			}
		else
			{
				if($pwidth>0)
					$dimension=$pwidth.' x ';
				else
					$dimension='0 x ';
				if($pheight>0)
					$dimension.=$pheight.' x ';
				else
					$dimension.='0 x ';
				if($pdepth>0)
					$dimension.=$pdepth;
				else
					$dimension.='0';
				//$dimension=$pwidth.'-'.$pheight.'-'.$pdepth;	
			}
		
		 //$sql="update products_table set  category_id = '".$category_id."',sku = '".$sku."',title = '".$title."',description = '".$description."', brand = '".$brand."',model = '".$model."',msrp = '".$msrp_org."',price = '".$price."', cse_enabled = '".$cse_enabled."',weight = '".$weight."',dimension = '".$dimension."',shipping_cost = '".$shipping_cost."',status = '".$status."',tag = '".$tag."',meta_desc = '".$meta_desc."',meta_keywords = '".$meta_keywords."',intro_date = '".$intro_date."',is_featured = '".$is_feautured."',thumb_image = '".$thumb_image."',image = '".$image."' where product_id =".((int)$_GET['prodid'] );
		 if($_POST['cse_enabled']=='on'&&$csekeyid!='')
		{
		 $sql="update products_table set  category_id = '".$category_id."',sub_category_id ='".$category_parent_id."',sub_under_category_id='".$sub_category_parent_id."',sku = '".$sku."',title = '".$title."',description = '".$description."', brand = '".$brand."',model = '".$model."',msrp = '".$msrp_org."',price = '".$price."', cse_enabled = '".$cse_enabled."',cse_key='".$csekeyid."',weight = '".$weight."',dimension = '".$dimension."',shipping_cost = '".$shipping_cost."',status = '".$status."',tag = '".$tag."',meta_desc = '".$meta_desc."',meta_keywords = '".$meta_keywords."',intro_date = '".$intro_date."',is_featured = '".$is_feautured."',product_status='".$product_status."' where product_id =".((int)$_GET['prodid'] );
		}
		else
		{
		    $sql="update products_table set  category_id = '".$category_id."',sub_category_id ='".$category_parent_id."',sub_under_category_id='".$sub_category_parent_id."',sku = '".$sku."',title = '".$title."',description = '".$description."', brand = '".$brand."',model = '".$model."',msrp = '".$msrp_org."',price = '".$price."', cse_enabled = '".$cse_enabled."',weight = '".$weight."',dimension = '".$dimension."',shipping_cost = '".$shipping_cost."',status = '".$status."',tag = '".$tag."',meta_desc = '".$meta_desc."',meta_keywords = '".$meta_keywords."',intro_date = '".$intro_date."',is_featured = '".$is_feautured."',product_status='".$product_status."'  where product_id =".((int)$_GET['prodid'] ); 
		}
		$obj1234=new Bin_Query();
		$obj1234->updateQuery($sql);

		
		
		// For Image Uploading//

		if(count($_FILES['ufile']['tmp_name']) > 0)
		{
			$obj_insert= new Bin_Query();
			$product_id=(int)$_GET['prodid'];
				for($i=0;$i<count($_FILES['ufile']['name']);$i++)
				{
					$imgfilename= $_FILES['ufile']['name'][$i];
					if($imgfilename!='')
					{
						$imagefilename = date("Y-m-d-His").$imagefilename ; // generate a new name
						
						$image="images/products/". $imgfilename; // updated into DB
						$thumb_image="images/products/thumb/".$imgfilename; // updated into DB
						$large_image="images/products/large_image/".$imgfilename; // updated large image into DB
						$stpath=ROOT_FOLDER.$image;
						$imageDir=ROOT_FOLDER."images/products";
						$thumbDir=ROOT_FOLDER."images/products/thumb";
						$largeDir=ROOT_FOLDER."images/products/large_image";
						if(move_uploaded_file($_FILES["ufile"]["tmp_name"][$i],$stpath))
						{
							new Lib_ThumbImage('thumb',$stpath,$imageDir,IMAGE1_WIDTH);				
							new Lib_ThumbImage('thumb',$stpath,$thumbDir,THUMB_WIDTH);
							new Lib_ThumbImage('thumb',$stpath,$largeDir,IMAGE2_WIDTH);
						}
						if($i==0)
						{	
							if($_POST['ufile_id'][$i]!='')
							{
								$spl="UPDATE product_images_table SET image_path='$image', thumb_image_path='$thumb_image',large_image_path='$large_image' WHERE product_images_id='".$_POST['ufile_id'][$i]."'";
							}
							else
							{
								$spl="INSERT INTO product_images_table(product_id,image_path,thumb_image_path,type,large_image_path) VALUES('".$product_id."','$image','$thumb_image','main','$large_image')";
							}
							$update="UPDATE products_table set image='$image',thumb_image='$thumb_image',large_image_path='$large_image' where product_id='".$product_id."'";
							
							$obj_insert->updateQuery($update);
						}
						else
						{
							
							if($_POST['ufile_id'][$i]!='')
							{
								$spl="UPDATE product_images_table SET image_path='$image', thumb_image_path='$thumb_image',large_image_path='$large_image' WHERE product_images_id='".$_POST['ufile_id'][$i]."'";
							}
							else
							{
								$spl="INSERT INTO product_images_table(product_id,image_path,thumb_image_path,type,large_image_path) VALUES('".$product_id."','$image','$thumb_image','sub',$large_image)";				
							}
						}
						
						$obj_insert->updateQuery($spl);
					}
				}
				
				
			}
		
		
		// END ///
		
		
		
		$sql="update product_inventory_table set rol=".$rol.", soh=".$soh." where product_id =".((int)$_GET['prodid'] );
		$obj_upd=new Bin_Query();
		$obj_upd->updateQuery($sql);
		
		$sql="delete from product_attrib_values_table where product_id =".((int)$_GET['prodid'] );
		$obj_del=new Bin_Query();
		$obj_del->updateQuery($sql);
		
			
		if(count($attribute) > 0)
		{
			for($i=0;$i<count($attribute);$i++)
			{
				if($attribute[$i] !=0)
				$sq="INSERT INTO product_attrib_values_table(product_id,attrib_value_id) VALUES ('".((int)$_GET['prodid'] )."',$attribute[$i])";
				$obj_ins_1=new Bin_Query();
				$obj_ins_1->updateQuery($sq);
			}
		}
		
			
		if(count($msrp) > 0)
		{
			$obj1=new Bin_Query();
			$sql="delete from msrp_by_quantity_table where product_id =".((int)$_GET['prodid'] );
			$obj1->updateQuery($sql);
			
			
			for($i=0;$i<count($msrp);$i++)
			{
				if($msrp[$i]!='' && $quantity[$i]!='')
				{
					$sq12="INSERT INTO msrp_by_quantity_table(product_id,quantity,msrp) VALUES ('".((int)$_GET['prodid'] )."',$quantity[$i],$msrp[$i])";
					$obj_ins=new Bin_Query();
					$obj_ins->updateQuery($sq12);
				}
			}
		}
		
			
			 $_SESSION['update_msg']='<div class="success_msgbox">Product <b>'.$title.'</b> Updated Successfully</div>';
			 header('Location:?do=manageproducts');
			 exit();
		
		
	}
	
	
	//***********************END******************************************************//
	
	

	
	
	/**
	 * Function selects the data from the table need for generating auto complete popup window. 
	 * 
	 * 
	 * @return xml
	 */
	
	function autoComplete()
	{
			
		$aUsers = array();

		$sql="SELECT title FROM products_table";
		$obj =  new Bin_Query();
		$obj->executeQuery($sql);
		//echo "<pre>";
		//print_r($obj->records);
		$count=count($obj->records);
		if($count!=0)
		{
			for($i=0;$i<$count;$i++)
				$aUsers[]=$obj->records[$i]['title'];
		}
		else
			$aUsers[]='0 Results';		
	
	
		$input = strtolower( $_GET['input'] );
		$len = strlen($input);
		$limit = isset($_GET['limit']) ? (int) $_GET['limit'] : 0;
		
		
		$aResults = array();
		$count = 0;
		
		if ($len)
		{
			for ($i=0;$i<count($aUsers);$i++)
			{
				// had to use utf_decode, here
				// not necessary if the results are coming from mysql
				//
				if (strtolower(substr(utf8_decode($aUsers[$i]),0,$len)) == $input)
				{
					$count++;
					$aResults[] = array( "id"=>($i+1) ,"value"=>htmlspecialchars($aUsers[$i]));
				}
				
				if ($limit && $count==$limit)
					break;
			}
		}
		
		
		
		
		
		header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
		header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
		header ("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
		header ("Pragma: no-cache"); // HTTP/1.0
		
		
		
		if (isset($_REQUEST['json']))
		{
			header("Content-Type: application/json");
		
			echo "{\"results\": [";
			$arr = array();
			for ($i=0;$i<count($aResults);$i++)
			{
				$arr[] = "{\"id\": \"".$aResults[$i]['id']."\", \"value\": \"".$aResults[$i]['value']."\"}";
			}
			echo implode(", ", $arr);
			echo "]}";
		}
		else
		{
			header("Content-Type: text/xml");
	
			echo "<?xml version=\"1.0\" encoding=\"utf-8\" ?><results>";
			for ($i=0;$i<count($aResults);$i++)
			{
				echo "<rs id=\"".$aResults[$i]['id']."\" >".$aResults[$i]['value']."</rs>";
			}
			echo "</results>";
		}
					
	}
}	