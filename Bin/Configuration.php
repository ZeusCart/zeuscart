<?php 
//***************** Do not Edit / Change anything in this file ********************// 
class Bin_Configuration extends Bin_Security {  
var $config = array();  
function Bin_Configuration() {  
$this->config["HOST"] = 'localhost';  
$this->config["USER"] = 'root';  
$this->config["PASSWORD"] = '';  
$this->config["DB"] = 'zeuscart';  
} }  
define("IMAGE1_WIDTH",350);  
define("IMAGE1_HEIGHT",500);  
define("IMAGE2_WIDTH",800);  
define("THUMB_WIDTH", 90);  
define("THUMB_HEIGHT",80);  
?>