<?php 
 ob_start(); ?><?php /* Smarty version 2.6.19, created on 2013-03-05 14:46:49
compiled from productdetail.html */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
?>
<!-- body start here-->
<div class="container">
<ul class="breadcrumb">
<li><a href="?do=index">Home</a> <span class="divider">/</span></li>
<li>Product Detail</li>
</ul>
<div class="row-fluid">
<div class="span9">
<!-- <div class="title_fnt">
<h1>Midi Dress With Lattice Back </h1><span class="pull-right"><a href="#" class="share_icn"></a> <a href="#" class="campare_icn"></a></span>
</div>
<div id="gallery_div">
<div class="row-fluid">-->
<?php echo $this->_tpl_vars['product']; ?>
<!-- </div>
<div class="clear"></div>-->
<!--<div class="buyauc_div" style="display:block;">
<ul class="view_div">
<li ><a href="javascript:showAccnt('account_id'); void(0)" class="acc_select" id="account_id1">Product Description</a></li>
<li ><a href="javascript:showAccnt('details_id'); void(0)" class="acc_unselect" id="details_id1">Reviews</a></li>
</ul>
<div style="display:block;" id="account_id" class="prd_desc">
<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit</p>
<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit...</p>
</div>
<div style="display:none;" id="details_id">
<ul class="reviewcmd">
<li><i class="icon-user"></i> James Bond on <i>21/11/2013</i> <span class="pull-right"><img src="assets/img/star.png" alt="star"> <img src="assets/img/star.png" alt="star"> <img src="assets/img/star.png" alt="star"> <img src="assets/img/star.png" alt="star"> <img src="assets/img/star-gray.png" alt="star"></span>
<p>This is fine and proper and I like it. :) :)</p>
</li>
<li><i class="icon-user"></i> James Bond on <i>21/11/2013</i> <span class="pull-right"><img src="assets/img/star.png" alt="star"> <img src="assets/img/star.png" alt="star"> <img src="assets/img/star.png" alt="star"> <img src="assets/img/star.png" alt="star"> <img src="assets/img/star-gray.png" alt="star"></span>
<p>This is fine and proper and I like it. :) :)</p>
</li>
</ul>
<form class="form-horizontal">
<div class="control-group">
<label class="control-label" for="inputEmail">Nickname <i class="red_fnt">*</i></label>
<div class="controls">
<input type="text" id="inputEmail" placeholder="Email">
</div>
</div>
<div class="control-group">
<label class="control-label" for="inputPassword">Summary of Your Review <i class="red_fnt">*</i></label>
<div class="controls">
<input type="password" id="inputPassword" placeholder="Password">
</div>
</div>
<div class="control-group">
<label class="control-label" for="inputPassword">Review <i class="red_fnt">*</i></label>
<div class="controls">
<textarea rows="" cols=""></textarea>
</div>
</div>
<div class="control-group">
<label class="control-label" for="inputPassword">Rating: Bad </label>
<div class="controls">
<input type="radio" style="margin:0; padding:0;"> Bad <input type="radio" style="margin:0; padding:0;"> <input type="radio" style="margin:0; padding:0;"> <input type="radio" style="margin:0; padding:0;"> <input type="radio" style="margin:0; padding:0;"> Good
</div>
</div>
<div class="control-group">
<label class="control-label" for="inputEmail">Enter the code in the box below:</label>
<div class="controls">
<input type="text" id="inputEmail" >
</div>
</div>
<div class="control-group">
&nbsp;
<div class="controls">
<img src="assets/img/captcha.gif" alt="captcha"> </div>
</div>
<div class="control-group">
<div class="controls">
<button type="submit" class="btn btn-danger">Submit Review</button>
</div>
</div>
</form>
</div>
</div>-->
</div>
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
<script type="text/javascript">
var globVal=0;
function fun(s)
{
globVal=0;
for (var i=1;i<=s;i++)
{
document.frm["img"+i].src="assets/img/star.png";
}
document.frm.hidRate.value=s;
}
function fun1(s)
{
if(globVal==0)
{
for (var i=1;i<=5;i++)
{
document.frm["img"+i].src="assets/img/star-gray.png";
}
document.frm.hidRate.value="";
}
}
function fun2(s)
{
globVal=1;
for (var i=1;i<=s;i++)
{
document.frm["img"+i].src="assets/img/star.png";
}
}
var presh = -1
function shuffle()
{
curr = Math.ceil(Math.random()*100);
document.getElementById('captcha').src="?do=captcha&"+ (curr==presh ? Math.ceil(Math.random()*100) : curr);
presh = curr;
}
</script>
<?php if ($_SESSION['reviewResult'] != ''): ?>
<script type="text/javascript">
document.getElementById('details_id').style.display="block";
</script>
<?php endif; ?>
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