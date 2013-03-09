<?php 
 ob_start(); ?><?php /* Smarty version 2.6.19, created on 2013-02-23 13:11:27
compiled from manageproducts.html */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
?>
<!--<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "left.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
?>-->
<script type="text/javascript" src="js/calendar/calendar.js"></script>
<script type="text/javascript" src="js/calendar/calendar-setup.js"></script>
<script type="text/javascript" src="js/calendar/calendar-en.js"></script>
<script type="text/javascript" src="js/common.js"></script>
<script type="text/javascript" src="js/bsn.AutoSuggest_2.1.3.js" charset="utf-8"></script>
<link href="css/calendar_styles.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="css/autosuggest_inquisitor.css" type="text/css" media="screen" charset="utf-8" />
<script type="text/javascript">
var xmlHttp;
function LoadSubcategory(id,divid)
{
if(id!='')
{
url = "?do=addcrossproduct&action=showsubcat&id="+id;
ajax(url,divid);
}
}
function showProducts(subcatid)
{
url ="?do=addcrossproduct&action=showproducts&id=" + subcatid;
ajax(url, 'productlist');
}
function callAjax()
{
//alert('d');
//var obj = actb(document.getElementById('tb'),custom2);
var word=document.getElementById('tb').value;
url ="?do=manageproducts&action=gettitle&word=" + word;
var cust=ajax(url, 'titlescheck');
//var obj = actb(document.getElementById('tb'),customarray)
}
</script>
<tr><td>
<table width="99%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td colspan="8" align="left"><table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td class="content_title" width="80%">Product List</td>
<td class="content_title" width="30%" align="right"><a href="javascript:history.back()" class="more_page">Back</a></td>
</tr>
</table>
</td>
</tr>
<tr>
<td colspan="3" align="left">&nbsp;</td>
</tr>
<tr>
<td align="left" class="top_links"><!--<a href="?do=manageproducts">View All Products </a>--></td><td align="right" class="top_links"><a href="?do=productentry" class="add_link">Add Product </a> </td></tr>
<tr>
<td colspan="2" style="" ><?php echo $this->_tpl_vars['updatemsg']; ?>
<?php echo $this->_tpl_vars['deletemsg']; ?>
<?php echo $this->_tpl_vars['updateproduct']; ?>
</td>
</tr>
<tr>
<td colspan="3" align="left" >&nbsp;</td>
</tr>
<tr>
<td colspan="2" align="center" id=productlist >
<?php echo $this->_tpl_vars['allproducts']; ?>
<?php echo $this->_tpl_vars['searchproduct']; ?>
</td></tr></table>
<!--<div ><?php echo $this->_tpl_vars['products']; ?>
</div>-->
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
?>
<script>
function call(custom2)
{
//var obj = actb(document.getElementById('tb'),custom2);
document.getElementById('tb').value=custom2;
document.getElementById('titlescheck').style.display='none';
}
//setTimeout(function(){obj.actb_keywords = custom2;},10000);
</script>
<script type="text/javascript">
var options = {
script:"?do=manageproducts&action=autoc&json=true&limit=6&",
varname:"input",
json:true,
shownoresults:false,
maxresults:6,
callback: function (obj) { document.getElementById('testid').value = obj.id; }
};
var as_json = new bsn.AutoSuggest('title', options);
var options_xml = {
script: function (input) { return "?do=manageproducts&action=autoc&input="+input+"&testid="+document.getElementById('testid').value; },
varname:"input"
};
var as_xml = new bsn.AutoSuggest('title_xml', options_xml);
</script>
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