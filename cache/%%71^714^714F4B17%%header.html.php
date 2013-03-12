<?php 
 ob_start(); ?><?php /* Smarty version 2.6.19, created on 2013-03-11 10:09:16
compiled from header.html */ ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>::  <?php echo $this->_tpl_vars['pagetitle']; ?>
::</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">
<!-- Le styles -->
<link href="assets/css/style.css" rel="stylesheet">
<link href="assets/css/responsive.css" rel="stylesheet">
<link href="assets/css/docs.css" rel="stylesheet">
<link href="assets/js/google-code-prettify/prettify.css" rel="stylesheet">
<link href="assets/css/menu.css" rel="stylesheet" type="text/css" />
<link href="assets/css/table.css" rel="stylesheet" type="text/css" />
<script src="assets/js/jquery.js"></script>
<!-- gallery-->
<link href="assets/css/listview.css" rel="stylesheet" type="text/css" >
<link href="assets/css/grid.css" rel="stylesheet" type="text/css" >
<script src="assets/js/mobilyselect.js" type="text/javascript"></script>
<script src="assets/js/init.js" type="text/javascript"></script>
<script type="text/javascript" src="assets/js/zoominfo.js"></script>
<script src="assets/js/jquery-tree.js" ></script>
<script src="assets/js/carousel-special.js"	></script>
<script src="assets/js/jquery.cycle.all.js"></script>
<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
<link rel="stylesheet" type="text/css" href="assets/css/tree.css" >
<script type="text/javascript">
$(document).ready(function() {
$("#tree").niceTree();
$("#tree2").niceTree({
color: 'blue'
});
$("#tree3").niceTree({
color: 'red'
});
$("#tree4").niceTree({
color: 'green'
});
$("#tree5").niceTree({
color: 'orange'
});
$("#tree6").niceTree({
color: 'gray'
});
$("#tree7").niceTree({
allowMultiple: true
});
$("#tree8").niceTree({
color: 'green',
animSpeed: 500
});
$("#tree9").niceTree({
color: 'red',
animSpeed: 0,
highlightNoMenu: false
});
$("#tree10").niceTree({
color: 'gray'
});
$("#tree11").niceTree({
color: 'orange',
ellipsis: false
});
$("#tree12").niceTree({
ajaxId: 'nicetree-content',
ajaxOptions: {
cache: false
}
});
$("#tree13").niceTree({
useCookies: true
});
$("#tree14").niceTree({
useCookies: true
});
$("#tree15").niceTree({
useCookies: true
});
$("#tree16").niceTree({
useCookies: true
});
$("#tree17").niceTree({
useCookies: true
});
$("#tree18").niceTree({
animation: 'slide'
});
$("#tree19").niceTree({
animation: 'drop',
color: 'red'
});
$("#tree20").niceTree({
animation: 'cliph',
color: 'green'
});
$("#tree21").niceTree({
animation: 'blind',
color: 'orange'
});
$("#tree22").niceTree({
animation: 'bounce',
color: 'gray'
});
});
</script>
<!--[if lt IE 9]>
<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<!--zoom effect-->
<?php if ($_GET['do'] == 'prodetail'): ?>
<script src="assets/js/jquery.jqzoom-core.js" type="text/javascript"></script>
<link rel="stylesheet" href="assets/css/jquery.jqzoom.css" type="text/css">
<script type="text/javascript">
$(document).ready(function() {
$('.jqzoom').jqzoom({
zoomType: 'innerzoom',
preloadImages: false,
alwaysOn:false
});
});
</script>
<?php endif; ?>
</head>
<body>
<header>
<div id="header">
<div id="top_menu">
<div class="container">
<div class="row-fluid">
<div class="span6">
<ul class="topmenu">
<li style="padding-left:0;"><a href="?do=dashboard">My Account</a></li>
<li><a href="?do=wishlist">My Wishlist</a></li>
<li><a href="?do=showcart">My Cart</a></li>
<li><a href="?do=showcart">Checkout</a></li>
<li><a href="#"><?php echo $this->_tpl_vars['loginStatus']['logout']; ?>
</a></li>
</ul>
</div>
<div class="span5">
<ul class="topmenu">
<li><a ><?php echo $this->_tpl_vars['currentDate']; ?>
</a></li>
<li><a ><?php echo $this->_tpl_vars['loginStatus']['username']; ?>
</a></li>
</ul>
</div>
<div class="span1"><?php echo $this->_tpl_vars['currencysettings']; ?>
</div>
</div>
</div>
</div>
<div class="container">
<!--logo-->
<div id="logo_div">
<div class="row-fluid">
<div class="span3"><a href="?do=index"><img src="<?php echo $this->_tpl_vars['sitelogo']; ?>
" alt="ZeusCart"></a></div>
<div class="span3">
<!--<div id="shopping_cnt">
<h3>8(802)234-5678</h3><span>Call us Monday - Saturday:8:30am- 6.00 pm</span>
</div>-->
</div>
<div class="span3"><form name="frmSearch" action="?do=search" method="post" onSubmit="document.frmSearch.action='?do=search&search='+document.frmSearch.searchtxt.value;"><div class="input-append">
<input class="span7" value="<?php echo $this->_tpl_vars['searchsession']; ?>
" name="search"  type="text" id="searchtxt">
<input type="submit" onclick="document.frmSearch.submit();" id="Image28" name="Image28" alt="find"  class="btn" value="Search" >
</div></form></div>
<div class="span3"><div id="shopping_cart"><i>Shopping Cart - $0.00</i></div>
</div>
</div>
</div>
<!--menu-->
<div class="row-fluid">
<span class="hidden-desktop">
<div class="navbar">
<div class="navbar-inner">
<div class="container">
<button data-target=".nav-collapse" data-toggle="collapse" class="btn btn-navbar" type="button">
<span class="icon-bar"></span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
</button>
<a href="./index.html" class="brand">MENUS</a>
<div class="nav-collapse collapse">
<ul class="nav">
<li class="">
<a href="./index.html">Home</a>
</li>
<li class="">
<a href="./getting-started.html">Women</a>
</li>
<li class="">
<a href="./scaffolding.html">Men</a>
</li>
<li class="">
<a href="./base-css.html">other</a>
</li>
<li class="active">
<a href="./components.html">Accessories</a>
</li>
<li class="">
<a href="./javascript.html">Sale</a>
</li>
<li class="">
<a href="./customize.html">Contact Us</a>
</li>
</ul>
</div>
</div>
</div>
</div>
</span>
<span class="visible-desktop">
<!-- Mega Menu / Start
================================================== -->
<div class="menu style-1">
<ul class="menu">
<li class="select"><a href="?do=index">Home</a></li>
<?php echo $this->_tpl_vars['headermenu']; ?>
</ul>
</div>
<!-- Mega Menu / End
================================================== -->
</span>
</div>
</div>
</div>
</div>
</header>
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