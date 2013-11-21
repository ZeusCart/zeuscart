<?php
/*******************************************************************************
*                Authorize.net AIM Interface Class
*******************************************************************************
*      Author:     Micah Carrick
*      Email:      email@micahcarrick.com
*      Website:    http://www.micahcarrick.com/v2/content/view/2/3/
*
*      File:       authorizenet.class.php
*      Version:    1.00
*      Copyright:  (c) 2005 - Micah Carrick
*                  You are free to use, distribute, and modify this software
*                  under the terms of the GNU General Public License.  See the
*                  included license.txt file.
*     
*******************************************************************************
*  REQUIREMENTS:
*      - PHP4+ with CURL and SSL support
*      - An Authorize.net AIM merchant account
*      - (optionally) http://www.authorize.net/support/AIM_guide.pdf
* 
*******************************************************************************
*  VERION HISTORY:
* 
*      v1.00 [04.07.2005] - Initial Version
*
*******************************************************************************
*  DESCRIPTION:
*
*      This class was developed to simplify interfacing a PHP script to the
*      authorize.net AIM payment gateway.  It does not do all the work for
*      you as some of the other scripts out there do.  It simply provides
*      an easy way to implement and debug your own script. 
*
*******************************************************************************
*/

class authorizenet_class {

// echo "fasdfa";exit;
   var $field_string;
   var $fields = array();
   
   var $response_string;
   var $response = array();
   var $gateway_url = "https://test.authorize.net";
   function add_field($field, $value) {


      // adds a field/value pair to the list of fields which is going to be
      // passed to authorize.net.  For example: "x_version=3.1" would be one
      // field/value pair.  A list of the required and optional fields to pass
      // to the authorize.net payment gateway are listed in the AIM document
      // available in PDF form from www.authorize.net
     
      $this->fields["$field"] = urlencode($value);   

   }

   function process() {
       

      // This function actually processes the payment.  This function will
      // load the $response array with all the returned information.  The return
      // values for the function are:
      // 1 - Approved
      // 2 - Declined
      // 3 - Error

      // construct the fields string to pass to authorize.net
      foreach( $this->fields as $key => $value )
         $this->field_string .= "$key=" . urlencode( $value ) . "&";
      // execute the HTTPS post via CURL
      $ch = curl_init($this->gateway_url);
      curl_setopt($ch, CURLOPT_HEADER, 0);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($ch, CURLOPT_POSTFIELDS, rtrim( $this->field_string, "& " ));
      $this->response_string = urldecode(curl_exec($ch));
//  print_r( $this->response_string);exit;
      if (curl_errno($ch)) {
         $this->response['Response Reason Text'] = curl_error($ch);
         return 3;
      }
      else curl_close ($ch);
      // load a temporary array with the values returned from authorize.net
      $temp_values = explode('|', $this->response_string);
      // load a temporary array with the keys corresponding to the values
      // returned from authorize.net (taken from AIM documentation)
      $temp_keys= array (
           "Response Code", "Response Subcode", "Response Reason Code", "Response Reason Text",
           "Approval Code", "AVS Result Code", "Transaction ID", "Invoice Number", "Description",
           "Amount", "Method", "Transaction Type", "Customer ID", "Cardholder First Name",
           "Cardholder Last Name", "Company", "Billing Address", "City", "State",
           "Zip", "Country", "Phone", "Fax", "Email", "Ship to First Name", "Ship to Last Name",
           "Ship to Company", "Ship to Address", "Ship to City", "Ship to State",
           "Ship to Zip", "Ship to Country", "Tax Amount", "Duty Amount", "Freight Amount",
           "Tax Exempt Flag", "PO Number", "MD5 Hash", "Card Code (CVV2/CVC2/CID) Response Code",
           "Cardholder Authentication Verification Value (CAVV) Response Code"
      );

      // add additional keys for reserved fields and merchant defined fields
      for ($i=0; $i<=27; $i++) {
         array_push($temp_keys, 'Reserved Field '.$i);
      }
      $i=0;
      while (sizeof($temp_keys) < sizeof($temp_values)) {
         array_push($temp_keys, 'Merchant Defined Field '.$i);
         $i++;
      }

      // combine the keys and values arrays into the $response array.  This
      // can be done with the array_combine() function instead if you are using
      // php 5.
      for ($i=0; $i<sizeof($temp_values);$i++) {
         $this->response['$temp_keys[$i]'] = $temp_values[$i];
      }

      // Return the response code.
      return $this->response['Response Code'];

   }
   
   function get_response_reason_text() {
      return $this->response['Response Reason Text'];
   }

   function dump_fields() {

      // Used for debugging, this function will output all the field/value pairs
      // that are currently defined in the instance of the class using the
      // add_field() function.
     
      echo "<h3>authorizenet_class->dump_fields() Output:</h3>";
      echo "<table width=\"95%\" border=\"1\" cellpadding=\"2\" cellspacing=\"0\">
            <tr>
               <td bgcolor=\"black\"><b><font color=\"white\">Field Name</font></b></td>
               <td bgcolor=\"black\"><b><font color=\"white\">Value</font></b></td>
            </tr>";
           
      foreach ($this->fields as $key => $value) {
         echo "<tr><td>$key</td><td>".urldecode($value)." </td></tr>";
      }

      echo "</table><br>";
   }

   function dump_response() {

      // Used for debuggin, this function will output all the response field
      // names and the values returned for the payment submission.  This should
      // be called AFTER the process() function has been called to view details
      // about authorize.net's response.
     
/*      echo "<h3>authorizenet_class->dump_response() Output:</h3>";
      echo "<table width=\"95%\" border=\"1\" cellpadding=\"2\" cellspacing=\"0\">
            <tr>
               <td bgcolor=\"black\"><b><font color=\"white\">Index </font></b></td>
               <td bgcolor=\"black\"><b><font color=\"white\">Field Name</font></b></td>
               <td bgcolor=\"black\"><b><font color=\"white\">Value</font></b></td>
            </tr>";*/
           
      $i = 0;
      foreach ($this->response as $key => $value) {
	  $arr[$key] = $value;
/*         echo "<tr>
                  <td valign=\"top\" align=\"center\">$i</td>
                  <td valign=\"top\">$key</td>
                  <td valign=\"top\">$value </td>
               </tr>";*/
         $i++;
      }
/*      echo "</table><br>";*/
		return $arr;
   }   
}
?>