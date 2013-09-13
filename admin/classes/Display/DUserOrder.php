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
 * This class contains functions to display the user order
 *
 * @package  		Display_DUserOrder
 * @category  		Display
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
  * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */
class Display_DUserOrder
{

	/**
	 * Function  to display   the  customer
	 * @param array $arrUser
     	* @return string
	 */	
     	function showCustomer($arrUser,$Err)
     	{

     		if(count($arrUser) > 0 && !empty($arrUser))
     		{
     			$opt='<select name="selCustomer" id="selCustomer" class="sbox1" onchange="loadusermultiaddress();"><option value="0">Select Customer </option>';
     			for($i=0;$i<count($arrUser);$i++)
     			{	
     				if(trim($Err->values['selCustomer'])==trim($arrUser[$i]['user_id']))
				{
					$selected='selected';
				}
				else
				{
					$selected='';
				}

     				$opt.='<option value="'.$arrUser[$i]['user_id'].'" '.$selected.'>'.$arrUser[$i]['user_display_name'].'</option>';
     			}

     			$opt.='</select><br>';

			if($Err->messages["selCustomer"]!='')
			{
			$opt.='<div class="row-fluid">
			<div class="span12" style="text-align:left;"><div class="alert alert-error">
			<button data-dismiss="alert" class="close" type="button">×</button>'.$Err->messages["selCustomer"].'</div></div></div>';
			}
     		}
     		else
     		{
     			$opt='<select name="selCustomer" class="sbox1" >';		
     			$opt.='<option value="">No Users Found</option>';
     			$opt.='</select>';
     		}
     		$opt.='';

     		return $opt;
     	}
	/**
	 * Function  to display   the  payment
	 * @param array $arrUser
    	 * @return string
	 */	
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
	/**
	 * Function  to display   the  category
	 * @param array $arrCat
         * @return string
	 */	
// 	function showCategory($arrCat)
// 	{
// 		// echo "<pre>";
// 		// print_r($arrCat);exit;
// 		
// 		// 		$cat='<select name="selCategory" id="category" style="width:110px;" onchange="loadSubcat(this.value)">
// 		// 		<option value="">--Select--</option>';
// 		// 		for($i=0;$i<count($arrCat);$i++)
// 		// 		{
// 		// 			$sel='';		
// 		// 			if($arrCat[$i]['category_id']==$_POST['selCategory'])
// 		// 				 $sel='selected';
// 		// 
// 		// 			$cat.='<option value="'.$arrCat[$i]['category_id'].'" '.$sel.'>'.$arrCat[$i]['category_name'].'</option>';
// 		// 		}
// 		// 		$cat.='</select>';
// 		// 		return $cat;
// 		
// 		// 		$output='<div>
// 		// 
// 
// 
// 		// $output='   <a href="#" class="expand_button">Open all</a>
// 		// <a href="#" class="collapse_button">Close all</a><ul class="telefilms first"  >';
// 		$output.='<select onchange="loadProduct();" id="categoryId" name="category">';
// 
// 		for($i=0;$i<count($arrCat);$i++)
// 		{
// 
// 
// 			$output.='<option>'.$arrCat[$i]['category_name'].'</option>';
// 			$query = new Bin_Query(); 
// 			$sql = "SELECT * FROM `category_table` WHERE category_parent_id =".$arrCat[$i]['category_id']." AND  sub_category_parent_id =0 AND category_status =1 order by category_name limit 16";
// 			$query->executeQuery($sql);
// 			$count=count($query->records);
// 			if($count>0)
// 			{	
// 				$records=$query->records;
// 				
// 				for($j=0;$j<$count;$j++)
// 				{
// 					$output.='<option>-'.$records[$j]['category_name'].'</option>';
// 
// 
// 					$sqlsub="SELECT * FROM category_table WHERE sub_category_parent_id='".$records[$j]['category_id']."' and sub_category_parent_id !=0";
// 					$objsub=new Bin_Query();
// 					$objsub->executeQuery($sqlsub);
// 					$recordssub=$objsub->records;
// 					
// 					for($k=0;$k<count($recordssub);$k++)
// 					{
// 
// 						$output.='
// 						<option value="'.$arrCat[$i]['category_id'].'">---'.$recordssub[$k]['category_name'].'</option>
// 						';
// 
// 					}
// 
// 				 }
// 
// 			}
// 
// 		}
// 
// 		$output.='</select>';
// 
// 		return $output;
// 	}
	function showCategory($result)
	{
		$catid=$_POST['selCategory'];

	
		if((count($result))>0)
		{
		   	 $output='<select name="selCategory" id="selCategory" class="sbox1" onchange="loadProduct(this.value)"><option value="" >Choose Category</option>';	
		
			for($k=0;$k<count($result);$k++)
			{
				if($catid==$result[$k]['category_id'])
				{
					$selected="selected";
				}
				else
				{
					$selected='';
				}
				
				$output.='<option value='.$result[$k]['category_id'].' '.$selected.'>'.$result[$k]['category_name'].'</option>';
				$output.=self:: getSubFamilies(0,$result[$k]['category_id'],$catid );
	
			
			}

			$output.='</select>';
		}		
		else
		{
			
			$output='<select name="selCategory"  class="sbox1" >
			<option value="">Main Category</option>';		
			$output.='</select>';	
		}
		
		return $output;
	}
	/**
	 * Function generates an drop down list with the category details.in sub child
	 * 
	 * 
	 * @return array
	 */		
	function getSubFamilies($level, $id,$catid) {

		$level++;
		$sqlSubFamilies = "SELECT * from category_table WHERE  category_parent_id = ".$id."";
		$resultSubFamilies = mysql_query($sqlSubFamilies);
		if (mysql_num_rows($resultSubFamilies) > 0) {
		
			while($rowSubFamilies = mysql_fetch_assoc($resultSubFamilies)) {

				
				if($catid==$rowSubFamilies['category_id'])
				{
					$selected="selected";
				}
				else
				{
					$selected='';
				}
				
				$output.= "<option value=".$rowSubFamilies['category_id']."  ".$selected.">";

				for($a=1;$a<$level+1;$a++)
				{
				$output.='- &nbsp;';
					
				}
				$output.=$rowSubFamilies['category_name']."</option>";
				$output.=self:: getSubFamilies($level, $rowSubFamilies['category_id'],$catid);
				
			}
		
		}
		
		return $output;
	}
	/**
	 * Function  to display   the  sub category
	 * @param array $arrCat
    	 * @return string
	 */	
	function showSubCategory($arrCat)
	{
		$cat='<select name="selSubCategory" style="width:110px;" onchange="loadSubUnder(this.value)">
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

	/**
	 * Function  to display   the  sub category
	 * @param array $arrCat
    	 * @return string
	 */	
	function showSubUnderCat($arrCat)
	{
		$cat='<select name="selSubUnderCategory"  id="selSubUnderCategory" style="width:110px;" onchange="loadProduct(this.value)">
		<option value="">--Select--</option>';
		for($i=0;$i<count($arrCat);$i++)
		{
			$sel='';		
			if($arrCat[$i]['category_id']==$_POST['selSubUnderCategory'])
				$sel='selected';

			$cat.='<option value="'.$arrCat[$i]['category_id'].'" '.$sel.'>'.$arrCat[$i]['category_name'].'</option>';
		}
		$cat.='</select>';
		return $cat;
	}
	/**
	 * Function  to display   the  product
	 * @param array $arrCat
    	 * @return string
	 */	
	function showProducts($arrCat)
	{

		$cat='<select name="selProduct" id="selProduct" style="width:110px;" onchange="loadQty(this.value)">
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
	/**
	 * Function  to display   the  product quantity
	 * @param array $arrCat
     	 * @return string
	 */	
	function showQty($arrCat)
	{
		
		$cat='<select name="selQty" id="quantity" style="width:100px;"><option value="">Qty</option>';
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

		$cat.='</select>';
			if(count($arrCat)>0)
			$cat.='<span class="label label-info">Unit Price: '.$_SESSION['currency']['currency_tocken'].number_format($arrCat[0]['msrp'],2).'</span>&nbsp;';
		$cat.='<input type="hidden" name="hidPrice" value="'.$arrCat[0]['msrp'].'"/>
		<input type="hidden" name="hidShipCost" value="'.$arrCat[0]['shipping_cost'].'"/>
		<input type="hidden" name="hidProduct" value="'.$arrCat[0]['title'].'"/>';
		
		return $cat;
	}
	/**
	 * Function  to display   the  list of orders
	 * @param array $arr
         * @return string
	 */	
	function listOrder($arr)
	{


		$output = '
		<table cellspacing="0" cellpadding="0" border="0"  class="table table-striped table-bordered  table-hover">

		<thead class="green_bg">
		<tr>
		<th align="left">S.No</th>
		<th align="left">Product</th>
		<th align="left">Qty</th>				
		<th align="left">Unit Price</th>	
		<th align="left">Shipping</th>								
		<th align="left">Sub Total</th>				
		<th align="left" colspan="2"></th>
		</tr><tbody>
		';
		if(count($arr)>0)
		{
			$grandTotal=0;
			$total=0;
			$shiptotal=0;
			for ($i=0;$i<count($arr);$i++)
			{
				

				$output .= '<tr >
				<td align="center" >'.($val+1).'</td>
				<td align="" >'.$arr[$i]['product'].'</td>
				<td align="" >'.$arr[$i]['qty'].'</td>
				<td align="right" >'.$_SESSION['currency']['currency_tocken'].number_format($arr[$i]['price'],2).'</td>
				<td align="right" >'.$_SESSION['currency']['currency_tocken'].number_format($arr[$i]['qty']*$arr[$i]['shipCost'],2).'</td>
				<td align="right" >'.$_SESSION['currency']['currency_tocken'].number_format(($arr[$i]['qty']*$arr[$i]['price']),2).'</td>';
				$grandTotal+=($arr[$i]['qty']*$arr[$i]['price'])+($arr[$i]['qty']*$arr[$i]['shipCost']);
				$total+=($arr[$i]['qty']*$arr[$i]['price']);
				$shiptotal+=($arr[$i]['qty']*$arr[$i]['shipCost']);
				/*$output.='<td align="center" >
				<a href="?do=faq&action=add&id='.$arr[$i]['faq_id'].'" style="cursor:pointer;text-decoration:none;">
				<input type="button" class="edit_bttn" name="Edit"  title="Edit" value=""/></a></td>';*/
				$output.='<td align="center" >
				<a href="?do=addUserProduct&action=delete&id='.$arr[$i]['product_id'].'" onclick="return confirm(\'Are you sure to delete?\')" title="Delete" >
				<i class="icon-trash"></i></a></td></tr>';
				$val++;
			}
			$output.='<tr>
			<td colspan=5  align=right><b>Sub Total</b></td><td align="right" >'.$_SESSION['currency']['currency_tocken'].number_format($total,2).'
			<input type="hidden" name="hidOrderTotal" value="'.$grandTotal.'"></td></tr>
			<td colspan=5  align=right><b>Shipping Cost</b></td><td align="right" >'.$_SESSION['currency']['currency_tocken'].number_format($shiptotal,2).'
			<input type="hidden" name="hidOrderTotal" value="'.$grandTotal.'"></td>	</tr>
			<td colspan=3  align=left><b>Discount </b>&nbsp;<input type="text" style="width:30%" name="discountrate"  id="discountrate">&nbsp;<select style="width:30%" name="discount" id="discount"><option value="flat">Flat rate</option><option value="percentage">Percentage</option></select>&nbsp;<a href="javascript:void(0);" onclick="coupondiscount('.$grandTotal.');"><input type="button" class="all_bttn" value="Apply" id="add" name="Apply"></a></td>

			<td colspan=2  align=right><b>Grand Total</b></td>
			<td align="right"  id="grandtotal" >'.$_SESSION['currency']['currency_tocken'].number_format($grandTotal,2).'
			<input type="hidden" name="hidOrderTotal" id="hidOrderTotal" value="'.$grandTotal.'"></td>';

		}
		else
			$output.='<tr><td colspan=7 valign="bottom" align="center">No Products Available in the Cart !<br/>&nbsp;</td></tr>';

		$output .= '</tbody></table>';
		return $output;
		
	}
	/**
	 * Function  to display   the shipping details
	 * @param array $res
     	 * @return string
	 */	
	function showShippingDetails($res,$Err)
	{

		

		if($Err->messages>0)
		{
			$output['val']=$Err->values;
			$output['msg']=$Err->messages;
		}
		

		$billCntry='<select name="selbillcountry" id="selbillcountry" class="span6"><option value="">Select Country</option>';
		for($i=0;$i<count($res);$i++)
		{
			$billCntry.='<option value="'.$res[$i]['cou_code'].'">'.$res[$i]['cou_name'].'</option>';
		}
		$billCntry.='</select>';
		
		$shipCntry='<select name="selshipcountry" id="selshipcountry" class="span6"><option value="">Select Country</option>';
		for($i=0;$i<count($res);$i++)
		{
			$shipCntry.='<option value="'.$res[$i]['cou_code'].'">'.$res[$i]['cou_name'].'</option>';
		}
		$shipCntry.='</select>';


		$output1='
		<div class="row-fluid" id="detail">
		<div class="span6">

		<div class="row-fluid" >
		<div class="span12">

		<h2 class="box_head green_bg">Billing Address</h2>
		<div class="toggle_container">
		<div class="clsblock">
		<div class="clearfix">';

		if(count($output['msg'])>0)
		{
			$output1.='<div class="row-fluid">
			<div class="span12" style="text-align:left;"><div class="alert alert-error">
			<button data-dismiss="alert" class="close" type="button">×</button>';

			$error=array($output["msg"]['txtname'],$output["msg"]['txtstreet'],$output["msg"]['txtcity'],$output["msg"]['txtstate'],$output["msg"]["selbillcountry"],$output["msg"]['txtzipcode']);


			foreach ($error as $key => $value) {
				$output1.=$value."<br/>";
			}



			$output1.='</div></div></div>';
		}

		$output1.='<div class="row-fluid">
		<div class="span3">Multi Address</div><div class="span9"> <div id="multiaddressbill"></div></div></div>
		
		<div class="row-fluid">
		<div class="span3"><label>Name <font color="red">*</font></label></div><div class="span9">
		<input name="txtname" type="text" class="span6" id="txtname" value="'.$output["val"]['txtname'].'" /></div>
		</div>
		<div class="row-fluid">
		<div class="span3"><label>Company</label></div><div class="span9">
		<input name="txtcompany" type="text" class="span6" id="txtcompany" value="'.$output["val"]['txtcompany'].'"/></div>
		</div>
		<div class="row-fluid">
		<div class="span3"><label>Address <font color="red">*</font></label></div><div class="span9"><input name="txtstreet" type="text" class="span6" id="txtstreet" value="'.$output["val"]["txtstreet"].'" value='.$output["val"]['txtstreet'].'/></div>
		</div>
		<div class="row-fluid">
		<div class="span3"><label>City <font color="red">*</font></label></div><div class="span9"><input name="txtcity" type="text" class="span6" id="txtcity" value="'.$output["val"]["txtcity"].'"/></div>
		</div>
		<div class="row-fluid">
		<div class="span3"><label>SubUrb </label></div><div class="span9"><input name="txtsuburb" type="text" class="span6" id="txtsuburb" value="'.$output["val"]['txtsuburb'].'" /></div>
		</div>
		<div class="row-fluid">
		<div class="span3"><label>State/Province <font color="red">*</font></label></div><div class="span9"><input name="txtstate" type="text" class="span6" id="txtstate" value="'.$output["val"]["txtstate"].'"  value="'.$output["val"]['txtstate'].'"/></div>
		</div>
		<div class="row-fluid">
		<div class="span3"><label>Country <font color="red">*</font></label></div><div class="span9">'.$billCntry.'</div>
		</div>
		<div class="row-fluid">
		<div class="span3"><label>Zip/Postal Code <font color="red">*</font></label></div><div class="span9"><input name="txtzipcode" type="text" class="span6" id="txtzipcode" value="'.$output["val"]["txtzipcode"].'"/></div>
		</div>';



				// 				<tr>
				// 				<td colspan="3" style="padding-top:10px;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
				// 				<tr>
				// 				<td valign="top" class="content_form" nowrap><div>
				// 					<input type="checkbox" name="chkall" id="chkall" value="checkbox" onclick="javascript:getValues();" />
				// 					Use Billing Address as Shipping Address</div></td><td>&nbsp;<img src="images/help.gif" onmouseover="ShowHelp(\'daddr\', \'Use Billing address\', \'If you select this,your billing address also as shipping address.\')" onmouseout="HideHelp(\'daddr\');">
				// 					<div id="daddr" style="left: 50px; top: 50px;"></div></td>
				// 					
				// 				</tr>
		$output1.='</div></div></div></div></div>

		</div>
		<div class="span6">';




		$output1.='<div class="row-fluid" >
		<div class="span12"><h2 class="box_head green_bg">Shipping Address</h2>
		<div class="toggle_container">
		<div class="clsblock"><div class="clearfix">';

		if(count($output['msg'])>0)
		{
			$output1.='<div class="row-fluid">
			<div class="span12" style="text-align:left;"><div class="alert alert-error">
			<button data-dismiss="alert" class="close" type="button">×</button>';

			$error=array($output["msg"]['txtsname'],$output["msg"]['txtsstreet'],$output["msg"]['txtscity'],$output["msg"]['txtsstate'],$output["msg"]['selshipcountry'],$output["msg"]['txtszipcode']);


			foreach ($error as $key => $value) {
				$output1.=$value."<br/>";
			}



			$output1.='</div></div></div>';
		}

		$output1.='<div class="row-fluid">
		<div class="span3"><label>Multi Address </label></div><div class="span9">
		<div id="multiaddressship"></div></div></div>
		<div class="row-fluid">
		<div class="span3"><label>Name <font color="red">*</font> </label></div><div class="span9">
		<input name="txtsname" type="text" class="span6" id="txtsname" value="'.$output["val"]["txtsname"].'"/>

		</div></div>
		<div class="row-fluid">
		<div class="span3"><label>Company</label></div><div class="span9">
		<input name="txtscompany" type="text" class="span6" id="txtscompany"  value="'.$output["val"]["txtscompany"].'"/></div></div>
		<div class="row-fluid">
		<div class="span3"><label>
		Address <font color="red">*</font></label></div><div class="span9">
		<input name="txtsstreet" type="text" class="span6" id="txtsstreet" value="'.$output["val"]["txtsstreet"].'"/></div></div>
		<div class="row-fluid">
		<div class="span3"><label>
		City <font color="red">*</font></label></div><div class="span9">
		<input name="txtscity" type="text" class="span6" id="txtscity" value="'.$output["val"]["txtscity"].'"/>
		</div></div>
		<div class="row-fluid">
		<div class="span3"><label>SubUrb </label></div><div class="span9">
		<input name="txtssuburb" type="text" class="span6" id="txtssuburb" value="'.$output["val"]["txtssuburb"].'"/></div></div>
		<div class="row-fluid">
		<div class="span3"><label>
		State/Province <font color="red">*</font></label></div><div class="span9">
		<input name="txtsstate" type="text" class="span6" id="txtsstate" value="'.$output["val"]["txtsstate"].'"/>
		</div></div>
		<div class="row-fluid">
		<div class="span3"><label>
		Country <font color="red">*</font></label></div><div class="span9">
		'.$shipCntry.'
		</div></div>
		<div class="row-fluid">
		<div class="span3"><label>Zip/Postal Code <font color="red">*</font></label></div><div class="span9">
		<input name="txtszipcode" type="text" class="span6" id="txtszipcode" value="'.$output["val"]["txtszipcode"].'"/>
		</div></div>

		</div></div>

		</div></div></div></div></div>


		<script> 

		function getValues()
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

		}</script>';
		return $output1;
	}
	
}
?>
