<?php

// include the toolkit
require('../../bootstrap.php');

$autoloader = new Autoloader();
$autoloader->root = __DIR__ . DS . 'lib';
$autoloader->namespace = 'Kirby\Toolkit\Example';
$autoloader->start();

use Kirby\Toolkit\Example\MyClass;

$myclass = new MyClass();
$myclass->hello();