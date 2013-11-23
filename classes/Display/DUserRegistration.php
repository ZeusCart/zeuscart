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
 * User registration related  class
 *
 * @package   		Display_DUserRegistration
 * @category    	Display
 * @author    		AJ Square Inc Dev Team
 * @link   		http://www.zeuscart.com
  * @copyright 	        Copyright (c) 2008 - 2013, AJ Square, Inc.
 * @version   		Version 4.0
 */
class Display_DUserRegistration
{
	/**
	 * Stores the output records
	 *
	 * @var array 
	 */	
	var $arr = array();
	/**
	 * Stores the output records
	 *
	 * @var array 
	 */	
	var $arr1 = array();
		
 	/**
	* This function is used to Display the Header Menus
	* @param mixed $arr
	* @return string
 	*/
	function showHeaderMenu($arr)
	{

// 		$cnt= count($arr);
// 		if($cnt>0)
// 		{
// 			for($i=0;$i<$cnt;$i++)
// 			{
// 
// 
// 				$output.='<li><a href="'.$_SESSION['base_url'].'/'.urlencode($arr[$i]['category_name']).'.html" class="arrow">'.$arr[$i]['category_name'].'</a>
// 				<div class="mega-menu full-width">';
// 					$sqlsub="SELECT * FROM  category_table WHERE  category_parent_id='".$arr[$i]['category_id']."' AND sub_category_parent_id ='0'";
// 					$objsub=new Bin_Query();
// 					$objsub->executeQuery($sqlsub);
// 					$recordssub=$objsub->records;
// 					for($j=0;$j<count($recordssub);$j++)
// 					{
// 
// 
// 						$output.='<div class="col-1">
// 						<a href="'.$_SESSION['base_url'].'/'.urlencode($arr[$i]['category_name']).'/'.urlencode($recordssub[$i]['category_name']).'.html"><h4>'.$recordssub[$j]['category_name'].'</h4></a>
// 						<ol>';
// 							
// 							$query = new Bin_Query(); 
// 							$sql = "SELECT * FROM `category_table` WHERE sub_category_parent_id =".$recordssub[$j]['category_id']." AND category_status =1 order by category_name limit 16";
// 							$query->executeQuery($sql);
// 							$count=count($query->records);
// 							$records=$query->records;
// 							if($count>0)
// 							{
// 
// 
// 								for($k=0;$k<$count;$k++)
// 								{
// 									$output.='<li><a href="'.$_SESSION['base_url'].'/'.urlencode($arr[$i]['category_name']).'/'.urlencode($recordssub[$i]['category_name']).'/'.$records[$k]['category_name'].'.html">'.$records[$k]['category_name'].'</a></li>';
// 	
// 								}
// 							}
// 						$output.='</ol>
// 						</div>';
// 	
// 	
// 					}
// 	
// 					
// 					$output.='</div>
// 					</li>';
// 	
// 			}
// 	
// 		}
	

		$cnt= count($arr);
		if($cnt>0)
		{
			for($i=0;$i<$cnt;$i++)
			{
				

				$sluggable = $arr[$i]['category_alias'];

				$output.='<li><a href="'.$_SESSION['base_url'].'/'.$sluggable.'.html" class="arrow">'.$arr[$i]['category_name'].'</a>
				<div class="mega-menu full-width">';
				$output.=self::getSubFamilies(0,$arr[$i]['category_id'],0);
					
					$output.='</div>
					</li>';
	
			}
			
		}
		
		return $output;
	}
	/**
	 * Function generates an drop down list for the sub category  
	 * 
	 * 
	 * @return array
	 */		
	function getSubFamilies($level,$id,$k) {
	
		$level++;
		
		$sqlSubFamilies = "SELECT * from category_table WHERE  category_parent_id = ".$id.""; 
		$resultSubFamilies = mysql_query($sqlSubFamilies);
		if (mysql_num_rows($resultSubFamilies) > 0 ) {
			
			while($rowSubFamilies = mysql_fetch_assoc($resultSubFamilies )) {
				$k=$k+10;
				$categoryname=self::getSubFamiliesPath($rowSubFamilies['subcat_path']);
				if($rowSubFamilies['category_id'])
					
					if($level=='1')
					{

						$output.='<div class="col-1"><ol><a href="'.$_SESSION['base_url'].'/'.$categoryname.'.html"><h4>'.$rowSubFamilies['category_name'].'</h4></a>';	
						$output.=self::getSubFamilies($level, $rowSubFamilies['category_id'],$k);	
						$output.='</ol></div>';	
					}
					else
					{

						$output.='
						<li ><a href="'.$_SESSION['base_url'].'/'.$categoryname.'.html"> '.$rowSubFamilies['category_name'].'</a></li>';
						
						$output.=self::getSubFamilies($level, $rowSubFamilies['category_id'],$k);
		
						
					}

				}
				
				
		}
		
		return $output;
	} 
	/**
	 * Function gets the sub category name
	 * 
	 * 
	 * @return array
	 */
	function getSubFamiliesPath($cat)
	{
		 $cat=explode(',',$cat);

		for($m=0;$m<count($cat);$m++)
		{
			$sql = "SELECT * from category_table WHERE  category_id = ".$cat[$m].""; 
			$obj=new Bin_Query();
			$obj->executeQuery($sql);
			
			$sluggable = trim($obj->records[0]['category_alias']);
		
			if($m<(count($cat)-1))
			{
				$catname.=$sluggable. '/';
			}
			else
			{
				$catname.=$sluggable;
			}	
		}
		return $catname;
	}
	/**
	* This function is used to Display the Header Menu Hidden Desktop for mobile,,tablet
	* @param mixed $arr
	* @return string
 	*/
	function showHeaderMenuHidden($arr)
	{

		$cnt= count($arr);
		if($cnt>0)
		{
			for($i=0;$i<$cnt;$i++)
			{
				$output.='<li class="menuselect"><a href="'.$_SESSION['base_url'].'/index.php?do=viewproducts&cat='.$arr[$i]['category_name'].'" class="arrow">'.$arr[$i]['category_name'].'</a></li>';

					$sqlsub="SELECT * FROM  category_table WHERE  category_parent_id='".$arr[$i]['category_id']."' AND sub_category_parent_id ='0'";
					$objsub=new Bin_Query();
					$objsub->executeQuery($sqlsub);
					$recordssub=$objsub->records;
					for($j=0;$j<count($recordssub);$j++)
					{
						$output.='<li>
						<a href="'.$_SESSION['base_url'].'/index.php?do=viewproducts&cat='.$arr[$i]['category_name'].'&subcat='.$recordssub[$j]['category_name'].'"><h4><img src="'.$_SESSION['base_url'].'/assets/img/s-arrow.png">&nbsp;'.$recordssub[$j]['category_name'].'</h4></a>
						</li>';
							
							$query = new Bin_Query(); 
							$sql = "SELECT * FROM `category_table` WHERE sub_category_parent_id =".$recordssub[$j]['category_id']." AND category_status =1 order by category_name limit 16";
							$query->executeQuery($sql);
							$count=count($query->records);
							$records=$query->records;
							if($count>0)
							{
								for($k=0;$k<$count;$k++)
								{
									$output.='<li><a href="'.$_SESSION['base_url'].'/index.php?do=viewproducts&cat='.$arr[$i]['category_name'].'&subcat='.$recordssub[$j]['category_name'].'&subundercat='.$records[$k]['category_name'].'">-&nbsp;'.$records[$k]['category_name'].'</a></li>';
	
								}
							}
						
					}
	
					
			}
	
		}
		return $output;	
	}

 	/**
	* This function is used to Display the Sub Header menu
	* @param mixed $arr
	* @return string
 	*/
	function showSubHeaderMenu($arr)
	{
		
		$cnt= count($arr);
		$output='<ul class="categoriesList">';
		for($i=0;$i<$cnt;$i++)
		{
			$output.='<li><a href="'.$_SESSION['base_url'].'/index.php?do=featured&action=showfeaturedproduct&subcatid='.$arr[$i]['category_id'].'">'.$arr[$i]['category_name'].'</a></li>';
		}
		$output.='</ul>';
		return $output;
	}
	
 	/**
	* This function is used to Display the User Profile
	* @param mixed $arr
	* @return string
 	*/
	function showMyProfile($arr)
	{
		$pswd  = md5($arr[0]['user_pwd']);
		$out ='<form id="form1" name="form1" method="post" action="'.$_SESSION['base_url'].'/index.php?do=myprofile&action=updateMyProfile">
          <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="table">
            <tr>
              <td class="product_header" >My Profile</td>
            </tr>
            <tr>
              <td><input type="hidden" name="newslettersubid" value="'.$arr[0]['subsciption_id'].'" /></td>
            </tr>
            <tr>
              <td ><table width="87%" border="0" align="center" cellpadding="2" cellspacing="2" class="cart_info">
                  <tr>
                    <td>Display Name </td>
                    <td>'.$arr[0]['user_display_name'].'</td>
                  </tr>
                  <tr>
                    <td width="39%">First Name </td>
                    <td width="40%">
                        <input type="text" name="txtfname" value="'.$arr[0]['user_fname'].'" />
						<font color="red">'.$output['msg']['txtemail'].'</font></td>
						
                  </tr>
                  <tr>
                    <td>Last Name </td>
                    <td><input type="text" name="txtlname" value="'.$arr[0]['user_lname']
					.'" /><font color="red">'.$output['msg']['txtlname'].'</font></td>
					
                  </tr>
                  <tr>
                    <td>Email</td>
                    <td><input type="text" name="txtemail" value="'.$arr[0]['user_email']
					.'"  /><font color="red">'.$output['msg']['txtemail'].'</font></td>
					
                  </tr>
                  <tr>
                    <td>Password</td>
                    <td><input type="password" name="txtpwd" value="'.$pswd.'"/><font color="red">'.$output['msg']['txtpwd'].'</font></td>
					
                  </tr>
                  <tr>
                    <td>Confirm Password </td>
                    <td><input type="password" name="txtconfirmpwd" value="'.$pswd.'"/><font color="red">'.$output['msg']['txtconfirmpwd'].'</font></td>
					
                  </tr>
                </table></td>
            </tr>
            <tr>
              <td >&nbsp;</td>
            </tr>
            <tr>
              <td class="product_header" >Newsletter Subscription <a href="#" class="btm_text_links" ></a></td>
            </tr>
            <tr>
              <td >&nbsp;</td>
            </tr>
            <tr>
              <td ><table width="87%" border="0" align="center" cellpadding="2" cellspacing="2" class="cart_info">
                  <tr>
                    <td colspan="2">Would you like to Subscribe to site newsletters ? </td>
                  </tr>
                  <tr>
                    <td align="right"><input name="newsletterSubscribeY" id="newsletterSubscribeY" type="radio" value="1" checked />
                      <label for="newsletterSubscribeY"> Yes</label>
                      <input name="newsletterSubscribeY" type="radio" value="0" id="newsletterSubscribeY" />
                      <label for="newsletterSubscribeY">No Thanks </label></td>
                    <td width="25%">&nbsp;</td>
                  </tr>
				  <tr><td colspan="2" align="right"><input name="btnSave" type="submit" class="form-button" value="Save" /></td>
				  </tr>
                </table></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
            </tr>
          </table></form>';
		  
		  return $out;
	}
	
 	/**
	* This function is used to Display the Header Text
	* @param mixed $arr
	* @return string
 	*/
	function showHeaderText($arr)
	{
		$output='';
		if(trim($arr[0]['set_value'])!='')
		
			$output='<div id="your_text">'.$arr[0]['set_value'].'</div>';
		return $output;
	}
	
 	/**
	* This function is used to Display the Signup Info
	* @return string
 	*/
	function signUp()
	{
		if($_SESSION['user_id']=='')
				$output='<td align="left"><img src="'.$_SESSION['base_url'].'/images/ico_register.png" alt="" width="25" height="25" /></td>
            <td align="left"><a href="'.$_SESSION['base_url'].'/index.php?do=userregistration">Sign Up</a></td>
            <td width="4%" align="left" class="separator">&nbsp;</td>';
		else
			$output='';
		return $output;
		
	}
 	/**
	* This function is used to Display the Sub Category Heading
	* @return string
 	*/
	function showSubCat()
	{
		return '<div class="heading"><span class="headingTXT">Sub Categories</span></div>';
	}

 	/**
	* This function is used to Display the Main category Heading
	* @return string
 	*/
	function showMainCat()
	{
		return 	'<div class="heading"><span class="headingTXT">Categories</span></div>';
	}

 	/**
	* This function is used to Display the User's left Menu
	* @return string
 	*/
	function showUserLeftMenu()
	{

		$output='<div class="span3">
        	<div id="block_div">
            		<h2>'.Core_CLanguage::_('MY_ACCOUNT').'</h2>
                   	 <ul class="accountlists">';
			if($_GET['do']=='dashboard')
			{
				$output.='<li><a href="'.$_SESSION['base_url'].'/index.php?do=dashboard" class="select"><i class="icon-chevron-right"></i> '.Core_CLanguage::_('MY_ACCOUNT').'</a></li>';

			}	
			else
			{
				$output.='<li><a href="'.$_SESSION['base_url'].'/index.php?do=dashboard" class="unselect"><i class="icon-chevron-right"></i> '.Core_CLanguage::_('MY_ACCOUNT').'</a></li>';
			}	
				
			if($_GET['do']=='accountinfo')
			{
				$output.='<li><a href="'.$_SESSION['base_url'].'/index.php?do=accountinfo" class="select"><i class="icon-chevron-right"></i> '.Core_CLanguage::_('ACCOUNT_INFORMATION').'</a></li>';

			}	
			else
			{
				$output.='<li><a href="'.$_SESSION['base_url'].'/index.php?do=accountinfo" class="unselect"><i class="icon-chevron-right"></i> '.Core_CLanguage::_('ACCOUNT_INFORMATION').'</a></li>';
			}
			if($_GET['do']=='changepassword')
			{
				$output.='<li><a href="'.$_SESSION['base_url'].'/index.php?do=changepassword" class="select"><i class="icon-chevron-right"></i> '.Core_CLanguage::_('CHANGE_PASSWORD').'</a></li>';

			}	
			else
			{
				$output.='<li><a href="'.$_SESSION['base_url'].'/index.php?do=changepassword" class="unselect"><i class="icon-chevron-right"></i> '.Core_CLanguage::_('CHANGE_PASSWORD').'</a></li>';
			}
			
                    	if($_GET['do']=='addressbook' || $_GET['do']=='addaddress')
			{
				$output.='<li><a href="'.$_SESSION['base_url'].'/index.php?do=addressbook" class="select"><i class="icon-chevron-right"></i> '.Core_CLanguage::_('ADDRESS_BOOK').'</a></li>';

			}	
			else
			{
				$output.='<li><a href="'.$_SESSION['base_url'].'/index.php?do=addressbook" class="unselect"><i class="icon-chevron-right"></i> '.Core_CLanguage::_('ADDRESS_BOOK').'</a></li>';
			}
                    	if($_GET['do']=='myorder' || $_GET['do']=='orderdetail')
			{
				$output.='<li><a href="'.$_SESSION['base_url'].'/index.php?do=myorder" class="select"><i class="icon-chevron-right"></i> '.Core_CLanguage::_('MY_ORDER').'</a></li>';

			}	
			else
			{
				$output.='<li><a href="'.$_SESSION['base_url'].'/index.php?do=myorder" class="unselect"><i class="icon-chevron-right"></i> '.Core_CLanguage::_('MY_ORDER').'</a></li>';
			}
                    	if($_GET['do']=='orders')
			{
				$output.='<li><a href="'.$_SESSION['base_url'].'/index.php?do=orders" class="select"><i class="icon-chevron-right"></i> '.Core_CLanguage::_('MY_PRODUCT_REVIEWS').'</a></li>';

			}	
			else
			{
				$output.='<li><a href="'.$_SESSION['base_url'].'/index.php?do=orders" class="unselect"><i class="icon-chevron-right"></i> '.Core_CLanguage::_('MY_PRODUCT_REVIEWS').'</a></li>';
			}
 
			if($_GET['do']=='newsletter')
			{
			$output.='<li><a href="'.$_SESSION['base_url'].'/index.php?do=newsletter" class="select"><i class="icon-circle-arrow-right"></i> '.Core_CLanguage::_('NEWS_SUBCRIPTIONS').'</a></li>';
			}
			else
			{	
			$output.='<li><a href="'.$_SESSION['base_url'].'/index.php?do=newsletter" class="unselect"><i class="icon-circle-arrow-right"></i> '.Core_CLanguage::_('NEWS_SUBCRIPTIONS').'</a></li>';
			}
			if($_GET['do']=='wishlist')
			{
			$output.='<li><a href="'.$_SESSION['base_url'].'/index.php?do=wishlist" class="select"><i class="icon-circle-arrow-right"></i> '.Core_CLanguage::_('MY_WISHLIST').'</a></li>';
			}
			else
			{
			$output.='<li><a href="'.$_SESSION['base_url'].'/index.php?do=wishlist" class="unselect"><i class="icon-circle-arrow-right"></i> '.Core_CLanguage::_('MY_WISHLIST').'</a></li>';
			}
			if($_GET['do']=='digitdown')
			{
			$output.='<li><a href="'.$_SESSION['base_url'].'/index.php?do=digitdown" class="select"><i class="icon-circle-arrow-right"></i> '.Core_CLanguage::_('MY_DOWNLOADS').'</a></li>';
			}
			else
			{
			$output.='<li><a href="'.$_SESSION['base_url'].'/index.php?do=digitdown" class="unselect"><i class="icon-circle-arrow-right"></i> '.Core_CLanguage::_('MY_DOWNLOADS').'</a></li>';
			}
                   $output.=' </ul>
            </div>
              </div>';
		return $output;
	}

 	/**
	* This function is used to Display the Dynamic cms
	* @param mixed $arr
	* @return string
 	*/
	function showDynamicCms($arr)
	{
		$output='<a href="'.$_SESSION['base_url'].'/index.php?do=indexpage">Home</a>&nbsp;';
		for($i=0;$i<count($arr);$i++)
		{	
		
			$output.='<a href="'.$_SESSION['base_url'].'/index.php?do=dynamiccms&id='.
			$arr[$i]['cms_id'].'">'.$arr[$i]['cms_page_title'].'</a>&nbsp;';
				
				
		}
		
	   return $output;
	}
	/**
	* This function is used to Display the Main Menu in Header
	* @param mixed $arr
	* @return string
 	*/
	function showHeaderMainMenu($arr)
	{
		$output='<a href="'.$_SESSION['base_url'].'/index.php?do=indexpage">Home</a>&nbsp;';
		for($i=0,$j=0;$i<count($arr);$i++)
		{	
			if(file_exists($arr[$i]['page_url']))
			{
				if($j<5)
					$output.='<a href="'.$_SESSION['base_url'].'/index.php'.$arr[$i]['page_url'].'">'.$arr[$i]['page_name'].'</a>&nbsp;';
				else if($j==5)
					$output.='<a href="#" rel="dropmenu7">&nbsp;More</a>
							  <div id="dropmenu7" class="dropmenudiv">
							  <a href="'.$arr[$i]['page_url'].'">'.$arr[$i]['page_name'].'</a>&nbsp;';
				else	
					$output.='<a href="'.$arr[$i]['page_url'].'">'.$arr[$i]['page_name'].'</a>';
				$j++;	
			}		
		}
		
	   return $output;
	}
	/**
	* This function is used to Display the country
	* @param mixed $arrCountry
	* @return string
 	*/
	function dispCountry($arrCountry)
	{
		$output1='<select name="selCountry" id="select3" class="listbox1 w4a TxtC1" style="width:280px;">';
		if(count($arrCountry)>0)
		{		
		 for($i=0;$i<count($arrCountry);$i++)
				 {
				 	 $sel='';
				 	 if($country==$arrCountry[$i]['cou_code'])
					 	$sel='selected';
						
					 $output1.='<option value="'.$arrCountry[$i]['cou_code'].'" '.$sel.'>'.$arrCountry[$i]['cou_name'].'</option>';
				 }
		}
			 $output1.='</select>';
		return $output1;
	}

	
	/**
	 * This function is used to display the  home page slide show
	 *
	 * @param   array  	recordSet   array of slide show image with title and caption
	 *
	 * @return  array  out
	 */
	function viewSlideShow($recordSet)
	{


		if(count($recordSet)>0)
		{
			for($i=0;$i<count($recordSet);$i++)
			{

			$output.='<div data-thumb="'.$recordSet[$i]['slide_content_thumb'].'" data-src="'.$recordSet[$i]['slide_content'].'" 
			data-link="'.$recordSet[$i]['slide_url'].'" data-target="_self">
				<div class="camera_caption fadeFromBottom">
				<em>'.$recordSet[$i]['slide_caption'].'</em>
				</div></div>';

			}

		}
		return $output;

	}
	/**
	 * This function is used to display the currency settings
	 *
	 * @param   array  	recordSet   array of slide show image with title and caption
	 *
	 * @return  array  out
	 */

	function showCurrencySettings($recordSet)
	{

		if(count($recordSet)>0)
		{
			$output='<select class="select_dollar" onChange="selectCurrency(this.value);">';
			for($i=0;$i<count($recordSet);$i++)
			{	
				if($_SESSION['currencysetting']['selected_currency_id']==$recordSet[$i]['id'])
				{
					$selected='selected=selected';
				}
				else
				{
				$selected='';
				}
				$output.='<option value='.$recordSet[$i]['id'].' '.$selected.'>'.$recordSet[$i]['currency_name'].'</option>';
	
			}
			$output.='</select>';
		}
		return $output;
	}
}
?>
