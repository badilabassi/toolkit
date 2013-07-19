<?php

namespace Kirby\Toolkit;

// direct access protection
if(!defined('KIRBY')) die('Direct access is not allowed');

/**
 * Event
 * 
 * Attach and trigger events throghout the system
 * 
 * @package   Kirby Toolkit 
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      http://getkirby.com
 * @copyright Bastian Allgeier
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */
class Event {

  // array with all collected events
  static protected $events = array();

  /**
   * Registers a new event. 
   * 
   * @param string $events The name of the event
   * @param func $callback The callback function
   */
  static public function on($event, $callback) {
    if(!isset(static::$events[$event])) static::$events[$event] = array();
    if(is_array($callback)) {
      // attach all passed events at once
      static::$events[$event] = array_merge(static::$events[$event], $callback);
    } else {
      // attach a single new event
      static::$events[$event][] = $callback;
    }
  }

  /**
   * Triggers all available events for a given key
   * 
   * @param string $event The name of the event, that should be triggered
   * @param array $arguments An optional array of arguments, which should be passed to the event
   */
  static public function trigger($event, $arguments = array()) {
    if(empty(static::$events[$event])) return false;
    
    foreach(static::$events[$event] as $callback) {
      if(!is_callable($callback)) continue;
      call_user_func_array($callback, $arguments);
    }
  }

}