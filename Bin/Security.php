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
class Bin_Security
{
	/**
	 * Check query for SQL injection
	 *
	 * @param array $fields
	 * @return array
	 */
	function makeQuery($sql, $fields = array())
	{
		$sql = split("#",$sql);
		$conv_sql = "";
		if(count($fields)>0)
		{
			foreach($fields as $key=>$item)
				$fields[$key] = mysql_escape_string(stripslashes($item));
			$fields[count($fields)] = "";
			foreach($sql as $key=>$item)
			{

				$conv_sql .= $item.$fields[key($fields)];
				next($fields);
			}
		}
		return trim($conv_sql);
	}

	 
	function checkConfigFile()
	{
		if(file_exists(ROOT_FOLDER.'Bin/Configuration.php'))
		{
			include(ROOT_FOLDER.'Bin/Configuration.php');
			if(class_exists("Bin_Configuration"))
				return true;
			else
				return false;
		}
		else
			return false;
	} 
}

 if(!Bin_Security::checkConfigFile())
	die("Configuration file corrupted or missing...") 

?>