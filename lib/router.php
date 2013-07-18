<?php

namespace Kirby\Toolkit;

use Kirby\Toolkit\Router\Route;

// direct access protection
if(!defined('KIRBY')) die('Direct access is not allowed');

/**
 * Router
 * 
 * The router makes it possible to react 
 * on any incoming URL scheme
 * 
 * Partly inspired by Laravel's router
 * 
 * @package   Kirby Toolkit 
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      http://getkirby.com
 * @copyright Bastian Allgeier
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */
class Router {
  
  // the matched route if found
  static protected $route = null;

  // all registered routes
  static protected $routes = array(
    'GET'    => array(),
    'POST'   => array(),
    'PUT'    => array(),
    'DELETE' => array()
  );

  // The wildcard patterns supported by the router.
  static protected $patterns = array(
    '(:num)'     => '([0-9]+)',
    '(:alpha)'   => '([a-zA-Z]+)',
    '(:any)'     => '([a-zA-Z0-9\.\-_%=]+)',
    '(:all)'     => '(.*)',
  );

  // The optional wildcard patterns supported by the router.
  static protected $optional = array(
    '/(:num?)'   => '(?:/([0-9]+)',
    '/(:alpha?)' => '(?:/([a-zA-Z]+)',
    '/(:any?)'   => '(?:/([a-zA-Z0-9\.\-_%=]+)',
    '/(:all?)'   => '(?:/(.*)',
  );

  // additional events, which can be triggered by routes
  static protected $filters = array();

  /**
   * Resets all registered routes
   */
  static public function reset() {
    static::$route  = null;
    static::$routes = array(
      'GET'    => array(),
      'POST'   => array(),
      'PUT'    => array(),
      'DELETE' => array()
    );    
  }

  /**
   * Returns the found route
   * 
   * @return mixed
   */
  static public function route() {
    return static::$route;
  }

  /**
   * Returns the options array from the current route
   * 
   * @return array
   */
  static public function options() {
    if($route = static::route()) return $route->options();
  }

  /**
   * Adds a new route
   * 
   * @param string|array $methods GET, POST, PUT, DELETE
   * @param string $uri The url pattern, which should be matched
   * @param mixed $action An array of parameters for this route
   * @param mixed $filters Either a single name of a filter or an array of filter names
   */
  static public function register($methods, $pattern, $action, $filters = null) {
    foreach((array)$methods as $method) {
      static::$routes[$method][ltrim($pattern, '/')] = array('action' => $action, 'filters' => $filters);
    }
  }

  static public function get($pattern, $action, $filters = null) {
    static::register('GET', $pattern, $action, $filters);
  }

  static public function post($pattern, $action, $filters = null) {
    static::register('POST', $pattern, $action, $filters);
  }

  static public function put($pattern, $action, $filters = null) {
    static::register('PUT', $pattern, $action, $filters);
  }

  static public function delete($pattern, $action, $filters = null) {
    static::register('DELETE', $pattern, $action, $filters);
  }

  /**
   * Add a new router filter
   * 
   * @param string $name A simple name for the filter, which can be used by routes later
   * @param closure $function A filter function, which should be called before routes 
   */
  static public function filter($name, $function) {
    static::$filters[$name] = $function;
  }

  /**
   * Return all registered filters
   * 
   * @return array
   */
  static public function filters() {
    return static::$filters;
  }

  /**
   * Returns all added routes
   * 
   * @param string $method
   * @return array
   */
  static public function routes($method = null) {
    return is_null($method) ? static::$routes : static::$routes[$method];
  }

  /**
   * Iterate through every route to find a matching route.
   *
   * @param  string  $url Optional url to match against
   * @return Route
   */
  static public function match($url = null) {

    $url    = is_null($url) ? uri::current()->path()->toString() : trim(url::path($url), '/');
    $method = r::method();
    $routes = static::$routes[$method];

    // empty urls should never happen
    if(empty($url)) $url = '/';

    foreach($routes as $pattern => $route) {

      $action  = $route['action'];
      $filters = $route['filters']; 

      // handle exact matches
      if($pattern == $url) {
        static::filterer($filters);
        return static::$route = new Route($method, $pattern, $action, array());
      }

      // We only need to check routes with regular expression since all others
      // would have been able to be matched by the search for literal matches
      // we just did before we started searching.
      if(!str::contains($pattern, '(')) continue;
      
      $preg = '#^'. static::wildcards($pattern) . '$#u';

      // If we get a match we'll return the route and slice off the first
      // parameter match, as preg_match sets the first array item to the
      // full-text match of the pattern.
      if(preg_match($preg, $url, $parameters)) {
        static::filterer($filters);
        return static::$route = new Route($method, $pattern, $action, array_slice($parameters, 1));
      }    
    
    }
  
  }

  /**
   * Call all matching filters
   * 
   * @param mixed $filters
   */
  static protected function filterer($filters) {
    foreach((array)$filters as $filter) {
      if(array_key_exists($filter, static::$filters) and is_callable(static::$filters[$filter])) {
        call_user_func(static::$filters[$filter]);
      }
    }    
  }

  /**
   * Call the action of a route if callable
   * 
   * @param object $route;
   * @return mixed
   */
  static public function call($route) {
    if(is_callable($route->action())) {
      return call_user_func_array($route->action(), $route->options());
    }
  }

  /**
   * Translate route URI wildcards into regular expressions.
   *
   * @param  string  $uri
   * @return string
   */
  static protected function wildcards($pattern) {
      
    $search  = array_keys(static::$optional);
    $replace = array_values(static::$optional);

    // For optional parameters, first translate the wildcards to their
    // regex equivalent, sans the ")?" ending. We'll add the endings
    // back on when we know the replacement count.
    $pattern = str_replace($search, $replace, $pattern, $count);

    if($count > 0) $pattern .= str_repeat(')?', $count);
    
    return strtr($pattern, static::$patterns);
  
  }

}