<?php
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