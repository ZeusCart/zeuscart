<?php 
 ob_start(); ?><?php /* Smarty version 2.6.19, created on 2013-02-23 12:49:13
compiled from left.html */ ?>
<div id="left">
<div class="leftmenu">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td><?php echo $this->_tpl_vars['categories']; ?>
</td>
</tr>
<tr>
<td class="border1">
<?php echo $this->_tpl_vars['headermenu']; ?>
</td>
</tr>
<tr>
<td valign="top" class="roundbox1_bottom" > <!--<img src="css/default/images/bot.gif" alt="" width="189" height="4" />--> &nbsp;</td>
</tr>
</table>
</div>
<div class="leftmenu">
<form name="newsletter" action="?do=subnewsletter" method="post">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td><div class="heading"><span class="headingTXT">NewsLetter</span></div></td>
</tr>
<tr>
<td class="border1" style="padding:10px 7px">
<div><input name="email" type="text" class="txtbox1 w3" maxlength="100" value="Your Email" onblur="if(this.value=='') this.value='Your Email'" onfocus="this.value=''" />
<!--<input type="image" src="images/go_1.jpg" alt="find" name="Image28" width="30" height="20" border="0" onclick="document.frmSearch.submit();"  style="vertical-align:bottom;"/>--><input type="submit" value="Go" class="gobutton">
<!--<a href="#"><img src="images/go1.gif" alt="go" width="34" height="23" border="0" style="vertical-align:bottom;" /></a>--></div>
<div class="newsletterTXT">Subscribe for our exclusive offers and more!</div>
</td>
</tr>
<tr>
<td valign="top" class="roundbox1_bottom" ><!--<img src="css/<?php echo $this->_tpl_vars['skinname']; ?>
/images/bot.gif" alt="" width="189" height="4" />-->&nbsp;</td>
</tr>
</table>
</form>
</div>
<div class="leftmenu">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td><div class="heading"><span class="headingTXT">Recently Viewed</span></div></td>
</tr>
<tr>
<td valign="top" class="border1" style="padding:7px">
<?php echo $this->_tpl_vars['lastviewedproducts']; ?>
</td>
</tr>
<tr>
<td valign="top" class="roundbox1_bottom" ><!--<img src="images/bot.gif" alt="" width="189" height="4" />--> &nbsp;</td>
</tr>
</table>
</div>
<div class="leftmenu">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td><div class="heading"><span class="headingTXT">Latest News </span></div></td>
</tr>
<tr>
<td valign="top" class="border1" style="padding:7px">
<?php echo $this->_tpl_vars['newstitle']; ?>
</td>
</tr>
<tr>
<td valign="top" class="roundbox1_bottom" ><!--<img src="images/bot.gif" alt="" width="189" height="4" />--> &nbsp;</td>
</tr>
</table>
</div>
</div>
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