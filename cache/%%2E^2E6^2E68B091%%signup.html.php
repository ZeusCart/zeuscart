<?php 
 ob_start(); ?><?php /* Smarty version 2.6.19, created on 2013-03-05 15:42:17
compiled from signup.html */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
?>
<!-- body start here-->
<div class="container">
<ul class="breadcrumb">
<li><a href="#">Home</a> <span class="divider">/</span></li>
<li class="active"> Register </li>
</ul>
<?php echo $this->_tpl_vars['account']; ?>
</TD>
<div class="row-fluid">
<div class="title_fnt">
<h1>Register</h1>
</div>
<form class="form-horizontal" name="register_form" action="?do=userregistration&action=addreg" method="POST">
<fieldset>
<div class="control-group">
<div class="controls">
<p class="info_fnt">
Fields marked with an <span class="red_fnt">*</span> are required
</p>
</div>
</div>
<div class="control-group">
<label for="input01" class="control-label">Display Name <span class="red_fnt">*</span></label>
<div class="controls">
<input type="text" id="txtdisname" name="txtdisname" class="input-xlarge" value="<?php echo $this->_tpl_vars['val']['txtdisname']; ?>
"><br /><font color="#FF0000">
<?php echo $this->_tpl_vars['msg']['txtdisname']; ?>
</font>
</div>
</div>
<div class="control-group">
<label for="input01" class="control-label">First Name <span class="red_fnt">*</span></label>
<div class="controls">
<input type="text" id="txtfname" name="txtfname" value="<?php echo $this->_tpl_vars['val']['txtfname']; ?>
" class="input-xlarge"><br /><font color="#FF0000">
<?php echo $this->_tpl_vars['msg']['txtfname']; ?>
</font>
</div>
</div>
<div class="control-group">
<label for="input01" class="control-label">Last Name <span class="red_fnt">*</span></label>
<div class="controls">
<input type="text" id="txtlname" name="txtlname" value="<?php echo $this->_tpl_vars['val']['txtlname']; ?>
" class="input-xlarge"><br /><font color="#FF0000">
<?php echo $this->_tpl_vars['msg']['txtlname']; ?>
</font>
</div>
</div>
<div class="control-group">
<label for="input01" class="control-label">Email Address <span class="red_fnt">*</span></label>
<div class="controls">
<input type="text" id="txtemail" name="txtemail" value="<?php echo $this->_tpl_vars['val']['txtemail']; ?>
" class="input-xlarge">
<br /><font color="#FF0000">
<?php echo $this->_tpl_vars['msg']['txtemail']; ?>
</font>
</div>
</div>
<div class="control-group">
<label for="input01" class="control-label">Password <span class="red_fnt">*</span></label>
<div class="controls">
<input type="password" id="txtpwd" name="txtpwd" value="<?php echo $this->_tpl_vars['val']['txtpwd']; ?>
" class="input-xlarge"> <br /><font color="#FF0000">
<?php echo $this->_tpl_vars['msg']['txtpwd']; ?>
</font>
</div>
</div>
<div class="control-group">
<label for="input01" class="control-label">Confirm Password <span class="red_fnt">*</span></label>
<div class="controls">
<input type="password" id="txtrepwd" name="txtrepwd" value="<?php echo $this->_tpl_vars['val']['txtrepwd']; ?>
" class="input-xlarge"><br /><font color="#FF0000">
<?php echo $this->_tpl_vars['msg']['txtrepwd']; ?>
</font>
</div>
</div>
<div class="control-group">
<label for="input01" class="control-label">Address <span class="red_fnt">*</span> </label>
<div class="controls">
<div id="txtHint"><input type="text" name="txtaddr" id="txtaddr" class="input-xlarge" value="<?php echo $this->_tpl_vars['val']['txtaddr']; ?>
"><br /><font color="#FF0000">
<?php echo $this->_tpl_vars['msg']['txtaddr']; ?>
</font></div>
</div>
</div>
<div class="control-group">
<label for="input01" class="control-label">City <span class="red_fnt">*</span> </label>
<div class="controls">
<input type="text" name="txtcity" id="txtcity" class="input-xlarge" value="<?php echo $this->_tpl_vars['val']['txtcity']; ?>
"><br /><font color="#FF0000">
<?php echo $this->_tpl_vars['msg']['txtcity']; ?>
</font>
</div>
</div>
<div class="control-group">
<label for="textarea" class="control-label">State / Province <span class="red_fnt">*</span></label>
<div class="controls">
<input type="text" name="txtState" id="txtState" value="<?php echo $this->_tpl_vars['val']['txtState']; ?>
" class="input-xlarge"><br><font color="#FF0000"><?php echo $this->_tpl_vars['msg']['txtState']; ?>
</font>
</div>
</div>
<div class="control-group">
<label for="textarea" class="control-label">Zip / Postal Code <span class="red_fnt">*</span> </label>
<div class="controls">
<input type="text" name="txtzipcode" id="txtzipcode" value="<?php echo $this->_tpl_vars['val']['txtzipcode']; ?>
" class="input-xlarge"><br><font color="#FF0000"><?php echo $this->_tpl_vars['msg']['txtzipcode']; ?>
</font>
</div>
</div>
<div class="control-group">
<label for="input01" class="control-label">Country  <span class="red_fnt">*</span></label>
<div class="controls">
<?php echo $this->_tpl_vars['val']['selCountry']; ?>
</div>
</div>
<div class="control-group">
<label for="input01" class="control-label"> </label>
<div class="controls">
<input type="checkbox" align="absmiddle" name="chkterms" id="checkbox" value="1">  I accept the <a href="?do=termsandcondition">User Agreement and </a><a href="?do=privacypolicy">Privacy Policy</a><font color="#FF0000">
<?php echo $this->_tpl_vars['msg']['chkterms']; ?>
</font>
</div>
</div>
<div class="form-actions">
<button class="btn btn-large btn-primary" type="submit">Submit</button>
</div>
</fieldset>
</form>
</div>
</div>
<!-- /container -->
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
?>
<?php 
   $op=explode("\n", ob_get_contents());
   ob_clean();
    foreach($op as $p)		
	{
		if(trim($p)!="")
			echo trim($p)."\n"; 
		ob_flush();
	}
?>