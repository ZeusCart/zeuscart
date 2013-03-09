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
class Display_DTaxSettings
{
	function showTaxSettings($arr,$uniqarr)
	{
		//echo "<pre>";
		//print_r($uniqarr);
		
		$output = '<table width="100%" class="" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="20%" align="left" class="content_form" valign="top" style="padding-left:70px;">Category Name :</td>
            <td width="80%" class="content_form" >
				<input name="TaxSetting" id="taxtype1" value="'.$arr[0]['id'].'"  type="radio" '.(($arr[0]['status']==1) ? 'checked="checked"' : '' ).' onclick="document.getElementById(\'SingleTaxDiv\').style.display=\'none\';document.getElementById(\'ifrmdiv\').style.display=\'none\'"> I don\'t want to apply tax to any products in my store&nbsp;<img src="images/help.gif" onmouseover="ShowHelp(\'dtax1\', \'Tax\', \'Don&acute;t apply Tax to any product(Tax Free).\')" onmouseout="HideHelp(\'dtax1\');">
			<div id="dtax1" style=" position:fixed"></div><br>
				<input name="TaxSetting" id="taxtype2" value="'.$arr[1]['id'].'"   type="radio" onclick="document.getElementById(\'SingleTaxDiv\').style.display=\'none\'; document.getElementById(\'ifrmdiv\').style.display=\'block\';" '.(($arr[1]['status']==1) ? 'checked="checked"' : '' ).'> I want to apply tax for specific countries and/or states&nbsp;<img src="images/help.gif" onmouseover="ShowHelp(\'dtax2\', \'Tax\', \'Apply Tax for country or/and state based.\')" onmouseout="HideHelp(\'dtax2\');">
			<div id="dtax2" style=" position:fixed"></div><br>
				<div id="ifrmdiv" style="display:'.(($arr[1]['status']==1) ? 'block' : 'none' ).';padding-top:5px;"><iframe src="?do=taxsettings&action=showregionwisetaxlist" style="border:none;" width="680px;" height="510px;"></iframe></div>
				<input name="TaxSetting" id="taxtype3" value="'.$arr[2]['id'].'"   type="radio" onclick="document.getElementById(\'SingleTaxDiv\').style.display=\'block\';document.getElementById(\'ifrmdiv\').style.display=\'none\';" '.(($arr[2]['status']==1) ? 'checked="checked"' : '' ).' > I want to apply one tax rate to all products in my store&nbsp;<img src="images/help.gif" onmouseover="ShowHelp(\'dtax3\', \'Tax\', \'Apply Tax to all products(Common to all).\')" onmouseout="HideHelp(\'dtax3\');">
			<div id="dtax3" style=" position:fixed"></div>
						
						
						
							</td>
          </tr>
		  <tr>
		  	<td>&nbsp;</td>
		  	<td>
			
			
			
			<!--------------------------Tax Details----------------------->
			
			<table cellspacing="0" cellpadding="0" border="0" style="width: 100%; margin-top: 5px; display: '.(($arr[2]['status']==1) ? 'block"' : 'none' ).';" id="SingleTaxDiv" class="content_form" >
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
									<tr>
										<td> </td>
										<td align="left">
											<label >Tax Rate:</label>
										</td>
										<td align="left" valign="top">
											<input type="text" value="'.$uniqarr[0]['tax_rate_percent'].'" id="SingleTaxRate" name="SingleTaxRate"  style="width:40px;"/>%
											
										</td>
									</tr>	
								</tbody></table>
							</td>
						</tr>
					</tbody></table>
			
			<!--------------------------Tax Details----------------------->
			
			
			
			</td>
		  </tr>
          
          <tr>
            <td class="content_form">&nbsp;</td>
            <td class="content_form" style="padding-left:30px;"><input type="submit" name="submit" value="Update Tax Setting" class="all_bttn"   />
            </td>
          </tr>
        
        </table>';
		
			
		return $output;
			
	}
	function showCountrywiseTaxList($result,$paging,$prev,$next)
	{
		//echo "<pre>";
		//print_r($result);
		
		$output = '<table class="content_list_bdr" cellspacing="0" border="0" width="100%">
	<tr><td width="300" class="content_list_head">Tax Name</td>
	<td width="221" class="content_list_head">Tax Rate</td>
	<td width="264" class="content_list_head">Applied To</td>
	<td width="50" class="content_list_head">Status</td>
	<td width="50" class="content_list_head">&nbsp;</td>
	<td width="50" class="content_list_head">&nbsp;</td>
	</tr>';
	
	
	foreach ($result as $arr)
	{
		$output.='<tr onmouseover="listbg(this, 1);" onmouseout="listbg(this, 0);" style="background-color: rgb(255, 255, 255);"><td style="padding: 5px; width: 20px;" class="content_list_txt1" align="left">'.$arr['tax_name'].'</td><td class="content_list_txt1">'.$arr['tax_rate_percent'].' %</td><td style="padding-left: 10px;" class="content_list_txt1" align="left">'.( ($arr['country_code']=='' || $arr['country_code']=='all') ?  'All Countries' : $arr['cou_name']).'</td><td style="padding: 5px; width: 20px;" class="content_list_txt1" align="center"><span '.(($arr['status']==1) ? ' class="active_link" title="Active" ' : ' class="inactive_link" title="Inactive" ' ).'" /></td><td class="content_list_txt1"><a class="edit_bttn" href="?do=taxsettings&action=editregionwisetax&taxid='.$arr['id'].'">&nbsp;</a></td>
	  <td class="content_list_txt1"><a class="delete_bttn" onclick="return confirm(\'Do you want to delete\');" href="?do=taxsettings&action=deleteregionwisetax&taxid='.$arr['id'].'">&nbsp;</a></td>
	</tr>';
	}
	
	$output.='<tr onmouseover="listbg(this, 1);" onmouseout="listbg(this, 0);" style="background-color: rgb(255, 255, 255);"></tr>
	
	<tr align="center"><td colspan="6" class="content_list_footer">  ';
	
	 for($i=1;$i<=count($paging);$i++)
				 $pagingvalues .= $paging[$i]."  ";
				 	 	$output .= $pagingvalues.' '.$next;
	
	$output .='   </td></tr>
</table>';
		
			
		return $output;
			
	}
	function addCountrywiseTax($countryarr,$Err)
	{
		if(count($Err->messages) > 0)
		{
			 $values = $Err->values;
			 $messages = $Err->messages;
		}
		//print_r($messages);
		//echo "<pre>";
		//print_r($countryarr);
		$countrylist='<select size="5" name="taxratecountry" id="taxratecountry"   onchange="" style="width:180px;">';
		//$countrylist.='<option selected="selected" value="all">-- All Countries --</option>';
		foreach($countryarr as $country)
			$countrylist.='<option value="'.$country['cou_code'].'" '.(($values['taxratecountry']==$country['cou_code']) ? ' selected ="selected" ' : '' ).'>'.$country['cou_name'].'</option>';
		$countrylist.='</select>';
		
		$output = '<form  name="sam" action="?do=taxsettings&action=insertregionwisetax" method="post"><table width="80%" border="0" cellspacing="0" cellpadding="0" align="center"><tr>
						  <td  colspan="3" align="right"><font color="red"> * Required Fields</font></td>
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
	function editCountrywiseTax($arr,$countryarr,$Err)
	{
		if(count($Err->messages) > 0)
		{
			 $values = $Err->values;
			 $messages = $Err->messages;
		}
		else
			$values =$arr[0];
		//print_r($values);
		//echo "<pre>";
		//print_r($countryarr);
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