<?php

// include the toolkit
require('../../bootstrap.php');

// check if a command is executable
var_dump(system::isExecutable('echo')); // true
var_dump(system::isExecutable('bash')); // true
var_dump(system::isExecutable('*catwalksoverkeyboard*')); // false

// also works for files
var_dump(system::isExecutable('../../test/etc/system/executable.sh')); // file is executable, true
var_dump(system::isExecutable('../../test/etc/system/nonexecutable.sh')); // file is not executable, false
var_dump(system::isExecutable('../../test/etc/system/*catwalksoverkeyboard*.sh')); // file does not exist, false

// if you want to, you can also pass whole commands including arguments (these will be stripped)
var_dump(system::isExecutable('echo "Hello World"')); // true
var_dump(system::isExecutable('*catwalksoverkeyboard* "Hello World"')); // false
