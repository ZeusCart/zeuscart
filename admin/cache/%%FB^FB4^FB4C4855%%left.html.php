<?php 
 ob_start(); ?><?php /* Smarty version 2.6.19, created on 2009-01-03 06:42:48
compiled from left.html */ ?>
<tr>
<td width="25%" align="left" valign="top" class="content_right_bdr" id="left_collap12_open"><table width="215" border="0" cellspacing="0" cellpadding="0">
<tr>
<td width="215" align="left" class="content_title">Site Statistics </td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td><table width="215" border="0" cellspacing="0" cellpadding="0">
<tr>
<td colspan="2"><img src="images/left_stat_top.gif" alt="" width="215" height="4" /></td>
</tr>
<tr>
<td width="50" align="center" class="content_left_bg"><img src="images/ico_orders.jpg" alt="" width="30" height="34" /></td>
<td width="165" align="left" class="content_left_bg"><span class="site_statistics_txt1">ORDERS</span></td>
</tr>
<tr>
<td colspan="2" align="center" class="content_left_bdr"><table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td width="55%" align="left" class="site_stat_txt1">Current Month</td>
<td width="5%" align="left" class="site_stat_txt2">:</td>
<td width="40%" align="left" class="site_stat_txt3"><?php echo $this->_tpl_vars['monthlyorders']; ?>
</td>
</tr>
<tr>
<td align="left" class="site_stat_txt1">Previous Month</td>
<td align="left" class="site_stat_txt2">:</td>
<td align="left" class="site_stat_txt3"><?php echo $this->_tpl_vars['previousmonthorders']; ?>
</td>
</tr>
<tr>
<td align="left" class="site_stat_txt1">Pending Orders </td>
<td align="left" class="site_stat_txt2">:</td>
<td align="left" class="site_stat_txt3"><?php echo $this->_tpl_vars['pendingorders']; ?>
</td>
</tr>
<tr>
<td align="left" class="site_stat_txt1">Processing Orders </td>
<td align="left" class="site_stat_txt2">:</td>
<td align="left" class="site_stat_txt3"><?php echo $this->_tpl_vars['processingorders']; ?>
</td>
</tr>
<tr>
<td align="left" class="site_stat_txt1">Delivered Orders </td>
<td align="left" class="site_stat_txt2">:</td>
<td align="left" class="site_stat_txt3"><?php echo $this->_tpl_vars['deliveredorders']; ?>
</td>
</tr>
<tr>
<td align="left" class="site_stat_txt1">Total Orders</td>
<td align="left" class="site_stat_txt2">:</td>
<td align="left" class="site_stat_txt3"><?php echo $this->_tpl_vars['totalorders']; ?>
</td>
</tr>
</table></td>
</tr>
<tr>
<td colspan="2"><img src="images/left_stat_bot.gif" alt="" width="215" height="4" /></td>
</tr>
</table></td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td><table width="215" border="0" cellspacing="0" cellpadding="0">
<tr>
<td colspan="2"><img src="images/left_stat_top.gif" alt="" width="215" height="4" /></td>
</tr>
<tr>
<td width="50" align="center" class="content_left_bg"><img src="images/ico_income.jpg" alt="" width="30" height="34" /></td>
<td width="165" align="left" class="content_left_bg"><span class="site_statistics_txt1">SALES</span></td>
</tr>
<tr>
<td colspan="2" align="center" class="content_left_bdr"><table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td width="55%" align="left" class="site_stat_txt1">Current Month</td>
<td width="5%" align="left" class="site_stat_txt2">:</td>
<td width="40%" align="left" class="site_stat_txt3"><?php echo $this->_tpl_vars['currency_type']; ?>
&nbsp;<?php echo $this->_tpl_vars['currentmonthincome']; ?>
</td>
</tr>
<tr>
<td align="left" class="site_stat_txt1">Previous Month</td>
<td align="left" class="site_stat_txt2">:</td>
<td align="left" class="site_stat_txt3"><?php echo $this->_tpl_vars['currency_type']; ?>
&nbsp;<?php echo $this->_tpl_vars['previousmonthincome']; ?>
</td>
</tr>
<tr>
<td align="left" class="site_stat_txt1">Total Sales</td>
<td align="left" class="site_stat_txt2">:</td>
<td align="left" class="site_stat_txt3"><?php echo $this->_tpl_vars['currency_type']; ?>
&nbsp;<?php echo $this->_tpl_vars['totalincome']; ?>
</td>
</tr>
</table></td>
</tr>
<tr>
<td colspan="2"><img src="images/left_stat_bot.gif" alt="" width="215" height="4" /></td>
</tr>
</table></td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td><table width="215" border="0" cellspacing="0" cellpadding="0">
<tr>
<td colspan="2"><img src="images/left_stat_top.gif" alt="" width="215" height="4" /></td>
</tr>
<tr>
<td width="50" align="center" class="content_left_bg"><img src="images/ico_products.jpg" alt="" width="30" height="34" /></td>
<td width="165" align="left" class="content_left_bg"><span class="site_statistics_txt1">PRODUCTS</span></td>
</tr>
<tr>
<td colspan="2" align="center" class="content_left_bdr"><table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td width="55%" align="left" class="site_stat_txt1">Enabled</td>
<td width="5%" align="left" class="site_stat_txt2">:</td>
<td width="40%" align="left" class="site_stat_txt3"><?php echo $this->_tpl_vars['enabledproducts']; ?>
</td>
</tr>
<tr>
<td align="left" class="site_stat_txt1">Disabled</td>
<td align="left" class="site_stat_txt2">:</td>
<td align="left" class="site_stat_txt3"><?php echo $this->_tpl_vars['disabledproducts']; ?>
</td>
</tr>
<tr>
<td align="left" class="site_stat_txt1">Total Products</td>
<td align="left" class="site_stat_txt2">:</td>
<td align="left" class="site_stat_txt3"><?php echo $this->_tpl_vars['totalproducts']; ?>
</td>
</tr>
</table></td>
</tr>
<tr>
<td colspan="2"><img src="images/left_stat_bot.gif" alt="" width="215" height="4" /></td>
</tr>
</table></td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td><table width="215" border="0" cellspacing="0" cellpadding="0">
<tr>
<td colspan="2"><img src="images/left_stat_top.gif" alt="" width="215" height="4" /></td>
</tr>
<tr>
<td width="50" align="center" class="content_left_bg"><img src="images/ico_pro_quantity.jpg" alt="" width="30" height="34" /></td>
<td width="165" align="left" class="content_left_bg"><span class="site_statistics_txt1">PRODUCT INVENTORY </span></td>
</tr>
<tr>
<td colspan="2" align="center" class="content_left_bdr"><table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td width="55%" align="left" class="site_stat_txt1">No of Product in Low Stock</td>
<td width="5%" align="left" class="site_stat_txt2">:</td>
<td width="40%" align="left" class="site_stat_txt3"><?php echo $this->_tpl_vars['lowstock']; ?>
</td>
</tr>
</table></td>
</tr>
<tr>
<td colspan="2"><img src="images/left_stat_bot.gif" alt="" width="215" height="4" /></td>
</tr>
</table></td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td><table width="215" border="0" cellspacing="0" cellpadding="0">
<tr>
<td colspan="2"><img src="images/left_stat_top.gif" alt="" width="215" height="4" /></td>
</tr>
<tr>
<td width="50" align="center" class="content_left_bg"><img src="images/ico_customers.jpg" alt="" width="30" height="34" /></td>
<td width="165" align="left" class="content_left_bg"><span class="site_statistics_txt1">CUSTOMERS</span></td>
</tr>
<tr>
<td colspan="2" align="center" class="content_left_bdr"><table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td width="55%" align="left" class="site_stat_txt1">Current Month</td>
<td width="5%" align="left" class="site_stat_txt2">:</td>
<td width="40%" align="left" class="site_stat_txt3"><?php echo $this->_tpl_vars['currentmonthuser']; ?>
</td>
</tr>
<tr>
<td align="left" class="site_stat_txt1">Previous Month</td>
<td align="left" class="site_stat_txt2">:</td>
<td align="left" class="site_stat_txt3"><?php echo $this->_tpl_vars['previousmonthuser']; ?>
</td>
</tr>
<tr>
<td align="left" class="site_stat_txt1">Total Customers</td>
<td align="left" class="site_stat_txt2">:</td>
<td align="left" class="site_stat_txt3"><?php echo $this->_tpl_vars['totalusers']; ?>
</td>
</tr>
</table></td>
</tr>
<tr>
<td colspan="2"><img src="images/left_stat_bot.gif" alt="" width="215" height="4" /></td>
</tr>
</table></td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
</table></td>
</td>
<td width="75%" align="right" valign="top">
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