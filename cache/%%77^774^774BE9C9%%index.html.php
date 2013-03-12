<?php 
 ob_start(); ?><?php /* Smarty version 2.6.19, created on 2013-03-11 10:20:46
compiled from index.html */ ?>
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
<script src="assets/js/jquery.js"></script>
<script src="assets/js/jquery.cycle.all.js"></script>
<!--gallery-->
<link rel="stylesheet" type="text/css" href="assets/css/gallery.css">
<script type="text/javascript" src="assets/js/jquery-v1.7.1.js"></script>
<script type="text/javascript" src="assets/js/jquery-hover-effect.js"></script>
<script type="text/javascript">
//Image Hover
jQuery(document).ready(function(){
jQuery(function() {
jQuery('ul.da-thumbs > li').hoverdir();
});
});
</script>
<!--banner-->
<link rel='stylesheet' id='camera-css'  href='assets/css/slider.css' type='text/css' media='all'>
<script type='text/javascript' src='assets/js/jquery.mobile.customized.min.js'></script>
<script type='text/javascript' src='assets/js/jquery.easing.1.3.js'></script>
<script type='text/javascript' src='assets/js/camera.min.js'></script>
<script>
jQuery(function(){
jQuery('#camera_wrap_1').camera({
height:  ' <?php echo $this->_tpl_vars['slideshowparameter']->slideshowheight; ?>
',
alignment: '<?php echo $this->_tpl_vars['slideshowparameter']->imagealignment; ?>
',
pagination: <?php echo $this->_tpl_vars['slideshowparameter']->pagination; ?>
,
easing: '<?php echo $this->_tpl_vars['slideshowparameter']->easingeffect; ?>
',
autoPlay: '<?php echo $this->_tpl_vars['slideshowparameter']->autoplay; ?>
',
transition: 'loop',
navigation:<?php echo $this->_tpl_vars['slideshowparameter']->navigationbuttons; ?>
,
navigationHover:<?php echo $this->_tpl_vars['slideshowparameter']->shownavigation; ?>
,
slicedCols:<?php echo $this->_tpl_vars['slideshowparameter']->slicedcolumns; ?>
,
slicedRows:<?php echo $this->_tpl_vars['slideshowparameter']->slicedrows; ?>
,
slidingtime:<?php echo $this->_tpl_vars['slideshowparameter']->slidingtime; ?>
,
transPeriod:<?php echo $this->_tpl_vars['slideshowparameter']->slidingeffecttime; ?>
,
playPause:<?php echo $this->_tpl_vars['slideshowparameter']->pausebutton; ?>
,
pauseOnClick:<?php echo $this->_tpl_vars['slideshowparameter']->pauseonclick; ?>
,
loader:'<?php echo $this->_tpl_vars['slideshowparameter']->timertype; ?>
',
loaderColor: '<?php echo $this->_tpl_vars['slideshowparameter']->timercolor; ?>
',
loaderBgColor: '<?php echo $this->_tpl_vars['slideshowparameter']->timerbgcolor; ?>
',
pieDiameter:<?php echo $this->_tpl_vars['slideshowparameter']->piediameter; ?>
,
piePosition:'<?php echo $this->_tpl_vars['slideshowparameter']->pieposition; ?>
',
barDirection:'<?php echo $this->_tpl_vars['slideshowparameter']->timerbardirections; ?>
',
barPosition:'<?php echo $this->_tpl_vars['slideshowparameter']->timerbarposition; ?>
',
thumbnails: <?php echo $this->_tpl_vars['slideshowparameter']->thumbnails; ?>
});
});
</script>
<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
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
" alt="logo"></a></div>
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
<select id="selectnav1" class="selectnav"><option value="">- Navigation -</option><option value="javascript:void(0)">Forms</option><option value="file:///D:/classified-2013/admin/form_elements.html">- Form elements</option><option value="file:///D:/classified-2013/admin/form_validation.html">- Form validation</option><option value="javascript:void(0)">Components</option><option value="file:///D:/classified-2013/admin/calendar.html">- Calendar</option><option value="file:///D:/classified-2013/admin/charts.html">- Charts</option><option value="file:///D:/classified-2013/admin/contact_list.html">- Contact List</option><option value="file:///D:/classified-2013/admin/datatables.html">- Datatables</option><option value="file:///D:/classified-2013/admin/editable_elements.html">- Editable Elements</option><option value="file:///D:/classified-2013/admin/file_manager.html">- File manager</option><option value="file:///D:/classified-2013/admin/gallery.html">- Gallery</option><option value="file:///D:/classified-2013/admin/gmaps.html">- Google Maps</option><option value="file:///D:/classified-2013/admin/user-management.html#">- Tables</option><option value="file:///D:/classified-2013/admin/tables_regular.html">-- Regular Tables</option><option value="file:///D:/classified-2013/admin/table_stacking.html">-- Stacking Table</option><option value="file:///D:/classified-2013/admin/table_examples.html">-- Table examples</option><option value="file:///D:/classified-2013/admin/wizard.html">- Wizard</option><option value="javascript:void(0)">UI Elements</option><option value="file:///D:/classified-2013/admin/alerts_buttons.html">- Alerts, Buttons</option><option value="file:///D:/classified-2013/admin/grid.html">- Grid</option><option value="file:///D:/classified-2013/admin/icons.html">- Icons</option><option value="file:///D:/classified-2013/admin/notifications.html">- Notifications</option><option value="file:///D:/classified-2013/admin/tabs_accordions.html">- Tabs, Accordions</option><option value="file:///D:/classified-2013/admin/tooltips_popovers.html">- Tooltips, Popovers</option><option value="file:///D:/classified-2013/admin/typography.html">- Typography</option><option value="file:///D:/classified-2013/admin/widgets.html">- Widgets</option><option value="javascript:void(0)">Other pages</option><option value="file:///D:/classified-2013/admin/ajax_content.html">- Ajax content</option><option value="file:///D:/classified-2013/admin/blank.html">- Blank page</option><option value="file:///D:/classified-2013/admin/blog_page.html">- Blog page</option><option value="file:///D:/classified-2013/admin/blog_page_single.html">- Blog page (single)</option><option value="file:///D:/classified-2013/admin/error_404.html">- Error 404</option><option value="file:///D:/classified-2013/admin/help_faq.html">- Help/Faq</option><option value="file:///D:/classified-2013/admin/invoices.html">- Invoices</option><option value="file:///D:/classified-2013/admin/login.html">- Login Page</option><option value="file:///D:/classified-2013/admin/mailbox.html">- Mailbox</option><option value="file:///D:/classified-2013/admin/user_profile.html">- User profile</option><option value="file:///D:/classified-2013/admin/settings.html">- Site Settings</option><option value="javascript:void(0)">Sub-menu</option><option value="file:///D:/classified-2013/admin/user-management.html#">- Section 1</option><option value="file:///D:/classified-2013/admin/user-management.html#">- Section 2</option><option value="file:///D:/classified-2013/admin/user-management.html#">- Section 3</option><option value="file:///D:/classified-2013/admin/user-management.html#">- Section 4</option><option value="file:///D:/classified-2013/admin/user-management.html#">-- Section 4.1</option><option value="file:///D:/classified-2013/admin/user-management.html#">-- Section 4.2</option><option value="file:///D:/classified-2013/admin/user-management.html#">-- Section 4.3</option><option value="file:///D:/classified-2013/admin/user-management.html#">-- Section 4.4</option><option value="file:///D:/classified-2013/admin/user-management.html#">--- Section 4.4.1</option><option value="file:///D:/classified-2013/admin/user-management.html#">--- Section 4.4.2</option><option value="file:///D:/classified-2013/admin/user-management.html#">--- Section 4.4.4</option><option value="file:///D:/classified-2013/admin/user-management.html#">--- Section 4.4.5</option><option value="file:///D:/classified-2013/admin/user-management.html#">- Section5</option><option value="file:///D:/classified-2013/admin/user-management.html#">- Section6</option></select>
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
<!--banner-->
<div class="row-fluid">
<div class="fluid_container">
<div class="camera_wrap camera_azure_skin" id="camera_wrap_1">
<!--
<div data-thumb="images_old/slides/thumbs/bridge.jpg" data-src="images_old/slides/bridge.jpg">
<div class="camera_caption fadeFromBottom">
Camera is a responsive/adaptive slideshow. <em>Try to resize the browser window</em>
</div>
</div>
<div data-thumb="images_old/slides/thumbs/leaf.jpg" data-src="images_old/slides/leaf.jpg">
<div class="camera_caption fadeFromBottom">
It uses a light version of jQuery mobile, <em>navigate the slides by swiping with your fingers</em>
</div>
</div>
<div data-thumb="images_old/slides/thumbs/road.jpg" data-src="images_old/slides/road.jpg">
<div class="camera_caption fadeFromBottom">
<em>It's completely free</em> (even if a donation is appreciated)
</div>
</div>
<div data-thumb="images_old/slides/thumbs/sea.jpg" data-src="images_old/slides/sea.jpg">
<div class="camera_caption fadeFromBottom">
Camera slideshow provides many options <em>to customize your project</em> as more as possible
</div>
</div>
<div data-thumb="images_old/slides/thumbs/shelter.jpg" data-src="images_old/slides/shelter.jpg">
<div class="camera_caption fadeFromBottom">
It supports captions, HTML elements and videos and <em>it's validated in HTML5</em> (<a href="http://validator.w3.org/check?uri=http%3A%2F%2Fwww.pixedelic.com%2Fplugins%2Fcamera%2F&amp;charset=%28detect+automatically%29&amp;doctype=Inline&amp;group=0&amp;user-agent=W3C_Validator%2F1.2" target="_blank">have a look</a>)
</div>
</div>
<div data-thumb="images_old/slides/thumbs/tree.jpg" data-src="images_old/slides/tree.jpg">
<div class="camera_caption fadeFromBottom">
Different color skins and layouts available, <em>fullscreen ready too</em>
</div>
</div>
</div>-->
<?php echo $this->_tpl_vars['slideshow']; ?>
</div><!-- #camera_wrap_1 -->
</div>
</div>
</div>
</div>
</header>
<!-- body start here-->
<div class="container">
<!--<span class="visible-desktop"><div class="title_fnt">
<h1>Feature Products </h1><a href="javascript:void(0)" class="left_arrow"></a> <a href="javascript:void(0)"  class="right_arrow"></a>
</div><div class="row-fluid">
<div class="freshdesignweb">    -->
<!-- Portfolio 4 Column start -->
<!--<div class="image_grid portfolio_4col">
<div id="horz_scroll_id">-->
<?php echo $this->_tpl_vars['allfeaturedproducts']; ?>
<!--  </div>
</div>
</div>
</div></span>-->
<span class="hidden-desktop"><div class="title_fnt">
<h1>Feature Products </h1>
</div><div class="row-fluid">
<div class="freshdesignweb">
<div class="image_grid portfolio_4col">
<ul style="margin-left:12px" id="list" class="portfolio_list da-thumbs">
<?php echo $this->_tpl_vars['allfeaturedproductshidden']; ?>
</ul>
</div>
</div>
</div></span>
<div class="title_fnt">
<h1>Products</h1>
</div>
<div class="row-fluid">
<div class="freshdesignweb">
<?php echo $this->_tpl_vars['newproducts']; ?>
<!-- Portfolio 4 Column End -->
</div>
</div>
<div id="welcome_div">
<div class="row-fluid">
<div class="span12">
<h2>About BEAUTY Shop</h2>
<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit...</p>
<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit...</p>
<div class="clear"></div>
</div>
</div>
</div>
<div class="row-fluid" id="ad_banner">
<div class="span6"><img src="assets/img/ad1/2dayslimb-468x60.gif" alt="01"></div>
<div class="span6"><img src="assets/img/ad1/acai468x60-1.gif"  alt="5"></div>
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