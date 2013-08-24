<?php

// include the toolkit
require('../../bootstrap.php');

// check if a bitmask includes a value
$mask = 1 | 2 | 4 | 16 | 64;
var_dump(bitmask::includes(16, $mask)); // true
var_dump(bitmask::includes(32, $mask)); // false
