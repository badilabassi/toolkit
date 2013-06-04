<?php

namespace Kirby\Toolkit;

// direct access protection
if(!defined('KIRBY')) die('Direct access is not allowed');

/**
 * 
 * Content
 * 
 * This class handles output buffering,
 * content loading and setting content type headers. 
 * 
 * @package   Kirby Toolkit 
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      http://getkirby.com
 * @copyright Bastian Allgeier
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */
class Content {
  
  /**
   * Starts the output buffer
   * 
   * <code>
   * 
   * content::start();
   * echo 'some content';
   * echo content::stop();
   * 
   * </code>
   * 
   */
  static public function start() {
    ob_start();
  }

  /**
   * Stops the output buffer and returns its content
   * 
   * <code>
   * 
   * content::start();
   * echo 'some content';
   * echo content::stop();    
   * // echo the content immediatelly
   * 
   * 
   * content::start();
   * echo 'some content';
   * $content = content::stop(true);    
   * // return the content
   * 
   * </code>
   * 
   * @return string
   */
  static public function stop() {
    $content = ob_get_contents();
    ob_end_clean();
    return $content;
  }

  /**
   * Stops the output buffer and echos its content
   */
  static public function flush() {
    ob_end_flush();
  }

  /**
   * Loads content from a passed file
   * 
   * @param  string  $file The path to the file
   * @param  array   $data Additional variables which should be available for the loaded content
   * @param  boolean $return True: return the content of the file, false: echo the content
   * @return mixed
   */
  static public function load($file, $data = array(), $return = true) {
    self::start();
    extract($data);
    require($file);
    $content = self::stop();
    if($return) return $content;
    echo $content;        
  }

  /**
   * Simplifies setting content type headers
   * 
   * <code>
   * 
   * content::type('js');
   * // some javascript
   * 
   * content::type('png');
   * // some png 
   * 
   * content::type('text/rtf', 'iso-8859-1');    
   * // rtf document
   * 
   * </code>
   * 
   * check c::get('f.mimes') for more available shortcuts
   * 
   * @param  string  $ctype The shortcut for the content type. See the keys of the $ctypes array for all available shortcuts
   * @param  string  $charset The charset definition for the content type header. Default is "utf-8"
   */
  static public function type($type = null, $charset = 'utf-8', $send = true) {

    $mime = a::get(c::get('f.mimes'), $type);

    // use the first content type if multiple are available
    if(is_array($mime)) $mime = a::first($mime);

    // fallback to the given type
    if(!$mime) $mime = $type;

    $header = 'Content-type: ' . $mime . '; charset=' . $charset;

    if($send) {
     header($header);
    } else {
     return $header;
    }

  }

}
