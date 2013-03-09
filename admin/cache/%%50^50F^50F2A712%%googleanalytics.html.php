<?php 
 ob_start(); ?><?php /* Smarty version 2.6.19, created on 2013-02-23 12:59:27
compiled from googleanalytics.html */ ?>
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
<td align="left" class="content_title">Google Analytics Settings<!--&nbsp;<img src="images/help.gif" onmouseover="ShowHelp('dchead', 'Google Analytics Settings', 'Add here')" onmouseout="HideHelp('dchead');">
<div id="dchead" style="left: 50px; top: 50px;"></div>--> </td>
</tr>
<!--<tr>
<td align="left">&nbsp;</td>
</tr>-->
<tr>
<td align="center" style="padding-top:5px; padding-bottom:5px;"><?php echo $this->_tpl_vars['updategooglemsg']; ?>
</td>
</tr>
<!--<tr>
<td align="left">&nbsp;</td>
</tr>-->
<tr>
<td align="left" class="content_list_bdr"><form name="site" action="?do=ganalytics&action=update" method="post" >
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td  align="left" class="content_list_head" valign="top">Google Analytics Tracking Script</td>
</tr>
<tr><td valign="top" align="center"><img src="http://www.google.com/analytics/images/logo_ga.gif" width="184" height="47"/></td>
<tr>
<tr>
<td class="" align="center"><?php echo $this->_tpl_vars['gcode']; ?>
</td>
</tr>
<tr>
<td align="center" class="content_list_txt1"><input  type="submit" class="all_bttn"  name="button" id="button" value="Save Settings"  /></td>
</tr>
</table>
</form></td>
</tr>
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