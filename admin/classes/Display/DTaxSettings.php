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
 * This class contains functions to display tax settings related process
 *
 * @package  		Display_DTaxSettings
 * @category  		Display
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
  * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */
class Display_DTaxSettings
{

	/**
	 * Function  to  display the tax settings
	 * @param array $arr
	 * @param array $uniqarr
	 * @return string
	 */	
	function showTaxSettings($arr,$uniqarr)
	{
		
		$output = '

		<div class="tabbable tabbable-bordered">
		<ul class="nav nav-tabs">
		<li class="active"><a href="#tb1_a" data-toggle="tab">Type 1</a></li>
		<li><a href="#tb1_b" data-toggle="tab">Type 2</a></li>
		<li><a href="#tb1_c" data-toggle="tab">Type 3</a></li>
		</ul>
		<div class="tab-content">
		<div class="tab-pane active" id="tb1_a">
		<div class="ibutton-group">
		<div class="row-fluid">
		<div class="span12">
		<label>I don\'t want to apply tax to any products in my store</label><input name="TaxSetting" class="sb_ch1 {labelOn: \'Excel\', labelOff: \'OFF\'}" id="taxtype1" value="'.$arr[0]['id'].'"  type="radio" '.(($arr[0]['status']==1) ? 'checked="checked"' : '' ).' onclick="document.getElementById(\'SingleTaxDiv\').style.display=\'none\';document.getElementById(\'ifrmdiv\').style.display=\'none\'"> </div></div>
		</div></div>
		<div class="tab-pane" id="tb1_b">
		<div class="ibutton-group">
		<div class="row-fluid">
		<div class="span12">
		<label> I want to apply tax for specific countries and/or states</label>
		<input name="TaxSetting" id="taxtype2" value="'.$arr[1]['id'].'"  '.(($arr[1]['status']==1) ? 'checked="checked"' : '' ).'  type="radio" > </div>
		</div></div>

		<iframe src="?do=taxsettings&action=showregionwisetaxlist" style="border:none;" width="100%" height="500px;" ></iframe>
		</div>
		<div class="tab-pane" id="tb1_c">
		<div class="ibutton-group">
		<div class="row-fluid">
		<div class="span12">
		<label>I want to apply one tax rate to all products in my store</label>
		<input name="TaxSetting" id="taxtype3" value="'.$arr[2]['id'].'"   type="radio" onclick="document.getElementById(\'SingleTaxDiv\').style.display=\'block\';document.getElementById(\'ifrmdiv\').style.display=\'none\';" '.(($arr[2]['status']==1) ? 'checked="checked"' : '' ).' > 
		</div>
		</div></div>


		<table cellspacing="0" cellpadding="0" border="0" style="width: 100%; margin-top: 5px; " id="SingleTaxDiv" class="content_form" >
		<tbody><tr>
		<td width="10%">&nbsp;							</td>
		<td width="90%" align="left" valign="top">
		<table border="0">
		<tbody><tr>
		<td><!--<img alt="" src="images/nodejoin.gif"/>--></td>
		<td nowrap="nowrap" align="left" width="100"><label >Tax Rate Name:</label></td>
		<td>
		<input type="text"  value="'.$uniqarr[0]['tax_name'].'" id="SingleTaxRateName" name="SingleTaxRateName"/>


		</td>
		</tr>
		<tr>
		<td> </td>
		<td align="left">
		<label >Tax Rate:</label>
		</td>
		<td align="left" valign="top">
		<input type="text" value="'.$uniqarr[0]['tax_rate_percent'].'" id="SingleTaxRate" name="SingleTaxRate"  style="width:40px;"/> <code>(%)</code>

		</td>
		</tr>
		<tr>
		<td> </td>
		<td>
		Based On:
		</td>
		<td>
		<select id="SingleTaxRateBasedOn" name="SingleTaxRateBasedOn" style="width:146px;">
		<option value="subtotal" '.(($uniqarr[0]['based_on_amount']=='subtotal') ? ' selected="selected" ' : '' ).' >Subtotal</option>
		<option value="subtotal_and_shipping" '.(($uniqarr[0]['based_on_amount']=='subtotal_and_shipping') ? ' selected="selected" ' : '' ).' >Subtotal + Shipping</option>
		</select>


		</td>
		</tr>									
			
		</tbody></table>
		</td>
		</tr>
		</tbody></table>
		</div>
		</div>
		</div>

		';
		

		return $output;

	}
	/**
	 * Function  to display   the  country wise tax list
	 * @param array $result
	 * @param integer $paging
	 * @param integer $prev	 
	 * @param integer $next
	 * @return string
	 */	
	function showCountrywiseTaxList($result,$paging,$prev,$next)
	{

		
		$output = ' <a href="?do=taxsettings&amp;action=addregionwisetax" class="add_link">Add Tax Rate </a>
		<table cellspacing="0" cellpadding="0" border="0"  class="table table-striped table-bordered  table-hover">
		
		<thead class="green_bg">
		<tr>
		
		<th  align="left">Tax Name</th>
		<th  align="left">Tax Rate</th>
		<th  align="left">Applied To</th>
		<th  align="left" width="2%">Status</th>
		<th colspan="2" width="10%"  align="center">Action</th>
		
		</tr>
		</thead>
		<tbody>';


		foreach ($result as $arr)
		{
			$output.='<tr ><td >'.$arr['tax_name'].'</td><td>'.$arr['tax_rate_percent'].' %</td><td style="padding-left: 10px;" align="left">'.( ($arr['country_code']=='' || $arr['country_code']=='all') ?  'All Countries' : $arr['cou_name']).'</td><td class="content_list_txt1" style="padding: 5px; width: 20px;" align="center"><span '.(($arr['status']==1) ? ' class="active_link" title="Active" ' : ' class="inactive_link" title="Inactive" ' ).'" /></td><td ><a class="edit_bttn" href="?do=taxsettings&action=editregionwisetax&taxid='.$arr['id'].'">Edit</a></td> <td> <a class="delete_bttn" onclick="return confirm(\'Do you want to delete\');" href="?do=taxsettings&action=deleteregionwisetax&taxid='.$arr['id'].'">Delete</a></td>
			</tr>';
		}

		$output.='<tr>
		<td colspan="6" class="clsAlignRight">
		<div class="dt-row dt-bottom-row">
		<div class="row-fluid">
		<div class="dataTables_paginate paging_bootstrap pagination">
		<ul> ';

		for($i=1;$i<=count($paging);$i++)
			$pagingvalues .= $paging[$i]."  ";
		$output .= $pagingvalues.' '.$next;

		$output .='</ul></div>
		</div>
		</div>
		</td>
		</tr>   </tbody>
		</table>';
		

		return $output;

	}
	/**
	 * Function  to display   the  add country wise tax 
	 * @param array $countryarr
	 * @param array $Err
	 * @return string
	 */	
	function addCountrywiseTax($countryarr,$Err)
	{
		if(count($Err->messages) > 0)
		{
			$values = $Err->values;
			$messages = $Err->messages;
		}
		
		$countrylist='<select size="5" name="taxratecountry" id="taxratecountry"   onchange="" style="width:180px;">';
		//$countrylist.='<option selected="selected" value="all">-- All Countries --</option>';
		foreach($countryarr as $country)
			$countrylist.='<option value="'.$country['cou_code'].'" '.(($values['taxratecountry']==$country['cou_code']) ? ' selected ="selected" ' : '' ).'>'.$country['cou_name'].'</option>';
		$countrylist.='</select>';
		
		$output = '<div class="row-fluid">
		<div class="span12"><h2 class="box_head green_bg">Regionwise Tax Rates</h2>
		<div class="toggle_container">
		<div class="clsblock">
		<div class="clearfix"><form  name="sam" action="?do=taxsettings&action=insertregionwisetax" method="post">
		<div class="row-fluid">
		<div class="span6"><label>
		Tax Name<span style="color:#FF0000">*</span></label>
		<input name="taxratename" id="taxratename"   value="'.$values['taxratename'].'" type="text" style="width:178px;"><br><span style="color:#FF0000">'.$messages['taxratename'].'</span></div></div>
		<div class="row-fluid">
		<div class="span6"><label>
		Apply Tax to <span  style="color:#FF0000">*</span>&nbsp;</label>

		<select name="taxratebasedon" id="taxratebasedon"   style="width:180px;">
		<option value="subtotal" '.(($values['taxratebasedon']=='subtotal') ? ' selected ="selected" ' : '' ).' >Subtotal</option>
		<option value="subtotal_and_shipping" '.(($values['taxratebasedon']=='subtotal_and_shipping') ? ' selected ="selected" ' : '' ).' >Subtotal + Shipping</option>
		</select><br><span style="color:#FF0000">'.$messages['taxratebasedon'].'</span>							</div></div>
		<div class="row-fluid">
		<div class="span6"><label>Apply To<span  style="color:#FF0000">*</span>&nbsp;</label>
		'.$countrylist.'<br><span style="color:#FF0000">'.$messages['taxratecountry'].'</span>		</div></div>
		<div class="row-fluid">
		<div class="span6"><label>Charge tax on <span  style="color:#FF0000">*</span>&nbsp;</label>
		
		<select name="taxaddress" id="taxaddress"   style="width:180px;">
		<option value="billing" '.(($values['taxaddress']=='billing') ? ' selected ="selected" ' : '' ).' >Billing Address</option>
		<option value="shipping" '.(($values['taxaddress']=='shipping') ? ' selected ="selected" ' : '' ).' >Shipping Address</option>
		</select><br><span style="color:#FF0000">'.$messages['taxaddress'].'</span>								</div></div>
		<div class="row-fluid">
		<div class="span6"><label>Tax Rate<span  style="color:#FF0000">*</span>&nbsp;</label>
		
		<input name="taxratepercent" id="taxratepercent"  value="'.$values['taxratepercent'].'" type="text" style="width:60px;">&nbsp;<code>%</code><br><span style="color:#FF0000">'.$messages['taxratepercent'].'</span>							</div></div>
		<div class="row-fluid">
		<div class="span6"><label>Status<span  style="color:#FF0000">*</span>&nbsp;</label>
		
		<input  name="taxratestatus" id="taxratestatus" type="checkbox" value="1" '.(($values['taxratestatus']==1) ? ' checked="checked" ' : '' ).'></div></div><br/>
		<div class="row-fluid">
		<div class="span6">
		<label><input name="SubmitButton2" value="Add Tax Rate"  type="submit" class="clsBtn"></label>
		</div></div>
		</form>
		</div></div></div></div></div>';	

		return $output;
	}
	/**
	 * Function  to display   the  edit country wise tax 
	 * @param array $arr
	 * @param array $countryarr
	 * @param array $Err
	 * @return string
	 */	
	function editCountrywiseTax($arr,$countryarr,$Err)
	{
		if(count($Err->messages) > 0)
		{
			$values = $Err->values;
			$messages = $Err->messages;
		}
		else
			$values =$arr[0];
		
		$countrylist='<select size="15" name="taxratecountry" id="taxratecountry"   onchange="" style="width:180px;">';
		//$countrylist.='<option selected="selected" value="all">-- All Countries --</option>';
		foreach($countryarr as $country)
			$countrylist.='<option value="'.$country['cou_code'].'" '.(($values['taxratecountry']==$country['cou_code']) ? ' selected ="selected" ' : '' ).'>'.$country['cou_name'].'</option>';
		$countrylist.='</select>';
		
		$output = '<form  name="sam" action="?do=taxsettings&action=updateregionwisetax" method="post"><table width="60%" border="0" cellspacing="0" cellpadding="0" align="center"><tr>
		<td  colspan="3" align="right"><input type="hidden" name="taxid" value="'.$values['id'].'"><font color="red"> * Required Fields</font></td>
		</tr>
		<tr>
		<td width="166" class="content_form" >
		Tax Name<span style="color:#FF0000">*</span>&nbsp;							</td>
		<td width="66" class="content_form" >:</td>
		<td width="293" class="">

		<input name="taxratename" id="taxratename"   value="'.$values['taxratename'].'" type="text" style="width:178px;"><br><span style="color:#FF0000">'.$messages['taxratename'].'</span>							</td>
		</tr>
		<tr>
		<td  class="content_form">Apply Tax to <span  style="color:#FF0000">*</span>&nbsp;</td>

		<td  class="content_form">: </td>
		<td class="">
		<select name="taxratebasedon" id="taxratebasedon"   style="width:180px;">
		<option value="subtotal" '.(($values['taxratebasedon']=='subtotal') ? ' selected ="selected" ' : '' ).' >Subtotal</option>
		<option value="subtotal_and_shipping" '.(($values['taxratebasedon']=='subtotal_and_shipping') ? ' selected ="selected" ' : '' ).' >Subtotal + Shipping</option>
		</select><br><span style="color:#FF0000">'.$messages['taxratebasedon'].'</span>							</td>
		</tr>
		<tr>
		<td  class="content_form">Apply To<span  style="color:#FF0000">*</span>&nbsp;</td>
		<td  class="content_form">: </td>
		<td class="">'.$countrylist.'<br><span style="color:#FF0000">'.$messages['taxratecountry'].'</span></td>
		</tr>

		<tr>
		<td class="content_form" >Charge tax on <span  style="color:#FF0000">*</span>&nbsp;</td>
		<td  class="content_form">: </td>
		<td class="">
		<select name="taxaddress" id="taxaddress"   style="width:180px;">
		<option value="billing" '.(($values['taxaddress']=='billing') ? ' selected ="selected" ' : '' ).' >Billing Address</option>
		<option value="shipping" '.(($values['taxaddress']=='shipping') ? ' selected ="selected" ' : '' ).' >Shipping Address</option>
		</select><br><span style="color:#FF0000">'.$messages['taxaddress'].'</span>								</td>
		</tr>
		<tr>
		<td  class="content_form">Tax Rate<span  style="color:#FF0000">*</span>&nbsp;</td>
		<td  class="content_form">: </td>
		<td class="">
		<input name="taxratepercent" id="taxratepercent"  value="'.$values['taxratepercent'].'" type="text" style="width:60px;">%<br><span style="color:#FF0000">'.$messages['taxratepercent'].'</span>							</td>
		</tr>
		<tr>
		<td  class="content_form">Status<span  style="color:#FF0000">*</span>&nbsp;</td>
		<td  class="content_form">: </td>
		<td class="">
		<input  name="taxratestatus" id="taxratestatus" type="checkbox" value="1" '.(($values['taxratestatus']==1) ? ' checked="checked" ' : '' ).'> <label for="taxratestatus">Enable Tax Rate </label></td>
		</tr>
		<tr>
		<td colspan="2"  class="content_form">&nbsp;</td>
		<td class="content_form">
		<input name="SubmitButton2" value="Add Tax Rate"  type="submit" class="all_bttn">
		</td>
		</tr>
		<tr><td colspan="3"  all_bttn>&nbsp;</td></tr>

		</table></form>
		';	

		return $output;
	}
}


?>