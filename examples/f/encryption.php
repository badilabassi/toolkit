<?php

// include the toolkit
require('../../bootstrap.php');

$file    = __DIR__ . DS . 'tmp' . DS . 'secretfile.php';
$content = 'super secret content';
$secret  = 'mysecretkey';

dump('original: ' . $content);
dump('encrypted: ' . f::encrypt($file, $content, $secret));
dump('decrypted: ' . f::decrypt($file, $secret));