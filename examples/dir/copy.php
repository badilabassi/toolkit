<?php

// include the toolkit
require('../../bootstrap.php');

dir::copy(dirname(__DIR__) . DS . 'thumb', __DIR__ . DS . 'test');

echo 'The directory has been copied';