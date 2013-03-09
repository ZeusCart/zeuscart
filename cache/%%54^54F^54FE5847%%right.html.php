<?php 
 ob_start(); ?><?php /* Smarty version 2.6.19, created on 2013-03-05 10:16:28
compiled from right.html */ ?>
<div class="span3"><div id="block_div">
<h2>Categories</h2>
<div class="left_menu">
<?php echo $this->_tpl_vars['categorytree']; ?>
<div class="expand-collapse">
<a rel="tree" class="nicetree_expand" href="javascript:;">Exapand All</AJDF:output>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;<a rel="tree" class="nicetree_collapse" href="javascript:;">Collapse All</a>
</div>
</div>
</div>
<!--<div id="feature_event">
<h4>Special Product </h4>
<div id="special_product">
<ul class="eventlist">
<li><div id="eventlist">
<table width="100%" border="0">
<tr>
<td align="left" valign="top"><div class="eventimg"><img src="assets/img/products/portfolio1.jpg" alt="01"></div></td>
<td align="left" valign="top"><h5><a href="#">Lattice Back </a></h5><p>Sed ut perspiciatis unde omnis iste natus error</p>
<b>$ 100.00</b> <s>$120.00</s> <a href="#" class="btn btn-danger btn-mini">Add to Cart</a>
</td>
</tr>
</table>
</div></li>
<li><div id="eventlist">
<table width="100%" border="0">
<tr>
<td align="left" valign="top"><div class="eventimg"><img src="assets/img/products/portfolio2.jpg" alt="01"></div></td>
<td align="left" valign="top"><h5><a href="#">Lattice Back </a></h5><p>Sed ut perspiciatis unde omnis iste natus error</p>
<b>$ 100.00</b> <s>$120.00</s> <a href="#" class="btn btn-danger btn-mini">Add to Cart</a>
</td>
</tr>
</table>
</div></li>
<li><div id="eventlist">
<table width="100%" border="0">
<tr>
<td align="left" valign="top"><div class="eventimg"><img src="assets/img/products/portfolio2.jpg" alt="01"></div></td>
<td align="left" valign="top"><h5><a href="#">Lattice Back </a></h5><p>Sed ut perspiciatis unde omnis iste natus error</p>
<b>$ 100.00</b> <s>$120.00</s> <a href="#" class="btn btn-danger btn-mini">Add to Cart</a>
</td>
</tr>
</table>
</div></li>
<li><div id="eventlist">
<table width="100%" border="0">
<tr>
<td align="left" valign="top"><div class="eventimg"><img src="assets/img/products/portfolio1.jpg" alt="01"></div></td>
<td align="left" valign="top"><h5><a href="#">Lattice Back </a></h5><p>Sed ut perspiciatis unde omnis iste natus error</p>
<b>$ 100.00</b> <s>$120.00</s> <a href="#" class="btn btn-danger btn-mini">Add to Cart</a>
</td>
</tr>
</table>
</div></li>
<li><div id="eventlist">
<table width="100%" border="0">
<tr>
<td align="left" valign="top"><div class="eventimg"><img src="assets/img/products/portfolio2.jpg" alt="01"></div></td>
<td align="left" valign="top"><h5><a href="#">Lattice Back </a></h5><p>Sed ut perspiciatis unde omnis iste natus error</p>
<b>$ 100.00</b> <s>$120.00</s> <a href="#" class="btn btn-danger btn-mini">Add to Cart</a>
</td>
</tr>
</table>
</div></li>
<li><div id="eventlist">
<table width="100%" border="0">
<tr>
<td align="left" valign="top"><div class="eventimg"><img src="assets/img/products/portfolio2.jpg" alt="01"></div></td>
<td align="left" valign="top"><h5><a href="#">Lattice Back </a></h5><p>Sed ut perspiciatis unde omnis iste natus error</p>
<b>$ 100.00</b> <s>$120.00</s> <a href="#" class="btn btn-danger btn-mini">Add to Cart</a>
</td>
</tr>
</table>
</div></li>
</ul>
</div></div>-->
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