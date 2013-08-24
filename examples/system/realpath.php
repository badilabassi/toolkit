<?php

// include the toolkit
require('../../bootstrap.php');

// get the path of an executable
var_dump(Kirby\Toolkit\System::realpath('bash')); // Probably "/bin/bash"
var_dump(Kirby\Toolkit\System::realpath('*catwalksoverkeyboard*')); // false
var_dump(Kirby\Toolkit\System::realpath('../../test/etc/system/executable.sh')); // The real path to the file
var_dump(Kirby\Toolkit\System::realpath('../../test/etc/system/nonexecutable.sh')); // This is not an executable file -> false
