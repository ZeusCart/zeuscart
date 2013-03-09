<?php
class Lib_FileOperations
 {
 	function uploadFile($spath,$dpath)
		{
			//echo 'path:' .$dpath;
			$temp=explode('/',$dpath);
			//print_r($temp[2]);
			if($temp[2]!='')
			{
			if (file_exists($dpath))
      		return  '<div class="error_msgbox">Sorry File Name Already exists</div>';
			//echo '<br>'. $dpath ."<b> already exists.</b><br />";
    		else
	      	return move_uploaded_file($spath,$dpath);
			}
		}
 }