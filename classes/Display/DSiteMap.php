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
			<h1>Site Map</h1>
			</div>
		<div class="span12">
			<div class="container">
        	<div class="row-fluid">

		<div class="span3">
                	<h3>Categories</h3>
                   <ul class="sitemap">';
                    	for($i=0;$i<count($arr);$i++)
				{
					$output.='<li><a href="'.$_SESSION['base_url'].'/index.php?do=featured&action=showmaincatlanding&maincatid='.$arr[$i]['category_id'].'">'.$arr[$i]['category_name'].'</a></li>';
				}
                   $output.=' </ul>
                </div>
		
		<div class="span3">
                	<h3>Search</h3>
                   <ul class="sitemap">
                    	<li><a href="'.$_SESSION['base_url'].'/index.php?do=search&search=">List All Product </a></li>
			
                    </ul>
                </div>
            	<div class="span3">
                	<h3>My account</h3>
                   <ul class="sitemap">
                    	<li><a href="'.$_SESSION['base_url'].'/index.php?do=login">Login</a></li>
			<li><a href="'.$_SESSION['base_url'].'/index.php?do=forgetpwd">Forgot Password</a></li>								
			<li><a href="'.$_SESSION['base_url'].'/index.php?do=dashboard">Account Dashboard</a></li>
			<li><a href="'.$_SESSION['base_url'].'/index.php?do=accountinfo">Account Information</a></li>
			<li><a href="'.$_SESSION['base_url'].'/index.php?do=myorder">My Orders</a></li>
			<li><a href="'.$_SESSION['base_url'].'/index.php?do=orders">My Product Reviews</a></li>
			<li><a href="'.$_SESSION['base_url'].'/index.php?do=newsletter">News Letter Subscription</a></li>
			<li><a href="'.$_SESSION['base_url'].'/index.php?do=wishlist">My Wishlist</a></li>
                    </ul>
                </div>

		<div class="span3">
                	<h3>Registration</h3>
                   <ul class="sitemap">
                    	<li><a href="'.$_SESSION['base_url'].'/index.php?do=userregistration">User Registration</a></li>
	
                    </ul>
                </div>
	  
            </div>
		</div>
			<div class="row-fluid">

		<div class="span3">
                	<h3> Connect</h3>
                   <ul class="sitemap">
			<li><a href="'.$_SESSION['base_url'].'/index.php?do=aboutus">About Us</a></li>
				<li><a href="http://www.zeuscart.com">About Zeuscart</a></li>		
                    </ul>
                </div>
			<div class="span3">
				<h3>  Customer Services</h3>
			<ul class="sitemap">
				<li><a href="'.$_SESSION['base_url'].'/index.php?do=contactus">Contact us</a></li>
					<li><a href="'.$_SESSION['base_url'].'/index.php?do=faq">Fequently Asking Questions</a></li>	
			</ul>
			</div>
		</div>
		</div>
        
                </div>';
		return $output;
		
	}
}
?>
