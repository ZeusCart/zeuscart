      <h1>Store Setting</h1>
<div class="body_cnt" id="container">
           		 <div class="scroll-pane">
  <h2>Language Settings</h2>
                      <dl class="setting">
                              <dt>Select Language</dt>
                                <dd><?php echo $selectlanguage; ?>
        <span style="color:#FF0000"> <?php echo $Err->messages['currname'] ?></span></dd>
 
                    <div class="clear"></div>
                  	<h2>Currency Settings</h2>
           		   			<dl class="setting">
                            	<dt>Currency Name</dt>
                                <dd><input name="currname" type="text" class="installtext" id="currname"  value="<?php echo $Err->values['currname']  ?>"/> 
				<span style="color:#FF0000"> <?php echo $Err->messages['currname'] ?></span></dd>

                            	<dt>Currency Token</dt>
                                <dd><input name="currtoken" type="text" class="installtext" id="currtoken" value="<?php echo $Err->values['currtoken']  ?>"/> 
				<span style="color:#FF0000"> <?php echo $Err->messages['currtoken'] ?></span></dd>

                            	<dt>Currency Code</dt>
                                <dd><?php echo $selcurrencycode; ?> <div class="clear"></div>
				<span style="color:#FF0000"> <?php echo $Err->messages['currcode'] ?></span> </dd>
				<div class="clear"></div>
                            	<!--<dt>Rate Against US Dollar</dt>-->
                              <!--  <dd><input name="currval" type="text" class="installtext"  id="currval" value="1"/> 
				<span style="color:#FF0000"> <?php echo $Err->messages['currval'] ?></span></dd>-->
				<div class="clear"></div>
			   <!--	<dt>Currency Country</dt>
                                <dd><?php echo $selcountrycode; ?> <div class="clear"></div></dd>
				<div class="clear"></div>
                            </dl>
                            <div class="clear"></div>  -->

                         
</div>
           		</div>