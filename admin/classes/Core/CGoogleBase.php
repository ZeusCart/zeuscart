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
 * This class contains functions to generate a excel product report for google base
 *
 * @package  		Core_CGoogleBase
 * @category  		Core
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
   * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */



class Core_CGoogleBase
{
	
	
	/**
	 * Function generates a excel product report for google base
	 * 
	 * 
	 * @return file
	 */	
	
	function googleProduct()
	{
		include("classes/Lib/excelwriter.inc.php");   
		$excel=new ExcelWriter("GoogleBase_Product_Feed.xls");
		
		if($excel==false)	
		echo $excel->error;
		$myArr=array("Product Id","Product Title","Description","Product Price","Link","Brand","Image Link","Weight");
		$excel->writeLine($myArr);
		$sql ='select product_id,title,description,price,brand,thumb_image,weight from products_table';
		$obj = new Bin_Query();
		if($obj->executeQuery($sql))
		{
			$cnt=count($obj->records);
			for($i=0;$i<$cnt;$i++)
			{
				$product_id = $obj->records[$i]['product_id'];
				$title = $obj->records[$i]['title'];
				$description = strip_tags($obj->records[$i]['description']);
				$price = $obj->records[$i]['price'];
				$brand =  $obj->records[$i]['brand'];
				$thumb_image =$obj->records[$i]['thumb_image'];
				$image_link = $_SERVER['SERVER_NAME'].'/'.$thumb_image;
				$weight =  $obj->records[$i]['weight'];
				$link = $_SERVER['SERVER_NAME'].'/?do=prodetail&action=showprod&id='.$product_id;
				$excel->writeRow();
				$excel->writeCol($product_id);
				$excel->writeCol($title );
				$excel->writeCol($description);
				$excel->writeCol($price);
				$excel->writeCol($link);
				$excel->writeCol($brand);
				$excel->writeCol($image_link);
				$excel->writeCol($weight);
			}
			$excel->close();
		}
		if(strpos($_SERVER['USER'],'MSIE'))
		{
			// IE cannot download from sessions without a cache
			header('Cache-Control: public');
		}
		else
		{
			//header("Cache-Control: no-cache, must-revalidate");
			header("Cache-Control: no-cache");
		}
		$file="GoogleBase_Product_Feed.xls";
		//chmod ($file, 0755);
		header("Pragma: no-cache");
		header("Content-Type: php/doc/xml/html/htm/asp/jpg/JPG/sql/txt/jpeg/gif/bmp/png/xls/csv/x-ms-asf\n");
		header("Connection: close");
		header("Content-Disposition: attachment; filename=".$file."\n");
		header("Content-Transfer-Encoding: binary\n");
		header("Content-length: ".(string)(filesize("$file")));
		$fd=fopen($file,"rb");
		fpassthru($fd);
		
	}
	
}
?>