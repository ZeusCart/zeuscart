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

    <h1>Database Configuration</h1>
<div class="body_cnt" id="container">
           		 <div class="scroll-pane">
                  	<h2>Database Information</h2>
           		   			<dl class="setting">
                            	<dt>Database Server Name</dt>
                                <dd><input name="host" id="host" type="text"  class="installtext" value="<?php echo $Err->values['host'] ?>" />
               			 <span style="color:#FF0000"> <?php echo $Err->messages['host'] ?></span></dd>

                            	<dt>Database Name</dt>
                                <dd><input name="dbname" type="text"  class="installtext"  id="dbname" value="<?php echo $Err->values['dbname'] ?>"/>
                		 <span style="color:#FF0000"> <?php echo $Err->messages['dbname'] ?></span></dd>

                            	<dt>Database User Name</dt>
                                <dd><input name="uname" id="uname" class="installtext"  type="text"  value="<?php echo $Err->values['uname'] ?>"/>
               			 <span style="color:#FF0000"> <?php echo $Err->messages['uname'] ?></span> </dd>

                            	<dt>Database Password</dt>
                                <dd><input name="pass" type="password" class="installtext"   id="password" value="<?php echo $Err->values['pass'] ?>" />
               			 <span style="color:#FF0000"> <?php echo $Err->messages['pass'] ?></span>  </dd>

				<dt>Database With Sample Data</dt>
                                <dd><input name="sampledata" type="checkbox"   id="password" value="1" <?php 
				echo $checked; ?>   />
               			   </dd>
	
                            </dl>
                            <div class="clear"></div>
                           </div>
       		     
           		</div>