<?php

// include the toolkit
require('../../bootstrap.php');

// available options
$options = array(
  'deutsch' => 'Deutsch',
  'english' => 'English',
);

// selected option
$selected = get('lang', 'english');

// attributes for the select tag
$attr = array(
  'id'       => 'lang',
  'onchange' => 'location.href = "?lang=" + this.value'
);

// label for the select box
echo form::label('Please select your language', 'lang');

// build the select box
echo form::select('lang', $options, $selected, $attr);