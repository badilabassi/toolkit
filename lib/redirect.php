<?php

namespace Kirby\Toolkit;

// direct access protection
if(!defined('KIRBY')) die('Direct access is not allowed');

/**
 * Redirect
 * 
 * Helps redirecting to various places in your app
 * Combined with custom handlers of URL::to, this can be really smart and handy
 * 
 * @package   Kirby Toolkit 
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      http://getkirby.com
 * @copyright Bastian Allgeier
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */
class Redirect {

  /**
   * Redirects the user to a new URL
   *
   * @param   string    $url The URL to redirect to
   * @param   boolean   $code The HTTP status code, which should be sent (301, 302 or 303)
   * @param   boolean   $send If true, headers will be sent and redirection will take effect
   */
  static public function send($url = false, $code = false, $send = true) {

    if(empty($url)) $url = c::get('url', '/');

    $header = false;

    // send an appropriate header
    if($code) {
      switch($code) {
        case 301:
          $header = 'HTTP/1.1 301 Moved Permanently';
          break;
        case 302:
          $header = 'HTTP/1.1 302 Found';
          break;
        case 303:
          $header = 'HTTP/1.1 303 See Other';
          break;
      }
    }
    
    if($send) {
      // send to new page
      if($header) header($header);
      header('Location:' . $url);
      exit();
    } else {
      return $header;
    }

  }

  /**
   * Redirects to a specific URL. You can pass either a normal URI
   * a controller path or simply nothing (which redirects home)
   * 
   * @param string $uri
   * @param array $arguments
   */
  static public function to() {
    static::send(call_user_func_array(array('url', 'to'), func_get_args()));
  }

  /**
   * Redirects to the home page of the app
   */
  static public function home() {
    static::send(url::home());
  }

  /**
   * Redirects to the last location of the user
   * 
   * @param string $fallback
   */
  static public function back($fallback = null) {
    // get the last url
    $last = url::last();
    // make sure there's a proper fallback
    if(empty($last)) $last = $fallback ? $fallback : url::home();
    static::send($last);
  }

}