<?php 
 ob_start(); ?><?php /* Smarty version 2.6.19, created on 2013-02-23 15:11:27
compiled from quickinfo.html */ ?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Quick Information</title>
<link rel="stylesheet" href="css/<?php echo $this->_tpl_vars['skinname']; ?>
/styles.css" type="text/css" />
</head>
<script type="text/javascript">
</script>
<body>
<div style="padding-left:10px;"><?php echo $this->_tpl_vars['result']; ?>
</div>
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