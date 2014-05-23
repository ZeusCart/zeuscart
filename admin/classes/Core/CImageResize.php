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
 * This class contains functions to resize the uploading images.
 *
 * @package  		Core_CImageResize
 * @category  		Core
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
   * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */



class Core_CImageResize
{
		//$path1= "upload/".$HTTP_POST_FILES['ufile']['name'][0];
		//$path2= "upload/".$HTTP_POST_FILES['ufile']['name'][1];
		
	/**
	 * Function generates a image file for the required size.
	 * @param integer $size
	 * 
	 * @return image
	 */	
		
	function thumbImage($size)
	{
		$uploadedfile = $_FILES['ufile']['tmp_name'][0];
		$src = imagecreatefromjpeg($uploadedfile);
		list($width,$height)=getimagesize($uploadedfile);
		$newwidth=$size;
		$newheight=($height/$width)*$size;
		$tmp=imagecreatetruecolor($newwidth,$newheight);
		imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,$width,$height);
		$filename = "". $_FILES['uploadfile']['name'];
		imagejpeg($tmp,$filename,$size);
		imagedestroy($src);
		imagedestroy($tmp); 	
	}//end of Function thumbImage

	
	/**
	 * Function generates a image file for the required size.
	 * 
	 * 
	 * @return image
	 */	

	function imageResizer()
	{
		$uploadedfile = $_FILES['ufile']['tmp_name'][0];
		$src = imagecreatefromjpeg($uploadedfile);
		list($width,$height)=getimagesize($uploadedfile);
		$newwidth=600;
		$newheight=($height/$width)*600;
		$tmp=imagecreatetruecolor($newwidth,$newheight);
		imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,$width,$height);
		// resized, uploaded image file to reside in the ./images subdirectory.
		$filename = "". $_FILES['uploadfile']['name'];
		imagejpeg($tmp,$filename,100);
		imagedestroy($src);
		imagedestroy($tmp); 
	}//end of Function Image Resizer
	
	
	/**
	 * Function checks whether the image exists in the specified type before resize.
	 * 
	 * 
	 * @return bool
	 */	
	
	function imageCheckType()
	{
		if ((($_FILES["file"]["type"] == "image/gif")|| ($_FILES["file"]["type"] == "image/jpeg")|| ($_FILES["file"]["type"] == "image/pjpeg")) && ($_FILES["file"]["size"] < 20000))
  		{
  			if ($_FILES["file"]["error"] > 0)
    		{
	    		return 0;
    		}
	    	else
    	   {
			    return 1;
    		}
  		}
	  else
  	    {
			return 0;
  		}
	}//end of function imageCheckType
	
	
}
?>