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
 * Add to cart related  class
 *
 * @package   		Core_CAddCart
 * @category    	Core
 * @author    		AJ Square Inc Dev Team
 * @link   		    http://www.zeuscart.com
 * @copyright 	    Copyright (c) 2008 - 2013, AJ Square, Inc.
 * @version   		Version 4.0
 */

class Core_CAddCart 
{

	/**
	 * Stores the output
	 *
	 * @var array 
	 */	
	 var $output = array();	
	 /**
	 * Stores the output 
	 *
	 * @var array 
	 */	
	var $arr = array();

	/**
	 * This function is used to add the cart item  from home page
	 *
	 * 
	 * 
	 * @return string
	 */	
	function addCart()
	{


		if(isset($_POST['addtocart']))
		{
			if($_GET['prodid']!='')
			{
				if($_SESSION['user_id']!='')
				{
					// check wheter  cart is exists for the user
					$cartid=$this->getCartIdOfUser();
					
			
					if($cartid!=0) // if cart available for the user
					{
					
						$sql="UPDATE shopping_cart_table SET cart_date='".date('Y-m-d')."' WHERE cart_id='".$cartid."'";
						$query = new Bin_Query();
						$query->updateQuery($sql);
						
						//check the product id and cart id available in the scpt 
						$sql="SELECT product_id,cart_id,product_qty FROM shopping_cart_products_table WHERE product_id='".(int)$_GET['prodid']."' AND cart_id='".$cartid."' ";
												
						//if(yes)
						if($query->executeQuery($sql))
						{
							
							$req_qty=$query->records[0]['product_qty']+1; 
	
							$sql_soh='select soh from product_inventory_table where product_id='.(int)$_GET['prodid'];
							$query_soh = new Bin_Query();
							$query_soh->executeQuery($sql_soh);		
							$soh_product=$query_soh->records[0]['soh'];
							
							
							$sql_originalprice='SELECT msrp from products_table where product_id='.$_GET['prodid'];
							$query_originalprice = new Bin_Query();
							$query_originalprice->executeQuery($sql_originalprice);		
							$originalprice=$query_originalprice->records[0]['msrp']; 
							
							//insert the cart id , product id , product qty(1) 
							if($soh_product > $req_qty)
							{
								//update the scpt with qty and date added fields
								$sql="UPDATE shopping_cart_products_table SET date_added='".date('Y-m-d')."',product_qty='".$req_qty."' ,product_unit_price=".$originalprice." WHERE product_id='".(int)$_GET['prodid']."' AND cart_id='".$cartid."'"; 
								$query->updateQuery($sql);
								//update scpt set product_qty = product_qty+ 1 where cart_id = $cartid
							}
						}
						else
						{
							//check Soh for product
							$sql='select soh from product_inventory_table where product_id='.(int)$_GET['prodid']; 
							$query = new Bin_Query();
							$query->executeQuery($sql);		
							$soh=$query->records[0]['soh'];
							//insert the cart id , product id , product qty(1) 
							if($soh!=0)
							{
								$sql_originalprice='SELECT msrp from products_table where product_id='.$_GET['prodid'];
								$query_originalprice = new Bin_Query();
			
								$query_originalprice->executeQuery($sql_originalprice);		
								$originalprice=$query_originalprice->records[0]['msrp']; 
	
								$sql ="insert into shopping_cart_products_table (cart_id,product_id , product_qty , date_added ,product_unit_price) values (".$cartid.','. $_GET['prodid'].",1,'".date('Y-m-d')."',".$originalprice.")";
								$query->updateQuery($sql);
							}
							else
							{
								$_SESSION['cartmsg']="<div class='alert alert-error'>
								<button data-dismiss='alert' class='close' type='button'>×</button>
								The product is out of stock
								</div>";


							}
	
						}
					}					
					else // if cart is not available for the user  cnt ==0
					{
						$sql_originalprice='SELECT msrp from products_table where product_id='.$_GET['prodid'];
						$query_originalprice = new Bin_Query();
						$query_originalprice->executeQuery($sql_originalprice);		
						$originalprice=$query_originalprice->records[0]['msrp']; 
	
						$sql ="insert into shopping_cart_table (user_id , cart_date) values ('". $_SESSION['user_id']."','".date('Y-m-d')."')";
						$query = new Bin_Query();
						$query->updateQuery($sql);

						$cartid=$this->getCartIdOfUser();
						$sql1 ="insert into shopping_cart_products_table (cart_id,product_id , product_qty , date_added,product_unit_price ) values (".$cartid.','.$_GET['prodid'].",1,'".date('Y-m-d')."',".$originalprice.")"; 
						$query1 = new Bin_Query();
						$query1->updateQuery($sql1);
						
					}
					
				}		
				else
				{
					//check Soh for product
					$sql='select soh from product_inventory_table where product_id='.(int)$_GET['prodid']; 
					$query = new Bin_Query();
					$query->executeQuery($sql);		
					$soh=$query->records[0]['soh'];
					//insert the cart id , product id , product qty(1) 
					if($soh!=0)
					{	
						$mycart=array();
						$product_id=$_GET['prodid'];
						
							if (!(empty($_SESSION['mycart'])))
							{
							
								$flg=0;
							
								foreach ($_SESSION['mycart'] as $key=>$val)
								{
								
			
									if ($_SESSION['mycart'][$key]['product_id']==$product_id)
									{
										$_SESSION['mycart'][$key]['qty']=$val['qty']+1;
										$flg=1;
									}
									else
									{		
									}
								}
								
								if ($flg==0)
								{
									$mycart['product_id']=$product_id;
									$mycart['qty']= 1;
									$_SESSION['mycart'][]=$mycart;
								}
								
							}
							else
							{
					
								$mycart['product_id']=$product_id;
								$mycart['qty']= 1;
								$_SESSION['mycart'][]=$mycart;
							}
					}
					
					
				}
			}
	
		}
	}
	/**
	 * This function is used to add the cart item  from product detail page
	 *
	 * 
	 * 
	 * @return string
	 */	
	function addCartFromProductDetail()
	{

		$defaultobject=new Core_CAddCart();
		if ($defaultobject->isDigitalProduct((int)$_GET['prodid']))
		{
			$qtyfrmproduct=1;
		}
		elseif($_POST['giftqty']=='')
		{
		$qtyfrmproduct=$_POST['qty'][0];
		
		}
		else
		{		
		$qtyfrmproduct=$_POST['giftqty'];
		
		}
		
		//------------Added to calculate MSRP---------------
		
		$sql_originalprice='SELECT msrp from products_table where product_id='.$_GET['prodid'];
		$query_originalprice = new Bin_Query();
	
		$query_originalprice->executeQuery($sql_originalprice);		
		$originalprice=$query_originalprice->records[0]['msrp'];
		
		
		if($this->getMsrpByQuantity($_GET['prodid'],$qtyfrmproduct)!='')
			$msrp=$this->getMsrpByQuantity($_GET['prodid'],$qtyfrmproduct);
		else
			$msrp=$originalprice;

		// group discount
		$defobjj=new Core_CAddCart();
		$groupdiscount=$defobjj->getUserGroupDiscount();
		$msrp=$msrp-($msrp*($groupdiscount/100));
		//------------quantity checking ---------------

		
		$sql_quantity='select soh from product_inventory_table where product_id='.(int)$_GET['prodid'];
		$query_quantity = new Bin_Query();
		$query_quantity->executeQuery($sql_quantity);		
		$product_quantity=$query_quantity->records[0]['soh'];

		if($product_quantity < $qtyfrmproduct || !is_numeric($qtyfrmproduct) )
		{
			
			$_SESSION['error_quantity']=$qtyfrmproduct;
			if($product_quantity!=0)
			{
			$_SESSION['quantitymsg']="<div class='alert alert-error'>
			<button data-dismiss='alert' class='close' type='button'>×</button>
			Please enter the valid quantity is less than ".$product_quantity."
			</div>";
			}
			elseif($product_quantity=='0')
			{
			$_SESSION['quantitymsg']="<div class='alert alert-error'>
			<button data-dismiss='alert' class='close' type='button'>×</button>
			The product is out of stock
			</div>";

			}
			header('Location:?do=prodetail&action=showprod&prodid='.(int)$_GET['prodid']);
		}
		else
		{
			if($_GET['prodid']!='' && $qtyfrmproduct!='' && $qtyfrmproduct!=0)
			{
	
				if($_SESSION['user_id']!='')
				{
	
					// check wheter  cart is exists for the user
					$cartid=$this->getCartIdOfUser();
					$sqlship="SELECT shipping_cost FROM products_table WHERE product_id =".(int)$_GET['prodid'];
					$queryship=new Bin_Query();
					$queryship->executeQuery($sqlship);
					$shiprow=$queryship->records; 
				
					$shippingcost=$qtyfrmproduct*$shiprow[0]['shipping_cost'];
								
					if( $cartid!=0) // if cart available for the user
					{
						
						
						
					
						$sql="UPDATE shopping_cart_table SET cart_date='".date('Y-m-d')."' WHERE cart_id='".$cartid."'";
						$query = new Bin_Query();
						$query->updateQuery($sql);
						
						//check the product id and cart id available in the scpt 
						if($_GET['vid']!=1)
						{
						$sql="SELECT product_id,cart_id,product_qty FROM shopping_cart_products_table WHERE product_id='".(int)$_GET['prodid']."' and cart_id='".$cartid."' ";
						}							
						//if(yes)
						if($query->executeQuery($sql))
						{
							
							$req_qty=$query->records[0]['product_qty']+$qtyfrmproduct;
						
							$sql_soh='select soh from product_inventory_table where product_id='.(int)$_GET['prodid'];
							$query_soh = new Bin_Query();
							$query_soh->executeQuery($sql_soh);		
							$soh_product=$query_soh->records[0]['soh'];
						
							//insert the cart id , product id , product qty(1) 
							if($soh_product > $req_qty)
							{
								//update the scpt with qty and date added fields
								$sql="UPDATE shopping_cart_products_table SET date_added='".date('Y-m-d')."',product_qty= product_qty+ ".$qtyfrmproduct.",product_unit_price=".$msrp.",shipping_cost=".$shippingcost." WHERE product_id='".(int)$_GET['prodid']."' AND cart_id='".$cartid."'";
								$query->updateQuery($sql);
								//update scpt set product_qty = product_qty+ qty from product detail where cart_id = $cartid
							}
						}
						else
						{
							//check Soh for product
							$sql='select soh from product_inventory_table where product_id='.(int)$_GET['prodid'];
							$query = new Bin_Query();
							$query->executeQuery($sql);		
							$soh=$query->records[0]['soh'];
							//insert the cart id , product id , product qty(1) 
							if($soh!=0)
							{
								$sql ="insert into shopping_cart_products_table (cart_id,product_id , product_qty , date_added ,product_unit_price,shipping_cost,gift_product) values (".$cartid.','. $_GET['prodid'].",".$qtyfrmproduct.",'".date('Y-m-d')."',".$msrp.",".$shippingcost.",'".$_GET['vid']."')"; 
								$query->updateQuery($sql);
							}	
						}
					}
					
					else // if cart is not available for the user  cnt ==0
					{
						$sql ="insert into shopping_cart_table (user_id , cart_date) values ('". $_SESSION['user_id']."','".date('Y-m-d')."')";
							$query = new Bin_Query();
							$query->updateQuery($sql);
							$cartid=$this->getCartIdOfUser();
						$sql ="insert into shopping_cart_products_table (cart_id,product_id , product_qty , date_added ,product_unit_price,shipping_cost,gift_product) values (".$cartid.','. $_GET['prodid'].",".$qtyfrmproduct.",'".date('Y-m-d')."',".$msrp.",".$shippingcost.",'".$_GET['vid']."')";
							$query = new Bin_Query();
							$query->updateQuery($sql);
						
					}
				
				}		
				else
				{
	
		
					$mycart=array();
					$product_id=$_GET['prodid'];
					
						if (!(empty($_SESSION['mycart'])))
						{
						
							$flg=0;
						
							foreach ($_SESSION['mycart'] as $key=>$val)
							{
								if($_GET['vid']=='')
								{	
									if ($_SESSION['mycart'][$key]['product_id']==$product_id)
									{
										
										//---------------------
										$sql='select soh from product_inventory_table where product_id='.(int)$_GET['prodid'];
										$query = new Bin_Query();
										$query->executeQuery($sql);		
										$soh=$query->records[0]['soh'];
										
										$req_qty=$val['qty']+$qtyfrmproduct;
										
										
										//---------------------
										if(($soh!=0) && ($soh>$req_qty))
										{
											$_SESSION['mycart'][$key]['qty']=$val['qty']+$qtyfrmproduct;
										}
										
										$flg=1;
									}
								}
								else
								{		
								}
							}
							
							if ($flg==0)
							{
								$mycart['product_id']=$product_id;
								$mycart['qty']= $qtyfrmproduct;
								$mycart['gift']=$_GET['vid'];
								$_SESSION['mycart'][]=$mycart;
							}
							
							
						}
						else
						{
				
							$mycart['product_id']=$product_id;
							$mycart['qty']= $qtyfrmproduct;
							$mycart['gift']=$_GET['vid'];
							$_SESSION['mycart'][]=$mycart;
						}
					
					}
				
					
					
			}
		}
	
	}
	/**
	 * This function is used to get  the cart  id
	 *
	 * 
	 * 
	 * @return array 
	 */
	function getCartIdOfUser()
	{

		$sql="SELECT cart_id from shopping_cart_table  where user_id=".$_SESSION['user_id'];
		$query = new Bin_Query();
		if($query->executeQuery($sql))
		{
			return (int) $query->records[0]['cart_id'];
		}
	}
	/**
	 * This function is used to get  the user discount
	 *
	 * 
	 * 
	 * @return array 
	 */
	function getUserGroupDiscount()
	{
		$sql="SELECT a.* FROM users_group_table a,users_table b WHERE b.user_group=a.group_id AND b.user_id=".(int)$_SESSION['user_id'];
		$qry=new Bin_Query();
		$qry->executeQuery($sql);
		return (float)$qry->records[0]['group_discount'];
	}
	
	/**
	 * This function is used to show  the cart  item
	 *
	 * 
	 * 
	 * @return array 
	 */
	function showCart()
	{
		
		include_once('classes/Display/DAddCart.php');
		if($_SESSION['user_id']!='' ) 
		{	
			$cartid=Core_CAddCart::getCartIdOfUser();	
			
// 			Core_CAddCart::mergeSessionWithCartDatabase();
// 			
			if($cartid !='')
			{
				$sql3="select cou_code,cou_name from country_table";
				$obj3=new Bin_Query();
				$obj3->executeQuery($sql3);
				
				$sql="SELECT min(product_qty) as product_qty from shopping_cart_products_table where cart_id=".$cartid;
				$query = new Bin_Query();
				$query->executeQuery($sql);
			
				$qty=$query->records;
				$cnt=count($qty);
				for($i=0;$i<=$cnt;$i++)
				{
					$qty[$i]['product_qty'];
			
					if($qty[$i]['product_qty']==1)
					{
						$sql='SELECT pt.title, pt.model, pt.product_id, pt.brand, shopping_cart_products_table.shipping_cost AS shipingamount, pt.sku, pt.msrp, pt.msrp as msrp1,pt.image, pt.thumb_image, pinv.soh, shopping_cart_products_table. * , shopping_cart_table. *
						FROM (
						products_table pt
						INNER JOIN shopping_cart_products_table ON pt.product_id = shopping_cart_products_table.product_id
						)
						LEFT JOIN shopping_cart_table ON shopping_cart_products_table.cart_id = shopping_cart_table.cart_id
						INNER JOIN product_inventory_table AS pinv ON pinv.product_id = shopping_cart_products_table.product_id
						WHERE shopping_cart_table.user_id ='. $_SESSION['user_id'];
				
						$query = new Bin_Query();
						$query->executeQuery($sql);
						$flag=$query->totrows;
						if($flag==0)
						{
							return '<div class="alert alert-info">
							<button data-dismiss="alert" class="close" type="button">×</button>
							No Prodcuts Available in Your Shopping Cart.
							</div>';
						}
						else
						{
							return Display_DAddCart::showCart($query->records,$obj3->records);
						}
					}
				
					else
					{
	
						$query = new Bin_Query();
						$sql='SELECT pt.title, pt.model, pt.product_id, pt.brand, shopping_cart_products_table.shipping_cost as shipingamount, pt.sku, pt.msrp as msrp1,shopping_cart_products_table.product_unit_price AS msrp, pt.image, pt.thumb_image, pinv.soh,shopping_cart_products_table. * , shopping_cart_table. *
						FROM (
						products_table pt
						INNER JOIN shopping_cart_products_table ON pt.product_id = shopping_cart_products_table.product_id
						)
						LEFT JOIN shopping_cart_table ON shopping_cart_products_table.cart_id = shopping_cart_table.cart_id
						INNER JOIN product_inventory_table AS pinv ON pinv.product_id = shopping_cart_products_table.product_id
						WHERE shopping_cart_table.user_id ='. $_SESSION['user_id'] .'';
									
						
						$query->executeQuery($sql);
						$flag=$query->totrows;
						if($flag==0)
						{
							return '<div class="alert alert-info">
							<button data-dismiss="alert" class="close" type="button">×</button>
							No Prodcuts Available in Your Shopping Cart.
							</div>' ;
						}
						else
						{
					return Display_DAddCart::showCart($query->records,$obj3->records);
						}
				
					}
				}
		
				$i++;
			}
			else
			{
				return '<div class="alert alert-info">
				<button data-dismiss="alert" class="close" type="button">×</button>
				No Prodcuts Available in Your Shopping Cart.
				</div>';
			}
		}
				
		else //-----------------For Guest User-------------------
		{

		
			
				if($cartid =='' && isset($_SESSION['mycart']) && $_SESSION['mycart']!='')
				{
					$sql3="select cou_code,cou_name from country_table";
					$obj3=new Bin_Query();
					$obj3->executeQuery($sql3);
			
			
					$qty=$_SESSION['mycart'];
					$cnt=count($qty);
	
					foreach ($_SESSION['mycart'] as $key=>$val)
					{
						
						
							$sql='SELECT pt.title, pt.model, pt.product_id, pt.brand, pt.shipping_cost AS shipingamount, pt.sku, pt.msrp, pt.image, pt.thumb_image, pinv.soh
							FROM products_table pt
							LEFT JOIN product_inventory_table AS pinv ON pt.product_id = pinv.product_id
							WHERE pt.product_id ='.$val['product_id']; 
										
							$query = new Bin_Query();
							$query->executeQuery($sql);
							$flag=$query->records[0]['soh']; 
							
							
							$query->records[0]['soh']=(int)$query->records[0]['soh'];
							$query->records[0]['product_qty']=$val['qty'];
							$query->records[0]['shipingamount']=$val['qty']*$query->records[0]['shipingamount']; //calculating shipping cost
						
						
						if($flag==0)
						{
							return '<div class="alert alert-info">
							<button data-dismiss="alert" class="close" type="button">×</button>
							Out of stock.
							</div>';
						
						}
						elseif ($query->records[0]['soh']!=0)
						{
							$productarray[]=$query->records[0];
						}
					
				}
			
		
				
				return Display_DAddCart::showCart($productarray,$obj3->records);
			
			}
			else
			{
				return '<div class="alert alert-info">
			<button data-dismiss="alert" class="close" type="button">×</button>
			No Prodcuts Available .
			</div>';
			}
			
		}
		
		


	}
	/**
	 * This function is used to update  the cart  item
	 *
	 * 
	 * 
	 * @return array 
	 */
	
	function updateCart()
	{
		if($_SESSION['user_id']!='') 
		{	
		
			$cartid=$this->getCartIdOfUser();
			
			$cnt=count($_POST['qty']); // code heree for exceeed..
			
		
			for ($i=0;$i<$cnt;$i++)
			{
				$sql='select soh from product_inventory_table where product_id='.$_POST['prodid'][$i];
				$query = new Bin_Query();
	
				$query->executeQuery($sql);		
				$soh=$query->records[0]['soh'];
				if($_POST['qty'][$i]<=$soh)
				{
					$sql = 'UPDATE shopping_cart_products_table SET product_qty='.$_POST['qty'][$i]. ' where product_id='.$_POST['prodid'][$i].' and cart_id='.$cartid;
					$query = new Bin_Query();
		
					$query->executeQuery($sql);
					
					$orshipping=$query->records; 
					
					$sqlship="SELECT shipping_cost FROM products_table WHERE product_id =".$_POST['prodid'][$i];
					$queryship=new Bin_Query();
					$queryship->executeQuery($sqlship);
					$shiprow=$queryship->records; 
				
					$shippingcost=$_POST['qty'][$i]*$shiprow[0]['shipping_cost'];
					
					$sql = 'UPDATE shopping_cart_products_table SET product_qty='.$_POST['qty'][$i]. ', 
					shipping_cost='.$shippingcost.' where product_id='.$_POST['prodid'][$i].' and cart_id='.$cartid; 
					$query = new Bin_Query();
					$query->updateQuery($sql);
					
				
					$sql_originalprice='SELECT msrp from products_table where product_id='.$_POST['prodid'][$i];
					$query_originalprice = new Bin_Query();
	
					$query_originalprice->executeQuery($sql_originalprice);		
					$originalprice=$query_originalprice->records[0]['msrp'];
				
					if($this->getMsrpByQuantity($_POST['prodid'][$i],$_POST['qty'][$i])!='')
						$msrp[]=$this->getMsrpByQuantity($_POST['prodid'][$i],$_POST['qty'][$i]);
					else
						$msrp[]=$originalprice;
					
				}
			
				
			}
			
			$cnt=count($msrp);
		
			for ($i=0;$i<=$cnt;$i++)
			{
				
				$sql_originalprice='SELECT msrp from products_table where product_id='.$_POST['prodid'][$i];
				$query_originalprice = new Bin_Query();
	
				$query_originalprice->executeQuery($sql_originalprice);		
				$originalprice=$query_originalprice->records[0]['msrp'];
				
				$sql = 'UPDATE shopping_cart_products_table SET product_unit_price='.$msrp[$i]. ' where product_id='.$_POST['prodid'][$i].' and cart_id='.$cartid; 
	
				$query = new Bin_Query();
				$query->updateQuery($sql);
				
			}
			return $output.='<div class="success_msgbox">Shopping Cart has been Updated Successfully.</div><br/>';
		
		}
		else
		{
			
			
			$cnt=count($_POST['prodid']); // code heree for exceeed..
			
			for ($i=0;$i<$cnt;$i++)
			{
				$_SESSION['mycart'][$_POST['prodid'][$i]]['qty']=$_POST['qty'][$i];
			}
			
			return $output.='<div class="success_msgbox">Shopping Cart has been Updated Successfully.</div><br/>';
		
		}
	}
	/**
	 * This function is used to get product title from db
	 * @param integer $prodid
	 * 
	 * 
	 * @return array 
	 */
	function getProductTitle($prodid)
	{
		$sql='select title from products_table where product_id='.$prodid;
		$query = new Bin_Query();
		$query->executeQuery($sql);		
		return $title=$query->records[0]['title'];
	}
	/**
	 * This function is used to get product msrp from db
	 * @param  integer $product_id
	 * @param  integer $quantity
	 * 
	 * @return array 
	 */
	function getMsrpByQuantity($product_id,$quantity)
	{
		
		$sql='SELECT quantity,msrp FROM msrp_by_quantity_table WHERE product_id='.$product_id.' order by quantity'; 
		$query = new Bin_Query();
		$query->executeQuery($sql);		
		
		for($i=0;$i<count($query->records);$i++)
		{
		
			if($query->records[$i]['quantity'] <= $quantity)
				$msrp=$query->records[$i]['msrp'];
			
		}

		return $msrp;
	}
	/**
	 * This function is used to delete cart item
	 *
	 * 
	 * 
	 * @return array 
	 */	
	function deleteCart()
	{

		if($_SESSION['user_id']!='' && $_SESSION['mycart']=='') 
		{ 
		
			$sql = "DELETE FROM shopping_cart_products_table where product_id=".(int)$_GET['prodid']." AND id =".(int)$_GET['id'];
		
			$query = new Bin_Query();
			$query->updateQuery($sql);
		}
		elseif($_SESSION['user_id']!='' || $_SESSION['mycart']!='' )
		{
			for($i=0;$i<count($_SESSION['mycart']);$i++)
			{
				if($_SESSION['mycart'][$i]['product_id']==(int)$_GET['prodid'])
				{
					unset($_SESSION['mycart'][$i]);
				}
			}
		
		}
	
			$output='<div class="alert alert-info">
			<button type="button" class="close" data-dismiss="alert">×</button>Products Deleted Successfully From Your Cart!</div>';

		return $output;
	}
	
	/**
	 * This function is used to get product price
	 * @param integer $qty
	 * 
	 * 
	 * @return array 
	 */
	
	function FindProductPrice($qty)
	{
			
	
		$sql="SELECT distinct b.product_id,b.thumb_image, b.title, b.price AS oprice, b.msrp, c.msrp AS price, c.quantity, b.sku, b.brand, b.dimension, b.image, b.model,d.product_qty FROM products_table b 
		INNER JOIN msrp_by_quantity_table c ON b.product_id = c.product_id 
		inner join shopping_cart_products_table d on d.product_id =b.product_id
		inner join shopping_cart_table e on e.user_id=".$_SESSION['user_id']." WHERE b.product_id =".(int)$_GET['prodid']." AND c.quantity =".$_POST['qty'];
		$query = new Bin_Query();
		if($query->executeQuery($sql))
		{		
				return $query->records;
		}
		else
		{
			return "Not  Found";
		}
	}
	/**
	 * This function is used to get cart snap sort
	 *
	 * 
	 * 
	 * @return array 
	 */
	
	function cartSnapShot()
	{
		if($_SESSION['user_id']!='')
		{
			
				$userid = $_SESSION['user_id'];
				$query = new Bin_Query();
				$sql ="SELECT pt.title,pt.model,pt.product_id,pt.brand,pt.shipping_cost,pt.sku,pt.msrp,pt.image,pt.thumb_image , shopping_cart_products_table. * , shopping_cart_table. * FROM (products_table pt INNER JOIN shopping_cart_products_table ON pt.product_id = shopping_cart_products_table.product_id) LEFT JOIN shopping_cart_table ON shopping_cart_products_table.cart_id = shopping_cart_table.cart_id WHERE shopping_cart_table.user_id =".$userid;
			if($query->executeQuery($sql))
			{
				$cnt = count($query->records);
 				$a=Core_CAddCart::showCart();
				$output=Display_DAddCart::cartSnapShot($_SESSION['grandtotal'],$cnt);
			}
			else
				$output=Display_DAddCart::cartSnapShotElse();
		}
		else
		{
			$cnt=count($_SESSION['mycart']);
			if ($cnt>0)
				$output=Display_DAddCart::cartSnapShot($_SESSION['grandtotal'],$cnt);
			else
				$output=Display_DAddCart::cartSnapShotElse();
		}
		return $output;
		
	}
	/**
	 * This function is used for merging the cart data with session
	 * 
	 * @return string
	 */	
	function mergeSessionWithCartDatabase()
	{
	

		if(isset($_SESSION['mycart']))
		{
		
			$product_array=$_SESSION['mycart'];
			$default=new Core_CAddCart();
			$cartid=$default->getCartIdOfUser();
			if ($cartid==0 || $cartid=='')
			{
				$sql ="insert into shopping_cart_table (user_id , cart_date) values ('". $_SESSION['user_id']."','".date('Y-m-d')."')";
				$query = new Bin_Query();
				$query->updateQuery($sql);
			}
			$cartid=$default->getCartIdOfUser();
			
			$cartchecksql="SELECT product_id FROM shopping_cart_products_table WHERE cart_id =".$cartid;
			$cartchechqry=new Bin_Query();
			if ($cartchechqry->executeQuery($cartchecksql))
			{
				foreach ($cartchechqry->records as $records)
					$cartproducts[]=$records['product_id'];
			}
			else
				$cartproducts=array();
		
			foreach ($_SESSION['mycart'] as $key=>$val)
			{							
				
				$sql='select soh from product_inventory_table where product_id='.$val['product_id'];
				$query = new Bin_Query();
	
				$query->executeQuery($sql);		
				$soh=$query->records[0]['soh'];
				
				if($val['qty']<=$soh)
				{
					
					$sql_shipping='select shipping_cost from products_table where product_id='.$val['product_id'];
					$query_shipping = new Bin_Query();
		
					$query_shipping->executeQuery($sql_shipping);		
					$shipmentcost=$query_shipping->records[0]['shipping_cost'];
					$shippingcost=$val['qty'][$i]*$shipmentcost;
					$date=date('Y-m-d');
					$default_cls=new Core_CAddCart();
					$msrp=$default_cls->getMsrpByQuantity($val['product_id'],$val['qty']);
					
					if ($msrp=='' || $msrp==0) 
					{
						$msrp_sql="SELECT msrp FROM products_table WHERE product_id=".$val['product_id'];
						$msrp_query=new Bin_Query();
						$msrp_query->executeQuery($msrp_sql);
						$msrp=$msrp_query->records[0][msrp];
					}
					
					$defobjj=new Core_CAddCart();
					$groupdiscount=$defobjj->getUserGroupDiscount();
					$msrp=$msrp-($msrp*($groupdiscount/100));

					if(in_array($val['product_id'],$cartproducts))
					{
						$sql = "UPDATE shopping_cart_products_table SET product_qty=".$val['qty'].",product_unit_price=".$msrp." where product_id=".$val['product_id']." and cart_id=".$cartid;
					}
					else
					{
						$sql = "INSERT INTO shopping_cart_products_table (cart_id,product_id,product_qty,date_added,product_unit_price,shipping_cost) VALUES (".$cartid.",".$val['product_id'].",".$val['qty'].",'".$date."',".$msrp.",".$shippingcost.")";
					}
					$query = new Bin_Query();
			
					$query->executeQuery($sql);
				}
			}
			$_SESSION['mycart']='';
			unset($_SESSION['mycart']);
		}
	
	} 
	/**
	 * This function is used for quick registration in user guest
	 *
	 * @param array $Err
	 * 
	 * @return string
	 */	
	function showQuickRegistration($Err)
	{
		if($_SESSION['user_id']=='') 
		{						
			return Display_DAddCart::showQuickRegistration('',$Err);
		}

	}
	/**
	 * This function is used for payment page for authorizenet
	 *
	 * 
	 * @return string
	 */		
	function showPaymentPageForAuthorizenet()
	{
		if($_SESSION['user_id']!='') 
		{
			return Display_DAddCart::showPaymentPageForAuthorizenet();
		}

	}
	/**
	 * This function is used for payment page for world pay
	 *
	 * 
	 * @return string
	 */	
	function showPaymentPageForWorldPay()
	{
		if($_SESSION['user_id']!='')
		{
			Core_CPaymentGateways::manualSuccess(7);
			return Display_DAddCart::showPaymentPageForWorldPay($_POST);
		}

	}
	/**
	 * This function is used for payment page for checkout
	 *
	 * 
	 * @return string
	 */	
	function showPaymentPageFor2Checkout()
	{
		if($_SESSION['user_id']!='')
		{
			Core_CPaymentGateways::manualSuccess(6);
			return Display_DAddCart::showPaymentPageFor2Checkout($_POST);
		}

	}
	/**
	 * This function is used for payment for authorizenet for guest user
	 *
	 * 
	 * @return string
	 */	
	function doPaymentForAuthorizenet()
	{
		if($_SESSION['user_id']!='') 
			{
			$ccardno=$_POST['txtCardNumber'];
			$ccardexpry=$_POST['txt_cem'].$_POST['txt_cey'];
			
			$recordSet = $this->getPaymentGatewaySettings('5');			
			
			if($recordSet[0]['pg_setting_id']==1 && $recordSet[0]['setting_name']=='API Login ID' && $recordSet[0]['setting_values']!='')
			{
			$auth_net_login_id =base64_decode($recordSet[0]['setting_values']);
			}
			
			if ($recordSet[1]['pg_setting_id']==2 && $recordSet[1]['setting_name']=='Transaction Key' && $recordSet[1]['setting_values']!='')
			{			
			$auth_net_tran_key = base64_decode($recordSet[1]['setting_values']);
			}
			
	
			  $auth_net_url				= "https://secure.authorize.net/gateway/transact.dll";
			
			
			if ($recordSet[2]['pg_setting_id']==4 && $recordSet[2]['setting_name']=='Password' && $recordSet[2]['setting_values']!='')
			{
			$auth_net_password = base64_decode($recordSet[2]['setting_values']);  
			$authnet_values				= array
			(
				"x_login"				=> $auth_net_login_id,
				"x_version"				=> "3.1",
				"x_delim_char"			=> "|",
				"x_delim_data"			=> "TRUE",
				"x_type"				=> "AUTH_CAPTURE",
				"x_method"				=> "CC",
				"x_tran_key"			=> $auth_net_tran_key,
				"x_relay_response"		=> "FALSE",
				"x_card_num"			=> $ccardno, //"4242424242424242",
				"x_exp_date"			=> $ccardexpry, //"1209"
				"x_description"			=> "Payment ",
				"x_amount"				=> $_SESSION['checkout_amount'],
				"x_first_name"			=> $_SESSION['user_name'],
				"x_password"			=> $auth_net_password,
			);
			}
			else
			{				
			$authnet_values				= array
			(
				"x_login"				=> $auth_net_login_id,
				"x_version"				=> "3.1",
				"x_delim_char"			=> "|",
				"x_delim_data"			=> "TRUE",
				"x_type"				=> "AUTH_CAPTURE",
				"x_method"				=> "CC",
				"x_tran_key"			=> $auth_net_tran_key,
				"x_relay_response"		=> "FALSE",
				"x_card_num"			=> $ccardno, //"4242424242424242",
				"x_exp_date"			=> $ccardexpry, //"1209"
				"x_description"			=> "Recycled Toner Cartridges",
				"x_amount"				=> $_SESSION['checkout_amount'],
				"x_first_name"			=> $_SESSION['user_name'],				
			);			
			}
			
			
			$fields = "";
			foreach( $authnet_values as $key => $value ) $fields .= "$key=" . urlencode( $value ) . "&";
			
			
					
			###  $ch = curl_init("https://test.authorize.net/gateway/transact.dll"); 
			###  Uncomment the line ABOVE for test accounts or BELOW for live merchant accounts
			$ch = curl_init("https://secure.authorize.net/gateway/transact.dll"); 
			curl_setopt($ch, CURLOPT_HEADER, 0); // set to 0 to eliminate header info from response
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); // Returns response data instead of TRUE(1)
			curl_setopt($ch, CURLOPT_POSTFIELDS, rtrim( $fields, "& " )); // use HTTP POST to send form data
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); // uncomment this line if you get no gateway response. ###
			$resp = curl_exec($ch); //execute post and get results
			curl_close ($ch);

			$tok =explode('|',$resp );
			if ((count($tok)>0) &&($tok[0]==1) && ($tok[3]=='This transaction has been approved.'))
				header('Location:?do=paymentgateway&action=success&pay_type=5');
			else
				header('Location:?do=paymentgateway&action=failure');
		}

	}
	
	/**
	 * This function is used for payment for bluepay for  user
	 *
	 * 
	 * @return string
	 */		
	function showPaymentPageForBluepay()
	{
		if($_SESSION['user_id']!='') 
		{
			return Display_DAddCart::showPaymentPageForBluepay($_POST);
		}

	}
	
	
	/**
	 * This function is used for quick registration for guest user
	 *
	 * 
	 * @return string
	 */
	function doQuickRegistration()
	{
		if($_SESSION['user_id']=='') 
		{
			
			$displayname = substr($_POST['txtregemail'],0,strpos($_POST['txtregemail'],'@'));
			
			$email = $_POST['txtregemail'];
			$pswd = $_POST['txtregpass'];
			
			$date = date('Y-m-d');
			if($newsletter == '')
				$newsletter = 0;
			
			if(count($Err->messages) > 0)
			{
				 $output['val'] = $Err->values;
				 $output['msg'] = $Err->messages;
			}
			
			else
			{
				
				if( $displayname!= '' and $email != '' and $pswd != '')
				{
					
					$checksql="SELECT COUNT(user_email) AS count FROM users_table WHERE user_email='".$email."'";
					$checkqry= new Bin_Query();
					$checkqry->executeQuery($checksql);
					
					$count=$checkqry->records[0]['count'];
					
					if ($count<=0)
					{
						$pswd=base64_encode($pswd);
						$sql = "insert into users_table (user_display_name,user_email,user_pwd,user_status,user_doj) values('".$displayname."','".$email."','".$pswd."',1,'".$date."')";
						$obj = new Bin_Query();
					
						if($obj->updateQuery($sql))
						{
							$result = "<div class='success_msgbox'>Account has been Created Successfully</div></br>";
							$pwd = $_POST['txtregpass'];
							$title="Zeuscart";
							$mail_content="Thank you for registering with us. Your Login Details are given below<br>
							UserName :".$email."<br>Password:".$pwd;
							Core_CUserRegistration::sendingMail($email,$title,$mail_content);
							
							//-----------Setting Session Variables For Logging In ----------
						
							$_SESSION['user_id'] = $obj->insertid;
							$_SESSION['user_name'] = $displayname;
							
// 							$this->mergeSessionWithCartDatabase();
							header('Location:?do=showcart');
				
						}
						else
							$result = "<div class='exc_msgbox'>Account Not Created</div></br>";
					}
					else
						$result = "<div class='exc_msgbox'>Email Id Already Exists</div></br>";
				}
			}
	
			$err = $Err->messages;
			return Display_DAddCart::showQuickRegistration($result,$err);
  
		}
		
	
	}
	/**
	 * This function is used to get the billin address.
	 *
	  * @param   array  $Err   contains both error messages and values
	 * 
	 * @return string
	 */	

	function showBillingDetails($Err)
	{


		if(!isset($_SESSION['mycart']))
		{

			$sqlgift="select a.* from shopping_cart_products_table a inner join shopping_cart_table b on a.cart_id=b.cart_id where b.user_id=".$_SESSION['user_id']."";
			$objgift=new Bin_Query();
			$objgift->executeQuery($sqlgift);
			$records_gift=$objgift->records;
			$recordstot=count($records_gift);
			if($recordstot>0)
			{
				$k=0;
				for($i=0;$i<$recordstot;$i++)
				{
					
					if($records_gift[$i]['gift_product']==1)
					{
						$gifttot=$k+1;
						$k++;
					}
					
				}
			}

			if($gifttot==$recordstot)
			{
				header("Location:?do=showcart&action=showorderconfirmation&vid=1");	
			}

		}
		$obj=new Bin_Query();
		$sql="SELECT * FROM  addressbook_table WHERE  user_id ='".$_SESSION['user_id']."'";
		$obj->executeQuery($sql);
		$records=$obj->records;
		

		$sql3="select cou_code,cou_name from country_table";
		$obj3=new Bin_Query();
		$obj3->executeQuery($sql3);

		$obj_add=new Bin_Query();
		$sql_add="SELECT * FROM users_table WHERE user_id ='".$_SESSION['user_id']."'";
		$obj_add->executeQuery($sql_add);
		$billing_addess_id=$obj_add->records[0]['billing_address_id'];
			

		return Display_DAddCart::showBillingDetails($records,$obj3->records,$Err,$billing_addess_id);
		
	}
	/**
	 * This function is used to get the shipping address.
	 *
	  * @param   array  $Err   contains both error messages and values 
	 * 
	 * @return string
	 */	
	function showShippingDetails($Err)
	{
		include_once('classes/Display/DAddCart.php');
		$sql3="select cou_code,cou_name from country_table"; 
		$obj3=new Bin_Query();
		$obj3->executeQuery($sql3);

		$obj=new Bin_Query();
		$sql="select * from addressbook_table where user_id='".$_SESSION['user_id']."'";
		$obj->executeQuery($sql);
		$records=$obj->records;
		
		if($_GET['bill_add_id']!='')
		{
			$obj1=new Bin_Query();
			$sql1="UPDATE users_table SET billing_address_id='".$_GET['bill_add_id']."' WHERE user_id='".$_SESSION['user_id']."'";
			$obj1->updateQuery($sql1);

		}

		$obj_add=new Bin_Query();
		$sql_add="SELECT * FROM users_table WHERE user_id ='".$_SESSION['user_id']."'";
		$obj_add->executeQuery($sql_add);
		$shipping_address_id=$obj_add->records[0]['shipping_address_id'];

		return Display_DAddCart::showShippingDetails($records ,$obj3->records,$Err,$shipping_address_id);

	}
	/**
	 * This function is used to get the shipping method
	 *
	  * @param   array  $Err   contains both error messages and values 
	 * 
	 * @return string
	 */
	function showShippingMethod($Err)
	{
			
		$sql="SELECT * FROM shipments_master_table WHERE status=1";		
	 	$obj=new Bin_Query();
		$obj->executeQuery($sql);


		if($_GET['ship_add_id']!='')
		{
			$obj1=new Bin_Query();
			$sql1="UPDATE users_table SET shipping_address_id='".$_GET['ship_add_id']."' WHERE user_id='".$_SESSION['user_id']."'";
			$obj1->updateQuery($sql1);

		}

		return Display_DAddCart::showShippingMethod($obj->records,$Err);
	

	}
	/**
	 * This function is used to show the order confirmation
	 *
	  * @param  string  $message   contains both error messages and values 
	 * 
	 * @return string
	 */
	function showOrderConfirmation($message='')
	{

		if($_SESSION['user_id']!='' ) 
		{	

			$_SESSION['digitalproducts']=0;
			Core_CAddCart::insertShipping();
			$cartid=Core_CAddCart::getCartIdOfUser();	
			
						
			$taxarray=Core_CAddCart::getTaxSettings();

			
			if($cartid !='')
			{

				$sql3="select cou_code,cou_name from country_table";
				$obj3=new Bin_Query();
				$obj3->executeQuery($sql3);
				
				$sql="SELECT min(product_qty) as product_qty from shopping_cart_products_table where cart_id=".$cartid;
				$query = new Bin_Query();
				$query->executeQuery($sql);
		
				$qty=$query->records;
				$cnt=count($qty);
				for($i=0;$i<=$cnt;$i++)
				{
					$qty[$i]['product_qty'];
			
					if($qty[$i]['product_qty']==1)
					{
					

						 $sql='SELECT pt.title, pt.model, pt.product_id,pt.digital, pt.brand, shopping_cart_products_table.shipping_cost AS shipingamount, pt.sku, pt.msrp as msrp1,shopping_cart_products_table.product_unit_price AS msrp, pt.image, pt.thumb_image, pinv.soh, shopping_cart_products_table. * , shopping_cart_table. *
						FROM (
						products_table pt
						INNER JOIN shopping_cart_products_table ON pt.product_id = shopping_cart_products_table.product_id
						)
						LEFT JOIN shopping_cart_table ON shopping_cart_products_table.cart_id = shopping_cart_table.cart_id
						INNER JOIN product_inventory_table AS pinv ON pinv.product_id = shopping_cart_products_table.product_id
						WHERE shopping_cart_table.user_id ='. $_SESSION['user_id']; 
			 
						$query = new Bin_Query();
						$query->executeQuery($sql);
						$flag=$query->totrows;
						for($ii1=0;$ii1<$flag;$ii1++)
						{
							
							if (Core_CAddCart::isDigitalProduct($query->records[$ii1]['product_id']))
							{
								$_SESSION['digitalproducts']=$_SESSION['digitalproducts']+1;
							}
						}
						if($flag==0)
							return '<div class="alert alert-info">
							<button type="button" class="close" data-dismiss="alert">×</button>
							No Products Available in Your Shopping Cart 
							</div>';
						else
				        	return Display_DAddCart::showOrderConfirmation($query->records,$obj3->records,$taxarray,$message);
					}
			
					else
					{

						$query = new Bin_Query();
						$sql='SELECT pt.title, pt.model, pt.product_id, pt.brand,pt.digital, shopping_cart_products_table.shipping_cost as shipingamount, pt.sku, shopping_cart_products_table.product_unit_price AS msrp, pt.msrp as msrp1, pt.image, pt.thumb_image, pinv.soh,shopping_cart_products_table. * , shopping_cart_table. *
						FROM (
						products_table pt
						INNER JOIN shopping_cart_products_table ON pt.product_id = shopping_cart_products_table.product_id
						)
						LEFT JOIN shopping_cart_table ON shopping_cart_products_table.cart_id = shopping_cart_table.cart_id
						INNER JOIN product_inventory_table AS pinv ON pinv.product_id = shopping_cart_products_table.product_id
						WHERE shopping_cart_table.user_id ='. $_SESSION['user_id'] .''; 
			 
					
						$query->executeQuery($sql);
						$flag=$query->totrows;
						for($ii1=0;$ii1<$flag;$ii1++)
						{
														
							if (Core_CAddCart::isDigitalProduct($query->records[$ii1]['product_id']))
							{
								$_SESSION['digitalproducts']=$_SESSION['digitalproducts']+1;
							}
						}
						if($flag==0)
						{
							return '<div class="alert alert-info">
							<button type="button" class="close" data-dismiss="alert">×</button>
							No Products Available in Your Shopping Cart 
							</div>' ;
						}
						else
						{
		        			return Display_DAddCart::showOrderConfirmation($query->records,$obj3->records,$taxarray,$message);
						}
			
					}
			}
		
			$i++;
			}
			else
			{
				return '<div class="alert alert-info">
				<button type="button" class="close" data-dismiss="alert">×</button>
				No Products Available in Your Shopping Cart 
				</div>';
			}
		}

		else //-----------------For Guest User-------------------
		{
			
			// check wheter  cart is exists for the user
				$cartid=$this->getCartIdOfUser();

				if($cartid =='' && isset($_SESSION['mycart']) && $_SESSION['mycart']!='' )
				{

					Core_CAddCart::insertShipping();

					
						$sql ="insert into shopping_cart_table (user_id,cart_date) values ('".$_SESSION['user_id']."','".date('Y-m-d')."')"; 
						$query = new Bin_Query();
						if($query->updateQuery($sql))
		
						$cartid=mysql_insert_id();
							
					

					$sql3="select cou_code,cou_name from country_table";
					$obj3=new Bin_Query();
					$obj3->executeQuery($sql3);
					
					foreach ($_SESSION['mycart'] as $key=>$val)
					{

						$sql='SELECT pt.title, pt.model, pt.product_id, pt.brand, pt.shipping_cost AS shipingamount, pt.sku, pt.msrp, pt.image, pt.thumb_image, pinv.soh
						FROM products_table pt
						LEFT JOIN product_inventory_table AS pinv ON pt.product_id = pinv.product_id
						WHERE pt.product_id ='.$val['product_id']; 
									
						$query = new Bin_Query();
						$query->executeQuery($sql);
						$flag=$query->totrows;
						$product_unit_prince=$query->records[0]['msrp'];
						$query->records[0]['shipingamount']=$val['qty']*$query->records[0]['shipingamount'];

							$defobjj=new Core_CAddCart();
							$groupdiscount=$defobjj->getUserGroupDiscount();
							$msrp=$product_unit_prince-($product_unit_prince*($groupdiscount/100));

						if($_GET['action']!='validatecoupon')
						{
							$sqlinsert ="insert into shopping_cart_products_table (cart_id,product_id,product_qty, date_added,product_unit_price,shipping_cost,gift_product) values ('".$cartid."','".$val['product_id']."','".$val['qty']."','".date('Y-m-d')."','".$msrp."','".$query->records[0]['shipingamount']."','".$val['gift']."')"; 
							$objinsert=new Bin_Query(); 
							$objinsert->updateQuery($sqlinsert);	
						}

					}
				
					$qty=$_SESSION['mycart'];
					$cnt=count($qty);
				
					foreach ($_SESSION['mycart'] as $key=>$val)
					{
						
		
						$sql='SELECT pt.title, pt.model, pt.product_id, pt.brand, pt.shipping_cost AS shipingamount, pt.sku, pt.msrp, pt.image, pt.thumb_image, pinv.soh,scp.cart_id,scp.product_id,scp. product_unit_price 
						FROM products_table pt
						LEFT JOIN product_inventory_table AS pinv ON pt.product_id = pinv.product_id
						LEFT JOIN shopping_cart_products_table AS scp ON scp.product_id = pinv.product_id	
						WHERE pt.product_id ='.$val['product_id'].' AND scp.cart_id='.$cartid ;  
									
						$query = new Bin_Query();
						$query->executeQuery($sql);
						$flag=$query->totrows;
						$product_unit_prince=$query->records[0]['msrp'];
						
						$query->records[0]['soh']=(int)$query->records[0]['soh'];
						$query->records[0]['product_qty']=$val['qty'];
						$query->records[0]['shipingamount']=$val['qty']*$query->records[0]['shipingamount']; //calculating shipping cost
						
						
						if($flag==0)
						{
							return '<div class="alert alert-info">
							<button data-dismiss="alert" class="close" type="button">×</button>
							No Prodcuts Available in Your Shopping Cart.
							</div>';

						}
						elseif ($query->records[0]['soh']!=0)
						{
							$productarray[]=$query->records[0];
						}
					
					}
// 					if($_SESSION['gift']!='')
// 					{
// 						for($g=0;$g<count($_SESSION['gift']);$g++)
// 						{
// 
// 							/*Generate the gift Code */
// 							$characters='4';	
// 							$possible = '1234567890';
// 								$code = '';
// 								$i = 0;
// 								while ($i < $characters) { 
// 									$code .= substr($possible, mt_rand(0, strlen($possible)-1), 1);
// 									$i++;
// 						
// 								}
// 							
// 							$code="AJGC".$code;
// 			
// 							$sqlgift="INSERT INTO  gift_voucher_table(cart_id, 	gift_product_id,recipient_name,recipient_email,name,email, 	certificate_theme,message,gift_code)VALUES('".$cartid."','".$_SESSION['gift'][$g]['proid']."','".$_SESSION['gift'][$g]['rname']."','".$_SESSION['gift'][$g]['remail']."','".$_SESSION['gift'][$g]['name']."','".$_SESSION['gift'][$g]['email']."','".$_SESSION['gift'][$g]['gctheme']."','".$_SESSION['gift'][$g]['message']."','".$code."')";
// 							$objgift=new Bin_Query();
// 							$objgift->updateQuery($sqlgift);
// 	
// 						}
// 					}	
		
			
				return Display_DAddCart::showOrderConfirmation($productarray,$obj3->records,$taxarray,$message);
			
			}
			else
			{
				return '<div class="alert alert-info">
				<button data-dismiss="alert" class="close" type="button">×</button>
				No Prodcuts Available in Your Shopping Cart.
				</div>';
			}
		
		}
 	
	}
	/**
	 * This function is used to insert shipping address  in session 
	 *
	 * 
	 * 
	 * @return string
	 */
	function insertShipping()
	{
		
		// select billing and shipping address
		$sql="SELECT * FROM users_table WHERE user_id='".$_SESSION['user_id']."'";
		$obj=new Bin_Query();	
		$obj->executeQuery($sql);
		$records=$obj->records;
		$billing_address_id=$records[0]['billing_address_id'];
		$shipping_address_id=$records[0]['shipping_address_id'];


		//billing address
		$obj_bill=new Bin_Query();
		$sql_bill="select * from addressbook_table where user_id='".$_SESSION['user_id']."' and id='".$billing_address_id."'";
		$obj_bill->executeQuery($sql_bill);


		//shipping address
		$obj_ship=new Bin_Query();
		$sql_ship="select * from addressbook_table where user_id='".$_SESSION['user_id']."' and id='".$shipping_address_id."'";
		$obj_ship->executeQuery($sql_ship);		


		$orderdetails=array();		
		$orderdetails['txtname']=$obj_bill->records[0]['contact_name'];
		$orderdetails['txtcompany']=$obj_bill->records[0]['company'];
		$orderdetails['txtstreet']=$obj_bill->records[0]['address'];
		$orderdetails['txtcity']=$obj_bill->records[0]['city'];
		$orderdetails['txtsuburb']=$obj_bill->records[0]['state'];
		$orderdetails['txtzipcode']=$obj_bill->records[0]['zip'];
		$orderdetails['txtcountry']=$obj_bill->records[0]['country'];
		$orderdetails['txtstate']=$obj_bill->records[0]['state'];

		$orderdetails['txtsname']=$obj_ship->records[0]['contact_name'];
		$orderdetails['txtscompany']=$obj_ship->records[0]['company'];
		$orderdetails['txtsstreet'] =$obj_ship->records[0]['address'];
		$orderdetails['txtscity']=$obj_ship->records[0]['city'];
		$orderdetails['txtssuburb']=$obj_ship->records[0]['state'];
		$orderdetails['txtszipcode']=$obj_ship->records[0]['zip'];
		$orderdetails['txtscountry']=$obj_bill->records[0]['country'];
		$orderdetails['txtsstate'] =$obj_ship->records[0]['state'];


		$_SESSION['orderdetails']=$orderdetails;
	
	}
	/**
	 * This function is used to get payment gate way from db
	 *
	 * 
	 * 
	 * @return string
	 */
	function displayPaymentGateways()
	{
		if($_SESSION['user_id']!='') 
		{	
			$sqlonline="SELECT gateway_id,gateway_name,merchant_id FROM paymentgateways_table WHERE gateway_status=1 and gateway_id!=8 and gateway_id!=9  ";
			$queryonline = new Bin_Query();
			$queryonline->executeQuery($sqlonline);

			$sqloffline="SELECT gateway_id,gateway_name,merchant_id FROM paymentgateways_table WHERE gateway_id in(8,9) and gateway_status=1";
			$queryoffline = new Bin_Query();		
			$queryoffline->executeQuery($sqloffline);

			$sql_domain='select set_value from admin_settings_table where set_id =16';
			$query_domain = new Bin_Query();
			$query_domain->executeQuery($sql_domain);		
			$domain=$query_domain->records[0]['set_value'];
			
		
			$output=Display_DAddCart::displayPaymentGateways($queryonline->records,$queryoffline->records,$domain);
			
			return $output;
		}			
 		
	}
	/**
	 * This function is used to validate the coupon
	 *
	 * 
	 * 
	 * @return string
	 */
	function validateCoupon()
	{

		if($_SESSION['user_id']!='') 
		{
			$coupon_code=$_POST['coupon_code'];
			$date=date('Y-m-d');
			
			  $sql_coupon_first="SELECT a.coupon_code,a.coupan_name,a.created_date,a.discount_amt,a.discount_type,a.valid_from,valid_to ,a.min_purchase ,a.no_of_uses,b.user_id,b.no_of_uses FROM coupons_table a , coupon_user_relation_table b  WHERE ";	
		
			$sql_coupon=$sql_coupon_first." a.coupon_code='".$coupon_code."' ";
			
			$obj_coupon=new Bin_Query();
			$obj_coupon_5=new Bin_Query();
						
			if($obj_coupon->executeQuery($sql_coupon))
			{			
				 $sql_coupon_1=$sql_coupon." and a.status=1 ";
				if($obj_coupon->executeQuery($sql_coupon_1))
				{
					 $sql_coupon_2=$sql_coupon_1." and '".$date."' between a.valid_from and a.valid_to ";
					
					if($obj_coupon->executeQuery($sql_coupon_2))
					{
						 $sql_coupon_3=$sql_coupon_2." and a.coupon_code=b.coupon_code and b.user_id=".$_SESSION['user_id']." ";
					
						if($obj_coupon->executeQuery($sql_coupon_3))
						{
							
							 $sql_coupon_4=$sql_coupon_3." and a.min_purchase<=".$_SESSION['total']." ";
					
							if($obj_coupon->executeQuery($sql_coupon_4))
							{
								 $sql_coupon_5=$sql_coupon_4." and b.no_of_uses < a.no_of_uses "; 
					
								if($obj_coupon_5->executeQuery($sql_coupon_5))
								{
									$default=new Core_CAddCart();
									return $default->redeemCoupon($obj_coupon_5->records[0]);
									

								
								}
								else
									return $output= '<div class="alert alert-info">
									<button data-dismiss="alert" class="close" type="button">×</button>
									Sorry. You Have Exceeded Your Coupon Using Limit.
									</div>';			
							}
							else
								return $output= '<div class="alert alert-info">
								<button data-dismiss="alert" class="close" type="button">×</button>
								Sorry. Purchase Amount Is Too Low To Use Your Coupon.
								</div>';
						}
						else
							return $output= '<div class="alert alert-info">
							<button data-dismiss="alert" class="close" type="button">×</button>
							Coupon Not Eligible For You.
							</div>';

					}
					else
						return $output= '<div class="alert alert-info">
						<button data-dismiss="alert" class="close" type="button">×</button>
						Coupon Code Expired.
						</div>';

				}
				else
					return $output= '<div class="alert alert-info">
					<button data-dismiss="alert" class="close" type="button">×</button>
					Coupon Code Is Not Active.
					</div>';

			}
			else
		   		return $output= '<div class="alert alert-error">
				<button data-dismiss="alert" class="close" type="button">×</button>
				Invalid Coupon Code.
				</div>';


		}
		else
		{
			return $output='<div class="alert alert-info">
			<button data-dismiss="alert" class="close" type="button">×</button>
			Please Login To Use Your Coupon.
			</div>';
		}



	}
	/**
	 * This function is used to get product   redeem  coupon from db.
	 * @param array $arr
	 * 
	 * 
	 * @return string
	 */
	function redeemCoupon($arr)
	{
	
		if (!(empty($arr)))
		{
			$sql_coupon_categories="SELECT category_id FROM coupon_category_table WHERE coupon_code='".$arr['coupon_code']."'";
			$query_coupon_categories = new Bin_Query();
			
			if($rows=$query_coupon_categories->executeQuery($sql_coupon_categories))
			{
				foreach($query_coupon_categories->records as $res)
					$category_ids[]=$res['category_id'];
				
				$default=new Core_CAddCart();
				$cartdata=$default->getCartData();
			
				if(!(empty($cartdata)))
				{
					$cartflag=0;
					$sucessflag=0;
					foreach ($cartdata as $data)
					{

					  $cart_categoryid=$default->getCategoryIdByProductId($data['product_id']); 


						for($i1=0;$i1<count($category_ids);$i1++)
						{
							if($category_ids[$i1]==$cart_categoryid)
							{

								if ($arr['discount_type']=='percent')
									 $redeem_price=$data['msrp']-($data['msrp']*($arr['discount_amt']/100));
								else
									 $redeem_price=$data['msrp']-$arr['discount_amt']; 
									
								 $update_amt_sql="UPDATE shopping_cart_products_table SET product_unit_price=".$redeem_price." WHERE cart_id=".$data['cart_id']." and product_id='".$data['product_id']."'";
								
								$update_coupon_sql="UPDATE coupon_user_relation_table SET no_of_uses=no_of_uses+1 WHERE coupon_code='".$arr['coupon_code']."' AND user_id=".$_SESSION['user_id'];
	
								$update_amt_query = new Bin_Query();
								if($update_amt_query->updateQuery($update_amt_sql))
								{							
									$update_coupon_query = new Bin_Query();
									
									if ($update_coupon_query->updateQuery($update_coupon_sql))
										$output='<div class="alert alert-success">
										<button data-dismiss="alert" class="close" type="button">×</button>
										Coupon Redeemed Successfully.
										</div>';
								
								}
						
							}
							$cartflag=1;						
						}
						
						
					}
					if ($cartflag==0)
						return $output='<div class="alert alert-info">
						<button data-dismiss="alert" class="close" type="button">×</button>
						No Categories In Your Shopping Cart Matches With The Coupon Categories.
						</div>';

								
					else
						return $output;
				}
				
			}
			else
			{
				return $output='<div class="alert alert-info">
				<button data-dismiss="alert" class="close" type="button">×</button>
				No Categories Are Applicable For The Coupon.
				</div>';


			}
		}

	}
	
	/**
	 * This function is used to get  the cart data
	 *
	 * 
	 * 
	 * @return string
	 */
	function getCartData()
	{
		if($_SESSION['user_id']!='') 
		{	
			
			$cartid=Core_CAddCart::getCartIdOfUser();	
			
			if($cartid !='')
			{
				$sql="SELECT min(product_qty) as product_qty from shopping_cart_products_table where cart_id=".$cartid;
				$query = new Bin_Query();
				$query->executeQuery($sql);
		
				$qty=$query->records;
				$cnt=count($qty);
				for($i=0;$i<=$cnt;$i++)

				{
					$qty[$i]['product_qty'];
			
					if($qty[$i]['product_qty']==1)
					{

						$sql='SELECT pt.title, pt.model, pt.product_id, pt.brand, pt.shipping_cost AS shipingamount, pt.sku, pt.msrp, pt.image, pt.thumb_image, pinv.soh, shopping_cart_products_table. * , shopping_cart_table. *
						FROM (
						products_table pt
						INNER JOIN shopping_cart_products_table ON pt.product_id = shopping_cart_products_table.product_id
						)
						LEFT JOIN shopping_cart_table ON shopping_cart_products_table.cart_id = shopping_cart_table.cart_id
						INNER JOIN product_inventory_table AS pinv ON pinv.product_id = shopping_cart_products_table.product_id
						WHERE shopping_cart_table.user_id ='. $_SESSION['user_id'];
			 
						$query = new Bin_Query();
						$query->executeQuery($sql);
						$flag=$query->totrows;
						if($flag==0)
							return ;
						else
				        	return $query->records;
					}
			
					else
					{
					
						$query = new Bin_Query();
						$sql='SELECT pt.title, pt.model, pt.product_id, pt.brand, pt.shipping_cost as shipingamount, pt.sku, shopping_cart_products_table.product_unit_price AS msrp1,pt.msrp, pt.image, pt.thumb_image, pinv.soh,shopping_cart_products_table. * , shopping_cart_table. *
						FROM (
						products_table pt
						INNER JOIN shopping_cart_products_table ON pt.product_id = shopping_cart_products_table.product_id
						)
						LEFT JOIN shopping_cart_table ON shopping_cart_products_table.cart_id = shopping_cart_table.cart_id
						INNER JOIN product_inventory_table AS pinv ON pinv.product_id = shopping_cart_products_table.product_id
						WHERE shopping_cart_table.user_id ='. $_SESSION['user_id'] .'';
									
					
						$query->executeQuery($sql);
						$flag=$query->totrows;
						if($flag==0)
						{
							return ;
						}
						else
						{
		        			return $query->records;
						}
			
					}
			}
		
			$i++;
			}
			
		}
	}
	/**
	 * This function is used to get product   category id from db.
	 * @param integer $productid
	 * 
	 * 
	 * @return int
	 */
	function getCategoryIdByProductId($productid)
	{
		if ($productid!='')
		{
			$sql="SELECT category_id FROM products_table WHERE product_id=".(int)$productid;
			$qry= new Bin_Query();
			$qry->executeQuery($sql);
			
			return $categoryid=$qry->records[0]['category_id'];
		}
	}
	/**
	 * This function is used to get product   quantity from db.
	 *
	 * 
	 * 
	 * @return void
	 */
	function getProductQtyForProduct()
	{
		if($_SESSION['user_id']!='')
		{
			// check wheter  cart is exists for the user
			$cartid=Core_CAddCart::getCartIdOfUser();
						
			if( $cartid!=0) // if cart available for the user
			{
								
				//check the product id and cart id available in the scpt 
				$sql="SELECT product_id,cart_id,product_qty FROM shopping_cart_products_table WHERE product_id='".(int)$_GET['prodid']."' and cart_id='".$cartid."'";
										
				//if(yes)
				if($query->executeQuery($sql))
				{
					
					$req_qty=$query->records[0]['product_qty'];
					$sql_soh='select soh from product_inventory_table where product_id='.(int)$_GET['prodid'];
					$query_soh = new Bin_Query();
					$query_soh->executeQuery($sql_soh);		
					$soh_product=$query_soh->records[0]['soh'];
					$dispproduct=$soh_product-$req_qty;
				}
			}
		}
		else // Guest User
		{
			
			$sql_soh='select soh from product_inventory_table where product_id='.(int)$_GET['prodid'];
			$query_soh = new Bin_Query();
			$query_soh->executeQuery($sql_soh);		
			$soh_product=$query_soh->records[0]['soh'];
			$dispproduct=$soh_product-$_SESSION['mycart'][$_GET['prodid']]['qty'];
		}
		
		return $dispproduct;
	}
	
	/**
	 * This function is used to get tax settings  .
	 *
	 * 
	 * 
	 * @return string
	 */
	function getTaxSettings()
	{
		$sqlgettaxtype="SELECT id FROM tax_master_table WHERE status=1";
		$querytaxtype=new Bin_Query();
		$querytaxtype->executeQuery($sqlgettaxtype);
		$taxtype=$querytaxtype->records[0]['id'];
		
		if (($taxtype!='')||($taxtype!=0))
		{
			$taxsettingarray=array();
			$taxsettingarray['tax_rate_percent']=0;
			if ($taxtype==1)
			{
				$taxsettingarray['tax_rate_percent']=0;
			}
			elseif ($taxtype==2)
			{
				
				
				$taxsql="SELECT id,tax_name,based_on_amount,country_code,based_on_address,tax_rate_percent,status FROM countrywisetax_settings_table WHERE country_code='".$_POST['selbillcountry']."' AND based_on_address='billing'";
				$taxqry=new Bin_Query($taxsql);
				$taxqry->executeQuery($taxsql);
				
				
				if (count($taxqry->records)<=0)
				{
					$taxshippingsql="SELECT id,tax_name,based_on_amount,country_code,based_on_address,tax_rate_percent,status FROM countrywisetax_settings_table WHERE country_code='".$_POST['selshipcountry']."' AND based_on_address='shipping'";
					$taxshippingqry=new Bin_Query($taxshippingsql);
					$taxshippingqry->executeQuery($taxshippingsql);
				
					if (count($taxshippingqry->records)>0)
						$taxsettingarray=$taxshippingqry->records[0];
						
				}
				else
					$taxsettingarray=$taxqry->records[0];
			
			}
			elseif ($taxtype==3)
			{
				$taxsql="SELECT tax_name,based_on_amount,tax_rate_percent FROM uniquetax_settings_table";
				$taxqry=new Bin_Query($taxsql);
				$taxqry->executeQuery($taxsql);
				
				$taxsettingarray=$taxqry->records[0];
			}
			
			return $taxsettingarray;
			
		}
		
	}
	/**
	 * This function is used to get payment gateway  .
	 * @param integer $id
	 * 
	 * 
	 * @return string
	 */
	function getPaymentGatewaySettings($id)
	{
		$sql = 'select * from paymentgateways_settings_table where gateway_id='.$id;
		$obj = new Bin_Query();
		if($obj->executeQuery($sql))
		{				 
			return($obj->records); 
		}	
	
	}
	
	/**
	 * This function is used to insert the billing address.
	 *
	 * 
	 * 
	 * @return void
	 */
	function insertBillingAddress()
	{

		$obj=new Bin_Query();
		$sql="INSERT INTO  addressbook_table(user_id,contact_name,first_name,company,address,city,suburb,state,country,zip,phone_no)VALUES('".$_SESSION['user_id']."','".$_POST['txtname']."','".$_POST['txtname']."','".$_POST['txtcompany']."','".$_POST['txtstreet']."','".$_POST['txtcity']."','".$_POST['txtsuburb']."','".$_POST['txtstate']."','".$_POST['selbillcountry']."','".$_POST['txtzipcode']."','".$_POST['txtphone']."')";
		if($obj->updateQuery($sql))
		{
			$obj1=new Bin_Query();
			$sql1="UPDATE users_table SET billing_address_id='".mysql_insert_id()."' WHERE user_id='".$_SESSION['user_id']."'";
			$obj1->updateQuery($sql1);
			header('Location:?do=showcart&action=getshippingaddressdetails');
			exit();
		}


	}
	/**
	 * This function is used to insert the shipping address.
	 *
	 * 
	 * 
	 * @return void
	 */
	function insertShippingAddress()
	{
	
		$obj=new Bin_Query();
		$sql="INSERT INTO  addressbook_table(user_id,contact_name,first_name,company,address,city,suburb,state,country,zip,phone_no)VALUES('".$_SESSION['user_id']."','".$_POST['txtname']."','".$_POST['txtname']."','".$_POST['txtcompany']."','".$_POST['txtstreet']."','".$_POST['txtcity']."','".$_POST['txtsuburb']."','".$_POST['txtstate']."','".$_POST['selshipcountry']."','".$_POST['txtzipcode']."','".$_POST['txtphone']."')";
		if($obj->updateQuery($sql))
		{
			$obj1=new Bin_Query();
			$sql1="UPDATE users_table SET shipping_address_id='".mysql_insert_id()."' WHERE user_id='".$_SESSION['user_id']."'";
			$obj1->updateQuery($sql1);
			header("Location:?do=showcart&action=getshippingmethod");
			exit();
		}


	}
	/**
	 * This function is used to get  the cart  count amount.
	 *
	 * 
	 * 
	 * @return array
	 */
	function countCart()
	{


		if(!isset($_SESSION['user_id']) || isset($_SESSION['mycart']))
		{


				$sum=0;
				if(count($_SESSION['mycart'])>0)
				{
					sort($_SESSION['mycart']);
					for($i=0;$i<count($_SESSION['mycart']);$i++)
					{
						
						 $sum=$sum+$_SESSION['mycart'][$i]['qty'];
					}
				}
				$carts=count($_SESSION['mycart']);
				return $carts;
		}
		
		else if(isset($_SESSION['user_id']))
		{
			$sql='SELECT pt.title, pt.model, pt.product_id, pt.brand, shopping_cart_products_table.shipping_cost AS shipingamount, pt.sku, pt.msrp, pt.msrp as msrp1,pt.image, pt.thumb_image, pinv.soh, shopping_cart_products_table. * , shopping_cart_table. * FROM (
			products_table pt INNER JOIN shopping_cart_products_table ON pt.product_id = shopping_cart_products_table.product_id) LEFT JOIN shopping_cart_table ON shopping_cart_products_table.cart_id = shopping_cart_table.cart_id INNER JOIN product_inventory_table AS pinv ON pinv.product_id = shopping_cart_products_table.product_id WHERE shopping_cart_table.user_id ='. $_SESSION['user_id']; 
				 
					$query = new Bin_Query();
					$query->executeQuery($sql);
					$sum=0;
					if($query->totrows>0)
					for($i=0;$i<$query->totrows;$i++)
						$sum=$sum+$query->records[$i]['product_qty'];
					$carts=count($query->records);
					return $carts;
		}
		else 
 		{
			return '0';
		}
	
	}
	/**
	 * This function is used to  check the digital product
	 *
	 * 
	 * 
	 * @return int
	 */
	function isDigitalProduct($product_id)
	{
		$sql="SELECT digital FROM products_table WHERE product_id=".(int)$product_id;
		$query=new Bin_Query();
		
		if ($query->executeQuery($sql))
			return (int)$query->records[0]['digital'];
		else
			return 0;
	}
	
}
?>