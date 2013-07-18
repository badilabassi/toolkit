<?php

// include the toolkit
require('../../bootstrap.php');

$data = array(
  'username' => 'Homer', 
  'fname'    => 'Homer', 
  'lname'    => 'Simpson',
  'email'    => 'home@simpsons.com'
);

$file = __DIR__ . DS . 'tmp' . DS . 'homer.txt';

// create the txtstore
txtstore::write($file, $data);

// read the just created file
$result = txtstore::read($file);

// dump the result array, 
// which should match the $data array
dump($result);