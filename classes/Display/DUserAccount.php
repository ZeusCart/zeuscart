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
 * User account related  class
 *
 * @package   		Display_DUserAccount
 * @category    	Display
 * @author    		AJ Square Inc Dev Team
 * @link   		http://www.zeuscart.com
  * @copyright 	        Copyright (c) 2008 - 2013, AJ Square, Inc.
 * @version   		Version 4.0
 */
class Display_DUserAccount
{
 	/**
	* This function is used to Display the News Letter Subscription Page
	* @param mixed $arr
	* @return string
 	*/
	function showNewsLetter($arr)
	{
		include_once('classes/Core/CUserNewsLetter.php');
		$value=0;
		
			$value=$arr[0]['subsciption_id'];
			
		$status='';
		if($arr[0]['status']==1)
			$status='checked=checked';
			
		$output='<div class="title_fnt">
		<h1>'.Core_CLanguage::_('NEWS_SUBCRIPTIONS').'</h1>
		</div>
	
		<div id="myaccount_div">
		<form name="frmNewsSub" method="post" action="'.$_SESSION['base_url'].'/index.php?do=newsletter&action=add">
		<div class="control-group">
		<label for="inputPassword" class="control-label"></label>
		<div class="controls">
		<input type="checkbox" name="chkNewsSub" '.$status.' /> <input type="hidden" name="subId" value="'.$value.'" />&nbsp;<strong>'.Core_CLanguage::_('GENERAL_SUBSCRIPTION').'</strong>
		</div>
		</div>
		<div class="control-group">
		<div class="controls">
			<button class="btn btn-danger" type="submit">'.Core_CLanguage::_('SUBMIT').'</button>
		</div>
		</div>
		</form>
	        </div>';
			return $output;
	}

 	/**
	* This function is used to Display the User Dashboard
	* @param mixed $arr
	* @param mixed $arrUser	
	* @param int $status
	* @param int $paging
	* @param int $prev
	* @param int $next	
	* @param int $val
	* @return string
 	*/
	function showDashboard($arr,$arrUser,$status,$paging,$prev,$next,$val)
	{

		$newsStatus=Core_CLanguage::_('YOU_ARE_CURRENTLY_NOT_SUBSCRIBED_TO_NEWSLETTER');
		if($status[0]['status']==1)
			$newsStatus=Core_CLanguage::_('YOU_ARE_CURRENTLY_SUBSCRIBED_TO_NEWSLETTER');
		
		$output='
            	<div class="title_fnt">
    		<h1>'.Core_CLanguage::_('MY_ACCOUNT').'</h1>
        	</div>

		<div id="myaccount_div">
		<div class="myacc_detail">
		<h4>'.Core_CLanguage::_('HELLO').','.$_SESSION['user_name'].'</h4>
		<p>'.Core_CLanguage::_('DASHBOARD_DESCRIPTION').'</p>
			<p class="pull-right"><a href="'.$_SESSION['base_url'].'/index.php?do=myorder" class="btn btn-inverse">'.Core_CLanguage::_('VIEW_ALL').'</a></p>
		<div class="clear"></div>
		<h4>'.Core_CLanguage::_('RECENT_ORDER').'</h4>
		</div>
		<table class="rt cf" id="rt1">
			<thead class="cf">
				<tr>
					<th>'.Core_CLanguage::_('ORDER').'</th>
					<th>'.Core_CLanguage::_('DATE').'</th>
					<th>'.Core_CLanguage::_('SHIP_TO').'</th>
					<th>'.Core_CLanguage::_('ORDER_TOTAL').'</th>
					<th>'.Core_CLanguage::_('STATUS').'</th>
					<th>'.Core_CLanguage::_('DETAIL').'</th>
				</tr>
			</thead>
			<tbody>';
	
			if(count($arr)>0)  
			{
				for($i=0;$i<count($arr);$i++)			  
				{
					$output.='<tr>
					<td>#'.$arr[$i]['orders_id'].'</td>
					<td>'.$arr[$i]['pdate'].'</td>
					<td>'.$arr[$i]['user_display_name'].'</td>
					<td><span class="label label-inverse">'.$arr[$i]['currency_tocken'].number_format($arr[$i]['total']).'</span></td>
					<td> <span class="label label-success">'.$arr[$i]['orders_status_name'].'</span></td>
					<td><a href="'.$_SESSION['base_url'].'/index.php?do=orderdetail&id='.$arr[$i]['orders_id'].'" class="btn btn-mini">'.Core_CLanguage::_('VIEW_ORDER').'</a></td>
					</tr>';
				}


			}
			else
			{
				$output.='<tr><td colspan="6"><div class="alert alert-info">
					<button data-dismiss="alert" class="close" type="button">×</button>
					<strong>'.Core_CLanguage::_('NO_PRODUCT_FOUND').'</strong> 
					</div></td></tr>';
	
			}
				
			$output.='</tbody>
				</table>
				</div>';
			return $output;
	}
	/**
	* This function is used to Display the User Account Information
	* @param mixed $arr
	* @return string
 	*/
	function showAccountInfo($arr)
	{
		include("classes/Lib/HandleErrors.php");		
		
	
		include_once('classes/Core/CUserAccInfo.php');
		if(isset($_SESSION['errmsg']))
		{	
			$result=$_SESSION['errmsg'];
			unset($_SESSION['errmsg']);	
		}
		$usergroup=$arr[0]['groupname'];
		$groupdiscount=$arr[0]['groupdiscount'];
		Core_CUserAccInfo::Ulogin($Err);
		
		$output['val']=$Err->values;
		$output['msg']=$Err->messages;
		

		if(count($output['val'])==0)	
		{
			$fname=$arr[0]['user_fname'];
			$lname=$arr[0]['user_lname'];
			$email=$arr[0]['user_email'];
			$hidcpwd=base64_decode($arr[0]['user_pwd']);
			$hidsubid=$arr[0]['subsciption_id'];;
		}
		else
		{
			$fname=$output['val']['txtFName'];
			$lname=$output['val']['txtLName'];
			$email=$output['val']['txtEmail'];
			//$cpwd=$output['val']['txtCPwd'];
			$npwd=$output['val']['txtNPwd'];
			$cnpwd=$output['val']['txtCNPwd'];
			$hidcpwd=$output['val']['hidCPwd'];
			$hidsubid=$output['val']['hidsubid'];;
		}
		$out=' <div class="title_fnt">
		<h1>'.Core_CLanguage::_('EDIT_ACCOUNT_INFORMATION').'</h1>
		</div>
		
			
		<div id="myaccount_div">
		<form class="form-horizontal" name="frmAcc" method="post" action="'.$_SESSION['base_url'].'/index.php?do=accountinfo&action=add">
		
		<h3 class="accinfo_fnt">'.Core_CLanguage::_('ACCOUNT_INFORMATION').'</h3>
		'.$output['result'].'
		<div class="control-group">
		<label for="inputEmail" class="control-label">'.Core_CLanguage::_('FIRST_NAME').' <i class="red_fnt">*</i></label>
		<div class="controls">
		<input name="txtFName" type="text"  id="txtFName" value="'.$fname.'" /><br/><span style="color:#ff0000">'.$output['msg']['txtFName'].'</span>
		</div>
		</div>
		<div class="control-group">
		<label for="inputPassword" class="control-label">'.Core_CLanguage::_('LAST_NAME').' <i class="red_fnt">*</i></label>
		<div class="controls">
		<input name="txtLName" type="text"  id="txtLName" value="'.$lname.'" /><br/><span style="color:#ff0000">'.$output['msg']['txtLName'].'</span>
		</div>
		</div>
		<div class="control-group">
		<label for="inputPassword" class="control-label">'.Core_CLanguage::_('EMAIL_ADDRESS').'  <i class="red_fnt">*</i></label>
		<div class="controls">
		<input name="txtEmail" type="text"  id="txtEmail" value="'.$email.'" /><br/><span style="color:#ff0000">'.$output['msg']['txtEmail'].'</span><input type="hidden" name="hidsubid" value="'.$hidsubid.'"/>	
		</div>
		</div>
		
		
		<div class="control-group">
		<div class="controls">
		<button class="btn btn-danger" type="submit">'.Core_CLanguage::_('SUBMIT').'</button>&nbsp;<a href="javascript:void(0);" onclick="history.go(-1);"><button class="btn" type="button">'.Core_CLanguage::_('CANCEL').'</button></a>
		</div>
		</div>
		</form>           </div>';


		return $out;
	}
	/**
	* This function is used to Display the change password
	* 
	* @return string
 	*/
	function showChangePassword()
	{
		
		include("classes/Lib/HandleErrors.php");		
		
	
		include_once('classes/Core/CUserAccInfo.php');
		if(isset($_SESSION['errmsg']))
		{	
			$result=$_SESSION['errmsg'];
			unset($_SESSION['errmsg']);	
		}
	
		Core_CUserAccInfo::Ulogin($Err);
		
		$output['val']=$Err->values;
		$output['msg']=$Err->messages;


		if(count($output['val'])==0)	
		{
		
			$hidcpwd=base64_decode($arr[0]['user_pwd']);
			$hidsubid=$arr[0]['subsciption_id'];;
		}
		else
		{
		
			$cpwd=$output['val']['txtCPwd'];
			$npwd=$output['val']['txtNPwd'];
			$cnpwd=$output['val']['txtCNPwd'];
			$hidcpwd=$output['val']['hidCPwd'];
			$hidsubid=$output['val']['hidsubid'];;
		}	
		$output='<div class="title_fnt">
		<h1>'.Core_CLanguage::_('CHANGE_PASSWORD').'</h1>
		</div>
		
			
		<div id="myaccount_div">
		<form class="form-horizontal" name="frmAcc" method="post" action="'.$_SESSION['base_url'].'/index.php?do=changepassword&action=update">
		
		<div class="control-group">
		<label for="inputPassword" class="control-label">'.Core_CLanguage::_('CURRENT_PASSWORD').' <i class="red_fnt">*</i></label>
		<div class="controls">
			<input name="txtCPwd" type="password"  id="txtCPwd"  value="'.$cpwd.'"/><br/><span style="color:#ff0000">'.$output['msg']['txtCPwd'].'</span>
		</div>
		</div>
		<div class="control-group">
		<label for="inputPassword" class="control-label">'.Core_CLanguage::_('NEW_PASSWORD').' <i class="red_fnt">*</i></label>
		<div class="controls">
		<input name="txtNPwd" type="password"  id="txtNPwd"  value="'.$npwd.'"/><br/><span style="color:#ff0000">'.$output['msg']['txtNPwd'].'</span>
		</div>
		</div>
		<div class="control-group">
		<label for="inputPassword" class="control-label">'.Core_CLanguage::_('CONFIRMA_NEW_PASSWORD').' <i class="red_fnt">*</i></label>
		<div class="controls">
		<input name="txtCNPwd" type="password"  id="txtCNPwd"  value="'.$cnpwd.'"/>&nbsp;<br/><span style="color:#ff0000">'.$output['msg']['txtCNPwd'].'</span>
		</div>
		</div>
		<div class="control-group">
		<div class="controls">
		<button class="btn btn-danger" type="submit">'.Core_CLanguage::_('SUBMIT').'</button>&nbsp;<a href="javascript:void(0);" onclick="history.go(-1);"><button class="btn" type="button">'.Core_CLanguage::_('CANCEL').'</button></a>
		</div>
		</div>
		</form>           </div>';

		return $output;

	}
 	/**
	* This function is used to Display the User Product's Review
	* @param mixed $arr
	* @param int $paging
	* @param int $prev
	* @param int $next	
	* @param int $val
	* @return string
 	*/
	function showProductReview($arr,$paging,$prev,$next,$val)
	{

		$showpages='';	
		if(count($arr>0))
		{
		//changepagesize
			$showpages='<li><span class="label label-success">'.count($arr).' </span> &nbsp;'.Core_CLanguage::_('ITEMS').' </li> <li style="float:right">'.Core_CLanguage::_('SHOW').'
					<select name="select2" style="width:50px;" onchange="changepagesize(\'review\',this.value);">';
					$showpages.='<option ';
						if(isset($_GET['totrec'])&&$_GET['totrec']==10)
						$showpages.='selected';
						$showpages.=' value="10" >10</option>';
						$showpages.='<option ';
						if(isset($_GET['totrec'])&&$_GET['totrec']==20)
						$showpages.='selected';
						$showpages.=' value="20" >20</option>';
						$showpages.='<option ';
						if(isset($_GET['totrec'])&&$_GET['totrec']==30)
						$showpages.='selected';
						$showpages.=' value="30" >30</option>';
					$showpages.='</select>
					'.Core_CLanguage::_('PER_PAGE').'</li>';	
		}


		$output='<div class="title_fnt">
		<h1>'.Core_CLanguage::_('MY_PRODUCT_REVIEWS').'</h1>
		</div>
		<div id="myaccount_div">
		<ul class="listviews">
		'.$showpages.'
		<li></li>
		</ul>	
		<div class="myacc_detail">
		<div class="clear"></div>
		</div>
		<table class="rt cf" id="rt1">
			<thead class="cf">
				<tr>
					<th> '.Core_CLanguage::_('PRODUCT').'</th>
					<th>'.Core_CLanguage::_('DATE').'</th>
					<th>'.Core_CLanguage::_('REVIEWS').'</th>
					<th>'.Core_CLanguage::_('RATING').'</th>
					<th>'.Core_CLanguage::_('STATUS').' </th>
					<th>'.Core_CLanguage::_('ACTION').'</th>	
				</tr>
			</thead>
			<tbody>';			
                	if(count($arr)>0)	  
			{
			   	 for($i=0;$i<count($arr);$i++)
				  {

					if($arr[$i]['rating']>0)
							$rating='<img src="'.$_SESSION['base_url'].'/assets/img/star'.$arr[$i]['rating'].'.jpg"/>';
						else
							$rating=Core_CLanguage::_('NO_RATING');

				        $output.='<tr>
					<td>'.$arr[$i]['rdate'].'</td>
					<td><a href="'.$_SESSION['base_url'].'/index.php?do=prodetail&action=showprod&prodid='.$arr[$i]['product_id'].'" >'.$arr[$i]['title'].'</a></td>
                  			<td>'.$arr[$i]['review_caption'].'</td>
					<td>'.$rating.'</td>
					<td>'.$arr[$i]['rstatus'].'</td>
					 <td>
					<a href="?do=prodetail&action=showprod&prodid='.$arr[$i]['product_id'].'" class="btn btn-mini" >'.Core_CLanguage::_('VIEW_DETAILS').'</a>';
              
					$output.='</td>
					</tr>
					</tr>';
				  }
			}
			else
			{
				$output.='<tr><td colspan="6"><div class="alert alert-info">
				<button data-dismiss="alert" class="close" type="button">×</button>
				<strong>'.Core_CLanguage::_('NO_PRODUCT_FOUND').'</strong> 
				</div></td></tr>';

			}	
				
			$output.='</tbody>
				</table>
				</div>';
			
			return $output;
	}
 	/**
	* This function is used to Display the User Wishlist
	* @param mixed $arr
	* @param int $paging
	* @param int $prev
	* @param int $next	
	* @param int $val
	* @param mixed $result
	* @return string
 	*/
	function showWishList($arr,$paging,$prev,$next,$val,$result)
	{
		$output.=$result.'<div class="title_fnt">
		<h1>'.Core_CLanguage::_('MY_WISHLIST').'</h1>
		</div>
		<div id="myaccount_div">
		
		<table class="rt cf" id="rt1">
			<thead class="cf">
				<tr>
					<th></th>
					<th>'.Core_CLanguage::_('PRODUCT_IMAGE').'</th>
					<th>'.Core_CLanguage::_('PRODUCT').'</th>
					<th>'.Core_CLanguage::_('ADDED_ON').'</th>
					<th>'.Core_CLanguage::_('ACTION').'</th>
				</tr>
			</thead>
			<tbody>';
			if(count($arr)>0)
			{
				for($i=0;$i<count($arr);$i++)
				{
					if(file_exists($arr[$i]['image']))
						$img=$arr[$i]['image'];
					else
						$img="'".$_SESSION['base_url']."/index.phpimages/noimage.jpg";
	
					$output.='<tr>
					<td><a href="'.$_SESSION['base_url'].'/index.php?do=wishlist&action=deletewishlist&prodid='.$arr[$i]['product_id'].'"><img src="assets/img/bullet.gif" alt="remove" width="14" height="14" style="border:none"/></td>
					<td><a href="'.$_SESSION['base_url'].'/index.php?do=prodetail&action=showprod&prodid='.$arr[$i]['product_id'].'">
					<img src="'.$img.'" alt="" width="52" height="52" style="border:none" /></a></td><td><a href="?do=prodetail&action=showprod&prodid='.$arr[$i]['product_id'].'">'.$arr[$i]['title'].'<br /><!--$-->
						  '.$_SESSION['currencysetting']['selected_currency_settings']['currency_tocken'].number_format($arr[$i]['msrp'],2).'</a></td>
					<td>'.$arr[$i]['adate'].'</td>
					<td><a class="btn btn-mini" href="?do=prodetail&action=showprod&prodid='.$arr[$i]['product_id'].'">'.Core_CLanguage::_('VIEW_PRODUCT').'</a></td>
					</tr>';
				}
				
			}
			else
			{
				$output.='<tr><td colspan="6"><div class="alert alert-info">
				<button data-dismiss="alert" class="close" type="button">×</button>
				<strong>'.Core_CLanguage::_('NO_PRODUCTS_WISHLIST_FOUND').'</strong> 
				</div></td></tr>';

			}	
				
			$output.='</tbody>
					</table>
					</div>';	
				
		
		 	
		
		$_SESSION['wishList']=$output;			
		return $output;
	}	

 	/**
	* This function is used to get the User wishlist to send to the friend
	* @param mixed $arr
	* @return string
 	*/
	function getWishList($arr)
	{
		$output.='<table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="#cac7c7">
			<tr>
			  <td width="71%" bgcolor="#FFFFFF" class="viewcartTITLE" style="padding-left:15px;">Product Name</td>
			  <td width="15%" align="center" bgcolor="#FFFFFF" class="viewcartTITLE" >Added On </td>
			 </tr>';


		 for($i=0;$i<count($arr);$i++)
		  {
			$output.='<tr>
			  <td colspan="5" align="center" bgcolor="#FFFFFF" style="padding:15px 0px">
			  <table width="100%" border="0" cellpadding="0" cellspacing="0">
				  <tr>
					<td width="52" align="left"><a href="http://'.$_SERVER['SERVER_NAME'].'/?do=prodetail&action=showprod&prodid='.$arr[$i]['product_id'].'"><img src="http://'.$_SERVER['SERVER_NAME'].'/'.$arr[$i]['image'].'" alt="" width="52" height="52" style="border:none" /></a></td>
					<td width="350" align="center" class="viewcartTXT1"><a href="http://'.$_SERVER['SERVER_NAME'].'/?do=prodetail&action=showprod&prodid='.$arr[$i]['product_id'].'">'.$arr[$i]['title'].'<br />$
					  '.number_format($arr[$i]['msrp'],2).'</a></td>
					<td width="93" align="center" class="viewcart_price">'.$arr[$i]['adate'].'</td>
					</tr>
			  </table></td>
			</tr>';
		 }
		 $output.='</table>';
		return $output;
	}
	
 	/**
	* This function is used to Display the User's Order info
	* @param mixed $arr
	* @param int $paging
	* @param int $prev
	* @param int $next	
	* @param int $val
	* @return string
 	*/
	function showMyOrder($arr,$paging,$prev,$next,$val)
	{

		$showpages='';	
		if(count($arr>0))
		{
			//changepagesize
			$showpages='<li><span class="label label-success">'.count($arr).' </span> &nbsp;'.Core_CLanguage::_(ITEMS).' </li> <li style="float:right">'.Core_CLanguage::_(SHOW).'
			<select name="select2" style="width:50px;" onchange="changepagesize(\'order\',this.value);">';
			$showpages.='<option ';
			if(isset($_GET['totrec'])&&$_GET['totrec']==10)
			$showpages.='selected';
			$showpages.=' value="10" >10</option>';
			$showpages.='<option ';
			if(isset($_GET['totrec'])&&$_GET['totrec']==20)
			$showpages.='selected';
			$showpages.=' value="20" >20</option>';
			$showpages.='<option ';
			if(isset($_GET['totrec'])&&$_GET['totrec']==30)
			$showpages.='selected';
			$showpages.=' value="30" >30</option>';
			$showpages.='</select>
			'.Core_CLanguage::_(PER_PAGE).'</li>';	
		}


		$output='
           	 <div class="title_fnt">
    		<h1>'.Core_CLanguage::_(MY_ORDERS).'</h1>
        	</div><div id="myaccount_div">
               <ul class="listviews">
                	'.$showpages.'
              </ul>
              <div class="clear"></div>
             <table class="rt cf" id="rt1">
		<thead class="cf">
			<tr>
				<th>'.Core_CLanguage::_(ORDER).'</th>
				<th>'.Core_CLanguage::_(DATE).'</th>
				<th>'.Core_CLanguage::_(ORDER_TOTAL).'</th>
               	<th>'.Core_CLanguage::_(TRACK_ID).'</th>
				<th>'.Core_CLanguage::_(STATUS).'</th>
				<th>'.Core_CLanguage::_(ACTION).'</th>
				
			</tr>
			</thead>
			<tbody>';
			 if(count($arr)>0)	  
			{
				for($i=0;$i<count($arr);$i++)
				{
					$output.='<tr>
					<td><a href="?do=orderdetail&id='.$arr[$i]['orders_id'].'">#'.$arr[$i]['orders_id'].'</a></td>
					<td>'.$arr[$i]['pdate'].'</td>
					<td><span class="label label-inverse">'.$arr[$i]['currency_tocken'].number_format($arr[$i]['total'],2).'</span></td>
					
					<td>'.$arr[$i]['shipment_track_id'].'</td>
					<td><span class="label label-important">'.Core_CLanguage::_(ORDER_STATUS_NAME.$arr[$i]['orders_status']).'</span></td>
					<td><a href="?do=orderdetail&id='.$arr[$i]['orders_id'].'" class="btn btn-mini">'.Core_CLanguage::_(VIEW_ORDER).'</a></td>
					</tr>';
				}
			}
			else
			{

			$output.='<tr><td colspan="6"><div class="alert alert-info">
			<button data-dismiss="alert" class="close" type="button">×</button>
			<strong>'.Core_CLanguage::_(NO_ORDERS_FOUND).'</strong>
			</div></td></tr>';

			}
			
			
		$output.='</tbody>
			</table>
			</div>';


		$output.='<div class="pagination">
			<ul>';
			if($prev!='')
			{
				$output .='<li> '.$prev.' </li>';
			}
			for($i=1;$i<=count($paging);$i++)
			{
				$output .='<li>'.$paging[$i].'</li>';
			}
			if($next!='')
			{
				$output .='<li>'.$next.'</li>';
			}
				
			$output .='</ul>
			</div>';	
				
		return $output;
	}
	
 	/**
	* This function is used to Display the Order info
	* @param mixed $arr
	* @return string
 	*/
	function showOrderDetails($arr)
	{
	

		//shipcost
		$order_ship=$arr[0]['order_ship'];
		$shipping_method=trim($arr[0]['shipping_method']);	

		if($arr[0]['shipment_id_selected']!='1')
		{	
			$shipdurationrecords=array("0"=>"Select","1D"=>"Next Day Air Early AM","1DA"=>"Next Day Ai","1DP"=>"Next Day Air Saver","2DM"=>"2nd Day Air AM","2DA"=>"2nd Day Air","3DS"=>"3 Day Select","GND"=>"Ground","STD"=>"Canada Standar","XPR"=>"Worldwide Express","XDM"=>"Worldwide Express Plus","XPD"=>"Worldwide Expedited","WXS"=>"Worldwide Save");
			foreach($shipdurationrecords as $key=>$value)	
			{
				if($key==$shipping_method)
				{		
					$ship_duration=$value;
				}
			}
			$ups_ship_method='<tr>
			<td>'.Core_CLanguage::_(SHIP_DURATION).'</td>
			<th>'.$ship_duration.'</th>
			</tr>';
		}
		$output=' <div class="title_fnt">
		<h1>'.Core_CLanguage::_(ORDER_DETAILS).'</h1>
		<span><a href="javascript:window.open (\'?do=orderdetail&action=print&id='.$arr[0]['orders_id'].'\',\'mywindow\',\'location=1,status=1,scrollbars=1,width=920,height=700\');void(0);"><button name="color" type="button" class="btn btn-danger" value="btn btn-danger">Print</button></a>
		</span>

		
		</div>
		
		<div id="myaccount_div">
		<div class="myacc_detail">
				<div class="clear"></div>
				<div class="row-fluid">
				<div class="span6"><h4>'.Core_CLanguage::_(ORDER_INFORMATION).'</h4>
			<table class="table table-striped table-bordered">
			<tr>
			<td>'.Core_CLanguage::_(ORDER_ID).'</td>
			<th>#'.$arr[0]['orders_id'].'</th>
			</tr>
			<tr>
			<td>'.Core_CLanguage::_(ORDER_STATUS).' </td>
			<th><span class="label label-success">'.Core_CLanguage::_(ORDER_STATUS_NAME.$arr[0]['orders_status']).'</span></th>
			</tr>
			<tr>
			<td>'.Core_CLanguage::_(ORDER_TOTAL).'</td>
			<th>'.$arr[0]['currency_tocken'].''.$arr[0]['order_total'].'</th>
			</tr>
			<tr>
			<td>'.Core_CLanguage::_(ORDER_DATE).'</td>
			<th>'.$arr[0]['purDate'].'</th>
			</tr>
			<tr>
			<td>'.Core_CLanguage::_(CLOSE_DATE).'</td>
			<th>'.$arr[0]['closeDate'].'</th>
			</tr>
			</table>
				
			</div>

			<div class="span6">
			<table class="table table-striped table-bordered"><h4>'.Core_CLanguage::_(PAYMENT_DETAILS).' </h4>
			<tr>
			<td>'.Core_CLanguage::_(PAID_THROUGH).'</td>
			<th>'.$arr[0]['gateway_name'].'</th>
			</tr>
			
			</table>
			<table class="table table-striped table-bordered"><h4>'.Core_CLanguage::_(SHIPPING_DETAILS).'</h4>
			<tr>
			<td>'.Core_CLanguage::_(SHIP_THROUGH).'</td>
			<th>'.$arr[0]['shipment_name'].'</th>
			</tr>
			'.$ups_ship_method.'
			<tr>
			<td>'.Core_CLanguage::_(SHIP_TRACK_ID).'</td>
			<th>'.$arr[0]['shipment_track_id'].'</th>
			</tr>
			</table>
			</div>
			</div>
           		<div class="row-fluid">
           		  <div class="span6"><h4>'.Core_CLanguage::_(BILLING_ADDRESS).'</h4><ul class="addresslist">
			<li><address>
			
			<p>'.$arr[0]['billing_name'].'</p>
			<p>'.$arr[0]['billing_company'].'</p>
			<p> '.$arr[0]['billing_street_address'].'</p>
			<p>'.$arr[0]['billing_city'].'</p>
			
			<p>'.$arr[0]['billing_postcode'].'</p>
			
			<p>'.$arr[0]['billing_state'].'</p>
			
			<p>'.$arr[0]['billcountry'].'</p>
			</address></li></ul>

                 	 </div>
                        <div class="span6"><h4>'.Core_CLanguage::_(SHIPPING_ADDRESS).'</h4>
			<ul class="addresslist">
			<li><address>
			<p>'.$arr[0]['shipping_name'].'</p>
			
			<p>'.$arr[0]['shipping_company'].'</p>
			
			<p> '.$arr[0]['shipping_street_address'].'</p>
			
			<p>'.$arr[0]['shipping_city'].'</p>
			
			<p>'.$arr[0]['shipping_postcode'].'</p>
		
			<p>'.$arr[0]['shipping_state'].'</p>
			
			<p>'.$arr[0]['shipcountry'].'</p>
			
			</address></li></ul>
				</div>
			</div>
				

		
			<h4>'.Core_CLanguage::_(ITEM_DETAILS).'</h4>
			
			<div class="clear"></div>
			</div>
			<table class="rt cf" id="rt1">
			<thead class="cf">
			<tr>
				<th>'.Core_CLanguage::_(ITEM_DETAILS).'</th>
				<th>'.Core_CLanguage::_(PRICE).'</th>
				<th>'.Core_CLanguage::_(QUANTITY).'</th>
				<th>'.Core_CLanguage::_(TOTAL).'</th>
			</tr>
			</thead>
			<tbody>';
			$grand=0;
			$ship_cost=0;
			for($i=0;$i<count($arr);$i++)
			{

				$variation='';
				//select variation size
				if(trim($arr[$i]['variation_id'])!='0' && $arr[$i]['variation_id']!='')
				{
					$sqlSize="SELECT * FROM  product_variation_table WHERE variation_id='".$arr[$i]['variation_id']."' AND product_id='".$arr[$i]['product_id']."'";
					$objSize=new Bin_Query();
					$objSize->executeQuery($sqlSize);
					$size=$objSize->records[0]['variation_name'];
					$variation='<span class="label">'.Core_CLanguage::_(SIZE).' - '.''.$size.'</span>';
				}

				$total=$arr[$i]['product_unit_price']*$arr[$i]['product_qty'] ;
				$output.='<tr>
					<td>'.$arr[$i]['title'].' <br/>'.$variation.'</td>
					<td><span class="label label-info">'.$arr[$i]['currency_tocken'].'&nbsp;'.number_format($arr[$i]['product_unit_price'],2).'</span></td>
					<td>'.$arr[$i]['product_qty'].'</td>
					
					<td><span class="label label-inverse">'.$arr[$i]['currency_tocken'].'&nbsp;'.number_format($total,2).'</span></td>
				</tr>';
				$grand+=$total;
				$ship_cost+=$arr[$i]['shipping_cost'];
			}
				$output.='<tr>
				<td colspan="2" rowspan="3">&nbsp;</td>
				<td>'.Core_CLanguage::_(SUB_TOTAL).'</td>
				<td><span class="label label-success">'.$arr[0]['currency_tocken'].'&nbsp;'.number_format($grand,2).'</span>	</td>
			</tr>
				<tr>
				<td>'.Core_CLanguage::_(SHIPPING_AMOUNT).'</td>
				<td><span class="label label-inverse">'.$arr[0]['currency_tocken'].'&nbsp;'.number_format($order_ship,2).'</span></td>
			</tr>
				<tr>
				<td>'.Core_CLanguage::_(GRAND_TOTAL).'</td>
				<td><span class="label label-important">'.$arr[0]['currency_tocken'].'&nbsp;'.number_format($arr[0]['order_total'],2).'</span></td>
			</tr>
			</tbody>
		</table>
		</div>';
		return $output;	
	}
 	/**
	* This function is used to Display the All New Products
	* @param mixed $arr
	* @param int $paging
	* @param int $prev
	* @param int $next	
	* @param int $val
	* @return string
 	*/
	function showAllNew($arr,$paging,$prev,$next,$val)
	{
	
			$output.='
			<div><table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
		<td class="serachresult">All New Products </td>
		</tr>
		
		<tr>
		<td align="left" valign="top">
			<div>
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
		
		<tr align="right"><td class="content_list_footer" colspan=2 ><div>'.' '.$prev.' ';
							for($i=1;$i<=count($paging);$i++)
							$pagingvalues .= $paging[$i]."  ";
									$output .= $pagingvalues.' '.$next.'</div></td></tr>
		<tr>
			<td colspan="2">&nbsp;</td>
		</tr>
		<tr>
			<td width="800%" colspan="2">';
		
		$k=0;
		for($i=0;$i<count($arr)/4;$i++)
		{
			$output.='<table width="100%" border="0" cellspacing="0" cellpadding="0">
			  <tr>';
			  for($j=0;$j<4;$j++)
			  {

			  	$rating=ceil($arr[$k]['rating']);
				$ratepath='';
				for($r=0;$r<5;$r++)
				{
					if($r<$rating)
						$ratepath.='<img src="images/starf.png">';
					else
						$ratepath.='<img src="images/stare.png">';							
				}
			  
				  if($arr[$k]['thumb_image']!='' && file_exists($arr[$k]['thumb_image']))
						$imgPath=$arr[$k]['thumb_image'];
				  else
						$imgPath='images/noimage1.jpg';
					
				$mode='none';		
				if($arr[$k]['product_id']!='')	
					$mode='block';
					
					
					$output.='<td width="25%" align="center" style="';
					if($j<3 && $mode=='block')
						$output.='background:url(images/bg_line1.gif) repeat-y right';
					$output.='"><div class="featureITEM" style="display:'.$mode.'"><a href="'.$_SESSION['base_url'].'/index.php?do=prodetail&action=showprod&prodid='.$arr[$k]['product_id'].'"><img src="'.$imgPath.'" alt="'.addslashes($arr[$k]['title']).'"  width="'.THUMB_WIDTH.'" border=0 /></a>
							<div class="featureTXT"><a href="'.$_SESSION['base_url'].'/index.php?do=prodetail&action=showprod&prodid='.$arr[$k]['product_id'].'">'.((strlen($arr[$k]['title'])>15) ? substr( $arr[$k]['title'],0,15).'...' : $arr[$k]['title']).'</a></div>
					  <div class="featurePRICE"><!--Price :--> <!--$-->'.$_SESSION['currencysetting']['selected_currency_settings']['currency_tocken'].number_format($arr[$k]['msrp']*$_SESSION['currencysetting']['selected_currency_settings']['conversion_rate'],2).'<br />
								'.$ratepath.'</div>
					  <!--<div class="featureBUTTON">
							  <table border="0" cellspacing="0" cellpadding="0">
								<tr>
								  <td align="right" class="button_left"> </td>
								  <td><a href="'.$_SESSION['base_url'].'/index.php?do=addtocart&prodid="><a href="'.$_SESSION['base_url'].'/index.php?do=prodetail&action=showprod&prodid='.$arr[$k]['product_id'].'"><input type="submit" name="Submit23222" value="       Buy Now      " class="button" /></a></td>
								  <td class="button_right" ></td>
								</tr>
							  </table>
						<a href="#"></a></div>-->
					  <div class="featureBUTTON">
					  <form name="addtowishlist" id="addtowishlist" action="'.$_SESSION['base_url'].'/index.php?do=wishlist&action=viewwishlist&prodid='.$arr[$k]['product_id'].'" method="post">
							  <table border="0" cellspacing="0" cellpadding="0">
								<tr>
								  <td align="right" class="button_left" style="cursor:pointer" ></td>
								  <td><input type="submit" name="Submit232222" value="Add to Wishlist" class="button" style="cursor:pointer" /></td>
								  <td class="button_right" style="cursor:pointer" ></td>
								</tr>
							  </table>
							  </form>
						</div>
					</div></td>';
				
				$k++;
			}
			  $output.='</tr>
			  <tr>
				<td align="center" colspan=4>&nbsp;</td>
			  </tr>
			</table>';
			
		}
		$output.='</td>
			  </tr>
			  
			  <tr>
				<td colspan="2" valign="top">&nbsp;</td>
			  </tr>
			   <tr><td class="content_list_footer" ><a href="'.$_SESSION['base_url'].'/index.php?do=rss" style="text-decoration:none" target="_blank"><img src="'.$_SESSION['base_url'].'/images/rss.gif" border=0/></a></td><td class="content_list_footer" align="right">'.' '.$prev.' ';
							for($i=1;$i<=count($paging);$i++)
							 $pagingvalues1 .= $paging[$i]."  ";
									$output .= $pagingvalues1.' '.$next.'</td></tr>
			</table>
			</div>
			</td>
		  </tr>
		  
		  
		</table>
		</div>';
		return $output;
	}
	
 	/**
	* This function is used to Display the All Featured product
	* @param mixed $arr
	* @param int $paging
	* @param int $prev
	* @param int $next	
	* @param int $val
	* @return string
 	*/
	function showAllFeatured($arr,$paging,$prev,$next,$val)
	{
	
		$output.='<div><table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
		<td class="serachresult">All Featured Products </td>
		</tr>
		<tr>
		<td align="left" valign="top">
			<div>
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
		
		<tr align="right"><td class="content_list_footer" >'.' '.$prev.' ';
							for($i=1;$i<=count($paging);$i++)
							$pagingvalues .= $paging[$i]."  ";
									$output .= $pagingvalues.' '.$next.'</td></tr>
		<tr>
			<td colspan="2">&nbsp;</td>
		</tr>
		<tr>
			<td width="800%" colspan="2">';
				
		$k=0;
		for($i=0;$i<count($arr)/4;$i++)
		{
			$output.='<table width="100%" border="0" cellspacing="0" cellpadding="0">
			  <tr>';
			  for($j=0;$j<4;$j++)
			  {

			  	$rating=ceil($arr[$k]['rating']);
				$ratepath='';
				for($r=0;$r<5;$r++)
				{
					if($r<$rating)
						$ratepath.='<img src="'.$_SESSION['base_url'].'/images/starf.png">';
					else
						$ratepath.='<img src="'.$_SESSION['base_url'].'/images/stare.png">';							
				}
			  
				  if($arr[$k]['thumb_image']!='' && file_exists($arr[$k]['thumb_image']))
						$imgPath=$arr[$k]['thumb_image'];
				  else
						$imgPath=''.$_SESSION['base_url'].'/images/noimage1.jpg';
					
				$mode='none';		
				if($arr[$k]['product_id']!='')	
					$mode='block';
				
					
					$output.='<td width="25%" align="center" style="';
					if($j<3 && $mode=='block')
						$output.='background:url(images/bg_line1.gif) repeat-y right';
					$output.='"><div class="featureITEM" style="display:'.$mode.'"><a href="'.$_SESSION['base_url'].'/index.php?do=prodetail&action=showprod&prodid='.$arr[$k]['product_id'].'"><img src="'.$imgPath.'" alt="'.addslashes($arr[$k]['title']).'" width="'.THUMB_WIDTH.'" border=0 /></a>
							<div class="featureTXT"><a href="?do=prodetail&action=showprod&prodid='.$arr[$k]['product_id'].'">'.((strlen($arr[$k]['title'])>15) ? substr( $arr[$k]['title'],0,15).'...' : $arr[$k]['title']).'</a></div>
					  <div class="featurePRICE"><!--Price :--> <!--$-->'.$_SESSION['currencysetting']['selected_currency_settings']['currency_tocken'].number_format($arr[$k]['msrp']*$_SESSION['currencysetting']['selected_currency_settings']['conversion_rate'],2).'<br />
								'.$ratepath.'</div>
					  <!--<div class="featureBUTTON">
							  <table border="0" cellspacing="0" cellpadding="0">
								<tr>
								  <td align="right" class="button_left"></td>
								  <td><a href="'.$_SESSION['base_url'].'/index.php?do=addtocart&prodid='.$arr[$k]['product_id'].'"><a href="'.$_SESSION['base_url'].'/index.php?do=prodetail&action=showprod&prodid='.$arr[$k]['product_id'].'"><input type="submit" name="Submit23222" value="       Buy Now      " class="button" /></a></td>
								  <td class="button_right"></td>
								</tr>
							  </table>
						<a href="#"></a></div>-->
					  <div class="featureBUTTON">
							  <table border="0" cellspacing="0" cellpadding="0">
								<tr>
								  <td align="right" class="button_left"></td>
								  <td><a href="'.$_SESSION['base_url'].'/index.php?do=wishlist&action=viewwishlist&prodid='.$arr[$k]['product_id'].'" style="text-decoration:none;"><form method="post" action="'.$_SESSION['base_url'].'/index.php?do=wishlist&action=viewwishlist&prodid='.$arr[$k]['product_id'].'"><input type="submit" name="Submit232222" value="Add to Wishlist" class="button" /></form></a></td>
								  <td class="button_right"></td>
								</tr>
							  </table>
						<a href="#"></a></div>
					</div></td>';
				
				$k++;
			}
			  $output.='</tr>
			  <tr>
				<td align="center" colspan=4>&nbsp;</td>
			  </tr>
			</table>';
			
		}
		$output.='</td>
			  </tr>
			  
			  <tr>
				<td colspan="2" valign="top">&nbsp;</td>
			  </tr>
			   <tr align="right"><td class="content_list_footer" >'.' '.$prev.' ';
							for($i=1;$i<=count($paging);$i++)
							 $pagingvalues1 .= $paging[$i]."  ";
									$output .= $pagingvalues1.' '.$next.'</td></tr>
			</table>
			</div>
			</td>
		  </tr>
		  
		  
		</table>
		</div>';
		return $output;
	}
	/**
	* This function is used to Display the  Address
	* @param array $arr
	* @return string
 	*/
	function showAddress($arr)
	{
	$output.='<div><table width="100%" border="0" cellspacing="0" cellpadding="0">
		  <tr>
			<td class="serachresult">Address Book </td><td align="right" class="account_address">
			<a href="'.$_SESSION['base_url'].'/index.php?do=addressbook" class="categoryList">View Contact</a>|
			<a href="'.$_SESSION['base_url'].'/index.php?do=addaddress" class="categoryList">Add Contact</a>
			</td>
		  </tr>
		  <tr>
			<td align="left" valign="top" colspan=2>
			<div>
			<table width="100%" border="0" cellspacing="0" cellpadding="0">';
			  $k=0;	
			  $output.='<tr>';
			  $output.='<td width="50%" valign="top" class="account_address">';
				if($arr[$k]['contact_name']!='')
				{
					$output.='<strong style="color:#333333">'.$arr[$k]['contact_name'].' Address details</strong><br /><h1>'.$arr[$k]['first_name'].' '.$arr[$k]['last_name'].'</h1>
					  '.$arr[$k]['company'].'<br />
					  '.$arr[$k]['address'].'<br />
					  '.$arr[$k]['city'].', '.$arr[$k]['zip'].', '.$arr[$k]['state'].'<br />
					  <h2>'.$arr[$k]['cou_name'].'</h2>
					  Phone No : '.$arr[$k]['phone_no'].'<br />
					  Fax : '.$arr[$k]['fax'].'<br />
					  Email :<span><a href="mailto:'.$arr[$k]['email'].'">'.$arr[$k]['email'].'</a></span><br />
					  <a href="?do=addaddress&id='.$arr[$k]['contact_name'].'">Edit Address</a>|
					  <a href="?do=deladdress&id='.$arr[$k]['contact_name'].'" onclick="return confirm(\'Are you Sure to delete?\');">Delete Address</a>';
				}	  
			  $output.='</tr>';
			$output.='</table>
			</div>
			</td>
		  </tr>
		   <tr align="right"><td class="content_list_footer" colspan=2>'.' '.$prev.' ';
				for($i=1;$i<=count($paging);$i++)
				 $pagingvalues1 .= $paging[$i]."  ";
						$output .= $pagingvalues1.' '.$next.'</td></tr>
		</table>
	</div>';
		return $output;
	}
	/**
	* This function is used to Display the All Address
	* @param mixed $arr
	* @param int $paging
	* @param int $prev
	* @param int $next	
	* @param int $val
	* @param array $recordsadd
	* @return string
 	*/
	function showAddressBook($arr,$paging,$prev,$next,$val,$recordsadd)
	{
	
		$output='<div class="title_fnt">
		<h1>'.Core_CLanguage::_('ADDRESS_BOOK').'</h1>
		</div>';

		$srhlist='';
		foreach(range('A', 'Z') as $letter) {
   		 $srhlist.='<a href="'.$_SESSION['base_url'].'/index.php?do=addressbook&schltr='.$letter.'" class="btn_address">'.$letter.'</a>';
		}
		$srhlist.='&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;<a href="'.$_SESSION['base_url'].'/index.php?do=addressbook&schltr=All"class="btn">All</a>';
		$output.='<div class="span11">
			'.$errnsg.'
		<div>
		<a href="'.$_SESSION['base_url'].'/index.php?do=addaddress" class="btn">'.Core_CLanguage::_('ADD_NEW_CONTACT').'</a>&nbsp;&nbsp;&nbsp;&nbsp;</div>
		<div>&nbsp;</div>';
			if(!isset($_GET['gname']))
			$output.='<div style="margin: 0;" class="btn-toolbar">
			<div class="btn">'.$srhlist.' 
			</div>
			</div>';
		
		$output.="<div>&nbsp;</div>";

		for($k=0;$k<count($arr);$k++)	
		{
			$output.='<div class="span5"><ul class="addresslist"><li><address>
                                    	<h5>'.$arr[$k]['contact_name'].'</h5>
                                        <p>'.$arr[$k]['first_name'].' '.$arr[$k]['last_name'].'</p>
                                        <p><a href="mailto:'.$arr[$k]['email'].'">&nbsp;'.$arr[$k]['email'].'</a></p>
					<p>'.$arr[$k]['city'].', '.$arr[$k]['state'].'</p>
					<p>'.$arr[$k]['zip'].'</p>	
					<p><a class="btn btn-success " href="'.$_SESSION['base_url'].'/index.php?do=addaddress&id='.$arr[$k]['contact_name'].'&address_id='.$arr[$k]['id'].'">'.Core_CLanguage::_('EDIT').'</a><a class="btn btn-danger " onclick="return confirm(\'Are you Sure to delete?\');" href="'.$_SESSION['base_url'].'/index.php?do=deladdress&id='.$arr[$k]['contact_name'].'&address_id='.$arr[$k]['id'].'">'.Core_CLanguage::_('DEL').'</a>';
// 					if($recordsadd['billing_address_id']==$arr[$k]['id'])
// 					{
// 
// 					$output.='<img src="'.$_SESSION['base_url'].'/assets/img/address.gif" title="Default Billing Address">';
// 					}
// 					if($recordsadd['shipping_address_id']==$arr[$k]['id'])
// 					{
// 
// 					$output.='<img src="'.$_SESSION['base_url'].'/assets/img/address.gif" title="Default Shipping Address">';
// 					}
					$output.='</p>

                                    </address></li></ul>

         `		 </div>';

		}

		$output.='</div>';
		return $output;
	}
	/**
	* This function is used to Display the Add Address
	* @param  array $arrCountry
	* @param  array $arrAdd
	* @param array $recordsadd
	* @return string
 	*/
	function showAddAddress($arrCountry,$arrAdd=array(),$recordsadd)
	{

		include("classes/Lib/HandleErrors.php");
		include_once('classes/Core/CUserAddressBook.php');
		Core_CUserAddressBook::Ulogin($Err);
		$output['val']=$Err->values;
		$output['msg']=$Err->messages;
		

		if(count($arrAdd)>0 && count($output['val'])==0)	
		{
			$gName=$arrAdd[0]['contact_name'];
			$fName=$arrAdd[0]['first_name'];
			$lName=$arrAdd[0]['last_name'];
			$company=$arrAdd[0]['company'];
			$eMail=$arrAdd[0]['email'];
			$address=$arrAdd[0]['address'];
			$city=$arrAdd[0]['city'];
			$suburb=$arrAdd[0]['suburb'];
			$state=$arrAdd[0]['state'];
			$country=$arrAdd[0]['country'];
			$zip=$arrAdd[0]['zip'];
			$telephone=$arrAdd[0]['phone_no'];
			$fax=$arrAdd[0]['fax'];
			$status=(isset($_GET['id'])?1:0);
			$group=$_GET['id'];
		}
		else
		{
			$gName=$output['val']['txtGName'];
			$fName=$output['val']['txtFName'];
			$lName=$output['val']['txtLName'];
			$company=$output['val']['txtCompany'];
			$eMail=$output['val']['txtEMail'];
			$address=$output['val']['txtAddress'];
			$city=$output['val']['txtCity'];
			$suburb=$output['val']['txtSuburb'];
			$state=$output['val']['txtState'];
			$country=$output['val']['selCountry'];
			$zip=$output['val']['txtZip'];
			$telephone=$output['val']['txtPhone'];
			$fax=$output['val']['txtFax'];
			$status=$output['val']['hidStatus'];		
			$group=$output['val']['hidGroup'];		
		}

		if($status==1)
		{
			$buttonCaption='Update';
			$action="edit";
			$readonly="readonly";
		}
		else
		{
			$buttonCaption='Create';			
			$action="add";	
			$readonly="";			
		}


		$output1.='<div class="title_fnt">
		<h1>'.Core_CLanguage::_('ADDRESS_BOOK').'</h1>
		</div>
	
		<div id="myaccount_div">
		<form class="form-horizontal" method="post" action="?do=addaddress&action='.$action.'&address_id='.$_GET['address_id'].'" name="frmAddress">
		<input type="hidden" name="hidStatus" value="'.$status.'">
		<input type="hidden" name="hidGroup" value="'.$group.'">
		
		<div class="control-group">
		<label for="inputEmail" class="control-label">'.Core_CLanguage::_('GROUP_NAME').' <i class="red_fnt">*</i></label>
		<div class="controls">
		<input type="text" name="txtGName" id="txtGName" value="'.$gName.'"><br><font color="#FF0000"><AJDF:output>'.$output['msg']['txtGName'].'</AJDF:output></font>
		</div>
		</div>
		<div class="control-group">
		<label for="inputPassword" class="control-label">'.Core_CLanguage::_('FIRST_NAME').' <i class="red_fnt">*</i></label>
		<div class="controls">
			<input name="txtFName" type="text"  id="txtFName" value="'.$fName.'"/><br><font color="#FF0000"><AJDF:output>'.$output['msg']['txtFName'].'</AJDF:output></font>
		</div>
		</div>
		<div class="control-group">
		<label for="inputPassword" class="control-label">'.Core_CLanguage::_('LAST_NAME').' <i class="red_fnt">*</i></label>
		<div class="controls">
		<input name="txtLName" type="text"  id="txtLName" value="'.$lName.'"/><br><font color="#FF0000"><AJDF:output>'.$output['msg']['txtLName'].'</AJDF:output></font>
		</div>
		</div>
		<div class="control-group">
		<label for="inputPassword" class="control-label">'.Core_CLanguage::_('COMPANY').' </label>
		<div class="controls">
		<input name="txtCompany" type="text"  id="txtCompany" value="'.$company.'"/><br><font color="#FF0000"><AJDF:output>'.$output['msg']['txtCompany'].'</AJDF:output></font>
		</div>
		</div>
		
		<div class="control-group">
		<label for="inputPassword" class="control-label">'.Core_CLanguage::_('EMAIL_ADDRESS').'</label>
		<div class="controls">
		<input name="txtEMail" type="text"  id="txtEMail" value="'.$eMail.'"/><br><font color="#FF0000"><AJDF:output>'.$output['msg']['txtEMail'].'</AJDF:output></font>
		</div>
		</div>
		<div class="control-group">
		<label for="inputPassword" class="control-label">'.Core_CLanguage::_('ADDRESS').' <i class="red_fnt">*</i></label>
		<div class="controls">
		<input name="txtAddress" type="text"  id="txtAddress" value="'.$address.'"/><br><font color="#FF0000"><AJDF:output>'.$output['msg']['txtAddress'].'</AJDF:output></font>
		</div>
		</div>
		<div class="control-group">
		<label for="inputPassword" class="control-label">'.Core_CLanguage::_('CITY').' <i class="red_fnt">*</i></label>
		<div class="controls">
			<input name="txtCity" type="text"  id="txtCity" value="'.$city.'"/><br><font color="#FF0000"><AJDF:output>'.$output['msg']['txtCity'].'</AJDF:output></font>
		</div>
		</div>

		<div class="control-group">
		<label for="inputPassword" class="control-label">'.Core_CLanguage::_('SUB_URB').' </label>
		<div class="controls">
		<input name="txtSuburb" type="text"  id="txtSuburb" value="'.$suburb.'"/>
		</div>
		</div>
		<div class="control-group">
		<label for="inputPassword" class="control-label">'.Core_CLanguage::_('STATEPROVINCE').' <i class="red_fnt">*</i></label>
		<div class="controls">
		<input name="txtState" type="text" " id="txtState" value="'.$state.'"/><br><font color="#FF0000"><AJDF:output>'.$output['msg']['txtState'].'</AJDF:output></font>
		</div>
		</div>
		<div class="control-group">
		<label for="inputPassword" class="control-label">'.Core_CLanguage::_('COUNTRY').' <i class="red_fnt">*</i></label>
		<div class="controls">
			<select name="selCountry" id="select3" >';
				 for($i=0;$i<count($arrCountry);$i++)
				 {
				 	 $sel='';
				 	 if($country==$arrCountry[$i]['cou_code'])
					 	$sel='selected';
						
					 $output1.='<option value="'.$arrCountry[$i]['cou_code'].'" '.$sel.'>'.$arrCountry[$i]['cou_name'].'</option>';
				 }
			 $output1.='</select>
		</div>
		</div>

		<div class="control-group">
		<label for="inputPassword" class="control-label">'.Core_CLanguage::_('ZIPPOSTAL_CODE').' <i class="red_fnt">*</i></label>
		<div class="controls">
		<input name="txtZip" type="text"  id="txtZip" value="'.$zip.'"/><br><font color="#FF0000"><AJDF:output>'.$output['msg']['txtZip'].'</AJDF:output></font>
		</div>
		</div>
		<div class="control-group">
		<label for="inputPassword" class="control-label">'.Core_CLanguage::_('TELEPHONE').'  </label>
		<div class="controls">
		<input name="txtPhone" type="text"  id="txtPhone" value="'.$telephone.'"/>
		</div>
		</div>
		<div class="control-group">
		<label for="inputPassword" class="control-label">'.Core_CLanguage::_('FAX').'  </label>
		<div class="controls">
		<input name="txtFax" type="text"  id="txtFax" value="'.$fax.'"/>
		</div>
		</div>
		
		<div class="control-group">
		<div class="controls">
		<button class="btn btn-danger" type="submit">'.Core_CLanguage::_('SUBMIT').'</button>&nbsp;<a  href="?do=addressbook"><button type="button" class="btn">'.Core_CLanguage::_('CANCEL').'</button></a>
		</div>
		</div>
		</form>
	        </div>';
	   return $output1;
	}
	/**
	* This function is used to Display the Add Address from check out
	* @param  array $arrCountry
	* @param  array $arrAdd
	* @return string
 	*/
	function showAddAddressFromCheckout($arrCountry,$arrAdd=array())
	{
	
		include("classes/Lib/HandleErrors.php");
		include_once('classes/Core/CUserAddressBook.php');
		Core_CUserAddressBook::Ulogin($Err);
		$output['val']=$Err->values;
		$output['msg']=$Err->messages;
		
		

		if(count($arrAdd)>0 && count($output['val'])==0)	
		{
			$gName=$arrAdd[0]['contact_name'];
			$fName=$arrAdd[0]['first_name'];
			$lName=$arrAdd[0]['last_name'];
			$company=$arrAdd[0]['company'];
			$eMail=$arrAdd[0]['email'];
			$address=$arrAdd[0]['address'];
			$city=$arrAdd[0]['city'];
			$suburb=$arrAdd[0]['suburb'];
			$state=$arrAdd[0]['state'];
			$country=$arrAdd[0]['country'];
			$zip=$arrAdd[0]['zip'];
			$telephone=$arrAdd[0]['phone_no'];
			$fax=$arrAdd[0]['fax'];
			$status=(isset($_GET['id'])?1:0);
			$group=$_GET['id'];
		}
		else
		{
			$gName=$output['val']['txtGName'];
			$fName=$output['val']['txtFName'];
			$lName=$output['val']['txtLName'];
			$company=$output['val']['txtCompany'];
			$eMail=$output['val']['txtEMail'];
			$address=$output['val']['txtAddress'];
			$city=$output['val']['txtCity'];
			$suburb=$output['val']['txtSuburb'];
			$state=$output['val']['txtState'];
			$country=$output['val']['selCountry'];
			$zip=$output['val']['txtZip'];
			$telephone=$output['val']['txtPhone'];
			$fax=$output['val']['txtFax'];
			$status=$output['val']['hidStatus'];		
			$group=$output['val']['hidGroup'];		
		}

		if($status==1)
		{
			$buttonCaption='Update';
			$action="edit";
			$readonly="readonly";
		}
		else
		{
			$buttonCaption='Create';			
			$action="add";	
			$readonly="";			
		}


	$output1.='
	    <form name="frmAddress" method="post" action="'.$_SESSION['base_url'].'/index.php?do=addaddress&action='.$action.'">
		<input type="hidden" name="hidStatus" value="'.$status.'">
		<input type="hidden" name="hidGroup" value="'.$group.'">
		<div align="center">
		 <table width="100%" border="0" cellspacing="0" cellpadding="0" class="checkout_rigistration" align="center">
		 	<tr>
			<td class="serachresult">Address Book</td>
			<td colspan=2></td>
			<td align="right" class="account_address" nowrap><!--<a href="?do=addressbook" class="categoryList">View Contacts</a>-->
			</td>
			</tr>
		   <tr>
			 <td width="26%"><b>Group Name</b> <span>*</span></td>
			 <td width="4%">:</td>
			 <td width="70%"><input name="txtGName" type="text" class="txtbox1 w4 TxtC1" id="textfield9" value="'.$gName.'" /><h1><AJDF:output>'.$output['msg']['txtGName'].'</AJDF:output></h1></td>
		   </tr>
		   <tr>
			 <td width="26%" align="top">First Name <span>*</span></td>
			 <td width="4%">:</td>
			 <td width="70%"><input name="txtFName" type="text" class="txtbox1 w4 TxtC1" id="textfield9" value="'.$fName.'" /><h1><AJDF:output>'.$output['msg']['txtFName'].'</AJDF:output></h1></td>
		   </tr>
		   <tr>
			 <td valign="top">Last Name <span>*</span></td>
			 <td valign=top>:</td>
			 <td><input name="txtLName" type="text" class="txtbox1 w4 TxtC1" id="textfield2" value="'.$lName.'"/><h1><AJDF:output>'.$output['msg']['txtLName'].'</AJDF:output></h1></td>
		   </tr>
		   <tr>
			 <td>Company</td>
			 <td>:</td>
			 <td><input name="txtCompany" type="text" class="txtbox1 w4 TxtC1" id="textfield3" value="'.$company.'"/></td>
		   </tr>
		   <tr>
			 <td>Email Address</td>
			 <td>:</td>
			 <td><input name="txtEMail" type="text" class="txtbox1 w4 TxtC1" id="textfield4" value="'.$eMail.'"/><h1><AJDF:output>'.$output['msg']['txtEMail'].'</AJDF:output></h1></td>
		   </tr>
		   <tr>
			 <td>Address <span>*</span></td>
			 <td>:</td>
			 <td><input name="txtAddress" type="text" class="txtbox1 w4 TxtC1" id="textfield7" value="'.$address.'"/><h1><AJDF:output>'.$output['msg']['txtAddress'].'</AJDF:output></h1></td>
		   </tr>
		   <tr>
			 <td>City <span>*</span></td>
			 <td>:</td>
			 <td><input name="txtCity" type="text" class="txtbox1 w4 TxtC1" id="textfield8" value="'.$city.'"/><h1><AJDF:output>'.$output['msg']['txtCity'].'</AJDF:output></h1></td>
		   </tr>
		   <tr>
			 <td>Sub Urb </td>
			 <td>:</td>
			 <td><input name="txtSuburb" type="text" class="txtbox1 w4 TxtC1" id="textfield8" value="'.$suburb.'"/></td>
		   </tr>
		   <tr>
			 <td>State/Province <span>*</span></td>
			 <td>:</td>
			 <td><input name="txtState" type="text" class="txtbox1 w4 TxtC1" id="textfield8" value="'.$state.'"/><br><h1><AJDF:output>'.$output['msg']['txtState'].'</AJDF:output></h1>
			 </td>
		   </tr>
		   <tr>
			 <td>Country <span>*</span></td>
			 <td>:</td>
			 <td><select name="selCountry" id="select3" class="listbox1 w4a TxtC1">';
				 for($i=0;$i<count($arrCountry);$i++)
				 {
				 	 $sel='';
				 	 if($country==$arrCountry[$i]['cou_code'])
					 	$sel='selected';
						
					 $output1.='<option value="'.$arrCountry[$i]['cou_code'].'" '.$sel.'>'.$arrCountry[$i]['cou_name'].'</option>';
				 }
			 $output1.='</select></td>
		   </tr>
		   <tr>
			 <td>Zip/Postal Code <span>*</span></td>
			 <td>:</td>
			 <td><input name="txtZip" type="text" class="txtbox1 w4 TxtC1" id="textfield82" value="'.$zip.'"/><h1><AJDF:output>'.$output['msg']['txtZip'].'</AJDF:output></h1></td>
		   </tr>
		   <tr>
			 <td>Telephone </td>
			 <td>:</td>
			 <td><input name="txtPhone" type="text" class="txtbox1 w4 TxtC1" id="textfield822" value="'.$telephone.'"/></td>
		   </tr>
		   <tr>
			 <td>Fax</td>
			 <td>:</td>
			 <td><input name="txtFax" type="text" class="txtbox1 w4 TxtC1" id="textfield823" value="'.$fax.'"/></td>
		   </tr>
		   <tr>
			 <td colspan=2></td><td style="padding-top:10px;" align="right"><table width="100%" border="0" cellspacing="0" cellpadding="0">
				 <tr>
				   <td valign="top"><div>
					   <table border="0" cellspacing="0" cellpadding="0">
						 <tr>
						   <td align="right" class="button_left"></td>
						   <td><input type="submit" name="Submit2" value="'.$buttonCaption.'" class="button" /></td>
						   <td class="button_right"></td>
						 </tr>
					   </table>
				   </div></td>
				 </tr>
			 </table></td>
		   </tr>
		 </table>
	   </div>
	   </form>';
	   return $output1;
	}
	/**
	 * This function is used to print the   order details 
	 *
	 * @param  array  $arr
	 * 
	 * @return string
	 */
	function printOrderDetail($arr)
	{


		$order_ship=$arr[0]['order_ship'];
		$shipping_method=trim($arr[0]['shipping_method']);	

		if($arr[0]['shipment_id_selected']!='1')
		{	
			$shipdurationrecords=array("0"=>"Select","1D"=>"Next Day Air Early AM","1DA"=>"Next Day Ai","1DP"=>"Next Day Air Saver","2DM"=>"2nd Day Air AM","2DA"=>"2nd Day Air","3DS"=>"3 Day Select","GND"=>"Ground","STD"=>"Canada Standar","XPR"=>"Worldwide Express","XDM"=>"Worldwide Express Plus","XPD"=>"Worldwide Expedited","WXS"=>"Worldwide Save");
			foreach($shipdurationrecords as $key=>$value)	
			{
				if($key==$shipping_method)
				{		
					$ship_duration=$value;
				}
			}
			$ups_ship_method='<tr>
			<td>'.Core_CLanguage::_(SHIP_DURATION).'</td>
			<th>'.$ship_duration.'</th>
			</tr>';
		}

		$output='<link href="'.$_SESSION['base_url'].'/assets/css/style.css" rel="stylesheet"> <link href="'.$_SESSION['base_url'].'/assets/css/table.css" rel="stylesheet" type="text/css" />';
		$output.=' <div class="title_fnt">
		<h1>'.Core_CLanguage::_(ORDER_DETAILS).'</h1>
		
		</div>
		
		<div id="myaccount_div">
		<div class="myacc_detail">
				<div class="clear"></div>
				<div class="row-fluid">
				<div class="span6"><h4>'.Core_CLanguage::_(ORDER_INFORMATION).'</h4>
			<table class="table table-striped table-bordered">
			<tr>
			<td>'.Core_CLanguage::_(ORDER_ID).'</td>
			<th>#'.$arr[0]['orders_id'].'</th>
			</tr>
			<tr>
			<td>'.Core_CLanguage::_(ORDER_STATUS).' </td>
			<th><span class="label label-success">'.$arr[0]['orders_status_name'].'</span></th>
			</tr>
			<tr>
			<td>'.Core_CLanguage::_(ORDER_TOTAL).'</td>
			<th>'.$arr[0]['currency_tocken'].''.$arr[0]['order_total'].'</th>
			</tr>
			<tr>
			<td>'.Core_CLanguage::_(ORDER_DATE).'</td>
			<th>'.$arr[0]['purDate'].'</th>
			</tr>
			<tr>
			<td>'.Core_CLanguage::_(CLOSE_DATE).'</td>
			<th>'.$arr[0]['closeDate'].'</th>
			</tr>
			</table>
				
			</div>

			<div class="span6">
			<table class="table table-striped table-bordered"><h4>Payment Details </h4>
			<tr>
			<td>'.Core_CLanguage::_(PAID_THROUGH).'</td>
			<th>'.$arr[0]['gateway_name'].'</th>
			</tr>
			
			</table>
			<table class="table table-striped table-bordered"><h4>Shipping Details </h4>
			<tr>
			<td>'.Core_CLanguage::_(SHIP_THROUGH).'</td>
			<th>'.$arr[0]['shipment_name'].'</th>
			</tr>
			'.$ups_ship_method.'
			<tr>
			<td>'.Core_CLanguage::_(SHIP_TRACK_ID).'</td>
			<th>'.$arr[0]['shipment_track_id'].'</th>
			</tr>
			</table>
			</div>
			</div>
           		<div class="row-fluid">
           		  <div class="span6"><h4>'.Core_CLanguage::_(BILLING_ADDRESS).'</h4><ul class="addresslist">
			<li><address>
			
			<p>'.$arr[0]['billing_name'].'</p>
			<p>'.$arr[0]['billing_company'].'</p>
			<p> '.$arr[0]['billing_street_address'].'</p>
			<p>'.$arr[0]['billing_city'].'</p>
			
			<p>'.$arr[0]['billing_postcode'].'</p>
			
			<p>'.$arr[0]['billing_state'].'</p>
			
			<p>'.$arr[0]['billcountry'].'</p>
			</address></li></ul>

                 	 </div>
                        <div class="span6"><h4>'.Core_CLanguage::_(SHIPPING_ADDRESS).'</h4>
				<ul class="addresslist">
			<li><address>
			<p>'.$arr[0]['shipping_name'].'</p>
			
			<p>'.$arr[0]['shipping_company'].'</p>
			
			<p> '.$arr[0]['shipping_street_address'].'</p>
			
			<p>'.$arr[0]['shipping_city'].'</p>
			
			<p>'.$arr[0]['shipping_postcode'].'</p>
		
			<p>'.$arr[0]['shipping_state'].'</p>
			
			<p>'.$arr[0]['shipcountry'].'</p>
			</address></li></ul>
				</div>
			</div>
				
		
			<h4>'.Core_CLanguage::_(ITEM_DETAILSITEM_DETAILS).'</h4>
			
			<div class="clear"></div>
			</div>
			<table class="rt cf" id="rt1">
			<thead class="cf">
			<tr>
				<th>'.Core_CLanguage::_(ITEM_DETAILS).'</th>
				<th>'.Core_CLanguage::_(PRICE).'</th>
				<th>'.Core_CLanguage::_(QUANTITY).'</th>
				<th>'.Core_CLanguage::_(TOTAL).'</th>
			</tr>
			</thead>
			<tbody>';
			$grand=0;
		
			for($i=0;$i<count($arr);$i++)
			{
				$total=$arr[$i]['product_unit_price']*$arr[$i]['product_qty'] ;
				$output.='<tr>
					<td>'.$arr[$i]['title'].'</td>
					<td><span class="label label-info">'.$arr[$i]['currency_tocken'].'&nbsp;'.number_format($arr[$i]['product_unit_price']).'</span></td>
					<td>'.$arr[$i]['product_qty'].'</td>
					
					<td><span class="label label-inverse">'.$arr[$i]['currency_tocken'].'&nbsp;'.number_format($total,2).'</span></td>
				</tr>';
				$grand+=$total;
				
			}
				$output.='<tr>
				<td colspan="2" rowspan="3">&nbsp;</td>
				<td>'.Core_CLanguage::_(SUB_TOTAL).'</td>
				<td><span class="label label-success">'.$arr[0]['currency_tocken'].'&nbsp;'.number_format($grand,2).'</span>	</td>
			</tr>
				<tr>
				<td>'.Core_CLanguage::_(SHIPPING_AMOUNT).'</td>
				<td><span class="label label-inverse">'.$arr[0]['currency_tocken'].'&nbsp;'.number_format($order_ship,2).'</span></td>
			</tr>
				<tr>
				<td>'.Core_CLanguage::_(GRAND_TOTAL).'</td>
				<td><span class="label label-important">'.$arr[0]['currency_tocken'].'&nbsp;'.number_format($arr[0]['order_total'],2).'</span></td>
			</tr>
			</tbody>
		</table>
		</div>';

		$output.='<p class="PageBreak">&nbsp;</p><script type="text/javascript">window.setTimeout("window.print();", 1000);</script></body></html>';

	
		echo  $output;	
		

	}
	/**
	* This function is used to calculate  the date difference
	* @param date $dformat
	* @param date $endDate
	* @param date $beginDate
	
	* @return string
 	*/
	function dateDiff($dformat, $endDate, $beginDate)
	{
		$date_parts1=explode($dformat, $beginDate);
		$date_parts2=explode($dformat, $endDate);
		$start_date=gregoriantojd($date_parts1[1], $date_parts1[0], $date_parts1[2]);
		$end_date=gregoriantojd($date_parts2[1], $date_parts2[0], $date_parts2[2]);
		return $end_date - $start_date;
	}
	/**
	* This function is used to Display the User Wishlist
	* @param mixed $arr
	* @param int $paging
	* @param int $prev
	* @param int $next	
	* @param int $val
	* @param mixed $result
	* @return string
 	*/
	function showDigitalProduct($arr,$paging,$prev,$next,$val,$result)
	{
		$output.=$result.'<div class="title_fnt">
		<h1>'.Core_CLanguage::_('MY_DOWNLOADS').'</h1>
		</div>
		<div id="myaccount_div">
		
		<table class="rt cf" id="rt1">
			<thead class="cf">
				<tr>
					
					<th>'.Core_CLanguage::_('ORDER').'</th>
					<th>'.Core_CLanguage::_('PRODUCT').' </th>
					<th>'.Core_CLanguage::_('ORDER_DATE').'</th>
					<th>'.Core_CLanguage::_('EXPIRE_DATE').'</th>
					<th>'.Core_CLanguage::_('DOWNLOAD').'</th>	
				</tr>
			</thead>
			<tbody>';
			if(count($arr)>0)
			{
				for($i=0;$i<count($arr);$i++)
				{
					if(file_exists($arr[$i]['image']))
						$img=$arr[$i]['image'];
					else
						$img="'".$_SESSION['base_url']."/index.phpimages/noimage.jpg";
	
					$output.='<tr>
					
					<td>#'.$arr[$i]['orders_id'].'</td><td><a href="?do=prodetail&action=showprod&prodid='.$arr[$i]['product_id'].'">'.$arr[$i]['title'].'</a></td>
					<td>'.$arr[$i]['pdate'].'</td>';
					if(Display_DUserAccount::dateDiff("/", date("j/n/Y"),$arr[$i]['expdate'])>0)
					{
					$output.='<td bgcolor="#FFFFFF" >Download Expired</td>';
					}
					else
					{
					$output.='<td bgcolor="#FFFFFF" >'.$arr[$i]['expdate'].'</td>';
					}
					$output.='<td><a class="btn btn-mini" href="?do=prodown&rid='.$arr[$i]['orders_id'].'&pid='.$arr[$i]['product_id'].'">Download</a></td></tr>';
				}
				
			}
			else
			{
				$output.='<tr><td colspan="6"><div class="alert alert-info">
				<button data-dismiss="alert" class="close" type="button">×</button>
				<strong>'.Core_CLanguage::_('NO_PRODUCT_FOUND').'</strong> 
				</div></td></tr>';

			}	
				
			$output.='</tbody>
					</table>
					</div>';	
				
		
		 	
		
		$_SESSION['wishList']=$output;			
		return $output;
	}	
}
?>
