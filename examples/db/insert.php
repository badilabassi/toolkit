<?php

// include the toolkit
require('../../bootstrap.php');

db::connect(array(
  'database' => __DIR__ . DS . 'tmp' . DS . 'db.sqlite',
  'type'     => 'sqlite'
));

// create a dummy user table, which we can use for our tests
db::query('

  CREATE TABLE IF NOT EXISTS "users" (
  "id" INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL UNIQUE,
  "username" TEXT UNIQUE ON CONFLICT FAIL NOT NULL,
  "fname" TEXT,
  "lname" TEXT,
  "password" TEXT NOT NULL,
  "email" TEXT NOT NULL
  );

');

// add our first user into the users table
db::insert('users', array(
  'username' => 'homer',
  'fname'    => 'Homer',
  'lname'    => 'Simpson',
  'password' => 'Marge sucks',
  'email'    => 'homer@simpsons.com'
));

db::insert('users', array(
  'username' => 'marge',
  'fname'    => 'Marge',
  'lname'    => 'Simpson',
  'password' => 'Homer sucks',
  'email'    => 'marge@simpsons.com'
));

db::insert('users', array(
  'username' => 'lisa',
  'fname'    => 'Lisa',
  'lname'    => 'Simpson',
  'password' => 'I love science',
  'email'    => 'lisa@simpsons.com'
));

db::insert('users', array(
  'username' => 'bart',
  'fname'    => 'Bart',
  'lname'    => 'Simpson',
  'password' => 'Eat my shorts',
  'email'    => 'bart@simpsons.com'
));

db::insert('users', array(
  'username' => 'maggie',
  'fname'    => 'Maggie',
  'lname'    => 'Simpson',
  'password' => 'dadada',
  'email'    => 'maggie@simpsons.com'
));

