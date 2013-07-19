<?php

require_once('lib/bootstrap.php');

class ThumbTest extends PHPUnit_Framework_TestCase {
 
  public function testThumb() {

    $name  = 'Screen Shot 2013-04-15 at 13.04.33.png';
    $file  = TEST_ROOT_ETC . DS . 'images' . DS . $name;

    $thumb = new Thumb($file, array(
      'width'    => 100,
      'height'   => 100,
      'crop'     => true, 
      'to'       => 'jpg',
      'location' => array(
        'root'   => TEST_ROOT_TMP,
        'url'    => '',
        'path'   => '{safeName}-{settings}.{extension}'
      )
    ));

    $this->assertNull($thumb->error());
    $this->assertEquals('screen-shot-2013-04-15-at-13-04.33-100-100-0-1-100.jpg', $thumb->filename());
    $this->assertEquals(100, $thumb->width());
    $this->assertEquals(100, $thumb->height());
    $this->assertEquals('image/jpeg', $thumb->mime());
    $this->assertEquals('jpg', $thumb->extension());

    $thumb = new Thumb($file, array(
      'width'    => 100,
      'crop'     => false, 
      'location' => array(
        'root'   => TEST_ROOT_TMP,
        'url'    => 'http://getkirby.com/images',
        'path'   => 'test' . DS . 'thumb.{extension}'
      )
    ));

    $this->assertEquals('thumb.png', $thumb->filename());
    $this->assertEquals('image/png', $thumb->mime());
    $this->assertEquals('http://getkirby.com/images/test/thumb.png', $thumb->url());
    $this->assertEquals(100, $thumb->width());
    $this->assertEquals(78, $thumb->height());

    // remove all created thumbs
    dir::clean(TEST_ROOT_TMP);

  }

 }