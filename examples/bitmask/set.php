<?php

// include the toolkit
require('../../bootstrap.php');

// modify bitmasks
$mask = 1 | 2 | 4 | 16 | 64;
var_dump(bitmask::add(32, $mask));
var_dump(bitmask::remove(16, $mask));
