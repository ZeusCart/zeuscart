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
 * This class contains functions to construct drop down list for the BI Page.
 *
 * @package  		Display_DChart
 * @category  		Display
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
   * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */

class Display_DChart
{
	
	/**
	 * Function returns the day drop down list for the BI Page. 
	 * @param integer $id
	 * @return string
	 */
	
	function getDay($id)
	{			
		$output ='';
		
		if($id==1)
		$output.='<select name="Calendar[To][Mth]" >';
		else if($id==0)
		$output.='<select name="Calendar[From][Mth]" >';
		
		$tmp = array(1=>'Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec');
		
		$currmonth = date("n");	
		
		foreach($tmp as $i => $value)
		{					
		if($i==$currmonth && $id==1)
		$output.= '<option value="'.$i.'" selected>'.$value.'</option>';		
		else
		$output.= '<option value="'.$i.'">'.$value.'</option>';		
		}
		$output.='</select>';		
		return $output;	
	}	
	
	/**
	 * Function returns the year drop down list for the BI Page. 
	 * @param integer $id
	 * @return string
	 */
	
	function getYear($id)
	{			
		$output ='';
	
		if($id==1)
		$output.='<select name="Calendar[To][Yr]" >';
		elseif($id==0)
		$output.='<select name="Calendar[From][Yr]" >';     
		
		$startyr = date('Y',strtotime("-365 days"));		
		$endyr = date('Y', strtotime("+3650 days"));	
								
		for($i=$startyr;$i<=$endyr;$i++)
		{ 	  	
		$output.= '<option value="'. $i .'">'. $i.'</option>';		
		}                                                
		$output.='</select>';		
		return $output;	
	}	
	
	
	/**
	 * Function returns the type drop down list for the BI Page. 
	 * 
	 * @return string
	 */
	
	function getType()
	{		
	 
		$tmparray = array(1=>'Last 30 days',2=>'This Month',3=>'Last Month',4=>'All Time',5=>'Custom');
		$output.='';	
		$output.='<select name="Calendar[DateType]" id="Calendar" class="CalendarSelect" onchange="doCustomDate(this.value)">
		<option value="0">------Select-----</option>';
		
		foreach($tmparray as $key=>$item)
		{	
			if((int)$key==(int)$_POST['Calendar']['DateType'])
			{
			$output.='<option value="'.$key.'" selected >'.$item.'</option>';
			}
			else
			{
			$output.='<option value="'.$key.'" >'.$item.'</option>';
			}	 
		}
		return $output;	
	}
	
}
?>