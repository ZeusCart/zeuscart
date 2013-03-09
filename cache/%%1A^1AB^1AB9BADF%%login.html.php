<?php 
 ob_start(); ?><?php /* Smarty version 2.6.19, created on 2013-03-07 10:21:21
compiled from login.html */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
?>
<!-- body start here-->
<div class="container">
<ul class="breadcrumb">
<li><a href="?do=index">Home</a> <span class="divider">/</span></li>
<li class="active"> Member Login </li>
</ul>
<div class="row-fluid">
<div class="title_fnt">
<h1>Member Login</h1>
</div>
<div class="row-fluid">
<div class="span6">
<form name="loginfrm" method="post" action="?do=login&action=validatelogin" >
<div id="loginfrm">
<ul class="loginfourm">
<li><b>E-mail Address</b></li>
<li><input type="text" name="txtemail" class="input-large" value="<?php echo $this->_tpl_vars['val']['txtemail']; ?>
"><br /><font color="#FF0000">
<?php echo $this->_tpl_vars['msg']['txtemail']; ?>
</font></li>
<li><b>Password</b></li>
<li><input type="password" name="txtpass" class="input-large"><br /><font color="#FF0000">
<?php echo $this->_tpl_vars['msg']['txtpass']; ?>
</font></li>
<li><input type="checkbox"> Remember me?</li>
<li><input type="submit" value="Login" class="btn btn-danger"> </li>
<li><a href="?do=forgetpwd"> Forgot password? </a> <span>OR</span> <a href="#">Need help?</a> </li>
</ul>
</div>
</form>
</div>
<div class="span6">
<div class="followus_div"><a class="facebook_btn" href="#"></a><a class="twitter_btn" href="#"></a><a class="google_btn" href="#"></a></div>
<p class="userlogin_fnt"><span>or log in using your username and Password</span></p>
<div id="signin_acc">
<ul class="signin-account">
<li> <h5>SIGN UP FOR AN ACCOUNT</h5></li>
<li> <p>Registration is fast and FREE! </p></li>
<a> <a href="?do=userregistration"><input type="button" value="Register Here" class="btn btn-inverse"></a></li>
</ul>
<b>Account Protection Tips </b>
<ul class="acctips">
<li>Choose a strong password and change it often.</li>
<li>Avoid using the same password for other accounts.</li>
<li>Create a unique password by using a combination of letters and numbers that are not easily guessed.</li>
</ul>
</div>
</div>
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