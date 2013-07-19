<?php

// include the toolkit
require('../../bootstrap.php');

class User extends Model {

  protected $id = null;

  public function validate() {
    
    $this->v(array(
      'username' => array('required'), 
      'fname'    => array('required'),
      'lname'    => array('required'),
      'email'    => array('required', 'email'),
    ), null, array(
      'fname' => 'first name', 
      'lname' => 'last name'
    ));

  }

  public function setUsername($username) {
    // create the id by slugifying the username
    $this->id = str::slug($username);
    // set the username itself
    $this->write('username', $username);
  }

  protected function file() {
    return __DIR__ . DS . 'tmp' . DS . $this->id . '.txt';
  }

  public function isNew() {
    return !file_exists($this->file());
  }

  protected function insert() {
    return txtstore::write($this->file(), $this->get());
  }

  protected function update() {
    return txtstore::write($this->file(), $this->get());
  }

  public function delete() {
    return f::remove($this->file());
  }

}

// create a new user
$user = new User();

$user->username = 'homer';
$user->fname    = 'Homer';
$user->lname    = 'Simpson';
$user->password = 'Marge sucks';
$user->email    = 'home@simpsons.com';

if($user->save()) {
  dump('Yay, the user has been saved');
} else {
  dump($user->errors());
}

