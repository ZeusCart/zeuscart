<?php 
 ob_start(); ?><?php /* Smarty version 2.6.19, created on 2013-03-06 16:45:25
compiled from addtocart.html */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
?>
<!-- body start here-->
<div class="container">
<ul class="breadcrumb">
<li><a href="?do=index">Home</a> <span class="divider">/</span></li>
<li class="active"> Show Cart </li>
</ul>
<?php echo $_SESSION['update_msg']; ?>
<div class="row-fluid">
<div class="span12">
<div class="title_fnt">
<?php if ($_GET['action'] == ''): ?>
<h1>Show Cart </h1>
<?php else: ?>
<h1>Check out</h1>
<?php endif; ?>
</div>
<?php echo $this->_tpl_vars['showcart']; ?>
</div></div>
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