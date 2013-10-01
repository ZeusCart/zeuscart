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
 * This class contains functions to display the site settings process
 *
 * @package  		Display_DSiteSettings
 * @category  		Display
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
  * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */
class Display_DSiteSettings
{
	/**
	 * Function  to  display the site moto
	 * @param array $arr
	 * 
	 * @return string
	 */	
	function siteSittings($arr,$recordsTime,$Err)
	{


		if(!empty($Err->messages))
		{
			$arr=$Err->values;
		}
		else
		{
			$arr=$arr;
		}

		$output.='<div class="row-fluid">
   		 <div class="span6">
	        <label>Site Title <font color="red">*</font>  </label>
		<input type="text" name="site_moto"  value="'.$arr['site_moto'].'" class="span8" />
		</div></div>
		<div class="row-fluid">
		<div class="span6">
		<label> Meta Keywords   </label>	    
			<textarea name="meta_kerwords" id="meta_kerwords"  style="width: 279px; height: 159px;">'.$arr['meta_kerwords'].'</textarea>
		</div>
		</div> 
		<div class="row-fluid">
		<div class="span6">
		<label>Meta Description </label>	    
			<textarea name="meta_description" id="meta_description"  style="width: 279px; height: 159px;">'.$arr['meta_description'].'</textarea>
		</div>
		</div>
		<div class="row-fluid">
   		 <div class="span12">
	        <label>Google Analytics Tracking Script </label>
		<textarea name="google_analytics" id="google_analytics"  style="width: 279px; height: 159px;">'.$arr['google_analytics'].'</textarea>
		</div></div>  ';
		$output.='<div class="row-fluid">
		<div class="span12">
		<label>Custom Header </label>
		<textarea name="customer_header" id="customer_header" class="ckeditor"  style="width: 279px; height: 159px;">'.$arr['customer_header'].'</textarea>
		</div>
		</div>
		';
		$output.='<div class="row-fluid">
   		 <div class="span6">
	        <label>Set TimeZone to </label>';		
		$count=count($recordsTime);
		$output.= '<select name="time_zone" style="width:290px" id="cbosubcat" '.$fun.'>';
		$output.= '<option value="">Select</option>';	
		for ($i=0;$i<$count; $i++)
		{
			//if($_POST['timezone']!=	$arr[$i]['tz_timezone'])
			if($arr['time_zone'] !=$recordsTime[$i]['tz_timezone'])
				$output.= '<option value="'.$recordsTime[$i]['tz_timezone'].'">'.$recordsTime[$i]['tz_timezone'].$hassub.'</option>';
			else
				$output.= '<option value="'.$recordsTime[$i]['tz_timezone'].'" selected>'.$recordsTime[$i]['tz_timezone'].$hassub.'</option>';
		}
		$output.= '</select>';
		
		$output.='</div></div>';
		$output.='<div class="row-fluid">
              <div class="span2">
               Site Logo </div><div class="span10" style="float:left;">

                <div class="fileupload fileupload-new" data-provides="fileupload"> 
                  <div class="fileupload-new thumbnail" style="width: 200px; height: 100px;"><img src="../'.$arr['site_logo'].'"></div><input type="hidden" name="site_logo" value="'.$arr['site_logo'].'"> 
                  <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                  <div>
                    <span class="btn btn-file"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span><input type="file" name="site_logo" /></span>
                    <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
                  </div>
                </div>
              </div></div>';

		return $output;
	}
}
?>