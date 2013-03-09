<?php 
 ob_start(); ?><?php /* Smarty version 2.6.19, created on 2013-03-06 11:05:00
compiled from userIndex.html */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
?>
<!-- body start here-->
<div class="container">
<ul class="breadcrumb">
<li><a href="#">Home</a> <span class="divider">/</span></li>
<li class="active"> My Account </li>
</ul>
<div class="row-fluid">
<!--<div class="span3">
<div id="block_div">
<h2>My Account</h2>
<ul class="accountlists">
<li><a href="#" class="select"><i class="icon-chevron-right"></i> Account Dashboard</a></li>
<li><a href="#" class="unselect"><i class="icon-chevron-right"></i> Account Information</a></li>
<li><a href="#" class="unselect"><i class="icon-chevron-right"></i> Address Book</a></li>
<li><a href="#" class="unselect"><i class="icon-chevron-right"></i> My Orders</a></li>
<li><a href="#" class="unselect"><i class="icon-chevron-right"></i> My Product Reviews</a></li>
</ul>
</div>
</div>-->
<?php if ($_GET['do'] != 'myorder'): ?>
<?php echo $this->_tpl_vars['userLeftMenu']; ?>
<?php endif; ?>
<!--<div class="span9">
<div class="title_fnt">
<h1>My Account</h1>
</div>
<div id="myaccount_div">
<div class="myacc_detail">
<h4>Hello, revathi!</h4>
<p>From your My Account Dashboard you have the ability to view a snapshot of your recent account activity and update your account information. Select a link below to view or edit information.</p>
<p class="pull-right"><a href="#" class="btn btn-inverse">View All</a></p>
<div class="clear"></div>
<h4>Recent Order</h4>
</div>
<table class="rt cf" id="rt1">
<thead class="cf">
<tr>
<th>Order</th>
<th>Ship to</th>
<th>Order Total</th>
<th>Status</th>
<th>Detail</th>
</tr>
</thead>
<tbody>
<tr>
<td>#1</td>
<td>Karthik Kumar</td>
<td>INR  1,100.00</td>
<td><span class="label label-important">Pending</span> <span class="label label-success">Finished</span></td>
<td><a href="#" class="btn btn-mini">View Order</a></td>
</tr>
<tr>
<td>#2</td>
<td>Satheesh</td>
<td>INR  500.00</td>
<td><span class="label label-important">Pending</span> <span class="label label-success">Finished</span></td>
<td><a href="#" class="btn btn-mini">View Order</a></td>
</tr>
<tr>
<td>#3</td>
<td>Vinith Kumar</td>
<td>INR  300.00</td>
<td><span class="label label-important">Pending</span> <span class="label label-success">Finished</span></td>
<td><a href="#" class="btn btn-mini">View Order</a></td>
</tr>
<tr>
<td>#4</td>
<td>Mani Mala</td>
<td>INR  15,100.00</td>
<td><span class="label label-important">Pending</span> <span class="label label-success">Finished</span></td>
<td><a href="#" class="btn btn-mini">View Order</a></td>
</tr>
<tr>
<td>#5</td>
<td>Seetha Lakshmi</td>
<td>INR  3,300.00</td>
<td><span class="label label-important">Pending</span> <span class="label label-success">Finished</span></td>
<td><a href="#" class="btn btn-mini">View Order</a></td>
</tr>
<tr>
<td>#6</td>
<td>Bala</td>
<td>INR  1,100.00</td>
<td><span class="label label-important">Pending</span> <span class="label label-success">Finished</span></td>
<td><a href="#" class="btn btn-mini">View Order</a></td>
</tr>
</tbody>
</table>
</div>
</div>-->
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "userright.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
?>
</div>
</div>
<!-- /container -->
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