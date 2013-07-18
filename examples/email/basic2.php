<?php

// include the toolkit
require('../../bootstrap.php');

// setup a new email class
$email = new Email();

// send the email
$email->send(array(
  'to'      => 'bastian@getkirby.com',
  'from'    => 'bastian@getkirby.com',
  'subject' => 'Simple email',
  'body'    => 'Hey!'
));

// check for errors
if($email->failed()) {
  dump($email->errors());
} else {
  echo 'Yay! The email has been sent';
}