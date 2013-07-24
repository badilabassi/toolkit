<?php

// include the toolkit
require('../../bootstrap.php');

$data = array(
  'title'   => 'This is a fantastic template',
  'content' => 'Hello world'
);

$template         = template::create(__DIR__ . DS . 'template', $data);
$template->header = template::create(__DIR__ . DS . 'snippets' . DS . 'header', $data);
$template->footer = template::create(__DIR__ . DS . 'snippets' . DS . 'footer', $data);

echo $template;