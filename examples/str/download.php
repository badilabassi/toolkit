<?php

// include the toolkit
require('../../bootstrap.php');

$string = 'This is an awesome example for a downloadable string';

str::download($string, 'example.txt');