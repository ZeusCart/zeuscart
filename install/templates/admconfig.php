
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
      <h1>Admin Configuration</h1>
<div class="body_cnt" id="container">
           		 <div class="scroll-pane">
                  	<h2>Admin Information</h2>
           		   			<dl class="setting">
                            	<dt>Domain Name</dt>
                                <dd><input name="domain" type="text" id="domain" class="installtext"  value="<?php echo $Err->values['domain']  ?>"/>
                 		<span style="color:#FF0000"> <?php echo $Err->messages['domain'] ?></span></dd>

                            	<dt>Admin E-mail</dt>
                                <dd><input name="email" type="text"  id="email" class="installtext" value="<?php echo $Err->values['email']  ?>"/>
             			 <span style="color:#FF0000"> <?php echo $Err->messages['email'] ?></span></dd>

                            	<dt>Admin User Name</dt>
                                <dd><input name="uname" type="text" class="installtext" id="uname" value="<?php echo $Err->values['uname']  ?>"/> 
				<span style="color:#FF0000"> <?php echo $Err->messages['uname'] ?></span> </dd>

                            	<dt>Admin Password</dt>
                                <dd><input name="pass" type="password" class="installtext" id="pass" value="<?php echo $Err->values['pass']  ?>"/>
                		 <span style="color:#FF0000"> <?php echo $Err->messages['pass'] ?></span> </dd>

				<dt>Confirm Admin Password</dt>
                                <dd><input name="cpass" type="password" class="installtext" id="cpass" value="<?php echo $Err->values['cpass']  ?>"/>
             			  <span style="color:#FF0000"> <?php echo $Err->messages['cpass'] ?></span>  </dd>
	
                            </dl>
                            <div class="clear"></div>
                           </div>
       		
           		</div>