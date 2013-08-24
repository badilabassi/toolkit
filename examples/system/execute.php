<?php

// include the toolkit
require('../../bootstrap.php');

// there are different ways to execute a command
$task = 'echo';
print_r(Kirby\Toolkit\System::execute($task, 'Hello World', 'Another argument'));        // [1]
print_r(Kirby\Toolkit\System::execute($task, array('Hello World', 'Another argument'))); // [2]
print_r(Kirby\Toolkit\System::execute(array($task, 'Hello World', 'Another argument'))); // [3]
print_r(Kirby\Toolkit\System::$task('Hello World', 'Another argument'));                 // [4]

// would work as well, but "echo" is a reserved word in PHP
// Kirby\Toolkit\System::echo('Hello World', 'Another argument');

// trying to execute an invalid task will result in an Exception
try {
	Kirby\Toolkit\System::execute('*catwalksoverkeyboard*', 'Hello World', 'Another argument');
} catch(Kirby\Toolkit\Exception $e) {
	echo 'There was an Exception: "' . $e->getMessage() . '"' . "\n";
}

// you can also define what return value you want to have
// This only works for [2] and [3]!
print_r(Kirby\Toolkit\System::execute($task, array('Hello World', 'Another argument'), 'all'));
var_dump(Kirby\Toolkit\System::execute($task, array('Hello World', 'Another argument'), 'output'));
var_dump(Kirby\Toolkit\System::execute($task, array('Hello World', 'Another argument'), 'status'));
var_dump(Kirby\Toolkit\System::execute($task, array('Hello World', 'Another argument'), 'success'));
var_dump(Kirby\Toolkit\System::execute(array($task, 'Hello World', 'Another argument'), 'success'));
