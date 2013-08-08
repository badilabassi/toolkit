<?php

// include the toolkit
require('../../bootstrap.php');

$asset = new Asset(__DIR__ . DS . 'kirbyicon.png');
$asset->download('icon.png');