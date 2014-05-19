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
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
 * @version  		Version 4.0
 * @created   		January 15 2013
 * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 */
class Bin_Build_Compile
{
	
	/**
	 * Function to read the web config xml
	 *
	 * 
	 * @return xml
	 */
	protected function readConfigFile()
	{		 			
		return simplexml_load_file(ROOT_FOLDER."WEB-CONFIG/web.xml");		
	}
	/**
	 * Function to create the system config xml
	 * @param array $arr
	 * 
	 * @return array
	 */
	protected function buildSystemConfig($arr)
	{
		$cnt = count($arr->appconfig->systemconfig);
		for($i=0;$i<$cnt;$i++)
			$resp[] = simplexml_load_file(ROOT_FOLDER."WEB-CONFIG/".$arr->appconfig->systemconfig[$i].".xml");								

		$systemroot = $resp[0]->systemroot;
		$cnt = count($systemroot);
		
		for($i=0;$i<$cnt;$i++)
		{
			
			$tmp = $systemroot[$i]->attributes();
			$currentroot = $tmp->name[0];
			
			$lbs = $systemroot[$i]->system;
			$lbscount = count($lbs);
			
			for($j=0;$j<$lbscount;$j++)
			{				
				$tmp = $lbs[$j]->attributes();				
				$str[] = $currentroot.'/'.$tmp->name[0].'.php';								
			}				
		}	
		return (array) $str;	
	}
	/**
	 * Function to create the library config xml
	 * @param array $arr
	 * 
	 * @return array
	 */
	protected function buildLibraryConfig($arr)
	{
		
		$cnt = count($arr->appconfig->libraryconfig);
		for($i=0;$i<$cnt;$i++)			
			$resp[] = simplexml_load_file(ROOT_FOLDER."WEB-CONFIG/".$arr->appconfig->libraryconfig[$i].".xml");						
		
		$dicroot = $arr->appconfig->libraryroot[0];
		$libraryroot = $resp[0]->libraryroot;
		$cnt = count($libraryroot);
		for($i=0;$i<$cnt;$i++)
		{
			
			$tmp = $libraryroot[$i]->attributes();
			$currentroot = $dicroot.'/'.$tmp->name[0];
			
			$lbs = $libraryroot[$i]->library;
			$lbscount = count($lbs);
			
			for($j=0;$j<$lbscount;$j++)
			{				
				$tmp = $lbs[$j]->attributes();				
				$str[] = $currentroot.'/'.$tmp->name[0].'.php';								
			}				
		}	
		
		return (array) $str;
		
	}
	/**
	 * Function to create the controller config xml
	 * @param array $arr
	 * 
	 * @return array
	 */
	protected function buildControllerConfig($arr)
	{
		$fval = -1;
		for($i=0;$i<count($arr->appconfig->configs);$i++)
		{
			$tmp = $arr->appconfig->configs[$i]->attributes();
			if($tmp['for']==CURRENT_FOLDER)
				$fval = $i;
		}
			
		if($fval==-1)
			return false;
				
		for($i=0;$i<count($arr->appconfig->configs[$fval]->paramvalue);$i++)				
			$resp[] = simplexml_load_file(ROOT_FOLDER."WEB-CONFIG/".$arr->appconfig->configs[$fval]->paramvalue[$i].".xml");						
			
		$domapping =array();
		$glbalmapping = array();
		
		for($i=0;$i<count($resp);$i++)
		{
			$cnt = count($resp[$i]->domapping->do);
			for($j=0;$j<$cnt;$j++)
			{
				$tmp = $resp[$i]->domapping->do[$j]->attributes();
				if(isset($tmp['action']))
				{
					if(isset($tmp['loadlib']))
						$domapping[(string)$tmp[name].':'.(string)$tmp['action'][0]] = array('model'=>(string)$tmp['model'][0],'function'=>(string)$tmp['function'][0],'loadlib'=>(string)$tmp['loadlib']);				
					else
						$domapping[(string)$tmp[name].':'.(string)$tmp['action'][0]] = array('model'=>(string)$tmp['model'][0],'function'=>(string)$tmp['function'][0], 'loadlib'=>"1");
				}
				else if(isset($tmp['loadlib']))
					$domapping[(string)$tmp[name]] = array('model'=>(string)$tmp['model'][0],'function'=>(string)$tmp['function'][0],'loadlib'=>(string)$tmp['loadlib']);
				else
					$domapping[(string)$tmp[name]] = array('model'=>(string)$tmp['model'][0],'function'=>(string)$tmp['function'][0],'loadlib'=>'1');
			}
			
			$cntt = count($resp[$i]->globalmapping->do);			
			for($j=0;$j<$cntt;$j++)
			{
				$tmp = $resp[$i]->globalmapping->do[$j]->attributes();
				$globalmapping[(string)$tmp[name]] = array('model'=>(string)$tmp['model'][0],'function'=>(string)$tmp['function'][0],'loadlib'=>'1');
			}			
		}		
		return array("domapping"=>(array)$domapping, "globalmapping"=>(array)$globalmapping);
	}	
}


?>