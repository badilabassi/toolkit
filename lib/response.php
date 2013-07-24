<?php

namespace Kirby\Toolkit;

// direct access protection
if(!defined('KIRBY')) die('Direct access is not allowed');

/**
 * Response
 * 
 * Represents any response coming from a controller's action and takes care of sending an appropriate header
 *  
 * @package   Kirby App
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      http://getkirby.com
 * @copyright Bastian Allgeier
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */
class Response {

  // the response content
  protected $content;
  
  // the format type
  protected $format;

  /**
   * Constructor
   *
   * @param string $content
   * @param string $format
   */
  public function __construct($content, $format) {

    $this->content = $content;
    $this->format  = strtolower($format);

    // convert arrays to json
    if(is_array($this->content) and $this->format == 'json') {
      $this->content = json_encode($this->content);
    }

  }

  /**
   * Sends the correct header for the response
   */
  public function header($send = true) {
    return content::type($this->format, 'utf-8', $send);
  }

  /**
   * Returns the content of this response
   * 
   * @return string
   */
  public function content() {
    return $this->content;
  }

  /**
   * Returns the content format
   * 
   * @return string
   */
  public function format() {
    return $this->format;
  }

  /**
   * Returns a success response 
   *
   * @param string $message
   * @param mixed $data
   * @param mixed $code 
   * @return object
   */
  static public function success($message = 'Everything went fine', $data = array(), $code = 200) {
    return new static(array(
      'status'  => 'success',
      'code'    => $code,
      'message' => $message, 
      'data'    => $data
    ), 'json');
  }

  /**
   * Returns an error response   
   * 
   * @param mixed $message Either a message string or an error or errors object
   * @param mixed $code 
   * @param mixed $data
   * @return object
   */
  static public function error($message = 'Something went wrong', $code = 400, $data = array()) {
  
    if(is_a($message, 'Kirby\\Toolkit\\Error') or is_a($message, 'Kirby\\Toolkit\\Exception')) {      
      $code    = $message->code();
      $data    = $message->data();
      $message = $message->message();
    } else if(is_a($message, '\\Exception')) {
      $code    = $message->getCode();
      $message = $message->getMessage();
      $data    = null;
    } else if(is_a($message, 'Kirby\\Toolkit\\Errors')) {
      return static::error($message->first());
    } 

    return new static(array(
      'status'  => 'error',
      'code'    => $code,
      'message' => $message, 
      'data'    => $data
    ), 'json');

  }

  /**
   * Converts an array to json and returns it properly
   * 
   * @param array $data
   * @return object
   */
  static public function json($data) {
    return new static($data, 'json');
  }

  /**
   * Echos the content
   * 
   * @return string
   */
  public function __toString() {
    return (string)$this->content;
  }

}