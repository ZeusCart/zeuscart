<?php 
 ob_start(); ?><?php /* Smarty version 2.6.19, created on 2013-02-23 12:59:21
compiled from adWord.html */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "left.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
?>
<table width="97%" border="0" cellspacing="0" cellpadding="">
<tr>
<td colspan="5" align="left" class="content_title">Google Adword<!--&nbsp;<img src="images/help.gif" onmouseover="ShowHelp('dchead', 'Google Adword', 'Add here')" onmouseout="HideHelp('dchead');">
<div id="dchead" style="left: 50px; top: 50px;"></div>--></td>
</tr>
<tr>
<td colspan="3" align="left">&nbsp;</td>
</tr>
<tr>
<td colspan="3" align="left"><?php echo $this->_tpl_vars['excel']; ?>
</td>
</tr>
<tr>
<td colspan="3" align="left">&nbsp;</td>
</tr>
<tr><td>
<table cellpadding='8' cellspacing='0' border='0'  class='content_list_bdr' width='100%'>
<tr><td  class='content_list_head'>Google Adword</td></tr>
<tr><td><table>
<tr>
<td colspan="3" align="left" valign="top"><img src="images/google_adword.gif" name="googlelogo" />
<p> No matter what your budget, you can display your Ads on Google and our advertising network. Pay only if people click your Ads.</p>
<td><img src="images/adwordSamp.gif" name="google" ></td>
</tr>
<tr>
<td colspan="3" align="left">&nbsp;</td>
</tr>
<tr>
<td class="" width="35%" colspan="0" align="left"><a href="?do=adword&action=export" >Click Here</a> to get the Google AdWord Campaign data feed in Excel format </td>
</tr>
</table></td></tr>
</table></td></tr>
</table>
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