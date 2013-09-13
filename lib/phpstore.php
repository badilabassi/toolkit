<?php

namespace Kirby\Toolkit;

// direct access protection
if(!defined('KIRBY')) die('Direct access is not allowed');

/**
 * PHPStore
 * 
 * Converts arrays of data to valid PHP
 * and stores it in a php file, which can be
 * read by this class as well.
 * 
 * @package   Kirby Toolkit 
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      http://getkirby.com
 * @copyright Bastian Allgeier
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */
class PHPStore {

  /**
   * Converts a multi-dimensional array to a string
   * 
   * @param array $array
   * @param string $valueTab
   * @param string $endTag
   * @param string $endDelim
   * @return string
   */
  static public function arrayToString($array, $valueTab = '  ', $endTab = '', $endDelim = ';') {

    $tab  = '  ';
    $text = array();
    $text[] = "array(";    
    foreach($array as $key => $value) {
      
      switch(gettype($value)) {
        case 'array':
          $text[] = $valueTab . "'" . $key . "' => " . static::arrayToString($value, $valueTab . '  ', $endTab . '  ', ',');
          break;
        case 'object':
          $text[] = $valueTab . "'" . $key . "' => '" . serialize($value) . "',";
          break;
        case 'integer':
        case 'float':
        case 'double':
          $text[] = $valueTab . "'" . $key . "' => " . $value . ",";          
          break;
        case 'boolean':
          $text[] = $valueTab . "'" . $key . "' => " . r($value, 'true', 'false') . ",";          
          break;
        default:
          $text[] = $valueTab . "'" . $key . "' => '" . $value . "',";
          break;
      }

      if(is_array($value)) {
      } else {
      }
    }
    $text[] = $endTab . ")" . $endDelim;

    return implode(PHP_EOL, $text);

  }

  /**
   * Takes a multi-dimensional array and writes
   * it to the passed PHP file after converting it to 
   * PHP syntax.
   * 
   * @param string $file
   * @param array $data
   * @return boolean
   */
  static public function write($file, $data) {

    $content = array();
    $content[] = '<?php';
    $content[] = '';
    $content[] = 'return ' . static::arrayToString($data);
    $content = implode(PHP_EOL, $content);

    return f::write($file, $content);

  }

  /**
   * Reads a PHP file returning a multi-dimensional array
   * and returns that.
   * 
   * @param string $file
   * @return mixed array or false
   */
  static public function read($file) {
    return file_exists($file) ? require($file) : false;
  }

}