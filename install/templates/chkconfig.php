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
    <h1>Check for Prerequisite</h1>
<?php echo $_SESSION['error'] ?></span>
<div class="body_cnt" id="container">
           		  <div class="scroll-pane">
                  	<h2>PHP Settings</h2>

           		   			<dl class="setting">
                            	<dt>PHP Version 5.4.0 or later [required]</dt>
                                <dd><?php echo $this->config['php'] ?><span style="color:#FF0000"> <?php echo $Err->messages['phperr'] ?></span> </dd>
				
                            	<dt>register_globals [optional]</dt>
                                <dd><span><?php echo $this->config['regglobals'] ?></span></dd>
                            	<dt>GD Library Intallation [required]</dt>
                                <dd><?php echo $this->config['gd'] ?><span style="color:#FF0000"> <?php echo $Err->messages['gdlib'] ?></span> </dd>
				
                            	<dt>CURL [required]</dt>
                                <dd><?php echo $this->config['curl'] ?> 	<span style="color:#FF0000"> <?php echo $Err->messages['curl'] ?></span> </dd>

				<dt>Simple XML [required]</dt>
                                <dd><?php echo $this->config['sxml'] ?><span style="color:#FF0000"> <?php echo $Err->messages['sxml'] ?></span> </dd>
	
                            </dl>
                            <div class="clear"></div>
                            <h2>Data Base</h2>
           		   	<dl class="setting">
                            	<dt>MySQL [required]</dt>
                                <dd><?php echo $this->config['mysql'] ?></dd>
			<span style="color:#FF0000"> <?php echo $Err->messages['mysql'] ?></span> 
                                   </dl>
      			 <div class="clear"></div>
				<h2>Write Permission</h2>
					<dl class="setting">
                            	<dt>root\images [required]</dt>
                                <dd><?php echo $this->config['filepermit1'] ?><span style="color:#FF0000"> <?php echo $Err->messages['image'] ?></span> </dd>

				<dt>root\images\homepageads [required]</dt>
                                <dd><?php echo $this->config['filepermit1'] ?><span style="color:#FF0000"> <?php echo $Err->messages['homepageads'] ?></span> </dd>

				

				<dt>root\images\slidesupload [required]</dt>
                                <dd><?php echo $this->config['filepermit2'] ?><span style="color:#FF0000"> <?php echo $Err->messages['slide'] ?></span></dd>

					<dt>root\images\slidesupload\thumb [required]</dt>
                                <dd><?php echo $this->config['filepermit3'] ?><span style="color:#FF0000"> <?php echo $Err->messages['slidethumb'] ?></span></dd>	



			<dt>root\images\logo [required]</dt>
                                <dd><?php echo $this->config['filepermit4'] ?><span style="color:#FF0000"> <?php echo $Err->messages['logo'] ?></span></dd>
		
			<dt>root\images\products [required]</dt>
                                <dd><?php echo $this->config['filepermit5'] ?><span style="color:#FF0000"> <?php echo $Err->messages['products'] ?></span></dd>
			<dt>root\images\products\thumb [required]</dt>
                                <dd><?php echo $this->config['filepermit6'] ?><span style="color:#FF0000"> <?php echo $Err->messages['prothumb'] ?></span></dd>
			<dt>root\images\products\large_image [required]</dt>
                                <dd><?php echo $this->config['filepermit6'] ?><span style="color:#FF0000"> <?php echo $Err->messages['prolarge_image'] ?></span></dd>
			
			<dt>root\images\sociallink [required]</dt>
                                <dd><?php echo $this->config['filepermit6'] ?><span style="color:#FF0000"> <?php echo $Err->messages['sociallink'] ?></span></dd>

			<dt>root\Bin [required]</dt>
                                <dd><?php echo $this->config['filepermit7'] ?><span style="color:#FF0000"> <?php echo $Err->messages['bin'] ?></span></dd>

				<dt>root\Bin\Configuration.php [required]</dt>
                                <dd><?php echo $this->config['filepermit8'] ?><span style="color:#FF0000"> <?php echo $Err->messages['bincon'] ?></span></dd>

			<dt>root\Built [required]</dt>
                                <dd><?php echo $this->config['filepermit9'] ?><span style="color:#FF0000"> <?php echo $Err->messages['bulid'] ?></span></dd>
		
			<dt>root\cache [required]</dt>
                                <dd><?php echo $this->config['filepermit10'] ?><span style="color:#FF0000"> <?php echo $Err->messages['cache'] ?></span></dd>
			<dt>root\uploadedimages [required]</dt>
                                <dd><?php echo $this->config['filepermit11'] ?><span style="color:#FF0000"> <?php echo $Err->messages['uploadedimages'] ?></span></dd>

			<dt>root\uploadedimages\caticons [required]</dt>
                                <dd><?php echo $this->config['filepermit11'] ?><span style="color:#FF0000"> <?php echo $Err->messages['caticons'] ?></span></dd>

			<dt>root\upload_bulk_products [required]</dt>
                                <dd><?php echo $this->config['filepermit13'] ?><span style="color:#FF0000"> <?php echo $Err->messages['uploadprobulk'] ?></span></dd>
		
			<dt>root\admin\cache [required]</dt>
                                <dd><?php echo $this->config['filepermit14'] ?><span style="color:#FF0000"> <?php echo $Err->messages['admincache'] ?></span></dd>
			<dt>root\admin\uploadedtsvfile [required]</dt>
                                <dd><?php echo $this->config['filepermit15'] ?><span style="color:#FF0000"> <?php echo $Err->messages['uploadtsv'] ?></span></dd>

			<dt>root\admin\download [required]</dt>
                                <dd><?php echo $this->config['filepermit15'] ?><span style="color:#FF0000"> <?php echo $Err->messages['download'] ?></span></dd>


				<dt>root\admin\uploadedbulkimages [required]</dt>
                                <dd><?php echo $this->config['filepermit16'] ?><span style="color:#FF0000"> <?php echo $Err->messages['uploadbulkimage'] ?></span></dd>			
		
			<dt>root\includes [required]</dt>
                                <dd><?php echo $this->config['filepermit17'] ?><span style="color:#FF0000"> <?php echo $Err->messages['include'] ?></span></dd>

			<dt>root\includes\Charts [required]</dt>
                                <dd><?php echo $this->config['filepermit18'] ?><span style="color:#FF0000"> <?php echo $Err->messages['includecharts'] ?></span></dd>

		<dt>root\timthumb [required]</dt>
                                <dd><?php echo $this->config['filepermit19'] ?><span style="color:#FF0000"> <?php echo $Err->messages['timthumb'] ?></span></dd>

		<dt>root\timthumb\cache [required]</dt>
                                <dd><?php echo $this->config['filepermit19'] ?><span style="color:#FF0000"> <?php echo $Err->messages['timthumb'] ?></span></dd>
	
		 <div class="clear"></div>
       		      </div>
           		</div>