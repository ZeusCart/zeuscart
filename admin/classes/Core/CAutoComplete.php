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
 * This class contains functions to generate an auto complete pop up window.
 *
 * @package  		Core_CAutoComplete
 * @category  		Core
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
   * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */


class Core_CAutoComplete
{ 
	
	
	 /**
	 * Function selects the data from the table need for generating auto complete popup window. 
	 * 
	 * 
	 * @return xml
	 */	 
	 
		function autoComplete()
		{
			
			$aUsers = array();
	
			$sql="SELECT title FROM products_table";
			$obj =  new Bin_Query();
			$obj->executeQuery($sql);
			
			$count=count($obj->records);
			for($i=0;$i<$count;$i++)
				$aUsers[]=$obj->records[$i]['title'];
		
		
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