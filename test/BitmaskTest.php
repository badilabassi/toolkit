<?php

require_once('lib/bootstrap.php');

class BitmaskTest extends PHPUnit_Framework_TestCase {
  
  public function testValidValue() {
    // valid values
    $this->assertTrue(Kirby\Toolkit\Bitmask::validValue(1));
    $this->assertTrue(Kirby\Toolkit\Bitmask::validValue(2));
    $this->assertTrue(Kirby\Toolkit\Bitmask::validValue(4));
    $this->assertTrue(Kirby\Toolkit\Bitmask::validValue(64));
    $this->assertTrue(Kirby\Toolkit\Bitmask::validValue(256));
    $this->assertTrue(Kirby\Toolkit\Bitmask::validValue(32768));
    $this->assertTrue(Kirby\Toolkit\Bitmask::validValue(9007199254740992));
    
    // invalid values
    $this->assertFalse(Kirby\Toolkit\Bitmask::validValue(10));
    $this->assertFalse(Kirby\Toolkit\Bitmask::validValue(13));
    $this->assertFalse(Kirby\Toolkit\Bitmask::validValue(4.2));
    $this->assertFalse(Kirby\Toolkit\Bitmask::validValue('string'));
    $this->assertFalse(Kirby\Toolkit\Bitmask::validValue(array()));
  }
  
  public function testIncludes() {
    $mask = 1 | 4 | 32;
    
    // existing values
    $this->assertTrue(Kirby\Toolkit\Bitmask::includes(1, $mask));
    $this->assertTrue(Kirby\Toolkit\Bitmask::includes(4, $mask));
    $this->assertTrue(Kirby\Toolkit\Bitmask::includes(32, $mask));
    
    // non-existing values
    $this->assertFalse(Kirby\Toolkit\Bitmask::includes(2, $mask));
    $this->assertFalse(Kirby\Toolkit\Bitmask::includes(16, $mask));
    
    // invalid values
    $this->assertFalse(Kirby\Toolkit\Bitmask::includes(array(), $mask));
    $this->assertFalse(Kirby\Toolkit\Bitmask::includes('string', $mask));
    $this->assertFalse(Kirby\Toolkit\Bitmask::includes(13, $mask));
  }
  
  public function testAdd() {
    $mask = 1 | 4 | 32;
    
    $this->assertEquals(Kirby\Toolkit\Bitmask::add(16, $mask), $mask | 16);
    $this->assertEquals(Kirby\Toolkit\Bitmask::add(4, $mask), $mask);
  }
  
  /**
   * @expectedException Kirby\Toolkit\Exception
   */
  public function testAddInvalidThrow() {
    Kirby\Toolkit\Bitmask::add(42, 1);
  }
  
  public function testRemove() {
    $mask = 1 | 4 | 32;
    
    $this->assertEquals(Kirby\Toolkit\Bitmask::remove(32, $mask), $mask ^ 32);
    $this->assertEquals(Kirby\Toolkit\Bitmask::remove(16, $mask), $mask);
  }
  
  /**
   * @expectedException Kirby\Toolkit\Exception
   */
  public function testRemoveInvalidThrow() {
    Kirby\Toolkit\Bitmask::remove(42, 1);
  }
}
