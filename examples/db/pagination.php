<?php

// include the toolkit
require('../../bootstrap.php');

db::connect(array(
  'database' => __DIR__ . DS . 'tmp' . DS . 'db.sqlite',
  'type'     => 'sqlite'
));

$users      = db::table('users')->page(null, 2);
$pagination = $users->pagination();

foreach($users as $user) {
  dump($user->toArray());
}

?>

<ul>
  <?php if(!$pagination->isFirstPage()): ?>
  <li><a href="<?php echo $pagination->firstPageURL() ?>">first</a></li>
  <?php else: ?>
  <li>first</li>
  <?php endif ?>

  <?php if($pagination->hasPrevPage()): ?>
  <li><a href="<?php echo $pagination->prevPageURL() ?>">prev</a></li>
  <?php else: ?>
  <li>prev</li>
  <?php endif ?>

  <li><?php echo $pagination->numStart() . ' - ' . $pagination->numEnd() . ' of ' . $pagination->items() ?></li>

  <?php if($pagination->hasNextPage()): ?>
  <li><a href="<?php echo $pagination->nextPageURL() ?>">next</a></li>
  <?php else: ?>
  <li>next</li>
  <?php endif ?>

  <?php if(!$pagination->isLastPage()): ?>
  <li><a href="<?php echo $pagination->lastPageURL() ?>">last</a></li>
  <?php else: ?>
  <li>last</li>
  <?php endif ?>
</ul>