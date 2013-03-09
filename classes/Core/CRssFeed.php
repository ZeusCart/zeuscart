<?php
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
class Core_CRssFeed
{
	var $output = array();
	
	function showRssFeed()
	{
			$sqlselect = "SELECT title, description, brand, price, thumb_image FROM products_table WHERE status=1 ORDER BY (product_id) DESC ";
			$sitename = "Zeus Cart";
			$sitepath = "http://www.zeuscart.com";
			$now = date("D, d M Y H:i:s");
			$obj = new Bin_Query();
			
			if($obj->executeQuery($sqlselect))
			{
				//$fp=fopen("rssfeed/rss.xml","w") ;
				$op ="<?xml version='1.0' encoding='utf-8'?>\n";
				$op.="<rss version='2.0'>\n<channel>\n";
				$op.="<title>Welcome to ".$sitename."</title>\n";
				$op.="<link>$sitepath"."/index.php</link>\n";
				$op.="<description>New Products</description>\n";
				$op.="<language>en-us</language>\n";
				$op .="<copyright>Copyright 2002, Spartanburg Herald-Journal</copyright>";
				$op .="<managingEditor>geo@herald.com</managingEditor>";
				$op .="<webMaster>betty@herald.com</webMaster>";
				$op .= "<docs>http://blogs.law.harvard.edu/tech/rss</docs>";

				//$op.="<pubDate>$now</pubDate>\n";
				//$op.="<lastBuildDate>$now</lastBuildDate>\n";
				$count=count($obj->records);
				for($i=0;$i<$count;$i++)
				{
					$title = $obj->records[$i]['title'];
					$description =  $obj->records[$i]['description'];
					$brand = $obj->records[$i]['brand'];
					$price = $obj->records[$i]['price'];
					$image = $obj->records[$i]['thumb_image'];
					 		
					$op.="<item>\n<title>".htmlentities($title)."</title>\n";
					$op.="<description>".htmlentities(strip_tags($description))."</description>\n";
					$op.="<link>http://www.goupstate.com/</link></item>\n";
					
				}
				$op.="</channel>\n</rss>";
				header ("content-type: text/xml");
				echo $op;
				exit;
			}
			else
			{
				$output = "No Record Found";
				return $output;
			}
			
		
   }
   
   function showCategoryRssFeed()
	{
		//print_r($_POST['selcat']);exit;
			//$categoryid = $_POST['selcat'];
			$sqlselect = "SELECT title, description, brand, price, thumb_image FROM products_table where category_id=5 ORDER BY (product_id) DESC";
			$sitename = "Zeus Cart";
			$sitepath = "http://www.zeuscart.com";
			$now = date("D, d M Y H:i:s");
			$obj = new Bin_Query();
			
			if($obj->executeQuery($sqlselect))
			{
				//$fp=fopen("rssfeed/categoryrss.xml","w") ;
				$op ="<?xml version='1.0' encoding='utf-8'?>\n";
				$op.="<rss version='2.0'>\n<channel>\n";
				$op.="<title>Welcome to ".$sitename."</title>\n";
				$op.="<link>$sitepath"."/index.php</link>\n";
				$op.="<description>New Products</description>\n";
				$op.="<language>en-us</language>\n";
				$op .="<copyright>Copyright 2002, Spartanburg Herald-Journal</copyright>";
				$op .="<managingEditor>geo@herald.com</managingEditor>";
				$op .="<webMaster>betty@herald.com</webMaster>";
				$op .= "<docs>http://blogs.law.harvard.edu/tech/rss</docs>";
				$count=count($obj->records);
				for($i=0;$i<$count;$i++)
				{
					$title = $obj->records[$i]['title'];
					$description =  $obj->records[$i]['description'];
					$brand = $obj->records[$i]['brand'];
					$price = $obj->records[$i]['price'];
					$image = $obj->records[$i]['thumb_image'];
					 		
					$op.="<item><title>".htmlentities($title)."</title>\n";
					$op.="<description>".htmlentities(strip_tags($description))."</description>\n";
					$op.="<link>http://www.goupstate.com/</link></item>\n";
				}
				$op.="</channel>\n</rss>";
				header ("content-type: text/xml");
				echo $op;
				exit;
				/*fwrite($fp,$op);
				fclose($fp);
				header("location:rssfeed/rss.xml");
				exit('<meta http-equiv="refresh" content="0;url=rssfeed/categoryrss.xml">');*/
			}
			else
			{
				$output = "No Record Found";
				return $output;
			}
	
		
   }
   
   function showSearchQueryRssFeed()
	{
		//print_r($_POST['selcat']);exit;
			//$categoryid = $_POST['selcat'];
			//echo 'janu';exit;
			//print_r($_SESSION['searchquery']);exit;
		if($_SESSION['searchquery']!='')
		{
			$sqlselect = $_SESSION['searchquery'];
			$sitename = "Zeus Cart";
			$sitepath = "http://www.zeuscart.com";
			$now = date("D, d M Y H:i:s");
			$obj = new Bin_Query();
			
			if($obj->executeQuery($sqlselect))
			{
				//$fp=fopen("rssfeed/categoryrss.xml","w") ;
				$op ="<?xml version='1.0' encoding='utf-8'?>\n";
				$op.="<rss version='2.0'>\n<channel>\n";
				$op.="<title>Welcome to ".$sitename."</title>\n";
				$op.="<link>$sitepath"."/index.php</link>\n";
				$op.="<description>New Products</description>\n";
				$op.="<language>en-us</language>\n";
				$op .="<copyright>Copyright 2002, Spartanburg Herald-Journal</copyright>";
				$op .="<managingEditor>geo@herald.com</managingEditor>";
				$op .="<webMaster>betty@herald.com</webMaster>";
				$op .= "<docs>http://blogs.law.harvard.edu/tech/rss</docs>";
				$count=count($obj->records);
				for($i=0;$i<$count;$i++)
				{
					$title = $obj->records[$i]['title'];
					$description =  $obj->records[$i]['description'];
					$brand = $obj->records[$i]['brand'];
					$price = $obj->records[$i]['price'];
					$image = $obj->records[$i]['thumb_image'];
					 		
					$op.="<item><title>".htmlentities($title)."</title>\n";
					$op.="<description>".htmlentities(strip_tags($description))."</description>\n";
					$op.="<link>http://www.goupstate.com/</link></item>\n";
				}
				$op.="</channel>\n</rss>";
				header ("content-type: text/xml");
				echo $op;
				exit;
				/*fwrite($fp,$op);
				fclose($fp);
				header("location:rssfeed/rss.xml");
				exit('<meta http-equiv="refresh" content="0;url=rssfeed/categoryrss.xml">');*/
			}
			else
			{
				$output = "No Record Found";
				return $output;
			}
		}
		else
		{
			$output = "No Record Found";
			return $output;
		}
	
		
   }
   
   
}
?>