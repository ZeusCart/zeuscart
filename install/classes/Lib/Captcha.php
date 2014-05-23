<?php

session_start();

/*
* File: CaptchaSecurityImages.php
* Author: Simon Jarvis
* Copyright: 2006 Simon Jarvis
* Date: 03/08/06
* Updated: 07/02/07
* Requirements: PHP 4/5 with GD and FreeType libraries
* Link: http://www.white-hat-web-design.co.uk/articles/php-captcha.php
* 
* This program is free software; you can redistribute it and/or 
* modify it under the terms of the GNU General Public License 
* as published by the Free Software Foundation; either version 2 
* of the License, or (at your option) any later version.
* 
* This program is distributed in the hope that it will be useful, 
* but WITHOUT ANY WARRANTY; without even the implied warranty of 
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the 
* GNU General Public License for more details: 
* http://www.gnu.org/licenses/gpl.html
*
*/

class Lib_Captcha {
	
	var $font = '../includes/ex_rounded_bold.ttf';	
	
	function generateCode($characters) {
		/* list all possible characters, similar looking characters and vowels have been removed */
		$possible = '123456789abcdfeghjklmnpqrstuvwxyz';
		$code = '';
		$i = 0;
		while ($i < $characters) { 
			$code .= substr($possible, mt_rand(0, strlen($possible)-1), 1);
			$i++;
		}			
		return $code;
	}

	function Lib_Captcha($width='120',$height='40',$characters='6') {
		$code = $this->generateCode($characters);					
		
		/* font size will be 75% of the image height */
		$font_size = 50;//$height * 0.45; //10;//
		
		$image = @imagecreate($width, $height) or die('Cannot initialize new GD image stream');

		/* set the colours */
		$background_color = imagecolorallocate($image, 135,206,250);
		$text_color = imagecolorallocate($image, 255, 255, 255);
		$noise_color = imagecolorallocate($image, 190, 190, 190);
		//205;170;125
		//92;51;23	
		
		/* generate random dots in background */
		for( $i=0; $i<($width*$height)/5; $i++ ) {
			imagefilledellipse($image, mt_rand(0,$width), mt_rand(0,$height), 1, 1, $noise_color);
		}
		/* generate random lines in background */
		for( $i=0; $i<($width*$height)/300; $i++ ) {
			//imageline($image, mt_rand(0,$width), mt_rand(0,$height), mt_rand(0,$width), mt_rand(0,$height), $noise_color);
		}
		/* create textbox and add text */
		$textbox = imagettfbbox($font_size, 0, $this->font, $code) or die('Error in imagettfbbox function');
		$x = ($width - $textbox[4])/2;
		$y = ($height - $textbox[5])/2;
		imagettftext($image, $font_size, 0, $x, $y, $text_color, $this->font , $code) or die('Error in imagettftext function');
		
		/* output captcha image to browser */		
		header('Content-Type: image/jpeg');
		header('Cache-Control: no-cache, must-revalidate');
		imagejpeg($image);
		imagedestroy($image);
				
		if(isset($_GET['id']) && $_GET['id']=="quicklogin")
		{			
			$_SESSION['security_code_quicklogin']=$code;
		}
		else
		{				
			$_SESSION['security_code'] = $code;	
		}
			
	}

}

$width =  '250';
$height = '90';
$characters = '5';
$captcha = new Lib_Captcha($width,$height,$characters);


?>