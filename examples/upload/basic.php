<?php

// include the toolkit
require('../../bootstrap.php');

// simple on submit handler
if(get('submit')) {

  $upload = new Upload('file', __DIR__ . DS . 'tmp' . DS . '{filename}');

  if($upload->failed()) {
    dump($upload->error());
  } else {
  
    dump(array(
      'file'     => $upload->file(),
      'mime'     => $upload->mime(),
      'size'     => $upload->size(),
      'niceSize' => $upload->niceSize()
    ));

  }

}

// create the upload form
echo form::start('', 'post', $upload = true);
echo form::file('file');
echo form::submit('submit', 'Upload');
echo form::end();