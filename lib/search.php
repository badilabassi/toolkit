<?php

namespace Kirby\Toolkit;

// direct access protection
if(!defined('KIRBY')) die('Direct access is not allowed');

/**
 * 
 * Search 
 * 
 * A simple base class for searches, 
 * which helps with extracting search words, 
 * handling stopwords and building a sql search clause.
 * 
 * @package   Kirby Toolkit 
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      http://getkirby.com
 * @copyright Bastian Allgeier
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */
class Search {

  protected $options = array();
  protected $fields  = array();
  protected $query   = null;

  /**
   * Constructor
   * 
   * @param string $query
   * @param array $fields
   * @param array $params
   */
  public function __construct($query, $fields, $params = array()) {
    $this->query   = $query;
    $this->fields  = $fields;
    $this->options = array_merge($this->defaults(), $params);
  }

  /**
   * Returns all default values for the search object's option array
   * 
   * @return array
   */
  protected function defaults() {
    return array(
      'stopwords' => array(),
      'fields'    => array(), 
      'minlength' => 2,
      'maxwords'  => 10, 
      'operators' => array('word' => 'AND', 'field' => 'OR')
    );
  }

  /**
   * Returns the raw search query
   * 
   * @return string
   */
  public function query() {
    return $this->query;
  }

  /**
   * Returns the array of search fields
   * 
   * @return array
   */
  public function fields() {
    return $this->fields;
  }

  /**
   * Splits the search query into search words 
   * and strips all non-word characters
   * It also removes stopwords and makes sure that
   * search words are long enough. 
   * 
   * @return array
   */
  public function words() {

    $words = preg_replace('/[^\pL]/u',',', preg_quote($this->query));
    $words = str::split($words, ',', $this->options['minlength']);

    // remove stopwords 
    if(!empty($this->options['stopwords'])) {
      $words = array_diff($words, $this->options['stopwords']);
    }

    // limit the number of words
    $words = array_slice($words, 0, $this->options['maxwords']);

    return $words;

  }  

  /**
   * Builds the sql search clause
   * 
   * @return string
   */
  public function sql() {

    if(empty($this->fields)) return null;

    $clause = array();      

    foreach($this->fields as $field) {
      
      $sql = array(); 

      foreach($this->words() as $word) {
        $sql[] = $field . ' LIKE "%' . db::escape($word) . '%"';
      }

      $clause[] = '(' . implode(' ' . trim($this->options['operators']['word']) . ' ', $sql) . ')';

    }

    return implode(' ' . trim($this->options['operators']['field']) . ' ', $clause);

  }

}