<?php

// include the toolkit
require('../../bootstrap.php');

$thumb = thumb(__DIR__ . DS . 'screenshot.jpg', array(
  'width'    => 200,
  'height'   => 300, 
  'location' => array(
    'root' => __DIR__,
    'path' => 'screenshot.thumb.jpg', 
    'url'  => dirname(url::current())
  )
));

$thumb->download();
