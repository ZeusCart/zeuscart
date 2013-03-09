<?php 
 ob_start(); ?><?php /* Smarty version 2.6.19, created on 2013-02-23 12:59:24
compiled from googlebase.html */ ?>
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
<td colspan="5" align="left" class="content_title">Google Base</td>
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
<tr><td  class='content_list_head'>Google Base</td></tr>
<tr><td>
<table>
<tr>
<td colspan="3" align="left" valign="top"><img src="images/googleBase.gif" name="googlelogo" />
<p> Google Base is a place where you can easily submit all types of online and offline content which we'll make searchable. Using Base, your content can appear online within Google Product Search and Google Web Search, in addition to Google Base - all for free.</p>
<br/>
For More Information <a href="http://base.google.com/base/tour/more.html" >Click Here</a></td>
<td><img src="images/jobsearch.jpg" name="google" ></td>
</tr>
<tr>
<td colspan="3" align="left">&nbsp;</td>
</tr>
<tr>
<td class="" width="35%" colspan="0" align="left"><a href="?do=googleproduct&action=export" >Click Here</a> to get the Google Base product data feed in Excel format </td>
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