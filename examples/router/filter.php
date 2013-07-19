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

// register a new GET route 
router::get('api/users/(:any)', function($username) {
  dump('user profile for: ' . $username);
}, 'auth');

// register another GET route
router::get('api/users/(:any)/posts', function($username) {
  dump('posts for user: ' . $username . '...');
}, 'auth');

// check for a matching route 
if($route = router::match($currentURL)) {
  // call the route action and pass all variables from the url
  router::call($route);
}