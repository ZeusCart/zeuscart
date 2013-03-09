<?php 
 ob_start(); ?><?php /* Smarty version 2.6.19, created on 2013-02-23 12:59:48
compiled from selectfeatureditems.html */ ?>
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
<script type="text/javascript">
var xmlHttp;
function LoadSubcategory(id,divid)
{
if(id!='')
{
url = "?do=selectfeatured&action=showsubcat&id="+id;
ajax(url,divid);
}
}
function showProducts(subcatid)
{
url ="?do=selectfeatured&action=showproducts&id=" + subcatid;
ajax(url, 'productlist');
}
</script>
<form name="frmcat" action="?do=selectfeatured&action=updateProducts" method="post">
<table width="97%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td colspan="3" align="left" class="content_title">Select Featured Products</td>
</tr>
<tr>
<td colspan="3" align="left">&nbsp;</td>
</tr>
<tr>
<td colspan="3" align="left"><?php echo $this->_tpl_vars['msg']; ?>
</td>
</tr>
<tr>
<td align="left"><table><tr>
<td class="label_name" align="left">Main Category</td>
<td class="label_name" align="left"><select name="cbocat" id="cbocat" class="combo_box2"
onClick=	"LoadSubcategory(this.value,'subCategory');">
<option value="">Select </option>
<?php echo $this->_tpl_vars['maincategory']; ?>
</select></td>&nbsp;<td align="left"  class="label_name"><span id='subCategory'><?php echo $this->_tpl_vars['subcategory']; ?>
</span>
</td></tr></table></td>
</tr>
<tr>
<td colspan="3" align="left">&nbsp;</td>
</tr>
<tr>
<td colspan="2" align="center" id=productlist><?php echo $this->_tpl_vars['product']; ?>
</td>
</tr>
</table>
</form>
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