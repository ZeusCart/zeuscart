<?php 
 ob_start(); ?><?php /* Smarty version 2.6.19, created on 2013-03-07 16:43:17
compiled from timezone.html */ ?>
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
<td align="left" class="content_title">Time Zone </td>
</tr>
<!--<tr>
<td>&nbsp;</td>
</tr>-->
<tr>
<td align="center"  style="padding-top:5px; padding-bottom:5px;"><?php echo $this->_tpl_vars['updatezonemsg']; ?>
</td>
</tr>
<!--<tr>
<td>&nbsp;</td>
</tr>-->
<tr>
<td align="left" class="content_form_bdr"><form name="site" action="?do=timezone&action=update" method="post" >
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td colspan="2" align="left" class="content_list_head">Select Time Zone</td>
</tr>
<tr>
<td align="left">&nbsp;</td>
</tr>
<tr>
<td width="24%" align="left" class="content_form">Current Time Zone :</td>
<td class="content_form"><?php echo $this->_tpl_vars['currentzone']; ?>
</td>
</tr>
<tr>
<td  class="content_form"  align="left"> Set TimeZone to :</td>
<td class="content_form"><?php echo $this->_tpl_vars['timezone']; ?>
&nbsp;<img src="images/help.gif" onmouseover="ShowHelp('dtzone', 'Time Zone', 'Select your Time zone.')" onmouseout="HideHelp('dtzone');">
<div id="dtzone" style="left: 50px; top: 50px;"></div></td>
</tr>
<tr>
<td colspan="2" align="center" height="50"><input type="submit" name="button" id="button" value="Set TimeZone" class="all_bttn"  />
</td>
</tr>
</table> </form>
</td>
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