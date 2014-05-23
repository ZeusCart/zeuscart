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

error_reporting(1);
ob_start();
session_start();

header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
	  
define("ROOT_FOLDER",'../');
define("CURRENT_FOLDER",'install');

include_once(ROOT_FOLDER.'Bin/Build/Save.php');
new Bin_Build_Save();

include(ROOT_FOLDER."Bin/Core/Assembler.php");
new Bin_Core_Assembler();
if($_GET['do']=='')
{
	include_once(ROOT_FOLDER.'Bin/Security.php');
	$obj=new Bin_Configuration();
	
	if($obj->config['HOST']!='') 
	{
		header('Location: ../index.php');
		exit();
	}
}
?>