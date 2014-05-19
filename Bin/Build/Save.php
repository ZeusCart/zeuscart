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
 * This class contains functions related error hander
 *
 * @package  		Bin
 * @subpackage 		Build
 * @category  		Build
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
 * @version  		Version 4.0
 * @created   		January 15 2013
 * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 */
include_once(ROOT_FOLDER.'Bin/Build/Compile.php');

class Bin_Build_Save extends Bin_Build_Compile 
{
	
	
	public function __construct()
	{		
		$config = $this->readConfigFile();		
		$sysfiles = $this->buildSystemConfig($config);
		$libraries = $this->buildLibraryConfig($config);
		$controllers = $this->buildControllerConfig($config);			
		
		if(!$controllers)
			return false;

		$content = "<?php \n\n".' $system = '.var_export($sysfiles, true) . ";\n";
		$content .= "\n\n".' $libraries = '.var_export($libraries, true) . ";\n ";
		$content .= "\n\n".' $domapping = '.var_export($controllers['domapping'], true) . ";\n ";
		$content .= "\n\n".' $globalmapping = '.var_export($controllers['globalmapping'], true) . ";\n ?>";

		@mkdir(ROOT_FOLDER.'Built/'.CURRENT_FOLDER,0777);
		@chmod(ROOT_FOLDER.'Built/'.CURRENT_FOLDER,0777);
		
		if ($fp = @fopen(ROOT_FOLDER.'Built/'.CURRENT_FOLDER."/Dll.php", 'wb'))
		{
			@flock($fp, LOCK_EX);
			//"\n\$expired = (time() > " . (time() + $ttl) . ") ? true : false;\nif (\$expired) { return; }\n\n\$data = " .
			fwrite($fp, $content);
			@flock($fp, LOCK_UN);
			fclose($fp);
			@chmod(ROOT_FOLDER.'Built/'.CURRENT_FOLDER."/Dll.php", 0666);
		}	
	}	
	
	
	
}


?>