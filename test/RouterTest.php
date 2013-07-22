<?php

require_once('lib/bootstrap.php');

class RouterTest extends PHPUnit_Framework_TestCase {
 
  public function testRegister() {

    route::get('uri', array());
    route::post('uri', array());
    route::put('uri', array());
    route::delete('uri', array());

    $routes = router::routes();

    $this->assertTrue(isset($routes['GET']['uri']));
    $this->assertTrue(isset($routes['POST']['uri']));
    $this->assertTrue(isset($routes['PUT']['uri']));
    $this->assertTrue(isset($routes['DELETE']['uri']));

    route::register('anotheruri', 'action', array('method' => 'GET|POST'));

    $routes = router::routes();

    $this->assertTrue(isset($routes['GET']['anotheruri']));
    $this->assertTrue(isset($routes['POST']['anotheruri']));
    
  }

  public function testMatch() {

    uri::current('blog');

    // exact matches
    route::register('blog', 'action', array('method' => 'GET'));    
        
    $route = router::run();
    
    $this->assertInstanceOf('Kirby\\Toolkit\\Router\\Route', $route);
    $this->assertEquals(array('GET'), $route->method());
    $this->assertEquals('blog', $route->pattern());
    $this->assertEquals(array(), $route->arguments());
    $this->assertEquals('action', $route->action());

    uri::current('blog/2012/12/12');

    // (:all) wildcard
    route::get('blog/(:all)', 'action');    

    $route = router::run();

    $this->assertEquals(array('2012/12/12'), $route->arguments());

    // remove all existing routes
    router::reset();

    // (:num) wildcard
    route::get('blog/(:num)/(:num)/(:num)', 'action');    

    $route = router::run();

    $this->assertEquals(array('2012', '12', '12'), $route->arguments());

    // remove all existing routes
    router::reset();

    uri::current('blog/2012/12');

    // (:num?) wildcard
    route::get('blog/(:num?)/(:num?)/(:num?)', 'action');    

    $route = router::run();

    $this->assertEquals(array('2012', '12'), $route->arguments());

    // remove all existing routes
    router::reset();

    uri::current('blog/category/design');

    // (:alpha) wildcard
    route::get('blog/category/(:alpha)', 'action');    

    $route = router::run();

    $this->assertEquals(array('design'), $route->arguments());

    // remove all existing routes
    router::reset();

    // (:alpha) wildcard
    route::get('blog/category/(:alpha)', 'action');    

    // full url
    $route = router::run('http://mydomain.com/blog/category/design');

    $this->assertEquals(array('design'), $route->arguments());

    // relative url
    $route = router::run('/blog/category/design');

    $this->assertEquals(array('design'), $route->arguments());

    $this->assertEquals(router::route(), $route);
    $this->assertEquals(array('design'), router::arguments());

  }

}