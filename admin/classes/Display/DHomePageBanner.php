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
 * This class contains functions to get the list of home page banners available.
 *
 * @package  		Display_DHomePageBanner
 * @category  		Display
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
   * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */



class Display_DHomePageBanner
{
 	/**
	 * Function creates a template for displaying the list of home page banners available. 
	 * @param array $arr
	 * @param array $Err	 
	 * @return string
	 */
		
	function homePageBanner($arr,$Err)
	{

		if(count($arr)==0)
		{
		$output .= '<div id="homepageBannerDiv1"><table width="100%" border="0" cellspacing="0" cellpadding="0"  >';
		$output .= '<tr><td align="left" colspan="2" class="content_list_head">Slider1</td>';	

		$output .= '<tr>
		<td width="34%" align="left" nowrap class="content_form">
		Title:</td>
			<td width="66%" class="content_form" valign="top" >
			<input  type="text" name="slide_title[]" id="slide_title1" value="'.$arr['slide_title'].'" style="width: 381px; "/></td></tr>
			<tr>
		<td width="34%" align="left" class="content_form" >Content: </td>
		<td class="content_form"><input type="file" id="slide_content1" name="slide_content[]" />
			</td>
			</tr><tr>
		<td width="34%" align="left" class="content_form">
		Caption:</td>
			<td width="66%" class="content_form" >
			<textarea style="width: 381px; height: 94px;" name="slide_caption[]" id="slide_caption1">'.$arr['slide_caption'].'</textarea><td></tr>
			<tr>
		<td width="34%" align="left" class="content_form">
		Url:</td>
			<td width="66%" class="content_form" >
			<input type="text" id="slide_url1"  name="slide_url[]" value="'.$arr[$i]['slide_url'].'"/><td></tr>

			</table><input type="hidden" name="theValue[]" id="theValue1" value="1"></div>';
		}
		elseif(count($arr)>0)
		{

			$output .= '<div id="homepageBannerDiv1">';
			for($i=0;$i<count($arr);$i++)
			{
				$n=$i+1;
				if($arr[$i]['id']==1)
				{
					
					$output .= '<table width="100%" border="0" cellspacing="0" cellpadding="0" id="homepageBannerDiv1" >';
					$output .= '<tr><td align="left" colspan="2" class="content_list_head">  Slider'.$n.'</td>';	
		
					$output .= '<tr>
					<td width="34%" align="left" nowrap class="content_form">
					Title:</td>
					<td width="66%" class="content_form" valign="top" >
					<input  type="text" name="slide_title[]" id="slide_title'.$n.'" value="'.$arr[$i]['slide_title'].'" style="width: 381px;"/></td></tr>
					<tr>
					<td  width="34%" align="left" class="content_form" >Content: </td>
					<td class="content_form"><input type="file" id="slide_content'.$n.'" name="slide_content[]" /><img src=../'.$arr[$i]['slide_content_thumb'].' >
					<input type="hidden" name="slide_content_thumb[]" id="slide_content_thumb'.$n.'" value="'.$arr[$i]['slide_content_thumb'].'">
					<input type="hidden" name="slide_content_image[]" id="slide_content_image'.$n.'" value="'.$arr[$i]['slide_content'].'">
					</td>
					</tr>
					
					<tr>
					<td width="34%" align="left" class="content_form">
					Caption:</td>
					<td width="66%" class="content_form" >
					<textarea style="width: 381px; height: 94px;" name="slide_caption[]" id="slide_caption'.$n.'">'.$arr[$i]['slide_caption'].'</textarea><td></tr>
					<tr>
					<td width="34%" align="left" class="content_form">
					Url:</td>
					<td width="66%" class="content_form" >';
					if($Err->messages['slide_url'.$n.'']!='')
					{
					$output.='<input type="text" id="slide_url'.$n.'" name="slide_url[]"  value='.$Err->values['slide_url'][$i].'/><br/>
					<p class="red">'.$Err->messages['slide_url'.$n.''].'</p><td>';
	
					}
					else
					{	
					$output.='<input type="text" id="slide_url'.$n.'" name="slide_url[]"  value="'.$arr[$i]['slide_url'].'" >
					<td>';
					}
					$output.='<td></tr>
					</table><input type="hidden" name="slide_content[]" id="slide_content1" value="'.$arr[$i]['slide_content'].'">
	
					<input type="hidden" name="theValue[]" id="theValue1" value="'.$arr[$i]['id'].'">';
				}
				else
				{

				$output .= '<div id="homepageBannerDiv'.$n.'"><table width="100%" border="0" cellspacing="0" cellpadding="0" >';
				$output .= '<tr><td align="left" colspan="2" class="content_list_head"> Slider'.$n.'</td>';
				$output .= '<td align="left" class="content_list_head" colspan="2"><a href="javascript:void(0);" onclick="removeHomePageBannerInner(\'homepageBannerDiv'.$n.'\','.$n.');">Remove</a></td>';

				$output .= '<tr>
				<td width="35%" align="left" nowrap class="content_form">
				Title:</td>
				<td width="66%" class="content_form" valign="top" >
				<input  type="text" name="slide_title[]" id="slide_title'.$n.'" value="'.$arr[$i]['slide_title'].'" style="width: 381px;" /></td></tr>
				<tr>
				<td width="40%" align="left" class="content_form" >Content: </td>
				<td class="content_form"><input type="file" id="slide_content'.$n.'" name="slide_content[]" /><img src=../'.$arr[$i]['slide_content_thumb'].' >
				<input type="hidden" name="slide_content_thumb[]" id="slide_content_thumb'.$n.'" value="'.$arr[$i]['slide_content_thumb'].'">
				<input type="hidden" name="slide_content_image[]" id="slide_content_image'.$n.'" value="'.$arr[$i]['slide_content'].'">
				</td>
				</tr>
				<tr>
				<td width="40%" align="left" class="content_form">
				Caption:</td>
				<td width="66%" class="content_form" >
				<textarea style="width: 381px; height: 94px;" name="slide_caption[]" id="slide_caption'.$n.'">'.$arr[$i]['slide_caption'].'</textarea><td></tr><tr>
				<td width="34%" align="left" class="content_form">
				Url:</td>
				<td width="66%" class="content_form" >';

				if($Err->messages['slide_url'.$n.'']!='')
				{
				$output.='<input type="text" id="slide_url'.$n.'" name="slide_url[]"  value='.$Err->values['slide_url'][$i].' >
				<br/><p class="red">'.$Err->messages['slide_url'.$n.''].'</p><td>';

				}
				else
				{	
				$output.='<input type="text" id="slide_url'.$n.'" name="slide_url[]"  value="'.$arr[$i]['slide_url'].'" >
				<td>';
				}
				$output.='</tr></table></div><input type="hidden" name="theValue[]" id="theValue'.$n.'" value="'.$n.'">';
				}	
		
	
			}
	
		$output.='</div>';
		}
		
			
		return $output;
	}
	
	/**
	 * Function creates a template for displaying the home page url available. 
	 * @param array $arr	 
	 * @return string
	 */	
	
	function homePageBannerUrl($arr)
	{
	$output='<tr>
          <td width="34%" align="left" class="content_form">
	      Caption:</td>
		   <td width="66%" class="content_form" >
		  <textarea style="width: 182px; height: 60px;" name="caption"></textarea><td></tr>';
		   return $output;
	}

	/**
	 * Function creates a template for displaying the home page slide show parameter . 
	 * @param array $records	 
	 * @return string
	 */	
	
	function showSlideParameter($records)
	{


		$parameter=json_decode($records[0]['parameter']);


		$output='<tr>
			<td><table width="215" cellspacing="0" cellpadding="0" border="0">
			<tr>
			<td><table width="215" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td colspan="2"><img src="images/left_stat_top.gif" alt="" width="215" height="4" /></td>
			</tr>
			<tr>
				<td width="50" align="center" class="content_left_bg"><img src="images/ico_orders.jpg" alt="" width="30" height="34" /></td>
				<td width="165" align="left" class="content_left_bg"><span class="site_statistics_txt1">Slide Show Setup</span></td>
			</tr>
			<tr>
				<td colspan="2" align="center" class="content_left_bdr"><table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
				<td width="55%" align="left" class="site_stat_txt1">Slideshow Height</td>
				<td width="5%" align="left" class="site_stat_txt2">:</td>
				<td width="40%" align="left" class="site_stat_txt3"><input type="text" name="slideshowheight" id="slideshowheight" style="width:80%" value="'.$parameter->slideshowheight.'"></td>
				</tr>
				<tr>
				<td align="left" class="site_stat_txt1">Image Alignment</td>
				<td align="left" class="site_stat_txt2">:</td>
				<td align="left" class="site_stat_txt3"><select style="width:80%" name="imagealignment">';
				$imagealignment=array('topLeft','topCenter','topRight','centerLeft','center','centerRight','bottomLeft','bottomCenter','bottomRight');
				
				for($k=0;$k<count($imagealignment);$k++)
				{
					if($imagealignment[$k]==$parameter->imagealignment)
					{
						$selected='selected';
					}
					else
					{
						$selected='';
					}
					$output.='<option value='.$imagealignment[$k].' '.$selected.'> '.$imagealignment[$k].'</option>';
				}	

					
				$output.='</select></td></tr>
							
				<tr>
				<td align="left" class="site_stat_txt1">Auto Advance</td>
				<td align="left" class="site_stat_txt2">:</td>
				<td align="left" class="site_stat_txt3"><select style="width:80%" name="autoAdvance">';

				$selectautoplay_true = ($parameter->autoAdvance=="true")?"selected=selected":"";
				$selectautoplay_false = ($parameter->autoAdvance=="false")?"selected=selected":"";

				$output.='<option value="true" '.$selectautoplay_true.'> Enable</option><option value="false" '.$selectautoplay_false.'>Disable</option></select></td>
				</tr>';

               
				$output.='<tr>
				<td align="left" class="site_stat_txt1">Transaction Effect</td>
				<td align="left" class="site_stat_txt2">:</td>
				<td align="left" class="site_stat_txt3"><select style="width:80%" name="transactioneffect">';

				$transactioneffect=array('random','simpleFade', 'curtainTopLeft', 'curtainTopRight', 'curtainBottomLeft', 'curtainBottomRight', 'curtainSliceLeft', 'curtainSliceRight', 'blindCurtainTopLeft', 'blindCurtainTopRight', 'blindCurtainBottomLeft', 'blindCurtainBottomRight', 'blindCurtainSliceBottom', 'blindCurtainSliceTop', 'stampede', 'mosaic', 'mosaicReverse', 'mosaicRandom', 'mosaicSpiral', 'mosaicSpiralReverse', 'topLeftBottomRight', 'bottomRightTopLeft', 'bottomLeftTopRight', 'bottomLeftTopRight');	


				for($l=0;$l<count($transactioneffect);$l++)
				{

					if($transactioneffect[$l]==$parameter->transactioneffect)
					{
						$selected='selected';
			
					}
					else
					{

						$selected='';
					}
					$output.='<option value='.$transactioneffect[$l].' '.$selected.'> '.$transactioneffect[$l].'</option>';

				}

				$output.='</tr>
		
				
		
		
				<tr>
				<td align="left" class="site_stat_txt1">Sliced Columns</td>
				<td align="left" class="site_stat_txt2">:</td>
				<td align="left" class="site_stat_txt3"><input type="text" name="slicedcolumns" id="slicedcolumns" style="width:80%" value="'.$parameter->slicedcolumns.'"></td>
				</tr>
		
					<tr>
				<td align="left" class="site_stat_txt1">Sliced Rows</td>
				<td align="left" class="site_stat_txt2">:</td>
				<td align="left" class="site_stat_txt3"><input type="text" name="slicedrows" id="time" style="width:80%" value="'.$parameter->slicedrows.'"></td>
				</tr>
		
				<tr>
				<td align="left" class="site_stat_txt1">Easing Effect</td>
				<td align="left" class="site_stat_txt2">:</td>
				<td align="left" class="site_stat_txt3"><select style="width:80%" name="easingeffect">';

				$easing=array('linear','easeInExpo','easeOutExpo','easeInOutExpo','easeInCirc','easeInOutCirc','easeInElastic','easeOutElastic','easeInOutElastic','easeInBack','easeOutBack','easeInOutBack','easeInBounce','easeOutBounce','easeInOutBounce');

				for($m=0;$m<count($easing);$m++)
				{
					if($easing[$m]==$parameter->easingeffect)
					{
						$selected='selected';
					}
					else
					{
						$selected='';
					}
				$output.='<option value='.$easing[$m].' '.$selected.'> '.$easing[$m].'</option>';
				}
			
				
				$output.='</select></td>
				</tr>
		
				<tr>
				<td align="left" class="site_stat_txt1">Sliding Time(ms)</td>
				<td align="left" class="site_stat_txt2">:</td>
				<td align="left" class="site_stat_txt3"><input type="text" name="slidingtime" id="slidingtime" style="width:80%" value="'.$parameter->slidingtime.'"></td>
				</tr>
					<tr>
				<td align="left" class="site_stat_txt1">Sliding Effect Time</td>
				<td align="left" class="site_stat_txt2">:</td>
				<td align="left" class="site_stat_txt3"><input type="text" name="slidingeffecttime" id="slidingeffecttime" style="width:80%" value="'.$parameter->slidingeffecttime.'"></td>
				</tr>
			
				</table></td>
				</tr>
				<tr>
				<td colspan="2"><img src="images/left_stat_bot.gif" alt="" width="215" height="4" /></td>
				</tr>
				</table> </td>
				</tr><tr>
				<td><table width="215" border="0" cellspacing="0" cellpadding="0">
				<tr>
				<td colspan="2"><img src="images/left_stat_top.gif" alt="" width="215" height="4" /></td>
				</tr>
				<tr>
				<td width="50" align="center" class="content_left_bg"><img src="images/ico_orders.jpg" alt="" width="30" height="34" /></td>
				<td width="165" align="left" class="content_left_bg"><span class="site_statistics_txt1">Navigation </span></td>
				</tr>
				<tr>
				<td colspan="2" align="center" class="content_left_bdr"><table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
				<td width="55%" align="left" class="site_stat_txt1">Pagination</td>
				<td width="5%" align="left" class="site_stat_txt2">:</td>
				<td width="40%" align="left" class="site_stat_txt3"><select style="width:80%" name="pagination">';


				$selectpag_true = ($parameter->pagination=="true")?"selected=selected":"";
				$selectpag_false = ($parameter->pagination=="false")?"selected=selected":"";

				$output.='<option value="true" '.$selectpag_true.'
				>Bullets</option><option value="false" '.$selectpag_false.'>Disable Bullets</option></select></td>
				</tr>';


				
				$selectnav_true = ($parameter->navigationbuttons=="true")?"selected=selected":"";
				$selectnav_false = ($parameter->navigationbuttons=="false")?"selected=selected":"";
				$output.='<tr>
				<td align="left" class="site_stat_txt1">Navigation Buttons</td>
				<td align="left" class="site_stat_txt2">:</td>
				<td align="left" class="site_stat_txt3"><select style="width:80%" name="navigationbuttons"><option value="true" '.$selectnav_true.'> Enable</option><option value="false" '.$selectnav_false.'>Disable</option></select></td>
				</tr>';
					
				$select_shownav_true = ($parameter->shownavigation=="true")?"selected=selected":"";
				$select_shownav_false = ($parameter->shownavigation=="false")?"selected=selected":"";		
				$output.='<tr>
				<td align="left" class="site_stat_txt1">Show Navigation</td>
				<td align="left" class="site_stat_txt2">:</td>
				<td align="left" class="site_stat_txt3"><select style="width:80%" name="shownavigation"><option value="true" '.$select_shownav_true.'> Mouse Over</option><option value="false" '.$select_shownav_false.'> False</option></select></td>
				</tr>';

				$select_pause_true = ($parameter->pausebutton=="true")?"selected=selected":"";
				$select_pause_false = ($parameter->pausebutton=="false")?"selected=selected":"";
				$output.='<tr>
				<td align="left" class="site_stat_txt1">Play/Pause Button</td>
				<td align="left" class="site_stat_txt2">:</td>
				<td align="left" class="site_stat_txt3"><select style="width:80%" name="pausebutton"><option value="true" '.$select_pause_true.'> Enalbe</option><option value="false" '.$select_pause_false.'>False</option></select></td>
				</tr> ';


				
				$select_pauseclick_true = ($parameter->pauseonclick=="true")?"selected=selected":"";
				$select_pauseclick_false = ($parameter->pauseonclick=="false")?"selected=selected":"";                
				$output.='<tr>
				<td align="left" class="site_stat_txt1">Pause on Click</td>
				<td align="left" class="site_stat_txt2">:</td>
				<td align="left" class="site_stat_txt3"><select style="width:80%" name="pauseonclick"><option value="true" '.$select_pauseclick_true.'> Yes</option><option value="false" '.$select_pauseclick_false.'>No</option></select></td>
				</tr>';
		
				$select_pasueonhover_true = ($parameter->pasueonhover=="true")?"selected=selected":"";
				$select_pasueonhover_false = ($parameter->pasueonhover=="false")?"selected=selected":"";   
				$output.='<tr>
				<td align="left" class="site_stat_txt1">Pause on Hover</td>
				<td align="left" class="site_stat_txt2">:</td>
				<td align="left" class="site_stat_txt3"><select style="width:80%" name="pasueonhover" '.$select_pasueonhover_true.'><option value="true"> Yes</option><option value="false" '.$select_pasueonhover_false.'>No</option></select></td>
				</tr>';
		
				$select_timertype_pie = ($parameter->timertype=="pie")?"selected=selected":"";
				$select_timertype_bar = ($parameter->timertype=="bar")?"selected=selected":"";  
				$select_timertype_none = ($parameter->timertype=="none")?"selected=selected":"";  
				$output.='<tr>
				<td align="left" class="site_stat_txt1">Timer Type</td>
				<td align="left" class="site_stat_txt2">:</td>
				<td align="left" class="site_stat_txt3"><select style="width:80%" name="timertype" onChange="selecttimerparam(this.value,\''.$parameter->timertype.'\');"><option value="pie" '.$select_timertype_pie.'> Pie</option><option value="bar" '.$select_timertype_bar.'>Bar</option><option value="none" '.$select_timertype_none.'>None</option></td>
				</tr>';
	
				$output.='<tr>
				<td align="left" class="site_stat_txt1">Timer Color</td>
				<td align="left" class="site_stat_txt2">:</td>
				<td align="left" class="site_stat_txt3"><input type="text" name="timercolor" id="timercolor" value='.$parameter->timercolor.' style="width:80%"></td>
				</tr>
		
				<tr>
				<td align="left" class="site_stat_txt1">Timer BgColor</td>
				<td align="left" class="site_stat_txt2">:</td>
				<td align="left" class="site_stat_txt3"><input type="text" name="timerbgcolor" id="timerbgcolor" value='.$parameter->timerbgcolor.' style="width:80%"></td>
				</tr>';

				if($parameter->timertype=='pie')
				{
					$output.='<table style="display:block;" id="pie_diameter_value" >
					<tr>
					<td align="left" class="site_stat_txt1" style="width:100px">Pie Diameter</td>
					<td align="left" class="site_stat_txt2">:</td>
					<td align="left" class="site_stat_txt3"><input type="text" name="piediameter" id="piediameter" style="width:80%" value='.$parameter->piediameter.'></td>
					</tr>';

					$select_piepos_rtop = ($parameter->pieposition=="rightTop")?"selected=selected":"";
					$select_piepos_rbot = ($parameter->pieposition=="rightBottom")?"selected=selected":""; 	
					$select_piepos_ltop = ($parameter->pieposition=="leftTop")?"selected=selected":"";
					$select_piepos_lbot = ($parameter->pieposition=="leftBottom")?"selected=selected":""; 
	
					$output.='<tr >
					<td align="left" class="site_stat_txt1" >Pie Position</td>
					<td align="left" class="site_stat_txt2">:</td>
					<td align="left" class="site_stat_txt3"><select style="width:80%" name="pieposition"><option value="rightTop" '.$select_piepos_rtop.'> Right Top</option><option value="rightBottom" '.$select_piepos_rbot.'> Right Bottom</option><option value="leftTop" '.$select_piepos_ltop.'> Left Top</option><option value="leftBottom" '.$select_piepos_lbot.'> Left Bottom</option></select></td>
					</tr></table>';
				}
				
				if($parameter->timertype=='bar')
				{
					$output.='<table style="display:block;" id="timer_bar_value" >';
					$select_timpos_top = ($parameter->timerbarposition=="top")?"selected=selected":"";
					$select_timpos_bot = ($parameter->timerbarposition=="bottom")?"selected=selected":""; 	
					$select_timpos_left = ($parameter->timerbarposition=="right")?"selected=selected":"";
					$select_timpos_right = ($parameter->timerbarposition=="left")?"selected=selected":""; 
					$output.='<tr >
					<td align="left" class="site_stat_txt1" style="width:100px">Timer Bar Position</td>
					<td align="left" class="site_stat_txt2">:</td>
					<td align="left" class="site_stat_txt3"><select style="width:80%" name="timerbarposition"><option value="top" '.$select_timpos_top.'>Top</option><option value="bottom" '.$select_timpos_bot.'> Bottom</option><option value="right" '.$select_timpos_right.'> Right</option><option value="left" '.$select_timpos_left.'> Left</option></select></td>
					</tr>';
	
					$select_timbardir_lr = ($parameter->timerbardirections=="leftToRight")?"selected=selected":"";
					$select_timbardir_rl = ($parameter->timerbardirections=="rightToLeft")?"selected=selected":""; 	
					$select_timbardir_tb = ($parameter->timerbardirections=="topToBottom")?"selected=selected":"";
					$select_timbardir_bt = ($parameter->timerbardirections=="bottomToTop")?"selected=selected":""; 
		
					$output.='	<tr >
					<td align="left" class="site_stat_txt1">Timer Bar Direction</td>
					<td align="left" class="site_stat_txt2">:</td>
					<td align="left" class="site_stat_txt3"><select style="width:80%" name="timerbardirections"><option value="leftToRight" '.$select_timbardir_lr.'>Left to Right </option><option value="rightToLeft" '.$select_timbardir_rl.'> Right to Left Bottom</option><option value="topToBottom" '.$select_timbardir_tb.'> Top To Bottom</option><option value="bottomToTop" '.$select_timbardir_bt.'>Bottomt to Top</option></select></td>
					</tr>
					<table>';

				}
				$output.='<table id="pie_diameter" style="display:none;">
				<tr>
				<td align="left" class="site_stat_txt1" style="width:100px">Pie Diameter</td>
				<td align="left" class="site_stat_txt2">:</td>
				<td align="left" class="site_stat_txt3"><input type="text" name="piediameter" id="piediameter" style="width:80%" value='.$parameter->piediameter.'></td>
				</tr>';
				$select_piepos_rtop = ($parameter->pieposition=="rightTop")?"selected=selected":"";
				$select_piepos_rbot = ($parameter->pieposition=="rightBottom")?"selected=selected":""; 	
				$select_piepos_ltop = ($parameter->pieposition=="leftTop")?"selected=selected":"";
				$select_piepos_lbot = ($parameter->pieposition=="leftBottom")?"selected=selected":""; 
				$output.='<tr >
				<td align="left" class="site_stat_txt1" >Pie Position</td>
				<td align="left" class="site_stat_txt2">:</td>
				<td align="left" class="site_stat_txt3"><select style="width:80%" name="pieposition"><option value="rightTop" '.$select_piepos_rtop.'> Right Top</option><option value="rightBottom" '.$select_piepos_rbot.'> Right Bottom</option><option value="leftTop" '.$select_piepos_ltop.'> Left Top</option><option value="leftBottom" '.$select_piepos_lbot.'> Left Bottom</option></select></td>
				</tr></table>';
				
				$output.='<table id="timer_bar" style="display:none;">';
				$select_timpos_top = ($parameter->timerbarposition=="top")?"selected=selected":"";
				$select_timpos_bot = ($parameter->timerbarposition=="bottom")?"selected=selected":""; 	
				$select_timpos_left = ($parameter->timerbarposition=="right")?"selected=selected":"";
				$select_timpos_right = ($parameter->timerbarposition=="left")?"selected=selected":""; 
				$output.='<tr >
				<td align="left" class="site_stat_txt1" style="width:100px">Timer Bar Position</td>
				<td align="left" class="site_stat_txt2">:</td>
				<td align="left" class="site_stat_txt3"><select style="width:80%" name="timerbarposition"><option value="top" '.$select_timpos_top.'>Top</option><option value="bottom" '.$select_timpos_bot.'> Bottom</option><option value="right" '.$select_timpos_right.'> Right</option><option value="left" '.$select_timpos_left.'> Left</option></select></td>
				</tr>';

				$select_timbardir_lr = ($parameter->timerbardirections=="leftToRight")?"selected=selected":"";
				$select_timbardir_rl = ($parameter->timerbardirections=="rightToLeft")?"selected=selected":""; 	
				$select_timbardir_tb = ($parameter->timerbardirections=="topToBottom")?"selected=selected":"";
				$select_timbardir_bt = ($parameter->timerbardirections=="bottomToTop")?"selected=selected":""; 
	
				$output.='	<tr >
				<td align="left" class="site_stat_txt1">Timer Bar Direction</td>
				<td align="left" class="site_stat_txt2">:</td>
				<td align="left" class="site_stat_txt3"><select style="width:80%" name="timerbardirections"><option value="leftToRight" '.$select_timbardir_lr.'>Left to Right </option><option value="rightToLeft" '.$select_timbardir_rl.'> Right to Left Bottom</option><option value="topToBottom" '.$select_timbardir_tb.'> Top To Bottom</option><option value="bottomToTop" '.$select_timbardir_bt.'>Bottomt to Top</option></select></td>
				</tr>
				<table>';

				$output.='</table></td>
				</tr>
				<tr>
				<td colspan="2"><img src="images/left_stat_bot.gif" alt="" width="215" height="4" /></td>
				</tr>
				</table> </td>
				</tr><tr>
				<td><table width="215" border="0" cellspacing="0" cellpadding="0">
				<tr>
				<td colspan="2"><img src="images/left_stat_top.gif" alt="" width="215" height="4" /></td>
				</tr>
				<tr>
				<td width="50" align="center" class="content_left_bg"><img src="images/ico_orders.jpg" alt="" width="30" height="34" /></td>
				<td width="165" align="left" class="content_left_bg"><span class="site_statistics_txt1">Thumbs </span></td>
				</tr>';

				$select_thumbnail_tr = ($parameter->thumbnails=="true")?"selected=selected":"";
				$select_thumbnail_false = ($parameter->thumbnails=="false")?"selected=selected":""; 
				$output.='<tr>
				<td colspan="2" align="center" class="content_left_bdr"><table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
				<td width="55%" align="left" class="site_stat_txt1">Thumbnails</td>
				<td width="5%" align="left" class="site_stat_txt2">:</td>
				<td width="40%" align="left" class="site_stat_txt3"><select style="width:80%" name="thumbnails"><option value="true" '.$select_thumbnail_tr.'>Enable</option><option value="false" '.$select_thumbnail_false.'>Disable</option></select></td>
				</tr>
				
				</table></td>
				</tr>
				<tr>
				<td colspan="2"><img src="images/left_stat_bot.gif" alt="" width="215" height="4" /></td>
				</tr>
				</table> </td>
				</tr>';

		return $output;
	}
}
?>