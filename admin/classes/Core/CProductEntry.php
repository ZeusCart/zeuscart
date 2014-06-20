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
 * This class contains functions to insert a new product into the database.
 *
 * @package  		Core_CProductEntry
 * @category  		Core
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
   * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */


 class Core_CProductEntry
{
 	
	/**
	 * Function adds a new product into the database
	 * 
	 * 
	 * @return string
	 */
	

	
	function insertProduct()
	{

		if($_POST['product_alias']!='')
		{
			
			$sluggable=$_POST['product_alias'];			
			
		}
		else
		{
			$sqlcheck="SELECT * FROM  ".TBL_PREFIX."products_table WHERE alias='".$_POST['product_title']."'";
			$objcheck=new Bin_Query();
			if(!$objcheck->executeQuery($sqlcheck))	
			{
				$sluggable=$_POST['product_title'];
			}
				
		}
		//convert all special charactor into hyphens and lower case
		$sluggable = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $sluggable);
		$sluggable = trim($sluggable, '-');
		if( function_exists('mb_strtolower') ) { 
			$sluggable = mb_strtolower( $sluggable );
		} else { 
			$sluggable = strtolower( $sluggable );
		}
		$sluggable = preg_replace("/[\/_|+ -]+/", '-', $sluggable);

		include('classes/Lib/ThumbImage.php');

// 		$category_id=(int)$_POST['selcatgory'];
// 		$sub_category_id=(int)$_POST['selsubcatgory'];
// 		$sub_under_category_id=(int)$_POST['selsubundersubcatgory'];
		$category_id = implode(",",$_POST['selcatgory']);
		$title=$_POST['product_title'];
		$description=str_replace('#','',$_POST['desc']);
		$sku=$_POST['sku'];
		$brand=$_POST['new_brand'];
		$model=$_POST['model'];
		$tag=$_POST['tag'];
		if($_POST['intro_date']!='')
		{
			$intro_date=$_POST['intro_date'];
			$intro_date=date("Y-m-d", strtotime($intro_date));
		}
		else
		{
			$intro_date= date('Y-m-d');

		}
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
		$shipping_cost=(float)$_POST['shipcost'];
		
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
		
		$images=$_POST['ufile'];
		
		$imgfile= $_FILES['ufile']['name'][0];
		$description=addslashes(stripslashes(trim($description)));		
		$description=str_replace(array("\r","\n",'\r','\n'),'', $description);	
	
		$sql="insert into products_table(category_id, sku, title, description, brand, model, msrp,price,cse_enabled,cse_key, weight, dimension, thumb_image, image, shipping_cost, status, tag, meta_desc, meta_keywords, intro_date, is_featured,product_status,alias)values('".$category_id."','".$sku."','".$title."','".$description."','".$brand."','".$model."','".$msrp_org."','".$price."','".$cse_enabled."','".$csekeyid."','".$weight."','".$dimension."','".$thumb_image."','".$image."','".$shipping_cost."','".$status."','".$tag."','".$meta_desc."','".$meta_keywords."','".$intro_date."','".$is_feautured."','".$product_status."','".$sluggable."')";	
				
		$obj=new Bin_Query();
			
		
		if($obj->updateQuery($sql))
		{
		    	$product_id=$obj->insertid;
			//-----------------------Product Variation--------------------------
			
				
				for($ii=0;$ii<count($_POST['varianname']);$ii++)
				{
					
					$varpweight=trim($_POST['prweight'][$ii]);
					$varpwidth=trim($_POST['prwidth'][$ii]);
					$varpheight=trim($_POST['prheight'][$ii]);
					$varpdepth=trim($_POST['prdepth'][$ii]);
					if($varpweight>0)
						$varweight=$varpweight;
					else
						$varweight='';
					$dimension='';
					if($varpwidth<=0&&$varpheight<=0&&$varpdepth<=0)
						{
							$vardimension='';
							
						}
					else
						{
							if($varpwidth>0)
								$vardimension=$varpwidth.' x ';
							else
								$vardimension='0 x ';
							if($varpheight>0)
								$vardimension.=$varpheight.' x ';
							else
								$vardimension.='0 x ';
							if($varpdepth>0)
								$vardimension.=$varpdepth;
							else
								$vardimension.='0';
							//$dimension=$pwidth.'-'.$pheight.'-'.$pdepth;	
						}
						
					if(count($_FILES['prvarimage']['name'][$ii]) > 0)
					{
						$varimgfilename= $_FILES['prvarimage']['name'][$ii];
						
						$varimage="images/products/".date("Y-m-d-His").$varimgfilename; //inserted into db
						$varthumb_image="images/products/thumb/".date("Y-m-d-His").$varimgfilename; //inserted into db
						$varlarge_image="images/products/large_image/".date("Y-m-d-His").$varimgfilename; 
				
						$varimageDir=ROOT_FOLDER."images/products"; // to upload the file
						$varthumbDir=ROOT_FOLDER."images/products/thumb"; //to upload the file
						$varlargeDir=ROOT_FOLDER."images/products/large_image";	
							
						$varstpath=ROOT_FOLDER.$varimage;
						if(move_uploaded_file($_FILES["prvarimage"]["tmp_name"][$ii],$varstpath))
						{
							list($varimg_w,$varimg_h, $vartype, $varattr) = getimagesize($varstpath);
							
								new Lib_ThumbImage('thumb',$varstpath,$varthumbDir,THUMB_WIDTH,THUMB_HEIGHT);	
					
								new Lib_ThumbImage('thumb',$varstpath,$varimageDir,IMAGE1_WIDTH,IMAGE1_HEIGHT);	
								new Lib_ThumbImage('thumb',$varstpath,$varlargeDir,IMAGE2_WIDTH,IMAGE2_HEIGHT);			
						}
							
						
					}
				
					$sqlvariation="INSERT INTO product_variation_table (product_id,sku,variation_name,msrp,price,weight,dimension,thumb_image,image,shipping_cost,soh,rol,status,large_image) VALUES(".$product_id.",'".$_POST['prsku'][$ii]."','".$_POST['varianname'][$ii]."',".$_POST['prmsrp'][$ii].",".$_POST['prprice'][$ii].",'".$varweight."','".$vardimension."','".$varthumb_image."','".$varimage."',".(float)$_POST['prshipcost'][$ii].",".$_POST['prsoh'][$ii].",".$_POST['prrol'][$ii].",1,'".$varlarge_image."')";
					$qryvariation=new Bin_Query();
					
					$qryvariation->updateQuery($sqlvariation);
							
					$sqlvariationstatus="UPDATE  products_table SET has_variation =1 WHERE product_id=".$product_id;
					$qryvariationstatus=new Bin_Query();
					$qryvariationstatus->updateQuery($sqlvariationstatus);
				}
	
				//-----------------------Product Variation--------------------------
			$sql = "insert into cross_products_table (product_id,cross_product_ids) values('".$product_id."','".$related_val."')"; 
			$query = new Bin_Query();
			$query->updateQuery($sql);
			
			$sql="insert into product_inventory_table(product_id, rol, soh)values('".$product_id."',".$rol.",".$soh.")";		
			$obj->updateQuery($sql);
			
			if(count($attribute) > 0)
			{
				for($i=0;$i<count($attribute);$i++)
				{
					$sq="INSERT INTO product_attrib_values_table(product_id,attrib_value_id) VALUES ('".$product_id."',$attribute[$i])";
					$obj->updateQuery($sq);
				}
			}
			
			if(count($msrp) > 0)
			{
				for($i=0;$i<count($msrp);$i++)
				{
					if($msrp[$i]!='' && $quantity[$i]!='')
					{
						$sq12="INSERT INTO msrp_by_quantity_table(product_id,quantity,msrp) VALUES ('".$product_id."',$quantity[$i],$msrp[$i])";
						$obj->updateQuery($sq12);
					}
				}
			}
			

			if(count($_FILES['ufile']['name']) > 0)
			{
				for($i=0;$i<count($_FILES['ufile']['name']);$i++)
				{
					$imgfilename= $_FILES['ufile']['name'][$i];
					
		

					$imagefilename = date("Y-m-d-His").$imgfilename ; // generate a new name
					
					$image="images/products/". $imagefilename; // updated into DB
					$thumb_image="images/products/thumb/".$imagefilename; // updated into DB
					$large_image="images/products/large_image/".$imagefilename; 

					$stpath=ROOT_FOLDER.$image;
					$imageDir=ROOT_FOLDER."images/products"; // to upload the file
					$thumbDir=ROOT_FOLDER."images/products/thumb"; //to upload the file
					$largeDir=ROOT_FOLDER."images/products/large_image";
					
					if(move_uploaded_file($_FILES["ufile"]["tmp_name"][$i],$stpath))
					{
						list($img_w,$img_h, $type, $attr) = getimagesize($stpath);
						
						new Lib_ThumbImage('thumb',$stpath,$thumbDir,THUMB_WIDTH,THUMB_HEIGHT);	
								
							
						new Lib_ThumbImage('thumb',$stpath,$imageDir,IMAGE1_WIDTH,IMAGE1_HEIGHT);
						new Lib_ThumbImage('thumb',$stpath,$largeDir,IMAGE2_WIDTH,IMAGE2_HEIGHT);
					
					}
					if($i==0)
					{
						$imgType='main';
						$update="UPDATE products_table set image='$image',thumb_image='$thumb_image',large_image_path='$large_image' where product_id='".$product_id."'";						
						$obj->updateQuery($update);
					}
					else
					{
						$imgType='sub';
					}
						
						if($_FILES['ufile']['name'][$i]!='')
						{
							$query_img="INSERT INTO product_images_table(product_id,image_path,thumb_image_path,type,large_image_path) VALUES('".$product_id."','$image','$thumb_image','$imgType','$large_image')";
							
							$obj_img=new Bin_Query();

							$obj_img->updateQuery($query_img);
						}


				}
			}

				
			$_SESSION['update_msg']='<div class="alert alert-success">
				<button data-dismiss="alert" class="close" type="button">×</button>Product <b>'.$title.'</b> has been inserted successfully</div>';
			header('Location:?do=manageproducts');
			exit;		
		}
		
		else
		 {

			@unlink(ROOT_FOLDER.$image); 
			@unlink(ROOT_FOLDER.$thumb_image);
			@unlink(ROOT_FOLDER.$large_image);	
			return '<div class="alert alert-error">
				<button data-dismiss="alert" class="close" type="button">×</button>Unable to create product</div>';	
		 }
		
	}
	
	
	/**
	 * Function gets the category details from the database
	 * 
	 * @param string $selected
	 *
	 * @return string
	 */	

	
	function displayCategory($selected='')
	{
		$sql = "SELECT category_id,category_name FROM category_table where category_parent_id=0  and category_status!='2' order by category_name";
		$query = new Bin_Query();
		$query->executeQuery($sql);
		return Display_DProductEntry::displayCategory($query->records,$selected);		
	}
	
	/**
	 * Function gets the sub category details for the selected category 
	 * 
	 * @param integer $id
	 *
	 * @return string
	 */	
	
	function displaySubCategory($id)
	{
		$id=(int)$_GET['id'];
		if(is_int($id))
		{
			$sql = "SELECT category_id,category_name FROM category_table where category_parent_id=".$id ." AND sub_category_parent_id =0 and category_status!='2'";
			$query = new Bin_Query();
			$query->executeQuery($sql);
			return Display_DProductEntry::displaySubCategory($query->records);
		}
	}
	/**
	 * Function gets the sub under category details for the selected  sub category 
	 * 
	 * @param integer $id
	 *
	 * @return string
	 */	
	
	function displaySubUnderCategory($id)
	{
		$id=(int)$_GET['id'];
		if(is_int($id))
		{
			 $sql = "SELECT category_id,category_name FROM category_table where sub_category_parent_id=".$id ." and category_status!='2'";
			$query = new Bin_Query();
			$query->executeQuery($sql);
			return Display_DProductEntry::displaySubUnderCategory($query->records);
		}
	}	
			
	/**
	 * Function gets the maximum product id from the database 
	 * 	 
	 *
	 * @return string
	 */	
	 
	function addMoreMsrpLink()
	{
	   /*$maxid=$_POST['maxid'];
	   if((empty($maxid))or((($maxid)<0)))
	   {*/
		   $sql='select max(product_id)as maxid from products_table';
		   $obj=new Bin_Query();
		   $obj->executeQuery($sql);
		   $maxid=$obj->records[0]['maxid'];
		   return Display_DProductEntry::addMoreMsrpLink($maxid);
	  //}
	   
	}
	
	/**
	 * Function gets the maximum product id from the database 
	 * 	 
	 *
	 * @return string
	 */	
	
	function addMoreFeaturesLink()
	{
	   $sql='select max(product_id)as maxid from products_table';
	   $obj=new Bin_Query();
	   $obj->executeQuery($sql);
	   $maxid=$obj->records[0]['maxid'];
	   return Display_DProductEntry::addMoreMsrpLink($maxid);
	}
	
	/**
	 * Function gets the product details from the database
	 * 	 
	 *
	 * @return string
	 */	
	
	function  editProductEntry()
	{   
	    $id=$_GET['id'];
		//$id=75;
		if(((int)$id)>0)
		{
			$sql='select * from products_table where product_id='.$id;
			$obj=new Bin_Query();
		    $obj->executeQuery($sql);
			return Display_DProductEntry::editProductEntry($obj->records);
	    }
	}
	
	/**
	 * Function gets the brand details from the database 
	 *		
	 * @param string $selected	 
	 * 
	 * @return string
	 */	
	
	function dispBrand($selected='')
	{
	   $sql='select distinct brand,product_id from products_table group by brand asc';
	   $obj=new Bin_Query();
	   $obj->executeQuery($sql);
	   return Display_DProductEntry::dispBrand($obj->records,$selected);
	}
	
	/**
	 * Function gets the product details from the database 
	 *		
	 * 
	 * 
	 * @return string
	 */	
	
	
	function showProducts()
	{
		
		include('classes/Lib/Paging.php');
		
		$pagesize=5;
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
			
			//$sql = "SELECT 	* FROM products_table LIMIT $start,$end ";
			$sql = "SELECT 	* FROM products_table";
			
			$query = new Bin_Query();
			
			if($query->executeQuery($sql))
				
				return  Display_DProductEntry::showAllProducts($query->records,1,$this->data['paging'],$this->data['prev'],$this->data['next'],$start);
				
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
	 * 
	 * @return string
	 */	
	
	
	function searchProducts()
	{
		$title=$_GET['title'];
		$brand=$_GET['brand'];
		$frommsrp=$_GET['frommsrp'];
		$tomsrp=$_GET['tomsrp'];
		$fromprice=$_GET['fromprice'];
		$toprice=$_GET['toprice'];
		$view=$_GET['view'];
		
		$sql='SELECT distinct pt.title,pt.product_id,pt.brand, pt.price,pt.msrp FROM products_table as pt ';
		$condition=array();
		
		if($view!='all')
		{
		
			if($title!='')
			{
				$condition []= "  pt.title like '%".$title."%'";
			}
			if($brand!='')
			{
				$condition[]= " pt.brand like  '%".$brand."%'";
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
			if(count($condition)>1)
				 
				$sql.= ' where '. implode(' and ', $condition) ;
				 
			elseif(count($condition)>0)
			{
				$sql.= ' where  '. implode('', $condition) ;
			}
		}
		
		$obj = new Bin_Query();
		if($obj->executeQuery($sql))
		{
			$output =  Display_DProductEntry::searchProducts($obj->records,'1',$this->data['paging'],$this->data['prev'],$this->data['next'],0);
		
		}
		else
		{	
		
			$output =  Display_DProductEntry::searchProducts($obj->records,'0',$this->data['paging'],$this->data['prev'],$this->data['next'],0);
			
		}
			
		return $output;
		
	}
	
	/**
	 * Function gets the attributes details from the database for the selected product 
	 *		
	 * 
	 * 
	 * @return string
	 */	
	
	
	function displayAttributes()
	{
		$id=(int)$_GET['id'];
		if(is_int($id))
		{
//			$sql = "select a.attrib_id,c.attrib_value,c.attrib_value_id,b.attrib_name from category_attrib_table a inner join attribute_table b on a.attrib_id=b.attrib_id inner join attribute_value_table c on c.attrib_id=b.attrib_id where a.subcategory_id=".$id ;
			$sql='SELECT attrib_id FROM category_attrib_table WHERE subcategory_id='.$id;
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
			
					
			return Display_DProductEntry::displayAttributes($tmp);
		}
	}

	/**
	 * Function strips out the slashes in the incoming array 
	 *		
	 * @param array $result	 
	 * 
	 * @return array
	 */	
	

	function stripSlashesForOut($result)
	{
		$arr=array();
		foreach($result as $key=>$res)
		{
			$arr[$key]=stripslashes($res);
		}
		return $arr;
	}
	
	/**
	 * Function checks wheter the cse is enabled or not 
	 *		
	 * @param array $result	 
	 * 
	 * @return array
	 */	
	
	function getChecked($result)
	{
		if ($result['cse_enabled']=='on')
			$result['cse_enabled']=' Checked=checked ';
		if ($result['is_feautured']=='on')
			$result['is_feautured']=' Checked=checked ';
		if ($result['status']=='on')
			$result['status']=' Checked=checked ';
		
		return $result;
	}

	/**
	 * Function adds a new digital product into the database
	 * 
	 * 
	 * @return string
	 */
	function insertDigitalProduct()
	{
	
		
		include('classes/Lib/ThumbImage.php');
		if($_POST['product_alias']!='')
		{
			
			$sluggable=$_POST['product_alias'];			
			
		}
		else
		{
			$sqlcheck="SELECT * FROM  products_table WHERE alias='".$_POST['product_title']."'";
			$objcheck=new Bin_Query();
			if(!$objcheck->executeQuery($sqlcheck))	
			{
				$sluggable=$_POST['product_title'];
			}
				
		}
		//convert all special charactor into hyphens and lower case
		$sluggable = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $sluggable);
		$sluggable = trim($sluggable, '-');
		if( function_exists('mb_strtolower') ) { 
			$sluggable = mb_strtolower( $sluggable );
		} else { 
			$sluggable = strtolower( $sluggable );
		}
		$sluggable = preg_replace("/[\/_|+ -]+/", '-', $sluggable);

		
// 		$category_id=(int)$_POST['selcatgory'];
// 		$sub_category_id=(int)$_POST['selsubcatgory'];
// 		$sub_under_category_id=(int)$_POST['selsubundersubcatgory'];
		$category_id = implode(",",$_POST['selcatgory']);
		$title=$_POST['product_title'];
		$description=str_replace('#','',$_POST['desc']);
		$sku=$_POST['sku'];
		$product_video=htmlentities($_POST['videotag']);
		$tag=$_POST['tag'];
		if($_POST['intro_date']!='')
		{
		$intro_date=$_POST['intro_date'];
		$intro_date=date("Y-m-d", strtotime($intro_date));
		}
		else
		{
		$intro_date= date('Y/m/d');
		}		
			
		if($_POST['is_feautured']=='on')
			$is_feautured=1;
		else
			$is_feautured=0;
			
		if($_POST['status']=='on')
			$status=1;
		else
			$status=0;	
		
		
		//$attribute=$_POST['attribute'];

		$price=(float)$_POST['price'];
		$msrp_org=(float)$_POST['msrp_org'];
		$msrp=$_POST['msrp'];
		//$quantity=$_POST['quantity'];
		//$shipping_cost=(float)$_POST['shipcost'];
		
		$soh=(int)$_POST['soh'];
		$rol=(int)$_POST['rol'];
		
		$meta_keywords=$_POST['meta_keywords'];
		$meta_desc=$_POST['meta_desc'];
		
		
		$images=$_POST['ufile'];
		
		$imgfile= $_FILES['ufile']['name'][0];
				

		
		$digitfilename=$_FILES['digitalfile']['tmp_name'];
		$digitfilepath="download/".date("YmdHis").$_FILES['digitalfile']['name'];
		
		if(move_uploaded_file($digitfilename,$digitfilepath))
		{
		   
			 $sql="insert into products_table(category_id,sku, title, description,msrp,price,cse_enabled,thumb_image, image, shipping_cost, status, tag, meta_desc, meta_keywords, intro_date, is_featured,digital,digital_product_path,alias)values('".$category_id."','".$sku."','".$title."','".addslashes(htmlentities($description))."','".$msrp_org."','".$price."',0,'".$thumb_image."','".$image."',0,'".$status."','".$tag."','".$meta_desc."','".$meta_keywords."','".$intro_date."','".$is_feautured."',1,'".$digitfilepath."','".$sluggable."')";
			
			$obj=new Bin_Query();
			
			if($obj->updateQuery($sql))
			{
		    		
				$desc = 'New Product "'.$title.'" added';
		 		$sql = "insert into user_activity_table (activity_desc,activity_type,activity_title,activity_on) values ('".$desc."',2,'New Product Added',now())";
				$useractivity = new Bin_Query();
				$useractivity->updateQuery($sql);

				$product_id=$obj->insertid;
				
				$sql="insert into  product_inventory_table(product_id, rol, soh) values('".$product_id."',0,1)";		
			    	$obj->updateQuery($sql);
				
				if(count($_FILES['ufile']['name']) > 0)
				{
					for($i=0;$i<count($_FILES['ufile']['name']);$i++)
					{
						$imgfilename= $_FILES['ufile']['name'][$i];
						
			
	
						$imagefilename = date("Y-m-d-His").$imgfilename ; // generate a new name
						
						$image="images/products/". $imagefilename; // updated into DB
						$thumb_image="images/products/thumb/".$imagefilename; // updated into DB
						$large_image="images/products/large_image/".$imagefilename; 
	
						$stpath=ROOT_FOLDER.$image;
						$imageDir=ROOT_FOLDER."images/products"; // to upload the file
						$thumbDir=ROOT_FOLDER."images/products/thumb"; //to upload the file
						$largeDir=ROOT_FOLDER."images/products/large_image";
						
						if(move_uploaded_file($_FILES["ufile"]["tmp_name"][$i],$stpath))
						{
							list($img_w,$img_h, $type, $attr) = getimagesize($stpath);
							
							
							new Lib_ThumbImage('thumb',$stpath,$thumbDir,THUMB_WIDTH,THUMB_HEIGHT);	
								
							
							new Lib_ThumbImage('thumb',$stpath,$imageDir,IMAGE1_WIDTH,IMAGE1_HEIGHT);
							new Lib_ThumbImage('thumb',$stpath,$largeDir,IMAGE2_WIDTH,IMAGE2_HEIGHT);
						
						}
						if($i==0)
						{
							$imgType='main';
							$update="UPDATE products_table set image='$image',thumb_image='$thumb_image',large_image_path='$large_image' where product_id='".$product_id."'";						
							$obj->updateQuery($update);
						}
						else
							$imgType='sub';
						if($_FILES['ufile']['name'][$i]!='')
						{
						$spl="INSERT INTO product_images_table(product_id,image_path,thumb_image_path,type,large_image_path) VALUES('".$product_id."','$image','$thumb_image','$imgType','$large_image')";
						$obj->updateQuery($spl);
						}	
					}
				}
			
				$_SESSION['update_msg']='<div class="alert alert-success">
				<button data-dismiss="alert" class="close" type="button">×</button>Product <b>'.$title.'</b> has been inserted successfully</div>';
				header('Location:?do=manageproducts');			
				exit;		
			}
		}		
		else
		 {

			@unlink(ROOT_FOLDER.$image); 
			@unlink(ROOT_FOLDER.$thumb_image);
			@unlink(ROOT_FOLDER.$large_image);	
			return '<div class="alert alert-error">
				<button data-dismiss="alert" class="close" type="button">×</button>Unable to create product</div>';	
		 }
		
	}
	/**
	 * Function adds a new gift product into the database
	 * 
	 * 
	 * @return string
	 */
	function insertGiftProduct()
	{
	
	
		include('classes/Lib/ThumbImage.php');
			if($_POST['product_alias']!='')
		{
			
			$sluggable=$_POST['product_alias'];			
			
		}
		else
		{
			$sqlcheck="SELECT * FROM products_table WHERE alias='".$_POST['product_title']."'";
			$objcheck=new Bin_Query();
			if(!$objcheck->executeQuery($sqlcheck))	
			{
				$sluggable=$_POST['product_title'];
			}
				
		}
		//convert all special charactor into hyphens and lower case
		$sluggable = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $sluggable);
		$sluggable = trim($sluggable, '-');
		if( function_exists('mb_strtolower') ) { 
			$sluggable = mb_strtolower( $sluggable );
		} else { 
			$sluggable = strtolower( $sluggable );
		}
		$sluggable = preg_replace("/[\/_|+ -]+/", '-', $sluggable);

		
// 		$category_id=(int)$_POST['selcatgory'];
// 		$sub_category_id=(int)$_POST['selsubcatgory'];
// 		$sub_under_category_id=(int)$_POST['selsubundersubcatgory'];
		$category_id = implode(",",$_POST['selcatgory']);
		$title=$_POST['product_title'];
		$description=str_replace('#','',$_POST['desc']);
		$sku=$_POST['sku'];
		$product_video=htmlentities($_POST['videotag']);
		$tag=$_POST['tag'];
		if($_POST['intro_date']!='')
		{
		$intro_date=$_POST['intro_date'];
		$intro_date=date("Y-m-d", strtotime($intro_date));
		}
		else
		{
		$intro_date= date('Y/m/d');
		}	
			
			
		if($_POST['is_feautured']=='on')
			$is_feautured=1;
		else
			$is_feautured=0;
			
		if($_POST['status']=='on')
			$status=1;
		else
			$status=0;	
		
		
		//$attribute=$_POST['attribute'];

		$price=(float)$_POST['price'];
		$msrp_org=(float)$_POST['msrp_org'];
		$msrp=$_POST['msrp'];
		//$quantity=$_POST['quantity'];
		//$shipping_cost=(float)$_POST['shipcost'];
		
		$soh=(int)$_POST['soh'];
		$rol=(int)$_POST['rol'];
		
		$meta_keywords=$_POST['meta_keywords'];
		$meta_desc=$_POST['meta_desc'];
		
		
		$images=$_POST['ufile'];
		
		$imgfile= $_FILES['ufile']['name'][0];

			 $sql="insert into products_table(category_id,sku, title, description,msrp,price,cse_enabled,thumb_image, image, shipping_cost, status, tag, meta_desc, meta_keywords, intro_date, is_featured,gift,alias)values('".$category_id."','".$sku."','".$title."','".addslashes(htmlentities($description))."','".$msrp_org."','".$price."',0,'".$thumb_image."','".$image."',0,'".$status."','".$tag."','".$meta_desc."','".$meta_keywords."','".$intro_date."','".$is_feautured."',1,'".$sluggable."')";
			
			$obj=new Bin_Query();
			
			if($obj->updateQuery($sql))
			{
		    		
				$desc = 'New Product "'.$title.'" added';
		 		$sql = "insert into user_activity_table (activity_desc,activity_type,activity_title,activity_on) values ('".$desc."',2,'New Product Added',now())";
				$useractivity = new Bin_Query();
				$useractivity->updateQuery($sql);

				$product_id=$obj->insertid;
				
				$sql="insert into product_inventory_table(product_id, rol, soh) values('".$product_id."',0,1)";		
			    	$obj->updateQuery($sql);
				
				if(count($_FILES['ufile']['name']) > 0)
				{
					for($i=0;$i<count($_FILES['ufile']['name']);$i++)
					{
						$imgfilename= $_FILES['ufile']['name'][$i];
						
			
	
						$imagefilename = date("Y-m-d-His").$imgfilename ; // generate a new name
						
						$image="images/products/". $imagefilename; // updated into DB
						$thumb_image="images/products/thumb/".$imagefilename; // updated into DB
						$large_image="images/products/large_image/".$imagefilename; 
	
						$stpath=ROOT_FOLDER.$image;
						$imageDir=ROOT_FOLDER."images/products"; // to upload the file
						$thumbDir=ROOT_FOLDER."images/products/thumb"; //to upload the file
						$largeDir=ROOT_FOLDER."images/products/large_image";
						
						if(move_uploaded_file($_FILES["ufile"]["tmp_name"][$i],$stpath))
						{
							list($img_w,$img_h, $type, $attr) = getimagesize($stpath);
							
							new Lib_ThumbImage('thumb',$stpath,$thumbDir,THUMB_WIDTH,THUMB_HEIGHT);	
								
							
							new Lib_ThumbImage('thumb',$stpath,$imageDir,IMAGE1_WIDTH,IMAGE1_HEIGHT);
							new Lib_ThumbImage('thumb',$stpath,$largeDir,IMAGE2_WIDTH,IMAGE2_HEIGHT);
						
						}
						if($i==0)
						{
							$imgType='main';
							$update="UPDATE products_table set image='$image',thumb_image='$thumb_image',large_image_path='$large_image' where product_id='".$product_id."'";						
							$obj->updateQuery($update);
						}
						else
							$imgType='sub';
						if($_FILES['ufile']['name'][$i]!='')
						{
						$spl="INSERT INTO product_images_table(product_id,image_path,thumb_image_path,type,large_image_path) VALUES('".$product_id."','$image','$thumb_image','$imgType','$large_image')";
						$obj->updateQuery($spl);
						}
					}
				}
			
				$_SESSION['update_msg']='<div class="alert alert-success">
				<button data-dismiss="alert" class="close" type="button">×</button>Product <b>'.$title.'</b> has been inserted successfully</div>';
				header('Location:?do=manageproducts');			
				exit;		
		}
		else
		{

		@unlink(ROOT_FOLDER.$image); 
		@unlink(ROOT_FOLDER.$thumb_image);
		@unlink(ROOT_FOLDER.$large_image);	
		return '<div class="alert alert-error">
			<button data-dismiss="alert" class="close" type="button">×</button>Unable to create product</div>';	
		}
			
		
	}

	/**
	 * Function is used to check the alias in database
	 * 
	 * 
	 * @return string
	 */	

	function checkProductAlias()
	{

		//convert all special charactor into hyphens and lower case
		$sluggable=$_GET['alias'];
		
		$sluggable = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $sluggable);
		$sluggable = trim($sluggable, '-');
		if( function_exists('mb_strtolower') ) { 
			$sluggable = mb_strtolower( $sluggable );
		} else { 
			$sluggable = strtolower( $sluggable );
		}
		$sluggable = preg_replace("/[\/_|+ -]+/", '-', $sluggable);

		$sql="SELECT * FROM products_table WHERE alias='".$sluggable."'";
		$obj=new Bin_Query();
		if($obj->executeQuery($sql))
		{
			return '1';
		}
		else
		{
			return '0';
		}
	}
	/**
	 * Function is used to check the sku in database
	 * 
	 * 
	 * @return string
	 */	

	function checkProductSku()
	{
	
		$sql="SELECT * FROM products_table WHERE sku='".trim($_GET['sku'])."'";
		$obj=new Bin_Query();
		if($obj->executeQuery($sql))
		{
			return '1';
		}
		else
		{
			return '0';
		}
	}
}
?>
