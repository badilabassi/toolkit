<?php

namespace Kirby\Toolkit\Validation;

use Kirby\Toolkit\Collection;
use Kirby\Toolkit\URL;

// direct access protection
if(!defined('KIRBY')) die('Direct access is not allowed');

/**
 * 
 * Validation Errors
 * 
 * A collection of error messages for a single attribute
 * 
 * @package   Kirby Toolkit 
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      http://getkirby.com
 * @copyright Bastian Allgeier
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */
class Errors extends Collection {

  /**
   * Returns all available error 
   * messages for the attribute
   * 
   * @return object $this
   */
  public function messages() {
    return $this;
  }

  /**
   * Returns a particular message 
   * or the first message if no type is specified
   *
   * @param string $type
   * @return string
   */
  public function message($type = null) {
    return (is_null($type)) ? $this->first() : $this->get($type);
  }

  /**
   * Returns the first message
   * 
   * @return string
   */
  public function __toString() {
    return $this->message();
  }

}