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
 * Wishlist related  class
 *
 * @package   		Core_CWishList
 * @category    	Core
 * @author    		AJ Square Inc Dev Team
 * @link   		http://www.zeuscart.com
  * @copyright 	        Copyright (c) 2008 - 2013, AJ Square, Inc.
 * @version   		Version 4.0
 */
class Core_CWishList
{
  	 /**
	 * This function is used to show snapshot for wishlist 
	 *
	 * .
	 * 
	 * @return string
	 */
	
   	function wishlistSnapshot()
	{
		if($_SESSION['user_id'] !='')
		{
			$sqlcnt = "select count(*) as temp from wishlist_table where user_id=".$_SESSION['user_id'];
			$sql = "SELECT a.product_id, a.title, a.thumb_image, a.msrp,c.soh FROM products_table a
					INNER JOIN wishlist_table b ON b.product_id = a.product_id inner join product_inventory_table c on 
					c.product_id=a.product_id  where user_id=".$_SESSION['user_id']." ORDER BY     
					date_added DESC LIMIT 0 , 3";
			$obj = new Bin_Query();
			$obj->executeQuery($sqlcnt);
			$totalitem=$obj->records[0]['temp'];
			
			if($obj->executeQuery($sql))
			{
				$cnt=count($obj->records);
				if($cnt>0)
				{
					$j=0;
					for ($i=0;$i<$cnt;$i++)
					{		
						foreach($obj->records as $row)
						{
							$r[$j]=$row;
							$prid=$row['product_id'];
							$minval=Core_CWishList::disRates($prid);
							if($minval > 0  or $minval!='')
							{
								$r[$j]['msrp']= '$'.number_format($row['msrp'],2).' - $'.number_format($minval,2);
							}
							else
								$r[$j]['msrp']= '$'.number_format($row['msrp'],2);
							$j++;
						}
						$output =  Display_DWishList::wishlistSnapshot($obj->records,$totalitem,$r);
					}
				}
				
			}
			else
				$output =  Display_DWishList::wishlistSnapshotElse();
		}
		else
				$output =  Display_DWishList::wishlistSnapshotElse();
		return $output;
   }
   
   	 /**
	 * This function is used to add the wishlist 
	 *
	 * .
	 * 
	 * @return string
	 */
	
   	function addtoWishList()
	{
		
		$userid = $_SESSION['user_id'];
		$date = date('Y-m-d');
		$productid = $_GET['prodid'];
		$currency_id=$_SESSION['currencysetting']['selected_currency_id'];
		if( $userid!= '' and $date!= '' and $productid != '')
		{
			
			$obj = new Bin_Query();
			$sqlselect = "select count(*) as temp from wishlist_table where user_id=".$userid." and product_id=".$productid;
			
			
			if($obj->executeQuery($sqlselect))
			{
				if($obj->records[0]['temp']>0)
				{
					
					$output['success'] = '<div class="success_msgbox">Selected product is already added in your wishlist</div></br>';
				}
				else
				{
				  $sqlinsert = "insert into wishlist_table (user_id,product_id,date_added,currency_id) values(".$userid.",".$productid.",'"  .$date."','".$currency_id."')";
							
					if($obj->updateQuery($sqlinsert))
					{
						$output['wishlist'] = $this->viewWishList();
						$output['success'] = '<div class="success_msgbox">Product added successfully into your wishlist</div>';
						
					}
					else
					{
						$output =  Display_DWishList::addtoWishListElse();
					}
				}
				return $output;
			}
		}
		
   }
  	 /**
	 * This function is used to delete Wish List  
	 *
	 * .
	 * 
	 * @return string
	 */
  	 function deletefromWishList()
	{
		
		$userid = $_SESSION['user_id'];
		$productid = $_GET['prodid'];
		
		if( $userid!= '' and $productid != '')
		{
			$obj = new Bin_Query();
			$sqldelete = "delete from  wishlist_table where user_id=".$userid." and product_id=".$productid;
			if($obj->updateQuery($sqldelete))
			{
				$output['wishlist']= $this->viewWishList();
				$output['success'] = '<div class="success_msgbox">Item Deleted Successfully from wishlist</div>';
			}
			
		}
		return $output;
	}
	/**
	 * This function is used to View Wish List  
	 *
	 * .
	 * 
	 * @return string
	 */	 

   	 function viewWishList()
	{

		$userid = $_SESSION['user_id'];
		$obj = new Bin_Query();
		$sqlcnt = "select count(*) as temp from wishlist_table where user_id=".$userid;
		$obj->executeQuery($sqlcnt);
		$totalitem=$obj->records[0]['temp'];
			
		if($totalitem>0)
		{
			 $sqlselect = "select t1.thumb_image,t1.title,t1.price,t1.msrp,t2.date_added,t2.product_id,
			t3.soh from products_table as t1 INNER JOIN wishlist_table as t2 on t2.product_id = t1.product_id inner join product_inventory_table t3 on t3.product_id=t2.product_id where t2.user_id=".$userid;
			if($obj->executeQuery($sqlselect))
			{
			
				$cnt=count($obj->records);
				if($cnt>0)
				{
					for ($i=0;$i<$cnt;$i++)
					{		
						foreach($obj->records as $row)
						{
							$r[$j]=$row;
							$prid=$row['product_id'];
							$minval=Core_CWishList::disRates($prid);
							if($minval > 0  or $minval!='')
							{
								$r[$j]['msrp']= '$'.number_format($row['msrp'],2).' - $'.number_format($minval,2);
							}
							else
								$r[$j]['msrp']= '$'.number_format($row['msrp'],2);
						
						}
						$output = Display_DWishList::viewWishList($obj->records,$r);
					}
				}
				
			}
			else
			{
				$output = Display_DWishList::viewWishListElse();
				
			}
		}
		else
		{
			$output = Display_DWishList::viewWishListElse();
		}
		
		return $output;
    }
	 /**
	 * This function is used to get the product msrp 
	 * @param integer  $productid
	 * .
	 * 
	 * @return string
	 */
	function disRates($productid)
	{
		$sql='select min(msrp) as msrp from msrp_by_quantity_table where product_id ='.$productid;
		$obj=new Bin_Query();
		$obj->executeQuery($sql);
		$val=$obj->records;
		return $val[0]['msrp'];
	}
	 /**
	 * This function is used to delete the wishlist 
	 *
	 * .
	 * 
	 * @return string
	 */
	function clearWishlist()
	{
		
		$obj = new Bin_Query();
		$sql='delete from wishlist_table';
		if($obj->updateQuery($sql))
		{
			$output['wishlist'] = Display_DWishList::viewWishListElse();
			$output['success'] = '<div class="success_msgbox">Item Cleared Successfully from wishlist</div>';
		}
		return $output;
	}
	
	 /**
	 * This function is used to Add the Compare product 
	 *
	 * .
	 * 
	 * @return string
	 */
	function addtoCompareProduct()
	{
		$flag=0;
		
		
			
			if($_SESSION['compareProductId']!='')
				$cnt=count($_SESSION['compareProductId']);
			else
				$cnt=0;
			
							
			if(($cnt>1 or $cnt==1) and $_GET['prodid'] != '' and $_SESSION['compareProductId'][0]!='' and 
			$_SESSION['compareProductId'][0]!=$_GET['prodid'])
			{
				$newobj = new Bin_Query();
				$oldobj = new Bin_Query();
				
				$oldproductid=$_SESSION['compareProductId'][0];
				$newproductid=$_GET['prodid'];
				
				$sqlselectold = "SELECT (SELECT t1.category_name FROM category_table t1 WHERE t1.category_id = t2.category_id) AS                              catname,(SELECT t1.category_id FROM category_table t1 WHERE t1.category_id = t2.category_id) AS                              catid FROM products_table t2 WHERE t2.product_id in(".$oldproductid.")";
				$sqlselectnew = "SELECT (SELECT t1.category_name FROM category_table t1 WHERE t1.category_id = t2.category_id) AS                              catname,(SELECT t1.category_id FROM category_table t1 WHERE t1.category_id = t2.category_id) AS                              catid FROM products_table t2 WHERE t2.product_id =".$newproductid;
				
				$newobj->executeQuery($sqlselectnew);			
				$oldobj->executeQuery($sqlselectold);
				$oldcatname = $oldobj->records[0]['catname'];
				$newcatname = $newobj->records[0]['catname'];
				
				if($oldcatname == $newcatname)
				{
					$_SESSION['catid'] = $newobj->records[0]['catid'];
					$cnt=count($_SESSION['compareProductId']);
					
					
					if((!in_array($_GET['prodid'],$_SESSION['compareProductId']))&& ($cnt < 4) && ($_GET['do']=='compareproduct') ) //for accepting 4 items
						$_SESSION['compareProductId'][$cnt] = $_GET['prodid'];
					else
					{
						
					}
					$cnt=count($_SESSION['compareProductId']);
					for($i=0;$i<$cnt;$i++)
						setcookie("compareProductId[$i]",$_SESSION['compareProductId'][$i]);
					$product_ids='"'.implode('","',$_SESSION['compareProductId']).'"';
				}
				else
				{
					$product_ids = '"'.implode('","',$_SESSION['compareProductId']).'"';
					$output['success'] = "<div class='exc_msgbox'>Please select products with same category</div><br />";
					$flag =1;
				}
				
			}
			elseif(($cnt>1 or $cnt==0) and $_GET['prodid'] != '')
			{
				
				if($_SESSION['catid']=='')
				{
					$obj = new Bin_Query();
					$sql = "SELECT (SELECT t1.category_name FROM category_table t1 WHERE t1.category_id = t2.category_id) AS                              catname,(SELECT t1.category_id FROM category_table t1 WHERE t1.category_id = t2.category_id) AS                              catid FROM products_table t2 WHERE t2.product_id =".(int)$_GET['prodid'];
					
					$obj->executeQuery($sql);	
					$_SESSION['catid']=$obj->records[0]['catid'];
				
				}
				if(!isset($_SESSION['compareProductId'][0]))
					$_SESSION['compareProductId']=array();
				$cnt=count($_SESSION['compareProductId']);
			
				if(!in_array($_GET['prodid'],$_SESSION['compareProductId']) && ($cnt < 4) && ($_GET['do']=='compareproduct') )  //for accepting 4 items
					$_SESSION['compareProductId'][$cnt] = $_GET['prodid'];
				$cnt=count($_SESSION['compareProductId']);
				for($i=0;$i<$cnt;$i++)
					setcookie("compareProductId[$i]",$_SESSION['compareProductId'][$i]);
			}
			else
				$output['viewProducts']['a']='<div style="padding-left:30px;"><font color="orange" style="font-size:11px"><b>No Product(s) Found</b></font></div>';
		if($_SESSION['compareProductId']!='')
		{
			$product_ids='"'.implode('","',$_SESSION['compareProductId']).'"';
			
			if($product_ids != '')
			{
				$obj = new Bin_Query();
				$sql = "select product_id,model,title,sku,brand,description,dimension,price,thumb_image from products_table 									                        where product_id in(".$product_ids.")";
				
				if($obj->executeQuery($sql))
				{
					$output['viewProducts'] = Display_DWishList::viewProduct($obj->records);
					$output['loginStatus'] = Core_CUserRegistration::loginStatus();
					if($flag ==0 and $_GET['prodid']!='')
					{
						$sql='select title from products_table where product_id='.(int)$_GET['prodid'];
						if($obj->executeQuery($sql))
							$output['success']='<div class="success_msgbox">Product '.$obj->records[0]['title'].' successfully added to compare list</div><br />';
					}
				}
				
			}
		}
		else
			$output['viewProducts'] = Display_DWishList::viewProductElse();
		return $output;
	}
	 /**
	 * This function is used to view the Compare product 
	 *
	 * .
	 * 
	 * @return string
	 */
	function viewCompareProduct()
	{
		
		$obj1 = new Bin_Query();
		$obj2 = new Bin_Query();
		$cnt=count($_SESSION['compareProductId']);
		if($_SESSION['compareProductId'] !='')
			$product_ids='"'.implode('","',$_SESSION['compareProductId']).'"';	
		if($product_ids != '')
		{
			
			 $sql = 'select a.*,sum(b.rating)/count(b.user_id) as rating from products_table a left join product_reviews_table b on a.product_id=b.product_id where a.product_id in('.$product_ids.') group by a.product_id';//1,3,4,36
			 $sqlattrname='SELECT attrib_name,attrib_id FROM attribute_table WHERE attrib_id IN (SELECT attrib_id
			FROM category_attrib_table where subcategory_id='.$_SESSION['catid'].')';
			
			if($obj1->executeQuery($sql))
			{
				if($obj2->executeQuery($sqlattrname))
				{
					$output= Display_DWishList::viewCompareProduct($obj1->records,$obj2->records,$product_ids);
				}
				else
					$output= Display_DWishList::viewCompareProduct($obj1->records,'',$product_ids);
			}
			else
			{
				$output='<div class="exc_msgbox">No Product(s) Found</div>';
			}
		}	
		else
			$output='<div class="exc_msgbox">No Product(s) Found in compare product list</div>';
		
		return $output;	
	}
	 /**
	 * This function is used to delete item from compare product detail page
	 *
	 * .
	 * 
	 * @return string
	 */
	function deleteCompareProduct()
	{
		
		$prodid=$_GET['prodid'];
		$cnt = count($_SESSION['compareProductId']);
		
		for($i=0;$i<$cnt;$i++)
		{
			if($_SESSION['compareProductId'][$i]==$prodid)
				unset($_SESSION['compareProductId'][$i]);
		}
		$output=$this->viewCompareProduct();
		return $output;
	}
	 /**
	 * This function is used to delete item title from snapshot compare product list
	 *
	 * .
	 * 
	 * @return string
	 */
	function deleteProduct()
	{
		$cnt = count($_SESSION['compareProductId']);
		for($i=0;$i<=$cnt;$i++)
			if($_SESSION['compareProductId'][$i] == $_GET['prodid'])
				unset($_SESSION['compareProductId'][$i]);
		$cnt=count($_SESSION['compareProductId']);
			for($i=0;$i<$cnt;$i++)
				setcookie("compareProductId[$i]",$_SESSION['compareProductId'][$i]);
		$product_ids='"'.implode('","',$_SESSION['compareProductId']).'"';
		if($product_ids != '')
		{
			$obj = new Bin_Query();
			$sql = "select product_id,title from products_table where product_id in(".$product_ids.")";
			if($obj->executeQuery($sql))
			{
				$output['viewProducts'] = Display_DWishList::viewProduct($obj->records);
			}
			else
				$output['success']='<div class="exc_msgbox">No Product(s) Found</div>';
			return $output;
		}
	}
	 /**
	 * This function is used to delete All item from compare product list
	 *
	 * .
	 * 
	 * @return string
	 */
	function deleteAllItem()
	{
		$cnt = count($_SESSION['compareProductId']);
		if($cnt>0)
		{
			
			unset($_SESSION['compareProductId']); 
				unset($_COOKIE['catid']); 
			unset($_COOKIE['compareProductId']); 
			
			$output=Display_DWishList::viewProductElse();
		}
		else
		{
			$output=Display_DWishList::viewProductElse();
		}
		return $output;
		
	}
	 /**
	 * This function is used to delete the compare product from home page
	 *
	 * .
	 * 
	 * @return string
	 */
	function deleteCompareProductFromHome()
	{
		
		$prodid=$_GET['prodid'];
		$cnt = count($_SESSION['compareProductId']);
		
		if ($cnt<=1)
			unset($_COOKIE['catid']);
		
		for($i=0;$i<$cnt;$i++)
		{
			if($_SESSION['compareProductId'][$i]==$prodid)
			{
				unset($_SESSION['compareProductId'][$i]);
			}
		}
		$cnt = count($_COOKIE['compareProductId']);
		
		for($i=0;$i<$cnt;$i++)
		{
			if($_COOKIE['compareProductId'][$i]==$prodid)
			{
				unset($_COOKIE['compareProductId'][$i]);
			}
		}
		
		
	
		$output=$this->viewCompareProduct();
		return $output;
	}
	 /**
	 * This function is used to get  the snap shot from home page
	 *
	 * .
	 * 
	 * @return string
	 */
	function snapshotForHome()
	{
		if($_SESSION['user_id'] !='')
		{
			$sqlcnt = "select count(*) as temp from wishlist_table where user_id=".$_SESSION['user_id'];
			$sql = "SELECT a.product_id, a.title, a.thumb_image, a.msrp,c.soh FROM products_table a
					INNER JOIN wishlist_table b ON b.product_id = a.product_id inner join product_inventory_table c on 
					c.product_id=a.product_id  where user_id=".$_SESSION['user_id']." ORDER BY     
					date_added DESC LIMIT 0 , 2";
			$obj = new Bin_Query();
			$obj->executeQuery($sqlcnt);
			$totalitem=$obj->records[0]['temp'];
			
			if($obj->executeQuery($sql))
			{
				$cnt=count($obj->records);
				if($cnt>0)
				{
					$j=0;
					for ($i=0;$i<$cnt;$i++)
					{		
						foreach($obj->records as $row)
						{
							$r[$j]=$row;
							$prid=$row['product_id'];
							$minval=Core_CWishList::disRates($prid);
							if($minval > 0  or $minval!='')
							{
								$r[$j]['msrp']= '$'.number_format($row['msrp'],2).' - $'.number_format($minval,2);
							}
							else
								$r[$j]['msrp']= '$'.number_format($row['msrp'],2);
							$j++;
						}
						$output =  Display_DWishList::snapshotForHome($obj->records,$totalitem,$r);
					}
				}
				
			}
			else
				$output =  Display_DWishList::snapshotElseForHome();
		}
		else
				$output =  Display_DWishList::snapshotElseForHome();
		return $output;
   }
		
}
?>