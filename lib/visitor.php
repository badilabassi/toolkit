<?php

namespace Kirby\Toolkit;

// direct access protection
if(!defined('KIRBY')) die('Direct access is not allowed');

/**
 * 
 * Visitor
 * 
 * Gives some handy information about the current visitor
 * 
 * @package   Kirby Toolkit 
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      http://getkirby.com
 * @copyright Bastian Allgeier
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */
class Visitor {

  // cache for the ip address
  static protected $ip = null;
  
  // cache for the user agent string
  static protected $ua = null;
  
  // cache for the detected language code
  static protected $acceptedLanguageCode = null;

  /**
   * Returns the ip address of the current visitor
   * 
   * @return string
   */
  static public function ip() {
    if(!is_null(self::$ip)) return self::$ip;
    return self::$ip = r::ip();
  }

  /**
   * Returns the user agent string of the current visitor
   * 
   * @return string
   */
  static public function ua() {
    if(!is_null(self::$ua)) return self::$ua;
    return self::$ua = server::get('HTTP_USER_AGENT');
  }

  /**
   * A more readable but longer alternative for ua()
   * 
   * @return string
   */
  static public function userAgent() {
    return self::ua();
  }

  /**
   * Returns the user's accepted language
   * 
   * @return string
   */
  static public function acceptedLanguage() {
    return server::get('http_accept_language');
  }

  /**
   * Returns the user's accepted language code
   * 
   * @return string
   */
  static public function acceptedLanguageCode() {
    if(!is_null(self::$acceptedLanguageCode)) return self::$acceptedLanguageCode;
    $detected = str::split(self::acceptedLanguage(), ',');
    $detected = a::first($detected);
    $detected = str::split($detected, '-');
    $detected = str::lower(a::first($detected));
    return self::$acceptedLanguageCode = $detected;
  }

  /**
   * Returns the referrer if available
   * 
   * @return string
   */
  static public function referrer() {
    return r::referer();
  }

  /**
   * Nobody can remember if it is written with on or two r
   * 
   * @return string
   */
  static public function referer() {
    return r::referer();
  }

  /**
   * Checks if the ip of the current visitor is banned
   * 
   * @return boolean
   */
  static public function banned() {
    return (in_array(self::ip(), c::get('visitor.banned')));
  }

  /**
   * Returns the ip address if the object 
   * is being converted to a string or echoed
   *
   * @return string
   */
  public function __toString() {
    return self::ip();
  }

}