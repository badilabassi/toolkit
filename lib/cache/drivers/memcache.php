<?php

// direct access protection
if(!defined('KIRBY')) die('Direct access is not allowed');

/**
 * Memcache
 * 
 * @package Kirby Toolkit
 */
class MemcacheCacheDriver extends CacheDriver {

  // store for the memache connection
  protected $connection = null;

  /**
   * Set all parameters which are needed for the memcache client
   * see defaults for available parameters
   * 
   * @param array $params
   * @return void
   */
  public function __construct($params = array()) {
    
    $defaults = array(
      'host'    => 'localhost',
      'port'    => 11211, 
      'timeout' => 1
    );

    $this->options    = array_merge($defaults, $params);
    $this->connection = new Memcache();
    $this->connection->connect($this->options['host'], $this->options['port'], $this->options['timeout']);

  }

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
    return $this->connection->set($key, $this->value($value, $minutes), false, $this->expiration($minutes));
  }

  /**
   * Retrieve the CacheValue object from the cache.
   *
   * @param  string  $key
   * @return object CacheValue
   */
  public function retrieve($key) {
    return $this->connection->get($key);
  }

  /**
   * Remove an item from the cache
   * 
   * @param string $key
   * @return boolean
   */
  public function remove($key) {
    return $this->connection->delete($key);
  }

  /**
   * Flush the entire cache directory
   * 
   * @return boolean
   */
  public function flush() {
    return $this->connection->flush();
  }

}