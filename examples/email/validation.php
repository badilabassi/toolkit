<?php

// include the toolkit
require('../../bootstrap.php');

// setup a new email class
$email = new Email();

// send the email
$email->send(array(
  'to'      => 'bastian@getkirbycom',
  'from'    => 'super invalid address',
  'subject' => '',
  'body'    => ''
));

// check for errors
if($email->failed()) {
  dump($email->errors());
} else {
  echo 'Yay! The email has been sent';
}