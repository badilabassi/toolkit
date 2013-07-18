<?php

// include the toolkit
require('../../bootstrap.php');

$url = 'http://getkirby.com/forum/general/topic:45?some=query';
$uri = new URI($url);

?>
<table>
  
  <tr>
    <th>Scheme:</th>
    <td><?php echo $uri->scheme() ?></td>
  </tr>
  <tr>
    <th>Host:</th>
    <td><?php echo $uri->host() ?></td>
  </tr>
  <tr>
    <th>Baseurl:</th>
    <td><?php echo $uri->baseurl() ?></td>
  </tr>
  <tr>
    <th>File:</th>
    <td><?php echo $uri->file() ?></td>
  </tr>
  <tr>
    <th>Extension:</th>
    <td><?php echo $uri->extension() ?></td>
  </tr>
  <tr>
    <th>Path:</th>
    <td><?php echo $uri->path() ?></td>
  </tr>
  <tr>
    <th>Params:</th>
    <td><?php echo $uri->params() ?></td>
  </tr>
  <tr>
    <th>Query:</th>
    <td><?php echo $uri->query() ?></td>
  </tr>

</table>
