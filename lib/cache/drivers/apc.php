<?php

// direct access protection
if(!defined('KIRBY')) die('Direct access is not allowed');

/**
 * APC Cache
 * 
 * @package Kirby Toolkit
 */
class ApcCacheDriver extends CacheDriver {

  /**
   * Write an item to the cache for a given number of minutes.
   *
   * <code>
   *    // Put an item in the cache for 15 minutes
   *    Cache::set('value', 'my value', 15);
   * </code>
   *
   * @param  string  $key
   * @param  mixed   $value
   * @param  int     $minutes
   * @return void
   */
  public function set($key, $value, $minutes = null) {
    return apc_add($key, $this->value($value, $minutes), $this->expiration($minutes));
  }

  /**
   * Get an item from the cache.
   *
   * <code>
   *    // Get an item from the cache driver
   *    $value = Cache::get('value');
   *
   *    // Return a default value if the requested item isn't cached
   *    $value = Cache::get('value', 'default value');
   * </code>
   *
   * @param  string  $key
   * @param  mixed   $default
   * @return mixed
   */
  public function retrieve($key) {
    return apc_fetch($key);
  }

  /**
   * Checks if the current key exists in cache
   * 
   * @param string $key
   * @return boolean
   */
  public function exists($key) {
    return apc_exists($key);
  }

  /**
   * Remove an item from the cache
   * 
   * @param string $key
   * @return boolean
   */
  public function remove($key) {
    return apc_delete($key);
  }

  /**
   * Flush the entire cache directory
   * 
   * @return boolean
   */
  public function flush() {
    return apc_clear_cache();
  }

}