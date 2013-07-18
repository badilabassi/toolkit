<?php

// include the toolkit
require('../../bootstrap.php');

$url = 'http://getkirby.com/forum/general/topic:45?some=query';
$uri = new URI($url, array(
  'file'      => false,
  'subfolder' => false
));

dump( $uri->original() );
dump( $uri->toURL() );
dump( $uri );
dump('----');


$url = 'http://getkirby.com/index.php/forum/general/topic:45?some=query';
$uri = new URI($url);

dump( $uri->original() );
dump( $uri->toURL() );
dump( $uri );
dump('----');


$url = 'http://getkirby.com/subfolder/somefile.php/forum/general/topic:45?some=query';
$uri = new URI($url);

dump( $uri->original() );
dump( $uri->toURL() );
dump( $uri );
dump('----');



$uri = new URI('this', array(
  'subfolder' => '@auto'  
));

dump( $uri->original() );
dump( $uri->toURL() );
dump( $uri );
dump('----');


$uri = new URI('this', array(
  'strip'     => 'test.php',
  'subfolder' => 'repos/toolkit/examples/uri'  
));

dump( $uri->original() );
dump( $uri->toURL() );
dump( $uri );
dump('----');

