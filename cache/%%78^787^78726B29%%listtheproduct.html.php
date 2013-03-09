<?php 
 ob_start(); ?><?php /* Smarty version 2.6.19, created on 2013-03-05 14:41:42
compiled from listtheproduct.html */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
?>
<!-- body start here-->
<div class="container">
<ul class="breadcrumb">
<li><a href="?do=index">Home</a> <span class="divider">/</span></li>
<?php if ($_GET['cat'] != '' && $_GET['subcat'] == '' && $_GET['subundercat'] == ''): ?>
<li><?php echo $_GET['cat']; ?>
<span class="divider">/</span></li>
<?php endif; ?>
<?php if ($_GET['cat'] != '' && $_GET['subcat'] != '' && $_GET['subundercat'] == ''): ?>
<li><a href="?do=viewproducts&cat=<?php echo $_GET['cat']; ?>
"><?php echo $_GET['cat']; ?>
</a> <span class="divider">/</span></li>
<li > <?php echo $_GET['subcat']; ?>
</li><?php endif; ?>
<?php if ($_GET['cat'] != '' && $_GET['subcat'] != '' && $_GET['subundercat'] != ''): ?>
<li><a href="?do=viewproducts&cat=<?php echo $_GET['cat']; ?>
"><?php echo $_GET['cat']; ?>
</a> <span class="divider">/</span></li>
<li > <a href="?do=viewproducts&cat=<?php echo $_GET['cat']; ?>
&subcat=<?php echo $_GET['subcat']; ?>
"><?php echo $_GET['subcat']; ?>
</a> <span class="divider">/</span></li>
<li><?php echo $_GET['subundercat']; ?>
</li>
<?php endif; ?>
</ul>
<div class="row-fluid">
<div class="span9">
<div class="title_fnt">
<h1><?php echo $_GET['cat']; ?>
</h1><span class="pull-right"><a href="?do=viewproducts&action=grid&cat=<?php echo $_GET['cat']; ?>
&subcat=<?php echo $_GET['subcat']; ?>
&subundercat=<?php echo $_GET['subundercat']; ?>
" class="grid_icn"></a> <a href="?do=viewproducts&cat=<?php echo $_GET['cat']; ?>
&subcat=<?php echo $_GET['subcat']; ?>
&subundercat=<?php echo $_GET['subundercat']; ?>
" class="listview_icn"></a></span>
</div>
<div class="clear"></div>
<?php echo $this->_tpl_vars['viewproducts']; ?>
</div>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "right.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
?>
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