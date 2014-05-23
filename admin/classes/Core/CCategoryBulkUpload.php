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
 * This class contains functions that generates a sample TSV file and exports the categories into the table from a excel file. 
 *
 * @package  		Core_CCategoryBulkUpload
 * @category  		Core
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
   * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */


class Core_CCategoryBulkUpload
{
	
	/**
	 * Function uploads the supplied tsv file into the table
	 * 
	 * 
	 * @return string
	 */
	function uploadTSVFile()
	{ 
		 
		  

		  $tsvfilename= $_FILES['category_file']['tmp_name'];			       
		   
		  $legal_extentions = array("tsv");  



		  $file_ext = strtolower(end(explode(".",$_FILES['category_file']['name']))); 
		   

		  if (!in_array ($file_ext, $legal_extentions))
		  {


   			return '<div class="alert alert-error">
             		 <button type="button" class="close" data-dismiss="alert">×</button> The file you are attempting to upload is not supported by this server</div>';		
          	  }			   
			

		  $file = explode(".",$_FILES['category_file']['name']);	

		  if(count($file) > 2  || $file[1] != 'tsv')
		  {			
  			return '<div class="alert alert-error">
             		 <button type="button" class="close" data-dismiss="alert">×</button> The file you are attempting to 		upload is not supported by this server</div>';		
		  }	 	
				

		  
		   if(file_exists($tsvfilename)>0)
		   {
				  // $stpath="uploadedtsvfile/".date("YmdHis").$tsvfilename;
				   $stpath="uploadedtsvfile/".date("YmdHis")."category.tsv";
				   				  
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
					
							
							$chkfieldsarr=array('category_name','description','type','category_parent_id');
						
							
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
																
									$check = new Core_CCategoryBulkUpload();
									$check->checkCatExists($pro[0],$pro[3]);
									if($check->checkCatExists($pro[0],$pro[3]))
									{
									return '<div class="alert alert-error">
              <button type="button" class="close" data-dismiss="alert">×</button> '. $pro[0]. ' Category Name Already Exists </div>';
									}
									if($pro[3]!=0 && $pro[2]!='parent')
									{
									$dflt=new Core_CCategoryBulkUpload();
									$dflt->checkIsParentCategory($pro[3]);
									if ($dflt->checkIsParentCategory($pro[3]))
									{
										$pro="'". implode("','",array_splice($pro,0,4))."'";																																		
										$pro=str_replace("child","1",$pro);
										$sql=' INSERT INTO category_table(category_name, category_desc, 
										category_status,category_parent_id) VALUES  ('.$pro.')';												
											$obj=new Bin_Query();																				
											if($obj->updateQuery($sql))
											$pro_cnt++;				
											else
											$fail_cnt++;	
									}
									else
									$fail_cnt++;													
									}
									else
									{
									$pro="'". implode("','",array_splice($pro,0,3))."'";
									$pro = str_replace("parent","0",$pro);																		
									$sql='INSERT INTO category_table(category_name,category_desc, 
									category_parent_id,category_status) VALUES  ('.$pro.',1)';	
									$obj=new Bin_Query();
												if($obj->updateQuery($sql))
												$pro_cnt++;				
												else
												$fail_cnt++;														
									}							
									
									//exit();
									/*if ($dflt->checkIsParentCategory($pro[3]))
									{
										$pro="'". implode("','",array_splice($pro,0,16))."'";										
										$inv=implode(",",array_splice($inv,16,2));									
										$sql=' INSERT INTO products_table( category_id, title, description, sku, brand, model, msrp, price, weight, dimension, shipping_cost, status , tag, meta_desc, meta_keywords, is_featured ) VALUES  ('.$pro.')';				 										$obj=new Bin_Query();										
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
*/
								}
								return '<div class="alert alert-success">
              <button type="button" class="close" data-dismiss="alert">×</button> '. $pro_cnt . ' Categories Created Successfullly . '.$fail_cnt .' Categories Not Created </div>';
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
	 * Function generates a sample zip file for the easy user interface
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
		$file = "uploadedtsvfile/category_format_file.zip";
		if ($zip->open($file, ZIPARCHIVE::CREATE)!==TRUE) 
		{
  			exit("cannot open <$file>\n");
		}
		$zip->addFile('uploadedtsvfile/upload_bulk_category/category.tsv', 'sample-bulk-upload/category.tsv');
		$zip->addFile('uploadedtsvfile/upload_bulk_category/categorydetails.tsv', 'sample-bulk-upload/categorydetails.tsv');
		$zip->addFile('uploadedtsvfile/upload_bulk_category/readme-category.txt', 'sample-bulk-upload/readme-category.txt');		
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
	 * Function generates a sample tsv file for the easy user interface
	 * 
	 * 
	 * @return string
	 */
	
	function createCategoryTSVFile()
	{
		$sql="SELECT category_name as parentcatname, category_id FROM category_table WHERE category_parent_id = 0 ORDER BY parentcatname";
		$obj=new Bin_Query();
		$obj->executeQuery($sql);
				
		$arr=$obj->records;
				
		$targetpath='uploadedtsvfile/upload_bulk_category/categorydetails.tsv';

		$str="Main Category\tCategory ID";
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
	 * Function checks whether a parent category exists in the uploaded tsv file
	 * 
	 * @param integer $categoryid
	 * @return bool
	 */
	
	function checkIsParentCategory($categoryid=0)
	{
		$sql="SELECT COUNT(*) AS cnt FROM category_table where category_id = '".$categoryid."' AND category_parent_id = 0";
		$obj=new Bin_Query();
		$obj->executeQuery($sql);
		$obj->records[0]['cnt']; 
		if($obj->records[0]['cnt']>0)
			return true;
		else
			return false;
		
	}
	
	/**
	 * Function checks whether a category exists in the uploaded tsv file
	 * @param string $categoryname
	 * @param integer $id
	 * @return bool
	 */
	
	function checkCatExists($categoryname='',$id=0)
	{
		if($id==0)
		{
		$sql="SELECT COUNT(*) AS cnt FROM category_table where category_name = '".trim(strtolower($categoryname))."' AND category_parent_id = 0";
		}
		else
		{
		$sql="SELECT COUNT(*) AS cnt FROM category_table where category_name = '".trim(strtolower($categoryname))."'";
		}
		
		$obj=new Bin_Query();
		$obj->executeQuery($sql);
		//$obj->records[0]['cnt']; 
		if($obj->records[0]['cnt']>0)
			return true;
		else
			return false;
	}
	
	
}
?>