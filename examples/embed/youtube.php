<?php

// include the toolkit
require('../../bootstrap.php');

// this is all you need to do to embed a youtube video
echo embed::youtube('http://www.youtube.com/watch?v=I9ficvPdpZg', array(
  'width'  => 400,
  'height' => 300
));