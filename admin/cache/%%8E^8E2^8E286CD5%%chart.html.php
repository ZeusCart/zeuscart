<?php 
 ob_start(); ?><?php /* Smarty version 2.6.19, created on 2013-02-23 12:58:52
compiled from chart.html */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
?>
<script language='javascript' src='../js/FusionCharts.js'></script>
<tr>
<td width="75%" align="center" valign="top">
<table width="95%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td align="left"><?php echo $this->_tpl_vars['createpagemsg']; ?>
<?php echo $this->_tpl_vars['deletepage']; ?>
</td>
</tr>
<tr>
<td align="left" class="content_title"><?php echo $this->_tpl_vars['showchart']['header']; ?>
</td>
</tr>
<tr>
<td align="left">&nbsp;</td>
</tr>
<tr>
<td align="left"><?php echo $this->_tpl_vars['messages']; ?>
&nbsp;</td>
</tr>
<tr>
<td align="left">&nbsp;</td>
</tr>
<tr>
<td>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="content_list_bdr">
<?php if ($this->_tpl_vars['showchart']['id'] == '8' || $this->_tpl_vars['showchart']['id'] == '12'): ?>
<?php else: ?>
<tr>
<td  align="left" class="content_list_head" valign="top"><?php echo $this->_tpl_vars['showchart']['header']; ?>
</td>
</tr>
<form name="chart" action="?do=showchart&id=<?php echo $this->_tpl_vars['showchart']['id']; ?>
" method="post">
<tr>
<td align="left">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td>&nbsp;</td>
<td width="10%" align="right" class="content_form">Date Range :</td>
<td width="10%" align="center" class="content_form">
<?php echo $this->_tpl_vars['showchart']['type']; ?>
</td>
<td width="70%" class="content_list_txt1" align="left" >
<table width="48%" border="0" cellpadding="0" cellspacing="0">
<tr>
<td id="customDate" style="display:none" align="left">
<?php echo $this->_tpl_vars['showchart']['frommnth']; ?>
&nbsp;
<?php echo $this->_tpl_vars['showchart']['fromyr']; ?>
&nbsp;
<span class="content_form">to</span>&nbsp;
<?php echo $this->_tpl_vars['showchart']['tomnth']; ?>
&nbsp;
<?php echo $this->_tpl_vars['showchart']['toyr']; ?>
&nbsp;
</td>
<td align="left">
<input type="submit" name="submit" class="all_bttn" value="Go"/>
</td>
</tr>
</table>
</td>
</tr>
</table>
</td></tr>
</form>
</table>
<tr>
<td align="left">&nbsp;</td>
</tr>
<?php endif; ?>
<tr>
<td>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="content_list_bdr">
<tr>
<td align="center" class="content_form" colspan="2">
<!--<input type='button' class="all_bttn" value='Column' onClick="javaScript:updateChart('../includes/Charts/FCF_Column3D.swf');" name='btnColumn' />
<input type='button' class="all_bttn" value='Line' onClick="javaScript:updateChart('../includes/Charts/FCF_Line.swf');" name='btnLine' />
<input type='button' class="all_bttn" value='Pie' onClick="javaScript:updateChart('../includes/Charts/FCF_Pie3D.swf');" name='btnPie' />
<input type='button' class="all_bttn" value='Bar' onClick="javaScript:updateChart('../includes/Charts/FCF_Bar2D.swf');" name='btnBar' />
<input type='button' class="all_bttn" value='Doughnut' onClick="javaScript:updateChart('../includes/Charts/FCF_Doughnut2D.swf');" name='Doughnut' />   -->
<div id="chart1div">FusionCharts</div>
</td>
</tr>
</table></td></tr>
</td>
</tr>
</table>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
?>
<script language="JavaScript">
function doCustomDate(id)
{
if(id=='5')
document.getElementById('customDate').style.display = "block";
else
document.getElementById('customDate').style.display = "none";
}
function updateChart(chartSWF){
//Create another instance of the chart.
var chart1 = new FusionCharts(chartSWF, "chart1Id", "900", "600", "0", "0");
chart1.setDataXML("<?php echo $this->_tpl_vars['showchart']['xml']; ?>
");
chart1.render("chart1div");
}
window.onload=updateChart("../includes/Charts/FCF_Column3D.swf");
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