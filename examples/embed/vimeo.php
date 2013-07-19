<?php

// include the toolkit
require('../../bootstrap.php');

// this is all you need to do to embed a vimeo video
echo embed::vimeo('http://vimeo.com/64895205', array(
  'width'  => 400,
  'height' => 300
));