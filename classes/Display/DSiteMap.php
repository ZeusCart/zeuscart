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
class Display_DSiteMap
{
 	/**
	* This function is used to Display SiteMap
	* @name showMap
	* @param mixed $arr
	* @return string
 	*/
 	function showMap($arr)
	{
		$output.='
		<div><div class="serachresult">SiteMap</div>
		
		<div style="float:left; padding:20px 10px 0 20px;">
			<div class="sitemap">
				<ul> Categories';
				for($i=0;$i<count($arr);$i++)
				{
					$output.='<li><a href="?do=featured&action=showmaincatlanding&maincatid='.$arr[$i]['category_id'].'">'.$arr[$i]['category_name'].'</a></li>';
				}
				$output.='</ul>
			</div>
			<div class="sitemap">
				<ul> Search<li><a href="?do=search&search=">List All Product</a></li></ul>
			</div>
			<div class="sitemap">
				<ul> My Account
				<li><a href="?do=login">Login</a></li>
				<li><a href="?do=forgetpwd">Forgot Password</a></li>								
				<li><a href="?do=dashboard">Account Dashboard</a></li>
				<li><a href="?do=accountinfo">Account Information</a></li>
				<li><a href="?do=myorder">My Orders</a></li>
				<li><a href="?do=orders">My Product Reviews</a></li>
				<li><a href="?do=newsletter">News Letter Subscription</a></li>
				<li><a href="?do=wishlist">My Wishlist</a></li>
				</ul>
			</div>
			<div class="sitemap">
				<ul> Registration
				<li><a href="?do=userregistration">User Registration</a></li>
				</ul>
			</div>
		</div>
		<div style="float:left; padding:20px 10px 0 20px;">
			<div class="sitemap">
				<ul> Connect
				<li><a href="?do=aboutus">About Us</a></li>
				<li><a href="http://www.zeuscart.com">About Zeuscart</a></li>				
				</ul>
			</div>
			<div class="sitemap">
				<ul> Customer Services
				<li><a href="?do=contactus">Contact us</a></li>
				<li><a href="?do=faq">Fequently Asking Questions</a></li>								
				</ul>
			</div>
			<div class="sitemap">
			</div>
			<div class="sitemap">
			</div>
		</div>
		<div style="height:30px; float:left; padding:0px 20px; color:#FFFFFF"></div>
	
		</div>';
		return $output;
		
	}
}
?>
