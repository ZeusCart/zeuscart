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
 * This class contains functions to list out the currency list available.
 *
 * @package  		Display_DCurrencySettings
 * @category  		Display
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
   * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */
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
		
		
		foreach ($result as $rows)
		{
			if ($rows['default_currency']==1)
				$currencytocken=$rows['currency_tocken'];
		}
		
		$output = '<form action="?do=delcurrency" method="post" id="currencyId" name="currencyform"><table cellspacing="0" cellpadding="0" border="0"  class="table table-striped table-bordered  table-hover">
		<thead class="green_bg"><tr>
		<th  align="left"><input type="checkbox"  onclick="togglecurrencyChecked(this.checked)" name="currencycheckall"></th>
		<th  align="left">S.No</th>
		<th  align="left">Currency Name</th>
		<th align="left">Currency Code</th>
	
		<th align="left">Currency Token</th>
		<th align="left">Status</th>

		</tr></thead>		<tbody>';

		$i=1;
		foreach ($result as $arr)
		{
			if($arr['status']=='1')
			{
				$acive='<span class="badge badge-info">Active</span>';
			}
			else
			{
				$acive='<span class="badge badge-important">Inactive</span>';
			}
			if($arr['default_currency']==1)
			{
				$classname='chkcurrencybox1';
			}
			else
			{
				$classname='chkcurrencybox';
			}

			$output.='<tr>';
			
				$output.='<td><input type="checkbox" name="currencycheck[]" class="'.$classname.'" value="'.$arr['id'].'"></td>';


			$output.='<td>'.$i.'</td>

			<td><a href="?do=editcurrency&cid='.$arr['id'].'">'.$arr['currency_name'].'</a></td>
			<td>'.$arr['currency_code'].'</td>			
			<td>'.$arr['currency_tocken'].'</td>
			<td>'.$acive.'</td></tr>';
			$i++;
		}

		$output.='	
		<tr>
		<td colspan="7" class="clsAlignRight">
		<div class="dt-row dt-bottom-row">
		<div class="row-fluid">
		<div class="dataTables_paginate paging_bootstrap pagination">
		<ul>';

		for($i=1;$i<=count($paging);$i++)
			$pagingvalues .= $paging[$i]."  ";
		$output .= $pagingvalues.' '.$next;

		$output .=' 	</div>
		</div>
		</td>
		</tr></tbody>
		</table></form>';
		

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
		
		$output.= '<form  name="sam" id="addCurrencyId" action="?do=addcurrency" method="post"><div class="row-fluid">
		<div class="span12"><h2 class="box_head green_bg">Add Currency</h2>
		<div class="toggle_container">
		<div class="clsblock">
		<div class="clearfix">';

		$output.='<div class="row-fluid">
		<div class="span12">
		<label>Currency Name <font color="red">*</font> </label> 
		<input name="currency_name" id="currency_name"   value="'.$values['currency_name'].'" type="text" style="width:178px;"><input type="hidden" name="hidecurrencyid" id="hidecurrencyid"   value="'.$values['hidecurrencyid'].'"/></div></div>
		<div class="row-fluid">
		<div class="span12">
		<label>Currency Tocken <font color="red">*</font></label> <input name="currency_tocken" id="currency_tocken"  value="'.$values['currency_tocken'].'" type="text" style="width:60px;"></div></div>
			

		<div class="row-fluid">
		<div class="span12">
		<label  >Country  </label> '.$countrylist.'</div></div>


		<div class="row-fluid">
		<div class="span12">
		<label  style="margin-top:10px">Currency Code </label> '.$currencycode.'</div></div>


	


		<div class="row-fluid">
		<div class="span12">
		<label  style="margin-top:10px">Status Enable :</label>

		<input  name="taxratestatus" id="taxratestatus" type="checkbox" value="1" '.(($values['status']==1) ? ' checked="checked" ' : '' ).'></div></div>

		</div>
		</div>
		</div>

		</div></div>
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




				$output = '<form  name="sam" action="?do=editcurrency&action=update" class="currId" method="post">
				<div class="row-fluid">
				<div class="span12"><h2 class="box_head green_bg">Update Currency</h2>
				<div class="toggle_container">
				<div class="clsblock">
				<div class="clearfix">';
				
				$output.='<div class="row-fluid">
				<div class="span12">
				<label>Currency Name <font color="red">*</font></label> 
				<input name="currency_name" id="currency_name"   value="'.$values['currency_name'].'" type="text" style="width:178px;"><input type="hidden" name="hidecurrencyid" id="hidecurrencyid"   value="'.$values['hidecurrencyid'].'"/></div></div>
				<div class="row-fluid">
				<div class="span12">
				<label>Currency Tocken <font color="red">*</font></label> <input name="currency_tocken" id="currency_tocken"  value="'.$values['currency_tocken'].'" type="text" style="width:60px;"></div></div>

				
				<div class="row-fluid">
				<div class="span12">
				<label>Country </label> '.$countrylist.'</div></div>


				<div class="row-fluid">
				<div class="span12">
				<label style="margin-top:10px">Currency Code </label> '.$currencycode.'</div></div>


				


				<div class="row-fluid">
				<div class="span12">
				<label  style="margin-top:10px">Status Enable :</label>

				<input  name="taxratestatus" id="taxratestatus" type="checkbox" value="1" '.(($values['status']==1) ? ' checked="checked" ' : '' ).'></div></div>

				</div>
				</div>
				</div>

				</div></div>
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




				$output = '<form  name="sam" action="?do=editcurrency&action=update" class="currId" method="post">
				<div class="row-fluid">
				<div class="span12"><h2 class="box_head green_bg">Update Currency</h2>
				<div class="toggle_container">
				<div class="clsblock">
				<div class="clearfix">';
				
				$output.='<div class="row-fluid">
				<div class="span12">
				<label>Currency Name <font color="red">*</font></label> 
				<input name="currency_name" id="currency_name"   value="'.$values['currency_name'].'" type="text" style="width:178px;"><input type="hidden" name="hidecurrencyid" id="hidecurrencyid"   value="'.$values['hidecurrencyid'].'"/></div></div>
				<div class="row-fluid">
				<div class="span12">
				<label>Currency Tocken <font color="red">*</font></label> <input name="currency_tocken" id="currency_tocken"  value="'.$values['currency_tocken'].'" type="text" style="width:60px;"></div></div>

				
				<div class="row-fluid">
				<div class="span12">
				<label>Country </label> '.$countrylist.'</div></div>


				<div class="row-fluid">
				<div class="span12">
				<label style="margin-top:10px">Currency Code </label> '.$currencycode.'</div></div>


				


				<div class="row-fluid">
				<div class="span12">
				<label  style="margin-top:10px">Status Enable :</label>

				<input  name="taxratestatus" id="taxratestatus" type="checkbox" value="1" '.(($values['status']==1) ? ' checked="checked" ' : '' ).'></div></div>

				</div>
				</div>
				</div>

				</div></div>
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