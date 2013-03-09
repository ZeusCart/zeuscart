<?php 
 ob_start(); ?><?php /* Smarty version 2.6.19, created on 2013-03-05 16:50:29
compiled from searchpage.html */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
?>
<!-- body start here-->
<div class="container">
<ul class="breadcrumb">
<li><a href="?do=index">Home</a> <span class="divider">/</span></li>
<li class="active"> Search</li>
</ul>
<div class="row-fluid">
<div class="span9">
<div class="title_fnt">
<h1>Search Result : <?php echo $this->_tpl_vars['countrecords']; ?>
</h1><span class="pull-right"><a href="?do=search&action=grid&search=<?php echo $_GET['search']; ?>
" class="grid_icn"></a> <a href="?do=search&search=<?php echo $_GET['search']; ?>
" class="listview_icn"></a></span>
</div>
<!--list view-->
<!--<ul class="listviews">
<li>Sort By <select style="width:100px;"><option>Price</option><option>Name</option></select></li>
<li>Show <select style="width:50px;"><option>10</option></select></li>
<li></li>
</ul>-->
<div class="clear"></div>
<?php echo $this->_tpl_vars['keywordsearch']; ?>
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