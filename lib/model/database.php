<?php

// direct access protection
if(!defined('KIRBY')) die('Direct access is not allowed');

/**
 * Database Model
 * 
 * Base class for building all kinds of database driven models
 * 
 * @package   Kirby Toolkit 
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      http://getkirby.com
 * @copyright Bastian Allgeier
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */
class DatabaseModel extends Model {
  
  protected $table = null;

  /**
   * Returns the DbQuery object with the table prefilled
   * 
   * @return object DbQuery
   */
  protected function table() {
    return db::table($this->table);    
  }

  /**
   * Inserts a new row to the table
   * 
   * @return boolean
   */
  protected function insert() {
    $insert = $this->table()->insert($this->get());
    
    if($insert) {
      $this->id = $insert;
      return true;
    } else {
      return false;
    }

  }

  /**
   * Define this function in your model 
   * to update the model
   * 
   * @return boolean
   */
  protected function update() {
    return $this->table()
                ->where(array($this->primaryKeyName() => $this->primaryKey()))
                ->update($this->get());  
  }

  /**
   * Define this function in your model 
   * to delete the model
   * 
   * @return boolean
   */
  public function delete() {
    return $this->table()
                ->where(array($this->primaryKeyName() => $this->primaryKey()))
                ->delete();  
  }
  
}