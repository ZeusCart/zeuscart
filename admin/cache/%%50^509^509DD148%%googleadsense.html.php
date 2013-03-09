<?php 
 ob_start(); ?><?php /* Smarty version 2.6.19, created on 2013-02-23 12:59:05
compiled from googleadsense.html */ ?>
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
<table width="97%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td align="left" class="content_title">Google AdSense Settings <!--&nbsp;<img src="images/help.gif" onmouseover="ShowHelp('dchead', 'Google Adsense Settings', 'Add here')" onmouseout="HideHelp('dchead');">
<div id="dchead" style="left: 50px; top: 50px;"></div>--></td>
</tr>
<tr>
<td align="left">&nbsp;</td>
</tr>
<tr>
<td align="center"><?php echo $this->_tpl_vars['gadsensemsg']; ?>
</td>
</tr>
<tr>
<td align="left">&nbsp;</td>
</tr>
<tr>
<td align="left" class=""><form name="site" action="?do=gadsense&action=update" method="post" >
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="content_list_bdr">
<tr>
<td  align="left" class="content_list_head" valign="top">Google AdSense Tracking Script</td>
</tr>
<tr>	  <td valign="top" align="center"><img src="https://www.google.com/adsense/static/en_US/images/logo_main.gif" width="150" height="58"/></td>
<tr>
<td class="" align="center"  style="padding-top:10px; padding-bottom:10px;" valign="top">
<?php echo $this->_tpl_vars['gadsense']; ?>
</td>
</tr>
<tr>
<td align="center" colspan="0" ><input type="submit" name="button" id="button" value="Save Settings" class="all_bttn"  /></td>
</tr>
</table>
</td> </form>
</tr>
<tr>
<td align="left">&nbsp;</td>
</tr>
<tr><td>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="content_list_bdr">
<tr>
<td  align="left" class="content_list_head" valign="top">Note :</td>
</tr>
<tr>
<td align="left" class="content_form" style="padding-left:20px; padding-top:10px;"> <ol>Please Enter Only The Following Banner Sizes<li>Banner (468 X 60)</li> <li>Half Banner (234 X 60)</li> </ol></td>
</tr>
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