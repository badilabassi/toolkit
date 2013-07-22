<?php

// include the toolkit
require('../../bootstrap.php');

// simulate a current url
$currentURL = 'http://mydomain.com/api/users/getkirby';
$currentURL = 'http://mydomain.com/api/users/getkirby/posts';

// define a filter
router::filter('auth', function() {
  dump('authenticated');
});

// register all routes in a single call
route::register(array(
  'api/users/(:any)' => array(
    'action' => function($username) {
      dump('user profile for: ' . $username);
    },
    'method' => 'GET',
    'filter' => 'auth'
  ),
  'api/users/(:any)/posts' => array(
    'action' => function($username) {
      dump('posts for user: ' . $username);
    },
    'method' => 'GET',
    'filter' => 'auth'
  ),
));

// check for a matching route 
if($route = router::run($currentURL)) {
  // call the route action and pass all variables from the url
  $route->call();
}