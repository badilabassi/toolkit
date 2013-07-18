<?php

// include the toolkit
require('../../bootstrap.php');

// get all headers for the google start page
$remote = remote::headers('http://google.com');

// dump all headers
dump($remote);