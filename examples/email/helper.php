<?php

// include the toolkit
require('../../bootstrap.php');

// send the email with the email helper function
$email = email(array(
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