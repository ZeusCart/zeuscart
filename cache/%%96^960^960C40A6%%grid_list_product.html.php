<?php 
 ob_start(); ?><?php /* Smarty version 2.6.19, created on 2013-03-05 10:16:28
compiled from grid_list_product.html */ ?>
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
<li><a href="?do=viewproducts&action=grid&cat=<?php echo $_GET['cat']; ?>
"><?php echo $_GET['cat']; ?>
</a> <span class="divider">/</span></li>
<li > <?php echo $_GET['subcat']; ?>
</li><?php endif; ?>
<?php if ($_GET['cat'] != '' && $_GET['subcat'] != '' && $_GET['subundercat'] != ''): ?>
<li><a href="?do=viewproducts&action=grid&cat=<?php echo $_GET['cat']; ?>
"><?php echo $_GET['cat']; ?>
</a> <span class="divider">/</span></li>
<li > <a href="?do=viewproducts&action=grid&cat=<?php echo $_GET['cat']; ?>
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
<h1>Woman </h1><span class="pull-right"><a href="?do=viewproducts&action=grid&cat=<?php echo $_GET['cat']; ?>
&subcat=<?php echo $_GET['subcat']; ?>
&subundercat=<?php echo $_GET['subundercat']; ?>
" class="grid_icn"></a> <a href="?do=viewproducts&cat=<?php echo $_GET['cat']; ?>
&subcat=<?php echo $_GET['subcat']; ?>
&subundercat=<?php echo $_GET['subundercat']; ?>
" class="listview_icn"></a></span>
</div>
<!--gallery-->
<div class="selecter">
<!--<div class="selecterBtns">
<ul class="nolist">
<li><a href="#" rel="all" class="active">All</a></li>
<li><a href="#" rel="dresses">Dresses</a></li>
<li><a href="#" rel="bags"> Bags & Purses </a></li>
</ul>
</div>-->
<div class="selecterContent">
<!--<ul class="nolist">
<li class="bags">
<div class="galleryImage">
<div class="ribbion_div"><img src="assets/img/ribbion/new.png" alt="new"></div>
<img src="assets/img/products/012.jpg"></img>
<div class="info">
<h2>Taylor Swift</h2>
<p>
Taylor Alison Swift (born December 13, 1989) is an American country pop singer-songwriter and actress.
</p>
<h4>$160.00</h4>
<a href="#" class="add_btn"></a>
</div>
</div>
</li>
<li class="dresses"><div class="galleryImage">
<div class="ribbion_div"><img src="assets/img/ribbion/sale.png" alt="sale"></div>
<img src="assets/img/products/013.jpg"></img>
<div class="info">
<h2>Taylor Swift</h2>
<p>
Taylor Alison Swift (born December 13, 1989) is an American country pop singer-songwriter and actress.
</p>
<h4>$160.00</h4>
<a href="#" class="add_btn"></a>
</div>
</div></li>
<li class="bags"><div class="galleryImage">
<img src="assets/img/products/012.jpg"></img>
<div class="info">
<h2>Taylor Swift</h2>
<p>
Taylor Alison Swift (born December 13, 1989) is an American country pop singer-songwriter and actress.
</p>
<h4>$160.00</h4>
<a href="#" class="add_btn"></a>
</div>
</div></li>
<li class="dresses"><div class="galleryImage">
<img src="assets/img/products/013.jpg"></img>
<div class="info">
<h2>Taylor Swift</h2>
<p>
Taylor Alison Swift (born December 13, 1989) is an American country pop singer-songwriter and actress.
</p>
<h4>$160.00</h4>
<a href="#" class="add_btn"></a>
</div>
</div></li>
<li class="dresses"><div class="galleryImage">
<img src="assets/img/products/012.jpg"></img>
<div class="info">
<h2>Taylor Swift</h2>
<p>
Taylor Alison Swift (born December 13, 1989) is an American country pop singer-songwriter and actress.
</p>
<h4>$160.00</h4>
<a href="#" class="add_btn"></a>
</div>
</div></li>
<li class="dresses"><div class="galleryImage">
<img src="assets/img/products/013.jpg"></img>
<div class="info">
<h2>Taylor Swift</h2>
<p>
Taylor Alison Swift (born December 13, 1989) is an American country pop singer-songwriter and actress.
</p>
<h4>$160.00</h4>
<a href="#" class="add_btn"></a>
</div>
</div></li>
<li class="bags"><div class="galleryImage">
<img src="assets/img/products/012.jpg"></img>
<div class="info">
<h2>Taylor Swift</h2>
<p>
Taylor Alison Swift (born December 13, 1989) is an American country pop singer-songwriter and actress.
</p>
<h4>$160.00</h4>
<a href="#" class="add_btn"></a>
</div>
</div></li>
<li class="dresses"><div class="galleryImage">
<img src="assets/img/products/013.jpg"></img>
<div class="info">
<h2>Taylor Swift Taylor Swift Taylor Swift Taylor Swift Taylor Swift</h2>
<p>
Taylor Alison Swift (born December 13, 1989) is an American country pop singer-songwriter and actress.
</p>
<h4>$160.00</h4>
<a href="#" class="add_btn"></a>
</div>
</div></li>
<li class="bags"><div class="galleryImage">
<img src="assets/img/products/013.jpg"></img>
<div class="info">
<h2>Taylor Swift</h2>
<p>
Taylor Alison Swift (born December 13, 1989) is an American country pop singer-songwriter and actress.
</p>
<h4>$160.00</h4>
<a href="#" class="add_btn"></a>
</div>
</div></li>
</ul>-->
<?php echo $this->_tpl_vars['gridviewproducts']; ?>
<!--<div class="pagination">
<ul>
<li><a href="#">Prev</a></li>
<li><a href="#">1</a></li>
<li><a href="#">2</a></li>
<li><a href="#">3</a></li>
<li><a href="#">4</a></li>
<li><a href="#">5</a></li>
<li><a href="#">Next</a></li>
</ul>
</div>-->
</div>
<!--gallery end here-->
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