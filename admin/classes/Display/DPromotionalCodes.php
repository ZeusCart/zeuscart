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
 * This class contains  promotional codes related process. 
 *
 * @package  		Display_DPromotionalCodes
 * @category  		Display
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
  * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */
class Display_DPromotionalCodes
{
	/**
	 * Function  to  display the   promotional code
	 * 
	 * @return string
	 */	
	function selectMethodToSendPromotionalCode()
	{
		
		$output = '';
		$output .= '';	
		
		$output.='<table width="90%" border="0" cellpadding="0" cellspacing="0" class="content_list_bdr" align="center">
              <tr>
                <td class="content_list_head" colspan="4">Select Users </td>
				
                
                </tr>
              <tr>
                <td colspan="4" class="cnt_list_bot_bdr"><img src="images/list_bdr.gif" alt="" width="1" height="2" /></td>
              </tr>';
		
			  
		
		$output .= '<tr><td align="left" class="content_list_txt1"><form method="post" action="?do=createpromotionalcodes&action=usersforcoupon">Number Of Orders </td><td align="center" class="content_list_txt1"><select name="order_condition"><option value="&gt">Greater Than</option><option value="&lt;">Less Than</option><option value="=">Equal To</option></select></td><td align="left" class="content_list_txt1"> <input type="text" name="order_from" size="9" value="'.$_POST['order_from'].'"></td><td align="left" class="content_list_txt1"><input class="all_bttn" type="submit" name="b1" value="List"/><input type="hidden" name="type" value="ordercount"></form></td></tr>';
		
		$output .= '<tr><td align="left" class="content_list_txt1"><form method="post" action="?do=createpromotionalcodes&action=usersforcoupon">Total Purchase </td><td align="center" class="content_list_txt1"><select name="order_condition"><option value="&gt">Greater Than</option><option value="&lt;">Less Than</option><option value="=">Equal To</option></select></td><td align="left" class="content_list_txt1"> <input type="text" name="purchase_from" size="9" value="'.$_POST['purchase_from'].'"></td><td align="left" class="content_list_txt1"><input class="all_bttn" type="submit" name="b1" value="List"/><input type="hidden" name="type" value="totalorder"></form></td></tr>';
		
		$output .= '<tr><td align="left" class="content_list_txt1"><form method="post" action="?do=createpromotionalcodes&action=usersforcoupon">Date Of Join Between</td><td align="center" class="content_list_txt1" colspan="2"><input type="text" id="cal-field-1" name="fromdate" size="10" value="'.date('Y/m/d').'" readonly="true"/>&nbsp;<input type="image" src="images/icon_calender.gif" id="cal-button-1" value="cal">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;And&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" id="cal-field-2" name="todate" size="10" value="'.date('Y/m/d').'"  readonly="true"/>&nbsp;<input type="image" src="images/icon_calender.gif" id="cal-button-2" value="cal" ><script type="text/javascript">
			Calendar.setup({
		      inputField    : "cal-field-1",
		      button        : "cal-button-1",
		      align         : "Tr"
		    }); </script>
				<script type="text/javascript">
		    Calendar.setup({
		      inputField    : "cal-field-2",
		      button        : "cal-button-2",
		      align         : "Tr"
		    }); </script></td><td align="left" class="content_list_txt1"><input class="all_bttn" type="submit" name="b1" value="List"/><input type="hidden" name="type" value="user_doj"></form></td></tr>';
		
		$output .= '</table>';
		
		return $output;
		
	}

	/**
	 * Function  to  display the   promotional code for user
	 * @param array $arr
	 * @param integer $flag
	 * @param integer $couponcode
	 * @return string
	 */	
	function displayUsersForPromotionalCode($arr,$flag,$couponcode)
	{
		
		$output = '<form name="sendpromocodes" method="post" action="?do=createpromotionalcodes&action=sendcoupon" >';
		$output .= '';	
		
		if($flag!='0')
			$output .= '<table width="90%" border="0" cellpadding="0" cellspacing="0" class="content_list_bdr" align="center"><tr style="background-color:#FFFFFF;"><td colspan="6" class="content_list_txt1" align="left">Coupon <input type="text" value="'.$couponcode.'" name="couponcode" readonly="true" size="15"><span style="padding-left:350px;"><input class="all_bttn" type="submit" name="b1" value="Send Coupon"/></span></td></tr></table>';
			
		$output.='<table width="90%" border="0" cellpadding="0" cellspacing="0" class="content_list_bdr" align="center">
              <tr>
                <td class="content_list_head">&nbsp;</td>
				<td class="content_list_head" align="center">S.No</td>
                <td class="content_list_head" width="200">User Name</td>
				<td class="content_list_head">Date Of Join</td>
				<td class="content_list_head">Total Purchase ($)</td>
				<td class="content_list_head">Total Orders</td>
				
                
                </tr>
              <tr>
                <td colspan="6 class="cnt_list_bot_bdr"><img src="images/list_bdr.gif" alt="" width="1" height="2" /></td>
              </tr>';
		$cnt = count($arr);
			  
		if($flag=='0')
			$output .= '<tr><td align="center" colspan="6"><font color="orange"><b>No Record Found</b></font></td></tr>';
		else
		{
			for ($i=0;$i<count($arr);$i++)
			{
				$user_doj_dt = explode(" ",$arr[$i]['user_doj']);
				$doj_date = explode("-",$user_doj_dt[0]);
				$doj_time = explode(":",$user_doj_dt[1]);
				$userdoj=date("l, M d, Y ",mktime(0,0,0,$doj_date[1],$doj_date[2],$doj_date[0]));
				
				if($i % 2 == 0)
					$classtd='class="content_list_txt1"';
				else
					$classtd='class="content_list_txt2"';
				$output.='';
				$output .= '<tr style="background-color:#FFFFFF;" onmouseout="listbg(this, 0);" onmouseover="listbg(this, 1);"><td '.$classtd.' ><input type="hidden" name="user_email[]" '.$tmpStr.' value="'.$arr[$i]['user_email'].'"/><input type="checkbox" name="user_id[]" value="'.$arr[$i]['user_id'].'"/>	</td><td '.$classtd.' align="center" >'.($i+1).'</td><td '.$classtd.'>'.$arr[$i]['user_display_name'].'</td><td '.$classtd.'>'.$userdoj.'</td>';
				$output .='<td '.$classtd.' align="right">'.($arr[$i]['totalorder']!='' ? $arr[$i]['totalorder'] : '0.00').'</td><td '.$classtd.'>'.$arr[$i]['ordercount'].'</td>';
				/*$output .='<td '.$classtd.'><a href="?do=editreg&action=edit&id='.$arr[$i]['user_id'].'"><font color="blue">Edit</font></a></td>';*/
				
				
				$output .='</tr>';
			}
			
		}
			$output .= '</table></form>';
			return $output;
			
	
	}
	/**
	 * Function  to  create the   promotional code 
	 * @param array $arr
	 * @param integer $rstr
	 * @return string
	 */	
	function createPromotionalCodes($arr,$rstr)
	{
		$output ='<form name="fm" method="post" action="?do=createpromotionalcodes&action=insert" enctype="multipart/form-data">
<table width="97%" border="0" cellspacing="0" cellpadding="0" align="center">
			<tr>
            <td align="left">
           </td>
          </tr>
		  <tr>
            <td align="left" class="">&nbsp;</td>
          </tr>
          <tr>
            <td align="left" class="content_list_head">Create Coupon Code</td>
          </tr>
          
		  <tr>
            <td align="left"> </td>
          </tr>
          <tr>
            <td align="left" class="content_form_bdr"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="16%" align="left" class="content_form">Coupon Code</td>
                <td width="66%" class="content_form">
				<input type="text" maxlength=25 name="cupon_code" id="cupon_code" value="'.$rstr.'" size="18" disabled /> 
            <span class="errmsg"><strong></strong></span></td>
              </tr>
             <tr>
                <td align="left" class="content_form">Coupon Name</td>
                <td width="66%" class="content_form"><input type="text" maxlength=50 class="txt_box250" name="cupon_name" id="cupon_name" value="" />
            <span class="errmsg"><strong></strong></span></td>
              </tr>
              <tr>
                <td align="left" class="content_form">Discount</td>
                <td width="66%" class="content_form"><input type="text" name="discount_amt" id="discount_amt" size="9" value="" /> 
            <span class="errmsg"><strong></strong></span>&nbsp;&nbsp;
			<select name="discount_type">
				<option value="percent">%</option>
				<option value="amt">'.$_SESSION['currency']['currency_tocken'].'</option>
			</select>
			&nbsp;<img src="images/help.gif" onmouseover="ShowHelp(\'dper\', \'Discount type\', \'Select discount type in $ or %\')" onmouseout="HideHelp(\'dper\');">
			<div id="dper" style="left: 50px; top: 50px;"></div>
			</td>
              </tr> 
			  <tr>
                <td align="left" class="content_form">Valid From</td>
                <td width="66%" class="content_form"><input type="text" name="txtfromdate" id="txtfromdate" size=9  value="" / readonly="true"> <img src="images/calendar_img.gif" id="cal-button-1"/> 
            <span class="errmsg"><strong></strong></span></td>
              </tr>
			  <tr>
                <td align="left" class="content_form">Valid To</td>
                <td width="66%" class="content_form"><input type="text" name="txttodate" id="txttodate" size=9  value="" readonly="true"/>
      <img src="images/calendar_img.gif" id="cal-button-2" /><script type="text/javascript">
            Calendar.setup({
              inputField    : "txtfromdate",
              button        : "cal-button-1",
              align         : "Tr"
            });
          </script><script type="text/javascript">
            Calendar.setup({
              inputField    : "txttodate",
              button        : "cal-button-2",
              align         : "Tr"
            });
          </script>
            <span class="errmsg"><strong></strong></span></td>
              </tr>
         <tr>
                <td align="left" class="content_form">Minimum Purchase Amount&nbsp;'.$_SESSION['currency']['currency_tocken'].'</td>
                <td width="66%" class="content_form"><input type="text"  name="min_purchase" id="min_purchase" value="" size="9"/>
            <span class="errmsg"><strong></strong></span></td>
              </tr>
           
        <tr>
                <td align="left" class="content_form">Number of Uses</td>
                <td width="66%" class="content_form"><input type="text" name="uses_count" id="uses_count" value="" size="9"/>
            <span class="errmsg"><strong></strong></span></td>
              </tr>
			  <tr>
                <td align="left" class="content_form" valign="top">Select Categories</td>
                <td width="66%" class="content_form">';
				$output .= '<div id="catids" style=" border:solid 1px;overflow:auto;height: 156px; width: 253px; "  >';
		$output .= '<ul style="list-style:none">';
	
			
		for ($i=0;$i<count($arr);$i++)
		{
			$output.='<li><input type=checkbox value="'.$arr[$i]['id'].'" name="maincategories['.$i.']" />'.$arr[$i]['catname'];
			$output.='<ul style="list-style:none">';
				foreach($arr[$i]['subcats'] as $subcat)
					$output.='<li><input type=checkbox value="'.$subcat['category_id'].'" name="subcategories[]" />'.$subcat['category_name'].'</li>';
				$output.='</ul>';
			$output.='</li>';
			
		}
			$output .= '</ul>';
			$output .= '</div>';
			
			$output .= '<span class="errmsg"><strong></strong></span></td>
              </tr>
			  <tr>
                <td align="center" class="content_form" colspan="2"><input type="submit" name="button" id="button" value="Create Coupon" class="all_bttn"  /></td>
              </tr>
      </table>
      </td>
      </tr>
      </table>
    </form>';
			return $output;	
	}
	/**
	 * Function  to  create the   promotional code 
	 * @param array $result
	 * @param integer $paging
 	 * @param integer $prev
 	 * @param integer $next
	 * @return string
	 */	
	function displayPromotionalCodes($result,$paging,$prev,$next)
	{
		
	    $output='<div align="right" style="padding:3px;"><a href="?do=createpromotionalcodes" class="add_link">Create Coupon </a></div><form name="frmorders" method="post"><table cellspacing="0" border="0" width="100%" class="content_list_bdr">
		'.(isset($_GET['msg'])? '<div align="center" style="padding:3px;"><font color="green"><b>'.$_GET['msg'].'</b></font></span>' : "" ).'
		
		<tr><td  class="content_list_head">Coupon Code</td><td  class="content_list_head" >Coupon Name</td><td  class="content_list_head">Discount</td><td class="content_list_head" >Valid Form</td><td  class="content_list_head">Valid To</td><td  class="content_list_head">Min Purchase</td><td  class="content_list_head">Uses</td><td  class="content_list_head">Status</td><td  class="content_list_head">Send</td></tr><tr><td colspan="9" class="cnt_list_bot_bdr" valign="top"><img src="images/list_bdr.gif" alt="" width="1" height="2" /></td></tr>';
		$i=1;
		if((count($result))>0)
		{
		    
			foreach($result as $row)
			{
			   	$id= $row['id'];
			   	$coupon_code=$row['coupon_code'];
			   	$coupan_name= $row['coupan_name'];
			   	$created_date = $row['created_date'];
			   	$discount_amt = $row['discount_amt'];
				$discount_type= $row['discount_type'];
				
				if ($discount_type=='amt')
					$discount=$_SESSION['currency']['currency_tocken'].' '.$discount_amt;
				elseif ($discount_type=='percent')
					$discount=$discount_amt.' %';
				
				$valid_from  = $row['valid_from'];
				$valid_to=$row['valid_to'];
				$min_purchase=$row['min_purchase'];
				$no_of_uses=$row['no_of_uses'];
				$status=$row['status'];
				
				$validfrom_date_time = explode(" ",$valid_from);
				$validfrom_date = explode("-",$validfrom_date_time[0]);
				$validfrom_time = explode(":",$validfrom_date_time[1]);
				$validfromdatetime=date("l, M d, Y ",mktime(0,0,0,$validfrom_date[1],$validfrom_date[2],$validfrom_date[0]));
				
				$validto_date_time = explode(" ",$valid_to);
				$validto_date = explode("-",$validto_date_time[0]);
				$validto_time = explode(":",$validto_date_time[1]);
				$validtodatetime=date("l, M d, Y ",mktime(0,0,0,$validto_date[1],$validto_date[2],$validto_date[0]));
			    
				//if($i%2==0)
				//{
						//$output.='<tr ><td  class="content_list_txt2"><a href="?do=disporders&action=detail&id='.$id.'">'.$coupon_code.'</a></td><td  class="content_list_txt2" >'.$coupan_name.'</td><td  class="content_list_txt2">'.$discount.'</td><td  class="content_list_txt2">'.$valid_from.'</td><td  class="content_list_txt2"">'.$valid_to.'</td><td   class="content_list_txt2">$ '.$min_purchase.'</td><td   class="content_list_txt2">'.$no_of_uses.'</td>';
						$output.='<tr style="background-color:#FFFFFF;" onmouseout="listbg(this, 0);" onmouseover="listbg(this, 1);"><td  class="content_list_txt2">'.$coupon_code.'</td><td  class="content_list_txt2" >'. substr($coupan_name,0,12).'</td><td  class="content_list_txt2" align="right">'.$discount.'</td><td  class="content_list_txt2">'.$validfromdatetime.'</td><td  class="content_list_txt2"">'.$validtodatetime.'</td><td   class="content_list_txt2" align="right">'.$_SESSION['currency']['currency_tocken'].' '.$min_purchase.'</td><td   class="content_list_txt2">'.$no_of_uses.'</td>';
						if($status==0)
						{
							$output .='<td   class="content_list_txt2" align="center"><a href="?do=createpromotionalcodes&action=changestatus&status=accept&id='.$id.'" class="inactive_link" title="Click To Enable">&nbsp;</a></td><td class="content_list_txt2"><img class="inactive_link" border="0"></td>';
						}
						else
						{
							$output .='<td   class="content_list_txt2" align="center"><a href="?do=createpromotionalcodes&action=changestatus&status=deny&id='.$id.'" class="active_link" title="Click To Disable">&nbsp;</a></td><td class="content_list_txt2"><a href="?do=createpromotionalcodes&action=usersforcoupon&cid='.$id.'"><img src="images/icon_send1.gif" border="0" alt="Send"></a></td>';
						}
						
						$output.='<tr>';
						
				//}
				//else
				//{
				//		$output.='<tr  class="content_list_txt1"><td  class="content_list_txt1"><input type=checkbox name= "chkorder[]" id=chkorder value="'.$id.'"></td><td  class="content_list_txt1"><a href="?do=disporders&action=detail&id='.$id.'">'.$dispname.'</a></td><td  class="content_list_txt1">'.$id.'</td><td  class="content_list_txt1">'.$purdate.'</td><td  class="content_list_txt1"">'.$bilname.'</td><td   class="content_list_txt1">'.$shipname.'</td><td class="content_list_txt1">'.$amount.'</td><td class="content_list_txt1"><a href="?do=disporders&action=detail&id='.$id.'">'.$dropdowndata.'</a> </td><tr>';
						
				//}
				$i++;
		   }
	        $output.='<tr><td colspan="8" class="content_list_txt1" valign="top" align=center><!--<input type=submit value="Save">--></td></tr>';
		  }
		   else
		   {
		        $output.='<tr><td colspan="9" class="content_list_txt1" valign="top" width="100%"><div class="exc_msgbox"  width="100%" style="width:900px"> Not Present</div></td></tr>';
		   }
		   $output.='<tr align="center"><td colspan="9"  class="content_list_footer" >'.' '.$prev.' ';
		    for($i=1;$i<=count($paging);$i++)
				 $pagingvalues .= $paging[$i]."  ";
				 	 	$output .= $pagingvalues.' '.$next.'</td></tr>';
			$output.='</table></form>';
		
		return $output;
	
	}
	
}	