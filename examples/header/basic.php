<?php

// include the toolkit
require('../../bootstrap.php');

dump( header::success(false) );
dump( header::created(false) );
dump( header::notfound(false) );
dump( header::missing(false) );
dump( header::forbidden(false) );
dump( header::mime('json', 'UTF-8', false) );
dump( header::mime('image/jpeg', null, false) );
dump( header::redirect('http://getkirby.com', 301, false) );