<?php
class Model_MCaptcha
{
	var $output = array();
	
	function showCaptcha()
	{		
		include('classes/Lib/Captcha.php');	
	}
}
?>