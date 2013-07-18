<?php

// include the toolkit
require('../../bootstrap.php');

db::connect(array(
  'database' => __DIR__ . DS . 'tmp' . DS . 'db.sqlite',
  'type'     => 'sqlite'
));

/* get all users
foreach(db::table('users')->all() as $user) {
  dump($user->toArray());
}
*/

/* get specific users
foreach(db::table('users')->where('username', 'in', array('homer', 'bart'))->all() as $user) {
  dump($user->toArray());
}
*/

/* get a specific user
dump(db::table('users')->where('username', ' = ', 'homer')->first()->toArray());
*/

/* get users with an id higher than 2
foreach(db::table('users')->where('id', '>', 2)->all() as $user) {
  dump($user->toArray());
}
*/

/* get users sorted by username and limited by 2
foreach(db::table('users')->order('username asc')->limit(2)->all() as $user) {
  dump($user->toArray());
}
*/

/* get the maximum id of the users table
dump(db::table('users')->max('id'));
*/

/* get the minimum id of the users table
dump(db::table('users')->min('id'));
*/


/* two where clauses combined with an OR operator
dump(db::table('users')
  ->where('username', '=', 'homer')
  ->orWhere('username', '=', 'marge')
  ->all());
*/
