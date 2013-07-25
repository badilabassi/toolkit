<?php

require_once('lib/bootstrap.php');

class ContentTest extends PHPUnit_Framework_TestCase {
  
  public function testStartAndEnd() {
    
    content::start();
    
    echo 'yay';
    
    $content = content::stop();

    $this->assertEquals('yay', $content);

  }  

  public function testLoad() {

    $content = content::load(TEST_ROOT_ETC . DS . 'content.php', array(
      'var' => 'awesome'
    ));

    $this->assertEquals('My test content is awesome', $content);

  }

}