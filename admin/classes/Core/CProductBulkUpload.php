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
 * This class contains functions to update the products in an bulk manner into the database
 *
 * @package  		Core_CProductBulkUpload
 * @category  		Core
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
   * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */



class Core_CProductBulkUpload
{
	
	
	/**
	 * Function uploads a tsv file into the database.
	 * 
	 * 
	 * @return string
	 */
	
	
	function uploadTSVFile()
	{
		
		 
		  //$tsvfilename= $_FILES['product_file']['name'];
		  $tsvfilename= $_FILES['product_file']['tmp_name'];
		  $legal_extentions = array("tsv");  
		  $file = explode(".",$_FILES['product_file']['name']);	
		  if(count($file) > 2  || $file[1] != 'tsv')
		  {			
  			return '<div class="alert alert-error">
              <button type="button" class="close" data-dismiss="alert">×</button> The file you are attempting to upload is not supported by this server</div>';		
		  }	 	
			
		  $file_ext = strtolower(end(explode(".",$_FILES['product_file']['name'])));	
		  if (!in_array ($file_ext, $legal_extentions))
		  {
  		  return '<div class="alert alert-error">
              <button type="button" class="close" data-dismiss="alert">×</button> The file you are attempting to upload is not supported by this server</div>';		
          	  }		  		
	  
		   if(file_exists($tsvfilename)>0)
		   {
				  // $stpath="uploadedtsvfile/".date("YmdHis").$tsvfilename;
				   $stpath="uploadedtsvfile/".date("YmdHis")."product.tsv";
				   
				   if(move_uploaded_file($tsvfilename,$stpath))
				   {
						$targetpath=$stpath;
						if(file_exists($targetpath))
						{
							$fp=fopen($targetpath,'r');	
							$records=array();

							$rowfirst=fgets($fp);
							
							$rowfirst=str_replace("\n","",$rowfirst);
							$tmpfirst=explode("\t",trim($rowfirst));
							
							$chkfieldsarr=array('category_id','title','description','sku','brand','model','msrp','price',				
												'weight','dimension','shipping_cost','status','tag','meta_desc', 
												'meta_keywords'	, 'is_featured','soh','rol');
															
							$cmp_arr=array_diff($tmpfirst,$chkfieldsarr);
								
							if(empty($cmp_arr))
							{
								$pro_fields= implode(',',$chkfieldsarr);
								$pro_cnt=0;
								$fail_cnt=0;
								while($row=fgets($fp))
								{
								
									$row=str_replace("\n"," ",$row); 
									$pro=$inv=explode("\t",addslashes(trim($row)));
									
									
									$dflt=new Core_CProductBulkUpload();
									$dflt->checkIsParentCategory($pro[0]);
							
									if ($dflt->checkIsParentCategory($pro[0]))
									{
										$pro="'". implode("','",array_splice($pro,0,16))."'";
										$inv=implode(",",array_splice($inv,16,2));
									
										$sql=' INSERT INTO products_table( category_id, title, description, sku, brand, model, msrp, price, weight, dimension, shipping_cost, status , tag, meta_desc, meta_keywords, is_featured ) VALUES  ('.$pro.')';				 
										$obj=new Bin_Query();
										
										if($obj->updateQuery($sql))
										{
											$sql=' INSERT INTO product_inventory_table( product_id, soh, rol )
	VALUES  ('.$obj->insertid.',' .$inv.')';		
											if($obj->updateQuery($sql))
												$pro_cnt++;				
											else
												$fail_cnt++;						
										}	
										else
											$fail_cnt++;
									}
									else
										$fail_cnt++;

								}
								return '<div class="alert alert-success">
              <button type="button" class="close" data-dismiss="alert">×</button> '. $pro_cnt . ' Product(s) Created Successfullly . '.$fail_cnt .' Product(s) Not Created </div>';
							}
							else
								return '<div class="alert alert-error">
              <button type="button" class="close" data-dismiss="alert">×</button> Please Check The Format Of TSV File  </div>';
							
							fclose($fp);
		
						}
						else
							return '<div class="alert alert-error">
              <button type="button" class="close" data-dismiss="alert">×</button> Error Uploading File</div>';	
							
				   }
				   else
						   return '<div class="alert alert-error">
              <button type="button" class="close" data-dismiss="alert">×</button> TSV File is not created </div>';	
				 
			}
	}
	
	
	/**
	 * Function generates a zip file 
	 * 
	 * 
	 * @return file
	 */
	
	
	function downloadTSVSample()
	{
		if(strpos($_SERVER['USER'],'MSIE')){
		// IE cannot download from sessions without a cache
		header('Cache-Control: public');
		}else
		{
		//header("Cache-Control: no-cache, must-revalidate");
		header("Cache-Control: no-cache");
		}
		$this->createCategoryTSVFile();
		
		/*copy('uploadedtsvfile/product.tsv','uploadedtsvfile/upload_bulk_products/product.tsv');
		copy('uploadedtsvfile/categoryids.tsv','uploadedtsvfile/upload_bulk_products/categoryids.tsv');*/
		
		$zip = new ZipArchive();
		$file = "uploadedtsvfile/products_format_file.zip";
		if ($zip->open($file, ZIPARCHIVE::CREATE)!==TRUE) 
		{
  			exit("cannot open <$file>\n");
		}
		$zip->addFile('uploadedtsvfile/product.tsv', 'product.tsv');
		$zip->addFile('uploadedtsvfile/categoryids.tsv', 'categoryids.tsv');
		$zip->close();

		//exit();
		//chmod ($file, 0755);
		
			header("Pragma: no-cache");
			header("Content-Type: php/doc/xml/html/htm/asp/jpg/JPG/sql/txt/jpeg/gif/bmp/png/xls/csv/tsv/x-ms-asf\n");
			header("Connection: close");
			header("Content-Disposition: attachment; filename=".$file."\n");
			header("Content-Transfer-Encoding: binary\n");
			header("Content-length: ".(string)(filesize("$file")));
			$fd=fopen($file,"rb");
			fpassthru($fd);
		
	}
	
	
	
	/**
	 * Function generates a tsv file with category details.
	 * 
	 * 
	 * @return string
	 */
	
	
	function createCategoryTSVFile()
	{
		$sql="SELECT  b.category_name as parentcatname , a.category_name as subcatname, a.category_id FROM category_table a,category_table b  WHERE a.category_parent_id <> 0 AND a.category_parent_id=b.category_id ORDER BY parentcatname";
		$obj=new Bin_Query();
		$obj->executeQuery($sql);
		
		$arr=$obj->records;
		
		$targetpath='uploadedtsvfile/categoryids.tsv';

		$str="Main Category\tSub Category\tSub Category ID";
		$fp=fopen($targetpath,'w');	
		foreach($arr as $res)
		{
			$str.="\n".implode("\t",$res);
		}
		fwrite($fp,$str);
		fclose($fp);
		return $targetpath;
	}
	
	/**
	 * Function uploads the images in an bulk manner into the database
	 * 
	 * 
	 * @return string
	 */
	
	
	function productImagesBulkUpload()
	{
		
		 

		 $tsvfilename= $_FILES['image_file']['name'];
		  $legal_extentions = array("tsv");  
		  $file = explode(".",$_FILES['image_file']['name']);	
		  if(count($file) > 2  || $file[1] != 'tsv')
		  {			
  			return '<div class="alert alert-error">
              <button type="button" class="close" data-dismiss="alert">×</button> The file you are attempting to upload is not supported by this server</div>';		
		  }	 	
			
		  $file_ext = strtolower(end(explode(".",$_FILES['image_file']['name'])));	
		  if (!in_array ($file_ext, $legal_extentions))
		  {
  		  return '<div class="alert alert-error">
              <button type="button" class="close" data-dismiss="alert">×</button> The file you are attempting to upload is not supported by this server</div>';		
          	  }		  	


		   if(file_exists($tsvfilename)>0 && $_FILES['image_file']['type']!='application/octet-stream')
		   {
				  // $stpath="uploadedtsvfile/".date("YmdHis").$tsvfilename;
				   $stpath="uploadedtsvfile/".date("YmdHis")."images.tsv";
				   
				   if(move_uploaded_file($tsvfilename,$stpath))
				   {
						$targetpath=$stpath;
						if(file_exists($targetpath))
						{
							$fp=fopen($targetpath,'r');	
							$records=array();

							$rowfirst=fgets($fp);
							
							$rowfirst=str_replace("\n","",$rowfirst);
							$tmpfirst=explode("\t",trim($rowfirst));
							
							$chkfieldsarr=array('product_id','image_path','image_type');
						
								
							$cmp_arr=array_diff($tmpfirst,$chkfieldsarr);
						
							if(empty($cmp_arr)&&(count($tmpfirst)==count($chkfieldsarr) ))
							{
								$pro_fields= implode(',',$chkfieldsarr);
								$pro_cnt=0;
								$fail_cnt=0;
								while($row=fgets($fp))
								{
									
									$row=str_replace("\n"," ",$row); 
									$imgs=$pro=$inv=explode("\t",addslashes(trim($row)));
									//print_r($pro);
									$pro="'". implode("','",array_splice($pro,0,16))."'";
									$inv=implode(",",array_splice($inv,16,2));
								
									
									//-------------------Upload File------------
									//$fname='uploadedbulkimages/'.$imgs[1];
									$fname='../'.$imgs[1];
									$fname=str_replace("\\","/",$fname);
									$fnamearr=explode("/",$fname);
									//echo $fnamearr[count($fnamearr)-1];
									//exit();
									//echo '<img src="'.$fname.'">';
									//exit();
									//copy('uploadedbulkimages/1.jpg','../images/products/uploadedbulkimages200811141305261.jpg') or die("ee");
									file_exists($fname);
									if(file_exists($fname))
									{
										
											//$imgfilename= $imgs[1];
											$imgfilename= $fnamearr[count($fnamearr)-1];
											$thumb_image="images/products/thumb/". date("Y-m-d-His").$imgfilename;
											$image="images/products/". date("Y-m-d-His").$imgfilename;
											//$stpath=ROOT_FOLDER.$image;
											$stpath=$imgfilename;
											if(copy($fname,$stpath))
											{
												new Lib_ThumbImage('thumb',$stpath,ROOT_FOLDER.$thumb_image,THUMB_WIDTH);
												new Lib_ThumbImage('thumb',$stpath,ROOT_FOLDER.$image,IMAGE1_WIDTH);				
											}
											$obj=new Bin_Query();
											if($imgs[2]=='main')
											{
												$spl="INSERT INTO product_images_table(product_id,image_path,thumb_image_path,type) VALUES('".(int)$imgs[0]."','$image','$thumb_image','main')";
												$update="UPDATE products_table set image='$image',thumb_image='$thumb_image' where product_id='".(int)$imgs[0]."'";
												
												$obj->updateQuery($update);
											}
											else
											{
												$spl="INSERT INTO product_images_table(product_id,image_path,thumb_image_path,type) VALUES('".(int)$imgs[0]."','$image','$thumb_image','sub')";				
											}
											
											if($obj->updateQuery($spl))
												$pro_cnt++;				
											else
												$fail_cnt++;	
										
									}
									else
										$fail_cnt++;
									//-------------------Upload File------------
									
																		

								}
								return '<div class="alert alert-success">
              <button type="button" class="close" data-dismiss="alert">×</button> '. $pro_cnt . ' Images(s) Uploaded Successfullly . '.$fail_cnt .' Images(s) Not Uploaded </div>';
							}
							else
								return '<div class="alert alert-error">
              <button type="button" class="close" data-dismiss="alert">×</button> Please Check The Format Of TSV File  </div>';
							
							fclose($fp);
		
						}
						else
							return '<div class="alert alert-error">
              <button type="button" class="close" data-dismiss="alert">×</button> Error Uploading File</div>';	
							
				   }
				   else
						   return '<div class="alert alert-error">
              <button type="button" class="close" data-dismiss="alert">×</button> TSV File is not created </div>';	
				 
			}
			else
				return '<div class="alert alert-error">
              <button type="button" class="close" data-dismiss="alert">×</button> Only TSV File Can Be Uploaded </div>';	
		
	}
	
	
	/**
	 * Function generates a sample zip file for image uploading 
	 * 
	 * 
	 * @return file
	 */
	 
	function downloadProductImageTSVSample()
	{
		if(strpos($_SERVER['USER'],'MSIE')){
		// IE cannot download from sessions without a cache
		header('Cache-Control: public');
		}else
		{
		//header("Cache-Control: no-cache, must-revalidate");
		header("Cache-Control: no-cache");
		}
		$this->createProductTSVFile();
		
		/*copy('uploadedtsvfile/product.tsv','uploadedtsvfile/upload_bulk_products/product.tsv');
		copy('uploadedtsvfile/categoryids.tsv','uploadedtsvfile/upload_bulk_products/categoryids.tsv');*/
		
		$zip = new ZipArchive();
		$file = "uploadedtsvfile/images_format_file.zip";
		if ($zip->open($file, ZIPARCHIVE::CREATE)!==TRUE) 
		{
  			exit("cannot open <$file>\n");
		}
		$zip->addFile('uploadedtsvfile/image.tsv', 'image.tsv');
		$zip->addFile('uploadedtsvfile/productids.tsv', 'productids.tsv');
		$zip->close();

		//exit();
		//chmod ($file, 0755);
		
			header("Pragma: no-cache");
			header("Content-Type: php/doc/xml/html/htm/asp/jpg/JPG/sql/txt/jpeg/gif/bmp/png/xls/csv/tsv/x-ms-asf\n");
			header("Connection: close");
			header("Content-Disposition: attachment; filename=".$file."\n");
			header("Content-Transfer-Encoding: binary\n");
			header("Content-length: ".(string)(filesize("$file")));
			$fd=fopen($file,"rb");
			fpassthru($fd);
		
	}
	
	/**
	 * Function generates a tsv file with the product details
	 * 
	 * 
	 * @return string
	 */
	
	function createProductTSVFile()
	{
		//$sql="SELECT a.product_id,a.category_id,a.title,a.description,a.brand,a.sku, a.msrp, a.intro_date,a.is_featured,c.category_name as parentcatname , b.category_name as subcatname, b.category_id from products_table a,category_table b where a.category_id=b.category_id ";
		
		$sql="SELECT a.product_id, a.title, a.brand,c.category_name AS catname,b.category_name AS subcatname, a.intro_date, a.msrp, a.is_featured  FROM products_table a, category_table b LEFT JOIN category_table c ON b.category_parent_id <>0 AND c.category_id = b.category_parent_id WHERE a.category_id = b.category_id";
		
		$obj=new Bin_Query();
		$obj->executeQuery($sql);
		
		$arr=$obj->records;
		
		$targetpath='uploadedtsvfile/productids.tsv';

		$str="Product Id\tTitle\tBrand\tCategory\tSubcategory\tIntrodate\tMSRP\tFeaturedItem Flag";
		$fp=fopen($targetpath,'w');	
		foreach($arr as $res)
		{
			$str.="\n".implode("\t",$res);
		}
		fwrite($fp,$str);
		fclose($fp);
		return $targetpath;
	}
	
	
	/**
	 * Function checks whether the parent category exists
	 * @param integer $categoryid
	 * 
	 * @return bool
	 */
	
	function checkIsParentCategory($categoryid=0)
	{
		$sql="SELECT COUNT(*) AS cnt FROM category_table where category_id = '".$categoryid."' AND category_parent_id <> 0";
		$obj=new Bin_Query();
		$obj->executeQuery($sql);
		
		if($obj->records[0]['cnt']>0)
			return true;
		else
			return false;
		
	}
}
?>