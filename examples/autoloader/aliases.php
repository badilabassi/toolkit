<?php

// include the toolkit
require('../../bootstrap.php');

$autoloader = new Autoloader();
$autoloader->root = __DIR__ . DS . 'lib';
$autoloader->namespace = 'Kirby\Toolkit\Example';
$autoloader->aliases = array(
  'myclass' => 'Kirby\\Toolkit\\Example\\MyClass'
);
$autoloader->start();

$myclass = new MyClass();
$myclass->hello();