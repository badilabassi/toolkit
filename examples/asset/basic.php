<?php

// include the toolkit
require('../../bootstrap.php');

$root = __DIR__ . DS . 'kirbyicon.png';
$url  = url::current() . '/kirbyicon.png';

// create a new asset object with root and url
$asset = new Asset($root, $url);

?>
<table>
  
  <tr>
    <th>Root:</th>
    <td><?php echo $asset->root() ?></td>
  </tr>
  <tr>
    <th>URL:</th>
    <td><?php echo $asset->url() ?></td>
  </tr>
  <tr>
    <th>Filename:</th>
    <td><?php echo $asset->filename() ?></td>
  </tr>
  <tr>
    <th>Name:</th>
    <td><?php echo $asset->name() ?></td>
  </tr>
  <tr>
    <th>Dir:</th>
    <td><?php echo $asset->dir() ?></td>
  </tr>
  <tr>
    <th>Dirname:</th>
    <td><?php echo $asset->dirname() ?></td>
  </tr>
  <tr>
    <th>Extension:</th>
    <td><?php echo $asset->extension() ?></td>
  </tr>
  <tr>
    <th>Mime:</th>
    <td><?php echo $asset->mime() ?></td>
  </tr>
  <tr>
    <th>Type:</th>
    <td><?php echo $asset->type() ?></td>
  </tr>
  <tr>
    <th>Size:</th>
    <td><?php echo $asset->size() ?></td>
  </tr>
  <tr>
    <th>Nice Size:</th>
    <td><?php echo $asset->niceSize() ?></td>
  </tr>
  <tr>
    <th>Width:</th>
    <td><?php echo $asset->width() ?></td>
  </tr>
  <tr>
    <th>Height:</th>
    <td><?php echo $asset->height() ?></td>
  </tr>
  <tr>
    <th>Aspect ratio:</th>
    <td><?php echo $asset->ratio() ?></td>
  </tr>
  <tr>
    <th>Modified:</th>
    <td><?php echo date('Y-m-d H:i:s', $asset->modified()) ?></td>
  </tr>

</table>