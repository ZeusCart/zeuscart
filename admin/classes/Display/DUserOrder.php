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
 class Display_DUserOrder
{
 	function showCustomer($arrUser)
	{
		$opt='<select name="selCustomer" style="width:127px;">';
		for($i=0;$i<count($arrUser);$i++)
		{
			$sel='';		
			//if($arrUser[$i]['user_id']==$output['val']['selCustomer'])
			//	 $sel='selected';
		
			$opt.='<option value="'.$arrUser[$i]['user_id'].'" '.$sel.'>'.$arrUser[$i]['user_display_name'].'</option>';
		}
		$opt.='</select>';
		return $opt;
	}
	function showPayment($arrUser)
	{
		$opt='<select name="payOption" style="width:127px;">';
		for($i=0;$i<count($arrUser);$i++)
		{
			$opt.='<option value="'.$arrUser[$i]['gateway_id'].'">'.$arrUser[$i]['gateway_name'].'</option>';
		}
		$opt.='</select>';
		return $opt;
	}
 	function showCategory($arrCat)
	{
		$cat='<select name="selCategory" style="width:110px;" onchange="loadSubcat(this.value)">
		<option value="">--Select--</option>';
		for($i=0;$i<count($arrCat);$i++)
		{
			$sel='';		
			if($arrCat[$i]['category_id']==$_POST['selCategory'])
				 $sel='selected';

			$cat.='<option value="'.$arrCat[$i]['category_id'].'" '.$sel.'>'.$arrCat[$i]['category_name'].'</option>';
		}
		$cat.='</select>';
		return $cat;
	}
 	function showSubCategory($arrCat)
	{
		$cat='<select name="selSubCategory" style="width:110px;" onchange="loadProduct(this.value)">
		<option value="">--Select--</option>';
		for($i=0;$i<count($arrCat);$i++)
		{
			$sel='';		
			if($arrCat[$i]['category_id']==$_POST['selSubCategory'])
				 $sel='selected';
		
			$cat.='<option value="'.$arrCat[$i]['category_id'].'" '.$sel.'>'.$arrCat[$i]['category_name'].'</option>';
		}
		$cat.='</select>';
		return $cat;
	}
 	function showProducts($arrCat)
	{
		$cat='<select name="selProduct" style="width:110px;" onchange="loadQty(this.value)">
		<option value="">--Select--</option>';
		for($i=0;$i<count($arrCat);$i++)
		{
			$sel='';		
			if($arrCat[$i]['product_id']==$_POST['selProduct'])
				 $sel='selected';
		
			$cat.='<option value="'.$arrCat[$i]['product_id'].'" '.$sel.'>'.$arrCat[$i]['title'].'</option>';
		}
		$cat.='</select>';
		return $cat;
	}
 	function showQty($arrCat)
	{
		
		$cat='<select name="selQty" style="width:50px;">';
		if($arrCat[0]['soh']>0)
		{
			for($i=1;$i<=$arrCat[0]['soh'];$i++)
			{
				$sel='';		
				if($i==$_POST['selQty'])
					 $sel='selected';
			
				$cat.='<option value="'.$i.'" '.$sel.'>'.$i.'</option>';
			}
		}
		else
				$cat.='<option value="0" >0</option>';
				
		$cat.='</select>&nbsp;
		<input type="hidden" name="hidPrice" value="'.$arrCat[0]['msrp'].'"/>
		<input type="hidden" name="hidShipCost" value="'.$arrCat[0]['shipping_cost'].'"/>
		<input type="hidden" name="hidProduct" value="'.$arrCat[0]['title'].'"/>';
		if(count($arrCat)>0)
			$cat.='Unit Price: '.$_SESSION['currency']['currency_tocken'].number_format($arrCat[0]['msrp'],2);
		return $cat;
	}

	function listOrder($arr)
	{
		$output = '<br><br>
		<table width="98%" border="0" cellpadding="0" cellspacing="0" class="content_list_bdr">

                <td class="content_list_head" width=5% align="center">S.No</td>
                <td class="content_list_head" width=30%>Product</td>
                <td class="content_list_head" width=8%>Qty</td>				
                <td class="content_list_head" width=10%>Unit Price</td>	
                <td class="content_list_head" width=10%>Shipping</td>								
                <td class="content_list_head" width=10%>Sub Total</td>				
                <td colspan="2" align="center" class="content_list_head" width=1%></td>
                </tr>
              <tr>
                <td colspan="8" class="cnt_list_bot_bdr"><img src="images/list_bdr.gif" alt="" width="1" height="2" /></td>
              </tr>';
	 if(count($arr)>0)
	 {
	 	$grandTotal=0;
		for ($i=0;$i<count($arr);$i++)
		{
			if($i % 2 == 0)
				$classtd='class="content_list_txt1"';
			else
				$classtd='class="content_list_txt2"';
				
			$output .= '<tr style="background-color:#FFFFFF;" onmouseout="listbg(this, 0);" onmouseover="listbg(this, 1);">
			<td align="center" '.$classtd.'>'.($val+1).'</td>
			<td align="" '.$classtd.'>'.$arr[$i]['product'].'</td>
			<td align="" '.$classtd.'>'.$arr[$i]['qty'].'</td>
			<td align="right" '.$classtd.'>'.$_SESSION['currency']['currency_tocken'].number_format($arr[$i]['price'],2).'</td>
			<td align="right" '.$classtd.'>'.$_SESSION['currency']['currency_tocken'].number_format($arr[$i]['shipCost'],2).'</td>
			<td align="right" '.$classtd.'>'.$_SESSION['currency']['currency_tocken'].number_format(($arr[$i]['qty']*$arr[$i]['price']),2).'</td>';
			$grandTotal+=($arr[$i]['qty']*$arr[$i]['price']);
			
			/*$output.='<td align="center" '.$classtd.'>
			<a href="?do=faq&action=add&id='.$arr[$i]['faq_id'].'" style="cursor:pointer;text-decoration:none;">
			<input type="button" class="edit_bttn" name="Edit"  title="Edit" value=""/></a></td>';*/
			$output.='<td align="center" '.$classtd.'>
			<a href="?do=addUserProduct&action=delete&id='.$arr[$i]['product_id'].'" style="cursor:pointer;text-decoration:none;">
			<input type="button" name="Delete" class="delete_bttn" onclick="return confirm(\'Are you sure to delete?\')" title="Delete" value=""/>&nbsp;</a></td></tr>';
			$val++;
		}
		$output.='<tr>
			<td colspan=5 '.$classtd.' align=right><b>Grand Total</b></td><td align="right" '.$classtd.'>'.$_SESSION['currency']['currency_tocken'].number_format($grandTotal,2).'<input type=hidden name="hidOrderTotal" value="'.$grandTotal.'"></td>';
		
	}
	else
		$output.='<tr><td colspan=7 valign="bottom" align="center">No product selected !<br/>&nbsp;</td></tr>';
						
		$output .= '</table>';
		return $output;
		
	}
		
		function showShippingDetails($res)
		{
			include_once("classes/Lib/HandleErrors.php");
			include_once('classes/Core/CUserOrder.php');
			Core_CUserOrder::Ulogin($Err);

			if($Err->messages>0)
			{
				$output['val']=$Err->values;
				$output['msg']=$Err->messages;
			}

			$billCntry='<select name="selbillcountry" id="selbillcountry" style="width:145px">';
			for($i=0;$i<count($res);$i++)
			{
				$billCntry.='<option value="'.$res[$i]['cou_code'].'">'.$res[$i]['cou_name'].'</option>';
			}
			$billCntry.='</select>';
			
			$shipCntry='<select name="selshipcountry" id="selshipcountry" style="width:145px">';
			for($i=0;$i<count($res);$i++)
			{
				$shipCntry.='<option value="'.$res[$i]['cou_code'].'">'.$res[$i]['cou_name'].'</option>';
			}
			$shipCntry.='</select>';
				

			$output1='<div id="detail">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td class="roundbox_top"></td>
  </tr>
  <tr>
    <td valign="top" class="detailBG"><div><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td valign="top" style=""><table width="100%" border="0" cellspacing="0" cellpadding="0">
          
          <tr>
            <td align="left" valign="top"><table width="80%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td colspan=3 class="content_form"><b>Billing Address</b>
                </tr>
                <tr style="line-height:30px">
                  <td width="26%" valign=top class="content_form">Name <span>*</span></td>
                  <td width="4%"></td>
                  <td width="70%"><input name="txtname" type="text" id="txtname" value="'.$output["val"]["txtname"].'"/><span style="font-size:9px;color:#FF0000; "> '.$output["msg"]["txtname"].'</span></td>
                </tr>
                
                <tr style="line-height:30px">
                  <td valign=top class="content_form">Company</td>
                  <td></td>
                  <td><input name="txtcompany" type="text" class="txtbox1 w4 TxtC1" id="txtcompany" /></td>
                </tr>
                <tr style="line-height:30px">
                  <td valign=top class="content_form">Address <span>*</span></td>
                  <td></td>
                  <td><input name="txtstreet" type="text" class="txtbox1 w4 TxtC1" id="txtstreet" value="'.$output["val"]["txtstreet"].'"/><span style="font-size:9px;color:#FF0000"> '.$output["msg"]["txtstreet"].'</span></td>
                </tr>
                <tr style="line-height:30px">
                  <td valign=top class="content_form">City <span>*</span></td>
                  <td></td>
                  <td><input name="txtcity" type="text" class="txtbox1 w4 TxtC1" id="txtcity" value="'.$output["val"]["txtcity"].'"/><span style="font-size:9px;color:#FF0000"> '.$output["msg"]["txtcity"].'</span></td>
                </tr>
				 <tr >
                  <td valign=top class="content_form">SubUrb <span><!--*--></span></td>
                  <td></td>
                  <td><input name="txtsuburb" type="text" class="txtbox1 w4 TxtC1" id="txtsuburb" /></td>
                </tr>
                <tr style="line-height:30px">
                  <td nowrap valign=top class="content_form">State/Province <span>*</span></td>
                  <td></td>
                  <td><input name="txtstate" type="text" class="txtbox1 w4 TxtC1" id="txtstate" value="'.$output["val"]["txtstate"].'"/><span style="font-size:9px;color:#FF0000"> '.$output["msg"]["txtstate"].'</span></td>
                </tr>
				<tr style="line-height:30px">
                  <td valign=top class="content_form">Country <span>*</span></td>
                  <td></td>
                  <td>'.$billCntry.'<span style="font-size:9px;color:#FF0000"> '.$output["msg"]["selbillcountry"].'</span></td>
                </tr>
                <tr style="line-height:30px">
                  <td nowrap valign=top class="content_form">Zip/Postal Code <span>*</span></td>
                  <td></td>
                  <td><input name="txtzipcode" type="text" class="txtbox1 w4 TxtC1" id="txtzipcode" value="'.$output["val"]["txtzipcode"].'"/><span style="font-size:9px;color:#FF0000"> '.$output["msg"]["txtzipcode"].'</span></td>
                </tr>
                
               
                <tr>
                  <td colspan="3" style="padding-top:10px;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td valign="top" class="content_form" nowrap><div>
                          <input type="checkbox" name="chkall" id="chkall" value="checkbox" onclick="javascript:getValues();" />
                        Use Billing Address as Shipping Address</div></td><td>&nbsp;<img src="images/help.gif" onmouseover="ShowHelp(\'daddr\', \'Use Billing address\', \'If you select this,your billing address also as shipping address.\')" onmouseout="HideHelp(\'daddr\');">
			<div id="daddr" style="left: 50px; top: 50px;"></div></td>
			
                    </tr>
                  </table></td>
                </tr>

            </table></td>
            <td align="left" valign="top"><table width="80%" border="0" cellspacing="0" cellpadding="0" class="checkout_rigistration">
              <tr>
                <td colspan=3 class="content_form"><b>Shipping Address</b></td>
              </tr>
              <tr style="line-height:30px">
                <td width="26%" valign=top class="content_form">Name <span>*</span></td>
                <td width="4%"></td>
                <td width="70%"><input name="txtsname" type="text" class="txtbox1 w4 TxtC1" id="txtsname" value="'.$output["val"]["txtsname"].'"/><span style="font-size:9px;color:#FF0000"> '.$output["msg"]["txtsname"].'</span></td>
              </tr>
              
              <tr style="line-height:30px">
                <td valign=top class="content_form">Company</td>
                <td></td>
                <td><input name="txtscompany" type="text" class="txtbox1 w4 TxtC1" id="txtscompany" /></td>
              </tr>
              <tr style="line-height:30px">
                <td valign=top class="content_form">Address <span>*</span></td>
                <td></td>
                <td><input name="txtsstreet" type="text" class="txtbox1 w4 TxtC1" id="txtsstreet" value="'.$output["val"]["txtsstreet"].'"/><span style="font-size:9px;color:#FF0000"> '.$output["msg"]["txtsstreet"].'</span></td>
              </tr>
              <tr style="line-height:30px">
                <td valign=top class="content_form">City <span>*</span></td>
                <td></td>
                <td><input name="txtscity" type="text" class="txtbox1 w4 TxtC1" id="txtscity" value="'.$output["val"]["txtscity"].'"/><span style="font-size:9px;color:#FF0000"> '.$output["msg"]["txtscity"].'</span></td>
              </tr>
			   <tr >
                <td valign=top class="content_form">SubUrb <span><!--*--></span></td>
                <td></td>
                <td valign="top" ><input name="txtssuburb" type="text" class="txtbox1 w4 TxtC1" id="txtssuburb" /></td><td><img src="images/help.gif" onmouseover="ShowHelp(\'durb2\', \'Urban\', \'Enter Sub Urban name.\')" onmouseout="HideHelp(\'durb2\');" style="vertical-align:top">
			<div id="durb2" style=" position:fixed"></div></td>
			
              </tr>
              <tr style="line-height:30px">
                <td nowrap valign=top class="content_form">State/Province <span>*</span></td>
                <td></td>
                <td><input name="txtsstate" type="text" class="txtbox1 w4 TxtC1" id="txtsstate" value="'.$output["val"]["txtsstate"].'"/><span style="font-size:9px;color:#FF0000"> '.$output["msg"]["txtsstate"].'</span></td>
              </tr>
              
              <tr style="line-height:30px">
                <td valign=top class="content_form">Country <span>*</span></td>
                <td></td>
                <td>'.$shipCntry.'<span style="font-size:9px;color:#FF0000"> '.$output["msg"]["selshipcountry"].'</span></td>
              </tr>
             <tr style="line-height:30px">
                <td nowrap valign=top class="content_form">Zip/Postal Code <span>*</span></td>
                <td></td>
                <td><input name="txtszipcode" type="text" class="txtbox1 w4 TxtC1" id="txtszipcode" value="'.$output["val"]["txtszipcode"].'"/><span style="font-size:9px;color:#FF0000"> '.$output["msg"]["txtszipcode"].'</span></td>
              </tr>
			<tr>
			<td>&nbsp;
			</td>
			</tr>	
            </table></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
    </tr>
  
</table>
</div>
	</td>
  </tr>
  <tr>
    <td class="roundbox_bottom" ></td>
  </tr>
</table>
</div><script> function getValues()
			{
			  var bname=document.userOrder.txtname;
			  var bcompany=document.userOrder.txtcompany;
			  var bstreet=document.userOrder.txtstreet;
			  var bcity=document.userOrder.txtcity;
			  var bsuburb=document.userOrder.txtsuburb;
  			  var bzipcode=document.userOrder.txtzipcode;	
   			  
			  document.userOrder.selshipcountry.selectedIndex=document.userOrder.selbillcountry.selectedIndex;

			  		  		  
   			  var bstate=document.userOrder.txtstate;			  		  
			  
			  
			  var  sname=document.userOrder.txtsname;
			  var scompany= document.userOrder.txtscompany;
			  var sstreet= document.userOrder.txtsstreet;
			  var scity=document.userOrder.txtscity;
			  var ssuburb=document.userOrder.txtssuburb;
   			  var szipcode=document.userOrder.txtszipcode;
  			  var scountry=document.userOrder.selshipcountry;

   			  
   			  var sstate=document.userOrder.txtsstate;			  		  		  
			  
			  var chkstatus=document.userOrder.chkall;
			//  alert(chkstatus.checked);
			  if(chkstatus.checked)
			  {
				  sname.value=bname.value;
				  scompany.value=bcompany.value;
				  sstreet.value=bstreet.value;
				  scity.value=bcity.value;
				  ssuburb.value=bsuburb.value;
				  szipcode.value=bzipcode.value;
				
				  sstate.value=bstate.value;
			  }
			  else
			  {
			      sname.value="";
				  scompany.value="";
				  sstreet.value="";
				  scity.value="";
				  ssuburb.value="";
				  szipcode.value="";
				  scountry.value="";
				  sstate.value="";
			  }
	 
			}</script>
';
		return $output1;
	}
	
}
?>
