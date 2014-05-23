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
// {{{ Constants

/**

 * Methods for common data validations

 */

	define('VALIDATE_NUM',          '0-9');
	define('VALIDATE_SPACE',        '\s');
	define('VALIDATE_ALPHA_LOWER',  'a-z');
	define('VALIDATE_ALPHA_UPPER',  'A-Z');
	define('VALIDATE_ALPHA',        VALIDATE_ALPHA_LOWER . VALIDATE_ALPHA_UPPER);
	define('VALIDATE_EALPHA_LOWER', VALIDATE_ALPHA_LOWER . '����������������������');
	define('VALIDATE_EALPHA_UPPER', VALIDATE_ALPHA_UPPER . '����������������������');
	define('VALIDATE_EALPHA',       VALIDATE_EALPHA_LOWER . VALIDATE_EALPHA_UPPER);
	define('VALIDATE_PUNCTUATION',  VALIDATE_SPACE . '\.,;\:&"\'\?\!\(\)');
	define('VALIDATE_NAME',         VALIDATE_EALPHA . VALIDATE_SPACE . "'");
	define('VALIDATE_STREET',       VALIDATE_NAME . "/\\��");


// }}}

/**
 * validation  related  class
 *
 * @package         Lib
 * @category        Library
 * @author          AJ Square Inc Dev Team
 * @link            http://www.zeuscart.com
 * @copyright       Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version         Version 4.0
 */



class Validate
{

	
    /**
     * Function is used to validate a number
     *
     * @param string    $number     Number to validate
     * @param array     $options    array where:
     *                              'decimal'   is the decimal char or false when decimal not allowed
     *                                          i.e. ',.' to allow both ',' and '.'
     *                              'dec_prec'  Number of allowed decimals
     *                              'min'       minimun value
     *                              'max'       maximum value
     * @return bool
     */
    function number($number, $options)
    {
        $decimal=$dec_prec=$min=$max= null;
        if(is_array($options)){
            extract($options);
        }

        $dec_prec   = $dec_prec ? "{1,$dec_prec}" : '+';
        $dec_regex  = $decimal  ? "[$decimal][0-9]$dec_prec" : '';

        if (!preg_match("|^[-+]?\s*[0-9]+($dec_regex)?\$|", $number)) {
            return false;
        }
        if ($decimal != '.') {
            $number = strtr($number, $decimal, '.');
        }
        $number = (float)str_replace(' ', '', $number);
        if ($min !== null && $min > $number) {
            return false;
        }
        if ($max !== null && $max < $number) {
            return false;
        }
        return true;
    }

    /**
     * Function is used tovalidate a email
     *
     * @param string    $email          URL to validate
     * @param boolean   $check_domain   Check or not if the domain exists
     * @return bool
     */
    function email($email, $check_domain = false)
    {
        if($check_domain){

        }

        if (ereg('^[-!#$%&\'*+\\./0-9=?A-Z^_`a-z{|}~]+'.'@'.
                 '[-!#$%&\'*+\\/0-9=?A-Z^_`a-z{|}~]+\.'.
                 '[-!#$%&\'*+\\./0-9=?A-Z^_`a-z{|}~]+$', $email))
        {
            if ($check_domain && function_exists('checkdnsrr')) {
                list (, $domain)  = explode('@', $email);
                if (checkdnsrr($domain, 'MX') || checkdnsrr($domain, 'A')) {
                    return true;
                }
                return false;
            }
            return true;
        }
        return false;
    }

    /**
     * Function is used to validate a string using the given format 'format'
     *
     * @param string    $string     String to validate
     * @param array     $options    Options array where:
     *                              'format' is the format of the string
     *                                  Ex: VALIDATE_NUM . VALIDATE_ALPHA (see constants)
     *                              'min_length' minimum length
     *                              'max_length' maximum length
     * @return bool
     */
    function string($string, $options)
    {
        $format = null;
        $min_length = $max_length = 0;
        if (is_array($options)){
            extract($options);
        }
        if ($format && !preg_match("|^[$format]*\$|s", $string)) {
            return false;
        }
        if ($min_length && strlen($string) < $min_length) {
            return false;
        }
        if ($max_length && strlen($string) > $max_length) {
            return false;
        }
        return true;
    }

    /**
     *  FUnction is used to validate a URL
     *
     * @param string    $url            URL to validate
     * @param boolean   $domain_check   Check or not if the domain exists
     * @return bool
     */
    function url($url, $domain_check = false)
    {
        $purl = parse_url($url);
        if (preg_match('|^http$|i', @$purl['scheme']) && !empty($purl['host'])) {
            if ($domain_check && function_exists('checkdnsrr')) {
                if (checkdnsrr($purl['host'], 'A')) {
                    return true;
                } else {
                    return false;
                }
            }
            return true;
        }
        return false;
    }

    /**
     * Validate a number according to Luhn check algorithm
     *
     * This function checks given number according Luhn check
     * algorithm. It is published on several places, also here:
     *
     *      http://www.webopedia.com/TERM/L/Luhn_formula.html
     *      http://www.merriampark.com/anatomycc.htm
     *      http://hysteria.sk/prielom/prielom-12.html#3 (Slovak language)
     *      http://www.speech.cs.cmu.edu/~sburke/pub/luhn_lib.html (Perl lib)
     *
     * @param  string  $creditCard 
     * @return bool    true if number is valid, otherwise false
     *
     */
    function creditCard($creditCard)
    {
        $creditCard = preg_replace('/[^0-9]/','',$creditCard);

        if (empty($creditCard) || ($len_number = strlen($creditCard)) <= 0) {
            return false;
        }
        $sum = 0;
        for ($k = $len_number % 2; $k < $len_number; $k += 2) {
            if ((intval($creditCard{$k}) * 2) > 9) {
                $sum += (intval($creditCard{$k}) * 2) - 9;
            } else {
                $sum += intval($creditCard{$k}) * 2;
            }
        }
        for ($k = ($len_number % 2) ^ 1; $k < $len_number; $k += 2) {
            $sum += intval($creditCard{$k});
        }
        return $sum % 10 ? false : true;
    }

    /**
     * Validate date and times. Note that this method need the Date_Calc class
     *
     * @param string    $date   Date to validate
     * @param array     $options array options where :
     *                          'format' The format of the date (%d-%m-%Y)
     *                          'min' The date has to be greater
     *                                than this array($day, $month, $year)
     *                          'max' The date has to be smaller than
     *                                this array($day, $month, $year)
     *
     * @return bool
     */
    function date($date, $options)
    {
        $max = $min = false;
        $format = '';
        if (is_array($options)){
            extract($options);
        }
        $date_len   = strlen($format);
        for ($i = 0; $i < strlen($format); $i++) {
            $c = $format{$i};
            if ($c == '%') {
                $next = $format{$i + 1};
                switch ($next) {
                    case 'j':
                    case 'd':
                        if ($next == 'j') {
                            $day = (int)Validate::_substr($date, 1, 2);
                        } else {
                            $day = (int)Validate::_substr($date, 2);
                        }
                        if ($day < 1 || $day > 31) {
                            return false;
                        }
                        break;
                    case 'm':
                    case 'n':
                        if ($next == 'm') {
                            $month = (int)Validate::_substr($date, 2);
                        } else {
                            $month = (int)Validate::_substr($date, 1, 2);
                        }
                        if ($month < 1 || $month > 12) {
                            return false;
                        }
                        break;
                    case 'Y':
                    case 'y':
                        if ($next == 'Y') {
                            $year = Validate::_substr($date, 4);
                            $year = (int)$year?$year:'';
                        } else {
                            $year = (int)(substr(date('Y'), 0, 2) .
                                          Validate::_substr($date, 2));
                        }
                        if (strlen($year) != 4 || $year < 0 || $year > 9999) {
                            return false;
                        }
                        break;
                    case 'g':
                    case 'h':
                        if ($next == 'g') {
                            $hour = Validate::_substr($date, 1, 2);
                        } else {
                            $hour = Validate::_substr($date, 2);
                        }
                        if ($hour < 0 || $hour > 12) {
                            return false;
                        }
                        break;
                    case 'G':
                    case 'H':
                        if ($next == 'G') {
                            $hour = Validate::_substr($date, 1, 2);
                        } else {
                            $hour = Validate::_substr($date, 2);
                        }
                        if ($hour < 0 || $hour > 24) {
                            return false;
                        }
                        break;
                    case 's':
                    case 'i':
                        $t = Validate::_substr($date, 2);
                        if ($t < 0 || $t > 59) {
                            return false;
                        }
                        break;
                    default:
                        trigger_error("Not supported char `$next' after % in offset " . ($i+2), E_USER_WARNING);
                }
                $i++;
            } else {
                //literal
                if (Validate::_substr($date, 1) != $c) {
                    return false;
                }
            }
        }
        // there is remaing data, we don't want it
        if (strlen($date)) {
            return false;
        }
        if (isset($day) && isset($month) && isset($year)) {
            if (!checkdate($month, $day, $year)) {
                return false;
            }
            if ($min || $max) {
                include_once 'Date/Calc.php';
                if ($min &&
                    (Date_Calc::compareDates($day, $month, $year,
                                             $min[0], $min[1], $min[2]) < 0))
                {
                    return false;
                }
                if ($max &&
                    (Date_Calc::compareDates($day, $month, $year,
                                             $max[0], $max[1], $max[2]) > 0))
                {
                    return false;
                }
            }
        }
        return true;
    }

    /**
     * Validate a ISBN number
     *
     * This function checks given number according
     *
     * @param  string  $isbn number (only numeric chars will be considered)
     * @return bool    true if number is valid, otherwise false
     * @author Damien Seguy <dams@nexen.net>
     */
    function isbn($isbn)
    {
        if (preg_match("/[^0-9 IXSBN-]/", $isbn)) {
            return false;
        }

        if (!ereg("^ISBN", $isbn)){
            return false;
        }

        $isbn = ereg_replace("-", "", $isbn);
        $isbn = ereg_replace(" ", "", $isbn);
        $isbn = eregi_replace("ISBN", "", $isbn);
        if (strlen($isbn) != 10) {
            return false;
        }
        if (preg_match("/[^0-9]{9}[^0-9X]/", $isbn)){
            return false;
        }

        $t = 0;
        for($i=0; $i< strlen($isbn)-1; $i++){
            $t += $isbn[$i]*(10-$i);
        }
        $f = $isbn[9];
        if ($f == "X") {
            $t += 10;
        } else {
            $t += $f;
        }
        if ($t % 11) {
            return false;
        } else {
            return true;
        }
    }
    /**
     * Function is used in sub string related process 
     * @param array   $date  
     * @param integer  $num
     * @param  bool $opt 
     * @return  array
     */
    function _substr(&$date, $num, $opt = false)
    {
        if ($opt && strlen($date) >= $opt && preg_match('/^[0-9]{'.$opt.'}/', $date, $m)) {
            $ret = $m[0];
        } else {
            $ret = substr($date, 0, $num);
        }
        $date = substr($date, strlen($ret));
        return $ret;
    }
     /**
     * Function is used in chage the value of the variable if function exists related process 
     * @param integer   $val  
     * @param integer  $div
     * @return  integer
     */
    function _modf($val, $div) {
        if( function_exists('bcmod') ){
            return bcmod($val,$div);
        } else if (function_exists('fmod')) {
            return fmod($val,$div);
        }
        $r = $a / $b;
        $i = intval($r);
        return intval(($r - $i) * $b);
    }

    /**
    * Bulk data validation for data introduced in the form of an
    * assoc array in the form $var_name => $value.
    *
    * @param  array   $data     Ex: array('name'=>'toto','email'='toto@thing.info');
    * @param  array   $val_type Contains the validation type and all parameters used in.
    *                           'val_type' is not optional
    *                           others validations properties must have the same name as the function
    *                           parameters.
    *                           Ex: array('toto'=>array('type'=>'string','format'='toto@thing.info','min_length'=>5));
    * @param  boolean $remove if set, the elements not listed in data will be removed
    *
    * @return array   value name => true|false    the value name comes from the data key
    */
    function multiple(&$data, &$val_type, $remove = false)
    {
        $keys = array_keys($data);
        foreach ($keys as $var_name) {
            if (!isset($val_type[$var_name])) {
                if ($remove) {
                    unset($data[$var_name]);
                }
                continue;
            }
            $opt = $val_type[$var_name];
            $methods = get_class_methods('Validate');
            $val2check = $data[$var_name];
            // core validation method
            if (in_array(strtolower($opt['type']), $methods)) {
                //$opt[$opt['type']] = $data[$var_name];
                $method = $opt['type'];
                $opt = array_slice($opt,1);

                if (sizeof($opt) == 1){
                    $opt = array_pop($opt);
                }
                $valid[$var_name] = call_user_func(array('Validate', $method), $val2check,$opt);

            /**
             * external validation method in the form:
             * "<class name><underscore><method name>"
             * Ex: us_ssn will include class Validate/US.php and call method ssn()
             */
            } elseif (strpos($opt['type'],'_') !== false) {
                list($class, $method) = explode('_', $opt['type'], 2);
                $class = strtoupper($class);
                @include_once("Validate/$class.php");
                if (!class_exists("Validate_$class") ||
                    !in_array($method, get_class_methods("Validate_$class"))) {
                    trigger_error("Invalid validation type Validate_$class::$method", E_USER_WARNING);
                    continue;
                }
                $valid[$var_name] = call_user_func(array("Validate_$class", $method), $data[$var_name]);
            } else {
                trigger_error("Invalid validation type {$opt['type']}", E_USER_WARNING);
            }
        }
        return $valid;
    }
}
?>
