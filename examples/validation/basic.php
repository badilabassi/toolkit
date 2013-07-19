<?php

// include the toolkit
require('../../bootstrap.php');

$data = array(
  'username' => 'Homer', 
  'fname'    => 'Homer', 
  'lname'    => 'Simpson',
  'email'    => 'home@simpsonscom'
);

$validation = v($data, array(
  'username' => array('required'), 
  'fname'    => array('required', 'max' => 2),
  'lname'    => array('required', 'min' => 20),
  'email'    => array('required', 'email')
), array(
  'fname' => 'first name',
  'lname' => 'last name'
));


if($validation->failed()) {
  dump($validation->errors()->messages());
} else {
  dump('Yay, the data is valid');
}
