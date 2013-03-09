<?php 
 ob_start(); ?><?php /* Smarty version 2.6.19, created on 2013-03-02 10:22:14
compiled from productdetail.html */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
?>
<?php echo $this->_tpl_vars['product']; ?>
<?php echo $this->_tpl_vars['attributes']; ?>
<table cellpadding="0" cellspacing="0" border="0">
<tr><td>
<h3>Related Products</h3></td><td class="">&nbsp;&nbsp;&nbsp;<a href="?do=addcrossproduct" >Add Cross Products To This Product</a>
</td></tr>
<tr>
<?php echo $this->_tpl_vars['relprod']; ?>
</tr>
</table>
<script type="text/javascript" language="javascript">
function  callid(id)
{
window.location= "?do=aprodetail&action=showprod&prodid="+id;
}
</script>
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