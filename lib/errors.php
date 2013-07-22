<?php

namespace Kirby\Toolkit;

// direct access protection
if(!defined('KIRBY')) die('Direct access is not allowed');

/**
 * Errors
 * 
 * A collection of errors for all objects/classes
 * which can have multiple errors
 * 
 * @package   Kirby Toolkit 
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      http://getkirby.com
 * @copyright Bastian Allgeier
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */
class Errors extends Collection {

  /**
   * Adds a new error to the collection
   * 
   * @param mixed $key Either a key for a new error or an existing error object
   * @param string $message
   * @param mixed $data
   * @param int $code
   */
  public function raise($key, $message = null, $data = null, $code = null) {

    // pass a single error
    if(is_a($key, 'Kirby\\Toolkit\\Error')) {
      $this->set($key->key(), $key);
    
    // pass an entire errors object
    } else if(is_a($key, 'Kirby\\Toolkit\\Errors')) {
      $this->data = array_merge($this->data, $key->get());

    // pass an entire set of  errors
    } else if(is_object($key) and method_exists($key, 'errors') and is_a($key->errors(), 'Kirby\\Toolkit\\Errors')) {
      $this->data = array_merge($this->data, $key->errors()->get());

    // raise multiple errors at once    
    } else if(is_array($key)) {
      foreach($key as $k => $m) $this->set($k, error::raise($k, $m));

    // create a new error and add it
    } else if(!is_null($message)) {
      $this->set($key, error::raise($key, $message, $data, $code));
    }

  }  

  /**
   * Returns an array with all error messages
   * 
   * @return array
   */
  public function messages() {
    $result = array();
    foreach($this->data as $error) {
      $result[$error->key()] = $error->message();
    }
    return $result;
  }

  /**
   * Returns a nested array with all errors
   * 
   * @return array
   */
  public function toArray() {
    $result = array();
    foreach(parent::toArray() as $key => $error) {
      $result[$key] = $error->toArray();
    }
    return $result;
  }

  /**
   * Returns a json string with all errors
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

}