<?php

// include the toolkit
require('../../bootstrap.php');

// download the current file
$asset = new Asset(__DIR__ . DS . 'download.php');

// send all download headers and download this as test.php
header::download(array(
  'name'     => $asset->filename(),
  'size'     => $asset->size(),
  'mime'     => $asset->mime(),
  'modified' => $asset->modified()
));

// read the file and echo the content
echo $asset->read();
