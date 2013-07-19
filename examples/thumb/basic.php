<?php

// include the toolkit
require('../../bootstrap.php');

$root  = __DIR__ . DS . 'screenshot.jpg';
$image = new Asset($root);
$thumb = thumb($image, array(
  'width'    => 200,
  'height'   => 300, 
  'location' => array(
    'root' => __DIR__,
    'path' => 'screenshot.thumb.jpg', 
    'url'  => dirname(url::current())
  )
));

echo $thumb->tag();
