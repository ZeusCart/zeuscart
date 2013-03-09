<?php 
 ob_start(); ?><?php /* Smarty version 2.6.19, created on 2013-02-23 13:00:25
compiled from userleft.html */ ?>
<div id="left">
<?php echo $this->_tpl_vars['userLeftMenu']; ?>
<div style="margin-top:14px" class="leftmenu">
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