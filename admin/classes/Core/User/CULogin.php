<?php
/**
* GNU General Public License.

* This file is part of ZeusCart V4.

* ZeusCart V4 is free software: you can redistribute it and/or modify
* it under the terms of the GNU General Public License as published by
* the Free Software Foundation, either version 4 of the License, or
* (at your option) any later version.
* 
* ZeusCart V4 is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
* GNU General Public License for more details.
* 
* You should have received a copy of the GNU General Public License
* along with Foobar. If not, see <http://www.gnu.org/licenses/>.
*
*/

/**
 * This class contains functions to check whether the login status 
 *
 * @package  		Core_CULogin
 * @category  		Core
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
   * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */

class Core_CULogin
{
	/**
	 * Stores the output
	 *
	 * @var array $output
	 */		
	var $output = array();
	
	
	/**
	 * Function checks whether the user exists in the database
	 * 
	 * 
	 * @return array
	 */
	 	
	
	function checkUSer()
	{
		/**
		*
		* Here database query comes
		*
		*/
		
		$sql = "SELECT * FROM user_registration  WHERE user_name='".mysql_escape_string($_POST['usernametxt'])."' and user_password = '".    mysql_escape_string(base64_encode($_POST['passwordtxt']))."'";
		$obj = new Bin_Query();
		if($obj->executeQuery($sql))
		{
			$arr = $obj->totrows;
			print_r($arr);
		}
		if($arr == 1)
		{
			if($obj->records[0]['user_status'] == 1)
			{
				$_SESSION['user_id'] = $obj->records[0]['user_id'];
				$_SESSION['username'] = $obj->records[0]['user_name'];
				return "1";
			}
			else if($obj->records[0]['user_status'] == 0)
			{
				$_SESSION['user_id'] = $obj->records[0]['user_id'];
				$_SESSION['username'] = $obj->records[0]['user_name'];
				return "0";
			}
			else if($obj->records[0]['user_status'] == 2)
				return "Your are Suspended by Admin";
		}
		else
		{
			return "Invalid Username and Password";
		}
	}
	
	
	/**
	 * Function generates a turing code in the image format
	 * @param string $red
	 * @param string $green
	 * @param string $blue
	 * @param string $fontred
	 * @param string $fontgreen
	 * @param string $fontblue
	 * @param integer $widthfull
	 * @param integer $heightfull
	 * 
	 * @return string
	 */

	function turingcode($red,$green,$blue,$fontred,$fontgreen,$fontblue,$widthfull,$heightfull)
	{
		$width = $widthfull;
		$height = $heightfull;
		$font_size = $height * 0.75;
		$characters = 6;
		$possible = '23456789abcdefghjkmnpqrstuvwxyzABCDEFGHJKMNPQRSTUVWXYZ';
		$code = '';
		$i = 0;
		while ($i < $characters) { 
			$code .= substr($possible, mt_rand(0, strlen($possible)-1), 1);
			$i++;
		}
		$turing = $code;
		//$_SESSION['turing'] = $turing;
		$image = @imagecreate($width, $height) or die('Cannot initialize new GD image stream');

		/* set the colours */
		$background_color = imagecolorallocate($image, $red, $green, $blue);
		$text_color = imagecolorallocate($image, $fontred, $fontgreen, $fontblue);
		$noise_color = imagecolorallocate($image, 200, 220, 180);

		/* generate random dots in background */
		for( $i=0; $i<($width*$height)/3; $i++ ) {
			imagefilledellipse($image, mt_rand(0,$width), mt_rand(0,$height), 1, 1, $noise_color);
		}
	
		for( $i=0; $i<($width*$height)/150; $i++ ) {
			imageline($image, mt_rand(0,$width), mt_rand(0,$height), mt_rand(0,$width), mt_rand(0,$height), $noise_color);
		}
		$textbox = imagettfbbox($font_size, 0, "fonts/monofont.ttf", $code) or die('Error in imagettfbbox function');
		$x = ($width - $textbox[4])/2;
		$y = ($height - $textbox[5])/2;
		imagettftext($image, $font_size, 0, $x, $y, $text_color, "fonts/monofont.ttf" , $code) or die('Error in imagettftext function');
		imagejpeg($image,"images/loginturing.jpg");
		imagedestroy($image);
		return $code;
	}
}
?>