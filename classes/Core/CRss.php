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
 * Rich Site Summary  related  class
 *
 * @package   		Core_CRss
 * @category    	Core
 * @author    		AJ Square Inc Dev Team
 * @link   		http://www.zeuscart.com
  * @copyright 	        Copyright (c) 2008 - 2013, AJ Square, Inc.
 * @version   		Version 4.0
 */
class Core_CRss
{
	/**
	* This function is used to get the  rss
	*
	* .
	* 
	* @return XML data
	*/
	function showRss()
	{
		$sql= " SELECT a.product_id, a.title,a.description, a.thumb_image, a.msrp, a.intro_date,b.soh,sum(c.rating)/count(c.user_id) as
			rating	FROM products_table a INNER JOIN	product_inventory_table b ON a.product_id=b.product_id  left join product_reviews_table c on a.product_id=c.product_id WHERE datediff( CURDATE( ) , a.intro_date ) <=100 group by a.product_id order by a.intro_date desc";
		$query = new Bin_Query();
		$query->executeQuery($sql);
		return Core_CRss::writeXML($query->records);
	}
	/**
	* This function is used to get the  rss in xml 
	* @param array $result
	* .
	* 
	* @return XML data
	*/
	function writeXML($result)
	{
		date_default_timezone_set('GMT');
		$now = date("D, d M Y H:i:s T");
		$output = "<?xml version=\"1.0\"?>
					<rss version=\"2.0\">
						<channel>
			 	<title>Zeuscart V4 New Products</title>
				<link>http://www.zeuscart.com/</link>
				<description>Simple Online shopping</description>
				<language>en-us</language>
				<pubDate>".date("D, d M Y h:i:s T")."</pubDate>";

		$i=strpos($_SERVER['HTTP_REFERER'],'?');
		$url=substr($_SERVER['HTTP_REFERER'],0,$i);			

		foreach ($result as $line)
		{
			
			$link=$url.'?do=prodetail&action=showprod&prodid='.$line['product_id'];
			
			$output .= "<item><title>".htmlentities($line['title'])."</title>
							<link>".htmlentities($link)."</link>

		<description>".substr(htmlentities(strip_tags($line['description'])),0,500)."...</description>
						</item>";
		}
		$output .= "</channel></rss>";
		
		
		$fname='New Products.xml';
		
		return $output;
	}
}
?>
