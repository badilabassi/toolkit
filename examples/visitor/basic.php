<?php

// include the toolkit
require('../../bootstrap.php');


?>
<table>
  
  <tr>
    <th>IP:</th>
    <td><?php echo visitor::ip() ?></td>
  </tr>

  <tr>
    <th>User Agent:</th>
    <td><?php echo visitor::ua() ?></td>
  </tr>

  <tr>
    <th>Accepted Language:</th>
    <td><?php echo visitor::acceptedLanguage() ?></td>
  </tr>

  <tr>
    <th>Accepted Language Code:</th>
    <td><?php echo visitor::acceptedLanguageCode() ?></td>
  </tr>

  <tr>
    <th>Referrer:</th>
    <td><?php echo visitor::referrer() ?></td>
  </tr>

</table>