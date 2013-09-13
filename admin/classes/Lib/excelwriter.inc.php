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
 * This class contains functions related to excel writer process
 *
 * @package  		Lib
 * @link   		http://www.zeuscart.com
 * @version  		Version 4.0
 * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */

	Class ExcelWriter
	{
		/**
		* Assign the  variable fp in null
		*
		* @var integer
		*/	
		var $fp=null;
		/**
		* Stores the  error output 
		*
		* @var string
		*/
		var $error;
		/**
		* Assign the status of the files closed
		*
		* @var string
		*/
		var $state="CLOSED";
		/**
		* Assign the new row of the file
		*
		* @var bool
		*/
		var $newRow=false;

		/**
		* Function is used to excel writer related process
		*
		* @param string $file
		* @return bool
		*/
		function ExcelWriter($file="")
		{
			
			return $this->open($file);
		}
		/**
		* Function is used to open the excel file
		*
		* @param string $file
		* @return bool
		*/
		function open($file)
		{
			if($this->state!="CLOSED")
			{
				$this->error="Error : Another file is opend.Close it to save the file";
				return false;
			}	
			
			if(!empty($file))
			{
				$this->fp=@fopen($file,"w+");
			}
			else
			{
				$this->error="Usage : New ExcelWriter('fileName')";
				return false;
			}	
			if($this->fp==false)
			{
				$this->error="Error: Unable to open/create File.You may not have permmsion to write the file.";
				return false;
			}
			$this->state="OPENED";
			fwrite($this->fp,$this->GetHeader());
			return $this->fp;
		}
		/**
		* Function is used to close the open of Excel file
		*/
		function close()
		{
			if($this->state!="OPENED")
			{
				$this->error="Error : Please open the file.";
				return false;
			}	
			if($this->newRow)
			{
				fwrite($this->fp,"</tr>");
				$this->newRow=false;
			}
			
			fwrite($this->fp,$this->GetFooter());
			fclose($this->fp);
			$this->state="CLOSED";
			return ;
		}
		/**
		* Function is used to write the header of Excel file
		*/							
		function GetHeader()
		{
			$header = <<<EOH
				<html xmlns:o="urn:schemas-microsoft-com:office:office"
				xmlns:x="urn:schemas-microsoft-com:office:excel"
				xmlns="http://www.w3.org/TR/REC-html40">

				<head>
				<meta http-equiv=Content-Type content="text/html; charset=us-ascii">
				<meta name=ProgId content=Excel.Sheet>
				<!--[if gte mso 9]><xml>
				<o:DocumentProperties>
				<o:LastAuthor>HitSpot</o:LastAuthor>
				<o:LastSaved>2005-01-02T07:46:23Z</o:LastSaved>
				<o:Version>10.2625</o:Version>
				</o:DocumentProperties>
				<o:OfficeDocumentSettings>
				<o:DownloadComponents/>
				</o:OfficeDocumentSettings>
				</xml><![endif]-->
				<style>
				<!--table
					{mso-displayed-decimal-separator:"\.";
					mso-displayed-thousand-separator:"\,";}
				@page
					{margin:1.0in .75in 1.0in .75in;
					mso-header-margin:.5in;
					mso-footer-margin:.5in;}
				tr
					{mso-height-source:auto;}
				col
					{mso-width-source:auto;}
				br
					{mso-data-placement:same-cell;}
				.style0
					{mso-number-format:General;
					text-align:general;
					vertical-align:bottom;
					white-space:nowrap;
					mso-rotate:0;
					mso-background-source:auto;
					mso-pattern:auto;
					color:windowtext;
					font-size:10.0pt;
					font-weight:400;
					font-style:normal;
					text-decoration:none;
					font-family:Arial;
					mso-generic-font-family:auto;
					mso-font-charset:0;
					border:none;
					mso-protection:locked visible;
					mso-style-name:Normal;
					mso-style-id:0;}
				td
					{mso-style-parent:style0;
					padding-top:1px;
					padding-right:1px;
					padding-left:1px;
					mso-ignore:padding;
					color:windowtext;
					font-size:10.0pt;
					font-weight:400;
					font-style:normal;
					text-decoration:none;
					font-family:Arial;
					mso-generic-font-family:auto;
					mso-font-charset:0;
					mso-number-format:General;
					text-align:general;
					vertical-align:bottom;
					border:none;
					mso-background-source:auto;
					mso-pattern:auto;
					mso-protection:locked visible;
					white-space:nowrap;
					mso-rotate:0;}
				.xl24
					{mso-style-parent:style0;
					white-space:normal;}
				-->
				</style>
				<!--[if gte mso 9]><xml>
				<x:ExcelWorkbook>
				<x:ExcelWorksheets>
				<x:ExcelWorksheet>
					<x:Name>srirmam</x:Name>
					<x:WorksheetOptions>
					<x:Selected/>
					<x:ProtectContents>False</x:ProtectContents>
					<x:ProtectObjects>False</x:ProtectObjects>
					<x:ProtectScenarios>False</x:ProtectScenarios>
					</x:WorksheetOptions>
				</x:ExcelWorksheet>
				</x:ExcelWorksheets>
				<x:WindowHeight>10005</x:WindowHeight>
				<x:WindowWidth>10005</x:WindowWidth>
				<x:WindowTopX>120</x:WindowTopX>
				<x:WindowTopY>135</x:WindowTopY>
				<x:ProtectStructure>False</x:ProtectStructure>
				<x:ProtectWindows>False</x:ProtectWindows>
				</x:ExcelWorkbook>
				</xml><![endif]-->
				</head>

				<body link=blue vlink=purple>
				<table x:str border=0 cellpadding=0 cellspacing=0 style='border-collapse: collapse;table-layout:fixed;'>
EOH;
			return $header;
		}
		/**
		* Function is used to get the footer of Excel file
		* @return string
		*/
		function GetFooter()
		{
			return "</table></body></html>";
		}
		
		
		/**
		* Function is used to get the footer of Excel file
		* @param array $line_arr
		* @return void
		*/
		function writeLine($line_arr)
		{
			if($this->state!="OPENED")
			{
				$this->error="Error : Please open the file.";
				return false;
			}	
			if(!is_array($line_arr))
			{
				$this->error="Error : Argument is not valid. Supply an valid Array.";
				return false;
			}
			fwrite($this->fp,"<tr>");
			foreach($line_arr as $col)
				fwrite($this->fp,"<td class=xl24 width=64 ><b>$col</b></td>");
			fwrite($this->fp,"</tr>");
		}
		/**
		* Function is used to get the footer of Excel file
		* @return void
		*/
		function writeRow()
		{
			if($this->state!="OPENED")
			{
				$this->error="Error : Please open the file.";
				return false;
			}	
			if($this->newRow==false)
				fwrite($this->fp,"<tr>");
			else
				fwrite($this->fp,"</tr><tr>");
			$this->newRow=true;	
		}
		/**
		* Function is used to get the footer of Excel file
		* @param intger $value
		* @return void
		*/
		function writeCol($value)
		{
			if($this->state!="OPENED")
			{
				$this->error="Error : Please open the file.";
				return false;
			}	
			fwrite($this->fp,"<td class=xl24 width=64 >$value</td>");
		}
	}
?>