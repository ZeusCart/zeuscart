<?php 
 ob_start(); ?><?php /* Smarty version 2.6.19, created on 2013-03-07 16:04:31
compiled from forgotpassword.html */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
?>
<!-- body start here-->
<div class="container">
<ul class="breadcrumb">
<li><a href="?do=index">Home</a> <span class="divider">/</span></li>
<li class="active"> Forgot Your Password</li>
</ul>
<div class="row-fluid">
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "right.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
?>
<div class="span9">
<div class="title_fnt">
<h1>Forgot Your Password </h1>
</div>
<?php echo $this->_tpl_vars['result']; ?>
<!--My Account-->
<div id="myaccount_div">
<form class="form-horizontal" action="?do=forgetpwd&action=retrivepwd" method="post">
<h3 class="accinfo_fnt"></h3>
<div class="control-group">
<label for="inputPassword" class="control-label">Email Address <i class="red_fnt">*</i></label>
<div class="controls">
<input type="text" name="email" id="email" value="<?php echo $this->_tpl_vars['val']['email']; ?>
"><br /><font color="#FF0000"><?php echo $this->_tpl_vars['msg']['email']; ?>
<?php echo $this->_tpl_vars['pwd']; ?>
</font>
</div>
</div>
<div class="control-group">
<div class="controls">
<button class="btn btn-danger" type="submit">Send My Password</button>
</div>
</div>
</form>           </div>
</div>
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