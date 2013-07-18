<?php

// include the toolkit
require('../../bootstrap.php');

// call the vimeo api
$remote = remote::get('http://getkirby.com');

// dump the json object
dump($remote->content());