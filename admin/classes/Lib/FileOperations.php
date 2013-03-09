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
class Lib_FileOperations
 {
 	function uploadFile($spath,$dpath)
		{
			//echo 'path:' .$dpath;
			$temp=explode('/',$dpath);
			//print_r($temp[2]);
			if($temp[2]!='')
			{
			if (file_exists($dpath))
      		return  '<div class="error_msgbox">Sorry File Name Already exists</div>';
			//echo '<br>'. $dpath ."<b> already exists.</b><br />";
    		else
	      	return move_uploaded_file($spath,$dpath);
			}
		}
 }