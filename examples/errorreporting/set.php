<?php

// include the toolkit
require('../../bootstrap.php');

// overwrite the current value (alias for "error_reporting(E_ALL)"; extremely high-level, you probably don't want to use that)
var_dump(errorreporting::set(E_ALL));

// remove a level from the current level
var_dump(errorreporting::remove(E_ERROR));

// add a level to the current level
var_dump(errorreporting::add(E_ERROR));
