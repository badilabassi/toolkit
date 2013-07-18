<?php

// include the toolkit
require('../../bootstrap.php');

// connect the file cache and use the tmp dir as cache root
cache::connect('file', array('root' => __DIR__ . DS . 'tmp'));

// try to get users from cache
if($users = cache::get('users')) {
  dump('Cache expires: ' . date('Y-m-d H:i:s', cache::expires('users')));
} else {
  $users = array(
    'homer', 
    'marge', 
    'bart', 
    'lisa', 
    'maggie'
  );
  cache::set('users', $users);
}

dump($users);