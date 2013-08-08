<?php

// include the toolkit
require('../../bootstrap.php');

$password = 'super secret password';
$encoded  = crypt::encode($password);

dump('original: ' . $password);
dump('encoded: ' . $encoded);
dump('decoded: ' . crypt::decode($encoded));