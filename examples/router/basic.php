<?php

// include the toolkit
require('../../bootstrap.php');

// simulate a current url
$currentURL = 'http://mydomain.com/api/users/getkirby';
$currentURL = 'http://mydomain.com/api/users/getkirby/posts';

// register a new GET route 
route::get('api/users/(:any)', function($username) {
  dump('user profile for: ' . $username);
});

// register another GET route
route::get('api/users/(:any)/posts', function($username) {
  dump('posts for user: ' . $username . '...');
});

// check for a matching route 
if($route = router::run($currentURL)) {
  // call the route action and pass all variables from the url
  $route->call($route);
}