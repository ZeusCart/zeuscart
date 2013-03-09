<?php 
 ob_start(); ?><?php /* Smarty version 2.6.19, created on 2013-02-23 12:58:34
compiled from OrderManagement.html */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
?>
<script type="text/javascript" src="js/bsn.AutoSuggest_2.1.3.js" charset="utf-8"></script>
<link rel="stylesheet" href="css/autosuggest_inquisitor.css" type="text/css" media="screen" charset="utf-8" />
<script type="text/javascript" src="script/ajax.js"></script>
<script type="text/javascript" src="js/calendar/calendar.js"></script>
<script type="text/javascript" src="js/calendar/calendar-setup.js"></script>
<script type="text/javascript" src="js/calendar/calendar-en.js"></script>
<script type="text/javascript">
<!--
function selDeSel(a){
//var mark = a == 'sel' ? 'checked' : '';
var inputs = document.getElementsByName('chkorder[]');
var checkboxes = [];
for (var i = 0; i < inputs.length; i++)
{
if (inputs[i].type == 'checkbox')
{
inputs[i].checked =true;
}
}
}
function selUnDeSel(a){
//var mark = a == 'sel' ? 'checked' : '';
var inputs = document.getElementsByName('chkorder[]');
var checkboxes = [];
for (var i = 0; i < inputs.length; i++)
{
if (inputs[i].type == 'checkbox')
{
inputs[i].checked =false;
}
}
}
function showOrderDetail(id)
{
if(document.getElementById('orderDetail'+id).style.display=='none')
{
document.getElementById('order'+id).style.backgroundColor='#DBF3FF';
document.getElementById('quick'+id).src="images/minus.gif";
document.getElementById('orderDetail'+id).style.display='block';
}
else
{
document.getElementById('order'+id).style.backgroundColor='';
document.getElementById('quick'+id).src="images/plus.gif";
document.getElementById('orderDetail'+id).style.display='none';
}
}
-->
</script>
<link href="css/calendar_styles.css" rel="stylesheet" type="text/css" />
<tr>
<td>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td align="left" class="content_title">Order Management</td>
</tr>
<tr>
<td align="left">&nbsp;</td>
</tr>
<tr>
<td align="left"><?php echo $this->_tpl_vars['orderlist']; ?>
</td>
</tr>
</table>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
?>
<script type="text/javascript">
var options = {
script:"?do=disporders&action=autoc&ids=1&json=true&limit=6&",
varname:"input",
json:true,
shownoresults:false,
maxresults:6,
callback: function (obj) { document.getElementById('testid').value = obj.id; }
};
var as_json = new bsn.AutoSuggest('orderid', options);
var options_xml = {
script: function (input) { return "?do=disporders&action=autoc&ids=1&input="+input+"&testid="+document.getElementById('testid').value; },
varname:"input"
};
var as_xml = new bsn.AutoSuggest('orderid_xml', options_xml);
var options = {
script:"?do=disporders&action=autoc&ids=2&json=true&limit=6&",
varname:"input",
json:true,
shownoresults:false,
maxresults:6,
callback: function (obj) { document.getElementById('testid').value = obj.id; }
};
var as_json = new bsn.AutoSuggest('dispname', options);
var options_xml = {
script: function (input) { return "?do=disporders&action=autoc&ids=2&input="+input+"&testid="+document.getElementById('testid').value; },
varname:"input"
};
var as_xml = new bsn.AutoSuggest('dispname_xml', options_xml);
var options = {
script:"?do=disporders&action=autoc&ids=3&json=true&limit=6&",
varname:"input",
json:true,
shownoresults:false,
maxresults:6,
callback: function (obj) { document.getElementById('testid').value = obj.id; }
};
var as_json = new bsn.AutoSuggest('billname', options);
var options_xml = {
script: function (input) { return "?do=disporders&action=autoc&ids=3&input="+input+"&testid="+document.getElementById('testid').value; },
varname:"input"
};
var as_xml = new bsn.AutoSuggest('billname_xml', options_xml);
var options = {
script:"?do=disporders&action=autoc&ids=4&json=true&limit=6&",
varname:"input",
json:true,
shownoresults:false,
maxresults:6,
callback: function (obj) { document.getElementById('testid').value = obj.id; }
};
var as_json = new bsn.AutoSuggest('shipname', options);
var options_xml = {
script: function (input) { return "?do=disporders&action=autoc&ids=4&input="+input+"&testid="+document.getElementById('testid').value; },
varname:"input"
};
var as_xml = new bsn.AutoSuggest('shipname_xml', options_xml);
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