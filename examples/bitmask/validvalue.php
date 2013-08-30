<?php

// include the toolkit
require('../../bootstrap.php');

// check if a value can be used in a bitmask:
//  - is an integer
//  - is a power of two
var_dump(bitmask::validValue(1));        // true
var_dump(bitmask::validValue(2));        // true
var_dump(bitmask::validValue(8));        // true
var_dump(bitmask::validValue(128));      // true

var_dump(bitmask::validValue(42));       // false
var_dump(bitmask::validValue('string')); // false
var_dump(bitmask::validValue(array()));  // false
