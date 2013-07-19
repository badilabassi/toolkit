<?php

// include the toolkit
require('../../bootstrap.php');

class MyClass {

  protected $errors = null;

  public function __construct() {
    $this->errors = new Errors();
  }

  public function errors() {
    return $this->errors;
  }

  public function raise($key, $message, $code = null) {
    $this->errors->raise($key, $message, $code);
  }

} 

class MyOtherClass {

  protected $error = null;

  public function __construct() {

  }

  public function raise($key, $message, $code = null) {
    $this->error = error::raise($key, $message, $code);
  }

  public function error() {
    return $this->error;
  }

}


$class = new myclass();
$class->raise('myfield', 'This is a horrible error');
$class->raise('anotherfield', 'This is another horrible error');

dump($class->errors());
dump($class->errors()->messages());



$class = new myotherclass();
$class->raise('username', 'The username exists');

dump($class->error());


