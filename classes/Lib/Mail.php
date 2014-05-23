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
 * mailing process related  class
 *
 * @package   		Lib_Mail
 * @category    	Library
 * @author    		AJ Square Inc Dev Team
 * @link   		http://www.zeuscart.com
 * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */

class Lib_Mail
{
	/**
	 * list of To addresses
	 *
	 * @var array  
	 */	
	var $sendto = array();

	/**
	 * store the output
	 *
	 * @var array 
	 */	
	var $acc = array();

	/**
	 * store the output
	 *
	 * @var array 
	 */	
	var $abcc = array();

	/**
	 * paths of attached files
	 *
	 * @var array 
	 */	
	var $aattach = array();

	/**
	 * list of message headers
	 *
	 * @var array  
	 */	
	var $xheaders = array();

	/**
	 * message priorities referential
	 *
	 * @var array  
	 */	
	var $priorities = array( '1 (Highest)', '2 (High)', '3 (Normal)', '4 (Low)', '5 (Lowest)' );
	
	/**
	 * character set of message
	 *
	 * @var string 
	 */	
	var $charset = "us-ascii";

	/**
	 * character set of code
	 *
	 * @var string  
	 */	
	var $ctencoding = "7bit";

	/**
	 * Assign the variable receipt as zero 
	 *
	 * @var integer 
	 */	
	var $receipt = 0;
	

	/**
	 * Function is used to check  mail related  process
	 *
	 * @return void 
	 */	 
	function Lib_Mail()
	{
		$this->autoCheck( true );
		$this->boundary= "--" . md5( uniqid("myboundary") );
	}

	/**
	* Function is used to check  activate or desactivate the email addresses validator
	* 
	* @param boolean	$bool 
	*
	* @return void 
	*/	
	function autoCheck( $bool )
	{
		if( $bool )
			$this->checkAddress = true;
		else
			$this->checkAddress = false;
	}


	/**
	* Function is used to Define the subject line of the email
	* 
	* @param string $subject 
	*
	* @return void 
	*/	 

	function Subject( $subject )
	{
		$this->xheaders['Subject'] = strtr( $subject, "\r\n" , "  " );
	}
	/**
	* Function is used to set the sender of the mail
	* 
	* @param string $from
	*
	*/	 
	function From( $from )
	{

		if( ! is_string($from) ) {
			echo "Class Mail: error, From is not a string";
			exit;
		}
		$this->xheaders['From'] = $from;
	}
	/**
	* Function is used to set the Reply-to header
	* 
	* @param string $address
	*/	
	function ReplyTo( $address )
	{

		if( ! is_string($address) ) 
			return false;
		
		$this->xheaders["Reply-To"] = $address;
			
	}


	/**
	* Function to add a receipt to the mail ie.  a confirmation is returned to the "From" address or "ReplyTo"  *  if defined   when the receiver opens the message.
	*
	*/	
	function Receipt()
	{
		$this->receipt = 1;
	}
	/**
	* Function is used to set the mail recipient
	* 
	* @param string $to
	*
	*
	*/	

	function To( $to )
	{

		
		if( is_array( $to ) )
			$this->sendto= $to;
		else 
			$this->sendto[] = $to;

		if( $this->checkAddress == true )
			$this->CheckAdresses( $this->sendto );

	}
	/**
	* Function to set the CC headers
	* 
	* @param array $cc
	*
	*
	*/	

	function Cc( $cc )
	{
		if( is_array($cc) )
			$this->acc= $cc;
		else 
			$this->acc[]= $cc;
			
		if( $this->checkAddress == true )
			$this->CheckAdresses( $this->acc );
		
	}
	/**
	* Function to set the Bcc headers
	* 
	* @param array $bcc
	*
	*
	*/	

	function Bcc( $bcc )
	{
		if( is_array($bcc) ) {
			$this->abcc = $bcc;
		} else {
			$this->abcc[]= $bcc;
		}

		if( $this->checkAddress == true )
			$this->CheckAdresses( $this->abcc );
	}
	/**
	* Function to set the body
	* 
	* @param string $body
	* @param string $charset
	*
	*/	
	function Body( $body, $charset="" )
	{
		$this->body = $body;
		
		if( $charset != "" ) {
			$this->charset = strtolower($charset);
			if( $this->charset != "us-ascii" )
				$this->ctencoding = "8bit";
		}
	}

	/**
	* Function to set the Organization
	* 
	* @param string $org
	*
	*/
 
	function Organization( $org )
	{
		if( trim( $org != "" )  )
			$this->xheaders['Organization'] = $org;
	}

	/**
	* Function to set the Priority
	* 
	* @param integer $priority
	*
	* @return bool
	*/	
	function Priority( $priority )
	{
		if( ! intval( $priority ) )
			return false;
			
		if( ! isset( $this->priorities[$priority-1]) )
			return false;
	
		$this->xheaders["X-Priority"] = $this->priorities[$priority-1];
		
		return true;
		
	}
	/**
	* Function to set Attach a file to the mail
	* 
	* @param string $filename
	* @param string $filetype
	* @param string $disposition
	*
	*/	
	function Attach( $filename, $filetype = "", $disposition = "inline" )
	{
		
		if( $filetype == "" )
			$filetype = "application/x-unknown-content-type";
			
		$this->aattach[] = $filename;
		$this->actype[] = $filetype;
		$this->adispo[] = $disposition;
	}
	/**
	* Function to Build the email message
	*
	*/	
	function BuildMail()
	{
	
		// build the headers
		$this->headers = "";
		//	$this->xheaders['To'] = implode( ", ", $this->sendto );
		
		if( count($this->acc) > 0 )
			$this->xheaders['CC'] = implode( ", ", $this->acc );
		
		if( count($this->abcc) > 0 ) 
			$this->xheaders['BCC'] = implode( ", ", $this->abcc );
		
	
		if( $this->receipt ) {
			if( isset($this->xheaders["Reply-To"] ) )
				$this->xheaders["Disposition-Notification-To"] = $this->xheaders["Reply-To"];
			else 
				$this->xheaders["Disposition-Notification-To"] = $this->xheaders['From'];
		}
		
		if( $this->charset != "" ) {
			$this->xheaders["Mime-Version"] = "1.0";
			$this->xheaders["Content-Type"] = "text/html; charset=$this->charset";
			$this->xheaders["Content-Transfer-Encoding"] = $this->ctencoding;
		}
	
		$this->xheaders["X-Mailer"] = "Php/libMailv1.3";
		
		// include attached files
		if( count( $this->aattach ) > 0 ) {
			$this->_build_attachement();
		} else {
			$this->fullBody = $this->body;
		}
	
		reset($this->xheaders);
		while( list( $hdr,$value ) = each( $this->xheaders )  ) {
			if( $hdr != "Subject" )
				$this->headers .= "$hdr: $value\n";
		}
		
	
	}
	/**
	* Function to send the mail
	*
	*/	
	function Send()
	{
		$this->BuildMail();
		
		$this->strTo = implode( ", ", $this->sendto );
		
		// envoie du mail
		$res = @mail( $this->strTo, $this->xheaders['Subject'], $this->fullBody, $this->headers);
		
	}
	/**
	* Function can be used for displaying the message in plain text or logging it
	*
	* @return  string
	*/	
	function Get()
	{
		$this->BuildMail();
		$mail = "To: " . $this->strTo . "\n";
		$mail .= $this->headers . "\n";
		$mail .= $this->fullBody;
		return $mail;
	}
	
	/**
	* Function can be used to check an email address validity
	* @param string $address
	* @return  bool
	*/	
	
	function ValidEmail($address)
	{
		if( ereg( ".*<(.+)>", $address, $regs ) ) {
			$address = $regs[1];
		}
		if(ereg( "^[^@  ]+@([a-zA-Z0-9\-]+\.)+([a-zA-Z0-9\-]{2}|net|com|gov|mil|org|edu|int)\$",$address) ) 
			return true;
		else
			return false;
	}
	
	/**
	* Function can be used to check an email address validity
	* @param array $aad
	* @return  string
	*/	
	function CheckAdresses($aad)
	{
		for($i=0;$i< count( $aad); $i++ ) {
			if( ! $this->ValidEmail( $aad[$i]) ) {
				echo "Class Mail, method Mail : invalid address $aad[$i]";	
				exit;
			}
		}
	}
	/**
	* Function can be used to  check and encode attach files . internal use only
	*
	*/	
	function _build_attachement()
	{
	
		$this->xheaders["Content-Type"] = "multipart/mixed;\n boundary=\"$this->boundary\"";
	
		$this->fullBody = "This is a multi-part message in MIME format.\n--$this->boundary\n";
		$this->fullBody .= "Content-Type: text/html; charset=$this->charset\nContent-Transfer-Encoding: $this->ctencoding\n\n" . $this->body ."\n";
		
		$sep= chr(13) . chr(10);
		
		$ata= array();
		$k=0;
		
		// for each attached file, do...
		for( $i=0; $i < count( $this->aattach); $i++ ) {
			
			$filename = $this->aattach[$i];
			$basename = basename($filename);
			$ctype = $this->actype[$i];	// content-type
			$disposition = $this->adispo[$i];
			
			if( ! file_exists( $filename) ) {
				echo "Class Mail, method attach : file $filename can't be found"; exit;
			}
			$subhdr= "--$this->boundary\nContent-type: $ctype;\n name=\"$basename\"\nContent-Transfer-Encoding: base64\nContent-Disposition: $disposition;\n  filename=\"$basename\"\n";
			$ata[$k++] = $subhdr;
			// non encoded line length
			$linesz= filesize( $filename)+1;
			$fp= fopen( $filename, 'r' );
			$ata[$k++] = chunk_split(base64_encode(fread( $fp, $linesz)));
			fclose($fp);
		}
		$this->fullBody .= implode($sep, $ata);
	}


} 


?>
