<?php

class Lib_Paging
{
	
	var $output=array();
	var $prev;
	var $next;
	
	function Lib_Paging($model,$par,$cssstyle)
	{
		if($model='classic')
			$this->doClassicPaging($par,$cssstyle);
	}
	
	function doClassicPaging($par = array(),$cssstyle)
	{
	//   print_r($par);exit;
//	   echo $cssstyle;exit;
		if(count($par)>0)
		{
			
			if(!isset($_GET['page']))
			{
				$start = 1;
				$end = ($par['length']>$par['totalpages'] ? $par['totalpages'] : $par['length']);
				$s = 0;
				for($i=$start;$i<=$end;$i++)
				{
					$tmp = $_SERVER['QUERY_STRING']."&page=".$i;
					if($_GET['page'] == "" && $i==1)
						$this->output[++$s]= '<span class="current">'.$i.'</span>';				
					else
						$this->output[++$s]= '<a href="?'.$tmp.'" class=\''.$cssstyle.'\'>'.$i.'</a>';				
				}
				if($par['totalpages']>$par['length'])
				{
					$tmp = $_SERVER['QUERY_STRING']."&page=".($start+1);
					$this->next = '<a href="?'.($tmp).'"  class=\''.$cssstyle.'\'>Next </a>';
				}
				return true;
			}
			else if (isset($_GET['page']))
			{
					
				$cpage = $_GET['page'];
				$mid = (int) ($par['length']/2);
				if($cpage > ($mid+1))
				{
					$start = ($cpage - $mid);
					$end = $start + $par['length']-1;
				}
				else 
				{
					$start = 1;
					$end = ($par['length']>$par['totalpages'] ? $par['totalpages'] : $par['length']);
				}
				$s=0;
				for($i=$start;$i<=$end;$i++)
				{
					$tmp = split('page',$_SERVER['QUERY_STRING']);
					$q = $tmp[0]."page=".$i;
					$tmp = split('&',$tmp[1]);					
					$q .= (strlen(trim($tmp[1]) > 0) ? '&'.$tmp[1] : '');
					if($_GET['page']==$i)
						$this->output[++$s] = '<span class="current">'.$i.'</span>';
					else
					{
						if($i<=$par['totalpages'])
						$this->output[++$s] = '<a href="?'.$q.' " class=\''.$cssstyle.'\'>'.$i.'</a>';				
					}
				}
				if ($_GET['page']<$par['totalpages'])
				{
					$tmp = split('page',$_SERVER['QUERY_STRING']);
					$q = $tmp[0]."page=".($_GET['page']+1);
					$tmp = split('&',$tmp[1]);					
					$q .= (strlen(trim($tmp[1]) > 0) ? '&'.$tmp[1] : '');
					$this->next = '<a href="?'.($q).' " class=\''.$cssstyle.'\'>Next </a>';
				}
				if($_GET['page']>1)
				{
					$tmp = split('page',$_SERVER['QUERY_STRING']);
					$q = $tmp[0]."page=".($_GET['page']-1);
					$tmp = split('&',$tmp[1]);					
					$q .= (strlen(trim($tmp[1]) > 0) ? '&'.$tmp[1] : '');
					$this->prev .= ' <a href="?'.($q).'"  class=\''.$cssstyle.'\'>Prev</a>';
				}
			}			
		}
	}
}



?>