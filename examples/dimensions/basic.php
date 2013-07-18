<?php

// include the toolkit
require('../../bootstrap.php');

$dimensions = new Dimensions(300, 400);

//$dimensions->fit(200);
//$dimensions->fitWidth(200);
$dimensions->fitHeight(200);

echo $dimensions->width() . ' x ' . $dimensions->height();
