<?php

require_once('lib/bootstrap.php');

class SystemTest extends PHPUnit_Framework_TestCase {
  
  public function testIsExecutable() {
    // basic stuff
    $this->assertTrue(Kirby\Toolkit\System::isExecutable('bash'));
    $this->assertFalse(Kirby\Toolkit\System::isExecutable('somethingtotallynotexisting'));
    
    // with path
    $this->assertTrue(Kirby\Toolkit\System::isExecutable('/bin/bash'));
    
    // with additional arguments
    $this->assertTrue(Kirby\Toolkit\System::isExecutable('bash something totally strange and this should be ignored'));
    $this->assertFalse(Kirby\Toolkit\System::isExecutable('somethingtotallynotexisting something totally strange and this should be ignored'));
    
    // executable files not in $PATH
    $this->assertTrue(Kirby\Toolkit\System::isExecutable(TEST_ROOT_ETC . '/system/executable.sh'));
    $this->assertTrue(Kirby\Toolkit\System::isExecutable(TEST_ROOT_ETC . '/system/executable.sh something totally strange and this should be ignored'));
    
    // non-executable files
    $this->assertFileExists(TEST_ROOT_ETC . '/system/nonexecutable.sh');
    $this->assertFalse(is_executable(TEST_ROOT_ETC . '/system/nonexecutable.sh'));
    $this->assertFalse(Kirby\Toolkit\System::isExecutable(TEST_ROOT_ETC . '/system/nonexecutable.sh'));
    
    // invalid files
    $this->assertFalse(Kirby\Toolkit\System::isExecutable(TEST_ROOT_ETC . '/system/notexisting.sh'));
  }
  
  public function testExecute() {
    // execute an existing system task
    $this->assertEquals(array('output' => 'Hello World', 'status' => 0, 'success' => true), Kirby\Toolkit\System::execute('echo', 'Hello World'));
    
    // execute the dummy script
    $this->assertEquals(array('output' => 'Some dummy output just to test execution of this file.', 'status' => 0, 'success' => true), Kirby\Toolkit\System::execute(TEST_ROOT_ETC . '/system/executable.sh', array('totallywayne')));
    
    // other arguments
    $this->assertEquals(array('output' => 'Something is sometimes not that cool. But anyway.', 'status' => 0, 'success' => true), Kirby\Toolkit\System::execute(TEST_ROOT_ETC . '/system/executable.sh', array('something')));
    $this->assertEquals(array('output' => 'This probably failed. Or so.', 'status' => 42, 'success' => false), Kirby\Toolkit\System::execute(TEST_ROOT_ETC . '/system/executable.sh', array('fail')));
    
    // other return values
    $this->assertEquals(array('output' => 'Some dummy output just to test execution of this file.', 'status' => 0, 'success' => true), Kirby\Toolkit\System::execute(TEST_ROOT_ETC . '/system/executable.sh', array('totallywayne'), 'all'));
    $this->assertEquals(array('output' => 'Some dummy output just to test execution of this file.', 'status' => 0, 'success' => true), Kirby\Toolkit\System::execute(TEST_ROOT_ETC . '/system/executable.sh', array('totallywayne'), 'notexistingforsure'));
    $this->assertEquals('Some dummy output just to test execution of this file.', Kirby\Toolkit\System::execute(TEST_ROOT_ETC . '/system/executable.sh', array('totallywayne'), 'output'));
    $this->assertEquals(0, Kirby\Toolkit\System::execute(TEST_ROOT_ETC . '/system/executable.sh', array('totallywayne'), 'status'));
    $this->assertEquals(true, Kirby\Toolkit\System::execute(TEST_ROOT_ETC . '/system/executable.sh', array('totallywayne'), 'success'));
    
    // other ways of calling
    $this->assertEquals(Kirby\Toolkit\System::execute(TEST_ROOT_ETC . '/system/executable.sh', array('something'), 'all'), Kirby\Toolkit\System::execute(TEST_ROOT_ETC . '/system/executable.sh', 'something'));
    $this->assertEquals(Kirby\Toolkit\System::execute(TEST_ROOT_ETC . '/system/executable.sh', array('something'), 'all'), Kirby\Toolkit\System::execute(array(TEST_ROOT_ETC . '/system/executable.sh', 'something')));
    $this->assertEquals(Kirby\Toolkit\System::execute(TEST_ROOT_ETC . '/system/executable.sh', array('something'), 'all'), Kirby\Toolkit\System::execute(array(TEST_ROOT_ETC . '/system/executable.sh', 'something'), 'all'));
    $this->assertEquals(Kirby\Toolkit\System::execute(TEST_ROOT_ETC . '/system/executable.sh', array('something'), 'success'), Kirby\Toolkit\System::execute(array(TEST_ROOT_ETC . '/system/executable.sh', 'something'), 'success'));
    $this->assertEquals(Kirby\Toolkit\System::execute(TEST_ROOT_ETC . '/system/executable.sh', array('fail'), 'success'), Kirby\Toolkit\System::execute(array(TEST_ROOT_ETC . '/system/executable.sh', 'fail'), 'success'));
  }
  
  /**
   * @expectedException Kirby\Toolkit\Exception
   */
  public function testExecuteInvalidThrow() {
    Kirby\Toolkit\System::execute('notexistingforsure');
  }
  
  public function testCallStatic() {
    $filename = TEST_ROOT_ETC . '/system/executable.sh';
    
    // call the appropriate method statically
    $this->assertEquals(Kirby\Toolkit\System::execute($filename, array('something'), 'all'), Kirby\Toolkit\System::$filename('something'));
    $this->assertEquals(Kirby\Toolkit\System::execute($filename, array('something'), 'all'), Kirby\Toolkit\System::$filename('something', 'success'));
    $this->assertNotEquals(Kirby\Toolkit\System::execute($filename, array('something'), 'success'), Kirby\Toolkit\System::$filename('something', 'success'));
  }
  
  public function testRealpath() {
    // basic stuff
    $this->assertEquals('/bin/bash', Kirby\Toolkit\System::realpath('bash'));
    $this->assertEquals(false, Kirby\Toolkit\System::realpath('notexistingforsure'));
    
    // executable file
    $this->assertEquals(realpath(TEST_ROOT_ETC . '/system/executable.sh'), Kirby\Toolkit\System::realpath(TEST_ROOT_ETC . '/system/executable.sh'));
    
    // not executable file
    $this->assertFileExists(TEST_ROOT_ETC . '/system/nonexecutable.sh');
    $this->assertEquals(false, Kirby\Toolkit\System::realpath(TEST_ROOT_ETC . '/system/nonexecutable.sh'));
    
    // not existing file
    $this->assertEquals(false, Kirby\Toolkit\System::realpath(TEST_ROOT_ETC . '/system/notexisting.sh'));
  }
}
