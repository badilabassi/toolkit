<?php

// include the toolkit
require('../../bootstrap.php');

// create a new object
$obj = new Object();

$obj->name  = 'My awesome object';
$obj->url   = 'some invalid url';
$obj->descr = ''; 

$validation = v($obj, array(
  'name'  => array('required', 'max' => 10),
  'url'   => array('required', 'url'),
  'descr' => array('required', 'min' => 20),
));

if($validation->failed()) {
  dump($validation->errors()->messages());
} else {
  dump('Yay, the object is really awesome');
}