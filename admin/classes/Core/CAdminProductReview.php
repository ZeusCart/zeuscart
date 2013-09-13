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
 * This class contains functions to show and search the review details.
 *
 * @package  		Core_CAdminProductReview
 * @category  		Core
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
   * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */



class Core_CAdminProductReview
{
	/**
	 * Stores the output
	 *
	 * @var array 
	 */		
	var $output = array();	
	/**
	 * Stores the value
	 *
	 * @var array 
	 */	
	 var $val = array();
	
	/**
	 * Function gets the review details from multiple tables. 
	 * 
	 * 
	 * @return string
	 */
	function showReviewDetails()
	{

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
			
		$sqlselect = "select a.product_id,a.review_caption, a.review_txt,a.review_id, a.review_date,a.review_status,b.user_display_name, a.user_id,c.title from users_table b inner join product_reviews_table a on b.user_id=a.user_id inner join products_table c on a.product_id=c.product_id";
			
		$query = new Bin_Query();
		if($query->executeQuery($sqlselect))
		{
			$total = ceil($query->totrows/ $pagesize);
			include_once('classes/Lib/Paging.php');
			$tmp = new Lib_Paging('classic',array('totalpages'=>$total, 'length'=>10),'pagination');
			$this->data['paging'] = $tmp->output;
			$this->data['prev'] =$tmp->prev;
			$this->data['next'] = $tmp->next;
			include('classes/Display/DAdminProductReview.php');
			$sql = "SELECT a.product_id,a.review_caption, a.review_txt, a.review_date,a.review_status,b.user_display_name, a.user_id, c.title FROM product_reviews_table a INNER JOIN users_table b ON a.user_id = b.user_id INNER JOIN products_table c where a.product_id = c.product_id LIMIT $start,$end"; 
			$obj = new Bin_Query();
			if($obj->executeQuery($sql))
			{
				$output =  Display_DAdminProductReview::showReviewDetails($obj->records,1,$this->data['paging'],$this->data['prev'],$this->data['next']);
			}
			else
			{
				$output =  Display_DAdminProductReview::showReviewDetails($obj->records,0,$this->data['paging'],$this->data['prev'],$this->data['next']);
			}
		
			
		}
		else
		{
			$output =  Display_DAdminProductReview::showReviewDetails($obj->records,0);
		}
		return $output;
  	}
   
  	 /**
	 * Function gets the search results for the review details from multiple tables. 
	 * 
	 * 
	 * @return string
	 */
   
   	function searchReviewDetails()
	{

		
		include('classes/Display/DAdminProductReview.php');
		$username = $_POST['username'];
		$producttitle = $_POST['title'];
		$reviewtxt =  $_POST['reviewtxt'];
		$review =  $_POST['review'];
		$dte =  $_POST['date']; 
		/* if($username=='' and $producttitle=='' and $reviewtxt='' and $review='' and $dte='')
			{
			$sql = "SELECT a.product_id,a.review_caption, a.review_txt, a.review_date,a.review_status,b.user_display_name, a.user_id, c.title FROM product_reviews_table a INNER JOIN users_table b ON a.user_id = b.user_id INNER JOIN products_table c where a.product_id = c.product_id";
			}*/
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
			
		 $sql = "select a.product_id,a.review_caption, a.review_txt,a.review_id, a.review_date,a.review_status,b.user_display_name, a.user_id,c.title from users_table b inner join product_reviews_table a on b.user_id=a.user_id inner join products_table c on a.product_id=c.product_id";
			
		
		$condition=array();
		
		if($username!='')
		{
			$condition []= " b.user_display_name like'%".$username."%'";
		}
		if($producttitle!='')
		{
			$condition[]= " c.title like  '%".$producttitle."%'";
		}
		if($reviewtxt!='')
		{
			$condition []= "  a.review_txt like  '%".$reviewtxt."%'";
		}
		if($review!='')
		{
			$condition []= "  a.review_caption like  '%".$review."%'";
		}
		if($dte!='')
		{
			$condition []= "  a.review_date = '".$dte."'";
		}

		if(count($condition)>1)
		$sql.= ' where '. implode(' and ', $condition);
		elseif(count($condition)>0)
		$sql.= ' where '. implode('', $condition);
		$query = new Bin_Query();
		if($query->executeQuery($sql))
		{
			$$total = ceil($query->totrows/ $pagesize);
			include_once('classes/Lib/Paging.php');
			$tmp = new Lib_Paging('classic',array('totalpages'=>$total, 'length'=>10),'pagination');
			$this->data['paging'] = $tmp->output;
			$this->data['prev'] =$tmp->prev;
			$this->data['next'] = $tmp->next;		
			
			if (empty($condition))
			{
				$sql1 =$sql.' LIMIT '.$start.','.$end ;				
			}				
			else
			{
				 $sql1 =$sql; 				
			}				
			$query1 = new Bin_Query();			
			$query1->executeQuery($sql1);						
		}
		
		if(count($condition)<=0)
		{	
			
			return  Display_DAdminProductReview::showReviewDetails($query1->records,1,$this->data['paging'],$this->data['prev'],$this->data['next'],$start);
		}	
		else
		{

			return  Display_DAdminProductReview::showReviewDetails($query1->records,1,'','','',0);
		}	
			
		return $output;
   	}
  
  
  	/**
	 * Function updates the review status in the prodcut_review_table 
	 * 
	 * 
	 * @return string
	 */
  
	function acceptReview()
	{
			$prodid = $_GET['prodid'];
			$userid = $_GET['usrid'];
			$sql = "update product_reviews_table set review_status=1 where product_id=".$prodid." and user_id=".$userid;
			$obj = new Bin_Query();
			if($obj->updateQuery($sql))
				$output = '<div class="alert alert-success">
				<button data-dismiss="alert" class="close" type="button">×</button>Product Successfully Activated</div>';
			else
				$output = '<div class="alert alert-error">
				<button data-dismiss="alert" class="close" type="button">×</button>Not Activated</div>';
				
			//$output .= $this->showReviewDetails();
			return $output;
			
	}

	
   	/**
	 * Function updates the review status in the prodcut_review_table 
	 * 
	 * 
	 * @return string
	 */
   
   
	function denyReview()
	{
			$prodid = $_GET['prodid'];
			$userid = $_GET['usrid'];
			$sql = "update product_reviews_table set review_status=0 where product_id=".$prodid." and user_id=".$userid;
			$obj = new Bin_Query();
			if($obj->updateQuery($sql))
				$output = '<div class="alert alert-success">
				<button data-dismiss="alert" class="close" type="button">×</button>Successfully Inactivated</div>';
			else
				$output = '<div class="alert alert-error">
				<button data-dismiss="alert" class="close" type="button">×</button>Not Inactivated</div>';
				
			//$output .= $this->showReviewDetails();
			return $output;
	}
   	/**
	 * Function delete the review status in the prodcut_review_table 
	 * 
	 * 
	 * @return string
	 */
   
   
	function deleteReview()
	{
			$prodid = $_GET['prodid'];
			$userid = $_GET['usrid'];
			$sql = "DELETE FROM  product_reviews_table WHERE product_id=".$prodid." and user_id=".$userid;
			$obj = new Bin_Query();
			if($obj->updateQuery($sql))
				$output = '<div class="alert alert-success">
				<button data-dismiss="alert" class="close" type="button">×</button>Successfully Deleted</div>';
			else
				$output = '<div class="alert alert-error">
				<button data-dismiss="alert" class="close" type="button">×</button>Not Deleted</div>';
				
			//$output .= $this->showReviewDetails();
			return $output;
	}

   	/**
	 * Function generates a product review report in the file format. 
	 * @param string $sql
	 * 
	 * @return file
	 */
   
   
	function productReviewReport($sql)
	{
			if($_POST['export'] =='excel')
			{
				include("classes/Lib/excelwriter.inc.php");   
				$excel=new ExcelWriter("Product_Review.xls");
				
				if($excel==false)	
					echo $excel->error;
				$myArr=array("Id","User Name","Title","Review Summary","Review","Review Date");
				$excel->writeLine($myArr);
					
				$obj = new Bin_Query();
				if($obj->executeQuery($sql))
				{
					$cnt=count($obj->records);
					for($i=0;$i<$cnt;$i++)
					{
						$product_id = $obj->records[$i]['product_id'];
						$display_name = $obj->records[$i]['user_display_name'];
						$title = $obj->records[$i]['title'];
						$reviewsummary = $obj->records[$i]['review_txt'];
						$review =  $obj->records[$i]['review_caption'];
						$reviewdate =  $obj->records[$i]['review_date'];
						
						$excel->writeRow();
						$excel->writeCol($product_id);
						$excel->writeCol($display_name );
						$excel->writeCol($title);
						$excel->writeCol($reviewsummary);
						$excel->writeCol($review);
						$excel->writeCol($reviewdate);
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
				$file="Product_Review.xls";
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
				else if($_POST['export'] =='xml')
				{
						//$sqlselect = "select user_id,user_fname,user_lname,user_display_name,user_email,user_doj from users_table";
						$obj = new Bin_Query();
						if($obj->executeQuery($sql))
						{
							header("Content-Type: text/xml");
							header("Pragma: public");
							header("Expires: 0");
							header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
							header("Content-Type: xml/force-download");
							header("Content-Type: xml/octet-stream");
							header("Content-Type: xml/download");
							header("Content-Disposition: attachment;filename=product_review_report.xml"); 
							header("Content-Transfer-Encoding: binary ");
							echo("<?xml version=\"1.0\" encoding=\"UTF-8\" ?>\n");
							echo("<productreviewdetails>\n");
							$cnt=count($obj->records);
							for($i=0;$i<$cnt;$i++)
							{
								/*echo ("<user id=\"". $obj->records[$i]['user_id'] ."\">\n");
								echo ("<firstname=\"". $obj->records[$i]['user_fname'] ."\">\n");
								echo ("<lastname=\"". $obj->records[$i]['user_lname'] ."\">\n");
								echo ("<displayname=\"". $obj->records[$i]['user_display_name'] ."\">\n");
								echo ("<email=\"". $obj->records[$i]['user_email'] ."\">\n");
								echo ("<userdoj=\"". $obj->records[$i]['user_doj'] ."\">\n");*/
								
								echo ("<productid>".$obj->records[$i]['product_id']."<\productid>\n");
								echo ("<username>". $obj->records[$i]['user_display_name'] ."<\username>\n");
								echo ("<title>". $obj->records[$i]['title'] ."<\title>\n");
								echo ("<reviewsummary>". $obj->records[$i]['review_txt'] ."<\reviewsummary>\n");
								echo ("<review>". $obj->records[$i]['review_caption'] ."<\review>\n");
								echo ("<reviewdate>". $obj->records[$i]['review_date'] ."<\reviewdate>\n");
							}
							echo("</productreviewdetails>\n");
					}
				}
				
				else if($_POST['export'] =='csv')
				{
						header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
						header("Content-Length: " . strlen($out));
						header("Content-type: text/x-csv");			
						header("Content-Disposition: attachment; filename=product_review_report.csv");
						$csv_terminated = "\n";
						$csv_separator = ",";
						$csv_enclosed = '"';
						$csv_escaped = "\\";
					//$sqlselect = "select user_id,user_fname,user_lname,user_display_name,user_email,user_doj from users_table";
					$obj = new Bin_Query();
					if($obj->executeQuery($sql))
					{
							$schema_insert  = $csv_enclosed.Id.$csv_enclosed.$csv_separator;
							$schema_insert  .= $csv_enclosed.UserName.$csv_enclosed.$csv_separator;
							$schema_insert  .= $csv_enclosed.Title.$csv_enclosed.$csv_separator;
							$schema_insert  .= $csv_enclosed.ReviewSummary.$csv_enclosed.$csv_separator;
							$schema_insert  .= $csv_enclosed.Review.$csv_enclosed.$csv_separator;
							$schema_insert  .= $csv_enclosed.ReviewPostedDate.$csv_enclosed;
							
						$cnt=count($obj->records);
							for ($i = 0; $i < $cnt; $i++)
							{
								$schema_insert .= $csv_enclosed .$obj->records[$i]['product_id']. $csv_enclosed.$csv_separator;
								$schema_insert .= $csv_enclosed.$obj->records[$i]['user_display_name'].$csv_enclosed.$csv_separator;
								$schema_insert .= $csv_enclosed .$obj->records[$i]['title'].$csv_enclosed.$csv_separator;
								$schema_insert .= $csv_enclosed .$obj->records[$i]['review_txt'].$csv_enclosed.$csv_separator;
								$schema_insert .= $csv_enclosed .$obj->records[$i]['review_caption'].$csv_enclosed.$csv_separator;
								$schema_insert .= $csv_enclosed .$obj->records[$i]['review_date'].$csv_enclosed;
							}
							$out .= $schema_insert;
							$out .= $csv_terminated;
					}
					echo $out;
					exit;
				}
				else if($_POST['export'] =='tab')
				{
							header("Pragma: public");
							header("Expires: 0");
							header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
							header("Content-Length: " . strlen($out));
							header("Content-Type: tab/force-download");
							header("Content-Type: tab/octet-stream");
							header("Content-Type: tab/download");
							header("Content-Disposition: attachment;filename=product_review_report.tab"); 
							header("Content-Transfer-Encoding: binary ");
						$tab_terminated = "\n";
						$tab_separator = "->";
						$tab_enclosed = '"';
						$tab_escaped = "\\";
					//$sqlselect = "select user_id,user_fname,user_lname,user_display_name,user_email,user_doj from users_table";
					$obj = new Bin_Query();
					if($obj->executeQuery($sql))
					{
							$schema_insert  = $tab_enclosed.Id.$tab_enclosed.$tab_separator;
							$schema_insert  .= $tab_enclosed.UserName.$tab_enclosed.$tab_separator;
							$schema_insert  .= $tab_enclosed.Title.$tab_enclosed.$tab_separator;
							$schema_insert  .= $tab_enclosed.ReviewSummary.$tab_enclosed.$tab_separator;
							$schema_insert  .= $tab_enclosed.Review.$tab_enclosed.$tab_separator;
							$schema_insert  .= $tab_enclosed.ReviewPostedDate.$tab_enclosed;
							
						$count=count($obj->records);
							for ($i = 0; $i < $count; $i++)
							{
								$schema_insert .= $tab_enclosed .$obj->records[$i]['product_id']. $tab_enclosed.$tab_separator;
								$schema_insert .= $tab_enclosed.$obj->records[$i]['user_display_name'].$tab_enclosed.$tab_separator;
								$schema_insert .= $tab_enclosed .$obj->records[$i]['title'].$tab_enclosed.$tab_separator;
								$schema_insert .= $tab_enclosed .$obj->records[$i]['review_txt'].$tab_enclosed.$tab_separator;
								$schema_insert .= $tab_enclosed .$obj->records[$i]['review_caption'].$tab_enclosed.$tab_separator;
								$schema_insert .= $tab_enclosed .$obj->records[$i]['review_date'].$tab_enclosed;
							}
							$out .= $schema_insert;
							$out .= $tab_terminated;
					}
						echo $out;
						exit;
				}				
	}
	
	 /**
	 * Function selects the data from the table need for generating auto complete popup window. 
	 * 
	 * 
	 * @return xml
	 */
	
	function autoComplete()
	{
			
		$aUsers = array();

		$sql="SELECT a.product_id,a.review_caption, a.review_txt, a.review_date,a.review_status,b.user_display_name, a.user_id, c.title FROM product_reviews_table a INNER JOIN users_table b ON a.user_id = b.user_id INNER JOIN products_table c where a.product_id = c.product_id";
		$obj =  new Bin_Query();
		$obj->executeQuery($sql);
	
		$count=count($obj->records);
		if($count!=0)
		{
			for($i=0;$i<$count;$i++)
			{
				if($_GET['ids']==1)
					$aUsers[]=$obj->records[$i]['user_display_name'];
				elseif($_GET['ids']==2)
					$aUsers[]=$obj->records[$i]['title'];
			}
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
?>