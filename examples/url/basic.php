<?php

// include the toolkit
require('../../bootstrap.php');

url::$home = 'http://mydomain.com';
url::$to   = function($uri = '/', $params = array()) { 

  // url shortcuts
  switch($uri) {
    case '@google':
      return 'http://google.com';
    case '@facebook':
      return 'http://facebook.com';
    case '@apple':
      return 'http://apple.com';
  } 

  // build the full url
  $uri = ltrim($uri, '/');
  return (empty($uri)) ? url::home() : url::home() . '/' . $uri;

};

dump(url::to('@google'));
dump(url::to('@facebook'));
dump(url::to('@apple'));
dump(url::to('my/subpage'));
dump(url::to('http://getkirby.com'));


