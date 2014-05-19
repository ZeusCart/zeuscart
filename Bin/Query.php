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
 * This class contains functions related sql query 
 *
 * @package  		Bin_Query
 * @subpackage          Bin_DbConnect	
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
 * @version  		Version 4.0
 * @created   		January 15 2013
 * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.	
 */
class Bin_Query extends Bin_DbConnect 
{
	var $rs;
	var $totrows;
	var $records;
	var $insertid;
	var $sql;
	
	
	/**
	 * Enter description here...
	 *
	 * @param string $sql
	 * @param array $fields
	 * @return boolean
	 */
	function executeQuery($sql, $fields = array())
	{

		//if(substr_count($sql,'#')!=count($fields))
			//return false;
		if(count($fields)>0)
			$sql = $this->makeQuery($sql,$fields);	// Security::makeQuery();
		
		$i=0;
		$this->rs = mysql_query($sql); 
		$this->sql = $sql; 
		$this->insertid = mysql_insert_id();
		
		if(is_resource($this->rs))
			$this->totrows = mysql_num_rows($this->rs);
			
		if(!mysql_affected_rows() || $this->totrows < 1)
			return false;
		else
		{
			while($fetch = mysql_fetch_array($this->rs))
				$this->records[$i++] = $fetch;
				
			for($i=0;$i<count($this->records);$i++)
			{
				foreach ($this->records[$i] as $key=>$item)
				{
					if(is_numeric($key))
						unset($this->records[$i][$key]);
				}
			}
			return true;
		}
	}

	/**
	 * @param string $sql
	 * @return boolean
	 */
	function updateQuery($sql, $fields=array())
	{


		//if(substr_count($sql,'#')!=count($fields))
			//return false;
		if(count($fields)>0)
			$sql = $this->makeQuery($sql,$fields);	// Security::makeQuery();

		$this->rs = mysql_query($sql); 
		$this->sql = $sql;
		$this->insertid = mysql_insert_id();
		if(!$this->rs)
			return false;
		else
			return true;
	}	
}
?>