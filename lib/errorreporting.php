<?php

namespace Kirby\Toolkit;

// direct access protection
if(!defined('KIRBY')) die('Direct access is not allowed');

/**
 * 
 * Error Reporting
 * 
 * Changes values of the PHP error reporting
 * 
 * @package   Kirby Toolkit 
 * @author    Lukas Bestle <lukas@lu-x.me>
 * @link      http://getkirby.com
 * @copyright Lukas Bestle
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */
class ErrorReporting {

  /**
   * Returns the current raw value
   * 
   * @return int     The current value
   */  
  static public function get() {
    return error_reporting();
  }
  
  /**
   * Sets a new raw error reporting value
   * 
   * @param  int     $level The new level to set
   * @return int     The new value
   */  
  static public function set($level) {
    if(static::get() !== error_reporting($level)) raise('Internal error: error_reporting() did not return the old value.');
    
    return static::get();
  }

  /** 
   * Check if the current error reporting includes an error level
   * 
   * @param  mixed   $level The level to check for
   * @param  int     $current A custom current level
   * @return boolean
   */    
  static public function includes($level, $current = null) {
    // also allow strings
    if(is_string($level)) {
      if(defined($level)) {
        $level = constant($level);
      } else if(defined('E_' . strtoupper($level))) {
        $level = constant('E_' . strtoupper($level));
      } else {
        raise('The level "' . $level . '" does not exist.');
      }
    }
    
    $value = ($current)? $current : static::get();
    return ($value & $level) !== 0;
  }

  /**
   * Adds a level to the current error reporting
   * 
   * @param  int     $level The level to add
   * @return boolean
   */  
  static public function add($level) {
    // check if it is already added
    if(static::includes($level)) return false;
    
    $old = static::get();
    $new = static::set($old | $level);
    
    return $new === ($old | $level);
  }
  
  /**
   * Removes a level from the current error reporting
   * 
   * @param  int     $level The level to remove
   * @return boolean
   */  
  static public function remove($level) {
    // check if it is already removed
    if(!static::includes($level)) return false;
    
    $old = static::get();
    $new = static::set($old ^ $level);
    
    return $new === ($old ^ $level);
  }
}
