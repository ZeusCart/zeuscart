<?php 
//***************** Do not Edit / Change anything in this file ********************// 
class Bin_Configuration extends Bin_Security {  
var $config = array();  
function Bin_Configuration() {  
$this->config["HOST"] = '';  
$this->config["USER"] = '';  
$this->config["PASSWORD"] = '';  
$this->config["DB"] = '';  
} }  
define("IMAGE1_WIDTH",225);  
define("IMAGE1_HEIGHT",180);  
define("THUMB_WIDTH", 90);  
define("THUMB_HEIGHT",80);  
$_SESSION["base_url"]= ''; 
?>
