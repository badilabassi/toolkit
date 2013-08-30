<?php

// include the toolkit
require('../../bootstrap.php');

// get the current error reporting value (alias for "error_reporting()"; extremely high-level, you probably don't want to use that)
var_dump(errorreporting::get());

// check if an error level is included in the current error reporting level
var_dump(errorreporting::includes(E_ERROR));   // most likely true
var_dump(errorreporting::includes('E_ERROR')); // most likely true
var_dump(errorreporting::includes('ERROR'));   // most likely true
var_dump(errorreporting::includes('error'));   // most likely true

// you can also pass your own error reporting value and check for it
var_dump(errorreporting::includes(E_ERROR, E_ALL));                // true
var_dump(errorreporting::includes(E_ERROR, E_WARNING | E_NOTICE)); // false
