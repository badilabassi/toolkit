<?php

// include the toolkit
require('../../bootstrap.php');

// there are different ways to execute a command
$task = 'echo';
print_r(system::execute($task, 'Hello World', 'Another argument'));        // [1]
print_r(system::execute($task, array('Hello World', 'Another argument'))); // [2]
print_r(system::execute(array($task, 'Hello World', 'Another argument'))); // [3]
print_r(system::$task('Hello World', 'Another argument'));                 // [4]

// would work as well, but "echo" is a reserved word in PHP
// system::echo('Hello World', 'Another argument');

// trying to execute an invalid task will result in an Exception
try {
	system::execute('*catwalksoverkeyboard*', 'Hello World', 'Another argument');
} catch(Kirby\Toolkit\Exception $e) {
	echo 'There was an Exception: "' . $e->getMessage() . '"' . "\n";
}

// you can also define what return value you want to have
// This only works for [2] and [3]!
print_r(system::execute($task, array('Hello World', 'Another argument'), 'all'));
var_dump(system::execute($task, array('Hello World', 'Another argument'), 'output'));
var_dump(system::execute($task, array('Hello World', 'Another argument'), 'status'));
var_dump(system::execute($task, array('Hello World', 'Another argument'), 'success'));
var_dump(system::execute(array($task, 'Hello World', 'Another argument'), 'success'));
