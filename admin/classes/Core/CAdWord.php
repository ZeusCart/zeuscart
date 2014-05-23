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
 *This class contains functions to create a TSV product report for google AdWord.
 *
 * @package  		Core_CAdWord
 * @category  		Core
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
   * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */



class Core_CAdWord 
{
	/**
	 * Stores the output
	 *
	 * @var array $output
	 */		
	var $output = array();	
	
	/**
	 * Stores the records 
	 *
	 * @var array $arr
	 */		
	
	var $arr = array();	
	
	
	/**
	 * Function generates a product report for google Adword. 
	 * 
	 * 
	 * @return file
	 */
	function googleProduct()
	{
		if(strpos($_SERVER['USER'],'MSIE')){
		// IE cannot download from sessions without a cache
		header('Cache-Control: public');
		}else
		{
		//header("Cache-Control: no-cache, must-revalidate");
		header("Cache-Control: no-cache");
		}

		$file="adWords.tsv";
		
		$this->createCategoryTSVFile($file);

		header("Pragma: no-cache");
		header("Content-Type: php/doc/xml/html/htm/asp/jpg/JPG/sql/txt/jpeg/gif/bmp/png/xls/csv/tsv/x-ms-asf\n");
		header("Connection: close");
		header("Content-Disposition: attachment; filename=adWord.tsv\n");
		header("Content-Transfer-Encoding: binary\n");
		header("Content-length: ".(string)(filesize("$file")));
		$fd=fopen($file,"rb");
		fpassthru($fd);
		exit();
	}
	
	
	/**
	 * Function generates a file with category details .
	 * 
	 * @param string $targetpath
	 * @return file
	 */

	
	function createCategoryTSVFile($targetpath)
	{
		$sql="SELECT title,description,concat('?do=prodetail&action=showprod&prodid=',product_id)as destn FROM `products_table` order by product_id";
		$obj=new Bin_Query();
		$obj->executeQuery($sql);
		
		$arr=$obj->records;
		
		$str="Campaign\tAd Group\tHeadline\tDescription Line 1\tDescription Line 2\tDisplay URL\tDestination URL\tCampaign Status\tAdGroup Status\tCreative Status";
		$fp=fopen($targetpath,'w');	
		for($i=0;$i<count($arr);$i++)
		{
			$campaign="\nCampaign #1";
			$addGroup="\tAd Group #1";
			$headline="\t".$arr[$i]['title'];
			$Desc1="\t".substr(str_replace("\r\n","",strip_tags($arr[$i]['description'])),0,24);
			$Desc2="\t".substr(str_replace("\r\n","",strip_tags($arr[$i]['description'])),25,50);
			$DispURL="\t".$_SERVER['SERVER_NAME'];
			$DestURL="\t".$_SERVER['SERVER_NAME'].'/'.$arr[$i]['destn'];
			$CampStat="\tActive";
			$AdGroupStat="\tActive";
			$CreativeStat="\tActive";
			
			$str.=$campaign.$addGroup.$headline.$Desc1.$Desc2.$DispURL.$DestURL.$CampStat.$AdGroupStat.$CreativeStat;
		}
		fwrite($fp,$str);
		fclose($fp);
		print_r($str);
		//exit();
	}	
}
?>