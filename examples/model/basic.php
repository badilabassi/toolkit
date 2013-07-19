<?php

// include the toolkit
require('../../bootstrap.php');

class User extends Model {}

// create a new user
$user = new User();

$user->username = 'homer';
$user->fname    = 'Homer';
$user->password = 'Marge sucks';
$user->email    = 'invalid email';

dump($user->toArray());