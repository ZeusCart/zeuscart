<?php 
 ob_start(); ?><?php /* Smarty version 2.6.19, created on 2013-02-23 12:49:29
compiled from footer.html */ ?>
<div>&nbsp;</div></td>
</tr>
</table></td>
</tr>
<tr>
<td><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
<tr>
<td width="91%" align="left" class="footer_style">Powered by <a href="http://www.ajsquare.com/products/ecom/" style="text-decoration:none;" target="_blank">ZeusCart</a></td>
<td width="9%" align="left" class="footer_style">Version 2.3</td>
</tr>
</table></td>
</tr>
<tr><td colspan="5" height="35" valign="middle" align="right" class="newsletterTXT">Developed in <a href="http://ajdf.ajsquare.com/" style="text-decoration:none;" target="_blank"><img src="../images/AJDF.gif" alt="AJDF" border="0"/> </a>Framework &nbsp;</td></tr>
</table>
</body>
</html>
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