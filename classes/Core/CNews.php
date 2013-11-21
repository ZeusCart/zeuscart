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
 * News page related  class
 *
 * @package   		Core_CNews
 * @category    	Core
 * @author    		AJ Square Inc Dev Team
 * @link   		http://www.zeuscart.com
  * @copyright 	        Copyright (c) 2008 - 2013, AJ Square, Inc.
 * @version   		Version 4.0
 */
class Core_CNews
{
   	/**
	 * This function is used to get  the news menu
	 * 
	 * 
	 * @return HTML data
	 */
   	function showNewsMenu()
	{
	
	    	$query = new Bin_Query(); 
		 $sql = "SELECT news_title ,DATE_FORMAT(news_date,'%d %b %Y') AS date FROM `news_table` order by news_id desc limit 0,2";
		if($query->executeQuery($sql))
		{
			$output = Display_DNews::showNewsTitle($query->records);
		}
		else
		{
		 $output ='<div class="recent" align="center"><font size="2" color="orange"><b>'.Core_CLanguage::_(NO_NEWS_FOUND).'</b></font></div>';   	
		}		
		return $output;
	}
   	/**
	 * This function is used to get  the all news from db
	 * 
	 * 
	 * @return string
	 */
	function showNewsPage()
	{
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
				
				
		 $sql="SELECT news_title,DATE_FORMAT(news_date,'%M %D %Y')AS date,news_desc from news_table where news_status=1 order by news_date desc";
		
		$query = new Bin_Query();
		
		if($query->executeQuery($sql))
		{	
			$total = ceil($query->totrows/ $pagesize);
			include('classes/Lib/Paging.php');
			$tmp = new Lib_Paging('classic',array('totalpages'=>$total, 'length'=>10),'pagination');
			$this->data['paging'] = $tmp->output;
			$this->data['prev'] =$tmp->prev;
			$this->data['next'] = $tmp->next;	
			
			 $sql = "SELECT news_title,DATE_FORMAT(news_date,'%M %D %Y')AS date,news_desc from news_table where news_status=1 order by news_date desc limit $start,$end";
			 
			$obj = new Bin_Query();
	
			if($obj->executeQuery($sql))
			{
				 return Display_DNews::showNewsPage($obj->records,$this->data['paging'],$this->data['prev'],$this->data['next'],$start);
			}	
			else
				return Core_CLanguage::_(NO_NEWS_FOUND);
		}
		else
			return Core_CLanguage::_(NO_NEWS_FOUND);
		
	
		
		
	}
	
		
}
?>