<?php
/**
* GNU General Public License.

* This file is part of ZeusCart V2.3.

* ZeusCart V2.3 is free software: you can redistribute it and/or modify
* it under the terms of the GNU General Public License as published by
* the Free Software Foundation, either version 3 of the License, or
* (at your option) any later version.
* 
* ZeusCart V2.3 is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
* GNU General Public License for more details.
* 
* You should have received a copy of the GNU General Public License
* along with Foobar. If not, see <http://www.gnu.org/licenses/>.
*
*/
class Lib_ImageFunctions
{
	function reduceImage($fname,$newwidth,$newheight,$thumbpath)
	{
		$imagename1 = explode(".",$fname);
		$l = count($imagename1);
		$l = $l-1;

		$save=$thumbpath;
	
		list($width, $height) = getimagesize($fname) ; 
	
		$diff = $width / $newwidth;
		
		$tn = imagecreatetruecolor($newwidth, $newheight) ; 
		
		switch($imagename1[$l])
		{
			case "jpeg" :imagecreatefromjpeg($fname) ; 
				imagecopyresampled($tn, $image, 0, 0, 0, 0, $newwidth, $newheight, $width, $height) ; 
				$uploadfile1_3 = substr($save,3,strlen($save));
				imagejpeg($tn, $save, 100) ;
				break;
			case "jpg" :
				$image = imagecreatefromjpeg($fname) ; 
				imagecopyresampled($tn, $image, 0, 0, 0, 0, $newwidth, $newheight, $width, $height) ; 
				$uploadfile1_3 = substr($save,3,strlen($save));
				imagejpeg($tn, $save, 100) ;
				break;
			case "png":
				$image = imagecreatefrompng($fname) ; 
				imagecopyresampled($tn, $image, 0, 0, 0, 0, $newwidth, $newheight, $width, $height) ; 
				$uploadfile1_3 = substr($save,3,strlen($save));				
				imagepng($tn, $save ) ; 
				break;
			case "gif":
				$image = imagecreatefromgif($fname) ; 
				imagecopyresampled($tn, $image, 0, 0, 0, 0, $newwidth, $newheight, $width, $height) ; 
				$uploadfile1_3 = substr($save,3,strlen($save));				
				imagegif($tn, $save) ; 				
				break;
			default:
				$save=false;
		}
		
		return $save;
	}
}
?>