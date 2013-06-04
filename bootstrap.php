<?php

/**
 * Kirby Toolkit Bootstrapper
 * 
 * Include this file to load all toolkit 
 * classes and helpers on demand
 * 
 * @package   Kirby Toolkit 
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      http://getkirby.com
 * @copyright Bastian Allgeier
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */

// helper constants
if(!defined('KIRBY'))     define('KIRBY',     true);
if(!defined('DS'))        define('DS',        DIRECTORY_SEPARATOR);
if(!defined('MB_STRING')) define('MB_STRING', (int)function_exists('mb_get_info'));

// define toolkit roots
define('KIRBY_TOOLKIT_ROOT',     dirname(__FILE__));
define('KIRBY_TOOLKIT_ROOT_LIB', KIRBY_TOOLKIT_ROOT . DS . 'lib');

/**
 * Loads all missing toolkit classes on demand
 * 
 * @param string $class The name of the missing class
 * @return void
 */
function toolkitLoader($class) {  

  // load classes, which don't follow the
  // naming and location conventions
  $aliases = array(
    'a'          => 'Kirby\\Toolkit\\A',
    'asset'      => 'Kirby\\Toolkit\\Asset',
    'c'          => 'Kirby\\Toolkit\\C',
    'cache'      => 'Kirby\\Toolkit\\Cache',
    'collection' => 'Kirby\\Toolkit\\Collection',
    'content'    => 'Kirby\\Toolkit\\Content',
    'cookie'     => 'Kirby\\Toolkit\\Cookie',
    'db'         => 'Kirby\\Toolkit\\DB',
    'dimensions' => 'Kirby\\Toolkit\\Dimensions',
    'dir'        => 'Kirby\\Toolkit\\Dir',
    'email'      => 'Kirby\\Toolkit\\Email',
    'embed'      => 'Kirby\\Toolkit\\Embed',
    'event'      => 'Kirby\\Toolkit\\Event',
    'exif'       => 'Kirby\\Toolkit\\Exif',
    'f'          => 'Kirby\\Toolkit\\F',
    'form'       => 'Kirby\\Toolkit\\Form',
    'g'          => 'Kirby\\Toolkit\\G',
    'html'       => 'Kirby\\Toolkit\\Html',
    'l'          => 'Kirby\\Toolkit\\L',
    'model'      => 'Kirby\\Toolkit\\Model',
    'object'     => 'Kirby\\Toolkit\\Object',
    'pagination' => 'Kirby\\Toolkit\\Pagination',
    'password'   => 'Kirby\\Toolkit\\Password',
    'r'          => 'Kirby\\Toolkit\\R',
    'remote'     => 'Kirby\\Toolkit\\Remote',
    'router'     => 'Kirby\\Toolkit\\Router',
    's'          => 'Kirby\\Toolkit\\S',
    'server'     => 'Kirby\\Toolkit\\Server',
    'sql'        => 'Kirby\\Toolkit\\SQL',
    'str'        => 'Kirby\\Toolkit\\Str',
    'timer'      => 'Kirby\\Toolkit\\Timer',
    'tpl'        => 'Kirby\\Toolkit\\Tpl',
    'txtstore'   => 'Kirby\\Toolkit\\Txtstore',
    'upload'     => 'Kirby\\Toolkit\\Upload',
    'uri'        => 'Kirby\\Toolkit\\URI',
    'url'        => 'Kirby\\Toolkit\\URL',
    'v'          => 'Kirby\\Toolkit\\V',
    'validator'  => 'Kirby\\Toolkit\\Validator',
    'validation' => 'Kirby\\Toolkit\\Validation',
    'visitor'    => 'Kirby\\Toolkit\\Visitor',
    'xml'        => 'Kirby\\Toolkit\\XML',
  );

  if(array_key_exists(strtolower($class), $aliases)) {
    // create an alias for that class      
    class_alias($aliases[strtolower($class)], $class);
    $class = $aliases[strtolower($class)];
    
    // check if the class has already been loaded
    if(class_exists($class)) return true;

  } 

  // create the path to the class file. 
  $path = strtolower(str_replace('Kirby\\Toolkit\\', '', $class));
  $path = str_replace('\\', DS, $path);
  $file = KIRBY_TOOLKIT_ROOT_LIB . DS . $path . '.php';

  if(file_exists($file)) {
    require_once($file);
    return;
  } 

}

// register the autoloader function
spl_autoload_register('toolkitLoader');

// load the default config values
require_once(KIRBY_TOOLKIT_ROOT . DS . 'defaults.php');

// set the default timezone
date_default_timezone_set(c::get('timezone', 'UTC'));

// load the helper functions
require_once(KIRBY_TOOLKIT_ROOT . DS . 'helpers.php');
