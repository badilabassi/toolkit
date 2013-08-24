<?php

// include the toolkit
require('../../bootstrap.php');

// check if the exec() functionality is available (some stupid admins still enable safe_mode on PHP 5.3)
var_dump(Kirby\Toolkit\System::available());
