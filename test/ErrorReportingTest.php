<?php

require_once('lib/bootstrap.php');

class ErrorReportingTest extends PHPUnit_Framework_TestCase {
  
  public function testGet() {
    $this->assertEquals(error_reporting(), Kirby\Toolkit\ErrorReporting::get());
  }
  
  public function testIncludes() {
    // E_ERROR is included in E_ERROR | E_NOTICE
    $this->assertTrue(Kirby\Toolkit\ErrorReporting::includes(E_ERROR, E_ERROR | E_NOTICE));
    $this->assertTrue(Kirby\Toolkit\ErrorReporting::includes('E_ERROR', E_ERROR | E_NOTICE));
    $this->assertTrue(Kirby\Toolkit\ErrorReporting::includes('ERROR', E_ERROR | E_NOTICE));
    $this->assertTrue(Kirby\Toolkit\ErrorReporting::includes('ErRoR', E_ERROR | E_NOTICE));
    $this->assertTrue(Kirby\Toolkit\ErrorReporting::includes('eRrOr', E_ERROR | E_NOTICE));
    
    // E_WARNING is not included in E_ERROR | E_NOTICE
    $this->assertFalse(Kirby\Toolkit\ErrorReporting::includes(E_WARNING, E_ERROR | E_NOTICE));
    $this->assertFalse(Kirby\Toolkit\ErrorReporting::includes('E_WARNING', E_ERROR | E_NOTICE));
    $this->assertFalse(Kirby\Toolkit\ErrorReporting::includes('WARNING', E_ERROR | E_NOTICE));
    $this->assertFalse(Kirby\Toolkit\ErrorReporting::includes('waRNinG', E_ERROR | E_NOTICE));
    
    // E_WARNING is included in E_ALL
    $this->assertTrue(Kirby\Toolkit\ErrorReporting::includes(E_WARNING, E_ALL));
    
    // test E_ALL values
    $this->assertTrue(Kirby\Toolkit\ErrorReporting::includes(E_WARNING, E_ALL ^ E_NOTICE));
    $this->assertFalse(Kirby\Toolkit\ErrorReporting::includes(E_NOTICE, E_ALL ^ E_NOTICE));
  }
  
  /**
   * @expectedException Kirby\Toolkit\Exception
   */
  public function testIncludesInvalidThrow() {
    Kirby\Toolkit\ErrorReporting::includes('notexistingforsure');
  }
  
  public function testSet() {
    $before = Kirby\Toolkit\ErrorReporting::get();
    $after = Kirby\Toolkit\ErrorReporting::set($before ^ E_ERROR ^ E_WARNING);
    
    $this->assertEquals(Kirby\Toolkit\ErrorReporting::get(), $after);
    $this->assertNotEquals($before, $after);
    $this->assertEquals($before ^ E_ERROR ^ E_WARNING, $after);
    
    // reset to the real value
    error_reporting($before);
  }
  
  public function testAdd() {
    $reset = Kirby\Toolkit\ErrorReporting::get();
    
    // normal behavior
    Kirby\Toolkit\ErrorReporting::set($reset ^ E_NOTICE);
    $before = Kirby\Toolkit\ErrorReporting::get();
    $success = Kirby\Toolkit\ErrorReporting::add(E_NOTICE);
    $after = Kirby\Toolkit\ErrorReporting::get();
    
    $this->assertTrue($success);
    $this->assertEquals(Kirby\Toolkit\ErrorReporting::get(), $after);
    $this->assertNotEquals($before, $after);
    $this->assertEquals($before | E_NOTICE, $after);
    
    // try to add a level that is already active
    $this->assertFalse(Kirby\Toolkit\ErrorReporting::add(E_NOTICE));
    
    // reset to the real value
    error_reporting($reset);
  }
  
  public function testRemove() {
    $reset = Kirby\Toolkit\ErrorReporting::get();
    
    // normal behavior
    Kirby\Toolkit\ErrorReporting::set($reset | E_ERROR);
    $before = Kirby\Toolkit\ErrorReporting::get();
    $success = Kirby\Toolkit\ErrorReporting::remove(E_ERROR);
    $after = Kirby\Toolkit\ErrorReporting::get();
    
    $this->assertTrue($success);
    $this->assertEquals(Kirby\Toolkit\ErrorReporting::get(), $after);
    $this->assertNotEquals($before, $after);
    $this->assertEquals($before ^ E_ERROR, $after);
    
    // try to remove a level that is not active
    $this->assertFalse(Kirby\Toolkit\ErrorReporting::remove(E_ERROR));
    
    // reset to the real value
    error_reporting($reset);
  }
}
