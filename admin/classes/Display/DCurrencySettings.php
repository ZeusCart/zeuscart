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

/**
 * DCurrencySettings
 *
 * This class contains functions to list out the currency list available.
 *
 * @package		Display_DCurrencySettings
 * @category	Display
 * @author		ZeusCart Team
 * @link		http://www.zeuscart.com
 * @version 	2.3
 */

// ------------------------------------------------------------------------


class Display_DCurrencySettings
{
	
	
	/**
	 * Function returns the list of currency list available. 
	 * @param array $result
	 * @param integer $paging
	 * @param integer $prev	 
	 * @param integer $next	 
	 * @return string
	 */
	 
	function showCurrencyList($result,$paging,$prev,$next)
	{
		//echo "<pre>";
		//print_r($result);
		
		foreach ($result as $rows)
		{
			if ($rows['default_currency']==1)
				$currencytocken=$rows['currency_tocken'];
		}
		
		$output = '<table class="content_list_bdr" cellspacing="0" border="0" width="100%">
	<tr><td width="300" class="content_list_head">Currency Name</td>
	<td width="180" class="content_list_head">Currency Code</td>
	<td width="120" class="content_list_head">Conversion Rate</td>
	<td width="264" class="content_list_head">Applied To</td>
	<td width="50" class="content_list_head">Status</td>
	<td width="50" class="content_list_head">&nbsp;</td>
	<td width="50" class="content_list_head">&nbsp;</td>
	</tr>';
	
	
	foreach ($result as $arr)
	{
		$output.='<tr onmouseover="listbg(this, 1);" onmouseout="listbg(this, 0);" style="background-color: rgb(255, 255, 255);"><td style="padding: 5px; " class="content_list_txt1" align="left">'.$arr['currency_name'].(($arr['default_currency']==1) ? '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>(Default)</b>' : '' ).'</td><td class="content_list_txt1">'.$arr['currency_code'].'</td><td class="content_list_txt1" align="right">'.$arr['currency_tocken'].' '. number_format($arr['conversion_rate'],2).'</td><td style="padding-left: 10px;" class="content_list_txt1" align="left">'.( ($arr['country_code']=='' || $arr['country_code']=='all') ?  'All Countries' : $arr['cou_name']).'</td><td style="padding: 5px; width: 20px;" class="content_list_txt1" align="center"><span '.(($arr['status']==1) ? ' class="active_link" title="Active" ' : ' class="inactive_link" title="Inactive" ' ).'" /></td><td class="content_list_txt1"><a class="edit_bttn" href="?do=editcurrency&cid='.$arr['id'].'">&nbsp;</a></td>
	  <td class="content_list_txt1">';
	  if($arr['id']!=1)
	  $output.='<a class="delete_bttn" onclick="return confirm(\'Do you want to delete\');" href="?do=delcurrency&cid='.$arr['id'].'">&nbsp;</a>';
	  $output.='</td>
	</tr>';
	}
	
	$output.='<tr onmouseover="listbg(this, 1);" onmouseout="listbg(this, 0);" style="background-color: rgb(255, 255, 255);"></tr>
	
	<tr align="center"><td colspan="7" class="content_list_footer">  ';
	
	 for($i=1;$i<=count($paging);$i++)
				 $pagingvalues .= $paging[$i]."  ";
				 	 	$output .= $pagingvalues.' '.$next;
	
	$output .='   </td></tr>
</table>';
		
			
		return $output;
			
	}
	
	
	/**
	 * Function returns a template for adding the new currency. 
	 * @param array $countryarr
	 * @param array $Err
	 *
	 * @return string
	 */
	
	
	function addCurrency($countryarr,$Err)
	{
		if(count($Err->messages) > 0)
		{
			 $values = $Err->values;
			 $messages = $Err->messages;
		}
	$countrylist='<select name="taxratecountry" id="taxratecountry" style="width:180px;">';
		foreach($countryarr as $country)
			$countrylist.='<option value="'.$country['cou_code'].'" '.(($values['taxratecountry']==$country['cou_code']) ? ' selected ="selected" ' : '' ).'>'.$country['cou_name'].'</option>';
		$countrylist.='</select>';
		
		$output = '<form  name="sam" action="?do=taxsettings&action=insertregionwisetax" method="post"><table width="80%" border="0" cellspacing="0" cellpadding="0" align="center"><tr>
						  <td  colspan="6" align="right"><font color="red"> * Required Fields</font></td>
						</tr>
						<tr>
							<td width="119" class="content_form" align="left">
								Currency Name<span style="color:#FF0000">*</span>&nbsp;							</td>
							<td width="27" class="content_form" >:</td>
							<td width="261" class="content_form" ><input name="currency_name" id="currency_name"   value="'.$values['currency_name'].'" type="text" style="width:178px;">
							  <br>
						    <span style="color:#FF0000">'.$messages['currency_name'].'</span></td>
							<td width="146" class="content_form" align="left">Currency Code *&nbsp;</td>
						    <td width="40" class="content_form">: </td>
						    <td width="187" class="content_form">
						      <input name="currency_code" id="currency_code"   value="'.$values['currency_code'].'" type="text" style="width:178px;">
                              <br>
'.$messages['currency_code'].'</td>
						</tr>
						<tr>
							<td  class="content_form" align="left">Currency Tocken<span  style="color:#FF0000">*</span></td>

							<td  class="content_form">: </td>
							<td  class="content_form"><input name="currency_tocken" id="currency_tocken"  value="'.$values['currency_tocken'].'" type="text" style="width:60px;">
                              <br>
                              <span style="color:#FF0000">'.$messages['currency_tocken'].'</span></td>
							<td class="content_form">Conversion Rate *&nbsp;</td>
						    <td class="content_form">: </td>
						    <td class="content_form">
						      <input name="conversion_rate" id="conversion_rate"   value="'.$values['conversion_rate'].'" type="text" style="width:178px;">
                              <br>
'.$messages['conversion_rate'].' </td>
						</tr>
						
						
							<!--<tr>
								<td class="content_form" >&nbsp;</td>
								<td  class="content_form">&nbsp;</td>
								<td  class="content_form">&nbsp;</td>
								<td colspan="2" class="">&nbsp;</td>
							    <td class="">&nbsp;</td>
							</tr>-->
							<tr>
							<td  class="content_form" align="left">Country<span  style="color:#FF0000">*</span>&nbsp;</td>
							<td  class="content_form">: </td>
							<td  class="content_form">'.$countrylist.'<br>
						    <span style="color:#FF0000">'.$messages['taxratecountry'].'</span></td>
							<td colspan="2" class="">&nbsp;</td>
						    <td class="">&nbsp;</td>
						</tr>
						<!--<tr>
							<td  class="content_form">&nbsp;</td>
							<td  class="content_form">&nbsp;</td>
							<td  class="content_form">&nbsp;</td>
							<td colspan="2" class="">&nbsp;</td>
						    <td class="">&nbsp;</td>
						</tr>-->
						<tr>
							<td  class="content_form" align="left">Status Enable<span  style="color:#FF0000">*</span>&nbsp;</td>
							<td  class="content_form">: </td>
							<td  class="content_form"><input  name="taxratestatus" id="taxratestatus" type="checkbox" value="1" '.(($values['status']==1) ? ' checked="checked" ' : '' ).'>
                              <!--<label for="taxratestatus">Enable Currency </label>--></td>
							<td colspan="2" class=""><label for="taxratestatus"></label></td>
						    <td class="">&nbsp;</td>
						</tr>
						<tr>
							<td colspan="6"  class="content_form">
							  <div align="center">
							    <input name="SubmitButton2" value="Add Currency"  type="submit" class="all_bttn">															
					        </div></td>
						</tr>
						<!--<tr><td colspan="6"  all_bttn>&nbsp;</td></tr>-->
					 
					</table>
</form>
';	
			
		return $output;
	}
	
	
	/**
	 * Function returns a template for adding the new currency. 
	 * @param array $countryarr
	 * @param array $currencyarr
     * @param array $Err
	 *
	 * @return string
	 */
	
	function showAddCurrency($countryarr,$currencyarr,$Err)
	{
		if(count($Err->messages) > 0)
		{
			 $values = $Err->values;
			 $messages = $Err->messages;
		}
		//print_r($messages);
		//echo "<pre>";
		//print_r($countryarr);
			$currencycode='<select name="currency_code" id="currency_code" class="txt_box250">';
		//$countrylist.='<option selected="selected" value="all">-- All Countries --</option>';
		foreach($currencyarr as $currency)
		{
			$currencycode.='<option value="'.$currency['currency_code'].'" '.(($values['currency_code']==$currency['currency_code']) ? ' selected ="selected" ' : '' ).'>'.$currency['currency_name'];
			if($currency['country_name']!=''&&$currency['country_name']!=' ')
				$currencycode.='&nbsp;(<font size="-1">'.strtolower($currency['country_name']).'</font>)';
			$currencycode.='</option>';
		}
		$currencycode.='</select>';
		
		
			$countrylist='<select name="taxratecountry" id="taxratecountry">';
		//$countrylist.='<option selected="selected" value="all">-- All Countries --</option>';
		foreach($countryarr as $country)
			$countrylist.='<option value="'.$country['cou_code'].'" '.(($values['taxratecountry']==$country['cou_code']) ? ' selected ="selected" ' : '' ).'>'.$country['cou_name'].'</option>';
		$countrylist.='</select>';
		
		$output = '<form  name="sam" action="?do=addcurrency" method="post"><table width="100%" border="0" cellspacing="0" cellpadding="0" align="center"><tr>
						  <td  colspan="5" align="right"><font color="red"> * Required Fields</font></td>
						</tr>
						<tr>
							<td width="15%" class="content_form" ></td>
							<td width="20%" class="content_form" align="left">
								Currency Name<span style="color:#FF0000">*</span>&nbsp;							</td>
							<td width="5%" class="content_form" >:</td>
							<td width="25%" class="content_form" align="left"><input name="currency_name" id="currency_name"   value="'.$values['currency_name'].'" type="text" style="width:178px;"></td>
							 <td width="35%" class="content_form" align="left"><span style="color:#FF0000;font-size:11px">'.$messages['currency_name'].'</span></td>						</tr>
							
						<tr>
							<td>&nbsp;</td>
							<td  class="content_form" align="left">Currency Token<span  style="color:#FF0000">*</span></td>

							<td  class="content_form">: </td>
							<td  class="content_form" align="left"><input name="currency_tocken" id="currency_tocken"  value="'.$values['currency_tocken'].'" type="text" style="width:60px;"><img src="images/help.gif" onmouseover="ShowHelp(\'currtok\', \'Currency Tocken\', \'Enter currency token. Like $,Rs.\')" onmouseout="HideHelp(\'currtok\');">
			<div id="currtok" style="left: 50px; top: 50px;"></div>
                              </td>
                              <td align="left">
                              <span style="color:#FF0000;font-size:11px">'.$messages['currency_tocken'].'</span></td>
						</tr>
						<!--<tr>
								<td class="content_form" >&nbsp;</td>
								<td  class="content_form">&nbsp;</td>
								<td  class="content_form">&nbsp;</td>
								<td colspan="2" class="">&nbsp;</td>
							    <td>&nbsp;</td>
							</tr>-->
							<tr>
							<td>&nbsp;</td>
							<td  class="content_form" valign="top" align="left">Country<span  style="color:#FF0000">*</span>&nbsp;</td>
							<td  class="content_form" valign="top">: </td>
							<td  class="content_form" align="left">'.$countrylist.'
							</td>
                              <td align="left">
							   <span style="color:#FF0000;font-size:11px">'.$messages['taxratecountry'].'</span></td>
							 </tr>
							 <tr>
							 <td>&nbsp;</td>
							<td colspan="2" class="">&nbsp;</td>
						    <td class="">&nbsp;</td>
						</tr>
						 <tr>
							 <td>&nbsp;</td>
							<td  class="content_form" valign="top" align="left">Currency Code<span style="color:#FF0000">*</span>&nbsp;</td>
						    <td  class="content_form" valign="top">: </td>
						    <td class="content_form" align="left">
						     <!-- <input name="currency_code" id="currency_code"   value="'.$values['currency_code'].'" type="text" style="width:178px;">-->'.$currencycode.'</td>
                              <td align="left"><span style="color:#FF0000;font-size:11px">
'.$messages['currency_code'].'<span></td>
						</tr>
						
							<tr>
							<td>&nbsp;</td>
							<td class="content_form" align="left">Conversion Rate<span style="color:#FF0000">*</span>&nbsp;</td>
						    <td class="content_form">: </td>
						    <td class="content_form" align="left">
						      <input name="conversion_rate" id="conversion_rate"   value="'.$values['conversion_rate'].'" type="text" style="width:178px;"><img src="images/help.gif" onmouseover="ShowHelp(\'convrate\', \'Conversion Rate\', \'Enter conversion rate againt US dollars value.\')" onmouseout="HideHelp(\'convrate\');">
			<div id="convrate" style="left: 50px; top: 50px;"></div>
                             </td>
                              <td align="left"><span style="color:#FF0000;font-size:11px">
'.$messages['conversion_rate'].'</span></td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td  class="content_form" align="left">Status Enable&nbsp;</td>
							<td  class="content_form">: </td>
							<td  class="content_form" align="left"><input  name="taxratestatus" id="taxratestatus" type="checkbox" value="1" '.(($values['status']==1) ? ' checked="checked" ' : '' ).'><img src="images/help.gif" onmouseover="ShowHelp(\'acstatus\', \'Status Set\', \'If you want to enable the currency,please check it.\')" onmouseout="HideHelp(\'acstatus\');">
			<div id="acstatus" style="left: 50px; top: 50px;"></div>
                              <!--<label for="taxratestatus">Enable Currency </label>--></td>
							<td  class=""><label for="taxratestatus"></label></td>
						</tr>
						
						<tr>
							<td colspan="4"  class="content_form">
							  <div align="center">
							    <input name="SubmitButton2" value="Add Currency"  type="submit" class="all_bttn">															
					        </div></td>
						</tr>
						<!--<tr><td colspan="6"  all_bttn>&nbsp;</td></tr>-->
					 
					</table>
</form>
';	
			
		return $output;
	}
 	
	
	
	/**
	 * Function returns a template for updating the existing currency. 
	 * @param array $countryarr
	 * @param array $currencyarr
     * @param array $curarr
	 * @param array $Err
	 * @return string
	 */
	
	function showEditCurrency($countryarr,$currencyarr,$curarr,$Err)
	{
		if(count($Err->messages) > 0)
		{
			 $values = $Err->values;
			 $messages = $Err->messages;
		}
		if(count($curarr)>0&&count($Err->messages) == 0)
		foreach($curarr as $values)
		{
		}
		if($values['hidecurrencyid']==1 || $values['hidecurrencyid']=='1')
		{
					
		$output = '<form  name="sam" action="?do=editcurrency&action=update" method="post"><table width="50%" border="0" cellspacing="0" cellpadding="0" align="center">
						<tr>
						<td class="content_form" align="left">Currency name</td>
						<td class="content_form">: </td>
						<td class="content_form" align="left">'.$values['currency_name'].'<input type="hidden" name="currency_name" id="hidecurrencyid"   value="'.$values['currency_name'].'"/></td>
						</tr>
						<tr>
							
							<td class="content_form" align="left">Conversion Rate<span style="color:#FF0000">*</span>&nbsp;</td>
						    <td class="content_form">: </td>
						    <td class="content_form" align="left"><input type="hidden" name="hidecurrencyid" id="hidecurrencyid"   value="'.$values['hidecurrencyid'].'"/>
						      <input name="conversion_rate" id="conversion_rate"   value="'.$values['conversion_rate'].'" type="text" style="width:178px;">
                              <br><span style="color:#FF0000">
'.$messages['conversion_rate'].'</span></td>
						</tr><tr>
							<td colspan="3"  class="content_form">
							  <div align="center">
							    <input name="SubmitButton2" value="Save"  type="submit" class="all_bttn">															
					        </div></td>
						</tr>
						<!--<tr><td colspan="6"  all_bttn>&nbsp;</td></tr>-->
					 
					</table>
</form>';
		}
		else 
		{
		$currencycode='<select name="currency_code" id="currency_code" >';
		//$countrylist.='<option selected="selected" value="all">-- All Countries --</option>';
		foreach($currencyarr as $currency)
		{
			$currencycode.='<option value="'.$currency['currency_code'].'" '.(($values['currency_code']==$currency['currency_code']) ? ' selected ="selected" ' : '' ).'>'.$currency['currency_code'] .'-'.$currency['currency_name'] ;
			if($currency['country_name']!=''&&$currency['country_name']!=' ')
				$currencycode.='&nbsp;(<font size="-1">'.ucwords($currency['country_name']).'</font>)';
			$currencycode.='</option>';
		}
		$currencycode.='</select>';
			
			$countrylist='<select  name="taxratecountry" id="taxratecountry" >';
		foreach($countryarr as $country)
			$countrylist.='<option value="'.$country['cou_code'].'" '.(($values['country_code']==$country['cou_code']) ? ' selected ="selected" ' : '' ).'>'.$country['cou_name'].'</option>';
		$countrylist.='</select>';
		
		
		
		
		$output = '<form  name="sam" action="?do=editcurrency&action=update" method="post"><table width="100%" border="0" cellspacing="0" cellpadding="0" align="center"><tr>
						  <td  colspan="5" align="right"><font color="red"> * Required Fields</font></td>
						</tr>
						<tr>
							<td width="15%" class="content_form" ></td>
							<td width="20%" class="content_form" align="left">
								Currency Name<span style="color:#FF0000">*</span>&nbsp;							</td>
							<td width="5%" class="content_form" >:</td>
							<td width="25%" class="content_form" align="left"><input name="currency_name" id="currency_name"   value="'.$values['currency_name'].'" type="text" style="width:178px;"><input type="hidden" name="hidecurrencyid" id="hidecurrencyid"   value="'.$values['hidecurrencyid'].'"/></td>
							 <td width="35%" class="content_form" align="left"><span style="color:#FF0000;font-size:11px">'.$messages['currency_name'].'</span></td>						</tr>
							
						<tr>
							<td>&nbsp;</td>
							<td  class="content_form" align="left">Currency Tocken<span  style="color:#FF0000">*</span></td>

							<td  class="content_form">: </td>
							<td  class="content_form" align="left"><input name="currency_tocken" id="currency_tocken"  value="'.$values['currency_tocken'].'" type="text" style="width:60px;"><img src="images/help.gif" onmouseover="ShowHelp(\'currtok\', \'Currency Tocken\', \'Enter currency token. Like $,Rs.\')" onmouseout="HideHelp(\'currtok\');">
			<div id="currtok" style="left: 50px; top: 50px;"></div>
                              </td>
                              <td align="left">
                              <span style="color:#FF0000;font-size:11px">'.$messages['currency_tocken'].'</span></td>
						</tr>
						<!--<tr>
								<td class="content_form" >&nbsp;</td>
								<td  class="content_form">&nbsp;</td>
								<td  class="content_form">&nbsp;</td>
								<td colspan="2" class="">&nbsp;</td>
							    <td>&nbsp;</td>
							</tr>-->
							<tr>
							<td>&nbsp;</td>
							<td  class="content_form" valign="top" align="left">Country<span  style="color:#FF0000">*</span>&nbsp;</td>
							<td  class="content_form" valign="top">: </td>
							<td  class="content_form" align="left">'.$countrylist.'
							</td>
                              <td>
							   <span style="color:#FF0000;font-size:11px" align="left">'.$messages['taxratecountry'].'</span></td>
							 </tr>
						
						 <tr>
							 <td>&nbsp;</td>
							<td  class="content_form" valign="top" align="left">Currency Code<span style="color:#FF0000">*</span>&nbsp;</td>
						    <td  class="content_form" valign="top">: </td>
						    <td class="content_form" align="left">
						     <!-- <input name="currency_code" id="currency_code"   value="'.$values['currency_code'].'" type="text" style="width:178px;">-->'.$currencycode.'</td>
                              <td align="left"><span style="color:#FF0000;font-size:11px">
'.$messages['currency_code'].'<span></td>
						</tr>
						
							<tr>
							<td>&nbsp;</td>
							<td class="content_form" align="left">Conversion Rate<span style="color:#FF0000">*</span>&nbsp;</td>
						    <td class="content_form">: </td>
						    <td class="content_form" align="left">
						      <input name="conversion_rate" id="conversion_rate"   value="'.$values['conversion_rate'].'" type="text" style="width:178px;"><img src="images/help.gif" onmouseover="ShowHelp(\'convrate\', \'Conversion Rate\', \'Enter conversion rate againt US dollars value.\')" onmouseout="HideHelp(\'convrate\');">
			<div id="convrate" style="left: 50px; top: 50px;"></div>
                             </td>
                              <td align="left"><span style="color:#FF0000;font-size:11px">
'.$messages['conversion_rate'].'</span></td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td  class="content_form" align="left">Status Enable&nbsp;</td>
							<td  class="content_form">: </td>
							<td  class="content_form" align="left"><input  name="taxratestatus" id="taxratestatus" type="checkbox" value="1" '.(($values['status']==1) ? ' checked="checked" ' : '' ).'><img src="images/help.gif" onmouseover="ShowHelp(\'acstatus\', \'Status Set\', \'If you want to enable the currency,please check it.\')" onmouseout="HideHelp(\'acstatus\');">
			<div id="acstatus" style="left: 50px; top: 50px;"></div>
                              <!--<label for="taxratestatus">Enable Currency </label>--></td>
							<td  class=""><label for="taxratestatus"></label></td>
						</tr>
						
						<tr>
							<td colspan="4"  class="content_form">
							  <div align="center">
							    <input name="SubmitButton2" value="Add Currency"  type="submit" class="all_bttn">															
					        </div></td>
						</tr>
						<!--<tr><td colspan="6"  all_bttn>&nbsp;</td></tr>-->
					 
					</table>
</form>
';	

	
	/*	$output = '<form  name="sam" action="?do=editcurrency&action=update" method="post"><table width="100%" border="0" cellspacing="0" cellpadding="0" align="center"><tr>
						  <td  colspan="6" align="right"><font color="red"> * Required Fields</font></td>
						</tr>
						<tr>
							<td width="119" class="content_form" >
								Currency Name<span style="color:#FF0000">*</span>&nbsp;							</td>
							<td width="27" class="content_form" >:</td>
							<td width="261" class="content_form" ><input name="currency_name" id="currency_name" value="'.$values['currency_name'].'" type="text" style="width:178px;"><input type="hidden" name="hidecurrencyid" id="hidecurrencyid"   value="'.$values['hidecurrencyid'].'"/>
							  <br>
						    <span style="color:#FF0000">'.$messages['currency_name'].'</span></td>
							<td width="146" class="content_form">Currency Code<span style="color:#FF0000">*</span>&nbsp;</td>
						    <td width="40" class="content_form">: </td>
						    <td width="187" class="content_form">
						      <!--<input name="currency_code" id="currency_code" value="'.$values['currency_code'].'" type="text" style="width:178px;">-->'.$currencycode.'
                              <br><span style="color:#FF0000">
'.$messages['currency_code'].'<span></td>
						</tr>
						<tr>
							<td  class="content_form">Currency Tocken<span  style="color:#FF0000">*</span></td>

							<td  class="content_form">: </td>
							<td  class="content_form"><input name="currency_tocken" id="currency_tocken"  value="'.$values['currency_tocken'].'" type="text" style="width:60px;">
                              <br>
                              <span style="color:#FF0000">'.$messages['currency_tocken'].'</span></td>
							<td class="content_form">Conversion Rate<span style="color:#FF0000">*</span>&nbsp;</td>
						    <td class="content_form">: </td>
						    <td class="content_form">
						      <input name="conversion_rate" id="conversion_rate"   value="'.$values['conversion_rate'].'" type="text" style="width:178px;">
                              <br><span style="color:#FF0000">
'.$messages['conversion_rate'].'</span></td>
						</tr>
						
						
							<!--<tr>
								<td class="content_form" >&nbsp;</td>
								<td  class="content_form">&nbsp;</td>
								<td  class="content_form">&nbsp;</td>
								<td colspan="2" class="">&nbsp;</td>
							    <td class="">&nbsp;</td>
							</tr>-->
							<tr>
							<td  class="content_form">Country<span  style="color:#FF0000">*</span>&nbsp;</td>
							<td  class="content_form">: </td>
							<td  class="content_form">'.$countrylist.'<br>
						    <span style="color:#FF0000">'.$messages['taxratecountry'].'</span></td>
							<td colspan="2" class="">&nbsp;</td>
						    <td class="">&nbsp;</td>
						</tr>
						<!--<tr>
							<td  class="content_form">&nbsp;</td>
							<td  class="content_form">&nbsp;</td>
							<td  class="content_form">&nbsp;</td>
							<td colspan="2" class="">&nbsp;</td>
						    <td class="">&nbsp;</td>
						</tr>-->
						<tr>
							<td  class="content_form">Status Enable&nbsp;</td>
							<td  class="content_form">: </td>
							<td  class="content_form"><input  name="taxratestatus" id="taxratestatus" type="checkbox" value="1" '.(($values['status']==1) ? ' checked="checked" ' : '' ).'>
                              <!--<label for="taxratestatus">Enable Currency </label>--></td>
							<td colspan="2" class=""><label for="taxratestatus"></label></td>
						    <td class="">&nbsp;</td>
						</tr>
						<tr>
							<td colspan="6"  class="content_form">
							  <div align="center">
							    <input name="SubmitButton2" value="Save"  type="submit" class="all_bttn">															
					        </div></td>
						</tr>
						<!--<tr><td colspan="6"  all_bttn>&nbsp;</td></tr>-->
					 
					</table>
</form>';	*/
		}
		
		return $output;
	}
	
}

 
?>