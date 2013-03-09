<?php 
 ob_start(); ?><?php /* Smarty version 2.6.19, created on 2013-02-23 13:00:25
compiled from userdashboard.html */ ?>
<?php echo $this->_tpl_vars['result']; ?>
<?php echo $this->_tpl_vars['rows']; ?>
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