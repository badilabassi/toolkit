<?php

namespace Kirby\Toolkit;

// direct access protection
if(!defined('KIRBY')) die('Direct access is not allowed');

/**
 * Header
 * 
 * Makes sending HTTP headers a breeze
 * 
 * @package   Kirby Toolkit 
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      http://getkirby.com
 * @copyright Bastian Allgeier
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */
class Header {

  /**
   * Sends a content type header
   * 
   * @param string $mime
   * @param string $charset
   * @param boolean $send
   * @return mixed
   */
  static public function contentType($mime, $charset = 'UTF-8', $send = true) {  
    if(f::extensionToMime($mime)) $mime = f::extensionToMime($mime);
    $header = 'Content-type: ' . $mime;
    if($charset) $header .= '; charset=' . $charset;
    if(!$send) return $header;
    header($header);
  }

  /**
   * Shortcut for static::contentType()
   * 
   * @param string $mime
   * @param string $charset
   * @param boolean $send
   * @return mixed
   */
  static public function type($mime, $charset = 'UTF-8', $send = true) {
    return static::contentType($mime, $charset, $send);
  }


  /**
   * Sends a status header 
   * 
   * @param int $code The HTTP status code
   * @param boolean $send If set to false the header will be returned instead
   * @return mixed
   */
  static public function status($code, $send = true) {

    // default status codes
    $codes = array_merge(array(
      '_200' => 'Ok', 
      '_201' => 'Created', 
      '_202' => 'Accepted',
      //...
      '_301' => 'Moved Permanently',
      '_302' => 'Found',
      '_303' => 'See Other',
      '_304' => 'Not Modified',
      //...
      '_400' => 'Bad Request',
      '_401' => 'Unauthorized',
      '_402' => 'Payment required',
      '_403' => 'Forbidden',
      '_404' => 'Not found',
      '_405' => 'Method not allowed',
      //...
      '_500' => 'Internal Server Error',
      '_501' => 'Not implemented',
      '_502' => 'Bad Gateway',
      '_503' => 'Service Unavailable'
    ), (array)c::get('header.status'));

    $code     = (!array_key_exists('_' . $code, $codes)) ? 400 : $code;
    $message  = a::get($codes, '_' . $code, 'Something went wrong');
    $protocol = server::get('SERVER_PROTOCOL', 'HTTP/1.0');
    $header   = $protocol . ' ' . $code . ' ' . $message;

    if(!$send) return $header;

    // try to send the header
    header($header);

  }

  /**
   * Sends a 200 header
   * 
   * @param boolean $send
   * @return mixed
   */
  static public function success($send = true) {
    return static::status(200, $send);
  }

  /**
   * Sends a 201 header
   * 
   * @param boolean $send
   * @return mixed
   */
  static public function created($send = true) {
    return static::status(201, $send);
  }

  /**
   * Sends a 202 header
   * 
   * @param boolean $send
   * @return mixed
   */
  static public function accepted($send = true) {
    return static::status(202, $send);
  }

  /**
   * Sends a 400 header
   * 
   * @param boolean $send
   * @return mixed
   */
  static public function error($send = true) {
    return static::status(400, $send);
  }

  /**
   * Sends a 403 header
   * 
   * @param boolean $send
   * @return mixed
   */
  static public function forbidden($send = true) {
    return static::status(403, $send);
  }

  /**
   * Sends a 404 header
   * 
   * @param boolean $send
   * @return mixed
   */
  static public function notfound($send = true) {
    return static::status(404, $send);
  }

  /**
   * Sends a 404 header
   * 
   * @param boolean $send
   * @return mixed
   */
  static public function missing($send = true) {
    return static::status(404, $send);
  }

  /**
   * Sends a 500 header
   * 
   * @param boolean $send
   * @return mixed
   */
  static public function panic($send = true) {
    return static::status(500, $send);
  }

  /**
   * Sends a 503 header
   * 
   * @param boolean $send
   * @return mixed
   */
  static public function unavailable($send = true) {
    return static::status(503, $send);
  }

  /**
   * Sends a redirect header
   * 
   * @param boolean $send
   * @return mixed
   */
  static public function redirect($url, $code = 301, $send = true) {

    $status   = static::status($code, false); 
    $location = 'Location:' . url::to($url);

    if(!$send) {
      return $status . PHP_EOL . $location;
    }

    header($status);
    header($location);
    exit();

  }

}