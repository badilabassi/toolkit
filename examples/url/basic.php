<?php

// include the toolkit
require('../../bootstrap.php');

event::on('kirby.toolkit.url.home', function(&$url) {
  $url = 'http://mydomain.com';
});

event::on('kirby.toolkit.url.to', function(&$url, $arguments = array()) {

  // url shortcuts
  switch($url) {
    case '@google':
      return $url = 'http://google.com';
    case '@facebook':
      return $url = 'http://facebook.com';
    case '@apple':
      return $url = 'http://apple.com';
  } 

  // build the full url
  $url = ltrim($url, '/');
  $url = (empty($url)) ? url::home() : url::home() . '/' . $url;

});

dump(url::to('@google'));
dump(url::to('@facebook'));
dump(url::to('@apple'));
dump(url::to('my/subpage'));
dump(url::to('http://getkirby.com'));


