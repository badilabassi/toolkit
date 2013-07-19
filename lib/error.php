<?php

namespace Kirby\Toolkit;

// direct access protection
if(!defined('KIRBY')) die('Direct access is not allowed');

/**
 * Error
 * 
 * Creates a simple, reusable error object
 * 
 * @package   Kirby Toolkit 
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      http://getkirby.com
 * @copyright Bastian Allgeier
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */
class Error {

  public $key;
  public $message;
  public $code;
  public $data;

  /**
   * Static handler to create a new error object
   * 
   * @param string $key
   * @param string $message
   * @param mixed $data
   * @param int $code
   * @return object
   */
  static public function raise($key, $message, $data = null, $code = null) {
    return new static($key, $message, $data, $code);
  }

  /**
   * Constructor
   * 
   * @param string $key
   * @param string $message
   * @param mixed $data
   * @param int $code
   */
  public function __construct($key, $message, $data = null, $code = null) {
    $this->key     = $key;
    $this->message = $message;
    $this->data    = $data;
    $this->code    = $code;
  }

  /**
   * Returns the error key
   * 
   * @return string
   */
  public function key() {
    return $this->key;
  }

  /**
   * Returns the error message
   * 
   * @return string
   */
  public function message() {
    return $this->message;
  }

  /**
   * Returns optional data
   * 
   * @return array
   */
  public function data() {
    return $this->data;
  }

  /**
   * Returns the optional error code
   * 
   * @return int
   */
  public function code() {
    return $this->code;
  }

  /**
   * Makes it possible to echo the entire error object
   * 
   * @return string
   */
  public function __toString() {
    return $this->message; 
  }

  /**
   * Returns the error object as clean array
   * 
   * @return array
   */
  public function toArray() {
    return array(
      'key'     => $this->key,
      'message' => $this->message,
      'code'    => $this->code,
      'data'    => $this->data,
    );    
  }

  /**
   * Returns the error object as json string
   * 
   * @return string
   */
  public function toJSON() {
    return json_encode($this->toArray());
  }

  /**
   * Alternate version of toJSON
   */
  public function json() {
    return $this->toJSON();
  }

  /**
   * HTTP Error header defined by the error code
   * 
   * @param boolean $send if false, the header will be returned
   * @return mixed
   */
  public function header($send = true) {

    $codes = array_merge(array(
      400 => 'Bad Request',
      401 => 'Unauthorized',
      402 => 'Payment required',
      403 => 'Forbidden',
      404 => 'Not found',
      405 => 'Method not allowed',
      //...
      500 => 'Internal Server Error',
      501 => 'Not implemented',
      502 => 'Bad Gateway',
      503 => 'Service Unavailable'
    ), (array)c::get('error.codes'));

    if(!$this->code) $this->code = 400;

    $message  = a::get($codes, $this->code);
    $protocol = server::get('SERVER_PROTOCOL', 'HTTP/1.0');
    $header   = $protocol . ' ' . $this->code . ' ' . $message;

    if(!$send) return $header;

    header($header);

  }

}