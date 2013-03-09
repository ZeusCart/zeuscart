<?php
 
class Core_CNews
{
   
   function showNewsMenu()
	{
		//var $arr = array();
	    	$query = new Bin_Query(); 
		 $sql = "SELECT news_title ,DATE_FORMAT(news_date,'%d %b %Y') AS date FROM `news_table` order by news_id desc limit 0,2";
		if($query->executeQuery($sql))
		{
			$output = Display_DNews::showNewsTitle($query->records);
		}
		else
		{
		 $output ='<div class="recent" align="center"><font size="2" color="orange"><b>No News Found</b></font></div>';   	
		}		
		return $output;
	}
   
	function showNewsPage()
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
				return 'No Products Found!';
		}
		else
			return 'No Products Found!';
		
	
		
		
	}
	
		
}
?>