<?php

// include the toolkit
require('../../bootstrap.php');

// setup a new email
$email = new Email();
$email->to      = 'bastian@getkirby.com';
$email->from    = 'bastian@getkirby.com';
$email->subject = 'Simple email';
$email->body    = 'Hey!';
$email->send();

// check for errors
if($email->failed()) {
  dump($email->errors());
} else {
  echo 'Yay! The email has been sent';
}