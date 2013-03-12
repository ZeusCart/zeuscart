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
 * AJDF
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * @package 		AJDF
 * @author   	 	AJ Square Inc Dev Team
 * @copyright 	        Copyright (c) 2008 - 2013, AJ Square, Inc.
 * @link    		http://www.ajsquare.com/ajhome.php
 * @version   		Version 1.0
 * @created   		January 15 2013
 */

/**
 * Paging  related  class
 *
 * @package   		AJDF
 * @subpackage  	Library
 * @category    	Library
 * @author    		AJ Square Inc Dev Team
 * @link   		http://www.zeuscart.com
 */

class Lib_Paging
{
	
	var $output=array();
	var $prev;
	var $next;
	
	function Lib_Paging($model,$par,$cssstyle)
	{
		if($model='classic')
			$this->doClassicPaging($par,$cssstyle);
		if($model='default')
			$this->doDefaultPaging($par,$cssstyle);
	}
	
	function doClassicPaging($par = array(),$cssstyle)
	{

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
						$this->output[++$s]= '<a >'.$i.'</a>';				
					else
						$this->output[++$s]= '<a href="?'.$tmp.'" class=\''.$cssstyle.'\'>'.$i.'</a>';				
				}
				if($par['totalpages']>$par['length'])
				{
					$tmp = $_SERVER['QUERY_STRING']."&page=".($start+1);
					$this->next = '<a href="?'.($tmp).'"  >Next </a>';
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
						$this->output[++$s] = '<a>'.$i.'</span>';
					else
					{
						if($i<=$par['totalpages'])
						$this->output[++$s] = '<a href="?'.$q.' " >'.$i.'</a>';				
					}
				}
				if ($_GET['page']<$par['totalpages'])
				{
					$tmp = split('page',$_SERVER['QUERY_STRING']);
					$q = $tmp[0]."page=".($_GET['page']+1);
					$tmp = split('&',$tmp[1]);					
					$q .= (strlen(trim($tmp[1]) > 0) ? '&'.$tmp[1] : '');
					$this->next = '<a href="?'.($q).' " >Next </a>';
				}
				if($_GET['page']>1)
				{
					$tmp = split('page',$_SERVER['QUERY_STRING']);
					$q = $tmp[0]."page=".($_GET['page']-1);
					$tmp = split('&',$tmp[1]);					
					$q .= (strlen(trim($tmp[1]) > 0) ? '&'.$tmp[1] : '');
					$this->prev .= ' <a href="?'.($q).'" >Prev</a>';
				}
			}			
		}
	}
	
	function doDefaultPaging($par = array(),$cssstyle)
	{
	/*  print_r($par);exit;
	   echo $cssstyle;exit*/;
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
					
					if ($end==1) // For A Single Display Page
					{
						$this->output[++$s]= '';	
					}
					else
					{
					
						if($_GET['page'] == "" && $i==1)
							$this->output[++$s]= '<a>'.$i.'</a>';				
						else
							$this->output[++$s]= '<a href="?'.$tmp.'" >'.$i.'</a>';			
					}	
				}
				if($par['totalpages']>$par['length'])
				{
					$tmp = $_SERVER['QUERY_STRING']."&page=".($start+1);
					$this->next = '<a href="?'.($tmp).'"  >» </a>';
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
						$this->output[++$s] = '<a>'.$i.'</a>';
					else
					{
						if($i<=$par['totalpages'])
						$this->output[++$s] = '<a href="?'.$q.' " >'.$i.'</a>';				
					}
				}
				if ($_GET['page']<$par['totalpages'])
				{
					$tmp = split('page',$_SERVER['QUERY_STRING']);
					$q = $tmp[0]."page=".($_GET['page']+1);
					$tmp = split('&',$tmp[1]);					
					$q .= (strlen(trim($tmp[1]) > 0) ? '&'.$tmp[1] : '');
					$this->next = '<a href="?'.($q).' ">» </a>';
				}
				if($_GET['page']>1)
				{
					$tmp = split('page',$_SERVER['QUERY_STRING']);
					$q = $tmp[0]."page=".($_GET['page']-1);
					$tmp = split('&',$tmp[1]);					
					$q .= (strlen(trim($tmp[1]) > 0) ? '&'.$tmp[1] : '');
					$this->prev = ' <a href="?'.($q).'"  >«</a>';
				}
			}			
		}
	}
	

	
}



?>