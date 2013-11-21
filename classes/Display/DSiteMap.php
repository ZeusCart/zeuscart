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
 * Site map related  class
 *
 * @package   		Display_DSiteMap
 * @category    	Display
 * @author    		AJ Square Inc Dev Team
 * @link   		http://www.zeuscart.com
  * @copyright 	        Copyright (c) 2008 - 2013, AJ Square, Inc.
 * @version   		Version 4.0
 */
class Display_DSiteMap
{
 	/**
	* This function is used to Display SiteMap
	* @param mixed $arr
	* @return string
 	*/
 	function showMap($arr)
	{
		$output.='<div class="row-fluid">
		<div class="title_fnt">
			<h1>'.Core_CLanguage::_('SITE_MAP').'</h1>
			</div>
		<div class="span12">
			<div class="container">
        	<div class="row-fluid">

		<div class="span3">
                	<h3>'.Core_CLanguage::_('CATEGORIES').'</h3>
                   <ul class="sitemap">';
                    	for($i=0;$i<count($arr);$i++)
				{
					$output.='<li><a href="'.$_SESSION['base_url'].'/index.php?do=featured&action=showmaincatlanding&maincatid='.$arr[$i]['category_id'].'">'.$arr[$i]['category_name'].'</a></li>';
				}
                   $output.=' </ul>
                </div>
		
		<div class="span3">
                	<h3>'.Core_CLanguage::_('SEARCH').'</h3>
                   <ul class="sitemap">
                    	<li><a href="'.$_SESSION['base_url'].'/index.php?do=search&search=">'.Core_CLanguage::_('LIST_ALL_PRODUCT').'</a></li>
			
                    </ul>
                </div>
            	<div class="span3">
                	<h3>'.Core_CLanguage::_('LIST_ALL_PRODUCT').'</h3>
                   <ul class="sitemap">
                    	<li><a href="'.$_SESSION['base_url'].'/index.php?do=login">'.Core_CLanguage::_('LOGIN').'</a></li>
			<li><a href="'.$_SESSION['base_url'].'/index.php?do=forgetpwd">'.Core_CLanguage::_('FORGOT_PASSWORD').'</a></li>								
			<li><a href="'.$_SESSION['base_url'].'/index.php?do=dashboard">'.Core_CLanguage::_('ACCOUNT_DASHBOARD').'</a></li>
			<li><a href="'.$_SESSION['base_url'].'/index.php?do=accountinfo">'.Core_CLanguage::_('ACCOUNT_INFORMATION').'</a></li>
			<li><a href="'.$_SESSION['base_url'].'/index.php?do=myorder">'.Core_CLanguage::_('MY_ORDERS').'</a></li>
			<li><a href="'.$_SESSION['base_url'].'/index.php?do=orders">'.Core_CLanguage::_('MY_PRODUCT_REVIEWS').'</a></li>
			<li><a href="'.$_SESSION['base_url'].'/index.php?do=newsletter">'.Core_CLanguage::_('NEWS_LETTER_SUBSCRIPTION').'</a></li>
			<li><a href="'.$_SESSION['base_url'].'/index.php?do=wishlist">'.Core_CLanguage::_('MY_WISHLIST').'</a></li>
                    </ul>
                </div>

		<div class="span3">
                	<h3>'.Core_CLanguage::_('REGISTRATION').'</h3>
                   <ul class="sitemap">
                    	<li><a href="'.$_SESSION['base_url'].'/index.php?do=userregistration">'.Core_CLanguage::_('USER_REGISTRATION').'</a></li>
	
                    </ul>
                </div>
	  
            </div>
		</div>
			<div class="row-fluid">

		<div class="span3">
                	<h3> '.Core_CLanguage::_('CONNECT').'</h3>
                   <ul class="sitemap">
			<li><a href="'.$_SESSION['base_url'].'/index.php?do=aboutus">'.Core_CLanguage::_('ABOUT_US').'</a></li>
				<li><a href="http://www.zeuscart.com">'.Core_CLanguage::_('ABOUT_ZEUSCART').'</a></li>		
                    </ul>
                </div>
			<div class="span3">
				<h3> '.Core_CLanguage::_('CUSTOMER_SERVICES').'</h3>
			<ul class="sitemap">
				<li><a href="'.$_SESSION['base_url'].'/index.php?do=contactus">'.Core_CLanguage::_('CONTACT_US').'</a></li>
					<li><a href="'.$_SESSION['base_url'].'/index.php?do=faq">'.Core_CLanguage::_('FREQUENTLY_ASKING_QUESTIONS').'</a></li>	
			</ul>
			</div>
		</div>
		</div>
        
                </div>';
		return $output;
		
	}
}
?>
