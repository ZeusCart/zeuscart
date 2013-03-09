<?php 
 ob_start(); ?><?php /* Smarty version 2.6.19, created on 2013-02-23 13:00:38
compiled from userWishlist.html */ ?>
<script language="javascript">
function showDiv()
{
var obj=document.getElementById('divWishSend');
if(obj.style.display=='none')
{
obj.style.display='block';
document.getElementById('hidWishStat').value=1;
}
else
{
obj.style.display='none';
document.getElementById('hidWishStat').value=0;
}
}
</script>
<div><table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td width="100%" colspan="2" class="serachresult">My Wishlist </td>
</tr>
<tr>
<td colspan="2" valign="top">&nbsp;</td>
</tr>
<tr>
<td colspan="2" valign="top">
<div>
<?php echo $this->_tpl_vars['rows']; ?>
</div>
</td>
</tr>
<tr>
<td colspan="2">&nbsp;</td>
</tr>
<tr>
<td align="">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
<td class="account_viewlink"><a href="#" onclick="showDiv()">Send to friend</a></td>
</tr>
</table>
</td>
</tr>
<tr>
<td align="">
<form name="frmWishSend" action="?do=wishlist&action=send" method="post">
<div id="divWishSend" style="display:block;" >
<input type="hidden" name="hidWishStat" id="hidWishStat" value="">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
<td bgcolor="#FFFFFF" class="account_tableTXT">Enter E-Mail Id&nbsp;</td><td><input type=text class="txtbox1 w4 TxtC1" size="50" name="txtEmail" value="<?php echo $this->_tpl_vars['val']['txtEmail']; ?>
">&nbsp;</td>
<td><input type="button" class="button button_left"/></td>
<td><input type="submit" value="Send" class="button" /></td>
<td><input type="button" class="button button_right"/></td>
</tr>
<tr><td></td><td><span style="color:red; font-size:12px;"><?php echo $this->_tpl_vars['msg']['txtEmail']; ?>
</span></td></tr>
</table>
</div>
</form>
</td>
</tr>
</table>
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