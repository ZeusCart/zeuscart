      <h1>Store Setting</h1>
<div class="body_cnt" id="container">
           		 <div class="scroll-pane">
                  	<h2>Currency Settings</h2>
           		   			<dl class="setting">
                            	<dt>Currency Name</dt>
                                <dd><input name="currname" type="text"  id="currname" value="<?php echo $Err->values['currname']  ?>"/> 
				<span style="color:#FF0000"> <?php echo $Err->messages['currname'] ?></span></dd>

                            	<dt>Currency Token</dt>
                                <dd><input name="currtoken" type="text"  id="currtoken" value="<?php echo $Err->values['currtoken']  ?>"/> 
				<span style="color:#FF0000"> <?php echo $Err->messages['currtoken'] ?></span></dd>

                            	<dt>Currency Code</dt>
                                <dd><?php echo $selcurrencycode; ?> <br/>
				<span style="color:#FF0000"> <?php echo $Err->messages['currcode'] ?></span> </dd>

                            	<dt>Rate Against US Dollar</dt>
                                <dd><input name="currval" type="text"  id="currval" value="1"/> 
				<span style="color:#FF0000"> <?php echo $Err->messages['currval'] ?></span></dd>

				<dt>Currency Country</dt>
                                <dd><?php echo $selcountrycode; ?> </dd>
	
                            </dl>
                            <div class="clear"></div>
</div>
           		</div>