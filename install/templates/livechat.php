
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
?>
      <h1>Live Chat</h1>
<div class="body_cnt" id="container">
           		 <div class="scroll-pane">
                  	<div><img src="images/live_chat.jpg" style="width:100%"></div><div>&nbsp;</div>
           		   			<dl class="setting">
                            	<dt>Account Name</dt>
                                <dd><input name="account_name" type="text" id="account_name" class="installtext"  value="<?php echo $Err->values['account_name']  ?>"/>
                 		<span style="color:#FF0000"> <?php echo $Err->messages['account_name'] ?></span></dd>

                            	<dt>Password</dt>
                                <dd><input name="password" type="password"  id="password" class="installtext" value="<?php echo $Err->values['password']  ?>"/>
             			 <span style="color:#FF0000"> <?php echo $Err->messages['password'] ?></span></dd>

                            	<dt>Confirm Password</dt>
                                <dd><input name="con_password" type="password" class="installtext" id="con_password" value="<?php echo $Err->values['con_password']  ?>"/> 
				<span style="color:#FF0000"> <?php echo $Err->messages['con_password'] ?></span> </dd>

                            	<dt>Email</dt>
                                <dd><input name="email_id" type="text" class="installtext" id="email_id" value="<?php echo $Err->values['email_id']  ?>"/>
                		 <span style="color:#FF0000"> <?php echo $Err->messages['email_id'] ?></span> </dd>

				<dt>Turning Code</dt>
                                <dd> <input name="txtcaptcha" type="text" class="installtext" id="textfield83" value="" /><br><span style="color:#898686;
				font-size:12px;line-height:15px;font-weight:normal">Enter 5 characters displayed on the below image 
				(case insensitive)</span><br /><span color="#FF0000"></font></span> <span style="color:#FF0000"> <?php echo $Err->messages['txtcaptcha'] ?></span>  </dd>
	

				<dt>&nbsp;</dt>
                                <dd> <div class="log_grop_username" style="font-weight:normal"> 
			<img src="?do=captcha"  id="captcha" name="captcha" width="90" height="33"/> <a href="#reg" onclick="javascript:shuffle();" >
                 <img src="images/refresh.png" title="Change captcha"></a>
	               <span class="featureTXT" style="padding:0px;font-weight:normal">  </dd>
                            </dl>
                            <div class="clear"></div>
                           </div>
       		
           		</div>
<AJDF:output>include file="footer.html"</AJDF:output>

<script type="text/javascript" language="javascript">
var presh = -1
function shuffle()
{
	curr = Math.ceil(Math.random()*100);
	document.getElementById('captcha').src="?do=captcha&"+ (curr==presh ? Math.ceil(Math.random()*100) : curr);				
	presh = curr;

}
</script>