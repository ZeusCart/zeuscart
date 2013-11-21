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
 * Keyword search related  class
 *
 * @package   		Core_CKeywordSearch
 * @category    	Core
 * @author    		AJ Square Inc Dev Team
 * @link   		http://www.zeuscart.com
  * @copyright 	        Copyright (c) 2008 - 2013, AJ Square, Inc.
 * @version   		Version 4.0
 */
 class Core_CKeywordSearch
{
	/**
	 * This function is used to get  the search keyword from  db
	 * @param string $search
	 * @param integer $sort
	 * @param string $mode	
	 * 
	 * @return string
	 */
	function searchKeyWord($search,$sort,$mode)
	{

		$pagesize=9;
		
		//-------------For Saving the searched tags----------------
		$tmpsearch=trim($search);
		if ($tmpsearch!='')
		{
			$obSav=new Core_CKeywordSearch();
			$obSav->insertSearchTags($tmpsearch);
		}
		
		//-------------For Saving the searched tags----------------
		
		
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
	  	$sortby=$_POST['selsort'];
		if(empty($sortby))
		  $sortby=0;
		  
		
		 $catid=$_SESSION['subcategory'];
				
		   if(((empty($catid))||(isset($_POST['search'])))&&($_SESSION['category']!=-1))
		   {
		     	  $catid=$_SESSION['category']; 
			  if(((int)$catid)>0)
			  {
			   		 $qry="select a.*,sum(r.rating)/count(r.user_id) as
					rating,count(r.user_id) as rcount from products_table a left join product_reviews_table r on a.product_id=r.product_id where  a.intro_date <= '".date('Y-m-d')."' and a.status=1 and a.product_status!='3' and ";
			   }
			   else
			   {
					$qry="select a.*,sum(r.rating)/count(r.user_id) as
					rating,count(r.user_id) as rcount from products_table a  left join product_reviews_table r on a.product_id=r.product_id where a.intro_date <= '".date('Y-m-d')."' and a.status=1 and a.product_status!='3'and ";
			   }
			   
			  	 if($sortby==0)
				{
				//$sql="SELECT * FROM PRODUCTS_TABLE WHERE TITLE LIKE '%".$search."%' OR DESCRIPTION LIKE '%".$search."%' OR TAG LIKE '%".$search."%' OR BRAND LIKE '%".$search."%' ".$mycat." order by msrp" ;
					$sql=$qry." (a.description like '%".$search."%' or a.brand like '%".$search."%' or a.tag like '%".$search."%' or a.title like '%".$search."%') group by a.product_id order by a.msrp";
				}
				elseif($sortby==1)
				{
					//$sql="SELECT * FROM PRODUCTS_TABLE WHERE TITLE LIKE '%".$search."%' OR DESCRIPTION LIKE '%".$search."%' OR TAG LIKE '%".$search."%' OR BRAND LIKE '%".$search."%' ".$mycat." order by msrp desc ";
					$sql=$qry." (a.description like '%".$search."%' or a.brand like '%".$search."%' or a.tag like '%".$search."%' or a.title like '%".$search."%') group by a.product_id order by a.msrp desc";
				}
				elseif($sortby==2)
				{
				//$sql="SELECT * FROM PRODUCTS_TABLE WHERE TITLE LIKE '%".$search."%' OR DESCRIPTION LIKE '%".$search."%' OR TAG LIKE '%".$search."%' OR BRAND LIKE '%".$search."%' ".$mycat." order by title ";
					$sql=$qry." (a.description like '%".$search."%' or a.brand like '%".$search."%' or a.tag like '%".$search."%' or a.title like '%".$search."%') group by a.product_id order by a.title";
		
				}
				elseif($sortby==3)
				{
					
				// $sql="SELECT * FROM PRODUCTS_TABLE WHERE TITLE LIKE '%".$search."%' OR DESCRIPTION LIKE '%".$search."%' OR TAG LIKE '%".$search."%' OR BRAND LIKE '%".$search."%' ".$mycat." order by title desc ";
				$sql=$qry." (a.description like '%".$search."%' or a.brand like '%".$search."%' or a.tag like '%".$search."%' or a.title like '%".$search."%') group by a.product_id order by a.title desc ";
		
				}
		   }
		   elseif(!empty($_SESSION['subcategory']))
		   {
				$catid=$_SESSION['subcategory'];
				$qry="select a.*,sum(r.rating)/count(r.user_id) as	rating,count(r.user_id) as rcount from products_table a left join product_reviews_table r on a.product_id=r.product_id where category_id=".$catid." and a.intro_date <= '".date('Y-m-d')."' and a.status=1 and ";
						if($sortby==0)
				{
					//$sql="SELECT * FROM PRODUCTS_TABLE WHERE TITLE LIKE '%".$search."%' OR DESCRIPTION LIKE '%".$search."%' OR TAG LIKE '%".$search."%' OR BRAND LIKE '%".$search."%' ".$mycat." order by msrp" ;
					$sql=$qry." (description like '%".$search."%' or brand like '%".$search."%' or tag like '%".$search."%' or title like '%".$search."%') group by a.product_id order by msrp";
				}
				elseif($sortby==1)
				{
					//$sql="SELECT * FROM PRODUCTS_TABLE WHERE TITLE LIKE '%".$search."%' OR DESCRIPTION LIKE '%".$search."%' OR TAG LIKE '%".$search."%' OR BRAND LIKE '%".$search."%' ".$mycat." order by msrp desc ";
					$sql=$qry." (description like '%".$search."%' or brand like '%".$search."%' or tag like '%".$search."%' or title like '%".$search."%') group by a.product_id order by msrp desc";
				}
				elseif($sortby==2)
				{
					//$sql="SELECT * FROM PRODUCTS_TABLE WHERE TITLE LIKE '%".$search."%' OR DESCRIPTION LIKE '%".$search."%' OR TAG LIKE '%".$search."%' OR BRAND LIKE '%".$search."%' ".$mycat." order by title ";
					$sql=$qry." (description like '%".$search."%' or brand like '%".$search."%' or tag like '%".$search."%' or title like '%".$search."%') group by a.product_id order by title";
		
				}
				elseif($sortby==3)
				{
					
					// $sql="SELECT * FROM PRODUCTS_TABLE WHERE TITLE LIKE '%".$search."%' OR DESCRIPTION LIKE '%".$search."%' OR TAG LIKE '%".$search."%' OR BRAND LIKE '%".$search."%' ".$mycat." order by title desc ";
					$sql=$qry." (description like '%".$search."%' or brand like '%".$search."%' or tag like '%".$search."%' or title like '%".$search."%') group by a.product_id order by title desc ";
		
				}
		 
		   }
		   else
		   {
		  
		   	 	// $catid=$_SESSION['subcategory'];
		        	$qry="select a.*,sum(r.rating)/count(r.user_id) as
				rating,count(r.user_id) as rcount,a.product_status from products_table a left join product_reviews_table r on a.product_id=r.product_id where a.intro_date <= '".date('Y-m-d')."' and a.status=1 and ";
				if($sortby==0)
				{
					//$sql="SELECT * FROM PRODUCTS_TABLE WHERE TITLE LIKE '%".$search."%' OR DESCRIPTION LIKE '%".$search."%' OR TAG LIKE '%".$search."%' OR BRAND LIKE '%".$search."%' ".$mycat." order by msrp" ;
					$sql=$qry." (description like '%".$search."%' or brand like '%".$search."%' or tag like '%".$search."%' or title like '%".$search."%') group by a.product_id order by msrp";
				}
				elseif($sortby==1)
				{
					//$sql="SELECT * FROM PRODUCTS_TABLE WHERE TITLE LIKE '%".$search."%' OR DESCRIPTION LIKE '%".$search."%' OR TAG LIKE '%".$search."%' OR BRAND LIKE '%".$search."%' ".$mycat." order by msrp desc ";
					$sql=$qry." (description like '%".$search."%' or brand like '%".$search."%' or tag like '%".$search."%' or title like '%".$search."%') group by a.product_id order by msrp desc";
				}
				elseif($sortby==2)
				{
					//$sql="SELECT * FROM PRODUCTS_TABLE WHERE TITLE LIKE '%".$search."%' OR DESCRIPTION LIKE '%".$search."%' OR TAG LIKE '%".$search."%' OR BRAND LIKE '%".$search."%' ".$mycat." order by title ";
					$sql=$qry." (description like '%".$search."%' or brand like '%".$search."%' or tag like '%".$search."%' or title like '%".$search."%') group by a.product_id order by title";
		
				}
				elseif($sortby==3)
				{
					
					// $sql="SELECT * FROM PRODUCTS_TABLE WHERE TITLE LIKE '%".$search."%' OR DESCRIPTION LIKE '%".$search."%' OR TAG LIKE '%".$search."%' OR BRAND LIKE '%".$search."%' ".$mycat." order by title desc ";
					$sql=$qry." (description like '%".$search."%' or brand like '%".$search."%' or tag like '%".$search."%' or title like '%".$search."%') group by a.product_id order by title desc ";
		
				}
		   }		  
		 $action=$_GET['action'];
		 $sub=$_POST['subcatsel'];
		  if(count($sub)>0)
		  {
	  			$ob=new Core_CKeywordSearch();
				$id=$_SESSION['category'];
			    $categoryname=$ob->categoryName($id);
				$subcategoryname=$ob->categoryName($sub);
			    $_SESSION['selectedbrand']='You have Selected <b> '.$categoryname. ' >> '.$subcategoryname.'</b>';
		  }
		  elseif($_POST['catsel'])
		  {
			    $ob=new Core_CKeywordSearch();
				$id=$_SESSION['category'];
			    $categoryname=$ob->categoryName($id);
		   		$_SESSION['selectedbrand']='You have Selected <b> '.$categoryname;
		  }

			$obj = new Bin_Query();
			if($obj->executeQuery($sql))
			{
			  $_SESSION['countsearch']=$obj->totrows;		
			  $sql1=$sql.' LIMIT '.$start.','.$end;
			  $total = ceil($obj->totrows/ $pagesize);
			  include('classes/Lib/Paging.php');
			  $tmp = new Lib_Paging('default',array('totalpages'=>$total, 'length'=>10),'pagination','&search=');
			  $this->data['paging'] = $tmp->output;
			  $this->data['prev'] =$tmp->prev;
			  $this->data['next'] = $tmp->next;
			  $query = new Bin_Query();
			  if($query->executeQuery($sql1))
			  {
				  if(((int)$query->totrows)>0)
				  	$i=0;
					foreach($query->records as $row)
					{
						 $r[$i]=$row;
						 $prid=$row['product_id'];
						 $obj1=new Core_CKeywordSearch();
						 $minval=$obj1->disRates($prid);
		
						 if($minval > 0  or $minval!='')
						 {
							$r[$i]['msrp']= '<!--$-->'.$_SESSION['currencysetting']['selected_currency_settings']['currency_tocken'].number_format($row['msrp']*$_SESSION['currencysetting']['selected_currency_settings']['conversion_rate'],2).' - <!--$-->'.$_SESSION['currencysetting']['selected_currency_settings']['currency_tocken'].number_format($minval*$_SESSION['currencysetting']['selected_currency_settings']['conversion_rate'],2);
						 }
						 else
							$r[$i]['msrp']= '<!--$-->'.$_SESSION['currencysetting']['selected_currency_settings']['currency_tocken'].number_format($row['msrp']*$_SESSION['currencysetting']['selected_currency_settings']['conversion_rate'],2);
						 $i++;
					 }
			  	
				}

				return Display_DKeywordSearch::displaySearch($r,$mode,$this->data['paging'],$this->data['prev'],$this->data['next']);
			}
			else
			{
				$_SESSION['countsearch']=$obj->totrows;
				return Display_DKeywordSearch::displaySearch($r,'','','','');
			}
			
		
			$_SESSION['countsearch']=$obj->totrows;
		$i=0;
		
	}
	/**
	 * This function is used to get  the countSearch
	 * 
	 * 
	 * @return string
	 */
	function countSearch()
	{
	  		$val=$_SESSION['countsearch'];
			return Display_DKeywordSearch::displayCountSearch($val);
	}
	/**
	 * This function is used to show  the linkMode
	 * 
	 * 
	 * @return string
	 */
	function linkMode()
	{
	    return Display_DKeywordSearch::linkMode();
	}
	/**
	 * This function is used to show  the linkMode
	 * @param integer $productid
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
	 * This function is used to show  the price rang
	 * 
	 * @return string
	 */
	function priceRange()
	{
	    return Display_DKeywordSearch::priceRange();  
	}
	
	/**
	 * This function is used to show  the brand with count
	 * 
	 * @return string
	 */
	function dispBrandWithCount()
	{
	    	$id=$_POST['catsel'];
		
		if($_SESSION['subcategory']!="")
		{
		     $id=$_SESSION['subcategory'];
	 	      $mycat=" where b.category_id=".$id;
		}
		else
		{	    
		   $id=$_SESSION['category'];
   		   $mycat=" where b.category_parent_id=".$id;
		}
		//if(isset($_POST['search']))
		if($id==-1)
		{
		    $mycat='';
		}

		$sql="Select a.brand,count(a.brand) as cnt from products_table a inner join category_table b on a.category_id=b.category_id  ".$mycat." and a.intro_date <= '".date('Y-m-d')."' and a.status=1 group by a.brand";
	
		$obj=new Bin_Query();
		$obj->executeQuery($sql);
		$res=$obj->records;

	   	return Display_DKeywordSearch::dispBrandWithCount($res,$id);
	  	   
	}
	/**
	 * This function is used to get  the category name
	 * @param integer $catid
	 * @return string
	 */
	
	function categoryName($catid)
	{
	   $sql="select category_name from category_table where category_id=".$catid;
	   $obj=new Bin_Query();
	   $obj->executeQuery($sql);
	   $res=$obj->records;
	   $catname=$res[0]['category_name'];
	   return $catname;
	}
	/**
	 * This function is used to find  the narrow search
	 * @param integer $sort
	 * @param string $mode
	 * @return string
	 */
	
	function narrowSearch($sort,$mode)
	{
	   
		if($_SESSION['subcategory']!='')
		{ 
		    $id=$_SESSION['subcategory'];
		   $mycat=" a.category_id=".$id .' and ';
		}
		elseif($_SESSION['category']!="")
		{
		      $id=$_SESSION['category'];
	 	      $mycat=" b.category_parent_id=".$id .' and ';
		}
		if($id==-1)
		{
		   $mycat="";
		}
              $ob=new Core_CKeywordSearch();
	      $categoryname=$ob->categoryName($id);
		
         	 $head=$_GET['head'];
		  $attib_value_id =$_GET['attrib_value_id'];
		
	      $brand=$_GET['brand'];
		  if(((int)$attib_value_id)>0)
			  $_SESSION['selectedbrand']='You have Selected <b>'.$categoryname.'</b> >><b> '.$subcategoryname.'</b>>><b>'.$head.'</b>';
		  elseif(count($brand)>0)
			  $_SESSION['selectedbrand']='You have Selected <b>'.$categoryname.'</b> >><b> '.$subcategoryname.'</b>';

	      $pagesize=10;
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
	  	 $limitstart=0;
	 	$sortby=$_POST['selsort'];
		if(empty($sortby))
		  $sortby=0;
		
		if($sortby==0)
		{
	
		 $sql="Select a.*,sum(r.rating)/count(r.user_id) as rating,count(r.user_id) as rcount  from products_table a inner join category_table b on a.category_id=b.category_id left join product_reviews_table r on a.product_id=r.product_id where ".$mycat."  brand ='".$brand."' and a.intro_date <= '".date('Y-m-d')."' and a.status=1 group by a.product_id order by a.msrp asc";
		}
		elseif($sortby==1)
		{
			//$sql="select * from products_table where brand='".$brand."' ".$mycat." order by msrp desc ";
			//$sql="Select a.*  from products_table a inner join category_table b on a.category_id=b.category_id where b.category_parent_id=".$catid." and brand='".$brand."' order by msrp desc" ;
			 $sql="Select a.*,sum(r.rating)/count(r.user_id) as rating,count(r.user_id) as rcount  from products_table a inner join category_table b on a.category_id=b.category_id left join product_reviews_table r on a.product_id=r.product_id where ".$mycat."  brand ='".$brand."' and a.intro_date <= '".date('Y-m-d')."' and a.status=1 group by a.product_id order by msrp desc";
		}
		elseif($sortby==2)
		{
		    //$sql="select * from products_table where brand='".$brand."' ".$mycat." order by title ";
			//$sql="Select a.*  from products_table a inner join category_table b on a.category_id=b.category_id where b.category_parent_id=".$catid." and brand='".$brand."' order by title" ;
			 $sql="Select a.*,sum(r.rating)/count(r.user_id) as rating,count(r.user_id) as rcount  from products_table a inner join category_table b on a.category_id=b.category_id left join product_reviews_table r on a.product_id=r.product_id where ".$mycat.".  brand ='".$brand."' and a.intro_date <= '".date('Y-m-d')."' and a.status=1 group by a.product_id  order by title asc";

		}
		elseif($sortby==3)
		{
		   // $sql="select * from products_table where brand='".$brand."' ".$mycat." order by title";
			//$sql="Select a.*  from products_table a inner join category_table b on a.category_id=b.category_id where b.category_parent_id=".$catid." and brand='".$brand."' order by title desc" ;
			 $sql="Select a.*,sum(r.rating)/count(r.user_id) as rating,count(r.user_id) as rcount from products_table a inner join category_table b on a.category_id=b.category_id left join product_reviews_table r on a.product_id=r.product_id where ".$mycat."  brand ='".$brand."' and a.intro_date <= '".date('Y-m-d')."' and a.status=1 group by a.product_id order by title desc";
			
		}
		
		
			$obj = new Bin_Query();

			if($obj->executeQuery($sql))
			{
			  $sql1=$sql.' LIMIT '.$start.','.$end;
			  $total = ceil($obj->totrows/ $pagesize);
			  include('classes/Lib/Paging.php');
			  $tmp = new Lib_Paging('classic',array('totalpages'=>$total, 'length'=>10),'pagination');
			  $this->data['paging'] = $tmp->output;
			  $this->data['prev'] =$tmp->prev;
			  $this->data['next'] = $tmp->next;
			  $query = new Bin_Query();
			  if($query->executeQuery($sql1))
			  {
			  $_SESSION['countsearch']=$query->totrows;		
				  if(((int)$query->totrows)>0)
				  {
				  	$i=0;
					foreach($query->records as $row)
					{
						 $r[$i]=$row;
						 $prid=$row['product_id'];
						 $obj1=new Core_CKeywordSearch();
						 $minval=$obj1->disRates($prid);
		
						 if($minval > 0  or $minval!='')
						 {
							$r[$i]['msrp']= '<!--$-->'.$_SESSION['currencysetting']['selected_currency_settings']['currency_tocken'].number_format($row['msrp']*$_SESSION['currencysetting']['selected_currency_settings']['conversion_rate'],2).' - <!--$-->'.$_SESSION['currencysetting']['selected_currency_settings']['currency_tocken'].number_format($minval*$_SESSION['currencysetting']['selected_currency_settings']['conversion_rate'],2);
						 }
						 else
							$r[$i]['msrp']= '<!--$-->'.$_SESSION['currencysetting']['selected_currency_settings']['currency_tocken'].number_format($row['msrp']*$_SESSION['currencysetting']['selected_currency_settings']['conversion_rate'],2);
						 $i++;
					 }
					}	 
			  	}
				return Display_DKeywordSearch::narrowSearch($r,$mode,$this->data['paging'],$this->data['prev'],$this->data['next']);
			}
			else
			{
				return Display_DKeywordSearch::narrowSearch($r,'','','','');
			}
		
			$_SESSION['countsearch']=$obj->totrows;
			$i=0;
			
	}
	/**
	 * This function is used to get  the featureList
	 * @return string
	 */
	function featureList()
	{

		if(empty($_POST['subcatsel']))
		   $id= $_SESSION['category'];
		else
			$id=$_SESSION['subcategory'];
	
		//$sql="select count(*)as cnt,b.attrib_value,a.product_id from product_attrib_values_table a inner join attribute_value_table b on a.attrib_value_id=b.attrib_value_id inner join products_table c on c.product_id=a.product_id inner join category_table d on c.category_id=d.category_id where d.category_id=".$id." group by attrib_value";
		//$sql="select count(*)as cnt,b.attrib_value,a.product_id,e.attrib_name,e.attrib_id from product_attrib_values_table a inner join attribute_value_table b on a.attrib_value_id=b.attrib_value_id inner join products_table c on c.product_id=a.product_id inner join category_table d on c.category_id=d.category_id inner join attribute_table e on b.attrib_id=e.attrib_id where d.category_id=".$id."  group by attrib_value order by e.attrib_name";
	  	  //$sql='select a.*,b.attrib_name from category_attrib_table a inner join attribute_table b on a.attrib_id=b.attrib_id where subcategory_id='.$id;
		$sql="select b.attrib_name,a.attrib_id,a.subcategory_id from category_attrib_table a inner join attribute_table b on a.attrib_id=b.attrib_id where a.subcategory_id=".$id;
		$obj=new Bin_Query();
		$obj->executeQuery($sql);
		$res=$obj->records;
		$i=0;
		
		if(count($res)>0)
        	foreach($res as $row)
		{
		  	$attrib_id=$row['attrib_id'];
			$sql1="select b.attrib_value,count(*) as cnt,b.attrib_value_id from product_attrib_values_table a inner join attribute_value_table b on a.attrib_value_id=b.attrib_value_id inner join products_table c on c.product_id=a.product_id where c.category_id=".$id." and b.attrib_id=".$attrib_id." and c.intro_date <= '".date('Y-m-d')."' and c.status=1 group by b.attrib_value";
			$obj1=new Bin_Query();
			$obj1->executeQuery($sql1);
			$res1=$obj1->records;
			$j=0;
			if($obj1->totrows>0)
			{
				$att1_name=$row['attrib_name'];
				$kk[$i]=$att1_name;
				foreach($res1 as $row1)
				{
				   $attrib_value1=$row1['attrib_value'];
				   $cnt1=$row1['cnt'];
				   $ss[$i][$j]=$attrib_value1."(".$row1['cnt'].")";
				   if($_GET['attribute_value_id']!=$row1['attrib_value_id'])
						$att[$i][$j]=$row1['attrib_value_id'];
				   $j++;
				}
			}
		    
			$i++;
		}

		
		return Display_DKeywordSearch::featureList($kk,$ss,$att,$id); 
		
   	}
	
	/**
	 * This function is used to get  the product count
	 * @param integer $attValId
	 * @param integer $catId
	 * @return string
	 */
	
	function getProductCount($attValId,$catId)
	{

		$sql="select b.attrib_value,a.product_id from product_attrib_values_table a inner join attribute_value_table b on a.attrib_value_id=b.attrib_value_id inner join products_table c on a.product_id=c.product_id where b.attrib_value_id=".$attValId." and c.intro_date <= '".date('Y-m-d')."' and c.status=1 and c.category_id=".$catId;
		$obj=new Bin_Query();
	   	 $obj->executeQuery($sql);
		return $obj->totrows;
	}
	/**
	 * This function is used to get  the category for drop down 
	 * @return string
	 */
	function categoryDropDown()
	{
		$sql='select * from category_table where category_parent_id=0 and category_status=1 order by category_name';
		$obj=new Bin_Query();
		$obj->executeQuery($sql);
	    return Display_DKeywordSearch::categoryDropDown($obj->records); 		
	}
	/**
	 * This function is used to find  the price range
	 * @param integer $sort
	 * @param string $mode
	 * @return string
	 */
	
	function priceRangeSearch($sort,$mode)
	{
	
	
		$sql = "select a.*,sum(r.rating)/count(r.user_id) as rating,count(r.user_id) as rcount from products_table a left join product_reviews_table r on a.product_id=r.product_id and a.intro_date <= '".date('Y-m-d')."' and a.status=1 ";

		$conditions=array();
	        $pagesize=10;
		
		if(isset($_POST['pricerange']))
		{
		   $_SESSION['minval']=$_POST['txtminmsrp'];
		   $_SESSION['maxval']=$_POST['txtmaxmsrp'];		   
   		   $minval=$_POST['txtminmsrp'];
		   $maxval=$_POST['txtmaxmsrp'];
		}  
		else
		{
		   $minval=$_SESSION['minval'];
		   $maxval=$_SESSION['maxval'];
		}
		
		 if((int)$_SESSION['subcategory'])
 		 	$category=$_SESSION['subcategory'];
		 if((int)$category!=0)
		 	$condition[]= ' a.category_id='.$category;
		
		if((int)$minval!=0 && (int)$maxval !=0)
			$condition[]= ' a.msrp between ' . $minval . ' and '.$maxval;
		  

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
		        $catagory=$_POST['subcatsel'];
			$sortby=$_POST['selsort'];
			if(empty($sortby))
			  $sortby=0;
			  
			
		 
			if($sortby==0) // 0-9
			{
				$orderby =" order by a.msrp ";
			}
			elseif($sortby==1) //9-0
			{
				$orderby =" order by a.msrp desc ";
			}
			elseif($sortby==2) // A-Z
			{
				$orderby =" order by a.title ";
			}
			elseif($sortby==3) // Z-A
			{
				$orderby =" order by a.title desc ";
			}
			
			if(count($condition)>1)
				$sql.= ' where '. implode(' and ', $condition);
			elseif(count($condition)>0)
				$sql.= ' where '. implode('', $condition);
			$sql.= ' group by a.product_id '.$orderby;
			
			$obj = new Bin_Query();
			if($obj->executeQuery($sql))
			{
			  $_SESSION['countsearch']=$obj->totrows;		
			  $sql1=$sql.' LIMIT '.$start.','.$end;

			  $total = ceil($obj->totrows/ $pagesize);
			  include('classes/Lib/paging.php');
			  $tmp = new Lib_Paging('classic',array('totalpages'=>$total, 'length'=>10),'pagination');
			  $this->data['paging'] = $tmp->output;
			  $this->data['prev'] =$tmp->prev;
			  $this->data['next'] = $tmp->next;
			  $query = new Bin_Query();
			  if($query->executeQuery($sql1))
			  {		
			  		$i=0;
				  if(((int)$query->totrows)>0)
					foreach($query->records as $row)
					{
						 $r[$i]=$row;
						 $prid=$row['product_id'];
						 $obj1=new Core_CKeywordSearch();
						 $minval=$obj1->disRates($prid);
		
						 if($minval > 0  or $minval!='')
						 {
							$r[$i]['msrp']= '<!--$-->'.$_SESSION['currencysetting']['selected_currency_settings']['currency_tocken'].number_format($row['msrp']*$_SESSION['currencysetting']['selected_currency_settings']['conversion_rate'],2).' - <!--$-->'.$_SESSION['currencysetting']['selected_currency_settings']['currency_tocken'].number_format($minval*$_SESSION['currencysetting']['selected_currency_settings']['conversion_rate'],2);
						 }
						 else
							$r[$i]['msrp']= '<!--$-->'.$_SESSION['currencysetting']['selected_currency_settings']['currency_tocken'].number_format($row['msrp']*$_SESSION['currencysetting']['selected_currency_settings']['conversion_rate'],2);
						 $i++;
					 }
			  	
				}
				return Display_DKeywordSearch::priceRangeSearch($r,$mode,$this->data['paging'],$this->data['prev'],$this->data['next']);
			}
			else
			{
				return Display_DKeywordSearch::priceRangeSearch($r,'','','','');
			}
		
			$_SESSION['countsearch']=$obj->totrows;
		$i=0;
				//return Display_DKeywordSearch::displaySearch($r,$mode);
	}
	/**
	 * This function is used to get  the sub category
	 * @return string
	 */
	
	function dispSubCategory()
	{
		$id= $_SESSION['category'];					
		
		$sql='select category_id,category_name from category_table where category_parent_id='.$id;
		$obj=new Bin_Query();
		$obj->executeQuery($sql);
		return Display_DKeywordSearch::dispSubCategory($obj->records);			
	}
	/**
	 * This function is used to find  the extended search
	 * @param integer $sort
	 * @param string $mode
	 * @return string
	 */

	function extendedSearch($sort,$mode)
	{
                $attrib_value_id= $_GET['attrib_value_id'];
		$catid=$_GET['category'];
	        $pagesize=10;
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
	
	 	$sortby=$_POST['selsort'];
		if(empty($sortby))
		  $sortby=0;
		 $catid=$_POST['subcatsel'];
		 
		 if(empty($catid))
		    $catid=$_GET['category'];
		 

		  $ob=new Core_CKeywordSearch();
	          $subcategoryname=$ob->categoryName($catid);
		  $mm=$_SESSION['category'];
		  $categoryname=$ob->categoryName($mm);
		
        	  $head=$_GET['head'];
		  $attib_value_id =$_GET['attrib_value_id'];
		 // echo 'the value is '.$attib_value_id; 
	  	   $brand=$_GET['brand'];
		  if(((int)$attib_value_id)>0)
			  $_SESSION['selectedbrand']='You have Selected <b>'.$categoryname.'</b> >><b> '.$subcategoryname.'</b>>>'.'<b> '.$head.' </b>';
		  elseif(count($brand)>0)
			  $_SESSION['selectedbrand']='You have Selected <b>'.$categoryname.'</b> >><b> '.$subcategoryname.'</b>';

		if(((int)$attrib_value_id)>0)
		if($sortby==0)
		{
		   //$sql="select * from products_table a inner join product_attrib_values_table b on a.product_id=b.product_id inner join category_table c on c.category_id=a.category_id inner join category_table d on d.category_id=c.category_parent_id where b.attrib_value_id=".$attrib_value_id." and category_id=".catid." group by a.title  order by a.msrp";
		 //  $sql="select a.* from products_table a inner join product_attrib_values_table b  on a.product_id=b.product_id inner join category_table c on c.category_id=a.category_id inner join category_table d on c.category_parent_id=d.category_id where b.attrib_value_id=".$attrib_value_id." and c.category_parent_id=".$catid ." order by a.msrp";
		   $sql="select a.*,sum(r.rating)/count(r.user_id) as rating,count(r.user_id) as rcount from products_table a inner join product_attrib_values_table b  on a.product_id=b.product_id inner join category_table c on c.category_id=a.category_id inner join category_table d on c.category_parent_id=d.category_id where b.attrib_value_id=".$attrib_value_id."  and c.category_id=".$catid ." and a.intro_date <= '".date('Y-m-d')."' and a.status=1 group by a.product_id order by a.msrp";
		 

		}
		elseif($sortby==1)
		{
			//$sql="select * from products_table a inner join product_attrib_values_table b on a.product_id=b.product_id inner join category_table c on c.category_id=a.category_id inner join category_table d on d.category_id=c.category_parent_id where b.attrib_value_id=".$attrib_value_id." ".$mycat." group by a.title  order by a.msrp desc ";
			// $sql="select a.* from products_table a inner join product_attrib_values_table b  on a.product_id=b.product_id inner join category_table c on c.category_id=a.category_id inner join category_table d on c.category_parent_id=d.category_id where b.attrib_value_id=".$attrib_value_id." and c.category_parent_id=".$catid ." order by a.msrp desc";
			 $sql="select a.*,sum(r.rating)/count(r.user_id) as rating,count(r.user_id) as rcount from products_table a inner join product_attrib_values_table b  on a.product_id=b.product_id inner join category_table c on c.category_id=a.category_id inner join category_table d on c.category_parent_id=d.category_id left join product_reviews_table r on a.product_id=r.product_id where b.attrib_value_id=".$attrib_value_id."  and c.category_id=".$catid ." and a.intro_date <= '".date('Y-m-d')."' and a.status=1 group by a.product_id order by a.msrp desc";
		}
		elseif($sortby==2)
		{
		   // $sql="select * from products_table a inner join product_attrib_values_table b on a.product_id=b.product_id inner join category_table c on c.category_id=a.category_id inner join category_table d on d.category_id=c.category_parent_id where b.attrib_value_id=".$attrib_value_id." ".$mycat." group by a.title  order by a.title";
			// $sql="select a.* from products_table a inner join product_attrib_values_table b  on a.product_id=b.product_id inner join category_table c on c.category_id=a.category_id inner join category_table d on c.category_parent_id=d.category_id where b.attrib_value_id=".$attrib_value_id." and c.category_parent_id=".$catid ." order by a.title";
 				$sql="select a.*,sum(r.rating)/count(r.user_id) as rating,count(r.user_id) as rcount from products_table a inner join product_attrib_values_table b  on a.product_id=b.product_id inner join category_table c on c.category_id=a.category_id inner join category_table d on c.category_parent_id=d.category_id left join product_reviews_table r on a.product_id=r.product_id where b.attrib_value_id=".$attrib_value_id."  and c.category_id=".$catid ." and a.intro_date <= '".date('Y-m-d')."' and a.status=1 group by a.product_id order by a.title";

		}
		elseif($sortby==3)
		{
		    //$sql="select * from products_table a inner join product_attrib_values_table b on a.product_id=b.product_id inner join category_table c on c.category_id=a.category_id inner join category_table d on d.category_id=c.category_parent_id where b.attrib_value_id=".$attrib_value_id." ".$mycat." group by a.title  order by a.title desc ";
			 //$sql="select a.* from products_table a inner join product_attrib_values_table b  on a.product_id=b.product_id inner join category_table c on c.category_id=a.category_id inner join category_table d on c.category_parent_id=d.category_id where b.attrib_value_id=".$attrib_value_id." and c.category_parent_id=".$catid ." order by a.title desc";
			 $sql="select a.*,sum(r.rating)/count(r.user_id) as rating,count(r.user_id) as rcount from products_table a inner join product_attrib_values_table b  on a.product_id=b.product_id inner join category_table c on c.category_id=a.category_id inner join category_table d on c.category_parent_id=d.category_id left join product_reviews_table r on a.product_id=r.product_id where b.attrib_value_id=".$attrib_value_id."  and c.category_id=".$catid ." and a.intro_date <= '".date('Y-m-d')."' and a.status=1 group by a.product_id order by a.title desc";

		}
		    
		
			$obj = new Bin_Query();
			if($obj->executeQuery($sql))
			{
			$_SESSION['countsearch']=$obj->totrows;		
			  $sql1=$sql.' LIMIT '.$start.','.$end;
			
			  $total = ceil($obj->totrows/ $pagesize);
			  include('classes/Lib/paging.php');
			  $tmp = new Lib_Paging('classic',array('totalpages'=>$total, 'length'=>10),'pagination');
			  $this->data['paging'] = $tmp->output;
			  $this->data['prev'] =$tmp->prev;
			  $this->data['next'] = $tmp->next;
			  $query = new Bin_Query();
			  if($query->executeQuery($sql1))
			  {
			  		$i=0;
				  if(((int)$query->totrows)>0)
					foreach($query->records as $row)
					{
						 $r[$i]=$row;
						 $prid=$row['product_id'];
						 $obj1=new Core_CKeywordSearch();
						 $minval=$obj1->disRates($prid);
		
						 if($minval > 0  or $minval!='')
						 {
							$r[$i]['msrp']= '$'.number_format($row['msrp'],2).' - $'.number_format($minval,2);
						 }
						 else
							$r[$i]['msrp']= '$'.number_format($row['msrp'],2);
						 $i++;
					 }
			  	
				}
				return Display_DKeywordSearch::extendedSearch($r,$mode,$this->data['paging'],$this->data['prev'],$this->data['next']);
			}
		
	}
	/**
	 * This function is used to get  the attributes from db
	 * @param integer $id
	 * @return string
	 */
	function getAttribValue($id)
	{
	
	   $sql='select distinct attrib_value from attribute_value_table a inner join product_attrib_values_table b on a.attrib_value_id=b.attrib_value_id where a.attrib_value_id='.$id;
	   $obj = new Bin_Query();
	   $obj->executeQuery($sql);		
	   $res=$obj->records;
	   $out=$res[0]['attrib_value'];
	   return $out;	   
	}
	/**
	 * This function is used to insert or update the  search tags
 	 * @param string $keyword
	 * @return string
	 */
	function insertSearchTags($keyword)
	{
		$keyword=htmlentities(trim($keyword));
		$search_sql="select count(*) as cnt  from search_tags_table where search_tag='".$keyword."'";
		$obj = new Bin_Query();
		$obj->executeQuery($search_sql);		
		$res=$obj->records;
		
	   	if ($res[0]['cnt'] <= 0)
		{
			$sql="insert into search_tags_table (search_tag,search_count) values ('".$keyword."',1)";
		}
		else
		{
			$sql="update search_tags_table set search_count=search_count+1 where search_tag='".$keyword."'";
		}
		
		$query = new Bin_Query();
		$query->updateQuery($sql);
		
	}
	
}

?>