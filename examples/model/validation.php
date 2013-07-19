<?php

// include the toolkit
require('../../bootstrap.php');

class User extends Model {

  public function validate() {
    
    return $this->v(array(
      'username' => array('required'), 
      'fname'    => array('required'),
      'lname'    => array('required'),
      'email'    => array('required', 'email'),
    ), array(
      'fname' => 'first name', 
      'lname' => 'last name'
    ));

  }

}

// create a new user
$user = new User();

$user->username = 'homer';
$user->fname    = 'Homer';
$user->password = 'Marge sucks';
$user->email    = 'invalid email';

$user->validate();

dump($user->errors());