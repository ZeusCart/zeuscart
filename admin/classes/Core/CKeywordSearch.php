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
 * This class contains functions to display the search results. 
 *
 * @package  		Core_CKeywordSearch
 * @category  		Core
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
   * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */




class Core_CKeywordSearch
{

	/**
	 * Function returns the result of the search query from database. 
	 * @param string $search
	 * @param int $sort
	 * @param int $mode
	 * @return string
	 */


 	 function searchKeyWord($search,$sort,$mode)
	{
	  
	   $limitstart=0;
	   $limitend=$_POST['selpage'];
	   if(empty($_POST['selpage']))
	      $limitend=10;
	 	$sortby=$_POST['selsort'];
		if(empty($sortby))
		  $sortby=0;
		if($sortby==0)
		{
		    $sql="SELECT * FROM PRODUCTS_TABLE WHERE TITLE LIKE '%".$search."%' OR DESCRIPTION LIKE '%".$search."%' OR TAG LIKE '%".$search."%' OR BRAND LIKE '%".$search."%' order by msrp limit ".$limitstart.",".$limitend;
		}
		elseif($sortby==1)
		{
			$sql="SELECT * FROM PRODUCTS_TABLE WHERE TITLE LIKE '%".$search."%' OR DESCRIPTION LIKE '%".$search."%' OR TAG LIKE '%".$search."%' OR BRAND LIKE '%".$search."%' order by msrp desc limit ".$limitstart.",".$limitend;
		}
		elseif($sortby==2)
		{
		    $sql="SELECT * FROM PRODUCTS_TABLE WHERE TITLE LIKE '%".$search."%' OR DESCRIPTION LIKE '%".$search."%' OR TAG LIKE '%".$search."%' OR BRAND LIKE '%".$search."%' order by title limit ".$limitstart.",".$limitend;
		}
		elseif($sortby==3)
		{
		    $sql="SELECT * FROM PRODUCTS_TABLE WHERE TITLE LIKE '%".$search."%' OR DESCRIPTION LIKE '%".$search."%' OR TAG LIKE '%".$search."%' OR BRAND LIKE '%".$search."%' order by title desc limit ".$limitstart.",".$limitend;
		}
	   
	  	if($search!='')
		{
			$obj = new Bin_Query();
			$obj->executeQuery($sql);				
			$i=0;
			foreach($obj->records as $row)
			{
				 $r[$i]=$row;
				 $prid=$row['product_id'];
				 $obj1=new Core_CKeywordSearch();
				 $minval=$obj1->disRates($prid);

				 if($minval > 0  or $minval!='')
				 {
					$r[$i]['msrp']= '$'.$row['msrp'].' - $'.$minval;
				 }
				 else
				  	$r[$i]['msrp']= '$'.$row['msrp'];
				 $i++;
			 }
			return Display_DKeywordSearch::displaySearch($r,$mode);
		}	
		else
		{
		    $obj3=new Core_CKeywordSearch();
	    	$res='Enter Keyword to Search';
			$obj3->countSearch($search);
			return $res;
		}
			
	 
	}//end of function searchKeyWord
	
	/**
	 * Function returns the count of the search query. 
	 * @param string $search
	 * 
	 * @return array
	 */
	
	function countSearch($search)
	{
	if($search!='')
		{
			$sql="SELECT count(*) as count FROM PRODUCTS_TABLE WHERE TITLE LIKE '%".$search."%' OR DESCRIPTION LIKE '%".$search."%' OR TAG LIKE '%".$search."%' OR BRAND LIKE '%".$search."%'";
	    	$obj = new Bin_Query();
			$obj->executeQuery($sql);					
			return Display_DKeywordSearch::displayCountSearch($obj->records);
	  	}	
	}
	
	
	/**
	 * Function generates the pagination for the search query. 
	 * @param string $search
	 * 
	 * @return multiple
	 */
	
	
	function pagination($search)
	{
	    if($_GET['curpage']==1 or $_GET['curpage']=='')
		{
		    $init=0;
			$selpagesize=$_POST['selpage'];
			
		}
		else
		{
		     $page=$_GET['curpage'];
			 $init=$fin;
		}
	  	$previouspageno=0;
		$recperpage=$_POST['selpage'];
		if($search!='')
		{
			$sql="SELECT count(*) as count FROM PRODUCTS_TABLE WHERE TITLE LIKE '%".$search."%' OR DESCRIPTION LIKE '%".$search."%' OR TAG LIKE '%".$search."%' OR BRAND LIKE '%".$search."%'";
			$obj = new Bin_Query();
			$obj->executeQuery($sql);					
			$totrec=$obj->records[0]['count'];
			if($recperpage>0)
			  	$total_pages = ceil( $totrec/$recperpage );
			else
				$total_pages=1;
			return Display_DKeywordSearch::pagination($total_pages,$limitstart,$limitend);
		}	
	}
	
	/**
	 * Function returns the mode of link for the search query. 
	 * 
	 * 
	 * @return string
	 */
	
	function linkMode()
	{
	    return Display_DKeywordSearch::linkMode();
	}
	
	/**
	 * Function returns the display rates for the selected product id. 
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
	 * Function returns the price range for the search query
	 * 
	 * 
	 * @return string
	 */
	
	function priceRange()
	{
	   return Display_DKeywordSearch::priceRange();  
	}
	
	/**
	 * Function returns the brand,count for the search query
	 * 
	 * 
	 * @return string
	 */
	
	function dispBrandWithCount()
	{
	
		$catid=2;
	   $sql='Select brand, count(*)as cnt from    products_table where category_id='.$catid.' group by brand having count(*) > 0 ';
	   	
	   $obj=new Bin_Query();
	   $obj->executeQuery($sql);
	   return Display_DKeywordSearch::dispBrandWithCount($obj->records); 
	   
	}
	
	/**
	 * Function returns the feature list of products
	 * 
	 * 
	 * @return string
	 */
	
	function featureList()
	{
	    $id=$_POST['id'];
		$id=2;
	    $sql1='select distinct a.attrib_name,a.attrib_id from attribute_table a join attribute_value_table b on a.attrib_id=b.attrib_id inner join category_attrib_table c on c.attrib_id=b.attrib_id inner join category_table d on c.subcategory_id=d.category_id where d.category_id='.$id;
		$obj1=new Bin_Query();
	    $obj1->executeQuery($sql1);
		
		$sql='select a.attrib_id,a.attrib_name,b.attrib_value_id,b.attrib_value,d.category_name,d.category_id from attribute_table a inner join attribute_value_table b on a.attrib_id=b.attrib_id inner join category_attrib_table c on c.attrib_id=b.attrib_id inner join category_table d on c.subcategory_id=d.category_id where d.category_id='.$id;
		$obj=new Bin_Query();
	    $obj->executeQuery($sql);
	 
		for($i=0;$i<$obj->totrows;$i++)
		{
			if($obj->records[$i]['attrib_value_id']!=0)
				$obj->records[$i]['productCnt']=Core_CKeywordSearch::getProductCount($obj->records[$i]['attrib_value_id'] );
		}
		
		
		return Display_DKeywordSearch::featureList($obj1->records,$obj->records); 
	   
		
	}
	
	
	/**
	 * Function returns the no of product count from the database.  
	 * @param integer $attValId
	 * 
	 * @return string
	 */
	
	function getProductCount($attValId)
	{
	
		$_POST['id']=2;
		//$sql='select product_id from products_table where category_id ='.$_POST['id'] ;
		$sql='select count(*) as cnt from product_attrib_values_table where attrib_value_id='.$_POST['id'];
//		$sql='select * from product_attrib_values_table where attrib_value_id='.$_POST['id'];
		
		$obj=new Bin_Query();
	    $obj->executeQuery($sql);
	

/*		foreach($obj->records as $arr)
			$product_ids[]=$arr['product_id'];
		$product_ids=implode(',',$product_ids);

		$sql='select count(*) as cnt from product_attrib_values_table where product_id in ('.$product_ids.') and attrib_value_id='.$attValId;
 
		$obj->executeQuery($sql);
*/		return $obj->records[0]['cnt'];
	}
	
	/**
	 * Function generates a drop down list for the available categories
	 * 
	 * 
	 * @return string
	 */
	
	function categoryDropDown()
	{
	    $sql='select * from category_table where category_parent_id=0  order by category_name';
		$obj=new Bin_Query();
	    $obj->executeQuery($sql);
	    return Display_DKeywordSearch::categoryDropDown($obj->records); 		
	}
	
	
	
}


	
?>