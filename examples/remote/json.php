<?php

// include the toolkit
require('../../bootstrap.php');

// call the vimeo api
$remote = remote::get('http://vimeo.com/api/v2/video/64895205.json');

// dump the json object
dump($remote->json());